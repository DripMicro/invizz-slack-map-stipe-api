<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlackController extends Controller
{
    //
    public function slack(){
        \Slack::send('Hey');
    }
}
