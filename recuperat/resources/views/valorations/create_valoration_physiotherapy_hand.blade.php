@extends('layouts.basic')
@section('content')
{{Form::model($model,['route'=>['historia.store',$patient_id]])}}
@if($model)
{{ method_field('PATCH') }}
@endif
@push('css')
<style type="text/css">
	.ui-autocomplete {
	            max-height: 200px;
	            overflow-y: auto;
	            overflow-x: hidden;
	            padding-right: 20px;
	        } 
	input[type=radio], input[type=checkbox] {
	    border: 0px !important;
	    width: 20px !important;
	    height: 20px !important;
	}
</style>
@endpush
@push('javascript')
<script type="text/javascript">
	$(function(){
		$(".autocompletable_cie10").on('input',function(event){
			$(this).autocomplete({
				source: function( request, response ) {
			        $.ajax({
			          url: "/ajax_get_cie10/"+$(event.target).val(),
			          method:'get',
			          success: function( data ) {
			           		response(data);
			          	}
			        });
			      },
				minLength: 0,
				delay: 0,
				max:10,
                scroll:true,
				select:function(event, item){
			    }
			}).focus(function () {
			    $(this).autocomplete("search");
			});
		});
		
	});
</script>
@endpush
<div class="container note_container">
	<div class="row">
		<div class="col-xl-12">
			@if (session('modifiedSuccess'))
			    <div class="alert alert-success">
			        {{ session('modifiedSuccess') }}
			    </div>
			@endif
		</div>
	</div>
	@include('reports.row_print_report')
	<div class=row>
		<div class="col-xl-12">
			<h2><strong>VALORACIÓN DE FISIOTERAPIA (MANO)</strong></h2>
		</div>
	</div>
	@php
		$count=0;
	@endphp
	{{Form::hidden('patient_id',$patient_id)}}
	<div class="row">
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_pain_type',
						'S_label'=>'Dolor',
						'radio_options'=>['Neuropático','Somático','Inflamatorio'],
						'S_order'=>(++$count),
						'checkbox'=>true,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_pain_type'):
						[]
						])
		</div>
		<div class="col-xl-6">
			<img class="img-fluid" src="/images/valoraciones/nordico/mano.jpg">
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_pain',
						'S_label'=>'Dolor',
						'radio_options'=>['1','2','3','4','5','6','7','8','9','10'],
						'S_order'=>(++$count),
						'checkbox'=>null,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_pain'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_hand_time_evolution',
						'S_label'=>'Tiempo de evolución',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_time_evolution'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_hand_dinamometry',
						'S_label'=>'Dinamometría de prensión',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_dinamometry'):
						[]
						])
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_innervation_territory',
						'S_label'=>'Territorio Nervioso',
						'radio_options'=>['Mediano','Cubital','Radial'],
						'S_order'=>(++$count),
						'checkbox'=>true,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_innervation_territory'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_weakness',
						'S_label'=>'Adormecimiento debilidad hormigueo',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'checkbox'=>null,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_weakness'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_nocturne',
						'S_label'=>'¿Nocturnos?',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'checkbox'=>null,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_nocturne'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_relief_with_position',
						'S_label'=>'¿Alivio de síntomas con cambios de posición?',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'checkbox'=>null,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_relief_with_position'):
						[]
						])
		</div>
		<br/>
		<div class="col-xl-4">
			<div class="col-xl-12">
				<strong>Signos:</strong>
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_tinel',
					'S_label'=>'Tinel',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_tinel'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_phalen',
					'S_label'=>'Phalen',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_phalen'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_flick',
					'S_label'=>'Flick',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_flick'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_wartenberg',
					'S_label'=>'Wartenberg',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_wartenberg'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_froment',
					'S_label'=>'Froment',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_froment'):[]])
			</div>
		</div>
		<div class="col-xl-4">
			<div class="col-xl-12">
				<strong></strong>
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_sensitive_neuropathies',
					'S_label'=>'Neuropatía Sensitiva','radio_options'=>['Sí',
					'No'],'S_order'=>(++
					$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_sensitive_neuropathies'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_sensitive_moter_no_atrophy',
					'S_label'=>'Sensitiva y Motora sin atrofia',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_sensitive_moter_no_atrophy'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_atrophy',
					'S_label'=>'Atrofia',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_atrophy'):[]])
			</div>
		</div>
	</div>

	<hr/>
	<div class="row">
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_articulation_pain',
						'S_label'=>'Dolor en articulaciones IF, MCF',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_articulation_pain'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_articular_inflammation',
						'S_label'=>'Inflamación articular',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_articular_inflammation'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_rigidity',
						'S_label'=>'Rigidez',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_rigidity'):
						[]
						])
		</div>
		<br/>
		<div class="col-xl-4">
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_sum',
					'S_label'=>'Suma',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_sum'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_nodules',
					'S_label'=>'Nódulos',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_nodules'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_deformity',
					'S_label'=>'Deformidad',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_deformity'):[]])
			</div>
		</div>
		<div class="col-xl-4">
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_pain2',
					'S_label'=>'Dolor',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_pain2'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_pain_inflammation',
					'S_label'=>'Dolor+I
					nflamacioń','radio_options'=>['Sí',
					'No'],'S_order'=>(++
					$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_pain_inflammation'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_rigidity_2',
					'S_label'=>'Rigidez',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_rigidity_2'):[]])
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_thumb_pain',
						'S_label'=>'Dolor en pulgar',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_thumb_pain'):
						[]
						])
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_hand_escafoids_trapecius_pain',
						'S_label'=>'Tumefacción dobre escafoides o trapecio',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_hand_escafoids_trapecius_pain'):
						[]
						])
		</div>
		<br/>
	</div>
	<div class="row">
		<div class="col-xl-6">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
						'name' => 'valoration_laboral_hand_filkenstein',
						'S_label'=>'Filkenstein',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_filkenstein'):[]])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
						'name' => 'valoration_laboral_hand_calester',
						'S_label'=>'Calester',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_calester'):[]])
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
						'name' => 'valoration_laboral_hand_pain_stretch',
						'S_label'=>'Dolor al estiramiento','radio_options'=>['Sí',
						'No'],'S_order'=>(++
						$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_pain_stretch'):[]])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
						'name' => 'valoration_laboral_hand_pain_action',
						'S_label'=>'Dolor ala acción',
						'radio_options'=>['Sí','No'],
						 'S_order'=>(++$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_pain_action'):[]])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
						'name' => 'valoration_laboral_hand_pain_resting',
						'S_label'=>'Dolor al reposo','radio_options'=>['Sí',
						'No'],'S_order'=>(++
						$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_pain_resting'):[]])
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12">
			<strong>Factores de Riesgo Laboral</strong>
		</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_pain_action_hand',
					'label_width'=>'100%'
					,'S_label'=>'Trabajo repetitivo haciend o fuerza con la mano y/o dedos',
					'radio_options'=>['Sí','No'],'S_order'=>(++$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_pain_action_hand'):[]])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row_options_nordic',			[
					'name' => 'valoration_laboral_hand_pain_action_wrist',
					'S_label'=>'Trabajo repetitivo forzado en muñeca, usando solo dos o tres dedos',
					'radio_options'=>['Sí','No'],'label_width'=>'100%','S_order'=>(++$count),'default'=>($valorations)?$valorations->where('section','valoration_laboral_hand_pain_action_wrist'):[]])
			</div>
	</div>
	<div class="row">
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row',			[
							'name'=>'valoration_laboral_hand_laboral_hygene',
							'S_label'=>'Medidas de higiene laboral',
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_hand_laboral_hygene'):
							[]
							])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row',			[
							'name'=>'valoration_laboral_hand_protocol',
							'S_label'=>'Protocolo de tratamiento',
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_hand_protocol'):
							[]
							])
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