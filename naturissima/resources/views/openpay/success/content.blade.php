<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-success">
				{{isset($OrderMessage)?"$OrderMessage":""}}
				<br/>
				Codigo de compra: {{$order->token_id}}
			@if(isset($mail_status)) 
				<br/>{{($mail_status)?"Se ha enviado un correo electrónico con los detalles de tu compra":""}}
			@endif
			</div>
			@if(isset($mail_status)) 
				@if(!$mail_status)
					<div class="alert alert-danger">
						No se pudo enviar el correo electrónico a la direccion especificada.
					</div>
				@endif
			@endif
		</div>
		<div class="col-lg-12">
			<div class="col-lg-4">
				<form method="post" action="{{route("resend_email",$order->id)}}">
					@csrf
					<label>Reenviar correo electrónico</label>
					<input type="email" name="email" placeholder="Dirección de correo para enviar" class="form-control">
					<input type="submit" class="btn btn-primary" value="Enviar">
				</form>
			</div>
		</div>
		<div class="col-lg-12">
		<h3>Detalles de tu compra:</h3>
			<p>
				<h3>Productos</h3>

				@if($order->json_report)
					@php $reporte=json_decode($order->json_report); @endphp
					@foreach ($reporte->products as $key => $value)
					<div>
						<text>x{{$value->quantity}} {{$value->name}} (${{$value->price}} c/u) = ${{($value->price*$value->quantity)}}</text>
					</div>
					@endforeach
				<text style="font-weight: bold">Total: </text><text>{{$reporte->total_price}}</text>
				@endif

			</p>
		</div>
		@if($order->download_links->count() > 0)
			<div class="col-lg-6">
				<h3>Links de descarga</h3>
				<p>Advertencia: los prouctos pueden descargarse en una sola ocasión, de tener problemas, por favor contáctenos.</p>
				@foreach($order->download_links as $link)
					<div>
						<a target="_blank" href="{{route('product.client_download',['code'=>$link->code])}}">{{$link->product->name}}</a>
					</div>
				@endforeach
			</div>
		@endif
		<div class="col-lg-6">
			<h3>Datos de facturación</h3>
				@if($order->municipality_facturation)
			<div>
				Nombre (Razón Social):{{isset($order->name_facturation)?$order->name_facturation:"No definido"}}
			</div>
			<div>
				Dirección:
					{{($order->street_and_number_facturacion)?$order->street_and_number_facturacion:"Dirección no definida".", Municipio: ".$order->municipality_facturation.", Estado: ".$order->state_facturation}}
			</div>
			<div>
				Correo electrónico: {{$order->card_email}}
			</div>
			<div>
				Telefono: {{$order->card_telephone}}
			</div>
				@else
				No requeriste facturación
				@endif
		</div>
{{-- 		<div class="col-lg-6">
			<h3>Datos de entrega</h3>
			<div>
				Comprador: {{$order->buyer_name}}
			</div>
			<div>
				Dirección:
				@if($order->municipality_send_address!="0")
				{{$order->street_and_number_send_adress.",".$order->municipality_send_address.", ".$order->state_send_address}}
				@else
				No definida
				@endif
			</div>
			<div>
				Email: {{$order->card_email}}
			</div>
			<div>
				Telefono: {{$order->card_telephone}}
			</div>
		</div> --}}
	</div>
</div>