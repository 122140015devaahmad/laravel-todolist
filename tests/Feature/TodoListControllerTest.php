<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
{
    public function testTodoList(){
        $this->withSession([
            "user"=>"user123",
            "todolist"=>[
                ["id"=>"1", "todo"=>"test"],
                ["id"=>"2", "todo"=>"bejo"]
            ]
        ])->get("/todolist")
        ->assertStatus(200)
        ->assertSeeText("1")
        ->assertSeeText("test")
        ->assertSeeText("2")
        ->assertSeeText("bejo");
    }
    public function testTodoListAddFailed(){
        $this->withSession([
            "user"=>"user123",
        ])->post("/todolist", [])
        ->assertSeeText("Todo is required");
    }
    public function testTodoListAddSuccess(){
        $this->withSession([
            "user"=>"user123",
        ])->post("/todolist", [
            "todo" => "Membaca Buku"
        ])->assertRedirect("/todolist");
    }
    public function testTodoListDelete(){
        $this->withSession([
            "user"=>"user123",
            "todolist"=>[
                ["id"=>"1", "todo"=>"test"],
                ["id"=>"2", "todo"=>"bejo"]
            ]
        ])->post("/todolist/1/delete")->assertRedirect("/todolist");
    }
}
