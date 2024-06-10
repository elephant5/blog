<?php

use App\Http\Controllers\GeminiAiController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/user', [UserController::class, 'index']);

Route::view('/welcome', 'welcome');

Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
Route::get('/user/{id}', function (string $id) {
    return 'User '.$id;
});


Route::get('/addFoobar', [UserController::class, 'addFoobar']);
Route::get('/addGuzzle', [UserController::class, 'addGuzzle']);

Route::get('/testing', [TestController::class, 'index']);


Route::post('user/gemini/free',[GeminiAiController::class, 'requestGeminiForFree']);

Route::post('user/gemini/pay',[GeminiAiController::class, 'requestGeminiForPay']);
Route::get('user/gemini/index',[GeminiAiController::class, 'index']);

Route::post('user/gemini/free/flash',[GeminiAiController::class, 'requestGeminiForFreeFlash']);
Route::post('user/gemini/free/content/flash',[GeminiAiController::class, 'requestGeminiForFreeFlashForContent']);

