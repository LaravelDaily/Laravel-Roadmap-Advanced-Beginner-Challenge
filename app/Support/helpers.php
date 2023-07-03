<?php

use App\Support\Flash\Flash;

if (!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}
