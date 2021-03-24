<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use App\Http\Requests\UpdatePostsRequest;
use App\Http\Requests\CreatPostRequest;


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
    public function store(CreatPostRequest $request){
        Posts::insert([
            'Title' => $request->Title,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    //this function used for update the post
    public function update(UpdatePostsRequest $request, $id)
    {
        Posts::where('id',$id)
            ->update([
            'Title' => $request->Title,
            'body' => $request->body,
            'updated_at' => now()
        ]);

    }

    //this function used o delete posts and related comment
    public function destroy($id){
        Posts::find($id)->delete();
    }

}
