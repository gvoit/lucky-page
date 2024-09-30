<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeelingLuckyResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'random_number' => $this->random_number,
            'prize' => $this->prize,
            'is_winner' => $this->is_winner,
        ];
    }
}
