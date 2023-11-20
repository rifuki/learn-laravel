<?php
use Illuminate\Support\Env;

return [
    'author' => [
        'first' => env('NAME_FIRST', 'eko'),
        'last' => Env::get('NAME_LAST', 'khannedy'),
    ],
    'email' => 'echo.khannedy@gmail.com',
    'web' => 'https://www.programmerzamannow.com'
];