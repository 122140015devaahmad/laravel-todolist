<?php

namespace Tests\Feature;

use App\Services\TodoServices;
use Database\Seeders\TodoSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodoServices $todoServices;
    protected function setUp(): void{
        parent::setUp();
        DB::delete("DELETE FROM todos");
        $this->todoServices = $this->app->make(TodoServices::class);
    }
    public function testSample(){
        $this->assertTrue(true);
    }
    public function testTodoListNotNull(){
        $this->assertNotNull($this->todoServices);
    }
    public function testSaveTodoSuccess(){
        $this->todoServices->saveTodo('1', 'test');
        $todo = $this->todoServices->getTodoList();
        $this->assertEquals("1", $todo[0]['id']);
        $this->assertEquals("test", $todo[0]['todo']);
    }
    public function testGetTodo(){
        $this->seed([TodoSeeder::class]);
        $todo = $this->todoServices->getTodoList();
        $this->assertEquals("12345", $todo[0]['id']);
        $this->assertEquals("belajar laravel", $todo[0]['todo']);
    }
    public function testGetTodoEmpty(){
        $this->assertEquals([], $this->todoServices->getTodoList());
    }
    public function testRemoveTodo(){
        $this->seed([TodoSeeder::class]);
        $this->assertEquals(2, sizeof($this->todoServices->getTodoList()));
        $this->todoServices->removeTodo("12345");
        $this->assertEquals(1, sizeof($this->todoServices->getTodoList()));
        $this->todoServices->removeTodo("23456");
        $this->assertEquals(0, sizeof($this->todoServices->getTodoList()));
    }
}
