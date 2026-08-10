<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public Message $messageModel;

    /**
     * Create a new notification instance.
     */
    public function __construct(Message $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message_id' => $this->messageModel->id,
            'sender_id' => $this->messageModel->sender_id,
            'sender_name' => $this->messageModel->sender?->name ?? 'Foydalanuvchi',
            'product_id' => $this->messageModel->product_id,
            'product_title' => $this->messageModel->product?->title ?? 'E\'lon',
            'message' => $this->messageModel->message,
        ];
    }
}
