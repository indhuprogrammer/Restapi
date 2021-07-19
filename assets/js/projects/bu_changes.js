/**
 * BU implementation
 */
$(document).ready(function() {
  
    $("#business_unit_id").change(function() {
      business_unit_id = $('#business_unit_id').val();
      if(business_unit_id){
        $.ajax({
          type: 'POST',
          url: 'getDepartmentByBU',
          data: 'business_unit_id='+business_unit_id+'&'+csrf_token_name+'='+csrf_hash_token,
          success:function(data){
            $('#department_id_fk').html(data);
            $('#practices').html('');
          }			
        });
      }
    });
    $("#department_id_fk").change(function() {
      department_id = $('#department_id_fk').val();
      business_unit_id = $('#business_unit_id').val();
      if(department_id && business_unit_id){
        $.ajax({
          type: 'POST',
          url: 'getPracticeByBUandDept',
          data: 'department_id='+department_id+'&business_unit_id='+business_unit_id+'&'+csrf_token_name+'='+csrf_hash_token,
          success:function(data){
            $('#practices').html(data);
            $('#skill_id').html('');
          }			
        });
      }
    });
    
    $("#practices").change(function() {
  	  department_id = $('#department_id_fk').val();
  	  business_unit_id = $('#business_unit_id').val();
  	  practice_id = $('#practices').val();
  		if(department_id && business_unit_id && practice_id){
  			$.ajax({
  				type: 'POST',
  				url: 'getSkillByBUandDeptandPrac',
  				data: 'department_id='+department_id+'&business_unit_id='+business_unit_id+'&practice_id='+practice_id+'&'+csrf_token_name+'='+csrf_hash_token,
  				success:function(data){
  					$('#skill_id').html(data);
  					$('#skill_id').val($("#skill_id_get").val());
  				}			
  			});
  		}
  	});

});
