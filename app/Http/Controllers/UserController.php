<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // function will store data to user table
    public function store(Request $request){
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $result = $user->save();
        if($result){
            return 'done';
        }else{
            return 'erro';
        }
    }
//this function will retreie all user data
    public function show(){
        return User::all();
    }
    //this function will delete user by useing user_id
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
    }
}
