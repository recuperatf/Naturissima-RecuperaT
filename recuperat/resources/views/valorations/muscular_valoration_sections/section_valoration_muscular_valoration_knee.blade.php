<div class="row">
	<div class="col-xl-12">
		<h4><strong>Rodilla</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'valorations_muscular_valoration_knee','S_label'=>'Flexión (Briceps crural, semitendinoso y semi membranoso)','label_show'=>true,'S_info'=>'Decúbito prono con rodilla a 90 o menor generar flexión.','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_knee',
			'S_label'=>'Extensión (Recto anterior, crural, vastos)','label_show'=>true,
			'S_info'=>'Sentado estire la rodilla.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
