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
        {{Form::hidden('route_to_go', 'pacientes.index')}}
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
		</div>
		<div class="row">
			<div class="col-lg-2">
				{{Form::label('sex','Sexo')}}
				{{Form::select('sex',[0=>'masculino',1=>'femenino'],!empty($model) ? $model->sex : 0 ,['class'=>'form-control'])}}
			</div>
			<div class="col-lg-4">
				{{Form::label('occupation','Ocupación')}}
				{{Form::text('occupation',null,['class'=>'form-control'])}}
			</div>
			<div class="col-lg-4">
				{{Form::label('telephone','Telefono')}}
				{{Form::text('telephone',null,['class'=>'form-control', 'placeholder'=>'Teléfono'])}}
			</div>
			<div class="col-lg-2">
				{{Form::label('birth_date','Fecha de Nacimiento')}}
				{{Form::date('birth_date',null,['class'=>'form-control'])}}
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<label>Estado</label>
				<select class="form-control" id="select_birth_state" name="birth_state_id" select_municipality_id="#select_birth_municipality">
					@if($model)
						@if($model->birth_state_id)
								<option value="33">Seleccione un estado</option>
							@foreach($states as $state)
								<option value="{{$state->id}}" {{($state->id==$model->birth_state_id)?'selected':''}}>{{$state->name}}</option>
							@endforeach
                        @else
                            <option value="33" selected>Seleccione un estado</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
						@endif
					@else
                        <option value="33" selected>Seleccione un estado</option>
                        @foreach($states as $state)
                            <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
					@endif
				</select>
			</div>
			<div class="col-lg-4">
				<label>Municipio</label>
				<select class="form-control" id="select_birth_municipality" name="birth_municipality_id">
					<option value="1" selected>Seleccione un municipio</option>
				</select>
			</div>
			<div class="col-lg-8">
				{{Form::label('address','Calle y número:')}}
				{{Form::text('address',null,['class'=>'form-control'])}}
			</div>
			<div class="col-lg-6">
				{{Form::label('responsible_id','Responsable')}}
				{{Form::select('responsible_id',$responsibleIdOptions,
					!empty($model) ? $model->responsible_id : Auth::user()->id
				,['class'=>'form-control'])}}
			</div>
            <div class="col-lg-6">
                {{Form::label('email','Correo electrónico')}}
				{{Form::text('email',null,['class'=>'form-control'])}}
            </div>
		</div>
		<br/>
		<div class="row">
			<div class="col-lg-12">
				@if(empty($model))
					{{Form::submit("Crear paciente",['class'=>'btn btn-primary'])}}
				@else
					{{Form::submit("Modificar paciente",['class'=>'btn btn-primary'])}}
				@endif
			</div>
		</div>
		{{ Form::close() }}
	</div>
	@endsection
