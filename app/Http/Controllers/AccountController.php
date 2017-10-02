<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Validator;
use File;
use Image;
use Carbon\Carbon;
use Hash;
use Cloudder;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::whereId($id)->firstOrFail();
        return view('profile.account')
            ->with('user', $user);
    }
    public function updateAccount(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('status', 'danger')->with('message','Terjadi beberapa kesalahan input!');
        }
        $account = User::whereId($id)->firstOrFail();
        $image = $request->file_profile;
        if (isset($image)) {
            $imageExt = strtolower($image->getClientOriginalExtension());
            if( !($imageExt == "png" || $imageExt == "jpg" || $imageExt == "jpeg")  ){
                $validator->errors()->add('file_profile', 'File must be an image!');
                return back()->withErrors($validator)->withInput()->with('status', 'danger')->with('message','Terjadi beberapa kesalahan input!');
            }
            $profile_img = $this->processImage($image, 'profile');
            $delete_img = File::delete(public_path('img/avatars/'.$account->profile_img));
            $account->profile_img = $profile_img;
        }
        $account->name = $request->get('name');
        $account->date = $request->get('birthdate');
        $account->bio = $request->get('bio');
        $account->address = $request->get('address');
        $account->save();
        return redirect()->back()
            ->with('status', 'success')
            ->with('user', Auth::user())
            ->with('message', 'Data telah diperbaharui');
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);
        $account = User::where(['email'=>Auth::user()->email])->firstOrFail();
        if (Hash::check($request->input('old_password'), $account->makeVisible('password')->toArray()['password'])) {
            $validator->errors()->add('old_password', 'Old password does not match');
            return back()->withErrors($validator)->withInput()->with('status', 'danger')->with('message','Terjadi beberapa kesalahan input!');
        }
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()
                ->with('status', 'danger')->with('message','Terjadi beberapa kesalahan input!');
        }
        $account->password = Hash::make($request->get('password'));
        $account->save();
        return redirect()->back()
            ->with('status', 'success')
            ->with('user', Auth::user())
            ->with('message', 'Password berhasil diganti');
    }
    public function createVerificationRequest(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name2' => 'required',
            'address2' => 'required',
            'website' => 'nullable|url',
            'fb_id' => 'nullable|url',
            'twitter_id' => 'nullable|url',
            'instagram_id' => 'nullable|url',
            'additional_info' => 'required|min:20',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)
                ->withInput()
                ->with('status', 'danger')
                ->with('message','Terjadi beberapa kesalahan input!');
        }
        
        $account = User::whereId($id)->firstOrFail();
        $verificationRequest = new \App\Models\VerificationRequest;
        $image = $request->id_img;
        if (isset($image)) {
            $imageExt = strtolower($image->getClientOriginalExtension());
            $uploadCloud  = Cloudder::upload($image->getRealPath(), null, [], []);
            $imageUrl = $uploadCloud->getResult()['url'];
            $verificationRequest->id_img = $imageUrl;
        }
        if($request->input('isOrganization') != null) {
            $verificationRequest->status = true;
        } else {
            $verificationRequest->status = false;
        }
        $verificationRequest->name = $request->input('name2');
        $verificationRequest->address = $request->input('address2');
        $verificationRequest->website = $request->input('website');
        $verificationRequest->twitter_id = $request->input('twitter_id');
        $verificationRequest->fb_id = $request->input('fb_id');
        $verificationRequest->instagram_id = $request->input('instagram_id');
        $verificationRequest->phone_number = $request->input('phone_number');
        $verificationRequest->additional_info = $request->input('additional_info');
        $verificationRequest->assignVerificationRequests(Auth::user()->id);
        $verificationRequest->save();

        return redirect()->route('profile.account')
            ->with('status', 'success')
            ->with('user', Auth::user())
            ->with('message', 'Verifikasi telah terkirim');
    }

    public function messages(){
        return [
            'v_name.required' => 'Name is required'
        ];
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function processImage($image, $type){
        $originalImage = $image;
        $randomString = str_random(64);
        $input =  $randomString . '.' . $image->getClientOriginalExtension();
   
        //$destinationPath = public_path('img/campaigns/thumbs/'. $input);
        //$oriDestinationPath = public_path('img/avatars/'. $input);
        if($type=='profile') {
            $oriDestinationPath = public_path('img/avatars/'. $input);
        }else {
            $oriDestinationPath = public_path('img/uploads/verifications/'. $input);
        }
        $img = Image::make($image
            ->getRealPath())
            ->resize(null, 350, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->crop(350, 350)
            ->save($oriDestinationPath);
        //$oriImage = Image::make($originalImage->getRealPath())->save($oriDestinationPath);

        return $input;
    }
}
