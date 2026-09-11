@if(!empty($patient))
    @if (!empty($laboralHeader))
        <div class="col">
            <div class="row">
                <div class="col-6" style="text-align: left">
                    <strong>Nombre: </strong>{{$patient->full_name}}
                </div>
                <div class="col-6" style="text-align: left">
                    <strong>Fecha de emisión: </strong>{{date('Y-m-d')}}
                </div>
                @if(!empty($clinicalHistory))
                    <div class="col-6" style="text-align: left">
                        <strong>Fecha de elaboración: </strong>{{$clinicalHistory->created_at}}
                    </div>
                @endif
                <div class="col-lg-6" style="text-align: left">
                    <strong>Evaluador: </strong>{{Auth::user()->name}}
                </div>
                <div class="col-lg-6" style="text-align: left">
                    <strong>Puesto:</strong>
                </div>
                <div class="col-lg-6" style="text-align: left">
                    <strong>Empresa:</strong>
                </div>
            </div>
        </div>
    @else
        <div class="col">
            <div class="row">
                <div class="col-6" style="text-align: left">
                    <strong>Nombre: </strong>{{$patient->full_name}}
                </div>
                <div class="col-6" style="text-align: left" id="header-emission-date-div">
                    <strong>Fecha de emisión: </strong>{{date('Y-m-d')}}
                </div>
                @if(!empty($clinicalHistory))
                    <div class="col-6" style="text-align: left">
                        <strong>Fecha de elaboración: </strong>{{$clinicalHistory->created_at}}
                    </div>
                @endif
                @if(empty($clinicalHistory))
                    <div class="col-6" id="header-elaboration-date-div" style="display: none; text-align: left;">
                        <strong>Fecha de elaboración: </strong><span id="header-elaboration-date-span"></span>
                    </div>
                @endif
                <div class="col-6" id="header-author-div" style="display: none; text-align: left;">
                    <strong>Autor: </strong><span id="header-author-span"></span>
                </div>
                <div class="col-lg-6" style="text-align: left">
                    @if(!empty($author))
                        <strong>Tratante: </strong><span>{{$author->name}}</span>
                    @else
                        <strong>Tratante:
                        </strong><span>{{!empty($patient->responsible) ? $patient->responsible->name : 'N/A'}}</span>
                    @endif
                </div>
                <div class="col-lg-6" style="text-align: left">
                    @if(!empty($author))
                        <strong>Cédula profesional: </strong><span>{{$author->license}}</span>
                    @else
                        <strong>Cédula profesional:
                        </strong><span>{{!empty($patient->responsible) ? $patient->responsible->license : 'N/A'}}</span>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <br>
@endif
