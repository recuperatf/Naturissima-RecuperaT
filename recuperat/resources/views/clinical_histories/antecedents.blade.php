@php
	$textType=!empty($textType)?$textType:'text';
	$textClass=!empty($textClass)?$textClass:['class'=>'form-control'];
	$show_label=isset($show_label)?$show_label:true;
@endphp
@if(!empty($show_label))
	@if(!empty($S_label))
		{{Form::label($S_label)}}
	@endif
@endif
{{Form::hidden($name."[$S_order][name]",$S_label)}}
{{Form::hidden($name."[$S_order][section]",$name)}}
{{Form::hidden($name."[$S_order][cie10_id]",isset($ID_cie10)?$ID_cie10:null)}}
{{Form::hidden($name."[$S_order][antecedent_type_id]",$antecedent_type_id)}}
@if(isset($default))
	@if($default==null || !$default->count())
		{{Form::$textType($name."[$S_order][json_values][data]",null,$textClass)}}
	@else
			@php
				$hasDefault=false;
				$d_value = $default->where('name', $S_label)->where('section',$name)->sortByDesc('created_at')->first();
				$hasDefault = !empty($d_value);
			@endphp

			@if($hasDefault)
				{{Form::$textType($name."[$S_order][json_values][data]",!empty($d_value->json_values->data)?($d_value->json_values->data):null,$textClass)}}
			@else
				{{Form::$textType($name."[$S_order][json_values][data]",null,$textClass)}}
			@endif
	@endif
@else
{{Form::$textType($name."[$S_order][json_values][data]",null,$textClass)}}
@endif