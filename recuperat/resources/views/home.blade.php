
@extends('layouts.basic',["loginError"=>(isset($loginError)?$loginError:false)])
@section('partial_js')
<script type="text/javascript">
  var fadesInCarousel=400;
  var changeInterval=5000;
  $(function(){
    $(".display-on-hover").children().css("pointer-events","none");
    $(".display-on-hover").mouseenter(
        function(element){
          $($(element.target).attr("target")).fadeIn(500);

        }
      );
    $(".display-on-hover").mouseleave(
        function(element){
          $($(element.target).attr("target")).fadeOut(500);

        }
      );
    $('.carousel').carousel({
      interval: window.changeInterval
    })
    $('.carousel').bind('slide.bs.carousel', function (e) {
      $('.carousel-caption').fadeOut(window.fadesInCarousel).fadeIn(window.fadesInCarousel);
    });
    
  });
</script>
@endsection
@section('partial_css')
.rounded-corners-gray-bg {
border-radius: 25px;
background-color:rgba(255,255,255,0.5);
background-position: left top;
background-repeat: repeat;
padding: 20px; 
margin-top: 5vh;
color:black;
}
.rounded-corners-gray-bg-parallax{
  border-radius: 25px;
  background-color:rgba(255,255,255,0.5);
  background-position: left top;
  background-repeat: repeat;
  padding: 20px; 
  min-height:400px;
  margin-top: 5vh;
  color:black;
}
.btn-primary{
background-color:#2C5F2D;
border-color:#2C5F2D;
}
.cover-on-hover{
  position: absolute; 
  height: 100%; 
  width: 100%; 
  background-color: rgba(255,255,255,0.70); 
  display: none;
}
.btn-primary:hover{
background-color:#2C5F2D;
border-color:#2C5F2D;
}
.btn-primary:active{
background-color:#2C5F2D;
border-color:#2C5F2D;
}
.home_image{
  height:30wv 
}
.parallax {
background-image: url("images/wallpaper1.jpg"); 
min-height: 500px; 
background-attachment: fixed;
background-position: center;
background-repeat: no-repeat;
background-size: cover;
}
.carousel-content {
position: absolute;
bottom: 0%;
left: 0%;  
z-index: 20;
color: white;
text-shadow: 0 1px 2px rgba(0,0,0,.6);
text-align:center;
}
.carousel-caption{
  margin-bottom:40px;
}
@endsection
@section('content')


<div class="container">
  <div class="row">
    @include('home/text_image')
  </div>  
</div>
<br/>
@endsection
