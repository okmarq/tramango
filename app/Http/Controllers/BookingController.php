<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class BookingController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $cacheKey = 'bookings';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => BookingResource::collection(Booking::all()));
    }

    public function store(StoreBookingRequest $request): BookingResource
    {
        $booking = Booking::create($request->all());
        return new BookingResource($booking);
    }

    public function show(Booking $booking): BookingResource
    {
        $cacheKey = 'booking_' . $booking;
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, function () use ($booking) {
            return new BookingResource($booking);
        });
    }

    public function update(UpdateBookingRequest $request, Booking $booking): BookingResource
    {
        $booking->update($request->all());
        return new BookingResource($booking);
    }

    public function destroy(Booking $booking): Response
    {
        $booking->delete();
        return response(null, 204);
    }
}
