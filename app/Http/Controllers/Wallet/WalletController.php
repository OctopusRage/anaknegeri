<?php

namespace App\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletDeposit;
use Datatables;
use Auth;
use Image;
use Input;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.wallet');
    }

    public function adminindex()
    {
        return view('admin.wallet.index');
    }

    public function show(Request $request, $id){
        $wallet = Wallet::where('id',$id)->firstOrFail();
        $deposit = WalletDeposit::where('wallet_id', $wallet->id)->get()->last();
        if ($request->ajax()) {
            $view = view('admin.components.wallet.detail-wallet',compact('wallet','deposit'))->render();
            return response()->json(['html'=>$view]); 
        } 
    }

    public function getWallets(){
        $wallets = Wallet::all();
        return Datatables::of($wallets)
            ->addColumn('owner', function($wallet){
                return $wallet->user->name;
            })
            ->editColumn('total', function($wallet){
                return   "Rp. ".$wallet->total;
            })
            ->addColumn('action', function($wallet){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoWallet" data-id="'.$wallet->id.'">
                    <i class="icon-info"></i>
                </button>
                ';
            })
            ->make(true);
    }
}
