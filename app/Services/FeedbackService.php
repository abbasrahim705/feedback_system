<?php
namespace App\Services;

use App\Models\Feedback;
use App\Models\User;

class FeedbackService {

    protected  $feedbackModelObj,$userModelObj;

    public function __construct()
    {
        $this->feedbackModelObj = new Feedback();
        $this->userModelObj = new User();
    }

    public function getAllFeedbacks(){
        return $this->feedbackModelObj::with([
            'user',
            'comment'
            ])->orderBy('created_at','desc')
            ->get();

    }
    public function  getFeedbackById($id){
        return $this->feedbackModelObj::with(['user','comment.user'])->findOrFail($id);
    }

    public function checkUser($validatedData){
        $user = $this->userModelObj::whereEmail($validatedData['email'])->first();
        if($user != null){
            return $user->id;
        }else{
            return $this->userModelObj::insertGetId([
                'name'  => $validatedData['name'],
                'email'=>$validatedData['email'],
                'password'=>bcrypt('12345678'),
            ]);
        }
    }

    public function appendNewlyAddedFeedback($feedbackId){
        $feedback = $this->getFeedbackById($feedbackId);
        $newFeedbackData = '<div class="card col-12 mb-5" style="">
            <div class="card-body">
            <h5 class="card-title">'. ($feedback->user->name ?? "Abbas") .'</h5>
            <small>'. $feedback->created_at->diffForHumans() .'</small>
            <p class="card-text">'. $feedback->feedback .'</p>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading'. $feedback->id .'">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#comment'. $feedback->id .'" aria-expanded="true" aria-controls="collapseOne">
                      Comments ('. $feedback->comment->count() .')
                    </button>
                  </h2>
                  <form action="'. route('commentSend') .'" method="POST">
                    <input type="hidden" name="feedback_id" value="'. $feedback->id .'">
                    <div class="form-group">
                        <textarea id="description" name="description" rows="4" placeholder="Enter your comment here...." class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" value="Post Comment">
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>';

        return $newFeedbackData;
    }



}
?>
