<div class="row">
	<div class="col-xl-12">
		<h4><strong>Neurodinamia</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-12">
		@include('clinical_histories.valoration_row',['name'=>'valoration_neurodinamy','show_label'=>true, 'S_label'=>'Tensión Neurovascular','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
