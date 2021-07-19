<style>
.prac-dt{ text-align:center !important; }
</style>
<div class="clear"></div>
<?php
// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
function array_sort($array, $on, $order='SORT_ASC')
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        switch ($order) {
            case 'SORT_ASC':
                asort($sortable_array);
                break;
            case 'SORT_DESC':
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }
    return $new_array;
}
$tbl_data = array();
$sub_tot  = array();
$cost_arr = array();
$directcost_arr = array();
$usercnt  = array();
$prjt_hr  = array();
$prjt_cst = array();
$prjt_directcst = array();
$prac = array();
$dept = array();
$skil = array();
$proj = array();
$tot_hour = 0;
$tot_cost = 0;
$tot_directcost = 0;

$timesheet_data     = array();
$other_cost_arr     = array();
$resource_cost_arr  = array();
if(count($resdata)>0) {
    // This Function for Optimization for IT dashboard
    // ********************************************************
    // Old code in service_dashboard_drill_data_beta.php
    $i =0;
    $other_cost_arr['other_cost_total'] = 0;
    foreach($resdata as $rec) {
        // echo '<pre>'; print_r($rec);exit;
		if($rec->resoursetype == "Other Cost"){
            // echo '<pre>'; print_r($rec);
            //****************This block of code Used for Other cost****************/
            $other_cost_arr[$rec->project_code]['detail'][$i]['desc']  = $rec->emp_name." On ".date('d-m-Y', strtotime($rec->start_time));
            $other_cost_arr[$rec->project_code]['detail'][$i]['amt']   = $rec->resource_cost ? $rec->resource_cost: 0;
			$other_cost_arr[$rec->project_code]['detail'][$i]['geo_region']   = $rec->georegion_name ? $rec->georegion_name: "";
			$other_cost_arr[$rec->project_code]['detail'][$i]['customer_type']   = $rec->customer_type ? $rec->customer_type: "";
			$other_cost_arr[$rec->project_code]['detail'][$i]['project_location']   = $rec->project_location ? $rec->project_location: "";
			$other_cost_arr[$rec->project_code]['detail'][$i]['company']   = $rec->customer_type ? $rec->company: "";
			$other_cost_arr[$rec->project_code]['value']           += $rec->resource_cost ? $rec->resource_cost: 0;
			$other_cost_arr['other_cost_total']                    += $rec->resource_cost ? $rec->resource_cost: 0;
        }else{
            //****************This block of code used for Resource direct cost*************** */
            $resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['duration_hours'] 	+= $rec->resource_hr ?  $rec->resource_hr: 0 ;
            $resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['total_cost'] 		+= $rec->resource_cost? $rec->resource_cost: 0;
            $resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['total_dc_cost'] 	+= $rec->resource_cost? $rec->resource_cost: 0;
		    $resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['geo_region'] 	= $rec->georegion_name;
			$resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['customer_type'] 	= $rec->customer_type;
			$resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['project_location'] 	= $rec->project_location;
			$resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['company'] 	= $rec->company;
			$timesheet_data[$rec->username]['empname']  = $rec->emp_name;
		}
        $i++;
    }
}


if(count($resource_cost_arr)>0 && !empty($resource_cost_arr)){
	$timesheet_projects = array();
	foreach($resource_cost_arr as $resourceName => $array1){
		$dept_name = $resource_cost_arr[$resourceName]['dept_name'];
		if(count($array1)>0 && !empty($array1)){
			foreach($array1 as $year => $array2){
				if($year !='dept_name'){
					if(count($array2)>0 && !empty($array2)){
						foreach($array2 as $month => $array3){
							$duration_hours = 0;
							$total_cost 	= 0;
							$total_dc_cost 	= 0;
							foreach($array3 as $project_code => $array4){
								$available_projects[] = $project_code;
								if(!in_array($project_code, $timesheet_projects)) {
									$timesheet_projects[] = $project_code;
								}
								$duration_hours = $array4['duration_hours'];
								$total_cost 	= $array4['total_cost'];
								$total_dc_cost 	= $array4['total_dc_cost'];
								$sub_tot[$project_code]['geo_region'] = $array4['geo_region'];
								$sub_tot[$project_code]['customer_type'] = $array4['customer_type'];
								$sub_tot[$project_code]['project_location'] = $array4['project_location'];
								$sub_tot[$project_code]['company'] = $array4['company'];

								if(isset($sub_tot[$project_code]['sub_tot_hour']))
								$sub_tot[$project_code]['sub_tot_hour'] +=  $duration_hours;
								else
								$sub_tot[$project_code]['sub_tot_hour'] =  $duration_hours;

								if(isset($sub_tot[$project_code]['sub_tot_cost']))
								$sub_tot[$project_code]['sub_tot_cost'] +=  $total_cost;
								else
								$sub_tot[$project_code]['sub_tot_cost'] =  $total_cost;

								if(isset($sub_tot[$project_code]['sub_tot_directcost']))
								$sub_tot[$project_code]['sub_tot_directcost'] +=  $total_dc_cost;
								else
								$sub_tot[$project_code]['sub_tot_directcost'] =  $total_dc_cost;

								if(isset($sub_tot[$project_code][$resourceName]['hour'])) {
									$sub_tot[$project_code][$resourceName]['hour'] += $duration_hours;
								} else {
									$sub_tot[$project_code][$resourceName]['hour'] = $duration_hours;
								}

								if(isset($sub_tot[$project_code][$resourceName]['cost']))
								$sub_tot[$project_code][$resourceName]['cost'] += $total_cost;
								else
								$sub_tot[$project_code][$resourceName]['cost'] = $total_cost;

								if(isset($sub_tot[$project_code][$resourceName]['directcost']))
								$sub_tot[$project_code][$resourceName]['directcost'] += $total_dc_cost;
								else
								$sub_tot[$project_code][$resourceName]['directcost'] = $total_dc_cost;

								$tot_hour 		= $tot_hour + $duration_hours;
								$tot_cost 		= $tot_cost + $total_cost;
								$tot_directcost = $tot_directcost + $total_dc_cost;

								$cost_arr[$resourceName] = $rec->cost_per_hour;
								$directcost_arr[$resourceName] = $rec->direct_cost_per_hour;

								//for project_code - sorting-directcost
								if(isset($prjt_directcst[$project_code]))
								$prjt_directcst[$project_code] += $total_dc_cost;
								else
								$prjt_directcst[$project_code] = $total_dc_cost;
							}
						}
					}
				}
			}
		}
	}
}

//**Get the other cost value projects only**//
$resource_cost_not_value_project = (!empty($timesheet_projects)) ? array_diff($othercost_projects[$practices_name], $timesheet_projects) : $othercost_projects[$practices_name];
// echo '<pre>'; print_r($resource_cost_not_value_project);exit;

/**including the other cost values crm projects only & not in timesheet**/
if(is_array($resource_cost_not_value_project) && !empty($resource_cost_not_value_project) && count($resource_cost_not_value_project)>0) {
	foreach($resource_cost_not_value_project as $crmPjtName) {
		$sub_tot[$crmPjtName]['sub_tot_hour'] 		= 0;
		$sub_tot[$crmPjtName]['sub_tot_cost'] 		= 0;
		$sub_tot[$crmPjtName]['sub_tot_directcost'] = 0;
	}
}
// Total
$tot_cost 	 = $tot_cost + $other_cost_arr['other_cost_total']; //merging the other cost values
// echo "<pre>"; print_r($other_cost_arr); echo "</pre>"; exit;
?>
<div class="page-title-head">
	<h2 class="pull-left borderBtm"><?php echo $practices_name; ?> - Project</h2>
	<div class="section-right">
		<div class="buttons add-new-button">
			<button id='expand_tr' class="positive" type="button">
				Expand
			</button>
		</div>
		<div class="buttons collapse-button">
			<button id='collapse_tr' class="positive" type="button">
				Collapse
			</button>
		</div>
		<div class="buttons export-to-excel">
			<button type="button" class="positive" id="btnExport">
				Export to Excel
			</button>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div>
<?php
$perc_tot_hr = $perc_tot_cost = $calc_tot_hour = $calc_tot_cost = $calc_tot_directcost =  $calc_tot_othercost = 0;
// echo '<pre>';print_r($sub_tot); exit;
if(!empty($sub_tot)) {
	echo "<table id='project_dash' class='data-table'>
			<tr>
				<th class='prac-dt' width='15%'><b>PROJECT NAME</b></th>
				<th class='prac-dt' width='15%'><b>USER NAME</b></th>
				<th class='prac-dt' width='15%'><b>CUSTOMER NAME</b></th>
				<th class='prac-dt' width='15%'><b>CUSTOMER TYPE</b></th>
				<th class='prac-dt' width='15%'><b>PROJECT LOCATION</b></th>
				<th class='prac-dt' width='15%'><b>GEOGRAPHY</b></th>
				<th class='prac-dt' width='5%'><b>HOUR</b></th>
				<th class='prac-dt' width='5%'><b>RESOURCE COST</b></th>
				<th class='prac-dt' width='5%'><b>OTHER COST</b></th>
				<th class='prac-dt' width='5%'><b>TOTAL COST</b></th>
				<th class='prac-dt' width='5%'><b>% of HOUR</b></th>
				<th class='prac-dt' width='5%'><b>% of RESOURCE COST</b></th>
				<th class='prac-dt' width='5%'><b>% of TOTAL COST</b></th>
			</tr>";
		//foreach($tbl_data as $projectCode => $proj_ar) {
		//asort($sub_tot);
		function cmp($a, $b) {
			if ($a['sub_tot_hour'] == $b['sub_tot_hour']) {
				return 0;
			}
			return ($a['sub_tot_hour'] > $b['sub_tot_hour']) ? -1 : 1;
		}
		uasort($sub_tot, 'cmp');
		$sort_ar = $sub_tot;
		$proj_arr = array();
		// echo '<pre>';print_r($sort_ar); exit;
		$other_cost_val = 0;
		foreach($sort_ar as $p_name=>$user_ar) {
			// if(!empty($user_ar) && count($user_ar)>0 && isset($other_cost_arr[$p_name])) {
			$other_cost_val = $other_cost_arr[$p_name];

			if( ($sub_tot[$p_name]['sub_tot_cost'] == 0) && ($sub_tot[$p_name]['sub_tot_hour'] == 0) && ($sub_tot[$p_name]['sub_tot_directcost'] == 0) && empty($other_cost_val)) {
				continue;
			}

			$i       = 0;
			$pj_tot_cost = $per_sub_hr = $sub_tot_pj_cost = 0;
			$name    				= isset($project_master[$p_name]) ? $project_master[$p_name] : $p_name;
			$per_sub_hr 	 		= ($sub_tot[$p_name]['sub_tot_hour']/$tot_hour)*100;
			$sub_tot_pj_cost 		= (($sub_tot[$p_name]['sub_tot_cost']+$other_cost_val['value'])/$tot_cost)*100;
			$sub_tot_pj_directcost 	= ($sub_tot[$p_name]['sub_tot_directcost']/$tot_directcost)*100;
			// $sub_tot_pj_directcost 	= ($sub_tot[$p_name]['sub_tot_directcost']/$tot_cost)*100;
			$perc_tot_hr   			+= $per_sub_hr;
			$perc_tot_directcost 	+= $sub_tot_pj_directcost;
			$perc_tot_cost 			+= $sub_tot_pj_cost;
			$calc_tot_hour 			+= $sub_tot[$p_name]['sub_tot_hour'];
			$calc_tot_directcost 	+= $sub_tot[$p_name]['sub_tot_directcost'];
			$calc_tot_othercost 	+= $other_cost_val['value'];
			$calc_tot_cost 			+= $sub_tot[$p_name]['sub_tot_cost']+$other_cost_val['value'];
			$geo_region 			= $sub_tot[$p_name]['geo_region'];
			$company 			= $sub_tot[$p_name]['company'];
			$customer_type = '';
			if($sub_tot[$p_name]['customer_type'] == 0){
				$customer_type = 'Internal';
			}else if($sub_tot[$p_name]['customer_type'] == 1){
				$customer_type = 'External';
			}else if($sub_tot[$p_name]['customer_type'] == 2){
				$customer_type = 'BPO';
			}

			foreach($this->cfg['project_location'] as $status_key1=>$status_val1) {
                    
                if($sub_tot[$p_name]['project_location'] == $status_key1){
                    $project_location = $status_val1;
                }    
            }

			echo "<tr data-depth='".$i."' class='collapse'>
				<th width='15%' align='left' class='collapse lft-ali'><span class='toggle'> ".strtoupper($name)."</span></th>
				<th width='13%' align='left' class='lft-ali'>SUB TOTAL(PROJECT WISE):</th>
				<th width='13%' align='left' class='lft-ali'>".$company."</th>
				<th width='13%' align='left' class='lft-ali'>".$customer_type."</th>
				<th width='7%' align='left' class='lft-ali'>".$project_location."</th>
				<th width='9%' align='left' class='lft-ali'>".$geo_region."</th>
				<th width='5%' align='right' class='rt-ali'>".round($sub_tot[$p_name]['sub_tot_hour'], 1)."</th>
				<th width='5%' align='right' class='rt-ali'>".round($sub_tot[$p_name]['sub_tot_directcost'], 2)."</th>
				<th width='5%' align='right' class='rt-ali'>".$other_cost_val['value']."</th>
				<th width='5%' align='right' class='rt-ali'>".round(($sub_tot[$p_name]['sub_tot_cost']+$other_cost_val['value']), 2)."</th>
				
				<th width='5%' align='right' class='rt-ali'>".round($per_sub_hr, 1)."</th>
				<th width='5%' align='right' class='rt-ali'>".round($sub_tot_pj_directcost, 2)."</th>
				<th width='5%' align='right' class='rt-ali'>".round((($sub_tot[$p_name]['sub_tot_cost']+$other_cost_val['value'])/$tot_cost)*100, 2)."</th>
			</tr>";
			//echo '<pre>';print_r($user_ar);
			if(count($user_ar)>0 && !empty($user_ar)):
				$i=1;
				$j = 0;
				foreach($user_ar as $ukey=>$pval) {

					if(!empty($pval['hour'])):
					$i=1;
					$per_hr = $per_cost = $per_directcost = 0;
					$per_hr   	= ($pval['hour']/$tot_hour) * 100;
					$per_cost 	= ($pval['cost']/$tot_cost) * 100;
					$per_directcost  = ($pval['directcost']/$tot_directcost) * 100;

					echo "<tr data-depth='".$i."' class='collapse'>";
						if($j==0){
							echo "<td width='15%' align='right'><b>Resources</b></td>";
						} else {
							echo "<td width='15%'></td>";
						}
						echo "<td width='15%'>".$timesheet_data[$ukey]['empname']."</td>
						<td width='5%' align='right'></td>
						<td width='5%' align='right'></td>
						<td width='5%' align='right'></td>
						<td width='5%' align='right'>".round($pval['hour'], 1)."</td>
						<td width='5%' align='right'>".round($pval['directcost'], 2)."</td>
						<td width='5%' align='right'>-</td>
						<td width='5%' align='right'>".round($pval['cost'], 2)."</td>
						
						<td width='5%' align='right'>".round($per_hr, 1)."</td>
						<td width='5%' align='right'>".round($per_directcost, 2)."</td>
						<td width='5%' align='right'>".round($per_cost, 2)."</td>
					</tr>";
					$per_hr		= '';
					$rate_pr_hr = 0;
					$i++;
					$j++;
					endif;
					$user_ar = array();
				}
			endif;
			//other cost value with description
			if((!empty($other_cost_val['detail'])) && count($other_cost_val['detail'])>0) {
				$e = 0;
				foreach($other_cost_val['detail'] as $oc_key=>$oc_val) {
					if($oc_val['amt'] != 0) {
						$p=1;
						$per_cost = 0;
						if(!empty($oc_val['amt'])){
							$per_cost = ($oc_val['amt']/$tot_cost) * 100;
						}
						echo "<tr data-depth='".$i."' class='collapse'>";
						if($e==0){
							echo "<td width='15%' align='right'><b>Other Cost</b></td>";
						} else {
							echo "<td width='15%'></td>";
						}
						echo "<td width='15%'>".ucfirst($oc_val['desc'])."</td>
							<td width='5%' align='right'>-</td>
							<td width='5%' align='right'>-</td>
							<td width='5%' align='right'>".round($oc_val['amt'], 2)."</td>
							<td width='5%' align='right'>".round($oc_val['amt'], 2)."</td>
							<td width='5%' align='right'>-</td>
							<td width='5%' align='right'>-</td>
							<td width='5%' align='right'>".round($per_cost, 2)."</td>
						</tr>";
						$p++;
						$e++;
					}
				}
			}
		}

	echo "<tr data-depth='0'>
		<td width='5%' align='right'>-</td>
		<td width='5%' align='right'>-</td>
		<td width='5%' align='right'>-</td>
		<td width='5%' align='right'>-</td>
		<td width='80%' colspan='2' align='right' class='rt-ali'><b>TOTAL:</b></td>
		<th width='5%' align='right' class='rt-ali'><b>".round($calc_tot_hour, 1)."</b></th>
		<th width='5%' align='right' class='rt-ali'><b>".round($calc_tot_directcost, 0)."</b></th>
		<th width='5%' align='right' class='rt-ali'><b>".round($calc_tot_othercost, 0)."</b></th>
		<th width='5%' align='right' class='rt-ali'><b>".round($calc_tot_cost, 0)."</b></th>
		<th width='5%' align='right' class='rt-ali'><b>".round($perc_tot_hr, 0)."</b></th>
		<th width='5%' align='right' class='rt-ali'><b>".round($perc_tot_directcost, 0)."</b></th>
		<th width='5%' align='right' class='rt-ali'><b>".round($perc_tot_cost, 0)."</b></th>
		</tr>";
	echo "</table>";
}
?>

</div>
<script>
//export
$(document).ready(function () {
	$("#btnExport").click(function () {
		$("#project_dash").btechco_excelexport({
			containerid: "project_dash"
		   , datatype: $datatype.Table
		   , filename: 'projectwisedata'
		});
	});
});
</script>
<script type="text/javascript" src="../assets/js/projects/table_collapse.js"></script>
<script type="text/javascript" src="../assets/js/projects/project_drilldown_data.js"></script>
<script type="text/javascript" src="../assets/js/excelexport/jquery.btechco.excelexport.js"></script>
<script type="text/javascript" src="../assets/js/excelexport/jquery.base64.js"></script>