<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FlightController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return FlightResource::collection(Flight::all());
    }

    public function store(StoreFlightRequest $request): FlightResource
    {
        $flight = Flight::create($request->all());
        return new FlightResource($flight);
    }

    public function show(Flight $flight): FlightResource
    {
        return new FlightResource($flight);
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
