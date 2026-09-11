@extends('layouts.basic')
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
	  $('#summernote').summernote();
	  // alert('hi');
	});
</script>
	<form action="{{route('home.update')}}" method="post">
		@csrf
		<input type="hidden" name="_method" value="PUT">
		<textarea id="summernote" name="home_content">
			@if(!empty($home_content))
				{{$home_content->value}}
			@else
				Edita la página principal
			@endif
		</textarea>
		<div>
			<input type="submit" class="btn btn-primary" value="Modificar inicio">
		</div>
	</form>
@endsection