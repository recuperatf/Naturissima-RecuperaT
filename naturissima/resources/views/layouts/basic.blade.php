<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="google-site-verification" content="Y2ZZT84fVxEEBfcLUHc8k2wdESKZgxhj4ynm9mU2uaU" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
  <script src="https://use.fontawesome.com/62e662feb2.js"></script>
  <link rel="apple-touch-icon" sizes="57x57" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="a072b9cdda859bdea87acfd1a2d51366.ico/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"
    href="a072b9cdda859bdea87acfd1a2d51366.ico/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="a072b9cdda859bdea87acfd1a2d51366.ico/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="a072b9cdda859bdea87acfd1a2d51366.ico/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="a072b9cdda859bdea87acfd1a2d51366.ico/favicon-16x16.png">
  <link rel="manifest" href="a072b9cdda859bdea87acfd1a2d51366.ico/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="a072b9cdda859bdea87acfd1a2d51366.ico/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script type="text/javascript">
    $(function () {
      $("body").fadeIn(1000);
      $("#a_submit_login").click(function (event) {
        $("#form_login").submit();
      });
      $("#span_global_search").click(function () {
        $("#form_global_search").submit();
      });
      $("#a_logout").click(function () {
        $("#form_logout").submit();
      });
      $("#span_whatsapp").tooltip({ trigger: 'click' });

    });
    function searchGrevill() {
      $("#form_grevill").submit();
    }
  </script>
  @yield("partial_js")
  <title>{{env("APP_NAME")}}</title>
  <style type="text/css">
    @yield("partial_css")
    .logo_patrocinador {
      max-width: 50px;
      max-height: 50px;
    }

    body {
      /*padding-top: 57px;*/
    }

    .pagination {
      text-align: center;
    }

    .container>span,
    img {
      cursor: pointer;
      height: 200px;
      width: 200px;
      margin-bottom: 10px;
    }

    i,
    span {
      cursor: pointer;
      margin-bottom: 10px;
    }

    .carousel-item>img {
      height: 100vh;
      width: 100vw;
    }

    .justify_text {
      text-align: justify;
      text-justify: inter-word;
    }

    .footer-copyright {
      background-color: #FC9406;
    }

    .page-footer {
      background-color: #06CE34;
    }

    .navbar-dark {
      background-color: #FFF;
    }

    body {
      display: none;
    }

    .logo_img {
      height: 20vh;
      width: 20vh;
    }

    .nav-item {
      font-size: 16pt;
    }

    .nav>li>a {
      padding: 10px 5px 10px 5px !important;
      text-decoration: none !important;
      font-size: 16pt !important;
    }

    .nav-tabs>li {
      border-color: #FFF gray #FFF gray;
      border-width: 0px 2px 0px 2px;
    }

    .minisections {
      cursor: pointer;
      padding: 10px;
      font-size: 14pt;
      text-align: center;
      font-weight: bold;
      /*border-radius: 5px;*/
    }

    .minisections:hover {
      background-color: rgba(0, 94, 19, 0.80);
      text-align: center;
      font-weight: bolder;
      /*border-radius: 5px;*/
    }

    .nav-bar-categories {
      background-color: #5ed58d;
    }

    a.category {
      color: #e8f7e7;
    }

    a.category:hover {
      color: white;
    }

    .alert-danger {
      display: block;
    }
  </style>
</head>

<body>

  <div class="container-fluid nav-bar-categories">
    <div class="row">
      <div class="col-6 text-left" style="color: white">
        <span><i class="fab fa-phone"></i> Teléfonos (33) 9688-6699 y (33) 3803 4475</span>
        <span><i class="fab fa-whatsapp"></i> (33) 2351-7843 y (33) 2407 4211</span>
      </div>
      <div class="col-3 text-right" style="color: white">
        <span><i class="fa-solid fa-location-dot"></i>Punto de venta: Boulevard Valle Imperial 260-18. Valle Imperial
          C.P. 45134. Zapopan, Jalisco, México.</span>
      </div>
      <div class="col-3 text-right" style="color: white">
        <span><i class="fa-solid fa-location-dot"></i>Punto de venta: Avenida Guadalajara 3523. Local 8, Fraccionamiento
          Sendas Residencial. C.P 45140, Zapopan, Jalisco.</span>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        {{-- <div class="col-lg-12 d-inline-flex w-100 text-center" style="background-color:rgba(93, 193, 185, 0.30);">
          --}}
          <?php
$count_categories = $categories->count();
$div_width = (100 / $count_categories);
            ?>
          <div class="row no-gutters">
            <div class="col-4 col-md-2">
              <a class="category" href="/">
                <div class="div-flex minisections text-center w-100 h-100">
                  Inicio
                </div>
              </a>
            </div>
            @php
        $categories = $categories->sortBy('name')->values();
        @endphp
            @foreach($categories as $category)
        @if($category->name == "Medicamentos")
      @continue
    @endif
        @if($category->id !== 6 && $category->id !== 9 && $category->id !== 5 && $category->id !== 8 && $category->id !== 4)
      <div class="col-4 col-md-2">
        <a class="category" href="{{action('ProductCategoriesController@viewCategory',$category->id)}}">
        <div class="div-flex minisections text-center w-100 h-100">
        {{$category->name}}
        </div>
        </a>
      </div>
    @endif
      @endforeach
            <div class="col-4 col-md-2">
              <a class="category" target="_blank" href="https://biblioteca.fisioaleph.com/xmlui/handle/123456789/26">
                <div class="div-flex minisections text-center w-100 h-100">
                  Biblioteca Digital
                </div>
              </a>
            </div>
          </div>
          {{--
        </div> --}}
      </div>
    </div>
  </div>
  <form action="{{route('store.index')}}" method="get" id="form_global_search">
    <div class="col-md-4 col-sm-3 col-10 offset-md-4 col-1">
      <div class="input-group mb-3" style="margin-top: 10px">
        <input type="text" name="search_terms" class="form-control" placeholder="Búsqueda sin filtro">
        <div class="input-group-append">
          <span id="span_global_search" type="submit" class="input-group-text" class="btn btn-secondary">Buscar</span>
        </div>
      </div>
    </div>
  </form>
  <div class="d-flex flex-row" style="margin: 0px 20px 0px 20px">
    <div style="margin-right: 10px">
      <span id="span_whatsapp" style="color:#25D366" data-toggle="tooltip" trigger="click"
        title="Solo mensajes: (33) 2329-4869">
        <i class="fab fa-whatsapp-square fa-2x"></i>
      </span>
      <span id="span_facebook" style="color:#4267B2">
        <a href="https://www.facebook.com/Naturrissima/" target="_blank"><i
            class="fab fa-facebook-square fa-2x"></i></a>
      </span>
    </div>
    <div class="ml-auto">
    </div>
    <div class="class=" ml-auto"">
    </div>
  </div>
  <nav class="navbar navbar-light navbar-expand-lg">
    <div class="d-inline-flex">
      <div>
        <a href="/">
          <img class="logo_img" src="{{url('images/logo.png')}}">

        </a>
      </div>
      <div class="align-self-center">
        <div class="">
          <a href="/" style="color:black; text-decoration: none;">
            <h3 style="font-variant: small-caps;">Naturissima Productos Naturales</h3>
          </a>
        </div>
        <div class="">
          <a href="/" style="color:black; text-decoration: none;">
            Tu salud al natural
          </a>
        </div>
      </div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item nav-right">
          <a class="nav-link" href="{{route('store.index')}}">Tienda</a>
        </li>
        <li class="nav-item nav-right">
          <a class="nav-link" href="{{route("contacto.index")}}">Contacto</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="/checkout" class="nav-link">
            <i class="fa fa-shopping-cart"></i>
            <div style="display: inline;" id="div_cart_size">({{sizeof((
  (session()->get("IDs_cart_products")) ? session()->get("IDs_cart_products") : []
))}})</div>
          </a>
        </li>
        @if(!Auth::user())

      <li class="nav-item">
        <a href="#" class="nav-link" data-toggle="modal" data-target="#loginmodal">Iniciar Sesión</a>
      </li>
    @else
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="admin_dropdown" role="button" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      Administración
      </a>
      <div class="dropdown-menu" aria-labelledby="admin_dropdown">
      <a class="dropdown-item" href="https://codexmedica.com/" target="_blank">Consulta (mgomez/123456)</a>
      <a class="dropdown-item" href="{{action('OrderController@index')}}">Órdenes</a>
      <a class="dropdown-item" href="{{action('ProductController@nonCategorizedProducts')}}">Productos Sin
        Clasificar</a>
      <a class="dropdown-item" href="{{action('AppoinmentController@index')}}">Citas</a>
      <a class="dropdown-item" href="{{route('search_history.index')}}">Historial de Búsquedas</a>
      <a class="dropdown-item" href="{{route('parametrization.index')}}">Parametrizacion</a>
      <a class="dropdown-item" href="{{route('bibliography.index')}}">Bibliografías</a>
      <!-- <div class="dropdown-divider"></div> -->
      </div>
    </li>
    <li class="nav-item">
      <form action="{{url('/logout')}}" id="form_logout" method="post">
      <a id="a_logout" href="#" class="nav-link">Cerrar Sesión</a>
      </form>
    </li>
  @endif
      </ul>
    </div>
  </nav>
  <!-- Modal -->
  <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
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
            <form method="POST" action="{{ route('login') }}" id="form_login">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          <button id="a_submit_login" class="btn btn-primary">Inicio!</button>
        </div>
      </div>
    </div>
  </div>
  @yield("content")
  @include('layouts.footer')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>