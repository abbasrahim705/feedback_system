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
    {{-- a form to get feedback from users --}}

    <div class="container mt-5">
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
        <form action="{{ route('feedbackSend') }}" method="POST">
            @csrf
            <h2>Give us your Feedback!</h2>
            <div class="form-group">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" placeholder="Enter your Name here..." class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" placeholder="Enter your Email here...." class="form-control">
            </div>
            <div class="form-group">
                <label for="feedback">Feedback:</label><br>
                <textarea id="feedback" name="feedback" rows="4" placeholder="Enter your Feedback here...." class="form-control"></textarea>
            </div>
            <div class="form-group mt-3 d-flex">
                <input type="submit" class="btn btn-primary m-1" value="Submit Feedback">
                <a href="{{ route('feedbacksList') }}" class="btn btn-warning m-1" > View All Feedbacks</a>
            </div>
        </form>
    </div>
</body>
</html>
