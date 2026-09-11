@extends("layouts.basic")
@section("content")
<div class="container">
	<style>
		/* Get Startet Button */
		.appointment-btn {
				margin-left: 25px;
				background: #cb1e1e;
				color: #fff;
				border-radius: 50px;
				padding: 8px 25px;
				white-space: nowrap;
				transition: 0.3s;
				font-size: 14px;
				display: inline-block;
		}

		.appointment-btn:hover {
				background: #b31c1c;
				color: #fff;
		}
	</style>
	<div class="row">
		<div class="col-12">
			<div style="overflow: hidden;">
			<div style="overflow: hidden;">
				<img style="float:right; margin-right: 20px; height: 20vw; width: 20vw;" class="home_image" src="images/contactanos.jpg"/>
				<h3 style="font-weight: bold">Contáctanos</h3>
				<a class="btn btn-sm appointment-btn" style="text-decoration: none; color:white;" href="{{route('information.create')}}">Pide información</a>
				<h4 style="font-weight: bold">Valle Imperial</h4>
				<p>
					Blvd. Valle imperial # 260 -18, cruza con Avenida Antiguo Camino a Copalita y Calle Las Torres, planta alta, Colonia La Periquera, C.P 45134, Zapopan Jalisco.
				</p>
				<p>
					<strong>
					Teléfono local:
					</strong>
					(33) 9688-6699
					<br/>
					<strong>
						Celular (Whatsapp):
					</strong>
					(33) 2351-7843
					<br>
						<strong>Correo electrónico:</strong> recuperatf@gmail.com
				</p>
				<div style="overflow: hidden;">
					<img style="float:left; margin-right: 20px; height: 20vw; width: 20vw;" class="home_image" src="images/contactanos_sendas.jpg"/>
					<h4 style="font-weight: bold">Plaza Paseo Sendas</h4>
					<p>
						Avenida Guadalajara 3523.  Local 8, Fraccionamiento Sendas Residencial, CP.45134, Zapopan Jalisco.
					</p>
					<p>
						<strong>
						Teléfono local:
						</strong>
						(33) 3803-4475
						<br/>
						<strong>
							Celular (Whatsapp):
						</strong>
						(33) 2407-4211
						<br>
							<strong>Correo electrónico:</strong> recuperatf@gmail.com
					</p>
				</div>
			</div>
			{{-- <div style="overflow: hidden;">
				<img style="float:left; margin-right: 20px; height: 20vw; width: 20vw;" class="home_image" src="images/contactanos_t_center.jpeg"/>
				<h4 style="font-weight: bold">T-Center</h4>
				<p>
					Juan Gil Preciado #8905, Local 4, Tesistán. CP: 45200, Plaza T-Center
				</p>
				<p>
					<strong>
						Teléfono local:
					</strong>
						(33) 3803-4475
						<br/>
					<strong>
						Celular (Whatsapp):
					</strong>
					(33) 2407-4211
					<br>
					<strong>Correo electrónico:</strong> recuperatf@gmail.com
				</p>
			</div> --}}
			</div>
		</div>
	</div>
</div>
@endsection