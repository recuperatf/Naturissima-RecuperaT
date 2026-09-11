@extends("layouts.basic")
@section("partial_js")
	<script type="text/javascript" src="/js/globals2.js"></script>
	<script type="text/javascript" src="/js/product_checkout.js"></script>
	<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
	<script type="text/javascript" src="https://resources.openpay.mx/lib/openpay-data.v1.min.js"></script>
	<script type="text/javascript">
		let map;

		function initMap() {
			console.log('initing')
			map = new google.maps.Map(document.getElementById("map"), {
				center: { lat: 20.7910274, lng: -103.4521854 },
				zoom: 12,
			});

			new google.maps.Circle({
				strokeColor: "#FF0000",
				strokeOpacity: 0.8,
				strokeWeight: 2,
				fillColor: "#FF0000",
				fillOpacity: 0.35,
				map,
				center: { lat: 20.7910274, lng: -103.4521854 },
				radius: 1500,
			});
		}


		var minimum_checkout ={{$minimum_checkout}};
		$(document).ready(function () {
			$("#open_pay_modal").click(function () {
				gotoPage();
				pressumed_total = $("#checkout_total").html();
				if (pressumed_total < minimum_checkout) {
					// $(".delivery").attr("disabled",true);
					$("#minimum-buy-warning").css("display", "block");
				} else {
					$(".delivery").removeAttr("disabled");
					$("#minimum-buy-warning").css("display", "none");
				}
			});
			OpenPay.setId('{{env('OPENPAY_ID', 'none')}}');
			OpenPay.setApiKey('{{env('OPENPAY_PK', 'none')}}');
			OpenPay.setSandboxMode(false);

			//Se genera el id de dispositivo
			var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
			$('#pay-button').on('click', function (event) {
				event.preventDefault();
				$(this).attr("disabled", true);
				accepted_terms = $(".acepto_terminos_y_condiciones").is(":checked");
				accepted_policies = $(".acepto_politicas").is(":checked");
				if (accepted_terms && accepted_policies) {
					setTimeout(function () {
						$('#pay-button').removeAttr("disabled");
					}, 20000);
					OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
				} else {
					alert("Primero debes aceptar los términos y condiciones y nuestra polítcia de privacidad");
					$('#pay-button').removeAttr("disabled");
				}
			});

			var sucess_callbak = function (response) {
				var token_id = response.data.id;
				$('#token_id').val(token_id);
				$('#payment-form').submit();
			};

			var error_callbak = function (response) {
				var desc = response.data.description != undefined ? response.data.description : response.message;
				alert("ERROR [" + response.status + "] " + desc);
				$('#pay-button').removeAttr("disabled");
			};

		});
	</script>

	<style>
		@charset "US-ASCII";
		@import "http://fonts.googleapis.com/css?family=Lato:300,400,700";

		#map {
			height: 30vh;
			overflow: hidden;
		}

		body {
			float: left;
			margin: 0;
			padding: 0;
			width: 100%;
		}

		strong {
			font-weight: 700;
		}

		a {
			cursor: pointer;
			display: block;
			text-decoration: none;
		}

		a.button {
			border-radius: 5px 5px 5px 5px;
			-webkit-border-radius: 5px 5px 5px 5px;
			-moz-border-radius: 5px 5px 5px 5px;
			text-align: center;
			font-size: 21px;
			font-weight: 400;
			padding: 12px 0;
			width: 100%;
			display: table;
			background: #E51F04;
			background: -moz-linear-gradient(top, #E51F04 0%, #A60000 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #E51F04), color-stop(100%, #A60000));
			background: -webkit-linear-gradient(top, #E51F04 0%, #A60000 100%);
			background: -o-linear-gradient(top, #E51F04 0%, #A60000 100%);
			background: -ms-linear-gradient(top, #E51F04 0%, #A60000 100%);
			background: linear-gradient(top, #E51F04 0%, #A60000 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#E51F04', endColorstr='#A60000', GradientType=0);
		}

		a.button i {
			margin-right: 10px;
		}

		a.button.disabled {
			background: none repeat scroll 0 0 #ccc;
			cursor: default;
		}
	</style>
@endsection
@section("content")
	<form action="{{ action('OpenPayController@store') }}" method="POST" id="payment-form">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-warning"
						style="background-color: white; border: solid; border-color: black; color: black">
						Compra en línea para recoger en puntos de venta sin costo alguno.
						<br>Puntos de entrega.
						<ul>
							<li>
								Boulevard Valle imperial # 260 -18, cruza con Avenida Antiguo Camino a Copalita y Calle Las
								Torres, planta alta, Colonia La Periquera, C.P 45134, Zapopan Jalisco
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
						<strong>Compra mínima de $ 1000 para envío en zona metropolitana de Guadalajara, Jalisco más gastos
							de envío local.</strong>
						<br>
						<strong>Compra mínima de $ 2500 para envío FUERA de la zona metropolitana de Guadalajara más envío
							nacional.</strong>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					@foreach($C_products as $product)
						<div class="w-100 d-inline-flex row-checkout">
							<div class="p-2">
								@if($product->img))
									@if(file_exists(public_path("images") . "/" . $product->img))
										<img style="float: left;" src="{{'images/' . $product->img}}">
									@else
										<span style="float: left; height: 200px;" class="fas fa-prescription-bottle fa-10x"></span>
									@endif
								@else
									<span style="float: left; height: 200px;" class="fas fa-prescription-bottle fa-10x"></span>
								@endif
							</div>
							<div class="d-flex-column w-75">
								<div class="w-100">
									<div class="font-weight-bold">{{$product->name}}</div>
									<div>{{$product->description}}</div>
									<label class="font-weight-bold">Precio</label>
									<div><text>${{$product->price_mxn}}</text></div>
								</div>
								<div>
									<div class="w-100">
										<label for="qty_{{$product->id}}" style="font-weight: bold;">Cantidad (Unidades)</label>
									</div>
									<div class="row mt-2">
										<div class="col-lg-3">
											<input min="0" product-price="{{$product->price_mxn}}"
												product-qty="{{$SESSION_products[$product->id]['product_info']['qty']}}"
												id="qty_{{$product->id}}" type="number" size="3" style=""
												class="price form-control input-lg" product-target="{{$product->id}}"
												name="products[{{$product->id}}][qty]"
												value="{{$SESSION_products[$product->id]['product_info']['qty']}}" />
										</div>
										<div class="col-lg-3">
											<button type="button" class="btn btn-danger btn-lg"
												onclick="remove_from_checkout(event)" product-target="{{$product->id}}">
												<i class="fa fa-trash" style="pointer-events: none;"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>

				<div class="col-lg-3 offset-lg-3" style="">
					@foreach($C_products as $product)
						<ul>
							<li>
								<div class="d-inline-flex w-100">
									<div style="width: 45%">
										<text class="font-weight-bold">{{$product->name}} </text>
									</div>
									<div style="width: 35%">
										x<text class="total_individual_quantity"
											product-target="{{$product->id}}">{{$SESSION_products[$product->id]['product_info']['qty']}}</text>
									</div>
									<div style="width: 20%" class="ml-auto mr-5" style="text-align: right;">
										$<text class="total_individual_price"
											product-target="{{$product->id}}">${{$product->price_mxn * $SESSION_products[$product->id]['product_info']['qty']}}</text>
									</div>
								</div>
							</li>
						</ul>
					@endforeach
					<hr />
					<div class="d-inline-flex w-100">
						<div class="w-50 font-weight-bold ml-5">Total</div>
						<div class="ml-auto w-25 mr-3">
							$<text id="checkout_total"></text>
						</div>
					</div>
					<div class="w-100 d-inline-flex">
						<button id="open_pay_modal" type="button" data-toggle="modal" data-target="#checkoutModal"
							class="mx-auto btn btn-primary">Pagar</button>
					</div>
				</div>
			</div>
		</div>

		@include('openpay.form', ["minimum_checkout", $minimum_checkout, "disable_div_choose_envío" => false])
	</form>
	<script type="text/javascript">
		$("#payment-form").validate({
			errorClass: 'alert alert-danger',
			ignore: '*:not([name])',
			lang: 'es'

		});
		$("#card_email").rules("add", {
			required: true,
			email: true,
			messages: {
				required: "Introduce un email",
				email: "Debes escribir un email valido"
			}
		});
		$("#card_number").rules("add", {
			required: true,
			messages: {
				required: "El numero de tarjeta es requerido para compra en linea"
			}
		});
		$("#telephone_card").rules("add", {
			required: true,
			messages: {
				required: "Introduce un numero de telefono valido"
			}
		})

		function validatePhone(txtPhone) {
			var a = document.getElementById(txtPhone).value;
			var filter = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
			if (filter.test(a)) {
				return true;
			}
			else {
				return false;
			}
		}
	</script>
	<script async
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfb4Hp7aAOZTES-2DFmxBGj42qLyOPLqc&callback=initMap">
		</script>
@endsection