<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
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
            'email'=>'admin'
        ])->get('/login')->assertRedirect('/');
    }
    public function testDoLoginSuccess(){
        $this->seed([UserSeeder::class]);
        $this->post('/login', [
            "email"=>"admin@gmail.com", "password"=>"rahasia"
        ])->assertRedirect('/');
    }
    public function testDoLoginAlready(){
        $this->withSession([
            'email'=>'admin'
        ])->post('/login', [
            "email"=>"admin", "password"=>"admin123"
        ])->assertRedirect('/');
    }
    public function testDoLoginEmpty(){
        $this->post('/login', [
            "email"=>"", "password"=>""
        ])
        ->assertSeeText('Email or Password is empty');
    }
    public function testDoLoginFalse(){
        $this->post('/login', [
            "email"=>"admin", "password"=>"fufufafa"
        ])
        ->assertSeeText('Email or Password is incorrect');
    }
    public function testDoLogout(){
        $this->withSession([
            'email'=>'admin'
        ])->post('/logout')->assertRedirect('/')->assertSessionMissing('user');
    }
    public function testDoLogoutForGuest(){
        $this->post('/logout')->assertRedirect('/');
    }
}
