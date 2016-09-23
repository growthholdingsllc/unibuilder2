<?php

/**
 * Builder Contract Class
 *
 * @package:	Contract
 * @subpackage: Contract
 * @category:	Contract
 * @author:		Devansh
 * @createdon(DD-MM-YYYY): 07-08-2015
*/

class Mod_builder_contract extends UNI_Model
{
	/**
	 * @property:	$builder_contract_id
	 * @access:		public
	 */
	public $builder_contract_id;

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
	 * Get builder contract information
	 *
	 * @method:	get_plan_details
	 * @access:	public
	 * @param:	args
	 * @return:	array
	 */
	public function get_builder_contract_details($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',', $args['select_fields']) : '*', FALSE);
		$this->read_db->from(UB_BUILDER_CONTRACT . ' AS BUILDER_CONTRACT');

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
	 * Add Builder Contract
	 *
	 * @method:	add_builder_contract
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_builder_contract($post_array = array())
	{
		if (!empty($post_array)) {
			//unset($post_array['ub_builder_contract_id']);
				if ($this->write_db->insert(UB_BUILDER_CONTRACT, $post_array)) 
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
	 * Update Builder Contract
	 *
	 * @method:	update_builder_contract
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	public function update_builder_contract($post_array = array())
	{
		if (!empty($post_array)) {
			$this->ub_builder_contract_id = isset($post_array['ub_builder_contract_id']) ? $post_array['ub_builder_contract_id'] : $this->ub_builder_contract_id;
			if ($this->ub_builder_contract_id > 0) 
			{

				$this->write_db->where('ub_builder_contract_id', $this->ub_builder_contract_id);
				if ($this->write_db->update(UB_BUILDER_CONTRACT, $post_array)) {
					$data['insert_id'] = $this->ub_builder_contract_id;
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
	* Delete Builder Contract
	*
	* @method: delete_builder_contract
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_builder_contract($delete_array)
	{
		if(isset($delete_array['ub_builder_contract_id']))
		{
			foreach($delete_array['ub_builder_contract_id'] as $key=>$ub_builder_contract_id)
			{
				$this->write_db->delete(UB_BUILDER_CONTRACT, array('ub_builder_contract_id' => $ub_builder_contract_id));
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
	* Generate number wuth time
	*
	* @method: generate_number
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function generate_number_time($type, $pad_length, $pad_id)
	{
		$number = str_pad($pad_id, $pad_length,'0',STR_PAD_LEFT);
		return $type.'-'.date('mdY').'-'.$number;
	}
	
	/**
	 *
	 * Update Builder Contract while fetching time. Update with out ub_builder_contract_id
	 *
	 * @method:	update_builder_contract
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 * @created by:	chandru
	 */
	public function update_builder_contract_table($post_array = array())
	{
		if (!empty($post_array)) {
			$this->ub_builder_subscription_id = isset($post_array['subscription_id']) ? $post_array['subscription_id'] : $this->ub_builder_subscription_id;
			if ($this->ub_builder_subscription_id > 0) 
			{

				$this->write_db->where('subscription_id', $this->ub_builder_subscription_id);
				if ($this->write_db->update(UB_BUILDER_CONTRACT, $post_array)) {
					$data['insert_id'] = $this->ub_builder_subscription_id;
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
}

/* End of file mod_plan.php */
/* Location: ./application/models/mod_plan.php */