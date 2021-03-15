<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index(LoginFormRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::loginUsingId($user->id, true);

            return response()->json([
                'success' => true,
                'user' => $user,
            ]);
        }

        throw ValidationException::withMessages([
            'username' => 'Identifiants incorrects',
        ]);
    }
}
