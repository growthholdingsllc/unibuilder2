<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * builder_dashboard Class
 * 
 * @package: builder_dashboard
 * @subpackage: builder_dashboard
 * @category: builder_dashboard
 * @author: satheesh kumar
 * @createdon(DD-MM-YYYY): 06-05-2015 
*/
class builder_dashboard extends UNI_Controller {
	/**
	 * @constructor
	 */
	public $display_length = 0;
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_task','Mod_user', 'Mod_project','Mod_comment','Mod_log','Mod_warranty','Mod_schedule','Mod_role','Mod_notification','Mod_reminder','Mod_budget'));
		$args =array('classification'=>'dashboard_item_display_length'); 
		$dashboard_item_length_array = $this->Mod_general_value->get_general_value($args);
		if($dashboard_item_length_array['status']== TRUE)
		{
			$this->display_length = $dashboard_item_length_array['values'][0]['value'];
		}
    }
	/** 
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/
	public function index()
	{	
		$this->module = 'COMMON_PROJECT';
		/* if(!empty($this->project_id))
		{
		$where_str = 'PROJECT.builder_id = '.$this->builder_id.' AND PROJECT.ub_project_id ='.$this->project_id;
		$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.postal','PROJECT.country'),
					'where_clause' => $where_str
					));
		$weather['address'] = $project_list['aaData'][0]['address'];
		$weather['city']    = $project_list['aaData'][0]['city'];
		$weather['province']    = $project_list['aaData'][0]['province'];
		$weather['postal']    = $project_list['aaData'][0]['postal'];
		$weather['country']    = $project_list['aaData'][0]['country'];
		$get_weather_report_array_result = $this->Mod_user->get_weather_report($weather);
		}
		else
		{
		$weather['address'] = $this->user_session['address'];
		$weather['city']   = $this->user_session['city'];
		$weather['province']    = $this->user_session['province'];
		$weather['postal']    = $this->user_session['postal'];
		$weather['country']    = $this->user_session['country'];
		$get_weather_report_array_result = $this->Mod_user->get_weather_report($weather);
		} */
		$data = array(
						'title'        => "UNIBUILDER",		
						'content'      => 'content/dashboard/builder_dashboard',
						'page_id'      => 'dashboard'
						//'get_weather_report_array_result'      => $get_weather_report_array_result
						);
		$this->template->view($data);
	}
	/** 
	* set project details in session
	* 
	* @method: set_project_details_in_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 09/05/2015 
	*/	
	public function set_project_details_in_session()
	{	
		$result = $this->sanitize_input();
		if(TRUE === $result['status'])
		{
			
			$this->module = 'COMMON_PROJECT';
			if(isset($result['data']['project_id']) && $result['data']['project_id'] != 'all_project')
			{
				$where_str = 'PROJECT.ub_project_id = '.$result['data']['project_id'];
				$project_details = $this->Mod_project->get_projects(array(
													'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name','PROJECT.project_status'),
													'where_clause' => $where_str,
													'group_clause' => array("PROJECT.ub_project_id") 
													));
				$result['data']['project_status'] = $project_details['aaData'][0]['project_status'];	
			}			
			$response = $this->set_project_info_in_session($result['data']);			
			//$response['redirect_url'] = base_url().$this->crypt->encrypt('builder_dashboard/index/');
			// $parameters = explode("/",$result['data']['redirect_url']);
			$budget_url = base_url().$this->crypt->encrypt('budget/project_budget/');
			$budget_hash = strstr($result['data']['redirect_url'], '#');
			$budget_current_url = strstr($result['data']['redirect_url'], '#', true);
			if($response['status'] == TRUE)
			{
				if($budget_url == $budget_current_url && $budget_hash == '#summary')
				{
					// echo '<pre>';print_r('summary');
					if($result['data']['project_id'] != 'all_project')
					{
						$response['redirect_url'] = base_url().$this->crypt->encrypt('budget/project_budget/').'#jobs';
					}
					else
					{
						$response['redirect_url'] = $result['data']['redirect_url'];
					}
				}
				else if($budget_url == $budget_current_url && $budget_hash == '#jobs')
				{
					// echo '<pre>';print_r('jobs');
					if($result['data']['project_id'] == 'all_project')
					{
						$response['redirect_url'] = base_url().$this->crypt->encrypt('budget/project_budget/').'#summary';
					}
					else
					{
						$response['redirect_url'] = $result['data']['redirect_url'];
					}
				}
				else
				{
					$response['redirect_url'] = $result['data']['redirect_url'];
				}
			}
			// echo '<pre>';print_r($response['redirect_url']);exit;
			// $response['redirect_url'] = $result['data']['redirect_url'];
			$this->Mod_task->response($response);
		}	
	}
	/** 
	* get role id based on project_id
	* 
	* @method: get_tasks 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 06/05/2015 
	*/	
	
	/** 
	* dashboard comments
	* 
	* @method: get_comments 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 06/05/2015 
	*/	
	public function get_comments()
	{	
		if(!empty($this->project_id))
		{
			$post_array[] = array(
									'field_name' => 'COMMENT.project_id',
									'value'=> $this->project_id, 
									'type' => '='
								);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'COMMENT.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}				
		$post_array[] = array(
								'field_name' => 'COMMENT.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
							);
		/* $post_array[] = array(
								'field_name' => 'USER.account_type',
								'value'=> OWNER.','.SUBCONTRACTOR,
								'type' => '||',
								'classification' => 'primary_ids'
							); */
		$where_str = $this->Mod_task->build_where($post_array);	
		$order_by_where = "COMMENT.modified_on desc LIMIT ".$this->display_length;
		$date_array = array('COMMENT.created_on'=>'created_on');
		$all_comments = $this->Mod_comment->get_comment(array(
												'select_fields' => array('CONCAT_WS(" ", USER.first_name, USER.last_name) as creator','LEFT(COMMENT.comments,75)as comments','CHAR_LENGTH(COMMENT.comments) as length','USER.account_type','COMMENT.module_name','COMMENT.module_pk_id',$this->Mod_user->format_user_datetime($date_array,"date")),
												'where_clause' => $where_str,
												'join'=> array('user'=>'Yes'),
												'order_clause' => $order_by_where,
												));
												//echo '<pre>';print_r($all_comments);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/recent_comments.php", array('all_comments'=>$all_comments), true);
		echo $response; 
	}
	/** 
	* dashboard tasks
	* 
	* @method: get_tasks 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 06/05/2015 
	*/	
	public function get_tasks()
	{
		if(!empty($this->project_id))
		{
		$post_array[] = array(
								'field_name' => 'TASK.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'TASK.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}	
		$post_array[] = array(
								'field_name' => 'TASK.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
								);
		$post_array[] = array(
								'field_name' => 'TASK.task_assigned_users',
								'value'=> $this->user_id, 
								'type' => '||',
								'classification' => 'dynamnic_text'
								);
		$where_str = $this->Mod_task->build_where($post_array);	
		$order_by_where = "TASK.due_date asc LIMIT ".$this->display_length;
		
		
		$timezone_value = " DATE(CONVERT_TZ( '".TODAY."', '+00:00', '".$this->user_session['time_zone']."' ))";
		
		//echo '<pre>';print_r($this->user_session['time_zone']);exit; 
		$all_tasks = $this->Mod_task->get_tasks(array(
												'select_fields' => array('TASK.ub_task_id','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator','TASK.title','TASK.due_date','DATEDIFF('.$timezone_value.',TASK.due_date) AS DiffDate'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','ub_task_checklist'=>'No'),
												'order_clause' => $order_by_where,
												));
		//echo '<pre>';print_r($all_tasks);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/tasks.php", array('all_tasks'=>$all_tasks), true);
		echo $response; 
	}
	
	/** 
	* dashboard logs
	* 
	* @method: get_logs 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 06/05/2015
	*/	
	public function get_logs()
	{	
		if(!empty($this->project_id))
		{
			$post_array[] = array(
									'field_name' => 'LOG.project_id',
									'value'=> $this->project_id, 
									'type' => '='
								);
		} 
		else
		{
			$post_array[] = array(
							'field_name' => 'LOG.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}	
		$post_array[] = array(
								'field_name' => 'LOG.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
								);
		$post_array[] = array(
									'field_name' => 'LOG.is_delete',
									'value'=> 'No', 
									'type' => '='
									);
		//echo "<pre>";print_r($this->session->all_userdata());exit;								
		$where_str = $this->Mod_log->build_where($post_array);	
		$date_array = array('LOG.log_date'=>'log_date');
		$order_by_where = "LOG.log_date desc LIMIT ".$this->display_length;
		$all_logs = $this->Mod_log->get_logs(array(
												'select_fields' => array('LOG.ub_daily_log_id','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator',$this->Mod_user->format_user_datetime($date_array,"date")),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','user'=>'Yes','project'=>'Yes'),
												'order_clause' => $order_by_where,
												));
		//echo '<pre>';print_r($all_logs);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/daily_log.php", array('all_logs'=>$all_logs), true);
		echo $response; 
	}
	
	/** 
	* dashboard warranty
	* 
	* @method: get_warranty 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 07/05/2015
	*/	
	public function get_warranty()
	{	
		if(!empty($this->project_id))
		{
		$post_array[] = array(
								'field_name' => 'WARRANTY.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'WARRANTY.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}		
		$post_array[] = array(
								'field_name' => 'WARRANTY.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
								);	
		
		 $post_array[] = array(
									'field_name' => 'WARRANTY.is_delete',
									'value'=> 'No', 
									'type' => '='
									);
		$where_str = $this->Mod_warranty->build_where($post_array);	
		$group_by = 'WARRANTY.status';
		//$order_by_where = "count(WARRANTY.status) desc";
		$all_warranty = $this->Mod_warranty->get_warranty(array(
												'select_fields' => array('WARRANTY.status','count(WARRANTY.status) AS count'),
												'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','project'=>'Yes','warranty_appointment'=>'No'),
												//'order_clause' => $order_by_where,
												'group_clause' => $group_by
												));
		//echo '<pre>';print_r($all_warranty);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/warranty_alerts.php", array('all_warranty'=>$all_warranty), true);
		echo $response; 
	}
	
	/** 
	* dashboard today_schedule
	* 
	* @method: get_schedule 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 07/05/2015
	*/	
	public function get_schedule()
	{	
		if(!empty($this->project_id))
		{
		$post_array[] = array(
								'field_name' => 'SCHEDULE.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'SCHEDULE.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}		
		$post_array[] = array(
								'field_name' => 'SCHEDULE.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
								);	
		$post_array[] = array(
								'field_name' => 'SCHEDULE.is_completed',
								'value'=> 'No', 
								'type' => '='
								);		
		$post_array[] = array(
								'field_name' => 'SCHEDULE.start_date',
								'to'=> date(gmdate("Y-m-d")),
								'type' => 'daterange'
								);
		$post_array[] = array(
								'field_name' => 'SCHEDULE.end_date',
								'from'=> date(gmdate("Y-m-d")),
								'type' => 'daterange'
								);
		$where_str = $this->Mod_schedule->build_where($post_array);	
		//echo '<pre>';print_r($where_str);
		$date_array = array('SCHEDULE.start_date'=>'start_date');
		$order_by_where = "SCHEDULE.end_date asc LIMIT ".$this->display_length;
		$all_schedule = $this->Mod_schedule->get_schedules(array(
												'select_fields' => array('SCHEDULE.ub_schedule_id','SCHEDULE.title',$this->Mod_user->format_user_datetime($date_array,"date")),
												'where_clause' => $where_str,
												'join'=> array('project'=>'Yes'),
												'order_clause' => $order_by_where
												//'group_clause' => $group_by
												));
		//echo '<pre>';print_r($all_schedule);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/today_schedule.php", array('all_schedule'=>$all_schedule), true);
		echo $response; 
	}
	
	/** 
	* dashboard reminder
	* 
	* @method: get_reminder 
	* @access: public 
	* @param:  
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 20/05/2015
	*/	
	/* public function get_reminder()
	{	
		if(!empty($this->project_id))
		{
		$post_array[] = array(
								'field_name' => 'REMINDER.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
		} 
		$post_array[] = array(
								'field_name' => 'REMINDER.builder_id',
								'value'=> $this->user_session['builder_id'], 
								'type' => '='
								);	
        $post_array[] = array(
								'field_name' => 'REMINDER.status',
								'value'=> 'Not Send', 
								'type' => '='
								);								
		$post_array[] = array(
								'field_name' => 'REMINDER.reminder_end_time',
								'from'=> TODAY,
								'type' => 'daterange'
								);							
		$post_array[] = array(
								'field_name' => 'REMINDER.reminder_sent_on',
								'to'=> TODAY,
								'type' => 'daterange'
								);
		$where_str = $this->Mod_reminder->build_where($post_array);	
		//echo '<pre>';print_r($where_str);
		$order_by_where = "REMINDER.reminder_end_time asc LIMIT ".$this->display_length;
		$all_reminder = $this->Mod_reminder->get_reminder(array(
												'select_fields' => array('REMINDER.ub_reminder_id','REMINDER.message','REMINDER.reminder_end_time'),
												'where_clause' => $where_str,
												//'join'=> array('project'=>'Yes'),
												'order_clause' => $order_by_where
												//'group_clause' => $group_by
												));
		//echo '<pre>';print_r($all_reminder);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/current_reminders.php", array('all_reminder'=>$all_reminder), true);
		echo $response; 
	} */
	
	/** 
	* dashboard mail notification
	* 
	* @method: get_mail_notification 
	* @access: public 
	* @param:  
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 20/05/2015
	*/	
	public function get_mail_notification()
	{	
		if(!empty($this->project_id))
		{
		$post_array[] = array(
								'field_name' => 'NOTIFICATION.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'NOTIFICATION.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}		
		$post_array[] = array(
								'field_name' => 'NOTIFICATION.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
								);	
		$post_array[] = array(
								'field_name' => 'NOTIFICATION.to_user_id',
								'value'=> $this->user_id, 
								'type' => '='
								);
		$where_str = $this->Mod_notification->build_where($post_array);	
		//echo '<pre>';print_r($where_str);
		$order_by_where = "NOTIFICATION.modified_on desc LIMIT ".$this->display_length;
		$all_mail_notification = $this->Mod_notification->get_notification(array(
												'select_fields' => array('CONCAT_WS(" ", USERS.first_name, USERS.last_name) as creator','NOTIFICATION.ub_notification_id','NOTIFICATION.subject','ROLE.role_name'),
												'where_clause' => $where_str,
												'join'=> array('project'=>'Yes','role'=>'Yes'),
												'order_clause' => $order_by_where
												//'group_clause' => $group_by
												));
		//echo '<pre>';print_r($all_mail_notification);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/mail_notification.php", array('all_mail_notification'=>$all_mail_notification), true);
		echo $response; 
	}
	/** 
	* dashboard owner activity
	* 
	* @method: get_owner_activity 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 21/05/2015 
	*/	
	public function get_owner_activity()
	{	
		$post_array[] = array(
								'field_name' => 'USER.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
							);
		$post_array[] = array(
								'field_name' => 'USER.account_type',
								'value'=> OWNER, 
								'type' => '='
							);
		if(!empty($this->project_id))
		{
			$post_array[] = array(
								'field_name' => 'PROJECT.ub_project_id',
								'value'=> $this->project_id, 
								'type' => '='
								);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'PROJECT.ub_project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}	
		$where_str = $this->Mod_user->build_where($post_array);	
		$date_array = array('USER.last_login_time'=>'last_login_time');
		$order_by_where = "USER.last_login_time desc LIMIT ".$this->display_length;
		$all_owner_activity = $this->Mod_user->get_users(array(
												'select_fields' => array('PROJECT.project_name',$this->Mod_user->format_user_datetime($date_array)),
												'where_clause' => $where_str,
												'join'=> array('project_owner'=>'Yes','builder'=>'Yes'),
												'order_clause' => $order_by_where,
												));
		//echo '<pre>';print_r($all_owner_activity);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/owner_activity.php", array('all_owner_activity'=>$all_owner_activity), true);
		echo $response; 
	}
	
	/** 
	* dashboard project cost summary
	* 
	* @method: get_project_cost_summary 
	* @access: public 
	* @param:  
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 22/06/2015 
	*/	
	public function get_project_cost_summary()
	{	
		$result = $this->sanitize_input();
		$post_array[] = array(
								'field_name' => 'ESTIMATE.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
							);
		if(!empty($this->project_id))
		{
			$post_array[] = array(
								'field_name' => 'ESTIMATE.project_id',
								'value'=> $this->project_id, 
								'type' => '='
								);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'ESTIMATE.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}	
		$where_str = $this->Mod_budget->build_where($post_array);
		$query_array = array('select_fields' => array('PROJECT.project_name','SUM(ESTIMATE.estimated_revenue) AS total_contract_price','SUM(ESTIMATE.co_awarded_amount)AS co_awarded_amount','SUM(ESTIMATE.paid_by_client_to_date)AS total_paid_by_client_to_date','SUM(ESTIMATE.amount_paid_to_sub)AS total_amount_paid_to_sub','SUM(ESTIMATE.unpaid_client_billing)AS unpaid_client_billing','SUM(ESTIMATE.total_balance_owed_to_sub)AS balance_owed_to_sub','SUM(ESTIMATE.estimated_profit_amount)AS total_estimated_profit_amount','SUM(ESTIMATE.revised_contract)AS total_revised_contract','SUM(ESTIMATE.bill_to_client_to_date)AS total_bill_to_client_to_date','SUM(ESTIMATE.profit_to_date)AS total_profit_to_date'),
		'join'=> array('builder'=>'Yes','project'=>'Yes'),
		'where_clause' => $where_str,
		'group_clause'=> array("PROJECT.ub_project_id"),
		);
		$project_cost_summary = $this->Mod_budget->get_budget_summary($query_array);
		//echo '<pre>';print_r($project_cost_summary);exit;
		if($result['data']['dashboard'] === 'yes')
		{
			$response = $this->load->view("content/dashboard/dashboard_sections/project_budget_summary.php", array('project_cost_summary'=>$project_cost_summary), true);
			echo $response; 
		}
		else if($project_cost_summary['status'] === TRUE)
		{
			$this->Mod_budget->response($project_cost_summary['aaData'][0]);
		}
		else
		{
			$this->Mod_budget->response($project_cost_summary);
		}
	}
	
	/** 
	* dashboard project current weather
	* 
	* @method: get_project_current_weather 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 01/07/2015 
	*/	
	public function get_project_current_weather()
	{	
		if(!empty($this->project_id))
		{
			$where_str = 'PROJECT.builder_id = '.$this->builder_id.' AND PROJECT.ub_project_id ='.$this->project_id;
			$project_list = $this->Mod_project->get_projects(array(
						'select_fields' => array('PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.postal','PROJECT.country'),
						'where_clause' => $where_str
						));
			$weather['address'] = $project_list['aaData'][0]['address'];
			$weather['city']    = $project_list['aaData'][0]['city'];
			$weather['province']    = $project_list['aaData'][0]['province'];
			$weather['postal']    = $project_list['aaData'][0]['postal'];
			$weather['country']    = $project_list['aaData'][0]['country'];
			$get_weather_report_array_result = $this->Mod_user->get_weather_report($weather);
		}
		else
		{
			$weather['address'] = $this->user_session['address'];
			$weather['city']   = $this->user_session['city'];
			$weather['province']    = $this->user_session['province'];
			$weather['postal']    = $this->user_session['postal'];
			$weather['country']    = $this->user_session['country'];
			$get_weather_report_array_result = $this->Mod_user->get_weather_report($weather);
		}
		if($get_weather_report_array_result['lat'] == 0 && $get_weather_report_array_result['lon'] == 0 && empty($this->project_id))
		{
			$where_str = 'USER.builder_id = '.$this->builder_id.' AND USER.role_id = '.BUILDER_ADMIN_ROLE_ID;
			
			$address_details = $this->Mod_user->get_users(array(
						'select_fields' => array('USER.address', 'USER.city', 'USER.province', 'USER.country'),
						'where_clause' => $where_str
						));
			if($address_details['status'] == TRUE)
			{			
				$get_weather_report_array_result = $this->Mod_user->get_weather_report($address_details['aaData'][0]);		
			}			
			// echo '<pre>';print_r($address_details);exit;			
		}
		$response = $this->load->view("content/dashboard/dashboard_sections/current_weather.php", array('get_weather_report_array_result'=>$get_weather_report_array_result), true);
		echo $response; 
	}
	
}