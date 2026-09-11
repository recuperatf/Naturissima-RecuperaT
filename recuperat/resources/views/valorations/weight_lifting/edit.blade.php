@if (empty($client_view))
  @extends('layouts.basic')
@endif
@section('content')
    <style>
    </style>
    <div id="app">
        <weight-lifting-component :workspace="{{$workspace ?? 'null'}}" :laboral_company="{{$laboral_company ?? 'null'}}" :evaluation="{{$evaluation ?? 'null'}}" :user="{{Auth::user()}}" :patient="{{$patient}}" :responsible="{{!empty($responsible) ? $responsible : 'null'}}" :ch_id={{$clinicalHistoryId}} ></weight-lifting-component>
    </div>
@endsection
