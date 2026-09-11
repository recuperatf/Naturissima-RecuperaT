@php
$count=0;
@endphp
@extends("layouts.basic")
@section("content")
@push('javascript')
@endpush
<script type="text/javascript">
    $(function(){
        $("#btn_add_excercise").click(function(){
            copied_row = $("#row_excersises").clone();
            all = $(".row_excersises");
            $(".row_excersises").last().after(copied_row);
        });
        $("#btn_add_med").click(function(){
            copied_row = $("#row_med").clone();
            $(".row_med").last().after(copied_row);
        });
    });
</script>
<div class="container note_container">
    @include('reports.row_print_report')
 <div class="row">
    <div class="col-lg-12">
        <strong>PROGRAMA FISIOTERAPÉUTICO EN CASA</strong>
    </div>
</div>
<div class="row">
    <div class="col-lg-12"><strong>EJERCICIOS</strong> <button type="button" id="btn_add_excercise" class="btn btn-primary" target="#row_excersises"> Añadir</button></div>
</div>


<div class="row row_excersises" id="row_excersises">           
    <div class="col-lg-4">
        @include('clinical_histories.valoration_row',[
            'name'=>'home_physiotherapy_program_exercises',
            'S_label'=>'Descripción',
            'S_order'=>(++$count),
            'default'=>(($valorations)?$valorations:null),])
        </div>
        <div class="col-lg-2">
            @include('clinical_histories.valoration_row',[
                'name'=>'home_physiotherapy_program_exercises',
                'S_label'=>'Series',
                'S_order'=>(++$count),
                'default'=>(($valorations)?$valorations:null),])
            </div>
            <div class="col-lg-2">
                @include('clinical_histories.valoration_row',[
                    'name'=>'home_physiotherapy_program_exercises',
                    'S_label'=>'Repeticiones',
                    'S_order'=>(++$count),
                    'default'=>(($valorations)?$valorations:null),])
                </div>
                <div class="col-lg-4">
                    @include('clinical_histories.valoration_row',[
                        'name'=>'home_physiotherapy_program_exercises',
                        'S_label'=>'Descripción',
                        'S_order'=>(++$count),
                        'default'=>(($valorations)?$valorations:null),])
                    </div>            
                </div>
                <div class="row row_med">
                    <div class="col-lg-12"><strong>AGENTES FISICOS Y MEDICAMENTOS</strong> <button type="button" id="btn_add_med" class="btn btn-primary" target="#row_meds"> Añadir</button></div>
                </div>
                <div class="row" id="row_med" >           
                    <div class="col-lg-2">
                        @include('clinical_histories.valoration_row',[
                            'name'=>'home_physiotherapy_program_meds',
                            'S_label'=>'Nombre',
                            'S_order'=>(++$count),
                            'default'=>(($valorations)?$valorations:null),])
                        </div>
                        <div class="col-lg-8">
                            @include('clinical_histories.valoration_row',[
                                'name'=>'home_physiotherapy_program_meds',
                                'S_label'=>'Indicación',
                                'S_order'=>(++$count),
                                'default'=>(($valorations)?$valorations:null),])
                            </div>
                            <div class="col-lg-2" >
                                @include('clinical_histories.valoration_row',[
                                    'name'=>'home_physiotherapy_program_meds',
                                    'S_label'=>'Precauciones',
                                    'S_order'=>(++$count),
                                    'default'=>(($valorations)?$valorations:null),])
                                </div>          
                            </div>
                            <div class="row">
                                <div class="col-lg-12"><strong>CONTRAINDICACIONES</strong>
                                    </div>    
                                    <div class="col-lg-12">
                                        @include('clinical_histories.valoration_row',[
                                            'name'=>'home_physiotherapy_program_contraindications',
                                            'S_label'=>'contraindications',
                                            'label_show' => false,
                                            'textarea' => true,
                                            'rows' => 3,
                                            'S_order'=>(++$count),
                                            'default'=>(($valorations)?$valorations:null),])
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12"><strong>MASAJE</strong>
                                        </div> 
                                        <div class="col-lg-12">
                                            @include('clinical_histories.valoration_row',[
                                                'name'=>'home_physiotherapy_program_masage',
                                                'S_label'=>'masage',
                                                'label_show' => false,
                                                'textarea' => true,
                                                'rows' => 3,
                                                'S_order'=>(++$count),
                                                'default'=>(($valorations)?$valorations:null),])
                                            </div>
                                    </div>
</div>    
@endsection