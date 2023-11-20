<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function () {
    return "Hello Programmer Zaman Now";
});

Route::redirect('/youtube', '/pzn');



Route::view('/hello', 'hello', ['name' => 'Rifuki']);

Route::get('/hello-again', function() {
    return view('hello', ['name' => 'Aozora']);
});

Route::get('/hello-world', function() {
    return view('hello.world', ['name' => 'Rifuki']);
});

/* * parameter route */
Route::get('/products/{id}', function($productId) {
    return "product $productId";
})->name('product.detail');

/* * * test route name */
Route::get('/produk/{id}', function($id) {
    $link = route('product.detail', [
        'id' => $id
    ]);
    
    return "link: $link";
});

Route::get('/produk-redirect/{id}', function($id) {
    return redirect()->route('product.detail', [
        'id' => $id
    ]);
});

Route::get('/products/{product}/items/{id}', function($product, $itemId) {
    return "product: $product, item: $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function($categoryId) {
    return "category_id: $categoryId";
})->where('id', '[0-9]+');

/* * optional paramater route */
Route::get('/users/{id?}', function(string $userId = '404'){
    return "user_id: $userId";
})->name('user.detail');

Route::get('/conflict/{name}', function(string $name) {
    return "user $name";
});
Route::get('/conflict/eko', function() {
    return 'conflict eko';
});

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]); /* <- use method withoutMiddleware to process post request */
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);
Route::post('/input/hello/array', [\App\Http\Controllers\Inputcontroller::class, 'helloArray']);
Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]); /* <- use method withoutMiddleware to process post request */

Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);
Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);

Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);

Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/hello/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);

Route::get('/middleware/api', function() {
    return 'OK';
// })->middleware([\App\Http\Middlkeware\ContohMiddleware::class]); /* <- another way to import middleware */
})->middleware('contoh.middleware');
Route::get('/middleware/groups', function() {
    return 'GROUPS';
})->middleware('groups'); /* <- import middleware groups */
Route::get('/middleware/parameters', function() {
    return 'OK PARAMETER';
})->middleware(['\App\Http\Middleware\ContohMiddlewareParameter:himitsu,401']);

Route::get('/form/csrf', [\App\Http\Controllers\FormController::class, 'renderForm']);
Route::post('/form/csrf', [\App\Http\Controllers\FormController::class, 'submitForm']);

Route::prefix('/response/type/group')->group(function() {
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);  
});
Route::middleware(['\App\Http\Middleware\ContohMiddlewareParameter:himitsu,401'])->group(function() {
    Route::get('/middleware/parameters/group', function() {
        return 'OK PARAMETER Group';
    })->middleware(['\App\Http\Middleware\ContohMiddlewareParameter:himitsu,401']);
});
Route::controller(\App\Http\Controllers\CookieController::class)->group(function() {
    Route::get('/cookie/get/group', 'getCookie');
    Route::get('/cookie/set/group', 'setCookie');
    Route::get('/cookie/clear/group', 'clearCookie');
});
Route::middleware(['\App\Http\Middleware\ContohMiddleware'])->prefix('/middleware')->group(function() {
    Route::get('/api/combine', function() {
        return 'OK combined';
    })->middleware('contoh.middleware');
    Route::get('/groups/combine', function() {
        return 'GROUPS combined';
    })->middleware('groups');
});

/* * * URL Generation */
Route::get('/url/current', function() {
    return URL::full();
});
Route::get('/redirect/named', function() {
    // return route('redirect-hello', [ /* <- alternate way */
    //     'name' => 'rifuki'
    // ]);
    // return url()->route('redirect-hello', [ /* <- alternate way */
    //     'name' => 'rifuki'
    // ]);
    return URL::route('redirect-hello', [
        'name' => 'rifuki'
    ]);
});
Route::get('/url/action', function() {
    // return url()->action([\App\Http\Controllers\FormController::class, 'form'], []); /* <- alternate way */
    // return URL::action([\App\Http\Controllers\FormController::class, 'form'], []); /* <- alternate way */
    return action([\App\Http\Controllers\FormController::class, 'renderForm'], []);
});

/* * * session */
Route::get('/session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('/session/get', [\App\Http\Controllers\SessionController::class, 'getSession']);

/* * * error handling */
Route::get('/route/sample', function() {
    throw new Exception('Sample Error');
});
Route::get('/error/manual', function() {
    report (new Exception("Sample Error Manual"));
    return 'OK';
});
Route::get('/error/validation', function() {
    throw new \App\Exceptions\ValidationException('Validation Error');
});

/* * * http exception */
Route::get('/abort/400', function() {
    abort(400, 'ups validation error'); /* <- best practice for render view error */
});
Route::get('/abort/401', function() {
    abort(401);
});
Route::get('/abort/500', function() {
    abort(500);
});

Route::fallback(function() { /* <- like default_service in rust for handle if route no found */
    return "404 not found (fallback page)";
});