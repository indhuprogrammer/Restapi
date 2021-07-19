// Loads the transition view on 'Edit' button clicked
function loadTransitionView() {
    $('.error_alert').empty();
    
    var trackerId = $("#tracker_id").val();
    var roleId = $("#role_id").val();
    var isTransitionType = $("input[name='transition_type']:checked").length;
    var transitionType = $("input[name='transition_type']:checked").val();
    var data = {tracker_id: trackerId, role_id: roleId, transition_type: transitionType };
    data[csrf_token_name] = csrf_hash_token;
    var flag = 1;
    var url = site_base_url+"compliance_workflow/loadStateTransitionView";
    if (transitionType == 'field') {
        url = site_base_url+"compliance_workflow/loadFieldTransitionView";
    }

    if (trackerId == "") {
        $('#tracker_error').show();
        $('#tracker_error').append("<span class='ajx_failure_msg'>Tracker Required.</span>");
        flag = 0;
    } 
    if (roleId == "") {
        $('#role_error').show();
        $('#role_error').append("<span class='ajx_failure_msg'>Role Required.</span>");
        flag = 0;
    } 
    if (!isTransitionType) {
        $('#transition_type_error').show();
        $('#transition_type_error').append("<span class='ajx_failure_msg'>Transition type required.</span>");
        flag = 0;
    }
    
    if (flag) {
        $.ajax({
            url: url,
            data: data,
            type: "POST",
            dataType: 'json',
            success: function(resp) {
                //alert(resp.view);
                $("#transition_view").html(resp.view);
                $('.accordian-body table#field_workflow tbody').scroll(function(e) { //detect a scroll event on the tbody
                    /*
                  Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
                  of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain 			it's relative position at the left of the table.    
                  */
                  $('#field_workflow thead').css("left", -$("#field_workflow tbody").scrollLeft()); //fix the thead relative to the body scrolling
                  $('#field_workflow thead th:nth-child(1)').css("left", $("#field_workflow tbody").scrollLeft()); //fix the first cell of the header
                  $('#field_workflow tbody td:nth-child(1)').css("left", $("#field_workflow tbody").scrollLeft()); //fix the first column of tdbody
                  
                });

                $('.accordian-body table#author_workflow tbody').scroll(function(e) { //detect a scroll event on the tbody
                    /*
                  Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
                  of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain 			it's relative position at the left of the table.    
                  */
                  $('#author_workflow thead').css("left", -$("#author_workflow tbody").scrollLeft()); //fix the thead relative to the body scrolling
                  $('#author_workflow thead th:nth-child(1)').css("left", $("#author_workflow tbody").scrollLeft()); //fix the first cell of the header
                  $('#author_workflow tbody td:nth-child(1)').css("left", $("#author_workflow tbody").scrollLeft()); //fix the first column of tdbody
                });

                $('.accordian-body table#assignee_workflow tbody').scroll(function(e) { //detect a scroll event on the tbody
                    /*
                  Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
                  of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain 			it's relative position at the left of the table.    
                  */
                  $('#assignee_workflow thead').css("left", -$("#assignee_workflow tbody").scrollLeft()); //fix the thead relative to the body scrolling
                  $('#assignee_workflow thead th:nth-child(1)').css("left", $("#assignee_workflow tbody").scrollLeft()); //fix the first cell of the header
                  $('#assignee_workflow tbody td:nth-child(1)').css("left", $("#assignee_workflow tbody").scrollLeft()); //fix the first column of tdbody
                });
            }		
        });
    }
    return false;
}

$('form#add_workflow_form').submit(function(){
    $(this).find('#add_workflow').prop('disabled', true);
});

$(document).ready(function(){
    var config = {
        '.chzn-select'           : {},
        '.chzn-select-deselect'  : {allow_single_deselect:true},
        '.chzn-select-no-single' : {disable_search_threshold:10},
        '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chzn-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    
    $("#role_id > option").each(function() {
        if(this.value !== '')
            $(this).hide();
        
        $("#role_id").trigger("liszt:updated");
    }); 
    
    $('#tracker_id').change(function(){
        $(this).children('option').show();
        $("#role_id").val("");

        var allowRoles = ($(this).find('option:selected').attr("trackertype") == '1') ? complianceRoles_arr : issueRoles_arr;
        console.log(allowRoles);        
        $("#role_id > option").each(function() {
            let roleValue = this.value;            
            if(allowRoles.indexOf(roleValue) > -1){
                $(this).show();
            }else{
                $(this).hide();
            }
        });
        $("#role_id").trigger("liszt:updated");
    });
});

