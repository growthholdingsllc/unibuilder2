<?php

/**
 * Plan Class
 *
 * @package:	Plan
 * @subpackage: Plan
 * @category:	Plan
 * @author:		Devansh
 * @createdon(DD-MM-YYYY): 09-05-2015
*/

class Mod_plan extends UNI_Model
{
	/**
	 * @property:	$plan_id
	 * @access:		public
	 */
	public $plan_id;

	/**
	 * @property: $user_id
	 * @access: public
	 */
	public $user_id;


	/**
	 * @constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
/**
	 * Get plan information
	 *
	 * $args['select_fields']	- can get all or specific filed information by giving values for the key "select_fields"
	 * $args['join']['builder']	- join builder table with plan table
	 * $args['where_clause']	- can pass where conditions as an array
	 * $args['order_clause']	- sorting option
	 * $args['pagination']		- pagination option
	 *
	 * @method:	get_plan_details
	 * @access:	public
	 * @param:	args
	 * @return:	array
	 */
	public function get_plan_details($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',', $args['select_fields']) : '*', FALSE);
		$this->read_db->from(UB_PLAN . ' AS PLAN');

		// Join tables
		/* if (isset($args['join']) && 'yes' === strtolower($args['join']['builder'])) {
			$this->read_db->join(UB_BUILDER . ' AS BUILDERDETAILS', 'PLANDETAILS.ub_plan_id = BUILDERDETAILS.plan_id', 'left'); // UB_USER is the table name defined in constant file
		} */
		
		//added by pranab
        if (isset($args['join']['userplan']) && 'yes' === strtolower($args['join']['userplan'])) {
			$this->read_db->join(UB_USER_PLAN . ' AS USER_PLAN', 'PLAN.ub_plan_id = USER_PLAN.plan_id', 'left');
		}
		
		// Where condition
		if (isset($args['where_clause'])) {
			$this->read_db->where($args['where_clause']);
		}

		// Order by condition
		if (isset($args['order_clause']) && $args['order_clause'] != '') {
			$this->read_db->order_by($args['order_clause']);
		}

		// Pagination
		if (isset($args['pagination']) && !empty($args['pagination'])) {
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}

		$res	=	$this->read_db->get();
		$data	=	array();

		if ($res->num_rows() > 0) {
			$data['aaData']		=	$res->result_array();
			$data['status']		=	TRUE;
			$data['message']	=	'Data retrieved successfully';
		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'No record found';
		}
		// echo $this->read_db->last_query();
		return $data;
	}

	/**
	 *
	 * Add plan
	 *
	 * @method:	add_plan
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_plan($post_array = array())
	{
		if (!empty($post_array)) {
			//unset($post_array['ub_plan_id']);
				if ($this->write_db->insert(UB_PLAN, $post_array)) 
				{
					// echo $this->write_db->last_query();
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Plan(s) inserted successfully';
				} 
				else 
				{
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the Plan(s)';
				}
			
		} 
		else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
	}


	/**
	 *
	 * Update plan
	 *
	 * @method:	update_plan
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	public function update_plan($post_array = array())
	{
		if (!empty($post_array)) {
			$this->ub_plan_id = isset($post_array['ub_plan_id']) ? $post_array['ub_plan_id'] : $this->ub_plan_id;
			if ($this->ub_plan_id > 0) 
			{

				$this->write_db->where('ub_plan_id', $this->ub_plan_id);
				if ($this->write_db->update(UB_PLAN, $post_array)) {
					$data['insert_id'] = $this->ub_plan_id;
					$data['status']    = TRUE;
					$data['message']   = 'Updated successfully';
				} else {
					$data['status']  = FALSE;
					$data['message'] = 'Update failed';
				}
			}

		} else
		{
		
			$data['status']  = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}


	/**
	*
	* Delete Plans
	*
	* @method: delete_plans
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_plans($delete_array)
	{
		if(isset($delete_array['ub_plan_id']))
		{
			foreach($delete_array['ub_plan_id'] as $key=>$ub_plan_id)
			{
				$this->write_db->delete(UB_PLAN, array('ub_plan_id' => $ub_plan_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Plan(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Plan id is not set';
		}
		return $data;
	}
	/**
	 *
	 * Add user plan
	 *
	 * @method:	add_user_plan
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_user_plan($post_array = array())
	{
		if (!empty($post_array)) 
		{

			if ($this->write_db->insert(UB_USER_PLAN, $post_array)) 
			{
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
				$data['insert_id']	=	$this->write_db->insert_id();
				$data['status']		=	TRUE;
				$data['message']	=	'Plan(s) inserted successfully';
			} else 
			{
				$data['status']		=	FALSE;
				$data['message']	=	'Insert Failed: Failed to insert the Plan(s)';
			}
		} else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
	}
	
	/**
	 *
	 * get user plan
	 *
	 * @method:	get_user_plan
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 * @created by:	satheesh kumar
	 */
	public function get_user_plan($args = array())
	{
	
		//echo '<pre>';print_r($args);exit;
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_USER_PLAN.' AS USER_PLAN');	//UB_USER_PLAN is the table name defined in constant file
		// join condition
		if (isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder'])) {
			$this->read_db->join(UB_BUILDER . ' AS BUILDER', 'USER_PLAN.builder_id = BUILDER.ub_builder_id', 'left');
		}
		if (isset($args['join']['plan']) && 'yes' === strtolower($args['join']['plan'])) {
			$this->read_db->join(UB_PLAN . ' AS PLAN', 'USER_PLAN.plan_id = PLAN.ub_plan_id', 'left');
		} 
		if (isset($args['join']['oldplan']) && 'yes' === strtolower($args['join']['oldplan'])) {
			$this->read_db->join(UB_USER_PLAN . ' AS OLDPLAN', 'BUILDER.ub_builder_id = OLDPLAN.builder_id AND USER_PLAN.plan_id != OLDPLAN.plan_id AND USER_PLAN.`ub_user_plan_id` != OLDPLAN.ub_user_plan_id AND OLDPLAN.status = "Inactive"', 'left');
		} 
		if (isset($args['join']['planname']) && 'yes' === strtolower($args['join']['planname'])) {
			$this->read_db->join(UB_PLAN . ' AS OLD_PLAN_NAME', 'OLDPLAN.plan_id = OLD_PLAN_NAME.ub_plan_id', 'left');
		}
		if (isset($args['join']['contract']) && 'yes' === strtolower($args['join']['contract'])) {
			$this->read_db->join(UB_BUILDER_CONTRACT . ' AS UB_BUILDER_CONTRACT', 'USER_PLAN.ub_user_plan_id = UB_BUILDER_CONTRACT.user_plan_id', 'left');
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
		return $data;
	}
	
	/**
	 *
	 * Update user plan
	 *
	 * @method:	update_user_plan
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 * @created by:	satheesh kumar
	 */
	public function update_user_plan($post_array = array())
	{
		
		if (!empty($post_array)) 
		{
			$this->ub_user_plan_id = isset($post_array['ub_user_plan_id']) ? $post_array['ub_user_plan_id'] : 0;
			if ($this->ub_user_plan_id > 0) 
			{
				$user_plan_array['status'] = 'Inactive';
				$user_plan_array['modified_by'] = $this->user_id;
				$user_plan_array['modified_on'] = TODAY;
				$this->write_db->where('ub_user_plan_id', $this->ub_user_plan_id);
				if ($this->write_db->update(UB_USER_PLAN, $user_plan_array))
				{
					$data['status']    = TRUE;
					$data['message']   = 'Updated successfully';
				}
				else 
				{
					$data['status']  = FALSE;
					$data['message'] = 'Update failed';
				}
			}
		} 
		else 
		{
			$data['status']  = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	
	/* Below function was added by chandru for getting contract information */
	public function get_plan_and_contractdetails($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',', $args['select_fields']) : '*', FALSE);
		$this->read_db->from(UB_BUILDER_CONTRACT . ' AS UB_BUILDER_CONTRACT');

         if (isset($args['join']['contract']) && 'yes' === strtolower($args['join']['contract'])) {
			$this->read_db->join(UB_PLAN . ' AS PLAN', 'UB_BUILDER_CONTRACT.user_plan_id = PLAN.ub_plan_id', 'left');
		} 
		// Where condition
		if (isset($args['where_clause'])) {
			$this->read_db->where($args['where_clause']);
		}

		// Order by condition
		if (isset($args['order_clause']) && $args['order_clause'] != '') {
			$this->read_db->order_by($args['order_clause']);
		}

		// Pagination
		if (isset($args['pagination']) && !empty($args['pagination'])) {
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}

		$res	=	$this->read_db->get();
		$data	=	array();
		if ($res->num_rows() > 0) {
			$data['aaData']		=	$res->result_array();
			$data['status']		=	TRUE;
			$data['message']	=	'Data retrieved successfully';
		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'No record found';
		}
		// echo $this->read_db->last_query();
		return $data;
	}
	

}

/* End of file mod_plan.php */
/* Location: ./application/models/mod_plan.php */