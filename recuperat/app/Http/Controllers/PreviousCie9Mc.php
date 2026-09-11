<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cie9Mc;

class Cie9McController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $C_model=false;
        if(!empty($request->user_id)){
            $C_model = Cie9Mc::where('user_id','!=', null);
        }
        if(!empty($request->search_terms)){
            $C_model = Cie9Mc::where('name','like','%'.$request->search_terms.'%')->orWhere('key','like','%'.$request->search_terms.'%');
        }
        if($C_model!==false){
            return view('cie9mc.index')->with('C_model',$C_model->paginate(20))->
            with('keys_to_show',[
                            'key'=>'Clave',
                            'name'=>'Nombre',
                            'sex'=>'Sexo',
                            'user_id.filter'=>'Usuario',
                            'type'=>'Tipo'
                        ])->
            with('route_search','cie9_mc.index')->
            with('route_create','cie9_mc.create')->
            with('route_update','cie9_mc.ajaxUpdate')->
            with('route_delete','cie9_mc.ajaxDelete');
        }else{
            return view('cie9mc.index')->with('C_model',Cie9Mc::paginate(20))->
                with('keys_to_show',[
                            'key'=>'Clave',
                            'name'=>'Nombre',
                            'sex'=>'Sexo',
                            'user_id.filter'=>'Usuario',
                            'type'=>'Tipo'
                        ])->
                with('route_search','cie9_mc.index')->
                with('route_create','cie9_mc.create')->
                with('route_update','cie9_mc.ajaxUpdate')->
                with('route_delete','cie9_mc.ajaxDelete');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cie9mc.add')->
        with('form_method','post')->
        with('form_url',route('cie9_mc.store'))->
        with('keys',[
            ['key'=>'name', 'label'=>'Nombre', 'type'=>'text'],
            ['key'=>'key', 'label'=>'Clave', 'type'=>'text'],
            ['key'=>'type', 'label'=>'Tipo', 'type'=>'select','options'=>['TERAPEUTICO'=>'TERAPEUTICO','DIAGNOSTICO'=>'DIAGNOSTICO', '0'=>'AMBOS']],
            ['key'=>'sex', 'label'=>'Sexo', 'type'=>'select', 'options'=>['0'=>'Femenino','1'=>'Masculino']],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $A_request=$request->all();
        unset($A_request['_token']);
        $Cie9Mc = new Cie9Mc($A_request);
        $Cie9Mc->save();
        return redirect(route('cie9_mc.index'))->with('success','Se ha guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxUpdate(Request $request,$id=false){
        $Cie9Mc=Cie9Mc::where('id',$request->id)->first();
        $Cie9Mc->name=$request->name;
        $Cie9Mc->key=$request->key;
        $Cie9Mc->type=$request->type;
        $Cie9Mc->sex=$request->sex;
        $res=$Cie9Mc->save();
        return json_encode($res);
    }

    public function ajaxDelete(Request $request){
        $Cie9Mc=Cie9Mc::where('id',$request->id)->first();
        $res=$Cie9Mc->delete();
        return json_encode($res);
    }

    public function ajax_get_cie9_mc($string=null){
        $col=Cie9Mc::where("name","like","%")->limit(20)->orderBy('name','asc')->get();
        if($string){
            $col=Cie9Mc::where("name","like","%".$string."%")->orWhere('key','like','%'.$string.'%')->limit(20)->orderBy('name','asc')->get();
        }
        return $col->map(function ($cie9mc) {
            return [
                'id' => $cie9mc->id,
                'label' => '('.$cie9mc->key.') '.$cie9mc->name
            ];
        });
        return $col->pluck('name','id')->toArray();
    }
}
