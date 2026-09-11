@php
	$label_show=isset($label_show)?$label_show:true;
@endphp

@if(isset($S_label))
	@if($S_label)
			@if($label_show)
				{{Form::label($S_label)}}
			@endif
	@endif
@endif
@if(!empty($explanation))
	<span><i class="fas fa-question" data-toggle="modal" href="#modal_explanation_{{$S_order}}"></i></span>
@endif
@php
	$textarea = !empty($textarea)?'textarea':'text';
@endphp
{{Form::hidden($name."[$S_order][name]",$S_label,['id' => "name".$S_order.$S_label])}}
{{Form::hidden($name."[$S_order][cie10_id]",isset($ID_cie10)?$ID_cie10:null,['id' => "cie10".$S_order.$S_label])}}
{{Form::hidden($name."[$S_order][section]",isset($name)?$name:null,['id' => "section".$S_order.$S_label])}}
@if(isset($default))
	@if($default==null || !$default->count())
		{{Form::$textarea($name."[$S_order][json_values]",null,['placeholder'=>!empty($placeholder) ? $placeholder : '', 'class'=>'form-control', 'rows'=>!empty($rows)?$rows:''])}}
	@else
		@php
			$already_created=false;
			$d_value = $default->where('name', $S_label)->where('section',$name)->sortByDesc('created_at')->first();
			$already_created = !empty($d_value);
		@endphp
		@if(!empty($d_value))
			{{Form::$textarea($name."[$S_order][json_values]",$d_value->json_values,['placeholder'=>!empty($placeholder) ? $placeholder : '', 'class'=>'form-control', 'rows'=>!empty($rows)?$rows:'','disabled' => (!empty($disabled) ? true : false)])}}
			@else
			{{Form::$textarea($name."[$S_order][json_values]",null,['placeholder'=>!empty($placeholder) ? $placeholder : '', 'class'=>'form-control', 'rows'=>!empty($rows)?$rows:''])}}
		@endif
	@endif
@else
	{{Form::$textarea($name."[$S_order][json_values]",null,['placeholder'=>!empty($placeholder) ? $placeholder : '', 'class'=>'form-control', 'rows'=>!empty($rows)?$rows:'', 'disabled' => (!empty($disabled) ? true : false)])}}
@endif
@if(!empty($explanation))
	<div class="modal fade" id="modal_explanation_{{$S_order}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					{!!$explanation!!}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
@endif
