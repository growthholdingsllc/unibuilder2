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

		$this->load->model(array('Mod_template','Mod_saved_search','Mod_project','Mod_general_value'));

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
		//$this->module = 'TEMPLATE';
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
		'title'        		=> 'TEMPLATE',		
		'content'      		=> 'template/content/template/template',
        'page_id'      		=> 'logs',
		'data_table'  		=> 'data_table',
		'project_list' 		=> 'template_list',      
		'date_all'	   		=> 'date_all',
		'apply_filter' => $result_data['status'],
		'save_project_url' 	=> $this->crypt->encrypt('template/projects/save_tempate/'),
		'current_url' 		=> $this->uri->segment(1),
		'delete_projects_url' => $this->crypt->encrypt('template/projects/delete_template/'),
		'search_session_array' => $this->uni_session_get('SEARCH')
		); 
		// Code to fetch the grid settings pop up information 
		/*$data['grid_settings_popup']=$this->uni_get_grid_settings_popup_info();	
		$data['datatable_headers']=$data['grid_settings_popup']['datatable_headers'];
		unset($data['grid_settings_popup']['datatable_headers']);
		// code to get the project_group dropdown in project landing page
 		$get_project_group = array('classification'=>'project_group', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
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
		*/
 		$this->template->view($data);		
	}
	/** 
	* Get Template
	* 
	* @method: get_template 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/	
	public function get_template($page_count = '')
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
									'field_name' => 'TEMPLATE.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				//$this->module = 'TEMPLATE';
				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				$where_str = $this->Mod_template->build_where($post_array);
				//append where condition by satheesh kumar
				if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);

					 $total_count_array = $this->Mod_template->get_template(array(
												'select_fields' => array('COUNT(TEMPLATE.ub_template_id) AS total_count'),
												'where_clause' => $where_str,
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					 $total_count_array = $this->Mod_template->get_template(array(
												'select_fields' => array('COUNT(TEMPLATE.ub_template_id) AS total_count'),
												'where_clause' => $where_str,
												));
				}
				
				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_template->get_template(array(
												'select_fields' => array('COUNT(TEMPLATE.ub_template_id) AS total_count'),
												'where_clause' => $where_str,
												));
				}*/
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
						$order_by_where = 'TEMPLATE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
	
				}
				else
				{
					$order_by_where = 'TEMPLATE.modified_on DESC';
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
		$log_args = array('select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name','TEMPLATE.project_managers','TEMPLATE.work_days','TEMPLATE.created_by','CONCAT_WS(" ",USER.first_name,USER.last_name) as first_name'),
                'join'=> array('user'=>'Yes'),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
		
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
		$result_data = $this->Mod_template->get_template($log_args);
		if($page_count == 'result_array')
		{
		  //print_r($result_data);exit;
		  return $result_data;
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
	* Save templates
	* 
	* @method: save_tempates 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9uZXdfbgxf19nLw--
	* @url: bgxf19ncy9zYXZlX2xvZy8-
	*/	
	public function save_templates($ub_template_id = 0)
	{
		$result_data = array();
		$post_data = array();
		$data = array(
				    'title'        => "TEMPLATE",		
				    'content'      => 'template/content/template/save_template',
				    'drop_upload'  => 'drop_upload',
				    'page_id'      => 'logs',
				    'date_all'	   =>'date_all',
				  	);
		
		//get project id from task table // by satheesh kumar
		

		//end code for get project id
		
		//Codition check wheather the ub_daily_log_id value is greater than 0 or not
		if($ub_template_id > 0 || null!==$this->input->post('ub_template_id') && ($this->input->post('ub_template_id')) > 0)
		{
			$this->ub_template_id = $ub_template_id ;
			
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  $result = $this->sanitize_input();
			  if(TRUE === $result['status'])
			  {
			  	
			  	if(isset($result['data']['projected_start_date']) && $result['data']['projected_start_date']!='')
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
				$template_update_array = array(
				    'ub_template_id' => $result['data']['ub_template_id'],
					'template_name' => $result['data']['template_name'],
					'projected_start_date' => $result['data']['projected_start_date'],
					'project_group' => $result['data']['project_group'],
					'work_days' => isset($result['data']['work_days']) ? ",".implode(',', $result['data']['work_days'])."," : "No",
			        'off_days' => $off_days,
					'created_by' => $this->user_session['ub_user_id'],
					'modified_by' => $this->user_session['ub_user_id'],
					'modified_on' => TODAY,
					'created_on' => TODAY,
					'builder_id' => $this->user_session['builder_id']);
			  	//echo "update";exit;
			  	
				
				$response = $this->Mod_template->update_template($template_update_array);
				$this->Mod_template->response($response);
			  }
			 }
			else
			{
			//Get all comments list from ub_daily_log_comments table with the builder_id
			
			
			// Get inserted data with help of id
			 $result_data = $this->Mod_template->get_template(array(
			'select_fields' => array('TEMPLATE.ub_template_id', 'TEMPLATE.template_name','TEMPLATE.project_group','TEMPLATE.projected_start_date','TEMPLATE.work_days'),
			//'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
			'where_clause' => (array('ub_template_id' =>  $ub_template_id))
			));
			if(TRUE === $result_data['status'])
			{
				if($result_data['aaData'][0]['projected_start_date'] == '0000-00-00')
				{
					unset($result_data['aaData'][0]['projected_start_date']);
				}
				$data['template_data']  = $result_data['aaData'][0];
			}
			 
		   }
		 
	    }
	    // Here ub_daily_log_id value is 0. So It will enter to Insert function
		else
		{
		  if(!empty($this->input->post()))
		  {
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				//print_r($result);exit;
				if(isset($result['data']['projected_start_date']) && $result['data']['projected_start_date']!='')
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
				$template_insert_array = array(
					'template_name' => $result['data']['template_name'],
					'projected_start_date' => $result['data']['projected_start_date'],
					'project_group' => $result['data']['project_group'],
					'work_days' => isset($result['data']['work_days']) ? ",".implode(',', $result['data']['work_days'])."," : "No",
			        'off_days' => $off_days,
					'created_by' => $this->user_session['ub_user_id'],
					'modified_by' => $this->user_session['ub_user_id'],
					'modified_on' => TODAY,
					'created_on' => TODAY,
					'builder_id' => $this->user_session['builder_id']);

					if($result['data']['projected_start_date'] == '')
					{
						unset($template_insert_array['projected_start_date']);
					}
					//print_r($template_insert_array);exit;
				  // insert the record
				  $response = $this->Mod_template->add_templates($template_insert_array);
				  $this->Mod_template->response($response);
			}
			else
			{
				$this->Mod_template->response($result);
			}
		  }
	    }
	    // Project group drop down values
		$get_project_group = array('classification'=>'project_group', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$project_group_result = $this->Mod_general_value->get_general_value($get_project_group);
		$data['project_group_array'] = $project_group_result['values'];
	    
		$this->template->view($data);
		
      }
      /** 
	* Delete template
	* 
	* @method: delete_template 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: bgxf19ncy9kZWxldgxf1Vfbgxf19nLw--
	*/
	public function delete_template()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_template->delete_template($result['data']);

				$respoce_array = $this->get_template($page_count = 'result_array');
				//echo '<pre>';print_r($respoce_array);exit;
				if($respoce_array['status'] == FALSE)
				{
					//$this->module = 'TEMPLATE';
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
				$this->Mod_log->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_template->response($response);
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

}