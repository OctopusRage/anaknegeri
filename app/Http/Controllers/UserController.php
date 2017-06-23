<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Models\User;
use App\Models\ActivationRequest;
Use Mail;
use Carbon\Carbon;
use App\Models\Role;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $roles = Role::all();
        return view('admin.user.index')
            ->with('roles', $roles);
    }

    public function addModal()
    {

        $roles = Role::where('name','!=','user')->where('name','!=','organization')->get();
        return view('admin.components.user.add-modal')->with('roles', $roles);
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
        $user = new User(array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => str_random(64),
        ));

        $user->save();
        for ($i=0; $i < count($request->role) ; $i++) { 
            $user->assignRole($request->role[$i] );
        }
        if($request->activated==1){
            $user->activated();
        }
        if($request->verified == 1)
        {
            $user->verified();
        }

        return response()->json([
            'message' => 'success',
            'data'  => $user
        ]);
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
    public function edit(Request $request, $id)
    {
        $roles = Role::all();
        $user = User::where('id',$id)->firstOrFail();
        
        if ($request->ajax()) {
            $view = view('admin.components.user.edit-modal',compact('user', 'roles'))->render();
            return response()->json(['html'=>$view]);
        }
        
        return view('admin.components.user.edit-modal')->with('roles', $roles);
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
        $user = User::whereId($id)->firstOrFail();
        $user->password=Hash::make($request->password);
    

        for ($i=0; $i < count($request->role) ; $i++) { 
            if($user->hasRoleId($request->role[$i])){
                $user->removeRole($request->role[$i] );
            }
        }
        for ($i=0; $i < count($request->role) ; $i++) { 
            $user->assignRole($request->role[$i] );
        }

        if($request->activated==1){
            $user->activated();
        }
        if($request->verified == 1)
        {
            $user->verified();
        }
        if($request->status == 1)
        {
            $user->enable();
        }
        if($request->status==0)
        {
            $user->disable();
        }

        $user->save();

        return response()->json([
            'message' => 'success',
            'data'  => $user
        ]);
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

    public function getUsers(){
        $users = User::all();
        return Datatables::of($users)
            ->editColumn('status', function($user){
                return $user->getStatus();
            })
            ->addColumn('action', function($user){
                return '
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoUser" data-id="'.$user->id.'">
                    <i class="icon-info"></i>
                </button>
                <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#editUser" data-id="'.$user->id.'">
                    <i class="icon-note"></i>
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

