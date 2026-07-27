<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(10);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Display the specified inquiry.
     */
    public function show(Inquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
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

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Murojaat holati muvaffaqiyatli yangilandi!');
    }
}
