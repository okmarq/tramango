<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TourController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TourResource::collection(Tour::all());
    }

    public function store(StoreTourRequest $request): TourResource
    {
        $tour = Tour::create($request->all());
        return new TourResource($tour);
    }

    public function show(Tour $tour): TourResource
    {
        return new TourResource($tour);
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
