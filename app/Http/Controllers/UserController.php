<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
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
        $this->sendmail($data['email']);
        User::insert($data);
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
     * @sending  welcome Email when user login in the system
     *
     * @author ibrahem
     */
    public function sendmail($email){
        $details = [
          'name'=> 'successfully login in HOVO ',
          'email' => $email
        ];
        Mail::send('welcome_email', $details, function ($message) use ($details) {
            $message->to($details['email'], $details['name'])
                ->subject('Thanks for be one of Hovo family')
                ->from('info@mynotepaper.com');
        });
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
