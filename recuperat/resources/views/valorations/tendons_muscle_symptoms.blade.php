<div class="row">
	<div class="col-xl-12">
		<h4><strong>Cuestionario Nórdico de síntomas músculo-tendinosos</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
		$valorations=!isset($valorations)?$valorations:false;
		$body_parts=[
			'Cuello'=>['Sí, No']
		]
	@endphp
	Has tenido molestias en:
	<div class="col-xl-6">
		@foreach($body_parts as $body_part=>$options)
			@include('clinical_histories.valoration_row_options_nordic',[
			'name'=>'valoration_tendons_and_muscle_nordic_'.strtolower($body_part),
			'S_label'=>'Cuello',
			'radio_options'=>$options,
			'S_order'=>(++$count),
			'default'=>($valorations)?
			$valorations->where('section','valoration_tendons_and_muscle_nordic_'.strtolower($body_part)):
			[]
			])
		@endforeach
		{{Form::radio($S_name."[$S_order][json_values]",$key,true)}}
	</div>
	<div class="col-xl-6">

	</div>
</div>










