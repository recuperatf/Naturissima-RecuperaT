<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function terms_and_conditions(){
    	return view('legal/terms_and_conditions');
    }
    public function privacy_disclaimer(){
    	return view('legal/privacy_disclaimer');
    }
}
