<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    // this function used for gete all comments data
    public function index(){
        return Comments::all();
    }
    //this function is used for show selected comment
    public function show($id){
        return Comments::find($id);
    }

    //this function used for insert data to comment table
    public function store(Request $request){
        $comment = new Comments;
        $comment->post_id = $request->post_id;
        $comment->user_id=auth()->user()->getAuthIdentifier();
        $comment->body=$request->body;
        $comment->save();
    }

    //public function used for update comment
    public function update(Request $request,$id){
        $post = Comments::find($id);
        $post->Title = $request->post_id;
        $post->body = $request->body;
        $post->save();
    }

    //this used for delete comment data by id
    public function destroy($id){
        $comment = Comments::find($id);
        $comment->delete();
    }
}
