<?php

namespace App\Http\Controllers;

use App\Services\ToastServices;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles=Role::all();
        return view('roles.index',compact('roles'));
    }

    public function create(){
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
        
        $role = Role::create(['name' => $request->role_name]);
        $role->syncPermissions($request->input('permissions'));
    
        return redirect()->route('role.index')->with('message',ToastServices::success('Menambahkan'));
    }

    public function edit($id){
        $role=Role::findOrFail($id);
        $permissions = Permission::get();
        return view('roles.edit',compact('role','permissions'));
    }

    public function update(Request $request,$id){
        
        $this->validate($request, [
            'role_name' => 'required',
            'permissions' => 'required',
        ]);

        $role=Role::findOrFail($id);
        $role->name=$request->role_name;
        $role->save();

        $role->syncPermissions($request->permissions);
        return redirect()->route('role.index')->with('message',ToastServices::success('Mengubah'));
    }
}
