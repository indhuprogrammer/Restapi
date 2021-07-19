$(document).ready(function() {
    
    $( document ).tooltip();
    
    var config = {
        '.chzn-select, .chzn-ignore'           : {search_contains: true},
        '.chzn-select-deselect, .chzn-ignore-deselect'  : {allow_single_deselect:true},
        '.chzn-select-no-single, .chzn-ignore-no-single' : {disable_search_threshold:10},
        '.chzn-select-no-results, .chzn-ignore-no-results': {no_results_text:'Oops, nothing found!'},
        '.chzn-select-width, .chzn-ignore-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    $('#module_id').change(function(){
        var moduleid = this.value;
        if(moduleid != ''){
            getTrackerList(moduleid);
        }
    })

    // Tracker onChange event
    $("#tracker_id").change(function(){
        var trackerId = this.value;
        $('#form_fields').html('');
        $('#project_id').html('<option value="">Please Select</option>');
        //old_trackerChange(tracker);
        if (trackerId != '') {
            getProjectList(trackerId);
        }
    });
    
    
    
    $('.mandatory').each(function() {
        $(this).rules("add",{
            required: true
        })
    });  
    
    $("#project_id").change(function(){
        var form_type = $("#form_type").val();
        if(form_type == 'edit'){
            console.log('compliance edit');
            var ticketId = $("#ticket_id").val();
            loadFormFields('compliance_creation',ticketId);
        }
        
        return false;
    });
    
    // Load the form fields when 'Next' btn is clicked
    $(document).on('click', '#compliance_next_btn', function () {
        loadFormFields('compliance_creation');
    });
    
    
    $(document).on( 'click', '.remove-btn', function(){
        $(this).parent().remove();
    });

    $(document).on('click',"#more-attachments",function(){
        var element = $(".attachments");
        var elementName = element.attr('name');
        $("#text").append("<div class='added-field buttons' style='padding:0;'><input name='"+elementName+"' class='uploads textfield width200px' style='display:block;' type='file' /><button type='button' class='remove-btn negative' style='padding: 2px 7px;float:none;font-size: 11px;font-weight: normal;line-height: 1.1;margin: 0 0 5px;margin-left: 155px;'><i class='fa fa-minus fa-2' aria-hidden='true'></i></button></div>");
    });
    
    $(document).on('change',"#"+statusId,function(){
        // remove validations rules before updating the fields
        $('.mandatory').each(function() {
            $(this).rules('remove', 'required');
        }); 
        
        $("#ajax_loader_new").show();
        var status = $(this).val();
        var statusLabel = $('#'+statusId+' option:selected').text();
        var token = $('#token').val();
        var ticketId = $('#ticket_id').val();
        var url = 'compliance/fieldsFromStatus'; 
        $.ajax({
            type: 'post',
            url: url,  
            data:{'ticketId':ticketId,'status':status,'ci_csrf_token':token},	  
            success: function(resultData) { 
                
                $("#ajax_loader_new").hide();
                $("#edit_ticket").html(resultData);                
                var statusReadonly = $('#readonly'+statusId).length;
                if(statusReadonly == 1){
                    $('#readonly'+statusId).text(statusLabel);
                }else{
                    $("#"+statusId).val(status);
                }            
                var config = {
                    '.chzn-select, .chzn-ignore'           : {search_contains: true},
                    '.chzn-select-deselect, .chzn-ignore-deselect'  : {allow_single_deselect:true},
                    '.chzn-select-no-single, .chzn-ignore-no-single' : {disable_search_threshold:10},
                    '.chzn-select-no-results, .chzn-ignore-no-results': {no_results_text:'Oops, nothing found!'},
                    '.chzn-select-width, .chzn-ignore-width'     : {width:"95%"}
                }
                for (var selector in config) {
                    $(selector).chosen(config[selector]);
                }
                // To apply the validation
                $('.addCompliance').each(function(i, el){        
                    var settings = $.data(this, 'validator').settings;
                    settings.ignore += ':not(.chzn-select)';        
                });
                // Set required to the Form fields
                $('.mandatory').each(function() {
                    $(this).rules("add",{
                        required: true
                    })
                }); 
                // Refreshing impact fields tooltip
                refreshTooltip();
            }
        });
    });
    
});

// Loading the form fields when 'Next' btn is clicked
function loadFormFields(callFrom,ticketId = '') {
    var form_type = $("#form_type").val();
    var moduleId = $('#module_view_div #module_id').val();
    var trackerId = $('#tracker_view_div #tracker_id').val();
    var projectId = $('#project_view_div #project_id').val();
//    alert(moduleId+'-'+trackerId+'-'+projectId);return false;
    var flag = 1;
    if (callFrom != "quality_metrix") { // For Compliance creation page
        moduleId = $('#module_edit_div #module_id').val();
        trackerId = $('#tracker_edit_div #tracker_id').val();
        projectId = $('#project_edit_div #project_id').val();
        var moduleName = $('#module_id option:selected').text();
        var trackerName = $('#tracker_id option:selected').text();
        var projectName = $('#project_id option:selected').text();
        $(".error_class").text("");
        if (moduleId == '') {
            $("#module_id_error").text("This field is required.");
            flag = 0;
        }
        if (trackerId == '') {
            $("#tracker_id_error").text("This field is required.");
            flag = 0;
        }
        if (projectId == '') {
            $("#project_id_error").text("This field is required.");
            flag = 0;
        }
    }
    
    if (flag) {
        var defaultStatus = $("#tracker_default_status").val();
        if (callFrom != "quality_metrix") { // For Compliance creation page
            defaultStatus = $('#tracker_id option:selected').attr('status');
        }
        
        getFieldList(trackerId, function () {
            var assignee_field_id = $('#assignee_field_id').val();
            var IsfieldExists = $("#"+assignee_field_id).length;
            
            var statusField = $('#status_field_id').val();
            $("#defaultStatus").val(defaultStatus);
            setTimeout(() => {
                $("#"+statusField).val(defaultStatus).trigger('liszt:updated');
                $("#"+statusField).attr('disabled','disabled').trigger('liszt:updated');
            }, 500);
            
            // Load project members list in assignee field for fresh tickets
            if(ticketId == ''){
                $('#'+assignee_field_id).html('<option value="">Please Select</option>'); 
                getMembersList(projectId,IsfieldExists);
            }            
            $("#"+assignee_field_id).trigger("liszt:updated");
            getProjectSpecificDropdownValues(projectId);

            if (callFrom != "quality_metrix") { // For Compliance creation page
                // Swap the submit buttons(Next & Submit)
                $("#compliance_next_btn").css("display", "none");
                $("#compliance_submit_btn").css("display", "");
                $("#compliance_submit_continue_btn").css("display", "");
                $("#compliance_back_btn_div").css("display", "");
                // Enable/Disable the primary selections (Module,Tracker & Project)
                if(form_type  == 'add'){
                    $("#module_edit_div").css("display","none");
                    $("#module_view_div").css("display","");
                    $("#module_name_text").text(moduleName);
                    $("#module_name").val(moduleName.trim());
                    $("#tracker_edit_div").css("display","none");
                    $("#tracker_view_div").css("display","");
                    $("#tracker_name_text").text(trackerName);
                    $("#tracker_name").val(trackerName.trim());
                    $("#project_edit_div").css("display","none");
                    $("#project_view_div").css("display","");
                    $("#project_name_text").text(projectName);
                    $("#project_name").val(projectName.trim());
                }
                // Hide the mandatory symbols
                $(".required_symbol").text("");
                // Storing the values in the hidden inputs
                $('#module_view_div #module_id').val(moduleId);
                $('#tracker_view_div #tracker_id').val(trackerId);
                $('#project_view_div #project_id').val(projectId);
            }
        },projectId,defaultStatus,ticketId);
    }
}

// Tracker onChange process (Old process)
function old_trackerChange(tracker) {
    if(tracker != ''){
        // getModuleList(tracker);
        getFieldList(tracker, function () {
            // Check whether the project id available (from Quality metrics tab)
            var projectId = $("#chosen_project_id").val();
            if (projectId == "") {
                getProjectList(tracker);
            } else {
                var assignee_field_id = $('#assignee_field_id').val();
                // var IsfieldExists = $("#"+assignee_field_id).length;
                // var isProjectMembersPopulate = false; // Project members should not be populated as its coming from quality metrics tab.
                // getMembersList(projectId,IsfieldExists,isProjectMembersPopulate);
            } 
        });
        var statusField = $('#status_field_id').val();
        var defaultStatus = $('#tracker_id option:selected').attr('status');
        $("#defaultStatus").val(defaultStatus);
        setTimeout(() => {
            $("#"+statusField).val(defaultStatus).trigger('liszt:updated');
            $("#"+statusField).attr('disabled','disabled').trigger('liszt:updated');
        }, 1000);
    }
}

function checkStatusTransition(trackerId){
    var url = site_base_url+'compliance/getTransitionStatus'; 
    var status = 'n';
    $.ajax({
        type: 'get',
        url: url,  
        data:{'trackerId':trackerId,'projectId':projectId,'ci_csrf_token':$('token').val()},	  
        success: function(resultData) { 
            status = resultData;
        },
        async: false
        
    });

    return status;
}

function getModuleList(trackerId){
    
    var url = site_base_url+'compliance/getTrackerModules'; 
//    console.log('<option value="">Please Select</option>');
    $.ajax({
        type: 'get',
        url: url,  
        data:{'trackerId':trackerId,'ci_csrf_token':$('token').val()},	  
        success: function(resultData) { 
//            console.log('<option value="">Please Select</option>'+resultData);
            $('#module_id').html('<option value="">Please Select</option>'+resultData); 
        }
    });
}

function getTrackerList(moduleId){
    
    var form_type = $("#form_type").val();
    if(form_type == 'add'){
        $("#tracker_id").val(""); // Reset tracker value
        $("#tracker_id > option").each(function(){
            $(this).hide();
        });

        if(moduleId !== ""){
            $("#tracker_id > option").each(function(){
                let module = $(this).data('module');
                if(module == moduleId || module == '')
                    $(this).show();
            });
        }
        $("#tracker_id").trigger("liszt:updated");
    }else{
        var url = site_base_url+'compliance/getModuleTrackers'; 
        $.ajax({
            type: 'get',
            url: url,  
            data:{'moduleId':moduleId,'ci_csrf_token':$('token').val()},	  
            success: function(resultData) { 
                $('#tracker_id').html('<option value="">Please Select</option>'+resultData); 
                $("#tracker_id").trigger("liszt:updated");
            }
        });
    }
    
    


}

function getProjectList(trackerId){
    
    var url = site_base_url+'compliance/getTrackerProjects'; 
//    console.log('<option value="">Please Select</option>');
    $.ajax({
        type: 'get',
        url: url,  
        data:{'trackerId':trackerId,'ci_csrf_token':$('token').val()},	  
        success: function(resultData) { 
//            console.log('<option value="">Please Select</option>'+resultData);
            $('#project_id').html('<option value="">Please Select</option>'+resultData); 
            $("#project_id").trigger("liszt:updated");
        }
    });
}

function getFieldList(trackerId, callback,projectId,defaultStatus,ticketId=''){ 

    $('#ajax_loader').show();
    var url = site_base_url+'compliance/getTrackerFields'; 
//    console.log('<option value="">Please Select</option>');
    $.ajax({
        type: 'get',
        url: url,  
        data:{'trackerId':trackerId,'projectId':projectId,
            'defaultStatus':defaultStatus,'ticketId':ticketId,
            'ci_csrf_token':$('token').val()},	  
        success: function(resultData) { 
            $('#ajax_loader').hide();
            $('#form_fields').html(resultData);
            var config = {
                '.chzn-select'           : {search_contains: true},
                '.chzn-select-deselect'  : {allow_single_deselect:true},
                '.chzn-select-no-single' : {disable_search_threshold:10},
                '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chzn-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
            
            // To apply the validation
            $('.addCompliance').each(function(i, el){        
                var settings = $.data(this, 'validator').settings;
                settings.ignore += ':not(.chzn-select)';        
            });
            
            // Remove required to the Form fields            
            $(".addCompliance").each(function(){
                var inputs = $(this).find(':input'); //<-- Should return all input elements in that specific form.
                inputs.each(function(){
                    $(this).rules('remove', 'required');
                })
            });
    
            // Set required to the Form fields
            $('.mandatory').each(function() {
                $(this).rules("add",{
                    required: true
                })
            }); 
            
            // Call back function - getProjectList()
            callback();
            // Refreshing impact fields tooltip
            refreshTooltip();
        }
    });
}

function getMembersList(projectId, IsfieldExists){
    console.log('memeberlist');
    var url = site_base_url+'compliance/getMembersList'; 
    $.ajax({
        type: 'get',
        url: url,  
        data:{'projectId':projectId,'ci_csrf_token':$('token').val()},	  
        success: function(resultData) { 
            if(resultData == 'error'){
                $('<p id="member_error" class="ajx_failure_msg">Members not yet assigned to this Project.</p>').insertAfter('#project_id_chzn');
            } else{
                $('#member_error').remove();
                $('#members').html('<option value="">Please Select</option>'+resultData); 
                $("#members").trigger("liszt:updated");
                if(IsfieldExists){
                    var assignee_field_id = $('#assignee_field_id').val();
                    $('#'+assignee_field_id).html('<option value="">Please Select</option>'+resultData); 
                    $("#"+assignee_field_id).trigger("liszt:updated");
                }
            }
        }
    });
}

// Load the popup for adding dropdown value
function loadDropdownValuePopup(obj) {
    var fieldId = $(obj).attr("data-field_id");
    var fieldName = $(obj).attr("data-field_name");
    var isProjVersionField = ($(obj).attr("data-project_version")) ? 1 : 0;
    var isProjSpecificField = ($(obj).attr("data-project_specific")) ? 1 : 0;
    var projectId = $("#project_id").val();
    $("#project_id_error").text("");
    
    if (isProjSpecificField == 1 && projectId == "") {
        $("#project_id_error").text("Please select Project.");
    } else {
        $('#dropdown_title').html("Add "+fieldName);		
        var url = site_base_url+"compliance/loadDropdownValueFormPopup/";
        $('#add_dropdown_value_view').load(url, function () {
            $.blockUI({
                message: $('#add_dropdown_value_popup'),
                css: { border: '2px solid #999',color:'#333',padding:'8px',width: '500px',position: 'fixed', maxHeight: '450px', 'overflow-y':'auto', 'overflow-x':'hidden', 'top':'50%', 'left':'50%','transform':'translate(-50%,-50%)'}			
            });
            $("#add_dropdown_value_view #field_label").text(fieldName);
            $("#add_dropdown_value_view #field_id").val(fieldId);
            $("#add_dropdown_value_view #is_project_specific_field").val(isProjSpecificField);
            $("#add_dropdown_value_view #is_project_version_field").val(isProjVersionField);
        });
    }
}

// Close popup
$(document).on('click', ".file-tabs-close-project", function() {
    closePopup();
});
function closePopup() {
    $.unblockUI();
    return false;
}

// Add Dropdown value
function addDropdownValue() {
    var fieldValue = $("#field_value").val().trim();
    var fieldId = $("#field_id").val();
    var projectId = $("#project_id").val();
    var isProjSpecificField = $("#is_project_specific_field").val();
    var isProjVersionField = $("#is_project_version_field").val();
    var projVersionFieldIdsStr = $("#proj_version_field_ids").val();
    var projVersionFieldIds = [];
    
    if (fieldValue == "") {
        $("#field_error_text").text("Field should not be empty.");
    } else {
        var url = site_base_url+'compliance/addDropdownVlaue';
        var csrfToken = $("#csrf_token").val();
        $("#field_error_text").text("");
        var data = {'field_value': fieldValue,'field_id': fieldId,'ci_csrf_token': csrfToken};
        if (isProjSpecificField == 1 && projectId != "") {
            data['project_id'] = projectId;
        }
        if (isProjVersionField == 1 && projectId != "") {
            data['project_version_field'] = 1;
        }
        
        $.ajax({
            type: 'post',
            url: url,  
            data: data,
            success: function(resp) { 
                var result = $.parseJSON(resp);
                if (result.status == "success") {
                    getProjectSpecificDropdownValues(projectId);
                    $('#'+fieldId).append('<option value="'+result.field_value_id+'">'+fieldValue+'</option>').val(result.field_value_id).trigger('liszt:updated');
                    closePopup();
                } else {
                    $("#field_error_text").text(result.message);
                }
            }
        });
    }
}

// Fetch the project specific dropdown list
function getProjectSpecificDropdownValues(projectId) {
    var url = site_base_url+'compliance/getProjectSpecificDropdownValues';
    var csrfToken = $("#token").val();
    $.ajax({
        type: 'post',
        url: url,  
        data: { 'project_id': projectId, 'ci_csrf_token': csrfToken },
        success: function(resp) { 
            var result = $.parseJSON(resp);
//            console.log(result);
            if (result.status == "success" && result.dropdown_data != 'undefined') {
                $.each(result.dropdown_data, function (fieldId,fieldData) {
                    var selectedValue = $('#'+fieldId).val();
                    $('#'+fieldId+" option[value != '']").remove();
                    $('#'+fieldId).trigger('liszt:updated');
//                    console.log(fieldId);
                    if (fieldData != 'undefined') {
                        $.each(fieldData, function (key,value) {
                            $('#'+fieldId).append('<option value="'+value.field_value_id+'">'+value.field_value+'</option').val('').trigger('liszt:updated');
                        });
                        $('#'+fieldId).val(selectedValue);
                        $('#'+fieldId).trigger('liszt:updated');
                    }
                });
            } else {
//                $("#field_error_text").text(result.message);
            }
        }
    });
}

// Load the popup to display the Ticket change details
function loadTicketViewPopup(historyId) {
    var ticketId = $("#ticket_id").val();
    if (ticketId) {
        var url = site_base_url+"compliance/loadTicketViewPopup/"+ticketId+"/"+historyId;
        $('#ticket_view_popup_content').load(url, function () {
            $.blockUI({
                message: $('#ticket_view_popup'),
                css: { border: '2px solid #999',color:'#333',padding:'8px',width: '650px',position: 'fixed', maxHeight: '450px', 'overflow-y':'auto', 'overflow-x':'hidden', 'top':'50%', 'left':'50%','transform':'translate(-50%,-50%)'}			
            });
        });
    }
    return false;
}

// Calling the loadFormFields func when the Create ticket page is redirected from the Quality metrics page
if (qualityMetrix) {
    loadFormFields('quality_metrix')
}

$(document).on("change", 'input[type="file"]', function() {
    
    var fileExtension = allowedExtensions_arr;
    var allowedFileSizeKb = parseInt(allowedFileSize) * 1024; 
    $('.compliance_attachment_error').remove();
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {        
        $(this).after('<p class="compliance_attachment_error">Invalid file format uploaded</p>');
        $(this).val("");
    }else{
        var fileSize = this.files[0].size;        
        const fileKb = Math.round((fileSize / 1024));
        if(parseInt(fileKb) > parseInt(allowedFileSizeKb)){
            $(this).after('<p class="compliance_attachment_error">Max. Allowed file size is '+allowedFileSize+' MB</p>');
            $(this).val("");
        }
    }
});
// NC type based severity field value update
$(document).on('change', 'select', function(){
    var fieldId = $(this).attr("id");
    // get the field id and check is that nc type field
    if(nctype_array.indexOf(fieldId) !== -1){
        var nctype_key = '';
        // Iterate the nc type fields to get their values
        nctype_array.forEach(function(ncFieldId) {
            var ncFieldValue = $("#"+ncFieldId).val();
            // formatting string from the selected values
            nctype_key += ncFieldValue+',';
        });
        // remove last comma from string
        nctype_key = nctype_key.replace(/,\s*$/, "");
        // If formatted string existed as a key in combo array
        // then get their respective value and set into severity field
        if(nctype_key in nctype_combo){
            ncValue = nctype_combo[nctype_key];
            if($("#"+severity_field).length){
                if(ncValue == observation_value)
                    $("#"+severity_field).val(severity_minor).trigger('liszt:updated');
                else    
                    $("#"+severity_field).val(ncValue).trigger('liszt:updated');
                
                checkseverity(ncValue);
            }
        }
    } 
    
    /*if(fieldId == severity_field){
        var fieldValue = $("#"+severity_field).val();
        checkseverity(fieldValue);
    }*/
});

function checkseverity(ncValue){
    var trackerId = $("#tracker_id").val();
    if(ncValue == observation_value && trackerId != observation_tracker){        
        $.blockUI({
            message: $("#observation_tracker_confirmation"),
            css:{padding:'10px'}
            //css: { border: '2px solid #999',color:'#333',padding:'8px',width: '500px',position: 'fixed', maxHeight: '450px', 'overflow-y':'auto', 'overflow-x':'hidden', 'top':'50%', 'left':'50%','transform':'translate(-50%,-50%)'}			
        });
    }
}

function switchTracker(){
    var ticketId = '';
    if($("#ticket_id").length)
        ticketId = $("#ticket_id").val();
    
    $("#tracker_id").val(observation_tracker).trigger('liszt:updated');
    loadFormFields('compliance_creation',ticketId);
    $.unblockUI();
}

function refreshTooltip(){
    console.log('tooltip');
    $( document ).tooltip({
        position: { my: "left+10 center", at: "right center" }
    });
}