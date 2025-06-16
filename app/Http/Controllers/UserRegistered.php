<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserRegistered extends Controller
{
    /**
 * @OA\Get(
 *     path="/register",
 *     summary="Formulario de registro",
 *     @OA\Response(response=200, description="Formulario de registro")
 * )
 */
    public function create(){
        return view('register');
    }

    public function store(){
        $validate = request()->validate([
            'name'     => ['required', 'min:3'],
            'email'    => ['required', 'email'],
            'password' => ['required', Password::min(6),'confirmed']
        ]);

        $inputValues['email']= request('email');
        $rules = ['email' => 'unique:users,email'];
        $validator = Validator::make($inputValues,$rules,['email.unique' => 'Este correo electrónico ya está registrado.']);

        if($validator->fails()){
            return back()
            ->withErrors($validator);
        }

        $user = User::create($validate);

        Auth::login($user);

        return redirect('/inicio');
    }
}
