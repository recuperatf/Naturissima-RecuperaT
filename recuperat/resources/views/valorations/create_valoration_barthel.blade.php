@php
$count=0;

$parameters = [
	'Alimentación'=>[
		'type' => 'radio',
        0 => 'No le es posible',
		5 => 'Necesita ayuda para cortar, extender mantequilla o precisa dieta modificada',
		10 => 'Independiente',
	],
	'Baño'=>[
		'type' => 'radio',
        0 => 'Dependiente',
		5 => 'Independiente o puede ducharse',
	],
    'Arreglo Personal' => [
        'type' => 'radio',
        0 => 'Necesita ayuda con su cuidado personal',
        5 => 'Puede lavarse cara, peinarse, limpiarse dientes, afeitarse, etc.',
    ],
	'Vestido'=>[
		'type' => 'radio',
        0 => 'Dependiente',
		5 => 'Precisa alguna ayuda, pero hace muchas cosas sin ayuda',
		10 => 'Independiente, incluyendo botones, cremalleras, lazadas cordones, etc.',
	],
	'Defecación'=>[
		'type' => 'radio',
        0 => 'Incontinente (o precisa enemas)',
		5 => 'Algun problema de incontinencia ocasional',
        10 => 'Continente',
	],
    'Control vesical'=>[
        'type' => 'radio',
        0 => 'Incontinente, sondado, o incapaz de manejar su orina solo',
        5 => 'Algun problema de incontinencia ocasional',
        10 => 'Continente'
    ],
	'Uso del inodoro'=>[
		'type' => 'radio',
        0 => 'Dependiente',
        5 => 'Precisa alguna ayuda, pero hace casi todo solo',
        10 => 'Independiente, para sentarse, levantarse, limpiarse, vestirse',
	],
    'Traslados, de la cama a una silla y viceversa'=>[
        'type' => 'radio',
        0 => 'Incapaz de mantenerse sentado',
        5 => 'Precisa bastante ayuda (una o dos personas), pero puede permanecer sentado',
        10 => 'Independiente',
    ],
    'Movilidad en superficies planas'=>[
        'type' => 'radio',
        0 => 'Inmovil, o menos de 45 metros de desplazamiento',
        5 => 'Independiente en silla de ruedas, incluyendo rincones, mayor de 45 metros',
        10 => 'Camina con ayuda de una persona (verbal o física) más de 45 metros',
        15 => 'Independiente, (aunque precise bastón o muleta) más de 45 metros'
    ],
    'Escaleras'=>[
        'type' => 'radio',
        0 => 'Imposible',
        5 => 'Precisa alguna ayuda, verbal o física',
        10 => 'Independiente',
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
            20: "Dependiente total",
            60: "Dependiente grave",
            90: "Dependiente moderado",
            1000: "Dependiente leve",
        }
        const inputs = $("form input").filter(function(index, element){
            return $(element).attr('name')?.includes('functional_valoration_barthel');
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
            const interpretationKey = Object.keys(interpretations).find((key) => total <= key);
            const interpretationText = `${total} (${interpretations[interpretationKey]})`;
            $("input[name='functional_total[11][json_values]']").val(interpretationText);
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
        <strong>Valoración funcional: ÍNDICE DE BARTHEL</strong>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <strong>Objetivo: </strong>
        <p>Evaluar el nivel de autonomía o dependencia funcional de una persona
mayor para la realización de actividades de la vida diaria básicas.</p>
    </div>
</div>
 <div class="row">
    <div class="col-lg-12">
        <strong>Puntuación: </strong>
        <ul>
            <li>0-20: Dependiente total</li>
            <li>25-60: Dependiente grave</li>
            <li>65-90: Dependiente moderado</li>
            <li>>95: Dependiente leve</li>
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
                        @include('clinical_histories.valoration_row_options_nordic',[
                            'name'=>'functional_valoration_barthel'.strtolower(str_replace(' ', '_', $parameterTitle)),
                            'label_show' => false,
                            'S_label'=>strtolower(str_replace(' ', '_', $parameterTitle)),
                            'width' => '100%',
                            'radio_options'=>$options,
                            'S_order'=>(++$count),
                            'default'=>($valorations)?
                            $valorations->where('section','functional_valoration_barthel'.strtolower(str_replace(' ', '_', $parameterTitle))):
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
