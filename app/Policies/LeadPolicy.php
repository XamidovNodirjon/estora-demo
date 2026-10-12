<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;

class LeadPolicy
{
    /**
     * Only the manager the lead is assigned to may change its status.
     */
    public function changeStatus(User $user, Lead $lead): bool
    {
        return $user->isManager() && $lead->isAssignedTo($user);
    }
}
