<?php
/** 
 * punchlist Model
 * 
 * @package: punchlist Model
 * @subpackage: punchlist Model 
 * @category: punchlist
 * @author: satheesh kumar
 * @createdon(DD-MM-YYYY): 17-07-2015
*/
class Mod_punchlist extends UNI_Model
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
	* @method: get_task
	* @access: public 
	* @param: args
	* @return: array
	* @createdby: satheesh kumar
	*/
	public function get_punchlist($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
			//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->from(UB_PUNCH_LIST.' AS PUNCHLIST');
			$this->read_db->join(UB_USER.' AS USER','USER.ub_user_id = PUNCHLIST.created_by');
			$this->read_db->where(array('PUNCHLIST.is_delete' => 'No'));
		}
		
		// Join Tables
		if(isset($args['join']['punchlist_checklist']) && 'yes' === strtolower($args['join']['punchlist_checklist']))
		{
			$this->read_db->join(UB_PUNCH_LIST_CHECKLIST.' AS PUNCH_LIST_CHECKLIST','PUNCHLIST.ub_punch_list_id = PUNCH_LIST_CHECKLIST.punch_list_id');
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
			$data['message'] = 'Data Retrieved Successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		 // echo $this->read_db->last_query();
		return $data;
	}
	
	/**
	*
	* Add task
	*
	* @method: add_punchlist
	* @access: public 
	* @param: post data
	* @createdon(DD-MM-YYYY): 17-07-2015
	* @createdby: satheesh kumar
	*/
	public function add_punchlist($post_array = array())
	{
		if(!empty($post_array))
		{
			$punchlist_table_insert_array = array(
				'builder_id' => $this->builder_id,
				'project_id' => $this->project_id,
				'title' => $post_array['title'],
				'note' => $post_array['note'],
				'mark_complete_status' => $post_array['mark_complete_status'],
				'priority' => $post_array['priority'],
				'tags' => $post_array['tags'],
				'status' => $post_array['status'],
				'created_on' => TODAY,
				'created_by' => $this->user_id,
				'modified_on' => TODAY,
				'modified_by' => $this->user_id
			);
			if($this->write_db->insert(UB_PUNCH_LIST, $punchlist_table_insert_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$punchlist_table_insertid = $data['insert_id'];
				$insert_in_punchlist_checklist  = $this->insert_in_punchlist_checklist_table($punchlist_table_insertid,$post_array); 
				$data['status'] = TRUE;
				$data['message'] = 'Data Inserted Successfully';
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
	* @method: insert_in_punchlist_checklist_table
	* @access: public 
	* @param: args
	* @return: array
	* @createdon(DD-MM-YYYY): 17-07-2015
	* @createdby: satheesh kumar
	*/
	public function insert_in_punchlist_checklist_table($punchlist_table_insertid,$post_array)
	{
			if(isset($post_array['description']) && !empty($post_array['description']))
			{
				$punchlist_check_list_table_insert_array = array(
					'description' => $post_array['description'],
					'mark_complete_status' => $post_array['description_mark_complete_status']
					); 
				for($i=0; $i<count($punchlist_check_list_table_insert_array['description']); $i++)
				{
					if(isset($punchlist_check_list_table_insert_array['description'][$i]) && !empty($punchlist_check_list_table_insert_array['description'][$i]))
					{
						$cloned_data['description'] =  $punchlist_check_list_table_insert_array['description'][$i];
						$cloned_data['mark_complete_status'] =  $punchlist_check_list_table_insert_array['mark_complete_status'][$i];
						$send_clone_data = $this->clone_data_value($punchlist_table_insertid,$cloned_data);
					}
				}
			}
			return 'inserted';
	}
	
	
	public function clone_data_value($punchlist_table_insertid,$cloned_data)
	{
		$punchlist_check_list_table_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $this->project_id,
				'punch_list_id' => $punchlist_table_insertid,
				'description' => $cloned_data['description'],
				'mark_complete_status' => $cloned_data['mark_complete_status'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
		$result = $this->write_db->insert(UB_PUNCH_LIST_CHECKLIST, $punchlist_check_list_table_insert_array);
	}
	
	/**
	*
	* Update task
	*
	* @method: update_task
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: satheesh kumar
	*/
	public function update_punchlist($post_array = array())
	{
		if(!empty($post_array))
		{
			$punchlist_table_update_array = array(
					'title' => $post_array['title'],
					'note' => $post_array['note'],
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $post_array['project_id'],
					'mark_complete_status' => $post_array['mark_complete_status'],
					'priority' => $post_array['priority'],
					'tags' => $post_array['tags'],
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
				);
			if(isset($post_array['mark_complete_status']) && $post_array['mark_complete_status'] == 'Yes')
			{
				$punchlist_table_update_array['status'] = 'completed';
			}
			//insert in first table
			$this->write_db->where('ub_punch_list_id', $post_array['ub_punch_list_id']);
			if($this->write_db->update(UB_PUNCH_LIST, $punchlist_table_update_array))
			{			
				//clone code starts here
				if(isset($post_array['checklist_description_id']) && count(array_filter($post_array['checklist_description_id'])) > 0){
					//echo $this->user_session['ub_user_id'];exit;
					$this->write_db->where('punch_list_id', $post_array['ub_punch_list_id']);
					$this->write_db->where_not_in('ub_punch_list_checklist_id', array_filter($post_array['checklist_description_id']));
					$this->write_db->delete(UB_PUNCH_LIST_CHECKLIST);
					//echo $this->write_db->last_query();exit;
				}
				else{
					$this->db->where('punch_list_id', $post_array['ub_punch_list_id']);
					$this->db->delete(UB_PUNCH_LIST_CHECKLIST);
				}
				//Insert/update code
				if(isset($post_array['description']))
				{
					for($i=0; $i<count($post_array['description']); $i++)
					{
						if(isset($post_array['checklist_description_id'][$i]) && $post_array['checklist_description_id'][$i] > 0){
							// Update Query
							$update_ary = array();
							$update_ary['Description'] = $post_array['description'][$i];
							$update_ary['mark_complete_status'] = $post_array['description_mark_complete_status'][$i];
							$update_ary['modified_by'] = $this->user_session['ub_user_id'];
							$update_ary['modified_on'] = TODAY;
							$this->write_db->update(UB_PUNCH_LIST_CHECKLIST, $update_ary, array('ub_punch_list_checklist_id'=>$post_array['checklist_description_id'][$i]));
						}
						else
						{
							// Insert Query
							if(isset($post_array['description'][$i]) && !empty($post_array['description'][$i]))
							{
								$insert_ary = array();
								$insert_ary['builder_id'] = $this->user_session['builder_id'];
								$insert_ary['project_id'] = $post_array['project_id'];
								$insert_ary['punch_list_id'] = $post_array['ub_punch_list_id'];
								$insert_ary['description'] = $post_array['description'][$i];
								$insert_ary['mark_complete_status'] = $post_array['description_mark_complete_status'][$i];
								$insert_ary['created_by'] = $this->user_id;
								$insert_ary['created_on'] = TODAY;
								$insert_ary['modified_by'] = $this->user_id;
								$insert_ary['modified_on'] = TODAY;
								$this->write_db->insert(UB_PUNCH_LIST_CHECKLIST, $insert_ary);
							}
						}
					}
				}
				$data['insert_id'] =  $post_array['ub_punch_list_id'];
				$data['status'] = TRUE;
				$data['message'] = 'Updated Successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Update failed';
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
	* Delete TASKS
	*
	* @method: delete_comment
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: satheesh kumar
	*/
	public function delete_punchlists($delete_array)
	{
		if(isset($delete_array['ub_punch_list_id']))
		{
			foreach($delete_array['ub_punch_list_id'] as $key=>$ub_punch_list_id)
			{
				//echo '<pre>';print_r($ub_punch_list_id);exit;
				// $this->write_db->delete(UB_PUNCH_LIST, array('ub_punch_list_id' => $ub_punch_list_id));
				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_punch_list_id', $ub_punch_list_id);
				$this->write_db->update(UB_PUNCH_LIST, $post_array);
				/* Find folder id */
				$ui_folder_name = 'punchlist'.$ub_punch_list_id;
				/* Based on task id find project id */
				$project_id_array = $this->get_punchlists(array(
					'select_fields' => array('PUNCHLIST.project_id'),
					'where_clause' => array('PUNCHLIST.ub_punch_list_id'=>$ub_punch_list_id)
				));
				//print_r($project_id_array);exit;
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_punchlist->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_punch_list_id);
			}
			// echo $this->write_db->last_query();
			$data['status'] = TRUE;
			$data['message'] = 'Punch list Deleted Successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Punch list id is not set';
		}
		
		return $data;
	}
	
	//Fetch punchlist code
	public function get_punchlists($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PUNCH_LIST.' AS PUNCHLIST');	//UB_ROLE is the table name defined in constant file
		// $this->read_db->where(array('PUNCHLIST.is_delete' => 'No'));
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_USER.' AS USER','USER.ub_user_id = PUNCHLIST.created_by');	
		}
		
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['ub_task_checklist']))
		{
			$this->read_db->join(UB_PUNCH_LIST_CHECKLIST.' AS PUNCH_LIST_CHECKLIST','PUNCHLIST.ub_punch_list_id = PUNCH_LIST_CHECKLIST.punch_list_id');
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
	
	/* Below function was added by chandru 19-08-2015 */
	public function update_punchlist_from_sign_off($post_array = array())
	{
		if(!empty($post_array))
		{
			$punchlist_table_update_array = array(
					'mark_complete_status' => 'Yes');
			$this->write_db->where('project_id', $post_array['project_id']);
			if($this->write_db->update(UB_PUNCH_LIST, $punchlist_table_update_array))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Updated successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Update failed';
			}
		}
	}

}