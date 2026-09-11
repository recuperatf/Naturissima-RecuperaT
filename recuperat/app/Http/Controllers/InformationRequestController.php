<?php

namespace App\Http\Controllers;

use App\InformationRequest;
use Illuminate\Http\Request;
use App\Mail\InformationMail;
use Mail;
use Illuminate\Support\Facades\Validator;
class InformationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $A_validator_store = [
        'name' => 'required',
        'email' => 'required',
        'request' => 'required',
    ];
    var $A_validator_messages = [
        'name.required' => 'Su nombre es requerido',
        'email.required' => 'Su correo es requerido',
        'request.required' => 'Su pregunta es requerida',

    ];
    public function index()
    {
        return view('information.index')->with('informations', InformationRequest::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), $this->A_validator_store, $this->A_validator_messages)->validate();
        $A_request = $request->all();
        unset($A_request['_token']);
        unset($A_request['token']);
        unset($A_request['method']);
        unset($A_request['_method']);
        unset($A_request['files']);

        $info_request = new InformationRequest();
        $info_request->fill($A_request);
        $info_request->save();
        return redirect(action('InformationRequestController@create'))->with(['success'=>'Tu mensaje se ha enviado con éxito']);
    }

    public function answer ($information_request_id){
        return view('information.answer.create')
        ->with('information_request', InformationRequest::find($information_request_id));
    }

    public function send_answer(Request $request){
        $information_request = InformationRequest::find($request->information_request_id);
        $to = $information_request->email;
        try {
            Mail::to($to)->send(new InformationMail([
                'information_request' => $information_request, 
                'content' => $request->content
            ]));
        } catch (Exception $e) {        
            return redirect(route('answer.create', $information_request->id))->with('error','Lo sentimos, algo salió mal.');
        }
        $information_request->answered = true;
        $information_request->save();
        return redirect(route('answer.create', $information_request->id))->with('success','El mensaje fue enviado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InformationRequest  $informationRequest
     * @return \Illuminate\Http\Response
     */
    public function show(InformationRequest $informationRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InformationRequest  $informationRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(InformationRequest $informationRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InformationRequest  $informationRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformationRequest $informationRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InformationRequest  $informationRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformationRequest $informationRequest)
    {
        //
    }
}
