@extends('layouts.basic')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-responsive">
				<tr>
					<th>Parametro</th>
					<th>Valor</th>
				</tr>
				<?php foreach ($C_parametrization as $key => $parametrization): ?>
					<tr>
						<td>{{$parametrization->parameter}}</td>
						<td>{{$parametrization->value}}</td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>
@endsection