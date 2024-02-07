<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Repositories\Eloquent\FeedbackRepository;
use App\Services\FeedbackService;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeedbackService $service)
    {
        return view('feedbacks.index', ['feedbacks' => $service->getAllFeedbacks()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request, FeedbackRepository $repository,FeedbackService $service)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $feedback = $repository->create($validatedData);
        $feedbackHtml = $service->appendNewlyAddedFeedback($feedback->id);
        return response()->json([
            'status' => true,
            'message' => 'Your feedback has been received. Thanks',
            'feedback' => $feedbackHtml
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedbackService $service,$id)
    {
        return view('feedbacks.feedback',[
            'feedback' => $service->getFeedbackById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        return view('feedbacks.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
