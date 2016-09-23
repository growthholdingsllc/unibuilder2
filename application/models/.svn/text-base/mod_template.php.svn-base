<?php
/** 
 * Template Model
 * 
 * @package: Template Model
 * @subpackage: Template Model 
 * @category: Template
 * @author: Sidhartha
 * @createdon(DD-MM-YYYY): 3-07-2015
*/
class Mod_template extends UNI_Model
{
	
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		
		parent::__construct();
    }
	/** 
	* Add Template
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template($post_array = array())
	{
	 if( ! empty($post_array))
	 {
		$post_array['project_id'] = $post_array['ub_project_id'];
		$post_array['project_status'] = 'Open';
		$post_array['created_by'] = $this->user_session['ub_user_id'];
		$post_array['created_on'] = TODAY;
		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		unset($post_array['ub_project_id']);
		unset($post_array['warranty_claims_period']);
		unset($post_array['owner_add_claims']);
		unset($post_array['signature_file_id']);
		unset($post_array['signature_content']);
		unset($post_array['signoff_status']);
		unset($post_array['owner_add_claims']);
		unset($post_array['signoff_date']);
		unset($post_array['is_delete']);
		//echo "<pre>";print_r($post_array);exit;
		if($this->write_db->insert(UB_TEMPLATE, $post_array))
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
	 //echo "<pre>".$this->write_db->last_query();exit;
	 return $data;
		
	}

	/** 
	* Add Template Schedule.
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template_schedule
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_schedule($schedule_info = array(), $post_array = array())
	{
	 if( ! empty($schedule_info))
	 {
		/* $schedule_info = $this->Mod_schedule->get_schedules(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'])
							));
		if($schedule_info['status'] == TRUE)
		{
			$schedule_info = $schedule_info['aaData'];
			foreach ($schedule_info as $key => $value) 
			{
				$schedule_info[$key]['schedule_id'] = $schedule_info[$key]['ub_schedule_id'];
				$schedule_info[$key]['template_id'] = $post_array['template_id'];
				$schedule_info[$key]['created_by'] = $this->user_session['ub_user_id'];
				$schedule_info[$key]['created_on'] = TODAY;
				$schedule_info[$key]['modified_by'] = $this->user_session['ub_user_id'];
				$schedule_info[$key]['modified_on'] = TODAY;
				unset($schedule_info[$key]['ub_schedule_id']);
			} */

			if($this->write_db->insert(UB_TEMPLATE_SCHEDULE, $schedule_info))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$this->write_db->query("UPDATE ub_template_schedule SET project_schedule_startdates_diff_in_days = calculate_no_of_days_fun(`builder_id` ,`project_id` ,'".$post_array['projected_start_date']."',`start_date`) WHERE `template_id` = ".$post_array['template_id']);

				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
		/* }
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Failed to insert the data';
		} */
		//echo $this->write_db->last_query();exit;
	 }
	 else
	 {
	   $data['status'] = FALSE;
	   $data['message'] = 'Insert Failed: Post array is empty';
	 }
	 return $data;
	}
	/** 
	* Add Template Bid
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template_bid
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_bid($post_array = array())
	{
	 if( ! empty($post_array))
	 {
	 	/*$bid_info = $this->Mod_bid->get_bids(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'])
						));	*/
	 	//print_r($bid_info);exit;
		/*if($bid_info['status'] == TRUE)
		{
			$bid_data = $bid_info['aaData'];
			foreach ($bid_data as $key => $value) {
				$bid_data[$key]['template_id'] = $post_array['template_id'];
				$bid_data[$key]['bid_id'] = $bid_data[$key]['ub_bid_id'];
				$bid_data[$key]['status'] = 'In Progress';
				$bid_data[$key]['created_by'] = $this->user_session['ub_user_id'];
		        $bid_data[$key]['created_on'] = TODAY;
		        $bid_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
		        $bid_data[$key]['modified_on'] = TODAY;
		        unset($bid_data[$key]['ub_bid_id']);
			}*/

		if($this->write_db->insert(UB_TEMPLATE_BID, $post_array))
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
	   /*}
	   else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Failed to insert the data';
		}*/
	 }
	 else
	 {
	   $data['status'] = FALSE;
	   $data['message'] = 'Insert Failed: Post array is empty';
	 }
	 return $data;
		
	}
	/** 
	* Add Template Bid Cost Code
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template_bid_cost_code
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_bid_cost_code($post_array = array())
	{
	 if( ! empty($post_array))
	 {
	 	/*$bid_cost_code_info = $this->Mod_bid->get_bid_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'])
							));
	 	if($bid_cost_code_info['status'] == TRUE)
		{
		  $bid_cost_code_data = $bid_cost_code_info['aaData'];
		  foreach ($bid_cost_code_data as $key => $value) {
			$bid_cost_code_data[$key]['template_id'] = $post_array['template_id'];
			$bid_cost_code_data[$key]['status'] = 'In Progress';
			$bid_cost_code_data[$key]['created_by'] = $this->user_session['ub_user_id'];
			$bid_cost_code_data[$key]['created_on'] = TODAY;
			$bid_cost_code_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
			$bid_cost_code_data[$key]['modified_on'] = TODAY;
			unset($bid_cost_code_data[$key]['ub_bid_cost_code_id']);
				
		   }*/
		
		if($this->write_db->insert(UB_TEMPLATE_BID_COST_CODE, $post_array))
		{
			//$data['insert_id'] =  $this->write_db->insert_id();
			$data['status'] = TRUE;
			$data['message'] = 'Data inserted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Failed to insert the data';
		}
	   /*}
	   else
	   {
		 $data['status'] = FALSE;
		 $data['message'] = 'Insert Failed: Failed to insert the data';
	   }*/
	 }
	 else
	 {
	   $data['status'] = FALSE;
	   $data['message'] = 'Insert Failed: Post array is empty';
	 }
	 return $data;
		
	}
	/** 
	* Add Template Checklist
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template_checklist
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_checklist($post_array = array())
	{
	 if( ! empty($post_array))
	 {
	 	$checklist_info = $this->Mod_checklist->get_check_list(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'])
							));
	 	if($checklist_info['status'] == TRUE){
		$checklist_data = $checklist_info['aaData'];
		foreach ($checklist_data as $key => $value) {
			$checklist_data[$key]['template_id'] = $post_array['template_id'];
			$checklist_data[$key]['created_by'] = $this->user_session['ub_user_id'];
			$checklist_data[$key]['created_on'] = TODAY;
			$checklist_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
			$checklist_data[$key]['modified_on'] = TODAY;
			unset($checklist_data[$key]['ub_checklist_id']);
			 }
		if($this->write_db->insert_batch(UB_TEMPLATE_CHECKLIST, $checklist_data))
		{
			//$data['insert_id'] =  $this->write_db->insert_id();
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
	* Add Template PO CO
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template_po_co
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_po_co($post_array = array())
	{
		//print_r($post_array);exit;
	 if( ! empty($post_array))
	 {
	 	/*$po_co_info = $this->Mod_po_co->get_po_co(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'],'type' => 'PO')
							));
	 	if($po_co_info['status'] == TRUE)
		{
			$po_co_data = $po_co_info['aaData'];
			foreach ($po_co_data as $key => $value) {
			$po_co_data[$key]['template_id'] = $post_array['template_id'];
			$po_co_data[$key]['po_co_id'] = $po_co_data[$key]['ub_po_co_id'];
			$po_co_data[$key]['po_status'] = 'Not Released';
			$po_co_data[$key]['created_by'] = $this->user_session['ub_user_id'];
			$po_co_data[$key]['created_on'] = TODAY;
			$po_co_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
			$po_co_data[$key]['modified_on'] = TODAY;
			unset($po_co_data[$key]['ub_po_co_id']);
			 }*/
		if($this->write_db->insert(UB_TEMPLATE_PO_CO, $post_array))
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
		//echo $this->write_db->last_query();exit;
	   /*}
	   else
	   {
		$data['status'] = FALSE;
		$data['message'] = 'Insert Failed: Failed to insert the data';
	   }*/
	 }
	 else
	 {
	   $data['status'] = FALSE;
	   $data['message'] = 'Insert Failed: Post array is empty';
	 }
	 return $data;
		
	}
	/** 
	* Add Template PO CO Cost Code
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template_po_co_cost_code
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_po_co_cost_code($post_array = array())
	{
	 if( ! empty($post_array))
	 {
	 	/*$po_co_cost_code_info = $this->Mod_po_co->get_po_co_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'],'type' => 'PO')
							));
		if($po_co_cost_code_info['status'] == TRUE)
		{
		 $po_co_cost_code_data = $po_co_cost_code_info['aaData'];
			 foreach ($po_co_cost_code_data as $key => $value) {
			$po_co_cost_code_data[$key]['template_id'] = $post_array['template_id'];
			$po_co_cost_code_data[$key]['status'] = 'Not Released';
			$po_co_cost_code_data[$key]['created_by'] = $this->user_session['ub_user_id'];
			$po_co_cost_code_data[$key]['created_on'] = TODAY;
			$po_co_cost_code_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
			$po_co_cost_code_data[$key]['modified_on'] = TODAY;
			unset($po_co_cost_code_data[$key]['ub_po_co_cost_code_id']);
			 }*/
		if($this->write_db->insert(UB_TEMPLATE_PO_CO_COST_CODE, $post_array))
		{
			//$data['insert_id'] =  $this->write_db->insert_id();
			$data['status'] = TRUE;
			$data['message'] = 'Data inserted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Failed to insert the data';
		}
	   /*}
	   else
	   {
		$data['status'] = FALSE;
		$data['message'] = 'Insert Failed: Failed to insert the data';
	   }*/
	 }
	 else
	 {
	   $data['status'] = FALSE;
	   $data['message'] = 'Insert Failed: Post array is empty';
	 }
	 return $data;
		
	}/** 
	* Add Template Schedule Predecessor Info
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: add_template_schedule_predecessor_info
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_schedule_predecessor_info($post_array = array())
	{
	 if( ! empty($post_array))
	 {
	 	/* $schedules_predecessor = $this->Mod_schedule->get_schedules_predecessor(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'])
							));
	 	if($schedules_predecessor['status'] == TRUE)
		{
		 $schedules_predecessor = $schedules_predecessor['aaData'];
			 foreach ($schedules_predecessor as $key => $value) 
			 {
				$schedules_predecessor[$key]['template_id'] = $post_array['template_id'];
				$schedules_predecessor[$key]['created_by'] = $this->user_session['ub_user_id'];
				$schedules_predecessor[$key]['created_on'] = TODAY;
				$schedules_predecessor[$key]['modified_by'] = $this->user_session['ub_user_id'];
				$schedules_predecessor[$key]['modified_on'] = TODAY;
				unset($schedules_predecessor[$key]['ub_schedule_predecessor_info_id']);
			 } */
			if($this->write_db->insert_batch(UB_TEMPLATE_SCHEDULE_PREDECESSOR_INFO, $post_array))
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
	  /*  }
	   else
	   {
		$data['status'] = FALSE;
		$data['message'] = 'Insert Failed: Failed to insert the data';
	   } */
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
		
	}

	
	/* @method: add_template_selections
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_selections($post_array = array())
	{	
		 //Insert in ub_template_selection table
		
		if(!empty($post_array))
		{
			if($this->write_db->insert(UB_TEMPLATE_SELECTION, $post_array))
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
		//echo $this->write_db->last_query();exit;
		return $data;	
	}

	/* @method: add_template_selection_choices
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_selection_choices($post_array = array())
	{
		if(!empty($post_array))
		{
			if($this->write_db->insert_batch(UB_TEMPLATE_SELECTION_CHOICE, $post_array))
			{
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
	* Get template  information
	*
	* @method: get_template
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE.' AS TEMPLATE');
		
		
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
        {

        $this->read_db->join(UB_USER.' AS USER','TEMPLATE.created_by = USER.ub_user_id','left');
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get template Bid information
	*
	* @method: get_template
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_bid($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_BID.' AS TEMPLATE_BID');
   
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get template bid cost code information
	*
	* @method: get_template_bid_cost_code
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_bid_cost_code($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_BID_COST_CODE.' AS TEMPLATE_BID_COST_CODE');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		if(isset($args['join']['variance_code']) && 'yes' === strtolower($args['join']['variance_code']))
        {

        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','TEMPLATE_BID_COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id','left');
        }
		// Order by condition
		
		$res = $this->read_db->get();
		  //echo $this->read_db->last_query();exit;
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get template po co information
	*
	* @method: get_template_po_co
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_po_co($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_PO_CO.' AS TEMPLATE_PO_CO');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
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
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
		  $this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = TEMPLATE_PO_CO.assigned_to','left');
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get template po co information
	*
	* @method: get_template_po_co_cost_code
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_po_co_cost_code($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_PO_CO_COST_CODE.' AS TEMPLATE_PO_CO_COST_CODE');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		if(isset($args['join']['variance_code']) && 'yes' === strtolower($args['join']['variance_code']))
        {

        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','TEMPLATE_PO_CO_COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id','left');
        }
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get template checklist information
	*
	* @method: get_template_checklist
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_checklist($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_CHECKLIST.' AS TEMPLATE_CHECKLIST');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	
	/** 
	* Get template information
	*
	* @method: get_template
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_selection($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SELECTION.' AS TEMPLATE_SELECTION');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	
	
	/** 
	* Get template information
	*
	* @method: get_template_selection_choices
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_selection_choices($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SELECTION_CHOICE.' AS TEMPLATE_SELECTION_CHOICE');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}

	/* @method: add_template_workday_exception
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_workday_exception($post_array = array())
	{
		if( ! empty($post_array))
		{
		 	$workday_exception = $this->Mod_schedule->get_workday_exception(array(
								'select_fields' => array('*'),
								'where_clause' => array('project_id' => $this->project_id)
								));
		 	if($workday_exception['status'] == TRUE)
			{
			 $workday_exception = $workday_exception['aaData'];
				 foreach ($workday_exception as $key => $value) 
				 {
					$workday_exception[$key]['template_id'] = $post_array['template_id'];
					$workday_exception[$key]['created_by'] = $this->user_session['ub_user_id'];
					$workday_exception[$key]['created_on'] = TODAY;
					$workday_exception[$key]['modified_by'] = $this->user_session['ub_user_id'];
					$workday_exception[$key]['modified_on'] = TODAY;
					unset($workday_exception[$key]['ub_workday_exception_id']);
				 }
			if($this->write_db->insert_batch(UB_TEMPLATE_WORKDAY_EXCEPTION, $workday_exception))
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

	
	/* @method: add_template_estimate
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function add_template_estimate($post_array = array())
	{
		if(!empty($post_array))
		{
		$estimate_info = $this->Mod_budget->get_estimate(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $this->project_id)
							));
							//echo '<pre>';print_r($estimate_info);exit;
			if($estimate_info['status'] == TRUE)
			{
				$estimate_data = $estimate_info['aaData'];
				foreach ($estimate_data as $key => $value) 
				{
					$template_estimate_data[$key]['template_id'] = $post_array['template_id'];
					$template_estimate_data[$key]['created_by'] = $this->user_id;
					$template_estimate_data[$key]['created_on'] = TODAY;
					$template_estimate_data[$key]['estimate_id'] = $estimate_data[$key]['ub_estimate_id'];
					$template_estimate_data[$key]['builder_id'] = $estimate_data[$key]['builder_id'];
					$template_estimate_data[$key]['project_id'] = $estimate_data[$key]['project_id'];
					$template_estimate_data[$key]['cost_code_id'] = $estimate_data[$key]['cost_code_id'];
					$template_estimate_data[$key]['cost_code_name'] = $estimate_data[$key]['cost_code_name'];
					$template_estimate_data[$key]['description'] = $estimate_data[$key]['description'];
					$template_estimate_data[$key]['quantity'] = $estimate_data[$key]['quantity'];
					$template_estimate_data[$key]['unit_cost'] = $estimate_data[$key]['unit_cost'];
					$template_estimate_data[$key]['budget_amount'] = $estimate_data[$key]['budget_amount'];
					$template_estimate_data[$key]['overhead_cost'] = $estimate_data[$key]['overhead_cost'];
					
					/* unset($estimate_data[$key]['ub_estimate_id']);
					unset($estimate_data[$key]['po_awarded_amount']);
					unset($estimate_data[$key]['po_count']);
					unset($estimate_data[$key]['co_awarded_amount']);
					unset($estimate_data[$key]['co_count']);
					unset($estimate_data[$key]['revised_contract']);
					unset($estimate_data[$key]['estimated_profit_amount']);
					unset($estimate_data[$key]['bill_to_client_to_date']);
					unset($estimate_data[$key]['paid_by_client_to_date']);
					unset($estimate_data[$key]['po_paid_by_client_to_date']);
					unset($estimate_data[$key]['co_paid_by_client_to_date']);
					unset($estimate_data[$key]['unpaid_client_billing']);
					unset($estimate_data[$key]['balance_to_bill_client']);
					unset($estimate_data[$key]['invoiced_by_sub_to_date']);
					unset($estimate_data[$key]['amount_paid_to_sub']);
					unset($estimate_data[$key]['balance_to_be_invoiced_by_sub']);
					unset($estimate_data[$key]['total_balance_owed_to_sub']);
					unset($estimate_data[$key]['total_cost']);
					unset($estimate_data[$key]['profit_to_date']);
					unset($estimate_data[$key]['overall_profit']); */
				}
				if($this->write_db->insert_batch(UB_TEMPLATE_ESTIMATE, $template_estimate_data))
				{
					//$data['insert_id'] =  $this->write_db->insert_id();
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
	* Get template workday exception information
	*
	* @method: get_template_workday_exception
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_workday_exception($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_WORKDAY_EXCEPTION.' AS TEMPLATE_WORKDAY_EXCEPTION');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get template schedule predecessor info information
	*
	* @method: get_template_schedule_predecessor_info
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_schedule_predecessor_info($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SCHEDULE_PREDECESSOR_INFO.' AS TEMPLATE_SCHEDULE_PREDECESSOR_INFO');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
		$res = $this->read_db->get();

		//  echo $this->read_db->last_query();
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
        //echo '<pre>';print_r($res->result_array);	exit;	
		return $data;
	}
	/** 
	* Get template schedule information
	*
	* @method: get_template_schedule
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_template_schedule($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SCHEDULE.' AS TEMPLATE_SCHEDULE');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	
	/** 
	* Get template estimate information
	*
	* @method: get_template_estimate
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh
	* @created on: 07-07-2015
	*/
	public function get_template_estimate($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_ESTIMATE.' AS TEMPLATE_ESTIMATE');
   
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
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	
	/* Task code */
	/** 
	* Get template estimate information
	*
	* @method: get_template_task
	* @access: public 
	* @param: args
	* @return: array
	* @created by: chandru
	* @created on: 16-07-2015
	*/
	public function get_template_task($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_TASK.' AS UB_TEMPLATE_TASK');
		
		// Join Tables
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_USER.' AS USER','USER.ub_user_id = UB_TEMPLATE_TASK.created_by');
		}
		
		// Join Tables
		if(isset($args['join']['task_checklist']) && 'yes' === strtolower($args['join']['task_checklist']))
		{
			$this->read_db->join(UB_TEMPLATE_TASK_CHECKLIST.' AS UB_TEMPLATE_TASK_CHECKLIST','UB_TEMPLATE_TASK.ub_template_task_id = UB_TEMPLATE_TASK_CHECKLIST.template_task_id');
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	
	/** 
	* Get template estimate information
	*
	* @method: get_template_checklist
	* @access: public 
	* @param: args
	* @return: array
	* @created by: chandru
	* @created on: 17-07-2015
	*/
	public function get_template_checklists($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_TASK_CHECKLIST.' AS UB_TEMPLATE_TASK_CHECKLIST');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	
	/** 
	* Get template estimate information
	*
	* @method: get_template_estimate
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh
	* @created on: 07-07-2015
	*/
	public function insert_schedule_predecessor_info($args = array())
	{
		if(!empty($args))
		{
			if($this->write_db->insert_batch(UB_SCHEDULE_PREDECESSOR_INFO, $args))
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* insert schedule information
	*
	* @method: insert_schedule
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh
	* @created on: 07-07-2015
	*/
	public function insert_schedule($args = array())
	{
		//echo "<pre>";print_r($args);exit();
		if(!empty($args))
		{
				/* $project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('*'),
					'where_clause' => array('PROJECT.ub_project_id'=> $args['project_id'])
					));
				if(TRUE === $project_list['status'])
				{
					$project_start_date = $project_list['aaData'][0]['projected_start_date'];
					if (!empty($project_list['aaData'][0]['off_days'])) 
					{
						$offdays = $project_list['aaData'][0]['off_days'];
					}
					else
					{
						$offdays =',0,';
					}
				} */
			// echo '<pre>';print_r($args);exit;
			if($this->write_db->insert(UB_SCHEDULE, $args))
			{
				//echo '<pre>';print_r($this->write_db->insert_id());exit;
				/* $this->write_db->query("UPDATE ub_schedule SET start_date = 
						get_end_date_fun(builder_id,project_id, '". $project_start_date ."', project_schedule_startdates_diff_in_days, '". $offdays ."')WHERE `import_id` = ".$args['import_id']); */   
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* insert schedule information
	*
	* @method: insert_schedule
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh
	* @created on: 07-07-2015
	*/
	public function update_schedule_start_date($args = array())
	{
		//echo "<pre>";print_r($args);exit();
		if(!empty($args))
		{
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('*'),
					'where_clause' => array('PROJECT.ub_project_id'=> $args['project_id'])
					));
				if(TRUE === $project_list['status'])
				{
					$project_start_date = $project_list['aaData'][0]['projected_start_date'];
					if (!empty($project_list['aaData'][0]['off_days'])) 
					{
						$offdays = $project_list['aaData'][0]['off_days'];
					}
					else
					{
						$offdays =',0,';
					}
				}
				
			$response = $this->write_db->query("UPDATE ub_schedule SET start_date = 
				get_end_date_fun(builder_id,project_id, '". $project_start_date ."', project_schedule_startdates_diff_in_days, '". $offdays ."') WHERE import_id = '".$args['import_id']."'");
				echo $this->write_db->last_query();exit;
			if($response)
			{
				$data['status'] = TRUE;
				$data['message'] = 'Data updated successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'updated Failed: Failed to update the data';
			}
		}
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get template estimate information
	*
	* @method: get_template_estimate
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh
	* @created on: 07-07-2015
	*/
	public function insert_workday_exception($args = array())
	{
		//echo "<pre>";print_r($args);exit();
		if(!empty($args))
		{
			if($this->write_db->insert_batch(UB_WORKDAY_EXCEPTION, $args))
			{
				$data['insert_id_s'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
		}
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	
	/* Task */
	/* @method: add_template_task
	* @access: public 
	* @param: args
	* @return: array
	* @created by : chandru
	* @created on : 16-07-2015
	*/
	public function add_template_task($post_array = array())
	{
		if(!empty($post_array))
		{
		/*$task_info = $this->Mod_task->get_task(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'])
							));
			if($task_info['status'] == TRUE)
			{
				$task_data = $task_info['aaData'];
				foreach ($task_data as $key => $value) 
				{
					$task_data[$key]['template_id'] = $post_array['template_id'];
					$task_data[$key]['created_by'] = $this->user_id;
					$task_data[$key]['created_on'] = TODAY;
					$task_data[$key]['task_id'] = $task_data[$key]['ub_task_id'];
					unset($task_data[$key]['ub_task_id']);
				}*/
				if($this->write_db->insert(UB_TEMPLATE_TASK, $post_array))
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
			/*}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}*/
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
		
	}
	
	/* Checklist */
	/* Task */
	/* @method: add_template_task_checklist
	* @access: public 
	* @param: args
	* @return: array
	* @created by : chandru
	* @created on : 16-07-2015
	*/
	public function add_template_task_checklist($post_array = array())
	{
		if(!empty($post_array))
		{
		/*$task_info = $this->Mod_checklist->get_task_check_list(array(
							'select_fields' => array('*'),
							'where_clause' => array('project_id' => $post_array['project_id'])
							));
			if($task_info['status'] == TRUE)
			{
				$task_data = $task_info['aaData'];
				foreach ($task_data as $key => $value) 
				{
					$task_data[$key]['template_id'] = $post_array['template_id'];
					$task_data[$key]['created_by'] = $this->user_id;
					$task_data[$key]['created_on'] = TODAY;
					unset($task_data[$key]['ub_task_checklist_id']);
				}*/
				if($this->write_db->insert(UB_TEMPLATE_TASK_CHECKLIST, $post_array))
				{
					//$data['insert_id'] =  $this->write_db->insert_id();
					$data['status'] = TRUE;
					$data['message'] = 'Data inserted successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Failed to insert the data';
				}
			/*}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}*/
			//echo $this->write_db->last_query();exit;
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
	* Add Bid
	*
	* @method: add_bid
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_bid($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
					if($this->write_db->insert(UB_TEMPLATE_BID, $post_array))
					{
						//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
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
				$data['message'] = 'Insert Failed: Not a valid builder';
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
	*
	* Add bid cost code
	*
	* @method: add_bid_cost_code
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_bid_cost_code($post_array = array())
	{
	  if( ! empty($post_array))
	  {
		$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
		if($this->builder_id > 0)
		{
		  for($i=0; $i<count($post_array['cost_code_id']); $i++)
		  {
		   if($post_array['cost_code_id'][$i] > 0)
		   {
		   		$insert_cost_code_ary = array();
				$insert_cost_code_ary['builder_id'] = $this->user_session['builder_id'];
				$insert_cost_code_ary['template_id'] =  $this->template_id;
				$insert_cost_code_ary['template_bid_id'] =  $post_array['template_bid_id'];
				$insert_cost_code_ary['cost_code_id'] = $post_array['cost_code_id'][$i];
				$insert_cost_code_ary['cost_code_description'] = $post_array['cost_code_description'][$i];
				$insert_cost_code_ary['status'] = 'In Progress';
				$insert_cost_code_ary['created_by'] = $this->user_session['ub_user_id'];
				$insert_cost_code_ary['created_on'] = TODAY;
				$insert_cost_code_ary['modified_by'] = $this->user_session['ub_user_id'];
				$insert_cost_code_ary['modified_on'] = TODAY;
				$this->write_db->insert(UB_TEMPLATE_BID_COST_CODE, $insert_cost_code_ary);
		   }
		  }
		}
	  }
	}
	/**
	*
	* Update bid
	*
	* @method: update_bid
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_bid($post_array = array())
	{
		//print_r($post_array);
		if( ! empty($post_array))
		{
			
				 
				$this->write_db->where('ub_template_bid_id', $post_array['ub_template_bid_id']);
				if($this->write_db->update(UB_TEMPLATE_BID, $post_array))
				{
					

					$data['insert_id'] =  $post_array['ub_template_bid_id'];
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
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
	* Update cost code
	*
	* @method: update_cost_code
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_bid_cost_code($post_array = array())
	{
		
		if( ! empty($post_array))
		{

			
				//clone code starts here
					//print_r($post_array);
					if(isset($post_array['code']) && count(array_filter($post_array['code'])) > 0){
						
						$this->write_db->where('template_bid_id', $post_array['template_bid_id']);
						$this->write_db->where_not_in('ub_template_bid_cost_code_id', array_filter($post_array['code']));
						$this->write_db->delete(UB_TEMPLATE_BID_COST_CODE);
						//echo $this->write_db->last_query();
					}
					else{
						
						$this->write_db->where('template_bid_id', $post_array['template_bid_id']);
						$this->write_db->delete(UB_TEMPLATE_BID_COST_CODE);

					}
				 
				   //Insert/update code
					

		           if(isset($post_array['cost_code_id'])){

			       for($i=0; $i<count($post_array['cost_code_id']); $i++){
			       	
				   if(isset($post_array['code'][$i]) && $post_array['code'][$i] > 0){
					// Update Query
					
					$update_array = array();
					$update_array['ub_template_bid_cost_code_id'] = $post_array['code'][$i];
					$update_array['cost_code_id'] = $post_array['cost_code_id'][$i];
					$update_array['cost_code_description'] = $post_array['cost_code_description'][$i];
					$update_array['modified_by'] = $this->user_session['ub_user_id'];
		            $update_array['modified_on'] = TODAY;

					
					$this->write_db->update(UB_TEMPLATE_BID_COST_CODE, $update_array, array('ub_template_bid_cost_code_id'=>$post_array['ub_template_bid_cost_code_id'][$i]));
					
				    }else if($post_array['cost_code_id'][$i] > 0){
					// Insert Query
				    $insert_ary = array();
					$insert_ary['builder_id'] = $this->user_session['builder_id'];
					$insert_ary['template_id'] =  $post_array['template_id'];
					$insert_ary['template_bid_id'] =  $post_array['template_bid_id'];
					$insert_ary['cost_code_id'] = $post_array['cost_code_id'][$i];
					$insert_ary['cost_code_description'] = $post_array['cost_code_description'][$i];
					$insert_ary['status'] = 'Inprogress';
					$insert_ary['created_by'] = $this->user_session['ub_user_id'];
					$insert_ary['created_on'] = TODAY;
					$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
					$insert_ary['modified_on'] = TODAY;

				   
					$this->write_db->insert(UB_TEMPLATE_BID_COST_CODE, $insert_ary);
				}
			}
			
		}
			
				
		}
		
		//return $data;	
	}
	public function delete_bids($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_template_bid_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_template_bid_id'] as $key=>$ub_template_bid_id)
			{
				$this->write_db->delete(UB_TEMPLATE_BID, array('ub_template_bid_id' => $ub_template_bid_id));
			}
			
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Bids deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Bid id is not set';
		}
		return $data;

	}
	/**
	*
	* Add po_co
	*
	* @method: add_po_co
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_po_co($post_array = array(),$cost_code_insert_array = array())
	{

		if( ! empty($post_array))
		{
		  //check po/co limit check
		  
		  	// If this is first po

		  	if($this->write_db->insert(UB_TEMPLATE_PO_CO, $post_array))
			{
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';

				$result = $this->Mod_builder->get_setup(array(
								'select_fields' => array('po_prefix', 'co_prefix'),
								'where_clause' => array('builder_id' => $this->user_session['builder_id'])
								));
			           if(isset($result['aaData'][0]['po_prefix']) && $result['aaData'][0]['po_prefix']!='')
					{
						$po_prefix = $result['aaData'][0]['po_prefix'];
					}
					else
					{
						$po_prefix = 'PO';
					}
					if(isset($result['aaData'][0]['co_prefix']) && $result['aaData'][0]['co_prefix']!='')
					{
						$co_prefix = $result['aaData'][0]['co_prefix'];
					}
					else
					{
						$co_prefix = 'CO';
					}
		        
		           if($post_array['type'] == 'PO'){
		           	$update_array = array();
		           $update_array['ub_po_co_number'] = $this->Mod_po_co->generate_number(strtoupper($po_prefix), PO_NUMBER_LENGTH, $data['insert_id']);}
		           else if($post_array['type'] == 'CO'){
		           $update_array = array();
		           $update_array['ub_po_co_number'] = $this->Mod_po_co->generate_number(strtoupper($co_prefix), PO_NUMBER_LENGTH, $data['insert_id']);}

		           $this->write_db->where('ub_template_po_co_id', $data['insert_id']);
				   $this->write_db->update(UB_TEMPLATE_PO_CO, $update_array);

				for($i=0; $i<count($cost_code_insert_array['cost_code_id']); $i++)
				{
				 if($cost_code_insert_array['cost_code_id'][$i] > 0)
				 {
				   $insert_cost_code_ary = array();
				   $insert_cost_code_ary['template_po_co_id'] = $data['insert_id'];
				   $insert_cost_code_ary['builder_id'] = $this->user_session['builder_id'];
			       $insert_cost_code_ary['template_id'] = $cost_code_insert_array['template_id'];
				   $insert_cost_code_ary['type'] =  $cost_code_insert_array['type'];
				   $insert_cost_code_ary['cost_code_id'] = $cost_code_insert_array['cost_code_id'][$i];
				   $insert_cost_code_ary['quantity'] = $cost_code_insert_array['quantity'][$i];
				   $insert_cost_code_ary['unit_cost'] = $cost_code_insert_array['unit_cost'][$i];
				   $insert_cost_code_ary['total'] = $cost_code_insert_array['total'][$i];
				   $insert_cost_code_ary['status'] = 'Not Released';
				   $insert_cost_code_ary['created_by'] = $this->user_session['ub_user_id'];
				   $insert_cost_code_ary['created_on'] = TODAY;
				   $insert_cost_code_ary['modified_by'] = $this->user_session['ub_user_id'];
				   $insert_cost_code_ary['modified_on'] = TODAY;
				   $this->write_db->insert(UB_TEMPLATE_PO_CO_COST_CODE, $insert_cost_code_ary);
				 }
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
	* Update update_po_co
	*
	* @method: update_po_co
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_po_co($post_array = array(),$cost_code_update_array = array())
	{
		
		if( ! empty($post_array))
		{
			
				$this->write_db->where('ub_template_po_co_id', $post_array['ub_template_po_co_id']);
				if($this->write_db->update(UB_TEMPLATE_PO_CO, $post_array))
				{
					$data['insert_id'] =  $post_array['ub_template_po_co_id'];
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';

					if(! empty($cost_code_update_array)){
					if(isset($cost_code_update_array['ub_template_po_co_cost_code_id']) && count(array_filter($cost_code_update_array['ub_template_po_co_cost_code_id'])) > 0){
						
						$this->write_db->where('template_po_co_id', $cost_code_update_array['template_po_co_id']);
						$this->write_db->where_not_in('ub_template_po_co_cost_code_id', array_filter($cost_code_update_array['ub_template_po_co_cost_code_id']));
						$this->write_db->delete(UB_TEMPLATE_PO_CO_COST_CODE);
						
					}
					else{
						$this->write_db->where('template_po_co_id', $cost_code_update_array['template_po_co_id']);
						$this->write_db->delete(UB_TEMPLATE_PO_CO_COST_CODE);

					}

					//Insert/update code


					if(isset($cost_code_update_array['cost_code_id'])){

					for($i=0; $i<count($cost_code_update_array['cost_code_id']); $i++){
						
					if(isset($cost_code_update_array['ub_template_po_co_cost_code_id'][$i]) && $cost_code_update_array['ub_template_po_co_cost_code_id'][$i] > 0){
					// Update Query

					$update_array = array();
					$update_array['ub_template_po_co_cost_code_id'] = $cost_code_update_array['ub_template_po_co_cost_code_id'][$i];
					$update_array['cost_code_id'] = $cost_code_update_array['cost_code_id'][$i];
					$update_array['quantity'] = $cost_code_update_array['quantity'][$i];
					$update_array['unit_cost'] = $cost_code_update_array['unit_cost'][$i];
					$update_array['total'] = $cost_code_update_array['total'][$i];
					$update_array['modified_by'] = $this->user_session['ub_user_id'];
					$update_array['modified_on'] = TODAY;


					$this->write_db->update(UB_TEMPLATE_PO_CO_COST_CODE, $update_array, array('ub_template_po_co_cost_code_id'=>$cost_code_update_array['ub_template_po_co_cost_code_id'][$i]));

					}else if($cost_code_update_array['cost_code_id'][$i] > 0){
					// Insert Query
					$insert_ary = array();
					//new
				    //$insert_ary['po_co_id'] = $cost_code_update_array['po_co_id'];
				    $insert_ary['template_id'] =  $cost_code_update_array['template_id'];
					$insert_ary['template_po_co_id'] =  $cost_code_update_array['template_po_co_id'];
				    $insert_ary['builder_id'] = $this->user_session['builder_id'];
				    $insert_ary['type'] =  $cost_code_update_array['type'];
				    $insert_ary['cost_code_id'] = $cost_code_update_array['cost_code_id'][$i];
				    $insert_ary['quantity'] = $cost_code_update_array['quantity'][$i];
				    $insert_ary['unit_cost'] = $cost_code_update_array['unit_cost'][$i];
				    $insert_ary['total'] = $cost_code_update_array['total'][$i];
				    $insert_ary['status'] = 'Not Released';
				    $insert_ary['created_by'] = $this->user_session['ub_user_id'];
				    $insert_ary['created_on'] = TODAY;
				    $insert_ary['modified_by'] = $this->user_session['ub_user_id'];
				    $insert_ary['modified_on'] = TODAY;

					$this->write_db->insert(UB_TEMPLATE_PO_CO_COST_CODE, $insert_ary);
					//$data['insert_id'] =  $this->write_db->insert_id();
					}
				  }

				 }
			   }
				 
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
	public function delete_po_co($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_template_po_co_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_template_po_co_id'] as $key=>$ub_template_po_co_id)
			{
				$this->write_db->delete(UB_TEMPLATE_PO_CO, array('ub_template_po_co_id' => $ub_template_po_co_id));
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Record deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Bid id is not set';
		}
		return $data;

	}
	/**
	*
	* Update Estimate
	*
	* @method: update_estimate
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function update_estimate($post_array = array())
	{
		//print_r($post_array);exit;
		if(isset($post_array['cost_code_id']) && $post_array['cost_code_id'] > 0)
		{
			$existing_estimate_info = $this->get_template_estimate(array(
							'select_fields' => array('*'),
							'where_clause' => array('cost_code_id' => $post_array['cost_code_id'],'template_id' => $post_array['template_id'])
							));
			// echo '<pre>post_array';print_r($post_array);
			//echo '<pre>existing_estimate_info';print_r($existing_estimate_info);exit;
			if(FALSE == $existing_estimate_info['status'])
			{
				// Add Estimate - PO / CO Acceptance
				$insert_ary['builder_id'] = $this->builder_id;
				$insert_ary['template_id'] = $post_array['template_id'];
				$insert_ary['cost_code_id'] = $post_array['cost_code_id'];
				$insert_ary['cost_code_name'] = $post_array['cost_code_name'];
				// $insert_ary['po_awarded_amount'] = $post_array['po_awarded_amount'];
				// $insert_ary['po_count'] = $post_array['po_count'];
				//  Add Estimate
				$estimates_list = $this->add_estimate($insert_ary);
				$data['status'] = TRUE;
				$data['message'] = 'Inserted successfully';
			}
			// else
			// {
				// Update Estimate
				
				// PO Update
				if(isset($post_array['po_awarded_amount']))
				{
					$this->write_db->set('po_awarded_amount', '(po_awarded_amount+'.$post_array['po_awarded_amount'].')', FALSE);
				}
				if(isset($post_array['po_count']))
				{
					// $this->write_db->set('po_count', '(po_count+'.$post_array['po_count'].')', FALSE);
					$this->write_db->set('po_count', '(po_count+'.$post_array['po_count'].')', FALSE);
				}
				// CO Update
				if(isset($post_array['co_awarded_amount']))
				{
					$this->write_db->set('co_awarded_amount', 'co_awarded_amount+'.$post_array['co_awarded_amount'].'', FALSE);
				}
				if(isset($post_array['co_count']))
				{
					$this->write_db->set('co_count', 'co_count+'.$post_array['co_count'].'', FALSE);
				}
				
				// Pay app requested by builder
				if(isset($post_array['bill_to_client_to_date']))
				{
					$this->write_db->set('bill_to_client_to_date', 'bill_to_client_to_date+'.$post_array['bill_to_client_to_date'].'', FALSE);
				}
				
				// Pay app paid by client
				if(isset($post_array['paid_by_client_to_date']))
				{
					$this->write_db->set('paid_by_client_to_date', 'paid_by_client_to_date+'.$post_array['paid_by_client_to_date'].'', FALSE);
				}
				
				// Pay app request for PO
				if(isset($post_array['po_paid_by_client_to_date']))
				{
					$this->write_db->set('po_paid_by_client_to_date', 'po_paid_by_client_to_date+'.$post_array['po_paid_by_client_to_date'].'', FALSE);
				}
				
				// Pay app request for CO
				if(isset($post_array['co_paid_by_client_to_date']))
				{
					$this->write_db->set('co_paid_by_client_to_date', 'co_paid_by_client_to_date+'.$post_array['co_paid_by_client_to_date'].'', FALSE);
				}
				
				// Invoiced by sub to date
				if(isset($post_array['invoiced_by_sub_to_date']))
				{
					$this->write_db->set('invoiced_by_sub_to_date', 'invoiced_by_sub_to_date+'.$post_array['invoiced_by_sub_to_date'].'', FALSE);
				}
				
				// Amount paid to sub to date
				if(isset($post_array['amount_paid_to_sub']))
				{
					$this->write_db->set('amount_paid_to_sub', 'amount_paid_to_sub+'.$post_array['amount_paid_to_sub'].'', FALSE);
				}
				
				// Update new data
				$other_update_ary = array();
				if(isset($post_array['ub_template_estimate_id']) && $post_array['ub_template_estimate_id'] > 0)
				{
					$other_update_ary['quantity'] = $post_array['quantity'];
					$other_update_ary['unit_cost'] = $post_array['unit_cost'];
					$other_update_ary['budget_amount'] = $post_array['budget_amount'];
					$other_update_ary['overhead_cost'] = $post_array['overhead_cost'];
				}
				$other_update_ary['modified_by'] = $this->user_session['ub_user_id'];
				$other_update_ary['modified_on'] = TODAY;
				$where_array = array('cost_code_id' => $post_array['cost_code_id'], 'template_id' => $post_array['template_id']);
				// Where condition
				$this->write_db->where($where_array);
				if($this->write_db->update(UB_TEMPLATE_ESTIMATE, $other_update_ary))
				{
					//echo "<Br>Update estimate : ".$this->write_db->last_query();exit;
					
					// Revised contract update
					// revised_contract = po_awarded_amount + co_awarded_amount
					$this->write_db->set('revised_contract', 'po_awarded_amount + co_awarded_amount', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>revised_contract :".$this->write_db->last_query();
					
					// Estimated profit update
					// Indirect -> estimated_profit_amount = (budget_amount - (po_awarded_amount + co_awarded_amount + overhead_cost))
					// Direct -> estimated_profit_amount =  (budget_amount - (revised_contract+overhead_cost))
					$this->write_db->set('estimated_profit_amount', 'budget_amount - (po_awarded_amount + co_awarded_amount + overhead_cost)', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br> estimated_profit_amount :".$this->write_db->last_query();
					
					// Pay app unpaid
					// unpaid_client_billing = bill_to_client_to_date - paid_by_client_to_date
					$this->write_db->set('unpaid_client_billing', 'bill_to_client_to_date - paid_by_client_to_date', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>unpaid_client_billing :".$this->write_db->last_query();
					
					// Balance to bill
					// balance_to_bill_client = (budget_amount + co_awarded_amount) - bill_to_client_to_date
					$this->write_db->set('balance_to_bill_client', '(budget_amount + co_awarded_amount) - bill_to_client_to_date', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>balance_to_bill_client : ".$this->write_db->last_query();
					
					// Balance to be invoiced by sub
					// balance_to_be_invoiced_by_sub = revised_contract - invoiced_by_sub_to_date
					$this->write_db->set('balance_to_be_invoiced_by_sub', 'revised_contract - invoiced_by_sub_to_date', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>balance_to_be_invoiced_by_sub :".$this->write_db->last_query();
					
					// Balance amount to be given to sub
					// total_balance_owed_to_sub = revised_contract - amount_paid_to_sub
					$this->write_db->set('total_balance_owed_to_sub', 'revised_contract - amount_paid_to_sub', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>total_balance_owed_to_sub :".$this->write_db->last_query();
					
					// Total Cost spent
					// total_cost = revised_contract + overhead_cost
					$this->write_db->set('total_cost', 'revised_contract + overhead_cost', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>total_cost :".$this->write_db->last_query();
					
					// Total Profit to date
					// profit_to_date = bill_to_client_to_date - (amount_paid_to_sub + overhead_cost)
					$this->write_db->set('profit_to_date', 'bill_to_client_to_date - (amount_paid_to_sub + overhead_cost)', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>profit_to_date : ".$this->write_db->last_query();
					
					// Over all profit
					// overall_profit = bill_to_client_to_date - total_cost
					$this->write_db->set('overall_profit', 'bill_to_client_to_date - total_cost', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_TEMPLATE_ESTIMATE);
					// echo "<Br>overall_profit : ".$this->write_db->last_query();
					
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
				}
			// }
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty / cost code is not defined';
		}
		return $data;
	}
	/**
	*
	* Add Estimate
	*
	* @method: add_estimate
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function add_estimate($post_array = array())
	{
		//print_r($post_array);exit;
		if( ! empty($post_array))
		{
			$post_array['created_by'] = $this->user_session['ub_user_id'];
			$post_array['created_on'] = TODAY;
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			// echo '<pre>';print_r($post_array);exit;
			
			if($this->write_db->insert(UB_TEMPLATE_ESTIMATE, $post_array))
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
	* Add templates
	*
	* @method: add_templates
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_templates($post_array = array())
	{
		if( ! empty($post_array))
		{

			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			
					if($this->write_db->insert(UB_TEMPLATE, $post_array))
					{
						//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
						/* Notification code was added by chandru 01-06-2015 */
						
						$data['insert_id'] = $this->write_db->insert_id();
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
	*
	* Update TEMPLATE
	*
	* @method: update_template
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_template($post_array = array())
	{
		if( ! empty($post_array))
		{
			
				 //print_r($post_array);exit;
				$this->write_db->where('ub_template_id', $post_array['ub_template_id']);
				if($this->write_db->update(UB_TEMPLATE, $post_array))
				{
					$data['insert_id'] =  $post_array['ub_template_id'];
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
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
	* Delete template
	*
	* @method: delete_template
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_template($delete_array)
	{
		if(isset($delete_array['ub_template_id']))
		{
			foreach($delete_array['ub_template_id'] as $key=>$ub_template_id)
			{
				$this->write_db->delete(UB_TEMPLATE, array('ub_template_id' => $ub_template_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Template(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Template id is not set';
		}
		return $data;
	}
	/**
	*
	* Delete Estimate
	*
	* @method: delete_estimate
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function delete_estimate($delete_array = array())
	{	
		if(isset($delete_array['ub_template_estimate_id']) && $delete_array['ub_template_estimate_id'] > 0)
		{
			$this->write_db->delete(UB_TEMPLATE_ESTIMATE, array('ub_template_estimate_id' => $delete_array['ub_template_estimate_id']));
			$data['status'] = TRUE;
			$data['message'] = 'Estimate deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Estimate id is not set';
		}
		return $data;
	}
	/**
	*
	* update_template_schedule_predecessor_parent_id
	*
	* @method: update_template_schedule_predecessor_parent_id
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function update_template_schedule_predecessor_parent_id($post_array = array())
	{	
		$template_pre_res = $this->read_db->query('SELECT * FROM ub_template_schedule_predecessor_info WHERE project_id = '.$post_array['project_id'].' AND template_id = '.$post_array['template_id']);
		$template_pre_data['aaData'] = array();
		
		if($template_pre_res->num_rows() > 0)
		{
			$template_pre_data['aaData'] = $template_pre_res->result_array();
		}	
		$data = array();
		if(isset($template_pre_data['aaData']) && !empty($template_pre_data['aaData']))
		{
			foreach($template_pre_data['aaData'] as $key => $value)
			{
				
				$template_res = $this->read_db->query('SELECT ub_template_schedule_id FROM ub_template_schedule WHERE schedule_id = '.$value['parent_id'].' AND template_id = '.$post_array['template_id']);
				$template_data['aaData'] = array();
				if($template_res->num_rows() > 0)
				{
					$template_data['aaData'] = $template_res->result_array();
				}	
				
				$res = $this->write_db->query('UPDATE ub_template_schedule_predecessor_info set parent_id = '.$template_data['aaData'][0]['ub_template_schedule_id'].' WHERE parent_id = '.$value['parent_id'].' AND template_id = '.$post_array['template_id']);
				if($res)
				{
					$data['status'] = TRUE;
					$data['message'] = 'Data updated successfully';
					
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'No record found';
				}
			}
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
	* update_schedule_predecessor_parent_id
	*
	* @method: update_schedule_predecessor_parent_id
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function update_schedule_predecessor_parent_id($post_array = array())
	{	
		$template_pre_res = $this->read_db->query('SELECT * FROM ub_schedule_predecessor_info WHERE project_id = '.$post_array['project_id'].' AND import_id = '."'".$post_array['import_id']."'");
		$template_pre_data['aaData'] = array();
		// echo $this->read_db->last_query();exit;
		/* if(!$template_pre_res)
        {
            echo $this->read_db->_error_message();
            echo "<br>".$this->read_db->_error_number();exit;
        }  */
		if($template_pre_res->num_rows() > 0)
		{
			$template_pre_data['aaData'] = $template_pre_res->result_array();
		}	
		$data = array();
		if(isset($template_pre_data['aaData']) && !empty($template_pre_data['aaData']))
		{
			foreach($template_pre_data['aaData'] as $key => $value)
			{
				
				$template_res = $this->read_db->query('SELECT ub_schedule_id FROM ub_schedule WHERE template_schedule_id = '.$value['parent_id'].' AND import_id = '."'".$post_array['import_id']."'");
				// echo $this->read_db->last_query();exit;
				$template_data['aaData'] = array();
				if($template_res->num_rows() > 0)
				{
					$template_data['aaData'] = $template_res->result_array();
				}	
				// echo '<pre>';print_r($template_data);exit;
				$res = $this->write_db->query('UPDATE ub_schedule_predecessor_info set parent_id = '.$template_data['aaData'][0]['ub_schedule_id'].' WHERE parent_id = '.$value['parent_id'].' AND import_id = '."'".$post_array['import_id']."'");
	
				if($res)
				{
					$data['status'] = TRUE;
					$data['message'] = 'Data updated successfully';
					
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'No record found';
				}
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}	
		return $data;
	} 
}
/* End of file mod_template.php */
/* Location: ./application/models/mod_template.php */