<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatCommentRequest;
use App\Http\Requests\UpdatecommentRequest;
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
    public function store(CreatCommentRequest $request){
        Comments::insert([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'body' => $request->body,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
    }

    //public function used for update comment
    public function update(UpdatecommentRequest $request, $id){
        Comments::where('id',$id)
        ->updated([
            'body'=> $request->body,
            'updated_at'=> now()
        ]);
    }

    //this used for delete comment data by id
    public function destroy($id){
        Comments::find($id)->delete();
    }
}
