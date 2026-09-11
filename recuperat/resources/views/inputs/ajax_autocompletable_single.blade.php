<script type="text/javascript">
	$(function(){
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
					{{$value['after_select_function']}}(item.item);
					
			    }
			}).focus(function () {
			    $(this).autocomplete("search");
			});
		});
	});
</script>
	@if(!empty($value['label']))
	{{Form::label($value['key'],$value['label'])}}
	@endif
	<input type="input" hidden-target={{'#hidden_'.$value['name']}} id="{{$value['class']}}" class="form-control {{$value['class']}}" id={{$value['class']}}>