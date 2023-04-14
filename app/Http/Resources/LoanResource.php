<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'copy_id' => $this->copy_id,
            'user_date' => $this->user_date,
            'end_date' => $this->end_date,
            'user' => new UserResource($this->whenLoaded('user')),
            'copy' => new CopyResource($this->whenLoaded('copy')),
        ];
    }
}
