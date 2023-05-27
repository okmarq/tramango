<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return BookingResource::collection(Booking::all());
    }

    public function store(StoreBookingRequest $request): BookingResource
    {
        $booking = Booking::create($request->all());
        return new BookingResource($booking);
    }

    public function show(Booking $booking): BookingResource
    {
        return new BookingResource($booking);
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
