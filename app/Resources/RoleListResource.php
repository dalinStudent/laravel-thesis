<?php

namespace App\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class RoleListResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'description' => (string) $this->description
            
            
        ];
    }
}
