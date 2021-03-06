<?php //require (theme_url().'/tpl/header.php'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/base.css?v=3.2" type="text/css" />
<link rel="stylesheet" href="../assets/css/datatable.css" type="text/css" />
<link rel="stylesheet" href="../assets/css/demo_table.css" type="text/css" />
<link rel="stylesheet" href="../assets/css/quote.css?q=21" type="text/css" />
<link rel="stylesheet" href="../assets/css/smoothness/ui.all.css?q=2" type="text/css" />
<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.jqplot.min.css" />

<script type="text/javascript" src="../assets/js/jquery-1.9.1-min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery-ui-1.10.3.js"></script>
<script type="text/javascript" src="../assets/js/tableHeadFixer.js"></script>
<style>
.hide-calendar .ui-datepicker-calendar { display: none; }
button.ui-datepicker-current { display: none; }
.ui-datepicker-calendar { display: none; }
.dept_section{ width:100%; float:left; margin:20px 0 0 0; }
.dept_section div{ width:49%; }
.dept_section div:first-child{ margin-right:2% }
table.bu-tbl th{ text-align:center; }
table.bu-tbl{ width:70%; }
table.bu-tbl-inr th{ text-align:center; }
.clearfix{ clear: both;}
</style>
<script type="text/javascript">
var this_is_home = true;
var site_base_url    = "<?php echo base_url(); ?>"; 
</script>
<div id="content">
    <div class="inner">
        <?php //if($this->session->userdata('viewPjt')==1) { ?>
		<?php // if($this->session->userdata('accesspage')==1) { ?>
		<div class="page-title-head">
			<h2 class="pull-left borderBtm"><?php echo $page_heading ?></h2>
			
			<a class="choice-box" onclick="advanced_filter();" >
				<img src="assets/img/advanced_filter.png" class="icon leads" />
				<span>Advanced Filters</span>
			</a>
			<div class="buttons">
				<form name="fliter_data" id="fliter_data" method="post">
				<!--button  type="submit" id="excel-1" class="positive">
					Export to Excel
				</button-->
				<input type="hidden" name="exclude_leave" value="" id="hexclude_leave" />
				<input type="hidden" name="exclude_holiday" value="" id="hexclude_holiday" />
				<input type="hidden" name="month_year_from_date" value="" id="hmonth_year" />
				<input type="hidden" name="month_year_to_date" value="" id="hmonth_to_year" />
        <input type="hidden" name="business_unit_ids" value="" id="hbu_ids" />
				<input type="hidden" name="department_ids" value="" id="hdept_ids" />
				<input type="hidden" name="practice_ids" value="" id="hprac_ids" />
        <!-- metrics filter -->
				<input type="hidden" name="entity_ids" value="" id="hentity_ids" />
				<input type="hidden" name="geography_ids" value="" id="hgeography_ids" />
				<input type="hidden" name="skill_ids" value="" id="hskill_ids" />
				<input type="hidden" name="member_ids" value="" id="hmember_ids" />
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<div id="filter_section">
			<div class="clear"></div>
			
			<div id="advance_search" style="padding-bottom:15px; display:none;">
<form action="<?php echo site_url('employee_report/utilization_metrics')?>" name="project_dashboard" id="project_dashboard" method="post">					
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<div style="border: 1px solid #DCDCDC;">
						<table cellpadding="0" cellspacing="0" class="data-table leadAdvancedfiltertbl" >
							<tr>
								<td class="tblheadbg" style="width: 15%;">MONTH & YEAR</td>
								<td class="tblheadbg" style="width: 7%;">EXCLUDE</td>
								<td class="tblheadbg">ENTITY</td>
								<td class="tblheadbg">BUSINESS UNIT</td>								
								<td class="tblheadbg">DEPARTMENT</td>								
								<td class="tblheadbg">PRACTICE</td>								
								<td class="tblheadbg">SKILL</td>
								<td class="tblheadbg">RESOURCE</td>
								<td class="tblheadbg">GEOGRAPHY</td>
							</tr>
							<tr>	
								<td class="month-year">
									<span>From</span> <input type="text" data-calendar="false" name="month_year_from_date" id="month_year_from_date" class="textfield" value="<?php echo date('F Y',strtotime($start_date)); ?>" />
									<br />
									<span>To</span> <input type="text" data-calendar="false" name="month_year_to_date" id="month_year_to_date" class="textfield" value="<?php echo date('F Y',strtotime($end_date)); ?>" />
								</td>
								<td class="by-exclusion">
									<?php $leaveChecked=''; if($exclude_leave==1) { $leaveChecked ='checked="checked"'; } ?>
									<label><input type="checkbox" id="exclude_leave" name="exclude_leave" <?php echo $leaveChecked; ?> value="1" /><span>Leave</span></label>
																		
									<br />
									<?php $holidayChecked=''; if($exclude_holiday==1) { $holidayChecked ='checked="checked"'; } ?>
									<label><input type="checkbox" id="exclude_holiday" name="exclude_holiday" <?php echo $holidayChecked; ?> value="1" /><span>Holiday</span></label>
								</td>
								<td class="proj-dash-select">
									<select title="Select Entity" id="entity_ids" name="entity_ids[]" multiple="multiple">
									<?php if(count($entitys)>0 && !empty($entitys)) { ?>
										<?php foreach($entitys as $enty) { ?>
											<option <?php echo in_array($enty->div_id, $entity_ids) ? 'selected="selected"' : '';?> value="<?php echo $enty->div_id;?>"><?php echo $enty->division_name; ?></option>
										<?php } ?>
									<?php } ?>
									</select>
								</td>
                <td class="proj-dash-select">
                  <select title="Select Business Unit" id="business_unit_id" name="business_unit_id[]" multiple="multiple">
                    <?php if(count($business_unit)>0 && !empty($business_unit)){?>
  											<?php foreach($business_unit as $bu){?>
  												<option <?php echo in_array($bu['id'],$business_unit_ids)?'selected="selected"':'';?> value="<?php echo $bu['id'];?>"><?php echo $bu['business_unit'];?></option>
  									<?php } }?>
                  </select>
                </td>
								<td class="proj-dash-select">
									<select title="Select Department" id="department_id_fk" name="department_ids[]"	multiple="multiple">
									<?php if(count($departments)>0 && !empty($departments)){?>
											<?php foreach($departments as $depts){?>
												<option <?php echo in_array($depts['department_id'],$department_ids)?'selected="selected"':'';?> value="<?php echo $depts['department_id'];?>"><?php echo $depts['department_name'];?></option>
									<?php } }?>
									</select>
								</td>
								
								<td class="proj-dash-select">
									<select multiple="multiple" title="Select Practice" id="practices" name="practice_ids[]">
										<?php if(count($practice_ids_selected)>0 && !empty($practice_ids_selected)) { ?>
												<?php foreach($practice_ids_selected as $prac) {?>
													<option <?php echo in_array($prac['id'], $practice_ids)?'selected="selected"':'';?> value="<?php echo $prac['id'];?>"><?php echo $prac['practices'];?></option>
										<?php } } ?>
									</select>
								</td>
								<td class="proj-dash-select">
									<select title="Select Skill" id="skill_id" name="skill_ids[]"	multiple="multiple">
										<?php if(count($skill_ids_selected)>0 && !empty($skill_ids_selected)) { ?>
										<?php foreach($skill_ids_selected as $skills) { ?>
												<option <?php echo in_array($skills['id'],$skill_ids)?'selected="selected"':'';?> value="<?php echo $skills['id'];?>"><?php echo $skills['name'];?></option>
										<?php } }?>
									</select>
								</td>
								<td class="proj-dash-select">
									<select id="member_ids" name="member_ids[]" multiple="multiple">
										<?php if(count($member_ids_selected)>0 && !empty($member_ids_selected)){?>
										<?php foreach($member_ids_selected as $members){?>
												<option <?php echo in_array($members->username, $member_ids)?'selected="selected"':'';?> value="<?php echo $members->username;?>" title="<?php echo $members->emp_name." - ".$members->emp_id; ?>"><?php echo $members->emp_name;?></option>
										<?php } }?>								
									</select>
								</td>
								<td class="proj-dash-select">
									<select multiple="multiple" title="Select Practice" id="geography_ids" name="geography_ids[]">
										<?php if(count($geographies)>0 && !empty($geographies)) { ?>
												<?php foreach($geographies as $geography) {?>
													<option <?php echo in_array($geography->georegionid, $geography_ids)?'selected="selected"':'';?> value="<?php echo $geography->georegionid;?>"><?php echo $geography->georegion_name;?></option>
										<?php } } ?>
									</select>
								</td>
							</tr>
							<tr align="right" >
								<td colspan="9">
									<input type="hidden" id="start_date" name="start_date" value="" />
									<input type="hidden" id="end_date" name="end_date" value="" />
									<input type="hidden" id="filter_area_status" name="filter_area_status" value="1" />
									<input type="reset" class="positive input-font" name="advance" id="filter_reset" value="Reset" />
									<input type="submit" class="positive input-font" name="advance" id="advance" value="Search" />
									<div id = 'load' style = 'float:right;display:none;height:1px;'>
										<img src = '<?php echo base_url().'assets/images/loading.gif'; ?>' width="54" />
									</div>
								</td>
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>
 
			<div class="clearfix"></div>
			<div id="ajax_loader" style="margin:20px;display:none" align="center">
				Loading Content.<br><img alt="wait" src="<?php echo base_url().'assets/images/ajax_loader.gif'; ?>"><br>Thank you for your patience!
			</div>
				<?php 
				// echo "<pre>"; print_r($resdata); die;
					$master      = array();
					$user_arr    = array();
					$project_arr = array();
					$bu_arr      = array();
					$dept_arr    = array();
					$prac_arr    = array();
					$skil_arr    = array();
					$usercnt     = array();
					$deptusercnt = array();
					$bu_arr['totalhour'] = 0;
					$bu_arr['totalhead'] = 0;
					$bu_arr['totalcost'] = 0;
					
					if(!empty($resdata)) {
						foreach($resdata as $row){
							// for business unit based
							if (!in_array($row->username, $usercnt[$row->resoursetype])) {
								$usercnt[$row->resoursetype][] = $row->username;
								$bu_arr['totalhead'] = $bu_arr['totalhead'] + 1;
								if (isset($bu_arr['it'][$row->resoursetype]['headcount'])) {
									$bu_arr['it'][$row->resoursetype]['headcount'] = $bu_arr['it'][$row->resoursetype]['headcount'] + 1;
									//$bu_arr['it'][$row->resoursetype]['headcount'] += 1;
								} else {
									$bu_arr['it'][$row->resoursetype]['headcount'] = 1;
								}
							}
							if (isset($bu_arr['it'][$row->resoursetype]['hour'])) {
								$bu_arr['it'][$row->resoursetype]['hour'] = $row->duration_hours + $bu_arr['it'][$row->resoursetype]['hour'];
								$bu_arr['it'][$row->resoursetype]['cost'] = $row->resource_duration_cost + $bu_arr['it'][$row->resoursetype]['cost'];
								$bu_arr['it'][$row->resoursetype]['direct_cost'] = $row->resource_duration_direct_cost + $bu_arr['it'][$row->resoursetype]['direct_cost'];
							} else {
								$bu_arr['it'][$row->resoursetype]['hour'] = $row->duration_hours;
								$bu_arr['it'][$row->resoursetype]['cost'] = $row->resource_duration_cost;
								$bu_arr['it'][$row->resoursetype]['direct_cost'] = $row->resource_duration_direct_cost;
							}
							$bu_arr['totalhour'] = $bu_arr['totalhour'] + $row->duration_hours;
							$bu_arr['totalcost'] = $bu_arr['totalcost'] + $row->resource_duration_cost;
							$bu_arr['totaldirectcost'] = $bu_arr['totaldirectcost'] + $row->resource_duration_direct_cost;
							//for dept based
							if (!in_array($row->username, $deptusercnt[$row->dept_name][$row->resoursetype])) {
								$deptusercnt[$row->dept_name][$row->resoursetype][] = $row->username;
								$dept_arr[$row->dept_name]['totalhead'] = $dept_arr[$row->dept_name]['totalhead'] + 1;
								if (isset($dept_arr['dept'][$row->dept_name][$row->resoursetype]['headcount'])) {
									$dept_arr['dept'][$row->dept_name][$row->resoursetype]['headcount'] = $dept_arr['dept'][$row->dept_name][$row->resoursetype]['headcount'] + 1;
									//$dept_arr['dept'][$row->dept_name][$row->resoursetype]['headcount'] += 1;
								} else {
									$dept_arr['dept'][$row->dept_name][$row->resoursetype]['headcount'] = 1;
								}
							}
							if (isset($dept_arr['dept'][$row->dept_name][$row->resoursetype]['hour'])) {
								$dept_arr['dept'][$row->dept_name][$row->resoursetype]['hour'] = $row->duration_hours + $dept_arr['dept'][$row->dept_name][$row->resoursetype]['hour'];
								$dept_arr['dept'][$row->dept_name][$row->resoursetype]['cost'] = $row->resource_duration_cost + $dept_arr['dept'][$row->dept_name][$row->resoursetype]['cost'];
								$dept_arr['dept'][$row->dept_name][$row->resoursetype]['direct_cost'] = $row->resource_duration_direct_cost + $dept_arr['dept'][$row->dept_name][$row->resoursetype]['direct_cost'];
							} else {
								$dept_arr['dept'][$row->dept_name][$row->resoursetype]['hour'] = $row->duration_hours;
								$dept_arr['dept'][$row->dept_name][$row->resoursetype]['cost'] = $row->resource_duration_cost;
								$dept_arr['dept'][$row->dept_name][$row->resoursetype]['direct_cost'] = $row->resource_duration_direct_cost;
							}
							$dept_arr[$row->dept_name]['totalhour'] = $dept_arr[$row->dept_name]['totalhour'] + $row->duration_hours;
							$dept_arr[$row->dept_name]['totalcost'] = $dept_arr[$row->dept_name]['totalcost'] + $row->resource_duration_cost;
							$dept_arr[$row->dept_name]['totaldirectcost'] = $dept_arr[$row->dept_name]['totaldirectcost'] + $row->resource_duration_direct_cost;
							//for dept based
						}
					}
				?>	
			<div id="default_view">
				<h4>Business Unit</h4>
				<table cellspacing="0" cellpadding="0" border="0" class="data-table proj-dash-table bu-tbl">
					<tr>
						<thead>
							<th>Billablity</th>
							
							<th># Head Count *</th>
							<th>Total Cost</th>
							<th>Total Direct Cost</th>
							<th>% of Hours</th>
							<th>% of Cost</th>
							<th>% of Direct Cost</th>
						</thead>
					</tr>
					<?php
//						 echo "<pre>"; print_r($bu_arr); die;
						$total_hour   = 0;
						$percent_hour = 0;
						$percent_cost = 0;
						foreach($bu_arr as $bkey=>$bval) {
                                                        if(!is_array($bval)){
                                                            continue;
                                                        }
							ksort($bval);
							foreach($bval as $rt=>$rtval){
					?>
								<tr>
									<!--td><a onclick="getData(<?php #echo "'".$rt."'"; ?>,'1');return false;"><?php #echo $rt; ?></a></td-->
									<td><?= $rt; ?></td>
									
									<td align="right"><?= round($rtval['headcount'],2); ?></td>
									<td align="right"><?= round($rtval['cost'],0); ?></td>
									<td align="right"><?= round($rtval['direct_cost'],0); ?></td>
									<td align="right"><?php echo round(($rtval['hour']/$bu_arr['totalhour']) * 100, 1) . ' %'; ?></td>
									<td align="right"><?php echo round(($rtval['cost']/$bu_arr['totalcost']) * 100, 0) . ' %'; ?></td>
									<td align="right"><?php echo round(($rtval['direct_cost']/$bu_arr['totaldirectcost']) * 100, 0) . ' %'; ?></td>
								</tr>
					<?php
							$percent_hour += ($rtval['hour']/$bu_arr['totalhour']) * 100;
							$percent_cost += ($rtval['cost']/$bu_arr['totalcost']) * 100;
							$percent_directcost += ($rtval['direct_cost']/$bu_arr['totaldirectcost']) * 100;
							}
						}
					?>
							<tr>
							<td align="right"><b>Total:</b></td>
							<td align="right"></td>
							<td align="right"><?= isset($bu_arr['totalcost']) ? round($bu_arr['totalcost'],0) : 0; ?></td>
							<td align="right"><?= isset($bu_arr['totaldirectcost']) ? round($bu_arr['totaldirectcost'],0) : 0; ?></td>
							<td align="right"><?= round($percent_hour,1) . ' %'; ?></td>
							<td align="right"><?= round($percent_cost,0) . ' %'; ?></td>
							<td align="right"><?= isset($percent_directcost) ? round($percent_directcost,0) . ' %' : 0; ?></td>
							</tr>
				</table>
				<div class="dept_section">
          <?php 
          /*$i = 0;
          foreach ($dept_arr['dept'] as $department => $value) { $i++;
            if($i % 2 == 0){
              $pull = ' pull-right';
            }else{
              $pull = ' pull-left clearfix';
            }
            $percent_adshour = $percent_adscost = $percent_adsdirectcost = 0;
             ?>
					<div class="dept_sec_inner <?php echo $pull ?>" style="padding-bottom: 30px">
						<h4><?php echo $department ?></h4>
						<table cellspacing="0" cellpadding="0" border="0" class="data-table proj-dash-table bu-tbl-inr">
							<tr>
								<thead>
									<th>Billablity</th>
									<th>Hours</th>
									<th># Head Count *</th>
									<th>Total Cost</th>
									<th>Total Direct Cost</th>
									<th>% of Hours</th>
									<th>% of Cost</th>
									<th>% of Direct Cost</th>
								</thead>
							</tr>
							<?php
              // echo "<pre>";print_r($dept_arr);die;
								ksort($value);
								foreach($value as $adskey=>$adsval) {
							?>
										<tr>
											<td><a onclick="getData(<?php echo "'".$adskey."'"; ?>,<?php echo "'".$department."'"; ?>);return false;"><?= $adskey; ?></a></td>
											<td align="right"><?= round($adsval['hour'],1); ?></td>
											<td align="right"><?= round($adsval['headcount'],2); ?></td>
											<td align="right"><?= round($adsval['cost'],0); ?></td>
											<td align="right"><?= round($adsval['direct_cost'],0); ?></td>
											<td align="right"><?php echo round(($adsval['hour']/$dept_arr[$department]['totalhour']) * 100, 1) . ' %'; ?></td>
											<td align="right"><?php echo round(($adsval['cost']/$dept_arr[$department]['totalcost']) * 100, 0) . ' %'; ?></td>
											<td align="right"><?php echo round(($adsval['direct_cost']/$dept_arr[$department]['totaldirectcost']) * 100, 0) . ' %'; ?></td>
										</tr>
							<?php
									$percent_adshour += ($adsval['hour']/$dept_arr[$department]['totalhour']) * 100;
									$percent_adscost += ($adsval['cost']/$dept_arr[$department]['totalcost']) * 100;
									$percent_adsdirectcost += ($adsval['direct_cost']/$dept_arr[$department]['totaldirectcost']) * 100;
									}
							?>
									<tr>
									<td align="right"><b>Total:</b></td>
									<td align="right"><?= round($dept_arr[$department]['totalhour'],1); ?></td>
									<td align="right"></td>
									<td align="right"><?= round($dept_arr[$department]['totalcost'],0); ?></td>
									<td align="right"><?= round($dept_arr[$department]['totaldirectcost'],0); ?></td>
									<td align="right"><?= round($percent_adshour, 1) . ' %'; ?></td>
									<td align="right"><?= round($percent_adscost, 0) . ' %'; ?></td>
									<td align="right"><?= round($percent_adsdirectcost, 0) . ' %'; ?></td>
									</tr>
						</table>
					</div>
        <?php } */ ?>
<div class="dept_sec_inner <?php echo $pull ?>" style="padding-bottom: 30px">
            <h4><?php echo $department ?></h4>
            <table cellspacing="0" cellpadding="0" border="0" class="data-table proj-dash-table bu-tbl-inr">
                    <tr>
                            <thead>
                                    <th>Business Unit</th>
                                    <th>Head Count</th>
                                    <th>Billable</th>
                                    <th>Non Billable</th>
                                    <th>Internal</th>
                                    <th>Total</th>
                                    <th>Cross BU</th>
                            </thead>
                    </tr>

<?php 
//echo '<pre>';print_r($dept_arr);
//echo '<pre>';print_r($test);
//exit;

          $i = 0;
          foreach ($dept_arr['dept'] as $department => $value) { $i++;
             ?>
            <tr>
                <td align="right">
          <a onclick="getDataDept(<?php echo "'".$department."'"; ?>);return false;"><?= $department; ?></a>
          </td>
                <?php
//                ksort($value);
//                foreach($value as $adskey=>$adsval) {
                ?>
                    <td align="right"><?= 
                    isset($dept_arr[$department]['totalhead']) ? $dept_arr[$department]['totalhead'] : '0'; 
                    ?></td>
                    <td align="right"><?= 
                    isset($value['Billable']['headcount']) ? $value['Billable']['headcount']: '0'; 
                    ?></td>
                    <td align="right"><?= 
                    isset($value['Non-Billable']['headcount']) ? $value['Non-Billable']['headcount'] : '0'; 
                    ?></td>
                    <td align="right"><?= 
                    isset($value['Internal']['headcount']) ? $value['Internal']['headcount'] : '0'; 
                    ?></td>
                    <td align="right"><?= 
                    isset($value['Billable']['headcount']) ? $value['Billable']['headcount'] : '0'; 
                    ?></td>
                    <td align="right"><?= 
                    isset($value['Billable']['headcount']) ? $value['Billable']['headcount'] : '0'; 
                    ?></td>
                <?php //  } ?>
            </tr>
						
        <?php } ?>
		</table>
					</div>
					
				</div>
				<div class="clearfix"></div>
				<?php /*<div style="margin:20px 0">
					<fieldset>
						<legend>Legend</legend>
						<div align="left" style="background: none repeat scroll 0 0 #3b5998;">
							<!--Legends-->
							<div class="dashboardLegend">
								<div class="pull-left"><strong>#Head Count</strong> - Number of resources booked timesheet in these heads</div>
							</div>
						</div>
					</fieldset>
				</div>*/?>
			</div>
			<div class="clearfix"></div>
			<div id="drilldown_data" class="" style="margin:20px 0;display:none;">
			
			</div>
        <?php 
//		} else {
//			echo "You have no rights to access this page";
//		}
		?>
	</div>
</div>

<script type="text/javascript">
var cur_mon = '<?php echo date('F Y') ?>';
var filter_area_status = '<?php echo $filter_area_status; ?>';
if(filter_area_status==1){
	$('#advance_search').show();
}
$(function() {
    /* $('#month_year_from_date').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    }); */
	/*Date Picker*/
	$( "#month_year_from_date, #month_year_to_date" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'MM yy',
		maxDate: 0,
		showButtonPanel: true,	
		onClose: function(dateText, inst) {
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();         
			$(this).datepicker('setDate', new Date(year, month, 1));
		},
		beforeShow : function(input, inst) {
			$("#filter_area_status").val('1');
			if ((datestr = $(this).val()).length > 0) {
				year = datestr.substring(datestr.length-4, datestr.length);
				month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
				$(this).datepicker('setDate', new Date(year, month, 1));    
			}
				var other  = this.id  == "month_year_from_date" ? "#month_year_to_date" : "#month_year_from_date";
				var option = this.id == "month_year_from_date" ? "maxDate" : "minDate";        
			if ((selectedDate = $(other).val()).length > 0) {
				year = selectedDate.substring(selectedDate.length-4, selectedDate.length);
				month = jQuery.inArray(selectedDate.substring(0, selectedDate.length-5), $(this).datepicker('option', 'monthNames'));
				$(this).datepicker( "option", option, new Date(year, month, 1));
			}
			$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
		}
	});
	
	$('#exclude_leave, #exclude_holiday').click(function() {
        $("#filter_area_status").val('1');
    });
	$('#entity_ids').change(function(){
		$("#filter_area_status").val('1');
	});
	$('#geography_ids').change(function(){
		$("#filter_area_status").val('1');
	});
});	
$(document).ready(function(){
	
  $("#business_unit_id").change(function(){
    $("#filter_area_status").val('1');
    $('#skill_id').html('');
    $('#department_id_fk').html('');
    $('#practices').html('');
    $('#member_ids').html('');
    getMembers();
  });
  $("#department_id_fk").change(function(){
    $('#skill_id').html('');
    $('#practices').html('');
    $('#member_ids').html('');
    getMembers();
  });
  $("#practices").change(function(){
    $('#skill_id').html('');
    $('#member_ids').html('');
    getMembers();
  });
  $("#skill_id").change(function(){
    $('#member_ids').html('');
    getMembers();
  });
  
  function getMembers() {
    var business_unit_id = $("#business_unit_id").val();
    var department_id_fk = $("#department_id_fk").val();
    var practices = $("#practices").val();
    var skill_id = $("#skill_id").val();
    var start_date = $('#month_year_from_date').val();
    var end_date   = $('#month_year_to_date').val();
    $("#filter_area_status").val('1');
    var params = {'department_id_fk':department_id_fk,'business_unit_id':business_unit_id,
    'practices':practices,'skill_id':skill_id,'start_date':start_date,'end_date':end_date,'ci_csrf_token':csrf_hash_token};
    $.ajax({
      type: 'POST',
      url: site_base_url+'employee_report/get_members',
      data: params,
      success: function(members) {
        if(members){
          var mem_html='';
          var users = $.parseJSON(members);
          if(users.length){
            for(var i=0;i<users.length;i++){
              mem_html +='<option value="'+users[i].username+'">'+users[i].emp_name+'</option>';
            }
          }
          $('#member_ids').html('');
          $('#member_ids').append(mem_html)
        }
      }
    });
  }
	
	
	$('body').on('change','#skill_ids',function(){
		var dids       = $('#department_ids').val();
		var start_date = $('#month_year_from_date').val();
		var end_date   = $('#month_year_to_date').val();
		var sids = $(this).val();
		$("#filter_area_status").val('1');
		$('#member_ids').html('');
		var params = { 'dept_ids':dids,'skill_ids':sids,'start_date':start_date,'end_date':end_date };
		params[csrf_token_name] = csrf_hash_token;

	});
});
$('body').on('click','#member_ids',function(){
  $("#filter_area_status").val('1');
});	
function getDataDept(dept_type)
{
	$('#filter_group_by').prop('selectedIndex',0);
	if($('#business_unit_id').val() == null) {
		$('#hbu_ids').val('');
	} else {
		$('#hbu_ids').val($('#business_unit_id').val());
	}
	if($('#department_id_fk').val() == null) {
		$('#hdept_ids').val('');
	} else {
		$('#hdept_ids').val($('#department_id_fk').val());
	}
	if($('#practices').val() == null) {
		$('#hprac_ids').val('');
	} else {
		$('#hprac_ids').val($('#practices').val());
	}
  //metrics filter
	if($('#entity_ids').val() == null) {
		$('#hentity_ids').val('');
	} else {
		$('#hentity_ids').val($('#entity_ids').val());
	}
	if($('#geography_ids').val() == null) {
		$('#hgeography_ids').val('');
	} else {
		$('#hgeography_ids').val($('#geography_ids').val());
	}
	$('#hmonth_year').val($('#month_year_from_date').val());
	$('#hmonth_to_year').val($('#month_year_to_date').val());
	$('#hskill_ids').val($('#skill_id').val())
	$('#hmember_ids').val($('#member_ids').val())
	if($('#exclude_leave').attr('checked'))
	$('#hexclude_leave').val(1);
	if($('#exclude_holiday').attr('checked'))
	$('#hexclude_holiday').val(1)
	
	var formdata = $('#fliter_data').serialize();
	
	$.ajax({
		type: "POST",
		url: site_base_url+'employee_report/get_data/',                                                              
		data: formdata+'&resource_type=&dept_type='+escape(dept_type)+'&filter_group_by=4',
		cache: false,
		beforeSend:function() {
			$('#filter_group_by').prop('selectedIndex',0);
			$('#drilldown_data').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
			$('#drilldown_data').show();
			$('html, body').animate({ scrollTop: $("#drilldown_data").offset().top }, 1000);
		},
		success: function(data) {
			$('#drilldown_data').html(data);
			$('#drilldown_data').show();
			$('html, body').animate({ scrollTop: $("#drilldown_data").offset().top }, 1000);
		}                                                                                   
	});
}
function getData(resource_type, dept_type)
{
	$('#filter_group_by').prop('selectedIndex',0);
	if($('#business_unit_id').val() == null) {
		$('#hbu_ids').val('');
	} else {
		$('#hbu_ids').val($('#business_unit_id').val());
	}
	if($('#department_id_fk').val() == null) {
		$('#hdept_ids').val('');
	} else {
		$('#hdept_ids').val($('#department_id_fk').val());
	}
	if($('#practices').val() == null) {
		$('#hprac_ids').val('');
	} else {
		$('#hprac_ids').val($('#practices').val());
	}
  //metrics filter
	if($('#entity_ids').val() == null) {
		$('#hentity_ids').val('');
	} else {
		$('#hentity_ids').val($('#entity_ids').val());
	}
	if($('#geography_ids').val() == null) {
		$('#hgeography_ids').val('');
	} else {
		$('#hgeography_ids').val($('#geography_ids').val());
	}
	$('#hmonth_year').val($('#month_year_from_date').val());
	$('#hmonth_to_year').val($('#month_year_to_date').val());
	$('#hskill_ids').val($('#skill_id').val())
	$('#hmember_ids').val($('#member_ids').val())
	if($('#exclude_leave').attr('checked'))
	$('#hexclude_leave').val(1);
	if($('#exclude_holiday').attr('checked'))
	$('#hexclude_holiday').val(1)
	
	var formdata = $('#fliter_data').serialize();
	
	$.ajax({
		type: "POST",
		url: site_base_url+'employee_report/get_data/',                                                              
		data: formdata+'&resource_type='+resource_type+'&dept_type='+escape(dept_type)+'&filter_group_by=4',
		cache: false,
		beforeSend:function() {
			$('#filter_group_by').prop('selectedIndex',0);
			$('#drilldown_data').html('<div style="margin:20px;" align="center">Loading Content.<br><img alt="wait" src="'+site_base_url+'assets/images/ajax_loader.gif"><br>Thank you for your patience!</div>');
			$('#drilldown_data').show();
			$('html, body').animate({ scrollTop: $("#drilldown_data").offset().top }, 1000);
		},
		success: function(data) {
			$('#drilldown_data').html(data);
			$('#drilldown_data').show();
			$('html, body').animate({ scrollTop: $("#drilldown_data").offset().top }, 1000);
		}                                                                                   
	});
}
function advanced_filter() {
	$('#advance_search').slideToggle('slow');
}
$('#filter_reset').click(function() {
	 $("#project_dashboard").find('input:checkbox').removeAttr('checked').removeAttr('selected');
	 $("#practices").html('');
	 $("#skill_id").html('');
	 $("#member_ids").html('');
	 // $("#month_year_from_date, #month_year_to_date").val(cur_mon);
	 $("#department_ids,#geography_ids").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
});
</script>
<script type="text/javascript" src="../assets/js/projects/bu_changes.js"></script>
<?php //require (theme_url().'/tpl/footer.php'); ?>
