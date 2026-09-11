@php
	$count=0;
@endphp
@extends("layouts.basic")
@section("content")
@push('javascript')
@endpush
{{Form::model($model,['route'=>['historia.store',$patient_id],'id' =>'form_fisioterapia'])}}
@if($model)
{{ method_field('PATCH') }}
@endif
    <div class="container">
    	<div class="row">
            <div class="col-lg-12">
                <strong>NOTA DE EVOLUCIÓN DE FISIOTERAPIA</strong>
            </div>
            <div class="col-lg-12">
                @include('valorations/modal_valoraciones_previas', [
                    'patient_id' => $patient->id,
                    'default'=>(!empty($valorations)?$valorations:null),
                     //'default'=>(!empty($valorations)?$valorations:null), // filter by user
                    'clinical_history'=>(($clinical_history)?$clinical_history:null),
                    'parameters' => [
                        [
                            'section'=>'physiotherapy_classic_objective',
                            'name'=>'Objetivo'
                        ],[
                            'section'=>'physiotherapy_classic_numero_de_sesion',
                            'name'=>'Numero de sesión'
                        ],[
                            'section'=>'physiotherapy_classic_actividades',
                            'name'=>'Actividades',
                        ],[
                            'section'=>'physiotherapy_classic_observaciones',
                            'name'=>'Observaciones',
                        ],
                        [
                            'section'=>'physiotherapy_classic_fisioterapeuta',
                            'name'=>'Fisioterapeuta',
                        ],
                    ]
                    ])
            </div>
            @php
                $hasPermission =(Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.edit')->count());
                $hasLastObjective = !empty($lastObjective);
                $enableObjectiveWrite = $hasPermission && !$hasLastObjective;
            @endphp
            <div class="col-lg-12">
                @if(!$enableObjectiveWrite && $lastObjective)
                    <input type="hidden" name="physiotherapy_classic_objective[{{$count + 1}}][json_values]" value="{{$lastObjective->json_values}}">
                @endif
                @include('clinical_histories.valoration_row',[
                    'name'=>'physiotherapy_classic_objective',
                    'disabled' => !$enableObjectiveWrite,
                    'S_label'=>'Objetivo',
                    'S_order'=>(++$count),
                    'default'=>(!empty($lastObjective)?collect([$lastObjective]):null),
                    ])
            </div>
            <div class="col-lg-12">
                <a href="{{route('historia.create', ['patient_id'=>$patient->id, 'id_clinical_history'=>'26', 'new_objective'=>1])}}" class="btn btn-primary">Nuevo objetivo</a>
            </div>
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'name'=>'physiotherapy_classic_numero_de_sesion',
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.edit')->count()) ? false : true,
                    'S_label'=>'Numero de sesión',
                    'rows'=>'3',
                    // 'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(!empty($valorations)?$valorations:null),
                    ])
            </div>
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_classic_actividades',
                    'S_label'=>'Actividades',
                    'rows'=>'3',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(!empty($valorations)?$valorations:null),
                    ])
            </div>
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_classic_observaciones',
                    'S_label'=>'Observaciones',
                    'rows'=>'3',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(!empty($valorations)?$valorations:null)
                    ])
            </div>
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_classic_fisioterapeuta',
                    'S_label'=>'Fisioterapeuta',
                    'rows'=>'3',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(!empty($valorations)?$valorations:null)
                    ])
            </div>
            @if(Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.create')->count())
                <div class="col-lg-12">
                    {{Form::submit('Agregar Valoración', ['class'=>'btn btn-info', 'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.edit')->count()) ? null : true,                ])}}
                </div>
            @endif
    	</div>
    </div>
{{Form::close()}}
@endsection
