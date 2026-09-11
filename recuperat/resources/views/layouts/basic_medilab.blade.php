<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RecuperaT</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="/060cead63688ab551c45d867bc4cba2b.ico/favicon.ico" rel="icon">
  <link href="/medilab/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/medilab/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/medilab/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/medilab/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab - v2.0.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        {{-- <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a> --}}
        <i class="icofont-phone"></i> +52 (33) 2351-7843
        <i class="icofont-google-map"></i> Blvd. Valle imperial #260, Zapopan
      </div>
      <div class="social-links">
        <a href="https://www.youtube.com/channel/UCeAc7ypqE35wJ-vQgO9M-tQ/" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100079561466852" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="https://www.instagram.com/explore/locations/2231465163776299/recupera-t-fisioterapia-rehabilitacion/" class="instagram"><i class="icofont-instagram"></i></a>
        {{-- <a href="#" class="skype"><i class="icofont-skype"></i></a> --}}
        {{-- <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a> --}}
      </div>
    </div>
  </div>
  @yield('content', '')
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      {{-- <h1 class="logo mr-auto"><a href="index.html">RecuperaT</a></h1> --}}
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.html" class="mr-auto"><img src="{{ ('/medilab/assets/img/' . 'logo.png') }}" style="heigth:250px !important; width:300px !important" alt="" class=""></a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.html">Conócenos</a></li>
          <li><a href="#about">Servicios</a></li>
          <li><a href="#services">Productos</a></li>
          <li><a href="#departments">Promociones</a></li>
          <li><a href="#doctors">Contacto</a></li>
          <li class="drop-down"><a href="">Administration</a>
            <ul>
              <li><a href="#">Usuarios</a></li>
              <li><a href="#">Preguntas</a></li>
              <li><a href="#">Órdenes</a></li>
              <!-- <li><a href="#">Editar Página de Inicio</a></li> -->
              <li><a href="#">Ofertas</a></li>
              <li><a href="#">Productos sin clasificar</a></li>
              <li><a href="#">Citas</a></li>
              <li><a href="#">Centros</a></li>
            </ul>
          </li>
          <li><a href="#contact">Catálogos Salud</a></li>
          <li><a href="#contact">Consulta</a></li>
          <li><a href="#contact">Cerrar Sesión</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="#appointment" class="appointment-btn scrollto">Agenda tu cita</a>

    </div>
  </header><!-- End Header -->

  
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Centro Valle Imperial</h3>
            <p>
              Blvd. Valle imperial # 260 -18, cruza con Avenida Antiguo Camino a Copalita y Calle Las Torres, planta alta, Colonia La Periquera, C.P 45134, Zapopan Jalisco <br>
              <strong>Teléfono (Whatsapp):</strong> +52 (33) 2351-7843<br>
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
              <strong>Teléfono (Local):</strong> +52 (33) 3803-4475<br>
              <strong>Teléfono (Whatsapp):</strong> +52 (33) 2407-4211<br>
            </p>
          </div>

        </div>
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
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="/medilab/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/medilab/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/medilab/assets/vendor/php-email-form/validate.js"></script>
  <script src="/medilab/assets/vendor/venobox/venobox.min.js"></script>
  <script src="/medilab/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="/medilab/assets/vendor/counterup/counterup.min.js"></script>
  <script src="/medilab/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/medilab/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/medilab/assets/js/main.js"></script>

</body>

</html>