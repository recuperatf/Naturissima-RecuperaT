<script type="text/javascript">
	$(function(){
		$(".span_remove_{{$value['name']}}").click(function(){
			$(this).remove();
			$($(this).attr('hidden-target')).remove();
			recountInViewReturnLast{{$value['name']}}();
		});
		function recountInViewReturnLast{{$value['name']}}(){
			$.each($("#div_hidden_{{$value['name']}} input"),function(key,val){
				val = $(val);
				val.attr("name","{{$value['name']}}["+key+"]");
				val.attr("id","{{$value['name']}}_"+key);
			});
			return $("#div_hidden_{{$value['name']}} input").last();
		}
		$(".{{$value['class']}}").on('input',function(event){
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
					button_to_close = jQuery('<button>',{
						type:'button',
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
						recountInViewReturnLast{{$value['name']}}();
					});
					$("#div_btns_close_{{$value['name']}}").append(button_to_close);

					$("#div_hidden_{{$value['name']}}").append(hidden_value);
					last_element = recountInViewReturnLast{{$value['name']}}();
					button_to_close.attr("hidden-target","#"+last_element.attr('id'));
					$("#{{$value['class']}}").val('');
			    }
			}).focus(function () {
			    $(this).autocomplete("search");
			});
		});
	});
</script>
<div class="col-lg-12">
	{{Form::label($value['key'],$value['label'])}}
	<input type="input" hidden-target={{'#hidden_'.$value['name']}} id="{{$value['class']}}" class="form-control {{$value['class']}}" id={{$value['class']}}>
	<div id="div_btns_close_{{$value['name']}}">
		@if(!empty($defult_values))
			@foreach($defult_values as $key=>$variable)
				<button type='button' class="span_remove_{{$value['name']}}" hidden-target ="#{{$value['name']."_".$key}}"
						style= "background-color:red; border-radius:5px; color: white; border-style: solid; border-color: red; margin-right:3px; margin-top: 6px">
						{{$variable->name}}
					<span aria-hidden='true'
						font-weight = 'bold'> &times</span>
				</button>
			@endforeach
		@endif
	</div>
	<div id="div_hidden_{{$value['name']}}">
		@if(!empty($defult_values))
			@foreach($defult_values as $key => $variable)
				<input type="hidden" value="{{$variable['id']}}" name="{{$value['name']."[".$key."]"}}" id="{{$value['name']."_".$key}}">
			@endforeach
		@endif
	</div>
</div>