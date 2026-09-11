@php
$count=0;
@endphp
<div class="row">
	<div class="col-xl-12">
		<h4><strong>Valoración de Pares Craneales</strong></h4>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<h4><strong>Sistema Motor</strong></h4>
	</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor','S_label'=>'III par',
'S_info'=>'Afecta los músculos: Elevador del parpado superior. Rectos interno, superior o interior, oblicuo menor.
<br/>
Incluye las manifestaciones: Ptosis, ojo desviado hacia fuera y abajo, el ojo no se mueve ni hacia dentro ni hacia arriba ',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor',
'S_label'=>'IV par',
'S_info'=>'Afecta el músculo: Oblicuo mayor.
<br/>
Incluye las manifestaciones: El ojo no se mueve hacia bajo.',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor',
'S_label'=>'V par',
'S_info'=>'Afecta los músculos de la masticación.
<br/>
Incluye las manifestaciones: Trastorno de la masticación
Desviación de la boca hacia el lado del nervio lesionado ',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor','S_label'=>'VI par',
'S_info'=>'Afecta el músculo: Recto externo.
<br/>
Incluye las manifestaciones: Estrabismo convergente (ojo desviado hacia dentro)
<br/>
El ojo no se mueve hacia fuera',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor','S_label'=>'VII par',
'S_info'=>'Afecta los músculos faciales y cutáneo del cuello.
<br/>
Incluye las manifestaciones: Trastorno de la masticación <br/>
Desviación de la boca hacia el lado del nervio sano
<br/>
Signo de bell
<br/>
Espasmo hemifacial',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor','S_label'=>'IX par',
'S_info'=>'Afecta los músculos faríngeos.
<br/>
Incluye las manifestaciones: disfagia',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor','S_label'=>'X par',
'S_info'=>'Afecta los músculos: Músculos del velo palatino, Faríngeos, Laríngeos
<br/>
Incluye las manifestaciones: Desviación de la uvula, hacia el lado sano, disfagia, disartria',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor','S_label'=>'XI par',
'S_info'=>'Afecta los músculos: Esternocleidomastoideo, Trapecio
<br/>
Incluye las manifestaciones: Incapacidad para girar la cabeza y elevar el hombro',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_motor',
'S_label'=>'XII par',
'S_info'=>'Afecta la musculatura de la lengua
<br/>
Incluye las manifestaciones: Desviación de la lengua hacia el lado del nervio lesionado',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
</div>

<div class="row" style="margin-top: 50px">
	<div class="col-xl-12">
		<h4><strong>Sistema Sensorial</strong></h4>
	</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_sensorial',
'S_label'=>'I par',
'S_info'=>'Sistema sensorial: Olfato',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_sensorial',
'S_label'=>'II par',
'S_info'=>'Sistema sensorial: Vista',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_sensorial',
'S_label'=>'V par',
'S_info'=>'Sensibilidad: Cara',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_sensorial',
'S_label'=>'VII par',
'S_info'=>'Sensibilidad: Conducto auditivo interno.
<br/>
Gusto (dos tercios anteriores de la lengua)',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
'name'=>'valoration_cranial_nerves_sensorial',
'S_label'=>'VIII par',
'S_info'=>'Sistema sensorial: Oído',
'S_order'=>(++$count),
'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
@include('clinical_histories.valoration_row_cranial_nerve',[
	'name'=>'valoration_cranial_nerves_sensorial',
	'S_label'=>'IX par',
	'S_info'=>'Sistema sensorial: Gusto (tercio posterior de la lengua)',
	'S_order'=>(++$count),
	'default'=>(!empty($valorations)?$valorations:null),])
</div>
<div class="col-xl-4">
	@include('clinical_histories.valoration_row_cranial_nerve',[
		'name'=>'valoration_cranial_nerves_sensorial',
		'S_label'=>'X par',
		'S_info'=>'Sensibilidad: Conducto auditivo externo.',
		'S_order'=>(++$count),
		'default'=>(!empty($valorations)?$valorations:null),])
	</div>
</div>
