<?php 
/** 
 * Unibuilder Admin Dashboard Class
 * 
 * @package: Unibuilder Admin 
 * @subpackage: Unibuilder Admin
 * @category: Unibuilder Admin
 * @author: UI Developer
 * @createdon(DD-MM-YYYY): 05-06-2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends UNI_Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
    {
		//Parent constructor
        parent::__construct();	
		$this->load->model(array('Mod_login','Mod_user','Mod_role','Mod_builder'));
    }
	
	/** 
	* Builder index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True
	* Access URL : YWRtaW4vdXNlci9pbmRleA--
	*/
	
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/user/view'		
		);
		$this->template->view($data);
	}
	
	
	public function adduser()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/user/adduser'		
		);
		$this->template->view($data);
	}
	/** 
	* function to change password
	* 
	* @method: change_password 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* created by : pranab
	*/
	public function changepassword()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/user/changepassword'		
		);
		
		if(!empty($this->input->post()))
		{
		  $result = $this->sanitize_input();
		
			if(TRUE === $result['status'])
			{
			    unset($result['data']['password']);
			  	unset($result['data']['confirm_password']);
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
		$this->template->view($data);
	}
   public function get_users_list()
	{
    if(!empty($this->input->post()))
		{
		
				
			/* 	$post_array[] = array(
									'field_name' => 'PLAN.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									); */
			$order_by_where = '';
			$pagination_array = array();
			$total_count_array =  array();						
            // Sanitize input
			$result = $this->sanitize_input();
			 // echo "<pre>";print_r($result);exit;
			if(TRUE === $result['status'])
			{
				
				// Where clause argument
				// $where_str = $this->Mod_plan->build_where($post_array);
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
					$order_by_where = 'USER.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				if($order_by_where == '')
				{
				$order_by_where = 'USER.ub_user_id desc' ;
				}
                // Fetch argument building
               $result_data = $this->Mod_user->get_users(array(
							            'select_fields' => array(
										'USER.ub_user_id','USER.first_name','USER.last_name','USER.primary_email','USER.user_status','USER.mobile_phone','CONCAT_WS(" ",USER.first_name,USER.last_name) as full_name'),
										'where_clause' => array('USER.account_type'=>UNIADMIN,'USER.user_status' => 'Active'),
										'order_clause' => $order_by_where,
										'pagination' => $pagination_array
										 ));
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
												'where_clause' => array('account_type'=>UNIADMIN,'user_status' => 'Active')
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
   	public function save_user()
	{
		$result = $this->sanitize_input();
	
		if(!empty($this->input->post()))
		{
			if(TRUE === $result['status'])
			{
			// echo '<pre>';print_r($result);exit;
				if (isset($result['data']['primary_email']) && !empty(isset($result['data']['primary_email']))) 
				{
					/* Find email address exist or not */
				    $primary_email = $result['data']['primary_email'];
					
					$verify_primary_email = $this->Mod_user->get_users(array(
												'select_fields' => array('USER.primary_email'),
												'where_clause' => array('USER.primary_email'=> $primary_email)
												));				
					if ($verify_primary_email['status'] == FALSE) 
					{
						/* Username related code */
						
							$verify_user = $this->Mod_user->get_users(array(
														'select_fields' => array('USER.username'),
														'where_clause' => array('USER.username'=> $result['data']['username'])
														));
														
						if($verify_user['status'] === FALSE)
						 {
							
						/* User table insert code */
						  $user_data = array(
							'builder_id' => 0,
							'username' => $result['data']['username'],
							'first_name' => $result['data']['first_name'],
							'last_name' => $result['data']['last_name'],
							'primary_email' => $result['data']['primary_email'],
							'user_status' => $result['data']['user_status'],
							'login_enabled' => 'Yes',
							'account_type' => UNIADMIN,
							'role_id' => UNI_ADMIN_ROLE_ID,
							'time_zone'=> DEFAULT_USER_TIME_ZONE,
							'date_format'=> DEFAULT_DATE_FORMAT,
							'created_on' => TODAY,
							'created_by' => $this->user_session['ub_user_id']);
							$ub_user_response = $this->Mod_user->add_admin_user($user_data);
							/* User table insert code ends here */
							
						if (TRUE === $ub_user_response['status']) 
						{
							$response['userid'] = $ub_user_response['insert_id'];
							$response['username'] = $result['data']['username'];
							$response['status'] = TRUE;
							$response['message'] = 'User added successfully';
							
						}
						else
						{
							$response['status'] = FALSE;
							$response['message'] = 'Registration Failed';
						}
						$this->Mod_user->response($response);
					  }
					else
					   {
					   
						 $response['status'] = FALSE;
						 $response['message'] = 'Username already exists. Please try with some other username';
						 $this->Mod_user->response($response);
					   }  
					  
					}
					else
					{
						//echo "<pre>else";print_r($result);exit;
						$response['status'] = FALSE;
						$response['message'] = 'Email id already exists. Please try with some other email id';
						$this->Mod_user->response($response);
					}
					
				}
				else
				{
					$response['status'] = FALSE;
					$response['message'] = 'The email field is empty';
					$this->Mod_user->response($response);
				}
			}
			else
			{
				$this->Mod_role->response($result);
			}
			
		}
	}
  
    public function send_invitation()
	{
		$result = $this->sanitize_input();
	
		if(!empty($this->input->post()))
		{
			if(TRUE === $result['status'])
			{
			// echo '<pre>';print_r($result);exit;
				if (isset($result['data']['primary_email']) && !empty(isset($result['data']['primary_email']))) 
				{
					/* Find email address exist or not */
				    $primary_email = $result['data']['primary_email'];
					
					$verify_primary_email = $this->Mod_user->get_users(array(
												'select_fields' => array('USER.primary_email'),
												'where_clause' => array('USER.primary_email'=> $primary_email)
												));				
					if ($verify_primary_email['status'] == FALSE) 
					{
						/* Username related code */
						
							$verify_user = $this->Mod_user->get_users(array(
														'select_fields' => array('USER.username'),
														'where_clause' => array('USER.username'=> $result['data']['username'])
														));
														
						if($verify_user['status'] === FALSE)
						 {
							
						/* User table insert code */
						  $user_data = array(
							'builder_id' => 0,
							'username' => $result['data']['username'],
							'first_name' => $result['data']['first_name'],
							'last_name' => $result['data']['last_name'],
							'primary_email' => $result['data']['primary_email'],
							'user_status' => $result['data']['user_status'],
							'login_enabled' => 'Yes',
							'account_type' => UNIADMIN,
							'role_id' => UNI_ADMIN_ROLE_ID,
							'time_zone'=> DEFAULT_USER_TIME_ZONE,
							'date_format'=> DEFAULT_DATE_FORMAT,
							'created_on' => TODAY,
							'created_by' => $this->user_session['ub_user_id']);
							$ub_user_response = $this->Mod_user->add_admin_user($user_data);
							/* User table insert code ends here */
							
						if (TRUE === $ub_user_response['status']) 
						{
							
						$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
						$key = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
						$where = array('ub_user_id' => $ub_user_response['insert_id']);
						
						$this->Mod_user->update_data(UB_USER, $key, $where);
						
						$reset_link = base_url().$this->crypt->encrypt('admin/login/accept_invite/'.$result['data']['ub_user_id'].'/'.$result['data']['username']);
						 
						$content_array = array(
						'TO_EMAIL' => $result['data']['primary_email'],
						'TO_NAME' => $result['data']['first_name'],
						'FIRST_NAME' => $result['data']['first_name'],
						'RESET_LINK' => $reset_link,
						'SEND_MAIL_INFO' => $result['data']['first_name'].EMAIL_SEPERATOR_LEVEL2.$result['data']['primary_email'],
						'IMAGESRC' => IMAGESRC,
						'base_url'=> BASEURL
						);
						$this->Mod_mail->send_mail('SEND_INVITATION_EMAIL', $content_array, 'yes');
						$response['status'] =  TRUE;
						$response['message'] = 'Mail send to '.$result['data']['primary_email'].' Sucessfully';
						}
						else
						{
							$response['status'] = FALSE;
							$response['message'] = 'Registration Failed';
						}
						$this->Mod_user->response($response);
					  }
					else
					   {
					   
						 $response['status'] = FALSE;
						 $response['message'] = 'Username already exists. Please try with some other username';
						 $this->Mod_user->response($response);
					   }  
					  
					}
					else
					{
						//echo "<pre>else";print_r($result);exit;
						$response['status'] = FALSE;
						$response['message'] = 'Email id already exists. Please try with some other email id';
						$this->Mod_user->response($response);
					}
					
				}
				else
				{
					$response['status'] = FALSE;
					$response['message'] = 'The email field is empty';
					$this->Mod_user->response($response);
				}
			}
			else
			{
				$this->Mod_role->response($result);
			}
			
		}
	}
/** 
	* Validate old password
	* 
	* @method: check_old_password 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* created by : pranab
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

	  public function user_email_invitation()
	 {
		
		if(!empty($this->input->post()))
		{
		   $results = $this->sanitize_input();
	        if($results['data']['ub_user_id'] == '')
			{
			 
			 $this->send_invitation() ;
			 
			}
			else
			{
			$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
			$key = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
			$where = array('ub_user_id' => $results['data']['ub_user_id']);
			$result = $this->Mod_user->update_data(UB_USER, $key, $where);
			if (isset($results['data']['username']) && !empty($results['data']['username']))
			 {
				$reset_link = base_url().$this->crypt->encrypt('admin/login/accept_invite/'.$results['data']['ub_user_id'].'/'.$results['data']['username']);
			}
			
			/* Image and base url was added by chandru 0n 30-05-2015 */
		
           $content_array = array(
			'TO_EMAIL' => $results['data']['primary_email'],
			'TO_NAME' => $results['data']['first_name'],
			'FIRST_NAME' => $results['data']['first_name'],
			'RESET_LINK' => $reset_link,
			'SEND_MAIL_INFO' => $results['data']['first_name'].EMAIL_SEPERATOR_LEVEL2.$results['data']['primary_email'],
			'IMAGESRC' => IMAGESRC,
			'base_url'=> BASEURL
			);
			$this->Mod_mail->send_mail('SEND_INVITATION_EMAIL', $content_array, 'yes');
			$response['status'] =  TRUE;
			$response['message'] = 'Mail send to '.$results['data']['primary_email'].' Sucessfully';
			$this->Mod_user->response($response);
			
			}
			
		}
		
		else
		{
			$response['status'] =  FALSE;
			$response['message'] = 'Failed to send mail';
			$this->Mod_user->response($response);
		}
	
	} 
	 public function edit_user($ub_user_id = 0)
	{
	  $data = array(
		'title'        => 'UNIBUILDER',		
		'content'      => 'admin/content/user/edituser',
        'ub_user_id'  => $ub_user_id 		
		);
	
		$result_data = $this->Mod_user->get_users(array(
							            'select_fields' => array(
										'USER.ub_user_id','USER.first_name','USER.last_name','USER.primary_email','USER.user_status','USER.mobile_phone','USER.username'),
										'where_clause' => array('USER.ub_user_id'=>$ub_user_id)
										 ));
		$status_dropdown[] = array('id' => 'Active','val' => 'Active');
        $status_dropdown[] = array('id' => 'Inactive','val' => 'Inactive');
        $data['status_dropdown_list'] = $this->Mod_builder->build_ci_dropdown_array($status_dropdown,'id', 'val');						 
			 if(TRUE === $result_data['status'])
				{
					$data['user_data']  = $result_data['aaData'][0];
				}
			
		$this->template->view($data);
	}
	
	
	 public function update_user()
	{	
		$result = $this->sanitize_input();

		if(!empty($this->input->post()))
		{
			if(TRUE === $result['status'])
			{
			       /* User table update code */
						   $user_data = array(
						    'ub_user_id' =>$result['data']['ub_user_id'],
							'username' => $result['data']['username'],
							'first_name' => $result['data']['first_name'],
							'last_name' => $result['data']['last_name'],
							'primary_email' => $result['data']['primary_email'],
							'user_status' => $result['data']['status_id'],
							'modified_on' => TODAY,
							'modified_by' => $this->user_session['ub_user_id']);
							$ub_user_response = $this->Mod_user->update_user($user_data);
							/* User table insert code ends here */
							
						if (TRUE === $ub_user_response['status']) 
						{
							$response['userid'] = $ub_user_response['insert_id'];
							$response['username'] = $result['data']['username'];
							$response['status'] = TRUE;
							$response['message'] = 'updated successfully';
						}
						else
						{
							$response['status'] = FALSE;
							$response['message'] = 'Failed';
						}
						$this->Mod_user->response($response);
					
					  
			}

		}
	}
    public function delete_users()
	{
	  if(!empty($this->input->post()))
		{
		// Sanitize input
		$result = $this->sanitize_input();
	
			if(TRUE === $result['status'])
			{
					// Delete functionality
					$response = $this->Mod_user->delete_admin_user($result['data']);
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
		// Response data
		$this->Mod_user->response($response);
	}
}
   
		