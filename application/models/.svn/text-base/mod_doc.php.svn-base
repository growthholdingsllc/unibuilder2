<?php
/** 
 * Doc Model
 * 
 * @package: Doc Model
 * @subpackage: Doc Model
 * @category: Doc
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 21-04-2015
*/
require(APPPATH.'libraries/UploadHandler.php');
class Mod_doc extends UNI_Model
{
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper(array('file'));
    }
	/** 
	* Move files to temp
	*
	* @method: move_files_to_temp_location
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function move_files_to_temp_location($input_ary)
	{
		//print_r($input_ary);exit;
		// exiy session id
		$session_id = $this->session->userdata('session_id');
		// Create directory if not exists
		$path = DOC_TEMP_PATH.$session_id.'/';
		$dir_response = $this->create_dir($path);
		if(TRUE === $dir_response['status'])
		{
			// Get the latest directory name
			if(isset($input_ary['temp_directory_id']) && $input_ary['temp_directory_id'] > 0)
			{
				// User temporary directory id
				$new_dir = $input_ary['temp_directory_id'];
			}
			else
			{
				// Create directory
				$newest_dir_name = $this->get_newest_dir($path);
				if(FALSE != $newest_dir_name)
				{
					$new_dir = (int) $newest_dir_name + 1;
				}
				else
				{
					// No directory exists
					$new_dir = 1;
				}
				$dir_response = $this->create_dir($path.$new_dir);
			}
			$override_options = array('upload_dir' => $path.$new_dir.'/', 'dir_name' => $new_dir, 'session_id' => $session_id );
			$upload_handler = new UploadHandler(null, true, null, $override_options);
		}
		else
		{
			echo '<pre>';print_r($dir_response);
		
		}
	}
	/** 
	* Get newest directory
	*
	* @method: get_newest_dir
	* @access: public 
	* @param: path
	* @return: array
	*/
	public function get_newest_dir($path) 
	{
		if(file_exists($path))
		{
			$working_dir = getcwd();
			chdir($path); ## chdir to requested dir
			$ret_val = FALSE;
			if ($p = opendir($path) ) 
			{
				while (FALSE !== ($file = readdir($p))) 
				{
					if ($file{0} != '.' && is_dir($file)) 
					{
						// $list[] = date('YmdHis', filemtime($path.'/'.$file)).$path.'/'.$file;
						$list[] = $file;
					}
				}
				if(!empty($list))
				{
					// rsort($list, SORT_STRING|SORT_FLAG_CASE|SORT_NATURAL);
					// $explode_file_path = explode('/', $list[0]);
					// $ret_val = $explode_file_path[count($explode_file_path)-1];
					rsort($list,  SORT_NUMERIC);
					$explode_file_path = explode('/', $list[0]);
					$ret_val = $explode_file_path[count($explode_file_path)-1];
				}
				else
				{
					return $ret_val;
				}
			}
			chdir($working_dir); ## chdir back to script's dir
		}
		else
		{
			return FALSE;
		}
		return $ret_val;
	}
	/** 
	* Create Directory
	*
	* @method: create_dir
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function create_dir($dir_path)
	{
		if(!file_exists($dir_path))
		{
			umask(0);
			if(@mkdir($dir_path,DIR_WRITE_MODE,TRUE))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Directory created successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Directory creation failed';
			}
		}
		else
		{
			$data['status'] = TRUE;
			$data['message'] = 'Directory already exists';
		}
		return $data;
	}
	
    /**
	*
	* Function to create builder default  directory 
	*
	* @method: create_builder_folder
	* @access: public 
	* @param: post data
	* @return: the directory URL
	*/   
	public function create_builder_folder($post_array = array())
	{
   		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->user_id = (isset($post_array['user_id'])) ? $post_array['user_id'] : $this->user_id;
			//$this->project_id = (isset($post_array['project_id'])) ? $post_array['project_id'] : $this->project_id;
			if($this->builder_id > 0 && $this->user_id > 0)
			{
				/*
				### create_new_builder_folder() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. buildername (varchar)
				3. createdby (int)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['buildername'] = $post_array['builder_name'];
				$SP_input_param_array['createdby'] = $this->user_id;
				//echo '<pre>';print_r($SP_input_param_array);exit();
				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL create_new_builder_folder(?,?,?)";
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $res->result_array();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
    /**
	*
	* Function to create the level-2 to level-n dir structure  
	*
	* @method: create_new_folder
	* @access: public 
	* @param: post data
	* @return: the directory URL
	*/   
	public function create_new_folder($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->user_id = (isset($post_array['user_id'])) ? $post_array['user_id'] : $this->user_id;
			//$this->project_id = (isset($post_array['project_id'])) ? $post_array['project_id'] : $this->project_id;
			if($this->builder_id > 0 && $this->user_id > 0)
			{
				/*
				### create_new_builder_folder() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. projectid (int)
				3. projectname (VARCHAR)
				4. foldername (VARCHAR)
				5. parentfolderid (int)
				6. flag (int)
				7. createdby (int)
				8. callfrom (VARCHAR)
				9. returnfolderid (int)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = $post_array['project_id'];
				$SP_input_param_array['projectname'] = $post_array['project_name'];
				$SP_input_param_array['foldername'] = $post_array['folder_name'];
				$SP_input_param_array['parentfolderid'] = $post_array['parent_folder_id'];
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['createdby'] = $this->user_id;
				$SP_input_param_array['callfrom'] = $post_array['call_from'];

				//echo '<pre>';print_r($SP_input_param_array);exit();

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL create_new_folder(?,?,?,?,?,?,?,?,@response);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				//echo "<pre>";print_r($success->result_array());exit();
				$result = $success->result_array();

				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
    /**
	*
	* Function to update the files in the DB  
	*
	* @method: create_new_folder
	* @access: public 
	* @param: post data
	* @return: 
	* #flag = 1 for upload from docs menu
	* #flag = 0 for upload from other project specific modules like 'mom','log','task','bid','budget','message','schedule','selection','checklist','warranty'. In this case the folderid will also be 0.
	* #flag = 2 for upload from non project specific modules like lead, user, setup.
	*
	*/   
	public function insert_file($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->user_id = (isset($post_array['user_id'])) ? $post_array['user_id'] : $this->user_id;
			//$this->project_id = (isset($post_array['project_id'])) ? $post_array['project_id'] : $this->project_id;
			if($this->builder_id > 0 && $this->user_id > 0)
			{
				/*
				### insert_file() - Stored procedure input parameter order and count###
				1. flag (int) 
				2. builderid (int)
				3. projectid (VARCHAR)
				4. folderid (VARCHAR)
				5. filename (int)
				6. createdby (int)
				7. modulename (int)
				8. moduleid (VARCHAR)
				*/
				if($post_array['modulename'] == 'subcontractor')
				{
					$post_array['modulename'] = 'user';
				}
				/*if($post_array['moduleid'] == 'moduleid')
				{
					$this->user_id = $post_array['moduleid'];
				}*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = $post_array['projectid'];
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['filename'] = $post_array['filename'];
				$SP_input_param_array['createdby'] = $this->user_id;
				$SP_input_param_array['modulename'] = $post_array['modulename'];
				$SP_input_param_array['moduleid'] = $post_array['moduleid'];

				//echo '<pre>';print_r($SP_input_param_array);exit();

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL insert_file(?,?,?,?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				//print_r($success);exit;
				$result = $success->result_array();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }

     /**
	*
	* Function to get the file and folder list for docs and Photos from BD  
	*
	* @method: get_folder_details
	* @access: public 
	* @param: post data
	* @return: 
	*
	* #module parameter should contain either docs or photos
	*
	*/   
	public function get_folder_details($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;

			if($this->builder_id > 0)
			{
				/*
				### get_folder_details() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. folderid (int)
				3. module (VARCHAR)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['module'] = $post_array['module'];
				$SP_input_param_array['dateformat'] = $post_array['dateformat'];
				$SP_input_param_array['timezone'] = $post_array['timezone'];

				//echo '<pre>';print_r($SP_input_param_array);

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL get_folder_details(?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }

 	/**
	*
	* Function to get the file and folder list for docs and Photos from BD  
	*
	* @method: get_owner_folder_details
	* @access: public 
	* @param: post data
	* @return: 
	*
	* #module parameter should contain either docs or photos
	*
	*/   
	public function get_owner_folder_details($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;

			if($this->builder_id > 0)
			{
				/*
				### get_folder_details() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. projectid (int)
				3. flag (VARCHAR)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = $post_array['projectid'];
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['dateformat'] = $post_array['dateformat'];
				$SP_input_param_array['timezone'] = $post_array['timezone'];

				//echo '<pre>';print_r($SP_input_param_array);

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL get_owner_folder_details(?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid owner / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }

	/**
	*
	* Function to get the file and folder list for docs and Photos from BD  
	*
	* @method: get_sub_folder_details
	* @access: public 
	* @param: post data
	* @return: 
	*
	* #module parameter should contain either docs or photos
	*
	*/   
	public function get_sub_folder_details($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;

			if($this->builder_id > 0)
			{
				/*
				### get_folder_details() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. projectid (int)
				3. flag (VARCHAR)
				#flag = 0 for docs
				#flag = 1 for photos
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = $post_array['projectid'];
				$SP_input_param_array['userid'] = $post_array['userid'];
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['dateformat'] = $post_array['dateformat'];
				$SP_input_param_array['timezone'] = $post_array['timezone'];

				//echo '<pre>';print_r($SP_input_param_array);

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL get_sub_folder_details(?,?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				//echo $this->write_db->last_query();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid sub contractor / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
	/**
	*
	* Function to get the file and folder list for docs and Photos from BD  
	*
	* @method: get_sub_folder_details
	* @access: public 
	* @param: post data
	* @return: 
	*
	* #module parameter should contain either docs or photos
	*
	*/   
	public function get_sub_files($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;

			if($this->builder_id > 0)
			{
				/*
				### get_folder_details() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. projectid (int)
				3. flag (VARCHAR)
				#flag = 0 is for sub access
				#flag = 1 is for owner access
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['userid'] = $post_array['userid'];
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['dateformat'] = $post_array['dateformat'];
				$SP_input_param_array['timezone'] = $post_array['timezone'];

				//echo '<pre>';print_r($SP_input_param_array);

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL get_sub_files(?,?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				//echo $this->write_db->last_query();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid sub contractor / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }

    /** 
	* Get folder id
	* @method: get_leads
	* @access: public 
	* @param: args
	* @return: array
	*/
    public function get_folder_id($args = array())
    {
    	$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_DOC_FOLDER.' AS FOLDER');	//UB_LEAD is the table name defined in constant file
		
		// Join Tables
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
				$this->read_db->join(UB_USER.' AS USER','LEAD.sales_person = USER.ub_user_id','left');//UB_BUILDER is the table name defined in constant file
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		$res = $this->read_db->get();
		//echo $this->read_db->last_query();exit;	
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		return $data;
    }

	/** 
	* Get folder id
	* @method: get_leads
	* @access: public 
	* @param: args
	* @return: array
	*/
    public function get_file_details($args = array())
    {
    	$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_DOC_FILE.' AS FILE');	//UB_LEAD is the table name defined in constant file
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		$res = $this->read_db->get();
		//echo $this->read_db->last_query();exit;	
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		return $data;
    }

    /** 
	* Get folder id
	* @method: get_leads
	* @access: public 
	* @param: args
	* @return: array
	*
	* #flag = 0 - Pass folderid and get files
	* #flag = 1 - project related files
	* #flag = 2 - Non project related files
	*/
    public function get_files_for_folder($post_array = array())
    {
    	if( ! empty($post_array))
		{
			//echo '<pre>';print_r($post_array);exit;
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;

			if($this->builder_id > 0)
			{
				/*
				### get_files_for_folder() - Stored procedure input parameter order and count###
				1. flag (int) 
				2. builderid (int)
				3. projectid (VARCHAR)
				4. folderid (VARCHAR)
				5. modulename (VARCHAR)
				6. moduleid (VARCHAR)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = $post_array['projectid'];
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['modulename'] = $post_array['modulename'];
				$SP_input_param_array['moduleid'] = $post_array['moduleid'];
				$SP_input_param_array['dateformat'] = $this->user_session['date_format'];
				$SP_input_param_array['timezone'] = $this->user_session['time_zone'];

				//echo '<pre>';print_r($SP_input_param_array);exit;

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL get_files_for_folder(?,?,?,?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				$result['status'] = TRUE;
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }

    /**
    * Create Default Directory
	* @method: create_default_dir
	* @access: public 
	* @param: args
	* @return: The temprory directory id
	*
	*
    */
    public function create_default_dir($directory_id = 0)
    {
    	//echo "hiiii";exit;
		$session_id = $this->session->userdata('session_id');
		//$this->user_session = $this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['USER'];
		
		$path = DOC_TEMP_PATH.$session_id;
		//$dir_response = $this->create_dir($path);
		//echo $path;exit;
		$newest_dir_name = $this->get_newest_dir($path);
		//echo "<pre>";print_r($newest_dir_name);exit;
		if(FALSE != $newest_dir_name)
		{
			$directory_id = (int) $newest_dir_name + 1;
		}
		else
		{
			// No directory exists
			$directory_id = 1;
		}
		
		// Create directory if not exists
		//$dir_response = $this->create_dir($path.'/'.$directory_id);

		// Create thumbnail inside temp
		$dir_response = $this->create_dir($path.'/'.$directory_id.'/thumbnail');

		$dir_response['temp_directory_id'] = $directory_id;
		$dir_response['thumbnail_path'] = $directory_id.'/thumbnail';
		return $dir_response;
    }
    /**
    * function to get the directory hirercy created by user 
    *
	* @method: get_doc_hierarchy
	* @access: public 
	* @param: args
	* @return: the directory hirercy 
	*
	*
    */
    public function get_doc_hierarchy($post_array = array())
    {
    	if( ! empty($post_array))
		{
			//echo '<pre>';print_r($post_array);exit;
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;

			if($this->builder_id > 0)
			{
				/*
				### get_doc_hierarchy() - Stored procedure input parameter order and count### 
				1. builderid (int)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;

				//echo '<pre>';print_r($SP_input_param_array);exit;

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL get_doc_hierarchy(?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
	}
	/**
	*
	* Function to soft delete the files in the DB  
	*
	* @method: delete_file
	* @access: public 
	* @param: post data
	* @return: 
	* 
	* #flag = 0 - Delete all files in a folder hierarchy
	* #flag = 1 - Delete a single file
	* #flag = 2 - Delete all files in a folder
	*
	*/   
	public function delete_file($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->user_id = (isset($post_array['user_id'])) ? $post_array['user_id'] : $this->user_id;
			//$this->project_id = (isset($post_array['project_id'])) ? $post_array['project_id'] : $this->project_id;
			if($this->builder_id > 0 && $this->user_id > 0)
			{
				/*
				### delete_file() - Stored procedure input parameter order and count###
				1. flag (int) 
				2. fileid (int)
				3. folderid (int)
				4. builderid (int)
				5. deletedby (int)
				6. resp (int)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['fileid'] = $post_array['fileid'];
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['deletedby'] = $this->user_id;

				//echo '<pre>';print_r($SP_input_param_array);exit();

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL delete_file(?,?,?,?,?,@response);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
    /**
	*
	* Function to soft delete the folder in the DB  
	*
	* @method: delete_folder
	* @access: public 
	* @param: post data
	* @return: 
	* 
	*
	*/   
	public function delete_folder($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->user_id = (isset($post_array['user_id'])) ? $post_array['user_id'] : $this->user_id;
			//$this->project_id = (isset($post_array['project_id'])) ? $post_array['project_id'] : $this->project_id;
			if($this->builder_id > 0 && $this->user_id > 0)
			{
				/*
				### delete_folder() - Stored procedure input parameter order and count###
				1. builderid (int)
				2. folderid (int)
				3. deletedby (int)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['deletedby'] = $this->user_id;

				//echo '<pre>';print_r($SP_input_param_array);exit();

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL delete_folder(?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				//print_r($result);exit;
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
    /**
	*
	* Function to update the view access permission.  
	*
	* @method: update_folder
	* @access: public 
	* @param: post data
	* @return: 
	* 
	*
	*/   
	public function update_folder($post_array = array())
	{
		if( ! empty($post_array))
		{
			if($post_array['folderid'] > 0)
			{
				/*
				 ### update_folder() - Stored procedure input parameter order and count###
				 1. folderid (int)
				 2. folder_name (VARCHAR)
				 3. owneraccess (VARCHAR)
				 4. subaccess (VARCHAR)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['flag'] = $post_array['flag'];
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['folder_name'] = $post_array['folder_name'];
				$SP_input_param_array['owneraccess'] = $post_array['owneraccess'];
				$SP_input_param_array['subaccess'] = $post_array['subaccess'];
				$SP_input_param_array['modifiedby'] = $post_array['modifiedby'];

				//echo '<pre>';print_r($SP_input_param_array);exit();

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL update_folder(?,?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				//print_r($result);exit;
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
    /**
	*
	* Function to update the view access permission.  
	*
	* @method: update_file
	* @access: public 
	* @param: post data
	* @return: 
	* 
	*
	*/   
	public function update_file($post_array = array())
	{
		if( ! empty($post_array))
		{
			if($post_array['fileid'] > 0)
			{
				/*
				 ### update_file() - Stored procedure input parameter order and count###
				 1. fileid (int)
				 2. owneraccess (VARCHAR)
				 3. subaccess (VARCHAR)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['fileid'] = $post_array['fileid'];
				$SP_input_param_array['allowedusers'] = $post_array['allowedusers'];
				$SP_input_param_array['owneraccess'] = $post_array['owneraccess'];
				$SP_input_param_array['subaccess'] = $post_array['subaccess'];
				$SP_input_param_array['modifiedby'] = $post_array['modifiedby'];

				//echo '<pre>';print_r($SP_input_param_array);exit();

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL update_file(?,?,?,?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				//print_r($result);exit;
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
    /**
	*
	* Function to get the directory path.  
	*
	* @method: get_folder_path
	* @access: public 
	* @param: post data
	* @return: 
	* 
	*
	*/   
	public function get_folder_path($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			if($this->builder_id > 0 && $post_array['folderid'] > 0)
			{
				/*
				 ### get_folder_path() - Stored procedure input parameter order and count###
				 1. folderid (int)
				 2. builderid (int)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['folderid'] = $post_array['folderid'];
				$SP_input_param_array['builderid'] = $this->builder_id;

				//echo '<pre>';print_r($SP_input_param_array);exit();

				$this->write_db->freeDBResource($this->write_db->conn_id);
				$stored_procedure = "CALL get_folder_path(?,?);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$result = $success->result_array();
				//print_r($result);exit;
				return $result;
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
    /**
	*
	* Function to get the directory path.  
	*
	* @method: get_folder_path
	* @access: public 
	* @param: post data
	* @return: 
	* 
	*
	*/   
	public function get_parent_folder_id($post_array = array())
	{
		if( ! empty($post_array))
		{
			//echo "<pre>";print_r($post_array);exit();
			$query = $this->db->query("SELECT * FROM ".UB_DOC_FOLDER." where builder_id=".$this->user_session['builder_id']." and is_delete='No' AND lft < ".$post_array['lft']." && rgt > ".$post_array['rgt']." order by ub_doc_folder_id desc limit 1");
			//echo $this->db->last_query();exit;
			$parent_folder_id = $query->row_array();
			//return $parent_folder_id;
			$data['parent_folder_id'] = $parent_folder_id['ub_doc_folder_id'];
			$data['parent_project_id'] = $parent_folder_id['project_id'];
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
}
/* End of file mod_doc.php */
/* Location: ./application/models/mod_doc.php */