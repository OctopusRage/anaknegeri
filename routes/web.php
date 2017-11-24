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
    Route::get('detail/{slug}/edit', ['as' => $campaign . 'edit', 'uses' => 'Campaign\CampaignController@edit']);
    Route::post('detail/{id}/update', ['as' => $campaign . 'update', 'uses' => 'Campaign\CampaignController@update']);
    Route::get('/popular', ['as' => $campaign . 'popular', 'uses' => 'Campaign\CampaignController@popular']);
    Route::get('/category/{slug}', ['as' => $campaign . 'category', 'uses' => 'Campaign\CampaignController@category']);
    Route::get('/detail/{slug}/report/{report_id}', ['as' => $campaign . 'detailReport', 'uses' => 'Campaign\ReportController@show']);

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
        Route::post('/{id}/update',['as' => $user . 'postEditAccount', 'uses' => 'AccountController@updateAccount']);
        Route::get('/campaign', ['as' => $user . 'campaign', 'uses' => 'ProfileController@campaign']);
        Route::get('/campaign/{id}/withdraw', ['as' => $user . 'withdraw', 'uses' => 'Campaign\WithdrawController@index']);
        Route::post('/campaign/{id}/withdraw', ['as' => $user . 'postWithdraw', 'uses' => 'Campaign\WithdrawController@store']);
        Route::get('/campaign/{id}/withdraw/withdraws', ['as' => $user . 'getWithdraws', 'uses' => 'Campaign\WithdrawController@getWithdraws']);
        Route::get('/campaign/{id}/withdraw/{with_id}/show', ['as' => $user . 'showWithdraw', 'uses' => 'Campaign\WithdrawController@showWithdraw']);
        Route::get('/campaign/{id}/report', ['as' => $user . 'report', 'uses' => 'Campaign\ReportController@index']);
        Route::post('/campaign/{id}/report', ['as' => $user . 'postReport', 'uses' => 'Campaign\ReportController@store']);
        Route::get('/campaign/{id}/report/reports', ['as' => $user . 'getReports', 'uses' => 'Campaign\ReportController@getReports']);
        Route::get('/wallet', ['as' => $user . 'wallet', 'uses' => 'Wallet\WalletController@index']);
        Route::post('/wallet/deposit', ['as' => $user . 'deposit', 'uses' => 'Wallet\DepositController@store']);
        Route::get('/wallet/deposit/{id}', ['as' => $user . 'depositDetail', 'uses' => 'Wallet\DepositController@show']);
        Route::get('wallet/deposit', ['as' => $user . 'getDeposits', 'uses' => 'Wallet\DepositController@getDeposits']);
        Route::get('account', ['as' => $user . 'account', 'uses' => 'AccountController@index']);
        Route::post('account/{id}/change_password`', ['as' => $user . 'postEditPassword', 'uses' => 'AccountController@updatePassword']);
        Route::post('verify/{id}', ['as' => $user . 'postVerification', 'uses' => 'AccountController@createVerificationRequest']);

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
    Route::post('user', ['as' => $admin . 'addUser', 'uses' => 'UserController@store']);
    Route::get('user/users', ['as' => $admin . 'getUsers', 'uses' => 'UserController@getUsers']);
    Route::get('user/{id}/show', ['as' => $admin . 'showUser', 'uses' => 'UserController@showUser']);
    Route::get('user/add-modal',['as' => $admin . 'addModal', 'uses' => 'UserController@addModal']);
    Route::get('user/{id}/edit',['as' => $admin . 'editUser', 'uses' => 'UserController@edit']);
    Route::post('user/{id}/edit',['as' => $admin . 'postEditUser', 'uses' => 'UserController@update']);

    Route::get('verifications', ['as' => $admin . 'verifications', 'uses' => 'VerificationController@index']);
    Route::get('verifications/json', ['as' => $admin . 'getUsersVerification', 'uses' => 'VerificationController@getVerifications']);
    Route::post('verification/{id}/confirm',['as' => $admin . 'postConfirmVerification', 'uses' => 'VerificationController@confirm']);

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

    Route::get('withdraw/finance', ['as' => $admin . 'withdrawFinance', 'uses' => 'Withdraw\FinanceController@index']);
    Route::post('withdraw/finance', ['as' => $admin . 'confirmWithdrawFinance', 'uses' => 'Withdraw\FinanceController@store']);
    Route::get('withdraw/finance/withdraws', ['as' => $admin . 'getWithdrawFinances', 'uses' => 'Withdraw\FinanceController@getWithdrawFinances']);
    Route::get('withdraw/finance/{id}/show', ['as' => $admin . 'showWithdrawFinance', 'uses' => 'Withdraw\FinanceController@showWithdrawFinance']);
    Route::get('withdraw/finance/history', ['as' => $admin . 'financeWithdrawHistory', 'uses' => 'Withdraw\FinanceController@history']);
    Route::get('withdraw/finance/history/histories', ['as' => $admin . 'getFinanceWithdrawHistory', 'uses' => 'Withdraw\FinanceController@getHistory']);
    Route::get('withdraw/finance/history/{id}/show', ['as' => $admin . 'showFinanceWithdrawHistory', 'uses' => 'Withdraw\FinanceController@showHistory']);

    Route::get('withdraw/logistic', ['as' => $admin . 'withdrawLogistic', 'uses' => 'Withdraw\NonFinanceController@index']);
    Route::post('withdraw/logistic', ['as' => $admin . 'confirmWithdrawLogistic', 'uses' => 'Withdraw\NonFinanceController@store']);
    Route::get('withdraw/logistic/withdraws', ['as' => $admin . 'getWithdrawLogistics', 'uses' => 'Withdraw\NonFinanceController@getWithdrawLogistics']);
    Route::get('withdraw/logistic/{id}/show', ['as' => $admin . 'showWithdrawLogistic', 'uses' => 'Withdraw\NonFinanceController@showWithdrawLogistic']);
    Route::get('withdraw/logistic/history', ['as' => $admin . 'logisticWithdrawHistory', 'uses' => 'Withdraw\NonFinanceController@history']);
    Route::get('withdraw/logistic/history/histories', ['as' => $admin . 'getLogisticWithdrawHistory', 'uses' => 'Withdraw\NonFinanceController@getHistory']);
    Route::get('withdraw/logistic/history/{id}/show', ['as' => $admin . 'showLogisticWithdrawHistory', 'uses' => 'Withdraw\NonFinanceController@showHistory']);
    Route::get('report', ['as' => $admin . 'report', 'uses' => 'Campaign\ReportController@adminindex']);    
    Route::get('report/{id}/show', ['as' => $admin . 'showReport', 'uses' => 'Campaign\ReportController@showReport']);
    Route::get('report/reports', ['as' => $admin . 'getAllReports', 'uses' => 'Campaign\ReportController@getAllReports']);
});


/*
*******************
Auth:Finansial\\
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

