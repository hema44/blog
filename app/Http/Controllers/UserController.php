<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
use App\Http\Resources\user\createdUserResource;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\Mail;
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
        return new createdUserResource('userr is inserted' , 200 , [] ,JSON_FORCE_OBJECT);
    }
    /**
     *
     * @return image_name after uploaded it in  public/images/user/
     *
     * @author ibrahem
     */
    public function storeimage(){
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($post_image_temp,"images/user/$post_image");
        return $post_image;
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
        User::find($id)
        ->delete();
    }
}
