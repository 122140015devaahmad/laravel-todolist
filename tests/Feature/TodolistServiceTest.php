<?php

namespace Tests\Feature;

use App\Services\TodoServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodoServices $todoServices;
    protected function setUp(): void{
        parent::setUp();
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
        $todolist = Session::get("todolist");
        foreach ($todolist as $todo){
            $this->assertEquals("1", $todo['id']);
            $this->assertEquals("test", $todo['todo']);
        }
    }
    public function testGetTodo(){
        $this->todoServices->saveTodo('1', 'test');
        $this->assertEquals([['id' => '1', 'todo' => 'test']], $this->todoServices->getTodoList());
    }
    public function testGetTodoEmpty(){
        $this->assertEquals([], $this->todoServices->getTodoList());
    }
    public function testRemoveTodo(){
        $this->todoServices->saveTodo("1", "test");
        $this->todoServices->saveTodo("2", "test2");

        $this->assertEquals(2, sizeof($this->todoServices->getTodoList()));
        $this->todoServices->removeTodo("3");
        $this->assertEquals(2, sizeof($this->todoServices->getTodoList()));
        $this->todoServices->removeTodo("1");
        $this->assertEquals(1, sizeof($this->todoServices->getTodoList()));
        $this->todoServices->removeTodo("2");
        $this->assertEquals(0, sizeof($this->todoServices->getTodoList()));

    }
}
