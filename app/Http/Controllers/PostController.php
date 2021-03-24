<?php

namespace App\Http\Controllers;
use App\Http\Resources\post\CollectionPostResource;
use App\Http\Resources\post\ShowPostResource;
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

        return new CollectionPostResource(Post::all(), 200, [], JSON_FORCE_OBJECT);
    }

    /**
     * Get the post_id  .
     *
     * @return JsonResponse for specificed post
     *
     * @author ibrahem
     */

    public function show($id){
        return new ShowPostResource(Post::find($id) , 200 , [] ,JSON_FORCE_OBJECT);
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
        $data += ['created_at' => now()];
        Post::insert($data);
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
