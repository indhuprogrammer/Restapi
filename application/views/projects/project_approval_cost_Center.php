<?php 
if($time){
  $unique = $time;
}else{
  $unique = $cc_industry_mas->lead_industries_id;
}
 ?>
<div class="cc_grid <?= 'cc_div_'.$unique ?>">
  <br>
  <table class="cost_table" >
      <tr>
        <th colspan="4">Cost Center <span class="close-btn-style remove_cc" val="<?= $unique ?>">X</span></th>
        <input type="hidden" name="lead_industries_id[]" value="<?php echo $cc_industry_mas->lead_industries_id ?>">
      </tr>
      <tr>
            <td >Cost Center: <span class="mandatory_asterick">*</span></td>
            <td  style="padding-bottom: 8px;">
               <select name="cost_center[]" class="textfield width200px errormsg chzn-select-width cost_center" id="cost_center_<?= $unique ?>" data-rand_str = "<?= $unique ?>" >
                  <option value="">Please Select</option>
                  <?php foreach($cost_centers as $key => $value){ ?>
                    <option value="<?php echo $value['cost_center_code'] ?>" 
                      <?php if($cc_industry_mas->cost_center == $value['cost_center_code']){echo 'selected';} ?>>
                         <?php echo $value['cost_center_code'].' - '.$value['cost_center'] ?></option>
                    <?php } ?>
                 </select>
                 <?php if($cc_disabled == true) { ?>
                   <input type="hidden" name="cost_center[]" value="<?php echo $cc_industry_mas->cost_center ?>">
                 <?php } ?>
                 <div class="ajx_failure_msg"></div>
            </td>
            
         </tr>
       <tr>
         <th colspan="4">Industry Types</th>
       </tr> 
       <tr>
         <td >Service Practice Parent<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="service_practice_parent[]" class="textfield width200px errormsg chzn-select-width service_practice_parent" id="service_practice_parent_<?= $unique ?>" data-rand_str = "<?= $unique ?>">
               <option value="">Please Select</option>
               <?php $service_practice_parent = array();
               $service_practice_parent = $this->project_approval_model->getServicePractParentByCC($cc_industry_mas->cost_center,$entity);
               foreach($service_practice_parent as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->service_practice_parent == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg"></div>
         </td>
         <td >Service Practice Child <span class="mandatory_asterick">*</span></td>
         <td >
            <select name="service_practice_child[]" class="textfield width200px errormsg chzn-select-width service_practice_child" id="service_practice_child_<?= $unique ?>">>
               <option value="">Please Select</option>
               <?php $service_practice_child = array();
               $service_practice_child = $this->project_approval_model->getServicePractChildByCC($cc_industry_mas->cost_center,$entity,$cc_industry_mas->service_practice_parent);
               foreach($service_practice_child as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->service_practice_child == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg"></div>
         </td>
       </tr>
       <tr>
         <td >Customer Industry Practice Parent <span class="mandatory_asterick">*</span></td>
         <td >
            <select name="customer_industry_practice_parent[]" class="textfield width200px errormsg chzn-select-width customer_industry_practice_parent">
               <option value="">Please Select</option>
               <?php foreach($customer_industry_practice_parent as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->customer_industry_practice_parent == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg"></div>
         </td>
         <td >Industry Practice Child<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="industry_practice_child[]" class="textfield width200px errormsg chzn-select-width industry_practice_child">
               <option value="">Please Select</option>
               <?php foreach($industry_practice_child as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->industry_practice_child == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg"></div>
         </td>
       </tr>
       <tr>
         <td >Growth Engines<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="growth_engines[]" class="textfield width200px errormsg chzn-select-width growth_engines" id="growth_engines_<?= $unique ?>" data-rand_str = "<?= $unique ?>">
               <option value="">Please Select</option>
               <?php $growth_engines = array();
               $growth_engines = $this->project_approval_model->getGrowthEnginesByCC($cc_industry_mas->cost_center,$entity);
               foreach($growth_engines as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->growth_engines == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg"></div>
         </td>
         <td >Operating Model<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="operating_model[]" class="textfield width200px errormsg chzn-select-width operating_model">
               <option value="">Please Select</option>
               <?php foreach($operating_model as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->operating_model == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg" ></div>
         </td>
       </tr>
       <tr>
         <td >Revenue Model<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="revenue_model[]" class="textfield width200px errormsg chzn-select-width revenue_model">
               <option value="">Please Select</option>
               <?php foreach($revenue_model as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->revenue_model == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg" ></div>
         </td>
         <td >Existing or New Customer<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="existing_or_new_customer[]"  class="textfield width200px errormsg chzn-select-width existing_or_new_customer">
               <option value="">Please Select</option>
               <?php foreach($existing_or_new_customer as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->existing_or_new_customer == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg" ></div>
         </td>
       </tr>
       <tr>
         <td >Existing or New Line of Business	<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="existing_or_new_line_of_business[]" class="textfield width200px errormsg chzn-select-width existing_or_new_line_of_business">
               <option value="">Please Select</option>
               <?php foreach($existing_or_new_line_of_business as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->existing_or_new_line_of_business == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg"></div>
         </td>
         <td >Existing or New Projects<span class="mandatory_asterick">*</span></td>
         <td >
            <select name="existing_or_new_projects[]" class="textfield width200px errormsg chzn-select-width existing_or_new_projects">
               <option value="">Please Select</option>
               <?php foreach($existing_or_new_projects as $key => $value){ ?>
                 <option value="<?php echo $value['sap_code'] ?>" 
                   <?php if($cc_industry_mas->existing_or_new_projects == $value['sap_code']){echo 'selected';} ?>>
                      <?php echo $value['sap_code'].' - '.$value['industry_value'] ?></option>
                 <?php } ?>
            </select>
              <div class="ajx_failure_msg"></div>
         </td>
       </tr>
        
  </table>
</div>
<?php if($cont == 1) {?>
<script type="text/javascript">
var config = {
  '.chzn-select'           : {},
  '.chzn-select-deselect'  : {allow_single_deselect:true},
  '.chzn-select-no-single' : {disable_search_threshold:10},
  '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chzn-select-width'     : {width:"350px"}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
$('.remove_cc').click(function(){
  arr = $(this).attr("val");
  if($('.cc_grid').length > 1){
    $('.cc_div_'+arr).remove();
  }
});
industry_type_arr = ["cost_center",
        "customer_industry_practice_parent",
        "existing_or_new_customer",
        "existing_or_new_line_of_business",
        "existing_or_new_projects",
        "growth_engines",
        "industry_practice_child",
        "operating_model",
        "revenue_model",
        "service_practice_child",
        "service_practice_parent",
      ];
// to remove the required field alert if filled
$.each(industry_type_arr , function(index, val) { 
      $("."+val).each(function() {
        $("."+val).chosen().change(function(e, params){
          if($(this).val() == ''){
            $(this).nextAll(".ajx_failure_msg").html(msg);
          }else{
            $(this).nextAll(".ajx_failure_msg").html('');
          }
        });
      });
});
</script>
<script type="text/javascript" src="assets/js/projects/project_industry_mapping.js"></script>
<?php } ?>
