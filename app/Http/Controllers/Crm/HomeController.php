<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use function view;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('crm.main.index');
    }
}
