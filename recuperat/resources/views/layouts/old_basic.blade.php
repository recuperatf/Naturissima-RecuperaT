<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="{!! mix('js/app.js') !!}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/62e662feb2.js"></script>
  <script src="/js/print.min.js"></script>
  <!-- FontAwesome -->
  <link
  rel="stylesheet"
  href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="apple-touch-icon" sizes="57x57" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="060cead63688ab551c45d867bc4cba2b.ico/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="060cead63688ab551c45d867bc4cba2b.ico/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="060cead63688ab551c45d867bc4cba2b.ico/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="060cead63688ab551c45d867bc4cba2b.ico/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="060cead63688ab551c45d867bc4cba2b.ico/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
{{--   <link href="css/summernote.css" rel="stylesheet">
  <script src="js/summernote.min.js"></script> --}}
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="060cead63688ab551c45d867bc4cba2b.ico/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  @stack('javascript')
  @stack('css')
  <script type="text/javascript">
    $(function(){
      $("body").fadeIn(1000);
      $("#a_login").on('click',function() {
        $("#form_login").submit();
      });
      $("#a_logout").on('click',function(event) {
        event.preventDefault();
        $("#form_logout").submit();
      });
    });
  </script>
  @yield("partial_js")
  <title>{{env("APP_NAME")}}</title>
  <style type="text/css">
    @yield("partial_css")
    body{
      padding-top: 57px;
    }
    .pagination{
      text-align: center;
    }
    .nav-item:not(.nav-right){
      font-family:Book Antiqua;
       /*border-right-style: groove;*/
       /*border-right-color: rgb(192,192,192);*/
    }
    .container>span{
      cursor:pointer;
      height: 200px;
      width: 200px;
      margin-bottom: 10px;
    }
    @media (max-width: 800px) {
      .carousel-item>img{
        height: 30vh;
        width: 100vw;
      }
      .logo_img{
        height:3vh;
        width: 15vw;
      }
      .nav-item{
        text-align: center;
      }
    }
    @media (min-width: 801px) {
      .carousel-item>img{
        height: 100vh;
        width: 100vw;
      }
      .logo_img{
        height:15vh;
        width: 25vw;
      }
    }
    i, span{
      cursor:pointer;
      margin-bottom: 10px;
    }

    .justify_text{
      text-align: justify;
      text-justify: inter-word;
    }
    .footer-copyright{
    }
    .page-footer{
      background-color: rgba(64,193,172, 1);
    }
    .navbar-dark{
      background-color: #FFF;
    }
    body{
      display: none;
    }

    .line{
      border-color: rgba(28, 115, 52,100);
      border-style: solid;
      border-width: bold;
      margin-bottom: 1px;
    }
    .sponsor_img{
        max-height: 80px;
        max-width: 80px;
    }
    .nav-link {
      font-family: 'Open Sans', sans-serif;
      font-size: 17px;
      font-style: normal; font-variant: normal;
      /*font-weight: 700; */
      line-height: 26.4px;
      color: rgba(22, 54, 20,100)}
    .nav-link:hover {
      background-color: #74b56b66;
      color: #456c37bd !important;
    }
  </style>
</head>
<body>
{{--   <div class="d-flex flex-row" style="margin: 0px 20px 0px 20px">
    <div style="margin-right: 10px">
      <a href="https://twitter.com/Recuperat3" target='_blank'>
      <span>
        <i class="fab fa-twitter-square fa-2x"></i>
      </span>
      </a>
    </div>
    <div style="margin-right: 10px">
      <a target="_blank" href="https://www.facebook.com/profile.php?id=100079561466852">
        <span>
          <i class="fab fa-facebook-square fa-2x"></i>
        </span>
      </a>
    </div>
    <div style="margin-right: 10px">
      <a target="_blank" href="https://www.instagram.com/explore/locations/2231465163776299/recupera-t-fisioterapia-rehabilitacion/" style="text-decoration: none; color:pink;">
        <span>
          <i class="fab fa-instagram fa-2x"></i>
        </span>
      </a>
    </div>
    <div style="margin-right: 10px">
      <a target="_blank" style="color:red;" href="https://www.youtube.com/channel/UCeAc7ypqE35wJ-vQgO9M-tQ/">
        <span>
          <i class="fab fa-youtube-square fa-2x"></i>
        </span>
      </a>
    </div>
    <div class="ml-auto">
      <a href="https://www.usana.com/pwp/#/site/274842322/page/751604" target="_blank">
        <img class="sponsor_img" src="{{ ('/images/patrocinadores/' . 'usana_logo.jpeg') }}">
      </a>
      <a href="http://www.naturissimafarmacia.com/store?is_grevill=true" target="_blank">
        <img class="sponsor_img" src="{{ ('/images/patrocinadores/' . 'grevill_logo.png') }}">
      </a>
    </div>
  </div> --}}
{{--     <div class="d-flex flex-column">
          <div class="d-flex justify-content-center" style="">

    </div> --}}
  </div>
  <nav class="navbar navbar-light navbar-expand-lg">
          <a class="navbar-brand" href="#"><img src="{{ ('/images/' . 'logo.png') }}" class="logo_img"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class=" ml-auto navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="/">Inicio{{-- <span class="sr-only">(current)</span> --}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{action('ServicesController@index')}}">Servicios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('tienda.index')}}">Productos</a>
              </li>

{{--               <li class="nav-item">
                <a class="nav-link" href="{{route('cursos.index')}}">Cursos en Linea</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="http://localhost:5555">Fisio Lab.</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="{{route('appoinments.create')}}">Agenda tu cita <br/>
{{--                   @if(!empty($global_discount))
                    <text style="color:green; font-size: 8pt">Todo con {{$global_discount*100}}% de descuento</text>
                  @endif --}}
                </a>
              </li>
{{--               <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="admin_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Empresas
              </a>
              <div class="dropdown-menu" aria-labelledby="admin_dropdown">
                <a class="dropdown-item" href="#">¿Quienes somos?</a>
                <a class="dropdown-item" href="#">¿Qué Hacemos?</a>
              </div>
            </li> --}}
{{--             <li class="nav-item">
              <a class="nav-link" href={{route('companies')}}>Empresas</a>
            </li>  --}}
              <li class="nav-item">
                <a class="nav-link" href={{action('OfferController@indexForClients')}}>Promociones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('contacto.index')}}">Contacto</a>
              </li>
            </ul>
          </div>
        </div>
        {{-- <div class="col-lg-4"> --}}

          <ul class="navbar-nav">
            <li class="nav-item nav-right">
              <a href="/checkout" class="nav-link">
                <i class="fa fa-shopping-cart" style="display: inline;"></i><div style="display: inline;" id="div_cart_size">({{sizeof((
                  (session()->get("IDs_cart_products"))?session()->get("IDs_cart_products"):[]
                ))}})</div>
              </a>
            </li>

            @if(!Auth::user())

            <li class="nav-item">
              <a href="{{action('HomeController@index')}}" class="nav-link" data-toggle="modal" data-target="#loginmodal">Inicio</a>
            </li>
{{--             <li class="nav-item">
              <a href="/register" class="nav-link">Registro</a>
            </li> --}}
            @else
            @if(Auth::user())
            @if(Auth::user()->admin)
            <li class="nav-item nav-right dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="admin_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
              </a>
              <div class="dropdown-menu" aria-labelledby="admin_dropdown">
                <a class="dropdown-item" href="{{route('users.index')}}">Usuarios</a>
                <a class="dropdown-item" href="{{route('information.index')}}">Preguntas</a>
                <a class="dropdown-item" href="#">Órdenes</a>
                <a class="dropdown-item" href="{{route('home.edit')}}">Editar Página de Inicio</a>
                <a class="dropdown-item" href="{{route('ofertas.index')}}">Ofertas</a>
                <a class="dropdown-item" href="{{action('ProductController@index', ['unclassified'=>true])}}">Productos Sin Clasificar</a>
                <a class="dropdown-item" href="{{action('AppoinmentController@index')}}">Citas</a>
                <a class="dropdown-item" href="{{route('clinics.index')}}">Centros</a>
                <!-- <div class="dropdown-divider"></div> -->
              </div>
            </li>
            <li class="nav-item nav-right dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="admin_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Catálogos Salud
              </a>
              <div class="dropdown-menu" aria-labelledby="admin_dropdown">
                <a class="dropdown-item" href="{{route('cie10.index')}}">Catálogo CIE10</a>
                <a class="dropdown-item" href="{{route('cie9_mc.index')}}">Catálogo CIE9-CM</a>
                <!-- <div class="dropdown-divider"></div> -->
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('protocolos_fisioterapia.index')}}">Protocolos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('diagnosis_plan.index')}}">Planes Diagnósticos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('home_physiotherapy_program.index')}}">Programas Fisioterapéuticos en Casa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('terapeutic_plan.index')}}">Planes Terapéuticos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('bibliography.index')}}">BD Documental</a>
            </li>
            @endif
            @endif
            <li class="nav-item nav-right">
              <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index')}}">Consulta</a>
            </li>
            <li class="nav-item nav-right">
              <form action="{{url('/logout')}}" id="form_logout" method="post">
                @csrf
              </form>
                <a id="a_logout" class="nav-link" href="#" style="cursor: pointer;">Cerrar Sesión</a>
            </li>

            @endif
          </ul>
        {{-- </div> --}}
  </nav>
  @if(isset($loginError))
    {{$loginError}}
  @endif
  {{-- <div class="line" style="margin-bottom: 50px"></div> --}}

  <!-- Modal -->
  <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div>
          <form action="{{'/login'}}" id="form_login" method="post">
              @csrf
              <label>E-mail</label>
              <input type="text" class="form-control" name="email">
              <label>Contraseña</label>
              <input type="password" class="form-control" name="password">
          </form>
            </div>
            <div>
              <a href=""><small>Olvidé mi contraseña</small></a>
            </div>
          </div>
          <div clasLoginControllers="modal-footer" style="text-align: right; padding-right: 10px; padding-bottom: 10px">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a id="a_login"><button type="button" class="btn btn-primary">Inicio!</button></a>
        </div>
      </div>
    </div>
  </div>
  @yield("content")
  @include('layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/template.min.js"></script>
<style type="/css/template.css"></style>
</body>
</html>
