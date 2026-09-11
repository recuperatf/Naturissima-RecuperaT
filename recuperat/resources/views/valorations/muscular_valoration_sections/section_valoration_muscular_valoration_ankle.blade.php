<div class="row">
	<div class="col-xl-12">
		<h4><strong>Tobillo</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',['name'=>'valorations_muscular_valoration_ankle',
			'S_label'=>'Flexión (gemelos y sóleo)',
			'label_show'=>true,
			'S_info'=>'Eleve el y el talón si le pedimos que flexione ligeramente la rodilla anulamos el 70% de los gemelos y solo vamos a evaluar el soleo 10 repeticiones.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_ankle',
			'S_label'=>'Dorsiflexión (Tibial anterior)','label_show'=>true,
			'S_info'=>'Sentado mueva el pie arriba y adentro.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
		<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_ankle',
			'S_label'=>'Inversión (Tibial posterior)','label_show'=>true,
			'S_info'=>'Sentado con flexión plantar mueva el pie bajo y adentro.',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
		<div class="col-xl-6">
		@include('valorations.muscular_valoration_sections.muscular_valoration_daniels_row',[
			'name'=>'valorations_muscular_valoration_ankle',
			'S_label'=>'Eversión (Peroneo lateral corto y largo)','label_show'=>true,
			'S_info'=>'Sentado el pie abajo y afuera',
			'S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
