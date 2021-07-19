<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_report extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        public function __construct() {
            parent::__construct();
            $this->load->model('employee_report_model');
        }


        public function index()
        {       
            if( $this->require_role('admin') )
            {
                $this->load->view('welcome_message');
            }
	}
        
        /*
	* Utilization Metrics V2
	*/
	function utilization_metrics()
	{
            $new_view = 0;
		//if(in_array($this->userdata['role_id'], array('8', '9', '11', '13', '14'))) {
			//redirect('project');
		//}
		$data  				  = array();
		$dept   			  = array();
		$data['page_heading'] = "Utiliztion Metrics Dashboard";
		
		$timesheet_db = $this->load->database("timesheet", true);
				
		$start_date = date("Y-m-1");
		$end_date   = date("Y-m-d");
		// $start_date = date("Y-m-d", strtotime('01-04-2017'));
		// $end_date   = date("Y-m-d", strtotime('30-04-2017'));
		
		if($this->input->post("month_year_from_date")) {
			$start_date = $this->input->post("month_year_from_date");
			$start_date = date("Y-m-01",strtotime($start_date));
			if($this->input->post("month_year_to_date")== "") {
				$end_date   = date("Y-m-t",strtotime($start_date));
			}
		}
		if($this->input->post("month_year_to_date")) {
			$end_date = $this->input->post("month_year_to_date");
			$end_date = date("Y-m-t",strtotime($end_date));	
		}
		$data['exclude_leave'] = $data['exclude_holiday'] = 0;
		// echo $start_date.' '.$end_date; exit;
		if(($this->input->post("exclude_leave")==1) && $this->input->post("exclude_holiday")!=1) {
			$data['exclude_leave'] = 1;
		}
		if(($this->input->post("exclude_holiday")==1) && $this->input->post("exclude_leave")!=1) {
			$data['exclude_holiday'] = 1;
		}
		if(($this->input->post("exclude_leave")==1) && $this->input->post("exclude_holiday")==1) {
			$data['exclude_leave']   = 1;
			$data['exclude_holiday'] = 1;
		}
		$data['geography_ids'] = $data['entity_ids'] = $data['department_ids'] = [];
		$entity_ids = $this->input->post("entity_ids");
		if(!empty($entity_ids) && count($entity_ids)>0) {
			$data['entity_ids'] = $entity_ids;
		}else{
                    
                }
		
		$business_unit_ids = $this->input->post("business_unit_id");
		if(!$business_unit_ids){
			$business_unit_ids = [1];
		}
		$data['business_unit_ids'] = $business_unit_ids;
		
		$this->load->model('user_model');
		$data['departments'] = $this->employee_report_model->getDepartmentByBU($business_unit_ids);
		
		$department_ids = $this->input->post("department_ids");
		if(count($department_ids)>0 && !empty($department_ids)) {
			$data['department_ids'] = $department_ids;
			$data['practice_ids_selected'] = $this->user_model->getPracticeByBUandDept($business_unit_ids,$department_ids);
		} 
		$practice_ids = $this->input->post("practice_ids");
		
		$data['geographies'] = $this->get_geographies();
        
		$geography_ids =$this->input->post('geography_ids');
	
//		$data['geography_ids'] = $geography_ids;
		
		//for practices
		/* $this->db->select('t.practice_id, t.practice_name');
		$this->db->from($this->cfg['dbpref']. 'timesheet_month_data as t');
		$this->db->where("t.practice_id !=", 0);
		$this->db->where("(t.start_time >='".date('Y-m-d', strtotime($start_date))."' )", NULL, FALSE);
		$this->db->where("(t.start_time <='".date('Y-m-d', strtotime($end_date))."' )", NULL, FALSE);
		if(count($department_ids)>0 && !empty($department_ids)) {
			$dids = implode(",",$department_ids);
			if(!empty($dids)) {
				$this->db->where_in("t.dept_id", $department_ids);
			}
		}
		if(count($practice_ids)>0 && !empty($practice_ids)) {
			$pids = implode(",",$practice_ids);
			$data['practice_ids'] = $practice_ids;
			$where .= " and l.practice in ($pids)";
		}
		
		$this->db->group_by('t.practice_id');
		$this->db->order_by('t.practice_name');
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data['practice_ids_selected'] = $query->result();
		} */
		
		
		if(count($practice_ids)>0 && !empty($practice_ids)) {
			$data['practice_ids'] = $practice_ids;
			$data['skill_ids_selected'] = $this->user_model->getSkillByBUandDeptandPrac($business_unit_ids,$department_ids,$practice_ids);
		}
		
			
		$sids = '';
		$skill_ids = $this->input->post("skill_ids");
		if(count($skill_ids)>0 && !empty($skill_ids)) {
			$data['skill_ids'] = $skill_ids;
		}

		$member_ids = $this->input->post("member_ids");
		if($this->input->post("skill_ids")){
  		if(count($member_ids)>0 && !empty($member_ids)) {
			$mids = "'".implode("','",$member_ids)."'";
			if(count($member_ids)>0 && !empty($member_ids)) {
				$data['member_ids'] = $member_ids;
			}
		}
			$ids = $this->input->post("department_ids");
			$dids = implode(',',$ids);
			$p_ids = $practice_ids;
			$pids = implode(',',$p_ids);
			$sids = implode(',',$skill_ids);
			/* $qry1 = $timesheet_db->query("SELECT v.username,concat(v.first_name,' ',v.last_name) as emp_name FROM `v_emp_details` v join enoah_times t on v.username=t.uid where t.start_time between '$start_date' and '$end_date' group by v.username order by v.username asc"); */
			
			$this->db->select("t.empname as emp_name, t.username, users.emp_id");
			$this->db->from($this->cfg['dbpref']. 'timesheet_month_data as t');
			$this->db->join($this->cfg['dbpref'].'users as users', 'users.username = t.username');
			$this->db->where("t.practice_id !=", 0);
			$this->db->where("(t.start_time >='".date('Y-m-d', strtotime($start_date))."' )", NULL, FALSE);
			$this->db->where("(t.start_time <='".date('Y-m-d', strtotime($end_date))."' )", NULL, FALSE);
			if(!empty($ids)) {
				$this->db->where_in("t.dept_id", $ids);
			}				
			if(!empty($p_ids)){
				$this->db->where_in("t.practice_id", $p_ids);
			}
			if(!empty($sids) && count($sids)>0) {
				$sid_arr = array();
				$sid_arr = @explode(",", $sids);
				if(!empty($sid_arr) && count($sid_arr)>0) {
					$this->db->where_in('t.skill_id', $sid_arr);
				}
			}
			$this->db->group_by('t.empname');
			$this->db->order_by('t.empname');
			$qry = $this->db->get();
			$data['member_ids_selected'] = $qry->result();
		}

		$this->db->select('t.dept_id, t.dept_name, t.skill_id, t.skill_name, t.resoursetype, t.username, t.duration_hours, t.resource_duration_cost, t.cost_per_hour, t.project_code, t.empname, t.direct_cost_per_hour, t.resource_duration_direct_cost,t.entry_month as month_name, t.entry_year as yr, t.entity_id, t.entity_name, t.practice_id, t.practice_name,t.lead_business_unit_id as business_unit_id,t.lead_business_unit_name as business_unit_name');
		$this->db->from($this->cfg['dbpref']. 'timesheet_month_data as t');
		//$this->db->join($this->cfg['dbpref']. 'leads as l', 'l.pjt_id = t.project_code', 'LEFT');
		// $this->db->join($this->cfg['dbpref']. 'practices as p', 'p.id = l.practice');
		$this->db->where("t.resoursetype !=", '');
		// $this->db->where("t.project_code", 'ITS-IIT- 01-0414'); //for testing load some data only
		if(!empty($start_date) && !empty($end_date)) {
			$this->db->where("(t.start_time >='".date('Y-m-d', strtotime($start_date))."' )", NULL, FALSE);
			$this->db->where("(t.start_time <='".date('Y-m-d', strtotime($end_date))."' )", NULL, FALSE);
		}
		if(($this->input->post("exclude_leave")==1) && $this->input->post("exclude_holiday")!=1) {
			$this->db->where_not_in("t.project_code", array('Leave'));
			$data['exclude_leave'] = 1;
		}
		if(($this->input->post("exclude_holiday")==1) && $this->input->post("exclude_leave")!=1) {
			$this->db->where_not_in("t.project_code", array('HOL'));
			$data['exclude_holiday'] = 1;
		}
		if(($this->input->post("exclude_leave")==1) && $this->input->post("exclude_holiday")==1) {
			$this->db->where_not_in("t.project_code", array('HOL','Leave'));
			$data['exclude_leave']   = 1;
			$data['exclude_holiday'] = 1;
		}
		if(!empty($entity_ids) && count($entity_ids)>0) {
			$data['entity_ids'] = $entity_ids;
			$this->db->where_in('t.entity_id', $entity_ids);
		}
		if(!empty($business_unit_ids) && count($business_unit_ids)>0) {
			$data['business_unit_ids'] = $business_unit_ids;
			$this->db->where_in('t.business_unit', $business_unit_ids);
		}
		if(!empty($practice_ids) && count($practice_ids)>0) {
			$data['practice_ids'] = $practice_ids;
			$this->db->where_in('t.practice_id', $practice_ids);
		}
		if(count($department_ids)>0 && !empty($department_ids)) {
			$dids = implode(",",$department_ids);
			if(!empty($dids)) {
				$this->db->where_in("t.dept_id", $department_ids);
			}
		} 
		if(count($skill_ids)>0 && !empty($skill_ids)) {
			$this->db->where_in('t.skill_id', $skill_ids);
		}
		if(count($geography_ids)>0 && !empty($geography_ids)) {
			$this->db->where_in('t.geography_id', $geography_ids);
		}
		if(count($member_ids)>0 && !empty($member_ids)) {
			$this->db->where_in('t.username', $member_ids);
		}
		$this->db->where('t.practice_id is not null');
		$query 			 = $this->db->get();		
		$data['resdata'] = $query->result();
		
		 // echo $this->db->last_query(); die;
		
		//echo "<pre>"; print_r($data['resdata']); die;

		$arr_depts          = array();
		$check_array 	    = array();
		$check_user_array   = array();
		$arr_depts1		    = array();
		$arr_user_avail_set = array();
		$data['conversion_rates'] = $this->get_currency_rates();
		/* echo "<pre>"; print_r($data['resdata']); echo "</pre>"; */
		
		$timesheet_db->close();
		
		$this->db->select('div_id, division_name');
		$this->db->where("status", 1);
		$entity_query 		= $this->db->get($this->cfg['dbpref'].'sales_divisions');
		$data['entitys'] 	= $entity_query->result();

		$data['start_date'] 	  = $start_date;
		$data['end_date']   	  = $end_date;
		$data['results']    	  = $arr_depts;
		$data['filter_area_status'] = $this->input->post("filter_area_status");
		
		$this->load->model('user_model');
		$data['business_unit'] = $this->user_model->getBusinessUnit();
		
		// echo "<pre>"; print_r($data); die;
		if($new_view == 1)
                    echo $this->load->view("projects/employee_headcount", $data, TRUE);
                else
                    echo $this->load->view("projects/project_dashboard_beta_v2", $data, TRUE);
	}
        
        public function get_geographies()
	{   		
		$this->db->select('p.georegion_name, p.georegionid');
		$this->db->from($this->cfg['dbpref'].'geo_region as p');
		$this->db->where('p.inactive', 0);
		$this->db->order_by('p.georegion_name',"asc");
		$query = $this->db->get();
		return $query->result();
	}
        
        	/*
	*method : get_currency_rates
	*/
	public function get_currency_rates() {
            $this->load->model('report/report_lead_region_model');
            $currency_rates = $this->report_lead_region_model->get_currency_rate();
            $rates 			= array();
            if(!empty($currency_rates)) {
                    foreach ($currency_rates as $currency) {
                            $rates[$currency->from][$currency->to] = $currency->value;
                    }
            }
            return $rates;
	}
        
        function get_members()
	{
		if($this->input->post("business_unit_id")){
				
			$business_unit_id = $this->input->post("business_unit_id");
			$department_id_fk = $this->input->post("department_id_fk");
			$practices = $this->input->post("practices");
			$skill_id = $this->input->post("skill_id");
			
			$start_date = $this->input->post("start_date");
			$end_date   = $this->input->post("end_date");
			$start_date = date("Y-m-01",strtotime($start_date));
			$end_date   = date("Y-m-t",strtotime($end_date));
			
			$business_unit_id = implode(',',$business_unit_id);
			$department_id_fk = implode(',',$department_id_fk);
			$practices = implode(',',$practices);
			$skill_id = implode(',',$skill_id);
			
			if($business_unit_id){
				$business_unit_id = "v.business_unit in ($business_unit_id)";
			}
			if($department_id_fk){
				$department_id_fk = " and v.department_id in ($department_id_fk)";
			}
			if($practices){
				$practices = " and v.practice_id in ($practices)";
			}
			if($skill_id){
				$skill_id = " and v.skill_id in ($skill_id)";
			}
			$query = $business_unit_id.$department_id_fk.$practices.$skill_id;
			$timesheet_db = $this->load->database("timesheet",true);
			$qry = $timesheet_db->query("SELECT v.username,concat(v.first_name,' ',v.last_name) as emp_name FROM `v_emp_details` v 
			join enoah_times t on v.username=t.uid where $query and t.start_time between '$start_date' and '$end_date' group by v.username order by v.username asc");
			if($qry->num_rows()>0){
				$res = $qry->result();
				echo json_encode($res); exit;
			}else{
				echo 0;exit;
			}
		}		
	}
        
        /*
	@method - get_data()
	@for drill down data
	*/
	public function get_data()
	{
		// echo "<pre>"; print_r($this->input->post()); exit;
		$start_date = date("Y-m-1");
		$end_date   = date("Y-m-d");
		
		if($this->input->post("month_year_from_date")) {
			$start_date = $this->input->post("month_year_from_date");
			$start_date = date("Y-m-01",strtotime($start_date));
			if($this->input->post("month_year_to_date")== "") {
				$end_date   = date("Y-m-t",strtotime($start_date));
			}
		}
		if($this->input->post("month_year_to_date")) {
			$end_date = $this->input->post("month_year_to_date");
			$end_date = date("Y-m-t",strtotime($end_date));	
		}
		
		$resource_type  = $this->input->post("resource_type");
		$business_unit_ids = $this->input->post("business_unit_ids");
		$department_ids = $this->input->post("department_ids");
		$practice_ids   = $this->input->post("practice_ids");
		$dept_type      = $this->input->post("dept_type");
		$skill_ids 		= $this->input->post("skill_ids");
		$member_ids		= $this->input->post("member_ids");
		//metrics filter
		$entity_ids		= $this->input->post("entity_ids");
		$geography_ids		= $this->input->post("geography_ids");
		
		/* $qry = "SELECT t.dept_id, t.dept_name, t.practice_id, t.practice_name, t.skill_id, t.skill_name, t.resoursetype, t.username, t.duration_hours, t.resource_duration_cost, t.project_code, t.empname
		FROM crm_timesheet_data t
		WHERE start_time between '$start_date' and '$end_date' $where"; */
		if($this->input->post("filter_group_by") == 4){
			$this->db->select('t.dept_id,l.project_location,t.dept_name, t.practice_id, t.practice_name, t.skill_id, t.skill_name, t.resoursetype, t.username, t.duration_hours, t.resource_duration_cost, t.cost_per_hour, t.project_code, t.empname, t.direct_cost_per_hour, t.resource_duration_direct_cost,g.georegion_name');
		    $this->db->from($this->cfg['dbpref']. 'timesheet_data as t');
			$this->db->join($this->cfg['dbpref'].'leads as l', 'l.pjt_id = t.project_code','LEFT');
			$this->db->join($this->cfg['dbpref'].'geo_region as g', 'g.georegionid = l.project_geography');
		}else{
			$this->db->select('t.dept_id, t.dept_name, t.practice_id, t.practice_name, t.skill_id, t.skill_name, t.resoursetype, t.username, t.duration_hours, t.resource_duration_cost, t.cost_per_hour, t.project_code, t.empname, t.direct_cost_per_hour, t.resource_duration_direct_cost');
		    $this->db->from($this->cfg['dbpref']. 'timesheet_data as t');
				$this->db->join($this->cfg['dbpref'].'leads as l', 'l.pjt_id = t.project_code','LEFT');//metrics filter
		}	
	
		$this->db->where("(t.start_time >='".date('Y-m-d', strtotime($start_date))."' )", NULL, FALSE);
		$this->db->where("(t.start_time <='".date('Y-m-d', strtotime($end_date))."' )", NULL, FALSE);
		if(!empty($resource_type))
                    $this->db->where('t.resoursetype', $resource_type);
		if(!empty($business_unit_ids)){
			$buids = explode(',', $business_unit_ids);
			$this->db->where_in("t.business_unit", $buids);
		}
		// if(!empty($department_ids))
		// $this->db->where_in("t.dept_id", $department_ids);
		if(!empty($skill_ids)){
			$skillids = explode(',', $skill_ids);
			$this->db->where_in("t.skill_id", $skillids);
		}
		if(!empty($dept_type)) {
			$this->db->where("t.dept_name", $dept_type);
		}
		if(($this->input->post("exclude_leave")==1) && $this->input->post("exclude_holiday")!=1) {
			// $where .= " and project_code NOT IN ('Leave')";
			$this->db->where_not_in("t.project_code", 'Leave');
			$data['exclude_leave'] = 1;
		}
		if(($this->input->post("exclude_holiday")==1) && $this->input->post("exclude_leave")!=1) {
			// $where .= " and project_code NOT IN ('HOL')";
			$this->db->where_not_in("t.project_code", 'HOL');
			$data['exclude_holiday'] = 1;
		}
		if(($this->input->post("exclude_leave")==1) && $this->input->post("exclude_holiday")==1) {
			// $where .= " and project_code NOT IN ('HOL','Leave')";
			$this->db->where_not_in("t.project_code", array('HOL','Leave'));
			$data['exclude_leave']   = 1;
			$data['exclude_holiday'] = 1;
		}
		// if(!empty($practice_ids) && !empty($department_ids)) {
		if(!empty($practice_ids)) {
			$pids = explode(',', $practice_ids);
			$this->db->where_in("t.practice_id", $pids);
		}
		//metrics filter
		if(!empty($entity_ids)) {
			$eids = explode(',', $entity_ids);
			$this->db->where_in("l.division", $eids);
		}
		//metrics filter
		if(!empty($geography_ids)) {
			$geoids = explode(',', $geography_ids);
			$this->db->where_in("l.project_geography", $geoids);
		}
		if(!empty($member_ids)) {
			$mids = explode(',', $member_ids);
			$this->db->where_in("t.username", $mids);
		}
		$query = $this->db->get();
//		 echo $this->db->last_query(); exit;
		
		$data['resdata'] 	   = $query->result();
		//echo '<pre>'; print_r($data['resdata']);die;
		$data['heading'] 	   = $dept_type.' - '.$resource_type;
		$data['dept_type']     = $dept_type;
		$data['resource_type'] = $resource_type;
		
		// get all projects from timesheet
		$timesheet_db = $this->load->database("timesheet", true);
		$proj_mas_qry = $timesheet_db->query("SELECT DISTINCT(project_code), title FROM ".$timesheet_db->dbprefix('project')." ");
		if($proj_mas_qry->num_rows()>0){
			$project_res = $proj_mas_qry->result();
		}
		$project_master = array();
		if(!empty($project_res)){
			foreach($project_res as $prec)
			$project_master[$prec->project_code] = $prec->title;
		}
		$data['project_master']  = $project_master;
		$timesheet_db->close();
		
		$this->db->select('l.customer_type,l.pjt_id,l.project_location');
		$this->db->from($this->cfg['dbpref']. 'leads as l');
	    $query = $this->db->get();
		$results = $query->result();	
		$project_type = array();
		$project_location = array();
		if(!empty($results)){
			foreach($results as $prec){
				if($prec->customer_type == 0){
			    $project_type[$prec->pjt_id] = 'Internal';
				}
				if($prec->customer_type == 1){
			    $project_type[$prec->pjt_id] = 'External';
				}
				if($prec->customer_type == 2){
					$project_type[$prec->pjt_id] = 'BPO';
				}

				foreach($this->cfg['project_location'] as $status_key1=>$status_val1) {
                    
					if($prec->project_location == $status_key1){
						$project_location[$prec->pjt_id] = $status_val1;
					}    
				}
			}
		}
		$data['project_type']  = $project_type;
		$data['project_location']  = $project_location;
		
		$filter_group_by = $this->input->post("filter_group_by");
		$filter_sort_by  = $this->input->post("filter_sort_by");
		$filter_sort_val = $this->input->post("filter_sort_val");
		
		$data['filter_group_by'] = $this->input->post("filter_group_by");
		if(isset($filter_sort_by) && !empty($filter_sort_by))
		$data['filter_sort_by'] = $this->input->post("filter_sort_by");
		else
		$data['filter_sort_by'] = 'desc';
	
		if(isset($filter_sort_val) && !empty($filter_sort_val))
		$data['filter_sort_val'] = $this->input->post("filter_sort_val");
		else
		$data['filter_sort_val'] = 'hour';
  
		switch($this->input->post("filter_group_by")){
			case 0:
				$this->load->view('projects/practice_drilldata', $data);
			break;
			case 1:
				$this->load->view('projects/skill_drilldata', $data);
			break;
			case 2:
				$this->load->view('projects/prjt_drilldata', $data);
			break;
			case 3:
				$this->load->view('projects/resource_drilldata', $data);
			break;
			case 4:
				$this->load->view('projects/geography_drilldata', $data);
//                                $this->load->view('projects/geography_drilldata_headcount', $data);
			break;
		}
	}
     public function dashboard(){
        $this->load->view('dashboard');
	 }		 
        public function employee_project_meter(){
            $employee_data = $emp_engaged = [];
            $post_data = $this->input->post();
            $year = "2021";
            $calendar[$year] = $this->getDates($year);
            // Export excel
            if(isset($post_data['export_excel']) && !empty($post_data['export_excel'])){
                $post = (array)json_decode($post_data['postdata'], true);
                $emp_engaged = $this->engagement_meter($calendar,$post);
                $this->export_excel_employee_meter($calendar,$emp_engaged);
            }
            // Advance filter
            if(isset($post_data['filter']) && !empty($post_data['filter'])){
                $emp_engaged = $this->engagement_meter($calendar,$post_data);
            }
            $data['calendar'] = $calendar;
            $data['emp_engaged'] = $emp_engaged;
            $data['business_unit'] = $this->employee_report_model->getBusinessUnit();
            $data['entitys'] = $this->employee_report_model->entities();
            $data['geographies'] = $this->get_geographies();
//            echo '<pre>';print_r($data);
//            exit;
            if(isset($post_data['filter']) && !empty($post_data['filter'])){
                echo $this->load->view('employee_project_meter_result', $data, true);exit;
            }else{
                $this->layout->view('employee_project_meter',$data);
            }
        }
        
        public function engagement_meter($calendar,$post_data){
            $emp_engaged = [];
            $employee_data = $this->employee_report_model->employee_meter($post_data);
            if(!empty($employee_data)){
                foreach($employee_data as $values){
                    $username = $values['username'];
                    $start_date = $values['start_date'];
                    $end_date = $values['end_date'];
                    $diff_data = $this->dateDiff($start_date,$end_date);
                    $total_days = $diff_data['total_days'];
                    $iterate_date = date('Y-m-d', strtotime($start_date));
                    for($i=0;$i<=$total_days;$i++){
                        $year = date('Y',  strtotime($iterate_date));
                        $month = str_pad(date('m',  strtotime($iterate_date)), 2, "0", STR_PAD_LEFT);
                        $date = str_pad(date('d',  strtotime($iterate_date)), 2, "0", STR_PAD_LEFT);
                        if(isset($calendar[$year][$month])){
                            $emp_engaged[$username][$year][$month][$date] = "1";
                        }
                        $iterate_date = date('Y-m-d', strtotime($iterate_date. ' + 1 days'));
                    }
                }
            }
            return $emp_engaged;
        }
        
        public function getDates($year)
        {
            $dates = array();
            date("L", mktime(0,0,0, 7,7, $year)) ? $days = 366 : $days = 365;
            for($i = 1; $i <= $days; $i++){
                $month = date('m', mktime(0,0,0,1,$i,$year));
                $wk = date('W', mktime(0,0,0,1,$i,$year));
                $wkDay = date('D', mktime(0,0,0,1,$i,$year));
                $day = date('d', mktime(0,0,0,1,$i,$year));

//                $dates[$month][$wk][$wkDay] = $day; //including weeks
                $dates[$month][] = $day;
                
            } 
            return $dates;   
        }
        
        public function dateDiff($date1,$date2){
            $diff = abs(strtotime($date2) - strtotime($date1));
            $total_days = floor($diff / (60*60*24));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            return [
                'year' => $years,
                'month' => $months,
                'day' => $days,
                'total_days' => $total_days
            ];
        }
        
    /**
   * Bu implementation
   */
   /* Get Department by business_unit*/
   public function getDepartmentByBU() {
     $data  =	real_escape_array($this->input->post());
     $business_unit = $data['business_unit_id'];
     if(!empty($business_unit) && $business_unit!='null') {
       $business_unit = @explode(",",$business_unit);
     } else {
       $business_unit = '';
     }
     $bu_department = $this->employee_report_model->getDepartmentByBU($business_unit);
     foreach ($bu_department as $key => $value) {
       echo '<option value="'.$value['department_id'].'">'.$value['department_name'].'</option>';
     }
   }
   /* Get Practice by business_unit and department*/
   public function getPracticeByBUandDept() {
     $data  =	real_escape_array($this->input->post());
     $business_unit = $data['business_unit_id'];
     $department_id = $data['department_id'];
     
     if(!empty($business_unit) && $business_unit!='null') {
       $business_unit = @explode(",",$business_unit);
     } else {
       $business_unit = '';
     }
     if(!empty($department_id) && $department_id!='null') {
       $department_id = @explode(",",$department_id);
     } else {
       $department_id = '';
     }
     
     $bu_practice = $this->employee_report_model->getPracticeByBUandDept($business_unit,$department_id);
     foreach ($bu_practice as $key => $value) {
       echo '<option value="'.$value['id'].'">'.$value['practices'].'</option>';
     }
   }
   /* Get Skills by business_unit, department and Practice*/
   public function getSkillByBUandDeptandPrac() {
     $data  =	real_escape_array($this->input->post());
     $business_unit = $data['business_unit_id'];
     $department_id = $data['department_id'];
     $practice_id = $data['practice_id'];
     
     if(!empty($business_unit) && $business_unit!='null') {
       $business_unit = @explode(",",$business_unit);
     } else {
       $business_unit = '';
     }
     if(!empty($department_id) && $department_id!='null') {
       $department_id = @explode(",",$department_id);
     } else {
       $department_id = '';
     }
     if(!empty($practice_id) && $practice_id!='null') {
       $practice_id = @explode(",",$practice_id);
     } else {
       $practice_id = '';
     }
     $bu_practice = $this->employee_report_model->getSkillByBUandDeptandPrac($business_unit,$department_id,$practice_id);
     foreach ($bu_practice as $key => $value) {
       echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
     }
   }
   
   public function export_excel_employee_meter($calendar,$emp_engaged){
       $color_codes = [
           'green'=>'00FF00',
           'yellow'=>'FFFF00',
           'white'=>'FFFFFF'
       ];
       $cell_color_array1 = $cell_color_array = [];
        $this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Employee Engagement Meter');
        
        $i=1; 
        if(!empty($calendar)){
            $columnIndex = 0;
            $this->excel->getActiveSheet()
                            ->setCellValueByColumnAndRow($columnIndex,$i, "Employee Name");
            $columnIndex++;
            foreach($calendar as $year => $month){
                foreach($month as $monthKey => $days){ 

                    $dateObj   = DateTime::createFromFormat('!m', $monthKey);
                    $monthName = $dateObj->format('F'); // March
                    $this->excel->getActiveSheet()
                            ->setCellValueByColumnAndRow($columnIndex,$i, $monthName);
                    $columnIndex++; 
                }
            }
        }
        $i++;	
        
        if(!empty($emp_engaged)){
            foreach($emp_engaged as $emp_name => $yearData){ 
                $columnIndex = 0;
                $this->excel->getActiveSheet()
                            ->setCellValueByColumnAndRow($columnIndex,$i, $emp_name);
                $columnIndex++;
                foreach($calendar as $year => $month){
                    $months = array_keys($month);
                    $emp_last_key = 0;
                    if(isset($yearData[$year]) && !empty($yearData[$year])){
                        $emp_last_key = end(array_keys($yearData[$year]));
                    }
                    foreach($months as $monthKey){
                        $columnName = PHPExcel_Cell::stringFromColumnIndex($columnIndex);
                        $cell_color = "white";
                        if(isset($yearData[$year][$monthKey])){ 
                            $array_sum = array_sum($yearData[$year][$monthKey]);
                            if($array_sum > 0){
                                $cell_color = ($monthKey == $emp_last_key) ? "yellow" : "green";
                            }
                        }
                        $color_code = $color_codes[$cell_color];
                        $cell_color_array[$color_code][] = $columnName.$i;
                        $cell_color_array1[$color_code][$i][] = $columnName.$i;
                        $columnIndex++;
                    }
                }
                $i++;
            }
        }
//        echo '<pre>';print_r($cell_color_array1);
        if(!empty($cell_color_array1)){
            foreach($cell_color_array1 as $colorCode => $cellArray){
                foreach($cellArray as $cellRow => $cells){
                    $firstCell = $cells[0];
                    $lastCell = end($cells);
                    $this->excel->getActiveSheet()
                            ->getStyle($firstCell.":".$lastCell)
                            ->applyFromArray(
                                array(
                                    'fill' => array(
                                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                        'color' => array('rgb' => $colorCode)
                                    )
                                )
                            );
                }
            }
        }
        // Set Bold font for Headers
        $this->excel->getActiveSheet()->getStyle('A1:BZ1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1:BZ1')->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $filename='Employee Engagement Meter-'.time().'.xls';
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        //$error = true;
        exit();
   }
   
   public function monthly_employee_effort(){
        
        $post_data = $this->input->post();
        $year = "2021";
        // Export excel
        if(isset($post_data['export_excel']) && !empty($post_data['export_excel'])){
            $post = (array)json_decode($post_data['postdata'], true);
            $emp_engaged = $this->engagement_meter($calendar,$post);
            $this->export_excel_employee_meter($emp_engaged);
        }
        // Advance filter
        if(isset($post_data['filter']) && !empty($post_data['filter'])){
             $monthly_efforts = $this->monthly_efforts($post_data);
			 //print_r($monthly_efforts);
			 
        }
		 // echo '<pre>';
		  //print_r($monthly_efforts);
		  //exit;
        $data['monthly_efforts'] = $monthly_efforts;
        $data['business_unit'] = $this->employee_report_model->getBusinessUnit();
        $data['entitys'] = $this->employee_report_model->entities();
        $data['geographies'] = $this->get_geographies();
        if(isset($post_data['filter']) && !empty($post_data['filter'])){
            echo $this->load->view('employee_monthly_effort_result', $data, true);exit;
        }else{
            $this->layout->view('employee_monthly_effort',$data);
        }
   }
   
   public function monthly_efforts($post_data){
        $monthly_efforts = [];
        $employee_data = $this->employee_report_model->monthly_efforts($post_data);
        if(!empty($employee_data)){
            foreach($employee_data as $values){
                $empname = $values['empname'];
                $resoursetype = $values['resoursetype'];
                $month = $values['month'];
                $year = $values['year'];
                $hours = $values['hours'];
                $monthly_efforts[$empname][$year][$month][$resoursetype] = round($hours);
                if(!in_array($month,$monthly_efforts['year_months'][$year]))
                    $monthly_efforts['year_months'][$year][] = $month;
            }
        }
//        echo '<pre>';print_r($monthly_efforts);exit;
        return $monthly_efforts;
    }
}
