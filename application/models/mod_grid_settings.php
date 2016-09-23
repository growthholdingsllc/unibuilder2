<?php
/** 
 * Grid Settings Class
 * 
 * @package: General definition
 * @subpackage:  
 * @category: Core
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 02-04-2015 
*/
class Mod_grid_settings extends UNI_Model{
	/**
	 * @property: $classification
	 * @access: public
	 */
	public $classification = '';
	public $grid_settings_id;
	/**
	 * @constructor
	 */
    public function __construct() 
	{
		$this->grid_settings_id = 0;
		parent::__construct();
    }
	/** 
	* Get grid settings
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_grid_settings
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_grid_settings($args = array())
	{
		if(!empty($args))
		{
			$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
			$this->read_db->from(UB_GRID_SETTINGS.' AS GRID_SETTINGS');	//GRID_SETTINGS is the table name defined in constant file
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
			//echo $this->read_db->last_query();exit;
			$data = array();
			if($res->num_rows() > 0)
			{
				$data['aaData'] = $res->result_array();
				if(isset($args['get']) && $args['get']='select_fields')
				{
					$select_fields_array = array();
					$select_fields_array['db_res'] = $res;
					if(isset($args['primary_key']))
					{
						$select_fields_array['primary_key']=$args['primary_key'];
					}
					$select_data = $this->get_grid_settings_select_fields($select_fields_array);
					if(TRUE === $select_data['status'])
					{
						return $select_data;
					}
					else
					{
						return $select_data;
					}	
				}
				$data['status'] = TRUE;
				$data['message'] = 'Data retrieved successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'No record found';
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
	* Get grid settings select fields
	*
	* $arg - grid setting db resource
	*
	* @method: get_grid_settings_select_fields
	* @access: public 
	* @param: args
	* @return: data array
	*/
	public function get_grid_settings_select_fields($res_array=array())
	{
		if(!empty($res_array))
		{
			$data = array();
			$res = $res_array['db_res'];
			if($res->num_rows() > 0)
			{
				
				$row = $res->row_array();
				// Un Serialize display field data 
				$serialized_data = $row['display_fields'];
				$remove_single_quote = str_replace("'", '', $serialized_data);
				$select_fields_unserialized_data = unserialize($remove_single_quote);
				$select_fields = array();
				$datatable_header = array();
				$fieldname_array = array();
				foreach($select_fields_unserialized_data as $select_data)
				{
					$select_fields[] = $select_data['db_field_name'];
					$datatable_header[] = $select_data['display_column_name'];
					$fieldname_array[] = $select_data['datatable_column'];
				}
				// Un Serialize join data display_field_joins
				$serialized_data = $row['display_field_joins'];
				$remove_single_quote = str_replace("'", '', $serialized_data);
				$join_field_unserialized_data = unserialize($remove_single_quote);
				$join_clause = array();
				foreach($join_field_unserialized_data as $key => $join_data)
				{
					$join_clause[$key] = 'Yes';
				}
				if(isset($res_array['primary_key']))
				{
					array_unshift($select_fields,$res_array['primary_key']);
				}	
				$data['select_fields'] = $select_fields;
				$data['header_fields'] = $datatable_header;
				$data['field_names'] = $fieldname_array;
				$data['join_clause'] = $join_clause;
				$data['status'] = TRUE;
				$data['message'] = 'Data retrieved successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'No record found';
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
	* Add grid settings
	*
	* @method: add_grid_settings
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_grid_settings($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
				$args = array('select_fields' => array('ub_grid_settings_id', 'module_name','is_default' ,'list_view_name', 'display_fields', 'display_field_joins'), 
				'where_clause' => array('builder_id' => $this->builder_id, 'user_id' => $this->user_session['ub_user_id'],'list_view_name'=>$post_array['list_view_name']));
				$result  = $this->Mod_grid_settings->get_grid_settings($args);

				if(FALSE === $result['status'])
				{
					if('Yes' === $post_array['is_default'])
					{
						$update_default_no = array('is_default'=>'No'); 
						$where_clause = array('is_default' => 'Yes', 'module_name'=>$post_array['module_name'],'builder_id' => $this->builder_id, 'user_id' => $this->user_session['ub_user_id']);
						$this->db->where($where_clause);
						$this->db->update(UB_GRID_SETTINGS,$update_default_no);
					}
					// Failed to retrieve the same grid settings
					$post_array['user_id'] = $this->user_session['ub_user_id'];
					$post_array['builder_id'] = $this->builder_id;
					$post_array['created_by'] = $this->user_session['ub_user_id'];
					$post_array['created_on'] = TODAY;
					$post_array['modified_by'] = $this->user_session['ub_user_id'];
					$post_array['modified_on'] = TODAY;
					if($this->write_db->insert(UB_GRID_SETTINGS, $post_array))
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
				else if(TRUE === $result['status'])
				{
					// Grid setting already exists, but status is different
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Record already exists';
				}
				else
				{
					// Role is already exists
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Record already exists';
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
		return $data;
	}
	/**
	*
	* Update grid settings
	*
	* @method: update_grid_settings
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_grid_settings($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;

			$this->grid_settings_id = isset($post_array['ub_grid_settings_id'])?$post_array['ub_grid_settings_id']:$this->grid_settings_id;
			if($this->grid_settings_id > 0)
			{
				$args = array('select_fields' => array('ub_grid_settings_id','list_view_name'), 
				'where_clause' => array('module_name'=>$post_array['module_name'],'builder_id' => $this->builder_id, 'user_id' => $this->user_session['ub_user_id'],'list_view_name'=>$post_array['list_view_name'], 'list_view_name' => $post_array['list_view_name'], 'ub_grid_settings_id != ' => $this->grid_settings_id));
				$result  = $this->Mod_grid_settings->get_grid_settings($args);
				if(FALSE === $result['status'])
				{	
					if('Yes' === $post_array['is_default'])
					{
						$update_default_no = array('is_default'=>'No'); 
						$where_clause = array('is_default' => 'Yes', 'module_name'=>$post_array['module_name'],'builder_id' => $this->builder_id, 'user_id' => $this->user_session['ub_user_id']);
						$this->db->where($where_clause);
						$this->db->update(UB_GRID_SETTINGS,$update_default_no);
					}
					
					$post_array['modified_by'] = $this->user_session['ub_user_id'];
					$post_array['modified_on'] = TODAY;
					$this->write_db->where('ub_grid_settings_id', $this->grid_settings_id);
					if($this->write_db->update(UB_GRID_SETTINGS, $post_array))
					{
						$data['insert_id'] =  $this->grid_settings_id;
						$data['status'] = TRUE;
						$data['message'] = 'Update successfully';
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
					$data['message'] = 'Update Failed: List view name already exist.';
				}
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Grid settings id should have value / it should be greater than 0';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
}
/* End of file mod_grid_settings.php */
/* Location: ./application/models/mod_grid_settings.php */