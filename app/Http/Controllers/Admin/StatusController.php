<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Status::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return StatusResource::collection(Status::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request): StatusResource
    {
        $status = Status::create($request->all());
        return new StatusResource($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status): StatusResource
    {
        return new StatusResource($status);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status): StatusResource
    {
        $status->update($request->all());
        return new StatusResource($status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status): Response
    {
        $status->delete();
        return response(null, 204);
    }
}
