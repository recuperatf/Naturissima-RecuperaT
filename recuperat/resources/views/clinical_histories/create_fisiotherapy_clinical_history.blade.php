@extends('layouts.basic')
@section('content')
{{Form::model($model,['route'=>['historia.store',$patient_id],'id' =>'form_fisioterapia'])}}
@if($model)
{{ method_field('PATCH') }}
@endif
@push('css')
<style type="text/css">
	.ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 250px;
    }

</style>
@endpush
@push('javascript')
@endpush
@include('menus.sidebar_protocolos');
@include('menus.sidebar_home_physiotherapy_programs');
@include('menus.sidebar_therapeutic_plans');
@include('menus.sidebar_diagnosis_plans');
<div class="container note_container">
	@include('reports.row_print_report', ['show_created_at' => true, 'hideImage' => true])
	<div class="row">
		<div class="col-xl-12">
			@if (session('modifiedSuccess'))
			    <div class="alert alert-success">
			        {{ session('modifiedSuccess') }}
			    </div>
			@endif
		</div>
	</div>
	<div class=row>
		<div class="col-xl-12">
			<h2><strong>HISTORIA CLÍNICA DE FISIOTERAPIA</strong></h2>
		</div>
	</div>
	{{Form::hidden('patient_id',$patient_id)}}
	{{Form::hidden('clinicalHistoryType','physiotherapy')}}
	@include('clinical_histories.phisiotherapy_sections.cause_of_appoinment')
	@include('clinical_histories.phisiotherapy_sections.pain')
	@include('clinical_histories.phisiotherapy_sections.evolution')
	@include('clinical_histories.phisiotherapy_sections.vital_signs')
	@include('clinical_histories.phisiotherapy_sections.antecedents_no_patological')
	@include('clinical_histories.phisiotherapy_sections.antecedents')
	@include('clinical_histories.phisiotherapy_sections.antecedents_familial')
	@include('clinical_histories.phisiotherapy_sections.valorations_postural')
	@include('clinical_histories.phisiotherapy_sections.valorations_exploración_muscular')
	@include('clinical_histories.phisiotherapy_sections.valoration_cicatriz_quirurgica')
	@include('clinical_histories.phisiotherapy_sections.valoration_gait')
	@include('clinical_histories.phisiotherapy_sections.valorations_exploración_traslations')
	@include('clinical_histories.phisiotherapy_sections.valoration_muscular_strenght')
	@include('clinical_histories.phisiotherapy_sections.valoration_goniometry')
	@include('clinical_histories.phisiotherapy_sections.valorations_exploración_neurológica')
	@include('clinical_histories.phisiotherapy_sections.valoration_cranial_nerves')
	@include('clinical_histories.phisiotherapy_sections.neurodinamy')
	@include('clinical_histories.phisiotherapy_sections.valoration_spasticity')
	@include('clinical_histories.phisiotherapy_sections.valoration_hipotony')
	@include('clinical_histories.phisiotherapy_sections.aesthetics')
	@include('clinical_histories.phisiotherapy_sections.valoration_gineco_obstetric')
	@include('clinical_histories.phisiotherapy_sections.valoration_diagnosis')
	@include('clinical_histories.phisiotherapy_sections.specific_tests')

	<div class="row no_print">
		<div class="col-lg-12">
			<h4><strong>Imágenes/Documentos</strong></h4>
			<input type="file" class="form-controller" name="file" id="file">
			<button id="addFile" type="button" class="btn btn-primary">Agregar</button>
			<ul>
            @if(!empty($files))
                @foreach($files as $file)
                    <li>
                        <a href="/historia/download_file/{{$file['path']}}/{{$file['name']}}">{{$file['name']}}</a>
                        <button class="btn btn-danger delete_file" type="button" file_path="{{$file['path']}}">Eliminar</button>
                    </li>
                @endforeach
            @endif
			</ul>
			<script>
				$(() => {
					$(".delete_file").click((event) => {
						if (!confirm('Al eliminar un archivo, la página se va a refrescar, ¿desea continuar?')) return
						const btn = $(event.target)
						btn.attr('disabled', true)
						file_path = btn.attr('file_path')
						$.ajax({
								url : `/historia/remove_file/${file_path}`,
								type : 'DELETE',
								processData: false,  // tell jQuery not to process the data
								contentType: false,  // tell jQuery not to set contentType
								success : function(data) {
										alert('Elminado con éxito!');
										location.reload()
								},
								failure : function(data) {
										btn.attr('disabled', false)
										alert('Elminado con éxito!');
										location.reload()
								}
							});
					})
					$("#addFile").click((event) => {
						file = $("#file").prop('files')[0];
						if (file){
							if (!confirm('Al agregar un archivo, la página se va a refrescar, ¿desea continuar?')) return
							$(event.target).attr("disabled", true)
							console.log(file)
							var formData = new FormData();
							formData.append('file', file);
							formData.append('patient_id', {{$patient_id}});
							$.ajax({
								url : '/historia/add_file',
								type : 'POST',
								data : formData,
								processData: false,  // tell jQuery not to process the data
								contentType: false,  // tell jQuery not to set contentType
								success : function(data) {
										alert('Guardado con éxito!');
										location.reload()
								},
								failure: function () {
									$(event.target).attr("disabled", false)
								}
							});

						}
					})
				})
			</script>
		</div>
	</div>
	<div class="row">
		<script type="text/javascript">
			$(function(){
				$("#btn_add_image_workup").click(function(){
					new_image_workup=$('#image_workup_example').clone();
					new_image_workup.removeAttr('id');
					new_image_workup.removeAttr('disabled');
					new_image_workup.removeAttr('style');
					new_image_workup.appendTo($("#div_image_workup"));
				});
			});
		</script>
		{{-- <div class='col-lg-12'>
			<h3 style="display: inline">Estudios de Imagen</h3><button  id="btn_add_image_workup" type="button" class="btn btn-primary"><i class="fas fa-plus"></i></button>
		</div>
		<div class='col-lg-12' id="div_image_workup">
			{{Form::file('image_workup[]',['id'=>'image_workup_example','placeholder'=>'Estudios de Imagen', 'disabled'=>true, 'style'=>'display:none'])}}
		</div> --}}
	</div>
	<div class="row">
		<div class="col-xl-12">
			<br>
			@if(Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_clinical_history.create')->count())
				{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
			@endif
			<a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
		</div>
	</div>
</div>
{{Form::close()}}
@endsection
