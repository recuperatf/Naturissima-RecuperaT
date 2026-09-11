<style>
	.stronger {
		font-weight: bolder;
	}
</style>
<div class="row">
	<div class="col-xl-12">
		<h4><strong class="stronger">Cuestionario Nórdico de síntomas músculo-tendinosos</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
		$valorations=!empty($valorations)?$valorations:false;
		$body_parts=[
			'Cuello'=>['type'=>'checkbox','Izq','Der','No'],
			'Hombro'=>['type'=>'checkbox','Izq','Der','No'],
			'Espalda (zona dorsal)'=>['type'=>'checkbox','Izq','Der','No'],
			'Espalda (zona lumbar)'=>['type'=>'checkbox','Izq','Der','No'],
			'Brazo'=>['type'=>'checkbox','Izq','Der','No'],
			'Codo'=>['type'=>'checkbox','Izq','Der','No'],
			'Antebrazo'=>['type'=>'checkbox','Izq','Der','No'],
			'Mano/muñeca'=>['type'=>'checkbox','Izq','Der','No'],
			'Pierna'=>['type'=>'checkbox','Izq','Der','No'],
			'Rodilla'=>['type'=>'checkbox','Izq','Der','No'],
			'Pantorrilla'=>['type'=>'checkbox','Izq','Der','No'],
			'Pie'=>['type'=>'checkbox','Izq','Der','No'],
		];
		$body_parts_1_to_5=[
			'Cuello'=>['type'=>'radio','1','2','3','4','5'],
			'Hombro'=>['type'=>'radio','1','2','3','4','5'],
			'Espalda (zona dorsal)'=>['type'=>'radio','1','2','3','4','5'],
			'Espalda (zona lumbar)'=>['type'=>'radio','1','2','3','4','5'],
			'Brazo'=>['type'=>'radio','1','2','3','4','5'],
			'Codo'=>['type'=>'radio','1','2','3','4','5'],
			'Antebrazo'=>['type'=>'radio','1','2','3','4','5'],
			'Mano/muñeca'=>['type'=>'radio','1','2','3','4','5'],
			'Pierna'=>['type'=>'radio','1','2','3','4','5'],
			'Rodilla'=>['type'=>'radio','1','2','3','4','5'],
			'Pantorrilla'=>['type'=>'radio','1','2','3','4','5'],
			'Pie'=>['type'=>'radio','1','2','3','4','5'],
		];
		$body_parts_yes_or_no=[
			'Cuello'=>['type'=>'radio','Sí','No'],
			'Hombro'=>['type'=>'radio','Sí','No'],
			'Espalda (zona dorsal)'=>['type'=>'radio','Sí','No'],
			'Espalda (zona lumbar)'=>['type'=>'radio','Sí','No'],
			'Brazo'=>['type'=>'radio','Sí','No'],
			'Codo'=>['type'=>'radio','Sí','No'],
			'Antebrazo'=>['type'=>'radio','Sí','No'],
			'Mano/muñeca'=>['type'=>'radio','Sí','No'],
			'Pierna'=>['type'=>'radio','Sí','No'],
			'Rodilla'=>['type'=>'radio','Sí','No'],
			'Pantorrilla'=>['type'=>'radio','Sí','No'],
			'Pie'=>['type'=>'radio','Sí','No'],
			
		];
		$body_parts_for_12_months=[
			'Cuello'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Hombro'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Espalda (zona dorsal)'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Espalda (zona lumbar)'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Brazo'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Codo'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Antebrazo'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Mano/muñeca'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Pierna'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Rodilla'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Pantorrilla'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
			'Pie'=>['type'=>'radio','1 a 7 días','8 a 30 días','>30 días no seguidos','Siempre'],
		];
		$body_parts_pain_episode_duration=[
			'Cuello'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Hombro'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Espalda (zona dorsal)'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Espalda (zona lumbar)'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Brazo'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Codo'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Antebrazo'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Mano/muñeca'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Pierna'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Rodilla'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Pantorrilla'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
			'Pie'=>['type'=>'radio','<1hr','1-24hrs','1-7 días','1-4 semanas','Más de un mes'],
		];
		$body_parts_incapacitation_from_work_duration=[
			'Cuello'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Hombro'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Espalda (zona dorsal)'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Espalda (zona lumbar)'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Brazo'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Codo'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Antebrazo'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Mano/muñeca'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Pierna'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Rodilla'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Pantorrilla'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
			'Pie'=>['type'=>'radio','Nunca','1-7 días','1 a 4 semanas','Más de un mes'],
		];
	@endphp
	<div class="col-xl-12 mb-3">
		<strong class="stronger">1.-¿Has tenido molestias en?</strong>
	</div>
	@foreach($body_parts as $body_part=>$options)
		{{-- @dd($valorations->where('section','valoration_tendons_and_muscle_nordic_'.strtolower($body_part)))	 --}}
		<div class="col-xl-4">
				@include('clinical_histories.valoration_row_options_nordic',[
				'name'=>'valoration_tendons_and_muscle_nordic_'.strtolower($body_part),
				'S_label'=>$body_part,
				'radio_options'=>$options,
				'S_order'=>(++$count),
				'checkbox'=>$options['type']=='checkbox'?true:null,
				'default'=>($valorations)?
				$valorations->where('section','valoration_tendons_and_muscle_nordic_'.strtolower($body_part)):
				[]
				])
		</div>
	@endforeach
	<div class="col-xl-12">
		<strong class="stronger">Si la respuesta es no, no es necesario continuar con el cuestionario.</strong>
	</div>
	<div class="col-xl-12 mt-5 mb-3">
		<strong class="stronger">2. ¿Cuánto tiempo tiene con las molestias? (Duración)</strong>
	</div>
	@foreach($body_parts as $body_part=>$options)
		<div class="col-xl-4">
			@include('valorations.muscular_valoration_sections.muscular_valoration_row',[
				'name'=>'valoration_tendons_and_muscle_nordic_how_long_'.$body_part,
				'S_label'=>$body_part,
				'label_show'=>true,
				'textarea_rows'=>1,
				'S_order'=>(++$count),'default'=>(($valorations)?$valorations:null),])
		</div>
	@endforeach
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">3. ¿Ha tenido molestias en el puesto de trabajo?</strong>
		
	</div>
	@foreach($body_parts as $body_part=>$options)
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_change_in_job_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>['Sí','No'],
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_change_in_job_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">4. ¿Ha tenido molestias en los últimos 12 meses?</strong>
		
	</div>
	@foreach($body_parts as $body_part=>$options)
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_complained_lately_about_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>['Sí','No'],
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_complained_lately_about_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach
	<p class="mt-3">
		Si la respuesta a la pregunta 4 es NO, no es necesario continuar con el cuestionario.
	</p>
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">
			5.- ¿Cuánto tiempo ha tenido las molestias en los últimos 12 meses?
		</strong>
	</div>
	@foreach($body_parts_for_12_months as $body_part=>$options)
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_complained_last_12_months_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>$options,
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_complained_last_12_months_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">6. ¿Cuánto tiempo dura cada episodio con molestias?</strong>
	</div>
	@foreach($body_parts_pain_episode_duration as $body_part=>$options)
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_pain_episode_duration_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>$options,
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_pain_episode_duration_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">
			7. ¿Cuánto tiempo estas molestias le han impedido hacer su trabajo en los últimos 12 meses?
		</strong>
	</div>
	@foreach($body_parts_incapacitation_from_work_duration as $body_part=>$options)
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_incapacitation_from_work_duration_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>$options,
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_incapacitation_from_work_duration_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">
			8. ¿Ha recibido tratamiento médico por estas molestias en los últimos 12 meses?
		</strong>
	</div>
	@foreach($body_parts_yes_or_no as $body_part=>$options)
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_received_treatment_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>$options,
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_received_treatment_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">
			9.- ¿Ha tenido molestias en los últimos 7 días?
		</strong>
	</div>
	@foreach($body_parts_yes_or_no as $body_part=>$options)
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_pain_7_days_prior_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>$options,
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_pain_7_days_prior_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach
	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">
			10.- Califique sus molestias, entre 1 y 5, donde 1 representa molestias mínimas y 5 molestias muy fuertes.
		</strong>
	</div>
	@foreach($body_parts_1_to_5 as $body_part=>$options)
		<div class="col-xl-6">
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_pain_evaluation_1_to_5_'.strtolower($body_part),
			'S_label'=>$body_part,
			'radio_options'=>$options,
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_pain_evaluation_1_to_5_'.strtolower($body_part)):
			[]
			])
		</div>
	@endforeach


	<div class="col-xl-12 mt-5 mb-5">
		<strong class="stronger">
			11.- ¿A qué factores atribuye sus molestias?
		</strong>
	</div>
	@foreach($body_parts_1_to_5 as $body_part=>$options)
		<div class="col-xl-4">
			@include('valorations.muscular_valoration_sections.muscular_valoration_row',['name'=>'valoration_tendons_and_muscle_nordic_pain_attribution_'.$body_part,
				'S_label'=>$body_part,
				'label_show'=>true,
				'textarea_rows'=>1,
				'S_order'=>(++$count),'default'=>(($valorations)?$valorations:null),])
		</div>
	@endforeach

	<div class="col-xl-12 mt-5 mb-5">
		<strong>12.- Zonas de dolor:</strong>
		<p>
			Se puede agregar cualquier comentario que el trabajador considere importante, en relación con sus molestias y/o las actividades que desarrolla. Es válido elaborar diagramas para señalar las regiones que presentan molestias. Señalar la región de dolor.
		</p>
	</div class="mt-2">
			<div class="col-xl-6">
				@include('clinical_histories.valoration_row_options_nordic',
				[
					'name'=>'valoration_tendons_and_muscle_nordic_pain_evaluation_1_to_12_',
					'S_label'=>'Zonas de dolor',
					'radio_options'=>range(1,12),
					'checkbox' => true,
					'S_order'=>(++$count),
					'default'=>($valorations)? $valorations->where('section','valoration_tendons_and_muscle_nordic_pain_evaluation_1_to_12_'): []
				]
			)
			</div>
		<div class="col-xl-6">
			<img src="/images/zonas_dolorosas.png">
		</div>

</div>










