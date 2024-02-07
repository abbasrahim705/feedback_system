<?php

use App\Services\FeedbackService;

class CommentService{

    public function appendNewlyAddedComment($feedbackId,FeedbackService $service){
        $feedback = $service->getFeedbackById($feedbackId);
        
    }
}

?>
