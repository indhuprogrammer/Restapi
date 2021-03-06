<?php require (theme_url().'/tpl/header.php'); ?>
<?php
$this->load->helper('custom');
if (get_default_currency()) {
	$default_currency = get_default_currency();
	$default_cur_id   = $default_currency['expect_worth_id'];
	$default_cur_name = $default_currency['expect_worth_name'];
} else {
	$default_cur_id   = '1';
	$default_cur_name = 'USD';
}

?>
<div id="content">
	<div class="inner">
		<?php if($this->session->userdata('accesspage')==1) { ?>
		
		<div class="page-title-head">
		
			<h2 class="pull-left borderBtm"><?php echo $page_heading ?></h2>
			
			<a class="choice-box" onclick="advanced_filter_pjt();">
				<span>Advanced Filters</span><img src="assets/img/advanced_filter.png" class="icon leads" />
			</a>
			
			<div class="search-dropdown">
				<a class="saved-search-head">
					<p>Saved Search</p>
				</a>
				<div class="saved-search-criteria" style="display: none; ">
					<img class="dpwn-arw" src="assets/img/drop-down-arrow.png" title="" alt="" />
					<ul class="search-root">
					<li class="save-search-heading"><span>Search Name</span><span>Set Default</span><span>Action</span></li>
					<?php 
					if(sizeof($saved_search)>0) {
						foreach($saved_search as $searc) { 
					?>
							<li class="saved-search-res" id="item_<?php echo $searc['search_id']; ?>">
								<span><a href="javascript:void(0)" onclick="show_search_results('<?php echo $searc['search_id'] ?>')"><?php echo $searc['search_name'] ?></a></span>
								<span class='rd-set-default'><input type="radio" value="<?php echo $searc['search_id'] ?>" <?php if ($searc['is_default']==1) { echo "checked"; } ?> name="set_default_search" class="set_default_search" /></span>
								<span><a title="Delete" href="javascript:void(0)" onclick="delete_save_search('<?php echo $searc['search_id'] ?>')"><img alt="delete" src="assets/img/trash.png"></a></span>
							</li>
					<?php 
						}
					} else {
					?>
						<li id="no_record" style="text-align: center; margin: 5px;">No Save & search found</li>
					<?php
					}
					?>
					</ul>
				</div>
			</div>

			<div class="section-right">
				<div class="form-cont search-table">
					<form id="pjt_search_form" name="pjt_search_form" method="post">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<input type="text" name="keyword" id="keywordpjt" value="<?php if (isset($_POST['keyword'])) echo $_POST['keyword']; else echo 'Project Title, Name or Company' ?>" class="textfield width210px pjt-search" />
						<button type="submit" id="project_search" class="positive">Project Search</button>			
					</form>
				</div>
			</div>

		</div>
		
			<div id="advance_search_pjt" style="float:left; width:100%;" >
		
				<form name="advanceFilters_pjt" id="advanceFilters_pjt"  method="post">
				
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				
					<table border="0" cellpadding="0" cellspacing="0" class="data-table">
					<thead>
						<tr>
							<th>By Project Status Wise</th>
							<!--th>By Project Manager Wise</th-->
							<th>By Entity</th>
							<th>By Business Unit</th>
							<th>By Department</th>
							<th>By Practices</th>
							<th>By Date(Planned)</th>
						</tr>	
					</thead>
					<tbody>
					<tr>	
						<td>
							<select style="width:125px;" multiple="multiple" id="pjt_stage" name="pjt_stage[]">
								<option value="1">Project In Progress</option>
								<option value="2">Project Completed</option>
								<option value="3">Project Onhold</option>
								<option value="4">Inactive</option>
							</select>
						</td>
						<td>
							<select multiple="multiple" id="divisions" name="divisions[]" class="advfilter" style="width:164px;">
								<?php if(!empty($sales_divisions) && count($sales_divisions)>0) { ?>
									<?php foreach ($sales_divisions as $division) { ?>
										<option value="<?php echo $division['div_id'] ?>"><?php echo $division['division_name']; ?></option>
									<?php } ?>
								<?php } ?>
							</select> 
						</td>
						<!--td>
							<select style="width:150px;" multiple="multiple" id="pm_acc" name="pm_acc[]">
								<?php foreach($pm_accounts as $pm_acc) {?>
								<option value="<?php echo $pm_acc['userid']; ?>">
								<?php echo $pm_acc['first_name'].' '.$pm_acc['last_name']?></option>	
								<?php } ?>
							</select> 
						</td-->
						
						<td>
							<select style="width:168px;" multiple="multiple" id="business_unit_id" name="business_unit_id[]">
								<?php foreach($business_unit as $bu) { if(!empty($bu['business_unit'])) { ?>
								<option value="<?php echo $bu['id']; ?>"><?php echo $bu['business_unit']; ?></option>	
								<?php } } ?>
							</select>
						</td>
						<td>
							<select style="width:170px;" multiple="multiple" id="department_id_fk" name="department_id_fk[]" >
							
							</select>
						</td>

						<td>
							<select style="width:150px;" multiple="multiple" id="practices" name="practices[]">
								
							</select>
						</td>
						<td>
							<select style="width:178px;" id="datefilter" name="datefilter">
								<option value="1">All</option>
								<option value="2">Start Date</option>
								<option value="3">End Date</option>
							</select>
							<br />
							From <input type="text" name="from_date" id="from_date" class="pick-date textfield" style="width:57px;" />
							To <input type="text" name="to_date" id="to_date" class="pick-date textfield" style="width:57px;" />
						</td>
					</tr>
					</tbody>
						<thead>
							<tr>
								<th>By Customer Wise</th>
								<th>By Services Wise</th>
								<th>By Customer Type</th>
								<th>By Project Manager</th>
								<th>By Project Geography</th>
								<th>By Project Location</th>
								<th></th>
							</tr>	
						</thead>
					<tbody>
						<tr>
						
							<td>
								<select style="width:145px;" multiple="multiple" id="customer1" name="customer1[]">
									<?php foreach($customers as $customer) { if(!empty($customer['company'])) { ?>
									<option value="<?php echo $customer['companyid']; ?>"><?php echo $customer['company']; ?></option>	
									<?php } } ?>
								</select>
							</td>
							<td>
								<select style="width:170px;" multiple="multiple" id="services" name="services[]" >
									<?php foreach($services as $service) {?>
									<option value="<?php echo $service['sid']; ?>"><?php echo $service['services'];?></option>	
									<?php } ?>
								</select>
							</td>
							<td>
								<select multiple="multiple" id="customer_type" name="customer_type[]" class="advfilter" style="width:140px;">
									<!-- <option value="0">Internal</option>
									<option value="1">External</option> -->
									<?php
                                        foreach($this->cfg['customer_type'] as $status_key=>$status_val) {
                                            ?>
                                                <option value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
                                            <?php
                                        }
                                        ?>
								</select> 
							</td>
							<td >
								<select style="width:210px;" multiple="multiple" id="pm" name="pm[]">
									<?php 
										if(!empty($all_pm)) {
											foreach($all_pm as $pm) {
												$pm_name = $pm['first_name'].(($pm['last_name']!='') ? ' '.$pm['last_name'].' ' : ' ').(($pm['emp_id']!='') ? '- '.$pm['emp_id'].' ' : ' ');
										?>
											<option value="<?php echo $pm['userid']; ?>" title="<?php echo $pm_name; ?>"><?php echo $pm_name; ?></option>	
										<?php 
											} 
										}
									?>
								</select>
							</td>
							<td>
							 <select style="width:154px;" multiple="multiple" id="project_geography" name="project_geography[]">	
								<?php
								if (!empty($lead_geographys)) {
									foreach ($lead_geographys as $lead_geography) {
								?>
									<option value="<?php echo $lead_geography['georegionid'] ?>"><?php echo $lead_geography['georegion_name'];?></option>
								<?php
									}
								}
								?>
							</select>
							</td>

							<td>
							 <select style="width:210px;" multiple="multiple" id="project_location" name="project_location[]">	
							 <?php
                                        foreach($this->cfg['project_location'] as $status_key=>$status_val) {
                                            ?>
                                                <option value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
                                            <?php
                                        }
                             ?>
							</select>
							</td>
						</tr>
						<tr align="right" >
							<td colspan="6"><input type="reset" class="positive input-font" name="advance_pjt" value="Reset" />
							
							<input type="button" class="positive input-font show-ajax-loader" name="advance_pjt" id="search_advance" value="Search" />
							<input type="button" class="positive input-font show-ajax-loader" name="advance" id="save_advance" value="Save & Search" />
							
							<div id = 'load' style = 'float:right;display:none;height:1px;'>
								<img src = '<?php echo base_url().'assets/images/loading.gif'; ?>' width="54" />
							</div>
							</td>
						</tr>
					</tbody>
					</table>
				</form>
			</div>
			
			<div class="clearfix"></div>
			<div id="ajax_loader" style="margin:20px;display:none" align="center">
				Loading Content.<br><img alt="wait" src="<?php echo base_url().'assets/images/ajax_loader.gif'; ?>"><br>Thank you for your patience!
			</div>
			<div id="ad_filter" class="custom_dashboardfilter"></div>
		<?php 
		} else {
			echo "You have no rights to access this page";
		}
		?>
	</div>
	<div id='popupGetSearchName'></div>
</div>
<script type="text/javascript" src="assets/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="assets/js/projects/projects_view.js"></script>
<script type="text/javascript" src="assets/js/projects/bu_changes.js"></script>
<?php require (theme_url().'/tpl/footer.php'); ?>
