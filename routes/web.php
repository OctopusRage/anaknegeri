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

Route::get('/forbidden', function () {
    return view('banner.403');
})->name('forbidden');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/term-condition', function () {
    return view('term-condition');
})->name('term-condition');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('campaign/donate', function () {
    return view('campaign/donate');
})->name('campaign-donate');

Route::get('profile/account', function () {
    return view('profile/account');
})->name('profile-account');


Route::get('organisasi', function () {
    return view('organisasi');
})->name('organisasi');



Route::get('admin', function () {
    return view('admin.home');
})->middleware('auth');


Route::get('/', 'HomeController@index')->name('home');



/*
*******************
Guest Access
*******************
*/

/**
 * Complete Auth Routes
 * Access on App\Controllers\Auth
 */

Auth::routes();

/**
 * Activation link after button click on email 
 * @param user's token
 */
Route::get('/activate/{token}', 'Auth\RegisterController@activate');

/**
 * Activation link after button click on email 
 * @param user's token
 */
Route::get('/activate/{token}', 'Auth\RegisterController@activate');

/**
 * Get Campaign for 
 * @param Campaign's Catgory
 */
// Route::get('/campaign', 'CampaignController@index')->name('campaign');

Route::group(['prefix' => 'campaign'], function() {
    $campaign = 'campaign.';

    Route::get('/', ['as' => $campaign . 'home', 'uses' => 'CampaignController@index']);

    Route::get('detail/{slug}', ['as' => $campaign . 'detail', 'uses' => 'CampaignController@show']);

    Route::get('/{slug}/donate', ['as' => $campaign . 'donate', 'uses' => 'CampaignController@donate']);

    Route::get('/popular', ['as' => $campaign . 'popular', 'uses' => 'CampaignController@popular']);

    Route::get('/category/{slug}', ['as' => $campaign . 'category', 'uses' => 'CampaignController@category']);


});

/*
*******************
Auth:All Access
*******************
*/

Route::group(['middleware' => 'auth:all'], function()
{
    $a = 'authenticated.';
    /**
     * Logout for All user
     */
    Route::get('/logout', ['as' => $a . 'logout', 'uses' => 'Auth\LoginController@logout']);

    
    /**
     * Resend Email Activation
     * @param user_id
     */
    Route::get('/resend/{id}', ['as' => $a . 'resend', 'uses' => 'UserController@activateUser']);

    Route::group(['prefix' => 'campaign'], function()
    {
        $campaign='campaign.';

        Route::get('/create', ['as' => $campaign . 'create', 'uses' => 'CampaignController@create']);

        Route::post('/', ['as' => $campaign . 'store', 'uses' => 'CampaignController@store']);

    });

    /*
    *******************
    Access with Prefix "PROFILE"
    *******************
    */

    Route::group(['prefix' => 'profile'], function()
    {
        $user = 'profile.';

        Route::get('/', ['as' => $user . 'home', 'uses' => 'ProfileController@index']);

        Route::get('/wallets', ['as' => $user . 'wallet', 'uses' => 'WalletController@index']);

        Route::get('/campaign', ['as' => $user . 'campaign', 'uses' => 'ProfileController@campaign']);

        Route::post('/wallets/deposit', ['as' => $user . 'deposit', 'uses' => 'WalletController@deposit']);

        Route::get('/wallets/deposit/{id}', ['as' => $user . 'depositDetail', 'uses' => 'WalletController@depositDetail']);

        Route::get('wallets/deposit', ['as' => $user . 'getDeposits', 'uses' => 'WalletController@getDeposits']);

    });

});

/*
*******************
Auth:Organisasi
*******************
*/



/*
*******************
Auth:Administrator
*******************
*/
Route::group(['prefix' => 'admin','middleware' => 'auth:administrator'], function()
{
    $admin = 'admin.';

    Route::get('/', ['as' => $admin . 'index', 'uses' => 'DashboardController@index']);

    Route::get('user', ['as' => $admin . 'user', 'uses' => 'UserController@index']);

    Route::get('user/users', ['as' => $admin . 'getUsers', 'uses' => 'UserController@getUsers']);

    Route::get('user/{id}/show', ['as' => $admin . 'showUser', 'uses' => 'UserController@showUser']);

    Route::get('campaign', ['as' => $admin . 'campaign', 'uses' => 'CampaignController@adminindex']);

    Route::get('campaign/campaigns', ['as' => $admin . 'getCampaigns', 'uses' => 'CampaignController@getCampaigns']);

    Route::get('campaign/{id}/show', ['as' => $admin . 'showCampaign', 'uses' => 'CampaignController@showCampaign']);

});


/*
*******************
Auth:Finansial
*******************
*/
// Route::group(['prefix' => 'finance','middleware' => 'auth:finance'], function()
// {
//     $finance = 'admin.';
//     /**
//      * Get Admin Dashboard Home
//      */
//     Route::get('/', ['as' => $finance . 'index', 'uses' => 'DashboardController@index']);
//     /**
//      * User management home
//      */
//     Route::get('user', ['as' => $finance . 'user', 'uses' => 'UserController@index']);
//     /**
//      * Get User (Datatables serverside implementation)
//      */
//     Route::get('user/users', ['as' => $finance . 'getUsers', 'uses' => 'UserController@getUsers']);

//     /**
//      * Campaign management home
//      */
//     Route::get('campaign', ['as' => $finance . 'campaign', 'uses' => 'CampaignController@adminindex']);
//     /**
//      * Get User (Datatables serverside implementation)
//      */
//     Route::get('campaign/campaigns', ['as' => $finance . 'getCampaigns', 'uses' => 'CampaignController@getCampaigns']);

// });


/*
*******************
Auth:Logistik
*******************
// */
// Route::group(['prefix' => 'logistic','middleware' => 'auth:logistic'], function()
// {
//     $logistic = 'admin.';
//     /**
//      * Get Admin Dashboard Home
//      */
//     Route::get('/', ['as' => $logistic . 'index', 'uses' => 'DashboardController@index']);
//     /**
//      * User management home
//      */
//     Route::get('user', ['as' => $logistic . 'user', 'uses' => 'UserController@index']);
//     /**
//      * Get User (Datatables serverside implementation)
//      */
//     Route::get('user/users', ['as' => $logistic . 'getUsers', 'uses' => 'UserController@getUsers']);

//     /**
//      * Campaign management home
//      */
//     Route::get('campaign', ['as' => $logistic . 'campaign', 'uses' => 'CampaignController@adminindex']);
//     /**
//      * Get User (Datatables serverside implementation)
//      */
//     Route::get('campaign/campaigns', ['as' => $logistic . 'getCampaigns', 'uses' => 'CampaignController@getCampaigns']);

// });

