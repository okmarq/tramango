<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class FlightController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Flight::class);
    }

    public function index(): AnonymousResourceCollection
    {
        $cacheKey = 'flights';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => FlightResource::collection(Flight::all()));
    }

    public function store(StoreFlightRequest $request): FlightResource
    {
        $flight = Flight::create($request->all());
        return new FlightResource($flight);
    }

    public function show(Flight $flight): FlightResource
    {
        $cacheKey = 'flight_' . $flight;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($flight) {
            return new FlightResource($flight);
        });
    }

    public function update(UpdateFlightRequest $request, Flight $flight): FlightResource
    {
        $flight->update($request->all());
        return new FlightResource($flight);
    }

    public function destroy(Flight $flight): Response
    {
        $flight->delete();
        return response(null, 204);
    }
}
