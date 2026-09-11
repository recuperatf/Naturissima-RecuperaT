$(function(){
	$("input.price").change(AJAX_change_product_quantity);
	calculate_products_value();
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
function get_info_from_postal_code($code){
 $.get(
{ 	url:"https://api-codigos-postales.herokuapp.com/v2/codigo_postal/"+$code,
 	success:function(res){
 		console.log(res);
 	},
 	failure:function(res){
 		console.log(res);
 	}}
 	);
}
