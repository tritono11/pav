<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //
    public function table(){
        $data['roles'] = Role::all();
        return view('admin.roles.list', $data);
    }
}
