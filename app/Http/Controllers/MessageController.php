<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Store a new message sent from property detail or list page.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'message' => 'required|string|max:2000',
        ]);

        $product = Product::findOrFail($request->product_id);
        $user = Auth::user();

        if ($user->id === $product->user_id) {
            return back()->with('error', "O'zingizning e'loningizga xabar yubora olmaysiz.");
        }

        try {
            $this->messageService->sendMessage($user, $product, $request->message);
            return back()->with('success', "Xabaringiz e'lon egasiga muvaffaqiyatli yuborildi!");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a reply message inside the chat thread dashboard.
     */
    public function reply(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:2000',
        ]);

        $user = Auth::user();

        try {
            $this->messageService->sendReply($user, $request->receiver_id, $request->product_id, $request->message);
            return back()->with('success', "Xabaringiz yuborildi!");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Mark conversation thread as read.
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'partner_id' => 'required|integer',
        ]);

        $this->messageService->markThreadAsRead(Auth::user(), $request->product_id, $request->partner_id);

        return response()->json(['status' => 'success']);
    }
}
