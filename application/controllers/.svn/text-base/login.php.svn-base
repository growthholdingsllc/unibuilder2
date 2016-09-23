<?php 
/** 
 * Login Class
 * 
 * @package: Login
 * @subpackage: Login
 * @category: Login
 * @author: MS
 * @createdon(DD-MM-YYYY): 12-03-2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends UNI_Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
    {
		//Parent constructor
        parent::__construct();	
		$this->load->model(array('Mod_login','Mod_user','Mod_role','Mod_survey'));
    }
	
	/** 
	* Login index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True 
	*/
	
	public function index()
	{
		$this->load->view('content/login/login');
	}
	/** 
	*login_submit method
	* 
	* @method: login_submit 
	* @access: public 
	* @param:  
	* @return: json array 
	*/
	public function login_submit()
	{
		//sanitize_input will Clean the data transferred to the sever before submitting to model
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			if( ! empty($post_array['data']))
			{
				$enc_password = $this->Mod_login->encrypt_password($post_array['data']['password']);
				$post_array['data']['password'] = $enc_password['encrypt_password'];
				$response = $this->Mod_login->login_check($post_array['data']);
				//Code for different dashboard according to user type
				if(isset($response['account_type']['ACCOUNT_TYPE'])){
				switch ($response['account_type']['ACCOUNT_TYPE']) {
				case BUILDERADMIN:
					$response['dashbord_url'] = 'builder_dashboard/index/';
					break;
				case OWNER:
					$response['dashbord_url'] = 'owner_dashboard/index/';
					/* $response['dashbord_url'] = 'builder_dashboard/index/'; */
					break;
				case SUBCONTRACTOR:
					$response['dashbord_url'] = 'subcontractor_dashboard/index/';
					/* $response['dashbord_url'] = 'builder_dashboard/index/'; */
					break;
				}
			   }//exit;
				//print_r($response);exit;
			}
			else
			{
				$response['status'] = FALSE;
				// $response['message'] = 'Post array is empty';
			}
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_login->response($response);
	}
	
	/** 
	* Forgot password action, generate link and send to user primary mailid
	* 
	* @method: forgot_password 
	* @access: public 
	* @param:  user_name
	* @return: json array 
	*/
	
	public function forgot_password()
	{
		//sanitize_input will Clean the data transferred to the sever before submitting to model
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			$response = $this->Mod_login->forgot_password($post_array['data']['user']);
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_login->response($response);
	}
	
	/** 
	* Reset password form will redirect the user to password reset form
	* 
	* @method: reset_password_form 
	* @access: public 
	* @param: username
	* @return: True 
	*/
	
	public function reset_password_form($username = '')
	{	
		if( $username != '' )
		{
			$post_array = array('username' => $username, 'active_till >= ' => TODAY );
			// Fetch Data all records based on conditions
			$result_data = $this->Mod_user->get_users(array(
				'where_clause' => $post_array
				));
			if(TRUE === $result_data['status'])
			{
				 $data = array(
				'title'        => "UNIBUILDER",		
				'content'      => 'content/login/login',
				'resetForm'	   =>'resetForm',
				'username' =>$username
						
				);								
				$this->load->view('content/login/login',$data);
			}
			else
			{
				 $data = array(
				'title'        => "UNIBUILDER",		
				'content'      => 'content/login/login',
				'resetstatus'  =>'resetstatus'						
				);
				$this->load->view('content/login/login',$data);
				
			}
		}
		else
		{
			$response['status'] = FALSE;
			// $response['message'] = 'Invalid username or time lapsed';
		}
	}
	
	/** 
	*reset_password method will reset the user password
	* 
	* @method: reset_password 
	* @access: public 
	* @param:  
	* @return: json array 
	*/
	public function reset_password()
	{
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			$enc_password = $this->Mod_login->encrypt_password($post_array['data']['confirmpassword']);
			$data = array('password' => $enc_password['encrypt_password']);
			$where = array('username' => $post_array['data']['username']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
			if(TRUE == $result)
			{
				$response['status'] = TRUE;
				$response['message'] = 'Success message will come here';
			}
			else
			{
				$response['status'] = FALSE;
				$response['message'] = 'Failed message will come here';
			}
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_login->response($response);
	}
	
	/** 
	*change_password method will update user password with new password
	* 
	* @method: change_password 
	* @access: public 
	* @param:  
	* @return: json array 
	*/
	public function change_password()
	{
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			$enc_password = $this->Mod_login->encrypt_password($post_array['data']['newpassword']);
			$data = array('password' => $enc_password['encrypt_password']);
			$where = array('ub_user_id' => $post_array['data']['userid']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
			if(TRUE == $result)
			{
				$response['status'] = TRUE;
				$response['message'] = 'Success message will come here';
			}
			else
			{
				$response['status'] = FALSE;
				$response['message'] = 'Failed message will come here';
			}
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_login->response($response);
	}
	
	/** 
	* Logou method
	* 
	* @method: logout 
	* @access: public 
	* @param:  
	* @return: destroy the session and redirect to login page 
	*/
	
	public function logout()
	{
		/* Below code was added by chandru for update logout time 0n 13-10-2015 */
		$session_array = $this->session->all_userdata();
		$account_type = $this->session->userdata('ACCOUNT_TYPE');
		if(isset($session_array['ACCOUNT'][$account_type]['USER']['ub_user_id']) && !empty($session_array['ACCOUNT'][$account_type]['USER']['ub_user_id']))
		{
			$ub_user_id = $session_array['ACCOUNT'][$account_type]['USER']['ub_user_id'];
			$data = array('last_logout_time' => TODAY, 'modified_by' => $ub_user_id, 'modified_on' =>TODAY);
			$where = array('ub_user_id' => $ub_user_id);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
		}
		$session_destroy = array();
		$session_destroy['logout'] = "Yes";
		$result = $this->Mod_login->destroy_session($session_destroy);
		$this->load->view('content/login/login');
	}
	/*** Survey Request Save page
	* 
	* @method: auto_login
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: Sidhartha
	* @URL: c3VydmV5L2F1dgxf19fbgxf19naW4v
	*/
	public function auto_login($ub_survey_id = 0,$ub_user_id = 0, $project_id =0)
	{
		/* echo "survey id".$ub_survey_id;
		echo "user_id".$ub_user_id;
		echo "project_id".$project_id;exit;  */
		
		$user_data = $this->Mod_user->get_users(array(
			'select_fields' => array('USER.username','USER.password','USER.user_status'),
			'where_clause' => (array('USER.ub_user_id' =>  $ub_user_id))
			));
		//print_r($user_data);exit;
		$login_check = array('username'=>$user_data['aaData'][0]['username'],'password'=>$user_data['aaData'][0]['password']);
		//$response = $this->Mod_login->login_check($login_check);
		
		$result_data = $this->Mod_survey->get_survey(array(
				'select_fields' => array('UB_SURVEY.assigned_users'),
				'where_clause' => (array('ub_survey_id' =>  $ub_survey_id))));
		//$asign_users = explode(",",$result_data['aaData'][0]['assigned_users']);
		//print_r($result_data);exit;
		 //echo '<pre>';print_r($result_data);exit;
		if(TRUE === $result_data['status'])
		{
			$asign_users = explode(",",$result_data['aaData'][0]['assigned_users']);
			//$data['survey_data']  = $result_data['aaData'][0];
			if (in_array($ub_user_id, $asign_users)) {
		    $response = $this->Mod_login->login_check($login_check);
			if($response['status']==TRUE)
			{
			  redirect(base_url().$this->crypt->encrypt('survey/save_survey_request/'.$ub_survey_id));
			}
			else
			{
			  redirect(base_url().$this->crypt->encrypt('login/login/'));
			}
		  }
			else
			{
			//echo "hi";exit;
			 redirect(base_url().$this->crypt->encrypt('login/login/'));
			}
		}
		else{
		 redirect(base_url().$this->crypt->encrypt('login/login/'));
		}
				
		//print_r($response);exit;
		
		
		
	}
}