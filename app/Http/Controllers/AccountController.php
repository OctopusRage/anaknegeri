<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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
        $this->validate($request, [
            'name' => 'required'
        ]);
        $account = User::whereId($id)->firstOrFail();
        $account->name = $request->get('name');
        $account->date = $request->get('birthdate');
        $account->bio = $request->get('bio');
        $account->address = $request->get('address');
        $account->save();
        return redirect()->back()
            ->with('status', 'success')
            ->with('user', Auth::user())
            ->with('message', 'Data telah terupdate');
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
}
