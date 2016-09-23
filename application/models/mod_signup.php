<?php
/** 
 * Signup Model
 * 
 * @package: Signup Model
 * @subpackage: Signup Model 
 * @category: Signup
 * @author: Sidhartha
 * @createdon(DD-MM-YYYY): 30-04-2015
*/
class Mod_signup extends UNI_Model
{
	/**
	 * @property: $builder_id
	 * @access: public
	 */

	public $builder_id;
	/**
	 * @property: $user_id
	 * @access: public
	 */

	public $user_id;
	
	/**
	 * @property: $log_id
	 * @access: public
	 */

	public $ub_user_id;
    /**
	 * @constructor
	 */
	 
	public function __construct() 
	{
		$this->load->model(array('Mod_notification','Mod_user'));
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['user_id'])?$this->user_session['user_id']:0;
		$this->role_id = 0;
		$this->ub_user_id = 0;
		parent::__construct();
    }
	/**
	*
	*
	* Update user
	* @author: Sidhartha
	* @method: update_user
	* @access: public 
	* @param: array data
	* @return: return data
	*/
	public function update_user($post_array = array())
	{
		if( ! empty($post_array))
		{
			//echo "<pre>";print_r($post_array);
			$result = array();
			//$result['status'] == '';
			if (isset($post_array['system_provided_user_name']) && !empty($post_array['system_provided_user_name'])) 
			{
				//echo "hiii";
				$result['status'] = FALSE;
				//print_r($result);
			}
			else
			{
				$result = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.username'),
								'where_clause' => array('USER.username' => $post_array['username'])
								));
			}
				
				//print_r($post_array);
				if($post_array['username'] == '')
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Username Is Empty';
				}
				else if($post_array['password'] == '')
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Password Is Empty';
				}
				else if($post_array['confirm_password'] == '')
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Confirm Password Is Empty';
				}
				 else
				 { 
				 	if(TRUE != $result['status'])
				  	{
						$post_array = array(
							'ub_user_id' => $post_array['ub_user_id'],
							'username' =>   $post_array['username'],
							'password' =>   $post_array['password'],
							'user_status' => 'Active',
							'email_verified' => 'Yes',
							'login_enabled' => 'Yes'
						);
						// Failed to retrieve the same user
						$this->write_db->where('ub_user_id', $post_array['ub_user_id']);
						if($this->write_db->update(UB_USER, $post_array))
						{
							/* Notification code was added by chandru */
							$user_type = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.account_type'),
								'where_clause' => array('USER.ub_user_id' => $post_array['ub_user_id'])));
							//print_r($user_type);exit;
							if($user_type['aaData'][0]['account_type'] == OWNER)
							{
								$send_notification = $this->send_mail_for_notification($post_array);
							}
							$data['insert_id'] =  $this->ub_user_id;
							$data['status'] = TRUE;
							$data['message'] = 'Update successfully';
						}
						else
						{
							$data['status'] = FALSE;
							$data['message'] = 'Update failed';
						}
				  	}
					else
					{
						// User is already exists
						$data['status'] = FALSE;
						$data['message'] = 'Update Failed: Username already exists';
					}
			   }
				
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}

	/**
	*
	*
	* Get valid user
	* @author: Sidhartha
	* @method: get_valid_user
	* @access: public 
	* @param: array data
	* @return: return data
	*/
	public function get_valid_user($post_array = array())
	{
		if( ! empty($post_array))
		{
			
				$result = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.username'),
								'where_clause' => array('USER.username' => $post_array['username'])
								));
				//print_r($post_array);
				if($post_array['username'] == '')
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Username Is Empty';
				}
				 else{ if(TRUE === $result['status'])
				  {
				  	$data['status'] = FALSE;
					$data['message'] = 'Username already exists';
				    // Failed to retrieve the same user
					
				  }

				  else
			      {
			   	    $data['status'] = TRUE;
				    $data['message'] = 'Correct Username';
			      }
			   }
			   
				

		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	
	/* Below function was added by chandru 01/06/2015 */
	public function send_mail_for_notification($post_array = array())
	{
		/* Based on owner id getting builder id and project name */
		$owner_id = $post_array['ub_user_id'];
		$where_owner_str = array('owner_id' => $owner_id);
			$get_owner_user_id = array(
									'select_fields' => array('project_name','builder_id'),
									'where_clause' => $where_owner_str
									);
			$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
			if($owner_id_details['status'] == TRUE)
			{
				$project_name = $owner_id_details['aaData'][0]['project_name'];
				$builder_id = $owner_id_details['aaData'][0]['builder_id'];
			}else{
				$project_name = '';
				$builder_id = '';
			}
			
			/* Based on builder id find builder user id. */
			$post_array_builder_value[] = array(
							'field_name' => 'builder_id',
							'value'=> $builder_id, 
							'type' => '='
						);
			$post_array_builder_value[] = array(
							'field_name' => 'account_type',
							'value'=> BUILDERADMIN, 
							'type' => '='
						);
			$post_array_builder_value[] = array(
							'field_name' => 'role_id',
							'value'=> BUILDER_ADMIN_ROLE_ID, 
							'type' => '='
						);
			$where_builder_str = $this->Mod_signup->build_where($post_array_builder_value);
			$get_builder_user_id = array(
								'select_fields' => array('ub_user_id'),
								'where_clause' => $where_builder_str
								);
			$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
			if($builder_user_id_details['status'] == TRUE)
			{
			$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];
			}else{
				$builder_user_id = 0;
			}
			$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($builder_user_id,'user');
			/* Based on builder id find builder user id code ends here. */
			
			
			$post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			$where_str = $this->Mod_lead->build_where($post_array_value);
         $get_all_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_str
                                    );
         $all_users = $this->Mod_user->get_users($get_all_users);
		 if($all_users['status'] == TRUE)
		 {
			 $user_list = $all_users['aaData'];
			 if(isset($user_list) && !empty($user_list))
			 {
				foreach($user_list as $key => $val)
				{
					$email_ids[] = $val['primary_email'];
					$email_id = $val['primary_email'];
					$name = $val['fullname'];
					$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
				}
				$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
			 }
		 }else
		 {
			return FALSE;
		 }
		 /* FETCH BUILDER NAME */
		$condition_post_array =  array('ub_builder_id'=>$builder_id);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('builder_name'),
												'where_clause' => $condition_post_array
												));
		$builder_name = $builder_details_array['aaData']['0']['builder_name']; 
		$template_type = 'Owner_login_activation';
		$scheduler  = $this->Mod_builder->get_builder_logo($this->builder_id);
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'owner_name' => $name,
						'project_name' => $project_name,
						'builder_name' => $builder_name,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				
			$post_array_details = array(
					'builder_id' => $builder_id,
					'project_id' => $this->project_id,
					'module_name' => $this->module,
					'module_pk_id' => $post_array['ub_user_id'],
					'from_user_id' => 0,
					'to_user_id' => $email_id,
					'type' => $template_type,
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => $template_type,
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
			// $mail_responce = $this->Mod_mail->send_mail('SEND_MAIL_TO_TASK_ASSIGNED_USERS', $content_array);
			return $notification_responce;
	}

}
/* End of file mod_user.php */
/* Location: ./application/models/mod_user.php */