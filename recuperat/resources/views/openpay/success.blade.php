@extends("layouts.basic")
@section("content")	
	@include("openpay.success.content",["mail_status"=>$mail_status, "order",$order])
@endsection
