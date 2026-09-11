@extends("layouts.basic")
@section("content")
<div class="container" style="min-height: 80vh">
	<div class="row" style="text-align: center;">
		<div class="col-12">
			@if($product_category->img)
				<img style="width: 50vw; height: 50vh;" src="{{'/images'.$product_category->img}}">
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			{!!$product_category->description!!}
		</div>
	</div>
	<div class="row">
		<div class="col-2 offset-5">
			<br/>
			<a href="{{route('store.index',['product_category_id'=>$product_category->id])}}">
				<button class="btn btn-primary">Ver {{strtolower($product_category->name)}}</button>
			</a>
		</div>
	</div>
</div>
@endsection