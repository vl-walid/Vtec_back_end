<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogOverviewController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\SmallTitleController;
use App\Http\Controllers\ListItemController;

use App\Http\Controllers\MessageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/blog-overviews', [BlogOverviewController::class, 'index']);
Route::post('/blog-overview', [BlogOverviewController::class, 'store']);
Route::delete('/blog-overview/{id}', [BlogOverviewController::class, 'destroy']);
Route::put('/blog-overview/{id}', [BlogOverviewController::class, 'update']);
Route::get('blog-overviews/latest', [BlogOverviewController::class, 'getLatestNews']);


Route::get('/blog-post-details/{id}', [BlogPostController::class, 'showdetails']);



Route::post('/blog-posts-new', [BlogPostController::class, 'store']);
Route::get('/blog-posts/{blog_overview_id}', [BlogPostController::class, 'show']);
Route::post('/blog-posts/{blog_overview_id}/update', [BlogPostController::class, 'update']);
Route::delete('/blog-posts/{blog_overview_id}', [BlogPostController::class, 'destroy']);



// Small Titles Routes
Route::get('blog-posts/{blogPostId}/small-titles', [SmallTitleController::class, 'index']);
Route::post('small-titles', [SmallTitleController::class, 'store']);
Route::put('small-titles/{id}', [SmallTitleController::class, 'update']);
Route::delete('small-titles/{id}', [SmallTitleController::class, 'destroy']);

// List Items Routes
Route::get('blog-posts/{blogPostId}/list-items', [ListItemController::class, 'index']);
Route::post('list-items', [ListItemController::class, 'store']);
Route::put('list-items/{id}', [ListItemController::class, 'update']);
Route::delete('list-items/{id}', [ListItemController::class, 'destroy']);


//MAIL


Route::post('/send-message', [MessageController::class, 'sendMessage']);



//ADMIN
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify', [AuthController::class, 'verifyToken']);
Route::post('/logout', [AuthController::class, 'logout']);
