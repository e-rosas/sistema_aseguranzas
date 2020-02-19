<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'percentage' => $this->percentage,
            'range_of_days' => $this->range_of_days,
            'amount_of_days' => $this->amount_of_days,
        ];
    }
}
