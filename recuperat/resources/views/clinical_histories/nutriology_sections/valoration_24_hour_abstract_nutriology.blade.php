<div class="row abstract_24_hours_header_row" >
	<div class="col-xl-12">
		<h4><strong>RECORDATORIO DE 24 HRS</strong></h4>
	</div>
</div>
<div class="row">
		<div class="col-xl-3">
			<input type="text" class="form-control" id="input_time_abstract" placeholder="hora">
		</div>
		<div class="col-xl-3">
			<input type="text" class="form-control" id="input_food_abstract" placeholder="comida">
		</div>
		<div class="col-xl-3">
			<input type="text" class="form-control" id="input_group_abstract" placeholder="grupo">
		</div>
		<div class="col-xl-3">
			<input type="text" class="form-control" id="input_portions_abstract" placeholder="porciones">
		</div>
		<div class="col-xl-12">
		<button type="button" class="btn btn-primary btn-small" id="btn_add_row_abstract">Añadir<i class="fas fa-plus"></i></button>
	</div>
</div>
<div id="a_div" class="row"></div>
@push('javascript')
<script type="text/javascript">
	@php
		$abstract_24=(!empty($abstract_24))?$abstract_24->sortByDesc('created_at')->where('name','valoration_24_hour_abstract_nutriology'):false;
	@endphp
	var A_abstract_24={!!($abstract_24)?json_encode($abstract_24->toArray()):json_encode([])!!};
	$(function(){
		console.log(A_abstract_24);
		$("#btn_add_row_abstract").click(function(event){
			event.preventDefault();
			addRow();
		});
		$.each(A_abstract_24,function(key, abstract_24){
			console.log(abstract_24);
			json_values= abstract_24.json_values;
			addRow(json_values.time, json_values.food,json_values.group,json_values.portions);
		});
	});
	function removeRow(event){
		event.preventDefault();
		$(event.target).parents('.abstract_row').first().remove();
		renameRows();
	}
	function addRow(hora=false, food=false, group=false, portions=false){
		var cols_class='col-xl-4';
		var cols_class_time='col-xl-1';
		var cols_class_portions='col-xl-1';
		var cols_class_close_btn='col-xl-1';
		let key=countRows();
		DIV_row=jQuery('<div>',{class:'col-xl-12 abstract_row'});

		DIV_time=jQuery('<div>',{class:cols_class_time});
		hora=(hora)?hora:$('#input_time_abstract').val();
		food=(food)?food:$('#input_food_abstract').val();
		group=(group)?group:$('#input_group_abstract').val();
		portions=(portions)?portions:$('#input_portions_abstract').val();
		DIV_time=jQuery('<input>',{type:'hidden', name:'valoration_24_hour_abstract_nutriology['+key+'][json_values][time]'}).val(hora);
		DIV_food=jQuery('<input>',{type:'hidden', name:'valoration_24_hour_abstract_nutriology['+key+'][json_values][food]'}).val(food);
		DIV_group=jQuery('<input>',{type:'hidden', name:'valoration_24_hour_abstract_nutriology['+key+'][json_values][group]'}).val(group);
		DIV_portions=jQuery('<input>',{type:'hidden', name:'valoration_24_hour_abstract_nutriology['+key+'][json_values][portions]'}).val(portions);
		DIV_close=jQuery("<span>",{onclick:'removeRow(event)'}).append(jQuery('<i>',{class:"fas fa-close",style:'pointer-events:none'}));
		text=jQuery('<text>',{});
		text.html(hora+" - "+food+" ("+group+") "+" porciones: "+portions);

		$('#a_div').append(DIV_row);
		DIV_row.append(DIV_time);
		DIV_row.append(DIV_food);
		DIV_row.append(DIV_group);
		DIV_row.append(DIV_portions);
		DIV_row.append(text);
		DIV_row.append(DIV_close);
		renameRows();

	}
	function renameRows(){
		$.each($(".abstract_row"),function(key_row,row){
				row=$(row);
			$.each(row.find("input"),function(key,input){
				input=$(input);
				variable=input.attr("name").split("]")[2]+']';
				input.attr("name",'valoration_24_hour_abstract_nutriology['+key_row+'][json_values]'+variable);
			});
			
		});
	}
	function countRows(){
		return $(".abstract_row").length;
	}
</script>	
@endpush
