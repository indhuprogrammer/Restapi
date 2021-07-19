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
</style>
<style>
#accordion {
    margin-bottom: 15px;
}
.ui-accordion-header-active, .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    border: 1px solid #d3d3d3;
    background: #4b6fb9 url(images/ui-bg_glass_75_e6e6e6_1x400.png) 50% 50% repeat-x;
    font-weight: normal;
    color: #ffffff;
	text-align:center
}
.buttons button.positive {
    font-size: 11px;
}
select.width200px {
    width: 210px;
	float:none;
}
.ui-accordion .ui-accordion-content {
    padding: 15px;
}
#accordion .table>tbody>tr>td, #accordion .table>tbody>tr>th, #accordion .table>tfoot>tr>td, #accordion .table>tfoot>tr>th, #accordion .table>thead>tr>td, #accordion .table>thead>tr>th {
    border: 1px solid #ddd!important;
}
#accordion .table th {
    background-color: #EAEBFF;
}
.hide{
	display:none;
}
.act {
		text-align: left;
	}
.org_inv_col{
	background: #c7c9f7 !important;
}
.align_tab th {
	text-align: center !important;
}	
</style>
<script>
   /**
     * EFECTO PARA FLECHAS EN ACORDEON
     */    
    $(document).on('show','.accordion', function (e) {     
         //$('.accordion-heading i').toggleClass(' ');
         $(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });    
    $(document).on('hide','.accordion', function (e) {
        $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });
</script>
<?php $min='min="0"'; if($invoice_type == 'Provisional' && $approve_status == 'Closed') { $min=''; } ?>
<?php //$expect_id = ''; ?>
<?php $attributes = array('id' => 'set-invoice-terms','name' => 'set-invoice-terms','class'=> 'form-horizontal'); ?>
						<?php echo form_open_multipart("project/set_invoice_credit_note/$expect_id", $attributes); ?>
						<!--form id="set-payment-terms" -->
						<input type="hidden" name="inventory_type" id="type_invoice" value="<?php echo $type; ?>"
							<input type="hidden" id="filefolder_id" name="filefolder_id" value="<?php echo $ff_id; ?>">
							<?php if($expect_id){ 
								//This is not including the credit amount for current invoice
								$total_credit_amt = abs($total_credit_amt) - abs($amount);
							}
							?>
							<input type="hidden" id="total_credit_amt" value="<?php echo $total_credit_amt; ?>">
							<input type="hidden" id="event" value="<?php echo $event; ?>">
							<input type="hidden" id="parent_project_billing_type" value="<?php echo $parent_project_billing_type ?> ">
                                                        <input type="hidden" name="einvoice" id="einvoice" value="<?php echo $einvoice; ?>">
                                                        <input type="hidden" id="einvoice_status" value="<?php echo $einvoice_status; ?>">
								<div class="row">
								  <div class="col-sm-12 pull-left">
                  <table class="table" id="table_cus" style="width: 100%;">
									 <tbody> 
									 <tr>
									 	<th style="width: 115px;">Customer Code invoice</th> 
									 		<td> 
											 	<input type="text" readonly name="customer_code" id="customer_code" value= "<?php echo $sap_card_code; ?>" class="textfield mb readonly_css" />
										    </td> 
										<th style="width: 110px;">Posting Date </th> 
									     <td> 
										 	<input type="text" readonly name="posting_date" id="posting_date" <?= !empty($disabled)?'disabled="disabled"':''?> value= "<?php echo !empty($posting_date)?date('d-m-Y',strtotime($posting_date)):''; ?>" class="textfield mb readonly_css" />
										</td> 
										
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
									
									 
									 <!-- new column -->

									 <tr>
									<th class="org_inv_col">
										Orignal Payment Milestone
									</th> 
									<td style="word-wrap:break-word;" colspan="3"> 
									<input type="text" readonly name="sp_date_1" id="milestone_name_1" disabled value= "<?php echo $parent_project_milestone_name; ?>" maxlength="50" class=" textfield readonly_css" />
										</td>
									<th class="org_inv_col">Original Invoice Total Amount </th> <td> 
									<input type="text" readonly  value= "<?php echo $original_invoice_amount; ?>" id="original_inv_amount" maxlength="50" class=" textfield readonly_css" />
									</td> 
									
									</tr>

									<tr>
									<th class="org_inv_col">
										Original For The Month and Year
									</th> 
									<td> 
									<input type="text" disabled class="textfield readonly_css" value= "<?php echo $parent_month_year; ?>" name="parent_month_year" />
										</td>
									<th class="org_inv_col">Original Invoice Type </th> <td> 
									<input type="text" readonly value="<?= $parent_invoice_type ?>" disabled name="sp_date_2" id="" class="textfield readonly_css"  />
									</td> <th class="org_inv_col">Original Invoice No.</th> <td style="vertical-align: middle"> 
									<input type="text" readonly value="<?= $parent_invoice_no ?>" disabled name="sp_date_2" id="" class="textfield readonly_css"  />
									</td>
									</tr>
									<tr>
									<th class="org_inv_col">Original Milestone Date</th> <td style="vertical-align: middle"> 
										<input type="text" value="<?php echo $parent_expected_date ?>" name="sp_date_2" class="textfield readonly_css"  />
									</td>
									<th class="org_inv_col">Original Invoice Due Date</th> <td> 
									 <input type="text" disabled class="textfield readonly_css" value= "<?php echo $parent_due_date; ?>" name="parent_due_date" />
									 </td>
									 <th class="org_inv_col">Original Invoice Posting Date</th> <td> 
									 <input type="text" disabled class="textfield readonly_css" value= "<?php echo $parent_posting_date; ?>" name="parent_posting_date" />
									 </td>
									 </tr>
									 
									 <tr><th>Customer Address</th> <td colspan="5"> 
									 <input type="hidden" name="cutomer_address" value="<?= $address_id ?>" >
									 
									 <?php foreach($customer_address as $address){?>
									  <?php 
										if($address->address_id == $address_id){ 
                      $add = customer_address_view($address->address_id);
											echo Strip_tags($add);
										}
										?>
									 <?php } ?>
									 </td></tr>
									 <tr><th>Project Manager</th><td colspan="2" style="font-size: 11px;"><?php echo $project_manager ?></td><th>Project Name</th><td colspan="2" style="font-size: 11px;"><?php echo $lead_title?></td></tr>									     									     
									 </tbody>
									</table>
								 </div>								
							   </div>

							   <div id="accordion">
								<h4> Original Invoice Details</h4>
								
								<div>
									<table class="table align_tab">
									<thead>
									<tr>
										<?php if($type == 'item'){ ?>
											<th style="width: 170px;">Non Inventory Item</th>
										<?php } ?>
										<th style="width: 170px;">Description</th>
										<?php if($parent_project_billing_type != 1 ) { ?>
										<th style="width: 90px;"><?= project_type_name($parent_project_billing_type,'qty'); ?> </th>	
										<?php } ?>
										<?php if($parent_project_billing_type != 1 ) { ?>								  
										<th style="width: 90px;"><?= project_type_name($parent_project_billing_type,'rate'); ?></th>
										<?php } ?>	
										<th style="width: 120px;">Unit Price</th> 
										<th style="width: 90px;">Discount (%)</th>						
										<th style="width: 120px;">Price after Discount</th>
                                                                                <th style="width: 120px;">Rate Comments</th>
									</tr>
									</thead>
									<tbody>
									<?php if(!empty($parent_gl_accounts)){	
										$i=0;							
										foreach($parent_gl_accounts as $gl_account){ ?>									
										<tr class="add_row">
										<?php if($type == 'item'){ ?>
										<td align="center" maxlength="50">
									
									<?php foreach($inventory_item as $item){ 
											 if($gl_account->inventory_number == $item->item_number){?>
											<?php 	 echo $item->item_number ;
										} } ?>
										</td>
									<?php } ?>
											<td align="left"><?= trim(nl2br($gl_account->invoice_description)); ?></td>		
											<?php if($parent_project_billing_type != 1 ) { ?>
											<td align="center"><?= $gl_account->qty; ?></td>
											<td align="center"><?= $gl_account->rate; ?></td>
											<?php } ?>	
											<td align="center"><?= $expect_worth_name.' '.$gl_account->unit_price; ?></td>
											<td align="center"><?= $gl_account->discount; ?></td>
											<td align="center"><?= $expect_worth_name.' '.$gl_account->price_after_discount; ?></td>
                                                                                        <td align="center"><?= $expect_worth_name.' '.$gl_account->rate_comments; ?></td>
											
										</tr>
									<?php $i++;	} } ?>
									
									</tbody>
								</table>
							</div>
						</div>

							<div class="form-group">
							  <label class="col-sm-1 pull-left ">Payment Milestone *</label>
							  <div class="col-sm-9 col-sm-79 pull-left" style="margin-left: -10px;">
								<?php if(!$expect_id) {?>
								<input type="text"  name="sp_date_1" id="milestone_name_1" <?= !empty($disabled)?'disabled="disabled"':''?> value= "<?php echo 'Credit Note - '.$parent_project_milestone_name; ?>" maxlength="50" class="textfield" />
								<?php }else{?>
								<input type="text"  name="sp_date_1" id="milestone_name_1" <?= !empty($disabled)?'disabled="disabled"':''?> value= "<?php echo $project_milestone_name; ?>" maxlength="50" class="textfield" />
								<?php } ?>	
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
								$expected_date = date('d-m-Y');
								?>
							  <input type="text"  value="<?php echo $expected_date ?>" <?= !empty($disabled)?'disabled="disabled"':''?> name="sp_date_2" id="sp_date_invoice_21" class="textfield readonly_css"  />

							<?php } else { ?>
								<img src="assets/img/calender-icon.png" onclick="openCalendar('mile');" <?= !empty($disabled)?'class="hide"':''?>>
								<input type="text" data-calendar="true" <?= !empty($disabled)?'disabled="disabled"':'';?> value="<?php echo !empty($expected_date)?$expected_date:date('d-m-Y'); ?>" name="sp_date_2" id="sp_date_invoice_2" class="textfield readonly_css" style="width: 70%;" />
							<?php } ?>
							  </div>
							  <label class="col-sm-1 pull-left width_100" >Invoice Type *</label>
							  <div class="col-sm-20 pull-left" style="margin-left: -3px;">
								<input type="text" name="invoice_type" readonly value="Credit Note" id="invoice_type_list" class="textfield readonly_css">
							  </div>
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
								  <?php if($parent_project_billing_type != 1 ) { ?>
								  <th style="width: 90px;"><?= project_type_name($parent_project_billing_type,'qty'); ?> </th>	
								  <?php } ?>
                                  <?php if($parent_project_billing_type != 1 ) { ?>								  
								  <th style="width: 90px;"><?= project_type_name($parent_project_billing_type,'rate'); ?></th>
                                  <?php } ?>	
								  <th style="width: 120px;">Unit Price</th> 
								  <th style="width: 90px;display:none">Discount (%)</th>						
								  <th style="width: 120px;display:none">Price after Discount</th>
								  <!--th style="width: 90px;">Total (LC)</th-->
								  <?php if(empty($disabled)) { ?>	
								  <th style="width: 70px;">Action</th>
								  <?php } ?>
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
									  <td align="center"><textarea <?= !empty($disabled)?'disabled="disabled"':''?> class="text_area_css mb textfield required" name="invoice_description[]" maxlength="50" ><?= trim(str_replace('<br />','', $gl_account->invoice_description)); ?></textarea></td>		
									  <?php if($parent_project_billing_type != 1 ) { ?>
									  <td align="center" class="qty_td"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="qty[]" min="0" onkeypress="if(this.value.length==7) return false;" maxLength="7" step="any" onkeypress="return event.charCode != 45" onChange="calculateQtyRate(<?= $i?>)" id="qty_<?= $i?>" value="<?= $gl_account->qty; ?>"  class="text_css <?php echo !empty($gl_account->qty)? '':''; ?> mb textfield decimal"/></td>
									  <td align="center" class="qty_td"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="rate[]" min="0" onkeypress="return event.charCode != 45" step="any" onChange="calculateQtyRate(<?= $i?>)" id="rate_<?= $i?>" value="<?= $gl_account->rate; ?>"  class="text_css <?php echo !empty($gl_account->rate)? '':''; ?> mb textfield decimal"/></td>
									   <?php } ?>	
									  <td align="center">
									  <?php if($parent_project_billing_type != 1 ) { ?> 
										<input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="unit_price[]" <?= $min ?> id="unit_price_<?= $i?>" value="<?= $gl_account->unit_price; ?>" step="any" class="text_css mb textfield unit_price uprice_r_td decimal required" onkeypress="return event.charCode != 45" onkeyup="copyUnitValue(<?= $i?>)" readonly/> 
									  <?php }else { ?>
										<input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" <?= $min ?> name="unit_price[]" step="any" id="unit_price_<?= $i?>" 
												value="<?= $gl_account->unit_price; ?>" onChange="calculatePrice(<?= $i?>)" onkeyup="copyUnitValue(<?= $i?>)" onkeypress="return event.charCode != 45"  class="text_css <?php echo !empty($gl_account->unit_price)? 'required':''; ?> mb textfield unit_price decimal" />
										<?php }?></td>
									  <td class="hide"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" min="1" max="100" name="discount[]" id="discount_<?= $i?>" value="<?= $gl_account->discount; ?>" readonly class="text_css mb textfield discount readonly_css"/></td>
									  <td class="hide"><input  <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="price_after_discount[]" <?= $min ?> step="any"  id="price_after_discount_<?= $i?>" value="<?= $gl_account->price_after_discount; ?>" class="text_css textfield required mb price_after_discount decimal" onChange="calculatePrice(<?= $i?>)" /></td>	
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
								  <td align="center"><textarea <?= !empty($disabled)?'disabled="disabled"':''?> class="text_area_css mb textfield required" name="invoice_description[]" maxlength="50"></textarea></td>
								  <?php if($parent_project_billing_type != 1 ) { ?>
								  <td align="center" class="qty_td"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" onkeypress="return event.charCode != 45" name="qty[]" onkeypress="if(this.value.length==7) return false;" maxLength="7" min="0" id="qty_0" step="any" onChange="calculateQtyRate(0)" value=""  class="text_css mb textfield decimal"/></td>
								  <td align="center" class="qty_td"><input  <?= !empty($disabled)?'disabled="disabled"':''?> type="number" onkeypress="return event.charCode != 45" name="rate[]" min="0" id="rate_0" step="any" onChange="calculateQtyRate(0)"  value=""  class="text_css mb textfield decimal"/></td>
								  <?php } ?>	
								  <td align="center"> <?php if($parent_project_billing_type != 1 ) { ?><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number" name="unit_price[]"  step="any" <?= $min ?> id="unit_price_0" onChange="calculatePrice(0)" onkeyup="copyUnitValue(0)" onkeypress="return event.charCode != 45" class="text_css mb textfield unit_price uprice_r_td decimal"/> <?php }else { ?> <input type="number" name="unit_price[]" step="any" <?= $min ?>  id="unit_price_0" onChange="calculatePrice(0)" onkeyup="copyUnitValue(0)" onkeypress="return event.charCode != 45" class="text_css required mb textfield unit_price decimal"/> <?php }?></td>
								  <!--td><input type="number" name="rate[]" class="text_css required"/></td-->
								  <td class="hide" align="center"><input  <?= !empty($disabled)?'disabled="disabled"':''?> type="number" min="1" max="100" name="discount[]" id="discount_0" readonly class="text_css mb textfield discount readonly_css"/></td>
								  <td class="hide" align="center"><input <?= !empty($disabled)?'disabled="disabled"':''?> type="number"  name="price_after_discount[]" step="any" <?= $min ?>  id="price_after_discount_0" class="text_css textfield required mb price_after_discount decimal" onChange="calculatePrice(0)"/></td>	
								  <!--td><input type="text" name="total_lc[]" readonly class="text_css mb total_lc readonly_css" id="total_lc_0"/></td-->	
                                  <?php if(empty($disabled)) { ?>									  
								  <td> <div class="act"><img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF"/></div> </td>
								  <?php } ?>
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
								<textarea  name="annexure" id="annexure" style="height: 98px;"  class="textfield width_100_p " <?= !empty($disabled)?'disabled="disabled"':''?> maxlength="200" ><?php echo str_replace('<br />','', $annexure); ?></textarea>
								<p id="annexure_message" style="color:green;"></p>
                                                                <p style="color:blue;font-size:11px;"><b>Note :</b> Text entered in Annexure and Rate comments will gets reflected in Invoice</p>
							  </div>
							</div>
						 </div>
						   <div class="col-sm-6 pull-right">
							<table class="table total_table" >
									<tr class="hide">
										<th>Total Before Discount</th><td style="text-align: right; width: 100px;"><input type="text" id="total_before_discount" name="total_before_discount" readonly class="readonly_css textfield width_100 mb" <?= !empty($disabled)?'disabled="disabled"':''?> value="<?php echo $total_before_discount; ?>" style="text-align: right;" /></td>
									</tr>
									<tr class="hide">
										<th>Discount <span id="discount_p" style="margin-left: 25px;"></span> </th><td><input type="number" min="0" step="any" style="text-align:right;" id="discount_price" name="discount_price" onchange="calculateDiscount()" <?= !empty($disabled)?'disabled="disabled"':''?> style="text-align: right;" value="<?php echo $discount_price; ?>" class="textfield width_100 mb" /></td>
									</tr>
									<tr>
										<!--td>Tax</td><td><input type="text"  class="textfield width200px" /></td-->
									</tr>
									<tr>
										<th>Total</th><td><input type="text" id="total_price" <?= !empty($disabled)?'disabled="disabled"':''?> 
										value="<?php echo $amount; //need to assign variable ?>" name="total_price" readonly 
										class="readonly_css textfield width_100 mb" style="text-align: right;"/></td>
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
						  <div class="buttons" >
						     <?php if($sap_status == 'SAP') { ?>
						     <input type="hidden" name="submit" id="submit_convertactual_id" value="convertactual" />
							 <button type="button" name="submit" value="convertactual" onclick="send_convertactual();"  class="positive">Convert to Actual Invoice</button>
							 <?php }else{ ?>
							 <button type="button" name="submit" value="convertactual" onclick="customerApprovalMsg();"  class="positive">Convert to Actual Invoice</button>
							 <?php } ?>
						</div>
						 <?php }else{  ?>
						 <div class="buttons" style="margin-right: 5px;float: left;">
						 <input type="hidden" name="save" id="save_form_id" value="" />
							<button type="button" name="save" value="save" onclick="save_milestone();" class="positive">Save Milestone</button>
						</div>
						  <div class="buttons" >
						    <?php if($sap_status == 'SAP') { ?>
						    <input type="hidden" name="submit" id="submit_form_id" value="" />
							<button type="button" name="submit" value="submit" class="positive invoice_submit" onclick="send_approval();">Submit Credit Note & Send for approval</button>
							<?php }else{ ?>
							 <button type="button" name="submit" value="submit" class="positive invoice_submit" onclick="customerApprovalMsg();">Submit Credit Note & Send for approval</button>
							 <?php } ?>
						</div>
						 <?php } ?>
						</div>
						<input type="hidden" name="sp_form_jobid" id="sp_form_jobid" value="<?php echo $job_id; ?>" />
						<input type="hidden" name="project_billing_type" id="project_billing_type" value="<?php echo $parent_project_billing_type; ?>" />
						<input type="hidden" name="saveform" id="saveform" value="0" />
						<input type="hidden" name="expectid" id="expectid" value="<?php echo $expect_id; ?>" />		
						<input type="hidden" name="jtnum" id="jtnum" value="<?php echo $jtnum; ?>" />	
						<input type="hidden" name="division" id="division" value="<?php echo $division; ?>" />	
						<input type="hidden" name="lead_title" id="lead_title" value="<?php echo $lead_title; ?>" />	
						
						<input type="hidden" id="card_code" value="<?php echo !empty($invoice[0]->customer_code)?$invoice[0]->customer_code:$invoice[0]->sap_card_code;?>" >
                        <input type="hidden" id="due_date_val" value="<?php echo $invoice[0]->due_date; ?>" >
						<input type="hidden" id="posting_date_v" value="<?php echo $invoice[0]->posting_date; ?>" >
						<input type="hidden" id="entity" value="<?php echo $invoice[0]->entity; ?>">
						<input type="hidden" id="CostingCodeJE" value="<?php echo $CostingCodeJE; ?>">
						<input type="hidden" id="CostingCodeJE2" value="<?php echo $CostingCodeJE2; ?>">
						<input type="hidden" id="CostingCodeJE3" value="<?php echo $CostingCodeJE3; ?>">
				        <input type="hidden" id="gl_account" value="<?php echo $gl_account_v; ?>">
				        <input type="hidden" id="parent_expect_id" value="<?php echo $parent_expect_id; ?>" name="parent_expect_id">
				        
						
						<input type="hidden" name="sp_form_invoice_total" id="sp_form_invoice_total" value="0" />
						 <?php } ?>
                     </div>
					
			
						<?php echo form_close(); ?>
<?php if($parent_project_billing_type == 1) { ?>
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
    text-align: left;
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
	decimalValue();
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
</script>
<script>
var current_month = "<?= date('F Y');?>";
function formSubmit(){
	$('#mymodal').modal('hide');
	$.unblockUI();
	$('#submit_form_id').val('submit');
	$('#set-invoice-terms').submit();
}

function save_milestone(){
	var total = $('#total_price').val();
	var total_credit_amt = $('#total_credit_amt').val();
	total = Math.abs(total) + Math.abs(total_credit_amt);
	var ori_inv_amt = $('#original_inv_amount').val();
	if(total > ori_inv_amt){
		alert('Total amount should be less than the original invoice amount. ' + ori_inv_amt + ' Existing Credit Note amount is '+ Math.abs(total_credit_amt));
		return false;
	}

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

	var total = $('#total_price').val();
	var total_credit_amt = $('#total_credit_amt').val();
	total = Math.abs(total) + Math.abs(total_credit_amt);
	var ori_inv_amt = $('#original_inv_amount').val();
	if(total > ori_inv_amt){
		alert('Total amount should be less than the original invoice amount. ' + ori_inv_amt + ' Existing Credit Note amount is '+ Math.abs(total_credit_amt));
		return false;
	}
	
	var month = $('#sp_date_invoice_21').val();
	if(month == undefined){ 
		month = $('#month_year_invoice').val();
	}
	console.log('month '+ month + ' '+ current_month);
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
function send_convertactual(){
	var month = $('#sp_date_invoice_21').val();
	if(month == current_month){
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
	
	        var ApiData = new Object();
            var SapData = new Object();        
            var SubDatas = new Object();        
            var invoiceType = $("#invoice_type_list").val();
            var dueDate = $("#due_date_val").val();
			var posting_date = $("#posting_date_v").val();
            var invoiceAmount = '-'+$("#total_price").val();
            var expectid = $("#expectid").val();
            var currency = $("#bp_currency").val();
            var gl_account = $("#gl_account").val();
            var card_code = $("#card_code").val();
            var entity = $("#entity").val();
            var remark = $(".remarks").val();     
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
                    "Debit": null,
                    "Credit": invoiceAmount,
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
                    "Debit": invoiceAmount,
                    "Credit": null,
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
                    "FCDebit": null,
                    "FCCredit": invoiceAmount,
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
                    "FCDebit": invoiceAmount,
                    "FCCredit": null,
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
                           setTimeout(function(){	
						    $.unblockUI();
                            $.blockUI({
								message:'<br /><h5>Negative invoice request push to SAP</h5><div class="modal-confirmation overflow-hidden"><div class="buttons"><button type="submit" class="negative" onclick="formSubmit(); return false;">Ok</button></div></div>',
	                            css: {zIndex:'999999999'}
							});	
							 //$("#frm").submit();
						   }, 400);
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
var lead_title = "<?php echo $lead_title ?>";
var event = $("#event").val();;
change_invoice_type(invoice_type);
function change_invoice_type(invoice_type){
	var invoice_view = event + " "+ invoice_type + " - " + lead_title;
	$(".modal-title").html(invoice_view);
	if(invoice_type=="Credit Note"){
		//$(".modal-header").css("background-color", "#D2691E");
		$("#customFields th").css("background-color", "#ec5757");
		$(".invoice_submit").css("background-color", "#ec5757");
		$(".invoice_submit").css("border", "1px solid #ec5757");
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
		$('#discount_price').after('<P style="color:red;"> less than '+total_before_discount+' </>');		
		$('#discount_price').css('border', '2px solid red');
		$('#discount_price').val('');
		$('#total_price').val(total_before_discount);
		$('#discount_p').text('');	
	}else{
		$('#discount_price + p').remove();
		$('#discount_price').removeAttr('style');
	if(total_before_discount != '' && discount_price != ''){
		var price = parseFloat(total_before_discount)- parseFloat(discount_price);
		$('#total_price').val('-'+price.toFixed(2));		
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
	  var project_type = '<?= $parent_project_billing_type; ?>';
	  var type = "<?php echo $type; ?>";	  
	  $("#customFields").on('click','.addCF',function(){
		  var unit_ptice_input ='';
		  var inventory_item_number ='';
		  var qr_td='';
		  var i = Math.round((new Date()).getTime() / 1000);
		  if( project_type != 1){
		  unit_ptice_input ='<input type="number"  name="unit_price[]" step="any" <?= $min ?> id="unit_price_'+i+'" onkeypress="return event.charCode != 45" onkeyup="copyUnitValue('+i+')" class="text_css mb textfield unit_price uprice_r_td decimal required" onChange="calculatePrice('+i+')" />';
		  qr_td='<td class="qty_td"><input type="number" name="qty[]" onkeypress="return event.charCode != 45" onkeypress="if(this.value.length==7) return false;" maxLength="7" step="any" min="0" onChange="calculateQtyRate('+i+')" id="qty_'+i+'" value=""  class="text_css  mb textfield decimal"/></td><td class="qty_td"><input type="number" name="rate[]" step="any" onkeypress="return event.charCode != 45" onChange="calculateQtyRate('+i+')" min="0" id="rate_'+i+'" value=""  class="text_css mb textfield decimal"/></td>';
		  }else{
		  unit_ptice_input ='<input type="number"  name="unit_price[]" step="any" <?= $min ?> id="unit_price_'+i+'" class="text_css mb textfield required unit_price uprice_td decimal" onkeypress="return event.charCode != 45" onkeyup="copyUnitValue('+i+')" onChange="calculatePrice('+i+')"/>';
		  }

		if(type == 'item'){
			inventory_item_number = '<td><select name="inventory_num[]" class="text_area_css mb textfield inventory_num required"><option>Select Inventory</option><option value="ITM001L">ITM001L - SAP License</option></select></td>';
		  }else{
			inventory_item_number = '';
		  }
		  	//May be used in future - To be added in below customFields before icon
			//     
		  
			$("#customFields").append('<tr class="add_row">'+inventory_item_number+'<td><textarea class="text_area_css mb textfield required" name="invoice_description[]" maxlength="50"></textarea></td>'+qr_td+'<td >'+unit_ptice_input+'</td><td class="hide"><input type="number" name="discount[]" min="0" max="100" class="text_css mb textfield discount readonly_css" id="discount_'+i+'" readonly/></td><td class="hide"><input type="number"   name="price_after_discount[]"  step="any" <?= $min ?> id="price_after_discount_'+i+'" class="text_css mb textfield required price_after_discount decimal" onChange="calculatePrice('+i+')" /></td><td><div class="act"><img src="<?= base_url()?>assets/img/add-new-user.png" class="icon addCF" />&nbsp; &nbsp;<img src="<?= base_url()?>assets/img/collapse.png" class="icon remCF" /> </div></td></tr>');
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

function calculateQtyRate(index){
  var qty = $('#qty_'+index).val();
  var rate = $('#rate_'+index).val();

   var qty_val = $('#qty_'+index).val();
  var rate_val = $('#rate_'+index).val();

  if(qty_val!= '' || rate_val!=''){
	var uni_price = qty_val*rate_val;
	if(uni_price == 0){
		uni_price = '';
	}
	$('#unit_price_'+index).val(uni_price);
	$('#unit_price_'+index).prop("readonly", true);
  }else{
	$('#unit_price_'+index).val();
	$('#unit_price_'+index).prop("readonly", false);
	$('#unit_price_'+index).attr('class','text_css required mb textfield');	
  }
  
  if(qty != '' && rate !=''){
	  var u_price = qty*rate;
	  $('#unit_price_'+index).val(u_price);
	  $('#price_after_discount_'+index).val(u_price);
	  calculatePrice(index);
  }
 
}

function copyUnitValue(index){
var unit_price = $('#unit_price_'+index).val();	 
var price_after_discount = $('#price_after_discount_'+index).val(unit_price);
calculatePrice(index);
}
 var project_type = '<?= $parent_project_billing_type; ?>';	 
function calculatePrice(index){
	var unit_price = $('#unit_price_'+index).val();	 
	// var price_after_discount = $('#price_after_discount_'+index).val(unit_price);
	var price_after_discount = $('#price_after_discount_'+index).val();
	
	if(price_after_discount < 0){
		 

		if( project_type != 1){
			var qty_val = $('#qty_'+index).val();
			var rate_val = $('#rate_'+index).val();

			if(qty_val!= '' || rate_val!=''){
			var uni_price = qty_val*rate_val;
			
			$('#unit_price_'+index).val(uni_price);
			$('#unit_price_'+index).prop("readonly", true);
			}else{
				$('#unit_price_'+index).val();
				$('#unit_price_'+index).prop("readonly", false);
				$('#unit_price_'+index).attr('class','text_css required mb textfield');	
			}
  
		/*$('#qty_'+index).attr('class','text_css mb textfield');
	    $('#rate_'+index).attr('class','text_css mb textfield');
		$('#qty_'+index).removeAttr('style');
	    $('#rate_'+index).removeAttr('style');*/
		}else{
		$('#unit_price_'+index).attr('class','text_css mb textfield');	
        $('#unit_price_'+index).removeAttr('style');		
		}
	}else{
		if( project_type != 1){
			var qty_val = $('#qty_'+index).val();
			var rate_val = $('#rate_'+index).val();

			if(qty_val!= '' || rate_val!=''){
				var uni_price = qty_val*rate_val;
				
				$('#unit_price_'+index).val(uni_price);
				$('#unit_price_'+index).prop("readonly", true);
			}else{
				$('#unit_price_'+index).val();
				$('#unit_price_'+index).prop("readonly", false);
				$('#unit_price_'+index).attr('class','text_css required mb textfield');	
			}	
		/*$('#qty_'+index).attr('class','text_css required mb textfield');
	    $('#rate_'+index).attr('class','text_css required mb textfield');
		$('#qty_'+index).removeAttr('style');
	    $('#rate_'+index).removeAttr('style');*/
		}else{
		$('#unit_price_'+index).attr('class','text_css required mb textfield');	 
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
	$('#total_before_discount').val('-'+t.toFixed(2));
	var ori_inv_amt = $('#original_inv_amount').val();
	var total_credit_amt = $('#total_credit_amt').val();
	total = Math.abs(t) + Math.abs(total_credit_amt);
	if(total > ori_inv_amt){
		alert('Total amount should be less than the original invoice amount. ' + ori_inv_amt + ' Existing Credit Note amount is '+ Math.abs(total_credit_amt));
	}
	
	$('#total_price').val('-'+ t.toFixed(2));
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
	if(($.trim($('#project_type').val()) == '')) {
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
var maxLength = 201;	
var annexure = document.getElementById("annexure");
var annexure_message = document.getElementById("annexure_message");
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
</script>
<script>
	$( function() {
		$( "#accordion" ).accordion({ heightStyle: "content" });
	});
	$( "#accordion" ).accordion({
		collapsible: true,
		active: false,
	});
	// Getter
	var collapsible = $( "#accordion" ).accordion( "option", "collapsible" );
	// Setter
	$( "#accordion" ).accordion( "option", "collapsible", true );
</script>
