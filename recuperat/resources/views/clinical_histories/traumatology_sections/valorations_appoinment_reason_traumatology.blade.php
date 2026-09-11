<div class="row">
	<div class="col-xl-12">
		<h4><strong>MOTIVO DE CONSULTA</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-12">
		@include('clinical_histories.valoration_row',['name'=>'valorations_appoinment_reason_traumatology','S_label'=>'Motivo de Consulta','label_show'=>false,'S_order'=>(++$count),'default'=>(($valorations)?$valorations:null),])
	</div>
</div>
