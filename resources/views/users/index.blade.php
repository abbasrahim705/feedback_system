<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    @foreach ($users as $user)
        <h2>{{ $user->name }}</h2>
        <div>
            <h3>Posts</h3>
            @if (count($user->posts))
                @foreach ($user->posts as $key  => $post)
                    <h5>Title:{{ $post->title }}{{ $key }}</h5>
                    {{-- <h5>Description:{{ $post->description }}</h5> --}}
                @endforeach
            @endif
        </div>
    @endforeach
</body>
</html>
