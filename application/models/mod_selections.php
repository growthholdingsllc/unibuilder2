<?php
/** 
 * Selections Model
 * 
 * @package: Selections Model
 * @subpackage: Selections Model 
 * @category: Selections
 * @author: chandru
 * @createdon(DD-MM-YYYY): 26-04-2015
*/
class Mod_selections extends UNI_Model
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
	 * @property: $role_id
	 * @access: public
	 */

	//public $role_id;
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['ub_user_id'])?$this->user_session['ub_user_id']:0;
		$this->role_id = 0;
		parent::__construct();
    }
	
	/** 
	* Get selections information
	*
	* @method: get_selections
	* @access: public 
	* @param: args
	* @return: array
	* @created by: chandru
	* @created on: 26-apr-2014
	*/
	public function get_selections($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SELECTION.' AS SELECTION');
		
         
	 	if(isset($args['join']['selection_choice']) && 'yes' === strtolower($args['join']['selection_choice']))
	    {
	       $this->read_db->join(UB_SELECTION_CHOICE.' AS SELECTION_CHOICE','SELECTION.ub_selection_id = SELECTION_CHOICE.selection_id','left');
	    }
		
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = SELECTION.created_by');
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
		
		  // if(!$res)
		 // {
			// echo $this->read_db->_error_message();
			// echo "<br>".$this->read_db->_error_number();exit;
		// }  
	      // echo $this->read_db->last_query(); 
		$data = array();
		
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}	
		return $data;
	}
	/** 
	* Get selections information
	*
	* @method: get_category
	* @access: public 
	* @param: args
	* @return: array
	* @created by: chandru
	* @created on: 26-apr-2014
	*/
	public function get_category($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SELECTION.' AS SELECTION');
		
         
	 	if(isset($args['join']) && 'yes' === strtolower($args['join']['selection_choice']))
	    {
	       $this->read_db->join(UB_SELECTION_CHOICE.' AS SELECTION_CHOICE','SELECTION.ub_selection_id = SELECTION_CHOICE.selection_id','left');
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
		
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		$res = $this->read_db->get();
	    // echo $this->read_db->last_query();exit;
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
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
	* Add Selection
	*
	* @method: add_selections
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdon(DD-MM-YYYY): 28-03-2015
	* @createdby: chandru
	*/
	public function add_selections($post_array = array())
	{
		if( ! empty($post_array))
		{
			if(isset($post_array['allowance']))
				{
					$allowance_data = $post_array['allowance'];
				}else
				{
					$allowance_data = '';
				}
			if($post_array['schedule_id'] > 0)
			{
			  $post_array['due_date_time'] = $post_array['schedule_due_date'];
			}
			$selections_table_insert_array = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $post_array['project_id'],
					'title' => $post_array['title'],
					'category' => $post_array['category'],
					'location' => $post_array['location'],
					'allowance' => $allowance_data,
					'number_of_days' => $post_array['number_of_days'],
					'on_or_before' => $post_array['on_or_before'],
					'schedule_id' => $post_array['schedule_id'],
					'due_date_time' => $post_array['due_date_time'],
					'due_date' => $post_array['due_date'],
					'due_time' => $post_array['due_time'],
					'deadline_required' => $post_array['deadline_required'],
					'reminder_id' => $post_array['reminder_id'],
					'allow_multiple_choice_selection' => $post_array['allow_multiple_choice_selection'],
					'description' => $post_array['description'],
					'builderuser_notes' => $post_array['builderuser_notes'],
					'owner_id' => $post_array['owner_id'],
					'owner_selection_access' => $post_array['owner_selection_access'],
					'vendor_selection_access' => $post_array['vendor_selection_access'],
					'status' => 'New',
					'created_by' => $this->user_session['ub_user_id'],
					'created_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
			);
			
			 $this->builder_id = (isset($selections_table_insert_array['builder_id']))?$selections_table_insert_array['builder_id']:$this->builder_id;
					if($this->write_db->insert(UB_SELECTION, $selections_table_insert_array))
					{
						$data['insert_id'] =  $this->write_db->insert_id();
						/* Reminder code for selection deadline */
						if($post_array['reminder_id'] != "" && $post_array['due_date'] != "" && $post_array['due_time'] != "")
							{
								$due_date_and_time = $post_array['due_date'].' '.$post_array['due_time'];
								/* FETCH BUILDER NAME */
								 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
								$builder_details_array = $this->Mod_builder->get_builder_details(array(
																		'select_fields' => array('builder_name'),
																		'where_clause' => $condition_post_array
																		));
								$builder_name = $builder_details_array['aaData']['0']['builder_name'];
								$parse_data = array(
									'project_name' =>$this->project_name,
									'builder_name' =>$builder_name,
									'task_name' =>$post_array['title'],
									'deadline' =>$due_date_and_time
									);
								$builder_id = $this->user_session['builder_id'];
								/* Find user id based on builder id */
								$where_builder_str = array('builder_id' => $builder_id,'account_type' => BUILDERADMIN );
								$get_builder_user_id = array(
												'select_fields' => array('ub_user_id'),
												'where_clause' => $where_builder_str
												);
								$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
								$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];
								/* Find user id based on builder id ENDS */
								$owner_id = $post_array['owner_id'];
								$mail_to_id = $builder_user_id.','.$owner_id;
								
								$reminder_table_insert_array = array(
														'builder_id' => $this->user_session['builder_id'],
														'project_id' => $post_array['project_id'],
														'module_name' => 'selections',
														'module_pk_id' => $data['insert_id'],
														'reminder_sent_to' => $mail_to_id,
														'reminder_sent_on' => $due_date_and_time,
														'reminder_end_time' => $due_date_and_time,
														'reminder_duration' => $post_array['reminder_id'],
														'template_name' => 'selection_deadline_reminder',
														'status' => 'Not Send',
														'parse_data' => $parse_data
														);
								$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
							}
								$data['status'] = TRUE;
								$data['message'] = 'Data inserted successfully';		
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'Insert Failed: Failed to insert the data';
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
	* Update Selection
	*
	* @method: update_selections
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon(DD-MM-YYYY): 30-04-2015
	*/
	public function update_selections($post_array = array())
	{
		if($post_array['schedule_id'] > 0)
		{
		  $post_array['due_date_time'] = $post_array['schedule_due_date'];
		}
		unset($post_array['schedule_due_date']);
		$this->write_db->where('ub_selection_id', $post_array['ub_selection_id']);
		$this->write_db->update(UB_SELECTION, $post_array);
			/* Reminder table update code  */
			if($post_array['reminder_id'] != "" && $post_array['due_date'] != "" && $post_array['due_time'] != "")
			{
				// $parse_data = array();
				$due_date_and_time = $post_array['due_date'].' '.$post_array['due_time'];
				$builder_id = $this->user_session['builder_id'];
				/* Find user id based on builder id */
   				$where_builder_str = array('builder_id' => $builder_id,'account_type' => BUILDERADMIN );
 				$get_builder_user_id = array(
 								'select_fields' => array('ub_user_id'),
 								'where_clause' => $where_builder_str
 								);
  				$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
  				$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];
				/* Find user id based on builder id ENDS */
				$owner_id = $post_array['owner_id'];
				$mail_to_id = $builder_user_id.','.$owner_id;
				/* Update reminder code */
					$where_clause = array('module_pk_id' =>$post_array['ub_selection_id'],'module_name' => 'selections',);
					$get_all_reminders = array(
								'select_fields' => array(),
								'where_clause' => $where_clause
								);
					// echo '<pre>';print_r($get_all_reminders);exit;
					$all_reminders = $this->Mod_reminder->get_reminder($get_all_reminders); 
					// echo '<pre>';print_r($all_reminders);exit;
					if($all_reminders['status'] == TRUE)
					{
					$reminder_table_insert_array = array(
										'module_name' => 'selections',
										'module_pk_id' => $post_array['ub_selection_id'],
										'reminder_sent_to' => $mail_to_id,
										'reminder_sent_on' => $due_date_and_time,
										'reminder_end_time' => $due_date_and_time,
										'reminder_duration' => $post_array['reminder_id'],
										'status' => 'Not Send'
										//'parse_data' => $parse_data
										);
				$insert_in_reminder_table  = $this->Mod_reminder->update_reminder($reminder_table_insert_array);
				}else{
					/* FETCH BUILDER NAME */
								 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
								$builder_details_array = $this->Mod_builder->get_builder_details(array(
																		'select_fields' => array('builder_name'),
																		'where_clause' => $condition_post_array
																		));
								$builder_name = $builder_details_array['aaData']['0']['builder_name'];
					$parse_data = array(
									'project_name' =>$this->project_name,
									'builder_name' =>$builder_name,
									'task_name' =>$post_array['title'],
									'deadline' =>$due_date_and_time
									);
					$reminder_table_insert_array = array(
										'module_name' => 'selections',
										'module_pk_id' => $post_array['ub_selection_id'],
										'reminder_sent_to' => $mail_to_id,
										'reminder_sent_on' => $due_date_and_time,
										'reminder_end_time' => $due_date_and_time,
										'reminder_duration' => $post_array['reminder_id'],
										'status' => 'Not Send',
										'parse_data' => $parse_data
										);
				$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
				}
				
			}
		$data['insert_id'] =  $post_array['ub_selection_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Updated successfully';
		return $data;
	}
	
	/**
	*
	* Insert Selection choices
	*
	* @method: add_selection_choices
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon(DD-MM-YYYY): 30-04-2015
	*/
	public function add_selection_choices($post_array = array())
	{
		if( ! empty($post_array))
		{
			$selections_choice_table_insert_array = array(
					'builder_id' => $this->builder_id,
					'selection_id' => $post_array['selection_id'],
					'title' => $post_array['title'],
					'standard_choice' => $post_array['standard_choice'],
					'product_url' => $post_array['product_url'],
					'owner_price_tbd' => $post_array['owner_price_tbd'],
					'owner_price' => $post_array['owner_price'],
					'subcontractor_price_tbd' => $post_array['subcontractor_price_tbd'],
					'subcontractor_price' => $post_array['subcontractor_price'],
					'sub_pricing_comments' => $post_array['sub_pricing_comments'],
					'description' => $post_array['description'],
					'vendor_id' => $post_array['vendor_id'],
					'installer_id' => $post_array['installer_id'],
					'status' => 'Pending',
					'created_by' => $this->user_session['ub_user_id'],
					'created_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
			);
			
			 $this->builder_id = (isset($selections_choice_table_insert_array['builder_id']))?$selections_choice_table_insert_array['builder_id']:$this->builder_id;
					if($this->write_db->insert(UB_SELECTION_CHOICE, $selections_choice_table_insert_array))
					{
						$selection_choice_id = $this->write_db->insert_id();
						$selections_choice_table_update_status_array = array(
						'status' => 'Waiting for choice approval'
						);
						$this->write_db->where('ub_selection_id', $post_array['selection_id']);
		                $this->write_db->update(UB_SELECTION, $selections_choice_table_update_status_array);
						/* Add selection choice notification */
						/* FETCH BUILDER NAME */
						$insert_choice_id = $this->write_db->insert_id();
						$data['insert_id'] = $insert_choice_id;
						$builder_id = $this->user_session['builder_id'];
						/* Based on builder id find builder user id */
						$where_builder_str = array('builder_id' => $builder_id,'account_type' => BUILDERADMIN );
						$get_builder_user_id = array(
										'select_fields' => array('ub_user_id'),
									'where_clause' => $where_builder_str
									);
						$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
						$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];
						/* Based on builder id find builder user id ENDS*/
						$condition_post_array =  array('ub_builder_id'=>$builder_id);
						$builder_details_array = $this->Mod_builder->get_builder_details(array(
													'select_fields' => array('builder_name'),
													'where_clause' => $condition_post_array
													));
						$builder_name = $builder_details_array['aaData']['0']['builder_name'];
						/* Selection details */
						$selection_id = $post_array['selection_id'];
						$selection_condition_post_array =  array('ub_selection_id'=>$selection_id);
						$selection_details_array = $this->get_selections(array(
													'select_fields' => array('title','due_date','due_time'),
													'where_clause' => $selection_condition_post_array
													));
						/* due_date and title */
						$due_date_and_time = $selection_details_array['aaData']['0']['due_date'].' '.$selection_details_array['aaData']['0']['due_time'];
						$selection_title = $selection_details_array['aaData']['0']['title'];
						$choice_name = $post_array['title'];
						$username_array = $this->user_session;
						$added_by_first_name = $username_array['first_name'];
						if($post_array['subcontractor_price_tbd'] == 'Yes')
						{
						$find_email_id_based_on_id = $builder_user_id;
						}else{
						$find_email_id_based_on_id = $builder_user_id.','.$post_array['vendor_id'].','.$post_array['owner_id'];
						}
						$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($find_email_id_based_on_id,$this->main_modules[$this->module]);
						//Fetch user details
						$post_array_value[] = array(
											'field_name' => 'ub_user_id',
											'value'=> $mail_user_id, 
											'type' => '||',
											'classification' => 'primary_ids'
										);
						$where_str = $this->Mod_selections->build_where($post_array_value);
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
								$assigned_to_first_name[] = $val['first_name'];
								$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
							}
						$to_address = implode(",",$email_ids);
						$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
						}
						
						 $scheduler  = $this->Mod_builder->get_builder_logo($this->builder_id);
						/* Building notification array */
						 $content_array = array(
								'TO_EMAIL' => $email_ids,
								'SEND_MAIL_INFO' => $level1_string,
								'IMAGESRC' => IMAGESRC,
								'selection_name' => $selection_title,
								'project_name' => $this->project_name,
								'choice_title' => $choice_name,
								'builder_name' => $builder_name,
								'added_by' => $added_by_first_name,
								'dead_line' => $due_date_and_time,
								'base_url'=> BASEURL,
								'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
									);
						if($post_array['subcontractor_price_tbd'] == 'Yes')
						{
						$content_array['sub_price'] = $post_array['subcontractor_price']; 
						}
						if($post_array['subcontractor_price_tbd'] == 'Yes')
						{
						$post_array_details = array(
								'builder_id' => $this->user_session['builder_id'],
								'project_id' => $this->project_id,
								'module_name' => $this->module,
								'module_pk_id' => $this->write_db->insert_id(),
								'from_user_id' => $this->user_session['ub_user_id'],
								'to_user_id' => $find_email_id_based_on_id,
								'type' => 'selection_sub_price_submitted',
								'subject' => 'content will update',
								'message' => 'content will update'
									);
						}else{
						$post_array_details = array(
								'builder_id' => $this->user_session['builder_id'],
								'project_id' => $this->project_id,
								'module_name' => $this->module,
								'module_pk_id' => $this->write_db->insert_id(),
								'from_user_id' => $this->user_session['ub_user_id'],
								'to_user_id' => $find_email_id_based_on_id,
								'type' => 'selection_choice_added',
								'subject' => 'content will update',
								'message' => 'content will update'
									);
						}
						$notification_array = array(
								'template_name' => 'selection_choice_added',
								'content_array' => $content_array,
								'notification' => $post_array_details,
								'default' => 'No'
								);
						// echo '<pre>';print_r($notification_array);exit;
						/* SMS code was added by chandru 02-09-2015 */
						$msg_user_id = $this->Mod_user->get_sms_preference_user_id($find_email_id_based_on_id,$this->main_modules[$this->module]);
						if(isset($msg_user_id) && !empty($msg_user_id))
						{
							$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
						}
						$notification_responce = $this->Mod_notification->send_mail($notification_array);
						if($post_array['subcontractor_price_tbd'] == 'Yes')
						{
							/* SMS code was added by chandru 02-09-2015 */
							$msg_user_id = $this->Mod_user->get_sms_preference_user_id($find_email_id_based_on_id,$this->main_modules[$this->module]);
							if(isset($msg_user_id) && !empty($msg_user_id))
							{
								$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
							}
							$notification_responce = $this->Mod_notification->send_mail($notification_array);
						}
						$data['insert_id'] =  $selection_choice_id;
						$data['status'] = TRUE;
						$data['message'] = 'Data inserted successfully';
						}else{
							$data['insert_id'] =  $selection_choice_id;
							$data['status'] = TRUE;
							$data['message'] = 'Data inserted successfully';
							return $data;  
						 }
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'Insert Failed: Failed to insert the data';
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
	* Get Selection choices list
	*
	* @method: get_selection_choice_list
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon(DD-MM-YYYY): 30-04-2015
	*/
	
	public function get_selection_choice_list($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SELECTION_CHOICE.' AS UB_SELECTION_CHOICE');
		//Join
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = UB_SELECTION_CHOICE.created_by');
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		
		$res = $this->read_db->get();
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		// echo $this->read_db->last_query();
		
		return $data;
	}
	
	public function delete_selections($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_selection_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_selection_id'] as $key=>$ub_selection_id)
			{

				//$this->write_db->delete(UB_SELECTION, array('ub_selection_id' => $ub_selection_id));
				 $post_array = array('status' => 'Cancel Selection');
				 $this->write_db->where('ub_selection_id', $ub_selection_id);
				 $this->write_db->update(UB_SELECTION, $post_array);
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Minutes of Meeting deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Selection id is not set';
		}
		return $data;

	}
	/**
	*
	* Update selection choices Status
	*
	* @method: update_selection_choices
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon(DD-MM-YYYY): 06-05-2015
	*/
	public function update_selection_choices($post_array = array())
	{
		if(isset($post_array['condition_check']) && $post_array['condition_check'] == 'condition_check' && $post_array['condition_check'] != "")
		{
			$selections_table_update_status_array = array(
					'ub_selection_choice_id' => $post_array['ub_selection_choice_id'],
					'status' => $post_array['status']
					);
		}else{
		$selections_table_update_status_array = array(
					'ub_selection_choice_id' => $post_array['ub_selection_choice_id'],
					'status' => $post_array['status'],
					'title' => $post_array['title'],
					'standard_choice' => $post_array['standard_choice'],
					'product_url' => $post_array['product_url'],
					'owner_price_tbd' => $post_array['owner_price_tbd'],
					'owner_price' => $post_array['owner_price'],
					'subcontractor_price_tbd' => $post_array['subcontractor_price_tbd'],
					'subcontractor_price' => $post_array['subcontractor_price'],
					'sub_pricing_comments' => $post_array['sub_pricing_comments'],
					'description' => $post_array['description'],
					'vendor_id' => $post_array['vendor_id'],
					'installer_id' => $post_array['installer_id'],
					);
		}
		$this->write_db->where('ub_selection_choice_id', $post_array['ub_selection_choice_id']);
		$this->write_db->update(UB_SELECTION_CHOICE, $selections_table_update_status_array);
		//Based on 'selection choice' status 'selection' status was modified.
		if($post_array['status'] == 'Pending')
		{
			$selections_choice_table_update_status_array = array(
						'status' => 'Waiting for choice approval'
						);
		}
		if($post_array['status'] == 'Approved')
		{
			 // FETCH BUILDER NAME
			/* $builder_id = $this->user_session['builder_id'];
			$condition_post_array =  array('ub_builder_id'=>$builder_id);
			$builder_details_array = $this->Mod_builder->get_builder_details(array(
										'select_fields' => array('builder_name'),
										'where_clause' => $condition_post_array
										));
			$builder_name = $builder_details_array['aaData']['0']['builder_name'];
			$selection_name = $post_array['ub_selection_name'];
			// Sub contractor id 
			$sub_contractor_condition_post_array =  array('ub_selection_choice_id'=>$post_array['ub_selection_choice_id']);
			$sub_contractor_details_array = $this->get_selection_choice_list(array(
										'select_fields' => array('title','vendor_id'),
										'where_clause' => $sub_contractor_condition_post_array
										));
			$choice_title = $sub_contractor_details_array['aaData']['0']['title'];
			$choice_vendor_id = $sub_contractor_details_array['aaData']['0']['vendor_id'];
			$find_email_id_based_on_id = $builder_id.','.$choice_vendor_id;
			$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($find_email_id_based_on_id,$this->main_modules[$this->module]);
			//Fetch user details
			$post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			$where_str = $this->Mod_selections->build_where($post_array_value);
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
					$assigned_to_first_name[] = $val['first_name'];
					$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
				}
			$to_address = implode(",",$email_ids);
			$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
			}
			}else{
				$data['status'] = TRUE;
				$data['message'] = 'Mail not sent';
				return $data; 
			 }
			// Building notification array 
			$scheduler  = $this->Mod_builder->get_builder_logo($this->builder_id); 
			 $content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'selection_name' => $selection_name,
					'project_name' => $this->project_name,
					'choice_title' => $choice_title,
					'builder_name' => $builder_name,
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
						);
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $this->project_id,
					'module_name' => $this->module,
					'module_pk_id' => $post_array['ub_selection_choice_id'],
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => $find_email_id_based_on_id,
					'type' => 'selection_choice_approved_by_owner',
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => 'selection_choice_approved_by_owner',
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			// echo '<pre>';print_r($notification_array);exit;
			$notification_responce = $this->Mod_notification->send_mail($notification_array); */
			$selections_choice_table_update_status_array = array(
						'status' => 'Choice approved',
						'approved_price' => $post_array['owner_price'],
						);
		}
		if($post_array['status'] == 'Declined')
		{
			$selections_choice_table_update_status_array = array(
						'status' => 'Cancel Selection'
						);
		}
		/* if($post_array['status'] == 'approved')
		{
			$selections_choice_table_update_status_array = array(
						'status' => 'choice approved'
						);
		} */
		/* if(isset($post_array['condition_check']) && $post_array['condition_check'] == 'condition_check' && $post_array['condition_check'] != "")
		{
			$this->write_db->where('ub_selection_id', $post_array['ub_selection_id']);
		}else{
			$this->write_db->where('ub_selection_id', $post_array['ub_selection_id']);
		} */
		if(isset($post_array['status']) && !empty($post_array['status']))
		{
			$this->write_db->where('ub_selection_id', $post_array['ub_selection_id']);
			$this->write_db->update(UB_SELECTION, $selections_choice_table_update_status_array);
		}
		$data['insert_id'] =  $post_array['ub_selection_choice_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Updated successfully';
		return $data;
	}
	
	
	/**
	*
	* Update selection Status
	*
	* @method: update_selection_status
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon(DD-MM-YYYY): 06-05-2015
	*/
	public function update_selection_status($post_array = array())
	{
		//print_r($post_array);exit;
		$this->write_db->where('ub_selection_id', $post_array['ub_selection_id']);
		$post_array['approved_price'] = '';
		$this->write_db->update(UB_SELECTION, $post_array);
		if($post_array['status'] == 'Pending')
		{	
			$choice_update_arry = array();
			$choice_update_arry['status'] = $post_array['status'];
			$this->write_db->where('selection_id', $post_array['ub_selection_id']);
		    $this->write_db->update(UB_SELECTION_CHOICE, $choice_update_arry);
		}
		$data['insert_id'] =  $post_array['ub_selection_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Updated successfully';
		return $data;
	}
	
	/**
	*
	* Delete Selection
	*
	* @method: delete_selection
	* @access: public 
	* @param: post data
	* @return: return data
	* @created by: chandru
	* @created on: 14-07-2015
	*/
	public function delete_selection($delete_array)
	{
		if(isset($delete_array['ub_selection_id']))
		{
			foreach($delete_array['ub_selection_id'] as $key=>$ub_selection_id)
			{
				//$this->write_db->delete(UB_SELECTION, array('ub_selection_id' => $ub_selection_id));
				 $post_array = array('status' => 'Deleted');
				 $this->write_db->where('ub_selection_id', $ub_selection_id);
				 $this->write_db->update(UB_SELECTION, $post_array);
				 /* Below code was added by chandru for soft delete */
				 $post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_selection_id', $ub_selection_id);
				$this->write_db->update(UB_SELECTION, $post_array);
				/* Find folder id */
				$ui_folder_name = 'selections'.$ub_selection_id;
				/* Based on SELECTION id find project id */
				$project_id_array = $this->get_selections(array(
					'select_fields' => array('SELECTION.project_id'),
					'where_clause' => array('SELECTION.ub_selection_id'=>$ub_selection_id)
				));
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_selections->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_selection_id);
				/* Delete in reminder table */
				$delete_reminder = $this->Mod_reminder->delete_reminder($ub_selection_id, $module_name, $this->builder_id);
			}
			$data['status'] = TRUE;
			$data['message'] = 'Selection(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Selection id is not set';
		}
		return $data;
	}
	
}