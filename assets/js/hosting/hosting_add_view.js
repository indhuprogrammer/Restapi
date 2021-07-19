/*
 *@Hosting Add View Jquery
*/

	var nc_form_msg = '<div class="new-cust-form-loader">Loading Content.<br />';
	nc_form_msg += '<img src="assets/img/indicator.gif" alt="wait" /><br /> Thank you for your patience!</div>';
	$(function() {
		$( "#cust_name" ).autocomplete({
			minLength: 3, 
			source: function(request, response) {
			
				var params = {'cust_name': $("#cust_name").val()};
				params[csrf_token_name] = csrf_hash_token;
				
				$.ajax({ 
					url: "hosting/ajax_customer_search",
					data: params,
					type: "POST",
					dataType: 'json',
					async: false,
					success: function(data) {
						response( data );
					}
				});
			},
			select: function(event, ui) {
				$('#cust_id').val(ui.item.id);
			} 
		});
	});

	$(document).ready(function() {

			$('input.pick-date').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
			
			$('input[name="domain_mgmt"]').change(function(){
					if ($('input[name="domain_mgmt"]:checked').val() == 'ENOAH') {
							$('#domain-expiry-date:hidden').show();
					} else {
							$('#domain-expiry-date:visible').hide();
					}
			});
			
			if ($('input[name="domain_mgmt"]:checked').val() == 'ENOAH') {
					$('#domain-expiry-date:hidden').show();
			} else {
					$('#domain-expiry-date:visible').hide();
			}
			
			$('.modal-new-cust').click(function(){
					$.blockUI({message: nc_form_msg, css: {width: '690px', marginLeft: '50%', left: '-345px', position: 'absolute', padding: '20px 0 20px 20px', top: '10%', border: 'none', cursor: 'default'},overlayCSS: {backgroundColor:'#EAEAEA', opacity: '0.9', cursor: 'wait'}});
					$.get(
						'ajax/data_forms/new_customer_form',
						{},
						function(data){
							$('.new-cust-form-loader').slideUp(500, function(){
								$(this).parent().css({backgroundColor: '#fff', color: '#333'});
								$(this).css('text-align', 'left').html(data).slideDown(500, function(){
									$('.error-cont').css({margin:'10px 25px 10px 0', padding:'10px 10px 0 10px', backgroundColor:'#CEB1B0'});
								});
							})
						}
					);
				return false;
			});
			
			
				loadExistingFiles($('#filefolder_id').val());
				showBreadCrumbs($('#filefolder_id').val());
		}
	);

	///////-----------------------------------X---------------------------------------X---------------

	function ndf_cancel() 
	{
		$.unblockUI();
		return false;
	}

	function ndf_add() {
	
		$('.new-cust-form-loader .error-handle:visible').slideUp(300);
		var form_data = $('#customer_detail_form').serialize();
		
		$('.blockUI .layout').block({
			message:'<h3>Processing</h3>',
			css: {background:'#666', border: '2px solid #999', padding:'8px', color:'#333'}
		});
		
		$.post(
			'customers/add_customer/false/false/true',
			form_data,
			function(res) {
				if (typeof (res) == 'object') {
					if (res.error == false) {
						ex_cust_id = res.custid;
						// $("#ex-cust-name").val(res.cust_name1);
						$("#cust_name").val(res.cust_name1);
						$("#cust_id").val(res.custid);
						$.unblockUI();	
						$('.notice').slideUp(400);
						showMSG('<div id=confirm>New Customer Added!</div>');
					} else {
						$('.blockUI .layout').unblock();
						$('.error-cont').html(res.ajax_error_str).slideDown(400);
						
					}
				} else {
					$('.error-cont').html('<p class="form-error">Your session timed out!</p>').slideDown(400);
				}
			},
			"json"
		)
		return false;
	}

	/*
	 *Functions for adding New Country, New State & New Location in the New Lead Creation page -- Starts Here
	 */
	function ajxCty()
	{
		$("#addcountry").slideToggle("slow");
	}

	function ajxSaveCty()
	{
		$(document).ready(function() {
			if ($('#newcountry').val() == "") {
				alert("Country Required.");
			}
			else {
				var regionId = $("#add1_region").val();
				var newCty = $('#newcountry').val();
				getCty(newCty, regionId);
			}
			
		function getCty(newCty, regionId){
				var baseurl = $('.hiddenUrl').val();
				var params  = {regionid: $("#add1_region").val(),country_name:$("#newcountry").val(),created_by:hosting_userid}; // hosting_userid is hosting page variable 
				params[csrf_token_name] = csrf_hash_token;
				
				$.ajax({
				url : baseurl + 'customers/getCtyRes/' + newCty + "/" + regionId,
				cache : false,
				success : function(response){
					if(response == 'userOk') 
						{ 
							$.post("regionsettings/country_add_ajax",params, 
							function(info){$("#country_row").html(info);});
							$("#addcountry").hide();
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

	function ajxSt() 
	{
		$("#addstate").slideToggle("slow");
	}

	function ajxSaveSt() 
	{
		$(document).ready(function() {
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
				var params  = {countryid: $("#add1_country").val(),state_name:$("#newstate").val(),created_by:hosting_userid}
				params[csrf_token_name] = csrf_hash_token;
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

	function ajxLoc()
	{
		$("#addLocation").slideToggle("slow");
	}

	function ajxSaveLoc() 
	{
		$(document).ready(function() {
			if ($('#newlocation').val() == "") {
				alert("Location Required.");
			}
			else {
				var stId = $("#add1_state").val();
				var newLoc = $('#newlocation').val();
				getLoc(newLoc,stId);
			}
		function getLoc(newLoc, stId) {
				var baseurl = $('.hiddenUrl').val();
				var params  = {stateid: $("#add1_state").val(),location_name:$("#newlocation").val(),created_by:hosting_userid};
				params[csrf_token_name] = csrf_hash_token;
				$.ajax({
				url : baseurl + 'customers/getLocRes/' + newLoc + '/' +stId,
				cache : false,
				success : function(response){
					if(response == 'userOk') 
						{
							$.post("regionsettings/location_add_ajax",params, 
							function(info){ $("#location_row").html(info); });
							$("#addstate").hide();
							//var steId = $("#add1_state").val();
							//$("#location_row").load("regionsettings/getLocation/" +steId);
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

		$( "#subcription-tabs" ).tabs({
			beforeActivate: function( event, ui ) {
				
				var evnt_id = ui.newPanel[0].id;		
				switch(evnt_id){					
					case 'jv-tab-0':
						loadExistingFiles($('#filefolder_id').val());
						showBreadCrumbs($('#filefolder_id').val());
					break;					
					case 'jv-tab-1':
						loadLogs(curr_job_id);
					break;
					
				}
			}
		});
	function logsDataTable(){
		$('.logstbl').dataTable( {
			"iDisplayLength": 10,
			"sPaginationType": "full_numbers",
			"bInfo": false,
			"bPaginate": true,
			"bProcessing": true,
			"bServerSide": false,
			"bLengthChange": false,
			"bSort": false,
			"bFilter": false,
			"bAutoWidth": false,
			"oLanguage": {
			  "sEmptyTable": "No Comments Found..."
			}
		});
	}
		//function for getting the files based on ID
	function loadExistingFiles(ffolder_id) { 
		$('#jv-tab-0').block({
			message:'<h4>Processing</h4><img src="assets/img/ajax-loader.gif" />',
			css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333'}
		});
		$.get(
			site_base_url+'hosting/get_project_files/'+curr_job_id+'/'+ffolder_id,
			{},
			function(data) {
				$('#list_file').html(data);
				$('#jv-tab-0').unblock();
				dataTable();
				$.unblockUI();
				
				var parent_folder_id = $('#filefolder_id').val();
				var current_folder_parent_id = $('#current_folder_parent_id').val();
				if(parent_folder_id == 'Files') {
				//alert(current_folder_parent_id);
				if(current_folder_parent_id != undefined) {
				
				showBreadCrumbs(current_folder_parent_id);
				loadExistingFiles(current_folder_parent_id);				
				$('#filefolder_id').val(current_folder_parent_id);		
				}
				}				
				$('#parent_folder_id').val(parent_folder_id);				
				
			}
		);
		return false;
	}
	
	function loadLogs(id) 
{ 
	var params = {};
	params[csrf_token_name] = csrf_hash_token;
	$.post( 
		site_base_url+'hosting/getLogs/'+id,params,
		function(data) {
			if (data.error) {
				alert(data.errormsg);
			} else {
				$('#load-log').html(data);
				logsDataTable();
			}
		}
	);
}

/*
 * Adding folders
 */
function create_folder(leadid, fparent_id) {
	
	var parent_folder_id = $('#parent_folder_id').val();	
	var params				= {'leadid':leadid, 'fparent_id':fparent_id,'parent_folder_id': parent_folder_id};
	params[csrf_token_name] = csrf_hash_token;
	
	$.ajax({
		type: 'POST',
		url: site_base_url+'hosting/get_folder_tree_struct',
		dataType: 'json',
		data: params,
		success: function(data) {
			$('#aflead_id').val(data.lead_id);
			$('#afparent_id').val(data.fparent_id);
			$('#add_file_tree').html(data.tree_struture);
			var ht = $('#create-folder').height();
			ht += 50;
			$('.js_checkbox').prop('checked',false);
			$.blockUI({
				message: $('#create-folder'), 
				css: { zIndex:'99999999', border: '2px solid #999',color:'#333',padding:'8px',top:  ($(window).height() - ht) /2 + 'px',left: ($(window).width() - 400) /2 + 'px',width: '450px',height: ht+'px'} 
			});
			$( "#create-folder" ).parent().addClass( "folder-scroll" );
		}
	});
	return false;
}

function showBreadCrumbs(parent_id) {
	$.get(
		site_base_url+'hosting/getBreadCrumbs/'+curr_job_id+'/'+parent_id,
		{},
		function(data) {
			$('#file_breadcrumb').html(data);
		}
	);
	return false;
}

/*
 *Adding folder
 */
function add_folder() {
	if($("#new_folder").val() == "") {
		alert("Folder Name cannot be empty");
		return false;
	}
	var form_data = $('#create-folder').serialize();
	$.ajax({
		type: 'POST',
		url: site_base_url+'hosting/addFolders',
		dataType: 'json',
		data: form_data,
		success: function(data) {
			if(data.err == 'true'){
				alert('Folder Name already exists (Or) you dont have access to write.');
			}else {
				$('#af_successerrmsg').html(data.af_msg);
			}
			setTimeout(function() { 
				$.unblockUI({ 
					onUnblock: function(){ getFolderdata(data.af_reload),$('.succ_err_msg').empty(),$('#new_folder').val(''); }
				}); 
			}, 2000);
		}
	});
	return false;
}

/*
*@Request_view
*@
*/
function dataTable()
	{
		$('#list_file_tbl').dataTable({
			"iDisplayLength": 15,
			"sPaginationType": "full_numbers",
			"bInfo": true,
			"bPaginate": true,
			"bProcessing": true,
			"bServerSide": false,
			"bLengthChange": true,
			"bSort": true,
			"bFilter": false,
			"bAutoWidth": false,
			"bDestroy": true,
			"aoColumnDefs": [
				{ 'bSortable': false, 'aTargets': [ 0 ] }
			]
		});
	}

	function runAjaxFileUpload()
	{
		var _uid = new Date().getTime();
		$('<li id="' + _uid +'">Processing <img src="assets/img/ajax-loader.gif" /></li>').appendTo('#job-file-list');
		var params 				 = {};
		params[csrf_token_name]  = csrf_hash_token;
		var ffid = $('#filefolder_id').val();

		if(ffid == 'Files') 
		{ 
		alert('You have no permissions to upload files to current locations. Please contact to administrators!.'); 
		return false;
		}

		$.ajaxFileUpload({
			url: 'hosting/file_upload/'+curr_job_id+'/'+ffid,
			secureuri: false,
			fileElementId: 'ajax_file_uploader',
			dataType: 'json',
			data: params,
			success: function (data, status) {
			
				if(typeof(data.error) != 'undefined') {
					if(data.error != '') {
						if (window.console) {
							console.log(data);
						}
						if (data.msg) {
							alert(data.msg);
						} else {
							alert('File upload failed!');
						}
						// $('#'+_uid).hide('slow').remove();
					} else {	
						if(data.msg == 'File successfully uploaded!') {
							// alert(data.msg);
							/*Showing successfull message.*/
							$('#fileupload_msg').html('<span class=ajx_success_msg>'+data.msg+'</span>');
							setTimeout('timerfadeout()', 3000);
							// Again loading existing files with new files
							$('#jv-tab-0').block({
								message:'<h4>Processing</h4><img src="assets/img/ajax-loader.gif" />',
								css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333'}
							});
							$.get(
								site_base_url+'hosting/get_project_files/' + curr_job_id +'/'+ ffid,
								{},
								function(data) {
									$('#list_file').html(data);
									$('#jv-tab-0').unblock();
									$('#list_file_tbl').dataTable({
										"iDisplayLength": 10,
										"sPaginationType": "full_numbers",
										"bInfo": true,
										"bPaginate": true,
										"bProcessing": true,
										"bServerSide": false,
										"bLengthChange": true,
										"bSort": true,
										"bFilter": false,
										"bAutoWidth": false,
										"bDestroy": true,
										"aoColumnDefs": [
											{ 'bSortable': false, 'aTargets': [ 0 ] }
										]
									});
									$.unblockUI();
								}
							);
							return false;
						}
					}
				}
			},
			error: function (data, status, e)
			{
				alert('Sorry, the upload failed due to an error!');
				$('#'+_uid).hide('slow').remove();
				if (window.console)
				{
					console.log('ajax error\n' + e + '\n' + data + '\n' + status);
					for (i in e) {
					  console.log(e[i]);
					}
				}
			}
		});
		$('#ajax_file_uploader').val('');
		return false;
	}

	
	function getFolderdata(ffolder_id) {

		// if(ffolder_id == 0) var ffolder_id  = 'Files' 
		// else var ffolder_id  = ffolder_id;

		showBreadCrumbs(ffolder_id);
		//showFolderOptions(ffolder_id);
		$('#jv-tab-0').block({
			message:'<h4>Processing</h4><img src="assets/img/ajax-loader.gif" />',
			css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333'}
		});
		$.get(
			site_base_url+'hosting/get_project_files/'+curr_job_id+'/'+ffolder_id,
			{},
			function(data) {
				$('#list_file').html(data);
				$('#filefolder_id').val(ffolder_id);			
				$('#parent_folder_id').val($('#filefolder_id').val());			
				$('#jv-tab-0').unblock();
				$('#list_file_tbl').dataTable({			
					"iDisplayLength": 10,
					"sPaginationType": "full_numbers",
					"bInfo": true,
					"bPaginate": true,
					"bProcessing": true,
					"bServerSide": false,
					"bLengthChange": true,
					"bSort": true,
					"bFilter": false,
					"bAutoWidth": false,
					"bDestroy": true,
					"aoColumnDefs": [
						{ 'bSortable': false, 'aTargets': [ 0 ] }
					]
				});
				$.unblockUI();
			}
		);
		return false;
	}
	
	function download_files_id(job_id,file_id) {
		window.location.href = site_base_url+'hosting/download_file/'+job_id+'/'+$("#file_"+file_id).val();
	}
	function showFolderOptions(parent_id) {
		$('#files_actions').empty();
		$.get(
			site_base_url+'hosting/getFolderActions/'+curr_job_id+'/'+parent_id,
			{},
			function(data) {
				$('#files_actions').show();
				$('#files_actions').html(data);
			}
		);
		return false;
	}
	
	/*
*Moving Multiple files
*/
function moveAllFiles() {
	var mv_folder = '';
	var mv_files = '';
	$( ".file_chk:checked" ).each(function( index ) {
		if($(this).attr('file-type') == 'folder') {
			mv_folder += $(this).val()+',';
		} else if($(this).attr('file-type') == 'file') {
			mv_files += $(this).val()+',';
		}
	});
	// alert(mv_folder+'+++'+mv_files); return false;
	
		/*
		*Mani Changes Start Here
		*/
	    /* var ffid = $('#filefolder_id').val();		
		if(ffid == 'Files') 
		{ 
		alert('Please open root folder and continue your actions!'); 
		return false;
		} */
		/*
		*Mani Changes End Here
		*/
	
	if((mv_folder=='') && (mv_files=='')) {
		alert('No files or folders selected');
		return false;
	}
	
	var params				= {'mv_folder':mv_folder, 'mv_files':mv_files, 'curr_job_id':curr_job_id};
	params[csrf_token_name] = csrf_hash_token;
	
	$.ajax({
		type: 'POST',
		url: site_base_url+'hosting/get_moveall_file_tree_struct',
		dataType: 'json',
		data: params,
		success: function(data) {
			// console.info(data);
			$('#mall_lead_id').val(data.lead_id);
			$('#mov_folder').val(mv_folder);
			$('#mov_file').val(mv_files);
			$('#file_tree_all').html(data.tree_struture);
			$.blockUI({ 
				message: $('#moveallfile'),
				css: {
					border: '2px solid #999',
					color:'#333',
					padding:'8px',
					top:  ($(window).height() - 400) /2 + 'px', 
					left: ($(window).width() - 400) /2 + 'px', 
					width: '400px' 
				} 
			});
		}
	});
	return false;
	
}

/*
 *Move Multiple files
 */
function move_all_files() {
	var form_data = $('#moveallfile').serialize();
	$.ajax({
		type: 'POST',
		url: site_base_url+'hosting/mapallfiles',
		dataType: 'json',
		data: form_data,
		success: function(data) {
			// console.info(data);
			if( data.result == true ) {
				$('#all_mf_successerrmsg').html(data.mf_msg);
				setTimeout(function() {
					$.unblockUI({ 
						onUnblock: function(){ getFolderdata(data.mf_reload),$('.succ_err_msg').empty(); }
					}); 
				}, 2000);
			} else {
				$('#all_mf_successerrmsg').html(data.mf_msg);
				setTimeout('timerfadeout()', 3000);
			}
		}
	});
	return false;
}

/*
*Moving Multiple files
*/
function deleteAllFiles() {

	var ff_id = $('#filefolder_id').val();
	var del_folder = '';
	var del_files = '';
	$( ".file_chk:checked" ).each(function( index ) {
		if($(this).attr('file-type') == 'folder') {
			del_folder += $(this).val()+',';
		} else if($(this).attr('file-type') == 'file') {
			del_files += $(this).val()+',';
		}
	});
	// alert(del_folder+'+++'+del_files); return false;
	
	
	
	if((del_folder=='') && (del_files=='')) {
		alert('No files or folders selected');
		return false;
	}
	
		/*
		*Mani Changes Start Here
		*/
	   	/* if(ff_id == 'Files') 
		{ 
		alert('You have no permissions to delete root folder!'); 
		return false;
		} */
		/*
		*Mani Changes End Here
		*/
	
	var result = confirm("Are you sure you want to delete this files?");
	if (result==false) {
		return false;
	}
	
	var params				= {'del_folder':del_folder, 'del_files':del_files, 'curr_job_id':curr_job_id, 'ff_id':ff_id};
	params[csrf_token_name] = csrf_hash_token;
	
	$.ajax({
		type: 'POST',
		url: site_base_url+'hosting/delete_files',
		dataType: 'json',
		data: params,
		success: function(data) {
			// console.info(data);
			var delete_status = '';
			if(data.hasOwnProperty("error")){
				alert(data.msg);
			    getFolderdata(data.folder_parent_id);
				return false;
			}
			if(data.folder_del_status!='no_folder_del'){
				$.each(data.folder_del_status, function(i, item) {
					delete_status += item+"\n";
				});
			}
			if(data.file_del_status!='no_file_del'){
				$.each(data.file_del_status, function(i, item) {
					delete_status += item+"\n";
				});
			}
			alert(delete_status);
			getFolderdata(data.folder_parent_id);
		}
	});
	return false;
}

/*
*@method searchFileFolder
*/
function searchFileFolder() {
	var search_input = $('#search_input').val();
	if(search_input == '')
	return false;
	
	// var parent_folder_id = $('#parent_folder_id').val();
	
	// var params				= {'search_input':search_input, 'lead_id':curr_job_id, 'currently_selected_folder':parent_folder_id};
	var params				= {'search_input':search_input, 'lead_id':curr_job_id};
	params[csrf_token_name] = csrf_hash_token;
	
	$.ajax({
		type: 'POST',
		url: site_base_url+'hosting/searchFile',
		data: params,
		success: function(data) {
			// console.info(data);
			$('#list_file').html(data);
			$('#jv-tab-3').unblock();
			$('#list_file_tbl').dataTable({
				"iDisplayLength": 10,
				"sPaginationType": "full_numbers",
				"bInfo": true,
				"bPaginate": true,
				"bProcessing": true,
				"bServerSide": false,
				"bLengthChange": true,
				"bSort": true,
				"bFilter": false,
				"bAutoWidth": false,
				"bDestroy": true,
				"aoColumnDefs": [
					{ 'bSortable': false, 'aTargets': [ 0 ] }
				]
			});
			$.unblockUI();
		}
	});
	return false;
}


//Selecting Multiple files
$(document).on('click','#file_chkall',function(){
	if($(this).prop('checked')){
		$('.file_chk:not(:checked)').trigger('click');
	}else{
		$('.file_chk:checked').trigger('click');		
	}
});


// Edit folder permissions start.
function editFolderPermissions(lead_id)
{
	var parent_folder_id = $('#parent_folder_id').val();
	var ht = $('#edit-folder-permissions').height();
	$('#edit-folder-permissions').text('Loading, please wait..');
	/*$.blockUI({
		message: $('#edit-folder-permissions'),
		css: { border: '2px solid #999',color:'#333',padding:'8px',top:  ($(window).height() - ht) /2 + 'px',left: ($(window).width() - 900) /2 + 'px',width: '900px',height: ht+'px'}
	});*/
	/*$('#edit-folder-permissions').block({
		message:'<h4>Processing</h4><img src="assets/img/ajax-loader.gif" />',
		css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333'}
	});*/
	/*$('.blockUI .layout').block({
			message:'<h3>Processing</h3>',
			css: {background:'#666', border: '2px solid #999', padding:'8px', color:'#333'}
		});*/
	$.get(site_base_url+'hosting/get_folder_permissions_ui_for_a_project', {'lead_id':lead_id, 'parent_folder_id': parent_folder_id}, function(data)
	{   $.unblockUI();
		$("#edit-folder-permissions").html(data);
		$.blockUI({
			message: $('#edit-folder-permissions'), 
			css: { border: '2px solid #999',color:'#333',padding:'8px',top:  ($(window).height() - ht)/2 + 'px',left: ($(window).width() - 900)/2 + 'px',width: '900px',height: ht+'px'} 
		});
		$( "#edit-folder-permissions" ).parent().addClass( "no-scroll" );
	});	
}
/////////////////