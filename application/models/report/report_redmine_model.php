<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_redmine_model extends crm_model {
    
    public function __construct() {
        parent::__construct();		
        $this->redmine_config = $this->config->item('crm')['redmine_report'];
        $this->redmine_db = $this->load->database('redmine', true);  
    }
    
    public function get_project_report() {
        
        $projects = $this->redmine_config['projects'];
        $redmine_open = $this->redmine_config['open'];
        $redmine_new = $this->redmine_config['new'];
        $redmine_resolved = $this->redmine_config['resolved'];
        $redmine_kun = $this->redmine_config['kun'];
        $kun_open = $this->redmine_config['kun_open'];
        $kun_resolved = $this->redmine_config['kun_resolved'];
        // Connect to redmine DB
        $redmine_db = $this->load->database('redmine', true);       
        $redmine_db->select('issues.status_id,issues.project_id,projects.identifier as identifier,projects.name as project_name,status.name,count(issues.id) as issue_count');
        $redmine_db->from('issues');
        $redmine_db->join('issue_statuses as status', 'status.id = issues.status_id', 'RIGHT');        
        $redmine_db->join('projects', 'projects.id = issues.project_id', 'RIGHT');
        $redmine_db->where_in('projects.identifier',$projects);
        $redmine_db->group_by(['issues.project_id','issues.status_id']);
        $redmine_db->order_by('issues.project_id');
        $query = $redmine_db->get();        
        $statusCount = array();
        if($query !== FALSE && $query->num_rows() > 0){
            $statusCount = $query->result_array();
        }
        $projectStatusReport = array_combine($projects, $projects);
        $projectStatusReport = [];
        foreach($projects as $value){
            $projectStatusReport[$value]['open'] = 0;
            $projectStatusReport[$value]['new'] = 0;
            $projectStatusReport[$value]['resolved'] = 0;
        }
        if(!empty($statusCount)){
            foreach($statusCount as $values){
                $project_identifier = $values['identifier'];
                $project_name = $values['project_name'];
                $status_id = $values['status_id'];
                $projectStatusReport[$project_identifier]['project_name'] = $project_name;
                // Checking for open statuses and sum the issues count
                if(in_array($status_id,$redmine_open)){
                    $projectStatusReport[$project_identifier]['open'] += $values['issue_count'];
                }
                // Checking for new statuses and sum the issues count
                if(in_array($status_id,$redmine_new)){
                    $projectStatusReport[$project_identifier]['new'] += $values['issue_count'];
                }
                // Checking for resolved statuses and sum the issues count
                if(in_array($status_id,$redmine_resolved)){
                    $projectStatusReport[$project_identifier]['resolved'] += $values['issue_count'];
                }
                
                // For KUN projects alone
                // Checking for open statuses and sum the issues count
                if(in_array($project_identifier,$redmine_kun) && in_array($status_id,$kun_open)){
                    $projectStatusReport[$project_identifier]['open'] += $values['issue_count'];
                }
                // Checking for resolved statuses and sum the issues count
                if(in_array($project_identifier,$redmine_kun) && in_array($status_id,$kun_resolved)){
                    $projectStatusReport[$project_identifier]['resolved'] += $values['issue_count'];
                }
                
                $projectStatusReport[$project_identifier]['pending'] = 
                        $projectStatusReport[$project_identifier]['open'] 
                        + $projectStatusReport[$project_identifier]['new'];
                        // - $projectStatusReport[$project_identifier]['resolved'];
            }            
        }
//        echo '<pre>';print_r($projectStatusReport);exit;
        return $projectStatusReport;
    	
    }
    
    public function get_project_report_updated() {
        
        $projects = $this->redmine_config['projects'];
        $redmine_open = $this->redmine_config['open'];
        $redmine_new = $this->redmine_config['new'];
        $redmine_resolved = $this->redmine_config['resolved'];
        $redmine_feedback = $this->redmine_config['feedback'];
        $redmine_kun = $this->redmine_config['kun'];
        $kun_open = $this->redmine_config['kun_open'];
        $kun_new = $this->redmine_config['kun_new'];
        $openIssues = $newIssues = $resolvedIssues = array();
        // Connect to redmine DB
        $redmine_db = $this->load->database('redmine', true);
        // assign status count to each projects
        $projectStatusReport = array_combine($projects, $projects);
        $projectStatusReport = [];
        foreach($projects as $value){
            $projectStatusReport[$value]['open'] = 0;
            $projectStatusReport[$value]['new'] = 0;
            $projectStatusReport[$value]['resolved'] = 0;
            $projectStatusReport[$value]['feedback'] = 0;
            $projectStatusReport[$value]['pending'] = 0;
            $projectStatusReport[$value]['resolved_last_week'] = 0;
        }
        
        ##get last sunday date
        $lastSunday = (strtolower(date('D')) != 'sun') ? date('Y-m-d 23:59:59',strtotime('last sunday')) : date('Y-m-d 23:59:59');
        ##week start date
        $weekStart = (strtolower(date('D')) != 'mon') ? date('Y-m-d 00:00:00',strtotime('last Monday')) : date('Y-m-d 00:00:00');
        ##week end date
        $weekEnd = (strtolower(date('D')) != 'sun') ? date('Y-m-d 23:59:59',strtotime('next sunday')) : date('Y-m-d 23:59:59');

        $lastWeekStart = date("Y-m-d 00:00:00", strtotime("last week monday"));
        
        $lastWeekEnd = date("Y-m-d 23:59:59", strtotime("last sunday"));
                
        ## Open issues
        ## Details of pending(All ticket except resolved and closed) tickets till created Sunday of last week
        $openIssues = $this->openIssues($projects,$lastSunday);       
        if(!empty($openIssues)){
            foreach($openIssues as $values){
                $project_identifier = $values['identifier'];
                $project_name = $values['project_name'];
                $status_id = $values['status_id'];
                $projectStatusReport[$project_identifier]['project_name'] = $project_name;
                // Checking for open and new statuses and sum the issues count for last week
                if(in_array($status_id,$redmine_open) || in_array($status_id,$redmine_new)){
                    $projectStatusReport[$project_identifier]['open'] += $values['issue_count'];
                }
                // For KUN projects alone
                // Checking for open and new statuses and sum the issues count for last week
                if(in_array($project_identifier,$redmine_kun) 
                        && in_array($status_id,$kun_open)
                        && in_array($status_id,$kun_new)
                ){
                    $projectStatusReport[$project_identifier]['open'] += $values['issue_count'];
                }
            }            
        }
        
        ## Open issues
        ## Details of resolved(All ticket created till last sunday and resolved this week) 
        $openIssuesResolved = $this->openIssuesResolved($projects,$lastSunday,$weekStart,$weekEnd);       
        if(!empty($openIssuesResolved)){
            foreach($openIssuesResolved as $values){
                $project_identifier = $values['identifier'];
                $project_name = $values['project_name'];
                $status_id = $values['status_id'];
                $projectStatusReport[$project_identifier]['project_name'] = $project_name;
                // Checking for resolved statuses and sum the issues count
                if(in_array($status_id,$redmine_resolved)){
                    $projectStatusReport[$project_identifier]['open'] += $values['issue_count'];
                }
            }            
        }
        
        
        ## New issues
        ## Details of pending (All ticket except resolved and closed) tickets created this week
        $newIssues = $this->newissues($projects,$weekStart,$weekEnd);        
        if(!empty($newIssues)){
            foreach($newIssues as $values){
                $project_identifier = $values['identifier'];
                $project_name = $values['project_name'];
                $status_id = $values['status_id'];
                $projectStatusReport[$project_identifier]['project_name'] = $project_name;
                // Irrespective of statuses
                $projectStatusReport[$project_identifier]['new'] += $values['issue_count'];
            }            
        }
        
        
        ## Resolved issues
        ## Details of Resolved (All ticket with status of resolved and closed) tickets updated on this week
        $resolvedIssues = $this->resolvedIssues($projects,$weekStart,$weekEnd);        
        if(!empty($resolvedIssues)){
            foreach($resolvedIssues as $values){
                $project_identifier = $values['identifier'];
                $project_name = $values['project_name'];
                $status_id = $values['status_id'];
                $projectStatusReport[$project_identifier]['project_name'] = $project_name;                    
                // Checking for resolved statuses and sum the issues count
                if(in_array($status_id,$redmine_resolved)){
                    $projectStatusReport[$project_identifier]['resolved'] += $values['issue_count'];
                }
            }            
        }

        ## Resolved issues last updated week
        ## Details of Resolved (All ticket with status of resolved and closed) tickets updated on last updated week
        $resolvedIssues = $this->resolvedIssues($projects,$lastWeekStart,$lastWeekEnd);        
        if(!empty($resolvedIssues)){
            foreach($resolvedIssues as $values){
                $project_identifier = $values['identifier'];
                $project_name = $values['project_name'];
                $status_id = $values['status_id'];
                $projectStatusReport[$project_identifier]['project_name'] = $project_name;                    
                // Checking for resolved statuses and sum the issues count
                if(in_array($status_id,$redmine_resolved)){
                    $projectStatusReport[$project_identifier]['resolved_last_week'] += $values['issue_count'];
                }
            }            
        }        
        
        $allIssues = $this->allIssues($projects);
        if(!empty($allIssues)){
            foreach($allIssues as $values){
                $project_identifier = $values['identifier'];
                $project_name = $values['project_name'];
                $status_id = $values['status_id'];
                $projectStatusReport[$project_identifier]['project_name'] = $project_name;                    
                // Checking for feedback and  statuses and sum the issues count
                if(in_array($status_id,$redmine_feedback)){
                    $projectStatusReport[$project_identifier]['feedback'] += $values['issue_count'];
                }
            }            
        }   

        if(!empty($projectStatusReport)){
            foreach($projectStatusReport as $key => $value){
                $projectStatusReport[$key]['pending'] = $value['open'] + $value['new'] - $value['feedback'] - $value['resolved'];
            }
        }
        
//        echo '<pre>';print_r($projectStatusReport);exit;
        return $projectStatusReport;
    	
    }
    
    ## Details of pending(All ticket except resolved and closed) tickets till created Sunday of last week
    public function openIssues($projects,$lastSunday){
        
        $openIssues = [];
        $redmine_db = $this->redmine_db;
        $redmine_db->select('issues.status_id,issues.project_id,projects.identifier as identifier,projects.name as project_name,status.name,count(issues.id) as issue_count');
        $redmine_db->from('issues');
        $redmine_db->join('issue_statuses as status', 'status.id = issues.status_id', 'RIGHT');        
        $redmine_db->join('projects', 'projects.id = issues.project_id', 'RIGHT');
        $redmine_db->where('issues.created_on <= ',$lastSunday);
        $redmine_db->where_in('projects.identifier',$projects);     
        $redmine_db->group_by(['issues.project_id','issues.status_id']);
        $redmine_db->order_by('issues.project_id');
        $query = $redmine_db->get();   
        if($query !== FALSE && $query->num_rows() > 0){
            $openIssues = $query->result_array();
        }
        return $openIssues;
    }
    
    ## Details of pending(All ticket except resolved and closed) tickets till created Sunday of last week
    public function openIssuesResolved($projects,$lastSunday,$weekStart,$weekEnd){
        
        $openIssues = [];
        $redmine_db = $this->redmine_db;
        $redmine_db->select('issues.status_id,issues.project_id,projects.identifier as identifier,projects.name as project_name,status.name,count(issues.id) as issue_count');
        $redmine_db->from('issues');
        $redmine_db->join('issue_statuses as status', 'status.id = issues.status_id', 'RIGHT');        
        $redmine_db->join('projects', 'projects.id = issues.project_id', 'RIGHT');
        $redmine_db->where('issues.created_on <= ',$lastSunday);
        $redmine_db->where('issues.updated_on >=',$weekStart);
        $redmine_db->where('issues.updated_on <=',$weekEnd);
        $redmine_db->where_in('projects.identifier',$projects);     
        $redmine_db->group_by(['issues.project_id','issues.status_id']);
        $redmine_db->order_by('issues.project_id');
        $query = $redmine_db->get();   
        if($query !== FALSE && $query->num_rows() > 0){
            $openIssues = $query->result_array();
        }
        return $openIssues;
    }
    
    ## Details of pending (All ticket except resolved and closed) tickets created this week
    public function newissues($projects,$weekStart,$weekEnd){
        
        $newIssues = [];
        $redmine_db = $this->redmine_db;
        $redmine_db->select('issues.status_id,issues.created_on,issues.project_id,projects.identifier as identifier,projects.name as project_name,status.name,count(issues.id) as issue_count');
        $redmine_db->from('issues');
        $redmine_db->join('issue_statuses as status', 'status.id = issues.status_id', 'RIGHT');        
        $redmine_db->join('projects', 'projects.id = issues.project_id', 'RIGHT');
        $redmine_db->where_in('projects.identifier',$projects);
        $redmine_db->where('issues.created_on >=',$weekStart);
        $redmine_db->where('issues.created_on <=',$weekEnd);        
        $redmine_db->group_by(['issues.project_id','issues.status_id']);
        $redmine_db->order_by('issues.project_id');
        $query = $redmine_db->get();        
        if($query !== FALSE && $query->num_rows() > 0){
            $newIssues = $query->result_array();
        }
        return $newIssues;
    }
    
    ## Details of Resolved (All ticket with status of resolved and closed) tickets updated on this week
    public function resolvedIssues($projects,$weekStart,$weekEnd){
        
        $resolvedIssues = [];
        $redmine_db = $this->redmine_db;
        $redmine_db->select('issues.status_id,issues.created_on,issues.project_id,projects.identifier as identifier,projects.name as project_name,status.name,count(issues.id) as issue_count');
        $redmine_db->from('issues');
        $redmine_db->join('issue_statuses as status', 'status.id = issues.status_id', 'RIGHT');        
        $redmine_db->join('projects', 'projects.id = issues.project_id', 'RIGHT');
        $redmine_db->where_in('projects.identifier',$projects);
        $redmine_db->where('issues.updated_on >=',$weekStart);
        $redmine_db->where('issues.updated_on <=',$weekEnd);        
        $redmine_db->group_by(['issues.project_id','issues.status_id']);
        $redmine_db->order_by('issues.project_id');
        $query = $redmine_db->get();
        if($query !== FALSE && $query->num_rows() > 0){
            $resolvedIssues = $query->result_array();
        }
        return $resolvedIssues;
    }

    public function allIssues($projects){
        
        $allissues = [];
        $redmine_db = $this->redmine_db;
        $redmine_db->select('issues.status_id,issues.created_on,issues.project_id,projects.identifier as identifier,projects.name as project_name,status.name,count(issues.id) as issue_count');
        $redmine_db->from('issues');
        $redmine_db->join('issue_statuses as status', 'status.id = issues.status_id', 'RIGHT');        
        $redmine_db->join('projects', 'projects.id = issues.project_id', 'RIGHT');
        $redmine_db->where_in('projects.identifier',$projects);
        $redmine_db->group_by(['issues.project_id','issues.status_id']);
        $redmine_db->order_by('issues.project_id');
        $query = $redmine_db->get();
        if($query !== FALSE && $query->num_rows() > 0){
            $allissues = $query->result_array();
        }
        return $allissues;
    }

    public function getProjectName($project_id){
        
        $redmine_db = $this->redmine_db;
        $redmine_db->select('projects.name as project_name');
        $redmine_db->from('projects');
        $redmine_db->where('projects.identifier',$project_id);
        $query = $redmine_db->get();
        if($query !== FALSE && $query->num_rows() > 0){
            $projects = $query->row_array();
            if(isset($projects['project_name'])){
                return $projects['project_name'];
            }else{
                return $project_id;
            }

        }else{
            return $project_id;
        }
    }
    
}