<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use Tests\TestCase;


class WelcomeTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = new UserController();
        $data = $user->show(1)->email;
        $test_data = 'mansourtony44@gmail.com';
        $this->assertEquals($test_data,$data);
    }
}
