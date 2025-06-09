<?php

namespace Tests;

use App\Models\Task;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //test de tareas
    public function crearTarea(){
        $task = Task::create([
            'title' => 'Tarea de prueba',
            'content' => 'Descripción de prueba',
            'status' => 'todo',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Tarea de prueba',
        ]);
    }
}
