<?php
$this->load->helper('text');
$this->load->helper('lead');
$this->load->helper('custom');
$this->load->helper('sap');
$cfg = $this->config->item('crm');

/*for notification - bell*/
$show_notify 		 = false;
$proposal_notify_msg = array();
$task_notify_msg	 = array();

if ($this->session->userdata('logged_in') == TRUE) {
	$vid=$this->session->userdata['logged_in_user']['role_id'];
	$viewLeads 		= getAccess(51, $vid);
	$viewEnquiries 	= getAccess(130, $vid);
	$viewTasks 		= getAccess(108, $vid);
	$viewPjts  		= getAccess(110, $vid);

	// for floating div -- changed to bell icon
	$proposal_notify_status = get_notify_status(1);
	if($proposal_notify_status) {
		$proposal_notify_msg = proposal_expect_end_msg($proposal_notify_status);
	}
	$task_notify_status = get_notify_status(2);
	if($task_notify_status) {
		$task_notify_msg = task_end_msg($task_notify_status);
	}
	// for floating div -- changed to bell icon
}
if ($this->session->userdata('logged_in') == TRUE) {
 	$userdata 		= $this->session->userdata('logged_in_user');

	//$menu_itemsmod 	= $this->session->userdata('menu_item_list');
 	## getting users menu item list from DB
 	$userId = $userdata['userid']; 
 	$menu_itemsmod = users_menulist('fetch',$userId);
	$menulist 		=  formMenuList($menu_itemsmod,true,NULL);
	$sensitive_information_allowed = TRUE;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo $this->config->item('base_url'); ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	<?php
		if (isset($quote_data['lead_title']) && is_string($quote_data['lead_title'])) echo htmlentities($quote_data['lead_title'], ENT_QUOTES), ' - ';
		if (isset($page_heading) && is_string($page_heading)) echo $page_heading, ' - ';
		echo $cfg['app_full_name'];
	?>
</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/base.css?v=<?php echo CLR_CACHE; ?>" type="text/css" />
<link rel="stylesheet" href="assets/css/datatable.css" type="text/css" />
<link rel="stylesheet" href="assets/css/demo_table.css" type="text/css" />
<link rel="stylesheet" href="assets/css/quote.css?q=21" type="text/css" />
<link rel="stylesheet" href="assets/css/smoothness/ui.all.css?q=2" type="text/css" />
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.jqplot.min.css" />
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="assets/js/excanvas.min.js"></script><![endif]-->
	<!--[if IE]>
    	<script src="assets/js/html5shiv.js"></script>
	<![endif]-->
<script type="text/javascript" src="assets/js/jquery-1.9.1-min.js"></script>
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui-1.10.3.js"></script>
<script type="text/javascript" src="assets/js/tableHeadFixer.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<?php if ($this->session->userdata('logged_in') == TRUE) { ?>
<?php echo js_global_variable($viewLeads['view'], $viewPjts['view']); ?>
<?php } ?>
</head>
<body>

<div id="page">
<div class="header">
	<div id="logo" class="logo-header">
		<div class="brand-logo">
			<a href="dashboard"><img src="assets/img/esmart_logo.jpg" alt=""/></a>
		</div>
		<div class="client-logo">
			<?php 
			if (getClientLogo()) {
			$cilentLogo = getClientLogo();
			?>
			<a href="http://<?php echo $cilentLogo['client_url']; ?>" target="_blank"><img src="crm_data/client_logo/<?php echo $cilentLogo['filename']; ?>" alt="client-logo" /></a>
			<?php	
			} else {
			?>
			<a href="dashboard"></a>
			<?php } ?>
		</div>
	</div>
	
	<!--notification bell - start -->
	<?php
	
		$notify 	= $this->session->flashdata('notify_msg');
		$messages 	= $this->session->flashdata('header_messages'); 
	
		/* $content = '';

		if (!empty($proposal_notify_msg)) {
			$notify[] = "<span class=notify_high>Leads</span>";
			$content .= '<li><span class="fontbld">Leads ('.count($proposal_notify_msg).')</li>';
			foreach ($proposal_notify_msg as $arr) {
				$content .= '<li><a href="'.base_url().'welcome/view_quote/'.$arr['lead_id'].'">'.character_limiter($arr['lead_title'], 50).'</a> <span> '.date('d-m-Y', strtotime($arr['dt'])).' </span></li>';
			}
		}
		$taskcontent = '';
		
		if (!empty($task_notify_msg)) {
			$notify[] = "<span class=notify_high>Task</span>";
			$taskcontent .= '<li><span class="fontbld">Tasks ('.count($task_notify_msg).')</li>';
			foreach ($task_notify_msg as $arr) {
				$task_desc = character_limiter($arr['task'], 50);
				$taskcontent .= '<li><a href="'.base_url().'tasks/all/?id='.$arr['taskid'].'&type=random">'.$task_desc.'</a> <span> '.date('d-m-Y', strtotime($arr['end_date'])).' </span></li>';
			}
		} */
	?>
	<?php 
	#if (is_array($notify) && count($notify) > 0 && ($this->session->userdata('logged_in') == TRUE)) {
	?>
		<!--div id="floatNotifyDiv">	
			<div class="grid-close grid-close1" id="grid-close"></div>
			<table border="0" class="follow-style" cellpadding="5" cellspacing="0">
				<tr><td colspan='3' class="follow-title">Follow Up Reminder(s)</td></tr>
					<?php #echo $content; ?>
					<?php #echo $taskcontent; ?>
			</table>
		</div-->
	<?php 
	#}
	?>
	<!--notification bell - end -->

	<div class="row-two">
		<div id="user-status">
			<?php if ($this->session->userdata('logged_in') == TRUE) { ?>
				<div class="dropdown">
					<a class="account" >
						<p id="user">
							<?php echo ucfirst($userdata['first_name']) . ' ' . ucfirst($userdata['last_name']) ?> | 
							<?php echo isset($userdata['name']) ? $userdata['name']: ''; ?>
						</p>
					</a>
					<div class="submenu" style="display: none; ">
						<img class="dpwn-arw" src="assets/img/drop-down-arrow.png" title="" alt="" />
						<ul class="root">
							<li><a class="my-profile" href="<?php echo base_url() ?>myaccount/">My Profile</a></li>
							<li><a class="email-template" href="<?php echo base_url() ?>email_preference/">Email Preference</a></li>
							<li><a class="notifications" href="<?php echo base_url() ?>notifications/">Manage Notifications</a></li>
							<li><a class="email-template" href="<?php echo base_url() ?>user_email_template/">Email Templates</a></li>
							<li><a class="manage-signature" href="<?php echo base_url() ?>signatures/">Manage Signatures</a></li>
							<li><a class="sign-out" href="<?php echo base_url() ?>userlogin/logout">Sign Out</a></li>
						</ul>
					</div>
				</div>
			<?php } ?>
			<?php
			$proposal_notify_count = $task_notify_count = 0;
			if (is_array($proposal_notify_msg) && !empty($proposal_notify_msg) && count($proposal_notify_msg)>0) {
				$show_notify 			= true;
				$proposal_notify_count 	= count($proposal_notify_msg);
			}
			if (is_array($task_notify_msg) && !empty($task_notify_msg) && count($task_notify_msg)>0) {
				$show_notify 		= true;
				$task_notify_count 	= count($task_notify_msg);
			}
			
			
			$access_a1 = access_action(array('approver_1'));
			$access_a2  = access_action(array('approver_2'));
			$approver_a1  = json_decode($access_a1[0]->members); 	
			$approver_a2  = json_decode($access_a2[0]->members);
			$customer_approval_count=0;
			if(!empty($approver_a1) && in_array($this->userdata['userid'],$approver_a1)){
				$customer_approval_count = customer_master_approval_count('Approver_1');
				if($customer_approval_count!=0){
					$show_notify = true;
				}
			}
			if(!empty($approver_a2) && in_array($this->userdata['userid'],$approver_a2)){
				$customer_approval_count = customer_master_approval_count('Approver_2');
				if($customer_approval_count!=0){
					$show_notify = true;
				}
			}
			
			$provisional_approval_count=0;
			if(!empty($approver_a1) && in_array($this->userdata['userid'],$approver_a1)){
				$provisional_approval_count = invoice_approval_count('Provisional','Approver_1');
				if($provisional_approval_count!=0){
					$show_notify = true;
				}
			}
			if(!empty($approver_a2) && in_array($this->userdata['userid'],$approver_a2)){
				$provisional_approval_count = invoice_approval_count('Provisional','Approver_2');
				if($provisional_approval_count!=0){
					$show_notify = true;
				}
			}
			
			$actual_approval_count=0;
			if(!empty($approver_a1) && in_array($this->userdata['userid'],$approver_a1)){
				$actual_approval_count = invoice_approval_count('Actual','Approver_1');
				if($actual_approval_count!=0){
					$show_notify = true;
				}
			}
			if(!empty($approver_a2) && in_array($this->userdata['userid'],$approver_a2)){
				$actual_approval_count = invoice_approval_count('Actual','Approver_2');
				if($actual_approval_count!=0){
					$show_notify = true;
				}
			}
			$credit_note_approval_count=0;
			if(!empty($approver_a1) && in_array($this->userdata['userid'],$approver_a1)){
				$credit_note_approval_count = invoice_approval_count('Credit Note','Approver_1');
				if($credit_note_approval_count!=0){
					$show_notify = true;
				}
			}
			if(!empty($approver_a2) && in_array($this->userdata['userid'],$approver_a2)){
				$credit_note_approval_count = invoice_approval_count('Credit Note','Approver_2');
				if($credit_note_approval_count!=0){
					$show_notify = true;
				}
			}
			$project_approval_count=0;
			if(!empty($approver_a1) && in_array($this->userdata['userid'],$approver_a1)){
				$project_approval_count = projects_approval_count('Approver_1');
				if($project_approval_count!=0){
					$show_notify = true;
				}
			}
			if(!empty($approver_a2) && in_array($this->userdata['userid'],$approver_a2)){
				$project_approval_count = projects_approval_count('Approver_2');
				if($project_approval_count!=0){
					$show_notify = true;
				}
			}
			//echo $approval_count;
			?>
			<?php 
			if( $show_notify == true )
			{
				$notify_count = $proposal_notify_count + $task_notify_count + $customer_approval_count + $provisional_approval_count + $actual_approval_count + $credit_note_approval_count + $project_approval_count;
			?>
				<div class="notify-area">
					<a id="pending_task_notify">
						<img class="" src="assets/img/bell-icon.png" title="Notify" alt="bell" />
						<div class="notify-count"><span><?php echo $notify_count; ?></span></div>
					</a>
					<div id="pending_task_list" style="display: none; ">
						<img class="dpwn-arw" src="assets/img/drop-down-arrow.png" title="" alt="" />
						<ul class="root">
							<li class='pending-task'>Pending Tasks</li>
							<?php if($proposal_notify_count != 0) { ?><li><a class="my-profile" href="javascript:void(0)" onclick="getProposalExpectEndLead(); return false;">Leads(<?php echo $proposal_notify_count; ?>)</a></li><?php } ?>
							<?php if($task_notify_count != 0) { ?><li><a class="my-profile" href="javascript:void(0)" onclick="getEndTasks(); return false;">Tasks (<?php echo $task_notify_count; ?>)</a></li><?php } ?>
							<?PHP if($customer_approval_count!=0){ ?>
							<li class='pending-task'>Customer master approvals(<?PHP echo $customer_approval_count; ?>)</li>
							<?PHP } ?>
							<?PHP if($provisional_approval_count!=0){ ?>
							<li class='pending-task'>Provisional invoice approvals(<?PHP echo $provisional_approval_count; ?>)</li>
							<?PHP } ?>
							<?PHP if($actual_approval_count!=0){ ?>
							<li class='pending-task'>Actual invoice approvals(<?PHP echo $actual_approval_count; ?>)</li>
							<?PHP } ?>
							<?PHP if($credit_note_approval_count!=0){ ?>
							<li class='pending-task'>Credit Note approvals(<?PHP echo $credit_note_approval_count; ?>)</li>
							<?PHP } ?>
							<?PHP if($project_approval_count!=0){ ?>
							<li class='pending-task' style="cursor:pointer" onclick='location.href = "project_approval";'>Project approvals(<?PHP echo $project_approval_count; ?>)</li>
							<?PHP } ?>
						</ul>
					</div>
				</div>
			<?php
			}
			?>
			<p class="date-time"><?php echo date('l jS F Y') ?> <!--span class="msg-highlight"></span--></p>

		</div>
	</div>
</div>
		
<?php
if (!isset($_COOKIE['floatStat'])) {
	 if (is_array($messages) && count($messages) > 0 ) { ?>
		<div id="messages">
			<p><?php for ($i = 0; $i < count ($messages);  $i ++) { echo $messages[$i]; if (isset($messages[$i + 1])) echo '<br />'; } ?></p>
		</div>
<?php }
}
	
$confirm = $this->session->flashdata('confirm');
if (is_array($confirm) && count($confirm) > 0 ) { ?>
	<div id="confirm">
		<p>
			<?php for ($i = 0; $i < count ($confirm);  $i ++) { echo $confirm[$i]; if (isset($confirm[$i + 1])) echo '<br />'; } ?>
		</p>
	</div>
<?php }

$errors = $this->session->flashdata('login_errors');
if (is_array($errors) && count($errors) > 0 ) { ?>
	<div id="errors">
		<p>
			<?php for ($i = 0; $i < count ($errors);  $i ++) { echo $errors[$i]; if (isset($errors[$i + 1])) echo '<br />'; } ?>
		</p>
	</div>
<?php } ?>

<?php
	if ($this->session->userdata('logged_in') == TRUE)
	{
		echo $menulist; 
	} 
?>
   
<?php 
if ($this->session->userdata('logged_in') == TRUE) {

	$menulist_access = explode('#',$menu_itemsmod);
	$menulist_access=array_reverse($menulist_access);

	for($j=0;$j<count($menulist_access);$j++)
	{
		$menu_items_vals[] = explode(',',$menulist_access[$j]);
	}		 

	$qurystring =explode('/',$_SERVER['REQUEST_URI']);
	$Qstring='';
	for($e=2;$e<count($qurystring);$e++) 
	{
		if($Qstring==''){
			$Qstring =$qurystring[$e];
		}else{
			$Qstring .='/'.$qurystring[$e];
		}
	}
	//echo $Qstring;
	$access_limit = array();
	$parent_id='';
	
	$viewLead = $addLead = $editLead = $deleteLead = '';
	$viewEnquiry = $addEnquiry = $editEnquiry = $deleteEnquiry = '';
	$viewTask = $addTask = $editTask = $deleteTask = '';
	$viewPjt = $addPjt = $editPjt = $deletePjt = '';
	$addImpCus = '';
	$i=0;
	$access_limit= array();
	
	//$position4 = array_column($menu_items_vals, 4);
	
	$urlSegment1 = $this->uri->segment(1);
	$urlSegment2 = ($this->uri->segment(2) != '') ? '/'.$this->uri->segment(2) : '';
	$urlSegment3 = ($this->uri->segment(3) != '') ? '/'.$this->uri->segment(3) : '';
	$urlSegment = $urlSegment1.$urlSegment2.$urlSegment3;

	$menu_items = get_menuDetails($menu_items_vals);
	
	## Task , Project & Lead menus details for Dashboard
	$taskMasterId = 108;
	$projectMasterId = 110;
	$leadMasterId = 51;
	$viewDashboardProject = $viewDashboardLead = $viewDashboardTask = '';
	$leadMenus = $taskMenus = $projectMenus = [];
	foreach ($menu_items_vals as $key => $value) {
		if($taskMasterId == $value[0]){
			$taskMenus = $value;
			$viewDashboardTask   = $taskMenus[8];
		}
		
		if($projectMasterId == $value[0]){
			$projectMenus = $value;
			$viewDashboardProject   = $projectMenus[8];
		}
		
		if($leadMasterId == $value[0]){
			$leadMenus = $value;
			$viewDashboardLead   = $leadMenus[8];
		}
	}

	$parent_id = $menu_items['1'];
	$master_id = $menu_items['0'];
	$access_limit['view'] 	= $menu_items[8];
	$access_limit['add'] 	= $menu_items[9];
	$access_limit['edit'] 	= $menu_items[10];
	$access_limit['delete'] = $menu_items[11];
	$access_limit['links'] 	= $menu_items[4];
	$access_limit['name'] 	= $menu_items[2];
//$viewLead = 1;
	if($master_id == 51)  //leads
	{ 
	   $viewLead   = $menu_items[8];
	   $addLead    = $menu_items[9];
	   $editLead   = $menu_items[10];
	   $deleteLead = $menu_items[11];
	}
	if($master_id == 130)  //Enquiries
	{ 
	   $viewEnquiry   = $menu_items[8];
	   $addEnquiry    = $menu_items[9];
	   $editEnquiry   = $menu_items[10];
	   $deleteEnquiry = $menu_items[11];
	}
	if($master_id == 108) //Tasks
	{ 
	   $viewTask   = $menu_items[8];
	   $addTask    = $menu_items[9];
	   $editTask   = $menu_items[10];
	   $deleteTask = $menu_items[11];
	}
	if($master_id == 110) //Projects
	{ 
	   $viewPjt   = $menu_items[8];
	   $addPjt    = $menu_items[9];
	   $editPjt   = $menu_items[10];
	   $deletePjt = $menu_items[11];
	}
	if($master_id == 84) //customer
	{ 
	   $addImpCus = $menu_items[9];
	}

	if($master_id == 172) //Risk Management
	{ 
	   $viewRM   = $menu_items[8];
	   $addRM    = $menu_items[9];
	   $editRM   = $menu_items[10];
	   $deleteRM = $menu_items[11];
	}
	

	/*foreach($menu_items_vals as $menu_items) {		 
		$strcmp = strcmp(strtolower($this->uri->segment(1)), strtolower($menu_items[3]));	
		if(($strcmp==0 && $i==0 )) 
		{ 
			$i+=1;
			$parent_id = $menu_items['1'];
			$master_id = $menu_items['0'];
			$access_limit['view'] 	= $menu_items[8];
			$access_limit['add'] 	= $menu_items[9];
			$access_limit['edit'] 	= $menu_items[10];
			$access_limit['delete'] = $menu_items[11];
			$access_limit['links'] 	= $menu_items[4];
			$access_limit['name'] 	= $menu_items[2];
		}
		if($menu_items['0'] == 51)  //leads
		{ 
		   $viewLead   = $menu_items[8];
		   $addLead    = $menu_items[9];
		   $editLead   = $menu_items[10];
		   $deleteLead = $menu_items[11];
		}
		if($menu_items['0'] == 130)  //Enquiries
		{ 
		   $viewEnquiry   = $menu_items[8];
		   $addEnquiry    = $menu_items[9];
		   $editEnquiry   = $menu_items[10];
		   $deleteEnquiry = $menu_items[11];
		}
		if($menu_items['0'] == 108) //Tasks
		{ 
		   $viewTask   = $menu_items[8];
		   $addTask    = $menu_items[9];
		   $editTask   = $menu_items[10];
		   $deleteTask = $menu_items[11];
		}
		if($menu_items['0'] == 110) //Projects
		{ 
		   $viewPjt   = $menu_items[8];
		   $addPjt    = $menu_items[9];
		   $editPjt   = $menu_items[10];
		   $deletePjt = $menu_items[11];
		}
		if($menu_items['0'] == 84) //customer
		{ 
		   $addImpCus = $menu_items[9];
		}
	}  	 */

	// echo $this->uri->segment(1);
	$master_parent_id = $master_id;
	$roleId = $userdata['role_id'];
	if(!empty($master_id) && isset($roleId)) {
		//$masters = formMasterDetail($this->uri->segment(1), $userdata['role_id']);
		$masters = formMasterDetail_byId($master_id, $userdata['role_id']);
		//echo $master_id.'role-'.$userdata['role_id'].'<pre>';print_r($masters);exit;
		$access_limit 			= array();
		//check as array
		if (!empty($masters[0])) {
			$master_parent_id = ($masters[0]['master_parent_id'] == 0) ? $master_id : $masters[0]['master_parent_id'];
			$access_limit['view'] 	= $masters[0]['view'];
			$access_limit['add'] 	= $masters[0]['add'];
			$access_limit['edit'] 	= $masters[0]['edit'];
			$access_limit['delete'] = $masters[0]['delete'];
		}
	}
	//echo $menulistss 		= formSubMenuList($master_id, $access_limit);
	// if ($urlSegment != 'dashboard') {
	// 	echo $menulistss 		= formSubMenuList($master_parent_id, $access_limit,$roleId);	
	// }	
	
	$array= array();
	$array['accesspage']	= $access_limit['view'];
	$array['add']			= $access_limit['add']; 
	$array['edit']			= $access_limit['edit']; 
	$array['delete']		= $access_limit['delete'];
	## View lead will be set as 1 for dahsboard page
	//$array['viewlead'] 		= ($urlSegment == 'dashboard') ? 1 : $viewLead;
	$array['viewlead'] 		= $viewLead;
	$array['addlead'] 		= $addLead;
	$array['editlead'] 		= $editLead;
	$array['viewenquiry'] 	= $viewEnquiry;
	$array['addenquiry'] 	= $addEnquiry;
	$array['editenquiry'] 	= $editEnquiry;
	$array['deleteenquiry'] = $deleteEnquiry;
	$array['deletelead'] 	= $deleteLead;
	$array['viewtask'] 		= $viewTask;
	$array['addtask'] 		= $addTask;
	$array['edittask'] 		= $editTask;
	$array['deletetask'] 	= $deleteTask;
	$array['viewPjt'] 		= $viewPjt;
	$array['addPjt'] 		= $addPjt;
	$array['editPjt'] 		= $editPjt;
	$array['deletePjt'] 	= $deletePjt;
	$array['addImpCus'] 	= $addImpCus;
	//echo '--<pre>';print_r($array);//exit;
	$array['viewRM'] 		= $viewRM;
	$array['addRM'] 		= $addRM;
	$array['editRM'] 		= $editRM;
	$array['deleteRM']    	= $deleteRM;
	
	##Setting view access to dahsboard page        
	$array['viewDashboardProject'] = $viewDashboardProject;
	$array['viewDashboardLead'] = $viewDashboardLead;
	$array['viewDashboardTask'] = $viewDashboardTask;
		
	$this->session->set_userdata($array);
	
}	
?>

<script>
var fid = "<?php echo isset($userdata['userid']) ? $userdata['userid'] : '' ?>";
var user_bu = "<?php echo isset($userdata['business_unit_id']) ? $userdata['business_unit_id'] : '' ?>";
var user_role = "<?php echo isset($userdata['role_id']) ? $userdata['role_id'] : '' ?>";

if(user_role != "1" && user_role != "2"){
	if(user_bu != '1'){
		$("#top_menu_203").remove();
	}
}

$(function() {
	$('#grid-close').click(function() {
		setCookie("floatStat", fid, 1);
	});
});
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString()+";path=/");
	document.cookie=c_name + "=" + c_value;
}
function getProposalExpectEndLead()
{
	var url = site_base_url+"welcome/quotation/";
	var form = $('<form action="' + url + '" method="post">' +
				  '<input id="token" type="hidden" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
				  '<input type="hidden" name="type" value="load_proposal_expect_end" />' +
				  '</form>');
	$('body').append(form);
	$(form).submit(); 
}

function getEndTasks()
{
/* 	var url = site_base_url+"tasks/all";
	var form = $('<form action="' + url + '" method="post">' +
				  '<input id="token" type="hidden" name="'+csrf_token_name+'" value="'+csrf_hash_token+'" />'+
				  '<input type="hidden" name="type" value="task_end_notify" />' +
				  '</form>');
	$('body').append(form);
	$(form).submit();  */
	var params    		     = {'task_end_notify':'1'};	
	params[csrf_token_name]  = csrf_hash_token;
    $(".all-tasks").load("tasks/search",params, function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
	{
		
	}
   else if(statusTxt == "error")
   {
	 alert("Error: " + xhr.status + ": " + xhr.statusText);
   }    

    }); 	
	
	
}
</script>


<script type="text/javascript" >
$(document).ready(function(){
	$(".account").click(function(){
		var X=$(this).attr('id');

		if(X==1) {
			$(".submenu").hide();
			$(this).attr('id', '0');
		} else {
			$(".submenu").show();
			$(this).attr('id', '1');
		}
	});

	//Mouseup textarea false
	$(".submenu").mouseup(function() {
		return false
	});
	$(".account").mouseup(function() {
		return false
	});

	//Textarea without editing.
	$(document).mouseup(function() {
		$(".submenu").hide();
		$(".account").attr('id', '');
	});
	
	
	$("#pending_task_notify").click(function() {
		var XX=$(this).attr('id');
		if(XX==1) {
			$("#pending_task_list").hide();
			$(this).attr('id', '0');
		} else {
			$("#pending_task_list").show();
			$(this).attr('id', '1');
		}
	});
	//Mouseup textarea false
	$("#pending_task_list").mouseup(function() {
		return false
	});
	$("#pending_task_notify").mouseup(function() {
		return false
	});
	//Textarea without editing.
	$(document).mouseup(function() {
		$("#pending_task_list").hide();
		$("#pending_task_notify").attr('id', '');
	});
	
});
</script>
