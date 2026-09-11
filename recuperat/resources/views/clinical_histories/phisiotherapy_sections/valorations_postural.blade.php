<div class="row">
			<div class="col-xl-12">
				<h4><strong>Valoración Postural</strong></h4>
			</div>
		</div>
		<div class="row">
					<div class="col-xl-7">
						@php
							$count=0;
						@endphp
					@include('clinical_histories.antecedents',['name'=>'postural_valoration','S_label'=>'Valoración Postural','show_label'=>false,'S_order'=>(++$count), 'antecedent_type_id'=>2,'default'=>(!empty($valorations)?$valorations:null),'textClass'=>['class'=>'form-control','rows'=>2],'textType'=>'textarea'])
					</div>
					<div class="col-xl-5">
						<img src="/images/valoraciones/hc_fisioterapia/valoracion_postural.png" alt="img_valoración_postural">
					</div>
		</div>
