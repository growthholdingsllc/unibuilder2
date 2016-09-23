<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Task Class
 * 
 * @package: Task
 * @subpackage: Task
 * @category: Task
 * @author: Chandru 
 * @createdon(DD-MM-YYYY): 24-03-2015 
*/
class Task extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();

		$this->load->model(array('Mod_task','Mod_general_value','Mod_timezone','Mod_user','Mod_saved_search', 'Mod_project','Mod_comment','Mod_reminder','Mod_message','Mod_notification','Mod_builder','Mod_grid_settings','Mod_doc','Mod_template','Mod_custom_settings','Mod_schedule'));
		$this->module;
		$this->grid_setting_classification = 'task_grid_setting_fields';
		$this->load->helper('export');
    }
	/** 
	* Get all task
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @createdby: chandru
	* @URL: dgxf1Fzay9pbmRleC8- 
	*/
	public function index()
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
		$user_id_from_session = $this->user_session['ub_user_id'];
		$data = array(
		'title'        => "TASK",		
		'content'      => 'content/task/task',
        'page_id'      => 'task',
		'apply_filter'=>$apply_filter,
		'data_table'   =>'data_table',
		'task_list'	   =>'task_list',      
		'date_all'	   =>'date_all',
		'ub_user_id'	   =>$user_id_from_session,
		'add_task_url' => $this->crypt->encrypt('task/task/'),
		'search_session_array' => $this->uni_session_get('SEARCH'),
		);
		// Code to fetch the grid settings pop up information 
		$data['grid_settings_popup']=$this->uni_get_grid_settings_popup_info();	
		$data['datatable_headers']=$data['grid_settings_popup']['datatable_headers'];
		unset($data['grid_settings_popup']['datatable_headers']); 
		
		$args = array('classification'=>'task_priority', 'type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['task_priority'] = $result['values'];
		
		$args = array('classification'=>'task_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		
		$data['task_tags'] = $result['values'];
		 //New code for fetch all users
		 /* $args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
		 $data['get_all_users'] = $this->Mod_user->get_users_by_type($args,'multiple');  */
		 if(isset($this->project_id) && !empty($this->project_id))
		 {
		 $all_type_users = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$this->project_id, 'account_type' => 'all', 'dropdown_type' => 'optgroup'));
		 }else{
		 $args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
		 $all_type_users = $this->Mod_user->get_users_by_type($args,'multiple');
		 }
		$data['get_all_users'] = $all_type_users;
		 //Related to me drop down
		 // Create mapped project drop down
		$related_to_me_dropdown = array('created_by_me'=>'Created By Me','assigned_by_me'=>'Assigned to me');
		$data['related_to_me_dropdowns'] = $related_to_me_dropdown;
		//template drop down
	    $template_list = $this->Mod_template->get_template(array(
					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),
					'where_clause' => (array('TEMPLATE.builder_id' => $this->user_session['builder_id']))
					));
	    if( $template_list['status'] == TRUE){
			
			//$data['template_list']= $template_list['aaData'];
			$data['template_list'] = $this->Mod_project->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name');
	   	}
		/* if(isset($this->project_status) && !empty($this->project_status))
		{
			if($this->project_status == 'Closed')
			{
				$data['project_closed'] = TRUE;
			}else{
				$data['project_closed'] = FALSE;
			}
		}
		else{
				$data['project_closed'] = FALSE;
			} */
		/* if (!in_array($this->project_status, $this->project_status_check_array))
		  {
			$data['project_closed'] = TRUE;
		  } else{
			$data['project_closed'] = FALSE;
		  }  */
		$this->template->view($data);
	}	
	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* url encoded : dgxf1Fzay91cgxf1Rhdgxf1VfZ2VuZXJhbF92YWx1ZS8-
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
			$this->Mod_task->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	public function save_task($ub_task_id = 0)
	{
		$results = $this->sanitize_input();
		$result_data = array(); 
		//echo "<pre>"; print_r($results);exit();
		// Load add page code starts here   
		$data = array(
		'title'        => "TASK",		
		'content'      => 'content/task/save_task',
		'drop_upload'  => 'drop_upload',
        'page_id'      => 'task',
		'date_all'	   =>'date_all' 
		);
		 /* if (!in_array($this->project_status, $this->project_status_check_array))
		  {
			$data['project_closed'] = TRUE;
		  } else{
			$data['project_closed'] = FALSE;
		  }  */
		//get project id from task table // by satheesh kumar
		if(empty($this->project_id) && $ub_task_id > 0)
		{
		$where_args = array('ub_task_id' => $ub_task_id);
		$project_id = $this->Mod_project->get_project_id(UB_TASK,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		//end code for get project id
		
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
			{
				$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
			}
		
		//where condition was modified.
		/* $project_list = $this->Mod_task->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => array('PROJECT.builder_id' => $this->user_session['builder_id'])
					));
		if(!empty($project_list['status']))
		{
		$data['project_list'] = $project_list['aaData'];
		}else{
		$data['project_list'] = false;
		} */
		
		//Get all projects list from project table with the builder_id
		 $project_list = $this->Mod_task->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => array('PROJECT.builder_id'=> $this->builder_id)
					)); 
		$data['project_list']=array();
		if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_task->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		} 
		
		//Fetch all the users
		    $where_clause = array('builder_id' => $this->user_session['builder_id']);
         $get_all_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','username'),
                                    'where_clause' => $where_clause
                                    );
         $all_users = $this->Mod_user->get_users($get_all_users);
         $data['user_name']=$all_users;
		 //Fetch priority
		$args = array('classification'=>'task_priority', 'type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['task_priority'] = $result['values'];
		//Fetch all tags
		$args = array('classification'=>'task_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['task_tags'] = $result['values'];
		//Fetch all reminder
		$args = array('classification'=>'reminder', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['task_reminder'] = $result['values'];

		// Schedule
		$args_schedule['where_clause'] = array('builder_id'=>$this->builder_id,'project_id'=>$this->project_id);
		$args_schedule['select_fields'] = array('ub_schedule_id','title');
		$schedule_options = $this->Mod_task->get_db_options(UB_SCHEDULE, $args_schedule);
		$data['schedule_options'] = $schedule_options;

		//Before Or After Dropdown
	    $before_or_after_dropdown[] = array('id' => 'Before','val' => 'Before');
	    $before_or_after_dropdown[] = array('id' => 'After','val' => 'After');
	    $data['before_or_after_dropdown_list'] = $this->Mod_task->build_ci_dropdown_array($before_or_after_dropdown,'id', 'val');

		/*code to create the temp dir and pass it to view*/
		$dir_response = $this->Mod_doc->create_default_dir();
		//$dir_response = array('status' => FALSE);
		//echo "<pre>";print_r($dir_response);exit;
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
			$data['temprory_dir_id'] = '1';
			//echo 'g';exit;
			//$dir_response = $this->Mod_doc->create_default_dir();
			//$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		// Block to fetch custom fields.

		$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>TASK_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE);
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

		if($ub_task_id > 0 || isset($results['data']['ub_task_id']) && $results['data']['ub_task_id'] > 0)
		{

			// Block to fetch the field values for custom fields.
			$this->ub_task_id = (isset($results['data']['ub_task_id'])) ? $results['data']['ub_task_id'] : $ub_task_id;
			$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>TASK_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE,'CUSTOM_FIELD_VALUES.table_id' => $this->ub_task_id);

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
			/*Code for update file */

			
			$task_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->ub_task_id,
								);
			$result_array = $this->Mod_doc->get_files_for_folder($task_data);

			
			//echo "<pre>";print_r($result_array);exit;

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

			
			/*End Code for edit file */
		//Fetch comment code
		$datetime_array = array('COMMENT.created_on'=>'comment_created_on');
		$other_comment_where = '';
		$comment_post_array[] = array(
							'field_name' => 'COMMENT.module_pk_id',
							'value'=> $ub_task_id, 
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
		$where_str = $this->Mod_task->build_where($comment_post_array);
        if($other_comment_where != '')
		{
			$where_str = $where_str.$other_comment_where;
		}
		$comments_list = $this->Mod_comment->get_comment(array(
									'select_fields' => array('USER.account_type','COMMENT.show_sub','COMMENT.show_owner','COMMENT.comments','COMMENT.created_by','USER.first_name','COMMENT.ub_comments_id,'.$this->Mod_user->format_user_datetime($datetime_array)),
									'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes','daily_log'=>'Yes'),
									'where_clause' => $where_str,
									'order_clause' => 'COMMENT.ub_comments_id desc'
													));
		if(isset($comments_list['aaData']))
		{
			$data['comments_list'] = $comments_list['aaData'];
		}else{
		$data['comments_list'] = false;
		}
			if(!empty($this->input->post()))
		     {
				$results = $this->sanitize_input();
				
				if(!empty($results['data']['due_date_time']))
				{
					$due_time = $results['data']['due_date_time'];
					$time = date('H:i:s', strtotime($due_time));
				}else{
					$time = '';
				}
				if(!empty($results['data']['tags']))
				{
					$tags = "".implode(",", $results['data']['tags'])."";
				}else{
					$tags = '';
				}
				if(!empty($results['data']['assign_to']))
				{
					$assign_to = "".implode(",", $results['data']['assign_to'])."";
				}else{
					$assign_to = '';
					$results['data']['assign_to'] = '';
				}
				$checklist_description_checkbox = "";
				 if(isset($results['data']['checklist_mark_hidden']))
				 {
					$checklist_description_checkbox = $results['data']['checklist_mark_hidden'];
				 }
				$task_insert_main_array = array(
					'title' => $results['data']['title'],
					'note' => $results['data']['task_note'],
					'project_id' => $results['data']['project_name'],
					'assign_to' => $results['data']['assign_to'],
					'task_assigned_users' => $assign_to,
					'schedule_id' => $results['data']['schedule_id'],
					'number_days' => $results['data']['number_days'],
                    'before_or_after' => $results['data']['before_or_after'],
					'due_date' => $results['data']['due_date'],
					'due_time' => $time,
					'priority' => $results['data']['priority'],
					'tags' => $tags,
					'description' => $results['data']['checklist_description'],
					'description_mark_complete_status' => $checklist_description_checkbox,
					'mark_complete_status' => $results['data']['marked-list'],
					'checklist_description_id' => $results['data']['checklist_description_id'],
					'reminder' => $results['data']['reminder'],
					'created_on' => $results['data']['created_on'],
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY,
					'ub_task_id'=>$results['data']['ub_task_id'],
					'schedule_due_date' => date("Y-m-d", strtotime($results['data']['schedule_due_date']))
					);
					if(isset($results['data']['deadline_type']) && isset($results['data']['schedule_id']) && $results['data']['schedule_id'] > 0)
						 {
							$task_insert_main_array['due_date'] = '';
							$task_insert_main_array['due_time'] = '';
						 }
						 else
						 {
							$task_insert_main_array['number_days'] = 0;
							$task_insert_main_array['schedule_id'] = 0;

						 }
					$response = $this->Mod_task->update_task($task_insert_main_array);

					if(isset($results['data']['deadline_type']))
			        {
			    	$link_to_schedule_array = array(
							'builder_id' => $this->builder_id,
							'project_id' => $results['data']['project_id'],
							'module_name' => $this->module,
							'module_id' => $results['data']['ub_task_id'],
							'schedule_id' => $results['data']['schedule_id'],
							'lag' => $results['data']['number_days'],
							'before_or_after' => $results['data']['before_or_after'],
							'due_date' => date("Y-m-d", strtotime($results['data']['schedule_due_date'])),
							'created_on' => TODAY,
							'created_by' => $this->user_id,
							'modified_on' => TODAY,
							'modified_by' => $this->user_id
							);
					$this->Mod_schedule->update_link_to($link_to_schedule_array);
					//echo "hi";exit;
			       }
				   else{
					$link_to_schedule_array = array(
							'builder_id' => $this->builder_id,
							'project_id' => $results['data']['project_id'],
							'module_name' => $this->module,
							'module_id' => $results['data']['ub_task_id'],
							'schedule_id' => $results['data']['schedule_id'],
							'lag' => $results['data']['number_days'],
							'before_or_after' => $results['data']['before_or_after'],
							'due_date' => date("Y-m-d", strtotime($results['data']['schedule_due_date'])),
							'created_on' => TODAY,
							'created_by' => $this->user_id,
							'modified_on' => TODAY,
							'modified_by' => $this->user_id
							);
			     	$this->Mod_schedule->delete_link_to($link_to_schedule_array);
				   }

					$results['data']['module_id'] = $results['data']['ub_task_id'];
					$results['data']['module_name'] = 'task';
					$results['data']['classification'] = TASK_CUSTOM_FIELDS;
					$results['data']['status'] = FIELD_ACTIVE;
					$custom_response = $this->Mod_custom_settings->format_custom_filed_and_insert($results['data']);
					$this->Mod_task->response($response);
			 }
			 else
			{
			 $result_data = $this->Mod_task->get_tasks(array(
			'select_fields' => array('TASK.ub_task_id', 'TASK.builder_id', 'TASK.project_id',
			'TASK.note', 'TASK.title','TASK.tags','TASK.due_date','TASK.priority','TASK.project_id','TASK.reminder_id','TASK.due_time','TASK.task_assigned_users','Group_concat(ub_task_checklist.ub_task_checklist_id) as check_list_id','Group_concat(ub_task_checklist.task_id) as task_id','Group_concat(ub_task_checklist.Description) as description','Group_concat(ub_task_checklist.mark_complete_status) as description_checkbox','TASK.mark_complete_status','TASK.created_on', 'TASK.due_date_time', 'TASK.completed_date_time','TASK.number_days','TASK.before_or_after','TASK.schedule_id'),
			//'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
			'join'=> array('builder'=>'Yes','ub_task_checklist'=>'Yes'),
			'where_clause' => (array('TASK.ub_task_id' =>  $ub_task_id))
			));
			 //print_r($result_data);exit;
			 
			 if($result_data['aaData'][0]['number_days'] > 0 || $result_data['aaData'][0]['schedule_id'] > 0)
			 {
				$result_data['aaData'][0]['link_to'] = 'Yes';
				// $date_result['link_to'] = 'Yes';
			 }else{
				$result_data['aaData'][0]['link_to'] = 'No';
			 }
			 $data['result_data']  = $result_data;
			 if(isset($result_data['aaData'][0]['due_date_time']) && !empty($result_data['aaData'][0]['due_date_time']) &&($result_data['aaData'][0]['due_date_time'] != '0000-00-00 00:00:00') && isset($result_data['aaData'][0]['completed_date_time']) && !empty($result_data['aaData'][0]['completed_date_time']) &&($result_data['aaData'][0]['completed_date_time'] != 'NULL'))
			 {
			$due_date_time = $result_data['aaData'][0]['due_date_time'];
			$completed_date_time = $result_data['aaData'][0]['completed_date_time'];
			
			$due_date_time = strtotime($due_date_time);
			$completed_date_time = strtotime($completed_date_time);
			if($due_date_time > $completed_date_time)
			{
				$date_result['time'] = '-'.$this->dateDiff($due_date_time, $completed_date_time) . "\n";
				// $date_result['time'] = '-';
				$date_result['status'] = "Before due date task was completed";
			}else if($due_date_time < $completed_date_time){
				$date_result['time'] = '+'.$this->dateDiff($due_date_time, $completed_date_time) . "\n";
				// $date_result['time'] = '+';
				$date_result['status'] = "Over Due";
			}else{
				$date_result['time'] = '==';
				$date_result['status'] = "Both dates are equal";
			}
				$data['date_result_data']  = $date_result;
			}else if($result_data['aaData'][0]['mark_complete_status'] == 'No' && (isset($result_data['aaData'][0]['due_date_time']) && !empty($result_data['aaData'][0]['due_date_time']) &&($result_data['aaData'][0]['due_date_time'] != '0000-00-00 00:00:00'))){
				
				$today = TODAY;
				if($today < $result_data['aaData'][0]['due_date_time'])
				{
					$date_result['status'] = "Not Over Due";
					// $date_result['time'] = '+';
					$date_result['time'] = '-'.$this->dateDiff($today, $result_data['aaData'][0]['due_date_time']) . "\n";
				}else if($today > $result_data['aaData'][0]['due_date_time']){
					$date_result['status'] = "Delayed";
					// $date_result['time'] = '-';
					$date_result['time'] = '+'.$this->dateDiff($today, $result_data['aaData'][0]['due_date_time']) . "\n";
				}else{
					$date_result['time'] = '==';
					$date_result['status'] = "Both dates are equal";
				}
				$data['date_result_data']  = $date_result;
			}else{
				$data['date_result_data']['status'] = 'Not completed';
				$date_result['time'] = '';
			}
			// echo '<pre>';print_r($date_result);exit;
			 //Assigned to field drop down
			 
			 //Fetch all the users
		    $where_clause = array('builder_id' => $this->user_session['builder_id']);
         $get_all_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','username'),
                                    'where_clause' => $where_clause
                                    );
									
         $all_users = $this->Mod_user->get_users($get_all_users);
		 $data['user_name_drop_down'] = array();
		 if(TRUE === $all_users['status'])
		 {
			$data['user_name_drop_down']=$all_users['aaData'];
		 }
		   }
		/*  $args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
		 
			$all_type_users = $this->Mod_user->get_users_by_type($args); */
			$all_type_users = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$this->project_id, 'account_type' => 'all', 'dropdown_type' => 'optgroup'));
			$data['all_type_users'] = $all_type_users;  
		}
		else
		{
		  $post_data = array();
		  if(!empty($this->input->post()))
		  {
			$results = $this->sanitize_input();
			
			$due_date = $results['data']['due_date'];
			
			//date time code ends here
			
			if(!empty($results['data']['due_date_time']))
				{
					$due_time = $results['data']['due_date_time'];
					$time = date('H:i:s', strtotime($due_time));
				}else{
					$time = '';
				}
				if(!empty($results['data']['tags']))
				{
					$tags = "".implode(",", $results['data']['tags'])."";
				}else{
					$tags = '';
				}
				if(!empty($results['data']['assign_to']))
				{
					$assign_to = "".implode(",", $results['data']['assign_to'])."";
				}else{
					$assign_to = '';
				}
				 $checklist_description = "";
				 if(isset($results['data']['checklist_description']))
				 {
					$checklist_description = $results['data']['checklist_description'];
				 }
				 $checklist_description_checkbox = "";
				 if(isset($results['data']['checklist_mark_hidden']))
				 {
					$checklist_description_checkbox = $results['data']['checklist_mark_hidden'];
				 }
				 $assign = "";
				 if(isset($results['data']['assign_to']))
				 {
					$assign = $results['data']['assign_to'];
					$results['data']['marked-list'] = "";
				 }
				if(isset($results['data']['schedule_id']) && $results['data']['schedule_id'] !== null && $results['data']['schedule_id']!='Nothing selected')
				{
				$results['data']['schedule_id'] = $results['data']['schedule_id'];
				}
				else
				{
				$results['data']['schedule_id'] = '';
				}
			$task_insert_main_array = array(
			'title' => $results['data']['title'],
			'note' => $results['data']['task_note'],
			'assigned_to' => $assign,
			'task_assigned_users' => $assign_to,
            'mark_complete_status' => $results['data']['marked-list'],
            'builder_id' => $this->user_session['builder_id'],
            'description' => $checklist_description,
            'description_mark_complete_status' => $checklist_description_checkbox,
            'project_id' => $results['data']['project_name'],
            'schedule_id' => $results['data']['schedule_id'],
            'number_days' => $results['data']['number_days'],
            'on_or_before' => $results['data']['before_or_after'],
            'priority' => $results['data']['priority'],
            'due_date' => $due_date,
            'due_time' => $time,
            'tags' => $tags,
            'reminder_id' => $results['data']['reminder'],
            'status' => 'Not completed',
            'created_by' => $this->user_session['ub_user_id'],
            'created_on' => TODAY,
            'modified_by' => $this->user_session['ub_user_id'], 
            'modified_on' => TODAY,
			'module_name' => $this->module,
			'schedule_due_date' => date("Y-m-d", strtotime($results['data']['schedule_due_date']))
			); 
			$response = $this->Mod_task->add_task($task_insert_main_array);

			if(isset($results['data']['deadline_type']) && isset($results['data']['schedule_id']) && $results['data']['schedule_id'] > 0)
			{
		    	  $link_to_schedule_array = array(
						'builder_id' => $this->builder_id,
						'project_id' => $results['data']['project_id'],
						'module_name' => $this->module,
						'module_id' => $response['insert_id'],
						'schedule_id' => $results['data']['schedule_id'],
						'lag' => $results['data']['number_days'],
						'before_or_after' => $results['data']['before_or_after'],
						'due_date' => date("Y-m-d", strtotime($results['data']['schedule_due_date'])),
						'created_on' => TODAY,
						'created_by' => $this->user_id,
						'modified_on' => TODAY,
						'modified_by' => $this->user_id
				     );
					$this->Mod_schedule->add_link_to($link_to_schedule_array);
					//echo "hi";exit;
			}
			//echo "<pre>";	print_r($response);exit;
			$results['data']['module_id'] = $response['insert_id'];
			$results['data']['module_name'] = 'task';
			$results['data']['classification'] = TASK_CUSTOM_FIELDS;
			$results['data']['status'] = FIELD_ACTIVE;
			$custom_response = $this->Mod_custom_settings->format_custom_filed_and_insert($results['data']);
			$this->Mod_task->response($response);
			
		  }
		}
		
		// echo "<pre>"; print_r($data);exit();	
	  $this->template->view($data);
	}
		// Load add page code ends here   //
	

		/** 
	* Get roles
	* 
	* @method: get_roles 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: chandru
	* @URL: dgxf1Fzay9nZXRfdgxf1Fzay8- 
	*/	
	public function get_task()
	{
		$post_array[] = array(
							'field_name' => 'TASK.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		/* "ISDELETED" condition checking 06-10-2015 added by chandru */
		$post_array[] = array(
				'field_name' => 'TASK.is_delete',
				'value' => 'No',
				'type' => '='
			);
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'TASK.project_id',
							'value'=> $this->project_id, 
							'type' => '='
						);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'TASK.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if($result['data']['assigned_to'] == 0)
					{
						unset($result['data']['assigned_to']);
					}
			if(TRUE === $result['status'])
			{
				// Search Input Array
				//All selected priority field
				$search_session_array = array();
				if(isset($result['data']['priority']) && $result['data']['priority']!='' && $result['data']['priority'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'TASK.priority',
								'value'=> $result['data']['priority'], 
								'type' => '='
							);
					//Modified session code
					 $search_session_array['priority'] = $result['data']['priority'];
				}
				//Status field
				if(isset($result['data']['status']) && $result['data']['status']!='' && $result['data']['status'] != 'null' )
				{
					$post_array[] = array(
								'field_name' => 'TASK.status',
								'value'=> $result['data']['status'], 
								'type' => '='
							);
					$search_session_array['status'] = $result['data']['status'];
					// Set value in session
				}
				//No task tag filter field
				 if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
				{
					if(!is_array($result['data']['tags']))
					{
					$post_array[] = array(
								'field_name' => 'TASK.tags',
								'value'=> $result['data']['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['tags'] = $result['data']['tags'];	
					}
					
					if($result['data']['fetch_type'] == 'export')
						{
							if(is_array($result['data']['tags']))
							{
								$new_array_for_tags = implode(",",$result['data']['tags']);
								$post_array[] = array(
								'field_name' => 'TASK.tags',
								'value'=> $new_array_for_tags, 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
							}
						}
				} 
				//related_to_me field
				if(isset($result['data']['related_to_me']) && $result['data']['related_to_me']!='' && $result['data']['related_to_me'] != 'null')
				{
					if($result['data']['related_to_me'] == 'created_by_me')
					{
					$post_array[] = array(
								'field_name' => 'TASK.created_by',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '='
							);
					$search_session_array['related_to_me'] = $result['data']['related_to_me'];	
					}
					elseif($result['data']['related_to_me'] == 'assigned_by_me')
					{
					$post_array[] = array(
								'field_name' => 'TASK_ASSIGNED_USERS.assigned_to',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '='
							);
					$search_session_array['related_to_me'] = $result['data']['related_to_me'];
					// Set value in session
					}
					elseif($result['data']['related_to_me'] == 'created_by_me,assigned_by_me')
					{
					$post_array[] = array(
								'field_name' => 'TASK_ASSIGNED_USERS.assigned_to',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '='
							);
					$search_session_array['related_to_me'] = $result['data']['related_to_me'];
					}
		
				}
				//Assigned to single field
				 if(isset($result['data']['assigned_to']) && $result['data']['assigned_to']!='' && $result['data']['assigned_to'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'TASK_ASSIGNED_USERS.assigned_to',
								'value'=> $result['data']['assigned_to'], 
								'type' => '='
							);
					$search_session_array['assigned_to'] = $result['data']['assigned_to'];
				} 
				//New date code
				if(isset($result['data']['daterange']) && $result['data']['daterange']!='' && $result['data']['daterange'] != 'null')
                {
                    $formatted_date = explode(" ",$result['data']['daterange']);
                    $post_array[] = array(
                                        'field_name' => 'TASK.due_date',
                                        'from'=> date("Y-m-d", strtotime($formatted_date[0])),
                                        'to'=> date("Y-m-d", strtotime($formatted_date[2])),
                                        'type' => 'daterange'
                                        );
					$search_session_array['daterange'] = $result['data']['daterange'];
				}
				//code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('task')][strtolower('view all')]) && $this->user_role_access[strtolower('task')][strtolower('view all')] == 0)
				{
					if(isset($this->user_role_access[strtolower('task')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('task')][strtolower('view assigned to me')] == 1 || $this->user_account_type == SUBCONTRACTOR)
					{
					$post_array[] = array(
									'field_name' => 'TASK.task_assigned_users',
									'value'=> $this->user_id, 
									'type' => '||',
									'classification' => 'dynamnic_text'
									);
					}
					else
					{
					$post_array[] = array(
									'field_name' => 'TASK.created_by',
									'value'=> 0, 
									'type' => '=',
									);
					}
				}	
				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
				// Setting session 
				$this->uni_set_session('search', $search_session_array);
				//$this->session->set_userdata('ACCOUNT', $this->account_session);
				$where_str = $this->Mod_task->build_where($post_array);
				//echo '<pre>';print_r($where_str);exit;
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					if(2 == count($post_array))
					{
						$total_count_array = $this->Mod_task->get_tasks(array(
												'select_fields' => array('COUNT(TASK.ub_task_id) AS total_count'),
												'where_clause' => $where_str,
												// 'join'=> array('builder'=>'Yes')
												));
					}else{
						$total_count_array = $this->Mod_task->get_task(array(
												'select_fields' => array('COUNT(TASK.ub_task_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes')
												));
					}
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					// Get formatted sort name
					$format_sort_name = $this->Mod_task->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'TASK.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
						
				}
				else
				{
					$order_by_where = 'TASK.ub_task_id DESC';
				}
				
			}
			else
			{
				$this->Mod_role->response($result);
			}
		}
		// Fetch date format to display	
		$timezone = $this->Mod_timezone->get_timezone();		
		$args = array('classification'=>'user_date_format');
		$date_format_array = $this->Mod_general_value->get_general_value($args);
		
		
		// code to get the grid setting dropdown in task landing page
		//print_r($this->session->all_userdata());
		if(isset($result['data']['datatable_grid_id']) && $result['data']['datatable_grid_id'] != "")
		{
			$datatable_grid_id = $result['data']['datatable_grid_id'];
		}else{
			$datatable_grid_id = 0;
		}
		$args = array('select_fields' => array('ub_grid_settings_id','is_default' ,'list_view_name', 'display_fields', 'display_field_joins' , 'builder_id', 'user_id'), 
		'where_clause' => array('ub_grid_settings_id'=>$datatable_grid_id),'get'=>'select_fields','primary_key'=>'TASK.ub_task_id');
		
		$user_grid_settings  = $this->Mod_grid_settings->get_grid_settings($args);
		if(TRUE === $user_grid_settings['status'])
		{
			if(in_array("TASK.due_date",  $user_grid_settings['select_fields'])) 
			{
				$date_array = array('TASK.due_date'=> 'due_date');
				$formatted_date = $this->Mod_user->format_user_datetime($date_array,"date");
				array_push($user_grid_settings['select_fields'],$formatted_date );
			}
			$datatable_headers = $user_grid_settings['header_fields'];
			$field_names = $user_grid_settings['field_names'];
			$grid_setting_count = count($user_grid_settings['select_fields']);
			if($grid_setting_count > 0)
			{
				$user_grid_settings['select_fields'][$grid_setting_count] = 'TASK.due_date_time';
				$user_grid_settings['select_fields'][$grid_setting_count +1] = 'TASK.completed_date_time';
			}
			$query_array = array('select_fields' => $user_grid_settings['select_fields'],	
			'join'=>$user_grid_settings['join_clause'],
			'where_clause' => $where_str,
			'order_clause' => $order_by_where,
			'pagination' => $pagination_array,
			'group_clause' => array("TASK.ub_task_id") 
			);
		}
		else
		{
			$this->Mod_task->response($user_grid_settings);
		}
		
		/*$query_array = array('select_fields' => array('TASK.ub_task_id','TASK.title', 'TASK.priority', 'TASK.modified_by', 'TASK.modified_on', 'TASK.due_date', 'TASK.created_by', 'TASK.tags','GROUP_CONCAT(CONCAT_WS(" ", USERS.first_name, USERS.last_name)) as assignedto','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator','USER.first_name', 'TASK_ASSIGNED_USERS.assigned_to','TASK.status,'
		.$this->Mod_user->format_user_datetime($date_array,"date")),
		'join'=> array('builder'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array,
		'group_clause' => array("TASK.ub_task_id") 
		);*/
		
		if($result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		}
		//print_r($query_array);exit;
		$result_datas = $this->Mod_task->get_task($query_array);
		if($result_datas['status'] == TRUE)
		{
			foreach($result_datas['aaData'] as $name => $values)
			{
				if($values['due_date'] == '0/0/0000')
				{
					$values['due_date'] = '';
				}
				if($values['performance_timing'] == '0000-00-00' && $values['status'] == 'Not completed')
				{
					$values['performance_timing'] = "";
				}else if($values['performance_timing'] != '0000-00-00' && $values['status'] == 'Completed')
				{
					$due_date_time = strtotime($values['due_date_time']);
					$completed_date_time = strtotime($values['completed_date_time']);
					if($due_date_time > $completed_date_time)
					{
						$date_result['time'] = '-'.$this->dateDiff($due_date_time, $completed_date_time) . "\n";
						// $date_result['time'] = '-';
						$values['performance_timing'] = '-'.$this->dateDiff($values['due_date_time'], $values['completed_date_time']) . "\n";
						}else if($due_date_time < $completed_date_time){
						$date_result['time'] = '+'.$this->dateDiff($due_date_time, $completed_date_time) . "\n";
						// $date_result['time'] = '+';
						// $date_result['status'] = "Over Due";
						$values['performance_timing'] = '+'.$this->dateDiff($values['due_date_time'], $values['completed_date_time']) . "\n";
						}else{
						$date_result['time'] = '==';
						// $date_result['status'] = "Both dates are equal";
						$values['performance_timing'] = 'Equal';
					}
				}else if($values['performance_timing'] != '0000-00-00' && $values['status'] == 'Not completed')
				{
					$today = TODAY;
					$due_date_time = strtotime($values['due_date_time']);
					$completed_date_time = strtotime($values['completed_date_time']);
					if($today < $values['due_date_time'])
					{
						$date_result['status'] = "Over Due";
						// $date_result['time'] = '+';
						$date_result['time'] = '+'.$this->dateDiff($today, $values['due_date_time']) . "\n";
						$values['performance_timing'] = '-'.$this->dateDiff($today, $values['due_date_time']) . "\n";
					}else if($today > $values['due_date_time']){
						$date_result['status'] = "Not Over Dued";
						// $date_result['time'] = '-';
						$date_result['time'] = '-'.$this->dateDiff($today, $values['due_date_time']) . "\n";
						$values['performance_timing'] = '+(Over due)'.$this->dateDiff($today, $values['due_date_time']) . "\n";
					}else{
						$date_result['time'] = '==';
						$date_result['status'] = "Both dates are equal";
						$values['performance_timing'] = 'Equal';
					}
				
				}else if($values['performance_timing'] == '0000-00-00' && $values['status'] == 'Completed')
				{
					$values['performance_timing'] = "";
				}
				$result_data['aaData'][] = $values;
			}
			/* foreach($result_datas['aaData'] as $name => $values)
			{
				if($values['due_date'] == '0/0/0000')
				{
					$values['due_date'] = '';
				}
				$result_data['aaData'][] = $values;
			} */
			// echo '<pre>';print_r($result_data);exit;
		}
		
		// File export request  
		if($result['data']['fetch_type'] == 'export')
		{
			//$field_list_array = array('title','priority','assignedto','due_date','creator','tags');
			$field_list_array = (isset($field_names)?$field_names:array());
			
			// Export file header column 
			//$export_array['header'][0] = array('Title','Priority','Assigned to','Due','Created by','Tag'); 
			$export_array['header'][0] = (isset($datatable_headers)?$datatable_headers:array());
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
			
			echo array_to_export($export_array,'uni_Tasklist.xls','xls');exit;
		}

		// The following parameters required for data table

		if($result_datas['status'] == FALSE)
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
		// echo '<pre>';print_r($result_data);exit;
		$this->Mod_task->response($result_data);
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
				$result = $this->Mod_task->destroy_session($result['data']);
			}
			$this->Mod_task->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/** 
	* Get Time zones
	* 
	* @method: get_timezone 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by : chandru 
	* url encoded : dgxf1Fzay9nZXRfdgxf1ltZXpvbmUv
	*/
	public function get_timezone()
	{
		// Fetch timezone to display
		$timezone = $this->Mod_timezone->get_timezone();
		$args = array('classification'=>'user_date_format');
		$date_format_array = $this->Mod_general_value->get_general_value($args);
		$datetime_array = array('last_login_time', 'last_logout_time');
		$date_array = array('created_on', 'modified_on');
		
		$this->db->select('first_name, last_login_time AS last_login_time_before_format, last_logout_time AS logout_time_before_format, '.$this->Mod_user->format_user_datetime($datetime_array).', created_on AS created_on_before_format, modified_on AS modified_on_before_format, '.$this->Mod_user->format_user_datetime($date_array,"date"), false);
		$this->db->from(UB_USER);
		$this->db->where(array('ub_user_id' => 3));
		$res = $this->db->get();
		if($res->num_rows() > 0)
		{
			echo '<pre>';print_r($res->result_array());exit;
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
			
			if(!empty($unserialized_data['priority']))
			{
					$search_session_array['priority'] =$unserialized_data['priority'];
			}
			if(!empty($unserialized_data['fromandto']))
			{
				$search_session_array['daterange'] =$unserialized_data['fromandto'];
			}
			if(!empty($unserialized_data['status']))
			{
				$search_session_array['status'] =$unserialized_data['status'];
			}
			if(!empty($unserialized_data['related_to_me']))
			{
				$search_session_array['related_to_me'] =$unserialized_data['related_to_me'];
			}
			if(!empty($unserialized_data['assigned_to']))
			{
				$search_session_array['assigned_to'] =$unserialized_data['assigned_to'];
			}
			if(!empty($unserialized_data['tags']))
			{
				$search_session_array['tags'] =$unserialized_data['tags'];
			}
			//$this->session->set_userdata('ACCOUNT', $this->account_session);
			$this->uni_set_session('search', $search_session_array);
			$this->Mod_task->response($result_data);
			}
		}
	/* Apply Filter code Ends here */
	}
	/** 
	* Insert General value
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	*/
	public function update_general_value_table()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			$args = array('classification'=>'task_tags', 'type' => 'add' ,'value' => $result['data']['tag']['tag']);
		    $result = $this->Mod_general_value->update_general_value($args);
		    $this->Mod_general_value->response($result);
		}
	}
	
	//Drop down code
	public function get_drop_down()
	{
		$ub_project_id = trim($this->input->post('ub_project_id'));
		$all_type_users = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$ub_project_id, 'account_type' => 'all', 'dropdown_type' => 'optgroup'));
		$response = $this->load->view("content/task/assigned_to.php", array('all_type_users'=>$all_type_users), true);
		echo $response; exit;
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
	public function new_comments()
	{
		if(!empty($this->input->post()))
		{
			//$this->encrypt_key = 'XYZ!@#$%';
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{	
				$post_data = array(
					'comments' => $result['data']['comments'],
					'project_id' => $result['data']['project_id'],
					'show_sub' => $result['data']['show_sub'],
					'show_owner' => $result['data']['show_owner'],
					'module_pk_id' => $result['data']['task_id'],
					'builder_id' => $this->user_session['builder_id'],
					'created_on' => TODAY,
					'created_by' => $this->user_session['ub_user_id'],
					'modified_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'],
					'module_name' => $this->module
					);
				
				$response = $this->Mod_comment->add_comment($post_data);
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
	* Delete TASK
	* 
	* @method: delete_tasks 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: chandru
	*/
	public function delete_tasks()
	{		
		
		$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$response = $this->Mod_task->delete_tasks($result['data']);

				$respoce_array = $this->get_task_pagination($page_count = 'result_array');
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
				$this->Mod_task->response($result);
			}
			$a = $this->Mod_task->response($response);
			echo '<pre>';print_r($a);exit;
	}
	
	/** 
	* Give Notification
	* 
	* @method: send_notify 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
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
			  		$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.project_id',
								'value'=> $result['data']['project_id'], 
								'type' => '='
							);
			  		$where_str = $this->Mod_task->build_where($post_array);
				  	$result_data = $this->Mod_task->get_userinfo(array(
									'select_fields' => array('PROJECT_ASSIGNED_USERS.project_id','PROJECT_ASSIGNED_USERS.role_id',
										'PROJECT_ASSIGNED_USERS.assigned_to','USER.first_name','USER.primary_email','USER.ub_user_id'),
									'join'=> array('user'=>'Yes'),
									'where_clause' => $where_str
													),$result['data']['title'],$result['data']['task_id'],$result['data']['comment']);
			        // Response data
			        $this->Mod_task->response($result_data);
			  	}
		  	}
	 	}
	}
	
	//import selections from template
	public function import_task()
	{
		$result = $this->sanitize_input();
		$template_estimate_info = $this->Mod_template->get_template_task(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		if($template_estimate_info['status'] == TRUE)
		{
			$estimate_data = $template_estimate_info['aaData'];
			foreach ($estimate_data as $key => $value)
			{
				$value['project_id'] = $this->project_id;
				$value['on_or_before'] = $value['before_or_after'];
				unset($value['ub_template_task_id']);
				unset($value['task_id']);
				unset($value['template_id']);
				unset($value['before_or_after']);
				$this->Mod_task->add_task($value);
			}
			
				$template_checklist_info = $this->Mod_template->get_template_checklists(array(
								'select_fields' => array('*'),
								'where_clause' => array('template_id' => $result['data']['template_id'])
								));
				if($template_checklist_info['status'] == TRUE)
				{
					$estimate_datas = $template_checklist_info['aaData'];
					foreach ($estimate_datas as $key => $values)
					{
					$values['project_id'] = $this->project_id;
					unset($values['ub_template_task_checklist_id']);
					unset($values['template_task_id']);
					unset($values['template_id']);
					$this->Mod_task->add_checklist_template($values);
					}
				}
	     } 
		$this->Mod_task->response($template_estimate_info);
	}
	
	/* Date time difference */
	public function dateDiff($time1, $time2, $precision = 6)
{
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
        $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
        $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
        $ttime = $time1;
        $time1 = $time2;
        $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array(
        'year',
        'month',
        'day',
        'hour',
        'minute',
        'second'
    );
    $diffs     = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
        // Create temp time from time1 and interval
        $ttime  = strtotime('+1 ' . $interval, $time1);
        // Set initial values
        $add    = 1;
        $looped = 0;
        // Loop until temp time is smaller than time2
        while ($time2 >= $ttime) {
            // Create new temp time from time1 and interval
            $add++;
            $ttime = strtotime("+" . $add . " " . $interval, $time1);
            $looped++;
        }

        $time1            = strtotime("+" . $looped . " " . $interval, $time1);
        $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
        // Break if we have needed precission
        if ($count >= $precision) {
            break;
        }
        // Add value and interval
        // if value is bigger than 0
        if ($value > 0) {
            // Add s if value is not 1
            if ($value != 1) {
                $interval .= "s";
            }
            // Add value and interval to times array
            $times[] = $value . " " . $interval;
            $count++;
        }
    }

    // Return string with times
    return implode(", ", $times);
}
/** 
	* get_schedule_date
	* 
	* @method: get_schedule_date 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_schedule_date()
	{
		$result = $this->sanitize_input();
		
		//New
		$result_schedule = $this->Mod_schedule->get_schedules(array(
								'select_fields' => array('SCHEDULE.start_date','SCHEDULE.end_date'),
								'where_clause' => array('SCHEDULE.ub_schedule_id' => $result['data']['schedule_id'])
								));	
		//print_r($result_schedule);
		if($result['data']['before_or_after'] == 'After')
		{
			
            $result['data']['number_days'] = $result['data']['number_days'];
		}
		if($result['data']['before_or_after'] == 'Before')
		{
            $result['data']['number_days'] = '-'.$result['data']['number_days'];
            $result_schedule['aaData'][0]['end_date'] = $result_schedule['aaData'][0]['start_date'];
		}
		$schedule_array = array(
			'builder_id' => $this->builder_id,
			'project_id' => $result['data']['project_id'],
			'start_date' => $result_schedule['aaData'][0]['end_date'],
			'no_of_days' => $result['data']['number_days']
			);
		$results = $this->Mod_schedule->get_end_date($schedule_array);
		$data['end_date'] = $results['end_date'];
		$this->Mod_task->response($data);
		//print_r($results);exit;
		
		
		
		
	}

	/** 
	* Get Task Pagination
	* 
	* @method: get_project_pagination 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @author: Sidhartha
	*/	
	public function get_task_pagination($page_count = '')
	{
		
		if(!empty($this->input->post()))
		{
			$where_str = '';
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Getting data of a particular builder
				$post_array[] = array(
							'field_name' => 'TASK.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
				/* "ISDELETED" condition checking 06-10-2015 added by chandru */
				$post_array[] = array(
						'field_name' => 'TASK.is_delete',
						'value' => 'No',
						'type' => '='
					);
				if(!empty($this->project_id))
				{
					$post_array[] = array(
									'field_name' => 'TASK.project_id',
									'value'=> $this->project_id, 
									'type' => '='
								);
				}
				else
				{
					$post_array[] = array(
									'field_name' => 'TASK.project_id',
									'value'=> $this->users_project_ids, 
									'type' => '||',
									'classification' => 'primary_ids'
								);
				}
				if(isset($this->uni_session_get('SEARCH')['assigned_to']))
				{
					$post_array[] = array(
								'field_name' => 'TASK_ASSIGNED_USERS.assigned_to',
								'value'=> $this->uni_session_get('SEARCH')['assigned_to'], 
								'type' => '='
							);
				}
				if(isset($this->uni_session_get('SEARCH')['priority']))
				{
					$post_array[] = array(
								'field_name' => 'TASK.priority',
								'value'=> $this->uni_session_get('SEARCH')['priority'], 
								'type' => '='
							);
					
				}
				if(isset($this->uni_session_get('SEARCH')['status']))
				{
					$post_array[] = array(
								'field_name' => 'TASK.status',
								'value'=> $this->uni_session_get('SEARCH')['status'], 
								'type' => '='
							);
					//$search_session_array['status'] = $result['data']['status'];
					// Set value in session
				}
				if(isset($this->uni_session_get('SEARCH')['tags']))
				{
					
					$post_array[] = array(
								'field_name' => 'TASK.tags',
								'value'=> $this->uni_session_get('SEARCH')['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					//$search_session_array['tags'] = $result['data']['tags'];	
				}
				if(isset($this->uni_session_get('SEARCH')['daterange']))
                {
                    $formatted_date = explode(" ",$this->uni_session_get('SEARCH')['daterange']);
                    $post_array[] = array(
                                        'field_name' => 'TASK.due_date',
                                        'from'=> date("Y-m-d", strtotime($formatted_date[0])),
                                        'to'=> date("Y-m-d", strtotime($formatted_date[2])),
                                        'type' => 'daterange'
                                        );
					//$search_session_array['daterange'] = $result['data']['daterange'];
				}
				if(isset($this->uni_session_get('SEARCH')['related_to_me']) && $this->uni_session_get('SEARCH')['related_to_me']!='' && $this->uni_session_get('SEARCH')['related_to_me'] != 'null')
				{
					if($this->uni_session_get('SEARCH')['related_to_me'] == 'created_by_me')
					{
					$post_array[] = array(
								'field_name' => 'TASK.created_by',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '='
							);
					//$search_session_array['related_to_me'] = $result['data']['related_to_me'];	
					}
					elseif($this->uni_session_get('SEARCH')['related_to_me'] == 'assigned_by_me')
					{
					$post_array[] = array(
								'field_name' => 'TASK_ASSIGNED_USERS.assigned_to',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '='
							);
					//$search_session_array['related_to_me'] = $result['data']['related_to_me'];
					// Set value in session
					}
					elseif($this->uni_session_get('SEARCH')['related_to_me'] == 'created_by_me,assigned_by_me')
					{
					$post_array[] = array(
								'field_name' => 'TASK_ASSIGNED_USERS.assigned_to',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '='
							);
					//$search_session_array['related_to_me'] = $result['data']['related_to_me'];
					}
		
				}
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				
				/*
					Paggination length stored in seesion code start here
				*/
				
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
				
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				//echo "<pre>";print_r($post_array);exit;
				
				//echo $where_str;
				//code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('task')][strtolower('view all')]) && $this->user_role_access[strtolower('task')][strtolower('view all')] == 0)
				{
					if(isset($this->user_role_access[strtolower('task')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('task')][strtolower('view assigned to me')] == 1 || $this->user_account_type == SUBCONTRACTOR)
					{
					$post_array[] = array(
									'field_name' => 'TASK.task_assigned_users',
									'value'=> $this->user_id, 
									'type' => '||',
									'classification' => 'dynamnic_text'
									);
					}
					else
					{
					$post_array[] = array(
									'field_name' => 'TASK.created_by',
									'value'=> 0, 
									'type' => '=',
									);
					}
				}
				$where_str = $this->Mod_task->build_where($post_array);
				//echo '<pre>';print_r($where_str);exit;
				// Pagination argument
				$pagination_array = array();
				//echo '<pre>';print_r($result['data']['iDisplayStart']);exit;
				if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
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
					// Get formatted sort name
					$format_sort_name = $this->Mod_task->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'TASK.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
				}
				else
				{
					$order_by_where = 'TASK.modified_on DESC';
				}
				//$date_array = array('LOG.log_date'=>'log_date');
				// Fetch argument building
				
                // Fetch argument building
                $log_args = array('select_fields' => array('TASK.ub_task_id','TASK.title'),
                'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$result_data = $this->Mod_task->get_task($log_args);
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
					$total_count_array = $this->Mod_task->get_task(array(
												'select_fields' => array('COUNT(TASK.ub_task_id) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_task->response($result_data);
			}
			else
			{
				$this->Mod_task->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_project->response($result);
		}
	}
}