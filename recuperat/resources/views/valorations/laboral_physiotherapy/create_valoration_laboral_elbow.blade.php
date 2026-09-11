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
			<h2><strong>VALORACIÓN DE FISIOTERAPIA (CODO)</strong></h2>
		</div>
	</div>
	@php
		$count=0;
	@endphp
	{{Form::hidden('patient_id',$patient_id)}}
	<div class="row">
		<div class="col-xl-6">
			<div class="col-xl-6">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_elbow_neuropatic',
							'S_label'=>'Neuropático',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_neuropatic'):
							[]
							])
			</div>
			<div class="col-xl-6">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_elbow_somatic',
							'S_label'=>'Somático',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_somatic'):
							[]
							])
			</div>
			<div class="col-xl-6">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_elbow_inflamatory',
							'S_label'=>'Inflamatorio',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_inflamatory'):
							[]
							])
			</div>
		</div>
		<div class="col-xl-6">
			<img class="img-fluid" src="/images/valoraciones/nordico/codo.png">
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_eva',
						'S_label'=>'EVA',
						'radio_options'=>['1','2','3','4','5','6','7','8','9','10',],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_eva'):
						[]
						])
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_elbow_dinamometry',
						'S_label'=>'Dianmometría de prensión',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_dinamometry'):
						[]
					])
		</div>
	</div>
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_elbow_first_line')
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_elbow_second_line')
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_elbow_third_line')
	<hr>
	<div class="row">
		<div class="col-xl-12">
			Valoración manual muscular
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_elbow_strength',
						'S_label'=>'Fuerza',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_strength'):
						[]
					])
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xl-2">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_strength_elbow',
						'S_label'=>'Codo',
						'radio_options'=>['Sí','No'],
						'label_width'=>'100px',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_strength_elbow'):
						[]
						])
		</div>
		<div class="col-xl-2">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_stength_carpian_flexors',
						'label_width'=>'100px',
						'S_label'=>'Flexores del carpo',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_stength_carpian_flexors'):
						[]
						])
		</div>
		<div class="col-xl-2">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_stength_carpian_extensors',
						'label_width'=>'100px',
						'S_label'=>'Extensores del carpo',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_stength_carpian_extensors'):
						[]
						])
		</div>
		<div class="col-xl-2">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_stength_biceps',
						'label_width'=>'100px',
						'S_label'=>'Biceps',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_stength_biceps'):
						[]
						])
		</div>
		<div class="col-xl-2">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_stength_triceps',
						'label_width'=>'100px',
						'S_label'=>'Triceps',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_stength_triceps'):
						[]
						])
		</div>
		<div class="col-xl-2">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_stength_supinator',
						'label_width'=>'100px',
						'S_label'=>'Supinador Largo',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_stength_supinator'):
						[]
						])
		</div>
		<div class="col-xl-2">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_stength_braquial',
						'label_width'=>'100px',
						'S_label'=>'Braquial',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_stength_braquial'):
						[]
						])
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xl-12">
			<strong>Contractura</strong>
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_repetitive_hand',
						'S_label'=>'Trabajo repetitivo haciendo fuerza con la mano y/o dedos',
						'radio_options'=>['Sí','No'],
						'label_width'=>"100%",
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_repetitive_hand'):
						[]
						])
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_impact_hand',
						'S_label'=>'Trabajos que requieren movimientos de impacto o sacudidas, supinación o pronación repetidas del brazo contra resistencia así como movimientos de flexo-extensión forzada de la muñeca',
						'radio_options'=>['Sí','No'],
						'label_width'=>"100%",
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_impact_hand'):
						[]
						])
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_elbow_prolonged_resting',
						'S_label'=>'Trabajos que requieren un apoyo prolongado sobre la cara posterior del codo',
						'radio_options'=>['Sí','No'],
						'label_width'=>"100%",
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_prolonged_resting'):
						[]
						])
		</div>
	</div>
	<div class="row">
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_elbow_laboral_hygene',
						'S_label'=>'Medidas de higiene laboral',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_laboral_hygene'):
						[]
					])
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_elbow_laboral_treatment_protocol',
						'S_label'=>'Protocolo de tratamiento',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_elbow_laboral_treatment_protocol'):
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