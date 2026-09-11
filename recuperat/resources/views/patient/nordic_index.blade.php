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

<div class="container">
        <div class="row">
					<h2>Evaluación Nórdiko</h2>
				</div>
        <div class="row">
            <div class="col-lg-5">
                {{Form::open(['url'=>action('PatientController@index'),'method'=>'GET'])}}
										{{Form::hidden('laboral', '5')}}
                    {{Form::text('search',null,['placeholder'=>'Nombre del trabajador','class'=>'form-control','style'=>'display:inline; width:80%;'])}}
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
			<div class="col-lg-12">
				<table>
					@foreach($collection as $model)
						<tr>
							<td>
								<strong><a href="{{route('pacientes.edit',[$model->id])}}">{{$model->full_name}}</a></strong>
								<br>
								<a class='btn btn-sm btn-secondary' href= "{{route('historia.create.choose', ['stop_extend'=>false, 'patient_id' => $model->id, 'id_clinical_history'=>5])}}">Evaluar este paciente</a>
								<br>
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
