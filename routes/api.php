<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateFacebookTokenController;
use App\Http\Controllers\GeneratePageAccessTokenController;
use App\Http\Controllers\GenerateTwitterAccessTokenController;
use App\Http\Controllers\PostToFaceBookController;
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
Route::post('/getgeneratedtoken', [GenerateFacebookTokenController::class, 'generatetoken']);
Route::get('/getlonglivedtoken', [GenerateFacebookTokenController::class, 'GenerateLongLifeAccessToken']);


Route::get('/generatepageaccesstoken', [GeneratePageAccessTokenController::class, 'getfacebookpageaccesstoken']);

Route::post('/store_facebook_access_token', [GeneratePageAccessTokenController::class, 'StoreFBPageAccessToken']);
Route::get('/get_fb_page_access_token', [PostToFaceBookController::class, 'index']);


Route::post('/post_to_facebook', [PostToFaceBookController::class, 'PostToFaceBook']);
Route::post('/schedule_facebook_post', [PostToFaceBookController::class, 'SchedulePostToFacebook']);

Route::get('/post_facebook_userdetails', [GenerateFacebookTokenController::class, 'facebook_userdetails']);
Route::get('/get_facebook_userdetails', [GenerateFacebookTokenController::class, 'get_facebook_userdetails']);
// TWITTER ( NOT WORKING)
Route::post('/generate_twitter_oauth_token', [GenerateTwitterAccessTokenController::class, 'index']);
});


