<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserServices $userServices;

    public function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM users");
        $this->userServices = $this->app->make(UserServices::class);
        echo "Setup UserServiceTest\n";
    }
    public function testSample(){
        $this->assertTrue(true);
    }
    public function testLoginSuccess(){
        $this->seed([UserSeeder::class]);
        $this->assertTrue($this->userServices->login('admin@gmail.com', 'rahasia'));
    }
    public function testLoginFail(){
        $this->assertFalse($this->userServices->login('admin@gmail.com', 'admin'));
    }
}
