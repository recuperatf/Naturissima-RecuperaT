<div class="row">
	<div class="col-xl-12">
		<h4><strong>DOLOR</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-1">
		@include('clinical_histories.valoration_row',['name'=>'valoration_pain','S_label'=>'EVA','S_order'=>(++$count),'default'=>(($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-11">
		<img src="/images/EVA.png">
	</div>
</div>