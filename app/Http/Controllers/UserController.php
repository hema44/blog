<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;


class UserController extends Controller
{

    // function will store data to user table
    public function store(UserRequest $request){
        User::create([
            'email' => $request->email,
             'name' => $request->name,
            'password' => bcrypt($request->password)
        ]);
    }
//this function will retreie all user data
    public function index(){
        return User::all();
    }
    //this function will delete user by useing user_id
    public function destroy($id){
        User::where('id',$id)
        ->delete();
    }
}
