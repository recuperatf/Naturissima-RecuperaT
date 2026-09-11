@if (empty($client_view))
  @extends('layouts.basic')
@endif
@push('javascript')
@php

@endphp
<script type="text/javascript">
	var array_decision = [];
	var active_decision = 0;
	$(function(){
		window.array_decision = JSON.parse('{!!$json_decisions!!}');
		// var last_element_pos = (int) array_decision.length-1;
		// console.log(last_element_pos);
		console.log('a');
		let last_element = (array_decision[array_decision.length - 1]);
		window.active_decision = array_decision.length - 1;
		$("#decision_text").html(last_element.text);
		$("#responsible_text").html(`{{$patient->responsible->name}}`);
	});
	function changeDecisionText(previous){
		if(previous && active_decision >= 1){
			window.active_decision--;
		} else if (!previous && window.active_decision <= (window.array_decision.length - 1)){
			window.active_decision++;
		}
		var decision = array_decision[active_decision];
		$("#decision_text").html(decision.text);
		$("#decision_text").html(decision.text);
		$("#responsible_text").html(decision.user.name);
	}
</script>
@endpush
@section('content')
<div class="container">
	<div class="modal" tabindex="-1" role="dialog" id="modal_previous">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Recetas</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body note_container">
			  @include('reports.row_print_report', ['hide_header' => true, 'hide_header' => true])
			  <label for="responsible_text" class="no_print"><strong>Responsable:</strong></label>
			  <p id="responsible_text" class="no_print"></p>
	      	<label for="decision_text"><strong>Contenido:</strong></label>
	        <p id="decision_text"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" onclick="changeDecisionText(true)"><span><i class="fas fa-angle-left"></i></span></button>
	        <button type="button" class="btn btn-primary" onclick="changeDecisionText(false)"><span><i class="fas fa-angle-right"></i></span></button>
	        <button type="button" class="btn btn-primary">Imprimir</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="row">
    	<div class="col">
    		<button class="btn btn-primary" data-toggle="modal" data-target="#modal_previous">Ver Anteriores</button>
    	</div>
    </div>
	{{Form::open(['route' => 'decision.store'])}}
	    <div class="row">
	        @include('patient.patient_header', ['patient' => (!empty($patient)? $patient: false)])
            {{Form::hidden('patient_id', $patient->id)}}
            <div class="col-12">
                <h3>Orden de Laboratorio</h3>
            </div>
            @foreach($studies as $study)
                <div class="col-md-4">
                    {{Form::checkbox($study['name'],false,null,['id'=>$study['name']])}}
                    {{Form::label($study['name'], $study['label'])}}
                </div>
            @endforeach
	    </div>
	    <div class="row">
	    	<div class="col-md-12">
	    	    {{Form::submit('Agregar Orden', ['class' => 'btn btn-primary'])}}
	    	</div>
	    </div>
    {{Form::close()}}
</div>
@endsection
