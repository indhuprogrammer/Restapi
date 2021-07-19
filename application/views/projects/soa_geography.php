<?php

$color = ['value_contribution','value_utilization','value_revenue1','value_revenue2','value_revenue3','value_revenue4',
'value_contribution','value_utilization','value_revenue1','value_revenue2','value_revenue3','value_revenue4','value_contribution','value_utilization','value_revenue1',];
		
				$grand_tot = 0;
				$region_box = '';
				foreach($data as $key=>$value){
				
					$soa_values = $this->dashboard_model->get_soa_value_region($value->georegionid);
					$total = array_sum(array_column($soa_values, 'total'));
					$grand_tot += $total;
					$total_grand = sprintf('%0.2f',$grand_tot);
					if($total != 0){
						$amount = sprintf('%0.2f',$total);
						$region_box .= '	
						<div class="summary_box">							
							<div class="boxshadow">
								<div class="content" id="'.$color[$key].'">
								<div class="numberCircle">
								<a class="entity" onclick="entity_search('.$value->georegionid.',2); return false;" > $' .' '.$amount.'</a>
									</div>
								<div class="height_fix">
									<p>'.$value->georegion_name.'</p>
								</div>
							</div>
							</div>
							</div>
						';
					}
				}
			
				$region_box_full = '	
						<div class="summary_box">							
							<div class="boxshadow">
								<div class="content" id="value_revenue">
								<div class="numberCircle">
								<a class="entity" onclick="entity_search(0,2); return false;" > $' .' '.$total_grand.'</a>
									</div>
								<div class="height_fix">
									<p>Total Outstanding</p>
								</div>
							</div>
							</div>
							</div>
						';
				$date = $this->dashboard_model->getSOAUpdatedDate();		
				echo $region = '<h5 class="revenue_compare_head_bar">
				<span class="forecast-heading">Statement of Accounts & Overdue Aging Report - Total $ '.$total_grand.'</span>
				<span style="float:right;padding-right:11px">Updated On: <b>'.date("F d, Y H:i:s",strtotime($date)).' (IST)</b></span>
			</h5>'.$region_box_full.$region_box;
