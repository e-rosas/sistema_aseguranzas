<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CallResource extends JsonResource
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
            'number' => $this->number,
            'comments' => $this->comments,
            'claim' => $this->claim,
            'date' => $this->date->format('Y-m-d'),
            'invoice_id' => $this->invoice_id,
        ];
    }
}
