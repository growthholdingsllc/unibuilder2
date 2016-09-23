<?php
/** 
 * template selection Model
 * 
 * @package: Template task Model
 * @subpackage: Template Model 
 * @category: Template
 * @author: satheesh
 * @createdon(DD-MM-YYYY): 29-07-2015
*/
class Mod_template_selection extends UNI_Model
{
	
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		
		parent::__construct();
    }
	/** 
	* Get selections information
	*
	* @method: get_selections
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh kumar
	* @created on: 26-apr-2014
	*/
	public function get_selections($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SELECTION.' AS SELECTION');
		
         
	 	if(isset($args['join']['selection_choice']) && 'yes' === strtolower($args['join']['selection_choice']))
	    {
	       $this->read_db->join(UB_TEMPLATE_SELECTION_CHOICE.' AS SELECTION_CHOICE','SELECTION.ub_template_selection_id = SELECTION_CHOICE.template_selection_id','left');
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
				}else{
					$allowance_data = '';
				}
			$selections_table_insert_array = array(
					'builder_id' => $this->user_session['builder_id'],
					'template_id' => $post_array['template_id'],
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
					'allow_multiple_choice_selection' => $post_array['allow_multiple_choice_selection'],
					'description' => $post_array['description'],
					'builderuser_notes' => $post_array['builderuser_notes'],
					'status' => 'Active',
					'created_by' => $this->user_session['ub_user_id'],
					'created_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
			);
			
			 $this->builder_id = (isset($selections_table_insert_array['builder_id']))?$selections_table_insert_array['builder_id']:$this->builder_id;
					if($this->write_db->insert(UB_TEMPLATE_SELECTION, $selections_table_insert_array))
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
		$this->write_db->where('ub_template_selection_id', $post_array['ub_template_selection_id']);
		$this->write_db->update(UB_TEMPLATE_SELECTION, $post_array);
		$data['insert_id'] =  $post_array['ub_template_selection_id'];
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
					'template_selection_id' => $post_array['template_selection_id'],
					'template_id' => $post_array['template_id'],
					'title' => $post_array['title'],
					'standard_choice' => $post_array['standard_choice'],
					'product_url' => $post_array['product_url'],
					/* 'owner_price_tbd' => $post_array['owner_price_tbd'],
					'owner_price' => $post_array['owner_price'],
					'subcontractor_price_tbd' => $post_array['subcontractor_price_tbd'],
					'subcontractor_price' => $post_array['subcontractor_price'],
					'sub_pricing_comments' => $post_array['sub_pricing_comments'], */
					'description' => $post_array['description'],
					'status' => 'Pending',
					'created_by' => $this->user_session['ub_user_id'],
					'created_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
			);
			$this->builder_id = (isset($selections_choice_table_insert_array['builder_id']))?$selections_choice_table_insert_array['builder_id']:$this->builder_id;
			if($this->write_db->insert(UB_TEMPLATE_SELECTION_CHOICE, $selections_choice_table_insert_array))
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
		$this->read_db->from(UB_TEMPLATE_SELECTION_CHOICE.' AS SELECTION_CHOICE');
		//Join
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
		$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = SELECTION_CHOICE.created_by');
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
				$this->write_db->delete(UB_TEMPLATE_SELECTION, array('ub_template_selection_id' => $ub_selection_id));
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'selection deleted successfully';
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
		$selections_table_update_status_array = array(
					'ub_template_selection_choice_id' => $post_array['ub_template_selection_choice_id'],
					'template_id' => $post_array['template_id'],
					'status' => $post_array['status'],
					'title' => $post_array['title'],
					'standard_choice' => $post_array['standard_choice'],
					'product_url' => $post_array['product_url'],
					/* 'owner_price_tbd' => $post_array['owner_price_tbd'],
					'owner_price' => $post_array['owner_price'],
					'subcontractor_price_tbd' => $post_array['subcontractor_price_tbd'],
					'subcontractor_price' => $post_array['subcontractor_price'],
					'sub_pricing_comments' => $post_array['sub_pricing_comments'], */
					'description' => $post_array['description']
					/* 'vendor_id' => $post_array['vendor_id'],
					'installer_id' => $post_array['installer_id'], */
					);
				// echo '<pre>';print_r($selections_table_update_status_array);exit;	
		$this->write_db->where('ub_template_selection_choice_id', $post_array['ub_template_selection_choice_id']);
		$this->write_db->update(UB_TEMPLATE_SELECTION_CHOICE, $selections_table_update_status_array);
		$data['insert_id'] =  $post_array['ub_template_selection_choice_id'];
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
		$this->write_db->where('ub_selection_id', $post_array['ub_selection_id']);
		$this->write_db->update(UB_SELECTION, $post_array);
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
				$this->write_db->delete(UB_TEMPLATE_SELECTION, array('ub_template_selection_id' => $ub_selection_id));
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