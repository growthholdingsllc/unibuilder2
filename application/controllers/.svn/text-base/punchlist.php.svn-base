<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * punchlist Class
 * 
 * @package: punchlist
 * @subpackage: punchlist
 * @category: punchlist
 * @author: satheesh kumar 
 * @createdon(DD-MM-YYYY): 17-03-2015 
*/
class Punchlist extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();

		$this->load->model(array('Mod_punchlist','Mod_general_value','Mod_timezone','Mod_user','Mod_saved_search', 'Mod_project','Mod_doc'));
		$this->module;
    }
	/** 
	* Get all punchlist
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @createdby: satheesh kumar
	*/
	public function index()
	{
		$data = array(
		'title'        => "Unibuilder - Punchlist",		
		'content'      => 'content/punchlist/punchlist',
        'page_id'      => 'task',
		'data_table'   =>'data_table',
		'date_all'	   =>'date_all',
		'new_punchlist_url' => $this->crypt->encrypt('punchlist/save_punchlist/'),
		'current_url' => $this->uri->segment(1),
		'get_punchlists_url' => $this->crypt->encrypt('punchlist/get_punchlists/'),
		'search_session_array' => $this->uni_session_get('SEARCH'),
		);
		
		//get punch_list_priority custom fields from general value table
		$args = array('classification'=>'punch_list_priority', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$punchlist_priority_array = $this->Mod_general_value->get_general_value($args);
		$data['punchlist_priority']= array();
		if(isset($punchlist_priority_array['values']))
		{
			$data['punchlist_priority']=$punchlist_priority_array['values'];
		}
		
		//get punchlist_tags custom fields from general value table
		$args = array('classification'=>'punch_list_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$punchlist_tags_array = $this->Mod_general_value->get_general_value($args);
		$data['punchlist_tags']= array();
		if(isset($punchlist_tags_array['values']))
		{
			$data['punchlist_tags']=$punchlist_tags_array['values'];
		}
		
		//Apply filter code
		$post_array = array( 'builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
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
		$this->template->view($data);
		
	}

	/** 
	* Get punchlists
	* 
	* @method: get_punchlists 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: satheesh kumar
	*/	
	public function get_punchlists($page_count = '')
	{
		$post_array[] = array(
							'field_name' => 'PUNCHLIST.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		/* "ISDELETED" condition checking 06-10-2015 added by chandru */
		$post_array[] = array(
				'field_name' => 'PUNCHLIST.is_delete',
				'value' => 'No',
				'type' => '='
			);
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'PUNCHLIST.project_id',
							'value'=> $this->project_id, 
							'type' => '='
						);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'PUNCHLIST.project_id',
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
			if(TRUE === $result['status'])
			{
				// Search Input Array
				//All selected priority field
				$search_session_array = array();
				if(isset($result['data']['priority']) && $result['data']['priority']!='' && $result['data']['priority'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'PUNCHLIST.priority',
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
								'field_name' => 'PUNCHLIST.status',
								'value'=> $result['data']['status'], 
								'type' => '='
							);
					$search_session_array['status'] = $result['data']['status'];
					// Set value in session
				}
				//No punchlist tag filter field
				 if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'PUNCHLIST.tags',
								'value'=> $result['data']['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['tags'] = $result['data']['tags'];	
				} 
				/* //code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('punchlist')][strtolower('view all')]) && $this->user_role_access[strtolower('punchlist')][strtolower('view all')] == 0)
				{
					if(isset($this->user_role_access[strtolower('punchlist')][strtolower('view created by me')]) && $this->user_role_access[strtolower('punchlist')][strtolower('view created by me')] == 1)
					{
						$post_array[] = array(
										'field_name' => 'PUNCHLIST.created_by',
										'value'=> $this->user_id, 
										'type' => '=',
										);
					}
				}	 */
				// Setting session
				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength']; 
				$this->uni_set_session('search', $search_session_array);

				$where_str = $this->Mod_punchlist->build_where($post_array);

				// echo '<pre>';print_r($where_str);exit;
				// Pagination Array
				$pagination_array = array();
				if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);
					$total_count_array = $this->Mod_punchlist->get_punchlist(array(
												'select_fields' => array('COUNT(PUNCHLIST.ub_punch_list_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes')
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					$total_count_array = $this->Mod_punchlist->get_punchlist(array(
												'select_fields' => array('COUNT(PUNCHLIST.ub_punch_list_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes')
												));
				}
				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_punchlist->get_punchlist(array(
												'select_fields' => array('COUNT(PUNCHLIST.ub_punch_list_id) AS total_count'),
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
					// Get formatted sort name
					$format_sort_name = $this->Mod_punchlist->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					// echo '<pre>';print_r("sdfsf");
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'PUNCHLIST.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
						
				}
				else
				{
					$order_by_where = 'PUNCHLIST.ub_punch_list_id DESC';
				}
				
			}
			else
			{
				$this->Mod_punchlist->response($result);
			}
		}
		$query_array = array(
							'select_fields' => array('PUNCHLIST.ub_punch_list_id','PUNCHLIST.title', 'PUNCHLIST.priority', 'PUNCHLIST.modified_by', 'PUNCHLIST.modified_on', 'PUNCHLIST.created_by', 'PUNCHLIST.tags', 'PUNCHLIST.status','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator'),
							'join'=> array('builder'=>'Yes'),
							'where_clause' => $where_str,
							'order_clause' => $order_by_where, 
							'pagination' => $pagination_array
        );
        $result_data = $this->Mod_punchlist->get_punchlist($query_array);
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
		$this->Mod_punchlist->response($result_data);
	}
	
	
	/** 
	* save punchlist
	* 
	* @method: save_punchlist 
	* @access: public 
	* @param:  
	* @return: array 
	* @createdby: satheesh kumar
	*/
	public function save_punchlist($ub_punch_list_id = 0)
	{
		$results = $this->sanitize_input();
		$result_data = array(); 
 
		$data = array(
		'title'        => "PUNCHLIST",		
		'content'      => 'content/punchlist/save_punchlist',
		'drop_upload'  => 'drop_upload',
        'page_id'      => 'task',
		'date_all'	   => 'date_all' 
		);
		
		//get project id from task table // by satheesh kumar
		if(empty($this->project_id) && $ub_punch_list_id > 0)
		{
			$where_args = array('ub_punch_list_id' => $ub_punch_list_id);
			$project_id = $this->Mod_project->get_project_id(UB_PUNCH_LIST,$where_args);
			$this->project_id = $project_id['aaData'][0]['project_id'];
			$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		//end code for get project id
		
		//Get folder_id
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
		/* create the temp dir code ends here  */
			
		if($ub_punch_list_id > 0 || isset($results['data']['ub_punch_list_id']) && $results['data']['ub_punch_list_id'] > 0)
		{
			/*Code for update file */
			$this->ub_punch_list_id = (isset($results['data']['ub_punch_list_id'])) ? $results['data']['ub_punch_list_id'] : $ub_punch_list_id;
			$punchlist_data = array(	  
								  'flag' => 1, 
								  'builder_id'	=> $this->builder_id,
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->ub_punch_list_id,
								);
			// echo '<pre>';print_r($punchlist_data);					
			$result_array = $this->Mod_doc->get_files_for_folder($punchlist_data);
			//echo '<pre>';print_r($result_array);exit;
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
				$results = $this->sanitize_input();
				
				if(!empty($results['data']['tags']))
				{
					$tags = "".implode(",", $results['data']['tags'])."";
				}
				else
				{
					$tags = '';
				}
				$checklist_description_checkbox = "";
				if(isset($results['data']['checklist_mark_hidden']))
				{
					$checklist_description_checkbox = $results['data']['checklist_mark_hidden'];
				}
				//echo '<pre>';print_r($results['data']);exit;
				$punchlist_insert_main_array = array(
					'title' => $results['data']['title'],
					'note' => $results['data']['task_note'],
					'priority' => $results['data']['priority'],
					'tags' => $tags,
					'description' => $results['data']['checklist_description'],
					'description_mark_complete_status' => $checklist_description_checkbox,
					'mark_complete_status' => $results['data']['marked-list'],
					'checklist_description_id' => $results['data']['checklist_description_id'],
					'created_on' => $results['data']['created_on'],
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY,
					'project_id' => $results['data']['project_id'],
					'ub_punch_list_id'=>$results['data']['ub_punch_list_id']
					);
					$response = $this->Mod_punchlist->update_punchlist($punchlist_insert_main_array);
					$this->Mod_punchlist->response($response);
			}
			else
			{
			 $result_data = $this->Mod_punchlist->get_punchlist(array(
			'select_fields' => array('PUNCHLIST.ub_punch_list_id', 'PUNCHLIST.builder_id', 'PUNCHLIST.project_id',
			'PUNCHLIST.note', 'PUNCHLIST.title','PUNCHLIST.tags','PUNCHLIST.priority','Group_concat(PUNCH_LIST_CHECKLIST.ub_punch_list_checklist_id) as check_list_id','Group_concat(PUNCH_LIST_CHECKLIST.punch_list_id) as punch_list_id','Group_concat(PUNCH_LIST_CHECKLIST.Description) as description','Group_concat(PUNCH_LIST_CHECKLIST.mark_complete_status) as description_checkbox','PUNCHLIST.mark_complete_status','PUNCHLIST.created_on'),
			'join'=> array('builder'=>'Yes','punchlist_checklist'=>'Yes'),
			'where_clause' => (array('PUNCHLIST.ub_punch_list_id' =>  $ub_punch_list_id))
			));
			//echo '<pre>';print_r($result_data);exit;
			$data['result_data']  = $result_data['aaData'][0];
		    }
		}
		else
		{
			$post_data = array();
			if(!empty($this->input->post()))
			{
				$results = $this->sanitize_input();
				// echo '<pre>';print_r($results);exit;
				if(!empty($results['data']['tags']))
				{
					$tags = "".implode(",", $results['data']['tags'])."";
				}
				else
				{
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
				if(isset($results['data']['marked-list']) && $results['data']['marked-list'] == 'Yes')
				{
					$punchlist_status = 'Completed';
				}
				else
				{
					$punchlist_status = 'Not completed';
				}
				$punchlist_insert_main_array = array(
											'title' => $results['data']['title'],
											'note' => $results['data']['task_note'],
											'mark_complete_status' => $results['data']['marked-list'],
											'description' => $checklist_description,
											'description_mark_complete_status' => $checklist_description_checkbox,
											'priority' => $results['data']['priority'],
											'tags' => $tags,
											'status' => $punchlist_status,
											'created_by' => $this->user_session['ub_user_id'],
											'created_on' => TODAY,
											'modified_by' => $this->user_session['ub_user_id'], 
											'modified_on' => TODAY,
											'module_name' => $this->module
											);
				$response = $this->Mod_punchlist->add_punchlist($punchlist_insert_main_array);
				$this->Mod_punchlist->response($response);
			}
		}
		
		//get punch_list_priority custom fields from general value table
		$args = array('classification'=>'punch_list_priority', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$punchlist_priority_array = $this->Mod_general_value->get_general_value($args);
		$data['punchlist_priority']= array();
		if(isset($punchlist_priority_array['values']))
		{
			$data['punchlist_priority']=$punchlist_priority_array['values'];
		}
		
		//get punchlist_tags custom fields from general value table
		$args = array('classification'=>'punch_list_tags', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown');
		$punchlist_tags_array = $this->Mod_general_value->get_general_value($args);
		$data['punchlist_tags']= array();
		if(isset($punchlist_tags_array['values']))
		{
			$data['punchlist_tags']=$punchlist_tags_array['values'];
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
		
		$this->template->view($data);
	}
		
	
	
	/** 
	* Delete punchlist
	* 
	* @method: delete_punchlist 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: satheesh kumar
	*/
	public function delete_punchlist()
	{		
		
		$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{	
				// echo '<pre>';print_r($result['data']);exit;
				$response = $this->Mod_punchlist->delete_punchlists($result['data']);
				$respoce_array = $this->get_punchlists($page_count = 'result_array');
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
				$this->Mod_punchlist->response($result);
			}
			$this->Mod_punchlist->response($response);	
	}
	/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: satheesh kumar
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_punchlist->destroy_session($result['data']);
			}
			$this->Mod_punchlist->response($result);
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
	* @created by: satheesh kumar 
	* @created on: 20/07/2015 
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
				if(!empty($unserialized_data['priority']))
				{
						$search_session_array['priority'] =$unserialized_data['priority'];
				}
				if(!empty($unserialized_data['status']))
				{
					$search_session_array['status'] =$unserialized_data['status'];
				}
				if(!empty($unserialized_data['tags']))
				{
					$search_session_array['tags'] =$unserialized_data['tags'];
				}
				//$this->session->set_userdata('ACCOUNT', $this->account_session);
				$this->uni_set_session('search', $search_session_array);
				$this->Mod_punchlist->response($result_data);
			}
		}
	/* Apply Filter code Ends here */
	}
	
	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
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
			$this->Mod_punchlist->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	
}