<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //this function used for insert the post
    public function store(Request $request){
        $Posts = new Posts;
        $Posts->Title = $request->Title;
        $Posts->body = $request->body;
        $Posts->user_id = $request->user_id;
        $Posts->save();
    }
    //this function for get all data from post table
    public function index(){
        return  Posts::all();

    }
    //this function used o delete posts and related comment
    public function destroy($post_id){
        $post = Posts::find($post_id);
        $post->delete();
    }

}
