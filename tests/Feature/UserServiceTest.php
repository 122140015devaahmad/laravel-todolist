<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserServices $userServices;

    public function setUp(): void
    {
        parent::setUp();
        $this->userServices = $this->app->make(UserServices::class);
        echo "Setup UserServiceTest\n";
    }
    public function testSample(){
        $this->assertTrue(true);
    }
    public function testLoginSuccess(){
        $this->assertTrue($this->userServices->login('admin', 'admin123'));
    }
    public function testLoginFail(){
        $this->assertFalse($this->userServices->login('admin', 'admin'));
    }
}
