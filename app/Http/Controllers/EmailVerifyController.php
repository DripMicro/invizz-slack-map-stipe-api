<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Mail\sendGrid;

class EmailVerifyController extends Controller
{
    //

    public function ToVerify(){
        $currentUser = \Auth::user();
        $email = $currentUser->email;
        return view('emails.emailVerify', compact('email'));
    }

    public function EmailVerify(Request $request){
        $email = $request->email_contact;
        $verify_link = "http://54.237.136.251/register";

        $input = ['message' => $verify_link, 'subject' => 'Email Verification'];

        Mail::to($email)->send(new sendGrid($input));
        // return view('emails.emailVerify', compact('email'));
        return view('homepage');
    }
}
