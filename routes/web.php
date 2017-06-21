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
// Route::get('/campaign', 'Campaign\CampaignController@index')->name('campaign');

Route::group(['prefix' => 'campaign'], function() {
    $campaign = 'campaign.';

    Route::get('/', ['as' => $campaign . 'home', 'uses' => 'Campaign\CampaignController@index']);

    Route::get('detail/{slug}', ['as' => $campaign . 'detail', 'uses' => 'Campaign\CampaignController@show']);

    Route::get('detail/{slug}/comment', ['as' => $campaign . 'comments', 'uses' => 'Campaign\CampaignController@comment']);


    Route::get('/popular', ['as' => $campaign . 'popular', 'uses' => 'Campaign\CampaignController@popular']);

    Route::get('/category/{slug}', ['as' => $campaign . 'category', 'uses' => 'Campaign\CampaignController@category']);


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

        Route::get('/create', ['as' => $campaign . 'create', 'uses' => 'Campaign\CampaignController@create']);

        Route::post('/', ['as' => $campaign . 'store', 'uses' => 'Campaign\CampaignController@store']);

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

        Route::get('/campaign', ['as' => $user . 'campaign', 'uses' => 'ProfileController@campaign']);

        Route::get('/campaign/{id}/withdraw', ['as' => $user . 'campaign', 'uses' => 'Campaign\RequestSupportController@index']);

        Route::get('/campaign/{id}/withdraw', ['as' => $user . 'campaign', 'uses' => 'Campaign\RequestSupportController@index']);

        Route::get('/wallets', ['as' => $user . 'wallet', 'uses' => 'Wallet\WalletController@index']);


        Route::post('/wallets/deposit', ['as' => $user . 'deposit', 'uses' => 'Wallet\DepositController@store']);

        Route::get('/wallets/deposit/{id}', ['as' => $user . 'depositDetail', 'uses' => 'Wallet\DepositController@show']);

        Route::get('wallets/deposit', ['as' => $user . 'getDeposits', 'uses' => 'Wallet\DepositController@getDeposits']);



    });

    Route::group(['prefix' => 'campaign'], function() {
        $campaign='campaign.';
        
        Route::get('/detail/{slug}/donate', ['as' => $campaign . 'donate', 'uses' => 'Campaign\SupportController@create']);

        Route::post('/detail/{slug}/donate', ['as' => $campaign . 'donates', 'uses' => 'Campaign\SupportController@store']);

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



    Route::get('campaign', ['as' => $admin . 'campaign', 'uses' => 'Campaign\CampaignController@adminindex']);

    Route::get('campaign/campaigns', ['as' => $admin . 'getCampaigns', 'uses' => 'Campaign\CampaignController@getCampaigns']);

    Route::get('campaign/{id}/show', ['as' => $admin . 'showCampaign', 'uses' => 'Campaign\CampaignController@showCampaign']);



    Route::get('wallet', ['as' => $admin . 'wallet', 'uses' => 'Wallet\WalletController@adminindex']);

    Route::get('wallet/{id}/show', ['as' => $admin . 'showWallet', 'uses' => 'Wallet\WalletController@show']);

    Route::get('wallet/wallets', ['as' => $admin . 'getWallets', 'uses' => 'Wallet\WalletController@getWallets']);




    Route::get('wallet/confirm', ['as' => $admin . 'confirm', 'uses' => 'Wallet\ConfirmationController@index']);
   
    Route::post('wallet/confirm', ['as' => $admin . 'confirmDeposit', 'uses' => 'Wallet\ConfirmationController@store']);

    Route::get('wallet/confirm/requests', ['as' => $admin . 'confirmRequests', 'uses' => 'Wallet\ConfirmationController@getConfirmationRequests']);

    Route::get('wallet/confirm/{id}/show', ['as' => $admin . 'showRequest', 'uses' => 'Wallet\ConfirmationController@showRequest']);



    Route::get('wallet/confirm/history', ['as' => $admin . 'history', 'uses' => 'Wallet\HistoryController@index']);

    Route::get('wallet/confirm/history/histories', ['as' => $admin . 'getHistory', 'uses' => 'Wallet\HistoryController@getHistory']);

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
//     Route::get('campaign', ['as' => $finance . 'campaign', 'uses' => 'Campaign\CampaignController@adminindex']);
//     /**
//      * Get User (Datatables serverside implementation)
//      */
//     Route::get('campaign/campaigns', ['as' => $finance . 'getCampaigns', 'uses' => 'Campaign\CampaignController@getCampaigns']);

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
//     Route::get('campaign', ['as' => $logistic . 'campaign', 'uses' => 'Campaign\CampaignController@adminindex']);
//     /**
//      * Get User (Datatables serverside implementation)
//      */
//     Route::get('campaign/campaigns', ['as' => $logistic . 'getCampaigns', 'uses' => 'Campaign\CampaignController@getCampaigns']);

// });

