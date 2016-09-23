<?php
/** 
 * Log Model
 * 
 * @package: Log Model
 * @subpackage: Log Model 
 * @category: Log
 * @author: Sidhartha
 * @createdon(DD-MM-YYYY): 24-03-2015
*/
class Mod_warranty extends UNI_Model
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
	 * @property: $ub_warranty_claim_id
	 * @access: public
	 */

	public $ub_warranty_claim_id;
	/**
	 * @property: $ub_warranty_claim_appointments_id
	 * @access: public
	 */

	public $ub_warranty_claim_appointments_id;
	
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['user_id'])?$this->user_session['user_id']:0;
		$this->ub_warranty_claim_id = 0;
		$this->ub_warranty_claim_appointments_id = 0;
		parent::__construct();
    }
	/**
	*
	* Get warranty List
	*
	* @method: get_meeting_list
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function get_warranty($args = array())
	{
	
		 // echo '<pre>';print_r($args);exit;
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_WARRANTY_CLAIM.' AS WARRANTY');
		
         
	 	if(isset($args['join']) && 'yes' === strtolower($args['join']['warranty_appointment']))
	    {
	       $this->read_db->join(UB_WARRANTY_CLAIM_APPOINTMENT.' AS WARRANTY_APPOINTMENT','WARRANTY.ub_warranty_claim_id = WARRANTY_APPOINTMENT.warranty_claim_id','left');
	    }
	    if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
	    {
	       $this->read_db->join(UB_USER.' AS USER','WARRANTY.created_by = USER.ub_user_id','left');
	    }
		if(isset($args['join']) && 'yes' === strtolower($args['join']['project']))
		{
		 	$this->read_db->join(UB_PROJECT.' AS PROJECT','WARRANTY.project_id = PROJECT.ub_project_id','left');//UB_PROJECT is the table name defined in constant file
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
	* Get meeting List
	*
	* @method: get_meeting_list
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Satheesh Kumar N
	*/
	public function get_appoinment($args = array())
	{
	
		 // echo '<pre>';print_r($args);exit;
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_WARRANTY_CLAIM_APPOINTMENT.' AS WARRANTY_APPOINTMENT');
		
		if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
	    {
	       $this->read_db->join(UB_USER.' AS USER','WARRANTY_APPOINTMENT.subcontractor_id = USER.ub_user_id','left');
	    }
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
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
	* Add warranty
	*
	* @method: add_warranty
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_warranty($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
					if($this->write_db->insert(UB_WARRANTY_CLAIM, $post_array))
					{
						//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
						
						/* Notification code was added by chandru 01-06-2015 */
						$warenty_table_insertid = $this->write_db->insert_id();
						 if($this->user_account_type == BUILDERADMIN)
						{
						if($post_array['title'] != '' && $post_array['priority'] != '' && $post_array['category'] != '' && $post_array['problem_description'] != '')
							{
								$send_notification = $this->send_mail_for_notification($post_array,$warenty_table_insertid);
							}
						} 
						$data['insert_id'] =  $warenty_table_insertid;
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
		return $data;			
	}
	/**
	*
	* Update warranty
	*
	* @method: update_warranty
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_warranty($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->ub_warranty_claim_id = isset($post_array['ub_warranty_claim_id'])?$post_array['ub_warranty_claim_id']:$this->ub_warranty_claim_id;
			if($this->ub_warranty_claim_id > 0)
			{
				 
				$this->write_db->where('ub_warranty_claim_id', $this->ub_warranty_claim_id);
				if($this->write_db->update(UB_WARRANTY_CLAIM, $post_array))
				{
					$data['insert_id'] =  $this->ub_warranty_claim_id;
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
					
					 $warenty_table_insertid = $this->ub_warranty_claim_id;
					
					
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
		return $data;	
	}

	/*appointment start here*/
	/**
	*
	* Add appointment warranty
	*
	* @method: add_appointment_warranty
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_appointment_warranty($post_array = array())
	{
		if( ! empty($post_array))
		{

			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
					if($this->write_db->insert(UB_WARRANTY_CLAIM_APPOINTMENT, $post_array))
					{
						//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();
						$warranty_claim_id = $post_array['warranty_claim_id'];
						$data['insert_id'] =  $this->write_db->insert_id();
						$data['status'] = TRUE;
						$data['message'] = 'Warranty Appointment inserted successfully';
						$post_array = array();
						$post_array['status'] = 'Open';
						$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);

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
	*
	* Update appointment warranty
	*
	* @method: update_appointment_warranty
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_appointment_warranty($post_array = array(),$warranty_appointment_status_update_array = array())
	{
		if( ! empty($post_array))
		{
			$this->ub_warranty_claim_appointments_id = isset($post_array['ub_warranty_claim_appointments_id'])?$post_array['ub_warranty_claim_appointments_id']:$this->ub_warranty_claim_appointments_id;
			if($this->ub_warranty_claim_appointments_id > 0)
			{
				
				$result = $this->get_warranty_appointment(array(
								'select_fields' => array('max(WARRANTY_APPOINTMENT.service_date) AS service_date'),
								'where_clause' => array('WARRANTY_APPOINTMENT.warranty_claim_id' => $post_array['warranty_claim_id']),
								));
				$table_date = $result['aaData'][0]['service_date']; 
				
				//This code only for subcontractor and owner
				if($this->user_account_type == SUBCONTRACTOR)
				{
					$update_arry = array();
					$update_arry['sub_accept_appoinment'] = $warranty_appointment_status_update_array['appoinment_status'];
					$update_arry['sub_preferred_date'] = isset($warranty_appointment_status_update_array['prefered_date'])? $warranty_appointment_status_update_array['prefered_date'] : '';
					$update_arry['sub_preferred_time'] = isset($warranty_appointment_status_update_array['prefered_time'])? $warranty_appointment_status_update_array['prefered_time'] : '';
					$update_arry['sub_preferred_datetime'] = isset($warranty_appointment_status_update_array['prefered_datetime'])? $warranty_appointment_status_update_array['prefered_datetime'] : '';
					unset($post_array['owner_accept_appoinment']);

					if($warranty_appointment_status_update_array['appoinment_status']=='Accepted')
					{
						unset($update_arry['sub_preferred_date']);
						unset($update_arry['sub_preferred_time']);
						unset($update_arry['sub_preferred_datetime']);
					}

					$this->write_db->where('ub_warranty_claim_appointments_id', $this->ub_warranty_claim_appointments_id);
					//print_r($update_arry);
				    $this->write_db->update(UB_WARRANTY_CLAIM_APPOINTMENT, $update_arry);
				    $data['insert_id'] =  $this->ub_warranty_claim_appointments_id;
					$warranty_claim_appointment = $data['insert_id'];

					$notification_post_array = array();
					$notification_post_array['warranty_claim_id'] = $post_array['warranty_claim_id'];
					$notification_post_array['owner_accept_appoinment'] = $update_arry['sub_accept_appoinment'];
					$notification_post_array['owner_preferred_date'] = isset($update_arry['sub_preferred_date'])?$update_arry['sub_preferred_date']:'';

					$send_notification = $this->Mod_warranty->send_mail_for_notification($notification_post_array,'','',$warranty_claim_appointment);
					
					$data['status'] = TRUE;
					$data['message'] = 'Warranty Appointment Updated successfully';
				}
				if($this->user_account_type == OWNER)
				{
					//print_r($post_array);exit;
					$update_arry = array();
					if($warranty_appointment_status_update_array['appoinment_status']!='')
					{
						$update_arry['owner_accept_appoinment'] = $warranty_appointment_status_update_array['appoinment_status'];
					}
					if(isset($warranty_appointment_status_update_array['prefered_date']))
					{
						$update_arry['owner_preferred_date'] = isset($warranty_appointment_status_update_array['prefered_date'])? $warranty_appointment_status_update_array['prefered_date'] : '';
					}
					if(isset($warranty_appointment_status_update_array['prefered_time']))
					{
						$update_arry['owner_preferred_time'] = isset($warranty_appointment_status_update_array['prefered_time'])? $warranty_appointment_status_update_array['prefered_time'] : '';
					}
						
					if(isset($warranty_appointment_status_update_array['prefered_datetime']))
					{
						$update_arry['owner_preferred_datetime'] = isset($warranty_appointment_status_update_array['prefered_datetime'])? $warranty_appointment_status_update_array['prefered_datetime'] : '';
					}    	    
				    $update_arry['status'] = $post_array['status'];
				    $update_arry['approval_comments'] = $post_array['approval_comments'];
				    $update_arry['completion_date'] = isset($post_array['completion_date'])?$post_array['completion_date']:'';
				    unset($post_array['sub_accept_appoinment']);
					
					
					$this->write_db->where('ub_warranty_claim_appointments_id', $this->ub_warranty_claim_appointments_id);
				
					if($warranty_appointment_status_update_array['appoinment_status']=='Accepted')
					{
						unset($update_arry['owner_preferred_date']);
						unset($update_arry['owner_preferred_time']);
						unset($update_arry['owner_preferred_datetime']);
					}
				    $this->write_db->update(UB_WARRANTY_CLAIM_APPOINTMENT, $update_arry);
				    $data['insert_id'] =  $this->ub_warranty_claim_appointments_id;
					$warranty_claim_appointment = $data['insert_id'];

					$notification_post_array = array();
					$notification_post_array['warranty_claim_id'] = $post_array['warranty_claim_id'];
					$notification_post_array['owner_accept_appoinment'] = $update_arry['owner_accept_appoinment'];
					$notification_post_array['owner_preferred_date'] = isset($update_arry['owner_preferred_date'])?$update_arry['owner_preferred_date']:'';

					$send_notification = $this->Mod_warranty->send_mail_for_notification($notification_post_array,'','',$warranty_claim_appointment);
					
					$data['status'] = TRUE;
					$data['message'] = 'Warranty Appointment Updated successfully';

					if($post_array['status'] === 'Service Completed')
					{
						$waranty_update__array = array();
						$waranty_update__array['status'] = 'Closed';
						$this->write_db->where('ub_warranty_claim_id', $post_array['warranty_claim_id']);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $waranty_update__array);
					}
					else if($post_array['status'] === 'Needs Rework')
					{
						$waranty_update__array = array('status' => $post_array['status']);
						$this->write_db->where('ub_warranty_claim_id', $post_array['warranty_claim_id']);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $waranty_update__array);
					}
				}
				if($this->user_account_type == BUILDERADMIN){

				$sub_appoinment = $post_array['sub_appoinment'];
				$owner_appoinment = $post_array['owner_appoinment'];
				unset($post_array['owner_appoinment']);
				unset($post_array['sub_appoinment']);

                // your second date coming from a mysql database (date fields) 
                if(isset($post_array['service_date'])){
                $post_date = $post_array['service_date']; 
                $warranty_claim_id = $post_array['warranty_claim_id'];
                if(strtotime($post_date) > strtotime($table_date)){ 

                 $post_array['appoinment_link_to'] = $post_array['ub_warranty_claim_appointments_id'];
                 $post_array['ub_warranty_claim_appointments_id'] = '';
                 $post_array['sub_accept_appoinment'] = $sub_appoinment;
                 $post_array['owner_accept_appoinment'] = $owner_appoinment;
                 //unset($post_array['sub_accept_appoinment']);
                 //unset($post_array['owner_accept_appoinment']);
                 //print_r($post_array);exit;
                 if($this->write_db->insert(UB_WARRANTY_CLAIM_APPOINTMENT, $post_array))
				 {
				 	
					//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
					$data['insert_id'] =  $this->write_db->insert_id();
					$data['status'] = TRUE;
					$data['message'] = 'New Warranty Appointment inserted successfully';
					
					$send_notification = $this->Mod_warranty->send_mail_for_notification($post_array,'','',$data['insert_id']);
					//echo "hi";exit;
					
					if($post_array['status'] === 'Service Completed')
					{
						$post_array = array();
						$post_array['status'] = 'Closed';
						$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
					}
					else if($post_array['status'] === 'Needs Rework')
					{
						$post_array = array('status' => $post_array['status']);
						$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
					}
					else
					{
					  $post_array = array();
					  $post_array['status'] = 'Reschedule Appt.';
					  $this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				      $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
					}
					 
					
					
				 }
                }
                else{
				$this->write_db->where('ub_warranty_claim_appointments_id', $this->ub_warranty_claim_appointments_id);
				
				if($this->write_db->update(UB_WARRANTY_CLAIM_APPOINTMENT, $post_array))
				{
					$data['insert_id'] =  $this->ub_warranty_claim_appointments_id;
					$warranty_claim_appointment = $data['insert_id'];
					
					$data['status'] = TRUE;
					$data['message'] = 'Warranty Appointment Updated successfully';
					$send_notification = $this->Mod_warranty->send_mail_for_notification($post_array,'','',$data['insert_id']);
					if($post_array['status'] === 'Service Completed')
					{
						$post_array = array();
						$post_array['status'] = 'Closed';
						$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
					}
					else if($post_array['status'] === 'Needs Rework')
					{
						$post_array = array('status' => $post_array['status']);
						$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
					}
					
					/*$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				    $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);*/


				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
				}
			   }
			  }
			  else{
				$this->write_db->where('ub_warranty_claim_appointments_id', $this->ub_warranty_claim_appointments_id);
				//print_r($post_array);
				if($this->write_db->update(UB_WARRANTY_CLAIM_APPOINTMENT, $post_array))
				{
					$warranty_claim_id = $post_array['warranty_claim_id'];

					$data['insert_id'] =  $this->ub_warranty_claim_appointments_id;
					$warranty_claim_appointment = $data['insert_id'];
					/* Notification code added by chandru */
					$send_notification = $this->Mod_warranty->send_mail_for_notification($post_array,'','',$warranty_claim_appointment);
					$data['status'] = TRUE;
					$data['message'] = 'Warranty Appointment Updated successfully';
					if($post_array['status'] === 'Service Completed')
					{
						$post_array = array();
						$post_array['status'] = 'Closed';
						$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
					}
					else if($post_array['status'] === 'Needs Rework')
					{
						$post_array = array('status' => $post_array['status']);
						$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				        $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
					}
					
					/*$this->write_db->where('ub_warranty_claim_id', $warranty_claim_id);
				    $this->write_db->update(UB_WARRANTY_CLAIM, $post_array);*/


				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
				}
			   }
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
	*
	* Delete warranty
	*
	* @method: delete_warranty
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_warranty($delete_array)
	{
		if(isset($delete_array['ub_warranty_claim_id']))
		{
			foreach($delete_array['ub_warranty_claim_id'] as $key=>$ub_warranty_claim_id)
			{
				//$this->write_db->delete(UB_WARRANTY_CLAIM, array('ub_warranty_claim_id' => $ub_warranty_claim_id));

				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_warranty_claim_id', $ub_warranty_claim_id);
				$this->write_db->update(UB_WARRANTY_CLAIM, $post_array);
				/* Find folder id */
				$ui_folder_name = 'warranty'.$ub_warranty_claim_id;
				/* Based on checklist id find project id */
				$project_id_array = $this->get_warranty(array(
					'select_fields' => array('WARRANTY.project_id'),
					'where_clause' => array('WARRANTY.ub_warranty_claim_id'=>$ub_warranty_claim_id)
				));
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_warranty->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_warranty_claim_id);
			}
			$data['status'] = TRUE;
			$data['message'] = 'warranty(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'warranty id is not set';
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
	public function get_warranty_appointment($args = array())
	{
	
		 // echo '<pre>';print_r($args);exit;
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_WARRANTY_CLAIM_APPOINTMENT.' AS WARRANTY_APPOINTMENT');

		if(isset($args['join']) && 'yes' === strtolower($args['join']['warranty']))
	    {
	       $this->read_db->join(UB_WARRANTY_CLAIM.' AS WARRANTY','WARRANTY_APPOINTMENT.warranty_claim_id = WARRANTY.ub_warranty_appointment_claim_id','left');
	    }
		if(isset($args['join']) && 'yes' === strtolower($args['join']['project']))
		{
		 	$this->read_db->join(UB_PROJECT.' AS PROJECT','WARRANTY.project_id = PROJECT.ub_project_id','left');//UB_PROJECT is the table name defined in constant file
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
		//echo $this->read_db->last_query();
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
	* Get userinfo information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	*
	* @method: get_userinfo
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_userinfo($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT_ASSIGNED_USERS.' AS PROJECT_ASSIGNED_USERS');
		// Join Tables
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','PROJECT_ASSIGNED_USERS.assigned_to = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
		 }
		 // Group by condition
		if(isset($args['group_clause']) && $args['group_clause'] !='')
		{
			$this->read_db->group_by($args['group_clause']);
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		$res = $this->read_db->get();
		$data = array();
		$data_arry = array();
		if($res->num_rows() > 0)
		{
			foreach ($res->result_array() as $row)
			{
				$level2_array[] = $row['first_name'].EMAIL_SEPERATOR_LEVEL2.$row['primary_email'].EMAIL_SEPERATOR_LEVEL2.'bcc';
				
			}
			$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);

			$email_array= array(
				'SET_PARSER' => 'Testing Parser',
				'SEND_MAIL_INFO' => $level1_string
			);
			$this->Mod_mail->send_mail('SEND_NOTIFICATION_EMAIL', $email_array);
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
	
	/* Below function was added by chandru 01/06/2015 */
	public function send_mail_for_notification($post_array = array(),$warenty_table_insertid = 0,$comment_table_insertid = 0,$warranty_claim_appointment = 0)
	{
		//print_r($post_array);exit;
		//echo $warranty_claim_appointment;exit;
		/* Based on project id getting owner id */
		$project_id = $this->project_id;
		$where_owner_str = array('ub_project_id' => $project_id);
			$get_owner_user_id = array(
									'select_fields' => array('owner_id'),
									'where_clause' => $where_owner_str
									);
			$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
			if($owner_id_details['status'] == TRUE)
			{
				$owner_id = $owner_id_details['aaData'][0]['owner_id'];
			}else{
				$owner_id = '';
			}
			/* Based on project id getting owner id code ends here */
			/* Based on builder id find builder user id. */
			$builder_id = $this->builder_id;
			$post_array_builder_value[] = array(
							'field_name' => 'builder_id',
							'value'=> $builder_id, 
							'type' => '='
						);
			$post_array_builder_value[] = array(
							'field_name' => 'account_type',
							'value'=> BUILDERADMIN, 
							'type' => '='
						);
			$post_array_builder_value[] = array(
							'field_name' => 'role_id',
							'value'=> BUILDER_ADMIN_ROLE_ID, 
							'type' => '='
						);
			$where_builder_str = $this->Mod_warranty->build_where($post_array_builder_value);
			$get_builder_user_id = array(
								'select_fields' => array('ub_user_id'),
								'where_clause' => $where_builder_str
								);
			$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
			$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];

		$scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']);
			/* Based on builder id find builder user id code ends here. */
		if($warenty_table_insertid > 0)
		{
			if($this->user_id == $owner_id)
			{
				$user_id = $builder_user_id;
			}else{
				$user_id = $owner_id;
			}
		}
		elseif($comment_table_insertid > 0)
		{
			$user_id = $builder_user_id.','.$owner_id;
		}
		elseif($warranty_claim_appointment > 0)
		{
			$user_id = $builder_user_id;
		}
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($user_id,$this->main_modules[$this->module]);

			$post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			$where_str = $this->Mod_warranty->build_where($post_array_value);
         $get_all_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_str
                                    );
         $all_users = $this->Mod_user->get_users($get_all_users);
         if($all_users['status'] == TRUE)
		 {
		 $user_list = $all_users['aaData'];
		 if(isset($user_list) && !empty($user_list))
		 {
			foreach($user_list as $key => $val)
			{
				$email_ids[] = $val['primary_email'];
				$email_id = $val['primary_email'];
				$name = $val['fullname'];
				$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
			}
			$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
		 }
		 }else{
			return FALSE;
		 }
		
		 $username_array = $this->user_session;
		 $added_by_first_name = $username_array['first_name'];
		 
		 /* FETCH BUILDER NAME */
		 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('builder_name'),
												'where_clause' => $condition_post_array
												));
		$builder_name = $builder_details_array['aaData']['0']['builder_name'];
		/* WARRENTY ADDED BY BUILDER USER CODE STARTS HERE */
			if($warenty_table_insertid > 0 )
			{
				/* Owner adding means sending mail to builder */
				if($this->user_id == $owner_id)
				{
					$primary_id = $warenty_table_insertid;
					$template_type = 'warranty_new_claim_added_by_owner';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'claim_title' => $post_array['title'],
						'category' => $post_array['category'],
						'priority' => $post_array['priority'],
						'problem_description' => $post_array['problem_description'],
						'project_name' => $this->project_name,
						'log_added_by' => $added_by_first_name,
						'builder_name' => $builder_name,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}else{
				/* builder adding means sending mail to Owner  */
					$primary_id = $warenty_table_insertid;
					$template_type = 'warranty_added_internally';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'claim_title' => $post_array['title'],
						'category' => $post_array['category'],
						'priority' => $post_array['priority'],
						'problem_description' => $post_array['problem_description'],
						'project_name' => $this->project_name,
						'log_added_by' => $added_by_first_name,
						'builder_name' => $builder_name,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}
			}elseif($comment_table_insertid > 0)
			{
				$primary_id = $comment_table_insertid;
				$template_type = 'warranty_dicussion';
				$content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'title' => $post_array['title'],
					'comments' => $post_array['comments'],
					'comment_date' => TODAY,
					'project_name' => $this->project_name,
					'comment_added_by' => $added_by_first_name,
					'builder_name' => $builder_name,
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
				);
			}elseif($warranty_claim_appointment > 0)
			{
				$warranty_result = $this->Mod_warranty->get_warranty(array(
									'select_fields' => array('WARRANTY.title','WARRANTY.category','WARRANTY.priority','WARRANTY.follow_up_date'),
									'join'=> array('warranty_appointment'=>'','user'=>'','project'=>''),
									'where_clause' => array('WARRANTY.ub_warranty_claim_id'=> $post_array['warranty_claim_id'])));
									
				$primary_id = $warranty_claim_appointment;
				if($this->user_account_type == OWNER)
				{
					$template_type = 'warranty_appointment_updates_from_owner';
				    $content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'claim_title' => $warranty_result['aaData'][0]['title'],
					'category' => $warranty_result['aaData'][0]['category'],
					'priority' => $warranty_result['aaData'][0]['priority'],
					//'comments' => $post_array['approval_comments'],
					//'subcontractor_notes' => $post_array['subcontractor_notes'],
					'appoinment_status' => $post_array['owner_accept_appoinment'],
					//'schedule_date' => $post_array['service_date'],
					'date' => $post_array['owner_preferred_date'],
					'follow_up_date' => $warranty_result['aaData'][0]['follow_up_date'],
					'project_name' => $this->project_name,
					'builder_name' => $builder_name,
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
				    );
				}
				if($this->user_account_type == SUBCONTRACTOR)
				{
					$template_type = 'warranty_appointment_updates_from_sub';
				    $content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'claim_title' => $warranty_result['aaData'][0]['title'],
					'category' => $warranty_result['aaData'][0]['category'],
					'priority' => $warranty_result['aaData'][0]['priority'],
					//'comments' => $post_array['approval_comments'],
					//'subcontractor_notes' => $post_array['subcontractor_notes'],
					'appoinment_status' => $post_array['owner_accept_appoinment'],
					//'schedule_date' => $post_array['service_date'],
					'date' => $post_array['owner_preferred_date'],
					'follow_up_date' => $warranty_result['aaData'][0]['follow_up_date'],
					'project_name' => $this->project_name,
					'builder_name' => $builder_name,
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
				    );
				}
				if($this->user_account_type == BUILDERADMIN){
				$template_type = 'warranty_feedback';
				$content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'claim_title' => $warranty_result['aaData'][0]['title'],
					'category' => $warranty_result['aaData'][0]['category'],
					'priority' => $warranty_result['aaData'][0]['priority'],
					'comments' => $post_array['approval_comments'],
					'subcontractor_notes' => $post_array['subcontractor_notes'],
					'feedback' => $post_array['status'],
					'schedule_date' => $post_array['service_date'],
					'followup_date' => $warranty_result['aaData'][0]['follow_up_date'],
					'project_name' => $this->project_name,
					'builder_name' => $builder_name,
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
				);
			  }
			}
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $this->project_id,
					'module_name' => $this->module,
					'module_pk_id' => $primary_id,
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => $user_id,
					'type' => $template_type,
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => $template_type,
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			//print_r($notification_array);exit;
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($user_id,$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
			}
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
			return $notification_responce;
	}
}
/* End of file mod_user.php */
/* Location: ./application/models/mod_user.php */