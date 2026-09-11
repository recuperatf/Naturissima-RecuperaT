<div class="row">
	<div class="col-xl-12">
		<h4><strong>Fuerza Muscular</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-1">
		@include('clinical_histories.valoration_row',['name'=>'valoration_muscular_strength','S_label'=>'Fuerza Muscular','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-11">
		<img src="/images/muscular_strength.png">
	</div>
</div>
