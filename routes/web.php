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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/term-condition', function () {
    return view('term-condition');
})->name('term-condition');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('campaign', function () {
    return view('campaign');
})->name('campaign');

Route::get('campaign/campaign-detail', function () {
    return view('campaign.detail');
})->name('campaign-detail');


Route::get('campaign/donate', function () {
    return view('campaign/donate');
})->name('campaign-donate');


Route::get('profile', function () {
    return view('profile');
})->name('profile');

Route::get('profile/campaign', function () {
    return view('profile.campaign');
})->name('profile-campaign');

Route::get('profile/wallet', function () {
    return view('profile/wallet');
})->name('profile-wallet');

Route::get('profile/wallet/deposit', function () {
    return view('profile/wallet/deposit');
})->name('profile-wallet-deposit');

Route::get('profile/account', function () {
    return view('profile/account');
})->name('profile-account');

Auth::routes();

Route::get('organisasi', function () {
    return view('organisasi');
})->name('organisasi');

Route::get('/admin', function () {
    return view('admin.home');
})->name('dashboard');

