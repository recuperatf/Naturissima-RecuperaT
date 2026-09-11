			<div class="d-inline-flex">
				<div class="mt-auto mb-auto" style="font-weight: bold; width: 100px">
{{Form::label($S_label)}}
				</div>
{{Form::hidden($name."[$S_order][name]",$S_label)}}
{{Form::hidden($name."[$S_order][cie10_id]",isset($ID_cie10)?$ID_cie10:null)}}
{{Form::hidden($name."[$S_order][section]",isset($name)?$name:null)}}
@if(isset($default))
	@if($default==null || !$default->count())
		@foreach($radio_options as $key=>$option)
					@if($key==0)
						{{Form::radio($name."[$S_order][json_values]",$key,true)}}
						@else
						{{Form::radio($name."[$S_order][json_values]",$key)}}
					@endif
					{{Form::label($name."[$S_order][json_values]",$option)}}
				@endforeach
	@else
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
						{{Form::radio($name."[$S_order][json_values]",$key,($count_option==$default->json_values)?true:false)}}
						{{Form::label($name."[$S_order][json_values]",$option)}}
						@php $count_option++; @endphp
					@endforeach
			@endif
		@if(!$already_created)
			@foreach($radio_options as $key=>$option)
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
			@if($key==0)
				{{Form::radio($name."[$S_order][json_values]",$key,true)}}
				@else
				{{Form::radio($name."[$S_order][json_values]",$key)}}
			@endif
			{{Form::label($name."[$S_order][json_values]",$option)}}
		@endforeach
@endif
			</div>