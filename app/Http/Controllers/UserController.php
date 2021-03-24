<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
use App\Models\User;


class UserController extends Controller
{

    /**
     *
     *take data from request and validated it then store it into user table
     *
     * @author ibrahem
     */

    public function store(CreateUserRequest $request){
        $data = $request->validate($request->rules());
        $data['password'] = bcrypt($data['password'] );
        User::create($data);
    }
    /**
     *
     * @return JsonResponse for all user data
     *
     * @author ibrahem
     */

    public function index(){
        return User::all();
    }

    /**
     *
     * Get user_id to delete the user and all has posts and comments
     *
     * @author ibrahem
     */

    public function destroy($id){
        User::where('id',$id)
        ->delete();
    }
}
