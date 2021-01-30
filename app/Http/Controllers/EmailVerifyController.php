<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Mail\contactEmail;

class EmailVerifyController extends Controller
{
    //

    public function ToVerify(){
        $currentUser = \Auth::user();
        $email = $currentUser->email;
        return view('emails.emailVerify', compact('email'));
    }

    public function LeaveFeedback(Request $request){

        $email = $request->email_contact;
        $name = $request->name_contact;
        $subject = $request->subject_contact;
        $message = $request->message_contact;

        $input = ['message' => $message, 'email'=>$email, 'name'=>$name, 'subject'=>$subject];

        Mail::to('info@invizz.io')->send(new contactEmail($input));
        // return view('emails.emailVerify', compact('email'));
        return view('homepage');
    }
}
