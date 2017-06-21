<?php

namespace App\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WalletDeposit;
use App\Models\Wallet;
use Datatables;
use Mail;

class ConfirmationController extends Controller
{
    
    public function index()
    {
        return view('admin.wallet.confirm');
    }

    public function store(Request $request)
    {   

        $deposit = WalletDeposit::where('id', $request->id)->firstOrFail();        
        $wallet = Wallet::where('id', $deposit->wallet_id)->firstOrFail();
        $user = $wallet->user()->firstOrFail();

        if($request->type == 'accept')
        {   
            $deposit->accepted();
            $wallet->total = $wallet->total + $deposit->amount;
            $wallet->save(); 
            $status = "Diterima";           

        }else if($request->type == "reject")
        {
            $deposit->rejected();  
            $status = "Ditolak"; 
        }
        
        $data['email'] = $user->email;
        $data['name'] = $user->name;
        $data['status'] = $status;

        Mail::send('emails.deposit', $data, function($message) use ($data)
        {
            $message->from('weniindya@gmail.com', "Anaknegeri");
            $message->subject("Konfirmasi Deposit Dompet");
            $message->to($data['email'], $data['name']);   
        }); 

        return response()->json([
            'message' => $status
        ]);
    }

    public function getConfirmationRequests()
    {
        $requests = WalletDeposit::where('confirmed',false)->get();
        return Datatables::of($requests)
            ->addColumn('owner', function($request){
                return $request->wallet->user->name;
            })
            ->addColumn('action', function($request){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoWallet" data-id="'.
                    $request->id.'">
                    <i class="icon-info"></i>
                </button>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-action="accept" data-target="#actionWallet" data-id="'.
                    $request->id.'">
                    <i class="icon-check"></i>
                </button>
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-action="reject"  data-target="#actionWallet" data-id="'.
                    $request->id.'">
                    <i class="icon-close"></i>
                </button>
                ';
            })
            ->make(true);
    }

    public function showRequest(Request $request, $id){
        $deposit = WalletDeposit::where('id',$id)->firstOrFail();

        if ($request->ajax()) {
            $view = view('admin.components.wallet.detail-request',compact('deposit'))->render();
            return response()->json(['html'=>$view]); 
        } 
    }


}
