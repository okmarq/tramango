<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(): AnonymousResourceCollection
    {
        $cacheKey = 'users';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => UserResource::collection(User::all()));
    }

    public function show(User $user): UserResource
    {
        $cacheKey = 'user_' . $user;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($user) {
            return new UserResource($user);
        });
    }
}
