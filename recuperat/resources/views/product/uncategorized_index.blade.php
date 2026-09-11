@extends("layouts.basic")
@section("partial_css")

@endsection
@section("partial_js")
	<script type="text/javascript" src="/js/globals2.js"></script>
@endsection
@section("content")
	<input type="hidden" id="csrf_token" value="{{csrf_token()}}">
	<div class="container">
		@if(Auth::user())
			@if(Auth::user()->rol->name=="admin")
				<div class="row">
					<div class="col-12">
					<a href="{{route('store.create')}}"><button class="btn btn-light">Añadir</button></a>	
					</div>
				</div>
			@endif
		@endif
		<div class="row">
			<div class="col-12">
				<table class="table table-responsive">
					<tr>
						<th>Nombre</th>
						<th>Categoría</th>
						<th>Editar</th>
					</tr>
					@foreach($C_products as $product)
						<tr>
							<td>{{$product->name}}</td>
							<td>{{($product->product_category_id)?$product->product_category_id:"N/D"}}</td>
							<td><a href="{{action('ProductController@edit',$product->id)}}"><span><i class="fas fa-edit"></i></span></a></td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	<div class="d-flex" style="margin-top: 50px">
	    <div class="mx-auto">
			{{ $C_products->links() }}
		</div>
	</div>
@endsection