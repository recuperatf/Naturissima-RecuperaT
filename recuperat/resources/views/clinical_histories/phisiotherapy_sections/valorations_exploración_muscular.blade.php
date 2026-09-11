<div class="row">
	<div class="col-xl-12">
		<h4><strong>Contracturas Musculares</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-12">
		@include('clinical_histories.valoration_row',['name'=>'valoration_muscular_contracture','S_label'=>'Sitio','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
