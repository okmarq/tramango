<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\HotelResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HotelController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(Hotel::class);
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('view', Hotel::class);
        return HotelResource::collection(Hotel::all());
    }

    public function store(StoreHotelRequest $request): HotelResource
    {
        $hotel = Hotel::create($request->all());
        return new HotelResource($hotel);
    }

    public function show(Hotel $hotel): HotelResource
    {
        return new HotelResource($hotel);
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
