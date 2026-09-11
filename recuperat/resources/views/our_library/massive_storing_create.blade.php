@extends('layouts.basic')
@section('content')
<div class="container">
    {{Form::open(['route' => 'our_library.massive_storing.store', 'method' => 'POST', 'files' => true])}}
        <div class="row">
            <div class="col-lg-12">
                <h2>Carga masiva de metadatos (RecuperaT)</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label for="file">Archivo .csv exportado de zotero (unicode without BOM)</label>
                <input type="file" class="form-control" name="csv_file" id="file" accept=".csv">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12">
                <input type="submit" class="btn btn-primary" value="Cargar metadata"></div>
            </div>
        </div>
    {{Form::close()}}
</div>
@endsection