<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Lead Class
 * 
 * @package: Lead
 * @subpackage: Lead
 * @category: Lead
 * @author: Devansh
 * @createdon(DD-MM-YYYY): 25-04-2015 
*/

class Leads extends UNI_Controller {

	/**
	 * @property: $module
	 * @access: public
	 */
	public $module = '';
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_lead','Mod_message','Mod_doc','Mod_general_value','Mod_notification','Mod_timezone','Mod_user','Mod_saved_search','Mod_reminder','Mod_builder','Mod_grid_settings','Mod_custom_settings'));
		$this->load->helper('export');
		$this->grid_setting_classification = 'lead_grid_setting_fields';
    }
    /** 
	* Get all leads
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
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
		}
		else
		{
			$apply_filter = false;
		}
		$data = array(
		'title'        => 'Leads',		
		'content'      => 'content/leads/leads',
        'page_id'      => 'Leads',
		'data_table'   =>'data_table',
		'listview'	   =>'list_view',
		'activityview' =>'activity_view',     
		'date_all'	   =>'date_all',
		'apply_filter'=>$apply_filter,
		'Activity_Calendar' =>'Activity_Calendar',
		'fullcalendar' =>'full_calendar',
	    'current_url' => $this->uri->segment(1),
	    'new_lead_url' => $this->crypt->encrypt('leads/save_lead/'),
		'delete_leads_url' => $this->crypt->encrypt('leads/delete_leads/'),
		'get_leads_url' => $this->crypt->encrypt('leads/get_leads/'),
		'search_session_array' => $this->uni_session_get('SEARCH')
		);
		// Code to fetch the grid settings pop up information 
		$data['grid_settings_popup']=$this->uni_get_grid_settings_popup_info();	
		$data['datatable_headers']=(isset($data['grid_settings_popup']['datatable_headers'])?$data['grid_settings_popup']['datatable_headers']:array());
		unset($data['grid_settings_popup']['datatable_headers']);  
		
		//echo "<br>decrypt---> ".$abc = $this->crypt->encrypt('leads/decrypt_email/');
		//echo "<br>decrypt---> ".$abc = $this->crypt->encrypt('docs/get_sub_folder_details/');
 		//echo "<br>encrypt---> ". $this->crypt->decrypt('bgxf1VhZHMvc2F2ZV9sZWFkLzQwMQ--'); 

		$args = array('classification'=>'lead_source', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$lead_source_array = $this->Mod_general_value->get_general_value($args);
		$data['lead_source']=$lead_source_array['values'];
	
		//get tags custom fields from general value table
		$args =array('classification'=>'lead_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown'); 
		$lead_tags_array = $this->Mod_general_value->get_general_value($args);
		$data['lead_tags'] = $lead_tags_array['values'];
		
		//get status custom fields from general value table
		$args = array('classification'=>'lead_status', 'type'=>'dropdown');
		$lead_status_array = $this->Mod_general_value->get_general_value($args);
		$data['lead_status']=$lead_status_array['values'];
		
		//get project_type custom fields from general value table
		$args = array('classification'=>'lead_project_type', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$lead_project_type_array = $this->Mod_general_value->get_general_value($args);
		$data['lead_project_type']= $lead_project_type_array['values'];
		
		//get age custom fields from general value table
		$args = array('classification'=>'lead_age', 'type'=>'dropdown');
		$lead_age_array = $this->Mod_general_value->get_general_value($args);
		$data['lead_age']= $lead_age_array['values'];
		
		//sales_person custom fields from user table
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.account_type =' => 100);
		$lead_sales_person_array = $this->Mod_user->get_users(array(
												'select_fields' => array('CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name','USER.ub_user_id'),
												'where_clause' => $post_array,
												));
        $data['sales_person']=array();
        if(TRUE === $lead_sales_person_array['status'])
		{
			$data['sales_person'] = $this->Mod_lead->build_ci_dropdown_array($lead_sales_person_array['aaData'],'ub_user_id', 'first_name');
		}		
		
		//echo "<pre>"; print_r($data); exit();
		/* echo "<br>decrypt---> ".$abc = $this->crypt->encrypt('leads/save_lead/'); 
		echo "<br>encrypt---> ". $this->crypt->decrypt($abc);exit;  */
		$this->template->view($data);
	}

	/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: Devansh
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_lead->destroy_session($result['data']);
			}
			$this->Mod_lead->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	
	/** 
	* Get leads
	* 
	* @method: get_leads
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/	
	public function get_leads()
	{	
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);exit;
			if(TRUE === $result['status'])
			{	
				$post_array[] = array(
								'field_name' => 'LEAD.builder_id',
								'value'=> $this->user_session['builder_id'], 
								'type' => '='
							);
		
				$total_count_array =  array();
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				// Search Input Array
				if(isset($result['data']['status']) && $result['data']['status']!='')
				{
					$post_array[] = array(
								'field_name' => 'LEAD.status',
								'value'=> $result['data']['status'], 
								'type' => '='
							);
			
					// Set value in session
					$search_session_array['status'] = $result['data']['status'];
				}
				if(isset($result['data']['name']) && $result['data']['name']!='')
				{
					$post_array[] = array(
								'field_name' => 'LEAD.name',
								'value'=> $result['data']['name'], 
								'type' => 'like'
							);
			
					// Set value in session
					$search_session_array['status'] = $result['data']['name'];
				}
				if(isset($result['data']['sales_person']) && $result['data']['sales_person']!='' && $result['data']['sales_person']!='null')
				{	
					
					$post_array[] = array(
								'field_name' => 'LEAD.sales_person',
								'value'=> $result['data']['sales_person'], 
								'type' => '='
							);
					// Set value in session
					$search_session_array['sales_person'] = $result['data']['sales_person'];
				}

				if(isset($result['data']['source']) && $result['data']['source']!='' && $result['data']['source']!='null')
				{
					$post_array[] = array(
								'field_name' => 'LEAD.source',
								'value'=> $result['data']['source'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					// Set value in session
					$search_session_array['source'] = $result['data']['source'];
				}

				if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags']!='null')
				{
					$post_array[] = array(
								'field_name' => 'LEAD.tags',
								'value'=> $result['data']['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					// Set value in session
					$search_session_array['tags'] = $result['data']['tags'];
				}

				if(isset($result['data']['project_type']) && $result['data']['project_type']!='' && $result['data']['project_type']!='null')
				{
					$post_array[] = array(
								'field_name' => 'LEAD.project_type',
								'value'=> $result['data']['project_type'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					// Set value in session
					$search_session_array['project_type'] = $result['data']['project_type'];
				}

				if(isset($result['data']['age']) && $result['data']['age']!='')
				{	
					//calculate age in leads
					$day= $result['data']['age'];
					$date = TODAY;
					$date2= -$day.'day';
					$newdate = strtotime (  $date2 , strtotime ( $date ) ) ;
					$newdate = date ( 'Y-m-d' , $newdate );

					$post_array[] =  array(
								'field_name' => 'DATE(LEAD.created_on)',
								'from'=> $newdate, 
								'type' => 'daterange'
							);
					// Set value in session
					$search_session_array['age'] = $result['data']['age'];
				}
				//code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('leads')][strtolower('view all')]) && $this->user_role_access[strtolower('leads')][strtolower('view all')] == 0)
				{
					if(isset($this->user_role_access[strtolower('leads')][strtolower('view created by me')]) && $this->user_role_access[strtolower('leads')][strtolower('view created by me')] == 1)
					{
						$post_array[] = array(
											'field_name' => 'LEAD.created_by',
											'value'=> $this->user_id, 
											'type' => '=',
											);
					}
				}
				/*
					Paggination length stored in seesion code start here
				*/

				$search_session_array['list_iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['list_iDisplayStart'];

			    $search_session_array['list_iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['list_iDisplayLength'];

				//$search_session_array['iDisplayStart'] = $result['data']['iDisplayStart'];
				//$search_session_array['iDisplayLength'] = $result['data']['iDisplayLength'];
				// Setting session 
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				$post_data = $this->Mod_lead->build_where($post_array);
				//echo $post_data;exit;
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					
						$total_count_array = $this->Mod_lead->get_leads(array(
												'select_fields' => array('COUNT(LEAD.ub_lead_id) AS total_count'),
												'join'=> array('builder'=>'yes'),
												'where_clause' => $post_data
												));
					
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					
					
					// Get formatted sort name
					$format_sort_name = $this->Mod_lead->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'LEAD.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}

					
				}
				else
				{
					$order_by_where = 'LEAD.modified_on DESC';
				}
			}
			else
			{
				$this->Mod_lead->response($result);
			}
		}
		
		// code to get the grid setting dropdown in task landing page
		$args = array('select_fields' => array('ub_grid_settings_id','is_default' ,'list_view_name', 'display_fields', 'display_field_joins' , 'builder_id', 'user_id'), 
		'where_clause' => array('ub_grid_settings_id'=>$result['data']['datatable_grid_id']),'get'=>'select_fields','primary_key'=>'LEAD.ub_lead_id');
		
		$user_grid_settings  = $this->Mod_grid_settings->get_grid_settings($args);
		if(TRUE === $user_grid_settings['status'])
		{
			if(in_array("LEAD.last_contacted_on",  $user_grid_settings['select_fields'])) 
			{
				$date_array = array('LEAD.last_contacted_on'=>'last_contacted_on');
				$formatted_date = $this->Mod_user->format_user_datetime($date_array,"date");
				array_push($user_grid_settings['select_fields'],$formatted_date );
			}
			$datatable_headers = $user_grid_settings['header_fields'];
			$field_names = $user_grid_settings['field_names'];
			$query_array = array('select_fields' => $user_grid_settings['select_fields'],	
			'join'=>$user_grid_settings['join_clause'],
			'where_clause' => $post_data,
			'order_clause' => $order_by_where,
			'pagination' => $pagination_array,
			);
		}
		else
		{
			$this->Mod_lead->response($user_grid_settings);
		}

		//print_r($user_grid_settings);exit;
		/*
		$query_array = array('select_fields' => array('LEAD.ub_lead_id', 'LEAD.name', 'LEAD.status', 'CONCAT_WS("",DATEDIFF(CURDATE(), LEAD.created_on),"-days" )AS created_on', 'CONCAT_WS("",LEAD.confidence_level,"%")AS confidence_level', 'LEAD.estimated_revenue_max','LEAD.last_contacted_on', 'CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name', 'LEAD.source', 'LEAD.project_type,'
								.$this->Mod_user->format_user_datetime($datetime_array)),
							'join'=> array('builder'=>'yes'),
							'where_clause' => $post_data ,
							'order_clause' => $order_by_where,
							'pagination' => $pagination_array
							);
		//echo "<pre>";print_r($query_array);
		*/
		// Check if the request is for file export
		//print_r($result);
		if($result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		}

		$result_data = $this->Mod_lead->get_leads($query_array);
	
		// File export request  
		if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			//$field_list_array = array('name','status','created_on','confidence_level','estimated_revenue_max','last_contacted_on','first_name','source','project_type');
			$field_list_array = (isset($field_names)?$field_names:array());
			// Export file header column 
			//$export_array['header'][0] = array('Name','Status','Created On','Confidence Level','Estimated Revenue','Last Contacted','Sales Person','Lead Source','Project Type'); 
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
			echo array_to_export($export_array,'uni_leadlist.xls','csv');exit;
		}
		// The following parameters required for data table
		
		if($result_data['status'] === FALSE)
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
		$this->Mod_lead->response($result_data);
	}
	
	
	/** 
	* save leads
	* 
	* @method: save_lead 
	* @access: public 
	* @param:  lead id
	* @return:  response array
	* url encoded : bgxf1VhZHMvc2F2ZV9sZWFkLw--
	*/
	public function save_lead($ub_lead_id = 0, $ub_lead_activity_id=0)
	{
		$result = $this->sanitize_input();
		$result_data = array();
		$data = array(
				    'title'        => "LEADS",		
				    'content'      => 'content/leads/save_lead',
				    'page_id'      => 'Leads',
					'drop_upload' => 'drop_upload',
					'date_all'	  => 'date_all',
					'boot_slider' => 'boot_slider'
				  	);

		//end code for get project id
		// Code to get the lead folder id
		$get_lead_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => $this->module))
                               );
		$lead_folder_id = $this->Mod_doc->get_folder_id($get_lead_folder_id);

		//code to get the activity folder id
		$get_activity_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'activity'))
                               );
		$activity_folder_id = $this->Mod_doc->get_folder_id($get_activity_folder_id);
		if (!empty($lead_folder_id['aaData']['0']['ub_doc_folder_id'])) 
		{
			$folder_id = array('lead_folder_id' => $lead_folder_id['aaData']['0']['ub_doc_folder_id'], 'activity_folder_id' => $activity_folder_id['aaData']['0']['ub_doc_folder_id']);
			$response_status= $this->uni_set_session('FOLDERID', $folder_id);
			$folder_is_array = $this->uni_session_get('FOLDERID');
			$data['lead_folder_id'] = $folder_is_array['lead_folder_id'];
			$data['activity_folder_id'] = $folder_is_array['activity_folder_id'];
			//echo "<pre>";print_r($folder_is_array);exit;
			/*code to create the temp dir and pass it to view*/
			$lead_dir_response = $this->Mod_doc->create_default_dir();
			if ($lead_dir_response['status'] == TRUE) 
			{
				$data['lead_temprory_dir_id'] = $lead_dir_response['temp_directory_id'];
			}
			else
			{
				$data['lead_temprory_dir_id'] = '1';
			}

			$activity_dir_response = $this->Mod_doc->create_default_dir();
			if ($activity_dir_response['status'] == TRUE) 
			{
				$data['activity_temprory_dir_id'] = $activity_dir_response['temp_directory_id'];
			}
			else
			{
				$data['activity_temprory_dir_id'] = '1';
			}
		}
		else
		{
			echo "Please Login with a new builder because builder directory structure is not available.";
			exit;
		}
		
		$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.module_name'=>'Lead', 'CUSTOM_FIELD.classification'=>LEAD_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE);
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

		//Edit code
		if($ub_lead_id > 0 || isset($result['data']['ub_lead_id']) && $result['data']['ub_lead_id'] > 0)
		{
			$this->ub_lead_id = (isset($results['data']['ub_lead_id'])) ? $results['data']['ub_lead_id'] : $ub_lead_id;

			$post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.module_name'=>'Lead', 'CUSTOM_FIELD.classification'=>LEAD_CUSTOM_FIELDS, 'status'=> FIELD_ACTIVE,'CUSTOM_FIELD_VALUES.table_id' => $this->ub_lead_id);
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

			
			$lead_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->ub_lead_id,
								);
			//echo "<pre>";print_r($lead_data);exit;
			$result_array = $this->Mod_doc->get_files_for_folder($lead_data);

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
											'new_image' => DOC_TEMP_PATH.$session_id.'/'.$lead_dir_response['thumbnail_path'].'/'.$exp[count($exp)-1]
									);
					$this->create_thumb($thumb_array);
					
					$ext = pathinfo($result_array[$i]['system_file_name'], PATHINFO_EXTENSION);
					if (!empty($ext)) 
					{
						copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$lead_dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);
					}
					
				}

			}
			
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  	$results = $this->sanitize_input();
			  	
				$result['data']['projected_sales_date'] = (isset($result['data']['projected_sales_date']) && $result['data']['projected_sales_date']!='')?date("Y-m-d", strtotime($result['data']['projected_sales_date'])):'';
				if (isset($result['data']['tags']) && !empty($result['data']['tags'])) 
				{
					$result['data']['tags'] = "".implode(",", $result['data']['tags'])."";
				}
				if (isset($result['data']['source']) && !empty($result['data']['source'])) 
				{
					$result['data']['source'] = "".implode(",", $result['data']['source'])."";
				}
				if (isset($result['data']['project_type']) && !empty($result['data']['project_type'])) 
				{
					$result['data']['project_type'] = "".implode(",", $result['data']['project_type'])."";
				}
				$result['data']['last_contacted_on'] = TODAY;
				$result['data']['builder_id'] = $this->user_session['builder_id'];
				$result['data']['modified_on'] = TODAY;
				$result['data']['modified_by'] = $this->user_session['ub_user_id'];
				unset($result['data']['lead_activity_length']);
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				//echo '<pre>';print_r($result);exit;
				$response = $this->Mod_lead->update_lead($result['data']);
				$this->Mod_lead->response($response);
			  }
			 
			else
			{
			// Get inserted data with help of id
			 $result_data = $this->Mod_lead->get_leads(array(
			'select_fields' => array(),
			'where_clause' => (array('ub_lead_id' =>  $ub_lead_id))
			));
			//echo '<pre>';print_r($result_data['aaData'][0]);exit;
			 $data['result_data']  = $result_data['aaData'][0];
			 if (!empty($ub_lead_activity_id)) {
			 	$data['result_data']['ub_lead_activity_id'] = $ub_lead_activity_id;
			 }
		   }
		 
	    }
		else
		{

			$post_data = array();
			if(!empty($this->input->post()))
			{	
				//Sanitize input
				$result = $this->sanitize_input();
				if(TRUE === $result['status'])
				{
					/*if(isset($result['data']['projected_sales_date']))
					{
						$result['data']['projected_sales_date'] = date("Y-m-d", strtotime($result['data']['projected_sales_date']));
					}*/
					$result['data']['projected_sales_date'] = (isset($result['data']['projected_sales_date']) && $result['data']['projected_sales_date']!='')?date("Y-m-d", strtotime($result['data']['projected_sales_date'])):'';
					if (isset($result['data']['tags']) && !empty($result['data']['tags'])) 
					{
						$result['data']['tags'] = "".implode(",", $result['data']['tags'])."";
					}
					if (isset($result['data']['source']) && !empty($result['data']['source'])) 
					{
						$result['data']['source'] = "".implode(",", $result['data']['source'])."";
					}
					if (isset($result['data']['project_type']) && !empty($result['data']['project_type'])) 
					{
						$result['data']['project_type'] = "".implode(",", $result['data']['project_type'])."";
					}
					$result['data']['last_contacted_on'] = TODAY;
					$result['data']['builder_id'] = $this->user_session['builder_id'];
					$result['data']['created_on'] = TODAY;
					$result['data']['created_by'] = $this->user_session['ub_user_id'];
					$result['data']['modified_on'] = TODAY;
					$result['data']['modified_by'] = $this->user_session['ub_user_id'];
					unset($result['data']['lead_activity_length']);
					if(isset($result['data']['save_type']))
					{
						unset($result['data']['save_type']);
					}
					// insert the record
					//echo '<pre>';print_r($result);exit;
					$response = $this->Mod_lead->add_lead($result['data']);
					$this->Mod_lead->response($response);
				}	
				else
				{
					$this->Mod_role->response($result);
				}
			}
		}
		//get source custom fields from general value table
			$args = array('classification'=>'lead_source', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
			$lead_source_array = $this->Mod_general_value->get_general_value($args);
			$data['lead_source']=$lead_source_array['values'];
		
			//get tags custom fields from general value table
			$args =array('classification'=>'lead_tags', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown'); 
			$lead_tags_array = $this->Mod_general_value->get_general_value($args);
			$data['lead_tags'] = $lead_tags_array['values'];
			
			//get status custom fields from general value table
			$args = array('classification'=>'lead_status', 'type'=>'dropdown');
			$lead_status_array = $this->Mod_general_value->get_general_value($args);
			$data['lead_status']=$lead_status_array['values'];
			
			//get project_type custom fields from general value table
			$args = array('classification'=>'lead_project_type', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
			$lead_project_type_array = $this->Mod_general_value->get_general_value($args);
			$data['lead_project_type']= $lead_project_type_array['values'];

			//get tags custom fields from general value table
			$args =array('classification'=>'lead_activity_type', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown'); 
			$lead_activity_type_array = $this->Mod_general_value->get_general_value($args);
			$nothing_selected_array = array(''=>'Nothing Selected');
			$data['lead_activity_type'] = $nothing_selected_array + $lead_activity_type_array['values'];

			//Fetch all reminder
			$args = array('classification'=>'reminder', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type' => 'dropdown');
			$result = $this->Mod_general_value->get_general_value($args);
			$data['activity_reminder'] = $result['values'];

			//sales_person custom fields from user table
			$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.account_type =' => 100);
			$lead_sales_person_array = $this->Mod_user->get_users(array(
													'select_fields' => array('CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name','USER.ub_user_id'),
													'where_clause' => $post_array,
													));

	        $data['sales_person']=array();
			$data['email_thread'] = array(array('ub_message_id'=>'100', 'from_email_id'=>'skopu#gmail.com', 'sent_on'=>'20/04/2015', 'to_other_emails'=>'abc@unibuilder.in', 'cc_other_emails'=>'abc@unibuilder.in', 'subject'=>'abc@unibuilder.in', 'message_body'=>'abcdef'));
	        
	        if(TRUE === $lead_sales_person_array['status'])
			{
				$data['sales_person'] = $this->Mod_lead->build_ci_dropdown_array($lead_sales_person_array['aaData'],'ub_user_id', 'first_name');
			}
			// code to get the initiated by dropdown
			$initiated_by = array(''=>'Nothing selected','Sales Person'=>'Sales Person','Lead'=>'Lead','Other'=>'Other');
        	$data['initiated_bys'] = $initiated_by; 
			
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

		$this->template->view($data);
    }

	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: Devansh
	* url encoded : dgxf1Fzay91cgxf1Rhdgxf1VfZ2VuZXJhbF92YWx1ZS8-
	*/
	public function update_general_value()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);
			if(TRUE === $result['status'])
			{
				$args = array('classification'=>$result['data']['classification'], 'type' => $result['data']['type'] ,'value' => $result['data']['value']);
				$result = $this->Mod_general_value->update_general_value($args);
			}
			$this->Mod_lead->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}

	/** 
	* delete leads
	* 
	* @method: delete_leads 
	* @access: public 
	* @param:  lead id
	* @return:  response array
	* url encoded : bgxf1VhZHMvZgxf1VsZXRlX2xlYWRzLw--
	*/
	
	public function delete_leads()
	{		
		
		$result = $this->sanitize_input();
		//echo '<pre>';print_r($result);exit;
			if(TRUE === $result['status'])
			{
				$lead_response = $this->Mod_lead->delete_leads($result['data']);
				$response = $this->Mod_lead->delete_activity($result['data']);
			}
			else
			{
				$this->Mod_lead->response($result);
			}
			$res = $this->Mod_lead->response($response);
			/*echo '<pre>';print_r($res);exit;*/

	}
	
	/** 
	* save filter 
	* 
	* @method: get_saved_search 
	* @access: public 
	* @param:  post_array
	* @return:  response array
	*
	*/
	public function get_saved_search($post_array)
	{		
		/* Save Filter code Starts here */
		if(!empty($this->input->post()))
		{
		$post_array_data = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array_data
												 ));
			if($result_data['status'] == true)
			{
				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
				$task_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
			}
			else
			{
				$lead_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($lead_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
			}
			$this->Mod_lead->response($response);
		}
		/* Save Filter code Ends here */
	}
	
	/*
	* @method: apply_saved_search 
	* @access: public 
	* @param: 
	* @return:  response array
	*/
	
	public function apply_saved_search()
	{
	  
		/* Apply Filter code starts here */
		   $post_array = array('builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
			
		 $serialized_data = $result_data['aaData'][0]['search_params'];
		 $remove_single_quote = str_replace("'", '', $serialized_data);
		 $unserialized_data = unserialize($remove_single_quote);  //unserialize the serialized data
		 $result_data['aaData'][0]['search_params'] = $unserialized_data;
		
		 if(!empty($unserialized_data))
		 {
			if(!empty($unserialized_data['status']))
			{
				// Set value in session
				$search_session_array['status'] = $unserialized_data['status'];
			}
			if(!empty($unserialized_data['sales_person']))
			{
				// Set value in session
				$search_session_array['sales_person']=$unserialized_data['sales_person'];				
			}
			if(!empty($unserialized_data['tags']))
			{				
				// Set value in session
				$search_session_array['tags']=$unserialized_data['tags'];					
			}
			if(!empty($unserialized_data['source']))
			{				
				// Set value in session
				$search_session_array['source']	=$unserialized_data['source'];			
			}
			if(!empty($unserialized_data['project_type']))
			{
				// Set value in session
				$search_session_array['project_type'] =$unserialized_data['project_type'];
			}
			if(!empty($unserialized_data['age']))
			{	
				// Set value in session
				$search_session_array['age']=$unserialized_data['age'];	
			}
			if(!empty($unserialized_data['name']))
			{	
				// Set value in session
				$search_session_array['name']=$unserialized_data['name'];	
			}
			// Setting session 
			$this->uni_set_session('search', $search_session_array);
			// Response data
			$this->Mod_lead->response($result_data);
		}
	}

	/** 
	* Get Activity
	* 
	* @method: get_activity
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/	
	public function get_activity()
	{	
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//print_r($result['data']);EXIT;
			if(TRUE === $result['status'])
			{	
				$post_array[] = array(
								'field_name' => 'LEAD_ACTIVITY.builder_id',
								'value'=> $this->user_session['builder_id'], 
								'type' => '='
								);
				if (isset($result['data']['ub_lead_id']) && !empty($result['data']['ub_lead_id'])) {
					$post_array[] = array(
								'field_name' => 'LEAD_ACTIVITY.lead_id',
								'value'=> $result['data']['ub_lead_id'], 
								'type' => '='
								);
				}
				if(isset($result['data']['name']) && $result['data']['name']!='')
				{
					$get_post_array[] = array(
								'field_name' => 'LEAD.builder_id',
								'value'=> $this->user_session['builder_id'], 
								'type' => '='
								);
					$get_post_array[] = array(
								'field_name' => 'LEAD.name',
								'value'=> $result['data']['name'], 
								'type' => 'like'
							);
					$get_post_data = $this->Mod_lead->build_where($get_post_array);
					$sort_type = 'ASC';
					$order_by_where = 'LEAD.ub_lead_id'.' '.$sort_type;
					$query_array = array('select_fields' => array('LEAD.ub_lead_id'),
								'join'=> array('builder'=>'yes'),
								'where_clause' => $get_post_data ,
								'order_clause' => $order_by_where
								);
					$result_data = $this->Mod_lead->get_leads($query_array);

					$result_data = "".implode(',', array_column($result_data['aaData'], 'ub_lead_id'))."";

					$post_array[] = array(
								'field_name' => 'LEAD_ACTIVITY.lead_id',
								'value'=> $result_data, 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);

					//echo $result_data1;exit;
					
				}
				if (isset($result['data']['ub_lead_activity_id']) && !empty($result['data']['ub_lead_activity_id'])) {
					$post_array[] = array(
								'field_name' => 'LEAD_ACTIVITY.ub_lead_activity_id',
								'value'=> $result['data']['ub_lead_activity_id']['ub_lead_activity_id'], 
								'type' => '='
								);
				}
				
				$total_count_array =  array();
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				// Search Input Array
				/*if(isset($result['data']['status']) && $result['data']['status']!='')
				{
					$post_array[] = array(
									'field_name' => 'LEAD_ACTIVITY.status',
									'value'=> $result['data']['status'], 
									'type' => '='
									);
			
					// Set value in session
					$search_session_array['status'] = $result['data']['status'];
				}*/

				if(isset($result['data']['sales_person']) && $result['data']['sales_person']!='' && $result['data']['sales_person']!='null')
				{	
					
					$post_array[] = array(
									'field_name' => 'LEAD_ACTIVITY.sales_person',
									'value'=> $result['data']['sales_person'], 
									'type' => '='
									);
					// Set value in session
					$search_session_array['sales_person'] = $result['data']['sales_person'];
				}
				/*
					Paggination length stored in seesion code start here
				*/

				$search_session_array['activity_iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['activity_iDisplayStart'];

			    $search_session_array['activity_iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['activity_iDisplayLength'];

				/* $search_session_array['iDisplayStart'] = $result['data']['iDisplayStart'];
				$search_session_array['iDisplayLength'] = $result['data']['iDisplayLength']; */
				// Setting session 
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				$post_data = $this->Mod_lead->build_where($post_array);
				//echo $post_data;exit;
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					
						$total_count_array = $this->Mod_lead->get_activity(array(
												'select_fields' => array('COUNT(LEAD_ACTIVITY.ub_lead_activity_id) AS total_count'),
												'join'=> array('builder'=>'yes'),
												'where_clause' => $post_data
												));
					
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					// Get formatted sort name
					$format_sort_name = $this->Mod_lead->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'LEAD_ACTIVITY.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}

				}
				
			}
			else
			{
				$this->Mod_lead->response($result);
			}
		}
		$datetime_array = array('LEAD_ACTIVITY.modified_on'=>'modified_on');
		$date_array = array('LEAD_ACTIVITY.activity_date' => 'activity_date','LEAD_ACTIVITY.followup_date'=>'followup_date');
		$query_array = array('select_fields' => array('LEAD_ACTIVITY.sales_person', 'LEAD_ACTIVITY.ub_lead_activity_id','LEAD_ACTIVITY.lead_id','LEAD_ACTIVITY.description','LEAD_ACTIVITY.activity_time','LEAD_ACTIVITY.reminder_id','LEAD_ACTIVITY.activity_date as activitydate_happend','LEAD_ACTIVITY.initiated_by','LEAD_ACTIVITY.followup_date','LEAD_ACTIVITY.followup_time','LEAD_ACTIVITY.activity_type', 'CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name', 'LEAD_ACTIVITY.mark_completed_status', 'LEAD.name,'.$this->Mod_user->format_user_datetime($date_array,"date"). ','.$this->Mod_user->format_user_datetime($datetime_array)),
							'join'=> array('builder'=>'yes', 'lead'=>'yes'),
							'where_clause' => $post_data ,
							'order_clause' => $order_by_where,
							'pagination' => $pagination_array
							);
		//echo "<pre>";print_r($query_array);
		
		// Check if the request is for file export
		//print_r($result);
		

		$result_data = $this->Mod_lead->get_activity($query_array);

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

		$this->Mod_lead->response($result_data);
	}
	/** 
	* Get Activity Calendar
	* 
	* @method: get_activity
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	public function get_activity_calendar()
	{	
		if( !empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//print_r($result['data']);EXIT;
			if($result['data']['name']!='')
			{	
				$post_data = array();
				if(isset($result['data']['name']) && $result['data']['name']!='')
				{
					$get_post_array[] = array(
								'field_name' => 'LEAD.builder_id',
								'value'=> $this->user_session['builder_id'], 
								'type' => '='
								);
					$get_post_array[] = array(
								'field_name' => 'LEAD.name',
								'value'=> $result['data']['name'], 
								'type' => 'like'
							);
					$get_post_data = $this->Mod_lead->build_where($get_post_array);
					$sort_type = 'ASC';
					$order_by_where = 'LEAD.ub_lead_id'.' '.$sort_type;
					$query_array = array('select_fields' => array('LEAD.ub_lead_id'),
								'join'=> array('builder'=>'yes'),
								'where_clause' => $get_post_data ,
								'order_clause' => $order_by_where
								);
					$result_data = $this->Mod_lead->get_leads($query_array);
					//echo $result_data;exit;
					$result_data = "".implode(',', array_column($result_data['aaData'], 'ub_lead_id'))."";

					$post_array[] = array(
								'field_name' => 'LEAD_ACTIVITY.lead_id',
								'value'=> $result_data, 
								'type' => '||',
								'classification' => 'primary_ids'
							);

					//echo $result_data1;exit;
					
				}
				$post_data = $this->Mod_lead->build_where($post_array);
				//echo $post_data; exit;
				$query_array = array('select_fields' => array('LEAD_ACTIVITY.ub_lead_activity_id AS id', 'LEAD_ACTIVITY.activity_type AS title', 'LEAD_ACTIVITY.activity_datetime AS start', 'LEAD_ACTIVITY.activity_date AS end', 'CONCAT_WS(" ",USER.first_name,USER.last_name ) AS salesperson', 'LEAD.name'),
				'join'=> array('builder'=>'yes'),
				'where_clause' => $post_data);
				$result_data = $this->Mod_lead->get_activity($query_array);
				$this->Mod_lead->response($result_data['aaData']);
			}
			else
			{ 
				$post_array =  array('LEAD_ACTIVITY.builder_id'=>$this->user_session['builder_id']);
				$query_array = array('select_fields' => array('LEAD_ACTIVITY.ub_lead_activity_id AS id', 'LEAD_ACTIVITY.activity_type AS title', 'LEAD_ACTIVITY.activity_datetime AS start', 'LEAD_ACTIVITY.activity_date AS end', 'CONCAT_WS(" ",USER.first_name,USER.last_name ) AS salesperson', 'LEAD.name'),
				'join'=> array('builder'=>'yes'),
				'where_clause' => $post_array
				);
				$result_data = $this->Mod_lead->get_activity($query_array);
				if ($result_data['status'] == FALSE) 
				{
					$result_data['aaData']['message'] = $result_data['status'];
					$result_data['aaData']['message'] = $result_data['message'];
				}
				else
				{
					$this->Mod_lead->response($result_data['aaData']);
				}
			}	
		}
	}
	/** 
	* Save Activity
	* 
	* @method: save_activity 
	* @access: public 
	* @param:  
	* @return:  response array
	*/
	public function save_activity($ub_lead_activity_id = 0)
	{
		$result = $this->sanitize_input();
		$result_data = array();
		$data = array(
				    'title'        => "LEADS",		
				    'content'      => 'content/leads/save_lead',
				    'page_id'      => 'Leads',
					'drop_upload' => 'drop_upload',
					'date_all'	  => 'date_all',
					'boot_slider' => 'boot_slider'
				  	);
		//Edit code
		//echo '<pre>';print_r($result);exit;
		if(isset($result['data']['ub_lead_activity_id']) && $result['data']['ub_lead_activity_id'] > 0)
		{
			
			 $post_data = array();
			if(!empty($this->input->post()))
			{	
				//Sanitize input
				//echo '<pre>';print_r($result);exit;
				if(TRUE === $result['status'])
				{
					if(isset($result['data']['activity_date']))
					{
						$result['data']['activity_date'] = date("Y-m-d", strtotime($result['data']['activity_date']));
					}
					if(isset($result['data']['time']))
					{
						$activity_time = $result['data']['time'];
						$result['data']['activity_time'] = date('H:i:s', strtotime($activity_time));
						$result['data']['activity_datetime'] = $result['data']['activity_date']. ' ' .$result['data']['activity_time'];
					}
					if (isset($result['data']['schedule_followup']) && !empty(isset($result['data']['schedule_followup'])))
					 {
					 	$result['data']['schedule_followup'] = date("Y-m-d", strtotime($result['data']['schedule_followup']));
					 }
					 if (isset($result['data']['followup_time']) && !empty(isset($result['data']['followup_time'])))
					 {
					 	$followup_time = $result['data']['followup_time'];
						$result['data']['followup_time'] = date('H:i:s', strtotime($followup_time));
					 }

					$followup_time = $result['data']['followup_time'];
					$result['data']['followup_time'] = date('H:i:s', strtotime($followup_time));
					$followup_datetime = $result['data']['schedule_followup']. ' ' .$result['data']['followup_time'];

					if (isset($result['data']['schedule_followup']) && $followup_datetime > TODAY && !empty($result['data']['reminder_id'])) 
					{
					 	$time_from = '-'.$result['data']['reminder_id'].' minutes';
						$result['data']['reminder_datetime'] = date("Y-m-d H:i:s",strtotime($time_from ,strtotime($followup_datetime)));
					 } else {
					 	$result['data']['reminder_datetime'] = '0000-00-00 00:00:00';
					 }
					 
					 if(isset($result['data']['save_type']))
					 {
						unset($result['data']['save_type']);
					 }
					unset($result['data']['time']);
					$result['data']['builder_id'] = $this->user_session['builder_id'];
					$result['data']['modified_on'] = TODAY;
					$result['data']['modified_by'] = $this->user_session['ub_user_id'];
					// insert the record
					if(isset($result['data']['sales_person']) && !empty($result['data']['sales_person']))
					{
						$result['data']['template_name']  = 'lead_assigned_to_activity_by_another_bu';
						$send_notification = $this->Mod_lead->send_mail_for_notification($result['data'],$result['data']['lead_id']);
					}
					$response = $this->Mod_lead->update_activity($result['data']);

					if(TRUE === $response['status'])
					{
						$lead_sales_person = $this->Mod_lead->get_leads(array(
						'select_fields' => array('LEAD.name','LEAD.sales_person'),
						'where_clause' => (array('ub_lead_id' =>  $result['data']['lead_id']))
						));

						$get_all_users = array(
	                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
	                                    'where_clause' => (array('ub_user_id' =>  $lead_sales_person['aaData']['0']['sales_person']))
	                                    );
	         				$all_users = $this->Mod_user->get_users($get_all_users);
	         				$generate_url = $this->crypt->encrypt('leads/save_lead/'.$result['data']['lead_id'].'/'.$response['insert_id']);

	         				$condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
							$builder_details_array = $this->Mod_builder->get_builder_details(array(
																	'select_fields' => array('builder_name'),
																	'where_clause' => $condition_post_array
																	));
							$builder_name = $builder_details_array['aaData']['0']['builder_name'];
							
						$parse_data = array(
										'sales_person_name' => $all_users['aaData']['0']['first_name'],
										'activity_datetime' => $result['data']['activity_datetime'],
										'activity_type' => $result['data']['activity_type'],
										'builder_name' => $builder_name,
										'activity_url' => BASEURL.$generate_url
									);
						$reminder_table_insert_array = array(
							'builder_id' => $this->user_session['builder_id'],
							'module_name' => $this->module,
							'module_pk_id' => $result['data']['lead_id'],
							'reminder_sent_to' => $result['data']['sales_person'],
							'reminder_sent_on' => $followup_datetime,
							'reminder_end_time' => $followup_datetime,
							'reminder_duration' => $result['data']['reminder_id'],
							'template_name' => 'lead_activity_reminder',
							'status' => 'Not Send',
							'parse_data' => $parse_data
							);
						$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
					}
					$this->Mod_lead->response($response);
				}	
				else
				{
					$this->Mod_lead->response($result);
				}
			}
			 
			else
			{
			// Get inserted data with help of id
			 $result_data = $this->Mod_lead->get_leads(array(
			'select_fields' => array(),
			'where_clause' => (array('ub_lead_id' =>  $ub_lead_id))
			));
			//echo '<pre>';print_r($result_data['aaData'][0]);exit;
			 $data['result_data']  = $result_data['aaData'][0];
			 if (!empty($ub_lead_activity_id)) {
			 	$data['result_data']['ub_lead_activity_id'] = $ub_lead_activity_id;
			 }
		   }
		 
	    }
		else
		{
			//echo '<pre>';print_r($result);exit;
			$post_data = array();
			if(!empty($this->input->post()))
			{	
				//Sanitize input
				$result = $this->sanitize_input();
				if(TRUE === $result['status'])
				{
					if(isset($result['data']['activity_date']) && !empty($result['data']['activity_date']))
					{
						$result['data']['activity_date'] = date("Y-m-d", strtotime($result['data']['activity_date']));
					}
					else
					{
						$result['data']['activity_date'] = TODAY;
					}
					if(isset($result['data']['time']) && !empty($result['data']['time']))
					{
						$activity_time = $result['data']['time'];
						$result['data']['activity_time'] = date('H:i:s', strtotime($activity_time));
					}
					else
					{
						$result['data']['activity_time'] = '';
					}
					if(isset($result['data']['activity_date']) && !empty($result['data']['activity_date']))
					{
						if(isset($result['data']['activity_time']) && !empty($result['data']['activity_time']))
						{
							$result['data']['activity_datetime'] = date("Y-m-d", strtotime($result['data']['activity_date'])). ' ' .$result['data']['activity_time'];
						}
						else
						{
							$result['data']['activity_datetime'] = $result['data']['activity_date']. ' 00:00:00';
						}
					}
					if (isset($result['data']['activity_datetime']) && $result['data']['activity_datetime'] > TODAY && !empty($result['data']['reminder_id'])) 
					{
					 	$time_from = '-'.$result['data']['reminder_id'].' minutes';
						$result['data']['reminder_datetime'] = date("Y-m-d H:i:s",strtotime($time_from ,strtotime($result['data']['activity_datetime'])));
					 } else {
					 	$result['data']['reminder_datetime'] = '0000-00-00 00:00:00';
					 }
					 $result['data']['schedule_followup'] = (isset($result['data']['schedule_followup']) && $result['data']['schedule_followup']!='')?date("Y-m-d", strtotime($result['data']['schedule_followup'])):'';
					 if (isset($result['data']['followup_time']) && !empty($result['data']['followup_time']))
					 {
					 	$followup_time = $result['data']['followup_time'];
						$result['data']['followup_time'] = date('H:i:s', strtotime($followup_time));
					 }
					 if (isset($result['data']['activity_datetime']) && $result['data']['activity_datetime'] > TODAY && !empty($result['data']['reminder_id'])) 
					 {
					 	$followup_datetime = $result['data']['activity_datetime'];
					 } 
					 else {
					 	$followup_datetime = date($result['data']['schedule_followup']). ' ' .$result['data']['followup_time'];
					 }
					 
					 $followup_datetime = ($followup_datetime!='')?$followup_datetime:'';
					 if(isset($result['data']['save_type']))
					 {
						unset($result['data']['save_type']);
					 }
					unset($result['data']['time']);
					$result['data']['builder_id'] = $this->user_session['builder_id'];
					$result['data']['created_on'] = TODAY;
					$result['data']['created_by'] = $this->user_session['ub_user_id'];
					$result['data']['modified_on'] = TODAY;
					$result['data']['modified_by'] = $this->user_session['ub_user_id'];
					// insert the record

					//echo '<pre>';print_r($result);exit;
					$response = $this->Mod_lead->add_activity($result['data']);
					/*Block to send reminder*/
					//echo '<pre>';print_r($response);exit;
					if(TRUE === $response['status'])
					{
						$lead_sales_person = $this->Mod_lead->get_leads(array(
						'select_fields' => array('LEAD.name','LEAD.sales_person'),
						'where_clause' => (array('ub_lead_id' =>  $result['data']['lead_id']))
						));

						$get_all_users = array(
	                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
	                                    'where_clause' => (array('ub_user_id' =>  $lead_sales_person['aaData']['0']['sales_person']))
	                                    );
	         				$all_users = $this->Mod_user->get_users($get_all_users);
	         				$generate_url = $this->crypt->encrypt('leads/save_lead/'.$result['data']['lead_id'].'/'.$response['insert_id']);

	         				$condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
							$builder_details_array = $this->Mod_builder->get_builder_details(array(
																	'select_fields' => array('builder_name'),
																	'where_clause' => $condition_post_array
																	));
							$builder_name = $builder_details_array['aaData']['0']['builder_name'];

						$parse_data = array(
										'sales_person_name' => $all_users['aaData']['0']['first_name'],
										'activity_datetime' => $result['data']['activity_datetime'],
										'activity_type' => $result['data']['activity_type'],
										'builder_name' => $builder_name,
										'activity_url' => BASEURL.$generate_url
									);
						$reminder_table_insert_array = array(
							'builder_id' => $this->user_session['builder_id'],
							'module_name' => $this->module,
							'module_pk_id' => $result['data']['lead_id'],
							'reminder_sent_to' => $result['data']['sales_person'],
							'reminder_sent_on' => $followup_datetime,
							'reminder_end_time' => $followup_datetime,
							'reminder_duration' => $result['data']['reminder_id'],
							'template_name' => 'lead_activity_reminder',
							'status' => 'Not Send',
							'parse_data' => $parse_data
							);
						$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
					}
					/*Block to send lead_other_employee_contacted notification*/
					if(TRUE === $response['status'])
					{
						 $lead_sales_person = $this->Mod_lead->get_leads(array(
						'select_fields' => array('LEAD.name','LEAD.sales_person'),
						'where_clause' => (array('ub_lead_id' =>  $result['data']['lead_id']))
						));

						 //echo '<pre>';print_r($lead_sales_person);
						if ($lead_sales_person['aaData']['0']['sales_person'] != $result['data']['sales_person']) 
						{
							$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($lead_sales_person['aaData']['0']['sales_person'],$this->main_modules[$this->module]);
						 	$get_all_users = array(
	                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
	                                    'where_clause' => (array('ub_user_id' =>  $mail_user_id))
	                                    );
	         				$all_users = $this->Mod_user->get_users($get_all_users);
	         				if($all_users['status'] == TRUE)
		 					{
		         				$name = $all_users['aaData']['0']['fullname'];
		         				$email_id = $all_users['aaData']['0']['primary_email'];
		         				$formate_email = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'TO';
		         				$username_array = $this->user_session;
				 				$initiated_by = $username_array['first_name'];
				 				$generate_url = $this->crypt->encrypt('leads/save_lead/'.$result['data']['lead_id'].'/'.$response['insert_id']);

				 				$condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
								$builder_details_array = $this->Mod_builder->get_builder_details(array(
																		'select_fields' => array('builder_name'),
																		'where_clause' => $condition_post_array
																		));
								$builder_name = $builder_details_array['aaData']['0']['builder_name'];

		         				$content_array = array(
											'TO_EMAIL' => $email_id,
											'SEND_MAIL_INFO' => $formate_email,
											'IMAGESRC' => IMAGESRC.'gallery.png',
											'sales_person_name' => $all_users['aaData']['0']['first_name'],
											'lead_name' => $lead_sales_person['aaData']['0']['name'],
											'initiated_by' => $initiated_by,
											'activity_type' => $result['data']['activity_type'],
											'builder_name' => $builder_name,
											'activity_datetime' => $result['data']['activity_datetime'],
											'activity_url' => BASEURL.$generate_url,
											'base_url'=> BASEURL
										);
		         				$post_array_details = array(
											'builder_id' => $this->user_session['builder_id'],
											'module_name' => $this->module,
											'module_pk_id' => $result['data']['lead_id'],
											'from_user_id' => $this->user_session['ub_user_id'],
											'to_user_id' => $lead_sales_person['aaData']['0']['sales_person'],
											'type' => 'lead_other_employee_contacted',
											'subject' => 'content will update',
											'message' => 'content will update'
										);
								$notification_array = array(
											'template_name' => 'lead_other_employee_contacted',
											'content_array' => $content_array,
											'notification' => $post_array_details,
											'default' => 'No'
										);
								$notification_responce = $this->Mod_notification->send_mail($notification_array);
		         				//$this->Mod_notification->response($notification_responce);
		         				//return $notification_responce;
	         				}
						}
					}
					//echo '<pre>';print_r($response);exit;
					$this->Mod_lead->response($response);
				}	
				else
				{
					$this->Mod_lead->response($result);
				}
			}
		}
	}
	/** 
	* Save And Send Email
	* 
	* @method: save_activity 
	* @access: public 
	* @param:  
	* @return:  response array
	*/
	public function save_and_send_email()
	{
			$post_data = array();
			if(!empty($this->input->post()))
			{	
				//Sanitize input
				$result = $this->sanitize_input();
				if(TRUE === $result['status'])
				{
					
					//$this->Mod_Message->process_message($message);
					
					$result['data']['message_folder'] = SENT;
					$result['data']['module_name'] = "lead_activity";
					// insert the record
					$response = $this->Mod_message->process_message($result);
					// file add code start
					$uploadfile_array['data'] = array(
						'projectid'=> 0,
						'moduleid'=>$response['insert_id'],
						'modulename'=>'activity',
						'folderid'=>$result['data']['folder_id'],
						'temp_directory_id'=>$result['data']['temp_directory_id']);
						//echo '<pre>';print_r($uploadfile_array);exit;
						$fileinsert_status = $this->get_temp_filename($uploadfile_array);
					if (isset($response['content_array']) && !empty($response['content_array'])) 
					{
						$content_array = $response['content_array'];
					}

					//File attachment code start
					$activity_data = array(	  'flag' => 2, 
									  'builder_id'	=> $this->user_session['builder_id'],
									  'projectid' => 0,
									  'folderid' => 0,
									  'modulename' => 'activity',
									  'moduleid' => $response['insert_id'],
									);
					$attach_result_array = $this->Mod_doc->get_files_for_folder($activity_data);
					
					$attchment_array = array();
					for ($i=0; $i < count($attach_result_array); $i++) 
					{
						if(isset($attach_result_array[$i]['ub_doc_file_id']) && $attach_result_array[$i]['ub_doc_file_id'] > 0)
						{
							$attchment_array[] = array('file_path' => DOC_PATH.$attach_result_array[$i]['system_file_name'],
												'ui_file_name' => $attach_result_array[$i]['ui_file_name']);
						}
					}
					//File attachment code End
					if(!empty($attchment_array))
					{
						$content_array['ATTACHMENT_INFO'] = $attchment_array;
					}
					$this->Mod_mail->send_mail('SEND_LEAD_ACTIVITY_EMAIL', $content_array);
					$data['status'] =  TRUE;
					$data['message'] = 'Success message will come here';
					//echo '<pre>';print_r($content_array);exit;
					$this->Mod_message->response($data);
				}	
				else
				{
					$this->Mod_role->response($result);
				}
			}
		$result = $this->sanitize_input();
	}

	/** 
	* Get Activity Thread
	* 
	* @method: get_activity_thread
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: Devansh
	*/	
	public function get_activity_thread()
	{	
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);
			//echo $last_id = end(explode('-',$result['data']['message_id']));
			
			if(TRUE === $result['status'])
			{
				//$result['data']['module_pk_id'] = 2;
				$post_array[] = array(
								'field_name' => 'MESSAGE.builder_id',
								'value'=> $this->user_session['builder_id'], 
								'type' => '='
							);
				if(isset($result['data']['module_pk_id']) && $result['data']['module_pk_id']!='' && $result['data']['module_pk_id']!='null')
				{	
					$post_array[] = array(
								'field_name' => 'MESSAGE.module_pk_id',
								'value'=> $result['data']['module_pk_id'], 
								'type' => '='
							);
				}  
				if(isset($result['data']['message_id']) && $result['data']['message_id']!='' && $result['data']['message_id']!='null')
				{
					$string = explode("-",$result['data']['message_id']);
		    		$ub_message_id = array_pop($string);
					$post_array[] = array(
								'field_name' => 'MESSAGE.ub_message_id',
								'value'=> $ub_message_id, 
								'type' => '='
							);
				}
				
				$post_data = $this->Mod_message->build_where($post_array);

				$pagination_array = array();
				if (isset($result['data']['page_number']) && $result['data']['page_number']!='' && $result['data']['page_number']!='null') 
				{
					$page_number = $result['data']['page_number'];
					$result['data']['iDisplayLength'] = DEFAULT_PAGINATION_LENGTH;
					$result['data']['iDisplayStart'] = ($page_number*$result['data']['iDisplayLength']);
					$page_number = ($page_number+1);
				}
				$sort_type = 'DESC';
				$order_by_where = 'MESSAGE.ub_message_id'.' '.$sort_type;

				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength']);
					// Get number of records
						$total_count_array = $this->Mod_message->get_message(array(
												'select_fields' => array('COUNT(MESSAGE.ub_message_id) AS total_count'),
												'where_clause' => $post_data
												));
					
				}
				//echo "<pre>";print_r($total_count_array);exit;
				if (!empty($total_count_array)) {
					$total = ceil($total_count_array['aaData']['0']['total_count']/$result['data']['iDisplayLength']);
				}
				
				$query_array = array('select_fields' => array('MESSAGE.ub_message_id', 'MESSAGE.from_email_id', 'MESSAGE.sent_on', 'MESSAGE.to_other_emails', 'MESSAGE.cc_other_emails','MESSAGE.subject', 'MESSAGE.message_body'),
							'where_clause' => $post_data,
							'order_clause' => $order_by_where,
							'pagination' => $pagination_array
							);
				
				$result_data = $this->Mod_message->get_message($query_array);
				//echo "<pre>";print_r($result_data);exit;
				//echo $page_number;print_r($total_count_array);exit;
				if (TRUE === $result_data['status']) 
				{
					$activity_data = array(	  'flag' => 2, 
									  'builder_id'	=> $this->user_session['builder_id'],
									  'projectid' => 0,
									  'folderid' => 0,
									  'modulename' => 'activity',
									  'moduleid' => $result_data['aaData']['0']['ub_message_id'],
									);
					//echo "<pre>";print_r($lead_data);exit;
					$attach_result_array = $this->Mod_doc->get_files_for_folder($activity_data);
					$count = count($attach_result_array);
	      			$data = array();
					for ($i=0; $i < $count ; $i++) 
					{ 
						if (!empty($attach_result_array[$i]['system_file_name'])) 
						{
							$exp = explode('/', $attach_result_array[$i]['system_file_name']);
							$system_file_name = $exp[count($exp)-2].'/'.$exp[count($exp)-1];
							if (isset($attach_result_array[$i]['ui_file_name']) && !empty($attach_result_array[$i]['ui_file_name'])) 
							{
								$atachment_data[] = array('file_name' => $attach_result_array[$i]['ui_file_name'],
												'sys_file_name' => $system_file_name
											);
							}
						}
					}
					$get_activity_folder_id = array('select_fields' => array('ub_doc_folder_id'),
	                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'activity'))
	                               );
					$activity_folder_id = $this->Mod_doc->get_folder_id($get_activity_folder_id);
					$activity_folder_id = $activity_folder_id['aaData']['0']['ub_doc_folder_id'];
					if(isset($result['data']['module_pk_id']) && $result['data']['module_pk_id']!='' && $result['data']['module_pk_id']!='null')
					{
						if (TRUE === $result_data['status']) {
							if (!empty($atachment_data)) {
								$response = $this->load->view("content/leads/email_thread.php", array('email_thread'=>$result_data['aaData'], 'TotalRows'=>$total, 'page_no'=> $page_number, 'atachment_data' => $atachment_data, 'activity_folder_id' => $activity_folder_id), true);
							}
							else
							{
								$response = $this->load->view("content/leads/email_thread.php", array('email_thread'=>$result_data['aaData'], 'TotalRows'=>$total, 'page_no'=> $page_number), true);
							}
							
						echo $response; exit;
						}
					}
					else
					{
						$email_id = array();
						if($result_data['aaData']['0']['cc_other_emails']!='' && $result_data['aaData']['0']['cc_other_emails']!='null')
						{
						  	$level1_array = explode(EMAIL_SEPERATOR_LEVEL1, $result_data['aaData']['0']['cc_other_emails']);
						  	foreach($level1_array as $key => $level2_string)
							{
								$email_address_array = explode(EMAIL_SEPERATOR_LEVEL2, $level2_string);
								$email_id[] = $email_address_array['1'];
							}
							$cc_email = implode(", ", $email_id);
							$result_data['aaData']['0']['cc_other_emails'] = $cc_email;
						}
						//print_r($result_data);exit;
						$this->Mod_message->response($result_data);
					}
				}	
				else
				{
					if (isset($result['data']['triger']) && !empty($result['data']['triger'] && $result['data']['triger'] == 'cencel'))
					{
						$response = $this->load->view("content/leads/email_thread.php", array('no_email_thread'=>'No email found for this activity.'), true);
					}
				}
			}
		}	
	}

	/** 
	* Save Custom Field
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/

	public function save_custom_field()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			if(TRUE === $result['status'])
			{
				$result['data']['classification'] = LEAD_CUSTOM_FIELDS;
				$result['data']['status'] = FIELD_ACTIVE;
				$result['data']['module_name'] = 'leads';
				$data = $this->Mod_custom_settings->format_custom_filed_and_insert($result['data']);
				$this->Mod_custom_settings->response($data);
			}
		}
	}

	/** 
	* Decrypt email
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @URL: bgxf1VhZHMvZgxf1VjcnlwdF9lbWFpbC8-
	*/
	/*public function decrypt_email()
	{
		$result_data = $this->Mod_Message->decrypt_email();
		print_r($result_data);exit;
	}*/
}

/* End of file leads.php */
/* Location: ./application/controllers/leads.php */