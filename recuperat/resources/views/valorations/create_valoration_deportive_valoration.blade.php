@php
$count=0;



$parameters = [
	['test'=>
				'Test Postural',
	'explanation' =>'<strong>Test postural:</strong> el paciente en bipedestación, el medico evaluara al paciente de frente, de espaldas y de lado. De cabeza a pies revisando su postura.'
			],
	['test'=>
				'Sentadilla Profunda',
				'unilateral' => true,
				'explanation' =>'<strong>Sentadilla profunda:</strong> Paciente en bipedestación, le pedimos que abra los pies a la altura de los hombros, paralelos entre sí. Para conocer la apertura de las manos, apoya el pal en la cabeza, estas irán donde los codos estén en una posición de 90°. Una vez que conozca la posición, extiende los brazos para levantar el palo. Con la mirada al frente, desciende lo más profundo que puedes, manteniendo los talones pegados, al suelo. Evita que las rodillas se metan hacia el interior (valgo). El palo a permanecer paralelo al suelo: 3pts ejecución es perfecta, sin caderas por debajo del nivel de las rodillas, torso recto paralelo a la tibia, rodillas rectas y palo horizontal en la vertical de los pies. 2 pts si  para ejecutarlo necesita elevar los talones o curvar la zona lumbar. 1pts si no es capaz de realizarlo ni con ayuda para elevar los talones. 0 pts si hay dolor.'
			],
	['test'=>
				'Pasar la Valla',


			],
	['test'=>
				'Desplante en línea',
				'explanation' => '<strong>Desplante en línea:</strong> le pedimos al paciente que agarre el palo por detrás de su espalda. En vertical. La mano izquierda lo cogerá por la zona lumbar y la otra por detrás del cuello. Coloca un pie con el talón al inicio de la línea y con el otro pie con la punta al final de la línea, sin mover los pies  baja el cuerpo hasta tocar con la rodilla el suelo. Regresa a la posición inicial, le pedimos que lo haga con los dos pies y el palo siempre está en contacto con la espalda y cabeza: 3 pts ejecución perfecta sin perder la lineación ni flexionar el tronco, ni levantar el talón y con una adecuada estabilidad y equilibrio. 2  pts  se produce una compensación flexionando el tronco, que se observa al separar el palo del cuerpo '
			],
	['test'=>
				'Levantamiento Pierna Recta',
				'explanation' => '<strong>Levantamiento pierna recta:</strong> paciente en decúbito supino, brazos estirados, con las palmas hacia arriba. Le pedimos que eleve una pierna lo que pueda, sin flexionar el tobillo ni la rodilla. La cadera y la otra pierna permanecerán inmóviles, pegadas al suelo: 3pts  el palo baja entre la mitad del muslo y la pierna, 2 pts el palo queda en la mitad inferior del muslo, 1 pts si el palo queda por debajo de la rodilla y 0 pts hay dolor. '
			],
	['test'=>
				'Rotación Tronco',
				'explanation' =>  '<strong>Rotación tronco:</strong> paciente en cuatro puntos simétricamente sobre la cinta, con el torso recto  y paralelo al suelo, muslos y brazos bajan perpendiculares al suelo y tronco  horizontal y la neutralidad de la columna. Ahora, intenta tocar a mitad de recorrido el codo con la rodilla, sin perder la estabilidad  del tronco. 3 pts ejecución perfecta, con pierna y brazo del mismo lado,  2 pts si ejecución perfecta, pero con las extremidades de distintos lados, 1 pts no consigues realizar ninguno de los anteriores por perdida equilibrio o falta de movilidad. 0 pts no hay dolor.'
			],
	['test'=>
				'Movilidad Tobillo',
				'explanation' => '<strong>Movilidad tobillo:</strong> paciente en bipedestación posiciona un pie a 10 cm de la pared y la otra pierna detrás como si fuera hacer un desplante, le pedimos al paciente que trate de tocar la pared con la rodilla sin despegar el talón del suelo.'
			],
	['test'=>
				'Movilidad Hombro',
				'explanation' => '<strong>Movilidad hombro:</strong> paciente en bipedestación, con la mirada al frente y los pies juntos, le pedimos que intente juntar sus manos por atrás. Una mano bajar por detrás y la otra mano subiera por la espalda. El paciente tiene que intentar tocarse las manos: 3 pts si se tocan las manos o  hay menos de una mano de distancia. 2pts si existe una distancia inferior a una mano y media. 1 pts si la distancia es superior a una mano y media. 0pys si hay dolor.'
			],
	['test'=>
				'Plancha Prona',
				'explanation' => '<strong>Plancha prona: </strong>paciente en decúbito prono le pedimos que flexione sus ante brazos y apoye sus codos en el suelo y al mismo tiempo se apoye en las puntas de sus pies, le pedimos que mantenga esa posición durante unos segundos lo más que pueda.'
			],
	['test'=>
				'Fuerza Empuje',
				'unilateral' => true,
			],
	['test'=>
				'Puente Unipodal',
				'explanation' => '<strong>Puente unipodal: </strong>paciente en decúbito supino, le pedimos al paciente que doble sus rodillas y levante su cadera del suelo, después le pedimos que despegue un pie del suelo y lo estire manteniendo la cadera despegada. Le decimos que lo realice con el otro pie.'
			],
	['test'=>
				'Bird Dog',
				'explanation' =>'<strong>Bird dog:</strong> paciente en cuatro puntos, le pedimos que lleve un brazo hacia delante y al  mismo tiempo lleve su pierna contraria hacia una extensión, como si fuera lanzar una patada hacia atrás, y después le pedimos que lo haga con el otro brazo y pierna.  (Evalúa y trabaja la estabilidad del tronco y la columna vertebral)'
			],
	['test'=>
				'test de Dedos',
				'unilateral' => true,
				'explanation' => '<strong>Prueba de dedos:</strong> estando el paciente de pie con los pies juntos, se debe inclinar hacia adelante con las manos y dedos extendidos. Se mide la distancia los extremos de los dedos y el suelo.'
			],
	['test'=>
				'Single Leg Squat Test',
				'explanation' => '<strong>Single leg squat test:</strong> el paciente se encuentra en bipedestación con de una pierna en posición neutra, la otra pierna se encuentra en una ligera flexión de cadera y rodilla en extensión, brazos en estirados hacia adelante con las manos juntas en un ángulo recto con respecto al tronco. Desde esta posición el paciente tiene que tratar de ponerse en cuclillas flexionando la rodilla   sin modificar la posición de los brazos y sin despegar el talón del suelo. Y seguidamente debe regresar a la posición inicial. (valora la fuerza muscular de los cuádriceps y glúteos).'
			],
	['test'=>
				'Test de Thomas modificado',
				'explanation' => '<strong>Test de thomas modificado:</strong> paciente en decúbito  supino, con las rodillas al borde de la camilla, el médico le pide al paciente que lleve una pierna al pecho y sujetarla con las dos manos. El test es positivo si la pierna contraria se despega de la camilla, y nos dice que tiene un acortamiento de psoas.'
			],
];
@endphp
@extends("layouts.basic")
@section("content")
@push('javascript')
@endpush
<script type="text/javascript">

</script>
<div class="container note_container">
{{Form::model($model,['route'=>['historia.store',$patient_id]])}}
@if($model)
{{ method_field('PATCH') }}
@endif
	@include('reports.row_print_report', ['hideImage' => true])
 <div class="row">
    <div class="col-lg-12">
        <strong>VALORACIÓN DEPORTIVA</strong>
    </div>
</div>
<div class="row">
		<div class="col-lg-3 offset-lg-3">
			<strong>DERECHA</strong>
		</div>
		<div class="col-lg-3">
			<strong>IZQUIERDA</strong>
		</div>
		<div class="col-lg-3">
			<strong>OBSERVACIÓN</strong>
		</div>
	</div>
	<br>
@foreach($parameters as $key => $parameter)
	<div class="row">
		<div class="col-lg-3">
			<strong>{{$parameter['test']}}</strong>
			@if(!empty($parameter['explanation']))
				<span data-toggle="modal" href="#modal_explanation_{{$count}}"><i class="fas fa-question"></i></span>
				<div class="modal fade" id="modal_explanation_{{$count}}">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Explicación de <strong>{{$parameter['test']}}</strong></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								{!!$parameter['explanation']!!}
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
		@if(empty($parameter['unilateral']))
			<div class="col-lg-3">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_derecha',
	            'S_label'=>$parameter['test'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(!empty($valorations)?$valorations:null),])
			</div>
			<div class="col-lg-3">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_izquierda',
	            'S_label'=>$parameter['test'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(!empty($valorations)?$valorations:null),])
			</div>
		@else
			<div class="col-lg-6">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_observations_unilateral',
	            'S_label'=>$parameter['test'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(!empty($valorations)?$valorations:null),])
			</div>
		@endif
		<div class="col-lg-3">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_observations',
	            'S_label'=>$parameter['test'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(!empty($valorations)?$valorations:null),])
		</div>
	</div>
	<br>
@endforeach
<div class="row">
	<div class="col-lg-12">
		<strong>Puntos Gatillo</strong>
	</div>
	<div class="col-lg-12">
			@include('clinical_histories.valoration_row',[
            'name'=>'valoration_deportive_observations',
            'S_label'=>'Puntos Gatillo',
	            'label_show' => false,
            'S_order'=>(++$count),
            'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-lg-12">
		<strong>Puntaje</strong>
	</div>
		<div class="col-lg-5">

				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_observations',
	            'S_label'=>'puntaje',
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(!empty($valorations)?$valorations:null),])
		</div>
</div>
<div class="row">
    <div class="col-xl-12">
        <br>
        {{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
    </div>
</div>
{{Form::close()}}
</div>
@endsection
