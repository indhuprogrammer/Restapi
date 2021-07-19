/*
 *@Add New Customer for Lead
 *@Welcome Controller
*/

	var id='';
	function getCountry(val,id) {
		var sturl = "regionsettings/getCountry/"+ val+"/"+id;	
		$('#country_row').load(sturl);	
		return false;	
	}
	function getState(val,id) {
		var entity = $("#entity").val();
        var group  = $("#group").val();
		var sturl = "regionsettings/getState/"+ val+"/"+id;		
		$('#state_row').load(sturl);	
		var country = $("#add1_country").val();
        if(country == 15){
            $(".stno").hide();
            $(".county").hide();
            $(".suburb").hide();
            $(".building").hide();
            $(".block").show();
            $(".state").show();
            $(".city").show();
            $(".gsttype").show();
            $(".gst").show();
            $(".federal_tax").hide();
		}else if(country == 18){
			
				$(".block").hide();
				$(".stno").hide();
				$(".suburb").hide();
				$(".county").hide();
				$(".building").hide();	
				$(".state").show();
				$(".city").show();	
				$(".gsttype").hide();
				$(".gst").hide();
				$(".federal_tax").hide();
		}else if(country == 17){
				$(".stno").hide();
				$(".county").hide();
				$(".suburb").hide();
				$(".state").show();
				$(".city").show();
				$(".block").show();
				$(".building").show();
				$(".gsttype").hide();
				$(".gst").hide();
				$(".federal_tax").hide();
		}else if(country == 16){
				$(".stno").hide();
				$(".county").hide();
				$(".state").show();
				$(".suburb").hide();
				$(".city").show();
				$(".block").show();
				$(".building").show();
				$(".gsttype").hide();
				$(".gst").hide();
				$(".federal_tax").hide();
		}else if(country == 23){
				$(".stno").hide();
				$(".county").hide();
				$(".suburb").hide();
				$(".building").hide();
				$(".block").show();
				$(".state").show();
				$(".city").show();
				$(".gsttype").hide();
				$(".gst").hide();
				$(".federal_tax").show();
		}else{
			$(".stno").show();
			$(".county").show();
			$(".suburb").hide();
			$(".building").show();
			$(".block").show();
			$(".state").show();
			$(".city").show();
			$(".gsttype").show();
			$(".gst_in").show();
			$(".federal_tax").hide();
		}	
        // if(entity == 1 && country == 15 && (group==100 || group ==103)){
		// 		if($('#gst_in').val()=="") {
		// 			$("#gstin_err").html("Gstn is Required");
		// 			empty_err = false;
		// 		}
		// 	}
		return false;	
	}
	
	function getLocation(val,id) {
		var sturl = "regionsettings/getLocation/"+ val+"/"+id;	
		$('#location_row').load(sturl);	
		return false;	
	}

	$(document).ready(function() {
		$('.checkUser').hide();
		$('.checkUser1').hide();
		$('.checkUser2').hide();
		$('#emailval').keyup(function(){
			if( $('#emailval').val().length >= 1 )
			{
				var username = $('#emailval').val();
				//alert(email1);
				var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(filter.test(username)){
						// getResult(username);
						$('.checkUser').show(); 
						$('.checkUser1').hide();
						$('.checkUser2').hide();
						$("#positiveBtn").removeAttr("disabled");
				}else {
						$('.checkUser').hide(); 
						$('.checkUser1').hide();
						$('.checkUser2').show();
						$("#positiveBtn").attr("disabled", "disabled");
				}
			}
			return false;
		});
		function getResult(username){
			var baseurl = $('.hiddenUrl').val();
			var email = username
			var params = {};
			params[csrf_token_name] = csrf_hash_token;
			params['email'] = username;
			$.ajax({
				type: "POST",
				url : baseurl + 'customers/Check_email/',
				cache : false,
				data : params,
				success : function(response){
					$('.checkUser').hide();
					if(response == 'userOk') {
						$('.checkUser').show(); 
						$('.checkUser1').hide();
						$('.checkUser2').hide();
						$("#positiveBtn").removeAttr("disabled");
					} else { 
						$('.checkUser').hide(); 
						$('.checkUser2').hide(); 
						$('.checkUser1').show();
						$("#positiveBtn").attr("disabled", "disabled");
					}
				}
			});
		}
		

		
	});
	
	//pre-populate the default region, country, state & location
	if(usr_level >= 2 && cus_updt != 'update' ) {
		getDefaultRegion(usr_level, cus_updt);
	}
	function getDefaultRegion(lvl, upd) {
		var sturl = "regionsettings/getRegDefault/"+lvl+"/"+upd;
		$('#def_reg').load(sturl);
		return false;
	}
	function getDefaultCountry(id, upd) {
		var sturl = "regionsettings/getCntryDefault/"+id+"/"+upd;
		$('#def_cntry').load(sturl);
		return false;	
	}
	function getDefaultState(id, upd) {
		var sturl = "regionsettings/getSteDefault/"+id+"/"+upd;
		$('#def_ste').load(sturl);
		return false;	
	}
	function getDefaultLocation(id, upd) {
		var sturl = "regionsettings/getLocDefault/"+id+"/"+upd;
		$('#def_loc').load(sturl);
		return false;	
	}
	
//////////////////////////////////////////////////////////////////// end ///////////////////////////////////////////////////