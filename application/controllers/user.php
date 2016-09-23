<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * User Class
 * 
 * @package: User
 * @subpackage: User
 * @category: User
 * @author: Sanchitaa
 * @createdon(DD-MM-YYYY): 24-03-2015 
*/

class User extends UNI_Controller 
{
	public function __construct()
    {
        parent::__construct();
       // $this->load->helper('url');		
		//$this->load->model('Mod_user');
		$this->load->model(array('Mod_user','Mod_general_value','Mod_timezone','Mod_saved_search','Mod_role','Mod_log','Mod_builder','Mod_notification','Mod_plan','Mod_doc'));
		$this->load->helper('export');
		$this->module = 'user';
	}
	
	public function index()
	{	
		//echo "<pre>"; print_r($this->user_session);exit();
		$search_filter_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		$result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array('ub_saved_search_id'),
												 'where_clause' => $search_filter_array
												 ));

		$data = array(
		'title'       		=> "User",		
		'content'      		=> 'content/user/user',
        'page_id'      		=> 'user',
		'data_table'    	=>'data_table',
		'builder users'	   	=>'builder users',      
		'sub_vendors'	   	=>'sub_vendors' ,
		'apply_filter'		=>$apply_filter,
        'gets_internaluser_url' => $this->crypt->encrypt('user/get_internal_user/')	,
		'search_session_array' => $this->uni_session_get('SEARCH')
		); 
	
		//get subcontractor_division custom fields from general value table
		 $args = array('classification'=>'subcontractor_department','type' => 'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['subcontractor_department'] = $result['values'];
		
		//get status custom fields from general value table
		$args = array('classification'=>'user_status','type' => 'dropdown');
	    $result = $this->Mod_general_value->get_general_value($args);
		$data['user_status'] = $result['values'];
		
		//echo "<pre>";print_r($data);exit;
		$this->template->view($data);
	}
	
	
	/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: chandru
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_user->destroy_session($result['data']);
			}
			$this->Mod_user->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	

	
	/** 
	* Get sub_vendors
	* 
	* @method: get_sub_contractor 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :dXNlci9pbmRleC8-
	*/	
	public function get_sub_vendors()
	{
		
		$post_array =  array('SUBCONTRACTOR.builder_id'=>$this->user_session['builder_id']);
		// Order by
		$order_by_where = '';
	    // Pagination Array
		$pagination_array = array();
		
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
				// Sanitize input
				$result = $this->sanitize_input();
				//echo "<pre>";print_r($result);exit;
				if(TRUE === $result['status'])
				{
					if(isset($result['data']['division']) && $result['data']['division']!='')
					{
						$post_array['SUBCONTRACTOR.division'] = $result['data']['division'];
						//Set value in session
						if(@array_key_exists('SEARCH', $this->account_session[$this->user_session['account_type']]['USERS']))
						{
							$this->account_session[$this->user_session['account_type']]['USERS']['SEARCH']['division'] =$result['data']['division'];
						}
						else
						{
							$this->account_session[$this->user_session['account_type']]['USERS'] = array('SEARCH'=>array('division'=>  $result['data']['division']));
						}
			
					}
					if(isset($result['data']['user_status']) && $result['data']['user_status']!='')
					{
						$post_array['USER.user_status'] = $result['data']['user_status'];
						//Set value in session
						if(@array_key_exists('SEARCH', $this->account_session[$this->user_session['account_type']]['USERS']))
						{
							$this->account_session[$this->user_session['account_type']]['USERS']['SEARCH']['user_status'] =$result['data']['user_status'];
						}
						else
						{
							$this->account_session[$this->user_session['account_type']]['USERS'] = array('SEARCH'=>array('user_status'=>  $result['data']['user_status']));
						}
			
					}
					
					//echo "<pre>";print_r($this->account_session);exit;
					$this->session->set_userdata('ACCOUNT', $this->account_session); 
					if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
					{
						$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
						// Get number of records
						$total_count_array = $this->Mod_user->get_sub_contractor(array(
													'select_fields' => array('COUNT(SUBCONTRACTOR.ub_subcontractor_id) AS total_count'),
													'join'=> array('builder'=>'Yes'),
													'where_clause' => $post_array
													));
					}
					if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
					{
						$sort_type = $result['data']['sSortDir_0'];
						$sort_filed_column_id = $result['data']['iSortCol_0'];
						$dt_filed_name = 'mDataProp_';
						$order_by_where = 'SUBCONTRACTOR.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
					else
					{
					$order_by_where = 'SUBCONTRACTOR.modified_on DESC';
					}
					
				}
				else
				{
					$this->Mod_user->response($result);
				}
		}
		
		// Fetch Data all records based on conditions
		$result_data = $this->Mod_user->get_sub_contractor(array(
												'select_fields' => array(
												'SUBCONTRACTOR.ub_subcontractor_id', 'SUBCONTRACTOR.builder_id', 'SUBCONTRACTOR.company','SUBCONTRACTOR.division','USER.mobile_phone','USER.desk_phone','USER.primary_email'),
												'join'=> array('builder'=>'Yes'),
												'where_clause' => $post_array,
												'order_clause' => $order_by_where,
												'pagination' => $pagination_array
												));
		// The following parameters required for data table
		$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
		$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
	     $result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		// Response data
		$this->Mod_user->response($result_data);
		
		//echo $this->db->last_query($result_data);
		//echo '<pre>';print_r($this->user_session);exit;
	}
	
	
	/** 
	* Get save_user
	* 
	* @method: save_user
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded :dXNlci9zYXZlX3VzZXIv
	*/
	public function save_user($user_id = 0)
	{
       $post_data=array(
				'first_name' => 'kutty234',
				'last_name' => 'mai123',
				'address' => 'abc 564789 xyz',
				'primary_email' => 'jai@gmail.com',
				'username' => 'kalhjbd',
				'password' => 'jai1234',
				'login_enabled' => 'yes',
			 'ub_user_id' => '35' 
			);
		if(!empty($post_data['ub_user_id']))
		{
		$response = $this->Mod_user->update_internal_user($post_data);
			$this->Mod_user->response($response);
		}
		else
		{
		$response = $this->Mod_user->add_internal_user($post_data);
		$this->Mod_user->response($response);
		}
	}	
	/** 
	* Delete internal user
	* 
	* @method: delete_internal_user
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* encoded url :dXNlci9kZWxldgxf1VfaW50ZXJuYWxfdXNlci8-   
	*/	
	
	public function delete_internal_user($user_id = 0)
	 {	
		 
			$post_data['ub_user_id'] = array(19,20);
				$response = $this->Mod_user->delete_internal_user($post_data);
				echo '<pre>';print_r($response);
				
	 } 
		
	/** 
	* Get Time zones
	* 
	* @method: get_timezone 
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded :dXNlci9nZXRfdgxf1ltZXpvbmUv
	*/
	public function get_timezone()
	{
		// Fetch timezone to display
		$timezone = $this->Mod_timezone->get_timezone();
		// echo '<pre>';print_r($timezone);exit;
		
		// Fetch date format to display		
		// $args = array('classification'=>'user_date_format');
		// $date_format_array = $this->Mod_general_value->get_general_value($args);
		
		// echo '<pre>';print_r($date_format_array);exit;
		
		// Understanding of GM Date
		date_default_timezone_set('America/Los_Angeles');
		// echo "Current Date - timezone ".date_default_timezone_get()." : - ".date('Y-m-d H:i:s');
		// date_default_timezone_set('Asia/Kolkata');
		// echo "<Br>Current GM Date : ".TODAY;
		// echo "<br>Current Date - timezone ".date_default_timezone_get()." : - ".date('Y-m-d H:i:s');
		// echo "<Br>Current GM Date : ".TODAY;exit;
		
		// Fetching datetime / date
		$datetime_array = array('last_login_time', 'last_logout_time');
		
		$date_array = array('created_on', 'modified_on');
		// echo '<pre>';print_r($this->user_session);exit;
		$this->db->select('first_name, last_login_time AS last_login_time_before_format, last_logout_time AS logout_time_before_format, '.$this->Mod_user->format_user_datetime($datetime_array).', created_on AS created_on_before_format, modified_on AS modified_on_before_format, '.$this->Mod_user->format_user_datetime($date_array,"date"), false);
		$this->db->from(UB_USER);
		$this->db->where(array('ub_user_id' => 5));
		$res = $this->db->get();
		if($res->num_rows() > 0)
		{
			echo '<pre>';print_r($res->result_array());exit;
		}
		
	}
	
   /** 
	* Get Saved Search
	* 
	* @method: get_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: chandru 
	* @created on: 01/04/2015 
	* url encoded : dXNlci9nZXRfc2F2ZWRfc2VhcmNoLw--
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
				$user_array = $this->input->post();
				$post_array = array(
									'search_params' => "'".serialize($user_array)."'"
									);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
			}
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
			
			if(!empty($unserialized_data['first_name']))
			{
				if(@array_key_exists('SEARCH', $this->account_session[$this->user_session['account_type']]['USERS']))
					{
						// Set value in session
						$this->account_session[$this->user_session['account_type']]['USERS']['SEARCH']['first_name'] =$unserialized_data['first_name'];
					}
					else
					{
						$this->account_session[$this->user_session['account_type']]['USERS'] = array('SEARCH'=>array('first_name'=>  $unserialized_data['first_name']));
					}
			}
			$this->session->set_userdata('ACCOUNT', $this->account_session);
			// Response data
			$this->Mod_user->response($result_data);
		}
	} 
	
	/** 
	* Get save_subvendor
	* 
	* @method: save_subvendor
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded :
	*/
	public function save_subvendor($ub_subcontractor_id = 0)
	{
       $post_data=array(
				'Company' => 'kutty234',
				'Division' => 'mai123',
				/*'Activation' => 'abc 564789 xyz',
				'Primary Contact' => 'jai@gmail.com',
				'Trade Agreement' => 'kalhjbd',
				'Liability Exp' => 'jai1234',
				'Work comp exp' => 'yes',
				'Cell' => '35'
				'Phone' => '35'
				'Email' => '35'*/
				'ub_subcontractor_id' => ' '
				
			);
		if(!empty($post_data['ub_subcontractor_id']))
		{
		$response = $this->Mod_user-> update_subvendor($post_data);
			$this->Mod_user->response($response);
		}
		else
		{
		$response = $this->Mod_user->add_subvendor($post_data);
		$this->Mod_user->response($response);
		}
	}	
	
	/** 
	* Delete subvendor
	* 
	* @method: delete_subvendor
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*  encoded url : 
	*/	
	
	public function delete_subvendor($ub_subcontractor_id = 0)
	 {	
		 
			$post_data['ub_subcontractor_id'] = array(19,20);
				$response = $this->Mod_user->delete_subvendor($post_data);
				echo '<pre>';print_r($response);
				
	 } 
	
   public function internaluser()
	{
		
		$data = array(
		'title'       		=> "UNIBUILDER",		
		'content'      		=> 'content/user/internaluser',
		'page_id'      		=> 'user',
		'ckeditor'          => 'ckeditor'
		);
		
		$this->template->view($data);
	}
	
	
	
	public function subvendor()
	{
		$data = array(
		'title'       		=> "UNIBUILDER",
		'page_id'      		=> 'user',		
		'content'      		=> 'content/user/subvendor',
		'date_all'			=> 'date_all'
		);
		$this->load->view('common/common-template',$data);
	}
	
	/* Sathish Coding */
	public function builder_users()
	{
		$this->module = 'BUILDERUSER';
		$data = array(
		'title'       		=> "BUILDERUSER",		
		'content'      		=> 'content/user/builder_users',
		'page_id'      		=> 'user',
		'ckeditor'          => 'ckeditor',
		'current_url' => $this->uri->segment(1),
		'get_builder_users_url' => $this->crypt->encrypt('user/get_builder_users/'),
		'search_session_array' => $this->uni_session_get('SEARCH'),
		'new_builder_user_url' => $this->crypt->encrypt('user/save_builderuser/'),
		);
		$this->module = 'BUILDERUSER';
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
		$apply_filter = false;;
		}
		
		$data['apply_filter'] = $apply_filter;
		$this->template->view($data);
	}
	public function user_subcontractor()
	{
		$data = array(
		'title'       		=> "UNIBUILDER",
		'page_id'      		=> 'user',		
		'content'      		=> 'content/user/user_subcontractor',
		'date_all'			=> 'date_all',
		'data_table'          => 'data_table',
		'sub_vendors'       => 'sub_vendors'
		);
		$this->template->view($data);
	}
	public function user_subuser()
	{
		$this->module = 'SUBUSERS';
		$data = array(
		'title'       		=> "Sub user",
		'page_id'      		=> 'user',		
		'content'      		=> 'content/user/user_subuser',
		'date_all'			=> 'date_all',
		'data_table'        => 'data_table',
        'sub_vendors'       => 'sub_vendors',
		'search_session_array' => $this->uni_session_get('SEARCH')
		);
		$this->template->view($data);
	}

	
	/** 
	* Save/Update builderuser
	* @author: Sidhartha
	* @method: save_builderuser 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: dXNlci9zYXZlX2J1aWxkZXJ1c2VyLw--
	*/	
	public function save_builderuser($ub_user_id = 0)
	{
		$this->encrypt_key = 'XYZ!@#$%';
		$result_data = array();
		$post_data = array();
		$data = array(
		'title'       		  => "BUILDERUSER",		
		'content'      		  => 'content/user/add_builderuser',
		'page_id'      		  => 'user',
		'ckeditor'            => 'ckeditor',
		'data_table'          => 'data_table',
		'user_jobs_site_view' => 'user_jobs_site_view',
		'signature_img' 	  => 'signature_img'
		);
		//signature file validation code // added by satheesh kumar
		if(isset($_FILES['file_0']['tmp_name']) && $_FILES['file_0']['tmp_name'] != '')
		{
			list($width, $height) = getimagesize($_FILES['file_0']['tmp_name']);
			if($width < LOGO_MIN_WIDTH || $width > LOGO_MAX_WIDTH  ||  $height < LOGO_MIN_HEIGHT  ||  $height > LOGO_MAX_HEIGHT )
			{
				$response['status'] = FALSE;
				$response['error'] = 'size'; 
				$response['message'] = "File should Max height: ".LOGO_MAX_HEIGHT."  Min height: ".LOGO_MIN_HEIGHT." Max width: ".LOGO_MAX_WIDTH."  Min width:".LOGO_MIN_WIDTH ;
				// echo '<pre>';print_r($response);exit;
				$this->Mod_user->response($response);
			}
		}
		
		// file display code start hear
			$task_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $ub_user_id,
								);
			$result_array = $this->Mod_doc->get_files_for_folder($task_data);
			//echo "<pre>";print_r($result_array);exit;
			if(isset($result_array['0']['ub_doc_file_id']) && !empty($result_array['0']['ub_doc_file_id']))
			{
				$data['profile_pic_id'] = $result_array['0']['ub_doc_file_id'];
				$data['profile_pic'] = $result_array['0']['system_file_name'];
			}
		//	file display code end hear
		//Codition check wheather the ub_user_id value is greater than 0 or not
		if($ub_user_id > 0 || null!==$this->input->post('ub_user_id') && $this->ci_decrypt($this->input->post('ub_user_id'), $this->encrypt_key) > 0)
		{
			 //echo '<pre>';print_r($this->input->post('file_0'));exit;   
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  $result = $this->sanitize_input();
			  if(TRUE === $result['status'])
			  {
			  	$result['data']['ub_user_id'] = $this->ci_decrypt($result['data']['ub_user_id'], $this->encrypt_key);
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
				$password_result = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.password'),
								'where_clause' => array('USER.ub_user_id' => $result['data']['ub_user_id'])
								));
				//print_r($password_result['aaData'][0]['password']);exit;
				if($password_result['aaData'][0]['password'] != $result['data']['password']){
				$password =  $this->Mod_user->encrypt_password($result['data']['password']);
				if(TRUE === $password['status'])
				{
					$password = $password['encrypt_password'];
				}}
				else
				{
					$password = '';
				}
				$save_type = $result['data']['save_type'];
			  	$builderuser_update_array = array(
			  	'ub_user_id' =>   $result['data']['ub_user_id'],	
	            'builder_id' => $this->user_session['builder_id'],
	            'username' =>   $result['data']['username'],
	            'password' =>   $password,
	            'first_name' =>   $result['data']['first_name'],
	            'last_name' =>   $result['data']['last_name'],
	            'primary_email' =>   $result['data']['primary_email'],
	            'alternative_email' =>   $result['data']['alternative_email'],
	            'desk_phone' =>   $result['data']['desk_phone'],
	            'mobile_phone' =>   $result['data']['mobile_phone'],
	            'mobile_isd_code' =>   $result['data']['mobile_isd_code'],
	            'fax' => $result['data']['fax'],
	            'role_id' => $result['data']['role_id'],
	            'account_type' => BUILDERADMIN,
	            'time_zone' => $result['data']['time_zone'],
	            'date_format' => $result['data']['date_format'],
	            'accessmethod' => $result['data']['accessmethod'],
	            'user_status' =>   isset($result['data']['login_enabled']) ? "Active" : "Inactive",
	            'login_enabled' => isset($result['data']['login_enabled']) ? "Yes" : "No",
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,
	            'signature_text' => $result['data']['signature_text'],
	            'mail_preferences' => $email_array['search_params'],
	            'sms_preferences' => $sms_array['search_params']);
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				if($password_result['aaData'][0]['password'] == $result['data']['password'] && $result['data']['password']!=''){
					
					unset($builderuser_update_array['password']);
				}
				$response = $this->Mod_user->update_builderuser($builderuser_update_array);
				//Send Emial Invite
				if($save_type == 'save_and_stay_and_sent_mail')
				{
					$result['data']['ub_user_id'] = $result['data']['ub_user_id'];
				    $result['data']['name'] = $result['data']['first_name'].' '.$result['data']['last_name'];
			        $responses = $this->Mod_user->user_email_invitation($result['data']);
				}
				
				// Code for single fle upload start
				if(!empty($_FILES))
				{
					$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
							   'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => $this->module))
							   );
					$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);

					$file_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'createdby' => $this->user_session['ub_user_id'],
								  'modulename' => $this->module,
								);
					$file_data['moduleid'] = $result['data']['ub_user_id'];
					$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
					$file_data['filename'] = $_FILES['file_0']['name'];
					$result_array = $this->Mod_doc->insert_file($file_data);
					//echo "<pre>"; print_r($result_array);exit;
					/* Code to move the files from temp to actual dir*/

					if ($result_array['0']['createfolderflag'] == 1) 
					{
						$response_dir = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
						if(TRUE === $response_dir['status'])
						{
							$session_id = $this->session->userdata('session_id');
							move_uploaded_file($_FILES['file_0']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
						}
					}
					else
					{
						$session_id = $this->session->userdata('session_id');
						move_uploaded_file($_FILES['file_0']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);	
					}					
				}
			// Code for single fle upload end
				$this->Mod_user->response($response);
			  }
			 }
			else
			{

			//Get username for common view file
			$user_select_args = $this->Mod_user->get_users(array(
			'select_fields' => array('USER.username','USER.login_enabled'),
			'where_clause' => (array('ub_user_id' =>  $ub_user_id))
			));
			
			// Get inserted data with help of id
			 $result_data = $this->Mod_user->get_users(array(
			'select_fields' => array('USER.ub_user_id', 'USER.builder_id', 'USER.first_name',
			'USER.last_name', 'USER.primary_email','USER.alternative_email','USER.username','USER.mobile_phone','USER.desk_phone','USER.fax','USER.role_id','ROLE.ub_role_id','ROLE.role_name','USER.login_enabled','USER.date_format','USER.time_zone','USER.signature_text','USER.user_status','USER.mail_preferences','USER.sms_preferences','USER.password'),
			'join'=> array('role'=>'Yes'),
			'where_clause' => (array('ub_user_id' =>  $ub_user_id))
			));
			//Unseralize records of mail preferences
			$serialized_mail_preferences = $result_data['aaData'][0]['mail_preferences'];
		    $remove_single_quote_mail_preferences = str_replace("'", '', $serialized_mail_preferences);
		    $unserialized_mail_preferences = unserialize($remove_single_quote_mail_preferences);
		    $result_data['aaData'][0]['mail_preferences'] = $unserialized_mail_preferences;
		    //Seralize records of sms preferences
		    $serialized_sms_preferences = $result_data['aaData'][0]['sms_preferences'];
		    $remove_single_quote_sms_preferences = str_replace("'", '', $serialized_sms_preferences);
		    $unserialized_sms_preferences = unserialize($remove_single_quote_sms_preferences);
		    $result_data['aaData'][0]['sms_preferences'] = $unserialized_sms_preferences;
			if(TRUE === $result_data['status'])
			{
				$data['builderuser_data']  = $result_data['aaData'][0];
			}
			
			if(TRUE === $user_select_args['status'])
			{
				$data['user_data']  = $result_data['aaData'][0];
			}
		   }
		 
	    }
	    // Here ub_user_id value is 0. So It will enter to Insert function
		else
		{
	     /* Added by Pranab, Below condition will check plan has enough user. */
		 /* start */
		  $builder_id = $this->user_session['builder_id'];
		  $user_limit = $this->Mod_user->check_user_limit_based_plan($builder_id) ;
		  if(FALSE === $user_limit['status'])
			{
				redirect(base_url().'dXNlci9idWlsZgxf1VyX3dhcm5pbmdfcgxf1FnZQ--');
			} 
		 /* end */	
		  if(!empty($this->input->post()))
		  {
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
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
				$password =  $this->Mod_user->encrypt_password($result['data']['password']);
				if(TRUE === $password['status'])
				{
					$password = $password['encrypt_password'];
				}
				else
				{
					$password = '';
				}
				$save_type = $result['data']['save_type'];
				$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
				$random_key = random_string('alnum', 20);
				$builderuser_insert_array = array(
			  	'ub_user_id' =>   $result['data']['ub_user_id'],	
	            'builder_id' => $this->user_session['builder_id'],
	            'username' =>   $result['data']['username'],
	            'password' =>   $password,
	            'first_name' =>   $result['data']['first_name'],
	            'last_name' =>   $result['data']['last_name'],
	            'primary_email' =>   $result['data']['primary_email'],
	            'alternative_email' =>   $result['data']['alternative_email'],
	            'desk_phone' =>   $result['data']['desk_phone'],
	            'mobile_phone' =>   $result['data']['mobile_phone'],
	            'mobile_isd_code' =>   $result['data']['mobile_isd_code'],
	            'fax' => $result['data']['fax'],
	            'role_id' => $result['data']['role_id'],
	            'account_type' => BUILDERADMIN,
	            'accessmethod' => $result['data']['accessmethod'],
	            'time_zone' => $result['data']['time_zone'],
	            'date_format' => $result['data']['date_format'],
	            'user_status' =>   isset($result['data']['login_enabled']) ? "Active" : "Inactive",
	            'login_enabled' => isset($result['data']['login_enabled']) ? "Yes" : "No",
	            'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,
	            'signature_text' => $result['data']['signature_text'],
	            'mail_preferences' => $email_array['search_params'],
	            'sms_preferences' => $sms_array['search_params'],
	            'random_key' => $random_key,
	            'active_till' => $active_till);
				//print_r($builderuser_insert__array);
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				// insert the record
				$response = $this->Mod_user->add_builderuser($builderuser_insert_array);

				//Send Emial Invite
				if($save_type == 'save_and_stay_and_sent_mail')
				{
					$result['data']['ub_user_id'] = $response['insert_id'];
				    $result['data']['name'] = $result['data']['first_name'].' '.$result['data']['last_name'];
			        $responses = $this->Mod_user->user_email_invitation($result['data']);
				}
				
				
				// Code for single fle upload start
				if(!empty($_FILES))
				{
					$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
							   'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => $this->module))
							   );
					$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);

					$file_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'createdby' => $this->user_session['ub_user_id'],
								  'modulename' => $this->module,
								);
						$file_data['moduleid'] = $response['insert_id'];
						$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
						$file_data['filename'] = $_FILES['file_0']['name'];
						$result_array = $this->Mod_doc->insert_file($file_data);
						/* Code to move the files from temp to actual dir*/

						if ($result_array['0']['createfolderflag'] == 1) 
						{
							$response_dir = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
							if(TRUE === $response_dir['status'])
							{
								$session_id = $this->session->userdata('session_id');
								move_uploaded_file($_FILES['file_0']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
							}
						}
						else
						{
							$session_id = $this->session->userdata('session_id');
							move_uploaded_file($_FILES['file_0']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);	
						}
				}
					// Code for single fle upload end
			    $this->Mod_user->response($response);
			}
			else
			{
				$this->Mod_user->response($result);
			}
		  }
	    }
	    //Get all roles of a builder
	    $role_list = $this->Mod_role->get_roles(array(
					'select_fields' => array('ROLE.ub_role_id','ROLE.role_name'),
					'where_clause' => (array('ROLE.builder_id' => $this->user_session['builder_id']))
					));

	   // echo "<pre>";print_r($role_list);exit;
	    if( $role_list['status'] == TRUE){
	   	 $role_list['aaData'] = array_merge( $role_list['aaData'], array(array('ub_role_id'=> '4','role_name'=>'Project Manager')));
	   	}else
	   	{
	   		 $role_list['aaData'] = array(array('ub_role_id'=> PROJECT_MANAGER_ROLE_ID,'role_name'=>'Project Manager'));
	   	}
	    $data['role_list']=array();
		$data['role_list'] = $this->Mod_role->build_ci_dropdown_array($role_list['aaData'],'ub_role_id', 'role_name');

		//echo "<pre>";print_r($role_list);exit;
		//Get date_format from general value table
		$args = array('classification'=>'user_date_format', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['user_date_format_array'] = $result['values'];
		//Get the timezone
		$timezone = $this->Mod_timezone->get_timezone();
		$data['time_zone'] = $this->Mod_timezone->build_ci_dropdown_array($timezone, 'diff_from_GMT', 'zone');
		$this->template->view($data);
		
	}
	/** 
	* Get builder users
	* 
	* @method: get_builder_users 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	*@created by: Gayathri Kalyani
	* encoded url :
	*/	
	public function get_builder_users($page_count = '')
	{

		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Getting data of a particular builder
				$post_array[] = array(
									'field_name' => 'USER.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				/* $post_array[] = array(
									'field_name' => 'USER.created_by',
									'value'=> $this->user_session['ub_user_id'], 
									'type' => '='
									); */
				$post_array[] = array(
									'field_name' => 'USER.account_type',
									'value'=> BUILDERADMIN, 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'USER.user_status',
									'value'=> 'Delete', 
									'type' => '!='
									);
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				// Date range search input
				if(isset($result['data']['full_name']) && $result['data']['full_name']!='')
				{
					$post_array[] = array(
										'field_name' => 'CONCAT_WS(" ",USER.first_name,USER.last_name)',
										'value'=> $result['data']['full_name'], 
									    'type' => 'like'
										);
					$search_session_array['full_name'] = $result['data']['full_name'];
				}
				$this->module = 'BUILDERUSER';
				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('SEARCH')['full_name']) && $this->uni_session_get('SEARCH')['full_name']!='')
				  {
					$post_array[] = array(
										'field_name' => 'CONCAT_WS(" ",USER.first_name,USER.last_name)',
										'value'=> $this->uni_session_get('SEARCH')['full_name'], 
									    'type' => 'like'
										);
					//$search_session_array['daterange'] = $result['data']['daterange'];
				  }
				}

				/*
					Paggination length stored in seesion code start here
				*/	
				
				
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('SEARCH')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('SEARCH')['iDisplayLength'];
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				$where_str = $this->Mod_user->build_where($post_array);
				
				// Pagination argument
				$pagination_array = array();
				if(isset($this->uni_session_get('SEARCH')['iDisplayStart']) && isset($this->uni_session_get('SEARCH')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('SEARCH')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('SEARCH')['iDisplayLength'], 'sEcho' => 1);
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}
				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}*/
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					// Get formatted sort name
					$format_sort_name = $this->Mod_user->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
					$order_by_where = 'USER.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
			    	}
				}
				else
				{
					$order_by_where = 'USER.modified_on DESC';
				}
                // Fetch argument building
                $builder_user_args = array('select_fields' => array(
												'USER.ub_user_id', 'USER.builder_id','USER.primary_email','USER.role_id','ROLE.role_name','USER.user_status','USER.country','USER.time_zone','CONCAT_WS(" ",USER.first_name,USER.last_name) as first_name'),
												'join'=> array('builder'=>'Yes','role'=>'Yes'),
												'where_clause' => $where_str,
												'order_clause' => $order_by_where,
												'group_clause' => array("USER.ub_user_id"), 
												'pagination' => $pagination_array
                                                 ); 
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					//Only for export
					unset($builder_user_args['pagination']);
				}
				$result_data = $this->Mod_user->get_users($builder_user_args);
				if($page_count == 'result_array')
				{
					//print_r($result_data);exit;
					return $result_data;
				}
				if($result_data['status'] == TRUE)
				{
					$result_data['aaData'] = $this->Mod_timezone->datatable_timezone($result_data['aaData']);
				}
				// echo '<pre>';print_r($result_data['aaData']);exit;
				// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('first_name','role_name','country','time_zone','user_status','primary_email');
					
					// Export file header column 
					$export_array['header'][0] = array('Name','Role','Country','Time Zone','Status','Email'); 

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
					echo array_to_export($export_array,'uni_Builderuserlist.xls','csv');exit;
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
					$total_count_array = $this->Mod_user->get_users(array(
												'select_fields' => array('COUNT(USER.ub_user_id) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_user->response($result_data);
			}
			else
			{
				$this->Mod_user->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_user->response($result);
		}
	}
	/** 
	* Delete users
	* @author: Sidhartha
	* @method: delete_user 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: dXNlci9kZWxldgxf1VfYnVpbgxf1RlcnVzZXIv
	*/
	public function delete_builderuser()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_user->delete_user($result['data']);
				$respoce_array = $this->get_builder_users($page_count = 'result_array');
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
				$this->Mod_user->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_user->response($response);
	}
	/** 
	* builderuser_email_invitation method to send mail to builderuser
	* 
	* @method: builderuser_email_invitation 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: Sidhartha
	* @created on: 20/04/2015 
	*/
	public function builderuser_email_invitation()
	{
		//sanitize_input will Clean the data transferred to the sever before submitting to model
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			$this->encrypt_key = 'XYZ!@#$%';
			$post_array['data']['ub_user_id'] = $this->ci_decrypt($post_array['data']['ub_user_id'], $this->encrypt_key);
			$response = $this->Mod_user->user_email_invitation($post_array['data']);
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_user->response($response);
	}
	/** 
	* subuser_email_invitation method to send mail to subuser
	* 
	* @method: subuser_email_invitation 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: Sidhartha
	* @created on: 20/04/2015 
	*/
	public function subuser_email_invitation()
	{
		//sanitize_input will Clean the data transferred to the sever before submitting to model
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			$response = $this->Mod_user->user_email_invitation($post_array['data']);

		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_user->response($response);
	}
	/** 
	* Get all projects of a user
	* 
	* @method: get_all_projects_user_involved 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9pbmRleC8-
	*/	
	public function get_all_projects_user_involved()
	{
		// Get list of project the user involved
		$this->encrypt_key = 'XYZ!@#$%';
		$result = $this->sanitize_input();
		$result['data']['ub_user_id'] = $this->ci_decrypt($result['data']['ub_user_id'], $this->encrypt_key);
		$post_array[] = array(
							'field_name' => 'PROJECT_ASSIGNED_USERS.assigned_to',
							'value'=> $result['data']['ub_user_id'], 
							'type' => '='
							);
		 $where_str = $this->Mod_user->build_where($post_array);
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
				$format_sort_name = $this->Mod_user->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
				if($format_sort_name != '')
				{
				  $order_by_where = $format_sort_name.' '.$sort_type;
				}
				else
				{
					$order_by_where = 'PROJECT.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				}
				// Fetch argument building
				$date_array = array('PROJECT.projected_start_date'=>'');
				$projected_start_date_array = $this->Mod_user->format_user_datetime($date_array,"date");
				$new_date_array = "IF(PROJECT.projected_start_date = '0000-00-00', '-',".$projected_start_date_array.") AS projected_start_date";
				// echo '<pre>';print_r($new_date_array);exit;
                $project_args = array('select_fields' => array('PROJECT.project_name','PROJECT.project_group','PROJECT.project_status','ROLE.role_name,'.$new_date_array),
                'join'=> array('project'=>'Yes','user'=>'Yes','role'=>'Yes'),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$project_data = $this->Mod_user->get_all_projects_user_involved($project_args);
				if($project_data['status'] == FALSE)
				{
					$project_data = array();
					$project_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_user->get_all_projects_user_involved(array(
												'select_fields' => array('COUNT(PROJECT_ASSIGNED_USERS.project_id) AS total_count'),
												'where_clause' => $where_str));
					$project_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$project_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$project_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_user->response($project_data);

	}
	/** 
	* Apply Saved Search
	* 
	* @method: apply_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: sidhartha 
	* @created on: 03/04/2015 
	* url encoded : cm9sZXMvZ2V0X3NhdmVkX3NlYXJjaC8-
	*/
	public function apply_saved_search_builderuser()
	{
		/* Apply Filter code starts here */
		   $this->module = 'BUILDERUSER';
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
			}else{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
				}
		}else{
		 $serialized_data = $result_data['aaData'][0]['search_params'];
		 $remove_single_quote = str_replace("'", '', $serialized_data);
		 $unserialized_data = unserialize($remove_single_quote);
		 $result_data['aaData'][0]['search_params'] = $unserialized_data;
		 if(!empty($unserialized_data))
		 {
			
			
			if(!empty($unserialized_data['full_name']))
			{
				$search_session_array['full_name'] =$unserialized_data['full_name'];
			}
			
			
			$this->uni_set_session('search', $search_session_array);
			$this->Mod_user->response($result_data);
			}
		}
	/* Apply Filter code Ends here */
	}
	/** 
	 * Subcontractor Class
	 * 
	 * @package: Subcontractor
	 * @subpackage: Subcontractor
	 * @category: Subcontractor
	 * @author: Chandru 
	 * @createdon(DD-MM-YYYY): 19-04-2015 16:13
	*/
	/*public function add_subcontractor($ub_subcontractor_id = 0)
	   {
		$results = $this->sanitize_input();
	     $data = array(
		'title'       		=> "Subcontractor",
		'page_id'      		=> 'user',		
		'content'      		=> 'content/user/add_subcontractor',
		'date_all'			=> 'date_all'
		);
		//Division from general value table
		$args =array('classification'=>'subcontractor_department', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->builder_id.')', 'type'=>'dropdown'); 
		$subcontractor_department_array = $this->Mod_general_value->get_general_value($args);
		$data['subcontractor_department'] = array();
		if(isset($subcontractor_department_array['values']))
		{
			$data['subcontractor_department'] = $subcontractor_department_array['values'];
			
		}
		//Edit code
		if($ub_subcontractor_id > 0 || isset($results['data']['ub_subcontractor_id']) && $results['data']['ub_subcontractor_id'] > 0)
		{
			
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  //Edit code
			  $results = $this->sanitize_input();
			  $subcontractor_department = "".implode(",", $results['data']['subcontractor_department'])."";
				$sub_contractor_update_main_array = array(
					'company' => $results['data']['company'],
					'division' => $subcontractor_department,
					'address' => $results['data']['address'],
					'city' => $results['data']['city'],
					'province' => $results['data']['province'],
					'postal' => $results['data']['postal'],
					'desk_phone' => $results['data']['desk_phone'],
					'mobile_phone' => $results['data']['mobile_phone'],
					'fax' => $results['data']['fax'],
					'access_to_all_projects' => $results['data']['hidden_access_to_all_projects'],
					'access_to_all_owners' => $results['data']['hidden_access_to_all_owners'],
					'other_notes' => $results['data']['other_notes'],
					'hold_payments' => $results['data']['hidden_hold_payments'],
					'notes' => $results['data']['payment_notes'],
					'ub_subcontractor_id' => $results['data']['ub_subcontractor_id']
				);
					$response = $this->Mod_user->update_sub_contractors($sub_contractor_update_main_array);
					$this->Mod_user->response($response);
			  }
			 
			else
			{
			// Get inserted data with help of id
			 $result_data = $this->Mod_user->get_sub_contractors(array(
			'select_fields' => array('UB_SUBCONTRACTOR.ub_subcontractor_id','UB_SUBCONTRACTOR.builder_id', 'UB_SUBCONTRACTOR.user_id', 'UB_SUBCONTRACTOR.company', 'UB_SUBCONTRACTOR.division', 'UB_SUBCONTRACTOR.address', 'UB_SUBCONTRACTOR.city', 'UB_SUBCONTRACTOR.province','UB_SUBCONTRACTOR.postal','UB_SUBCONTRACTOR.desk_phone','UB_SUBCONTRACTOR.mobile_phone','UB_SUBCONTRACTOR.fax','UB_SUBCONTRACTOR.access_to_all_projects','UB_SUBCONTRACTOR.access_to_all_owners','UB_SUBCONTRACTOR.other_notes','UB_SUBCONTRACTOR.hold_payments','UB_SUBCONTRACTOR.notes','UB_SUBCONTRACTOR.created_on','UB_SUBCONTRACTOR.created_by','UB_SUBCONTRACTOR.modified_on','UB_SUBCONTRACTOR.modified_by'),
			//'join'=> array('builder'=>'Yes'),
			'where_clause' => (array('ub_subcontractor_id' =>  $ub_subcontractor_id))
			));
			 $data['result_data']  = $result_data['aaData'][0];
		   }
		 
	    }
		else{
		if(!empty($this->input->post()))
		 {
		 //Add check list code
		 $results = $this->sanitize_input();
		 // echo '<pre>';print_r($results);exit;
		 $subcontractor_department = "".implode(",", $results['data']['subcontractor_department'])."";
		 $insert_in_sub_contractor_table = array(
					'company' => $results['data']['company'],
					'division' => $subcontractor_department,
					'address' => $results['data']['address'],
					'city' => $results['data']['city'],
					'province' => $results['data']['province'],
					'postal' => $results['data']['postal'],
					'desk_phone' => $results['data']['desk_phone'],
					'mobile_phone' => $results['data']['mobile_phone'],
					'fax' => $results['data']['fax'],
					'access_to_all_projects' => $results['data']['hidden_access_to_all_projects'],
					'access_to_all_owners' => $results['data']['hidden_access_to_all_owners'],
					'other_notes' => $results['data']['other_notes'],
					'hold_payments' => $results['data']['hidden_hold_payments'],
					'notes' => $results['data']['payment_notes']
					);
		// echo '<pre>';print_r($insert_in_sub_contractor_table);exit;
					$response = $this->Mod_user->add_in_sub_contractor_table_and_user_table($insert_in_sub_contractor_table);
					$this->Mod_user->response($response);
		}
		}
		$this->template->view($data);
	}*/
	public function save_subuser($ub_user_id = 0)
	   {
	     $data = array(
		'title'       		=> "Save sub users",
		'page_id'      		=> 'user',		
		'content'      		=> 'content/user/add_subuser',
		'date_all'			=> 'date_all'
		);

	    //Get all company names according to builder id
	     $company_list = $this->Mod_user->get_company_name(array(
					'select_fields' => array('SUBCONTRACTOR.ub_subcontractor_id','SUBCONTRACTOR.company'),
					'where_clause' => (array('SUBCONTRACTOR.builder_id' =>  $this->user_session['builder_id']))
					));
	    $data['company_list']=array();
	    if(TRUE === $company_list['status'])
		{
			$data['company_list'] = $this->Mod_user->build_ci_dropdown_array($company_list['aaData'],'ub_subcontractor_id', 'company');
		}

		//echo '<pre>';print_r($_POST);exit;
		//Add code
		//Edit code
		$results = $this->sanitize_input();
		if($ub_user_id > 0 || isset($results['data']['ub_user_id']) && $results['data']['ub_user_id'] > 0)
		{
			
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  //Edit code
		     	$password =  $this->Mod_user->encrypt_password($results['data']['password']);
				if(TRUE === $password['status'])
				{
				  $password = $password['encrypt_password'];
				}
				else
				{
				  $password = '';
				}
			  $results = $this->sanitize_input();
				$sub_user_update_main_array = array(
					'builder_id' => $this->builder_id,
					'desk_phone' => $results['data']['desk_phone'],
					'mobile_phone' => $results['data']['mobile_phone'],
					'fax' => $results['data']['fax'],
					'login_enabled' => isset($results['data']['login_enabled']) ? "Yes" : "No",
					'username' => $results['data']['username'],
					'password' => $password,
					'accessmethod' => $results['data']['accessmethod'],
					'first_name' => $results['data']['first_name'],
					'last_name' => $results['data']['last_name'],
					'primary_email' => $results['data']['primary_email'],
					'alternative_email' => $results['data']['alter_email'],
					'country' => $results['data']['country'],
					'subcontractor_id' => $results['data']['company_id'],
					'time_zone' => $results['data']['time_zone'],
					'date_format' => $results['data']['date_format'],
					'ub_user_id' => $results['data']['ub_user_id']
				);
					$response = $this->Mod_user->update_sub_user($sub_user_update_main_array);
					$this->Mod_user->response($response);
			  }
			 
			else
			{
			// Get inserted data with help of id
			 $result_data = $this->Mod_user->get_users(array(
			'select_fields' => array('USER.primary_email','USER.alternative_email','USER.country','USER.first_name','USER.last_name','USER.login_enabled','USER.user_status','USER.username','USER.password','USER.date_format','USER.time_zone','USER.desk_phone','USER.mobile_phone','USER.fax','USER.ub_user_id','USER.subcontractor_id'),
			//'join'=> array('builder'=>'Yes'),
			'where_clause' => (array('ub_user_id' =>  $ub_user_id))
			));
			 $data['result_data']  = $result_data['aaData'][0];
		   }
		 
	    }
		else{
		if(!empty($this->input->post()))
		 {
		 //Add check list code
		 $results = $this->sanitize_input();
		// echo '<pre>';print_r($results);exit;
		 $active_till = gmdate("Y-m-d H:i:s", time()+(3600));
		 $random_key = random_string('alnum', 20);
		 $password =  $this->Mod_user->encrypt_password($results['data']['password']);
		if(TRUE === $password['status'])
		{
		  $password = $password['encrypt_password'];
		}
		else
		{
		  $password = '';
		}
		 $insert_sub_user_in_user_table = array(
					'builder_id' => $this->builder_id,
					'desk_phone' => $results['data']['desk_phone'],
					'mobile_phone' => $results['data']['mobile_phone'],
					'fax' => $results['data']['fax'],
					'login_enabled' => isset($results['data']['login_enabled']) ? "Yes" : "No",
					'username' => $results['data']['username'],
					'password' => $password,
					'first_name' => $results['data']['first_name'],
					'accessmethod' => $results['data']['accessmethod'],
					'last_name' => $results['data']['last_name'],
					'primary_email' => $results['data']['primary_email'],
					'alternative_email' => $results['data']['alter_email'],
					'country' => $results['data']['country'],
					'account_type' => 400,
					'role_id' => 5,
					'subcontractor_id' => $results['data']['company_id'],
					'user_status' => 'Active',
					'time_zone' => $results['data']['time_zone'],
					'date_format' => $results['data']['date_format'],
					'random_key' => $random_key,
	                'active_till' => $active_till
					);
					$response = $this->Mod_user->add_sub_user_in_user_table($insert_sub_user_in_user_table);
					$this->Mod_user->response($response);
		}
		}
		//Get all company names according to builder id
         $company_list = $this->Mod_user->get_company_name(array(
                    'select_fields' => array('SUBCONTRACTOR.ub_subcontractor_id','SUBCONTRACTOR.company'),
                    'where_clause' => (array('SUBCONTRACTOR.builder_id' => $this->user_session['builder_id']))
                    ));
        $data['company_list']=array();
        if(TRUE === $company_list['status'])
        {
            $data['company_list'] = $this->Mod_user->build_ci_dropdown_array($company_list['aaData'],'ub_subcontractor_id', 'company');
        }

		//Get date_format from general value table
		$args = array('classification'=>'user_date_format', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$result = $this->Mod_general_value->get_general_value($args);
		$data['user_date_format_array'] = $result['values'];
		//Get the timezone
		$timezone = $this->Mod_timezone->get_timezone();
		$data['time_zone'] = $this->Mod_timezone->build_ci_dropdown_array($timezone, 'diff_from_GMT', 'zone');
		$this->template->view($data);
	}
	
	/** 
	* Add/Update roles and access details
	* 
	* @method: add_userroles 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	*/
	public function add_userroles($role_id = 0)
	{
	     $data = array(
		'title'       		=> "UNIBUILDER",
		'page_id'      		=> 'user',		
		'content'      		=> 'content/user/add_userroles',
		'date_all'			=> 'date_all'
		);
		
		//Get the menu list
		$builderid=$this->user_session['builder_id'];
		$groupby_menuid = 'ACCESSLEVEL.menu_id';
		$menu_list = $this->Mod_role->get_menus(array(
										'select_fields' => array('MENU.menu_name','MENU.ub_menu_id','GROUP_CONCAT(ACCESSLEVEL.access_name ORDER BY ACCESSLEVEL.display_order ASC SEPARATOR ", ") AS access_name'),
										'join'=> array('menu_access_level'=>'Yes'),
										'where_clause' => (array('MENU.menu_active' =>  'Yes')),
										'groupby_clause' => $groupby_menuid,
										'order_clause' => 'MENU.display_order ASC'
										));
		
		$menu_list = $menu_list['menulist'];
		//Below loop will build array for access name
		for($i=0;$i<count($menu_list);$i++)
		{
			$menu_list[$i]['access_name'] = explode(",",$menu_list[$i]['access_name']);
		} 
		$data['menu_list'] = $menu_list;
		
		//Below if is for Saving/Editing the project details
		$edit_role_id = 0;
		$postdata = $this->input->post();
		$edit_role_id = $postdata['ub_role_id'];
		if($role_id > 0 || $edit_role_id > 0)
		{
		 	if(!empty($this->input->post()))
			{
				//update role
				$result = $this->sanitize_input();
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				if(TRUE === $result['status']) //if sanitize is done
				{
					$form_data = $this->forming_data_array($result['data']);
					//Update ROLE details
					$role_update = $form_data['role_data'];
					$role_update['ub_role_id'] = $edit_role_id;
					$update_response = $this->Mod_role->update_role($role_update);
					if(TRUE === $update_response['status'])
					{
						//deleting the role access details
						$delete_access_details = array('builder_id' => $builderid,'role_id' => $edit_role_id);
						$delete_response = $this->Mod_role->delete_access_details($delete_access_details);
						//Insert the role access details for all menus
						for($i=0;$i<count($menu_list);$i++)
						{
							$menu_name = $menu_list[$i]['menu_name'];
							if(isset($result['data'][$menu_name.'_hidden']))
							{
								$access_data = array(
								'builder_id' => $this->user_session['builder_id'],
								'role_id' => $edit_role_id,
								'menu_id' => $menu_list[$i]['ub_menu_id'],
								'access_value' => $this->Mod_role->bintodecimal(implode('',$result['data'][$menu_name.'_hidden'])),
								'access_value_binary' => implode('',$result['data'][$menu_name.'_hidden'])
								);
								//insert into access table
								$insert_access_response = $this->Mod_role->add_access_details($access_data);
								if(FALSE === $insert_access_response['status'])
								{
									$this->Mod_project->response($insert_access_response);
								}
							}
						}
						$this->Mod_project->response($update_response);
					}
					elseif(FALSE === $update_response['status'])
					{
						$this->Mod_project->response($update_response);
					}
				}
				else
				{
					$this->Mod_project->response($result);
				}
				
			}
			else
			{
				//Select role details to display in edit page
				$result_data = $this->Mod_role->get_roles(
				array(
				'select_fields' => array('ROLE.*'),
				'where_clause' => (array('ROLE.ub_role_id' =>  $role_id))
				));
				$data['result_data'] = $result_data['aaData'][0];
				
				//Select the role access details
				$groupby_clause = 'ACCESSLEVEL.menu_id';
				$result_access = $this->Mod_role->get_roles_access(array(
												'select_fields' => array('MENU.menu_name','ACCESSLEVELDETAILS.menu_id',
												'CONV(ACCESSLEVELDETAILS.access_value,10,2) AS access_rights', 'ACCESSLEVELDETAILS.access_value_binary as binary_value','GROUP_CONCAT(ACCESSLEVEL.access_name ORDER BY ACCESSLEVEL.display_order ASC SEPARATOR ", ") AS access_name'),
												'join'=> array('menu_access_level_details'=>'Yes'),
												'where_clause' => (array('ACCESSLEVELDETAILS.role_id' =>  $role_id)),
												'groupby_clause' => $groupby_clause
												));
				if(TRUE === $result_access['status'])
				{
					//Below loop will build array for access name and access rights
					$menu_access_list = $result_access['accessdetails'];
					for($i=0;$i<count($menu_access_list);$i++)
					{
						$access_name_array = explode(",",$menu_access_list[$i]['access_name']);
						$slice_value = count($access_name_array);
						$leading_zeros = 0;
						for($j=0;$j<count($slice_value);$j++)
						{
							$leading_zeros = $leading_zeros."0";
						}
						$access_rights = $leading_zeros.$menu_access_list[$i]['binary_value'];
						$access_rights = substr($access_rights, "-".$slice_value);
						$menu_access_list[$i]['access_name'] = $access_name_array;
						$menu_access_list[$i]['access_rights'] = str_split($access_rights);
					} 
					$data['menu_access_list'] = $menu_access_list;
				}
				 
			}
			 // echo "<pre>"; print_r($data['menu_access_list']);exit;
		}
		else 
		{
			if(!empty($this->input->post())) //this condition will insert the role details
			{
				// Add role
				$result = $this->sanitize_input();
				// echo '<pre>';print_r($result['data']);exit;
				if(isset($result['data']['save_type']))
				{
					unset($result['data']['save_type']);
				}
				if(TRUE === $result['status']) //if sanitize is done
				{
					$form_data = $this->forming_data_array($result['data']);
					 // echo "<pre>";print_r($form_data);exit;
					if(isset($form_data['role_data'])) //if role details are entered
					{
						$role_response = $this->Mod_role->add_role($form_data['role_data']);
						if(TRUE === $role_response['status'])
						{
							$new_role_id = $role_response['ub_role_id'];
							//Insert the role access details for all menus
							for($i=0;$i<count($menu_list);$i++)
							{
								$menu_name = $menu_list[$i]['menu_name'];
								if(isset($result['data'][$menu_name]))
								{
									$access_data = array(
									'builder_id' => $this->user_session['builder_id'],
									'role_id' => $new_role_id,
									'menu_id' => $menu_list[$i]['ub_menu_id'],
									'access_value' => $this->Mod_role->bintodecimal(implode('',$result['data'][$menu_name.'_hidden'])),
									'access_value_binary' => implode('',$result['data'][$menu_name.'_hidden'])
										);
									//insert into access table
									$insert_access_response = $this->Mod_role->add_access_details($access_data);
									if(FALSE === $insert_access_response['status'])
									{
										$this->Mod_project->response($insert_access_response);
									}
								}
							}
						}
						elseif(FALSE === $role_response['status'])
						{
							$this->Mod_project->response($role_response);
						}
					}
					$this->Mod_project->response($role_response);	
				}
				else
				{
					$this->Mod_project->response($result);
				}
			}
		}
		$this->template->view($data);
	}
	public function user_roles()
	{
	//echo "Hello"; exit;
	$this->module = 'USERROLES';
		$data = array(
		'title'       		=> "UNIBUILDER",
		'page_id'      		=> 'user',		
		'content'      		=> 'content/user/user_roles',
		'date_all'			=> 'date_all',
		'data_table'        => 'data_table',
		'user_roles'        => 'user_roles',
		'search_session_array' => $this->uni_session_get('SEARCH')
       );
		
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
		$apply_filter = false;;
		}
		
		$data['apply_filter'] = $apply_filter;
		$this->template->view($data);
	}
	/** 
	 * get_user_roles
	 * 
	 * @package: user_roles
	 * @subpackage: user_roles
	 * @category: user_roles
	 * @author: Gayathri
	 * @createdon(DD-MM-YYYY): 19-04-2015 16:13
	*/
	public function get_user_roles()
	{
		// echo "hiiii"; exit;
		$post_array[] = array(
							'field_name' => 'ROLE.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
			
		/* $other_where = '';
		$other_where = ' OR (ROLE.ub_role_id = "4") '; */
					
							
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			
			if(TRUE === $result['status'])
			{
				 	$search_session_array = array();
				if(isset($result['data']['role_name']) && $result['data']['role_name']!='' && $result['data']['role_name'] != 'null')
				// echo '<pre>';print_r($result['data']['role_name']);exit;
				{
					$post_array[] = array(
								'field_name' => 'ROLE.role_name',
								'value'=> $result['data']['role_name'], 
								'type' => 'like'
							);
					 $search_session_array['role_name'] = $result['data']['role_name'];
				}
				$this->module = 'USERROLES';
				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = $result['data']['iDisplayStart'];
				$search_session_array['iDisplayLength'] = $result['data']['iDisplayLength'];
				$this->uni_set_session('search', $search_session_array);
				// Setting session 
				$this->uni_set_session('search', $search_session_array);
				
				$where_str = $this->Mod_user->build_where($post_array);
				/* if($other_where != '')
				{
					$where_str = $where_str.$other_where;
				} */
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_user->get_user_roles(array(
												'select_fields' => array('COUNT(ROLE.ub_role_id) AS total_count'),
					                             'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
												
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'ROLE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'ROLE.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_user->response($result);
			}
		}
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('ROLE.ub_role_id','ROLE.builder_id', 
		'ROLE.role_name','ROLE.role_active','ROLE.description'),
		'join'=> array('builder'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_user->get_user_roles($query_array);
		
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

		$this->Mod_user->response($result_data);
	}
	
	
	public function delete_userroles()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_user->delete_user($result['data']);
				$search_session_array['iDisplayStart'] = 0;
				$this->uni_set_session('search', $search_session_array);
			}
			else
			{
				$this->Mod_user->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_user->response($response);
	}
	
	public function apply_saved_search_userroles()
	{
		/* Apply Filter code starts here */
		   $this->module = 'USERROLES';
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
				$this->Mod_user->response($response);
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
			if(!empty($unserialized_data['role_name']))
			{
				$search_session_array['role_name'] =$unserialized_data['role_name'];
			}
			if(!empty($unserialized_data['role_active']))
			{
				$search_session_array['role_active'] =$unserialized_data['role_active'];
			}
			
			$this->uni_set_session('search', $search_session_array);
			$this->Mod_user->response($result_data);
			}
		}
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
		$form_data['role_data'] = array(
					'builder_id' => $this->user_session['builder_id'],
					'role_name' => $data['role_name'],
					'description' => $data['description'],
					'role_active' => isset($data['role_active']) ? "Yes" : "No");
		
		return $form_data;
	}


	/** 
	* Get get_sub_contractor
	* 
	* @method: get_sub_contractor 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* created by : chandru
	*/	
	public function get_sub_users()
	{
		$post_array[] = array(
							'field_name' => 'UB_SUBCONTRACTOR.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'USER.role_id',
							'value'=> 5, 
							'type' => '='
							);
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			
			if(TRUE === $result['status'])
			{
				
				$search_session_array = array();
				if(isset($result['data']['company_name']) && $result['data']['company_name']!='' && $result['data']['company_name'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'UB_SUBCONTRACTOR.company',
								'value'=> $result['data']['company_name'], 
								'type' => '='
							);
					 $search_session_array['first_name'] = $result['data']['company_name'];
				}
				// Setting session 
				$this->module = 'SUBUSERS';
				$this->uni_set_session('search', $search_session_array);
				
				$where_str = $this->Mod_user->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_user->get_sub_users(array(
												'select_fields' => array('COUNT(USER.ub_user_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('UB_SUBCONTRACTOR'=>'Yes'),
												));
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'UB_SUBCONTRACTOR.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'UB_SUBCONTRACTOR.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_user->response($result);
			}
		}
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('USER.primary_email','USER.alternative_email','USER.country','USER.first_name','USER.login_enabled','USER.user_status','UB_SUBCONTRACTOR.company','CONCAT_WS(" ", USER.first_name, USER.last_name) as fullname','USER.desk_phone','USER.subcontractor_id','USER.ub_user_id'),
		'join'=> array('UB_SUBCONTRACTOR'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_user->get_sub_users($query_array);

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
		$this->Mod_user->response($result_data);
	}
	 
	public function apply_saved_search_sub_user()
	{
		/* Apply Filter code starts here */
		   $this->module = 'SUBUSERS';
		   $post_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => 'SUBUSERS'
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
			//echo '<pre>';print_r($result_data);exit;									 
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
			}else{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
				}
		}else{
		 $serialized_data = $result_data['aaData'][0]['search_params'];
		 $remove_single_quote = str_replace("'", '', $serialized_data);
		 $unserialized_data = unserialize($remove_single_quote);
		 $result_data['aaData'][0]['search_params'] = $unserialized_data;
		 if(!empty($unserialized_data))
		 {
			
			
			if(!empty($unserialized_data['first_name']))
			{
				$search_session_array['first_name'] =$unserialized_data['first_name'];
			}
			
			
			$this->uni_set_session('search', $search_session_array);
			$this->Mod_user->response($result_data);
			}
		}
	/* Apply Filter code Ends here */
	}
	
	public function changepassword()
	{	
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/changepassword/changepassword',
		'page_id'      => 'changepassword'
		);
		$this->template->view($data);
	}
	/** 
	* Validate old password
	* 
	* @method: check_old_password 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* created by : Devansh
	*/
	public function check_old_password()
	{
		if(!empty($this->input->post()))
		{
		  $result = $this->sanitize_input();
		  if(TRUE === $result['status'])
		  {
		  	$password =  $this->Mod_user->encrypt_password($result['data']['password']);
				if(TRUE === $password['status'])
				{
					$result['data']['password'] = $password['encrypt_password'];
				}
				else
				{
					$result['data']['password'] = '';
				}
				$result['data']['ub_user_id'] = $this->user_session['ub_user_id'];
				$response = $this->Mod_user->check_old_password($result['data']);
				$this->Mod_user->response($response);
		  }
		}
	}

	/** 
	* function to change password
	* 
	* @method: change_password 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* created by : Devansh
	*/
	public function change_password()
	{
		if(!empty($this->input->post()))
		{
		  $result = $this->sanitize_input();
		  //print_r($result);exit;
			if(TRUE === $result['status'])
			{
				$old_password = $result['data']['password'];
			    unset($result['data']['password']);
			  	unset($result['data']['confirm_password']);

			  	/*$old_encrypt_password =  $this->Mod_user->encrypt_password($old_password);

			  	$result = $this->get_users(array(
								'select_fields' => array('USER.password'),
								'where_clause' => array('USER.username' => $post_array['username'])
								));*/

			  	$password =  $this->Mod_user->encrypt_password($result['data']['new_password']);
				if(TRUE === $password['status'])
				{
					$result['data']['password'] = $password['encrypt_password'];
				}
				else
				{
					$result['data']['password'] = '';
				}
				unset($result['data']['new_password']);
				$result['data']['ub_user_id'] = $this->user_session['ub_user_id'];
				$response = $this->Mod_user->update_user($result['data']);
				$this->Mod_user->response($response);	
			}
		}
	}
	/** 
	* Forbidden page
	* 
	* @method: user_forbidden_page 
	* @access: public 
	* @param: 
	* @return: array
	* URL : dXNlci91c2VyX2ZvcmJpZgxf1Rlbl9wYWdlLw--
	*/
	public function user_forbidden_page()
	{
		$data = array(
		'title'        		=> 'PROJECTS',		
		'content'      		=> 'common/forbidden',
		'page_id'      		=> 'projects',
		'data_table'  		=> 'data_table',
		'project_list' 		=> 'project_list',      
		'date_all'	   		=> 'date_all',
		); 
		$this->template->view($data);
	}
     /** 
		* warning page for builder
		* 
		* @method: builder_forbidden_page 
		* @access: public 
		* @param: 
		* @return: array
		* URL : dXNlci9idWlsZgxf1VyX3dhcm5pbmdfcgxf1FnZQ--
	 */
	public function builder_warning_page()
	{
	
		$data = array(
		'title'        		=> 'User',		
		'content'      		=> 'common/exceed_limit_warning_page',
		); 
		$this->template->view($data);
	}
}