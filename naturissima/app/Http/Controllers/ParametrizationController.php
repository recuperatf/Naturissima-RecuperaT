<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametrizationController extends Controller
{
    public function index(){
    	return view("parametrization.index")->with("C_parametrization",\App\Parametrization::all());
    }
}
