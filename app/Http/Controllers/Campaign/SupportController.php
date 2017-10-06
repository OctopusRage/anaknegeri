<?php

namespace App\Http\Controllers\Campaign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Support;
use App\Models\SupportType;
use App\Models\Wallet;
use Auth;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $campaign = Campaign::whereSlug($slug)->firstOrFail();
        return view('campaign.donate')
            ->with('campaign', $campaign);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $validator = Validator::make($request->all(),[
            'type'    => 'required',
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator)
                ->with('status', 'warning')
                ->with('message', 'Terjadi kesalahan pada input');
        }
        if($request->get('type')=="Finansial"){
            $validator = Validator::make($request->all(),[
                'amount'    => 'required|min:10000',
            ]);

            $item = $request->get('item');
            $amount = $request->get('amount');   
        }else{

            $validator = Validator::make($request->all(),[
                'barang'    => 'required',
                'count'    => 'required|min:1'
            ]);
            $item = $request->get('barang');
            $amount = $request->get('count');
        }
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator)
                ->with('status', 'warning')
                ->with('message', 'Terjadi kesalahan pada input');
        }

        $support = new Support(array(
            'item'      => $item,
            'amount'    => $amount,
            'comment'   => $request->get('comment'),
            'anonim'    => $request->has('anonim'),
            'detail'    => $request->get('detail')
            // 'type_id'   => $type->id
        ));

        $user_id = Auth::user()->id;
        $support->assignUser($user_id);
        $campaign = Campaign::whereSlug($slug)->firstOrFail();
        $support->assignCampaign($campaign->id);
        $type = SupportType::where('type', $request->get('type'))->firstOrFail();
        $support->assignType($type->id);

        $support->save();

        if($request->get('type')=="Finansial"){
            $wallet = Wallet::where('user_id', $user_id)->firstOrFail();
            $wallet->total = $wallet->total - $support->amount;
            $wallet->save(); 
        }        

        return redirect()->back()
            ->withInput()
            ->with('message','Dukungan berhasil diberikan.')
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
