<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Models\User;
use App\Models\ActivationRequest;
Use Mail;
use Carbon\Carbon;
use Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
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

    /**
     * Send Activation Email to user
     * Maximum send activation request per day => 3x
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activateUser($id){

      $user = User::whereId($id)->firstOrFail();
      $countRequests = ActivationRequest::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();

      if($countRequests <= 3){

        $activation = new ActivationRequest([]);
        $activation->assignActivationRequests($id);
        $activation->save();
        
        $data= array(
          'token' => $user->token,
          'name' => $user->name,
          'email' => $user->email
        );

        Mail::send('emails.activate', $data, function($message) use ($data)
        {
            $message->from('weniindya@gmail.com', "Anaknegeri");
            $message->subject("Aktivasi akun anda");
            $message->to( $data['email'], $data['name']);   
        });

        return redirect()->back()
          ->with('message','Email aktivasi berhasil dikirim');

      }else{

        return redirect()->back()
          ->with('message','Batas maksimum permintaan aktivasi hari ini telah terlampaui');
      }

      
    }
    public function status($value)
    {   
        if($value==1)
        {
            return "Active";
        }else{
            return "Unactive";
        }

    }
    public function getUsers(){
        $users = DB::table('users')
            ->select(DB::raw("users.id as id,  users.email as email, users.name as name, (CASE WHEN status = 1 THEN 'Active' ELSE 'Unactive' END) as status"))
            ->get();
        return Datatables::of($users)
            ->addColumn('action', function($user){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoUser" data-id="'.$user->id.'">
                    <i class="icon-info"></i>
                </button>
                <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#editUser" data-id="'.$user->id.'">
                    <i class="icon-note"></i>
                </button>
                <button class="btn btn-sm btn-danger destroy" data-toggle="modal" data-target="#deleteUser" data-id="'.$user->id.'">
                    <i class="icon-trash"></i>
                </button>
                ';
            })->make(true);
    }
    public function showUser(Request $request, $id){
        $user = User::where('id',$id)->firstOrFail();
        
        if ($request->ajax()) {
            $view = view('admin.components.user.detail',compact('user'))->render();
            return response()->json(['html'=>$view]);
        }

    }
}

