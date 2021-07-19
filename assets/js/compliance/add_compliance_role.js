/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
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
    
    $('#member_id').on('change', function() {

        var $sel = $(this),
        val = $(this).val(),
        $opts = $sel.children(),
        prevUnselected = $sel.data('unselected');
        
        // create array of currently unselected 
        var currUnselected = $opts.not(':selected').map(function() {
            return this.value
        }).get();
        // see if previous data stored
        if (prevUnselected) {
            var unselected = currUnselected.reduce(function(a, curr) {
                if ($.inArray(curr, prevUnselected) == -1) {
                    a.push(curr)
                }
                return a
            }, []);

            // "unselected" is an array if it has length some were removed
            if (unselected.length) {
                var currentUnselected = unselected.join(', ');
                var url = site_base_url+'compliance_role/isUserProjectMapped'; 
                $.ajax({
                    type: 'get',
                    url: url,  
                    data:{'userId':currentUnselected,'ci_csrf_token':$('token').val()},	  
                    success: function(resultData) {
                        
//                        if ((resultData > 0) && !confirm('The Unselected User already Mapped with Project, Do you want to Proceed to remove from that Projects Too ?')) {
//                            $("#member_id option[value='" + currentUnselected + "']").prop("selected", true);
//                            $("#member_id").trigger("liszt:updated");
//                            //Removing current value from array
//                            position = currUnselected.indexOf(currentUnselected);
//                            currUnselected.splice(position, 1);
//                        }
       
//                        console.log(resultData); return false;
                        
                        if (resultData > 0){
                            $.blockUI({
                                message:'<br /><h5>The Unselected User already Mapped with Project, Do you want to Proceed to remove from that Projects Too ?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="unselectUser(true,'+currentUnselected+');">Yes</button><button type="submit" class="negative" onclick="unselectUser(false,'+currentUnselected+');">No</button></div></div>',
                                css:{width:'440px'}
                            });                       
                        }         
                    }
                });
            }
        }
        $sel.data('unselected', currUnselected);
    }).change();
    
});


function unselectUser(isConfirm,currentUnselected){   
                        
    var $opts = $("#member_id").children();
    // create array of currently unselected 
    var currUnselected = $opts.not(':selected').map(function() {
            return this.value
    }).get();
    
//    console.log(currentUnselected);
//    console.log(currUnselected);
    
    if(isConfirm == false){
        $("#member_id option[value='" + currentUnselected + "']").prop("selected", true);
        $("#member_id").trigger("liszt:updated");
        //Removing current value from array
        position = currUnselected.indexOf(currentUnselected);
        currUnselected.splice(position, 1);
    }
    
    $("#member_id").data('unselected', currUnselected);
    $.unblockUI();
}