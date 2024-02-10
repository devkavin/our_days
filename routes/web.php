<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\NavbarController;
use App\Http\Controllers\Profile\PhotoController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('landing');
});



Auth::routes();

Route::get('landing', [App\Http\Controllers\LandingController::class, 'index']);

Route::redirect('/home', '/landing'); // Add this line to redirect /home to /landing

Route::group(['middleware' => 'auth'], function () {
    Route::resource('profile', ProfileController::class);
    Route::get('load-profile-details', [ProfileController::class, 'loadProfileDetails']);

    // Route::resource('photos', PhotoController::class);
    Route::post('photos', [PhotoController::class, 'update'])->name('photos.update');
    // Route::delete('photos', [PhotoController::class, 'destroy'])->name('photos.destroy');

    Route::resource('profile.photos', PhotoController::class);
    Route::get('load-photos', [PhotoController::class, 'loadPhotos']);
    Route::post('profile.photos', [PhotoController::class, 'store']);
    Route::get('profile.photos', [PhotoController::class, 'update']);
    Route::delete('profile.photos', [PhotoController::class, 'destroy']);

    // /home route
    // Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::res('landing', [App\Http\Controllers\HomeController::class, 'index']);
    // Route::resource('landing', App\Http\Controllers\LandingController::class);
    // Route::get('landing', [App\Http\Controllers\LandingController::class, 'index']);
});

Route::get('/run-migration', function () {
    Artisan::call('optimize:clear');
    Artisan::call('migrate:fresh --seed');

    return 'Migration complete';
});
