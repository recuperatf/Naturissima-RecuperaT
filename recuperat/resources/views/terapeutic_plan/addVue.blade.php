@if (empty($client_view))
  @extends('layouts.basic')
@endif
@section('content')
    <style>
        table,
        table tr,
        table tr th {
            page-break-inside: avoid;
            break-inside: avoid
        }
        .col-lg-12,.col-md-12,.row,.container {
            display:block;
            float:none;
        }
    </style>
    <div id="app">
        <terapeutic-plan-component :user_id="{{Auth::user()->id }}" :is_admin="{{Auth::user()->rol->name == "admin" ? 1 : 0}}==1" :new_version_path="'{{!empty($O_model) ? route($newVersionRoute, $O_model->id) : null}}'" :terapeutic_plan_default="{{!empty($terapeuticPlanDefault) ? $terapeuticPlanDefault : 'null'}}"></terapeutic-plan-component>
    </div>
@endsection
