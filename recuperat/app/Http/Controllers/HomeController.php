<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Offer;
use App\Parametrization;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $clientView = $request->input('client_view', false);
        if ($clientView && !Auth::user()) {
            $request->session()->put('client_view', $clientView);
            return view('client.login');
        }
        else {
            return view('layouts.medilab_parts.content')
            ->with('client_view',1)
            ->with('offers',Offer::all())
            ->with('home_content',Parametrization::where('parameter', 'home_content')->first());
        }
    }

    public function index2()
    {
        return view('home')
        ->with('offers',Offer::all())
        ->with('home_content',Parametrization::where('parameter', 'home_content')->first());
    }

    public function edit(){
        return view('home/edit')
        ->with('home_content',Parametrization::where('parameter', 'home_content')->first());
    }

    public function update(Request $request){
        $content = $request->get('home_content');
        if($content){
            $parameter = Parametrization::where('parameter', 'home_content')->first();
            if(!$parameter)
                $parameter = new Parametrization();
            $parameter->fill(['parameter'=>'home_content', 'value' => $content]);
            $parameter->save();
        }
        return redirect(action('HomeController@index'));
    }
}
