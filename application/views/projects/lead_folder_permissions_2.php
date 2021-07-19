<?php
if(count($team_members)>0){ 
	$tbl_width = count($team_members)*190;
} else {
	$tbl_width = '800';
}
if(count($team_members)<=3){
	$tbl_width = '850';
}
?>
<script>
var tbl_width = '<?php echo $tbl_width ?>';
$("#fixTable").css("width", tbl_width);
</script>
<style>
#parent {height: 460px;}
.buttons button { margin: 0 0 0 10px; overflow: visible; padding: 1px 10px 3px 7px; width: auto; }
</style>
<form name="form_lead_folder_permissions" id="form_lead_folder_permissions">
<input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead_id; ?>" />
<?php
	$access_rt = array();
	if(!empty($folders_access) && (count($folders_access)>0)){
		foreach($folders_access as $rec)
		$access_rt[$rec['folder_id']][$rec['user_id']] = $rec['access_type'];
	}
?>
<!--table class="folder-permission-content"-->
<div id="parent" class="custom_table_sort">
<table cellpadding="0" cellspacing="0" id="fixTable" class="table" >
	<thead>
		<tr>
			<th class="table_header">Folders</th>
			<?php
			foreach($team_members as $member)
			{
				$initial = '';
				if($member['last_name'])
				{
					$initial = substr($member['last_name'], 0, 1);
				}
			?>
			<th class="table_header">
				<div class="user_name">
					<p><?php echo $member['first_name'].' '.$initial; ?></p>
				
					<br>
					<label><input type="checkbox" id="rd-read" class='checked_all' name="all_read" value="<?=$member['userid_fk']?>" /> R</label>
					<label><input type="checkbox" id="rd-write" class='checked_all' name="all_write" value="<?=$member['userid_fk']?>" /> W</label>
					<label><input type="checkbox" id="rd-none" class='checked_all' name="all_none" value="<?=$member['userid_fk']?>" /> N</label>
					</div>
			</th>
			<?php 
			}
			?>
		</tr>
		
		
	</thead>
	<tbody>
		<?php
		foreach($lead_folders as $folder_id => $folder_name) 
		{
			?>
			<tr>
				<td class="folder_name">
					<?php echo $folder_name; ?>
				</td>
				<?php foreach($team_members as $member) { ?>
					<?php
						$rd_name      = 'permission_for_'.$folder_id.'_'.$member['userid_fk'];
						$read_checked = $write_checked = $none_checked = "";
						if(isset($folders_access) && !empty($folders_access)) {
							$stat = isset($access_rt[$folder_id][$member['userid_fk']]) ? $access_rt[$folder_id][$member['userid_fk']] : 0;
							switch($stat) {
								case 1:
									$read_checked  = 'checked="checked"';
								break;
								case 2:
									$write_checked = 'checked="checked"';
								break;
								case 0:
									$none_checked  = 'checked="checked"';
								break;
								default:
									$none_checked  = 'checked="checked"';
							}							
						} else {
							$none_checked  = 'checked="checked"';
						}
					?>
				<td class="user_permision">
					<div>
						<input type="radio" data-value=<?php echo $folder_id;?> id="<?=$rd_name?>_read" name="<?=$rd_name?>" class="<?php echo 'rd-read-'.$member['userid_fk']?> permission_changed" value="1" <?=$read_checked?> />R
					</div>
					<div>
						<input type="radio" id="<?=$rd_name?>_write" name="<?=$rd_name?>" class="<?php echo 'rd-write-'.$member['userid_fk']?> permission_changed" value="2" <?=$write_checked?> />W
					</div>
					<div>
						<input type="radio" id="<?=$rd_name?>_none" name="<?=$rd_name?>" class="<?php echo 'rd-none-'.$member['userid_fk']?> permission_changed"  value="0" <?=$none_checked?> />N
					</div>
				</td>
				<?php } ?>
			</tr>
			<?php
		} ?>
	</tbody>
</table>
</div>
<fieldset class="folder-rt">
	<legend>Legend</legend>
	<div align="left" style="background: none repeat scroll 0 0 #3b5998;">
		<!--Legends-->
		<div class="legend legend-folder-rt">
			<div class="pull-left"><strong>R</strong> - Read</div>
			<div class="pull-left"><strong>W</strong> - Write</div>
			<div class="pull-left"><strong>N</strong> - No Access</div>
		</div>
	</div>
</fieldset>
<div class="buttons"><button class="positive save_btn" onclick="save_permissions(); return false;">Save</button></div>
<div class="buttons"><button class="negative" onclick="$.unblockUI(); return false;">Cancel</button></div>
</form>
<script type="text/javascript">

var changed_permis_obj = {};
var all_permissions_obj = {};

function save_permissions(){
	// var data = $("form").serialize();
	var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
	var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

	var sendData = {
		'lead_id': document.getElementById('lead_id').value,
		'ci_csrf_token' : csrfHash,
		'permissions': [],
	}
    var  permission_array = [];
	$.each(all_permissions_obj, function(key, value) {
		var split_folderid_userid = key.split("_");
		//None permissions
		if(value == 0){
			permission_array.push({
				'folder_id': split_folderid_userid[2],
				'user_id'  : split_folderid_userid[3],
				'permission': 0,
			});
		}
		// Read permission
		if(value == 1){
            permission_array.push({
				'folder_id': split_folderid_userid[2],
				'user_id'  : split_folderid_userid[3],
				'permission': 1,
			});
		}
		// Write permission
		if(value == 2){
			permission_array.push({
				'folder_id': split_folderid_userid[2],
				'user_id'  : split_folderid_userid[3],
				'permission': 2
			});
		}
	});
	sendData.permissions = permission_array ;

	if(permission_array.length == 0){
		alert('Permissions not modified. please try again.');
		return false;
	}
	$.ajax({
		url    : site_base_url+'project/save_folder_permissions',
		method : 'POST',
		data   : sendData,
		dataType: "json",
		cache: false,
		beforeSend: function(){
			$('.save_btn').text('Saving..');
			$('.save_btn').prop('disabled', true);
		},
		success: function(response) {
			$('.save_btn').text('Save');
			$('.save_btn').prop('disabled', false);
			if(response.result == 'success'){
				$.unblockUI();
				alert(response.msg);
			}
			else{
				alert(response.msg);
			}
		}
	})
}

$( ".permission_changed" ).change(function() {
	var ele     = $(this);
	var name    = ele.attr('name');
	var checked = ele.val();
	if (ele.is(':checked')) {
	   all_permissions_obj[name] = checked;
	}
});

$(document).ready(function() {
	$("#fixTable").tableHeadFixer({"left" : 1}); 
} );

$(document).on('change', '.checked_all', function(event){
	var type = $(this).attr('id');
	var uid  = $(this).val();
	if($(this).is(':checked')) {
		$('.'+type+'-'+uid).prop('checked',true);
		var elements = document.getElementsByClassName(type+'-'+uid);
		for( var i =0; i<elements.length; i++){
			all_permissions_obj[elements[i].name] = elements[i].value;
		}
		switch(type){
			case 'rd-read':
				$('#rd-write, #rd-none').prop('checked',false);
			break;
			case 'rd-write':
				$('#rd-read, #rd-none').prop('checked',false);
			break;
			case 'rd-none':
				$('#rd-write, #rd-read').prop('checked',false);
			break;
		}
	} else {
		$('.rd-none-'+uid).prop('checked',true);
	}
});
</script>