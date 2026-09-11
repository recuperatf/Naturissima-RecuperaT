<div class="row">
		<div class="col-xl-12">
			<strong>Contractura</strong>
		</div>
		<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_shoulder',
					'S_label'=>'Hombro',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_shoulder'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_deltoid',
					'S_label'=>'Deltoides',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_deltoid'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_trapecy',
					'S_label'=>'Trapecio',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_trapecy'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_manguito_rotador',
					'S_label'=>'Manguito Rotador',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_manguito_rotador'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_dorsal',
					'S_label'=>'Dorsal Ancho',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_dorsal'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_pectoral',
					'S_label'=>'Pectoral Mayor',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_pectoral'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_arm',
					'S_label'=>'Brazo',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_arm'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_biceps',
					'S_label'=>'Biceps',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_biceps'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_triceps',
					'S_label'=>'Triceps',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_triceps'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_long_supinator',
					'S_label'=>'Supinador largo',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_long_supinator'):
					[]
					])
		</div>
				<div class="col-xl-3">
			@include('clinical_histories.valoration_row_options_nordic',			[
					'name'=>'valoration_laboral_shoulder_contracture_braquial',
					'S_label'=>'Braquial',
					'show_label'=>true,
					'radio_options'=>['Sí','No'],
					'S_order'=>(++$count),
					'label_width'=>"100%",
					'default'=>($valorations)?
					$valorations->where('section','valoration_laboral_shoulder_contracture_braquial'):
					[]
					])
		</div>
	</div>