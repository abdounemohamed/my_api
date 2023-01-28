<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(): array
    {
        return [
            'success' => true,
            'message' => "Welcome to my Api",
            'data' => [
                'version' => '1.0',
                'language' => app()->getLocale(),
            ]
        ];
    }
}
