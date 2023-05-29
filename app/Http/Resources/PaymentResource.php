<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'booking_id' =>$this->booking_id,
            'reference' =>$this->reference,
            'email' =>$this->email,
            'provider' =>$this->provider,
            'date' =>$this->date,
            'booking' =>$this->booking,
        ];
    }
}
