<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RestorationController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Inventory_noticeController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\BibliographyController;
use App\Http\Controllers\AcquisitionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Artist Routes
Route::get('artist', [ArtistController::class , 'index']);
Route::get('artist/{id}', [ArtistController::class , 'show']);
Route::post('artist', [ArtistController::class , 'store']);
Route::put('artist/{id}', [ArtistController::class , 'update']);
Route::delete('artist/{id}', [ArtistController::class , 'destroy']);

// Artwork Routes
Route::get('artwork', [ArtworkController::class , 'index']);
Route::get('artwork/{id}', [ArtworkController::class , 'show']);
Route::post('artwork', [ArtworkController::class , 'store']);
Route::post('artworkimage', [ArtworkController::class , 'linktoimage']);
Route::put('artwork/{id}', [ArtworkController::class , 'update']);
Route::delete('artwork/{id}', [ArtworkController::class , 'destroy']);

// Loan Routes
Route::get('loan', [LoanController::class , 'index']);
Route::get('loan/{id}', [LoanController::class , 'show']);
Route::post('loan', [LoanController::class , 'store']);
Route::put('loan/{id}', [LoanController::class , 'update']);
Route::delete('loan/{id}', [LoanController::class , 'destroy']);

// Image Routes
Route::get('image', [ImageController::class , 'index']);
Route::get('image/{id}', [ImageController::class , 'show']);
Route::post('image', [ImageController::class , 'store']);
Route::put('image/{id}', [ImageController::class , 'update']);
Route::delete('image/{id}', [ImageController::class , 'destroy']);

// Restoration Routes
Route::get('restoration', [RestorationController::class , 'index']);
Route::get('restoration/{id}', [RestorationController::class , 'show']);
Route::post('restoration', [RestorationController::class , 'store']);
Route::put('restoration/{id}', [RestorationController::class , 'update']);
Route::delete('restoration/{id}', [RestorationController::class , 'destroy']);

// Acquisition Routes
Route::get('acquisition', [AcquisitionController::class , 'index']);
Route::get('acquisition/{id}', [AcquisitionController::class , 'show']);
Route::post('acquisition', [AcquisitionController::class , 'store']);
Route::put('acquisition/{id}', [AcquisitionController::class , 'update']);
Route::delete('acquisition/{id}', [AcquisitionController::class , 'destroy']);

// Bibliography Routes
Route::get('bibliography', [BibliographyController::class , 'index']);
Route::get('bibliography/{id}', [BibliographyController::class , 'show']);
Route::post('bibliography', [BibliographyController::class , 'store']);
Route::put('bibliography/{id}', [BibliographyController::class , 'update']);
Route::delete('bibliography/{id}', [BibliographyController::class , 'destroy']);

// Exhibition Routes
Route::get('exhibition', [ExhibitionController::class , 'index']);
Route::get('exhibition/{id}', [ExhibitionController::class , 'show']);
Route::post('exhibition', [ExhibitionController::class , 'store']);
Route::put('exhibition/{id}', [ExhibitionController::class , 'update']);
Route::delete('exhibition/{id}', [ExhibitionController::class , 'destroy']);

// Inventory_notice Routes
Route::get('inventory_notice', [Inventory_noticeController::class , 'index']);
Route::get('inventory_notice/{id}', [Inventory_noticeController::class , 'show']);
Route::post('inventory_notice', [Inventory_noticeController::class , 'store']);
Route::put('inventory_notice/{id}', [Inventory_noticeController::class , 'update']);
Route::delete('inventory_notice/{id}', [Inventory_noticeController::class , 'destroy']);

// Reservation Routes
Route::get('reservation', [ReservationController::class , 'index']);
Route::get('reservation/{id}', [ReservationController::class , 'show']);
Route::post('reservation', [ReservationController::class , 'store']);
Route::put('reservation/{id}', [ReservationController::class , 'update']);
Route::delete('reservation/{id}', [ReservationController::class , 'destroy']);

// Material Routes
Route::get('material', [MaterialController::class , 'index']);
Route::get('material/{id}', [MaterialController::class , 'show']);
Route::post('material', [MaterialController::class , 'store']);
Route::post('materialart', [MaterialController::class , 'storeForArtwork']);
Route::put('material/{id}', [MaterialController::class , 'update']);
Route::delete('material/{id}', [MaterialController::class , 'destroy']);