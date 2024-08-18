<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AchivementResource extends JsonResource
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
            'name'           => $this->name,
            'value'          => $this->value,
            'max_value'      => $this->max_value,
            'path'           => asset('uploads/images/achs'),
            'image'          => $this->image,

        ];
    }
}
