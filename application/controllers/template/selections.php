<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Selection Class
 * 
 * @package: Selection
 * @subpackage: Selection
 * @category: Selection
 * @author: Chandru 
 * @createdon(DD-MM-YYYY): 30-04-2015 
*/
class Selections extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_warranty','Mod_general_value','Mod_timezone','Mod_user','Mod_saved_search','Mod_project','Mod_subcontractor','Mod_selections','Mod_comment','Mod_builder','Mod_notification','Mod_reminder','Mod_message','Mod_doc','Mod_template','Mod_template_selection'));	
    }
	public function index()
	{
	    $this->module = 'SELECTIONS';
		$user_id_from_session = $this->user_session['ub_user_id'];
		$data = array(
		'title'        		 => "Selections",		
		'content'     		 => 'template/content/selections/selections',
        'page_id'      		 => 'selections',
		'data_table'   		 => 'data_table',		     
		'selection_category' => 'selection_category',      
		'selection_location' => 'selection_location',      
		'selection_list'	 => 'selection_list', 
        'search_session_array' => $this->uni_session_get('search'),		 
		'date_all'	   		 => 'date_all'      
		);
		// echo '<pre>';print_r($data);exit;
		//Get category from general value table
		$category_args = array('classification'=>'selection_category', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$category_result = $this->Mod_general_value->get_general_value($category_args);
		$data['category_array'] = $category_result['values'];
		//Get Locations from general value table
		$location_args = array('classification'=>'selction_location', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$locations_result = $this->Mod_general_value->get_general_value($location_args);
		$data['locations_array'] = $locations_result['values'];
		//Get category from general value table
		$status_args = array('classification'=>'selection_status', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$status_result = $this->Mod_general_value->get_general_value($status_args);
		$data['status_array'] = $status_result['values'];

		//list all sub_contractors
		 $subcontractor_list = $this->Mod_user->get_users(array(
					'select_fields' => array('USER.subcontractor_id','CONCAT(first_name," ",last_name) as fullname','USER.ub_user_id'),
           'where_clause' => (array('USER.builder_id' =>  $this->user_session['builder_id'],'USER.account_type'=>'300'))
					));
	    $data['subcontractor_list']=array();
		//echo '<pre>';print_r($subcontractor_list);exit;
	    if(TRUE === $subcontractor_list['status'])
		{
			$data['subcontractor_list'] = $this->Mod_subcontractor->build_ci_dropdown_array($subcontractor_list['aaData'],'subcontractor_id', 'fullname');
		}
		
		$this->template->view($data);
	}	
	
	
	/** 
	 * Selection Class
	 * 
	 * @package: Save_Selection
	 * @subpackage: Save_Selection
	 * @category: Save_Selection
	 * @author: Chandru 
	 * @createdon(DD-MM-YYYY): 30-04-2015 
	*/
	public function save_selection($ub_selection_id = 0)
	{
		$data = array(
		'title'        		 => "Selections",		
		'content'     		 => 'template/content/selections/newselection',
		'page_id'      		 => 'selections'
		);
		$results = $this->sanitize_input();
		
		/* //Get owner name
			$ub_project_id = $this->project_id;
             $owner_data = $this->Mod_project->get_projects(array(
            'select_fields' => array('PROJECT.owner_id','CONCAT_WS(" ",OWNER.first_name,OWNER.last_name) AS owner_name'),
            'join' => array('owner'=>'Yes'),
            'where_clause' => (array('ub_project_id' => $ub_project_id))
            ));
			//echo '<pre>';print_r($owner_data);exit;400
            if(TRUE === $owner_data['status'])
            {
                $data['owner_name']  = $owner_data['aaData'][0];
            }  */
		//Edit code
		// Project allowance check code added by chadnru 
		if (!empty($this->project_id)) 
		{
			$ub_project_id = $this->project_id;
             $allowance_data = $this->Mod_project->get_projects(array(
            'select_fields' => array('PROJECT.include_allowances'),
            'where_clause' => (array('ub_project_id' => $ub_project_id))
            ));
            if(TRUE === $allowance_data['status'])
            {
				if($allowance_data['aaData'][0]['include_allowances'] == 'Yes')
				{
					$data['allowance_data'] = TRUE;
				}else{
					$data['allowance_data'] = FALSE;
				}
            } 
		}else{
			$data['allowance_data'] = FALSE;
		}
		if($ub_selection_id > 0 || isset($results['data']['ub_selection_id']) && $results['data']['ub_selection_id'] > 0)
		{
			if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
				$results = $this->sanitize_input();
				if(!empty($results['data']['locations']))
				{
					$location = "".implode(",", $results['data']['locations'])."";
				}else{
					$location = '';
				}
				
				if(!empty($results['data']['category']))
				{
					$category = "".implode(",", $results['data']['category'])."";
				}else{
					$category = '';
				}
				if(!empty($results['data']['duedate_time']))
				{
					$due_time = $results['data']['duedate_time'];
					$time = date('H:i:s', strtotime($due_time));
				}else{
					$time = '';
				}
				if(!empty($results['data']['duedate_date']))
				{
					$source = $results['data']['duedate_date'];
					$date = new DateTime($source);
					$newDate = $date->format('Y-m-d');
				}else{
					$newDate = '';
				}
				$subcontractor_vendors ='';
				if(isset($results['data']['subcontractor_vendors']))
				{
				$subcontractor_vendors =$results['data']['subcontractor_vendors'];
				}
				$subcontractor_installers ='';
				if(isset($results['data']['subcontractor_installers']))
				{
				$subcontractor_installers =$results['data']['subcontractor_installers'];
				}
				if(isset($results['data']['allowance']))
				{
					$allowance_data = $results['data']['allowance'];
				}else{
					$allowance_data = '';
				}
			$update_in_selection_table_code = array(
					'builder_id' => $this->user_session['builder_id'],
					'template_id' => $results['data']['template_id'],
					'title' => $results['data']['title'],
					'category' => $category,
					'location' => $location,
					'allowance' => $allowance_data,
					'number_of_days' => 500,
					'on_or_before' => 'Before',
					'schedule_id' => 500,
					'due_date_time' => $newDate,
					'due_date' => $newDate,
					'due_time' => $time,
					'deadline_required' => isset($results['data']['owner_required']) ? "Yes" : "No",
					'allow_multiple_choice_selection' => 'Yes',
					'description' => $results['data']['public_instructions'],
					'builderuser_notes' => $results['data']['internal_notes'],
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY,
					'ub_template_selection_id'=>$results['data']['ub_selection_id']
					);
					$response = $this->Mod_template_selection->update_selections($update_in_selection_table_code);
					$this->Mod_template_selection->response($response);
			  
			  }
			 
			else
			{

			 $result_data = $this->Mod_template_selection->get_selections(array(
			'select_fields' => array('SELECTION.ub_template_selection_id','SELECTION.builder_id', 'SELECTION.template_id', 'SELECTION.project_id', 'SELECTION.title', 'SELECTION.category', 'SELECTION.location', 'SELECTION.allowance', 'SELECTION.number_of_days','SELECTION.on_or_before','SELECTION.schedule_id', 'SELECTION.due_date_time','SELECTION.due_date','SELECTION.due_time', 'SELECTION.deadline_required','SELECTION.allow_multiple_choice_selection','SELECTION.description','SELECTION.builderuser_notes', 'SELECTION.owner_id','SELECTION.owner_selection_access','SELECTION.vendor_id','SELECTION.vendor_selection_access', 'SELECTION.installer_id','SELECTION.status','SELECTION.created_by','SELECTION.reminder_id','SELECTION.created_on','USER.first_name'),
			'join' => array('user'=>'Yes','selection_choice'=>'No'),
			'where_clause' => (array('ub_template_selection_id' =>  $ub_selection_id))
			));
			//echo '<pre>';print_r($result_data);exit;
			 $data['result_data']  = $result_data['aaData'][0];
			
			/*$ub_project_id = $this->project_id;
			
			$user_list = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$ub_project_id, 'account_type' => SUBCONTRACTOR, 'assigned_type' => 'yes', 'dropdown_type' => ''));
			$subcontractor_list =array();
			if(TRUE === $user_list['status'])
			{
				$subcontractor_list = $this->Mod_warranty->build_ci_dropdown_array($user_list['aaData'],'ub_user_id', 'full_name');
			}
			$data['subcontractor_list']=  $subcontractor_list; */
			//Check the choice status
			$approved_count_data = $this->Mod_template_selection->get_selection_choice_list(array(
			'select_fields' => array('COUNT(SELECTION_CHOICE.ub_template_selection_choice_id) AS total_count'),
			'join'=> array('builder'=>'Yes'),
			'where_clause' => (array('status' =>  'Approved','SELECTION_CHOICE.template_selection_id' => $ub_selection_id))
			));
			// echo '<pre>';print_r($approved_count_data);exit;
			 $data['approved_count_data']  = $approved_count_data['aaData'][0];
		   }
		}
		else
		{
			if(!empty($this->input->post()))
			{
				$results = $this->sanitize_input();
				if(!empty($results['data']['locations']))
				{
					$location = "".implode(",", $results['data']['locations'])."";
				}else{
					$location = '';
				}
				
				if(!empty($results['data']['category']))
				{
					$category = "".implode(",", $results['data']['category'])."";
				}else{
					$category = '';
				}
				if(!empty($results['data']['duedate_time']))
					{
						$due_time = $results['data']['duedate_time'];
						$time = date('H:i:s', strtotime($due_time));
					}else{
						$time = '';
					}
					if(!empty($results['data']['duedate_date']))
					{
						$source = $results['data']['duedate_date'];
						$date = new DateTime($source);
						$newDate = $date->format('Y-m-d');
					}else{
						$newDate = '';
					}
					if(isset($results['data']['allowance']))
					{
						$allowance_data = $results['data']['allowance'];
					}else{
						$allowance_data = '';
					}
			 $insert_in_selection_table_code = array(
						'builder_id' => $this->user_session['builder_id'],
						'template_id' => $results['data']['template_id'],
						'title' => $results['data']['title'],
						'category' => $category,
						'location' => $location,
						'allowance' => $allowance_data,
						'number_of_days' => 500,
						'on_or_before' => 'Before',
						'schedule_id' => 500,
						'due_date_time' => $newDate,
						'due_date' => $newDate,
						'due_time' => $time,
						'deadline_required' => isset($results['data']['owner_required']) ? "Yes" : "No",
						'allow_multiple_choice_selection' => 'Yes',
						'description' => $results['data']['public_instructions'],
						'builderuser_notes' => $results['data']['internal_notes'],
						/* 'owner_id' => $results['data']['owner_id'],
						'owner_selection_access' => $results['data']['ownerselections'],
						'vendor_selection_access' => $results['data']['subcontractorselection'], */
						);
						// echo '<pre>';print_r($insert_in_selection_table_code);exit;
						$response = $this->Mod_template_selection->add_selections($insert_in_selection_table_code);
						$this->Mod_template_selection->response($response);
			}
		}
		//Get all projects list from project table with the builder_id
		$template_list = $this->Mod_template->get_template(array(
					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),
					'where_clause' => array('TEMPLATE.builder_id'=> $this->builder_id)
					)); 
		$data['template_list']=array();
		if(TRUE === $template_list['status'])
		{
			$data['template_list'] = $this->Mod_selections->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name');
		} 
		// echo '<pre>';print_r($data);exit;
		//Get category from general value table
		$category_args = array('classification'=>'selection_category', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$category_result = $this->Mod_general_value->get_general_value($category_args);
		$nothing_selected_array = array(''=>'Nothing Selected');
		$data['category_array'] = $nothing_selected_array + $category_result['values'];
		// print_r($data['category_array']);exit;
		//Get Locations from general value table
		$location_args = array('classification'=>'selction_location', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$locations_result = $this->Mod_general_value->get_general_value($location_args);
		$data['locations_array'] = $nothing_selected_array + $locations_result['values'];
		//echo "<pre>";print_r($data);exit;
		$this->template->view($data);
	}	
	
	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* created by : chandru 
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
	* Delete Selection
	* 
	* @method: delete_selection_data 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by : chandru
	* @created on : 14-07-2015
	*/
	public function delete_selection_data()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_template_selection->delete_selection($result['data']);

				$this->module = 'SELECTIONS';
				$search_session_array = array();

				$search_session_array['categoty_iDisplayStart'] = 0;

				$search_session_array['categoty_iDisplayLength'] = 5;

				$search_session_array['location_iDisplayStart'] = 0;

				$search_session_array['location_iDisplayLength'] = 5;

				$search_session_array['list_iDisplayStart'] = 0;

				$search_session_array['list_iDisplayLength'] = 5;

				$this->uni_set_session('search', $search_session_array);
			}
			else
			{
				$this->Mod_template_selection->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_template_selection->response($response);
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
		
		if(!empty($this->input->post()))
		{
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{	
				$post_data = array(
					'comments' => $result['data']['comments'],
					'project_id' => $result['data']['project_id'],
					'show_sub' => $result['data']['show_sub'],
					'show_owner' => $result['data']['show_owner'],
					'module_pk_id' => $result['data']['selection_id'],
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
	* Give Notification
	* 
	* @method: send_notify 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: Sidharta
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
	 * Selection Class
	 * 
	 * @package: save_selection_choices
	 * @subpackage: save_selection_choices
	 * @category: save_selection_choices
	 * @author: Chandru 
	 * @createdon(DD-MM-YYYY): 30-04-2015 
	*/

	public function save_selection_choices($ub_selection_choice_id = 0)
	{
		
		// echo '<pre>';print_r($_POST);exit;
		if(!empty($this->input->post()))
		{
			$ub_selection_choice_id = $_POST['ub_selection_choice_id'];
			//echo $ub_selection_choice_id;
		}
		$results = $this->sanitize_input();
		// echo '<pre>';print_r($results);exit;
		//echo $ub_selection_choice_id;
		if($ub_selection_choice_id > 0 || isset($results['data']['ub_selection_choice_id']) && $results['data']['ub_selection_choice_id'] > 0)
		{
			

			
			/*End Code for edit file */
			$results = $this->sanitize_input();
			// echo '<pre>';print_r($results);exit;
			if(!empty($this->input->post()) && !empty($results['data']['ub_selection_id']) )
		     {
		 	  //Sanitize input
			$update_in_selection_choices_table_code = array(
					'builder_id' => $this->user_session['builder_id'],
					'template_id' => $results['data']['template_id'],
					'template_selection_id' => $results['data']['ub_selection_id'],
					'title' => $results['data']['choice_title'],
					'standard_choice' => $results['data']['choice_standard_choice'],
					'product_url' => $results['data']['choice_product_url'],
					/* 'owner_price_tbd' => $results['data']['choice_owner_price'],
					'owner_price' => $results['data']['choice_owner_price_tbd'],
					'subcontractor_price_tbd' => $results['data']['choice_builder_cost'],
					'subcontractor_price' => $results['data']['choice_builder_cost_price'],
					'sub_pricing_comments' => $results['data']['choice_sub_pricing_comments'], */
					'description' => $results['data']['choice_description'],
					'status' => 'Pending',
					'ub_template_selection_choice_id' => $results['data']['ub_selection_choice_id']
					);
					// echo '<pre>';print_r($update_in_selection_choices_table_code);exit;
					$response = $this->Mod_template_selection->update_selection_choices($update_in_selection_choices_table_code);
					$this->Mod_template_selection->response($response);
			  
			  }
			 
			else
			{
			// Get inserted data with help of id
			 $result_data = $this->Mod_template_selection->get_selection_choice_list(array(
			'select_fields' => array('SELECTION_CHOICE.ub_template_selection_choice_id','SELECTION_CHOICE.title as choice_title', 'SELECTION_CHOICE.standard_choice', 'SELECTION_CHOICE.product_url', 'SELECTION_CHOICE.owner_price_tbd', 'SELECTION_CHOICE.owner_price', 'SELECTION_CHOICE.subcontractor_price_tbd', 'SELECTION_CHOICE.subcontractor_price','SELECTION_CHOICE.sub_pricing_comments','SELECTION_CHOICE.description','SELECTION_CHOICE.vendor_id','SELECTION_CHOICE.installer_id','SELECTION_CHOICE.status','SELECTION_CHOICE.created_on','SELECTION_CHOICE.created_by','SELECTION_CHOICE.modified_on','SELECTION_CHOICE.modified_by','date(SELECTION_CHOICE.created_on) as created_on_date'),
			'join'=> array('builder'=>'Yes'),
			'where_clause' => (array('ub_template_selection_choice_id' =>  $ub_selection_choice_id))
			));
			// echo '<pre>';print_r($result_data);exit;
			 $data['result_data']  = $result_data['aaData'][0];
			 //below two lines are added for checking role access// by satheesh kumar
			 $data['result_data']['user_id']  = $this->user_id;
			 $data['result_data']['account_type']  = $this->user_account_type;
			 $this->Mod_template_selection->response($data['result_data']);
		   }
		}
		else
		{
			$results = $this->sanitize_input();
			$insert_in_selection_choice_table_code = array(
					'builder_id' => $this->user_session['builder_id'],
					'template_selection_id' => $results['data']['ub_selection_id'],
					'template_id' => $results['data']['template_id'],
					'title' => $results['data']['choice_title'],
					'standard_choice' => $results['data']['choice_standard_choice'],
					'product_url' => $results['data']['choice_product_url'],
					/* 'owner_price_tbd' => $results['data']['choice_owner_price'],
					'owner_price' => $results['data']['choice_owner_price_tbd'],
					'owner_id' => $results['data']['owner_id'],
					'subcontractor_price_tbd' => $results['data']['choice_builder_cost'],
					'subcontractor_price' => $results['data']['choice_builder_cost_price'],
					'sub_pricing_comments' => $results['data']['choice_sub_pricing_comments'], */
					'description' => $results['data']['choice_description']
					);
					// echo '<pre>';print_r($insert_in_selection_choice_table_code);exit;
					$response = $this->Mod_template_selection->add_selection_choices($insert_in_selection_choice_table_code);
					//print_r($response);exit;
					$this->Mod_template_selection->response($response);
		}
	}
	/** 
	 * Selection Class
	 * 
	 * @package: get_selection_choices
	 * @subpackage: get_selection_choices
	 * @category: get_selection_choices
	 * @author: Chandru 
	 * @createdon(DD-MM-YYYY): 30-04-2015 
	*/
	public function get_selection_choices()
	{
		$result = $this->sanitize_input();
		//echo '<pre>';print_r($result['data']['ub_selection_choice_ids']);exit;
		$post_array[] = array(
							'field_name' => 'SELECTION_CHOICE.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		$post_array[] = array(
								'field_name' => 'SELECTION_CHOICE.template_selection_id',
								'value'=> $result['data']['ub_selection_choice_ids'], 
								'type' => '='
							);
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			if(TRUE === $result['status'])
			{
				// Tags search input
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$where_str = $this->Mod_selections->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					// echo '<pre>';print_r($where_str);exit;
					 $total_count_array = $this->Mod_template_selection->get_selection_choice_list(array(
												'select_fields' => array('COUNT(SELECTION_CHOICE.ub_template_selection_choice_id) AS total_count'),
												'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
					// echo '<pre>';print_r($total_count_array);exit;								
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					//echo $result['data'][$dt_filed_name.$sort_filed_column_id];
					$order_by_where = 'SELECTION_CHOICE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				
			}
			else
			{
				$this->Mod_template_selection->response($result);
			}
		}
		// Fetch date format to display	
		$timezone = $this->Mod_timezone->get_timezone();		
		$args = array('classification'=>'user_date_format');
		$date_format_array = $this->Mod_general_value->get_general_value($args);
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('SELECTION_CHOICE.ub_template_selection_choice_id','SELECTION_CHOICE.title as choice_title', 'SELECTION_CHOICE.standard_choice', 'SELECTION_CHOICE.product_url', 'SELECTION_CHOICE.owner_price_tbd', 'SELECTION_CHOICE.owner_price', 'SELECTION_CHOICE.subcontractor_price_tbd', 'SELECTION_CHOICE.subcontractor_price','SELECTION_CHOICE.sub_pricing_comments','SELECTION_CHOICE.description','SELECTION_CHOICE.vendor_id','SELECTION_CHOICE.installer_id','SELECTION_CHOICE.status','SELECTION_CHOICE.created_on','SELECTION_CHOICE.created_by','SELECTION_CHOICE.modified_on','SELECTION_CHOICE.modified_by','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator'),
		'join'=> array('builder'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		$result_data = $this->Mod_template_selection->get_selection_choice_list($query_array);
		// echo '<pre>';print_r($result_data);exit;
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
		$this->Mod_template_selection->response($result_data);
	}
	
	
	/** 
	 * Selection Class
	 * 
	 * @package: get_selections
	 * @subpackage: get_selections
	 * @category: get_selections
	 * @author: Chandru 
	 * @createdon(DD-MM-YYYY): 30-04-2015 
	*/
	public function get_selections()
	{
		$post_array[] = array(
							'field_name' => 'SELECTION.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		if(!empty($this->template_id))
		{
			$post_array[] = array(
							'field_name' => 'SELECTION.template_id',
							'value'=> $this->template_id, 
							'type' => '='
						);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'SELECTION.template_id',
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
			// echo '<pre>';print_r($result);exit;
			if(TRUE === $result['status'])
			{
			$search_session_array = array();
			 if(isset($result['data']['status']) && $result['data']['status']!='' && $result['data']['status'] != 'null')
			 // echo '<pre>';print_r($result['data']['status']);exit;
			 {
						$post_array[] = array(
								'field_name' => 'SELECTION.status',
								'value'=> $result['data']['status'], 
								'type' => '='
							);

					// Set value in session
					 $search_session_array['status'] = $result['data']['status'];
			 }
			/*  if(isset($result['data']['vendors']) && $result['data']['vendors']!='' && $result['data']['vendors'] != 'null')
			 {
						$post_array[] = array(
								'field_name' => 'SELECTION.vendor_id',
								'value'=> $result['data']['vendors'], 
								'type' => '='
							);
                     // echo '<pre>';print_r($post_array);
					// Set value in session
					 $search_session_array['vendors'] = $result['data']['vendors'];
			 } */
			  if(isset($result['data']['location']) && $result['data']['location']!='' && $result['data']['location'] != 'null')
			 {
						$post_array[] = array(
								'field_name' => 'SELECTION.location',
								'value'=> $result['data']['location'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);

					// Set value in session
					 $search_session_array['location'] = $result['data']['location'];
			 }
			  if(isset($result['data']['categories']) && $result['data']['categories']!='' && $result['data']['categories'] != 'null')
			 {
						$post_array[] = array(
								'field_name' => 'SELECTION.category',
								'value'=> $result['data']['categories'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);

					// Set value in session
					 $search_session_array['category'] = $result['data']['categories'];
			 }
			  if(isset($result['data']['daterange']) && $result['data']['daterange']!='')
				{
					
					$formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' => 'SELECTION.due_date',
										'from'=> date("Y-m-d", strtotime($formatted_date[0])),
										'to'=> date("Y-m-d", strtotime($formatted_date[2])),
										'type' => 'daterange'
									      );   
								 // echo '<pre>';print_r($formatted_date);exit;	
								 // echo '<pre>';print_r($result);exit;	
						$search_session_array['daterange'] = $result['data']['daterange'];
				}
				if(isset($result['data']['title']) && $result['data']['title']!='' && $result['data']['title'] != 'null')
			 {
						$post_array[] = array(
								'field_name' => 'SELECTION.title',
								'value'=> $result['data']['title'], 
								'type' => '='
							);

					// Set value in session
					$search_session_array['title'] = $result['data']['title'];
			 }

			 if($result['data']['tab_type'] == 'category')
				{
					$search_session_array['categoty_iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['categoty_iDisplayStart'];

				    $search_session_array['categoty_iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['categoty_iDisplayLength'];
				}
				if($result['data']['tab_type'] == 'location')
				{
					$search_session_array['location_iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['location_iDisplayStart'];

				    $search_session_array['location_iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['location_iDisplayLength'];
				}
				if($result['data']['tab_type'] == 'list')
				{
					$search_session_array['list_iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['list_iDisplayStart'];

				    $search_session_array['list_iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['list_iDisplayLength'];
				}

			 // Setting session 
				$this->uni_set_session('search', $search_session_array);

              				
				// Tags search input
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				//echo '<pre>';print_r($post_array);exit;
				$where_str = $this->Mod_selections->build_where($post_array);
				// echo '<pre>';print_r($where_str);exit;
				// Pagination Array
				$tab_type="categoty";
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					 if(isset($result['data']['tab_type']) && $result['data']['tab_type'] == 'list' )
					{
					 $total_count_array_all = $this->Mod_template_selection->get_selections(array(
												'select_fields' => array('COUNT(SELECTION.ub_template_selection_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','selection_choice'=>'Yes'),
												'group_clause' => array("SELECTION.ub_template_selection_id")
												)); 
					// echo '<pre>';print_r($total_count_array_all);exit;							
					}
					else  if(isset($result['data']['tab_type']) && $result['data']['tab_type'] == 'category' )
					{
						$total_count_array_all = $this->Mod_template_selection->get_selections(array(
												'select_fields' => array('distinct(SELECTION.category) as total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','selection_choice'=>'Yes'),
												'group_clause' => array("SELECTION.ub_template_selection_id")
												)); 
					}
					else  if(isset($result['data']['tab_type']) && $result['data']['tab_type'] == 'location' )
					{
						$total_count_array_all = $this->Mod_template_selection->get_selections(array(
												'select_fields' => array('distinct(SELECTION.location) as total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','selection_choice'=>'Yes'),
												'group_clause' => array("SELECTION.ub_template_selection_id")
												)); 
					}
					if(isset($total_count_array_all['aaData']))
					{
						$total_count_array['aaData'][0]['total_count'] = count($total_count_array_all['aaData']);
						$total_count_array['status'] = $total_count_array_all['status'];
						$total_count_array['message'] = $total_count_array_all['message'];
					}
				}

				 // echo '<pre>';print_r($total_count_array_all);
				  // echo '<pre>';print_r($total_count_array);exit;
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					//echo $result['data'][$dt_filed_name.$sort_filed_column_id];
					$order_by_where = 'SELECTION.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
				$order_by_where='SELECTION.modified_on DESC';
				}
				// echo '<pre>';print_r($result);exit;
			}
			else
			{
				$this->Mod_template->response($result);
			}
		}
		
		// Fetch date format to display	
		$timezone = $this->Mod_timezone->get_timezone();		
		$args = array('classification'=>'user_date_format');
		$date_format_array = $this->Mod_general_value->get_general_value($args);
		$date_array = array('due_date_time'=>'due_date_time');
		$query_array = array('select_fields' => array('SELECTION.ub_template_selection_id','SELECTION.title AS title', 'IF (SELECTION.category="","Unassigned", SELECTION.category) AS category ','IF (SELECTION.location="","Unassigned", SELECTION.location) AS location ', 'SELECTION_CHOICE.title AS choice_title', 'max(SELECTION.approved_price)AS owner_price','SELECTION.allowance','(SELECTION.allowance - SELECTION.approved_price) as difference','SELECTION.due_date_time','SELECTION.status,'
		.$this->Mod_user->format_user_datetime($date_array)),
		'join'=> array('builder'=>'Yes','selection_choice'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where,
		'group_clause' => array("SELECTION.ub_template_selection_id"),
		'pagination' => $pagination_array
		);
		
		// echo '<pre>';print_r($query_array);exit;
		$result_data = $this->Mod_template_selection->get_selections($query_array);
		$final_result_data = array();
		if(TRUE === $result_data['status'])
		{
			foreach($result_data['aaData'] as $key => $val)
			{
				$post_array_choice[] = array(
									'field_name' => 'SELECTION_CHOICE.template_selection_id',
									'value'=> $result_data['aaData'][$key]['ub_template_selection_id'], 
									'type' => '='
								);			
				$where_str = $this->Mod_template->build_where($post_array_choice);
					$query_array = array('select_fields' => array('SELECTION_CHOICE.title as choice_title', 'SELECTION_CHOICE.owner_price', 'SELECTION_CHOICE.description','SELECTION_CHOICE.status','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator'),
				 'join'=> array('builder'=>'Yes'),
				 'where_clause' => $where_str
				 );
				 // echo '<pre>';print_r( $post_array_choice);exit;
				$choice = $this->Mod_template_selection->get_selection_choice_list($query_array);
				$result_data['aaData'][$key]['selection_choices'] = (isset($choice['aaData']))?$choice['aaData']:'';
			}
		}
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
		$this->Mod_template->response($result_data);
	}
	public function delete_selection()
	{		
		
		$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$response = $this->Mod_selections->delete_selections($result['data']);
			}
			else
			{
				$this->Mod_selections->response($result);
			}
			$this->Mod_selections->response($response);
			
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
				$result = $this->Mod_selections->destroy_session($result['data']);
			}
			$this->Mod_selections->response($result);
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
		 $this->module = 'SELECTION';
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
				
				if(!empty($unserialized_data['vendors']))
				{
					// Set value in session
					$search_session_array['vendors'] = $unserialized_data['vendors'];
					
				}
				if(!empty($unserialized_data['title']))
				{
					// Set value in session
					$search_session_array['title'] = $unserialized_data['title'];
					
				}
				if(!empty($unserialized_data['location']))
				{
					// Set value in session
					$search_session_array['location'] = $unserialized_data['location'];
				}
				if(!empty($unserialized_data['category']))
				{
					// Set value in session
					$search_session_array['category'] = $unserialized_data['category'];
					
				}
				if(!empty($unserialized_data['daterange']))
				{
					// Set value in session
					$search_session_array['daterange'] = $unserialized_data['daterange'];
				}
				//print_r($search_session_array);exit;
				// Setting session 
				
				 $this->uni_set_session('search', $search_session_array);
				
				// Response data
				$this->Mod_selections->response($result_data);
		}
	}

}
	
	/** 
	* @method: update_choice_status 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 30/04/15
	*/
	function update_choice_status()
	{
		$result = $this->sanitize_input();
		$update_choice_status = $this->Mod_selections->update_selection_choices($result['data']);
		$this->Mod_selections->response($update_choice_status);
	}
	
	/** 
	* @method: update_selection_status 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 06/05/15
	* @Reason: Update the selection status to pending
	*/
	function update_selection_status()
	{
		$result = $this->sanitize_input();
		$update_selection_status = $this->Mod_selections->update_selection_status($result['data']);
		$this->Mod_selections->response($update_selection_status);
	}
	
	
}