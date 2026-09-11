@extends("layouts.basic")
@section("content")

<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<script type="text/javascript">
					$(function(){
					$("form .a_delete").click(function(){
						$(this).parents("form").first().submit();
					});
					});
				</script>
			</div>
		</div>
		<div class="row">
			@foreach($offers as $offer)
			<div class="modal fade" id="modal_product_{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Información acerca de {{$offer->name}}</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
							<div>
								  <img alt="" class="img-responsive" src="{{'/images/promociones/'.$offer->img}}" style="width: 100%; height: auto">
							</div>
							<div>
								  {!!$offer->description ? $offer->description : 'Sin descripción disponible'!!}
							</div>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				  </div>
				</div>
			  </div>
				<div class="col-lg-4">
					<div class="row">
						<div class="col-lg-12" style="text-align: center;">
							<strong style = "cursor: pointer;" data-toggle="modal" data-target="#modal_product_{{$offer->id}}">{{$offer->name}}</strong>
						</div>
						<div class="col-lg-12" style="text-align: center;">
							<img data-toggle="modal" data-target="#modal_product_{{$offer->id}}" class="mx-auto" style="{{($offer->img)?'display:block; height: 200px; width: 200px; cursor:pointer;':'display:none;'}}" src="{{'/images/promociones/'.$offer->img}}" alt="No se encontró imagen">
						</div>
						<div class="col-lg-12" style="text-align: center;">
							{{$offer->description}}
						</div>
					</div>
				</div>	
			@endforeach
		</div>
	</div>

@endsection