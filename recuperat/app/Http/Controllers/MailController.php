<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DecisionMail;
use App\Mail\OrderCreated;

class MailController extends Controller
{
    public function store(Request $request){
    	$name = $request->get('name');
    	$to = $request->get('to');

    	Mail::to($to)->send(new OrderCreated($order));

    }

    public function sendDecision(Request $request, Decision $decision){
    	$name = $request->get('name');
    	$to = $request->get('to');

    	Mail::to($to)->send(new DecisionMail($decision));
    }
}
