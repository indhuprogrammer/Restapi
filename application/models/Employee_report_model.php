<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Examples Model
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2018, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

class Employee_report_model extends MY_Model {

	/**
	 * Update a user record with data not from POST
	 *
	 * @param  int     the user ID to update
	 * @param  array   the data to update in the user table
	 * @return bool
	 */
	public function update_user_raw_data( $the_user, $user_data = [] )
	{
		$this->db->where('user_id', $the_user)
			->update( $this->db_table('user_table'), $user_data );
	}

	// --------------------------------------------------------------

	/**
	 * Get data for a recovery
	 * 
	 * @param   string  the email address
	 * @return  mixed   either query data or FALSE
	 */
	public function get_recovery_data( $email )
	{
		$query = $this->db->select( 'u.user_id, u.email, u.banned' )
			->from( $this->db_table('user_table') . ' u' )
			->where( 'LOWER( u.email ) =', strtolower( $email ) )
			->limit(1)
			->get();

		if( $query->num_rows() == 1 )
			return $query->row();

		return FALSE;
	}

	// --------------------------------------------------------------

	/**
	 * Get the user name, user salt, and hashed recovery code,
	 * but only if the recovery code hasn't expired.
	 *
	 * @param  int  the user ID
	 */
	public function get_recovery_verification_data( $user_id )
	{
		$recovery_code_expiration = date('Y-m-d H:i:s', time() - config_item('recovery_code_expiration') );

		$query = $this->db->select( 'username, passwd_recovery_code' )
			->from( $this->db_table('user_table') )
			->where( 'user_id', $user_id )
			->where( 'passwd_recovery_date >', $recovery_code_expiration )
			->limit(1)
			->get();

		if ( $query->num_rows() == 1 )
			return $query->row();
		
		return FALSE;
	}

	// --------------------------------------------------------------

	/**
	 * Validation and processing for password change during account recovery
	 */
	public function recovery_password_change()
	{
		$this->load->library('form_validation');

		// Load form validation rules
		$this->load->model('examples/validation_callables');
		$this->form_validation->set_rules([
			[
				'field' => 'passwd',
				'label' => 'NEW PASSWORD',
				'rules' => [
					'trim',
					'required',
					'matches[passwd_confirm]',
					[ 
						'_check_password_strength', 
						[$this->validation_callables, '_check_password_strength'] 
					]
				]
			],
			[
				'field' => 'passwd_confirm',
				'label' => 'CONFIRM NEW PASSWORD',
				'rules' => 'trim|required'
			],
			[
				'field' => 'recovery_code'
			],
			[
				'field' => 'user_identification'
			]
		]);

		if( $this->form_validation->run() !== FALSE )
		{
			$this->load->vars( ['validation_passed' => 1] );

			$this->_change_password(
				$this->input->post('passwd'),
				$this->input->post('passwd_confirm'),
				set_value('user_identification'),
				set_value('recovery_code')
			);
		}
		else
		{
			$this->load->vars( ['validation_errors' => validation_errors()] );
		}
	}

	// --------------------------------------------------------------

	/**
	 * Change a user's password
	 * 
	 * @param  string  the new password
	 * @param  string  the new password confirmed
	 * @param  string  the user ID
	 * @param  string  the password recovery code
	 */
	protected function _change_password( $password, $password2, $user_id, $recovery_code )
	{
		// User ID check
		if( isset( $user_id ) && $user_id !== FALSE )
		{
			$query = $this->db->select( 'user_id' )
				->from( $this->db_table('user_table') )
				->where( 'user_id', $user_id )
				->where( 'passwd_recovery_code', $recovery_code )
				->get();

			// If above query indicates a match, change the password
			if( $query->num_rows() == 1 )
			{
				$user_data = $query->row();

				$this->db->where( 'user_id', $user_data->user_id )
					->update( 
						$this->db_table('user_table'), 
						[
							'passwd' => $this->authentication->hash_passwd( $password ),
							'passwd_recovery_code' => NULL,
							'passwd_recovery_date' => NULL
						] 
					);
			}
		}
	}

	// --------------------------------------------------------------

	/**
     * Get an unused ID for user creation
     *
     * @return  int between 1200 and 4294967295
     */
    public function get_unused_id()
    {
        // Create a random user id between 1200 and 4294967295
        $random_unique_int = 2147483648 + mt_rand( -2147482448, 2147483647 );

        // Make sure the random user_id isn't already in use
        $query = $this->db->where( 'user_id', $random_unique_int )
            ->get_where( $this->db_table('user_table') );

        if( $query->num_rows() > 0 )
        {
            $query->free_result();

            // If the random user_id is already in use, try again
            return $this->get_unused_id();
        }

        return $random_unique_int;
    }
    
    public function advance_filter($post_data){
        // Search filter
        if(isset($post_data['entity']) && !empty($post_data['entity'])){
            $this->db->where_in('l.division', $post_data['entity']);
        }
        if(isset($post_data['business_unit_id']) && !empty($post_data['business_unit_id'])){
//            echo '<pre>';print_r($post_data);exit;
            $this->db->where_in('u.business_unit_id', $post_data['business_unit_id']);
        }
        if(isset($post_data['department_ids']) && !empty($post_data['department_ids'])){
            $this->db->where_in('u.department_id', $post_data['department_ids']);
        }
        if(isset($post_data['practice_ids']) && !empty($post_data['practice_ids'])){
            $this->db->where_in('u.practice_id', $post_data['practice_ids']);
        }
        if(isset($post_data['skill_ids']) && !empty($post_data['skill_ids'])){
            $this->db->where_in('u.skill_id', $post_data['skill_ids']);
        }
        if(isset($post_data['geography']) && !empty($post_data['geography'])){
            $this->db->where_in('l.project_geography', $post_data['geography']);
        }
    }


    public function employee_meter($post_data = []){
        
        // #1 SubQueries no.1 -------------------------------------------
        $this->advance_filter($post_data);
        $this->db->select('CONCAT(u.first_name," ",u.last_name) AS username,l.date_start as start_date,l.date_due as end_date,l.lead_title as project_name');
        $this->db->from('crm_users as u');
        $this->db->join( 'crm_leads as l', 'u.userid = l.assigned_to',"LEFT" );
//        $this->db->where('u.userid',183);
        $year_where = " (YEAR(l.date_start) >= 2021 OR (YEAR(l.date_due)>=2021 AND YEAR(l.date_due) <= 2021)) ";
        $this->db->where($year_where);
        $this->db->order_by("l.date_start","ASC");
//        $query = $this->db->get();
        $subQuery1 = $this->db->get_compiled_select();
//echo $this->db->last_query();exit;
//        $this->db->_reset_select();
//echo $this->db->last_query();exit;
        // #2 SubQueries no.2 -------------------------------------------
// Search filter
        $this->advance_filter($post_data);
        $this->db->select('CONCAT(u.first_name," ",u.last_name) AS username,l.date_start as start_date,l.date_due as end_date,l.lead_title as project_name');
        $this->db->from('crm_leads as l');
        $this->db->join( 'crm_stake_holders as s', 'l.lead_id = s.lead_id',"LEFT" );
        $this->db->join( 'crm_users as u', 's.user_id = u.userid',"LEFT" );
        $this->db->where('u.userid',183);
        $year_where = " (YEAR(l.date_start) >= 2021 OR (YEAR(l.date_due)>=2021 AND YEAR(l.date_due) <= 2021)) ";
        $this->db->where($year_where);
        $this->db->order_by("l.date_start","ASC");
//        $query = $this->db->get();
        $subQuery2 = $this->db->get_compiled_select();
//echo $this->db->last_query();
//        $this->db->_reset_select();
        
        // #3 SubQueries no.3 -------------------------------------------
// Search filter
        $this->advance_filter($post_data);
        $this->db->select('CONCAT(u.first_name," ",u.last_name) AS username,l.date_start as start_date,l.date_due as end_date,l.lead_title as project_name');
        $this->db->from('crm_leads as l');
        $this->db->join( 'crm_contract_jobs as c', 'l.lead_id = c.jobid_fk',"LEFT" );
        $this->db->join( 'crm_users as u', 'c.userid_fk = u.userid',"LEFT" );
        $this->db->where('u.userid',183);
        $year_where = " (YEAR(l.date_start) >= 2021 OR (YEAR(l.date_due)>=2021 AND YEAR(l.date_due) <= 2021)) ";
        $this->db->where($year_where);
        $this->db->order_by("l.date_start","ASC");
//        $query = $this->db->get();
//echo $this->db->last_query();exit;
//        $this->db->_reset_select();
        $subQuery3 = $this->db->get_compiled_select();

//        $this->db->_reset_select();
        // #3 Union with Simple Manual Queries --------------------------

//        $this->db->query("select * from ($subQuery1 UNION $subQuery2 UNION $subQuery3) as unionTable");

        // #3 (alternative) Union with another Active Record ------------

//        $this->db->from("($subQuery1 UNION $subQuery2 UNION $subQuery3)");
        $union_query = $this->db->query("(".$subQuery1.") UNION (".$subQuery2.") UNION (".$subQuery3.")");
//        $union_query = $this->db->get();
//        echo $this->db->last_query();exit;
//        echo '<pre>';print_r($union_query->result_array());exit;
        return $union_query->result_array();
        
    }
    
      /**
   * Bu implementation
   */
	function getBusinessUnit() {
		$this->db->select('id, business_unit');
		$this->db->from($this->cfg['dbpref'].'view_econnect_business_unit');
		$this->db->order_by('id');
                $this->db->where('status', CONST_ONE);
		$query = $this->db->get();
 		return $query->result_array();
	}
    
    /* Get Department by business_unit*/
	function getDepartmentByBU($business_unit) {
		$this->db->select('id as department_id,department as department_name');
		$this->db->from($this->cfg['dbpref'].'view_econnect_department_master');
		$this->db->order_by('department','ASC');
                $this->db->where('status', CONST_ONE);
                $this->db->where_in('business_unit', $business_unit);
		$query = $this->db->get();
 		return $query->result_array();
	}
  /* Get Practice by business_unit and department*/
	function getPracticeByBUandDept($business_unit,$department) {
		$this->db->select('id, practice as practices');
		$this->db->from($this->cfg['dbpref'].'view_econnect_practice');
		$this->db->order_by('practice','ASC');
                $this->db->where('status', CONST_ONE);
                $this->db->where_in('business_unit', $business_unit);
                $this->db->where_in('department', $department);
		$query = $this->db->get();
 		return $query->result_array();
	}
   /* Get Skills by business_unit, department and Practice*/
	function getSkillByBUandDeptandPrac($business_unit,$department,$practice) {
		$this->db->select('id, skillset as name');
		$this->db->from($this->cfg['dbpref'].'view_econnect_skills_set');
		$this->db->order_by('skillset','ASC');
                $this->db->where('status', CONST_ONE);
                $this->db->where_in('business_unit', $business_unit);
                $this->db->where_in('department', $department);
                $this->db->where_in('practice', $practice);
		$query = $this->db->get();
 		return $query->result_array();
	}
        
        public function entities(){
            $this->db->select('div_id, division_name');
            $this->db->where("status", 1);
            $entity_query 		= $this->db->get($this->cfg['dbpref'].'sales_divisions');
            return $entity_query->result();
        }
        
        public function monthly_efforts($post_data){
            $year = $post_data['year'];
            // Search filter
            if(isset($post_data['entity']) && !empty($post_data['entity'])){
                $this->db->where_in('entity_id', $post_data['entity']);
            }
            if(isset($post_data['business_unit_id']) && !empty($post_data['business_unit_id'])){
                $this->db->where_in('lead_business_unit_id', $post_data['business_unit_id']);
            }
            if(isset($post_data['department_ids']) && !empty($post_data['department_ids'])){
                $this->db->where_in('dept_id', $post_data['department_ids']);
            }
            if(isset($post_data['practice_ids']) && !empty($post_data['practice_ids'])){
                $this->db->where_in('practice_id', $post_data['practice_ids']);
            }
            if(isset($post_data['skill_ids']) && !empty($post_data['skill_ids'])){
                $this->db->where_in('skill_id', $post_data['skill_ids']);
            }
            if(isset($post_data['geography']) && !empty($post_data['geography'])){
                $this->db->where_in('geography_id', $post_data['geography']);
            }
        
            $this->db->select('t.empname,t.resoursetype,MONTH(t.start_time) as month, '
                    . 'YEAR(t.start_time) as year,sum(t.duration_hours) as hours');
            $this->db->from('crm_timesheet_month_data as t');
            $this->db->group_by('t.empname');
            $this->db->group_by('t.resoursetype');
            $this->db->group_by('MONTH(t.start_time), YEAR(t.start_time)');
            $year_where = " (YEAR(t.start_time) = $year) ";
            $this->db->where($year_where);
            $timesheet_query = $this->db->get();
//            echo $this->db->last_query();exit;
            return $timesheet_query->result_array();
        }

    // --------------------------------------------------------------

}

/* End of file Examples_model.php */
/* Location: /community_auth/models/examples/Examples_model.php */