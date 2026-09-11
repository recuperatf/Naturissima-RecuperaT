@php
	$show_label=isset($show_label)?$show_label:true;
@endphp
<div class="{{!empty($divClass)?$divClass:'d-inline-flex'}}">
			@if($show_label)
				<div class="mt-auto mb-auto" style="font-weight: bold; width: {{isset($label_width)?$label_width:'120px'}}">
					{{Form::label($S_label)}}
				</div>
			@endif
{{Form::hidden($name."[$S_order][name]",$S_label)}}
{{Form::hidden($name."[$S_order][cie10_id]",isset($ID_cie10)?$ID_cie10:null)}}
{{Form::hidden($name."[$S_order][section]",isset($name)?$name:null)}}
@if(!isset($checkbox))
	@if(isset($default))
		@if($default==null || !$default->count())
			{{-- No hay default, pero se paso el objeto (es nullo o está vacío), seleccionamos el primer elemento del radio --}}
			{{-- revisar si esta parte es necesario, tal vez re podría sejar sin nada, porque todos son for each y si no hay nada no debería haber problema--}}
			@foreach($radio_options as $key=>$option)
				@if($key==='type')
					@php continue; @endphp
				@endif
				{{Form::radio($name."[$S_order][json_values]",($key==0)?true:false)}}
				{{Form::label($name."[$S_order][json_values]",$option)}}
			@endforeach
		@else
			{{-- Hay default, tenemos que buscar que index es y darlo como true --}}
				@php
					$already_created=false;
					$default = $default->where('name', $S_label)->where('section', $name)->first();
					if(empty($default)){
						$default = \App\Valoration::first();
						$default->json_values = "0";
					}
					if ($default->name == 'III/Reposo' && 'valoration_laboral_elbow_first_line' == $name) {
						// dd($default);
					}
					// $default=$default->first();
				@endphp
				@if($default->name==$S_label && $default->section==$name)
					@php
						$already_created=true;
						$count_option=0;
					@endphp
						@foreach($radio_options as $key=>$option)
						@if($key==='type')
							@php continue; @endphp
						@endif
							{{Form::radio($name."[$S_order][json_values]",$key,($count_option==$default->json_values)?true:false)}}
							{{Form::label($name."[$S_order][json_values]",$option)}}
							@php $count_option++; @endphp
						@endforeach
				@endif
			{{-- Revisar si esta pieza es necesaria --}}
			@if(!$already_created)
				@foreach($radio_options as $key=>$option)
				@if($key==='type')
					@php continue; @endphp
				@endif
				<div style="text-align: center; padding:0px 10px 0px 10px;">
					@if($key==0)
						{{Form::radio($name."[$S_order][json_values]",$key,true)}}
						@else
						{{Form::radio($name."[$S_order][json_values]",$key)}}
					@endif
					{{Form::label($name."[$S_order][json_values]",$option)}}
				</div>
				@endforeach
			@endif
		@endif
	@else
			@foreach($radio_options as $key=>$option)
			@if($key==='type')
				@php continue; @endphp
			@endif
				@if($key==0)
					{{Form::radio($name."[$S_order][json_values]",$key,true)}}
					@else
					{{Form::radio($name."[$S_order][json_values]",$key)}}
				@endif
				{{Form::label($name."[$S_order][json_values]",$option)}}
			@endforeach
	@endif
@else
	@php
		$count_option=0;
	@endphp
	<div class="row">
	@foreach($radio_options as $key=>$option)
		 @if($key==='type')
		 	@php continue; @endphp
		 @endif
		<div class="col-md-3">
			@php
			$defaultOption = null;
				if (!empty($default) && $default->count() > 0) {
					$defaultOption = $default->where('name', $option)->where('json_values', 'on')->last();
				}
			@endphp
			{{Form::hidden($name."[$option][json_values]",'off')}}
			{{Form::checkbox($name."[$option][json_values]",null, $defaultOption)}}
			{{Form::label($name."[$option][json_values]",$option)}}
		</div>
		@php $count_option++; @endphp
	@endforeach
	</div>
@endif
			</div>