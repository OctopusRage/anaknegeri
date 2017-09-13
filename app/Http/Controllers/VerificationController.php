<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Models\User;
use App\Models\ActivationRequest;
use App\Models\VerificationRequest;
Use Mail;
use Carbon\Carbon;
use App\Models\Role;
use Hash;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $verifications = VerificationRequest::all();
        return view('admin.user.verification_requests')
            ->with('verifications', $verifications);
    }

    public function confirm($id)
    {
        $verification = VerificationRequest::find($id);
        $verification->confirmed = 1;
        $verification->save();
        $role = $verification->status == true ? 'organization':'user';
        $role = \App\Models\Role::whereName($role)->first();
        $user = $verification->user;
        $user->verified = true;
        $user->removeRole($role);
        $user->assignRole($role);
        $user->save();
        return response()->json([
            'message' => 'success',
            'data'  => $verification,
        ]);
    }

    public function getVerifications(){
        $verifications = VerificationRequest::where('confirmed', false);
        return Datatables::of($verifications)
            ->addColumn('name', function($verification){
                return $verification->user->name;
            })
            ->editColumn('status', function($verification){
                return $verification->getStatus();
            })
            ->editColumn('confirmed', function($verification){
                return $verification->getConfirmation();
            })
            ->addColumn('attached', function($verification){
                return '<a href="'.$verification->id_img.'" class="btn btn-sm btn-info">Test</a>';
            })
            ->addColumn('action', function($verification){
                return '
                <a target="_blank" href="'.$verification->id_img.'" class="btn btn-sm btn-success"><i class="icon-arrow-down-circle"></i></a> 
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#confirmUser" data-id="'.$verification->id.'">
                    <i class="icon-check"></i>
                </button>
                <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#editUser" data-id="'.$verification->id.'">
                    <i class="icon-close"></i>
                </button>
                ';
            })->make(true);
    }

}

