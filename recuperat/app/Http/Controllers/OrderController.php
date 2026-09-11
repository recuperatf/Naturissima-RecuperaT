<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Order;

class OrderController extends Controller
{
 	public function index(){
 		return view("orders.index")->with("orders",Order::where("appoinment_date","=",null)->get()->reverse());
 	} 
}