<style>
.prac-dt{ text-align:center !important; }
.toggle { display: inline-block; }
.tr_othercost { background-color:#f2dede !important; }
#it_cost_grid{ border-bottom:0px; width:100%;}
.lbl_search { font-size: 12px; font-weight: bold; line-height: 25px; }
.emptyerror { text-align:center; font-size: 12px; border: 1px solid #cccccc; border-top : 0px !important; }
</style>
<div class="clear"></div>
<?php
set_time_limit(0);
ini_set('display_errors', 1);
//other cost
$overall_hour = $overall_cost = 0;
?>
<div class="it_cost_grid_div">
<?php
	echo "<table id='it_cost_grid' class='data-tbl dashboard-heads dataTable it_cost_grid'>
			<thead>
			<tr id='cost_rpt_head'>
				<th class='prac-dt desc_opt' width='9%'>ENTITY</th>
				<th class='prac-dt desc_opt' width='9%'>BUSINESS UNIT</th>
				<th class='prac-dt desc_opt' width='9%'>DEPARTMENT</th>
				<th class='prac-dt desc_opt' width='9%'>PRACTICE</th>
				<th class='prac-dt desc_opt' width='9%'>SKILL</th>
				<th class='prac-dt desc_opt' width='6%'>RESOURCE TYPE</th>
				<th class='prac-dt desc_opt' width='7%'>RESOURCE</th>
                                <th class='prac-dt desc_opt' width='7%'>EMP ID</th>
				<th class='prac-dt desc_opt' width='11%'>CUSTOMER NAME</th>
				<th class='prac-dt desc_opt' width='7%'>CUSTOMER TYPE</th>
				<th class='prac-dt desc_opt' width='14%'>PROJECT</th>
				<th class='prac-dt desc_opt' width='7%'>GEOGRAPHY</th>
				<th class='prac-dt desc_opt' width='7%'>PROJECT LOCATION</th>
				<th class='prac-dt desc_opt' width='5%'>MONTH YEAR</th>
				<th class='prac-dt desc_opt' width='4%'>HOUR</th>
				<th class='prac-dt desc_opt' width='5%'>COST</th>
			</tr>";
			echo "</thead><tbody>";
			if(!empty($resdata) && count($resdata)>0) {
				foreach($resdata as $data) {
					$i	= 0;
					$tempCls    = '';
					$type       = '';
					// if($data->customer_type == 0){
					// 	$type = 'Internal';
					// }else if($data->customer_type == 1){
					// 	$type = 'External';
					// }else if($data->customer_type == 2){
					// 	$type = 'BPO';
					// }
					foreach($this->cfg['customer_type'] as $status_key=>$status_val) {
                    
						if($data->customer_type == $status_key){
							$type = $status_val;
						}    
					}
					
					foreach($this->cfg['project_location'] as $status_key=>$status_val) {
                    
						if($data->project_location == $status_key){
							$project_location = $status_val;
						}    
				    }
					if(($data->resoursetype == 'Other Cost')){
						$resource_name = $data->resource_name;
					}else{
						$resource_name = $data->emp_name;
					}
					if('Other Cost'==$data->resoursetype) {
						$tempCls	 	 = 'tr_othercost';
					}
							 echo "<tr class='".$tempCls."' data-depth='".$i."'>
									<td width='9%' align='left' class='collapse lft-ali'><span class='toggle'>".$data->entity_name."</b></span></td>
									<td width='6%' align='left' class='collapse lft-ali'>".$data->business_unit."</td>
									<td width='6%' align='left' class='collapse lft-ali'>".$data->dept_name."</td>
									<td width='9%' align='left' class='collapse lft-ali'>".$data->practice_name."</td>
									
									<td width='9%' align='left' class='collapse lft-ali'>".$data->skill_name."</td>
									<td width='6%' align='left' class='collapse lft-ali'>".$data->resoursetype."</td>
									<td width='7%'>".$resource_name."</td>
                                                                        <td width='7%'>".$data->emp_id."</td>
									<td width='7%'>".$data->company."</td>
									<td width='7%'>".$type."</td>
									<td width='14%'>".$data->project_name."</td>
									<td width='7%'>".$data->georegion_name."</td>
									<td width='4%'>".$project_location."</td>
									<td width='5%'>".$data->month_year."</td>
									<td width='4%' align='right' class='rt-ali'>".$data->resource_hr."</td>
									<td width='5%' align='right' class='rt-ali'>".$data->resource_cost."</td>
								</tr>";
								$overall_hour	+= $data->resource_hr;
								$overall_cost	+= $data->resource_cost;
								$i++;
				}
			}
	echo "<tfoot id='exp_hide'><tr>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'></td>
			<td align='right' class='rt-ali'><b>Total:</b></td>
			<td width='5%' align='right' id='tfoot_hour' class='rt-ali'>".round($overall_hour, 1)."</td>
			<td width='5%' align='right' id='tfoot_cost' class='rt-ali'>".round($overall_cost, 2)."</td>
		</tr></tfoot>";
	echo "</tbody></table>";
?>
</div>
<script>
var filter_area_status = '<?php echo $filter_area_status; ?>';
</script>