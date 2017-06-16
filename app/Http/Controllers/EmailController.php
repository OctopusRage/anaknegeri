<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
Use Mail;

class EmailController extends Controller
{	
  public function resend($id)
  {
      $user = User::whereId($id)->firstOrFail();
      
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

  }
}
