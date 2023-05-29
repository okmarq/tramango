<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Status;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Booking::class);
    }

    public function index()
    {
        $cacheKey = 'bookings';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => BookingResource::collection(Booking::all()));
    }

    public function store(StoreBookingRequest $request): BookingResource
    {
        $status = Status::find(Status::IS_PENDING);
        $request->merge(['status_id'=>$status->id]);
        $booking = Booking::create($request->all());
        return new BookingResource($booking);
    }

    public function show(Booking $booking)
    {
        $cacheKey = 'booking_' . $booking->id;
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
