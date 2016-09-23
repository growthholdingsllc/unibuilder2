<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Doc Class
 * 
 * @package: Doc
 * @subpackage: Doc
 * @category: Doc
 * @author: Gopakumar 
 * @createdon(DD-MM-YYYY): 16-04-2015 
*/
class Doc extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','directory'));	
		$this->load->model(array('Mod_role','Mod_doc'));		
    }
	/** 
	* Load index
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @URL: dgxf1Fzay9pbmRleC8- 
	*/
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/docs/doc',
        'page_id'      => 'doc',
		'data_table'   => 'data_table',
		'docs_list'	   => 'docs_list',      
		'date_all'	   => 'date_all'      
		);
		$this->load->view('common/common-template',$data);
	}
	/** 
	* upload
	* 
	* @method: upload 
	* @access: upload 
	* @param:  
	* @return: array 
	* @URL: Zgxf19jL3Vwbgxf19hZC8-
	*/
	public function upload()
	{
		//print_r($this->input->post());exit;
		if (!empty($this->input->post()) || !empty($_GET))
		{
			//echo "rtterte23";exit;
            // Sanitize input
            $result = $this->sanitize_input();
			if(TRUE == $result['status'])
			{
				$acceptedFormats = explode(',', ALLOWED_EXTENSION);
				if(isset($_FILES['files']['name']['0']) && (!in_array(pathinfo($_FILES['files']['name']['0'], PATHINFO_EXTENSION), $acceptedFormats))) {
				    echo 'error';
				}
				else
				{
					
					$this->Mod_doc->move_files_to_temp_location($result['data']);
				}
			}
			else
			{
				$result['status']  = FALSE;
				$result['message'] = 'Sanitize error';
			}
		}
		else
		{
			//echo "fgsdfgdfg76567567";exit;
			$session_id = $this->session->userdata('session_id');
			$abcd = 6;
			// Create directory if not exists
			$path = DOC_TEMP_PATH.$abcd.'/';
			$new_dir = 1;
			$override_options = array('upload_dir' => $path.$new_dir.'/', 'dir_name' => $new_dir, 'session_id' => $abcd );
			$upload_handler = new UploadHandler(null, true, null, $override_options);
            $result['status']  = FALSE;
            $result['message'] = 'Post array is empty';
		}
		// $this->Mod_doc->response($result);
	}
	/** 
	* upload index
	* 
	* @method: upload 
	* @access: upload 
	* @param:  
	* @return: array 
	* @URL: Zgxf19jL3Vwbgxf19hZF9kaXNwbgxf1F5Lw--
	*/
	public function upload_display()
	{
	
	/* // load Breadcrumbs
$this->load->library('breadcrumbs');

// add breadcrumbs
$this->breadcrumbs->push('Section', '/section');
  // $this->breadcrumbs->push('Section', site_url('section') );
$this->breadcrumbs->push('Page', '/section/page');
  // $this->breadcrumbs->push('Page', site_url('section/page') );

// unshift crumb
$this->breadcrumbs->unshift('Home', '/');
  // $this->breadcrumbs->unshift('Home', site_url('') );

// output
echo $this->breadcrumbs->show();
exit; */

		// require(APPPATH.'libraries/UploadHandler.php');
		// $upload_handler = new UploadHandler();
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/docs/upload',
        'page_id'      => 'doc',
		'data_table'   => 'data_table',
		'docs_list'	   => 'docs_list',      
		'date_all'	   => 'date_all'      
		);
		$this->template->view($data);
	}
	/** 
	* To create the default temp directory
	* 
	* @method: default_temp_dir 
	* @access: default_temp_dir 
	* @param:  
	* @return: array 
	* @URL: Zgxf19jL2RlZmF1bHRfdgxf1VtcF9kaXIv
	*/
	public function default_temp_dir()
	{
		//echo "hiiii";exit;
		$session_id = $this->session->userdata('session_id');
		//$this->user_session = $this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['USER'];
		if (isset($this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['DOC']['DIRECTIRY']['temp_directory_id']) && !empty($this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['DOC']['DIRECTIRY']['temp_directory_id'])) 
		{
			$directory_id = $this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['DOC']['DIRECTIRY']['temp_directory_id'];
		}
		else
		{
			$directory_id = 0;
		}
		
		$abc = 1;
		$dir_name = $directory_id + $abc;
		// Create directory if not exists
		$path = DOC_TEMP_PATH.$session_id.'/'.$dir_name.'/';
		$dir_response = $this->Mod_doc->create_dir($path);
		$dir_response['temp_directory_id'] = $dir_name;
		$this->uni_set_session('Directiry', $dir_response);
		$this->Mod_doc->response($dir_response);
	}

	/** 
	* To move the files from the temp directory to actual location
	* 
	* @method: move_uploaded_data 
	* @access: public 
	* @param:  
	* @return: array 
	* @URL: Zgxf19jL21vdmVfdXBsb2FkZWRfZgxf1F0YS8-
	*/
	public function move_uploaded_data()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			$session_id = $this->session->userdata('session_id');
			//print_r($result);
			if(TRUE === $result['status'])
			{
				$this->Mod_doc->directory_copy(DOC_TEMP_PATH.$session_id.'/'.$result['data']['temp_directory_id'], DOC_PATH.'devbuilder/project1/leads/lead1/');	
			}
		}
		//$this->Mod_doc->directory_copy(DOC_TEMP_PATH.$session_id.'/', DOC_PATH.'devbuilder/project1/leads/lead1/');
	}	
	/** 
	* Function to create builder default  directory
	* 
	* @method: create_builder_dir 
	* @access: public 
	* @param:  
	* @return: array 
	* @URL: Zgxf19jL2NyZWF0ZV9idWlsZgxf1VyX2Rpci8-
	* 
	* ### create_new_builder_folder() - Stored procedure input parameter order and count###
	* 1. builderid (int) 
	* 2. buildername (varchar)
	* 3. createdby (int)
	*/
	public function create_builder_dir()
	{
		$builder_data = array('builder_id' => 3, 
							  'user_id'	=> $this->user_session['ub_user_id'],
							  'builder_name' => 'Prestige Builders'
							);
		
		$result_array = $this->Mod_doc->create_builder_folder($builder_data);

		foreach ($result_array as $dir) {
		    foreach ($dir as $folderpath) {
		       $response = $this->Mod_doc->create_dir(DOC_PATH.$folderpath);
		    }
		}
		echo "<pre>";print_r($response);
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
	* #Flag = 1 is when a new project is created (Docs & Photos).
	* #Flag = 0 is when any other folder is created.
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
		$builder_data = array('builder_id' => 3, 
							  'user_id'	=> $this->user_session['ub_user_id'],
							  'project_id' => 10,
							  'project_name' => '',
							  'folder_name' => 'fsdfs',
							  'parent_folder_id' => 286,
							  'flag' => 1,
							  'call_from' => 'PHP',
							);
		$result_array = $this->Mod_doc->create_new_folder($builder_data);

		foreach ($result_array as $dir) {
		    foreach ($dir as $folderpath) {
		       $response = $this->Mod_doc->create_dir(DOC_PATH.$folderpath);
		    }
		}
		echo "<pre>";print_r($response);
	}
	/**
	*
	* Function to move the file to name to Db and return the file relocation URL  
	*
	* @method: create_new_dir
	* @access: public 
	* @return: array
	* @URL: Zgxf19jL2luc2VydF9maWxlLw--
	*
	* #flag = 1 for upload from docs menu
	* #flag = 0 for upload from other project specific modules like 'mom','log','task','bid','budget','message','schedule','selection','checklist','warranty'. In this case the folderid will also be 0.
	* #flag = 2 for upload from non project specific modules like lead, user, setup.
	*
	* ### insert_file() - Stored procedure input parameter order and count###
	* 1. flag (int) 
	* 2. builderid (int)
	* 3. projectid (VARCHAR)
	* 4. folderid (VARCHAR)
	* 5. filename (int)
	* 6. createdby (int)
	* 7. modulename (int)
	* 8. moduleid (VARCHAR)
	*/   
	public function insert_file($post_array = array(), $temp_directory_id = "")
	{
		if( ! empty($post_array))
		{
			$file_data = array(	  'flag' => 1, 
								  'builder_id'	=> 15,
								  'projectid' => 5,
								  'folderid' => 201,
								  'createdby' => $this->user_session['ub_user_id'],
								  'modulename' => 'docs',
								  'moduleid' => 0,
								);
			$file_data['filename'] = $post_array['filename'];
			$result_array = $this->Mod_doc->insert_file($file_data);

			/* Code to move the files from temp to actual dir*/
			$session_id = $this->session->userdata('session_id');
			rename(DOC_TEMP_PATH.$session_id.'/'.$temp_directory_id.'/'.$result_array['0']['system_file_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['system_file_name']);
			
		}
		else
		{
			echo "the post array is empty. Please select some files to upload.";
		}
	}
	/**
	*
	* Function to get the file names from the temp dir.  
	*
	* @method: create_new_dir
	* @access: public 
	* @return: array
	* @URL: Zgxf19jL2dldF90ZW1wX2Zpbgxf1VuYW1lLw--
	*
	*
	*/   
	public function get_temp_filename()
	{

		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			$session_id = $this->session->userdata('session_id');
			if(TRUE === $result['status'])
			{
				$temp_directory_id = $result['data']['temp_directory_id'];
				$filename = scandir(DOC_TEMP_PATH.$session_id.'/'.$result['data']['temp_directory_id'], 1);
				$count = count($filename);
				for ($i=1; $i < ($count-2); $i++) 
				{  
					$insert_file_data = array('filename' => $filename[$i]);
					$this->insert_file($insert_file_data, $temp_directory_id);
				}
				//print_r($filename);

				//$this->Mod_doc->directory_copy(DOC_TEMP_PATH.$session_id.'/'.$result['data']['temp_directory_id'], DOC_PATH.'devbuilder/project1/leads/lead1/');	
			}
		}
	}
	/**
	*
	* Function will return the file and folder list for docs and Photos from BD   
	*
	* @method: get_folder_details
	* @access: public 
	* @return: array
	* @URL: Zgxf19jL2dldF9mb2xkZXJfZgxf1V0YWlscy8-
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
			$result = $this->sanitize_input();
			//echo "<pre>";print_r($result);exit;
			$module_data = array(	'builder_id' => $result['data']['builder_id'],
									'folderid' => $result['data']['folderid'],
									'module' => $result['data']['module'],
									'dateformat' => $this->user_session['date_format'],
									'timezone' => $this->user_session['time_zone']
								);
			$result_array = $this->Mod_doc->get_folder_details($module_data);
			$count = count($result_array);

			if ($module_data['folderid'] === 0) 
			{
				for ($i=0; $i < $count ; $i++) 
				{ 
					$data[] = array(	'folder_id' => $result_array[$i]['folder_id'],
										'doc_dir' => $i,          
										'Name' => $result_array[$i]['folder_name'],                
										"Contains" => array(
															array(
																"doc_dir_con" => $result_array[$i]['folder_count'],			
											  					"doc_fol_con" => $result_array[$i]['file_count']
															)
														),
										'TotalSize' => "177kb",	  
										'LastUpdated' => $result_array[$i]['last_modified_on']
									);
				}
			}
			else
			{
				for ($i=0; $i < $count ; $i++) 
				{ 
					if ($result_array[$i]['file_type'] === "folder") 
					{  
						$data[] = array(  
										'folder_id' => $result_array[$i]['folder_id'],
										'Name' => array(
															array(
																	"title" => $result_array[$i]['folder_name'],
																	"folder" => "1",
																	"icon" => ""
																)
														),                
										"Contains" => array(
															array(
																"doc_dir_con" => $result_array[$i]['folder_count'],			
											  					"doc_fol_con" => $result_array[$i]['file_count']
															)
														),
										'TotalSize' => "177kb",	  
										'LastUpdated' => $result_array[$i]['last_modified_on']
									);
					}
					else
					{
						$data[] = array(         
										'Name' => array(
															array(
																	"title" => $result_array[$i]['folder_name'],
																	"folder" => 0,
																	"icon" => "log-img.png"
																)
														),                
										"Contains" => array(
															array(
																"doc_dir_con" => "-1",			
											  					"doc_fol_con" => "-1"
															)
														),
										'TotalSize' => "177kb",	  
										'LastUpdated' => $result_array[$i]['last_modified_on']
									);
					}
					
				}
			}
			
			//echo "<pre>";print_r($data);exit;
			$resposne['data'] = $data;
		 	$this->Mod_doc->response($resposne);

			//echo "<pre>";print_r($data);
			echo "<pre>";print_r($result_array);
				
		}
		else
		{
			echo "the post array is empty. Please select some files to upload.";
		}
	}
}
/* End of file doc.php */
/* Location: ./application/controllers/doc.php */