<?php

namespace App\Http\Controllers;
use App\Http\Resources\Post\CollectionPostResource;
use App\Http\Resources\Post\ShowPostResource;
use App\Models\Post;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\CreatePostRequest;
use App\Notifications\NewPostNotification;


class PostController extends Controller
{
    /**
     *
     * @return JsonResponse for all posts
     *
     * @author ibrahem
     */
    public function index(){
        $data = new CollectionPostResource(Post::all());
        return response()->json(['data' => $data] , 200, [], JSON_FORCE_OBJECT);
    }

    /**
     * Get the post_id  .
     *
     * @return JsonResponse for specificed post
     *
     * @author ibrahem
     */

    public function show($id){
        $data = new ShowPostResource(post::find($id));
        return response()->json(['data'=> $data] , 200 , [] ,JSON_FORCE_OBJECT);
    }

    /**
     *
     *take data from request and validated it then store it into post table
     *
     * @author ibrahem
     */

    public function store(CreatePostRequest $request){
        $data =$request->validated();
        $data +=['user_id' => auth()->id()];
        Post::create($data);
        $user = auth()->user();
        $user->notify(new NewPostNotification($request));
        return response()->json(['massage'=> 'your post is inserted '],200,[],JSON_FORCE_OBJECT);
    }

    /**
     * Get the array of validated data the make to update post table.
     *
     * @author ibrahem
     */

    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->validated();
        $data += ['updated_at' => now()];
        Post::Where('id',$id)->update($data);
        return response()->json(['massage'=> 'your post is updated '],200,[],JSON_FORCE_OBJECT);
    }

    /**
     * Get the post_id to delete the post .
     *
     * @author ibrahem
     */


    public function destroy($id){
        Post::find($id)->delete();
        return response()->json(['massage'=> 'your post is deleted '],200,[],JSON_FORCE_OBJECT);
    }

}
