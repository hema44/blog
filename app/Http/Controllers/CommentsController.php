<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //this function used for insert data to comment table
    public function store(Request $request){
        $comment = new Comments;
        $comment->post_id = $request->post_id;
        $comment->user_id=$request->user_id;
        $comment->body=$request->body;
        $comment->save();
    }
    // this function used for gete all comments data
    public function index(){
        return Comments::all();
    }

    //this used for delete comment data by id
    public function destroy($id){
        $comment = Comments::find($id);
        $comment->delete();
    }
}
