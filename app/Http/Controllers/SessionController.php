<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('login');
    }

    public function store(){
        $validate = request()->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        if(!Auth::attempt($validate)){
            throw ValidationException::withMessages(['email' => 'Las credenciales son incorrectas']);
        }

        request()->session()->regenerate();

        return redirect('/inicio');
    }

    public function destroy(){
        Auth::logout();

        return redirect('/');
    }
}
