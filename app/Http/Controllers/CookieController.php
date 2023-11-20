<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie(Request $request):  Response
    {
        return response('hello cookie')
            ->cookie('User-Id', 'rifuki', 1000, '/') /* <- expired in minutes */
            ->cookie('Is-Member', 'true', 1000, '/'); /* <- expired in minutes */

    }  

    public function getCookie(Request $request): JsonResponse
    {
        return response()
            ->json([
                'userId' => $request->cookie('User-Id', 'guest'),
                'isMember' => $request->cookie('Is-Member', 'false')
            ]);
    }

    public function clearCookie(Request $request): Response
    {
        return response('clear cookie')
            ->withoutCookie('User-Id')
            ->withoutCookie('Is-Member');
    }

}
