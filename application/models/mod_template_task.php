<?php
/** 
 * template task Model
 * 
 * @package: Template task Model
 * @subpackage: Template Model 
 * @category: Template
 * @author: satheesh
 * @createdon(DD-MM-YYYY): 29-07-2015
*/
class Mod_template_task extends UNI_Model
{
	
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		
		parent::__construct();
    }
	/**
	*
	* Add template task
	*
	* @method: add_template_task
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdon(DD-MM-YYYY): 29-07-2015
	* @createdby: satheesh kumar
	*/
	public function add_template_task($post_array = array())
	{
		if(!empty($post_array))
		{
			/* Formating date */
			if(isset($post_array['due_date']) && !empty($post_array['due_date']))
			{
				$source = $post_array['due_date'];
				$date = new DateTime($source);
				$newDate = $date->format('Y-m-d'); // 2012-07-31
				$due_date_with_time = $newDate.' '.$post_array['due_time'];
			}
			else
			{
				$due_date_with_time = '';
				$newDate = '';
			}
			
			$task_table_insert_array = array(
				'title' => $post_array['title'],
				'note' => $post_array['note'],
				'builder_id' => $this->user_session['builder_id'],
				'template_id' => $this->template_id,
				'mark_complete_status' => $post_array['mark_complete_status'],
				'priority' => $post_array['priority'],
				'due_date_time' => $due_date_with_time,
				'due_date' => $newDate,
				'due_time' => $post_array['due_time'],
				'tags' => $post_array['tags'],
				'status' => 'Not completed',
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
			// echo '<pre>';print_r($task_table_insert_array);exit;
			if($this->write_db->insert(UB_TEMPLATE_TASK, $task_table_insert_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$template_task_table_insertid = $data['insert_id'];
				$insert_in_punchlist_checklist  = $this->insert_in_task_checklist_table($template_task_table_insertid,$post_array); 
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
	* @method: insert_in_task_checklist_table
	* @access: public 
	* @param: args
	* @return: array
	* @createdon(DD-MM-YYYY): 28-07-2015
	* @createdby: satheesh kumar
	*/
	public function insert_in_task_checklist_table($template_task_table_insertid,$post_array)
	{
			if(isset($post_array['description']) && !empty($post_array['description']))
			{
				$task_check_list_table_insert_array = array(
					'description' => $post_array['description'],
					'mark_complete_status' => $post_array['description_mark_complete_status']
					); 
				// echo '<pre>';print_r($task_check_list_table_insert_array);exit;	
				for($i=0; $i<count($task_check_list_table_insert_array['description']); $i++)
				{
					if(isset($task_check_list_table_insert_array['description'][$i]) && !empty($task_check_list_table_insert_array['description'][$i]))
					{
						$cloned_data['description'] =  $task_check_list_table_insert_array['description'][$i];
						$cloned_data['mark_complete_status'] =  $task_check_list_table_insert_array['mark_complete_status'][$i];
						$send_clone_data = $this->clone_data_value($template_task_table_insertid,$cloned_data);
					}
				}
			}
			 return 'inserted';
	}
	public function clone_data_value($template_task_table_insertid,$cloned_data)
	{
		$task_check_list_table_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'template_id' => $this->template_id,
				'template_task_id' => $template_task_table_insertid,
				'description' => $cloned_data['description'],
				'mark_complete_status' => $cloned_data['mark_complete_status'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
		$this->builder_id = (isset($task_check_list_table_insert_array['builder_id']))?$task_check_list_table_insert_array['builder_id']:$this->builder_id;
		$result = $this->write_db->insert(UB_TEMPLATE_TASK_CHECKLIST, $task_check_list_table_insert_array);
	}
	
	/**
	*
	* Update task
	*
	* @method: update_task
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: satheesh
	*/
	public function update_task($post_array = array())
	{
		if(isset($post_array['due_date']) && !empty($post_array['due_date']))
		{
			$source = $post_array['due_date'];
			$date = new DateTime($source);
			$newDate = $date->format('Y-m-d'); // 2012-07-31
		}
		else
		{
			$newDate = '';
		}
		$task_table_update_array = array(
				'title' => $post_array['title'],
				'note' => $post_array['note'],
				'builder_id' => $this->user_session['builder_id'],
				'template_id' => $post_array['template_id'],
				'mark_complete_status' => $post_array['mark_complete_status'],
				'priority' => $post_array['priority'],
				'due_date' => $newDate,
				'due_time' => $post_array['due_time'],
				'tags' => $post_array['tags'],
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
		if(isset($post_array['mark_complete_status']) && $post_array['mark_complete_status'] == 'Yes')
		{
			$task_table_update_array['status'] = 'Completed';
		}
		//insert in first table
		$this->write_db->where('ub_template_task_id', $post_array['ub_template_task_id']);
        if($this->write_db->update(UB_TEMPLATE_TASK, $task_table_update_array))
		{		
			//clone code starts here
			if(isset($post_array['checklist_description_id']) && count(array_filter($post_array['checklist_description_id'])) > 0)
			{
				//echo $this->user_session['ub_user_id'];exit;
				$this->write_db->where('template_task_id', $post_array['ub_template_task_id']);
				$this->write_db->where_not_in('ub_template_task_checklist_id', array_filter($post_array['checklist_description_id']));
				$this->write_db->delete(UB_TEMPLATE_TASK_CHECKLIST);
				//echo $this->write_db->last_query();exit;
			}
			else
			{
				$this->db->where('template_task_id', $post_array['ub_template_task_id']);
				$this->db->delete(UB_TEMPLATE_TASK_CHECKLIST);
			}
			//Insert/update code
			if(isset($post_array['description']))
			{
				for($i=0; $i<count($post_array['description']); $i++)
				{
					if(isset($post_array['checklist_description_id'][$i]) && $post_array['checklist_description_id'][$i] > 0)
					{
						// Update Query
						$update_ary = array();
						$update_ary['Description'] = $post_array['description'][$i];
						$update_ary['mark_complete_status'] = $post_array['description_mark_complete_status'][$i];
						$update_ary['modified_by'] = $this->user_session['ub_user_id'];
						$update_ary['modified_on'] = TODAY;
						$this->write_db->update(UB_TEMPLATE_TASK_CHECKLIST, $update_ary, array('ub_template_task_checklist_id'=>$post_array['checklist_description_id'][$i]));
					}
					else
					{
						// Insert Query
						if(isset($post_array['description'][$i]) && !empty($post_array['description'][$i]))
						{
							$insert_ary = array();
							$insert_ary['builder_id'] = $this->user_session['builder_id'];
							$insert_ary['template_task_id'] = $post_array['ub_template_task_id'];
							$insert_ary['template_id'] = $this->template_id;
							$insert_ary['description'] = $post_array['description'][$i];
							$insert_ary['mark_complete_status'] = $post_array['description_mark_complete_status'][$i];
							$insert_ary['created_by'] = $this->user_session['ub_user_id'];
							$insert_ary['created_on'] = TODAY;
							$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
							$insert_ary['modified_on'] = TODAY;
							$this->write_db->insert(UB_TEMPLATE_TASK_CHECKLIST, $insert_ary);
						}
					}
				}
			}
			$data['insert_id'] =  $post_array['ub_template_task_id'];
			$data['status'] = TRUE;
			$data['message'] = 'Updated successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Update failed';
		}	
		return $data;
	}
	/**
	*
	* Delete TASKS
	*
	* @method: delete_tasks
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: satheesh kumar
	*/
	public function delete_tasks($delete_array)
	{
		if(isset($delete_array['ub_task_id']))
		{
			foreach($delete_array['ub_task_id'] as $key=>$ub_template_task_id)
			{
				$this->write_db->delete(UB_TEMPLATE_TASK, array('ub_template_task_id' => $ub_template_task_id));
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
}