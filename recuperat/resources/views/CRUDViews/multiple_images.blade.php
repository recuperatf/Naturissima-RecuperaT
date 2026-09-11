<script type="text/javascript">
	function previewImage(input, imgTag) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      imgTag.attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]);
	  }
	}
	function addImgTagFromInput(){
		let imgTag = jQuery("<img>",{
		});
		$("#div_images_preview").append(imgTag);
		previewImage(this, imgTag)
	}
	$("#input").change(function() {
	  addImgTag();
	  addImgTagFromInput(this)
	});
</script>
<h4>Guardador de Imagenes</h4>
<input type="" name="">

<div id="div_images_preview">
	
</div>