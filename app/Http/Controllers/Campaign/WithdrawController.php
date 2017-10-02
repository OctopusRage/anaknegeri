<?php

namespace App\Http\Controllers\Campaign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\WithdrawRequest;
use Datatables;
use Validator;



class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $campaign = Campaign::whereId($id)->firstOrFail();
        return view('profile.campaign.withdraw')
            ->with('campaign', $campaign);
    }


    public function getWithdraws($id){
        $campaign= Campaign::whereId($id)->firstOrFail();
        $withdraws = WithdrawRequest::where('campaign_id', $campaign->id)->get();
        return Datatables::of($withdraws)
            ->editColumn('status', function($withdraw){
                return   $withdraw->getStatus();
            })
            ->addColumn('action', function($withdraw){
                return '                
                <button class="btn btn-sm btn-info info" data-toggle="modal" data-target="#infoWithdraw" data-id="'.$withdraw->id.'">
                    <i class="icon-info"></i>
                </button>
                ';
            })->make(true);
    }

    public function showWithdraw(Request $request, $id, $with_id){
        $campaign = Campaign::where('id',$id)->firstOrFail();
        $withdraw = WithdrawRequest::whereId($with_id)->firstOrFail();

        if ($request->ajax()) {
            $view = view('components.profile.detail-withdraw',compact('withdraw', 'campaign'))->render();
            return response()->json(['html'=>$view]);
        } 
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
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'amount_bank' => 'required',
            'bank_detail' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->with('status', 'warning')->with('message', 'Terjadi beberapa kesalahan input')->withInput();
        }

        $campaign = Campaign::whereId($id)->firstOrFail();

        if($request->get('type')=="Finansial"){
            $item = 'Dana';
            $amount = $request->get('amount_bank');
            $detail = $request->get('bank_detail');
        }else{
            $item = $request->get('item');
            $amount = $request->get('amount');   
            $detail = $request->get('detail');   
        }

        if ($request->amount_bank > $campaign->getAvailableForWithdraw()) {
            return back()->with('status', 'warning')
                ->with('message', 'Dana penarikan tidak sesuai');
        }

        $withdraw = new WithdrawRequest(array(
            'item' => $item,
            'amount' => $amount,
            'detail' => $detail
        ));
        $withdraw->assignCampaign($campaign->id);
        $withdraw->save();

        return redirect()->back()
            ->with('message','Permintaan penarikan berhasil, silakan menunggu konfirmasi dari admin.')
            ->with('status', 'success');

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
}
