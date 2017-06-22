<?php

namespace App\Http\Controllers\Withdraw;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\User;
use App\Models\WithdrawRequest;
use App\Models\Campaign;
use Mail;

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
        $withdraw = WithdrawRequest::where('id', $request->id)->firstOrFail(); 
        $campaign = $withdraw->campaign()->firstOrFail();
        $user = User::whereId($campaign->created_by)->firstOrFail();

        
        if($request->type == 'accept')
        {   
            $withdraw->accepted();
            $status = "Diterima";           

        }else if($request->type == "reject")
        {
            $withdraw->rejected();  
            $status = "Ditolak"; 
        }

        $withdraw->addition = $request->addition;
        $withdraw->save();
        
        $data['email'] = $user->email;
        $data['name'] = $user->name;
        $data['item'] = $withdraw->item;
        $data['amount'] = $withdraw->amount;
        $data['detail'] = $withdraw->detail;
        $data['addition'] = $withdraw->addition;
        $data['status'] = $status;

        Mail::send('emails.withdraw', $data, function($message) use ($data)
        {
            $message->from('weniindya@gmail.com', "Anaknegeri");
            $message->subject("Konfirmasi Permintaan Penarikan Dukungan");
            $message->to($data['email'], $data['name']);   
        }); 

        return response()->json([
            'message' => $status
        ]);
    }

    public function history()
    {
        return view('admin.withdraw.nonfinance.history');
    }

    public function getHistory()
    {
        $withdraws = WithdrawRequest::where('confirmed', true)->where('item','!=','Dana')->get();
        return Datatables::of($withdraws) 
            ->addColumn('campaign_title', function($withdraw){
                return $withdraw->campaign->title;
            })       
            ->editColumn('created_at', function($withdraw){
                return   date('d M Y H:i:s', strtotime($withdraw->created_at));
            })    
            ->editColumn('updated_at', function($withdraw){
                return   date('d M Y H:i:s', strtotime($withdraw->updated_at));
            })
            ->editColumn('amount', function($withdraw){
                return  $withdraw->amount;
            })
            ->editColumn('status', function($withdraw){
                return   $withdraw->getStatus();
            })
            ->addColumn('action', function($withdraw){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoWithdraw" data-id="'.$withdraw->id.'">
                    <i class="icon-info"></i>
                </button>            
                ';
            })
            ->make(true);
    }

    public function showHistory(Request $request, $id)
    {
        $withdraw = WithdrawRequest::whereId($id)->firstOrFail();
        $campaign = Campaign::whereId($withdraw->campaign_id)->firstOrFail();
        if ($request->ajax()) {
            $view = view('admin.components.withdraw.detail-history')->with('withdraw', $withdraw)->render();
            return response()->json(['html'=>$view]); 
        } 
        return response()->json(['withdraw'=> $withdraw, 'campaign' =>$campaign],200);

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
