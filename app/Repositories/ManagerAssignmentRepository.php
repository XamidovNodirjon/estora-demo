<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ManagerAssignmentRepository
{
    /**
     * All users with the manager role.
     */
    public function getManagers()
    {
        $managerRoleId = Role::where('name', 'manager')->value('id');

        return User::where(function ($query) use ($managerRoleId) {
                $query->where('type', 'manager');
                if ($managerRoleId) {
                    $query->orWhere('role_id', $managerRoleId);
                }
            })
            ->orderBy('name')
            ->get();
    }

    /**
     * Replace the managers assigned to the given assignable model (Lead, Product, ...).
     * Managers that stay assigned keep their original "assigned_by" value.
     */
    public function sync(Model $assignable, array $managerIds, ?int $assignedBy = null): void
    {
        $existing = $assignable->managers()->pluck('users.id')->all();

        $pivot = collect($managerIds)
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->mapWithKeys(fn ($id) => [
                $id => in_array($id, $existing, true) ? [] : ['assigned_by' => $assignedBy],
            ])
            ->all();

        $assignable->managers()->sync($pivot);
    }
}
