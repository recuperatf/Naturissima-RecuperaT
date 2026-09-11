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

  <title>{{!empty($title) ? $title : "RecuperaT. Fisioterapia. Terapia física. Nutrición. Ortopedia."}}</title>
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
  <!-- ======= Header ======= -->
  @if(Auth::user())
  <header id="header" class="">
    <div class="container flex-wrap d-flex align-items-center">
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li>
            <li class=""> <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index')}}">Consulta</a></li>
            <li class=""><a href="{{route('protocolos_fisioterapia.index')}}">Protocolos</a></li>
            <li class=""><a href="{{route('diagnosis_plan.index')}}">Pruebas y medidas funcionales</a></li>
            <li class=""><a href="{{route('terapeutic_plan.index')}}">Planes Terapéuticos</a></li>
            <li class=""><a href="{{route('home_physiotherapy_program.index')}}">Programas Fisioterapéuticos en Casa</a></li>
            </li>
            {{-- <li class="drop-down"><a href="#">Fisioterapia Laboral</a>
              <ul>
                <li class="nav-item nav-right">
                  @if(
                    Auth::user()->rol->id == 1 ||
                    Auth::user()->permissions->where('name', 'laboralPhysiotherapyJobAnalysis.see')->count()
                  )
                  <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index', ['laboral' => 1])}}">Análisis de puesto</a>
                  @endif
                  @if(
                    Auth::user()->rol->id == 1 ||
                    Auth::user()->permissions->where('name', 'laboralPhysiotherapyNorse.see')->count()
                  )
                  <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index', ['laboral' => 5])}}">Nórdico</a>
                  @endif
                  @if(
                    Auth::user()->rol->id == 1 ||
                    Auth::user()->permissions->where('name', 'laboralPhysiotherapyLoads.see')->count()
                  )
                  <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index', ['laboral' => 11])}}">Manual de Cargas</a>
                  @endif
                  @if(
                    Auth::user()->rol->id == 1 ||
                    Auth::user()->permissions->where('name', 'laboralPhysiotherapyEvaluations.see')->count()
                  )
                  <a class="nav-link" style="cursor: pointer;" href="{{route('pacientes.index', ['laboral' => 2])}}">Evaluaciones</a>
                  @endif
                  @if(
                    Auth::user()->rol->id == 1 ||
                    Auth::user()->permissions->where('name', 'laboralPhysiotherapyTests.see')->count()
                  )
                    <a class="nav-link" style="cursor: pointer;" href="#">Pruebas</a>
                  @endif
                  @if(
                    Auth::user()->rol->id == 1 ||
                    Auth::user()->permissions->where('name', 'laboralPhysiotherapyLMGProtocols.see')->count()
                  )
                  <a class="nav-link" style="cursor: pointer;" href="{{route('protocolos_fisioterapia_lmg.index')}}">Protocolos LMG</a>
                  @endif
                </li>
              </ul>
            </li> --}}
            <li> <a href="{{route('keywords.index')}}">Glosario de fisioterapia</a></li>
            <li> <a href="{{route('anato_physiology_glosary_item.index')}}">Diccionario de anatomía y fisiología</a></li>
            <li class="nav-item nav-right">
              <form action="{{url('/logout')}}" id="form_logout" method="post">
                @csrf
              </form>
                <a id="a_logout" class="nav-link" href="#" style="cursor: pointer;">Cerrar Sesión</a>
                <a id="a_logout" class="nav-link" href="#" style="cursor: pointer;">({{Auth::user()->name}})</a>
            </li>
          </li>
        </ul>
      </nav><!-- .nav-menu -->
      @if(Auth::user())
        <div class="row">
            <div class="col-lg-12 ml-4">
            </div>
        </div>
        @endif
      </div>
    </header><!-- End Header -->
  @else
    <header>
      <title>Terapia física, fisioterapia, post operatoria, ortopedia</title>
    </header>
  @endif
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
        <div class="row">
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>FisioAleph Sistema Automatizado de Fisioterapia</span></strong>. Todos los derechos reservador
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
          Implementada por Dr. Luis Ruelas
        </div>
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
    <script src="/js/app.js"></script>
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
