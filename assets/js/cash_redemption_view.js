function advanced_filter() {
	$('#advance_search').slideToggle('slow');
}

$(document).ready(function(){
	// getEntity();
	$(".js_view_payment").click(function(){
		var exp_id = $(this).prop("rel");
		if(exp_id){
			$.ajax({
			  url: site_base_url+'invoice/show_payment_history/',
			  data: { expect_id: exp_id,csrf_token_name : csrf_hash_token},
			  success: function(data){
				if(data=='no_results'){
					alert("Invoice(s) not found for the selected customer!");
				}else{
						$.blockUI({
							message:data,
							css:{border: '2px solid #999', color:'#333',padding:'6px',top:'280px',left:($(window).width() - 775) /2+'px',width: '750px', position: 'absolute'},
							onOverlayClick: $.unblockUI 
							// focusInput: false 
						});	
				}
			  }
			});
			return false;			
		}
	})

	$("body").on("click",'.js_close',function(){
		$.unblockUI();
	})
})

function entity_search(id,type){
	
	if(type == 1){
		var divisions = id;
		 $("#divisions").val(divisions);
		var data = "filter=filter"+"&divisions="+divisions+"&type="+type+"&"+csrf_token_name+'='+csrf_hash_token;
	}else{
		var geography_ids = id;
		$("#geography_ids").val(geography_ids);
		var data = "filter=filter"+"&geography_ids="+geography_ids+"&type="+type+"&"+csrf_token_name+'='+csrf_hash_token;
	}
		$.ajax({
			type: "POST",	
			url: site_base_url+"cash_redemption/index/search",
			// dataType: "json",
			data: data,
		beforeSend:function(){
			$('#results').empty();
			$('#results').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
		},
		success: function(res) {
			$('#results').html(res);
			$('#load').hide();
			$('#search_advance').show();
			$('#save_advance').show();
			$('#val_export').val('search');
		}
	});
	return false;
}

// $('#advance_search').hide();

//For Advance Filters functionality.
// $("#advanceFiltersDash").submit(function() {
	$("#search_advance").click(function() {
		$('#search_advance').hide();
		$('#save_advance').hide();
		$('#load').show();
		var customer  = $("#customer").val();
		var divisions = $("#divisions").val();
		var over_due_receipts = $("#over_due_receipts").val();
		var project = $("#project").val();
		var duration = $("#duration").val();
		var type = $("#type").val();
		var pm = $("#pm").val();
		var sh = $("#sh").val();
		var geography_ids   = $("#geography_ids").val();
		var business_unit_id = $('#business_unit_id').val();
		var department_id = $('#department_id_fk').val();
		var practice = $('#practices').val();
		var receipt_from_date = $('#from_date').val();
		var receipt_to_date = $('#to_date').val();
		
			$.ajax({
				type: "POST",	
				url: site_base_url +"cash_redemption/index/search",
				// dataType: "json",
				data: "filter=filter" + "&customer=" + customer + "&divisions=" + divisions + "&over_due_receipts=" + over_due_receipts+"&geography_ids="+geography_ids+"&project="+project+"&duration="+duration+"&type="+type+"&pm="+pm+"&sh="+sh+"&"+"business_unit_id="+business_unit_id+'&department_id='+department_id+"&practice="+practice+"&"+csrf_token_name+'='+csrf_hash_token+'&receipt_from_date='+receipt_from_date+'&receipt_to_date='+receipt_to_date,
			beforeSend:function(){
				$('#results').empty();
				$('#results').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
			},
			success: function(res) {
				$('#results').html(res);
				$('#load').hide();
				$('#search_advance').show();
				$('#save_advance').show();
				$('#val_export').val('search');
			}
		});
		return false;  //stop the actual form post !important!
});



function save_cancel() {
	$.unblockUI();
}


$(function() {
	$('#from_date').datepicker({ 
		dateFormat: 'dd-mm-yy', 
		changeMonth: true, 
		changeYear: true, 
		onSelect: function(date) {
			if($('#to_date').val!='')
			{
				$('#to_date').val('');
			}
			var return_date = $('#from_date').val();
			$('#to_date').datepicker("option", "minDate", return_date);
		},
		beforeShow: function(input, inst) {
			/* if ((selDate = $(this).val()).length > 0) 
			{
				iYear = selDate.substring(selDate.length - 4, selDate.length);
				iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
				$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
			} */
			$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
		}
	});
	$('#to_date').datepicker({ 
		dateFormat: 'dd-mm-yy', 
		changeMonth: true, 
		changeYear: true,
		beforeShow: function(input, inst) {
			$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
		}
	});
	
	/* $('#from_date').datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, onSelect: function(date) {
		if($('#to_date').val!='')
		{
			$('#to_date').val('');
		}
		var return_date = $('#from_date').val();
		$('#to_date').datepicker("option", "minDate", return_date);
	}});
	$('#to_date').datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true }); */
	
	$( "#month_year_from_date, #month_year_to_date" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'MM yy',
		showButtonPanel: true,
		onClose: function(dateText, inst) {
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();         
			$(this).datepicker('setDate', new Date(year, month, 1));
		},
		beforeShow : function(input, inst) {
			if ((datestr = $(this).val()).length > 0) {
				year = datestr.substring(datestr.length-4, datestr.length);
				month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
				$(this).datepicker('setDate', new Date(year, month, 1));    
			}
				var other  = this.id  == "month_year_from_date" ? "#month_year_to_date" : "#month_year_from_date";
				var option = this.id == "month_year_from_date" ? "maxDate" : "minDate";        
			if ((selectedDate = $(other).val()).length > 0) {
				year = selectedDate.substring(selectedDate.length-4, selectedDate.length);
				month = jQuery.inArray(selectedDate.substring(0, selectedDate.length-5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker( "option", option, new Date(year, month, 1));
			}
			$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
		}
	});
	saveSearchDropDownScript();
	
	//$( ".set_default_search" ).on( "click", function() {
	$('.search-root').on('click', '.set_default_search', function() {
		var search_id = $( this ).val();
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: site_base_url+"dashboard/set_default_search/"+search_id+'/5',
			cache: false,
			data: "filter=filter&"+csrf_token_name+'='+csrf_hash_token,
			beforeSend:function(){
				$('.search-root').block({
					message:'<h4>Processing</h4><img src="assets/img/ajax-loader.gif />',
					css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333'}
				});
			},
			success: function(response){
				if(response.resu=='updated') {
					show_search_results(search_id);
				} else {
					alert('Not updated');
				}
				$('.search-root').unblock();
				$('.saved-search').hide();
			}
		});
	});
	
});

$('#inv_excel').click(function() {
	var export_inv_type = $("#val_export").val();
	
	if(!isNaN(export_inv_type)) {
		export_inv_type = 'number';
	}

	switch(export_inv_type) {
		case 'search':
		case 'no_search':
			var project = $("#project").val();
			var customer 	= $("#customer").val();
			var divisions = $("#divisions").val();
			var pm = $("#pm").val();
			var sh = $("#sh").val();
			var over_due_receipts = $('#over_due_receipts').val();
			
			var geography_ids   = $("#geography_ids").val();
			var dimension = $("#dimension").val();
			
			var type = $("#type").val();
			var cost_center = $("#cost_center").val();
			
			/** business unit search*/
			var business_unit_id = $('#business_unit_id').val();
			var department_id = $('#department_id_fk').val();
			var partice_id = $('#practices').val();
			// Receipt Filter
			var receipt_from_date = $('#from_date').val();
			var receipt_to_date = $('#to_date').val();

			
			var url = site_base_url +"cash_redemption/summary_report_Export";
			
			var form = $('<form action="' + url + '" method="post">' +
			  '<input id="token" type="hidden" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
			  '<input id="customer" type="hidden" name="customer" value="'+customer+'" />'+
			  '<input id="divisions" type="hidden" name="divisions" value="'+divisions+'" />'+
			  '<input id="dimension" type="hidden" name="dimension" value="'+dimension+'" />'+
			  '<input id="project" type="hidden" name="project" value="'+project+'" />'+
			  '<input id="cost_center" type="hidden" name="cost_center" value="'+cost_center+'" />'+
			  '<input id="type" type="hidden" name="type" value="'+type+'" />'+
			  '<input id="pm" type="hidden" name="pm" value="'+pm+'" />'+
			  '<input id="sh" type="hidden" name="sh" value="'+sh+'" />'+
			  '<input id="geography_ids" type="hidden" name="geography_ids" value="'+geography_ids+'" />'				  +'<input type="hidden" id="business_unit_id" name="business_unit_id" value="'+business_unit_id+'"/>'+
			  '<input id="department_id" type="hidden" name="department_id" value="'+department_id+'" />'+'<input id="practice" type="hidden" name="practice" value="'+partice_id+'" />'+'<input type="hidden" name="over_due_receipts" id="over_due_receipts" value="'+over_due_receipts+'" />'+'<input type="hidden" name="receipt_from_date" id="receipt_from_date" value="'+receipt_from_date+'" />'+'<input type="hidden" name="receipt_to_date" id="receipt_to_date" value="'+receipt_to_date+'" />'+
			  '</form>');
			$('body').append(form);
			$(form).submit();
			return false;
		break;
	}
});
function getGeography(){
	$('#type').val('2');
	$("#search_advance").trigger('click');
	
	$.ajax({
		type: "POST",
		url: site_base_url +"cash_redemption/get_geographys/",
		cache: false,
		data: csrf_token_name+'='+csrf_hash_token,
		beforeSend:function(){
			$('#it_service_summary_det').empty();
			$('#it_service_summary_det').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
		},
		
		success: function(response){
			// alert(response);
			$('#it_service_summary_det').empty();
			$("#it_service_summary_det").html(response);
		}
	});
	
}

function getEntity(){
	$('#type').val('1');
	$("#search_advance").trigger('click');
	
	$.ajax({
		type: "POST",
		url: site_base_url +"cash_redemption/get_sales_divisions/",
		cache: false,
		data: csrf_token_name+'='+csrf_hash_token,
		
		beforeSend:function(){
			$('#it_service_summary_det').empty();
			$('#it_service_summary_det').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
		},


		success: function(response){
			// alert(response);
			$('#it_service_summary_det').empty();
			$("#it_service_summary_det").html(response);
			//$('.it_service_summary_det_container').unblock();
		}
	});

}
$('#inv_download').click(function() {
	
	var export_inv_type = $("#val_export").val();
	
	if(!isNaN(export_inv_type)) {
		export_inv_type = 'number';
	}


	switch(export_inv_type) {
		case 'search':
		case 'no_search':
			var customer 	= $("#customer").val();
			var divisions = $("#divisions").val();
			var geography_ids   = $("#geography_ids").val();
			var dimension = $("#dimension").val();
			var project = $("#project").val();
			var type = $("#type").val();
			var cost_center = $("#cost_center").val();
			var pm = $("#pm").val();
			var sh = $("#sh").val();
			var url = site_base_url +"cash_redemption/soa_summary_report_pdf";
			
			var form = $('<form action="' + url + '" method="post">' +
			  '<input id="token" type="hidden" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
			  '<input id="customer" type="hidden" name="customer" value="'+customer+'" />'+
			  '<input id="divisions" type="hidden" name="divisions" value="'+divisions+'" />'+
			  '<input id="dimension" type="hidden" name="dimension" value="'+dimension+'" />'+
			  '<input id="project" type="hidden" name="project" value="'+project+'" />'+
			  '<input id="type" type="hidden" name="type" value="'+type+'" />'+
			  '<input id="pm" type="hidden" name="pm" value="'+pm+'" />'+
			  '<input id="sh" type="hidden" name="sh" value="'+sh+'" />'+
			  '<input id="cost_cener" type="hidden" name="cost_cener" value="'+cost_center+'" />'+
			  '<input id="geography_ids" type="hidden" name="geography_ids" value="'+geography_ids+'" /></form>');
			$('body').append(form);
			$(form).submit();
			return false;
		break;
	}
});
function saveSearchDropDownScript(){
/*for saved search - start*/
	$(".saved-search-head").click(function(){
		var X=$(this).attr('id');

		if(X==1) {
			$(".saved-search-criteria").hide();
			$(this).attr('id', '0');
		} else {
			$(".saved-search-criteria").show();
			$(this).attr('id', '1');
		}
	});

	//Mouseup textarea false
	$(".saved-search-criteria").mouseup(function() {
		return false
	});
	$(".saved-search-head").mouseup(function() {
		return false
	});

	//Textarea without editing.
	$(document).mouseup(function() {
		$(".saved-search-criteria").hide();
		$(".saved-search-head").attr('id', '');
	});
  
  /*for saved search - end*/
}

$('#divisions,#dimension').change(function() {
	var divisions = $("#divisions").val();
	var dimension =  $("#dimension").val();
	if(divisions !=null && dimension !=null ){
		loadCostCenter(divisions);
	}
	
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
  					$('#department_id_fk').html('<option value="">Please Select</option>'+data);
  					$('#department_id_fk').val($("#department_id_fk_hide").val());
  					$('#practices').html('<option value="">Please Select</option>');
  					$("#department_id_fk").trigger('change');
  				}			
  			});
  		}
  	});
  	$("#department_id_fk").change(function() {
  		department_id = $('#department_id_fk').val();
  	  business_unit_id = $('#business_unit_id').val();
  		if(department_id && business_unit_id){
  			$.ajax({
  				type: 'POST',
  				url: 'user/getPracticeByBUandDept',
  				data: 'department_id='+department_id+'&business_unit_id='+business_unit_id+'&'+csrf_token_name+'='+csrf_hash_token,
  				success:function(data){
  					$('#practices').html('<option value="">Please Select</option>'+data);
  					$('#practices').val($("#practice_hide").val());
  				}			
  			});
  		}
  	});
function loadCostCenter(divisions) {
	var cost_id 			= $("#dimension").val();
	var params 				= {'cost_id':cost_id,'divisions':divisions};
	params[csrf_token_name] = csrf_hash_token;
	$.post( 
		'dashboard/loadCostCenter/',
		params,
		function(data) {										
			if (data.error) {
				alert(data.errormsg);
			} else {
				$("select#cost_center").html(data);
			}
		}
	);
}
