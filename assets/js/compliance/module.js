$(document).ready(function() {
    $('#succes_err_msg').empty();
    
    $('#module_is_active').change(function(){
        if (!$(this).prop("checked")) {
            if(checkUSed() == true){
                $.blockUI({
                    message:'<br /><h5>You have Tickets regarding to this Module. Are you sure to change the status of this module?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="moduleInactive(false); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="moduleInactive(true); return false;">No</button></div></div>',
                    css:{width:'440px'}
                });
            }
        }
    });  
});

function moduleInactive($value){
    $("#module_is_active").prop("checked",$value);
    $.unblockUI();
}

//check module used 
function checkUSed(){
    var moduleId = $("#module_id").val();
    var succeed = false;
    var data = {moduleId: moduleId };
    data[csrf_token_name] = csrf_hash_token;

    $.ajax({
        url: site_base_url+"compliance_module/isUsedModule",
        data: data,
        type: "POST",
        dataType: 'json',
        async: false,
        success: function(resp) {
            if(resp.status == 'fail') {
                succeed = false;
            } else if(resp.status == 'success'){
                succeed = true;
            }
        }		
    });
    
    return succeed;
}
// Checks whether the Module name is duplicated
function checkDuplicateModule() {
    $('#succes_err_msg').empty();

    var moduleName = $("#module_name").val();
    var moduleId = $("#module_id").val();
    var data = {module_name: moduleName, module_id: moduleId };
    data[csrf_token_name] = csrf_hash_token;

    if (moduleName.trim() == "") {
        $('#succes_err_msg').show();
        $('#succes_err_msg').append("<span class='ajx_failure_msg'>Module Name Required.</span>");
        return false;
    } else {
        $.ajax({
            url: site_base_url+"compliance_module/checkDuplicateModule",
            data: data,
            type: "POST",
            dataType: 'json',
            success: function(resp) {
                if(resp.status == 'fail') {
                    $('#succes_err_msg').show();
                    $('#succes_err_msg').append("<span class='ajx_failure_msg'>Module Name Already Exists.</span>");
                    return false;
                } else {
                    document.add_module_form.submit();
                }
            }		
        });
    }
    return false;
}

// Delete the Module
function deleteModule(moduleId) {
    $.blockUI({
        message:'<br /><h5>Are You Sure Want to Delete?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="confirmDelete('+moduleId+'); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">No</button></div></div>',
        css:{width:'440px'}
    });
}

// Redirecting to the Delete url
function confirmDelete(moduleId) {
    window.location.href = site_base_url+'compliance_module/delete/'+moduleId;
}

// Close popup
function cancelDel() {
    $.unblockUI();
}

function timerfadeout() {
    $('.dialog-err').fadeOut();
}
