<?php

namespace Tests\Unit;

use App\Http\Controllers\PostController;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $data = [
            'id'=> 1,
            'Title'=>'PHP',
            'body'=>'ddd',
            'user_id' =>1,
            'created_at'=>"2021-04-01T12:53:04.000000Z",
            'updated_at'=>"2021-04-01T12:53:04.000000Z"
        ];
       $comperwd =  response()->json(['data'=> $data] , 200 , [] ,JSON_FORCE_OBJECT);
       $post = new PostController();
       $aut_data = $post->show(1);
//       $this->assertEquals($comperwd,$aut_data);
        $this->assertTrue($aut_data === $comperwd);
    }
}
