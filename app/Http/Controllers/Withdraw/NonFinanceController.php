<?php

namespace App\Http\Controllers\Withdraw;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use App\Models\Campaign;
use Datatables;

class NonFinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        return view('admin.withdraw.nonfinance.index');
    }


    public function getWithdrawLogistics()
    {
        $withdraws = WithdrawRequest::where('confirmed', false)->where('item','!=','Dana')->get();
        return Datatables::of($withdraws) 
            ->addColumn('campaign_title', function($withdraw){
                return $withdraw->campaign->title;
            })       
            ->editColumn('created_at', function($withdraw){
                return   date('d M Y H:i:s', strtotime($withdraw->created_at));
            })
            ->editColumn('status', function($withdraw){
                return   $withdraw->getStatus();
            })
            ->addColumn('action', function($withdraw){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoWithdraw" data-id="'.$withdraw->id.'">
                    <i class="icon-info"></i>
                </button>                
                <button class="btn btn-sm btn-success" data-toggle="modal" data-action="accept" data-target="#actionWithdraw" data-id="'.
                    $withdraw->id.'">
                    <i class="icon-check"></i>
                </button>
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-action="reject"  data-target="#actionWithdraw" data-id="'.
                    $withdraw->id.'">
                    <i class="icon-close"></i>
                </button>
                ';
            })
            ->make(true);
    }

    public function showWithdrawLogistic(Request $request, $id)
    {
        $withdraw = WithdrawRequest::whereId($id)->firstOrFail();
        $campaign = Campaign::whereId($withdraw->campaign_id)->firstOrFail();
        if ($request->ajax()) {
            $view = view('admin.components.withdraw.detail-request')->with('withdraw', $withdraw)->with('campaign',$campaign)->render();
            return response()->json(['html'=>$view]); 
        } 
        return response()->json(['withdraw'=> $withdraw, 'campaign' =>$campaign],200);

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
}
