<?php
/** 
 * Notification Class
 * 
 * @package: Notification 
 * @subpackage:  
 * @category: Notification
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 18-05-2015 
*/
/** 
 * PHP Mailer library included for sending email
 * 
*/
class Mod_notification extends UNI_Model{
	/**
	 * @property: $main_modules
	 * @access: public
	 */
	protected $notification_type = array(
        'lead_other_employee_contacted' => 'Other Employee Contacted Lead',
        'lead_sales_person_change' => 'lead Sales Person Change/New lead sales person assigning',
        'lead_activity_reminder' => 'Activity Reminder',
        'lead_email_alerts' => 'Email Alerts',
        'lead_assigned_to_activity_by_another_bu' => 'Assigned to a Lead activity by another internal user',
        'project_owner_activatoin' => 'Owner Login Activation',
        'log_daily_log_added' => 'Daily Log Added',
        'log_comment_on_daily_log' => 'Comment added in a daily log',
        'task_completed_or_opened_by_others' => 'Tasks completed by others/A completed task opened by others',
        'task_comment' => 'A Comment added in Task',
        'task_new_file_added' => 'A new file added in Task',
        'task_deadline_reminder' => 'Task Deadline Reminder',
        'bid_submitted_by_sub' => 'Bid Submitted by Sub',
        'bid_rfi_ve' => 'RFI/VE Created/Assigned/Answered',
        'bid_comment' => 'Bid Comment Added',
        'bid_rfi_ve_reminder' => 'RFI/VE Answer By Reminder',
        'bid_accepted_by_bu' => 'Bid Accepted by Builder',
        'message_add' => 'A New Message',
        'budget_payapp_released' => 'PayApp Released',
        'budget_payapp_payment_made' => 'Payment made for PayApp',
        'budget_po_co_approved' => 'PO/CO Approved by Sub',
        'budget_po_co_ready_for_payment' => 'PO/CO Marked Ready For Payment',
        'budget_po_co_assigned_internally' => 'PO/CO Assigned Internally',
        'budget_po_co_payment_request_created' => 'PO/CO Payment Request Created',
        'budget_po_co_work_completed' => 'PO/CO Work Completed and Ready for payment',
        'budget_po_co_payment_made' => 'PO/CO Payment Made',
        'budget_po_co_comments' => 'PO/CO Comment added',
        'budget_po_co_payment_reminder' => 'PO/CO Payment reminder',
        'budget_po_co_required_document_uploaded' => 'PO/CO Required documents uploaded by Sub',
        'budget_po_co_document_overridden' => 'PO/Co required document overridden by Builder User',
        'warranty_new_claim_added_by_owner' => 'New Claim Added by owner',
        'warranty_followup_reminder' => 'Followup Reminder',
        'warranty_appointment_updates_from_owner' => 'Warranty Appt updates from Owner',
        'warranty_appointment_updates_from_sub' => 'Warranty Appt updates from Sub',
        'warranty_feedback' => 'Warranty has feedback',
        'warranty_added_internally' => 'Warranty added internally',
        'warranty_dicussion' => 'Warranty discussion added',
        'selection_choice_approved_by_owner' => 'Choice Approved by Owner',
        'selection_deadline_reminder' => 'Selections deadline reminder',
        'selection_dicussion' => 'Selections discussion added',
        'selection_choice_added' => 'Selections Choice added',
        'selection_sub_price_submitted' => 'Selection Sub price Submitted',
        'sub_bu_activiation' => 'Sub/Builder user Activation',
        'sub_certificate_expiry' => 'Certificate expiry',
        'schedule_item_reminder' => 'Schedule Item reminder',
        'schedule_task_completed' => 'Task Completed by other',
        'schedule_deadline_change' => 'Deadline change of an item',
        'Owner_login_activation' => 'Owner Login Activation',
		'survey_released' => 'survey_released'
    );
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
	* @method: add_notification 
	* @access: public 
	* @param: notification_array 
	* @return: array 
	*/
	public function add_notification($notification_array) {
        /* Notification_Array should contain below data 
			1.builder_id
			2.project_id
			3.module_name
			4.module_pk_id
			5.from_user_id
			6.to_user_id
			7.type
			8.subject
			9.message
		*/
		if(!empty($notification_array))
		{
			
			$notification_array['type'] = $this->notification_type[$notification_array['type']];
			if(isset($this->user_session['ub_user_id']))
			{
				$created_by = $this->user_session['ub_user_id'];
			}else{
				$created_by = 0;
			}
			$notification_array['created_by'] = $created_by;
			$notification_array['created_on'] = TODAY;
			$notification_array['modified_by'] = $created_by;
			$notification_array['modified_on'] = TODAY;
			if($this->write_db->insert(UB_NOTIFICATION, $notification_array))
				{
					$data['notification_id'] =  $this->write_db->insert_id();
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
	* Add reminders
	* 
	* @method: add_notification 
	* @access: public 
	* @param: notification_array 
	* @return: array 
	*/
	public function send_mail($notification_array = array()) {
		//print_r($notification_array);exit;
        $response = $this->add_notification($notification_array['notification']);
		if($response['status'] === TRUE)
		{
			$notification_array['content_array']['notification_id'] = $response['notification_id'];
			$this->Mod_mail->send_mail($notification_array['template_name'], $notification_array['content_array'], $notification_array['default']); 
		}
		return TRUE;
    }
	
	/**
	* Get Notification
	* @created on: 16/05/2015
	* @method: get_notification
	* @access: public 
	* @param: file_location
	* @return: True if the email is processed
	* @createdby: GAYATHRI KALYANI
	*/
	public function get_notification($args = array())
	{

		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from('ub_notification'.' AS NOTIFICATION');
		// Join Tables

		if(isset($args['join']['project']) && 'yes' === strtolower($args['join']['project']))
			{
			$this->read_db->join('ub_project'.' AS PROJECT','NOTIFICATION.project_id = PROJECT.ub_project_id');
			}
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
			{
			$this->read_db->join('ub_user'.' AS USER', 'NOTIFICATION.to_user_id= USER.ub_user_id');
			}
		if(isset($args['join']['role']) && 'yes' === strtolower($args['join']['role']))
			{
			$this->read_db->join('ub_user'.' AS USERS', 'NOTIFICATION.from_user_id= USERS.ub_user_id');
			$this->read_db->join('ub_role'.' AS ROLE', 'ROLE.ub_role_id= USERS.role_id');
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
	   // echo '<br>'.$this->read_db->last_query();
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
	* Get Notification Types
	* @created on: 18/05/2015
	* @method: get_notification_types
	* @access: public 
	* @param: 
	* @return: array
	* @createdby: GAYATHRI KALYANI
	*/
	public function get_notification_types()
	{
		//print_r($this->notification_type);exit;
		$aaa = array_values($this->notification_type);
		$bbb = $this->notification_type;
        $result = array_combine($aaa, $bbb);
		//print_r($result);exit;
		return $result;
	}
	
	/* Below function was added by chandru */
	public function send_sms_notifications($msg_user_id = '', $post_array_details = array(), $content_array = array())
	{
		if($msg_user_id != '')
		{
			$post_array_value[] = array(
						'field_name' => 'ub_user_id',
						'value'=> $msg_user_id, 
						'type' => '||',
						'classification' => 'primary_ids'
						);
				$where_str = $this->Mod_user->build_where($post_array_value);
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
							$msg_responce = $this->Mod_sms->send_sms($post_array_details['type'], $msg_array, $content_array);
							if(TRUE == $msg_responce)
							{
								$post_array_details['from_user_id'] = 0;
								$post_array_details['notification_type'] = 'Sms';
								$add_notification = $this->Mod_notification->add_notification($post_array_details);
							}
						}
					}
				}else{
					// echo 'Not a valid user id';
				}
		}
	}
	
}
/* End of file mod_mail.php */
/* Location: ./application/models/mod_mail.php */