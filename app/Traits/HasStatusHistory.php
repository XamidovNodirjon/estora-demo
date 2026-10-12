<?php

namespace App\Traits;

use App\Models\StatusHistory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Keeps a polymorphic log of status changes (status_histories table).
 */
trait HasStatusHistory
{
    public function statusHistories(): MorphMany
    {
        return $this->morphMany(StatusHistory::class, 'statusable')->latest('id');
    }

    public function latestStatusHistory(): MorphOne
    {
        return $this->morphOne(StatusHistory::class, 'statusable')->latestOfMany();
    }
}
