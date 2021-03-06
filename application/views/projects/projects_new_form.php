<link rel="stylesheet" href="assets/css/chosen.css" type="text/css" />
<script type="text/javascript" src="assets/js/chosen.jquery.js"></script>
<style>
.hide-calendar .ui-datepicker-calendar { display: none; }
button.ui-datepicker-current { display: none; }
#ui-datepicker-div { z-index: 1082 !important; }
.cus_det strong {
    min-width: 108px;
    display: inline-block;
}
#project-confirm-form td strong {
    vertical-align: 11px;
}
.layout td strong {
    vertical-align: 11px;
}
span.radlabspa {
	display: inline-block;
	margin-top: 1px;
	vertical-align: top;
	margin-left: 5px;
	padding-right: 13px;
}
</style>
	
<div style="width:100%;">
	<div class="file-tabs-close-confirm-tab" id="tabs_close"></div>
	<div id="tabs" class="tabs_new">
		<ul class="tabs-confirm">
			<li><a href="#tabs-client">Client Details</a></li>
			<li><a  href="#tabs-project">Project Details</a></li>
			<li><a  href="#tabs-assign-users">Assign Users</a></li>
			<li><a  href="#tabs-milestone">Milestone</a></li>			
		</ul>
		<div id="tabs-client">
			<!--p class="clearfix" ><h3>Client Details</h3></p-->
			<div style="text-align:left;" class="ajx_failure_msg" id="pan_num_err_top"></div> 
        <div style="text-align:left;" class="ajx_failure_msg" id="gstin_err_top"></div>
			<form name="customer_detail_form" enctype="multipart/form-data" id="customer_detail_form" method="post" onsubmit="return false;">
			
			<input id="token" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" name="company_id" id="company_id" value=''>
			<input type="hidden" id="changes" name="changes" value="0">
			<input type="hidden" id="selectchanges" name="selectchanges" value="0">
			<input type="hidden" id="sap_status" name="sap_status" value="">
		
		<div id="accordion" class="widthchnage">
		 <h3 class="font_14">Customer Details</h3>
			<div>
               <div class="layout" >	
			    <table class="cus_det">
			      <tr>
					<td>
						<strong>Entity: <span class='mandatory_asterick'>*</span></strong></td>
						<td>
							<select name="entity" onchange="getCurrency(this.value)" id="entity" class="textfield width200px">
								<option value="">Please Select</option>
								<?php
								foreach ($sales_divisions as $sa_div)
								{								
								?>
									<option value="<?php echo $sa_div['div_id'] ?>"><?php echo $sa_div['division_name'] ?></option>
								<?php								
								}
								?>
							</select>
							<div class="ajx_failure_msg" id="entity_err"></div>
						</td>	
							
						<td class="registered"><strong>Registered:<span class='mandatory_asterick'>*</span></strong></td>
						<td class="registered" style="padding-bottom: 10px;">
							<input type="radio" name="registered_flag" class="registered_flag" value="Yes" /> <span class="radlabspa">Yes </span>
							<input type="radio" name="registered_flag" class="registered_flag" value="No" /> <span class="radlabspa">No </span>
							<div class="ajx_failure_msg" id="registered_err"></div>
								
						</td>	
						<td><strong>Customer Name(Company): <span class='mandatory_asterick'>*</span></strong></td>
					    <td><input type="text" maxlength="100" name="company" id="company" value="" class="textfield width200px required" /> 
						   
						   <div class="ajx_failure_msg" id="comp_err"></div>
						   <div class="ajx_failure_msg" id="company_err"></div>
						</td>	
				  </tr>
				  <tr style="height:10px">

				  </tr>
				   <tr>
				       
				   	   <td><strong>Currency: <span class='mandatory_asterick'>*</span></strong></td>
						<td>
							<input type="text" id="currencies" name="currencies" readonly="readonly" class="textfield width200px required" value="all">
						</td>
						<td><strong>Group: <span class='mandatory_asterick'>*</span></strong></td>
								<td id='group_row'>
									<select id="group" name="group" class="textfield width200px required" >
									<option value="">Select Group</option>                           
									</select>
										
									<div class="ajx_failure_msg" id="currency_err"></div>
						</td>
						<td><strong>Tel:</strong></td>
						<td><input type="text" maxlength="20" name="tele1" id="tele1" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 32 || event.charCode == 8" value="" class="textfield width200px required errormsg" /> 
						<div class="ajx_failure_msg" id="tele1_err"></div>
						</td>
						
				   </tr>
				    <tr style="height:10px">

				    </tr>
					<tr>
						<td><strong>Mobile Number:</strong></td>
						<td><input type="text" maxlength="50" name="mobile_num" id="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 32 || event.charCode == 8" value="" class="textfield width200px required errormsg" /> 
							<div class="ajx_failure_msg" id="phone_err"></div>
						</td>
						<td><strong>Fax: </strong></td>
						<td><input type="text" maxlength="20" name="fax" id="fax" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 32 || event.charCode == 8" value="" class="textfield width200px required errormsg" /> 
							<div class="ajx_failure_msg" id="fax_err"></div>
						</td>
						<td><strong>Email:</strong>
						</td>
						<td><input type="text" maxlength="100" id="emailval" autocomplete="off" name="email_2" value="" class="textfield width200px required errormsg" /><div class="errmsg"></div>
						  <div class="ajx_failure_msg" id="email_2_err"></div>
					    </td>

						
					</tr>
					<tr style="height:10px">

					</tr>
					<tr>
					<td><strong>Website: </strong></td>
						<td><input type="text" maxlength="100" name="www" id="www" value="" class="textfield width200px required errormsg" />
						    <div class="ajx_failure_msg" id="www_err"></div> 
						</td>
						<td class="pan"><strong>PAN Number:<span class='mandatory_asterick'>*</span> </strong></td>
						<td class="pan" style="padding-top: 11px;"><input type="text" maxlength="10" onkeyup="validatePanNumber(this.value);"  name="pan_number" id="pan_num" value="" class="textfield width200px required errormsg" />
						<div>Pan number format(AAAAA1234R)</div>
						<span id="status" style="color:red"></span>
						   <div class="ajx_failure_msg" id="pan_num_err"></div> 
						</td>
						<td><strong>Business partner type:</strong></td>
							<td>
							<select name="business_partner" id="business" class="textfield width200px"  class="textfield width200px required">
							<option value="">Select Business</option>
							<option  value="C">Company</option>
							<option value="I">Private</option>
							<option  value="E">Employee</option>
							</select>
							<div class="ajx_failure_msg" id="business_err"></div>
						</td>
						<tr style="height:10px">

						</tr>
						<tr>
						
						<td style="padding-bottom: 10px;">
							<button type="button" class="positive" onclick="update_customer_details()" id="positiveBtn">Next</button>
								
						</td>	
						</tr>
					</tr>
				 </table>
				</div>
			   </div>  
			<h3 class="font_14">Billing Address</h3>
			 <div>
               <div class="layout" >	
			     <table>
				     <tr>

					   <td>
							<span class="bill">
							<strong>Region: <span class='mandatory_asterick'>*</span></strong></span>
						</td>
						<td>
							<span  class="bill">
								<select name="add1_region" id="add1_region" class="textfield width200px" onchange="getCountry(this.value)" class="textfield width200px required">
										<option value="">Select Region</option>
										<?php
										if(count($regions>0)) {
											foreach ($regions as $region) { 
										?>
												<option value="<?php echo $region['regionid'] ?>"><?php echo $region['region_name']; ?></option>
										<?php 
											} 
										} 
										?>
									</select>
							<div class="ajx_failure_msg" id="add1_region_err"></div></span>
						</td>
						<td>
							<span class="bill">
								<strong>Country: <span class='mandatory_asterick'>*</span></strong></span>
						</td>
					  
						<td id='country_row'>
							<span  class="bill">
							<select id="add1_country" name="add1_country" class="textfield width200px required" >
							<option value="">Select Country</option>                           
							</select>
							<div class="ajx_failure_msg" id="add1_country_err"></span></div>
						</td>

						<td class="state">
							<span class="bill">
								<strong>State: <span class='mandatory_asterick'>*</span></strong></span>
						</td>
						<td class="state" id='state_row'>
							<span  class="bill">
								<select id="add1_state" name="add1_state" class="textfield width200px required">
									<option value="">Select State</option>                           
								</select>
							<!-- <a id="addStButton" class="addNew" style ="display:none;"></a> -->
							<div class="ajx_failure_msg" id="add1_state_err"></div></span>
						</td>
						
						
					 </tr>

					 <tr style="height:10px">

					 </tr>

					 <tr>
					    <td class="city">
							<span class="bill">
								<strong>City: <span class='mandatory_asterick'>*</span></strong></span>
						</td>
						<td class="city" id='location_row'>
						<span  class="bill">
							<select name="add1_location" id="add1_location" class="textfield width200px required">
							<option value="">Select City</option>                           
							</select>
							<!-- <a id="addLocButton" class="addNew" style ="display:none;"></a> -->
							<div class="ajx_failure_msg" id="add1_location_err"></div></span>
						</td>
						<td class="bill_block">
							<span>
							<strong>Block: </strong>
						</td></span>
						<td class="bill_block">
							<span>
								<input type="hidden" id="address_type" name="address_type" value="bill_new" class="textfield width200px errormsg" />
								<input maxlength="100" type="text" id="add1_line2" name="add1_block" value="" class="textfield width200px" /
							><div class="ajx_failure_msg" id="add1_line2_err"></div>
							</span>
						</td>		
						<td class="strret">
							<span>
								<strong>Street: </strong>
							</span>	
						</td>
						<td class="strret">
							<span>
							<input maxlength="100" type="text" id="street" name="add1_street_po" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="street_err"></div></span>
						</td>

						
						

					 </tr>

					 <tr style="height:10px">

					 </tr>
					 <tr>

					    <td class="suburb">
							<span>
								<strong>Suburb:</strong></span>
						</td>
						<td class="suburb">
							<span>
								<input type="text" id="suburb" name="add1_suburb" value="" class="textfield width200px" />
							<div class="ajx_failure_msg" id="suburb_err"></div></span>
						</td>
					    <td>
							<span class="bill">
							<strong>Zipcode:</strong></span>
						</td>
						<td>
							<span  class="bill">
								<input type="text" maxlength="20" name="add1_postcode" id="post_code" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="post_code_err"></div></span>
						</td>

						

						
					 </tr>
					 <tr style="height:10px">

					 </tr>
					 <tr>
						 
					    <td class="bill_building">
							<span>
								<strong>Building: </strong></span>
						</td>
						<td class="bill_building">
							<span>
								<input type="text" maxlength="50" name="building" id="building" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="county_err"></div></span>
						</td>
						<td class="bill_gsttype">
							<span class="bill">
								<strong>GSTtype: </strong></span>
						</td>
						<td class="bill_gsttype">
							<select name="gst_type" id="gst_type" class="textfield width200px"  class="textfield width200px required">
							<option value="">Select GST</option>
							<option value="2">CASUAL TAXABLE PERSON</option>
							<option value="3">Composition Levy</option>
							<option value="4">Government Department or PSU</option>
							<option value="5">Non Resident Taxable Person</option>
							<option value="1">Regular/TDS/ISD</option>
							<option value="6">UN Agency or Embassy</option>
							</select>
							<div class="ajx_failure_msg" id="gst_err"></div>
						</td>
						<td class="gstn">
							<span class="bill">
								<strong>GSTIN: <span class='mandatory_asterick'>*</span></strong></span>
						</td>
						<td class="gstn">
							<span  class="bill">
								<input type="text" maxlength="15" onkeyup="gstn_validation(this.value)" name="gst_in" id="gst_in" value="" class="textfield width200px errormsg" />
								<div>GSTN Number format(33AAAAA1234R)</div>

							<div class="ajx_failure_msg" id="gstin_err"></div>
							<div id="status_id" style="color:red"></div></span>
						</td>
						
					 </tr>
					 <tr style="height:10px">

					 </tr>
					 <tr>

					    <td class="bill_federal_tax">
							<span class="bill">
								<strong>Federal Tax: <span class='mandatory_asterick'>*</span></strong></span>
						</td>
						<td class="bill_federal_tax">
							<span  class="bill">
								<input type="text" maxlength="20" name="federal_tax" id="federal_tax" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="federal_tax_err"></div></span>
						</td>
					    <td>
							<span class="bill">
								<strong>GLN: </strong></span>
						</td>
						<td>
							<span  class="bill">
								<input type="text" maxlength="50" name="gln" id="gln" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="county_err"></div></span>
						</td>					
						<input type="hidden" name="bill_address_id" value="">
						<td style="padding-bottom: 10px;">
							<button type="button" class="positive" onclick="update_billing_address()" id="positiveBtn">Next</button>
								
						</td>
					 </tr>
				  </table>	 
				</div>
			 </div>

			 
			 <h3 class="font_14">Shipping Address</h3>
			 <div>
               <div class="layout" >	
			   		<div style="margin-bottom: 15px;text-align: left;">
						<span>
						    <!-- <input type="checkbox" name="copy" id="copy" >	 -->
							<input type="checkbox" id="copy" name="copy" 
							/>
						</span>		
						<input type="hidden" name="shipping_address_type" id="address_type" value="ship_new">			
						<span style="margin-left: 2px;">  Same as billing Address</span>
					 </div>
			     <table class="shipping">
				 
				   <tr>
				   <td>
					   <span  class="ship">
					       <strong>Region: </strong></span>
					</td>
					<td>
					  <span class="ship">
					      <select name="ship_region" id="ship_region" class="textfield width200px" onchange="getCountry_ship(this.value)" class="textfield width200px required">
								<option value="">Select Region</option>
								<?php
								if(count($regions>0)) {
									foreach ($regions as $region) { 
								?>
										<option value="<?php echo $region['regionid'] ?>"><?php echo $region['region_name']; ?></option>
								<?php 
									} 
								} 
								?>
							</select>
							<div class="ajx_failure_msg" id="ship_region_err"></div></span>
					 </td>
					 <td>
					   <span class="ship">
					    <strong>Country: <span class='mandatory_asterick'>*</span></strong></span>
					</td>
					  
					<td id='country_row_ship'>
						<span  class="ship">
						<select id="ship_country" name="ship_country" class="textfield width200px required" >
						<option value="">Select Country</option>                           
						</select>
						<div class="ajx_failure_msg" id="ship_country_err"></span></div>
					</td>
					<td class="state_ship">
							<span class="ship">
								<strong>State: <span class='mandatory_asterick'>*</span></strong></span>
					</td>
					<td class="state_ship" id='state_row_ship'>
						<span  class="ship">
							<select id="ship_state" name="ship_state" class="textfield width200px required">
								<option value="">Select State</option>                           
							</select>
							<!-- <a id="addStButton" class="addNew" style ="display:none;"></a> -->
							<div class="ajx_failure_msg" id="ship_state_err"></div></span>
					 </td>			
					 	
						
				   </tr>

				   <tr style="height:10px">

				   </tr>
				   <tr>

				   <td class="city_ship">
						<span class="ship">
							<strong>City: <span class='mandatory_asterick'>*</span></strong></span>
					</td>
					<td class="city_ship" id='location_row_ship'>
						<span  class="ship">
						<select name="ship_location" id="ship_location" class="textfield width200px required">
						<option value="">Select City</option>                           
						</select>
						<!-- <a id="addLocButton" class="addNew" style ="display:none;"></a> -->
						<div class="ajx_failure_msg" id="ship_location_err"></div></span>
					</td>
					<td class="block_ship">
						<span  class="ship">
							
						<strong>Block: </strong></span>
					</td>
					<td  class="block_ship">
						<span  class="ship">
						<input type="hidden" id="address_type" name="address_type_ship" value="" class="textfield width200px" />	
						<input type="text" maxlength="100"  id="ship_block" name="ship_block" value="" class="textfield width200px errormsg" />
						<input type="hidden"  id="ship_block_copy" name="ship_block_copy" value="" class="textfield width200px" />
						<div class="ajx_failure_msg" id="ship_block_err"></div></span>
					</td>	
					<td>
					   <span class="ship">	
						<strong>Street: </strong></span>
					</td>
					<td>
						<span class="ship">
							<input type="text" maxlength="100" id="ship_street_po" name="ship_street_po" value="" class="textfield width200px errormsg" />
							<input type="hidden" id="copy_ship_street_po" name="copy_ship_street_po" value="" class="textfield width200px" />
						<div class="ajx_failure_msg" id="ship_street_po_err"></div>
						</span>
					</td>		
					
					
				   </tr>
				   <tr style="height:10px">

				   </tr>
				   <tr>

				    <td class="suburb_ship"> 
					  <span>
					  	<strong>Suburb: </strong></span>
					</td>
					<td class="suburb_ship">
					  <span>
					   <input type="text" id="ship_suburb" name="ship_suburb" value="" class="textfield width200px" />
					   <input type="hidden" id="copy_ship_suburb" name="copy_ship_suburb" value="" class="textfield width200px" />
					<div class="ajx_failure_msg" id="ship_suburb_err"></div></span>
					</td>	
					<td>
						<span class="ship">
							<strong>Zipcode: </strong></span>
					</td>
					<td>
						<span class="ship">
							<input type="text" maxlength="20" name="ship_zipcode" id="ship_zipcode" value="" class="textfield width200px errormsg" />
							<input type="hidden" name="copy_ship_zipcode" id="copy_ship_zipcode" value="" class="textfield width200px" />
						<div class="ajx_failure_msg" id="ship_zipcode_err"></div></span>
					</td>
					
								
				   </tr>

				    <tr style="height:10px">

					</tr>
					<tr>
					  <td class="building_ship">
						<span  class="ship">
							<strong>Building: </strong></span>
					  </td>
					   <td class="building_ship">
							<span class="ship">
								<input type="text" maxlength="50" name="ship_building" id="ship_building" value="" class="textfield width200px errormsg" />
								<input type="hidden" name="copy_ship_building" id="copy_ship_building" value="" class="textfield width200px" />
							<div class="ajx_failure_msg" id="ship_building_err"></div></span>
					  </td>
					  <td class="gsttype_ship">
					   <span class="ship">
							<strong>GSTtype: </strong></span>
					   </td>
					   <td class="gsttype_ship">
						<span  class="ship">
						<select name="ship_gst_type" id="ship_gst_type" class="textfield width200px"  class="textfield width200px required">
							<option value="">Select GST</option>
							<option  value="2">CASUAL TAXABLE PERSON</option>
							<option value="3">Composition Levy</option>
							<option value="4">Government Department or PSU</option>
							<option value="5">Non Resident Taxable Person</option>
							<option  value="1">Regular/TDS/ISD</option>
							<option value="6">UN Agency or Embassy</option>
							</select>
							<div class="ajx_failure_msg" id="gst_err"></div></span>
						</td>		
						<td class="gstn_ship"> 
							<span  class="ship">
							<strong>GSTIN: </strong></span>
						</td>
						<td class="gstn_ship">
							<span class="ship">
								<input type="text" maxlength="15" onkeyup="gstn_validation(this.value)" name="ship_gst_in" id="ship_gst_in" value="" class="textfield width200px errormsg" />
								<input type="hidden" name="copy_ship_gst_in" id="copy_ship_gst_in" value="" class="textfield width200px" />
							<div class="ajx_failure_msg" id="ship_gst_in_err"></div>
							<div>GSTN Number format(24AAAAA1234R)</div>
							<div id="status_id" style="color:red"></div></span>
					    </td>		
					</tr>

					 <tr style="height:10px">

					</tr>
					<tr>
						<td class="federal_tax_ship">
						<span  class="ship">
							<strong>Federal Tax: </strong></span>
						</td>
						<td class="federal_tax_ship">
							<span class="ship">
								<input type="text" maxlength="20" name="ship_federal_tax" id="ship_federal_tax" value="" class="textfield width200px errormsg" />
								<input type="hidden" name="copy_ship_federal_tax" id="copy_ship_federal_tax" value="" class="textfield width200px" />
							<div class="ajx_failure_msg" id="ship_zipcode_err"></div></span>
						</td>
						<td>
							<span  class="ship">
								<strong>GLN: </strong></span>
						</td>
						<td>
							<span class="ship">
								<input type="text" maxlength="50" name="ship_gln" id="ship_gln" value="" class="textfield width200px errormsg" />
								<input type="hidden" name="copy_ship_gln" id="copy_ship_gln" value="" class="textfield width200px" />
							<div class="ajx_failure_msg" id="ship_zipcode_err"></div></span>
					    </td>	
						<input type="hidden" name="ship_address_id" value="">
						<td style="padding-bottom: 10px;">
							<button type="button" class="positive" onclick="update_shipping_address()" id="positiveBtn">Next</button>
								
						</td>			
					</tr>

					
				 </table>
				</div>
			  </div>	

			<h3 class="font_14">Contact Person</h3>
			 <div>
               <div class="layout" >	
			     <table>
					 <tr>
						<td><strong>First Name:<span class='mandatory_asterick'>*</span> </strong></td>
							<input type="hidden" id="custid" name="custid" value="" class="textfield contact_id required errormsg" />
						<td>
						<input type="text" name="first_name" maxlength="50" id="first_name" value="" class="textfield width200px errormsg" /><div class="ajx_failure_msg" id="first_name_err"></div>
						</td>
						<td><strong>Middle Name:</strong></td>
						<td>
						    <input type="text" maxlength="50" name="middle_name"  value="" class="textfield width200px errormsg" />
						</td>			
						<td><strong>Last Name:<span class='mandatory_asterick'>*</span> </strong></td>
						<td>
							<input type="text" maxlength="50" name="last_name" id="last_name" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="last_name_err"></div>
						</td>
					 </tr>			

					 <tr style="height:10px"> 

					 </tr>
					 <tr>
						<td><strong>Title:</strong></td>
						<td><input type="text" maxlength="10" name="title" id="title" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="title_err"></div>
						</td>
						<td><strong>Position: </strong></td>
							<td><input type="text" maxlength="90" name="position_title" id="position_title" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="position_title_err"></div>
						</td> 
						<td><strong>Address:</strong></td>
						<td><input type="text" maxlength="100" name="cus_address" id="cus_address" value="" class="textfield width200px errormsg" />
							<div class="ajx_failure_msg" id="cus_address_err"></div>
						</td>
					 </tr>

					 <tr style="height:10px"> 

					  </tr>
					  <tr>
					  	<td><strong>Mobile Number:</strong></td>
						<td><input type="text" maxlength="50" name="phone_1" id="phone_1" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 32 || event.charCode == 8" value="" class="textfield width200px required errormsg" />
							<div class="ajx_failure_msg" id="phone_1_err"></div> 
						</td> 
						<td><strong>Tel: </strong></td>
							<td><input type="text" maxlength="20" name="cus_tele1" id="cust_tele1" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 32 || event.charCode == 8" value="" class="textfield width200px required errormsg" />
							<div class="ajx_failure_msg" id="cust_tele1_err"></div> 
						</td>
						<td><strong>Fax: </strong></td>
							<td><input type="text" maxlength="20" name="cus_fax" id="cust_fax" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 32 || event.charCode == 8" value="" class="textfield width200px required errormsg" /> 
							<div class="ajx_failure_msg" id="cust_fax_err"></div>
						</td>
					  </tr>

					    <tr style="height:10px"> 

						</tr>
						<tr>
							<td><strong>Email:<span class='mandatory_asterick'>*</span> </strong></td>
								<td><input type="text" maxlength="100" name="email_1" id="email_1" value="" class="textfield width200px required errormsg" /><div class="errmsg"></div>
								<div class="ajx_failure_msg" id="email_1_err"></div>
							</td>			
							<td><strong>Remarks:</strong></td>
								<td><input type="text" maxlength="100" name="remarks1" id="remarks_1" value="" class="textfield width200px required errormsg" />
								<div class="ajx_failure_msg" id="remarks_1_err"></div> 
							</td>			
							<td><strong>Skype: </strong></td>
								<td><input type="text" maxlength="20" name="skype_name" id="skype_name" value="" class="textfield width200px required errormsg" />
								<div class="ajx_failure_msg" id="skype_name_err"></div> 
								</td>
						</tr>
						<tr style="height:10px">

					</tr>
					<tr>
						
							
						</tr>
				<tr></tr>
				<tr></tr>
				<tr></tr> 
				<tr>
					
					<td>
                        <div id="subBtn" class="buttons pull-right" style="padding-right: 30px;">
							<!-- <button type="submit" class="positive" id="positiveBtn" onclick="update_customer('<?php echo $customer_data['custid'] ?>','tabs-milestone',event); return false;">Update</button> -->
							<button type="submit" class="positive" id="positiveBtn">Submit</button>
						</div>
                    </td>
				</tr>
			
				</table>
			   </div>
			 </div>  
		     </div>	
			</form>
		</div>
		
		<div id="tabs-project" >
			<?php #echo "<pre>"; print_r($quote_data); exit; ?>
			<!--p class="clearfix" ><h3>Project Details<span class='mandatory_asterick'>*</span></h3></p-->
			<form  enctype="multipart/form-data" method="post" id="project_detail_form" onsubmit="return false;">
				<input id="token" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div class="errmsg_confirm ajx_failure_msg"></div>
				<table class="layout" cellspacing="10">
					<tr>
						<td width="115"><strong>Project Name: <span class='mandatory_asterick'>*</span></strong></td>
						<td width="200">
							<input type="text" name="project_name" id="project_name" class="textfield" style=" width:205px" value="" tabindex="1" />
							<input type="hidden" name="custid" value='' id="cust_id">
							<input type="hidden" name="division" value='' id="division">
							<div class="ajx_failure_msg" id="project_name_err"></div>
						</td>
            <td><strong>Resource Type: <span class='mandatory_asterick'>*</span></strong></td>
						<td>
							<select name="resource_type" id="resource_type" class="textfield width200px" tabindex="2">
								<option value="not_select">Please Select</option>
								<?php 
									if(isset($billing_categories) && !empty($billing_categories)) {
										foreach ($billing_categories as $list_billing_cat) 
										{
								?>
									<option value="<?php echo $list_billing_cat['bill_id'] ?>"><?php echo  $list_billing_cat['category'] ?></option>
								<?php
										}
									}
								?>
							</select>
							<div class="ajx_failure_msg" id="resource_type_err"></div>
						</td>
						
					</tr>
          <tr>
            <td><strong>Business Unit: <span class='mandatory_asterick'>*</span></strong></td>
						<td>
							<select name="business_unit_id" id="business_unit_id_pop" class="textfield width200px" tabindex="3">
								<option value="not_select">Please Select</option>
								<?php if(!empty($business_unit) && count($business_unit)) { ?>
									<?php foreach($business_unit as $bu) { ?>						
										<option value="<?php echo $bu['id']; ?>" <?php echo ($quote_data['business_unit_id'] == $bu['id']) ? ' selected="selected"' : '' ?>><?php echo $bu['business_unit']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<div class="ajx_failure_msg" id="business_unit_id_err"></div>
						</td>
            <td width="115"><strong>Lead Source: <span class='mandatory_asterick'>*</span></strong></td>	
            <td>
              <select name="lead_source" id="lead_source_edit" class="textfield width200px">
              <option value="not_select">Please Select</option>
                <?php 
                foreach ($lead_source_edit as $leadedit) 
                {
                ?>
                  <option value="<?php echo $leadedit['lead_source_id'] ?>"><?php echo  $leadedit['lead_source_name'] ?></option>
                <?php
                }
                ?>
            </select>	
            <div class="ajx_failure_msg" id="lead_source_edit_err"></div>		
            </td>	
          </tr>
					<tr>
              <td><strong>Departments: <span class='mandatory_asterick'>*</span></strong></td>
              <td>
                <select name="department_id_fk" id="department_id_fk_pop" class="textfield width200px" tabindex="3" onchange="triggerRedmineCheck(this)">
                  <option value="not_select">Please Select</option>
                </select>
                <input type="hidden" id="department_id_fk_hide" value="<?php echo $quote_data['department_id_fk'] ?>">
                <div class="ajx_failure_msg" id="department_err"></div>
              </td>
							<td width="115"><strong style="display:inline-block;width:100px">Service Requirement: <span class='mandatory_asterick'>*</span></strong></td>	
							<td>	
								<select name="lead_service" id="job_category_edit" class="textfield width200px">
									<option value="not_select">Please Select</option>
								<?php 
									foreach ($job_cate as $job) 
									{ 
								?>
									<option value="<?php echo $job['sid'] ?>"><?php echo $job['services'] ?></option>
								<?php
									}
								?>
								</select>
								<div class="ajx_failure_msg" id="lead_service_err"></div>
							</td>	
							
					</tr>
					
					<tr>
            <td><strong>Practice: <span class='mandatory_asterick'>*</span></strong></td>
						<td>
							<select name="practice" id="practice_pop" class="textfield width200px" tabindex="3">
								<option value="not_select">Please Select</option>
							</select>
							<input type="hidden" id="practice_hide" value="<?php echo $quote_data['practice'] ?>">
							<div class="ajx_failure_msg" id="practice_err"></div>
						</td>
						<td><strong style="vertical-align: 8px;">SOW Status: <span class='mandatory_asterick'>*</span></strong></td>
						<td>					
							<label for="sow_status_signed"><input type="radio" name="sow_status" id="sow_status_signed" value="1" tabindex="11" /> <span class="radlabspa"> Signed </span></label>
							<label for="sow_status_unsigned"><input type="radio" name="sow_status" id="sow_status_unsigned"  value="0" tabindex="12" /> <span class="radlabspa"> Un signed </span></label>
							<div class="ajx_failure_msg" id="sow_status_err"></div>
						</td>
					</tr>
					<tr>
            <td><strong>Project Billing Type: <span class='mandatory_asterick'>*</span></strong></td>
            <td>
              <select name="timesheet_project_types" id="timesheet_project_types" class="textfield width200px" tabindex="4">
                <option value="not_select">Please Select</option>
                <?php 
                if(isset($timesheet_project_types) && !empty($timesheet_project_types)) {
                  foreach ($timesheet_project_types as $list_timesheet_project_types) 
                  {
                ?>
                  <option value="<?php echo $list_timesheet_project_types['project_type_id'] ?>" ><?php echo $list_timesheet_project_types['project_type_name'] ?></option>
                <?php
                  }
                }
                ?>
              </select>
              <div class="ajx_failure_msg" id="timesheet_project_types_err"></div>
            </td>
						<td width="115"><strong>SOW Value: <span class='mandatory_asterick'>*</span></strong></td>
						<td width="200">
							<input type="hidden" name="expect_worth_name" id="expect_worth_name" class="textfield" style=" width:23px" readonly value="" />
							<span id="currency_row">
								<select name="expect_worth" id="expect_worth" class="textfield width100px">
										<option value="not_select">Please Select</option>
									
									</select>
							</span>
							<span class="ajx_failure_msg" id="sow_currency_err"></span>
							<input type="text"  onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 43 || event.charCode == 45 || event.charCode == 32 || event.charCode == 8" name="actual_worth_amount" id="actual_worth_amount" class="textfield" style=" width:90px;margin-left:5px;" value="" tabindex="13" />
							<div class="ajx_failure_msg" id="sow_value_err"></div>
						</td>					
					</tr>
					<tr>
            <td><strong>Project Type: <span class='mandatory_asterick'>*</span></strong></td>
            <td>					
              <select name="project_types" id="project_types" class="textfield width200px" tabindex="5">
                <option value="not_select">Please Select</option>
                <?php 
                if(isset($project_types) && !empty($project_types)) {
                  foreach ($project_types as $type) 
                  {
                ?>
                  <option value="<?php echo $type['id'] ?>"><?php echo $type['project_types'] ?></option>
                <?php
                  }
                }
                ?>
              </select>
              <div class="ajx_failure_msg" id="project_type_err"></div>							
            </td>    
						<td width="115"><strong>Planned Start Date (SOW Start Date): <span class='mandatory_asterick'>*</span></strong></td>
						<td width="200px">
							<input type="text" data-calendar="true" name="date_start" id="date_start" class="textfield" style=" width:210px" value="" readonly tabindex="14" />
							<div class="ajx_failure_msg" id="date_start_err"></div>
						</td>
					</tr>
					<tr>
            <td><strong>Payment terms list: <span class='mandatory_asterick'>*</span></strong></td>			
            <td>  <?php $quote_data['payment_terms_list']= (!empty($quote_data['payment_terms_list']) || $quote_data['payment_terms_list'] != 0)?$quote_data['payment_terms_list']:30;?>
                <select name="payment_terms_list" id="payment_terms" class="textfield width200px" tabindex="5">
                  <option value="">Select Payment terms</option>
                <option <?php if ($quote_data['payment_terms_list'] == 'Immediate' ) echo 'selected' ; ?> value="Immediate">Immediate</option>
                <option <?php if ($quote_data['payment_terms_list'] == 'Prior to Commencement of Project' ) echo 'selected' ; ?> value="Prior to Commencement of Project">Prior to Commencement of Project</option>
                <option <?php if ($quote_data['payment_terms_list'] == 'Prior to deployment of project' ) echo 'selected' ; ?> value="Prior to deployment of project">Prior to deployment of project</option>
                
                <?php     
                  for($i=1; $i<=60; $i++){ ?> 
                    <option <?php if ($quote_data['payment_terms_list'] == $i) echo 'selected' ;  ?> value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php
                  }
                ?>
              </select>
              <div class="ajx_failure_msg" id="payment_terms_err"></div>				
            </td>     
						<td width="115"><strong>Planned End Date (SOW End Date): <span class='mandatory_asterick'>*</span></strong></td>
						<td width="200px">
							<input type="text" data-calendar="true" name="date_due" id="date_due" class="textfield" style=" width:210px" value="" readonly tabindex="15" />
							<div class="ajx_failure_msg" id="date_due_err"></div>
						</td>
					</tr>
					<tr>
          
						<td width="115"><strong>Contract P.O: <span class='mandatory_asterick'>*</span></strong></td>
						<td width="200">					
							<input type="text" name="contarct_po" class="textfield" style=" width:210px" id="contarct_po" maxlength="50" value=""/>
							
							<div class="ajx_failure_msg" id="contarct_po_err"></div>							
						</td>
            <td width="115"><strong>Industry: <span class='mandatory_asterick'>*</span></strong>
						</td>	
								<td>	
									<select name="industry" style="width:220px" id="industry_edit" class="textfield width210px" >
										<option value="not_select">Please Select</option>
										<?php
										foreach ($industry as $ind)
										{
										?>
											<option value="<?php echo $ind['id'] ?>"><?php echo $ind['industry'] ?></option>
										<?php
										}
										?>
									</select>	
									<div class="ajx_failure_msg" id="industry_edit_err"></div>
								</td>	 
						</tr>
					<tr>
						<td><strong style="vertical-align: 8px;">Project Category: <span class='mandatory_asterick'>*</span></strong></td>
						<td>					
							<label for="project_center"><input type="radio" name="project_category" onclick="change_project_category(1);" id="project_center"  value="1" tabindex="6" /> <span class="radlabspa">Profit Center</span></label>
							<label for="cost_center"><input type="radio" name="project_category" id="cost_center" onclick="change_project_category(2);"  value="2" tabindex="7" /> <span class="radlabspa">Cost Center</span></label>
							<div class="ajx_failure_msg" id="project_category_err"></div>							
						</td>
						<td><strong>Browse file (SOW):</strong></td>
						<td>					
							<form name="payment_ajax_file_upload">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
									<input type="file" title='upload' class="textfield"
									multiple="multiple" name="sow_ajax_file_uploader[]" tabindex="16" />
									<input type="hidden" id="exp_type" value="">							
								<td colspan="2">
									<output id="Filelist"></output>
									<ul class="update_image">
											
									</ul>
							</td>				
						</td>
					</tr>
					<tr id="project_center_tr" style="display:none;">
						<td><strong>Profit Center: <span class='mandatory_asterick'>*</span></strong></td>
						<td>
							<select name="project_center_value" id="project_center_value" class="textfield width200px" tabindex="8">
							<?php 
								if(isset($arr_profit_center) && !empty($arr_profit_center)) {
									
									foreach ($arr_profit_center as $list_profit_center) 
									{
									?>
									<option value="<?php echo $list_profit_center['id'] ?>|<?php echo $list_profit_center['profit_center'] ?>" ><?php echo $list_profit_center['profit_center'] ?></option>
									<?php
									}
								}
							?>								
							</select>
							<div class="ajx_failure_msg" id="project_center_value_err"></div>							
						</td>
					</tr>
				
					<tr id="cost_center_tr" style="display:none; height:40px;">
						<td><strong>Cost Center: <span class='mandatory_asterick'>*</span></strong></td>
						<td>
							<select name="cost_center_value" id="cost_center_value" class="textfield width200px" tabindex="9" >
								<?php 
									if(isset($arr_cost_center) && !empty($arr_cost_center)) {
										
										foreach ($arr_cost_center as $list_cost_center) 
										{
										?>
										<option value="<?php echo $list_cost_center['id'] ?>|<?php echo $list_cost_center['cost_center'] ?>" ><?php echo $list_cost_center['cost_center'] ?></option>
										<?php
										}
									}
								?>
							</select>
						<div class="ajx_failure_msg" id="cost_center_value_err"></div>							
						</td>
					</tr>
					<tr>
						<td><strong style="vertical-align: 8px;">Customer Type: <span class='mandatory_asterick'>*</span></strong></td>
						<td>					
							<!-- <label for="int_customer_type"><input type="radio" name="customer_type" id="int_customer_type" <?php echo (isset($quote_data['customer_type']) && $quote_data['customer_type']==0) ? "checked='checked'" : ""; ?> value="0" tabindex="6" /> Internal</label>
							<label for="ext_customer_type"><input type="radio" name="customer_type" id="ext_customer_type" <?php echo (isset($quote_data['customer_type']) && $quote_data['customer_type']==1) ? "checked='checked'" : ""; ?> value="1" tabindex="7" /> External</label>
							<label for="ext_customer_type"><input type="radio" name="customer_type" id="ext_customer_type" <?php echo (isset($quote_data['customer_type']) && $quote_data['customer_type']==2) ? "checked='checked'" : ""; ?> value="2" tabindex="7" /> BPO</label> -->
							<?php
								foreach($this->cfg['customer_type'] as $status_key=>$status_val) {
									?>
									<label for="int_customer_type">
									<input type="radio" name="customer_type" id="ext_customer_type" value="<?php echo $status_key ?>" tabindex="7" /><span class="radlabspa"><?php echo  $status_val ?></span>
									</label>    
									<?php
								}
                             ?>
							<div class="ajx_failure_msg" id="customer_type_err"></div>							
						</td>
						<td><strong style="vertical-align: 7px;">Redmine:</strong></td>
						<td>
							<label for="create_redmine_project"><input type="checkbox" name="redmine_project_status" id="create_redmine_project_check" /> <span class="radlabspa">Create Project in Redmine</span></label>
						</td>
					</tr>
					<tr>
					   <td width="115"><strong>Project Geography: <span class='mandatory_asterick'>*</span></strong></td>	
						<td width="200">
							<!--select name="lead_assign" id="lead_assign" class="textfield width300px"-->
							<div id="geo_region">
								<select  name="project_geography" id="project_geography_val" class="textfield width200px">
									<option value="not_select">Please Select</option>
									<?php
										foreach ($lead_geographys as $lead_geography) {
									?>
										<option value="<?php echo $lead_geography['georegionid'] ?>"><?php echo $lead_geography['georegion_name'];?></option>
									<?php
										}
									?>
								</select>
							</div>	
							<div class="ajx_failure_msg" id="project_geography_value_err"></div>
						</td>
            <td width="115"><strong>Project Location: <span class='mandatory_asterick'>*</span></strong></td>	
  						<td width="200">
  								<select  name="project_location" id="project_location" class="textfield width200px">
  									<option value="not_select">Please Select</option>
  									<?php
  										foreach($this->cfg['project_location'] as $status_key=>$status_val) {
  											?>
  												<option  value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
  											<?php
  										}
  										?>
  								</select>
  							<div class="ajx_failure_msg" id="project_location_err"></div>
  						</td>
					</tr>
				
					<tr>
						<td colspan="4">
							<button type="submit" class="positive" style="float:right;" tabindex="17" >Add Project</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
		
		<div id="tabs-assign-users" >
			<form id="set-assign-users" class="layout">
				<input type="hidden" id="project_lead_id" name="project_lead_id" value='' />
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				 <table class="payment-table">
					<thead>
					<tr>
						<th align="left"><strong>Select Project Manager:</strong></th>
						<th align="left"><strong>Select Team Members:</strong></th>
						<th align="left"><strong>Select Stake Holders:</strong></th>						
					</tr>
					</thead>
					<tbody>
					 <tr>
						<td valign="top"  width="240">
							<select class="chzn-select" id="project_manager" data-placeholder="Select Member" name="project_manager">
							<?php if(!empty($user_accounts)):?>
								<?php foreach($user_accounts as $pms):?>
									<option value=""></option>
									<option  value="<?php echo $pms['userid']?>"><?php echo $pms['first_name'].' '.$pms['last_name'].'-'.$pms['emp_id'];?></option>
								<?php endforeach;?>
							<?php endif; ?>
							</select>
						</td>
						<?php 
						$team_members = array();
						if (is_array($contract_users) && count($contract_users) > 0) { 
							foreach ($contract_users as $data) {
								$team_members[] = $data['userid_fk'];
							}
						}
						?>
						<td valign="top"  width="240">
						<select  class="chzn-select" multiple="multiple" id="project_team_members" data-placeholder="Select Members" name="project_team_members[]">
						<?php if(!empty($user_accounts)):?>
							<!--option value="">Select</option-->
							<?php foreach($user_accounts as $pms):
									$selected = (in_array($pms['userid'],$team_members))?'selected="selected"':'';?>
								<option <?php echo $selected;?> value="<?php echo $pms['userid']?>"><?php echo $pms['first_name'].' '.$pms['last_name'].'-'.$pms['emp_id'];?></option>
							<?php endforeach;?>
						<?php endif; ?>
						</select>	
						</td>
						<?php
							// get stake holders 
							$stake_users_array = array();							
							if(count($stake_holders) > 0 && !empty($stake_holders)):
								foreach($stake_holders as $sh):
									$stake_users_array[] = $sh['user_id'];
								endforeach;
							endif;
						//	echo '<pre>';print_r($restrict1);exit;
						?>						
						<td valign="top"  width="150">
							<select class="chzn-select" multiple="multiple" id="stake_members" data-placeholder="Select Members" name="stake_members[]">
							<?php if(!empty($user_accounts)):?>
								<!--option value="">Select</option-->
								<?php foreach($user_accounts as $pms):
								$selected = (in_array($pms['userid'],$stake_users_array))?'selected="selected"':'';?>
								<option <?php echo $selected; ?> value="<?php echo $pms['userid']?>"><?php echo $pms['first_name'].' '.$pms['last_name'].'-'.$pms['emp_id'];?></option>
								<?php endforeach;?>
							<?php endif; ?>
							</select>	
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<button type="submit" class="positive" style="float:right;" onclick="update_project_users('tabs-assigned-users'); return false;" tabindex="17" >Update</button>
						</td>
					</tr>	
					</tbody>
				 </table>
			</form>
		</div>
		
		<div id="tabs-milestone">
			<form id="set-milestones" class="layout">
			<input type="hidden" id="cus_sap_status" name="cus_sap_status" value="">
			<input type="hidden" id="changes_milestone" name="changes_milestone" value="0">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<table class="payment-table" id="milestone-tbl" >
					<thead>
						<tr>
							<th>Payment Milestone</th>
							<th>Milestone date</th>
							<th>For the Month & Year</th>
							<th>Currency</th>
							<th>Value</th>
							<th>Action</th>
						</tr>
					</thead>
					<tr>
					   <input type="hidden" name="project_id" id="project_id" value"">
				    	<input type="hidden" name="comp_id" value="">
						<td><input type="text" name="project_milestone_name[]" class="project_milestone_name textfield errormsg_milestone" /></td>
						<td><input type="text" data-calendar="true" name="expected_date[]" readonly class="expected_date textfield errormsg_milestone" /></td>
						<td><input type="text" data-calendar="false" class="month_year textfield errormsg_milestone" readonly name="month_year[]" /></td>
						<td>
						
						<div id="currency_row_project_milestone">
								<select name="expect_worth" id="expect_worth" class="textfield width100px">
										<option value="not_select">Please Select</option>
									 <?php 
									foreach ($expect_worth as $expect) {
									?>
										<option value="<?php echo  $expect['expect_worth_id'] ?>"><?php echo  $expect['expect_worth_name'] ?></option>
									<?php
									}
									?> 
									</select>
							</div>
						<!-- <input type="text" class="textfield" value="<?php echo $quote_data['expect_worth_name']; ?>" readonly name="currency_type" style="width: 41px;" /> -->
						</td>
						<td><input onkeypress="return isNumberKey(event)" type="text" name="amount[]" class="amount textfield" maxlength="10" /></td>
						<td>
							<a id="addMilestoneRow" class="createBtn"></a>
							<a id="deleteMilestoneRow" class="del_file" style="margin: 2px 0px 2px 3px;"></a>
						</td>
					</tr>
				</table>
				<div class="buttons" style="width: 100%; position: relative; margin-top: 10px;">
					<button type="submit" style="left: 45%; position: inherit;" class="positive" id="positiveBtn" onclick="confirm_project(); return false;">Send for Approval</button>
				</div>
			</form>
		</div>
		
				
		
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var config = {
			'.chzn-select'           : {},
			'.chzn-select-deselect'  : {allow_single_deselect:false},
			'.chzn-select-no-single' : {disable_search_threshold:10},
			'.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
			'.chzn-select-width'     : {width:"95%"}
		}
		for (var selector in config) {
			$(selector).chosen(config[selector]);
		}
		//on load trigger change and check the redmine checkbox
		$('#department_id_fk').trigger('change');
	}); 
	var usr_level 		 = "<?php echo $username['level']; ?>";
	var cur_project_id   = "<?php echo $project_id; ?>";
	var project_category = "<?php echo $quote_data['project_category']; ?>";
	
	//Trigger change and check the redmine checkbox
	function triggerRedmineCheck(ths) {
		var dep_id = ths.value;
		var entity = $('#entity').val();
		var upd    = null;
		console.log(dep_id);
		if(dep_id == '10'){
			$('#create_redmine_project_check').prop('checked',true);
			var sturl = site_base_url+"welcome/georegion/"+entity+"/"+upd+"/"+dep_id;
			   $('#geo_region').load(sturl);
		}else{
			$('#create_redmine_project_check').prop('checked',false);
			var sturl = site_base_url+"welcome/georegion/"+entity+"/"+upd+"/"+dep_id;
			   $('#geo_region').load(sturl);
		}
	}

	$('#entity').change(function(){
	$('#company').val('');
});
$( "#company" ).autocomplete({
	minLength: 3,
	source: function(request, response) {
		var entityId = $('#entity').find(":selected").val();
		if ($('#entity').val() == '') {
			$('#company').val('');
			alert("Please select the Entity.");
			return;
		}
		$.ajax({
			url: "hosting/ajax_customer_search",
			data: { 'cust_name': $("#company").val(), 'entity_id': entityId,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
			type: "POST",
			dataType: 'json',
			async: false,
			success: function(data) {
				response( data );
			}
		});
	},
	select: function(event, ui) {
		var test = ui.item.value;
		ex_cust_id = ui.item.id;
		regId = ui.item.regId;
		cntryId = ui.item.cntryId;
		stId = ui.item.stId;
		locId = ui.item.locId;
		var comany_list = ui.item.all.find((obj) => obj.company == ui.item.value);
		console.log(comany_list);
		var updt = '';
		//var comany_list = ui.item.all[0];
		$("#currencies").val('all');
		//if(comany_list.is_registered_flag == 'Yes'){
			var reg_flag = comany_list.is_registered_flag;
			//$("inputnameregistered_flag").prop("checked", true);
			$("input[name=registered_flag][value=" + reg_flag + "]").prop('checked', true);

		//}
		
		
		$("#tele1").val(comany_list.tele1);
		$("#group").val(comany_list.group);
		$("#phone").val(comany_list.mobile_num);
		$("#fax").val(comany_list.fax);
		$("#emailval").val(comany_list.email_2);
		$("#www").val(comany_list.www);
		$("#pan_num").val(comany_list.pan_number);
		$("#business").val(comany_list.business_partner);
		//billing address
		$("#add1_line2").val(comany_list.add1_block);
		$("#street").val(comany_list.add1_street_po);
		$("#post_code").val(comany_list.add1_postcode);
		$("#add1_region").val(comany_list.add1_region);
		$("#add1_country").val(comany_list.add1_country);
		$("#add1_state").val(comany_list.add1_state);
		$("#add1_location").val(comany_list.add1_location);
		$("#gst_type").val(comany_list.gst_type);
		$("#gst_in").val(comany_list.gst_in);
		$("#gln").val(comany_list.gln);
		$("#sap_status").val(comany_list.sap_status);
	//	var shipping = comany_list.shipping.split('--');;
	//	console.log(comany_list);
		// $("#ship_block").val(shipping[4]);
		// $("#ship_street_po").val(shipping[5]);
		// $("#ship_zipcode").val(shipping[10]);
		// $("#ship_region").val(shipping[6]);
		// $("#ship_country").val(shipping[7]);
		// $("#ship_state").val(shipping[8]);
		// $("#ship_location").val(shipping[9]);
		// $("#ship_gst_type").val(shipping[11]);
		// $("#ship_gst_in").val(shipping[12]);

		$("#company_id").val(comany_list.companyid);

		$("#custid").val(comany_list.custid)
		$("#cust_id").val(comany_list.custid)
		//Contact Person
		$("#first_name").val(comany_list.first_name);
		$("#middle_name").val(comany_list.middle_name);
		$("#last_name").val(comany_list.last_name);
		$("#title").val(comany_list.position_title);
		$("#position_title").val(comany_list.title);
		$("#cus_address").val(comany_list.cus_address);
		$("#phone_1").val(comany_list.gln);
		$("#cust_tele1").val(comany_list.cus_tele1);
		$("#cust_fax").val(comany_list.cus_fax);
		$("#email_1").val(comany_list.email_1);
		$("#remarks_1").val(comany_list.remarks1);
		$("#skype_name").val(comany_list.gln);
		getCountry(comany_list.add1_region,comany_list.add1_country,updt);
		getState(comany_list.add1_country,comany_list.add1_state,updt);
		getLocation(comany_list.add1_state,comany_list.add1_location,updt);
		//getCountry_ship(shipping[6],shipping[7]);
		//getState_ship(shipping[7],shipping[8]);
		//getLocation_ship(shipping[8],shipping[9]);

	// if(st != 0 && loc != 0)
	// getLocation(st,loc,updt);
		prepareQuoteForClient(ex_cust_id);
		getUserForLeadAssign(regId,cntryId,stId,locId);
	}
});
</script>
<script type="text/javascript" src="assets/js/projects/project_lead_confirmation_view.js?v=3<?php echo CLR_CACHE; ?>"></script>
<style>
	.ui-autocomplete{
		z-index: 99999;
	}
</style>
<script>
$( function() {
    $( "#accordion" ).accordion({
		    collapsible: true,
			autoHeight: false,
			navigation: true,
            heightStyle: "content"			
	 });
});	 
$(".file-tabs-close-confirm-tab").click(function() {
	$("#tabs_close").hide();
	$(".tabs_new").hide();
	$.unblockUI();
	return false;
});
//Apply the validation rules for attachments upload
function ApplyFileValidationRules(readerEvt){
	if (CheckFileType(readerEvt.type) == false) {
                alert("The file (" + readerEvt.name + ") does not match the upload conditions, You can only upload Excel, Word and PDF files");
                e.preventDefault();
                return;
            }
            //To check file Size according to upload conditions
            if (CheckFileSize(readerEvt.size) == false) {
                alert("The file (" + readerEvt.name + ") does not match the upload conditions, The maximum file size for uploads should not exceed 300 KB");
                e.preventDefault();
                return;
            }
}

function close_update(id){
	$.ajax({
		type: "POST",
		data: {"id":id,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
		cache:false,
		url : site_base_url + 'customers/delete_custom_customer_upload/',
	
		success: function(res) {
			console.log(res);
			$('#remove-'+id).remove();
		}	
	 });				
}
function CheckFileType(fileType) {
            if (fileType == "application/msword") {
                return true;
            }
            else if (fileType == "application/pdf") {
                return true;
            }
            else if (fileType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                return true;
            }else if (fileType == "application/vnd.ms-excel") {
                return true;
            }
            else {
                document.getElementById("files").value = "";
                return false;
            }
            return true;
}
function CheckFileSize(fileSize) {
	if (fileSize < 10762150) {
		return true;
	}
	else {
		return false;
	}
	return true;
}

function validatePanNumber(panNum){
	var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
	if(regpan.test(panNum) == false)
	{
		$('#pan_num_err').hide();
		document.getElementById("status").innerHTML = "PAN is not yet valid.";

	}else{
		document.getElementById("status").innerHTML ='';

		return '1';
	}
	
}

 //To remove attachment once user click on x button
 jQuery(function ($) {
            $('div').on('click', '.image-div .close', function () {
                var id = $(this).closest('.img-wrap').find('img').data('id');

                //to remove the deleted item from array
                var elementPos = AttachmentArray.map(function (x) { return x.FileName; }).indexOf(id);
                if (elementPos !== -1) {
                    AttachmentArray.splice(elementPos, 1);
                }

                //to remove image tag
                $(this).parent().find('img').not().remove();

                //to remove div tag that contain the image
                $(this).parent().find('div').not().remove();

                //to remove div tag that contain caption name
                $(this).parent().parent().find('div').not().remove();

                //to remove li tag
                var lis = document.querySelectorAll('#imgList li');
                for (var i = 0; li = lis[i]; i++) {
                    if (li.innerHTML == "") {
                        li.parentNode.removeChild(li);
                    }
                }

            });
        }
        )
  //To save an array of attachments 
var AttachmentArray = [];

//counter for attachment array
var arrCounter = 0;

//to make sure the error message for number of files will be shown only one time.
var filesCounterAlertStatus = false;

//un ordered list to keep attachments thumbnails
var ul = document.createElement('ul');
ul.className = ("thumb-Images");
ul.id = "imgList";
//Render attachments thumbnails.
function RenderThumbnail(e, readerEvt)
        {
			
            var li = document.createElement('li');
            ul.appendChild(li);
            li.innerHTML = ['<div class="image-div">' +
                '<p class="thumb"  title="', escape(readerEvt.name), '" data-id="',
                readerEvt.name, '"/></p>' + '<span class="close">&times;</span> </div>'].join('');

            var div = document.createElement('div');
            div.className = "FileNameCaptionStyle";
            li.appendChild(div);
            div.innerHTML = [readerEvt.name].join('');
            document.getElementById('Filelist').insertBefore(ul, null);
		}
		
//Fill the array of attachment
function FillAttachmentArray(e, readerEvt)
        {
            AttachmentArray[arrCounter] =
            {
                AttachmentType: 1,
                ObjectType: 1,
                FileName: readerEvt.name,
                FileDescription: "Attachment",
                NoteText: "",
                MimeType: readerEvt.type,
                Content: e.target.result.split("base64,")[1],
                FileSizeInBytes: readerEvt.size,
            };
            arrCounter = arrCounter + 1;
        }

		
$(".errormsg").keyup(function(){	

	$("#changes").val(1);
	

});	
$(".errormsg_milestone").keyup(function(){	

$("#changes_milestone").val(1);


});

$('input:radio[name="registered_flag"]').change(
    function(){
		$("#changes").val(1);
    });
$('select').on('change', function() {
	var entity = $("#entity").val();
	if(entity == 1){
		$("#selectchanges").val(0);
	}else if(entity == 2){
		$("#selectchanges").val(0);
	}else if(entity == 3){
		$("#selectchanges").val(0);
	}else if(entity == 4){
		$("#selectchanges").val(0);
	}else if(entity == 7){
		$("#selectchanges").val(0);
	}else{
		$("#selectchanges").val(1);
	}
	
	
});	

function download_files(f_name){
	window.open(site_base_url+'crm_data/files/customer_upolad/'+f_name,'_blank');
}

</script>
<style>.blockUI #tabledisplay td:last-child{display:none;} 
#access_setting ul.chzn-results {
    height: 80px;
}
.ui-state-active {
    background: #4b6fb9 !important;
    color: #fff !important;
}
.font_14{
    font-size: 14px !important;
}
#accordion{
	margin-right:15px !important;
}
.widthchnage input[type="text"]{
	width:175px;
	margin-right:20px;
}
.widthchnage select{
	width:185px;
	margin-right:20px;
}
ul#imgList li {
    display: inline-block;
    margin-right: 10px;
}

ul#imgList li div {
    display: inline-block;
    margin-right: 5px;
}

ul#imgList p {
    padding: 0;
}

span.update {
    width: 12px;
    height: 12px;
    display: inline-block;
    background: #d03535;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 12px;
}

span.close {
    width: 12px;
    height: 12px;
    display: inline-block;
    background: #d03535;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 12px;
}
#files {
    margin: 21px 15px !important;
}
ul.update_image li {
    display: inline-block;
    margin-right: 5px;
    margin-bottom: 2px;
}
select[id=expect_worth_id_milestone] {
	pointer-events: none;
}
</style>
