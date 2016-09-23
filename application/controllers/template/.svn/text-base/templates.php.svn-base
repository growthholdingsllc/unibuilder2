<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * Log Class
 * 
 * @package: Log
 * @subpackage: Log
 * @category: Log
 * @author: Sidhartha
 * @createdon(DD-MM-YYYY): 24-03-2015 
*/

class Templates extends UNI_Controller {
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_template'));	
    }
    /** 
	* Get all logs
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: bgxf19ncy9pbmRleC8-
	*/
	public function index()
	{
		$data = array(
		'title'        => "TEMPLATE",		
		'content'      => 'template/content/template/template',
        'page_id'      => 'logs',
		'new_log_url' => $this->crypt->encrypt('template/templates/save_template/'),
		'current_url' => $this->uri->segment(1),
		'get_logs_url' => $this->crypt->encrypt('template/templates/get_template/'),
		'search_session_array' => $this->uni_session_get('SEARCH'),
		);
		
		//Get builder log tags from general value table
		$args = array('classification'=>'log_tags', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$log_tags_result = $this->Mod_general_value->get_general_value($args);
		$data['log_tags_array']=array();
		if(isset($log_tags_result['values']))
		{
			$data['log_tags_array'] = $log_tags_result['values'];
		}

		//Get all projects list from project table with the builder_id
		$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => array('PROJECT.builder_id'=> $this->builder_id)
					));
		$data['project_list']=array();
		if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_log->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		}
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
		}else{
		$apply_filter = false;;
		}
		
		$data['apply_filter'] = $apply_filter;
		$this->template->view($data);	
	}	
	
	/** 
	* Save logs
	* 
	* @method: save_log 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9uZXdfbgxf19nLw--
	* @url: bgxf19ncy9zYXZlX2xvZy8-
	*/	
	public function save_log($ub_daily_log_id = 0)
	{
		$this->encrypt_key = 'XYZ!@#$%';
		$result_data = array();
		$post_data = array();
		$data = array(
				    'title'        => "LOGS",		
				    'content'      => 'content/logs/save_log',
				    'drop_upload'  => 'drop_upload',
				    'page_id'      => 'logs',
				    'date_all'	   =>'date_all',
				  	);
		
		//get project id from task table // by satheesh kumar
		if(empty($this->project_id) && $ub_daily_log_id > 0)
		{
		$where_args = array('ub_daily_log_id' => $ub_daily_log_id);
		$project_id = $this->Mod_project->get_project_id(UB_DAILY_LOG,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
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

		$dir_response = $this->Mod_doc->create_default_dir();
		
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
		  $data['temprory_dir_id'] = '1';	
		}

		//end code for get project id
		
		//Codition check wheather the ub_daily_log_id value is greater than 0 or not
		if($ub_daily_log_id > 0 || null!==$this->input->post('ub_daily_log_id') && $this->ci_decrypt($this->input->post('ub_daily_log_id'), $this->encrypt_key) > 0)
		{
			$this->ub_daily_log_id = (null!=$this->input->post('ub_daily_log_id')) ? $this->ci_decrypt($this->input->post('ub_daily_log_id'), $this->encrypt_key) : $ub_daily_log_id;
			$task_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->ub_daily_log_id,
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
			
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  $result = $this->sanitize_input();
			  if(TRUE === $result['status'])
			  {
			  	$result['data']['ub_daily_log_id'] = $this->ci_decrypt($result['data']['ub_daily_log_id'], $this->encrypt_key);
			  	// Update LOG Value
				if(isset($result['data']['log_date']))
				{
					$result['data']['log_date'] = date("Y-m-d", strtotime($result['data']['log_date']));
				}
				$result['data']['modified_on'] = TODAY;
				$result['data']['modified_by'] = $this->user_session['ub_user_id'];
				if(isset($result['data']['tags']) && $result['data']['tags'] !== null && $result['data']['tags']!='Nothing selected')
				{
					$result['data']['tags'] = "".implode(",", $result['data']['tags'])."";
				}
				else
				{
					$result['data']['tags'] = '';
				}
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
					unset($result['data']['temp_directory_id']);
					unset($result['data']['temp_file_path']);
					unset($result['data']['folder_id']);
					unset($result['data']['uploaded_doc_content_length']);
				}
				$response = $this->Mod_log->update_log($result['data']);
				$this->Mod_log->response($response);
			  }
			 }
			else
			{
			//Get all comments list from ub_daily_log_comments table with the builder_id
			$datetime_array = array('COMMENT.created_on'=>'comment_created_on');
			$comments_list = $this->Mod_comment->get_comment(array(
									'select_fields' => array('COMMENT.show_sub','COMMENT.show_owner','COMMENT.comments','COMMENT.created_by','USER.first_name','COMMENT.ub_comments_id,'.$this->Mod_user->format_user_datetime($datetime_array)),
									'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes','daily_log'=>'Yes'),
									'where_clause' => array('COMMENT.module_pk_id'=> $ub_daily_log_id),
									'order_clause' => 'COMMENT.ub_comments_id desc'
													));
			if(isset($comments_list['aaData']))
			{
				$data['comments_list'] = $comments_list['aaData'];
			}else{
			$data['comments_list'] = false;
			}	
			
			// Get inserted data with help of id
			 $result_data = $this->Mod_log->get_logs(array(
			'select_fields' => array('LOG.ub_daily_log_id', 'LOG.builder_id', 'LOG.project_id',
			'LOG.log_date', 'LOG.log_notes','PROJECT.project_name','LOG.tags','LOG.private','LOG.show_owner','LOG.show_subs','LOG.weather_notes','LOG.weather_description'),
			'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
			'where_clause' => (array('ub_daily_log_id' =>  $ub_daily_log_id))
			));
			if(TRUE === $result_data['status'])
			{
				$data['log_data']  = $result_data['aaData'][0];
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
				if(isset($result['data']['log_date']))
				{
					$result['data']['log_date'] = date("Y-m-d", strtotime($result['data']['log_date']));
				}
				$result['data']['builder_id'] = $this->user_session['builder_id'];
				$result['data']['created_on'] = TODAY;
				$result['data']['created_by'] = $this->user_session['ub_user_id'];
				$result['data']['modified_on'] = TODAY;
				$result['data']['modified_by'] = $this->user_session['ub_user_id'];
				$result['data']['status'] = "Continue";
				if(isset($result['data']['tags']) && $result['data']['tags'] !== null && $result['data']['tags']!='Nothing selected')
				{
					$result['data']['tags'] = "".implode(",", $result['data']['tags'])."";
				}
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
					unset($result['data']['temp_directory_id']);
					unset($result['data']['temp_file_path']);
					unset($result['data']['folder_id']);
					unset($result['data']['uploaded_doc_content_length']);
				}
				  // insert the record
				  $response = $this->Mod_log->add_log($result['data']);
				  $this->Mod_log->response($response);
			}
			else
			{
				$this->Mod_log->response($result);
			}
		  }
	    }
	    //Get all projects of a builder
	    $project_str = 'PROJECT.builder_id = '.$this->builder_id.' AND (PROJECT.created_by = '.$this->user_id.' || PROJECT.owner_id = '.$this->user_id.' || PROJECT.project_managers = '.$this->user_id.' || FIND_IN_SET('.$this->user_id.', PROJECT.project_assigned_users))';

	    $project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => $project_str
					));
	    $data['project_list']=array();
	    if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_project->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		}
		//get log_tags from general value table
		$args = array('classification'=>'log_tags', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['log_tags_array'] = $result['values'];
		$this->template->view($data);
		
      }


	/** 
	* Get logs
	* 
	* @method: get_logs 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9pbmRleC8-
	*/	
	public function get_logs()
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
									'field_name' => 'LOG.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				if(!empty($this->project_id))
				{
				$post_array[] = array(
								'field_name' => 'LOG.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
				}
				else
				{
				$post_array[] = array(
								'field_name' => 'LOG.project_id',
								'value'=> $this->users_project_ids, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
				}				
				// Date range search input
				if(isset($result['data']['daterange']) && $result['data']['daterange']!='' && $result['data']['daterange'] != 'null')
				{
					$formatted_date = explode(" ",$result['data']['daterange']);
					$post_array[] = array(
										'field_name' => 'LOG.log_date',
										'from'=> date("Y-m-d", strtotime($formatted_date[0])),
										'to'=> date("Y-m-d", strtotime($formatted_date[2])),
										'type' => 'daterange'
										);
					$search_session_array['daterange'] = $result['data']['daterange'];
				}
				// Tags search input
				/*if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags']!='Nothing selected' && $result['data']['tags']!='null')
				{
					$post_array[] = array(
										'field_name' => 'LOG.tags',
										'value'=> $result['data']['tags'], 
										'type' => '||',
										'classification' => 'dynamnic_text'
										);
					$search_session_array['tags'] = $result['data']['tags'];
				}*/
				if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
				{
					if(!is_array($result['data']['tags']))
					{
					$post_array[] = array(
								'field_name' => 'LOG.tags',
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
								'field_name' => 'LOG.tags',
								'value'=> $new_array_for_tags, 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
							}
						}
				} 
				// Project search input
				/*if(isset($result['data']['project']) && $result['data']['project']!='' && $result['data']['project']!='Nothing selected' && $result['data']['project']!='null')
				{
					$post_array[] = array(
										'field_name' => 'LOG.project_id',
										'value'=> $result['data']['project'], 
										'type' => '=',
										);
					$search_session_array['project'] = $result['data']['project'];
				}*/
				// Setting session 
				// $this->module = 'MOM';
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				//echo "<pre>";print_r($post_array);exit;
				$where_str = $this->Mod_log->build_where($post_array);
				//echo $where_str;
				//code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('logs')][strtolower('view all')]) && $this->user_role_access[strtolower('logs')][strtolower('view all')] == 0)
				{	
					$where_str = $where_str.' && (';
					if(isset($this->user_role_access[strtolower('logs')][strtolower('view created by me')]) && $this->user_role_access[strtolower('logs')][strtolower('view created by me')] == 1)
					{
						$where_str = $where_str.'(LOG.created_by = '. $this->user_id.')';					
					}
					else
					{
						$where_str = $where_str.'(LOG.created_by = 0 )';		
					}
					if($this->user_account_type == OWNER)
					{
					$where_str = $where_str." || (LOG.show_owner = 'Yes')";
					}
					else if($this->user_account_type == SUBCONTRACTOR)
					{
					$where_str = $where_str." || (LOG.show_subs = 'Yes')";
					}
					$where_str = $where_str.')';
				}
				
				//echo '<pre>';print_r($where_str);exit;
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
					// Get formatted sort name
					$format_sort_name = $this->Mod_log->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'LOG.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
				}
				else
				{
					$order_by_where = 'LOG.modified_on DESC';
				}
				$date_array = array('LOG.log_date'=>'log_date');
				// Fetch argument building
				$log_notes_select_field = 'SUBSTRING(LOG.log_notes,1,75) as log_notes';
                if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
                {
                    $log_notes_select_field = 'log_notes';
                }
                // Fetch argument building
                $log_args = array('select_fields' => array('LOG.ub_daily_log_id','LOG.private','LOG.show_subs','LOG.show_owner',
                'CONCAT_WS(" ",USER.first_name,USER.middle_name,USER.last_name) as full_name',
                'LOG.project_id', 'LOG.log_date', 'LOG.created_by',$log_notes_select_field, 'PROJECT.project_name','CHAR_LENGTH(LOG.log_notes) as length','CONCAT_WS(" , ",LOG.private,LOG.show_subs,LOG.show_owner) as viewable_by','USER.builder_id','LOG.photo,'
                 .$this->Mod_user->format_user_datetime($date_array,"date")),
                'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					//Only for export
					unset($log_args['pagination']);
				}
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$result_data = $this->Mod_log->get_logs($log_args);
				// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('log_date','full_name','project_name','log_notes','viewable_by');
					
					// Export file header column 
					$export_array['header'][0] = array('Log Date','Added By','Project Name','Log Notes','Viewable By(Private, Subs, Owners)'); 
					
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
					echo array_to_export($export_array,'uni_Loglist.xls','csv');exit;
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
					$total_count_array = $this->Mod_log->get_logs(array(
												'select_fields' => array('COUNT(LOG.ub_daily_log_id) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_log->response($result_data);
			}
			else
			{
				$this->Mod_log->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_log->response($result);
		}
	}

	/** 
	* Delete logs
	* 
	* @method: delete_log 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: bgxf19ncy9kZWxldgxf1Vfbgxf19nLw--
	*/
	public function delete_log()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_log->delete_log($result['data']);
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
		$this->Mod_log->response($response);
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
				$result = $this->Mod_log->destroy_session($result['data']);
			}
			$this->Mod_log->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	

}