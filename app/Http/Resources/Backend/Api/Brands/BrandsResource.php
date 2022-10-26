<?php

namespace App\Http\Resources\Backend\Api\Brands;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
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
            'id' => $this->brand_id,
            'text' => $this->brand->name.'('.$this->quantity.')',
            'quantity' => $this->quantity
        ];
    }
}
