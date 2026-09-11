@extends('layouts.basic')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<table class="table">
				<tr>	
					<th>Nombre</th>
					<th>Correo</th>
					<th>Pregunta</th>
					<th>Fecha</th>
					<th>¿Respondida?</th>
					<th>Acciones</th>
				</tr>
				@foreach($informations as $info)
					<tr>
						<td>{{$info->name.' '.$info->last_name.' '.$info->second_last_name}}</td>
						<td>{{$info->email}}</td>
						<td>{{$info->request}}</td>
						<td>{{$info->created_at->toDateString()}}</td>
						<td>{{($info->answered)?'Sí':'No'}}</td>
						<td>
							<a class="btn btn-primary btn-sm" style="text-decoration: none; color: white;" href="{{route('answer.create', $info->id)}}">
								Responder
							</a>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection