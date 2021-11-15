<?php

namespace App\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($el)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description
           
        ];
    }
}
