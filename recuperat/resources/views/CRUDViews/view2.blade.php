@extends('layouts.basic')
@section('content')
@push('css')
<style type="text/css">
	.plan_image{
		height: 200px;
		width: 200px;
	}
</style>
@endpush	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>{{$O_model->name}}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<p>{{$O_model->description}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h3>Imagenes:</h3>
			</div>
			<div class="col-lg-12">
				@foreach($O_model->image_resources as $image_resource)
					<img class="plan_image" src="/{{$image_resource->url}}"></img>
				@endforeach
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h3>Links:</h3>
			</div>
			<div class="col-lg-12">
				<ul>
				@foreach($O_model->outside_resources as $outside_resources)
				<li>
					<a href='{{$outside_resources->url}}' target='_blank'>{{$outside_resources->url}}</a>
				</li>
				@endforeach
				</ul>
			</div>
		</div>

	</div>
@endsection