@if (empty($client_view))
  @extends('layouts.basic')
@endif
@section('content')
  <div class="container">
    <div class="row">
    <div class="col-lg-12">
      <!--Show the with('success')-->
      @if (!empty($success))
      <div class="alert alert-success">
      {{ $success }}
      </div>
    @endif
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
      <table class="table table-responsive">
      <th>Nombre</th>
      <th>Tipo</th>
      <th>Acciones</th>
      @foreach($resultsArray as $type => $resultRow)
      <tr>
        <td>
        <a target="_blank" href="globalSearch/{{$resultRow->id}}?type={{$resultRow->type}}">{{$resultRow->name}}</a>
        <span>
        @if($resultRow->creator)
        {{$resultRow->creator}} ({{$resultRow->date_issued}})
      @else
        -
      @endif
        </span>
        <p>
        @if($resultRow->description)
        {{$resultRow->description}}
      @else
        -
      @endif
        </p>
        </td>
        <td>{{$resultRow->parsedType}}</td>
        <td>{{Form::open(['route' => ['global_search.destroy', $resultRow->id], 'method' => 'DELETE'])}}
        @if(Auth::user()->id == 2)
      @csrf
      <button type="submit" class="btn btn-danger">Borrar</button>
      {{Form::close()}}
      @endif
        </td>
      </tr>
    @endforeach
      </table>
    </div>
    </div>
  </div>
@endsection