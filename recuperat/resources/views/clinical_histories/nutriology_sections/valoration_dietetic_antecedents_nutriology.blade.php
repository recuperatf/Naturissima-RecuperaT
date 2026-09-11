<div class="row">
	<div class="col-xl-12">
		<h4><strong>ANTECEDENTES DIETÉTICOS</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Tiempos de comida por día',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Duración de las comidas',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Come viendo TV o haciendo otras actividades',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Intolerancia a alimentos',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Preferencia por tomar en lugar de comer',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Alimentación restrictiva',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Voluntad para probar nuevos alimentos ',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Come fuera de casa',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Experiencia dietética',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Agua al día',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Alcohol',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Café',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Como considera su alimentación',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Realiza alguna Actividad Física ',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',[
		'name'=>'valoration_dietetic_antecedents_nutriology',
		'S_label'=>'Tiempo viendo TV o Computadora ',
		'S_order'=>(++$count),
		'default'=>(($valorations)?$valorations:null),])
	</div>
</div>
