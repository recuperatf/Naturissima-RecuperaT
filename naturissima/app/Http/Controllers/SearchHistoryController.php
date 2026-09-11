<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SearchHistory;
class SearchHistoryController extends Controller
{
	public function __construct()
	{
	    $this->middleware('is_admin')->except('index');
	}
    public function index(Request $request){
    	$collection=SearchHistory::all()->groupBy('term');
    	if(($A_request=$request->all())){
    		foreach($A_request as $key=>$value){
    				$function=($value=="asc")?"sortByDesc":"sortBy";
    				if($key=="term"){
    					$collection=$collection->$function(function($history, $key){
    						return $history[0]->term;
    					});	
    				}else{
    					$collection=$collection->$function(function($history, $key){
    						return $history->count();
    					});	
    				}
    				
    			break;
    		}
    		
    	}
    	return view('search_history.index')->with('C_search_history',$collection)->with('request',$request);
    }
}
