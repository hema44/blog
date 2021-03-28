<?php

namespace App\Http\Controllers;

use App\Http\Requests\comment\CreateCommentRequest;
use App\Http\Requests\comment\UpdateCommentRequest;
use App\Http\Resources\comment\CollectionCommentResource;
use App\Http\Resources\comment\ShowCommentResource;
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
        return new CollectionCommentResource(Comment::all(), 200, [], JSON_FORCE_OBJECT);
    }

    /**
     * Get the comment_id  .
     *
     * @return JsonResponse for specificed comment
     *
     * @author ibrahem
     */

    public function show($id){
        return new ShowCommentResource(Comment::find($id), 200, [], JSON_FORCE_OBJECT);
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
        Comment::create($data);
        return response()->json(['massage'=> 'you comment is insered'], 200, [], JSON_FORCE_OBJECT);
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
        return response()->json(['massage'=> 'you comment is updated'], 200, [], JSON_FORCE_OBJECT);
    }

    /**
     * Get the post_id to delete the post .
     *
     * @author ibrahem
     */

    public function destroy($id){
        Comment::find($id)->delete();
        return response()->json(['massage'=> 'you comment is deleted'], 200, [], JSON_FORCE_OBJECT);
    }
}
