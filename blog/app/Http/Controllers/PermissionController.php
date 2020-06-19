<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Permission;

class PermissionController extends Controller
{
    //
    public function index(){

        return view('admin.permissions.index',[
           
            'permissions' => Permission::all()
        ]);
    }
    public function store(){

        request()->validate([
            'name'=>['required']

        ]);
        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();

    }
    public function edit(Permission $permission){

        return view('admin.permissions.edit', [
            
            'permission'=>$permission
            
            ]);
    }
    public function destroy(Permission $permission){

    $permission->delete();
    return back();

    }
}
