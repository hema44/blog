<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\CollectionUserResource;
use App\Http\Resources\User\createdUserResource;
use App\Jobs\SendMail;
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
        $data = $request->validated();
        $post_image = $_FILES['image']['name'];
        $data['image'] = $post_image;
        $data['password'] = bcrypt($data['password'] );
        User::create($data);
        SendMail::dispatch($data['email']);
        $data = new createdUserResource('user is inserted' );
        return response()->json(['data'=> $data],'200',[], JSON_FORCE_OBJECT);
    }

    /**
     *
     * @return JsonResponse for all user data
     *
     * @author ibrahem
     */

    public function index(){
        $data = new CollectionUserResource(User::all());
        return response()->json(['$data'=> $data],200,[],JSON_FORCE_OBJECT);
    }

    /**
     *
     * Get user_id to delete the user and all has posts and comments
     *
     * @author ibrahem
     */

    public function destroy($id){
        User::find($id)
        ->delete();
        $data = 'user is deleted';
        return response()->json(['data'=>$data],200,[],JSON_FORCE_OBJECT);
    }
    public function shownotifiction(){
        $user = auth()->user();
        $data = [];
        foreach ($user->notifications as $not){
            $data +=['notify' => $not->data];
        }
        return response()->json(['massage'=>$data],200,[]);
    }
}
