<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Mail;
 
use App\Mail\NotifyMail;

class SendEmailController extends Controller
{
    public function index($details)
    {
 		// $details = [
	  //       'title' => 'Mail from Vanderhowen Job Alert',
	  //       'body' => 'This is for testing email using smtp'
	  //   ];
	   
	    // \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));
	   
	    // dd("Email is Sent.");


      Mail::to('receiver-email-id')->send(new NotifyMail($details));
 
      if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         }
    }
}
