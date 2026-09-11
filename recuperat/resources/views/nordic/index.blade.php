@extends('layouts.basic')
@section('content')
<script type="text/javascript">
	$(function(){
		$(".i_accept").hide();
		$(".i_accept").click(function(){ajaxUpdate($(this).attr("cie9mc_id"))});
		$(".i_edit").click(
			@if(empty($route_edit))
				function(){
					$(this).hide();
					$(this).next().show();
					activateEdition($(this).attr("cie9mc_id"));
				}
			@else
				function(){
					window.location.assign('/{{$route_path}}/'+$(this).attr("cie9mc_id")+'/edit');
				}
			@endif
		);
		$(".input_search_terms").change(function(){
			let a = $(".a_search");
			a.attr("href", '{{route($route_search)}}?search_terms='+$(this).val());

		});
		$(".i_delete").click(function(){ajaxDelete($(this).attr("cie9mc_id"))});
	});
	function activateEdition(id){
		revertAllEdition();
		let tds=$("tr[cie9mc_id='"+id+"']").children("td").not(".actions");
		$.each(tds, function(key, val){
			val = $(val);
			name = val.attr("name");
			let content=val.html();
			val.html('');
			val.append(jQuery('<input>',{value:content, class:"form-control edit-field", name:name}));
		});
	}
	function revertAllEdition(){
		let inputs=$("tr input");
		$.each(inputs, function(key, val){
			val=$(val);
			let td = jQuery('<td>').html(val.val());
			val.after(td);
			val.remove();
		});
	}
	function ajaxUpdate(id){
		$.ajax({
			method:'post',
			data:$(".edit-field").serializeArray(),
			url:'{{route($route_update,[],false)}}/'+id,
			success:function(data){
				if(data==="true")
					location.reload();
			}
		});
	}
	function ajaxDelete(id){
		$.ajax({
			method:'post',
			data:{id:id},
			url:'{{route($route_delete,[],false)}}',
			success:function(data){
					location.reload();
			}
		});
	}
</script>
	<div class="container">
		<div class="row mb-3">
			<div class="col-lg-1">
				<a href={{route($route_create)}} class="btn btn-primary">Crear</a>
			</div>
			<div class="col-lg-4">
				<input type="text" name="search_terms" id="search_terms" class="form-control input_search_terms">
				<a href="{{route($route_search)}}" class="btn btn-primary a_search">Buscar</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				{{ $C_model->appends(request()->except('page'))->links() }}
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-responsive">
					@foreach($keys_to_show as $key=>$value)
					@if(sizeof(explode('.', $key)) > 1)
					@php
								$A_request = array_merge(request()->all(), [explode('.', $key)[0]=>true]);
								@endphp
							@if(explode('.', $key)[1] == "filter")
							<th><a href="{{route($route_search,$A_request)}}">{{$value}}</a></th>
							@endif
							@else
							<th>{{$value}}</th>
							@endif
							@endforeach
							<th>Evaluaciones</th>
							<th>Acciones</th>
							@foreach($C_model as $model)
							<tr cie9mc_id="{{$model->id}}">
								@foreach($keys_to_show as $key=>$value)
								@php $key = explode('.',$key)[0]; @endphp
								<td name="{{$key}}">{{$model->$key}}</td>
								@endforeach
                                <td>
                                    <a href="/nordic?laboral_company_id={{$model->id}}" class="btn btn-primary">Nórdico</a>
                                    <a href="/nordic?laboral_company_id={{$model->id}}&csv=1" class="btn btn-primary">CSV Nórdico</a>
                                    <a href="/hand?laboral_company_id={{$model->id}}&csv=1" href="#" class='btn btn-primary'>CSV Mano</a>
                                    <a href="/elbow?laboral_company_id={{$model->id}}&csv=1" href="#" class='btn btn-primary'>CSV Codo</a>
                                    <a href="/shoulder?laboral_company_id={{$model->id}}&csv=1" href="#" class='btn btn-primary'>CSV Hombro</a>
                                    <a href="/cervical_column?laboral_company_id={{$model->id}}&csv=1" href="#" class='btn btn-primary'>CSV Columna Cervical</a>
                                    <a href="#" class='btn btn-primary'>CSV Columna Lumbar</a>
                                    <a href="#" class='btn btn-primary'>CSV Rodilla</a>
                                    <a href="#" class='btn btn-primary'>CSV Pie</a>
                                    <a href="#" class='btn btn-primary'>CSV Cargas</a>
                                </td>
								<td class="actions">
									@if(in_array('general_database.edit', Auth::user()->getReadablePermissions()) || Auth::user()->getAdminAttribute()
										|| (!empty($permissions['edit']) && Auth::user()->permissions->where('name', $permissions['edit'])->count()))
                                    @if(!empty($route_show) && Route::has($route_show))
										<a href="{{route($route_show, $model->id)}}"><i class="fas fa-eye btn"></i></a>
                                    @else
                                        <a href='/{{$route_path}}/{{$model->id}}'><i class="fas fa-eye btn"></i></a>
									@endif
									<i class="fas fa-edit btn btn-warning i_edit" cie9mc_id="{{$model->id}}"></i>
									@endif
							@if((Auth::user()->getAdminAttribute() || Auth::user()->permissions->where('name', (!empty($permissions['delete']) ? $permissions['delete'] : ''))->count())  && !($model->is_sealed))
							<i class="fas fa-trash btn btn-danger i_delete" cie9mc_id="{{$model->id}}"></i>
							@endif
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				{{ $C_model->appends(request()->except('page'))->links() }}
			</div>
		</div>
	</div>
@endsection
