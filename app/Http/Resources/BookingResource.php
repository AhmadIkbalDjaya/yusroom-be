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
            "id" => $this->id,
            "room_name" => $this->room->name,
            "booking_date" => $this->booking_date,
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
            "is_approved" => $this->is_approved,
        ];
    }
}
