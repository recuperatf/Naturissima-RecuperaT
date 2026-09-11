<div class="row">
	<div class="col-xl-12">
		<h4><strong>Antebrazo</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_forearm',
			'S_label'=>'Bíceps braquial Supinador corto.',
			'label_show'=>true,
			'S_info'=>'Paciente sentado con el brazo al costado, codo flexionado y pronación de antebrazo. Realiza supinación del antebrazo',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_forearm',
			'S_label'=>'Bíceps braquial Supinador corto.',
			'label_show'=>true,
			'S_info'=>'Paciente sentado con el brazo al costado, codo flexionado y pronación de antebrazo. Realiza supinación del antebrazo',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
