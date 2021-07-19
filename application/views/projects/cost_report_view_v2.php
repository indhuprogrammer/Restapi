<?php require (theme_url().'/tpl/header.php');?>
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
.td_wordwrap { word-break: break-word;}
</style>
<script type="text/javascript">var this_is_home = true;</script>
<div id="content">
    <div class="inner">
        <?php //if($this->session->userdata('viewPjt')==1) { ?>
        <?php if($this->session->userdata('accesspage')==1) { ?>
			<div class="page-title-head">
				<h2 class="pull-left borderBtm"><?php echo $page_heading ?></h2>
				<a class="choice-box" onclick="advanced_filter();" >
					<img src="assets/img/advanced_filter.png" class="icon leads" />
					<span>Advanced Filters</span>
				</a>
				<div class="section-right">
					<!--<div class="buttons add-new-button">
						<button id='expand_tr' class="positive" type="button">
							Expand
						</button>
					</div>
					<div class="buttons collapse-button">
						<button id='collapse_tr' class="positive" type="button">
							Collapse
						</button>
					</div>-->
					<div class="buttons export-to-excel">
						<button type="button" class="positive" id="btnExport">
							Export to Excel
						</button>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="buttons">
					<form name="fliter_data" id="fliter_data" method="post">
					<!--button  type="submit" id="excel-1" class="positive">
						Export to Excel
					</button-->
					<input type="hidden" name="exclude_leave" value="" id="hexclude_leave" />
					<input type="hidden" name="exclude_holiday" value="" id="hexclude_holiday" />
					<input type="hidden" name="month_year_from_date" value="" id="hmonth_year" />
					<input type="hidden" name="month_year_to_date" value="" id="hmonth_to_year" />
					<input type="hidden" name="department_ids" value="" id="hdept_ids" />
					<input type="hidden" name="business_unit_id" value="" id="hbusiness_unit_id" />
					<input type="hidden" name="practice_ids" value="" id="hprac_ids" />
					<input type="hidden" name="entity_ids" value="" id="henty_ids" />
					<input type="hidden" name="skill_ids" value="" id="hskill_ids" />
					<input type="hidden" name="resource_type_ids" value="" id="hresource_type_ids" />
					<input type="hidden" name="member_ids" value="" id="hmember_ids" />
					<input type="hidden" name="project_res" value="" id="hproject_res" />
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
			<div id="filter_section">
				<div class="clear"></div>
				<div id="advance_search" style="padding-bottom:15px; display:none;">
				<form name="project_dashboard" id="project_dashboard">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
						<div style="border: 1px solid #DCDCDC;">
							<table cellpadding="0" cellspacing="0" class="data-table leadAdvancedfiltertbl" >
							<thead>
								<tr>
									<td class="tblheadbg">MONTH & YEAR</td>
									<td class="tblheadbg">EXCLUDE</td>
									<td class="tblheadbg">ENTITY</td>
									<td class="tblheadbg">BUSINESS UNIT</td>
									<td class="tblheadbg">DEPARTMENT</td>
									<td class="tblheadbg">PRACTICE</td>
									<td class="tblheadbg">SKILL</td>
									
								</tr>
							</thead>
							<tbody>	
								
								<tr>
									<td class="month-year" style="width: 150px;">
										<span>From</span> <input type="text" data-calendar="false" name="month_year_from_date" id="month_year_from_date" class="textfield" value="<?php echo date('F Y',strtotime($start_date)); ?>" />
										<br />
										<span>To</span> <input type="text" data-calendar="false" name="month_year_to_date" id="month_year_to_date" class="textfield" value="<?php echo date('F Y',strtotime($end_date)); ?>" />
									</td>
									<td class="by-exclusion" style="width: 60px;">
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
										</select>
									</td>
									<td class="proj-dash-select">
										<select title="Select Department" id="department_id_fk" name="department_ids[]"	multiple="multiple">
										</select>
									</td>
									<td class="proj-dash-select">
										<select multiple="multiple" title="Select Practice" id="practices" name="practice_ids[]">
										</select>
									</td>
									<td class="proj-dash-select">
										<select title="Select Skill" id="skill_id" name="skill_ids[]"	multiple="multiple">
										
										</select>
									</td>
								</tr>
								</tbody>
								<thead>	
									<tr>
                    <td class="tblheadbg">PROJECT LOCATON</td>
										<td class="tblheadbg">RESOURCE TYPE</td>
										<td class="tblheadbg" colspan="2">RESOURCE</td>
										<td class="tblheadbg">PROJECTS</td>
										<td class="tblheadbg">CUSTOMER TYPE</td>
										<td class="tblheadbg" colspan="2">GEOGRAPHY</td>
									</tr>
								</thead>	
								<tbody>
								<tr>
                  <td class="proj-dash-select">
										<select title="Select Project Location" id="project_location" name="project_location[]" multiple="multiple">
										<?php
										foreach($this->cfg['project_location'] as $status_key=>$status_val) {
											?>
												<option  value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
											<?php
										}
										?>
										</select>
									</td>
									<td class="proj-dash-select" style="width: 10%;">
										<select title="Select ResourceType" id="resource_type_ids" name="resource_type_ids[]" multiple="multiple">
											<?php if(count($resource_type_ids_selected)>0 && !empty($resource_type_ids_selected)) { ?>
											<?php foreach($resource_type_ids_selected as $resource_type) {
												$resource_type->name = ($resource_type->id==0)?'N/A':$resource_type->name;
													?>
												<option <?php echo in_array($resource_type->id,$resource_type_ids)?'selected="selected"':'';?> value="<?php echo $resource_type->skill_id; ?>"><?php echo $resource_type->name;?></option>
											<?php } }?>
										</select>
									</td>
									<td class="proj-dash-select" colspan="2">
										<select id="member_ids" name="member_ids[]" multiple="multiple">
											<?php if(count($member_ids_selected)>0 && !empty($member_ids_selected)){?>
											<?php foreach($member_ids_selected as $members){?>
													<option <?php echo in_array($members->username, $member_ids)?'selected="selected"':'';?> value="<?php echo $members->username;?>" title="<?php echo $members->emp_name.' - '.$members->emp_id;?>"><?php echo $members->emp_name;?></option>
											<?php } }?>
										</select>
									</td>
									<td class="proj-dash-select" style="width: 250px;">
										<select title="Select Project" id="project_res" name="project_res[]" multiple="multiple">
											<?php if(count($all_projects)>0 && !empty($all_projects)) { ?>
											<?php foreach($all_projects as $key=>$val){?>
													<option <?php echo in_array($key,$sel_project_reslt)?'selected="selected"':'';?> value="<?php echo $key;?>"><?php echo $val;?></option>
											<?php } }?>
										</select>
									</td>
									<td class="proj-dash-select">
										<select multiple="multiple" id="customer_type" name="customer_type[]" class="advfilter" style="width:150px;">
									<!-- <option value="0">Internal</option>
									<option value="1">External</option>
									<option value="2">BPO</option> -->
									<?php
                                            foreach($this->cfg['customer_type'] as $status_key=>$status_val) {
                                                ?>
                                                    <option value="<?php echo $status_key; ?>"><?php echo $status_val; ?></option>
                                                <?php
                                            }
                                        ?>
									</select>
								</td>
									<td colspan="2" class="proj-dash-select">
									<select multiple="multiple" title="Select Practice" id="geography_ids" name="geography_ids[]">
										<?php if(count($geographies)>0 && !empty($geographies)) { ?>
												<?php foreach($geographies as $geography) {?>
													<option <?php echo in_array($geography->georegionid, $geography_ids)?'selected="selected"':'';?> value="<?php echo $geography->georegionid;?>"><?php echo $geography->georegion_name;?></option>
										<?php } } ?>
									</select>
								    </td>
								</tr>
								<tr align="right" >
									<td colspan="10">
										<input type="hidden" id="start_date" name="start_date" value="" />
										<input type="hidden" id="end_date" name="end_date" value="" />
										<input type="hidden" id="filter_area_status" name="filter_area_status" value="" />
										<input type="reset" class="positive input-font" name="advance" id="filter_reset" value="Reset" />
										<input type="button" onclick="advance_cost_report();"class="positive input-font" name="advance" id="advance" value="Search" />
										<div id = 'load' style = 'float:right;display:none;height:1px;'>
											<img src = '<?php echo base_url().'assets/images/loading.gif'; ?>' width="54" />
										</div>
									</td>
								</tr>
								</tbody>	
							</table>
						</div>
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="ajax_loader" style="margin:10px;display:none" align="center">
				Loading Content.<br><img alt="wait" src="<?php echo base_url().'assets/images/ajax_loader.gif'; ?>"><br>Thank you for your patience!
			</div>
			<div id="ajax_cost_report" style="margin:0 !important;">
			<div class="clearfix"></div>
        <?php
		} else {
			echo "You have no rights to access this page";
		}
		?>
	</div>
</div>

<script type="text/javascript">
var cur_mon = '<?php echo date('F Y') ?>';
var filter_area_status = '<?php echo $filter_area_status; ?>';
if(filter_area_status==1) {
	$('#advance_search').show();
}
$(function() {
	/*Date Picker*/
	$( "#month_year_from_date, #month_year_to_date" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'MM yy',
		maxDate: 0,
		showButtonPanel: true,
		onClose: function(dateText, inst) {
			var month 	= $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year 	= $("#ui-datepicker-div .ui-datepicker-year :selected").val();
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

	$('#btnExport').on('click',function(e) {
		e.preventDefault();
		var url 	= site_base_url+"projects/dashboard/cost_report_export_v2";

		var form = $('<form action="' + url + '" method="post">' +
		'<input id="token" type="hidden" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
		'<input type="hidden" name="month_year_from_date" id="hidden_month_year_from_date" value="'+$('#month_year_from_date').val()+ '" />' +
		'<input type="hidden" name="month_year_to_date" id="hidden_month_year_to_date" value="'+$('#month_year_to_date').val()+ '" />' +
		'<input type="hidden" name="exclude_leave" id="hidden_exclude_leave" value="'+$('#exclude_leave').val()+'" />' +
		'<input type="hidden" name="exclude_holiday" id="hidden_exclude_holiday" value="' +$('#exclude_holiday').val()+ '" />' +
		'<input type="hidden" name="entity_ids" id="hidden_entity_ids" value="' +$('#entity_ids').val()+ '" />' +
		'<input type="hidden" name="business_unit_id" id="hidden_business_unit_id" value="' +$('#business_unit_id').val()+ '" />' +
		'<input type="hidden" name="department_ids" id="hidden_department_ids" value="' +$('#department_id_fk').val()+ '" />' +
		'<input type="hidden" name="practice_ids" id="hidden_practice_ids" value="' +$('#practices').val()+ '" />' +
		'<input type="hidden" name="skill_ids" id="hidden_skill_ids" value="' +$('#skill_id').val()+ '" />' +
		'<input type="hidden" name="resource_type_ids" id="hidden_resource_type_ids" value="' +$('#resource_type_ids').val()+ '" />' +
		'<input type="hidden" name="member_ids" id="hidden_member_ids" value="' +$('#member_ids').val()+ '" />' +
		'<input type="hidden" name="project_res" id="hidden_project_res" value="' +$('#project_res').val()+ '" />' +
		'<input type="hidden" name="customer_type[]" id="hidden_customer_type" value="' +$('#customer_type').val()+ '" />' +
		'<input type="hidden" name="project_location[]" id="hidden_project_location" value="' +$('#project_location').val()+ '" />' +
		'<input type="hidden" name="geography_ids[]" id="hidden_geography_ids" value="' +$('#geography_ids').val()+ '" />' +
		'</form>');
		$('body').append(form);
		$(form).submit();
		return false;
	});
});
$(document).ready(function(){
  
	$("#business_unit_id").change(function(){
		$("#filter_area_status").val('1');
    $('#skill_id').html('');
    getMembers();
    getProjects();
	});
	$("#department_id_fk").change(function(){
    getMembers();
    getProjects();
	});
	$("#practices").change(function(){
    getMembers();
    getProjects();
	});
	$("#skill_id").change(function(){
    getMembers();
	});
  
  function getMembers() {
    var business_unit_id = $("#business_unit_id").val();
    var department_id_fk = $("#department_id_fk").val();
    var practices = $("#practices").val();
    var skill_id = $("#skill_id").val();
		var start_date = $('#month_year_from_date').val();
		var end_date   = $('#month_year_to_date').val();
		var params = {'department_id_fk':department_id_fk,'business_unit_id':business_unit_id,
    'practices':practices,'skill_id':skill_id,'start_date':start_date,'end_date':end_date,'ci_csrf_token':csrf_hash_token};
    $.ajax({
      type: 'POST',
      url: site_base_url+'projects/dashboard/get_members',
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
  
  function getProjects() {
    var business_unit_id = $("#business_unit_id").val();
    var department_id_fk = $("#department_id_fk").val();
    var practices = $("#practices").val();
    var skill_id = $("#skill_id").val();
		var start_date = $('#month_year_from_date').val();
		var end_date   = $('#month_year_to_date').val();
		var params = {'department_id_fk':department_id_fk,'business_unit_id':business_unit_id,
    'practices':practices,'skill_id':skill_id,'start_date':start_date,'end_date':end_date,'ci_csrf_token':csrf_hash_token};
    $.ajax({
      type: 'POST',
      url: site_base_url+'projects/dashboard/get_projects',
      data: params,
      success: function(projects) {
        if(projects){
          var proj_html='';
          var pjcts = $.parseJSON(projects);
          if(pjcts.length){
            for(var i=0;i<pjcts.length;i++){
              proj_html +='<option value="'+pjcts[i].project_code+'">'+pjcts[i].lead_title+'</option>';
            }
          }
          $('#project_res').html('');
          $('#project_res').append(proj_html);
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

		$.ajax({
			type: 'POST',
			url: site_base_url+'projects/dashboard/get_skill_members',
			data: params,
			success: function(members) {
				if(members){
					var mem_html;
					var users = $.parseJSON(members);
					if(users.length){
						for(var i=0;i<users.length;i++){
							mem_html +='<option value="'+users[i].username+'" title="'+users[i].emp_name+' - '+users[i].emp_id+'">'+users[i].emp_name+'</option>';
						}
					}
					$('#member_ids').html('');
					$('#member_ids').append(mem_html);
				}
			}
		});
	});

	$("input[name=exclude_leave]").prop("checked",true);
	$("input[name=exclude_holiday]").prop("checked",true);
  advance_cost_report();
});

function getData(resource_type, dept_type)
{
	$('#filter_group_by').prop('selectedIndex',0);
	if($('#department_ids').val() == null) {
		$('#hdept_ids').val('');
	} else {
		$('#hdept_ids').val($('#department_ids').val());
	}
	if($('#practice_ids').val() == null) {
		$('#hprac_ids').val('');
	} else {
		$('#hprac_ids').val($('#practice_ids').val());
	}
	if($('#entity_ids').val() == null) {
		$('#henty_ids').val('');
	} else {
		$('#henty_ids').val($('#entity_ids').val());
	}
	$('#hmonth_year').val($('#month_year_from_date').val());
	$('#hmonth_to_year').val($('#month_year_to_date').val());
	$('#hskill_ids').val($('#skill_ids').val())
	$('#hmember_ids').val($('#member_ids').val())
	if($('#exclude_leave').attr('checked'))
	$('#hexclude_leave').val(1);
	if($('#exclude_holiday').attr('checked'))
	$('#hexclude_holiday').val(1)

	var formdata = $('#fliter_data').serialize();

	$.ajax({
		type: "POST",
		url: site_base_url+'projects/dashboard/get_data_beta/',
		data: formdata+'&resource_type='+resource_type+'&dept_type='+dept_type+'&filter_group_by=0',
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
/**
 * This function for load IT cost report using Ajax call.
 */
function advance_cost_report(){
	$("#ajax_cost_report" ).hide();
	$('#ajax_loader').slideToggle('slow');
	var formdata = $('#project_dashboard').serialize();
  console.log(formdata);
		$.ajax({
			type: 'POST',
			url: site_base_url+'projects/dashboard/advanced_cost_report',
			data: formdata,
			success: function(data) {
				$('#ajax_loader').hide();
				$("#ajax_cost_report" ).show();
				// $("#default_view" ).remove();
				$("#ajax_cost_report").html(data);
				//data table
				$('#it_cost_grid').dataTable({
					"bInfo": false,
					"bFilter": true,
					"bPaginate": false,
					"bProcessing": false,
					"bServerSide": false,
					"bLengthChange": false,
					"bDestroy": true,
					'bAutoWidth': true,
          "oLanguage": {
              "sEmptyTable": "No results found for above search filters"
          },
          "aoColumnDefs": [
              {'aTargets': [1,2,3,4,5,6,7,8,9,10], 'sClass': 'td_wordwrap'  }
          ]
				});
			}
		});
}

function get_advanced_search_all_projects() {
	$.ajax({
			type: 'GET',
			url: site_base_url+'projects/dashboard/get_advanced_search_all_projects',
			success: function(data) {
				//project data append
				if(!$.isEmptyObject(data.all_projects)){
					var project_html = '';
					var all_projects = data.all_projects;
					$.each( all_projects, function( key, value ) {
						project_html +='<option value="'+key+'">'+value+'</option>';
					});
					$('#project_res').html('');
					$('#project_res').append(project_html);
				}
			}
		});
}
// get_advanced_search_all_projects();

function advanced_filter() {
		$('#ajax_loader').slideToggle('slow');
		var formdata = $('#project_dashboard').serialize();
		$.ajax({
			type: 'POST',
			url: site_base_url+'projects/dashboard/advanced_search_cost_report',
			data: formdata,
			success: function(data) {
				$('#ajax_loader').hide();
				$('#advance_search').slideToggle('slow');
				var data = $.parseJSON(data);
                // Entity data Append
				if(!$.isEmptyObject(data.entitys)){
					var entity_html = '';
					var entitys = data.entitys;
					if(entitys.length > 0){
						for(var i=0;i<entitys.length;i++){
							entity_html +='<option value="'+entitys[i].div_id+'">'+entitys[i].division_name+'</option>';
						}
					}
					$('#entity_ids').html('');
					$('#entity_ids').append(entity_html);
				}
        
        // Business Unit data Append
				if(!$.isEmptyObject(data.business_unit)){
					var bu_html = '';
					var business_unit = data.business_unit;
					if(business_unit.length > 0){
						for(var i=0;i<business_unit.length;i++){
							bu_html +='<option value="'+business_unit[i].id+'">'+business_unit[i].business_unit+'</option>';
						}
					}
					$('#business_unit_id').html('');
					$('#business_unit_id').append(bu_html);
				}

				// Department data Append
				if(!$.isEmptyObject(data.departments)){
					var depart_html = '';
					var departments = data.departments;
					if(departments.length > 0){
						for(var i=0;i<departments.length;i++){
							depart_html +='<option value="'+departments[i].department_id+'">'+departments[i].department_name+'</option>';
						}
					}
					$('#department_ids').html('');
					$('#department_ids').append(depart_html);
				}

				//Skill details  data Append
				if(!$.isEmptyObject(data.skill_ids_selected)){
					var skill_html = '';
					var skill_ids_selected = data.skill_ids_selected;
					if(skill_ids_selected.length > 0){
						for(var i=0;i<skill_ids_selected.length;i++){
							skill_html +='<option value="'+skill_ids_selected[i].skill_id+'">'+skill_ids_selected[i].name+'</option>';
						}
					}
					$('#skill_ids').html('');
					$('#skill_ids').append(skill_html);
				}

				//practice_ids data append
				if(!$.isEmptyObject(data.practice_ids)){
					var practice_html = '';
					var practice_ids = data.practice_ids;
					if(practice_ids.length > 0){
						for(var i=0;i<practice_ids.length;i++){
							practice_html +='<option value="'+practice_ids[i].id+'">'+practice_ids[i].practices+'</option>';
						}
					}
					$('#practice_ids').html('');
					$('#practice_ids').append(practice_html);
				}
				//resource_type data append
				if(!$.isEmptyObject(data.resource_type)){
					var resource_type_html = '';
					var resource_types = data.resource_type;
					$.each(resource_types, function( key, value ) {
						resource_type_html +='<option value="'+value.id+'">'+value.name+'</option>';
					});
					$('#resource_type_ids').html('');
					$('#resource_type_ids').append(resource_type_html);
				}

				//project data append
				if(!$.isEmptyObject(data.all_projects)){
					var project_html = '';
					var all_projects = data.all_projects;
					$.each( all_projects, function( key, value ) {
						project_html +='<option value="'+key+'">'+value+'</option>';
					});
					$('#project_res').html('');
					$('#project_res').append(project_html);
				}

			}
		});

	$("input[name=exclude_leave]").prop("checked",true);
	$("input[name=exclude_holiday]").prop("checked",true);
}
$('#filter_reset').click(function() {
	 $("#project_dashboard").find('input:checkbox').removeAttr('checked').removeAttr('selected');
	 $("#practice_ids").html('');
	 $("#skill_ids").html('');
	 $("#member_ids").html('');
	 $("#project_res").html('');
	 $('select#entity_ids option').removeAttr("selected");
	 $('select#department_id_fk option').removeAttr("selected");
	 $('select#project_res option').removeAttr("selected");
});

</script>
<script type="text/javascript" src="assets/js/projects/bu_changes.js"></script>
<?php require (theme_url().'/tpl/footer.php'); ?>
