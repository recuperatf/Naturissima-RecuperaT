<div class="row">
	<div class="col-xl-12">
		<h4><strong>ANTECEDENTES HEREDO-FAMILIARES</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-12">
		@include('clinical_histories.valoration_row',['name'=>'antecedents_familial_nutriology','label_show'=>false,'S_label'=>'antecedentes heredo-familiares nutriologia','S_order'=>(++$count),'default'=>(($valorations)?$valorations:null),'antecedent_type_id'=>3,])
	</div>
</div>
