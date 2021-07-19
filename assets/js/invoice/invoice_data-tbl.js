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
		"aoColumnDefs": [
            {'bVisible': false,'aTargets': [14,15,16], 'sClass': 'aging-th-bg'  }
        ]
		
	});

		
});

$(function() {
	$('.data-tbl-soa').dataTable({
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
		"bAutoWidth": false
		
	});

		
});

function fnShowHide()
{
	  aging = $('#aging_report').val();
		if(aging == 0){
			$('#aging_report').val('1');
		}else{
			$('#aging_report').val('0');
		}
    /* Get the DataTables object again - this is not a recreation, just a get of the object */
    var oTable = $('.data-tbl').dataTable();
     
    var bVis = oTable.fnSettings().aoColumns[14].bVisible;
    oTable.fnSetColumnVis( 14, bVis ? false : true );
		
    var bVis = oTable.fnSettings().aoColumns[15].bVisible;
    oTable.fnSetColumnVis( 15, bVis ? false : true );
		
    var bVis = oTable.fnSettings().aoColumns[16].bVisible;
    oTable.fnSetColumnVis( 16, bVis ? false : true );
}
