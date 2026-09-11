{{-- @dd(Auth::user()->permissions->where('name', 'laboralPhysiotherapyTests.see')->count()) --}}
<!DOCTYPE html>
<html lang="en" style="overflow: auto">
<head>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-MSX7Z5V');</script>
  <!-- End Google Tag Manager -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{!empty($title) ? $title : "RecuperaT. Fisioterapia. Terapia física. Fisioterapia de Ortopedia. Fisioterapia post operatoria. Terapia fisica post operatoria"}}</title>
  <meta content={{!empty($description) ? $description : "Terapia física, fisioterapia de ortopedia, fisioterapia post operatoria, terapia física post operatoria"}} name="description">
  <meta property="og:title" content="{{!empty($tags['og']['title']) ? $tags['og']['title'] : 'RecuperaT. Fisioterapia. Terapia física.'}}">
  <meta property="og:type" content="">
  <meta property="og:description" content="{{!empty($tags['og']['description']) ? $tags['og']['description'] : 'Terapia física, fisioterapia de ortopedia, fisioterapia post operatoria, terapia física post operatoria'}}">
  <meta property="og:image" content="{{!empty($tags['og']['images']) ? $tags['og']['images'] : ''}}">
  <!-- Favicons -->
  <link href="/060cead63688ab551c45d867bc4cba2b.ico/favicon.ico" rel="icon">
  <link href="/medilab/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/medilab/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .btn-mod-primary{
      background-color: #1977cc !important;
      color: white !important;
    }
    .btn-mod-primary:hover{
      background-color: #1977cc !important;
      color: white;
    }
  </style>
  <link href="/medilab/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link
  rel="stylesheet"
  href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <!-- Template Main CSS File -->
  <link href="/medilab/assets/css/style.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: Medilab - v2.0.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  @stack('css')
  <style>
    .ui-autocomplete{
      background-color: white;
      border-color: black;
      border-width: 2px;
    }
    .ui-autocomplete > li{
      cursor: pointer;
    }
    .nav-menu a{
        color: white;
    }
  </style>
  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js" integrity="sha512-tVYBzEItJit9HXaWTPo8vveXlkK62LbA+wez9IgzjTmFNLMBO1BEYladBw2wnM3YURZSMUyhayPCoLtjGh84NQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/js/print.min.js"></script>
</head>

<body style="overflow: auto; min-height:100vh">
  {{-- @dd(Auth::user()->permissions) --}}
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MSX7Z5V"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!-- ======= Top Bar ======= -->
  @if(!Session::get('client_view'))
  <div id="topbar" class="d-none d-md-inline d-lg-flex align-items-center">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        {{-- <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a> --}}
        <i class="icofont-whatsapp"></i> (33) 2351-7843
        <i class="">Recuperat Valle Imperial</i>
        {{-- <i class="icofont-whatsapp"></i> (33) 2407-4211
        <i class="">Recuperat T Center</i> --}}
      </div>
      <div class="social-links">
        <a href="https://www.youtube.com/channel/UCeAc7ypqE35wJ-vQgO9M-tQ/" class="twitter"><i class="icofont-youtube"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100079561466852" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="https://www.instagram.com/explore/locations/2231465163776299/recupera-t-fisioterapia-rehabilitacion/" class="instagram"><i class="icofont-instagram"></i></a>
        {{-- <a href="#" class="skype"><i class="icofont-skype"></i></a> --}}
        {{-- <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a> --}}
      </div>
    </div>
  </div>
  <div id="topbar" class="d-inline d-md-none align-items-center">
    <div class="container">
      <div class="row contact-info ml-1">
        {{-- <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a> --}}
        <i class="">Recuperat Valle Imperial</i>
        <i class="icofont-whatsapp"></i> (33) 2351-7843
      </div>
      {{-- <div class="row contact-info ml-1">
        <i class="">Recuperat T Center</i>
        <i class="icofont-whatsapp"></i> (33) 2407-4211
      </div> --}}
      {{-- <div class="social-links">
        <a href="https://www.youtube.com/channel/UCeAc7ypqE35wJ-vQgO9M-tQ/" class="twitter"><i class="icofont-youtube"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100079561466852" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="https://www.instagram.com/explore/locations/2231465163776299/recupera-t-fisioterapia-rehabilitacion/" class="instagram"><i class="icofont-instagram"></i></a> --}}
        {{-- <a href="#" class="skype"><i class="icofont-skype"></i></a> --}}
        {{-- <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a> --}}
      {{-- </div> --}}
    </div>
  </div>
  @endif
  <!-- ======= Header ======= -->
  <header id="header" style="{{Session::get("client_view") ? "background-color: rgba(255, 255, 255, 0);" : ""}}">
    <div class="d-flex {{!Session::get('client_view') ? "container align-items-center flex-wrap": 'container-fluid'}}">
      <title>Terapia física, fisioterapia, post operatoria, ortopedia</title>
      {{-- <h1 class="logo mr-auto"><a href="index.html">RecuperaT</a></h1> --}}
      <!-- Uncomment below if you prefer to use an image logo -->
      @if(!Session::get('client_view'))
        <div class="col-lg-3"><a href="/" class="mr-auto"><img src="{{ ('/medilab/assets/img/' . 'logo.png') }}" style="heigth:250px !important; width:300px !important" alt="" class=""></a></div>
      @else
        <div class="col-lg-1"><a href="/" class="mr-auto"><img src="/images/fisioaleph.jpg" style="heigth:auto !important; width:8.2vw !important" alt="" class=""></a></div>
        <div class="col-lg-1 ml-5 text-center"><h3 style="color:white; font-size: 26px; font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif">Acción profesional con Compromiso Humano</h3></div>
      @endif
      @if(!Session::get('client_view'))
        <nav class="nav-menu d-none d-lg-block">
            <ul style = "width:100%; flex-direction: row; flex-wrap:wrap">
            <li> <a href="http://138.197.105.143:8080/xmlui/handle/123456789/3">Biblioteca digital</a></li>
            <li><a href="{{route('contacto.index')}}">Contacto</a></li>
            <li class="active"><a href="/">Conócenos</a></li>
            <li><a href="{{route('companies')}}">Fisioterapia Laboral</a></li>
            <li><a href="{{route('tienda.index')}}">Tienda en linea</a></li>
            <li><a href="{{action('OfferController@indexForClients')}}">Promociones</a></li>
            <li><a href="{{action('ServicesController@index')}}">Servicios</a></li>
            <li class="nav-item">
                <a href="/checkout" class="nav-link">
                <i class="fa fa-shopping-cart"></i><div style="display: inline;" id="div_cart_size">({{sizeof((
                    (session()->get("IDs_cart_products"))?session()->get("IDs_cart_products"):[]
                ))}})</div>
                </a>
            </li>
            @if(!Auth::user())
            <li>
                <a href="{{action('HomeController@index')}}" class="nav-link" data-toggle="modal" data-target="#loginmodal">Iniciar Sesión</a>
            </li>
            @endif
            </ul>
            <ul>
            <li>
            @if(Auth::user())
                @if(Auth::user()->admin)
                <li class="drop-down"><a href="">Administración</a>
                <ul>
                    <li><a href="{{route('users.index')}}">Perfil de Usuarios</a></li>
                    <li><a href="{{route('information.index')}}">Preguntas</a></li>
                    <li><a href="{{route('orders.index')}}">Órdenes</a></li>
                    <!-- <li><a href="#">Editar Página de Inicio</a></li> -->
                    <li><a href="{{route('ofertas.index')}}">Promociones</a></li>
                    <li><a href="{{action('ProductController@index', ['unclassified'=>true])}}">(Tienda) Productos sin categoría</a></li>
                    <li><a href="{{action('AppoinmentController@index')}}">Citas agendadas</a></li>
                    <li><a href="{{route('clinics.index')}}">Centros</a></li>
                    <li><a href="{{route('product_categories.index')}}">Categorias de Productos y Servicios</a></li>
                    <li><a href="{{route('dspace_metadata.create')}}">Carga de metadatos</a></li>
                </ul>
                </li>
                @endif
                <li class="drop-down"><a href="#">Fisioterapia</a>
                <ul>
                    <li class="nav-item nav-right">
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'medical_office.see')->count()
                    )
                        <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index')}}">Consulta</a>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'physiotherapy_protocols.see')->count()
                    )
                        <li> <a href="{{route('protocolos_fisioterapia.index')}}">Protocolos</a></li>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'diagnosis_plans.see')->count()
                    )
                    <li> <a href="{{route('diagnosis_plan.index')}}">Pruebas y medidas funcionales</a></li>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'terapeutic_plans.see')->count()
                    )
                    <li> <a href="{{route('terapeutic_plan.index')}}">Planes Terapéuticos</a></li>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'home_fisiotherapy_program.see')->count()
                    )
                    <li> <a href="{{route('home_physiotherapy_program.index')}}">Programas Fisioterapéuticos en Casa</a></li>
                    @endif
                    </li>
                </ul>
                </li>
                <li class="drop-down"><a href="#">Fisioterapia Laboral</a>
                <ul>
                    <li class="nav-item nav-right">
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'physiotherapy_protocols.see')->count()
                        )
                        <li> <a href="{{route('protocolos_fisioterapia.index')}}">Protocolos</a></li>
                    @endif
                    @if(
                    Auth::user()->rol->id == 1 ||
                    Auth::user()->permissions->where('name', 'laboralPhysiotherapyLMGProtocols.see')->count()
                    )
                        <a class="nav-link" style="cursor: pointer;" href="{{route('diagnosis_plan.index')}}">Pruebas y medidas funcionales</a>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'physiotherapy_protocols.see')->count()
                        )
                        <li> <a href="{{route('protocolos_fisioterapia_lmg.index')}}">Planes de tratamiento</a></li>
                        @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'home_fisiotherapy_program.see')->count()
                    )
                    <li> <a href="{{route('home_physiotherapy_program.index')}}">Programas fisioterapéuticos laborales</a></li>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'laboral_companies.see')->count()
                    )
                    <a class="nav-link" style="cursor: pointer;" href="{{route('laboral_company.index')}}">Empresas</a>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'laboral_companies.see')->count()
                    )
                    <a class="nav-link" style="cursor: pointer;" href="{{route('workspaces.index')}}">Puestos</a>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1
                        // Auth::user()->permissions->where('name', 'laboral_companies.see')->count()
                    )
                    <a class="nav-link" style="cursor: pointer;" href="{{route('employees.index', ['laboral' => 3])}}">Empleados</a>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'laboralPhysiotherapyNorse.see')->count()
                    )
                    <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index', ['laboral' => 5])}}">Evaluación Nórdico</a>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'laboralPhysiotherapyEvaluations.see')->count()
                    )
                    <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index', ['laboral' => 2])}}">Evaluaciones especificas</a>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'laboralPhysiotherapyLoads.see')->count()
                    )
                    <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index', ['laboral' => 11])}}">Manual de Cargas</a>
                    @endif
                    </li>
                </ul>
                </li>
                <li class="drop-down"><a href="#">Fuentes de consulta</a>
                <ul>
                    <li class="nav-item nav-right">
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'physiotherapyCie10.see')->count()
                    )
                    <li><a href="{{route('cie10.index')}}">Catálogo CIE10</a></li>
                    @endif
                    @if(
                        Auth::user()->rol->id == 1 ||
                        Auth::user()->permissions->where('name', 'physiotherapyCie9MC.see')->count()
                    )
                    <li><a href="{{route('cie9_mc.index')}}">Catálogo CIE9-CM</a></li>
                    @endif
                    </li>
                    <li><a href="">CIF-21</a></li>
                    <li><a href="{{route('keywords.index')}}">Glosario de fisioterapia</a></li>
                    <li><a href="{{route('anato_physiology_glosary_item.index')}}">Diccionario de anatomía y fisiología</a></li>
                </ul>
                </li>
                <li> <a href="https://moodle.fisioaleph.com/">Cursos</a></li>
                <li class="nav-item nav-right">
                <form action="{{url('/logout')}}" id="form_logout" method="post">
                    @csrf
                </form>
                    <a id="a_logout" class="nav-link" href="#" style="cursor: pointer;">Cerrar Sesión</a>
                    <a id="a_logout" class="nav-link" href="#" style="cursor: pointer;">({{Auth::user()->name}})</a>
                </li>
            @endif
            </li>
            </ul>
        </nav><!-- .nav-menu -->
      @else
        <div style="height: 200px; background-color: white;" class="mb-10">
            <svg style="display: inline-block;  position: absolute;  top: 0;  left: 0; z-index:-1" viewBox="0 0 500 500" preserveAspectRatio="xMinYMin meet">
                <path d="M 0 50 C 158 48 292 93 501 55 L 500 0 L 0 0 Z" style="stroke: none; fill:#208D6E9C;"></path>
            </svg>
        </div>
        <div class="col-lg-12 ml-4">
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li><a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index')}}">Consulta</a></li>

                    <li> <a href="{{route('diagnosis_plan.index')}}">Pruebas y medidas funcionales</a></li>

                    <li> <a href="{{route('terapeutic_plan.index')}}">Planes Terapéuticos</a></li>

                    <li> <a href="{{route('home_physiotherapy_program.index')}}">Programas Fisioterapéuticos en Casa</a></li>

                    <li class="nav-item nav-right">
                    <form action="{{url('/logout')}}" id="form_logout" method="post">
                        @csrf
                    </form>
                        <a id="a_logout" class="nav-link" href="#" style="cursor: pointer;">Cerrar Sesión</a>
                        <a id="a_logout" class="nav-link" href="#" style="cursor: pointer;">({{Auth::user()->name}})</a>
                    </li>
                </ul>
            </nav>
        </div>
      @endif
      @if(!Session::get('client_view'))
      <a href="{{route('appoinments.create')}}" class="appointment-btn scrollto d-block">Agenda ya</a>
      @if(Auth::user())
        <div class="row">
          <div class="col-lg-12 ml-4">
            {{Form::open(['url'=>action('GlobalSearchController@index'),'method'=>'GET'])}}
            <div class="input-group">
              {{Form::text('keywords',null,['placeholder'=>'Búsqueda libre','class'=>'form-control','style'=>'display:inline; width:80%;'])}}
              {{Form::text('search_title',null,['placeholder'=>'Título','class'=>'form-control','style'=>'display:inline; width:80%;'])}}
              {{Form::text('search_author',null,['placeholder'=>'Autor','class'=>'form-control','style'=>'display:inline; width:80%;'])}}
              {{Form::text('search_subject',null,['placeholder'=>'Materia','class'=>'form-control','style'=>'display:inline; width:80%;'])}}
              <div class="input-group-append">
                <button type="submit" class="btn btn-mod-primary" style="display: inline;">Búsqueda documental <span><i class="fas fa-search"></i></span></input>
                </div>
              </div>
              {{Form::close()}}
          </div>
        </div>
      @endif
      @endif
    </div>
  </header><!-- End Header -->
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
    @yield('content', '')
  <!-- ======= Footer ======= -->
  @if(!Auth::user())
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        @if(empty($no_data_footer))
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Centro Valle Imperial</h3>
            <p>
              Blvd. Valle imperial # 260 -18, cruza con Avenida Antiguo Camino a Copalita y Calle Las Torres, planta alta, Colonia La Periquera, C.P 45134, Zapopan Jalisco <br>
              <strong>Teléfono Fijo:</strong> (33) 9688-6699<br>
              <strong>Teléfono (Whatsapp):</strong> (33) 2351-7843<br>
            </p>
          </div>
          <div class="col-lg-3 col-md-6 footer-contact">

          </div>
          <div class="col-lg-3 col-md-6 footer-contact">
          </div>
          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Plaza Paseo Sendas</h3>
            <p>
              Avenida Guadalajara 3523. Local 8, Fraccionamiento Sendas Residencial, CP.45134, Zapopan Jalisco.
              <strong>Teléfono (Whatsapp):</strong> +52 (33) 2407-4211<br>
            </p>
          </div>

        </div>
        @endif
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>RecuperaT</span></strong>. Todos los derechos reservador
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
          Implementada por Dr. Luis Ruelas
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://www.youtube.com/channel/UCeAc7ypqE35wJ-vQgO9M-tQ/" class="twitter"><i class="bx bxl-youtube"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100079561466852" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/recuperatfisioterapia" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->
  @endif
  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->

  <script src="/medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/medilab/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/medilab/assets/vendor/php-email-form/validate.js"></script>
  <script src="/medilab/assets/vendor/venobox/venobox.min.js"></script>
  <script src="/medilab/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="/medilab/assets/vendor/counterup/counterup.min.js"></script>
  <script src="/medilab/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/medilab/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <!-- Template Main JS File -->
  @if(!empty($useVue))
    <script src="/js/app{{env('APP_VERSION', '')}}.js"></script>
  @endif
  <script src="/medilab/assets/js/main.js"></script>
  <script src="https://use.fontawesome.com/62e662feb2.js"></script>
  @stack('javascript')
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
    $(window).unbind('keydown');
    // $(window).keydown(function(event){
    //   if((event.which== 13) && ($(event.target)[0]!=$("textarea")[0])) {
    //     event.preventDefault();
    //     return false;
    //   }
    // });
		$("textarea").each((key, tag) => {
				$(tag).on("keypress",function(e) {
        console.log($(tag).attr('id'));
					var key = e.keyCode;
					// If the user has pressed enter
					if (key == 13) {
							$(tag).val($(tag).val() + "\n");
							return false;
					}
					else {
							return true;
					}
				})
			}
		)
  </script>
  @yield("partial_js")
  <style>
    @media print{
      .back-to-top .icofont-simple-up header .form-control button .btn{
        display: none !important;
      }
      div {
        color: 'red';
      }
    }
  </style>
</body>

</html>
