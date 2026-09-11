<div class="row">
			<div class="col-xl-12">
				<h4><strong>Tiempo de Evolución</strong></h4>
			</div>
		</div>
		<div class="row">
					<div class="col-xl-12">
						@php
							$count=0;
						@endphp
					@include('clinical_histories.antecedents',['name'=>'evolution','S_label'=>'Tiempo de Evolución','show_label'=>false,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control'],'textType'=>'text'])
					</div>
		</div>
