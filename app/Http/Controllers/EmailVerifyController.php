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
        $email = $_GET['email'];
        return view('emails.emailVerify', compact('email'));
    }

    public function EmailVerify(Request $request){
        $email = $request->verify_email;
        $verify_link = "http://54.237.136.251/register";

        $input = ['message' => 'Nice to meet you', 'subject' => 'Email Verification', 'url' => $verify_link];

        Mail::to($email)->send(new sendGrid($input));
        // return view('emails.emailVerify', compact('email'));
        return view('emails.emailVerify')->with(['email'=>$email]);
    }
}
