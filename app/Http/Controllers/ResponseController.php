<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response('hello response');
    }

    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'mahoma',
            'lastName' => 'rifuki',
        ];

        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'author' => 'mahoma rifuki',
                'app' => 'learning laravel'
            ]);
    }

    public function responseView(Request $request): Response
    {
        return response()
            ->view('hello', [
                'name' => 'rifuki'
            ]);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'firstName' => 'mahoma',
            'lastName' => 'rifuki'
        ];

        return response()
            ->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/black.jpg'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/kuroi.jpg'), 'kuroi.jpg');
    }
}
