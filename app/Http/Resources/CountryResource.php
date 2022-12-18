<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            "ID"               => $this->id,
            "Name"             => $this->name_en,
            "Currency"         => $this->currency->name ?? '',
            "code"         => $this->code,
            "phone"         => $this->phone,
            // "Flag"             => $this->flagIcon ?? $this->image_path,
        ];
        if ($this->CountryCities) {
            $data["CountryCities"] = CityResource::collection($this->cities);
        }
        return $data;
    }
}
