<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class SubmitController
{
    public function submitView()
    {
        return View::make('submitView');
    }


}   