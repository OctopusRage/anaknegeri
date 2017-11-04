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
use Validator;

class DepositController extends Controller
{

    public function validator(array $data){
        $validator = Validator::make($data, [
            'image' => 'required',
            'amount' => 'required|min:50000'
        ],[
            'amount.min'    => 'Top up minimal yang bisa dilakukan adalah Rp.50.0000',
            'amount.required' => 'Mohon isi jumlah transfer anda',
            'image.required' => 'silahkan serahkan bukti transfer',
        ]);
        return $validator;
    }

    public function store(Request $request){
        $validator = $this->validator($request->all());
        if($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Data yang anda masukkan kurang lengkap')->with('status', 'danger');
        }
        $id = Auth::user()->id;
        $image = $this->processImage(Input::file('image'));
        $wallet = Wallet::where('user_id', $id)->firstOrFail();

        $deposit = WalletDeposit::create(array(
            'token' => str_random(64),
            'amount' => $request->get('amount'),
            'image' => $image,
            'wallet_id'=> $wallet->id
        ));
        $deposit->save();

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Upload berhasil, tunggu konfirmasi admin sampai dompet terisi');

    }


    public function show(Request $request, $id){
        $deposit = WalletDeposit::whereId($id)->firstOrFail();

        if ($request->ajax()) {
            $view = view('components.profile.detail',compact('deposit'))->render();
            return response()->json(['html'=>$view]);
        } 
    }

    public function getDeposits(){
        $id = Auth::user()->id;
        $wallet = Wallet::where('user_id', $id)
            ->firstOrFail();
        $walletDeposit = WalletDeposit::where('wallet_id', $wallet->id)
            ->get();
        return Datatables::of($walletDeposit)        
            ->editColumn('created_at', function($depo){
                return   date('d M Y H:i:s', strtotime($depo->created_at));
            })
            ->editColumn('amount', function($walletDepo){
                return   "Rp. ".$walletDepo->amount;
            })
            ->editColumn('status', function($walletDepo){
                return   $walletDepo->getStatus();
            })
            ->addColumn('action', function($walletDepo){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoDeposit" data-id="'.$walletDepo->id.'">
                    <i class="icon-info"></i>
                </button>
                ';
            })
            ->make(true);
    }


    public function processImage($image){
        $randomString = str_random(64);
        $input =  $randomString . '.' . $image->getClientOriginalExtension();
   
        $destinationPath = public_path('img/confirms/'. $input);

        $img = Image::make($image
            ->getRealPath())
            ->resize(null, 480, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPath);

        return $input;
    }

 
}

