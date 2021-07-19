$(document).ready(function() {
    $('.error_alert').empty();
});

// Checks whether the Group name is duplicated
function checkDuplicateFH() {
    $('.error_alert').empty();

    var functionHead = $("#fh_user_id").val();
    var departments = $("#department_ids").val();
    var fhId = $("#fh_id").val();
    var data = {fh_user_id: functionHead, department_ids: departments, fh_id: fhId };
    data[csrf_token_name] = csrf_hash_token;
    var flag = 1;

    if (functionHead == "") {
        $('#fh_error').show();
        $('#fh_error').append("<span class='ajx_failure_msg'>Function Head Required.</span>");
        flag = 0;
    } 
    if(departments == "" || departments == null) {
        $('#dept_error').show();
        $('#dept_error').append("<span class='ajx_failure_msg'>Department selection Required.</span>");
        flag = 0;
    } 
    if (flag) {
        $.ajax({
            url: site_base_url+"compliance_config/checkDuplicateFH",
            data: data,
            type: "POST",
            dataType: 'json',
            success: function(resp) {
                if(resp.status == 'fail') {
                    $('#fh_error').show();
                    $('#fh_error').append("<span class='ajx_failure_msg'>Function Head / Department already Exists.</span>");
                    return false;
                } else {
                    var html = '<input type="text" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" /><input type="text" name="fh_id" value="'+fhId+'" /><input type="text" name="fh_user_id" value="'+functionHead+'" /><input type="text" name="department_ids" value="'+departments+'" />';
                    $('<form>', {
                        "id": "add_fh_form",
                        "html": html,
                        "method": 'POST',
                        "action": ''
                    }).appendTo(document.body).submit();
                }
            }		
        });
    }
    return false;
}

// Delete the Function head
function deleteFunctionHead(fhId) {
    $.blockUI({
        message:'<br /><h5>Are You Sure Want to Delete?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="confirmDelete('+fhId+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
        css:{width:'440px'}
    });
}

// Redirecting to the Delete url
function confirmDelete(fhId) {
    window.location.href = site_base_url+'compliance_config/delete/'+fhId;
}

// Close popup
function cancelDel() {
    $.unblockUI();
}

function timerfadeout() {
    $('.dialog-err').fadeOut();
}

// Add CISO
function addCiso() {
    $('.error_alert').empty();
    var ciso = $("#ciso_user_id").val();

    if (ciso == "") {
        $('#ciso_error').show();
        $('#ciso_error').append("<span class='ajx_failure_msg'>CISO Required.</span>");
    } else {
        var html = '<input type="text" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" /><input type="text" name="ciso_user_id" value="'+ciso+'" />';
        $('<form>', {
            "id": "add_ciso_form",
            "html": html,
            "method": 'POST',
            "action": ''
        }).appendTo(document.body).submit();
    }
    
    return false;
}

