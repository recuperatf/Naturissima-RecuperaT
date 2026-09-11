<div class="row">
		<div class="col-xl-12">
			<strong>Contractura Cervical</strong>
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_cervical',
					'S_label'=>'Cervical ECM',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_cervical'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_escapulares',
					'S_label'=>'Cervical Escapulares',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_escapulares'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_infraespinosous',
					'S_label'=>'Cervical Interespinosos',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_infraespinosous'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_semiespinosous',
					'S_label'=>'Cervical Semiespinosos',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_semiespinosous'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_cervical_neck',
					'S_label'=>'Cervical Transverso del cuello',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_cervical_neck'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_esplinious',
					'S_label'=>'Cervical Esplenio',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_esplinious'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_trapecy',
					'S_label'=>'Cervical Trapecio',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_trapecy'):
					[]
					])
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12">
			<strong>Contractura Dorsal</strong>
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_dorsal_trapecy',
					'S_label'=>'Dorsal Trapecio',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_dorsal_trapecy'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_elevator_escapula',
					'S_label'=>'Dorsal elevador de la escapula',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_elevator_escapula'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_dorsal_romboid',
					'S_label'=>'Dorsal Romboidea',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_dorsal_romboid'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_spine_dorsal',
					'S_label'=>'Dorsal Espinales dorsales',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_spine_dorsal'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_serratus',
					'S_label'=>'Dorsal Serratos',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_serratus'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_redondo_mayor',
					'S_label'=>'Dorsal Redondo mayor',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_redondo_mayor'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_cervical_column_contracture_dorsal_insfraespinosous',
					'S_label'=>'Dorsal Infraespinoso',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_cervical_column_contracture_dorsal_insfraespinosous'):
					[]
					])
		</div>
	</div>