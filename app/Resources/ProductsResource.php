<?php

namespace App\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends BaseResource
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
            'pname' => $this->pname,
            'khmer_name' => $this->khmer_name,
            'model' => $this->model,
            'serialnumber' => $this->serialnumber,
            'category_id' => $this->category_id,
            'qty' => $this->qty,
            'note' => $this->note
        ];
    }
}
