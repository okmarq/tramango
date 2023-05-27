<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Response;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Status::class);
    }
    public function index(): AnonymousResourceCollection
    {
        $cacheKey = 'statuses';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => StatusResource::collection(Status::all()));
    }

    public function store(StoreStatusRequest $request): StatusResource
    {
        $status = Status::create($request->all());
        return new StatusResource($status);
    }

    public function show(Status $status): StatusResource
    {
        $cacheKey = 'status_' . $status;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($status) {
            return new StatusResource($status);
        });
    }

    public function update(UpdateStatusRequest $request, Status $status): StatusResource
    {
        $status->update($request->all());
        return new StatusResource($status);
    }

    public function destroy(Status $status): Response
    {
        $status->delete();
        return response(null, 204);
    }
}
