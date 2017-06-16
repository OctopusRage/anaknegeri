<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\CampaignFormRequest;
use App\Models\SupportType;
use App\Models\Campaign;
use App\Models\Category;

class CampaignController extends Controller
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns= Campaign::all()
            ->sortByDesc('created_by');
        return view('campaign')
            ->with('campaigns', $campaigns);
    }
    
    /**
     * Display a listing of the Campaign sorted by popularity.
     *
     * @return \Illuminate\Http\Response
     */
    public function popular()
    {
        $campaigns= Campaign::all();
        return view('campaign')
            ->with('campaigns', $campaigns);
    }
    
    /**
     * Display a listing of the campaign based on Slug (Category).
     *
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {

        $category = Category::whereSlug($slug)->firstOrFail();
        $campaigns= Campaign::where('category_id', $category->id)->get();
        return view('campaign')
            ->with('category', $category)
            ->with('campaigns', $campaigns);
    }

    /**
     * Display a listing of the resource for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminindex()
    {
        return view('admin.campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('campaign.create')->with('category', $category);
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignFormRequest $request)
    {
        $campaign = new Campaign(array(
            'title'     => $request->get('title'),
            'subtitle'  => $request->get('subtitle'),
            'deadline'  => $request->get('deadline'),
            'address'   => $request->get('address'),
            'slug'      => $request->get('slug'),
            'deadline'  => Carbon::parse($request->get('deadline')),
            'detail'    => $request->get('detail')
        ));
        //Assign User
        $campaign->assignUser(Auth::user()->id);

        //Assign Category
        $category = $request->get('category_id');
        $campaign->assignCategory($category);

        $campaign->save();

        //Assign Support Need -> Finansial Type
        $finansialType= SupportType::whereType('Finansial')->first();
        $nonFinansialType= SupportType::whereType('Non Finansial')->first();

        $checkifFinansial = $request->has('check_finansial') ? true : false;
        $checkifNonFinansial = $request->has('check_nonfinansial') ? true : false;
        
        if($checkifFinansial){
            $donasiDana= $request->get('donasi_finansial');
            $campaign->assignSupportNeed($finansialType, 'Dana', $donasiDana);
        }
        if($checkifNonFinansial){
            $item = $request->input('item');
            $amount = $request->input('amount');
            for ($i=0; $i < count($item) ; $i++) { 
                $campaign->assignSupportNeed($nonFinansialType, $item[$i], $amount[$i]);
            }
        }

                
        return redirect()->back()
            ->with('message','Campaign berhasil dibuat')
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

    /**
     * Remove All Campaign
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCampaigns(){
        $campaigns = DB::table('campaigns')
            ->join('category', 'campaigns.category_id','=','category.id')
            ->select('campaigns.*', 'category.category as categoryname')
            ->get();
        return Datatables::of($campaigns)
            ->addColumn('action', function($campaign){
                return '
                <button class="btn btn-sm btn-info info" data-toggle="modal" data-target="#infoCampaign" data-id="'.$campaign->id.'">
                    <i class="icon-user-follow"></i>
                </button>
                <a class="btn btn-sm btn-warning edit" href="{{ route("home")}}">
                    <i class="icon-note"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" href="{{ route("home")}}">
                    <i class="icon-trash"></i>
                </a>
                ';
            })->make(true);
    }

}
