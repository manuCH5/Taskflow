<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserRegistered;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Models\Logs;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;

use function Laravel\Prompts\select;

/**
 * @OA\Get(
 *     path="/",
 *     summary="Landing page",
 *     @OA\Response(response=200, description="Página de bienvenida")
 * )
 */
//Landing page
Route::get('/', function () {
    return view('welcome');
});

//Register page
/**
 * @OA\Get(
 *     path="/register",
 *     summary="Formulario de registro",
 *     @OA\Response(response=200, description="Formulario de registro")
 * )
 */
Route::get('/register', [UserRegistered::class, 'create']);
/**
 * @OA\Post(
 *     path="/register",
 *     summary="Registro de usuario",
 *     @OA\RequestBody(required=true, description="Datos de usuario"),
 *     @OA\Response(response=200, description="Usuario registrado")
 * )
 */
Route::post('/register', [UserRegistered::class, 'store']);
//Login page
/**
 * @OA\Get(
 *     path="/login",
 *     summary="Formulario de login",
 *     @OA\Response(response=200, description="Formulario de login")
 * )
 */
Route::get('/login', [SessionController::class, 'create']);
/**
 * @OA\Post(
 *     path="/login",
 *     summary="Iniciar sesión",
 *     @OA\RequestBody(required=true, description="Credenciales"),
 *     @OA\Response(response=200, description="Sesión iniciada")
 * )
 */
Route::post('/login', [SessionController::class, 'store']);
/**
 * @OA\Post(
 *     path="/logout",
 *     summary="Cerrar sesión",
 *     @OA\Response(response=200, description="Sesión cerrada")
 * )
 */
Route::post('/logout', [SessionController::class, 'destroy']);
//Dashboard
Route::get('/inicio', function () {
    if (Auth::guest()) {
        return redirect('login');
    }
    $user_id = Auth::user()->id;

    $user = User::find($user_id);

    $equipo = $user->team_id;

    $teamMates = User::select()
        ->where('team_id', '=', $equipo)
        ->get();

    $fecha = date('d/m/Y');

    $totalTasks = Task::where('user_id', '=', $user_id)->get()->count();
    $totalStopTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'stop')->get()->count();
    $totalTodoTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'todo')->get()->count();
    $totalProgressTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'progress')->get()->count();
    $totalDoneTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'done')->get()->count();

    $today = new DateTime();
    $dayOfYear = (int)$today->format('z') + 1;

    return view('inicio', [
        'user'               => $user,
        'teamMates'          => $teamMates,
        'fecha'              => $fecha,
        'totalTasks'         => $totalTasks,
        'totalStopTasks'     => $totalStopTasks,
        'totalTodoTasks'     => $totalTodoTasks,
        'totalProgressTasks' => $totalProgressTasks,
        'totalDoneTasks'     => $totalDoneTasks,
        'dayOfYear'          => $dayOfYear
    ]);
});

Route::get('/inicio/getData', function () {
    if (Auth::guest()) {
        return redirect('login');
    }

    $user_id = Auth::user()->id;
    $totalTasks = Task::where('user_id', '=', $user_id)->get()->count();
    $totalStopTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'stop')->get()->count();
    $totalTodoTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'todo')->get()->count();
    $totalProgressTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'progress')->get()->count();
    $totalDoneTasks = Task::where('user_id', '=', $user_id)
        ->where('status', '=', 'done')->get()->count();

    return (json_encode([
        'totalTasks'         => $totalTasks,
        'totalStopTasks'     => $totalStopTasks,
        'totalTodoTasks'     => $totalTodoTasks,
        'totalProgressTasks' => $totalProgressTasks,
        'totalDoneTasks'     => $totalDoneTasks
    ]));
});

//Tasks
Route::get('/tareas', [TaskController::class, 'getTasks']);

Route::post('/tareas/create', [TaskController::class, 'createTasks']);

Route::post('/tareas/getData', [TaskController::class, 'getData']);

Route::post('/tareas/edit', [TaskController::class, 'editTasks']);

Route::post('/tareas/delete', [TaskController::class, 'deleteTasks']);

//Team

Route::get('/equipo', [TeamController::class,'getData']);

Route::post('/equipo/create', [TeamController::class,'createTeamMember']);

Route::post('/equipo/createTeam', [TeamController::class,'createTeam']);

Route::post("/equipo/getDatos", [TeamController::class,'getDatos']);

Route::post("/equipo/edit", [TeamController::class,'editTeamMember']);

Route::post("/equipo/delete", [TeamController::class,'deleteTeamMember']);

Route::get('/incidencias', function () {
    if (Auth::guest()) {
        return redirect('login');
    }
    return view('incidencias');
});

Route::post('/incidencias',function (Request $request){
    $contenido = $request->content;
    $email = $request->email;
    Mail::to('4237684@alu.murciaeduca.es')->send(new TestMail($contenido,$email));

    return view('incidencias');
});