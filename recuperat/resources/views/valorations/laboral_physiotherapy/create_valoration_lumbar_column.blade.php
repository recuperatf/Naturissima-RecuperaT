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
			<h2><strong>VALORACIÓN DE FISIOTERAPIA (COLUMNA LUMBAR)</strong></h2>
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
							'name'=>'valoration_laboral_lumbar_column_neuropatic',
							'S_label'=>'Neuropático',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_column_neuropatic'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_column_somatic',
							'S_label'=>'Somático',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_column_somatic'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_column_inflammatory',
							'S_label'=>'Inflamatorio',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_column_inflammatory'):
							[]
							])
				</div>
                {{-- Inicia: aún no en csv --}}
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_pain_action',
							'S_label'=>'Acción',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_pain_action'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_pain_elongation',
							'S_label'=>'Acción',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_pain_elongation'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_rest_improves',
							'S_label'=>'Mejora al reposo',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_rest_improves'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_pain_extension',
							'S_label'=>'Dolor a la extensión',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_pain_extension'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_pain_postures',
							'S_label'=>'Posturas nocivas para mejorar el dolor',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_pain_postures'):
							[]
							])
				</div>
                {{-- Termina: aún no en csv --}}
			</div>
		</div>
		<div class="col-xl-6">
            <div class="row">
                <img class="img-fluid" src="/images/valoraciones/nordico/lumbar.png">
            </div>
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_lumbar_column_eva',
							'S_label'=>'EVA',
							'show_label'=>false,
							'radio_options'=>['1','2','3','4','5','6','7','8','9','10'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_lumbar_column_eva'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row',			[
								'name'=>'valoration_laboral_lumbar_column_evolution_time',
								'S_label'=>'Tiempo de evolución',
								'S_order'=>(++$count),
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_lumbar_column_evolution_time'):
								[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row',			[
								'name'=>'valoration_laboral_lumbar_column_dinamometry',
								'S_label'=>'Dinamometría de prensión',
								'S_order'=>(++$count),
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_lumbar_column_dinamometry'):
								[]
							])
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-12">
		<div class="row">
		<div class="col-xl-12">
			<strong>Valoración Manual de la fuerza</strong>
		</div>
		@include('clinical_histories.valoration_row',			[
					'name'=>'valoration_laboral_lumbar_column_strength',
					'S_label'=>'fuerza',
					'S_order'=>(++$count),
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_lumbar_column_strength'):
					[]
				])
		</div>
	</div>
	<hr>
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_lumbar_column_first_line')
	@include('valorations.laboral_physiotherapy.create_valoration_laboral_lumbar_column_second_line')
	<hr>
		<div class="row">
		<div class="col-xl-12">
			<strong>Factores de riesgo laboral</strong>
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_lumbar_tension_work',
					'S_label'=>'Tensión durante el trabajo',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_lumbar_tension_work'):
					[]
					])
		</div>
        {{--Inicia: No está en csv--}}
        <div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_lumbar_lift_deposit_etc',
					'S_label'=>'Levantar, depositar, sostener y empujar cargas pesadas',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_lumbar_lift_deposit_etc'):
					[]
					])
		</div>
        <div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_lumbar_posture_inclination',
					'S_label'=>'Posturas, giros e inclinaciones forzadas del tronco',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_lumbar_posture_inclination'):
					[]
					])
		</div>
        <div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_lumbar_physical_work',
					'S_label'=>'Trabajo físico muy intenso',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_lumbar_physical_work'):
					[]
					])
		</div>
        <div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_lumbar_vibrations',
					'S_label'=>'Vibraciones transmitidas al cuerpo',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_lumbar_vibrations'):
					[]
					])
		</div>
        <div class="col-xl-4">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_lumbar_tension_stress',
					'S_label'=>'Tensión nerviosa y estrés',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_lumbar_tension_stress'):
					[]
					])
		</div>
        <div class="col-xl-12">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_lumbar_laboral_higiene',
						'S_label'=>'Medidas de higiene laboral',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_lumbar_laboral_higiene'):
						[]
						])
		</div>
        <div class="col-xl-12">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_lumbar_treatment_protocol',
						'S_label'=>'Protocolo de tratamiento',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_lumbar_treatment_protocol'):
						[]
						])
		</div>
        {{--Termina: No está en csv--}}
		</div>
		{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
{{Form::close()}}
@endsection




