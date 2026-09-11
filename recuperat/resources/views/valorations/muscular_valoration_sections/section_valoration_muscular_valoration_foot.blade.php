<div class="row">
	<div class="col-xl-12">
		<h4><strong>Pie</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_foot',
			'S_label'=>'Flexión del dedo gordo (flexor corto del dedo, lumbricales)',
			'label_show'=>true,
			'S_info'=>'Sentado doble el dedo gordo del pie.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'section_valoration_muscular_valoration_foot',
			'S_label'=>'Flexión de los dedos (Flexor largo común)','label_show'=>true,
			'S_info'=>'Sentado pedir que flexione los dedos del pie.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_foot',
		'S_label'=>'Extensión de los dedos (Extensor largo común)','label_show'=>true,
		'S_info'=>'Realizar una extensión de los dedos.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
