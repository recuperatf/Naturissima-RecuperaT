@extends("layouts.basic")
@section("content")
<div class="container">
		@if (session('createdPatient'))
	<div class="row">
		    <div class="alert alert-success" role="alert">
		        {{ session('createdPatient') }}
		    </div>
	</div>
		@endif
	<div class="row">
		<div class="col-lg-12">
			<?php foreach($patients as $patient): ?>
			<?php endforeach; ?>		
		</div>
	</div>
</div>
@endsection