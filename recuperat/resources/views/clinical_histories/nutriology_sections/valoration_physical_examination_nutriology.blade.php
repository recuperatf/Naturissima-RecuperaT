<div class="row">
	<div class="col-xl-12">
		<h4><strong>EXAMEN FÍSICO</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Cabello',
		'S_info'=>'Signos normales: No se desprende fácilmente y es de color uniforme',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Cara',
		'S_info'=>'Signos normales: Forma y color uniforme',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Ojos',
		'S_info'=>'Signos normales: Brillosos, claros, rosados y lubricados',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>	
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Labios',
		'S_info'=>'Signos normales: Rosas, suaves e hidratados.',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Lengua',
		'S_info'=>'Signos normales: Rosa, suave, hidratada y tamaño normal.',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Encías y dientes',
		'S_info'=>'Signos normales: Encías suaves, rosas y dientes completos (32)',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Piel',
		'S_info'=>'Signos normales: Suave, sin ronchas o resequedad.',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Uñas',
		'S_info'=>'Signos normales: Firmes de color adecuado.',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Sistema musculo esquelético',
		'S_info'=>'Signos normales: Tonicidad buena  con algo de grasa, movimientos normales.',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Neurológico',
		'S_info'=>'Signos normales: Psicológicamente estable y reflejos normales.',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row_nutrition_physical_examination',[
		'name'=>'valoration_physical_examination_nutriology',
		'S_label'=>'Abdomen',
		'S_info'=>'Simétrico.',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
</div>
