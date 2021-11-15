<?php

namespace App\Http\Controllers;

use App\Traits\APIResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, APIResponseTrait;

    protected $per_page = 30;

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
}
