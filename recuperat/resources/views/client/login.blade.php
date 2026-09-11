@extends('layouts.basic_client')
@section('content')
  <style>
    html, body, .container-table {
        height: 100%;
    }
    .container-table {
        display: table;
    }
    .vertical-center-row {
        display: table-cell;
        vertical-align: middle;
    }
    .subtitle {
      font-size: 2rem;
      color: #208D6E9C;
      font-weight: 600;
    }
    .mt-10 {
      margin-top: 50px;
    }
  </style>
  <form action="{{'/login'}}" id="form_login" method="post">
    <div class="container container-table">
      <div class="row vertical-center-row">
        <div class="col-lg-12 text-center mt-10">
          <img src="/images/fisioaleph.jpg" alt="" width="200px" height="auto">
        </div>
        <div class="col-lg-12 text-center">
          <p class="subtitle">Fisioterapia profesional al alcance de todos</p>
        </div>
        <div class="offset-lg-3 col-lg-6 text-center">
          <div class="row">
            <div class="col-12">
              <input type="text" name="email" class="form-control" placeholder="Usuario / email">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-12">
              <input type="password" name="password" class="form-control" placeholder="Contraseña">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-12 text-center">
              <input type="submit" class="btn btn-primary" value="Iniciar sesión">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
