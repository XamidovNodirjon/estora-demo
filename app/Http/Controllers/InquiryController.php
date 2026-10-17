<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Store a newly created inquiry in storage.
     */
    public function store(Request $request)
    {
        $paidPlans = array_diff(array_keys(config('subscriptions.plans')), [config('subscriptions.default', 'start')]);

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:30',
            'description' => 'nullable|string|max:1000',
            'requested_plan' => ['nullable', \Illuminate\Validation\Rule::in($paidPlans)],
            'requested_period' => ['nullable', \Illuminate\Validation\Rule::in(array_keys(config('subscriptions.periods')))],
        ]);

        $inquiry = Inquiry::create([
            // Tizimga kirgan foydalanuvchi arizasi - admin obunani to'g'ridan-to'g'ri yoqa olishi uchun
            'user_id' => $request->user()?->id,
            'name' => $validated['name'] ?? null,
            'phone' => $validated['phone'],
            'description' => $validated['description'] ?? null,
            'requested_plan' => $request->user() ? ($validated['requested_plan'] ?? null) : null,
            'requested_period' => $request->user() && !empty($validated['requested_plan']) ? ($validated['requested_period'] ?? 'monthly') : null,
            'status' => 'new',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Murojaatingiz qabul qilindi! Tez orada mutaxassislarimiz siz bilan bog\'lanishadi.',
                'inquiry' => $inquiry
            ]);
        }

        return redirect()->back()->with('success_inquiry', 'Murojaatingiz qabul qilindi! Tez orada mutaxassislarimiz siz bilan bog\'lanishadi.');
    }
}
