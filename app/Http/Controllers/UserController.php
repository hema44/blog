<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
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
        $image = $this->storeimage();
        $data['image'] = $image;
        $data['password'] = bcrypt($data['password'] );
        $data += ['created_at' => now()];
        User::insert($data);
        SendMail::dispatch($data['email']);
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
