<?php

namespace App\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends BaseResource
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
            'shift' => $this->shift,
            'year' => $this->year,
            'phonenumber1' => $this->phonenumber1,
            'phonenumber2' => $this->phonenumber2,
            'DOB' => Carbon::parse($this->DOB)->format("Y-m-d"),
            'idcard' => $this->idcard,
            'Living_Location' => $this->Living_Location,
            'gender' => $this->gender,
            'department_id' => $this->department_id


           
        ];
    }
}
