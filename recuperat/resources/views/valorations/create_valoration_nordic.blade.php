@extends('layouts.basic')
@section('content')
{{Form::model($model,['route'=>['historia.store',$patient_id]])}}
@if($model)
{{ method_field('PATCH') }}
@endif
@push('css')
<style type="text/css">
	.ui-autocomplete {
	            max-height: 200px;
	            overflow-y: auto;
	            overflow-x: hidden;
	            padding-right: 20px;
	        } 
	input[type=radio], input[type=checkbox] {
	    border: 0px !important;
	    width: 20px !important;
	    height: 20px !important;
	}
</style>
@endpush
@push('javascript')
<script type="text/javascript">
	$(function(){
		$(".autocompletable_cie10").on('input',function(event){
			$(this).autocomplete({
				source: function( request, response ) {
			        $.ajax({
			          url: "/ajax_get_cie10/"+$(event.target).val(),
			          method:'get',
			          success: function( data ) {
			           		response(data);
			          	}
			        });
			      },
				minLength: 0,
				delay: 0,
				max:10,
                scroll:true,
				select:function(event, item){
			    }
			}).focus(function () {
			    $(this).autocomplete("search");
			});
		});
		
	});
</script>
@endpush
<div class="container note_container">
	<div class="row">
		<div class="col-xl-12">
			@if (session('modifiedSuccess'))
			    <div class="alert alert-success">
			        {{ session('modifiedSuccess') }}
			    </div>
			@endif
		</div>
	</div>
	@include('reports.row_print_report', ['laboralHeader' => true])
	<div class=row>
		<div class="col-xl-12">
			<h2><strong>Valoración Nórdico</strong></h2>
		</div>
		<div class="col-xl-12">
			<text>
				<p>
					Este cuestionario sirve para recopilar información sobre dolor, fatiga o disconfort en distintas zonas corporales. 
				</p>
				<p>
					Toda la información aquí recopilada será usada para fines de la investigación de posibles factores que causan fatiga en el trabajo.
				</p>
				<p>
					Los objetivos que se buscan son dos:
				</p>
				<ul>
					<li>Mejorar las condiciones en que se realizan las tareas, a fin de alcanzar un mayor bienestar para las personas, y</li>
					<li>Mejorar los procedimientos de trabajo, para hacerlos más fáciles y productivos.</li>
				</ul>
					Este cuestionario se basa en el Cuestionario Nórdico de Kuorinka, su propósito es detectar la existencia de síntomas iniciales que todavía no se han constituido como una enfermedad, ayuda para recopilar información sobre dolor, fatiga o molestias corporales.
			</text>
		</div>
	</div>
	<br>
	{{Form::hidden('patient_id',$patient_id)}}
	@include('valorations.nordic_valoration_sections.tendons_muscle_symptoms')
	<div class="row">
		<div class="col-xl-12">
			<br>
			{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
			<a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
		</div>
	</div>
</div>
{{Form::close()}}
@endsection