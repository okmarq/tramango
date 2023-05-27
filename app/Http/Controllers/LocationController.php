<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $cacheKey = 'locations';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => LocationResource::collection(Location::all()));
    }

    public function store(StoreLocationRequest $request): LocationResource
    {
        $location = Location::create($request->all());
        return new LocationResource($location);
    }

    public function show(Location $location): LocationResource
    {
        $cacheKey = 'location_' . $location;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($location) {
            return new LocationResource($location);
        });
    }

    public function update(UpdateLocationRequest $request, Location $location): LocationResource
    {
        $location->update($request->all());
        return new LocationResource($location);
    }

    public function destroy(Location $location): Response
    {
        $location->delete();
        return response(null, 204);
    }
}
