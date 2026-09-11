<script type="text/javascript">

	$(function(){
		$("#btn_add_url_{{$value['key']}}").click(function(){
			add{{$value['key']}}Tag($("#input_{{$value['key']}}").val());
		});
		order_{{$value['key']}}();
	});

	function add{{$value['key']}}Tag(text){
		btn_tag_resource = jQuery('<button>',{
			type:'button',
			class:'btn btn-primary btn-small',
			style:'background-color:green; border-color:green; margin-left:5px;',
		}).html(text);
		$("#div_tags_{{$value['key']}}").append(btn_tag_resource);

		hidden_tag_text = jQuery('<input>',{
			type : 'hidden',
			name : '{{$value['key']}}'
		}).val(text);

		$("#div_hidden_{{$value['key']}}").append(hidden_tag_text);
		$("#div_tags_{{$value['key']}}").append(btn_tag_resource);
		order_{{$value['key']}}();
	}

	function order_{{$value['key']}}(){
		$.each($("#div_hidden_{{$value['key']}} input"),function(key, val){
			val = $(val);
			val.attr('id', 'hidden_{{$value['key']}}_'+key);
			val.attr('name', '{{$value['key']}}['+key+'][url]');
		});
		console.log($("#div_tags_{{$value['key']}} button"));
		$.each($("#div_tags_{{$value['key']}} button"),function(key, val){
			val = $(val);
			val.attr('target-hidden-{{$value['key']}}', '#hidden_{{$value['key']}}_'+key);
			val.click(function(){
				if(confirm('¿Desear borrar esta liga?')){
					$(this).remove();			
					$($(this).attr("target-hidden-{{$value['key']}}")).remove();			
					order_{{$value['key']}}();
				}
			});
		});
	}

</script>
<div class="col-lg-12">
	<h4>{{!empty($value['label'])?$value['label']:'Enlaces'}}</h4>
</div>
<div class="col-lg-12">
	<input id='input_{{$value['key']}}' class="form-control" placeholder="URL">
	<button type="button" class="mt-2 btn btn-primary" id="btn_add_url_{{$value['key']}}"><i class="fas fa-plus"></i>Añadir URL</button>
	<div id="div_hidden_{{$value['key']}}">
		@if(!empty($value['default']))
			@foreach($value['default'] as $key=>$default_value)
				<input type="hidden" href="" name="{{$value['key']}}[{{$key}}]['url']" id="hidden_{{$value['key']}}_{{$key}}" value="{{$default_value->url}}">
			@endforeach
		@endif
	</div>
	<div style="" id = "div_tags_{{$value['key']}}" >
		@if(!empty($value['default']))
			@foreach($value['default'] as $key=>$default_value)
				<button  type="button" class="no_print btn btn-primary btn-small" style="background-color:green; border-color:green; margin-left:5px;">
					{{$default_value->url}}
				</button>
				<input type="hidden" print-value="{{$default_value->url}}" class="hidden_href"  href="{{$default_value->url}}"/>
			@endforeach
		@endif
	</div>
</div>