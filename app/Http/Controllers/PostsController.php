<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use App\Models\User;
use App\Http\Requests\PostRequest;

use Tymon\JWTAuth\Exception\UserNotDefinedException;

class PostsController extends Controller
{
    //this function  get all data from post table
    public function index(){
        return Posts::all();
    }

    //this function is used for show selected post
    public function show($id){
        return Posts::find($id);
    }
    //this function used for insert the post
    public function store(PostRequest $request){
        $Posts = new Posts;
        $Posts->Title = $request->Title;
        $Posts->body = $request->body;
        $Posts->user_id = auth()->user()->getAuthIdentifier();
        $Posts->save();
    }

    //this function used for update the post
    public function update(PostRequest $request, $id)
    {
        $post = Posts::find($id);
        $post->Title = $request->Title;
        $post->body = $request->body;
        $post->save();

    }

    //this function used o delete posts and related comment
    public function destroy($post_id){
        $post = Posts::find($post_id);
        $post->delete();
    }

}
