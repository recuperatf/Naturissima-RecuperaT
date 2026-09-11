<label>{{$value['label']}}</label>
<input type="hidden" value="{{$value['label']}}" name = '{{$value['key'] . '['.$value['count'].'][name]' }}'>
<select class="form-control" name = '{{$value['key'] . '['.$value['count'].'][json_values]' }}'>
	@foreach($options as $key => $option)
		<option
            @if(!empty($valorations) && $valorations->where('name', $value['label'])->first() && $valorations->where('name', $value['label'])->first()->json_values == $key)
                selected="selected"
            @endif
            value='{{$key}}'>{{$option}}</option>
	@endforeach
</select>
