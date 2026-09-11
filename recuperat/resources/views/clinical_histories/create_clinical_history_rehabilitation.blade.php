@if (empty($client_view))
  @extends('layouts.basic')
@endif
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
        padding-right: 20px;
    }
</style>
@endpush
@push('javascript')
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
<script type="text/javascript">
	$(function(){
		$('#form_fisioterapia').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) {
		    e.preventDefault();
		    return false;
		  }
		});
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
@include('menus.sidebar_protocolos');
@php
	$count = 0;
@endphp
<div class="container note_container">
	<div class="row">
		<div class="col-md-12">
			@if (session('modifiedSuccess'))
			    <div class="alert alert-success">
			        {{ session('modifiedSuccess') }}
			    </div>
			@endif
		</div>
	</div>
    @php
        $resonsibleValoration = $valorations->where('name', 'like', 'Responsable')->first();
        $responsibleId = $resonsibleValoration ? $resonsibleValoration->json_values : null;
        $user = $responsibleId ? \App\User::find($responsibleId) : null;
    @endphp
	@include('reports.row_print_report', ['responsible' => $user ? $user->name : null, 'hideImage' => true])
	<div class=row>
		<div class="col-md-12">
			<h2><strong>HISTORIA CLÍNICA DE REHABILITACIÓN</strong></h2>
		</div>
	</div>
	{{Form::hidden('patient_id',$patient_id)}}
	{{Form::hidden('clinicalHistoryType','physiotherapy')}}
	<div class="row">
		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Antecedentes Heredo Familiares',
			'rows'=>'3',
			'textarea'=>true,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>

		<div class="col-md-12">
			<strong>Antecedentes Personales No Patológicos</strong>
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Alergias',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Grupo y RH',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Transfusiones',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Tabaquismo',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Alcohol',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Drogas',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Alimentación',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Suplementos',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Ejercicio/Deporte',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-12">
			<strong>Antecedentes Personales Patológicos</strong>
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Enfermedades de la Niñez',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Fracturas',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Traumatismos',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Cardiovasculares',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Endocrinos',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Oncológicos',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Musculo-Esqueléticos',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-4">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Cirguías',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<hr>
		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Medicación actual',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>

		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Motivo de Consulta',
			'rows'=>'2',
			'textarea'=>true,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>

		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Principio y evolución al estado actual',
			'rows'=>'2',
			'textarea'=>true,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>

		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Gabinete/Tratamiento',
			'rows'=>'2',
			'textarea'=>true,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>

		<div class="col-md-12">
			<strong>Signos Vitales</strong>
		</div>

		<div class="col-md-3">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'TA',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-3">
			@include('clinical_histories.valoration_row',[
			'name'=>'FC',
			'S_label'=>'FC',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-3">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'FR',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-3">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'TEMP',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<hr>

		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Exploración física',
			'rows'=>'3',
			'textarea'=>true,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>

		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Diagnóstico',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Tratamiento',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-12">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Labs/Gabinete',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-12">
			<strong>Terapia Física</strong>
		</div>
		<div class="col-md-2">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Sesiones',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-10">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Lugar',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-10">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Pronóstico',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-md-10">
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Próxima cita',
			'rows'=>'3',
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			<img src="/images/valoraciones/hc_rehabilitacion/body.png" class="img-fluid" style="height: 50vh">
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<h3>INDICACIONES</h3>
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Crioterapia',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Insuficiencia Renal',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Parafina',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Ultrasonido',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Terapia Interferencial',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Estímulos eléctricos',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Masaje',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Laser',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Ejercicioterapia activa',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Ejercicioterapia Pasiva',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Fuerza',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Elongación',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Marcha',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Bicicleta',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
		<div class="col-lg-6">
			<label></label>
			@include('clinical_histories.valoration_row',[
			'name'=>'clinical_history_rehabilitation',
			'S_label'=>'Otros',
			'rows'=>1,
			'textarea'=>false,
			'S_order'=>(++$count),
			'default'=>(!empty($valorations)?$valorations:null),])
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			<img src="/images/valoraciones/hc_rehabilitacion/last_body.png" class="img-fluid">
		</div>
	</div>
    <div class="row">
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
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('inputs.simple_select', ['value'=>[
                    'key' => 'clinical_history_rehabilitation',
                    'count' => $count,
                    'label' => 'Responsable',
                ],
                'options' => $users,
            ])
        </div>
    </div>
	<div class="row">
		<div class="col-md-12">
			<br>
			<a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
			{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
		</div>
	</div>
	</div>
</div>
{{Form::close()}}
@endsection
