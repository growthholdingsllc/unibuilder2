<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Project Class
 * 
 * @package: Project
 * @subpackage: Project
 * @category: Project
 * @author: Devansh, Thiyagaraj, MS, Gayathri, Satheesh
 * @createdon(DD-MM-YYYY): 14-03-2015 
*/
class Projects extends UNI_Controller {
	/**
	 * @property: $project_id
	 * @access: public
	 */
	public $project_id;
	
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();

		$this->load->model(array('Mod_project','Mod_general_value','Mod_saved_search','Mod_timezone','Mod_user','Mod_role','Mod_grid_settings','Mod_doc','Mod_plan','Mod_builder','Mod_bid','Mod_po_co','Mod_budget','Mod_template','Mod_schedule','Mod_checklist','Mod_selections','Mod_notification','Mod_task','Mod_custom_settings','Mod_punchlist'));

		$this->load->helper('export');
		$this->grid_setting_classification = 'project_grid_setting_fields';
		
    }
	/** 
	* Get all projects
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/
	public function index()
	{
		$total_project_count = $this->Mod_project->get_project_count();
		// echo '<pre>';print_r($total_project_count);exit;
		/* Count project count for particular builder */
		/* Calculating project count for particular builder */
		$total_count_array = $this->Mod_project->get_projects(array(
												'select_fields' => array('COUNT(PROJECT.ub_project_id) AS total_count'),
												'where_clause' => array('builder_id'=>$this->builder_id),
												));
		if(TRUE == $total_count_array['status'])
		{
			$current_plan_project_count = $total_count_array['aaData'][0]['total_count'];
		}else{
			$current_plan_project_count = 0;
		}
		if($total_project_count > $current_plan_project_count)
		{
			$show_add_button = TRUE;
		}else{
			$show_add_button = FALSE;
		}
		//echo "<pre>";print_r($this->session->all_userdata());exit;
		// Check search filter entry 
		$search_filter_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		$result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array('ub_saved_search_id'),
												 'where_clause' => $search_filter_array
												 ));
		
		//echo $this->crypt->encrypt('schedules/index/');
		$data = array(
		'title'        		=> 'PROJECTS',		
		'content'      		=> 'content/projects/projects',
        'page_id'      		=> 'projects',
		'data_table'  		=> 'data_table',
		'project_list' 		=> 'project_list',      
		'date_all'	   		=> 'date_all',
		'map'		        =>'map',
		'apply_filter' => $result_data['status'],
		'show_add_button' => $show_add_button,
		'save_project_url' 	=> $this->crypt->encrypt('projects/save_project/'),
		'current_url' 		=> $this->uri->segment(1),
		'delete_projects_url' => $this->crypt->encrypt('projects/delete_projects/'),
		'search_session_array' => $this->uni_session_get('SEARCH')
		); 
		// Code to fetch the grid settings pop up information 
		$data['grid_settings_popup']=$this->uni_get_grid_settings_popup_info();	
		$data['datatable_headers']=$data['grid_settings_popup']['datatable_headers'];
		unset($data['grid_settings_popup']['datatable_headers']);
		// code to get the project_group dropdown in project landing page
 		$get_project_group = array('classification'=>'project_group', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
 		$project_group_result = $this->Mod_general_value->get_general_value($get_project_group);
		$data['project_group']=$project_group_result['values'];

 		// code to get the project manager dropdown in project landing page
 		$where_clause = array('USER.builder_id' => $this->user_session['builder_id']);
 		$get_project_managers = array('select_fields' => array('USER.ub_user_id', 'CONCAT(USER.first_name," ",USER.last_name) as manager_name'), 'join' => array('project_manager'=>'yes'),'where_clause' => $where_clause,'group_clause' => array("PROJECT.project_managers") );
									
 		$project_managers = $this->Mod_user->get_users($get_project_managers);
		$data['project_managers'] = array();
		if(TRUE === $project_managers['status'])
		{
			$project_managers_dropdown = $this->Mod_project->build_ci_dropdown_array($project_managers['aaData'],'ub_user_id','manager_name','multiple');
			$data['project_managers'] = $project_managers_dropdown;
		}

		// code to get the project_status dropdown in project landing page
 		$get_project_status = array('classification'=>'project_status', 'type'=>'dropdown');
		$project_status = $this->Mod_general_value->get_general_value($get_project_status);
		$data['project_status']=$project_status['values'];

		// Create mapped project drop down
		$mapped_projects_dropdown = array(''=>'Nothing selected','mapped'=>'Mapped Projects','unmapped'=>'Unmapped Projects');
		$data['mapped_projects'] = $mapped_projects_dropdown;
		
 		$this->template->view($data);		
	}
	/** 
	* Get projects
	* 
	* @method: get_projects 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/	
	public function get_projects()
	{
		$total_count_array =  array();
		$pagination_array = array();
		$search_session_array = array();
		$grid_session_array = array();
		$order_by_where = '';
		$query_type = '';
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//print_r($result);exit;
			if(TRUE === $result['status'])
			{
				$query_type = (isset($result['data']['fetch_type']))?$result['data']['fetch_type']:'list';
				// Getting data of a particular builder
				$post_array[] = array(
									'field_name' => 'PROJECT.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'PROJECT.project_status',
									'value'=> 'Deleted', 
									'type' => '!='
									);					
				// Assigning project group in session and search param
				if(isset($result['data']['project_group']) && $result['data']['project_group']!='' && $result['data']['project_group']!= 'null' && $result['data']['project_group']!= 'null' && $result['data']['project_group'] != 'Nothing selected')
				{
					$post_array[] = array(
										'field_name' => 'PROJECT.project_group',
										'value'=> $result['data']['project_group'], 
										'type' => '||',
										'classification' => 'dynamnic_text'
										);
					$search_session_array['project_group'] = $result['data']['project_group'];
				}
				// Assigning project managers in session and search param
				if(isset($result['data']['project_managers']) && $result['data']['project_managers']!='' && $result['data']['project_managers']!= 'null' && $result['data']['project_managers'] != 'Nothing selected')
				{
					$post_array[] = array(
										'field_name' => 'PROJECT.project_managers',
										'value'=> $result['data']['project_managers'], 
										'type' => '||',
										'classification' => 'dynamnic_text'
										);
					$search_session_array['project_managers'] = $result['data']['project_managers'];
				}
				// Assigning project status in session and search param
				if(isset($result['data']['project_status']) && $result['data']['project_status']!='' && $result['data']['project_status']!= 'null' && $result['data']['project_status'] != 'Nothing selected')
				{
					$post_array[] = array(
										'field_name' => 'PROJECT.project_status',
										'value'=> $result['data']['project_status'], 
										'type' => '=',
										'classification' => 'dynamnic_text'
										);
					$search_session_array['project_status'] = $result['data']['project_status'];
				}
				
				// Assigning mapped projects in session and search param
				if((isset($result['data']['mapped_projects']) && $result['data']['mapped_projects']!= '' && $result['data']['mapped_projects']!= 'null' && $result['data']['mapped_projects'] != 'Nothing selected') OR $query_type == 'map')
				{
					$mapped_type = (isset($result['data']['mapped_projects']))?$result['data']['mapped_projects']:''; 
					
					if($query_type == 'map')
					{
						$mapped_type = 'mapped';
					}
					else
					{
						$search_session_array['mapped_projects'] = $result['data']['mapped_projects'];

					}
					switch($mapped_type)
					{
						case 'mapped':
						{
							$post_array[] = array(
										'field_name' => 'PROJECT.latitude',
										'value'=> 'NULL', 
										'type' => 'IS NOT',
										'classification' => 'dynamnic_text'
										);
						
							$post_array[] = array(
										'field_name' => 'PROJECT.longitude',
										'value'=> 'NULL', 
										'type' => 'IS NOT',
										'classification' => 'dynamnic_text'
										);
							break;
						}
						case 'unmapped':
						{
							$post_array[] = array(
										'field_name' => 'PROJECT.latitude',
										'value'=> 'NULL', 
										'type' => 'IS',
										'classification' => 'dynamnic_text'
										);
						
							$post_array[] = array(
										'field_name' => 'PROJECT.longitude',
										'value'=> 'NULL', 
										'type' => 'IS',
										'classification' => 'dynamnic_text'
										);
							break;
						}
					}
				}
				//code added by satheesh kumar
				/* if(isset($this->user_role_access[strtolower('projects')][strtolower('view all')]) && $this->user_role_access[strtolower('projects')][strtolower('view all')] == 0)
				{
					if(isset($this->user_role_access[strtolower('projects')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('projects')][strtolower('view assigned to me')] == 1 && $this->user_account_type == SUBCONTRACTOR)
					{
						$post_array[] = array(
											'field_name' => 'PROJECT.project_assigned_users',
											'value'=> $this->user_id, 
											'type' => '||',
											'classification' => 'dynamnic_text'
											);
					}
					if($this->user_account_type == OWNER)
					{
						$post_array[] = array(
									'field_name' => 'PROJECT.owner_id',
									'value'=> $this->user_id, 
									'type' => '='
									);
					}
				} */
				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				$where_str = $this->Mod_project->build_where($post_array);
				//append where condition by satheesh kumar
				if(isset($this->user_role_access[strtolower('projects')][strtolower('view all')]) && $this->user_role_access[strtolower('projects')][strtolower('view all')] == 1)
				{
					$where_str = $where_str;
				}
				else if(isset($this->user_role_access[strtolower('projects')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('projects')][strtolower('view assigned to me')] == 1)
				{
					$where_str = $where_str.' AND (PROJECT.created_by = '.$this->user_id.' || PROJECT.owner_id = '.$this->user_id.' || PROJECT.project_managers = '.$this->user_id.' || FIND_IN_SET('.$this->user_id.', PROJECT.project_assigned_users))';
				}
				
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_project->get_projects(array(
												'select_fields' => array('COUNT(PROJECT.ub_project_id) AS total_count'),
												'where_clause' => $where_str,
												));
				}
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					
					// Get formatted sort name
					$format_sort_name = $this->Mod_project->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'PROJECT.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
	
				}
				else
				{
					$order_by_where = 'PROJECT.modified_on DESC';
				}
			}
			else
			{
				$this->Mod_project->response($result);
			}
		}
		// code to get the grid setting dropdown in project landing page
		//echo $result['data']['datatable_grid_id'];exit;
		//print_r($this->session->all_userdata());
		$args = array('select_fields' => array('ub_grid_settings_id','is_default' ,'list_view_name', 'display_fields', 'display_field_joins' , 'builder_id', 'user_id'), 
		'where_clause' => array('ub_grid_settings_id'=>$result['data']['datatable_grid_id']),'get'=>'select_fields','primary_key'=>'PROJECT.ub_project_id');
		$user_grid_settings  = $this->Mod_grid_settings->get_grid_settings($args);
		
		if(TRUE === $user_grid_settings['status'])
		{
			// Date format code added by satheesh kumar	
			if(in_array("PROJECT.projected_start_date",  $user_grid_settings['select_fields'])) 
			{
				$date_array = array('PROJECT.projected_start_date'=>'');
				$formatted_date_array = $this->Mod_user->format_user_datetime($date_array,"date");
				$formatted_date = "IF(PROJECT.projected_start_date = '0000-00-00', '--',".$formatted_date_array.") AS projected_start_date";
				array_push($user_grid_settings['select_fields'],$formatted_date );
			}
			if(in_array("PROJECT.actual_start_date",  $user_grid_settings['select_fields'])) 
			{
				$date_array = array('PROJECT.actual_start_date'=> '');
				$formatted_date_array = $this->Mod_user->format_user_datetime($date_array,"date");
				$formatted_date = "IF(PROJECT.actual_start_date = '0000-00-00', '--',".$formatted_date_array.") AS actual_start_date";
				array_push($user_grid_settings['select_fields'],$formatted_date );
			}	
			if(in_array("PROJECT.projected_completion",  $user_grid_settings['select_fields'])) 
			{
				$date_array = array('PROJECT.projected_completion'=> '');
				$formatted_date_array = $this->Mod_user->format_user_datetime($date_array,"date");
				$formatted_date = "IF(PROJECT.projected_completion = '0000-00-00', '--',".$formatted_date_array.") AS projected_completion";
				array_push($user_grid_settings['select_fields'],$formatted_date );
			}	
			if(in_array("PROJECT.actual_completion",  $user_grid_settings['select_fields'])) 
			{
				$date_array = array('PROJECT.actual_completion'=> '');
				$formatted_date_array = $this->Mod_user->format_user_datetime($date_array,"date");
				$formatted_date = "IF(PROJECT.actual_completion = '0000-00-00', '--',".$formatted_date_array.") AS actual_completion";
				array_push($user_grid_settings['select_fields'],$formatted_date );
			}
			// End of Date format code
			$datatable_headers = $user_grid_settings['header_fields'];
			$field_names = $user_grid_settings['field_names'];
			$query_array = array('select_fields' => $user_grid_settings['select_fields'],	
			'join'=>$user_grid_settings['join_clause'],
			'where_clause' => $where_str,
			'order_clause' => $order_by_where,
			'pagination' => $pagination_array,
			'query_type' => $query_type
			);
		}
		else
		{
			$this->Mod_project->response($user_grid_settings);
		}
		//print_r($query_array);exit;
		// Fetch Data all records based on conditions
		/* $query_array = array('select_fields' => array('PROJECT.ub_project_id', 'PROJECT.builder_id', 'PROJECT.project_name', 'PROJECT.owner_id', 'PROJECT.address', 'PROJECT.city', 'PROJECT.province', 'PROJECT.postal', 'PROJECT.project_managers', 'PROJECT.project_status', 'CONCAT(PROJECT.latitude,",",PROJECT.longitude) as lat_long',
		'PROJECT.latitude','PROJECT.longitude','OWNER.desk_phone', 'OWNER.mobile_phone', 'CONCAT(OWNER.first_name," ",OWNER.last_name) as owner_name', 'CONCAT(BUILDER.first_name," ",BUILDER.last_name) as manager_name'),	
		'join'=> array('owner'=>'Yes','project_manager'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where,
		'pagination' => $pagination_array,
		'query_type' => $query_type
		); */
		//echo "<pre>";print_r($query_array);
		
		// Check if the request is for file export
		if('export' === $query_type)
		{
			unset($query_array['pagination']);
		}
		$result_data = $this->Mod_project->get_projects($query_array);
		
		// File export request  
		if('export' === $query_type)
		{
			//$field_list_array = array('project_name','address','city','province','postal','manager_name','owner_name','desk_phone','mobile_phone','project_status');
			$field_list_array = (isset($field_names)?$field_names:array());
			// Export file header column 
			//$export_array['header'][0] = array('Project Name','Address','City','State','Zip','Project Manager','Owner','Phone','Cell Phone','Project Status'); 
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
			echo array_to_export($export_array,'uni_projectlist.xls','csv');exit;
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
		$this->Mod_project->response($result_data);
	}
	/** 
	* Save projects
	* 
	* @method: save_project 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* URL: cHJvamVjdHMvc2F2ZV9wcm9qZWN0Lw--
	*/	
	
	public function save_project($project_id = 0)
	{
		/* Added by Pranab, Below conditin will check plan has enough projects. */
		if($project_id == 0  && !isset($_POST) && empty($_POST))
		{

			$builder_id = $this->user_session['builder_id'];
			$project_limit = $this->Mod_project->check_project_limit_based_plan($builder_id) ;
			if(FALSE === $project_limit['status'])
			{
				redirect(base_url().'cHJvamVjdHMvYnVpbgxf1Rlcl9mb3JiaWRkZW5fcgxf1FnZS8-');
			}
		}		
		// Above condition Ends here
		
		// Display add page
		$data = array(
		'title'        => "PROJECTS",		
		'page_id'      => 'projects',
		'content'      => 'content/projects/save_project',
		'date_all'	   =>'date_all'  
		);

		// Template Modules Checkboxes
		$get_template_modules = array('classification'=>'template_modules');
		$template_modules_result = $this->Mod_general_value->get_general_value($get_template_modules);
		$data['template_modules_array'] = $template_modules_result['values'];
		//echo "<pre>";print_r($template_modules_result['values']);
		
		// Project status drop down values
		$get_project_status = array('classification'=>'project_status', 'type' => 'dropdown');
		$project_status_result = $this->Mod_general_value->get_general_value($get_project_status);
		$data['project_status_array'] = $project_status_result['values'];
		//project status removed based on role // added by satheesh kumar
		if($this->user_session['role_id'] != BUILDER_ADMIN_ROLE_ID && isset($data['project_status_array']['Disabled']))
		{
			unset($data['project_status_array']['Disabled']);
		}
		
		// Project group drop down values
		$get_project_group = array('classification'=>'project_group', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$project_group_result = $this->Mod_general_value->get_general_value($get_project_group);
		$data['project_group_array'] = $project_group_result['values'];
		
		// limit_owner_calendar drop down values
		$data['limit_owner_calendar_array'] = array(''=>'Nothing selected','Yes'=>'Yes','No'=>'No');
		
		// to get the manager list in add/ edit page
		$where_clause = array('builder_id' => $this->user_session['builder_id'], 'account_type' => 100,'user_status' => 'Active');
		$get_project_managers = array(
									'select_fields' => array('USER.ub_user_id', 'CONCAT(first_name," ",last_name) as manager_name'),
									'where_clause' => $where_clause
									);
		$project_managers_result = $this->Mod_user->get_users($get_project_managers);
		$data['project_manager_array']=array();
		if(TRUE === $project_managers_result['status'])
		{
			$data['project_manager_array'] = $this->Mod_project->build_ci_dropdown_array($project_managers_result['aaData'],'ub_user_id', 'manager_name');
		}
		
		// to get the builder added roles
		$roles_result = $this->Mod_role->get_roles(array(
											'select_fields' => array('ROLE.ub_role_id', 'ROLE.role_name'),
											'where_clause' => array('builder_id' => $this->user_session['builder_id'], 'role_active' => 'Yes')
											));
		$data['roles_list_array']=array();
		if(TRUE === $roles_result['status'])
		{
			$data['roles_list_array'] = $this->Mod_project->build_ci_dropdown_array($roles_result['aaData'],'ub_role_id', 'role_name');
		}

		// Block to fetch custom fields for Project.

		$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>PROJECT_INFO_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE);
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

		// Block to fetch custom fields for Owner.

		$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>OWNER_INFO_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE);
		$sort_type = 'ASC';
		$order_by_where = 'CUSTOM_FIELD.display_order'.' '.$sort_type;
			$owner_custom_field_data = $this->Mod_custom_settings->get_custom_fields(array(
													'select_fields' => array('CUSTOM_FIELD.ub_custom_field_id','CUSTOM_FIELD.data_type','CUSTOM_FIELD.label_name','CUSTOM_FIELD.field_values','CUSTOM_FIELD.tooltip','CUSTOM_FIELD.mandatory','CUSTOM_FIELD.include_in_filter','CUSTOM_FIELD.display_order'),
													'where_clause' => $post_array,
													'order_clause' => $order_by_where
													));
			//echo "<pre>"; print_r($custom_field_data); exit;
			if(isset($owner_custom_field_data['aaData']) && !empty($owner_custom_field_data['aaData']))
			{
				$data['owner_custom_field_data'] = $owner_custom_field_data['aaData'];
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
		
		//Below if is for Saving/Editing the project details
		$edit_proj_id = 0;
		$postdata = $this->input->post();
		$edit_proj_id = $postdata['ub_project_id'];
		if($project_id > 0 || $edit_proj_id > 0)
		{
		 	if(!empty($this->input->post()))
			{
				//update project details
				$result = $this->sanitize_input();
				// echo "<pre>";print_r($result);exit;

				// Block to update the custom field value for project.

				$result['data']['module_id'] = $edit_proj_id;
					$result['data']['module_name'] = 'projects';
					$result['data']['classification'] = PROJECT_INFO_CUSTOM_FIELDS;
					$result['data']['status'] = FIELD_ACTIVE;
					$custom_response = $this->Mod_custom_settings->format_custom_filed_and_insert($result['data']);
				$save_type = $result['data']['save_type'];

				// Block to update the custom field value for owner.
				// echo "<pre>";print_r($result);exit;
				$result['data']['module_id'] = $edit_proj_id;
					$result['data']['module_name'] = 'owner';
					$result['data']['classification'] = OWNER_INFO_CUSTOM_FIELDS;
					$result['data']['status'] = FIELD_ACTIVE;
					$custom_response = $this->Mod_custom_settings->format_custom_filed_and_insert($result['data']);
				$save_type = $result['data']['save_type'];


				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				if(TRUE === $result['status']) //if sanitize is done
				{
					$form_data = $this->forming_data_array($result['data']);
					if(isset($form_data['user_data'])) //if owner details are entered
					{
						// Code for single fle upload for owner profile pic start

							$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
		                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'user'))
		                               );
							$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
							//echo "<pre>"; print_r($all_folder);exit;
							
							// Code for single fle upload end
						if($form_data['project_data']['owner_id'] > 0)
						{

							// profile pic upload code start
								$task_data = array(	  'flag' => 2, 
										  'builder_id'	=> $this->user_session['builder_id'],
										  'projectid' => 0,
										  'folderid' => 0,
										  'modulename' => 'user',
										  'moduleid' => $form_data['project_data']['owner_id'],
										);
								$result_array = $this->Mod_doc->get_files_for_folder($task_data);
								//echo "<pre>"; print_r($result_array);
								if(isset($result_array[0]['ub_doc_file_id']) && !empty($result_array[0]['ub_doc_file_id']))
								{
									
								}
								else if(isset($_FILES['profile_pic']['name']) && !empty($_FILES['profile_pic']['name']))
								{
									//echo "123445";
									$file_data = array(	'flag' => 2, 
										  'builder_id'	=> $this->user_session['builder_id'],
										  'projectid' => 0,
										  'createdby' => $this->user_session['ub_user_id'],
										  'modulename' => 'user',
										);

									$file_data['moduleid'] = $form_data['project_data']['owner_id'];
									$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
									$file_data['filename'] = $_FILES['profile_pic']['name'];
									//echo "<pre>"; print_r($file_data);exit;
									$result_array = $this->Mod_doc->insert_file($file_data);

									//echo "<pre>"; print_r($result_array);
									//Code to move the files from temp to actual dir

									if ($result_array['0']['createfolderflag'] == 1) 
									{
										$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
										if(TRUE === $response['status'])
										{
											$session_id = $this->session->userdata('session_id');
											move_uploaded_file($_FILES['profile_pic']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
										}
									}
									else
									{
										$session_id = $this->session->userdata('session_id');
										move_uploaded_file($_FILES['profile_pic']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);	
									}		
								}
							// upload code end
							//Update user table with owner details
							$user_update = $form_data['user_data'];
							$user_update['ub_user_id'] = $form_data['project_data']['owner_id'];
							$user_update_response = $this->Mod_user->update_user($user_update);
							//print_r($form_data['project_data']['owner_id']);exit;
							if($save_type == 'save_and_stay_and_sent_mail')
							{
								$form_data['user_data']['owner_id'] = $form_data['project_data']['owner_id'];
                                $form_data['user_data']['name'] = $form_data['user_data']['first_name'].' '.$form_data['user_data']['last_name'];
                                $response = $this->Mod_project->owner_email_invitation($form_data['user_data']);
							}
							

							if(FALSE === $user_update_response['status'])
							{
								$this->Mod_project->response($user_update_response);
							}
						}
						else
						{
							
							//Insert owner details in user table
							$user_insert_response = $this->Mod_user->insert_data(UB_USER, $form_data['user_data']);
							if(TRUE === $user_insert_response['status'])
							{
								//print_r($form_data['user_data']);exit;
								if($save_type == 'save_and_stay_and_sent_mail')
							    {
							    	$form_data['user_data']['owner_id'] = $user_insert_response['primary_id'];
                                    $form_data['user_data']['name'] = $form_data['user_data']['first_name'].' '.$form_data['user_data']['last_name'];
                                    $response = $this->Mod_project->owner_email_invitation($form_data['user_data']);
							    }
								

								$form_data['project_data']['owner_id'] = $user_insert_response['primary_id'];
									// profile pic upload code start
									$file_data = array(	'flag' => 2, 
											  'builder_id'	=> $this->user_session['builder_id'],
											  'projectid' => 0,
											  'createdby' => $this->user_session['ub_user_id'],
											  'modulename' => 'user',
											);

									$file_data['moduleid'] = $form_data['project_data']['owner_id'];
									$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
									$file_data['filename'] = $_FILES['profile_pic']['name'];
									//echo "<pre>"; print_r($file_data);exit;
									$result_array = $this->Mod_doc->insert_file($file_data);

									//echo "<pre>"; print_r($result_array);
									//Code to move the files from temp to actual dir

									if ($result_array['0']['createfolderflag'] == 1) 
									{
										$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
										if(TRUE === $response['status'])
										{
											$session_id = $this->session->userdata('session_id');
											move_uploaded_file($_FILES['profile_pic']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
										}
									}
									else
									{
										$session_id = $this->session->userdata('session_id');
										move_uploaded_file($_FILES['profile_pic']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);	
									}				
								// upload code end
							}
							elseif(FALSE === $user_insert_response['status'])
							{
								$this->Mod_project->response($user_insert_response);
							}
						}
					}
					//Update project details
					$project_update = $form_data['project_data'];
					$project_update['ub_project_id'] = $edit_proj_id;
					unset($project_update['builder_users_permitted']);
					unset($project_update['builder_users_roleid']);
					$response = $this->Mod_project->update_project($project_update);
					if(TRUE === $response['status'])
					{
						//deleting the project assigned users before inserting the new users
						$delete_assign_usres = array('project_id' => $edit_proj_id );
						$delete_response = $this->Mod_project->delete_project_assigned_user($delete_assign_usres);
						
						if($form_data['project_data']['project_managers'] > 0 || $form_data['project_data']['project_managers'] != '')
						{
							//inserting project manager in ub_project_assigned_users table
							$assigned_user_array = array('project_id' => $edit_proj_id,
							'builder_id' => $this->user_session['builder_id'],
							'role_id' => PROJECT_MANAGER_ROLE_ID,
							'assigned_to' => $form_data['project_data']['project_managers']);
							
							//insert the assigned users in assigned users table
							$assign_users_response = $this->Mod_project->insert_project_assign_users($assigned_user_array);
						}
						if(FALSE === $assign_users_response['status'])
						{
							$this->Mod_project->response($assign_users_response);
						}
						
						$project_assigned_users = explode(",",$form_data['project_data']['project_assigned_users']);
						$builder_users_permitted = explode(",",$form_data['project_data']['builder_users_permitted']);
						$builder_users_roleid = explode(",",$form_data['project_data']['builder_users_roleid']);
						for($i=0;$i<count($project_assigned_users);$i++)
						{
							if($project_assigned_users[$i] > 0)
							{
								//getting the builder user role id
								$assign_roleid = SUB_CONTRACTOR_ROLE_ID;
								/* //Below code commented because we are temporarily removing role drop down in view page 
								$key = array_search($project_assigned_users[$i], $builder_users_permitted);
								if($key != "")
								{
									$assign_roleid = $builder_users_roleid[$key];
								}
								*/
								
								//Below code added newly to assign actual roleid of assigned builder users-12th Aug
								$where_clause = array('USER.ub_user_id' => $project_assigned_users[$i],'USER.account_type' => BUILDERADMIN);
								$get_builderuser_roleid = array('select_fields' => array('USER.role_id'),'where_clause' => $where_clause);
								$res_builderuser_roleid = $this->Mod_user->get_users($get_builderuser_roleid);
								// echo "v=".$res_builderuser_roleid['aaData'][0]['role_id'];exit;
								if(TRUE === $res_builderuser_roleid['status'])
								{
									$assign_roleid = $res_builderuser_roleid['aaData'][0]['role_id'];
								}
								
								//End of code
								//form project assigned users array
								$assigned_user_array = array('project_id' => $edit_proj_id,
								'builder_id' => $this->user_session['builder_id'],
								'role_id' => $assign_roleid,
								'assigned_to' => $project_assigned_users[$i]);
								
								//insert the assigned users in assigned users table
								$assign_users_response = $this->Mod_project->insert_project_assign_users($assigned_user_array);
								if(FALSE === $assign_users_response['status'])
								{
									$this->Mod_project->response($assign_users_response);
								}
							}
						}
					}
					$this->Mod_project->response($response);
				}
				else
				{
					$this->Mod_project->response($result);
				}
				
			}
			else
			{
				//Select project details to display in edit page
				$result_data = $this->Mod_project->get_projects(
				array(
				'select_fields' => array('PROJECT.*'
				,'OWNER.ub_user_id AS owner_user_id'
				,'OWNER.first_name'
				,'OWNER.last_name'
				,'OWNER.desk_phone'
				,'OWNER.mobile_phone'
				,'OWNER.primary_email'
				,'OWNER.alternative_email'
				,'OWNER.login_enabled'
				,'OWNER.username'
				,'OWNER.password'
				,'OWNER.address As owner_address','OWNER.city As owner_city','OWNER.province As owner_province','OWNER.postal As owner_postal','OWNER.address As owner_address','OWNER.country As owner_country','Group_concat(UB_SIGNOFF_DOCUMENTS_INFO.ub_signoff_documents_info_id) as ub_signoff_documents_info_id','Group_concat(UB_SIGNOFF_DOCUMENTS_INFO.doc_file_id) as doc_file_id','Group_concat(UB_SIGNOFF_DOCUMENTS_INFO.document_name) as document_name','Group_concat(UB_SIGNOFF_DOCUMENTS_INFO.comments) as comments'),
				'where_clause' => (array('PROJECT.ub_project_id' =>  $project_id)),
				'join'=> array('owner'=>'yes','signoff_documents_info'=>'yes')
				));
				$serialized_mail_preferences = $result_data['aaData'][0]['signature_content'];
		        $remove_single_quote_mail_preferences = str_replace("'", '', $serialized_mail_preferences);
		        $unserialized_mail_preferences = unserialize($remove_single_quote_mail_preferences);
		       $result_data['aaData'][0]['signature_content'] = $unserialized_mail_preferences;

				$data['result_data'] = $result_data['aaData'][0];
				// echo '<pre>';print_r($data['result_data']);exit;
				$data['result_data']['info'] = $data['result_data']['latitude'].",".$data['result_data']['longitude'];
				/* Find punchlist count code was added by chandru 19-08-2015 */
				$where_cond = array('project_id' => $project_id,'mark_complete_status' => 'No');
					$punch_list_data = $this->Mod_punchlist->get_punchlist(
					array(
					'select_fields' => array(),
					'where_clause' => $where_cond,
					'join'=> array('builder'=>'yes')
					));
					if(TRUE == $punch_list_data['status'])
					{
						$data['punch_list_data'] = count($punch_list_data['aaData']);
					}else{
						$data['punch_list_data'] = 0;
					}
				/* punchlist code ends here */
				/* File path code added by chandru */
				/* Fetch file path */
				$user_data = array(	  'flag' => 1, 
									  'builder_id'	=> $this->user_session['builder_id'],
									  'projectid' => $project_id,
									  'folderid' => 0,
									  'modulename' => 'signoff',
									  'moduleid' => $project_id,
									);
				$file_array = $this->Mod_doc->get_files_for_folder($user_data);
				// echo '<pre>';print_r($file_array);exit;
				if($file_array['status'] == TRUE)
				{
					unset($file_array['status']);
					$data['file_array'] = $file_array;
				}else{
					$data['file_array'] = 0;
				}
				 // echo '<pre>';print_r($file_array);exit;
				// Block to fetch the project field values for custom fields.

				$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>PROJECT_INFO_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE,'CUSTOM_FIELD_VALUES.table_id' => $project_id);

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

				// Block to fetch the owner field values for custom fields.

				$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=>OWNER_INFO_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE,'CUSTOM_FIELD_VALUES.table_id' => $project_id);

				$owner_custom_field_value = $this->Mod_custom_settings->get_custom_fields(array(
														'select_fields' => array('CUSTOM_FIELD_VALUES.field_values AS field_data','CUSTOM_FIELD_VALUES.custom_field_id'),
														'join'=> array('custom_field_value'=>'yes'),
														'where_clause' => $post_array,
														));
				//echo "<pre>"; print_r($custom_field_data); exit;
				if(isset($owner_custom_field_value['aaData']) && !empty($owner_custom_field_value['aaData']))
				{
					$data['owner_custom_field_value'] = $owner_custom_field_value['aaData'];
				}


				// file display code start hear
				$task_data = array(	  'flag' => 2, 
										  'builder_id'	=> $this->user_session['builder_id'],
										  'projectid' => 0,
										  'folderid' => 0,
										  'modulename' => 'user',
										  'moduleid' => $data['result_data']['owner_user_id'],
										);
					$result_array = $this->Mod_doc->get_files_for_folder($task_data);

					//echo "<pre>";print_r($result_array);exit;
					if(isset($result_array['0']['ub_doc_file_id']) && !empty($result_array['0']['ub_doc_file_id']))
					{
						$data['profile_pic_id'] = $result_array['0']['ub_doc_file_id'];
						$data['profile_pic'] = $result_array['0']['system_file_name'];
					}
				//	file display code end hear

				// to get the builder subcontractor list
				$get_subcontractors = array('builder_id' => $this->user_session['builder_id'],'ub_project_id' =>$data['result_data']['ub_project_id'],'account_type'=>SUBCONTRACTOR,'assigned_type'=>'no');
				$subcontractor_list = $this->Mod_project->get_project_assigned_users($get_subcontractors);
				
				//get the assigned subcontractors
				$assigned_subcontractors = array('builder_id' => $this->user_session['builder_id'],'account_type' =>SUBCONTRACTOR,'ub_project_id'=>$data['result_data']['ub_project_id'],'assigned_type'=>'yes');
				$assigned_subcontractor_list = $this->Mod_project->get_project_assigned_users($assigned_subcontractors);
				
				// to get the builder users list
				$get_builder_users = array('builder_id' => $this->user_session['builder_id'],'ub_project_id' =>$data['result_data']['ub_project_id'],'account_type'=>BUILDERADMIN,'assigned_type'=>'no');
				$builder_users_list = $this->Mod_project->get_project_assigned_users($get_builder_users);
				
				//get the assigned builder users list
				$assigned_builderusers = array('builder_id' => $this->user_session['builder_id'],'account_type' =>BUILDERADMIN,'ub_project_id'=>$data['result_data']['ub_project_id'],'assigned_type'=>'yes');
				$assigned_builderuser_list = $this->Mod_project->get_project_assigned_users($assigned_builderusers);
				
				//get the role_id of project assigned builder users
				$get_project_roleids = array(
									'select_fields' => array('PROJECTASSIGNED.role_id AS ub_role_id'
									),
									'where_clause' => (array('PROJECTASSIGNED.project_id' =>  $data['result_data']['ub_project_id'], 'PROJECTASSIGNED.role_id !=' => SUB_CONTRACTOR_ROLE_ID)),
									);
									
				$project_assign_roleids = $this->Mod_project->get_assigned_role_ids($get_project_roleids);
				
				//get the assigned builder users and role ids
				$get_assing_builderuserid_roleid = array(
									'select_fields' => array('GROUP_CONCAT(PROJECTASSIGNED.role_id) AS ub_role_id', 'GROUP_CONCAT(PROJECTASSIGNED.assigned_to) AS ub_user_id'
									),
									'where_clause' => (array('PROJECTASSIGNED.project_id' =>  $data['result_data']['ub_project_id'], 'PROJECTASSIGNED.role_id !=' => SUB_CONTRACTOR_ROLE_ID)),
									);
				$builderuserids_roleids = $this->Mod_project->get_assigned_role_ids($get_assing_builderuserid_roleid);
				 				
				if(isset($builderuserids_roleids['aaData']))
				{	$data['result_data']['builder_users_permitted'] = ",".$builderuserids_roleids['aaData'][0]['ub_user_id'].",";
					$data['result_data']['builder_users_roleid'] = ",".$builderuserids_roleids['aaData'][0]['ub_role_id'].",";
				}
				// echo "<pre>";print_r($data);exit;
				if(isset($project_assign_roleids['aaData']))
				{
					$data['project_assign_roleids'] = $project_assign_roleids['aaData'];
				}
				
				if(isset($subcontractor_list['aaData']))
				{
					$data['subcontractor_list'] = $subcontractor_list['aaData'];
				}
				if(isset($assigned_subcontractor_list['aaData']))
				{
					$data['assigned_subcontractor_list'] = $assigned_subcontractor_list['aaData'];
				}
				if(isset($builder_users_list['aaData']))
				{
					$data['builder_users_list'] = $builder_users_list['aaData'];
				}
				
				if(isset($assigned_builderuser_list['aaData']))
				{
					$data['assigned_builderuser_list'] = $assigned_builderuser_list['aaData'];
				}
			}
		}
		else
		{
		// echo "<pre>" ; print_r($_POST);exit;
			if(!empty($this->input->post())) //this condition will insert the project details
			{
				// Add project
				$result = $this->sanitize_input();
				 // echo "<pre>" ; print_r($result);exit;
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				if(TRUE === $result['status']) //if sanitize is done
				{
					$form_data = $this->forming_data_array($result['data']);
					if(isset($form_data['user_data'])) //if owner details are entered
					{
						$response = $this->Mod_user->insert_data(UB_USER, $form_data['user_data']);
						if(TRUE === $response['status'])
						{
							$form_data['project_data']['owner_id'] = $response['primary_id'];
						}
					}
					
					$add_project_data = $form_data['project_data'];
					unset($add_project_data['builder_users_permitted']);
					unset($add_project_data['builder_users_roleid']);
					$response = $this->Mod_project->add_project($add_project_data);
			
					if(TRUE === $response['status'])
					{
					    $ub_project_id = $response['ub_project_id'];

					    // Block to add the custom field value for project.
				
							$result['data']['module_id'] = $response['ub_project_id'];
							$result['data']['module_name'] = 'projects';
							$result['data']['classification'] = PROJECT_INFO_CUSTOM_FIELDS;
							$result['data']['status'] = FIELD_ACTIVE;
							$custom_response = $this->Mod_custom_settings->format_custom_filed_and_insert($result['data']);

						//Once proj inserted update the same with proj number
						$proj_name_format = strtoupper(substr($form_data['project_data']['project_name'], 0, 3));
						$project_no = $this->Mod_project->generate_number($proj_name_format,PROJ_NUM_LEN,$ub_project_id);
						$project_update = array(
												'ub_project_id' => $ub_project_id,
												'owner_id' => $form_data['project_data']['owner_id'],
												'project_no' => $project_no);
						$update_proj_num = $this->Mod_project->update_project($project_update);
						if(FALSE === $update_proj_num['status'])
						{
							$this->Mod_project->response($update_proj_num);
						}
						
						if($form_data['project_data']['project_managers'] > 0 || $form_data['project_data']['project_managers'] != '')
						{
							//inserting project manager in ub_project_assigned_users table
							$assigned_user_array = array('project_id' => $ub_project_id,
							'builder_id' => $this->user_session['builder_id'],
							'role_id' => PROJECT_MANAGER_ROLE_ID,
							'assigned_to' => $form_data['project_data']['project_managers']);
							
							//insert the assigned users in assigned users table
							$assign_users_response = $this->Mod_project->insert_project_assign_users($assigned_user_array);
						    $sub_user_array = array('project_id' => $ub_project_id,
							'builder_id' => $this->user_session['builder_id'],
							'role_id' => SUB_CONTRACTOR_ROLE_ID);
							//added by pranab
                             $this->Mod_project->assign_project_subcontractor($sub_user_array);
 						   
						}
						if(FALSE === $assign_users_response['status'])
						{
							$this->Mod_project->response($assign_users_response);
						}
					}
					$this->Mod_project->response($response);	
				}
				else
				{
					$this->Mod_project->response($result);
				}
			}
		}
		/* Below code was added by chandru for owner sign_off hide */
			$input_array[] = array(
								'field_name' => 'ub_project_id',
								'value'=> $project_id, 
								'type' => '='
								);			
			$where = $this->Mod_project->build_where($input_array);
			$sign_off_tab = $this->Mod_project->get_projects(array(
			'select_fields' => array('PROJECT.warranty_claims_period','signoff_date'),
			'where_clause' => $where." AND signoff_status != ''"
			));
			// echo '<pre>';print_r($sign_off_tab);exit;
			if(TRUE == $sign_off_tab['status'])
			{
				$sign_off_tab_count = count($sign_off_tab['aaData']);
				if($sign_off_tab_count > 0)
				{
					$data['owner_sign_offs_tab'] = TRUE;
				}else{
					$data['owner_sign_offs_tab'] = FALSE;
				}
			}else{
				$data['owner_sign_offs_tab'] = FALSE;
			}
			/* Chandru code ends HERE */
		$this->template->view($data);
	}

	/** 
	* Forming data array for insertion and updation of project details
	* 
	* @method: forming_data_array 
	* @access: public 
	* @param:  array
	* @return: array 
	*/
	function forming_data_array($data = array())
	{
		$lat_long = array();
		$lat_long = explode(',',$data['info']);
		$lat_long[0] = isset($lat_long[0]) ? $lat_long[0] : null;
		$lat_long[1] = isset($lat_long[1]) ? $lat_long[1] : null;
		$off_days = '';
		$all_work_days = array(0,1,2,3,4,5,6);
		$result_days=array_diff($all_work_days,$data['work_days']);
		if(!empty($result_days))
		{
			$off_days = ",".implode(',', $result_days).",";
		}
		// exploding the project group code added by satheesh
		$data['project_group_values'] = array();
		if(isset($data['project_group']) && $data['project_group'] !== "")
		{
			$data['project_group_values'] = implode(",", $data['project_group']);
		}
		$form_data['project_data'] = array(
					'project_name' => $data['project_name'],
					'builder_id' => $this->user_session['builder_id'],
					'owner_id' => $data['owner_id'],
					'project_assigned_users' => $data['project_assigned_users'],
					'builder_users_permitted' => $data['builder_users_permitted'],
					'builder_users_roleid' => $data['builder_users_roleid'],
					'project_group' => $data['project_group_values'],
					'project_managers' => $data['project_managers'],
					'address' => $data['address'],
					'city' => $data['city'],
					'province' => $data['province'],
					'postal' => $data['postal'],
					'country' => $data['country'],
					'latitude' => $lat_long[0],
					'longitude' => $lat_long[1],
					'lot_info' => $data['lot_info'],
					'permit_no' => $data['permit_no'],
					'contract_price' => $data['contract_price'],
					'internal_note' => $data['internal_note'],
					'sub_note' => $data['sub_note'],
					'projected_start_date' => (isset($data['projected_start_date']) && $data['projected_start_date'] != '')?date("Y-m-d", strtotime($data['projected_start_date'])):'',
					'projected_completion' => (isset($data['projected_completion']) && $data['projected_completion'] != '')?date("Y-m-d", strtotime($data['projected_completion'])):'',
					'actual_start_date' => (isset($data['actual_start_date']) && $data['actual_start_date']!='')?date("Y-m-d", strtotime($data['actual_start_date'])):'',
					'actual_completion' => (isset($data['actual_completion']) && $data['actual_completion']!='')?date("Y-m-d", strtotime($data['actual_completion'])):'',
					'limit_owner_calendar' => $data['limit_owner_calendar'],
					'work_days' => isset($data['work_days']) ? ",".implode(',', $data['work_days'])."," : "No",
					'off_days' => $off_days,
					'view_cost_summary_running_total' => isset($data['view_cost_summary_running_total']) ? "Yes" : "No",
					'project_prefix' => $data['project_prefix'],
					'individual_po_limit' => $data['individual_po_limit'],
					'overall_po_limit' => $data['overall_po_limit'],
					'view_budget_po' => isset($data['view_budget_po']) ? "Yes" : "No",
					'owner_add_claims' => isset($data['owner_add_claims']) ? "Yes" : "No",
					'warranty_claims_period' => $data['warranty_claims_period_signoff'],
					'include_allowances' => isset($data['include_allowances']) ? "Yes" : "No",
					'view_payment' => isset($data['view_payment']) ? "Yes" : "No",
					'project_status' => $data['project_status']);
		
		if(isset($data['first_name']) && $data['first_name']!='') //Set user data array
		{
			$form_data['user_data'] = array(
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'account_type' => OWNER,
					'role_id' => OWNER_ROLE_ID,
					'builder_id' => $this->user_session['builder_id'],
					'username' => $data['username'],
					'builder_id' => $this->user_session['builder_id'],
					'desk_phone' => $data['desk_phone'],
					'mobile_phone' => $data['mobile_phone'],
					'primary_email' => $data['primary_email'],
					'alternative_email' => $data['alternative_email'],
					'address' => $data['owner_address'],
					'city' => $data['owner_city'],
					'province' => $data['owner_province'],
					'postal' => $data['owner_postal'],
					'country' => $data['owner_country'],
					'login_enabled' => isset($data['login_enabled']) ? "Yes" : "No",
					'user_status' => isset($data['login_enabled']) ? "Active" : "Inactive",
					'time_zone' => DEFAULT_USER_TIME_ZONE,
					'date_format' => DEFAULT_DATE_FORMAT,
					'created_by' => $this->user_session['ub_user_id'],
					'created_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY,
					'access_method' => $data['access_method']);
					
			if(isset($data['password']) && $data['password']!='')
			{
				$enc_password = $this->Mod_project->encrypt_password($data['password']);
				$form_data['user_data']['password'] = $enc_password['encrypt_password'];
			}
		}
		//print_r($form_data);exit;
		return $form_data;
	}
	/** 
	* Delete projects
	* 
	* @method: delete_projects 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* URL: cHJvamVjdHMvZgxf1VsZXRlX3Byb2plY3RzLw--
	*/
	public function delete_projects()
	{	
		//$delete = array('ub_project_id' => 33, );
		//$response = $this->Mod_project->delete_projects($delete);
		//$this->Mod_project->response($response);
		if(! empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Block to delete the project related dir.
				foreach($result['data']['ub_project_id'] as $key => $value)
				{
                    //echo $value."<br />";
                    $sort_type = 'ASC';
					$order_by_where = 'ub_doc_folder_id'.' '.$sort_type;
					$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
					$get_project_folder_id = array('select_fields' => array('ub_doc_folder_id'),
	                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $value)),
									'order_clause' => $order_by_where,
									'pagination' => $pagination_array
	                               );
					$project_folder_id = $this->Mod_doc->get_folder_id($get_project_folder_id);
					$folder_data = array(	 
									  'folderid' => $project_folder_id['aaData']['0']['ub_doc_folder_id'],
									  'builderid' => $this->user_session['builder_id'],
									  'deletedby' => $this->user_session['ub_user_id']
									);
					$result_array = $this->Mod_doc->delete_folder($folder_data);
					/*$project_name = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.project_name'),
					'where_clause' => array('PROJECT.ub_project_id'=> $value)
					));
					$get_photo_folder_id = array('select_fields' => array('ub_doc_folder_id'),
	                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $value,'ui_folder_name' => 'activity')),
									'order_clause' => $order_by_where,
									'pagination' => $pagination_array
	                               );
					$project_folder_id = $this->Mod_doc->get_folder_id($get_project_folder_id);
					$folder_data = array(	 
									  'folderid' => $project_folder_id['aaData']['0']['ub_doc_folder_id'],
									  'builderid' => $this->user_session['builder_id'],
									  'deletedby' => $this->user_session['ub_user_id']
									);
					$result_array = $this->Mod_doc->delete_folder($folder_data);*/
                }
				
				// Delete functionality
				$response = $this->Mod_project->delete_projects_status($result['data']);

				$respoce_array = $this->get_project_pagination($page_count = 'result_array');
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
				$this->Mod_project->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		// Response data
		$this->Mod_project->response($response);
	}
	/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_project->destroy_session($result['data']);
			}
			$this->Mod_project->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* url encoded : cHJvamVjdHMvdXBkYXRlX2dlbmVyYWxfdmFsdWUv
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
			$this->Mod_project->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/** 
	* Insert / Update Grid settings
	* 
	* @method: update_grid_setting 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* url encoded : cHJvamVjdHMvdXBkYXRlX2dyaWRfc2V0dgxf1luZy8- 
	*/
	public function update_grid_setting()
	{
		if(! empty($this->input->post()))
		{
			// Sanitize input
			$post_array = $this->sanitize_input();
			if(TRUE === $post_array['status'])
			{
				$args = array('ub_grid_settings_id'=>$post_array['data']['grid_settings_id'], 'module_name' => $post_array['data']['module_name'] ,'is_default' => $post_array['data']['is_default'],'list_view_name' => $post_array['data']['list_view_name'],'display_fields' => $post_array['data']['display_fields'],'display_field_joins' => $post_array['data']['display_field_joins']);
				
				if(isset($post_array['data']['grid_settings_id']) &&  $post_array['data']['grid_settings_id'] > 0)
				{
					$result = $this->Mod_grid_settings->update_grid_settings($args);
				}
				else
				{
					$result = $this->Mod_grid_settings->add_grid_settings($args);
				}	
			}
			$this->Mod_project->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/** 
	* Get Saved Search Filter
	* 
	* @method: get_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: Thiyagaraj R 
	* @createdon(DD-MM-YYYY): 14-03-2015 
	* url encoded : cHJvamVjdHMvZ2V0X3NhdmVkX3NlYXJjaC8-
	*/
	public function get_saved_search()
	{
		if(! empty($this->input->post()))
		{
			$response = $this->sanitize_input();
			
			if(TRUE === $response['status'])
			{
				$post_array = $response['data'];
				$project_array =array(
					'project_group' =>$post_array['project_group'],
					'project_managers' =>$post_array['project_managers'],
					'project_status' =>$post_array['project_status'],
					'mapped_projects' =>$post_array['mapped_projects']
				);
				$post_array = array('search_params' => "'".serialize($project_array)."'");
				$response = $this->Mod_saved_search->update_saved_search($post_array);
			}
			else
			{
				$this->Mod_project->response($response);
			}	
		}
	}
	
	public function meeting()
	{
		
		$this->module = 'MOM';
		
		$data = array(
		'title'        => 'Minutes of Meeting',		
		'content'      => 'content/projects/meeting',
		'page_id'      => 'projects',
		'date_all'	   =>'date_all' ,
		'data_table'   => 'data_table',
		'meeting_list' => 'meeting_list',
		'apply_filter' =>'$apply_filter',
        'sess_fromandto_date' => isset($this->account_session[$this->user_session['account_type']]['MOM']['SEARCH']['daterange'])?$this->account_session[$this->user_session['account_type']]['MOM']['SEARCH']['daterange']:'',
        'search_session_array' => $this->uni_session_get('SEARCH')		
		);
		
		//get mom location custom fields from general value table
		$args = array('classification'=>'meeting_location', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$mom_location_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_location']= array();
		if(isset($mom_location_array['values']))
		{
			$data['mom_location']=$mom_location_array['values'];
		}
		
		//get mom tags custom fields from general value table
		$args =array('classification'=>'meeting_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown'); 
		$meeting_tags_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_tags'] = array();
		if(isset($meeting_tags_array['values']))
		{
			$data['mom_tags'] = $meeting_tags_array['values'];
		}
		
		//get status custom fields from general value table
		$args = array('classification'=>'meeting_status', 'type'=>'dropdown');
		$mom_status_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_status']= array();
		if(isset($mom_status_array['values']))
		{
			$data['mom_status']= $mom_status_array['values'];
		}
		
		//get project_type custom fields from general value table
		$args = array('classification'=>'meeting_type', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$mom_type_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_type']= array();
		if(isset($mom_type_array['values']))
		{
			$data['mom_type'] = $mom_type_array['values'];
		}
		//username custom fields from user table
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id']);
		$mom_attendees = $this->Mod_user->get_users(array(
												'select_fields' => array('CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name','USER.ub_user_id'),
												'where_clause' => $post_array,
												));
											
		//Get all projects list from project table with the builder_id
		$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => array('PROJECT.builder_id'=> $this->builder_id)
					));
		$data['project_list']=array();
		
	
		//echo "<pre>"; print_r($data);exit();
 			
	
		//Get all projects list from project table with the builder_id
		$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => array('PROJECT.builder_id'=> $this->builder_id)
					));
		$data['project_list']=array();
		if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_project->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		}
		
		 $args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
		 $data['all_type_users'] = $this->Mod_user->get_users_by_type($args,'multiple'); 
         
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
			$apply_filter = false;
		}
		$data['apply_filter'] = $apply_filter;
		
		$this->template->view($data);
	}
	
	/** 
	* Get mom
	* 
	* @method: get_mom 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	*@created by: Gayathri Kalyani
	* encoded url :
	*/	
    public function get_mom($page_count = '')
    {
	 $post_array[] = array(
							'field_name' => 'MOM.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
						  );
	 $post_array[] = array(
							  'field_name' => 'MOM.is_delete',
							  'value'=> 'No', 
							  'type' => '='
							);	
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'MOM.project_id',
							'value'=> $this->project_id, 
							'type' => '='
						);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'MOM.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}		
		// Order by
		$order_by_where = '';
		// Pagination Array
		$pagination_array = array();
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
				// Sanitize input
				$result = $this->sanitize_input();
				//echo '<pre>';print_r($result);
				if(TRUE === $result['status'])
		{
					/* if(isset($result['data']['project']) && $result['data']['project']!='' && $result['data']['project'] != 'null')
					{
						$post_array[] = array(
								'field_name' => 'MOM.project_id',
								'value'=> $result['data']['project'], 
								'type' => '='
							);
					// Set value in session
					$search_session_array['project'] = $result['data']['project'];
					} */
					$search_session_array= array();

					
					if(isset($result['data']['meetingType']) && $result['data']['meetingType']!='' && $result['data']['meetingType'] != 'null')
					{
						$post_array[] = array(
								'field_name' => 'MOM.type',
								'value'=> $result['data']['meetingType'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					// Set value in session
					 $search_session_array['meetingType'] = $result['data']['meetingType'];
					}
					if(isset($result['data']['status']) && $result['data']['status']!='' && $result['data']['status'] != 'null')
					{
						$post_array[] = array(
								'field_name' => 'MOM.status',
								'value'=> $result['data']['status'], 
								'type' => '='
							);
					// Set value in session
					$search_session_array['status'] = $result['data']['status'];
					}
					if(isset($result['data']['tagType']) && $result['data']['tagType']!='' && $result['data']['tagType'] != 'null')
					{
					 // echo '<pre>';print_r($result);exit;	
						$post_array[] = array(
								'field_name' => 'MOM.tags',
								'value'=> $result['data']['tagType'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
							$search_session_array['tagType'] = $result['data']['tagType'];
					}
				 	 if(isset($result['data']['attendees']) && $result['data']['attendees']!='' && $result['data']['attendees'] != 'null')
				  {
						$post_array[] = array(
								'field_name' => 'MOM.attendees',
								'value'=> $result['data']['attendees'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
							// Set value in session
					$search_session_array['attendees'] = $result['data']['attendees'];
					
				  }  
				  
             // echo "<pre>";print_r($result['data']['conducted_by']);exit;
                if(isset($result['data']['conducted_by']) && $result['data']['conducted_by']!='' && $result['data']['conducted_by'] != 'null' && $result['data']['conducted_by'] > 0)
				{
						$post_array[] = array(
								'field_name' => 'MOM.conducted_by',
								'value'=> $result['data']['conducted_by'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
							// Set value in session
					$search_session_array['conducted_by'] = $result['data']['conducted_by'];
					
				}  
					
					// $this->uni_set_session('search', $search_session_array);
					
                  // echo "<pre>";print_r($post_array);exit;						
				 if(isset($result['data']['daterange']) && $result['data']['daterange']!='')
				{
					
					$formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' => 'MOM.datetime',
										'from'=> date("Y-m-d", strtotime($formatted_date[0])),
										'to'=> date("Y-m-d", strtotime($formatted_date[2])),
										'type' => 'daterange'
									);   
								 // echo '<pre>';print_r($formatted_date);exit;	
								 // echo '<pre>';print_r($result);exit;	
						$search_session_array['daterange'] = $result['data']['daterange'];
				}		  
				
						// Setting session 
					$this->module = 'MOM';

				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('SEARCH')['meetingType']) && $this->uni_session_get('SEARCH')['meetingType']!='' && $this->uni_session_get('SEARCH')['meetingType'] != 'null')
					{
						$post_array[] = array(
								'field_name' => 'MOM.type',
								'value'=> $this->uni_session_get('SEARCH')['meetingType'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					// Set value in session
					 //$search_session_array['meetingType'] = $result['data']['meetingType'];
					}
					if(isset($this->uni_session_get('SEARCH')['status']) && $this->uni_session_get('SEARCH')['status']!='' && $this->uni_session_get('SEARCH')['status'] != 'null')
					{
						$post_array[] = array(
								'field_name' => 'MOM.status',
								'value'=> $this->uni_session_get('SEARCH')['status'], 
								'type' => '='
							);
					// Set value in session
					// $search_session_array['status'] = $result['data']['status'];
					}
					if(isset($this->uni_session_get('SEARCH')['tagType']) && $this->uni_session_get('SEARCH')['tagType']!='' && $this->uni_session_get('SEARCH')['tagType'] != 'null')
					{
					 // echo '<pre>';print_r($result);exit;	
						$post_array[] = array(
								'field_name' => 'MOM.tags',
								'value'=> $this->uni_session_get('SEARCH')['tagType'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
						//$search_session_array['tagType'] = $result['data']['tagType'];
					}
					if(isset($this->uni_session_get('SEARCH')['attendees']) && $this->uni_session_get('SEARCH')['attendees']!='' && $this->uni_session_get('SEARCH')['attendees'] != 'null')
				  {
						$post_array[] = array(
								'field_name' => 'MOM.attendees',
								'value'=> $this->uni_session_get('SEARCH')['attendees'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
							// Set value in session
					//$search_session_array['attendees'] = $result['data']['attendees'];
					
				  }
				  if(isset($this->uni_session_get('SEARCH')['conducted_by']) && $this->uni_session_get('SEARCH')['conducted_by']!='' && $this->uni_session_get('SEARCH')['conducted_by'] != 'null' && $this->uni_session_get('SEARCH')['conducted_by'] > 0)
				{
						$post_array[] = array(
								'field_name' => 'MOM.conducted_by',
								'value'=> $this->uni_session_get('SEARCH')['conducted_by'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
							// Set value in session
					//$search_session_array['conducted_by'] = $result['data']['conducted_by'];
					
				}
				if(isset($this->uni_session_get('SEARCH')['daterange']) && $this->uni_session_get('SEARCH')['daterange']!='')
				{
					
					$formatted_date = explode(" ",$this->uni_session_get('SEARCH')['daterange']);
					 $post_array[] = array(
										'field_name' => 'MOM.datetime',
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

					$this->uni_set_session('search', $search_session_array);	
					$where_str = $this->Mod_project->build_where($post_array);
					//echo '<pre>';print_r($where_str);exit;
					//$this->session->set_userdata('ACCOUNT', $this->account_session);
					if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
				    {
					   $pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);

					   $total_count_array = $this->Mod_project->get_meeting_list(array(
													'select_fields' => array('COUNT(MOM.ub_mom_id) AS total_count'),
													'where_clause' => $where_str,
													'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'yes')
												));
				    }
				   else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				   {
					  $pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					  $total_count_array = $this->Mod_project->get_meeting_list(array(
					 								'select_fields' => array('COUNT(MOM.ub_mom_id) AS total_count'),
													'where_clause' => $where_str,
													'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'yes')
												));
				   }

					/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
					{
						$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
						// Get number of records
						$total_count_array = $this->Mod_project->get_meeting_list(array(
													'select_fields' => array('COUNT(MOM.ub_mom_id) AS total_count'),
													'where_clause' => $where_str,
													'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'yes')
												));
													
					}*/
				
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					
					// Get formatted sort name
					$format_sort_name = $this->Mod_project->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'MOM.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
					
				}
        }
				else
				{
					$this->Mod_project->response($result);
				}
	}
	    // echo '<pre>';print_r($this->Mod_project->response($result));
		$date_array = array('mom_date'=>'mom_date');
		// Fetch Data all records based on conditions
		$agenda_notes_select_field = 'SUBSTRING(MOM.agenda,1,75) as agenda';
		if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			$agenda_notes_select_field = 'agenda';
		}
		$result_data = $this->Mod_project->get_meeting(array(
												'select_fields' => array(
												'MOM.ub_mom_id', 'MOM.builder_id', 'MOM.title',$agenda_notes_select_field,'MOM.mom_date','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS conducted_by', 'GROUP_CONCAT(CONCAT_WS(" ",USERS.first_name,USERS.last_name )SEPARATOR ",<br>") AS attendees','MOM.type','MOM.location','CHAR_LENGTH(MOM.agenda) as length','MOM.status','PROJECT.project_name,'
												.$this->Mod_user->format_user_datetime($date_array,"date")),
												'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
												'where_clause' => $where_str,
												'order_clause' => $order_by_where,
												'group_clause' => array("MOM.ub_mom_id"), 
												'pagination' => $pagination_array
												));
			if($page_count == 'result_array')
			{
				//print_r($result_data);exit;
				return $result_data;
			}				
            	// echo '<pre>';print_r($result_data);
          if($result_data['status'] == TRUE)
          {		  
			 for($i=0;$i<count($result_data['aaData']);$i++)
			{
			//echo "<pre>";print_r($result_data['aaData'] );
				$attendees=explode(",",$result_data['aaData'][$i]['attendees']);
				
				if(count($attendees) > 3)
				{
				  $attendee_comma_separeted = $attendees[0].','.$attendees[1].','.$attendees[2];
				  $result_data['aaData'][$i]['attendees'] = $attendee_comma_separeted.'<br><br>'."+".(count($attendees)-3)."more";
				}
			}	
        }			
			if($result['data']['fetch_type'] == 'export')
			{
				unset($result_data['pagination']);
			}
			
		// $result_data = $this->Mod_project->get_meeting($query_array);
		// File export request  
		if($result['data']['fetch_type'] == 'export')
		{
			$field_list_array = array('title','agenda','mom_date','conducted_by','attendees','type','location','status','project_name');
			
			// Export file header column 
			$export_array['header'][0] = array('Title','Agenda','Date Held','Conducted By','Attendees','Type','Location','Status','Project'); 
			foreach($result_data['aaData'] as $fields)
			{
				// echo "<pre>";print_r($result_data);
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
			// echo "<pre>";print_r($export_array);
			echo array_to_export($export_array,'uni_mettinglist.xls','csv');exit;
		}
									
		
		// Response data
		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			// Get number of records
			// The following parameters required for data table
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			 $result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
				
		$this->Mod_project->response($result_data);
		
		 //echo $this->db->last_query($result_data);
		//echo '<pre>';print_r($this->user_session);exit;
 }	
 

	/** 
	* Save meeting(Add or edit meeting)
	* 
	* @method: save_meeting 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :
	*/		
	public function save_meeting($ub_mom_id = 0)
	{
		$this->module = 'MOM';
		//encryption key for meeting module
		$this->encrypt_key = 'XYZ!@#$%';
		$data = array(
		'title'        => 'Minutes of Meeting',		
		'content'      => 'content/projects/save_meeting',
		'page_id'      => 'projects',
		'data_table'   => 'data_table',
		'meeting_list' => 'meeting_list' 		
		);
		$data['mom_data'] = array();	
		
		//get project id from task table // by satheesh kumar
		if(empty($this->project_id) && $ub_mom_id > 0)
		{
		$where_args = array('ub_mom_id' => $ub_mom_id);
		$project_id = $this->Mod_project->get_project_id(UB_MOM,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		//end code for get project id
		//file upload(get folder id)
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
		{
			$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
		}
		
		/*code to create the temp dir and pass it to view*/
		$dir_response = $this->Mod_doc->create_default_dir();
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
			$data['temprory_dir_id'] = '1';
		}
		//Codition check wheather the ub_mom_id value is greater than 0 or not
		if($ub_mom_id > 0 || null!==$this->input->post('ub_mom_id') && $this->ci_decrypt($this->input->post('ub_mom_id'), $this->encrypt_key) > 0)
		{
			/*Code for update file */
			$this->ub_mom_id = (null!=$this->input->post('ub_mom_id')) ? $this->ci_decrypt($this->input->post('ub_mom_id'), $this->encrypt_key) : $ub_mom_id;
			$task_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->builder_id,
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->ub_mom_id,
								);
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
					copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);
				}
			}
			/*End Code for edit file */
			
			if(!empty($this->input->post()))
		    {
		     	// Insert meeting
				$result = $this->sanitize_input();
				//decrypt the ub_mom_id value
				$result['data']['ub_mom_id'] = $this->ci_decrypt($result['data']['ub_mom_id'], $this->encrypt_key);
				if(TRUE == $result['status'])
				{	
					$result['data']['builder_id'] = $this->builder_id;
					if($result['data']['conducted_by'] == 0)
					{
						unset($result['data']['conducted_by']);
					}
					if(isset($result['data']['datetime']) && $result['data']['datetime'] !== "")
					{
						$result['data']['mom_date'] = date("Y-m-d", strtotime($result['data']['datetime']));
					}
					if(isset($result['data']['mom_time']) && $result['data']['mom_time'] !== "")
					{
						$result['data']['mom_time'] = date("H:i:s", strtotime($result['data']['mom_time']));
					}
					else
					{
						$result['data']['mom_time'] = NULL;
					}
					if(isset($result['data']['datetime']) && $result['data']['datetime'] !== "")
					{
						$result['data']['datetime'] = $result['data']['mom_date'].' '.$result['data']['mom_time'];
					}
					if(isset($result['data']['type']) && $result['data']['type'] !== "")
					{
						$result['data']['type'] = implode(",", $result['data']['type']);
					}
					else
					{
						$result['data']['type'] = '';
					}
					if(isset($result['data']['tags']) && $result['data']['tags'] !== "")
					{
						$result['data']['tags'] = implode(",", $result['data']['tags']);
					}
					else
					{
						$result['data']['tags'] = '';
					}
					if(isset($result['data']['location']) && $result['data']['location'] !== "")
					{
						$result['data']['location'] = implode(",", $result['data']['location']);
					}
					else
					{
						$result['data']['location'] = '';
					}
					if(isset($result['data']['attendees']) &&  $result['data']['attendees'] !== "")
					{
						$result['data']['attendees'] = implode(",", $result['data']['attendees']);
					}
					else
					{
						$result['data']['attendees'] = NULL;
					}
					if(isset($result['data']['save_type']))
					{
						unset($result['data']['save_type']);
						unset($result['data']['editor1']);
						unset($result['data']['temp_directory_id']);
						unset($result['data']['folder_id']);
						unset($result['data']['temp_file_path']);
					}				
				$response = $this->Mod_project->update_meeting($result['data']);
				$this->Mod_project->response($response);
				}
			}
			else
			{
				// get inserted data with help of id
				$result_data = $this->Mod_project->get_meeting_list(array(
				'select_fields' => array('MOM.ub_mom_id', 'MOM.builder_id', 'MOM.project_id', 'MOM.type', 'MOM.tags', 'MOM.location', 'MOM.mom_date', 'MOM.mom_time', 'MOM.title', 'MOM.agenda', 'MOM.status', 'MOM.attendees', 'MOM.conducted_by','MOM.description'),
				'where_clause' => (array('ub_mom_id' =>  $ub_mom_id))
				));
				$data['mom_data']  = $result_data['aaData'][0];
		   }
		 
	    }
		else
		{
			if(!empty($this->input->post()))
			{
				// Insert meeting
				$result = $this->sanitize_input();
				if(TRUE == $result['status'])
				{	
					if($result['data']['conducted_by'] == 0)
					{
						unset($result['data']['conducted_by']);
					}
					if(isset($result['data']['datetime']) && $result['data']['datetime'] !== "")
					{
						$result['data']['mom_date'] = date("Y-m-d", strtotime($result['data']['datetime']));
					}
					if(isset($result['data']['mom_time']) && $result['data']['mom_time'] !== "")
					{
						$result['data']['mom_time'] = date("H:i:s", strtotime($result['data']['mom_time']));
					}
					if(isset($result['data']['mom_time']) && isset($result['data']['datetime']) && $result['data']['mom_time'] !== "" && $result['data']['datetime'] !== "")
					{
						$result['data']['datetime'] = $result['data']['mom_date'].' '.$result['data']['mom_time'];
					}
					if(isset($result['data']['type']) && $result['data']['type'] !== "")
					{
						$result['data']['type'] = implode(",", $result['data']['type']);
					}
					if(isset($result['data']['tags']) && $result['data']['tags'] !== "")
					{
						$result['data']['tags'] = implode(",", $result['data']['tags']);
					}
					if(isset($result['data']['location']) && $result['data']['location'] !== "")
					{
						$result['data']['location'] = implode(",", $result['data']['location']);
					}
					if(isset($result['data']['attendees']) && $result['data']['attendees'] !== "")
					{
						$result['data']['attendees'] = implode(",", $result['data']['attendees']);
					}
					$result['data']['builder_id'] = $this->user_session['builder_id'];
					if(isset($result['data']['save_type']))
					{
						unset($result['data']['save_type']);
						unset($result['data']['editor1']);
						unset($result['data']['temp_directory_id']);
						unset($result['data']['folder_id']);
						unset($result['data']['temp_file_path']);
					}			
					  $response = $this->Mod_project->add_meeting($result['data']);
					  $this->Mod_project->response($response);
				}
				else
				{
					 $this->Mod_project->response($result);
				}
			}
	    }
		
		//get mom location custom fields from general value table
		$args = array('classification'=>'meeting_location', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$mom_location_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_location']= array();
		if(isset($mom_location_array['values']))
		{
			$data['mom_location']=$mom_location_array['values'];
		}
		
		//get mom tags custom fields from general value table
		$args =array('classification'=>'meeting_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown'); 
		$meeting_tags_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_tags'] = array();
		if(isset($meeting_tags_array['values']))
		{
			$data['mom_tags'] = $meeting_tags_array['values'];
		}
		
		//get status custom fields from general value table
		$args = array('classification'=>'meeting_status', 'type'=>'dropdown');
		$mom_status_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_status']= array();
		if(isset($mom_status_array['values']))
		{
			$data['mom_status']= $mom_status_array['values'];
		}
		
		//get project_type custom fields from general value table
		$args = array('classification'=>'meeting_type', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$mom_type_array = $this->Mod_general_value->get_general_value($args);
		$data['mom_type']= array();
		if(isset($mom_type_array['values']))
		{
			$data['mom_type'] = $mom_type_array['values'];
		}
		
		//Get all projects list from project table with the builder_id
		$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => array('PROJECT.builder_id'=> $this->builder_id)
					));
		$data['project_list']=array();
		if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_project->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		}
		
		$data['all_type_users'] = $this->Mod_project->get_project_assigned_users(array('ub_project_id' => $this->project_id, 'account_type' => 'all', 'dropdown_type' => 'optgroup'));
		
		 /* $args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
		 $data['all_type_users'] = $this->Mod_user->get_users_by_type($args,'multiple');  */

		//echo '<pre>';print_r($data['all_type_users']);exit;
		$this->template->view($data);
	}

	/** 
	* Save and apply search filter
	* 
	* @method: save_or_apply_project_search_filter  
	* @access: public 
	* @params: null
	* @return: AJAX response
	* @created by: Gayathri Kalyani
	* @created on: 10/04/2015 
	* url encoded : 
	*/
	public function save_or_apply_project_search_filter()
	{
		// Load saved search model
		$this->load->model('Mod_saved_search');
		// Check in database for existing entry for this user and module 
		$saved_search_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module);
		$saved_search_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array('ub_saved_search_id','search_params'),
												 'where_clause' => $saved_search_array
												 ));
		if(!empty($this->input->post()))
		{
			// Looking for save search action update or insert in this case 
			// Sanitize input
			$sanitize_result = $this->sanitize_input();
			if(TRUE === $sanitize_result['status'])
			{
				$posted_search_fields = $sanitize_result['data'];
				$update_search_array = array('search_params' => "'".serialize($posted_search_fields)."'");
				if(TRUE === $saved_search_data['status'])
				{
					$saved_search_row_array = $saved_search_data['aaData'];
					if(count($saved_search_row_array)==1)
					{
						$saved_search_id = $saved_search_row_array[0]['ub_saved_search_id'];
						$update_search_array['ub_saved_search_id'] = $saved_search_id;
						// Update the existing saved search entry
						$update_response = $this->Mod_saved_search->update_saved_search($update_search_array);
						$this->Mod_project->response($update_response);
					}
					else
					{
						$this->Mod_project->response(array('status'=>FALSE,'message'=>'More than one records are identified cannot update the current request!'));
					
					}
				}
				else
				{
					// Insert new saved search
					$insert_response = $this->Mod_saved_search->update_saved_search($update_search_array);
					$this->Mod_project->response($insert_response);
				}
			}	
			else
			{
				$this->Mod_project->response($sanitize_result);
			}
		}
		else
		{
			// Looking for saved search apply case - assign data to session
			$saved_search_row_array = $saved_search_data['aaData'];
			if(count($saved_search_row_array)==1)
			{
				$serialized_data = $saved_search_row_array[0]['search_params'];
				$remove_single_quote = str_replace("'", '', $serialized_data);
				$unserialized_data = unserialize($remove_single_quote);
				$saved_search_data['aaData'][0]['search_params'] = $unserialized_data;
				$search_session = $this->uni_session_get('SEARCH');
				if(!empty($unserialized_data))
				{
					if(!empty($unserialized_data['project_group']))
					{
						$search_session_array['project_group'] = $unserialized_data['project_group'];
					}
					if(!empty($unserialized_data['project_managers']))
					{
						$search_session_array['project_managers'] = $unserialized_data['project_managers'];
					}
					if(!empty($unserialized_data['project_status']))
					{
						$search_session_array['project_status'] = $unserialized_data['project_status'];
					}
					if(!empty($unserialized_data['mapped_projects']))
					{
						$search_session_array['mapped_projects'] = $unserialized_data['mapped_projects'];
					}
				}	
				// Setting session 
				$this->uni_set_session('search', $search_session_array);
				$this->Mod_project->response($saved_search_data);
			}
		}
	/* Apply Filter code Ends here */
	}
	
	/** 
	* Delete meeting
	* 
	* @method: delete_meeting 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: satheesh kumar
	*/
	public function delete_meeting()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_project->delete_meetings($result['data']);
				$this->module = 'MOM';
				$respoce_array = $this->get_mom($page_count = 'result_array');
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
				$this->Mod_project->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_project->response($response);
	}
	
	/** 
	* Destroy MOM
	* 
	* @method: mom_destroy_session
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: bgxf19ncy9kZWxldgxf1Vfbgxf19nLw--
	*/
	public function mom_destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo "<pre>";print_r($result);exit;
			if(TRUE === $result['status'])
			{
			// echo "<pre>";print_r($result);exit;
				$result = $this->Mod_project->destroy_session($result['data']);
			}
			$this->Mod_project->response($result);
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
		 $this->module = 'MOM';
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
				if(!empty($unserialized_data['meetingType']))
				{
					// Set value in session
					$search_session_array['meetingType'] = $unserialized_data['meetingType'];
				}
				
				if(!empty($unserialized_data['status']))
				{
					// Set value in session
					$search_session_array['status'] = $unserialized_data['status'];
					
				}
				if(!empty($unserialized_data['conducted_by']))
				{
					// Set value in session
					$search_session_array['conducted_by'] = $unserialized_data['conducted_by'];
					
				}
				if(!empty($unserialized_data['attendees']))
				{
					// Set value in session
					$search_session_array['attendees'] = $unserialized_data['attendees'];
					
				}
				if(!empty($unserialized_data['tagType']))
				{
					// Set value in session
					$search_session_array['tagType'] = $unserialized_data['tagType'];
					
				}
				/* if(!empty($unserialized_data['location']))
				{
					// Set value in session
					$search_session_array['location'] = $unserialized_data['location'];
					
				} 
				if(!empty($unserialized_data['project']))
				{	
					// Set value in session
					$search_session_array['project'] = $unserialized_data['project'];
				} */
				if(!empty($unserialized_data['daterange']))
				{	
					// Set value in session
					$search_session_array['daterange'] = $unserialized_data['daterange'];
				}
				// Setting session 
				
				 $this->uni_set_session('search', $search_session_array);
				
				// Response data
				$this->Mod_project->response($result_data);
		}
	}

	}
	/** 
	* owner_email_invitation method to send mail to Project Owner
	* 
	* @method: owner_email_invitation 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: Devansh
	* @created on: 14/04/2015 
	*/
	public function owner_email_invitation()
	{
		//sanitize_input will Clean the data transferred to the sever before submitting to model
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			$response = $this->Mod_project->owner_email_invitation($post_array['data']);
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_project->response($response);
	}
	/** 
	* Selected project would be set in all modules of the session
	* 
	* @method: select_project 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: Gopakumar
	* @created on: 21/04/2015 
	*/
	public function select_project()
	{
		if(!empty($this->input->post()))
		{
			// Add role
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				echo '<pre>';print_r($result);exit;
			}
		}
		else
		{
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
		}
		$this->Mod_role->response($result);
	}
	/** 
	* warning page for builder
	* 
	* @method: builder_forbidden_page 
	* @access: public 
	* @param: 
	* @return: array
	* URL : cHJvamVjdHMvYnVpbgxf1Rlcl9mb3JiaWRkZW5fcgxf1FnZS8-
	*/
	public function builder_forbidden_page()
	{
	  $plan_array = array('select_fields' => array('PLAN.no_of_projects'),	
							  'join'=> array('userplan'=>'Yes'),
							  'where_clause' => array('USER_PLAN.builder_id'=>$this->builder_id,'USER_PLAN.status' => 'Active')); 
		$user_plan = $this->Mod_plan->get_plan_details($plan_array);
        $no_of_projects = $user_plan['aaData'][0]['no_of_projects'] ;
		
		$data = array(
		'title'        		=> 'PROJECTS',		
		'content'      		=> 'common/builder_forbidden',
		'page_id'      		=> 'projects',
		'data_table'  		=> 'data_table',
		'project_list' 		=> 'project_list',
        'No_of_projects'	=> $no_of_projects,	
		'date_all'	   		=> 'date_all',
		); 
		
		$this->template->view($data);
	}
	public function from_template()
	{
	
		$data = array(
		'title'        		=> 'PROJECTS',		
		'content'      		=> 'content/projects/from_template',
		'page_id'      		=> 'projects'
		); 
		// Project group drop down values
		$get_project_group = array('classification'=>'project_group', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$project_group_result = $this->Mod_general_value->get_general_value($get_project_group);
		$data['project_group_array'] = $project_group_result['values'];

		//Get all templates of a builder
	    $template_list = $this->Mod_template->get_template(array(
					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),
					'where_clause' => (array('TEMPLATE.builder_id' => $this->user_session['builder_id']))
					));
	 
	    if( $template_list['status'] == TRUE){
			
			
			$data['template_list'] = $this->Mod_project->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name');
	   	}
	   	// Template Modules Checkboxes
		$get_template_modules = array('classification'=>'template_modules');
		$template_modules_result = $this->Mod_general_value->get_general_value($get_template_modules);
		$data['template_modules_array'] = $template_modules_result['values'];

		$this->template->view($data);
	}

	/** 
	* Save Template
	* 
	* @method: save_tempate 
	* @access: public 
	* @param: 
	* @return: array
	* URL : cHJvamVjdHMvc2F2ZV90ZW1wbgxf1F0ZS8-
	*/
	public function save_template()
	{
		$result = $this->sanitize_input();
		//print_r($result);exit;
		$project_info = $this->Mod_project->get_projects(array(
							'select_fields' => array('*'),
							'where_clause' => array('ub_project_id' => $result['data']['project_id'])
							));
		$project_data = $project_info['aaData'][0];
		$project_data['template_name'] = $result['data']['template_name'];

		$response = $this->Mod_template->add_template($project_data);

		$insert_array = array('template_id' => $response['insert_id'],'project_id' => $result['data']['project_id']);

		$schedule_insert_array = array(
										'template_id' => $response['insert_id'],
										'project_id' => $result['data']['project_id'],
										'off_days' => $project_info['aaData'][0]['off_days'],
										'projected_start_date' => $project_info['aaData'][0]['projected_start_date']
									);
		if(isset($result['data']['Schedules']))
		{
			$schedule_info = $this->Mod_schedule->get_schedules(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $result['data']['project_id'])
							));
			if($schedule_info['status'] == TRUE)
			{
				$schedule_info = $schedule_info['aaData'];
				// echo '<pre>';print_r($schedule_info);
				foreach ($schedule_info as $key => $value) 
				{
					$schedule_info[$key]['schedule_id'] = $schedule_info[$key]['ub_schedule_id'];
					$schedule_info[$key]['template_id'] = $response['insert_id'];
					$schedule_info[$key]['created_by'] = $this->user_session['ub_user_id'];
					$schedule_info[$key]['created_on'] = TODAY;
					$schedule_info[$key]['modified_by'] = $this->user_session['ub_user_id'];
					$schedule_info[$key]['modified_on'] = TODAY;
					$old_schedule_id = $schedule_info[$key]['ub_schedule_id'];
					unset($schedule_info[$key]['ub_schedule_id']);
					unset($schedule_info[$key]['template_schedule_id']);
					unset($schedule_info[$key]['import_id']);
					$schedule_insert_response = $this->Mod_template->add_template_schedule($schedule_info[$key] , $schedule_insert_array);
					// echo '<pre>';print_r($schedule_insert_response);
					$schedules_predecessor = $this->Mod_schedule->get_schedules_predecessor(array(
							'select_fields' => array('*'),
							'where_clause' => array('schedule_id' => $old_schedule_id , 'is_delete' => 'No')
							));
					if($schedules_predecessor['status'] == TRUE)
					{
						$schedules_predecessor = $schedules_predecessor['aaData'];
						 foreach ($schedules_predecessor as $key => $value) 
						 {
							$schedules_predecessor[$key]['template_id'] = $response['insert_id'];
							$schedules_predecessor[$key]['template_schedule_id'] = $schedule_insert_response['insert_id']; 
							$schedules_predecessor[$key]['created_by'] = $this->user_session['ub_user_id'];
							$schedules_predecessor[$key]['created_on'] = TODAY;
							$schedules_predecessor[$key]['modified_by'] = $this->user_session['ub_user_id'];
							$schedules_predecessor[$key]['modified_on'] = TODAY;
							unset($schedules_predecessor[$key]['ub_schedule_predecessor_info_id']);
							unset($schedules_predecessor[$key]['import_id']);
						 }
						 // echo '<pre>';print_r($schedules_predecessor);
						$this->Mod_template->add_template_schedule_predecessor_info($schedules_predecessor);
					}	 
				}
			}	
			$this->Mod_template->update_template_schedule_predecessor_parent_id($insert_array);
			// echo '<pre>';print_r('finish');exit;
			// $this->Mod_template->add_template_schedule($schedule_insert_array);
		    // $this->Mod_template->add_template_schedule_predecessor_info($insert_array);
		    $this->Mod_template->add_template_workday_exception($insert_array);
		}		
		if(isset($result['data']['Bids']))
		{
			$bid_info = $this->Mod_bid->get_bids(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $result['data']['project_id'],'is_delete'=>'No')
						));
			if($bid_info['status'] == TRUE){
			$bid_data = $bid_info['aaData'];
			//print_r($bid_data);exit;
			foreach ($bid_data as $key => $value) {

				$insert_data = array();
				$insert_data['template_id'] = $response['insert_id'];
				$insert_data['builder_id'] = $bid_data[$key]['builder_id'];
				$insert_data['bid_id'] = $bid_data[$key]['ub_bid_id'];
				$insert_data['project_id'] = $bid_data[$key]['project_id'];
				$insert_data['package_title'] = $bid_data[$key]['package_title'];
				$insert_data['due_date_time'] = $bid_data[$key]['due_date_time'];
				$insert_data['due_date'] = $bid_data[$key]['due_date'];
				$insert_data['due_time'] = $bid_data[$key]['due_time'];
				$insert_data['daily_sub_reminder'] = $bid_data[$key]['daily_sub_reminder'];
				$insert_data['allow_multi_bids'] = $bid_data[$key]['allow_multi_bids'];
				$insert_data['pricing_format'] = $bid_data[$key]['pricing_format'];
				$insert_data['description'] = $bid_data[$key]['description'];
				$insert_data['status'] = 'In Progress';
				$insert_data['created_by'] = $this->user_session['ub_user_id'];
		        $insert_data['created_on'] = TODAY;
		        $insert_data['modified_by'] = $this->user_session['ub_user_id'];
		        $insert_data['modified_on'] = TODAY;
		        //unset($bid_data[$key]['ub_bid_id']);

				$bid_insert_response = $this->Mod_template->add_template_bid($insert_data);

				$bid_cost_code_info = $this->Mod_bid->get_bid_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $result['data']['project_id'],'bid_id' => $bid_data[$key]['ub_bid_id'])
							));
				if($bid_cost_code_info['status'] == TRUE){
				$bid_cost_code_data = $bid_cost_code_info['aaData'];
		        foreach ($bid_cost_code_data as $key => $value) {
		        $insert_bid_data = array();
			    $insert_bid_data['template_id'] = $response['insert_id'];
			    $insert_bid_data['builder_id'] = $bid_cost_code_data[$key]['builder_id'];
			    $insert_bid_data['template_bid_id'] = $bid_insert_response['insert_id'];
			    $insert_bid_data['cost_code_id'] = $bid_cost_code_data[$key]['cost_code_id'];
			    $insert_bid_data['cost_code_description'] = $bid_cost_code_data[$key]['cost_code_description'];
			    $insert_bid_data['project_id'] = $bid_cost_code_data[$key]['project_id'];
			    $insert_bid_data['status'] = 'In Progress';
			    $insert_bid_data['created_by'] = $this->user_session['ub_user_id'];
			    $insert_bid_data['created_on'] = TODAY;
			    $insert_bid_data['modified_by'] = $this->user_session['ub_user_id'];
			    $insert_bid_data['modified_on'] = TODAY;
			    //unset($bid_cost_code_data[$key]['ub_bid_cost_code_id']);
			    //print_r($insert_bid_data);exit;
			    $this->Mod_template->add_template_bid_cost_code($insert_bid_data);	
		       }
		      }
				//print_r($bid_insert_response);exit;
			}
		  }	
			//$this->Mod_template->add_template_bid($insert_array);
		    //$this->Mod_template->add_template_bid_cost_code($insert_array);
		  $this->Mod_template->add_template_checklist($insert_array);
		}
			
		if(isset($result['data']['PO']))
		{
			$po_co_info = $this->Mod_po_co->get_po_co(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $result['data']['project_id'],'type' => 'PO','is_delete'=>'No')
							));
	 	    if($po_co_info['status'] == TRUE){
			$po_co_data = $po_co_info['aaData'];
			//print_r($bid_data);exit;
			foreach ($po_co_data as $key => $value) {

				$insert_data = array();
				$insert_data['template_id'] = $response['insert_id'];
				$insert_data['po_co_id'] = $po_co_data[$key]['ub_po_co_id'];
				$insert_data['ub_po_co_number'] = $po_co_data[$key]['ub_po_co_number'];
				$insert_data['assigned_to'] = $po_co_data[$key]['assigned_to'];
				$insert_data['builder_id'] = $po_co_data[$key]['builder_id'];
				$insert_data['project_id'] = $po_co_data[$key]['project_id'];
				$insert_data['type'] = $po_co_data[$key]['type'];
				$insert_data['title'] = $po_co_data[$key]['title'];
				$insert_data['materials_only'] = $po_co_data[$key]['materials_only'];
				$insert_data['notes'] = $po_co_data[$key]['notes'];
				$insert_data['scope_of_work'] = $po_co_data[$key]['scope_of_work'];
				$insert_data['due_date_time'] = $po_co_data[$key]['due_date_time'];
				$insert_data['due_date'] = $po_co_data[$key]['due_date'];
				$insert_data['due_time'] = $po_co_data[$key]['due_time'];
				$insert_data['po_status'] = 'Not Released';
				$insert_data['created_by'] = $this->user_session['ub_user_id'];
		        $insert_data['created_on'] = TODAY;
		        $insert_data['modified_by'] = $this->user_session['ub_user_id'];
		        $insert_data['modified_on'] = TODAY;
		        //unset($bid_data[$key]['ub_bid_id']);
		        //print_r($insert_data);exit;
				$po_insert_response = $this->Mod_template->add_template_po_co($insert_data);
				//print_r($po_insert_response);exit;
				$po_co_cost_code_info = $this->Mod_po_co->get_po_co_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' =>$result['data']['project_id'],'type' => 'PO','po_co_id' => $po_co_data[$key]['ub_po_co_id'])
							));

				
				if($po_co_cost_code_info['status'] == TRUE){
				$po_co_cost_code_data = $po_co_cost_code_info['aaData'];
		        foreach ($po_co_cost_code_data as $key => $values) {
		        $insert_po_data = array();
			    $insert_po_data['template_id'] = $response['insert_id'];
			    $insert_po_data['builder_id'] = $po_co_cost_code_data[$key]['builder_id'];
			    $insert_po_data['type'] = $po_co_cost_code_data[$key]['type'];
			    $insert_po_data['template_po_co_id'] = $po_insert_response['insert_id'];
			    $insert_po_data['cost_code_id'] = $po_co_cost_code_data[$key]['cost_code_id'];
			    $insert_po_data['quantity'] = $po_co_cost_code_data[$key]['quantity'];
			    $insert_po_data['unit_cost'] = $po_co_cost_code_data[$key]['unit_cost'];
			    $insert_po_data['total'] = $po_co_cost_code_data[$key]['total'];
			    $insert_po_data['project_id'] = $po_co_cost_code_data[$key]['project_id'];
			    $insert_po_data['status'] = 'Not Released';
			    $insert_po_data['created_by'] = $this->user_session['ub_user_id'];
			    $insert_po_data['created_on'] = TODAY;
			    $insert_po_data['modified_by'] = $this->user_session['ub_user_id'];
			    $insert_po_data['modified_on'] = TODAY;
			    //unset($bid_cost_code_data[$key]['ub_bid_cost_code_id']);
			    //print_r($insert_bid_data);exit;
			    $this->Mod_template->add_template_po_co_cost_code($insert_po_data);	
		       }
		      }
				
			}
		  }	
			
			//$this->Mod_template->add_template_po_co($insert_array);
		    //$this->Mod_template->add_template_po_co_cost_code($insert_array);
		}
		if(isset($result['data']['Selections']))
		{
			//Insert in ub_template_selection table
			$selections_info = $this->Mod_selections->get_selections(array(
								'select_fields' => array('*'),
								'where_clause' => array('project_id' => $result['data']['project_id'])
								));
			// echo '<pre>';print_r($selections_info);exit;					
			if($selections_info['status'] == TRUE)
			{	
				$selections_array = $selections_info['aaData'];
				foreach($selections_array as $key => $val)
				{
					$selections_array[$key]['template_id'] = $response['insert_id'];
					$selections_array[$key]['status'] = 'New';
					$selections_array[$key]['created_on'] = TODAY;
					$selections_array[$key]['created_by'] = $this->user_id;
					$selections_array[$key]['selection_id'] = $selections_array[$key]['ub_selection_id'];
					//unset($selections_array[$key]['owner_id']);
					unset($selections_array[$key]['vendor_id']);
					unset($selections_array[$key]['installer_id']);
					unset($selections_array[$key]['due_date_time']);
					unset($selections_array[$key]['due_date']);
					unset($selections_array[$key]['due_time']);
					unset($selections_array[$key]['is_delete']);
					$old_selection_id = $selections_array[$key]['ub_selection_id'];
					unset($selections_array[$key]['ub_selection_id']);
					
					// echo '<pre>';print_r($selections_array[$key]);
					$selection_insert_response = $this->Mod_template->add_template_selections($selections_array[$key]);	
					$choice = $this->Mod_selections->get_selection_choice_list(array(
								'select_fields' => array('*'),
								'where_clause' => array('selection_id' => $old_selection_id)
							));
					if(isset($choice['aaData']))
					{
						$i = 0;
						foreach($choice['aaData'] as $key1 => $val1)
						{
							$val1['template_id'] = $response['insert_id'];
							$val1['template_selection_id'] = $selection_insert_response['insert_id']; 
							$val1['status'] = 'Pending';
							$val1['created_on'] = TODAY;
							$val1['created_by'] = $this->user_id;
							unset($val1['ub_selection_choice_id']);
							unset($val1['vendor_id']);
							unset($val1['installer_id']);
							$selection_choices[$i++] = $val1;
						}
						// echo '<pre>';print_r($selection_choices);
						$this->Mod_template->add_template_selection_choices($selection_choices);
					}
				}	
			}
			// echo '<pre>';print_r('finidh');exit;
		}	
		if(isset($result['data']['Estimate']))
		{

			$this->Mod_template->add_template_estimate($insert_array);
		}
		if(isset($result['data']['Tasks']))
		{
			$task_info = $this->Mod_task->get_task(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $result['data']['project_id'])
							));
			
			if($task_info['status'] == TRUE){
			$task_data = $task_info['aaData'];
			//print_r($task_data);exit;
			foreach ($task_data as $key => $value) {

				$insert_data = array();
				$insert_data['template_id'] = $response['insert_id'];
				$insert_data['task_id'] = $task_data[$key]['ub_task_id'];
				$insert_data['project_id'] = $task_data[$key]['project_id'];
				$insert_data['builder_id'] = $task_data[$key]['builder_id'];
				$insert_data['title'] = $task_data[$key]['title'];
				$insert_data['note'] = $task_data[$key]['note'];
				$insert_data['mark_complete_status'] = $task_data[$key]['mark_complete_status'];
				$insert_data['due_date_time'] = $task_data[$key]['due_date_time'];
				$insert_data['due_time'] = $task_data[$key]['due_time'];
				$insert_data['priority'] = $task_data[$key]['priority'];
				$insert_data['tags'] = $task_data[$key]['tags'];
				$insert_data['status'] = 'Not complete';
				$insert_data['created_by'] = $this->user_session['ub_user_id'];
		        $insert_data['created_on'] = TODAY;
		        $insert_data['modified_by'] = $this->user_session['ub_user_id'];
		        $insert_data['modified_on'] = TODAY;
		        //unset($bid_data[$key]['ub_bid_id']);
				$task_insert_response = $this->Mod_template->add_template_task($insert_data);

				/*$task_checklist_info = $this->Mod_checklist->get_task_check_list(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'],'bid_id' => $bid_data[$key]['ub_bid_id'])
							));
*/
				$task_checklist_info = $this->Mod_checklist->get_task_check_list(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $result['data']['project_id'],'task_id' => $task_data[$key]['ub_task_id'])
							));
				//print_r($task_checklist_info);exit;
				if($task_checklist_info['status'] == TRUE){
				$task_checklist_data = $task_checklist_info['aaData'];
		        foreach ($task_checklist_data as $key => $value) {
		        $insert_checklist_data = array();
			    $insert_checklist_data['template_id'] = $response['insert_id'];
			    $insert_checklist_data['template_task_id'] = $task_insert_response['insert_id'];
			    $insert_checklist_data['mark_complete_status'] = $task_checklist_data[$key]['mark_complete_status'];
			    $insert_checklist_data['Description'] = $task_checklist_data[$key]['Description'];
			    $insert_checklist_data['project_id'] = $task_checklist_data[$key]['project_id'];
			    $insert_checklist_data['builder_id'] = $task_checklist_data[$key]['builder_id'];
			    $insert_checklist_data['created_by'] = $this->user_session['ub_user_id'];
			    $insert_checklist_data['created_on'] = TODAY;
			    $insert_checklist_data['modified_by'] = $this->user_session['ub_user_id'];
			    $insert_checklist_data['modified_on'] = TODAY;
			    //unset($bid_cost_code_data[$key]['ub_bid_cost_code_id']);
			    //print_r($insert_bid_data);exit;
			    $this->Mod_template->add_template_task_checklist($insert_checklist_data);	
		       }
		      }
				//print_r($bid_insert_response);exit;
			}
		   }	
			//$this->Mod_template->add_template_task($insert_array);
			//$this->Mod_template->add_template_task_checklist($insert_array);
		}
		

	    $this->Mod_project->response($response);
	}
	/** 
	* Create Project From Template
	* 
	* @method: create_project_from_tempate 
	* @access: public 
	* @param: 
	* @return: array
	* URL : cHJvamVjdHMvY3JlYXRlX3Byb2plY3RfZnJvbV90ZW1wYXRlLw--
	*/
	public function create_project_from_tempate()
	{
		$result = $this->sanitize_input();
		if(isset($result['data']['projected_start_date']))
		{
			$result['data']['projected_start_date'] = date("Y-m-d", strtotime($result['data']['projected_start_date']));
		}
		else
		{
			$result['data']['projected_start_date'] = '';
		}
		if(isset($result['data']['project_group']) && $result['data']['project_group'] !== null && $result['data']['project_group']!='Nothing selected')
		{
			$result['data']['project_group'] = "".implode(",", $result['data']['project_group'])."";
		}
		else
		{
			$result['data']['project_group'] = '';
		}
		$off_days = '';
		$all_work_days = array(0,1,2,3,4,5,6);
		$result_days=array_diff($all_work_days,$result['data']['work_days']);
		if(!empty($result_days))
		{
			$off_days = ",".implode(',', $result_days).",";
		}

		$project_insert_array = array(
			'project_group' => $result['data']['project_group'],
			'project_name' => $result['data']['project_name'],
			'builder_id' => $this->builder_id,
			'projected_start_date' => $result['data']['projected_start_date'],
			'work_days' => isset($result['data']['work_days']) ? ",".implode(',', $result['data']['work_days'])."," : "No",
			'off_days' => $off_days,
			);

		$response = $this->Mod_project->add_project($project_insert_array);
		$project_id = $response['ub_project_id'];

		//Once proj inserted update the same with proj number
		$proj_name_format = strtoupper(substr($result['data']['project_name'], 0, 3));
		$project_no = $this->Mod_project->generate_number($proj_name_format,PROJ_NUM_LEN,$project_id);
		$project_update = array(
								'ub_project_id' => $project_id,
								'owner_id' => 0,
								'project_no' => $project_no);
		$update_proj_num = $this->Mod_project->update_project($project_update);

		//Insert in UB_BID table
		if(isset($result['data']['Bids']))
		{
		  //Insert in UB_CHECKLIST table
		  $template_checklist_info = $this->Mod_template->get_template_checklist(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		  if($template_checklist_info['status'] == TRUE)
		  {
		   $checklist_data = $template_checklist_info['aaData'];
		   foreach ($checklist_data as $check_key => $check_value) {
		 	$check_value['project_id'] = $project_id;
		 	$check_value['created_on'] = TODAY;
		 	$check_value['modified_on'] = TODAY;
		 	$check_value['created_by'] = $this->user_session['ub_user_id'];
		 	$check_value['modified_by'] = $this->user_session['ub_user_id'];
		    unset($check_value['ub_template_checklist_id']);
		    unset($check_value['template_id']);
			$this->Mod_checklist->add_check_list($check_value);	
		  }
	     } 
		$template_bid_info = $this->Mod_template->get_template_bid(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		//print_r($template_bid_info);exit;
		if($template_bid_info['status'] == TRUE)
		{
		 $bid_data = $template_bid_info['aaData'];
		 foreach ($bid_data as $key => $value) {
		 	$bid_id = $value['bid_id'];
		 	$ub_template_bid_id = $value['ub_template_bid_id'];
		 	$value['project_id'] = $project_id;
		 	$value['created_on'] = TODAY;
		 	$value['modified_on'] = TODAY;
		 	$value['created_by'] = $this->user_session['ub_user_id'];
		 	$value['modified_by'] = $this->user_session['ub_user_id'];
		    unset($value['ub_template_bid_id']);
		    unset($value['bid_id']);
		    unset($value['due_date_time']);
		    unset($value['due_date']);
		    unset($value['due_time']);
		    unset($value['template_id']);
		    unset($value['checklist_id']);
		    unset($value['released_date']);
			$bid_response = $this->Mod_bid->add_bid($value);
			
			
				$template_bid_cost_code_info = $this->Mod_template->get_template_bid_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'],'template_bid_id' => $ub_template_bid_id)
							));
			
			
		      if($template_bid_cost_code_info['status'] == TRUE)
		      {
		        $bid_cost_code_data = $template_bid_cost_code_info['aaData'];
		        foreach ($bid_cost_code_data as $keys => $values) {
		 	    $values['project_id'] = $project_id;
		 	    $values['bid_id'] = $bid_response['insert_id'];
		 	    $values['created_on'] = TODAY;
		 	    $values['modified_on'] = TODAY;
		 	    $values['created_by'] = $this->user_session['ub_user_id'];
		 	    $values['modified_by'] = $this->user_session['ub_user_id'];
		        unset($values['ub_template_bid_cost_code_id']);
		        unset($values['template_id']);
		        unset($values['template_bid_id']);
		        unset($values['bid_id']);
			    $this->Mod_bid->add_bid_cost_code($values);
			
		      }
	         }
	        }
		   
	      }
	   }
	   if(isset($result['data']['PO']))
	   {
	    //Insert in UB_PO_CO table
		$template_po_co_info = $this->Mod_template->get_template_po_co(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		if($template_po_co_info['status'] == TRUE)
		{
		 $po_co_data = $template_po_co_info['aaData'];
		 foreach ($po_co_data as $key => $value) {
		 	$value['project_id'] = $project_id;
		 	$po_co_id = $value['po_co_id'];
		 	$ub_template_po_co_id = $value['ub_template_po_co_id'];
		 	$value['created_on'] = TODAY;
		 	$value['modified_on'] = TODAY;
		 	$value['created_by'] = $this->user_session['ub_user_id'];
		 	$value['modified_by'] = $this->user_session['ub_user_id'];
		    unset($value['ub_template_po_co_id']);
		    unset($value['po_co_id']);
		    unset($value['due_date_time']);
		    unset($value['due_date']);
		    unset($value['due_time']);
		    unset($value['paid_amount']);
		    unset($value['signature_file_id']);
		    unset($value['signature_content']);
		    unset($value['template_id']);
			$po_co_response = $this->Mod_po_co->add_po_co_template($value);
			
		 
		 	$template_po_co_cost_code_info = $this->Mod_template->get_template_po_co_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'],'template_po_co_id' => $ub_template_po_co_id)
							));
		 
		 

		 	 if($template_po_co_cost_code_info['status'] == TRUE)
		      {
		        $po_co_cost_code_data = $template_po_co_cost_code_info['aaData'];
		        foreach ($po_co_cost_code_data as $keys => $values) {
		        //print_r($bid_value);
		 	   $values['project_id'] = $project_id;
		 	   $values['po_co_id'] = $po_co_response['insert_id'];
		 	   $values['created_on'] = TODAY;
		 	   $values['modified_on'] = TODAY;
		 	   $values['created_by'] = $this->user_session['ub_user_id'];
		 	   $values['modified_by'] = $this->user_session['ub_user_id'];
		       unset($values['ub_template_po_co_cost_code_id']);
		       unset($values['template_id']);
		       unset($values['paid_amount']);
		       unset($values['requested_amount']);
		       unset($values['template_po_co_id']);
			   $this->Mod_po_co->add_po_co_cost_code($values);
			
		      }
	         }
		 }
	    }
	   }
	   
		if(isset($result['data']['Estimate']))
		{
		//Insert in UB_ESTIMATE table
		$template_estimate_info = $this->Mod_template->get_template_estimate(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		if($template_estimate_info['status'] == TRUE)
		{
			$estimate_data = $template_estimate_info['aaData'];
			foreach ($estimate_data as $key => $value)
			{
				$value['project_id'] = $project_id;
				unset($value['ub_template_estimate_id']);
				unset($value['estimate_id']);
				unset($value['template_id']);
				$this->Mod_budget->add_estimate($value);
			}
	     } 
	    }
		/* Task import code added by chandru */
		if(isset($result['data']['Tasks']))
		{
		//Insert in UB_ESTIMATE table
		$template_estimate_info = $this->Mod_template->get_template_task(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		if($template_estimate_info['status'] == TRUE)
		{
			$estimate_data = $template_estimate_info['aaData'];
			foreach ($estimate_data as $key => $value)
			{
				$value['project_id'] = $project_id;
				unset($value['ub_template_task_id']);
				unset($value['task_id']);
				unset($value['template_id']);
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
					$values['project_id'] = $project_id;
					unset($values['ub_template_task_checklist_id']);
					unset($values['template_id']);
					$this->Mod_task->add_checklist_template($values);
					}
				}
			
			
	     } 
	    }
		
		if(isset($result['data']['Selections']))
		{
			//Insert in UB_SELECTION table
			$template_selection_info = $this->Mod_template->get_template_selection(array(
								'select_fields' => array('*'),
								'where_clause' => array('template_id' => $result['data']['template_id'])
								));
			if($template_selection_info['status'] == TRUE)
			{
				$selection_data = $template_selection_info['aaData'];
				foreach ($selection_data as $key => $value)
				{
					$value['project_id'] = $project_id;
					unset($value['ub_template_selection_id']);
					unset($value['template_id']);
					$res = $this->Mod_selections->add_selections($value);
					$choice = $this->Mod_template->get_template_selection_choices(array(
								'select_fields' => array('*'),
								'where_clause' => array('template_id' => $result['data']['template_id'] , 'selection_id' => $value['selection_id'])
							));
					if($choice['status'] == TRUE)
					{
						foreach($choice['aaData'] as $key1 => $val1)
						{
							$val1['selection_id'] = $res['insert_id'];
							$val1['owner_id'] = $value['owner_id'];
							unset($val1['ub_template_selection_choice_id']);
							unset($val1['template_id']);
							$this->Mod_selections->add_selection_choices($val1);
						}
					}
				}
			}
		}
		
		if(isset($result['data']['Schedules']))
		{
			//Insert in UB_WORKDAY_EXCEPTION table
			$template_workday_exception_info = $this->Mod_template->get_template_workday_exception(array(
								'select_fields' => array('*'),
								'where_clause' => array('template_id' => $result['data']['template_id'])
								));
			if($template_workday_exception_info['status'] == TRUE)
			{
				$workday_exception_data = $template_workday_exception_info['aaData'];
				foreach ($workday_exception_data as $key => $value) 
				{
					$workday_exception_data[$key]['type'] = $value['exception_type'];
					$workday_exception_data[$key]['project_id'] = $project_id;
					$workday_exception_data[$key]['created_on'] = TODAY;
					$workday_exception_data[$key]['modified_on'] = TODAY;
					$workday_exception_data[$key]['created_by'] = $this->user_session['ub_user_id'];
					$workday_exception_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
					unset($workday_exception_data[$key]['ub_template_workday_exception_id']);
					unset($workday_exception_data[$key]['template_id']);
					unset($workday_exception_data[$key]['exception_type']);
				}
				$this->Mod_template->insert_workday_exception($workday_exception_data);
			}
			//Insert in UB_SCHEDULE_PREDECESSOR_INFO table
			//echo "<pre>"; print_r($result);exit;
			/* $template_schedule_predecessor_info = $this->Mod_template->get_template_schedule_predecessor_info(array(
								'select_fields' => array('*'),
								'where_clause' => array('template_id' => $result['data']['template_id'])
								));
			if($template_schedule_predecessor_info['status'] == TRUE)
			{
				$schedule_predecessor_data = $template_schedule_predecessor_info['aaData'];
				foreach ($schedule_predecessor_data as $key => $value) 
				{
					$schedule_predecessor_data[$key]['project_id'] = $project_id;
					$schedule_predecessor_data[$key]['created_on'] = TODAY;
					$schedule_predecessor_data[$key]['modified_on'] = TODAY;
					$schedule_predecessor_data[$key]['created_by'] = $this->user_session['ub_user_id'];
					$schedule_predecessor_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
					unset($schedule_predecessor_data[$key]['ub_template_schedule_predecessor_info_id']);
					unset($schedule_predecessor_data[$key]['template_id']);
				}
				$this->Mod_template->insert_schedule_predecessor_info($schedule_predecessor_data);
			}

			//Insert in UB_SCHEDULE table
			$template_schedule_info = $this->Mod_template->get_template_schedule(array(
								'select_fields' => array('*'),
								'where_clause' => array('template_id' => $result['data']['template_id'])
								));
			if($template_schedule_info['status'] == TRUE)
			{
				$schedule_data = $template_schedule_info['aaData'];
				foreach ($schedule_data as $key => $value) 
				{
					$schedule_data[$key]['project_id'] = $project_id;
					$schedule_data[$key]['created_on'] = TODAY;
					$schedule_data[$key]['modified_on'] = TODAY;
					$schedule_data[$key]['created_by'] = $this->user_session['ub_user_id'];
					$schedule_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
					unset($schedule_data[$key]['ub_template_schedule_id']);
					unset($schedule_data[$key]['template_id']);
					unset($schedule_data[$key]['schedule_id']);
					//unset($schedule_data[$key]['project_schedule_startdates_diff_in_days']);
				}
				$this->Mod_template->insert_schedule($schedule_data);
			} */
			
			//to get an unique id for import					
			$import_id = $this->Mod_template->generate_template_import_number('IMP',6,$result['data']['template_id']);	
			$insert_array = array('template_id' => $result['data']['template_id'],'project_id' => $project_id,'import_id' => $import_id);
			$template_schedule_info = $this->Mod_template->get_template_schedule(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
			// echo '<pre>';print_r($template_schedule_info);exit;					
			if($template_schedule_info['status'] == TRUE)
			{
				$schedule_data = $template_schedule_info['aaData'];
				foreach ($schedule_data as $key => $value) 
				{
					$schedule_data[$key]['project_id'] = $project_id;
					$schedule_data[$key]['template_schedule_id'] = $schedule_data[$key]['ub_template_schedule_id'];
					$schedule_data[$key]['import_id'] = $import_id;
					$schedule_data[$key]['created_on'] = TODAY;
					$schedule_data[$key]['modified_on'] = TODAY;
					$schedule_data[$key]['created_by'] = $this->user_session['ub_user_id'];
					$schedule_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
					$old_schedule_id = $schedule_data[$key]['ub_template_schedule_id'];
					unset($schedule_data[$key]['ub_template_schedule_id']);
					unset($schedule_data[$key]['template_id']);
					unset($schedule_data[$key]['schedule_id']);
					// echo '<pre>';print_r($schedule_data[$key]);exit;
					$schedule_insert_response = $this->Mod_template->insert_schedule($schedule_data[$key]);
					//unset($schedule_data[$key]['project_schedule_startdates_diff_in_days']);
					// echo '<pre>';print_r($schedule_insert_response);exit;
					$template_schedule_predecessor_info = $this->Mod_template->get_template_schedule_predecessor_info(array(
									'select_fields' => array('*'),
									'where_clause' => array('template_id' => $result['data']['template_id'], 'template_schedule_id' => $old_schedule_id)
									));
					// echo '<pre>';print_r($template_schedule_predecessor_info);				
					if($template_schedule_predecessor_info['status'] == TRUE)
					{
						$schedule_predecessor_data = $template_schedule_predecessor_info['aaData'];
						foreach ($schedule_predecessor_data as $key => $value) 
						{
							$schedule_predecessor_data[$key]['schedule_id'] = $schedule_insert_response['insert_id']; 
							$schedule_predecessor_data[$key]['project_id'] = $project_id;
							$schedule_predecessor_data[$key]['import_id'] = $import_id;
							$schedule_predecessor_data[$key]['created_on'] = TODAY;
							$schedule_predecessor_data[$key]['modified_on'] = TODAY;
							$schedule_predecessor_data[$key]['created_by'] = $this->user_session['ub_user_id'];
							$schedule_predecessor_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
							unset($schedule_predecessor_data[$key]['ub_template_schedule_predecessor_info_id']);
							unset($schedule_predecessor_data[$key]['template_id']);
							unset($schedule_predecessor_data[$key]['template_schedule_id']);
						}
						$this->Mod_template->insert_schedule_predecessor_info($schedule_predecessor_data);
					}
				}
				// $this->Mod_template->update_schedule_start_date($insert_array);
				$this->Mod_template->update_schedule_predecessor_parent_id($insert_array);
			}
	    }
		$this->Mod_project->response($response);
	}
	
	public function save_signoff()
	{
		$results = $this->sanitize_input();
		if(is_array($results['data']['ub_signoff_documents_info_id']) && isset($results['data']['ub_signoff_documents_info_id'][0]) && !empty($results['data']['ub_signoff_documents_info_id'][0]))
		{
			/* Update sign_off table */
			$update_in_signoff = array(
					'builder_id' => $this->builder_id,
                    'user_id' => $this->user_id,
                    'ub_signoff_documents_info_id' => $results['data']['ub_signoff_documents_info_id'],
					'project_id' => $results['data']['ub_project_id'],
                    'documentname' => $results['data']['documentname'],
                    'comments' => $results['data']['comments']
                    );	
                    $responses = $this->Mod_project->update_in_signoff($update_in_signoff);
					$this->Mod_project->response($responses);
		}else{
		$insert_in_signoff = array(
                    'builder_id' => $this->builder_id,
                    'user_id' => $this->user_id,
                    'project_id' => $results['data']['ub_project_id'],
                    'documentname' => $results['data']['documentname'],
                    'comments' => $results['data']['comments']
                    );		
                    $responses = $this->Mod_project->insert_in_signoff($insert_in_signoff);
					$this->Mod_project->response($responses);
					}
					// echo '<pre>';print_r($responses);exit;
	}
	
	public function change_project_signoff_status()
	{
		$results = $this->sanitize_input();
		if($results['status'] == TRUE)
		{
			$status_array = array(
					'signoff_status' =>'waiting_for_owner_approval'
					);
			$responses = $this->Mod_project->change_project_signoff_status($status_array,$results['data']['project_id']);
			$this->Mod_project->response($responses);
		}
	}
	
	public function owner_sign_off_approve()
	{
		$results = $this->sanitize_input();
		//print_r($results);exit;
			/* Update sign_off table */
			$project_id = $results['data']['sign_off_ub_project_id'];
			$update_status = array(
					'signoff_status' => 'owner_approved'
                    );	
                    $responses = $this->Mod_project->update_in_project_table_signoff_details($update_status,$project_id);

            $signature = array(
					'search_params' => "'".serialize($results['data']['output'])."'"
				     );

	    	$signature_array = array(
    	     'signature_content' => $signature['search_params'],
    	     'ub_project_id' => $project_id,
    	    );
		    //print_r($signature_array);exit;
		    $signature_response = $this->Mod_project->add_signature($signature_array);
					// $this->Mod_project->response($responses);
					// echo '<pre>';print_r($responses);exit;
	}
	
	public function sign_off_approve_by_builder()
	{
		$results = $this->sanitize_input();
		if($results['status'] == TRUE)
		{
			$status_array = array(
					'signoff_status' => 'sign_off_approve_by_builder'
					);
			$responses = $this->Mod_project->change_project_signoff_status($status_array,$results['data']['project_id']);
			$this->Mod_project->response($responses);
		}
	}
	
	public function punch_list_sign_off_approve()
	{
		$results = $this->sanitize_input();
		if($results['status'] == TRUE)
		{
			$status_array = array(
					'project_id' => $results['data']['project_id']
					);
			$responses = $this->Mod_punchlist->update_punchlist_from_sign_off($status_array);
		}
	}



/** 
	* Get Project Pagination
	* 
	* @method: get_project_pagination 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @author: Sidhartha
	*/	
	public function get_project_pagination($page_count = '')
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
									'field_name' => 'PROJECT.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'PROJECT.project_status',
									'value'=> 'Deleted', 
									'type' => '!='
									);
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();

				if(isset($this->uni_session_get('SEARCH')['project_group']) && $this->uni_session_get('SEARCH')['project_group']!='' && $this->uni_session_get('SEARCH')['project_group']!= 'null' && $this->uni_session_get('SEARCH')['project_group']!= 'null' && $this->uni_session_get('SEARCH')['project_group'] != 'Nothing selected')
				{
					$post_array[] = array(
										'field_name' => 'PROJECT.project_group',
										'value'=> $this->uni_session_get('SEARCH')['project_group'], 
										'type' => '||',
										'classification' => 'dynamnic_text'
										);
					//$search_session_array['project_group'] = $result['data']['project_group'];
				}
				// Assigning project managers in session and search param
				if(isset($this->uni_session_get('SEARCH')['project_managers']) && $this->uni_session_get('SEARCH')['project_managers']!='' && $this->uni_session_get('SEARCH')['project_managers']!= 'null' && $this->uni_session_get('SEARCH')['project_managers'] != 'Nothing selected')
				{
					$post_array[] = array(
										'field_name' => 'PROJECT.project_managers',
										'value'=> $this->uni_session_get('SEARCH')['project_managers'], 
										'type' => '||',
										'classification' => 'dynamnic_text'
										);
					//$search_session_array['project_managers'] = $result['data']['project_managers'];
				}
				// Assigning project status in session and search param
				if(isset($this->uni_session_get('SEARCH')['project_status']) && $this->uni_session_get('SEARCH')['project_status']!='' && $this->uni_session_get('SEARCH')['project_status']!= 'null' && $this->uni_session_get('SEARCH')['project_status'] != 'Nothing selected')
				{
					$post_array[] = array(
										'field_name' => 'PROJECT.project_status',
										'value'=> $this->uni_session_get('SEARCH')['project_status'], 
										'type' => '=',
										'classification' => 'dynamnic_text'
										);
					//$search_session_array['project_status'] = $result['data']['project_status'];
				}
				
				// Assigning mapped projects in session and search param
				if((isset($this->uni_session_get('SEARCH')['mapped_projects']) && $this->uni_session_get('SEARCH')['mapped_projects']!= '' && $this->uni_session_get('SEARCH')['mapped_projects']!= 'null' && $this->uni_session_get('SEARCH')['mapped_projects'] != 'Nothing selected') OR $query_type == 'map')
				{
					$mapped_type = (isset($this->uni_session_get('SEARCH')['mapped_projects']))?$this->uni_session_get('SEARCH')['mapped_projects']:''; 
					
					if($query_type == 'map')
					{
						$mapped_type = 'mapped';
					}
					else
					{
						$search_session_array['mapped_projects'] = $this->uni_session_get('SEARCH')['mapped_projects'];

					}
					switch($mapped_type)
					{
						case 'mapped':
						{
							$post_array[] = array(
										'field_name' => 'PROJECT.latitude',
										'value'=> 'NULL', 
										'type' => 'IS NOT',
										'classification' => 'dynamnic_text'
										);
						
							$post_array[] = array(
										'field_name' => 'PROJECT.longitude',
										'value'=> 'NULL', 
										'type' => 'IS NOT',
										'classification' => 'dynamnic_text'
										);
							break;
						}
						case 'unmapped':
						{
							$post_array[] = array(
										'field_name' => 'PROJECT.latitude',
										'value'=> 'NULL', 
										'type' => 'IS',
										'classification' => 'dynamnic_text'
										);
						
							$post_array[] = array(
										'field_name' => 'PROJECT.longitude',
										'value'=> 'NULL', 
										'type' => 'IS',
										'classification' => 'dynamnic_text'
										);
							break;
						}
					}
				}
				
				/*
					Paggination length stored in seesion code start here
				*/
				
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
				
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				//echo "<pre>";print_r($post_array);exit;
				$where_str = $this->Mod_project->build_where($post_array);
				//echo $where_str;
				//code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('projects')][strtolower('view all')]) && $this->user_role_access[strtolower('projects')][strtolower('view all')] == 1)
				{
					$where_str = $where_str;
				}
				else if(isset($this->user_role_access[strtolower('projects')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('projects')][strtolower('view assigned to me')] == 1)
				{
					$where_str = $where_str.' AND (PROJECT.created_by = '.$this->user_id.' || PROJECT.owner_id = '.$this->user_id.' || PROJECT.project_managers = '.$this->user_id.' || FIND_IN_SET('.$this->user_id.', PROJECT.project_assigned_users))';
				}
				
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
					$format_sort_name = $this->Mod_project->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'PROJECT.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
				}
				else
				{
					$order_by_where = 'PROJECT.modified_on DESC';
				}
				//$date_array = array('LOG.log_date'=>'log_date');
				// Fetch argument building
				
                // Fetch argument building
                $log_args = array('select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
                'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$result_data = $this->Mod_project->get_projects($log_args);
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
					$total_count_array = $this->Mod_project->get_projects(array(
												'select_fields' => array('COUNT(PROJECT.ub_project_id) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_project->response($result_data);
			}
			else
			{
				$this->Mod_project->response($result);
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