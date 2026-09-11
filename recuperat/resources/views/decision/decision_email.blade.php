<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <h3>Tu receta de RecuperaT</h3>
        </div>
    </div>
    <div class="row">
        <br>Paciente:<br /> {{$decision->patient->full_name}}
        <br>Fecha de emisión:<br /> {{$decision->created_at}}
        <pre>{{$decision->text}}</pre>
        <br>
        <span><a href="https://recuperatfisioterapia.com/print-decision/{{$decision->id}}?from_global_search=1">Imprimir
                receta</a></span>
        @if(!empty($hppDecisions))
            @foreach($hppDecisions as $hppDecision)
                <span><a
                        href="https://recuperatfisioterapia.com/decision/{{$hppDecision->password}}?from_global_search=1">{{$hppDecision->home_physiotherapy_program->name}}</a></span>
            @endforeach
        @endif
    </div>
</div>