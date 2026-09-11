@extends('layouts.basic')
@section('content')
	@if(!empty($model))
		{{Form::model($model,['method'=>'put', 'route'=>[$route_prefix.'.update', $model->id]])}}
		@else
		{{Form::open(['method'=>$form_method, 'url'=>$form_url])}}
	@endif
	@csrf
	<div class="container">
		<div class="row mb-3">
			@foreach($keys as $key=>$value)
				@if(empty($value['type']))
					@dd($key)
				@endif
				@if($value['type'] == 'separator')
					<div class="col-lg-12 mt-5">
						<{{$value['tag']}}>{{$value['label']}}</{{$value['tag']}}>
					</div>
				@elseif($value['type'] == 'multiple_urls')
							@include('inputs.multiple_urls',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
				@elseif($value['type'] == 'autocompletable_multiple')
					@include('inputs.ajax_autocompletable_multiple',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null])
				@elseif($value['type'] == 'select')
					<div class="col-lg-12">
					@include('inputs.simple_select',['value'=>$value, 'defult_values' => !empty($value['default'])?$value['default']:null, 
						'options' => !empty($value['options'])?$value['options']:null
					])
					</div>
				@elseif($value['type'] != 'autocompletable_multiple')
					<div class="col-lg-12">
						{{Form::label($value['key'],$value['label'])}}
						@php $type=$value['type'] @endphp
						{{Form::$type($value['key'],null,['class'=>'form-control'])}}	
					</div>
				@endif
			@endforeach
		</div>
		<div class="row">
			<div class="col-lg-12">
				{{Form::submit('Guardar',['class'=>'btn btn-primary'])}}
			</div>
		</div>
	</div>
	{{Form::close()}}
@endsection