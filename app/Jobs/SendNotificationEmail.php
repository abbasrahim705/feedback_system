<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user, $notification,$comment;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        Log::info('came to job constructor');
        $this->user = $user;
        Log::info($this->user);
        // $this->comment = $comment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve email content from the notification
        // $emailContent = $this->notification->toMail($this->user);

        // Send the email
        // Mail::to($this->user->email)->send($emailContent);
        Log::info("came to email job");
        // preparing data for notificaction
        $notificationData = [
            'subject' => 'New Comment',
            'message1' => 'A new Comment has been added on your post',
            'actionBtnLabel' => 'See Comment',
            'actionBtnUrl' => route('feedbacksList'),
            'message2' => 'Thank you for using our application!'
        ];

        // notify admin of the cron job start
        $this->user->notify(new CommentNotification($notificationData));

    }
}
