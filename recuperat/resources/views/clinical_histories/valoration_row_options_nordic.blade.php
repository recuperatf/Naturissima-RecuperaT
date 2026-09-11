<div class="d-inline-flex">
<div class="mt-auto mb-auto" style="font-weight: bold; width: 100px">
    @if(!isset($label_show) || $label_show)
        {{Form::label($S_label)}}
    @endif
</div>
{{Form::hidden($name."[$S_order][name]",$S_label)}}
{{Form::hidden($name."[$S_order][cie10_id]",isset($ID_cie10)?$ID_cie10:null)}}
{{Form::hidden($name."[$S_order][section]",isset($name)?$name:null)}}
@if(!isset($checkbox))
	@if(isset($default))
		@if($default==null || !$default->count())
			{{-- No hay default, pero se paso el objeto (es nullo o está vacío), seleccionamos el primer elemento del radio --}}
			{{-- revisar si esta parte es necesario, tal vez re podría sejar sin nada, porque todos son for each y si no hay nada no debería haber problema--}}
			@foreach($radio_options as $key=>$option)
			{{-- @if($name == "valoration_tendons_and_muscle_nordic_change_in_job_codo o antebrazo")
				@dd($key)
			@endif --}}
				@if($key==='type')
					@php continue; @endphp
				@endif
				{{Form::radio($name."[$S_order][json_values]",$key)}}
                @if(!isset($radio_label_show) || $radio_label_show)
				    {{Form::label($name."[$S_order][json_values]",$option)}}
                @endif
			@endforeach
		@else
			{{-- Hay default, tenemos que buscar que index es y darlo como true --}}
				@php
					$already_created=false;
					$default=$default->first();
				@endphp
				@if($default->name==$S_label && $default->section==$name)
					@php
						$already_created=true;
						$count_option=0;
					@endphp
						@foreach($radio_options as $key=>$option)
						@if($key==='type')
							@continue
						@endif
								{{Form::radio($name."[$S_order][json_values]",$key,($key == $default->json_values)?true:false)}}
								@if(!isset($radio_label_show) || $radio_label_show)
                                    {{Form::label($name."[$S_order][json_values]",$option)}}
                                @endif
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
					@if(!isset($radio_label_show) || $radio_label_show)
                        {{Form::label($name."[$S_order][json_values]",$option)}}
                    @endif
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
				@if(!isset($radio_label_show) || $radio_label_show)
				    {{Form::label($name."[$S_order][json_values]",$option)}}
                @endif
			@endforeach
	@endif
@else
	@php
		$count_option=0;
	@endphp
	@foreach($radio_options as $key=>$option)
		 @if($key==='type')
		 	@continue
		 @endif
		@php
			if($default && $default->count()) {
				$thisDefault = $default->first();
				$jsonDefault = json_decode($thisDefault)->json_values;
				$jsonDefault = is_array($jsonDefault) ? (object) $jsonDefault : $jsonDefault;
			}
		@endphp
		{{Form::checkbox($name."[$S_order][json_values][$key]", null, !empty($jsonDefault->$key) )}}
        @if(!isset($radio_label_show) || $radio_label_show)
            {{Form::label($name."[$S_order][json_values]",$option)}}
        @endif
    @php $count_option++; @endphp
	@endforeach
@endif
			</div>
