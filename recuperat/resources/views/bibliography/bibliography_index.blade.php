@extends('layouts.basic')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>BIBIOLGRAFÍAS DISPONIBLES</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-responsive">
					<tr>
						<th>Título</th>
						<th>Peso(MB)</th>
					</tr>
					@foreach($A_contents as $content)
						<tr>
							<td>{{$content['name']}}</td>
							<td>{{round(($content['size'])/(1024*1024),2)}}</td>
							<td></td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection