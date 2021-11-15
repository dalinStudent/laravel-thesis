<?php

namespace App\Supports\Facades\Classes;

use Hashids\Hashids;

class HashIdFacade
{
    protected $hashId;

    public function __construct()
    {
        $this->hashId = new Hashids(env('DB_DATABASE'), 6);
    }

    public function encode($id)
    {
        return $this->hashId->encode($id);
    }

    public function decode($id)
    {
        return $this->hashId->decode($id);
    }
}
