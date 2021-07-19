<link rel="stylesheet" href="assets/css/chosen.css" type="text/css">
<link rel="stylesheet" href="assets/css/tagsinput.css" type="text/css">
<style>
	.bootstrap-tagsinput {
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  display: inline-block;
  padding: 4px 6px;
  color: #555;
  vertical-align: middle;
  border-radius: 4px;
  width: 407px;
  line-height: 22px;
  cursor: text;
}
body.onload-popup .blockPage.alertBox11
{
	overflow:hidden !important;
}

.bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0 6px;
  margin: 0;
  width: auto;
  max-width: inherit;
}
.bootstrap-tagsinput.form-control input::-moz-placeholder {
  color: #777;
  opacity: 1;
}
.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput input:focus {
  border: none;
  box-shadow: none;
}
.bootstrap-tagsinput .tag {
  margin-right: 2px;
  color: #fff;
}
.bootstrap-tagsinput .tag [data-role="remove"] {
  margin-left: 8px;
  cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
  content: "x";
  padding: 0px 2px;
}
.label-info {
    background-color: #4b6fb9;
}

.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 95%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
body.onload-popup {
    /* overflow: hidden; */
}
body.onload-popup .file-tabs-close-confirm-tab {
    right: 0;
    top: 5px;
}
body.onload-popup .blockPage {
	overflow-y: scroll !important;
	height: Calc(100vh - 60px);
}
select#client_mail{
height: 29px;
    background: #fff;
    border: 1px solid #aaa;
}	
span.close {
    width: 12px;
    height: 12px;
    display: inline-block;
    background: #d03535;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 12px;
}
div#Filelist span.close {
    color: #fff;
    opacity: 1;
    font-size: 10px;
    line-height: 12px;
    text-align: center;
    font-weight: normal;
    margin-top: 4px;
}
ul#imgList li {
    display: inline-block;
    margin-right: 10px;
}

ul#imgList li div {
    display: inline-block;
    margin-right: 5px;
}

ul#imgList p {
    padding: 0;
}

span.close {
    width: 12px;
    height: 12px;
    display: inline-block;
    background: #d03535;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 12px;
}
#files {
    margin: 21px 1px !important;
}


.bootstrap-tagsinput .tag{
    position: relative;  
    padding: 3px 5px 3px 5px;
    border: 1px solid #aaa;
    border-radius: 3px;
    background-color: #e4e4e4;
    background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
    background-image: -webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: -o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
    background-clip: padding-box;
    box-shadow: 0 0 2px white inset, 0 1px 0 rgba(0, 0, 0, 0.05);
    color: #333;
    line-height: 13px;
    cursor: default;
    font-size: 12px;
    font-family: Arial, Helvetica, sans-serif;
    font-weight:100;
}
#user_mail_val_chzn{
	width:420px!important;
}
#client_mail_chzn{
	width:420px!important;
}		
#content{
	background-color:#fff;
}
</style>



<div id="invoice_email" style="text-align:left;">
<div id="content" style="padding: 1px;">
<div class=" test-block">
			<form id="customer_detail_form" enctype="multipart/form-data" id="customer_detail_form" method="post" onsubmit="return false;">
			<input id="token" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" /> 
			    <?php  
                 $cus_email = $customer_email[0];
                 $users_email = $users_email;
                $rest_users = array_merge_recursive($cus_email, $users_email);
               
                // echo "<pre>";print_r($cus_email);exit;
                ?>
               
				<div id="msg"  style="display:none;color:green;text-align:center;">Mail Sent Successfully</div>
				<div class="email-list" style="margin-bottom:10px;">
					<label>To *:</label>
					<!-- <select  name="client_mail[]" data-role="tagsinput"   id="client_mail"  style="width:420px;">
						
                        <option value="<?php echo $cus_email['email_1'] ?>" selected><?php echo $cus_email['contactfirstname'] . ' ' . $cus_email['contactlastname']; ?></option>
					</select> -->
					<!-- <input type="text" name="client_mail[]" value="<?php echo $cus_email['email_1'] ?>" data-role="tagsinput"   id="client_mail"  style="width:420px;"> -->
					<select data-placeholder="Choose User..." name="client_mail[]"  multiple='multiple'  id="client_mail" class="chzn-select" style="width:420px;">
					<option value="<?php echo $cus_email['email_1'] ?>" selected><?php echo $cus_email['email_1'] ?></option>
						<?php
						foreach($users_email as $ua) {                
						?>
						
						<option value="<?php echo $ua['email']; ?>"><?php echo $ua['first_name'] . ' ' . $ua['last_name']; ?></option>
						<?php
						}
						
						?>
                        
					</select>
				<div style="color:red;text-align:center;margin-top:10px;" id="to_err"></div>
				<input type="hidden" name="mile_stone" value="<?php echo $milestone ?>">
				</div>
		
				<div>
				<label>Email(Cc) To:</label>	
				<select data-placeholder="Choose User..." name="user_mail[]"  multiple='multiple'  id="user_mail_val" class="chzn-select" style="width:420px;">
						<?php
						foreach($users_email as $ua) {
                             if($cus_email['email_1'] != $ua['email']){                    
						?>
						<option value="<?php echo 'email-log-'.$ua['email']; ?>"><?php echo $ua['first_name'] . ' ' . $ua['last_name']; ?></option>
						<?php
                         }
                        }
						?>
                        
					</select>
					<div style="color:red;text-align:center;margin-top:10px;" id="cc_err"></div>
				</div>
				</br>
				<div class="email-list" style="margin-bottom:10px;">
					<label>Subject *:</label>
					<?php $startDate = date('Y-m-1');
					$prevMonth = $date;
					?>
					<input type="text" name="subject" id="subject" value="<?php echo $lead_name ?> Invoice for <?php echo $prevMonth ?> "  style="width: 418px;height: 15px;padding: 10px;">
					
				</div>
				<div style="color:red;text-align:center" id="subject_err"></div>
				</br>
				<input type="hidden" name="pdf" id="pdf" value="<?php echo $pdf_path ?>">
                <input type="hidden" name="expect_id" id="expect_id" value="<?php echo $expect_id ?>">
                <input type="hidden" name="lead_id" id="lead_id" value="<?php echo $lead_id ?>"
				<?php
               /* $this->db->select('lead_files_name');
                $this->db->where('lead_id', $lead_id);
                $list_users = $this->db->get($this->cfg['dbpref'] . 'lead_files');
				$files =  $list_users->result_array();*/
				$this->db->select('file.lead_files_name');
				$this->db->from($this->cfg['dbpref'].'expected_payments as expm');
				$this->db->join($this->cfg['dbpref'].'expected_payments_attach_file as expm_file','expm_file.expectid=expm.expectid','left');
				$this->db->join($this->cfg['dbpref'].'lead_files as file','file.file_id=expm_file.file_id','left');
				$this->db->where('expm.expectid', $expect_id);
				$query = $this->db->get();
				$files =  $query->result_array();
				
				if (isset($userdata)) {
				?>
					<div class="email-set-options" style="overflow:hidden;">

						<label for="email_to_customer" class="normal">Email Client:</label> <input type="checkbox" name="email_to_customer" id="email_to_customer" />
						<input type="hidden" name="client_email_address" id="client_email_address" value="<?php echo (isset($quote_data)) ? $quote_data['email_1'] : '' ?>" />
						<input type="hidden" name="client_full_name" id="client_full_name" value="<?php echo (isset($quote_data)) ? $quote_data['customer_name'] : '' ?>" />
						<input type="hidden" name="requesting_client_approval" id="requesting_client_approval" value="0" />

						<p id="multiple-client-emails">
							<label></label>
							<input type="checkbox" name="client_emails_1" id="client_emails_1" value="<?php echo $quote_data['email_1'] ?>" /> <?php echo $quote_data['email_1'] ?>
							<?php
							if ($quote_data['email_2'] != '')
							{
							?>
								<br /><input type="checkbox" name="client_emails_2" id="client_emails_2" value="<?php echo $quote_data['email_2'] ?>" /> <?php echo $quote_data['email_2'] ?>
							<?php
							}
							if ($quote_data['email_3'] != '')
							{
							?>
								<br /><input type="checkbox" name="client_emails_3" id="client_emails_3" value="<?php echo $quote_data['email_3'] ?>" /> <?php echo $quote_data['email_3'] ?>
							<?php
							}
							if ($quote_data['email_4'] != '')
							{
							?>
								<br /><input type="checkbox" name="client_emails_4" id="client_emails_4" value="<?php echo $quote_data['email_4'] ?>" /> <?php echo $quote_data['email_4'] ?>
							<?php
							}
							?>
							<br />
							<label></label>
							Additional Emails (separate addresses with a comma)<br />
							<label></label>
							<input type="text" name="additional_client_emails" id="additional_client_emails" style="width: 410px;" class="textfield" />
						</p>

					</div>
				<?php
				}
				?>

				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				
				<label class="normal">Templates:</label>
			    <select id="email_templates" name="email_templates" onchange="getTemplate(this.value)" class="textfield width150px">
							<option value="0">Select Template</option>
							<?php
							if(count($email_templates>0)) {
								foreach ($email_templates as $email_template) { ?>
									<option value="<?php echo $email_template['temp_id'] ?>"><?php echo $email_template['temp_name']; ?></option>
								<?php } ?>
							<?php } ?>
				</select>
				<br>
				<label class="normal">Message *:</label>
				<textarea name="job_log" id="job_log" class="textfield crm_editor1" style="width:410px;"></textarea>
			    <br>
				<div style="color:red;text-align:center" id="message_err"></div>					
			<label class="normal">Signatures:</label>
			<select id="email_signatures" name="email_signatures" onchange="getSignature(this.value)" class="textfield width150px required">
							<option value="0">Select Signature</option>
							<?php
							if(count($email_signatures>0)) {
								foreach ($email_signatures as $email_signature) { ?>
									<option value="<?php echo $email_signature['sign_id'] ?>"><?php echo $email_signature['sign_name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
						<br>		
				
				
				
				<label>Signature:</label>
				<textarea name="signature" id="signature" class="textfield crm_editor1 "><?php if(!empty($default_signature)) echo $default_signature['sign_content'];?></textarea>
				<div style="color:red;text-align:center" id="signature_err"></div>
				<div class="clear"></div>
                <div>
				
                <label>File Upload:</label> 
                <input type="file" multiple="multiple" accept="application/pdf,application/msword,
  application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel"  id="upload_name" name="upload_name[]" onchange="return AjaxFileUpload('<?php  echo $expect_id ?>');"  class="textfield width200px required form-control" />

<div id="pdf_error" style="color:red;display:none;">Only upload pdf,docx,xls</div>     
          
                </div>
				<div id="Filelist"></div>  
                <div>
                <label>Attachment:</label> 
                <?php
				$downloadfile = base_url().'crm_data/invoicepdf/'.$pdf_path;
                if(!empty($files)){
                foreach($files as $file){ ?>
                   <input type="hidden" name="file_name[]" class="file_name" id="file_name" value="<?php echo $file['lead_files_name'] ?>">
                   <div>  <a class="pm_files" onclick="download_files('<?php echo $lead_id; ?>','<?php echo $file['lead_files_name']; ?>'); return false;" ><?php echo $file['lead_files_name']; ?></a> </div>
             <?php   } }
                ?>
                <!--<a id="downloadLink" title="Invoice download" href="<?PHP echo $downloadfile; ?>" target="_blank" 
type="application/octet-stream" download="<?PHP  base_url().'crm_data/invoicepdf/'.$pdf_path; ?>"><img src="assets/img/p_invoice.png" style="height:20px;margin-right:10px" alt="Invoice download"><?php echo $pdf_path; ?></a> -->                   
				<!-- //AWS url in invoice view -->
				<a id="downloadLink" title="Invoice download" href="javascript:;" onclick="return download_invoice_aws('<?php echo $expect_id; ?>','<?php echo $pdf_path; ?>','<?php echo 'new'; ?>');" download="<?PHP  base_url().'crm_data/invoicepdf/'.$pdf_path; ?>"><img src="assets/img/p_invoice.png" style="height:20px;margin-right:10px" alt="Invoice download"><?php echo $pdf_path; ?></a>              
                
				</div>
                <div style="overflow:hidden;">		
                			
					<!--p class="right" style="padding-top:5px;">Mark as a <a href="#was" onclick="whatAreStickies(); return false;">stickie</a> <input type="checkbox" name="log_stickie" id="log_stickie" /></p-->
					<div class="button-container">
						<div class="buttons" style="margin-top:10px;">
							<button type="submit" class="positive"  style="font-size:11px!important" id="add-log-submit">Send Email</button>
							<button type="button" class="btn btn-default" onclick="cancel();  return false;" id="add-log-submit-button">Cancel</button>
						</div>
					</div>				
				</div>
			</form>
    </div>
</div>    
</div>
<style>


</style>
<script type="text/javascript" src="assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="assets/js/jq.livequery.min.js"></script>
<script type="text/javascript" src="assets/js/crm.js?q=13"></script>

<script type="text/javascript" src="assets/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="assets/js/tasks.js?q=34"></script>
<script type="text/javascript">var this_is_home = true;</script>
<script type="text/javascript" src="assets/js/chosen.jquery.js"></script>
<script type="text/javascript" src="assets/js/invoice/tagsinput.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.screwdefaultbuttonsV2.js"></script>
<script type="text/javascript" src="assets/js/tinymce4.5.1/tinymce.min.js"></script>

<script>
	$(".mce-tinymce").remove();	
	tinymce.init({
    selector: '.crm_editor1',
	plugins: "code,preview",
	content_style:"p {padding: 0;margin: 2px 0;}",
    height : "250"
  
  });
$(function(){
	

	var config = {
		'.chzn-select'           : {},
		'.chzn-select-deselect'  : {allow_single_deselect:true},
		'.chzn-select-no-single' : {disable_search_threshold:10},
		'.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chzn-select-width'     : {width:"95%"},
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}

	$('#user_mail_val_chzn input').blur(function(){	
		
	var value = $(this).val(); 
	if(IsEmail(value) == true && value != ''){
		var emails = $('#user_mail_val').val();
		console.log(emails);
		var flag = true;
		
		
		if(emails){
			$.each(emails, function( index, val ) {
				if(val == ('email-log-'+value)){
					flag = false;
				}
			});
		}
		
		

		if(flag){
			$('#user_mail_val').append('<option value="email-log-'+value+'" selected="selected">'+value+'</option>');
		    $('#user_mail_val').trigger("liszt:updated");
		}

	    
		}  
	})	

	$('#user_mail_val_chzn input').keyup(function(e){	
		
		var key = e.which;
		if(key == 13 || key == 9){
			console.log(key);
		var value = $(this).val(); 
		
		if(IsEmail(value) == true && value != ''){
			var emails = $('#user_mail_val').val();
			
			var flag = true;
			
			
			if(emails){
				$.each(emails, function( index, val ) {
					if(val == ('email-log-'+value)){
						flag = false;
					}
				});
			}
		
		

		if(flag){
			console.log(flag);
			$('#user_mail_val').append('<option value="email-log-'+value+'" selected="selected">'+value+'</option>');
		    $('#user_mail_val').trigger("liszt:updated");
		}

	    
		}  
	}	
	})	

	$('#client_mail_chzn input').keyup(function(e){	
		var key = e.which;
		
		if(key == 13 || key == 9){
	var value = $(this).val(); 
	if(IsEmail(value) == true && value != ''){
		var emails = $('#client_mail').val();
		console.log(emails);
		var flag = true;
		
		
		if(emails){
			$.each(emails, function( index, val ) {
				if(val == (value)){
					flag = false;
				}
			});
		}
		
		

		if(flag){
			$('#client_mail').append('<option value="'+value+'" selected="selected">'+value+'</option>');
		    $('#client_mail').trigger("liszt:updated");
		}

	    
		}  
	}	
	})	

	$('#client_mail_chzn input').blur(function(){	
		console.log("hi");
	var value = $(this).val(); 
	if(IsEmail(value) == true && value != ''){
		var emails = $('#client_mail').val();
		var flag = true;
		
		
		if(emails){
			$.each(emails, function( index, val ) {
				if(val == (value)){
					flag = false;
				}
			});
		}
		
		

		if(flag){
			$('#client_mail').append('<option value="'+value+'" selected="selected">'+value+'</option>');
		    $('#client_mail').trigger("liszt:updated");
		}

	    
		}  
	})	
});

</script>

<script>
$(function(){
	//$("#user_mail").trigger("chosen:updated");
// 	var NewTopic = $('<option value="'+data.topic_id+'">'+data.topic_name+'</option>');
// $('#user_mail').append(NewTopic);
// $('#user_mail').trigger("chosen:updated");

//     evt.preventDefault();
//  if (this.results_showing) {
//    if (!this.is_multiple || this.result_highlight) {
//      return this.result_select(evt);
//    }
//    $(this.form_field).append('<option>' + $(evt.target).val() + '</option>');
//    $(this.form_field).trigger('chosen:updated');
//    this.result_highlight = this.search_results.find('li.active-result').lasteturn this.result_select(evt);
//   }

});
 function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
$('#upload_name').on( 'change', function(e) {
	e.stopImmediatePropagation();
   myfile= $( this ).val();
  
   var ext = myfile.split('.').pop();
   console.log(ext);
   if(ext=="pdf" || ext=="docx" || ext=="doc" || ext=="xls"){
	 //  alert(ext);
	 $("#pdf_error").hide();
   } else{
	   $("#pdf_error").show();
	   document.getElementById("upload_name").value = "";
   }
});


$("#customer_detail_form").submit(function(e) {	
	var err 	  = true;	
	var empty_err = true;
	
var the_log = tinyMCE.get('job_log').getContent();
var signature = tinyMCE.get('signature').getContent();
var client_mail = $("#client_mail").val();
var user_mail = $("#user_mail_val").val();
var subject = $("#subject").val();
if ($.trim(client_mail) == '') {
	$("#to_err").html("To is Required");
		empty_err = false;
}
if(subject == ''){
	$("#subject_err").html("Subject is Required");
		empty_err = false;
}
if ($.trim(the_log) == '') {
	$("#message_err").html("Message is Required");
		empty_err = false;
}
if ($.trim(signature) == '') {
	$("#signature_err").html("Signature is Required");
		empty_err = false;
}
if(empty_err == true){
	$("#add-log-submit").attr("disabled", true);
$.blockUI({
				message:'<h4 style="color: white;  margin-top: 2px;">Processing</h4><img src="assets/img/ajax-loader.gif" />',
				css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333',zIndex:'999999999'},
				blockMsgClass: 'alertBox11',
			});
 e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
		url : site_base_url + 'invoice/sendInvoice',
		cache : false,
		contentType: false,
		processData: false,
		type: "POST",
		dataType: 'json',
		data:formData,
		success : function(response){
			
			console.log(response.result);
			
			if(response.result =='success'){
				$("#msg").show();
				
                    setTimeout(function(){ 
						$.unblockUI();
						
					location.reload(true);
                         }, 
                     3000);
                    
					
       
                   
                }else{
                   $.unblockUI();
                    location.reload(true);
                }
		}
		
	});
//	$.unblockUI();
	e.stopImmediatePropagation();
	return false;
}
});	
/*function sendInvoiceEmail() {

var the_log = tinyMCE.get('job_log').getContent();
var the_sign = tinyMCE.get('signature').getContent();
var attachment_val = $("#pdf").val();
var lead_id = $("#lead_id").val();
var expect_id = $("#expect_id").val();
//var file = $('#uplo_file').val();
//console.log(file);
if ($.trim(the_log) == '') {
			alert('Please enter your message!');
			return false;
}

var pm_files = '';
$(".file_name").each(function() {
    pm_files += $(this).val() + ',';
});
var email_set = '';
		$('#user_mail option:selected').each(function(){
			email_set += $(this).val() + ',';
        });
        var params  = {'pm_files':pm_files,'log_content':the_log, 'emailto':email_set,'sign_content':the_sign,'attchment':attachment_val,'lead_id':lead_id,'expect_id':expect_id};
        params[csrf_token_name] = csrf_hash_token;
        $.ajax({
            url : site_base_url + 'invoice/sendInvoice',
            cache: false,
            type: "POST",
            data:params,
            success : function(response) {
                if(response =='success'){
                    setTimeout(function(){ 
                        $.unblockUI();
                         }, 
                     3000);
                    $("#msg").show();
                   
                   // location.reload(true);
                }else{
                    $.unblockUI();
                   // location.reload(true);
                }

            }
        });        
}*/

/* To get email template by id */
function getTemplate(temp_id)
{
	       params ={'temp_id':temp_id};
		   params[csrf_token_name] = csrf_hash_token;
			$.ajax({
			async: false,
			type: "POST",
			url : site_base_url + 'project/get_template_content/',
			cache : false,
			data :params,
			success : function(response){
				response = JSON.parse(response);
				
				if(response != null && response.temp_content !=null) {
					
					tinymce.get('job_log').setContent(response.temp_content);
					//tinymce.triggerSave();
               } else {
					tinymce.get('job_log').setContent('');
				}
			}
		});
}
/* To get email signature by id */
function getSignature(sign_id)
{
	       params ={'sign_id':sign_id};
		   params[csrf_token_name] = csrf_hash_token;
			$.ajax({
			async: false,
			type: "POST",
			url : site_base_url + 'project/get_signature_content/',
			cache : false,
			data :params,
			success : function(response){
				response = JSON.parse(response);
				
				if(response != null && response.sign_content !=null) {
					
					tinymce.get('signature').setContent(response.sign_content);
					//tinymce.triggerSave();
                } else {
					tinymce.get('signature').setContent('');
				}
			}
		});
}


function download_files(job_id,f_name){
	window.location.href = site_base_url+'project/download_file/'+job_id+'/'+f_name;
} 
//Apply the validation rules for attachments upload
function ApplyFileValidationRules(readerEvt){


}
//To check file type according to upload conditions
function CheckFileType(fileType) {
		if (fileType == "application/msword") {
			return true;
		}
		else if (fileType == "application/pdf") {
			return true;
		}
		else if (fileType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
			return true;
		}else if (fileType == "application/vnd.ms-excel") {
			return true;
		}
		else {
			document.getElementById("upload_name").value = "";
			return false;
		}
		return true;
}



function CheckFileSize(fileSize) {
if (fileSize < 10762150) {
return true;
}
else {
return false;
}
return true;
}

//To remove attachment once user click on x button
jQuery(function ($) {
$('div').on('click', '.image-div .close', function () {
	var id = $(this).closest('.img-wrap').find('img').data('id');

	//to remove the deleted item from array
	var elementPos = AttachmentArray.map(function (x) { return x.FileName; }).indexOf(id);
	if (elementPos !== -1) {
		AttachmentArray.splice(elementPos, 1);
	}

	//to remove image tag
	$(this).parent().find('img').not().remove();

	//to remove div tag that contain the image
	$(this).parent().find('div').not().remove();

	//to remove div tag that contain caption name
	$(this).parent().parent().find('div').not().remove();

	//to remove li tag
	var lis = document.querySelectorAll('#imgList li');
	for (var i = 0; li = lis[i]; i++) {
		if (li.innerHTML == "") {
			li.parentNode.removeChild(li);
		}
	}

});
}
)
//To save an array of attachments 
var AttachmentArray = [];

//counter for attachment array
var arrCounter = 0;

//to make sure the error message for number of files will be shown only one time.
var filesCounterAlertStatus = false;

//un ordered list to keep attachments thumbnails
var ul = document.createElement('ul');
ul.className = ("thumb-Images");
ul.id = "imgList";
//Render attachments thumbnails.
/*function RenderThumbnail(e, readerEvt)
{
var li = document.createElement('li');
ul.appendChild(li);
li.innerHTML = ['<div class="image-div">' +
	'<p class="thumb"  title="', escape(readerEvt.name), '" data-id="',
	readerEvt.name, '"/></p>' + '<span class="close">&times;</span> <div> <input type="hidden" name="multi_upload[]" value="'+readerEvt.name+'" /> </div> </div>'].join('');
$("#uplo_file").val(readerEvt.name);
var div = document.createElement('div');
div.className = "FileNameCaptionStyle";
li.appendChild(div);
div.innerHTML = [readerEvt.name].join('');
document.getElementById('Filelist').insertBefore(ul, null);
e.stopImmediatePropagation();
return false;
}*/

//Fill the array of attachment
function FillAttachmentArray(e, readerEvt)
{
AttachmentArray[arrCounter] =
{
	AttachmentType: 1,
	ObjectType: 1,
	FileName: readerEvt.name,
	FileDescription: "Attachment",
	NoteText: "",
	MimeType: readerEvt.type,
	Content: e.target.result.split("base64,")[1],
	FileSizeInBytes: readerEvt.size,
};
arrCounter = arrCounter + 1;
}
document.querySelector('#upload_name').addEventListener('change', handleFileSelect, false);
//the handler for file upload event
function handleFileSelect(e) {
	e.stopImmediatePropagation();
//to make sure the user select file/files
if (!e.target.files) return;

//To obtaine a File reference
var files = e.target.files;

// Loop through the FileList and then to render image files as thumbnails.
for (var i = 0, f; f = files[i]; i++) {

	//instantiate a FileReader object to read its contents into memory
	var fileReader = new FileReader();

	// Closure to capture the file information and apply validation.
	fileReader.onload = (function (readerEvt) {
		return function (e) {
			
			//Apply the validation rules for attachments upload
		//	ApplyFileValidationRules(readerEvt)

			//Render attachments thumbnails.
			//RenderThumbnail(e, readerEvt);

			//Fill the array of attachment
			FillAttachmentArray(e, readerEvt)
		};
	})(f);

	// Read in the image file as a data URL.
	// readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
	// More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
	fileReader.readAsDataURL(f);
}
document.getElementById('upload_name').addEventListener('change', handleFileSelect, false);
}

function AjaxFileUpload(expect_id) {
	var params 				 = {};
	params[csrf_token_name]  = csrf_hash_token;

	$.ajaxFileUpload({
		url: 'invoice/payment_file_upload/'+expect_id,
		secureuri: false,
		fileElementId: 'upload_name',
		dataType: 'json',
		data: params,
		success: function (readerEvt, status) { 					
			if(readerEvt.filename != ''){
				var file = readerEvt.filename.split(',');
				$.each(file, function( index, value ) {
					var li = document.createElement('li');
					ul.appendChild(li);
					li.innerHTML = ['<div class="image-div">' +
						'<p class="thumb"  title="', escape(value), '" data-id="',
						value, '"/></p>' + '<span class="close">&times;</span> <div> <input type="hidden" name="multi_upload[]" value="'+value+'" /> </div> </div>'].join('');
					$("#uplo_file").val(value);
					var div = document.createElement('div');
					div.className = "FileNameCaptionStyle";
					li.appendChild(div);
					div.innerHTML = [value].join('');
					document.getElementById('Filelist').insertBefore(ul, null);
				});
		  }
		}
	});
}
$('#client_mail').on('itemAdded', function(event) {
   var tag = event.item;
   console.log($('#client_mail').val());
   var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
   var emailFormat = pattern.test(tag);
   if(emailFormat == false){
	  var params 				 = {};
	params[csrf_token_name]  = csrf_hash_token;

	$.ajax({
		url: 'invoice/payment_file_upload/'+expect_id,
		secureuri: false,
		fileElementId: 'upload_name',
		dataType: 'json',
		data: params,
		success: function (readerEvt, status) { 
            
        }        
       });
	   $('#client_mail').tagsinput('remove', tag);
   }


});   
</script>