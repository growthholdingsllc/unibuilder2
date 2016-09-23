<?php
/** 
 * Bid Model
 * 
 * @package: Bib Model
 * @subpackage: Bid Model 
 * @category: Bid
 * @author: Baskar
 * @createdon(DD-MM-YYYY): 28-04-2015
*/
class Mod_bid extends UNI_Model
{
	/**
	 * @property: $ub_bid_id
	 * @access: public
	 */
	public $ub_bid_id;
	
	/**
	 * @property: $ub_bid_rfi_ve_id
	 * @access: public
	 */
	public $ub_bid_rfi_ve_id;
  
	/**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->project_id = isset($this->user_session['project_id'])?$this->user_session['project_id']:1;
		$this->user_id = isset($this->user_session['user_id'])?$this->user_session['user_id']:0;
		$this->ub_biddaily_id = 0;
		$this->ub_bid_id = 0;
		$this->ub_bid_cost_code_id = 0;
		$this->ub_bid_request_id = 0 ;
		parent::__construct();
	}
	
	
	
	/** 
	* Get bids information
	*
	* @method: get_bids
	* @access: public 
	* @param: args
	* @return: array
	* @created by: GayathriKalyani
	* @created on: 8-May-2015
	*/
	public function get_bids($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID.' AS BID');
		
         
	 	if(isset($args['join']) && 'yes' === strtolower($args['join']['bid_request']))
	    {
	       $this->read_db->join('ub_bid_request'.' AS BID_REQUEST','BID.ub_bid_id = BID_REQUEST.bid_id','left');
	    }
		if(isset($args['join']) && 'yes' === strtolower($args['join']['cost_code']))
	    {
	       $this->read_db->join(UB_BID_COST_CODE.' AS COST_CODE','BID.ub_bid_id = COST_CODE.bid_id','left');
	    }
	    if(isset($args['join']) && 'yes' === strtolower($args['join']['project']))
	    {
	       $this->read_db->join(UB_PROJECT.' AS PROJECT','PROJECT.ub_project_id = BID.project_id','left');
	    }
		// Join Tables
		/* if(isset($args['join']['ub_checklist']) === strtolower($args['join']['ub_checklist']))
		{
			$this->read_db->join('ub_checklist'.' AS ub_checklist','BID.checklist_id = ub_checklist.ub_checklist_id','left');
		}  */
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
		if(!$res)
		{
			echo $this->read_db->_error_message();
			echo "<br>".$this->read_db->_error_number();exit;
		}
		 // echo $this->read_db->last_query();
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get bids cost code information
	*
	* @method: get_bid_cost_code
	* @access: public 
	* @param: args
	* @return: array
	* @created by: Sidhartha
	* @created on: 8-May-2015
	*/
	public function get_bid_cost_code($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID_COST_CODE.' AS COST_CODE');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
		$res = $this->read_db->get();
		 // echo $this->read_db->last_query();
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
        // echo '<pre>';print_r($res->result_array);		
		return $data;
	}
	/** 
	* Get biditems information
	*
	* @method: get_bids
	* @access: public 
	* @param: args
	* @return: array
	* @created by: GayathriKalyani
	* @created on: 8-May-2015
	*/
   public function get_bid_items_list($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID_REQUEST.' AS UB_BID_REQUEST');
		
		if(isset($args['join']) && 'yes' === strtolower($args['join']['subcontractor']))
		{
			$this->read_db->join(UB_SUBCONTRACTOR.' AS SUBCONTRACTOR','UB_BID_REQUEST.sub_contractor_id=SUBCONTRACTOR.ub_subcontractor_id','left');
		}
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		
		$res = $this->read_db->get();
		 // echo '<br>'.$this->read_db->last_query();
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
	
	public function delete_bids($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_bid_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_bid_id'] as $key=>$ub_bid_id)
			{
				//$this->write_db->delete(UB_BID, array('ub_bid_id' => $ub_bid_id));
			    //$this->write_db->delete(UB_BID_REQUEST, array('bid_id' => $ub_bid_id));

				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_bid_id', $ub_bid_id);
				$this->write_db->update(UB_BID, $post_array);

				$this->write_db->where('bid_id', $ub_bid_id);
				$this->write_db->update(UB_BID_REQUEST, $post_array);

				$link_to_schedule_array = array(
							'module_name' => $this->module,
							'module_id' => $ub_bid_id,
							);
			    $this->Mod_schedule->delete_link_to($link_to_schedule_array);

				/* Find folder id */
				$ui_folder_name = 'bids'.$ub_bid_id;
				/* Based on checklist id find project id */
				$project_id_array = $this->get_bids(array(
					'select_fields' => array('BID.project_id'),
					'where_clause' => array('BID.ub_bid_id'=>$ub_bid_id)
				));
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_bid->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_bid_id);
				/* Delete in reminder table */
				$delete_reminder = $this->Mod_reminder->delete_reminder($ub_bid_id, $module_name, $this->builder_id);
			}
			
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Bids deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Bid id is not set';
		}
		return $data;

	}
	public function delete_bid_request($deletee_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($deletee_array['ub_bid_request_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($deletee_array['ub_bid_request_id'] as $key=>$ub_bid_request_id)
			{
				$this->write_db->delete(UB_BID_REQUEST, array('ub_bid_request_id' => $ub_bid_request_id));
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Bids deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Bid Request id is not set';
		}
		return $data;

	}
	public function delete_rfi_ve($post_array = array())
	{
	  //print_r($post_array);
	  $this->write_db->where('ub_bid_rfi_ve_id', $post_array['ub_bid_rfi_ve_id']);
	  $this->write_db->delete(UB_BID_RFI_VE);
			
	  //echo "Deleted Sucessfully";
	  $data['status'] = TRUE;
	  $data['message'] = 'Bids deleted successfully';
	  //echo $this->write_db->last_query();
		
	  return $data;

	}

	public function delete_all_request($deletee_array = array())
	{
		//echo '<pre>';print_r($delete_array);exit;
		  $this->write_db->where('bid_id', $deletee_array['bid_id']);
		  $this->write_db->delete(UB_BID_REQUEST);

		  $this->write_db->where('bid_id', $deletee_array['bid_id']);
		  $this->write_db->delete(UB_BID_RFI_VE);

			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Bids deleted successfully';
		
		return $data;

	}
	

	/**
	*
	* Add Bid
	*
	* @method: add_bid
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_bid($post_array = array())
	{
		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
				if(isset($post_array['schedule_id']) && $post_array['schedule_id'] > 0)
				{
				  $post_array['due_date_time'] = $post_array['schedule_due_date'];
				}
				unset($post_array['schedule_due_date']);
					if($this->write_db->insert(UB_BID, $post_array))
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
				$data['message'] = 'Insert Failed: Not a valid builder';
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

	/**
	*
	* Update bid
	*
	* @method: update_bid
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_bid($post_array = array())
	{
		//print_r($post_array);
		if( ! empty($post_array))
		{
			$this->ub_bid_id = isset($post_array['ub_bid_id'])?$post_array['ub_bid_id']:$this->ub_bid_id;
			if($this->ub_bid_id > 0)
			{
				if(isset($post_array['schedule_id']) && $post_array['schedule_id'] > 0)
				{
				  $post_array['due_date_time'] = $post_array['schedule_due_date'];
				}
				unset($post_array['schedule_due_date']);
				 
				$this->write_db->where('ub_bid_id', $this->ub_bid_id);
				if($this->write_db->update(UB_BID, $post_array))
				{
					

					$data['insert_id'] =  $this->ub_bid_id;
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
			$data['message'] = 'Post array is empty';
		}
		return $data;	
	}

	/**
	*
	* Add cost code
	*
	* @method: add_cost_code
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_cost_code($post_array = array())
	{
	  if( ! empty($post_array))
	  {
		$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
		if($this->builder_id > 0)
		{
		  for($i=0; $i<count($post_array['cost_code_id']); $i++)
		  {
		   if($post_array['cost_code_id'][$i] > 0)
		   {
		   		$insert_cost_code_ary = array();
				$insert_cost_code_ary['builder_id'] = $this->user_session['builder_id'];
				$insert_cost_code_ary['project_id'] = $post_array['project_id'];
				$insert_cost_code_ary['bid_id'] =  $post_array['bid_id'];
				$insert_cost_code_ary['cost_code_id'] = $post_array['cost_code_id'][$i];
				$insert_cost_code_ary['cost_code_description'] = $post_array['cost_code_description'][$i];
				$insert_cost_code_ary['status'] = 'In Progress';
				$insert_cost_code_ary['created_by'] = $this->user_session['ub_user_id'];
				$insert_cost_code_ary['created_on'] = TODAY;
				$insert_cost_code_ary['modified_by'] = $this->user_session['ub_user_id'];
				$insert_cost_code_ary['modified_on'] = TODAY;
				$this->write_db->insert(UB_BID_COST_CODE, $insert_cost_code_ary);
		   }
		  }
		}
	  }
	}
					

	/**
	*
	* Update cost code
	*
	* @method: update_cost_code
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_cost_code($post_array = array())
	{
		
		if( ! empty($post_array))
		{

			
				//clone code starts here
					//print_r($post_array);
					if(isset($post_array['code']) && count(array_filter($post_array['code'])) > 0){
						
						$this->write_db->where('bid_id', $post_array['bid_id']);
						$this->write_db->where_not_in('ub_bid_cost_code_id', array_filter($post_array['code']));
						$this->write_db->delete(UB_BID_COST_CODE);
						//echo $this->write_db->last_query();
					}
					else{
						
						$this->write_db->where('bid_id', $post_array['bid_id']);
						$this->write_db->delete(UB_BID_COST_CODE);

					}
				 
				   //Insert/update code
					

		           if(isset($post_array['cost_code_id'])){

			       for($i=0; $i<count($post_array['cost_code_id']); $i++){
			       	
				   if(isset($post_array['code'][$i]) && $post_array['code'][$i] > 0){
					// Update Query
					
					$update_array = array();
					$update_array['ub_bid_cost_code_id'] = $post_array['code'][$i];
					$update_array['cost_code_id'] = $post_array['cost_code_id'][$i];
					$update_array['cost_code_description'] = $post_array['cost_code_description'][$i];
					$update_array['modified_by'] = $this->user_session['ub_user_id'];
		            $update_array['modified_on'] = TODAY;

					
					$this->write_db->update(UB_BID_COST_CODE, $update_array, array('ub_bid_cost_code_id'=>$post_array['ub_bid_cost_code_id'][$i]));
					
				    }else if($post_array['cost_code_id'][$i] > 0){
					// Insert Query
				    $insert_ary = array();
					$insert_ary['builder_id'] = $this->user_session['builder_id'];
					$insert_ary['project_id'] = $post_array['project_id'];
					$insert_ary['bid_id'] =  $post_array['bid_id'];
					$insert_ary['cost_code_id'] = $post_array['cost_code_id'][$i];
					$insert_ary['cost_code_description'] = $post_array['cost_code_description'][$i];
					$insert_ary['status'] = 'Inprogress';
					$insert_ary['created_by'] = $this->user_session['ub_user_id'];
					$insert_ary['created_on'] = TODAY;
					$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
					$insert_ary['modified_on'] = TODAY;

				   
					$this->write_db->insert(UB_BID_COST_CODE, $insert_ary);
				}
			}
			
		}
			
				
		}
		
		//return $data;	
	}

	/**
	*
	* Add Request
	*
	* @method: add_request
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_request($post_array = array())
	{
		if( ! empty($post_array))
		{
			if(isset($post_array['daily_sub_reminder']))
			{
				$reminder_time = $post_array['daily_sub_reminder'] * 1440;
			    unset($post_array['daily_sub_reminder']);
			}
			else
			{
				$reminder_time = 1440;
			}
			//$reminder_time = $post_array['daily_sub_reminder'] * 1440;
			//unset($post_array['daily_sub_reminder']);
			//print_r($post_array);
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
				    if(isset($post_array['sub_contractor_id']) && count(array_filter($post_array['sub_contractor_id'])) > 0){
						
						$this->write_db->where('bid_id', $post_array['bid_id']);
						$this->write_db->where_not_in('sub_contractor_id', array_filter($post_array['sub_contractor_id']));
						$this->write_db->delete(UB_BID_REQUEST);
						//echo $this->write_db->last_query();
					}
					else{
						
						$this->write_db->where('bid_id', $post_array['bid_id']);
						$this->write_db->delete(UB_BID_REQUEST);

					   }
					
					if($post_array['sub_contractor_id'][0] == '')
					{
						
						$this->write_db->where('bid_id', $post_array['bid_id']);
						$this->write_db->delete(UB_BID_REQUEST);

					}

				for($i=0; $i<count($post_array['sub_contractor_id']); $i++){
			    if($post_array['sub_contractor_id'][$i] > 0){
			   $result = $this->get_request(array(
								'select_fields' => array('BID_REQUEST.sub_contractor_id','BID_REQUEST.bid_sub_status'),
								'where_clause' => array('BID_REQUEST.sub_contractor_id' => $post_array['sub_contractor_id'][$i],'BID_REQUEST.bid_id' => $post_array['bid_id'])
								));
			   if(FALSE === $result['status']){
				$insert_request_ary = array();
				$insert_request_ary['builder_id'] = $this->user_session['builder_id'];
				$insert_request_ary['project_id'] = $post_array['project_id'];
				$insert_request_ary['bid_id'] =  $post_array['bid_id'];
				$insert_request_ary['sub_contractor_id'] = $post_array['sub_contractor_id'][$i];
				$insert_request_ary['sub_viewed'] = 'No';
				$insert_request_ary['bid_sub_status'] = $post_array['bid_sub_status'];
				$insert_request_ary['created_by'] = $this->user_session['ub_user_id'];
				$insert_request_ary['created_on'] = TODAY;
				$insert_request_ary['modified_by'] = $this->user_session['ub_user_id'];
				$insert_request_ary['modified_on'] = TODAY;
				$this->write_db->insert(UB_BID_REQUEST, $insert_request_ary);

			   }
			   else
			   {
			   	if($result['aaData'][0]['bid_sub_status'] != 'Accepted' && $result['aaData'][0]['bid_sub_status'] != 'Rejected' && $result['aaData'][0]['bid_sub_status'] != 'Submitted' && $result['aaData'][0]['bid_sub_status'] != 'Declined'){
		   	    $update_array = array();
				$update_array['bid_sub_status'] = $post_array['bid_sub_status'];
				$update_array['modified_by'] = $this->user_session['ub_user_id'];
	            $update_array['modified_on'] = TODAY;

				$this->write_db->where('bid_id', $post_array['bid_id']);
				$this->write_db->where('sub_contractor_id', $post_array['sub_contractor_id'][$i]);

				$this->write_db->update(UB_BID_REQUEST, $update_array);
			   }}

				
			}
			
		}
		$reminder_result = $this->Mod_reminder->get_reminder(array(
								'select_fields' => array('REMINDER.module_pk_id'),
								'where_clause' => array('REMINDER.module_name' => $post_array['module_name'],'REMINDER.module_pk_id' => $post_array['bid_id'])
								));
         

         for($i=0;$i<count($post_array['sub_contractor_id']);$i++){
         	
         	$where_condition = array();
		 $where_condition[] = array(
								'field_name' => 'USER.subcontractor_id',
								'value'=> $post_array['sub_contractor_id'][$i], 
								'type' => '=',
							);
		  $where_user_str = $this->Mod_bid->build_where($where_condition);
		  $get_from_users = array(
                                    'select_fields' => array('USER.ub_user_id'),
                                    'where_clause' => $where_user_str
                                    );	
		  
		  $users_details[] = $this->Mod_user->get_users($get_from_users);
		}

		
        for($user=0;$user<count($users_details);$user++)
        {
        	if(TRUE === $users_details[$user]['status']){
        	$users[] = $users_details[$user]['aaData'][0]['ub_user_id'];}
        	
        }
	  	$parse_data = array(
					'first_name' => $this->user_session['first_name'],
					'expiry_date' => $post_array['due_date_time'],
					
				);				
		//Add Reminders
		if(FALSE == $reminder_result['status']){

	
		$reminder_table_insert_array = array(
											'builder_id' => $this->user_session['builder_id'],
											'project_id' => $post_array['project_id'],
											'module_name' => $post_array['module_name'],
											'module_pk_id' => $post_array['bid_id'],
											'reminder_sent_to' => "".implode(",", $users)."",
											'reminder_sent_on' => $post_array['due_date_time'],
											'reminder_end_time' => $post_array['due_date_time'],
											'reminder_duration' => $reminder_time,
											'parse_data' => $parse_data,
											'template_name' => 'bid_reminder',
											'status' => 'Not Send'
											);
		//print_r($reminder_table_insert_array);exit;
		$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);}
		else
		{
			$reminder_table_update_array = array(
											'builder_id' => $this->user_session['builder_id'],
											'project_id' => $post_array['project_id'],
											'module_name' => $post_array['module_name'],
											'module_pk_id' => $post_array['bid_id'],
											'reminder_sent_to' => "".implode(",", $users)."",
											'reminder_sent_on' => $post_array['due_date_time'],
											'reminder_end_time' => $post_array['due_date_time'],
											'reminder_duration' => $reminder_time,
											'parse_data' => $parse_data,
											'template_name' => 'bid_reminder',
											'status' => 'Not Send'
											);

		//$primary_id = array('module_pk_id'=>$post_array['bid_id']);
		//print_r($reminder_table_update_array);exit;
		$update_in_reminder_table  = $this->Mod_reminder->update_reminder($reminder_table_update_array);
		}
		
	}
					
	}}


	/** 
	* Get request
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_request
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_request($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID_REQUEST.' AS BID_REQUEST');
		
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
	* Add rfi
	*
	* @method: add_rfi
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_rfi_ve($post_array = array(),$bid_pakage_array = array())
	{

	 if( ! empty($post_array))
	  {
		$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
		if($this->builder_id > 0)
		{
		  //print_r($post_array);
		  if($this->write_db->insert(UB_BID_RFI_VE, $post_array))
		  {

	
             $data['insert_id'] =  $this->write_db->insert_id() ;
			 $data['status'] = TRUE;
		     $data['message'] = 'Inserted Sucessfully';
			 $post_array['insert_id'] = $data['insert_id'] ;
			 $bid_pakage_array['rfi_mode'] = 'created' ;
	         $this->send_notification_bid_rfi_ve($post_array,$bid_pakage_array);
			
			//reminder
			if(($post_array['rfi_ve_type'] == 'RFI') && ($post_array['answer'] == '') && ($post_array['deadline'] != ''))
			{
			$post_array['module_name'] = $this->module.'_'.$post_array['rfi_ve_type'] ;
			$post_array['duration'] = 24*60 ;
			$this->send_reminder_bid_rfi_ve($post_array,$bid_pakage_array);
			}   
		  }
		  else
		  {

		  	$data['status'] = FALSE;
		    $data['message'] = 'Insert Fail';
		  }
		  
		   
		}
	  }
	  return $data;
	}

	/**
	*
	* Update rfi
	*
	* @method: update_rfi
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_rfi_ve($post_array = array(),$bid_pakage_array = array())
	{
	
      if( ! empty($post_array))
		{
			$this->ub_bid_id = isset($post_array['bid_id'])?$post_array['bid_id']:$this->ub_bid_id;
			if($this->ub_bid_id > 0)
			{

				 
				$this->write_db->where('ub_bid_rfi_ve_id', $post_array['ub_bid_rfi_ve_id']);
				if($this->write_db->update(UB_BID_RFI_VE, $post_array))
				{
					

					$data['insert_id'] = $this->write_db->insert_id();
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
					$post_array['insert_id'] = $data['insert_id'] ;
					$bid_pakage_array['rfi_mode'] = 'Answered' ;
	                $this->send_notification_bid_rfi_ve($post_array,$bid_pakage_array);
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
	

	/** 
	* Get rfi list information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_rfi
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_rfi_ve($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID_RFI_VE.' AS BID_RFI_VE');
		//Join Tables
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','BID_RFI_VE.created_by = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
		 }
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['owner']))
		 {
		 	$this->read_db->join(UB_USER.' AS OWNER','BID_RFI_VE.modified_by = OWNER.ub_user_id','left');//UB_USER is the table name defined in constant file
		 }
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['sub']))
		 {
		 	$this->read_db->join(UB_USER.' AS SUBCONTRACTOR','SUBCONTRACTOR.ub_user_id = BID_RFI_VE.assign_to_ids','left');//UB_USER is the table name defined in constant file
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
	* Get bids information
	*
	* @method: get_bids
	* @access: public 
	* @param: args
	* @return: array
	* @created by: GayathriKalyani
	* @created on: 8-May-2015
	*/
	public function get_bidrequest($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID_REQUEST.' AS BID_REQUEST');
		
         
	 	if(isset($args['join']['bid']) && 'yes' === strtolower($args['join']['bid']))
	    {
	       $this->read_db->join('ub_bid'.' AS BID','BID_REQUEST.bid_id = BID.ub_bid_id','left');
	    }
		if(isset($args['join']['project']) && 'yes' === strtolower($args['join']['project']))
		{
		$this->read_db->join('ub_project'.' AS PROJECT','BID_REQUEST.project_id = PROJECT.ub_project_id');
		}
		if(isset($args['join']['sub']) && 'yes' === strtolower($args['join']['sub']))
		{
		 	$this->read_db->join(UB_SUBCONTRACTOR.' AS SUBCONTRACTOR','SUBCONTRACTOR.ub_subcontractor_id = BID_REQUEST.sub_contractor_id','left');//UB_USER is the table name defined in constant file
		}
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
		 	$this->read_db->join(UB_USER.' AS USER','USER.subcontractor_id = BID_REQUEST.sub_contractor_id','left');//UB_USER is the table name defined in constant file
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
         // echo '<pre>';print_r($res->result_array);		
		return $data;
	}

	/** 
	* Get get_po_co information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_po_co
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_cost_code($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID_COST_CODE.' AS COST_CODE');	
 		
		if(isset($args['join']['bid']) && 'yes' === strtolower($args['join']['bid']))
	    {
	       $this->read_db->join(UB_BID.' AS BID','BID.ub_bid_id = COST_CODE.bid_id','left');
	    }
	    if(isset($args['join']['variance_code']) && 'yes' === strtolower($args['join']['variance_code']))
        {

        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id','left');
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

		//echo $this->read_db->last_query();exit;

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

	 

    public function get_cost_variance_code($post_array = array())
     {
      $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
         $this->read_db->from(UB_BID_COST_CODE.' AS BID_COST_CODE');

        if(isset($post_array['join']['variance_code']) && 'yes' === strtolower($post_array['join']['variance_code']))
        {
        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','BID_COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id');
        }
        
        // Where condition
        if(isset($post_array['where_clause']))
        {
       $this->read_db->where($post_array['where_clause']);
        }

        $res = $this->read_db->get();
      // echo $this->read_db->last_query();
        $data = array();
        if($res->num_rows() > 0)
        {
            $data = $res->result_array();

        }

        //echo $this->read_db->last_query();

        return $data;
      }

      public function get_bid_sub_cost_code($post_array = array())
     {
      $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
         $this->read_db->from(UB_BID_SUB_COST_CODE.' AS BID_SUB_COST_CODE');

        if(isset($post_array['join']['variance_code']) && 'yes' === strtolower($post_array['join']['variance_code']))
        {
        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','BID_SUB_COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id');
        }
        
        // Where condition
        if(isset($post_array['where_clause']))
        {
       $this->read_db->where($post_array['where_clause']);
        }

        $res = $this->read_db->get();
      // echo $this->read_db->last_query();
        $data = array();
        if($res->num_rows() > 0)
        {
            $data = $res->result_array();

        }

        //echo $this->read_db->last_query();

        return $data;
      }
	
	public function get_sub_cost_code_val($post_array = array())
     {
      $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
         $this->read_db->from(UB_SUB_COST_CODE.' AS SUB_COSTCODE');

        if(isset($post_array['join']['variance_code']) && 'yes' === strtolower($post_array['join']['variance_code']))
        {
        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','SUB_COSTCODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id');
        }
        /* if(isset($post_array['join']['bid_cost_code']) && 'yes' === strtolower($post_array['join']['bid_cost_code']))
        {
        $this->read_db->join(UB_BID_COST_CODE.' AS BID_COST_CODE','SUB_COSTCODE.cost_code_id = BID_COST_CODE.cost_code_id');
        } */
        // Where condition
        if(isset($post_array['where_clause']))
        {
       $this->read_db->where($post_array['where_clause']);
        }

        $res = $this->read_db->get();
       //echo $this->read_db->last_query();exit;
        $data = array();
        if($res->num_rows() > 0)
        {
            $data = $res->result_array();

        }

        //echo $this->read_db->last_query();

        return $data;
      }

	/** 
	* Get checklist information
	*
	* @method: get_checklist_details
	* @access: public 
	* @param: args
	* @return: array
	* @created by: pranab
	*/
	  public function get_checklist_details($post_array = array())
	  {
	     $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
		 $this->read_db->from(UB_CHECKLIST.' AS CHECKLIST');
		
	
        // Where condition
		if(isset($post_array['where_clause']))
		{
			$this->read_db->where($post_array['where_clause']);
		}
		
		$res = $this->read_db->get();
		 // echo $this->read_db->last_query();
		$data = array();
		if($res->num_rows() > 0)
		{
			$data = $res->result_array();
			
        }
		
	    //echo $this->read_db->last_query();
	
		return $data;
	  }

	  /**
	*
	* update_bid_status
	*
	* @method: update_bid_status
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_bid_status($post_array = array())
	{

		if( ! empty($post_array))
		{
				
				$insert_ary = array();
				$insert_ary['ub_bid_request_id'] = $post_array['ub_bid_request_id'];
				$insert_ary['bid_sub_status'] = $post_array['bid_sub_status'];
				$this->write_db->where('ub_bid_request_id', $insert_ary['ub_bid_request_id']);

				if($this->write_db->update(UB_BID_REQUEST, $insert_ary))
				{
					

					$data['insert_id'] =  $this->ub_bid_id;
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
					$post_array['insert_id'] = $data['insert_id'] ;
					$this->send_notification_bid_accepted_by_builder($post_array);
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
			$data['message'] = 'Post array is empty';
		}
		return $data;	
	}
	
	/** 
	* Update data in bid_request table
	*
	* @method: update_bid_request
	* @access: public 
	* @param: post_array
	* @return: array
	* @created by: pranab
	*/  
     public function update_bid_request($post_array = array(),$args = array())	
      {
      	//print_r($post_array);
      $data = array();
			
		if( ! empty($post_array))
		{
			$this->ub_bid_request_id = isset($post_array['ub_bid_request_id'])?$post_array['ub_bid_request_id']:$this->ub_bid_request_id;
			if($this->ub_bid_request_id > 0)
			{

				$result = $this->get_bidrequest(array(
								'select_fields' => array('BID_REQUEST.created_by'),
								'where_clause' => array('ub_bid_request_id' => $this->ub_bid_request_id)
								));

				$this->write_db->where('ub_bid_request_id', $this->ub_bid_request_id);
				
				if($this->write_db->update(UB_BID_REQUEST, $post_array))
				{
						  
                    
					$data['insert_id'] =  $this->ub_bid_request_id;
				    $data['status'] = TRUE;
					$data['message'] = 'Updated successfully';
					$bid_request_insertid = $data['insert_id'];
					$post_array['user_id'] = $result['aaData'][0]['created_by'];
					if(isset($post_array['builder_id']))
					{
	               $this->send_notification_bid_submitted_by_sub($post_array,$args,$bid_request_insertid);
				    }
 
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
    /** 
	* Insert data in bid_sub_cost_code table
	*
	* @method: add_sub_cost_code
	* @access: public 
	* @param: post_array
	* @return: array
	* @created by: pranab
	*/  
     public function add_sub_cost_code($post_array = array())
      {
       if( ! empty($post_array))
           {

           $result = $this->get_sub_cost_code(array(
                                'select_fields' => array('BID_SUB.bid_amount'),
                                'where_clause' => array('BID_SUB.bid_request_id' => $post_array['bid_request_id'],'BID_SUB.cost_code_id' => $post_array['cost_code_id'])
                                ));
          if(FALSE === $result['status'])
                  {
             $this->write_db->insert(UB_BID_SUB_COST_CODE, $post_array);

          }
        else
           {

           	  $this->write_db->where(array('bid_request_id' => $post_array['bid_request_id'],'cost_code_id' => $post_array['cost_code_id']));
              $this->write_db->update(UB_BID_SUB_COST_CODE, $post_array);
              //echo $this->write_db->last_query();
              
          }

        }

	}
	 /** 
	* get data from bid_sub_cost_code table
	*
	* @method: get_sub_cost_code
	* @access: public 
	* @param: post_array
	* @return: array
	* @created by: pranab
	*/  
    public function get_sub_cost_code($post_array = array())
    {

       $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
        $this->read_db->from(UB_BID_SUB_COST_CODE.' AS BID_SUB');



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
        //echo $this->read_db->last_query();
          //echo '<pre>';print_r($res->result_array);
          //exit;
        return $data;

    } 
     /** 
	* send notification to builder for bid submit.
	*
	* @method: send_notification_bid_submitted_by_sub
	* @access: public 
	* @param: args,post_array,bid_request_insertid
	* @return: array
	* @created by: pranab
	*/  
	 public function send_notification_bid_submitted_by_sub($post_array,$args,$bid_request_insertid)
	{
	
		//Fetch all the users
		//echo $post_array['builder_id'];exit;
		//print_r($post_array);
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($post_array['user_id'],$this->main_modules[$this->module]);
		 $post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_str = $this->Mod_bid->build_where($post_array_value);
		 $get_to_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_str
                                    );
		 //echo "<pre>" ; print_r($get_to_users) ; exit;
		 $to_users = $this->Mod_user->get_users($get_to_users);
		 //echo "<pre>" ; print_r($to_users) ; exit;
		 if($to_users['status'] == TRUE)		
		{
	     $post_form_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $post_array['modified_by'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		  $where_form_str = $this->Mod_bid->build_where($post_form_array_value);
		  $get_from_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_form_str
                                    );							
         $from_users = $this->Mod_user->get_users($get_from_users);
         $scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']);
        //print_r($to_users);
		 $name = $to_users['aaData'][0]['fullname'];
		 $email_id = $to_users['aaData'][0]['primary_email'] ;
		 $send_mail_info = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2 ;
		 $content_array = array(
			'TO_EMAIL' => $to_users['aaData'][0]['primary_email'],
			'SEND_MAIL_INFO' => $send_mail_info,
			'from_email' => $from_users['aaData'][0]['primary_email'],
			'from_name' => $from_users['aaData'][0]['first_name'],
			'IMAGESRC' => IMAGESRC,
			'first_name' => $to_users['aaData'][0]['first_name'],
			'sub_name' => $from_users['aaData'][0]['first_name'],
			'package_name' => $args['package_name'],
			'project_name' => $args['project_name'],
			'bid_amount' => $post_array['bid_amount'],
			'sub_notes' => $post_array['sub_notes'],
			'base_url'=> BASEURL,
			'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $args['project_id'],
					'module_name' => $this->module,
					'module_pk_id' => $bid_request_insertid,
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => $mail_user_id,
					'type' => 'bid_submitted_by_sub',
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => 'bid_submitted_by_sub',
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($post_array['user_id'],$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
			}
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
			
			return $notification_responce;
		 }
	}  
	
	 /** 
	* send notification to sub contractor for accept bids by builder.
	*
	* @method: send_notification_bid_submitted_by_sub
	* @access: public 
	* @param: post_array
	* @return: array
	* @created by: pranab
	*/  
	 public function send_notification_bid_accepted_by_builder($post_array)
	{

		//Fetch all the users
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($post_array['sub_contractor_id'],$this->main_modules[$this->module]);
		 $post_array_value[] = array(
								'field_name' => 'ub_subcontractor_id',

	    $post_to_array_value[] = array(
								'field_name' => 'subcontractor_id',

								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'

							));

		 $where_to_str = $this->Mod_bid->build_where($post_to_array_value);
		 $get_to_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_to_str
                                    );

		 $to_users = $this->Mod_user->get_users($get_to_users);
		 if(TRUE == $to_users['status']){

		 $post_form_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		  $where_form_str = $this->Mod_bid->build_where($post_form_array_value);
		  $get_from_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_form_str
                                    );							
         $from_users = $this->Mod_user->get_users($get_from_users);
         //print_r($from_users);
         $scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']);

		 $name = $to_users['aaData'][0]['fullname'];
		 $email_id = $to_users['aaData'][0]['primary_email'] ;
		 $send_mail_info = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2 ;
		 $content_array = array(
			'TO_EMAIL' => $to_users['aaData'][0]['primary_email'],
			'SEND_MAIL_INFO' => $send_mail_info,
			'from_email' => $from_users['aaData'][0]['primary_email'],
			'from_name' => $from_users['aaData'][0]['first_name'],
			'IMAGESRC' => IMAGESRC,
			'first_name' => $to_users['aaData'][0]['first_name'],
            'builder_name' => $from_users['aaData'][0]['first_name'],
			'project_name' => $post_array['project_name'],
			'package_name' => $post_array['package_name'],
			'bid_amount' => $post_array['bid_amount'],
			'bid_description' => $post_array['bid_description'],
			'base_url'=> BASEURL,
			'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $post_array['project_id'],
					'module_name' => $this->module,
					'module_pk_id' => $post_array['insert_id'],
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' =>  $to_users['aaData'][0]['ub_user_id'],
					'type' => 'bid_accepted_by_bu',
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => 'bid_accepted_by_bu',
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($post_array['sub_contractor_id'],$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
			}
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
		    return $notification_responce;}
	}  
	
	 /** 
	* send notification to sub contractor for new comment.
	*
	* @method: send_notification_bid_comments
	* @access: public 
	* @param: post_array,$notification_data
	* @return: array
	* @created by: pranab
	*/  
	 public function send_notification_bid_comments($post_array,$notification_data)
	{
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($notification_data['sub_contractor_id'],$this->main_modules[$this->module]);
		$post_to_array_value[] = array(
								'field_name' => 'subcontractor_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_to_str = $this->Mod_bid->build_where($post_to_array_value);
		 $get_to_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_to_str
                                    );
		 $to_users = $this->Mod_user->get_users($get_to_users);

		 $post_form_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		  $where_form_str = $this->Mod_bid->build_where($post_form_array_value);
		  $get_from_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_form_str
                                    );							
         $from_users = $this->Mod_user->get_users($get_from_users);
         $scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']);
		 $name = $to_users['aaData'][0]['fullname'];
		 $email_id = $to_users['aaData'][0]['primary_email'] ;
		 $send_mail_info = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2 ;
		 $content_array = array(
			'TO_EMAIL' => $to_users['aaData'][0]['primary_email'],
			'SEND_MAIL_INFO' => $send_mail_info,
	        'IMAGESRC' => IMAGESRC,
			'first_name' => $to_users['aaData'][0]['first_name'],
            'builder_name' => $from_users['aaData'][0]['first_name'],
			'project_name' => $notification_data['project_name'],
			'package_name' => $notification_data['package_name'],
			'comment_text' => $post_array['comments'],
			'base_url'=> BASEURL,
			'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $post_array['project_id'],
					'module_name' => $this->module,
					'module_pk_id' => $post_array['module_pk_id'],
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' =>  $to_users['aaData'][0]['ub_user_id'],
					'type' => 'bid_comment',
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => 'bid_comment',
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($notification_data['sub_contractor_id'],$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
			}
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
		    return $notification_responce;
	}  
	 /** 
	* send notification to sub contractor for new RFI.
	*
	* @method: send_notification_bid_comments
	* @access: public 
	* @param: post_array,bid_pakage_array
	* @return: array
	* @created by: pranab
	*/  
	 public function send_notification_bid_rfi_ve($post_array,$bid_pakage_array)
	   {
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($post_array['assign_to_ids'],$this->main_modules[$this->module]);
        if($bid_pakage_array['rfi_mode'] == 'created')
		{
		 $post_to_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $post_array['assign_to_ids'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_to_str = $this->Mod_bid->build_where($post_to_array_value);
		 $get_to_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_to_str
                                    );
		 $to_users = $this->Mod_user->get_users($get_to_users);
		 //print_r($mail_user_id);exit;

		 $post_form_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_form_str = $this->Mod_bid->build_where($post_form_array_value);
		 $get_from_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_form_str
                                    );							
         $from_users = $this->Mod_user->get_users($get_from_users);
		 $assigned = $to_users['aaData'][0]['first_name'] ;
		 $added_by = $from_users['aaData'][0]['first_name'];
		 }
		 else
		 {
		 
		  $post_to_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $bid_pakage_array['question_by'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_to_str = $this->Mod_bid->build_where($post_to_array_value);
		 $get_to_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_to_str
                                    );
		 $to_users = $this->Mod_user->get_users($get_to_users);

		 $post_form_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $post_array['modified_by'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_form_str = $this->Mod_bid->build_where($post_form_array_value);
		 $get_from_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_form_str
                                    );
		  $from_users = $this->Mod_user->get_users($get_from_users);
		  $assigned = $from_users['aaData'][0]['first_name'] ;
		  $added_by = $to_users['aaData'][0]['first_name'];
		
		}
		 
		  if($post_array['answer'])
		   {
		      $answered_by = $from_users['aaData'][0]['first_name'] ;
		   }
		   else
		   {
		   $answered_by = '' ;
		   }
		 $scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']);
		 $name = $to_users['aaData'][0]['fullname'];
		 $email_id = $to_users['aaData'][0]['primary_email'] ;
		 $send_mail_info = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2 ;
		 $content_array = array(
			'TO_EMAIL' => $to_users['aaData'][0]['primary_email'],
			'SEND_MAIL_INFO' => $send_mail_info,
	        'IMAGESRC' => IMAGESRC,
			'first_name' => $to_users['aaData'][0]['first_name'],
            'added_by'   => $added_by,
			'project_name' => $bid_pakage_array['project_name'],
			'package_name' => $bid_pakage_array['package_title'],
			'rfi_type' => $post_array['rfi_ve_type'],
			'question' => $post_array['question'],
			'deadline_date' => isset($post_array['deadline'])?$post_array['deadline']:'',
			'assigned_to' => $assigned,
			'answer' => $post_array['answer'],
			'rfi_mode' => $bid_pakage_array['rfi_mode'],
			'answered_by'=> $answered_by,
			'base_url'=> BASEURL,
			'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $post_array['project_id'],
					'module_name' => $this->module,
					'module_pk_id' => $post_array['insert_id'],
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' =>  $to_users['aaData'][0]['ub_user_id'],
					'type' => 'bid_rfi_ve',
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			$notification_array = array(
					'template_name' => 'bid_rfi_ve',
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No'
					);
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($post_array['assign_to_ids'],$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
			}
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
		    return $notification_responce;
	}
 /** 
	* send reminder to sub contractor for answer RFI.
	*
	* @method: send_reminder_bid_rfi_ve
	* @access: public 
	* @param: post_array,bid_pakage_array
	* @return: array
	* @created by: pranab
	*/  
	 public function send_reminder_bid_rfi_ve($post_array,$bid_pakage_array)
	 {
	    $post_to_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $post_array['assign_to_ids'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_to_str = $this->Mod_bid->build_where($post_to_array_value);
		 $get_to_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_to_str
                                    );
		 $to_users = $this->Mod_user->get_users($get_to_users);

		 $post_form_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '||',
								'classification' => 'primary_ids'
							);
		 $where_form_str = $this->Mod_bid->build_where($post_form_array_value);
		 $get_from_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_form_str
                                    );							
         $from_users = $this->Mod_user->get_users($get_from_users);
		 $assigned = $to_users['aaData'][0]['first_name'] ;
		
		 if($this->user_session['account_type'] == BUILDERADMIN)
		 {
		   $added_by = $from_users['aaData'][0]['first_name'];
		 }
		 else
		 {
		   $added_by = '' ;
		  }
	  $parse_data = array(
					'rfi_type' => $post_array['rfi_ve_type'],
					'first_name'=> $to_users['aaData'][0]['first_name'],
					'builder_name' => $added_by,
					'project_name' => $bid_pakage_array['project_name'],
					'package_name' => $bid_pakage_array['package_title'],
					'question' => $post_array['question'],
					'added_by' => $added_by,
					'assigned_to' => $assigned,
				);
	  //Add Reminders
			$reminder_table_insert_array = array(
											'builder_id' => $this->user_session['builder_id'],
											'project_id' => $post_array['project_id'],
											'module_name' =>$post_array['module_name'],
											'module_pk_id' => $post_array['insert_id'],
											'reminder_sent_to' => $to_users['aaData'][0]['ub_user_id'],
											'reminder_sent_on' => $post_array['created_on'],
											'reminder_end_time' => $post_array['deadline'],
											'reminder_duration' => $post_array['duration'],
											'template_name' => 'bid_rfi_ve_reminder',
											'parse_data' => $parse_data,
											'status' => 'Not Send'
											);
			$insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);
	  }
	/**
	*
	* Add Bid cost code
	*
	* @method: add_bid_cost_code
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_bid_cost_code($post_array = array())
	{
	  if( ! empty($post_array))
	  {
		
		//print_r($post_array);
		$this->write_db->insert(UB_BID_COST_CODE, $post_array);
		  
	  }
	}
	  /**
	*
	* update_bid_intrest
	*
	* @method: update_bid_intrest
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_will_bid($post_array = array())
	{

		if( ! empty($post_array))
		{
				
				$insert_ary = array();
				$insert_ary['will_bid'] = $post_array['will_bid'];
				$insert_ary['modified_on'] = $post_array['modified_on'];
				$insert_ary['modified_by'] = $post_array['modified_by'];
				$this->write_db->where('ub_bid_request_id', $post_array['ub_bid_request_id']);

				if($this->write_db->update(UB_BID_REQUEST, $insert_ary))
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
			$data['message'] = 'Post array is empty';
		}
		return $data;	
	}
   }	
/* End of file mod_bidphp */