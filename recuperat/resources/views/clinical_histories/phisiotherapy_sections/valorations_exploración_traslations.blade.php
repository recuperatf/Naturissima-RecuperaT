<div class="row">
	<div class="col-xl-12">
		<h4><strong>Traslado</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_initial','S_label'=>'Val.Inicial','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_initial','S_label'=>'Independiente','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_initial','S_label'=>'Silla de Ruedas','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_initial','S_label'=>'Con Ayudas','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_initial','S_label'=>'Camilla','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_final','S_label'=>'Val.Final','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_final','S_label'=>'Independiente','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_final','S_label'=>'Silla de Ruedas','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_final','S_label'=>'Con Ayudas','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_traslation_final','S_label'=>'Camilla','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
