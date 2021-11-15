<?php

namespace App\Supports\Facades;

use Illuminate\Support\Facades\Facade;

class HashIdFacade extends Facade
{
   protected static function getFacadeAccessor() { return 'HashIdFacade'; }
}