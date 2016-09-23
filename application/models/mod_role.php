<?php
/** 
 * Role Model
 * 
 * @package: Role Model
 * @subpackage: Role Model 
 * @category: Role
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 14-03-2015
*/
class Mod_role extends UNI_Model
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
	* Get roles information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_roles
	* @access: public 
	* @param: args
	* @return: array
	*/
	 public function get_roles($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_ROLE.' AS ROLE');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_BUILDER.' AS BUILDER','ROLE.builder_id = BUILDER.ub_builder_id','left');//UB_BUILDER is the table name defined in constant file
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
		return $data;
	} 
	
	/** 
	* Get role access information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_roles_access
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_roles_access($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_ACCESS_LEVEL_DETAILS.' AS ACCESSLEVELDETAILS');
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['menu_access_level_details']))
		{
			$this->read_db->join(UB_MENU.' AS MENU','ACCESSLEVELDETAILS.menu_id = MENU.ub_menu_id','left');
			$this->read_db->join(UB_ACCESS_LEVEL.' AS ACCESSLEVEL','ACCESSLEVELDETAILS.menu_id = ACCESSLEVEL.menu_id','left');
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Group by condition
		if(isset($args['groupby_clause']) && $args['groupby_clause'] !='')
		{
			$this->read_db->group_by($args['groupby_clause']);
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
			$data['accessdetails'] = $res->result_array();
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
	
	public function get_menus($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_MENU.' AS MENU');
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['menu_access_level']))
		{
			$this->read_db->join(UB_ACCESS_LEVEL.' AS ACCESSLEVEL','MENU.ub_menu_id = ACCESSLEVEL.menu_id','left');
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Group by condition
		if(isset($args['groupby_clause']) && $args['groupby_clause'] !='')
		{
			$this->read_db->group_by($args['groupby_clause']);
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
			$data['menulist'] = $res->result_array();
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
	* Add project
	*
	* @method: add_access_details
	* @access: public 
	* @param: post data
	* @return: no return id
	*/
	
	public function add_access_details($post_array = array())
	{
		$post_array['created_by'] = $this->user_session['ub_user_id'];
		$post_array['created_on'] = TODAY;
		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		
		// Query to insert data in ub_project table
		if($this->write_db->insert(UB_ACCESS_LEVEL_DETAILS, $post_array))
		{
			$data['status'] = TRUE;
			$data['message'] = 'Data inserted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Failed to insert assign users data';
		}
		return $data;
	}
	
	/**
	*
	* Add role
	*
	* @method: add_role
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_role($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
				//$result = $this->validate_duplicate_roles($post_array);
				$result = $this->get_roles(array(
								'select_fields' => array('ROLE.ub_role_id', 'ROLE.role_name', 'ROLE.role_active'),
								'where_clause' => array('ROLE.builder_id' => isset($post_array['builder_id'])?$post_array['builder_id']:$this->builder_id, 'ROLE.role_name' => $post_array['role_name'])
								));		
				if(FALSE === $result['status'])
				{
					// Failed to retrieve the same role
					$post_array['builder_id'] = $this->builder_id;
					$post_array['created_by'] = $this->user_session['ub_user_id'];
					$post_array['created_on'] = TODAY;
					$post_array['modified_by'] = $this->user_session['ub_user_id'];
					$post_array['modified_on'] = TODAY;
					if($this->write_db->insert(UB_ROLE, $post_array))
					{
						$data['ub_role_id'] =  $this->write_db->insert_id();
						$data['status'] = TRUE;
						$data['message'] = 'Data inserted successfully';
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'Insert Failed: Failed to insert the data';
					}
				}
				else if(TRUE === $result['status'] && $result['aaData'][0]['role_active'] != $post_array['role_active'])
				{
					// Role is already exists, but status is different
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Record already exists, Current status of the role '.$result['aaData'][0]['role_name'].' is  '.$result['aaData'][0]['role_active'];
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
	* Update role
	*
	* @method: update_role
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_role($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->role_id = isset($post_array['ub_role_id'])?$post_array['ub_role_id']:$this->role_id;
			if($this->role_id > 0)
			{
				$result = $this->get_roles(array(
								'select_fields' => array('ROLE.ub_role_id', 'ROLE.role_name', 'ROLE.role_active'),
								'where_clause' => array('ROLE.builder_id' => isset($post_array['builder_id'])?$post_array['builder_id']:$this->builder_id, 'ROLE.role_name' => $post_array['role_name'], 'ROLE.ub_role_id != ' => $this->role_id)
								));
				if(FALSE === $result['status'])
				{	
					$post_array['modified_by'] = $this->user_session['ub_user_id'];
					$post_array['modified_on'] = TODAY;
					$this->write_db->where('ub_role_id', $this->role_id);
					if($this->write_db->update(UB_ROLE, $post_array))
					{
						$data['ub_role_id'] = $this->role_id;
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
					$data['message'] = 'Update Failed: Role name already exist.';
				}
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Role id should have value / it should greater than 0';
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
	* Update access level details table
	*
	* @method: update_role_access
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_role_access($post_array = array())
	{
		// $this->write_db->update_batch(UB_ACCESS_LEVEL_DETAILS, $post_array, 'role_id');
		// exit;
		if( ! empty($post_array))
		{
			$this->role_id = isset($post_array['role_id'])?$post_array['role_id']:$this->role_id;
			$this->menu_id = isset($post_array['menu_id'])?$post_array['menu_id']:$this->menu_id;
			if($this->role_id > 0 && $this->menu_id > 0)
			{
				$post_array['modified_by'] = $this->user_session['ub_user_id'];
				$post_array['modified_on'] = TODAY;
				$where = array('role_id' => $this->role_id, 'menu_id' => $this->menu_id);
				if($this->write_db->update(UB_ACCESS_LEVEL_DETAILS, $post_array, $where))
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
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Role id should have value / it should greater than 0';
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
	* Delete delete_access_details
	*
	* @method: delete_access_details
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_access_details($delete_array)
	{
		if(isset($delete_array['builder_id']))
		{
			if($this->write_db->delete(UB_ACCESS_LEVEL_DETAILS, $delete_array))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Access details deleted successfully';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Builder id and role id is not set';
		}
		return $data;
	}
	
	/**
	*
	* Delete roles
	*
	* @method: delete_roles
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_roles($delete_array)
	{
		if(isset($delete_array['ub_role_id']))
		{
			foreach($delete_array['ub_role_id'] as $key=>$role_id)
			{
				$this->write_db->delete(UB_ROLE, array('ub_role_id' => $role_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Role(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Role id is not set';
		}
		return $data;
	}
	
	/**
	*
	* Getting user access details
	*
	* @method: get_user_accessdetails
	* @access: public 
	* @param: role id
	* @return: return array data
	*/
	public function get_user_accessdetails($roleid)
	{
		if(isset($roleid))
		{
			//Select the role access details
			$groupby_clause = 'ACCESSLEVEL.menu_id';
			$result_access = $this->Mod_role->get_roles_access(array(
											'select_fields' => array('MENU.menu_name','ACCESSLEVELDETAILS.menu_id',
											'CONV(ACCESSLEVELDETAILS.access_value,10,2) AS access_rights', 'GROUP_CONCAT(ACCESSLEVEL.access_name ORDER BY ACCESSLEVEL.display_order ASC SEPARATOR ", ") AS access_name'),
											'join'=> array('menu_access_level_details'=>'Yes'),
											'where_clause' => (array('ACCESSLEVELDETAILS.role_id' =>  $role_id)),
											'groupby_clause' => $groupby_clause
											));
			
			if(TRUE === $result_access['status'])
			{
				//Below loop will build array for access name and access rights
				$menu_access_list = $result_access['accessdetails'];
				for($i=0;$i<count($menu_access_list);$i++)
				{
					$access_name_array = explode(",",$menu_access_list[$i]['access_name']);
					$slice_value = count($access_name_array);
					$leading_zeros = 0;
					for($j=0;$j<count($slice_value);$j++)
					{
						$leading_zeros = $leading_zeros."0";
					}
					$access_rights = $leading_zeros.$menu_access_list[$i]['access_rights'];
					$access_rights = substr($access_rights, "-".$slice_value);
					$menu_access_list[$i]['access_name'] = $access_name_array;
					$menu_access_list[$i]['access_rights'] = str_split($access_rights);
				} 
				$data['menu_access_list'] = $menu_access_list;
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Role id is not set';
		}
		return $data;
	}
}
/* End of file mod_user.php */
/* Location: ./application/models/mod_user.php */