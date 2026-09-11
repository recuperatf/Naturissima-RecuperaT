<div class="row">
	<div class="col-xl-12">
		<h4><strong>Evaluación Goniométrica</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
	@endphp
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Miembro Superior (IZQ)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Miembro Superior (DER)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
<div class="row">
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Miembro Inferior (IZQ)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Miembro Inferior (DER)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
<div class="row">
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Tronco (IZQ)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Tronco (DER)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
<div class="row">
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Cuello (IZQ)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
	<div class="col-xl-4">
		@include('clinical_histories.valoration_row',['name'=>'valoration_goniometry','S_label'=>'Cuello (DER)','S_order'=>(++$count),'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
{{-- <div class="col-xl-11">
	<img src="/images/muscular_strength.png">
</div> --}}
