@push('javascript')
<script type="text/javascript">
	/* Set the width of the sidebar to 250px (show it) */
	$(function(){
		$(".openbtn_hfp").click(function(){
			if($("#mySidepanelHfp").attr("opened") == 'true'){
				closeNavHpf();
			}else{
				openNavHpf();
			}
		});
	});
	function openNavHpf() {
	  document.getElementById("mySidepanelHfp").style.width = "500px";
	  $("#mySidepanelHfp").attr("opened", true);
	}

	/* Set the width of the sidebar to 0 (hide it) */
	function closeNavHpf() {
	  $("#mySidepanelHfp").attr("opened", false);
	  document.getElementById("mySidepanelHfp").style.width = "0";
	}
	function divClinicDiagnosis(A_cie10_risk_factors){
		let div = $('<div>');
		let h = $("<h4>",{html:'Diagnósticos Clínicos'});
		div.append(h);
		if($(A_cie10_risk_factors).length >0){
				$(A_cie10_risk_factors).each(function(key, risk_factor){
					if(risk_factor.clinic_diagnosis.length > 0){
						let h_risk_factor = $("<h5>",{html:risk_factor.name});
						div.append(h_risk_factor);
						let ul = $('<ul>');
						$(risk_factor.clinic_diagnosis).each(function(key, clinic_diagnosis){
							const liItem = $('<li>',{
								html:$('<a>',{
									href: '/diagnosis_plan/'+clinic_diagnosis.id,
									html:clinic_diagnosis.name,
									target:'_blank'
								}),
							});
							ul.append(liItem)
						});
						div.append(ul);
					}
				});
				return div;
		}
			div.append('No hay terapias disponibles');
			return div;
	}

	function divFactoresDeRiesgo(A_cie10_risk_factors){
		let ul = $('<ul>');
		let div = $('<div>');
		if($(A_cie10_risk_factors).length >0){
			$(A_cie10_risk_factors).each(function(key, risk_factor){
				ul.append($('<li>',{
								html:risk_factor.name,
							}))
			});
			let h = $("<h4>",{html:'Factores de Riesgo'});
			div.append(h);
			div.append(ul);

			return div;
		}
			div.append('No hay factores de riesgo disponibles');
			return div;
	}
	function showHfpInfo(item){
		let protocoloId = item.id;
		console.log('ih')
		window.open(`/decision/${item.id}`, '_blank')
		$.ajax({
			method:'get',
			url:'/home_physiotherapy_program/'+item.id,
			success:function(data){
				// {"cie10_risk_factors_complete":[{"id":1,"code":"A000","name":"COLERA DEBIDO A VIBRIO CHOLERAE O1, BIOTIPO CHOLERAE","created_at":null,"updated_at":"2020-03-26 18:01:54","definition":null,"epidemiology":null,"text_lesion_mecanism":null,"text_symptoms":null,"text_diagnosis":null,"text_physical_treatments":null,"text_excersice_treatments":null,"text_functional_activites":null,"text_home_plan":null,"text_injury_mechanism":null,"text_clinic_radiologic_diagnosis":null,"pivot":{"protocolo_fisioterapia_id":14,"cat_cie10_id":1},"clinic_diagnosis":[{"id":15,"name":"PlanDiangostico1","description":"1","created_at":"2020-03-18 17:03:30","updated_at":"2020-03-26 17:34:29","pivot":{"cat_cie10_id":1,"diagnosis_plan_id":15}}]}]}
				$("#sidebar_content_hfp").html('');
				$("#sidebar_content_hfp").append(divFactoresDeRiesgo(data.cie10_risk_factors_complete));
				$("#sidebar_content_hfp").append(divClinicDiagnosis(data.cie10_risk_factors_complete));
			}
		});
	}


</script>
@endpush
@push('css')
<style type="text/css">
	 /* The sidepanel_hfp menu */
	.sidepanel_hfp {
	  height: 500px; /* Specify a height */
	  width: 0; /* 0 width - change this with JavaScript */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Stay on top */
	  top: 0;
	  left: 0px;
	  background-color: #FFF;
	  border-style: solid;
	  border-width: -2px;
	  border-color: rgba(28, 115, 52,100);
	  overflow-x: hidden; /* Disable horizontal scroll */
	  padding: 60px 0px 0px 0px; /* Place content 60px from the top */
	  transition: 0.5s; /* 0.5 second transition effect to slide in the sidepanel_hfp */
	}

	/* The sidepanel_hfp links */
	.sidepanel_hfp a{
	  padding: 8px 8px 8px 32px;
	  text-decoration: none;
	  font-size: 25px;
	  color: #818181;
	  display: block;
	  transition: 0.3s;
	}

	.sidepanel_hfp input{
		padding-right: 10px
	}

	/* When you mouse over the navigation links, change their color */
	.sidepanel_hfp a:hover {
	  color: #f1f1f1;
	}

	/* Position and style the close button (top right corner) */
	.sidepanel_hfp .closebtn {
	  position: absolute;
	  top: 0;
	  right: 25px;
	  font-size: 36px;
	  margin-left: 50px;
	}

	.sidepanel_hfp ul {
	  list-style: circle;
	}

	/* Style the button that is used to open the sidepanel_hfp */
	.openbtn_hfp {
      font-size: 10px;
	  position: fixed;
	  z-index: 1;
	  right: 20px;
	  bottom:70px;
	  cursor: pointer;
	  background-color: rgb(105 120 249);
	  color: white;
	  padding: 5px 10px;
	  border: none;
	}
	.float{
		position:fixed;
		width:60px;
		height:60px;
		bottom:40px;
		right:40px;
		background-color:#0C9;
		color:#FFF;
		border-radius:50px;
		text-align:center;
		box-shadow: 2px 2px 3px #999;
	}
	.openbtn_hfp:hover {
	  background-color: #444;
	}
	.sidepanel_hfp .form-control{
	  	position: absolute;
	  	right: 5%!important;
	  	width: 90%!important;
	}
	#sidebar_content_hfp{
		margin-top: 50px;
	}
	#sidebar_content_hfp a{
		color:blue;
		font-size: 12pt;
	}
	.ui-autocomplete {
    z-index: 10000;
	}
</style>
@endpush
<div id="mySidepanelHfp" class="sidepanel_hfp">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNavHpf()">&times;</a>
  <label>Busca un Programa Terapéutico en Casa</label>
  @include('inputs.ajax_autocompletable_single', ['value'=>['key'=>'text', 'class' => 'hpf_selector', 'url'=>'home_physiotherapy_program/ajaxGet', 'name'=>'hfp', 'after_select_function'=>'showHfpInfo']])
  <div id="sidebar_content_hfp">
  </div>
</div>

<button type="button" class="openbtn_hfp">Ver Programas Terapéuticos en Casa</button>
