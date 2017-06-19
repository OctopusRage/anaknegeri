<?php

namespace App\Http\Controllers;

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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDeposits(){
        $id = Auth::user()->id;
        $wallet = Wallet::where('user_id', $id)
            ->firstOrFail();
        $walletDeposit = WalletDeposit::where('wallet_id', $wallet->id)
            ->get();
        return Datatables::of($walletDeposit)
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

    public function deposit(Request $request){
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

    public function depositDetail(Request $request, $id){
        $deposit = WalletDeposit::whereId($id)->firstOrFail();

        if ($request->ajax()) {
            $view = view('components.profile.detail',compact('deposit'))->render();
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
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoDeposit" data-id="'.$wallet->id.'">
                    <i class="icon-info"></i>
                </button>
                ';
            })
            ->make(true);
    }

}
