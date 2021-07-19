<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getLeadStage'))
{
	function getLeadStage()
	{	
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		
		$CI = get_instance();
		// $CI->db->select('lead_stage_id');
		// $CI->db->from($cfg['dbpref'].'lead_stage');
		// $CI->db->where('status', 1);
		// $CI->db->order_by('sequence');
		$leadStageQuery = $CI->db->query("SELECT `lead_stage_id` FROM ".$cfg['dbpref']."lead_stage WHERE `status` = 1 ORDER BY `sequence`");
		//$leadStageQuery = $CI->db->get();
		$res1 = $leadStageQuery ->result_array();
		
		foreach ($res1 as $stage) {
			$stg[] = $stage['lead_stage_id'];
		}
		return $stg;
		
	}
	
	function getLeadStageName()
	{	
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('lead_stage_id, lead_stage_name');
		$CI->db->from($cfg['dbpref'].'lead_stage');
		$CI->db->where('status', 1);
		$CI->db->order_by('sequence');
		$sql = $CI->db->get();
		// echo $CI->db->last_query(); exit;
		$res = $sql->result_array();
		// echo "<pre>"; print_r($res); exit;
		return $res;
		
	}
	
	function getProjectGeography($id){
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('georegion_name');
		$CI->db->from($cfg['dbpref'].'geo_region');
		$CI->db->where('georegionid', $id);	
		$sql = $CI->db->get();	
		$res = $sql->row_array();	
		return !empty($res['georegion_name'])?$res['georegion_name']:'';
	}
	
	function currency_name($id,$entityid){		
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('currency_code');
		$CI->db->from($cfg['dbpref'].'cus_currency');
		$CI->db->where('currency_value', $id);	
		$CI->db->where('country_code', $entityid);
		$sql = $CI->db->get();	
		$res = $sql->row_array();	
		return !empty($res['currency_code'])?$res['currency_code']:'';
	}
	
	function getProjectManagerEmail($id){
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('u.email');
		$CI->db->from($cfg['dbpref'].'leads as l');
		$CI->db->join($cfg['dbpref'].'users as u','u.userid = l.assigned_to' );
		$CI->db->where('lead_id', $id);	
		$sql = $CI->db->get();	
		$res = $sql->row_array();	
		return !empty($res['email'])?$res['email']:'';
	}
}

   function getCompanyName($id){
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('c.first_name,cc.company');
		$CI->db->from($CI->cfg['dbpref'].'customers as c');
	    $CI->db->join($CI->cfg['dbpref'].'customers_company as cc', 'cc.companyid = c.company_id','LEFT');
		$CI->db->where('c.custid', $id);	
		$sql = $CI->db->get();	
		$res = $sql->row_array();	
		return !empty($res['company'])?$res['company'].' - '.$res['first_name']:'';
	}
	
	function getRegionName($id){
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('rg.region_name');
		$CI->db->from($CI->cfg['dbpref'].'customers as c');
	    $CI->db->join($CI->cfg['dbpref'].'customers_company as cc', 'cc.companyid = c.company_id','LEFT');
	    $CI->db->join($CI->cfg['dbpref'] . 'customers_company_address as cca', 'cca.customer_id = c.company_id','LEFT');			
		$CI->db->join($CI->cfg['dbpref'].'region as rg', 'rg.regionid = cca.add1_region','LEFT');
		$CI->db->where('c.custid', $id);
		$sql = $CI->db->get();	
		$res = $sql->row_array();	
		return !empty($res['region_name'])?$res['region_name']:'';
	}
	
	function getUserNameLead($id){  
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('u.first_name,u.last_name');
		$CI->db->from($CI->cfg['dbpref'].'users as u');
		$CI->db->where('u.userid', $id);
		$sql = $CI->db->get();	
		$res = $sql->row_array();			
		return !empty($res['first_name'])?$res['first_name'].' '.$res['last_name']:'';
	}
	function getLeadName($id){
		$CI = get_instance();
		$cfg = $CI->config->item('crm');
		$CI->db->select('ls.lead_stage_name');
		$CI->db->from($CI->cfg['dbpref']. 'lead_stage as ls');
		$CI->db->where('ls.lead_stage_id', $id);
		$sql = $CI->db->get();	
		$res = $sql->row_array();			
		return !empty($res['lead_stage_name'])?$res['lead_stage_name']:'';
	}



/* End of file lead_stage_helper.php */
/* Location: ./system/helpers/lead_stage_helper.php */