@extends("layouts.basic")
@section("partial_js")
	<script type="text/javascript" src="/js/globals2.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
	<script type="text/javascript" src="https://resources.openpay.mx/lib/openpay-data.v1.min.js"></script>
	<script type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />


	<script type="text/javascript">
		var minimum_checkout = 150;
		$(function () {
			$(".delivery_pickup").attr("disabled", true);
			$("#store_pickup").removeAttr("disabled");
			$("#address_visit").change(able_visit_address);
			$("#date").change(function () {
				date = $("#date").val();
				ajax_get_remaining_times_from_date(date);
			});
			$("#submit_agendar").click(function () {
				console.log($("#address_visit").is(":checked"));
				if ($("#address_visit").is(":checked")) {
					$("#checkoutModal").modal();
				} else {
					$("#payment-form").submit();
				}
			});
			OpenPay.setId('{{env('OPENPAY_ID', 'none')}}');
			OpenPay.setApiKey('{{env('OPENPAY_PK', 'none')}}');
			OpenPay.setSandboxMode(true);

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
		function ajax_get_remaining_times_from_date(date) {
			url = '/ajax_get_remaining_times_from_date/' + date;
			$.get({
				url: url,
				success: function (answer) {
					$("#time").html("");
					$.each(answer, function (key, value) {
						option = jQuery("<option>");
						option.attr("value", key);
						option.html(value);
						$("#time").append(option);
					});
					// option.attr("value");
				}
			});
		}

		function able_visit_address() {
			target = $($(this).attr("target"));
			if (!($("#address_visit").is(":checked"))) {
				$("#payment-form").attr("action", '{{route('appoinments.store')}}');
			} else {
				$("#payment-form").attr("action", '{{route('charge')}}');
			}
			if (target.css("display") == "none") {
				$(".delivery_pickup").attr("disabled", true);
				$("#delivery").removeAttr("disabled");
				target.css("display", "block");
			} else {
				$(".delivery_pickup").attr("disabled", true);
				$("#store_pickup").removeAttr("disabled");
				target.css("display", "none");
			}
		}


	</script>
@endsection
@section("content")
	<form action="{{route('appoinments.store')}}" method="post" id="payment-form">
		@csrf
		<div class="d-flex" style="height: 80vh">
			<div class="container">
				@if ($errors->any())
					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				@endif
				@if (\Session::has('message'))
					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-success">
								{!! \Session::get('message') !!}
							</div>
						</div>
					</div>
				@endif
				<h2><strong>Agendar Cita</strong></h2>
				<h2>{{$product->name}}</h2>
				<input type="hidden" id="appoinment" name="product_id" class="form-control" value="{{$product->id}}">
				<input type="hidden" id="appoinment" name="redirect" value="appoinment">
				<div class="row">
					<div class="col-lg-12">
						@csrf
						<label for="patient">Nombre del paciente</label>
						<input type="text" name="appoinment_patient_name" id="patient" class="form-control"
							placeholder="Nombre Completo">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">

						<label for="telephone">Teléfono de contacto</label>
						<input type="tel" name="telephone" id="telephone" class="form-control" placeholder="ej. 3339554543">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<label>Fecha y Hora</label>
					</div>
					<div class="col-lg-5">
						<input type="date" id="date" name="appoinment_date" class="form-control" />
					</div>
					<div class="col-lg-2">
						<select id="time" name="appoinment_time" class="form-control">
							<option val="0">
								Hora
							</option>
						</select>
					</div>
				</div>


				{{-- <div class="row">
					<div class="col-lg-12">
						<input type="checkbox" name="address_visit" id="address_visit" target="#address_visit_div">
						<label for="address_visit">Deseo pagar mi consulta por internet</label>
					</div>
				</div> --}}
				{{-- <div class="row" id="address_visit_div" style="display: none">
					<div class="col-lg-12">
						Advertencia: Este servicio solo está disponible en campo real y valle imperial, favor de verificar
						disponibilidad en el teléfono: (33)3333-3333, y deberá ser pagado con tarjeta de crédito o débito
						(dando click en el boton de agendar).
					</div>
				</div> --}}
				<div class="row" style="margin-top: 20px">
					<div class="col-lg-12">
						<a id="submit_agendar" style="color: white; cursor: pointer;" class="btn btn-primary">Agendar</a>
					</div>
				</div>
			</div>
		</div>
		</div>
		@include("openpay.form", ["disable_div_choose_envío" => ["next" => "#div_send_address_data", "prev" => "#div_facturation_data"]])
	</form>
@endsection