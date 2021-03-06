/*
 *@lead confirmation view Practice
 *@Welcome Controller
*/

// csrf_token_name,csrf_hash_token,site_base_url & accesspageis global js variable
$('.del_file').hide();
$("#tabs ul li a").each(function() {
	$(this).attr("href", location.href.toString()+$(this).attr("href"));
	});
$( "#tabs" ).tabs();
$(function() {
	
	$('#succes_err_msg').empty();
	$('#ui-datepicker-div').addClass('blockMsg');
	
	/* $('#date_start').datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		onSelect: function(date) {
			if($('#date_due').val!='')
			{
				$('#date_due').val('');
			}
			var return_date = $('#date_start').val();
			$('#date_due').datepicker("option", "minDate", return_date);
		},
		beforeShow: function(input, inst) {
			if ((selDate = $(this).val()).length > 0) 
			{
				iYear = selDate.substring(selDate.length - 4, selDate.length);
				iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
				$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
			}
			$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
		}
	});
	$('#date_due').datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true }); */
	
	$('#date_start').datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, onSelect: function(date) {
		if($('#date_due').val!='')
		{
			$('#date_due').val('');
		}
		var return_date = $('#date_start').val();
		console.log(return_date);
		$('#date_due').datepicker("option", "minDate", return_date);
	}});
	$('#date_due').datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });
	
	if(project_category == 1) {
		$('#project_center_tr').show();
		$('#cost_center_tr').hide();
	} else if(project_category == 2) {
		$('#cost_center_tr').show();
		$('#project_center_tr').hide();
	} else {
		$('#cost_center_tr').hide();
		$('#project_center_tr').hide();
	}
	
	datefield_datepicker();
	monthyear_datepicker();

	/**
	 * BU implementation
	 */
	
	$("#business_unit_id_pop").change(function() {
		business_unit_id = $('#business_unit_id_pop').val();
		if(business_unit_id){
			$.ajax({
				type: 'POST',
				url: 'user/getDepartmentByBU',
				data: 'business_unit_id='+business_unit_id+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){
					$('#department_id_fk_pop').html('<option value="">Please Select</option>'+data);
					$('#practice_pop').html('<option value="">Please Select</option>');
				}			
			});
		}
	});
	$("#department_id_fk_pop").change(function() {
		department_id = $('#department_id_fk_pop').val();
	  business_unit_id = $('#business_unit_id_pop').val();
		if(department_id && business_unit_id){
			$.ajax({
				type: 'POST',
				url: 'user/getPracticeByBUandDept',
				data: 'department_id='+department_id+'&business_unit_id='+business_unit_id+'&'+csrf_token_name+'='+csrf_hash_token,
				success:function(data){
					$('#practice_pop').html('<option value="">Please Select</option>'+data);
					$('#practice_pop').val($("#practice_hide").val());
				}			
			});
		}
	});
	
});

$("#business_unit_id_pop").trigger('change');

var updt = '';

if(document.getElementById('region_update')) {
	var reg = document.getElementById('region_update').value;

	if (document.getElementById('country_update'))
	var cty = document.getElementById('country_update').value;
	if(cty == 15){
		$(".stno").hide();
		$(".county").hide();
		$(".suburb").hide();
		$(".bill_building").hide();
		$(".bill_block").show();
		$(".state").show();
		$(".city").show();
		$(".bill_gsttype").show();
		$(".gstn").show();
		$(".bill_federal_tax").hide();
	}else if(cty == 18){
		
			$(".bill_block").hide();
			$(".stno").hide();
			$(".suburb").hide();
			$(".county").hide();
			$(".bill_building").hide();	
			$(".state").show();
			$(".city").show();	
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").hide();
	}else if(cty == 17){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".state").show();
			$(".city").show();
			$(".bill_block").show();
			$(".bill_building").show();
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").hide();
	}else if(cty == 16){
			$(".stno").hide();
			$(".county").hide();
			$(".state").show();
			$(".suburb").hide();
			$(".city").show();
			$(".bill_block").show();
			$(".bill_building").show();
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").hide();
	}else if(cty == 23){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".bill_building").hide();
			$(".bill_block").show();
			$(".state").show();
			$(".city").show();
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").show();
	}else{
		$(".stno").show();
		$(".county").show();
		$(".suburb").hide();
		$(".bill_building").show();
		$(".bill_block").show();
		$(".state").show();
		$(".city").show();
		$(".bill_gsttype").show();
		$(".gstn").show();
		$(".bill_federal_tax").hide();
	}
	
	if (document.getElementById('state_update'))
	var st = document.getElementById('state_update').value;

	if (document.getElementById('location_update'))
	var loc = document.getElementById('location_update').value;

	if (document.getElementById('entity_update'))
	var enty = document.getElementById('entity_update').value;

	if (document.getElementById('expect_worth_id'))
	var expect_worth_id = document.getElementById('expect_worth_id').value;

	if (document.getElementById('shipping_update'))
	var ship = document.getElementById('shipping_update').value;

	if (document.getElementById('shipping_country'))
	var ship_country = document.getElementById('shipping_country').value;

	if (document.getElementById('shipping_location'))
	var shipping_location = document.getElementById('shipping_location').value;
	
	if(ship_country == 15){
		$(".stno_ship").hide();
		$(".county_ship").hide();
		$(".suburb_ship").hide();
		$(".building_ship").hide();
		$(".block_ship").show();
		$(".state_ship").show();
		$(".city_ship").show();
		$(".gsttype_ship").show();
		$(".gstn_ship").show();
		$(".federal_tax_ship").hide();
	}else if(ship_country == 18){
		
			$(".block_ship").hide();
			$(".stno_ship").hide();
			$(".suburb_ship").hide();
			$(".county_ship").hide();
			$(".building_ship").hide();	
			$(".state_ship").show();
			$(".city_ship").show();	
			$(".gsttype_ship").hide();
			$(".gstn_ship").hide();
			$(".federal_tax_ship").hide();
	}else if(ship_country == 17){
			$(".stno_ship").hide();
			$(".county_ship").hide();
			$(".suburb_ship").hide();
			$(".state_ship").show();
			$(".city_ship").show();
			$(".block_ship").show();
			$(".building_ship").show();
			$(".gsttype_ship").hide();
			$(".gstn_ship").hide();
			$(".federal_tax_ship").hide();
	}else if(ship_country == 16){
			$(".stno_ship").hide();
			$(".county_ship").hide();
			$(".state_ship").show();
			$(".suburb_ship").hide();
			$(".city_ship").show();
			$(".block_ship").show();
			$(".building_ship").show();
			$(".gsttype_ship").hide();
			$(".gstn_ship").hide();
			$(".federal_tax_ship").hide();
	}else if(ship_country == 23){
			$(".stno_ship").hide();
			$(".county_ship").hide();
			$(".suburb_ship").hide();
			$(".building_ship").hide();
			$(".block_ship").show();
			$(".state_ship").show();
			$(".city_ship").show();
			$(".gsttype_ship").hide();
			$(".gstn_ship").hide();
			$(".federal_tax_ship").show();
	}else{
		$(".stno_ship").show();
		$(".county_ship").show();
		$(".suburb_ship").hide();
		$(".building_ship").show();
		$(".block_ship").show();
		$(".state_ship").show();
		$(".city_ship").show();
		$(".gsttype_ship").show();
		$(".gstn_ship").show();
		$(".federal_tax_ship").hide();
	}

	if (document.getElementById('shipping_region'))
	var ship_region = document.getElementById('shipping_region').value;

	if (document.getElementById('shipping_state'))
	var ship_state = document.getElementById('shipping_state').value;

	if (document.getElementById('billing_update'))
	var bill = document.getElementById('billing_update').value;

	if (document.getElementById('expect_worth_name'))
	var expect_worth_name = document.getElementById('expect_worth_name').value;

	if (document.getElementById('group_update'))
	var group = document.getElementById('group_update').value;
	

	if (document.getElementById('currencies'))
	var currency = document.getElementById('currencies').value;

	if (document.getElementById('entity_address'))
	var entity_address = document.getElementById('entity_address').value;
		

	updt = 'updt';

	if(reg != 0 && cty != 0)
	getCountry(reg,cty,updt);

	if(cty != 0 && st != 0)
	getState(cty,st,updt,cty);

	if(st != 0 && loc != 0)
	getLocation(st,loc,updt);

	if(enty != 0)
	getCurrency(enty,currency,group,entity_address,updt);

	if(expect_worth_id!=0)
	getCurrency_lead(enty,expect_worth_id,updt);

	// if(expect_worth_id!=0)
	// getCurrency_lead_milestone(enty,expect_worth_id,updt);
	
	if(ship_region!=0)
	getCountry_ship(ship_region,ship_country);

	if(ship_country!=0)
	getState_ship(ship_country,ship_state);

	if(ship_state!=0)
	getLocation_ship(ship_state,shipping_location);

	if(cty != 0)
	get_cus_state(cty,st,updt);

	// if(ship != 0)
	// getshipval(ship,enty);

	// if(bill != 0)
	// getbillval(bill,enty);

	
}
function getCurrency_lead(enty,expect_worth_id,updt) {
    var sturl = site_base_url+"regionsettings/getCurrency_lead_move_project/"+ enty+"/"+expect_worth_id+"/"+updt;
	$('#currency_row_project').load(sturl);	
}	

// function getCurrency_lead_milestone(enty,expect_worth_id,updt) {
//     var sturl = site_base_url+"regionsettings/getCurrency_lead/"+ enty+"/"+expect_worth_id+"/"+updt;
// 	$('#currency_row_project_milestone').load(sturl);	
// }	
function getCountry(val,id,updt) {
	var sturl = site_base_url+"regionsettings/getCountry/"+ val+"/"+id+"/"+updt;	
	//alert("SDfds");
	if(id == 15){
		$(".stno").hide();
		$(".county").hide();
		$(".suburb").hide();
		$(".bill_building").hide();
		$(".bill_block").show();
		$(".state").show();
		$(".city").show();
		$(".bill_gsttype").show();
		$(".gstn").show();
		$(".bill_federal_tax").hide();
	}else if(id == 18){
		
			$(".bill_block").hide();
			$(".stno").hide();
			$(".suburb").hide();
			$(".county").hide();
			$(".bill_building").hide();	
			$(".state").show();
			$(".city").show();	
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").hide();
	}else if(id == 17){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".state").show();
			$(".city").show();
			$(".bill_block").show();
			$(".bill_building").show();
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").hide();
	}else if(id == 16){
			$(".stno").hide();
			$(".county").hide();
			$(".state").show();
			$(".suburb").hide();
			$(".city").show();
			$(".bill_block").show();
			$(".bill_building").show();
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").hide();
	}else if(id == 23){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".bill_building").hide();
			$(".bill_block").show();
			$(".state").show();
			$(".city").show();
			$(".bill_gsttype").hide();
			$(".gstn").hide();
			$(".bill_federal_tax").show();
	}else{
		$(".stno").show();
		$(".county").show();
		$(".suburb").hide();
		$(".bill_building").show();
		$(".bill_block").show();
		$(".state").show();
		$(".city").show();
		$(".bill_gsttype").show();
		$(".gstn").show();
		$(".bill_federal_tax").hide();
	}	
	//$('#country_row').load(sturl);	
	$('#country_row').load(sturl, function(data){
		$('select').on('change', function() {  
			$("#selectchanges").val(1);
		});	
    });
    return false;	
}

function get_cus_state(val,st,updt){

	var sturl = site_base_url+"regionsettings/get_cus_state/"+ val+"/"+st+"/"+updt;	
	//alert("SDfds");
    $('#state1_row').load(sturl);	
    return false;

}

function getCurrency(val,currency,group,entity_address,updt){
	
	var sturl = site_base_url+"regionsettings/getCurrency/"+ val+"/"+updt+"/"+currency;	
	var sturl_group = site_base_url+"regionsettings/getEntityGroup/"+ val+"/"+updt+"/"+group;
	var sturl_address = site_base_url+"regionsettings/getEntityAddress/"+ val+"/"+updt+"/"+entity_address;	
	var sturl = site_base_url+"regionsettings/getCurrency_Lead/"+ val+"/"+updt;	
	$('#currency_row').load(sturl);
	$('#division').val(val);
	//alert("SDfds");
	if(val == 1){
		$(".pan").show();
		$(".registered").show();
	}else if(val == 4){
		$(".pan").hide();
		$(".registered").hide();
	}else if(val == 2){
		$(".pan").hide();
		$(".registered").hide();
	}else if(val == 3){
		$(".pan").hide();
		$(".registered").hide();
	}else if(val == 7){
		$(".pan").hide();
		$(".registered").hide();
	}else{
		$(".pan").show();
		$(".registered").show();
	}
	$('#currency_row').load(sturl);	
	$('#group_row').load(sturl_group);
	$('#entity_address_row').load(sturl_address);
    return false;

}
function getState(val,id,updt,cty) {
	
	var sturl = site_base_url+"regionsettings/getState/"+ val+"/"+id+"/"+updt;	
	$('#state_row').load(sturl,function(data){		
	var country = $("#add1_country").val();
	
				if(val == 15){
					$(".stno").hide();
					$(".county").hide();
					$(".suburb").hide();
					$(".bill_building").hide();
					$(".bill_block").show();
					$(".state").show();
					$(".city").show();
					$(".bill_gsttype").show();
					$(".gstn").show();
					$(".bill_federal_tax").hide();
				}else if(val == 18){
					
						$(".bill_block").hide();
						$(".stno").hide();
						$(".suburb").hide();
						$(".county").hide();
						$(".bill_building").hide();	
						$(".state").show();
						$(".city").show();	
						$(".bill_gsttype").hide();
						$(".gstn").hide();
						$(".bill_federal_tax").hide();
				}else if(val == 17){
						$(".stno").hide();
						$(".county").hide();
						$(".suburb").hide();
						$(".state").show();
						$(".city").show();
						$(".bill_block").show();
						$(".bill_building").show();
						$(".bill_gsttype").hide();
						$(".gstn").hide();
						$(".bill_federal_tax").hide();
				}else if(val == 16){
						$(".stno").hide();
						$(".county").hide();
						$(".state").show();
						$(".suburb").hide();
						$(".city").show();
						$(".bill_block").show();
						$(".bill_building").show();
						$(".bill_gsttype").hide();
						$(".gstn").hide();
						$(".bill_federal_tax").hide();
				}else if(val == 23){
						$(".stno").hide();
						$(".county").hide();
						$(".suburb").hide();
						$(".bill_building").hide();
						$(".bill_block").show();
						$(".state").show();
						$(".city").show();
						$(".bill_gsttype").hide();
						$(".gstn").hide();
						$(".bill_federal_tax").show();
				}else{
					$(".stno").show();
					$(".county").show();
					$(".suburb").hide();
					$(".bill_building").show();
					$(".bill_block").show();
					$(".state").show();
					$(".city").show();
					$(".bill_gsttype").show();
					$(".gstn").show();
					$(".bill_federal_tax").hide();
				}	
				// if(entity == 1 && country == 15 && group==100){
				// 		if($('#gst_in').val()=="") {
				// 			$("#gstin_err").html("Gstn is Required");
				// 			empty_err = false;
				// 		}
				// 	}
					$('select').on('change', function() {  
						$("#selectchanges").val(1);
					});
				});			
    return false;	
}
function getLocation(val,id,updt) {
	var sturl = site_base_url+"regionsettings/getLocation/"+ val+"/"+id+"/"+updt;	
	//$('#location_row').load(sturl);	
	$('#location_row').load(sturl, function(data){
		$('select').on('change', function() {  
			$("#selectchanges").val(1);
		});	
	
	});	
    return false;	
}

function ajxCty(){
	$("#addcountry").slideToggle("slow");
}
function ajxSt() {
	$("#addstate").slideToggle("slow");
}
function ajxLoc() {
	$("#addLocation").slideToggle("slow");
}

function ajxSaveCty(){
	if ($('#newcountry').val() == "") {
		alert("Country Required.");
	} else {
		var regionId = $("#add1_region").val();
		var newCty = $('#newcountry').val();
		getCty(newCty, regionId);
	}	

    function getCty(newCty){
		var params = {regionid: $("#region_id").val(),country_name:$("#newcountry").val(),created_by:(customer_user_id)};
		params[csrf_token_name]      = csrf_hash_token; 

		$.ajax({
            url : site_base_url + 'customers/getCtyRes/' + newCty + "/" + regionId,
            cache : false,
            success : function(response){
                if(response == 'userOk') 
				{ 
					$.post("regionsettings/country_add_ajax",params, 
					function(info){$("#country_row").html(info);});
					$("#addcountry").hide();

					//var regId = $("#add1_region").val();
					$("#state_row").load("regionsettings/getState");
				}
                else
				{ 
					alert('Country Exists.'); 
				}
            }
        });
	}
}
function ajxSaveSt() {
	if ($('#newstate').val() == "") {
		alert("State Required.");
	} else {
		var cntyId = $("#add1_country").val()
		var newSte = $('#newstate').val();
		getSte(newSte,cntyId);
	}
		
	function getSte(newSte,cntyId) {
		var params = {countryid: $("#add1_country").val(),state_name:$("#newstate").val(),created_by:(customer_user_id)};
		params[csrf_token_name]      = csrf_hash_token; 
			
		$.ajax({
            url : site_base_url + 'customers/getSteRes/' + newSte + "/" + cntyId,
            cache : false,
            success : function(response) {
                if(response == 'userOk') 
				{
					$.post("regionsettings/state_add_ajax",params, 
					function(info){ $("#state_row").html(info); });
					$("#addstate").hide();

					$("#location_row").load("regionsettings/getLocation");
				}
                else
				{ 
					alert('State Exists.');
				}
            }
        });
	}
}

function ajxSaveLoc() {
	if ($('#newlocation').val() == "") {
		alert("Location Required.");
	} else {
		var stId   = $("#add1_state").val();
		var newLoc = $('#newlocation').val();
		getLoc(newLoc,stId);
	}
		
	function getLoc(newLoc,stId) {
		var baseurl = $('.hiddenUrl').val();
		var params = {stateid: $("#add1_state").val(),location_name:$("#newlocation").val(),created_by:(customer_user_id)};
		params[csrf_token_name]  = csrf_hash_token; 
		$.ajax({
			url : site_base_url + 'customers/getLocRes/' + newLoc + '/' +stId,
			cache : false,
			success : function(response){
				if(response == 'userOk') 
				{
					$.post("regionsettings/location_add_ajax",params, 
					function(info){ $("#location_row").html(info); });
					$("#addstate").hide();
				}
				else
				{
					alert('Location Exists.');
				}
			}
		});
	}
}


function update_client(lead_id,current_tab){
	//alert(expect_worth_name);
	
	//update_customer(lead_id,current_tab);		
}
function update_customer_project(lead_id,current_tab){
	
//	update_customer(lead_id,'');
	update_project_detail(lead_id,current_tab);
}
function update_cust_proj_users(lead_id,current_tab){
	//update_customer(lead_id,'');
	var updt = '';
		$.ajax({
			url : site_base_url + 'customers/getCurrencyid/' + lead_id ,
			cache : false,
			//cache : false,
			//type: "POST",
			dataType: 'json',
			success : function(response){
				console.log(response.currency);
				var sturl = site_base_url+"regionsettings/getCurrency_lead_milestone/"+ enty+"/"+response.currency+"/"+updt;
	   			 $('#currency_row_project_milestone').load(sturl);
				
			}
		});
		
	
	update_project_detail(lead_id,'');		
	update_project_users(current_tab)
}

//pre-populate the default region, country, state & location
/* if(usr_level >= 2 && cus_updt != 'update' ) {
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
} */
//function update_customer(id,current_tab) {
$("#customer_detail_form").submit(function(e,current_tab) {	
	var err = [];
	var entity = $('#entity').val();
	var group  = $("#group").val();
	var shipcountry = $('#ship_country').val();
	var billcountry = $('#add1_country').val();
	var registered_flag = $(".registered_flag:checked").val();
	if ($('#entity').val() == '') {
        err.push('Entity is required');
		$('#entity_err').html('Entity is required');
	}
	
	if ($('#group').val() == '0') {
        err.push('Group is required');
		$('#group_err').html('Group is required');
	}

	if(entity==1 && group ==100){ 
		if(registered_flag == undefined || registered_flag == '') {
				err.push('Select Yes / No');
			$("#registered_err").html("Select Yes / No");
		}else{
			$("#registered_err").html("");
		}
	}	
	if ($('#company').val() == '') {
        err.push('Company is required');
		$('#comp_err').html('Company is required');
	}
	
	

	// if(entity==1 && group==100){
	// 	if ($('#pan_num').val() == '') {
	// 		err.push('Website is required');
	// 		$('#pan_num_err').html('Pan Number is required');
	// 	}
	// }
	
	
	
	if ($('#add1_region').val() == '') {
        err.push('Website is required');
		$('#add1_region_err').html('Region is required');
	}
	if ($('#add1_country').val() == '') {
        err.push('Website is required');
		$('#add1_country_err').html('Country is required');
	}
	if ($('#first_name').val() == '') {
        err.push('Website is required');
		$('#first_name_err').html('First name is required');
	}
	if ($('#last_name').val() == '') {
        err.push('Website is required');
		$('#last_name_err').html('Last name is required');
	}
	
	if ($('#email_1').val() == '') {
        err.push('Website is required');
		$('#email_1_err').html('Email is required');
	}

	if (err.length > 0) {
		setTimeout('timerfadeout()', 100000);
		// $('.errmsg_confirm').html('<b>Few errors occured! Please correct them and submit again!</b><br />' + err.join('<br />'));
		// alert('Few errors occured! Please correct them and submit again!\n\n' + err.join('\n'));
        return false;
	}
	var username = $('#email_1').val();
	
	$(".errmsg").empty();
	
	var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	
	var email_err = true;
	
	if(filter.test(username)){
		
		$("#positiveBtn").removeAttr("disabled");
		$(".errmsg").html('<span class="ajx_success_msg">Valid Email</span>');
		email_err = true;
	} else {
		$(".errmsg").html('<span class="ajx_failure_msg">Invaild Email.</span>');
		$("#positiveBtn").attr("disabled", "disabled");
		email_err = false;
	} 
	if(false == email_err) {
		return false;
		}
		

	
	
//	var form_data = $('#customer_detail_form').serialize();	
	$('.blockUI .layout').block({
		message:'<h3>Processing</h3>',
		css: {background:'#666', border: '2px solid #999', padding:'8px', color:'#333'}
	});

	 e.preventDefault();
     var formData = new FormData(this);
	
	$.ajax({
		url : site_base_url + 'customers/add_customer_project',
		cache : false,
		contentType: false,
		processData: false,
		type: "POST",
		dataType: 'json',
		data:formData,
		success : function(response){
			var depart ='null'
			console.log(response);
			if(response.result=='ok') {
				var current_tab = 'tabs-milestone';
				if(current_tab){
					var cs = $('.tabs-confirm li').eq(1).find("a").attr('href');
					if(response.add == 'add'){
						var c_id= $("#cust_id").val(response.custid);
						var companyid= $("#companyid").val(response.companyid);
						var entity_val1 = response.entity_val;
						console.log('c_id');
						console.log(entity_val1);
					}else{
						var companyid= $("#cus_sap_status").val(response.sap_status);
					}
					var sturl = site_base_url+"welcome/georegion/"+response.entity_val+"/"+updt+"/"+depart;
	   			 $('#geo_region').load(sturl);
					
					var v = cs.split("#")
					if(v[1] !=current_tab)	$('.tabs-confirm li').eq(1).find("a").trigger('click');	
				}
				
			} else {
				alert("Update Failed");
			}
			$('.blockUI .layout').unblock();
		}
	});
});	
//}

$(".errmsg").empty();
// $('#emailval').keyup(function(){
// 	if( $('#emailval').val().length >= 1 )
// 	{
// 		var username = $('#emailval').val();
// 		var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
// 		if(filter.test(username)){
// 			$("#positiveBtn").removeAttr("disabled");
// 			$(".errmsg").html('<span class="ajx_success_msg">Valid Email</span>');
// 		} else {
// 			$(".errmsg").html('<span class="ajx_failure_msg">Invaild Email.</span>');
// 			$("#positiveBtn").attr("disabled", "disabled");
// 		}
// 	}
// 	return false;
// });
$('#email_1').keyup(function(){
	if( $('#email_1').val().length >= 1 )
	{
		var username = $('#email_1').val();
		var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(filter.test(username)){
			$("#positiveBtn").removeAttr("disabled");
			$(".errmsg").html('<span class="ajx_success_msg">Valid Email</span>');
		} else {
			$(".errmsg").html('<span class="ajx_failure_msg">Invaild Email.</span>');
			$("#positiveBtn").attr("disabled", "disabled");
		}
	}
	return false;
});
//function update_project_detail(project_id,current_tab) {
$("#project_detail_form").submit(function(e) {		
	var err = [];
    var current_tab = 'tabs-project';
    if ($.trim($('#department_id_fk_pop').val()) == '') {
        err.push('Department must be selected');
		$('#department_err').html('Department must be selected');
    }
	if ($.trim($('#resource_type').val()) == 'not_select') {
        err.push('Resource type must be selected');
		$('#resource_type_err').html('Resource type must be selected');
	}
	
	if ($.trim($('#practice_pop').val()) == '') {
        err.push('Practice must be selected');
		$('#practice_err').html('Practice must be selected');
    }
    if ($('#project_name').val() == '') {
        err.push('Project name is required');
		$('#project_name_err').html('Project name is required');
    }
	if ($('#timesheet_project_types').val() == 'not_select') {
        err.push('Project billing type must be selected');
		$('#timesheet_project_types_err').html('Project billing type must be selected');
	}
	if ($('#payment_terms').val() == '') {
        err.push('Project type must be selected');
		$('#payment_terms_err').html('Payment terms list must be selected');
	}
	if ($.trim($('#business_unit_id_pop').val()) == 'not_select') {
				err.push('Business Unit must be selected');
		$('#business_unit_id_err').html('Business Unit must be selected');
		}
	if ($('#contarct_po').val() == '') {
        err.push('Project type must be selected');
		$('#contarct_po_err').html('Contract Po is required');
    }
	if ($('#project_types').val() == 'not_select') {
        err.push('Project type must be selected');
		$('#project_type_err').html('Project type must be selected');
    }
	if ($("input[name=project_category]").is(":checked") == false) {
        err.push('Project category must be selected');
		$('#project_category_err').html('Project category must be selected');
    } else if ($("input[name=project_category]").is(":checked") == true && $("input[name=project_category]:checked").val() == 1 && $('#project_center_value').val() == 'not_select') {
		err.push('Project center must be selected');
		$('#project_center_value_err').html('Project center must be selected');
	} else if ($("input[name=project_category]").is(":checked") == true && $("input[name=project_category]:checked").val() == 2 && $('#cost_center_value').val() == 'not_select') {
		err.push('Cost center must be selected');
		$('#cost_center_value_err').html('Cost center must be selected');
	}	
	if ($("input[name=sow_status]").is(":checked") == false) {
        err.push('SOW status must be selected');
		$('#sow_status_err').html('SOW status must be selected');
    }
	if ($('#actual_worth_amount').val() == '') {
        err.push('SOW Value is required');
		$('#sow_value_err').html('SOW Value is required');
	}
	if ($('#expect_worth').val() == '') {
        err.push('Currency is required');
		$('#sow_currency_err').html('Currency is required');
    }
	if ($('#date_start').val() == '') {
        err.push('SOW Start Date is required');
		$('#date_start_err').html('SOW Start Date is required');
    }
	if ($('#date_due').val() == '') {
        err.push('SOW End Date is required');
		$('#date_due_err').html('SOW End Date is required');
    }
	
	if ($.trim($('#project_geography_val').val()) == 'not_select') {
        err.push('Project Geography is required');
		$('#project_geography_value_err').html('Project Geography is required');
	}
	
	if ($.trim($('#project_location').val()) == 'not_select') {
        err.push('Project Location is required');
		$('#project_location_err').html('Project Location is required');
    }
	if ($("input[name=customer_type]").is(":checked") == false) {
        err.push('Customer Type must be selected');
		$('#customer_type_err').html('Customer Type must be selected');
	}
	
	if ($.trim($('#lead_source_edit').val()) == 'not_select') {
        err.push('Source must be selected');
		$('#lead_source_edit_err').html('Source must be selected');
	}
	
	if ($.trim($('#job_category_edit').val()) == 'not_select') {
        err.push('Lead service must be selected');
		$('#lead_service_err').html('Lead service must be selected');
	}
	
	if ($.trim($('#industry_edit').val()) == 'not_select') {
        err.push('Lead service must be selected');
		$('#industry_edit_err').html('Industry must be selected');
    }
	
    if (err.length > 0) {
		setTimeout('timerfadeout()', 10000);
		// $('.errmsg_confirm').html('<b>Few errors occured! Please correct them and submit again!</b><br />' + err.join('<br />'));
		// alert('Few errors occured! Please correct them and submit again!\n\n' + err.join('\n'));
        return false;
    }

	var form_data = $('#project-confirm-form').serialize();	
	$('.blockUI .layout').block({
		message:'<h3>Processing</h3>',
		css: {background:'#666', border: '2px solid #999', padding:'8px', color:'#333'}
	});

	e.preventDefault();
	var formData = new FormData(this);
	
	$.ajax({
		url : site_base_url + 'welcome/add_project_info/',
		cache : false,
		contentType: false,
		processData: false,
		type: "POST",
		dataType: 'json',
		data:formData,
		success : function(response) {
			console.log(response);
			if(response.result=='ok') {
				if(current_tab){
					var cs = $('.tabs-confirm li').eq(2).find("a").attr('href');
					var v = cs.split("#")
					
					var updt = '';
					var enty  = $("#entity").val();
					//For Milestone lead_id
					var project_id = $("#project_id").val(response.project_id);
					//For Assign users lead_id
					var project_lead_id = $("#project_lead_id").val(response.project_id);
					var sturl = site_base_url+"regionsettings/getCurrency_lead_milestone/"+ enty+"/"+response.expect_worth_id+"/"+updt;
	   			 $('#currency_row_project_milestone').load(sturl);
					if(v[1] !=current_tab)	$('.tabs-confirm li').eq(2).find("a").trigger('click');	
					
				}
			} else if(response.result=='') {
				alert("Update Failed");
			}
			$('.blockUI .layout').unblock();
		}
	});
});

function update_project_users(current_tab) {
	var form_data = $('#set-assign-users').serialize();	
	
	/* $('.blockUI .layout').block({
		message:'<h3>Processing</h3>',
		css: {background:'#666', border: '2px solid #999', padding:'8px', color:'#333'}
	}); */
		
	$.ajax({
		url : site_base_url + 'welcome/custom_update_users',
		cache : false,
		type: "POST",
		dataType: 'json',
		data:form_data,
		success : function(response){
			if(response.result=='ok') {
				if(current_tab){
					var cs = $('.tabs-confirm li').eq(3).find("a").attr('href');
					var v = cs.split("#")
					if(v[1] !=current_tab)	$('.tabs-confirm li').eq(3).find("a").trigger('click');	
				}
			} else {
				alert("Update Failed");
			}
			$('.blockUI .layout').unblock();
		}
	});
}


function timerfadeout() {
	$('.ajx_failure_msg').empty();
}
function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	else
	return true;
}

function datefield_datepicker() {
	$('input[name^="expected_date[]"]').datepicker({
		minDate: 0,
		dateFormat: 'dd-mm-yy',
		beforeShow : function(input, inst) {
			$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
		}
	});
}

function monthyear_datepicker() {
	var d = new Date();		
	var fYear = parseInt(d.getFullYear()) + parseInt(10);
	var year = d.getFullYear() +':'+ fYear;	
	$('input[name^="month_year[]"]').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'MM yy',
		showButtonPanel: true,
		yearRange: year,
		stepMonths: '0', 
		minDate: '0',
		onClose: function(input, inst) {
			var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
		},
		beforeShow: function(input, inst) {
			if ((selDate = $(this).val()).length > 0) 
			{
				iYear = selDate.substring(selDate.length - 4, selDate.length);
				iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
				$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
			}
			$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
		}
	});
}

$('#milestone-tbl').delegate( '#addMilestoneRow', 'click', function () {
	var thisRow = $(this).closest('tr');
	$(this).hide();
	$("#milestone-tbl tbody tr").find('.del_file').show();	
	var obj = $(thisRow).clone().insertAfter(thisRow);
	obj.find(".project_milestone_name,.expected_date,.month_year,.amount").val("");
	obj.find(".project_milestone_name,.expected_date,.month_year,.amount").css('border','');
	obj.find('.createBtn').show();
	$('input[name^="expected_date[]"], input[name^="month_year[]"]').each(function(index){
	$(this).attr('id',index+$(this).attr("class"));
		if ($(this).hasClass('hasDatepicker')) {
			$(this).removeClass('hasDatepicker');
		} 
		datefield_datepicker();
		monthyear_datepicker();
	});
});

if($('#milestone-tbl tbody tr').length<=1){
	$('#milestone-tbl .del_file').hide();
	$('#milestone-tbl .createBtn').show();
}else{
	$('#milestone-tbl .del_file').show();
}

$('#milestone-tbl').delegate( '.del_file', 'click', function () {
	var thisRow = $(this).parent('td').parent('tr');
	$(thisRow).remove();
	$("#milestone-tbl tbody tr").each(function(){
		$("#milestone-tbl tbody tr:last").find('.createBtn').show();
	})
	if($('#milestone-tbl tbody tr').length<=1){
		$('#milestone-tbl .del_file').hide();
		$('#milestone-tbl .createBtn').show();
	}
});

function confirm_project() 
{
	var project_id = $("#project_id").val();
	$("#milestone-tbl").find('.textfield').css('border-color', '');
	var ms_error = false;
	var rowCount = $("#milestone-tbl tbody tr").length;
	//alert($("#milestone-tbl tbody tr").length);
	$("#milestone-tbl tbody tr").each(function(i){
		var innerIndex = 0;
		var textBoxClass = [];
		if($(this).find("td").find('.project_milestone_name').val()!="") {
			innerIndex++;
		} else {
			textBoxClass.push('project_milestone_name');
		}
		if($(this).find("td").find('.expected_date').val()!="") {
			innerIndex++;
		} else {
			textBoxClass.push('expected_date');
		}
		if($(this).find("td").find('.month_year').val()!="") {
			innerIndex++;
		} else {
			textBoxClass.push('month_year');
		}
		if($(this).find("td").find('.amount').val()!="") {
			innerIndex++;
		} else {
			textBoxClass.push('amount');
		}
		
		currentRow = $(this);
		
		if((innerIndex != 0 && innerIndex !=4 && rowCount==1) || rowCount>1) {
			ms_error = (textBoxClass.length>0) ? true : false;
			$.each(textBoxClass, function(index, value) {
				currentRow.find('.'+value).css('border-color', 'red');
			});
		}
	});
	
	if(ms_error == true) {
		return false;
	}
	
	if (confirm('Are you sure to send this project for Approval?') == true) {
        move_project(project_id);
    }
}

function move_project(project_id)
{
	var form_data = $('#set-milestones').serialize();
	
	//To create project in redmine
	var err = [];

    var entity = $("#entity").val();
    var group  = $("#group").val();
    var country  = $("#add1_country").val();
    var pan = $("#pan_num").val();
    var company_id = $("#companyid").val();
    var gst_in = $("#gst_in").val();
  
// if(entity == 1 && group==100 ){
//     if ($.trim($('#pan_num').val()) == '') {
//         err.push('Pan Number is required');
//         $('#pan_num_err_top').html('Pan Number is required');
//         $('.tabs-confirm li').eq(0).find("a").trigger('click');
//     }
// }    
// if(entity == 1 && country==15 && group==100 ){
    
//     if ($.trim($('#gst_in').val()) == '') {
//         err.push('GSTN is required');
//         $('#gstin_err_top').html('GSTN is required');
//         $('.tabs-confirm li').eq(0).find("a").trigger('click');
//     }
// }
    if (err.length > 0) {
        setTimeout('timerfadeout()', 9000);
        // $('.errmsg_confirm').html('<b>Few errors occured! Please correct them and submit again!</b><br />' + err.join('<br />'));
        // alert('Few errors occured! Please correct them and submit again!\n\n' + err.join('\n'));
        return false;
    }
	redmine_val = 0;
	if($('#create_redmine_project_check').is(":checked")){
		redmine_val = 1;
	}
	form_data += '&redmine_project_status='+JSON.stringify(redmine_val);
	
	$('.blockUI .layout').block({
		message:'<h3>Processing</h3>',
		css: {background:'#666', border: '2px solid #999', padding:'8px', color:'#333'}
	});
	
	$.ajax({
		url : site_base_url + 'welcome/confirm_project/'+project_id+'/'+pan+'/'+gst_in+'/'+company_id,
		cache : false,
		type: "POST",
		dataType: 'json',
		data:form_data,
		success : function(response) {
			if(response.result=='fail') {
				alert("Milestone insertion failed");
				$('.blockUI .layout').unblock();
				return false;
			}
			$('.blockUI .layout').block({
				message:'<h3>Processing</h3>',
				css: {background:'#666', border: '2px solid #999', padding:'8px', color:'#333'}
			});
			if(response.error == true) {
				if(response.errortype==1) {
					setTimeout('timerfadeout()', 6000);
					$('.tabs-confirm li').eq(1).find("a").trigger('click');
					$('.errmsg_confirm').html(response.errormsg);
					$('.blockUI .layout').unblock();
					return false;
				}
				alert(response.errormsg);
				window.location.href = site_base_url+"welcome/edit_quote" + "/" + project_id +"/";
				$.unblockUI();
			} else {
				reloadWithMessagePjt('Approval request sent successfully', project_id);
			}
			// $('.blockUI .layout').unblock();
		}
	});
}

$(".file-tabs-close-confirm-tab").click(function() {
	$.unblockUI();
	return false;
});

function reloadWithMessagePjt(str, project_id) 
{
	var params  = {str: str};
	params[csrf_token_name] = csrf_hash_token;
	
	$.post("ajax/request/set_flash_data",params, 
		function(info){
			document.location.href = site_base_url+'project/view_project/' + project_id;}
		);

}

/*
*@Method change_project_category
*@Use Show and hide the project and cost center tr
*Author eNoah - Mani.S
*/
function change_project_category(val)
{
	if(val == 1) {
		$('#project_center_tr').show();
		$('#cost_center_tr').hide();
	}else if(val == 2) {
		$('#cost_center_tr').show();
		$('#project_center_tr').hide();
	}else {
		$('#cost_center_tr').hide();
		$('#project_center_tr').hide();
	}
}

$('#copy').on("click", function () {
	if ($(this).is(':checked')) {
		var country = $("#add1_country").val();
		if(country == 15){
            $(".stno_ship").hide();
            $(".county_ship").hide();
            $(".suburb_ship").hide();
            $(".building_ship").hide();
            $(".block_ship").show();
            $(".state_ship").show();
            $(".city_ship").show();
            $(".gsttype_ship").show();
            $(".gst_ship").show();
            $(".federal_tax_ship").hide();
		}else if(country == 18){
			
				$(".block_ship").hide();
				$(".stno_ship").hide();
				$(".suburb_ship").hide();
				$(".county_ship").hide();
				$(".building_ship").hide();	
				$(".state_ship").show();
				$(".city_ship").show();	
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(country == 17){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".suburb_ship").hide();
				$(".state_ship").show();
				$(".city_ship").show();
				$(".block_ship").show();
				$(".building_ship").show();
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(country == 16){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".state_ship").show();
				$(".suburb_ship").hide();
				$(".city_ship").show();
				$(".block_ship").show();
				$(".building_ship").show();
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(country == 23){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".suburb_ship").hide();
				$(".building_ship").hide();
				$(".block_ship").show();
				$(".state_ship").show();
				$(".city_ship").show();
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").show();
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
		$("[name='ship_block']").val($("[name='add1_block']").val());
		$("[name='ship_street_po']").val($("[name='add1_street_po']").val());
		//$("[name='ship_street_no']").val($("[name='add1_street_no']").val());
		$("[name='ship_city']").val($("[name='add1_city']").val());
		$("[name='ship_suburb']").val($("[name='add1_suburb']").val());
		$("[name='ship_zipcode']").val($("[name='add1_postcode']").val());
		$("[name='ship_state']").val($("[name='add1_state']").val());
		$("[name='ship_region']").val($("[name='add1_region']").val());
		$("[name='ship_county']").val($("[name='county']").val());
		$("[name='ship_building']").val($("[name='building']").val());
		$("[name='ship_gst_type']").val($("[name='gst_type']").val());
		$("[name='ship_gst_in']").val($("[name='gst_in']").val());
		$("[name='ship_federal_tax']").val($("[name='federal_tax']").val());
		$("[name='ship_gln']").val($("[name='gln']").val());
		$("#ui-accordion-accordion-panel-3").show();
		$("#ui-accordion-accordion-panel-2").hide();
		getCountry_ship($("[name='add1_region']").val());
		getState_ship($("[name='add1_country']").val());
		getLocation_ship($("[name='add1_state']").val());
		
	//	$(".shipping").hide();
	} else {
		$(".shipping").show();
		getCountry_ship('0');
		getState_ship('0');
		getLocation_ship('0');
		$('input[name=ship_block').val('');
		$('input[name=ship_street_po').val('');
		$('input[name=ship_street_no').val('');
		$('input[name=ship_city').val('');
		$('input[name=ship_suburb').val('');
		$('input[name=ship_zipcode').val('');
		//$('input[name=ship_region').val('');
		$("#ship_region option[value='']").attr('selected', true);
		$("#ship_country option[value='']").attr('selected', true);
	//	$('input[name=ship_county').val('');
		$('input[name=ship_building').val('');
		$('input[name=ship_gst_type').val('');
		$('input[name=ship_gst_in').val('');
		$('input[name=ship_federal_tax').val('');
		$('input[name=ship_gln').val('');
	}

});
var id='';
	function getCountry_ship(val,id) {
		var sturl = "regionsettings/getCountry_ship/"+ val+"/"+id;	
			if ($('#copy').is(":checked"))
				{
					$('#country_row_ship').load(sturl, function(data){
						$("[name='ship_country']").val($("[name='add1_country']").val());
					
					});	
				}else{
					$('#country_row_ship').load(sturl, function(data){
					
					});	
			}
		
		return false;	
	}

	function getState_ship(val,id) {
		var sturl = "regionsettings/getState_ship/"+ val+"/"+id;		
		if ($('#copy').is(":checked"))
				{
					$('#state_row_ship').load(sturl,function(data){	
						$("[name='ship_state']").val($("[name='add1_state']").val());
						
					});
				}else{
					$('#state_row_ship').load(sturl,function(data){	

					});	
				}	
		
		var entity = $("#entity").val();
        var group  = $("#group").val();
		var country = $("#ship_country").val();
        if(country == 15){
            $(".stno_ship").hide();
            $(".county_ship").hide();
            $(".suburb_ship").hide();
            $(".building_ship").hide();
            $(".block_ship").show();
            $(".state_ship").show();
            $(".city_ship").show();
            $(".gsttype_ship").show();
            $(".gst_ship").show();
            $(".federal_tax_ship").hide();
		}else if(country == 18){
			
				$(".block_ship").hide();
				$(".stno_ship").hide();
				$(".suburb_ship").hide();
				$(".county_ship").hide();
				$(".building_ship").hide();	
				$(".state_ship").show();
				$(".city_ship").show();	
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(country == 17){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".suburb_ship").hide();
				$(".state_ship").show();
				$(".city_ship").show();
				$(".block_ship").show();
				$(".building_ship").show();
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(country == 16){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".state_ship").show();
				$(".suburb_ship").hide();
				$(".city_ship").show();
				$(".block_ship").show();
				$(".building_ship").show();
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(country == 23){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".suburb_ship").hide();
				$(".building_ship").hide();
				$(".block_ship").show();
				$(".state_ship").show();
				$(".city_ship").show();
				$(".gsttype_ship").hide();
				$(".gst_ship").hide();
				$(".federal_tax_ship").show();
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
        // if(entity == 1 && country == 15 && group==100){
		// 		if($('#ship_gst_in').val()=="") {
		// 			$("#ship_gst_in_err").html("Gstn is Required");
		// 			empty_err = false;
		// 		}
		// 	}
		return false;	
	}
	
	function getLocation_ship(val,id) {
		var sturl = "regionsettings/getLocation_ship/"+ val+"/"+id;	
		if ($('#copy').is(":checked")){
			$('#location_row_ship').load(sturl,function(data){	
				$("[name='ship_location']").val($("[name='add1_location']").val());
			});
		}else{
			$('#location_row_ship').load(sturl,function(data){	
		});
		}
		// $('#location_row_ship').load(sturl,function(data){	
		// 	$("[name='ship_location']").val($("[name='add1_location']").val());
		// });	
		
		
		return false;	
	}	

function update_customer_details(){

	var err1 = [];
	
	var entity = $('#entity').val();
	var group = $('#group').val();
	var registered_flag = $(".registered_flag:checked").val();
	if ($('#entity').val() == '') {
        err1.push('Entity is required');
		$('#entity_err').html('Entity is required');
	}

	if ($('#group').val() == '0') {
        err1.push('Group is required');
		$('#group_err').html('Group is required');
	}
	if(entity==1 && group ==100){ 
		if(registered_flag == undefined || registered_flag == '') {
				err1.push('Registered is required');
			$("#registered_err").html("Select Yes / No");
		}else{
			$("#registered_err").html("");
		}
	}	
    if ($('#company').val() == '') {
        err1.push('Company is required');
		$('#company_err').html('Company is required');
	}
   
	
	if(entity==1 && group==100 && registered_flag == 'Yes'){

		if ($('#pan_num').val() == '') {
			err1.push('Website is required');
			$('#pan_num_err').html('Pan Number is required');
		}else{
			$('#pan_num_err').hide();
			var pan = validatePanNumber($('#pan_num').val());
			
		}
	}else{
		$('#pan_num_err').html('');
	}
	//if(pan == 1){
		if (err1.length == 0) {
			setTimeout(function(){
				}, 
			3000);


			$("#ui-accordion-accordion-panel-1").show();
			$("#ui-accordion-accordion-panel-0").hide();
			return false;
		//}
	}
	
}	

function update_billing_address(){
	var err1 = [];
	//var entity = $('#entity').val();
	var country = $('#add1_country').val();
	var registered_flag = $(".registered_flag:checked").val();
        $("#post_code_err").html("");
	if ($('#add1_region').val() == '') {
        err1.push('Website is required');
		$('#add1_region_err').html('Region is required');
	}
	if ($('#add1_country').val() == '') {
        err1.push('Website is required');
		$('#add1_country_err').html('Country is required');
	}
        
        if (/\s/.test($('#post_code').val())) {
            err1.push('Please enter Zipcode without any Space');
            $("#post_code_err").html("Please enter Zipcode without any Space");
        }
                        
	if(country !=17 && country !=16){
		if ($('#add1_state').val() == '') {
				err1.push('Website is required');
				$('#add1_state_err').html('State is required');
			}
		if ($('#add1_location').val() == '') {
			err1.push('Website is required');
			$('#add1_location_err').html('City is required');
		}
	}	

	if(entity == 1 && country==15 && group==100 && registered_flag =='Yes'){
		
		if ($('#gst_in').val() == '') {
			err1.push('Website is required');
			$('#gstin_err').html('GSTIN is required');
		}
	}	
	if (err1.length == 0) {
		setTimeout(function(){
			}, 
		3000);
		$("#ui-accordion-accordion-panel-1").hide();
		$("#ui-accordion-accordion-panel-2").show();
        return false;
    }		

}
function gstn_validation(value){
	var country = $("#add1_country").val();
    var entity = $("#entity").val();
	var group = $("#group").val();
	if(entity==1 && country ==15 && group==100 ){
			var state_code = $("#add1_state").val();
			if(state_code == '24'){
				var state_code_id = '33';
			}
			if(state_code == '1'){
				var state_code_id = '37';
			}
			if(state_code == '2'){
				var state_code_id = '12';
			}
			if(state_code == '3'){
				var state_code_id = '18';
			}
			if(state_code == '4'){
				var state_code_id = '10';
			}
			if(state_code == '5'){
				var state_code_id = '22';
			}
			if(state_code == '6'){
				var state_code_id = '30';
			}
			if(state_code == '7'){
				var state_code_id = '24';
			}
			if(state_code == '8'){
				var state_code_id = '06';
			}
			if(state_code == '9'){
				var state_code_id = '02';
			}
			if(state_code == '10'){
				var state_code_id = '01';
			}
			if(state_code == '11'){
				var state_code_id = '20';
			}
			if(state_code == '12'){
				var state_code_id = '29';
			}
			if(state_code == '13'){
				var state_code_id = '32';
			}
			if(state_code == '14'){
				var state_code_id = '23';
			}
			if(state_code == '15'){
				var state_code_id = '27';
			}
			if(state_code == '16'){
				var state_code_id = '14';
			}
			if(state_code == '17'){
				var state_code_id = '17';
			}
			if(state_code == '18'){
				var state_code_id = '15';
			}
			if(state_code == '19'){
				var state_code_id = '13';
			}
			if(state_code == '20'){
				var state_code_id = '21';
			}
			if(state_code == '21'){
				var state_code_id = '03';
			}
			if(state_code == '22'){
				var state_code_id = '08';
			}
			if(state_code == '23'){
				var state_code_id = '11';
			}
			if(state_code == '25'){
				var state_code_id = '16';
			}
			if(state_code == '26'){
				var state_code_id = '05';
			}
			if(state_code == '27'){
				var state_code_id = '09';
			}
			if(state_code == '28'){
				var state_code_id = '19';
			}
			if(state_code == '29'){
				var state_code_id = '35';
			}
			if(state_code == '30'){
				var state_code_id = '04';
			}
			if(state_code == '31'){
				var state_code_id = '26';
			}
			if(state_code == '32'){
				var state_code_id = '25';
			}
		
			if(state_code == '33'){
				var state_code_id = '07';
			}
			if(state_code == '34'){
				var state_code_id = '31';
			}
			if(state_code == '35'){
				var state_code_id = '34';
			}
			if(state_code == '170'){
				var state_code_id = '36';
			}
			var pan = $("#pan_num").val();
				var gst_in_value  = state_code_id+pan;
				var gstn_Val = value;
				if(gstn_Val.length !=15){ // 15 < 16
					console.log(gstn_Val.length);
					console.log("ggsdsd");
					document.getElementById("status_id").innerHTML = "Enter 15  gstn number.";
					$("#gstin_err").hide();
					return false;
				}
				else{
					console.log("ASDsdfsd");
					document.getElementById("status_id").innerHTML = '';
					$("#gstin_err").hide();
				}
				
				if(gst_in_value != gstn_Val.substr(0, 12)){
					console.log("gg");
					document.getElementById("status_id").innerHTML = "Enter valid state for GSTIN.";
					$("#gstin_err").hide();
				}else{
					console.log("ASDsdfsd");
					document.getElementById("status_id").innerHTML = '';
					$("#gstin_err").hide();
				}
				console.log(gstn_Val.length);
		}			
}
function getEntity(id){
	var entity = $("#entity").val();
	if(entity == 1){
		if( id == 103){
			$(".registered").hide();
			$('.pan').hide();
		}else if(id==102){	
			$(".registered").hide();
			$('.pan').hide();
		}else{
			$(".registered").show();
			$('.pan').show();
		}
	}	
}
function update_shipping_address(){
	// var entity = $('#entity').val();	

	// var err2 = [];
	// if ($('#ship_street_po').val() == '') {
	// 	err2.push('Website is required');
	// 	$('#ship_street_po_err').html('Street is required');
	// }
	// if ($('#ship_block').val() == '') {
	// 	err2.push('Website is required');
	// 	$('#ship_block_err').html('Block is required');
	// }
	// if ($('#ship_zipcode').val() == '') {
	// 	err2.push('Website is required');
	// 	$('#ship_zipcode_err').html('Postcode is required');
	// }
	// if ($('#ship_region').val() == '') {
	// 	err2.push('Website is required');
	// 	$('#ship_region_err').html('Region is required');
	// }
	// if ($('#ship_country').val() == '') {
	// 	err2.push('Website is required');
	// 	$('#ship_country_err').html('Country is required');
	// }
	// if(entity!='2'){
	// 	if ($('#ship_state').val() == '') {
	// 			err2.push('Website is required');
	// 			$('#ship_state_err').html('State is required');
	// 		}
	// 	if ($('#ship_location').val() == '') {
	// 		err2.push('Website is required');
	// 		$('#ship_location_err').html('City is required');
	// 	}
	// }	
	// if ($('#ship_gst_in').val() == '') {
	// 	err2.push('Website is required');
	// 	$('#ship_gst_in_err').html('GSTIN is required');
	// }
	// if ($('#ship_federal_tax').val() == '') {
	// 	err2.push('Website is required');
	// 	$('#ship_federal_tax_err').html('Federal is required');
	// }
	// if (err2.length == 0) {
	// 		setTimeout(function(){
	// 			}, 
	// 		3000);
	// 	$("#ui-accordion-accordion-panel-2").hide();
	// 	$("#ui-accordion-accordion-panel-3").show();
	// 		return false;
	// 	}
	$("#ui-accordion-accordion-panel-2").hide();
 	$("#ui-accordion-accordion-panel-3").show();
}
function prepareQuoteForClient(custID) {
	$('.notice').slideUp(400);
	$.getJSON(
		'welcome/ajax_customer_details/' + custID,
		{},
		function (details) {
			$('.q-cust-company span').html(details.company);
			$('.q-cust-name span').html(details.customer_name);
			$('.q-cust-email span').html(details.email_1);
			
		}
	);
	
}

function getUserForLeadAssign(regId,cntryId,stId,locId) {

	$('.notice').slideUp(400);
	$.getJSON(
		'welcome/user_level_details/' + regId + '/' + cntryId + '/' + stId + '/' + locId,
		{},
		function (userdetails) 
		{
			//get_user_infm(userdetails);
		}
	);
}
// function getshipval(ship,enty)
// {
	
// 	if(ship == 'ship_new'){
// 		$(".ship").show();
// 	}else{
// 		$(".ship").hide();
// 	}

// }


// function getbillval(bill,enty)
// {
//     if(bill == 'bill_new'){
// 		$(".bill").show();
// 	}else{
// 		$(".bill").hide();
// 	}
// }





//////////////////////////////////////////////////////////////////// end ///////////////////////////////////////////////////
