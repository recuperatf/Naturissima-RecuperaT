
@extends('layouts.basic')
@section('partial_css')
  .rounded-corners-gray-bg {
    border-radius: 25px;
    background-color:rgba(255,255,255,0.5);
    background-position: left top;
    background-repeat: repeat;
    padding: 20px; 
    height: 400px;
    margin-top: 5vh;
    color:black;
  }
  .btn-primary{
    background-color:#2C5F2D;
    border-color:#2C5F2D;
  }
  .btn-primary:hover{
    background-color:#2C5F2D;
    border-color:#2C5F2D;
  }
  .btn-primary:active{
    background-color:#2C5F2D;
    border-color:#2C5F2D;
  }
  .parallax {
    background-image: url("images/wallpaper1.jpg"); 
    min-height: 500px; 
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
@endsection
@section('content')
<!--     <div class="parallax">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 rounded-corners-gray-bg mx-4" style="">
            <div class="container d-flex h-100">
                <div class="row justify-content-center align-self-center">
                 <h3>Somos tu mejor opción!</h3><br/>
                 <button class="btn btn-primary">Conócenos!</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  <div class="container">
    <div class="row">
        <div class="offset-lg-4 col-lg-4" style="text-align: center;">
          @if(\Session::has('message'))
            <div class="alert alert-success">
              {{\Session::get('message')}}
            </div>
          @endif
        </div>
        <div class="col-lg-12" style="text-align: center;">
            <h2>BIENVENIDO A NATURISSIMA PRODUCTOS NATURALES </h2>
        </div>
        <div class="col-lg-12">
          <br/>
          <h3>Visión</h3>
            Somos una empresa que se consolida en el mercado de las diferentes comunidades donde opera por ofrecer servicios de salud y terapéuticos de calidad así como productos alópatas y naturales tanto de empresas como artesanales con los que contribuimos a la salud de las personas y sus familias.
          <br/>
          <br/>
          <h3>Misión</h3>
            Desarrollar mecanismos de atención terapéutica natural y médica que permitan que las personas accedan a los mejores productos y servicios en beneficio de su salud.
          <br/>
          <br/>
          <h3>Principios</h3>
          <ul>
            <li>
              
            Sentido social por la salud de las comunidades con las que interactuamos
            </li>
            <li>
              
            Interés por apoyar con servicios de salud diversos la economía de las personas y las familias.
            </li>
            <li>
              
            Interés por conectar las capacidades de la comunidad para ofrecer servicios de salud.
            </li>
            <li>
              
            Responsabilidad para educar a las familias en los procesos de salud de su elección.
            </li>
            <li>
              
            Desarrollo de los mejores programas de salud a través de medicamentos y productos naturales que mejor contribuyan a su salud.
            </li>
          </ul>
          <br/>
        </div>
    </div>
  </div>
@endsection
