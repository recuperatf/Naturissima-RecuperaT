<div class="row">
	<div class="col-xl-12">
		<h4><strong>FRECUENCIA DE CONSUMO DE ALIMENTOS</strong></h4>
	</div>
</div>
<div class="row">
	@php
		$count=0;
		$frecuencies=['No','Diario', '1-2 sem', '3-4 sem','1 c/15','1 mes'];
		$alimentos=['Cerdo','Res','Pollo','Pescado','Mariscos',' Huevo','Leche','Queso','Yogurt','Bolillo','Pasta','Tortilla','Pan de Caja','Cereal','Arroz','Frutas','Verduras','Manteca','Aceite','Oleaginosas','Aguacate','Crema','Mayonesa','Pan dulce','Tostadas','Galletas','Jugo Industrializado','Refresco','Azúcar','Leguminosas'];
	@endphp
	@foreach($alimentos as $alimento)
	{{-- @dd($valorations) --}}
	<div class="col-xl-6">
		@php
			if(!isset($valorations)){
				$valorations=false;
			}
		@endphp
		{{-- @dd($valorations) --}}
		@include('clinical_histories.valoration_row_food_frequency_nutriology',[
		'name'=>'valoration_food_frequency_examination_nutriology_'.strtolower($alimento),
		'S_label'=>$alimento,
		'radio_options'=>$frecuencies,
		'S_order'=>(++$count),
		'default'=>($valorations)?
		$valorations->where('section','valoration_food_frequency_examination_nutriology_'.strtolower($alimento)):
		[]
		])
	</div>
	@endforeach
</div>
