{{Form::label($S_label)}}
  <i class="fa fa-info-circle" style="margin-left: 10px" class="" data-toggle="modal" data-target="#modal_{{str_replace(' ', '', $S_label)}}"></i>
{{Form::hidden($name."[$S_order][name]",$S_label)}}
{{Form::hidden($name."[$S_order][cie10_id]",isset($ID_cie10)?$ID_cie10:null)}}
{{Form::hidden($name."[$S_order][section]",isset($name)?$name:null)}}
@if(isset($default))
	@if($default==null || !$default->count())
		{{Form::text($name."[$S_order][json_values]",null,['class'=>'form-control'])}}
	@else
			@php
				$has_deafult=false;
				$d_value = $default->where('name', $S_label)->where('section',$name)->sortByDesc('created_at')->first();
				$has_deafult = !empty($d_value);
			@endphp

		@if($has_deafult)
				{{Form::text($name."[$S_order][json_values]",$d_value->json_values,['class'=>'form-control'])}}
		@else
			{{Form::text($name."[$S_order][json_values]",null,['class'=>'form-control'])}}
		@endif
	@endif
@else
	{{Form::text($name."[$S_order][json_values]",null,['class'=>'form-control'])}}
@endif
<div class="modal fade" id="modal_{{str_replace(' ', '', $S_label)}}" tabindex="-1" role="dialog" aria-labelledby="{{str_replace(' ', '', $S_label)}}Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{str_replace(' ', '', $S_label)}}Label">Información: {{$S_label}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!!$S_info!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>