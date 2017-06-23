<?php

namespace App\Http\Controllers\Campaign;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Report;
use App\Models\WithdrawRequest;
use Datatables;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $withdraws = WithdrawRequest::where('campaign_id', $id)
            ->where('status', 1)
            ->where('sent', 0)
            ->get();
        $campaign = Campaign::whereId($id)->firstOrFail();
        return view('profile.campaign.report')
            ->with('campaign', $campaign)
            ->with('withdraws', $withdraws);
    }

    public function getReports($id){
        $reports = DB::table('reports')
            ->join('withdraw_requests', 'reports.withdraw_request_id','=','withdraw_requests.id')
            ->join('campaigns', 'campaigns.id','=','withdraw_requests.campaign_id')
            ->where('campaigns.id',$id)
            ->select('reports.title as titlereport', 'reports.created_at as created_at', 'campaigns.slug as slug','reports.id as id')
            ->get();

        return Datatables::of($reports)
            ->addColumn('action', function($report){
                return '                
                <a class="btn btn-sm btn-secondary info" target="_blank" href="/campaign/detail/'.$report->slug.'/report/'.$report->id.'">
                    <i class="icon-eye"></i>
                </a>
                ';
            })->make(true);
    }

    public function adminindex()
    {
        return view('admin.report.index');
    }

    public function getAllReports(){
        $reports = DB::table('reports')
            ->join('withdraw_requests', 'reports.withdraw_request_id','=','withdraw_requests.id')
            ->join('campaigns', 'campaigns.id','=','withdraw_requests.campaign_id')
            ->select('reports.*', 'campaigns.title as camp_title', 'campaigns.slug as slug')
            ->get();

        return Datatables::of($reports)
            ->addColumn('action', function($report){
                return '               
                <a class="btn btn-sm btn-secondary info" target="_blank" href="/campaign/detail/'.$report->slug.'/report/'.$report->id.'">
                    <i class="icon-eye"></i>
                </a>

                <button class="btn btn-sm btn-info info" data-toggle="modal" data-target="#infoReport" data-id="'.$report->id.'">
                    <i class="icon-info"></i>
                </button> 
                ';
            })->make(true);
    }

    public function showReport(Request $request, $id){
        $report = Report::where('id',$id)->firstOrFail();

        if ($request->ajax()) {
            $view = view('admin.components.report.detail',compact('report'))->render();
            return response()->json(['html'=>$view]);
        } 

        return response()->json(['data', $report]);
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
        $withdraw = WithdrawRequest::whereId($request->withdraw_id)->firstOrFail();
        $report = new Report(array(
            'title' => $request->get('title'),
            'detail' => $request->get('detail')
        ));

        $report->assignWithdraw($request->get('withdraw_id'));
        $report->save();
        $withdraw->sent();
        // $withdraw->where('id', $report->withdraw_request_id)->sent();

        return redirect()
            ->back()
            ->with('message', 'Laporan berhasil dibuat')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $report_id)
    {
        $campaign= Campaign::whereSlug($slug)->firstOrFail();
        $report = Report::whereId($report_id)->firstOrFail();
        return view('campaign.report')
            ->with('campaign',$campaign)
            ->with('report',$report);
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
