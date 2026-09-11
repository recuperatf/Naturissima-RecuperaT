@php
$count=-1;
@endphp
@extends("layouts.basic")
@section("content")
<script type="text/javascript" src="/js/valorations/create.js">
</script>
<div id="app">
    <home-physiotherapy-program-component :user_id="{{Auth::user()->id }}" :is_admin="{{Auth::user()->rol->name == "admin" ? 1 : 0}}==1" :new_version_path="'{{!empty($O_model) ? route($newVersionRoute, $O_model->id) : null}}'" :id={{!empty($O_model) ? $O_model->id : 'false'}}></home-physiotherapy-program-component>
</div>
</div>
@endsection
