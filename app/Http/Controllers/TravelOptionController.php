<?php

namespace App\Http\Controllers;

use App\Http\Resources\TravelOptionResource;
use App\Models\TravelOption;
use App\Http\Requests\StoreTravelOptionRequest;
use App\Http\Requests\UpdateTravelOptionRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class TravelOptionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TravelOption::class);
    }

    public function index(): AnonymousResourceCollection
    {
        $cacheKey = 'travel_options';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => TravelOptionResource::collection(TravelOption::all()));
    }

    public function store(StoreTravelOptionRequest $request): TravelOptionResource
    {
        $travelOption = TravelOption::create($request->all());
        return new TravelOptionResource($travelOption);
    }

    public function show(TravelOption $travelOption): TravelOptionResource
    {
        $cacheKey = 'travel_option_' . $travelOption;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($travelOption) {
            return new TravelOptionResource($travelOption);
        });
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
