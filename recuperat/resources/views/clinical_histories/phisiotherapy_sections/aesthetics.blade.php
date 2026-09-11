<div class="row">
			<div class="col-xl-12">
				<h4><strong>Estética</strong></h4>
			</div>
		</div>
		<div class="row">
				@php
					$count=0;
				@endphp
					<div class="col-xl-12">

					@include('clinical_histories.antecedents',['name'=>'aesthetics','S_label'=>'Palpación','show_label'=>true,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control','rows'=>'3'],'textType'=>'textarea'])
					</div>
					<div class="col-xl-3">

					</div>
		</div>
