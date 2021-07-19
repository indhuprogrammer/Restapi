$(function(){
  
  $(".cost_center").chosen().change(function(e, params){
    cost_center = $(this).val();
    id = $(this).data('rand_str');
    $("#service_practice_child_"+id).html('<option value="">Please Select</option>').trigger('liszt:updated');
    $.ajax({
         url: "project_approval/getServicePractParentByCC",
         data: {'cost_center': cost_center,'entity': entity},
         type: "GET",
         success: function(data) { 
            $("#service_practice_parent_"+id).html(data).trigger('liszt:updated');
         }
       });
    $.ajax({
         url: "project_approval/getGrowthEnginesByCC",
         data: {'cost_center': cost_center,'entity': entity},
         type: "GET",
         success: function(data) { 
            $("#growth_engines_"+id).html(data).trigger('liszt:updated');
         }
       });
    });
    
  $(".service_practice_parent").chosen().change(function(e, params){
    service_practice_parent = $(this).val();
    id = $(this).data('rand_str');
    cost_center = $('#cost_center_'+id).val();
    $.ajax({
         url: "project_approval/getServicePractChildByCC",
         data: {'service_practice_parent': service_practice_parent,'cost_center': cost_center,'entity': entity},
         type: "GET",
         success: function(data) { 
            $("#service_practice_child_"+id).html(data).trigger('liszt:updated');
         }
       });
    });
    
  
  
});
