@php
	$textarea_rows=(isset($textarea_rows))?$textarea_rows:2;
	$label_show=isset($label_show)?$label_show:false;
@endphp
@if($label_show)
{{Form::label($S_label)}}
@endif
@if(isset($S_info))
	<span style="margin-left: 10px" data-toggle="modal" data-target="#modal_{{str_replace(' ', '', $S_label)}}">
	  <i class="fas fa-question"></i>
	</span>
@endif
{{Form::hidden($name."[$S_order][name]",$S_label)}}
{{Form::hidden($name."[$S_order][cie10_id]",isset($ID_cie10)?$ID_cie10:null)}}
{{Form::hidden($name."[$S_order][section]",isset($name)?$name:null)}}
@if(isset($default))
	@if($default==null || !$default->count())
		{{Form::textarea($name."[$S_order][json_values]",null,['class'=>'form-control','rows'=>$textarea_rows])}}
	@else
		@php
			$already_created=false;
		@endphp
		@foreach($default as $key=>$value)
			@if($value->name==$S_label && $value->section==$name)
				{{Form::textarea($name."[$S_order][json_values]",$value->json_values,['class'=>'form-control','rows'=>$textarea_rows])}}
				@php
					$already_created=true;
					break;
				@endphp
			@endif
		@endforeach
		@if(!$already_created)
			{{Form::textarea($name."[$S_order][json_values]",null,['class'=>'form-control','rows'=>$textarea_rows])}}
		@endif
	@endif
@else
	{{Form::textarea($name."[$S_order][json_values]",null,['class'=>'form-control','rows'=>$textarea_rows])}}
@endif
<div class="modal fade" id="modal_{{str_replace(' ', '', $S_label)}}" tabindex="-1" role="dialog" aria-labelledby="{{str_replace(' ', '', $S_label)}}Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{str_replace(' ', '', $S_label)}}Label">Como explorar: {{$S_label}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!!isset($S_info)?$S_info:'Sin información'!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
