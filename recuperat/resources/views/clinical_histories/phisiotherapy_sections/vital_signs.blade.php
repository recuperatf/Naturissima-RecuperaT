<div class="row">
			<div class="col-xl-12">
				<h4><strong>Signos Vitales</strong></h4>
			</div>
		</div>
		<div class="row">
					<div class="col-xl-4">
						@php
							$count=0;
						@endphp
					@include('clinical_histories.antecedents',['name'=>'vital_signs','S_label'=>'Frecuencia Cardiaca','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control'],'textType'=>'text'])
					</div>

					<div class="col-xl-4">

					@include('clinical_histories.antecedents',['name'=>'vital_signs','S_label'=>'Frecuencia Respiratoria','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control'],'textType'=>'text'])
					</div>

					<div class="col-xl-4">

					@include('clinical_histories.antecedents',['name'=>'vital_signs','S_label'=>'Presión Arterial (Sistólica/Diastólica)','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control'],'textType'=>'text'])
					</div>

					<div class="col-xl-4">

					@include('clinical_histories.antecedents',['name'=>'vital_signs','S_label'=>'Temperatura','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control'],'textType'=>'text'])
					</div>
		</div>
