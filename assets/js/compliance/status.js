$(document).ready(function() {
    $('#succes_err_msg').empty();
});

// Checks whether the Status name is duplicated
function checkDuplicateStatus() {
    $('#succes_err_msg').empty();

    var statusName = $("#status_name").val();
    var statusId = $("#status_id").val();
    var data = {status_name: statusName, status_id: statusId };
    data[csrf_token_name] = csrf_hash_token;

    if (statusName.trim() == "") {
        $('#succes_err_msg').show();
        $('#succes_err_msg').append("<span class='ajx_failure_msg'>Status Name Required.</span>");
        return false;
    } else {
        $.ajax({
            url: site_base_url+"compliance_status/checkDuplicateStatus",
            data: data,
            type: "POST",
            dataType: 'json',
            success: function(resp) {
                if(resp.status == 'fail') {
                    $('#succes_err_msg').show();
                    $('#succes_err_msg').append("<span class='ajx_failure_msg'>Status Name Already Exists.</span>");
                    return false;
                } else {
                    document.add_status_form.submit();
                }
            }		
        });
    }
    return false;
}

// Delete the Status
function deleteStatus(statusId) {
    $.blockUI({
        message:'<br /><h5>Are You Sure Want to Delete?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="confirmDelete('+statusId+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
        css:{width:'440px'}
    });
}

// Redirecting to the Delete url
function confirmDelete(statusId) {
    window.location.href = site_base_url+'compliance_status/delete/'+statusId;
}

// Close popup
function cancelDel() {
    $.unblockUI();
}

function timerfadeout() {
    $('.dialog-err').fadeOut();
}
