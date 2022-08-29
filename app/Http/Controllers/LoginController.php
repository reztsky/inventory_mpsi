<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function auth(SigninRequest $siginRequest){
        if(Auth::attempt($siginRequest->validated())){
            $siginRequest->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return back()->with('message','Login Failed, Check Username and Password');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
