<?php

namespace App\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends BaseResource
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
            'role_id' => $this->role_id,
            'phone_number' => $this->phone_number,
            'sex' => $this->sex,
            'description' => $this->description
         
         
           
        ];
    }
}
