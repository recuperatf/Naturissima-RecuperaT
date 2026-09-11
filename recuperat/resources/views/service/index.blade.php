@extends("layouts.basic")
@section("partial_css")

@endsection
@section("partial_js")
@section("partial_js")
	<script type="text/javascript" src="/js/globals2.js"></script>
@endsection
@section("content")
<form action="{{route('servicios_en_salud.index')}}" method="get" id="form_global_search">
	<div class="col-md-4 col-sm-3 col-10 offset-md-4 col-1">
		<div class="input-group mb-3" style="margin-top: 10px">
			<input type="text" name="search_terms" class="form-control" placeholder="Búsqueda en servicios">
			<div class="input-group-append">
				<input id="span_global_search" type="submit" class="btn btn-primary" value="Buscar"/>
			</div>
		</div>
	</div>
</form>
	<input type="hidden" id="csrf_token" value="{{csrf_token()}}">
	<div class="container">
		@if(Auth::user())
			@if(Auth::user()->rol->id==1)
				@if(Auth::user()->rol->id==1)
					<div class="row">
						<a href="/tienda/create"><button class="btn btn-light">Añadir</button></a>
					</div>
				@endif
			@endif
		@endif
		<div class="row">
			<h5>Servicios</h5>
		</div>
		<div class="row">
			@foreach($C_products as $product)
				@include("store.product_individual.product_individual",compact($product,$SESSION_products))
			@endforeach		
		</div>
	</div>
	<div class="d-flex" style="margin-top: 50px">
	    <div class="mx-auto">
			{{ $C_products->links() }}
		</div>
	</div>
@endsection