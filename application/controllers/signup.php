<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Signup Class
 * 
 * @package: Signup
 * @subpackage: Signup
 * @category: Signup
 * @author: sidhartha
 * @createdon(DD-MM-YYYY): 30-04-2015 
*/
class Signup extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_user','Mod_signup','Mod_login'));	
    }
    /** 
	* Index function
	* 
	* @method: index 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL2luZgxf1V4Lw--
	*/	
	public function index($ub_user_id = '')
	{	
		if( $ub_user_id != '' )
		{
			$post_array = array('ub_user_id' => $ub_user_id, 'active_till >= ' => TODAY);
			// Fetch Data all records based on conditions
			$result_data = $this->Mod_user->get_users(array(
				'where_clause' => $post_array
				));
			if( TRUE === $result_data['status'])
			{
				 $data = array(
				'title'        => "Signup",		
				'content'      => 'content/signup/signup',
				'accept'	   =>'accept',
				'ub_user_id' =>$ub_user_id
						
				);							
				$this->load->view('content/signup/signup',$data);
				
			}
			else
			{
				 $data = array(
				'title'        => "UNIBUILDER",		
				'content'      => 'content/signup/signup',
				'decline'  =>'decline'						
				);
				$this->load->view('content/login/login',$data);
				
			}
		}
		else
		{
		  $this->load->view('content/login/login');
		  $response['status'] = FALSE;
		}
		
	}
	/** 
	* Accept Invite
	* 
	* @method: accept_invite 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL2FjY2VwdF9pbnZpdgxf1Uv
	*/	
	public function accept_invite($ub_user_id = '', $username = '')
	{	
		$data = array(
				'title'        => "Signup",		
				'content'      => 'content/signup/accept',
				'accept'	   =>'accept',
				'ub_user_id' =>$ub_user_id,
				'username'  => $username
				);
		if($ub_user_id != '')
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
			  	'username' =>   $result['data']['userName'],
			  	'password' =>   $password,
			  	'confirm_password' =>   $confirm_password,
			  	);
			  $response = $this->Mod_signup->update_user($insert_array);
			  $this->Mod_signup->response($response);
			}
								
		}
		
		$this->load->view('content/signup/accept',$data);
	}
	/** 
	* Reject Invite
	* 
	* @method: reject_invite 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL3JlamVjdF9pbnZpdgxf1Uv
	*/	
	public function reject_invite()
	{		
		$this->load->view('content/signup/reject');
	}
	/** 
	* Check unique user
	* 
	* @method: reject_invite 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL3JlamVjdF9pbnZpdgxf1Uv
	*/	
	public function unique_user()
	{		
		if(!empty($this->input->post()))
		{
		  $result = $this->sanitize_input();
		  if(TRUE === $result['status'])
		  {
		  	 $response = $this->Mod_signup->get_valid_user($result['data']);
			 $this->Mod_signup->response($response);
		  }

		}
	}
}