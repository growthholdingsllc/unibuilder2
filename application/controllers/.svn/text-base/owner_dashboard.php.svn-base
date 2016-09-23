<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * owner_dashboard Class
 * 
 * @package: owner_dashboard
 * @subpackage: owner_dashboard
 * @category: owner_dashboard
 * @author: Satheesh
 * @createdon(DD-MM-YYYY): 06-05-2015 
*/
class owner_dashboard extends UNI_Controller {
	/**
	 * @constructor
	 */
	public $display_length = 0;
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_task','Mod_user','Mod_project','Mod_warranty','Mod_selections','Mod_notification'));
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
		$data = array(
						'title'        => "UNIBUILDER",		
						'content'      => 'content/dashboard/owner_dashboard',
						'page_id'      => 'dashboard'
						);
		if(!empty($this->project_id))
		{		
			$post_array = array(
							'builder_id' => $this->builder_id,
							'project_id' => $this->project_id,
							'owner_id' => $this->user_id
							);
			$result_data = $this->Mod_project->get_owner_slider_images($post_array);
			//echo '<pre>';print_r($result_data);
			if($result_data['status'] == TRUE)
			{
				foreach($result_data['aaData'] as $key => $val)
				{
					$data['recent_images'][$key] = DOC_URL.$val['filepath'].$val['sys_file_name'];
				}
			}
			else
			{
				$data['recent_images'] = array(IMAGESRC.'no_image_available.jpg');
				
			}
			//echo '<pre>';print_r($data['recent_images']);exit;
		}
		/* $data['recent_images'] = array( IMAGESRC.'owner_slider/002.jpg' => IMAGESRC.'owner_slider/thumb-002.jpg',
										IMAGESRC.'owner_slider/003.jpg' => IMAGESRC.'owner_slider/thumb-003.jpg',
										IMAGESRC.'owner_slider/004.jpg' => IMAGESRC.'owner_slider/thumb-004.jpg',
										IMAGESRC.'owner_slider/005.jpg' => IMAGESRC.'owner_slider/thumb-005.jpg',
										IMAGESRC.'owner_slider/006.jpg' => IMAGESRC.'owner_slider/thumb-006.jpg',
										IMAGESRC.'owner_slider/007.jpg' => IMAGESRC.'owner_slider/thumb-007.jpg',
										IMAGESRC.'owner_slider/008.jpg' => IMAGESRC.'owner_slider/thumb-008.jpg',
										IMAGESRC.'owner_slider/009.jpg' => IMAGESRC.'owner_slider/thumb-009.jpg',
										IMAGESRC.'owner_slider/010.jpg' => IMAGESRC.'owner_slider/thumb-010.jpg',
										IMAGESRC.'owner_slider/011.jpg' => IMAGESRC.'owner_slider/thumb-011.jpg',
										); */
		//echo '<pre>';print_r($data);exit;
		$this->template->view($data);
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
	* dashboard selections
	* 
	* @method: get_selections 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 02/06/2015
	*/	
	public function get_selections()
	{	
		if(!empty($this->project_id))
		{
			$post_array[] = array(
									'field_name' => 'SELECTION.project_id',
									'value'=> $this->project_id, 
									'type' => '='
								);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'SELECTION.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}		
		$post_array[] = array(
								'field_name' => 'SELECTION.builder_id',
								'value'=> $this->builder_id, 
								'type' => '='
								);		 
		$where_str = $this->Mod_selections->build_where($post_array);
		//echo '<pre>';print_r($where_str);
		//$order_by_where = "count(WARRANTY.status) desc";
		$all_selections = $this->Mod_selections->get_selections(array(
												'select_fields' => array('SELECTION.due_date_time AS due_date'),
												'where_clause' => $where_str,
												'join'=> array('selection_choice'=>'No'),
												//'order_clause' => $order_by_where,
												));
		$selection['overdue'] = 0;
		$selection['upcome'] = 0;
		if(TRUE == $all_selections['status'])
		{
			foreach($all_selections['aaData'] as $key=>$val)
			{
				if($val['due_date'] >= TODAY)
				{
					$selection['upcome']++;
				}
				else
				{
					$selection['overdue']++;
				}
			}
		}
		// echo '<pre>';print_r($all_selections);exit;
		$response = $this->load->view("content/dashboard/dashboard_sections/selections_alerts.php", array('selections'=>$selection), true);
		echo $response; 
	}
	
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