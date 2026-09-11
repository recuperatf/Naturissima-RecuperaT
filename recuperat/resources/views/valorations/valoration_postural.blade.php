@php
	$count=0;

	$segmentsCoronal = [
        'Cabeza' => ['Alineada', 'Rotada', 'Inclinada'],
        'Hombros' => ['Alineado', 'Ascendido', 'Descendido'],
        'Cadera' => ['Alineada', 'Ascendida', 'Descendida'],
        'Rodilla' => ['Alineada', 'Genu Valgo', 'Genu Varo'],
        'Pie' => ['Alineado', 'Eversión', 'Inversión'],
    ];
    $segmentsSagital = [
        'Cabeza' => [
            'Cráneo' => ['Alineada', 'Anterior', 'Posterior'],
            'Col. cervical' => ['Alineada', 'Anterior', 'Posterior'],
        ],
        'Tronco y Columna' => [
            'Hombros' => ['Alineada', 'Anterior', 'Posterior'],
            'Col. Dorsal' => ['Alineada', 'Anterior', 'Posterior'],
            'Col. Lumbar' => ['Alineada', 'Anterior', 'Posterior'],
            'Pelvis' => ['Alineada', 'Anterior', 'Posterior'],
        ],
        'Cadera' => [
            'Cadera' => ['Alineada', 'Anterior', 'Posterior'],
        ],
        'Rodillas' => [
            'Rodillas' => ['Alineada', 'Anterior', 'Posterior'],
        ],
    ];
@endphp
@extends("layouts.basic")
@section("content")
@push('javascript')
@endpush
@push('css')
<style>
    .section-img {
        width:50%;
        height: auto;
    }

    @media print {
        .table-bordered, .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
    }
</style>
@endpush
{{Form::model($model,['route'=>['historia.store',$patient_id]])}}
    <div class="container note_container">
    	@include('reports.row_print_report', ['hideImage' => true])
    	<div class="row">
    		<div class="col-xl-12">
    			<h4><strong>VALORACIÓN POSTURAL</strong></h4>
    		</div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6"><h3>Vista Anterior</h3></div>
                    <div class="col-sm-6">
                        <div class="row"><div class="col-md-6"><strong>Alineamiento</strong></div><div class="col-md-6"><strong>Segmentario</strong></div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <img src="/images/valoraciones/postural/coronal-anterior.png" alt="" class="section-img">
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3"><strong>Segmento</strong></div>
                            <div class="col-sm-3"><strong>Posición</strong></div>
                            <div class="col-sm-3"><strong>Derecha</strong></div>
                            <div class="col-sm-3"><strong>Izquierda</strong></div>
                        </div>
                        @foreach($segmentsCoronal as $name => $positions)
                            @foreach($positions as $position)
                                <div class="row">
                                    <div class="col-sm-3">{{$name}}</div>
                                    <div class="col-sm-3">{{$position}}</div>
                                    <div class="col-sm-3">
                                        @php
                                            $leftText = $name . " " . $position . " Izquierdo";
                                            $rightText = $name . " " . $position . " Derecho";
                                        @endphp
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $rightText,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $rightText):
                                            []
                                        ])
                                    </div>
                                    <div class="col-sm-3">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $leftText,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $leftText):
                                            []
                                        ])
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <!-- Vista Anterior -->
                <div class="col-sm-12 mt-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> '¿Escoliosis? Anterior',
                                            'S_label'=>'¿Escoliosis?',
                                            'placeholder'=>'',
                                            'label_show'=>true,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', '¿Escoliosis? Anterior'):
                                            []
                                        ])
                                    </td>
                                    <td>
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> 'en_c_o_en_s_anterior',
                                            'S_label'=>'En "S" o en "C"',
                                            'placeholder'=>'',
                                            'label_show'=>true,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', 'en_c_o_en_s_anterior'):
                                            []
                                        ])
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> 'right_scapula_anterior',
                                            'S_label'=>'Escápula derecha',
                                            'placeholder'=>'',
                                            'label_show'=>true,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', 'right_scapula_anterior'):
                                            []
                                        ])
                                    </td>
                                    <td>
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> 'left_scapula_anterior',
                                            'S_label'=>'Escápula izquierda',
                                            'placeholder'=>'',
                                            'label_show'=>true,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section','left_scapula_anterior'):
                                            []
                                        ])
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> 'diagnosis_observations_anterior',
                                            'S_label'=>'Diagnóstico y observaciones',
                                            'placeholder'=>'',
                                            'label_show'=>true,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', 'diagnosis_observations_anterior'):
                                            []
                                        ])
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vista Posterior -->
            <div class="col-sm-12 mt-5">
                <div class="row">
                    <div class="col-sm-6"><h3>Vista Posterior</h3></div>
                    <div class="col-sm-6"><div class="row"><div class="col-md-6"><strong>Alineamiento</strong></div><div class="col-md-6"><strong>Segmentario</strong></div></div></div>
                </div>
                <div class="row">
                    <div class="col-sm-6"><img src="/images/valoraciones/postural/coronal-posterior.png" alt="" class="section-img"></div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3"><strong>Segmento</strong></div>
                            <div class="col-sm-3"><strong>Posición</strong></div>
                            <div class="col-sm-3"><strong>Derecha</strong></div>
                            <div class="col-sm-3"><strong>Izquierda</strong></div>
                        </div>
                        @foreach($segmentsCoronal as $name => $positions)
                            @foreach($positions as $position)
                                <div class="row">
                                    <div class="col-sm-3">{{$name}}</div>
                                    <div class="col-sm-3">{{$position}}</div>
                                    <div class="col-sm-3">
                                        @php
                                            $leftText = $name . " " . $position . " Posterior Izquierdo";
                                            $rightText = $name . " " . $position . " Posterior Derecho";
                                        @endphp
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $rightText,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $rightText):
                                            []
                                        ])
                                    </div>
                                    <div class="col-sm-3">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $leftText,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $leftText):
                                            []
                                        ])
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    @include('clinical_histories.valoration_row',[
                                        'name'=> '¿Escoliosis? Posterior',
                                        'S_label'=>'¿Escoliosis?',
                                        'placeholder'=>'',
                                        'label_show'=>true,
                                        'S_order'=>(++$count),
                                        'default'=>($valorations)?
                                        $valorations->where('section', '¿Escoliosis? Posterior'):
                                        []
                                    ])
                                </td>
                                <td>
                                    @include('clinical_histories.valoration_row',[
                                        'name'=> 'en_c_o_en_s_posterior',
                                        'S_label'=>'En "S" o en "C"',
                                        'placeholder'=>'',
                                        'label_show'=>true,
                                        'S_order'=>(++$count),
                                        'default'=>($valorations)?
                                        $valorations->where('section', 'en_c_o_en_s_posterior'):
                                        []
                                    ])
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @include('clinical_histories.valoration_row',[
                                        'name'=> 'right_scapula_posterior',
                                        'S_label'=>'Escápula derecha',
                                        'placeholder'=>'',
                                        'label_show'=>true,
                                        'S_order'=>(++$count),
                                        'default'=>($valorations)?
                                        $valorations->where('section', 'right_scapula_posterior'):
                                        []
                                    ])
                                </td>
                                <td>
                                    @include('clinical_histories.valoration_row',[
                                        'name'=> 'left_scapula_posterior',
                                        'S_label'=>'Escápula izquierda',
                                        'placeholder'=>'',
                                        'label_show'=>true,
                                        'S_order'=>(++$count),
                                        'default'=>($valorations)?
                                        $valorations->where('section','left_scapula_posterior'):
                                        []
                                    ])
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                    @include('clinical_histories.valoration_row',[
                                        'name'=> 'diagnosis_observations_posterior',
                                        'S_label'=>'Diagnóstico y observaciones',
                                        'placeholder'=>'',
                                        'label_show'=>true,
                                        'S_order'=>(++$count),
                                        'default'=>($valorations)?
                                        $valorations->where('section','diagnosis_observations_posterior'):
                                        []
                                    ])
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Vista lateral derecha -->
            <div class="col-sm-12 mt-5">
                <div class="row">
                    <div class="col-sm-6"><h3>Vista Lateral Derecha</h3></div>
                    <div class="col-sm-6"><div class="row"><div class="col-md-6"><strong>Alineamiento</strong></div><div class="col-md-6"><strong>Segmentario</strong></div></div></div>
                </div>
                <div class="row">
                    <div class="col-sm-6"><img src="/images/valoraciones/postural/sagital-right.png" alt="" class="section-img"></div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6"><strong>Segmento</strong></div>
                            <div class="col-sm-2"><strong>Alineado</strong></div>
                            <div class="col-sm-2"><strong>Anterior</strong></div>
                            <div class="col-sm-2"><strong>Posterior</strong></div>
                        </div>
                        @foreach($segmentsSagital as $segmentName => $subsegment)
                            @foreach($subsegment as $subsegmentName => $positions)
                                <div class="row">
                                    <div class="col-sm-3">{{$segmentName}}</div>
                                    <div class="col-sm-3">{{$subsegmentName}}</div>
                                    @php
                                        $alin = $segmentName . " " . $subsegmentName . " Lateral Derecho";
                                        $ant = $segmentName . " " . $subsegmentName . " Lateral Derecho";
                                        $post = $segmentName . " " . $subsegmentName . " Lateral Derecho";
                                    @endphp
                                    <div class="col-sm-2">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $alin,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $alin):
                                            []
                                        ])
                                    </div>
                                    <div class="col-sm-2">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $ant,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $ant):
                                            []
                                        ])
                                    </div>
                                    <div class="col-sm-2">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $post,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $post):
                                            []
                                        ])
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <h4>Grados</h4>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_right_grades',
                                'S_label'=>'Cervical',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_right_grades'):
                                []
                            ])
                        </td>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_right_grades',
                                'S_label'=>'Dorsal',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_right_grades'):
                                []
                            ])
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_right_grades',
                                'S_label'=>'Lumbar',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_right_grades'):
                                []
                            ])
                        </td>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_right_grades',
                                'S_label'=>'Sacra',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_right_grades'):
                                []
                            ])
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_right_indexes',
                                'S_label'=>'Índice Cifótico',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_right_indexes'):
                                []
                            ])
                        </td>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_right_indexes',
                                'S_label'=>'Índice Lordótico',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_right_indexes'):
                                []
                            ])
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_right_observations',
                                'S_label'=>'Diagnóstico y Observaciones',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_right_observations'):
                                []
                            ])
                        </td>
                    </tr>
                </table>
            </div>
            <!-- Vista lateral Izquierda -->
            <div class="col-sm-12 mt-5">
                <div class="row">
                    <div class="col-sm-6"><h3>Vista Lateral Izquierda</h3></div>
                    <div class="col-sm-6"><div class="row"><div class="col-md-6"><strong>Alineamiento</strong></div><div class="col-md-6"><strong>Segmentario</strong></div></div></div>
                </div>
                <div class="row">
                    <div class="col-sm-6"><img src="/images/valoraciones/postural/sagital-left.png" alt="" class="section-img"></div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6"><strong>Segmento</strong></div>
                            <div class="col-sm-2"><strong>Alineado</strong></div>
                            <div class="col-sm-2"><strong>Anterior</strong></div>
                            <div class="col-sm-2"><strong>Posterior</strong></div>
                        </div>
                        @foreach($segmentsSagital as $segmentName => $subsegment)
                            @foreach($subsegment as $subsegmentName => $positions)
                                <div class="row">
                                    <div class="col-sm-3">{{$segmentName}}</div>
                                    <div class="col-sm-3">{{$subsegmentName}}</div>
                                    @php
                                        $alin = $segmentName . " " . $subsegmentName . " Lateral Izquierdo";
                                        $ant = $segmentName . " " . $subsegmentName . " Lateral Izquierdo";
                                        $post = $segmentName . " " . $subsegmentName . " Lateral Izquierdo";
                                    @endphp
                                    <div class="col-sm-2">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $alin,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $alin):
                                            []
                                        ])
                                    </div>
                                    <div class="col-sm-2">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $ant,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $ant):
                                            []
                                        ])
                                    </div>
                                    <div class="col-sm-2">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=> $post,
                                            'S_label'=>'Segment',
                                            'placeholder'=>'',
                                            'label_show'=>false,
                                            'S_order'=>(++$count),
                                            'default'=>($valorations)?
                                            $valorations->where('section', $post):
                                            []
                                        ])
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <h4>Grados</h4>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_left_grades',
                                'S_label'=>'Cervical',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_left_grades'):
                                []
                            ])
                        </td>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_left_grades',
                                'S_label'=>'Dorsal',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_left_grades'):
                                []
                            ])
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_left_grades',
                                'S_label'=>'Lumbar',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_left_grades'):
                                []
                            ])
                        </td>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_left_grades',
                                'S_label'=>'Sacra',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_left_grades'):
                                []
                            ])
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_left_indexes',
                                'S_label'=>'Índice Cifótico',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_left_indexes'):
                                []
                            ])
                        </td>
                        <td>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_left_indexes',
                                'S_label'=>'Índice Lordótico',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_left_indexes'):
                                []
                            ])
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            @include('clinical_histories.valoration_row',[
                                'name'=> 'postural_valoration_sagital_left_observations',
                                'S_label'=>'Diagnóstico y Observaciones',
                                'placeholder'=>'',
                                'label_show'=>true,
                                'S_order'=>(++$count),
                                'default'=>($valorations)?
                                $valorations->where('section', 'postural_valoration_sagital_left_observations'):
                                []
                            ])
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <br>
                {{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
                <a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
            </div>
        </div>
    </div>
@endsection
