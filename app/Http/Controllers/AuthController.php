<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerAdmin(StoreUserRequest $request): Response
    {
        $request->merge(['password' => Hash::make($request['password'])]);
        $user = User::create($request->all());
        $role = Role::find(Role::ADMIN);
        $user->roles()->attach($role);
        $token = $user->createToken('Register')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function register(StoreUserRequest $request): Response
    {
        $request->merge(['password' => Hash::make($request['password'])]);
        $user = User::create($request->all());
        $role = Role::find(Role::USER);
        $user->roles()->attach($role);
        $token = $user->createToken('Register')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * @throws AuthenticationException
     */
    public function login(UpdateUserRequest $request): Response
    {
        if (
            Auth::attempt([
                'email' => $request['email'],
                'password' => $request['password'],
            ])
        ) {
            $user = User::find(auth()->id());
            $token = $user->createToken('Login')->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token
            ], 200);
        }

        throw new AuthenticationException(
            'Your credentials does not match our record.'
        );
    }

    public function logout(): Response
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logged out'
        ], 200);
    }
}
