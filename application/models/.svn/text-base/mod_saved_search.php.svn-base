<?php
/** 
 * Saved Search
 * 
 * @package: Saved Search
 * @subpackage:  
 * @category: Core
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 01-04-2015 
*/
class Mod_saved_search extends UNI_Model{
	/**
	 * @constructor
	 */
    public function __construct() 
	{
		parent::__construct();
    }
	/** 
	* Get saved search
	* 
	* @method: get_saved_search 
	* @access: public 
	* @params: $args['classification'] - General value classification
	* @params: $args['where_clause'] - can pass where conditions as an array
	* @return: array 
	*/
	public function get_saved_search($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SAVED_SEARCH.' AS SAVED_SEARCH');	//UB_SAVED_SEARCH is the table name defined in constant file
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
		return $data;
	}
	/** 
	* Update saved search
	* 
	* @method: update_saved_search 
	* @access: public 
	* @params: $post array
	* @return: array 
	*/
	public function update_saved_search($post_array)
	{
		if(isset($post_array['ub_saved_search_id']) && $post_array['ub_saved_search_id'] > 0)
		{
			// Update saved search
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			$this->write_db->where('ub_saved_search_id', $post_array['ub_saved_search_id']);
			if($this->write_db->update(UB_SAVED_SEARCH, $post_array))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Update successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Update failed';
			}
			return $data;
		}
		else
		{
			// Check saved search exist / not
			$where_array = array( 'builder_id' => $this->user_session['builder_id'],
							'user_id' => $this->user_session['ub_user_id'],
							'module_name' => $this->module
			);
			$result_data = $this->get_saved_search(array(
												'select_fields' => array('ub_saved_search_id'),
												'where_clause' => $where_array
												));
			if(FALSE === $result_data['status'])
			{
				$insert_array = array();
				// Insert saved search
				$insert_array['builder_id'] = $this->user_session['builder_id'];
				$insert_array['user_id'] = $this->user_session['ub_user_id'];
				$insert_array['module_name'] = $this->module;
				$insert_array['search_params'] = $post_array['search_params'];
				$insert_array['created_by'] = $this->user_session['ub_user_id'];
				$insert_array['created_on'] = TODAY;
				$insert_array['modified_by'] = $this->user_session['ub_user_id'];
				$insert_array['modified_on'] = TODAY;
				if($this->write_db->insert(UB_SAVED_SEARCH, $insert_array))
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
				$data['message'] = 'We have already saved a search for this module to the respective user';
			}
			return $data;
		}
	}
}
/* End of file mod_saved_search.php */
/* Location: ./application/models/mod_saved_search.php */