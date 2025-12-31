<?php

namespace App\Services\Implementations;

use App\Models\Todo;
use App\Services\TodoServices;
use Illuminate\Support\Facades\Session;

class TodoServicesImpl implements TodoServices{
    public function saveTodo(string $id, string $todo){
        $todo = new Todo([
            "id" => $id,
            "todo" => $todo
        ]);
        $todo->save();
    }
    public function getTodoList(): array{
        return Todo::query()->get()->toArray();
    }
    public function removeTodo(string $id){
        $todo = Todo::find($id);
        $todo->delete();
    }

}