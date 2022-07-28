<?php

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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    // Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'))->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register');
        Route::post('/register', 'RegisterController@register')->name('register');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout');
    });

    // user protected routes
    Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
        Route::get('/', 'HomeController@index')->name('user_dashboard');
    });

    // admin protected routes
    Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
        Route::get('/', 'HomeController@index')->name('admin_dashboard');
    });

    Route::resource('car',CarController::class)->middleware('auth');
});
