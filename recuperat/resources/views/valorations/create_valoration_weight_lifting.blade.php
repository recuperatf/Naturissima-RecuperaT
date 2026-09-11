@extends("layouts.basic")
@section("content")
@push('javascript')
<script>
    $(()=>{
        // setTimeout(function(){calculateTotal('#label_first_total', '.color-value:checked');}, 500);
        setTimeout(function(){new_row('label_first_total', '.label_first_total');}, 500);
        setTimeout(function(){new_row('label_second_total', '.label_second_total');}, 500);
        setTimeout(function(){new_row('label_third_total', '.label_third_total');}, 500);
    });
    function new_row(label, labels_selector) {
        let labels = $(labels_selector);
        let total = 0;
        labels.each(function(key, label_obj){
            let checked_label = $(label_obj).parents('div.row').first().find('input.color-value:checked').first();
            console.log(checked_label);
            let int_value = (checked_label.val() == null) ? '0' : checked_label.val();
            let label_text = $(label_obj).find('h3').first().html();
            let new_row = $('<tr></tr>');
            let td = $('<td></td>').html(label_text);
            total += parseInt(int_value);
            new_row.append(td);
            let color = checked_label.attr("color");
            new_row.append($('<td></td>').css('background-color', color));
            new_row.append($('<td></td>').html(int_value));
            new_row.insertBefore('table[assigned-total="'+label+'"] tr.tr_total');
        });
       $('#'+label).html(total);
    }
    function calculateTotal(selectorTotalString, selectorIndividualValue){
        $(selectorIndividualValue).each(function(key, color_value){
            let current_total = parseInt($(color_value).val()) + parseInt($("#adding").html());
            $(selectorTotalString).html(current_total);
        });
    }
</script>
@endpush
    <div class="container note_container">
        @include('reports.row_print_report')
        <div class="row">
            <div class="col-lg-12">
                <strong><h3>Valoración de levantamiento de cargas</h3></strong>
            </div>
        </div>
        @php
            $count=0;
        @endphp
        {{Form::model($model,['route'=>['historia.store',$patient_id]])}}
        @if($model)
        {{ method_field('PATCH') }}
        @endif
        {{Form::hidden('patient_id',$patient_id)}}
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value', 'color'=>'y', 'pts'=>1],
                        ['label'=>'Tercero', 'class'=>'color-value', 'color'=>'r', 'pts'=>2],
                        ['label'=>'Cuarto', 'class'=>'color-value', 'color'=>'r', 'pts'=>3]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_vertical_region',
                    'count'=>$count++,
                    'S_label'=>'1. Distancia horizontal entre las manos y la parte inferior de la espalda',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img0.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value', 'color'=>'y', 'pts'=>1],
                        ['label'=>'Tercero', 'class'=>'color-value', 'color'=>'r', 'pts'=>2],
                        ['label'=>'Cuarto', 'class'=>'color-value', 'color'=>'r', 'pts'=>3]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_vertical_region',
                    'count'=>$count++,
                    'S_label'=>'2. Región de levantamiento vertical',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img1.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value', 'color'=>'y', 'pts'=>1],
                        ['label'=>'Tercero', 'class'=>'color-value', 'color'=>'r', 'pts'=>3]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_torsion_and_flexion_region',
                    'count'=>$count++,
                    'S_label'=>'3. Torsión y flexión lateral del torso',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img2.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value', 'color'=>'y', 'pts'=>1],
                        ['label'=>'Tercero', 'class'=>'color-value', 'color'=>'r', 'pts'=>3]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_asymetric_load_torso_region',
                    'count'=>$count++,
                    'S_label'=>'4. Carga asimétrica sobre el torso',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img3.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value first_total', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value first_total', 'color'=>'y', 'pts'=>4],
                        ['label'=>'Tercero', 'class'=>'color-value first_total', 'color'=>'r', 'pts'=>6],
                        ['label'=>'Cuarto', 'class'=>'color-value first_total', 'color'=>'p', 'pts'=>10]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_weight_alignment',
                    'class' => 'label_first_total',
                    'count'=>$count++,
                    'S_label'=>'5. Lineamiento de peso de la cargo con frecuencia',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img4.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value first_total', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value first_total', 'color'=>'y', 'pts'=>1],
                        ['label'=>'Tercero', 'class'=>'color-value first_total', 'color'=>'r', 'pts'=>3]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_horizontal_distance_among_hands_back',
                    'count'=>$count++,
                    'class' => 'label_first_total',
                    'S_label'=>'6. Distancia horizontal entre las manos y la parte inferior de la espalda',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img5.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value first_total', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value first_total', 'color'=>'y', 'pts'=>1],
                        ['label'=>'Tercero', 'class'=>'color-value first_total', 'color'=>'r', 'pts'=>3]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_vertical_load_rise_region',
                    'count'=>$count++,
                    'class' => 'label_first_total',
                    'S_label'=>'7. Región de levantamiento vertical',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img6.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Primero', 'class'=>'color-value', 'color'=>'g', 'pts'=>0],
                        ['label'=>'segundo', 'class'=>'color-value', 'color'=>'y', 'pts'=>4],
                        ['label'=>'Tercero', 'class'=>'color-value', 'color'=>'r', 'pts'=>6],
                        ['label'=>'Cuarto', 'class'=>'color-value', 'color'=>'p', 'pts'=>10]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_weight_lift_2_people',
                    'count'=>$count++,
                    'S_label'=>'8. Lineamientos de carga para dos personas',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img7.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Verde', 'class'=>'color-value first_total', 'color'=>'g', 'pts'=>0],
                        ['label'=>'Naranja', 'class'=>'color-value first_total', 'color'=>'y', 'pts'=>1],
                        ['label'=>'Rojo', 'class'=>'color-value first_total', 'color'=>'r', 'pts'=>3]
                    ],
                    'name'=>'valoration_labolar_physiotherapy_posture_restrictions',
                    'count'=>$count++,
                    'class' => 'label_first_total',
                    'S_label'=>'9. Restricciones posturales',
                    'clarification'=>'Contesta a lo que se te indica, es necesario tener muchas observaciones antes las diferentes situaciones que puedes tener. Coloca una palomita a la situación que más se asemeje.
Califica postura del trabajador en cuanto a restricciones, posiciones incomodas como el espacio.',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img8.png'
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Buen agarre', 'class'=>'color-value first_total', 'color'=>'b','pts'=>0],
                        ['label'=>'Agarre regular', 'class'=>'color-value first_total', 'color'=>'r','pts'=>1],
                        ['label'=>'Mal Agarre', 'class'=>'color-value first_total', 'color'=>'r','pts'=>3],
                    ],
                    'name'=>'valoration_labolar_physiotherapy_posture_restrictions',
                    'class' => 'label_first_total',
                    'count'=>$count++,
                    'S_label'=>'10. Acoplamiento mano-carga elemento de sujección',
                    'clarification'=>'Este factor considera las propiedades geométricas y de diseño de la carga que se va a manejar.',
                    'img'=>'/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img9.png'
                    ]
                    )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Piso seco, limpio y en buenas condiciones de mantenimiento.', 'class'=>'color-value first_total', 'color'=>'g','pts'=>0],
                        ['label'=>'Piso seco, pero en malas condiciones, desgastado o irregular.', 'class'=>'color-value first_total', 'color'=>'r','pts'=>1],
                        ['label'=>'Piso contaminado/ húmedo o desnivelado, superficie inestable o calzado inadecuado ', 'class'=>'color-value first_total', 'color'=>'r','pts'=>3],
                    ],
                    'class' => 'label_first_total',
                    'name'=>'valoration_labolar_physiotherapy_posture_restrictions',
                    'count'=>$count++,
                    'S_label'=>'11. Superficie de trabajo',
                    'clarification'=>'Este factor considera las propiedades donde el trabajador camina o permanece de pie.',
                    'img'=>''
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Sin factores de riesgo presentes.', 'class'=>'color-value first_total', 'color'=>'g','pts'=>0],
                        ['label'=>'Un factor de riesgo presente.', 'class'=>'color-value first_total', 'color'=>'r','pts'=>1],
                        ['label'=>'Piso contaminado/ húmedo o desnivelado, superficie inestable o calzado inadecuado', 'class'=>'color-value first_total', 'color'=>'r','pts'=>3],
                    ],
                    'class' => 'label_first_total',
                    'name'=>'valoration_labolar_physiotherapy',
                    'count'=>$count++,
                    'S_label'=>'12. Factores ambientales',
                    'clarification'=>'Observar el ambiente de trabajo y determinar si la operación de levantamiento se lleva a cabo en temperaturas externas, circulación del aire, iluminación entre otras.',
                    'img'=>''
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'2 a 4 m', 'class'=>'color-value first_total', 'color'=>'g','pts'=>0],
                        ['label'=>'Mas de 4 m y menos de 10 m', 'class'=>'color-value first_total', 'color'=>'r','pts'=>1],
                        ['label'=>'Mas de 10 m', 'class'=>'color-value first_total', 'color'=>'r','pts'=>3]
                    ],
                    'class' => 'label_first_total',
                    'name'=>'valoration_labolar_physiotherapy',
                    'count'=>$count++,
                    'S_label'=>'13. Distancia de transporte',
                    'clarification'=>'Observar la actividad y estimar distancia.',
                    'img'=>''
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Sin obstáculos y las de transporte es plana', 'class'=>'color-value first_total', 'color'=>'g','pts'=>0],
                        ['label'=>'Pendientes pronunciadas o subir escalones o pasar a través de puertas estrechas o riesgo de tropezar', 'class'=>'color-value first_total', 'color'=>'r','pts'=>1],
                        ['label'=>'Subir por escaleras y/o pendientes empinadas', 'class'=>'color-value first_total', 'color'=>'r','pts'=>3]
                    ],
                    'class' => 'label_first_total',
                    'name'=>'valoration_labolar_physiotherapy',
                    'count'=>$count++,
                    'S_label'=>'14 Obstáculos en la ruta',
                    'clarification'=>'El trabajador tiene que llevar una carga y se presenta un factor de riesgo.',
                    'img'=>''
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Bien', 'class'=>'color-value first_total', 'color'=>'g','pts'=>0],
                        ['label'=>'Regular', 'class'=>'color-value first_total', 'color'=>'r','pts'=>1],
                        ['label'=>'Malo o deficiente', 'class'=>'color-value first_total', 'color'=>'r','pts'=>3]
                    ],
                    'class' => 'label_first_total',
                    'name'=>'valoration_labolar_physiotherapy',
                    'count'=>$count++,
                    'S_label'=>'15. Comunicación, coordinación y control',
                    'clarification'=>'Comunicación es esencial cuando el levantar una carga se realiza en grupo.',
                    'img'=>''
                ]
        )

        @include('valorations.section_total_load', [
            'label' => '16. Estimación del nivel de riesgo',
            'description' => 'Evaluación',
            'total_label' => 'label_first_total',
        ])

        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Estimación del nivel de riesgo</h3>
            </div>
            <div class="col-lg-12">
                <ol type="a">
                    <li>
                    Utilizar el tiempo que sea necesario para observar la actividad. Asegurar que lo observado sea representativo del procedimiento normal de trabajo.
                    </li>
                    <li>
                    Involucrar a los trabajadores, supervisores o encargados de seguridad y salud en el trabajo durante el proceso de evaluación. Cuando varias personas hagan la misma actividad, considerar las opiniones de los trabajadores sobre las demandas de la operación.
                    </li>
                    <li>
                        Seleccionar la evaluación adecuada al tipo de actividad, es decir, empuje y arrastre de objetos sin uso de equipo auxiliar o empujar y jalar objetos con uso de equipo auxiliar.
                    </li>
                    <li>
                    Leer esta guía de evaluación antes de llevarla a cabo.
                    </li>
                    <li>
                    Seguir la guía de evaluación para determinar el nivel de riesgo para cada factor de riesgo identificado.
                    </li>
                    <li>
                    Clasificar el nivel de riesgo de acuerdo con la Tabla siguiente:
                    </li>
                    <li>Considerar que las bandas de color indican cuáles elementos de la actividad son los que requieren mayor atención.</li>
                    <li>Proceder a evaluar como lo señalan los numerales según corresponda a la actividad identificada.</li>
                    <li>Estimar el nivel de riesgo de conformidad con los numerales según corresponda.</li>
                </ol>
            </div>
        </div>

        <h3>Evaluación del riesgo de actividades que impliquen empuje o arrastre de cargas sin uso de equipo auxiliar</h3>
        <p>Identificar la actividad. Si se realizan dos o más actividades (por ejemplo, rodando y girando sobre su base), realice una evaluación para cada tipo de actividad.</p>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
                    'options'=>[
                        ['label'=>'Bajo', 'class'=>'color-value', 'color'=>'g','pts'=>0, 'explanation'=>'Menos de 400 kg'],
                        ['label'=>'Medio', 'class'=>'color-value', 'color'=>'y','pts'=>2, 'explanation'=>'De 400 kg a 600 kg'],
                        ['label'=>'Alto', 'class'=>'color-value', 'color'=>'r','pts'=>4, 'explanation'=>'De 600 kg a 1000 kg'],
                        ['label'=>'Muy Alto', 'class'=>'color-value', 'color'=>'p', 'pts'=>8, 'explanation'=>'Mas de 1000 kg']
                    ],
                    'show_label'=>true,
                    'name'=>'valoration_labolar_physiotherapy',
                    'count'=>$count++,
                    'S_label'=>'19. Rodando',
                ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bajo', 'class'=>'color-value', 'color'=>'g','pts'=>0,'explanation'=>'Menos de 80 kg'],
                ['label'=>'Medio', 'class'=>'color-value', 'color'=>'y','pts'=>2,'explanation'=>'De 80kg a 120 kg'],
                ['label'=>'Alto', 'class'=>'color-value', 'color'=>'r','pts'=>4,'explanation'=>'De 120 kg a 150 kg'],
                ['label'=>'Muy Alto', 'class'=>'color-value', 'color'=>'p','pts'=>8,'explanation'=>'Mas de 150kg'],
            ],
            'show_label'=>true,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'20. Girando sobre su base',
            ]
        )
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bajo', 'class'=>'color-value', 'color'=>'g','pts'=>0, 'explanation'=>'Menos de 25 kg'],
                ['label'=>'Medio', 'class'=>'color-value', 'color'=>'y','pts'=>2, 'explanation'=>'De 25 kg a 50 kg'],
                ['label'=>'Alto', 'class'=>'color-value', 'color'=>'r','pts'=>4, 'explanation'=>'De 50 a 80 kg'],
                ['label'=>'Muy Alto', 'class'=>'color-value', 'color'=>'p','pts'=>8, 'explanation'=>'Mas de 80kg'],
            ],
            'show_label'=>true,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'21. Arrastrar, jalar o deslizar',
            ]
        )

        <div class="row">
            <div class="col-lg-12 text-center label_second_total">
                <h3>22. Postura</h3>
                <p>Observa la posición general de las manos y el cuerpo mientras realiza la operación</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El torso se encuentra verticalmente</li>
                    <li>Torso no torcido</li>
                    <li>Manos entre la cadera y la altura del hombro</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Cuerpo inclinado en dirección del esfuerzo</li>
                    <li>Torso visiblemente flexionado</li>
                    <li>Las manos están por debajo de la altura de la cadera</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Cuerpo muy inclinado o se pone en cuclillas, se necesita arrodillar o empujar la carga con la espalda</li>
                    <li>Torso severamente flexionado</li>
                    <li>Las manos están detrás o a un lado del cuerpo también por encima de la altura del hombro</li>
                </ul>
            </div>
            @include('valorations.create_valoration_weight_lifting_row_colors',[
                'options'=>[
                    ['label'=>'Buena', 'class'=>'color-value second_total', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value second_total', 'color'=>'y','pts'=>3],
                ['label'=>'Pobre o deficiente', 'class'=>'color-value second_total', 'color'=>'r','pts'=>6]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Postura',
            ]
            )
        </div>
        <div class="row">
            <div class="col-lg-12 text-center label_second_total">
                <h3>23. Acoplamiento de la mano-carga</h3>
                <p>Observar cómo es el agarre con las manos o cómo están en contacto con la carga durante el empuje o la tracción.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img11.png" alt="image11">
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img12.png" alt="image12">
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img13.png" alt="image13">
            </div>

            @include('valorations.create_valoration_weight_lifting_row_colors',[
                'options'=>[
                    ['label'=>'Buena', 'class'=>'color-value second_total', 'color'=>'g','pts'=>0],
                    ['label'=>'Razonable', 'class'=>'color-value second_total', 'color'=>'y','pts'=>3],
                    ['label'=>'Pobre o deficiente', 'class'=>'color-value second_total', 'color'=>'r','pts'=>6]
                ],
                'show_label'=>false,
                'name'=>'valoration_labolar_physiotherapy',
                'count'=>$count++,
                'S_label'=>'Postura',
                ]
            )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_second_total">
                <h3>24. Patrón de trabajo</h3>
                <p>Observar el trabajo, e identificar si la operación es repetitiva.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Trabajo no repetitivo y el ritmo es marcado por el trabajador</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Trabajo repetitivo, pero hay oportunidad para descansar o recuperarse a través de descansos formado por rotación de trabajo</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Trabajo repetitivo y no hay descansos formales ni informales u oportunidad de rolar el puesto de trabajo.</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                ['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>3]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Patrón de Trabajo',
            ]
        )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_second_total">
                <h3>25. Distancia por viaje</h3>
                <p>Determinar la distancia desde el principio hasta el final para un solo viaje.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>2m o menos</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Entre 2m y 10m</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Más de 10m</li>
                </ul>
            </div>
            @include('valorations.create_valoration_weight_lifting_row_colors',[
                'options'=>[
                    ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                    ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                    ['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>3]
                ],
                'show_label'=>false,
                'name'=>'valoration_labolar_physiotherapy',
                'count'=>$count++,
                'S_label'=>'Distancia por viaje',
                ]
                )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_second_total">
                <h3>26. Superficie del trabajo</h3>
                <p>Identificar la condición en que se encuentran las superficies de trabajo a lo largo de la ruta y determinar el nivel de riesgo utilizando los siguientes criterios.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Seco y limpio</li>
                    <li>Nivelado</li>
                    <li>Firme</li>
                    <li>Buen estado (no dañado o irregular)</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Mayor parte seco y limpio (humedad o algunos escombros)</li>
                    <li>En pendiente (inclinación entre 3° y 5°)</li>
                    <li>Razonablemente firme bajo los pies (por ejemplo, alfombrado)</li>
                    <li>Mala condición (daños menores)</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Contaminado (mojado o con muchos escombros)</li>
                    <li>Pendiente pronunciada (inclinación superior a 5°)</li>
                    <li>Suave o inestable bajo los pies (grava, arena, barro)</li>
                    <li>Muy mal estado (daño severo)</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                ['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>4]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Superficie del trabajo',
            ]
        )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_second_total">
                <h3>27 Obstáculos a lo largo de la ruta</h3>
                <p>Verificar en la ruta si hay obstáculos. Tener en cuenta si el equipo se mueve por encima de cables, a través de bordes elevados, hacia arriba o hacia abajo en rampas empinadas (pendiente de más de 5°), subiendo o bajando escalones, a través de puertas bloqueadas/estrechas, en espacios confinados, alrededor de curvas, esquinas u objetos.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Sin obstáculos</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Un tipo de obstáculo, pero sin rampa o escalones</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Escalones, rampas empinadas o dos más tipos de obstáculos</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                ['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>2]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Obstáculos a lo largo de la ruta',
            ]
        )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_second_total">
                <h3>28. Otros factores</h3>
                <p>Identifica los factores y coloca los que corresponda</p>
            </div>
            <div class="col-md-12">
                <ul>
                    <li>Carga inestable</li>
                    <li>Carga grande y obstruye la vista</li>
                    <li>Carga presenta bordes filosos, está caliente o daña el tacto</li>
                    <li>Mala iluminación</li>
                    <li>Temperaturas extremas</li>
                    <li>Ráfagas de viento u otros movimientos fuertes de aire</li>
                    <li>Equipo de protección personal o la vestimenta hacen el arrastre o empuje más complicado.</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>No hay factores presentes</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Un factor presente</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Dos o más factores presentes</li>
                </ul>
            </div>

        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                ['label'=>'Deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>2]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Identifica los factores y coloca los que corresponda',
            ]
        )
        </div>

        @include('valorations.section_total_load', [
            'label' => '29. Estimación del nivel de riesgo',
            'description' => '',
            'total_label' => 'label_second_total',
        ])

        <div class="col-lg-12 text-center">
                <h3>30. Determina el nivel de acción, para cada factor de riesgo, conforme al nivel de riesgo obtenido, de acuerdo con lo siguiente</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>31. Evaluación del riesgo de actividades que implique empujar o jalar cargas con el uso de equipo auxiliares</h3>
                <p>Identifica los factores y coloca los que corresponda</p>
            </div>
            <div class="col-md-12">
                <ul>
                    <li>Tipo de auxiliar y peso de carga</li>
                    <li>Evaluar la masa total movida</li>
                    <li>Pequeño con una o dos ruedas: por ejemplo, carretillas, contenedores con ruedas o diablos de carga. Con este equipo el trabajador soporta parte de la carga</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>Menos de 50kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>De 50kg a 100kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>De 100kg a 200kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>Más de 200kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>La carga excede la capacidad nominal del equipo (peso máximo recomendado por el fabricante)</li>
                </ul>
            </div>

            @include('valorations.create_valoration_weight_lifting_row_colors',[
                'options'=>[
                    ['label'=>'Bajo', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                    ['label'=>'Medio', 'class'=>'color-value', 'color'=>'y','pts'=>2],
                    ['label'=>'Alto', 'class'=>'color-value', 'color'=>'r','pts'=>4],
                    ['label'=>'Muy alto', 'class'=>'color-value', 'color'=>'r','pts'=>8],
                    ['label'=>'Inaceptable', 'class'=>'color-value', 'color'=>'p','pts'=>10]
                ],
                'show_label'=>false,
                'name'=>'valoration_labolar_physiotherapy',
                'count'=>$count++,
                'S_label'=>'Estimación del nivel de riesgo de actividades que impliquen empuje o arrastre de cargas sin uso de equipo auxiliar',
                ]
            )
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>32. Mediano, con tres o más ruedas fijas y/o ruedas móviles (rodajas): por ejemplo, jaulas con ruedas, contenedores con ruedas.</h3>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>Menos de 250 kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>De 250 kg a 500kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>De 500 kg a 750 kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>Mas de 750 kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>La carga excede la capacidad nominal del equipo (peso máximo recomendado por el fabricante)</li>
                </ul>
            </div>
        </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bajo', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Medio', 'class'=>'color-value', 'color'=>'y','pts'=>2],
                ['label'=>'Alto', 'class'=>'color-value', 'color'=>'r','pts'=>4],
                ['label'=>'Muy alto', 'class'=>'color-value', 'color'=>'r','pts'=>8],
                ['label'=>'Inaceptable', 'class'=>'color-value', 'color'=>'p','pts'=>10]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Mediano, con tres o más ruedas fijas y/o ruedas móviles (rodajas): por ejemplo, jaulas con ruedas, contenedores con ruedas.',
            ]
        )

        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>33. Grande, dirigible o sobre rieles: por ejemplo, patines o sistema de rieles superiores</h3>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>Menos de 600 kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>De 600 kg a 1000 kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>De 1000 kg a 1500 kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>Mas de 1500 kg</li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <ul>
                    <li>La carga excede la capacidad nominal del equipo (peso máximo recomendado por el fabricante)</li>
                </ul>
            </div>
        </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bajo', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Medio', 'class'=>'color-value', 'color'=>'y','pts'=>2],
                ['label'=>'Alto', 'class'=>'color-value', 'color'=>'r','pts'=>4],
                ['label'=>'Muy alto', 'class'=>'color-value', 'color'=>'r','pts'=>8],
                ['label'=>'Inaceptable', 'class'=>'color-value', 'color'=>'p','pts'=>10]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Grande, dirigible o sobre rieles: por ejemplo, patines o sistema de rieles superiores',
            ]
        )

        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>34. Postura</h3>
                <p>Observar la posición general de las manos y del cuerpo durante la operación.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El torso se encuentra verticalmente en su mayor parte.</li>
                    <li>El torso no está torcido.</li>
                    <li>Las manos están entre la cadera y la altura del hombro</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El cuerpo está inclinado en la dirección del esfuerzo.</li>
                    <li>El torso está visiblemente flexionado o torcido.</li>
                    <li>Las manos están por debajo de la altura de la cadera.</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El cuerpo está muy inclinado, o el trabajador se pone en cuclillas, se arrodilla o necesita empujar con la espalda contra la carga.</li>
                    <li>El torso está severamente flexionado o torcido.</li>
                    <li>El torso está severamente flexionado o torcido.</li>
                </ul>
            </div>
        </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>3],
                ['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>6]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'Postura',
            ]
        )

        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>35. Acoplamiento de la mano-carga</h3>
                <p>Observar cómo es el agarre con las manos o cómo están en contacto con la carga durante
                    el empuje o la el arrastre.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img11.png" alt="11">
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <img src="/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img12.png" alt="12">
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <img src="/images/valoraciones/fisioterapia_laboral_cargas/fl_cargas_img13.png" alt="13">
            </div>
            @include('valorations.create_valoration_weight_lifting_row_colors',[
                'options'=>[
                    ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                    ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>3],
                    ['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>6]
                ],
                'show_label'=>false,
                'name'=>'valoration_labolar_physiotherapy',
                'count'=>$count++,
                'S_label'=>'35. Acoplamiento de la mano-carga',
                ]
                )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>36. Patrón del trabajo</h3>
                <p>Observar el trabajo, identificar si la operación es repetitiva (cinco o más traslados por minuto) y si el trabajador establece el ritmo de trabajo.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El trabajo no es repetitivo.</li>
                    <li>El ritmo de trabajo es fijado por el trabajador.</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El cuerpo está inclinado en la dirección del esfuerzo.</li>
                    <li>El torso está visiblemente flexionado o torcido.</li>
                    <li>Las manos están por debajo de la altura de la cadera.</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El trabajo es repetitivo.</li>
                    <li>No hay descansos formales u oportunidad de rotar los puestos de trabajo.</li>
                </ul>
            </div>
            @include('valorations.create_valoration_weight_lifting_row_colors',[
                'options'=>[
                    ['label'=>'Buena', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                    ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                    ['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>3]
                ],
                'show_label'=>false,
                'name'=>'valoration_labolar_physiotherapy',
                'count'=>$count++,
                'S_label'=>'36. Patrón del trabajo',
                ]
            )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>37. Distancia por viaje</h3>
                <ul>
                    <li>Determinar la distancia desde el principio hasta el final para un solo viaje.</li>
                    <li>Hacer una evaluación para el viaje más largo, si la operación no es repetitiva.</li>
                    <li>Determinar la distancia promedio para al menos cinco viajes, si la operación es repetitiva.</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>10m o menos</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Entre 10m y 30m</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Más de 30m</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Corta', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Media', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                ['label'=>'Larga', 'class'=>'color-value', 'color'=>'r','pts'=>3]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'37. Distancia por viaje',
            ]
        )
        </div>
        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>38 Condición del equipo auxiliar</h3>
                <p>Consultar el programa o manuales de mantenimiento y observar el estado general de conservación del equipo (condición de las ruedas, cojinetes y frenos).</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El mantenimiento está planificado y es preventivo.</li>
                    <li>El equipo está en buen estado de conservación.</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El mantenimiento ocurre sólo cuando surgen problemas.</li>
                    <li>El equipo está en un estado razonable de conservación.</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>El mantenimiento no está planificado (no hay un sistema claro en su lugar).</li>
                    <li>El equipo está en mal estado de convervación</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bueno', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>2],
                ['label'=>'Pobre', 'class'=>'color-value', 'color'=>'r','pts'=>4]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'38. Condición del equipo auxiliar',
            ]
        )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>39. Superficie del trabajo</h3>
                <p>Identificar la condición en que se encuentran las superficies de trabajo a lo largo de la ruta y determinar el nivel de riesgo utilizando los criterios siguientes.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Seco y limpio.</li>
                    <li>Nivelado.</li>
                    <li>Firme.</li>
                    <li>Buen estado (no dañado o irregular).</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Mayor parte seco y limpio</li>
                    <li>En pendiente (inclinación entre 3° y 5°).</li>
                    <li>Razonablemente firme bajo los pies (por ejemplo, alfombrado).</li>
                    <li>Mala condición (daños menores).</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Contaminado mojado y con escombros.</li>
                    <li>Pendiente pronunciada (inclinación superior a 5°).</li>
                    <li>Suave o inestable bajo los pies (grava, arena, barro).</li>
                    <li>Muy mal estado (daño severo).</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bueno', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>1],
                ['label'=>'Deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>4]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'39. Superficie del trabajo',
            ]
        )
        </div>

        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>40. Obstáculos a lo largo de la ruta</h3>
                <p>Verificar en la ruta si hay obstáculos.</p>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Sin obstáculos</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Un tipo de obstáculo, pero sin escalones o rampas empinadas</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Escalones, rampas empinadas o dos o mas tipos de obstáculos.</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bueno', 'class'=>'color-value', 'color'=>'g','pts'=>0],
                ['label'=>'Razonable', 'class'=>'color-value', 'color'=>'y','pts'=>2],
                ['label'=>'Deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>3]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'40. Obstáculos a lo largo de la ruta',
            ]
        )
        </div>
        <div class="row">
            <div class="col-lg-12 text-center label_third_total">
                <h3>41. Otros factores</h3>
                <ul>
                    <li>Identificar algún otro factor como</li>
                    <li>El equipo auxiliar o la carga es inestable</li>
                    <li>La carga es grande y obstruye la vista del trabajador de donde se está moviendo</li>
                    <li>El equipo auxiliar o la carga presenta bordes filosos, está caliente o es potencialmente</li>
                    <li>dañina al tacto</li>
                    <li>Hay malas condiciones de iluminación</li>
                    <li>Hay temperaturas extremas calientes o frías o alta humedad</li>
                    <li>Hay ráfagas de viento u otros movimientos fuertes del aire</li>
                    <li>El equipo de protección personal o la vestimenta hacen que el uso del equipo sea complicado</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>No hay factores presentes</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Un factor presente</li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <ul>
                    <li>Dos o más factores presentes</li>
                </ul>
            </div>
        @include('valorations.create_valoration_weight_lifting_row_colors',[
            'options'=>[
                ['label'=>'Bueno', 'class'=>'color-value', 'color'=>'g','pts'=>0],['label'=>'Media', 'class'=>'color-value', 'color'=>'y','pts'=>1],['label'=>'Pobre o deficiente', 'class'=>'color-value', 'color'=>'r','pts'=>3]
            ],
            'show_label'=>false,
            'name'=>'valoration_labolar_physiotherapy',
            'count'=>$count++,
            'S_label'=>'41. Otros factores',
            ]
        )
        </div>

        @include('valorations.section_total_load', [
            'label' => '42. Estimación del nivel de riesgo de actividades que impliquen empuje o arrastre de cargas con el uso de equipo auxiliar',
            'description' => '',
            'total_label' => 'label_third_total',
        ])
        {{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
        <a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
        {{Form::close()}}
        </div>
    </div>
@endsection
