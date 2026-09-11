@php
	$count=0;
    $evaluaciones = [
        ['type'=>'s','titulo'=>'Raquis cervical', 'name'=>'columna_cervical', 'valoraciones'=>[
                    'Flexión 0° a 45°',
                    'Extensión 0° a 45°',
                    'Inclinación Izquierda 0° a 45°',
                    'Inclinación Derecha 0° a 45°',
                    'Rotación Izquierda 0° a 60°',
                    'Rotación Derecha 0° a 60°',
                ],
            // 'explanation' => 'valoraciones/goniometria/columna_cervical.png'
        ],
        ['type'=>'s', 'titulo'=>'Raquis Dorsolumbar', 'name'=>'columna_lumbar','valoraciones'=>[
                    'Flexión 0° a 80',
                    'Extensión 0° a 30°',
                    'Inclinación Izquierda 0° a 35°',
                    'Inclinación Derecha 0° a 35°',
                    'Rotación Izquierda 0° a 45°',
                    'Rotación Derecha 0° a 45°',
                    // 'explanation' => 'valoraciones/goniometria/columna_lumbar.png'
                ],
            // 'explanation' => 'valoraciones/goniometria/columna_lumbar.png'
        ],
        ['type'=>'lr', 'titulo'=>'Hombro', 'name'=>'hombro', 'valoraciones'=>[
                    'Flexión 0° a 180°',
                    'Extensión 0° a 60°',
                    'Abducción 0° a 180°',
                    'Aducción 0° a 30°',
                    'Rotación Interna 0° a 90°',
                    'Rotación Externa 0° a 70°',
                ],
            // 'explanation' => 'valoraciones/goniometria/hombro.png'
            ],

        ['type'=>'lr', 'titulo'=>'Codo', 'name'=>'codo', 'valoraciones'=>[
                    'Flexión 0° a 150°',
                    'Extensión 0°',
                    'Pronación 0° a 80°',
                    'Supinación 0° a 80°',
                ],
            'explanation' => 'valoraciones/goniometria/codo.png'
        ],
        ['type'=>'lr', 'titulo'=>'Pulgar', 'name'=>'thumb', 'valoraciones'=>[
                    'Flexión (Carpo Metacarpiana) 0° a 80°',
                    'Extensión (Carpo Metacarpiana) 0° a 70°',
                    'Abducción 0° a 70°',
                    'Aducción 0°',
                    'Flexión (interfalángica) 0-80°',
                    'Extensión (interfalángica) 0° a 20°'
                ],
        ],
        // ['type'=>'lr', 'titulo'=>'Muñeca', 'name'=>'muneca', 'valoraciones'=>[
        //             'Flexión 80',
        //             'Extensión 70°',
        //             'Desviación cubital 40°',
        //             'Desviación Radial 30°',
        //         ],
        //     'explanation' => 'valoraciones/goniometria/muneca.png'
        //     ],
        ['type'=>'4lr', 'titulo'=>'1° Dedo', 'name'=>'dedos', 'valoraciones'=>[
                    'Flexión carpo metacarpiana 90°',
                    'Extensión carpo metacarpiana 0° a 45°',
                    'Flexión (interfalángica) 0° a 100°',
                    'Extensión (interfalágina) a 0° a 100°',
                    'Flexión (interfalágina distal) 0° a 90°',
                    'Extensión (interfalágina distal) 0°',
                ],
            'explanation' => 'valoraciones/goniometria/mano.png'
            ],
        ['type'=>'lr', 'titulo'=>'Cadera', 'name'=>'cadera', 'valoraciones'=>[
                    'Abducción 0° a 45°',
                    'Adducción 0°a 30°',
                    'Flexión 0° a 120°',
                    'Extensión 0° a 30°',
                    'Rotación Interna 0°a 45°',
                    'Rotación Externa 0° a 45°'
                ],
            'explanation' => 'valoraciones/goniometria/cadera.png'
        ],
        ['type'=>'lr', 'titulo'=>'Rodilla', 'name'=>'rodilla', 'valoraciones'=>[
                    'Flexión 0° a 135°',
                    'Extensión 0° a 10°'
                ],
            'explanation' => 'valoraciones/goniometria/rodilla.png'
            ],
        ['type'=>'lr', 'titulo'=>'Tobillo', 'name'=>'tobillo', 'valoraciones'=>[
                    'Flexión P. 0º a 50º',
                    'Extensión D. 0º a 20º',
                    'Inversión 0º a 35º',
                    'Eversión 0º a 15º'
                ],
            'explanation' => 'valoraciones/goniometria/tobillo.png'
        ],
        ['type'=>'lr', 'titulo'=>'Hallux', 'name'=>'hallux', 'valoraciones'=>[
                    'Flexión (metatarsofalángica) 0º a 45º',
                    'Extensión (metatarsofalángica) 0º a 70º',
                    'Flexión (interfalángica) A.I.F 0º a 90º',
                    'Extensión (interfalángica) 0º'
                ],
            'explanation' => 'valoraciones/goniometria/hallux.png'
        ],
        ['type'=>'4lr', 'titulo'=>'Dedos del pie', 'name'=>'dedos_del_pie', 'valoraciones'=>[
                    'Flexión MCF 0-40°',
                ],
            'explanation' => 'valoraciones/goniometria/pie.png'
        ],

    ];

@endphp
@extends("layouts.basic")
@section("content")
@push('javascript')
@endpush
{{Form::model($model,['route'=>['historia.store',$patient_id]])}}
@if($model)
{{ method_field('PATCH') }}
@endif
<style type="text/css">
    .modal-dialog{text-align:center; display: table}
    .modal-content{display:inline-block;}
</style>
    <div class="container note_container">
    	<div class="row">
            @include('reports.row_print_report', ['hideImage' => true])
        </div>
    	<div class="row">
    		<div class="col-xl-12">
    			<h4><strong>GONIOMETRÍA</strong></h4>
    		</div>
            @foreach($evaluaciones as $key=>$evaluacion)
                <div class="col-xl-12">
                    <strong>{{$evaluacion['titulo']}}</strong>
                </div>
                <div class="col-xl-12">
                    @if(!empty($evaluacion['explanation']))
                        <button type="button" class="btn btn-primary" onclick="$('#{{$key}}_modal_id').modal('show')">Ver explicación</button>
                        <div class="modal fade" id="{{$key}}_modal_id" tabindex="-1" role="dialog" aria-labelledby="{{$key}}_modal_id_label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Explicación</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{'/images/'.$evaluacion['explanation']}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if($evaluacion['type'] == 's')
                    @foreach($evaluacion['valoraciones'] as $valoracion)
                        <div class="col-xl-4">
                            @include('clinical_histories.valoration_row',[
                            'name'=>$evaluacion['name'],
                            'S_label'=>$valoracion,
                            'S_order'=>(++$count),
                            'default'=>($valorations)?
                            $valorations->where('section',$evaluacion['name']):
                            []
                            ])
                        </div>
                    @endforeach
                @elseif($evaluacion['type'] == '4lr')
                    @foreach($evaluacion['valoraciones'] as $valoracion)
                        <div class="col-lg-4">{{$valoracion}}</div>
                        @for($i=0;$i<4;$i++)
                            @php
                                $leftText = $valoracion . $evaluacion['name'] . '_'.($i+1).'_left';
                            @endphp
                            <div class="col-lg-1">
                                @include('clinical_histories.valoration_row',[
                                'name'=>$leftText,
                                'S_label'=>$i+1 .'° Izq',
                                'placeholder'=>$i+1 .'° Izq',
                                'label_show'=>false,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section',$leftText):
                                []
                                ])
                            </div>
                        @endfor
                        @for($i=0;$i<4;$i++)
                            @php
                                $rightText = $valoracion . $evaluacion['name'] . '_'.($i+1).'_right';
                            @endphp
                            <div class="col-lg-1">
                                @include('clinical_histories.valoration_row',[
                                'name'=>$rightText,
                                'S_label'=>$i+1 .'° Der',
                                'placeholder'=>$i+1 .'° Der',
                                'label_show'=>false,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section',$rightText):
                                []
                                ])
                            </div>
                        @endfor
                    @endforeach
                @elseif($evaluacion['type'] == 'lr')
                    @foreach($evaluacion['valoraciones'] as $valoracion)
                        @php
                            $leftText = $valoracion . $evaluacion['name'] . '_left';
                            $rightText = $valoracion . $evaluacion['name'] . '_right';
                        @endphp
                        <div class="col-xl-5">
                            @include('clinical_histories.valoration_row',[
                            'name'=>$leftText,
                            'S_label'=>$valoracion.' lado izquierdo',
                            'S_order'=>(++$count),
                            'complement' => '_left',
                            'default'=>($valorations)?
                            $valorations->where('section', $leftText):
                            []
                            ])                        </div>
                        <div class="col-xl-5">
                            @include('clinical_histories.valoration_row',[
                            'name'=> $rightText,
                            'S_label'=>$valoracion.' lado derecho',
                            'S_order'=>(++$count),
                            'default'=>($valorations)?
                            $valorations->where('section', $rightText):
                            []
                            ])
                            </div>
                    @endforeach
                @endif
            @endforeach
            <div class="col-lg-12">
                    @include('clinical_histories.valoration_row',[
                    'name'=>'goniometry_hiperlaxitud',
                    'S_label'=>'¿Tiene hiperlaxitud?',
                    'S_order'=>(++$count),
                    'default'=>(!empty($valorations)?$valorations:null),])
            </div>
            <div class="col-lg-12">
                    @include('clinical_histories.valoration_row',[
                    'name'=>'goniometry_conclusiones',
                    'S_label'=>'Conclusiones',
                    'S_order'=>(++$count),
                    'default'=>(!empty($valorations)?$valorations:null),])
            </div>
    	</div>
        <div class="row">
            <div class="col-xl-12">
                <br>
                {{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
                <a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
            </div>
        </div>
    </div>
{{Form::close()}}
@endsection
