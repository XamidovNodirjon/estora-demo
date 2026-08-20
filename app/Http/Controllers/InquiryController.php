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
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:30',
            'description' => 'nullable|string|max:1000',
        ]);

        $inquiry = Inquiry::create([
            'name' => $validated['name'] ?? null,
            'phone' => $validated['phone'],
            'description' => $validated['description'] ?? null,
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
