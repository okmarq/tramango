<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user,
            'travel_option' => $this->travelOption,
            'guests' => $this->guests,
            'status' => $this->status,
            'payment'=>$this->payment
        ];;
    }
}
