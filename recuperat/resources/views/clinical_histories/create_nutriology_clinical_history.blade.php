@if (empty($client_view))
  @extends('layouts.basic')
@endif
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
	            /* prevent horizontal scrollbar */
	            overflow-x: hidden;
	            /* add padding to account for vertical scrollbar */
	            padding-right: 20px;
	        }
	input[type=radio] {
	    border: 0px !important;
	    width: 20px !important;
	    height: 20px !important;
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
	@include('reports.row_print_report', ['hideImage' => true])
	<div class=row>
		<div class="col-xl-12">
			<h2><strong>HISTORIA CLÍNICA DE NUTRICIÓN</strong></h2>
		</div>
	</div>
	{{Form::hidden('patient_id',$patient_id)}}
	@include('clinical_histories.nutriology_sections.valorations_appoinment_reason_nutriology')
	@include('clinical_histories.nutriology_sections.antecedents_familial_nutriology')
	@include('clinical_histories.nutriology_sections.valoration_physical_examination_nutriology')
	@include('clinical_histories.nutriology_sections.valoration_food_frequency_nutriology')
	@include('clinical_histories.nutriology_sections.valoration_dietetic_antecedents_nutriology')
	@include('clinical_histories.nutriology_sections.valoration_24_hour_abstract_nutriology', ['abstract_24' => !empty($valorations)?$valorations:null])
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
		<div class="col-xl-12">
			<br>
			{{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
			<a href="{{route('pacientes.index')}}" class="btn btn-light">Atras</a>
		</div>
	</div>
</div>
{{Form::close()}}
@endsection
