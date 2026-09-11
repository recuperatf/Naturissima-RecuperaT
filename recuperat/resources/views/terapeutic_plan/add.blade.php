@if (empty($client_view))
  @extends('layouts.basic')
@endif
@push('javascript')
@if(!empty($O_model))
	<script>
		@php
		$jsonStr = "[]";
		if ($O_model && $O_model->extras) {
			$escapers =     array("\\",     "/",   "\"",  "\n",  "\r",  "\t", "\x08", "\x0c");
			$replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t",  "\\f",  "\\b");
			$jsonStr = str_replace($escapers, $replacements, $O_model->extras);
			// $str = str_replace('\r\n\u2022', '', $O_model->extras);
			// $str = str_replace('\t', '', $str);
			// $jsonStr = $str;
		}
		@endphp
		let extras = JSON.parse('{!!$jsonStr!!}')
	</script>
@else
	<script>
			let extras = []
	</script>
@endif
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
      if (extras) {
        if (extras.fases) {
          _addPhases(extras.fases)
        }
      }
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
			if($(this).val()==1){
				showFile(true, {{(!(empty($product))?"false":"true")}});
			}else{
				showFile(false);
			}
		});
		$("#select_product_category_id").trigger("change");
		$("#btn_enable_switch_files").click(enableFile);
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
  function _addPhases(array) {
		if (typeof(array) == 'object') {
			array = Object.keys(array).map( key => {
				return array[key]
			})
		}
    targetDiv = $('#add_phases')
    $(array).each((key, phase) => {
      div = $('<div></div>', {
        class:'col-lg-4'
      })
      textPhasesName = phase.name
      textPhasesGoals = phase.goals || ''
      textPhasesProgression = phase.progession || ''
      textPhasesRestriction = phase.restrictions || ''
      textPhasesAlarmSigns = phase.alarm_signs || ''
      textPhasesInmovilization = phase.inmovilization || ''
      textPhasesPainControl = phase.pain_control || ''
			textPhasesRestrictions = phase.restrictions || ''
      textPhasesMobility = phase.mobility || ''
      textPhasesPhysicalModalities = phase.physical_modalities || ''
      textPhasesModalities = phase.modalities || ''
      textPhasesEjercicios = phase.exercises || ''
      textPhasesActivities = phase.activities || ''
      textPhasesExternalLinks = phase.external_links || ''
      jsonPhasesImages = JSON.parse(phase.images || '[]')
        h4Name = $('<h4></h4>', {
				class:"no_print",
        html: textPhasesName
      })
      pGoals = $('<p></p>', {
				class:"no_print",
        html: textPhasesGoals.substring(0, 50) + '...'
      })
			const closeBtn = $('<button></button>', {
				class:'btn btn-danger no_print',
				type:'button',
				html: 'X'
			})
			images = $('<div></div>', {
				class: "no_print"
			})
			Object.keys(jsonPhasesImages).forEach( (key) => {
				if(isNaN(key)) return
				image = jsonPhasesImages[key]
				styleString =  JSON.stringify({
					'background-image': image,
					width: '200px',
					height: '200px',
					display: 'inline-block',
					'background-repeat': 'no-repeat',
					'background-size': '100%',
				})
				divImage = $('<div></div>', {
					width: '200px',
					height: '200px',
				})
				images.append(divImage)
				divImage.attr('style', `width:200px;height:200px;background-image:${image};`)
			})
			closeBtn.click(removePhase)
			div.append(closeBtn)
    	div.append($('<br/>'))
      div.append(h4Name)
      div.append(pGoals)
			div.append(images)

      //hidden fields
		hiddenPhasesImages = $('<input></input>', {
      value: phase.images,
      type: 'hidden',
      name: 'images'
    })
		hiddenPhasesName = $('<input></input>', {
      value: textPhasesName,
      type: 'hidden',
      name: 'name'
    })
    hiddenPhasesGoals = $('<input></input>', {
      value: textPhasesGoals,
      type: 'hidden',
      name: 'goals'
    })
		hiddenPhasesRestrictions = $('<input></input>', {
      value: textPhasesRestrictions,
      type: 'hidden',
      name: 'restrictions'
    })
		hiddenPhasesAlarmSigns = $('<input></input>', {
      value: textPhasesAlarmSigns,
      type: 'hidden',
      name: 'alarm_signs'
    })
		hiddenPhasesInmovilization = $('<input></input>', {
      value: textPhasesInmovilization,
      type: 'hidden',
      name: 'inmovilization'
    })
		hiddenPhasesPhysicalModalities = $('<input></input>', {
      value: textPhasesPhysicalModalities,
      type: 'hidden',
      name: 'phases_physical_modalities'
    })
		hiddenPhasesPainControl = $('<input></input>', {
      value: textPhasesPainControl,
      type: 'hidden',
      name: 'pain_control'
    })
		hiddenPhasesMobility = $('<input></input>', {
      value: textPhasesMobility,
      type: 'hidden',
      name: 'mobility'
    })
    hiddenPhasesProgression = $('<input></input>', {
      value: textPhasesProgression,
      type: 'hidden',
      name: 'progression'
    })
    hiddenPhasesExercises = $('<input></input>', {
      value: textPhasesEjercicios,
      type: 'hidden',
      name: 'exercises'
    })
		hiddenPhasesActivities = $('<input></input>', {
      value: textPhasesActivities,
      type: 'hidden',
      name: 'activities'
    })
		hiddenPhasesExternalLinks = $('<input></input>', {
      value: textPhasesExternalLinks,
      type: 'hidden',
      name: 'external_links'
    })
      names = ['name',
			'goals',
			'restrictions',
			'alarm_signs',
			'inmovilization',
			'pain_control',
			'mobility',
			'progression',
			'physical_modalities',
			'exercises',
			'activities',
			'images',
			'external_links']

			div.append(hiddenPhasesName)
			div.append(hiddenPhasesGoals)
			div.append(hiddenPhasesRestrictions)
			div.append(hiddenPhasesAlarmSigns)
			div.append(hiddenPhasesInmovilization)
			div.append(hiddenPhasesPainControl)
			div.append(hiddenPhasesMobility)
			div.append(hiddenPhasesProgression)
			div.append(hiddenPhasesPhysicalModalities)
			div.append(hiddenPhasesExercises)
			div.append(hiddenPhasesActivities)
			div.append(hiddenPhasesImages)
			div.append(hiddenPhasesExternalLinks)

      targetDiv.append(div)
      hiddenPhasesName
      orderExtras(targetDiv, names)
    })
  }
	function removePhase(event) {
		$(event.target).parent().remove()
	}
  function addExtra(e) {
    button = $(e.target)
    //Validate
    textPhasesProgression = button.parent().find('#phases_progresion').val()
    if(textPhasesProgression == '') {
      alert('Debe ingresar una progresión')
      return
    }
    targetDiv = $(button.attr('target'))
    div = $('<div></div>', {
      class:'col-lg-4'
    })

    textPhasesName = button.parent().find('#phases_name').val()
    textPhasesGoals = button.parent().find('#phases_goals').val() || ''
    textPhasesRestrictions = button.parent().find('#restrictions').val() || ''
    textPhasesAlarmSigns = button.parent().find('#alarm_signs').val() || ''
    textPhasesInmovilization = button.parent().find('#inmovilization').val() || ''
    textPhasesPainControl = button.parent().find('#pain_control').val() || ''
    textPhasesMobility = button.parent().find('#mobility').val() || ''
    textPhasesPhysicalModalities = button.parent().find('#phases_physical_modalities').val()
    textPhasesEjercicios = button.parent().find('#phases_exercises').val()
    textPhasesActivities = button.parent().find('#phases_functional_activities').val()
    textPhasesExternalLinks = button.parent().find('#external_links').val()
		images = $("#div_images_preview_image_resources > div")
		base64Images = images.map( (index, divImage) => {
			style = $(divImage).attr("style")
			return style.substring(style.indexOf('url('))
		} )
		jsonTextImages = JSON.stringify(base64Images)
    h4Name = $('<h4></h4>', {
      html: textPhasesName
    })
    pGoals = $('<p></p>', {
      html: textPhasesGoals.substring(0, 50) + '...'
    })
		const closeBtn = $('<button></button>', {
				class:'btn btn-danger no_print',
				type:'button',
				html: 'X'
			})
		closeBtn.click(removePhase)
		div.append(closeBtn)
    div.append(h4Name)
    div.append(pGoals)
    div.append(images)

    //hidden fields
    hiddenPhasesImages = $('<input></input>', {
      value: jsonTextImages,
      type: 'hidden',
      name: 'images'
    })
		hiddenPhasesName = $('<input></input>', {
      value: textPhasesName,
      type: 'hidden',
      name: 'name'
    })
    hiddenPhasesGoals = $('<input></input>', {
      value: textPhasesGoals,
      type: 'hidden',
      name: 'goals'
    })
		hiddenPhasesRestrictions = $('<input></input>', {
      value: textPhasesRestrictions,
      type: 'hidden',
      name: 'restrictions'
    })
		hiddenPhasesAlarmSigns = $('<input></input>', {
      value: textPhasesAlarmSigns,
      type: 'hidden',
      name: 'alarm_signs'
    })
		hiddenPhasesInmovilization = $('<input></input>', {
      value: textPhasesInmovilization,
      type: 'hidden',
      name: 'inmovilization'
    })
		hiddenPhasesPhysicalModalities = $('<input></input>', {
      value: textPhasesPhysicalModalities,
      type: 'hidden',
      name: 'phases_physical_modalities'
    })
		hiddenPhasesPainControl = $('<input></input>', {
      value: textPhasesPainControl,
      type: 'hidden',
      name: 'pain_control'
    })
		hiddenPhasesMobility = $('<input></input>', {
      value: textPhasesMobility,
      type: 'hidden',
      name: 'mobility'
    })
    hiddenPhasesProgression = $('<input></input>', {
      value: textPhasesProgression,
      type: 'hidden',
      name: 'progression'
    })
    hiddenPhasesExercises = $('<input></input>', {
      value: textPhasesEjercicios,
      type: 'hidden',
      name: 'exercises'
    })
		hiddenPhasesActivities = $('<input></input>', {
      value: textPhasesActivities,
      type: 'hidden',
      name: 'activities'
    })
		hiddenPhasesExternalLinks = $('<input></input>', {
      value: textPhasesExternalLinks,
      type: 'hidden',
      name: 'external_links'
    })
    names = ['name',
    'goals',
		'restrictions',
		'alarm_signs',
		'inmovilization',
		'pain_control',
		'mobility',
    'progression',
    'physical_modalities',
		'exercises',
    'activities',
		'images',
		'external_links']
    div.append(hiddenPhasesName)
    div.append(hiddenPhasesGoals)
    div.append(hiddenPhasesRestrictions)
    div.append(hiddenPhasesAlarmSigns)
    div.append(hiddenPhasesInmovilization)
    div.append(hiddenPhasesPainControl)
    div.append(hiddenPhasesMobility)
    div.append(hiddenPhasesProgression)
    div.append(hiddenPhasesPhysicalModalities)
    div.append(hiddenPhasesExercises)
    div.append(hiddenPhasesActivities)
    div.append(hiddenPhasesImages)
    div.append(hiddenPhasesExternalLinks)
    targetDiv.append(div)
    hiddenPhasesName
    orderExtras(targetDiv, names)
  }
  function orderExtras (target, names) {
		console.log(names);
    target.children('div').each( (order, div) => {
      div = $(div)
      div.find('input').each( (key, input) => {
        name = $(input).prop('name')
        const newname = `extras[fases][${order}][${names[key]}]`
        $(input).prop('name',  newname)
      })
    })
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
	@if($O_model->is_sealed && Auth::user()->rol->id != 1)
		<script>
			$(() => {
				$("form.actual_form input:not(.new-version),textarea").attr('disabled', true)
				$('.new-version').click((e) => {
					const newVersion = "{{route('terapeutic_plan.new_version', $O_model->id)}}"
					window.open(newVersion);
				})
			})
		</script>
		@endif
		{{Form::model($O_model,['method'=>'patch', 'route'=>[$route_prefix.'.update', $O_model->id], 'files' => true, 'class' => 'actual_form'])}}
		@else
		{{Form::open(['method'=>$form_method, 'url'=>$form_url,'files' => true,'class' => 'actual_form'])}}
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
			<div class="row">
					@include('reports.row_print_report', ['hide_header' => true, 'protocol' => !empty($protocol) ? $protocol : null])
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
                    @if ((!empty($value['onlyAdmin'])) && !(Auth::user()->rol->name=="admin"))
                        @continue
                    @endif
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
				@elseif($value['type'] == 'checkbox')
					<v-row>
						<v-col-lg-12>
							<label>{{$value['label']}}</label>
							{{Form::checkbox($value['key'])}}
						</v-col-lg-12>
					</v-row>
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
				@elseif($value['type'] == 'textarea' && ((!empty($value['onlyAdmin']) && Auth::user()->rol->name=="admin")))
                    @if ((!empty($value['onlyAdmin'])) && !(Auth::user()->rol->name=="admin"))
                        @continue
                    @endif
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
        @elseif($value['type'] == 'extras')
          @foreach ($value['items'] as $item)
            <div class="col-lg-12">
              <h4>{{$item['label']}}</h4>
            </div>
            <div class="col-lg-12">
              <input id="phases_name" class="form-control" placeholder="Nombre"></textarea>
              <textarea rows="3" id="phases_goals" placeholder="Objetivos" class="form-control"></textarea>
              <textarea rows="3" id="restrictions" placeholder="Restricciones" class="form-control"></textarea>
              <textarea rows="3" id="alarm_signs" placeholder="Signos de alarma (complicaciones)" class="form-control"></textarea>
              <textarea rows="3" id="inmovilization" placeholder="Inmovilización" class="form-control"></textarea>
              <textarea rows="3" id="pain_control" placeholder="Control de dolor" class="form-control"></textarea>
              <textarea rows="3" id="mobility" placeholder="Movilidad" class="form-control"></textarea>
              <textarea rows="3" id="phases_physical_modalities" placeholder="Agentes físicos" class="form-control"></textarea>
              <textarea rows="3" id="phases_exercises" placeholder="Ejercicios" class="form-control"></textarea>
							@include('inputs.multiple_images', ['value' => ['no_print_header'=>true, 'key'=>'image_resources', 'label'=>'Imágenes', 'type' => 'multiple_images']])
              <textarea rows="3" id="external_links" placeholder="Enlaces externos" class="form-control"></textarea>
              <textarea rows="3" id="phases_progresion" placeholder="Criterios de progresión" class="form-control"></textarea>
              <textarea rows="3" id="phases_functional_activities" placeholder="Actividades funcionales" class="form-control"></textarea>
              <button class="btn btn-primary" type="button" onclick="addExtra(event)" target="#add_phases"><span><i class="fa fa-plus"></i></span> Añadir</button>
            </div>
            <div class="col-lg-12" id="">
              <div class="d-flex flex-wrap" id="add_phases">
              </div>
            </div>
          @endforeach
					<div class="col-lg-12">

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
			<div class="row print_only mt-n5">
			<div class="col-lg-12">
				@if(!empty($O_model))
					@if(json_decode($O_model->extras))
					@foreach(json_decode($O_model->extras)->fases as $extra)
						<h4>{{$extra->name}}</h4>
						<p><strong>Objetivos:</strong> {{!empty($extra->goals) ? $extra->goals : ''}}</p>
						<p><strong>Restricciones:</strong> {{!empty($extra->restrictions) ? $extra->restrictions : ''}}</p>
						<p><strong>Signos de alarma:</strong> {{!empty($extra->alarm_signs) ? $extra->alarm_signs : ''}}</p>
						<p><strong>Inmovilización:</strong> {{!empty($extra->inmovilization) ? $extra->inmovilization : ''}}</p>
						<p><strong>Control del dolor:</strong> {{!empty($extra->pain_control) ? $extra->pain_control : ''}}</p>
						<p><strong>Movilidad</strong>:</strong> {{!empty($extra->mobility) ? $extra->mobility : ''}}</p>
						<p><strong>Agentes físicos:</strong> {{!empty($extra->physical_modalities) ? $extra->physical_modalities : ''}}</p>
						<p><strong>Ejercicios:</strong> {{!empty($extra->exercises) ? $extra->exercises : ''}}</p>
						<p><strong>Criterios de progresión:</strong> {{!empty($extra->progression) ? $extra->progression : ''}}</p>
						<p><strong>Imágenes:</strong></p>
						@php
								$images = !empty($extra->images) ? (array)json_decode($extra->images) : false;
							@endphp
							@if($images)
							@foreach ($images as $image)
								@if(!is_string($image))
									@continue
								@endif
									<div style='background-image:{{$image}} display:inline-block; height:200px; width:200px; background-repeat:no-repeat; background-size:100%'></div>
								@endforeach
						@endif
							{{-- 'background-image': image,
							width: '200px',
							height: '200px',
							,
							'background-repeat': 'no-repeat',
							'background-size': '100%', --}}
						<p><strong>Enlaces externos:</strong> {{!empty($extra->external_links) ? $extra->external_links : ''}}</p>
					@endforeach
					@endif
				@endif
			</div>
		</div>
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
