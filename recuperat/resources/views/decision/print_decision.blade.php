@if (empty($client_view))
  @extends('layouts.basic')
@endif
@push('css')
    <style>
        .print_only {
            display: none
        }
        pre {
            font-family: "Open Sans", sans-serif;
            white-space: normal;
        }
        @media print {
            pre {
                white-space: normal;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="modal-body note_container">
                      @include('reports.row_print_report', ['img'=>!empty($img) ? $img : false, 'hide_header' => false, 'hideImage' => true])
                        <label for="decision_text" class="no_print" style="white-space: pre-wrap;"><strong>Contenido:</strong></label>
                        <pre class="decision_text d-block d-print-none text-left" style="border-radius: 10px;border: 2px solid #bedbcc;padding:20px;white-space: normal;">
                            {{$decision->text}}
                        </pre>
                        <pre class="decision_text d-none d-print-block text-left" style="height: 900px; border-radius: 10px;border: 2px solid #bedbcc; font-size: 16pt;padding:20px;">
                            {{$decision->text}}
                        </pre>
                        <label for="hpp"><strong>Programa fisioterapéutico en casa:</strong></label>
                        <ul>
                            @foreach($decision->home_physiotherapy_programs as $program)
                                <li><a href="https://recuperatfisioterapia.com/decision/{{$program->id}}">{{$program->name}}</a></li>
                            @endforeach
                        </ul>
                        <div id="hpp"></div>
                        <div class="w-100 text-right">
                            <label for="sign_text" class="d-none"><strong>__________________________________</strong></label>
                            <p id="sign_text" class="print_only"></p>
                        </div>
                        <br>
                        <div class="w-100 text-left d-none d-print-block">
                            <ul>
                                <li><strong>Recuperat Valle Imperial:</strong> Blvd. Valle imperial # 260 -18, cruza con Avenida Antiguo Camino a Copalita y Calle Las Torres, planta alta, Colonia La Periquera, C.P 45134, Zapopan Jalisco. Tel. (33) 2351-7843</li>
                                <li><strong>Recuperat Paseo Sendas:</strong> Avenida Guadalajara 3523. Local 8, Fraccionamiento Sendas Residencial, CP.45134, Zapopan Jalisco. Tel. (33) 3803-4475</li>
                                {{-- <li><strong>Recuperat T Center:</strong> Juan Gil Preciado #8905, Local 4, Tesistán. CP: 45200, Plaza T-Center. Tel. (33) 2407-4211</li> --}}
                            </ul>
                        </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
