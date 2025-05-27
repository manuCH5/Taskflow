<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logs;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function getData()
    {
        if (Auth::guest()) {
            return redirect('login');
        }

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $equipo = $user->team_id;

        $teamMates = User::select()
            ->where('team_id', '=', $equipo)
            ->get();

        $logs = Logs::select()
            ->where('team_id', '=', $equipo)
            ->get();

        return view('equipo', [
            'user'      => $user,
            'teamMates' => $teamMates,
            'logs'      => $logs
        ]);
    }

    public function createTeamMember(Request $request)
    {
        $userId = Auth::user()->id;

        $user = User::find($userId);

        $teamId = $user->team_id;

        $userByAdmin = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => "1234567j",
            'rol'      => $request->role,
            'team_id'  => $teamId
        ];

        $user = User::create($userByAdmin);

        return (json_encode([
            'success' => true,
            'message' => "Miembro creado correctamente",
            'user'    => $user->id
        ]));
    }

    public function createTeam()
    {
        $user = Auth::user();

        $team = Team::create(
            [
                'name' => $user->name . 'Team'
            ]
        );

        $user->team_id = $team->id;
        $user->save();

        return (json_encode(['success' => true, 'message' => "Equipo creado correctamente"]));
    }

    public function getDatos(Request $request)
    {
        $idUser = $request->id;
        $user = User::find($idUser);
        return (json_encode(['success' => true, 'user' => $user]));
    }

    public function editTeamMember()
    {
        $id = request()->id;
        $name = request()->name;
        $email = request()->email;
        $rol = request()->role;

        $user = User::where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'rol' => $rol
            ]);

        return (json_encode([
            'success' => true,
            'message' => "Usuario actualizada correctamente"
        ]));
    }

    public function deleteTeamMember() {
    if (request()->id) {
        $user = User::find(request()->id);
        $user->delete();
        return (json_encode([
            'success' => true,
            'message' => "Usuario borrado correctamente"
        ]));
    }
}
}
