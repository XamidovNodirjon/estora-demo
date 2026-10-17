<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'username',
        'password',
        'position_id',
        'phone',
        'phone_verified_at',
        'passport',
        'jshshir',
        'email',
        'google_id',
        'avatar',
        'type',
        'status',
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Leads assigned to this manager (polymorphic manager_assignments pivot).
     */
    public function assignedLeads()
    {
        return $this->morphedByMany(Lead::class, 'assignable', 'manager_assignments', 'manager_id')
            ->withPivot('assigned_by')
            ->withTimestamps();
    }

    /**
     * Products (houses) assigned to this manager (polymorphic manager_assignments pivot).
     */
    public function assignedProducts()
    {
        return $this->morphedByMany(Product::class, 'assignable', 'manager_assignments', 'manager_id')
            ->withPivot('assigned_by')
            ->withTimestamps();
    }

    public function isManager(): bool
    {
        $roleName = $this->role?->name ?? $this->type;
        return $roleName === 'manager';
    }

    public function isMakler(): bool
    {
        $roleName = $this->role?->name ?? $this->type;
        return $roleName === 'makler';
    }

    public function isOwnerOrClient(): bool
    {
        return !$this->isMakler();
    }

    /**
     * Amaldagi tarif: pullik tarif muddati tugagan bo'lsa - bepul (start) tarif.
     * Obuna maydonlari $fillable'da yo'q: ularni faqat admin/dev SubscriptionService orqali o'zgartiradi.
     */
    public function currentPlan(): string
    {
        $default = config('subscriptions.default', 'start');
        $plan = $this->subscription_plan ?: $default;

        if ($plan === $default || !array_key_exists($plan, config('subscriptions.plans', []))) {
            return $default;
        }

        return $this->subscription_expires_at?->isFuture() ? $plan : $default;
    }

    public function hasPaidPlan(): bool
    {
        return $this->currentPlan() !== config('subscriptions.default', 'start');
    }

    /**
     * Joriy tarif sozlamalari (config/subscriptions.php dan) + kalit.
     */
    public function planInfo(): array
    {
        $key = $this->currentPlan();

        return ['key' => $key] + config("subscriptions.plans.{$key}", []);
    }

    /**
     * Pullik tarif muddati o'tib ketgan (admin uzaytirishi kerak).
     */
    public function subscriptionExpired(): bool
    {
        return $this->subscription_plan
            && $this->subscription_plan !== config('subscriptions.default', 'start')
            && $this->subscription_expires_at?->isPast();
    }

    protected static function booted(): void
    {
        static::saving(function (User $user) {
            if (empty($user->name) && (!empty($user->first_name) || !empty($user->last_name))) {
                $user->name = trim("{$user->first_name} {$user->last_name}");
            } elseif (!empty($user->name) && empty($user->first_name) && empty($user->last_name)) {
                $parts = explode(' ', trim($user->name), 2);
                $user->first_name = $parts[0] ?? null;
                $user->last_name = $parts[1] ?? null;
            }
        });
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'subscription_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
