<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    protected function setUp(): void{
        parent::setUp();
        DB::delete("DELETE FROM todos");
    }
    public function testTodoList(){
        $this->seed([TodoSeeder::class]);
        $this->withSession([
            "email"=>"admin@gmail.com",
        ])->get("/todolist")
        ->assertStatus(200)
        ->assertSeeText("1")
        ->assertSeeText("belajar laravel")
        ->assertSeeText("2")
        ->assertSeeText("belajar react");
    }
    public function testTodoListAddFailed(){
        $this->withSession([
            "email"=>"admin@gmail.com",
        ])->post("/todolist", [])
        ->assertSeeText("Todo is required");
    }
    public function testTodoListAddSuccess(){
        $this->withSession([
            "email"=>"admin@gmail.com",
        ])->post("/todolist", [
            "todo" => "Membaca Buku"
        ])->assertRedirect("/todolist");
    }
    public function testTodoListDelete(){
        $this->seed([TodoSeeder::class]);
        $this->withSession([
            "email"=>"admin@gmail.com",
        ])->post("/todolist/12345/delete")->assertRedirect("/todolist");
    }
}
