@extends('layouts.basic')
@section('content')
  <div class="container note_container">
    @include('reports.row_print_report', ['hideImage' => true])
  {{-- @dd($format) --}}
    @foreach($format as $question => $answers)
      <h4>{{$question}}</h4>
      @foreach ($answers as $answer => $value)
          @if(!is_array($value))
            <h5 style="display: inline">{{$answer}}:</h5> {{$value}} <br>
          @else
            @foreach ($value as $subanswers => $subanswerValue)
              <h5 style="display: inline">{{$subanswers}}:</h5> {{$subanswerValue}} <br>
            @endforeach
          @endif
      @endforeach
    @endforeach
  </div>
@endsection