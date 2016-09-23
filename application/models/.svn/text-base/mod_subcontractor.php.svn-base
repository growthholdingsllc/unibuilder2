<?php
/** 
 * Subcontractor Model
 * 
 * @package: Subcontractor Model
 * @subpackage: Subcontractor Model
 * @category: Subcontractor
 * @author: Chandru
 * @createdon(DD-MM-YYYY): 21-04-2015
*/
class Mod_subcontractor extends UNI_Model
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
		$this->ub_user_id = 0;
		parent::__construct();
		$this->load->model('Mod_mail','Mod_user');
    }
	//created by chandru
	public function add_in_sub_contractor_table_and_user_table($post_array)
	{
		$results = $this->Mod_user->get_users(array(
							'select_fields' => array('USER.ub_user_id', 'USER.username'),
							'where_clause' => array('USER.username' => $post_array['username'])
							));
		if($post_array['accessmethod'] == 'configure')
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
		if(FALSE === $results['status'])
	   {
		$insert_in_sub_contractor_table = array( 
		'builder_id' => $post_array['builder_id'],
		'user_id' => $post_array['user_id'],
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
			$sub_contracor_id = $data['insert_id'];
			$insert_in_user_table  = $this->insert_in_user_table($sub_contracor_id,$post_array); 
			if(!empty($insert_in_user_table))
			{
				$update_user_id_in_sub_contractor_table = array( 
					'user_id' => $insert_in_user_table,
					'modified_on' => TODAY,
					'modified_by' => $insert_in_user_table
					);
				$this->write_db->where('ub_subcontractor_id', $sub_contracor_id);
				$this->write_db->update(UB_SUBCONTRACTOR, $update_user_id_in_sub_contractor_table);
				/* fILE STURCTURE CODE starts here */
				$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
					   'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'user'))
					   );
				$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
				$file_data = array(      'flag' => 2,
						  'builder_id'    => $this->user_session['builder_id'],
						  'projectid' => 0,
						  'createdby' => $this->user_session['ub_user_id'],
						  'modulename' => $this->module,
						);

				$file_data['moduleid'] = $sub_contracor_id;
				$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
				foreach ($_FILES as $type => $properties)
				{
					foreach ($properties as $name => $values)
					{
						for ($i = 0; $i < count($values); $i++)
						{
							 $result[$i][$name] = $values[$i];
						}
					}
				}
				for ($i = 0; $i < count($result); $i++)
				{
					$file_data['filename'] = $result[$i]['name'];
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
					$file_id[] = $result_array['0']['ub_doc_file_id'];
				}
				$insert_in_sub_contractor_add_table = $this->insert_in_subcontracor_additional_info_table($insert_in_user_table,$post_array,$sub_contracor_id,$file_id);
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
			}
		   }
		  }
		   else{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Username already exists';
		   }
		 }
		}
		else
		{
			$insert_in_sub_contractor_table = array( 
		'builder_id' => $post_array['builder_id'],
		'user_id' => $post_array['user_id'],
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
			$sub_contracor_id = $data['insert_id'];
			$insert_in_user_table  = $this->insert_in_user_table($sub_contracor_id,$post_array); 
			if(!empty($insert_in_user_table))
			{
				$update_user_id_in_sub_contractor_table = array( 
					'user_id' => $insert_in_user_table,
					'modified_on' => TODAY,
					'modified_by' => $insert_in_user_table
					);
				$this->write_db->where('ub_subcontractor_id', $sub_contracor_id);
				$this->write_db->update(UB_SUBCONTRACTOR, $update_user_id_in_sub_contractor_table);
				/* fILE STURCTURE CODE starts here */
				$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
					   'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'user'))
					   );
				$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
				$file_data = array(      'flag' => 2,
						  'builder_id'    => $this->user_session['builder_id'],
						  'projectid' => 0,
						  'createdby' => $this->user_session['ub_user_id'],
						  'modulename' => $this->module,
						);

				$file_data['moduleid'] = $sub_contracor_id;
				$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
				foreach ($_FILES as $type => $properties)
				{
					foreach ($properties as $name => $values)
					{
						for ($i = 0; $i < count($values); $i++)
						{
							 $result[$i][$name] = $values[$i];
						}
					}
				}
				for ($i = 0; $i < count($result); $i++)
				{
					$file_data['filename'] = $result[$i]['name'];
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
					$file_id[] = $result_array['0']['ub_doc_file_id'];
				}
				if(isset($post_array['certificate_name']) && !empty($post_array['certificate_name']))
				{
				$insert_in_sub_contractor_add_table = $this->insert_in_subcontracor_additional_info_table($insert_in_user_table,$post_array,$sub_contracor_id,$file_id);
				}
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
			
		
		return $data;
	}
	
	//Insert in user table
	public function insert_in_subcontracor_additional_info_table($insert_in_user_table,$post_array = array(),$sub_contracor_id,$doc_file_id)
	{
		/* $user_table_insert_array = array(
				'builder_id' => $post_array['builder_id'],
				'subcontractor_id' => $insert_in_user_table,
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
			//echo '<pre>';print_r($user_table_insert_array);exit;
			$this->write_db->insert(UB_USER, $user_table_insert_array);
			//echo $this->write_db->last_query();
			$user_table_insert_id =  $this->write_db->insert_id();
			
			return $user_table_insert_id; */
		 if(isset($post_array['certificate_name']) && !empty($post_array['certificate_name']))
			{ 
				$subcontractor_additional_info_insert_array = array(
					'certificate_name' => $post_array['certificate_name'],
					'reminder_start_date' => $post_array['reminder_start_date'],
					'reminder_type' => $post_array['reminder_type'],
					'reminds_in_days' => $post_array['reminds_in_days'],
					'doc_file_id' => $doc_file_id
					); 
				for($i=0; $i<count($subcontractor_additional_info_insert_array['certificate_name']); $i++)
				{
					$cloned_data['certificate_name'] =  $subcontractor_additional_info_insert_array['certificate_name'][$i];
					$cloned_data['reminder_start_date'] =  $subcontractor_additional_info_insert_array['reminder_start_date'][$i];
					$cloned_data['reminder_type'] =  $subcontractor_additional_info_insert_array['reminder_type'][$i];
					$cloned_data['reminds_in_days'] =  $subcontractor_additional_info_insert_array['reminds_in_days'][$i];
					$cloned_data['doc_file_id'] =  $subcontractor_additional_info_insert_array['doc_file_id'][$i];
					$send_clone_data = $this->clone_data_value($insert_in_user_table,$cloned_data,$sub_contracor_id);
					
				}
			 } 
			 return 'inserted';
	}
	
	public function clone_data_value($insert_in_user_table,$cloned_data,$sub_contracor_id)
	{
			$source = $cloned_data['reminder_start_date'];
			$date = new DateTime($source);
			$newDate = $date->format('Y-m-d');
		$task_check_list_table_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'user_id' => $insert_in_user_table,
				'certificate_name' => $cloned_data['certificate_name'],
				'doc_file_id' => $cloned_data['doc_file_id'],
				'reminder_start_date' => $newDate,
				'expiry_date' => $newDate,
				'reminder_type' => $cloned_data['reminder_type'],
				'reminds_in_days' => $cloned_data['reminds_in_days'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
		//$this->builder_id = (isset($task_check_list_table_insert_array['builder_id']))?$task_check_list_table_insert_array['builder_id']:$this->builder_id;
		$result = $this->write_db->insert('ub_subcontractor_addition_info', $task_check_list_table_insert_array);
		$certificat_id = $this->write_db->insert_id();
		/* Add reminder */
		$reminder_time = $cloned_data['reminds_in_days'] * 1440;
		/* Parse array for mail template */
		$parse_data = array(
					'certificate_name' => $cloned_data['certificate_name'],
					'expiry_date' => $newDate
				);
		$reminder_table_insert_array = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $this->project_id,
					'module_name' => $this->module,
					'module_pk_id' => $certificat_id,
					'reminder_type' => $cloned_data['reminder_type'],
					'reminder_sent_to' => $insert_in_user_table,
					'reminder_sent_on' => $newDate,
					'reminder_end_time' => $newDate,
					'reminder_duration' => $reminder_time,
					'template_name' => 'sub_certificate_expiry',
					'status' => 'Not Send',
					'parse_data' => $parse_data
					);
		$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
	}
	
	//Insert in user table
	public function insert_in_user_table($sub_contracor_id,$post_array = array())
	{
		$password =  $this->Mod_user->encrypt_password($post_array['password']);
		if(TRUE === $password['status'])
		{
		  $password = $password['encrypt_password'];
		}
		else
		{
		  $password = '';
		}
		if(isset($post_array['login_enabled']) && $post_array['login_enabled'] == 'Yes')
		{
			$user_status = 'Active';
		}else{
			$user_status = 'Inactive';
		}
		$user_table_insert_array = array(
				'builder_id' => $post_array['builder_id'],
				'subcontractor_id' => $sub_contracor_id,
				'account_type' => 300,
				'role_id' => $post_array['role_id'],
				'username' => $post_array['username'],
				'password' => $password,
				'first_name' => $post_array['first_name'],
				'desk_phone' => $post_array['desk_phone'],
				'mobile_phone' => $post_array['mobile_phone'],
				'first_name' => $post_array['first_name'],
				'primary_email' => $post_array['primary_email'],
				'alternative_email' => $post_array['alternative_email'],
				'address' => $post_array['address'],
				'city' => $post_array['city'],
				'province' => $post_array['province'],
				'postal' => $post_array['postal'],
				'country' => $post_array['country'],
				'user_status' => $user_status,
				'time_zone' => $post_array['time_zone'],
				'date_format' => $post_array['date_format'],
				'login_enabled' => $post_array['login_enabled'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY
			);
			//echo '<pre>';print_r($user_table_insert_array);exit;
			$this->write_db->insert(UB_USER, $user_table_insert_array);
			//echo $this->write_db->last_query();
			$user_table_insert_id =  $this->write_db->insert_id();
			
			return $user_table_insert_id;
	}
	
	//Get sub_contractor
	
	public function get_sub_contractors($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SUBCONTRACTOR.' AS UB_SUBCONTRACTOR');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
		$this->read_db->join(UB_USER.' AS UB_USER','UB_USER.ub_user_id = UB_SUBCONTRACTOR.user_id');
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
	
	public function get_sub_contractor($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SUBCONTRACTOR.' AS UB_SUBCONTRACTOR');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder']))
		{
		$this->read_db->join(UB_USER.' AS UB_USER','UB_USER.ub_user_id = UB_SUBCONTRACTOR.user_id');
		}
		if(isset($args['join']['additionalinfo']) && 'yes' === strtolower($args['join']['additionalinfo']))
		{
		$this->read_db->join('ub_subcontractor_addition_info'.' AS ub_subcontractor_addition_info','UB_USER.ub_user_id = ub_subcontractor_addition_info.user_id');
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
		/* echo 1;
		echo '<pre>';print_r($_FILES);exit; */
		/* fILE STURCTURE CODE starts here */
		if($post_array['accessmethod'] == 'configure')
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
			  $get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'user'))
                               );
                    $all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
					// echo '<pre>';print_r($all_folder);exit;
                    $file_data = array(      'flag' => 2,
                                  'builder_id'    => $this->user_session['builder_id'],
                                  'projectid' => 0,
                                  'createdby' => $this->user_session['ub_user_id'],
                                  'modulename' => $this->module,
                                );

                        $file_data['moduleid'] = $post_array['ub_subcontractor_id'];
                        $file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
						if(isset($_FILES) && !empty($_FILES))
						{
						foreach ($_FILES as $type => $properties)
						{
							foreach ($properties as $name => $values)
							{
								for ($i = 0; $i < count($values); $i++)
								{
									if(isset($values[$i]) && !empty($values[$i]))
									{
									 $result[$i][$name] = $values[$i];
									 }
								}
							}
						}
						}
						for ($i = 0; $i < count($result); $i++)
						{
							if(isset($result[$i]['name']))
							{
							 $file_data['filename'] = $result[$i]['name'];
							}else{
								$file_data['filename'] = '';
							}
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
							$file_id[] = $result_array['0']['ub_doc_file_id'];
						}
						/* echo '<pre>';print_r($file_id);exit; */
						/* File structure code ends here */
		
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
		//Update in user_table
		$password_result = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.password'),
								'where_clause' => array('USER.subcontractor_id' => $data['insert_id'])
								));
		//print_r($password_result);exit;
		if($password_result['aaData'][0]['password'] != $post_array['password']){
		$password =  $this->Mod_user->encrypt_password($post_array['password']);
		if(TRUE === $password['status'])
		{
			$password = $password['encrypt_password'];
		}
		else
		{
			$password = '';
		}
		}
		else
		{
			$password = $post_array['password'];
		}
		$update_row_id = $data['insert_id'];
		if(isset($post_array['login_enabled']) && $post_array['login_enabled'] == 'Yes')
		{
			$user_status = 'Active';
		}else{
			$user_status = 'Inactive';
		}
		$user_table_update_main_array = array(
					'login_enabled' => $post_array['login_enabled'],
					'username' => $post_array['username'],
					'password' => $password,
					'first_name' => $post_array['first_name'],
					'primary_email' => $post_array['primary_email'],
					'alternative_email' => $post_array['alternative_email'],
					'country' => $post_array['country'],
					'user_status' => $user_status,
					'role_id' => $post_array['role_id'],
					'time_zone' => $post_array['time_zone'],
					'date_format' => $post_array['date_format'],
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
					);
		$this->write_db->where('subcontractor_id', $update_row_id);
		$this->write_db->update(UB_USER, $user_table_update_main_array);
		//echo '<pre>';print_r($post_array);exit;
		//Delete code
		if(isset($post_array['certificate_id']) && count(array_filter($post_array['certificate_id'])) > 0){
			//echo $this->user_session['ub_user_id'];exit;\
			$post_arrays = implode(',',$post_array['certificate_id']);
			$this->write_db->where('user_id', $post_array['user_id']);
			$this->write_db->where_not_in('ub_subcontractor_addition_info_id', array_filter($post_array['certificate_id']));
			$this->write_db->delete('ub_subcontractor_addition_info');
			//echo $this->write_db->last_query();exit;
			/* Delete in reminder table */
			$reminder_array['is_delete'] = 'Yes';
			$reminder_array['modified_by'] = $this->user_session['ub_user_id'];
			$reminder_array['modified_on'] = TODAY;
			// $post_arrays['certificate_id'] = implode(',',$post_array['certificate_id']);
			$this->write_db->where(array('module_name'=>'subcontractor','builder_id'=>$this->builder_id));
			$this->write_db->where_not_in('module_pk_id', array_filter($post_array['certificate_id']));
			$this->write_db->update(UB_REMINDER, $reminder_array);
		}
		else{
			$this->db->where('user_id', $post_array['user_id']);
			$this->db->delete('ub_subcontractor_addition_info');
			/* Delete in reminder table */
			$reminder_array['is_delete'] = 'Yes';
			$reminder_array['modified_by'] = $this->user_session['ub_user_id'];
			$reminder_array['modified_on'] = TODAY;
			$this->write_db->where(array('module_name' => 'subcontractor','builder_id' => $this->builder_id));
			$this->write_db->update(UB_REMINDER, $reminder_array);
		}
		//Insert/update code
		if(isset($post_array['certificate_name'])){
			for($i=0; $i<count($post_array['certificate_name']); $i++){
				if(isset($post_array['certificate_id'][$i]) && $post_array['certificate_id'][$i] > 0){
					// Update Query
					$update_ary = array();
					$update_ary['certificate_name'] = $post_array['certificate_name'][$i];
					$update_ary['reminder_start_date'] = $post_array['reminder_start_date'][$i];
					$update_ary['reminder_type'] = $post_array['reminder_type'][$i];
					$update_ary['reminds_in_days'] = $post_array['reminds_in_days'][$i];
					$update_ary['modified_by'] = $this->user_session['ub_user_id'];
					$update_ary['modified_on'] = TODAY;
					if(isset($file_id[$i]) && !empty($file_id[$i]) && $file_id[$i] != 0)
					{
						$update_ary['doc_file_id'] = $file_id[$i];
					}
					$this->write_db->update('ub_subcontractor_addition_info', $update_ary, array('ub_subcontractor_addition_info_id'=>$post_array['certificate_id'][$i]));
					/* Update in reminder table */
					$reminder_time = $post_array['reminds_in_days'][$i] * 1440;
					$source = $post_array['reminder_start_date'][$i];
					$date = new DateTime($source);
					$newDate = $date->format('Y-m-d');
					$reminder_table_insert_array = array(
								'builder_id' => $this->user_session['builder_id'],
								'module_name' => $this->module,
								'module_pk_id' => $post_array['certificate_id'][$i],
								'reminder_sent_on' => $newDate,
								'reminder_sent_to' => $post_array['user_id'],
								'reminder_end_time' => $newDate,
								'reminder_duration' => $reminder_time,
								'status' => 'Not Send'
								);
					$update_in_reminder_table  = $this->Mod_reminder->update_reminder($reminder_table_insert_array);
				}
				else if(isset($post_array['certificate_name'][$i]) && !empty($post_array['certificate_name'][$i])){ 
				/* else{ */
					 // Insert Query
					$insert_ary = array();
					$insert_ary['builder_id'] = $this->user_session['builder_id'];
					$insert_ary['user_id'] = $post_array['user_id'];
					$insert_ary['certificate_name'] = $post_array['certificate_name'][$i];
					$insert_ary['reminder_start_date'] = $post_array['reminder_start_date'][$i];
					$insert_ary['reminder_type'] = $post_array['reminder_type'][$i];
					$insert_ary['reminds_in_days'] = $post_array['reminds_in_days'][$i];
					$insert_ary['created_by'] = $this->user_session['ub_user_id'];
					$insert_ary['created_on'] = TODAY;
					$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
					$insert_ary['modified_on'] = TODAY;
					if(isset($file_id[$i]) && !empty($file_id[$i]) && $file_id[$i] != 0)
					{
						$insert_ary['doc_file_id'] = $file_id[$i];
					}else{
						$insert_ary['doc_file_id'] = 0;
					}
					//echo '<pre>';print_r($insert_ary);exit;
					$certificat_id = $this->write_db->insert('ub_subcontractor_addition_info', $insert_ary);
					/* Insert in reminder table */
					/* Parse array for mail template */
					$source = $post_array['reminder_start_date'][$i];
					$date = new DateTime($source);
					$newDate = $date->format('Y-m-d');
					$parse_data = array(
							'certificate_name' => $post_array['certificate_name'][$i],
							'expiry_date' => $newDate
						);
					$reminder_time = $post_array['reminds_in_days'][$i] * 1440;
					$reminder_table_insert_array = array(
							'builder_id' => $this->user_session['builder_id'],
							'project_id' => 0,
							'module_name' => $this->module,
							'module_pk_id' => $this->write_db->insert_id(),
							'reminder_type' => $post_array['reminder_type'][$i],
							'reminder_sent_to' => $post_array['user_id'],
							'reminder_sent_on' => $newDate,
							'reminder_end_time' => $newDate,
							'reminder_duration' => $reminder_time,
							'template_name' => 'sub_certificate_expiry',
							'status' => 'Not Send',
							'parse_data' => $parse_data
							);
					$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
				}
			}
		}
		$data['status'] = TRUE;
		$data['message'] = 'Updated successfully';
		  }
		} else{	
                    $get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => 'user'))
                               );
                    $all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
					// echo '<pre>';print_r($all_folder);exit;
                    $file_data = array(      'flag' => 2,
                                  'builder_id'    => $this->user_session['builder_id'],
                                  'projectid' => 0,
                                  'createdby' => $this->user_session['ub_user_id'],
                                  'modulename' => $this->module,
                                );

                        $file_data['moduleid'] = $post_array['ub_subcontractor_id'];
                        $file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
						if(isset($_FILES) && !empty($_FILES))
						{
						foreach ($_FILES as $type => $properties)
						{
							foreach ($properties as $name => $values)
							{
								for ($i = 0; $i < count($values); $i++)
								{
									if(isset($values[$i]) && !empty($values[$i]))
									{
									 $result[$i][$name] = $values[$i];
									 }
								}
							}
						}
						}
						for ($i = 0; $i < count($result); $i++)
						{
							if(isset($result[$i]['name']))
							{
							 $file_data['filename'] = $result[$i]['name'];
							}else{
								$file_data['filename'] = '';
							}
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
							$file_id[] = $result_array['0']['ub_doc_file_id'];
						}
						/* echo '<pre>';print_r($file_id);exit; */
						/* File structure code ends here */
		
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
		//Update in user_table
		$password_result = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.password'),
								'where_clause' => array('USER.subcontractor_id' => $data['insert_id'])
								));
		//print_r($password_result);exit;
		if($password_result['aaData'][0]['password'] != $post_array['password']){
		$password =  $this->Mod_user->encrypt_password($post_array['password']);
		if(TRUE === $password['status'])
		{
			$password = $password['encrypt_password'];
		}
		else
		{
			$password = '';
		}
		}
		else
		{
			$password = $post_array['password'];
		}
		$update_row_id = $data['insert_id'];
		if(isset($post_array['login_enabled']) && $post_array['login_enabled'] == 'Yes')
		{
			$user_status = 'Active';
		}else{
			$user_status = 'Inactive';
		}
		$user_table_update_main_array = array(
					'login_enabled' => $post_array['login_enabled'],
					'username' => $post_array['username'],
					'password' => $password,
					'first_name' => $post_array['first_name'],
					'primary_email' => $post_array['primary_email'],
					'alternative_email' => $post_array['alternative_email'],
					'country' => $post_array['country'],
					'role_id' => $post_array['role_id'],
					'user_status' => $user_status,
					'time_zone' => $post_array['time_zone'],
					'date_format' => $post_array['date_format'],
					'modified_by' => $this->user_session['ub_user_id'], 
					'modified_on' => TODAY
					);
		$this->write_db->where('subcontractor_id', $update_row_id);
		$this->write_db->update(UB_USER, $user_table_update_main_array);
		//echo '<pre>';print_r($post_array);exit;
		//Delete code
		if(isset($post_array['certificate_id']) && count(array_filter($post_array['certificate_id'])) > 0){
			//echo $this->user_session['ub_user_id'];exit;
			$this->write_db->where('user_id', $post_array['user_id']);
			$post_arrays['certificate_id'] = implode(',',$post_array['certificate_id']);
			$this->write_db->where_not_in('ub_subcontractor_addition_info_id', array_filter($post_array['certificate_id']));
			$this->write_db->delete('ub_subcontractor_addition_info');
			//echo $this->write_db->last_query();exit;
			/* Delete in reminder table */
			$reminder_array['is_delete'] = 'Yes';
			$reminder_array['modified_by'] = $this->user_session['ub_user_id'];
			$reminder_array['modified_on'] = TODAY;
			
			$this->write_db->where(array('module_name'=>'subcontractor','builder_id'=>$this->builder_id));
			$this->write_db->where_not_in('module_pk_id', $post_array['certificate_id']);
			$this->write_db->update(UB_REMINDER, $reminder_array);
		}
		else{
			$this->db->where('user_id', $post_array['user_id']);
			$this->db->delete('ub_subcontractor_addition_info');
			/* Delete in reminder table */
			$reminder_array['is_delete'] = 'Yes';
			$reminder_array['modified_by'] = $this->user_session['ub_user_id'];
			$reminder_array['modified_on'] = TODAY;
			$this->write_db->where(array('module_name'=>'subcontractor','builder_id'=>$this->builder_id));
			$this->write_db->update(UB_REMINDER, $reminder_array);
		}
		//Insert/update code
		if(isset($post_array['certificate_name'])){
			for($i=0; $i<count($post_array['certificate_name']); $i++){
				if(isset($post_array['certificate_id'][$i]) && $post_array['certificate_id'][$i] > 0){
					// Update Query
					$update_ary = array();
					$update_ary['certificate_name'] = $post_array['certificate_name'][$i];
					$update_ary['reminder_start_date'] = $post_array['reminder_start_date'][$i];
					$update_ary['reminder_type'] = $post_array['reminder_type'][$i];
					$update_ary['reminds_in_days'] = $post_array['reminds_in_days'][$i];
					$update_ary['modified_by'] = $this->user_session['ub_user_id'];
					$update_ary['modified_on'] = TODAY;
					if(isset($file_id[$i]) && !empty($file_id[$i]) && $file_id[$i] != 0)
					{
						$update_ary['doc_file_id'] = $file_id[$i];
					}
					$this->write_db->update('ub_subcontractor_addition_info', $update_ary, array('ub_subcontractor_addition_info_id'=>$post_array['certificate_id'][$i]));
					/* Update in reminder table */
					$reminder_time = $post_array['reminds_in_days'][$i] * 1440;
					$source = $post_array['reminder_start_date'][$i];
					$date = new DateTime($source);
					$newDate = $date->format('Y-m-d');
					$reminder_table_insert_array = array(
								'builder_id' => $this->user_session['builder_id'],
								'module_name' => $this->module,
								'module_pk_id' => $post_array['certificate_id'][$i],
								'reminder_sent_on' => $newDate,
								'reminder_sent_to' => $post_array['user_id'],
								'reminder_end_time' => $newDate,
								'reminder_duration' => $reminder_time,
								'status' => 'Not Send'
								);
					$update_in_reminder_table  = $this->Mod_reminder->update_reminder($reminder_table_insert_array);
				}
				else if(isset($post_array['certificate_name'][$i]) && !empty($post_array['certificate_name'][$i])){ 
				/* else{ */
					 // Insert Query
					$insert_ary = array();
					$insert_ary['builder_id'] = $this->user_session['builder_id'];
					$insert_ary['user_id'] = $post_array['user_id'];
					$insert_ary['certificate_name'] = $post_array['certificate_name'][$i];
					$insert_ary['reminder_start_date'] = $post_array['reminder_start_date'][$i];
					$insert_ary['reminder_type'] = $post_array['reminder_type'][$i];
					$insert_ary['reminds_in_days'] = $post_array['reminds_in_days'][$i];
					$insert_ary['created_by'] = $this->user_session['ub_user_id'];
					$insert_ary['created_on'] = TODAY;
					$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
					$insert_ary['modified_on'] = TODAY;
					if(isset($file_id[$i]) && !empty($file_id[$i]) && $file_id[$i] != 0)
					{
						$insert_ary['doc_file_id'] = $file_id[$i];
					}else{
						$insert_ary['doc_file_id'] = 0;
					}
					//echo '<pre>';print_r($insert_ary);exit;
					$certificat_id = $this->write_db->insert('ub_subcontractor_addition_info', $insert_ary);
					/* Insert in reminder table */
					/* Parse array for mail template */
					$source = $post_array['reminder_start_date'][$i];
					$date = new DateTime($source);
					$newDate = $date->format('Y-m-d');
					$parse_data = array(
							'certificate_name' => $post_array['certificate_name'][$i],
							'expiry_date' => $newDate
						);
					$reminder_time = $post_array['reminds_in_days'][$i] * 1440;
					$reminder_table_insert_array = array(
							'builder_id' => $this->user_session['builder_id'],
							'project_id' => 0,
							'module_name' => $this->module,
							'module_pk_id' => $this->write_db->insert_id(),
							'reminder_type' => $post_array['reminder_type'][$i],
							'reminder_sent_to' => $post_array['user_id'],
							'reminder_sent_on' => $newDate,
							'reminder_end_time' => $newDate,
							'reminder_duration' => $reminder_time,
							'template_name' => 'sub_certificate_expiry',
							'status' => 'Not Send',
							'parse_data' => $parse_data
							);
					$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
				}
			}
		}
		$data['status'] = TRUE;
		$data['message'] = 'Updated successfully';
		}
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
	/* public function delete_sub_contractor($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_subcontractor_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_subcontractor_id'] as $key=>$ub_subcontractor_id)
			{
				//$this->write_db->delete(UB_SUBCONTRACTOR, array('ub_subcontractor_id' => $ub_subcontractor_id));
				 $post_array = array('user_status' => 'Delete');
				 $this->write_db->where('subcontractor_id', $ub_subcontractor_id);
				 $this->write_db->update(UB_USER, $post_array);
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

	} */
	/**
	*
	* delete  user
	*
	* @method: update_user
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_sub_contractor($delete_array)
	{
		$post_array = array();
		if(isset($delete_array['ub_subcontractor_id']))
		{
			foreach($delete_array['ub_subcontractor_id'] as $key=>$ub_subcontractor_id)
			{
				 $post_array = array('user_status' => 'Delete',
									 'modified_by'=>$this->user_id,
									 'modified_on'=>TODAY);
				 $this->write_db->where('subcontractor_id', $ub_subcontractor_id);
				 $this->write_db->update(UB_USER, $post_array);
				// $this->write_db->delete(UB_USER, array('ub_user_id' => $ub_user_id));
				/* Below code was added by chandru for soft delete */
					$post_arrays['is_delete'] = 'Yes';
					$post_arrays['modified_by'] = $this->user_id;
					$post_arrays['modified_on'] = TODAY;
					$this->write_db->where('ub_subcontractor_id', $ub_subcontractor_id);
					$this->write_db->update(UB_SUBCONTRACTOR, $post_arrays);
					/* Find folder id */
					$ui_folder_name = 'user'.$ub_subcontractor_id;
					/* Based on SELECTION id find project id */
					$project_id = 0;
					/* Module name */
					$module_name = 'user';
					$folder_structure_delete = $this->Mod_subcontractor->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_subcontractor_id);
					/* Fetch sub contractor certificate details for fetching reminder id */
					$delete_reminder_data = $this->Mod_subcontractor->get_sub_contractor(array(
										'select_fields' => array(
										'ub_subcontractor_addition_info.ub_subcontractor_addition_info_id'),
										'join'=> array('builder'=>'Yes','additionalinfo'=>'Yes'),
										'where_clause' => (array('ub_subcontractor_id' => $ub_subcontractor_id))
										));
					if(TRUE == $delete_reminder_data['status'])
					{
						$certifiacte_ids = $delete_reminder_data['aaData'];
						foreach($certifiacte_ids as $key => $value)
						{
							/* Below module name only for delete reminder */
							$module_name = 'subcontractor';
							$delete_reminder = $this->Mod_reminder->delete_reminder($value['ub_subcontractor_addition_info_id'], $module_name, $this->builder_id);
						}
					}
			}
			$data['status'] = TRUE;
			$data['message'] = 'Sub_contractor(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Sub_contractor id is not set';
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
	*/
	
	public function sub_contractor_user_email_invitation($post_array = array())
	{
		$response_ary = array();
		if(!empty($post_array))
		{
			$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
			$data = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
			$where = array('ub_user_id' => $post_array['ub_user_id']);
			$result = $this->Mod_user->update_data(UB_USER, $data, $where);
			$reset_link = base_url().$this->crypt->encrypt('register/signup_index/'.$post_array['ub_user_id']);
			/* FETCH BUILDER NAME */
			$condition_post_array =  array('ub_user_id'=>$this->user_session['builder_id']);
			$builder_details_array = $this->Mod_user->get_users(array(
												'select_fields' => array('first_name'),
												'where_clause' => $condition_post_array
												));
			$builder_name = $builder_details_array['aaData']['0']['first_name'];
			$content_array = array(
			'TO_EMAIL' => $post_array['primary_email'],
			'TO_NAME' => 'MS',
			'FIRST_NAME' => $post_array['name'],
			'BUILDER_NAME' => $builder_name,
			'CREATED_DATE' => TODAY,
			'RESET_LINK' => $reset_link,
			'SEND_MAIL_INFO' => $post_array['name'].EMAIL_SEPERATOR_LEVEL2.$post_array['primary_email']
			);
			$this->Mod_mail->send_mail('SEND_INVITATION_EMAIL', $content_array, 'yes');
			$response_ary['status'] =  TRUE;
			$response_ary['message'] = 'Mail Sent successfully';
		}
		else
		{
			$response_ary['status'] =  FALSE;
			$response_ary['message'] = 'Failed message will come here';
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
	/* Get certificate details */
	public function get_certificate_details($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from('ub_subcontractor_addition_info'.' AS ub_subcontractor_addition_info');	
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
		//echo $this->read_db->last_query();
		return $data;
	}
	 /**
	 *
	 *function to update the file id to 0 if file is deleted
	 *
	 */
	 public function update_sub_file($file_id = '')
	 {
	 	$file_data = array(
			'doc_file_id' => 0
		);
		$this->write_db->where('doc_file_id', $file_id);
		$this->write_db->update(UB_SUBCONTRACTOR_ADDITION_INFO, $file_data);
	 }



}
/* End of file mod_subcontractor.php */
/* Location: ./application/models/mod_subcontractor.php */