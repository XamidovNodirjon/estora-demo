<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

/**
 * Murojaatlar (arizalar): admin va dev panellar uchun umumiy.
 */
class AdminInquiryController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index(Request $request)
    {
        $query = Inquiry::with('user')->orderBy('created_at', 'desc');

        // Faqat obuna so'rovlari
        if ($request->query('type') === 'subscription') {
            $query->whereNotNull('requested_plan');
        }

        $inquiries = $query->paginate(15)->withQueryString();
        $pendingSubscriptions = Inquiry::whereNotNull('requested_plan')->where('status', '!=', 'completed')->count();

        return view('admin.inquiries.index', $this->panel($request) + compact('inquiries', 'pendingSubscriptions'));
    }

    /**
     * Display the specified inquiry.
     */
    public function show(Request $request, Inquiry $inquiry)
    {
        $inquiry->load('user');

        return view('admin.inquiries.show', $this->panel($request) + compact('inquiry'));
    }

    /**
     * Update the status of the specified inquiry.
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:new,in_progress,completed',
        ]);

        $inquiry->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route($this->panel($request)['routePrefix'] . '.inquiries.index')
            ->with('success', 'Murojaat holati muvaffaqiyatli yangilandi!');
    }

    /**
     * Qaysi panel (admin yoki dev) ichida ochilgani: layout va route prefiksi.
     */
    protected function panel(Request $request): array
    {
        $isDeveloper = $request->routeIs('developer.*');

        return [
            'layout' => $isDeveloper ? 'layouts.developer' : 'layouts.admin',
            'routePrefix' => $isDeveloper ? 'developer' : 'admin',
        ];
    }
}
