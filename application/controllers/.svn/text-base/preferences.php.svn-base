<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preferences extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_user','Mod_timezone','Mod_login','Mod_role','Mod_doc'));	
        //$this->load->helper('url');		
    }
	public function index()
	{
		$data = array(
		'title'        => "My Profile",		
		'content'      => 'content/preferences/preferences',
		'data_table'   => 'data_table',
		'user_jobs_site_view'  => 'user_jobs_site_view',
		'ckeditor'     => 'ckeditor',
		'signature_img' 	  => 'signature_img'
		);
		//Get date_format from general value table
		$args = array('classification'=>'user_date_format', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['user_date_format_array'] = $result['values'];
		//Get the timezone
		$timezone = $this->Mod_timezone->get_timezone();
		$data['time_zone'] = $this->Mod_timezone->build_ci_dropdown_array($timezone, 'diff_from_GMT', 'zone');
		
		// file display code start hear
		$task_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'folderid' => 0,
								  'modulename' => 'user',
								  'moduleid' => $this->user_id,
								);
			$result_array = $this->Mod_doc->get_files_for_folder($task_data);

			//echo "<pre>";print_r($result_array);exit;
			if(isset($result_array['0']['ub_doc_file_id']) && !empty($result_array['0']['ub_doc_file_id']))
			{
				$data['profile_pic_id'] = $result_array['0']['ub_doc_file_id'];
				$data['profile_pic'] = $result_array['0']['system_file_name'];
			}
		//	file display code end hear
		
		$this->template->view($data);
	}
	/** 
	* Update userprofile
	* @author: Sidhartha
	* @method: update_user_profile 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: dXNlci9zYXZlX2J1aWxkZXJ1c2VyLw--
	*/	
	public function update_user_profile()
	{
		if(!empty($this->input->post()))
		{
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{		
			// Code for single fle upload start
			if(!empty($_FILES['profile_pic']['name'])) 
			{
				$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
						   'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'user'))
						   );
				$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);

				$file_data = array(	  'flag' => 2, 
							  'builder_id'	=> $this->user_session['builder_id'],
							  'projectid' => 0,
							  'createdby' => $this->user_session['ub_user_id'],
							  'modulename' => 'user',
							);

				$file_data['moduleid'] = $this->user_id;
				$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
				$file_data['filename'] = $_FILES['profile_pic']['name'];
				//echo "<pre>"; print_r($file_data);exit;
				$result_array = $this->Mod_doc->insert_file($file_data);

				//echo "<pre>"; print_r($result_array);
				/* Code to move the files from temp to actual dir*/

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
			// Code for single fle upload end
				
			if($result['data']['time_zone'] === '')
			{
				$result['data']['time_zone'] = DEFAULT_USER_TIME_ZONE;
			}
			if($result['data']['date_format'] === '')
			{
				$result['data']['date_format'] = DEFAULT_DATE_FORMAT;
			}
			//Serialize the mail and sms preferences records
			$all_post_array = $this->input->post();
			foreach($this->main_modules as $key=>$module_name){
			$all_email_array[$module_name] = isset($all_post_array['email_checkbox'][$module_name]) ? "Yes" : "No";
			}

			foreach($this->main_modules as $key=>$module_name){
			$all_sms_array[$module_name] = isset($all_post_array['sms_checkbox'][$module_name]) ? "Yes" : "No";
			}

			$email_array = array(
				'search_params' => "'".serialize($all_email_array)."'"
			);
			$sms_array = array(
				'search_params' => "'".serialize($all_sms_array)."'"
			);
			$user_profile_update__array = array(
			'ub_user_id' =>   $this->user_session['ub_user_id'],	
			'first_name' =>   $result['data']['first_name'],
			'last_name' =>   $result['data']['last_name'],
			'alternative_email' =>   $result['data']['alternative_email'],
			'desk_phone' =>   $result['data']['desk_phone'],
			'mobile_phone' =>   $result['data']['mobile_phone'],
			'mobile_isd_code' =>   $result['data']['mobile_isd_code'],
			'fax' => $result['data']['fax'],
			'time_zone' => $result['data']['time_zone'],
			'date_format' => $result['data']['date_format'],
			'modified_by' => $this->user_session['ub_user_id'], 
			'modified_on' => TODAY,
			'signature_text' => $result['data']['signature_text'],
			'mail_preferences' => $email_array['search_params'],
			'sms_preferences' => $sms_array['search_params']);

			//print_r($user_profile_update__array);exit;
			$user_session = array(
				'ub_user_id' =>   $this->user_session['ub_user_id'],
				);
			$response = $this->Mod_user->update_user($user_profile_update__array);	
			$session_response = $this->Mod_login->update_session($user_session);
			$this->Mod_user->response($response);
			//$this->Mod_login->response($session_response);

			}
		}
	}
}