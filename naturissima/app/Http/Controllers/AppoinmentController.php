<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Appoinment;
use \App\State;
use \App\Product;
use \App\Order;

class AppoinmentController extends Controller
{
	public function __construct(){
		$this->middleware("can_see_apoinments")->only("index");
	}
    public function create(){

    }
    public function create_appointment_for_product($product_id){
        $states=State::all();
        $product=Product::find($product_id);
        return view("appoinments.create")->
            with('states',$states)->
            with("product",$product);
    }
    public function store(Request $request){
        dd($request->all());
    	$A_request=$request->all();
    	$A_request["date"]=$A_request["date"]." ".$A_request["time"];
    	unset($A_request["time"]);
    	unset($A_request["_token"]);
    	$appoinment=new Appoinment($A_request);
    	$appoinment->save();
    	return redirect(action("AppoinmentController@index"));
    }
    public function index(){
    	return view("appoinments.index")->with(["appoinments"=>Order::where("appoinment_date","!=",null)->get()]);
    }
    public function ajax_get_appoinments_from_date($date){
        $orders=Order::whereDate("appoinment_date","=",$date)->get();
        return view("ajax.ajax")->with("appoinments",$orders);
    }
    public function ajax_get_remaining_times_from_date($date=false){
    	$array_hours=[];
    	for($i=0;$i<25;$i++){
    		$array_hours[(($i>=10)?$i:("0".$i)).":00:00"]=(($i>=10)?$i:("0".$i)).":00";
    	}
    	if($date){
    		$A_appoinments_dates=Order::where("appoinment_date","!=",null)->get()->pluck("appoinment_date");
    		foreach ($A_appoinments_dates as $key => $date_time) {
    			$array_hours_key=explode(" ",$date_time)[1];
    			unset($array_hours[$array_hours_key]);
    		}	
    	}
    	return $array_hours;
    }
}
