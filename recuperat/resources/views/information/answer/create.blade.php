@extends('layouts.basic')
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
	  $('#summernote').summernote();
	  // alert('hi');
	});
</script>
<form action="{{route('answer.store')}}" method="post">
	<div class="container">
		@csrf
		@if(\Session::has('success'))
			<div class="row">
				<div class="col">
					<div class="alert-success">
						{!! \Session::get('success') !!}
					</div>
				</div>
			</div>
		@endif
		<div class="row">
			<div class="col-lg-12">
				<h1>Respuesta a la pregunta de: {{$information_request->name}}</h1>
			</div>
			<div class="col-lg-12">
				"{{$information_request->request}}"
			</div>

		</div>
		<div class="row">
			<div class="col-lg-12">
				<input type="hidden" name="information_request_id" value="{{$information_request->id}}">
			</div>	
			<div class="col-lg-12">
				<textarea id="summernote" name="content" class="form-control">
					Contenido de la respuesta
				</textarea>
			</div>	
			<div class="col-lg-12">
				<input type="submit" class="btn btn-primary" value="Responder"></button>
			</div>
		</div>
</div>
</form>
@endsection