<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<style type="text/css">
    @media  (min-width: 768px) {
        .modal-dialog {
          width: 900px!important; /* New width for default modal */
        }
        .modal-sm {
          width: 450px; /* New width for small modal */
        }
    }
    @media  (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
	input#discount_price {
    text-align: right!important;
}
	input.unit_price {
    text-align: right!important;
}
.act {
		text-align: left;
	}
.required_color {
  border: 2px solid rgba(255, 0, 0, 0.52);
}

.rate_comment_notification{
    width: 100% !important;
}

@media (min-width: 1200px) {
    .modal-xl {
        max-width: 1140px !important;
        width: 100% !important;
    }
}
</style>
<?php $min=''; if($invoice_type == 'Provisional' && $approve_status == 'Closed') { $min=''; } ?>
<?php $error_flag = 0; ?>
<?php $attributes = array('id' => 'set-invoice-terms','name' => 'set-invoice-terms','class'=> 'form-horizontal'); ?>
						<?php echo form_open_multipart("project/set_invoice_terms/$expect_id", $attributes); ?>
						<!--form id="set-payment-terms" -->
  							<input type="hidden" id="filefolder_id" name="filefolder_id" value="<?php echo $ff_id; ?>">
                                                        <input type="hidden" id="einvoice" name="einvoice" value="0">
                                                        <input type="hidden" id="einvoice_status" value="<?php echo $einvoice_status; ?>">
                                                        <input type="hidden" id="invoice_add_edit" value="<?php echo $invoice_add_edit; ?>">
                <?php if($expect_id){ 
  								//This is not including the amount for current invoice
									$total_gl_amt = abs($total_gl_amt) - abs($amount);
									//if mlestone created from move to project
									if(!$project_billing_type_value){
										$project_billing_type_value = $project_type;
									}
  							}else{
									$project_billing_type_value = $project_type;
								}
  							?>
							<input type="hidden" name="inventory_type" id="type_invoice" value="<?php echo $type; ?>">
  							<input type="hidden" id="total_gl_amt" value="<?php echo $total_gl_amt; ?>">
  							<input type="hidden" id="actual_worth_amount" value="<?php echo $actual_worth_amount; ?>">
  							<input type="hidden" id="project_billing_type_value" value="<?php echo $project_billing_type_value; ?>">
                
								<div class="row">
								  <div class="col-sm-12 pull-left">
                     <?php if($project_approval_status != 'Approved' || $sap_status != 'SAP' || strtotime(date('Y-m-d',strtotime($actual_date_due))) < strtotime(date('Y-m-d'))){ ?>
                    <div style="text-align: center; border: 1px solid #dc7272; padding: 4px; font-size: 14px; color: red;">
                      <?php 
                        if($sap_status != 'SAP'){
                          echo '<p>The customer is waiting for approval from finance team!</p>';
                          $error_flag = 1;
                        }
                        if($project_approval_status != 'Approved'){
                          echo '<p>The project is waiting for approval from finance team!</p>';
                          $error_flag = 1;
                        }
                        
                        if(strtotime(date('Y-m-d',strtotime($actual_date_due))) < strtotime(date('Y-m-d'))){
                          echo '<p>Project due date is expired!</p>';
                          // $error_flag = 1;
                        }
                        if($error_flag == 1){
                          echo '<script>$(".invoice_submit").hide();</script>';
                        }
                       ?>
                        
                    </div>
                    <br>
                  <?php }
                  ?>
                    <input type="hidden" id="error_flag" name="error_flag" value="<?php echo $error_flag; ?>">
                <div id="street_zip_error" style="display: none;text-align: center; border: 1px solid #dc7272; padding: 4px; font-size: 14px; color: red;">
                    <p>Street or Zipcode missing for selected Billing address</p>
                </div>
									<table class="table" id="table_cus" style="width: 100%;">
									 <tbody> 
									 <tr><th style="width: 115px;">Customer Code</th> 
									 		<td> <input type="text" readonly name="customer_code" id="customer_code" value= "<?php echo $sap_card_code; ?>" class="textfield mb readonly_css" />
										    </td> 
										  <th style="width: 110px;">Posting Date
										  </th> 
									     <td> <input type="text" readonly name="posting_date" id="posting_date" <?= !empty($disabled)?'disabled="disabled"':''?> value= "<?php echo !empty($posting_date)?date('d-m-Y',strtotime($posting_date)):''; ?>" class="textfield mb readonly_css" /></td> 
										 <th style="width: 100px;">Due Date</th> 
										 <?php if($this->userdata['role_id'] =='4'){?>
											<td> <input type="text" readonly name="due_date" <?= !empty($disabled)?'disabled="disabled"':''?> id="due_date_v" value= "<?php echo (!empty($due_date) && ($due_date != '0000-00-00 00:00:00') && ($due_date !=  '1970-01-01 00:00:00'))?date('d-m-Y',strtotime($due_date)):  date('d-m-Y', strtotime('+'.$payment_terms_list.'days'.'-1 day')); ?>" class="textfield mb due_date_v" /> </tr>
										 <?php }else { ?>
											<td> <input type="text" readonly name="due_date" <?= !empty($disabled)?'disabled="disabled"':''?> id="due_date_v" value= "<?php echo (!empty($due_date) && ($due_date != '0000-00-00 00:00:00') && ($due_date !=  '1970-01-01 00:00:00'))?date('d-m-Y',strtotime($due_date)):  date('d-m-Y', strtotime('+'.$payment_terms_list.'days'.'-1 day')); ?>" class="textfield mb readonly_css due_date_v" /> </tr>
										 <?php } ?>
										 <input type="hidden" id="payment_terms_list" name="payment_terms_list" value="<?php echo $payment_terms_list; ?>">
										
									 <tr><th>Customer Name</th> <td colspan="3"> <input type="text" <?= !empty($disabled)?'disabled="disabled"':''?> readonly name="customer_name" id="customer_name" value= "<?= $company; ?>" class="textfield mb readonly_css" /></td> <th>Project Currency</th> <td> <input type="text" readonly name="bp_currency" id="bp_currency" value= "<?= $expect_worth_name;?>" class="textfield mb readonly_css" /></tr>
									 
									 <tr>
									 <th>
									 		Contract / P O No.
									   </th> 
									   <td> 
									     <!-- <input type="text" name="customer_ref_no" maxLength="50" id="customer_ref_no" value= "<?php echo $customer_ref_no; ?>" class="textfield mb" />
										 </td> -->
										 <?php if($this->userdata['role_id'] =='4'){ ?>
										 		<input type="text" name="customer_ref_no" <?= !empty($disabled)?'disabled="disabled"':''?> maxLength="50" id="customer_ref_no" value= "<?php echo $customer_ref_no; ?>" class="textfield mb" />
										<?php }else { ?>
											<input type="text" readonly name="customer_ref_no" <?= !empty($disabled)?'disabled="disabled"':''?> maxLength="50" id="customer_ref_no" value= "<?php echo $customer_ref_no; ?>" class="textfield mb readonly_css" />
											<?php } ?>
										 </td>
									 <th>Transaction Type</th> <td> <input type="text" readonly <?= !empty($disabled)?'disabled="disabled"':''?> name="transaction_type" id="transaction_type" value="GA" class="textfield mb readonly_css" /></td> <th>Place of Supply</th> <td style="vertical-align: middle"> <input type="hidden" name="place_of_supply" <?= !empty($disabled)?'disabled="disabled"':''?> id="place_of_supply" value= "<?= $state_name; ?>"  class="textfield mb readonly_css" /> <?= $state_name; ?> </td></tr>
									 <tr> <th>Customer Address</th> <td colspan="5"> <select id="cutomer_address" name="cutomer_address" <?= !empty($disabled)?'disabled="disabled"':''?> class="required" style="width:100%">
									 <?php foreach($customer_address as $address){?>
									  <?php 
									  $add = customer_address_view($address->address_id);
                                                                          $data_street_zip = (($lead_entity == "1") && (trim($address->add1_street_po) == '' || trim($address->add1_postcode) == '')) ? 'show' : 'hide';
                                                                          $gst_in = trim($address->gst_in);
                                                                          ?>
									  <option data-gstin="<?php echo $gst_in ?>" data-street_zip="<?php echo $data_street_zip ?>" value="<?= $address->address_id ?>" <?php if($address->address_id == $address_id){ echo 'selected="selected"';}?>><?php echo Strip_tags($add) ?></option>
									 <?php } ?>
									 </select> </td></tr>
									 <tr><th>Project Manager</th><td colspan="2" style="font-size: 11px;"><?php echo $project_manager ?></td><th>Project Name</th><td colspan="2" style="font-size: 11px;"><input type="text" <?= !empty($disabled)?'disabled="disabled"':''?> readonly name="lead_title" id="lead_title" value= "<?= $lead_title; ?>" class="textfield mb readonly_css" /></td></tr>									     
									 </tbody>
									</table>
								 </div>								
							   </div>
							
						    <div class="form-group">
							  <label class="col-sm-1 pull-left ">Payment Milestone *</label>
							  <div class="col-sm-9 col-sm-79 pull-left" style="margin-left: -10px;">
								<input type="text"  name="sp_date_1" id="milestone_name_1" <?= !empty($disabled)?'disabled="disabled"':''?> value= "<?php echo $project_milestone_name; ?>" maxlength="50" class="textfield" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-1 pull-left" >For the Month & Year *</label>
							  <div class="col-sm-20 pull-left" style="margin-left: 5px;">          
								<!--input type="text" data-calendar="false"  class="textfield " value= "<?php echo $month_year; ?>" name="month_year" id="month_year_invoice"  /-->
							<?php
							if($invoice_type == 'Provisional' && $approve_status == 'Closed') { 
									$month_year = date('F Y');
									 ?>
									<input type="text"  value="<?php echo $month_year; ?>"  <?= !empty($disabled)?'disabled="disabled"':''?> name="sp_date_2" id="sp_date_invoice_21" class="textfield readonly_css"  />
							<?php } else {
							?>	
								<img src="assets/img/calender-icon.png" onclick="openCalendar('formonth');" <?= !empty($disabled)?'class="hide"':''?>>
								<input type="text" data-calendar="false" readonly <?= !empty($disabled)?'disabled="disabled"':''?> class="textfield readonly_css" value= "<?php echo !empty($month_year)?$month_year:date('F Y'); ?>" name="month_year" id="month_year_invoice" style="width: 70%;" />
							<?php } ?> 
							  </div>
							  <label class="col-sm-1 pull-left width_100" >Milestone date *</label>
							  <div class="col-sm-20 pull-left" style="margin-left: 5px;">          
								<!--input type="text" data-calendar="true" value= "<?php echo $expected_date; ?>" name="sp_date_2" id="sp_date_invoice_2" class="textfield "  /-->
							<?php	
							if($invoice_type == 'Provisional' && $approve_status == 'Closed') {  
								// $expected_date = date('d-m-Y'); not required
								?>
							  <input type="text"  value="<?php echo !empty($expected_date)?$expected_date:date('d-m-Y'); ?>" <?= !empty($disabled)?'disabled="disabled"':''?> name="sp_date_2" id="sp_date_invoice_21" class="textfield readonly_css"  />

							<?php } else { ?>  
								<img src="assets/img/calender-icon.png" onclick="openCalendar('mile');" <?= !empty($disabled)?'class="hide"':''?>>
								<input type="text" data-calendar="true" <?= !empty($disabled)?'disabled="disabled"':'';?> value="<?php echo !empty($expected_date)?$expected_date:date('d-m-Y'); ?>" name="sp_date_2" id="sp_date_invoice_2" class="textfield readonly_css" style="width: 70%;"  />
							<?php } ?>
							  </div>
							  <?php if($actual_status == 0) { ?>
							  <label class="col-sm-1 pull-left width_100" >Invoice Type *</label>
							  <div class="col-sm-20 pull-left" style="margin-left: -3px;">
							  <select name="invoice_type" <?= !empty($disabled)?'disabled="disabled"':''?> style="width:100%" id="invoice_type_list" onChange="javascript:change_invoice_type(this.value);">
							  <?php if($invoice_type == 'Provisional' && $approve_status == 'Closed' && $reversal !=1 ) { ?>								
								 <option value="Actual" <?php if($invoice_type=='Actual'){ echo 'selected';}?>>Actual</option>

								 <option value="Provisional" <?php if($invoice_type=='Provisional'){ echo 'selected';}?>>Provisional</option>
								 <!--option value="Credit Info" <?php if($invoice_type=='Credit Info'){ echo 'selected';}?>>Credit Info</option-->
               <?php }else if($invoice_type == 'Provisional' && $approve_status == 'Closed' && $reversal ==1 ) { ?>								
								 <option value="Provisional" <?php if($invoice_type=='Provisional'){ echo 'selected';}?>>Provisional</option>
							  <?php }else{ ?>
							  <option value="Actual" <?php if($invoice_type=='Actual'){ echo 'selected';}?>>Actual</option>
							     <option value="Provisional" <?php if($invoice_type=='Provisional'){ echo 'selected';}?>>Provisional</option>
								 
							  <?php } ?>
								</select>
							  </div>
							  <?php }else{ ?>
							  <input type="hidden" name="invoice_type" value="<?= $invoice_type; ?>" id="invoice_type_list">
							  <?php } ?>
                                                          
                                                          <div id="einvoice_label" style="display:none;">
                                                                <label class="col-sm-1 pull-left width_100" style="margin-left:10px;color: #4b6fb9;background-color: #EAEBFF;padding-left: 25px;">EInvoice</label>
                                                          </div>
							</div>
						
							<table class="table" id="customFields">
							<thead>
							  <tr>
							    <?php if($type == 'item'){ ?>
									<th style="width: 170px;">Non Inventory Item</th>
								<?php } ?>
								  <th style="width: 170px;">Description</th>
								  <?php if($project_billing_type_value != 1 ) { ?>
								  <th style="width: 90px;"><?= project_type_name($project_billing_type_value,'qty'); ?> </th>	
								  <?php } ?>
                                  <?php if($project_billing_type_value != 1 ) { ?>								  
								  <th style="width: 90px;"><?= project_type_name($project_billing_type_value,'rate'); ?></th>
                                  <?php } ?>
                    <?php if($type == 'item'){ ?>
                        <th style="width: 120px;">Price before Discount</th> 
  						      <?php }else { ?>	
                      <th style="width: 120px;">Unit Price</th> 
                    <?php } ?>
								  <th style="width: 90px;">Discount (%)</th>						
								  <th style="width: 120px;">Price after Discount</th>
								  <!--th style="width: 90px;">Total (LC)</th-->
								  <?php if(empty($disabled)) { ?>	
								  <th style="width: 70px;">Action</th>
								  <?php } ?>
                                                                  <th style="width: 120px;">Rate Comments</th>
							 </tr>
							 </thead>
							 <tbody>
							<?php if(!empty($gl_accounts)){	
                                $i=0;
                                $rowcnt = count($gl_accounts); 							
								foreach($gl_accounts as $gl_account){ ?>									
								 <tr class="add_row"> 
								 <?php if($type == 'item'){ ?>
									<td align="center" maxlength="50">
								 <select name="inventory_num[]" class="text_area_css mb textfield inventory_num required">
								   <option value=''>Select Inventory</option>
								 <?php foreach($inventory_item as $item){ ?>
									<option value="<?php echo $item->item_number ?>"<?php if($gl_account->inventory_number == $item->item_number){ echo 'selected="selected"';}?>><?php echo $item->item_number ?> - <?php echo $item->item_description ?></option>
								<?php } ?>
								 </select></td>
									<?php } ?>	  
									  <td align="center"><textarea <?= !empty($disabled)?'disabled="disabled"':''?> class="text_area_css mb textfield invoice_description required" name="invoice_description[]" maxlength="50" ><?= trim(str_replace('<br />','', $gl_account->invoice_description)); ?></textarea></td>
									  <?php if($project_billing_type_value != 1 ) { ?>
									  <td align="center" class="qty_td"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="qty[]" min="0" onkeypress="if(this.value.length==7) return false;" maxLength="7" step="any" onChange="calculateQtyRate(<?= $i?>)" id="qty_<?= $i?>" value="<?= $gl_account->qty; ?>"  class="text_css <?php echo !empty($gl_account->qty)? '':''; ?> mb textfield decimal"/></td>
									  <td align="center" class="qty_td"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="rate[]" min="0" step="any" onChange="calculateQtyRate(<?= $i?>)" id="rate_<?= $i?>" value="<?= $gl_account->rate; ?>"  class="text_css <?php echo !empty($gl_account->rate)? '':''; ?> mb textfield decimal"/></td>
									   <?php } ?>	
									  <td align="center"><?php if($project_billing_type_value != 1 ) { ?> <input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="unit_price[]" <?= $min ?> id="unit_price_<?= $i?>" value="<?= $gl_account->unit_price; ?>" step="any" class="text_css mb textfield unit_price uprice_r_td decimal" onkeyup="copyUnitValue(<?= $i?>)" /> <?php }else { ?><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" <?= $min ?> 
									  name="unit_price[]" step="any" id="unit_price_<?= $i?>" value="<?= $gl_account->unit_price; ?>" onChange="calculatePrice(<?= $i?>)" onkeyup="copyUnitValue(<?= $i?>)" class="text_css <?php echo !empty($gl_account->unit_price)? 'required':''; ?> mb textfield unit_price decimal"/><?php }?></td>
									  <td><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" min="1" max="100" name="discount[]" id="discount_<?= $i?>" value="<?= $gl_account->discount; ?>" readonly class="text_css mb textfield discount readonly_css"/></td>
									  <td><input  <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="price_after_discount[]" <?= $min ?> step="any"  id="price_after_discount_<?= $i?>" value="<?= $gl_account->price_after_discount; ?>" class="text_css textfield required mb price_after_discount decimal" onChange="calculatePrice(<?= $i?>)"/></td>	
									  <!--td><input type="text" name="total_lc[]" readonly class="text_css mb total_lc readonly_css" value="<?= $gl_account->total_lc; ?>" id="total_lc_<?= $i?>"/></td-->	
                    <?php if(empty($disabled)) { ?>									  
                      <?php 
  										if($rowcnt == 1 ) { ?>
  											<td><div class="act"><img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF"/> </td>
  										<?php }
  										else if($i+1 == $rowcnt ) { ?>
  												<td><div class="act"><img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF"/> <img src="<?= base_url()?>assets/img/collapse.png" class="icon remCF"></div></td> 
  										<?php } else { ?>
  													<td><div class="act"><img src="<?= base_url()?>assets/img/collapse.png" class="icon remCF"></div></td> 
									     <?php } ?>
                    <?php } ?>           
                                                                    <td>
                                                                        <?php /*<input class="textfield" type="text" <?= !empty($disabled)?'disabled="disabled"':''?> name="rate_comments[]" maxlength="100" value="<?= $gl_account->rate_comments; ?>">*/ ?>
                                                                        <textarea data-notified="1" data-info="1" <?= !empty($disabled)?'disabled="disabled"':''?> class="text_area_css mb textfield rate_comments" name="rate_comments[]" maxlength="50" ><?= trim(str_replace('<br />','', $gl_account->rate_comments)); ?></textarea>
                                                                        <p style="display:none;color:blue;" class="rate_comment_notification" id="rate_comment_info_1">Rate comments will gets Reflected in Invoice layout</p>
                                                                    </td>
								 </tr>
							  <?php $i++;	}
							} else{ ?>
							 <tr class="add_row">
							 <?php if($type == 'item'){ ?>
								 <td align="center" maxlength="50">
								 <select name="inventory_num[]" class="text_area_css mb textfield required">
								   <option value=''>Select Inventory</option>
								 <?php foreach($inventory_item as $item){ ?>
									<option value="<?php echo $item->item_number ?>"><?php echo $item->item_number ?> - <?php echo $item->item_description ?></option>
									
									<?php } ?>
								 </select></td>
								<?php } ?>	 
								  <td align="center"><textarea <?= !empty($disabled)?'disabled="disabled"':''?> class="text_area_css mb textfield required" name="invoice_description[]" maxlength="50"><?php echo $project_milestone_name; ?></textarea></td>
								  
								  <?php if($project_billing_type_value != 1 ) { ?>
								  <td align="center" class="qty_td"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="qty[]" onkeypress="if(this.value.length==7) return false;" maxLength="7" min="0" id="qty_0" step="any" onChange="calculateQtyRate(0)" value=""  class="text_css mb textfield decimal"/></td>
								  <td align="center" class="qty_td"><input  <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="rate[]" min="0" id="rate_0" step="any" onChange="calculateQtyRate(0)" value=""  class="text_css mb textfield decimal"/></td>
								  <?php } ?>	
								  <td align="center"> <?php if($project_billing_type_value != 1 ) { ?><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="unit_price[]"  step="any" <?= $min ?> id="unit_price_0" onChange="calculatePrice(0)" class="text_css mb textfield unit_price uprice_r_td decimal" onkeyup="copyUnitValue(0)" value="<?php echo (float) $amount; ?>" /> <?php }else { ?> <input type="number" name="unit_price[]" step="any" <?= $min ?>  id="unit_price_0" onChange="calculatePrice(0)" class="text_css required mb textfield unit_price decimal" onkeyup="copyUnitValue(0)" value="<?php echo (float) $amount; ?>" /> <?php }?></td>
								  <!--td><input type="number" name="rate[]" class="text_css required"/></td-->
								  <td align="center"><input  <?= !empty($disabled)?'disabled="disabled"':''?> type="number" min="1" max="100" name="discount[]" id="discount_0" readonly class="text_css mb textfield discount readonly_css"/></td>
								  <td align="center"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number"  name="price_after_discount[]" step="any" <?= $min ?>  id="price_after_discount_0" class="text_css textfield required mb price_after_discount decimal" onChange="calculatePrice(0)" value="<?php echo (float) $amount; ?>"/></td>	
								  <!--td><input type="text" name="total_lc[]" readonly class="text_css mb total_lc readonly_css" id="total_lc_0"/></td-->	
                                  <?php if(empty($disabled)) { ?>									  
								  <td> <div class="act"><img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF"/></div> </td>
								  <?php } ?>
                                                                  <td>
                                                                      <?php /*<input class="textfield" type="text" <?= !empty($disabled)?'disabled="disabled"':''?> name="rate_comments[]" maxlength="100" value="<?= $gl_account->rate_comments; ?>">*/ ?>
                                                                      <textarea data-notified="1" data-info="1" <?= !empty($disabled)?'disabled="disabled"':''?> class="text_area_css mb textfield rate_comments" name="rate_comments[]" maxlength="50" ><?= trim(str_replace('<br />','', $gl_account->rate_comments)); ?></textarea>
                                                                      <p style="display:none;color:blue;" class="rate_comment_notification" id="rate_comment_info_1">Rate comments will gets Reflected in Invoice layout</p>
                                                                    </td>
                                                                  </td>
							 </tr>
							<?php } ?>
							 </tbody>
						</table>
						<div class="row" style="width: 84%;" >
						 <div class="col-sm-6 pull-left" style="width:50%">
						 <?PHP if($payment_remark_app1!=''){
							 ?>
						 <div class="form-group">
							  <label class="col-sm-1 pull-left width_65">Approver1:</label>
							  <div class="col-sm-9 pull-left" style="width: 84%;">
								<?php echo str_replace('<br />','', $payment_remark_app1); ?>
							  </div>
							</div>
						 <?PHP }
						 if($payment_remark_app2!=''){
							 ?>
						 <div class="form-group">
							  <label class="col-sm-1 pull-left width_65">Approver2:</label>
							  <div class="col-sm-9 pull-left" style="width: 84%;">
								<?php echo str_replace('<br />','', $payment_remark_app2); ?>
							  </div>
							</div>
						 <?PHP } ?>
						 <div class="form-group">
							  <label class="col-sm-1 pull-left">Remarks to Finance</label>
							  <div class="col-sm-9 pull-left" style="width: 84%;clear: both;">
								<textarea  name="payment_remark" id="remark" style="height: 98px;"  class="textfield width_100_p " <?= !empty($disabled)?'disabled="disabled"':''?> maxlength="200" ><?php echo str_replace('<br />','', $payment_remark); ?></textarea>
								<p id="message" style="color:green;"></p>
							  </div>
                                                          <label class="col-sm-1 pull-left">Annexure</label>
							  <div class="col-sm-9 pull-left" style="width: 84%;clear: both;">
								<textarea data-notified="1"  name="annexure" id="annexure" style="height: 98px;"  class="textfield width_100_p " <?= !empty($disabled)?'disabled="disabled"':''?> maxlength="200" ><?php echo str_replace('<br />','', $annexure); ?></textarea>
								<p id="annexure_message" style="color:green;"></p>
                                                                <p id="annexure_info" style="font-size:11px;color:blue;display:none;"><b>Note :</b> Text entered in Annexure will gets reflected in Invoice</p>
							  </div>
							</div>
						 </div>
						   <div class="col-sm-6 pull-right">
							<table class="table total_table" >
									<tr>
										<th>Total Before Discount</th><td style="text-align: right; width: 100px;"><input type="text" id="total_before_discount" name="total_before_discount" readonly class="readonly_css textfield width_100 mb" <?= !empty($disabled)?'disabled="disabled"':''?> value="<?php echo $total_before_discount; ?>" style="text-align: right;" /></td>
									</tr>
									<tr>
										<th>Discount <span id="discount_p" style="margin-left: 25px;"></span> </th><td><input type="number" min="0" step="any" style="text-align:right;" id="discount_price" name="discount_price" onchange="calculateDiscount()" <?= !empty($disabled)?'disabled="disabled"':''?> style="text-align: right;" value="<?php echo $discount_price; ?>" class="textfield width_100 mb" /></td>
									</tr>
									<tr>
										<!--td>Tax</td><td><input type="text"  class="textfield width200px" /></td-->
									</tr>
									<tr>
										<th>Total</th><td><input type="text" id="total_price" <?= !empty($disabled)?'disabled="disabled"':''?> value="<?php echo $amount; ?>" name="total_price" readonly value="" class="readonly_css textfield width_100 mb" style="text-align: right;"/></td>
									</tr>
							</table>
						 </div>
						 </div>
						 <div class="row" style="width: 84%;">
						 <div class="col-sm-6 pull-left">
						 <div style="    margin-left: -10px;">
						  <label class="col-sm-1 pull-left width_100">Attachment File </label>
						  <div class="col-sm-6 pull-left">
						  <?php if(empty($disabled)) { ?>	
							<a title="Add Folder" href='javascript:void(0)' onclick="open_files(<?php echo $job_id; ?>,'set'); return false;"><img src="assets/img/select_file.jpg" alt="Select Files" ></a>
						  <?php } ?>
							<div id="show_files">
								<?php
								if(!empty($attached_file)){
									foreach($attached_file as $att_file){
								?>
										<div style="float: left; width: 100%;">
											<input type="hidden" value="<?php echo $att_file['file_id']; ?>" name="file_id[]" />
											<span style="float: left;display:inline-flex;" id="<?php echo $att_file['file_id']; ?>"><a onclick="download_files('<?php echo $job_id; ?>','<?php echo $att_file['lead_files_name']; ?>'); return false;" ><?php echo $att_file['lead_files_name']; ?></a> <?php if(empty($disabled)) { ?> <a class="del_file" id="<?php echo $att_file['file_id']; ?>" > </a> <?php } ?></span>
											
										</div>
								<?php
									}
								}
								?>
							</div>
							<div id="uploadFile"></div>
						  </div>
						</div>
						</div>
						<div class="col-sm-6 pull-left">
						 <?php if(empty($disabled)) { ?>
						 <?php if(($invoice_type == 'Provisional' && $approve_status == 'Closed')) { ?>
						  <div class="buttons" style="margin-right: 5px;float: left;" >
						     <?php if($sap_status == 'SAP') { ?>
						     <input type="hidden" name="submit" id="submit_convertactual_id" value="convertactual" />
							 <button type="button" name="submit" value="convertactual" onclick="send_convertactual('');"  class="positive">Convert to Actual Invoice</button>
							 <?php }else{ ?>
							 <button type="button" name="submit" value="convertactual" onclick="customerApprovalMsg();"  class="positive">Convert to Actual Invoice</button>
							 <?php } ?>
						</div>
            <?php if($sap_status == 'SAP') { ?>	
							<div class="buttons" >	
								<button type="button" name="submit" value="convertactual" onclick="send_convertactual('approval_request');"  class="positive invoice_submit">Convert to Actual & Send Approval</button>
							</div>
							<?php } ?>
						 <?php }else{  ?>
						 <div class="buttons" style="margin-right: 5px;float: left;">
						 <input type="hidden" name="save" id="save_form_id" value="" />
							<button type="button" name="save" value="save" onclick="save_milestone();" class="positive">Save Milestone</button>
						</div>
						  <div class="buttons" >
						    <?php if($project_approval_status != 'Approved'){ ?>
                  <button type="button" name="submit" value="submit" class="positive invoice_submit" onclick="projectApprovalMsg();">Submit Invoice & Send for approval</button>
                <?php }elseif($sap_status == 'SAP') { ?>
						    <input type="hidden" name="submit" id="submit_form_id" value="" />
							<button type="button" name="submit" value="submit" class="positive invoice_submit" onclick="send_approval();">Submit Invoice & Send for approval</button>
							<?php }else{ ?>
							 <button type="button" name="submit" value="submit" class="positive invoice_submit" onclick="customerApprovalMsg();">Submit Invoice & Send for approval</button>
							 <?php } ?>
						</div>
						 <?php } ?>
						</div>
						<input type="hidden" name="sp_form_jobid" id="sp_form_jobid" value="<?php echo $job_id; ?>" />
						<input type="hidden" name="project_billing_type" id="project_billing_type" value="<?php echo $project_billing_type_value; ?>" />
						<input type="hidden" name="saveform" id="saveform" value="0" />
						<input type="hidden" name="expectid" id="expectid" value="<?php echo $expect_id; ?>" />		
						<input type="hidden" name="jtnum" id="jtnum" value="<?php echo $jtnum; ?>" />	
						<input type="hidden" name="division" id="division" value="<?php echo $division; ?>" />	
						
						<input type="hidden" id="card_code" value="<?php echo !empty($invoice[0]->customer_code)?$invoice[0]->customer_code:$invoice[0]->sap_card_code;?>" >
                        <input type="hidden" id="due_date_val" value="<?php echo $invoice[0]->due_date; ?>" >
						<input type="hidden" id="posting_date_v" value="<?php echo $invoice[0]->posting_date; ?>" >
						<input type="hidden" id="entity" value="<?php echo $lead_entity; ?>">
						<input type="hidden" id="CostingCodeJE" value="<?php echo $CostingCodeJE; ?>">
						<input type="hidden" id="CostingCodeJE2" value="<?php echo $CostingCodeJE2; ?>">
						<input type="hidden" id="CostingCodeJE3" value="<?php echo $CostingCodeJE3; ?>">
				        <input type="hidden" id="gl_account" value="<?php echo $gl_account_v; ?>">
						
						<input type="hidden" name="sp_form_invoice_total" id="sp_form_invoice_total" value="0" />
						 <?php } ?>
                     </div>
					
			
						<?php echo form_close(); ?>
<?php if($project_billing_type_value == 1) { ?>
<style>
.qty_td{
	display:none;
}
.uprice_td{
	display:block;
}
.uprice_r_td{
	display:none;
}
</style>
<?php }else{ ?>
<style>
.uprice_td{
	display:none;
}
.uprice_r_td{
	display:block;
}
<?php } ?>
</style>
<style>
.total_lc, .discount, .uprice_r_td{
 text-align:right;	
}
table#customFields th {
    text-align: center;
        color: #fff;
    background: #4b6fc9;
}
.buttons button.positive {
    font-size: 11px!important;
}
.modal-header {
    padding: 10px 15px 10px 15px;
}
.readonly_css{
    border: none;
    background: none;
}
.readonly_css:focus{
   outline: none;
}

.width_65{
	width:65px!important;
}
.width_100{
	width: 100px!important;
}
#content label {
    font-size: 11px!important;   
	    width: 135px;
    padding-right: 0px;
}
.data-table td {
    text-align: center;
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
table.payment-table {
    margin-top: 5px;
}
input {
    margin-bottom: 5px!important;
}
.width_100_p{
 width: 100%!important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {  
    border: 2px solid #ddd!important;
	padding: 4px!important;
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
	background-color: #EAEBFF;
    font-weight: normal;

}

#table_cus th{
	text-align: left;
    vertical-align: middle;
}
table#customFields td {
    text-align: center;
	vertical-align: middle;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
.total_table th {
	    vertical-align: middle !important;
}
.price_after_discount{
	text-align: right !important;
}
</style>
<!--script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.9.1-min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.blockUI.js"></script-->


<script type="text/Javascript">

$(function () {
	/*$('.decimal').keypress(function (e) {
		var character = String.fromCharCode(e.keyCode)
		var newValue = this.value + character;
		var newV = parseFloat(newValue) * 100 % 2;	
		
		if (isNaN(newValue) || parseFloat(newValue) * 100 % 1 > 0) {
		
			e.preventDefault();
			return false;
		}else{
			var res = newValue.split(".");		
			if(res.length == 2){
				if(res[1].length > 2){
					e.preventDefault();
		        	return false;
				}
			}
		}
	});*/
//        var einvoice_status = $("#einvoice_status").val();
//        var invoice_add_edit = $("#invoice_add_edit").val();        
//        if(einvoice_status == "1" && invoice_add_edit == "view"){
//            $("#einvoice_label").show();
//        }
	decimalValue();
  calculateDiscount();
    $("#cutomer_address").change(function(){
        var street_zip = $(this).find(':selected').data('street_zip');
        var gstin = $(this).find(':selected').data('gstin');
        var error_flag = $("#error_flag").val();
        //show hide street zip error
        if(street_zip == 'show'){
            $(".invoice_submit").hide();
            $("#street_zip_error").show();
        }else{
            if(error_flag != "1"){
                $(".invoice_submit").show();
                $("#street_zip_error").hide();    
            }
        }
        //Enable einvoice based on entity, group and gst value
        var einvoice_status = $("#einvoice_status").val();
        //if(einvoice_status == "1"){
        if(gstin != "" && einvoice_status == "1"){
            $("#einvoice").val("1");
            $("#einvoice_label").show();
        }
    });
});
function decimalValue(){
	$('.decimal').keypress(function (e) {
		var character = String.fromCharCode(e.keyCode)
		var newValue = this.value + character;
		var res = newValue.split(".");		
		if(res.length == 2){
			console.log(res.length);
			if(res[1].length > 2){
				e.preventDefault();
				return false;
			}
		}
	
	});
}

var current_month = "<?= date('F Y');?>";
function formSubmit(){
	$('#mymodal').modal('hide');
	$.unblockUI();
	$('#submit_form_id').val('submit');
	$('#set-invoice-terms').submit();
}

function save_milestone(){
  project_billing_type_value = $('#project_billing_type_value').val();
  // if(project_billing_type_value == 1){
    // var total = $('#total_price').val();
    // var total_gl_amt = $('#total_gl_amt').val();
    // total = Math.abs(total) + Math.abs(total_gl_amt);
    // var actual_worth_amount = $('#actual_worth_amount').val();
    // if(total > actual_worth_amount){
      // alert('Total amount should be less than the actual project value is ' + actual_worth_amount + '. Existing invoice raised total value is ' + total_gl_amt);
    // }
  // }

	$("#saveform").val(1);
	var result = showRequest2();
	if(result!=false){
		$.blockUI({
				message:'<h4 style="color: white;  margin-top: 2px;">Processing</h4><img src="assets/img/ajax-loader.gif" />',
				css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333',zIndex:'999999999'}
			});
		$('#save_form_id').val('save');
		setTimeout(function(){
			$.unblockUI();			
			setTimeout(function(){
				$("#saveform").val(0);
			    $('#set-invoice-terms').submit();
		  }, 200);
		}, 500);
	}
}
function send_approval(){
  project_billing_type_value = $('#project_billing_type_value').val();
  // if(project_billing_type_value == 1){
    // var total = $('#total_price').val();
    // var total_gl_amt = $('#total_gl_amt').val();
    // total = Math.abs(total) + Math.abs(total_gl_amt);
    // var actual_worth_amount = $('#actual_worth_amount').val();
    // if(total > actual_worth_amount){
      // alert('Total amount should be less than the actual project value is ' + actual_worth_amount + '. Existing invoice raised total value is ' + total_gl_amt);
      // return false;
    // }
  // }

	var month = $('#sp_date_invoice_21').val();
	if(month == undefined){ 
		month = $('#month_year_invoice').val();
	}
	if(month == current_month){
		$("#saveform").val(1);
		var result = showRequest2();
		if(result!=false){
		var invoice_type = $("#invoice_type_list").val();
		$.blockUI({
			message:'<br /><h5>Are you sure to submit for ' + invoice_type + ' invoice?</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="positive" onclick="formSubmit(); return false;">Yes</button></div><div class="buttons"><button type="submit" class="negative" style="margin-left: 6px;" onclick="cancelDel(); return false;">No</button></div></div>',
			css: {zIndex:'999999999'}
		  });
		}
	}else{
		$.blockUI({
			message:'<br /><h5>For the month should be current month & milestone should be today date</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" style="margin-left: 10%;" onclick="cancelDel(); return false;">Ok</button></div></div>',
			css: {zIndex:'999999999'}
		  });
	}	
	
}
function send_convertactual(type){
  project_billing_type_value = $('#project_billing_type_value').val();
  // if(project_billing_type_value == 1){
    // var total = $('#total_price').val();
    // var total_gl_amt = $('#total_gl_amt').val();
    // total = Math.abs(total) + Math.abs(total_gl_amt);
    // var actual_worth_amount = $('#actual_worth_amount').val();
    // if(total > actual_worth_amount){
      // alert('Total amount should be less than the actual project value is ' + actual_worth_amount + '. Existing invoice raised total value is ' + total_gl_amt);
      // if(type == 'approval_request'){
        // return false;
      // }
    // }
  // }
	var month = $('#sp_date_invoice_21').val();
	if(month == current_month){
    flag = 0;
    fields = ['inventory_num','invoice_description','unit_price','price_after_discount'];
    $.each(fields, function (key, val) {
      $('.'+val).each(function() {
          if($(this).val() == ''){
            $(this).addClass('required_color');
            flag = 1;
          }else{
            $(this).removeClass('required_color');
            if(val == 'unit_price' || val == 'price_after_discount'){
              if($(this).val() == '0'){
                $(this).addClass('required_color');
                $(this).next('p').remove();
                $(this).after('<p style="color:red;">Zero not allowed</p>');
                flag = 1;
              }else{
                $(this).removeClass('required_color');
                $(this).next('p').remove();
              }
            }
          }
          
      });
    });
    if(flag == 1){
      return false;
    }
    if(type == 'approval_request'){
			$('#submit_convertactual_id').val('convert_with_approval_request')
		}
		negative_proviaional_sap();
		//$('#mymodal').modal('hide');		
		//$.unblockUI();		
		//$('#set-invoice-terms').submit();
	}else{
		$.blockUI({
			message:'<br /><h5>For the month should be current month & milestone should be today date</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" style="margin-left: 10%;" onclick="cancelDel(); return false;">Ok</button></div></div>',
			css: {zIndex:'999999999'}
		  });
	}
}

function negative_proviaional_sap(){

						$.blockUI({
				message:'<h4 style="color: white;  margin-top: 2px;">Processing</h4><img src="assets/img/ajax-loader.gif" />',
				css: {background:'#666', border: '2px solid #999', padding:'4px', height:'35px', color:'#333',zIndex:'999999999'}
			});

	        var ApiData = new Object();
            var SapData = new Object();        
            var SubDatas = new Object();        
            var invoiceType = $("#invoice_type_list").val();
            var dueDate = "<?PHP echo date("Y-m-d"); ?>";
			//var posting_date = $("#posting_date_v").val();
			var posting_date = "<?PHP echo date("Y-m-d"); ?>";
            //var invoiceAmount = '-'+$("#total_price").val();
            var invoiceAmount = "<?PHP echo $amount; ?>";
            var expectid = $("#expectid").val();
            var currency = $("#bp_currency").val();
            var gl_account = $("#gl_account").val();
            var card_code = $("#card_code").val();
            var entity = $("#entity").val();
            var remark = $(".remarks").val();
            var lead_id = "<?php echo "PRJ".$invoice[0]->lead_id ?>";      
            //remark = remark.trim();
            invoiceType = invoiceType.toLowerCase();
			
			
               var JournalEntryLines = new Object();
                SapData.ReferenceDate = posting_date;
                SapData.TaxDate = posting_date;
                SapData.DueDate = dueDate;
                SapData.Memo = remark;
				var CostingCodeJE =$('#CostingCodeJE').val();
				var CostingCodeJE2 =$('#CostingCodeJE2').val();
				var CostingCodeJE3 =$('#CostingCodeJE3').val();
				var Credit1 = null;
				var FCCredit1 = null;
				if((entity==1 && currency=='INR') || (entity==2 && currency=='SGD') || (entity==3 && currency=='$') || (entity==4 && currency=='AUD') || (entity==7 && currency=='MYR')){
					/*Credit1 = invoiceAmount;
					//FCCredit1 = null;*/
					
					/* Credit datas */
                JournalEntryLines[0] = {
                    "AccountCode": gl_account,
                    "Credit": null,
                    "Debit": invoiceAmount,
                    "FCDebit": null,
                    "FCCredit": null,
					          "FCCurrency":null,
                    "CostingCode": (CostingCodeJE)?CostingCodeJE:null,
                    "CostingCode2": (CostingCodeJE2)?CostingCodeJE2:null,
                    "CostingCode3": (CostingCodeJE3)?CostingCodeJE3:null
                };
                /* Debit datas */
                JournalEntryLines[1] = {
                    //"AccountCode": card_code,
                    "ShortName": card_code,
                    "Credit": invoiceAmount,
                    "Debit": null,
                    "FCDebit": null,
                    "FCCredit": null,
					          "FCCurrency":null,
                    "CostingCode": (CostingCodeJE)?CostingCodeJE:null,
                    "CostingCode2": (CostingCodeJE2)?CostingCodeJE2:null,
                    "CostingCode3": (CostingCodeJE3)?CostingCodeJE3:null
                };
					
                    
				}
				else{
					/*Credit1 = null;
					FCCredit1 = invoiceAmount;*/
					
					/* Credit datas */
                JournalEntryLines[0] = {
                    "AccountCode": gl_account,
                    "Debit": null,
                    "Credit": null,
                    "FCDebit": invoiceAmount,
                    "FCCredit": null,
					          "FCCurrency":currency,
                    "CostingCode": (CostingCodeJE)?CostingCodeJE:null,
                    "CostingCode2": (CostingCodeJE2)?CostingCodeJE2:null,
                    "CostingCode3": (CostingCodeJE3)?CostingCodeJE3:null
                };
                /* Debit datas */
                JournalEntryLines[1] = {
                    //"AccountCode": card_code,
                    "ShortName": card_code,
                    "Debit": null,
                    "Credit": null,
                    "FCDebit": null,
                    "FCCredit": invoiceAmount,
					          "FCCurrency":currency,
                    "CostingCode": (CostingCodeJE)?CostingCodeJE:null,
                    "CostingCode2": (CostingCodeJE2)?CostingCodeJE2:null,
                    "CostingCode3": (CostingCodeJE3)?CostingCodeJE3:null
                };
					
				}
				
                /* Credit datas */
                /*JournalEntryLines[0] = {
                    "AccountCode": gl_account,
                    "Debit": 0,
                    "Credit": Credit1,
                    "FCDebit": 0,
                    "FCCredit": FCCredit1,
					"FCCurrency":currency,
                    "CostingCode": (CostingCodeJE)?CostingCodeJE:null,
                    "CostingCode2": (CostingCodeJE2)?CostingCodeJE2:null,
                    "CostingCode3": (CostingCodeJE3)?CostingCodeJE3:null
                };*/
                /* Debit datas */
                /*JournalEntryLines[1] = {
                    //"AccountCode": card_code,
                    "ShortName": card_code,
                    "Debit": Credit1,
                    "Credit": 0,
                    "FCDebit": FCCredit1,
                    "FCCredit": 0,
					"FCCurrency":currency,
                    "CostingCode": (CostingCodeJE)?CostingCodeJE:null,
                    "CostingCode2": (CostingCodeJE2)?CostingCodeJE2:null,
                    "CostingCode3": (CostingCodeJE3)?CostingCodeJE3:null
                };*/
                industries = <?php echo json_encode($DocumentLines_industry[0]) ?>;
                $.each(industries, function(index, value){
                  JournalEntryLines[0][index] = value;
                  JournalEntryLines[1][index] = value;
                });
                SapData.JournalEntryLines = JournalEntryLines;    
                ApiData.SapData = SapData;
                ApiData.Entity = entity;
                /*Adding additional datas into Api data*/
                SubDatas.expectid = expectid;
                ApiData.SubDatas = SubDatas;

                var myString = JSON.stringify(ApiData);
                var url = site_base_url+'api_leads/sap_api/sap_journal_entries';  
                $.ajax({
                    method: "POST",
                    contentType: 'application/json;charset=UTF-8',
                    url: url,
                    dataType: 'json',
                    data: myString,
                    success: function(data) {
                        var resObj = data.response;
                        if(resObj.hasOwnProperty("JdtNum")){
							//cancelInvoiceTax(resObj.JdtNum);
							$('#jtnum').val(resObj.JdtNum);
							formSubmit();
							$.unblockUI();
                           /*setTimeout(function(){	
						    // $.unblockUI();
                            $.blockUI({
								message:'<br /><h5>Negative invoice request push to SAP</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" onclick="formSubmit(); return false;">Ok</button></div></div>',
	                            css: {zIndex:'999999999'}
							});	
							 //$("#frm").submit();
						   }, 400);*/
                        }else{
							$('#sap_push').removeAttr('disabled');
							$.unblockUI();
                            //confirm(resObj);	
                            $.blockUI({
								message:'<br /><h5>'+resObj+'</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">Ok</button></div></div>',
	                            css: {zIndex:'999999999'}
							});								
                        }     
                    },
                    error: function(e){
						$('#sap_push').removeAttr('disabled');
						$.unblockUI()
                        //confirm(e.statusText);
						$.blockUI({
								message:'<br /><h5>'+e.statusText+'</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;">Ok</button></div></div>',
	                            css: {zIndex:'999999999'}
							});
                    }
                });  
	
}

var invoice_type = $("#invoice_type_list").val();
change_invoice_type(invoice_type);
function change_invoice_type(invoice_type){
	var invoice_view = "Add invoice - " + invoice_type;
	$(".modal-title").html(invoice_view);
	if(invoice_type=="Provisional"){
		//$(".modal-header").css("background-color", "#D2691E");
		$("#customFields th").css("background-color", "#D2691E");
		$(".invoice_submit").css("background-color", "#D2691E");
		$(".invoice_submit").css("border", "1px solid #D2691E");
	}
	else{
		//$(".modal-header").css("background-color", "#228B22");
		$("#customFields th").css("background-color", "#228B22");
		$(".invoice_submit").css("background-color", "#228B22");
		$(".invoice_submit").css("border", "1px solid #228B22");
	}
}
function calculateDiscount(){
 	var total_before_discount = $('#total_before_discount').val();
	var discount_price = $('#discount_price').val();
	if(parseInt(discount_price) > parseInt(total_before_discount)){
		$('#discount_price + p').remove();
		$('#discount_price').after('<P style="color:red;"> less than '+total_before_discount+' </p>');		
		$('#discount_price').css('border', '2px solid red');
		$('#discount_price').val('');
		$('#total_price').val(total_before_discount);
		$('#discount_p').text('');	
	}else{
		$('#discount_price + p').remove();
		$('#discount_price').removeAttr('style');
	if(total_before_discount != '' && discount_price != ''){
		var price = parseFloat(total_before_discount)- parseFloat(discount_price);
		$('#total_price').val(price.toFixed(2));		
		var res = discount_price*100/total_before_discount;	
		$('#discount_p').text('('+res.toFixed(2)+'%)');	
	}
	}
}

$( document ).ajaxSuccess(function( event, xhr, settings ) {	

	if(settings.target=="#output2") {
		$('.payment-profile-view:visible').slideUp(400);
		$('.payment-terms-mini-view1').html(xhr.responseText);
		$('#set-invoice-terms').remove();
		paymentProfileView();
		$('#show_files').empty();
		
	}
	event.preventDefault();
});
$(function(){
	  var project_billing_type_value = <?= $project_billing_type_value; ?>;	  
    var inventory_item = <?php echo json_encode($inventory_item); ?>;
	  var type = "<?php echo $type; ?>"
	  $("#customFields").on('click','.addCF',function(){

		  var unit_ptice_input ='';
		  var inventory_item_number ='';
		  var qr_td='';
                  var i = Math.round((new Date()).getTime() / 500);
                  //var rate_comments='<input class="textfield" type="text" name="rate_comments[]" maxlength="100" value="">';
                  var rate_comments ='<textarea data-notified="1" data-info="'+i+'" class="text_area_css mb textfield rate_comments" name="rate_comments[]" maxlength="50" ></textarea><p style="display:none;color:blue;" class="rate_comment_notification" id="rate_comment_info_'+i+'">Rate comments will gets Reflected in Invoice layout</p>';
		  if( project_billing_type_value != 1){
		  unit_ptice_input ='<input type="number"  name="unit_price[]" step="any" <?= $min ?> id="unit_price_'+i+'" class="text_css mb textfield unit_price uprice_r_td decimal" onkeyup="copyUnitValue('+i+')" />';
		  qr_td='<td class="qty_td"><input type="number" name="qty[]" onkeypress="if(this.value.length==7) return false;" maxLength="7" step="any" min="0" onChange="calculateQtyRate('+i+')" id="qty_'+i+'" value=""  class="text_css  mb textfield decimal"/></td><td class="qty_td"><input type="number" name="rate[]" step="any" onChange="calculateQtyRate('+i+')" min="0" id="rate_'+i+'" value=""  class="text_css mb textfield decimal"/></td>';
		  }else{
		  unit_ptice_input ='<input type="number"  name="unit_price[]" step="any" <?= $min ?> id="unit_price_'+i+'" class="text_css mb textfield required unit_price uprice_td decimal" onChange="calculatePrice('+i+')" onkeyup="copyUnitValue('+i+')" />';
		  }
		  

		  if(type == 'item'){
        inventory_option = '';
        $.each( inventory_item, function( key, value ) {
               inventory_option += '<option value="'+value['item_number']+'">'+value['item_number']+' - '+value['item_description']+'</option>';
        });
			inventory_item_number = '<td><select name="inventory_num[]" class="text_area_css mb required inventory_num"><option value="">Select Inventory</option>'+inventory_option+'</select></td>';
		  }else{
			inventory_item_number = '';
		  }
			
		 
		
      $("#customFields").append('<tr class="add_row">'+inventory_item_number+'<td><textarea class="text_area_css mb textfield invoice_description required" name="invoice_description[]" maxlength="50"></textarea></td>'+qr_td+'<td >'+unit_ptice_input+'</td><td><input type="number" name="discount[]" min="0" max="100" class="text_css mb textfield discount readonly_css" id="discount_'+i+'" readonly/></td><td><input type="number"   name="price_after_discount[]"  step="any" <?= $min ?> id="price_after_discount_'+i+'" class="text_css mb textfield required price_after_discount decimal" onChange="calculatePrice('+i+')" /></td><td><div class="act"><img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF" />&nbsp; &nbsp;<img src="<?= base_url()?>assets/img/collapse.png" class="icon remCF" /> </div></td><td>'+rate_comments+'</td></tr>');
			$(this).parent('.act').html('<img src="<?= base_url()?>assets/img/collapse.png" class="icon remCF" />');
			
      if($(this).hasClass('act') && $(this).find('.remCF').length==0)
			{
			
				$(this).append('<a class="remCF" href="#"></a>');
				
			}
			decimalValue();
		});
    
    $("#customFields").on('click','.remCF',function(){
			
			var cloneRow = $(this).closest("tr");
			var prev = cloneRow.siblings().length; 
			
			if(prev == 1){				
				cloneRow.siblings().find('.remCF').remove();
			}
			
			if($(this).siblings('.addCF').length == 1){			
				cloneRow.prev('tr').find('.act').append('&nbsp; &nbsp;<img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF" />');
				// cloneRow.prev('tr').find('.act').empty().append('<div class="act"><img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF" /><img src="<?= base_url()?>assets/img/collapse.png" class="icon remCF"><div>');
			}
			
			cloneRow.remove();
				
			calculateTotalPrice();
			return false;
			
		});
		
		var options_updt = { 
			target:      '#output2',   // target element(s) to be updated with server response 
			beforeSubmit: showRequest2, // pre-submit callback 
			success:      ''  // post-submit callback 
		}; 
		$('#set-invoice-terms').ajaxForm(options_updt);

		$('#sp_date_invoice_2').datepicker({
			dateFormat: 'dd-mm-yy', 
			minDate: '0',
			beforeShow : function(input, inst) {
				$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
			}
		});
		
		$('#due_date').datepicker({
			
			dateFormat: 'dd-mm-yy', 
			minDate: '0',
			beforeShow : function(input, inst) {
				var payment_term_list = $("#payment_terms_list").val();
				$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
			}
		});
		
		$("#show_files").delegate("a.del_file","click",function() {
			var str_delete = $(this).attr("id");
			
			var result = confirm("Are you sure you want to delete this attachment?");
			if (result==true) {
				$('#'+str_delete).parent("div").remove();
			}
		});
		$("#uploadFile").delegate("a.del_file","click",function() {
			var str_delete = $(this).attr("id");
			
			var result = confirm("Are you sure you want to delete this attachment?");
			if (result==true) {
				$('#'+str_delete).parent("div").remove();
			}
		});
		var d = new Date();		
		var fYear = parseInt(d.getFullYear()) + parseInt(10);
		var year = d.getFullYear() +':'+ fYear;		
		$('#month_year_invoice').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'MM yy',
			showButtonPanel: true,
			yearRange: year,
			stepMonths: '0', 
			minDate: '0',
			onClose: function(input, inst) {
				var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
			},
			beforeShow: function(input, inst) {
				if ((selDate = $(this).val()).length > 0) 
				{
					iYear = selDate.substring(selDate.length - 4, selDate.length);
					iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
					$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
					$(this).datepicker('setDate', new Date(iYear, iMonth, 1));
				}
				$('#ui-datepicker-div')[ $(input).is('[data-calendar="false"]') ? 'addClass' : 'removeClass' ]('hide-calendar');
			}
		});
	
});
function copyUnitValue(index){
  var unit_price = $('#unit_price_'+index).val();	 
  var price_after_discount = $('#price_after_discount_'+index).val(unit_price);
  calculatePrice(index);
}
function calculateQtyRate(index){
  var qty = $('#qty_'+index).val();
  var rate = $('#rate_'+index).val();

   var qty_val = $('#qty_'+index).val();
  var rate_val = $('#rate_'+index).val();

  if(qty_val!= '' || rate_val!=''){
	var uni_price = qty_val*rate_val;
	uni_price = uni_price.toFixed(2);
	$('#unit_price_'+index).val(uni_price);
	$('#unit_price_'+index).prop("readonly", true);
  }else{
	$('#unit_price_'+index).val();
	$('#unit_price_'+index).prop("readonly", false);
	$('#unit_price_'+index).attr('class','text_css required mb textfield');	
  }
  
  if(qty != '' && rate !=''){
	console.log("qty");
	  var u_price = qty*rate;
	  u_price = u_price.toFixed(2);
	  $('#unit_price_'+index).val(u_price);
    $('#price_after_discount_'+index).val(u_price);
	  calculatePrice(index);
  }
 
}
 var project_billing_type_value = <?= $project_billing_type_value; ?>;	 
function calculatePrice(index){
	var unit_price = $('#unit_price_'+index).val();	 
	var price_after_discount = $('#price_after_discount_'+index).val();
	
	if(price_after_discount < 0){
		 

		if( project_billing_type_value != 1){
			var qty_val = $('#qty_'+index).val();
			var rate_val = $('#rate_'+index).val();

			if(qty_val!= '' || rate_val!=''){
			var uni_price = qty_val*rate_val;
			uni_price = uni_price.toFixed(2);
			$('#unit_price_'+index).val(uni_price);
			$('#unit_price_'+index).prop("readonly", true);
			}else{
				$('#unit_price_'+index).val();
				$('#unit_price_'+index).prop("readonly", false);
				$('#unit_price_'+index).attr('class','text_css required mb textfield unit_price');	
			}
  
		/*$('#qty_'+index).attr('class','text_css mb textfield');
	    $('#rate_'+index).attr('class','text_css mb textfield');
		$('#qty_'+index).removeAttr('style');
	    $('#rate_'+index).removeAttr('style');*/
		}else{
		$('#unit_price_'+index).attr('class','text_css mb textfield unit_price');	
        $('#unit_price_'+index).removeAttr('style');		
		}
	}else{
		if( project_billing_type_value != 1){
			var qty_val = $('#qty_'+index).val();
			var rate_val = $('#rate_'+index).val();

			if(qty_val!= '' || rate_val!=''){
				var uni_price = qty_val*rate_val;
				uni_price = uni_price.toFixed(2);
				$('#unit_price_'+index).val(uni_price);
				$('#unit_price_'+index).prop("readonly", true);
			}else{
				$('#unit_price_'+index).val();
				$('#unit_price_'+index).prop("readonly", false);
				$('#unit_price_'+index).attr('class','text_css required mb textfield unit_price');	
			}	
		/*$('#qty_'+index).attr('class','text_css required mb textfield');
	    $('#rate_'+index).attr('class','text_css required mb textfield');
		$('#qty_'+index).removeAttr('style');
	    $('#rate_'+index).removeAttr('style');*/
		}else{
		$('#unit_price_'+index).attr('class','text_css required mb textfield unit_price');	 
		$('#unit_price_'+index).removeAttr('style');
		}
	}
	if(parseInt(price_after_discount) > parseInt(unit_price)){	
        $('#price_after_discount_'+index+' + p').remove();	
		$('#price_after_discount_'+index).after('<P style="color:red;">Amount less than '+unit_price+'</p>');
		$('#price_after_discount_'+index).css('border', '2px solid red');
		$('#price_after_discount_'+index).val('');
		$('#discount_'+index).val('');
		//$('#total_lc_'+index).val(unit_price);	
	}else{
		$('#price_after_discount_'+index+' + p').remove();
		$('#price_after_discount_'+index).removeAttr('style');
		if(price_after_discount != '' && unit_price !=''){		
		var res = (unit_price - price_after_discount)*100/unit_price;
		 //$('#total_lc_'+index).val(price_after_discount);
		 $('#discount_'+index).val(res.toFixed(2));	
		}
	  calculateTotalPrice();
	}
}
function alertMessageShow(val){
	$.blockUI({
		message:'<br /><p>'+val+'</p><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;" style="margin-left: 35px;">Cancel</button></div></div>'
	});
}
function cancelDel() {
	$("#saveform").val(0);
    $.unblockUI();
}
function calculateTotalPrice(){
	var t=0;
	$('.price_after_discount').each(function(){
		if($(this).val() != ''){
		 t=t+parseFloat($(this).val());	 
		}		
	})
	$('#total_before_discount').val(t.toFixed(2));
	$('#total_price').val(t.toFixed(2));
	calculateDiscount();
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

	return true;
}
function showRequest2()
{
	$('#rec_paymentfadeout').hide();
	$('#sp_form_jobid').val(curr_job_id);
	$(".payment-terms-mini-view1").css("display","block");
	$(".payment-received-mini-view1").css("display","none");
	var valid_date = true;
	var date_entered = true;
	var errors = [];

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
    var error = false;
	if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = dd+'-'+mm+'-'+yyyy;
	var pdate2 = $.trim($('#sp_date_invoice_2').val());	

	if (($.trim($('#sp_date_invoice_2').val()) == '') && ($.trim($('#month_year_invoice').val()) == '') ) {
		//date_entered = false;
	}
	if ($('#sp_form_jobid').val() == 0) { 
		errors.push('Invoice not properly loaded!');
	}
	if(($.trim($('#milestone_name_1').val()) == '')) {
		errors.push('<p>Enter Payment Milestone Name.</p>');
        $('#milestone_name_1').css('border', '2px solid #ff000085'); 
         
	}
	else{
            $('#milestone_name_1').css('border','1px solid #BBBBBB');
        }
	if(($.trim($('#sp_date_invoice_2').val()) == ''))  { //|| valid_date == false) {
		//errors.push('<p>Enter valid Date of Milestone date.</p>');
	}
	if (valid_date == false) {
		errors.push('<p>You have selected an invalid date</p>');
	}
	if(($.trim($('#month_year_invoice').val()) == '')) {
		//errors.push('<p>Enter valid Date For the Month.</p>');
	}
	if(($.trim($('#invoice_type').val()) == '')) {
		//errors.push('<p>Select Invoice type.</p>');
	}
	if(($.trim($('#project_billing_type_value').val()) == '')) {
		//errors.push('<p>Select Project type.</p>');
	}	
	if(($.trim($('.tax_selection').val()) == '')) {
		//errors.push('<p>Select Tax.</p>');
	}
	
	$('input.required,select.required,textarea.required').each(function(i){
        if(!$(this).val()){
            $(this).css('border', '2px solid #ff000085'); 
            error = true;
        }else{
            $(this).css('border','1px solid #BBBBBB');
        }
    });

	/*if(($.trim($('#remark').val()) == '')) {		
		error = true;
		$('#remark').css('border', '2px solid #ff000085'); 
	}
	else{
            $(this).css('border','1px solid #BBBBBB');
        }*/
	if(error) {
       errors.push('<p>All red fields are required!!!!! </p>');
    }
	$('input.required,select.required,textarea.required').blur(function(){
        if(!$(this).val()){
            $(this).css('border', '2px solid #ff000085'); 
            error = true;
        }else{
            $(this).css('border','1px solid #BBBBBB');
        }
    });
	if (errors.length > 0) {
		//alert(errors.join('\n'));
		setTimeout('timerfadeout()', 8000);
		$('#rec_paymentfadeout').show();
		$('#rec_paymentfadeout').html(errors.join(''));		
		return false;
	}else{
		if($("#saveform").val()==0){
		$('#mymodal').modal('hide');
		}
	}
}
var area = document.getElementById("remark");
var message = document.getElementById("message");
var annexure = document.getElementById("annexure");
var annexure_message = document.getElementById("annexure_message");
var maxLength = 201;	
var checkLength = function() {
    if(area.value.length <= maxLength) {
        message.innerHTML = (maxLength-area.value.length) + " characters remaining";
    }
    if(annexure.value.length <= maxLength) {
        annexure_message.innerHTML = (maxLength-annexure.value.length) + " characters remaining";
    }
}
setInterval(checkLength, 300);

function download_files(job_id,f_name){
	window.location.href = site_base_url+'project/download_file/'+job_id+'/'+f_name;
}

function customerApprovalMsg(){			
		alertMessageShows('The customer is waiting for approval from finance team!');
	}
function projectApprovalMsg(){			
		alertMessageShows('The project is waiting for approval from finance team!');
	}
function alertMessageShows(val){
	$.blockUI({
		message:'<br /><p>'+val+'</p><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" onclick="cancelDel(); return false;" >Close</button></div></div>',
		css : { 'zIndex': '99999', top : '40%'}
	});
}
function openCalendar(field){
	if(field == 'formonth'){
		$('#month_year_invoice').datepicker('show');
	}else{
		$('#sp_date_invoice_2').datepicker('show');
	}
}

$( document ).on( "focusout", ".rate_comments", function() {
    var info_id = $(this).data('info');
    var element = "rate_comment_info_"+info_id;
    var notified = $(this).data('notified');
    if (notified == '1') {
        $("#"+element).show();
        setTimeout(function() { 
            $("#"+element).hide();
        }, 4000);
    }
    $(this).data("notified", '2');
});


$("#annexure").one( "focusout", function() { 
    var notified = $(this).data('notified');
    if (notified == '1') {
        $("#annexure_info").show();
        setTimeout(function() { 
            $("#annexure_info").hide();
        }, 4000);
    }
    $(this).data("notified", '2');
});
</script>
