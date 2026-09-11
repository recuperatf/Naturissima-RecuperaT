<div class="row">
			<div class="col-xl-12">
				<h4><strong>Valoraciones específicas</strong></h4>
			</div>
		</div>
		<div class="row">
					<div class="col-xl-12">
						@php
							$count=0;
						@endphp
					@include('clinical_histories.antecedents',['name'=>'specifical_valorations','S_label'=>'Radica en','show_label'=>false,'textType'=>'textarea','textClass'=>['class'=>'form-control','rows'=>'3'],'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),])
					</div>

		</div>
