<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogOverviewController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\SmallTitleController;
use App\Http\Controllers\ListItemController;

use App\Http\Controllers\MailController;


//GET VEHicule
use App\Http\Controllers\VehiclesController ;
//new details
use App\Http\Controllers\CategoryController ;
use App\Http\Controllers\BrandController ;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleCharacteristicController;
use App\Http\Controllers\TuningController;
use App\Http\Controllers\BrandsController;


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

//ADMIN
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify', [AuthController::class, 'verifyToken']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


//Fetch vehicle:
Route::get('/vehicle/categories', [CategoryController::class, 'getVehicleCategories']);
Route::get('/vehicle/brands', [BrandController::class, 'getBrandsByCategoryId']);
Route::get('/vehicle/models', [ModelController::class, 'getModelsByBrand']);
Route::get('/vehicle/generations', [GenerationController::class, 'getGenerationsByModel']);
Route::get('/vehicle/engines', [EngineController::class, 'getEnginesByGeneration']);
Route::get('/vehicle/ecus', [VehicleController::class, 'getEcusByEngineId']);
Route::post('/vehicle/details', [VehicleController::class, 'getVehicleDetails']);
Route::post('/vehicle-characteristics', [VehicleCharacteristicController::class, 'getCharacteristics']);

//Fetch vehicle Activated :

Route::get('/vehicle/categories-activate', [CategoryController::class, 'getActivatedVehicleCategories']);
Route::get('/vehicle/brands-activate', [BrandController::class, 'getActivatedBrandsByCategoryId']);
Route::get('/vehicle/models-activate', [ModelController::class, 'getActivatedModelsByBrand']);
Route::get('/vehicle/generations-activate', [GenerationController::class, 'getActivatedGenerationsByModel']);
Route::get('/vehicle/engines-activate', [EngineController::class, 'getActivatedEnginesByGeneration']);
Route::get('/vehicle/ecus-activate', [VehicleController::class, 'getActivatedEcusByEngineId']);


// Category Route
Route::post('vehicle/categories', [CategoryController::class, 'store']); 

// Brand Route (Corrected)
Route::post('vehicle/brands', [BrandController::class, 'store']); 

// Vehicle Model Route
Route::post('vehicle/models', [ModelController::class, 'store']); // Create a new model

// Generation Route
Route::post('vehicle/generations', [GenerationController::class, 'store']); // Create a new generation

// Engine Route
Route::post('vehicle/engines', [EngineController::class, 'store']); // Create a new engine

//Vehicle 
Route::post('vehicle/create', [VehicleController::class, 'store']); 
Route::get('/vehicles/search', [VehicleController::class, 'search']);
Route::patch('/vehicles/{vehicleId}/toggle-active', [VehicleController::class, 'toggleActive']);

// Mail Route (Test Email)

// Tuning 
Route::get('vehicle/tuning', [TuningController::class, 'index']); // Fetch all tunings
Route::post('vehicle/tuning', [TuningController::class, 'store']); // Create a new tuning
Route::post('vehicle/tuning/add', [TuningController::class, 'addTuning']); // Create a new VEhicle tuning
Route::get('vehicle/tuning-by-id', [TuningController::class, 'getTuningByVehicle']);
Route::get('vehicle/stage-and-name', [TuningController::class, 'getVehicleAndTuningDetails']);

// Characteristic
Route::get('vehicle/characteristics-by-tuning-id', [VehicleCharacteristicController::class, 'CharacteristicByTuningAndCarID']);
Route::post('vehicle/add-characteristics-tuning', [VehicleCharacteristicController::class, 'store']);
Route::get('characteristics', [VehicleCharacteristicController::class, 'index']);
Route::post('add-characteristic', [VehicleCharacteristicController::class, 'NewCharacteristic']);
Route::delete('/vehicle/tuning/characteristic-delete', [VehicleCharacteristicController::class, 'removeCharacteristic']);


//IS Active 
Route::put('toggle-active/categories/{id}', [CategoryController::class, 'toggleActive']);
Route::put('toggle-active/brands/{id}', [BrandController::class, 'toggleActiveStatus']);
Route::put('toggle-active/models/{id}', [ModelController::class, 'toggleActiveStatus']);
Route::put('toggle-active/generations/{id}', [GenerationController::class, 'toggleActiveStatus']);
Route::put('toggle-active/engines/{id}', [EngineController::class, 'toggleActiveStatus']);

//MAil 
Route::get('test-email', [MailController::class, 'sendEmail']);
Route::post('send-partner-request', [MailController::class, 'sendPartnerRequest']);
Route::post('send-contact-message', [MailController::class, 'sendContactMessage']);

//Update 
Route::get('/update-category-names', [CategoryController::class, 'updateCategoryNames']);