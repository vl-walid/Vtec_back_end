<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogOverviewController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\SmallTitleController;
use App\Http\Controllers\ListItemController;

use App\Http\Controllers\MessageController;


//GET VEHicule
use App\Http\Controllers\VehiclesController ;
//new details
use App\Http\Controllers\CategoriesController ;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\EnginesController;
use App\Http\Controllers\GenerationsController;
use App\Http\Controllers\EcusController;
use App\Http\Controllers\TuningController;
use App\Http\Controllers\CharacteristicsController;
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

//Blog Overviews
Route::get('/blog-overviews', [BlogOverviewController::class, 'index']);
Route::post('/blog-overview', [BlogOverviewController::class, 'store']);
Route::delete('/blog-overview/{id}', [BlogOverviewController::class, 'destroy']);
Route::put('/blog-overview/{id}', [BlogOverviewController::class, 'update']);
Route::get('blog-overviews/latest', [BlogOverviewController::class, 'getLatestNews']);

//Blog Posts
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


//Categories :
Route::post('/categorie', [CategoriesController::class, 'getVehiclesInfo']);




//Characteristics
Route::get('/vehicles-characteristics', [CharacteristicsController::class, 'getVehiclesCharacteristics']);




//Get Car :
Route::get('/vehiclesinfos', [VehiclesController::class, 'getVehiclesInfo']);
Route::get('/vehicle/categories', [VehiclesController::class, 'getVehicleCategories']);
Route::get('/vehicles/names', [VehiclesController::class, 'getVehicleNames']);
Route::get('/vehicles/models', [VehiclesController::class, 'getModelsByBrand']);
Route::get('/vehicles/generations', [VehiclesController::class, 'getGenerationsByModel']);
Route::get('/vehicles/engines', [VehiclesController::class, 'getEnginesByGeneration']);
Route::get('/vehicles/ecus', [VehiclesController::class, 'getEcusByEngine']);

// vehicles/details
Route::get('/vehicles/details', [VehiclesController::class, 'getVehicleDetails']);



//NEW DETAILS

Route::post('new-categorie', [CategoriesController::class, 'store']);
Route::post('new-brand', [BrandsController::class, 'store']);
Route::post('new-model', [ModelsController::class, 'store']);
Route::post('new-engine', [EnginesController::class, 'store']);
Route::post('new-generation', [GenerationsController::class, 'store']);
Route::post('new-ecu', [EcusController::class, 'store']);
Route::post('new-tuning', [TuningController::class, 'store']);
//DELETE
//Route::post('categories/delete', [CategoriesController::class, 'destroy']);