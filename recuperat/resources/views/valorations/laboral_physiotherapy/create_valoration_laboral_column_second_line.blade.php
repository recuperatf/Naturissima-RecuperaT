	<div class="row">
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_column',
							'S_label'=>'Axial',
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
							'S_label'=>'Aumento de tono muscular',
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
							'S_label'=>'Rigidez/limitación de movimientos',
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
							'S_label'=>'Puntos gatillo',
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
							'S_label'=>'ROMS Incompletos',
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
							'S_label'=>'Deformidad',
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
							'S_label'=>'Dolor',
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
							'S_label'=>'Dolor + limitación',
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
							'name'=>'valoration_laboral_column_second_line',
							'S_label'=>'',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_second_line'):
							[]
							])
				</div>
			</div>
		</div>
	</div>