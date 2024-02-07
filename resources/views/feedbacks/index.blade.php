<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Feedback</title>
</head>
<body>
        <div class="container mt-5 w-50">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <p>{{ Session::get('success') }}</p>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif --}}
            <div class="alert alert-success alert-dismissible d-none" role="alert" id="message">
                <span></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="d-flex justify-content-between">
                <h2>Welcome! {{ Auth::user()->name }}</h2>
                <a href="{{ route('logout') }}" class="btn btn-warning">Log Out</a>
            </div>
            <form action="" method="POST">
                @csrf
                <h5>Share Your Thoughts Here......</h5>
                <div class="form-group">
                    <textarea id="feedback" name="feedback" rows="4" placeholder="Enter your Thoughts here...." class="form-control"></textarea>
                </div>
                <div class="form-group mt-3">
                    <button type="button" class="btn btn-primary" onclick="feedbackSubmit()">Post</button>
                </div>
            </form>
    </div>
    <div class="container w-50">
        <div class="row mt-5" id="feedbacks">
            <h3>Recent Feeds</h3>
            <div id="newlyAddedFeedback" class="col-12 mb-5">

            </div>
            @forelse ($feedbacks as $feedback)
                <div class="card col-12 mb-5" style="">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                    <h5 class="card-title">{{ $feedback->user->name ?? 'Abbas' }}</h5>
                    <small>{{ $feedback->created_at->diffForHumans() }}</small>
                    <p class="card-text">{{ $feedback->feedback }}</p>
                    <div class="accordion" id="accordionExample{{ $feedback->id }}">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading{{ $feedback->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#comment{{ $feedback->id }}" aria-expanded="true" aria-controls="collapseOne">
                              Comments ({{ $feedback->comment->count() }})
                            </button>
                          </h2>
                          <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="feedback_id" id="feedback_id" value="{{ $feedback->id }}">
                            <div class="form-group">
                                <textarea id="description{{ $feedback->id }}" name="description{{ $feedback->id }}" rows="4" placeholder="Enter your comment here...." class="form-control"></textarea>
                                <div id="user-suggestions{{ $feedback->id }}"></div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="button" onclick="commentSubmit({{ $feedback->id }})" class="btn btn-primary">Post Comment</button>
                            </div>
                          </form>
                          @forelse ($feedback->comment as $comment)
                          <div id="comment{{ $comment->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $feedback->id }}" data-bs-parent="#accordionExample{{ $feedback->id }}">
                            <div class="accordion-body">
                              <h6>
                                {{ $comment->user->name ?? 'Abbas' }}
                                <span>
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </span>
                             </h6>
                              <strong class="ml-3">{{ $comment->description }}</strong>
                            </div>
                          </div>
                          @empty
                          <div class="accordion-body">
                            <strong>Be the first to comment.</strong>
                          </div>
                          @endforelse

                        </div>
                      </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">No Feedback Yet!</div>
            @endforelse
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ url('scripts/ajax.js') }}"></script>
</body>
</html>
