/*
 *@Customer Add View Jquery
*/
var id='';
var updt='';
metrics_reload = false;
$(function() {
    $.fn.__tabs = $.fn.tabs;
		$.fn.tabs = function (a, b, c, d, e, f) {
			var base = location.href.replace(/#.*$/, '');
			$('ul>li>a[href^="#"]', this).each(function () {
				var href = $(this).attr('href');
				$(this).attr('href', base + href);
			});
			$(this).__tabs(a, b, c, d, e, f);
		};

						var id = $('#customer_id').val();
						var params = {};
							params[csrf_token_name] = csrf_hash_token;
							params['customer'] 	= id;
							
							$.ajax({
								type:'POST',
								data:params,
								url:site_base_url+'project/lead_customer/',
								cache:false,
								success:function(data) {
									$('#lead-customer').html(data);
									customerDataTable();
								}
							});
		$( "#project-tabs" ).tabs({
			beforeActivate: function( event, ui ) {
				
				var evnt_id = ui.newPanel[0].id;
				var params = {};
				params[csrf_token_name] = csrf_hash_token;
				params['customer'] 	= id;
				switch(evnt_id){
					case 'jv-tab-0':
						if(metrics_reload == true) {
							
							$.ajax({
								type:'POST',
								data:params,
								url:site_base_url+'project/lead_customer/',
								cache:false,
								success:function(data) {
									$('#lead-customer').html(data);
									customerDataTable();
								}
							});
						}
					break;

					case 'jv-tab-1':
						$.ajax({
							type:'POST',
							data:params,
							url:site_base_url+'project/project_customer/',
							cache:false,
							success:function(data) {
								$('#project-customer').html(data);
								//invoiceDataTable();
							}
						});
						
					break;

					case 'jv-tab-2':
						$.ajax({
							type:'POST',
							data:params,
							url:site_base_url+'project/project_file_customer/',
							cache:false,
							success:function(data) {
								$('#project-file-customer').html(data);
								projectFileDataTable();
							}
						});
						
					break;
                                        
                                        case 'jv-tab-6':
                                            $.ajax({
                                                type:'POST',
                                                data:params,
                                                url:site_base_url+'project/customer_files/',
                                                cache:false,
                                                success:function(data) {
                                                    $('#customer-files').html(data);
                                                    projectFileDataTable();
                                                }
                                            });
					break;
					
					case 'jv-tab-3':
						$.ajax({
							type:'POST',
							data:params,
							url:site_base_url+'invoice/invoice_customer/',
							cache:false,
							success:function(data) {
								$('#invoice-customer').html(data);
								invoiceDataTable();
							}
						});
						
					break;
					case 'jv-tab-4':
						$.ajax({
						type:'POST',
						data:params,
						url:site_base_url+'dashboard/soa_customer/',
						cache:false,
						success:function(data) {
							$('#soa-customer').html(data);
							//invoiceDataTable();
						}
					});
					
				break;
					case 'jv-tab-5':
						loadLogs(id);
					break;
				}
			}
		});

});    
function loadLogs(id) 
{
	var params = {};
	params[csrf_token_name] = csrf_hash_token;
	$.post( 
		site_base_url+'project/getCustomerLogs/'+id,params,
		function(data) {
			if (data.error) {
			} else {
				$('#load-log').html(data);
				logsDataTable();
			}
		}
	);
}

	function logsDataTable(){
		$('.logstbl').dataTable( {
			"iDisplayLength": 10,
			"sPaginationType": "full_numbers",
			"bInfo": true,
			"bPaginate": true,
			"bProcessing": true,
			"bServerSide": false,
			"bLengthChange": false,
			"bSort": true,
			"bFilter": true,
			"bAutoWidth": false,
			"bDestroy": true,
			"oLanguage": {
			"sEmptyTable": "No Comments Found..."
			}
		});
	}
if(document.getElementById('entity_update')) {
	var entity = document.getElementById('entity_update').value;	
}
if(document.getElementById('group_update')){
    var group = document.getElementById('group_update').value;	
   
}


if(document.getElementById('region_update')) {
var reg = document.getElementById('region_update').value;
if (document.getElementById('country_update')){
var cty = document.getElementById('country_update').value;
}
if (document.getElementById('state_update')){
	var st = document.getElementById('state_update').value;
}
if (document.getElementById('location_update')){
	var loc = document.getElementById('location_update').value;
}
if (document.getElementById('varEdit')){
var updt = document.getElementById('varEdit').value;
}

if(reg != 0 && cty != 0)
getCountry(reg,cty,updt);

if(cty != 0 && st != 0)
getState(cty,st,updt);

if(st != 0 && loc != 0)
getLocation(st,loc,updt);
}

if(entity != 0){
getCurrency(entity,updt,group);
}
    
function getCurrency(entity,updt,group){
	var address = $("#address_id").val();
	if(entity == 1){
		// $(".stno").hide();
		 $(".suburb").hide();
		// $(".county").hide();
		// $(".building").hide();
		// $(".block").show();
		// $(".state").show();
		// $(".city").show();
		// $(".gsttype").show();
		// $(".gstin").show();
		// $(".federal_tax").hide();
		$(".pan").show();
		$(".registered").show();
	}else if(entity == 4){
		// $(".block").hide();
		// $(".stno").hide();
		 $(".suburb").hide();
		 $(".registered").hide();
		// $(".county").hide();
		// $(".building").hide();	
		// $(".state").show();
		// $(".city").show();	
		// $(".gsttype").hide();
		// $(".gstin").hide();
		// $(".federal_tax").hide();
		$(".pan").hide();
	}else if(entity == 2){
		// $(".stno").hide();
		 $(".suburb").hide();
		 $(".registered").hide();
		// $(".county").hide();
		// $(".state").hide();
		// $(".city").hide();
		// $(".block").show();
		// $(".building").show();
		// $(".gsttype").hide();
		// $(".gstin").hide();
		// $(".federal_tax").hide();
		$(".pan").hide();
	}else if(entity == 7){
		// $(".stno").hide();
		 $(".suburb").hide();
		 $(".registered").hide();
		// $(".county").hide();
		// $(".state").hide();
		// $(".city").hide();
		// $(".block").show();
		// $(".building").show();
		// $(".gsttype").hide();
		// $(".gstin").hide();
		// $(".federal_tax").hide();
		$(".pan").hide();
	}else if(entity == 3){
		// $(".stno").hide();
		 $(".suburb").hide();
		 $(".registered").hide();
		// $(".county").hide();
		// $(".building").hide();
		// $(".block").show();
		// $(".state").show();
		// $(".city").show();
		// $(".gsttype").hide();
		// $(".gstin").hide();
		// $(".federal_tax").show();
		$(".pan").hide();
	}else{
		// $(".stno").show();
		 $(".suburb").show();
		 $(".registered").show();
		// $(".county").show();
		// $(".building").show();
		// $(".block").show();
		// $(".state").show();
		// $(".city").show();
		// $(".gsttype").show();
		// $(".gstin").show();
		// $(".federal_tax").hide();
		$(".pan").show();
    }	
	var sturl_group = site_base_url+"regionsettings/getEntityGroup_customerupdate/"+ entity+"/"+updt+"/"+group;
	// $('#currency_row').load(sturl);	
	$('#group_row').load(sturl_group);
    return false;

}
function getEntity(id){
	var entity = $("#entity").val();
	if(entity == 1){
		if( id == 103){
			$('.pan').hide();
			$('#pan_id').hide();
			$(".registered").hide();
		}else if(id==102){	
			$('.pan').hide();
			$('#pan_id').hide();
			$(".registered").hide();
		}else{
			$('.pan').show();
			$('pan_id').show();
			$(".registered").show();
		}
	}	
}
function getCountry(val,id,updt) {
	var sturl = "regionsettings/getCountry/"+ val+"/"+id+"/"+updt;	
	//alert("SDfds");
    $('#country_row').load(sturl);
	$('.region_err_msg').empty();
    return false;	
}
function getState(val,id,updt) {
	var sturl = "regionsettings/getState/"+ val+"/"+id+"/"+updt;	
    $('#state_row').load(sturl);	
    return false;	
}
function getLocation(val,id,updt) {
	var sturl = "regionsettings/getLocation/"+ val+"/"+id+"/"+updt;	
    $('#location_row').load(sturl);	
    return false;	
}

$(document).ready(function() {
    $('.checkUser').hide();
    $('.checkUser1').hide();
    $('.checkUser2').hide();
   

    function getResult(email){
        var baseurl = $('.hiddenUrl').val();
		var email = email
		var params = {};
		params[csrf_token_name] = csrf_hash_token;
		params['email'] = email;
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
	
	
	$('#document_tbl').delegate( '.check_email', 'keyup', function () {
		var thisRow = $(this).parent('td');
		if( $(this).val().length >= 3 )
		{
			var email 	   = $(this).val();
			var company_id = $('#emailupdate').val();
			var custids    = $(this).parent().parent().children().find('.contact_id').val();

			var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if(filter.test(email)){
				if (custids == "")
				var custid 	= 0;
				else
				var custid 	= custids;
			
				var params		= {};
				params[csrf_token_name] = csrf_hash_token;
				params['email'] 		= email;
				params['custid'] 		= custid;
				params['company_id'] 	= company_id;
				$.ajax({
					type: "POST",
					url : site_base_url + 'customers/Check_email/',
					cache : false,
					data : params,
					success : function(response){
						if(response == 'userOk') {
							$("#positiveBtn").removeAttr("disabled");
							$(thisRow).children(".email_err_msg").html("<span class='ajx_success_msg'>Email Available.</span>");
						} else { 
							$(thisRow).children(".email_err_msg").html('Email Already Exists.');
							$("#positiveBtn").attr("disabled", "disabled");
						}
					}
				});
			} else {
				$("#positiveBtn").attr("disabled", "disabled");
				$(thisRow).children(".email_err_msg").html('Not valid email.');
			}
		}
		return false;
    });
	
	$( "#company" ).keyup(function() {
		$('.company_err_msg').empty();
	});
});


//jQuery code added for adding New Country, New State & New Location -- Starts Here
function ajxCty(){
	$("#addcountry").slideToggle("slow");
}

function ajxSaveCty(){
	$(document).ready(function() {
       
		if ($('#newcountry').val() == "") {
			alert("Country Required.");
		}
		else {
			var regionId = $("#add1_region").val();
			var newCty 	 = $('#newcountry').val();
            getCty(newCty, regionId);
		}	

    function getCty(newCty){
			var baseurl = $('.hiddenUrl').val();
			var params = {regionid: $("#add1_region").val(),country_name:$("#newcountry").val(),created_by:(customer_user_id)};
			params[csrf_token_name]      = csrf_hash_token; 

            $.ajax({
            url : baseurl + 'customers/getCtyRes/' + newCty + "/" + regionId,
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
	});	
}


function ajxSt() {
	$("#addstate").slideToggle("slow");
}

function ajxSaveSt() {
	$(document).ready(function() {
        /*if( $('#newstate').val().length > 2 )
            {
              var newSte = $('#newstate').val();
              getSte(newSte);
            }
        return false;*/
	
	if ($('#newstate').val() == "") {
			alert("State Required.");
		}
		else {
			var cntyId = $("#add1_country").val()
			var newSte = $('#newstate').val();
            getSte(newSte,cntyId);
		}	
		
	function getSte(newSte,cntyId) {
			var baseurl = $('.hiddenUrl').val();
			var params = {countryid: $("#add1_country").val(),state_name:$("#newstate").val(),created_by:(customer_user_id)};
			params[csrf_token_name]      = csrf_hash_token; 
			
            $.ajax({
            url : baseurl + 'customers/getSteRes/' + newSte + "/" + cntyId,
            cache : false,
            success : function(response){
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
	});	
}


function ajxLoc() {
	$("#addLocation").slideToggle("slow");
}

function ajxSaveLoc(id) {
	$(document).ready(function() {
	if ($('#newlocation').val() == "") {
		alert("Location Required.");
	}
	else {
		var stId = $("#add1_state_"+id).val();
		var newLoc = $('#newlocation').val();
		getLoc(newLoc,stId);
	}
		
	function getLoc(newLoc,stId) {
			var baseurl = $('.hiddenUrl').val();
			var params = {address_id:id,stateid: $("#add1_state_"+id).val(),location_name:$("#newlocation").val(),created_by:(customer_user_id),flag:'cust_mod'};
			params[csrf_token_name]  = csrf_hash_token; 
            $.ajax({
            url : baseurl + 'customers/getLocRes/' + newLoc + '/' +stId,
            cache : false,
            success : function(response){
                if(response == 'userOk') 
					{
						$.post("regionsettings/location_add_ajax",params, 
						function(info){ $("#location_row_ship"+id).html(info); });
						$("#addstate").hide();
					}
                else
					{ 
						alert('Location Exists.');
					}
            }
        });
	}
	});	
}


function ajxSaveupdateCustLoc(id) {
	$(document).ready(function() {
	if ($('#newlocation').val() == "") {
		alert("Location Required.");
	}
	else {
		var stId = $("#add1_state").val();
		var newLoc = $('#newlocation').val();
		getLoc(newLoc,stId);
	}
		
	function getLoc(newLoc,stId) {
			var baseurl = $('.hiddenUrl').val();
			var params = {address_id:id,stateid: $("#add1_state").val(),location_name:$("#newlocation").val(),created_by:(customer_user_id)};
			params[csrf_token_name]  = csrf_hash_token; 
            $.ajax({
            url : baseurl + 'customers/getLocRes/' + newLoc + '/' +stId,
            cache : false,
            success : function(response){
                if(response == 'userOk') 
					{
						$.post("regionsettings/location_add_ajax",params, 
						function(info){ $("#location_row_"+id).html(info); });
						$("#addstate").hide();
					}
                else
					{ 
						alert('Location Exists.');
					}
            }
        });
	}
	});	
}
//jQuery code added for adding New Country, New State & New Location -- Ends Here

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
function getSalescontactDetails(location_id) {

//alert('location=='+location_id);

}

//Multiple customer add
//for document format form
$('#document_tbl').delegate( '#addRow', 'click', function () {
	var thisRow = $(this).closest('tr');
	$(this).hide();
	$("#document_tbl tbody tr").find('.del_file').show();	
	var obj = $(thisRow).clone().insertAfter(thisRow);
		obj.find(".contact_id").val("");
		obj.find(".first_name").val("");
		obj.find(".last_name").val("");
		obj.find(".last_name").val("");
		obj.find(".position_title").val("");
		obj.find(".phone").val("");
		obj.find(".email").val("");
		obj.find(".skype").val("");
		obj.find(".hyperfields").css('border','');
		obj.find(".first_name_err_msg").text('');
		obj.find(".last_name_err_msg").text('');
		obj.find(".last_name_err_msg").text('');
		obj.find(".position_title_err_msg").text('');
		obj.find(".phone_err_msg").text('');
		obj.find(".email_err_msg").text('');
		obj.find(".skype_err_msg").text('');
		obj.find("#deleteRow").attr('hyperid','0');
		obj.find('.createBtn').show();
});

$('#document_tbl').delegate( '.del_file', 'click', function () {
	var thisRow = $(this).parent('td').parent('tr');
	if( $(this).attr('hyperid') !=0 ) {
		var hyperid = $(this).attr('hyperid');
		var x = confirm("Are you Sure want to remove?");
		if(x==true)
		{
			/* $.post(site_base_url+'customers/delete_contact?id='+hyperid,function( data ) {
				$(thisRow).remove();
				if($('#document_tbl tbody tr').length<=1){
					$('#document_tbl .del_file').hide();
					$('#document_tbl .createBtn').show();
				}
			}); */
			var formdata = { 'id':hyperid }
			formdata[csrf_token_name] = csrf_hash_token;
			$.ajax({
				async: false,
				type: "POST",
				url: site_base_url+'customers/delete_contact/',
				dataType:"json",                                                                
				data: formdata,
				cache: false,
				beforeSend:function() {
				},
				success: function(response) {
					if (response.html == 'NO') {
						alert('One or more Leads currently mapped to this customer. This cannot be deleted.');
					} else {
						$(thisRow).remove();
						$("#document_tbl tbody tr:last").find('.createBtn').show();
						// $("#document_tbl tbody tr:last").find('.del_file').hide();
						if($('#document_tbl tbody tr').length<=1){
							$('#document_tbl .del_file').hide();
							$('#document_tbl .createBtn').show();
						}
						alert('Contact Deleted.');
					}
				}          
			});
		}
	} else {
		$(thisRow).remove();
		
		if($('#document_tbl tbody tr').length<=1){
			$('#document_tbl .del_file').hide();
			$('#document_tbl .createBtn').show();
		}
	}
	$("#document_tbl tbody tr").each(function(){
		$("#document_tbl tbody tr:last").find('.createBtn').show();
	})
});


$("#document_tbl tbody tr").each(function(){
	$("#document_tbl tbody tr:last").find('.createBtn').show();
});
if($('#document_tbl tbody tr').length<=1){
	$('#document_tbl .del_file').hide();
	$('#document_tbl .createBtn').show();
}
function validate_customer()
{
	var err 	  = true;
	var empty_err = true;
	var cmpy_err  = true;
	var entity = $("#entity").val();
	var registered_flag = $(".registered_flag:checked").val();
	var group = $("#group").val();
	// var address = $("#address_id").val();
	var sap_status = $("#sap_status").val();
	
var url      = window.location.href;
var segments = url.split( '/' );
console.log(segments['6']);
console.log("url");

// if(segments['6'] =='update' && (sap_status =='SAP' || sap_status=='Rejected')){
//     if(entity==1 && group==100 ){
        
//         if($('#pan_number').val()=='') {
//             $('#pan_number_err_msg').html('<span class="ajx_failure_msg">Pan Number is  Required</span>');
//             empty_err = false;
//         }else{
//             $('#pan_num_err').hide();
//             var pan = validatePanNumber($('#pan_number').val());
//             console.log(pan);
//         }
//     }else{
//         $('#pan_number_err_msg').html('');
//     }
    
// }
	
	if($('#entity').val()=="") {
		$("#entity_err").html("<span class='ajx_failure_msg'>Entity is Required</span>");
		empty_err = false;
	}
	if(entity==1 && group ==100){ 	
		if(registered_flag == undefined || registered_flag == '') {
			$("#registered_err").html("<span class='ajx_failure_msg'>Select Yes / No</span>");
			empty_err = false;
		}else{
			$("#registered_err").html("");
		}
   }

	if($('#group').val()=='0') {
		$('#group_err').html('<span class="ajx_failure_msg">Group Name is  Required</span>');
		empty_err = false;
	}

	if(entity==1 && group==100 && registered_flag == 'Yes'){
		
		if($('#pan_number').val()=='') {
			$('#pan_number_err_msg').html('<span class="ajx_failure_msg">Pan Number is  Required</span>');
			empty_err = false;
		}else{
			$('#pan_num_err').hide();
			var pan = validatePanNumber($('#pan_number').val());
			console.log(pan);
		}
	}else{
		$('#pan_number_err_msg').html('');
	}

	/*if(entity==1 && group==100 ){
		
		if($('#pan_number').val()=='') {
			$('#pan_number_err_msg').html('<span class="ajx_failure_msg">Pan Number is  Required</span>');
			empty_err = false;
		}else{
			$('#pan_num_err').hide();
			var pan = validatePanNumber($('#pan_number').val());
			console.log(pan);
		}
	}else{
		$('#pan_number_err_msg').html('');
	}*/	

	if($('#company').val()=="") {
		$("#company_err_in").html("<span class='ajx_failure_msg'>Company is Required</span>");
		empty_err = false;
	}

	
		var cont = $("#accrd_contact").val();
		// for (var i = 0; i <= address; i++){
    $(".address_id_validation").each(function() {
      address = $(this).val();
      country = $('#add1_country_'+address).val();
      console.log('Address - country -'+country+' - '+address);
      $("#add"+address+"_postcode_err").html("");
      
        if($('.add'+address+'_type').val()=="") {
            $("#add"+address+"_err").html("Address Type is Required");
            empty_err = false;
        }
                        if($('.add'+address+'_street').val()=="") {
				$("#add"+address+"_street_err").html("Street is Required");
				empty_err = false;
			}                        
			if($('.add'+address+'_postcode').val()=="") {
				$("#add"+address+"_postcode_err").html("Zipcode is Required");
				empty_err = false;
			}
                        
                        if (/\s/.test($('.add'+address+'_postcode').val())) {
                            $("#add"+address+"_postcode_err").html("Please enter Zipcode without any Space");
                            empty_err = false;
                        }
			/*if(country!=18){
				if($('.add'+address+'_block').val()=="") {
					$("#add"+address+"_block_err").html("Block is Required");
					empty_err = false;
				}
			}	
			if($('.add'+address+'_postcode').val()=="") {
				$("#add"+address+"_postcode_err").html("Postcode is Required");
				empty_err = false;
			}*/
			if($('#add1_region_'+address).val()=="") {
				$("#add"+address+"_region_err").html("Region is Required");
				empty_err = false;
			}
			if($('#add1_country_'+address).val()=="") {
				$("#add"+address+"_country_err").html("Country is Required");
				empty_err = false;
			}
			if(country !=17 || country !=16){
				if($('#add1_state_'+address).val()=="") {
					$("#add"+address+"_state_err").html("State is Required");
					empty_err = false;
				}
				if($('#add1_location_'+address).val()=="") {
					$("#add"+address+"_city_err").html("City is Required");
					empty_err = false;
				}
			}

			if(entity == "1" && country== "15" && group== "100" && registered_flag == 'Yes'){
				// alert("gg1111");
				if($('#gst_type_'+address).val()=="") {
          $("#add"+address+"_gst_err").show();
					$("#add"+address+"_gst_err").html("GST Type is Required");
					empty_err = false;
				}else{
          $("#add"+address+"_gst_err").html("");
        }
			}else{
				$("#add"+address+"_gst_err").html("");
				$("#add"+address+"_gst_err").hide();
        $("#status_id"+address).html("");
			}
			
			if(entity == "1" && country == "15" && group== "100" && registered_flag == 'Yes'){
				// alert("gg1111");
				if($('#gstn_'+address).val()=="") {
					$("#add"+address+"_gstn_err").html("Gstn is Required");
					empty_err = false;
				}
			}else{
				$("#add"+address+"_gstn_err").html("");
			}
      
      
			if(entity == "1" && country == "15" && group == "100" && registered_flag == 'Yes'){
				var state_code = $("#add1_state_"+address).val();
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
				
	
				var pan = $("#pan_number").val();
				var gst_in_value  = state_code_id+pan;
				value =$('#gstn_'+address).val();
				var gstn_Val = value;
        if(gst_in_value != gstn_Val.substr(0, 12)){
          console.log(entity+' '+ country +' '+ group+' '+registered_flag);
					document.getElementById("status_id"+address).innerHTML = "Enter valid state for GSTIN.";
					$("#add"+address+"_gstn_err").hide();
					empty_err = false;
				}else if(gstn_Val.length !=15){ // 15 < 16
					console.log(gstn_Val.length);
					console.log("ggsdsd");
					document.getElementById("status_id"+address).innerHTML = "Enter 15  gstn number.";
					$("#add"+address+"_gstn_err").hide();
					empty_err = false;
				}else{
					document.getElementById("status_id"+address).innerHTML = '';
					$("#add"+address+"_gstn_err").hide();
				}
			}
			
			/*if(entity == 1 && country==15 && group==100 ){
				// alert("gg1111");
				if($('#gstn_'+address).val()=="") {
					$("#add"+address+"_gstn_err").html("Gstn is Required");
					empty_err = false;
				}
			}*/
			
			
			var url      = window.location.href;
			var segments = url.split( '/' );
			if(segments[7]){
				var id =segments[7];
			}else{
				var id ='';
			}
			if(empty_err==true && id ==''){
				if($('#accrd_contact').val()==0 ){
					 alert("please add contact details");
					empty_err = false;
					
				}
				
				$(".acc2").click();
				//$(".add_contact_button").trigger('click');		
				if($('#first_name_'+address).val()=="") {
					$("#first_name_"+address+"_err").html("First name is Required");
	
					empty_err = false;
				}
				if($('#last_name_'+address).val()=="") {
					$("#last_name_"+address+"_err").html("Last name is Required");
	
					empty_err = false;
				}
			   if($('#last_name'+address).val()=="") {
					$("#last_name"+address+"_err").html("Last name is Required");
					empty_err = false;
				}
				if($('#email'+address).val()=="") {
					$("#email"+address+"_err").html("Email is Required");
					empty_err = false;
				}
				
				
			}

			
			
			
			
			
				
			});

	
	if(($('#add1_region').val()==0) && ($('#add1_country').val()==0) && ($('#add1_state').val()==0) && ($('#add1_location').val()==0) && $('#company').val()==""){
		return false;
	} else {
		//validate company name
		var params					= {};
		params[csrf_token_name] 	= csrf_hash_token;
		params['entity']		= $('#entity').val();
		params['company_name']		= $('#company').val();
		params['add1_region'] 		= $('#add1_region').val();
		params['add1_country'] 		= $('#add1_country').val();
		params['add1_state'] 		= $('#add1_state').val();
		params['add1_location']		= $('#add1_location').val();
		params['company_id']		= $('#companyid').val();
	//	console.log(url_segment[4]);
	//	if($('#companyid').val() !=''){
			$.ajax({
				async: false,
				type: "POST",
				url : site_base_url + 'customers/check_company/',
				cache : false,
				data : params,
				success : function(response){
					if(response == 'userNo') {
						cmpy_err = false;
						$("#company_err").html("<span class='ajx_failure_msg'>The Company Already Exists</span>");
						return false;
					} else {
						// $("#positiveBtn").removeAttr("disabled");
						$("#company_err").html("");
						return false;
					}
				}
			});
		//}	
	}	

	
	//First Name
	$('.first_name').each(function(){
		if($(this).val()=="")
		{
			$(this).closest('tr').find('.first_name_err_msg').html("This field is required");
			err=false;
		}else{
			$(this).closest('tr').find('.first_name_err_msg').html(" ");
		}
	});

	$('.last_name').each(function(){
		if($(this).val()=="")
		{
			$(this).closest('tr').find('.last_name_err_msg').html("This field is required");
			err=false;
		}else{
			$(this).closest('tr').find('.last_name_err_msg').html(" ");
		}
	});
	
	//First Name
	$('.email').each(function(){
		if($(this).val()=="")
		{
			$(this).closest('tr').find('.email_err_msg').html("This field is required");
			err=false;
		}else{
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var emailres = regex.test($(this).val());
			if(!emailres){
				err = false;
				$(this).closest('tr').find('.email_err_msg').html("Not a vaild email");
			} else {
				$(this).closest('tr').find('.email_err_msg').html(" ");
			}
		}
	});
	
	//for phone no
	/* $('.phone').each(function(){
		if($(this).val()=="")
		{
			$(this).closest('tr').find('.phone_err_msg').html("This field is required");
			err=false;
		}else{
			$(this).closest('tr').find('.phone_err_msg').html(" ");
		}
	}); */
	
	//valid phone no validation
	$('.phone').each(function(){
		if($(this).val()!="")
		{
			var regex = /^(?=.*[0-9])[- +()0-9]+$/;
			var phoneres = regex.test($(this).val());
			if(!phoneres){
				err = false;
				$(this).closest('tr').find('.phone_err_msg').html("Not a vaild phone no");
			} else {
				$(this).closest('tr').find('.phone_err_msg').html(" ");
			}
		}
		else
		{
			$(this).closest('tr').find('.phone_err_msg').html(" ");
		}
	});

	if(false == empty_err) {
		return false;
	}
	if(false == cmpy_err) {
		return false;
	}
	
	if(err == true) {
		// alert("here sumit");
		$('#formone').submit();
	} else if(err == false) {
		return false;
	}
}

function validatePanNumber(panNum){
	var entity = $("#entity").val();
	var group = $("#group").val();
	if(entity==1 && group==100 ){
	
		var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
		if(regpan.test(panNum) == false)
		{
			$('#pan_number_err_msg').hide();
			document.getElementById("status").innerHTML = "PAN is not yet valid.";

		}else{
			document.getElementById("status").innerHTML ='';
			return '1';
		}
	}	
	
}


	

$(".errormsg").keyup(function(){

	//var pan = validatePanNumber($('#pan_number').val());
	
	
	var entity = $("#entity").val();
	var group = $("#group").val();
	// if($('#group').val()=='') {
	// 	$('#group').html('<span class="ajx_failure_msg">Group Name is  Required</span>');
	// 	empty_err = false;
	// }else{
	// 	$('#group').html('');
	// }

	/*if(entity==1 && group==100 ){

		if($('#pan_number').val()=='') {
			$('#pan_number_err_msg').html('<span class="ajx_failure_msg">Pan Number is  Required</span>');
			empty_err = false;
		}else{
				$('#pan_number_err_msg').html('');
			}
	}else{
			$('#pan_number_err_msg').html('');
		}	*/

	if($('#company').val()=="") {
		$("#company_err_in").html("<span class='ajx_failure_msg'>Company is Required</span>");
		empty_err = false;
	}else{
		$("#company_err_in").html('');
	}

	

	
	
			
   
 });
 $('select').on('change', function() {  
	if($('#entity').val()=="") {
		
		$("#entity_err").html("<span class='ajx_failure_msg'>Entity is Required</span>");
		empty_err = false;
	}else{
		$("#entity_err").html('');

		
	}
	if($('#group').val()=="0") {
		
		$("#group").html("<span class='ajx_failure_msg'>Group is Required</span>");
		empty_err = false;
	}else{
		$("#group_err").html('');
	}	

 });	

 function invoiceDataTable(){
	$('.customer_invoice').dataTable( {
		"iDisplayLength": 10,
		"sPaginationType": "full_numbers",
		"bInfo": true,
		"bPaginate": true,
		"bProcessing": true,
		"bServerSide": false,
		"bLengthChange": false,
		"bSort": true,
		"bFilter": true,
		"bAutoWidth": false,
        "bDestroy": true,
		"oLanguage": {
		  "sEmptyTable": "No Comments Found..."
		}
	});
}
function customerDataTable(){
	$('.customer-leads').dataTable( {
		"iDisplayLength": 10,
		"sPaginationType": "full_numbers",
		"bInfo": true,
		"bPaginate": true,
		"bProcessing": true,
		"bServerSide": false,
		"bLengthChange": false,
		"bSort": true,
		"bFilter": true,
		"bAutoWidth": false,
        "bDestroy": true,
		"oLanguage": {
		  "sEmptyTable": "No Comments Found..."
		}
	});
}

function projectFileDataTable(){
	$('.projects-leads_file').dataTable( {
		"iDisplayLength": 10,
		"sPaginationType": "full_numbers",
		"bInfo": true,
		"bPaginate": true,
		"bProcessing": true,
		"bServerSide": false,
		"bLengthChange": false,
		"bSort": true,
		"bFilter": true,
		"bAutoWidth": false,
        "bDestroy": true,
		"oLanguage": {
		  "sEmptyTable": "No Comments Found..."
		}
	});
}

function sameAsAddress(address_id) {
  add_type = $('.add'+address_id+'_type').val()
  if(add_type == 'bill_new'){
    text = "Sipping Address is same as Billing Address";
  }
  if(add_type == 'ship_new'){
    text = "Billing Address is same as Sipping Address";
  }
  if(add_type){
    $('#sameAddressCheck'+address_id).show()
    $('#sameAddressText'+address_id).html(text)
  }
    
}

function sameAsAddressCheck(address_id) {
  if($('#sameAddressCheckBox'+address_id).prop("checked") == true){
    $('#sameAddressCheckBox'+address_id).val(1);
  }else{
    $('#sameAddressCheckBox'+address_id).val(0);
  }
}


/////////////////
