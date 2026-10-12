<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Makes a model assignable to managers through the polymorphic
 * `manager_assignments` pivot table.
 */
trait Assignable
{
    public function managers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'assignable', 'manager_assignments', 'assignable_id', 'manager_id')
            ->withPivot('assigned_by')
            ->withTimestamps();
    }

    public function isAssignedTo(User $manager): bool
    {
        return $this->managers()->where('users.id', $manager->id)->exists();
    }
}
