<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FeedbackService;
use App\Http\Requests\CommentRequest;
use App\Repositories\Eloquent\CommentRepository;

class CommentController extends Controller
{
    public function create(CommentRequest $request,FeedbackService $service){
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $feedback = $service->getFeedbackById($validatedData['feedback_id']);
        $comment = $feedback->comment()->create($validatedData);
        return response()->json([
            'status' => true,
            'message' => 'Your comment has been received. Thanks',
            'comment' => $comment
        ]);
    }
}
