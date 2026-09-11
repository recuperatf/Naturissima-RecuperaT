<div class="row">
	<div class="col-xl-12">
		<h4><strong>Dedos</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_fingers',
			'S_label'=>'Lumbricales Flexión de metacarpofalángicas',
			'label_show'=>true,
			'S_info'=>'Con el paciente sentado, se sostiene la mano se fijan los metacarpianos y el paciente dobla los dedos en la articulación metacarpofalángica',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'section_valoration_muscular_valoration_fingers',
			'S_label'=>'Flexor común superficial y profundo de los dedos','label_show'=>true,
			'S_info'=>'Paciente sentado con la mano apoyada en el dorso, se inmoviliza la primera falange y el flexiona la segunda falange.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_fingers',
		'S_label'=>'Extensor del índice y meñique','label_show'=>true,
		'S_info'=>'Paciente sentado, se sostiene la mano con los dedos en flexión y la muñeca intermedia. El paciente extiende.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_fingers',
		'S_label'=>'Interóseas dorsales y aductor del meñique.ABD','label_show'=>true,
		'S_info'=>'Posición sentada, se apoya la palma de la mano sobre la mesa con los dedos separados. El paciente mueve el dedo de en medio en ambas direcciones.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>

	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_fingers',
		'S_label'=>'Interóseos palmares Aducción','label_show'=>true,
		'S_info'=>'Posición sentada, se apoya la palma de la mano sobre la mesa con los dedos separados. El paciente los aproxima y se la aplica resistencia en el segundo y cuarto dedo.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_fingers',
		'S_label'=>'Flexor corto y largo del pulgar','label_show'=>true,
		'S_info'=>'Paciente sentado, apoyando la mano en la mesa. Extiende el dedo pulgar, mientras que el fisioterapeuta aplica resistencia al movimiento.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_fingers',
		'S_label'=>'Abductor largo y corto del pulgar','label_show'=>true,
		'S_info'=>'Paciente sentado se inmoviliza los otros dedos. El paciente separa el pulgar mientras se le aplica resistencia en el dorso.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_fingers',
		'S_label'=>'Oponente del pulgar y del meñique','label_show'=>true,
		'S_info'=>'Paciente sentado, con la mano apoyada en el dorso. Junta las yemas de los dedos meñique y pulgar. Mientras se  le aplica resistencia en la zona palmar de los mismo dedos.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>









