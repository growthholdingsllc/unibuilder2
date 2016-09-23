<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Bids extends UNI_Controller {		public function __construct()  {    parent::__construct();		$this->load->model(array('Mod_bid','Mod_general_value','Mod_timezone','Mod_user','Mod_saved_search','Mod_cost_code','Mod_project','Mod_comment','Mod_reminder','Mod_message','Mod_notification','Mod_subcontractor','Mod_doc','Mod_builder','Mod_template','Mod_checklist'));		$this->load->helper('url');	  }	public function index()	{        $this->module = 'TEMP_BIDS';		$data = array(		'title'        => "BIDS",				'content'      => 'template/content/bids/bids',        'page_id'      => 'bids',		'bids_list'	   => 'bids_list',		'data_table'   => 'data_table',		'search_session_array' => $this->uni_session_get('SEARCH'),		'date_all'	   => 'date_all'		);  // echo "<br>decrypt---> ".$abc = $this->crypt->encrypt('bids/get_bid_subcontractor/'); 				//Get category from general value table		$packagestatus_args = array('classification'=>'bid_package_status', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');		$packagestatus_result = $this->Mod_general_value->get_general_value($packagestatus_args);		$data['packagestatus_array'] = $packagestatus_result['values'];		//Get Locations from general value table		$bidstatus_args = array('classification'=>'bid_status', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');		$bidstatus_result = $this->Mod_general_value->get_general_value($bidstatus_args);		$data['bidstatus_array'] = $bidstatus_result['values'];		 //Apply filter code		$post_array = array( 'builder_id' => $this->user_session['builder_id'],							 'user_id' => $this->user_session['ub_user_id'],							 'module_name' => $this->module		 );		 $result_data = $this->Mod_saved_search->get_saved_search(array(												 'select_fields' => array(),												 'where_clause' => $post_array												 ));				if($result_data['status'] == true)		{			$apply_filter = true;		}		else		{			$apply_filter = false;;		}				$data['apply_filter'] = $apply_filter;				//template drop down	    $template_list = $this->Mod_template->get_template(array(					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),					'where_clause' => (array('TEMPLATE.builder_id' => $this->user_session['builder_id']))					));	    if( $template_list['status'] == TRUE){						//$data['template_list']= $template_list['aaData'];			$data['template_list'] = $this->Mod_project->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name');	   	}		//echo '<pre>';print_r($data['template_list']);exit;		$this->template->view($data);	}		/*	* save Bid	* @method: save_bid 	* @access: public 	* @param:  	* @return:  response array	* url encoded : Ymlkcy9zYXZlX2JpZC8-	*/	public function save_bid($ub_template_bid_id = 0)	{		//$this->module = 'TEMP_BIDS';		$data = array(			'title'	=> "BIDS",					'content' => 'template/content/bids/save_bid',			'page_id' => 'bids',			'date_all' => 'date_all',			'data_table' => 'data_table',			'cost_code_selected'=> '',			'checklist_selected'=> '',			'schedule_selected'	=> '',			'sub_contractor_selected'	=> '',		);		$result_data = array();		$post_data = array();		//get project id from task table // by satheesh kumar		if(empty($this->project_id) && $ub_template_bid_id > 0)		{		$where_args = array('ub_template_bid_id' => $ub_template_bid_id);		$project_id = $this->Mod_project->get_project_id(UB_TEMPLATE_BID,$where_args);		$this->project_id = $project_id['aaData'][0]['project_id'];		}		//end code for get project id				$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))                               );		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);		if (isset($all_folder['aaData']) && !empty($all_folder)) 		{				$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];		}		$dir_response = $this->Mod_doc->create_default_dir();				if ($dir_response['status'] == TRUE) 		{			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];		}		else		{		  $data['temprory_dir_id'] = '1';			}		//Codition check wheather the ub_daily_log_id value is greater than 0 or not		if($ub_template_bid_id > 0 || null!==$this->input->post('ub_template_bid_id') && $this->input->post('ub_template_bid_id') > 0)		{			$this->ub_template_bid_id = (null!=$this->input->post('ub_template_bid_id')) ? $this->input->post('ub_template_bid_id') : $ub_template_bid_id;			$task_data = array(	  'flag' => 1, 								  'builder_id'	=> $this->user_session['builder_id'],								  'projectid' => $this->project_id,								  'folderid' => 0,								  'modulename' => $this->module,								  'moduleid' => $this->ub_template_bid_id,								);			$result_array = $this->Mod_doc->get_files_for_folder($task_data);			//echo "<pre>";print_r($result_array);exit;			$count = count($result_array);			$session_id = $this->session->userdata('session_id');						for ($i=0; $i < $count ; $i++)			{				if(isset($result_array[$i]['system_file_name']) && !empty($result_array[$i]['system_file_name']))				{					$exp = explode('/', DOC_PATH.$result_array[$i]['system_file_name']);					$thumb_array = array(											'source_image' => DOC_PATH.$result_array[$i]['system_file_name'],											'new_image' => DOC_TEMP_PATH.$session_id.'/'.$dir_response['thumbnail_path'].'/'.$exp[count($exp)-1]									);					$this->create_thumb($thumb_array);										//$image_path = $result_array[$i]['system_file_name'];					copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);				}			}						 if(!empty($this->input->post()))		     {		 	  //Sanitize input			  $result = $this->sanitize_input();			  if(TRUE === $result['status'])			  {			  	if(isset($result['data']['due_time']) && $result['data']['due_time'] != '')			    {				 $result['data']['due_time'] = date('H:i:s', strtotime($result['data']['due_time']));			    }			    if(isset($result['data']['due_date']) && $result['data']['due_date'] !='')			    {				 $result['data']['due_date'] = date("Y-m-d", strtotime($result['data']['due_date']));			    }			    			    if(isset($result['data']['schedule_id']) && $result['data']['schedule_id'] !== null && $result['data']['schedule_id']!='Nothing selected')			    {				   $result['data']['schedule_id'] = $result['data']['schedule_id'];			    }			    else			    {			    	$result['data']['schedule_id'] = '';			    }			    if(isset($result['data']['checklist_id']) && $result['data']['checklist_id'] !== null && $result['data']['checklist_id']!='Nothing selected')			    {			   					$result['data']['checklist_id'] = "".implode(",", $result['data']['checklist_id'])."";				}				else				{					$result['data']['checklist_id'] = '';				}								$bid_update_array = array(				'ub_template_bid_id' => $result['data']['ub_template_bid_id'],				'template_id' => $result['data']['template_id'],			  	'builder_id' => $this->user_session['builder_id'],			  	'released_date' => TODAY,			  	'package_title' => $result['data']['package_title'],			  	'number_days' => $result['data']['number_days'],			  	'before_or_after' => $result['data']['before_or_after'],			  	'schedule_id' => $result['data']['schedule_id'],			  	'due_date_time' => $result['data']['due_date'] . ' ' . $result['data']['due_time'],			  	'due_date' => $result['data']['due_date'],			  	'due_time' => $result['data']['due_time'],			  	'daily_sub_reminder' => $result['data']['daily_sub_reminder'],			  	'pricing_format' => $result['data']['pricing_format'],			  	'checklist_id' => $result['data']['checklist_id'],			  	'has_checklist' => isset($result['data']['has_checklist']) ? "Yes" : "No",			  	'allow_multi_bids' => isset($result['data']['allow_multi_bids']) ? "Yes" : "No",			  	'description' => $result['data']['description'],			  	'status' => $result['data']['status'],	            'created_by' => $this->user_session['ub_user_id'],	            'created_on' => TODAY,	            'modified_by' => $this->user_session['ub_user_id'], 	            'modified_on' => TODAY,);				 if($result['data']['due_date'] == '' && $result['data']['due_time'] == '')			     {				   unset($bid_update_array['due_date_time']);			     }                 if($result['data']['due_date'] == '')			     {				  unset($bid_update_array['due_date']);			     }			     if($result['data']['due_time'] == '')			     {				  unset($bid_update_array['due_time']);			     }			     if($result['data']['status'] != 'Released')				 {					unset($bid_update_array['released_date']);				 }			     if(isset($result['data']['deadline_type']))			     {			     	unset($bid_update_array['due_date_time']);			     	unset($bid_update_array['due_date']);			     	unset($bid_update_array['due_time']);			     }			     else			     {			     	unset($bid_update_array['number_days']);			     	unset($bid_update_array['before_or_after']);			     	unset($bid_update_array['schedule_id']);			     }			     				 // update the record				 $response = $this->Mod_template->update_bid($bid_update_array);				 if(TRUE == $response['status'])				 {				 									//Update record in ub_bid_cost_code table				if($result['data']['pricing_format'] == 'Line Items'){				 						$cost_code_update_array = array(					'ub_template_bid_cost_code_id' => $result['data']['code'],				  	'builder_id' => $this->user_session['builder_id'],				  	'template_bid_id' => $result['data']['ub_template_bid_id'],				  	'template_id' => $result['data']['template_id'],				  	'cost_code_id' => $result['data']['cost_code_id'],				  	'cost_code_description' => $result['data']['sub_description'],				  	'status' => $result['data']['status'],		            'code' => $result['data']['code'],		            'modified_by' => $this->user_session['ub_user_id'], 		            'modified_on' => TODAY,);					  $response_cost_code = $this->Mod_template->update_bid_cost_code($cost_code_update_array);				 }			     $this->Mod_template->response($response);			    }			  }			 }			 else			 {			 	//echo "hi".$ub_template_bid_id;exit;			 	$result_data = $this->Mod_template->get_template_bid(array(					         'select_fields' => array('TEMPLATE_BID.template_id','TEMPLATE_BID.bid_id','TEMPLATE_BID.ub_template_bid_id', 'TEMPLATE_BID.builder_id','TEMPLATE_BID.package_title','TEMPLATE_BID.number_days','TEMPLATE_BID.before_or_after','TEMPLATE_BID.schedule_id','TEMPLATE_BID.due_date_time','TEMPLATE_BID.due_date','TEMPLATE_BID.due_time','TEMPLATE_BID.daily_sub_reminder','TEMPLATE_BID.allow_multi_bids','TEMPLATE_BID.pricing_format','TEMPLATE_BID.has_checklist','TEMPLATE_BID.checklist_id','TEMPLATE_BID.description','TEMPLATE_BID.invitation_text','TEMPLATE_BID.status'),			                 'where_clause' => (array('ub_template_bid_id' =>  $ub_template_bid_id))			));			$get_cost_code_result = $this->Mod_template->get_template_bid_cost_code(array(					         'select_fields' => array('Group_concat(TEMPLATE_BID_COST_CODE.ub_template_bid_cost_code_id) as ub_bid_cost_code_id','Group_concat(TEMPLATE_BID_COST_CODE.cost_code_id) as cost_code_id','Group_concat(TEMPLATE_BID_COST_CODE.cost_code_description) as cost_code_description','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),			                 'join'=> array('variance_code'=>'Yes'),  			                 'where_clause' => (array('TEMPLATE_BID_COST_CODE.template_bid_id' =>  $ub_template_bid_id))			));									//echo "<pre>";print_r($result_data);exit;			if($result_data['aaData'][0]['number_days'] > 0 || $result_data['aaData'][0]['schedule_id'] > 0)			{				$result_data['aaData'][0]['link_to'] = 'Yes';			}			if(TRUE === $get_cost_code_result['status'])			{				$data['get_cost_code_result']  = $get_cost_code_result['aaData'][0];			}						if(TRUE === $result_data['status'])			{				$data['bid_data']  = $result_data['aaData'][0];			}									//print_r($service_coordinator_list);						   	       }	     } 	    // Here ub_bid_id value is 0. So It will enter to Insert function		else		{		  if(!empty($this->input->post()))		  {			$result = $this->sanitize_input();			if(TRUE === $result['status'])			{				//print_r($result);exit;				if(isset($result['data']['due_time']) && $result['data']['due_time'] != '')			    {				 $result['data']['due_time'] = date('H:i:s', strtotime($result['data']['due_time']));			    }			    if(isset($result['data']['due_date']) && $result['data']['due_date'] !='')			    {				 $result['data']['due_date'] = date("Y-m-d", strtotime($result['data']['due_date']));			    }			    if(isset($result['data']['checklist_id']) && $result['data']['checklist_id'] !== null && $result['data']['checklist_id']!='Nothing selected')			    {			   					$result['data']['checklist_id'] = "".implode(",", $result['data']['checklist_id'])."";				}				else				{					$result['data']['checklist_id'] = '';				}			    if(isset($result['data']['schedule_id']) && $result['data']['schedule_id'] !== null && $result['data']['schedule_id']!='Nothing selected')			    {				   $result['data']['schedule_id'] = $result['data']['schedule_id'];			    }			    else			    {			    	$result['data']['schedule_id'] = '';			    }							$bid_insert_array = array(			  	'builder_id' => $this->user_session['builder_id'],			  	'template_id' => $this->template_id,			  	'package_title' => $result['data']['package_title'],			  	'number_days' => $result['data']['number_days'],			  	'before_or_after' => $result['data']['before_or_after'],			  	'schedule_id' => $result['data']['schedule_id'],			  	'due_date_time' => $result['data']['due_date'] . ' ' . $result['data']['due_time'],			  	'due_date' => $result['data']['due_date'],			  	'due_time' => $result['data']['due_time'],			  	'daily_sub_reminder' => $result['data']['daily_sub_reminder'],			  	'pricing_format' => $result['data']['pricing_format'],			  	'checklist_id' => $result['data']['checklist_id'],			  	'has_checklist' => isset($result['data']['has_checklist']) ? "Yes" : "No",			  	'allow_multi_bids' => isset($result['data']['allow_multi_bids']) ? "Yes" : "No",			  	'description' => $result['data']['description'],			  	'status' => 'In Progress',	            'created_by' => $this->user_session['ub_user_id'],	            'created_on' => TODAY,	            'modified_by' => $this->user_session['ub_user_id'], 	            'modified_on' => TODAY,);				 if($result['data']['due_date'] == '' && $result['data']['due_time'] == '')			     {				   unset($bid_insert_array['due_date_time']);			     }                 if($result['data']['due_date'] == '')			     {				  unset($bid_insert_array['due_date']);			     }			     if($result['data']['due_time'] == '')			     {				  unset($bid_insert_array['due_time']);			     }			     if(isset($result['data']['deadline_type']))			     {			     	unset($bid_insert_array['due_date_time']);			     	unset($bid_insert_array['due_date']);			     	unset($bid_insert_array['due_time']);			     }			     else			     {			     	unset($bid_insert_array['number_days']);			     	unset($bid_insert_array['before_or_after']);			     	unset($bid_insert_array['schedule_id']);			     }				// insert the record				$response = $this->Mod_template->add_bid($bid_insert_array);								if(TRUE == $response['status'])				{				$bid_id = $response['insert_id'];				//Insert cost codes in ub_bid_cost_code table						if($result['data']['pricing_format'] == 'Line Items'){									$cost_code_insert_array = array(				  	'builder_id' => $this->user_session['builder_id'],				  	'template_id' => $this->template_id,				  	'template_bid_id' => $bid_id,				  	'cost_code_id' => $result['data']['cost_code_id'],				  	'cost_code_description' => $result['data']['sub_description'],				  	'status' => 'In Progress',		            'created_by' => $this->user_session['ub_user_id'],		            'created_on' => TODAY,		            'modified_by' => $this->user_session['ub_user_id'], 		            'modified_on' => TODAY,);		            					  $response_cost_code = $this->Mod_template->add_bid_cost_code($cost_code_insert_array);				      				}				 				}			    $this->Mod_template->response($response);							}			else			{								$this->Mod_template->response($result);			}		  }	    }	     $project_list = $this->Mod_project->get_projects(array(					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),					'where_clause' => (array('PROJECT.builder_id' =>  $this->user_session['builder_id']))					));	    $data['project_list']=array();	    if(TRUE === $project_list['status'])		{			$data['project_list'] = $this->Mod_project->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');		}	    //Before Or After Dropdown	    $before_or_after_dropdown[] = array('id' => 'Before','val' => 'Before');	    $before_or_after_dropdown[] = array('id' => 'After','val' => 'After');	    $data['before_or_after_dropdown_list'] = $this->Mod_bid->build_ci_dropdown_array($before_or_after_dropdown,'id', 'val');	    		// Get cost codes		$args['where_clause'] = "builder_id = ".$this->builder_id." || builder_id = 0"; 		$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');		$cost_code_options = $this->Mod_bid->get_db_options(UB_COST_CODE, $args);		$data['cost_code_options'] = $cost_code_options;				// Get Sub contractor list		/*$args_sub['where_clause'] = array('builder_id'=>$this->builder_id);		$args_sub['select_fields'] = array('ub_subcontractor_id', 'company');		$sub_contractor_options = $this->Mod_bid->get_db_option(UB_SUBCONTRACTOR, $args_sub);		$data['sub_contractor_options'] = $sub_contractor_options;		$sub_contractors = $this->Mod_bid->get_db_options(UB_SUBCONTRACTOR, $args_sub);		$data['sub_contractors'] = $sub_contractors;*/				// Get check lists		$args_chk['where_clause'] = array('builder_id'=>$this->builder_id,'project_id'=>$this->project_id);		$args_chk['select_fields'] = array('ub_checklist_id','title');		$checklist_options = $this->Mod_bid->get_db_option(UB_CHECKLIST, $args_chk);		$data['checklist_options'] = $checklist_options;				// Schedule		$args_schedule['where_clause'] = array('builder_id'=>$this->builder_id,'project_id'=>$this->project_id);		$args_schedule['select_fields'] = array('ub_schedule_id','title');		$schedule_options = $this->Mod_bid->get_db_options(UB_SCHEDULE, $args_schedule);		$data['schedule_options'] = $schedule_options;		$this->template->view($data);	}	/** 	 * Bids Class	 * 	 * @package: get_bids	 * @subpackage: get_bids	 * @category: get_bids	 * @author: Gayathri Kalyani 	 * @createdon(DD-MM-YYYY): 09-05-2015 	*/	public function get_bids($page_count = '')	{	        				if(!empty($this->template_id))        {            $post_array[] = array(                            'field_name' => 'TEMPLATE_BID.template_id',                            'value'=> $this->template_id,                            'type' => '='                        );        }        else        {            $post_array[] = array(                            'field_name' => 'TEMPLATE_BID.template_id',                            'value'=> $this->users_template_ids,                            'type' => '||',                            'classification' => 'primary_ids'                        );        } 		$post_array[] = array(							'field_name' => 'TEMPLATE_BID.builder_id',							'value'=> $this->user_session['builder_id'], 							'type' => '='							);				$total_count_array =  array();		if(!empty($this->input->post()))		{			// Sanitize input			$result = $this->sanitize_input();			if(TRUE === $result['status'])			{			$search_session_array = array();						  			  if(isset($result['data']['daterange']) && $result['data']['daterange']!='')				{										$formatted_date = explode(" ",$result['data']['daterange']);					 $post_array[] = array(										'field_name' => 'TEMPLATE_BID.released_date',										'from'=> date("Y-m-d", strtotime($formatted_date[0])),										'to'=> date("Y-m-d", strtotime($formatted_date[2])),										'type' => 'daterange'									      );   						$search_session_array['daterange'] = $result['data']['daterange'];				}				$this->module = 'TEMP_BIDS';				if($page_count == 'result_array')				{					if(isset($this->uni_session_get('SEARCH')['daterange']) && $this->uni_session_get('SEARCH')['daterange']!='')				  {										$formatted_date = explode(" ",$this->uni_session_get('SEARCH')['daterange']);					 $post_array[] = array(										'field_name' => 'TEMPLATE_BID.released_date',										'from'=> date("Y-m-d", strtotime($formatted_date[0])),										'to'=> date("Y-m-d", strtotime($formatted_date[2])),										'type' => 'daterange'									      );   					//$search_session_array['daterange'] = $result['data']['daterange'];				  }				}			     // Setting session 				/*					Paggination length stored in seesion code start here				*/				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];				$this->uni_set_session('search', $search_session_array);				// Where clause argument				$where_str = $this->Mod_template->build_where($post_array);				// Pagination Array				$pagination_array = array();				if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))				{					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);					 $total_count_array = $this->Mod_template->get_template_bid(array(												'select_fields' => array('COUNT(TEMPLATE_BID.ub_template_bid_id) AS total_count'),												'where_clause' => $where_str,												//'join'=> array('builder'=>'Yes','bid_request'=>'Yes','cost_code' => '','project'=>'',)												)); 				}				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))				{					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);					 $total_count_array = $this->Mod_template->get_template_bid(array(												'select_fields' => array('COUNT(TEMPLATE_BID.ub_template_bid_id) AS total_count'),												'where_clause' => $where_str,												//'join'=> array('builder'=>'Yes','bid_request'=>'Yes','cost_code' => '','project'=>'',)												)); 				}				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))				{					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);					// Get number of records					 $total_count_array = $this->Mod_template->get_template_bid(array(												'select_fields' => array('COUNT(TEMPLATE_BID.ub_template_bid_id) AS total_count'),												'where_clause' => $where_str,												//'join'=> array('builder'=>'Yes','bid_request'=>'Yes','cost_code' => '','project'=>'',)												)); 				}*/				// print_r($result['data']['sEcho']);				// Order by				$order_by_where = '';				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)				{					$sort_type = $result['data']['sSortDir_0'];					$sort_filed_column_id = $result['data']['iSortCol_0'];					$dt_filed_name = 'mDataProp_';					$order_by_where = 'TEMPLATE_BID.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;				}				else				{					$order_by_where = 'TEMPLATE_BID.modified_on DESC';				}			}			else			{				$this->Mod_bid->response($result);			}		}				$datetime_array = array('TEMPLATE_BID.due_date_time'=> 'due_date_time');		$query_array = array('select_fields' => array('TEMPLATE_BID.ub_template_bid_id','TEMPLATE_BID.package_title','TEMPLATE_BID.due_date_time','TEMPLATE_BID.released_date','TEMPLATE_BID.status,'.$this->Mod_user->format_user_datetime($datetime_array)),		//'join'=> array('builder'=>'Yes','bid_request'=>'Yes','cost_code' => '','project'=>'',),		'where_clause' => $where_str,		'order_clause' => $order_by_where,		'pagination' => $pagination_array		);		$result_data = $this->Mod_template->get_template_bid($query_array);		if($page_count == 'result_array')		{		  //print_r($result_data);exit;		  return $result_data;		}		unset($query_array['pagination']);		$result_count_array = $this->Mod_template->get_template_bid($query_array);		// echo'<pre>';print_r($result_data);exit;		$final_result_data = array();				if($result_data['status'] == FALSE)		{			$result_data = array();			$result_data['aaData'] = array();		}		else		{			$result_data['iTotalRecords'] = isset($result_count_array['aaData'])?count($result_count_array['aaData']):'';			$result_data['iTotalDisplayRecords'] = isset($result_count_array['aaData'])?count($result_count_array['aaData']):'';			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';		}		// Response data		$this->Mod_template->response($result_data);	}		/** 	* Destroy Session	* 	* @method: destroy_session 	* @access: public 	* @param:  ajax post array	* @return: array 	* @createdby: Gayathri Kalyani	*/	public function destroy_session()	{		if(!empty($this->input->post()))		{			// Sanitize input			$result = $this->sanitize_input();			if(TRUE === $result['status'])			{				$result = $this->Mod_bid->destroy_session($result['data']);			}			$this->Mod_bid->response($result);		}		else		{			$response['status'] = FALSE;			$response['message'] = 'Delete Failed: Post array is empty';		}	}	/** 	* Apply Saved Search	* 	* @method: apply_saved_search 	* @access: public 	* @params: 	* @return: array 	* @created by: Gayathri kalyani 	* @created on: 03/04/2015 	* url encoded : 	*/	public function apply_saved_search()	{		/* Apply Filter code starts here */		   //$this->module = 'TEMP_BIDS';		   $post_array = array( 'builder_id' => $this->user_session['builder_id'],							    'user_id' => $this->user_session['ub_user_id'],							    'module_name' => $this->module		                      );							 		 $result_data = $this->Mod_saved_search->get_saved_search(array(												 'select_fields' => array(),												 'where_clause' => $post_array												 ));		// echo '<pre>';print_r($result_data);								 		if(!empty($this->input->post()))		{			if($result_data['status'] == true)			{				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];				$task_array = $this->input->post();				$post_array = array(					'ub_saved_search_id' => $save_search_id,					'search_params' => "'".serialize($task_array)."'"				    );				$response = $this->Mod_saved_search->update_saved_search($post_array);				$this->Mod_saved_search->response($response);				// echo '<pre>';print_r($post_array);			}						else			{				$task_array = $this->input->post();				$post_array = array(					'search_params' => "'".serialize($task_array)."'"				);				$response = $this->Mod_saved_search->update_saved_search($post_array);				$this->Mod_saved_search->response($response);				// echo '<pre>';print_r($response);exit;			}		}		else	{		 $serialized_data = $result_data['aaData'][0]['search_params'];		  // echo '<pre>';print_r($result_data);exit;		 $remove_single_quote = str_replace("'", '', $serialized_data);		 $unserialized_data = unserialize($remove_single_quote);		 $result_data['aaData'][0]['search_params'] = $unserialized_data;		 if(!empty($unserialized_data))		{				if(!empty($unserialized_data['bid_package_status']))				{					// Set value in session					$search_session_array['bid_package_status'] = $unserialized_data['bid_package_status'];				}				if(!empty($unserialized_data['bid_status']))				{					// Set value in session					$search_session_array['bid_status'] = $unserialized_data['bid_status'];				}				if(!empty($unserialized_data['daterange']))				{					// Set value in session					$search_session_array['daterange'] = $unserialized_data['daterange'];				}								// Setting session 								 $this->uni_set_session('search', $search_session_array);								// Response data				$this->Mod_bid->response($result_data);		}	}}		/** 	* Delete bid	* 	* @method: delete_log 	* @access: public 	* @param:  ajax post array	* @return: array 	* url: bgxf19ncy9kZWxldgxf1Vfbgxf19nLw--	*/	public function delete_bid()	{				if(!empty($this->input->post()))		{			// Sanitize input			$result = $this->sanitize_input();			if(TRUE === $result['status'])			{				// Delete functionality				$response = $this->Mod_template->delete_bids($result['data']);				$respoce_array = $this->get_bids($page_count = 'result_array');				//echo '<pre>';print_r($respoce_array);exit;				if($respoce_array['status'] == FALSE)				{					$this->module = 'TEMP_BIDS';					if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && $this->uni_session_get('SEARCH')['iDisplayStart'] > 0)					{						$search_session_array['iDisplayStart'] = (($this->uni_session_get('SEARCH')['iDisplayStart']) - ($this->uni_session_get('SEARCH')['iDisplayLength']));				        $search_session_array['iDisplayLength'] = $this->uni_session_get('SEARCH')['iDisplayLength'];				        $this->uni_set_session('search', $search_session_array);					}				}			}			else			{				$this->Mod_bid->response($result);			}		}		else		{			$response['status'] = FALSE;			$response['message'] = 'Delete Failed: Post array is empty';		}		//Response data		$this->Mod_template->response($response);	}			//import selections from template	public function import_bids()	{		$result = $this->sanitize_input();		//echo '<pre>';print_r($result);exit;		  //Insert in UB_CHECKLIST table		$template_checklist_info = $this->Mod_template->get_template_checklist(array(		'select_fields' => array('*'),		'where_clause' => array('template_id' => $result['data']['template_id'])		));		if($template_checklist_info['status'] == TRUE)		{			$checklist_data = $template_checklist_info['aaData'];			foreach ($checklist_data as $check_key => $check_value)			{				$check_value['project_id'] = $this->project_id;				$check_value['created_on'] = TODAY;				$check_value['modified_on'] = TODAY;				$check_value['created_by'] = $this->user_session['ub_user_id'];				$check_value['modified_by'] = $this->user_session['ub_user_id'];				unset($check_value['ub_template_checklist_id']);				unset($check_value['template_id']);				$this->Mod_checklist->add_check_list($check_value);				}		} 		$template_bid_info = $this->Mod_template->get_template_bid(array(							'select_fields' => array('*'),							'where_clause' => array('template_id' => $result['data']['template_id'])							));		if($template_bid_info['status'] == TRUE)		{			$bid_data = $template_bid_info['aaData'];			foreach ($bid_data as $key => $value) 			{				$bid_id = $value['bid_id'];				$value['project_id'] = $this->project_id;				$value['created_on'] = TODAY;				$value['modified_on'] = TODAY;				$value['created_by'] = $this->user_session['ub_user_id'];				$value['modified_by'] = $this->user_session['ub_user_id'];				unset($value['ub_template_bid_id']);				unset($value['bid_id']);				unset($value['template_id']);				unset($value['checklist_id']);		        unset($value['released_date']);		        unset($value['due_date_time']);		        unset($value['due_date']);		        unset($value['due_time']);				$bid_response = $this->Mod_bid->add_bid($value);				$template_bid_cost_code_info = $this->Mod_template->get_template_bid_cost_code(array(								'select_fields' => array('*'),								'where_clause' => array('template_id' => $result['data']['template_id'],'bid_id' => $bid_id)								));				/*for($i = 0;$i<count($bid_response);$i++) {*/				if($template_bid_cost_code_info['status'] == TRUE)				{					$bid_cost_code_data = $template_bid_cost_code_info['aaData'];					foreach ($bid_cost_code_data as $keys => $values) 					{						$values['project_id'] = $this->project_id;						$values['bid_id'] = $bid_response['insert_id'];						$values['created_on'] = TODAY;						$values['modified_on'] = TODAY;						$values['created_by'] = $this->user_session['ub_user_id'];						$values['modified_by'] = $this->user_session['ub_user_id'];						unset($values['ub_template_bid_cost_code_id']);						unset($values['template_id']);						$this->Mod_bid->add_bid_cost_code($values);					}				}			}	    }		$this->Mod_bid->response($template_bid_info);	}    }