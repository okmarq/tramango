<?php

namespace App\Http\Controllers;

use App\Http\Resources\TravelOptionResource;
use App\Models\TravelOption;
use App\Http\Requests\StoreTravelOptionRequest;
use App\Http\Requests\UpdateTravelOptionRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TravelOptionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TravelOptionResource::collection(TravelOption::all());
    }

    public function store(StoreTravelOptionRequest $request): TravelOptionResource
    {
        $travelOption = TravelOption::create($request->all());
        return new TravelOptionResource($travelOption);
    }

    public function show(TravelOption $travelOption): TravelOptionResource
    {
        return new TravelOptionResource($travelOption);
    }

    public function update(UpdateTravelOptionRequest $request, TravelOption $travelOption): TravelOptionResource
    {
        $travelOption->update($request->all());
        return new TravelOptionResource($travelOption);
    }

    public function destroy(TravelOption $travelOption): Response
    {
        $travelOption->delete();
        return response(null, 204);
    }
}