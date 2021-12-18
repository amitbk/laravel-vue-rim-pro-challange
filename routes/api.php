<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/experiences/{id}', [ExperienceController::class, 'update']);
Route::resource('/experiences', ExperienceController::class );
Route::post('/tags/{id}', [TagController::class, 'update']);
Route::resource('/tags', TagController::class );

Route::get('/', [Controller::class, 'routes'])
    ->name('route information')
    ->withoutMiddleware('api');
Route::get('/example', [Controller::class, 'example'])->name('example route');
Route::get('/error', [Controller::class, 'error'])->name('error route');

