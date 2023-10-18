<?php

use App\Http\Controllers\Auth\LoginController;
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


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {


    Route::put('users/{id}', [\App\Http\Controllers\UserController::class, 'makesuper'])->name('user.super');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::delete('users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


    // Artwork Routes
    Route::get('artwork', [\App\Http\Controllers\ArtworkController::class, 'index'])->name('artwork');
    Route::get('stats', [\App\Http\Controllers\ArtworkController::class, 'stats'])->name('stats');
    Route::get('artwork/create', [\App\Http\Controllers\ArtworkController::class, 'create'])->name('artwork.create');
    Route::post('artwork', [\App\Http\Controllers\ArtworkController::class, 'store']);
    Route::post('/artworkimage', [\App\Http\Controllers\ArtworkController::class, 'linktoimage'])->name('artwork.linktoimage');
    Route::get('artwork/{id}/edit', [\App\Http\Controllers\ArtworkController::class, 'edit'])->name('artwork.edit');
    Route::put('artwork/{id}', [\App\Http\Controllers\ArtworkController::class, 'update'])->name('artwork.update');
    Route::delete('artwork/{id}', [\App\Http\Controllers\ArtworkController::class, 'destroy'])->name('artwork.destroy');
    Route::get('artwork/search', [\App\Http\Controllers\ArtworkController::class, 'search'])->name('artwork.search');
    Route::get('/artwork/autocomplete', [\App\Http\Controllers\ArtworkController::class, 'autocomplete']);
    Route::get('/artwork/filter', [\App\Http\Controllers\ArtworkController::class, 'filter'])->name('artwork.filter');
    Route::get('/artwork/filterc', [\App\Http\Controllers\ArtworkController::class, 'filterc'])->name('artwork.filterc');
    Route::get('artwork/{id}', [\App\Http\Controllers\ArtworkController::class, 'show']);

    // Acquisition Routes
    Route::get('acquisition', [\App\Http\Controllers\AcquisitionController::class, 'index'])->name('acquisition');
    Route::get('acquisition/create', [\App\Http\Controllers\AcquisitionController::class, 'create'])->name('acquisition.create');
    Route::post('acquisition', [\App\Http\Controllers\AcquisitionController::class, 'store']);
    Route::get('acquisition/{id}/edit', [\App\Http\Controllers\AcquisitionController::class, 'edit'])->name('acquisition.edit');
    Route::put('acquisition/{id}', [\App\Http\Controllers\AcquisitionController::class, 'update'])->name('acquisition.update');
    Route::delete('acquisition/{id}', [\App\Http\Controllers\AcquisitionController::class, 'destroy'])->name('acquisition.destroy');
    Route::get('acquisition/search', [\App\Http\Controllers\AcquisitionController::class, 'search'])->name('acquisition.search');
    Route::get('/acquisition/autocomplete', [\App\Http\Controllers\AcquisitionController::class, 'autocomplete']);
    Route::get('/acquisition/filter', [\App\Http\Controllers\AcquisitionController::class, 'filter'])->name('acquisition.filter');
    Route::get('acquisition/{id}', [\App\Http\Controllers\AcquisitionController::class, 'show']);
    

    // Bibliography Routes
    Route::get('bibliography', [\App\Http\Controllers\BibliographyController::class, 'index'])->name('bibliography');
    Route::get('bibliography/create', [\App\Http\Controllers\BibliographyController::class, 'create'])->name('bibliography.create');
    Route::post('bibliography', [\App\Http\Controllers\BibliographyController::class, 'store']);
    Route::get('bibliography/{id}/edit', [\App\Http\Controllers\BibliographyController::class, 'edit'])->name('bibliography.edit');
    Route::put('bibliography/{id}', [\App\Http\Controllers\BibliographyController::class, 'update'])->name('bibliography.update');
    Route::delete('bibliography/{id}', [\App\Http\Controllers\BibliographyController::class, 'destroy'])->name('bibliography.destroy');
    Route::get('bibliography/search', [\App\Http\Controllers\BibliographyController::class, 'search'])->name('bibliography.search');
    Route::get('/bibliography/autocomplete', [\App\Http\Controllers\BibliographyController::class, 'autocomplete']);
    Route::get('/bibliography/filter', [\App\Http\Controllers\BibliographyController::class, 'filter'])->name('bibliography.filter');
    Route::get('bibliography/{id}', [\App\Http\Controllers\BibliographyController::class, 'show']);

    // Exhibition Routes
    Route::get('exhibition', [\App\Http\Controllers\ExhibitionController::class, 'index'])->name('exhibition');
    Route::get('exhibition/create', [\App\Http\Controllers\ExhibitionController::class, 'create'])->name('exhibition.create');
    Route::post('exhibition', [\App\Http\Controllers\ExhibitionController::class, 'store']);
    Route::get('exhibition/{id}/edit', [\App\Http\Controllers\ExhibitionController::class, 'edit'])->name('exhibition.edit');
    Route::put('exhibition/{id}', [\App\Http\Controllers\ExhibitionController::class, 'update'])->name('exhibition.update');
    Route::delete('exhibition/{id}', [\App\Http\Controllers\ExhibitionController::class, 'destroy'])->name('exhibition.destroy');
    Route::get('exhibition/search', [\App\Http\Controllers\ExhibitionController::class, 'search'])->name('exhibition.search');
    Route::get('/exhibition/autocomplete', [\App\Http\Controllers\ExhibitionController::class, 'autocomplete']);
    Route::get('/exhibition/filter', [\App\Http\Controllers\ExhibitionController::class, 'filter'])->name('exhibition.filter');
    Route::get('exhibition/{id}', [\App\Http\Controllers\ExhibitionController::class, 'show']);



    // Artist Routes
    Route::get('artist', [\App\Http\Controllers\ArtistController::class, 'index'])->name('artist');
    Route::get('artist/create', [\App\Http\Controllers\ArtistController::class, 'create'])->name('artist.create');
    Route::post('artist', [\App\Http\Controllers\ArtistController::class, 'store']);
    Route::get('artist/{id}/edit', [\App\Http\Controllers\ArtistController::class, 'edit'])->name('artist.edit');
    Route::put('artist/{id}', [\App\Http\Controllers\ArtistController::class, 'update'])->name('artist.update');
    Route::delete('artist/{id}', [\App\Http\Controllers\ArtistController::class, 'destroy'])->name('artist.destroy');
    Route::get('artist/search', [\App\Http\Controllers\ArtistController::class, 'search'])->name('artist.search');
    Route::get('/artist/autocomplete', [\App\Http\Controllers\ArtistController::class, 'autocomplete']);
    Route::get('/artist/filter', [\App\Http\Controllers\ArtistController::class, 'filter'])->name('artist.filter');
    Route::get('artist/{id}', [\App\Http\Controllers\ArtistController::class, 'show']);



    // Loan Routes
    Route::get('loan', [\App\Http\Controllers\LoanController::class, 'index'])->name('loan');
    Route::get('loan/create', [\App\Http\Controllers\LoanController::class, 'create'])->name('loan.create');
    Route::post('loan', [\App\Http\Controllers\LoanController::class, 'store']);
    Route::get('loan/{id}/edit', [\App\Http\Controllers\LoanController::class, 'edit'])->name('loan.edit');
    Route::put('loan/{id}', [\App\Http\Controllers\LoanController::class, 'update']);
    Route::delete('loan/{id}', [\App\Http\Controllers\LoanController::class, 'destroy'])->name('loan.destroy');
    Route::get('loan/search', [\App\Http\Controllers\LoanController::class, 'search'])->name('loan.search');
    Route::get('/loan/autocomplete', [\App\Http\Controllers\LoanController::class, 'autocomplete']);
    Route::get('/loan/filter', [\App\Http\Controllers\LoanController::class, 'filter'])->name('loan.filter');
    Route::get('loan/{id}', [\App\Http\Controllers\LoanController::class, 'show']);

    // Restoration Routes

    Route::get('restoration', [\App\Http\Controllers\RestorationController::class, 'index'])->name('restoration');
    Route::get('restoration/create', [\App\Http\Controllers\RestorationController::class, 'create'])->name('restoration.create');
    Route::post('restoration', [\App\Http\Controllers\RestorationController::class, 'store']);
    Route::get('restoration/{id}/edit', [\App\Http\Controllers\RestorationController::class, 'edit'])->name('restoration.edit');
    Route::put('restoration/{id}', [\App\Http\Controllers\RestorationController::class, 'update'])->name('restoration.update');
    Route::delete('restoration/{id}', [\App\Http\Controllers\RestorationController::class, 'destroy'])->name('restoration.destroy');
    Route::get('restoration/search', [\App\Http\Controllers\RestorationController::class, 'search'])->name('restoration.search');
    Route::get('/restoration/autocomplete', [\App\Http\Controllers\RestorationController::class, 'autocomplete']);
    Route::get('/restoration/filter', [\App\Http\Controllers\ReservationController::class, 'filter'])->name('restoration.filter');
    Route::get('restoration/{id}', [\App\Http\Controllers\RestorationController::class, 'show']);


    // Image Routes
    Route::get('image', [\App\Http\Controllers\ImageController::class, 'index'])->name('image');
    Route::get('image/create', [\App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
    Route::post('image', [\App\Http\Controllers\ImageController::class, 'store']);
    Route::get('image/{id}/edit', [\App\Http\Controllers\ImageController::class, 'edit'])->name('image.edit');
    Route::put('image/{id}', [\App\Http\Controllers\ImageController::class, 'update']);
    Route::delete('image/{id}', [\App\Http\Controllers\ImageController::class, 'destroy'])->name('image.destroy');
    Route::get('image/search', [\App\Http\Controllers\ImageController::class, 'search'])->name('image.search');
    Route::get('/image/autocomplete', [\App\Http\Controllers\ImageController::class, 'autocomplete']);
    Route::get('/image/filter', [\App\Http\Controllers\ImageController::class, 'filter'])->name('image.filter');
    Route::get('image/{id}', [\App\Http\Controllers\ImageController::class, 'show']);

    // Inventory_notice Routes
    Route::get('inventory_notice', [\App\Http\Controllers\Inventory_noticeController::class, 'index'])->name('inventory_notice');
    Route::post('inventory_notice', [\App\Http\Controllers\Inventory_noticeController::class, 'store']);
    Route::delete('inventory_notice/{id}', [\App\Http\Controllers\Inventory_noticeController::class, 'destroy'])->name('inventory_notice.destroy');
    Route::get('inventory_notice/search', [\App\Http\Controllers\Inventory_noticeController::class, 'search'])->name('inventory_notice.search');
    Route::get('/inventory_notice/autocomplete', [\App\Http\Controllers\Inventory_noticeController::class, 'autocomplete']);
    Route::get('inventory_notice/{id}', [\App\Http\Controllers\Inventory_noticeController::class, 'show']);

    // Logout Route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Reservation Routes
    Route::get('reservation', [\App\Http\Controllers\ReservationController::class, 'index'])->name('reservation');
    Route::get('reservation/create', [\App\Http\Controllers\ReservationController::class, 'create'])->name('reservation.create');
    Route::post('reservation', [\App\Http\Controllers\ReservationController::class, 'store']);
    Route::get('reservation/{id}/edit', [\App\Http\Controllers\ReservationController::class, 'edit'])->name('reservation.edit');
    Route::put('reservation/{id}', [\App\Http\Controllers\ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('reservation/{id}', [\App\Http\Controllers\ReservationController::class, 'destroy'])->name('reservation.destroy');
    Route::get('reservation/search', [\App\Http\Controllers\ReservationController::class, 'search'])->name('reservation.search');
    Route::get('/reservation/autocomplete', [\App\Http\Controllers\ReservationController::class, 'autocomplete']);
    Route::get('/reservation/filter', [\App\Http\Controllers\ReservationController::class, 'filter'])->name('reservation.filter');
    Route::get('reservation/{id}', [\App\Http\Controllers\ReservationController::class, 'show']);

    // Material Routes
    Route::get('material', [\App\Http\Controllers\MaterialController::class, 'index'])->name('material');
    Route::get('material/create', [\App\Http\Controllers\MaterialController::class, 'create'])->name('material.create');
    Route::post('material', [\App\Http\Controllers\MaterialController::class, 'store']);
    Route::post('materialart', [\App\Http\Controllers\MaterialController::class , 'storeForArtwork']);
    Route::get('material/{id}/edit', [\App\Http\Controllers\MaterialController::class, 'edit'])->name('material.edit');
    Route::put('material/{id}', [\App\Http\Controllers\MaterialController::class, 'update'])->name('material.update');
    Route::delete('material/{id}', [\App\Http\Controllers\MaterialController::class, 'destroy'])->name('material.destroy');
    Route::get('material/search', [\App\Http\Controllers\MaterialController::class, 'search'])->name('material.search');
    Route::get('/material/autocomplete', [\App\Http\Controllers\MaterialController::class, 'autocomplete']);
    Route::get('/material/filter', [\App\Http\Controllers\MaterialController::class, 'filter'])->name('material.filter');
    Route::get('material/{id}', [\App\Http\Controllers\MaterialController::class, 'show']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');