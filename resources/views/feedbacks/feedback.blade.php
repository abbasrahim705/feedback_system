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
    <div class="container mt-5">
        <h2>Feedback ---> {{ $feedback->feedback }}</h2>
        <p><small>Created by : {{ $feedback->user->name ?? 'Guest' }} {{ $feedback->created_at->diffForHumans() }}</small></p>
        <div>
            <h3>Want to Comment?</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <form action="{{ route('commentSend') }}" method="POST">
                @csrf
                <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                <div class="form-group">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" placeholder="Enter your Name here..." class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" placeholder="Enter your Email here...." class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">description:</label><br>
                    <textarea id="description" name="description" rows="4" placeholder="Enter your comment here...." class="form-control"></textarea>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" value="Submit Comment">
                </div>
            </form>
        </div>
        <hr>
        <div>
            <h4>Comments ({{ count($feedback->comment ?? []) }}) :</h4>
            @forelse ($feedback->comment ?? [] as $comment)
                <div>
                    <h5>{{ $comment->description ?? 'N/A' }}</h5>
                    <small>By: {{ $comment->user->name ?? 'N/A' }} |
                        {{ $comment->created_at->diffForHumans() }}
                    </small><br>
                </div>
            @empty
                No comments yet. Be the first to comment!
            @endforelse
        </div>
    </div>
</body>
</html>
