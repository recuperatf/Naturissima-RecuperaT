@extends('layouts.basic')
@section('content')
	@if(!empty($O_model))
		{{Form::model($O_model,['method'=>'patch', 'route'=>[$route_prefix.'.update', $O_model->id], 'files' => true])}}
		@else
		{{Form::open(['method'=>$form_method, 'url'=>$form_url,'files' => true])}}
	@endif
	@csrf

	<div class="container note_container">
		@if(!empty($title))
			<div class="row">
				<h3>{{$title}}</h3>
			</div>
		@endif
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
			@foreach($keys as $key=>$value)
		<div class="row mb-3">
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
						{{Form::$type($value['key'],null,['class'=>"form-control " . $value['class'] ? $value['class'] : ''])}}	
					</div>
				@elseif($value['type'] == 'autocompletable_multiple')
					@include('inputs.ajax_autocompletable_multiple',
					[
						'value'=>$value,
						'defult_values' => !empty($value['default'])?$value['default']:null
					]
					)
				@endif
		</div>
			@endforeach
		<div class="row">
			<div class="col-lg-12">
				{{Form::submit('Guardar',['class'=>'btn btn-primary'])}}
			</div>
		</div>
	</div>
	{{Form::close()}}
@endsection