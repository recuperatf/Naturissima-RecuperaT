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
			<h2><strong>HISTORIA CLÍNICA DE REFLEXOLOGÍA</strong></h2>
		</div>
	</div>
	@php
		$count=0;
	@endphp
	{{Form::hidden('patient_id',$patient_id)}}
	<div class="row">
		<div class="col-xl-12">
			@include('valorations.laboral_physiotherapy.valoration_row_options_laboral_evaluation',			[
						'name'=>'history_reflexology',
						'S_label'=>'SI TIENE O PADECE PERIÓDICAMENTE ALGUNO DE ESTOS PROBLEMAS MARQUE LA CASILLA CORRESPONDIENTE',
						'radio_options'=>[
                        'Acidez','Circulación','Gripe', 'Prostático',
                        'Acné','Colesterol','Hemorroides', 'Renales',
                        'Alergias de la piel','Contracturas','Hígado', 'Stress',
                        'Alergias respiratorias','Depresión','Hipertensión', 'Úlceras',
                        'Anemia','Diabetes','Insomnio', 'Vesíula',
                        'Artrosis','Diarrea','Insuficiencia Sexual', 'Zumbidos',
                        'Asma','Digestión lenta','Menopausia',
                        'Caída de cabello', 'Divertículos', 'Nerviosismo',
                        'Calambres', 'Dolor Menstrual', 'Obesidad',
                        'Cáncer', 'Edemas', 'Oculares',
                        'Cardiopatías', 'Encías', 'Osteoporosis',
                        'Cefalea', 'Envejecimiento', 'Pérdida de memoria',
                        'Celulitis', 'Estreñimiento', 'Psoriasis',
            ],
            'label_width' => '100%',
            'divClass' => ' ',
            'checkboxesFlexClass' => ' ',
						'S_order'=>(++$count),
						'checkbox'=>true,
						'default'=>($valorations)?
						$valorations->where('section','history_reflexology'):
						[]
						])
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
        <div class="col-lg-12"><h3>Espalda</h3></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <img src="/images/reflexology/espaldacompleta.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-12"><h3>Mano</h3></div>
        <div class="col-lg-4">
            <img src="/images/reflexology/Mano+derecha.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4">
            <img src="/images/reflexology/Mano+dorsal+(las+2+son+iguales).jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4">
            <img src="/images/reflexology/Mano+izquierda.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-12"><h3>Pie</h3></div>
        <div class="col-lg-4">
            <img src="/images/reflexology/a.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4">
            <img src="/images/reflexology/b.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4">
            <img src="/images/reflexology/c.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4">
            <img src="/images/reflexology/pief2.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4">
            <img src="/images/reflexology/pief3.jpg" alt="" style="heigth:auto !important; width:100% !important">
        </div>
        <div class="col-lg-4">
            <img src="/images/reflexology/pieF1.jpg" alt="" style="heigth:auto !important; width:100% !important">
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
