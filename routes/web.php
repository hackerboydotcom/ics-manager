<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('c/{campaign}.js', [\App\Http\Controllers\CampaignController::class, 'show'])->name('campaign');

Route::get('c/{campaign}/s/{uuid}.ics', [\App\Http\Controllers\SubscriberController::class, 'show'])->name('subscribe');

Route::get('/', function () {
    return 'ok';
});
