@extends("layouts.basic")
@section("partial_css")

@endsection
@section("partial_js")
	<script type="text/javascript" src="/js/globals2.js"></script>
@endsection

@section("content")
	<form action="{{route('store.index')}}" method="get" id="form_global_search">
		<div class="col-md-4 col-sm-3 col-10 offset-md-4 col-1">
			<div class="input-group mb-3" style="margin-top: 10px">
				<input type="text" name="search_terms" class="form-control" placeholder="Búsqueda en tienda">
				<div class="input-group-append">
					<input id="span_global_search" type="submit" class="btn btn-primary" value="Buscar" />
				</div>
			</div>
		</div>
	</form>
	<input type="hidden" id="csrf_token" value="{{csrf_token()}}">
	<div class="container">
		@if(Auth::user())
			@if(Auth::user()->rol->name == "admin")
				<div class="row">
					<div class="col-12">
						<a href="{{route('store.create')}}"><button class="btn btn-light">Añadir</button></a>
					</div>
				</div>
			@endif
		@endif
		@if($product_category_name)
			<div class="row">
				<div class="col-lg-4 offset-lg-4 col-10 offset-1">
					<form action="{{route('store.index')}}" method="get">
						<input type="hidden" name="product_category_id" class="form-control"
							value="{{$request->product_category_id ? $request->product_category_id : false}}">
						<input type="text" name="search_terms" class="form-control"
							placeholder="Búsqueda en {{$product_category_name}}">
						<input type="submit" class="" class="btn btn-light" value="Buscar">
					</form>
				</div>
			</div>
		@endif
		<div class="row">
			<div class="col-12">
				<h5>Productos</h5>
			</div>
		</div>
		<div class="row">
			@if($C_products->total() == 0)
				<div class="col-12">
					No hay coincidencias en tu búsqueda
				</div>
			@endif
			@foreach($C_products as $key => $product)
				@include("store.product_individual.product_individual", ['product' => $product])
			@endforeach
		</div>
	</div>
	<div class="d-flex" style="margin-top: 50px">
		<div class="mx-auto">
			{{ $C_products->links() }}
		</div>
	</div>
@endsection