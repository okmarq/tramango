<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Hotel::class);
    }

    public function index(): AnonymousResourceCollection
    {
        $cacheKey = 'hotels';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => HotelResource::collection(Hotel::all()));
    }
    public function store(StoreHotelRequest $request): HotelResource
    {
        $hotel = Hotel::create($request->all());
        return new HotelResource($hotel);
    }

    public function show(Hotel $hotel): HotelResource
    {
        $cacheKey = 'hotel_' . $hotel;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($hotel) {
            return new HotelResource($hotel);
        });
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel): HotelResource
    {
        $hotel->update($request->all());
        return new HotelResource($hotel);
    }

    public function destroy(Hotel $hotel): Response
    {
        $hotel->delete();
        return response(null, 204);
    }
}
