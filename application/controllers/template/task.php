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

		$this->load->model(array('Mod_task','Mod_general_value','Mod_timezone','Mod_user','Mod_saved_search', 'Mod_project','Mod_comment','Mod_reminder','Mod_message','Mod_notification','Mod_builder','Mod_grid_settings','Mod_doc','Mod_template','Mod_template_task'));
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
		$this->module = 'TEMP_TASK';
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
		'content'      => 'template/content/task/task',
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
		//$data['grid_settings_popup']=$this->uni_get_grid_settings_popup_info();	
		//$data['datatable_headers']=$data['grid_settings_popup']['datatable_headers'];
		//unset($data['grid_settings_popup']['datatable_headers']); 
		
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
			$this->Mod_template_task->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	public function save_task($ub_template_task_id = 0)
	{
		$results = $this->sanitize_input();
		$result_data = array(); 
		// echo '<pre>';print_r($results);exit;
		// Load add page code starts here   
		$data = array(
		'title'        => "TASK",		
		'content'      => 'template/content/task/save_task',
		'drop_upload'  => 'drop_upload',
        'page_id'      => 'task',
		'date_all'	   => 'date_all' 
		);
		
		//get project id from task table // by satheesh kumar
		if(empty($this->template_id) && $ub_template_task_id > 0)
		{
		$where_args = array('ub_template_task_id' => $ub_template_task_id);
		$project_id = $this->Mod_project->get_project_id(UB_TEMPLATE_TASK,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		}
		//end code for get project id
		
		//Get all projects list from project table with the builder_id
		$template_list = $this->Mod_template->get_template(array(
					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),
					'where_clause' => array('TEMPLATE.builder_id'=> $this->builder_id)
					)); 
		$data['template_list']=array();
		if(TRUE === $template_list['status'])
		{
			$data['template_list'] = $this->Mod_task->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name');
		} 
		
		if($ub_template_task_id > 0 || isset($results['data']['ub_task_id']) && $results['data']['ub_task_id'] > 0)
		{
			/*Code for update file */
				if(!empty($this->input->post()))
				 {
					$results = $this->sanitize_input();
					// echo '<pre>dsd';print_r($results);exit;
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
					$checklist_description_checkbox = "";
					 if(isset($results['data']['checklist_mark_hidden']))
					 {
						$checklist_description_checkbox = $results['data']['checklist_mark_hidden'];
					 }
					 // echo '<pre>';print_r($results);exit;
					$task_insert_main_array = array(
						'title' => $results['data']['title'],
						'note' => $results['data']['task_note'],
						'due_date' => $results['data']['due_date'],
						'due_time' => $time,
						'priority' => $results['data']['priority'],
						'tags' => $tags,
						'description' => $results['data']['checklist_description'],
						'description_mark_complete_status' => $checklist_description_checkbox,
						'mark_complete_status' => $results['data']['marked-list'],
						'checklist_description_id' => $results['data']['checklist_description_id'],
						'created_on' => $results['data']['created_on'],
						'modified_by' => $this->user_session['ub_user_id'], 
						'modified_on' => TODAY,
						'ub_template_task_id'=>$results['data']['ub_task_id'],
						'template_id'=>$results['data']['template_id']
						);
						$response = $this->Mod_template_task->update_task($task_insert_main_array);
						$this->Mod_template_task->response($response);
				 }
				 else
				{
				$result_data = $this->Mod_template->get_template_task(array(
				'select_fields' => array('UB_TEMPLATE_TASK.ub_template_task_id', 'UB_TEMPLATE_TASK.builder_id', 'UB_TEMPLATE_TASK.template_id',
				'UB_TEMPLATE_TASK.note', 'UB_TEMPLATE_TASK.title','UB_TEMPLATE_TASK.tags','UB_TEMPLATE_TASK.due_date','UB_TEMPLATE_TASK.priority','UB_TEMPLATE_TASK.due_time','Group_concat(UB_TEMPLATE_TASK_CHECKLIST.ub_template_task_checklist_id) as check_list_id','Group_concat(UB_TEMPLATE_TASK_CHECKLIST.template_task_id) as task_id','Group_concat(UB_TEMPLATE_TASK_CHECKLIST.Description) as description','Group_concat(UB_TEMPLATE_TASK_CHECKLIST.mark_complete_status) as description_checkbox','UB_TEMPLATE_TASK.mark_complete_status','UB_TEMPLATE_TASK.created_on'),
				//'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
				'join'=> array('builder'=>'Yes','task_checklist'=>'Yes'),
				'where_clause' => (array('UB_TEMPLATE_TASK.ub_template_task_id' =>  $ub_template_task_id))
				));
				// echo '<pre>';print_r($result_data);exit;
				$data['result_data']  = $result_data;
				
				 
			   }
		}
		else
		{
		  $post_data = array();
		  if(!empty($this->input->post()))
		  {
			$results = $this->sanitize_input();
			// echo '<pre>';print_r($results);exit;
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
			$task_insert_main_array = array(
			'title' => $results['data']['title'],
			'note' => $results['data']['task_note'],
            'mark_complete_status' => $results['data']['marked-list'],
            'builder_id' => $this->user_session['builder_id'],
            'description' => $checklist_description,
            'description_mark_complete_status' => $checklist_description_checkbox,
            'priority' => $results['data']['priority'],
            'due_date' => $due_date,
            'due_time' => $time,
            'tags' => $tags,
            'status' => 'Not completed',
            'created_by' => $this->user_session['ub_user_id'],
            'created_on' => TODAY,
            'modified_by' => $this->user_session['ub_user_id'], 
            'modified_on' => TODAY,
			);
			// echo '<pre>';print_r($task_insert_main_array);exit;
			$response = $this->Mod_template_task->add_template_task($task_insert_main_array);
			//print_r($response);
			$this->Mod_task->response($response);
			
		  }
		}
		 //Fetch priority
		$args = array('classification'=>'task_priority', 'type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['task_priority'] = $result['values'];
		//Fetch all tags
		$args = array('classification'=>'task_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['task_tags'] = $result['values'];
		
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
	public function get_task($page_count = '')
	{
		$post_array[] = array(
							'field_name' => 'UB_TEMPLATE_TASK.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		if(!empty($this->template_id))
		{
			$post_array[] = array(
							'field_name' => 'UB_TEMPLATE_TASK.template_id',
							'value'=> $this->template_id, 
							'type' => '='
						);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'UB_TEMPLATE_TASK.template_id',
							'value'=> $this->users_template_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo '<pre>';print_r($result);
			if(TRUE === $result['status'])
			{
				// Search Input Array
				//All selected priority field
				$search_session_array = array();
				if(isset($result['data']['priority']) && $result['data']['priority']!='' && $result['data']['priority'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'UB_TEMPLATE_TASK.priority',
								'value'=> $result['data']['priority'], 
								'type' => '='
							);
					//Modified session code
					 $search_session_array['priority'] = $result['data']['priority'];
				}
				//No task tag filter field
				 if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
				{
					if(!is_array($result['data']['tags']))
					{
					$post_array[] = array(
								'field_name' => 'UB_TEMPLATE_TASK.tags',
								'value'=> $result['data']['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['tags'] = $result['data']['tags'];	
					}
				} 
				//New date code
				if(isset($result['data']['daterange']) && $result['data']['daterange']!='' && $result['data']['daterange'] != 'null')
                {
                    $formatted_date = explode(" ",$result['data']['daterange']);
                    $post_array[] = array(
                                        'field_name' => 'UB_TEMPLATE_TASK.due_date',
                                        'from'=> date("Y-m-d", strtotime($formatted_date[0])),
                                        'to'=> date("Y-m-d", strtotime($formatted_date[2])),
                                        'type' => 'daterange'
                                        );
					$search_session_array['daterange'] = $result['data']['daterange'];
				}
				// Setting session 
				$this->module = 'TEMP_TASK';

				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('SEARCH')['priority']))
				    {
					  $post_array[] = array(
								'field_name' => 'UB_TEMPLATE_TASK.priority',
								'value'=> $this->uni_session_get('SEARCH')['priority'], 
								'type' => '='
							);
					
				    }
				    if(isset($this->uni_session_get('SEARCH')['tags']))
				    {
					  $post_array[] = array(
								'field_name' => 'UB_TEMPLATE_TASK.tags',
								'value'=> $this->uni_session_get('SEARCH')['tags'], 
								'type' => '='
							);
					
				    }
				    if(isset($this->uni_session_get('SEARCH')['daterange']))
				    {
					  $formatted_date = explode(" ",$this->uni_session_get('SEARCH')['daterange']);
                      $post_array[] = array(
                                        'field_name' => 'UB_TEMPLATE_TASK.due_date',
                                        'from'=> date("Y-m-d", strtotime($formatted_date[0])),
                                        'to'=> date("Y-m-d", strtotime($formatted_date[2])),
                                        'type' => 'daterange'
                                        );
					
				    }
				}

				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];

				$this->uni_set_session('search', $search_session_array);
				//$this->session->set_userdata('ACCOUNT', $this->account_session);
				$where_str = $this->Mod_template->build_where($post_array);
				//echo '<pre>';print_r($where_str);exit;
				// Pagination Array
				$pagination_array = array();

				if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);

					 $total_count_array = $this->Mod_template->get_template_task(array(
												'select_fields' => array('COUNT(UB_TEMPLATE_TASK.ub_template_task_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes')
												));	 
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					 $total_count_array = $this->Mod_template->get_template_task(array(
												'select_fields' => array('COUNT(UB_TEMPLATE_TASK.ub_template_task_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes')
												));	 
				}

				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
				    $total_count_array = $this->Mod_template->get_template_task(array(
												'select_fields' => array('COUNT(UB_TEMPLATE_TASK.ub_template_task_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes')
												));	 	
				}*/
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'UB_TEMPLATE_TASK.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'UB_TEMPLATE_TASK.ub_template_task_id DESC';
				}
			}
			else
			{
				$this->Mod_role->response($result);
			}
		}
		$date_array = array('UB_TEMPLATE_TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('UB_TEMPLATE_TASK.ub_template_task_id','UB_TEMPLATE_TASK.title', 'UB_TEMPLATE_TASK.priority', 'UB_TEMPLATE_TASK.modified_by', 'UB_TEMPLATE_TASK.modified_on', 'UB_TEMPLATE_TASK.due_date', 'UB_TEMPLATE_TASK.created_by', 'UB_TEMPLATE_TASK.tags','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator','UB_TEMPLATE_TASK.status,'
		.$this->Mod_user->format_user_datetime($date_array,"date")),
								'join'=> array('builder'=>'Yes'),
								'where_clause' => $where_str,
								'order_clause' => $order_by_where, 
								'pagination' => $pagination_array,
								'group_clause' => array("UB_TEMPLATE_TASK.ub_template_task_id") 
		);
        $result_data = $this->Mod_template->get_template_task($query_array);
        if($page_count == 'result_array')
		{
		  //print_r($result_data);exit;
		  return $result_data;
		}
		// echo '<pre>';print_r($result_data);exit;
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
		// echo '<pre>';print_r($result_data);exit;
		$this->Mod_template->response($result_data);
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
		// echo '<pre>';print_r($result);exit;
			if(TRUE === $result['status'])
			{
				$response = $this->Mod_template_task->delete_tasks($result['data']);
				$respoce_array = $this->get_task($page_count = 'result_array');
				//echo '<pre>';print_r($respoce_array);exit;
				if($respoce_array['status'] == FALSE)
				{
					$this->module = 'TEMP_TASK';
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
				$this->Mod_task->response($result);
			}
			$this->Mod_task->response($response);
		
	}
	
}