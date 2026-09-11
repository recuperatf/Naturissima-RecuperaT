<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Municipality;
class CheckoutController extends Controller
{
	public function ajax_get_municipalities_by_state_id($state_id){
		$municipalities=State::where("id",$state_id)->first()->municipalities;
		return ($municipalities);
	}
	public function ajax_get_estate_id_by_name($name){
		$state_id=State::where("name",$name)->first()->id;
		return ($state_id);
	}
	public function ajax_get_municipality_id_by_name($name){
		$municipality_id=Municipality::where("name",$name)->first()->id;
		return ($municipality_id);
	}
}
