<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        // session(); /* <- alternate way */
        // Session:: /* alternate way */

        $request->session()->put('userId', 'rifuki');
        $request->session()->put('isMember', var_export(true, true));
        return 'OK';
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId', 'guest');
        $isMember = $request->session()->get('isMember', var_export(false, true));

        return "User Id: $userId, is Member: $isMember";
    }
}
