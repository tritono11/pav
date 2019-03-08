<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //
    public function table()
    {
        $data['roles'] = Role::all();
        return view('admin.roles.list', $data);
    }
    
    public function add()
    {
        return view('admin.roles.add');
    }
    
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $role = Role::create($input);
        return redirect()->route('admin.role.edit', ['id' => encrypt($role->id) ])->with('success', __('generic.success.store'));
    }
    
    public function edit($id)
    {
        try{
            $id = decrypt($id);
            $data['role'] = Role::findById($id);
            return view('admin.users.edit', $data);
        } catch (DecryptException $e) {
 
        }
    }
}
