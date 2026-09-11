<h4>Una nueva cita se ha creado</h4>
<div>
  <strong>Paciente: </strong> {{$appointment->buyer_name}}
</div>
<div>
  <strong>Fecha: </strong> {{$appointment->appoinment_date}}
</div>
<div>
  <strong>Centro: </strong> {{$appointment->clinic ? $appointment->clinic->name : 'No especificado'}}
</div>
<div>
  <strong>Procedimiento: </strong> {{$appointment->product ? $appointment->product->name : 'No especificado'}}
</div>
<div>
  <strong>Teléfono del paciente: </strong> {{$appointment->telephone ?? 'No especificado'}}
</div>