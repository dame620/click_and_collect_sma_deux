<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistrationFormRequest;

class RegistrationController extends Controller
{
    public function index(RegistrationFormRequest $request)
    {
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'telephone'   => $request->telephone,
            'adresse'     => $request->adresse,
            'dateofbirth' => $request->dateofbirth,
            'password'    => Hash::make($request->password),
        ]);

        if ($user) {

            Auth::loginUsingId($user->id, true);

            return response()->json([
                'success' => true,
                'user'    => $user,
                'message' => 'VOtre compte a bien été créé.',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'user'    => null,
            'message' => 'Une erreur est survenue lors de la création de votre compte.',
        ]);
    }
}
