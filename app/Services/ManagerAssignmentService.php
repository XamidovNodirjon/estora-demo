<?php

namespace App\Services;

use App\Repositories\ManagerAssignmentRepository;
use Illuminate\Database\Eloquent\Model;

class ManagerAssignmentService
{
    public function __construct(
        protected ManagerAssignmentRepository $repository
    ) {}

    public function getManagers()
    {
        return $this->repository->getManagers();
    }

    /**
     * Assign the given managers to any assignable model (polymorphic).
     */
    public function syncManagers(Model $assignable, array $managerIds): void
    {
        $this->repository->sync($assignable, $managerIds, auth()->id());
    }
}
