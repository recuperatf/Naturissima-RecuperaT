@php
	$count=0;
@endphp
@if (empty($client_view))
  @extends('layouts.basic')
@endif
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
	    min-width: 20px !important;
	    min-height: 20px !important;
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
			<h2><strong>VALORACIÓN DE FISIOTERAPIA (HOMBRO)</strong></h2>
		</div>
	</div>
	@php
		$count=0;
	@endphp
	{{Form::hidden('patient_id',$patient_id)}}
	<div class="row">
		<div class="col-xl-6">
			<div class="row">
				<div class="col-xl-12">
					<strong>Dolor</strong>
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_neuropatic',
							'S_label'=>'Neuropático',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_neuropatic'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_somatic',
							'S_label'=>'Somático',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_somatic'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_inflamatory',
							'S_label'=>'Inflamatorio',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_inflamatory'):
							[]
							])
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<img class="img-fluid" src="/images/valoraciones/nordico/hombro.png">
		</div>
		<div class="col-xl-6">
			<div class="row">
				<div class="col-xl-12">
					<strong>EVA</strong>
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_eva',
							'S_label'=>'EVA',
							'show_label'=>false,
							'radio_options'=>['1','2','3','4','5','6','7','8','9','10'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_eva'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row',			[
								'name'=>'valoration_laboral_shoulder_evolution',
								'S_label'=>'Tiempo de evolución',
								'S_order'=>(++$count),
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_shoulder_evolution'):
								[]
							])
				</div>
			</div>
		</div>
	</div>
	<hr>
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_shoulder_first_line')
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_shoulder_second_line')
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_shoulder_third_line')
	<hr>
	<div class="col-xl-12">
		<div class="row">
		<div class="col-xl-12">
			<strong>Valoración Manual de la fuerza</strong>
		</div>
		@include('clinical_histories.valoration_row',			[
					'name'=>'valoration_laboral_shoulder_strenght',
					'S_label'=>'fuerza',
					'S_order'=>(++$count),
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_strenght'):
					[]
				])
		</div>
	</div>
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_shoulder_contractures')
    <div class="row">
		<div class="col-xl-12">
			<h3>Factores de riesgo laboral</h3>
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_shoulder_contusions',
			'S_label'=>'Golpes, contusiones con objetos, superficies u otras personas',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_shoulder_postures_forced',
			'S_label'=>'Posturas forzadas y prolongadas',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_shoulder_laboral_hygene',
			'S_label'=>'Medidas de higiene laboral',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_shoulder_treatmen_protocol',
			'S_label'=>'Protocolo de tratamiento',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
	</div>
	{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
{{Form::close()}}
@endsection




