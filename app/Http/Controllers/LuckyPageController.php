<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LuckyPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $token)
    {
        return Inertia::render('LuckyPage')->with('accessToken', $token);
    }
}
