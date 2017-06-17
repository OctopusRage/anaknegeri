<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Image;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns= Campaign::paginate(15);
        $campaigns->sortByDesc('created_at');
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
        $campaigns= Campaign::paginate(15);
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
        $campaigns= Campaign::where('category_id', $category->id)
            ->paginate(15);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $image = Input::file('feature_img');
        $input = $this->processImage($image);
        $slug = strtolower(str_replace(' ', '-', $request->get('slug')));
        $campaign = new Campaign(array(
            'title'         => $request->get('title'),
            'subtitle'      => $request->get('subtitle'),
            'deadline'      => $request->get('deadline'),
            'address'       => $request->get('address'),
            'slug'          => $slug,
            'feature_img'   => $input,
            'deadline'      => Carbon::parse($request->get('deadline')),
            'detail'        => $request->get('detail')
        ));
        $campaign->assignUser($request->get('user_id'));
        $category = $request->get('category_id');
        $campaign->assignCategory($category);
        $campaign->save();
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
            ->withInput()
            ->with('message','Campaign berhasil dibuat.')
            ->with('status', 'success');
    }



    /**
     * Processing Image for Campaign
     *
     * @param  Image
     * @return \Illuminate\Http\Response
     */
    public function processImage($image){
        $originalImage = $image;
        $randomString = str_random(64);
        $input =  $randomString . '.' . $image->getClientOriginalExtension();
   
        $destinationPath = public_path('img/campaigns/thumbs/'. $input);
        $oriDestinationPath = public_path('img/campaigns/'. $input);

        $img = Image::make($image
            ->getRealPath())
            ->resize(null, 350, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->crop(350, 350)
            ->save($destinationPath);

        $oriImage = Image::make($originalImage->getRealPath())->save($oriDestinationPath);

        return $input;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $campaign = Campaign::whereSlug($slug)->firstOrFail();
        return view('campaign.detail')
            ->with('campaign', $campaign);
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

    /**
     * Donate to Campaign
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function donate($slug)
    {
        $campaign = Campaign::whereSlug($slug)->firstOrFail();
        return view('campaign.donate')
            ->with('campaign', $campaign);
    }

}
