<?php
/** 
 * Reminder Class
 * 
 * @package: Reminder 
 * @subpackage:  
 * @category: Reminder
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 18-05-2015 
*/

/* REMINDER MODEL IS DEPENDENT TO BELOW STORED PROCEDURES
		1.CREATE_NEW_SCHEDULE
		2.UPDATE_SCHEDULE
		3.GET_SCHEDULE_DETAILS
. */
class Mod_reminder extends UNI_Model{
	/**
	 * @constructor
	 */
    public function __construct() {
		parent::__construct();		
		$this->load->model(array('Mod_mail','Mod_general_value','Mod_sms'));
    }
	
	/** 
	* Add reminders
	* 
	* @method: add_reminder 
	* @access: public 
	* @param: input_array($post_array)
	* @return: array 
	* @created by: chandru 
	* @created on: 18-05-2014 
	* @created for: Insert in reminder table 
	*/
	
	public function add_reminder($post_array) {
		/* Post_array should contain below data 
			1.builder_id,
			2.project_id,
			3.module_name,
			4.module_pk_id,
			5.reminder_sent_to,
			6.reminder_sent_on
			7.reminder_end_time,
			8.reminder_duration,
			9.template_name,
			10.status
			11.parse_data
		*/
		if(!empty($post_array))
		{
			$parse_data = $this->serialize_parse_data($post_array['parse_data']);
			$post_array['parse_data'] = $parse_data;
			if(isset($post_array['reminder_type']) && !empty($post_array['reminder_sent_to']))
			{
				$reminder_type = $post_array['reminder_type'];
				unset($post_array['reminder_type']);
			}else{
				$reminder_type = 'Before';
			}
			$find_reminder_send_on_and_to = $this->find_reminder_send_on_and_to($post_array['reminder_sent_to'],$post_array['reminder_end_time'],$post_array['reminder_duration'],$reminder_type);
			$post_array['reminder_sent_to'] = $find_reminder_send_on_and_to['reminder_sent_to'];
			$post_array['reminder_sent_on'] = $find_reminder_send_on_and_to['reminder_sent_on'];
			$post_array['created_by'] = $this->user_session['ub_user_id'];
			$post_array['created_on'] = TODAY;
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			if($this->write_db->insert(UB_REMINDER, $post_array))
				{
					$data['status'] = TRUE;
					$data['message'] = 'Data inserted successfully';
				}else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insertion failed';
				}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
    }
	
	/** 
	* Update reminders
	* 
	* @method: update_reminder 
	* @access: public 
	* @param: input_array($primary_id,$post_array)
	* @return: array 
	* @created by: chandru 
	* @created on: 18-05-2014 
	* @created for: Update in reminder table 
	*/
	
	public function update_reminder($post_array) {
		/* Post_array should contain Below data 
			1.builder_id,
			2.project_id,
			3.module_name,
			4.module_pk_id,
			5.reminder_sent_to,
			6.reminder_sent_on
			7.reminder_end_time,
			8.reminder_duration,
			9.message,
			10.status
			11.parse_data
					$primary_id should contain value.
		*/
		if(!empty($post_array))
		{
			if(isset($post_array['parse_data']) && !empty($post_array['parse_data']))
			{
				$parse_data = $this->serialize_parse_data($post_array['parse_data']);
				$post_array['parse_data'] = $parse_data;
			}
			if(isset($post_array['reminder_type']) && !empty($post_array['reminder_sent_to']))
			{
				$reminder_type = $post_array['reminder_type'];
				unset($post_array['reminder_type']);
			}else{
				$reminder_type = 'Before';
			}
			$find_reminder_send_on_and_to = $this->find_reminder_send_on_and_to($post_array['reminder_sent_to'],$post_array['reminder_sent_on'],$post_array['reminder_duration'],$reminder_type);
			$post_array['reminder_sent_to'] = $find_reminder_send_on_and_to['reminder_sent_to'];
			$post_array['reminder_sent_on'] = $find_reminder_send_on_and_to['reminder_sent_on'];
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			$this->write_db->where(array('module_pk_id'=>$post_array['module_pk_id'],'module_name'=>$post_array['module_name']));
			if($this->write_db->update(UB_REMINDER, $post_array))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Data updated successfully';
			}else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Updated failed';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
    }
	/**
	*
	* Get reminder
	*
	* @method: get_meeting
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function get_reminder($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_REMINDER.' AS REMINDER');	//UB_ROLE is the table name defined in constant file
		// Join Tables
			if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
			{
				$this->read_db->join(UB_USER.' AS USER','REMINDER.created_by = USER.ub_user_id','left');//UB_BUILDER is the table name defined in constant file
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
			// Group by condition
			if(isset($args['group_clause']) && $args['group_clause'] !='')
			{
				$this->read_db->group_by($args['group_clause']);
			}
			// Pagination
			if(isset($args['pagination']) && ! empty($args['pagination']))
			{
				$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
			}
			$res = $this->read_db->get();
			$data = array();
			// echo $this->read_db->last_query();exit;
			if($res->num_rows() > 0)
			{
				$data['aaData'] = $res->result_array();
				$data['status'] = TRUE;
				$data['message'] = 'Data retrieved successfully';	
			// echo '<pre>';print_r($res->result_array);exit;			
			}
			else	
			{
				$data['status'] = FALSE;
				$data['message'] = 'No record found';
			}
			return $data;
	}
	
	
	/**
	*
	* Send mail for reminder(calling from cronjop).
	*
	* @method: scheduler_execute
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon: 21-05-2015
	*/
	
	public function scheduler_execute()
	{
			// $post_array['reminder_sent_to'] = $find_reminder_send_on_and_to['reminder_sent_to'];
			/* $post_array['builder_id'] = 1;
			$post_array['project_id'] = 1;
			$post_array['module_name'] = 'test';
			$post_array['module_pk_id'] = 1;
			$post_array['reminder_sent_to'] = 1;
			if($this->write_db->insert(UB_REMINDER, $post_array))
				{
					$data['status'] = TRUE;
					$data['message'] = 'Data inserted successfully';
				}else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insertion failed';
				}
				echo '<pre>';print_r($data);exit; */
	
	
	
	
		$current_time = TODAY;
		$current_time_plus_five_minutes = date("Y-m-d H:i:s",strtotime(REMINDER_DURATION,strtotime($current_time)));  
		// echo $current_time;
		// echo $current_time_plus_five_minutes; exit;   
		//Fetch all the users
		$where_clause = array('reminder_sent_on >' => $current_time,'reminder_sent_on <' => $current_time_plus_five_minutes,'status' => 'Not Send','reminder_end_time >=' => $current_time,'is_delete'=>'No');
		$get_all_reminders = array(
								'select_fields' => array(),
								'where_clause' => $where_clause
								);
		$all_reminders = $this->Mod_reminder->get_reminder($get_all_reminders);
		if(isset($all_reminders) && !empty($all_reminders))
		{
			if($all_reminders['status'] == TRUE)
			{
				foreach($all_reminders['aaData'] as $key => $val)
				{
					$reminder_sent_to = $val['reminder_sent_to'];
					$reminder_id = $val['ub_reminder_id'];
					$reminder_sent_on = $val['reminder_sent_on'];
					$reminder_duration = $val['reminder_duration'];
					$reminder_end_time = $val['reminder_end_time'];
					$primary_id = $val['module_pk_id'];
					$builder_id = $val['builder_id'];
					$project_id = $val['project_id'];
					$template_name = $val['template_name'];
					$module_name = $val['module_name'];
					$strarray = explode("@$@",$reminder_sent_to);
					$serialized_content_array = $val['parse_data'];
					$new_string = "";
					foreach($strarray As $key){
						$int = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
						$new_string = $new_string .",". $int;
					}
					/* Fetch user details based on array written by chandru 21-05-2014 */
					$mail_user_id = $this->Mod_user->get_mail_preference_user_id($new_string,$this->main_modules[$module_name]);
					
					/* SMS preference code added by chandru on 31-08-2015 */
					/* get_sms_preference_user_id method was available in UNI_Model */
					$sms_user_id = $this->Mod_user->get_sms_preference_user_id($new_string,$this->main_modules[$module_name]);
					// echo '<pre>';print_r($sms_user_id);exit;
					if(isset($sms_user_id) && !empty($sms_user_id))
					{
						// echo '<pre>';print_r($sms_user_id);exit;
						$post_array_value[] = array(
						'field_name' => 'ub_user_id',
						'value'=> $sms_user_id, 
						'type' => '||',
						'classification' => 'primary_ids'
						);
						$where_str = $this->Mod_task->build_where($post_array_value);
						$get_all_users = array(
								'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','mobile_phone'),
								'where_clause' => $where_str
								);
						$all_users_details = $this->Mod_user->get_users($get_all_users);
						if($all_users_details['status'] == TRUE)
						{
							// echo '<pre>';print_r($all_users_details);exit;
							$user_list = $all_users_details['aaData'];
							if(isset($user_list) && !empty($user_list))
							{
								foreach($user_list as $key => $val)
								{
									$msg_array['ub_user_id'] = $val['ub_user_id'];
									$msg_array['name'] = $val['fullname'];
									$msg_array['email_id'] = $val['primary_email'];
									$msg_array['mobile_phone'] = $val['mobile_phone'];
									// echo '<pre>';print_r($template_name);exit;
									$remove_single_quote = str_replace("'", '', $serialized_content_array);
									$content_array = unserialize($remove_single_quote);
									// echo '<pre>';print_r($content_array);exit;
									$msg_responce = $this->Mod_sms->send_sms($template_name, $msg_array, $content_array);
									if(TRUE == $msg_responce)
									{
										$post_array_details = array(
										'builder_id' => $builder_id,
										'project_id' => $project_id,
										'module_name' => $module_name,
										'module_pk_id' => $primary_id, 
										'from_user_id' => 0,
										'notification_type' => 'Sms',
										'to_user_id' => $sms_user_id,
										'type' => $template_name,
										'subject' => 'content will update',
										'message' => 'content will update'
										);
										$add_notification = $this->Mod_notification->add_notification($post_array_details);
									}
								}
							}
						}else{
							echo 'Not a valid user id';
						}
					}
					$post_array_value[] = array(
						'field_name' => 'ub_user_id',
						'value'=> $mail_user_id, 
						'type' => '||',
						'classification' => 'primary_ids'
					);
					$where_str = $this->Mod_task->build_where($post_array_value);
					$get_all_users = array(
							'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email'),
							'where_clause' => $where_str
							);
					$all_users_details = $this->Mod_user->get_users($get_all_users);
					// echo '<pre>';print_r($all_users_details);exit;
					if($all_users_details['status'] == TRUE)
					{
						$user_list = $all_users_details['aaData'];
					if(isset($user_list) && !empty($user_list))
					 {
						foreach($user_list as $key => $val)
						{
							$email_ids[] = $val['primary_email'];
							$email_id = $val['primary_email'];
							$update_id[] = $val['ub_user_id'];
							$name = $val['fullname'];
							$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
						}
						$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
					 }
					 
					/* Format content array */
					$remove_single_quote = str_replace("'", '', $serialized_content_array);
					$content_array = unserialize($remove_single_quote);
					$content_array['TO_EMAIL'] = $email_ids;
					$content_array['SEND_MAIL_INFO'] = $level1_string;
					$content_array['base_url'] = BASEURL;
					$content_array['IMAGESRC'] = IMAGESRC;
					$post_array_detail = array(
					'builder_id' => $builder_id,
					'project_id' => $project_id,
					'module_name' => $module_name,
					'module_pk_id' => $primary_id,
					'from_user_id' => 0,
					'to_user_id' => $mail_user_id,
					'type' => $template_name,
					'subject' => 'content will update',
					'message' => 'content will update'
						);
					$notification_array = array(
					'template_name' => $template_name,
					'content_array' => $content_array,
					'notification' => $post_array_detail,
					'default' => 'No'
					);
					// $mail_responce = $this->Mod_mail->send_mail($template_name, $content_array);
					$mail_responce = $this->Mod_notification->send_mail($notification_array);
					}else{
						echo 'User dont have mail access';
						$mail_responce = FALSE;
					}
					
						
					if($mail_responce == TRUE)
					{
						/* Below code for update in reminder table after mail sent. */
							$update_reminder_sent_on = date("Y-m-d H:i:s",strtotime("+".$reminder_duration." minutes",strtotime($reminder_sent_on)));
							if(strtotime($reminder_end_time) < strtotime($update_reminder_sent_on))
							{
								$post_array =array('status' =>'Sent');
							}else{
								$post_array =array('reminder_sent_on' => $update_reminder_sent_on);
							}
							$this->write_db->where('ub_reminder_id', $reminder_id);
							$this->write_db->update(UB_REMINDER, $post_array);
						$responce =  'Schedule executed successfully';
					}else{
						$responce = 'Schedule not executed';
					}
				}
				echo '<pre>';print_r($responce);exit;
			}else{
					echo 'No record found';exit;
				}
		}
		else{
			echo 'No record found';exit;
		}
	}
	
	/**
	*
	* Calculate date and change send to format
	*
	* @method: find_reminder_send_on_and_to
	* @access: public 
	* @param: post data
	* @return: return data
	* @created by: chandru
	* @created on: 22-05-2015
	*/
	
	public function find_reminder_send_on_and_to($reminder_sent_to,$reminder_sent_on,$reminder_duration,$reminder_type)
	{
		if(isset($reminder_sent_to) && !empty($reminder_sent_to))
		{
			$encrypt_assignded_to = array(
					'email' => $reminder_sent_to,
					'type' =>'To',
					'name' =>'',
					'reminder'=>'reminder_id'
					);
			$insertintaskassignedusers  = $this->Mod_message->encrypt_email($encrypt_assignded_to);
			$data['reminder_sent_to'] = $insertintaskassignedusers;
		}else{
			$data['reminder_sent_to'] = $reminder_sent_to;
		}
		if(isset($reminder_sent_on) && !empty($reminder_sent_on))
		{
			if($reminder_type == 'After')
			{
				/* After expiry sending reminder */
				$formated_reminder_sent_on = date("Y-m-d H:i:s",strtotime("+".$reminder_duration." minutes",strtotime($reminder_sent_on)));  
				$data['reminder_sent_on'] = $formated_reminder_sent_on;
			}else{
				/* Before sending reminder */
				$formated_reminder_sent_on = date("Y-m-d H:i:s",strtotime("-".$reminder_duration." minutes",strtotime($reminder_sent_on)));  
				$data['reminder_sent_on'] = $formated_reminder_sent_on;
			}
		}else{
			$data['reminder_sent_on'] = $reminder_sent_on;
		}
		return $data;
	}
	
	/**
	*
	* Convert to serialized data
	*
	* @method: serialize_parse_data
	* @access: public 
	* @param: post data
	* @return: return data
	* @created by: chandru
	* @created on: 29-05-2015
	*/
	public function serialize_parse_data($post_array)
	{
		$serialized_parse_data =  "'".serialize($post_array)."'";
		return $serialized_parse_data;
	}
	/* Delete reminder code
	added by: chandru
	added on: 09-10-2015
	action: change isdelete field
	*/
	public function delete_reminder($module_id = 0, $module_name='', $builder_id = 0)
	{
		if($module_id > 0 && $module_name != '' && $builder_id > 0)
		{
			$post_array['is_delete'] = 'Yes';
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			$this->write_db->where(array('module_pk_id'=>$module_id,'module_name'=>$module_name,'builder_id'=>$builder_id));
			if($this->write_db->update(UB_REMINDER, $post_array))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Data updated successfully';
			}else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Updated failed';
			}
			return $data;
		}
	}
}
/* End of file mod_mail.php */
/* Location: ./application/models/mod_mail.php */