<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentNotification extends Notification
{
    use Queueable;
    protected $subject,$message1,$actionBtnLabel,
    $actionUrl,$message2;
    /**
     * Create a new notification instance.
     */
    public function __construct($notificationData)
    {
        $this->message1 = $notificationData['message1'];
        $this->actionUrl = $notificationData['actionBtnUrl'];
        $this->message2 = $notificationData['message2'];
        $this->actionBtnLabel = $notificationData['actionBtnLabel'];
        $this->subject = $notificationData['subject'];

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->subject)
                    ->line($this->message1)
                    ->action(ucwords($this->actionBtnLabel), url($this->actionUrl))
                    ->line($this->message2);
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
