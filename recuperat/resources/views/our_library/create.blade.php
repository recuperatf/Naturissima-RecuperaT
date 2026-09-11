@if (empty($client_view))
  @extends('layouts.basic')
@endif
@section('content')
  {{Form::open(['method'=>'post', 'url'=>route('our_library.store'),'files' => true])}}
    @csrf
    <div class="container">
      <div class="row">
        <div class="col">
          <label>
            <h3>Subir archivo de biblioteca</h3>
          </label>
          <br>
          <input type="text" class="form-control" placeholder="Título" name="name"> <br>
          <select name="collection_type_id" class="form-control" id="">
            <option value="1">Protocolo</option>
            <option value="2">Programa terapéutico en casa</option>
            <option value="3">Plan terapéutico</option>
            <option value="4">Pruebas y medidas funcionales</option>

            <option value="5">Audiovisuales</option>
            <option value="6">Cassete</option>
            <option value="7">Copia de video</option>
            <option value="8">Diapositivas</option>
            <option value="9">Disco compacto</option>
            <option value="10">Disco video digital</option>
            <option value="11">Folleto</option>
            <option value="12">Guía</option>
            <option value="13">Láminas</option>
            <option value="14">Libro</option>
            <option value="15">Manual</option>
            <option value="16">Material cartográfico</option>
            <option value="17">Objetos</option>
            <option value="18">Publicaciones periódicas</option>
            <option value="19">Recurso digital</option>
            <option value="20">Tarjeta nmemotécnica</option>
            <option value="21">Tesis</option>
            <option value="22">Revista académica</option>
            <option value="23">Revista de divulgación</option>
            <option value="24">Obras de arte</option>
            <option value="25">Figuras (imágenes, gráficas)</option>
            <option value="26">Blog</option>
            <option value="27">Tweet</option>
            <option value="28">Facebook</option>
            <option value="29">Presentaciones</option>
            <option value="30">Base de datos</option>
            <option value="31">Aplicaciones</option>
            <option value="32">Audio</option>
            <option value="33">Video</option>
          </select> <br>
          <input type="text" class="form-control" placeholder="Descripción" name="description"> <br>
          <input type="text" class="form-control" placeholder="Creador" name="creator"> <br>
          <input type="text" class="form-control" placeholder="Fecha de emisión" name="date_issued"> <br>
          <input type="text" class="form-control" placeholder="Última versión" name="latest_version"> <br>
          <input type="text" class="form-control" placeholder="Historial de versiones" name="version_history"> <br>
          <input type="text" class="form-control" placeholder="Estatus del documento" name="document_status"> <br>
          <input type="text" class="form-control" placeholder="DOI" name="doi"> <br>
          <input type="file" class="form-control" placeholder="Subir" name="nombre"> <br>
        </div>
      </div>
      <br>
      <input type="submit" class="btn btn-primary" value="Subir documento"/>
    </div>
  {{Form::close()}}
@endsection
