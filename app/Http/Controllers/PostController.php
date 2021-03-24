<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Requests\post\UpdatePostRequest;
use App\Http\Requests\post\CreatePostRequest;



class PostController extends Controller
{
    /**
     *
     * @return JsonResponse for all posts
     *
     * @author ibrahem
     */
    public function index(){
        $posts = Post::all();
        return response()->json(['message' => $posts]);
    }

    /**
     * Get the post_id  .
     *
     * @return JsonResponse for specificed post
     *
     * @author ibrahem
     */

    public function show($id){
        $post = Post::find($id);
        return response()->json(['message' => $post]);
    }

    /**
     *
     *take data from request and validated it then store it into post table
     *
     * @author ibrahem
     */

    public function store(CreatePostRequest $request){
        $data = $request->validate($request->rules());
        $data +=['user_id' => auth()->id()];
        $data += ['created_at' => now()];
        Post::insert($data);
    }

    /**
     * Get the array of validated data the make to update post table.
     *
     * @author ibrahem
     */

    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->validate($request->rules());
        $post = Post::find($id);
        $post->Title = $data['Title'];
        $post->body = $data['body'];
        $post->created_at = now();
        $post->save();
    }

    /**
     * Get the post_id to delete the post .
     *
     * @author ibrahem
     */


    public function destroy($id){
        Post::find($id)->delete();
    }

}
