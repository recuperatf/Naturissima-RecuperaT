@extends("layouts.basic")
@section("partial_js")
<script type="text/javascript" src="/js/globals2.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" 
src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type="text/javascript" src="https://resources.openpay.mx/lib/openpay-data.v1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

<script type="text/javascript">
	$(function(){
		$(".delivery_pickup").attr("disabled",true);
		$("#store_pickup").removeAttr("disabled");
		$("#address_visit").change(able_visit_address);
		$("#date").change(function(){
			date=$("#date").val();
			ajax_get_remaining_times_from_date(date);
		});
		$("#clinic_id").change(function(){
			date=$("#date").val();
			ajax_get_remaining_times_from_date(date);
		});
		$("#submit_agendar").click(function(){
			console.log($("#address_visit").is(":checked"));
			if($("#address_visit").is(":checked")){
				$("#checkoutModal").modal();
			}else{
				@if(Auth::user())
				if(confirm('Usted es un usuario del staff de RecuperaT, ¿desea que esta cita se realice con descuento del 5% para el paciente?')){
					$("#payment-form").append($('<input>',{
						type:'hidden',
						value:{{Auth::id()}},
						name:'user_id'
					}));
					$("#payment-form").submit();
				}else{
					$("#payment-form").submit();
				}
				@else
					$("#payment-form").submit();
				@endif
			}
		});
			OpenPay.setId('m2mgdlkwrobevetfttwx');
			OpenPay.setApiKey('pk_62308cf550584483a5147b0434d2d8e4');
			OpenPay.setSandboxMode(true);

		              //Se genera el id de dispositivo
		              var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
		              
		              $('#pay-button').on('click', function(event) {
		              	event.preventDefault();
		              	$("#pay-button").prop( "disabled", true);
		              	OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);                
		              });

		              var sucess_callbak = function(response) {
		              	var token_id = response.data.id;
		              	$('#token_id').val(token_id);
		              	$('#payment-form').submit();
		              };

		              var error_callbak = function(response) {
		              	var desc = response.data.description != undefined ? response.data.description : response.message;
		              	alert("ERROR [" + response.status + "] " + desc);
		              	$("#pay-button").prop("disabled", false);
		              };
		$("#date").trigger('change');
	});
	function ajax_get_remaining_times_from_date(date){
		url='/ajax_get_remaining_times_from_date/'+date+'/'+$('#clinic_id').val();
		$.get({
			url:url,
			success:function(answer){
				$("#time").html("");
				$.each(answer, function(key, value){
					option=jQuery("<option>");
					option.attr("value",key);
					option.html(value);
					$("#time").append(option);
				});
				// option.attr("value");
			}
		});
	}

	function able_visit_address(){
		target=$($(this).attr("target"));
		if(target.css("display")=="none"){
			$(".delivery_pickup").attr("disabled",true);
			$("#delivery").removeAttr("disabled");
			target.css("display","block");
		}else{
			$(".delivery_pickup").attr("disabled",true);
			$("#store_pickup").removeAttr("disabled");
			target.css("display","none");
		}
	}


</script>
@endsection
@section("content")
		<form action="{{action('AppoinmentController@store')}}" method="post" id="payment-form">
			@csrf
<div class="d-flex" style="height: 80vh">
	<div class="container" >
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
			<select id="appoinment" name="product_id" class="form-control">
				@foreach($product_therapies as $id=>$product_therapy)
					<option value="{{$id}}">{{$product_therapy}}</option>
				@endforeach
			</select>
			<div class="row">
				<div class="col-lg-12">
					@csrf
					<label for="patient">Nombre del paciente*</label>
					<input type="text" name="appoinment_patient_name" id="patient" class="form-control" placeholder="Nombre Completo">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<label for="telephone">Teléfono de contacto*</label>
					<input type="tel" name="telephone" id="telephone" class="form-control" placeholder="ej. 3339554543">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<label for="clinic_id">Centro*</label>
					<select id='clinic_id' name="clinic_id" class="form-control">
						<option value="0">Selecciona un centro</option>
						@foreach($clinics as $clinic)
							<option value = '{{$clinic->id}}'>{{$clinic->name}}</option>
						@endforeach;
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<label>Fecha y Hora*</label>
				</div>
				<div class="col-lg-5">
					<input type="date" id="date" name="appoinment_date" class="form-control"/>
				</div>
				<div class="col-lg-2">
					<select id="time" name="appoinment_time" class="form-control">
						<option val="0">
							Hora
						</option>
					</select>
				</div>
			</div>


{{-- 			<div class="row">
				<div class="col-lg-12">
					<input type="checkbox" name="address_visit" id="address_visit" target="#address_visit_div">
					<label for="address_visit">Deseo visita a domicilio</label>
				</div>
			</div> --}}
			<div class="row" id="address_visit_div" style="display: none">
				<div class="col-lg-12">
					Advertencia: Este servicio solo está disponible en campo real y valle imperial, favor de verificar disponibilidad en el teléfono: (33)3333-3333, y deberá ser pagado con tarjeta de crédito o débito (dando click en el boton de agendar).
				</div>
			</div>
			<div class="row" style="margin-top: 20px">
				<div class="col-lg-12">
					<a id="submit_agendar" style="color: white; cursor: pointer;" class="btn btn-primary">Agendar</a>
				</div>
			</div>
			</div>
	</div>
</div>
@include("openpay.form",["disable_div_choose_envío"=>["next"=>"#div_send_address_data", "prev"=>"#div_facturation_data"]])
		</form>
@endsection