$(document).ready(function() {
    $('.error_alert').empty();
});

// Checks whether the Group name is duplicated
function checkDuplicateTracker() {
    $('.error_alert').empty();

    var trackerName = $("#tracker_name").val();
    var trackerId = $("#tracker_id").val();
    var trackerType = $('#tracker_type').val();
    var statusId = $("#status_id").val();
//    var moduleId = $("#module_id").val();
    var moduleId = [];
    $.each($("input[name='module_id']:checked"), function(){            
        moduleId.push($(this).val());
    });
    moduleId.join();
    var fields_joined = '';
    var fieldId = [];
    $.each($("input[name='field_id']:checked"), function(){            
        fieldId.push($(this).val());
    });
    fields_joined = fieldId.join();
    var fieldDetails = [];
    var fields = '';
    $.each( fieldList, function( key, value ) {
        var is_active = 0;
        $.each( fieldId, function( key_ch, value_ch ) {
            if(value_ch == value.field_id){
                is_active = 1;
            }
        });
        fieldDetails.push({field_id : value.field_id,is_active:is_active});
    });
    fields = JSON.stringify(fieldDetails, null, 4);

    var data = {tracker_name: trackerName, tracker_id: trackerId };
    data[csrf_token_name] = csrf_hash_token;
    var flag = 1;

    if (trackerName.trim() == "") {
        $('#tracker_name_error').show();
        $('#tracker_name_error').append("<span class='ajx_failure_msg'>Tracker Name Required.</span>");
        flag = 0;
    } 
    if(trackerType == ''){
        $('#tracker_type_error').show();
        $('#tracker_type_error').append("<span class='ajx_failure_msg'>Tracker Type Required.</span>");
        flag = 0;
    }
    if (statusId == "") {
        $('#status_error').show();
        $('#status_error').append("<span class='ajx_failure_msg'>Status Required.</span>");
        flag = 0;
    } 
    /*
    if ((projectId == "" && trackerProjList.length <= 0 ) || (projectId == null && trackerProjList.length <= 0)) {
        $('#project_error').show();
        $('#project_error').append("<span class='ajx_failure_msg'>Project Required.</span>");
        flag = 0;
    }
    */
    if (moduleId == ""  || moduleId == null) {
        $('#module_error').show();
        $('#module_error').append("<span class='ajx_failure_msg'>Module Required.</span>");
        flag = 0;
    }
    if (fields_joined == "" || fieldId == null) {
        $('#field_error').show();
        $('#field_error').append("<span class='ajx_failure_msg'>Field Required.</span>");
        flag = 0;
    }
    if (flag) {
        $.ajax({
            url: site_base_url+"compliance_tracker/checkDuplicateTracker",
            data: data,
            type: "POST",
            dataType: 'json',
            success: function(resp) {
                if(resp.status == 'fail') {
                    $('#tracker_name_error').show();
                    $('#tracker_name_error').append("<span class='ajx_failure_msg'>Tracker Name Already Exists.</span>");
                } else {
                    // Commented the project field
//                    var html = '<input type="text" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" /><input type="text" name="tracker_id" value="'+trackerId+'" /><input type="text" name="tracker_type" value="'+trackerType+'" /><input type="text" name="tracker_name" value="'+trackerName+'" /><input type="text" name="status_id" value="'+statusId+'" /><input type="text" name="module_id" value="'+moduleId+'" /><input type="text" name="project_id" value="'+projectId+'" /><textarea name="field_id" >'+fields+'</textarea>';
                    var html = '<input type="text" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" /><input type="text" name="tracker_id" value="'+trackerId+'" /><input type="text" name="tracker_type" value="'+trackerType+'" /><input type="text" name="tracker_name" value="'+trackerName+'" /><input type="text" name="status_id" value="'+statusId+'" /><input type="text" name="module_id" value="'+moduleId+'" /><textarea name="field_id" >'+fields+'</textarea>';
                    $('<form>', {
                        "id": "add_tracker_form",
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

// Delete the Tracker
function deleteTracker(trackerId) {
    $.blockUI({
        message:'<br /><h5>Are You Sure Want to Delete?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="confirmDelete('+trackerId+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
        css:{width:'440px'}
    });
}

// Redirecting to the Delete url
function confirmDelete(trackerId) {
    window.location.href = site_base_url+'compliance_tracker/delete/'+trackerId;
}

// Close popup
function cancelDel() {
    $.unblockUI();
}

function timerfadeout() {
    $('.dialog-err').fadeOut();
}

