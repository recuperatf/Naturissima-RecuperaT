<script type="text/javascript">
	function previewImage{{$value['key']}}(input, div_img) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      div_img.css('background-image', 'url("'+e.target.result+'")');
	      div_img.css('background-size', '100%, auto');
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}
	function addImgTagFromInput{{$value['key']}}(input){
		let div_img = jQuery('<div>',{
			style: 'width:200px; height:200px; display:inline-block; background-repeat:no-repeat; background-size: 100% auto;',
			class: 'div_image_{{$value['key']}}'
		});
		$("#div_images_preview_{{$value['key']}}").append(div_img);
		previewImage{{$value['key']}}(input, div_img);
		orderImageInputs{{$value['key']}}($(input));
	}
	function orderImageInputs{{$value['key']}}(Jinput){
		let hidden_input_div = $("#div_hidden_input_files_{{$value['key']}}");
		let input_div = $("#div_input_files_{{$value['key']}}");
		let original_id = Jinput.attr("id");
		Jinput.removeAttr("id");
		let copyInput = Jinput.clone();
		Jinput.attr("hidden", true);
		hidden_input_div.append(Jinput);

		copyInput.attr("id", original_id);
		input_div.append(copyInput);
		Jinput.attr("hidden",true);
		renameFields{{$value['key']}}();
		addListeners{{$value['key']}}();
	}
	function renameFields{{$value['key']}}(){
		let inputs = $("#div_hidden_input_files_{{$value['key']}} input");
		let div_images = $("#div_images_preview_{{$value['key']}} .div_image_{{$value['key']}}");
		$.each(inputs, function(key, input){
			input = $(input);
			input.attr('name', "{{$value['key']}}["+key+"]");
			input.attr('id', "hidden_input_{{$value['key']}}_"+key);
		});
		$.each(div_images, function(key, div){
			div = $(div);
			div.attr('hidden-target','#hidden_input_{{$value['key']}}_'+key);
		});
	}
	function addListeners{{$value['key']}}(){
		$("#input_images_{{$value['key']}}").change(function() {
		  addImgTagFromInput{{$value['key']}}(this)
		});
		$(".div_image_{{$value['key']}}").click(function(){
			if(!confirm('¿De verdad quieres borrar esta imagen de la galería?'))
				return
			$(this).remove();
			$($(this).attr('hidden-target')).remove();
			renameFields{{$value['key']}}();
		});
	}
	$(function(){
		renameFields{{$value['key']}}();
		addListeners{{$value['key']}}();
	});
	
</script>
<div class="col-lg-12 {{!empty($value['no_print_header']) ? 'no_print': '' }}">
	<h4>{{!empty($value['label'])?$value['label']:'Galeria de Imágenes'}}</h4>
</div>
<div class="col-lg-12" id="div_hidden_input_files_{{$value['key']}}">
	@if(!empty($value['default']))
		@foreach($value['default'] as $key => $ImageResource)
			<input type="hidden" id="hidden_input_{{$value['key']}}_{{$key}}" name="{{$value['key']}}[{{$key}}]" value='{{$ImageResource->url}}'>
		@endforeach
	@endif
</div>
<div class="col-lg-12" id="div_input_files_{{$value['key']}}">
	<input type="file" class="form-control" id="input_images_{{$value['key']}}">
</div>
<div class="col-lg-12" id="div_images_preview_{{$value['key']}}">
	@if(!empty($value['default']))
		@foreach($value['default'] as $ImageResource)
		<div class="div_image_{{$value['key']}}" style="display: inline-block; background:url('/{{$ImageResource->url}}'); background-size: 100% auto; background-repeat: no-repeat; width: 200px; height: 200px;" hidden-target='#hidden_input_{{$value['key']}}_{{$key}}'>
		</div>
		@endforeach
	@endif
</div>