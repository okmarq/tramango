<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class TourController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tour::class);
    }

    public function index()
    {
        $cacheKey = 'tours';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => TourResource::collection(Tour::all()));
    }

    public function store(StoreTourRequest $request): TourResource
    {
        $tour = Tour::create($request->all());
        return new TourResource($tour);
    }

    public function show(Tour $tour)
    {
        $cacheKey = 'tour_' . $tour->id;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($tour) {
            return new TourResource($tour);
        });
    }

    public function update(UpdateTourRequest $request, Tour $tour): TourResource
    {
        $tour->update($request->all());
        return new TourResource($tour);
    }

    public function destroy(Tour $tour): Response
    {
        $tour->delete();
        return response(null, 204);
    }
}
