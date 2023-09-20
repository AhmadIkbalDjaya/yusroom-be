<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            "user_name" => $this->user->name,
            "room_name" => $this->room->name,
            "room_image" => url("storage/".$this->room->image),
            "booking_date" => $this->booking_date,
            "start_time" => Carbon::parse($this->start_time)->format("H:i"),
            "end_time" => Carbon::parse($this->end_time)->format("H:i"),
            "is_approved" => $this->is_approved,
            "description" => $this->description,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
