	<div class="row">
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'Dolor en región medial del codo',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'Aumento del dolor a la presión',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'Epicondilitis Crónica',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow'):
							[]
							])
				</div>
			</div>
		</div>
		<div class="col-xl-4">
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'Cozen',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line'):
							[]
							])
				</div>
                {{--Inicia: falta csv--}}
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_cozen_inv',
							'S_label'=>'Cozen Invertida',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_cozen_inv'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_tinel',
							'S_label'=>'Tinel',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_tinel'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_popeye',
							'S_label'=>'Codo Popeye',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_popeye'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_pain',
							'S_label'=>'Dolor',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_pain'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_limitation',
							'S_label'=>'Limitación',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_limitation'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_mild',
							'S_label'=>'Leve',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_mild'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_moderated',
							'S_label'=>'Moderado',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_moderated'):
							[]
							])
				</div>
                <div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line_severe',
							'S_label'=>'Severo',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line_severe'):
							[]
							])
				</div>
                {{--Termina: falta csv--}}
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'Milis',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'Silla',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line'):
							[]
							])
				</div>
		</div>
		<div class="col-xl-4">
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'I/Elongación',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'II/Acción',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line'):
							[]
							])
				</div>
				<div class="col-xl-12">
					@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
							'name'=>'valoration_laboral_elbow_second_line',
							'S_label'=>'III/Reposo',
							'radio_options'=>['Sí','No'],
							'S_order'=>(++$count),
							'label_width'=>"100%",
							'default'=>($valorations)?
							$valorations->where('section','valoration_laboral_elbow_second_line'):
							[]
							])
				</div>
		</div>
	</div>
