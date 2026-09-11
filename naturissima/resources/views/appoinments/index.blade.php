@extends("layouts.basic")
@section("partial_js")
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
	<script type="text/javascript">
		$(function (){
			$('#datetimepicker10').datetimepicker({
			    format: 'YYYY-MM-DD',
			});
			$('#datetimepicker10').on("change.datetimepicker", filterByDate);
			$("#date_filter").val("{{date('Y-m-d', time())}}");
			$("#date_filter").trigger("change");
		});
		function filterByDate(event){
			$.ajax({
				url:"{{action('AppoinmentController@ajax_get_appoinments_from_date')}}/"+$("#date_filter").val(),
				method:"get",
				success:function(data){
					$("#div_table_agenda").html(data);
				}
			});

		}
	</script>
@endsection
@section("content")
	<div class="container">
		<div class="row">
			<label>Filtrar por fecha</label>
		</div>
		<div class="row">
			<div class="col-lg-5">
				<div class="input-group date" id="datetimepicker10" data-target-input="nearest">
				    <input type="text" id="date_filter" class="form-control datetimepicker-input" data-target="#datetimepicker10"/>
				    <div class="input-group-append" data-target="#datetimepicker10" data-toggle="datetimepicker">
				        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" id="div_table_agenda">

			</div>
		</div>
	</div>
@endsection