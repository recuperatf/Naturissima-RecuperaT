@if($appoinments->count())
<table class="table table-responsive">
	<tr>
		
		<th>Nombre</th>	
		<th>Fecha</th>	
		<th>Terapia</th>	
		<th>Centro</th>	
		<th>¿A domicilio?</th>	
		<th>Telefono</th>	
		<th>Descuento</th>	
		<th>Acción</th>	
	</tr>
	@foreach($appoinments as $appoinment)
	<tr>
		<td>
			{{$appoinment->appoinment_patient_name}}
		</td>
		<td>
			{{$appoinment->appoinment_date}}
		</td>
		<td>
			@if(!empty($appoinment->product))
				{{$appoinment->product->name}}
			@endif
		</td>
		<td>
			@if(!empty($appoinment->clinic))
				{{$appoinment->clinic->name}}
			@endif
		</td>
		<td>
			@if($appoinment->delivery)
			{{$appoinment->name_send_address?$appoinment->name_send_address:"No especificada (contactar cliente)"}}
			@else
			{{"Consulta en centro"}}
			@endif
		</td>
		<td>
			{{$appoinment->telephone}}
		</td>
		<td>
			{{($appoinment->user_id)?'5%':'No'}}
		</td>
		<td>
			{{Form::open(['route'=>['appoinments.destroy', $appoinment->id], 'method'=>'DELETE'])}}
			@csrf
			<button type="submit" class="btn btn-danger">Borrar</button>
			{{Form::close()}}
		</td>
	</tr>
	@endforeach
</table>
@else
	No hay eventos para esta fecha
@endif
