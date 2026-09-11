<div class="row">
	<div class="col-xl-12">
		<h4><strong>Evaluación Neurológica</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_neurology','S_label'=>'Reflejos','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_neurology','S_label'=>'Sensibilidad','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_neurology','S_label'=>'Lenguaje','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_neurology','S_label'=>'Orientación','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
