@extends('layouts.basic')
@section('content')
<form action="{{route('information.store')}}" method="post">
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
		@if (!empty($errors))
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
		@endif
		<div class="row">
			<div class="col-lg-12">
					<label>Nombre(*)</label>
					<input type="" name="name" class="form-control">
			</div>
			<div class="col-lg-12">
				<label>Correo electrónico(*)</label>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="col-lg-12">
				<h3>Tu pregunta(*)</h3>
			</div>
			<div class="col-lg-12">
					<textarea name="request" class="form-control"></textarea>
			</div>
			<div class="col-lg-12">
				<input type="submit" class="btn btn-primary" value="Preguntar"></button>
			</div>
		</div>
</div>
</form>
@endsection