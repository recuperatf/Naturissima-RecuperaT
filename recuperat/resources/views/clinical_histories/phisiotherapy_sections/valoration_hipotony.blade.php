<div class="row">
	<div class="col-xl-12">
		<h4><strong>Hipotonía</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-3">
		@include('clinical_histories.valoration_row',['name'=>'valoration_hipotony','S_label'=>'Escala de Hipotonía (Campbell)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
<div class="col-xl-8">
	<img src="/images/campbell_hipotony.png">
</div>
</div>
