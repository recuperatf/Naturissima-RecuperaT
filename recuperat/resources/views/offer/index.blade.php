@extends("layouts.basic")
@section("content")
	<div class="container">
		<div class="row">
				@if (session('status'))
				    <div class="alert alert-success">
				        {{ session('status') }}
				    </div>
				@endif
			<div class="col-lg-12">
				<a class="btn btn-primary" href="{{action('OfferController@create')}}">Nueva oferta</a>
			</div>
			<div class="col-lg-12">
				<table class="table table-responsive">
					<tr>
					<th>Nombre</th>
					<th>Tipo</th>
					<th>Dias de la semana</th>
					<th>Activa desde</th>
					<th>Activa hasta</th>
					</tr>
					<script type="text/javascript">
						$(function(){
						$("form .a_delete").click(function(){
							$(this).parents("form").first().submit();
						});
						});
					</script>
					@foreach($offers as $offer)
						<tr>
						<td>{{$offer->name}}
								<div>
								<a class="btn btn-warning" style="cursor: pointer; text-decoration: none; color: white" href="{{route('ofertas.edit',$offer)}}"><i class="fas fa-edit" style="pointer-events: none;"></i></a>
									
							<form action="{{route('ofertas.destroy',$offer)}}" method="post" style="display: inline;">
								{{ method_field('DELETE') }}
								<a class="btn btn-danger a_delete" style="cursor: pointer; text-decoration: none; color: white"><i class="fas fa-trash" style="pointer-events: none;"></i></a>
							</form>
								</div>
						</td>
						<td>
							{{$offer->type->human_name}}. Los siguientes productos por ${{json_decode($offer->json_conditions)->value}}
							<br/>
							<!-- varios productos a un precio -->
						@if($offer->type->id==1)
							<ul>
								@foreach($offer->products as $product)
									<li>{{$product->name}} x{{$product->pivot->qty}}</li>
								@endforeach
							</ul>
						@endif
						</td>
						@if(($conditions=json_decode($offer->json_conditions)))
							<td>
									<ul>
								@if(!empty($conditions->week_days))
									@foreach($conditions->week_days as $key=>$on)
											<li>{{$key}}</li>
									@endforeach
								@endif
									</ul>
							</td>
							<td>{{$conditions->start_date}}</td>
							<td>{{$conditions->end_date}}</td>
							@else
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
						@endif
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>

@endsection