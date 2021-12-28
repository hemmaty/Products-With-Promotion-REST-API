<?php

namespace App\Http\Controllers;

use App\Traits\Validation\BaseValidation;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    use BaseValidation;
}
