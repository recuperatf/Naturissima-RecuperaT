@extends("layouts.basic")
@section("partial_js")
{{-- <script src="https://malsup.github.com/jquery.form.js"></script>  --}}
<script type="text/javascript">
	$(function(){
		$("#product_img").change(readURL);
		$("#select_product_category_id").change(function(event){
			if($(this).val()==8){
				showFile(true, {{(!(empty($product))?"false":"true")}});
			}else{
		console.log("disable");
				showFile(false);
			}
		});
		$("#select_product_category_id").trigger("change");
		$("#btn_enable_switch_files").click(enableFile);
	});
	function unsetImg(event){
		event.preventDefault();
		target=$($(event.target).attr("target"));
		$("#img_preview").hide();
		$("[name='previous_image']").val('');
		target.val('');
		$("#hidden_removePicture").val(1);

	}
	function showFile(show, enable=true){
		if(show){
			$("#div_select_file").show();
			if(enable){
				$("#div_select_file").children("input").removeAttr("disabled");
			}else{
				$("#div_select_file").children("input").attr("disabled",'true');
			}
		}else{
			$("#div_select_file").hide();
			$("#div_select_file").children("input").attr("disabled","true");
		}
	}
	function readURL() {
		$("#hidden_removePicture").val(0);
		input=this;
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#img_preview").show();
				$('#img_preview')
				.attr('src', e.target.result)
				.width(150)
				.height(200);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function enableFile(){
		if($(this).hasClass("enabler")){
			$(this).html("No deseo subir un archivo diferente asociado a este producto");
			$(this).attr("class","btn btn-danger");
			$("#file").removeAttr("disabled");
			$(this).removeClass("enabler");
		}
		else{
			$(this).html("Deseo subir un archivo diferente asociado a este producto");
			$(this).attr("class","btn btn-primary");
			$("#file").attr("disabled",true);
			$(this).addClass("enabler");
		}
		// $(this).toggleClass("enabler");
	}
</script>
@endsection
@section("content")
<div class="container">
	@if (session('message'))
	    <div class="alert alert-success">
	        {{ session('message') }}
	    </div>
	@endif
	@if (!empty($errors))
		@if ($errors->any())
			<div class="row">
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
	@endif

		@if(isset($product))
			{{Form::model($product,['route'=>['store.update',$product->id], 'method' => 'put', 'files' => true])}}
		@else
			{{Form::open(['route'=>'store.store', 'method'=>'post', 'files' => true])}}
		@endif
		@if(isset($product))
		{{-- <input type="hidden" name="_method" value="PUT"> --}}
		@endif
		@csrf
		<input type="hidden" id="hidden_removePicture" name="removePicture" value="0">
		<label for="product_name">Nombre</label>
		<input class="form-control" id="product_name" type="text" name="name" value="{{isset($product)?$product->name:''}}"/>
		<label for="active">Activo</label>
		<input type="checkbox" name="active" {{isset($product)?(($product->active)?'checked':''):""}}>
		<br>
		<label for="product_description">Descripción</label>
		<textarea class="form-control" id="product_description" type="text" name="description">{{isset($product)?$product->description:''}}</textarea>
		<label for="product_price_mxn">Precio</label>
		<input type="decimal" class="form-control" id="product_price_mxn" name="price_mxn" value="{{isset($product)?$product->price_mxn:''}}"></input>
{{-- 		<div>
			<label for="product_price_mxn">¿Es de Grevill?</label><input type="checkbox" name="is_grevill" {{!empty($product)?(!(empty($product->is_grevill))?'checked':''):''}}>
		</div> --}}
		<label for="product_img">Imagen</label>
		<br>
			@isset($product)
				<input type="hidden" value="{{$product->img}}" name="previous_image">
				<img id="img_preview" style="{{($product->img)?'display:block':'display:none'}}" src="{{$product->img ? '/images/'.$product->img : ''}}" alt="Sin Imagen Disponible">
			@endif
				<img id="img_preview" style="display: none">
						<br>
		<div class="custom-file">
			<input type="file" class="custom-file-input" name="img" id="product_img" lang="es">
			<label class="custom-file-label" for="product_img">Seleccionar Archivo</label>
			<button class="btn btn-warning" target="#product_img" onclick="unsetImg(event)" style="margin-bottom: 20px">Quitar Imagen</button>
		</div>
		<label for="product_category_id">Seleccione una categoría</label>
		<select id="select_product_category_id" autocomplete="off" name="product_category_id" class="form-control">
			<option value="">Seleccione una categoría</option>
			@foreach($categories as $category)
			<option value="{{$category->id}}" {{($category->id==(isset($product)?$product->product_category_id:0))?"selected=selected":""}}>{{$category->name}}</option>
			@endforeach
		</select>
		@if(!empty($product))
			@if($product->product_category_id==8)
				<button style="margin:10px 0px 10px" type="button" class="btn btn-primary enabler" id="btn_enable_switch_files">Deseo subir un archivo diferente asociado a este producto</button>
				<div id="div_select_file">
					<input type="file" id="file" class="form-control" name="file" disabled>
				</div>
			@endif
			@else
				<div style="" id="div_select_file">
					<input type="file" id="file" class="form-control" name="file">
				</div>
		@endif
		@if(!empty($product))
			@if($product->file)
			<div>
				<a href="{{route('product.download_file',$product)}}" target="_blank">Descarga el archivo</a>
			</div>
			{{-- <div>
				<a href="{{Storage::url($product->file)}}" target="_blank">Vista previa</a>
			</div> --}}
			@endif
		@endif
		@if(!empty($product))
		<input type="submit" class="btn btn-primary" value="Actualizar" style="margin-top: 15px" />
		@else
		<input type="submit" class="btn btn-primary" value="Crear"/>
		@endif
	{{Form::close()}}
</div>
@endsection