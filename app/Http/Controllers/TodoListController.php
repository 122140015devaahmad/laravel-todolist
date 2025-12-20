<?php

namespace App\Http\Controllers;

use App\Services\TodoServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    private TodoServices $todoServices;

    public function __construct(TodoServices $todoServices){
        $this->todoServices = $todoServices;
    }
    public function todoList(Request $request){
        return response()->view('todolist.todolist',[
            "title" => "Todo List",
            "todolist" => $this->todoServices->getTodoList()
        ]);
    }
    public function addTodo(Request $request){
        $todo = $request->input('todo');

        if(empty($todo)){
            return response()->view('todolist.todolist',[
                "title" => "Todo List",
                "todolist" => $this->todoServices->getTodoList(),
                "error" => "Todo is required"
            ]);
        }

        $this->todoServices->saveTodo(uniqid(), $todo);

        return redirect()->action([TodoListController::class, 'todoList']);
    }
    public function deleteTodo(Request $request, string $todoId){
        $this->todoServices->removeTodo($todoId);
        return redirect()->action([TodoListController::class, 'todoList']);
    }
}
