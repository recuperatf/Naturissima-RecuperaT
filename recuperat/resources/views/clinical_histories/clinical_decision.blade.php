@if (empty($client_view))
	@extends('layouts.basic')
@endif
@push('javascript')
	<style>
		.print_only {
			display: none
		}

		pre {
			font-family: "Open Sans", sans-serif;
		}
	</style>
	<script type="text/javascript">
		var array_decision = [];
		var active_decision = 0;
		$(function () {
			$("#div_hfp_row").hide()
			$("#cb_hfp").prop("checked", false);
			window.array_decision = {!!$json_decisions!!};
			let last_element = (array_decision[array_decision.length - 1]);
			window.active_decision = array_decision.length - 1;
			const sendByEmail = $('<a></a>', {
				html: 'Mandar por Email',
				href: '#',
				class: "no_print",
			}).click(function (event) {
				const a = $(event.target);
				sendHomePhysiotherapeuticProgramEmail(last_element);
			});
			$("#link_send_by_email").html(sendByEmail);
			$("#headerAuthor").html(last_element?.author?.name || 'N/A');
			$(".decision_text").text(last_element.text);
			$("#responsible_text").html(last_element.user.name);
			$("#license_text").html("{{$patient->responsible->license}}");
			$("#responsible_text").html(last_element.user.name);
			$("#sign_text").html(`{{$patient->responsible->name}} CP: {{$patient->responsible->license}}`);
			const aHpp = last_element.home_physiotherapy_programs;
			let domUl = mapToLi(aHpp, $("<ul></ul>"), last_element);
			if (aHpp && !aHpp.length > 0) {
				$("#hpp").hide()
				$("label[for='hpp']").hide()
				$("#hpp").addClass("no_print")
				$("label[for='hpp']").addClass("no_print")
			} else {
				$("#hpp,label[for='hpp']").removeClass('no_print')
				$("#hpp,label[for='hpp']").show()
				$("#hpp").html('');
				$("#hpp").append(domUl);
			}
		});
		function changeDecisionText(previous) {
			if (active_decision == 0 && previous) return
			if (active_decision == (array_decision.length - 1) && !previous) return
			if (previous) {
				window.active_decision--;
			} else {
				window.active_decision++;
			}
			var decision = window.array_decision[active_decision];

			const aHpp = decision.home_physiotherapy_programs;
			const sendByEmail = $('<a></a>', {
				html: 'Mandar por Email',
				href: '#',
				class: "no_print",
			}).click(function (event) {
				const a = $(event.target);
				sendHomePhysiotherapeuticProgramEmail(decision);
			});
			$("#link_send_by_email").html(sendByEmail);
			let domUl = aHpp ? mapToLi(aHpp, $("<ul></ul>"), decision) : [];
			$("#headerAuthor").html(decision?.author?.name || 'N/A');
			$(".decision_text").text(decision.text);
			$("#responsible_text").html(decision.user.name);
			$("#sign_text").html(decision.user.name);
			if (aHpp && !aHpp.length > 0) {
				$("#hpp").hide()
				$("label[for='hpp']").hide()
				$("#hpp").addClass("no_print")
				$("label[for='hpp']").addClass("no_print")
			} else {
				$("#hpp,label[for='hpp']").removeClass('no_print')
				$("#hpp,label[for='hpp']").show()
				$("#hpp").html('');
				$("#hpp").append(domUl);
			}
		}
		function mapToLi(array, domUl, decision) {
			array.forEach(function (element) {
				const domA = $("<a></a>", {
					html: element.name,
					target: '_blank',
					href: "/decision/" + element.id
				});
				const sendByWhatsapp = $('<a></a>', {
					html: '- Mandar por Whatsapp',
					href: '#',
					class: "no_print",
					password: element.pivot.password,
				}).click(function (event) {
					const a = $(event.target);
					sendHomePhysiotherapeuticProgramWhatsapp(a.attr("password"), decision);
				});
				const domLi = $("<li></li>").append(domA).append(sendByWhatsapp);
				domUl.append(domLi);
			});
			return domUl;
		}
		function sendHomePhysiotherapeuticProgramEmail(decision) {
			let email = '{{ $patient->email }}'
			if (!email)
				email = prompt('Ingresa el correo electrónico');
			window.open('/send_decision/' + decision.id + `?to=${email}`, '_blank');
		}

		function sendHomePhysiotherapeuticProgramWhatsapp(password, decision) {
			let phone = '{{ $patient->telephone }}'
			if (!phone)
				phone = prompt('Ingresa el numero de telefono a 10 dígitos');
			const text = encodeURIComponent("Consulta tu programa fisioterapéutico en www.recuperatfisioterapia.com/decision/" + password + "?decisionId=" + decision.id + "&from_global_search=1");
			window.open("https://web.whatsapp.com/send?phone=52" + phone + "&text=" + text);

		}
	</script>
@endpush
@section('content')
	<div class="container">
		@if (!empty($errors))
			@if ($errors->any())
				<div class="row">
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
		@endif
		<div class="modal" tabindex="-1" role="dialog" id="modal_previous">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Recetas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body note_container">
						@php
							$author = \App\Decision::find(1)->author;
						@endphp
						@include('reports.row_print_report', ['author' => !empty($patient->responsible) ? $patient->responsible : null, 'img' => !empty($img) ? $img : false, 'hide_header' => false, 'hideImage' => true])
						<label for="decision_text" class="no_print"
							style="white-space: pre-wrap;"><strong>Contenido:</strong></label>
						<pre class="decision_text d-block d-print-none"
							style="border-radius: 10px;padding: 20px;border: 2px solid #bedbcc;"></pre>
						<pre class="decision_text d-none d-print-block"
							style="height: 900px; border-radius: 10px;padding: 20px;border: 2px solid #bedbcc; font-size: 16pt;"></pre>
						<div>
							<span class="no_print" id="link_send_by_email"></span>
						</div>
						<label for="hpp"><strong>Programa fisioterapéutico en casa:</strong></label>
						<div id="hpp"></div>
						<div class="w-100 text-right">
							<label for="sign_text"
								class="d-none"><strong>__________________________________</strong></label>
							<p id="sign_text" class="print_only"></p>
						</div>
						<br>
						<div class="w-100 text-left d-none d-print-block">
							<ul>
								<li><strong>Recuperat Valle Imperial:</strong> Blvd. Valle imperial # 260 -18, cruza con
									Avenida Antiguo Camino a Copalita y Calle Las Torres, planta alta, Colonia La Periquera,
									C.P 45134, Zapopan Jalisco. Tel. (33) 2351-7843</li>
								<li><strong>Plaza Paseo Sendas:</strong> Avenida Guadalajara 3523. Local 8, Fraccionamiento
									Sendas Residencial, CP.45134, Zapopan Jalisco. Tel. (33) 3803-4475</li>
								{{-- <li><strong>Recuperat T Center:</strong> Juan Gil Preciado #8905, Local 4, Tesistán.
									CP: 45200, Plaza T-Center. Tel. (33) 2407-4211</li> --}}
							</ul>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick="changeDecisionText(true)"><span><i
									class="fas fa-angle-left"></i></span></button>
						<button type="button" class="btn btn-primary" onclick="changeDecisionText(false)"><span><i
									class="fas fa-angle-right"></i></span></button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal_previous">Ver Anteriores</button>
			</div>
		</div>
		{{Form::open(['route' => 'history.decision.store'])}}
		<div class="row">
			@include('patient.patient_header', ['patient' => (!empty($patient) ? $patient : false), 'author' => null])
			{{Form::hidden('patient_id', $patient->id)}}
			<div class="col-md-12">
				<label for="decision">Contenido de la Receta</label>
				{{Form::textarea('text', '', ['class' => 'form-control'])}}
			</div>
		</div>
		<div class="row" class="no_print">
			<div class="col-lg-12">
				<select name="clinic_id" id="" class="form-control">
					@foreach($clinics as $clinic)
						<option value="{{$clinic->id}}">{{$clinic->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row no_print">
			<div class="col-lg-12">
				<label for="cb_hfp">Añadir programa terapéutico en casa</label>
			</div>
			<div class="col-lg-12">
				<input type="checkbox" class="checkbox lg" onClick="$('#div_hfp_row').toggle()" id="cb_hfp">
			</div>
		</div>
		<div class="row" id="div_hfp_row">
			@include('inputs/ajax_autocompletable_multiple', [
				'value' => [
					'key' => 'home_physiotherapy_programs',
					'label' => 'Programa fisioterapéutico en casa',
					'class' => 'home_physiotherapy_programs',
					'name' => 'home_physiotherapy_programs',
					'url' => 'api/home_physiotherapy_program/search',
				],
				'defult_values' => [],
			])
		</div>
		<br>
			@if(Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_prescriptions.create')->count())
				<div class="row">
					<div class="col-md-12">
							{{Form::submit('Agregar Receta', ['class' => 'btn btn-primary'])}}
					</div>
				</div>
			@endif
			{{Form::close()}}
		</div>
@endsection
