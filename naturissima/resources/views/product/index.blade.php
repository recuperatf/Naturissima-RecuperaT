@extends("layouts.basic")
@section("partial_css")

@endsection
@section("partial_css")
<style type="text/css">
	.modal-body p {
	    word-wrap: break-word;
	}
</style>
@endsection
@section("partial_js")
	<script type="text/javascript" src="/js/globals2.js"></script>
@endsection
@section("content")
	<input type="hidden" name="is_grevill" class="form-control" value="{{$request->is_grevill ? $request->is_grevill : false}}">
		<input type="hidden" id="csrf_token" value="{{csrf_token()}}">
		<div class="container-fluid">
			@if(Auth::user())
				@if(Auth::user()->rol->name == "admin")
					<div class="row">
						<div class="col-12">
						<a href="{{route('store.create')}}"><button class="btn btn-light">Añadir</button></a>
						</div>
					</div>
				@endif
			@endif
			@if($product_category)
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2>{{$product_category->name}}</h2>
					<p>{!!$product_category->description!!}</p>
				</div>
			</div>
			@endif
			@if($product_category_name)
			<div class="row">
				<div class="col-lg-4 offset-lg-4 col-10 offset-1">
				<form action="{{route('store.index')}}" method="get">
					<input type="hidden" name="product_category_id" class="form-control" value="{{$request->product_category_id ? $request->product_category_id : false}}">
					<input type="text" name="search_terms" class="form-control" placeholder="Búsqueda en {{$product_category_name}}">
					<input type="submit" class="" class="btn btn-light" value="Buscar">
				</form>
				</div>
			</div>
			@endif
			<div class="row">
				<div class="col-12 offset-2">
					<h5>{{!empty($categoryString) ? $categoryString : 'Productos'}}</h5>
				</div>
			</div>
			<div class="row">
				@if($C_products->total() == 0)
				<div class="col-12">
					No hay coincidencias en tu búsqueda
				</div>
				@endif
				<div class="col-md-2">
					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-warning" style="font-size:0.9em; background-color: white; border: solid; border-color: black; color: black">
								<strong>Compra en línea para recoger en puntos de venta sin costo alguno.</strong>
								<br>Puntos de entrega.
								<ul>
									<li>
										<strong>Clínica Recuperat de Fisioterapia</strong><br>
										Boulevard Valle imperial # 260 -18, cruza con Avenida Antiguo Camino a Copalita y Calle Las Torres, planta alta, Colonia La Periquera, C.P 45134, Zapopan Jalisco
										<br>Teléfono Fijo: (33) 9688-6699
										<br>Teléfono (Whatsapp): (33) 2351-7843
									</li>
									<li>
										Avenida Guadalajara 3523. Local 8, Fraccionamiento Sendas Residencial. C.P 45140, Zapopan,
										Jalisco.
										<br><i class="icofont-whatsapp"></i> (33) 2407-4211
										<br><i class="icofont-phone"></i> (33) 3803-4475
									</li>
								</ul>
								<strong>Compra mínima de $ 1000 para envío en zona metropolitana de Guadalajara, Jalisco más gastos de envío local.</strong>
								<br>
								<strong>Compra mínima de $ 2500 para envío FUERA de la zona metropolitana de Guadalajara más envío nacional.</strong>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						@foreach($C_products as $product)
							{{-- @dd($product, $SESSION_products, $product_category); --}}
							@include("store.product_individual.product_individual", [
			'product' => $product,
			'SESSION_products' => $SESSION_products,
			'product_category' => $product_category,
		])
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex" style="margin-top: 50px">
			@if(isset($product_category_id))
				@if($product_category_id)
					<script type="text/javascript">
						$(function(){
						$.each($(".page-link[href]"), function(key,value){
							value=$(value);
							value.attr("href",(value.attr("href")+"&product_category_id="+"{{$product_category_id}}"));
						});
						});
					</script>
				@endif
			@endif
			<div class="mx-auto">
				{{ $C_products->links() }}
			</div>
		</div>
@endsection
