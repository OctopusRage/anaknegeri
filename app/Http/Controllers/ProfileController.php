<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Campaign;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id= Auth::user()->id;
        $user = User::whereId($id)->firstOrFail();
        $count=array(
            'campaign' => $user->campaign()->count(),
            'contribute' => $user->support()->count()
            );
        return view('profile')->with('user',$user)->with('count', $count);
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
        $user = User::whereId($id)->firstOrFail();
        $count=array(
            'campaign' => $user->campaign()->count(),
            'contribute' => $user->support()->count()
        );
        return view('profile')->with('userprofile',$user)->with('count', $count);
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
     * Get All Campaign created by User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function campaign(Request $request)
    {   
        $user=Auth::user();
        $campaigns= Campaign::where('created_by', $user->id)->paginate(5);
        $campaigns->sortByDesc('created_at');

        if ($request->ajax()) {
            $view = view('components.profile.campaign-on-profile',compact('campaigns'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('profile.campaign',compact('campaigns'));
    }

    public function campaignsPublic(Request $request, $id)
    {
        $user= User::find($id);
        $campaigns= Campaign::where('created_by', $user->id)->paginate(5);
        $campaigns->sortByDesc('created_at');

        if ($request->ajax()) {
            $view = view('components.profile.campaign-on-profile',compact('campaigns'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('profile.campaign',compact('campaigns'))->with('userprofile', $user);
    }

}
