<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * function to show login form
     */
    public function index(){
        return view('auth.login');
    }

    /**
     * function to authenticate user
     */
    public function login(LoginRequest $request){
        $validatedData = $request->validated();
        if(auth()->attempt($validatedData)){
            return redirect()->route('feedbacksList')->with('success','Logged in Successfully');
        }else{
            return back()->withErrors(['email'=>'Wrong email or password']);
        }
    }

    public function logout(){
        if (Auth::check()) {
            Auth::logout();
            return view('auth.login')->with('success', 'Logged out successfully');
        } else {
            return redirect()->back()->with('success','Logout Fialed');
        }

    }
}
