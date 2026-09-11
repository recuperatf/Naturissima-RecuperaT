<div class="row">
	<div class="col-xl-12">
		<h4><strong>Muñeca</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_wrist',
			'S_label'=>'Palmar mayor Cubital anterior Flexión',
			'label_show'=>true,
			'S_info'=>'Posición sentada con el antebrazo apoyado sobre la mesa, en supinación, se fija en antebrazo, el paciente flexiona la muñeca con desviación radial o cubital',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'section_valoration_muscular_valoration_wrist',
			'S_label'=>'Primer radial externo Segundo radial externo Extensión','label_show'=>true,
			'S_info'=>'Posición sentada con el antebrazo sobre la mesa, en pronación, el paciente extiende el brazo con desviación radial o cubital.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
