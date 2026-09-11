@extends("layouts.basic")
@section("content")
@push('javascript')
	<script type="text/javascript">
		$(function(){
				$(".a_clinical_history").click(function(event){
					console.log('I am clicking');
					event.preventDefault();
					$('#modal_select_history').modal('toggle');
					$('#modal_select_history .a_specific_clinical_history').attr("href",$(this).attr("href"));
					$.each($('#modal_select_history .a_specific_clinical_history'),function(key, element){
						element=$(element);
						element.attr("href",element.attr("href")+"&id_clinical_history="+element.attr("id_clinical_history"));
					});
				});
				$(".a_laboral_valoration").click(function(event){
					event.preventDefault();
					$('#modal_select_valoration').modal('toggle');
					$('#modal_select_valoration .a_specific_clinical_history').attr("href",$(this).attr("href"));
					$.each($('#modal_select_valoration .a_specific_clinical_history'),function(key, element){
						element=$(element);
						element.attr("href",element.attr("href")+"&id_clinical_history="+element.attr("id_clinical_history"));
					});
				});
				$(".a_phisiotherapy_valoration").click(function(event){
					event.preventDefault();
					$('#modal_select_phisiotherapy_valoration').modal('toggle');
					$('#modal_select_phisiotherapy_valoration .a_specific_clinical_history').attr("href",$(this).attr("href"));
					$.each($('#modal_select_phisiotherapy_valoration .a_specific_clinical_history'),function(key, element){
						element=$(element);
						element.attr("href",element.attr("href")+"&id_clinical_history="+element.attr("id_clinical_history"));
					});
				});
		});
	</script>
@endpush
@if(Auth::user()->rol->name=='admin')
<div class="modal" id="modal_select_history" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Con qué deseas trabajar?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
        	<div class="row">
        		<div class="col-lg-12">
        			<h3>Historias Clínicas</h3>
        		</div>
                @if(auth()->user()->rol->name="fisioterapeuta" || auth()->user()->rol->name=="admin")
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=1>Fisioterapia</a>
        		</div>
                @endif
                @if(auth()->user()->rol->name="nutriologo" || auth()->user()->rol->name=="admin")
									<div class="col-lg-4">
										<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=2>Nutrición</a>
									</div>
                @endif
                @if(auth()->user()->rol->name=="traumatologo" || auth()->user()->rol->name=="admin")
									<div class="col-lg-4">
										<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=3>Traumatología</a>
									</div>
                @endif
                @if(auth()->user()->rol->name=="rehabilitador" || auth()->user()->rol->name=="admin")
                    <div class="col-lg-4">
                        <a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=20>Rehabilitador</a>
                    </div>
                @endif
								@if(auth()->user()->rol->name="fisioterapeuta" || auth()->user()->rol->name=="admin")
									<div class="col-lg-4">
										<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=24>Reflexología</a>
									</div>
								@endif
								@if(auth()->user()->rol->name="fisioterapeuta" || auth()->user()->rol->name=="admin")
								<div class="col-lg-4">
									<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=25>Acupuntura</a>
								</div>
							@endif
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endif
@if(Auth::user()->rol->name=='admin')
<div class="modal" id="modal_select_valoration" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Con qué deseas trabajar?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            @if(auth()->user()->rol->name=="admin")
        	<div class="row">
        		<div class="col-lg-12">
        			<h3>Valoraciones de fisioterapia laboral</h3>
        		</div>
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=5>Nórdico</a>
        		</div>
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=6>Mano</a>
        		</div>
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=7>Codo</a>
        		</div>
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=8>Hombro</a>
        		</div>
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=9>Conlumna Cervical</a>
        		</div>
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=10>Columna Lumbar</a>
        		</div>
                <div class="col-lg-4">
                    <a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=22>Rodilla</a>
                </div>
                <div class="col-lg-4">
                    <a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=23>Pie</a>
                </div>
        		<div class="col-lg-4">
        			<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=11>Cargas</a>
        		</div>
        	</div>
                @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endif
@if(Auth::user()->rol->name=='admin')
<div class="modal" id="modal_select_phisiotherapy_valoration" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Selecciona una valoración</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
					@if(auth()->user()->rol->name=="admin")
						<div class="row">
							<div class="col-lg-4">
								<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=4>Muscular</a>
							</div>
							<div class="col-lg-4">
									<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=12>Postural</a>
							</div>
							<div class="col-lg-4">
									<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=13>Marcha</a>
							</div>
							<div class="col-lg-4">
									<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=14>Goniometría</a>
							</div>
							<div class="col-lg-4">
									<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=17>Funcional</a>
							</div>
							<div class="col-lg-4">
									<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=18>Deportiva</a>
							</div>
							<div class="col-lg-4">
									<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=19>Pediatrica</a>
							</div>
								<div class="col-lg-4">
										<a class='btn btn-sm btn-primary a_specific_clinical_history' id_clinical_history=21>Fisio Ortopedica</a>
								</div>
							</div>
							@endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endif
	<div class="container">
        <div class="row">
            <div class="col-lg-5">
                {{Form::open(['url'=>action('PatientController@index'),'method'=>'GET'])}}
                    {{Form::text('search',null,['placeholder'=>'Nombre del paciente','class'=>'form-control','style'=>'display:inline; width:80%;'])}}
                    {{Form::text('laboral', null ,['type'=>'hidden'])}}
                    <button type="submit" class="btn btn-primary" style="display: inline;"><span><i class="fas fa-search"></i></span></input>
                {{Form::close()}}
            </div>
        </div>
			@if (session('createdPatient'))
		<div class="row">
			    <div class="alert alert-success" role="alert">
			        {{ session('createdPatient') }}
			    </div>
		</div>
			@endif
		<div class="row">
			<a class="btn btn-primary" href="{{route('pacientes.create')}}">Añadir Paciente</a>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<table>
					@foreach($collection as $model)
						<tr>
							<td>
								<strong><a href="{{route('pacientes.edit',[$model->id])}}">{{$model->full_name}}</a></strong>
								<br>
								<a class='btn btn-sm btn-secondary' href= "{{route('laboratory_order.create', ['patient_id' => $model->id])}}">Decisión Clínica (Laboratorio/Imagen)</a>
								<a class='btn btn-sm btn-secondary' href= "{{route('history.decision.create', ['patient_id' => $model->id])}}">Decisión Clínica (Receta)</a>
								{{-- <a class='btn btn-sm btn-secondary a_specific_clinical_history' href= "{{route('laboratoryorder.create', ['patient_id' => $model->id])}}">Orden de Estudio</a> --}}
								<a class='btn btn-sm btn-warning a_specific_clinical_history' href= "{{route('historia.create', ['patient_id' => $model->id, 'id_clinical_history' => 15])}}">Nota de evolución</a>
								<a class='btn btn-sm btn-primary a_clinical_history' href="{{route('historia.create', ['patient_id'=>$model->id,
                  'id_clinical_history' => (auth()->user()->rol->name=='rehabilitador')?20:null
                ])}}">Historia Clínica</a>
								<a class='btn btn-sm btn-success a_laboral_valoration' style="color: white;" href="{{route('historia.create', ['patient_id'=>$model->id,
									'id_clinical_history' => (auth()->user()->rol->name=='rehabilitador')?20:null
									])}}">Fisioterapia Laboral</a>
								<a class='btn btn-sm btn-success a_phisiotherapy_valoration' style="color: white;" href="{{route('historia.create', ['patient_id'=>$model->id,
									'id_clinical_history' => (auth()->user()->rol->name=='rehabilitador')?20:null
									])}}">Valoraciones de fisioterapia</a>
								<br/>
								<small>Edad: {{$model->age}} años</small>
								<br/>
								<small>Fecha de nacimiento: {{$model->birth_date}}</small>
								<br/>
								<small>Ocupación:{{($model->occupation)?$model->occupation:'N/D'}}</small>

							</td>
							<td>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection