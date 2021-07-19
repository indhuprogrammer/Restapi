<?php require (theme_url().'/tpl/header.php'); ?>
<script type="text/javascript" src="assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="assets/js/jq.livequery.min.js"></script>
<script type="text/javascript" src="assets/js/crm.js?q=13"></script>
<script type="text/javascript" src="assets/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="assets/js/chosen.jquery.js"></script>
<link rel="stylesheet" href="assets/css/chosen.css" type="text/css" />
<style>
 .ui-accordion-header-active {
    border: 1px solid #d3d3d3;
    background: #4b6fb9 url(images/ui-bg_glass_75_e6e6e6_1x400.png) 50% 50% repeat-x;
    font-weight: normal;
    color: #ffffff;
}
   .buttons button.positive {
    font-size: 11px;
}
select.width200px {
    width: 210px;
	float:none;
}
</style>
<style>

.width_65{
	width:65px!important;
}
.width_20{
	width: 100px!important;
}
#content label {
    font-size: 11px!important;   
	    width: 135px;
    padding-right: 0px;
}
.text_css { 
    width: 95%;
    padding: 2px!important;
	font-size: 14px!important;
}

.icon{
	cursor: pointer;
}
.text_area_css{
	width: 93%;
}
input {
    margin-bottom: 5px!important;
}
.width_100_p{
 width: 100%!important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {  
    border: 2px solid #ddd!important;
	padding: 6px!important
}
.mb{
	    margin-bottom: 0px!important;
}
input.textfield {
    width: 100%;
}
.qty_td input{
	width: 82%;
}
@media (min-width: 768px){
.col-sm-5 {
    width: 42.666667%!important;
}
}
.col-sm-20 {
    width: 14%;
}
table#customFields {
    margin-bottom: 15px;
}
@media (min-width: 768px){
.col-sm-79 {
    width: 68%;
}
}
a.del_file {
    margin-left: 6px;
    margin-top: 2px;
}
div#show_files {
    margin-top: 5px;
}
.payment-profile-view{
	padding-bottom:0px!important;
}
label.col-sm-1.pull-left {
    color: #4b6fb9;
}
.table th {
    /*color: #4b6fb9;
	background-color: #708090;*/
	background-color: #e0e2f7;
    font-weight: normal;

}

#table_cus th{
	text-align: left;
    vertical-align: middle;
}
.table {
  border-collapse: collapse;
  margin-bottom: 5%;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
#refer_back_1 {
    padding: 0px;
    height: 100px;
    vertical-align: middle;
    clear: both;
    margin: 0px;
    width: 100%;
}
.cost_table {
  border: 1px solid #e2cdcd;
  padding: 2.5px;
  width: 99%;
}
.cost_table th{
  background-color: #e0e2f7;
  padding: 6px;
  font-size: 13px;
}
.cost_table td {
    padding-top: 16px;
}
/* .chzn-drop {
   bottom: 29px;
   top: auto !important;
} */
tr.header
{
  cursor:pointer;
}
.chzn-container{
  font-size: 11px !important;
}
</style>

<?php
   $usernme = $this->session->userdata('logged_in_user');
   ?>
<div id="content">
   <div class="inner">
     <form  id="frm">
       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf" value="<?php echo $this->security->get_csrf_hash(); ?>" />  
       <input type="hidden" name="status" id="submit_status">
       <input type="hidden" name="approval_status" value="<?php echo $approval_status; ?>" />
       <input type="hidden" name="lead_id" value="<?php echo trim($leads->lead_id); ?>" >
       <input type="hidden" name="lead_title" value="<?php echo trim($leads->lead_title); ?>" >
       <input type="hidden" name="pjtlist" value="<?php echo $_REQUEST['pjtlist']; ?>" >
       
       <h2>Project Details</h2>
       <div class="row">
       <div class="col-md-12 pull-left" style="margin-bottom: -32px;">
       <table class="table" id="table_cus" style="width: 100%;">
         <tbody>
           <tr class="header_project">
             <th style="width: 115px;">Project Title</th> 
              <td style="width: 135px;"> <?php echo $leads->lead_title ?></td> 
              <th style="width: 100px;">Entity</th> 
              <td style="width: 115px;"> <?php echo $leads->division_name ?></td>
              <th style="width: 120px;">Departments</th> 
              <td style="width: 152px;"> <?php echo $leads->department_name ?></td> 
              <th style="width: 100px;">Project Manager</th> 
              <td style="width: 148px;"> <?php echo $leads->pm_fname.' '.$leads->pm_lname.' - '.$leads->pm_emp_id ?></td>
              <td style="width: 20px;"><span> <img src="assets/img/expand.gif" alt=""></span></td>
            </tr>
           <tr>
              <th style="width: 110px;">Resource Type </th> 
              <td> <?php echo ($leads->resource_type ? @$this->project_approval_model->get_billing_type($leads->resource_type)->category: '-'); ?></td> 
              <th style="width: 100px;">Project Type</th> 
              <td> <?php echo $leads->project_types ?></td>
              <th style="width: 110px;">Service Requirement </th> 
              <td> <?php echo $leads->services ?></td> 
              <th style="width: 115px;">Project Billing Type</th> 
              <td> <?php echo $leads->project_billing_type ?></td> 
            </tr>
           <tr>
              <th style="width: 110px;">Practice</th> 
              <td> <?php echo $leads->practices ?></td> 
              <th style="width: 100px;">SOW Status</th> 
              <td> <?php echo ($leads->sow_status == '1'?'Signed':'Un signed') ?></td>
              <th style="width: 115px;">Billing Frequency</th> 
              <td> <?php echo ($leads->billing_type == '1'?'Milestone Driven':'Monthly') ?></td>
              <th style="width: 110px;">Payment Terms</th> 
              <td> <?php echo $leads->payment_terms_list ?></td> 
            </tr>
           <tr>
              <th style="width: 100px;">Contract P.O</th> 
              <td> <?php echo $leads->contarct_po ?></td>
              <th style="width: 115px;">SOW End Date</th> 
              <td> <?php echo date('d-m-Y',strtotime($leads->date_due)) ?></td> 
              <th style="width: 110px;">Customer Type</th> 
              <td> <?php echo $this->cfg['customer_type'][$leads->customer_type]  ?></td> 
              <th style="width: 115px;">Project Currency</th> 
              <td> <?php echo $this->project_approval_model->getcurrency($leads->division, $leads->expect_worth_id); ?></td> 
            </tr>
           <tr>
              
            </tr>
           <tr>
              <th style="width: 110px;">Project Geography</th> 
              <td> <?php echo $leads->georegion_name ?></td> 
              <th style="width: 110px;">Customer Name</th> 
              <td> <?php echo $leads->company ?></td> 
              <th style="width: 115px;">Project Actual Start Date</th> 
              <td> <?php echo date('d-m-Y',strtotime($leads->actual_date_start)) ?></td> 
              <th style="width: 110px;">Project Actual Due Date</th> 
              <td> <?php echo date('d-m-Y',strtotime($leads->actual_date_due)) ?></td> 
            </tr>
           
        </tbody>
       </table>
       
      </div>								
      </div>
      
      <div class="row">
      <div class="col-md-12">
        <div class="new_cc">
          <button type="button" name="button" class="positive add_cc">Add New</button>
        </div>
       <?php 
       if (count($cc_industry_mas_set) > 0) {
         foreach ($cc_industry_mas_set as $key => $cc_industry_mas) { 
           $data['cc_industry_mas'] = $cc_industry_mas;
           $this->view('projects/project_approval_cost_Center',$data);
           echo '<br>';
          } 
        }else{
          $this->view('projects/project_approval_cost_Center','');
        }
        ?>
      </div>
      
      </div>
      <br> <br>
      <div class="row">
      
        <div class="col-md-12">
        <table class="cost_table" >
          <tr>
            <th colspan="4">Actual Invoice</th>
          </tr>
          <tr>
                <td >Gl Account: <span class="mandatory_asterick">*</span></td>
                <td style="">
                   <select name="actual_gl_account[]" id="actual_gl_account" class="textfield errormsg chzn-select-width" multiple>
                      <?php foreach($GLAccount as $key => $value){ ?>
                         <option value="<?php echo $value['expense_category_code'] ?>" >
                             <?php echo $value['expense_category_code'].' - '.$value['expense_category_name'] ?>
                           </option>
                         <?php } ?>
                        </select>
                     <div class="ajx_failure_msg" id="actual_gl_account_error"></div>
                </td>
                <td >Default Gl Account: <span class="mandatory_asterick">*</span></td>
                <td >
                   <select name="actual_gl_account_default" id="actual_gl_account_default" class="textfield width200px errormsg chzn-select-width">
                      <option value="">Please Select</option>
                   </select>
                     <div class="ajx_failure_msg" id="actual_gl_account_default_error"></div>
                </td>
                
             </tr>
             <?php if($entity == 1) {?>
             <tr>
                 <td >HSN / SAC: <span class="mandatory_asterick">*</span></td>
                 <td >
                    <select name="actual_sac[]" id="actual_sac" class="textfield width200px errormsg chzn-select-width" multiple>
                       <?php foreach($SACCode as $key => $value){ ?>
                       <option value="<?php echo $value['sac_code_absentry'] ?>" >
                            <?php echo $value['sac_code_service_code'] .' - '. $value['sac_code_service_name'] ?>
                        </option>
                       <?php } ?>
                     </select>
                      <div class="ajx_failure_msg" id="actual_sac_error"></div>
                 </td>
                 <td >Default HSN / SAC: <span class="mandatory_asterick">*</span></td>
                 <td >
                    <select name="actual_sac_default" id="actual_sac_default" class="textfield width200px errormsg chzn-select-width">
                       <option value="">Please Select</option>
                    </select>
                      <div class="ajx_failure_msg" id="actual_sac_default_error"></div>
                 </td>
                 
              </tr>
            <?php } ?>
                <tr>
                  <td >Location: <span class="mandatory_asterick">*</span></td>
                  <td >
                     <select name="actual_location[]" id="actual_location" class="textfield width200px errormsg chzn-select-width" multiple>
                        <?php foreach($location as $key => $value){ ?>
                          <option value="<?php echo $key ?>">
                               <?php echo $value ?></option>
                          <?php } ?>
                            </select>
                       <div class="ajx_failure_msg" id="actual_location_error"></div>
                  </td>
                  <td >Default Location: <span class="mandatory_asterick">*</span></td>
                  <td >
                     <select name="actual_location_default" id="actual_location_default" class="textfield width200px errormsg chzn-select-width">
                        <option value="">Please Select</option>
                     </select>
                       <div class="ajx_failure_msg" id="actual_location_default_error"></div>
                  </td>
               </tr>
        
          <tr>
            <th colspan="4">Provisional Invoice</th>
          </tr>
          <tr>
              <td >Gl Account: <span class="mandatory_asterick">*</span></td>
              <td style="">
                 <select name="provisional_gl_account[]" id="provisional_gl_account" class="textfield errormsg chzn-select-width" multiple>
                    <?php foreach($GLAccount as $key => $value){ ?>
                       <option value="<?php echo $value['expense_category_code'] ?>">
                           <?php echo $value['expense_category_code'].' - '.$value['expense_category_name'] ?>
                         </option>
                       <?php } ?>
                      </select>
                   <div class="ajx_failure_msg" id="provisional_gl_account_error"></div>
              </td>
              <td >Default Gl Account: <span class="mandatory_asterick">*</span></td>
              <td >
                 <select name="provisional_gl_account_default" id="provisional_gl_account_default" class="textfield width200px errormsg chzn-select-width">
                    <option value="">Please Select</option>
                 </select>
                   <div class="ajx_failure_msg" id="provisional_gl_account_default_error"></div>
              </td>
                
             </tr>
             <?php if($entity == 1) {?>
             <tr>
                 <td >HSN / SAC: <span class="mandatory_asterick">*</span></td>
                 <td >
                    <select name="provisional_sac[]" id="provisional_sac" class="textfield width200px errormsg chzn-select-width" multiple>
                       <?php foreach($SACCode as $key => $value){ ?>
                         <option value="<?php echo $value['sac_code_absentry'] ?>" >
                              <?php echo $value['sac_code_service_code'] .' - '. $value['sac_code_service_name'] ?>
                          </option>
                       <?php } ?>
                     </select>
                      <div class="ajx_failure_msg" id="provisional_sac_error"></div>
                 </td>
                 <td >Default HSN / SAC: <span class="mandatory_asterick">*</span></td>
                 <td >
                    <select name="provisional_sac_default" id="provisional_sac_default" class="textfield width200px errormsg chzn-select-width">
                       <option value="">Please Select</option>
                    </select>
                      <div class="ajx_failure_msg" id="provisional_sac_default_error"></div>
                 </td>
                 
              </tr>
            <?php } ?>
              <tr>
                <td >Location: <span class="mandatory_asterick">*</span></td>
                <td >
                   <select name="provisional_location[]" id="provisional_location" class="textfield width200px errormsg chzn-select-width" multiple>
                      <?php foreach($location as $key => $value){ ?>
                        <option value="<?php echo $key ?>">
                             <?php echo $value ?></option>
                        <?php } ?>
                          </select>
                     <div class="ajx_failure_msg" id="provisional_location_error"></div>
                </td>
                <td >Default Location: <span class="mandatory_asterick">*</span></td>
                <td >
                   <select name="provisional_location_default" id="provisional_location_default" class="textfield width200px errormsg chzn-select-width">
                      <option value="">Please Select</option>
                   </select>
                     <div class="ajx_failure_msg" id="provisional_location_default_error"></div>
                </td>
             </tr>
             <tr>
               <th colspan="4"></th>
             </tr>
             <?php if($entity == 1) {?>
              <tr>
                <td >TDS: <span class="mandatory_asterick">*</span></td>
                <td >
                   <select name="tds" id="tds" class="textfield width200px errormsg chzn-select-width tds">
                      <option value="">Please Select</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                     <div class="ajx_failure_msg" id="tds_error"></div>
                </td>
                <td >Warehouse Location: <span class="mandatory_asterick">*</span></td>
                <td >
                  <select name="item_location" id="item_location" class="textfield width200px errormsg chzn-select-width item_location">
                    <option value="">Please Select</option>
                    <?php	foreach($this->cfg['invoice_location'] as $status_key=>$status_val) {?>
												<option  value="<?php echo $status_key; ?>" <?php if($status_key == $gl_account->location){ echo 'selected="selected"';}?>><?php echo $status_val; ?></option>
										<?php } ?>
                  </select>
                  <div class="ajx_failure_msg" id="item_location_error"></div>
                </td>
              </tr>
              <?php } ?>
              <tr>
                <td >Tax Code: <span class="mandatory_asterick">*</span></td>
                <td >
                   <select name="tax_code" id="tax_code" class="textfield width200px errormsg chzn-select-width tax_code">
                     <option value="">Please Select</option>
                     <?php foreach($TAXCode as $key => $value){ ?>
                       <option value="<?php echo $value['tax_code'] ?>">
                            <?php echo $value['tax_name'] ?></option>
                       <?php } ?>
                    </select>
                     <div class="ajx_failure_msg" id="tax_code_error"></div>
                </td>
              </tr>
             
        </table>
        </div>
      </div>
     
	  
        <br>
          <table style="width:80%">
            <?php if($leads->approver1_comments){  ?>
           <tr>
              <td style="width:16%">		
                 <strong>Approver 1 Comments: </strong
              </td>
              <td style="padding-bottom: 10px;">
                 <p><?php echo $leads->approver1_comments ?></p>
              </td>
           </tr>
         <?php } ?>
            <?php if($leads->approver2_comments){  ?>
           <tr>
              <td style="width:16%">		
                 <strong>Approver 2 Comments: </strong
              </td>
              <td style="padding-bottom: 10px;">
                 <p><?php echo $leads->approver2_comments ?></p>
              </td>
           </tr>
         <?php } ?>
         <tr>
            <td style="width:16%">		
               <strong>Remarks: </strong
            </td>
            <td style="padding-bottom: 10px;">
               <textarea id="refer_back_1" name="remark" class="remarks" rows="10"></textarea>
               <div class="ajx_failure_msg" id="remarks_error"></div>
            </td>
         </tr>
         <?php if($access == true){ ?>
         <tr>
            <td style="border:none;" colspan="2">
               <div id="subBtn" class="buttons" style="padding-right: 30px;margin-left: -5px;">
                  <!-- <button style="margin-right:10px" type="button" class="positive" onclick="SubmitButton('<?= $approver_num ?>','Rejected')" >Refer back</button> -->
                  <button style="margin-right:10px" type="button" class="positive" onclick="SubmitButton('<?= $approver_num ?>','Approved')" >Update / Approve Project</button>
                  <?php if($_REQUEST['pjtlist'] == 1){ ?>
                  <button type="button" class="positive" onclick='location.href = "projects/dashboard/list";' >Back</button>
                <?php }else{ ?>
                  <button type="button" class="positive" onclick='location.href = "project_approval";' >Back</button>
                <?php } ?>
               </div>
         </tr>
       <?php } ?>
        </table>
  </div>
  </form>  
</div>
<?php require (theme_url().'/tpl/footer.php'); ?>
<script type="text/javascript">
  var entity = "<?php echo $entity ?>";
  var pm_fields = <?php echo json_encode($pm_fields); ?>;
  var disabled = "<?php echo $disabled ?>";
  $('select').prop('disabled', disabled);
  var lead_id = "<?php echo $leads->lead_id ?>";
  var Code = "<?php echo "PRJ".$leads->lead_id ?>"; 
  var Name = "<?php echo $leads->lead_title ?>";
  var ValidFrom = "<?php echo date('Y-m-d',strtotime($leads->actual_date_start)) ?>";
  var ValidTo = "<?php echo date('Y-m-d',strtotime($leads->actual_date_due)) ?>";
  var U_ProjGeo = "<?php echo $leads->georegion_name?>";
  
</script>
<script type="text/javascript" src="assets/js/projects/project_approval_view.js"></script>
<script type="text/javascript" src="assets/js/projects/project_industry_mapping.js"></script>
  
