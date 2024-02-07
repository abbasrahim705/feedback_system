<?php

namespace App\Observers;

use App\Models\Comment;
use App\Services\FeedbackService;
use App\Jobs\SendNotificationEmail;
use Illuminate\Support\Facades\Log;
use App\Notifications\CommentNotification;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        Log::info("Comment has been created");
        // $commentUserId = Log::info($comment);
        $commentUser = $comment->user;
        $feedbackAuthor =  $comment->commentable()->first()->user()->getResults();
        Log::info($feedbackAuthor);
        $notificationData = [
            'subject' => 'New Comment',
            'message1' => "$commentUser->name added a comment to your feedback.",
            'actionBtnLabel' => 'See Comment',
            'actionBtnUrl' => route('feedbacksList'),
            'message2' => 'Thank you for using our application!'
        ];

        // notify admin of the cron job start
        $feedbackAuthor->notify(new CommentNotification($notificationData));
        // SendNotificationEmail::dispatch($feedbackAuthor);
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
