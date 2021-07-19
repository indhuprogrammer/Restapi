<?php

/*
*
* CRM specific config variables
* Such as DB table prefix and user levels
*
*/
$config['crm']['app_name']      = 'eNoah';
$config['crm']['app_full_name'] = 'eNoah Customer Relationship Management';
$config['crm']['app_version']   = '1.2.01';
$config['crm']['app_date']      = '02-08-2016';

$config['crm']['dbpref']        = 'crm_';
$config['crm']['theme']         = 'eNoah';
$config['crm']['data']          = '';
$config['crm']['payment_tracking'] = array(

                                    1 => 'Invoice Request Raised',
                                    2 => 'Invoice Raised',
                                    3 => 'Payment Completed'

                                );
$config['crm']['domain_status'] = array(
                                    0 => 'Not Delegated',
                                    1 => 'Active',
                                    2 => 'Web Forwarding',
                                    3 => 'Inactive'
                                );
$config['crm']['host_location'] = array(
									'' => 'HOST LOCATION',
                                    1 => 'eNoah Domain'
                                );
$config['crm']['host_status'] = array(
									'' => 'HOST STATUS',
                                    1 => ' Live ',
                                    2 => 'Staging',
                                    3 => 'Hosted by Client',
									4 => 'Plan to Archive',
									5 => 'Archived'
                                );
$config['crm']['domain_ssl_status'] = array(
                                    0 => 'No SSL',
                                    1 => 'Shared SSL',
                                    2 => 'Dedicated SSL'
                                );


$config['crm']['job_complete_status'] = array(
                                    0 => 'Pending Production',
                                    1 => '10%',
                                    2 => '20%',
                                    3 => '30%',
                                    4 => '40%',
                                    5 => '50%',
                                    6 => '60%',
                                    7 => '70%',
									8 => '80%',
                                    9 => '90%',
                                    10 => '100%',
                                    11 => 'Complete'
                                );

$config['crm']['milestones_complete_status'] = array(
                                    0 => '0%',
                                    10 => '10%',
                                    20 => '20%',
                                    30 => '30%',
                                    40 => '40%',
                                    50 => '50%',
                                    60 => '60%',
                                    70 => '70%',
									80 => '80%',
                                    90 => '90%',
                                    100 => '100%'
                                );
$config['crm']['milestones_status'] 		= array(0 => 'Scheduled',1 => 'In Progress',2 => 'Completed');
$config['crm']['excluded_stake_holders'] 		   = ['shashi@enoahisolution.com'];
$config['crm']['customer_type'] 		    = array(0 => 'Internal',1 => 'External',2 => 'BPO');
$config['crm']['location'] 		         = array(1 => 'Chennai',2 => 'Coimbatore',3 => 'Indore');
$config['crm']['billing_type'] 				= array(1 => 'Milestone Based',2 => 'Monthly Based');
$config['crm']['project_location'] 				= array(1 => 'Offshore',2 => 'Onsite');
$config['crm']['invoice_location'] 				= array('CHN-01' => 'Chennai','CBE-01' => 'Coimbatore');
$config['crm']['tasks_search']  			= array(0 => 'Work In Progress',1 => 'Completed',-1 => 'All');

$config['crm']['max_allowed_users'] 		= array(0=>10000);

$config['crm']['director_emails']  			= array('Admin' => 'webmaster@mail.com',);
$config['crm']['management_emails'] 		= array('Senior Management' => 'sm@mail.com',);
// $config['crm']['account_emails'] 			= array('Accounts' => 'accounts@mail.com');
$config['crm']['account_emails'] 			= array('Accounts' => 'finance@mail.com');
$config['crm']['account_emails_cc'] 		= array('Mukesh' => 'mukesh@mail.com');
// $config['crm']['account_emails_cc'] 		= array('Mukesh' => 'ssriram@mail.com');

$config['crm']['bpo_account_emails_cc'] 	= array('Subbu' => 'subbu@mail.com');
$config['crm']['eads_account_emails_cc'] 	= array('Mukesh' => 'mukesh@mail.com');

$config['crm']['its_invoice_emails_cc'] 	= array('Mukesh' => 'mukesh@mail.com');
$config['crm']['bpo_invoice_emails_cc'] 	= array('Subbu' => 'subbu@mail.com');

$config['crm']['crm_admin'] 				= array('crm_admin' => 'rkumaran@mail.com');
$config['crm']['fy_months']  				= array('04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec','01'=>'Jan','02'=>'Feb','03'=>'Mar');
# keep in sync with above

$config['crm']['subscription_first_notify_days']=15;
$config['crm']['subscription_notify_before_expiry_cycle']=2;
$config['crm']['subscription_notify_after_expiry_cycle']=2;
$config['crm']['subscription_from_name']='Webmaster';
$config['crm']['subscription_from_email']='webmaster@enoahprojects.com';
$config['crm']['subscription_email_subject']='Hosting Renewal Reminder';
$config['crm']['subscription_include_services']=['6'];

## Redmine report related params
$redmine_projects = [
                    'ITS-NOV-02-1216',
                    'its-ach-01-0217-achintyo',
                    'its-ban-01-0118-bank-bazaar',
                    'its-fab-01-1217-faber-sindoori-post-go-live-support',
                    'its-kal-03-1117-kalaignar-tv',
                    'its-mag-01-0416',
                    'its-nut-01-0718-nutra-specialities-sap-b1-support',
                    'its-sha-01-0118-shachihata',
                    'its-svm-01-0416',
                    'its-ava-01-1218',
                    'ITS-MCC-01-0319',
                    'its-ice-01-1118',
                    'SAP-PIO-02-0919',
                    'its-oss-01-0118-ross-controls-india-p-limited',
                    'its-kun-01-1218',
                    'its-cos-09-0917',
                    'its-eno-19-1015',
                    'its-eup-01-0619-cs-ams',
                    'ENO-IPE-01-0120',
                    'ENO-DIH-01-0819',
                    'ITS-ELE-01-0119',
                    'its-lob-01-0418-global-stones-pvt-ltd',
                    //Added on June 09,2021
                    'SAP-TAY-01-1120',
                    'eno-eva-01-0920-sap-b1-sevana-electrical-appliances-pvt-ltd',
                    'ENO-KMB-01-0720'
                ];
$kun_project = ['its-kun-01-1218-kun-aerospace-pvt-ltd-ams'];
$redmine_open = [2,7,17,4,29]; //2-In-progress, 7-assigned, 17-OnHold, 4-feedback, 29-External testing
$redmine_new = [1,8,17,4,29]; //1-new, 4-feedback, 8-reopened, 17-OnHold, 4-feedback, 29-External testing
$kun_project = ['its-kun-01-1218'];
$redmine_resolved = [3,5]; //3-resolved, 5-closed
$kun_open = [27,28]; //27-Next Add-On Release, 28-Internal Testing
$kun_new = [];
$redmine_feedback = [4,29,17]; //4-feedback, 29-External testing, 17-OnHold
$redmine_report['projects']=$redmine_projects;
$redmine_report['open']=$redmine_open;
$redmine_report['new']=$redmine_new;
$redmine_report['resolved']=$redmine_resolved;
$redmine_report['feedback']=$redmine_feedback;
$redmine_report['kun']=$kun_project;
$redmine_report['kun_open']=$kun_open;
$redmine_report['kun_new']=$kun_new;
$config['crm']['redmine_report'] = $redmine_report;
        
## Compliance module field ids referred from the DB
$compliance['status_field_id'] = 4;
$compliance['attachment_field_id'] = '19'; 
$compliance['site_field_id'] = 3;
$compliance['notes_field_id'] = 7;
$compliance['assignee_field_id'] = 6;
$compliance['description_field_id'] = 2;
$compliance['priority_field_id'] = 5;
$compliance['severity_field_id'] = 11;
$compliance['resolution_field_id'] = 36;
$compliance['target_version_field_id'] = 31;
$compliance['subject_field_id'] = 1;
$compliance['category_field_id'] = 52;
$compliance['project_specific_field_ids'] = [30,31,35,41,47,52];
$compliance['project_version_field_ids'] = [30,31,35,41];
$compliance['textarea_fields'] = [2,7];
$compliance['attachment_fields'] = [19];
//site field values
$compliance['econnect_db'] = 'econnect';
$compliance['locatablename'] = 'user_location';
$compliance['locationid'] = 'user_location_id';
$compliance['location_name'] = 'employee_location';

$compliance['attachment_path'] = 'crm_data/compliance_files/';
$compliance['compliance_from_email'] = 'webmaster@enoahisolution.com';
$compliance['compliance_from_email_name'] = 'Webmaster';

// Compliance groups(roles)
$reporter_id = 501;
$auditor_id = 502;
$auditee_id = 503;
$fh_id = 504;
$ciso_id = 505;
$PM = 3;

$compliance['compliance_role']['PM'] = $PM;
$compliance['compliance_role']['reporter_id'] = $reporter_id;
$compliance['compliance_role']['auditor_id'] = $auditor_id;
$compliance['compliance_role']['auditee_id'] = $auditee_id;
$compliance['compliance_role']['fh_id'] = $fh_id;
$compliance['compliance_role']['ciso_id'] = $ciso_id;

// Compliance Tracker Types
$compliance['complianceTracker'] = '1';
$compliance['issueTracker'] = '2';
$compliance['tracker_types'] = [$compliance['complianceTracker']=> 'Compliance Tracker',$compliance['issueTracker'] => 'Issue Tracker'];

//Compliance admin roles
$admin = 1;
$management = 2;
$qaManager = 15;
$complianceAdminRoles[] = $admin;
$complianceAdminRoles[] = $management;
$complianceAdminRoles[] = $qaManager;
$compliance['compliance_admin_roles'] = serialize($complianceAdminRoles);

// Compliance admin roles for deleting the tickets
$complianceDeletionRoles[] = $admin;
$complianceDeletionRoles[] = $qaManager;
$compliance['compliance_deletion_roles'] = $complianceDeletionRoles;

//Field transition priority
$compliance['field_required'] = '0';
$compliance['field_readOnly'] = '1';
$compliance['field_optional'] = '2';
$fieldTransitionPriority = ['1' => $compliance['field_required'], '2' => $compliance['field_optional'], '3' => $compliance['field_readOnly'] ];
$compliance['field_transition_priority'] = $fieldTransitionPriority;
//CRM roles
$project_manager_id = '3';
$developer_id = '8';
$compliance['project_manager_role'] = $project_manager_id;
$compliance['developer_role'] = $developer_id;
$us_role = 16;
$compliance['us_role'] = $us_role;
//Setting role arrays to 2 different trackers (Compliance / Tracker)
$compliance['tracker_type_roles_list'][$compliance['complianceTracker']] = [$auditor_id,$project_manager_id,$developer_id,$fh_id,$ciso_id,$admin,$management,$qaManager,$us_role];
$compliance['tracker_type_roles_list'][$compliance['issueTracker']] = [$reporter_id,$project_manager_id,$developer_id,$admin,$management,$qaManager];    

//Allowed attachment extensions
$compliance['allowed_extensions'] = ['jpeg','jpg','png','pdf','xls','xlsx','ods','doc','docx','msg'];

//check ticket create permission in quality metrics in project tab
$compliance['compliance_master_id'] = 191;
$compliance['Approved_by_FH'] = 21; //6; 
$compliance['Reviewed_by_Auditor'] = 20;//5; 
// Compliance mail blocked to below users
$compliance['restricted_email'] = ['neel@mail.com,balu@mail.com,ramesh@mail.com,sherman@mail.com,mukesh@mail.com,gharihara@mail.com,shashi@mail.com,msk@mail.com'];

//non-inclusive roles
// $admin = 1;
$businessDevelopment = 12;
$finance = 4;
$sales = 5;
$presales = 9;
$reseller = 14;
$is_support = 11;
$infra_manager = 10;
// $management = 2;
$user_admin = 13;

$nonInclusiveRoles = [$businessDevelopment,$finance,$sales,$presales,$reseller,
                    $is_support,$infra_manager,$user_admin,$auditee_id];
$compliance['non_inclusive_roles'] = serialize($nonInclusiveRoles);
##Blocked roles list for Complaince mail sending
$mailBlockedRoles = [$sales,$management];
$compliance['mail_blocked_roles'] = $mailBlockedRoles;
// Set Maximum allowed file size
$compliance['allowed_file_size'] = 2;
// additional filters list
$additionalFilters = ['3' => 'Site','29' => 'NC Type','11' => 'Severity', '28' => 'Due date',
    '58' => 'Process impact','60' => 'Delivery impact','59' => 'Security impact','12' => 'RCA'];
$compliance['additional_filters'] = $additionalFilters;
// Observation tracker
$compliance['observation_tracker'] = 4;
// Observation value in severity field
$observation_value = 119;
$compliance['observation_value'] = $observation_value;
// Field values should not be shown for New tickets
$compliance['severity_hidden_values'] = [5,8];
// NC type field values
$process_impact = 58;
$security_impact = 59;
$delivery_impact = 60;
$compliance['nc_type_fields'] = [$process_impact,$delivery_impact,$security_impact];
// Severity field id
$compliance['severity_field_id'] = 11;
$compliance['rca_field_id'] = 12;
// Overdue tickets
// Trackers to be considered
$nc_tracker = 3;
$compliance['overdue_trackers'] = [$nc_tracker];
$status_closed = 9;
$compliance['status_closed'] = $status_closed;
$due_date_field = 28;
$compliance['due_date_field'] = $due_date_field;
$severity_minor = 7;
$compliance['severity_minor'] = $severity_minor;
$new_assignee_field = 61;
$compliance['new_assignee_field'] = $new_assignee_field;

$config['crm']['compliance'] = $compliance;
# SOA sales role id access enabled - User id - 145 - Shashi
$config['crm']['soa_sales_access'] = [145];
# finance login folder permission
$config['crm']['finance_team_id'] = [310,1854]; // 1854 - kamali , only access to saravanan
$turbotic_ab = '1651';
$php_agency = '1700';
# setting static vat & routing no for the customers
$customer_vat_routing = [
    //1651 - Turbotic AB
    $turbotic_ab => ['vat' => 'VAT nr: SE559262067701','aba_routing' => 'FW122000247','domestic_routing' => 'FW122000247']
];
$config['crm']['customer_vat_routing'] = $customer_vat_routing;
$enable_attention_customers = [$turbotic_ab,$php_agency];
$config['crm']['enable_attention_customers'] = $enable_attention_customers;
?>
