@extends('layouts.basic')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-responsive">
					<tr>
						<th><a href="{{route('search_history.index',['term'=>($request['term'])?
							(($request['term']=='asc')?'desc':'asc')
							:'asc']
							)
						}}">Término</a></th>
						<th><a href="{{route('search_history.index',['results'=>($request['results'])?
							(($request['results']=='asc')?'desc':'asc')
							:'asc'])}}">Resultados(#)</a></th>					</tr>
					@foreach($C_search_history as $key=>$search_history)
						<tr>
							<td>
								{{$key}}
							</td>
							<td>
								{{$search_history->count()}}
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection