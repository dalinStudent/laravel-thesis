<?php

namespace App\Http\Resources;

use App\Resources\BaseResource;
use App\Resources\EmployeeResource;

class UsersListResource extends BaseResource
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
            'id' => (string) $this->id,
            'creator' => $this->creator,
            'employee' => new EmployeeResource($this->employee)
        ];
    }
}
