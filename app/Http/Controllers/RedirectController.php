<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): String
    {
        return 'redirect toooooooo';
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', [
            'name' => 'rifuki'
        ]);
    }

    /* * redirect to controller / action */
    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], [
            'name' => 'rifuki'
        ]);
    }

    /* * redirect to external domain */
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://www.apple.com');
    }
}
