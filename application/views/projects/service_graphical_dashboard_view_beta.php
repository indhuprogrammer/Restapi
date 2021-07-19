<?php require (theme_url().'/tpl/header.php'); ?>
<style>
.jqplot-title { display: none; }

.adv_filter_it_service{
	background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin: 1px 10px;
    padding: 2px 5px 0px;
}
.contribution_chlid_container {
    position: relative;
    margin-top: 15px;
}
.show_hidelegend {
    position: absolute;
    top: -15px;
    right: 0;
}
.show_hidelegend a{
	color: #000;
}
.show_hidelegend a:hover{
	text-decoration: none;
}
</style>
<?php
//for total inv bar value charts
$inv_tot_arr_val = '['.round($inv_compare['curr_yr']['tot_inv_value']).','.'"Current Year"'.'],['.round($inv_compare['last_yr']['tot_inv_value']).','.'"Last Year"'.']';
?>
<script type="text/javascript" src="assets/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.meterGaugeRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.enhancedLegendRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.logAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/jqplot.pointLabels.min.js"></script>

<script type="text/javascript">
var default_currency_name = '<?php echo $this->default_cur_name; ?>';
var curr_fiscal_inv_val = <?php echo json_encode($inv_compare['curr_yr']['mon_inv_value']) ?>;
var last_fiscal_inv_val = <?php echo json_encode($inv_compare['last_yr']['mon_inv_value']) ?>;
var line_x_axis_inv_val = <?php echo json_encode($inv_compare['fis_mon_upto_current']); ?>;
var inv_tot_arr_val 	= [<?php echo $inv_tot_arr_val; ?>];
//for practicewise invoice compare
var prac_inv_practic_val = <?php echo json_encode($prat_inv_compare['practic_val']); ?>;
var prac_inv_curr_yr_val = <?php echo json_encode($prat_inv_compare['curr_yr_val']); ?>;
var prac_inv_last_yr_val = <?php echo json_encode($prat_inv_compare['last_yr_val']); ?>;
</script>

<div id="content">
    <div class="inner">
        <?php //if($this->session->userdata('viewPjt')==1) { ?>
        <?php //if($this->session->userdata('accesspage')==1) { ?>
		
		<!--<div id="filter_section">
			<div class="clear"></div>
			<div id="advance_search" style="padding-bottom:15px;">
				<form name="service_graph_dashboard" id="fiscal_year_filter" action="projects/dashboard/sevice_graph_dashboard" method="post">
					<input type="hidden" name="<?php //echo $this->security->get_csrf_token_name(); ?>" value="<?php //echo $this->security->get_csrf_hash(); ?>" />
					
					<div class="pull-right">
						<table style="width:300px;" cellpadding="0" cellspacing="0" class="data-table leadAdvancedfiltertbl" >
							<tr>
								<td align="left">
									<label><input <?php //echo ($fiscal_year_status=='current')?'checked="checked"':'';?> type="radio" name="fiscal_year_status" class="fiscal_year_status" value="current" />&nbsp;Current Financial Year &nbsp;&nbsp;</label>
									<label><input <?php //echo ($fiscal_year_status=='last')?'checked="checked"':'';?> type="radio" name="fiscal_year_status" class="fiscal_year_status" value="last" />&nbsp;Last Financial Year</label>
								</td>
								<input type="submit" class="positive input-font" name="advance" id="fiscal_year_filter_submit" value="Search" style="display:none;"/>							
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>-->
		
		<div id="filter_section" class="pull-right">
			<div class="clear"></div>
			<div id="advance_search" style="padding-bottom:15px;">
				<form name="service_graph_dashboard" id="fiscal_year_filter" action="projects/dashboard/sevice_graph_dashboard" method="post">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<?php //echo'<pre>';print_r($fiscal_year_status);exit;?>
					<div class="pull-left adv_filter_it_service">
						<div class='pull-left'>
							<label>Business Unit</label>
						</div>
						<div class='pull-left'>
							<select name='business_unit' id='business_unit'>
								<?php if(!empty($business_unit) && count($business_unit)>0) { ?>
									<?php foreach($business_unit as $key=>$value) { ?>
										<option value='<?php echo $value['id'].'-'.$value['business_unit']; ?>' <?php echo ($selected_business_unit ==  $value['id'].'-'.$value['business_unit'] ? 'selected="selected"' : ''); ?> > <?php echo $value['business_unit']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						<div class='pull-left'>
							<label>Dashboard Type</label>
						</div>
						<div class="pull-left">
							<label><input <?php echo ($dashboard_type=='practice')?'checked="checked"':'';?> type="radio" id="dashboard_type" name="dashboard_type" class="dashboard_type" value="practice" />&nbsp;Practice &nbsp;&nbsp;</label>
							<label><input <?php echo ($dashboard_type=='geography')?'checked="checked"':'';?> type="radio" id="dashboard_type" name="dashboard_type" class="dashboard_type" value="geography" />&nbsp;Geography</label>
						</div>				
						<div class='pull-left'>
							<label>Financial Year</label>
						</div>
						<div class="pull-left">
							<select name='fy_name' id='fy_name'>
								<!--<option value=''>--Select--</option>-->
								<?php if(!empty($fy_year) && count($fy_year)>0) { ?>
									<?php foreach($fy_year as $fy_rec) { ?>
										<option value='<?php echo $fy_rec['financial_yr']; ?>' <?php echo $yr_select = ($fiscal_year_status == $fy_rec['financial_yr']) ? 'selected="selected"' : ''; ?>><?php echo $fy_rec['fy_name']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						
						<!--<div class='pull-left'>
							<span id='show_srch_btn'><input type="submit" class="positive input-font" name="advance" id="advance" value="Search"/></span>
							<span id='show_load_btn' style="display:none;"><img src="<?php //echo base_url().'assets/images/loading.gif'; ?>" style="margin-left: 6px; width: 65px;"></span>
						</div>-->
					</div>
				</form>
			</div>		
		</div>
		
		<div class="clearfix">
			<!--Summary Container - Start -->
			<div class="uc-head">
				<div class="it_service_summary_det_container clearfix">
					<h5 class="revenue_compare_head_bar">
						<span class="forecast-heading"><?php echo "Performance Summary" . " (".date('F Y', strtotime($start_date))." - ".date('F Y', strtotime($end_date)).")" ?></span>
					</h5>
					<div id="it_service_summary_det" class="it_service_summary_det">
						<div class="summary_box">							
							<div class="boxshadow">
								<div class="content clearfix" id="value_contribution">
							<div class="numberCircle">
								<?php echo isset($contri_tot_val['tot_contri']) ? $contri_tot_val['tot_contri'] . " %" : ''; ?>
							</div>
							<div class="height_fix">
								<p>Contribution</p>
							</div>
							</div>
							</div>
						</div>
						<div class="summary_box">
							<?php
							//converting to million
							$curr_revenue = '';
							if( $inv_compare['curr_yr']['tot_inv_value'] > 0 ) {
								$curr_revenue = $inv_compare['curr_yr']['tot_inv_value'] / CONST_TEN_LAKH;
							}
							?>
							<div class="boxshadow">
							<div class="content clearfix" id="value_revenue">
								<div class="numberCircle">
									<?php echo '$ '.round($curr_revenue, 2); ?>
								</div>
								<div class="height_fix"><p>Revenue</p><span class="cur_name"><?php echo '(Million '. $this->default_cur_name.')'; ?></span></div>								
							</div>
							</div>
						</div>
						<div class="summary_box">
						<div class="boxshadow">
							<div class="content clearfix" id="value_utilization">							
							<div class="numberCircle">
								<?php echo $uc_graph_val['total']['ytd_billable'] . " %"; ?>
							</div>
							<div class="height_fix"><p>Utilization</p><span class="cur_name"><?php echo '(Cost)'; ?></span></div>
						</div>
						</div>
					</div>
					
				</div>
			</div>
			<!--Summary Container - End-->
			<div class="clear"></div>
			<!--Utilization Cost Container - Start-->
			<div id="uc_container_overall_wrap">
				<div class="uc-head fliter-section-wrap">
					<h2 class="pull-left borderBtm"><?php echo "Utilization Analysis" . " (".date('F Y', strtotime($start_date))." - ".date('F Y', strtotime($end_date)).")" ?></h2>
					<!--a class="choice-box" onclick="advanced_filter();" >
						<img src="assets/img/advanced_filter.png" class="icon leads" />
						<span>Advanced Filters</span>
					</a>
					<div class="buttons export-to-excel">
						<button type="button" class="positive" id="btnExportITServices">
							Export to Excel
						</button>
					</div-->
					<div id="filter_section" class="pull-right">						
						<div id="uc_advance_search" style="padding-bottom:5px;">			
							<?php $attributes = array('id'=>'filter_uc_dashboard','name'=>'filter_uc_dashboard','method'=>'post'); ?>
							<?php echo form_open_multipart("projects/sevice_graph_dashboard_beta", $attributes); ?>
								<input type="hidden" name="filter" id="filter" value="filter" />
								<input type="hidden" name="fiscal_year_status" value="<?php echo $fiscal_year_status; ?>" />
								<input type="hidden" name="business_unit_name" value="<?php echo $business_unit_name; ?>" />
								<input type="hidden" name="bu_practice" value='<?php echo json_encode($bu_practice); ?>'/>
								<div>
									<table cellpadding="0" cellspacing="0" class="data-table leadAdvancedfiltertbl" >
										<tr>
											<td align="left">
												<input type="radio" name="uc_filter_by" id="uc_cost" class="uc_filter_by_cls" value="cost" checked />&nbsp;By Cost&nbsp;&nbsp;
												<input type="radio" name="uc_filter_by" id="uc_hour" class="uc_filter_by_cls" value="hour" />&nbsp;By Hour 
											</td>
											<input type="submit" class="positive input-font" name="uc_filter_submit" id="uc_filter_submit" value="Search" style="display:none;"/>
										</tr>
									</table>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<div class="uc_container_wrap" id="uc_container">
				  <?php if(!empty($uc_graph_val)) { ?>
					 <?php echo $this->load->view('projects/service_graphical_box_uc', $uc_graph_val, true); ?>
		          <?php } ?>
				</div>
			</div>
			<!--Utilization Cost Container - End -->
			<div class="clear"></div>
			<!--Revenue Share Dashboard Container - Start -->
			<div id="revenue_container_overall_wrap">
				<div class="uc-head">
					<h2 class="pull-left borderBtm" style="margin-top: 20px;"><?php echo "Revenue Analysis" . " (".date('F Y', strtotime($start_date))." - ".date('F Y', strtotime($end_date)).")" ?></h2>
					<div id="filter_section" class="pull-right">
						<div class="clear"></div>
						<div id="advance_search" style="padding-bottom:15px;">			
							
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="revenue_container_wrap" id="revenue_container">
					<?php
						$revenue_arr = array();
						$revenue_values = '';
						foreach($invoice_val as $practice_name=>$practice_value){
							$revenue_arr[] = "['".$practice_name.'('.round($practice_value).')'."'".','.$practice_value."]";
						}
						$revenue_values = implode(',', $revenue_arr);
					?>
					<!--For Pie Charts-->
					<div class="pull-left overall_container">
						<h5 class="dash-tlt"><?php echo "Practice Wise - Revenue (".$this->default_cur_name.")"; ?></h5>
						<div id="revenue_pie" class="plot"></div>
					</div>
					<div class="pull-right revenue_chlid_container clearfix" id="inv_filter">
						<?php echo $this->load->view('projects/service_graphical_box_inv_compare', $inv_filter_by); ?>
					</div>
					<div class="clear"></div>
					<div class="pull-left overall_container" style="margin-top: 10px;">
						<?php
							$revenue_entity_arr = array();
							$revenue_entity_val = '';
							foreach($invoice_val_by_entity['entity_val'] as $entity_name=>$entity_value){
								$revenue_entity_arr[] = "['".$entity_name.'('.round($entity_value).')'."'".','.$entity_value."]";
							}
							$revenue_entity_val = implode(',', $revenue_entity_arr);
						?>
					
						<h5 class="dash-tlt"><?php echo "Entity Wise - Revenue (".$this->default_cur_name.")"; ?></h5>
						<div id="revenue_entity_pie" class="plot"></div>
					</div>
					<div class="pull-right revenue_chlid_container clearfix" style="margin-top: 10px;" id="prac_filter">
						<?php echo $this->load->view('projects/service_graphical_revenue_compare', $prac_filter_by); ?>
					</div>					
				</div>
			</div>
			<!--Revenue Share Dashboard Container - End -->
			<div class="clear"></div>
			<div id="contribution_container_overall_wrap">
				<div class="uc-head">
					<h2 class="pull-left borderBtm" style="margin-top: 20px;"><?php echo "Trend Analysis (".date('F Y', strtotime($start_date))." - ".date('F Y', strtotime($end_date)).")"; ?></h2>
					<div id="filter_section" class="pull-right">
						<div class="clear"></div>
						<div id="advance_search" style="padding-bottom:15px;">			
							
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div id="contribution_container_wrap">				
					<div class="pull-left contribution_chlid_container">
						<div class="show_hidelegend"> <a href="javascript:;" id="cont_legend_tog">Show / Hide Legends</a></div>
						<h5 class="revenue_compare_head_bar"><span class="forecast-heading">Contribution Trend</span></h5>
						<div id="contribution_trend" class="plot"></div>
					</div>
					<div class="pull-right contribution_chlid_container">
						<div class="show_hidelegend"> <a href="javascript:;"  id="reven_legend_tog">Show / Hide Legends</a></div>
						<h5 class="revenue_compare_head_bar"><span class="forecast-heading">Revenue Trend</span></h5>
						<div id="revenue_trend" class="plot"></div>
					</div>
				</div>
			</div>
			
			
        <?php 
		//} else {
		//	echo "You have no rights to access this page";
		//}
		?>
		</div>
	</div>
</div>
<?php #echo "<pre>"; print_r($contri_graph_val); echo "</pre>"; ?>
<script type="text/javascript">
var revenue_values 		= [<?php echo $revenue_values ?>];
var revenue_entity_val 	= [<?php echo $revenue_entity_val ?>];
var tre_pra_month_label = <?php echo json_encode($trend_pract_month_val['practic_arr']) ?>;
var tre_pra_month_x_val = <?php echo json_encode($trend_pract_month_val['trend_mont_arr']) ?>;
var tre_pra_month_value = [];
<?php foreach( $trend_pract_month_val['trend_pract_val_arr'] as $prac_mont_val ) { ?>
	tre_pra_month_value[tre_pra_month_value.length] = <?php echo json_encode($prac_mont_val) ?>;
<?php } ?>

var con_pra_month_label = <?php echo json_encode($contri_graph_val['con_pr_name']) ?>;
var con_pra_month_x_val = <?php echo json_encode($contri_graph_val['con_gr_x_val']) ?>;
var con_pra_month_value = [];
<?php foreach( $contri_graph_val['con_gr_val'] as $con_mont_val ) { ?>
	con_pra_month_value[con_pra_month_value.length] = <?php echo json_encode($con_mont_val) ?>;
<?php } ?>
</script>
<script type="text/javascript" src="assets/js/projects/service_graphical_dashboard_view.js"></script>
<script type="text/javascript" src="assets/js/projects/service_graphical_revenue_pie.js"></script>
<script type="text/javascript" src="assets/js/projects/service_graphical_revenue_entity_pie.js"></script>

<script type="text/javascript" src="assets/js/projects/service_graphical_revenue_practice_month_line.js?v1=1"></script>
<script type="text/javascript" src="assets/js/projects/service_graphical_contrib_practice_month_line.js?v1=1"></script>
<script>
$(function() {
   $("#fy_name").change(function () {
        var end = this.value;
        service_graph_dashboard.submit();
    });

	$('.dashboard_type').change(function(){ 
		 service_graph_dashboard.submit();
	})
	$('#business_unit').change(function(){
		if($('#business_unit').val() == '2-ITES'){
			$("input[name=dashboard_type][value=practice]").prop('checked', true);
		}else{
			$("input[name=dashboard_type][value=geography]").prop('checked', true);
		}
		 service_graph_dashboard.submit();
	})
	$("#cont_legend_tog").click(function(){
		$('#contribution_trend .jqplot-table-legend').toggle();
	});
	$("#reven_legend_tog").click(function(){
		$('#revenue_trend .jqplot-table-legend').toggle();
	});
})
</script>
<?php require (theme_url().'/tpl/footer.php'); ?>
