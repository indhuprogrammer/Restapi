/*
 *@New User Detail
 *@User Module
 *@Jquery
*/

$(document).ready(function() {
	$('#role_id').change(function () {
        var val = $('#role_id').val();
        if( val == 14 ) {
			if(url_segment[3]!='update') {
				if(curUserId != 59) {
					$('#contract_manager').val(curUserId);
				}
			}
			$('#auth-db').prop('checked', true);
			$('#auth-ldap').prop('checked', false);
			$('#auth-ldap').attr('disabled', 'disabled');
			$('#reseller_row').show();
        } else {
			$('#reseller_row').hide();
			$('#auth-ldap').attr('disabled', false);
        }
    });
	
	$('.error').hide();
 
if(url_segment[3]!='update') {

} /*segment 3 is update end*/ 

	if(url_segment[3] != 'update') {
		
	//adduser
       var addlevelid = $('#level_id').val();
		if($("#level_id").val() == 1) {
		    $('.container-region').hide();
			$(".level-message").html("Your level has set to Global");
			$(".entity-box").css('display', 'none');
			$(".geography-box").css('display', 'none');
			$(".region-box").css('display', 'none');
			$(".country-box").css('display', 'none');	
			$(".state-box").css('display', 'none');
			$(".location-box").css('display', 'none');
		}
		else if($("#level_id").val() == 2) {
		//alert($("#level_id").val());
			loadRegion();		
			load_entity();
			load_geographys();
			$(".level-message").css('display', 'none');
			$(".country-box").css('display', 'none');	
			$(".state-box").css('display', 'none');
			$(".location-box").css('display', 'none');
			$('.container-region').show();
			$('.select-region').show();
			$('.select-country').hide();
			$('.select-state').hide();			
			$('.select-location').hide();	
		}
		else if($("#level_id").val() == 3) {
			var region_id = $("#region_load").val();
			if(region_id != 0) {
				var region_id = '';
			}
			$(".container-region option:selected").removeAttr("selected");
			$('#country_load option').empty();
			//document.write("<option value=''>Select</option>");
			loadRegion();
			load_entity();
			load_geographys();
			$(".level-message").css('display', 'none');
			$(".entity-box").css('display', 'block');
			$(".geography-box").css('display', 'block');
			$(".region-box").css('display', 'block');
			$(".country-box").css('display', 'block');	
			$(".state-box").css('display', 'none');
			$(".state-row").css('display', 'none');
			$(".location-box").css('display', 'none');
			$('.container-region').show();
			$('.select-region').show();
			$('.select-country').show();
			$('.select-state').hide();			
			$('.select-location').hide();			
		}
		else if($("#level_id").val() == 4) {
			$(".container-region option:selected").removeAttr("selected");
			$('#country_load option').empty();
			$('#state_load option').empty();
			$(".level-message").css('display', 'none');
			$(".entity-box").css('display', 'block');
			$(".geography-box").css('display', 'block');
			$(".region-box").css('display', 'block');
			$(".country-box").css('display', 'block');	
			$(".state-box").css('display', 'block');
			$(".location-box").css('display', 'none');
			$('.container-region').show();
			$('.select-region').show();
			$('.select-country').show();
			$('.select-state').show();
			$('.select-location').hide();
			loadRegion();
			load_entity();
			load_geographys();
		}
		else if($("#level_id").val() == 5) {
			$(".container-region option:selected").removeAttr("selected");
			$('#country_load option').empty();
			$('#state_load option').empty();
			$('#location_load option').empty();			
			$(".level-message").css('display', 'none');
			$(".entity-box").css('display', 'block');
			$(".geography-box").css('display', 'block');
			$(".region-box").css('display', 'block');
			$(".country-box").css('display', 'block');	
			$(".state-box").css('display', 'block');		
			$(".location-box").css('display', 'block');
			$('.container-region').show()
			$('.select-region').show();
			$('.select-country').show();
			$('.select-state').show();
			$('.select-location').show();
			loadRegion();
			load_entity();
			load_geographys();
		}	
	}
	//end of adduser
	
	
	if(url_segment[3] == 'update') { 
		if($('#role_id').val() == 14) {
			$('#reseller_row').show();
			$('#auth-ldap').attr('disabled', true);
		} else {
			$('#reseller_row').hide();
		}
	
		var editlevelid = $('#level_id').val();	

		if(editlevelid == "5") {
		$('.container-region').show();
		$(".level-message").css('display', 'none');
		$(".entity-box").css('display', 'block');
		$(".geography-box").css('display', 'block');
		$(".region-box").css('display', 'block');
		$(".country-box").css('display', 'block');	
		$(".state-box").css('display', 'block');		
		$(".location-box").css('display', 'block');
		$('.container-region').show();
		$('.select-entity').show();
		$('.select-geography').show();
		$('.select-region').show();
		$('.select-country').show();
		$('.select-state').show();
		$('.select-location').show();
		editloadRegion();
		editloadEntity();
		editloadGeography();
		} else if(editlevelid == "4") {
		$('.container-region').show();
		$(".level-message").css('display', 'none');
		$(".region-box").css('display', 'block');
		$(".entity-box").css('display', 'block');
		$(".geography-box").css('display', 'block');
		$(".country-box").css('display', 'block');	
		$(".state-box").css('display', 'block');		
		$(".location-box").css('display', 'none');
		$('.container-region').show();
		$('.select-entity').show();
		$('.select-geography').show();
		$('.select-region').show();
		$('.select-country').show();
		$('.select-state').show();
		$('.select-location').hide();		
		editloadRegion();
		editloadEntity();
		editloadGeography();
		} else if(editlevelid == "3") {
		$('.container-region').show();
		$(".level-message").css('display', 'none');
		$(".entity-box").css('display', 'block');
		$(".geography-box").css('display', 'block');
		$(".region-box").css('display', 'block');
		$(".country-box").css('display', 'block');	
		$(".state-box").css('display', 'none');		
		$(".location-box").css('display', 'none');
		$('.container-region').show();
		$('.select-entity').show();
		$('.select-geography').show();
		$('.select-region').show();
		$('.select-country').show();
		$('.select-state').hide();
		$('.select-location').hide();
		editloadRegion();
		editloadEntity();
		editloadGeography();
		}else if(editlevelid == "2") {
		$('.container-region').show();
		$(".level-message").css('display', 'none');
		$(".entity-box").css('display', 'block');
		$(".geography-box").css('display', 'block');
		$(".region-box").css('display', 'block');
		$(".country-box").css('display', 'none');	
		$(".state-box").css('display', 'none');		
		$(".location-box").css('display', 'none');
		$('.container-region').show();
		$('.select-entity').show();
		$('.select-geography').show();
		$('.select-region').show();
		$('.select-country').hide();
		$('.select-state').hide();
		$('.select-location').hide();
		editloadRegion();	
		editloadEntity();
		editloadGeography();
		} else if(editlevelid == "1") {	
		$(".level-message").html("Your level has set to Global");
		}	
   }

	function editloadRegion() {
		$(".region-box").css('display', 'block');
		//var region_id = $("#region_load").val();
		var edit_userid =  url_segment[4];
		var param = {};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/editloadRegions/'+edit_userid+'/',
			param,
			function(data) {
							
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#region_load").html(data);
						var regionid = $("#region_load").val();
						editloadCountry(regionid);
					}
			}
		);
	}
	function editloadEntity() {
		$(".entity-box").css('display', 'block');
		//var region_id = $("#region_load").val();
		var edit_userid =  url_segment[4];
		var param = {};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/editloadEntity/'+edit_userid+'/',
			param,
			function(data) {
							
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#region_entity").html(data);
					}
			}
		);
	}

	function editloadGeography() {
		$(".entity-geography").css('display', 'block');
		//var region_id = $("#region_load").val();
		var edit_userid =  url_segment[4];
		var param = {};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/editloadGeography/'+edit_userid+'/',
			param,
			function(data) {
							
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#region_geography").html(data);
					}
			}
		);
	}
	function editloadCountry(regionid) {
		var region_id = $("#region_load").val();
		var edit_userid =  url_segment[4];
		var param =	{'regionid':regionid,'uid':edit_userid};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/editloadCountrys/',
			param,
			function(data) {										
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#country_load").html(data);
						var country_id = $("#country_load").val();
						editloadState(country_id);
					}
			}
		);
	}

	function editloadState(country_id) {
		var edit_userid =  url_segment[4];
		var country_id = $("#country_load").val();
		var param = {'country_id':country_id,'uid':edit_userid};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/editloadStates/',
			param,
			function(data) {		
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#state_load").html(data);
						var state_id = $("#state_load").val();
						editloadLocation(state_id);
					}
			}
		);
	}
	
	function editloadLocation(state_id) {
		var edit_userid =  url_segment[4];
		var state_id = $("#state_load").val();
		param = {'state_id':state_id,'uid':edit_userid};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/editloadLocations/',
			param,
			function(data) {
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#location_load").html(data);
					}
			}
		);
	}
	
$('.checkUser').hide();
    $('.checkUser1').hide();
    $('#email').blur(function(){
        if( $('#email').val().length >= 3 )
            {
              var username = $('#email').val();
			  var email1 = $('#email_1').val();
			  if (email1=='undefined') {
				getResult(username);
			  }
			  else {
				getResult(username, email1); 
				}
            }
        return false;
    });
	
    function getResult(name, email1) {
        var baseurl = $('.hiddenUrl').val();
		$.ajax({
			type: 'POST',
            url : baseurl + 'user/getUserResult/',
            data: 'email='+name+'&email1='+email1+'&'+csrf_token_name+'='+csrf_hash_token,
            success : function(response){
                $('.checkUser').hide();
                if(response == 'userOk') {	
					$('.checkUser').show(); 
					$('.checkUser1').hide(); 
					$("#checkemail").removeAttr("disabled");
				} else { 
					$('.checkUser').hide(); 
					$('.checkUser1').show();
					$("#checkemail").attr("disabled", "disabled");
				}
            }
        });
	}
	/*
	 Levels and region setting functions starts
	*/
	function loadRegion() {
		$(".region-box").css('display', 'block');
		var param = {};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/loadRegions/',
			param,
			function(data) {
							
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#region_load").html(data);
					}
			}
		);
	}

	function load_entity() {
		$(".region-box").css('display', 'block');
		var param = {};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/get_sales_divisions/',
			param,
			function(data) {
							
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#region_entity").html(data);
					}
			}
		);
	}

	function load_geographys() {
		$(".region-box").css('display', 'block');
		var param = {};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/get_geographys/',
			param,
			function(data) {
							
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#region_geography").html(data);
					}
			}
		);
	}
	function loadCountry() {
		var region_id = $("#region_load").val();
		var param =	{'region_id':region_id};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/loadCountrys/',
			param,
			function(data) {										
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#country_load").html(data);
					}
			}
		);
	}
	function loadState() {
		var country_id 		   = $("#country_load").val();
		var param 			   = {'country_id':country_id};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/loadStates/',
			param,
			function(data) {		
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#state_load").html(data);
					}
			}
		);
	}
	function loadLocation() {
		var state_id = $("#state_load").val();
		var param = {'state_id':state_id};
		param[csrf_token_name] = csrf_hash_token;
		$.post( 
			'user/loadLocations/',
			param,
			function(data) {
					if (data.error) 
					{
						alert(data.errormsg);
					} 
					else 
					{
						$("select#location_load").html(data);
					}
			}
		);
	}
	
	$('#level_id').change(function() {	
		var ff = url_segment[3];
		if(ff != undefined) {
			var success = confirm('Are you sure you want to Change Level? \nThis will make impact on the leads, where this user is assigned to.');
			if(success) {
				var level_assign_mail = $('#level_id').val();
				$('#level_change_mail').val(level_assign_mail);
				if($("#level_id").val() == 1) {
					$(".level-message").html("Your level has set to Global");
					$(".level-message").css('display', 'block');
					$('.container-region').hide();	
					$(".entity-box").css('display', 'none');
					$(".geography-box").css('display', 'none');		
					$(".region-box").css('display', 'none');
					$(".country-box").css('display', 'none');	
					$(".state-box").css('display', 'none');
					$(".location-box").css('display', 'none');
				}
				else if($("#level_id").val() == 2) {
					loadRegion();		
					load_entity();
					load_geographys();
					$(".level-message").css('display', 'none');
					$(".country-box").css('display', 'none');	
					$(".state-box").css('display', 'none');
					$(".location-box").css('display', 'none');
					$('.container-region').show();
					$('.select-region').show();
					$('.select-entity').show();
					$('.select-geography').show();
					$('.select-country').hide();
					$('.select-state').hide();			
					$('.select-location').hide();	
				}
				else if($("#level_id").val() == 3) {
					var region_id = $("#region_load").val();
					if(region_id != 0) {
						var region_id = '';
					}
					$(".container-region option:selected").removeAttr("selected");
					$('#country_load option').empty();
					//document.write("<option value=''>Select</option>");
					loadRegion();
					load_entity();
					load_geographys();
					$(".level-message").css('display', 'none');
					$(".entity-box").css('display', 'block');
					$(".geography-box").css('display', 'block');		
					$(".region-box").css('display', 'block');
					$(".country-box").css('display', 'block');	
					$(".state-box").css('display', 'none');
					$(".location-box").css('display', 'none');
					$('.container-region').show();
					$('.select-entity').show();
					$('.select-geography').show();
					$('.select-region').show();
					$('.select-country').show();
					$('.select-state').hide();			
					$('.select-location').hide();			
				}
				else if($("#level_id").val() == 4) {
					$(".container-region option:selected").removeAttr("selected");
					$('#country_load option').empty();
					$('#state_load option').empty();
					$(".level-message").css('display', 'none');
					$(".entity-box").css('display', 'block');
					$(".geography-box").css('display', 'block');
					$(".region-box").css('display', 'block');
					$(".country-box").css('display', 'block');	
					$(".state-box").css('display', 'block');
					$(".location-box").css('display', 'none');
					$('.container-region').show();
					$('.select-entity').show();
					$('.select-geography').show();
					$('.select-region').show();
					$('.select-country').show();
					$('.select-state').show();
					$('.select-location').hide();
					loadRegion();
					load_entity();
					load_geographys();
				}
				else if($("#level_id").val() == 5) {
					$(".container-region option:selected").removeAttr("selected");
					$('#country_load option').empty();
					$('#state_load option').empty();
					$('#location_load option').empty();			
					$(".level-message").css('display', 'none');
					$(".entity-box").css('display', 'block');
					$(".geography-box").css('display', 'block');
					$(".region-box").css('display', 'block');
					$(".country-box").css('display', 'block');	
					$(".state-box").css('display', 'block');		
					$(".location-box").css('display', 'block');
					$('.container-region').show();
					$('.select-entity').show();
					$('.select-geography').show();
					$('.select-region').show();
					$('.select-country').show();
					$('.select-state').show();
					$('.select-location').show();
					loadRegion();
					load_entity();
					load_geographys();
				}
			} else {
				location.reload(true);
			}
		} else {
			var level_assign_mail = $('#level_id').val();
				//alert(level_assign_mail);
				$('#level_change_mail').val(level_assign_mail);
				if($("#level_id").val() == 1) {
					$(".level-message").html("Your level has set to Global");
					$(".level-message").css('display', 'block');
					$('.container-region').hide();			
					$(".entity-box").css('display', 'none');
					$(".geography-box").css('display', 'none');
					$(".region-box").css('display', 'none');
					$(".country-box").css('display', 'none');	
					$(".state-box").css('display', 'none');
					$(".location-box").css('display', 'none');
				}
				else if($("#level_id").val() == 2) {
					loadRegion();	
					load_entity();
					load_geographys();	
					$(".level-message").css('display', 'none');
					$(".country-box").css('display', 'none');	
					$(".state-box").css('display', 'none');
					$(".location-box").css('display', 'none');
					$('.select-entity').show();
					$('.select-geography').show();
					$('.container-region').show();
					$('.select-region').show();
					$('.select-country').hide();
					$('.select-state').hide();			
					$('.select-location').hide();	
				}
				else if($("#level_id").val() == 3) {
					var region_id = $("#region_load").val();
					if(region_id != 0) {
						var region_id = '';
					}
					$(".container-region option:selected").removeAttr("selected");
					$('#country_load option').empty();
					loadRegion();
					load_entity();
					load_geographys();
					$(".level-message").css('display', 'none');
					$(".entity-box").css('display', 'block');
					$(".geography-box").css('display', 'block');
					$(".region-box").css('display', 'block');
					$(".country-box").css('display', 'block');	
					$(".state-box").css('display', 'none');
					$(".location-box").css('display', 'none');
					$('.select-entity').show();
					$('.select-geography').show();
					$('.container-region').show();
					$('.select-region').show();
					$('.select-country').show();
					$('.select-state').hide();			
					$('.select-location').hide();			
				}
				else if($("#level_id").val() == 4) {
					$(".container-region option:selected").removeAttr("selected");
					$('#country_load option').empty();
					$('#state_load option').empty();
					$(".level-message").css('display', 'none');
					$(".entity-box").css('display', 'block');
					$(".geography-box").css('display', 'block');
					$(".region-box").css('display', 'block');
					$(".country-box").css('display', 'block');	
					$(".state-box").css('display', 'block');
					$(".location-box").css('display', 'none');
					$('.container-region').show();
					$('.select-entity').show();
					$('.select-geography').show();
					$('.select-region').show();
					$('.select-country').show();
					$('.select-state').show();
					$('.select-location').hide();
					loadRegion();
					load_entity();
					load_geographys();
				}
				else if($("#level_id").val() == 5) {
					$(".container-region option:selected").removeAttr("selected");
					$('#country_load option').empty();
					$('#state_load option').empty();
					$('#location_load option').empty();			
					$(".level-message").css('display', 'none');
					$(".entity-box").css('display', 'block');
					$(".geography-box").css('display', 'block');
					$(".region-box").css('display', 'block');
					$(".country-box").css('display', 'block');	
					$(".state-box").css('display', 'block');		
					$(".location-box").css('display', 'block');
					$('.container-region').show();
					$('.select-entity').show();
					$('.select-geography').show();
					$('.select-region').show();
					$('.select-country').show();
					$('.select-state').show();
					$('.select-location').show();
					loadRegion();
					load_entity();
					load_geographys();
				}
		}	
	});
	$('#region_load').change(function() {
		loadCountry();
	});
	$('#country_load').change(function() {
		var cid = $('#country_load option:selected').val();  
		loadState();
	});
	$('#state_load').change(function() {
		loadLocation();
	});
	/**
	 * BU implementation
	 */
	
	$("#business_unit_id").change(function() {
		business_unit_id = $('#business_unit_id').val();
		if(business_unit_id){
			$.ajax({
				type: 'POST',
				url: 'user/getDepartmentByBU',
				data: 'business_unit_id='+business_unit_id+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){
					$('#department_id').html('<option value="">Please Select</option>'+data);
					$('#department_id').val($("#department_id_get").val());
					$('#practice_id').html('<option value="">Please Select</option>');
					$('#skill_id').html('<option value="">Please Select</option>');
					if(url_segment[3] == 'update'){
							$("#department_id").trigger('change');
					}
				}			
			});
		}
	});
	$("#department_id").change(function() {
		department_id = $('#department_id').val();
	  business_unit_id = $('#business_unit_id').val();
		if(department_id && business_unit_id){
			$.ajax({
				type: 'POST',
				url: 'user/getPracticeByBUandDept',
				data: 'department_id='+department_id+'&business_unit_id='+business_unit_id+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){
					$('#practice_id').html('<option value="">Please Select</option>'+data);
					$('#practice_id').val($("#practice_id_get").val());
					$('#skill_id').html('<option value="">Please Select</option>');
					if(url_segment[3] == 'update'){
							$("#practice_id").trigger('change');
					}
				}			
			});
		}
	});
	$("#practice_id").change(function() {
	  department_id = $('#department_id').val();
	  business_unit_id = $('#business_unit_id').val();
	  practice_id = $('#practice_id').val();
		if(department_id && business_unit_id && practice_id){
			$.ajax({
				type: 'POST',
				url: 'user/getSkillByBUandDeptandPrac',
				data: 'department_id='+department_id+'&business_unit_id='+business_unit_id+'&practice_id='+practice_id+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){
					$('#skill_id').html('<option value="">Please Select</option>'+data);
					$('#skill_id').val($("#skill_id_get").val());
					if(url_segment[3] == 'update' && $('#auth-ldap').is(":checked")){
						$('#business_unit_id').prop('disabled',true);
						$('#department_id').prop('disabled',true);
						$('#practice_id').prop('disabled',true);
						$('#skill_id').prop('disabled',true);
					}
				}			
			});
		}
	});
	if(url_segment[3] == 'update'){
			$("#business_unit_id").trigger('change');
	}

});	



////////////////////////////////////////////////////////////////


	if(url_segment[3] == 'update') {

		function last() {
			var varLevelid=$('#level_id').val();
			if (varLevelid == ''){
				document.getElementById("frm").submit();
				return false;
			}
			if(varLevelid == 2) {
				var region_entity = $('#region_entity').val();	
				var region_geography = $('#region_geography').val();
				var region_load = $('#region_load').val();
					
				if(region_entity == null) {
					alert('Please select entity');
					return false;
				}else if(region_geography == null) {
					alert('Please select geography');
					return false;
				} else if(region_load == null) {
					alert('Please select region');
					return false;
				} else {
					document.getElementById("frm").submit();
				}			
			} else if(varLevelid == 1) {
			$(".level-message").html("Your level has set to Global");
			document.getElementById("frm").submit();
			}else if(varLevelid == 3) {
			var region_entity = $('#region_entity').val();	
			var region_geography = $('#region_geography').val();	
			var region_load = $('#region_load').val();
			var country_load = $('#country_load').val();		

			if(region_entity == null) {
				alert('Please select entity');
				return false;
			}else if(region_geography == null) {
				alert('Please select geography');
				return false;
			} else if(region_load == null) {
				alert('Please select region');
				return false;
			} else if(country_load == null) {
				alert('Please select country');
				return false;
			}	
			$.ajax({
				type: 'POST',
				url: 'user/checkcountry',
				dataType:'json',
				data: 'region_load='+region_load+'&country_load='+country_load+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){		
					if(data.msg == 'noans'){
						alert('Please select corresponding country');
						return false;
					} else if(data.msg == 'success'){
						document.getElementById("frm").submit();
					}
					
				}			
			});
			} else if(varLevelid == 4) {
			var region_entity = $('#region_entity').val();	
			var region_geography = $('#region_geography').val();	 
			var region_load = $('#region_load').val();
			var country_load = $('#country_load').val();
			var state_load = $('#state_load').val();

			if(region_entity == null) {
				alert('Please select entity');
				return false;
			}else if(region_geography == null) {
				alert('Please select geography');
				return false;
			} else if(region_load == null) {
				alert('Please select region');
				return false;
			} else if(country_load == null) {
				alert('Please select country');
				return false;
			}else if(state_load == null) {
				alert('Please select state');
				return false;
			}
			$.ajax({
				type: 'POST',
				url: 'user/checkstate',
				dataType:'json',
				data: 'region_load='+region_load+'&country_load='+country_load+'&state_load='+state_load+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){		
					if(data.countrymsg == 'noans' || data.statemsg == 'nostate'){
						alert('Please select corresponding country/state');
						return false;
					} else if(data.countrymsg == 'success' && data.statemsg == 'success' ){
						document.getElementById("frm").submit();
					}
					
				}			
			});
			} else if(varLevelid == 5) {
			var region_entity = $('#region_entity').val();	
			var region_geography = $('#region_geography').val();	
			var region_load   = $('#region_load').val();
			var country_load  = $('#country_load').val();
			var state_load    = $('#state_load').val();
			var location_load = $('#location_load').val();
			if(region_entity == null) {
				alert('Please select entity');
				return false;
			}else if(region_geography == null) {
				alert('Please select geography');
				return false;
			} else	if(region_load == null) {
				alert('Please select region');
				return false;
			} else if(country_load == null) {
				alert('Please select country');
				return false;
			}else if(state_load == null) {
				alert('Please select state');
				return false;
			}else if(location_load == null) {
				alert('Please select location');
				return false;
			}
			$.ajax({
				type: 'POST',
				url: 'user/checklocation',
				dataType:'json',
				data: 'region_load='+region_load+'&country_load='+country_load+'&state_load='+state_load+'&location_load='+location_load+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){		
					if(data.countrymsg == 'noans' || data.statemsg == 'nostate'|| data.locationmsg == 'noloc'){
						alert('Please select corresponding country/state/location');
						return false;
					} else if(data.countrymsg == 'success' && data.statemsg == 'success' && data.locationmsg == 'success' ){
						document.getElementById("frm").submit();
					}
					
				}			
			});
			}
			return false;
		}
   }


$('#username').blur(function() {
	if(url_segment[3]=='update'){
		var updatedata = url_segment[4];
	} else {
		var updatedata = 'noupdate';
	}
	$('div#errorun.error').hide();
	var username = $('#username').val();
	if(username=='') {
		return false;
	}
	$.ajax({
		type: 'POST',
		url : site_base_url + 'user/checkUniqueUsername/',
		data: 'username='+username+'&'+'updatedata='+updatedata+'&'+csrf_token_name+'='+csrf_hash_token,
		success: function(response){
			$('#username_errmsg').empty();
			if(response == 'userOk') {
				$('#username_errmsg').html('<span class="ajx_success_msg">Username available.</span>');
				$("#checkemail").removeAttr("disabled");
			} else {
				$('#username_errmsg').html('<span class="ajx_failure_msg">Username already exists.</span>');
				$("#checkemail").attr("disabled", "disabled");
			}
		}
	});
	return false;
}); 

function checkAddUser()
{
	// alert('test');
	var is_error = false;
	
	var varFirstname = $('#first_name').val();
	if(varFirstname.trim() == "") {
		is_error = true;
		$('div#error12.error').show();
	} else {
		$('div#error12.error').hide();
	}
	
	var varLastname = $('#last_name').val();
	if(varLastname.trim() == "") {
		is_error = true;
		$('div#error2.error').show();
	} else {
		$('div#error2.error').hide();
	}
	
	var varusername = $('#username').val();
	if(varusername.trim() == "") {
		is_error = true;
		$('div#errorun.error').show();
	} else {
		$('div#errorun.error').hide();
	}
	
	if($('#business_unit_id').val() == "") {
		is_error = true;
		$('div#business_unit_id_err.error').show();
	} else {
		$('div#business_unit_id_err.error').hide();
	}
	
	if($('#department_id').val() == "") {
		is_error = true;
		$('div#department_id_err.error').show();
	} else {
		$('div#department_id_err.error').hide();
	}
	
	if($('#practice_id').val() == "") {
		is_error = true;
		$('div#practice_id_err.error').show();
	} else {
		$('div#practice_id_err.error').hide();
	}
	
	if($('#skill_id').val() == "") {
		is_error = true;
		$('div#skill_id_err.error').show();
	} else {
		$('div#skill_id_err.error').hide();
	}
	
	var varRoleid = $('#role_id').val();
	if(varRoleid == "") {
		is_error = true;
		$('div#error3.error').show();
	} else {
		$('div#error3.error').hide();
	}
	
	if(varRoleid == "14") {
		if($('#contract_manager').val() == "") {
			is_error = true;
			$('div#error_contractmanager.error').show();
		} else {
			$('div#error_contractmanager.error').hide();
		}
	}
	
	var varEmail 	= $('#email').val();		
	var atpos		= varEmail.indexOf("@");
	var dotpos		= varEmail.lastIndexOf(".");
	if(varEmail == "") {
		is_error = true;
		$('span#error4.error').show();
		$('span#notvalid.error').hide();
		$('span.checkUser').hide();
	} else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=varEmail.length) {
		is_error = true;
		$('span#notvalid.error').show();
		$('span#error4.error').hide();
		$('span.checkUser').hide();	  
	} else {
		$('span.checkUser').show();
		$('span#error4.error').hide();
		$('span#notvalid.error').hide();
	}
	
	var varPassword = $('#password').val();
	if(varPassword.trim() == "") {
		is_error = true;
		$('div#error5.error').show();
	} else if(varPassword.length < 6 ) {
		is_error = true;
		alert('Password should be 6 characters');
	} else {
		$('div#error5.error').hide();
	}
	
	var varLevelid = $('#level_id').val();
	if(varLevelid == "") {
		is_error = true;
		$('div#error6.error').show();
	} else {
		$('div#error6.error').hide();
	}
	// alert(varLevelid);
	/*condition for checking the levels*/
	if(varLevelid == 1) {
		$(".level-message").html("Your level has set to Global");
	} else if(varLevelid == 2) {
		var region_entity = $('#region_entity').val();
		var region_geography = $('#region_geography').val();
		var region_load = $('#region_load').val();
		
		if(region_entity == null) {
			is_error = true;
			alert('Please select entity');
		}
		else if(region_geography == null) {
			is_error = true;
			alert('Please select geography');
		}
		else if(region_load == null) {
			is_error = true;
			alert('Please select region');
		}
	} else if(varLevelid == 3) {
		var region_entity = $('#region_entity').val();
		var region_geography = $('#region_geography').val();
		var region_load  = $('#region_load').val();
		var country_load = $('#country_load').val();
		
		if(region_entity == null) {
			is_error = true;
			alert('Please select entity');
		}
		else if(region_geography == null) {
			is_error = true;
			alert('Please select geography');
		}
		else if(region_load == null) {
			is_error = true;
			alert('Please select region');
		} else if(country_load == null) {
			is_error = true;
			alert('Please select country');
		}
		$.ajax({
			type: 'POST',
			url: 'user/checkcountry',
			dataType:'json',
			data: 'region_load='+region_load+'&country_load='+country_load+'&'+csrf_token_name+'='+csrf_hash_token,
			success:function(data){		
				if(data.msg == 'noans') {
					is_error = true;
					alert('Please select corresponding country');
				}
			}			
		});
	} else if(varLevelid == 4) {
		var region_entity = $('#region_entity').val();
		var region_geography = $('#region_geography').val();
		var region_load 	= $('#region_load').val();
		var country_load 	= $('#country_load').val();
		var state_load 		= $('#state_load').val();	
		
		if(region_entity == null) {
			is_error = true;
			alert('Please select entity');
		}
		else if(region_geography == null) {
			is_error = true;
			alert('Please select geography');
		}
		else if(region_load == null) {
			is_error = true;
			alert('Please select region');
		} else if(country_load == null) {
			is_error = true;
			alert('Please select country');
		} else if(state_load == null) {
			is_error = true;
			alert('Please select state');
		}
		$.ajax({
			type: 'POST',
			url: 'user/checkstate',
			dataType:'json',
			data: 'region_load='+region_load+'&country_load='+country_load+'&state_load='+state_load+'&'+csrf_token_name+'='+csrf_hash_token,
			success:function(data){		
				if(data.countrymsg == 'noans' || data.statemsg == 'nostate') {
					is_error = true;
					alert('Please select corresponding Country / State');
				}
			}			
		});
	} else if(varLevelid == 5) {
		var region_entity = $('#region_entity').val();
		var region_geography = $('#region_geography').val();
		var region_load 	= $('#region_load').val();
		var country_load 	= $('#country_load').val();
		var state_load 		= $('#state_load').val();
		var location_load 	= $('#location_load').val();

		if(region_entity == null) {
			is_error = true;
			alert('Please select entity');
		}
		else if(region_geography == null) {
			is_error = true;
			alert('Please select geography');
		}
		else if(region_load == null) {
			is_error = true;
			alert('Please select region');
		} else if(country_load == null) {
			is_error = true;
			alert('Please select country');
		} else if(state_load == null) {
			is_error = true;
			alert('Please select state');
		} else if(location_load == null) {
			is_error = true;
			alert('Please select location');
		}
		$.ajax({
			type: 'POST',
			url: 'user/checklocation',
			dataType:'json',
			data: 'region_load='+region_load+'&country_load='+country_load+'&state_load='+state_load+'&location_load='+location_load+'&'+csrf_token_name+'='+csrf_hash_token,
			success:function(data){		
				if(data.countrymsg == 'noans' || data.statemsg == 'nostate'|| data.locationmsg == 'noloc'){
					is_error = true;
					alert('Please select corresponding country/state/location');
				}
			}			
		});
	}
	
	if(is_error == true) {
		return false;
	} else {
		return true;
	}
}	
