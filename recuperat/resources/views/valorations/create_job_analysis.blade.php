@php
$count=-1;
@endphp
@extends("layouts.basic")
@section("content")
<div id="app">
    <job-analysis-component 
    :patients="{{!empty($patients) ? json_encode($patients) : null }}"
    :workspace="{{!empty($workspace) ? json_encode($workspace) : null }}" :id={{!empty($O_model) ? $O_model->id : 'false'}}></job-analysis-component>
</div>
</div>
@endsection