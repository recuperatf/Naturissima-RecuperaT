@if (empty($client_view))
  @extends('layouts.basic')
@endif
@section('content')



@php
	$count = 0;
	$sections = [
		'Antecedentes Patolóticos del Paciente' => [
			'diabetes' => 'Enfermedad en la que los niveles de glucosa (azúcar) de la sangre están muy altos',
			'Cáncer: ' => 'Enfermedad en la que células anómalas se dividen sin control y destruyen los tejidos corporales',
			'Enfermedades reumatológicas'=>'Artritis, Osteoporosis',
			'Cirugías:'=>
			'Cualquier intervención quirúrgica realizada',
			'Hipertensión: ' =>
			'Afección en la que la presión de la sangre hacia las paredes de la arteria es demasiado alta.',
			'Fracturas:' =>
			'Cualquier hueso roto',
			'Esguinces:' =>
			'Estiramiento o rasgadura de los ligamentos,',
			'Afecciones de la columna:'=>
			'Anomalías en la columna vertebral'
		],
		'Estado de la piel' => [
			'Textura:'=>
			'Normal, con o sin manchas, etc.',
			'Color:'=>
			'Que no exista alguna alteración en el color.',
			'Temperatura:'=>
			'La temperatura cutánea es de 33.5 °C',
			'Cicatriz:'=>
			'Crecimiento del tejido que marca el lugar donde la piel se curó después de una lesión.',
			'Máculas:'=>'Lesiones cutáneas (manchas)',
			'Otro:'=>''

		],
		'Intervención quirúrgica:'=>[
			'Tipo de intervención:'=>
			'Nombre de la cirugía ',
			'Tiempo de reposo post operatorio:'=>
			'Tiempo de descanso después de la cirugía',
			'Uso de férula-ortesis- prótesis:'=>
			'Las indicadas por el medico (pre o post operatorias)',
			'Indicaciones medicas:'=>
			'Estas nos dirán como progresar con el paciente.',
			'Contraindicaciones absolutas:'=>
			'Movimientos o medios físicos prohibidos',
			'Contraindicaciones relativas:'=>
			'Se debe tener precaución, pero no están prohibidas.'
		],
		'Edema'=>[
			'Unilateral o bilateral:'=>
			'Se presenta en un solo lado del cuerpo o en ambos.',
			'Llenado capilar:'=>
			'Normal: No debe superar 2 segundos, volviendo al color original.',
			'Fóvea:'=>
			'Acumulación de liquido Al dejar presionado se produce hundimiento y persiste.',

		],
		'Dolor'=>[
			'En reposo:'=>
			'Se presenta sin movimiento.',
			'A la palpación:'=>
			'Solo si tocas las estructuras dañadas',
			'En movimiento:'=>
			'Se presenta la molestia si realizas algún movimiento',
			'Localización:'=>
			'Segmento, dermatoma, proximal o distal',
			'Intensidad:'=>
			'En escala de EVA , Del 1-10 que tan doloroso es.',
			'Duración:'=>'Agudo o crónico',
			'Frecuencia:'=>'Continuo , Ocasional, Intermitente, Periódico',
			'Origen:'=>
			'Respiratorio, vascular, respiratorio, osteomuscular.',
			'Parestesias:'=>
			'Sensación de hormigueo',
			'Anestesia:'=>
			'Ausencia de la sensibilidad',
			'Analgesia:'=>
			'Ausencia del dolor a un estímulo que si es doloroso',
			'Hipoalgesia:'=>
			'Disminución de la sensibilidad al dolor.',
			'Hiperalgesia:'=>
			'Incremento del dolor',
			'Hipoestesia:'=>
			'Disminución de sensibilidad térmica y superficial.',
			'Hiperestesia:'=>
			'Incremento o exageración de sensibilidad térmica y superficial.',
			'Alodinia:'=>
			'Percepción anormal del dolor (habitualmente es indoloro)',
			'Neuralgia:'=>
			'Dolor que viaja a lo largo de un nervio.',
			'Disestesia:'=>
			'Percepción táctil anormal y desagradable',
			'Otro:'=>''
		],
		'Espasmos musculares'=>[
			'Sitio' => 'Lugar donde se presenta la contracción involuntaria del músculo'
		],
		'Sensibilidad' => [
			'Sentido de posición: '=>
			'Capacidad de sentir la posición relativa de partes corporales.',
			'Sentido de movimiento:'=>
			'Capacidad de sentir el movimiento articular de partes corporales.',
			'Tacto: '=>
			'Sentido corporal mediante el cual se perciben el contacto o la presión de las cosas sobre la piel.',
			'Topognosia:'=>
			'Capacidad de reconocer con los ojos cerrados que segmentos del cuerpo son estimulados.',
			'Grafestesia:'=>
			'Percibir y reconocer figuras trazadas sobre una porción de la piel, teniendo los ojos cerrados',
			'Discriminación de dos puntos:'=>
			'Distinguir el contacto de dos puntos cercano que se aplican simultáneamente en la piel.'
		],
		'Actitudes posturales anormales'=>[
			'Alteraciones en el tono:'=>
			'Hipotonía, hipertonía, espasticidad, rigidez.',
			'Posturas viciosas:'=>
			'Alteraciones posturales,
						Por ejemplo, la hiperlordosis',
			'Desequilibrios musculares:'=>
			'Discordancia de tono muscular, Potenciar músculos fásicos y relajar los tónicos.',
			'Otro:'=>''
		],
		'Abordaje fisioterapéutico:'=>[
			'Inicio de fisioterapia:'=>
			'Dia que esta indicado para detener el reposos despues de la cirugia y comenzar fisioterapia ',
			'Grados de arco de movimiento por semana:'=>
			'Dependiendo la cirugía son los grados indicados que debe lograr un paciente cada semana.',
			'Semana que comenzamos ejercicios pasivos, pasivo-activo y activos:'=>
			'Determinar que movilizaciones son las indicadas para el paciente que depende de la semana o fase de la fisioterapia en que vaya el paciente',
			'Semana que comenzamos a cargar peso'=>
			'Semana en la que comenzaremos a fortalecer que depende de la semana o fase de la fisioterapia en que vaya el paciente',
			'Semana que se inicia el ejercicio propioceptivo'=>
			'Planificación de ejercicios de estabilidad y equilibrio que depende de la semana o fase de la fisioterapia en que vaya el paciente',
			'Semana que se inicia la marcha'=>
			'Comenzar con la reducación de la marcha,
						(basados en el caso clinico) y que depende de la semana o fase de la fisioterapia en que vaya el paciente',
			'Semana de agente físico'=>
'			Dar prioridad a eliminar el dolor después progresar
			Tipos de agentes físicos ideales para el paciente.
			Que depende de la semana o fase de la fisioterapia en que vaya el paciente',
			'Días recomendados para asistir a Fisioterapia'=>
			'Esto dependerá de la intensidad y frecuencia del dolor y tambien dependera de la semana o fase de la fisioterapia en que vaya el paciente'

		]
	];
@endphp
{{Form::model($model,['route'=>['historia.store',$patient_id],'id' =>'form_fisioterapia'])}}
@if($model)
{{ method_field('PATCH') }}
@endif
@push('css')
<style type="text/css">
	.ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
    }
</style>
@endpush
@push('javascript')
@endpush
@include('menus.sidebar_protocolos');
{{Form::model($model,['route'=>['historia.store',$patient_id]])}}
<div class="container note_container">
	@include('reports.row_print_report', ['hideImage' => true])
	<div class="row">
		<div class="col-xl-12">
			@if (session('modifiedSuccess'))
			    <div class="alert alert-success">
			        {{ session('modifiedSuccess') }}
			    </div>
			@endif
		</div>
	</div>
	<div class=row>
		<div class="col-xl-12">
			<h2><strong>VALORACIÓN DE FISIOTERAPIA ORTOPEDICA</strong></h2>
		</div>
	</div>
	{{Form::hidden('patient_id',$patient_id)}}

	<div class="row">
		<script type="text/javascript">

		</script>
		@foreach($sections as $s_name => $section)
			<div class="col-lg-12">
				<strong>{{$s_name}}</strong>
			</div>
			@foreach($section as $e_name => $element)
				<div class="col-lg-4">
					@include('clinical_histories.valoration_row',			[
								'name'=>'valoration_orthopedy',
								'S_label'=>$e_name,
								'S_order'=>(++$count),
								'explanation'=>$element,
								'default'=>($valorations)?
								$valorations->where('section','valoration_orthopedy'):
								[]
								])
				</div>
			@endforeach
		@endforeach
</div>
<div class="row">
    <div class="col-lg-12">
        {{Form::submit('Aceptar',['class'=>'btn btn-primary'])}}
    </div>
</div>
{{Form::close()}}
@endsection
