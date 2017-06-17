<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Campaign;

class HomeController extends Controller
{
    

    /**
     * Show the application HOMEPAGE.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $campaigns = Campaign::take(3)->get();
        return view('home')
            ->with('campaigns', $campaigns);
    }
}
