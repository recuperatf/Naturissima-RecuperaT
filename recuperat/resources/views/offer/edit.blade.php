@extends("layouts.basic")
@section("partial_css")
label{
font-weight: bold;
}
@endsection
@section("content")
<script type="text/javascript">
		$(function(){
			$("#product_img").change(readURL);
		});
		function unsetImg(event){
			$("[name='previous_image']").val("");
			event.preventDefault();
			target=$($(event.target).attr("target"));
			$("#img_preview").hide();
			target.val('');

		}
		function readURL() {
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
</script>
<style type="text/css">
	.ui-autocomplete {
	            max-height: 200px;
	            overflow-y: auto;
	            /* prevent horizontal scrollbar */
	            overflow-x: hidden;
	            /* add padding to account for vertical scrollbar */
	            padding-right: 20px;
	        } 
</style>
<script type="text/javascript">

	$(function(){
		$("[name='offer_type_id'] option:first").prop('selected','selected');
		product_names={!! json_encode($products) !!};
		parsed_product_names=[];
		$(".remove_product").click(remove_target);
		$.each(product_names,function(key,val){
			parsed_product_names.push({id:val.id,value:val.name});
		});
		$("[name=offer_type_id]").change(function(){
			seleccionado=$(this).children("option:selected").val();
			$(".selected_product_tags,.hidden_inputs_product_ids").html("");
			if(seleccionado==1){
				enable_offer($(".div_offer_price"),true);
			}else{
				enable_offer($(".div_percetage_off"),true);

			}
		});
		$("[name='offer_type_id']").val(1);
		$("[name='offer_type_id']").trigger('change');
		$(".product_selector").autocomplete({
			source: parsed_product_names,
			minLength: 0,
			delay: 0,
			select:function(event, item){
		    	//si es varios productos por un precio, hay que poner cuantos son
		    	qty=1;
		    	if($("[name=offer_type_id]").children("option:selected").val()==1){
		    		qty=prompt( "¿Cuantos '"+item.item.value+"' se incluyen?","1");
		    	}else if($("[name=offer_type_id]").children("option:selected").val()==2){
		    		$(".selected_product_tags,.hidden_inputs_product_ids").html("");
		    	}
		    	hidden_inputs_div=$(".hidden_inputs_product_ids");
		    	order=$(".hidden_inputs_product_ids .product_hidden_input").length;
		    	order=order/2;
		    	
		    	hidden_name="products["+order+"]";
		    	hidden_input=jQuery("<input>",{
		    		class:"product_hidden_input id",
		    		name:hidden_name+"[id]",
		    		type:"hidden"
		    	}).val(item.item.id);
		    	hidden_input_qty=jQuery("<input>",{
		    		class:"product_hidden_input qty",
		    		name:hidden_name+"[qty]",
		    		type:"hidden"
		    	}).val(qty);
		    	hidden_inputs_div.append(hidden_input_qty);
		    	hidden_inputs_div.append(hidden_input);

		    	selected_tags_div=$(".selected_product_tags");
		    	input_tag=jQuery("<button>",{
		    		class:"btn btn-danger remove_product",
		    		remove_target_name:hidden_name
		    	}).html(item.item.value+" x"+qty);
		    	input_tag.click(remove_target);
		    	selected_tags_div.append(input_tag);
		    }
		}).focus(function () {
		    //reset result list's pageindex when focus on
		    console.log("uno");
		    $(this).autocomplete("search");
		});
	});
	function remove_target(event){
		$(this).remove();
		name=$(this).attr("remove_target_name");
		$("[name='"+name+"[id]']").remove();
		$("[name='"+name+"[qty]']").remove();
		retag_after_tags_change()
	}
	function retag_after_tags_change(){
		$.each($(".hidden_inputs_product_ids .product_hidden_input.id"),function(key,value){
				key=(key!=0)?(key--):key;
				$(value).attr("name","products["+(key)+"][id]");
				console.log("name","products["+(key)+"][id]");
		});
		$.each($(".hidden_inputs_product_ids .product_hidden_input.qty"),function(key,value){
				key=(key!=0)?(key--):key;
				$(value).attr("name","products["+key+"][qty]");
				console.log("name","products["+key+"][qty]");
		});
		$.each($(".selected_product_tags remove_product"),function(key,value){
			$(value).attr("remove_target_name","products["+key+"]");
		});
	}
	function enable_offer(div_to_show, show){
		$(".div_type_of_offer").hide();
		$(".div_type_of_offer").find("input").attr("disabled");
		$(".div_type_of_offer").find("input").val("");
		if(show){
			div_to_show.show();
			div_to_show.find("input").removeAttr("disabled");
		}else{
			div_to_show.hide();
		}
	}
</script>
<?php 
	if(isset($O_offer)){
		$edit_conditions=json_decode(($O_offer->json_conditions));
	}
 ?>

 <div class="container">
 	<div class="row">
 		<div class="col-lg-12">
 			 @if ($errors->any())
			     <div class="alert alert-danger">
			         <ul>
			             @foreach ($errors->all() as $error)
			                 <li>{{ $error }}</li>
			             @endforeach
			         </ul>
			     </div>
			 @endif
 		</div>
 	</div>
 </div>	
<form action="{{isset($O_offer)?route('ofertas.update',$O_offer):route('ofertas.store')}}" method="post" enctype="multipart/form-data">
	@if(!empty($model))
		@if($model)
			{{ method_field('PATCH') }}
		@endif
	@endif
	
	<div class="container">
		@if(isset($message))
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success">
					{{$message}}
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-lg-5">
				<label for="name">Nombre</label>
				<input id="name" type="text" name="name" class="form-control" value="{{isset($O_offer)?$O_offer->name:''}}">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5">
				<label for="name">Descripción</label>
				<input id="name" type="text" name="description" class="form-control" value="{{isset($O_offer)?$O_offer->description:''}}">
			</div>
		</div>
		<label for="product_img">Imagen</label>
		<br>
			@isset($O_offer)
				<input type="hidden" name="previous_image" value="{{$O_offer->img}}">
				<img id="img_preview" style="{{($O_offer->img)?'display:block':'display:none'}}" src="{{'/images/promociones/'.$O_offer->img}}" alt="No se encontró imagen">
			@endif
				<img id="img_preview" style="display: none">
		<br>
		<div class="custom-file">
			<input type="file" class="custom-file-input" name="img" id="product_img" lang="es">
			<label class="custom-file-label" for="product_img">Seleccionar Archivo</label>
			<button class="btn btn-warning" target="#product_img" onclick="unsetImg(event)" style="margin-bottom: 20px">Quitar Imagen</button>
		</div>
		<div class="row">
			<div class="col-lg-5">
				<label for="name">Tipo</label>
				@if(isset($O_offer))
				<select class="form-control" id="type" name="offer_type_id" {{isset($O_offer)?("value=".$O_offer->type->id):""}}>
					@else
					<select id="type" name="offer_type_id"  class="form-control">
						@endif
						@foreach($types as $type)
						@if(isset($O_offer))
							<option value="{{$type->id}}" {{($O_offer->offer_type_id==$type->id)?"selected":""}}>{{$type->human_name}}</option>
							@else
							<option value="{{$type->id}}">{{$type->human_name}}</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="row div_percetage_off div_type_of_offer" style="{{isset($O_offer)?(($O_offer->offer_type_id!=2)?'display:none':''):''}}">
				<div class="col-lg-5" >
					<label>Porcentaje de descuento: </label>
					<input type="number" {{isset($O_offer)?(($O_offer->offer_type_id!=2)?"disabled":""):""}} class="form-control" name="json_conditions[value]" placeholder="%" {{isset($edit_conditions)?"value=$edit_conditions->value":""}}>
				</div>
			</div>
			<div class="row div_offer_price div_type_of_offer" style="{{isset($O_offer)?(($O_offer->offer_type_id!=1)?'display:none':''):''}}">
				<div class="col-lg-5" >
					<label>Precio total para los productos</label>
					<input type="number" {{isset($O_offer)?(($O_offer->offer_type_id!=1)?"disabled":""):""}}  class="form-control" name="json_conditions[value]" placeholder="Precio total"  {{isset($edit_conditions)?"value=$edit_conditions->value":""}}>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<label for="end_date">Fecha de inicio</label>
					<input id="end_date" type="date" name="json_conditions[start_date]" class="form-control" {{isset($edit_conditions)?"value=$edit_conditions->start_date":""}}>
				</div>
				<div class="col-lg-3">
					<label for="end_date">Fecha de fin</label>
					<input id="end_date" type="date" name="json_conditions[end_date]" class="form-control" {{isset($edit_conditions)?"value=$edit_conditions->end_date":""}}>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<label>Aplica los días:</label>
				</div>
				<div class="col-lg-1">
					<label for="cb_lunes">Lunes</label>
					<input id="cb_lunes" type="checkbox" name="json_conditions[week_days][Lunes]" class="form-control" {{isset($edit_conditions)?(isset($edit_conditions->week_days->Lunes)?"checked":""):""}}>
				</div>
				<div class="col-lg-1">
					<label for="cb_lunes">Martes</label>
					<input id="cb_lunes" type="checkbox" name="json_conditions[week_days][Martes]" class="form-control" {{isset($edit_conditions)?(isset($edit_conditions->week_days->Martes)?"checked":""):""}}>
				</div>
				<div class="col-lg-1">
					<label for="cb_lunes">Miércoles</label>
					<input id="cb_lunes" type="checkbox" name="json_conditions[week_days][Miercoles]" class="form-control" {{isset($edit_conditions)?(isset($edit_conditions->week_days->Miercoles)?"checked":""):""}}>
				</div>
				<div class="col-lg-1">
					<label for="cb_lunes">Jueves</label>
					<input id="cb_lunes" type="checkbox" name="json_conditions[week_days][Jueves]" class="form-control" {{isset($edit_conditions)?(isset($edit_conditions->week_days->Jueves)?"checked":""):""}}>
				</div>
				<div class="col-lg-1">
					<label for="cb_lunes">Viernes</label>
					<input id="cb_lunes" type="checkbox" name="json_conditions[week_days][Viernes]" class="form-control" {{isset($edit_conditions)?(isset($edit_conditions->week_days->Viernes)?"checked":""):""}}>
				</div>
				<div class="col-lg-1">
					<label for="cb_lunes">Sábado</label>
					<input id="cb_lunes" type="checkbox" name="json_conditions[week_days][Sabado]" class="form-control" {{isset($edit_conditions)?(isset($edit_conditions->week_days->Sabado)?"checked":""):""}}>
				</div>
				<div class="col-lg-1">
					<label for="cb_lunes">Domingo</label>
					<input id="cb_lunes" type="checkbox" name="json_conditions[week_days][Domingo]" class="form-control" {{isset($edit_conditions)?(isset($edit_conditions->week_days->Domingo)?"checked":""):""}}>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5" >
					<div class="hidden_inputs_product_ids">
						@if(isset($O_offer))
						@foreach($O_offer->products as $key=>$product)
							<input type="hidden" name="products[{{$key}}][id]" class="product_hidden_input id" value="{{$product->id}}">
							<input type="hidden" name="products[{{$key}}][qty]" class="product_hidden_input qty" value="{{$product->pivot->qty}}">
						@endforeach
						@endif
					</div>
					<label>Productos</label>
					<input type="text" name="none" class="product_selector form-control">
					<br/>
					<div class="selected_product_tags">
						@if(isset($O_offer))
						@foreach($O_offer->products as $key=>$product)
							<button class="btn btn-danger remove_product" remove_target_name="products[{{$key}}]">{{$product->name}} x{{$product->pivot->qty}}</button>
						@endforeach
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5" >
					<br/>
					<input type="submit" name="" class="{{isset($O_offer)?'btn btn-warning':'btn btn-primary'}}" value="{{isset($O_offer)?'Modificar Oferta':'Agregar Oferta'}}">
				</div>
			</div>
		</div>
	</form>
	@endsection