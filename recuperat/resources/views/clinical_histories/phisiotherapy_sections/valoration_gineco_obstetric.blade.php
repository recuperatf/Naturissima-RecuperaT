<div class="row">
	<div class="col-xl-12">
		<h4><strong>Gineco-Obstetricos</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_gineco_obstetric','S_label'=>'Semanas de Gestación','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-8">
		@include('clinical_histories.valoration_row',['name'=>'valoration_gineco_obstetric','S_label'=>'Síntomas','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
