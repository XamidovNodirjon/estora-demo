<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService
    ) {}

    /**
     * Display the contact static page.
     */
    public function index(): View
    {
        $contactData = $this->contactService->getContactData();

        return view('contact', compact('contactData'));
    }

    /**
     * Handle contact form submission.
     */
    public function submit(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $inquiry = $this->contactService->createInquiry($request->validated());

        $message = "Murojaatingiz muvaffaqiyatli qabul qilindi! Tez orada mutaxassislarimiz siz bilan bog'lanishadi.";

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'inquiry' => $inquiry,
            ]);
        }

        return redirect()->route('contact')->with('contact_success', $message);
    }
}
