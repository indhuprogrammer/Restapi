/*
 *@Customer List Jquery
 *@Customer Module
*/

//ajax - check status
function checkStatus(id) {
	var formdata = { 'data':id }
	formdata[csrf_token_name] = csrf_hash_token;
	$.ajax({
		async: false,
		type: "POST",
		url: site_base_url+'customers/ajax_chk_status_customer/',
		dataType:"json",                                                                
		data: formdata,
		cache: false,
		beforeSend:function() {
			$('#dialog-err-msg').empty();
		},
		success: function(response) {
			if (response.html == 'NO') {
				$('#dialog-err-msg').show();
				$('#dialog-err-msg').append('One or more Leads currently mapped to this customer. This cannot be deleted.');
				$('html, body').animate({ scrollTop: $('#dialog-err-msg').offset().top }, 500);
				setTimeout('timerfadeout()', 4000);
			} else {
				$.blockUI({
					message:'<br /><h5>Are You Sure Want to Delete this Customer?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="processDelete('+id+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
					css:{width:'440px'}
				});
			}
		}          
	});
return false;
}
//Ajax assign account manager to company customer
function assign_account_manager() {
	$('#dialog-err-msg').empty();
	var error=0;
	if($("#accountmanager").val()==''){
		error=1;
		$('#dialog-err-msg').show();
		$('#dialog-err-msg').append('Please Select Account Manager!.');
		$('html, body').animate({ scrollTop: $('#dialog-err-msg').offset().top }, 500);
		setTimeout('timerfadeout()', 4000);
	}

	if($("input[name='cust_id[]']:checked").length==0){
	
	$('#dialog-err-msg').show();
	if(error==1){
	$('#dialog-err-msg').append('<br/>Please choose company which one you want assign Account Manager!.');
	}
	else{
	$('#dialog-err-msg').append('Please choose company which one you want assign Account Manager!.');
	}
	error=1;
	$('html, body').animate({ scrollTop: $('#dialog-err-msg').offset().top }, 500);
	setTimeout('timerfadeout()', 4000);
}

if(error==0){
	var cust_ids=$("input[name='cust_id[]']:checked").map(function(i, e) {return e.value}).toArray();
	var formdata = { 'acid':$("#accountmanager").val(),'cust_ids':cust_ids}
	formdata[csrf_token_name] = csrf_hash_token;
	$.ajax({
		async: false,
		type: "POST",
		url: site_base_url+'customers/ajax_assign_accountmanager/',
		dataType:"json",                                                                
		data: formdata,
		cache: false,
		beforeSend:function() {
			$('#dialog-err-msg').empty();
		},
		success: function(response) {
		$('.acid').each(function() { //iterate
		this.checked = false; //clear checkbox
		});
			location.reload();
		}          
	});
}
return false;
}

function timerfadeout() {
	$('.dialog-err').fadeOut();
}

function processDelete(id) {
	window.location.href = 'customers/delete_customer/'+id;
}

function cancelDel() {
    $.unblockUI();
}


if (document.getElementById('advance_search_cus'))
document.getElementById('advance_search_cus').style.display = 'none';

function advanced_filter_cus(){
	$('#advance_search_cus').slideToggle('slow');
	var keyword = $("#keywordpjt").val();
	var status  = document.getElementById('advance_search_cus').style.display;
	
	
}

$('#filter_reset').click(function() {
	$('.advfilter option').removeAttr('selected');
});

function customerDownload(){
	var export_inv_type = $("#val_export").val();
	var url = site_base_url+"customers/downloadCustomers/";
	var entity    = $("#cus_entity").val();
	var isClient     = $("#cus_isClient").val();
	var status     = $("#cus_status").val();
	var region     = $("#cus_region").val();
	var aging_report     = $("#aging_report").val();
	var form = $('<form action="' + url + '" method="post">' +
	'<input id="token" type="hidden" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
	'<input id="company" type="hidden" name="entity" value="'+entity+'" />'+
	'<input id="company" type="hidden" name="isClient" value="'+isClient+'" />'+
	'<input id="region" type="hidden" name="region" value="'+region+'" />'+
	'<input id="search" type="hidden" name="search" value="'+export_inv_type+'" />'+
	'<input id="aging_report" type="hidden" name="page" value="'+aging_report+'" />'+
	'<input id="status" type="hidden" name="status" value="'+status+'" />'+ '" /></form>');
  $('body').append(form);
  $(form).submit();
  return false;
	// window.open(url,'_self');
	// return url;

}

// function searchDatatable() {
// 	$('#advance_customer_search').hide();
// 	var entity    = $("#cus_entity").val();
// 	var region    = $("#cus_region").val();
// 	var isClient     = $("#cus_isClient").val();
// 	var status     = $("#cus_status").val();
// 	$.ajax({
// 		type: "POST",	
// 		url: site_base_url+"customers/index/search",
// 		data: "filter=filter"+"&entity="+entity+"&status="+status+"&region="+region+"&isClient="+isClient+"&"+csrf_token_name+'='+csrf_hash_token,
// 		beforeSend:function(){
// 			$('#results').empty();
// 			$('#results').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
// 		},
// 		success: function(res) {
// 			$('#results').html(res);
// 			$('#load').hide();
// 			$('#advance_customer_search').show();
// 			$('#val_export').val('search');
// 		}
// 	});
// 	return false;  //stop the actual form post !important!


// };	

// $(document).ready(function(){
// 	myVar = setInterval("searchDatatable()", 300000);
// 	// clearTimeout(60000);
// });
/////////////////