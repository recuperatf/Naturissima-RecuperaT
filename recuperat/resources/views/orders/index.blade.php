@extends("layouts.basic")
@section("content")
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-responsive">
				<tr>

					<th>Nombre del Comprador</th>	
					<th>Producto(s)</th>
					<th>Fecha</th>	
					<th>Direccion</th>	
					<th>Teléfono</th>	
					<th>A domicilio?</th>	
				</tr>
				@foreach($orders as $order)
				<tr>
					<td>
						{{$order->buyer_name}}
					</td>
					<td>
						@php
							$L_product_report=false;
							$total_price=false;
							if($order->json_report){
								$L_product_report=json_decode($order->json_report)->products;
								$total_price=json_decode($order->json_report)->total_price;
							}
						@endphp
						@if($L_product_report)
								<ul>
							@foreach($L_product_report as $product)
									<li>
										{{$product->name." ($".$product->price.") x".$product->quantity}}
									</li>
							@endforeach
									<text style="font-weight: bold">Total:<text> {{$total_price}}
								</ul>
						@else
							{{"No Especificados"}}
						@endif

					</td>
					<td>
						{{$order->created_at?$order->created_at:"No especificado"}}
					</td>
					<td>
						{{$order->name_send_address?$order->name_send_address:"No Especificada"}}
					</td>
					<td>
						{{$order->telephone?$order->telephone:"No especificado"}}
					</td>
					<td>
						{{$order->delivery?"Sí":"No"}}
					</td>

				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection