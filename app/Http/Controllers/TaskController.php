<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Models\User;
use Mockery\Undefined;

class TaskController extends Controller
{
    public function getTasks()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        $user = Auth::user();
        $user_id = $user->id;

        $tasks = Task::where('user_id', $user_id)->get();

        $stop = Task::where('user_id', $user_id)->where('status', 'stop')->count();
        $todo = Task::where('user_id', $user_id)->where('status', 'todo')->count();
        $progress = Task::where('user_id', $user_id)->where('status', 'progress')->count();
        $done = Task::where('user_id', $user_id)->where('status', 'done')->count();

        $teamId = User::where('id','=',$user_id)
        ->value('team_id');

        $users="";

        if($teamId){
            $users = User::select()
            ->where('team_id', '=', $teamId)
            ->get();
        }

        $count = [
            'stop' => $stop,
            'todo' => $todo,
            'progress' => $progress,
            'done' => $done,
        ];
        return view(
            'tareas',
            [
                'tasks' => $tasks,
                'count' => $count,
                'user'  => $user,
                'users' => $users
            ]
        );
    }

    public function createTasks()
    {
        $user_id = Auth::user()->id;
        if (isset(request()->title) && isset(request()->content) && isset(request()->status) && isset(request()->asignFor)) {
            $title = request()->title;
            $status = request()->status;
            $content = request()->content;
            $asignFor = request()->asignFor;
            $task = Task::create([
                'title'     => $title,
                'status'    =>  $status,
                'content'   =>  $content,
                'user_id'   =>  $asignFor
            ]);

            return (json_encode([
                'success' => true,
                'message' => "Tarea creada correctamente",
                'id'      => $task->id,
                'user_id' => $user_id
            ]));
        }
    }

    public function getData(){
        if(isset(request()->id)){
            $task = Task::find(request()->id);

            return (json_encode([
                'success' => true,
                'message' => "Datos obtenidos",
                'task'      => $task,
            ]));
        }
    }

    public function editTasks()
    {
        $user_id = Auth::user()->id;
        if (isset(request()->content) && isset(request()->id) && isset(request()->content)) {
            $id = request()->id;
            $title = request()->title;
            $content = request()->content;
            $task = Task::where('id', $id)
                ->update([
                    'title'   => $title,
                    'content' => $content
                ]);

            return (json_encode([
                'success' => true,
                'message' => "Tarea actualizada correctamente"
            ]));
        } elseif (isset(request()->id) && request()->state) {
            $id = request()->id;
            $state = request()->state;
            $task = Task::where('id', $id)
                ->update([
                    'status' => $state
                ]);
            $taskName = Task::where('id',$id)->value('title');

            if($state == "done"){
                Logs::create([
                    'content' => sprintf("%s ha finalizado la tarea:  %d-%s",Auth::user()->name,$id,$taskName),
                    'team_id' => Auth::user()->team_id
                ]);
            }

            return (json_encode([
                'success' => true,
                'message' => "Tarea actualizada correctamente"
            ]));
        }
    }

    public function deleteTasks()
    {
        if (isset(request()->id)) {
            $id = request()->id;
            $task = Task::find($id);
            $task->delete();

            return (json_encode([
                'success' => true,
                'message' => "Tarea borrada correctamente"
            ]));
        }
    }
}
