<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin(){
        $this->get('/login')->assertStatus(200)->assertSeeText('Login Management');
    }
    public function testLoginPageForMember(){
        $this->withSession([
            'user'=>'admin'
        ])->get('/login')->assertRedirect('/');
    }
    public function testDoLoginSuccess(){
        $this->post('/login', [
            "user"=>"admin", "password"=>"admin123"
        ])->assertRedirect('/');
    }
    public function testDoLoginAlready(){
        $this->withSession([
            'user'=>'admin'
        ])->post('/login', [
            "user"=>"admin", "password"=>"admin123"
        ])->assertRedirect('/');
    }
    public function testDoLoginEmpty(){
        $this->post('/login', [
            "user"=>"", "password"=>""
        ])
        ->assertSeeText('User or Password is empty');
    }
    public function testDoLoginFalse(){
        $this->post('/login', [
            "user"=>"admin", "password"=>"fufufafa"
        ])
        ->assertSeeText('User or Password is incorrect');
    }
    public function testDoLogout(){
        $this->withSession([
            'user'=>'admin'
        ])->post('/logout')->assertRedirect('/')->assertSessionMissing('user');
    }
    public function testDoLogoutForGuest(){
        $this->post('/logout')->assertRedirect('/');
    }
}
