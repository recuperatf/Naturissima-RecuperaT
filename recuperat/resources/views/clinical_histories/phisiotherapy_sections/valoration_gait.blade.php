<div class="row">
	<div class="col-xl-12">
		<h4><strong>Marcha</strong></h4>
	</div>
</div>
@php
	$count=0;
@endphp
<div class="row">
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_gait','S_label'=>'Libre','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_gait','S_label'=>'Claudicante','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_gait','S_label'=>'Con ayuda','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_gait','S_label'=>'Espástica','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-2">
		@include('clinical_histories.valoration_row',['name'=>'valoration_gait','S_label'=>'Atáxica','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
