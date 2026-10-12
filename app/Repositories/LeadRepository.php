<?php

namespace App\Repositories;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Models\StatusHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class LeadRepository
{
    /**
     * Filters:
     *  - tab: 'new' (hali menejerga berilmagan) | 'assigned' (menejerga berilgan)
     *  - status: LeadStatus value
     *  - search: name / phone / description
     */
    public function getPaginated($limit = 15, array $filters = [])
    {
        $tab = $filters['tab'] ?? null;

        return Lead::with(['managers', 'latestStatusHistory.user', 'statusHistories.user'])
            ->when($tab === 'new', fn ($query) => $query->whereDoesntHave('managers'))
            ->when($tab === 'assigned', fn ($query) => $query->whereHas('managers'))
            ->tap(fn ($query) => $this->applyFilters($query, $filters))
            ->latest()
            ->paginate($limit)
            ->withQueryString();
    }

    public function getAssignedToManager(User $manager, $limit = 15, array $filters = [])
    {
        return $this->assignedToQuery($manager)
            ->with(['latestStatusHistory.user', 'statusHistories.user'])
            ->tap(fn ($query) => $this->applyFilters($query, $filters))
            ->latest()
            ->paginate($limit)
            ->withQueryString();
    }

    public function getLatestAssignedToManager(User $manager, int $limit = 5)
    {
        return $manager->assignedLeads()
            ->orderByPivot('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function countAssignedToManager(User $manager): int
    {
        return $manager->assignedLeads()->count();
    }

    /**
     * Number of leads per status: ['new' => 3, 'agreed' => 1, ...].
     * $manager given - only leads of that manager, otherwise all assigned leads.
     */
    public function countByStatus(?User $manager = null): array
    {
        $query = $manager ? $this->assignedToQuery($manager) : Lead::whereHas('managers');

        $counts = $query->toBase()
            ->selectRaw('status, count(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return collect(LeadStatus::values())
            ->mapWithKeys(fn ($status) => [$status => (int) ($counts[$status] ?? 0)])
            ->all();
    }

    public function count(): int
    {
        return Lead::count();
    }

    public function countNew(): int
    {
        return Lead::whereDoesntHave('managers')->count();
    }

    public function countAssigned(): int
    {
        return Lead::whereHas('managers')->count();
    }

    public function findByIds(array $ids)
    {
        return Lead::whereIn('id', $ids)->get();
    }

    public function create(array $data): Lead
    {
        return Lead::create($data);
    }

    public function update(Lead $lead, array $data): Lead
    {
        $lead->update($data);
        return $lead;
    }

    /**
     * Change status and write the change into the polymorphic history log.
     */
    public function changeStatus(Lead $lead, LeadStatus $status, string $comment, ?int $userId): StatusHistory
    {
        $history = $lead->statusHistories()->create([
            'user_id' => $userId,
            'from_status' => $lead->status?->value,
            'to_status' => $status->value,
            'comment' => $comment,
        ]);

        $lead->update(['status' => $status]);

        return $history;
    }

    public function delete(Lead $lead): bool
    {
        $lead->managers()->detach();
        $lead->statusHistories()->delete();
        return $lead->delete();
    }

    protected function assignedToQuery(User $manager): Builder
    {
        return Lead::whereHas('managers', fn ($q) => $q->where('users.id', $manager->id));
    }

    protected function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['status']) && LeadStatus::tryFrom($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
    }
}
