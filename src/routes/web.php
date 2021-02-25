<?php

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

/**
 * Front end logout
 */
Route::get('logout-social', 'AuthController@logout')->name('front.logout');
Route::post('logout-social', 'AuthController@logout')->name('front.logout');

Route::post('redirect/{driver}', 'AuthController@redirect')->name('login.provider');
Route::get('{driver}/callback', 'AuthController@callback')->name('login.callback')->where('driver', implode('|', config('auth.socialite.drivers')));
