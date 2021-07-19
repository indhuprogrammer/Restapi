$(function() {
	datatable = $('.data-tbl').DataTable({
		"aaSorting": [[ 1, "desc" ]],
		"iDisplayLength": 10,
		"sPaginationType": "full_numbers",
		"bInfo": true,
		"bPaginate": true,
		"bProcessing": true,
		"bServerSide": false,
		"bLengthChange": true,
		"bSort": true,
		"bFilter": true,
		"bAutoWidth": false,
		"bDestroy": true,
	});
	$("div.dataTables_filter label").after('  <button class="positive" name="" id="clear_dt_input">Clear</button>');
	$('#clear_dt_input').on('click', function () {
	   datatable.fnFilter('');
	});
});



function deleteAsset(id) {
//    alert(id);return false;
	$.blockUI({
		message:'<br /><h5>Are You Sure Want to Delete <br />this Asset?<br /><br />This will delete all the assets<br />and logs attached to this Asset.</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="processDelete('+id+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
		css:{width:'440px'}
	});
}

function processDelete(id) {
		var formdata = {};
		formdata['id'] = id;
		formdata[csrf_token_name] = csrf_hash_token;
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url : site_base_url + 'asset_register/delete_asset/',
			data: formdata,
			beforeSend:function(){
				$.blockUI();
			},
			success : function(response){
				// $.unblockUI();
				if(response['error'] == false) {
					$.blockUI({
						message:'<br /><h5>'+response['msg']+'</h5><br />',
						css:{width:'440px'}
					});
					$('#'+id).remove();
					setTimeout('timerfadeout()', 3000);
				} else {
					alert(response['msg']);
					return false;
				}
			}
		});
}

function cancelDel() {
	$.unblockUI();
}

function timerfadeout() {
	$.unblockUI();
}

$.ajaxSetup ({
    cache: false
})
