<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\ToastServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users=User::all(['name','id','alamat','no_telfon']);
        return view('users.index',compact('users'));
    }

    public function create(){
        $roles=Role::all();
        return view('users.create',compact('roles'));
    }

    public function store(CreateUserRequest $request){
        $user=User::create($request->validated());
        if(!$user){
            return redirect()->route('user.index')->with('message',ToastServices::failed('Menambahkan'));
        }
        return redirect()->route('user.index')->with('message',ToastServices::success('Menambahkan'));
    }
}
