$(function(){
	$("input.price").change(AJAX_change_product_quantity);
	calculate_products_value();

	$("select[select_municipality_id]").change(function(){
		ID_state=$(this).val();
		get_set_municipalities_from_state(ID_state, $(this).attr("select_municipality_id"));
	});

	$("input[select_state_id]").change(function(){
		set_state_code_from_postal_code($(this).val(),$(this).attr("select_state_id"));
	});
});

function calculate_products_value(){
	total=0;
	$.each($("input.price"),function(key,value){
		let multiplicand=1;
		if($(value).val()!=""){
			multiplicand=$(value).val();
		}
		let individual_total = +$(value).attr("product-price") * +$(value).val();
		$(".total_individual_quantity[product-target="+$(value).attr("product-target")+"]").html(multiplicand);
		$(".total_individual_price[product-target="+$(value).attr("product-target")+"]").html(individual_total);
		total += individual_total;
	});
	$("#checkout_total").html(total);
}

function AJAX_change_product_quantity(){
	calculate_products_value();
}

function remove_from_checkout(event){
	J_e_target=$(event.target);
	removed=manageCart(event, false);
	if(removed){
		J_e_target.parents(".row-checkout").first().remove();
	}
}

function get_set_municipalities_from_state($id, municipality_id){
	$.ajax(
	{
		method: 'get',
		url:"/helper/ajax_get_municipalities_from_state_id/"+$id,
		success:function(data){
			$(municipality_id).html("");
			option=$('<option/>');
			option.html("Seleccione un municipio");
			option.attr("value",0);
			$(municipality_id).append(option);
			$.each(data,function(key, value){
				option=$('<option/>');
				option.html(value.name);
				option.attr("value",value.id);
				$(municipality_id).append(option);
			});
			return true;
		},
		failure:function(res){
			console.log(res);
		}
	}
	);
}

function set_state_code_from_postal_code($code,select_state_id){
	$.get(
	{ 	
		url:"https://api-codigos-postales.herokuapp.com/v2/codigo_postal/"+$code,
		success:function(data){
			set_data_by_area_code(data.estado,data.municipio, select_state_id);	
		}
	});
}

function set_data_by_area_code(name_state, name_municipality,select_state_id){
		$.get(
	{ 	
		url:"/helper/ajax_get_estate_id_by_name/"+name_state,
		success:function(state_id){
			$(select_state_id).val(state_id).trigger("change");
			select_municipality_id=$(select_state_id).attr("select_municipality_id");
			setTimeout(set_municipality_selector_from_name, 200,name_municipality, select_municipality_id);
		}
	});	
}

function set_municipality_selector_from_name(name_municipality,select_municipality_id){
			$.get(
	{ 	
		url:"/helper/ajax_get_municipalities_id_by_name/"+name_municipality,
		success:function(municipality_id){
			$(select_municipality_id).val(municipality_id);
		}
	});	
}