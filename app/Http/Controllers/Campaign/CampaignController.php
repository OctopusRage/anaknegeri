<?php
namespace App\Http\Controllers\Campaign;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Datatables;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\SupportType;
use App\Models\Campaign;
use App\Models\Category;

class CampaignController extends Controller
{
    public function __construct() {
        $this->middleware('user.verified', ['only' => ['create','store', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $campaigns= Campaign::paginate(8);
        $campaigns->sortByDesc('created_at');

        if ($request->ajax()) {
            $view = view('components.campaign',compact('campaigns'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('campaign',compact('campaigns'));
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
    public function category(Request $request, $slug)
    {

        $category = Category::whereSlug($slug)->firstOrFail();
        $campaigns= Campaign::where('category_id', $category->id)
            ->paginate(8);
        $campaigns->sortByDesc('created_at');

        if ($request->ajax()) {
            $view = view('components.campaign',compact('campaigns'))->render();
            return response()->json(['html'=>$view]);
        }
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

    private function validator(array $data) {
        return Validator::make($data, [
            'title'         => 'required',
            'subtitle'      => '',
            'address'       => 'required',
            'slug'          => 'required|unique:campaigns',
            'feature_img'   => 'required',
            'deadline'      => 'date',
            'detail'        => 'required|min:50'
        ], [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails()) {
            return back()->withErrors($validator)->with('status', 'danger')->with('message', 'Terjadi kesalahan saat input')->withInput();
        }
        $image = Input::file('feature_img');
        $input = $this->processImage($image);
        $slug = strtolower(str_replace(' ', '-', $request->get('slug')));
        $campaign = new Campaign(array(
            'title'         => $request->get('title'),
            'subtitle'      => $request->get('subtitle'),
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
        $withdraw = $campaign->withdraw()->where('sent',1)->get();
        return view('campaign.detail')
            ->with('withdraw', $withdraw)
            ->with('campaign', $campaign)
            ->with('slug', $slug);
    }

    public function comment(Request $request, $slug)
    {
        $campaign = Campaign::whereSlug($slug)->firstOrFail();
        $comments = $campaign->support()->paginate(5);

        if ($request->ajax()) {
            $view = view('components.comment',compact('comments'))->render();
            return response()->json(['html'=>$view]);
        }
        return response()->json($comments, 200);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $campaign = Campaign::whereSlug($slug)->firstOrFail();
        $category = Category::all();
        $financeSupport = $campaign->supportType->where('type', 'Finansial')->first();
        $nonfinanceSupport = $campaign->supportType->where('type', 'Non Finansial')->all();
        return view('campaign.edit')
            ->with('campaign', $campaign)
            ->with('category', $category)
            ->with('financeSupport', $financeSupport)
            ->with('nonfinanceSupport', $nonfinanceSupport)
            ->with('slug', $slug);
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
        $validator =  Validator::make($request->all(), [
            'title'         => 'required',
            'subtitle'      => '',
            'address'       => 'required',
            'slug'          => 'required',
            'deadline'      => 'date',
            'detail'        => 'required|min:10'
        ], []);
        if($validator->fails()) {
            return back()->withErrors($validator)->with('status', 'danger')->with('message', 'Terjadi kesalahan saat input')->withInput();
        }

        $slug = strtolower(str_replace(' ', '-', $request->get('slug')));
        $campaign = Campaign::find($id);
        $campaign->title = $request->get('title');
        $campaign->subtitle = $request->get('subtitle');
        $campaign->address = $request->get('address');
        if ($campaign->slug != $slug) {
            $campaign->slug = $slug;
        }
        if($request->hasFile('feature_img')) {
            $image = $request->file('feature_img');
            $input = $this->processImage($image);
            $campaign->feature_image = $input;
        }
        $campaign->deadline = Carbon::parse($request->get('deadline'));
        $campaign->detail = $request->get('detail');
        $campaign->save();
        $category = $request->get('category_id');
        $campaign->assignCategory($category);
        $finansialType= SupportType::whereType('Finansial')->first();
        $nonFinansialType= SupportType::whereType('Non Finansial')->first();
        $checkifFinansial = $request->has('check_finansial') ? true : false;
        $checkifNonFinansial = $request->has('check_nonfinansial') ? true : false;
        $campaign->supportType()->detach();
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
            ->with('message','Campaign berhasil diedit.')
            ->with('status', 'success');
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
            ->join('categories', 'campaigns.category_id','=','categories.id')
            ->select('campaigns.*', 'categories.category as categoryname')
            ->get();
        return Datatables::of($campaigns)
            ->addColumn('action', function($campaign){
                return '                
                <a class="btn btn-sm btn-secondary info" href="/campaign/detail/'.$campaign->slug.'" target="_blank">
                    <i class="icon-eye"></i>
                </a>
                <button class="btn btn-sm btn-info info" data-toggle="modal" data-target="#infoCampaign" data-id="'.$campaign->id.'">
                    <i class="icon-info"></i>
                </button>
                <a class="btn btn-sm btn-danger destroy" href="{{ route("home")}}">
                    <i class="icon-trash"></i>
                </a>
                ';
            })->make(true);
    }

    public function showCampaign(Request $request, $id){
        $campaign = Campaign::where('id',$id)->firstOrFail();

        if ($request->ajax()) {
            $view = view('admin.components.campaign.detail',compact('campaign'))->render();
            return response()->json(['html'=>$view]);
        } 
    }
}
