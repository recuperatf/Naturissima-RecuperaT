@php
$count=0;



$parameters = [
	['prueba'=>
				'Test Postural',
			],
	['prueba'=>
				'Sentadilla Profunda',
				'unilateral' => true
			],
	['prueba'=>
				'Pasar la Valla',

			],
	['prueba'=>
				'Desplante en línea',
			],
	['prueba'=>
				'Levantamiento Pierna Recta',
			],
	['prueba'=>
				'Rotación Tronco',
			],
	['prueba'=>
				'Movilidad Tobillo',
			],
	['prueba'=>
				'Movilidad Hombro',
			],
	['prueba'=>
				'Plancha Prona',
			],
	['prueba'=>
				'Fuerza Empuje',
				'unilateral' => true
			],
	['prueba'=>
				'Puente Unipodal',
			],
	['prueba'=>
				'Bird Dog',
			],
	['prueba'=>
				'Prueba de Dedos',
				'unilateral' => true
			],
	['prueba'=>
				'Single Leg Squat Test',
			],
	['prueba'=>
				'Test de Thomas modificado',
			],
];
@endphp
@extends("layouts.basic")
@section("content")
@push('javascript')
@endpush
<script type="text/javascript">

</script>
<div class="container">
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
			<strong>{{$parameter['prueba']}}</strong>
		</div>
		@if(empty($parameter['unilateral']))
			<div class="col-lg-3">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_derecha',
	            'S_label'=>$parameter['prueba'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(($valorations)?$valorations:null),])					
			</div>
			<div class="col-lg-3">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_izquierda',
	            'S_label'=>$parameter['prueba'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(($valorations)?$valorations:null),])					
			</div>
		@else
			<div class="col-lg-6">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_observations_unilateral',
	            'S_label'=>$parameter['prueba'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(($valorations)?$valorations:null),])					
			</div>
		@endif
		<div class="col-lg-3">
				@include('clinical_histories.valoration_row',[
	            'name'=>'valoration_deportive_observations',
	            'S_label'=>$parameter['prueba'],
	            'label_show' => false,
	            'S_order'=>(++$count),
	            'default'=>(($valorations)?$valorations:null),])					
		</div>
	</div>
	<br>
@endforeach
</div>
<div class="row">
	<div class="col-lg-12">
		<strong>Observaciones</strong>
	</div>
	<div class="col-lg-12">
		@include('clinical_histories.valoration_row',[
        'name'=>'valoration_deportive_observations',
        'S_label'=>'observaciones',
        'label_show' => false,
        'S_order'=>(++$count),
        'default'=>(($valorations)?$valorations:null),])	
	</div>
	<div class="col-lg-12">
		<strong>Puntaje</strong>
	</div>
	<div class="col-lg-12">
		@include('clinical_histories.valoration_row',[
        'name'=>'valoration_deportive_observations',
        'S_label'=>'puntaje',
        'label_show' => false,
        'S_order'=>(++$count),
        'default'=>(($valorations)?$valorations:null),])	
	</div>
</div>
</div>    
@endsection
