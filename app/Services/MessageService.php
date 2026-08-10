<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MessageService
{
    /**
     * Send a new message to the property owner and trigger Laravel Notification.
     */
    public function sendMessage(User $sender, Product $product, string $text): Message
    {
        if ($sender->id === $product->user_id) {
            throw new \InvalidArgumentException("O'zingizning e'loningizga xabar yubora olmaysiz.");
        }

        $message = Message::create([
            'sender_id' => $sender->id,
            'receiver_id' => $product->user_id,
            'product_id' => $product->id,
            'message' => trim($text),
        ]);

        $message->load(['sender', 'product']);

        // Send Laravel Database Notification to Property Owner (Receiver)
        $receiver = User::find($product->user_id);
        if ($receiver) {
            $receiver->notify(new NewMessageNotification($message));
        }

        return $message;
    }

    /**
     * Send a reply in an existing conversation thread.
     */
    public function sendReply(User $sender, int $receiverId, int $productId, string $text): Message
    {
        $message = Message::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiverId,
            'product_id' => $productId,
            'message' => trim($text),
        ]);

        $message->load(['sender', 'product']);

        $receiver = User::find($receiverId);
        if ($receiver) {
            $receiver->notify(new NewMessageNotification($message));
        }

        return $message;
    }

    /**
     * Get grouped conversations for a given user.
     * Groups by product_id and conversation partner ID.
     */
    public function getUserConversations(User $user): Collection
    {
        $userId = $user->id;

        $messages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver', 'product'])
            ->latest()
            ->get();

        return $messages->groupBy(function ($msg) use ($userId) {
            $partnerId = $msg->sender_id === $userId ? $msg->receiver_id : $msg->sender_id;
            return "{$msg->product_id}_{$partnerId}";
        })->map(function ($group) use ($userId) {
            $latest = $group->first();
            $partner = $latest->sender_id === $userId ? $latest->receiver : $latest->sender;
            $unreadCount = $group->where('receiver_id', $userId)->whereNull('read_at')->count();

            return [
                'product_id' => $latest->product_id,
                'product' => $latest->product,
                'partner_id' => $partner?->id,
                'partner' => $partner,
                'latest_message' => $latest,
                'unread_count' => $unreadCount,
                'messages' => $group->sortBy('created_at')->values(),
            ];
        })->values();
    }

    /**
     * Mark all messages & notifications in a thread as read for the user.
     */
    public function markThreadAsRead(User $user, int $productId, int $partnerId): void
    {
        Message::where('product_id', $productId)
            ->where('sender_id', $partnerId)
            ->where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Mark associated notifications as read
        $user->unreadNotifications
            ->filter(function ($n) use ($productId, $partnerId) {
                return isset($n->data['product_id']) 
                    && (int)$n->data['product_id'] === $productId 
                    && isset($n->data['sender_id']) 
                    && (int)$n->data['sender_id'] === $partnerId;
            })
            ->markAsRead();
    }
}
