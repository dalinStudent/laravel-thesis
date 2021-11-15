<?php

namespace App\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingsResource extends BaseResource
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
            'user_id' => $this->user_id,
            'qty' => $this->qty,
            'return_qty' => $this->return_qty,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'status' => $this->status,
            'room_id' => $this->room_id,
            'product_id' => $this->product_id
         
           
        ];
    }
}
