<div class="row">
			<div class="col-xl-12">
				<h4><strong>Antecedentes no patológicos</strong></h4>
			</div>
		</div>
		<div class="row">
					<div class="col-xl-3">
						@php
							$count=0;
						@endphp
					@include('clinical_histories.antecedents',['name'=>'antecedents_no_patological','S_label'=>'Radica en','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_no_patological','S_label'=>'Toma medicamento (cuales)','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['ID_cie10'=>2145,'name'=>'antecedents_no_patological','S_label'=>'Fuma (S/N, tiempo)','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_no_patological','S_label'=>'Alimentación','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_no_patological','S_label'=>'Hijos','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_no_patological','S_label'=>'Deporte','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textType'=>'textarea','textClass'=>['class'=>'form-control','rows'=>'2']])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_no_patological','S_label'=>'Pasatiempo','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_no_patological','S_label'=>'Dominio (diestro/zurdo)','S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

		</div>
