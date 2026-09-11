@extends('layouts.basic')
@push('javascript')
@if(!empty($stop_extend))
<script type="text/javascript">
	window.onload= hideStuff;
	function hideStuff(){
		$('body > :not(form)').hide();
		$('body > div').css('cssText', 'display:none !important;');
	}
</script>
@else
	<script type="text/javascript">
		$(()=>{
			changeH4Names();
		});
		function changeH4Names(){
			$('h4[no_count=0]').each(function(key, val){
				$(val).html($(val).html().replace(/.+\.\s/,''));
				if($(val).attr('no_count') == 1) return;
				$(val).prepend((key+1)+'. ');
			});
		}
	</script>
@endif
@stack('javascript')
<script src="https://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
	$(function(){
		$("#product_img").change(readURL);
		$("#select_product_category_id").change(function(event){
			console.log($(this).val());
			if($(this).val()==1){
				showFile(true, {{(!(empty($product))?"false":"true")}});
			}else{
				showFile(false);
			}
		});
		$("#select_product_category_id").trigger("change");
		$("#btn_enable_switch_files").click(enableFile);
    $(".btn_print").attr('view', 1);
    $(".btn_print").trigger('click');
	});
	function unsetImg(event){
		event.preventDefault();
		target=$($(event.target).attr("target"));
		$("#img_preview").hide();
		target.val('');
		$("#hidden_removePicture").val(1);

	}
	function showFile(show, enable=true){
		if(show){
			$("#div_select_file").show();
			if(enable){
				$("#div_select_file").children("input").removeAttr("disabled");
			}else{
				$("#div_select_file").children("input").attr("disabled",'true');
			}
		}else{
			$("#div_select_file").hide();
			$("#div_select_file").children("input").attr("disabled","true");
		}
	}
	function readURL() {
		$("#hidden_removePicture").val(0);
		input=this;
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#img_preview").show();
				$('#img_preview')
				.attr('src', e.target.result)
				.width(150)
				.height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function enableFile(){
		if($(this).hasClass("enabler")){
			$(this).html("No deseo subir un archivo diferente asociado a este producto");
			$(this).attr("class","btn btn-danger");
			$("#file").removeAttr("disabled");
			$(this).removeClass("enabler");
		}
		else{
			$(this).html("Deseo subir un archivo diferente asociado a este producto");
			$(this).attr("class","btn btn-primary");
			$("#file").attr("disabled",true);
			$(this).addClass("enabler");
		}
		// $(this).toggleClass("enabler");
	}
</script>
@endpush
@section('content')
	@if(!empty($O_model))
		@if($O_model->is_sealed)
		<script>
			$(() => {
				$("form.actual_form input:not(.new-version),textarea").attr('disabled', true)
				$('.new-version').click((e) => {
					const newVersion = "{{route('protocolos_fisioterapia.new_version', $O_model->id)}}"
					window.open(newVersion);
				})
			})
		</script>
		@endif
		{{Form::model($O_model,['method'=>'patch', 'route'=>[$route_prefix.'.update', $O_model->id], 'files' => true, 'class' => 'actual_form'])}}
		@else
		{{Form::open(['method'=>$form_method, 'url'=>$form_url,'files' => true])}}
	@endif
	@csrf
	@if(!empty($patient_id))
		<input type="hidden" value={{$patient_id}} name="patient_id">
	@endif
	@if(!empty($stop_extend))
		<input type="hidden" name="refresh" value="1">
	@endif
	<div class="container note_container">
		@if(empty($stop_extend))
			<div class="row print-content">
				@include('reports.row_print_report', ['printTableHeader' => !empty($printTableHeader) ? $printTableHeader : false, 'hide_header' => true, 'protocol' => !empty($protocol) ? $protocol : null])
			</div>
		@endif
		@if(!empty($title))
			<div class="row">
				<h3>{{$title}}</h3>
			</div>
		@endif
		@if (!empty($errors))
			@if ($errors->any())
				<div class="row">
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
			    </div>
			@endif
		@endif
		@foreach($keys as $key=>$value)
		@if(empty($value['type']))
			@continue
		@endif
		<div class="row mb-3">
				@if($value['type'] == 'separator')
					<div class="col-lg-12 mt-1">
						<{{$value['tag']}} class="{{!empty($value['class']) ? $value['class'] : ''}}" no_count = {{!empty($value['no_count'])? 1 : 0}}>{{$value['label']}}</{{$value['tag']}}>
						@if(!empty($value['link']) && !empty($value['link']['text']) && !empty($value['link']['href']))
							<a target="_blank" href="{{$value['link']['href']}}" class="{{!empty($value['link']['class']) ? $value['link']['class'] : '' }}">{{$value['link']['text']}}</a>
						@endif
					</div>
				@elseif($value['type'] == 'file')
					<div class="col-lg-12 mt-1">
						<div><label for="">{{$value['label']}}</label></div>
						<div>
							@if(!empty($O_model))
								@php $file_value = !empty($value['key']) ? $value['key'] : false; @endphp
								@if($O_model->$file_value)
									<a href="{{route('bibliography.download', $O_model->id)}}" _target="blank"> Descarga el archivo: {{$O_model->$file_value}}</a>
								@endif
							@endif
						</div>
						{{Form::file('file', ['class'=>'from-control'])}}
					</div>
				@elseif($value['type'] == 'multiple_checkbox')
					<div class="col-md-12 mt-1" >
						<h3>{{$value['label']}}</h3>
					</div>
					@php
						$contCheckbox = 0;
					@endphp
					@foreach ($value['options'] as $option)
					<div class="{{!empty($value['grid']) ? $value['grid'] : 'col-lg-6' }} mt-1" >
					<div style="display:flex; justify-content: center">
						{{Form::label($option['name'], $option['description'])}}
					</div>
					<div style="display:flex; justify-content: center">
						@php
							if(!empty($value['default']) && !is_array($value['default'])) {
								$value['default'] = $value['default']->toArray();
							}
						@endphp
						{{-- {{Form::checkbox($value['name'] .'['. (!empty($option['id']) ? $option['id'] : $option['name']).']', null,true)}} --}}
							{{Form::checkbox(
								$value['name'] .'['. (!empty($option['id']) ? $option['id'] : $option['name']).']',
								(!empty($option['id']) ? $option['id'] : $option['name']),
								in_array($option['name'], $value['default']))}}
					</div>
					</div>
					@endforeach
				@elseif($value['type'] == 'select')
					<div class="col-lg-12 mt-1">
						<label>{{$value['label']}}</label>
						@if(!empty($O_model))
							{{Form::select($value['key'],$value['options'],!empty($O_model->rol)?$O_model->rol->id:null, ['class'=>"form-control " . (!empty($value['class']) ? $value['class'] : ''), 'id' => $value['key']])}}
						@else
							{{Form::select($value['key'],$value['options'],null, ['class'=>"form-control " . (!empty($value['class']) ? $value['class'] : ''), 'id' => $value['key']])}}
						@endif
					</div>
				@elseif($value['type'] == 'multiple_images')
							@include('inputs.multiple_images',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
				@elseif($value['type'] == 'multiple_urls')
							@include('inputs.multiple_urls',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
				@elseif($value['type'] == 'single_image')
					<label for="product_img">Imagen</label>
					<br>
						@isset($product)
							<img id="img_preview" style="{{($product->img)?'display:block':'display:none'}}" src="{{'/images/'.$product->img}}">
						@endif
							<img id="img_preview" style="display: none">
									<br>
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="img" id="product_img" lang="es">
						<label class="custom-file-label" for="product_img">Seleccionar Archivo</label>
						<button class="btn btn-warning" target="#product_img" onclick="unsetImg(event)" style="margin-bottom: 20px">Quitar Imagen</button>
					</div>
				@elseif($value['type'] == 'autocompletable_multiple')
					@include('inputs.ajax_autocompletable_multiple',
					[
						'value'=>$value,
						'single' => !empty($value['single']) ? true : false,
						'addRoute' => !empty($value['addRoute']) ? $value['addRoute'] : false,
						'viewRoute' => !empty($value['viewRoute']) ? $value['viewRoute'] : false,
						'defult_values' => !empty($value['default'])?$value['default']:null
					]
					)
				@elseif($value['type'] == 'checkbox')
				<v-row>
					<v-col-lg-12>
						<label>{{$value['label']}}</label>
						{{Form::checkbox($value['key'])}}
					</v-col-lg-12>
				</v-row>
				@elseif($value['type'] == 'textarea')
					@php
						$this_attribute = $value['key'];
					@endphp
					<div class="col-lg-12">
						@if(!empty($value['label']))
							{{Form::label($value['key'],$value['label'])}}
						@endif
						@php $type=$value['type'] @endphp
						<textarea id="{{$value['key']}}" name="{{$value['key']}}" class="form-control" rows="{{!empty($value['rows'])?$value['rows']:1}}">{{!empty($O_model)?$O_model->$this_attribute:''}}</textarea>
					</div>
				@elseif($value['type'] == 'div')
					<div class="col-lg-12" id = "{{$value['key']}}">
					</div>
				@elseif($value['type'] != 'autocompletable_multiple')
					<div class="col-lg-12">
						@if(!empty($value['label']))
							{{Form::label($value['key'],$value['label'], ['class' => !empty($value['class']) ? $value['class'] : ''])}}
						@endif
						@php $type=$value['type'] @endphp
						{{Form::text($value['key'],!empty($value['default'])? $value['default'] : null ,array_merge(['class'=>"form-control " . (!empty($value['class']) ? $value['class'] : '')],!empty($value['attributes']) ? $value['attributes'] : []))}}
					</div>
				@endif
		</div>
			@endforeach
		<div class="row">
			@if(!empty($O_model) && $O_model->is_sealed)
				<div class="col-lg-12">
					<button type="button" class="btn btn-primary new-version">Crear nueva versión</button>
				</div>
			@else
				<div class="col-lg-12">
					{{Form::submit('Guardar',['class'=>'btn btn-primary'])}}
				</div>
			@endif
		</div>
	</div>
	{{Form::close()}}
@endsection