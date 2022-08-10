<?php

namespace App\System\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CityResource
 *
 * @package App\System\Http\Resources
 */
class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var $this City */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lat' => $this->lat,
            'lan' => $this->lng
        ];
    }
}
