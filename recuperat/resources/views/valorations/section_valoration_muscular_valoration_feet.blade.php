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
	@include('reports.row_print_report')
	<div class="row">
		<div class="col-xl-12">
			@if (session('modifiedSuccess'))
			    <div class="alert alert-success">
			        {{ session('modifiedSuccess') }}
			    </div>
			@endif
		</div>
	</div>
	<div class=row>
		<div class="col-xl-12">
			<h2><strong>VALORACIÓN DE FISIOTERAPIA (PIE)</strong></h2>
		</div>
	</div>
	@php
		$count=0;
	@endphp
	{{Form::hidden('patient_id',$patient_id)}}
	<div class="row">
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_pain',
						'S_label'=>'Dolor',
						'radio_options'=>['Neuropático','Somático','Inflamatorio'],
						'S_order'=>(++$count),
						'checkbox'=>true,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_pain'):
						[]
						])
		</div>
		<div class="col-xl-6">
			<img class="img-fluid" src="/images/valoraciones/nordico/pie.png">
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_pain_eva',
						'S_label'=>'Dolor',
						'radio_options'=>['1','2','3','4','5','6','7','8','9','10'],
						'S_order'=>(++$count),
						'checkbox'=>null,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_pain_eva'):
						[]
						])
		</div>
        <div class="col-xl-6">
            @include('clinical_histories.valoration_row_options_nordic',			[
                        'name'=>'valoration_laboral_feet_pain_limitation',
                        'S_label'=>'Dolor + limitación',
                        'radio_options'=>['Sí','No'],
                        'S_order'=>(++$count),
                        'checkbox'=>null,
                        'default'=>($valorations)?
                        $valorations->where('section','valoration_laboral_feet_pain_limitation'):
                        []
                        ])
        </div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_feet_evolution_time',
						'S_label'=>'Tiempo de evolución',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_evolution_time'):
						[]
						])
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
								'name'=>'valoration_laboral_feet_pain_bipedestrian',
								'S_label'=>'¿Dolor a la bipedestación?',
								'radio_options'=>['Sí','No'],
								'S_order'=>(++$count),
								'checkbox'=>null,
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_feet_pain_bipedestrian'):
								[]
								])
				</div>

				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
								'name'=>'valoration_laboral_feet_cramps',
								'S_label'=>'¿Calambres/Pesadez?',
								'radio_options'=>['Sí','No'],
								'S_order'=>(++$count),
								'checkbox'=>null,
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_feet_cramps'):
								[]
								])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
								'name'=>'valoration_laboral_feet_edema',
								'S_label'=>'¿Edema Periférico?',
								'radio_options'=>['Sí','No'],
								'S_order'=>(++$count),
								'checkbox'=>null,
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_feet_edema'):
								[]
								])
				</div>
			</div>
		</div>
		<br/>
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					<strong>Signos:</strong>
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_varices',
						'S_label'=>'Varices visibles','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_varices'):[]])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_godette',
						'S_label'=>'Godette','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_godette'):[]])
				</div>
                {{--Inicia: falta csv--}}
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_pain_retro_foot',
						'S_label'=>'Dolor en retro/medio pie','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_pain_retro_foot'):[]])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_pain_morning',
						'S_label'=>'Dolor matutino','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_pain_morning'):[]])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_elongation',
						'S_label'=>'Aumento de tono/elongación fascia','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_elongation'):[]])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_flat_foot',
						'S_label'=>'Pie plano','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_elongation'):[]])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_silfverskiold',
						'S_label'=>'Silfverskiold','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_silfverskiold'):[]])
				</div>
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
						'name'=>'valoration_laboral_feet_punctual_pain',
						'S_label'=>'Dolor puntual','radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_silfverskiold'):[]])
				</div>
                {{--Termina: falta csv--}}
			</div>
		</div>
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					<strong></strong>
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
					'name'=>'valoration_laboral_feet_only_pain','S_label'=>'Solo dolor',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_only_pain'):[]])
				</div>
                {{--Inicia: falta csv--}}
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					[
					'name'=>'valoration_laboral_feet_pain_edema','S_label'=>'Dolor + Edema',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_feet_pain_edema'):[]])
				</div>
                {{--Termina: falta csv--}}
			</div>
		</div>
	</div>

	<hr/>
	<div class="row">
		<div class="col-xl-12">
			<h3>Valoración muscular</h3>
		</div>
		<div class="col-xl-12">
			<h3>Contracturas</h3>
		</div>
		<div class="col-xl-12">
			<h3>Pierna</h3>
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_cuadriceps',
						'S_label'=>'Cuadriceps',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_cuadriceps'):
						[]
						])
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_bit',
						'S_label'=>'BIT',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_bit'):
						[]
						])
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_adcutors',
						'S_label'=>'Aductores',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_adcutors'):
						[]
						])
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_isquitibials',
						'S_label'=>'Isquiotibiales',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_isquitibials'):
						[]
						])
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_goose',
						'S_label'=>'Pata de ganso',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_goose'):
						[]
						])
		</div>

		<div class="col-xl-12">
			<h3>Pie</h3>
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_gemels',
						'S_label'=>'Gemelos',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_gemels'):
						[]
						])
		</div>

		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_anterior_tibial',
						'S_label'=>'Tibial anterior',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_anterior_tibial'):
						[]
						])
		</div>

		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet',
						'S_label'=>'Soleo',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet'):
						[]
						])
		</div>

		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_plantar_fascia',
						'S_label'=>'Fascia Plantar',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_plantar_fascia'):
						[]
						])
		</div>

		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_posterior_tibial',
						'S_label'=>'Tibial posterior',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_posterior_tibial'):
						[]
						])
		</div>

		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_feet_peroneos',
						'S_label'=>'Peroneos',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_feet_peroneos'):
						[]
						])
		</div>

	</div>

	<div class="row">
		<div class="col-xl-12">
			<h3>Factores de riesgo laboral</h3>
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_feet_contusions',
			'S_label'=>'Golpes, contusiones con objetos, superficies u otras personas',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_feet_postures_forced',
			'S_label'=>'Posturas forzadas y prolongadas',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_feet_laboral_hygene',
			'S_label'=>'Medidas de higiene laboral',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-xl-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'valoration_laboral_feet_treatmen_protocol',
			'S_label'=>'Protocolo de tratamiento',
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
		</div>
	</div>
</div>
{{Form::close()}}
@endsection
