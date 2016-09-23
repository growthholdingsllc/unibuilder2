<?php
/** 
 * checklist Model
 * 
 * @package: checklist Model
 * @subpackage: checklist Model 
 * @category: checklist
 * @author: chadnru
 * @createdon(DD-MM-YYYY): 11-04-2015
*/
class Mod_checklist extends UNI_Model
{
	/**
	 * @property: $project_id
	 * @access: public
	 */

	public $project_id;
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['ub_user_id'])?$this->user_session['ub_user_id']:0;
		$this->project_id = 0;
		parent::__construct();
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
	
	/**
	*
	* Add task
	*
	* @method: add_check_list
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdon(DD-MM-YYYY): 11-04-2015
	* @createdby: chandru
	*/
	public function add_check_list($post_array = array())
	{
		if( ! empty($post_array))
		{
			 $this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
					if($this->write_db->insert(UB_CHECKLIST, $post_array))
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
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		//echo $this->write_db->last_query();
		return $data;
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
	* @method: get_check_list
	* @access: public 
	* @param: args
	* @return: array
	* @createdby: chandru
	*/
	public function get_check_list($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_CHECKLIST.' AS UB_CHECKLIST');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
		$this->read_db->join(UB_PROJECT.' AS PROJECT','PROJECT.ub_project_id = UB_CHECKLIST.project_id');
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
	*
	* @method: update_checklist
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	*/
	public function update_checklist($post_array = array())
	{
		$this->write_db->where('ub_checklist_id', $post_array['ub_checklist_id']);
		$this->write_db->update(UB_CHECKLIST, $post_array);
		$data['insert_id'] =  $post_array['ub_checklist_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Updated successfully';
		return $data;
	}
	
	/**
	*
	* Delete checklists
	*
	* @method: delete_checklists
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	*/
	public function delete_checklists($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_checklist_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_checklist_id'] as $key=>$ub_checklist_id)
			{
				// $this->write_db->delete(UB_CHECKLIST, array('ub_checklist_id' => $ub_checklist_id));
				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_checklist_id', $ub_checklist_id);
				$this->write_db->update(UB_CHECKLIST, $post_array);
				/* Find folder id */
				$ui_folder_name = 'checklist'.$ub_checklist_id;
				/* Based on checklist id find project id */
				$project_id_array = $this->get_check_list(array(
					'select_fields' => array('UB_CHECKLIST.project_id'),
					'where_clause' => array('UB_CHECKLIST.ub_checklist_id'=>$ub_checklist_id)
				));
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_checklist->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_checklist_id);
			}
			//echo "Deleted Sucessfully";
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
	
	public function get_task_check_list($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TASK_CHECKLIST.' AS UB_TASK_CHECKLIST');	//UB_ROLE is the table name defined in constant file
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
		//echo $this->read_db->last_query();exit;
		return $data;
	}
	
	
	
}
	
/* End of file mod_project.php */
/* Location: ./application/models/mod_project.php */