<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateFacebookToken;
use App\Http\Controllers\GeneratePageAccessToken;
use App\Http\Controllers\GenerateTwitterAccessToken;
use App\Http\Controllers\PostToFaceBookInsta;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/tasks', [TasksController::class, 'index']);

// Protected Route
Route::group(['middleware' => ['auth:sanctum']], function() {
Route::post('/logout', [AuthController::class, 'logout']);
// FACEBOOK
Route::post('/getgeneratedtoken', [GenerateFacebookToken::class, 'generatetoken']);
Route::get('/getlonglivedtoken', [GenerateFacebookToken::class, 'GenerateLongLifeAccessToken']);
Route::get('/generatepageaccesstoken', [GeneratePageAccessToken::class, 'index']);
Route::post('/store_fb_insta_page_access_token', [GeneratePageAccessToken::class, 'StoreFBInstaPageAccessToken']);
Route::get('/get_fb_insta_page_access_token', [PostToFaceBookInsta::class, 'index']);
Route::post('/post_to_facebook', [PostToFaceBookInsta::class, 'PostToFaceBook']);
// TWITTER ( NOT WORKING)
Route::post('/generate_twitter_oauth_token', [GenerateTwitterAccessToken::class, 'index']);
});


