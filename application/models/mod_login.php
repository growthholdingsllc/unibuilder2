<?php
/** 
 * Login Model
 * 
 * @package: Login Model
 * @subpackage: Login Model 
 * @category: Login
 * @author: MS
 * @createdon(DD-MM-YYYY): 12-03-2015
*/
class Mod_login extends UNI_Model
{
    /**
	 * @constructor
	 */
	 
	public function __construct() 
	{
		parent::__construct();
		$this->load->model(array('Mod_mail','Mod_user','Mod_builder'));
    }
	
	/** 
	*login_check method will check the user login credentials in ub_user table
	* 
	* @method: login_check
	* @access: public 
	* @param: post data
	* @return: Boolean value 
	*/
	
	public function login_check($post_array = array())
	{
		$response_ary = array();
		$session_id = $this->session->userdata('session_id');
		$ip_address = $this->input->ip_address();
		$user_agent = $this->input->user_agent();
		$field_values = array();
		$post_array['user_status'] = 'Active';
		// Fetch Data all records based on conditions
		$data = $this->Mod_user->get_users(array(
			'where_clause' => $post_array
			));
			// echo '<pre>';print_r($data);exit;
		$result_data = array();
		if(TRUE === $data['status'])
		{
			$builder_details_array = $this->Mod_builder->get_builder_details(array(
													'select_fields' => array('BUILDER_DETAILS.payment_status'),
													'where_clause' => array('ub_builder_id'=>$data['aaData'][0]['builder_id'])
													));	
			if(TRUE == $builder_details_array['status'])
			{
				$builder_payment_status = $builder_details_array['aaData']['0']['payment_status'];
			}else{
				$builder_payment_status = '';
			}
			$allow_type = 1;
			if(($builder_payment_status == 'Success') || ($data['aaData'][0]['account_type'] == UNIADMIN) || ($allow_type == 1))
			{
				$result_data = $data['aaData'][0];
				// Updating user table with last_login_time
				$data = array('last_login_time' => TODAY);
				$where = array('ub_user_id' => $result_data['ub_user_id']);
				$result = $this->Mod_user->update_data(UB_USER, $data, $where);
				$field_values = array('username' => $post_array['username'],
						'session_id' => $session_id,
						'ip_address' => $ip_address,
						'user_agent' => $user_agent,
						'created_by' => $result_data['ub_user_id'],
						'modified_by' => $result_data['ub_user_id']
						);
				if(TRUE === $result['status'])
				{
					// Inserting data into Ub_accesslog table
					$field_values['user_id'] = $result_data['ub_user_id'];
					$field_values['username'] =  $result_data['username'];
					$field_values['login_success'] = 'Yes';
					$field_values['login_time']=TODAY;
					$insert_result = $this->Mod_user->insert_data(UB_USER_ACCESS_LOG, $field_values);
					
					$response_ary['status'] =  TRUE;
					$response_ary['re_direct_status'] =  FALSE;
					//$response_ary['message'] = 'Success message will come here';
				}
				else
				{
					// Inserting data into Ub_accesslog table
					$insert_result = $this->Mod_user->insert_data(UB_USER_ACCESS_LOG, $field_values);
					$response_ary['status'] =  FALSE;
					$response_ary['re_direct_status'] =  FALSE;
					$response_ary['message'] = 'Access log updation failed';
				}
				// Setting session for account type
				$account_type = $this->session->userdata('ACCOUNT_TYPE');
				if(isset($account_type) && $account_type != '')
				{
					$response_ary['status'] =  FALSE;
					$response_ary['re_direct_status'] =  FALSE;
					$response_ary['message'] = 'Already a user logged into unibuilder account, please use different browser to login to new account';
				}
				else
				{
					$user_data = array('ACCOUNT_TYPE' => $result_data['account_type']); 
					$this->session->set_userdata($user_data);
					
					//take account type for dashboard by sidhartha
					$response_ary['account_type'] = $user_data;

					//Pass to a new function to get the user_preferences by sidhartha
					$user_preference = array('mail_preferences' => $result_data['mail_preferences'], 'sms_preferences' => $result_data['sms_preferences']);
					$build_user_preference_array  = $this->user_preference_roles($user_preference); 
					$result_data['mail_preferences'] = $build_user_preference_array['mail_preferences'];
					$result_data['sms_preferences'] = $build_user_preference_array['sms_preferences'];
					
					//get role access right details
					$role_result = $this->Mod_user->get_role_access_details($result_data['role_id']);
					$result_data['role_access'] = $role_result;
					
					// Setting session for this logged in user
					$user_data = array('ACCOUNT' => array($result_data['account_type'] => array('USER' => $result_data))); 
					$this->session->set_userdata($user_data);
				}
			}else{
				$field_values = array('session_id' => $session_id,
					'username' => $post_array['username'],
					'ip_address' => $ip_address,
					'user_agent' => $user_agent
					);
				// Inserting data into Ub_accesslog table
				$insert_result = $this->Mod_user->insert_data(UB_USER_ACCESS_LOG, $field_values);
				if(($data['aaData'][0]['account_type'] == BUILDERADMIN) && ($data['aaData'][0]['role_id'] == BUILDER_ADMIN_ROLE_ID))
				{
					$redirect_url = $this->Mod_builder->builder_redirect_url($data['aaData'][0]['builder_id']);
					if(TRUE == $redirect_url['status'])
					{
						$response_ary['status'] =  FALSE;
						$response_ary['re_direct_status'] =  TRUE;
						$response_ary['re_direct_url'] =  $redirect_url['reset_link'];
						$response_ary['message'] = 'For your current plan the payment has not done. Please make payment';
					}else{
						$response_ary['status'] =  FALSE;
						$response_ary['re_direct_status'] =  FALSE;
						$response_ary['message'] = 'For your current plan the payment has not done. Please contact admin or proceed with payment. Payment link already send to your registered Email address';
					}
				}else{
					$response_ary['status'] =  FALSE;
					$response_ary['re_direct_status'] =  FALSE;
					$response_ary['message'] = 'Login failed, please contact your Builder';
				}
			}
		}
		else
		{
			$field_values = array('session_id' => $session_id,
					'username' => $post_array['username'],
					'ip_address' => $ip_address,
					'user_agent' => $user_agent
					);
			// Inserting data into Ub_accesslog table
			$insert_result = $this->Mod_user->insert_data(UB_USER_ACCESS_LOG, $field_values);
					
			$response_ary['status'] =  FALSE;
			$response_ary['re_direct_status'] =  FALSE;
			$response_ary['message'] = 'Invalid user details';
		}
		return $response_ary;
	}
	
	/** 
	*forgot_password method will check the user is valid if yes then send link to user mail id
	* 
	* @method: forgot_password
	* @access: public 
	* @param: post data
	* @return: Boolean value 
	*/
	
	public function forgot_password($post_array = array())
	{
		$response_ary = array();
		$post_array['user_status'] = 'Active';
		// Fetch Data all records based on conditions
		$res_data = $this->Mod_user->get_users(array(
			'select_fields' => array('ub_user_id', 'primary_email', 'first_name', 'username'),
			'where_clause' => $post_array
			));
		$data_arry = array();
		if(TRUE === $res_data['status'])
		{
			$data_arry = $res_data['aaData'][0];
			//Updating ub_user table with random_key and active_till fields
			$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
			$data = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
			$where = array('ub_user_id' => $data_arry['ub_user_id']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
			if(TRUE === $result['status'])
			{
				$reset_link = base_url().$this->crypt->encrypt('login/reset_password_form/'.$data_arry['username']);
				//$reset_link = base_url().$this->crypt->encrypt('login/reset_password_form/');
				$content_array = array(
				'TO_EMAIL' => $data_arry['primary_email'],
				'TO_NAME' => $data_arry['first_name'],
				'FIRST_NAME' => $data_arry['first_name'],
				'RESET_LINK' => $reset_link,
				'SEND_MAIL_INFO' => $data_arry['first_name'].EMAIL_SEPERATOR_LEVEL2.$data_arry['primary_email']
				);
				$this->Mod_mail->send_mail('SEND_FORGOT_PASSWORD_EMAIL', $content_array, 'yes');
				$response_ary['status'] =  TRUE;
				$response_ary['message'] = 'Password generation link sent to registered email id';
			}
			else
			{
				$response_ary['status'] =  FALSE;
				$response_ary['message'] = 'Failed, try again';
			}
		}
		else
		{
			$response_ary['status'] =  FALSE;
			$response_ary['message'] = 'Invalid user';
		}
		return $response_ary;
	}
	
	/** 
	*reset_password method will reset user password
	* 
	* @method: reset_password
	* @access: public 
	* @param: post data
	* @return: Boolean value 
	*/
	
	public function reset_password($post_array = array())
	{
		$this->read_db->select($select_fileds);
		$this->read_db->from(UB_USER);	//UB_USER is the table name defined in constant file
		$this->read_db->where($post_array);
		$res = $this->read_db->get();
		$data = array();
		if($res->num_rows() > 0)
		{
			return $data = $res->row_array();
		}
		else
		{
			return $data;
		}
	}
	/** 
	*user_preference_roles methods for unserialize the user preferences and build user roles
	* 
	* @method: reset_password
	* @access: public 
	* @param: post data
	* @return: Boolean value
	* @author: Sidhartha 
	*/
	public function user_preference_roles($user_preference = array())
	{
		//mail preference array by sidhartha
	    //Unseralize records of mail preferences
		$serialized_mail_preferences = $user_preference['mail_preferences'];
	    $remove_single_quote_mail_preferences = str_replace("'", '', $serialized_mail_preferences);
	    $unserialized_mail_preferences = unserialize($remove_single_quote_mail_preferences);
	    $user_preference['mail_preferences'] = $unserialized_mail_preferences;

	    //sms preference array by sidhartha
	    //Unseralize records of sms preferences
	    $serialized_mail_preferences = $user_preference['sms_preferences'];
	    $remove_single_quote_mail_preferences = str_replace("'", '', $serialized_mail_preferences);
	    $unserialized_mail_preferences = unserialize($remove_single_quote_mail_preferences);
	    $user_preference['sms_preferences'] = $unserialized_mail_preferences;

	    return $user_preference;

	}

	/** 
	*update_session method will update the user login credentials in ub_user table
	* 
	* @method: update_session
	* @access: public 
	* @param: post data
	* @return: Boolean value 
	*/
	
	public function update_session($post_array = array())
	{
		$response_ary = array();
		$session_id = $this->session->userdata('session_id');
		$ip_address = $this->input->ip_address();
		$user_agent = $this->input->user_agent();
		$field_values = array();
		$post_array['user_status'] = 'Active';
		// Fetch Data all records based on conditions
		$data = $this->Mod_user->get_users(array(
			'where_clause' => $post_array
			));
		$result_data = array();
		if(TRUE === $data['status'])
		{	
			$result_data = $data['aaData'][0];
			// Updating user table with last_login_time
			$data = array('last_login_time' => TODAY);
			$where = array('ub_user_id' => $result_data['ub_user_id']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
			$field_values = array('username' => $result_data['username'],
					'session_id' => $session_id,
					'ip_address' => $ip_address,
					'user_agent' => $user_agent,
					'created_by' => $result_data['ub_user_id'],
					'modified_by' => $result_data['ub_user_id']
					);
			if(TRUE === $result['status'])
			{
				// Inserting data into Ub_accesslog table
				$field_values['user_id'] = $result_data['ub_user_id'];
				$field_values['username'] =  $result_data['username'];
				$field_values['login_success'] = 'Yes';
				$field_values['login_time']=TODAY;
				$insert_result = $this->Mod_user->insert_data(UB_USER_ACCESS_LOG, $field_values);
				
				$response_ary['status'] =  TRUE;
				//$response_ary['message'] = 'Success message will come here';
			}
			else
			{
				// Inserting data into Ub_accesslog table
				$insert_result = $this->Mod_user->insert_data(UB_USER_ACCESS_LOG, $field_values);
				$response_ary['status'] =  FALSE;
				$response_ary['message'] = 'Access log insertion failed';
			}
			// Setting session for account type
			$user_data = array('ACCOUNT_TYPE' => $result_data['account_type']); 
			$this->session->set_userdata($user_data);
			
			//take account type for dashboard by sidhartha
			$response_ary['account_type'] = $user_data;

			//Pass to a new function to get the user_preferences by sidhartha
			$user_preference = array('mail_preferences' => $result_data['mail_preferences'], 'sms_preferences' => $result_data['sms_preferences']);
			$build_user_preference_array  = $this->user_preference_roles($user_preference); 
		    $result_data['mail_preferences'] = $build_user_preference_array['mail_preferences'];
		    $result_data['sms_preferences'] = $build_user_preference_array['sms_preferences'];

		    //get role access right details
			$role_result = $this->Mod_user->get_role_access_details($result_data['role_id']);
		    $result_data['role_access'] = $role_result;
		    
			// Setting session for this logged in user
			$user_data = array('ACCOUNT' => array($result_data['account_type'] => array('USER' => $result_data))); 
			$this->session->set_userdata($user_data);
		}
		else
		{
			$field_values = array('session_id' => $session_id,
					'username' => $result_data['username'],
					'ip_address' => $ip_address,
					'user_agent' => $user_agent
					);
			// Inserting data into Ub_accesslog table
			$insert_result = $this->Mod_user->insert_data(UB_USER_ACCESS_LOG, $field_values);
					
			$response_ary['status'] =  FALSE;
			$response_ary['message'] = 'Invalid user details';
		}
		return $response_ary;
	}
    /** 
	*forgot_password method will check the admin user is valid if yes then send link to user mail id
	* 
	* @method: admin_forgot_password
	* @access: public 
	* @param: post data
	* @return: Boolean value
    * @author: Pranab	
	*/
	
	public function admin_forgot_password($post_array = array())
	{
		$response_ary = array();
		
		$res_data = $this->Mod_user->get_users(array(
			'select_fields' => array('ub_user_id', 'primary_email', 'first_name', 'username'),
			'where_clause' => array('username'=>$post_array)
			));
		$data_arry = array();
		if(TRUE === $res_data['status'])
		{
			$data_arry = $res_data['aaData'][0];
			//Updating ub_user table with random_key and active_till fields
			$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
			$data = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
			$where = array('ub_user_id' => $data_arry['ub_user_id']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
			if(TRUE === $result['status'])
			{
				$reset_link = base_url().$this->crypt->encrypt('admin/login/accept_invite/'.$data_arry['ub_user_id'].'/'.$data_arry['username']);
				//$reset_link = base_url().$this->crypt->encrypt('login/reset_password_form/');
				$content_array = array(
				'TO_EMAIL' => $data_arry['primary_email'],
				'TO_NAME' => 'MS',
				'FIRST_NAME' => $data_arry['first_name'],
				'RESET_LINK' => $reset_link,
				'SEND_MAIL_INFO' => $data_arry['first_name'].EMAIL_SEPERATOR_LEVEL2.$data_arry['primary_email']
				);
				$this->Mod_mail->send_mail('SEND_FORGOT_PASSWORD_EMAIL', $content_array, 'yes');
				$response_ary['status'] =  TRUE;
				$response_ary['message'] = 'Mail send to '.$data_arry['primary_email'].' Sucessfully';
			}
			else
			{
				$response_ary['status'] =  FALSE;
				$response_ary['message'] = 'Failed to send mail';
			}
		}
		else
		{
			$response_ary['status'] =  FALSE;
			$response_ary['message'] = 'Failed to send mail';
		}
		return $response_ary;
	 }
	}
/* End of file mod_login.php */
/* Location: ./application/models/mod_login.php */