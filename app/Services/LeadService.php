<?php

namespace App\Services;

use App\DTOs\LeadDto;
use App\DTOs\LeadStatusChangeDto;
use App\Models\Lead;
use App\Models\User;
use App\Repositories\LeadRepository;
use Illuminate\Support\Facades\DB;

class LeadService
{
    public function __construct(
        protected LeadRepository $repository,
        protected ManagerAssignmentService $assignmentService
    ) {}

    /**
     * Max number of leads that can be given to a manager in one bulk action.
     */
    public const BULK_ASSIGN_LIMIT = 10;

    /**
     * @param array $filters tab, status, search
     */
    public function getLeads($limit = 15, array $filters = [])
    {
        return $this->repository->getPaginated($limit, $filters);
    }

    /**
     * Assigned leads count per status (all managers or one manager).
     */
    public function getStatusCounts(?User $manager = null): array
    {
        return $this->repository->countByStatus($manager);
    }

    /**
     * Manager changes lead status; the comment is stored in the status history.
     */
    public function changeStatus(Lead $lead, LeadStatusChangeDto $dto, User $user): Lead
    {
        return DB::transaction(function () use ($lead, $dto, $user) {
            $this->repository->changeStatus($lead, $dto->status, $dto->comment, $user->id);

            return $lead->refresh();
        });
    }

    public function getLeadsCount(): int
    {
        return $this->repository->count();
    }

    public function getNewLeadsCount(): int
    {
        return $this->repository->countNew();
    }

    public function getAssignedLeadsCount(): int
    {
        return $this->repository->countAssigned();
    }

    /**
     * Give several leads (max BULK_ASSIGN_LIMIT) to one manager at once.
     */
    public function bulkAssign(array $leadIds, int $managerId): int
    {
        return DB::transaction(function () use ($leadIds, $managerId) {
            $leads = $this->repository->findByIds(array_slice(array_unique($leadIds), 0, self::BULK_ASSIGN_LIMIT));

            foreach ($leads as $lead) {
                $this->assignmentService->syncManagers($lead, [$managerId]);
            }

            return $leads->count();
        });
    }

    /**
     * @param array $filters status, search
     */
    public function getManagerLeads(User $manager, $limit = 15, array $filters = [])
    {
        return $this->repository->getAssignedToManager($manager, $limit, $filters);
    }

    public function getLatestManagerLeads(User $manager, int $limit = 5)
    {
        return $this->repository->getLatestAssignedToManager($manager, $limit);
    }

    public function countManagerLeads(User $manager): int
    {
        return $this->repository->countAssignedToManager($manager);
    }

    public function createLead(LeadDto $dto): Lead
    {
        return DB::transaction(function () use ($dto) {
            $lead = $this->repository->create($dto->toArray());
            $this->assignmentService->syncManagers($lead, $dto->manager_id ? [$dto->manager_id] : []);

            return $lead;
        });
    }

    public function updateLead(Lead $lead, LeadDto $dto): Lead
    {
        return DB::transaction(function () use ($lead, $dto) {
            $lead = $this->repository->update($lead, $dto->toArray());
            $this->assignmentService->syncManagers($lead, $dto->manager_id ? [$dto->manager_id] : []);

            return $lead;
        });
    }

    public function deleteLead(Lead $lead): bool
    {
        return DB::transaction(fn () => $this->repository->delete($lead));
    }
}
