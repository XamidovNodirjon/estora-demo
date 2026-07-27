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
            'phone' => 'required|string|max:30',
            'description' => 'nullable|string|max:1000',
        ]);

        Inquiry::create([
            'phone' => $validated['phone'],
            'description' => $validated['description'] ?? null,
            'status' => 'new',
        ]);

        return redirect()->back()->with('success_inquiry', 'Murojaatingiz qabul qilindi! Tez orada siz bilan bog\'lanamiz.');
    }
}
