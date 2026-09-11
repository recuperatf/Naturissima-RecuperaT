<div class="row">
			<div class="col-xl-12">
				<h4><strong>Antecedentes familiares</strong></h4>
			</div>
		</div>
		<div class="row">
					<div class="col-xl-3">
					@php
						$count=0;
					@endphp
					@include('clinical_histories.antecedents',['ID_cie10'=>12288,'name'=>'antecedents_familial','S_label'=>'Diabetes', 'S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null)])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_familial','S_label'=>'IRC','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['ID_cie10'=>12269,'name'=>'antecedents_familial','S_label'=>'Cáncer','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_familial','S_label'=>'Enf. Reuma','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['ID_cie10'=>12280,'name'=>'antecedents_familial','S_label'=>'Cardiopatías','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_familial','S_label'=>'Cirugías','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>

					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_familial','S_label'=>'Alergias','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>
					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['ID_cie10'=>12081,'name'=>'antecedents_familial','S_label'=>'Transfusiones','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>
					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_familial','S_label'=>'Accidentes','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>
					<div class="col-xl-3">
					@include('clinical_histories.antecedents',['name'=>'antecedents_familial','S_label'=>'Fracturas','S_order'=>(++$count), 'antecedent_type_id'=>3,'default'=>(($antecedents)?$antecedents:null),])
					</div>

		</div>
