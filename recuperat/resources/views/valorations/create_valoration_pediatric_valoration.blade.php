@php
$count=0;

$reflejos = [
	[
		'edad' => '0-3 meses', 'parametros'=>
		[
			'Reflejo acústico facial',
			'Moro',
			'Reflejo de Rooting',
			'Ojos de muñeca',
			'Reflejo marcha automática',
			'Reflejo tónico-cervical',
			'Reflejo expansión palmar',
			'Reflejo suprapúbico',
			'Reflejo de Babin',
		]
	],
	[
		'edad' => '3-6 meses', 'parametros'=>
		[
			'Reflejo de succión',
			'Reflejo de enderezamiento',
			'Reflejo de Galant',
			'Reflejo acústico facial',
			'Reflejo óptico facial',
			'Reflejo defensivo sentado',
		]
	],
	[
		'edad' => '6-9 meses', 'parametros'=>
		[
			'Reflejo paracaídas',
			'Alpinista',
		]
	],
	[
		'edad' => '9-18 meses', 'parametros'=>
		[
			'Dorsiflexor',
		]
	],
	[
		'edad' => '36-48 meses', 'parametros'=>
		[
			'Romberg',
		]
	],
];

$motricidad = [
	[
		'edad' => '1 meses', 'parametros'=>
		[
			'Sigue movimiento horizontal y vertical de objetos',
			'Patea',
			' Vigorosamene',
			'Gira la cabeza hacia ambos lados',
			'Flexiona los brazos a los lados con puños cerrados',
			'Flexiona y abre las piernas a los lados y levanta los pies',
			'Levanta la pelvis del suelo',
		]
	],
	[
		'edad' => '2 meses', 'parametros'=>
		[
			'Disminuye la fuerte flexión de las piernas',
			'Se apoya brevemente en los antebrazos',
		]
	],
	[
		'edad' => '3 meses', 'parametros'=>
		[
			'Se apoya sobre codo y pelvis',
			'Levanta y gira la cabeza',
			'Sostiene objetos en manos',
			'Se lleva objetos a la boca',
			'Levanta la cabeza y pecho en prono',
			'Sostiene la cabeza al levantar los brazos',
		]
	],
	[
		'edad' => '4 meses', 'parametros'=>
		[
			'Pasa objetos de una mano a otra',
			'Mantiene el equilibrio sobre el abdomen',
			'Comienza a desplazar el equilibrio hacia un lado',
		]
	],
	[
		'edad' => '5 meses', 'parametros'=>
		[
			'Extiende los brazos hacia adelante',
			'Brazos y piernas levantadas haciendo simulación de nado',
			'Pelvis y muslos en reposo, piernas separadas, rodillas flexionadas y empieza a agitar las piernas en el aire',
		]
	],
	[
		'edad' => '6 meses', 'parametros'=>
		[
			'Se apoya con brazos extendidos y manos abiertas',
			'Columna vertebral completamente extendida',
			'Desplaza el cuerpo hacia la pelvis.',
			'Intenta sentarse solo',
		]
	],
	[
		'edad' => '7 meses', 'parametros'=>
		[
			'Manipula varios objetos a la vez',
			'Agarra objetos pequeños con los dedos',
			'Desplaza el cuerpo hacia los muslos',
			'Desplaza el peso lateralmente',
		]
	],
	[
		'edad' => '8 meses', 'parametros'=>
		[
			'Se apoya en manos y rodillas',
			'Gira sobre su propio cuerpo',
			'Patrón de marcha',
		]
	],
	[
		'edad' => '9 meses', 'parametros'=>
		[
			'Repta (Gatea)',
			'Se para solo',
			'Se agarra y sostiene',
		]
	],
	[
		'edad' => '10 meses', 'parametros'=>
		[
			'Marcha con ayuda',
			'Desplaza el peso del cuerpo hacia el costado y adelante',
			'Posición en 4 puntos',
			'Gateo descoordinado',

		]
	],
	[
		'edad' => '11 meses', 'parametros'=>
		[
			'Gatea con movimientos cruzados',
		]
	],
	[
		'edad' => '12 meses', 'parametros'=>
		[
			'Puede escalar obstáculos',
			'Se apoya sobre manos y pies',
			'De apoyo en manos y pies a cunclillas',
		]
	],
	[
		'edad' => '13-18 meses', 'parametros'=>
		[
			'Camina solo',
			'Corre',
			'Sube y baja escaleras con ayuda',
		]
	],
	[
		'edad' => '19-24 meses', 'parametros'=>
		[
			'Manipula objetos pequeños',
		]
	],
	[
		'edad' => '2-3 años', 'parametros'=>
		[
			'Reconoce las partes pequeñas del cuerpo: boca, ojos, etc. ',
			'Camina hacia atrás',
			'Se levanta sin usar las manos',
			'Salta venciendo gravedad',
		]
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
<script type="text/javascript">

</script>
<div class="container note_container">
    @include('reports.row_print_report', ['hideImage' => true])
 <div class="row">
    <div class="col-lg-12">
        <strong>VALORACIÓN PEDIÁTRICA</strong>
    </div>
    <div class="col-lg-12">
        @include('clinical_histories.valoration_row_options_nordic',[
                        'name'=>'valoration_pediatric_valoration_abortion',
                        'S_label'=>'Amenaza de aborto',
                        'width' => '100',
                        'radio_options'=>[
                            'type'=>'radio','si','no',
                        ],
                        'S_order'=>(++$count),
                        'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_abortion'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
        @include('clinical_histories.valoration_row_options_nordic',[
                        'name'=>'valoration_pediatric_valoration_complications_during_pregnancy',
                        'S_label'=>'Complicaciones durante el embarazo',
                        'width' => '100%',
                        'radio_options'=>[
                            'type'=>'radio','si','no',
                        ],
                        'S_order'=>(++$count),
                        'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_complications_during_pregnancy'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_which_complications',
                    'S_label'=>'¿Cuáles?',
                        'width' => '100%',
                    'rows'=>'2',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_which_complications'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
        @include('clinical_histories.valoration_row_options_nordic',[
                        'name'=>'valoration_pediatric_valoration_medicine_during_pregnancy',
                        'S_label'=>'Ingesta de medicamento durante el embarazo',
                        'width' => '100%',
                        'radio_options'=>[
                            'type'=>'radio','si','no',
                        ],
                        'S_order'=>(++$count),
                        'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_medicine_during_pregnancy'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_which_medicines_during_preganancy',
                    'S_label'=>'¿Cuáles?',
                        'width' => '100%',
                    'rows'=>'2',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_which_medicines_during_preganancy'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
        @include('clinical_histories.valoration_row_options_nordic',[
                        'name'=>'valoration_pediatric_valoration_birth',
                        'S_label'=>'Nacimiento',
                        'width' => '100%',
                        'radio_options'=>[
                            'type'=>'radio','Cesárea','Parto',
                        ],
                        'S_order'=>(++$count),
                        'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_birth'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_observations_birth',
                    'S_label'=>'¿Observaciones / Motivo de la cesárea?',
                        'width' => '100%',
                    'rows'=>'2',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_observations_birth'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
    	<strong>Datos del paciente</strong>
    </div>
    <div class="col-lg-12">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_hours_sleep',
                    'S_label'=>'Horas y tipo de sueño',
                        'width' => '100%',
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_hours_sleep'):
                        []
                        ])
    </div>
    <div class="col-lg-4">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_irritability',
                    'S_label'=>'Irritabilidad',
                        'width' => '100%',
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_irritability'):
                        []
                        ])
    </div>
    <div class="col-lg-4">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_inquietud',
                    'S_label'=>'Inquietud',
                        'width' => '100%',
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_inquietud'):
                        []
                        ])
    </div>
     <div class="col-lg-4">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_sleepy',
                    'S_label'=>'Somnolencia',
                        'width' => '100%',
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_sleepy'):
                        []
                        ])
    </div>
     <div class="col-lg-4">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_coodrination',
                    'S_label'=>'Problemas de coordinación, deglución o respiración',
                        'width' => '100%',
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_coodrination'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
    	@include('clinical_histories.valoration_row',[
                    'name'=>'valoration_pediatric_valoration_cause_consultation',
                    'S_label'=>'Motivo de consulta por parte de los padres',
                        'width' => '100%',
                    'rows'=>'2',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                    'default'=>($valorations)?
                        $valorations->where('section','valoration_pediatric_valoration_cause_consultation'):
                        []
                        ])
    </div>
    <div class="col-lg-12">
    		<h4>Exploración de reflejos</h4>
    		<a class="btn btn-primary" data-toggle="modal" href='#modal-reflejos'>Ver exploración de reflejos</a>
    		<div class="modal fade" id="modal-reflejos">
    			<div class="modal-dialog">
    				<div class="modal-content">
    					<div class="modal-header">
    						<h4 class="modal-title">Expliración de Reflejos</h4>
    						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    					</div>
    					<div class="modal-body">
    						<p><strong>• Reflejo de Babinski</strong> Se le pasa suavemente la mano por la planta del pie hasta el dedo gordo, levanta los dedos y voltea el pie hacia adentro. </p>
    						<p><strong>• Reflejo de succión</strong> Tocar suavemente la mejilla y el bebé buscara el estímulo con la boca abierta para succionar.</p>
    						<p><strong>• Reflejo de Babin</strong> Al apretar las manos del niño abre la boca</p>
    						<p><strong>• Reflejo de Rooting</strong> La boca e incluso la lengua se orientan hacia el estímulo </p>
    						<p><strong>• Reflejo de ojos de muñeca</strong> Al girar pasivamente la cabeza los ojos quedan en un breve tiempo fijos, luego siguen la dirección del giro. </p>
    						<p><strong>• Reflejo marcha automática</strong> En posición vertical apoyan los pies y simulan dar unos pasos. </p>
    						<p><strong>• Reflejo tónico- cervical</strong> Al girar pasivamente la cabeza se extiende la extremidad superior del mismo lado y se flexiona del lado contralateral. </p>
    						<p><strong>• Reflejo de suprapúbico: Al presionar encima del pubis se produce una extensión tónica de las piernas</strong> rotación interna, aducción, equino en pies y separación de dedos.  </p>
    						<p><strong>• Reflejo moro</strong> Se desencadena en decúbito supino dejando caer hacia atrás la cabeza o bien con una palmada. Se produce abducción de hombro, extensión de codo seguido de  aducción de hombro con flexión de codo. </p>
    						<p><strong>• Reflejo de enderezamiento</strong> Haciendo presión sobre los pies, se produce un enderezamiento progresivo de la zona caudal a la apical. </p>
    						<p><strong>• Reflejo Galant</strong> El niño debe de estar suspendido por el vientre. Se hace una presión paravertebral desde debajo de la escapula hasta encima de la cresta iliaca, produciéndose una flexión lateral hacia el lado estimulado. </p>
    						<p><strong>• Reflejo de expansión palmar</strong> Al incluir un objeto en la palma de la mano, flexiona y agarra. </p>
    						<p><strong>• Reflejo acústico facial</strong> Parpadeo ante un ruido brusco. </p>
    						<p><strong>• Reflejo óptico facial</strong> Parpadeo al aproximar un objeto al ojo. </p>
    						<p><strong>• Reflejo paracaídas</strong> Se pone al lactante inclinado lateralmente, en ambas direcciones y debe de poner la manos (este reflejo ya no desaparece)</p>
    					</div>
    					<div class="modal-footer">
    						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    					</div>
    				</div>
    			</div>
    		</div>

    </div>
    @foreach($reflejos as $reflejo)
	    <div class="col-lg-12">
	    	<h4>{{$reflejo['edad']}}</h4>
	    </div>
	    @foreach($reflejo['parametros'] as $param)
		    <div class="col-lg-4">
					@include('clinical_histories.valoration_row_options_nordic',[
						'name'=>'valoration_pediatric_valoration_'. str_replace(' ','_', strtolower($param)),
						'S_label'=>$param,
						'radio_options'=>['presente','regular','ausente'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_pediatric_valoration_'.str_replace(' ','_', strtolower($param))):
						[]
					])
		    </div>
	    @endforeach
    @endforeach
    <div class="col-lg-12">
    	<h3>Motricidad</h3>
    </div>
        @foreach($motricidad as $motricidad)
    	    <div class="col-lg-12">
    	    	<h4>{{$motricidad['edad']}}</h4>
    	    </div>
    	    @foreach($motricidad['parametros'] as $param)
    		    <div class="col-lg-4">
    		    	@include('clinical_histories.valoration_row_options_nordic',[
    		                        'name'=>'valoration_pediatric_valoration_' . str_replace(' ','_',(strtolower($param))),
    		                        'S_label'=>$param,
    		                        'width' => '100',
    		                        'radio_options'=>['presente','regular','ausente'],
    		                        'S_order'=>(++$count),
    		                        'default'=>($valorations)?
    		                        $valorations->where('section','valoration_pediatric_valoration_' . str_replace(' ','_',(strtolower($param)))):
    		                        []
    		                        ])
    		    </div>
    	    @endforeach
        @endforeach
</div>
<div class="row">
    <div class="col-lg-12">
        <strong>Observaciones</strong>
    </div>
    <div class="col-lg-12">
        @include('clinical_histories.valoration_row',[
        'name'=>'valoration_pediatric_valoration_observations',
        'S_label'=>'observaciones',
        'label_show' => false,
        'S_order'=>(++$count),
        'default'=>(!empty($valorations)?$valorations:null),])
    </div>
    <div class="col-lg-12">
        <strong>Puntaje</strong>
    </div>
    <div class="col-lg-12">
        @include('clinical_histories.valoration_row',[
        'name'=>'valoration_pediatric_valoration_observations',
        'S_label'=>'puntaje',
        'label_show' => false,
        'S_order'=>(++$count),
        'default'=>(!empty($valorations)?$valorations:null),])
    </div>
		<div class="col-lg-12">
			{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
			<a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
		</div>
</div>
</div>

</div>


{{Form::hidden('patient_id',$patient_id)}}
{{Form::close()}}

</div>
@endsection
