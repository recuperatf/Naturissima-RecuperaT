<div class="row">
			<div class="col-xl-12">
				<h4><strong>Antecedentes</strong></h4>
			</div>
		</div>
		<div class="row">
            <div class="col-xl-3">
                @php
                    $count=0;
                @endphp
                @include('clinical_histories.valoration_row',['name'=>'free_antecedents','show_label'=>true, 'S_label'=>'Antecedentes','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
            </div>
		</div>
