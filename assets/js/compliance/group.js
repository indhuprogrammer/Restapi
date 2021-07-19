$(document).ready(function() {
    $('.error_alert').empty();
});

// Checks whether the Group name is duplicated
function checkDuplicateGroup() {
    $('.error_alert').empty();

    var groupName = $("#group_name").val();
    var groupId = $("#group_id").val();
    var memberId = $("#member_id").val();
    var data = {group_name: groupName, group_id: groupId };
    data[csrf_token_name] = csrf_hash_token;
    var flag = 1;

    if (groupName.trim() == "") {
        $('#group_name_error').show();
        $('#group_name_error').append("<span class='ajx_failure_msg'>Group Name Required.</span>");
        flag = 0;
    } 
    if(memberId == "" || memberId == null) {
        $('#member_error').show();
        $('#member_error').append("<span class='ajx_failure_msg'>Member selection Required.</span>");
        flag = 0;
    } 
    if (flag) {
        $.ajax({
            url: site_base_url+"compliance_group/checkDuplicateGroup",
            data: data,
            type: "POST",
            dataType: 'json',
            success: function(resp) {
                if(resp.status == 'fail') {
                    $('#group_name_error').show();
                    $('#group_name_error').append("<span class='ajx_failure_msg'>Group Name Already Exists.</span>");
                    return false;
                } else {
                    var html = '<input type="text" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" /><input type="text" name="group_id" value="'+groupId+'" /><input type="text" name="group_name" value="'+groupName+'" /><input type="text" name="member_id" value="'+memberId+'" />';
                    $('<form>', {
                        "id": "add_group_form",
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

// Delete the Group
function deleteGroup(groupId) {
    $.blockUI({
        message:'<br /><h5>Are You Sure Want to Delete?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="confirmDelete('+groupId+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
        css:{width:'440px'}
    });
}

// Redirecting to the Delete url
function confirmDelete(groupId) {
    window.location.href = site_base_url+'compliance_group/delete/'+groupId;
}

// Close popup
function cancelDel() {
    $.unblockUI();
}

function timerfadeout() {
    $('.dialog-err').fadeOut();
}

