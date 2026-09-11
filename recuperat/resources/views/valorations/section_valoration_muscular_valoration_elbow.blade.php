<div class="row">
	<div class="col-xl-12">
		<h4><strong>Codo</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_elbow',
			'S_label'=>'Bíceps braquial Braquial anterior flexión',
			'label_show'=>true,
			'S_info'=>'Posición sentada con el brazo pegado al cuerpo y el antebrazo en supinación. Flexiona el codo.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'section_valoration_muscular_valoration_elbow',
			'S_label'=>'Tríceps braquial. extensión','label_show'=>true,
			'S_info'=>'Paciente en decúbito supina con el hombro flexionado  en ángulo recto y el codo ligeramente flexionado. El paciente extiende el codo.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>










