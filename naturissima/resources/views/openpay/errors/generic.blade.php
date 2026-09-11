@extends('layouts.basic')
@section ('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>HUBO UN ERROR EN TU COMPRA</h2>
				<p>Por favor contáctanos y menciona el siguiente error:</p>
				<div class="alert alert-danger">
					{{$error}}
				</div>
			</div>
		</div>
	</div>
@endsection