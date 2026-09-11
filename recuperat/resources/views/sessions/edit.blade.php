@if (empty($client_view))
  @extends('layouts.basic')
@endif
@section('content')
    <style>
    </style>
    <div id="app">
        <session-component :is_admin={{Auth::user()->rol->id == 1 ? 'true': 'false'}} :patient="{{$patient}}" :responsible="{{!empty($responsible) ? $responsible : 'null'}}" :ch_id={{$clinicalHistoryId}} ></session-component>
    </div>
@endsection
