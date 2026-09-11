@if($appoinments->count())
<table class="table table-responsive">
	<tr>
		
		<th>Nombre</th>	
		<th>Fecha</th>	
		<th>Consultorio</th>	
		<th>Direccion</th>	
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
			{{$appoinment->product->name}}
		</td>
		<td>
			@if($appoinment->delivery)
			{{$appoinment->name_send_address?$appoinment->name_send_address:"No especificada (contactar cliente)"}}
			@else
			{{"Consulta en farmacia"}}
			@endif
		</td>

	</tr>
	@endforeach
</table>
@else
	No hay eventos para esta fecha
@endif
