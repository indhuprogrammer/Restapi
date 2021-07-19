<?php require (theme_url().'/tpl/header.php'); ?>
<style>

.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.fade.in {
    opacity: 1;
}
.alert-dismissable, .alert-dismissible {
    padding-right: 35px;
}
.fade {
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear;
}
</style>
<div id="content">
    <div class="inner customerpage">
        <?php  if($this->session->userdata('accesspage')==1) {   
            
            ?>
		<div class="page-title-head">
			<h2 class="pull-left borderBtm">Waiting for Approver Projects List</h2>
			<div class="clearfix"></div>
		</div>		
        <div class="dialog-err" id="dialog-err-msg" style="font-size:13px; font-weight:bold; padding: 0 0 10px; text-align:center;"></div>
		<div class="clear"></div>
		
		<?php
		if($this->session->flashdata('item')) {
		  $message = $this->session->flashdata('item');
		  ?>
		<div class="<?php echo $message['class']?> fade in alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <?php echo $message['message']; ?></div>
		<?php 
		}
		?>
	
        <table border="0" cellpadding="0" cellspacing="0" class="project_dt dashboard-heads dataTable" style="width:100%">
      			<thead>
                <tr>
                    <th>Project Title</th>
          					<th>Entity</th>
          					<th>Business Unit</th>
          					<th>Departments</th>
                    <th>Practice</th>
          					<th>Project Type</th>
          					<th>Project Geography</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($leads) && count($leads) > 0) { ?>
                    <?php foreach ($leads as $lead) {
                    ?>
                    <tr>
                        <td><?php echo $lead['lead_title'] ?></td>
                        <td><?php echo $lead['division_name'] ?></td>
                        <td><?php echo $lead['practices'] ?></td>
                        <td><?php echo $lead['business_unit_name'] ?></td>
						            <td><?php echo $lead['department_name'] ?></td>
						            <td><?php echo $lead['project_types'] ?></td>
						            <td><?php echo $lead['georegion_name'] ?></td>
					
            					<?php  $access_1 = access_action(array('approver_1'));
            			           $access_2  = access_action(array('approver_2'));
            			           $approver_1  = json_decode($access_1[0]->members); 	
                             $approver_2  = json_decode($access_2[0]->members);
            					?>
                          					<td>
              					<?PHP
              				   if($lead['approval_status'] == 'Approver_1'){ ?>				   		     
              					 <?php if(!empty($approver_1) && in_array($this->userdata['userid'],$approver_1)){ ?>		
              					 <button type="submit" class="positive" onclick="approvalView(<?php echo $lead['lead_id']; ?>); return false;">Waiting for Approver 1</button>
              					 <?php }else{
              						echo 'Waiting for Approver 1'; 
              					 }
              					 }
              					 else if($lead['approval_status'] == 'Approver_2'){ ?>						
                                 <?php if(!empty($approver_2) && in_array($this->userdata['userid'],$approver_2)){ ?>		
              					 <button type="submit" class="positive" onclick="approvalView(<?php echo $lead['lead_id']; ?>); return false;">Waiting for Approver 2</button>					
                                 <?php  }else{
              						echo 'Waiting for Approver 2'; 
              					 } ?>
                       <?php }else if($lead['approval_status'] == 'Rejected'){ ?>		
              					 Reffered back by <?php echo !empty($lead['approver1_comments'])?'approver1:'.$lead['approver1_comments']:'';echo !empty($lead['approver2_comments'])?'approver2:'.$lead['approver2_comments']:''; ?>
                       <?php }else if($lead['approval_status'] == 'SAP'){ 
              					 //if(!empty($approver_2) && in_array($this->userdata['userid'],$approver_2)){ ?>		
              					 Pushed to SAP
              					 <?php //} 
              					 } ?>
              					 </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <?php } else {
			echo "You have no rights to access this page";
		} ?>
	</div>
</div>
<script type="text/javascript" src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<?php require (theme_url().'/tpl/footer.php'); ?>
<div class="comments-log-container1"></div>
<script type="text/javascript">
function approvalView(lead_id){
		window.location.href = site_base_url + 'project_approval/view_project_approval/' + lead_id;
}
$(document).ready(function(){
  
  $('.project_dt').dataTable({
    "iDisplayLength": 10,
    "sPaginationType": "full_numbers",
    "bInfo": true,
    "bPaginate": true,
    "bProcessing": true,
    "bServerSide": false,
    "bLengthChange": true,
    "bSort": true,
    "bFilter": true,
    "bAutoWidth": false,
    "bDestroy": true,
    "aaSorting": []
  });
    setTimeout(function(){ 
        $(".alert-dismissible").hide(); 
        }, 
    5000);

});
</script>
