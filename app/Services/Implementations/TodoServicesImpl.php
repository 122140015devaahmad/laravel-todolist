<?php

namespace App\Services\Implementations;

use App\Services\TodoServices;
use Illuminate\Support\Facades\Session;

class TodoServicesImpl implements TodoServices{
    public function saveTodo(string $id, string $todo){
        if(!Session::exists("todolist")){
            Session::put("todolist", []);
        }
        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }
    public function getTodoList(): array{
        return Session::get("todolist", []);
    }
    public function removeTodo(string $id){
        $todolist = Session::get("todolist");
        foreach ($todolist as $key => $todo){
            if($todo['id'] === $id){
                unset($todolist[$key]);
                break;
            }
        }
        Session::put("todolist", $todolist);
    }

}