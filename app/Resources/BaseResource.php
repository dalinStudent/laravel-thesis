<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public static function Pagination($resource)
    {
        $data = [
            'data' => tap(new AnonymousResourceCollection($resource, static::class), function ($collection) {
                if (property_exists(static::class, 'preserveKeys')) {
                    $collection->preserveKeys = (new static([]))->preserveKeys === true;
                }
            }),
            'meta' => [
                'paginate' => [
                    'total' => $resource->total(),
                    'count' => $resource->count(),
                    'per_page' => $resource->perPage(),
                    'current_page' => $resource->currentPage(),
                    'total_pages' => $resource->lastPage()
                ]
            ]
        ];
        return $data;
    }
}
