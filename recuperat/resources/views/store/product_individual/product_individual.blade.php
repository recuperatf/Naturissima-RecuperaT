<div class="modal fade" id="modal_product_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información acerca de {{$product->name}}</h5>
				{{-- <button class="btn btn-primary ml-2" product-target="{{$product->id}}" onclick="manageCart(event,true)">Comprar</button> --}}
				@if($product->product_category && $product->product_category->id==1)
						<a style="cursor: pointer;" href="{{action('AppoinmentController@create_appointment_for_product',$product->id)}}" class="btn btn-primary">Agendar</a>
				@endif
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	      	<div>
					<img alt="" class="img-responsive" src="{{'images/'.$product->img}}" style="min-width: 100%; width: 100%; height: auto">
	      	</div>
	      	<div>
					{!!$product->description ? $product->description : 'Sin descripción disponible'!!}
	      	</div>
      </div>
      <div class="modal-footer">
				{{-- <button class="btn btn-primary" product-target="{{$product->id}}" onclick="manageCart(event,true)">Comprar</button> --}}
				@if($product->product_category && $product->product_category->id==1)
						<a style="cursor: pointer;" href="{{action('AppoinmentController@create_appointment_for_product',$product->id)}}" class="btn btn-primary">Agendar</a>
				@endif
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-2" style="{{!($product->active)?'opacity: 0.5; filter: alpha(opacity=50);':''}}">
	<div  style="text-align: center; height:100; font-weight: bold;">
		<a href="#" class="text-dark btn" data-toggle="modal" data-target="#modal_product_{{$product->id}}" style="font-weight: bold; max-width: 100%;">{{$product->name}}
		@if(!($product->active))
			Desactivado
		@endif
		@if(Auth::user())
			@if(Auth::user()->user_rol_id==1)
				<a href="{{action('ProductController@edit',$product->id)}}" style="color: blue; text-decoration: underline;"> (Editar)</a>
				{{Form::open(['url' => action('ProductController@destroy',$product->id), 'method'=>'delete'])}}
				<input type="submit" value="Eliminar" class="btn btn-danger"/>
				{{Form::close()}}
			@endif
		@endif
		</a>
	</div>
	<div style="text-align: center">
		@if($product->img)
			@if(is_dir((public_path("images")."/".$product->img)) || !($product->img))
				<span style="height: 200px" onclick="" class="fas fa-medkit fa-10x"></span>
			@elseif(file_exists(public_path("images")."/".$product->img))
			<a href="#" class="text-dark btn" data-toggle="modal" data-target="#modal_product_{{$product->id}}">
				<img src="{{'images/'.$product->img}}" style="height: 300px; width: 250px; object-fit:cover;" onclick="">
			</a>
				@else
					<span style="height: 200px" onclick="" class="fas fa-prescription-bottle fa-10x"></span>
			@endif
			@else
				<span style="height: 200px" onclick="" class="fas fa-prescription-bottle fa-10x"></span>
		@endif
	</div>
	@if($product->active)
	<div style="text-align: center; font-weight: bold;">
		@if(!empty($global_discount))
			<text>${{($product->price_mxn*(1-$global_discount))}}</text><br/>
			{{-- <text style="color: green">¡incluye {{$global_discount*100}}% de descuento!</text> --}}
			@else
			${{($product->price_mxn)}}
		@endif
	</div>
		<div style="text-align: center">
				@if($product->product_category)
					@if($product->product_category->id==1)
						<a style="cursor: pointer;" href="{{action('AppoinmentController@create_appointment_for_product',$product->id)}}" class="btn btn-primary">Agendar</a>
					@else
					<button class="btn btn-warning" product-target="{{$product->id}}" style="display:
					@if($SESSION_products)
						{{array_key_exists($product->id,$SESSION_products)?"inline":"none"}}
					@else
						none
					@endif
					" onclick="manageCart(event,false)">Quitar del Carrito</button>
					<button class="btn btn-primary" product-target="{{$product->id}}" onclick="manageCart(event,true)">Comprar</button>
					@endif
				@endif
		</div>
	@endif
</div>
