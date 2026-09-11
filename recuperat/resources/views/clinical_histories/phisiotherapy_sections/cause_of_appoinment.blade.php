<div class="row">
			<div class="col-xl-12">
				<h4><strong>Motivo de Consulta</strong></h4>
			</div>
		</div>
		<div class="row">
					<div class="col-xl-12">
						@php
							$count=0;
						@endphp
					@include('clinical_histories.antecedents',['name'=>'cause_of_appoinment','S_label'=>'Motivo de consulta','show_label'=>false,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control','rows'=>'2'],'textType'=>'textarea'])
					</div>
		</div>
