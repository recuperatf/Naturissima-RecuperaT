@foreach($informaciones as $vista)

<div class="modal" tabindex="-1" role="dialog" id="{{'modal_'.'_'.$vista['Vista']}}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$vista['Vista']}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<h3>Referencia</h3>
        <p>{{$vista['Referencia']}}</p>
    	<h3>Evaluación</h3>
	    <p>{{$vista['Evaluación']}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12">
	<h4 style="display: inline"><strong>{{$vista['Vista']}}</strong></h4> <i class="fa fa-sm fa-question" data-toggle="modal" data-target="#{{'modal_'.'_'.$vista['Vista']}}"></i>
</div>
	@foreach($segmentos as $segmento)
	<div class="col-lg-12">
		<strong>{{$segmento}}</strong>
	</div>
		@foreach($modifiers as $modifier)
        <div class="col-lg-12">
            @include('clinical_histories.valoration_row',[
                'name'=>'valoration_postural_'.str_replace(' ','_',$segmento).str_replace(' ','_',$modifier).str_replace(' ','_',$vista['Vista']),
                'S_label'=>$modifier,
                'S_order'=>(++$count),
                'default'=>($valorations)?
                $valorations->where('section', 'valoration_postural_'.str_replace(' ','_',$segmento).str_replace(' ','_',$modifier).str_replace(' ','_',$vista['Vista'])):
                []
                ])
        </div>
		@endforeach
	@endforeach
@endforeach

