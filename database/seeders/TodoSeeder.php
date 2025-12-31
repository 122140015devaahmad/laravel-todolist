<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::create([
            "id" => "12345",
            "todo" => "belajar laravel"
        ]);
        Todo::create([
            "id" => "23456",
            "todo" => "belajar react"
        ]);
    }
}
