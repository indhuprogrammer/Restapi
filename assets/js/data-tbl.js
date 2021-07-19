/*
 *@DataTable Javascript
 *@For all tables
*/

$(function() {
	$('.data-tbl').dataTable({
		"aaSorting": [[ 0, "asc" ]],
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
		"bDestroy": true
	});

	$('.data-tbl_history').dataTable({
		"aaSorting": [[ 6, "desc" ]],
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
		"bDestroy": true
	});
	
	$('.data-tbl_customer').dataTable({
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
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] } ]
	});

	$('.approver1').dataTable({
		"aaSorting": [[ 0, "asc" ]],
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
		"bDestroy": true
	});
	// to clear checkbox value for account manager selection while on search keyup
	$('.customerpage .dataTables_filter input').bind('keyup', function(e) {
		$('.acid').each(function() { //iterate
        this.checked = false; //clear checkbox
		$('input.acid:checkbox').prop('checked', false);
        $('.check:button').val('check all');
		$('.check:button').show();
    });
	});
	
});
