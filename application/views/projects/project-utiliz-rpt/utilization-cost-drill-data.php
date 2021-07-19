<style>
.prac-dt{ text-align:center !important; }
#it_cost_grid{ border-bottom:0px; width:100%;}
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
// echo '<pre>'; print_r($resdata); echo '</pre>';
$invoiceArr = array();
$invoices = (isset($invoices_data) && !empty($invoices_data) && count($invoices_data)>0) ? $invoices_data['invoices'] : array();
if(!empty($invoices) && count($invoices)>0) {
	foreach($invoices as $inv_row) {
		if(isset($invoiceArr[$inv_row['pjt_id']])) {
			$invoiceArr[$inv_row['pjt_id']] += $inv_row['coverted_amt'];
		} else {
			$invoiceArr[$inv_row['pjt_id']] = $inv_row['coverted_amt'];
		}
	}
}

$rag_clr_arr 	  = array('Red'=>'#c21706','Amber'=>'#ff7e00','Green'=>'#468847');
$rag_clr_disp_arr = array(1=>'Red',2=>'Amber',3=>'Green');

$timesheet_data = array();
$practice_financial_maxhours = [];
// echo '<pre>';print_r($resdata);exit;

// This Function for Optimization for IT dashboard
if(count($resdata)>0) {
    $i =0;
    $other_cost_arr['other_cost_total'] = 0;
    foreach($resdata as $rec) {
        // echo '<pre>'; print_r($rec);exit;
        if($rec->resoursetype == "Other Cost"){
            // echo '<pre>'; print_r($rec);
            //****************This block of code Used for Other cost****************/
            $other_cost_arr[$rec->project_code]['detail'][$i]['desc']  = $rec->emp_name." On ".date('d-m-Y', strtotime($rec->start_time));
            $other_cost_arr[$rec->project_code]['detail'][$i]['amt']   = $rec->resource_cost ? $rec->resource_cost: 0;
            $other_cost_arr[$rec->project_code]['value']           += $rec->resource_cost ? $rec->resource_cost: 0;
			$other_cost_arr['other_cost_total']                    += $rec->resource_cost ? $rec->resource_cost: 0;
        }else{
            //****************This block of code used for Resource direct cost*************** */
            $resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['duration_hours'] 	+= $rec->resource_hr ?  $rec->resource_hr: 0 ;
            $resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['total_cost'] 		+= $rec->resource_cost? $rec->resource_cost: 0;
            $resource_cost_arr[$rec->username][$rec->yr][$rec->month_name][$rec->project_code]['total_dc_cost'] 	+= $rec->resource_cost? $rec->resource_cost: 0;
            $timesheet_data[$rec->username]['empname']  = $rec->emp_name;
        }
        $i++;
    }
}

// echo '<pre>';print_r($resource_cost_arr);exit;
// echo '<pre>';print_r($other_cost_arr);exit;



if(count($resource_cost_arr)>0 && !empty($resource_cost_arr)){
	$timesheet_projects = array();
	foreach($resource_cost_arr as $resourceName => $array1){
		// $dept_name = $resource_cost_arr[$resourceName]['dept_name'];
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
								
								//FOR INVOICE
								if(isset($invoiceArr[$project_code])) {
									$sub_tot[$project_code]['invoices'] = $invoiceArr[$project_code];
								}
								
								//FOR RAG
								if(isset($rag_data[$project_code])) {
									$sub_tot[$project_code]['rag'] = isset($rag_clr_disp_arr[$rag_data[$project_code]])? $rag_clr_disp_arr[$rag_data[$project_code]] : '';
								}
								
								//FOR CUSTOMER
								if(isset($customer_data[$project_code])) {
									$sub_tot[$project_code]['customer_name'] = isset($customer_data[$project_code])? $customer_data[$project_code] : '-';
								}
								
								//FOR ENTITY
								if(isset($entity_data[$project_code])) {
									$sub_tot[$project_code]['entity_name'] = isset($entity_data[$project_code])? $entity_data[$project_code] : '';
								}
								
								//FOR LEAD ID
								if(isset($lead_id_data[$project_code])) {
									$sub_tot[$project_code]['lead_id'] = isset($lead_id_data[$project_code])? $lead_id_data[$project_code] : '';
								}

								//FOR CUSTOMER TYPE
								if(isset($customer_type[$project_code])) {
									$sub_tot[$project_code]['customer_type'] = isset($customer_type[$project_code])? $customer_type[$project_code] : '';
								}

								//FOR PROJECT LOCATION
								if(isset($project_location[$project_code])) {
									$sub_tot[$project_code]['project_location'] = isset($project_location[$project_code])? $project_location[$project_code] : '';
								}

								//FOR GEOGRAPHY
								if(isset($georegion_name[$project_code])) {
									$sub_tot[$project_code]['georegion_name'] = isset($georegion_name[$project_code])? $georegion_name[$project_code] : '';
								}
								
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

// echo '<pre>'; print_r($sub_tot); echo '</pre>';

//**Get the other cost value projects only**//
$resource_cost_not_value_project = array_diff($othercost_projects[$practices_name], $timesheet_projects); #differences
//$resource_cost_not_value_project = array_unique(array_merge($timesheet_projects,$othercost_projects[$practices_name])); 
// echo '<pre>'; print_r($resource_cost_not_value_project); echo '</pre>';die;

/**including the other cost values crm projects only & not in timesheet**/
/*if(is_array($resource_cost_not_value_project) && !empty($resource_cost_not_value_project) && count($resource_cost_not_value_project)>0) {
	foreach($resource_cost_not_value_project as $crmPjtName) {
		$sub_tot[$crmPjtName]['sub_tot_hour'] 		= 0;
		$sub_tot[$crmPjtName]['sub_tot_cost'] 		= 0;
		$sub_tot[$crmPjtName]['sub_tot_directcost'] = 0;
	}
}*/
#differences
if(is_array($resource_cost_not_value_project) && !empty($resource_cost_not_value_project) && count($resource_cost_not_value_project)>0) {
	foreach($resource_cost_not_value_project as $crmPjtName) {
		$sub_tot[$crmPjtName]['sub_tot_hour'] 		= 0;
		$sub_tot[$crmPjtName]['sub_tot_cost'] 		= 0;
		$sub_tot[$crmPjtName]['sub_tot_directcost'] = 0;
		//FOR INVOICE
		if(isset($invoiceArr[$crmPjtName])) {
			$sub_tot[$crmPjtName]['invoices'] = $invoiceArr[$crmPjtName];
		}
		
		//FOR RAG
		if(isset($rag_data[$crmPjtName])) {
			$sub_tot[$crmPjtName]['rag'] = isset($rag_clr_disp_arr[$rag_data[$crmPjtName]])? $rag_clr_disp_arr[$rag_data[$crmPjtName]] : '';
		}
		
		//FOR CUSTOMER
		if(isset($customer_data[$crmPjtName])) {
			$sub_tot[$crmPjtName]['customer_name'] = isset($customer_data[$crmPjtName])? $customer_data[$crmPjtName] : '-';
		}
		
		//FOR ENTITY
		if(isset($entity_data[$crmPjtName])) {
			$sub_tot[$crmPjtName]['entity_name'] = isset($entity_data[$crmPjtName])? $entity_data[$crmPjtName] : '';
		}

		//FOR CUSTOMER TYPE
		if(isset($customer_type[$crmPjtName])) {
			$sub_tot[$crmPjtName]['customer_type'] = isset($customer_type[$crmPjtName])? $customer_type[$crmPjtName] : '';
		}

		//FOR PROJECT LOCATION
		if(isset($project_location[$crmPjtName])) {
			$sub_tot[$crmPjtName]['project_location'] = isset($project_location[$crmPjtName])? $project_location[$crmPjtName] : '';
		}
		//FOR GEOGRAPHY TYPE
		if(isset($georegion_name[$crmPjtName])) {
			$sub_tot[$crmPjtName]['georegion_name'] = isset($georegion_name[$crmPjtName])? $georegion_name[$crmPjtName] : '';
		}
		
		//FOR LEAD ID
		if(isset($lead_id_data[$crmPjtName])) {
			$sub_tot[$crmPjtName]['lead_id'] = isset($lead_id_data[$crmPjtName])? $lead_id_data[$crmPjtName] : '';
		}
	}
}

// echo '<pre><br><br><br>';print_r($sub_tot); die;
$tot_cost 	 = $tot_cost + $other_cost_arr['other_cost_total']; //merging the other cost values
// echo "<pre>"; print_r($other_cost_arr); echo "</pre>"; exit;
?>
<div class="page-title-head">
	<h2 class="pull-left borderBtm"><?php echo $practices_name; ?> - Project</h2>
	<div class="section-right">
		<!--
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
		-->
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

if(!empty($sub_tot)) {
	echo "<table id='it_cost_grid' class='data-tbl dashboard-heads dataTable it_cost_grid'>
			<thead>
			<tr>
				<th width='200px' class='prac-dt'><b>CUSTOMER NAME</b></th>
				<th class='prac-dt'><b>PROJECT NAME</b></th>
                                <th class='prac-dt'><b>PROJECT CODE</b></th>
				<th class='prac-dt'><b>ENTITY</b></th>
				<th class='prac-dt'><b>HOURS</b></th>
				<th class='prac-dt'><b>INVOICE (USD)</b></th>
				<th class='prac-dt'><b>TOTAL COST (USD)</b></th>
				<th class='prac-dt'><b>CONTRIBUTION %</b></th>
				<th class='prac-dt'><b>CUSTOMER TYPE</b></th>
				<th class='prac-dt'><b>PRACTICE</b></th>
				<th class='prac-dt'><b>PROJECT LOCATION</b></th>
				<th class='prac-dt'><b>RAG</b></th>
			</tr>";
		echo "</thead><tbody>";
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
		//echo '<pre>';print_r($sort_ar); exit;
		$other_cost_val = 0;
		foreach($sort_ar as $p_name=>$user_ar) {
			// if(!empty($user_ar) && count($user_ar)>0 && isset($other_cost_arr[$p_name])) {
			$other_cost_val = $other_cost_arr[$p_name]; #differences
			//$other_cost_val = 88;//$other_cost_arr[$p_name];
			
			/*if( ($sub_tot[$p_name]['sub_tot_cost'] == 0) && ($sub_tot[$p_name]['sub_tot_directcost'] == 0) && empty($other_cost_val)) {
				continue;
			}
				if( empty($other_cost_val)) {
				continue;
			}*/
			#differences			
			if((!isset($sub_tot[$p_name]['invoices']) || $sub_tot[$p_name]['invoices'] == 0) && ($sub_tot[$p_name]['sub_tot_cost'] == 0) && ($sub_tot[$p_name]['sub_tot_hour'] == 0) && ($sub_tot[$p_name]['sub_tot_directcost'] == 0) && empty($other_cost_val)) {
				continue;
			}
				
			$i       = 0;
			$pj_tot_cost = $per_sub_hr = $sub_tot_pj_cost = 0;
			$name    				= isset($project_master[$p_name]) ? $project_master[$p_name] : $p_name;
			$inv_val    			= isset($sub_tot[$p_name]['invoices']) ? round($sub_tot[$p_name]['invoices']) : '';
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
			$pjt_tot_cost			 = $sub_tot[$p_name]['sub_tot_cost']+$other_cost_val['value'];
			$contri_val				 = (($inv_val-$pjt_tot_cost)/$inv_val)*100;
			$rag_status				 = isset($sub_tot[$p_name]['rag']) ? $sub_tot[$p_name]['rag'] : 'Red';
			//$customer_type			 = isset($sub_tot[$p_name]['customer_type']) ? $sub_tot[$p_name]['customer_type'] : 'Red';
			//$customer_type			 = $sub_tot[$p_name]['customer_type'] == 1?'External':'Internal';
			$customer_type = '';
			// if($sub_tot[$p_name]['customer_type'] == 1){
			// 	$customer_type = 'External';
			// }
			// else if($sub_tot[$p_name]['customer_type'] == 0){
			// 	$customer_type = 'Internal';
			// }else if($sub_tot[$p_name]['customer_type'] == 2){
			// 	$customer_type = 'BPO';
			// }
			foreach($this->cfg['customer_type'] as $status_key=>$status_val) {
                    
                if($sub_tot[$p_name]['customer_type'] == $status_key){
                    $customer_type = $status_val;
                }    
			}
			
			foreach($this->cfg['project_location'] as $status_key=>$status_val) {
                    
                if($sub_tot[$p_name]['project_location'] == $status_key){
                    $project_location = $status_val;
                }    
            }
			
			$georegion_name			 =  isset($sub_tot[$p_name]['georegion_name']) ? $sub_tot[$p_name]['georegion_name'] : '';
			$customer_name			 = (isset($sub_tot[$p_name]['customer_name']) && $sub_tot[$p_name]['customer_name'] !='-') ? ucfirst($sub_tot[$p_name]['customer_name']) : '-';

			#differences
			/*if(isset($customer_data[$p_name]) && $customer_name=='-')
			{
				$customer_name = $customer_data[$p_name];
			}*/
			
			$entity_name			 = (isset($sub_tot[$p_name]['entity_name']) && !empty($sub_tot[$p_name]['entity_name'])) ? $sub_tot[$p_name]['entity_name'] : '-';

			#differences
			/*if(isset($entity_data[$p_name]) && $entity_name=='-')
			{
				$entity_name = $entity_data[$p_name];
			}*/
			$lead_id = (isset($sub_tot[$p_name]['lead_id'])) ? $sub_tot[$p_name]['lead_id'] : '';

			#differences
			/*if(isset($lead_id_data[$p_name]) && $lead_id != '')
			{
				$lead_id = $lead_id_data[$p_name];
			}*/
			
			$bg_rag_color_status	 = isset($rag_clr_arr[$rag_status]) ? 'bgcolor='.$rag_clr_arr[$rag_status] : 'bgcolor="#c21706"';
			echo "<tr data-depth='".$i."' class='collapse'>
				<td align='left' class='collapse lft-ali'>".ucfirst($customer_name)."</span></td>
				<td align='left' class='collapse lft-ali'><a target='_blank' href=".$base_url.'project/view_project/'.$lead_id." title='View Project'>".ucfirst($name)."</a></span></td>
                                <td align='left' class='collapse lft-ali'>".$p_name."</span></td>
				<td align='left' class='collapse lft-ali'>".$entity_name."</span></td>
				<td align='right' class='rt-ali'>".round($sub_tot[$p_name]['sub_tot_hour'], 1)."</td>
				<td align='right' class='rt-ali'>".sprintf('%0.2f', $inv_val)."</td>
				<td align='right' class='rt-ali'>".round(($sub_tot[$p_name]['sub_tot_cost']+$other_cost_val['value']), 2)."</td>
				<td align='right' class='rt-ali'>".round($contri_val)."</td>
				<td align='right' class='rt-ali'>".$customer_type."</td>
				<td align='right' class='rt-ali'>".$georegion_name."</td>
				<td align='right' class='rt-ali'>".$project_location."</td>
				<td ".$bg_rag_color_status.">".$rag_status."</td>
			</tr>";
			//echo '<pre>';print_r($user_ar);
			/* if(count($user_ar)>0 && !empty($user_ar)) {
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
							echo "<td  align='right'><b>Resources</b></td>";
						} else {
							echo "<td ></td>";
						}
						echo "<td >".$timesheet_data[$ukey]['empname']."</td>
						<td align='right'>".round($pval['hour'], 1)."</td>
						<td align='right'>".round($pval['directcost'], 2)."</td>
						<td align='right'>-</td>
						<td align='right'>".round($pval['cost'], 2)."</td>
						<td align='right'>".round($per_hr, 1)."</td>
						<td align='right'>".round($per_directcost, 2)."</td>
						<td align='right'>".round($per_cost, 2)."</td>
					</tr>";
					$per_hr		= '';
					$rate_pr_hr = 0;
					$i++;
					$j++;
					endif;
					$user_ar = array();
				}
			} */
			//other cost value with description
			/* if((!empty($other_cost_val['detail'])) && count($other_cost_val['detail'])>0) {
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
							echo "<td  align='right'><b>Other Cost</b></td>";
						} else {
							echo "<td ></td>";
						}
						echo "<td >".ucfirst($oc_val['desc'])."</td>
							<td align='right'>-</td>
							<td align='right'>-</td>
							<td align='right'>".round($oc_val['amt'], 2)."</td>
							<td align='right'>".round($oc_val['amt'], 2)."</td>
							<td align='right'>-</td>
							<td align='right'>-</td>
							<td align='right'>".round($per_cost, 2)."</td>
						</tr>";
						$p++;
						$e++;
					}
				}
			} */
		}
		
	echo "<tfoot><tr data-depth='0'>
		<td  colspan='3' align='right' class='rt-ali'><b>TOTAL:</b></td>
		<td align='right' class='rt-ali'><b>".round($calc_tot_hour, 1)."</b></td>
		<td align='right' class='rt-ali'><b>".round($invoices_data['total_amt'])."</b></td>
		<td align='right' class='rt-ali'><b>".round($calc_tot_cost, 0)."</b></td>
		<td align='right' class='rt-ali'><b></b></td>
		<td align='right' class='rt-ali'><b></b></td>
		</tr></tfoot>";
	echo "</tbody></table>";
}			
?>
</div>
<script type="text/javascript" src="assets/js/excelexport/jquery.btechco.excelexport.js"></script>
<script type="text/javascript" src="assets/js/excelexport/jquery.base64.js"></script>
<script type="text/javascript" src="assets/js/projects/project-utiliz-rpt/utiliz-drill-data.js"></script>
