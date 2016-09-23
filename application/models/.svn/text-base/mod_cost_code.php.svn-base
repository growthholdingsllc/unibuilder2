<?php
/** 
 * Cost Code Model
 * 
 * @package: Cost Code Model
 * @subpackage: Cost Code Model 
 * @category: Cost Code
 * @author: Baskar
 * @createdon(DD-MM-YYYY): 28-04-2015
*/
class Mod_cost_code extends UNI_Model
{
	/**
	 * @property: $role_id
	 * @access: public
	 */

	public $role_id;
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->role_id = 0;
		parent::__construct();
	} 
	
	/**
	* Get Cost Code information for dropdown
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	*
	* @method: get_cost_code_dropdown
	* @access: public 
	* @param: args
	* @return: array
	* Not used - done a common code in UNI_Model to get the options from database
	 * 
	 * @param string $args
	 * @return type
	 */
	public function get_cost_code_dropdown($args=array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from('UB_COST_CODE AS COSTCODE');
		
		if(! isset($args['where_clause'])) {$args['where_clause'] = array ('status'=>'Active');}
		$this->read_db->where($args['where_clause']);
		if(isset($args['order_clause']) && $args['order_clause'] !='') {$this->read_db->order_by($args['order_clause']);}
		
		$res = $this->read_db->get();
		$data = $res->result_array();
		print_r($data);
		return $data;
		//return $this->build_ci_dropdown_array($data,'ub_cost_code_id', 'cost_code_info');
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
	public function save_costcode($post_array = array())
	{
		//print_r($post_array);
		if( ! empty($post_array))
		{
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			if(isset($post_array['ub_cost_variance_code_id']) && $post_array['ub_cost_variance_code_id'] > 0)
			{
				//update cost code
				$where = "ub_cost_variance_code_id = ".$post_array['ub_cost_variance_code_id'];
				if($this->write_db->update(UB_COST_CODE, $post_array, $where))
				{
					$data['insert_id'] =  $post_array['ub_cost_variance_code_id'];
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Failed to update the data';
				}
			}
			else	//Insert new cost code
			{
				$post_array['created_by'] = $this->user_session['ub_user_id'];
				$post_array['created_on'] = TODAY;
				if($this->write_db->insert(UB_COST_CODE, $post_array))
				{
					$data['insert_id'] =  $this->write_db->insert_id();
					$data['status'] = TRUE;
					$data['message'] = 'Cost code inserted successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Failed to insert the data';
				}
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
	}
	 
}
/* End of file mod_bidphp */
/* Location: ./application/models/mod_bid.php */