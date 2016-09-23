<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subcontractor Class
 *
 * @package: Subcontractor
 * @subcontractor_divisions are changed to: cost_code_options
 * @subpackage: Subcontractor
 * @category: Subcontractor
 * @author: Chandru
 * @createdon(DD-MM-YYYY): 21-04-2015
*/
class Subcontractor extends UNI_Controller
{
    public function __construct()
    {
        parent::__construct();
$this->load->model(array('Mod_user','Mod_general_value','Mod_timezone','Mod_saved_search','Mod_role','Mod_subcontractor','Mod_reminder','Mod_message','Mod_task','Mod_builder','Mod_notification','Mod_doc','Mod_plan','Mod_project'));
        $this->module = 'subcontractor';
    }
    public function user_subcontractor()
    {
        $post_array = array( 'builder_id' => $this->user_session['builder_id'],
                             'user_id' => $this->user_session['ub_user_id'],
                             'module_name' => $this->module
         );
         $result_data = $this->Mod_saved_search->get_saved_search(array(
                                                 'select_fields' => array(),
                                                 'where_clause' => $post_array
                                                 ));
        if($result_data['status'] == true)
        {
            $apply_filter = true;
        }else{
        $apply_filter = false;
        }
        $data = array(
        'title'               => "UNIBUILDER",
        'page_id'              => 'user',
        'content'              => 'content/user/user_subcontractor',
        'date_all'            => 'date_all',
        'data_table'          => 'data_table',
        'sub_vendors'       => 'sub_vendors',
        'search_session_array' => $this->uni_session_get('SEARCH'),
        'apply_filter'=>$apply_filter
        );

        $this->template->view($data);
    }
    /**
    * Get get_sub_contractor
    *
    * @method: get_sub_contractor
    * @access: public
    * @param:  ajax post array
    * @return: array
    * created by : chandru
    */
    public function get_sub_contractor($page_count = '')
    {
        $post_array[] = array(
                            'field_name' => 'UB_SUBCONTRACTOR.builder_id',
                            'value'=> $this->user_session['builder_id'],
                            'type' => '='
                            );
		$post_array[] = array(
                            'field_name' => 'UB_USER.user_status',
                            'value'=> 'Active',
                            'type' => '='
                            );
		/* "ISDELETED" condition checking 06-10-2015 added by chandru */
		$post_array[] = array(
							'field_name' => 'UB_SUBCONTRACTOR.is_delete',
							'value' => 'No',
							'type' => '='
							);
        $total_count_array =  array();
        if(!empty($this->input->post()))
        {
            // Sanitize input
            $result = $this->sanitize_input();


            if(TRUE === $result['status'])
            {

                $search_session_array = array();
                if(isset($result['data']['company_name']) && $result['data']['company_name']!='' && $result['data']['company_name'] != 'null')
                {
                    $post_array[] = array(
                                'field_name' => 'UB_SUBCONTRACTOR.company',
                                'value'=> $result['data']['company_name'],
                                'type' => 'like'
                            );
                     $search_session_array['company'] = $result['data']['company_name'];
                }
                if($page_count == 'result_array')
               {
                if(isset($this->uni_session_get('SEARCH')['company_name']) && $this->uni_session_get('SEARCH')['company_name']!='' && $this->uni_session_get('SEARCH')['company_name'] != 'null')
                {
                  $post_array[] = array(
                                'field_name' => 'UB_SUBCONTRACTOR.company',
                                'value'=> $this->uni_session_get('SEARCH')['company_name'],
                                'type' => 'like'
                            );

                 
                  //$search_session_array['daterange'] = $result['data']['daterange'];
                }
               }
                /*
                 Paggination length stored in seesion code start here
                */
                $search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
                $search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
                // Setting session
                $this->uni_set_session('search', $search_session_array);

                $where_str = $this->Mod_subcontractor->build_where($post_array);
                // Pagination Array
                $pagination_array = array();
                if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
               {
                   $pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);
                   $total_count_array = $this->Mod_subcontractor->get_sub_contractors(array(
                                                'select_fields' => array('COUNT(UB_SUBCONTRACTOR.ub_subcontractor_id) AS total_count'),
                                                'where_clause' => $where_str,
                                                'join'=> array('builder'=>'Yes')
                                                )); 
               }
              else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
              {
                $pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
                $total_count_array = $this->Mod_subcontractor->get_sub_contractors(array(
                                                'select_fields' => array('COUNT(UB_SUBCONTRACTOR.ub_subcontractor_id) AS total_count'),
                                                'where_clause' => $where_str,
                                                'join'=> array('builder'=>'Yes')
                                                )); 
              }
               /* if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
                {
                    $pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
                    // Get number of records
                    $total_count_array = $this->Mod_subcontractor->get_sub_contractors(array(
                                                'select_fields' => array('COUNT(UB_SUBCONTRACTOR.ub_subcontractor_id) AS total_count'),
                                                'where_clause' => $where_str,
                                                'join'=> array('builder'=>'Yes')
                                                )); 
                }*/
                // Order by
                $order_by_where = '';
                if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
                {
                    // echo $result['data']['iSortCol_0'];
                    $sort_type = $result['data']['sSortDir_0'];
                    $sort_filed_column_id = $result['data']['iSortCol_0'];
                    $dt_filed_name = 'mDataProp_';
					// Get formatted sort name
					$format_sort_name = $this->Mod_subcontractor->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'UB_SUBCONTRACTOR.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
                    
                }

            }
            else
            {
                $this->Mod_subcontractor->response($result);
            }
        }
        //$date_array = array('TASK.due_date'=> 'due_date');
        $query_array = array('select_fields' => array('UB_SUBCONTRACTOR.ub_subcontractor_id','UB_SUBCONTRACTOR.builder_id', 'UB_SUBCONTRACTOR.user_id', 'UB_SUBCONTRACTOR.company','SUBSTRING(UB_SUBCONTRACTOR.division,1,25) as division','CHAR_LENGTH(UB_SUBCONTRACTOR.division) as length', 'UB_SUBCONTRACTOR.address', 'UB_SUBCONTRACTOR.city', 'UB_SUBCONTRACTOR.province','UB_SUBCONTRACTOR.postal','UB_SUBCONTRACTOR.desk_phone','UB_SUBCONTRACTOR.mobile_phone','UB_SUBCONTRACTOR.fax','UB_SUBCONTRACTOR.access_to_all_projects','UB_SUBCONTRACTOR.access_to_all_owners','UB_SUBCONTRACTOR.other_notes','UB_SUBCONTRACTOR.hold_payments','UB_SUBCONTRACTOR.notes','UB_SUBCONTRACTOR.created_on','UB_SUBCONTRACTOR.created_by','UB_SUBCONTRACTOR.modified_on','UB_SUBCONTRACTOR.modified_by','UB_USER.primary_email','UB_USER.alternative_email','UB_USER.country','UB_USER.first_name','UB_USER.login_enabled','UB_USER.user_status'),
        'join'=> array('builder'=>'Yes'),
        'where_clause' => $where_str,
        'order_clause' => $order_by_where,
        'pagination' => $pagination_array
        );
        //echo '<pre>';print_r($result['data']);exit;
         if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
        {
            unset($query_array['pagination']);
        }

        $result_data = $this->Mod_subcontractor->get_sub_contractors($query_array);
        if($page_count == 'result_array')
        {
          //print_r($result_data);exit;
          return $result_data;
        }
        // File export request
         /* if($result['data']['fetch_type'] == 'export')
        {
            $field_list_array = array('title','project_name','tags','category');

            // Export file header column
            $export_array['header'][0] = array('Checklist','Project','Tags','Category');

            foreach($result_data['aaData'] as $fields)
            {
                $line = array();
                foreach($fields as $key => $item)
                {
                    if (in_array($key, $field_list_array))
                    {
                        $ab = array_search($key,$field_list_array);
                        $line[$ab] = $item;
                    }
                }
                if(ksort($line))
                {
                    $export_array['value'][] = $line;
                }
            }
            echo array_to_export($export_array,'uni_Checklist.xls','xls');exit;
        }  */

        // The following parameters required for data table

        if($result_data['status'] == FALSE)
        {
            $result_data = array();
            $result_data['aaData'] = array();
        }
        else
        {
            $result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
            $result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
            $result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
        }
        // Response data
        $this->Mod_subcontractor->response($result_data);
    }

    /**
     * Subcontractor Class
     *
     * @package: Subcontractor
     * @subpackage: Subcontractor
     * @category: Subcontractor
     * @author: Chandru
     * @createdon(DD-MM-YYYY): 19-04-2015 16:13
    */
    public function save_subcontractor($ub_subcontractor_id = 0)
       {
        $results = $this->sanitize_input();
         $data = array(
        'title'               => "Subcontractor",
        'page_id'              => 'user',
        'content'              => 'content/user/add_subcontractor',
        'date_all'            => 'date_all'
        );
		  //echo '<pre>';print_r($_FILES);exit;
		/* if(!empty($this->input->post()))
		{
			echo '<pre>';print_r($_FILES);
			 foreach ($_FILES as $type => $properties)
			{
				foreach ($properties as $name => $values)
				{
					for ($i = 0; $i < count($values); $i++)
					{
						 $result[$i][$name] = $values[$i];
					}
				}
			}
			echo '<pre>';print_r($result);exit;  
		} */
        /* Fetch file name code */
		 /* if(!empty($this->input->post()))
             {
        $task_data = array(      'flag' => 2,
                                  'builder_id'    => $this->user_session['builder_id'],
                                  'projectid' => 0,
                                  'folderid' => 0,
                                  'modulename' => 'user',
                                  'moduleid' => $ub_subcontractor_id,
                                );
            $result_array = $this->Mod_doc->get_files_for_folder($task_data);
            // echo '<pre>';print_r($result_array);exit;

            //echo "<pre>";print_r($result_array);exit;
            if(isset($result_array['0']['ub_doc_file_id']) && !empty($result_array['0']['ub_doc_file_id']))
            {
                $data['profile_pic_id'] = $result_array['0']['ub_doc_file_id'];
                $data['profile_pic'] = $result_array['0']['system_file_name'];
            }
			} */
        //Division from general value table
        /* $args =array('classification'=>'subcontractor_department', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
        $subcontractor_department_array = $this->Mod_general_value->get_general_value($args);
        $data['subcontractor_department'] = array();
        if(isset($subcontractor_department_array['values']))
        {
            $data['subcontractor_department'] = $subcontractor_department_array['values'];

        } */
		// echo '<pre>';print_r($data['subcontractor_department']);exit;
		/* New dropdown code */
			// Get cost codes
        $args['where_clause'] = "builder_id = 0";
        $args['select_fields'] = array('cost_variance_code','cost_variance_code');
        $cost_code_options = $this->Mod_general_value->get_db_options(UB_COST_CODE, $args,'multiple');
        $data['cost_code_options'] = $cost_code_options; 
		/* New dropdown code */
            /* if(!empty($this->input->post()))
                {

                } */
                    // Code for single fle upload end
        /* File upload code ends here */
        //Edit code
        if($ub_subcontractor_id > 0 || isset($results['data']['ub_subcontractor_id']) && $results['data']['ub_subcontractor_id'] > 0)
        {

             if(!empty($this->input->post()))
             {
               //Sanitize input
              //Edit code
              $results = $this->sanitize_input();
			  /* Below code for project access */
				if(isset($results['data']['project_list']) && !empty($results['data']['project_list']))
				{
				/* Below line for remove nothing selected */
				$project_list_array = array_filter($results['data']['project_list']);
				if(isset($project_list_array) && !empty($project_list_array))
				{
				$project_implode_array = implode(',',$project_list_array);
				$formated_project_array = ','.$project_implode_array;
				}else{
				$formated_project_array = '';
				}
				}else{
				$formated_project_array = '';
				}
              $subcontractor_department = "";
			if(isset($results['data']['subcontractor_department']))
              {
              $subcontractor_department = "".implode(",", $results['data']['subcontractor_department'])."";
              }
              $certificate_name = "";
             if(isset($results['data']['certificate_name']))
             {
                $certificate_name = $results['data']['certificate_name'];
             }
             $reminder_start_date = "";
             if(isset($results['data']['reminder_start_date']))
             {
                $reminder_start_date = $results['data']['reminder_start_date'];
             }
             $reminder_type = "";
             if(isset($results['data']['reminder_type']))
             {
                $reminder_type = $results['data']['reminder_type'];
             }
             $reminds_in_days = "";
             if(isset($results['data']['reminds_in_days']))
             {
                $reminds_in_days = $results['data']['reminds_in_days'];
             }
             $certificate_id =array();
             if(isset($results['data']['certificate_id']))
             {
                $certificate_id = $results['data']['certificate_id'];
             }
             $save_type = $results['data']['save_type'];
                $sub_contractor_update_main_array = array(
                    'company' => $results['data']['company'],
                    'user_id' => $results['data']['user_id'],
                    'division' => $subcontractor_department,
                    'address' => $results['data']['address'],
                    'city' => $results['data']['city'],
                    'province' => $results['data']['province'],
                    'postal' => $results['data']['postal'],
                    'desk_phone' => $results['data']['desk_phone'],
                    'mobile_phone' => $results['data']['mobile_phone'],
                    'mobile_isd_code' => $results['data']['mobile_isd_code'],
                    'fax' => $results['data']['fax'],
                    'access_to_all_projects' => isset($results['data']['access_to_all_projects']) ? "Yes" : "No",
                    'access_to_all_owners' => isset($results['data']['access_to_all_owners']) ? "Yes" : "No",
                    'login_enabled' => isset($results['data']['login_enabled']) ? "Yes" : "No",
					'accessmethod' => $results['data']['accessmethod'],
                    'username' => $results['data']['user_name'],
                    'password' => $results['data']['password'],
                    'first_name' => $results['data']['first_name'],
                    'primary_email' => $results['data']['primary_email'],
                    'alternative_email' => $results['data']['alternative_email'],
                    'country' => $results['data']['country'],
                    'role_id' => SUB_CONTRACTOR_ROLE_ID,
                    'time_zone' => $results['data']['time_zone'],
                    'date_format' => $results['data']['date_format'],
                    'other_notes' => $results['data']['other_notes'],
                    'hold_payments' => isset($results['data']['hold_payments']) ? "Yes" : "No",
                    'notes' => $results['data']['payment_notes'],
                    'certificate_id' => $certificate_id,
                    'certificate_name' => $certificate_name,
                    'reminder_start_date' => $reminder_start_date,
                    'reminder_type' => $reminder_type,
                    'reminds_in_days' => $reminds_in_days,
                    'ub_subcontractor_id' => $results['data']['ub_subcontractor_id']
                );
                    $response = $this->Mod_subcontractor->update_sub_contractors($sub_contractor_update_main_array);
					
					/* Edit project access code added by chandru 29-09-2015 */
					if(isset($formated_project_array) && !empty($formated_project_array))
					 {
						$type = 'edit';
						$project_responce = $this->Mod_project->add_in_project_and_access_table($formated_project_array,$results['data']['ub_subcontractor_id'],$type);
					 }else{
						$type = 'edit';
						$$formated_project_array = array();
						$project_responce = $this->Mod_project->add_in_project_and_access_table($formated_project_array,$results['data']['ub_subcontractor_id'],$type);
					 }
                    
                    if($save_type == 'save_and_stay_and_sent_mail')
                    {
                     $results['data']['ub_user_id'] = $results['data']['user_id'];
                     $results['data']['name'] = $results['data']['first_name'];
                     $responses = $this->Mod_user->user_email_invitation($results['data']);
                    }
                    /* fILE STURCTURE CODE starts here */
                   /*  $get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'user'))
                               );
                    $all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
                    $file_data = array(      'flag' => 2,
                                  'builder_id'    => $this->user_session['builder_id'],
                                  'projectid' => 0,
                                  'createdby' => $this->user_session['ub_user_id'],
                                  'modulename' => $this->module,
                                );

                        $file_data['moduleid'] = $results['data']['ub_subcontractor_id'];
                        $file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
                       // $file_data['filename'] = $_FILES['attachment']['name'];
						 $file_data['filename'] = $_FILES['attachments']['name'];
                        $result_array = $this->Mod_doc->insert_file($file_data);
                        // Code to move the files from temp to actual dir
						
                        if ($result_array['0']['createfolderflag'] == 1)
                        {
                            $response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
                            if(TRUE === $response['status'])
                            {
                                $session_id = $this->session->userdata('session_id');
								move_uploaded_file($_FILES['attachment']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                            }
                        }
                        else
                        {
                            $session_id = $this->session->userdata('session_id');
							move_uploaded_file($_FILES['attachment']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                        } */
                        /* fILE STURCTURE CODE starts here */
						$this->Mod_subcontractor->response($response);
              }

            else
            {
            // Get inserted data with help of id
             $result_data = $this->Mod_subcontractor->get_sub_contractor(array(
            'select_fields' => array('UB_SUBCONTRACTOR.ub_subcontractor_id','UB_SUBCONTRACTOR.builder_id', 'UB_SUBCONTRACTOR.user_id', 'UB_SUBCONTRACTOR.company', 'UB_SUBCONTRACTOR.division', 'UB_SUBCONTRACTOR.address', 'UB_SUBCONTRACTOR.city', 'UB_SUBCONTRACTOR.province','UB_SUBCONTRACTOR.postal','UB_SUBCONTRACTOR.desk_phone','UB_SUBCONTRACTOR.mobile_phone','UB_SUBCONTRACTOR.fax','UB_SUBCONTRACTOR.access_to_all_projects','UB_SUBCONTRACTOR.access_to_all_owners','UB_SUBCONTRACTOR.other_notes','UB_SUBCONTRACTOR.hold_payments','UB_SUBCONTRACTOR.notes','UB_SUBCONTRACTOR.created_on','UB_SUBCONTRACTOR.created_by','UB_SUBCONTRACTOR.modified_on','UB_SUBCONTRACTOR.modified_by','UB_USER.primary_email','UB_USER.alternative_email','UB_USER.country','UB_USER.first_name','UB_USER.login_enabled','UB_USER.user_status','UB_USER.username','UB_USER.password','UB_USER.date_format','UB_USER.time_zone','UB_USER.role_id','GROUP_CONCAT(ub_subcontractor_addition_info.certificate_name) as certificate_name','GROUP_CONCAT(ub_subcontractor_addition_info.reminder_start_date) as reminder_start_date','GROUP_CONCAT(ub_subcontractor_addition_info.reminder_type) as reminder_type','GROUP_CONCAT(ub_subcontractor_addition_info.reminds_in_days) as reminds_in_days',
			'GROUP_CONCAT(ub_subcontractor_addition_info.doc_file_id) as doc_file_id',
			'GROUP_CONCAT(ub_subcontractor_addition_info.ub_subcontractor_addition_info_id) as certificate_id','UB_USER.ub_user_id'),
            'join'=> array('builder'=>'Yes','additionalinfo'=>'Yes'),
            'where_clause' => (array('ub_subcontractor_id' => $ub_subcontractor_id))
            ));
			/* Fetch file path */
			$user_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'folderid' => 0,
								  'modulename' => 'user',
								  'moduleid' => $ub_subcontractor_id,
								);
			$result_array = $this->Mod_doc->get_files_for_folder($user_data);
			/* echo "<pre>";print_r($result_array);exit; */
			$find_trade_file_id  = explode(',',$result_data['aaData'][0]['doc_file_id']);
			if(isset($result_array))
			{
			$data['result_array']  = $result_array;
			}
            $data['result_data']  = $result_data['aaData'][0];
			/* Project assigned users code added by chandru */
			$where_builder_str = array('subcontractor_id' => $ub_subcontractor_id );
			$get_builder_user_id = array(
							'select_fields' => array('ub_user_id'),
							'where_clause' => $where_builder_str
							);
			$subcontractor_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
			$subcontractor_user_id = $subcontractor_user_id_details['aaData'][0]['ub_user_id'];
			$assign_builder = $this->Mod_project->get_assigned_role_ids(array(
					'select_fields' => array('GROUP_CONCAT(PROJECTASSIGNED.project_id) as project_details'),
					'where_clause' => (array('PROJECTASSIGNED.role_id' => SUB_CONTRACTOR_ROLE_ID,'PROJECTASSIGNED.assigned_to'=>$subcontractor_user_id))
					));
			if($assign_builder['status'] == TRUE)
			{
				$data['project_assigned_to'] =  $assign_builder['aaData'][0]['project_details'];
			}else{
				$data['project_assigned_to'] = '';
			}
			
             //echo '<pre>';print_r($data['result_data']);exit;
			  $task_data = array(      'flag' => 2,
                                  'builder_id'    => $this->user_session['builder_id'],
                                  'projectid' => 0,
                                  'folderid' => 0,
                                  'modulename' => 'user',
                                  'moduleid' => $ub_subcontractor_id,
                                );
            $result_array = $this->Mod_doc->get_files_for_folder($task_data);
            // echo '<pre>';print_r($result_array);exit;
			
            if(isset($result_array['0']['ub_doc_file_id']) && !empty($result_array['0']['ub_doc_file_id']))
            {
				/* Condition checking for only trad file uploaded */
				if(isset($find_trade_file_id[0]) && $find_trade_file_id[0] != '')
				{
				$trade_file_id = array_column($result_array, 'ub_doc_file_id');
				$new_single_file_name = array_diff($trade_file_id,$find_trade_file_id);
				// $single_file_key =  key($new_single_file_name);
				foreach ($new_single_file_name as $key => $values)
				{
						// echo '<pre>';print_r($result_array[$key]['ui_file_name']);exit;
					if(isset($result_array[$key]['ui_file_name']) && !empty($result_array[$values]['ui_file_name']));
					{
						$data['profile_pic_id'] = $result_array[$key]['ub_doc_file_id'];
						$data['single_file_name']   = $result_array[$key]['ui_file_name'];
						$data['single_system_file_name']   = $result_array[$key]['system_file_name'];
					}
					/* else{
					$data['profile_pic_id'] = '';
					$data['single_file_name'] = '';
					} */
				}
				/* $single_file_keys =  array_keys($new_single_file_name);
				$single_file_key = end($single_file_keys);
				if(isset($single_file_key))
				{ */
                /* $data['profile_pic_id'] = $result_array['0']['ub_doc_file_id'];
                $data['profile_pic'] = $result_array['0']['system_file_name']; */
				
                /* $data['profile_pic_id'] = $result_array[$single_file_key]['ub_doc_file_id'];
                $data['single_file_name'] = $result_array[$single_file_key]['ui_file_name'];
				}else{
					$data['profile_pic_id'] = '';
					$data['single_file_name'] = '';
				} */
				}else{
					$data['profile_pic_id'] = $result_array[0]['ub_doc_file_id'];
					$data['single_file_name'] = $result_array[0]['ui_file_name'];
					$data['single_system_file_name']   = $result_array[0]['system_file_name'];
				}
				/* $single_file_upload = end($result_array);
				$data['single_file_name'] = $single_file_upload['ui_file_name']; */
            }
           }

        }
        else{
		/* Added by Pranab, Below condition will check plan has enough user. */
		 /* start */
		  $builder_id = $this->user_session['builder_id'];
		  $user_limit = $this->Mod_user->check_user_limit_based_plan($builder_id) ;
		  if(FALSE === $user_limit['status'])
			{
				redirect(base_url().'dXNlci9idWlsZgxf1VyX3dhcm5pbmdfcgxf1FnZQ--');
			} 
		 /* end */	
        if(!empty($this->input->post()))
         {
         //Add check list code
         $results = $this->sanitize_input();
		 if(isset($results['data']['project_list']) && !empty($results['data']['project_list']))
		 {
			/* Below line for remove nothing selected */
			$project_list_array = array_filter($results['data']['project_list']);
			if(isset($project_list_array) && !empty($project_list_array))
			{
				$project_implode_array = implode(',',$project_list_array);
				$formated_project_array = ','.$project_implode_array;
			}else{
				$formated_project_array = '';
			}
		 }else{
			$formated_project_array = '';
		 }
		 // echo $this->builder_id;exit;
		 // echo '<pre>';print_r($formated_project_array);exit;
         $subcontractor_department = "";
         if(isset($results['data']['subcontractor_department']))
         {
         $subcontractor_department = "".implode(",", $results['data']['subcontractor_department'])."";
         }
         /* $certificate_name = "".implode(",", $results['data']['certificate_name'])."";
         $reminder_start_date = "".implode(",", $results['data']['reminder_start_date'])."";
         $reminds_in_days = "".implode(",", $results['data']['reminds_in_days'])."";
         $reminder_type = "".implode(",", $results['data']['reminder_type']).""; */
         $certificate_name = "";
         if(isset($results['data']['certificate_name']))
         {
            $certificate_name = $results['data']['certificate_name'];
         }
         $reminder_start_date = "";
         if(isset($results['data']['reminder_start_date']))
         {
            $reminder_start_date = $results['data']['reminder_start_date'];
         }
         $reminder_type = "";
         if(isset($results['data']['reminder_type']))
         {
            $reminder_type = $results['data']['reminder_type'];
         }
         $reminds_in_days = "";
         if(isset($results['data']['reminds_in_days']))
         {
            $reminds_in_days = $results['data']['reminds_in_days'];
         }
         $save_type = $results['data']['save_type'];
         $insert_in_sub_contractor_table = array(
                    'builder_id' => $this->builder_id,
                    'user_id' => $this->user_id,
                    'company' => $results['data']['company'],
                    'division' => $subcontractor_department,
                    'address' => $results['data']['address'],
                    'city' => $results['data']['city'],
                    'province' => $results['data']['province'],
                    'postal' => $results['data']['postal'],
                    'desk_phone' => $results['data']['desk_phone'],
                    'mobile_phone' => $results['data']['mobile_phone'],
                    'mobile_isd_code' => $results['data']['mobile_isd_code'],
                    'fax' => $results['data']['fax'],
                    'access_to_all_projects' => isset($results['data']['access_to_all_projects']) ? "Yes" : "No",
                    'access_to_all_owners' => isset($results['data']['access_to_all_owners']) ? "Yes" : "No",
                    'login_enabled' => isset($results['data']['login_enabled']) ? "Yes" : "No",
                    'username' => $results['data']['user_name'],
                    'password' => $results['data']['password'],
                    'first_name' => $results['data']['first_name'],
                    'primary_email' => $results['data']['primary_email'],
                    'alternative_email' => $results['data']['alternative_email'],
                    'country' => $results['data']['country'],
                    'role_id' => SUB_CONTRACTOR_ROLE_ID,
                    'time_zone' => $results['data']['time_zone'],
                    'date_format' => $results['data']['date_format'],
                    'other_notes' => $results['data']['other_notes'],
                    'hold_payments' => isset($results['data']['hold_payments']) ? "Yes" : "No",
                    'notes' => $results['data']['payment_notes'],
                    'certificate_name' => $certificate_name,
                    'reminder_start_date' => $reminder_start_date,
                    'reminder_type' => $reminder_type,
                    'reminds_in_days' => $reminds_in_days,
                    'accessmethod' => $results['data']['accessmethod']
                    );
                    $responses = $this->Mod_subcontractor->add_in_sub_contractor_table_and_user_table($insert_in_sub_contractor_table);
					/* Insert in project and project access table */
					 if(isset($formated_project_array) && !empty($formated_project_array))
					 {
						$type = 'add';
						$project_responce = $this->Mod_project->add_in_project_and_access_table($formated_project_array,$responses['insert_id'],$type);
					 }
                    //print_r($responses);exit;
                    if($save_type == 'save_and_stay_and_sent_mail')
                    {
                     $results['data']['ub_user_id'] = $responses['insert_id'];
                     $results['data']['name'] = $results['data']['first_name'];
                     $response = $this->Mod_user->user_email_invitation($results['data']);
                    }
                    
                    //$response = $this->Mod_subcontractor->insert_in_subcontracor_additional_info_table(100,$insert_in_sub_contractor_table);
						$this->Mod_subcontractor->response($responses);
        }
        }
        //Get all roles of a builder
        /* $role_list = $this->Mod_role->get_roles(array(
                    'select_fields' => array('ROLE.ub_role_id','ROLE.role_name'),
                    'where_clause' => (array('ROLE.builder_id' =>  $this->user_session['builder_id']))
                    ));
        $role_list['aaData'] = array_merge( $role_list['aaData'], array(array('ub_role_id'=> '4','role_name'=>'Project Manager')));


        $data['role_list']=array();
        if(TRUE === $role_list['status'])
        {
            $data['role_list'] = $this->Mod_role->build_ci_dropdown_array($role_list['aaData'],'ub_role_id', 'role_name');

        } */
			/* Fetch all project */
			//Get all projects of a builder
	    $project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => (array('PROJECT.builder_id' =>  $this->user_session['builder_id']))
					));
	    $data['project_list']=array();
	    if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_project->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		}else{
			$data['project_list'] = '';
		}
		// echo '<pre>';print_r($data['project_list']);exit;
        //Get date_format from general value table
        $args = array('classification'=>'user_date_format', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
        $result = $this->Mod_general_value->get_general_value($args);
        $data['user_date_format_array'] = $result['values'];
        //Get the timezone
        $timezone = $this->Mod_timezone->get_timezone();
        $data['time_zone'] = $this->Mod_timezone->build_ci_dropdown_array($timezone, 'diff_from_GMT', 'zone');
        $this->template->view($data);
    }

    /**
    * Delete sub_contractor
    *
    * @method: delete_sub_contractor
    * @access: public
    * @param:  ajax post array
    * @return: array
    * @createdby: chandru
    */
    public function delete_sub_contractor()
    {

        $result = $this->sanitize_input();
        //echo '<pre>';print_r($result);exit;
            if(TRUE === $result['status'])
            {
                $response = $this->Mod_subcontractor->delete_sub_contractor($result['data']);
                $respoce_array = $this->get_sub_contractor($page_count = 'result_array');
                //echo '<pre>';print_r($respoce_array);exit;
                if($respoce_array['status'] == FALSE)
                {
                  if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && $this->uni_session_get('SEARCH')['iDisplayStart'] > 0)
                  {
                    $search_session_array['iDisplayStart'] = (($this->uni_session_get('SEARCH')['iDisplayStart']) - ($this->uni_session_get('SEARCH')['iDisplayLength']));
                        $search_session_array['iDisplayLength'] = $this->uni_session_get('SEARCH')['iDisplayLength'];
                        $this->uni_set_session('search', $search_session_array);
                  }
                }
            }
            else
            {
                $this->Mod_subcontractor->response($result);
            }
            $a = $this->Mod_subcontractor->response($response);
            echo '<pre>';print_r($a);exit;
    }

    /**
    * Destroy Session
    *
    * @method: destroy_session
    * @access: public
    * @param:  ajax post array
    * @return: array
    * @createdby: chandru
    */
    public function destroy_session()
    {
        if(!empty($this->input->post()))
        {
            // Sanitize input
            $result = $this->sanitize_input();
            if(TRUE === $result['status'])
            {
                $result = $this->Mod_subcontractor->destroy_session($result['data']);
            }
            $this->Mod_subcontractor->response($result);
        }
        else
        {
            $response['status'] = FALSE;
            $response['message'] = 'Delete Failed: Post array is empty';
        }
    }

    /**
    * Apply Saved Search
    *
    * @method: apply_saved_search
    * @access: public
    * @params:
    * @return: array
    * @created by: chandru
    * @created on: 03/04/2015
    * url encoded : cm9sZXMvZ2V0X3NhdmVkX3NlYXJjaC8-
    */
    public function apply_saved_search()
    {
        /* Apply Filter code starts here */
           $post_array = array( 'builder_id' => $this->user_session['builder_id'],
                             'user_id' => $this->user_session['ub_user_id'],
                             'module_name' => $this->module
         );
         $result_data = $this->Mod_saved_search->get_saved_search(array(
                                                 'select_fields' => array(),
                                                 'where_clause' => $post_array
                                                 ));
        if(!empty($this->input->post()))
        {
            if($result_data['status'] == true)
            {
                $save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
                $task_array = $this->input->post();
                $post_array = array(
                    'ub_saved_search_id' => $save_search_id,
                    'search_params' => "'".serialize($task_array)."'"
                );
                $response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
            }else{
                $task_array = $this->input->post();
                $post_array = array(
                    'search_params' => "'".serialize($task_array)."'"
                );
                $response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
                }
        }else{
         $serialized_data = $result_data['aaData'][0]['search_params'];
         $remove_single_quote = str_replace("'", '', $serialized_data);
         $unserialized_data = unserialize($remove_single_quote);
        $result_data['aaData'][0]['search_params'] = $unserialized_data;
             if(!empty($unserialized_data))
             {
                if(!empty($unserialized_data['company']))
                {
                        $search_session_array['company'] =$unserialized_data['company'];
                }
            //$this->session->set_userdata('ACCOUNT', $this->account_session);
            $this->uni_set_session('search', $search_session_array);
            $this->Mod_subcontractor->response($result_data);
            }
        }
    /* Apply Filter code Ends here */
    }

    /**
    * builderuser_email_invitation method to send mail to builderuser
    *
    * @method: builderuser_email_invitation
    * @access: public
    * @params:
    * @return: array
    * @created by: chandru
    * @created on: 20/04/2015
    */
    public function sub_contractor_user_email_invitation()
    {
        //sanitize_input will Clean the data transferred to the sever before submitting to model
        $post_array = $this->sanitize_input();
        if(TRUE === $post_array['status'])
        {
            $response = $this->Mod_subcontractor->sub_contractor_user_email_invitation($post_array['data']);
        }
        else
        {
            $response['status'] = $post_array['status'];
            $response['message'] = $post_array['message'];
        }
        $this->Mod_subcontractor->response($response);
    }
    /**
    * Get all projects of a user
    *
    * @method: get_all_projects_user_involved
    * @access: public
    * @param:  ajax post array
    * @return: array
    * @url: bgxf19ncy9pbmRleC8-
    */
    public function get_all_projects_user_involved()
    {
        // Get list of project the user involved
        $result = $this->sanitize_input();
        $post_array[] = array(
                            'field_name' => 'PROJECT_ASSIGNED_USERS.assigned_to',
                            'value'=> $result['data']['ub_subcontractor_id'],
                            'type' => '='
                            );
         $where_str = $this->Mod_user->build_where($post_array);
            // Pagination argument
                $pagination_array = array();
                if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
                {
                    $pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
                }
                // Order by clause argument
                $order_by_where = '';
                if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
                {
                    $sort_type = $result['data']['sSortDir_0'];
                    $sort_filed_column_id = $result['data']['iSortCol_0'];
                    $dt_filed_name = 'mDataProp_';
                    $order_by_where = 'PROJECT.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
                }
                // Fetch argument building
				$date_array = array('PROJECT.projected_start_date'=>'');
				$projected_start_date_array = $this->Mod_user->format_user_datetime($date_array,"date");
				$new_date_array = "IF(PROJECT.projected_start_date = '0000-00-00', '-',".$projected_start_date_array.") AS projected_start_date";
				
                $project_args = array('select_fields' => array('PROJECT.project_name','PROJECT.project_group','PROJECT.project_status','ROLE.role_name,'.$new_date_array),
                'join'=> array('project'=>'Yes','user'=>'Yes','role'=>'Yes'),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                );
                // Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
                $project_data = $this->Mod_subcontractor->get_all_projects_user_involved($project_args);
                if($project_data['status'] == FALSE)
                {
                    $project_data = array();
                    $project_data['aaData'] = array();
                }
                else
                {
                    // Get number of records
                    $total_count_array = $this->Mod_subcontractor->get_all_projects_user_involved(array(
                                                'select_fields' => array('COUNT(PROJECT_ASSIGNED_USERS.project_id) AS total_count'),
                                                'where_clause' => $where_str));
                    $project_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
                    $project_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
                    $project_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
                }
$this->Mod_subcontractor->response($project_data);

    }

}
/* End of file subcontractor.php */
/* Location: ./application/controllers/subcontractor.php */