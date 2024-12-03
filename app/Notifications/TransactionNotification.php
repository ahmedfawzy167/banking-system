<?php

namespace App\Notifications;

use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private string $message,
        private string $phoneNumber
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['sms'];
    }

    public function toSms($notifiable)
    {
        try {
            $smsService = app(SmsService::class);
            $smsService->sendSms($this->phoneNumber, $this->message);
        } catch (\Exception $e) {
            Log::error('Failed to Send Transaction SMS Notification', [
                'phone' => $this->phoneNumber,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
