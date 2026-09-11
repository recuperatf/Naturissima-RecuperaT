@if(!empty($offers))
	<div class="col-lg-12">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		  	@php $cont=0; $first=true; @endphp
  	  	  	@foreach($offers as $offer)
		    	<li data-target="#carouselExampleIndicators" data-slide-to="{{$cont++}}" class="{{($first)?'active':''}}"></li>
  	  	    @endforeach
		  </ol>
		  <div class="carousel-inner">
		  	  	@php $first=true; @endphp
		  	  	@foreach($offers as $offer)
			  	  	@if($offer->img)
			  		    <div class="carousel-item {{($first)?'active':''}}">
			  		    	@php $first=false; @endphp
			  		      <img class="d-block w-100" style="max-height: 60vh;" src="/images/promociones/{{$offer->img}}" alt="First slide">
			  		    </div>
			  		@endif
		  	    @endforeach
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" style="max-height: 50vh;" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</div>
@endif
	@if(empty($home_content))
<div class="col-lg-10 offset-1">
	<div style="overflow: hidden;">
		<img style="float:right" class="home_image" src="images/mision.png"/>
		<h3 style="font-weight: bold">Visión</h3>
		<p>
			Ser el centro de fisioterapia-rehabilitación que se posicione en la cultura de las personas y familias de México, por ofrecer servicios y productos con un alto grado de innovación, en espacios confortables, con tecnología de punta y protocolos personalizados y profesionales de atención a la salud de la vida en movimiento
		</p>
	</div>
	<div style="overflow: hidden;">
		<img style="float:left; margin-right: 20px" class="home_image" src="images/vision.jpeg"/>
		<h3 style="font-weight: bold">Misión</h3>
		<p>
			Somos un centro de fisioterapia-rehabilitación que se distingue por ofrecer servicios y productos de la más alta efectividad, ya que contamos con personal capacitado, instalaciones modernas y equipo tecnológico. También nos prefieren por la diligencia emocional y física y atención a nuestros pacientes.
		</p>
	</div>
	<div style="overflow: hidden;">
		<img style="float:right; margin-right: 20px" class="home_image" src="images/valores.png"/>
		<h3 style="font-weight: bold">Valores</h3>
		<p>
			Personalización, atención emocional, actitud de servicio, empatía, puntualidad, eficiencia, eficacia, responsabilidad, ética en la promoción de la salud y honestidad 
		</p>
	</div>
	<div style="overflow: hidden;">
		<img style="float:left; margin-right: 20px" class="home_image" src="images/oferta_de_valor.jpg"/>
		<h3 style="font-weight: bold">Oferta de valor</h3>
		<p>
			Realizar acuerdos que apoyen tu economía mediante diferentes formas de pago para concluir el tratamiento terapéutico.
		</p>
	</div>
	<div style="overflow: hidden;">
		<img style="float:right; margin: 50px 20px; height: 20vw; width: 20vw;" class="home_image" src="images/contactanos.jpg"/>
		<h3 style="font-weight: bold">Contáctanos</h3>
		<h4 style="font-weight: bold">Valle imperial</h4>
		<p>
			Blvd. Valle imperial # 260 -18, cruza con Avenida Antiguo Camino a Copalita y Calle Las Torres, planta alta, Colonia La Periquera, C.P 45134, Zapopan Jalisco.
		</p>
		<p>
					<strong>
						Local:
					</strong>
					3396886699
					<br/>
					<strong>
						Celular (Whatsapp):
					</strong>
					3323517843
					<br/>
				</p>
		<img style="float:left; margin-right: 20px; height: 20vw; width: 20vw;" class="home_image" src="images/contactanos_t_center.jpeg"/>
		<h4 style="font-weight: bold">Plaza Paseo Sendas</h4>
		<p>
			Avenida Guadalajara 3523. Local 8, Fraccionamiento Sendas Residencial, CP.45134, Zapopan Jalisco.
		</p>
		<p>
					<strong>
					Celular (Whatsapp):
					</strong>
					(33) 2407-4211
					<br/>
				</p>
	</div>
</div>
	@else
		{!! $home_content->value !!}
	@endif