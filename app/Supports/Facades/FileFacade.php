<?php

namespace App\Supports\Facades;

use Illuminate\Support\Facades\Facade;

class FileFacade extends Facade
{
   protected static function getFacadeAccessor() { 
      return 'FileFacade';
   }
}