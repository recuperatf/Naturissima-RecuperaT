	<div class="row">
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Dolor con distribución nerviosa',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Adormecimiento/Debilidad/hormigueos',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Disminución de la fuerza',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
			</div>
		</div>

		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Spuring',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Distracción',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Hipoestesias',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Debilidad',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
			</div>
		</div>

		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Neuropatía sensitiva',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Neuropatiá motora y sensitiva sin atrofia',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Atrofia',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column'):
							[]
							])
				</div>
			</div>
		</div>
	</div>