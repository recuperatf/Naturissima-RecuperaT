<div class="row">
	<div class="col-xl-12">
		<h4><strong>Hombro</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_shoulder',
			'S_label'=>'Deltoides (fibras anteriores)',
			'label_show'=>true,
			'S_info'=>'Posición sentada con el brazo colgando y el codo en ligera flexión. Se fija la escapula. El paciente flexiona el brazo hasta 90 grados. palma de la mano hacia abajo .',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'section_valoration_muscular_valoration_shoulder',
			'S_label'=>'Dorsal ancho y redondo mayor. extensión','label_show'=>true,
			'S_info'=>'El paciente se coloca en decúbito abdominal con el brazo al costado y lo extiende fijando la escapula el fisioterapeuta.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_shoulder',
		'S_label'=>'Deltoides (fibras medias) Supraespinoso. abducción','label_show'=>true,
		'S_info'=>'Paciente sentado con el brazo en posición intermedia de rotación y el codo algo flexionado. El paciente separa el brazo del cuerpo con la palma de la mano hacia abajo.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
		<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_shoulder',
		'S_label'=>'Pectoral mayor, Aducción horizontal','label_show'=>true,
		'S_info'=>'Posición supina con el brazo en 90 grados de abducción el paciente eleva el brazo..',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
		<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_shoulder',
		'S_label'=>'Infraespinoso y redondo menor. Rotación externa','label_show'=>true,
		'S_info'=>'Paciente en decúbito abdominal con el brazo colgando y en rotación interna. El paciente realiza rotación externa.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
		<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_shoulder',
		'S_label'=>'Subescapular. Rotación interna','label_show'=>true,
		'S_info'=>'Paciente en decúbito prono con el brazo colgando y  en rotación externa. El paciente realiza rotación interna.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>








