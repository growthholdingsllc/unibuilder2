<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Photos extends UNI_Controller {
	/** 
	 * Photos Class
	 * 
	 * @package: Photos
	 * @subpackage: Photos
	 * @category: Public
	 * @author: Devansh 
	*/
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_general_value','Mod_notification','Mod_timezone','Mod_user','Mod_doc'));
		$this->load->helper(array('url','directory'));
    }
    /** 
	* Get all elements in Photos
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @createdby: Devansh 
	*/
	public function index($folder_id = 0, $project_id = 0)
	{
		//$this->session->unset_userdata($this->account_session[$this->user_session['account_type']][strtoupper($this->module)]['BREADCRUM']);
		$photo_folder_id = $folder_id;
		$get_folder_id = array(
                                    'select_fields' => array('ub_doc_folder_id'),
                                    'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
                                    						 'sys_folder_name' => 'photos'
                                    						))
                                    );
			//echo "<pre>";print_r($get_folder_id);exit;
			$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);

		if ($folder_id == 0)
		{
			if (isset($all_folder['aaData']) && !empty($all_folder)) 
			{
				$folder_id = $all_folder['aaData']['0']['ub_doc_folder_id'];
			}
			
		}
		if ($all_folder['aaData']['0']['ub_doc_folder_id'] === $photo_folder_id) {
			$photo_folder_id = 0;
		}
		$data = array(
		'title'        => "PHOTOS",		
		'content'      => 'content/photos/photos',
        'page_id'      => 'photos',
		'data_table'   => 'data_table',
		'photos_list'  => 'photos_list',      
		'date_all'	   => 'date_all', 
		'folder_id'	   => $folder_id,
		'project_id'	   => $project_id,
		'builder_id'   => $this->user_session['builder_id'],
		'photo_folder_id' =>  $photo_folder_id
		);

		// Block for breadcrum in Photos.

		$get_folder_id = array(
            'select_fields' => array('ub_doc_folder_id','ui_folder_name','project_id'),
            'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
            						 'ub_doc_folder_id' =>  $folder_id
            						))
                                );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);

		if (isset($all_folder['aaData']['0']['ub_doc_folder_id']) && !empty($all_folder['aaData']['0']['ub_doc_folder_id'])) 
		{
			$breadcrum_array[$all_folder['aaData']['0']['ub_doc_folder_id']] = trim($all_folder['aaData']['0']['ui_folder_name']).','.$all_folder['aaData']['0']['project_id'];

			$response_status= $this->uni_set_session('PHOTO_BREADCRUMB', $breadcrum_array);
		}
		$ub_breadcrum_array = array_filter($this->uni_session_get('PHOTO_BREADCRUMB'));

		if (count($ub_breadcrum_array) <= 1) 
		{
			$breadcrum_data_array = array_filter($this->uni_session_get('PHOTO_BREADCRUMB'));
			$_SESSION["photo_breadcrumb"] = $breadcrum_data_array;
		}
		else
		{
			$session_breadcrum_array = $_SESSION["photo_breadcrumb"];
			$breadcrum_data_array = $session_breadcrum_array + $breadcrum_array;
			//$response_status = $this->Mod_doc->destroy_session(array('module_name' => 'DOCS', 'destroy_type'=>array('BREADCRUM')));
			//echo "<pre>Temp Session---";	print_r($breadcrum_data_array);
		}

		foreach ($breadcrum_data_array as $key => $value) 
		{
			if ($key <= $folder_id) 
			{
				$breadcrum_data[$key] = $value;
			}
			else
			{
				unset($key);
			}
		}
		$_SESSION["photo_breadcrumb"] = $breadcrum_data;

		//echo "<pre>"; print_r($ub_breadcrum_array); print_r($_SESSION["photo_breadcrum"]); 

		foreach ($breadcrum_data as $key => $value) 
			{
				$val = explode(',', $value);
				$breadcrum_link = $this->crypt->encrypt('photos/index/'.$key.'/'.$val[1]);
				$breadcrum_value[] = array('link'=>$breadcrum_link, 'name'=>$val[0]);
				
			}

		$data['breadcrum_value'] = $breadcrum_value;

		// Breadcrum ends here.

		$dir_response = $this->Mod_doc->create_default_dir();
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
			$data['temprory_dir_id'] = '1';
		}

		//subcontractor list
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.account_type =' => SUBCONTRACTOR);
		$lead_sales_person_array = $this->Mod_user->get_users(array(
												'select_fields' => array('company AS first_name','USER.ub_user_id'),
												'where_clause' => $post_array,
												'join'=> array('sub_contractor'=>'Yes')
												));
        $data['subcontractor']=array();
        if(TRUE === $lead_sales_person_array['status'])
		{
			$data['subcontractor'] = $this->Mod_doc->build_ci_dropdown_array($lead_sales_person_array['aaData'],'ub_user_id', 'first_name');
		}

		$this->template->view($data);
	}

	/**
	*
	* Function will return the file and folder list for docs and Photos from BD   
	*
	* @method: get_folder_details
	* @access: public 
	* @return: array
	* @URL: cgxf1hvdgxf19zL2dldF9mb2xkZXJfZgxf1V0YWlscy8-
	*
	* ### get_folder_details() - Stored procedure input parameter order and count###
	* 1. builderid (int) 
	* 2. folderid (int)
	* 3. module (VARCHAR)
	*/   
	public function get_folder_details()
	{
		if(!empty($this->input->post()))
		{
			$data = array();
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);exit;
			if ($this->user_account_type == BUILDERADMIN) 
			{
				$module_data = array(	'builder_id' =>  $this->user_session['builder_id'],
										'folderid' => $result['data']['folderid'],
										'module' => $result['data']['module'],
										'dateformat' => $this->user_session['date_format'],
										'timezone' => $this->user_session['time_zone']
									);
				$result_array = $this->Mod_doc->get_folder_details($module_data);
				//echo "<pre>";print_r($result_array);exit;
			}
			else
			{
				if ($this->user_account_type == SUBCONTRACTOR) 
				{
					$get_folder_id = array(
                                    'select_fields' => array('ub_doc_folder_id'),
                                    'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
                                    						 'sys_folder_name' => 'photos'
                                    						))
                                    );
					$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
					//print_r($result);exit;
					if ($all_folder['aaData']['0']['ub_doc_folder_id'] < $result['data']['folderid']) 
					{
						$module_data = array(	'builder_id' =>  $this->user_session['builder_id'],
											'userid' => $this->user_session['ub_user_id'],
											'folderid' => $result['data']['folderid'],
											'flag' => 0,
											'dateformat' => $this->user_session['date_format'],
											'timezone' => $this->user_session['time_zone']
										);
						$result_array = $this->Mod_doc->get_sub_files($module_data);
					}
					else
					{
						$where_str = 'PROJECT.builder_id = '.$this->builder_id.' AND (PROJECT.created_by = '.$this->user_id.' || PROJECT.owner_id = '.$this->user_id.' || PROJECT.project_managers = '.$this->user_id.' || FIND_IN_SET('.$this->user_id.', PROJECT.project_assigned_users))';
						$project_list = $this->Mod_project->get_projects(array(
									'select_fields' => array('PROJECT.ub_project_id'),
									'where_clause' => $where_str,
									'group_clause' => array("PROJECT.ub_project_id") 
									));
						
						$project_list = $project_list['aaData'];
						$project_count = count($project_list);
						for ($i=0; $i < $project_count ; $i++) 
						{ 
							$projectid[]= $project_list[$i]['ub_project_id'];
						}
						$project_ids = implode(',', $projectid);
						//echo $project_ids;exit;
						$module_data = array(	'builder_id' =>  $this->user_session['builder_id'],
											'projectid' => $project_ids,
											'userid' => $this->user_session['ub_user_id'],
											'flag' => 1,
											'dateformat' => $this->user_session['date_format'],
											'timezone' => $this->user_session['time_zone']
										);
						$result_array = $this->Mod_doc->get_sub_folder_details($module_data);
						
					}
					//print_r($result_array);exit;
				}
				else
				{
					if ($this->user_account_type == OWNER) 
					{
						$get_folder_id = array(
                                    'select_fields' => array('ub_doc_folder_id'),
                                    'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
                                    						 'sys_folder_name' => 'photos'
                                    						))
                                    );
						$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
						//print_r($result);exit;
						if ($all_folder['aaData']['0']['ub_doc_folder_id'] < $result['data']['folderid']) 
						{
							$module_data = array(	'builder_id' =>  $this->user_session['builder_id'],
											'folderid' => $result['data']['folderid'],
											'flag' => 1,
											'dateformat' => $this->user_session['date_format'],
											'timezone' => $this->user_session['time_zone']
										);
							$result_array = $this->Mod_doc->get_sub_files($module_data);
						}
						else
						{
							//echo $project_ids;exit;
							$module_data = array(	'builder_id' =>  $this->user_session['builder_id'],
												'projectid' => $this->project_id,
												'flag' => 1,
												'dateformat' => $this->user_session['date_format'],
												'timezone' => $this->user_session['time_zone']
											);
							$result_array = $this->Mod_doc->get_owner_folder_details($module_data);
						}
					}
				}
			}
			$data = array();
			$count = count($result_array);
			for ($i=0; $i < $count ; $i++) 
			{ 
				if ($result_array[$i]['file_type'] === "folder") 
				{  
					$data[] = array('folder_id' => $result_array[$i]['folder_id'],
									'project_id'=> $result_array[$i]['project_id'],
									'Name' 		=> $result_array[$i]['folder_name'],
									"sub_access"=> $result_array[$i]['sub_access'],
									"owner_access"=> $result_array[$i]['owner_access'],               
									"Photos" => $result_array[$i]['file_count'],
									'size' => "177kb",	  
									'LastUpdated' => $result_array[$i]['last_modified_on'],
									'file_type' => $result_array[$i]['file_type']
								);
				}
				else
				{
					$exp = explode('/', $result_array[$i]['path']);
					$data[] = array('folder_id' => $result_array[$i]['folder_id'],
									'Name' => array(array(
															"albumname" => $result_array[$i]['folder_name'],
															"albumimg" => "list_default_thumb/img.png",
															'path' => $result_array[$i]['path'],
															"sub_access"=> $result_array[$i]['sub_access'],
															"owner_access"=> $result_array[$i]['owner_access'],
															'sys_file_name' => $exp[count($exp)-1]
														)),
									'size' => "177kb",	
									'Photos'=>"-",  
									'LastUpdated' => $result_array[$i]['last_modified_on']
								);
				}
			}
			//echo "<pre>";print_r($data);exit;
			$resposne['data'] = $data;
		 	$this->Mod_doc->response($resposne);

			//echo "<pre>";print_r($data);
			//echo "<pre>";print_r($result_array);
		}
		else
		{
			echo "the post array is empty. Please select some files to upload.";
		}
	}
	/**
	*
	* Function to create the level-2 to level-n directory structure  
	*
	* @method: create_new_dir
	* @access: public 
	* @return: array
	* @URL: Zgxf19jL2NyZWF0ZV9uZXdfZgxf1lyLw--
	*
	* #Flag = 1 is when a new project is created.
	* #Flag = 0 is when any other folder is created (Docs & Photos).
	* #callfrom is to identify if the call is from another proc or from php code.
	*
	* ### create_new_builder_folder() - Stored procedure input parameter order and count###
	* 1. builderid (int) 
	* 2. projectid (int)
	* 3. projectname (VARCHAR)
	* 4. foldername (VARCHAR)
	* 5. parentfolderid (int)
	* 6. flag (int)
	* 7. createdby (int)
	* 8. callfrom (VARCHAR)
	* 9. returnfolderid (int)
	*/   
	public function create_new_dir()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);exit();
			if(TRUE === $result['status'])
			{
				$builder_data = array('builder_id' => $this->user_session['builder_id'], 
									  'user_id'	=> $this->user_session['ub_user_id'],
									  'project_id' => $result['data']['project_id'],
									  'project_name' => '',
									  'folder_name' => $result['data']['album_name'],
									  'parent_folder_id' => $result['data']['folderid'],
									  'flag' => 0,
									  'call_from' => 'PHP',
									);
				$result_array = $this->Mod_doc->create_new_folder($builder_data);

				foreach ($result_array as $dir) 
				{
				    foreach ($dir as $folderpath) 
				    {
				       $response = $this->Mod_doc->create_dir(DOC_PATH.$folderpath);
				    }
				}
				$this->Mod_doc->response($response);
			}
		}
		else
		{
			echo "Please enter the directory name";
		}
	}

	/**
	*
	* Function to soft delete the folder in the DB. 
	*
	* @method: delete_folder
	* @access: public 
	* @return: array
	* @URL: Zgxf19jcy9kZWxldgxf1VfZm9sZgxf1VyLw--
	*
	*
	* ### delete_folder() - Stored procedure input parameter order and count###
	* 1. builderid (int)
	* 2. folderid (int)
	* 3. deletedby (int)
	*
	*
	*/   
	public function delete_folder()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);exit();
			if(TRUE === $result['status'])
			{
				$folder_data = array(	 
									  'folderid' => $result['data']['folderid'],
									  'builderid' => $this->user_session['builder_id'],
									  'deletedby' => $this->user_session['ub_user_id']
									);
					$result_array = $this->Mod_doc->delete_folder($folder_data);
			}
		}
	 	$this->Mod_doc->response($result_array);
	}	

		/**
	*
	* Function to update the view access permission. 
	*
	* @method: update_folder
	* @access: public 
	* @return: array
	* @URL: 
	*
	*
	* ### update_folder() - Stored procedure input parameter order and count###
	* 1. folderid (int)
	* 2. owneraccess (VARCHAR)
	* 3. subaccess (VARCHAR)
	*
	*
	*/   
	public function update_folder()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);exit();
			if(TRUE === $result['status'])
			{
				if (empty($result['data']['owner'])) 
				{
					$result['data']['owner'] = 'No';
				}
				if (empty($result['data']['sub'])) 
				{
					$result['data']['sub'] = 'No';
				}
				if (isset($result['data']['folderid']) && $result['data']['folderid'] > 0 && !empty($result['data']['folderid'])) 
				{
					$folder_data = array(	 
									  'flag' => 0,
									  'folderid' => $result['data']['folderid'],
									  'folder_name' => $result['data']['folder_name'],
									  'owneraccess' => $result['data']['owner'],
									  'subaccess' => $result['data']['sub'],
									  'modifiedby' => $this->user_session['ub_user_id']
									);
					//echo "<pre>";print_r($folder_data);exit();
					$result_array = $this->Mod_doc->update_folder($folder_data);
				}
				else
				{
					$allowed_users_ids = implode(',', $result['data']['allowed_users']);
					$file_data = array(	 
									  'fileid' => $result['data']['fileid'],
									  'allowedusers' => $allowed_users_ids,
									  'owneraccess' => $result['data']['owner'],
									  'subaccess' => $result['data']['sub'],
									  'modifiedby' => $this->user_session['ub_user_id']
									);
					//echo "<pre>";print_r($file_data);exit();
					$result_array = $this->Mod_doc->update_file($file_data);

					$get_folder_id = array(
                                    'select_fields' => array('FILE.doc_folder_id'),
                                    'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
                                    						 'doc_folder_id' => $result['data']['folder_id'],
                                    						 'sub_access' => 'Yes'
                                    						))
                                    );
					$sub_access_folder = $this->Mod_doc->get_file_details($get_folder_id);
					if (isset($sub_access_folder['aaData']) && !empty($sub_access_folder['aaData'])) 
					{
						$count_sub_access = count($sub_access_folder['aaData']);
					}
					else
					{
						$count_sub_access = 0;
					}
				
					$get_folder_id = array(
                                    'select_fields' => array('FILE.doc_folder_id'),
                                    'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
                                    						 'doc_folder_id' => $result['data']['folder_id'],
                                    						 'owner_access' => 'Yes'
                                    						))
                                    );
					$owner_access_folder = $this->Mod_doc->get_file_details($get_folder_id);
					if (isset($owner_access_folder['aaData']) && !empty($owner_access_folder['aaData'])) 
					{
						$count_owner_access = count($owner_access_folder['aaData']);
					}
					else
					{
						$count_owner_access = 0;
					}

					//echo $count_sub_access ."---".$count_owner_access; exit;
					if ($count_sub_access > 0 && $count_owner_access > 0) 
					{
						$folder_data = array(	 
									  'flag' => 1,
									  'folderid' => $result['data']['folder_id'],
									  'folder_name' => '',
									  'owneraccess' => 'Yes',
									  'subaccess' => 'Yes',
									  'modifiedby' => $this->user_session['ub_user_id']
									);
						//echo "<pre>";print_r($folder_data);exit();
						$folder_result_array = $this->Mod_doc->update_folder($folder_data);
					}
					else
					{
						if ($count_sub_access == 0 && $count_owner_access > 0) 
						{
							$folder_data = array(	 
										  'flag' => 1,
										  'folderid' => $result['data']['folder_id'],
									  	  'folder_name' => '',
										  'owneraccess' => 'Yes',
										  'subaccess' => 'No',
										  'modifiedby' => $this->user_session['ub_user_id']
										);
							//echo "<pre>";print_r($folder_data);exit();
							$folder_result_array = $this->Mod_doc->update_folder($folder_data);
						}
						else
						{
							if ($count_sub_access > 0 && $count_owner_access == 0) 
							{
								$folder_data = array(	 
											  'flag' => 1,
											  'folderid' => $result['data']['folder_id'],
											  'folder_name' => '',
											  'owneraccess' => 'No',
											  'subaccess' => 'Yes',
											  'modifiedby' => $this->user_session['ub_user_id']
											);
								//echo "<pre>";print_r($folder_data);exit();
								$folder_result_array = $this->Mod_doc->update_folder($folder_data);
							} 
							else {
								if ($count_sub_access == 0 && $count_owner_access == 0) 
								{
									$folder_data = array(	 
												  'flag' => 1,
												  'folderid' => $result['data']['folder_id'],
												  'folder_name' => '',
												  'owneraccess' => 'No',
												  'subaccess' => 'No',
												  'modifiedby' => $this->user_session['ub_user_id']
												);
									//echo "<pre>";print_r($folder_data);exit();
									$folder_result_array = $this->Mod_doc->update_folder($folder_data);
								} 
								else {
									//echo "unable to update the folder permission";
								}
							}
						}
					}	
				}
				
			}
		}
	 	$this->Mod_doc->response($result_array['0']);
	}
	/**
	*
	* Function to get the directory path.  
	*
	* @method: update_folder
	* @access: public 
	* @return: array
	* @URL: 
	*
	*
	* ### get_folder_path() - Stored procedure input parameter order and count###
	* 1. folderid (int)
	* 2. builderid (int)
	*
	*
	*/   
	public function get_folder_path($folderid = 0)
	{
		//echo $folderid;exit;
		if(!empty($folderid) && $folderid > 0)
		{
			
				$folder_data = array(	 
									  'folderid' => $folderid,
									  'builder_id' => $this->user_session['builder_id'],
									);
				//echo "<pre>";print_r($folder_data);exit();
				$result_array = $this->Mod_doc->get_folder_path($folder_data);
				$exp = explode('/', DOC_PATH.$result_array['0']['folderpath']);
				$system_file_name = $exp[count($exp)-2];
				//echo "<pre>";print_r($result_array);exit();
				
				$this->load->library('zip'); 
			    $path = DOC_PATH.$result_array['0']['folderpath']; 
			    //$time = time();
			    $this->zip->read_dir($path, FALSE);  
			    $this->zip->download($system_file_name);   
		}
		else
		{
			echo "jhiiiii";
		}
	}
	/**
	*
	* Function to get the parent id.  
	*
	* @method: back_to_folder
	* @access: public 
	* @return: array
	* @URL: 
	*
	*/   
	public function back_to_folder()
	{
		//echo $folderid;exit;
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			if(TRUE === $result['status'])
			{

				$get_folder_detail = array('select_fields' => array('lft','rgt'),
                               'where_clause' => (array('ub_doc_folder_id' =>  $result['data']['folderid']))
                               );
				$folder_detail = $this->Mod_doc->get_folder_id($get_folder_detail);
				$parent_folder_detail = $this->Mod_doc->get_parent_folder_id($folder_detail['aaData'][0]);
			}
		}
	 	$this->Mod_doc->response($parent_folder_detail);
	}
	/* Below code was added by chandru 08-10-2015 */
	public function allowed_extension_photoes()
	{
		if(!empty($this->input->post()))
		{	
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$extension = $result['data']['ext'];
				$arrayName = explode(',', ALLOWED_EXTENSION_FOR_PHOTOES);
				$result = array_search($extension, $arrayName);
				if (isset($result) && !empty($result)) {
					$response['status'] = TRUE;
				} 
				else 
				{
					$response['status'] = FALSE;
				}
			} 
			else 
			{
				$response['status'] = FALSE;;
			}
		} 
		else 
		{
			$response['status'] = FALSE;
		}
		return $this->Mod_project->response($response);
	}
}