<style>
	pre {
		font-family: "Open Sans", sans-serif;
	}

	@media print {
		pre {
			border: none;
		}
	}
</style>
<script type="text/javascript">
	@if(!empty($default))
		var opened_valoration = 0;
		// var valorations = {!!json_encode($default->where('user_id', auth()->id())->groupBy('name')->sortBy('created_at'))!!}; //solo las notas del usuario
		var valorations = {!!json_encode($default->groupBy('name')->sortBy('updated_at'))!!};
		$(() => {
			let keys = Object.keys(this.valorations);
			this.valorations = keys.map((key, valoration_group) => {
				return [key, this.valorations[key]];
			});
			renderPreviousEvaluation();
			$("#print-button").css("display", 'none');
		});

		function changeEvaluation(next) {
			let sum = true;
			if (next && this.opened_valoration != 0) {
				this.opened_valoration--;
				sum = false;
			}
			else if (!next) {
				this.opened_valoration++;
			}
			let has_changed = renderPreviousEvaluation();
			if (!has_changed) {
				if (sum) {
					this.opened_valoration--;
				} else {
					this.opened_valoration++;
				}
			}
		}

		function deleteEvaluation() {
			deleteConfirm = confirm('Está seguro que desea eliminar esta evaluación')
			if (deleteConfirm) {
				let deleted = false
				$(this.valorations).each((key, valoration_group) => {
					if (deleted) return
					deleted = true
					const updated_at = valoration_group[1][window.opened_valoration].updated_at.replace(' ', 'T')
					$.ajax({
						url: '/historia/valoration_delete/' + updated_at,
						method: 'delete',
						success(data) {
							var url = window.location.href;
							if (url.indexOf('?') > -1) {
								url += '&param=1'
							} else {
								url += '?param=1'
							}
							window.location.href = url;

						}
					})
				})
			}
		}

		function renderPreviousEvaluation() {
			let changed = false;
			$(this.valorations).each((key, valoration_group) => {
				let name = valoration_group[0];
				J_name = $("[name='" + name + "']");
				if (J_name.length > 0) {
					$(valoration_group[1]).each((order, valoration) => {
						console.log('valoration', valoration)
						if (valoration?.created_at) {
							const date_only = valoration.created_at.split(' ')[0]
							$("#header-emission-date-div").hide();
							$("#header-elaboration-date-div").show();
							$("#header-elaboration-date-span").html(date_only);
						}
						if (valoration?.user) {
							$("#header-author-div").show()
							$("#header-author-span").html(valoration.user.name)
						}
						if (J_name.attr("section") != valoration.section) {
							return;
						}
						if (J_name.length > 0) {
							if (order == window.opened_valoration) {
								$("#date_previous").html('');
								$("#date_previous").append(valoration.created_at);
								let row = $("<strong>", {
									html: valoration.name + ': '
								});
								div_row = $("<pre>");
								div_row.append(row);
								div_row.append(valoration.json_values);
								J_name.html('');
								J_name.append(div_row);
								changed = true;
							}
						}
					});

				}
			});
			return changed;
		}

		function printObjectives() {
			let checkboxes = $("#print-checkboxes input[type='checkbox']:checked")
			let arrayCBs = []
			checkboxes.each((index, checkbox) => {
				checkbox = $(checkbox)
				let id = checkbox.attr('objectiveId')
				let name = checkbox.attr('value')
				arrayCBs.push({ id, name })
			})
			$.ajax(
				{
					url: "{{route('historia.print')}}",
					method: 'post',
					data: { patient_id: {{$patient_id}}, data: arrayCBs },
					success: (res) => {
						Object.keys(res).forEach(objectiveName => {
							const h4 = $('<h4></h4>', { html: 'Objetivo: ' + objectiveName, style: "margin-left: 2.2%;" })
							$("#col_table").append(h4)
							const table = $('<table></table>', { class: 'table', style: 'width:90%' })
							const headers = $('<tr></tr>')
							$("#col_table").append(table)
							headers.append($('<td></td>', { class: 'font-weight-bold', html: '# de sesión' }))
							headers.append($('<td></td>', { class: 'font-weight-bold', html: 'Actividades' }))
							headers.append($('<td></td>', { class: 'font-weight-bold', html: 'Observaciones' }))
							headers.append($('<td></td>', { class: 'font-weight-bold', html: 'Fisioterapeuta' }))
							table.append(headers)
							console.log(res[objectiveName])

							if (Array.isArray(res[objectiveName])) {
								let objectiveSorted = res[objectiveName];
								objectiveSorted = objectiveSorted.filter(sesion => sesion?.['Numero de sesión'] ? true : false)
								console.log('filtered', objectiveSorted)
								objectiveSorted.sort((a, b) => {
									return parseInt(a?.['Numero de sesión']) > parseInt(b?.['Numero de sesión']) ? 1 : -1
								})
								console.log(objectiveSorted)
								objectiveSorted.forEach((objective) => {
									const tr = $('<tr></tr>')
									tr.append($('<td></td>', { html: objective?.['Numero de sesión'] || '' }))
									tr.append($('<td></td>', { html: objective?.Actividades || '' }))
									tr.append($('<td></td>', { html: objective?.Observaciones || '' }))
									tr.append($('<td></td>', { html: objective?.Fisioterapeuta || '' }))
									table.append(tr)
								})
							} else {
								Object.keys(res[objectiveName]).forEach((order, key) => {
									const objective = res[objectiveName][key]
									const tr = $('<tr></tr>')
									tr.append($('<td></td>', { html: objective?.['Numero de sesión'] || '' }))
									tr.append($('<td></td>', { html: objective?.Actividades || '' }))
									tr.append($('<td></td>', { html: objective?.Observaciones || '' }))
									tr.append($('<td></td>', { html: objective?.Fisioterapeuta || '' }))
									table.append(tr)
								})
							}
						})
						$("#print-button").trigger('click');
						setTimeout(() => {
							$("#print-button").css("display", 'none');
							$("#col_table").html("");
						}, 2000);
					}
				}
			)
			let printEvolution = $("#printEvolution")
			let row = printEvolution.append($("<div></div>", { class: "row" }))
			let col = printEvolution.append($("<div></div>", { class: "col-lg-12" }))

		}

	@endif
</script>
@if(!empty($default))
	<div class="container" id="printEvolution"></div>
	<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Ver anteriores</a>
	<div class="container note_container">
		<div class="row">
			<div class="col-lg-12" id="col_table">
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal_print">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Objetivos</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row" id="print-checkboxes">
							@php $uniqueNames = !empty($allObjectives) ? $allObjectives->unique('json_values') : []; @endphp
							@foreach ($uniqueNames as $key => $objective)
								<div class="col-lg-12">
									<input type="checkbox" objectiveId="{{$objective->id}}"
										id="{{'cb_' . str_replace(' ', '', $objective->json_values)}}"
										name="printObjectives[{{$key}}]" value="{{$objective->json_values}}"> <label
										for="{{'cb_' . str_replace(' ', '', $objective->json_values)}}">{{$objective->json_values}}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="printObjectives()">Imprimir</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Evaluaciones Previas</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body note_container">
					@include('reports.row_print_report', ['img' => !empty($img) ? $img : false, 'hide_header' => false, 'hideImage' => true])
					<div class="container-fluid">
						@foreach($parameters as $parameter)
							<div class="row">
								<div class="col-lg-12" name='{{$parameter['name']}}' section='{{$parameter['section']}}'>
								</div>
							</div>
						@endforeach
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="changeEvaluation(false)">Anterior</button>
					<button type="button" class="btn btn-primary" onclick="changeEvaluation(true)">Siguiente</button>
					@if(Auth::user()->rol->id == 1 || Auth::user()->permissions->where('name', 'medical_office_session_treatments.delete')->count())
						<button type="button" class="btn btn-danger" onclick="deleteEvaluation()">Borrar</button>
					@endif
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
@endif
