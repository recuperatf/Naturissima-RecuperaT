@php
$count=0;

$parameters = [
	'1. Baño'=>[
		'radio',
		'Dependiente: Precisa ayuda para lavar más de una zona, para salir o entrar en la bañera, o no puede bañarse solo',
        'Independiente: Se baña solo o precisa ayuda para lavar alguna zona, como la espalda, o una extremidad con minusvalía',
	],
	'2. Vestido'=>[
		'radio',
		'Dependiente: No se viste por sí mismo, o permanece parcialmente desvestido',
        'Independiente: Saca ropa de cajones y armarios, se la pone, y abrocha. Se excluye el acto de atarse los zapatos',
	],
	'3. Uso del WC'=>[
		'radio',
		'Dependiente: Precisa ayuda para ir al WC',
        'Independiente: Va al WC solo, se arregla la ropa y se limpia',
	],
	'4. Movilidad'=>[
		'radio',
		'Dependiente: Precisa ayuda para levantarse y acostarse en la cama o silla. No realiza uno o más desplazamientos',
        'Independiente: Se levanta y acuesta en la cama por sí mismo, y puede levantarse de una silla por sí mismo',
	],
    '5. Continencia'=>[
        'radio',
        'Dependiente: Incontinencia parcial o total de la micción o defecación',
        'Independiente: Control completo de micción y defecación',
    ],
	'6. Alimentación'=>[
		'radio',
		'Dependiente: Precisa ayuda para comer, no come en absoluto, o requiere alimentación parenteral',
        'Independiente: Lleva el alimento a la boca desde el plato o equivalente (se excluye cortar la carne)',
	],
];
@endphp
@extends("layouts.basic")
@section("content")
@push('css')
<style>
    @media print{
        .table{
            width: 60%!important;
        }
        .table div.mt-auto {
            display: none;
        }
    }
</style>
@endpush
@push('javascript')
<script>
    $(function(){
        const interpretations =  {
            0: "normal",
            1: "muy levemente incapacitado",
            2: "levemente incapacitado",
            3: "moderadamente incapacitado",
            4: "incapacitado",
            5: "severamente incapacitado",
            6: "inválido"
        }
        const inputs = $("form input").filter(function(index, element){
            return $(element).attr('name')?.includes('functional_valoration_');
        });
        inputs.each((index, element) => {
            $(element).on('change', updateTotal);
        });
        updateTotal();

        function updateTotal(){
            let total = 0;
            inputs.each((index, element) => {
                const value = $(element).val();
                const intValue = parseInt(value);
                const elementIsChecked = $(element).is(':checked');
                if (!intValue || !elementIsChecked)
                    return;
                total += parseInt(value);
            });
            const interpretation = interpretations[total];
            const interpretationText = `${total} (${interpretation})`;
            $("input[name='functional_total[7][json_values]']").val(interpretationText);
        }
    });
</script>
@endpush
<script type="text/javascript">

</script>
<div class="container note_container">
    {{Form::model($model,['route'=>['historia.store',$patient_id]])}}
    @if($model)
    {{ method_field('PATCH') }}
    @endif
	@include('reports.row_print_report', ['hideImage' => true])
 <div class="row">
    <div class="col-lg-12">
        <strong>Valoración funcional: ÍNDICE DE KATZ</strong>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <strong>Objetivo: </strong>
        <p>Evaluar el nivel de autonomía o dependencia funcional de una persona
mayor para la realización de actividades de la vida diaria básicas: baño, vestido,
uso de retrete, movilización, incontinencia y alimentación.</p>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <strong>Estructura: </strong>
        <p>Consta de seis preguntas en los que se evalúan las actividades de la
vida diaria proporcionando un índice de autonomía-dependencia.</p>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <strong>Puntuación: </strong>
        <ul>
        	<li>0 puntos = normal</li>
        	<li>1 punto = muy levemente incapacitado</li>
        	<li>2 puntos = levemente incapacitado</li>
        	<li>3 puntos =moderadamente incapacitado</li>
        	<li>4 puntos = incapacitado</li>
        	<li>5 puntos = severamente incapacitado</li>
        	<li>6 puntos = inválido</li>
        </ul>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
    <p>
    	Se considera que un paciente que se niega a realizar una función no hace esa
    	función, aunque se le considere capaz.
    </p>
    	<strong>Total:</strong> el resultado se informa utilizando la letra adecuada en cada caso, por
    	ejemplo: Índice de Katz: C.
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		<table class="table">
			<tr>
				<td><strong>Parámetro</strong></td>
				<td><strong>Valor</strong></td>
			</tr>
			@foreach($parameters as $parameterTitle => $options)
                <tr>
                    <td>{{$parameterTitle}}</td>
                    <td class="text-left">
                        @include('clinical_histories.valoration_katz_row',[
                            'name'=>'functional_valoration_'.strtolower(str_replace(' ', '_', $parameterTitle)),
                            'label_show' => false,
                            'S_label'=>strtolower(str_replace(' ', '_', $parameterTitle)),
                            'width' => '100%',
                            'radio_options'=>[
                                'type'=> $options[0], $options[2], $options[1]
                            ],
                            'S_order'=>(++$count),
                            'default'=>($valorations)?
                            $valorations->where('section','functional_valoration_'.strtolower(str_replace(' ', '_', $parameterTitle))):
                            [],])
                    </td>
                </tr>
			@endforeach

		</table>
	</div>
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-8">
				<strong>PUNTAJE TOTAL</strong>
			</div>
			<div class="col-lg-4">
				@include('clinical_histories.valoration_row',[
		            'name'=>'functional_total',
		            'S_label'=>'Total',
		            'label_show' => false,
		            'S_order'=>(++$count),
		            'default'=>(!empty($valorations)?$valorations:null),])
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<strong>Observaciones</strong>
			</div>
			<div class="col-lg-12">
				@include('clinical_histories.valoration_row',[
		            'name'=>'functional_total_observations',
		            'textarea'=>true,
		            'rows'=>'3',
		            'S_label'=>strtolower(str_replace(' ', '_', 'Observaciones')),
		            'label_show' => false,
		            'S_order'=>(++$count),
		            'default'=>(!empty($valorations)?$valorations:null),])
			</div>
		</div>
	</div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xl-12">
                <br>
                {{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
                <a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
            </div>
        </div>
    </div>
</div>

{{Form::close()}}

</div>
@endsection
