@foreach($models as $model)
	<h3>{{$model->name}}</h3>
	@foreach($model->fields as $value)
		@php
			$key = $value['key']
		@endphp
		@if($value['type'] == 'separator')
			<div class="col-lg-12 mt-5">
				<{{$value['tag']}}>{{$value['label']}}</{{$value['tag']}}>
			</div>
		@elseif($value['type'] == 'multiple_images')
					@include('inputs.multiple_images',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
		@elseif($value['type'] == 'multiple_urls')
					@include('inputs.multiple_urls',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
		@elseif($value['type'] != 'autocompletable_multiple')
			<div class="col-lg-12">
				{{Form::label($value['key'],$value['label'])}}
				@php $type=$value['type'] @endphp
				{{Form::$type($value['key'],$model->$key,['class'=>'form-control'])}}	
			</div>
		@elseif($value['type'] == 'autocompletable_multiple')
			@include('inputs.ajax_autocompletable_multiple',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
		@elseif($value['type'] == 'fillable_model')
			@include('inputs.fillable_model',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
		@endif
	@endforeach
@endforeach