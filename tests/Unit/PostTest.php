<?php

namespace Tests\Unit;

use App\Http\Controllers\PostController;
use App\Http\Resources\Post\ShowPostResource;
use App\Models\User;
use Tests\TestCase;
use JWTAuth;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @author ibrahem
     */

    public function test_usr(){
        $aut_data=[];
        $post = new PostController();
        $aut_data += ['Title' => $post->show(1)->Title];
        $this->assertEquals(['Title'=> 'PHP'],$aut_data);
    }
    public function test_exampel(){
    }
}
