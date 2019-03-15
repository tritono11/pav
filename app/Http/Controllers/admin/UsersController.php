<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;

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
            $data['roles'] = Role::all();
            return view('admin.users.edit', $data);
        } catch (DecryptException $e) {
 
        }
    }
    
    public function update(\App\Http\Requests\UserFormRequest $request, $id)
    {
        try{
            $id             = decrypt($id)['id'];
            $input          = $request->except('_token');
            $user           = User::find($id);
            $data['roles']  = Role::all();
            $arrRoles       = [];
            foreach ($data['roles'] as $a){
                $arrRoles[] = $a->name;
            }
            foreach ($input as $k => $v) {
                if ( !in_array($k , $arrRoles) ){
                    $user->$k = $v;
                }
            }
            $user->save();
            foreach ($input as $k => $v) {
                if ( in_array($k , $arrRoles) && $k != 'admin' ){
                    if ( $v == 'Y' ){
                        $user->assignRole($k);
                    }
                    if ( $v == 'N' ){
                        $user->removeRole($k);
                    }
                }
            }
            
            $qs = encrypt($user->id);
            return redirect()->route('admin.users.edit', $qs)->with('success', __('generic.success.update'));
        } catch (DecryptException $e) {
 
        }
        
    }
}
