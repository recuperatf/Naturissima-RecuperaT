@extends('layouts.basic')
@section('content')
  {{Form::open(['method'=>'post', 'url'=>route('dspace_metadata.store'),'files' => true])}}
    @csrf
    <div class="container">
      <div class="row">
        <div class="col">
          <label>
            <h3>Archivo CSV Zotero (UTF-8)</h3>
          </label>
          <br>
          <input type="file" class="form-control" name="csv_file">
          <input type="text" class="form-control" placeholder="ID de la colección (XXXXX/XX)" name="collection_id">
        </div>
      </div>
      <br>
      <input type="submit" class="btn btn-primary" value="Obtener CSV para DSpace"/>
    </div>
  {{Form::close()}}
@endsection