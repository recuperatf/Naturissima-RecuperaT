	<div class="row">
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_third_warkness15',
							'S_label'=>'Debilidad de 15-30°',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_third_warkness15'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_third_nocturne_pain',
							'S_label'=>'Dolor nocturno',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_third_nocturne_pain'):
							[]
							])
				</div>
			</div>
		</div>

		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_third_jobe',
							'S_label'=>'Jobe',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_third_jobe'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_fallen_arm',
							'S_label'=>'Brazo caído',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_fallen_arm'):
							[]
							])
				</div>
			</div>
		</div>

		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_tendinosis',
							'S_label'=>'Tendinosis',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_tendinosis'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_partial_break',
							'S_label'=>'Rotura parcial',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_partial_break'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_shoulder_total_break',
							'S_label'=>'Rotura total',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_shoulder_total_break'):
							[]
							])
				</div>
			</div>
		</div>
	</div>