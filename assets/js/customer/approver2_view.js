/*
 *@lead confirmation view Practice
 *@Welcome Controller
*/

// csrf_token_name,csrf_hash_token,site_base_url & accesspageis global js variable


var updt = '';

if(document.getElementById('region_update')) {
	var reg = document.getElementById('region_update').value;

	if (document.getElementById('country_update'))
	var cty = document.getElementById('country_update').value;

	if(cty == 15){
		$(".stno").hide();
		$(".county").hide();
		$(".suburb").hide();
		$(".building").hide();
		$(".block").show();
		$(".state").show();
		$(".city").show();
		$(".gsttype").show();
		$(".gstin").show();
		$(".federal_tax").hide();
	}else if(cty == 18){
		
			$(".block").hide();
			$(".stno").hide();
			$(".suburb").hide();
			$(".county").hide();
			$(".building").hide();	
			$(".state").show();
			$(".city").show();	
			$(".gsttype").hide();
			$(".gstin").hide();
			$(".federal_tax").hide();
	}else if(cty == 17){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".state").show();
			$(".city").show();
			$(".block").show();
			$(".building").show();
			$(".gsttype").hide();
			$(".gstin").hide();
			$(".federal_tax").hide();
	}else if(cty == 16){
			$(".stno").hide();
			$(".county").hide();
			$(".state").show();
			$(".suburb").hide();
			$(".city").show();
			$(".block").show();
			$(".building").show();
			$(".gsttype").hide();
			$(".gstin").hide();
			$(".federal_tax").hide();
	}else if(cty == 23){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".building").hide();
			$(".block").show();
			$(".state").show();
			$(".city").show();
			$(".gsttype").hide();
			$(".gstin").hide();
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
		$(".gstin").show();
		$(".federal_tax").hide();
	}

	if (document.getElementById('state_update'))
	var st = document.getElementById('state_update').value;

	if (document.getElementById('location_update'))
	var loc = document.getElementById('location_update').value;

	if (document.getElementById('entity_update'))
	var enty = document.getElementById('entity_update').value;

	if (document.getElementById('shipping_update'))
	var ship = document.getElementById('shipping_update').value;

	if (document.getElementById('billing_update'))
	var bill = document.getElementById('billing_update').value;

	if (document.getElementById('currencies'))
	var currency = document.getElementById('currencies').value;

	if (document.getElementById('group'))
	var group = document.getElementById('group').value;

	if (document.getElementById('shipping_country'))
	var ship_country = document.getElementById('shipping_country').value;

	if (document.getElementById('shipping_location'))
	var ship_location = document.getElementById('shipping_location').value;

	if(ship_country == 15){
		$(".stno_ship").hide();
		$(".county_ship").hide();
		$(".suburb_ship").hide();
		$(".building_ship").hide();
		$(".block_ship").show();
		$(".state_ship").show();
		$(".city_ship").show();
		$(".gsttype_ship").show();
		$(".gstin_ship").show();
		$(".federal_tax").hide();
	}else if(ship_country == 18){
		
			$(".block_ship").hide();
			$(".stno_ship").hide();
			$(".suburb_ship").hide();
			$(".county_ship").hide();
			$(".building_ship").hide();	
			$(".state_ship").show();
			$(".city_ship").show();	
			$(".gsttype_ship").hide();
			$(".gstin_ship").hide();
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
			$(".gstin_ship").hide();
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
			$(".gstin_ship").hide();
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
			$(".gstin_ship").hide();
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
		$(".gstin_ship").show();
		$(".federal_tax_ship").hide();
	}

	if (document.getElementById('shipping_region'))
	var ship_region = document.getElementById('shipping_region').value;

	if (document.getElementById('shipping_state'))
	var ship_state = document.getElementById('shipping_state').value;
		

	updt = 'updt';

	if(reg != 0 && cty != 0)
	getCountry(reg,cty,updt);

	if(cty != 0 && st != 0)
	getState(cty,st,updt);

	if(st != 0 && loc != 0)
	getLocation(st,loc,updt);

	if(enty != 0)
	getCurrency(enty,group,updt);

	if(cty != 0)
	get_cus_state(cty,st,updt);

	if(ship != 0)
	getshipval(ship);

	if(bill != 0)
	getbillval(bill);

	if(ship_region!=0)
	getCountry_ship(ship_region,ship_country);

	if(ship_country!=0)
	getState_ship(ship_country,ship_state);

	if(ship_state!=0)
	getCity_ship(ship_state,ship_location);

	
}
function getCountry(val,id,updt) {
	var sturl = site_base_url+"regionsettings/getCountry/"+ val+"/"+id+"/"+updt;	
	//alert("SDfds");
	if(id == 15){
		$(".stno").hide();
		$(".county").hide();
		$(".suburb").hide();
		$(".building").hide();
		$(".block").show();
		$(".state").show();
		$(".city").show();
		$(".gsttype").show();
		$(".gstin").show();
		$(".federal_tax").hide();
	}else if(id == 18){
		
			$(".block").hide();
			$(".stno").hide();
			$(".suburb").hide();
			$(".county").hide();
			$(".building").hide();	
			$(".state").show();
			$(".city").show();	
			$(".gsttype").hide();
			$(".gstin").hide();
			$(".federal_tax").hide();
	}else if(id == 17){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".state").show();
			$(".city").show();
			$(".block").show();
			$(".building").show();
			$(".gsttype").hide();
			$(".gstin").hide();
			$(".federal_tax").hide();
	}else if(id == 16){
			$(".stno").hide();
			$(".county").hide();
			$(".state").show();
			$(".suburb").hide();
			$(".city").show();
			$(".block").show();
			$(".building").show();
			$(".gsttype").hide();
			$(".gstin").hide();
			$(".federal_tax").hide();
	}else if(id == 23){
			$(".stno").hide();
			$(".county").hide();
			$(".suburb").hide();
			$(".building").hide();
			$(".block").show();
			$(".state").show();
			$(".city").show();
			$(".gsttype").hide();
			$(".gstin").hide();
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
		$(".gstin").show();
		$(".federal_tax").hide();
	}	
	$('#country_row').load(sturl);	
	
    return false;	
}

function get_cus_state(val,st,updt){

	var sturl = site_base_url+"regionsettings/get_cus_state/"+ val+"/"+st+"/"+updt;	
	//alert("SDfds");
	
    $('#state1_row').load(sturl);	
    return false;

}

function getCurrency(val,group,updt){

	if(val == 1){
		$(".pan").show();
	}else if(val == 4){
		$(".pan").hide();

	}else if(val == 2){
		$(".pan").hide();
	}else if(val == 3){;
		$(".pan").hide();
	}else{
		$(".pan").show();
	}
	//var sturl = site_base_url+"regionsettings/getCurrency/"+ val+"/"+updt;	
	// var sturl = site_base_url+"regionsettings/getCurrency/"+ val+"/"+updt+"/"+currency;
	// //alert("SDfds");
	// $('#currency_row').load(sturl);	
	var sturl_group = site_base_url+"regionsettings/getEntityGroup/"+ val+"/"+updt+"/"+group;
	$('#group_row').load(sturl_group);
    return false;

}
function getState(val,id,updt) {
	var sturl = site_base_url+"regionsettings/getState/"+ val+"/"+id+"/"+updt;	
	$('#state_row').load(sturl);	
	var country = $("#add1_country").val();

				if(id == 15){
					$(".stno").hide();
					$(".county").hide();
					$(".suburb").hide();
					$(".building").hide();
					$(".block").show();
					$(".state").show();
					$(".city").show();
					$(".gsttype").show();
					$(".gstin").show();
					$(".federal_tax").hide();
				}else if(id == 18){
					
						$(".block").hide();
						$(".stno").hide();
						$(".suburb").hide();
						$(".county").hide();
						$(".building").hide();	
						$(".state").show();
						$(".city").show();	
						$(".gsttype").hide();
						$(".gstin").hide();
						$(".federal_tax").hide();
				}else if(id == 17){
						$(".stno").hide();
						$(".county").hide();
						$(".suburb").hide();
						$(".state").show();
						$(".city").show();
						$(".block").show();
						$(".building").show();
						$(".gsttype").hide();
						$(".gstin").hide();
						$(".federal_tax").hide();
				}else if(id == 16){
						$(".stno").hide();
						$(".county").hide();
						$(".state").show();
						$(".suburb").hide();
						$(".city").show();
						$(".block").show();
						$(".building").show();
						$(".gsttype").hide();
						$(".gstin").hide();
						$(".federal_tax").hide();
				}else if(id == 23){
						$(".stno").hide();
						$(".county").hide();
						$(".suburb").hide();
						$(".building").hide();
						$(".block").show();
						$(".state").show();
						$(".city").show();
						$(".gsttype").hide();
						$(".gstin").hide();
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
					$(".gstin").show();
					$(".federal_tax").hide();
				}	
    return false;	
}
function getLocation(val,id,updt) {
	var sturl = site_base_url+"regionsettings/getLocation/"+ val+"/"+id+"/"+updt;	
    $('#location_row').load(sturl);	
    return false;	
}
$(".file-tabs-close-confirm-tab").click(function() {
	$("#tabs").hide();
	$.unblockUI();
	return false;
	
});
var id='';
function getCountry_ship(val,id) {
	var sturl = "regionsettings/getCountry_ship/"+ val+"/"+id;	
	$('#country_row_ship').load(sturl, function(data){
		var shipcountry = $("#ship_country").val();
		var billcountry  = $("#add1_country").val();
		if(billcountry == shipcountry){
			$("[name='ship_country']").val($("[name='add1_country']").val());
		}
		if(id == 15){
			$(".stno_ship").hide();
			$(".county_ship").hide();
			$(".suburb_ship").hide();
			$(".building_ship").hide();
			$(".block_ship").show();
			$(".state_ship").show();
			$(".city_ship").show();
			$(".gsttype_ship").show();
			$(".gstin_ship").show();
			$(".federal_tax_ship").hide();
		}else if(id == 18){
			
				$(".block_ship").hide();
				$(".stno_ship").hide();
				$(".suburb_ship").hide();
				$(".county_ship").hide();
				$(".building_ship").hide();	
				$(".state_ship").show();
				$(".city_ship").show();	
				$(".gsttype_ship").hide();
				$(".gstin_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(id == 17){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".suburb_ship").hide();
				$(".state_ship").show();
				$(".city_ship").show();
				$(".block_ship").show();
				$(".building_ship").show();
				$(".gsttype_ship").hide();
				$(".gstin_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(id == 16){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".state_ship").show();
				$(".suburb_ship").hide();
				$(".city_ship").show();
				$(".block_ship").show();
				$(".building_ship").show();
				$(".gsttype_ship").hide();
				$(".gstin_ship").hide();
				$(".federal_tax_ship").hide();
		}else if(id == 23){
				$(".stno_ship").hide();
				$(".county_ship").hide();
				$(".suburb_ship").hide();
				$(".building_ship").hide();
				$(".block_ship").show();
				$(".state_ship").show();
				$(".city_ship").show();
				$(".gsttype_ship").hide();
				$(".gstin_ship").hide();
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
			$(".gstin_ship").show();
			$(".federal_tax").hide();
		}	
	});	
	
	return false;	
}

function getState_ship(val,id) {
	var sturl = "regionsettings/getState_ship/"+ val+"/"+id;		
	$('#state_row_ship').load(sturl,function(data){	
		var shipcountry = $("#add1_state").val();
		var billcountry  = $("#ship_state").val();
		
		
		if(billcountry == shipcountry){
			$("[name='ship_state']").val($("[name='add1_state']").val());
		}
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
            $(".gstn_ship").show();
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
				$(".gstn_ship").hide();
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
				$(".gstn_ship").hide();
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
				$(".gstn_ship").hide();
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
				$(".gstn_ship").hide();
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
			$(".gstn_ship").show();
			$(".federal_tax").hide();
		}	
	});	
	return false;	
}

function getCity_ship(val,id) {
	var sturl = "regionsettings/getLocation_ship/"+ val+"/"+id;	
	$('#location_row_ship').load(sturl,function(data){	
		var shipcountry = $("#ship_location").val();
		var billcountry  = $("#add1_location").val();
		if(billcountry == shipcountry){
		   $("[name='ship_location']").val($("[name='add1_location']").val());
		}	
	});	
	return false;	
}	
function getshipval(ship)
{
	if(ship == 'ship_new'){
		$(".ship").show();
	}else{
		$(".ship").hide();
	}

}


function getbillval(bill)
{
    if(bill == 'bill_new'){
		$(".bill").show();
	}else{
		$(".bill").hide();
	}
}

// function update_approver1(id) {
// 	$.ajax({
// 		url : site_base_url + 'customers/update_approver1',
// 		cache : false,
// 		type: "POST",
// 		dataType: 'json',
// 		data:id,
// 		success : function(response){
// 			console.log(response);
// 		}
// 	});


// }	


//////////////////////////////////////////////////////////////////// end ///////////////////////////////////////////////////