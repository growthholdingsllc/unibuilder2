<?php 
/** 
 * Unibuilder Admin Login Class
 * 
 * @package: Unibuilder Admin
 * @subpackage: Unibuilder Admin
 * @category: Unibuilder Admin
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 21-05-2015
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
		$this->load->model(array('Mod_login','Mod_user','Mod_role','Mod_signup'));
    }
	
	/** 
	* Login index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True 
	* Access URL : YWRtaW4vbgxf19naW4vaW5kZXgv
	*/
	
	public function index()
	{
		$this->load->view('admin/content/login/login');
	}
	
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
				if(isset($response['account_type']['ACCOUNT_TYPE']) && $response['account_type']['ACCOUNT_TYPE'] == UNIADMIN){
					$response['redirect_url'] = 'admin/dashboard/index';
			    }
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
	
	public function forgot()
	{
		$this->load->view('admin/content/login/forgot');
	}
	
	public function newaccount()
	{
		$this->load->view('admin/content/login/signup');
	}
	public function accept_invite($ub_user_id='',$username='')
	{		
	   $data = array(
				'title'        => "Signup",		
				'content'      => 'admin/content/login/login_activation',
				'accept'	   =>'accept',
				'ub_user_id' =>$ub_user_id,
				'username'  => $username
				);
			
		$this->load->view('admin/content/login/login_activation',$data);
	}
	public function save_password()
	{
	     if(!empty($this->input->post()))
		    {
			  $result = $this->sanitize_input();
			 
			  $password =  $this->Mod_user->encrypt_password($result['data']['password']);
			  $confirm_password =  $this->Mod_user->encrypt_password($result['data']['confirm_password']);
			  if(TRUE === $password['status'])
			  {
				$password = $password['encrypt_password'];
			  }
			  else
			  {
				$password = '';
			  }
			  if(TRUE === $confirm_password['status'])
			  {
				$confirm_password = $confirm_password['encrypt_password'];
			  }
			  else
			  {
				$confirm_password = '';
			  }
			  $insert_array = array(
			  	'system_provided_user_name' => $result['data']['system_provided_user_name'],
			  	'ub_user_id' =>   $result['data']['ub_user_id'],
			  	'username' =>   $result['data']['username'],
			  	'password' =>   $password,
			  	'confirm_password' =>   $confirm_password,
			  	);
			  $response = $this->Mod_signup->update_user($insert_array);
			  $this->Mod_signup->response($response);
			}
								
		
	}
    public function forgot_password()
	{
	    $data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/login/forgot'		
		);
		//sanitize_input will Clean the data transferred to the sever before submitting to model
		$post_array = $this->sanitize_input();

		if(TRUE === $post_array['status'])
		{
			$response = $this->Mod_login->admin_forgot_password($post_array['data']['username']);
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_login->response($response);
		$this->template->view($data);
	}
	public function logout()
	{
		/* Below code was added by chandru for update logout time on 13-10-2015 */
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
		$this->load->view('admin/content/login/login');
	}
}