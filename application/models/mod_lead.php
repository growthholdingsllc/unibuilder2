<?php
/** 
 * Lead Model
 * 
 * @package: Lead Model
 * @subpackage: Lead Model 
 * @category: Lead
 * @author: Devansh
 * @createdon(DD-MM-YYYY): 25-04-2015
*/
class Mod_lead extends UNI_Model
{
	public $lead_id;
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['ub_user_id'])?$this->user_session['ub_user_id']:0;
		$this->lead_id = 0;
		parent::__construct();
    }
	
	/** 
	*user_check method will check for user authentication
	* 
	* @method: lead_check
	* @access: public 
	* @param: post data and fields to be fetched from table
	* @return: Boolean value 
	*/
	public function lead_check($post_array = array(), $select_fileds = '*')
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
	*update_data method will update userdata
	* 
	* @method: update_data
	* @access: public 
	* @param: data array, where condition and table name
	* @return: Boolean value 
	*/
	
	public function update_data($table_name = '', $data = array(), $where = array())
	{	
		$data['modified_on'] = TODAY;
		$result = $this->write_db->update($table_name, $data, $where);
		if($result > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	

	/** 
	* Get lead information
	* @method: get_leads
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_leads($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_LEAD.' AS LEAD');	//UB_LEAD is the table name defined in constant file
		$this->read_db->where(array('is_delete' => 'No'));
		
		// Join Tables
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
				$this->read_db->join(UB_USER.' AS USER','LEAD.sales_person = USER.ub_user_id','left');//UB_BUILDER is the table name defined in constant file
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
		//echo $this->read_db->last_query();
		return $data;
	}

	/**
	*
	* Update task
	* @created on: 12/04/2015
	* @method: update_leads
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Devansh
	*/
	public function update_lead($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->write_db->where('ub_lead_id', $post_array['ub_lead_id']);
			$this->write_db->update(UB_LEAD, $post_array);
			$data['insert_id'] =  $post_array['ub_lead_id'];
			$data['status'] = TRUE;
			$data['message'] = 'Update successfully';
			return $data;
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
	* Add lead
	* @created on: 12/04/2015
	* @method: add_lead
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdby: Devansh
	*/
	public function add_lead($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->write_db->insert(UB_LEAD, $post_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$lead_insertid = $data['insert_id'];
				/* Below notification code was added by chandru 02-06-2015 */
				if($post_array['name'] != ''  && isset($post_array['sales_person']) && !empty($post_array['sales_person']))
				{
					$send_notification = $this->send_mail_for_notification($post_array,$lead_insertid);
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
	* Delete leads
	*
	* @method: delete_leads
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_leads($delete_array)
	{
		if(isset($delete_array['ub_lead_id']))
		{
			 //echo "<pre>";print_r($delete_array['ub_lead_id']);exit();
			foreach($delete_array['ub_lead_id'] as $lead_id)
			{
				// $this->write_db->delete(UB_LEAD, array('ub_lead_id' => $lead_id));
				/* Below code was added by chandru 12-10-2015 */
				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_lead_id', $lead_id);
				$this->write_db->update(UB_LEAD, $post_array);
				/* Find folder id */
				$ui_folder_name = 'leads'.$lead_id;
				$project_id = 0;
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_lead->folder_structure_delete($ui_folder_name, $project_id, $module_name, $lead_id);
				/* Delete in reminder table */
				$delete_reminder = $this->Mod_reminder->delete_reminder($lead_id, $module_name, $this->builder_id);
			}
			$data['status'] = TRUE;
			$data['message'] = 'Role(s) deleted successfully';
		}

        /*if(isset($delete_array['ub_lead_id']))
		{
			$lead_id = $delete_array['ub_lead_id'];
			$this->write_db->delete(UB_LEAD, array('ub_lead_id' => $lead_id));
			$data['status'] = TRUE;
			$data['message'] = 'lead(s) deleted successfully';
		}*/
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'lead id is not set';
		}
		return $data;
	}
	/**
	*
	* Delete Activity
	*
	* @method: delete_leads
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_activity($delete_array)
	{
		if(isset($delete_array['ub_lead_id']))
		{
			 //echo "<pre>";print_r($delete_array['ub_lead_id']);exit();
			foreach($delete_array['ub_lead_id'] as $lead_id)
			{
				$this->write_db->delete(UB_LEAD_ACTIVITY, array('lead_id' => $lead_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'lead(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'lead id is not set';
		}
		return $data;
	}

	/** 
	* Get Activity information
	* @method: get_activity
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_activity($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_LEAD_ACTIVITY.' AS LEAD_ACTIVITY');	//UB_LEAD_ACTIVITY is the table name defined in constant file
		
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
				$this->read_db->join(UB_USER.' AS USER','LEAD_ACTIVITY.sales_person = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
		}
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
				$this->read_db->join(UB_LEAD.' AS LEAD','LEAD_ACTIVITY.lead_id = LEAD.ub_lead_id','left');//UB_LEAD is the table name defined in constant file
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
		$records = $res->result_array();
		if (!empty($records['0']['followup_date'])) {
			$md = explode("/", $records['0']['followup_date']); // split the array
			$nd = $md[2]."-".$md[1]."-".$md[0]; // join them together
			$followup_date = date('m/d/Y', strtotime($nd));
			$records['0']['followup_date'] = $followup_date;
		}
		if (!empty($records['0']['activity_date'])) {
			$md = explode("/", $records['0']['activity_date']); // split the array
			$nd = $md[2]."-".$md[1]."-".$md[0]; // join them together
			$activity_date = date('m/d/Y', strtotime($nd));
			$records['0']['activity_date'] = $activity_date;
		}
		
		//echo '<pre>';print_r($records);exit;

		//echo $this->read_db->last_query();
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $records;
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		return $data;
	}
	/**
	*
	* Add Activity
	* @created on: 23/04/2015
	* @method: add_activity
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdby: Devansh
	*/
	public function add_activity($post_array = array())
	{
		 //echo '<pre>';print_r($post_array);exit;
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if (isset($post_array['schedule_followup']) && !empty($post_array['schedule_followup'])) 
			{
				$schedule_followup = $post_array['schedule_followup'];
				$followup_time = $post_array['followup_time'];
				if (isset($post_array['reminder_datetime']) && !empty($post_array['reminder_datetime'])) {
					$reminder_datetime = $post_array['reminder_datetime'];
				}
				if (!empty($schedule_followup) && $schedule_followup > TODAY) 
				{
					$post_array['followup_date'] = $schedule_followup;
					unset($post_array['reminder_datetime']);
				}
				else
				{
					unset($post_array['followup_time']);
				}
				unset($post_array['schedule_followup']);
				
				//echo '<pre>';print_r($post_array);exit;
				if($this->write_db->insert(UB_LEAD_ACTIVITY, $post_array))
				{
					$data['insert_id'] =  $this->write_db->insert_id();
					if (!empty($schedule_followup) && $schedule_followup > TODAY) 
					{
						$post_array['followup_link_to'] = $data['insert_id'];
						$post_array['activity_date'] = $schedule_followup;
						$post_array['activity_time'] = $followup_time;
						$post_array['reminder_datetime'] = $reminder_datetime;
						$post_array['activity_datetime'] = $post_array['activity_date']. ' ' .$post_array['activity_time'];
						unset($post_array['followup_date']);
						unset($post_array['mark_completed_status']);
						unset($post_array['followup_time']);
						unset($post_array['schedule_followup']);
						if(!empty($post_array['followup_link_to'] ))
						{
							//echo '<pre>';print_r($post_array);exit;
							if ($this->write_db->insert(UB_LEAD_ACTIVITY, $post_array)) 
							{
								$data['insert_id'] =  $this->write_db->insert_id();
								$data['status'] = TRUE;
							} 
							else 
							{
								$data['status'] = FALSE;
								$data['message'] = 'Insert Failed: Failed to insert the 2nd data';
							}
						}
						else
						{
							$data['status'] = FALSE;
							$data['message'] = 'Insert Failed: Failed to inserthjjj the data';
						}
					}
					else
					{
						$data['status'] = TRUE;
						$data['message'] = 'Activity added successfully with no followup';
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
				$post_array['activity_datetime'] = $post_array['activity_date']. ' ' .$post_array['activity_time'];
				if (!empty($post_array['activity_datetime']) && $post_array['activity_datetime'] > TODAY) 
				{
					$post_array['reminder_datetime'];
				}
				else
				{
					unset($post_array['reminder_datetime']);
				}
				unset($post_array['schedule_followup']);
				unset($post_array['followup_time']);
				if($this->write_db->insert(UB_LEAD_ACTIVITY, $post_array))
				{
					$data['insert_id'] =  $this->write_db->insert_id();
					$data['status'] = TRUE;
					//$data['message'] = 'Data inserted successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Failed to insert the data';
				}
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
	* Update activity
	* @created on: 12/04/2015
	* @method: update_activity
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Devansh
	*/
	public function update_activity($post_array = array())
	{
		//echo '<pre>';print_r($post_array);exit;
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if (isset($post_array['ub_lead_activity_id']) && !empty($post_array['ub_lead_activity_id'])) 
			{
				if (isset($post_array['schedule_followup']) && !empty($post_array['schedule_followup'])) {
					$schedule_followup = $post_array['schedule_followup'];
					$post_array['followup_date'] = $schedule_followup;
				}
				if (isset($post_array['followup_time']) && !empty($post_array['followup_time'])) {
					$followup_time = $post_array['followup_time'];
				}
				if (isset($post_array['reminder_datetime']) && !empty($post_array['reminder_datetime'])) {
					$reminder_datetime = $post_array['reminder_datetime'];
				}
				if (isset($post_array['followup_date']) && !empty($post_array['followup_date']) && $post_array['followup_date'] > TODAY) {
					$post_array['followup_date'] = $post_array['followup_date'];
				}
				else{
					unset($post_array['followup_date']);
				}
				unset($post_array['reminder_datetime']);
				unset($post_array['schedule_followup']);
				unset($post_array['followup_time']);
				//echo '<pre>';print_r($post_array);exit;
				$this->write_db->where('ub_lead_activity_id', $post_array['ub_lead_activity_id']);
				if($this->write_db->update(UB_LEAD_ACTIVITY, $post_array))
				{
					//echo $this->write_db->last_query();
					$data['insert_id'] =  $post_array['ub_lead_activity_id'];
					$data['status'] = TRUE;
					if (!empty($schedule_followup) && $schedule_followup > TODAY) 
					{
						$post_array['followup_link_to'] = $data['insert_id'];
						$post_array['activity_date'] = $schedule_followup;
						$post_array['activity_time'] = $followup_time;
						$post_array['reminder_datetime'] = $reminder_datetime;
						$post_array['activity_datetime'] = $post_array['activity_date']. ' ' .$post_array['activity_time'];
						unset($post_array['followup_date']);
						unset($post_array['mark_completed_status']);
						unset($post_array['followup_time']);
						unset($post_array['ub_lead_activity_id']);
						unset($post_array['schedule_followup']);
						if(!empty($post_array['followup_link_to'] ))
						{
							//echo '<pre>';print_r($post_array);exit;
							$this->write_db->where('followup_link_to', $post_array['followup_link_to']);
							if ($this->write_db->update(UB_LEAD_ACTIVITY, $post_array)) 
							{
								$data['insert_id'] =  $post_array['followup_link_to'];
								$data['status'] = TRUE;
							} 
							else 
							{
								$data['status'] = FALSE;
								$data['message'] = 'Insert Failed: Failed to insert the 2nd data';
							}
						}
						else
						{
							$data['status'] = FALSE;
							$data['message'] = 'Insert Failed: Failed to inserthjjj the data';
						}
					}
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Failed to update the data';
				}
			} 
			else
			{
				$post_array['activity_datetime'] = $post_array['activity_date']. ' ' .$post_array['activity_time'];
				if (!empty($post_array['activity_datetime']) && $post_array['activity_datetime'] > TODAY) 
				{
					$post_array['reminder_datetime'];
				}
				else
				{
					unset($post_array['reminder_datetime']);
				}
				if($this->write_db->insert(UB_LEAD_ACTIVITY, $post_array))
				{
					$data['insert_id'] =  $this->write_db->insert_id();
					$data['status'] = TRUE;
					//$data['message'] = 'Data inserted successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Failed to insert the data';
				}
			}
		}
		return $data;
	}
	
	/* Below function was added by chandru 01/06/2015 */
	public function send_mail_for_notification($post_array = array(),$lead_insertid)
	{
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($post_array['sales_person'],$this->main_modules[$this->module]);
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
		 }else{
			return FALSE;
		 }
		 /* FETCH BUILDER NAME */
		 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('builder_name'),
												'where_clause' => $condition_post_array
												));
		$builder_name = $builder_details_array['aaData']['0']['builder_name'];
		if(isset($post_array['template_name']) && $post_array['template_name'] == 'lead_assigned_to_activity_by_another_bu')
		{
		// echo '<pre>';print_r($post_array);exit;
		/* Find Lead name */
					$query_array = array('select_fields' => array('ub_lead_id','name'),
								'where_clause' => array('ub_lead_id'=>$post_array['lead_id'])
								);
					$result_data = $this->Mod_lead->get_leads($query_array);
					$lead_name = $result_data['aaData'][0]['name'];
			$template_type = 'lead_assigned_to_activity_by_another_bu';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'lead_name' => $lead_name,
						'name' => $post_array['activity_type'],
						'due' => $post_array['activity_datetime'],
						'description' => $post_array['description'],
						'sales_person' => $post_array['sales_person'],
						'builder_name' => $builder_name,
						'base_url'=> BASEURL
					);
				
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $this->project_id,
					'module_name' => $this->module,
					'module_pk_id' => $lead_insertid,
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => $post_array['sales_person'],
					'type' => $template_type,
					'subject' => 'content will update',
					'message' => 'content will update'
						);
		}else{
			$template_type = 'lead_sales_person_change';
			 $content_array = array(
				'TO_EMAIL' => $email_ids,
				'SEND_MAIL_INFO' => $level1_string,
				'IMAGESRC' => IMAGESRC,
				'name' => $post_array['name'],
				'sales_person' => $post_array['sales_person'],
				'builder_name' => $builder_name,
				'base_url'=> BASEURL
			);
		
		$post_array_details = array(
			'builder_id' => $this->user_session['builder_id'],
			'project_id' => $this->project_id,
			'module_name' => $this->module,
			'module_pk_id' => $lead_insertid,
			'from_user_id' => $this->user_session['ub_user_id'],
			'to_user_id' => $post_array['sales_person'],
			'type' => $template_type,
			'subject' => 'content will update',
			'message' => 'content will update'
				);
						}
			$notification_array = array(
					'template_name' => $template_type,
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($post_array['sales_person'],$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
			}
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
			// $mail_responce = $this->Mod_mail->send_mail('SEND_MAIL_TO_TASK_ASSIGNED_USERS', $content_array);
			return $notification_responce;
	}
	
}

/* End of file mod_lead.php */
/* Location: ./application/models/mod_lead.php */
