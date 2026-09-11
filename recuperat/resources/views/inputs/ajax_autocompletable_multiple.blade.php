<script type="text/javascript">
	$(function(){
		@if(!empty($defult_values))
			@foreach($defult_values as $key => $variable)
				{{!empty($value['onAdd']) ? $value['onAdd'] : 'console.log'}}({{$variable['id']}}, '{{$variable->name}}');
			@endforeach
		@endif

		$(".span_remove_{{$value['name']}}").click(function(){
			$(this).remove();
			$($(this).attr('hidden-target')).remove();
			console.log('clicked');
			{{!empty($value['onRemove']) ? $value['onRemove'] : 'console.log'}}($(this).attr("id_model"));
			recountInViewReturnLast{{$value['name']}}();
		});
		function recountInViewReturnLast{{$value['name']}}(){
			$.each($("#div_hidden_{{$value['name']}} input"),function(key,val){
				val = $(val);
				val.attr("name","{{$value['name']}}["+key+"]");
				val.attr("id","{{$value['name']}}_"+key);
			});
			$.each($("#div_btns_close_{{$value['name']}} button"),function(key,val){
				val = $(val);
				val.attr("hidden-target","#{{$value['name']}}_"+key);
			});
			return $("#div_hidden_{{$value['name']}} input").last();
		}

		$(".{{$value['class']}}").on('input',function(event){
			console.log($("#div_hidden_{{$value['name']}}").children().length, "#div_hidden_{{$value['name']}}")
			if ($("#div_hidden_{{$value['name']}}").children().length > 0 && {{!empty($single) ? 'true' : 'false'}}) {
				return
			}
			$(this).autocomplete({
				source: function( request, response ) {
			        $.ajax({
			          url: "/{{$value['url']}}/"+$(event.target).val(),
			          method:'get',
			          success: function( data ) {
			           		response(data);
			          	}
			        });
			      },
				minLength: 2,
				delay: 0,
				max:40,
	            scroll:true,
				select:function(event, item){
					event.preventDefault();
					$(this).val(item.item.label);
					let hidden_value = jQuery('<input>',{type:'hidden'});
					hidden_value.val(item.item.id);
					hidden_value.attr('print-value', item.item.label);
					button_to_close = jQuery('<button>',{
						type:'button',
						id_model: item.item.id,
						style: "background-color:red; border-radius:5px; color: white; border-style: solid; border-color: red; margin-right:3px; margin-top: 6px"
					});
					span_close = jQuery('<span>',{
						'aria-hidden':true,
						'font-weight':'bold'
					});
					span_close.html(' &times');
					button_to_close.append(item.item.label);
					button_to_close.append(span_close);
					button_to_close.click(function(){
						$(this).remove();
						$($(this).attr('hidden-target')).remove();
						removeCie10($(this).attr('id_model'));
						recountInViewReturnLast{{$value['name']}}();
					});
					$("#div_btns_close_{{$value['name']}}").append(button_to_close);

					$("#div_hidden_{{$value['name']}}").append(hidden_value);
					last_element = recountInViewReturnLast{{$value['name']}}();
					button_to_close.attr("hidden-target","#"+last_element.attr('id'));
					$("#{{$value['class']}}").val('');

					{{!empty($value['onAdd']) ? $value['onAdd'] : 'console.log'}}(item.item.id, item.item.label);

			    }
			}).focus(function () {
			    $(this).autocomplete("search");
			});
		});
	});

	function addCie10(id, cie10_label = ''){
		let frame = $('<iframe></iframe>', {
			id: 'iframe_'+id,
			src: '/api/cie10form/'+id + '?q='+Date.now(),
		});
		let div_label = $('<div></div>', {
			label_for: 'iframe_'+id,
			html:$('<h4></h4>',{no_count:0}).html(cie10_label)
		});
		$('#cie10_frames').append(div_label);
		$('#cie10_frames').append(frame);
		changeH4Names();
	}
	function removeCie10(id){
		console.log('id', id);
		iframe_id = 'iframe_'+id;
		$('[label_for="'+iframe_id+'"').remove();
		$('#'+iframe_id).remove();
	}
</script>
<style type="text/css">
	iframe{
		width:100%;
		height:40vh;
	}
</style>
<div class="col-lg-12">
	{{Form::label($value['key'],$value['label'], ['class'=>(isset($value['print']) && $value['print'] == false) ? 'no_print': ''])}}
	<input type="input" hidden-target={{'#hidden_'.$value['name']}} id="{{$value['class']}}" class="form-control {{$value['class']}}" id={{$value['class']}}>
	@if(!empty($addRoute))
		<a target="_blank" href="{{route($addRoute)}}" class="small btn btn-primary"><span class="fas fa-plus"></span></a>
	@endif
	<div id="div_btns_close_{{$value['name']}}">
		@if(!empty($defult_values))
			@foreach($defult_values as $key=>$variable)
				<button type='button' class="span_remove_{{$value['name']}}" id_model="{{$variable['id']}}" hidden-target ="#{{$value['name']."_".$key}}"
						style= "background-color:red; border-radius:5px; color: white; border-style: solid; border-color: red; margin-right:3px; margin-top: 6px">
						{{$variable->name}}
					<span aria-hidden='true'
						font-weight = 'bold'> &times</span>
				</button>
			@endforeach
		@endif
	</div>
	<div>
		@if(false)
		@php
			//if($value['key'] == 'treatments')
		@endphp
			@foreach($defult_values as $key=>$variable)
				@if($variable->extras)
					@php $extras = (array) json_decode($variable->extras) @endphp
					@if(!empty($extras['fases']))
						@foreach ($extras['fases'] as $phase)
							<h5>{{$phase->name}}</h5>
							<h6>Objetivos</h6>
							<p>{{$phase->goals}}</p>
							<h6>Progresión</h6>
							<h6>{{$phase->progression}}</h6>
							<h6>Modalidades</h6>
							<h6>{{$phase->modalities}}</h6>
							<h6>Actividades</h6>
							<h6>{{$phase->activities}}</h6>
							<hr>
						@endforeach
					@endif
				@endif
			@endforeach
		@endif
	</div>
	<div id="div_hidden_{{$value['name']}}">
		@if(!empty($defult_values))
			@foreach($defult_values as $key => $variable)
				<input type="hidden" href="{{!empty($viewRoute) ? route($viewRoute, $variable->id): ''}}" class="{{!empty($viewRoute) ? 'hidden_href': ''}} {{((isset($value['print']) && $value['print'] == false) || $value['key'] == 'treatments') ? '': ''}}" print-value="{{$variable['name']}}" value="{{$variable['id']}}" name="{{$value['name']."[".$key."]"}}" id="{{$value['name']."_".$key}}">
			@endforeach
		@endif
	</div>
</div>