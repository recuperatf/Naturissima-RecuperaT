@php
	$count=0;
@endphp
@extends("layouts.basic")
@section("content")
@push('javascript')
@endpush
{{Form::model($model,['route'=>['historia.store',$patient_id]])}}
    <div class="container note_container">
        @include('reports.row_print_report', ['hideImage' => true])
    	<div class="row">
    		<div class="col-xl-12">
    			<h4><strong>VALORACIÓN DE LA MARCHA</strong></h4>
                    <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Ver Parametros Especiales</a>
                    <div class="modal fade" id="modal-id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Parámetros especiales</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>• Longitud de zancada:</strong> distancia lineal entre dos contactos de talón consecutivos de la misma extremidad.</p>

                                    <p><strong>• Longitud de paso:</strong> distancia lineal entre el contacto inicial del talón de una extremidad y el de la extremidad contralateral (40cm aprox. aunque depende de la estatura del individuo).</p>

                                    <p><strong>• Ancho de paso o Amplitud de base:</strong> la distancia entre ambos pies, generalmente entre los talones, que representa la medida de la base de sustentación y equivale a 5 a 10 centímetros, relacionada directamente con la estabilidad y el equilibrio. Como la pelvis debe desplazarse hacia el lado del apoyo del cuerpo para mantener la estabilidad en el apoyo medio, una base de sustentación estrecha reduce el desplazamiento lateral del centro de gravedad.</p>

                                    <p><strong>• Altura del paso:</strong> el movimiento de las extremidades inferiores otorga una altura de 5 centímetros al paso, evitando el arrastre de los pies.</p>

                                    <p><strong>• Ángulo del paso o ángulo de la marcha:</strong> Se refiere a la orientación del pie durante el apoyo. El eje longitudinal de cada pie forma un ángulo con la línea de progresión (línea de dirección de la marcha); normalmente, está entre 5º y 8º.</p>

                                    Parámetros temporales

                                    Apoyo: Porcentaje del ciclo total de la marcha durante el cual el cuerpo se encuentra apoyado sobre una sola pierna.

                                    <p><strong>• Balanceo:</strong> Porcentaje del ciclo de la marcha durante el cual la extremidad inferior permanece en el aire y avanza hacia adelante.</p>

                                    <p><strong>• Doble apoyo:</strong> Porcentaje del ciclo de la marcha en el cual ambos pies contactan el suelo </p>

                                     <p><strong>• Periodo de zancada:</strong> Lapso de tiempo en el que el transcurren dos eventos idénticos sucesivos del mismo pie, generalmente entre 2 contactos iniciales de la misma extremidad inferior.</p>

                                    <p><strong>• Periodo de soporte o apoyo:</strong> El tiempo que transcurre desde que el pie hace contacto con el piso, hasta el momento de despegue de los dedos del mismo pie. </p>

                                    <p><strong>•Periodo de balaceo:</strong> Es el tiempo transcurrido entre el instante de despegue de los dedos hasta el punto de contacto inicial de un mismo pie.</p>

                                    <p><strong>• Cadencia:</strong> Es el número de pasos por unidad de tiempo, generalmente se mide en un minuto. La frecuencia determina el ritmo y rapidez de la marcha.</p>




                                    Parámetros espaciotemporales

                                    <p><strong>• Velocidad:</strong> Es la relación de la distancia recorrida en dirección de la marcha por unidad de tiempo (Velocidad= Distancia / Tiempo).</p>

                                    <p><strong>• Velocidad de Balanceo:</strong> Tiempo en que se demora un miembro inferior desde la aceleración inicial hasta el siguiente paso.</p>

                                    <p><strong>• Velocidad media:</strong> Producto de la cadencia por la longitud de la zancada expresada en m/seg.</p>

                                    <p><strong>• Cadencia o ritmo del paso:</strong> Se relaciona con la longitud del paso y representa habitualmente el ritmo más eficiente para ahorrar energía en ese individuo en particular y según su estructura corporal. Los individuos más altos dan pasos a una cadencia más lenta, en cambio los más pequeños dan pasos más rápidos. Puede ir entre 90 a 120 pasos/min.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

    		</div>
    			@include('valorations.laboral_physiotherapy.valoration_row_options_gait',			[
    						'name'=>'valoration_physiotherapy_gait',
    						'S_label'=>'Trastornos',
    						'radio_options'=>[
    							'Atáxica',
    							'Tambaleante',
    							'Equina',
    							'Espástica',
    							'Hemiparética',
    							'Paraperética',
    							'Distónica',
    							'Coréica',
    							'Paretoatetósica',
    							'Parkinsoniana',
    							'Antiálgica',
    							'Terndelemburg',
    							'Apráxica',
    							'Senil',
                                ],
    						'S_order'=>(++$count),
    						'checkbox'=>true,
    						'default'=>($valorations)?
    						$valorations->where('section','valoration_physiotherapy_gait'):
    						[]
    						])
    	</div>
        <div class="row">
            <div class="col-lg-6">
                @include('clinical_histories.valoration_row',[
                'name'=>'valoration_physiotherapy_gait_other',
                'S_label'=>'Otra',
                'S_order'=>(++$count),
                'default'=>(!empty($valorations)?$valorations:null),])
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6" align="center">
                <img src="/images/valoraciones/gait/gait_img.png" alt="Imagen_marcha2.png">
            </div>
            <div class="col-lg-6" align="center">
                <img src="/images/valoraciones/hc_fisioterapia/valoracion_marcha.png" alt="Imagen marcha">
            </div>
            <div class="col-lg-12">
                @include('clinical_histories.valoration_row',[
                'name'=>'valoration_physiotherapy_gait',
                'S_label'=>'Observaciones',
                'S_order'=>(++$count),
                'default'=>(!empty($valorations)?$valorations:null),])
            </div>
            <div class="col-lg-12">
                {{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
            </div>
        </div>
    </div>
{{Form::close()}}
@endsection
