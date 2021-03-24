<?php

namespace App\Http\Controllers;

use App\Http\Requests\comment\CreateCommentRequest;
use App\Http\Requests\comment\UpdateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     *
     * @return JsonResponse for all comments
     *
     * @author ibrahem
     */

    public function index(){
        return response()->json(['message' => Comment::all()]);
    }

    /**
     * Get the comment_id  .
     *
     * @return JsonResponse for specificed comment
     *
     * @author ibrahem
     */

    public function show($id){
        return response()->json(['message' => Comment::find($id)]);
    }

    /**
     *
     *take data from request and validated it then store it into comment table
     *
     * @author ibrahem
     */
    public function store(CreateCommentRequest $request){
        $data = $request->validated();
        $data +=['user_id' => auth()->id()];
        $data +=['created_at'=> now()];
        Comment::insert($data);
    }

    /**
     * Get comment_id
     *
     * then Get the array of validated data and make  update to post table.
     *
     * @author ibrahem
     */

    public function update(UpdateCommentRequest $request, $id){
        $data = $request->validated();
        $data +=['updated_at' => now()];
        Comment::where('id',$id)->update($data);
    }

    /**
     * Get the post_id to delete the post .
     *
     * @author ibrahem
     */

    public function destroy($id){
        Comment::find($id)->delete();
    }
}
