/*
 *@User List Jquery
 *@User Module
*/
$(document).ready(function(){
        
   $('.excel').click(function() {
	
        var business_unit = $('#business_unit_id').val();
        var department	= $('#department_id_fk').val();
        var practice     = $('#practices').val();
        var region     = $('#region').val();
        var location     = $('#location').val();
        var skill    = $('#skill_id').val();
        var keyword    = $('#keyword').val();
        var active_users    = $('#active_users').is(":checked");
        var active_user_value = (active_users == true) ? 1 : 0;
        var url = site_base_url+"user_region/excelExport";

        var form = $('<form action="' + url + '" method="post">' +
                    '<input id="token" type="hidden" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
                    '<input type="hidden" name="business_unit" value="' +business_unit+ '" />' +
                    '<input type="hidden" name="department" value="' +department+ '" />' +
                    '<input type="hidden" name="practice" value="' +practice+ '" />' +
                    '<input type="hidden" name="region" value="' +region+ '" />' +
                    '<input type="hidden" name="location" value="' +location+ '" />' +
                    '<input type="hidden" name="skill" value="' +skill+ '" />' +
                    '<input type="hidden" name="keyword" value="' +keyword+ '" />' +
                    '<input type="hidden" name="active_users" value="' +active_user_value+ '" />' +
                    '</form>');
        $('body').append(form);
        $(form).submit(); 
        return false;
}); 
});

function checkStatus(id) {
	var formdata = { 'data':id }
	formdata[csrf_token_name] = csrf_hash_token;
	$.ajax({
		type: "POST",
		url: site_base_url+'user/ajax_check_status_user/',
		dataType:"json",                                                                
		data: formdata,
		cache: false,
		beforeSend:function(){
			//$("#loadingImage").show();
			$('#dialog-err-msg').empty();
		},
		success: function(response) {
			if (response.html == 'NO') {
				//alert("You can't Delete the Lead source!. \n This Source is used in Leads.");
				$('#dialog-err-msg').show();
				$('#dialog-err-msg').append('One or more Leads/Projects currently mapped to this user. This cannot be deleted.');
				$('html, body').animate({ scrollTop: $('#dialog-err-msg').offset().top }, 500);
				setTimeout('timerfadeout()', 4000);
			} else {
				$.blockUI({
					message:'<br /><h5>Are You Sure Want to Delete?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="processDelete('+id+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
					css:{width:'440px'}
				});
			}
		}          
	});
return false;
}

function processDelete(id) {
	window.location.href = 'user/delete_user/'+id;
}

function cancelDel() {
    $.unblockUI();
}

function timerfadeout() {
	$('.dialog-err').fadeOut();
}

function view_user_logs(id) {
	var params  = {};
	params[csrf_token_name] = csrf_hash_token;
	$.ajax({
		url : site_base_url + 'user/get_user_logs/'+id,
		cache: false,
		type: "POST",
		data:params,
		success : function(response) {
			$('#view-log-container').html(response);
			$.blockUI({
				message:$('#view-log-container'),
				css:{ 
					border: '2px solid #999',
					color:'#333',
					padding:'8px',
					top:  '250px',
					left: ($(window).width() - 700) /2 + 'px',
					width: '765px',
					position: 'absolute',
					'overflow-y':'auto',
					'overflow-x':'hidden',
					position: 'absolute'
				}
			});
			$( "#view-log-container" ).parent().addClass( "no-scroll" );
		}
	});
}

function searchUsers(){

    var params    		     = $('#search-users').serialize();	
    params[csrf_token_name]  = csrf_hash_token;
    $.ajax({
        type: "POST",
        url: site_base_url+'user_region/search_user/',                                                             
        data: params,
        beforeSend:function(){
            $("#user_data").hide();
            $("#ajax_loader").show();
        },
        success: function(response) {
            $("#user_data").html(response);
            $("#user_data").show();
            $("#ajax_loader").hide();
        }          
    });
}

function resetpage(){
    window.location.href = 'user_region';
}

function advanced_filter_pjt(){
	$('#advance_search_pjt').slideToggle('slow');
	var keyword = $("#keywordpjt").val();
	var status  = document.getElementById('advance_search_pjt').style.display;
	
	if(status == 'none') {
		var pjtstage 	= $("#pjt_stage").val(); 
		// var pm_acc	= $("#pm_acc").val();
		var customer	= $("#customer1").val(); 
		var service	 	= $("#services").val();
		var practice 	= $("#practices").val();	
		var divisions 	= $("#divisions").val();
		var pm 			= $("#pm").val();
	} else {
		$("#pjt_stage").val("");
		// $("#pm_acc").val("");
		$("#customer1").val("");
		$("#services").val("");
		$("#practices").val("");
		$("#divisions").val("");
		$("#pm").val("");
	}
}

/////////////////