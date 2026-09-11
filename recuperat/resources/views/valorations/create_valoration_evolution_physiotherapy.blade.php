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
                <strong>EVOLUCIÓN SOAP</strong>
            </div>
            <div class="col-lg-12">
                @include('valorations/modal_valoraciones_previas', [
                    'default'=>(($valorations)?$valorations:null),
                     //'default'=>(($valorations)?$valorations:null), // filter by user
                    'clinical_history'=>(($clinical_history)?$clinical_history:null),
                    'parameters' => [
                        [
                            'section'=>'physiotherapy_valoration_subjective',
                            'name'=>'Subjetivo'
                        ],[
                            'section'=>'physiotherapy_valoration_objective',
                            'name'=>'Objetivo',
                        ],[
                            'section'=>'physiotherapy_valoration_anlysis',
                            'name'=>'Analisis',
                        ],
                        [
                            'section'=>'physiotherapy_valoration_plans',
                            'name'=>'Planes',
                        ],
                        ['section'=>'physiotherapy_valoration_vs_ta',
                                                        'name'=>'T/A'],
                        ['section'=>'physiotherapy_valoration_temperature',
                                                        'name'=>'TEMP'],
                        ['section'=>'physiotherapy_valoration_fca',
                                                        'name'=>'FCA'],
                        ['section'=>'physiotherapy_valoration_fre',
                                                        'name'=>'FRE'],
                    ]
                    ])
            </div>
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'name'=>'physiotherapy_valoration_subjective',
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'S_label'=>'Subjetivo',
                    'rows'=>'3',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null),
                    ])
            </div>
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_valoration_objective',
                    'S_label'=>'Objetivo',
                    'rows'=>'3',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null),
                    ])
            </div>  
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_valoration_anlysis',
                    'S_label'=>'Analisis',
                    'rows'=>'3',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null)
                    ])
            </div>  
            <div class="col-lg-6">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_valoration_plans',
                    'S_label'=>'Planes',
                    'rows'=>'3',
                    'textarea'=>true,
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null)
                    ])
            </div>  

            <div class="col-lg-3">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_valoration_vs_ta',
                    'S_label'=>'T/A',
                    'rows'=>'3',
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null)
                    ])
            </div>  
            <div class="col-lg-3">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_valoration_temperature',
                    'S_label'=>'TEMP',
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null)
                    ])
            </div>  
            <div class="col-lg-3">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_valoration_fca',
                    'S_label'=>'FCA',
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null)
                    ])
            </div>  
            <div class="col-lg-3">
                    @include('clinical_histories.valoration_row',[
                    'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? false : true,
                    'name'=>'physiotherapy_valoration_fre',
                    'S_label'=>'FRE',
                    'S_order'=>(++$count),
                //     'default'=>(($valorations)?$valorations:null)
                    ])
            </div>   
            @if(Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.create')->count())
            <div class="col-lg-12">
                {{Form::submit('Agregar Valoración', ['class'=>'btn btn-info', 'disabled' => (Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_evolution.edit')->count()) ? null : true,                ])}}
            </div>          
            @endif
    	</div>
    </div> 

{{Form::close()}}   
@endsection
