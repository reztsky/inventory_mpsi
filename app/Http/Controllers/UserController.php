<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\ToastServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users=User::all(['name','id','alamat','no_telfon']);
        return view('users.index',compact('users'));
    }

    public function create(){
        $roles=Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(CreateUserRequest $request){
        $user=User::create($request->safe()->except('roles'));
        $user->assignRole($request->roles);

        if(!$user){
            return redirect()->route('user.index')->with('message',ToastServices::failed('Menambahkan'));
        }
        return redirect()->route('user.index')->with('message',ToastServices::success('Menambahkan'));
    }

    public function show($id){
        $user=User::findOrFail($id);
        return view('users.detail',compact('user'));
    }

    public function edit($id){
        $user=User::findOrFail($id);
        $roles=Role::pluck('name','name')->all();
        
        return view('users.edit',compact('user','roles'));
    }

    public function update(UpdateUserRequest $request,$id){
        //Retriving value from update user request
        $userUpdate=$request->safe()->except('roles');
        
        //Retriving value from request without update password
        if(!$request->filled('password')){
            $userUpdate=$request->safe()->except('password');
        }

        $user=User::find($id);
        $user->update($userUpdate);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->roles);

        if(!$user){
            return redirect()->route('user.index')->with('message',ToastServices::failed('Mengupdate'));
        }

        return redirect()->route('user.index')->with('message',ToastServices::success('Mengupdate')); 
    }

    public function delete($id){
        $user=User::find($id)->delete();
        if(!$user){
            return redirect()->route('user.index')->with('message',ToastServices::failed('Menghapus'));
        }
        return redirect()->route('user.index')->with('message',ToastServices::success('Menghapus'));
    }
}
