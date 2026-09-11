<div class="row">
	<div class="col-xl-12">
		<h4><strong>Escápula</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_scapula',
			'S_label'=>'Serrato mayor Abducción y rotación',
			'label_show'=>true,
			'S_info'=>'Mala: el paciente sentado; dobla el brazo en ángulo recto y lo apoya en la mesa.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'section_valoration_muscular_valoration_scapula',
			'S_label'=>'Trapecio (fibras superiores).angular del omóplato Elevación','label_show'=>true,
			'S_info'=>'Con el paciente en posición prona y la frente apoyada sobre la mesa, el terapeuta sostiene los hombros.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_scapula',
		'S_label'=>'Trapecio (fibras medias) Aducción','label_show'=>true,
		'S_info'=>'El paciente se sienta y apoya el brazo sobre la mesa, en posición intermedia entre la flexión y la abducción. Realiza abducción horizontal del brazo.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_scapula',
		'S_label'=>'Trapecio (fibras inferiores) depresión','label_show'=>true,
		'S_info'=>'En decúbito prono, el paciente apoya la frente sobre la mesa y extiende el brazo hacia arriba de la cabeza.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
