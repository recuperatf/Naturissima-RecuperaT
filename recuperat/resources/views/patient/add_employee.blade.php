@extends("layouts.basic")
@section('partial_js')
<script type="text/javascript" src="/js/globals2.js"></script>
<script type="text/javascript" src="/js/product_checkout.js"></script>
<script type="text/javascript">
	$(function(){
		$("#select_birth_state").trigger("change");
		@if($model)
			setTimeout(function(){
				selected_municipality={{($model->birth_municipality_id)?$model->birth_municipality_id:'false'}};
				$("#select_birth_municipality").val(selected_municipality).change();
			},500);
		@endif
	});
</script>
@endsection
@section("content")
<div class="container">
	<div class="row">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
	</div>
		{{Form::model($model, array('route' => array((($model)?'pacientes.update':'pacientes.store'), $model)))}}
		@if($model)
			{{ method_field('PATCH') }}
		@endif
		{{Form::hidden('is_laboral', 1)}}
		<div class="row">
			<div class="col-lg-4">
				{{Form::label('name','Nombre(s)')}}
				{{Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Nombre (s)'])}}
			</div>
			<div class="col-lg-4">
				{{Form::label('surname','Apellido Paterno')}}
				{{Form::text('surname',null,['class'=>'form-control', 'placeholder'=>'Apellido Paterno'])}}
			</div>
			<div class="col-lg-4">
				{{Form::label('second_surname','Apellido Materno')}}
				{{Form::text('second_surname',null,['class'=>'form-control', 'placeholder'=>'Apellido Materno'])}}
			</div>
			<div class="col-lg-4">
				{{Form::label('laboral_company_id','Empresa')}}
				{{Form::select('laboral_company_id', $laboralCompanies, null, ['class'=>'form-control'])}}
			</div>
            <div class="col-lg-4">
				@include('inputs.ajax_autocompletable_multiple',
					[
						'value'=>["label"=>"Puesto", "key"=>"workspace", "name" => "workspace", "class" => "workspace", "url" => "workspaces/ajaxGet"],
						'single' => true,
						'addRoute' => 'workspaces.create',
						'viewRoute' => 'workspaces.show',
						'defult_values' => !empty($model) && $model->workspace ? [
                            $model->workspace
                        ] : []
					])
			</div>
			<div class="col-lg-2">
				{{Form::label('sex','Sexo')}}
				{{Form::select('sex',[0=>'masculino',1=>'femenino'],0,['class'=>'form-control'])}}
			</div>
			<div class="col-lg-2">
				{{Form::label('birth_date','Fecha de Nacimiento')}}
				{{Form::date('birth_date',null,['class'=>'form-control'])}}
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-lg-12">
				@if(empty($model))
					{{Form::submit("Crear empleado",['class'=>'btn btn-primary'])}}
				@else
					{{Form::submit("Modificar empleado",['class'=>'btn btn-primary'])}}
				@endif
			</div>
		</div>
		{{ Form::close() }}
	</div>
	@endsection
