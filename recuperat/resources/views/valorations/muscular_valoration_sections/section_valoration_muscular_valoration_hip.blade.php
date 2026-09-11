<div class="row">
	<div class="col-xl-12">
		<h4><strong>CADERA</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'valorations_muscular_valoration_hip','S_label'=>'Flexión (Psoas iliaco)','label_show'=>true,'S_info'=>'Sentado levantar pierna (resistencia sobre la rodilla)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_hip',
			'S_label'=>'Rotación Externa (Sartorio)','label_show'=>true,
			'S_info'=>'Decúbito supino (talón hacia la otra rodilla) resistencia en rodilla ext y tobillo int',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_hip',
			'S_label'=>'Extensión (Glúteo mayor)','label_show'=>true,
			'S_info'=>'Decúbito prono elevar la pierna sin doblar la rodilla (resistencia en el tobillo).
			<br/>
			Para aislar el glúteo mayor misma posición pedir que doble la rodilla y que eleve el recto anterior disminuye la amplitud.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_hip',
			'S_label'=>'Abducción (Gluteo mayor)','label_show'=>true,
			'S_info'=>'Decúbito lateral levante la pierna y decúbito supino lleve la pierna hacia fuera',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_hip',
			'S_label'=>'Adducción (Aproximador mayor, mediano y menor)','label_show'=>true,
			'S_info'=>'Decúbito lateral realizar aducción',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_hip',
			'S_label'=>'Rotación Interna (Gluteo mayor, tensor de la fascia lata)','label_show'=>true,
			'S_info'=>'Sentado realizar movimiento de rotación interna',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_hip',
			'S_label'=>'Rotación Externa (Obturador, gemino, cuadrado crural, piramidal)','label_show'=>true,
			'S_info'=>'Sentado realizar movimiento de rotación externa',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
