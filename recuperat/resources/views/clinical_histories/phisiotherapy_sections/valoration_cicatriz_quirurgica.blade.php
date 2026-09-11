<div class="row">
	<div class="col-xl-12">
		<h4><strong>Cicatriz Qurúrgica</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_cicatriz_quirurgica','S_label'=>'Sitio','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_cicatriz_quirurgica','S_label'=>'Queloide','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_cicatriz_quirurgica','S_label'=>'Retractil','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_cicatriz_quirurgica','S_label'=>'Abierta','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_cicatriz_quirurgica','S_label'=>'Con adherencias','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_cicatriz_quirurgica','S_label'=>'Hipertrófica','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
