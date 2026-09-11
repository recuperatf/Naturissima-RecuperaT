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
			<h2><strong>VALORACIÓN DE FISIOTERAPIA (RODILLA)</strong></h2>
		</div>
	</div>
	@php
		$count=0;
	@endphp
	{{Form::hidden('patient_id',$patient_id)}}
	<div class="row">
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_knee_pain_type',
						'S_label'=>'Dolor',
						'radio_options'=>['Neuropático','Somático','Inflamatorio'],
						'S_order'=>(++$count),
						'checkbox'=>true,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_knee_pain_type'):
						[]
						])
		</div>
		<div class="col-xl-6">
			<img class="img-fluid" src="/images/valoraciones/nordico/rodilla.png">
		</div>
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_knee_pain_eva',
						'S_label'=>'Dolor',
						'radio_options'=>['1','2','3','4','5','6','7','8','9','10'],
						'S_order'=>(++$count),
						'checkbox'=>null,
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_knee_pain_eva'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_knee_evolution_time',
						'S_label'=>'Tiempo de evolución',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_knee_evolution_time'):
						[]
						])
		</div>
		<div class="col-xl-4">
			@include('clinical_histories.valoration_row',			[
						'name'=>'valoration_laboral_knee_dinamometry',
						'S_label'=>'Dinamometría de prensión',
						'S_order'=>(++$count),
						'default'=>($valorations)?
						$valorations->where('section','valoration_laboral_knee_dinamometry'):
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
								'name'=>'valoration_laboral_knee_activity',
								'S_label'=>'¿Dolor a la actividad?',
								'radio_options'=>['Sí','No'],
								'S_order'=>(++$count),
								'checkbox'=>null,
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_knee_activity'):
								[]
								])
				</div>

				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
								'name'=>'valoration_laboral_knee_edema',
								'S_label'=>'¿Crepitación, edema, aumento de volumen?',
								'radio_options'=>['Sí','No'],
								'S_order'=>(++$count),
								'checkbox'=>null,
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_knee_edema'):
								[]
								])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
								'name'=>'valoration_laboral_knee_roms',
								'S_label'=>'¿Disminución de la fuerza/ROMS?',
								'radio_options'=>['Sí','No'],
								'S_order'=>(++$count),
								'checkbox'=>null,
								'default'=>($valorations)?
								$valorations->where('section','valoration_laboral_knee_roms'):
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
					@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_knee_comb',
						'S_label'=>'Cepillo',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_comb'):[]])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
						'name'=>'valoration_laboral_knee_key',
						'S_label'=>'Tecla',
						'radio_options'=>['Sí','No'],
						'S_order'=>(++$count),
						'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_key'):[]])
				</div>
			</div>
		</div>
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					<strong></strong>
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					['name'=>'valoration_laboral_knee_only_pain',
					'S_label'=>'Solo dolor',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_only_pain'):[]])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					['name'=>'valoration_laboral_knee_pain_inflamation',
					'S_label'=>'Dolor + Inflamación',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_pain_inflamation'):[]])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',
					['name'=>'valoration_laboral_knee_rigidity',
					'S_label'=>'Rigidez',
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_rigidity'):[]])
				</div>
			</div>
		</div>
	</div>
    <div class="row">
            <div class="col-xl-4">
                @include('clinical_histories.valoration_row_options_nordic',
                ['name'=>'valoration_laboral_knee_bloqueo',
                'S_label'=>'Bloqueo',
                'radio_options'=>['Sí','No'],
                'S_order'=>(++$count),
                'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_bloqueo'):[]])
            </div>
            <div class="col-xl-4">
                @include('clinical_histories.valoration_row_options_nordic',
                ['name'=>'valoration_laboral_knee_inestability',
                'S_label'=>'Sensación de inestabiilidad rodila',
                'radio_options'=>['Sí','No'],
                'S_order'=>(++$count),
                'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_inestability'):[]])
            </div>
            <div class="col-xl-4">
                @include('clinical_histories.valoration_row_options_nordic',
                ['name'=>'valoration_laboral_knee_movement_limitation',
                'S_label'=>'Limitación de movimientos',
                'radio_options'=>['Sí','No'],
                'S_order'=>(++$count),
                'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_inestability'):[]])
            </div>
            <div class="col-xl-4">
                @include('clinical_histories.valoration_row_options_nordic',
                ['name'=>'valoration_laboral_knee_cajon',
                'S_label'=>'Cajon anterior',
                'radio_options'=>['Sí','No'],
                'S_order'=>(++$count),
                'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_cajon'):[]])
            </div>
            <div class="col-xl-4">
                @include('clinical_histories.valoration_row_options_nordic',
                ['name'=>'valoration_laboral_knee_lachman',
                'S_label'=>'Lachman',
                'radio_options'=>['Sí','No'],
                'S_order'=>(++$count),
                'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_lachman'):[]])
            </div>
            <div class="col-xl-4">
                @include('clinical_histories.valoration_row_options_nordic',
                ['name'=>'valoration_laboral_knee_mcmurray',
                'S_label'=>'McMurray',
                'radio_options'=>['Sí','No'],
                'S_order'=>(++$count),
                'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_mcmurray'):[]])
            </div>
            <div class="col-xl-4">
                @include('clinical_histories.valoration_row_options_nordic',
                ['name'=>'valoration_laboral_knee_appley',
                'S_label'=>'Appley',
                'radio_options'=>['Sí','No'],
                'S_order'=>(++$count),
                'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_appley'):[]])
            </div>
                <div class="col-xl-4">
                    @include('clinical_histories.valoration_row_options_nordic',
                    ['name'=>'valoration_laboral_knee_bloqueo_pain',
                    'S_label'=>'Dolor',
                    'radio_options'=>['Sí','No'],
                    'S_order'=>(++$count),
                    'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_bloqueo_pain'):[]])
                </div>
                <div class="col-xl-4">
                    @include('clinical_histories.valoration_row_options_nordic',
                    ['name'=>'valoration_laboral_knee_bloqueo_pain_limitation',
                    'S_label'=>'Dolor + limitación',
                    'radio_options'=>['Sí','No'],
                    'S_order'=>(++$count),
                    'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_bloqueo_pain_limitation'):[]])
                </div>
                <div class="col-xl-4">
                    @include('clinical_histories.valoration_row_options_nordic',
                    ['name'=>'valoration_laboral_knee_bloqueo_edema_hipotrofy',
                    'S_label'=>'Edema/hipotrofia',
                    'radio_options'=>['Sí','No'],
                    'S_order'=>(++$count),
                    'default'=>($valorations)?$valorations->where('section','valoration_laboral_knee_bloqueo_edema_hipotrofy'):[]])
                </div>
        </div>
		<hr>
		<div class="row">
			<div class="col-xl-12">
				<h3>Valoración manual muscular</h3>
			</div>
			<div class="col-xl-12">

				@include('clinical_histories.valoration_row',[
				'name'=>'valoration_laboral_knee_muscular_manual',
				'S_label'=>'Valoración muscular',
				'label_show' => true,
				'S_order'=>(++$count),
				'default'=>(!empty($valorations)?$valorations:null),])
			</div>
			<div class="col-xl-12">
				<h3>Contracturas</h3>
			</div>
			<div class="col-xl-12">
				<h3>Pierna</h3>
			</div>
			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_quadriceps',
							'S_label'=>'Cuadriceps',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_quadriceps'):
							[]
							])
			</div>
			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_bit',
							'S_label'=>'BIT',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_bit'):
							[]
							])
			</div>
			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_aductors',
							'S_label'=>'Aductores',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_aductors'):
							[]
							])
			</div>
			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_isquitibials',
							'S_label'=>'Isquiotibiales',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_isquitibials'):
							[]
							])
			</div>
			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_goose',
							'S_label'=>'Pata de ganso',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_goose'):
							[]
							])
			</div>
			<div class="col-xl-12">
				<h3>Pie</h3>
			</div>
			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_gemelus',
							'S_label'=>'Gemelos',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_gemelus'):
							[]
							])
			</div>

			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_anterior_tibial',
							'S_label'=>'Tibial anterior',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_anterior_tibial'):
							[]
							])
			</div>

			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_soleus',
							'S_label'=>'Soleo',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_soleus'):
							[]
							])
			</div>

			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_plantar_fascia',
							'S_label'=>'Fascia Plantar',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_plantar_fascia'):
							[]
							])
			</div>

			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_posterior_tibial',
							'S_label'=>'Tibial posterior',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_posterior_tibial'):
							[]
							])
			</div>

			<div class="col-xl-3">
				@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_knee_peroneus',
							'S_label'=>'Peroneos',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_peroneus'):
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
				'name'=>'valoration_laboral_knee_contusions',
				'S_label'=>'Golpes, contusiones con objetos, superficies u otras personas',
				'S_order'=>(++$count),
				'default'=>(!empty($valorations)?$valorations:null),])
			</div>
			<div class="col-xl-6">
				@include('clinical_histories.valoration_row',[
				'name'=>'valoration_laboral_knee_postures',
				'S_label'=>'valoration_laboral_knee_postures',
				'S_order'=>(++$count),
				'default'=>(!empty($valorations)?$valorations:null),])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row',			[
							'name'=>'valoration_laboral_knee_laboral_higiene',
							'S_label'=>'Medidas de higiene laboral',
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_laboral_higiene'):
							[]
							])
			</div>
			<div class="col-xl-12">
				@include('clinical_histories.valoration_row',			[
							'name'=>'valoration_laboral_knee_treatment_protocol',
							'S_label'=>'Protocolo de tratamiento',
							'S_order'=>(++$count),
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_knee_treatment_protocol'):
							[]
							])
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col-lg-12">
				{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
			</div>
		</div>
    </div>
</div>
{{Form::close()}}
@endsection
