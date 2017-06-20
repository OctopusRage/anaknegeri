<?php

namespace App\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WalletDeposit;
use Datatables;

class HistoryController extends Controller
{
    public function index()
    {
        return view('admin.wallet.confirm-history');
    }

    public function getHistory(){
        $deposit = WalletDeposit::where('confirmed',true)->get();
        return Datatables::of($deposit)
            ->addColumn('owner', function($depo){
                return $depo->wallet->user->name;
            })
            ->editColumn('amount', function($depo){
                return "Rp. ".$depo->amount;
            })
            ->editColumn('status', function($depo){
                return $depo->getStatus();
            })
            ->editColumn('token', function($depo){
                return substr($depo->token, 0, 32)."...";
            })
            ->editColumn('updated_at', function($depo){
                return date('d M Y H:i:s', strtotime($depo->updated_at));
            })
            ->addColumn('action', function($depo){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoWallet" data-id="'.
                    $depo->id.'">
                    <i class="icon-info"></i>
                </button>
                ';
            })
            ->make(true);
    }
}
