<?php

namespace App\Http\Controllers;

use App\Http\Resources\TravelOptionResource;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\Tour;
use App\Models\TravelOption;
use App\Http\Requests\StoreTravelOptionRequest;
use App\Http\Requests\UpdateTravelOptionRequest;
use Carbon\Carbon;
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
        $travelOption = new TravelOption();
        $travellable = $this->getTravelOption($request['travel_id'], $request['travel_type']);
        $travelType = $travelOption->travellable()->associate($travellable);
        $request->merge([
            'travellable_id'=>$travelType->travellable_id,
            'travellable_type'=>$travelType->travellable_type,
            'start_date'=>Carbon::parse($request['start_date'])->format('Y-m-d'),
            'end_date'=>Carbon::parse($request['end_date'])->format('Y-m-d'),
        ]);
        $travelOption = TravelOption::create($request->all());
        return new TravelOptionResource($travelOption);
    }
    function getTravelOption(int $travelId, string $travelType)
    {
        switch ($travelType) {
            case 'flight':
                return Flight::find($travelId);
            case 'hotel':
                return Hotel::find($travelId);
            case 'tour':
                return Tour::find($travelId);
            default:
                break;
        }
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
