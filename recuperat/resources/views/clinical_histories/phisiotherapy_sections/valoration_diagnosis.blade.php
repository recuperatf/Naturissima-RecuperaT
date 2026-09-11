<div class="row">
			<div class="col-xl-12">
				<h4><strong>Diagnóstico</strong></h4>
			</div>
		</div>
		<div class="row">
				@php
					$count=0;
				@endphp
					<div class="col-xl-12">

					@include('clinical_histories.antecedents',['name'=>'valoration_diagnosis','S_label'=>'Diagnóstico','show_label'=>false,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control','rows'=>'3'],'textType'=>'textarea'])
					</div>
					<div class="col-xl-3">
					</div>
					<div class="col-xl-12">
						<h4><strong>Tratamiento</strong></h4>
					</div>
					<div class="col-xl-12">
					@include('clinical_histories.antecedents',['name'=>'valoration_diagnosis','S_label'=>'Objetivos del tratamiento','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control','rows'=>'3'],'textType'=>'textarea'])
					</div>
					<div class="col-xl-12">
					@include('clinical_histories.antecedents',['name'=>'valoration_diagnosis','S_label'=>'Número de sesiones recomendadas','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control','rows'=>'3'],'textType'=>'textarea'])
					</div>
					<div class="col-xl-12">
					@include('clinical_histories.antecedents',['name'=>'valoration_diagnosis','S_label'=>'Indicaciones','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control','rows'=>'3'],'textType'=>'textarea'])
					</div>
		</div>
