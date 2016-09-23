<?php
/** 
 * Task Model
 * 
 * @package: Task Model
 * @subpackage: Task Model 
 * @category: Task
 * @author: chandru
 * @createdon(DD-MM-YYYY): 24-03-2015
*/
class Mod_task extends UNI_Model
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
	* Get task information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_task
	* @access: public 
	* @param: args
	* @return: array
	* @createdby: chandru
	*/
	public function get_task($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
			//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
			 /* $this->read_db->from('ub_task_assigned_users'.' AS TASK_ASSIGNED_USERS');
			$this->read_db->join('ub_task'.' AS TASK','TASK.ub_task_id = TASK_ASSIGNED_USERS.task_id');
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = TASK.created_by');
			$this->read_db->join('ub_user'.' AS USERS','USERS.ub_user_id = TASK_ASSIGNED_USERS.assigned_to');   */
			$this->read_db->from('ub_task  AS TASK');
			$this->read_db->join('ub_task_assigned_users  AS TASK_ASSIGNED_USERS','TASK_ASSIGNED_USERS.task_id = TASK.ub_task_id','left');
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = TASK.created_by');
			$this->read_db->join('ub_user'.' AS USERS','USERS.ub_user_id = TASK_ASSIGNED_USERS.assigned_to' , 'left');   
			
		}
		else
		{
			$this->read_db->from('ub_task'.' AS TASK');
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
		if(isset($args['group_clause']) && $args['group_clause'] !='' && isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
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
		 // echo $this->read_db->last_query();exit;
		return $data;
	}
	
	//new function for fetch
	/* public function get_task_table($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from('ub_task'.' AS TASK');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join('ub_task'.' AS TASK','TASK.ub_task_id = TASK_ASSIGNED_USERS.task_id');
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = TASK.created_by');
			$this->read_db->join('ub_user'.' AS USERS','USERS.ub_user_id = TASK_ASSIGNED_USERS.assigned_to');
			
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
		//echo $this->db->last_query();exit;
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
	} */
	
	/**
	*
	* Add task
	*
	* @method: add_task
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdon(DD-MM-YYYY): 28-03-2015
	* @createdby: chandru
	*/
	public function add_task($post_array = array())
	{
		if( ! empty($post_array))
		{
			/*   $scheduler  = $this->Mod_reminder->scheduler_execute(); 
			echo '<pre>';print_r($scheduler);exit;   */
			/* Formating date */
			if(isset($post_array['due_date']) && !empty($post_array['due_date']))
			{
			$source = $post_array['due_date'];
			$date = new DateTime($source);
			$newDate = $date->format('Y-m-d'); // 2012-07-31
			$due_date_with_time = $newDate.' '.$post_array['due_time'];
			}else{
			$due_date_with_time = '';
			$newDate = '';
			}
			if($post_array['schedule_id'] > 0)
			{
				$due_date_with_time = $post_array['schedule_due_date'];
				$newDate = $post_array['schedule_due_date'];
			}
			/* $datetime_from = date("Y-m-d H:i:s",strtotime("-".$post_array['reminder_id']." minutes",strtotime($due_date_with_time)));   */
			/* echo $due_date_with_time;echo 'br';
			echo $post_array['reminder_id'];echo 'br';
			echo $datetime_from;exit; */
			$task_table_insert_array = array(
				'title' => $post_array['title'],
				'note' => $post_array['note'],
				//'mark_complete_status' => 'No',
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $post_array['project_id'],
				'schedule_id' => $post_array['schedule_id'],
				'number_days' => $post_array['number_days'],
				'before_or_after' => $post_array['on_or_before'],
				'task_assigned_users' => $post_array['task_assigned_users'],
				'mark_complete_status' => $post_array['mark_complete_status'],
				'priority' => $post_array['priority'],
				'due_date_time' => $due_date_with_time,
				'due_date' => $newDate,
				'due_time' => $post_array['due_time'],
				'tags' => $post_array['tags'],
				'reminder_id' => $post_array['reminder_id'],
				'status' => 'Not completed',
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
			 $this->builder_id = (isset($task_table_insert_array['builder_id']))?$task_table_insert_array['builder_id']:$this->builder_id;
			
					if($this->write_db->insert(UB_TASK, $task_table_insert_array))
					{
						$data['insert_id'] =  $this->write_db->insert_id();
						$task_table_insertid = $data['insert_id'];
						$insertintaskassignedusers  = $this->insert_in_task_assigned_users_table($task_table_insertid,$post_array);
						if(!empty($insertintaskassignedusers))
						{
							$insert_in_task_checklist  = $this->insert_in_task_checklist_table($task_table_insertid,$post_array); 
							if($insertintaskassignedusers = 'inserted')
							{
								if(!empty($post_array['reminder_id']) && !empty($due_date_with_time) && !empty($post_array['task_assigned_users']))
								{
								/* Based on project id getting owner id */
								$project_id = (isset($this->project_id) && $this->project_id>0)?$this->project_id:0;
								if($project_id>0)
								{
									$where_owner_str = array('ub_project_id' => $project_id);
									$get_owner_user_id = array(
													'select_fields' => array('owner_id'),
													'where_clause' => $where_owner_str
													);
									$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
									if($owner_id_details['status'] == TRUE)
									{
										$owner_id = $owner_id_details['aaData'][0]['owner_id'];
									}else{
										$owner_id = 0;
									}
								}else{
									$owner_id = 0;
								}
								$mail_sent_to = $owner_id.','.$post_array['task_assigned_users'];
								/* FETCH BUILDER NAME */
								 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
								$builder_details_array = $this->Mod_builder->get_builder_details(array(
																		'select_fields' => array('builder_name'),
																		'where_clause' => $condition_post_array
																		));
								$builder_name = $builder_details_array['aaData']['0']['builder_name'];
								/* Based on project id getting owner id code ends here */
								$project_name = $this->project_name;
								$task_name = $post_array['title'];
								$due_date = $due_date_with_time;
								$parse_data = array(
									'builder_name' =>$builder_name,
									'project_name' =>$project_name,
									'task_name' =>$task_name,
									'due_date' =>$due_date,
									);
								$reminder_table_insert_array = array(
											'builder_id' => $this->user_session['builder_id'],
											'project_id' => $post_array['project_id'],
											'module_name' => $post_array['module_name'],
											'module_pk_id' => $task_table_insertid,
											'reminder_sent_to' => $mail_sent_to,
											'reminder_sent_on' => $due_date_with_time,
											'reminder_end_time' => $due_date_with_time,
											'reminder_duration' => $post_array['reminder_id'],
											'template_name' => 'task_deadline_reminder',
											'status' => 'Not Send',
											'parse_data' => $parse_data
											);
								$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
								}
									$data['status'] = TRUE;
									$data['message'] = 'Data inserted successfully';
								
									/* $send_mail_to_assigned_users_and_insert_in_notification = $this->send_mail_for_notification($post_array,$task_table_insertid);
									if($send_mail_to_assigned_users_and_insert_in_notification == TRUE)
									{
										$data['status'] = TRUE;
										$data['message'] = 'Data inserted successfully';
									}else{
										$data['status'] = TRUE;
										$data['message'] = 'Data inserted successfully but mail not sent';
									} */
								/* 	$data['status'] = TRUE;
									$data['message'] = 'Data inserted successfully'; */
								
							}else{
								$data['status'] = FALSE;
								$data['message'] = 'Insert Failed: Failed to insert the data';
							}
							
						}else
							{
								$data['status'] = FALSE;
								$data['message'] = 'Insert Failed: Failed to insert the data';
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
	* @method: insert_in_task_assigned_users_table
	* @access: public 
	* @param: args
	* @return: array
	* @createdon(DD-MM-YYYY): 28-03-2015
	* @createdby: chandru
	*/
	public function insert_in_task_assigned_users_table($task_table_insertid,$post_array = array())
	{
		if(isset($post_array['assigned_to']) && $post_array['assigned_to'] != '')
		{
		$task_assigned_user_table_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'task_id' => $task_table_insertid,
				'assigned_to' => $post_array['assigned_to'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
		$this->builder_id = (isset($task_assigned_user_table_insert_array['builder_id']))?$task_assigned_user_table_insert_array['builder_id']:$this->builder_id;
		
			foreach($post_array['assigned_to'] as $assigned_to)
			{	
				// Query to insert data in ub_mom table
				$task_assigned_user_table_insert_array['assigned_to'] =  $assigned_to;
			    $result = $this->write_db->insert(UB_TASK_ASSIGNED_USERS, $task_assigned_user_table_insert_array);
			}
		}else{
			$result = 'Assigned to was empty';
		}
			return $result;
	}
	/**
	* @method: insert_in_task_checklist_table
	* @access: public 
	* @param: args
	* @return: array
	* @createdon(DD-MM-YYYY): 28-03-2015
	* @createdby: chandru
	*/
	public function insert_in_task_checklist_table($task_table_insertid,$post_array)
	{
			if(isset($post_array['description']) && !empty($post_array['description']))
			{
				$task_check_list_table_insert_array = array(
					'description' => $post_array['description'],
					'mark_complete_status' => $post_array['description_mark_complete_status']
					); 
				for($i=0; $i<count($task_check_list_table_insert_array['description']); $i++)
				{
					if(isset($task_check_list_table_insert_array['description'][$i]) && !empty($task_check_list_table_insert_array['description'][$i]))
					{
						$cloned_data['description'] =  $task_check_list_table_insert_array['description'][$i];
						$cloned_data['mark_complete_status'] =  $task_check_list_table_insert_array['mark_complete_status'][$i];
						$send_clone_data = $this->clone_data_value($task_table_insertid,$cloned_data);
					}
				}
			}
			 return 'inserted';
	}
	public function clone_data_value($task_table_insertid,$cloned_data)
	{
		$task_check_list_table_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $this->project_id,
				'task_id' => $task_table_insertid,
				'description' => $cloned_data['description'],
				'mark_complete_status' => $cloned_data['mark_complete_status'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
		$this->builder_id = (isset($task_check_list_table_insert_array['builder_id']))?$task_check_list_table_insert_array['builder_id']:$this->builder_id;
		$result = $this->write_db->insert(UB_TASK_CHECKLIST, $task_check_list_table_insert_array);
	}
	
	/**
	*
	* Update task
	*
	* @method: update_task
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	*/
	public function update_task($post_array = array())
	{
		if(isset($post_array['due_date']) && !empty($post_array['due_date']))
		{
			$source = $post_array['due_date'];
			$date = new DateTime($source);
			$newDate = $date->format('Y-m-d'); // 2012-07-31
			$due_date_with_time = $newDate.' '.$post_array['due_time'];
		}else{
			$newDate = '';
			$due_date_with_time = '';
		}
		if($post_array['schedule_id'] > 0)
		{
			$due_date_with_time = $post_array['schedule_due_date'];
			$newDate = $post_array['schedule_due_date'];
		}
		$task_table_update_array = array(
				'title' => $post_array['title'],
				'note' => $post_array['note'],
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $post_array['project_id'],
				'task_assigned_users' => $post_array['task_assigned_users'],
				'mark_complete_status' => $post_array['mark_complete_status'],
				'priority' => $post_array['priority'],
				'due_date_time' => $due_date_with_time,
				'due_date' => $newDate,
				'due_time' => $post_array['due_time'],
				'tags' => $post_array['tags'],
				'reminder_id' => $post_array['reminder'],
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY,
				'schedule_id' => $post_array['schedule_id'],
				'number_days' => $post_array['number_days'],
                'before_or_after' => $post_array['before_or_after'],
			);
		if(isset($post_array['mark_complete_status']) && $post_array['mark_complete_status'] == 'Yes')
		{
			$task_table_update_array['status'] = 'Completed';
			$task_table_update_array['completed_date_time'] = TODAY;
		}
		elseif(isset($post_array['mark_complete_status']) && $post_array['mark_complete_status'] == 'No')
		{
			$task_table_update_array['status'] = 'Not completed';
			// $task_table_update_array['completed_date_time'] = TODAY;
		}
			// Query to select data from ub_mom table
				$args['select_fields'] = array('task_assigned_users');
				$args['where_clause'] = array('ub_task_id' => $post_array['ub_task_id']);
				$existing_assigned_users = $this->get_tasks($args);
				//insert in first table
				$this->write_db->where('ub_task_id', $post_array['ub_task_id']);
         if($this->write_db->update(UB_TASK, $task_table_update_array))
		 {
					if($post_array['title'] != '' && $post_array['mark_complete_status'] == 'Yes')
					{
						$send_notification = $this->send_mail_for_notification($post_array,'');
					}
					$ub_task_id =$post_array['ub_task_id'];
					if(isset($post_array['assign_to']) && !empty($post_array['assign_to']))
					{
						$assign_to_new = $post_array['assign_to'];
					}else{
						$assign_to_new = array();
					}
					//get old attendee value for ub_mom table
					$assign_to_old = explode(",",$existing_assigned_users['aaData'][0]['task_assigned_users']);
					//diff between two arrays and returns only different values in attendee_new array
					$assigne_user_insert = array_diff($assign_to_new,$assign_to_old);
					$assigned_user_delete = array_diff($assign_to_old,$assign_to_new);
					$assigned_users = $assigne_user_insert;
					$delete_array = array('task_id'=> $ub_task_id,
										  'assigned_to'=> $assigned_user_delete												
										  );
					//delete code
					if(count($assigned_user_delete) > 0)
					{	
						//function call to delete record in ub_mom table
						$this->delete_assigned_to_users($delete_array);
					}
					if(count($assigne_user_insert) > 0)
					{	
						$task_assigned_user_table_update_array = array(
						//'mark_complete_status' => 'No',
						'assigned_to' => $assigne_user_insert,
						'modified_by' => $this->user_session['ub_user_id'], 
						'modified_on' => TODAY
					);
						//function call to insert data
						$this->insert_assigned_to_users_update($ub_task_id,$task_assigned_user_table_update_array);		
					}
					//clone code starts here
					if(isset($post_array['checklist_description_id']) && count(array_filter($post_array['checklist_description_id'])) > 0){
						//echo $this->user_session['ub_user_id'];exit;
						$this->write_db->where('task_id', $post_array['ub_task_id']);
						$this->write_db->where_not_in('ub_task_checklist_id', array_filter($post_array['checklist_description_id']));
						$this->write_db->delete(UB_TASK_CHECKLIST);
						//echo $this->write_db->last_query();exit;
					}
					else{
						$this->db->where('task_id', $post_array['ub_task_id']);
						$this->db->delete(UB_TASK_CHECKLIST);
					}
		//Insert/update code
		if(isset($post_array['description'])){
			for($i=0; $i<count($post_array['description']); $i++){
				if(isset($post_array['checklist_description_id'][$i]) && $post_array['checklist_description_id'][$i] > 0){
					// Update Query
					$update_ary = array();
					$update_ary['Description'] = $post_array['description'][$i];
					$update_ary['mark_complete_status'] = $post_array['description_mark_complete_status'][$i];
					$update_ary['modified_by'] = $this->user_session['ub_user_id'];
					$update_ary['modified_on'] = TODAY;
					$this->write_db->update(UB_TASK_CHECKLIST, $update_ary, array('ub_task_checklist_id'=>$post_array['checklist_description_id'][$i]));
				}else{
					// Insert Query
					if(isset($post_array['description'][$i]) && !empty($post_array['description'][$i]))
					{
						$insert_ary = array();
						$insert_ary['builder_id'] = $this->user_session['builder_id'];
						$insert_ary['task_id'] = $post_array['ub_task_id'];
						$insert_ary['description'] = $post_array['description'][$i];
						$insert_ary['mark_complete_status'] = $post_array['description_mark_complete_status'][$i];
						$insert_ary['created_by'] = $this->user_session['ub_user_id'];
						$insert_ary['created_on'] = TODAY;
						$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
						$insert_ary['modified_on'] = TODAY;
						$this->write_db->insert(UB_TASK_CHECKLIST, $insert_ary);
					}
				}
			}
		}
			/* Below code for reminder table */
					$source = $post_array['due_date'];
					$date = new DateTime($source);
					$newDate = $date->format('Y-m-d'); // 2012-07-31
					$due_date_with_time = $newDate.' '.$post_array['due_time'];	
					if(!empty($post_array['reminder']) && !empty($due_date_with_time) && !empty($post_array['task_assigned_users']))
					{
					/* Based on project id getting owner id */
					$project_id = (isset($this->project_id) && $this->project_id>0)?$this->project_id:0;
					if($project_id>0)
					{
						$where_owner_str = array('ub_project_id' => $project_id);
						$get_owner_user_id = array(
										'select_fields' => array('owner_id'),
										'where_clause' => $where_owner_str
										);
						$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
						if($owner_id_details['status'] == TRUE)
						{
							$owner_id = $owner_id_details['aaData'][0]['owner_id'];
						}else{
							$owner_id = 0;
						}
					}else{
						$owner_id = 0;
					}
					$mail_sent_to = $owner_id.','.$post_array['task_assigned_users'];
					/* FETCH BUILDER NAME */
					 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
					$builder_details_array = $this->Mod_builder->get_builder_details(array(
															'select_fields' => array('builder_name'),
															'where_clause' => $condition_post_array
															));
					$builder_name = $builder_details_array['aaData']['0']['builder_name'];
					$project_name = $this->project_name;
					$task_name = $post_array['title'];
					$due_date = $due_date_with_time;
					/* Based on project id getting owner id code ends here */
					/* Update reminder code */
					$where_clause = array('module_pk_id' =>$post_array['ub_task_id'],'module_name' => 'task',);
					$get_all_reminders = array(
								'select_fields' => array(),
								'where_clause' => $where_clause
								);
					// echo '<pre>';print_r($get_all_reminders);exit;
					$all_reminders = $this->Mod_reminder->get_reminder($get_all_reminders); 
					// echo '<pre>';print_r($all_reminders);exit;
					if($all_reminders['status'] == TRUE)
					{
					
					/* $parse_data = array(
						'builder_name' =>$builder_name,
						'project_name' =>$project_name,
						'task_name' =>$task_name,
						'due_date' =>$due_date,
						); */
					$reminder_table_insert_array = array(
								'builder_id' => $this->user_session['builder_id'],
								'project_id' => $post_array['project_id'],
								'module_name' => 'task',
								'module_pk_id' => $post_array['ub_task_id'],
								'reminder_sent_to' => $post_array['task_assigned_users'],
								'reminder_sent_on' => $due_date_with_time,
								'reminder_end_time' => $due_date_with_time,
								'reminder_duration' => $post_array['reminder'],
								'status' => 'Not Send'
								//'parse_data' => $parse_data
								);
					/* Check already inserted or not */
					
					$update_in_reminder_table  = $this->Mod_reminder->update_reminder($reminder_table_insert_array);
					if($update_in_reminder_table['status'] == TRUE)
					{
						$data['insert_id'] =  $post_array['ub_task_id'];
						$data['status'] = TRUE;
						$data['message'] = 'Updated successfully';
					}else{
						$data['status'] = FALSE;
						$data['message'] = 'Updated Failed';
					}
					}else{
						/* Insert in reminder table */
						$parse_data = array(
						'builder_name' =>$builder_name,
						'project_name' =>$project_name,
						'task_name' =>$task_name,
						'due_date' =>$due_date,
						);
					$reminder_table_insert_array = array(
								'builder_id' => $this->user_session['builder_id'],
								'project_id' => $post_array['project_id'],
								'module_name' => 'task',
								'module_pk_id' => $post_array['ub_task_id'],
								'reminder_sent_to' => $post_array['task_assigned_users'],
								'reminder_sent_on' => $due_date_with_time,
								'reminder_end_time' => $due_date_with_time,
								'reminder_duration' => $post_array['reminder'],
								'status' => 'Not Send',
								'parse_data' => $parse_data
								);
					/* Check already inserted or not */
					
					$update_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
					if($update_in_reminder_table['status'] == TRUE)
					{
						$data['insert_id'] =  $post_array['ub_task_id'];
						$data['status'] = TRUE;
						$data['message'] = 'Updated successfully';
					}else{
						$data['status'] = FALSE;
						$data['message'] = 'Updated Failed';
					}
					}
					}else{
						$data['insert_id'] =  $post_array['ub_task_id'];
						$data['status'] = TRUE;
						// $data['message'] = 'Inserted successfully and No reminder';
						$data['message'] = 'Inserted successfully';
					}
					
		
		}
		return $data;
	}
	
	//insert with in update
	public function insert_assigned_to_users_update($ub_task_id,$post_array = array())
	{
		$task_assigned_user_table_update_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'task_id' => $ub_task_id,
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
			foreach($post_array['assigned_to'] as $attendee)
			{	
				// Query to insert data in ub_mom table
				$task_assigned_user_table_update_array['assigned_to'] =  $attendee;
			    $this->write_db->insert(UB_TASK_ASSIGNED_USERS, $task_assigned_user_table_update_array);
			}
			 return 'inserted';
	}
	
	/**
	*
	* Delete comment
	*
	* @method: delete_comment
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	*/
	public function delete_comment($delete_array)
	{
		if(isset($delete_array['ub_task_comment_id']))
		{
			foreach($delete_array['ub_task_comment_id'] as $key=>$ub_task_comment_id)
			{
				$this->write_db->delete(UB_TASK_COMMENTS, array('ub_task_comment_id' => $ub_task_comment_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Comment deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Comment id is not set';
		}
		return $data;

	}
	
	/**
	*
	* Delete TASKS
	*
	* @method: delete_comment
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	*/
	public function delete_tasks($delete_array)
	{
		if(isset($delete_array['ub_task_id']))
		{
			foreach($delete_array['ub_task_id'] as $key=>$ub_task_id)
			{
				// $this->write_db->delete('ub_task', array('ub_task_id' => $ub_task_id));
				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_task_id', $ub_task_id);
				$this->write_db->update(UB_TASK, $post_array);
				/* Find folder id */
				$ui_folder_name = 'task'.$ub_task_id;
				/* Based on task id find project id */
				$project_id_array = $this->get_tasks(array(
					'select_fields' => array('TASK.project_id'),
					'where_clause' => array('TASK.ub_task_id'=>$ub_task_id)
				));
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_task->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_task_id);
				// $folder_structure_delete = $this->Mod_task->folder_structure_delete($ui_folder_name);
				/* Delete in reminder table */
				$delete_reminder = $this->Mod_reminder->delete_reminder($ub_task_id, $module_name, $this->builder_id);
			}
			$data['status'] = TRUE;
			$data['message'] = 'Task deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Task id is not set';
		}
		return $data;

	}
	
	//Fetch task code
	public function get_tasks($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from('ub_task'.' AS TASK');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			//$this->read_db->join('ub_task'.' AS TASK','TASK.ub_task_id = TASK_ASSIGNED_USERS.task_id');
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = TASK.created_by');
			//$this->read_db->join('ub_user'.' AS USERS','USERS.ub_user_id = TASK_ASSIGNED_USERS.assigned_to');
		}
		
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['ub_task_checklist']))
		{
			$this->read_db->join('ub_task_checklist'.' AS ub_task_checklist','TASK.ub_task_id = ub_task_checklist.task_id');
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
	* Get projects information
	*
	* @method: get_projects
	* @access: public 
	* @param: args
	* @return: array
	* @created by: chandru
	* @created on: 05-apr-2014
	*/
	public function get_projects($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT.' AS PROJECT');
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
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
	
	//Get dropdown
	
	public function get_drop_down($condition)
	{
		$this->db->select(array('ub_user_id','username','CONCAT_WS(" ", first_name, last_name) as fullname'));
		$this->db->from(UB_USER.' AS user');
		$this->db->join(UB_PROJECT.' AS project','project.builder_id=user.builder_id');
		$this->db->where($condition);
		$query = $this->db->get();
		$records = $query->result_array();
		return $records;
	}
	
	/**
	*
	* Add task
	*
	* @method: add_comments
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdon(DD-MM-YYYY): 30-03-2015
	* @createdby: chandru
	*/
	public function add_comments($post_array = array())
	{
		if( ! empty($post_array))
		{
			 $this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
					if($this->write_db->insert('ub_task_comments', $post_array))
					{
						$data['insert_id'] =  $this->write_db->insert_id();
						$data['status'] = TRUE;
						$data['message'] = 'Data inserted successfully';
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'Insert Failed: Failed to insert the data';
					}
					//echo $this->write_db->last_query();
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
	}
	/** 
	* Get comment information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_comment
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_comments($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TASK_COMMENTS.' AS TASK_COMMENT');
		//Join Tables
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','TASK_COMMENT.created_by = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
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
		return $data;
	}
	/** 
	* Get userinfo information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	*
	* @method: get_userinfo
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_userinfo($args = array(),$task_title,$task_id,$comment)
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT_ASSIGNED_USERS.' AS PROJECT_ASSIGNED_USERS');
		// Join Tables
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','PROJECT_ASSIGNED_USERS.assigned_to = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
		 }
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		$res = $this->read_db->get();
		// echo $this->read_db->last_query();exit;
		$data = array();
		$data_arry = array();
		if($res->num_rows() > 0)
		{
			foreach ($res->result_array() as $row)
			{
				/* Subcontractor user id */
				//Fetch all the users
				$subcontractor_id =  $this->user_session['subcontractor_id'];
				
				$where_builder_str = array('subcontractor_id' => $subcontractor_id );
				$get_builder_user_id = array(
									'select_fields' => array('ub_user_id'),
									'where_clause' => $where_builder_str
									);
				$subcontractor_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
				$subcontractor_user_id = $subcontractor_user_id_details['aaData'][0]['ub_user_id'];
				//$level2_array[] = $row['first_name'].EMAIL_SEPERATOR_LEVEL2.$row['primary_email'].EMAIL_SEPERATOR_LEVEL2.'bcc';
				/* Based on project id getting owner id */
				$project_id = $this->project_id;
				$where_owner_str = array('ub_project_id' => $project_id);
					$get_owner_user_id = array(
											'select_fields' => array('owner_id'),
											'where_clause' => $where_owner_str
											);
					$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
					if($owner_id_details['status'] == TRUE)
					{
						$owner_id = $owner_id_details['aaData'][0]['owner_id'];
					}else{
						$owner_id = 0;
					}
					$user_id = $owner_id.','.$row['ub_user_id'].','.$subcontractor_user_id;
				/* FETCH BUILDER NAME */
				$builder_id = $this->user_session['builder_id'];
				$builder_name_condition_post_array =  array('ub_builder_id'=>$builder_id);
				$builder_name_array = $this->Mod_builder->get_builder_details(array(
													'select_fields' => array('builder_name'),
													'where_clause' => $builder_name_condition_post_array
													));
				$builder_name = $builder_name_array['aaData']['0']['builder_name'];
				$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($user_id,$this->main_modules[$this->module]);
				//Fetch all the users
					// $primary_user_id = $builder_id.','.$insert_in_user_table;
					$post_array_values[] = array(
										'field_name' => 'ub_user_id',
										'value'=> $mail_user_id, 
										'type' => '||',
										'classification' => 'primary_ids'
									);
					$where_str = $this->Mod_task->build_where($post_array_values);
					$get_all_users = array(
											'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name','created_on'),
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
						$created_on = $val['created_on'];
						$assigned_to_first_name[] = $val['first_name'];
						$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
					}
					 $to_address = implode(",",$email_ids);
					$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
					}
					}else{
						return FALSE;
					 }
					$username_array = $this->user_session;
					$added_by_first_name = $username_array['first_name'];
					$scheduler  = $this->Mod_builder->get_builder_logo($this->builder_id); 
					$content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'task_title' => $task_title,
						'task_id' => $task_id,
						'comment' => $comment,
						'added_by' => $added_by_first_name,
						'builder_name' => $builder_name,
						'project_name' => $this->project_name,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
					$post_array_details = array(
						'builder_id' => $this->user_session['builder_id'],
						'project_id' => $this->project_id,
						'module_name' => $this->module,
						'module_pk_id' => $task_id,
						'from_user_id' => $this->user_session['ub_user_id'],
						'to_user_id' => $user_id,
						'type' => 'task_comment',
						'subject' => 'content will update',
						'message' => 'content will update'
						);
					$notification_array = array(
						'template_name' => 'task_comment',
						'content_array' => $content_array,
						'notification' => $post_array_details,
						'default' => 'No'
					);
					// echo '<pre>';print_r($notification_array);exit;
					/* SMS code was added by chandru 02-09-2015 */
					$msg_user_id = $this->Mod_user->get_sms_preference_user_id($user_id,$this->main_modules[$this->module]);
					if(isset($msg_user_id) && !empty($msg_user_id))
					{
						$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details);
					}
					$notification_responce = $this->Mod_notification->send_mail($notification_array);
				
			}
			/* $level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);

			$email_array= array(
				'SET_PARSER' => 'Testing Parser',
				'SEND_MAIL_INFO' => $level1_string,
				'IMAGESRC' => IMAGESRC
			);
			$this->Mod_mail->send_mail('SEND_NOTIFICATION_EMAIL', $email_array); */
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
	* Delete delete_assigned_to_users
	*
	* @method: delete_assigned_to_users
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_assigned_to_users($delete_array)
	{
		if(isset($delete_array['task_id']))
		{
			foreach($delete_array['assigned_to'] as $key=>$attendee_id)
			{	
				// Query to delete data in ub_mom table
				$this->write_db->delete(UB_TASK_ASSIGNED_USERS, array('assigned_to' => $attendee_id, 'task_id' => $delete_array['task_id']));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Assigned users(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Assigned users id is not set';
		}
		return $data;
	}
	
	/**
	*
	* Send mail when task was created.
	*
	* @method: send_mail_for_notification
	* @Explanation: send_mail_to_assigned_users_and_insert_in_notification
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon: 27-05-2014
	*/
	
	public function send_mail_for_notification($post_array,$task_table_insertid)
	{
		//Fetch all the users
		$subcontractor_id =  $this->user_session['subcontractor_id'];
		
		$where_builder_str = array('subcontractor_id' => $subcontractor_id );
		$get_builder_user_id = array(
							'select_fields' => array('ub_user_id'),
							'where_clause' => $where_builder_str
							);
		$subcontractor_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
		$subcontractor_user_id = $subcontractor_user_id_details['aaData'][0]['ub_user_id'];
		/* Based on project id getting owner id */
		$project_id = $this->project_id;
		$where_owner_str = array('ub_project_id' => $project_id);
			$get_owner_user_id = array(
									'select_fields' => array('owner_id'),
									'where_clause' => $where_owner_str
									);
			$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
			if($owner_id_details['status'] == TRUE)
			{
				$owner_id = $owner_id_details['aaData'][0]['owner_id'];
			}else{
				$owner_id = '';
			}
		/* Based on project id getting owner id code ends here */
		if(isset($task_table_insertid) && $task_table_insertid != '' )
		{
			$user_id = $owner_id.','.$post_array['task_assigned_users'].','.$subcontractor_user_id;
		}else{
			$user_id = $owner_id.','.$post_array['task_assigned_users'].','.$subcontractor_user_id;
		}
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($user_id,$this->main_modules[$this->module]);
			$post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			$where_str = $this->Mod_task->build_where($post_array_value);
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
			return FALSE;
		 }
		
		 $username_array = $this->user_session;
		 $added_by_first_name = $username_array['first_name'];
		 
		 /* FETCH BUILDER NAME */
		 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('builder_name'),
												'where_clause' => $condition_post_array
												));
		$builder_name = $builder_details_array['aaData']['0']['builder_name'];
		 $scheduler  = $this->Mod_builder->get_builder_logo($this->builder_id); 
		 if(isset($task_table_insertid) && $task_table_insertid != '' )
		{
		$template_name = 'task_new_file_added';
		$primary_id = $task_table_insertid;
		 $content_array = array(
			'TO_EMAIL' => $email_ids,
			'SEND_MAIL_INFO' => $level1_string,
			'IMAGESRC' => IMAGESRC,
			'task_name' => $post_array['title'],
			'project_name' => $this->project_name,
			'task_added_by' => $added_by_first_name,
			'builder_name' => $builder_name,
			'base_url'=> BASEURL,
			'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
		}else{
			$template_name = 'task_completed_or_opened_by_others';
		$primary_id = $task_table_insertid;
		 $content_array = array(
			'TO_EMAIL' => $email_ids,
			'SEND_MAIL_INFO' => $level1_string,
			'IMAGESRC' => IMAGESRC,
			'task_name' => $post_array['title'],
			'project_name' => $this->project_name,
			'completed_by' => $added_by_first_name,
			'completed_on' => TODAY,
			'created_on' => $post_array['created_on'],
			'builder_name' => $builder_name,
			'task_descriptiom' => $post_array['note'],
			'base_url'=> BASEURL,
			'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
		}
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $post_array['project_id'],
					'module_name' => $this->module,
					'module_pk_id' => $primary_id,
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => $post_array['task_assigned_users'],
					'type' => $template_name,
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => $template_name,
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			// echo '<pre>';print_r($notification_array);exit;
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($user_id,$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
			}
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
			// $mail_responce = $this->Mod_mail->send_mail('SEND_MAIL_TO_TASK_ASSIGNED_USERS', $content_array);
			return $notification_responce;
	}
	
	/**
	*
	* Add task
	*
	* @method: add_checklist_template
	* @access: public 
	* @param: post data
	* @createdon(DD-MM-YYYY): 17-07-2015
	* @createdby: chandru
	*/
	public function add_checklist_template($post_array = array())
	{
		if( ! empty($post_array))
		{
			if($this->write_db->insert(UB_TASK_CHECKLIST, $post_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
			//echo $this->write_db->last_query();
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
	}
	
	/* Find total count */
	public function get_task_count($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from('ub_task  AS TASK');
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
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
		return $data;
	
	}

}