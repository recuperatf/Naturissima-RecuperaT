<div class="row">
	<div class="col">
		<div id="printable">
		</div>
		<div id="editor"></div>
	</div>
</div>
<div class="row">
	<div class="col">
		<style>
			@media print {
				a[href]:after {
					content: none !important;
				}

				table tr,
				table tr th {
					page-break-inside: avoid;
				}
			}

			* {
				-webkit-print-color-adjust: exact;
			}

			.print_only {
				display: inline-block
			}

			.rubric_table {
				display: none
			}

			@page {
				size: auto;
				margin-top: 1cm 1in 1in 1in;
			}

			#printable h4,
			h5 {
				font-size: 12pt;
				font-weight: bold;
			}

			#printable strong {
				font-size: 12pt;
			}

			#printable p {
				font-size: 11pt;
			}

			.print_only {
				display: none
			}
		</style>
		<script type="text/javascript">
			$(function () {
				$(".btn_print").on('click', function (event) {
					if ($(event.target).hasClass('btn_fisioaleph')) {
						$("img.header_logo").attr("src", "/images/logo.png")
						$("img.header_logo").attr("style", "height: auto; width: 50%;")
					} else {
						$("img.header_logo").attr("src", "/medilab/assets/img/logo.png")
						$("img.header_logo").attr("style", "height: auto; width: 300px;")
					}
					const btn = $(event.target)
					let isViewing = btn.attr('view') == 1
					const myClone = $(".note_container").clone()
					$("#printable").append(myClone)
					$('#printable button.no_print').remove();
					$('#printable .no-print-if-empty').each(function () {
						var $textarea = $(this);
						var textareaName = $textarea.attr('name');
						if ($.trim($textarea.val()) === '') {
							$textarea.remove();
							$('#printable label[for="' + textareaName + '"]').remove();
						}
					});
					$('#printable .print_only,#printable table,#printable a.btn,#printable ,#printable input,#printable textarea,#printable label,#printable p, #printable .div_image_image_resources, #printable #div_tags_outside_resources').each(_formatPrinting);
					$('#printable button').remove();
					$('#printable [type=submit]').remove();
					$('#printable .no_print').remove();
					$('#printable .img_print').css("display", "inline");
					$('#printable .alert-success').remove();
					$('#printable script').remove();
					$("#printable").find('iframe').css('display', 'none')
					if (isViewing) {
						const printButton = $('<button></button>', {
							type: "button",
							html: "Imprimir",
							id: "print-button",
							class: "btn btn-primary"
						})
						printButton.click(_print)
						$("#printable>.container.note_container").prepend(printButton)
					}
					setTimeout(() => {
						$("#printable").find('.row.mb-3').each((key, row) => {
							colsContent = $(row).children('.col-lg-12,.col-lg-6').find('p,input,checkbox,strong,label,h1,h2,h3,h4,h5,h6')
							if (colsContent.length == 0) {
								$(row).remove()
							}
						}
						)
						$("p").each((key, p) => {
							if (!$(p).html()) {
								$(p).remove()
							}
						})
						__printIFrame()
						setTimeout(() => {
							if ($("#printable").find('iframe').length > 0) {
								__printIFrame()
							}
						}, 1000)
						function __printIFrame() {
							$("#printable").find('iframe').each((key, tag) => {
								tag = $(tag)
								container = $('#' + tag.prop("id")).contents().find('div.note_container')
								$(tag).replaceWith(container)
								container.find('.no_print_iframe').remove();
								container.find('table,a.btn,input,textarea,label,p,.div_image_image_resources,#div_tags_outside_resources').each(_formatPrinting)
								container.find('button,[type=submit],iframe,.no_print,.img_print').remove();
							})
						}
						if (!isViewing) {
							setTimeout(_print(), 500)
						} else {
							$(".container.note_container").first().children().not(':first').remove()
							$(".row.print-content").first().children().not(':first').remove()
						}
					}
						, '500');
					function _print() {
						$('#print-button').hide()
						$.print("#printable", {
							// Use Global styles
							globalStyles: true,

							mediaPrint: false,

							iframe: true,

							noPrintSelector: ".avoid-this",

							deferred: $.Deferred(),

							timeout: 250,

							title: null,

							doctype: '<!doctype html>'

						});
						$('#print-button').show()
						if (!isViewing) {
							$("#printable").children().remove();
						}
					}
				});
				$('form').on('keyup keypress', function (e) {
					var keyCode = e.keyCode || e.which;
					if (keyCode === 13) {
						e.preventDefault();
						return false;
					}
				});
				$(".autocompletable_cie10").on('input', function (event) {
					$(this).autocomplete({
						source: function (request, response) {
							$.ajax({
								url: "/ajax_get_cie10/" + $(event.target).val(),
								method: 'get',
								success: function (data) {
									response(data);
								}
							});
						},
						minLength: 0,
						delay: 0,
						max: 10,
						scroll: true,
						select: function (event, item) {
						}
					}).focus(function () {
						$(this).autocomplete("search");
					});
				});
				function _formatPrinting(key, tag) {
					tag = $(tag);
					if (tag.hasClass('print_only')) {
						tag.removeClass('print_only')
						return
					}
					if (tag.hasClass('no_print')) {
						tag.remove()
						return
					}
					if (tag.is("a") && tag.hasClass("btn")) {
						tag.remove()
					}
					if ((tag.prop('tagName') == 'TABLE' && !tag.hasClass('table-bordered')) || tag.hasClass('rubric_table')) {
						tag.removeClass('rubric_table')
						tag.css('border', '2px solid black')
						tag.css('margin-left', '20px')
						// tag.css('table-layout', 'fixed')
						tag.find('td').css('border', '2px solid black')
						tag.find('tr').css('border', '2px solid black')
					}
					if (tag.prop('type') == 'radio') {
						const tagId = tag.prop('id')
						label = tag.next()
						tagText = label.html()
						if (tagText && tag.is(':checked')) {
							tag.after('  ' + tagText);
							tag.remove()
							label.remove()
						} else {
							tag.remove();
							label.remove()
						}
						return
					}
					if (tag.prop('type') == 'checkbox') {
						const tagId = tag.prop('id')
						label = tag.next().prop("tagName") == "LABEL" ? tag.next() : $("#printable label[for='" + tag.prop('id') + "'")
						tagText = label.html()
						if (tag.attr('show_if_checked')) {
							if (!tag.is(':checked')) {
								tag.remove();
								label.remove();
							} else {
								tag.parent().parent().parent().find('.no_print').removeClass('no_print');
								tag.remove();
							}
							return;
						}
						if (tagText && tag.is(':checked')) {
							tag.replaceWith('  ' + tagText);
							label.remove()
						} else {
							tag.remove();
							label.remove()
						}
						return
					}
					if (tag.prop('type') == 'hidden' && !tag.hasClass('no_print')) {
						let text = tag.attr('print-value');
						if (tag.hasClass('hidden_href')) {
							let href = tag.attr('href');
							tag.replaceWith($('<a></a>', {
								html: `•${text}`,
								href,
								target: '_blank'
							}));
						} else {
							tag.replaceWith($('<p></p>', {
								html: text
							}));
						}
					}
					if (tag.prop('type') == 'submit') return;
					if (tag.prop("tagName") == "TEXTAREA") {
						let text = tag.html();
						tag.replaceWith($('<p></p>', {
							html: text,
							style: "text-align:justify; white-space: pre-line"
						}));
					} else if (tag.prop("tagName") == "INPUT") {
						let text = tag.val();
						tag.replaceWith($('<p></p>', {
							html: text,
							style: "text-align:justify"
						}));
					}
					else if (tag.prop("tagName") == "LABEL") {
						let text = tag.html();
						tag.replaceWith($('<label></label>', {
							html: $('<strong></strong>').html(text)
						}));
					}
					else if (tag.hasClass("div_image_image_resources")) {
						const regex = /(?<=(url\('))(.+(\..+'))?/;
						let imgUrl = tag.attr("style").match(regex);
						if (imgUrl) {
							imgUrl = imgUrl[0].slice(0, -1);
						}
						tag.replaceWith($('<img></img>', {
							src: imgUrl,
							style: "width:250px; height: auto; page-break-inside:avoid;"
						}));
					}
					else if (tag.attr('id') == 'div_tags_outside_resources') {
						tag.find('button').each((index, tagButton) => {
							$(tagButton).replaceWith($('<p></p>').html($(tagButton).html().replace(" ", "")));
						});
					}
				}
			});
		</script>
		<button type="button" id="btn_print" class="btn btn-primary btn_print" id="print-button">Imprimir</button>
		<button type="button" class="btn btn-primary btn_print btn_fisioaleph" id="print-button">Imprimir
			fisioaleph</button>
	</div>
</div>
<div class="row printable_header mt-5 mr-1 w-100">
	<div class="col text-center">
		<div>
			@if(!empty($img))
				<img class="img_print" src="{{"/$img"}}" alt="0" style="height: auto; width: 50%; display: none;">
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			@elseif(!empty($hideImage))
				<img class="img_print print_only img" src="/medilab/assets/img/logo.png" style="height: auto; width: 50%;">
			@endif
		</div>
		@if(Auth::user() && (empty($hide_header) || $hide_header == false))
			@include('patient.patient_header', ['author' => !empty($author) ? $author : null, 'responsible' => !empty($responsible) ? $responsible : null, 'laboralHeader' => !empty($laboralHeader) ? $laboralHeader : null, 'patient' => (!empty($patient) ? $patient : false)])
		@endif
		@if(strpos(request()->fullUrl(), 'from_global_search=1') !== false)
			<div>
				<img class="img_print" src="/medilab/assets/img/logo.png" style="height: auto; width: 40%; display: none;">
				<img class="img_print" src="/medilab/assets/img/fisioterapia_laboral_logo.jpg"
					style="height: auto; width: 30%; display: none;">
			</div>
			<div><strong>{{$O_model->human_name}}</strong></div>
			<strong>{{!empty($O_model['name']) ? $O_model['name'] : null}}</strong>
		@elseif(!empty($printTableHeader))
			<table class="table table-bordered ml-1 rubric_table">
				<tr>
					<td class="text-center"><img class="header_logo" src="/medilab/assets/img/logo.png"
							style="height: auto; width: 300px;" alt="recuperaT"></td>
					<td>Recupera-T fisioterapia, rehabilitación y nutrición</td>
					<td>Clave: {{!empty($O_model['code']) ? $O_model['code'] : 'S/C'}}</td>
				</tr>
				<tr>
					@php
						if (!empty($O_model)) {
							$modelClassName = get_class($O_model);
							$documentType = 'Documento';
							if (strpos($modelClassName, 'DiagnosisPlan')) {
								$documentType = 'Prueba o medida funcional';
							}
							if (strpos($modelClassName, 'TerapeuticPlan')) {
								$documentType = 'Plan terapéutico';
							}
							if (strpos($modelClassName, 'HomePhysiotherapyProgram')) {
								$documentType = 'Programa terapéutico en casa';
							}
							if (strpos($modelClassName, 'Protocol')) {
								$documentType = 'Protocolo';
							}
						}
					@endphp
					<td class="text-center">{{!empty($documentType) ? $documentType : ''}}</td>
					<td class="text-center">Versión {{!empty($O_model['version']) ? $O_model['version'] : 0}}</td>
				</tr>
				<tr>
					<td>{{!empty($O_model['updated_at']) ? Carbon\Carbon::parse($O_model['updated_at']) : null}}</td>
					<td>{{!empty($O_model['name']) ? $O_model['name'] : null}}</td>
					<td>Páginas {{!empty($O_model['pages']) ? $O_model['pages'] : 'ND'}}</td>
				</tr>
				<tr>
					<td></td>
					<td>Elaboró: {{!empty($O_model['made_by']) ? $O_model['made_by'] : ''}}</td>
					<td>Revisó: {{!empty($O_model['revised_by']) ? $O_model['revised_by'] : ''}}</td>
				</tr>
			</table>
		@endif
	</div>
</div>