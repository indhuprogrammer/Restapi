
$(function(){
  $('.header_project').nextUntil('tr.header').slideToggle(100);
  $('.header_project').click(function(){
     $(this).find('span').html(function(_, value){return value=='<img src="assets/img/collapse.gif">'?'<img src="assets/img/expand.gif">':'<img src="assets/img/collapse.gif">'});
      $(this).nextUntil('tr.header').slideToggle(100, function(){
      });
  });
  $('.remove_cc').click(function(){
    arr = $(this).attr("val");
    if($('.cc_grid').length > 1){
      $('.cc_div_'+arr).remove();
    }
  });
  $('.add_cc').click(function(){
    $.ajax({
         url: "project_approval/addCostCenterView",
         data: {'entity': entity},
         type: "GET",
         success: function(data) { 
            $(".cc_grid:last").after(data);
         }
       });
  });  
  var config = {
		'.chzn-select'           : {},
		'.chzn-select-deselect'  : {allow_single_deselect:true},
		'.chzn-select-no-single' : {disable_search_threshold:10},
		'.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chzn-select-width'     : {width:"350px"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
  industry_type_arr = ["cost_center",
          "customer_industry_practice_parent",
          "existing_or_new_customer",
          "existing_or_new_line_of_business",
          "existing_or_new_projects",
          "growth_engines",
          "industry_practice_child",
          "operating_model",
          "revenue_model",
          "service_practice_child",
          "service_practice_parent",
          "tds",
          "tax_code"
        ];
  // to remove the required field alert if filled
  $.each(industry_type_arr , function(index, val) { 
        $("."+val).each(function() {
          $("."+val).chosen().change(function(e, params){
            if($(this).val() == ''){
              $(this).nextAll(".ajx_failure_msg").html('This field is required');
            }else{
              $(this).nextAll(".ajx_failure_msg").html('');
            }
          });
        });
  });
  
	//To assign list of default values ->start
  $("#actual_gl_account").chosen().change(function(e, params){
    $("#actual_gl_account_default").empty().trigger("liszt:updated");
    if($("#actual_gl_account option:selected").length == 0){
      $('#actual_gl_account_error').html('This field is required');
    }else{
      $('#actual_gl_account_error').html('');
    }
    actual_gl_account_default();
  });
  $("#provisional_gl_account").chosen().change(function(e, params){
    $("#provisional_gl_account_default").empty().trigger("liszt:updated");
    if($("#provisional_gl_account option:selected").length == 0){
      $('#provisional_gl_account_error').html('This field is required');
    }else{
      $('#provisional_gl_account_error').html('');
    }
    provisional_gl_account_default();
  });
  $("#actual_sac").chosen().change(function(e, params){
    $("#actual_sac_default").empty().trigger("liszt:updated");
    if($("#actual_sac option:selected").length == 0){
      $('#actual_sac_error').html('This field is required');
    }else{
      $('#actual_sac_error').html('');
    }
    actual_sac_default();
  });
  $("#provisional_sac").chosen().change(function(e, params){
    $("#provisional_sac_default").empty().trigger("liszt:updated");
    if($("#provisional_sac option:selected").length == 0){
       $('#provisional_sac_error').html('This field is required');
     }else{
       $('#provisional_sac_error').html('');
     }
    provisional_sac_default();
  });
  $("#actual_location").chosen().change(function(e, params){
    $("#actual_location_default").empty().trigger("liszt:updated");
    if($("#actual_location option:selected").length == 0){
    $('#actual_location_error').html('This field is required');
    }else{
      $('#actual_location_error').html('');
    }
    actual_location_default();
  });
  $("#provisional_location").chosen().change(function(e, params){
    $("#provisional_location_default").empty().trigger("liszt:updated");
    if($("#provisional_location option:selected").length == 0){
      $('#provisional_location_error').html('This field is required');
    }else{
      $('#provisional_location_error').html('');
    }
    provisional_location_default();
  });
	//To assign list of default values ->end

});

function actual_gl_account_default() {
  $("#actual_gl_account option:selected").each(function () {
    var $this = $(this);
    if ($this.length) {
      var text = $this.text();
      var val = $this.val();
      $("#actual_gl_account_default").append('<option value='+val+'>'+text+'</option>').trigger('liszt:updated');
    }
  });
}

function provisional_gl_account_default() {
  $("#provisional_gl_account option:selected").each(function () {
    var $this = $(this);
    if ($this.length) {
      var text = $this.text();
      var val = $this.val();
      $("#provisional_gl_account_default").append('<option value='+val+'>'+text+'</option>').trigger('liszt:updated');
      
    }
  });
}

function actual_sac_default() {
  $("#actual_sac option:selected").each(function () {
    var $this = $(this);
    if ($this.length) {
      var text = $this.text();
      var val = $this.val();
      $("#actual_sac_default").append('<option value='+val+'>'+text+'</option>').trigger('liszt:updated');
      
    }
  });
}

function provisional_sac_default() {
  $("#provisional_sac option:selected").each(function () {
    var $this = $(this);
    if ($this.length) {
      var text = $this.text();
      var val = $this.val();
      $("#provisional_sac_default").append('<option value='+val+'>'+text+'</option>').trigger('liszt:updated');
      
    }
  });
}

function actual_location_default() {
  $("#actual_location option:selected").each(function () {
    var $this = $(this);
    if ($this.length) {
      var text = $this.text();
      var val = $this.val();
      $("#actual_location_default").append('<option value='+val+'>'+text+'</option>').trigger('liszt:updated');
      
    }
  });
}

function provisional_location_default() {
  $("#provisional_location option:selected").each(function () {
    var $this = $(this);
    if ($this.length) {
      var text = $this.text();
      var val = $this.val();
      $("#provisional_location_default").append('<option value='+val+'>'+text+'</option>').trigger('liszt:updated');
      
    }
  });
}

//To assign value to project approval form -->Start
var actual_gl_account = [];
var provisional_gl_account = [];
var actual_sac = [];
var provisional_sac = [];
var actual_location = [];
var provisional_location = [];
var actual_gl_account_default_v = '';
var provisional_gl_account_default_v = '';
var actual_sac_default_v = '';
var provisional_sac_default_v = '';
var actual_location_default_v = '';
var provisional_location_default_v = '';
var tds_v = '';
var tax_code_v = '';
var item_location_v = '';
$.each( pm_fields, function( key, value ) {
  //Gl account
  if(value['invoice_type'] == "actual" && value['pm_approval_field'] == "gl_account" ){
    actual_gl_account.push(value['pm_approval_value']);
    if(value['default_value'] == 'Yes'){
      actual_gl_account_default_v = value['pm_approval_value'];
    }
  }
  if(value['invoice_type'] == "provisional" && value['pm_approval_field'] == "gl_account" ){
    provisional_gl_account.push(value['pm_approval_value']);
    if(value['default_value'] == 'Yes'){
      provisional_gl_account_default_v = value['pm_approval_value'];
    }
  }
  //SAC
  if(value['invoice_type'] == "actual" && value['pm_approval_field'] == "sac" ){
    actual_sac.push(value['pm_approval_value']);
    if(value['default_value'] == 'Yes'){
      actual_sac_default_v = value['pm_approval_value'];
    }
  }
  if(value['invoice_type'] == "provisional" && value['pm_approval_field'] == "sac" ){
    provisional_sac.push(value['pm_approval_value']);
    if(value['default_value'] == 'Yes'){
      provisional_sac_default_v = value['pm_approval_value'];
    }
  }
  //Location
  if(value['invoice_type'] == "actual" && value['pm_approval_field'] == "location" ){
    actual_location.push(value['pm_approval_value']);
    if(value['default_value'] == 'Yes'){
      actual_location_default_v = value['pm_approval_value'];
    }
  }
  if(value['invoice_type'] == "provisional" && value['pm_approval_field'] == "location" ){
    provisional_location.push(value['pm_approval_value']);
    if(value['default_value'] == 'Yes'){
      provisional_location_default_v = value['pm_approval_value'];
    }
  }
  
  //TDS
  if(value['invoice_type'] == "Both" && value['pm_approval_field'] == "tds" ){
    if(value['default_value'] == 'Yes'){
      tds_v = value['pm_approval_value'];
    }
  }
  //Tax Code
  if(value['invoice_type'] == "Both" && value['pm_approval_field'] == "tax_code" ){
    if(value['default_value'] == 'Yes'){
      tax_code_v = value['pm_approval_value'];
    }
  }
  //Item Location
  if(value['invoice_type'] == "Both" && value['pm_approval_field'] == "item_location" ){
    if(value['default_value'] == 'Yes'){
      item_location_v = value['pm_approval_value'];
    }
  }
});
$('#actual_gl_account').val(actual_gl_account).trigger('chosen:updated');
actual_gl_account_default();
$('#actual_gl_account_default').val(actual_gl_account_default_v).trigger('chosen:updated');

$('#provisional_gl_account').val(provisional_gl_account).trigger('chosen:updated');
provisional_gl_account_default();
$('#provisional_gl_account_default').val(provisional_gl_account_default_v).trigger('chosen:updated');

$('#actual_sac').val(actual_sac).trigger('chosen:updated');
actual_sac_default();
$('#actual_sac_default').val(actual_sac_default_v).trigger('chosen:updated');

$('#provisional_sac').val(provisional_sac).trigger('chosen:updated');
provisional_sac_default();
$('#provisional_sac_default').val(provisional_sac_default_v).trigger('chosen:updated');

$('#actual_location').val(actual_location).trigger('chosen:updated');
actual_location_default();
$('#actual_location_default').val(actual_location_default_v).trigger('chosen:updated');

$('#provisional_location').val(provisional_location).trigger('chosen:updated');
provisional_location_default();
$('#provisional_location_default').val(provisional_location_default_v).trigger('chosen:updated');

$('#tds').val(tds_v).trigger('chosen:updated');
$('#tax_code').val(tax_code_v).trigger('chosen:updated');
$('#item_location').val(item_location_v).trigger('chosen:updated');
//To assign value to project approval form -->End -- >>


//Form Submission
function SubmitButton(approver, action){
    $('#submit_status').val(action);
    var remarks = $(".remarks").val();
  
   if(action =="Approved"){
        res = fieldValidation();
        if(res==true){
          $.blockUI({
          message:'<br /><h5>Are You Sure Want to Approve?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="formSubmissionDecision(\''+approver+'\',\''+action+'\'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" style="margin-left: 6px;" onclick="cancelDel(); return false;">No</button></div></div>', css: {zIndex:'999999999'}
          });
        }else{
          $.blockUI({
          message:'<br /><h5>Please fill all the required fields.</h5> <div class="modal-confirmation overflow-hidden"> <div class="buttons"><button type="submit" class="negative" style="margin-left: 6px;" onclick="cancelDel(); return false;">Ok</button></div></div>', css: {zIndex:'999999999'}
          });
        }
    }else if(action == "Rejected" && remarks == ""){
            $('#remarks_error').html('Remark is required.');
    }else{
      $('#remarks_error').html('');
      $.blockUI({
      message:'<br /><h5>Are You Sure Want to Refer back?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="formSubmissionDecision(\''+approver+',\''+action+'\'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" style="margin-left: 6px;" onclick="cancelDel(); return false;">No</button></div></div>', css: {zIndex:'999999999'}
      });        
    }
    
}

//To Decide which function to trigger based on approver and action
function formSubmissionDecision(approver, action) {
  $.blockUI({
      message:'<h4 style="color: white;  margin-top: 2px;">Processing</h4><img src="assets/img/ajax-loader.gif" />',
      css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333',zIndex:'999999999'}
    });
  
  formSubmission();
  return false;
  /* Not Required */
  // if(approver == 1){
  //   formSubmission();
  // }
  // if(approver == 2 && action == 'Approved'){
  //   PushToSap();
  // }
  // if(approver == 2 && action != 'Approved'){
  // }
}


function formSubmission() {
  
  var datastring = $("#frm").serialize();
  var url = site_base_url+'project_approval/approver_submission';
  $.ajax({
      type: "POST",
      url: url,
      data: datastring,
      dataType: "json",
      success: function(data) {
          window.location.href = site_base_url+data.url;
          $.unblockUI();
          return false;
      },
      error: function() {
          alert('error handling here');
      }
  });
}

function cancelDel(){
	$.unblockUI();
}

/* Field validation for form submission - Start */
function fieldValidation() {
  msg = "This field is required";
  flag = true;
		
  industry_type_arr = ["cost_center",
          "customer_industry_practice_parent",
          "existing_or_new_customer",
          "existing_or_new_line_of_business",
          "existing_or_new_projects",
          "growth_engines",
          "industry_practice_child",
          "operating_model",
          "revenue_model",
          "service_practice_child",
          "service_practice_parent",
          "tds",
          "tax_code",
          "item_location"
        ];
  $.each(industry_type_arr , function(index, val) { 
        $("."+val).each(function() {
          if($(this).val() == ''){
            $(this).nextAll(".ajx_failure_msg").html(msg);
            flag = false;
          }else{
            $(this).nextAll(".ajx_failure_msg").html('');
          }
        });
  });

	//Sac only for india entity
	if(entity == 1){
			// Sac validation - Actual
			if($("#actual_sac option:selected").length == 0){
		    $('#actual_sac_error').html(msg);
		    flag = false;
		  }else{
		    $('#actual_sac_error').html('');
		  }
		  if($('#actual_sac_default').val() == ''){
		    $('#actual_sac_default_error').html(msg);
		    flag = false;
		  }else{
		    $('#actual_sac_default_error').html('');
		  }
			//Sac validation - Provisional
		  if($("#provisional_sac option:selected").length == 0){
		    $('#provisional_sac_error').html(msg);
		    flag = false;
		  }else{
		    $('#provisional_sac_error').html('');
		  }
		  if($('#provisional_sac_default').val() == ''){
		    $('#provisional_sac_default_error').html(msg);
		    flag = false;
		  }else{
		    $('#provisional_sac_default_error').html('');
		  }
	}
	
	//Location validation  - actual
	if($("#actual_location option:selected").length == 0){
    $('#actual_location_error').html(msg);
    flag = false;
  }else{
    $('#actual_location_error').html('');
  }
  if($('#actual_location_default').val() == ''){
    $('#actual_location_default_error').html(msg);
    flag = false;
  }else{
    $('#actual_location_default_error').html('');
  }
	//Location validation - Provisional
  if($("#provisional_location option:selected").length == 0){
    $('#provisional_location_error').html(msg);
    flag = false;
  }else{
    $('#provisional_location_error').html('');
  }
  if($('#provisional_location_default').val() == ''){
    $('#provisional_location_default_error').html(msg);
    flag = false;
  }else{
    $('#provisional_location_default_error').html('');
  }

	//Gl account validation - Actual
  if($("#actual_gl_account option:selected").length == 0){
    $('#actual_gl_account_error').html(msg);
    flag = false;
  }else{
    $('#actual_gl_account_error').html('');
  }
  if($('#actual_gl_account_default').val() == ''){
    $('#actual_gl_account_default_error').html(msg);
    flag = false;
  }else{
    $('#actual_gl_account_default_error').html('');
  }
	
	//Gl account validation - provisional
  if($("#provisional_gl_account option:selected").length == 0){
    $('#provisional_gl_account_error').html(msg);
    flag = false;
  }else{
    $('#provisional_gl_account_error').html('');
  }
  if($('#provisional_gl_account_default').val() == ''){
    $('#provisional_gl_account_default_error').html(msg);
    flag = false;
  }else{
    $('#provisional_gl_account_default_error').html('');
  }
  
  return flag;
}
