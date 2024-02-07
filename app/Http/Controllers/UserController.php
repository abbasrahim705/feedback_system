<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function index(){
        $users = User::with([
            'posts' => fn($query) => $query->limit(5)
        ])->limit(2)->get();

        return view('users.index',[
            'users' => $users
        ]);
    }

    public function collectionTest(){

        $users = User::whereBetween('id',[10,20])->get();

        $users = User::whereNotBetween('id',[10,20])->get();

        $users = User::whereIn('id',[10,20])->get();

        $users = User::whereNotIn('id',[10,20])->get();

        $posts = Post::all();

        $collection = collect([
            new User,
            new Post
        ]);

        $result = $collection->whereInstanceOf(Post::class)->all();

        $emptyCollection = User::whereId(1000)->get();
        $result = $emptyCollection->whenEmpty(function (){
            return  "No users found";
        });

        $notEmptyCollection = $users->whenNotEmpty(function ($users){
            return 'Collection is not Empty';
        });

        $var = 5>2;
        $result = $users->when($var, function(){
            return 'When is true';
        }, function(){
            return 'When is False';
        });

        $result = $users->sliding(2, step:1);
        // $userWithFivePosts = $users->sole(function($user){
        //     return $user->posts->count() === 10;
        // });
        $collection = collect([45,23,12,45,33,22,76]);

        $sortedUsersList = $collection->sort();

        $sortedUsersList = $users->sortBy('name',SORT_NATURAL);

        $result = $collection->splice(3,2);

        $result = $users->split(25);

        $result = $collection->sum();

        $result = $users->sum('id');

        $result = $users->takeUntil(function($user){
           return $user->id == 17;
        });

        $result = $users->takeWhile(function($user){
            return $user->id < 17;
         });

         $times = Collection::times(20, function (int $number) {
            return '9 * '.$number .' = '. $number * 9;
        });

        $result = $users->toJson();
        // $result = $users->transform(function($user){
        //         return ($user->created_at->diffForHumans());
        // });
        $result1 = $users->unique('name');

        $check = 5>2;
        $result = $posts->unless($check,function($post){
                return $post;
             },function($post){
             return  'post';
        });

        $userIds = User::pluck('id');
        $userNames = User::pluck('name');

        $result = $userIds->zip($userNames);

        $result = $users->flatMap(function($user){
                    return $user;
        });

        $posts = Post::get();
        $result = $posts->flatten();
        // $result = $posts->flip();
        // $collection = collect(['name' => 'taylor', 'framework' => 'laravel']);
        // $flipped = $collection->flip();
        // $result = $posts->forPage(5,2);
        // $result = $posts->groupBy('title');
        // $result = $posts->hasAny(['user_id','id']);
        $result = $posts->implode('id',',');
        $result = $posts->isNotEmpty();
        $result = $posts->last();
        $result = $posts->lazy();
        // $result = $posts->map(function($post){
        //     return ucWords($post->title);
        // });
        $collection = collect([12,34,67,13,88]);
        $result = $collection->max();
        $result = $collection->min();
        $result = $collection->median();

        $collection1 = collect([12,34,67,13,88,99]);
        $result = $collection->merge($collection1);
        $result = $collection->mode();
        $posts = Post::get();
        // $result = $posts->except(['title']);
        // $result = $posts->setVisible(['id','title']);
        $result = $collection1->random();
        $result = $users->reject(function($user){
            return $user->id == 1;
        });
        $result = $users->reverse();
        $result = $users->search(function($user){
            return $user->id == 2;
        });
        // $result = $users->shift(3);
        // $result = $users->shuffle();
        // $result = $users->skip(10);
        $result = $users->skipUntil(function($user){
            return $user->id > 10;
        });
        $collection = collect([1, 2, 3, 4]);
        $result = $collection->skipUntil(3);
        $result = $posts->skipWhile(function($post){
            return $post->user_id == 26;
        });
        $result = $users->slice(3,1)->values();
        $result = $users->sliding(3);
        return response()->json($result);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Perform user search based on the query
        $users = User::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($users);
    }
}
