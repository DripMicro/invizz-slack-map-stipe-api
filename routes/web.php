<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'WelcomeController@index');
Route::post('/search', 'SearchController@SearchByLocation');
Route::post('/all_view', 'SearchController@AllView');
Route::post('/filterbytype', 'SearchController@FilterByType');
Route::post('/profiledialog', 'SearchController@profileDialog');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Profile setting
Route::post('/image-upload/{id}', 'ProfileController@imageUploadPost')->name('image.upload.post');
Route::post('/profile-add-type', 'ProfileController@addArtistType')->name('profile.addtype');
Route::get('/profile/{id}', 'ProfileController@edit');
Route::resource('profile','ProfileController');

/// Email Verification

Route::get('/not-activated', 'EmailVerifyController@ToVerify')->name('email.toverify');

Route::post('/not-activated', 'EmailVerifyController@EmailVerify')->name('email.verify');

Route::get('/auth/{confirm}', 'WelcomeController@auth');

Route::get('/signin/{confirm}', function () {
    return redirect('/');
});

Route::post('/leave-feedback', 'EmailVerifyController@LeaveFeedback')->name('email.feedback');
