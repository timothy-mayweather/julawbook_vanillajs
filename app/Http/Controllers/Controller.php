<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //TODO $AppId to be changed whenever we are creating a branch app
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public int $AppId = 1;
}
