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
            'status' => $this->status,
            'invoice' => $this->invoice->number,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'claim' => is_null($this->claim) ? '' : $this->claim,
            'date' => $this->date->format('Y-m-d'),
            'person_data_id' => $this->person_data_id,
        ];
    }
}
