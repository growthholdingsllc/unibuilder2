<?php
/** 
 * Project Model
 * 
 * @package: Project Model
 * @subpackage: Project Model 
 * @category: Project
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 14-03-2015
*/
class Mod_project extends UNI_Model
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
		$this->project_id = 0;
		parent::__construct();
		$this->load->model(array('Mod_mail','Mod_user'));
    }
	/** 
	* Get projects information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with project table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_projects
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_projects($args = array())
	{
		//echo '<pre>';print_r($args);exit;
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT.' AS PROJECT');
		// Join Tables
		if(isset($args['join']['owner']) && 'yes' === strtolower($args['join']['owner']))
		{
			$this->read_db->join(UB_USER.' AS OWNER','PROJECT.owner_id = OWNER.ub_user_id','left');
		}
		if(isset($args['join']['project_manager']) && 'yes' === strtolower($args['join']['project_manager']))
		{
			$this->read_db->join(UB_USER.' AS BUILDER','PROJECT.project_managers = BUILDER.ub_user_id','left');
		}
		if(isset($args['join']['signoff_documents_info']) && 'yes' === strtolower($args['join']['signoff_documents_info']))
		{
			$this->read_db->join(UB_SIGNOFF_DOCUMENTS_INFO.' AS UB_SIGNOFF_DOCUMENTS_INFO','PROJECT.ub_project_id = UB_SIGNOFF_DOCUMENTS_INFO.project_id','left');
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			//print_r($args);
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
		if(!$res)
        {
            echo $this->read_db->_error_message();
            echo "<br>".$this->read_db->_error_number();exit;
        } 
		//echo $this->read_db->last_query();exit;
		// Export the data ti file in this point
		if(isset($args['query_type']) && $args['query_type'] == 'export123')
		{
			return $res;
		}
		$data = array();
		//echo $this->read_db->last_query();exit;
		if($res->num_rows() > 0)
		{
			$project_list = $res->result_array();
			$data['aaData'] = $project_list;
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
			if(isset($args['query_type']) && $args['query_type'] == 'map')
			{
				$latlong_array = array();
				foreach($project_list as $project)
				{
					if(isset($project['lat_long']) && $project['lat_long'] != '')
					{
						$latlong_array[] = array('lat'=>$project['latitude'],'lon'=>$project['longitude'],'lat_long'=>$project['lat_long'],'project_name'=>$project['project_name'],'address'=>$project['address'],'project_id'=>$project['ub_project_id']);
					}
				}
				unset($data['aaData']);
				$data['mapData'] = $latlong_array;
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		return $data;
	}
	
	public function get_assigned_role_ids($args = array())
	{
		//echo '<pre>';print_r($args);exit;
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT_ASSIGNED_USERS.' AS PROJECTASSIGNED');
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['owner']))
		{
			//
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
		// echo $this->read_db->last_query();exit;
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
	* Add project
	*
	* @method: add_project
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_project($post_array = array())
	{

		$post_array['created_by'] = $this->user_session['ub_user_id'];
		$post_array['created_on'] = TODAY;
		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		
		//added by pranab
		$project_limit = $this->check_project_limit_based_plan($post_array['builder_id']) ;
		if(TRUE === $project_limit['status'])
			{
		// Query to insert data in ub_project table
		if($this->write_db->insert(UB_PROJECT, $post_array))
		{
			$data['ub_project_id'] =  $this->write_db->insert_id();
			/* Create folder structure code was added by chandru 02-06-2015 */
			$get_folder_id = array(
						'select_fields' => array('ub_doc_folder_id'),
						'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
												 'sys_folder_name' => 'docs',
												 'visible' => 'No',
												 'is_delete' => 'No'
												))
						);
			$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
			$folder_id = 0;
			if (isset($all_folder['aaData']) && !empty($all_folder)) 
			{
				$folder_id = $all_folder['aaData']['0']['ub_doc_folder_id'];
			}
			$folder_array = array(
				'project_id' => $data['ub_project_id'],
				'builder_id' => $this->builder_id,
				'project_name' => $post_array['project_name'],
				'folder_name' => $post_array['project_name'],
				'flag' => 1,
				'parent_folder_id' => $folder_id,
				'call_from' => 'PHP',
				);
			$create_folder = $this->Mod_doc->create_new_folder($folder_array);
			foreach ($create_folder as $dir) {
				foreach ($dir as $folderpath) {
				   $response = $this->Mod_doc->create_dir(DOC_PATH.$folderpath);
				}
			}
			// Start -- Block to create project folder in photos ---- Devansh 
			$get_folder_id = array(
                                    'select_fields' => array('ub_doc_folder_id'),
                                    'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],
                                    						 'sys_folder_name' => 'photos'
                                    						))
                                    );
			//echo "<pre>";print_r($get_folder_id);exit;
			$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);

			$photo_dir = array('builder_id' => $this->user_session['builder_id'], 
									  'user_id'	=> $this->user_session['ub_user_id'],
									  'project_id' => $data['ub_project_id'],
									  'project_name' => '',
									  'folder_name' => $post_array['project_name'],
									  'parent_folder_id' => $all_folder['aaData']['0']['ub_doc_folder_id'],
									  'flag' => 0,
									  'call_from' => 'PHP',
									);
			$create_photo_folder = $this->Mod_doc->create_new_folder($photo_dir);
			foreach ($create_photo_folder as $dir) {
				foreach ($dir as $folderpath) {
				   $response = $this->Mod_doc->create_dir(DOC_PATH.$folderpath);
				}
			}
			// End -- Block to create project folder in photos
			$data['status'] = TRUE;
			$data['message'] = 'Data inserted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Failed to insert project data';
		}
	 }
	 else
	 {
	   $data['status'] = 'limit_exceed' ;
	 }
		return $data;
	}
	
	/**
	*
	* Add project
	*
	* @method: add_project
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	
	public function insert_project_assign_users($post_array = array())
	{

		$post_array['created_by'] = $this->user_session['ub_user_id'];
		$post_array['created_on'] = TODAY;
		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		// Query to insert data in ub_project table
		if($this->write_db->insert(UB_PROJECT_ASSIGNED_USERS, $post_array))
		{
			$data['ub_project_assigned_user_id'] =  $this->write_db->insert_id();
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
	* Update project
	*
	* @method: update_project
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_project($post_array = array())
	{

		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		
		if( ! empty($post_array) && $post_array['ub_project_id'] > 0)
		{
			$this->project_id = $post_array['ub_project_id'];
			$this->owner_id = $post_array['owner_id'];
			$this->write_db->where('ub_project_id', $this->project_id);
			if($this->write_db->update(UB_PROJECT, $post_array))
			{
				$data['ub_project_id'] =  $this->project_id;
				$data['owner_id'] =  $this->owner_id;
				$data['status'] = TRUE;
				$data['message'] = 'Data Updated successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to update project data';
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
	* Delete projects
	*
	* @method: delete_projects
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_projects($delete_array)
	{
		//print_r($delete_array);exit;
		if(isset($delete_array['ub_project_id']))
		{
			
			foreach($delete_array['ub_project_id'] as $key=>$ub_project_id)
			{
				//echo "hi";exit;
				$this->write_db->delete(UB_PROJECT, array('ub_project_id' =>$ub_project_id ));
			}	
			$data['status'] = TRUE;
			$data['message'] = 'PROJECT(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'PROJECT id is not set';
		}
		return $data;
	}
	
	/**
	*
	* Delete Projects
	* @author: Satheesh Kumar
	* @method: delete_projects_status
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_projects_status($delete_array)
	{
		$post_array = array();
		if(isset($delete_array['ub_project_id']))
		{
			foreach($delete_array['ub_project_id'] as $key=>$ub_project_id)
			{
				$post_array = array('project_status' => 'Deleted');
				$this->write_db->where('ub_project_id', $ub_project_id);
				$this->write_db->update(UB_PROJECT, $post_array);
				$owner_id = $this->Mod_project->get_projects(array(
						'select_fields' => array('PROJECT.owner_id'),
						'where_clause' => array('ub_project_id' => $ub_project_id)
						));
				if($owner_id['status'] == TRUE)
				{			
					$post_array = array('user_status' => 'Delete');
					$this->write_db->where('ub_user_id', $owner_id['aaData'][0]['owner_id']);
					$this->write_db->update(UB_USER, $post_array);
				}				
			}
			$data['status'] = TRUE;
			$data['message'] = 'PROJECT(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'PROJECT id is not set';
		}
		return $data;
	}
	/**
	*
	* Delete projects
	*
	* @method: delete_project_assigned_user
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_project_assigned_user($delete_array)
	{
		if(isset($delete_array['project_id']))
		{
			if($this->write_db->delete(UB_PROJECT_ASSIGNED_USERS, array('project_id' => $delete_array['project_id'])))
			{
				$data['status'] = TRUE;
				$data['message'] = 'PROJECT(s) deleted successfully';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'PROJECT id is not set';
		}
		return $data;
	}
	
	/**
	*
	* Get meeting
	*
	* @method: get_meeting
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function get_meeting($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_MOM_ASSIGNED_USERS.' AS MOM_ASSIGNED_USERS');	//UB_ROLE is the table name defined in constant file
		// Join Tables
			if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
			{
			$this->read_db->join('ub_mom'.' AS MOM','MOM.ub_mom_id = MOM_ASSIGNED_USERS.mom_id');
			}
			if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
			{
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = MOM.conducted_by');
			$this->read_db->join('ub_user'.' AS USERS','USERS.ub_user_id = MOM_ASSIGNED_USERS.attendee_id');
			}
			if(isset($args['join']['project']) && 'yes' === strtolower($args['join']['project']))
			{
			$this->read_db->join('ub_project'.' AS PROJECT','MOM.project_id = PROJECT.ub_project_id');
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
			// Export the data ti file in this point
		if(isset($args['query_type']) && $args['query_type'] == 'export123')
		{
			return $res;
		}
			$data = array();
			if($res->num_rows() > 0)
			{
				$data['aaData'] = $res->result_array();
				$data['status'] = TRUE;
				$data['message'] = 'Data retrieved successfully';
				
				// echo '<pre>';print_r($res->result_array);exit;
             //echo $this->read_db->last_query();				
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
	* Get meeting List
	*
	* @method: get_meeting_list
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function get_meeting_list($args = array())
	{
	
		//echo '<pre>';print_r($args);exit;
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from('ub_mom'.' AS MOM');	//UB_MOM is the table name defined in constant file
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
	* Add meeting
	*
	* @method: add_meeting
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function add_meeting($post_array = array())
	{
		//echo '<pre>';print_r($post_array);exit;
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{		
					$post_array['created_by'] = $this->user_session['ub_user_id'];
					$post_array['created_on'] = TODAY;
					$post_array['modified_by'] = $this->user_session['ub_user_id'];
					$post_array['modified_on'] = TODAY;
					if($this->write_db->insert(UB_MOM, $post_array))
					{
						$mom_id =  $this->write_db->insert_id();
						// Insert code for assigned users
						if(isset($post_array['attendees'])) 
						{ 
							$post_array['attendee_array'] = explode(",",$post_array['attendees']);
							if($this->insert_mom_assigned_users($mom_id,$post_array)) 
							{ 
								$data['ub_mom_id'] =  $mom_id;
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
						$data['ub_mom_id'] =  $mom_id;
						$data['status'] = TRUE;
						$data['message'] = 'Data inserted successfully';
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
	* insert mom_assigned_users table
	*
	* @method: insert_mom_assigned_users
	* @access: public 
	* @param: mom_id,post_array
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function insert_mom_assigned_users($mom_id,$post_array = array())
	{
		$mom_assigned_user_table_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $post_array['project_id'],
				'mom_id' => $mom_id,
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
			foreach($post_array['attendee_array'] as $attendee)
			{	
				// Query to insert data in ub_mom table
				$mom_assigned_user_table_insert_array['attendee_id'] =  $attendee;
			    $this->write_db->insert(UB_MOM_ASSIGNED_USERS, $mom_assigned_user_table_insert_array);
			}
			 return 'inserted';
	}
	
	/**
	*
	* update mom table
	*
	* @method: update_meeting
	* @access: public 
	* @param: post_array
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function update_meeting($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{	
				// Query to select data from ub_mom table
				$args['select_fields'] = array('attendees');
				$args['where_clause'] = array('ub_mom_id' => $post_array['ub_mom_id']);
				$existing_meeting = $this->get_meeting_list($args);
				//post_array for updating ub_mom table
				$post_array['created_by'] = $this->user_session['ub_user_id'];
				$post_array['created_on'] = TODAY;
				$post_array['modified_by'] = $this->user_session['ub_user_id'];
				$post_array['modified_on'] = TODAY;
				// Query to update data in ub_mom table
				$this->write_db->where('ub_mom_id', $post_array['ub_mom_id']);
				if($this->write_db->update(UB_MOM, $post_array))
				{	
					$ub_mom_id =$post_array['ub_mom_id'];
					if(isset($post_array['attendees']))
					{
					$attendee_new = explode(",",$post_array['attendees']);
					}
					else
					{
					$attendee_new = array();
					}
					//get old attendee value for ub_mom table
					$attendee_old = explode(",",$existing_meeting['aaData'][0]['attendees']);
					//diff between two arrays and returns only different values in attendee_new array
					$attendee_insert = array_diff($attendee_new,$attendee_old);
					$attendee_delete = array_diff($attendee_old,$attendee_new);
					$post_array['attendee_array']= $attendee_insert;
					$delete_array = array('mom_id'=> $ub_mom_id,
										  'attendees'=> $attendee_delete												
										  );					  
					if(count($attendee_delete) > 0)
					{	
						//function call to delete record in ub_mom table
						$this->delete_mom_assigned_users($delete_array);
					}
					if(count($attendee_insert) > 0)
					{	
						//function call to insert data in ub_mom table
						$this->insert_mom_assigned_users($ub_mom_id,$post_array);		
					}
					$data['ub_mom_id'] =  $post_array['ub_mom_id'];
					$data['status'] = TRUE;
					$data['message'] = 'Updated Successfully';
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
			$data['message'] = 'Post array is empty';
		}
		//echo $this->write_db->last_query();
		return $data;	
	}
	/**
	*
	* Delete mom_asssigned users
	*
	* @method: delete_mom_assigned_users
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function delete_mom_assigned_users($delete_array)
	{
		if(isset($delete_array['mom_id']))
		{
			foreach($delete_array['attendees'] as $key=>$attendee_id)
			{	
				// Query to delete data in ub_mom table
				$this->write_db->delete(UB_MOM_ASSIGNED_USERS, array('attendee_id' => $attendee_id, 'mom_id' => $delete_array['mom_id']));
			}
			$data['status'] = TRUE;
			$data['message'] = 'MOM(s) Deleted Successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'MOM id is not set';
		}
		return $data;
	}
	/**
	*
	* Delete getting project assigned users
	*
	* @method: get_project_assigned_users
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function get_project_assigned_users($args)
	{
		$project_id = isset($args['ub_project_id'])?$args['ub_project_id']:0;
		$account_type = isset($args['account_type'])?$args['account_type']:'all';
		$assigned_type = isset($args['assigned_type'])?$args['assigned_type']:'yes';
		$dropdown_type = isset($args['dropdown_type'])?$args['dropdown_type']:'';
		if($project_id > 0)
		{
			$result = $this->get_projects(array(
								'select_fields' => array('trim(BOTH "," FROM PROJECT.project_assigned_users) AS project_assigned_users', 'owner_id'),
								'where_clause' => array('PROJECT.builder_id' =>$this->builder_id, 'PROJECT.ub_project_id' => $project_id)
								));
			if(TRUE === $result['status'])
			{
				$project_info = $result['aaData'][0];
				$project_info['project_assigned_users'] = trim($project_info['project_assigned_users'], ',');
				//Below owner_id code added by MS to display owner in To,cc & bcc in messages
				$project_info['owner_id'] = trim($project_info['owner_id'], ',');
				if('optgroup' == $dropdown_type && 'all' == $account_type)
				{
					// Get all assigned users of the project formatted as optgroup
					if('' != $project_info['project_assigned_users'])
					{
						$args = array(BUILDERADMIN => 'builder_id = '.$this->builder_id.' AND account_type ='.BUILDERADMIN.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')',OWNER => 'builder_id = '.$this->builder_id.' AND account_type ='.OWNER.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')',SUBCONTRACTOR => 'builder_id = '.$this->builder_id.' AND account_type ='.SUBCONTRACTOR.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')',
						//Below owner_id code added by MS to dispaly owner in To,cc & bcc in messages
						OWNER => 'builder_id = '.$this->builder_id.' AND account_type ='.OWNER.' AND ub_user_id IN ('.$project_info['owner_id'].')' );
						return $this->Mod_user->get_users_by_type($args,'multiple');
					}
				}
				else if('yes' == $assigned_type && '' == $dropdown_type)
				{
					// Get all assigned users of the project
					if('' != $project_info['project_assigned_users'])
					{
						if($args['account_type'] == SUBCONTRACTOR)
						{
							$where_clause = 'USER.builder_id = '.$this->builder_id.' AND account_type ='.$account_type.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')';
							return $this->Mod_user->get_users(array(
										'select_fields' => array('ub_user_id', 'company as full_name','username'),
										'where_clause' => $where_clause,
										'join'=> array('sub_contractor'=>'Yes')
										));
						}else{
							$where_clause = 'USER.builder_id = '.$this->builder_id.' AND account_type ='.$account_type.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')';
							return $this->Mod_user->get_users(array(
										'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as full_name','username'),
										'where_clause' => $where_clause
										));
						}
					}
				}
				else if('no' == $assigned_type && '' == $dropdown_type)
				{
					// Get all unassigned users of the project
					if('' != $project_info['project_assigned_users'])
					{
						$where_clause = 'USER.builder_id = '.$this->builder_id.' AND account_type ='.$account_type.' AND ub_user_id NOT IN ('.$project_info['project_assigned_users'].')';
					}
					else
					{
						// echo '<pre>';print_r($this->builder_id);exit;
						$where_clause = 'USER.builder_id = '.$this->builder_id.' AND account_type ='.$account_type;
					}
					if($args['account_type'] == SUBCONTRACTOR)
					{
						return $this->Mod_user->get_users(array(
										'select_fields' => array('ub_user_id', 'company as full_name','username'),
										'where_clause' => $where_clause,
										'join'=>array('sub_contractor'=>'Yes')
										));
					}else{
						return $this->Mod_user->get_users(array(
										'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as full_name','username'),
										'where_clause' => $where_clause
										));
					}
				}
				$response['status'] = FALSE;
				//$response['message'] = 'No record found';
				return $response;
			}
			else
			{
				$response['status'] = FALSE;
				//$response['message'] = 'No record found';
			}
		}
		else
		{
			$response['status'] = FALSE;
			//$response['message'] = 'No record found';
		}
		return $response;
	}	
	/**
	*
	* Delete Meetings
	*
	* @method: delete_meetings
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function delete_meetings($delete_array)
	{
		if(isset($delete_array['ub_mom_id']))
		{
			foreach($delete_array['ub_mom_id'] as $key=>$ub_mom_id)
			{
				//$this->write_db->delete(UB_MOM, array('ub_mom_id' => $ub_mom_id));
				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_mom_id', $ub_mom_id);
				$this->write_db->update(UB_MOM, $post_array);

				/* Find folder id */
				$ui_folder_name = 'mom'.$ub_mom_id;
				/* Based on checklist id find project id */
				$project_id_array = $this->get_meeting(array(
					'select_fields' => array('MOM.project_id'),
					'where_clause' => array('MOM.ub_mom_id'=>$ub_mom_id),
					'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes')
				));
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_project->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_mom_id);
			}
			$data['status'] = TRUE;
			$data['message'] = 'Minutes of Meeting Deleted Successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'MOM id is not set';
		}
		return $data;
	}

	/** 
	*owner_email_invitation method will send the login invitation to the project owner 
	* 
	* @method: owner_email_invitation
	* @access: public 
	* @param: post data
	* @return: Boolean value 
	*/
	
	public function owner_email_invitation($post_array = array())
	{
		$response_ary = array();
		if(!empty($post_array))
		{
			$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
			$data = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
			$where = array('ub_user_id' => $post_array['owner_id']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);

			$builder_details = $this->Mod_builder->get_builder_details(array(
								'select_fields' => array('BUILDER_DETAILS.builder_name'),
								'where_clause' => array('ub_builder_id' => $this->user_session['builder_id'])
								));
			
			$reset_link = base_url().$this->crypt->encrypt('register/signup_index/'.$post_array['owner_id'].'/'.$builder_details['aaData'][0]['builder_name']);
			
			$content_array = array(
			'TO_EMAIL' => $post_array['primary_email'],
			'TO_NAME' => 'MS',
			'FIRST_NAME' => $post_array['name'],
			'builder_name' => $this->user_session['first_name'].' '.$this->user_session['last_name'],
			'RESET_LINK' => $reset_link,
			'SEND_MAIL_INFO' => $post_array['primary_email'].EMAIL_SEPERATOR_LEVEL2.$post_array['primary_email']
			);
			$this->Mod_mail->send_mail('SEND_INVITATION_EMAIL', $content_array, 'yes');
			$response_ary['status'] =  TRUE;
			$response_ary['message'] = 'Mail send to '.$post_array['primary_email'].' Sucessfully';
			//$response_ary['message'] = 'Success message will come here';
		}
		else
		{
			$response_ary['status'] =  FALSE;
			$response_ary['message'] = 'Failed message will come here';
		}
		return $response_ary;
	}
	/** 
	*check builder create project limit based on plan. 
	* 
	* @method: check_project_limit_based_plan
	* @access: public 
	* @param: post data
	* @author: Pranab
	* @return: Boolean value 
	*/
	public function check_project_limit_based_plan($post_array = array())
	{
	  $data = array();
	  if(isset($post_array))
	  {
	   $total_no_of_projects = $this->Mod_project->get_projects(array(
		                                     'select_fields' => array('count(PROJECT.ub_project_id) as no_of_projects'),
											 'where_clause' => array('PROJECT.builder_id'=>$post_array)
		 									 ));
		
          $plan_array = array('select_fields' => array('PLAN.no_of_projects'),	
		  'join'=> array('userplan'=>'Yes'),
		  'where_clause' => array('USER_PLAN.builder_id'=>$post_array,'USER_PLAN.status' => 'Active')); 
		   $user_plan = $this->Mod_plan->get_plan_details($plan_array);
		 if($user_plan['status'] == TRUE)
		  { 
			 if($user_plan['aaData'][0]['no_of_projects'] != -1)
			 {
				 if($total_no_of_projects['aaData'][0]['no_of_projects'] >= $user_plan['aaData'][0]['no_of_projects'])
				 {
			
				  $data['status'] = FALSE ;
				
				 }
				 else
				 {
					$data['status'] = TRUE;
				 }
			 }
			 else
			 {
			   $data['status'] = TRUE;
			 }
		 }
		 else
		 {
		   $data['status'] = TRUE;
		 } 
	 }
	 return $data;
   }
   /** 
	*insert subcontractor in project assign user table. 
	* 
	* @method: assign_project_subcontractor
	* @access: public 
	* @param: post data
	* @author: Pranab
	* @return: Boolean value 
	*/
   public function assign_project_subcontractor($post_array = array())
   {
   
       $data = array();
	   if(isset($post_array))
	   {
	   $subcontractor_array = array('select_fields' => 
	                           array('SUB.user_id'),
							   'where_clause' => array('SUB.builder_id' => $this->user_session['builder_id'],'SUB.access_to_all_projects' => 'Yes'));
							  
		$sub_contractors = $this->get_subcontractor($subcontractor_array);
		
		if(TRUE === $sub_contractors['status'])
		{
			for($i=0; $i < count($sub_contractors['aaData']);$i++)
			{

			 $assign[] = $sub_contractors['aaData'][$i]['user_id'] ;
			 $sub_user_array = array('project_id' => $post_array['project_id'],
								'builder_id' => $this->user_session['builder_id'],
								'role_id' => SUB_CONTRACTOR_ROLE_ID,
								'assigned_to'=> $sub_contractors['aaData'][$i]['user_id']);
			   $this->insert_project_assign_users($sub_user_array)	; 	 		
			}
			 
			 $assign_users = implode(",",$assign);
			 
			 $project_assign_users_array = array('select_fields' => 
								   array('PROJECT.project_assigned_users'),
								   'where_clause' => array('PROJECT.builder_id' => $this->user_session['builder_id'],'PROJECT.ub_project_id' => $post_array['project_id']));
								   
			 $assign_user_response = $this->get_projects($project_assign_users_array);

			$assign_array = array('project_assigned_users' => ",".$assign_users.",");
			$this->write_db->where('ub_project_id', $post_array['project_id']);
			$this->write_db->update(UB_PROJECT, $assign_array);
			//echo $this->write_db->last_query();
		}
		$data['status'] = TRUE;
	   }
   }
      /** 
	*get subcontractor from ub_subcontractor table. 
	* 
	* @method: get_subcontractor
	* @access: public 
	* @param: post data
	* @author: Pranab
	* @return: Boolean value 
	*/
   public function get_subcontractor($post_array = array())
     {
      $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
        $this->read_db->from(UB_SUBCONTRACTOR.' AS SUB');

      // Where condition
        if(isset($post_array['where_clause']))
        {
          $this->read_db->where($post_array['where_clause']);
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
	* get project id from any table
	*
	* @method: generate_number
	* @access: public 
	* @param: post data
	* @return: return data
	* @created by : satheesh kumar
	*/
	public function get_project_id($tablename, $args = array())
	{
		$this->read_db->select('project_id', FALSE);
		$this->read_db->from($tablename);
		// Where condition
		if(isset($args))
		{
			$this->read_db->where($args);
		}
		$res = $this->read_db->get();
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$project_info = $this->Mod_project->get_projects(array('select_fields' =>array('project_name'), 'where_clause' =>array('ub_project_id'=>$data['aaData'][0]['project_id'])));
			if(TRUE === $project_info['status'])
			{
				$data['aaData'][0]['project_name'] = $project_info['aaData'][0]['project_name'];
			}
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
	* Delete getting project assigned users
	*
	* @method: get_project_assigned_users
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function get_project_subcontractor_users($args)
	{
		$project_id = isset($args['ub_project_id'])?$args['ub_project_id']:0;
		$account_type = isset($args['account_type'])?$args['account_type']:'all';
		$assigned_type = isset($args['assigned_type'])?$args['assigned_type']:'yes';
		$dropdown_type = isset($args['dropdown_type'])?$args['dropdown_type']:'';
		if($project_id > 0)
		{
			$result = $this->get_projects(array(
								'select_fields' => array('trim(BOTH "," FROM PROJECT.project_assigned_users) AS project_assigned_users', 'owner_id'),
								'where_clause' => array('PROJECT.builder_id' =>$this->builder_id, 'PROJECT.ub_project_id' => $project_id)
								));
			if(TRUE === $result['status'])
			{
				$project_info = $result['aaData'][0];
				$project_info['project_assigned_users'] = trim($project_info['project_assigned_users'], ',');
				//Below owner_id code added by MS to display owner in To,cc & bcc in messages
				$project_info['owner_id'] = trim($project_info['owner_id'], ',');
				if('optgroup' == $dropdown_type && 'all' == $account_type)
				{
					// Get all assigned users of the project formatted as optgroup
					if('' != $project_info['project_assigned_users'])
					{
						$args = array(BUILDERADMIN => 'builder_id = '.$this->builder_id.' AND account_type ='.BUILDERADMIN.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')',OWNER => 'builder_id = '.$this->builder_id.' AND account_type ='.OWNER.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')',SUBCONTRACTOR => 'builder_id = '.$this->builder_id.' AND account_type ='.SUBCONTRACTOR.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')',
						//Below owner_id code added by MS to dispaly owner in To,cc & bcc in messages
						OWNER => 'builder_id = '.$this->builder_id.' AND account_type ='.OWNER.' AND ub_user_id IN ('.$project_info['owner_id'].')' );
						return $this->Mod_user->get_users_by_type($args,'multiple');
					}
				}
				else if('yes' == $assigned_type && '' == $dropdown_type)
				{
					// Get all assigned users of the project
					if('' != $project_info['project_assigned_users'])
					{
						$where_clause = 'USER.builder_id = '.$this->builder_id.' AND account_type ='.$account_type.' AND ub_user_id IN ('.$project_info['project_assigned_users'].')';
						return $this->Mod_user->get_users(array(
                                    'select_fields' => array('subcontractor_id', 'company as full_name','username'),
                                    'where_clause' => $where_clause,
                                    'join'=>array('sub_contractor'=>'yes')
                                    ));
					}
				}
				else if('no' == $assigned_type && '' == $dropdown_type)
				{
					// Get all unassigned users of the project
					if('' != $project_info['project_assigned_users'])
					{
						$where_clause = 'builder_id = '.$this->builder_id.' AND account_type ='.$account_type.' AND ub_user_id NOT IN ('.$project_info['project_assigned_users'].')';
					}
					else
					{
						$where_clause = 'USER.builder_id = '.$this->builder_id.' AND account_type ='.$account_type;
					}
					return $this->Mod_user->get_users(array(
                                    'select_fields' => array('subcontractor_id', 'company as full_name','username'),
                                    'where_clause' => $where_clause,
                                    'join'=>array('sub_contractor'=>'yes')
                                    ));
				}
				$response['status'] = FALSE;
				//$response['message'] = 'No record found';
				return $response;
			}
			else
			{
				$response['status'] = FALSE;
				//$response['message'] = 'No record found';
			}
		}
		else
		{
			$response['status'] = FALSE;
			//$response['message'] = 'No record found';
		}
		return $response;
	}	
	
	/* Below code was added by chandru for signoff 31-07-2015 */
	public function insert_in_signoff($post_array = array())
	{
		/* fILE STURCTURE CODE starts here */
				$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
					   'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => $post_array['project_id'],'ui_folder_name' => 'signoff'))
					   );
				$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
				// echo '<pre>';print_r($all_folder);exit;
				$file_data = array(      'flag' => 0,
						  'builder_id'    => $this->user_session['builder_id'],
						  'projectid' => $post_array['project_id'],
						  'createdby' => $this->user_session['ub_user_id'],
						  'modulename' => 'signoff',
						);

				$file_data['moduleid'] = $post_array['project_id'];
				$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
				foreach ($_FILES as $type => $properties)
				{
					if(isset($properties['name']) && !empty($properties['name']))
					{
						foreach ($properties as $name => $values)
						{
							for ($i = 0; $i < count($values); $i++)
							{
								 $result[$i][$name] = $values[$i];
							}
						}
					}
				}
				for ($i = 0; $i < count($result); $i++)
				{
					$file_data['filename'] = $result[$i]['name'];
					 if(isset($file_data['filename']) && !empty($file_data['filename']))
					{ 
					$result_array = $this->Mod_doc->insert_file($file_data);
					if ($result_array['0']['createfolderflag'] == 1)
					{
						$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
						if(TRUE === $response['status'])
						{
							$session_id = $this->session->userdata('session_id');
							move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
						}
					}
					else
					{
						$session_id = $this->session->userdata('session_id');
						move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
					}
					 }else{
						$result_array['0']['ub_doc_file_id'] = 0;
					} 
					/* file id contains particullar file id */
					$file_id[] = $result_array['0']['ub_doc_file_id'];
				}
				$insert_in_signoff_table = $this->insert_in_signoff_table($post_array,$file_id);
				if($insert_in_signoff_table == TRUE)
				{
					$data['status'] = TRUE;
					$data['project_id'] = $post_array['project_id'];
					$data['message'] = 'Data inserted successfully';
				}else{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Failed to insert the data';
				}
				return $data;
	}
	/* Insert project sign off added by chandru 06-08-2015 */
	public function insert_in_signoff_table($post_array,$file_id)
	{
		$sign_off_insert_array = array(
					'documentname' => $post_array['documentname'],
					'comments' => $post_array['comments'],
					'doc_file_id' => $file_id
					);
		for($i=0; $i<count($sign_off_insert_array['documentname']); $i++)
			{
				$cloned_data['documentname'] =  $sign_off_insert_array['documentname'][$i];
				$cloned_data['comments'] =  $sign_off_insert_array['comments'][$i];
				$cloned_data['doc_file_id'] =  $sign_off_insert_array['doc_file_id'][$i];
				$send_clone_data = $this->clone_data_value($post_array,$cloned_data);
			}
		return TRUE;
	}
   public function clone_data_value($post_array,$cloned_data)
	{
			
		$insert_signoff_clone_value = array(
				'builder_id' => $post_array['builder_id'],
				'user_id' => $post_array['user_id'],
				'project_id' => $post_array['project_id'],
				'doc_file_id' => $cloned_data['doc_file_id'],
				'document_name' => $cloned_data['documentname'],
				'comments' => $cloned_data['comments'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
			$result = $this->write_db->insert(UB_SIGNOFF_DOCUMENTS_INFO, $insert_signoff_clone_value);
			$sign_off_id = $this->write_db->insert_id();
	}
	/* Update project sign off added by chandru 06-08-2015 */
	public function update_in_signoff($post_array = array())
	{
		/* FILE STURCTURE CODE STARTS here */
		
			$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
					   'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => $post_array['project_id'],'ui_folder_name' => 'signoff'))
					   );
				$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
				// echo '<pre>';print_r($all_folder);exit;
				$file_data = array(      'flag' => 0,
						  'builder_id'    => $this->user_session['builder_id'],
						  'projectid' => $post_array['project_id'],
						  'createdby' => $this->user_session['ub_user_id'],
						  'modulename' => 'signoff',
						);

				$file_data['moduleid'] = $post_array['project_id'];
				$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
				foreach ($_FILES as $type => $properties)
				{
					if(isset($properties['name']) && !empty($properties['name']))
					{
						foreach ($properties as $name => $values)
						{
							for ($i = 0; $i < count($values); $i++)
							{
								 $result[$i][$name] = $values[$i];
							}
						}
					}
				}
				for ($i = 0; $i < count($result); $i++)
				{
					$file_data['filename'] = $result[$i]['name'];
					 if(isset($file_data['filename']) && !empty($file_data['filename']))
					{ 
					$result_array = $this->Mod_doc->insert_file($file_data);
					if ($result_array['0']['createfolderflag'] == 1)
					{
						$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
						if(TRUE === $response['status'])
						{
							$session_id = $this->session->userdata('session_id');
							move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
						}
					}
					else
					{
						$session_id = $this->session->userdata('session_id');
						move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
					}
					 }else{
						$result_array['0']['ub_doc_file_id'] = 0;
					} 
					/* file id contains particullar file id */
					$file_id[] = $result_array['0']['ub_doc_file_id'];
				}
		
		
		/* FILE STURCTURE CODE ENDS here */
		//Delete code
		if(isset($post_array['ub_signoff_documents_info_id']) && count(array_filter($post_array['ub_signoff_documents_info_id'])) > 0)
		{
			$this->write_db->where('project_id', $post_array['project_id']);
			$this->write_db->where_not_in('ub_signoff_documents_info_id', array_filter($post_array['ub_signoff_documents_info_id']));
			$this->write_db->delete(UB_SIGNOFF_DOCUMENTS_INFO);
		}
		else{
			$this->db->where('project_id', $post_array['project_id']);
			$this->db->delete(UB_SIGNOFF_DOCUMENTS_INFO);
		}
		/* Insert/Update code */
		if(isset($post_array['documentname']))
		{
			for($i=0; $i<count($post_array['documentname']); $i++)
			{
				if(isset($post_array['ub_signoff_documents_info_id'][$i]) && $post_array['ub_signoff_documents_info_id'][$i] > 0){
					// Update Query
					$update_ary = array();
					$update_ary['document_name'] = $post_array['documentname'][$i];
					$update_ary['comments'] = $post_array['comments'][$i];
					$update_ary['modified_by'] = $this->user_session['ub_user_id'];
					$update_ary['modified_on'] = TODAY;
					if(isset($file_id[$i]) && !empty($file_id[$i]) && $file_id[$i] != 0)
					{
						$update_ary['doc_file_id'] = $file_id[$i];
					} 
					$this->write_db->update(UB_SIGNOFF_DOCUMENTS_INFO, $update_ary, array('ub_signoff_documents_info_id'=>$post_array['ub_signoff_documents_info_id'][$i]));
				}else if(isset($post_array['documentname'][$i]) && !empty($post_array['documentname'][$i])){
					 // Insert Query
					$insert_ary = array();
					$insert_ary['document_name'] = $post_array['documentname'][$i];
					$insert_ary['user_id'] = $post_array['user_id'];
					$insert_ary['builder_id'] = $post_array['builder_id'];
					$insert_ary['project_id'] = $post_array['project_id'];
					$insert_ary['comments'] = $post_array['comments'][$i];
					$insert_ary['created_by'] = $this->user_session['ub_user_id'];
					$insert_ary['created_on'] = TODAY;
					$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
					$insert_ary['modified_on'] = TODAY;
					if(isset($file_id[$i]))
					{
						$insert_ary['doc_file_id'] = $file_id[$i];
					}else{
						$insert_ary['doc_file_id'] = 0;
					}
					/* if(isset($file_id[$i +1 ]))
					{
						$insert_ary['doc_file_id'] = $file_id[$i + 1];
					} */
					//echo '<pre>';print_r($insert_ary);exit;
					$this->write_db->insert(UB_SIGNOFF_DOCUMENTS_INFO, $insert_ary);
				}
			}
		}
		$data['status'] = TRUE;
		$data['project_id'] = $post_array['project_id'];
		$data['message'] = 'Updated successfully';
		return $data;
	}
	
	/**
	 *
	 *function to update the file id to 0 if file is deleted
	 *
	 */
	 public function update_signoff_document_file($file_id = '')
	 {
	 	$file_data = array(
			'doc_file_id' => 0
		);
		$this->write_db->where('doc_file_id', $file_id);
		$this->write_db->update(UB_SIGNOFF_DOCUMENTS_INFO, $file_data);
		$data['status'] = TRUE;
		$data['message'] = 'Deleted successfully';
		return $data;
	 }
	 
	 /* Update project status added by chandru 06-08-2015 */
	 public function change_project_signoff_status($post_array = array(), $project_id)
	{
		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		$post_array['signoff_date'] = TODAY;
		if( ! empty($post_array) && $project_id > 0)
		{
			$this->write_db->where('ub_project_id', $project_id);
			if($this->write_db->update(UB_PROJECT, $post_array))
			{
				$data['ub_project_id'] =  $project_id;
				$data['status'] = TRUE;
				$data['message'] = 'Data Updated successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to update project data';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	/* Update project sign off added by chandru 06-08-2015 */
	 public function update_in_project_table_signoff_details($post_array = array(), $project_id)
	{
		/* fILE STURCTURE CODE starts here */
				$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
					   'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => $project_id,'ui_folder_name' => 'signoff'))
					   );
				$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
				$file_data = array(      'flag' => 0,
						  'builder_id'    => $this->user_session['builder_id'],
						  'projectid' => $project_id,
						  'createdby' => $this->user_session['ub_user_id'],
						  'modulename' => 'signoff',
						);

				$file_data['moduleid'] = $project_id;
				$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
				foreach ($_FILES as $type => $properties)
				{
					if(isset($properties['name']) && !empty($properties['name']))
					{
						foreach ($properties as $name => $values)
						{
							for ($i = 0; $i < count($values); $i++)
							{
								 $result[$i][$name] = $values[$i];
							}
						}
					}
				}
				for ($i = 0; $i < count($result); $i++)
				{
					$file_data['filename'] = $result[$i]['name'];
					 if(isset($file_data['filename']) && !empty($file_data['filename']))
					{ 
					$result_array = $this->Mod_doc->insert_file($file_data);
					if ($result_array['0']['createfolderflag'] == 1)
					{
						$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
						if(TRUE === $response['status'])
						{
							$session_id = $this->session->userdata('session_id');
							move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
						}
					}
					else
					{
						$session_id = $this->session->userdata('session_id');
						move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
					}
					 }else{
						$result_array['0']['ub_doc_file_id'] = 0;
					} 
					/* file id contains particullar file id */
					$file_id = $result_array['0']['ub_doc_file_id'];
				}
	
		$post_array['signature_file_id'] = $file_id;
		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		if( ! empty($post_array) && $project_id > 0)
		{
			$this->write_db->where('ub_project_id', $project_id);
			if($this->write_db->update(UB_PROJECT, $post_array))
			{
				$data['ub_project_id'] =  $project_id;
				$data['status'] = TRUE;
				$data['message'] = 'Data Updated successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to update project data';
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
	* Add Signature
	*
	* @method: add_signature
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_signature($post_array = array())
	{
		if( ! empty($post_array))
		{

			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->write_db->where('ub_project_id', $post_array['ub_project_id']);
			if($this->write_db->update(UB_PROJECT, $post_array))
			{
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
				/* Notification code was added by chandru 01-06-2015 */
				
				$data['insert_id'] = $post_array['ub_project_id'];
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
	
	/* Below function was added bh chandru for project count. */
	public function get_project_count()
	{
		$builder_id = $this->builder_id;
		/* Based on builder id find plan_id */
		$order_by = 'USER_PLAN.ub_user_plan_id desc LIMIT 1';
		$where_condition = array('builder_id'=>$builder_id);
		$plan_args = array('select_fields' => array('USER_PLAN.created_on','plan_name','no_of_projects'),
				'join'=> array('userplan'=>'Yes'),
				'where_clause' => $where_condition,
				'order_clause' => $order_by);

		// The following parameters required for data table
		$plan_data = $this->Mod_plan->get_plan_details($plan_args); 
		if(TRUE == $plan_data['status'])
		{
			$plan_array = $plan_data['aaData'][0];
			$no_of_projects = $plan_data['aaData'][0]['no_of_projects'];
			$plan_start_date = date($plan_array['created_on']);
			$plan_start_date = new DateTime($plan_start_date);
			$plan_start_date = $plan_start_date->format('Y-m-d');
			$plan_start_date = new DateTime($plan_start_date);
			$current_date = new DateTime(TODAY);
			$current_date = $current_date->format('Y-m-d');
			$current_date = new DateTime($current_date);
			$interval = $current_date->diff($plan_start_date);
			$interval = $interval->format('%y');
			// echo '<pre>';print_r($interval);exit;
			if(isset($interval) && !empty($interval))
			{
				$plan_from_year = $interval + 1;
				$no_of_projects = ($no_of_projects * $plan_from_year);
			}else{
				$no_of_projects = $no_of_projects;
			}
		}else{
			$no_of_projects = 0;
		}
		return $no_of_projects;
	}
	
	/* Below function was addded by chandru 28-09-2015 */
	public function add_in_project_and_access_table($project_ids = '',$sub_contracor_id = 0,$type = '')
	{
		if((isset($project_ids) && !empty($project_ids)) && ($sub_contracor_id > 0))
		{
			/* Find user id for subcontractors */
			$where_builder_str = array('subcontractor_id' => $sub_contracor_id );
			$get_builder_user_id = array(
							'select_fields' => array('ub_user_id'),
							'where_clause' => $where_builder_str
							);
			$subcontractor_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
			$subcontractor_user_id = $subcontractor_user_id_details['aaData'][0]['ub_user_id'];
			$project_explode_array = explode(',',$project_ids);
			$formate_project_id_arrays = array_filter($project_explode_array);
			$formate_project_id_array = implode(',',$formate_project_id_arrays);
			
			$replace_id = ','.$subcontractor_user_id;
			
			$query_for_remove_exist = $this->write_db->query("UPDATE ub_project SET project_assigned_users = REPLACE(project_assigned_users, '$replace_id', '')"); 
			
			$insert_replace_id = $subcontractor_user_id.',';
			$insert_replace_id_both_place = ','.$subcontractor_user_id.',';
			
			$query_for_add = $this->write_db->query("UPDATE ub_project SET project_assigned_users = if((project_assigned_users != NULL || project_assigned_users != ''),CONCAT(project_assigned_users ,'$insert_replace_id'), CONCAT(project_assigned_users,'$insert_replace_id_both_place')) WHERE `ub_project_id` IN ($formate_project_id_array)"); 
			// echo $query_for_add;
			// echo $this->write_db->last_query();exit;
			if(isset($type) && $type == 'add')
			{
				$project_assigned_user_array = array(
						'builder_id' 	 =>$this->builder_id,
						'role_id'		 =>SUB_CONTRACTOR_ROLE_ID,
						'assigned_to' 	 =>$subcontractor_user_id
						);
				foreach($formate_project_id_arrays as $update_project_id)
				{
					$project_assigned_user_array['project_id'] = $update_project_id;
					$project_assigned_user_insert = $this->insert_project_assign_users($project_assigned_user_array);
				}
			}
			if(isset($type) && $type == 'edit')
			{
				$assign_builder = $this->Mod_project->get_assigned_role_ids(array(
					'select_fields' => array('GROUP_CONCAT(PROJECTASSIGNED.project_id) as project_details'),
					'where_clause' => (array('PROJECTASSIGNED.role_id' => SUB_CONTRACTOR_ROLE_ID,'PROJECTASSIGNED.assigned_to'=>$subcontractor_user_id))
					));
				if($assign_builder['status'] == TRUE)
				{
					$old_project_assigned_to =  $assign_builder['aaData'][0]['project_details'];
				}else{
					$old_project_assigned_to = '';
				}
				if(isset($old_project_assigned_to) && !empty($old_project_assigned_to))
				{
					$old_project_assigned_to_array = explode(",",$old_project_assigned_to);
					$insert_array_diff = array_diff($formate_project_id_arrays, $old_project_assigned_to_array);
					$delete_array_diff = array_diff($old_project_assigned_to_array, $formate_project_id_arrays);
				}
				
				if(isset($insert_array_diff) && !empty($insert_array_diff))
				{
					$project_assigned_user_array = array(
						'builder_id' 	 =>$this->builder_id,
						'role_id'		 =>SUB_CONTRACTOR_ROLE_ID,
						'assigned_to' 	 =>$subcontractor_user_id
						);
					foreach($insert_array_diff as $update_project_id)
					{
						$project_assigned_user_array['project_id'] = $update_project_id;
						$project_assigned_user_insert = $this->insert_project_assign_users($project_assigned_user_array);
					}
				}
				
				
				if(isset($delete_array_diff) && !empty($delete_array_diff)){
				foreach($delete_array_diff as $delete_project_id)
					{
					$this->write_db->where('assigned_to', $subcontractor_user_id);
					$this->write_db->where('project_id', $delete_project_id);
					$this->write_db->delete(UB_PROJECT_ASSIGNED_USERS);
					}
				}
			}
		}
		if(empty($project_ids) && $type == 'edit')
		{
			if($sub_contracor_id > 0)
			{
				$where_builder_str = array('subcontractor_id' => $sub_contracor_id );
				$get_builder_user_id = array(
								'select_fields' => array('ub_user_id'),
								'where_clause' => $where_builder_str
								);
				$subcontractor_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
				$subcontractor_user_id = $subcontractor_user_id_details['aaData'][0]['ub_user_id'];
				$replace_id = ','.$subcontractor_user_id;
				$query_for_remove_exist = $this->write_db->query("UPDATE ub_project SET project_assigned_users = REPLACE(project_assigned_users, '$replace_id', '')");
				$this->write_db->where('assigned_to', $subcontractor_user_id);
				$this->write_db->where('role_id', SUB_CONTRACTOR_ROLE_ID);
				$this->write_db->delete(UB_PROJECT_ASSIGNED_USERS);
			}
			
		}
	}
}	


/* End of file mod_project.php */
/* Location: ./application/models/mod_project.php */