<?php

namespace App\Http\Controllers;

use App\DTOs\LeadStatusChangeDto;
use App\Enums\LeadStatus;
use App\Http\Requests\Lead\ChangeLeadStatusRequest;
use App\Models\Lead;
use App\Services\LeadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerLeadController extends Controller
{
    public function __construct(
        protected LeadService $service
    ) {}

    /**
     * Leads assigned to the authenticated manager.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->filled('search') ? trim($request->search) : null;
        $status = LeadStatus::tryFrom((string) $request->query('status'));

        $leads = $this->service->getManagerLeads($user, 12, [
            'status' => $status?->value,
            'search' => $search,
        ]);
        $statusCounts = $this->service->getStatusCounts($user);
        $totalCount = array_sum($statusCounts);
        $statuses = LeadStatus::cases();

        return view('manager.leads.index', compact('leads', 'search', 'status', 'statusCounts', 'totalCount', 'statuses'));
    }

    /**
     * Change lead status with a mandatory comment.
     */
    public function updateStatus(ChangeLeadStatusRequest $request, Lead $lead)
    {
        $dto = LeadStatusChangeDto::fromArray($request->validated());
        $this->service->changeStatus($lead, $dto, $request->user());

        return redirect()->back()
            ->with('success', "\"{$lead->name}\" lidining statusi \"{$dto->status->label()}\" ga o'zgartirildi.");
    }
}
