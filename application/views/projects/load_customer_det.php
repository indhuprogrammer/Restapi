<form id="customer-detail-read-only" onsubmit="return false;">
		
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
		<table class="tabbed-cust-layout" cellpadding="0" cellspacing="0">
				<tr>
					<td width="120"><label>Company Name</label></td>
					<td>
						<b>
							<?php #echo $company_det['company'] ?>
							<input type="text" style="width:180px;" name="customer_company_name" id="customer_company_name" class="pull-left textfield width300px" value="<?php echo $quote_data['company'].' - '.$quote_data['customer_name'] ?>" <?php if ($readonly_status == true) { ?> disabled <?php } ?> />
							<input type="hidden" name="customer_entity" id="customer_entity" value="<?php echo $quote_data['entity'] ?>" />
							<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $quote_data['custid_fk'] ?>" />
							<input type="hidden" name="customer_id_old" id="customer_id_old" value="<?php echo $quote_data['custid_fk'] ?>" />
							<input type="hidden" name="customer_company_name_old" id="customer_company_name_old" class="textfield width300px" value="<?php echo $quote_data['company'].' - '.$quote_data['customer_name'] ?>" />
							<?php if ($chge_access == 1 && $quote_data['pjt_status'] != 2) { ?>
							<div class="buttons pull-left">
								<button type="submit" class="positive" style="margin:0 0 0 5px;" onclick="setCustomer(); return false;">Set</button>
							</div>
							<div id="resmsg_customer" class='pull-left succ_err_msg' style="margin: 5px 0px 0px 5px; display: inline-block;"></div>
							<?php } ?>
						</b>
					</td>
				</tr>
				<?php if($quote_data['entity']!='3'){ ?>				
				
				<tr>
					<td><label>PAN Number</label></td>
					<td><b><?php echo $quote_data['pan_number'] ?></b></td>
				</tr>
			<?php } ?>	
			<?php if($quote_data['entity'] != 4){ ?>
				<tr>
					<td><label>Block</label></td>
					<td><b><?php echo $quote_data['add1_block'] ?></b></td>
				</tr>
			<?php } ?>	
			<tr>
				<td><label>Street</label></td>
				<td><b><?php echo $quote_data['add1_street_po'] ?></b></td>
			</tr>
			<tr>
				<td><label>Region</label></td>
				<td><b><?php echo $quote_data['region_name'] ?></b></td>
			</tr>
			<tr>
				<td><label>Country</label></td>
				<td><b><?php echo $quote_data['country_name'] ?></b></td>
			</tr>
			<?php if($quote_data['entity'] != 2){ ?>
				<tr>
					<td><label>State</label></td>
					<td><b><?php echo $quote_data['state_name'] ?></b></td>
				</tr>
				<tr>
					<td><label>City</label></td>
					<td><b><?php echo $quote_data['location_name'] ?></b></td>
				</tr>
			<?php } ?>	
			<tr>
				<td><label>Post code</label></td>
				<td><b><?php echo $quote_data['add1_postcode'] ?></b></td>
			</tr>
			<tr>
				<td><label>Phone</label></td>
				<td><b><?php echo $quote_data['mobile_num'] ?></b></td>
			</tr>
			<tr>
				<td><label>Fax</label></td>
				<td><b><?php echo $quote_data['fax'] ?></b></td>
			</tr>
				<tr>
				<td><label>Email</label></td>
				<td><b><?php echo $quote_data['email_2'] ?></b></td>
			</tr>
			<tr>
				<td><label>WEB</label></td>
				<td><b><?php echo $quote_data['www'] ?></b></td>
			</tr>	
		   
			<?php if($quote_data['entity'] == 3){ ?>
				<tr>
					<td><label>Federal tax</label></td>
					<td><b><?php echo $quote_data['federal_tax'] ?></b></td>
				</tr>
			<?php } ?>	

			<?php if($quote_data['entity'] == 1){ ?>
				<tr>
				<td><label>GST Type</label></td>
				<td><b> <?php if ($quote_data['gst_type'] == '2' ) {
									echo 'CASUAL TAXABLE PERSON';
							  }	
							  if ($quote_data['gst_type'] == '3' ){
								  echo "Composition Levy";
							  }	  
							   if ($quote_data['gst_type'] == '4' ) {
								   echo "Government Department or PSU";
							   }
							   if ($quote_data['gst_type'] == '5' ){
								 echo "Non Resident Taxable Person";
							   }	 
								if ($quote_data['gst_type'] == '1' ){
								echo "Regular/TDS/ISD";
								}	
							   if ($quote_data['gst_type'] == '6' ) {
								   echo "UN Agency or Embassy";
							   } 
						 ?>	</b></td>
				</tr>	
				<tr>
						<td><label>GSTIN</label></td>
						<td><b><?php echo $quote_data['gst_in'] ?></b></td>
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
<script>
$(document).ready(function(){
	$( "#customer_company_name" ).autocomplete({
		minLength: 2,
		source: function(request, response) {
			$.ajax({ 
				url: "hosting/ajax_customer_search",
				data: { 'cust_name': $("#customer_company_name").val(),'entity_id':$("#customer_entity").val(),'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
				type: "POST",
				dataType: 'json',
				async: false,
				success: function(data) {
					response( data );
				}
			});
		},
		select: function(event, ui) {
			$('#customer_id').val(ui.item.id);
			// ex_cust_id = ui.item.id;
			// regId = ui.item.regId;
			// cntryId = ui.item.cntryId;
			// stId = ui.item.stId;
			// locId = ui.item.locId;
			// prepareQuoteForClient(ex_cust_id);
			// getUserForLeadAssign(regId,cntryId,stId,locId);
		}
	});
});
</script>