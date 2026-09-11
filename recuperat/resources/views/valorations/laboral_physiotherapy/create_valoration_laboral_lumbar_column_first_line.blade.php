	<div class="row">
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_distribution',
							'S_label'=>'Dolor con distribución nerviosa',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_distribution'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_weakness',
							'S_label'=>'Adormecimiento/Debilidad/hormigueos',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_weakness'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_less_strength',
							'S_label'=>'Disminución de la fuerza',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_less_strength'):
							[]
							])
				</div>
                {{--Inicia: No está en csv--}}
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_lasegue',
							'S_label'=>'Lasegue',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_lasegue'):
							[]
							])
				</div>
                {{--Termina: No está en csv--}}
			</div>
		</div>
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_spuring',
							'S_label'=>'Spuring',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_spuring'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_distraction',
							'S_label'=>'Distracción',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_distraction'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_hipoestesia',
							'S_label'=>'Hipoestesias',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_hipoestesia'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_weakness',
							'S_label'=>'Debilidad',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_weakness'):
							[]
							])
				</div>
                {{--Inicia: No está en csv--}}
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_bragard',
							'S_label'=>'Bragard',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_bragard'):
							[]
							])
				</div>
                {{--Termina: No está en csv--}}
			</div>
		</div>

		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_sensitive_neuropathy',
							'S_label'=>'Neuropatía sensitiva',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_sensitive_neuropathy'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_motor_neuropathy',
							'S_label'=>'Neuropatiá motora y sensitiva sin atrofia',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_motor_neuropathy'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_atrophy',
							'S_label'=>'Atrofia',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_atrophy'):
							[]
							])
				</div>
                {{--Inicia: No está en csv--}}
                <div class="col-xl-12">
					@include('clinical_histories.valoration_row_options_nordic',			[
							'name'=>'valoration_laboral_column_lumbar_first_lasegue_inv',
							'S_label'=>'Lasegue Inv.',
							'show_label'=>true,
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_column_lumbar_first_lasegue_inv'):
							[]
							])
				</div>
                {{--Termina: No está en csv--}}
			</div>
		</div>
	</div>
