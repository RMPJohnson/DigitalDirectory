<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/', function () {
        return view('directory');
    });

    Route::prefix('administrator')->group(function () {
        Auth::routes();

        Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/change-password', [UserController::class, 'changepassword'])->name('change-password');
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);


    });
});
