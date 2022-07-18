<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'email' => $this->email,
            'phone' => $this->phone,
            'fantasy_name' => $this->fantasy_name,
            'address' => [
                'zipcode' => $this->address->zipcode,
                'state' => $this->address->state,
                'city' => $this->address->city,
                'neighborhood' => $this->address->neighborhood,
                'address' => $this->address->address,
                'number' => $this->address->number,
                'complement' => $this->address->complement
            ]
        ];
    }
}
