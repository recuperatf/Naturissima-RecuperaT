<div class="modal fade" id="modal_product_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información acerca de {{$product->name}}</h5>
				<button class="btn btn-primary ml-2" product-target="{{$product->id}}" onclick="manageCart(event,true)">Comprar</button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	      	<div>
					<img alt="" class="img-responsive" src="{{'images/'.$product->img}}" style="min-width: 100%; height: auto">
	      	</div>
	      	<div>
					{!!$product->description ? $product->description : 'Sin descripción disponible'!!}
	      	</div>
      </div>
      <div class="modal-footer">
				<button class="btn btn-primary" product-target="{{$product->id}}" onclick="manageCart(event,true)">Comprar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="col-xs-12 col-md-4 col-lg-3" style="{{!($product->active)?'opacity: 0.5; filter: alpha(opacity=50);':''}}">
	<div style="text-align: center; font-weight: bold;">
	<a href="#" onclick="window.history.pushState('', '', '/store?product_id={{$product->id}}');" class="text-dark btn" style="font-weight: bold;" data-toggle="modal" data-target="#modal_product_{{$product->id}}">
			{{$product->name}}
		</a>
		@if(!($product->active))
			Desactivado
		@endif
		@if(Auth::user())
			@if(Auth::user()->user_rol_id==1)
				<a href="{{action('ProductController@edit',$product->id)}}" style="color: blue; text-decoration: underline;"> (Editar)</a>
				<form action="{{action('ProductController@destroy', $product->id)}}" method="post" >
					<input name="_method" type="hidden" value="DELETE">
					<input type="submit" value="Eliminar" class="btn btn-danger"/>
				</form>
			@endif
		@endif
	</div>
	<div style="text-align: center">
		@if($product->img)
			@if(file_exists(public_path("images")."/".$product->img))
				<img  onclick="window.history.pushState('', '', '/store?product_id={{$product->id}}');" alt="" src="{{'images/'.$product->img}}" data-toggle="modal" data-target="#modal_product_{{$product->id}}" >
				@else
					<span onclick="window.history.pushState('', '', '/store?product_id={{$product->id}}');" style="height: 200px" data-toggle="modal" data-target="#modal_product_{{$product->id}}" class="fas fa-prescription-bottle fa-10x"></span>
			@endif
			@else
				<span onclick="window.history.pushState('', '', '/store?product_id={{$product->id}}');" style="height: 200px" data-toggle="modal" data-target="#modal_product_{{$product->id}}" class="fas fa-prescription-bottle fa-10x"></span>
		@endif 
	</div>
	@if($product->active)
	<div style="text-align: center; font-weight: bold;">
		${{$product->price_mxn}}
	</div>
		<div style="text-align: center">
				@if($product->product_category)
					@if($product->product_category->id==9)
						<a style="cursor: pointer;" href="{{action('AppoinmentController@create_appointment_for_product',$product->id)}}" class="btn btn-primary">Agendar</a>
					@endif
				@endif
				<button class="btn btn-warning" product-target="{{$product->id}}" style="display:
				@if($SESSION_products)
					{{array_key_exists($product->id,$SESSION_products)?"inline":"none"}}
				@else
					none
				@endif
				" onclick="manageCart(event,false)">Quitar del Carrito</button>
					<button onclick="window.history.pushState('', '', '/store?product_id={{$product->id}}');" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_product_{{$product->id}}">
					  Ver Descripción
					</button>
				@if($product->product_category)
					@if($product->product_category->id!=9)
						<button class="btn btn-primary" product-target="{{$product->id}}" onclick="manageCart(event,true)">Comprar</button>
					@endif
				@endif
		</div>
	@endif
</div>