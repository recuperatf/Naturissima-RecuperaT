<div class="row">
    {{Form::hidden($name."[$count][name]",$S_label)}}
    {{Form::hidden($name."[$count][cie10_id]",isset($ID_cie10)?$ID_cie10:null)}}
    {{Form::hidden($name."[$count][section]",isset($name)?$name:null)}}
    @if(!empty($S_label))
    @php
    $show_label = !isset($show_label)?true:$show_label;
    @endphp
        @if($show_label)
            <div class="col-lg-12 {{!empty($class) ? $class : ''}}" style="text-align: center">
                <strong><h3>{{$S_label}}<h3/></strong>
            </div>
        @endif
    @endif

    @if(!empty($clarification))
        <div class="col-lg-12" style="">
            {!!$clarification!!}
        </div>
    @endif
    @if(!empty($img))
        <div class="col-lg-12" style="text-align: center;">
            <img src="{{$img}}">
        </div>
    @endif
    @if(!empty($options))
        @foreach($options as $option)
            <div class="col-md-{{intdiv(12, sizeof($options))}}" style="text-align: center; color:
            @php
            switch ($option['color']) {
                case 'y':
                $option['rgb_color'] = '#d9cc14';
                echo '#d9cc14';
                break;
                case 'g':
                $option['rgb_color'] = '#20a816';
                echo '#20a816';
                break;
                case 'r':
                $option['rgb_color'] = '#961222';
                echo '#961222';
                break;
                case 'p':
                $option['rgb_color'] = '#790aa8';
                echo '#790aa8';
                break;
                case 'b':
                $option['rgb_color'] = '#54b7de';
                echo '#54b7de';
                break;
                default:
                $option['rgb_color'] = '#000';
                echo '#000';
            }
            @endphp"
            >
            @php
                $arrayDefaultValues = false;
                if (!empty($valorations)) {
                    foreach($valorations as $id=>$valoration) {
                        if($valoration->section == $name && $valoration->name == $S_label){
                            $arrayDefaultValues = (array) $valoration->json_values;
                            break;
                        }
                    }
                }
            @endphp
            @if($arrayDefaultValues && isset($arrayDefaultValues['label']))
                {{Form::radio($name."[$count][json_values][label]",$option['pts']?$option['pts']:0,$arrayDefaultValues['label'] == $option['pts'],['class'=> (!empty($option['class']) ? $option['class'] : '') .' no_print', 'color' => $option['rgb_color'] , 'pts'=>!empty($option['pts'])?$option['pts']:0])}}<label for="{{$name."[$count][json_values][label]"}}">{{$option['label']}}</label>
            @else
                {{Form::radio($name."[$count][json_values][label]",$option['pts']?$option['pts']:0,null,['class'=> (!empty($option['class']) ? $option['class'] : '') .' no_print', 'color' => $option['rgb_color'] , 'pts'=>!empty($option['pts'])?$option['pts']:0])}}<label for="{{$name."[$count][json_values][label]"}}">{{$option['label']}}</label>
            @endif
            @if(!empty($option['explanation']))
                <p style="color:black">{{$option['explanation']}}</p>
            @endif
        </div>
        @endforeach
    @endif
    <div class="col-lg-12">
        <strong><label>Observaciones:</label></strong>
    </div>
    <div class="col-lg-12" style="text-align: center;">
        @if($arrayDefaultValues && !empty($arrayDefaultValues['observations']))
            {{Form::textarea($name."[$count][json_values][observations]",$arrayDefaultValues['observations'],['class'=>'form-control','rows'=>2])}}
        @else
            {{Form::textarea($name."[$count][json_values][observations]",'',['class'=>'form-control','rows'=>2])}}
        @endif
    </div>
</div>
