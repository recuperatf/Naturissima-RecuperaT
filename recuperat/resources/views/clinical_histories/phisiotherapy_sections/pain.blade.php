<div class="row">
			<div class="col-xl-12">
				<h4><strong>Dolor</strong></h4>
			</div>
		</div>
		<div class="row">
				@php
					$count=0;
				@endphp
					<div class="col-xl-3">

					@include('clinical_histories.antecedents',['name'=>'pain','S_label'=>'Características','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control'],'textType'=>'text'])
					</div>
					<div class="col-xl-9">
					@include('clinical_histories.antecedents',['name'=>'pain','S_label'=>'Irradiación','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control', 'rows'=>1],'textType'=>'textarea'])
					</div>
					<div class="col-xl-1">
					@include('clinical_histories.valoration_row',['name'=>'valoration_pain','S_label'=>'EVA','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
					</div>
					<div class="col-xl-11">
						<img src="/images/EVA.png">
					</div>
		</div>
