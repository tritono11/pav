<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    //
    public function table(){
        $data['users'] = \App\User::select('id', 'name', 'email')->paginate(15);
        return view('admin.users.list', $data);
    }
    
    public function edit($id){
        try{
            $id = decrypt($id);
            $data['user'] = User::find($id);
            return view('admin.users.edit', $data);
        } catch (DecryptException $e) {
 
        }
    }
}
