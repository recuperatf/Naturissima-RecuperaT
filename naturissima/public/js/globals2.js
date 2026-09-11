function getFirstParentWithClass(object, classname){
	return object.parents("."+classname).first();
}

function manageCart(e, add, confirm=true){
	J_e_target=$(e.target);
	ID_product=J_e_target.attr("product-target");
	if(add && confirm){
		B_answer=window.confirm("¿Deseas agregar este producto al carrito?");
	}else if(!add && confirm){
		B_answer=window.confirm("¿Deseas quitar este producto del carrito?");
	}
	if(B_answer){
		$.ajax({
			method:"post",
			url:"/tienda/manage_cart",
			data:{
				product_info:{
					id:ID_product,
					qty:1
				},
				cart_method:add?"put":"forget",
				_token: $("#csrf_token").val(),
			},
			success:function(data){
				data=JSON.parse(data);
				modifyCartSize(Object.size(data.IDs_cart_products));
				renderRemoveFromCartButtons(data.IDs_cart_products);
				alert(data.text);
			},
			failure:function(){
				alert("error de conexión");		
			}
		});
		return true;
	}
	return false;
}
//will render the buttons it they are in the cart, according to the json encode returned by the function in the controller
function renderRemoveFromCartButtons(IDs_cart){
	$("button.btn-warning").css("display","none");
	$.each(IDs_cart,function(key, value){
		$("button.btn-warning[product-target="+value.product_info.id+"]").css("display","inline");
	});
}
function modifyCartSize(size){
	$("#div_cart_size").html("("+size+")");
}
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
function checkTotal(){
	pressumed_total=$("#checkout_total").html();
	if(pressumed_total<minimum_checkout){
		return false;
	}
	return true;
}
function gotoPage(event=false){
	if(event==false){
		$(".modal_checkout_page").hide();
		$(".modal_checkout_page").first().show();
		return;
	}
	event.preventDefault();
	event.stopPropagation();
	object=$(event.target);
	if(object.hasClass("delivery") && minimum_checkout!=undefined){
		// if(!checkTotal()){
		// 	alert("El precio de tu compra no supera el mínimo requerido, no puedes utilizar esta opción.");
		// 	return;
		// }
	}
	if(object.attr("type")=="checkbox"){
		// $(".delivery_pickup").attr("disabled",true);
		$(object.attr("target")).removeAttr("disabled");
	}
	parent_page=getFirstParentWithClass(object, "modal_checkout_page");
	parent_page.css("display","none");
	div_next_page=$(object.attr("next_page"));
	if((div_next_page.attr("no-show")!=0) && (div_next_page.attr("no-show")!=undefined)){
		div_next_page=$(div_next_page.attr("no-show"));
	}
	div_next_page.css("display","block");

}