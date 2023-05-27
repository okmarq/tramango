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
        $cacheKey = 'bookings';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => UserResource::collection(User::all()));
    }

    public function store(Request $request): UserResource
    {
        $user = User::create($request->all());
        return new UserResource($user);
    }

    public function show(User $user): UserResource
    {
        $cacheKey = 'user_' . $user;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($user) {
            return new UserResource($user);
        });
    }

    public function update(Request $request, User $user): UserResource
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy(User $user): Response
    {
        $user->delete();
        return response(null, 204);
    }
}
