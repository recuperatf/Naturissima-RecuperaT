<div class="row">
	<div class="col-xl-12">
		<h4><strong>Espasticidad</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-1">
		@include('clinical_histories.valoration_row',['name'=>'valoration_spasticity','S_label'=>'Espasticidad','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
<div class="col-xl-11">
	<img src="/images/spasticity.png">
</div>
</div>
