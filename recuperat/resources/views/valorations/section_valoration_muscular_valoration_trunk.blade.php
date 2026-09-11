<div class="row">
	<div class="col-xl-12">
		<h4><strong>Tronco</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'section_valoration_muscular_valoration_trunk',
			'S_label'=>'Columna lumbar y torácica Extensión',
			'label_show'=>true,
			'S_info'=>'En de cubito prono y los brazos pegados al cuerpo. Levantarse sacando el tronco de la mesa. Sostener la pelvis y la columna torácica',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'section_valoration_muscular_valoration_trunk',
			'S_label'=>'Levantar la pelvis para llevarla a la costilla en cubito supino.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_trunk',
		'S_label'=>'Recto del abdomen T 7-12. Flexión','label_show'=>true,
		'S_info'=>'Hacer ligero abdominal coloca las manos en la cabeza sostener las piernas de la rodilla y tobillo.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_trunk',
		'S_label'=>'Oblicuo externo e interno abdominal Rotación','label_show'=>true,
		'S_info'=>'Hacer ligero abdominal y con las manos tratar de alcanzar las rodillas girando la columna dorsal. sostener las piernas de la rodilla y tobillo',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
	@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
		'name'=>'section_valoration_muscular_valoration_trunk',
		'S_label'=>'Diafragma e intercostales','label_show'=>true,
		'S_info'=>'Inspiración de 5-6 cm a nivel de apéndice y xifoides. Espiración forzada con tos.',
		'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>













