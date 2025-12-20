<?php

namespace App\Services;

interface TodoServices{
    public function saveTodo(string $id, string $todo);
    public function getTodoList(): array;
    public function removeTodo(string $id);
}