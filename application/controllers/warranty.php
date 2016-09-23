<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Warranty Class
 * 
 * @package: Warranty
 * @subpackage: Warranty
 * @category: Warranty
 * @author: Sidhartha
 * @createdon(DD-MM-YYYY): 24-04-2015 
*/
class Warranty extends UNI_Controller {
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_warranty','Mod_general_value','Mod_timezone','Mod_user','Mod_subcontractor','Mod_saved_search','Mod_project','Mod_comment','Mod_notification','Mod_builder','Mod_doc','Mod_custom_settings'));
    }
	public function index()
	{
		
		$data = array(
		'title'        => "WARRANTY",		
		'content'      => 'content/warranty/warranty',
        'page_id'      => 'warranty',
		'data_table'   =>'data_table',
		'warranty_list'	   =>'warranty_list',
        'search_session_array' => $this->uni_session_get('SEARCH'),		
		'date_all'	   =>'date_all'      
		);
        
		//Get all projects of a builder
	    $user_list = $this->Mod_user->get_builder_users(array(
					'select_fields' => array('USER.ub_user_id','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name'),
					'where_clause' => (array('USER.builder_id' =>  $this->user_session['builder_id'],'USER.account_type'=> BUILDERADMIN))
					));
	    $data['user_list']=array();
	    if(TRUE === $user_list['status'])
		{
			$data['user_list'] = $this->Mod_user->build_ci_dropdown_array($user_list['aaData'],'ub_user_id', 'first_name');
		}
		$args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
		 unset($args[OWNER]);
		 $data['subcontractor_list'] = $this->Mod_user->get_users_by_type($args,'multiple'); 

		//Get category from general value table
		$category_args = array('classification'=>'warranty_category', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$category_result = $this->Mod_general_value->get_general_value($category_args);
		$data['category_array'] = $category_result['values'];

		//Get status from general value table
		$status_args =array('classification'=>'warranty_status', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown'); 
		$status_result = $this->Mod_general_value->get_general_value($status_args);
		 
		$data['status_array'] = $status_result['values'];

		//Get priority dropdown value from general value table
		$priority_args = array('classification'=>'warranty_priority', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$priority_result = $this->Mod_general_value->get_general_value($priority_args);
		$data['priority_array'] = $priority_result['values'];
         
		//Get classification dropdown value from general value table
		$classification_args = array('classification'=>'warranty_classification', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$classification_result = $this->Mod_general_value->get_general_value($classification_args);
		// echo "<pre>";print_r($classification_result);exit;
		$data['classification_array'] = $classification_result['values'];

		//Get feedback dropdown value from general value table
		$feedback_args = array('classification'=>'warranty_feedback', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$feedback_result = $this->Mod_general_value->get_general_value($feedback_args);
		$data['feedback_array'] = $feedback_result['values'];
		
        //Apply filter code
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
		}
		else
		{
	
		$apply_filter = false;;
		}
		
		$data['apply_filter'] = $apply_filter;
		// Project allowance check code added by chandru 
		$data['owner_add_claims'] = FALSE;
		if (!empty($this->project_id)) 
		{
			$ub_project_id = $this->project_id;
             $owner_add_claims = $this->Mod_project->get_projects(array(
            'select_fields' => array('PROJECT.owner_add_claims'),
            'where_clause' => (array('ub_project_id' => $ub_project_id))
            ));
            if(TRUE === $owner_add_claims['status'])
            {
				if($owner_add_claims['aaData'][0]['owner_add_claims'] == 'Yes')
				{
					$data['owner_add_claims'] = TRUE;
				}else{
					$data['owner_add_claims'] = FALSE;
				}
            } else{
				$data['owner_add_claims'] = FALSE;
			}
			$input_array[] = array(
												'field_name' => 'ub_project_id',
												'value'=> $ub_project_id, 
												'type' => '='
												);			
			$where = $this->Mod_project->build_where($input_array);
			$warranty_claims_period = $this->Mod_project->get_projects(array(
            'select_fields' => array('PROJECT.warranty_claims_period','signoff_date'),
			'where_clause' => $where." AND signoff_status != ''"
            ));
			if(TRUE == $warranty_claims_period['status'])
			{
				$date_interval = $warranty_claims_period['aaData'][0]['warranty_claims_period'] * 30;
				$date = $warranty_claims_period['aaData'][0]['signoff_date'];
				$date = strtotime($date);
				$date = strtotime("+".$date_interval."day", $date);
				$warrenty_max_period = date('Y-m-d H:i:s', $date);
				$warranty_claims_period = $warranty_claims_period['aaData'][0]['warranty_claims_period'];
				$current_date = TODAY;
				if($current_date <= $warrenty_max_period)
				{
					$data['warranty_max_claims_period'] = TRUE;
				}else{
					$data['warranty_max_claims_period'] = FALSE;
				}
			}else{
				$data['warranty_max_claims_period'] = TRUE;
			}
		}else{
			$data['warranty_max_claims_period'] = TRUE;
		}
		$this->template->view($data);
		}
	/** 
	* Save/Update warranty
	* @author: Sidhartha
	* @method: save_warranty 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: d2FycmFudHkvc2F2ZV93YXJyYW50eS8-
	*/		
	public function save_warranty($ub_warranty_claim_id = 0)
	{
		$this->encrypt_key = 'XYZ!@#$%';
		$result_data = array();
		$post_data = array();
		$data = array(
		'title'       		  => "WARRANTY",		
		'content'      		  => 'content/warranty/save_warranty',
		'page_id'      		  => 'warranty',
		'data_table'          => 'data_table',
		'user_jobs_site_view' => 'user_jobs_site_view'
		);
		//get project id from task table // by satheesh kumar
		if(empty($this->project_id) && $ub_warranty_claim_id > 0)
		{
		$where_args = array('ub_warranty_claim_id' => $ub_warranty_claim_id);
		$project_id = $this->Mod_project->get_project_id(UB_WARRANTY_CLAIM,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		//end code for get project id
		if (!empty($this->project_id)) 
		{
			$input_array[] = array(
								'field_name' => 'ub_project_id',
								'value'=> $this->project_id, 
								'type' => '='
								);			
			$where = $this->Mod_project->build_where($input_array);
			$warranty_claims_period = $this->Mod_project->get_projects(array(
            'select_fields' => array('PROJECT.warranty_claims_period','signoff_date'),
			'where_clause' => $where." AND signoff_status != ''"
            ));
			if(TRUE == $warranty_claims_period['status'])
			{
				$date_interval = $warranty_claims_period['aaData'][0]['warranty_claims_period'] * 30;
				$date = $warranty_claims_period['aaData'][0]['signoff_date'];
				$date = strtotime($date);
				$date = strtotime("+".$date_interval."day", $date);
				$warrenty_max_period = date('Y-m-d H:i:s', $date);
				$warranty_claims_period = $warranty_claims_period['aaData'][0]['warranty_claims_period'];
				$current_date = TODAY;
				if($current_date <= $warrenty_max_period)
				{
					$data['warranty_max_claims_period'] = TRUE;
				}else{
					$data['warranty_max_claims_period'] = FALSE;
				}
			}else{
				$data['warranty_max_claims_period'] = TRUE;
			}
		}else{
			$data['warranty_max_claims_period'] = TRUE;
		}
		
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
		{
				$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
		}

		$dir_response = $this->Mod_doc->create_default_dir();
		
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
		  $data['temprory_dir_id'] = '1';	
		}
		// Block to fetch custom fields.

		$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>WARRANTY_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE);
		$sort_type = 'ASC';
		$order_by_where = 'CUSTOM_FIELD.display_order'.' '.$sort_type;
			$custom_field_data = $this->Mod_custom_settings->get_custom_fields(array(
													'select_fields' => array('CUSTOM_FIELD.ub_custom_field_id','CUSTOM_FIELD.data_type','CUSTOM_FIELD.label_name','CUSTOM_FIELD.field_values','CUSTOM_FIELD.tooltip','CUSTOM_FIELD.mandatory','CUSTOM_FIELD.include_in_filter','CUSTOM_FIELD.display_order'),
													'where_clause' => $post_array,
													'order_clause' => $order_by_where
													));
			//echo "<pre>"; print_r($custom_field_data); exit;
			if(isset($custom_field_data['aaData']) && !empty($custom_field_data['aaData']))
			{
				$data['custom_field_data'] = $custom_field_data['aaData'];
			}

		//custom fields from custom table
			

			 $args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
			 $all_type_users = $this->Mod_user->get_users_by_type($args,'multiple');
			 //OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), add this to get owner
			//echo "<pre>".$this->project_id; print_r($all_type_users); exit;
			$data['get_all_users'] = $all_type_users;

			$sub_args = array(SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
			 $all_sub_users = $this->Mod_user->get_users_by_type($sub_args,'multiple');
			 $data['get_all_sub_users'] = $all_sub_users;

			$bu_args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN));
			 $all_bu_users = $this->Mod_user->get_users_by_type($bu_args,'multiple');
			 $data['get_all_bu_users'] = $all_bu_users;
		//Codition check wheather the ub_warranty_claim_id value is greater than 0 or not
		if($ub_warranty_claim_id > 0 || null!==$this->input->post('ub_warranty_claim_id') && $this->ci_decrypt($this->input->post('ub_warranty_claim_id'), $this->encrypt_key) > 0)
		{
			$this->ub_warranty_claim_id = (null!=$this->input->post('ub_warranty_claim_id')) ? $this->ci_decrypt($this->input->post('ub_warranty_claim_id'), $this->encrypt_key) : $ub_warranty_claim_id;
			$task_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->ub_warranty_claim_id,
								);
			//echo "<pre>";print_r($task_data);exit;
			$result_array = $this->Mod_doc->get_files_for_folder($task_data);

			

			$count = count($result_array);

			$session_id = $this->session->userdata('session_id');
			
			for ($i=0; $i < $count ; $i++)
			{
				if(isset($result_array[$i]['system_file_name']) && !empty($result_array[$i]['system_file_name']))
				{
					$exp = explode('/', DOC_PATH.$result_array[$i]['system_file_name']);

					$thumb_array = array(
											'source_image' => DOC_PATH.$result_array[$i]['system_file_name'],
											'new_image' => DOC_TEMP_PATH.$session_id.'/'.$dir_response['thumbnail_path'].'/'.$exp[count($exp)-1]
									);
					$this->create_thumb($thumb_array);
					
					//$image_path = $result_array[$i]['system_file_name'];
					copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);
				}

			}
			
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  $result = $this->sanitize_input();
			  if(TRUE === $result['status'])
			  {
			  	$result['data']['ub_warranty_claim_id'] = $this->ci_decrypt($result['data']['ub_warranty_claim_id'], $this->encrypt_key);
			  	
			  	if(isset($result['data']['category']) && $result['data']['category'] !== null && $result['data']['category']!='Nothing selected')
				{
					$result['data']['category'] = "".implode(",", $result['data']['category'])."";
				}
				else
				{
					$result['data']['category'] = "";
				}
				if(isset($result['data']['follow_up_date']) && $result['data']['follow_up_date'] !== '')
				{
					$result['data']['follow_up_date'] = date("Y-m-d", strtotime($result['data']['follow_up_date']));
				}
				if(isset($result['data']['priority']) && $result['data']['priority'] !== null && $result['data']['priority']!='Nothing selected')
				{
					$result['data']['priority'] =$result['data']['priority'];
				}
				else
				{
					$result['data']['priority'] = "";
				}
				if(isset($result['data']['service_coordinator_id']) && $result['data']['service_coordinator_id'] !== null && $result['data']['service_coordinator_id']!='Nothing selected')
				{
					$result['data']['service_coordinator_id'] = $result['data']['service_coordinator_id'];
				}
				else
				{
					$result['data']['service_coordinator_id'] = "";
				}
				if(isset($result['data']['classification']) && $result['data']['classification'] !== null && $result['data']['classification']!='Nothing selected')
				{
					$result['data']['classification'] = $result['data']['classification'];
				}
				else
				{
					$result['data']['classification'] = "";
				}
				if(isset($result['data']['original_subcontractor_id']) && $result['data']['original_subcontractor_id'] !== null && $result['data']['original_subcontractor_id']!='Nothing selected')
				{
					$result['data']['original_subcontractor_id'] = $result['data']['original_subcontractor_id'];
				}
				else
				{
					$result['data']['original_subcontractor_id'] = "";
				}
			  	$warranty_update_array = array(
			  	'ub_warranty_claim_id' => $result['data']['ub_warranty_claim_id'],
			  	'project_id' => $result['data']['project_id'],
			  	'title' => $result['data']['title'],
			  	'priority' => $result['data']['priority'],
			  	'category' => $result['data']['category'],
			  	'problem_description' => $result['data']['problem_description'],
			  	'internal_comments' => isset($result['data']['internal_comments'])?$result['data']['internal_comments']:'',
			  	'service_coordinator_id' => $result['data']['service_coordinator_id'],
			  	'original_subcontractor_id' => $result['data']['original_subcontractor_id'],
			  	'classification' => $result['data']['classification'],
			  	'show_owner' => isset($result['data']['show_owner']) ? "Yes" : "No",		
	            'added_cost' => $result['data']['added_cost'],
	            'follow_up_date' => $result['data']['follow_up_date'],
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				if($result['data']['follow_up_date'] == '')
				{
					unset($warranty_update_array['follow_up_date']);
				}
				//print_r($warranty_update_array);exit;
				$response = $this->Mod_warranty->update_warranty($warranty_update_array);
				$result['data']['module_id'] = $result['data']['ub_warranty_claim_id'];
				$result['data']['module_name'] = 'warranty';
				$result['data']['classification'] = WARRANTY_CUSTOM_FIELDS;
				$result['data']['status'] = FIELD_ACTIVE;
			    $this->Mod_custom_settings->format_custom_filed_and_insert($result['data']);
				$this->Mod_warranty->response($response);
			  }
			 }
			else
			{

			//Get all comments list from ub_daily_log_comments table with the builder_id
			$datetime_array = array('COMMENT.created_on'=>'comment_created_on');
			$other_comment_where = '';
			$comment_post_array[] = array(
								'field_name' => 'COMMENT.module_pk_id',
								'value'=> $ub_warranty_claim_id, 
								'type' => '='
							);
			$comment_post_array[] = array(
								'field_name' => 'COMMENT.module_name',
								'value'=> $this->module, 
								'type' => '='
							);
			if($this->user_account_type == OWNER)
			{
				
				$other_comment_where = ' AND (COMMENT.created_by = '.$this->user_id.' || COMMENT.show_owner = "Yes" ) ';
			}
			if($this->user_account_type == SUBCONTRACTOR)
			{
			
				$other_comment_where = ' AND (COMMENT.created_by = '.$this->user_id.' || COMMENT.show_sub = "Yes" ) ';
			}
			$where_str = $this->Mod_warranty->build_where($comment_post_array);
            if($other_comment_where != '')
			{
				$where_str = $where_str.$other_comment_where;
			}
			$comments_list = $this->Mod_comment->get_comment(array(
									'select_fields' => array('USER.account_type','COMMENT.comments','COMMENT.created_by','USER.first_name','COMMENT.show_owner','COMMENT.show_sub','COMMENT.created_on','COMMENT.ub_comments_id,'.$this->Mod_user->format_user_datetime($datetime_array)),
									'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes','warranty'=>'Yes'),
									'where_clause' => $where_str,
									'order_clause' => 'COMMENT.ub_comments_id desc'
													));
			if(isset($comments_list['aaData']))
			{
				$data['comments_list'] = $comments_list['aaData'];
			}else{
			$data['comments_list'] = false;
			}	
			$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>WARRANTY_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE,'CUSTOM_FIELD_VALUES.table_id' => $ub_warranty_claim_id);
			
			$custom_field_value = $this->Mod_custom_settings->get_custom_fields(array(
													'select_fields' => array('CUSTOM_FIELD_VALUES.field_values AS field_data','CUSTOM_FIELD_VALUES.custom_field_id'),
													'join'=> array('custom_field_value'=>'yes'),
													'where_clause' => $post_array,
													));
			//echo "<pre>"; print_r($custom_field_data); exit;
			if(isset($custom_field_value['aaData']) && !empty($custom_field_value['aaData']))
			{
				$data['custom_field_value'] = $custom_field_value['aaData'];
			} 
			// Get inserted data with help of id
			 $result_data = $this->Mod_warranty->get_warranty(array(
			'select_fields' => array('WARRANTY.ub_warranty_claim_id', 'WARRANTY.builder_id','WARRANTY.title','WARRANTY.priority','WARRANTY.category','WARRANTY.created_on','WARRANTY.follow_up_date','WARRANTY.classification','WARRANTY.project_id','WARRANTY.problem_description','WARRANTY.internal_comments','WARRANTY.service_coordinator_id','WARRANTY.original_subcontractor_id','WARRANTY.show_owner','WARRANTY.added_cost','PROJECT.project_name','max(WARRANTY_APPOINTMENT.ub_warranty_claim_appointments_id) AS ub_warranty_claim_appointments_id','USER.account_type'),
			'join'=> array('user'=>'Yes','project'=>'Yes','warranty_appointment'=>'Yes',),
			'order_clause' => 'WARRANTY_APPOINTMENT.ub_warranty_claim_appointments_id desc',
			'group_clause' => array("WARRANTY.ub_warranty_claim_id"), 
			'where_clause' => (array('ub_warranty_claim_id' =>  $ub_warranty_claim_id))
			));
			
			if(TRUE === $result_data['status'])
			{
				$data['warranty_data']  = $result_data['aaData'][0];
			}
			$ub_warranty_claim_appointments_id = $result_data['aaData'][0]['ub_warranty_claim_appointments_id'];
			$datetime_array = array('WARRANTY_APPOINTMENT.owner_preferred_datetime'=>'owner_preferred_datetime','WARRANTY_APPOINTMENT.sub_preferred_datetime'=>'sub_preferred_datetime');
			$appoinment_args = $this->Mod_warranty->get_appoinment(array(
			'select_fields' => array('USER.account_type','CONCAT_WS(" ",USER.first_name,USER.last_name) AS subcontractor_name','WARRANTY_APPOINTMENT.subcontractor_id','WARRANTY_APPOINTMENT.appoinment_link_to','max(WARRANTY_APPOINTMENT.service_date) AS service_date','WARRANTY_APPOINTMENT.service_from_time','WARRANTY_APPOINTMENT.service_to_time','WARRANTY_APPOINTMENT.subcontractor_notes','WARRANTY_APPOINTMENT.builder_user_notes','WARRANTY_APPOINTMENT.sub_accept_appoinment','WARRANTY_APPOINTMENT.owner_accept_appoinment','WARRANTY_APPOINTMENT.completion_date','WARRANTY_APPOINTMENT.approval_comments','WARRANTY_APPOINTMENT.status','WARRANTY_APPOINTMENT.override_by_builder,'.$this->Mod_user->format_user_datetime($datetime_array)),
			'join'=> array('user'=>'Yes'),
			'where_clause' => (array('ub_warranty_claim_appointments_id' =>  $ub_warranty_claim_appointments_id))
			));
			if(TRUE === $appoinment_args['status'])
			{
				/* Below code was added by sidhartha */
				if($appoinment_args['aaData'][0]['completion_date'] == '0000-00-00')
				{
					unset($appoinment_args['aaData'][0]['completion_date']);
				}
				if($appoinment_args['aaData'][0]['service_from_time'] == '00:00:00')
				{
					unset($appoinment_args['aaData'][0]['service_from_time']);
				}
				if($appoinment_args['aaData'][0]['service_to_time'] == '00:00:00')
				{
					unset($appoinment_args['aaData'][0]['service_to_time']);
				}
				$data['appoinment_data']  = $appoinment_args['aaData'][0];
			}

			$ub_project_id = $result_data['aaData'][0]['project_id'];
			
			$user_list = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$ub_project_id, 'account_type' => BUILDERADMIN, 'assigned_type' => 'yes', 'dropdown_type' => ''));
			
			$service_coordinator_list =array();
			if(TRUE === $user_list['status'])
			{
				$service_coordinator_list = $this->Mod_warranty->build_ci_dropdown_array($user_list['aaData'],'ub_user_id', 'full_name');
			}
		
			$data['service_coordinator_list']=  $service_coordinator_list;

			$subcontractor_lists = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$ub_project_id, 'account_type' => 'all', 'assigned_type' => 'yes', 'dropdown_type' => 'optgroup'));

			unset($subcontractor_lists['Owner']);
			$data['subcontractor_list']=  $subcontractor_lists;
			
			$servicing_sub_lists = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$ub_project_id, 'account_type' => 'all', 'assigned_type' => 'yes', 'dropdown_type' => 'optgroup'));
			unset($servicing_sub_lists['Owner']);
			$nothing_selected_array = array(''=>'Nothing Selected');
			$data['servicing_sub_list']=  $nothing_selected_array + $servicing_sub_lists;
			
			
		   }
		 
	    }
	    // Here ub_user_id value is 0. So It will enter to Insert function
		else
		{
		  if(!empty($this->input->post()))
		  {
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				if(isset($result['data']['category']) && $result['data']['category'] !== null && $result['data']['category']!='Nothing selected')
				{
					$result['data']['category'] = "".implode(",", $result['data']['category'])."";
				}
				else
				{
					$result['data']['category'] = "";
				}
				if(isset($result['data']['priority']) && $result['data']['priority'] !== null && $result['data']['priority']!='Nothing selected')
				{
					$result['data']['priority'] = $result['data']['priority'];
				}
				else
				{
					$result['data']['priority'] = "";
				}
				$warranty_insert_array = array(
			  	'ub_warranty_claim_id' => $result['data']['ub_warranty_claim_id'],
			  	'project_id' => $result['data']['project_id'],
			  	'title' => $result['data']['title'],
			  	'priority' => $result['data']['priority'],
			  	'category' => $result['data']['category'],
			  	'problem_description' => $result['data']['problem_description'],
			  	'internal_comments' => isset($result['data']['internal_comments'])?$result['data']['internal_comments']:'',
	            'builder_id' => $this->user_session['builder_id'],
	            'status' => 'New',
	            'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY);
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				// insert the record
				$response = $this->Mod_warranty->add_warranty($warranty_insert_array);
				$result['data']['module_id'] = $response['insert_id'];
				$result['data']['module_name'] = 'warranty';
				$result['data']['classification'] = WARRANTY_CUSTOM_FIELDS;
				$result['data']['status'] = FIELD_ACTIVE;
			    $this->Mod_custom_settings->format_custom_filed_and_insert($result['data']);
				//echo "<pre>asdfasdfasfd"; print_r($response);exit;
			    $this->Mod_warranty->response($response);
			}
			else
			{
				$this->Mod_warranty->response($result);
			}
		  }
	    }
		//Get all projects of a builder
	    $project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => (array('PROJECT.builder_id' =>  $this->user_session['builder_id']))
					));
	    $data['project_list']=array();
	    if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_project->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		}
		//Get category from general value table
		$category_args = array('classification'=>'warranty_category', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$category_result = $this->Mod_general_value->get_general_value($category_args);
		$data['category_array'] = $category_result['values'];

		//Get priority dropdown value from general value table
		$priority_args = array('classification'=>'warranty_priority', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$priority_result = $this->Mod_general_value->get_general_value($priority_args);
		$data['priority_array'] = $priority_result['values'];

		//Get classification dropdown value from general value table
		$classification_args = array('classification'=>'warranty_classification', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$classification_result = $this->Mod_general_value->get_general_value($classification_args);
		$data['classification_array'] = $classification_result['values'];

		//Get feedback dropdown value from general value table
		$feedback_args = array('classification'=>'warranty_feedback', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$feedback_result = $this->Mod_general_value->get_general_value($feedback_args);
		$data['feedback_array'] = $feedback_result['values'];

		$this->template->view($data);
	}
	/** 
	* Delete warranty
	* 
	* @method: delete_log 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: bgxf19ncy9kZWxldgxf1Vfbgxf19nLw--
	*/
	public function delete_warranty()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_warranty->delete_warranty($result['data']);

				$respoce_array = $this->get_warranty($page_count = 'result_array');
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
				//$search_session_array['iDisplayStart'] = 0;
				//$this->uni_set_session('search', $search_session_array);
			}
			else
			{
				$this->Mod_warranty->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_warranty->response($response);
	}
	/** 
	* Save/Update warranty appoinment
	* @author: Sidhartha
	* @method: save_warranty_appoinment 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: 
	*/		
	public function save_warranty_appoinment($ub_warranty_claim_appointments_id = 0)
	{
		//echo '<pre>';print_r($_POST);exit;
		$this->encrypt_key = 'XYZ!@#$%';
		$result_data = array();
		$post_data = array();
		
		//Codition check wheather the ub_daily_log_id value is greater than 0 or not
	    if(!empty($this->input->post()))
		{
		  //Sanitize input
		  $result = $this->sanitize_input();
		  //print_r($result);exit;
		  if(TRUE === $result['status'])
		  {
		    if($ub_warranty_claim_appointments_id > 0 || null!==$this->input->post('ub_warranty_claim_appointments_id') && $this->input->post('ub_warranty_claim_appointments_id') > 0)
	        {
			  $result['data']['ub_warranty_claim_id'] = $this->ci_decrypt($result['data']['ub_warranty_claim_id'], $this->encrypt_key);
			  if(isset($result['data']['service_date']) && $result['data']['service_date'] != '')
			  {
					$result['data']['service_date'] = date("Y-m-d", strtotime($result['data']['service_date']));
			  }
			  if(isset($result['data']['completion_date']) && $result['data']['completion_date'] != '')
			  {
				$result['data']['completion_date'] = date("Y-m-d", strtotime($result['data']['completion_date']));
			  }
			  if(isset($result['data']['service_from_time']) && $result['data']['service_from_time'] != '')
			  {
				$result['data']['service_from_time'] = date('H:i:s', strtotime($result['data']['service_from_time']));
			  }
			  if(isset($result['data']['service_to_time']) && $result['data']['service_to_time'] != '')
			  {
				$result['data']['service_to_time'] = date('H:i:s', strtotime($result['data']['service_to_time']));
			  }
			  if(isset($result['data']['subcontractor_id']) && $result['data']['subcontractor_id'] !== null && $result['data']['subcontractor_id']!='Nothing selected')
			  {
				$result['data']['subcontractor_id'] = $result['data']['subcontractor_id'];
			  }
			  else
			  {
				$result['data']['subcontractor_id'] = "";
			  }
			  if(isset($result['data']['status']) && $result['data']['status'] !== null && $result['data']['status']!='Nothing selected')
			  {
				$result['data']['status'] = $result['data']['status'];
			  }
			  else
			  {
				$result['data']['status'] = "";
			  }
			  //print_r($result);
			  $warranty_appointment_update_array = array(
				'ub_warranty_claim_appointments_id' => $result['data']['ub_warranty_claim_appointments_id'],
				'builder_id' => $this->user_session['builder_id'],
				'warranty_claim_id' => $result['data']['ub_warranty_claim_id'],
				'subcontractor_id' => $result['data']['subcontractor_id'],
				'service_date' => isset($result['data']['service_date'])?$result['data']['service_date']:'',
				'service_from_time' => isset($result['data']['service_from_time'])?$result['data']['service_from_time']:'',
				'service_to_time' => isset($result['data']['service_to_time'])?$result['data']['service_to_time']:'',
				'subcontractor_notes' => isset($result['data']['subcontractor_notes'])?$result['data']['subcontractor_notes']:'',
				'builder_user_notes' => isset($result['data']['builder_user_notes'])?$result['data']['builder_user_notes']:'',
				'sub_accept_appoinment' => isset($result['data']['sub_accept_appoinment']) ? "Acceptance Pending" : "Not Required",
				'owner_accept_appoinment' => isset($result['data']['owner_accept_appoinment']) ? "Acceptance Pending" : "Not Required",
				'completion_date' => isset($result['data']['completion_date'])?$result['data']['completion_date']:'',
				'approval_comments' => isset($result['data']['approval_comments'])?$result['data']['approval_comments']:'',
				'status' => isset($result['data']['status'])?$result['data']['status']:'',
				'override_by_builder' => isset($result['data']['override_by_builder'])?'Yes':'No',
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
				//print_r($warranty_appointment_update_array);exit;
			 if(isset($result['data']['save_type']))
			 {
				unset($result['data']['save_type']);
			 }
			 if(isset($result['data']['service_date']) && $result['data']['service_date'] == '')
			 {
				unset($warranty_appointment_update_array['service_date']);
			 }
			 if(isset($result['data']['completion_date']) && $result['data']['completion_date'] == '')
			 {
				unset($warranty_appointment_update_array['completion_date']);
			 }
			 if(isset($result['data']['service_from_time']) && $result['data']['service_from_time'] == '')
			 {
				unset($warranty_appointment_update_array['service_from_time']);
			 }
			 if(isset($result['data']['service_to_time']) && $result['data']['service_to_time'] == '')
			 {
			    unset($warranty_appointment_update_array['service_to_time']);
			 }

			 //print_r($result['data']);
			 if($this->user_account_type == BUILDERADMIN){
			 if($result['data']['sub_accept'] == 'Accepted')
			 {
			    $warranty_appointment_update_array['sub_accept_appoinment'] = 'Accepted';
			 }
			 else if($result['data']['sub_accept'] == 'Reschedule')
			 {
			 	$warranty_appointment_update_array['sub_accept_appoinment'] = 'Reschedule';
			 }
			 if($result['data']['owner_accept'] == 'Accepted')
			 {
			    $warranty_appointment_update_array['owner_accept_appoinment'] = 'Accepted';
			 }
			 else if($result['data']['owner_accept'] == 'Reschedule')
			 {
			 	$warranty_appointment_update_array['owner_accept_appoinment'] = 'Reschedule';
			 }
			 $warranty_appointment_update_array['sub_appoinment'] = isset($result['data']['sub_accept_appoinment']) ? "Acceptance Pending" : "Not Required";

			 $warranty_appointment_update_array['owner_appoinment'] = isset($result['data']['owner_accept_appoinment']) ? "Acceptance Pending" : "Not Required";
			 }
			 if($this->user_account_type == SUBCONTRACTOR || $this->user_account_type == OWNER){ 

			 $appoinment_status = isset($result['data']['appoinment_status'])?$result['data']['appoinment_status']:'';
			 if(isset($result['data']['prefered_date']))
			 {
			 	$result['data']['prefered_date'] = date("Y-m-d", strtotime($result['data']['prefered_date']));
			 }
			 else
			 {
			 	$result['data']['prefered_date'] = '';
			 }
			 if(isset($result['data']['prefered_time']))
			 {
			 	$result['data']['prefered_time'] = date('H:i:s', strtotime($result['data']['prefered_time']));
			 }
			 else
			 {
			 	$result['data']['prefered_time'] = '';
			 }
			 
			 $warranty_appointment_status_update_array = array(

			 	'appoinment_status' => $appoinment_status,
			 	'prefered_date' => $result['data']['prefered_date'],
			 	'prefered_time' => $result['data']['prefered_time'],

			 	'prefered_datetime' => $result['data']['prefered_date'].' '.$result['data']['prefered_time'],

			 	);
			 if($result['data']['prefered_date'] == '')
			 {
			    unset($warranty_appointment_status_update_array['prefered_date']);
			    unset($warranty_appointment_status_update_array['prefered_datetime']);
			 }
			 if($result['data']['prefered_time'] == '')
			 {
			    unset($warranty_appointment_status_update_array['prefered_time']);
			 }

			}
			else
			{	
				$warranty_appointment_status_update_array = array();
			}
			 $response = $this->Mod_warranty->update_appointment_warranty($warranty_appointment_update_array,$warranty_appointment_status_update_array);
			 $this->Mod_warranty->response($response);
		    } 
	        // Here ub_user_id value is 0. So It will enter to Insert function
		    else
		    {
		  	  $result['data']['ub_warranty_claim_id'] = $this->ci_decrypt($result['data']['ub_warranty_claim_id'], $this->encrypt_key);

		  	  if(isset($result['data']['service_date']) && $result['data']['service_date'] !='')
			  {
				$result['data']['service_date'] = date("Y-m-d", strtotime($result['data']['service_date']));
			  }
			  if(isset($result['data']['completion_date']) && $result['data']['completion_date'] !='')
			  {
				$result['data']['completion_date'] = date("Y-m-d", strtotime($result['data']['completion_date']));
			  }
			  if(isset($result['data']['service_from_time']) && $result['data']['service_from_time'] != '')
			  {
				$result['data']['service_from_time'] = date('H:i:s', strtotime($result['data']['service_from_time']));
			  }
			  if(isset($result['data']['service_to_time']) && $result['data']['service_to_time'] != '')
			  {
				$result['data']['service_to_time'] = date('H:i:s', strtotime($result['data']['service_to_time']));
			  }
			  if(isset($result['data']['subcontractor_id']) && $result['data']['subcontractor_id'] !== null && $result['data']['subcontractor_id']!='Nothing selected')
			  {
					$result['data']['subcontractor_id'] = $result['data']['subcontractor_id'];
			  }
			  else
			  {
				$result['data']['subcontractor_id'] = "";
			  }
			  $warranty_appointment_insert_array = array(
				'ub_warranty_claim_appointments_id' => $result['data']['ub_warranty_claim_appointments_id'],
				'builder_id' => $this->user_session['builder_id'],
				'warranty_claim_id' => $result['data']['ub_warranty_claim_id'],
				'subcontractor_id' => $result['data']['subcontractor_id'],
				'appoinment_link_to' => $result['data']['ub_warranty_claim_appointments_id'],
				'service_date' => $result['data']['service_date'],
				'service_from_time' => $result['data']['service_from_time'],
				'service_to_time' => $result['data']['service_to_time'],
				'subcontractor_notes' => $result['data']['subcontractor_notes'],
				'builder_user_notes' => $result['data']['builder_user_notes'],
				'sub_accept_appoinment' => isset($result['data']['sub_accept_appoinment']) ? "Acceptance Pending" : "Not Required",
				'owner_accept_appoinment' => isset($result['data']['owner_accept_appoinment']) ? "Acceptance Pending" : "Not Required",
			  	'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
			  	//print_r($warranty_appointment_insert_array);exit;
				 if($result['data']['service_date'] == '')
			     {
				  unset($warranty_appointment_insert_array['service_date']);
			     }
			     if($result['data']['completion_date'] == '')
			     {
				  unset($warranty_appointment_insert_array['completion_date']);
			     }
			     if($result['data']['service_from_time'] == '')
			     {
				  unset($warranty_appointment_insert_array['service_from_time']);
			     }
			     if($result['data']['service_to_time'] == '')
			     {
				  unset($warranty_appointment_insert_array['service_to_time']);
			     }
			     //print_r($warranty_appointment_insert_array);
				// insert the record
				$response = $this->Mod_warranty->add_appointment_warranty($warranty_appointment_insert_array);
			    $this->Mod_warranty->response($response);
			}
		  }
		}
	}
	
	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* url encoded : 
	*/
	public function update_general_value()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$args = array('classification'=>$result['data']['classification'], 'type' => $result['data']['type'] ,'value' => $result['data']['value']);
				$result = $this->Mod_general_value->update_general_value($args);
			}
			$this->Mod_warranty->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/** 
	* Warranty ListPage
	* 
	* @method: get_warranty 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* url encoded : 
	*/
	public function get_warranty($page_count = '')
	{
    if(!empty($this->input->post()))
		{
		// Getting data of a particular builder
			$search_session_array = array();
			if(!empty($this->project_id))
			{
				$post_array[] = array(
								'field_name' => 'WARRANTY.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
			} 
			else
			{
				$post_array[] = array(
								'field_name' => 'WARRANTY.project_id',
								'value'=> $this->users_project_ids, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			}		
				$post_array[] = array(
									'field_name' => 'WARRANTY.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'WARRANTY.is_delete',
									'value'=> 'No', 
									'type' => '='
									);
			// Order by
			$order_by_where = '';
			// Pagination Array
			$pagination_array = array();
			$total_count_array =  array();						
            // Sanitize input
			$result = $this->sanitize_input();
			 // echo "<pre>";print_r($result);exit;
			if(TRUE === $result['status'])
			{

			 if(isset($result['data']['classification']) && $result['data']['classification']!='' && $result['data']['classification'] != 'null')
			  {
						$post_array[] = array(
								'field_name' => 'WARRANTY.classification',
								'value'=> $result['data']['classification'], 
								'type' => '='
							);

					// Set value in session
					 $search_session_array['classification'] = $result['data']['classification'];
					}
                    if(isset($result['data']['category']) && $result['data']['category']!='' && $result['data']['category'] != 'null')
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.category',
								'value'=> $result['data']['category'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
						
					// Set value in session
					 $search_session_array['category'] = $result['data']['category'];
					}
                 if(isset($result['data']['status']) && $result['data']['status']!='' && $result['data']['status'] != 'null')
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.status',
								'value'=> $result['data']['status'], 
								'type' => '='
							);
						
					// Set value in session
					 $search_session_array['status'] = $result['data']['status'];
					}						
                     if(isset($result['data']['priority']) && $result['data']['priority']!='' && $result['data']['priority'] != 'null')
					   
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.priority',
								'value'=> $result['data']['priority'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
								
					// Set value in session
					 $search_session_array['priority'] = $result['data']['priority'];
					}
                    if(isset($result['data']['coordinators']) && $result['data']['coordinators']!='' && $result['data']['coordinators'] != 'null')
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.service_coordinator_id',
								'value'=> $result['data']['coordinators'], 
								'type' => '='
							);	
					// Set value in session
					 $search_session_array['coordinators'] = $result['data']['coordinators'];		
					}		
					if(isset($result['data']['servicingsub']) && $result['data']['servicingsub']!='' && $result['data']['servicingsub'] != 'null' && $result['data']['servicingsub'] != 0)
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.original_subcontractor_id',
								'value'=> $result['data']['servicingsub'], 
								'type' => '='
							);
						$search_session_array['servicingsub'] = $result['data']['servicingsub'];	
					 // echo "<pre>";print_r($post_array);exit;		
					}
					if(isset($result['data']['subcontractor']) && $result['data']['subcontractor']!='' && $result['data']['subcontractor'] != 'null' && $result['data']['subcontractor'] != 0)
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.original_subcontractor_id',
								'value'=> $result['data']['subcontractor'], 
								'type' => '='
							);
						$search_session_array['subcontractor'] = $result['data']['subcontractor'];	
					 // echo "<pre>";print_r($post_array);exit;		
					}
                    if(isset($result['data']['daterange']) && $result['data']['daterange']!='')
				   {
					
					$formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' => 'date(WARRANTY.created_on)',
										'from'=> date("Y-m-d", strtotime($formatted_date[0])),
										'to'=> date("Y-m-d", strtotime($formatted_date[2])),
										'type' => 'daterange'
									      );   
								 // echo '<pre>';print_r($formatted_date);exit;	
								 // echo '<pre>';print_r($result);exit;	
						$search_session_array['daterange'] = $result['data']['daterange'];
				}

				if($page_count == 'result_array')
				{
					
					if(isset($this->uni_session_get('SEARCH')['classification']) && $this->uni_session_get('SEARCH')['classification']!='' && $this->uni_session_get('SEARCH') != 'null')
				  {
					$post_array[] = array(
								'field_name' => 'WARRANTY.classification',
								'value'=> $this->uni_session_get('SEARCH')['classification'], 
								'type' => '='
							);
					//$search_session_array['daterange'] = $result['data']['daterange'];
				  }
				  if(isset($this->uni_session_get('SEARCH')['category']) && $this->uni_session_get('SEARCH')['category']!='' && $this->uni_session_get('SEARCH')['category'] != 'null')
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.category',
								'value'=> $this->uni_session_get('SEARCH')['category'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
						
					// Set value in session
					 //$search_session_array['category'] = $result['data']['category'];
					}
					if(isset($this->uni_session_get('SEARCH')['status']) && $this->uni_session_get('SEARCH')['status']!='' && $this->uni_session_get('SEARCH')['status'] != 'null')
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.status',
								'value'=> $this->uni_session_get('SEARCH')['status'], 
								'type' => '='
							);
						
					// Set value in session
					 //$search_session_array['status'] = $result['data']['status'];
					}
					if(isset($this->uni_session_get('SEARCH')['priority']) && $this->uni_session_get('SEARCH')['priority']!='' && $this->uni_session_get('SEARCH')['priority'] != 'null')
					   
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.priority',
								'value'=> $this->uni_session_get('SEARCH')['priority'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
								
					// Set value in session
					 //$search_session_array['priority'] = $result['data']['priority'];
					}
					if(isset($this->uni_session_get('SEARCH')['coordinators']) && $this->uni_session_get('SEARCH')['coordinators']!='' && $this->uni_session_get('SEARCH')['coordinators'] != 'null')
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.service_coordinator_id',
								'value'=> $this->uni_session_get('SEARCH')['coordinators'], 
								'type' => '='
							);	
					// Set value in session
					 //$search_session_array['coordinators'] = $result['data']['coordinators'];		
					}
					if(isset($this->uni_session_get('SEARCH')['servicingsub']) && $this->uni_session_get('SEARCH')['servicingsub']!='' && $this->uni_session_get('SEARCH')['servicingsub'] != 'null' && $this->uni_session_get('SEARCH')['servicingsub'] != 0)
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.original_subcontractor_id',
								'value'=> $this->uni_session_get('SEARCH')['servicingsub'], 
								'type' => '='
							);
						//$search_session_array['servicingsub'] = $result['data']['servicingsub'];	
					 // echo "<pre>";print_r($post_array);exit;		
					}
					if(isset($this->uni_session_get('SEARCH')['subcontractor']) && $this->uni_session_get('SEARCH')['subcontractor']!='' && $this->uni_session_get('SEARCH')['subcontractor'] != 'null' && $this->uni_session_get('SEARCH')['subcontractor'] != 0)
					
					{
						$post_array[] = array(
								'field_name' => 'WARRANTY.original_subcontractor_id',
								'value'=> $this->uni_session_get('SEARCH')['subcontractor'], 
								'type' => '='
							);
						//$search_session_array['subcontractor'] = $result['data']['subcontractor'];	
					 // echo "<pre>";print_r($post_array);exit;		
					}
				   if(isset($this->uni_session_get('SEARCH')['daterange']) && $this->uni_session_get('SEARCH')['daterange']!='')
				   {
					
					$formatted_date = explode(" ",$this->uni_session_get('SEARCH')['daterange']);
					 $post_array[] = array(
										'field_name' => 'date(WARRANTY.created_on)',
										'from'=> date("Y-m-d", strtotime($formatted_date[0])),
										'to'=> date("Y-m-d", strtotime($formatted_date[2])),
										'type' => 'daterange'
									      );   
								 // echo '<pre>';print_r($formatted_date);exit;	
								 // echo '<pre>';print_r($result);exit;	
						//$search_session_array['daterange'] = $result['data']['daterange'];
				}
				}

				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];						
				// Where clause argument
				$this->uni_set_session('search', $search_session_array);
				$where_str = $this->Mod_warranty->build_where($post_array);
				
				//role access checked -- code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('warranty')][strtolower('view all')]) && $this->user_role_access[strtolower('warranty')][strtolower('view all')] == 0)
				{	
					if(isset($this->user_role_access[strtolower('warranty')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('warranty')][strtolower('view assigned to me')] == 1 && $this->user_account_type == BUILDERADMIN)
					{
						$where_str = $where_str.'AND ( WARRANTY.service_coordinator_id = '. $this->user_id.' OR WARRANTY.original_subcontractor_id = '. $this->user_id.')';					
					}
					else if(isset($this->user_role_access[strtolower('warranty')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('warranty')][strtolower('view assigned to me')] == 1 && $this->user_account_type == SUBCONTRACTOR)
					{
						$where_str = $where_str." AND WARRANTY_APPOINTMENT.subcontractor_id = '".$this->user_id."'";					
					}
					else if($this->user_account_type == OWNER)
					{
						// $where_str = $where_str."AND ( WARRANTY.show_owner = 'Yes' OR WARRANTY.created_by = ".$this->user_id." )";
					}
				}
				
				// Pagination argument
				$pagination_array = array();
				if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}
				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}*/
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					// Get formatted sort name
					$format_sort_name = $this->Mod_warranty->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
					$order_by_where = 'WARRANTY.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				    }
				}
				else
				{
				$order_by_where='WARRANTY.modified_on DESC';
				}
                // Fetch argument building
                $datetime_array = array('WARRANTY.created_on'=>'created_on');
		        $date_array = array('WARRANTY.follow_up_date' => 'follow_up_date','max(WARRANTY_APPOINTMENT.service_date)'=>'service_date');
                $warranty_args = array('select_fields' => array(
												'WARRANTY.ub_warranty_claim_id','WARRANTY.created_by','USER.account_type','WARRANTY.builder_id','WARRANTY.title','WARRANTY.priority','WARRANTY.category','WARRANTY.classification','WARRANTY.status,'.$this->Mod_user->format_user_datetime($date_array,"date"). ','.$this->Mod_user->format_user_datetime($datetime_array)),
												'join'=> array('user'=>'Yes','builder'=>'Yes','warranty_appointment'=>'Yes','project'=>'Yes'),
												'where_clause' => $where_str,
												'order_clause' => $order_by_where,
												'group_clause' => array("WARRANTY.ub_warranty_claim_id"), 
												'pagination' => $pagination_array); 
				// Setting session 
			// $this->module = 'WARRANTY';
			
             if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					//Only for export
					unset($warranty_args['pagination']);
				}
				 $result_data = $this->Mod_warranty->get_warranty($warranty_args);
				if($page_count == 'result_array')
				{
					//print_r($result_data);exit;
					return $result_data;
				}
				// The following parameters required for data table
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_warranty->get_warranty(array(
												'select_fields' => array('COUNT(WARRANTY.ub_warranty_claim_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('user'=>'Yes','builder'=>'Yes','warranty_appointment'=>'Yes','project'=>'Yes'),
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_warranty->response($result_data);
			}
			else
			{
				$this->Mod_warranty->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_warranty->response($result);
		}
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
				$result = $this->Mod_warranty->destroy_session($result['data']);
			}
			$this->Mod_warranty->response($result);
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
	* @created by: Gayathri kalyani 
	* @created on: 03/04/2015 
	* url encoded : 
	*/
	public function apply_saved_search()
	{
		 $this->module = 'WARRANTY';
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
			}
			else
			{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
		}
		else
	{
		 $serialized_data = $result_data['aaData'][0]['search_params'];
		 $remove_single_quote = str_replace("'", '', $serialized_data);
		 $unserialized_data = unserialize($remove_single_quote);
		 $result_data['aaData'][0]['search_params'] = $unserialized_data;
		 if(!empty($unserialized_data))
		{
				if(!empty($unserialized_data['status']))
				{
					// Set value in session
					$search_session_array['status'] = $unserialized_data['status'];
				}
				
				if(!empty($unserialized_data['classification']))
				{
					// Set value in session
					$search_session_array['classification'] = $unserialized_data['classification'];
					
				}
				if(!empty($unserialized_data['daterange']))
				{
					// Set value in session
					$search_session_array['daterange'] = $unserialized_data['daterange'];
					
				}
				if(!empty($unserialized_data['category']))
				{
					// Set value in session
					$search_session_array['category'] = $unserialized_data['category'];
				}
				if(!empty($unserialized_data['priority']))
				{
					// Set value in session
					$search_session_array['priority'] = $unserialized_data['priority'];
					
				}
				if(!empty($unserialized_data['coordinators']))
				{
					// Set value in session
					$search_session_array['coordinators'] = $unserialized_data['coordinators'];
					
				}
				if(!empty($unserialized_data['servicingsub']))
				{
					// Set value in session
					$search_session_array['servicingsub'] = $unserialized_data['servicingsub'];
					
				}
				if(!empty($unserialized_data['subcontractor']))
				{
					// Set value in session
					$search_session_array['subcontractor'] = $unserialized_data['subcontractor'];
					
				}
				// Setting session 
				
				 $this->uni_set_session('search', $search_session_array);
				
				// Response data
				$this->Mod_project->response($result_data);
		}
	}

}
/** 
	* Add comment
	* 
	* @method: new_comment 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: sidhartha
	* @URL: bgxf19ncy9zYXZlX2NvbW1lbnQv 
	*/	
	public function save_comment()
	{
		$this->encrypt_key = 'XYZ!@#$%';
		if(!empty($this->input->post()))
		{
			$result = $this->sanitize_input();
			//print_r($result);
			if(TRUE === $result['status'])
			{	
				$post_data = array(
					'comments' => $result['data']['comments'],
					'project_id' => $result['data']['project_id'],
					'show_sub' => $result['data']['show_sub'],
					'show_owner' => $result['data']['show_owner'],
					'module_pk_id' => $this->ci_decrypt($result['data']['warranty_claim_id'], $this->encrypt_key),
					'builder_id' => $this->user_session['builder_id'],
					'created_on' => TODAY,
					'created_by' => $this->user_session['ub_user_id'],
					'modified_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'],
					'module_name' => $this->module
					);
				$notification_data = array(
                    'title' => $result['data']['title'],
					);
				//print_r($post_data);exit;
				$response = $this->Mod_comment->add_comment($post_data,$notification_data);
				$this->Mod_comment->response($response);	
			}
				
		}
	}
	
	
	/** 
	* Delete comment
	* 
	* @method: delete_comment 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: Sidharta
	* @URL: bgxf19ncy9kZWxldgxf1VfY29tbWVudC8- 
	*/
	public function delete_comment()
	{		
		$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_comment->delete_comment($result['data']);
				
			}
			else
			{
				$this->Mod_comment->response($result);
			}
			$this->Mod_comment->response($response);
	}


	/** 
	* Give Notification
	* 
	* @method: send_notify 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9zZW5kX25vdgxf1lmeS8-
	*/	
	public function send_notify()
	{
		  if(!empty($this->input->post()))
		  {
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$post_array = array();
			  	if($result['data']['owner_notify'] == 'Yes' && $result['data']['sub_notify'] == 'Yes')
			  	{
			  		$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.role_id',
								'value'=> SUB_CONTRACTOR_ROLE_ID.','.OWNER_ROLE_ID,
								'type' => '||',
								'classification' => 'primary_ids'
							);
			  	}
			  	else if($result['data']['owner_notify'] == 'Yes' && $result['data']['sub_notify'] == 'No')
			  	{
			  		$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.role_id',
								'value'=> OWNER_ROLE_ID,
								'type' => '||',
								'classification' => 'primary_ids'
							);
			  	}
			  	else if($result['data']['owner_notify'] == 'No' && $result['data']['sub_notify'] == 'Yes')
			  	{
			  		$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.role_id',
								'value'=> SUB_CONTRACTOR_ROLE_ID,
								'type' => '||',
								'classification' => 'primary_ids'
							);
			  	}
			  	if(count($post_array) > 0)
			  	{
			  		if($result['data']['project_id'] > 0)
			  		{
			  			$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.project_id',
								'value'=> $result['data']['project_id'], 
								'type' => '='
							);
				  		$where_str = $this->Mod_warranty->build_where($post_array);
					  	$result_data = $this->Mod_warranty->get_userinfo(array(
										'select_fields' => array('PROJECT_ASSIGNED_USERS.project_id','PROJECT_ASSIGNED_USERS.role_id',
											'PROJECT_ASSIGNED_USERS.assigned_to','USER.first_name','USER.primary_email'),
										'join'=> array('user'=>'Yes'),
										'group_clause' => array("PROJECT_ASSIGNED_USERS.assigned_to"),
										'where_clause' => $where_str
														));
				        // Response data
				        $this->Mod_warranty->response($result_data);
			  		}
			  		
			  	}
			  	
		  }
	    }
	  }
	  /** 
	* Get User Accounttype
	* 
	* @method: get_user_accounttype 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_user_accounttype()
	{
		$result = $this->sanitize_input();
		//print_r($result);exit;
		
		//New
		$result = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.account_type'),
								'where_clause' => array('USER.ub_user_id' => $result['data']['subcontractor_id'])
								));	
		//print_r($result);exit;
		
		$data['account_type'] = $result['aaData'][0]['account_type'];
		$this->Mod_warranty->response($data);
	
	}
	
}