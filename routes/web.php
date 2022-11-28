<?php

use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     //return redirect()->route('home');
// });

Route::controller(DashboardController::class)->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('store-data', 'featchStoreData')->name('store.data');
    Route::post('search-data', 'searchAuthorData')->name('search.data');
});
