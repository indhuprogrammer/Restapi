<?php require (theme_url().'/tpl/header.php'); ?>
<style>
    .module_div > table {
        display: inline-block;
        vertical-align: top;
        margin-top: 20px;
    }
    .qualityMetricsTable td {
        vertical-align: top;
    }
   
	#project-tabs #jv-tab-8-5{
		min-height: 200px !important;
   }

    #compliance_form {
        overflow: visible;
    }

    span.radlabspa {
   	display: inline-block;
   	margin-top: 1px;
   	vertical-align: top;
   	margin-left: 5px;
   	padding-right: 13px;
   }
   div label {
    vertical-align: 4px;
   }
   .pull-left.team-mem {
    margin-top: -1%;
    }
</style>
<script type="text/javascript" src="assets/js/jquery.form.js"></script>
<link rel="stylesheet" href="assets/css/chosen.css" type="text/css" />
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<style>
button.export-to-excel-btn {
    border: none;
    outline: 0px;
    line-height: 16px;
}
button.export-to-excel-btn:hover {
    background-color: white;
    color: #336699;
}
ul.menuStyle {    
    margin-bottom: 0px!important;
}
h2.job-title {
    font-weight: bold!important;
}
.date-time{
	font-size: 11px;
}
div#lead_log_list_filter label {
    width: auto;
}
.search-field input {
    -webkit-box-sizing: initial!important;
    -moz-box-sizing: initial!important;
    box-sizing: initial!important;
}
ul.menuStyle li a {

    padding: 6px 10px 6px 10px!important;
}
#load-log .dataTables_filter {
    width: 40%;
    text-align: right;
    margin: 0 0px 4px 0;
    float: right;
}
#load-log .dataTables_filter label {
    font-size: 12px;
    font-weight: bold;
    line-height: 25px;
    width: 225px;
}
#invoice_table td a {
    padding: 2px !important;
}
/* .test-block label {
     width: auto;
} */
</style>
<?php 
	$this->load->helper('custom');
	if (get_default_currency()) {
		$default_currency 	= get_default_currency();
		$default_cur_id 	= $default_currency['expect_worth_id'];
		$default_cur_name 	= $default_currency['expect_worth_name'];
	} else {
		$default_cur_id 	= '1';
		$default_cur_name 	= 'USD';
	}
	
	$this->load->helper('lead');
	$file_upload_access = get_file_access($quote_data['lead_id'], $this->userdata['userid']);
	$file_upload_access = 1;
?>
<?php $ff_id = isset($parent_ffolder_id) ? $parent_ffolder_id : ''; ?>

<div id="content">
    <?php
		$date_used = $quote_data['date_created'];
	?>
    <div class="inner q-view">
		
		<?php
			$restrict1[] = 0;
			if (is_array($contract_users) && count($contract_users) > 0) { 
				foreach ($contract_users as $data) {
					$restrict1[] = $data['userid_fk'];
				}
			}
			$restrict2[] = 0;
			if (is_array($stake_holders) && count($stake_holders) > 0) { 
				foreach ($stake_holders as $data1) {
					$restrict2[] = $data1['user_id'];
				}
			}					
			
			//echo "<pre>"; print_r($restrict1);
			
			$r_users = implode(",",$list_users);
			$restrict = explode(",",$r_users);
			//print_r($restrict);
			
			//Merge the contract users, lead owner, lead sssigned_to & project Manager.
			$rest_users = array_merge_recursive($restrict, $restrict1);
			
			if(count($stake_holders)>0){
				$rest_users = array_merge_recursive($rest_users, $restrict2);	
			}
			
			$restrict_users = array_unique($rest_users);
		 
			//Re-Assign the Keys in the array.
			$final_restrict_user = array_values($restrict_users);
			
		?>
		
		
		<?php
			if (count($final_restrict_user)>0) {
			
				$user_details_id = array();
				if(!empty($user_accounts)){
					foreach($user_accounts as $user=>$userdet){
						$user_details_id[$userdet['userid']] = $userdet;
					}
				}
				$final_restrict_user = array_remove_by_value($final_restrict_user, 0);
			}
			
			
			function array_remove_by_value($array, $value) {
				return array_values(array_diff($array, array($value)));
			}
			
		?>
		
		
        <div class="pull-left side1 test-block full-div"> 
			<h2 class="job-title"> <?php echo htmlentities($quote_data['lead_title'], ENT_QUOTES); ?> </h2>
			<?php
				if (isset($quote_data['pjt_id'])) {
					$varPjtId = $quote_data['pjt_id'];
				}
				
				$readonly_status = false;
				if($chge_access != 1)
				$readonly_status = true;
				if($quote_data['pjt_status'] == 2)
				$readonly_status = true;
			?>
			
			
		
			<div class="sec-left">
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Project Title</label>
					<input style="width:180px;" type="text" name="lead_title" id="lead_title" class="textfield" size="40" value="<?php echo isset($quote_data['lead_title']) ? $quote_data['lead_title'] : ''; ?>" <?php if ($readonly_status == true) { ?> disabled <?php } ?> />
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="updateTitle(); return false;">Set</button>
					</div>
					<div id="resmsg_projecttitle" class='succ_err_msg' style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="lead_service">Service Requirement</label>
					<select name="lead_service" id="lead_service" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="">Select Service</option>
						<?php if(!empty($lead_services)) {
							foreach($lead_services as $serv_row) {
								$selectedPractice = ($serv_row['sid'] == $quote_data['lead_service']) ? 'selected="selected"' : '';
						?>
								<option value="<?php echo $serv_row['sid']; ?>" <?php echo $selectedPractice; ?>><?php echo $serv_row['services']; ?></option>
						<?php
							}
						}
						?>
					</select>
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setServiceRequirement(); return false;">Set</button>
					</div>
					<div id="resmsg_serv_req" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
			
			<?php if($quote_data['project_category'] == 1) { ?>			
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Profit Center</label>
					<select name="project_center" id="project_center" class="textfield" disabled>
						<option value="">Select Profit Center</option>
						<?php if(!empty($arr_profit_center)) {
							foreach($arr_profit_center as $list_profit_center) {
								$selected_profit_center = '';
								if($list_profit_center['id'] == $quote_data['project_center']) {
									$selected_profit_center = 'selected="selected"';
								}
						?>
								<option value="<?php echo $list_profit_center['id']; ?>" <?php echo $selected_profit_center; ?>><?php echo $list_profit_center['profit_center']; ?></option>
						<?php
							}
						} 
						?>
					</select>
				</div>				
			</form>			
			<?php }?>
			
			<?php if($quote_data['project_category'] == 2) { ?>		
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Cost Center</label>
					<select name="cost_center" id="cost_center" class="textfield" style="width: 190px;" disabled>
						<option value="">Select Cost Center</option>
						<?php if(!empty($arr_cost_center)) {
							foreach($arr_cost_center as $list_cost_center) {
								$selected_cost_center = '';
								if($list_cost_center['id'] == $quote_data['cost_center']) {
									$selected_cost_center = 'selected="selected"';
								}
						?>
								<option value="<?php echo $list_cost_center['id']; ?>" <?php echo $selected_cost_center; ?>><?php echo $list_cost_center['cost_center']; ?></option>
						<?php
							}
						} 
						?>
					</select>
				</div>
			</form>
			<?php }?>
			
      <form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Business Unit</label>
					<select name="business_unit_id" id="business_unit_id" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="">Select Business Unit</option>
						<?php if(!empty($business_unit)) {
							foreach($business_unit as $bu) {
								$selectedBu = '';
								if($bu['id'] == $quote_data['business_unit_id']) {
									$selectedBu = 'selected="selected"';
								}
						?>
								<option value="<?php echo $bu['id']; ?>" <?php echo $selectedBu; ?>><?php echo $bu['business_unit']; ?></option>
						<?php
							}
						} 
						?>
					</select>
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setBusinessUnit(); return false;">Set</button>
					</div>
					<div id="resmsg_BusinessUnit" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
      
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Departments</label>
					<select name="department_id_fk" id="department_id_fk" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="">Select Departments</option>
					</select>
          <input type="hidden" id="department_id_fk_hide" value="<?php echo $quote_data['department_id_fk'] ?>">
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setDepartments(); return false;">Set</button>
					</div>
					<div id="resmsg_departments" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
      <form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Practice</label>
					<select name="practice" id="practice" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="">Select Practice</option>
					</select>
          <input type="hidden" id="practice_hide" value="<?php echo $quote_data['practice'] ?>">
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setPractices(); return false;">Set</button>
					</div>
					<div id="resmsg_practice" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Resource Type</label>
					<select name="resource_type" id="resource_type" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="">Select Resource Type</option>
						<?php if(!empty($billing_categories)) {
							foreach($billing_categories as $list_resource_type) {
								$selected_resource_type = '';
								if($list_resource_type['bill_id'] == $quote_data['resource_type']) {
									$selected_resource_type = 'selected="selected"';
								}
						?>
								<option value="<?php echo $list_resource_type['bill_id']; ?>" <?php echo $selected_resource_type; ?>><?php echo $list_resource_type['category']; ?></option>
						<?php
							}
						} 
						?>
					</select>
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setResourceType(); return false;">Set</button>
					</div>
					<div id="resmsg_resource_type" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Project Type</label>
					<select name="project_types" id="project_types" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="">Select Project Types</option>
						<?php if(!empty($project_types)) {
							foreach($project_types as $types) {
								$selected_project_types = '';
								if($types['id'] == $quote_data['project_types']) {
									$selected_project_types = 'selected="selected"';
								}
						?>
								<option value="<?php echo $types['id']; ?>" <?php echo $selected_project_types; ?>><?php echo $types['project_types']; ?></option>
						<?php
							}
						} 
						?>
					</select>
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setEconProjectTypes(); return false;">Set</button>
					</div>
					<div id="resmsg_econ_project_types" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="practices">Project Billing Type</label>
					<select name="project_type" id="project_type" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="">Select Project Types</option>
						<?php if(!empty($timesheet_project_types)) {
							foreach($timesheet_project_types as $list_project_types) {
								$selected_project_types = '';
								if($list_project_types['project_type_id'] == $quote_data['project_type']) {
									$selected_project_types = 'selected="selected"';
								}
						?>
								<option value="<?php echo $list_project_types['project_type_id']; ?>" <?php echo $selected_project_types; ?>><?php echo $list_project_types['project_type_name']; ?></option>
						<?php
							}
						} 
						?>
					</select>
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setProjectTypes(); return false;">Set</button>
					</div>
					<div id="resmsg_project_types" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
				</div>
			</form>
			<div style="clear:both"></div>	
			<label class="pull-left">SOW Status</label>
			<div style="line-height: 21px;font-size:11px;">
				<input type="radio" name="sow_status" class="sow_stat" value="1" id="sow_status_signed" <?php if ($readonly_status == true) { ?> disabled <?php } ?> <?php if($quote_data['sow_status'] == 1) { echo 'checked="checked"'; } ?> ><span class="radlabspa"> Signed</span>
				<input type="radio" name="sow_status" value="0" class="sow_stat" id="sow_status_unsigned" <?php if ($readonly_status == true) { ?> disabled <?php } ?> <?php if($quote_data['sow_status'] == 0) { echo 'checked="checked"'; } ?> ><span class="radlabspa"> Un signed </span>
				<span id="errmsg_sow_status" style="color:red"></span>
			</div>
			<div class="clear"></div>
			
			<label class="pull-left">Billing Frequency</label>
			<div style="line-height: 21px;font-size:11px;">
				<input type="radio" name="billing_type" class="bill_type" value="1" id="milestone_driven" <?php if ($readonly_status == true) { ?> disabled <?php } ?> <?php if($quote_data['billing_type'] == 1) { echo 'checked="checked"'; } ?> ><span class="radlabspa"> Milestone Driven </span>
				<input type="radio" name="billing_type" value="2" class="bill_type" id="monthly_driven" <?php if ($readonly_status == true) { ?> disabled <?php } ?> <?php if($quote_data['billing_type'] == 2) { echo 'checked="checked"'; } ?> > <span class="radlabspa">Monthly </span> 
				<span id="errmsg_bill_type" style="color:red"></span>
			</div>
			<div class="clear"></div>
			
			<div class="pull-left">
				<label class="project-id">Payment Terms</label>
				<!-- <input class="textfield" type="text" name="payment_terms_list" id="payment_terms_list" maxlength="20" value="<?php echo $quote_data['payment_terms_list']; ?>"  style="width: 125px;" /> -->
				<?php $quote_data['payment_terms_list']= (!empty($quote_data['payment_terms_list']) || $quote_data['payment_terms_list'] != 0)?$quote_data['payment_terms_list']:30;?>
				<select name="payment_terms_list" id="payment_terms_list" class="textfield" style="width: 190px;">
							    <option value="">Select Payment terms</option>
								<option <?php if ($quote_data['payment_terms_list'] == 'Immediate' ) echo 'selected' ; ?> value="Immediate">Immediate</option>
								<option <?php if ($quote_data['payment_terms_list'] == 'Prior to Commencement of Project' ) echo 'selected' ; ?> value="Prior to Commencement of Project">Prior to Commencement of Project</option>
								<option <?php if ($quote_data['payment_terms_list'] == 'Prior to deployment of project' ) echo 'selected' ; ?> value="Prior to deployment of project">Prior to deployment of project</option>
								<?php     
									for($i=1; $i<=60; $i++){ ?> 
										<option <?php if ($quote_data['payment_terms_list'] == $i) echo 'selected' ;  ?> value="<?php echo $i;?>"><?php echo $i;?></option>
    									<?php
									}
								?>
				</select>
			</div>
			<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setPayment_term(); return false;">Set</button>
					</div>
					<div id="resmsg_payment_term" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
			</div>
			<div class="pull-left">
				<label class="project-id">Contract P.O</label>
				<input class="textfield" type="text" name="contarct_po" id="contarct_po" maxlength="50" value="<?php echo $quote_data['contarct_po']; ?>"  style="width: 125px;" />
			</div>
			<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setContrac(); return false;">Set</button>
					</div>
					<div id="resmsg_setContractPO" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
					<span id="resmsg_err_cont" style="font-size:smaller;display: inline-block;"></span>
				<?php } ?>
			</div>
			<div class="clear"></div>
			<label class="pull-left">Customer Type</label>
			<div style="line-height: 21px;font-size:11px;">
				<!-- <input type="radio" name="customer_type" class="customer_type" value="0" id="internal_customer" <?php if ($readonly_status == true) { ?> disabled <?php } ?> <?php if(isset($quote_data['customer_type']) && $quote_data['customer_type'] == 0) { echo 'checked="checked"'; } ?> > Internal
				<input type="radio" name="customer_type" value="1" class="customer_type" id="external_customer" <?php if ($readonly_status == true) { ?> disabled <?php } ?> <?php if(isset($quote_data['customer_type']) && $quote_data['customer_type'] == 1) { echo 'checked="checked"'; } ?> > External
				<input type="radio" name="customer_type" value="2" class="customer_type" id="bpo_customer" <?php if ($readonly_status == true) { ?> disabled <?php } ?> <?php if(isset($quote_data['customer_type']) && $quote_data['customer_type'] == 2) { echo 'checked="checked"'; } ?> > BPO -->
				<?php 
                    foreach($this->cfg['customer_type'] as $status_key=>$status_val) {?>
                        
                        <input type="radio" class="customer_type" name="customer_type" id="ext_customer_type" <?php echo (isset($quote_data['customer_type']) && $quote_data['customer_type']==$status_key) ? "checked='checked'" : ""; ?> value="<?php echo $status_key ?>" /><span class="radlabspa"><?php echo  $status_val ?></span>
                    
                        <?php
                    }    
                ?>
				<span id="errmsg_customer_type" style="color:red"></span>
			</div>
			<div class="clear"></div>
			<div class="pull-left">
				<label class="project-id">Entity</label>
				<input class="textfield" type="text" name="pjtId" id="pjtId" maxlength="20" value="<?php echo $quote_data['division_name']; ?>" readonly style="width: 125px;" />
			</div>
			<div class="clear"></div>
			<!-- <div class="pull-left">
				<label class="project-id">Base Currency</label>
				<input class="textfield" type="text" name="pjtId" id="pjtId" maxlength="20" value="<?php echo $base_currency[$quote_data['base_currency']]; ?>" readonly style="width: 125px;" />
				
			</div> -->
			<input class="textfield" type="hidden" name="entity" id="entity" maxlength="20" value="<?php echo $quote_data['entity']; ?>" readonly style="width: 125px;" />
			<div class="clear"></div>
			<div class="pull-left">
				<label class="project-id">Project Currency</label>
				<span id="currency_row_project"> </span>
				<!-- <select name="currency" id="currency" class="textfield" <?php if ($readonly_status == true) { ?> disabled <?php } ?> style="width: 190px;">
					<option value="">Select Currency</option>
					<?php if(!empty($currencies)) {
						foreach($currencies as $curny) {
							$selectedCurny = '';
							if($curny['expect_worth_id'] == $quote_data['expect_worth_id']) {
								$selectedCurny = 'selected="selected"';
							}
					?>
							<option value="<?php echo $curny['expect_worth_id']; ?>" <?php echo $selectedCurny; ?>><?php echo $curny['expect_worth_name']; ?></option>
					<?php
						}
					} 
					?>
				</select> -->
			</div>	

			
			<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setProjectCurny(); return false;">Set</button>
					</div>
					<div id="resmsg_currency" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
			</div>
			
			<div class="pull-left">
				<label class="project-id">Project Geography</label>
			
				<select data-placeholder="Choose Geography..." name="project_geography" id="project_geography" class="textfield " style="width: 190px;">
					<option value="">Please Select</option>
					<?php
					if (!empty($lead_geographys)) {
						foreach ($lead_geographys as $lead_geography) {
							$selectedCurny = '';
							if($lead_geography['georegionid'] == $quote_data['project_geography']) {
								$selectedCurny = 'selected="selected"';
							}
					?>
						<option value="<?php echo $lead_geography['georegionid'] ?>" <?php echo $selectedCurny; ?>><?php echo $lead_geography['georegion_name'];?></option>
					<?php
						}
					}
					?>
				</select>
			</div>
			<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setProjectGeography(); return false;">Set</button>
					</div>
					<div id="resmsg_geography" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
			</div>
			<div class="pull-left">
				<label class="project-id">Project Location</label>
			
				<select name="project_location" id="project_location" class="textfield " style="width: 190px;">
					<option value="">Please Select</option>
					<?php
					foreach($this->cfg['project_location'] as $status_key=>$status_val) {
						?>
							<option <?php echo (isset($quote_data['project_location']) && $quote_data['project_location']==$status_key) ? "selected='selected'" : ""; ?> value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<div class="buttons">
						<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setProjectLocation(); return false;">Set</button>
					</div>
					<div id="resmsg_location" style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
				<?php } ?>
			</div>
			<div class="clear"></div>			<form>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="pull-left">
					<label class="project-id">Project Code</label>
					<input class="textfield" type="text" name="pjtId" id="pjtId" maxlength="20" value="<?php if (isset($varPjtId)) echo $varPjtId; ?>" readonly style="width: 125px;" />
					<input type="hidden" class="hiddenUrl"/>
				</div>
				<div>
				<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
					<!--<div class="buttons">
						<button type="submit" class="positive" id="submitid" style="margin:0 0 0 5px;" onclick="setProjectId(); return false;">Set</button>
					</div>
					<div class="error-msg">
						<span id="pjt_id_errormsg" style="color:red"></span>
						<span class="checkUser" style="color:green">Project Code Saved.</span>
						<span class="checkUser1" id="id-existsval" style="color:red">Project ID Already Exists.</span>
					</div>-->
				<?php } ?>
				</div>
			</form>
			<form>
				<div class="pull-left">
					<label class="project-status">Project Status</label>
					<select name="pjt_status" id="pjt_status" class="textfield" <?php if ($chge_access != 1) { ?> disabled <?php } ?> style="width: 190px;">
						<option value="1"  <?php if($quote_data['pjt_status'] == 1) echo 'selected="selected"'; ?>>Project In Progress</option>
						<option value="2"  <?php if($quote_data['pjt_status'] == 2) echo 'selected="selected"'; ?>>Project Completed</option>
						<option value="3"  <?php if($quote_data['pjt_status'] == 3) echo 'selected="selected"'; ?>>Project Onhold</option>
						<option value="4"  <?php if($quote_data['pjt_status'] == 4) echo 'selected="selected"'; ?>>Inactive</option>
					</select>
					<input type="hidden" class="hiddenUrl"/>
					<input type="hidden" id="pjt_status_hidden" value=<?php echo $quote_data['pjt_status']; ?> />
				</div>					
				<?php 
				$show_disable = true;				
				if ($chge_access == 1) { 
				$show_disable = false;
				?>
				<div class="buttons">
					<button type="submit" class="positive" id="submitid" style="margin:0 0 0 5px;" onclick="setProjectStatus(); return false;">Set</button>
					<div id="resmsg" class="error-msg"></div>
				</div>
				<?php } ?>
			</form>
			<div class="pull-left"><label class="rag">RAG Status</label></div>
			<div class="rag-status">
				<input type="radio" name="rag_status" class="rag_stat" value="1" id="red" <?php if ($readonly_status == true) { ?> disabled <?php } ?> >
				<input type="radio" name="rag_status" class="rag_stat" value="2" id="amber" <?php if ($readonly_status == true) { ?> disabled <?php } ?> >
				<input type="radio" name="rag_status" class="rag_stat" value="3" id="green" <?php if ($readonly_status == true) { ?> disabled <?php } ?> >
				<span id="errmsg_rag_status" style="color:red; float: right; margin: 6px 0px 0px 5px;"></span>
			</div>

			<!-- Project Progress Thermometer - Start -->
			<div style="margin:10px 0; ">
				<h6 class="status-title">Project Completion Status &nbsp; <span class="small" style="color:#a51e04" >[ Current Status - <em><strong>0</strong>% Completed </em> ]</span></h6>
				<div class="meter-container">
					<div class="track-meter"></div>
					<div class="track-progress-left"></div>
					<div class="progress-cont">
						<div class="track-progress"></div>
					</div>
					<div class="track"></div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl-scale">
						<tbody>
							<tr>
								<td>10</td>
								<td>20</td>
								<td>30</td>
								<td>40</td>
								<td>50</td>
								<td>60</td>
								<td>70</td>
								<td>80</td>
								<td>90</td>
								<td>100</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- Project Progress Thermometer - End -->

			<!--List the project Type from the timesheet-->
			<?php /*?><label class="pull-left">Project Type</label>
			<div class="displaycontent">
				<?php
					if(count($timesheetProjectType)>0) {
						echo $timesheetProjectType['project_type_name'];
					} else {
						echo '-';
					}
				?>
			</div><?php */?>
			<?php //require (theme_url().'/tpl/user_accounts_options.php'); ?>
			
			<!--List the project lead from the timesheet-->
			</div>
			<!---------------------------------SECTION LEFT--------------------------------->		 
			 
			<!---------------------------------SECTION RIGHT--------------------------------->
			<div class="sec-right">
			<div class="pull-left">
			<label class="project-manager" style="vertical-align: 0px;">Project Manager</label>
				<select <?php if($show_disable) { echo 'disabled="disabled"';} ?> class="chzn-select" data-placeholder="Select Member" id="project_manager" name="project_manager">
					<?php if(!empty($all_users)):?>
							<option value=""></option>
							<?php foreach($all_users as $pms):?>
								<option <?php echo ($quote_data['assigned_to'] == $pms['userid'])?'selected="selected"':''?> value="<?php echo $pms['userid']?>"><?php echo $pms['first_name'].' '.$pms['last_name'].'-'.$pms['emp_id'];?></option>
							<?php endforeach;?>
					<?php endif; ?>
				</select>
			</div>
			<?php 			
			if($chge_access == 1 && $quote_data['pjt_status'] != 2) {
			?>
			<div>
				<div class="buttons">
						<button onclick="setProjectManager(); return false;" style="margin:0 0 0 5px;" id="project_manager_id" class="positive" type="submit">Set</button>
						<div class="error-msg" id="resmsg1"></div>
				</div>
			</div>
			<?php } ?>
			<div style="margin-bottom:15px;" class="clear-both"></div>	
			
			<!--Stake Holders-->
			<?php
				// get stake holders 
				$stake_users_array = array();
				if(count($stake_holders) > 0 && !empty($stake_holders)):
					foreach($stake_holders as $sh):
						$stake_users_array[] = $sh['user_id'];
					endforeach;
				endif;
			?>
			<div class="clear-both" style="margin-bottom:15px;"></div>
			<div class="pull-left team-mem">
			<label class="project-stake-members">Stake Holders</label>
				<select <?php if($show_disable) { echo 'disabled="disabled"';} ?> multiple="multiple" class="chzn-select" data-placeholder="Select Members"  id="stake_members" name="stake_members[]">
					<?php if(!empty($all_users)):?>
							<!--option value=""></option-->
							<?php foreach($all_users as $pms):
									$selected = (in_array($pms['userid'],$stake_users_array))?'selected="selected"':'';?>
									<option <?php echo $selected; ?> value="<?php echo $pms['userid']?>"><?php echo $pms['first_name'].' '.$pms['last_name'].'-'.$pms['emp_id'];?></option>
							<?php endforeach;?>
					<?php endif; ?>
				</select>
			</div>
			<?php 
			if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
			<div class="team-mem-btn">
				<div class="buttons">
					<button onclick="setStakeMembers(); return false;" style="margin:0 0 0 5px;" id="stake_members_id" class="positive" type="submit">Set</button>
					<div class="error-msg" id="resmsg3"></div>
				</div>
			</div>
			<?php } ?>
			<div style="margin:10px;" class="clear-both"></div>		
			<!--Stake Holders-->
			
			<!--List the project assigned members from the timesheet-->
			<div class="pull-left team-mem">
			<label class="project-team-members">Team Members</label>
				<select <?php if($show_disable) { echo 'disabled="disabled"';} ?> multiple="multiple" class="chzn-select" data-placeholder="Select Members" id="project_team_members" name="project_team_members[]">
					<?php if(!empty($all_users)):?>
							<!--option value=""></option-->
							<?php foreach($all_users as $pms):
									$selected = (in_array($pms['userid'],$restrict1))?'selected="selected"':'';?>
									<option <?php echo $selected; ?> value="<?php echo $pms['userid']?>"><?php echo $pms['first_name'].' '.$pms['last_name'].'-'.$pms['emp_id'];?></option>
							<?php endforeach;?>
					<?php endif; ?>
				</select>
			</div>
			<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
			<div class="team-mem-btn">
				<div class="buttons">
					<button onclick="setProjectMembers(); return false;" style="margin:0 0 0 5px;" id="project_members_id" class="positive" type="submit">Set</button>
					<div class="error-msg" id="resmsg2"></div>
				</div>
			</div>			
			<?php } ?>
			<div style="margin:10px;" class="clear-both"></div>	
			<!--List the project assigned members from the timesheet-->

			<!-- List of Reporters mapped in Compliance group -->
			<div class="pull-left team-mem">
			<label class="auditor">Reporter/Tester</label>
				<select <?php if($compliance_fields_access != 1) { echo 'disabled="disabled"';} ?> multiple="multiple" class="chzn-select" data-placeholder="Select Reporter/Tester" id="reporter" name="reporter[]">
					<?php if(!empty($reporterList)):?>
							<!--option value=""></option-->
							<?php 
								foreach($reporterList as $reporter):
									$selected = (in_array($reporter['userid'],$projReporters))?'selected="selected"':'';?>
									<option <?php echo $selected; ?> value="<?php echo $reporter['userid']?>"><?php echo $reporter['first_name'].' '.$reporter['last_name'].'-'.$reporter['emp_id'];?></option>
							<?php endforeach;?>
					<?php endif; ?>
				</select>
                                <input type="hidden" id="exist_reporters" value="<?php echo implode(',', $projReporters); ?>">
			</div>
			<?php if($compliance_fields_access == 1 && $quote_data['pjt_status'] != 2) { ?>
			<div class="team-mem-btn">
				<div class="buttons">
					<button onclick="setReporter(<?php echo $this->compliance_config['compliance_role']['reporter_id']; ?>); return false;" data-roleid="<?php echo $this->compliance_config['compliance_role']['reporter_id']; ?>" style="margin:0 0 0 5px;" class="positive" type="submit">Set</button>
					
				</div>
			</div>
                        <div class="error-msg" id="reporter_error"></div>
			<?php } ?>
			<div style="margin:10px;" class="clear-both"></div>
                        
                        
                        <!-- List of Auditors mapped in Compliance group -->
			<div class="pull-left team-mem">
			<label class="auditor">Auditor</label>
				<select <?php if($compliance_fields_access != 1) { echo 'disabled="disabled"';} ?> multiple="multiple" class="chzn-select" data-placeholder="Select Auditor" id="auditor" name="auditor[]">
					<?php if(!empty($auditorList)):?>
							<!--option value=""></option-->
							<?php 
								foreach($auditorList as $auditor):
									$selected = (in_array($auditor['userid'],$projAuditors))?'selected="selected"':'';?>
									<option <?php echo $selected; ?> value="<?php echo $auditor['userid']?>"><?php echo $auditor['first_name'].' '.$auditor['last_name'].'-'.$auditor['emp_id'];?></option>
							<?php endforeach;?>
					<?php endif; ?>
				</select>
                                <input type="hidden" id="exist_auditors" value="<?php echo implode(',', $projAuditors); ?>">
			</div>
			<?php if($compliance_fields_access == 1 && $quote_data['pjt_status'] != 2) { ?>
			<div class="team-mem-btn">
				<div class="buttons">
					<button onclick="setAuditor(<?php echo $this->compliance_config['compliance_role']['auditor_id']; ?>); return false;" data-roleid="<?php echo $this->compliance_config['compliance_role']['auditor_id']; ?>" style="margin:0 0 0 5px;" class="positive" type="submit">Set</button>
					
				</div>
			</div>
                        <div class="error-msg" id="auditor_error"></div>
			<?php } ?>
			<div style="margin:10px;" class="clear-both"></div>
                        
                        <?php /*
                        <!-- List of FH mapped in Compliance group -->
			<div class="pull-left team-mem">
			<label class="auditor">Function Head</label>
				<select <?php if($show_disable) { echo 'disabled="disabled"';} ?> class="chzn-select" data-placeholder="Select Function Head" id="function_head" name="function_head[]">
					<?php if(!empty($fhList)):?>
							<option value="">Select Function Head</option>
							<?php 
								foreach($fhList as $fh):
									$selected = (in_array($fh['userid'],$projFh))?'selected="selected"':'';?>
									<option <?php echo $selected; ?> value="<?php echo $fh['userid']?>"><?php echo $fh['first_name'].' '.$fh['last_name'].'-'.$fh['emp_id'];?></option>
							<?php endforeach;?>
					<?php endif; ?>
				</select>
                                <input type="hidden" id="exist_fh" value="<?php echo implode(',', $projFh); ?>">
			</div>
			<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
			<div class="team-mem-btn">
				<div class="buttons">
					<button onclick="setFh(<?php echo $this->compliance_config['compliance_role']['fh_id']; ?>); return false;" data-roleid="<?php echo $this->compliance_config['compliance_role']['fh_id']; ?>" style="margin:0 0 0 5px;" class="positive" type="submit">Set</button>
					
				</div>
			</div>
                        <div class="error-msg" id="fh_error"></div>
			<?php } ?>
			<div style="margin:10px;" class="clear-both"></div>
                        
                        
                        <!-- List of CISO mapped in Compliance group -->
			<div class="pull-left team-mem">
			<label class="auditor">CISO</label>
				<select <?php if($show_disable) { echo 'disabled="disabled"';} ?> class="chzn-select" data-placeholder="Select CISO" id="ciso" name="ciso[]">
					<?php if(!empty($cisoList)):?>
							<option value="">Select CISO</option>
							<?php 
								foreach($cisoList as $ciso):
									$selected = (in_array($ciso['userid'],$projCiso))?'selected="selected"':'';?>
									<option <?php echo $selected; ?> value="<?php echo $ciso['userid']?>"><?php echo $ciso['first_name'].' '.$ciso['last_name'].'-'.$ciso['emp_id'];?></option>
							<?php endforeach;?>
					<?php endif; ?>
				</select>
                                <input type="hidden" id="exist_ciso" value="<?php echo implode(',', $projCiso); ?>">
			</div>
			<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
			<div class="team-mem-btn">
				<div class="buttons">
					<button onclick="setCiso(<?php echo $this->compliance_config['compliance_role']['ciso_id']; ?>); return false;" data-roleid="<?php echo $this->compliance_config['compliance_role']['ciso_id']; ?>" style="margin:0 0 0 5px;" id="auditor_id" class="positive" type="submit">Set</button>
					
				</div>
			</div>
                        <div class="error-msg" id="ciso_error"></div>
			<?php } */?>
                        
                        <div class="pull-left team-mem">
			<label class="auditor">Function Head : </label>
                            <?php echo isset($fh_ciso['function_head']) ? $fh_ciso['function_head'] : '-'; ?>
			</div>
                        <div class="pull-left team-mem">
			<label class="auditor">CISO : </label>
                            <?php echo isset($fh_ciso['ciso']) ? $fh_ciso['ciso'] : '-'; ?>
			</div>
                        
			<div style="margin:10px;" class="clear-both"></div>					

			<div style="margin:10px;" class="clear-both"></div>
			
			</div>
			<!---------------------------------SECTION RIGHT--------------------------------->
		
                <!-- Popup for  selecting the members from Group-->        
                <div id="select_from_group_modal" >
                    <div class="file-tabs-close-project" id="file-tabs-close"></div>
                    <div class="set-group-view" id="set-group-view"  style="height:250px;"><br/>
						
                    </div>
		</div>
<?php if($project_tab_access == 1){ ?>                        
  <div id="project-tabs" style="width:99.5%;float:left;margin:10px 0 0 0;">
	<div>
		<ul id="job-view-tabs">
			<?php if($this->userdata['role_id'] != 8):?>
				<li><a href="<?php echo current_url() ?>#jv-tab-0">Metrics</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-0-a">Other Cost</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-1">Payment Milestones</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-2">Document</a></li>
			<?php endif; ?>
				<li><a href="<?php echo current_url() ?>#jv-tab-3">Files</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-4">Tasks</a></li>
				<?php 
				if($show_gantt_chart==0 && $show_milestones==1)
				{ //if gantt chart data not exists and milestones data exists then show milestones 
				?>
					<li><a href="<?php echo current_url() ?>#jv-tab-4-5">Milestones</a></li>			
				<?php 
				}?>
				<li><a href="<?php echo current_url() ?>#jv-tab-7">URLs</a></li>
			<?php if($this->userdata['role_id'] != 8):?>
				<li><a href="<?php echo current_url() ?>#jv-tab-5">Customer</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-5-5">Customer History</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-8">Timesheet</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-8-5">Audit Compliance</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-8-6">Defects Summary</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-8-7">Quality Metrics</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-10" id="send_mail_tab">Send Email</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-9">Job History</a></li>
				<li><a href="<?php echo current_url() ?>#jv-tab-11">Gantt Chart</a></li>
			<?php endif; ?>
		</ul>
	</div>
	<?php if($this->userdata['role_id'] != 8):?>
	<div id="jv-tab-0">
		<div class="metrics_overlay" style="overflow: auto;">
		<div class="pull-left">
			<table id="project-date-assign" class="data-table1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Project Dates</th>
					<th>Planned</th>
					<th>Actual</th>
				</tr>
				<tr>					
					<td><strong>Start Date</strong></td>
					<td>
						<input type="text" data-calendar="true" value="<?php if ($quote_data['date_start'] != '') echo date('d-m-Y', strtotime($quote_data['date_start'])); else echo ''; ?>" <?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?> class="textfield pick-date width100px" <?php } else { ?> class="textfield width60px" <?php } ?> id="project-start-date" readonly />
						<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
							<div class="pjt-btn">
								<button type="submit" class="positive" onclick="setProjectStatusDate('start'); return false;">Set</button>
								<button type="submit" class="negative" onclick="rmProjectStatusDate('start'); return false;">Remove</button>
							</div>
						<?php } ?>
					</td>
					<td>
						<input type="text" data-calendar="true" value="<?php if ($quote_data['actual_date_start'] != '') echo date('d-m-Y', strtotime($quote_data['actual_date_start'])); else echo ''; ?>" <?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?> class="textfield pick-date width100px" <?php } else { ?> class="textfield width60px" <?php } ?> id="actual-project-start-date" readonly />
						<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
							<div class="buttons">
								<button type="submit" class="positive" onclick="actualSetProjectStatusDate('start'); return false;">Set</button>
								<button type="submit" class="negative" onclick="rmProjectStatusDate('act-start'); return false;">Remove</button>
							</div>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td><strong>End Date</strong></td>
					<td>
						<input type="text" data-calendar="true" value="<?php if ($quote_data['date_due'] != '') echo date('d-m-Y', strtotime($quote_data['date_due'])); else echo ''; ?>" <?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?> class="textfield pick-date width100px" <?php } else { ?> class="textfield width60px" <?php } ?> id="project-due-date" readonly />
						<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
						<div class="buttons">
							<button type="submit" class="positive buttons" onclick="setProjectStatusDate('due'); return false;">Set</button>
							<button type="submit" class="negative buttons" onclick="rmProjectStatusDate('due'); return false;">Remove</button>
						</div>
						<?php } ?>
					</td>
					<td>
						<input type="text" data-calendar="true" value="<?php if ($quote_data['actual_date_due'] != '') echo date('d-m-Y', strtotime($quote_data['actual_date_due'])); else echo ''; ?>" <?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?> class="textfield pick-date width100px" <?php } else { ?> class="textfield width60px" <?php } ?> id="actual-project-due-date" readonly />
						<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
							<div class="buttons">
								<button type="submit" class="positive" onclick="actualSetProjectStatusDate('due'); return false;">Set</button>
								<button type="submit" class="negative" onclick="rmProjectStatusDate('act-due'); return false;">Remove</button>
							</div>
						<?php } ?>
					</td>
				</tr>
			</table>
			<div id="dates_errmsg" style="color:red; margin:5px"></div>
		</div>
		<div class="pull-left">
			<table id="project-efforts" class="data-table1" cellpadding="0" cellspacing="0">
				<tr>
					<th></th>
					<th>Budgeted</th>
					<th>Actual</th>
					<?php if($quote_data['billing_type'] != 2) { ?>
					<th>Variance</th>
					<?php } ?>
				</tr>
				<tr>					
					<td><strong>Efforts (Hours)</strong></td>
					<td>
						<input type="text" value="<?php if ($quote_data['estimate_hour'] != '') echo $quote_data['estimate_hour']; else echo ''; ?>" class="textfield width60px" id="project-estimate-hour" onkeypress="return isNumberKey(event)" maxlength="10" <?php if($chge_access != 1) { ?> readonly <?php } ?>/>
						<?php if($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
							<button type="submit" class="positive" onclick="setProjectEstimateHour(); return false;">Set</button>
						<?php } ?>
					</td>
					<td> 
						<input type="text" id="actualEff" value="<?php echo isset($actual_hour_data) ? sprintf('%0.2f', $actual_hour_data) : ''; ?>" class="textfield width60px" readonly />
					</td>
					<?php if($quote_data['billing_type'] != 2) { ?>
					<td>
						<?php 
							if (isset($actual_hour_data) && $actual_hour_data != '')
								$varianceProjectHour = $actual_hour_data - $quote_data['estimate_hour'];
							else
								$varianceProjectHour = '';
						?>
						<input type="text" id="varianceEff" value="<?php if (isset($varianceProjectHour)) echo sprintf('%0.2f', $varianceProjectHour); else echo ''; ?>" class="textfield width60px" readonly />
					</td>
					<?php } ?>
				</tr>
				<tr>					
					<td><strong>Project Value (<?php if (isset($quote_data['expect_worth_name'])) echo $quote_data['expect_worth_name']; ?>) </strong></td>
					<td>
						<input class="textfield" style="width: 60px;" type="text" name="pjt_value" id="pjt_value" value="<?php if (isset($quote_data['actual_worth_amount'])) echo $quote_data['actual_worth_amount']; ?>" <?php if ($chge_access != 1) { ?>readonly<?php } ?> onkeypress="return isNumberKey(event)" />
						<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
						<button type="submit" class="positive" onclick="setProjectVal(); return false;">Set</button>
						<?php } ?>
					</td>
					<td>
						<?php
							$project_cost 		= (!empty($project_costs)) ? $project_costs : 0;
							$total_other_cost 	= (!empty($othercost_val)) ? $othercost_val : 0;
							$project_cost 		= $project_cost + $total_other_cost; /*changed based on user max hours calculation*/
						?>
						<input type="text" id="actualValue" value="<?php echo sprintf('%0.02f', $project_cost); ?>" class="textfield width60px" readonly />
					</td>
					<?php if($quote_data['billing_type'] != 2) { ?>
					<td>
						<?php 
							if (isset($quote_data['actual_worth_amount']))
								$varianceProjectVal = $quote_data['actual_worth_amount'] - $project_cost;
							else
								$varianceProjectVal = '';
						?>
						<input type="text" id="varianceValue" value="<?php if (isset($varianceProjectVal)) echo sprintf('%0.2f', $varianceProjectVal); else echo ''; ?>" class="textfield width60px" readonly />
					</td>
					<?php } ?>
				</tr>
			</table>
			<div id="msg_project_efforts" style="margin:5px;"></div>
		</div>
		<!-- project variance report starts -->
		<?php if(count($timesheet_variance)>0 && !empty($timesheet_variance)){
				$tot_est_hours = 0;
				$tot_act_hours = 0;
				$tot_variant_hours = 0;
			?>
		<div class="pull-left" style="width:360px;">
			<table id="project-efforts" class="data-table1" cellpadding="0" cellspacing="0">
				<tr>
					<th>Task Name</th>
					<th>Estimated Hours</th>
					<th>Actual Hours</th>
					<th>Variant Hours</th>
				</tr>
				<?php foreach($timesheet_variance as $tv ){
						$variant=($tv->actualHours)-$tv->EstimatedHours;
						$tot_est_hours+=$tv->EstimatedHours;
						$tot_act_hours+=$tv->actualHours;
						$tot_variant_hours+=$variant;?>
				<tr>
					<td><?php echo $tv->taskName;?></td>
					<td><?php echo number_format($tv->EstimatedHours,2);?></td>
					<td><?php echo number_format($tv->actualHours,2);?></td>
					<td><?php echo number_format($variant,2);?></td>
				</tr>
				<?php } ?>
				<tr>
					<td style="font-weight:bold;" align="right">Total</td>
					<td style="font-weight:bold;"  align="right"><?php echo number_format($tot_est_hours,2); ?></td>
					<td style="font-weight:bold;"  align="right"><?php echo number_format($tot_act_hours,2); ?></td>
					<td style="font-weight:bold;"  align="right"><?php echo number_format($tot_variant_hours,2); ?></td>						
				</tr>				
			</table>
			<div id="msg_project_variance" style="margin:5px;"></div>
		</div>
		<?php } ?>
		<!-- project variance report ends -->
		</div>
	</div><!--end of jv-tab-0 -->
	
	<div id="jv-tab-0-a"><!--start of jv-tab-0-a-->
		<div style="color:red; margin:7px 0 0;" id="err_other_cost_data" class="succ_err_msg"></div>
		<div style="margin:7px 0 0;" id="succes_other_cost_data" class="succ_err_msg"></div>
		<div id="other_cost_data"> </div>
		<!--File Upload--Start-->
		<div id="oc_map_add_file" >
			<div class="file-tabs-close-project" id="file-tabs-close"></div>
			<div>
				<ul id="oc_map_add_file-tabs">
					<li><a href="<?php echo current_url() ?>#oc-map-tab-2">Select File</a></li>
					<li><a href="<?php echo current_url() ?>#oc-map-tab-4">Add New File</a></li>
				</ul>
			</div>
			<div id="oc-map-tab-2" style="height:260px; overflow:scroll;">
				<div name='oc_all_file_list' id="oc_all_file_list" style="text-align: left;"></div>
				<div style="padding: 10px 0px 0px;">
					<button type="submit" class="positive" onclick="select_othercost_files()">Submit</button>
				</div>
			</div>
			<div id="oc-map-tab-4" style="height:260px; overflow:scroll;">
				<form name="othercost_ajax_file_upload" style="height: 35px;">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<div id="upload-container">
						<?php if (($file_upload_access == 1 && $quote_data['pjt_status'] != 2) || ($chge_access == 1 && $quote_data['pjt_status'] != 2)) { ?>
							<label style="float:left;">Browse file</label>
							<input type="file" title='upload' class="textfield" multiple id="othercost_ajax_file_uploader" name="othercost_ajax_file_uploader[]" onchange="return runOtherCostAjaxFileUpload();"/>
							<input type="hidden" id="oc_exp_type" value="">
						<?php } ?>
					</div>
				</form>
			</div>
		</div>
		<!--File Upload--END-->
	</div><!--end of jv-tab-0-a-->
	
	<div id="jv-tab-1"><!--start of jv-tab-1-->
				<div class="q-view-main-top">
					
					<div class="payment-buttons clearfix">
						<div class="buttons">
						 <?php //if($company_det['sap_status'] == 'SAP') { ?>
						 <?php if($quote_data['project_types'] != 4 || $quote_data['project_types'] != 8){ if($quote_data['entity'] == '1' && $quote_data['group'] == '100'){ ?>
								<a class=" positive" href="javascript:void(0);" id="service_item" >Invoices</a>
						 <?php } else{ ?>	
							<a class=" positive" href="javascript:void(0);" onClick="paymentProfileAdd('service')">Invoices</a>
						 <?php } ?>	
							
						 <?php } else{ ?>	
						 <a class=" positive" href="javascript:void(0);" >Invoices</a>
						 <?php } /*} else{  ?>	
						 <a class=" positive" href="javascript:void(0);" onClick="customerApprovalMsg()" >Invoices</a>
						 <?php } */?>
						</div>
						<div class="buttons">
						<a class="payment-received-button positive" href="#" onclick="">Payment Received</a>
						</div>
					</div>
				
				<?php
				if ($quote_data['payment_terms'] == 0 || $quote_data['payment_terms'] == 1)
				{
				?>
				  <div class="modal fade" id="mymodal" style="float:left;"><br/>	
				  <div class="modal-dialog modal-xl">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5 class="modal-title"></h5>
					</div>
				     <div class="modal-body">
					 <div style="color:red; margin:7px 0 0;" id="rec_paymentfadeout"></div>
					  <div class="payment-profile-view" id="payment-profile-view" ><br/>
						
						</div>
					</div>
				  </div>
				</div>
				</div>
					<div class="payment-invoice-view" id="payment-invoice-view" style="float:left;display:none;margin-right: 2%;"><br/>
						
					</div>
					<div id="invoice_add_file" style="display:none;">
						<div class="file-tabs-close-project" id="file-tabs-close"></div>
						<div>
							<ul id="invoice_add_file-tabs">
								
								<li><a href="<?php echo current_url() ?>#invoice-tab-4">Add New File</a></li>
								<li><a href="<?php echo current_url() ?>#invoice-tab-2">Select File</a></li>
							</ul>
						</div>
						<div id="invoice-tab-2" style="height:260px; overflow:scroll;">
							<div name='all_invoice_file_list' id="all_invoice_file_list" style="text-align: left;"></div>
							<div style="padding: 10px 0px 0px;">
								<button type="submit" class="positive" onclick="select_files_invoice()">Submit</button>
							</div>
						</div>
						<div id="invoice-tab-4" style="height:260px; overflow:scroll;">
							<form name="payment_ajax_file_upload" style="height: 65px;">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								<div id="upload-container">
									<?php if (($file_upload_access == 1 && $quote_data['pjt_status'] != 2) || ($chge_access == 1 && $quote_data['pjt_status'] != 2)) { ?>
										<label style="float:left;">Browse file</label>
										<input type="file" title='upload' class="textfield" multiple id="invoice_ajax_file_uploader" name="invoice_ajax_file_uploader[]" onchange="return runInvoiceAjaxFileUpload();"/>
										<input type="hidden" id="exp_invoice_type" value="">
									<?php } ?> 
								</div>
							</form>
						</div>
					</div>
					<div id="map_add_file" >
						<div class="file-tabs-close-project" id="file-tabs-close"></div>
						<div>
							<ul id="map_add_file-tabs">
								
								<li><a href="<?php echo current_url() ?>#map-tab-4">Add New File</a></li>
								<li><a href="<?php echo current_url() ?>#map-tab-2">Select File</a></li>
							</ul>
						</div>
						<div id="map-tab-2" style="height:260px; overflow:scroll;">
							<div name='all_file_list' id="all_file_list" style="text-align: left;"></div>
							<div style="padding: 10px 0px 0px;">
								<button type="submit" class="positive" onclick="select_files()">Submit</button>
							</div>
						</div>
						<div id="map-tab-4" style="height:260px; overflow:scroll;">
							<form name="payment_ajax_file_upload" style="height: 65px;">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
								<div id="upload-container">
									<?php if (($file_upload_access == 1 && $quote_data['pjt_status'] != 2) || ($chge_access == 1 && $quote_data['pjt_status'] != 2)) { ?>
										<label style="float:left">Browse file</label>
										<input type="file" title='upload' class="textfield" multiple id="payment_ajax_file_uploader" name="payment_ajax_file_uploader[]" onchange="return runPaymentAjaxFileUpload();"/>
										<input type="hidden" id="exp_type" value="">
									<?php } ?> 
								</div>
							</form>
						</div>
					</div>
					<?php
						$output = '';
						$total_amount_recieved = '';
						$pt_select_box = '';
						
						$output .= '<div class="payment-terms-mini-view1" style="display:block; float:left; margin-top:5px;">';
					    if(!empty($payment_data))
						{
							$pdi = 1;
							$pt_select_box .= '<option value="0"> &nbsp; </option>';
							
							$output .= '<div align="left" style="background: none repeat scroll 0 0;">
							<h6>Agreed Payment Terms</h6>
							<div class=payment_legend>
							<div class="pull-left"><img src=assets/img/payment-received.jpg><span>Payment Received</span></div>
							<div class="pull-left"><img src=assets/img/payment-pending.jpg><span>Partial Payment</span></div>
							<div class="pull-left"><img src=assets/img/payment-due.jpg ><span>Payment Due</span></div>
							<div class="pull-left"><img src=assets/img/generate_invoice.png><span>Generate Invoice</span></div>
							<div class="pull-left"><img src=assets/img/invoice_raised.png><span>Invoice Raised</span></div>
							</div></div>';
							$output .= "<table class='data-table' cellspacing = '0' cellpadding = '0' border = '0'>";
							$output .= "<thead>";
							$output .= "<tr align='left' >";
							$output .= "<th class='header'>Payment Milestone</th>";
							$output .= "<th class='header'>Milestone Date</th>";
							$output .= "<th class='header'>For the Month & Year</th>";
							$output .= "<th class='header'>Amount</th>";
							$output .= "<th class='header'>Attachments</th>";
							$output .= "<th class='header'>Status</th>";
							$output .= "<th class='header'>Action</th>";
							$output .= "</tr>";
							$output .= "</thead>";
							foreach ($payment_data as $pd)
							{
								$att_condn   = array("expectid"=>$pd['expectid']);
								$attachments = $this->customer_model->get_records_by_num("expected_payments_attach_file",$att_condn);

								$month_year     = ($pd['month_year']!='0000-00-00 00:00:00') ? date('F Y', strtotime($pd['month_year'])) :'';
								$payment_amount = number_format($pd['amount'], 2, '.', ',');
								$total_amount_recieved += $pd['amount'];
								$payment_received = '';
								$invoice_stat = '';
								$raised_invoice_stat = '';
								if ($pd['invoice_status'] == 1) {
									$raised_invoice_stat = "<img src='assets/img/invoice_raised.png' alt='Invoice-raised'>";
								}
								if ($pd['received'] == 0) {
									$payment_received = $raised_invoice_stat.'&nbsp;<img src="assets/img/payment-due.jpg" alt="Due" />';
								} else if ($pd['received'] == 1) {
									$payment_received = '<img src="assets/img/payment-received.jpg" alt="received" />';
								} else {
									$payment_received = $raised_invoice_stat.'&nbsp;<img src="assets/img/payment-pending.jpg" alt="pending" />';
								}
								if ($readonly_status == false) {
									if ($pd['invoice_status'] == 0) {
										$invoice_stat = "<a title='Edit' onclick='paymentProfileEdit(".$pd['expectid']."); return false;' ><img src='assets/img/edit.png' alt='edit'></a><a title='Delete' href='javascript:void(0)' onclick='paymentProfileDelete(".$pd['expectid']."); return false;'><img src='assets/img/trash.png' alt='delete' ></a>
										<a title='Generate Invoice' href='javascript:void(0)' onclick='generate_inv(".$pd['expectid']."); return false;'><img src='assets/img/generate_invoice.png' alt='Generate Invoice' ></a>";
									} else if ($pd['invoice_status'] == 1) {
										$invoice_stat = "<a title='Edit' onclick='paymentProfileEdit(".$pd['expectid']."); return false;' ><img src='assets/img/edit.png' alt='edit'></a>
										<a title='Delete' class='readonly-status img-opacity' href='javascript:void(0)'><img src='assets/img/trash.png' alt='delete'></a>
										<a title='Generate Invoice' href='javascript:void(0)' class='readonly-status img-opacity'><img src='assets/img/generate_invoice.png' alt='Generate Invoice'></a>";
									}
								} else {
									$invoice_stat = "<a title='Edit' class='readonly-status img-opacity' href='javascript:void(0)'><img src='assets/img/edit.png' alt='edit'></a>
										<a title='Delete' class='readonly-status img-opacity' href='javascript:void(0)'><img src='assets/img/trash.png' alt='delete'></a><a title='Generate Invoice' href='javascript:void(0)' class='readonly-status img-opacity'><img src='assets/img/generate_invoice.png' alt='Generate Invoice'></a>";
								}
								$att = "";
								if($attachments!=0){
									$att = "<img src='assets/img/attachment_icon.png' alt='Attachments' >";
								}
								$output .= "<tr>";
								$output .= "<td align='left'>".$pd['project_milestone_name']."</td>";
								$output .= "<td align='left'>".date('d-m-Y', strtotime($pd['expected_date']))."</td>";
								$output .= "<td align='left'>".$month_year."</td>";
								$output .= "<td align='left'> ".$pd['expect_worth_name'].' '.number_format($pd['amount'], 2, '.', ',')."</td>";
								$output .= "<td align='center'>".$att."</td>";
								$output .= "<td align='center'>".$payment_received."</td>";
								if ($readonly_status == false || $this->session->userdata['logged_in_user']['role_id']==4) {
									$output .= "<td align='left'>".$invoice_stat."</td>";
								} else {
									$output .= "<td align='left'>".$invoice_stat."</td>";
								}

								$output .= "</tr>";
								$pt_select_box .= '<option value="'. $pd['expectid'] .'">' . $pd['project_milestone_name'] ." \${$payment_amount} by {$expected_date}" . '</option>';
								$pdi ++;
							}
							$output .= "<tr>";
							$output .= "<td></td><td></td>";
							$output .= "<td colspan='0'><b>Total Milestone Payment :</b></td><td><b>".$pd['expect_worth_name'].' '.number_format($total_amount_recieved, 2, '.', ',') ."</b></td>";
							$output .= "</tr>";
							$output .= "</table>";
						}
						$output .= '</div>';
					    echo $output;
						?>
						<!--payment received starts here -->

						<div class="payment-recieved-view" id="payment-recieved-view" style="display:none;float:left;"><br/>
						<form id="payment-recieved-terms">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						
							<p>Invoice No *<input type="text" name="pr_date_1" id="pr_date_1" class="textfield width201px" /> </p>
							<p>Amount Received *<input type="text" name="pr_date_2" onkeypress="return isNumberKey(event)" id="pr_date_2" class="textfield width201px" /><span style="color:red;">(Numbers only)</span></p>
							<p>Date Received *<input type="text" data-calendar="true" name="pr_date_3" id="pr_date_3" class="textfield width201px" readonly /> </p>
							
							<?php if (isset($pt_select_box)) { ?>
								<p>Map to a payment term *<select name="deposit_map_field" class="deposit_map_field" style="width:210px;"><?php echo $pt_select_box; ?></select></p>
							<?php } else { ?>
								<p>Map to a payment term *<select name="deposit_map_field" class="deposit_map_field" style="width:210px;"><?php echo $pt_select_box; ?></select></p>
							<?php } ?>
							
							<p>Comments <textarea name="pr_date_4" id="pr_date_4" class="textfield width201px" ></textarea> </p>
							<div class="buttons">
                <?php if ($readonly_status == false){ ?>
								<button type="submit" class="positive" onclick="setPaymentRecievedTerms(); return false;">Add Payment</button>
                <?php } ?>
								<button type="button" class="positive" style="margin-left: 11px;" onclick="goBackInvoiceList()">Cancel</button>
							</div>
							<input type="hidden" name="pr_form_jobid" id="pr_form_jobid" value="0" />
							<input type="hidden" name="pr_form_invoice_total" id="pr_form_invoice_total" value="0" />
						</form>
					    </div>
						<?php 
		
						$output = '';
						$amount_recieved = '';
						$output .= '<div class="payment-received-mini-view1" style="float:left; display:none; margin-top:5px;">';
						if(!empty($deposits_data))
						{
							$pdi = 1;
							$output .= '<option value="0"> &nbsp; </option>';
							$output .= "<p><h6>Payment History</h6></p>";
							$output .= "<table class='data-table' cellspacing = '0' cellpadding = '0' border = '0'>";
							$output .= "<thead>";
							$output .= "<tr align='left'>";
							$output .= "<th class='header'>Invoice No</th>";
							$output .= "<th class='header'>Date Received</th>";
							$output .= "<th class='header'>Amt Received</th>";
							$output .= "<th class='header'>Payment Term</th>";
							$output .= "<th class='header'>Action</th>";
							$output .= "</tr>";
							$output .= "</thead>";
							foreach ($deposits_data as $dd)
							{
								$expected_date = date('d-m-Y', strtotime($dd['deposit_date']));
								$payment_amount = number_format($dd['amount'], 2, '.', ',');
								$amount_recieved += $dd['amount'];								
								$output .= "<tr align='left'>";
								$output .= "<td>".$dd['invoice_no']."</td>";
								$output .= "<td>".date('d-m-Y', strtotime($dd['deposit_date']))."</td>";
								$output .= "<td> ".$dd['expect_worth_name'].' '.number_format($dd['amount'], 2, '.', ',')."</td>";
								$output .= "<td>".$dd['payment_term']."</td>";
								if ($readonly_status == false) {
								$output .= "<td align='left'><a class='edit' title='edit' onclick='paymentReceivedEdit(".$dd['depositid']."); return false;' ><img src='assets/img/edit.png' alt='edit'></a>";
								$output .= "<a class='edit' title='Delete' onclick='paymentReceivedDelete(".$dd['depositid'].",".$dd['map_term'].");' ><img src='assets/img/trash.png' alt='delete'></a></td>";
								} else {
								$output .= "<td align='left'> - </td>";
								}
								$output .= "</tr>";
							}
							$output .= "<tr>";
							$output .= "<td></td>";
							$output .= "<td><b>Total Payment: </b></td><td colspan='2'><b>".$dd['expect_worth_name'].' '.number_format($amount_recieved, 2, '.', ',')."</b></td>";
							$output .= "</tr>";
							$output .= "</table>";
						}
						$output .= "</div>";
						echo $output;
						?>
					<!--payment received ends here -->
				<?php
				}
				?>
	
		</div><!-- class:q-view-main-top end -->
	</div><!-- id: jv-tab-1 end -->


	
	
	<div id="jv-tab-2"> 
		<div class="q-container">
			<div class="q-details">
				<div class="q-quote-items">
					<h4 class="quote-title">Project Name : <?php echo (isset($quote_data)) ? $quote_data['lead_title'] : '' ?></h4>
					<ul id="q-sort-items"></ul>
				</div>
			</div>
		</div>
		<div class="q-sub-total<?php if ( ! $sensitive_information_allowed) echo ' display-none' ?>">
			<table class="width565px" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="160">Sale Amount <span id="sale_amount"></span></td>
					<td width="120" align="right">GST <span id="gst_amount"></span></td>
					<td width="20">&nbsp;</td>
					<td align="right">Total inc GST <span id="total_inc_gst"></span></td>
				</tr>
			</table>
		</div>

		<div class="q-sub-total<?php if ( ! $sensitive_information_allowed) echo ' display-none' ?>">
			<table class="width565px" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="160">&nbsp;</td>
					<td width="120" align="right">Deposits <span id="deposit_amount"></span></td>
					<td width="20">&nbsp;</td>
					<td align="right">Balance Due <span id="balance_amount"></span></td>
				</tr>
			</table>
		</div>

	</div><!-- id: jv-tab-2 end -->
	<?php endif; ?>		
	<div id="jv-tab-3">
		<?php 
			$this->load->helper('lead_helper'); 
			$file_upload_access = get_file_access($quote_data['lead_id'], $this->userdata['userid']);
		?>
		<?php $ff_id = isset($parent_ffolder_id) ? $parent_ffolder_id : ''; ?>
		
		<div id="file_breadcrumb"></div>
		<div>
			<div class="pull-left pad-right">
				<form id="file_search">
					<label class="xtra-widt">Search File or Folder or Tags(Multiple - comma separated)</label> <input type="text" class="textfield" id="search_input" value="" style="max-width: 25% !important;"/>
					<button class="positive" onclick="searchFileFolder(); return false;" style="margin:0 0 0 5px;" type="submit">Search</button>
				</form>
			</div>
			
			<input type="hidden" id="filefolder_id" value="<?php echo $ff_id; ?>"/>
			
			<div class="pull-left pad-right" id="files_actions">
				<?php if (($chge_access == 1 && $quote_data['pjt_status'] != 2)) { ?>
					<form name="ajax_file_upload" class="pull-left pad-right">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div id="upload-container">
							<img src="assets/img/uploads.png" alt="Browse" title="Browse" class="icon-width" id="upload-decoy" />
							<input type="file" title='Upload' class="textfield" multiple id="ajax_file_uploader" name="ajax_file_uploader[]" onchange="return runAjaxFileUpload();" />
						</div>
					</form>
					<div class="pull-left pad-right">
						<a title="Add Folder" href='javascript:void(0)'  onclick="create_folder(<?php echo $quote_data['lead_id']; ?>,<?php echo $ff_id; ?>); return false;"><img src="assets/img/add_folders.png" class="icon-width" alt="Add Folder" ></a>
					</div>
					<div class="pull-left pad-right">
						<a title="Move All" onclick="moveAllFiles(); return false;" ><img src="assets/img/document_move.png" class="icon-width" alt="Move All"></a>
					</div>
					<div class="pull-left pad-right">
						<a title="Delete All" onclick="deleteAllFiles(); return false;"  ><img src="assets/img/delete_new.png" class="icon-width" alt="Delete"></a>
					</div>
					<div class="pull-left pad-right">
						<a title="Edit Folder Permissions" onclick="editFolderPermissions(<?php echo $quote_data['lead_id']; ?>); return false;"  ><img src="assets/img/permissions.png" class="icon-width" alt="Edit Folder Permissions"></a>
					</div>
				<?php } ?>
			</div>
			<div class='clrboth'></div>
		</div>	

		<div id='fileupload_msg' class='succ_err_msg'></div>
		<div id="list_file">		
		</div>
		
		<form id="move-file" onsubmit="return false;">
			<!-- edit file -->
			<div id='mf_successerrmsg' class='succ_err_msg'></div>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4"><div id='mf_name'></div></td>
				</tr>
				<tr>
					<td colspan="4">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input type='hidden' name='mlead_id' id='mlead_id' value=''>
						<input type='hidden' name='mfile_id' id='mfile_id' value=''>
						<input type='hidden' name='mfparent_id' id='mfparent_id' value=''>
						<input type='hidden' name='mffiletype' id='mffiletype' value=''>
						<input type='hidden' name='mffilename' id='mffilename' value=''>
					</td>
				</tr>
				<tr>
					<td valign="top" width="80">Move to</td>
					<td colspan="3">
						<select name='move_destiny' id="file_tree">
							<option value=''>Select</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="buttons"><button type="submit" class="positive" onclick="move_files();">Move</button></div>
						<div class="buttons"><button type="submit" class="negative" onclick="$.unblockUI();">Cancel</button></div>
					</td>
				</tr>
			</table>
		<!-- edit end -->
		</form>
		
		<!-- Edit folder permissions start. -->
		<form id="edit-folder-permissions" onsubmit="return false;" style="display: none; width: 900px; height: 600px; overflow: scroll; top: 4%; left: 4%;"></form>
		<!-- Edit folder permissions end. -->
		
		<form id="create-folder" onsubmit="return false;">
			<!-- edit file -->
			<div id='af_successerrmsg' class='succ_err_msg'></div>
			<table border="0" cellpadding="5" cellspacing="5">
				<tr>
					<td colspan="2"><div id='af_name'><strong><h3>Create Folder</h3></strong></div></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input type='hidden' name='aflead_id' id='aflead_id' value=''>
						<input type='hidden' name='afparent_id' id='afparent_id' value=''>
					</td>
				</tr>
				<tr>
					<td valign="top" width="80"><label>Parent</label></td>
					<td>
						<select name='add_destiny' id="add_file_tree">
							<option value=''>Select</option>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="top" width="80"><label>New Folder</label></td>
					<td><input type="text" name="new_folder" id="new_folder" value="" class="textfield"></td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="buttons"><button type="submit" class="positive" onclick="add_folder();">Add</button></div>
						<div class="buttons"><button type="submit" class="negative" onclick="$.unblockUI();">Cancel</button></div>
					</td>
				</tr>
			</table>
		<!-- edit end -->
		</form>
		<form id="check-permissions" onsubmit="return false;">
			<!-- edit file -->
			<div id='af_successerrmsg' class='succ_err_msg'></div>
			<table border="0" cellpadding="5" cellspacing="5">
				<tr>
					<td colspan="2"><div id='af_name'><strong><h3>Assign Folder - <span id="folder_name"></span></h3></strong></div></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input type='hidden' name='cplead_id' id='cplead_id' value=''>
						<input type='hidden' name='cpparent_id' id='cpparent_id' value=''>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						 <div id="add_users_tree_1"></div>
					</td>
				</tr>			
				 <tr>
					<td colspan="2">
					<table style="display:none;" class="dashboard-heads assign_permissions" cellpadding="0" cellspacing="0">
					<?php if(!empty($project_members) && count($project_members)>0):?>
							<tr>
								<th>Users</th>
								<th>Is Recursive?</th>
								<th>Add Access</th>
								<th>View Access</th>
							</tr>
							<?php foreach($project_members as $pusers):?>							 
								<tr>
									<td><input type="hidden" name="pjt_users_id[]" value="<?php echo $pusers['userid'];?>" /><?php echo $pusers['first_name'].' '.$pusers['last_name'];?></td>
									<td><input class="js_recursive" type="checkbox" name="is_recursive[<?php echo $pusers['userid'];?>]" value="1" /></td>
									<td><input class="js_checkbox" type="checkbox" name="add_access[<?php echo $pusers['userid'];?>]" value="1" /></td>
									<td><input class="js_view_access" type="checkbox" name="download_access[<?php echo $pusers['userid'];?>]"  value="1" /></td>
								</tr>							
						<?php endforeach;?>
						<?php endif;?>
					</table>	
					</td>
				</tr>				
				<tr>
					<td colspan="2">
						<div class="buttons"><button type="submit" class="positive" onclick="assign_folder();">Save</button></div>
						<div class="buttons"><button type="submit" class="negative" onclick="$.unblockUI();">Cancel</button></div>
					</td>
				</tr>

			</table>
		<!-- edit end -->
		</form>		
		<form id="moveallfile" onsubmit="return false;">
			<!-- edit file -->
			<div id='all_mf_successerrmsg' class='succ_err_msg'></div>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4"><strong><h3>Move</h3></strong></td>
				</tr>
				<tr>
					<td colspan="4">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input type='hidden' name='mall_lead_id' id='mall_lead_id' value=''>
						<input type='hidden' name='mov_folder' id='mov_folder' value=''>
						<input type='hidden' name='mov_file' id='mov_file' value=''>
					</td>
				</tr>
				<tr>
					<td valign="top" width="80">Move to</td>
					<td colspan="3">
						<select name='move_destiny' id="file_tree_all">
							<option value=''>Select</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="buttons"><button type="submit" class="positive" onclick="move_all_files();">Move</button></div>
						<div class="buttons"><button type="submit" class="negative" onclick="$.unblockUI();">Cancel</button></div>
					</td>
				</tr>
			</table>
		<!-- edit end -->
		</form>
		<form id="folderAccessRights" onsubmit="return false;">
		<span style="float:right; cursor:pointer;" onclick="$.unblockUI();"><img src='<?php echo base_url().'assets/img/cross.png'; ?>' /></span>
			<div id='fa_successerrmsg' class='succ_err_msg'></div>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4"><strong><h3 style="text-align:center;">Access Rights</h3></strong></td>
				</tr>
				<tr>
					<td colspan="4">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input type='hidden' name='fa_lead_id' id='fa_lead_id' value=''>
						<input type='hidden' name='parent_folder_id' id='parent_folder_id' value=''>
						<input type='hidden' name='fa_folder' id='fa_folder' value=''>
						<input type='hidden' name='fa_file' id='fa_file' value=''>
					</td>
				</tr>
				<tr>
					<td colspan="4" id="accessStruct"></td>
				</tr>
				<tr>
					<td class="pad-all" colspan="4" align="right">
						<div class="buttons">
						
						<button type="submit" class="positive" onclick="savefolderAccess(); return false;"  id="folder_access_save">Save</button>		

							<img width="61px" height="27px" style=" display:none; float:left;" id="load_save_folder_access" src="<?php echo base_url().'assets/images/loading.gif'; ?>">
						
						</div>
						
					</td>
				</tr>
			</table>
		</form>
		<form id="add-tags" onsubmit="return false;">
			<!-- edit file -->
			<div id='af_successerrmsg' class='succ_err_msg'></div>
			<strong><h3 style="text-align:center;">View Tags</h3></strong>
			<input type="hidden" value="" id="tag_lead_id" />
			<input type="hidden" value="" id="tag_file_id" />
			<div class="file-tabs-close-project close_icon" id=""></div>
			<div id="tags" style="width:400px; min-height: 30px;">
				
			</div>
			<div class="pull-left" style="margin: 5px 0px;">
				<label>Add Tag:</label>
				<input type="text" class="textfield" id="tags_input" value="" autocomplete="off" placeholder="Add a tag" />
			</div>
			<!-- edit end -->
		</form>
	</div>
	<!--id: jv-tab-3 end -->

	 
	
	<div id="jv-tab-4">
		<form id="set-job-task" onsubmit="return false;">
			<div style="position:relative;">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<h3>Tasks</h3>
			<table border="0" cellpadding="0" cellspacing="0" class="task-add  toggler">
				<tr><td colspan="4"><strong>All fields are required!</strong></td></tr>
				<tr><td valign="top"><br /><br />Task</td>
					<td colspan="3">
						<strong><span id="task-desc-countdown">240</span></strong> characters left.<br />
						<textarea name="job_task" id="job-task-desc" class="width420px"></textarea>
					</td>
				</tr>
				<tr >
					<td style="padding-bottom:10px;" ><br/>Category</td>
					<td>
						<select name="task_category" data-placeholder="Choose category." class="chzn-select" id="taskCategory" style="width:140px;">
							<option value=""></option>
							<?php
								foreach($category_listing_ls as $ua)
								{
									echo '<option value="'.$ua['id'].'">'.$ua['task_category'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr >
					<td style="padding-bottom:10px;">Priority</td>
					<td>
						<select name="task_priority" data-placeholder="Choose Priority." class="chzn-select" id="taskpriority" style="width:140px;">
							<option value=""></option>
							<option value="1">Critical</option>
							<option value="2">High</option>
							<option value="3">Medium</option>
							<option value="4">Low</option>
							
						</select>
					</td>
				</tr>
				<tr>
					<td >Allocate to</td>
					<td style="padding-top:5px;">
						<select name="task_user" data-placeholder="Choose a User..." class="chzn-select" id="taskToAlloc" style="width:140px;">
							<option value=""></option>
							<?php
							// echo $remind_options, $remind_options_all;
								foreach($final_restrict_user as $ua){
									if(!empty($user_details_id[$ua]['userid'])) {
							?>
									<option value="<?php echo $user_details_id[$ua]['userid']; ?>"><?php echo $user_details_id[$ua]['first_name'] . ' ' . $user_details_id[$ua]['last_name']; ?></option>
							<?php
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Estimated Hours</td>
					<td><input type="text" name="estimated_hours" class="edit-job-est-hr textfield width100px" onkeypress="return isPaymentVal(event)" style="margin-top:5px;" maxlength="5"/></td>
				</tr>
				<tr>
					<td>
						Planned Start Date
					</td>
					<td>
						<input type="text" name="task_start_date" class="textfield pick-date width100px" style="margin: 5px 0px;"/>
					</td>
					<td>
						Planned End Date
					</td>
					<td>
						<input type="text" name="task_end_date" class="textfield pick-date width100px" />
					</td>
					
				</tr>
				<tr>
					<td>Remarks</td>
					<td colspan="3"><textarea name="remarks" id="task-remarks" class="task-remarks" width="420px"></textarea></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="buttons">
							<button type="submit" class="positive" onclick="addNewTask('','<?php echo $this->security->get_csrf_token_name()?>','<?php echo $this->security->get_csrf_hash(); ?>');">Add</button>
						</div>
						<div class="buttons">
							<button type="submit" class="negative" onclick="$('.toggler').slideToggle();">Cancel</button>
						</div>
					</td>
				</tr>
			</table>
			<div class="buttons task-init  toggler">
				<button type="button" class="positive" onclick="$('.toggler').slideToggle();">Add New</button>&nbsp; &nbsp; 
				
			</div>
			
			<div class="existing-task-list">
				<br /><br />
				<h4>Existing Tasks</h4>
			</div>
			</div>
		</form>
		
		<form id="edit-job-task" onsubmit="return false;">
			<input type="hidden" name ="taskcompleted" value="0" id="taskcompleted" />
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
		<!-- edit task -->
			<table border="0" cellpadding="0" cellspacing="0" class="task-add task-edit">
				
				<tr>
					<td colspan="4">
						<strong>All fields are required!</strong>
					</td>
				</tr>
				
				<tr>
					<td valign="top" width="80">
						<br /><br />Task
					</td>
					<td colspan="3">
						<strong><span id="edit-task-desc-countdown">240</span></strong> characters left.<br />
						<textarea name="job_task" class="edit-job-task-desc width420px"></textarea>
					</td>
				</tr>
				<tr >
					<td style="padding-bottom:10px;" ><br/>Category</td>
					<td>
						<select name="task_category" data-placeholder="Choose category." class="chzn-select edit-task-category textfield" id="taskCategory" style="width:140px;">
							<option value=""></option>
							<?php
								foreach($category_listing_ls as $ua)
								{
									echo '<option value="'.$ua['id'].'">'.$ua['task_category'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr >
					<td style="padding-bottom:10px;">Priority</td>
					<td>
						<select name="task_priority" data-placeholder="Choose Priority." class="chzn-select edit-task-priority textfield" id="taskpriority" style="width:140px;">
							<option value=""></option>
							<option value="1">Critical</option>
							<option value="2">High</option>
							<option value="3">Medium</option>
							<option value="4">Low</option>
							
						</select>
					</td>
				</tr>
				
				<tr>
					<td >
						Allocate to
					</td>
					<td style="padding-top:5px;">
						<select name="task_user" data-placeholder="Choose a User..." class="chzn-select edit-task-allocate textfield" style="width:140px;">
							<?php
								foreach($final_restrict_user as $ua){
									if(!empty($user_details_id[$ua]['userid'])) {
							?>
									<option value="<?php echo $user_details_id[$ua]['userid']; ?>"><?php echo $user_details_id[$ua]['first_name'] . ' ' . $user_details_id[$ua]['last_name']; ?></option>
							<?php
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td style="padding-bottom:10px;">Status</td>
					<td>
						<select name="task_priority" data-placeholder="Choose Status." class="chzn-select edit-task-stages" id="taskstages" style="width:140px;">
							<option value=""></option>
							<?php
								foreach($task_stages as $tstag)
								{
									echo '<option value="'.$tstag['task_stage_id'].'">'.$tstag['task_stage_name'].'</option>';
								}
							?>
						</select>
						<input type="hidden" name="task_complete_status" id="edit_complete_status" class="edit-complete-status textfield width100px" />	
					</td>
				</tr>
				<tr>
					<td>Estimated Hours</td>
					<td><input type="text" name="estimated_hours" class="edit-job-est-hr textfield width100px" onkeypress="return isPaymentVal(event)" style="margin-top:5px;" maxlength="5"/></td>
				</tr>
				<tr>
					<td>
						Planned Start Date
					</td>
					<td>
						<input type="text" name="task_start_date" class="edit-start-date textfield pick-date width100px" style="margin: 5px 0px;"/>
					</td>
					<td>
						Planned End Date
					</td>
					<td>
						<input type="text" name="task_end_date" class="edit-end-date textfield pick-date width100px" />
					</td>
				</tr>
				
				<tr>
					<td>
						Actual Start Date
					</td>
					<td>
						<input type="text" name="edit-actualstart-date" class="edit-actualstart-date textfield pick-date width100px" />
					</td>
					<td>
						Actual End Date
					</td>
					<td>
						<input type="text" name="edit-actualend-date" class="edit-actualend-date textfield pick-date width100px" />
					</td>
				</tr>
				<tr>
					<td>Remarks</td>
					<td colspan="3"><textarea name="remarks" id="edit-task-remarks" class="edit-task-remarks" width="420px"></textarea></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="buttons" style="margin-top:7px;">
							<button type="submit" class="positive" onclick="editTask();">Update</button>
						</div>
						<div class="buttons">
							<button type="submit" class="negative" onclick="$.unblockUI();">Cancel</button>
						</div>
					</td>
				</tr>
			</table>
		<!-- edit task end -->
		</form>
		
	</div><!-- id: jv-tab-4 end -->

	<?php 
	if($show_gantt_chart==0 && $show_milestones==1)
	{ //if gantt chart data not exists and milestones data exists then show milestones  ?>
		<div id="jv-tab-4-5">
			<div id="milestone-top-view">
			<h3>Milestones</h3>
				<div style="color:red; margin:7px 0 0;" id="msErrNotifyFadeout"></div>
				<div id="milestone-add-view">
					<form id="milestone-management" onsubmit="return false;">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<table class="milestone-table ms-toggler" style="display:none;">
							<tr>
								<td>
									<?php $jobid = isset($quote_data['lead_id']) ? $quote_data['lead_id'] : 0; ?>
									<input type="hidden" name="jobid_fk" id="jobid_fk" value=<?php echo $jobid; ?> />
									<p>
										Milestone name *
										<input type="text" name="milestone_name" id="milestone_name" class="textfield" style="width:235px;" />
									</p>
								</td>
							</tr>
							<tr>
								<td>
									<p style="float: left;">
										Planned Start Date * 
										<input type="text" name="ms_plan_st_date" id="ms_plan_st_date" autocomplete="off" class="textfield width60px pick-date" readonly />
									</p>
									<p style="float: left; margin: 0px 10px;">
										Planned End Date *
										<input type="text" name="ms_plan_end_date" id="ms_plan_end_date" autocomplete="off" class="textfield width60px pick-date" readonly />
									</p>
								</td>
							</tr>
							<tr>
								<td>
									<p style="float: left;">
										Actual Start Date
										<input type="text" name="ms_act_st_date" id="ms_act_st_date" autocomplete="off" class="textfield width60px pick-date" readonly />
									</p>
									<p style="float: left; margin: 0px 10px;">
										Actual End Date
										<input type="text" name="ms_act_end_date" id="ms_act_end_date" autocomplete="off" class="textfield width60px pick-date" readonly />
									</p>
								</td>
							</tr>
							<tr>
								<td colspan=2>
									<p>
										Efforts * (Numbers)
										<input onkeypress="return isNumberKey(event)" type="text" name="ms_effort" id="ms_effort" class="textfield width60px" maxlength="5" />
									</p>
								</td>
							</tr>
							<tr>
								<td>
								<p style="float: left;">
									Percentage of Completion
									<select name="ms_percent" id="ms_percent" class="textfield width60px">
										<?php
											foreach($this->cfg['milestones_complete_status'] as $complete_key=>$complete_val) {
												?>
													<option value="<?php echo $complete_key; ?>"><?php echo $complete_val; ?></option>
												<?php
											}
										?>
									</select>
								</p>
								<p style="float: left; margin: 0px 15px;">
									Status
									<select name="milestone_status" class="textfield width100px">
										<?php
										foreach($this->cfg['milestones_status'] as $status_key=>$status_val) {
											?>
												<option value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
											<?php
										}
										?>
									</select>
								</p>
								</td>
							</tr>
							<tr>
								<td colspan=2>
									<p>
									<div class="buttons">
										<button type="submit" class="positive" onclick="addMilestoneTerms(); return false;">Add</button>
									</div>
									<div class="buttons">
										<button type="submit" onclick="$('.ms-toggler').slideToggle();">Cancel</button>
									</div>
									</p>
								</td>
							</tr>						
						</table>
					</form>
				</div>
				<?php if ($readonly_status == false) { ?>
				<div class="buttons task-init ms-toggler" id="addNew-ms">
					<button type="button" class="positive" onclick="$('.ms-toggler').slideToggle();" style="float:none;">Add New Milestone</button>
				</div>
				<?php } ?>
				<p></p>
				<div style="position: relative; z-index: 0;">
					<a id="milestone-email" class="export-btn" name="msE-mail" style="color:#fff !important;">E-Mail Milestone</a>
					<a id="milestone-export" class="export-btn" name="msExport" style="color:#fff !important;">Export Timeline</a>
				</div>
				<?php
				$output .= '<div class="milestone_view_det" id="milestone_view_det" style="display:block; margin-top:5px;">';
				if(!empty($milestone_data))
				{
					$output .= "<table width='100%' class='payment_tbl'><tr><td colspan='3'><h6>Milestone Terms</h6></td></tr></table>";
					$output .= "<table class='data-table' id='milestone-data' cellspacing = '0' cellpadding = '0' border = '0'>";
					$output .= "<thead>";
					$output .= "<tr align='left'>";
					$output .= "<th class='header'>Milestone Name</th>";
					$output .= "<th class='header'>Planned Start Date</th>";
					$output .= "<th class='header'>Planned End Date</th>";
					$output .= "<th class='header'>Actual Start Date</th>";
					$output .= "<th class='header'>Actual End Date</th>";
					$output .= "<th class='header'>Efforts</th>";
					$output .= "<th class='header'>Completion(%)</th>";
					$output .= "<th class='header'>Status</th>";
					$output .= "<th class='header'>Action</th>";
					$output .= "</tr>";
					$output .= "</thead>";
					foreach ($milestone_data as $ms_data)
					{
						switch($ms_data['milestone_status']){
							case 0:
							$ms_stat = 'Scheduled';
							break;
							case 1:
							$ms_stat = 'In Progress';
							break;
							case 2:
							$ms_stat = 'Completed';
							break;
						}
						$ms_act_st = ($ms_data['ms_act_st_date'] != '0000-00-00 00:00:00') ? date('d-m-Y', strtotime($ms_data['ms_act_st_date'])) : '';
						$ms_act_end = ($ms_data['ms_act_end_date'] != '0000-00-00 00:00:00') ? date('d-m-Y', strtotime($ms_data['ms_act_end_date'])) : '';
						$expected_date = date('d-m-Y', strtotime($pd['expected_date']));
						$output .= "<tr>";
						$output .= "<td align='left'>".$ms_data['milestone_name']."</td>";
						$output .= "<td align='left'>".date('d-m-Y', strtotime($ms_data['ms_plan_st_date']))."</td>";
						$output .= "<td align='left'>".date('d-m-Y', strtotime($ms_data['ms_plan_end_date']))."</td>";
						$output .= "<td align='left'>".$ms_act_st."</td>";
						$output .= "<td align='left'>".$ms_act_end."</td>";
						$output .= "<td align='left'>".$ms_data['ms_effort']."</td>";
						$output .= "<td align='left'>".$ms_data['ms_percent']."</td>";
						$output .= "<td align='left'>".$ms_stat."</td>";
						$output .= "<td align='left'>";
						if ($readonly_status == false) {
							$output .= "<a class='edit' title='Edit' onclick='milestoneEditTerm(".$ms_data['milestoneid']."); return false;' ><img src='assets/img/edit.png' alt='edit'></a>";
							$output .= "<a class='edit' title='Delete' onclick='milestoneDeleteTerm(".$ms_data['milestoneid'].");' ><img src='assets/img/trash.png' alt='delete'></a>";
						} else {
							$output .= "-";
						}
						$output .= "</td>";
						$output .= "</tr>";
					}
					$output .= "</table>";
				}
				$output .= '</div>';
				echo $output;
				?>
			</div> <!--end of milestone-top-view-->
		
			<!------------------------------------------------------------------->
		</div><!-- id: jv-tab-4-5 end -->
	<?php } ?>
	
	<div id="jv-tab-7">
		<form id="set-urls" style="overflow:hidden; margin-bottom:15px; zoom:1;">
		
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
			<p>Add URL to this job (full URL including http://)</p>
			<p><input type="text" class="textfield" id="job-add-url" style="margin:0; width:250px;" /></p>
			<p>Details (optional)</p>
			<p><textarea id="job-url-content" class="textfield" style="margin:0; width:250px;"></textarea></p>
			<div class="buttons">
				<button type="submit" class="positive" onclick="addURLtoJob(); return false;">Add</button>
			</div>
		</form>
		<ul id="job-url-list">
			<?php echo $job_urls_html ?>
		</ul>
	</div><!-- id: jv-tab-7 end -->
	
	<?php if($this->userdata['role_id'] != 8):?>
	<div id="jv-tab-5">
	<div id="load-customer">
		<form id="customer-detail-read-only" onsubmit="return false;">
		
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
		<table class="tabbed-cust-layout" cellpadding="0" cellspacing="0">
				<tr>
					<td width="120"><label>Company Name</label></td>
					<td>
						<b>
							<?php #echo $company_det['company'] ?>
							<input type="text" style="width:180px;" name="customer_company_name" id="customer_company_name" class="pull-left textfield width300px" value="<?php echo $quote_data['company'].' - '.$quote_data['first_name'].' '.$quote_data['last_name'] ?>" <?php if ($readonly_status == true) { ?> disabled <?php } ?> />
							<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $quote_data['custid_fk'] ?>" />
							<input type="hidden" name="customer_id_old" id="customer_id_old" value="<?php echo $quote_data['custid_fk'] ?>" />
							<input type="hidden" name="customer_company_name_old" id="customer_company_name_old" class="textfield width300px" value="<?php echo $quote_data['company'].' - '.$quote_data['first_name'].' '.$quote_data['last_name'] ?>" />
							<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
							<div class="buttons pull-left">
								<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setCustomer(); return false;">Set</button>
							</div>
							<div id="resmsg_customer" class='pull-left succ_err_msg' style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
							<?php } ?>
						</b>
					</td>
				</tr>
				<?php if($company_det['entity']!='3'){ ?>				
				
					<tr>
						<td><label>PAN Number</label></td>
						<td><b><?php echo $company_det['pan_number'] ?></b></td>
					</tr>
				<?php } ?>	
				<?php if($company_det['entity'] != 4){ ?>
					<tr>
						<td><label>Block</label></td>
						<td><b><?php echo $company_det['add1_block'] ?></b></td>
					</tr>
				<?php } ?>	
				<tr>
					<td><label>Street</label></td>
					<td><b><?php echo $company_det['add1_street_po'] ?></b></td>
				</tr>
				<tr>
					<td><label>Region</label></td>
					<td><b><?php echo $company_det['region_name'] ?></b></td>
				</tr>
				<tr>
					<td><label>Country</label></td>
					<td><b><?php echo $company_det['country_name'] ?></b></td>
				</tr>
				<?php if($company_det['entity'] != 2){ ?>
					<tr>
						<td><label>State</label></td>
						<td><b><?php echo $company_det['state_name'] ?></b></td>
					</tr>
					<tr>
						<td><label>City</label></td>
						<td><b><?php echo $company_det['location_name'] ?></b></td>
					</tr>
				<?php } ?>	
				<tr>
					<td><label>Post code</label></td>
					<td><b><?php echo $company_det['add1_postcode'] ?></b></td>
				</tr>
				<tr>
					<td><label>Phone</label></td>
					<td><b><?php echo $company_det['mobile_num'] ?></b></td>
				</tr>
				<tr>
					<td><label>Fax</label></td>
					<td><b><?php echo $company_det['fax'] ?></b></td>
				</tr>
					<tr>
					<td><label>Email</label></td>
					<td><b><?php echo $company_det['email_2'] ?></b></td>
				</tr>
				<tr>
					<td><label>WEB</label></td>
					<td><b><?php echo $company_det['www'] ?></b></td>
				</tr>	
               
				<?php if($company_det['entity'] == 3){ ?>
					<tr>
						<td><label>Federal tax</label></td>
						<td><b><?php echo $company_det['federal_tax'] ?></b></td>
					</tr>
				<?php } ?>	

				<?php if($company_det['entity'] == 1){ ?>
					<tr>
					<td><label>GST Type</label></td>
					<td><b> <?php if ($company_det['gst_type'] == '2' ) {
										echo 'CASUAL TAXABLE PERSON';
								  }	
								  if ($company_det['gst_type'] == '3' ){
									  echo "Composition Levy";
								  }	  
							       if ($company_det['gst_type'] == '4' ) {
									   echo "Government Department or PSU";
								   }
								   if ($company_det['gst_type'] == '5' ){
									 echo "Non Resident Taxable Person";
								   }	 
									if ($company_det['gst_type'] == '1' ){
									echo "Regular/TDS/ISD";
								    }	
							       if ($company_det['gst_type'] == '6' ) {
									   echo "UN Agency or Embassy";
								   } 
						     ?>	</b></td>
					</tr>	
					<tr>
						<td><label>GSTIN</label></td>
						<td><b><?php echo $company_det['gst_in'] ?></b></td>
					</tr>
				<?php } ?>			
				<tr>
					<td><label>Comments</label></td>
					<td>
						<?php
							$comments = "-";
							if(isset($company_det['comments']) && !empty($company_det['comments'])) {
								$comments = str_replace(array('\r\n', '\r', '\n'), '<br />', $quote_data['comments']);
							}
						?>
					<p><?php echo stripslashes(nl2br($comments, false)); ?>
					</td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" class="data-tbl dashboard-heads dataTable" style="width:100%">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Position</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Skype</th>
						<th>Contact Mapped to Project</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($contact_det) && count($contact_det)>0) { ?>
						<?php foreach($contact_det as $cont) { ?>
					<tr>
						<td><?php echo $cont['customer_name']; ?></td>
						<td><?php echo $cont['position_title']; ?></td>
						<td><?php echo $cont['phone_1']; ?></td>
						<td><?php echo $cont['email_1']; ?></td>
						<td><?php echo $cont['skype_name']; ?></td>
						<td><?php if($quote_data['custid_fk'] == $cont['custid']) echo '<img style="width:14px; height:14px" alt="lead" src="assets/img/tick.png">'; ?></td>
					</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</form>
	</div><!-- id: load-customer end -->
	</div><!-- id: jv-tab-5 end -->
	

<div id="jv-tab-5-5">
			<span style="float:right;" class="customer_history"> 
					<a href="#" onclick="fullScreenCustomerLogs(); return false;">View Full Screen</a>
					|
					<a href="#" onclick="$('.log > :not(.stickie), #pager').toggle(); return false;">View/Hide Stickies</a>
			</span>
			<h4>Customer History</h4>
			<div id="load-customer-log"></div>
		</div><!-- id: jv-tab-5-5 end -->
	
	
		<?php 
			$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
			$cur_year = date('Y');
			$end_year = date('Y', strtotime('-15 year'));
		?>
		<div id="jv-tab-8">
			<div class="wrap_timesheet">
					<?php if($quote_data['billing_type'] == 2) { ?>
						<div id="filter_metrics_data" align="right" style="margin:0 0 10px">
							<form name="filter_metrics" id="filter_metrics"  method="post">
								<label><strong>Month & Year</strong></label>
								<select name="metrics_month" id="metrics_month">
								<?php foreach ($months as $name) { ?>
									<option value="<?php echo $name; ?>" <?php if($name == date('M')) echo 'selected="selected"'; ?>><?php echo $name; ?></option>
								<?php } ?>
								</select>
								<select name="metrics_year" id="metrics_year">
								<?php for($yr=$cur_year; $yr>=$end_year; $yr--) { ?>
									<option value="<?php echo $yr; ?>"><?php echo $yr; ?></option>
								<?php } ?>
								</select>
								<input type="hidden" name="expect_worth_name" id="expect_worth_name" value="<?php echo $quote_data['expect_worth_name']; ?>" readonly="readonly" />
								<input id="metrics_data" class="positive" type="submit" value="Search"/>
								<span style="vertical-align: top;">
									<img src='<?php echo base_url().'assets/images/loading.gif'; ?>' id='load' style='display:none; width: 60px;' />
								</span>
							</form>
						</div>
					<?php } ?>
					<div class="inner_timesheet">
					<?php if(count($timesheet_data) >0 ) { ?>
					<table class="head_timesheet data-table">
						<tr>
							<th>Resource</th>
							<th>Month & Year</th>
							<th>Billable Hours</th>
							<th>Internal Hours</th>
							<th>Non-Billable Hours</th>
							<!--th>Cost Per Hour(<?php #echo $quote_data['expect_worth_name']; ?>)</th>
							<th>Cost(<?php #echo $quote_data['expect_worth_name']; ?>)</th-->
							<th>Cost Per Hour(USD)</th>
							<th>Cost(USD)</th>
						</tr>
					</table>
					<table class="data-table">
						<?php
						//echo '<pre>';print_r($timesheet_data);exit;
						
						$total_billable_hrs		= 0;
						$total_non_billable_hrs = 0;
						$total_internal_hrs		= 0;
						$total_cost				= 0;
						foreach($timesheet_data as $key1=>$value1) {
							$resource_name = $key1;
							$max_hours = $value1['max_hours'];
							foreach($value1 as $key2=>$value2) {
								$year = $key2;
								foreach($value2 as $key3=>$value3) {
									$individual_billable_hrs		= 0;
									$month		 	  = $key3;
									$billable_hrs	  = 0;
									$non_billable_hrs = 0;
									$internal_hrs	  = 0;
									foreach($value3 as $key4=>$value4) {
										switch($key4) {
											case 'Billable':
												$rs_name			 = $value4['rs_name'];
												$rate				 = $value4['rateperhr'];
												$billable_hrs		 = $value4['duration'];
												$individual_billable_hrs += $billable_hrs;
												$total_billable_hrs += $billable_hrs;
											break;
											case 'Non-Billable':
												$rs_name				 = $value4['rs_name'];
												$rate					 = $value4['rateperhr'];
												$non_billable_hrs		 = $value4['duration'];
												$individual_billable_hrs += $non_billable_hrs;
												$total_non_billable_hrs += $non_billable_hrs;
											break;
											case 'Internal':
												$rs_name			 = $value4['rs_name'];
												$rate				 = $value4['rateperhr'];
												$internal_hrs 		 = $value4['duration'];
												$individual_billable_hrs += $internal_hrs;
												$total_internal_hrs += $internal_hrs;
											break;
										}
									}
								
									$individual_billable_hrs = $value3['total_hours'];
									 
									// calculation for the utilization cost based on the master hours entered.
									$rate1 = $rate;
									if($individual_billable_hrs>$max_hours){
										$percentage = ($max_hours/$individual_billable_hrs);
										$rate1 = number_format(($percentage*$rate),2);
									}
									echo "<tr>
										<td>".$rs_name."</td>
										<td>".substr($month, 0, 3). " " . $year."</td>
										<td align=right>".sprintf('%0.2f', $billable_hrs)."</td>
										<td align=right>".sprintf('%0.2f', $internal_hrs)."</td>
										<td align=right>".sprintf('%0.2f', $non_billable_hrs)."</td>
										<td align=right>".$rate1."</td>
										<td align=right>".sprintf('%0.2f', $rate1*($billable_hrs+$internal_hrs+$non_billable_hrs))."</td>
									</tr>";
									
									$total_cost += $rate1 * ($billable_hrs + $internal_hrs + $non_billable_hrs);
								}
							}
						}
						
						echo "<tr>
							<td align=right><b>Total</b></td>
							<td></td>
							<td align=right><b>".sprintf('%0.2f', $total_billable_hrs)."</b></td>
							<td align=right><b>".sprintf('%0.2f', $total_internal_hrs)."</b></td>
							<td align=right><b>".sprintf('%0.2f', $total_non_billable_hrs)."</b></td>
							<td></td>
							<td align=right><b>".sprintf('%0.2f', $total_cost)."</b></td>
						</tr>";
						?>
					</table>
				<?php 
					} else {
						if($quote_data['billing_type'] == 2) {
							echo '<div align="center" style="margin: 20px 0 0;"><b> No data available for Current Month</b></div>';
						} else {
							echo '<div align="center" style="margin: 20px 0 0;"><b> Unable to extract project hours from timesheet system </b></div>';
						}
					}
				?>
				</div>
			</div>
		</div><!-- id: jv-tab-8 end -->
	

<!-- Defects Summary Start -->
	<div id="jv-tab-8-6">
		<?php
		$redmine_url = "http://redmine.enoahprojects.com:3000/projects/".$quote_data['pjt_id'];
		$checkValue = true;
			if(count($bug_project)>0 && !empty($bug_project)):?>
			<div class="buttons task-init  toggler">
				<div style="float:left;padding:5px;">

				<!--form target="_blank" method="post" name="form_set_project" action="http://support.mail.com/set_project.php"><input type="hidden" name="project_id" value="<?php //echo $AllPjtIds_summary;?>" /> <input type="hidden" name="ref" value="summary_page.php" /><button style="float:none;"  class="positive" type="submit">View Summary in Mantis</button></form-->

				<a style="background: #4b6fb9 none repeat scroll 0 0;border: 1px solid #274686;font-size: 11px;font-weight: normal;padding: 2px 6px;line-height: 17px; padding: 2px 6px" href="<?php echo $redmine_url?>" class="positive" target="_blank">View Summary in Redmine</a>
				</div>
				<div class="clear"></div>
			</div>
			<div style="margin-bottom:10px;" class="pull-left">
			<?php

			$checkValue = false;
			$bp_arr = array();
			$tot = array();
			foreach($bug_project as $bp):
				$bp_arr['values'][$bp->project_id][$bp->status_id] = $bp->bugcount;
			endforeach;
			ksort($bp_arr['values']);
			
			//$statusArray = array(10 => "New", 20 => "Feedback",30 => "Acknowledged",40 => "Confirmed",50 => "Assigned",80 => "Resolved",5 => "Closed");
			$statusArray = array(1 => "New", 2 => "In Progress",3 => "Resolved",4 => "Feedback",5 => "Closed",6 => "Rejected",7 => "Assigned",8 => "Reopened");
			?>
			<table width="<?php echo count($project_names)*150;?>" cellspacing="0" cellpadding="0" class="data-table1" id="project-date-assign">
				<tbody>
				<tr>
					<th>Status</th>
					<?php foreach($project_names as $pnames):	echo '<th style="width:400px;">'.$pnames.'</th>';endforeach;	?>
				</tr>

						<tr><td><strong>Open</strong></td><?php foreach($project_names as $key2 => $pnames): ?>
							<?php $bgstatus_open = $bp_arr['values'][$key2][1]+$bp_arr['values'][$key2][2]+$bp_arr['values'][$key2][4]+$bp_arr['values'][$key2][7]+$bp_arr['values'][$key2][8];
							echo '<td><a href="'.$redmine_url.'/issues?set_filter=1" target="_blank">'.$bgstatus_open.'</a></td>';
							$tot[$key2][7] = $bgstatus_open;
							endforeach;?></tr>

				<?php foreach($statusArray as $key => $sname):
						if($key == 3 || $key == 5){?>
							<tr><td><strong><?php echo $sname;?></strong></td><?php foreach($project_names as $key2 => $pnames): $showValue = (isset($bp_arr['values'][$key2][$key])?$bp_arr['values'][$key2][$key]:0);
							echo '<td><a href="'.$redmine_url.'/issues?issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]==&v[status_id][]='.$key.'" target="_blank">'.$showValue.'</a></td>'; $tot[$key2][$key] = $showValue; endforeach;?></tr>
						<?php }	endforeach; ?>
					<tr><td><strong>Total</strong></td>
						<?php
						foreach($tot as $t): echo '<td><a href="'.$redmine_url.'/issues?issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]=*" target="_blank"><strong>'.array_sum($t).'</strong></a></td>'; endforeach;?>
					</tr>
			</tbody>
			</table>
		</div>
	<?php endif;  ?>

	<?php
		if(count($bug_severity)>0 && !empty($bug_severity)) :
		$checkValue = false;
		$bs_arr = array();
		$opened_arr = array();
		$resolved_arr = array();
		$closed_arr = array();

		foreach($bug_severity as $bs):
			$bs_arr['values'][$bs->project_id][$bs->priority_id][$bs->status_id] = $bs->bugcount;
		endforeach;
		ksort($bs_arr['values']);
		//$severityArray = array(10 => "Feature",20 => "Trivial",30 => "Text",40 => "Tweak",50 => "Minor",60 => "Major",70 => "Crash",80 => "Block");

		//$severityArray = array(1 => "Low",2 => "Moderate",3 => "High",4 => "Urgent",5 => "Critical");	?>

		<div style="margin-bottom:10px;" class="pull-left">
			<table width="<?php echo count($project_names)*150;?>" cellspacing="0" cellpadding="0" class="data-table1 table-style" id="project-date-assign">
			<tbody>
			<tr>
			<th>Priority</th>
			<?php foreach($project_names as $pnames):	echo '<th style="width:400px; text-align:center;">'.$pnames.'<table  width="180"><tr><th style="border-width:1px;" width="33%">Open</th><th style="border-width:1px;" width="33%">Resolved</th><th style="border-width:1px;" width="34%">Closed</th></tr></table></th>';endforeach;	?>
			<th>Total</th>
			</tr>
			<?php
				$mast_tot = 0;
				foreach($all_severity as $key => $sname):
					$tot_sev = 0;?>
					<tr>
					<td><strong><?php echo $sname;?></strong></td>
					<?php foreach($project_names as $key2 => $pnames):
							$opened = $bs_arr['values'][$key2][$key][1]+$bs_arr['values'][$key2][$key][2]+$bs_arr['values'][$key2][$key][4]+$bs_arr['values'][$key2][$key][7]+$bs_arr['values'][$key2][$key][8];

							$opened = isset($opened)?$opened:0;
							$resolved = (isset($bs_arr['values'][$key2][$key][3])?$bs_arr['values'][$key2][$key][3]:0);
							$closed = (isset($bs_arr['values'][$key2][$key][5])?$bs_arr['values'][$key2][$key][5]:0);

							$tot_sev += $opened+$resolved+$closed;
							$mast_tot += $opened+$resolved+$closed;

							$tot1[$key2][$key]['opened'] = $opened;
							$tot1[$key2][$key]['resolved'] = $resolved;
							$tot1[$key2][$key]['closed'] = $closed; ?>
							<td>
								<table class="sub-table" width="180">
								<tr>
									<td width="33%"><?php echo '<a href="'.$redmine_url.'/issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]=o&f[]=priority_id&op[priority_id]==&v[priority_id][]='.$key.'" target="_blank">'.$opened.'</a>'; ?></td>
									<td width="33%"><?php echo '<a href="'.$redmine_url.'/issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]==&v[status_id][]=3&f[]=priority_id&op[priority_id]==&v[priority_id][]='.$key.'" target="_blank">'.$resolved.'</a>'; ?></td>
									<td width="34%"><?php echo '<a href="'.$redmine_url.'/issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]==&v[status_id][]=5&f[]=priority_id&op[priority_id]==&v[priority_id][]='.$key.'" target="_blank">'.$closed.'</a>'; ?></td>
								</tr>
								</table>
							</td>
					<?php endforeach;?>
					<td><strong><?php echo '<a href="'.$redmine_url.'/issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]==&v[status_id][]=1&v[status_id][]=3&v[status_id][]=5&f[]=priority_id&op[priority_id]==&v[priority_id][]='.$key.'" target="_blank">'.$tot_sev.'</a>';?></strong></td>
					</tr>
					<?php endforeach;
					foreach($tot1 as $k => $t):
						foreach($t as $s):
							$opened_arr[$k][] = $s['opened'];
							$resolved_arr[$k][] = $s['resolved'];
							$closed_arr[$k][] = $s['closed'];
						endforeach;
						endforeach;?>
						<tr><td><strong>Total</strong></td>
						<?php foreach($project_names as $pid => $pnames):
							echo '<td style="width:400px;">
												<table width="180" class="sub-table" >
														<tr>
																<td width="33%"><strong><a href="'.$redmine_url.'/issues?set_filter=1" target="_blank">'.array_sum($opened_arr[$pid]).'</a></strong></td>
																<td width="33%"><strong><a href="'.$redmine_url.'/issues?issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]==&v[status_id][]=3" target="_blank">'.array_sum($resolved_arr[$pid]).'</a></strong></td>
																<td width="34%"><strong><a href="'.$redmine_url.'/issues?issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]==&v[status_id][]=5" target="_blank">'.array_sum($closed_arr[$pid]).'</a></strong></td>
														</tr>
												</table>
										</td>';endforeach;	?>
						<td><strong><?php echo '<a href="'.$redmine_url.'/issues?issues?utf8=???&set_filter=1&f[]=status_id&op[status_id]=*" target="_blank"><strong>'.$mast_tot.'</strong></a>' ?></strong></td>
					</tr>
			</tbody>
			</table>
		</div>
	<?php endif;

	if(count($AllPjtIds)>0 && !empty($AllPjtIds)):
	$cat_arr = array();
	$cat_status_arr = array();
	if(count($bug_category)>0 && !empty($bug_category)) :
		$checkValue = false;
		foreach($bug_category as $val):
			$cat_arr[$val['category_id'].'##'.$val['category_name']][$val['status_id']] = $val['bugcount'];
			$cat_status_arr[] = $val['status_id'];
		endforeach;
		$catstatusUnique = array_unique($cat_status_arr);
		sort($catstatusUnique);

		?>
		<div class="pull-left">
		<table width="395" cellspacing="0" cellpadding="0" class="data-table1" id="project-efforts">
				<tbody>
				<tr>
					<th>Category</th>
					<th>Open</th>
					<th>Resolved</th>
					<th>Closed</th>
					<th>Total</th>
				</tr>
				<?php
				if(count($cat_arr)>0 && !empty($cat_arr)):
					foreach($cat_arr as $key => $res):
						$total = 0;
						$opened = 0;
						$resolved = 0;
						$closed = 0;
							if(count($catstatusUnique)>0 && !empty($catstatusUnique)):
								foreach($catstatusUnique as $c):
								$total += $res[$c];
								if($c==3) $resolved = $res[$c];
								if($c==5) $closed = $res[$c];
							endforeach;
							$opened = $total - ($resolved+$closed);
							$ex = explode("#",$key);
							echo show_detail_html($ex[2],$opened,$resolved,$closed,$total);
						endif;
					endforeach;
				endif;	?>
				</tbody>
			</table>
		</div>
	<?php endif; endif;  ?>

	<?php if($checkValue): echo '<div align="center"><b> Please assign the project code in redmine and check!</b></div>'; endif;?>
	</div>
	<!-- Defects Summary End -->
        
<!-- Audit Compliance Start -->   
<div id="jv-tab-8-5">
    <div style="margin:5px 0;">
		<?php if($can_add_compliance == 1 && $canCreate == 1){ ?>
        <form action="compliance/add" method="post" target="_blank" id="compliance_form">
            <table class="qualityMetricsTable">
                <tbody>
                    <tr>
                        <td width="220"><div>Module<span class="required"> *</span></div>
                            <select name="module_id" id="module_id" class="textfield width200px mandatory chzn-select" onchange="getTrackerList(this);">
                                <option value="">Select Module</option>
                                <?php foreach($moduleList as $module): ?>
                                    <option value="<?php echo $module['module_id']; ?>"><?php echo $module['module_name']; ?></option>
                                <?php endforeach;?>
                            </select>
                            <p id="module_id_error" class="error_class" style="color: red;clear:both"></p>
                        </td>
                        <td width="220"><div>Tracker<span class="required"> *</span></div>
                            <select name="tracker_id" id="tracker_id" class="textfield width200px mandatory chzn-select" onchange="trackerChange(this);">
                                <option value="">Select Tracker</option>
                            </select>
                            <p id="tracker_id_error" class="error_class" style="color: red;clear:both"></p>
                        </td>
                        <td>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <input type="hidden" id="project_id" name="project_id" value="<?php echo $this->uri->segment('3'); ?>"/>
                            <input type="hidden" name="from_quality_metrics" value="1"/>
                            <input type="hidden" id="module_name" name="module_name"/>
                            <input type="hidden" id="tracker_name" name="tracker_name"/>
                            <input type="hidden" id="project_name" name="project_name"  value="<?php echo isset($quote_data['lead_title']) ? $quote_data['lead_title'] : ''; ?>"/>
                            <input type="hidden" id="default_status" name="default_status"/>
                            <button onclick="triggerCreateTicketBtn();" type="button" class="positive" style="padding:6px;margin-top: 11px;">Create Ticket</button>
                            <button id="create_ticket_btn" type="submit" class="positive" style="display: none;"></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
		<?php } ?>
        <form id="load_compliance_list_form" action="compliance/compliance_list" method="post" target="_blank">
            <input type="hidden" name="project_id" value="<?php echo $this->uri->segment('3'); ?>" />
            <input type="hidden" name="module_id" id="module_id" value="" />
            <input type="hidden" name="status_id" id="status_id" value="" />
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <button type="submit" id="load_compliance_list_btn" style="display:none;">Submit</button>
        </form>
    </div>
    <div class="module_div">
        <?php foreach ($statusCountList as $moduleId => $resultData): ?>
            <table cellspacing="0" cellpadding="0" class="data-table1" id="project-date-assign">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th><?php echo $resultData['module_name']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statusList as $status): ?>
						<?php if(isset($resultData[$status['status_id']])) {?>
                        <tr>
                            <td><strong><?php echo $status['status_name']; ?></strong></td>
                            <td><?php echo isset($resultData[$status['status_id']]) ? '<a href="javascript:void(0);" onclick="loadComplianceList('.$moduleId.','.$status['status_id'].')" style="color: blue;text-decoration: underline;">'.$resultData[$status['status_id']].'</a>' : 0; ?></td>
                        </tr>
						<?php } ?>
                    <?php endforeach; ?> 
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><?php echo $resultData['module_status_count']; ?></td>
                        </tr>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>

	
</div>
<br>
<!-- Audit Compliance End -->

<!-- Quality Metrics -->
<div id="jv-tab-8-7">
  <div id="quality_metrics_new"></div>
</div>
<!-- Quality Metrics End -->
		<div id="jv-tab-10">
			<form id="comm-log-form">
			
				<div class="email-list">
					<label>Email To:</label>
					<select data-placeholder="Choose User..." name="user_mail" multiple='multiple' id="user_mail" class="chzn-select" style="width:420px;">
						<?php
						foreach($final_restrict_user as $ua) {
						?>
						<option value="<?php echo 'email-log-'.$user_details_id[$ua]['userid']; ?>"><?php echo $user_details_id[$ua]['first_name'] . ' ' . $user_details_id[$ua]['last_name']; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				
				<?php
				if (isset($userdata)) {
				?>
					<div class="email-set-options" style="overflow:hidden;">

						<label for="email_to_customer" class="normal">Email Client:</label> <input type="checkbox" name="email_to_customer" id="email_to_customer" />
						<input type="hidden" name="client_email_address" id="client_email_address" value="<?php echo (isset($quote_data)) ? $quote_data['email_1'] : '' ?>" />
						<input type="hidden" name="client_full_name" id="client_full_name" value="<?php echo (isset($quote_data)) ? $quote_data['customer_name'] : '' ?>" />
						<input type="hidden" name="requesting_client_approval" id="requesting_client_approval" value="0" />

						<p id="multiple-client-emails">
							<label></label>
							<input type="checkbox" name="client_emails_1" id="client_emails_1" value="<?php echo $quote_data['email_1'] ?>" /> <?php echo $quote_data['email_1'] ?>
							<?php
							if ($quote_data['email_2'] != '')
							{
							?>
								<br /><input type="checkbox" name="client_emails_2" id="client_emails_2" value="<?php echo $quote_data['email_2'] ?>" /> <?php echo $quote_data['email_2'] ?>
							<?php
							}
							if ($quote_data['email_3'] != '')
							{
							?>
								<br /><input type="checkbox" name="client_emails_3" id="client_emails_3" value="<?php echo $quote_data['email_3'] ?>" /> <?php echo $quote_data['email_3'] ?>
							<?php
							}
							if ($quote_data['email_4'] != '')
							{
							?>
								<br /><input type="checkbox" name="client_emails_4" id="client_emails_4" value="<?php echo $quote_data['email_4'] ?>" /> <?php echo $quote_data['email_4'] ?>
							<?php
							}
							?>
							<br />
							<label></label>
							Additional Emails (separate addresses with a comma)<br />
							<label></label>
							<input type="text" name="additional_client_emails" id="additional_client_emails" style="width: 410px;" class="textfield" />
						</p>

					</div>
				<?php
				}
				?>

				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				
				<label class="normal">Templates:</label>
			    <select id="email_templates" name="email_templates" onchange="getTemplate(this.value)" class="textfield width150px">
							<option value="0">Select Template</option>
							<?php
							if(count($email_templates>0)) {
								foreach ($email_templates as $email_template) { ?>
									<option value="<?php echo $email_template['temp_id'] ?>"><?php echo $email_template['temp_name']; ?></option>
								<?php } ?>
							<?php } ?>
				</select>
				<br>
				<label class="normal">Message:</label>
				<textarea name="job_log" id="job_log" class="textfield crm_editor1" style="width:410px;"></textarea>
			    <br>
		
			<label class="normal">Signatures:</label>
			<select id="email_signatures" name="email_signatures" onchange="getSignature(this.value)" class="textfield width150px required">
							<option value="0">Select Signature</option>
							<?php
							if(count($email_signatures>0)) {
								foreach ($email_signatures as $email_signature) { ?>
									<option value="<?php echo $email_signature['sign_id'] ?>"><?php echo $email_signature['sign_name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select><span><a href="#comm-log-form" onclick="whatIsSignature(); return false;">What is this?</a></span>
						<br>		
				
				
				
				<label>Signature:</label>
				<textarea name="signature" class="textfield crm_editor1"><?php if(!empty($default_signature)) echo $default_signature['sign_content'];?></textarea>
				<div style="overflow:hidden;">					
					<!--p class="right" style="padding-top:5px;">Mark as a <a href="#was" onclick="whatAreStickies(); return false;">stickie</a> <input type="checkbox" name="log_stickie" id="log_stickie" /></p-->
					<div class="button-container">
						<div class="buttons">
							<button type="submit" class="positive" onclick="addLog();  return false;" id="add-log-submit-button">Add Post</button>
						</div>
					</div>				
				</div>
			</form>
		</div><!-- id: jv-tab-10 end -->
	
	
		<div id="jv-tab-9">
			<span style="float:right;" class="job_history"> 
					<a href="#" onclick="fullScreenLogs(); return false;">View Full Screen</a>
					|
					<a href="#" onclick="$('.log > :not(.stickie), #pager').toggle(); return false;">View/Hide Stickies</a>
			</span>
			<h4>Job History</h4>
			<div id="load-log"></div>
		</div><!-- id: jv-tab-9 end -->
		
		<div id="jv-tab-11">
			<h4 class="form_patb10">Gantt chart</h4>
			
			
			
			<!-------------------FILE IMPORT FOR GANTT CHART--------------------->
				
			<form action="" method="post" id="upload-form" novalidate="novalidate" enctype="multipart/form-data">
				<div class="form_containerArea">
					<div class="form_leftArea file-upload">
						 <input type="file" name="xmlfile" id="xmlfile" /> 
						 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						  <input type="hidden" name="project_id" id="project_id" value="<?php echo $this->uri->segment('3'); ?>" />
					</div>
					<div class="form_rightArea">			
						<input type="submit" value="upload" name="submit"/>
					</div>
					<div id="upload_loading" style="display:none">
						<img src = '<?php echo base_url().'assets/images/loader.gif'; ?>' width="54" />
					</div>
				 </div>
				<div id="success_msg" class="m-b-10"></div>
			</form> 
			<div class="file-upload-hint m-b-10">
				Task Name,Duration,Work,Start,Finish,Resource Names,% Complete are the required fields.
			</div>
		
			<?php 
			if($show_gantt_chart==1)
			{ //if data exists then show gantt chart
				$this->load->view('projects/gantt_chart');
			}
			?>
			
		</div><!-- id: jv-tab-11 end -->
	
	<?php endif;?>
  </div>
<?php } ?>
</div>
</div><!--end of project-tabs-->
</div>
<div class="comments-log-container"></div>
<div class="modal fade" id="mymodal_invoice" style="float:left;"><br/>	
				  <div class="modal-dialog modal-xl">
					<div class="modal-content" style="width:720px">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5 class="modal-title1"></h5>
					</div>
				     <div class="modal-body" style="overflow-y: scroll;height: 450px;">
					 <div style="color:red; margin:7px 0 0;" id="rec_paymentfadeout"></div>
					  <div class="milestone_invoice" id="milestone_invoice" ><br/>
						
						</div>
					</div>
				  </div>
				</div>
</div>				
<style>
.hide-calendar .ui-datepicker-calendar { display: none; }
button.ui-datepicker-current { display: none; }
.file-upload label.error{display: block; width: auto;}
.m-b-10{margin-bottom:10px;font-weight: bold;}
.blockUI.blockMsg.blockPage.no-scroll {
    z-index: 9999!important;
}
.modal-header .close {
    margin-top: -18px;
    font-size: 25px;
    color: white!important;
    margin-right: -23px;
    opacity: 1;
    background: #8d8d8d;
    width: 27px;
    height: 27px;
    border-radius: 50%;
    font-weight: 100;
}
.modal-header{
	text-align: center;
    color: #fff;
    background: #4b6fc9;
}
h5.modal-title{
font-weight:bold;

}
.blockUI.blockOverlay {
    z-index: 9999!important;	
}
.blockMsg{
	top: 710.5px;
}
.width201px{
	width:211px!important;
}

div#invoice_table_filter label {
    width: auto !important;
}
.data-table{
	float:left;
}
</style>
<script type="text/javascript" src="assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="assets/js/jq.livequery.min.js"></script>
<script type="text/javascript" src="assets/js/crm.js?q=13"></script>
<script type="text/javascript" src="assets/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="assets/js/tasks.js?q=34"></script>
<script type="text/javascript">var this_is_home = true;</script>
<script type="text/javascript" src="assets/js/chosen.jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery.screwdefaultbuttonsV2.js"></script>


<!--Code Added for the Pagination in Comments Section -- Starts Here-->
<script type="text/javascript">


  var project_jobid           = "<?php echo isset($quote_data['lead_id']) ? $quote_data['lead_id'] : 0 ?>";
  var project_code            = "<?php echo isset($quote_data['pjt_id']) ? $quote_data['pjt_id'] : 0 ?>";
  var expect_worth_id         = "<?php echo isset($quote_data['expect_worth_id']) ? $quote_data['expect_worth_id'] : 1 ?>";
  var project_view_quotation  = "<?php echo $view_quotation; ?>";
  var project_user_id         = "<?php echo isset($userdata['userid']) ? $userdata['userid'] : 0 ?>";
  var project_job_title		  = "<?php echo str_replace("'", "\'", $quote_data['lead_title']) ?>";
  var project_job_status      = "<?php echo (isset($quote_data['lead_stage'])) ? $quote_data['lead_stage'] : 0 ?>";
  var project_request_url     = "http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>";
  var project_assigned_to     = "<?php echo $quote_data['assigned_to']; ?>";
  var project_userdata    	  = "<?php echo $userdata; ?>";
  var project_complete_status = "<?php echo isset($quote_data['complete_status']) ? $quote_data['complete_status'] : 0 ?>";
  var proj_location			  = 'http://<?php echo $_SERVER['HTTP_HOST'], preg_replace('/[0-9]+/', '{{lead_id}}', $_SERVER['REQUEST_URI']) ?>';
  var rag_stat_id			  = "<?php echo $quote_data['rag_status']; ?>";
  var user_role_id			  = "<?php echo $userdata['role_id']; ?>";
  
$(document).ready(function(){

	$('body').on('click','.js_recursive',function(){
		if($(this).prop("checked")){
			$(this).parent().next().next().children('.js_view_access').prop("checked",true);
		}else{
			$(this).parent().next().next().children('.js_view_access').prop("checked",false);
		}
	})
	
});  
  
$(function(){
	

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
});

// Loading the Compliacne list
function loadComplianceList(moduleId,statusId) {
    $("#load_compliance_list_form #module_id").val(moduleId);
    $("#load_compliance_list_form #status_id").val(statusId);
    $("#load_compliance_list_btn").click();
}

</script>
<script type="text/javascript" src="assets/js/request/request.js?v=v1"></script>
<script type="text/javascript" src="assets/js/projects/welcome_view_project.js?v=1<?php echo CLR_CACHE; ?>"></script>
<script type="text/javascript" src="assets/js/tinymce4.5.1/tinymce.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script>

 tinymce.init({
    selector: '.crm_editor1',
	plugins: "code,preview",
    height : "250"
  
  });

  


<!-------------------LOAD VALUES FOR METER----------------------->
/* var progress_data = (function () {
	var project_id=jQuery("#project_id").val();
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': site_base_url+"projects/gantt_chart/getProgress_status?project_id="+project_id,
        'dataType': "json",
        'success': function (data) {
            json = data.response;
        }
    });
    return json;
})();

updateVisualStatus(progress_data);
 */

jQuery("#service_item").click(function(){
	$.blockUI({
		message:`<div class="file-tabs-close-confirm-tab" onclick="close()"></div><br /><h5>Please select appropriate Invoice Type</h5><div class="modal-confirmation overflow-hidden" style="padding:10px 0 10px 55px"><div class="buttons"><button type="submit" class="positive" onclick="paymentProfileAdd('service'); return false;">Service based invoice</button></div><div class="buttons"><button type="submit" class="positive" style="margin-left: 6px;" onclick="paymentProfileAdd('item'); return false;">Item based invoice</button></div></div>`,
		css: {zIndex:'999999999'},onBlock: function() { 
			$(".file-tabs-close-confirm-tab").click(function() {
			$.unblockUI();
			})
            }
	  });
});
function goBackInvoiceList() {
  $('.payment-terms-mini-view1').show();
  loadPayment();
  $('.payment-recieved-view').hide();
}
function customerApprovalMsg(){			
		alertMessageShows('The customer is waiting for approval from finance team!');
	}
function alertMessageShows(val){
	$.blockUI({
		message:'<br /><p>'+val+'</p><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;" >Close</button></div></div>',
		css : { 'zIndex': '99999', top : '40%'}
	});
}
$(document).ready(function(){
  var gantHiet = $(".gantt_task").height();
  var getmHiet = $(".gantt_grid").height();
  $(".gantt_task").css("height",gantHiet+20);
  $(".gantt_grid").css("height",gantHiet+20);
  var entity = $("#entity").val();
  var expect_worth_id         = "<?php echo $quote_data['expect_worth_id'] ?>";
  var updt = "";
  var sturl = site_base_url+"regionsettings/getCurrency_lead_move_project/"+ entity+"/"+expect_worth_id+"/"+updt;
	$('#currency_row_project').load(sturl);
});

</script>

<?php // loaded files/folders manually when logged in user is developer
if($this->userdata['role_id'] == 8): ?>
<script>
loadExistingFiles($('#filefolder_id').val());
showBreadCrumbs($('#filefolder_id').val());
// $('#files_actions').hide();
</script>

<?php endif; ?>

<?php require (theme_url().'/tpl/footer.php'); ?>
