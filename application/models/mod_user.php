<?php
/** 
 * User Model
 * 
 * @package: User Model
 * @subpackage: User Model 
 * @category: User
 * @author: MS
 * @createdon(DD-MM-YYYY): 12-03-2015
*/
class Mod_user extends UNI_Model
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
	 * @property: $log_id
	 * @access: public
	 */

	public $ub_user_id;
    /**
	 * @constructor
	 */
	 
	public function __construct() 
	{
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['user_id'])?$this->user_session['user_id']:0;
		$this->role_id = 0;
		$this->ub_user_id = 0;
		parent::__construct();
    }
	
	/** 
	*user_check method will check for user authentication
	* 
	* @method: user_check
	* @access: public 
	* @param: post data and fields to be fetched from table
	* @return: Boolean value 
	*/
	
	public function get_users($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_USER.' AS USER');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_BUILDER.' AS BUILDER','USER.builder_id = BUILDER.ub_builder_id','left');//UB_BUILDER is the table name defined in constant file
		}
		if(isset($args['join']['project_user']) && 'yes' === strtolower($args['join']['project_user']))
		{
			$this->read_db->join(UB_PROJECT_ASSIGNED_USERS.' AS PAU','PAU.assigned_to = USER.ub_user_id','left');//UB_BUILDER is the table name defined in constant file
		}
		if(isset($args['join']['project_manager']) && 'yes' === strtolower($args['join']['project_manager']))
		{
			$this->read_db->join(UB_PROJECT.' AS PROJECT','PROJECT.project_managers = USER.ub_user_id','right');//UB_PROJECT is the table name defined in constant file
		}
		
/*
		if(isset($args['join']['role']) && 'yes' === strtolower($args['join']['role']))
		{
			$this->read_db->join(UB_ROLE.' AS ROLE','ROLE.builder_id = USER.ub_user_id','left');//UB_BUILDER is the table name defined in constant file
		}*/

		if(isset($args['join']['role']) && 'yes' === strtolower($args['join']['role']))
		{
			$this->read_db->join(UB_ROLE.' AS ROLE','ROLE.ub_role_id = USER.role_id','left');//UB_BUILDER is the table name defined in constant file
		}
		//Join added by satheesh kumar
		if(isset($args['join']['project_owner']) && 'yes' === strtolower($args['join']['project_owner']))
		{
			$this->read_db->join(UB_PROJECT.' AS PROJECT','PROJECT.owner_id = USER.ub_user_id');//UB_BUILDER is the table name defined in constant file
		}
		
		/* Below join was added by chandru */
		if(isset($args['join']['sub_contractor']) && 'yes' === strtolower($args['join']['sub_contractor']))
		{
			$this->read_db->join(UB_SUBCONTRACTOR.' AS UB_SUBCONTRACTOR','UB_SUBCONTRACTOR.user_id = USER.ub_user_id','left');//UB_BUILDER is the table name defined in constant file
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
		 // echo $this->read_db->last_query();exit;
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
	* Get builder users information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with User table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_internal_user
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_builder_users($args = array())
	{
	       /* echo '<pre>';print_r($args); */
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_USER.' AS USER');	//UB_USER is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_BUILDER.' AS BUILDER','USER.builder_id = BUILDER.ub_builder_id','left');
		}
		if(isset($args['join']) && 'yes' === strtolower($args['join']['roles']))
			{
			$this->read_db->join('ub_roles'.' AS ROLES','USER.role_id = ROLES.ub_role_id');
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
	*update_data method will update userdata
	* 
	* @method: update_data
	* @access: public 
	* @param: data array, where condition and table name
	* @return: Boolean value 
	*/
	public function update_data($table_name = '', $data_array = array(), $where = array())
	{	
		$data_array['modified_on'] = TODAY;
		$data = array();
		if($this->write_db->update($table_name, $data_array, $where))
		{
			$data['status'] = TRUE;
			$data['message'] = 'Data inserted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		return $data;
	}
	
	/** 
	*insert_data method will insert data into provided table name
	* 
	* @method: insert_data
	* @access: public 
	* @param: data array and table name
	* @return: Boolean value 
	*/
	
	public function insert_data($table_name = '', $data_array = array())
	{	
		$data = array();
		//print_r($data_array);exit;
		$result = $this->get_users(array(
								'select_fields' => array('USER.ub_user_id', 'USER.username'),
								'where_clause' => array('USER.username' => $data_array['username'])
								));
		if(isset($data_array['access_method']) && $data_array['access_method'] == 'configure')
		{
		  if($data_array['username'] === '')
		  {
		    $data['status'] = FALSE;
		    $data['message'] = 'Insert Failed: Username is Empty';
		  }
		  else if($data_array['password'] === '')
		  {
		    $data['status'] = FALSE;
		    $data['message'] = 'Insert Failed: Password is Empty';
		  }
		  else
		  {
		  	if(FALSE === $result['status'])
		  	{
		  		unset($data_array['access_method']);
		  		if($this->write_db->insert($table_name, $data_array))
		        {
			      $data['primary_id'] =  $this->write_db->insert_id();
			      $data['status'] = TRUE;
			      $data['message'] = 'Data inserted successfully';
		        }
		        else
		        {
			      $data['status'] = FALSE;
			      $data['message'] = 'No record found';
		        }
		  	 }
		  	 else
			  {
				// User is already exists
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Username already exists';
			  }
	       }
	    }
	  else
	  {
	  	unset($data_array['access_method']);
	  	if($this->write_db->insert($table_name, $data_array))
		{
			$data['primary_id'] =  $this->write_db->insert_id();
			$data['status'] = TRUE;
			$data['message'] = 'Data inserted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
	  }
		return $data;
	}
	/** 
	* Formatting User datetime / date based on user timezone and date format
	* 
	* @method: format_user_datetime
	* @access: public 
	* @param1: input_array 
	* @param2: type - by default datetime will be the time, if user pass date then it format date 
	* @return: formatted string
	*/
	public function format_user_datetime($input_array, $type='datetime')
	{
		if(!empty($input_array))
		{
			$return_str = '';
			foreach($input_array as $key => $value)
			{
				$alias = '';
				if($value != '')
				{
					$alias =  'AS '.$value.'';
				}
				if($type == 'date')
				{
					// Date formatting
					$fmt_str = "DATE_FORMAT(".$key." , '".substr($this->user_session['date_format'],0,8)."' ) ".$alias;
				}
				else
				{
					// Datetime formatting
					$fmt_str = " DATE_FORMAT( CONVERT_TZ( ".$key." , '+00:00', '".$this->user_session['time_zone']."' ) , '".$this->user_session['date_format']."' ) ".$alias;
				}
				if('' == $return_str)
					$return_str = $fmt_str;
				else
					$return_str .= ', '.$fmt_str;
			}
			// $response['formatted_datetime'] = $return_str;
			// $response['status'] = TRUE;
			// $response['message'] = 'Datetime formatted as per user timezone and date format successfully';
			return $return_str;
		}
		else
		{
			// $response['status'] = FALSE;
			// $response['message'] = 'Datetime array is empty';
			return FALSE;
		}
		// return $response;
	}
	/** 
	* Formatting User datetime / date based on user timezone and date format
	* 
	* @method: format_user_datetime
	* @access: public 
	* @param1: input_array 
	* @return: formatted string
	*/
	public function get_current_datetime($input_array, $type='datetime')
	{
		if(!empty($input_array))
		{
			$return_str = '';
			foreach($input_array as $key => $value)
			{
				$alias = '';
				if($value != '')
				{
					$alias =  'AS '.$value.'';
				}
				if($type == 'date')
				{
					// Date formatting
					
					$query = $this->db->query("SELECT DATE_FORMAT(current_date, '".substr($this->user_session['date_format'],0,8)."' ) AS current_date_fmt FROM ".UB_USER);
					//echo $this->db->last_query();exit;
					$parent_folder_id = $query->row_array();
					$return_str = $parent_folder_id['current_date_fmt'];
				}
				else
				{
					// Datetime formatting
					$fmt_str = " DATE_FORMAT( CONVERT_TZ( ".$key." , '+00:00', '".$this->user_session['time_zone']."' ) , '".$this->user_session['date_format']."' ) ".$alias;
				}
			}
			return $return_str;
		}
		else
		{
			// $response['status'] = FALSE;
			// $response['message'] = 'Datetime array is empty';
			return FALSE;
		}
		// return $response;
	}
	
	/**
	*
	* Update  user
	*
	* @method: get_sub_contractor
	* @access: public	 
	* @param: post data
	* @return: return data
	*/
	
	public function get_sub_contractor($args = array())
	{
	       // echo '<pre>';print_r($args); 
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SUBCONTRACTOR.' AS SUBCONTRACTOR');	//UB_USER is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_BUILDER.' AS BUILDER','SUBCONTRACTOR.builder_id = BUILDER.ub_builder_id','left');//UB_BUILDER is the table name defined in constant file
			$this->read_db->join(UB_USER.' AS USER','SUBCONTRACTOR.user_id = USER.ub_user_id','left');
		}
		// where condition
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
	* get_user_roles
	* 
	* @method: builderuser_email_invitation
	* @access: public 
	* @param: post data
	* @return: Boolean value 
	*/
	
		public function get_user_roles($args = array())
	{
	       /* echo '<pre>';print_r($args); */
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*');
		$this->read_db->from(UB_ROLE.' AS ROLE');	//UB_USER is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_BUILDER.' AS BUILDER','ROLE.builder_id = BUILDER.ub_builder_id','left');
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
		 // echo $this->read_db->last_query();exit;
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
	public function delete_userroles($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_role_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_role_id'] as $key=>$ub_role_id)
			{
				$this->write_db->delete(UB_ROLE, array('ub_role_id' => $ub_role_id));
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'User Roles deleted successfully';
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
	* Update  user
	*
	* @method: update_user
	* @access: public	 
	* @param: post data
	* @return: return data
	*/
	public function update_internal_user($post_array = array())
	{
		$this->write_db->where('ub_user_id', $post_array['ub_user_id']);
         $this->write_db->update(UB_USER, $post_array);
         echo "Updated successfully";
		 
	}
	public function update_builder_user($post_array = array())
	{
		$this->write_db->where('ub_user_id', $post_array['ub_user_id']);
         $this->write_db->update(UB_USER, $post_array);
		 return true;
		 
	}
	
	
	
	/**
	*
	* delete  user
	*
	* @method: update_user
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_internal_user($delete_array)
    {
        //$user_id = $delete_array['ub_user_id'];
       // $this->write_db->delete(UB_USER, array('ub_user_id' => $user_id));
        //echo "Deleted successfully";
		if(isset($delete_array['ub_user_id']))
		{
			foreach($delete_array['ub_user_id'] as $key=>$user_id)
			{
				$this->write_db->delete(UB_USER, array('ub_user_id' => $user_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'User(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'User id is not set';
		}
		return $data;
    } 
	/**
	* Add user
	*
	* @method: add_internal_user
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_internal_user($post_array = array())
	{
		if( ! empty($post_array))
		{
			//echo '<pre>';print_r($post_array);exit;
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = isset($this->user_session['builder_id']);
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			
			if($this->builder_id > 0)
			{
				//$result = $this->validate_duplicate_users($post_array);
				$result = $this->get_internal_user(array(
								'select_fields' => array('USER.first_name', 'USER.last_name', 'USER.address', 'USER.primary_email', 'USER.username', 'USER.password'),
								'where_clause' => array('USER.builder_id' => isset($post_array['builder_id'])?$post_array['builder_id']:$this->builder_id, 'USER.first_name' => $post_array['first_name'])
								));		
				if(FALSE === $result['status'])
				{
					// Failed to retrieve the same role
					$post_array['builder_id'] = $this->builder_id;
					$post_array['created_by'] = $this->user_session['ub_user_id'];
					$post_array['created_on'] = TODAY;
					$post_array['modified_by'] = $this->user_session['ub_user_id'];
					$post_array['modified_on'] = TODAY;
					if($this->write_db->insert(UB_USER, $post_array))
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
				/*else if(TRUE === $result['status'] && $result['aaData'][0]['USER.primary_email'] != $post_array['USER.primary_email'])
				{
					// Role is already exists, but status is different
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Record already exists, Current status of the role '.$result['aaData'][0]['role_name'].' is  '.$result['aaData'][0]['USER.primary_email'];
				}*/
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
		exit();
	}
	
	/**
	*
	* Update  subvendor
	*
	* @method: update_subvendor
	* @access: public	 
	* @param: post data
	* @return: return data
	*/
	public function update_subvendor($post_array = array())
	{
		$this->write_db->where('ub_subcontractor_id', $post_array['ub_subcontractor_id']);
         $this->write_db->update(ub_subcontractor, $post_array);
         echo "Updated successfully";
		 
	}
	
	/**
	* Add subvendor
	*
	* @method: add_subvendor
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_subvendor($post_array = array())
	{
		if( ! empty($post_array))
		{
			//echo '<pre>';print_r($post_array);exit;
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = isset($this->user_session['builder_id']);
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			
			if($this->builder_id > 0)
			{
				//$result = $this->validate_duplicate_users($post_array);
				$result = $this->get_subvendor(array(
								'select_fields' => array('SUBCONTRACTOR.Company', 'SUBCONTRACTOR.Division'),
									/*'where_clause' => array('USER.builder_id' => isset($post_array['builder_id'])?$post_array['builder_id']:$this->builder_id, 'USER.first_name' => $post_array['first_name'])*/
								));		
				if(FALSE === $result['status'])
				{
					// Failed to retrieve the same role
					$post_array['builder_id'] = $this->builder_id;
					$post_array['created_by'] = $this->user_session['ub_user_id'];
					$post_array['created_on'] = TODAY;
					$post_array['modified_by'] = $this->user_session['ub_user_id'];
					$post_array['modified_on'] = TODAY;
					if($this->write_db->insert('ub_subcontractor', $post_array))
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
				/*else if(TRUE === $result['status'] && $result['aaData'][0]['USER.primary_email'] != $post_array['USER.primary_email'])
				{
					// Role is already exists, but status is different
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Record already exists, Current status of the role '.$result['aaData'][0]['role_name'].' is  '.$result['aaData'][0]['USER.primary_email'];
				}*/
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
		exit();
	}

	/**
	*
	* delete  subvendor
	*
	* @method: update_subvendor
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_subvendor($delete_array)
    {
        //$user_id = $delete_array['ub_user_id'];
       // $this->write_db->delete(UB_USER, array('ub_user_id' => $user_id));
        //echo "Deleted successfully";
		if(isset($delete_array['ub_subcontractor_id']))
		{
			foreach($delete_array['ub_subcontractor_id'] as $key=>$ub_subcontractor_id)
			{
				$this->write_db->delete(UB_SUBCONTRACTOR, array('ub_subcontractor_id' => $ub_subcontractor_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'User(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Subcontractor id is not set';
		}
		return $data;
    }
	/**
	*
	* Getting all types of users - Building drop down
	*
	* @method: get_users_by_type
	* @access: public 
	* @param: post data
	* @return: return data
	*/	
	public function get_users_by_type($args, $dropdown_type = 'single')
	{
		$dropdown_array = array();

		foreach($args as $account_type=>$where_clause)
		{
			if($account_type == SUBCONTRACTOR)
			{
				if(isset($where_clause['builder_id']) && isset($where_clause['account_type']))
				{
					$where_clause = 'USER.builder_id = '.$where_clause['builder_id'].' AND account_type ='.$where_clause['account_type'];
				}
				else
				{
					$where_clause = 'USER.'.$where_clause;
				}	
				$type_users = $this->get_users(array(
								'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as full_name','username','UB_SUBCONTRACTOR.company'),
								'where_clause' => $where_clause,
								'join'=> array('sub_contractor'=>'Yes')
								));
			} 
			else
			{
				$account_type_array = array(BUILDERADMIN, OWNER, SUBCONTRACTOR);
				if(in_array($account_type, $account_type_array))
				{
					$type_users = $this->get_users(array(
									'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as full_name','username'),
									'where_clause' => $where_clause
									));
				} 
			}
			if(TRUE === $type_users['status'])
			{
				if($account_type == BUILDERADMIN)
					$type_name = 'Builder user';
				if($account_type == OWNER)
					$type_name = 'Owner';
				if($account_type == SUBCONTRACTOR)
					$type_name = 'Sub contractor';
				$dropdown_array[$type_name] = $type_users['aaData'];
			}
		}
		$formatted_dropdown = array();
		if($dropdown_type == 'single')
		{
			$formatted_dropdown = array(''=>'Nothing Selected');
		}
		foreach($dropdown_array as $account_type => $account_type_values)
		{
			if($account_type == 'Sub contractor')
			{
				$formatted_dropdown[$account_type] = $this->build_ci_dropdown_array($account_type_values,'ub_user_id','company','multiple');
			}else{
			$formatted_dropdown[$account_type] = $this->build_ci_dropdown_array($account_type_values,'ub_user_id','full_name','multiple');
			}
		}
		return $formatted_dropdown;
	}
	
	//created by chandru
	public function add_in_sub_contractor_table_and_user_table($post_array)
	{
		$insert_in_sub_contractor_table = array( 
					'builder_id' => $this->builder_id,
					'user_id' => $this->user_id,
					'company' => $post_array['company'],
					'division' => $post_array['division'],
					'address' => $post_array['address'],
					'city' => $post_array['city'],
					'province' => $post_array['province'],
					'postal' => $post_array['postal'],
					'desk_phone' => $post_array['desk_phone'],
					'mobile_phone' => $post_array['mobile_phone'],
					'fax' => $post_array['fax'],
					'access_to_all_projects' => $post_array['access_to_all_projects'],
					'access_to_all_owners' => $post_array['access_to_all_owners'],
					'other_notes' => $post_array['other_notes'],
					'hold_payments' => $post_array['hold_payments'],
					'notes' => $post_array['notes'],
					'created_by' => $this->user_session['ub_user_id'],
					'created_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
					);
		if($this->write_db->insert(UB_SUBCONTRACTOR, $insert_in_sub_contractor_table))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
			}
		return $data;
		echo '<pre>';print_r($insert_in_sub_contractor_table);exit;
	}
	
	//Get sub_contractor
	
	public function get_sub_contractors($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SUBCONTRACTOR.' AS UB_SUBCONTRACTOR');	//UB_ROLE is the table name defined in constant file
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
		return $data;
	}
	
	/**
	*
	* Update task
	*
	* @method: update_sub_contractors
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	*/
	public function update_sub_contractors($post_array = array())
	{
		$sub_contractor_update_main_array = array(
			'company' => $post_array['company'],
			'division' => $post_array['division'],
			'address' => $post_array['address'],
			'city' => $post_array['city'],
			'province' => $post_array['province'],
			'postal' => $post_array['postal'],
			'desk_phone' => $post_array['desk_phone'],
			'mobile_phone' => $post_array['mobile_phone'],
			'fax' => $post_array['fax'],
			'access_to_all_projects' => $post_array['access_to_all_projects'],
			'access_to_all_owners' => $post_array['access_to_all_owners'],
			'other_notes' => $post_array['other_notes'],
			'hold_payments' => $post_array['hold_payments'],
			'notes' => $post_array['notes'],
			'modified_by' => $this->user_session['ub_user_id'], 
			'modified_on' => TODAY
		);
		$this->write_db->where('ub_subcontractor_id', $post_array['ub_subcontractor_id']);
		$this->write_db->update(UB_SUBCONTRACTOR, $sub_contractor_update_main_array);
		$data['insert_id'] =  $post_array['ub_subcontractor_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Updated successfully';
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
	* @createdby: chandru
	*/
	public function delete_sub_contractor($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_subcontractor_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_subcontractor_id'] as $key=>$ub_subcontractor_id)
			{
				$this->write_db->delete(UB_SUBCONTRACTOR, array('ub_subcontractor_id' => $ub_subcontractor_id));
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Sub_contractor details deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Sub_contractor id is not set';
		}
		return $data;

	}
	/**
	*
	* Add builderuser
	* @author: Sidhartha
	* @method: add_user
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_user($post_array = array())
	{
		if( ! empty($post_array))
		{
		
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
			  if($this->write_db->insert(UB_USER, $post_array))
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
	*
	* Update user
	* @author: Sidhartha
	* @method: update_user
	* @access: public 
	* @param: array data
	* @return: return data
	*/
	public function update_user($post_array = array())
	{
		//print_r($post_array);
		if( ! empty($post_array))
		{
			$this->ub_user_id = isset($post_array['ub_user_id'])?$post_array['ub_user_id']:$this->ub_user_id;
			if($this->ub_user_id > 0)
			{
			  unset($post_array['access_method']);
			  $this->write_db->where('ub_user_id', $this->ub_user_id);
		      if($this->write_db->update(UB_USER, $post_array))
		      {
			    $data['insert_id'] =  $this->ub_user_id;
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
			 $data['message'] = 'User id should have value / it should greater than 0';
		   }	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		//echo $this->write_db->last_query();exit;
		return $data;
	}

	//new one
	/**
	*
	* Add builderuser
	* @author: Sidhartha
	* @method: add_user
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_builderuser($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
				
				
				$result = $this->get_users(array(
								'select_fields' => array('USER.ub_user_id', 'USER.username'),
								'where_clause' => array('USER.username' => $post_array['username'])
								));
				if($post_array['first_name'] === '')
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Insert Failed: Firstname is Empty';
				}
				else if($post_array['accessmethod'] == 'configure')
				{
				  if($post_array['username'] === '')
				  {
				    $data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: Username is Empty';
				  }
				  else if($post_array['password'] === '')
				  {
				    $data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: Password is Empty';
				  }
				  else{	
				  if(FALSE === $result['status'])
				  {
				  	 unset($post_array['accessmethod']);
				    // Failed to retrieve the same user
					if($this->write_db->insert(UB_USER, $post_array))
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
					// User is already exists
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Username already exists';
				  }}
				}	
				else if($post_array['accessmethod'] == 'emailinvite')
				{
				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   // Failed to retrieve the same user
				   if($this->write_db->insert(UB_USER, $post_array))
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

				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   if($this->write_db->insert(UB_USER, $post_array))
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
		if($data['status'] == TRUE)
		{
			/* Builder user Activation NOTIFICATION code */
			/* FETCH BUILDER NAME */
			$scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']);
			$builder_id = $this->user_session['builder_id'];
			$builder_name_condition_post_array =  array('ub_builder_id'=>$builder_id);
			$builder_name_array = $this->Mod_builder->get_builder_details(array(
															'select_fields' => array('builder_name'),
															'where_clause' => $builder_name_condition_post_array
															));
			$builder_name = $builder_name_array['aaData']['0']['builder_name'];
			/* Fetch user details */
			//Fetch all the users
			$insert_in_user_table = $data['insert_id'];
			$primary_user_id = $builder_id.','.$insert_in_user_table;
			$post_array_values[] = array(
										'field_name' => 'ub_user_id',
										'value'=> $primary_user_id, 
										'type' => '||',
										'classification' => 'primary_ids'
									);
			$where_str = $this->Mod_user->build_where($post_array_values);
			$get_all_users = array(
									'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name','created_on'),
									'where_clause' => $where_str
									);
			$all_users = $this->Mod_user->get_users($get_all_users);
			$user_list = $all_users['aaData'];
			if(isset($user_list) && !empty($user_list))
			{
			foreach($user_list as $key => $val)
			{
				$email_ids[] = $val['primary_email'];
				$email_id = $val['primary_email'];
				$name = $val['fullname'];
				$created_on = $val['created_on'];
				$assigned_to_first_name[] = $val['first_name'];
				$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
			}
			 $to_address = implode(",",$email_ids);
			$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
			}
			$content_array = array(
				'TO_EMAIL' => $email_ids,
				'SEND_MAIL_INFO' => $level1_string,
				'IMAGESRC' => IMAGESRC,
				'name' => $name,
				'created_on' => $created_on,
				'company_name' => $builder_name,
				'base_url'=> BASEURL,
				'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
			$post_array_details = array(
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $this->project_id,
				'module_name' => $this->module,
				'module_pk_id' => $insert_in_user_table,
				'from_user_id' => $this->user_session['ub_user_id'],
				'to_user_id' => $primary_user_id,
				'type' => 'sub_bu_activiation',
				'subject' => 'content will update',
				'message' => 'content will update'
				);
			$notification_array = array(
				'template_name' => 'sub_bu_activiation',
				'content_array' => $content_array,
				'notification' => $post_array_details,
				'default' => 'No'
			);
			// echo '<pre>';print_r($notification_array);exit;
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
        }
		return $data;			
	}
	/**
	*
	*
	* Update user
	* @author: Sidhartha
	* @method: update_user
	* @access: public 
	* @param: array data
	* @return: return data
	*/
	public function update_builderuser($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->ub_user_id = isset($post_array['ub_user_id'])?$post_array['ub_user_id']:$this->ub_user_id;
			if($this->ub_user_id > 0)
			{
				/*$get_primaryemail = $this->get_users(array(
								'select_fields' => array('USER.primary_email'),
								'where_clause' => array('USER.primary_email' => $post_array['primary_email'], 'USER.ub_user_id != ' => $this->ub_user_id)
								));*/

				$result = $this->get_users(array(
								'select_fields' => array('USER.ub_user_id', 'USER.username'),
								'where_clause' => array('USER.username' => $post_array['username'], 'USER.ub_user_id != ' => $this->ub_user_id)
								));
				if($post_array['first_name'] === '')
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Update Failed: Firstname is Empty';
				}
				/*else if($post_array['primary_email'] === '')
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Update Failed: Primary Email is Empty';
				}*/
				/*else if(TRUE === $get_primaryemail['status'])
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Update Failed: This Mail ID is ulready use by another user';
				}*/
				//new one
				else if($post_array['accessmethod'] == 'configure')
				{
				  if($post_array['username'] === '')
				  {
				    $data['status'] = FALSE;
				    $data['message'] = 'Update Failed: Username is Empty';
				  }
				  else if(isset($post_array['password']) && $post_array['password'] === '')
				  {
				    $data['status'] = FALSE;
				    $data['message'] = 'Update Failed: Password is Empty';
				  }

				  else{	
				  if(FALSE === $result['status'])
				  {
				  	 unset($post_array['accessmethod']);
				    // Failed to retrieve the same user
					 $this->write_db->where('ub_user_id', $this->ub_user_id);
				     if($this->write_db->update(UB_USER, $post_array))
				     {
					   $data['insert_id'] =  $this->ub_user_id;
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
					// User is already exists
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Username already exists';
				  }}
				}
				else if($post_array['accessmethod'] == 'emailinvite')
				{
				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   $this->write_db->where('ub_user_id', $this->ub_user_id);
				   if($this->write_db->update(UB_USER, $post_array))
				   {
					 $data['insert_id'] =  $this->ub_user_id;
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
				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   $this->write_db->where('ub_user_id', $this->ub_user_id);
				   if($this->write_db->update(UB_USER, $post_array))
				   {
					 $data['insert_id'] =  $this->ub_user_id;
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
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'User id should have value / it should greater than 0';
			}
				
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	//end
	/**
	*
	* Delete user
	* @author: Sidhartha
	* @method: delete_user
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_user($delete_array)
	{
		$post_array = array();
		if(isset($delete_array['ub_user_id']))
		{
			foreach($delete_array['ub_user_id'] as $key=>$ub_user_id)
			{
				 $post_array = array('user_status' => 'Delete');
				 $this->write_db->where('ub_user_id', $ub_user_id);
				 $this->write_db->update(UB_USER, $post_array);
				// $this->write_db->delete(UB_USER, array('ub_user_id' => $ub_user_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'User(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'User id is not set';
		}
		return $data;
	}
	/** 
	*builderuser_email_invitation method will send the login invitation to the builder user 
	* 
	* @method: builderuser_email_invitation
	* @access: public 
	* @param: post data
	* @return: Boolean value 
	* @modified by: chandru 
	* @modified on: 30-05-2015 
	*/
	
	public function user_email_invitation($post_array = array())
	{
		//print_r($post_array);exit;
		$response_ary = array();
		if(!empty($post_array))
		{
			$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
			$data = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
			$where = array('ub_user_id' => $post_array['ub_user_id']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
			if (isset($post_array['username']) && !empty($post_array['username']))
			 {
				$reset_link = base_url().$this->crypt->encrypt('register/accept_invite/'.$post_array['ub_user_id'].'/'.$post_array['username']);
			}
			else
			{
				//echo $this->user_session['builder_id'];
				$builder_details = $this->Mod_builder->get_builder_details(array(
								'select_fields' => array('BUILDER_DETAILS.builder_name'),
								'where_clause' => array('ub_builder_id' => $this->user_session['builder_id'])
								));
				//print_r($builder_details);exit;
				$reset_link = base_url().$this->crypt->encrypt('register/signup_index/'.$post_array['ub_user_id'].'/'.$builder_details['aaData'][0]['builder_name']);
			}
			/* Image and base url was added by chandru 0n 30-05-2015 */
			if(isset($this->user_session['first_name']))
			{
				$first_name = $this->user_session['first_name'];
			}else{
				$first_name ='';
			}
			if(isset($this->user_session['last_name']))
			{
				$last_name = $this->user_session['last_name'];
			}else{
				$last_name ='';
			}
			$content_array = array(
			'TO_EMAIL' => $post_array['primary_email'],
			'TO_NAME' => 'MS',
			'FIRST_NAME' => $post_array['name'],
			'builder_name' => $first_name.' '.$last_name,
			'RESET_LINK' => $reset_link,
			'SEND_MAIL_INFO' => $post_array['name'].EMAIL_SEPERATOR_LEVEL2.$post_array['primary_email'],
			'IMAGESRC' => IMAGESRC,
			'base_url'=> BASEURL
			);
			$this->Mod_mail->send_mail('SEND_INVITATION_EMAIL', $content_array, 'yes');
			$response_ary['status'] =  TRUE;
			$response_ary['message'] = 'Mail send to '.$post_array['primary_email'].' Sucessfully';
		}
		else
		{
			$response_ary['status'] =  FALSE;
			$response_ary['message'] = 'Failed to send mail';
		}
		return $response_ary;
	}
	/** 
	* Get project information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_all_projects_user_involved
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_all_projects_user_involved($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT_ASSIGNED_USERS.' AS PROJECT_ASSIGNED_USERS');
		// Join Tables
		  if(isset($args['join']) && 'yes' === strtolower($args['join']['project']))
		  {
			$this->read_db->join(UB_PROJECT.' AS PROJECT','PROJECT_ASSIGNED_USERS.project_id = PROJECT.ub_project_id','left');//UB_BUILDER is the table name defined in constant file
		  }
		  if(isset($args['join']) && 'yes' === strtolower($args['join']['role']))
		  {
			$this->read_db->join(UB_ROLE.' AS ROLE','PROJECT_ASSIGNED_USERS.role_id = ROLE.ub_role_id','left');//UB_BUILDER is the table name defined in constant file
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


	public function get_company_name($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SUBCONTRACTOR.' AS SUBCONTRACTOR');
		
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
		// echo $this->read_db->last_query();
		return $data;
	}

	
	//Below code added by chandru
	
	/**
	*
	* Add builderuser
	* @author: Sidhartha
	* @method: add_user
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_sub_user_in_user_table($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
				$user_status = $this->get_users(array(
								'select_fields' => array('USER.user_status'),
								'group_clause' => array("USER.subcontractor_id"),
								'where_clause' => array('USER.subcontractor_id' => $post_array['subcontractor_id'])
								));
				//print_r($user_status);exit;
				$result = $this->get_users(array(
								'select_fields' => array('USER.ub_user_id', 'USER.username'),
								'where_clause' => array('USER.username' => $post_array['username'])
								));
				if($post_array['first_name'] === '')
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Insert Failed: Firstname is Empty';
				}
				else if($post_array['accessmethod'] == 'configure')
				{
				  if($post_array['username'] === '')
				  {
				    $data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: Username is Empty';
				  }
				  else if($user_status['aaData'][0]['user_status'] != 'Active')
				  {
				  	$data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: The Subcontractor was deleted';
				  }
				  else{	
				  if(FALSE === $result['status'])
				  {
				  	 unset($post_array['accessmethod']);
				    // Failed to retrieve the same user
					if($this->write_db->insert(UB_USER, $post_array))
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
					// User is already exists
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Username already exists';
				  }}
				}	
				else if($post_array['accessmethod'] == 'emailinvite')
				{
				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   if(FALSE === $user_status['status'] || $user_status['aaData'][0]['user_status'] == 'Active')
				  {
				  	$data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: The Subcontractor was deleted';
				  
				   // Failed to retrieve the same user
				   if($this->write_db->insert(UB_USER, $post_array))
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
				    $data['message'] = 'Insert Failed: The Subcontractor was deleted';
				  }				
				
				}
				else
				{

				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   if($user_status['aaData'][0]['user_status'] != 'Active')
				   {
				  	$data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: The Subcontractor was deleted';
				   }
				   else if($this->write_db->insert(UB_USER, $post_array))
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
	*user_check method will check for user authentication
	* 
	* @method: user_check
	* @access: public 
	* @param: post data and fields to be fetched from table
	* @return: Boolean value 
	*/
	
	public function get_sub_users($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_USER.' AS USER');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']['UB_SUBCONTRACTOR']) && 'yes' === strtolower($args['join']['UB_SUBCONTRACTOR']))
		{
			$this->read_db->join(UB_SUBCONTRACTOR.' AS UB_SUBCONTRACTOR','UB_SUBCONTRACTOR.ub_subcontractor_id = USER.subcontractor_id');//UB_BUILDER is the table name defined in constant file
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
	*
	*
	* update_sub_user
	* @author: Sidhartha
	* @method: update_sub_user
	* @access: public 
	* @param: array data
	* @return: return data
	*/
	public function update_sub_user($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->ub_user_id = isset($post_array['ub_user_id'])?$post_array['ub_user_id']:$this->ub_user_id;
			if($this->ub_user_id > 0)
			{
				/*$get_primaryemail = $this->get_users(array(
								'select_fields' => array('USER.primary_email'),
								'where_clause' => array('USER.primary_email' => $post_array['primary_email'], 'USER.ub_user_id != ' => $this->ub_user_id)
								));*/
				$user_status = $this->get_users(array(
								'select_fields' => array('USER.user_status'),
								'group_clause' => array("USER.subcontractor_id"),
								'where_clause' => array('USER.subcontractor_id' => $post_array['subcontractor_id'])
								));

				$result = $this->get_users(array(
								'select_fields' => array('USER.ub_user_id', 'USER.username'),
								'where_clause' => array('USER.username' => $post_array['username'], 'USER.ub_user_id != ' => $this->ub_user_id)
								));
				if($post_array['first_name'] === '')
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Update Failed: Firstname is Empty';
				}
				/*else if($post_array['primary_email'] === '')
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Update Failed: Primary Email is Empty';
				}*/
				/*else if(TRUE === $get_primaryemail['status'])
				{
				  $data['status'] = FALSE;
				  $data['message'] = 'Update Failed: This Mail ID is ulready use by another user';
				}*/
				//new one
				else if($post_array['accessmethod'] == 'configure')
				{
				  if($post_array['username'] === '')
				  {
				    $data['status'] = FALSE;
				    $data['message'] = 'Update Failed: Username is Empty';
				  }
				  else if($user_status['aaData'][0]['user_status'] != 'Active')
				  {
				  	$data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: The Subcontractor was deleted';
				  }
				  else{	
				  if(FALSE === $result['status'])
				  {
				  	 unset($post_array['accessmethod']);
				    // Failed to retrieve the same user
					 $this->write_db->where('ub_user_id', $this->ub_user_id);
				     if($this->write_db->update(UB_USER, $post_array))
				     {
					   $data['insert_id'] =  $this->ub_user_id;
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
					// User is already exists
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Username already exists';
				  }}
				}
				else if($post_array['accessmethod'] == 'emailinvite')
				{
				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   if($user_status['aaData'][0]['user_status'] == 'Active')
				   {
				  	
				   $this->write_db->where('ub_user_id', $this->ub_user_id);
				   if($this->write_db->update(UB_USER, $post_array))
				   {
					 $data['insert_id'] =  $this->ub_user_id;
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
				    $data['message'] = 'Insert Failed: The Subcontractor was deleted';
				  }
			    }
				else
				{
				   unset($post_array['accessmethod']);
				   unset($post_array['username']);
				   unset($post_array['password']);
				   if($user_status['aaData'][0]['user_status'] == 'Active')
				   {
				  	
				   $this->write_db->where('ub_user_id', $this->ub_user_id);
				   if($this->write_db->update(UB_USER, $post_array))
				   {
					 $data['insert_id'] =  $this->ub_user_id;
					 $data['status'] = TRUE;
					 $data['message'] = 'Updated successfully';
				   }
				   else
				   {
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
				   }
				}
				else{
				    $data['status'] = FALSE;
				    $data['message'] = 'Insert Failed: The Subcontractor was deleted';
			      	}
				   }
			   
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'User id should have value / it should greater than 0';
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
	*
	* To check valid old password
	* @author: Devansh
	* @method: check_old_password
	* @access: public 
	* @param: array data
	* @return: return data
	*/
	public function check_old_password($post_array = array())
	{
	     
		if( ! empty($post_array))
		{
			
				$result = $this->get_users(array(
								'select_fields' => array('USER.password'),
								'where_clause' => array('USER.password' => $post_array['password'],
									'USER.ub_user_id' => $post_array['ub_user_id'])
								));
				if($post_array['password'] == '')
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: old password field is empty';
				}
				 else{ if(FALSE === $result['status'])
				  {
				  	$data['status'] = FALSE;
					$data['message'] = 'Old password did not matched. Please enter the correct password';
					
				    // Failed to retrieve the same user
				  }
				  //added by pranab
				  else
				  {
				   $data['status'] = TRUE ;
				  }
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
	* get role access details
	* 
	* @method: get_role_access_details 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 15/05/2015 
	*/	
	public function get_role_access_details($project_id)
	{
		
			$project_role_id = $project_id;
			//echo 'role_id';print_r($project_role_id);
			$groupby_clause = 'ACCESSLEVEL.menu_id';
			$result_access = $this->Mod_role->get_roles_access(array(
												'select_fields' => array('LOWER(MENU.menu_name) as menu_name','ACCESSLEVELDETAILS.menu_id',
												'ACCESSLEVELDETAILS.access_value_binary AS access_rights', 'GROUP_CONCAT(LOWER(ACCESSLEVEL.access_name) ORDER BY ACCESSLEVEL.display_order ASC SEPARATOR ", ") AS access_name'),
												'join'=> array('menu_access_level_details'=>'Yes'),
												'where_clause' => (array('ACCESSLEVELDETAILS.role_id' =>  $project_role_id)),
												'groupby_clause' => $groupby_clause
												));
												//echo '<pre>';print_r($result_access);
				if(TRUE === $result_access['status'])
				{
					//Below loop will build array for access name and access rights
					$menu_access_list = $result_access['accessdetails'];
					for($i=0;$i<count($menu_access_list);$i++)
					{
						$access_name_array = explode(", ",$menu_access_list[$i]['access_name']);
						/* $slice_value = count($access_name_array);
						$leading_zeros = 0;
						for($j=0;$j<count($slice_value);$j++)
						{
							$leading_zeros = $leading_zeros."0";
						}
						echo '<pre>';print_r($menu_access_list[$i]['access_rights']);exit;
						$access_rights = $leading_zeros.$menu_access_list[$i]['access_rights'];
						echo '<pre>';print_r($access_rights);
						$access_rights = substr($access_rights, "-".$slice_value);
						echo '<pre>';print_r($access_rights); */
						$role_rights = str_split($menu_access_list[$i]['access_rights']);
						//echo '<pre>';print_r($role_rights);
						for($k=0;$k<count($access_name_array);$k++)
						{
						$menu_access[$menu_access_list[$i]['menu_name']][$access_name_array[$k]]= $role_rights[$k];
						}
					} 
					/* $this->account_session[$this->user_session['account_type']]['COMMON_PROJECT_ROLE']= array();
					$role_response_status= $this->uni_set_session('ROLE_RIGHTS', $menu_access_list);
					$role_response['status'] = $role_response_status; */
				}		
					// echo '<pre>';print_r($menu_access);exit;
			return isset($menu_access)?$menu_access:array();
	}
	
	/** 
	* add admin user
	* 
	* @method: add_admin_user 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: pranab
	*/	
	public function add_admin_user($post_array = array())
	{
		if( ! empty($post_array))
		{
		
			  if($this->write_db->insert(UB_USER, $post_array))
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
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;			
	}
	/** 
	*check builder create user limit based on plan. 
	* 
	* @method: check_user_limit_based_plan
	* @access: public 
	* @param: post data
	* @author: Pranab
	* @return: Boolean value 
	*/
	public function check_user_limit_based_plan($post_array = array())
	{
	  $data = array();
	  //print_r($post_array);exit;
	  if(isset($post_array))
	  {
	   $total_no_of_projects = $this->get_users(array(
		                                     'select_fields' => array('count(USER.ub_user_id) as no_of_users'),
											 'where_clause' => array('USER.builder_id'=>$post_array)
		 									 ));
		
          $plan_array = array('select_fields' => array('PLAN.no_of_users'),	
		  'join'=> array('userplan'=>'Yes'),
		  'where_clause' => array('USER_PLAN.builder_id'=>$post_array,'USER_PLAN.status' => 'Active')); 
		  $user_plan = $this->Mod_plan->get_plan_details($plan_array);
		  //print_r($user_plan['aaData'][0]['no_of_users']);exit;
		  // echo '<pre>';print_r($user_plan);exit;
		  if($user_plan['status'] == TRUE)
		  {
         if($user_plan['aaData'][0]['no_of_users'] != -1)
		 {	
            if($total_no_of_projects['aaData'][0]['no_of_users'] >= $user_plan['aaData'][0]['no_of_users'])
			 {
		
			 $data['status'] = FALSE ;
			
			 }
			 else
			 {
				$data['status'] = TRUE;
			 }
	     }
		 else{
			$data['status'] = TRUE;
		 }
		 }else{
			 $data['status'] = FALSE ;
		 }
	 }
	 return $data;
   }
   public function delete_admin_user($delete_array)
    {
		if(isset($delete_array['ub_user_id']))
		{
			$post_array = array('user_status' => 'Delete');
			$this->write_db->where('ub_user_id', $delete_array['ub_user_id']);
			$this->write_db->update(UB_USER, $post_array);
		 //$this->write_db->delete(UB_USER, array('ub_user_id' => $delete_array['ub_user_id']));
		
			$data['status'] = TRUE;
			$data['message'] = 'User(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'User id is not set';
		}
		return $data;
    }
}
/* End of file mod_user.php */
/* Location: ./application/models/mod_user.php */