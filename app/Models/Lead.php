<?php

namespace App\Models;

use App\Enums\LeadStatus;
use App\Traits\Assignable;
use App\Traits\HasStatusHistory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use Assignable, HasStatusHistory;

    protected $fillable = [
        'name',
        'phone',
        'description',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    protected $casts = [
        'status' => LeadStatus::class,
    ];
}
