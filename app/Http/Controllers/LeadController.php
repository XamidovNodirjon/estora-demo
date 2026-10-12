<?php

namespace App\Http\Controllers;

use App\DTOs\LeadDto;
use App\Enums\LeadStatus;
use App\Http\Requests\Lead\BulkAssignLeadsRequest;
use App\Http\Requests\Lead\LeadRequest;
use App\Models\Lead;
use App\Services\LeadService;
use App\Services\ManagerAssignmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    public function __construct(
        protected LeadService $service,
        protected ManagerAssignmentService $assignmentService
    ) {}

    /**
     * Display leads for Developer (Super Admin) Panel.
     */
    public function developerIndex(Request $request)
    {
        return $this->renderIndex($request, 'layouts.developer', 'developer.leads');
    }

    /**
     * Display leads for Admin Panel.
     */
    public function adminIndex(Request $request)
    {
        return $this->renderIndex($request, 'layouts.admin', 'admin.leads');
    }

    /**
     * Shared render logic for leads view.
     * Tabs: 'new' - hali menejerga berilmagan, 'assigned' - menejerga berilgan lidlar.
     */
    protected function renderIndex(Request $request, string $layout, string $routePrefix)
    {
        $tab = $request->query('tab') === 'assigned' ? 'assigned' : 'new';
        $search = $request->filled('search') ? trim($request->search) : null;
        // Status filtri faqat menejerga berilgan lidlar uchun ma'noli
        $status = $tab === 'assigned' ? LeadStatus::tryFrom((string) $request->query('status')) : null;

        $leads = $this->service->getLeads(15, [
            'tab' => $tab,
            'status' => $status?->value,
            'search' => $search,
        ]);
        $managers = $this->assignmentService->getManagers();
        $totalCount = $this->service->getLeadsCount();
        $newCount = $this->service->getNewLeadsCount();
        $assignedCount = $this->service->getAssignedLeadsCount();
        $statusCounts = $this->service->getStatusCounts();
        $statuses = LeadStatus::cases();
        $bulkLimit = LeadService::BULK_ASSIGN_LIMIT;

        return view('leads.index', compact(
            'leads', 'managers', 'totalCount', 'newCount', 'assignedCount', 'statusCounts', 'statuses',
            'tab', 'status', 'search', 'bulkLimit', 'layout', 'routePrefix'
        ));
    }

    public function store(LeadRequest $request)
    {
        $dto = LeadDto::fromArray($request->validated());
        $this->service->createLead($dto);

        // Yangi lid tushgan tabni ochamiz
        return redirect()->route($this->routePrefix($request), ['tab' => $dto->manager_id ? 'assigned' : 'new'])
            ->with('success', 'Lid muvaffaqiyatli qo\'shildi!');
    }

    public function update(LeadRequest $request, Lead $lead)
    {
        $dto = LeadDto::fromArray($request->validated());
        $this->service->updateLead($lead, $dto);

        return redirect()->back()->with('success', 'Lid muvaffaqiyatli yangilandi!');
    }

    /**
     * Give up to LeadService::BULK_ASSIGN_LIMIT leads to one manager at once.
     */
    public function bulkAssign(BulkAssignLeadsRequest $request)
    {
        $count = $this->service->bulkAssign($request->validated('lead_ids'), (int) $request->validated('manager_id'));

        return redirect()->back()->with('success', "{$count} ta lid menejerga muvaffaqiyatli biriktirildi!");
    }

    public function destroy(Lead $lead)
    {
        $this->service->deleteLead($lead);

        return redirect()->back()->with('success', 'Lid o\'chirildi!');
    }

    /**
     * 'admin.leads.store' -> 'admin.leads'
     */
    protected function routePrefix(Request $request): string
    {
        return Str::beforeLast($request->route()->getName(), '.');
    }
}
