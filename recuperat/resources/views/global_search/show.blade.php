@extends('layouts.basic')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-3">
                <h1>{{$document->name}}</h1>
                <p>{{$document->creator ?? "-"}}</p>
                <span><strong>Fecha</strong> {{$document->parsed_updated_at}}</span>
            </div>
            <div class="col-lg-12 mt-3">
                <h4>Resumen</h4>
                <hr>
                {{$document->description}}
            </div>
            <div class="col-lg-12 mt-3">
                <h4>Descargable</h4>
                <hr>
                @if(!empty($fullUrl))
                    <a href="{{$fullUrl}}?from_global_search=1" target="_blank">Descarga ahora</a>
                @else
                    @if($document->url)
                        <a href="{{$document->url}}?from_global_search=1" target="_blank">Descarga ahora</a>
                    @else
                        <p>No disponible</p>
                    @endif
                @endif
            </div>
        </div>
        <div class="row mb-10">
        </div>
    </div>
@endsection