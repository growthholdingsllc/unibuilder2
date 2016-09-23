<?php
/** 
 * Schdules Model
 * 
 * @package: Schdules Model
 * @subpackage: Schdules Model 
 * @category: Schdules
 * @author: Pranab, Thiyagaraj
 * @createdon(DD-MM-YYYY): 26-04-2015
*/
class Mod_template_schedule extends UNI_Model
{

    /**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->load->model(array('Mod_reminder','Mod_message'));
		parent::__construct();
    }
	/** 
	* Get schedules information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_schedules
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_schedules($post_array = array())
	{
		$this->read_db->select(isset($post_array['select_fields']) ? implode(',',$post_array['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SCHEDULE.' AS SCHEDULE');	//UB_SCHEDULE is the table name defined in constant file
		
		// Where condition
		if(isset($post_array['where_clause']))
		{
			$this->read_db->where($post_array['where_clause']);
		}
		// Order by condition
		if(isset($post_array['order_clause']) && $post_array['order_clause'] !='')
		{
			$this->read_db->order_by($post_array['order_clause']);
		}
		// Pagination
		if(isset($post_array['pagination']) && ! empty($post_array['pagination']))
		{
			$this->read_db->limit($post_array['pagination']['iDisplayLength'], $post_array['pagination']['iDisplayStart']);
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
		    $data['aaData'] = '' ;
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		
		return $data;
	} 
	
    /**
	* Add Schedule
	*
	* @method: add_schedule
	* @access: public 
	* @param: post data
	* @return: array with status and message
	*/
	public function add_schedule($post_array = array())
	{
		if( ! empty($post_array))
		{
			// echo '<pre>';print_r($post_array);
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->template_id = (isset($post_array['template_id'])) ? $post_array['template_id'] : $this->template_id;
			 
			//calculate date diff of first schedule start date and new schedule start date
			$project_schedule_startdates_diff_in_days = 0;
			$schedule_startdates_diff = $this->read_db->query('SELECT start_date FROM ub_template_schedule WHERE template_id = '.$this->template_id.' AND builder_id = '.$this->builder_id.' ORDER BY ub_template_schedule_id LIMIT 1'); 
			// echo $this->read_db->last_query();exit;
			$template_pre_data = array();
			if($schedule_startdates_diff->num_rows() > 0)
			{
				$template_pre_data = $schedule_startdates_diff->result_array();
				$startdate = (isset($post_array['start_date']))?date("Y-m-d", strtotime($post_array['start_date'])):'0000-00-00 00:00:00';
				$project_schedule_startdates_diff_in_days = date_diff(date_create($startdate),date_create($template_pre_data[0]['start_date']));
				$project_schedule_startdates_diff_in_days = $project_schedule_startdates_diff_in_days->format("%a");
			}	
			// echo '<pre>';print_r($project_schedule_startdates_diff_in_days);exit;
			if($this->builder_id > 0 && $this->template_id > 0)
			{
				
				$data = array();
				$SP_input_param_array = array();
 				$SP_input_param_array['projectstartdays'] = $project_schedule_startdates_diff_in_days;
 				$SP_input_param_array['templateid'] = $this->template_id;
 				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = 0;
				$SP_input_param_array['parentid'] = (isset($post_array['parent_id']))?$post_array['parent_id']:0;
				$SP_input_param_array['remiderid'] = 0;
				$SP_input_param_array['schtitle'] = $post_array['title'];
				$SP_input_param_array['startdate'] = (isset($post_array['start_date']))?date("Y-m-d", strtotime($post_array['start_date'])):'0000-00-00 00:00:00';
				$SP_input_param_array['enddate'] = (isset($post_array['end_date']))?date("Y-m-d", strtotime($post_array['end_date'])):'0000-00-00 00:00:00';
				$SP_input_param_array['totaldays'] = $post_array['no_of_days'];
				$SP_input_param_array['assignedusers'] = '';
				$SP_input_param_array['iscompleted'] = $post_array['is_completed'];
				$SP_input_param_array['schphase'] = $post_array['phase'];
				$SP_input_param_array['schtags'] = $post_array['tags'];
				$SP_input_param_array['buildernotes'] = $post_array['builder_notes'];
				$SP_input_param_array['subcontractornotes'] = $post_array['subcontractor_notes'];
				$SP_input_param_array['ownernotes'] = $post_array['owner_notes'];
				$SP_input_param_array['allnotes'] = $post_array['all_notes'];
				$SP_input_param_array['displayorder'] = 1;
				$SP_input_param_array['schcolour'] = $post_array['colour'];
				$SP_input_param_array['publishstatus'] = isset($post_array['publish_status'])?$post_array['publish_status']:'No';
				$SP_input_param_array['viewedby'] = '';
				$SP_input_param_array['createdby'] = $this->user_session['ub_user_id']; 
				$this->write_db->freeDBResource($this->write_db->conn_id);
				// echo '<pre>';print_r($SP_input_param_array);exit;

				$stored_procedure = "CALL create_new_schedule_template(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				//$res = $this->write_db->query($stored_procedure);
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				//echo $this->write_db->last_query();
				// echo '<pre>';print_r($res);exit;	
				if($res->num_rows > 0)
				{
					//below code was modified by chadnru 09-05-2015
					$row = $res->row_array();
					$predecessor_array = array();
					$data['ub_schedule_id'] = $row['lastid'];
					$data['message'] = 'Schedule inserted successfully.';
					$data['status'] = TRUE;
						
					$predecessor_array = array_filter($post_array['predecessor_list']);
					if(!empty($predecessor_array) && count($predecessor_array)>0)
					{
						$insert_in_predecessor = $this->insert_in_predecessor_table($data['ub_schedule_id'],$post_array);
						$data['predecessor_status'] = $insert_in_predecessor['status'];
						$data['message'] = $data['message'] . $insert_in_predecessor['message'];
					}
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed: Failed to insert schedule.';
				}
				$this->write_db->freeDBResource($this->write_db->conn_id);
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
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
	* Insert in predecessor table
	*
	* @method: insert_in_predecessor_table
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon: 09-05-2015
	*/
	
	public function insert_in_predecessor_table($schedule_id,$post_array)
	{
		$send_clone_data = array();
		$success_flag = TRUE;
		$message = '';
		$insert_in_predecessor_table_array = array(
				'parent_id' => $post_array['predecessor_list'],
				'predecessor_type' => $post_array['predecessor_type'],
				'lag' => $post_array['lag']
				); 
		for($i=0; $i<count($insert_in_predecessor_table_array['parent_id']); $i++)
		{
			$cloned_data['parent_id'] =  $insert_in_predecessor_table_array['parent_id'][$i];
			$cloned_data['predecessor_type'] =  $insert_in_predecessor_table_array['predecessor_type'][$i];
			$cloned_data['lag'] =  $insert_in_predecessor_table_array['lag'][$i];
			$this->write_db->freeDBResource($this->write_db->conn_id);
			$send_clone_data = $this->clone_data_value($schedule_id,$cloned_data);
			if(FALSE === $send_clone_data['status'])
			{
				$success_flag = FALSE;
				$message = $send_clone_data['message'];
			}
		}
		
		return array('status'=>$success_flag,'message'=>$message);
	}
	
	/**
	
	*
	* Insert in predecessor table clone content
	*
	* @method: clone_data_value
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: chandru
	* @createdon: 09-05-2015
	*/
	public function clone_data_value($schedule_id,$cloned_data)
	{
		
				/*
			### "insert_predecessor_records()" - Stored procedure input parameter order and count###
			1. builderid (int) 
			2. schid (int)
			3. parentid (int)
			4. predecessortype (varchar)
			5. lagdays (int)
			6. createdby (int)
			*/
		$SP_input_param_array = array();
		$SP_input_param_array['templateid'] = $this->template_id;
		$SP_input_param_array['templatescheduleid'] = $schedule_id;
		$SP_input_param_array['builderid'] = $this->builder_id;
		$SP_input_param_array['projectid'] = (int)0;
		$SP_input_param_array['schid'] = $schedule_id;
		$SP_input_param_array['parentid'] = (isset($cloned_data['parent_id']))?$cloned_data['parent_id']:0;
		$SP_input_param_array['predecessortype'] = $cloned_data['predecessor_type'];
		$SP_input_param_array['lagdays'] = $cloned_data['lag'];
		$SP_input_param_array['createdby'] = $this->user_session['ub_user_id'];
		$stored_procedure = "CALL insert_predecessor_records_template(?,?,?,?,?,?,?,?,?);";
		// print_r($SP_input_param_array);exit;
		$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
		$this->write_db->freeDBResource($this->write_db->conn_id);
		//print_r($res);
		//echo "sdfsfsdf-->".$res->num_rows();
		// echo $this->write_db->last_query();
		//$result = $res->row_array();
		//print_r($result);
		//exit;
		
		if($res->num_rows > 0)
		{
			$row = $res->row_array();
			
			if(isset($row['lastid']) && $row['lastid']>0)
			{
				$data['status'] = TRUE;
				$data['inserted_id'] = $row['lastid'];
				$data['message'] = 'Predecessor Data inserted successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Problem in insert statement. Predecessor primary ID not received';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Problem in insert statement. Predecessor info not inserted in DB';
		}	
		// echo '<pre>';print_r($data);exit;
		return $data;
	}
	
	/**
	*
	* Update Schedule
	*
	* @method: update_schedule
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_schedule($post_array = array())
	{
		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		
		if( ! empty($post_array) && count($post_array) > 0)
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->template_id = (isset($post_array['template_id'])) ? $post_array['template_id'] : $this->template_id;
			
			//calculate date diff of first schedule start date and new schedule start date
			$project_schedule_startdates_diff_in_days = 0;
			$schedule_startdates_diff = $this->read_db->query('SELECT start_date FROM ub_template_schedule WHERE template_id = '.$this->template_id.' AND builder_id = '.$this->builder_id.' ORDER BY ub_template_schedule_id LIMIT 1'); 
			// echo $this->read_db->last_query();exit;
			$template_pre_data = array();
			if($schedule_startdates_diff->num_rows() > 0)
			{
				$template_pre_data = $schedule_startdates_diff->result_array();
				$startdate = (isset($post_array['start_date']))?date("Y-m-d", strtotime($post_array['start_date'])):'0000-00-00 00:00:00';
				$project_schedule_startdates_diff_in_days = date_diff(date_create($startdate),date_create($template_pre_data[0]['start_date']));
				$project_schedule_startdates_diff_in_days = $project_schedule_startdates_diff_in_days->format("%a");
			}	
			// echo '<pre>';print_r($project_schedule_startdates_diff_in_days);exit;
			
			/*
			### "update_schedule()" - Stored procedure input parameter order and count###
				1. predflag (int)
				2. scheduleid (int)
				3. builderid (int)
				4. projectid (int)
				5. schtitle (int)
				6. startdate (datetime)
				7. enddate (datetime)
				8. totaldays (int)
				9. oldstartdate (datetime)
				10. oldenddate (datetime)
				11. oldtotaldays (int)
				12. assignedusers (varchar 1000)
				13. iscompleted (varchar 4)
				14. schphase (varchar 128)
				15. schtags (varchar 1000)
				16. buildernotes (medium_text)
				17. subcontractornotes (medium_text)
				18. ownernotes (medium_text)
				19. allnotes (medium_text)
				20.  displayorder (int)
				21.  schcolour (varchar 45)
				22.  publishstatus (varchar 4)
				23. viewedby (varchar 1000)
				24. modifiedby (int)			
			*/

			// Frame input parameter(s) for create_new_schedule 
			$SP_input_param_array = array();
			$SP_input_param_array['projectstartdays'] = $project_schedule_startdates_diff_in_days;
			$SP_input_param_array['templateid'] = $this->template_id;
			$SP_input_param_array['templatescheduleid'] = $post_array['schedule_id'];
			// $SP_input_param_array['shiftreason'] = (isset($post_array['hide_schedule_reason']))?$post_array['hide_schedule_reason']:'';
			$SP_input_param_array['predflag'] = (isset($post_array['predecessor_flag']))?$post_array['predecessor_flag']:0;
			$SP_input_param_array['assignedflag'] = 0;
			$SP_input_param_array['viewflag'] = 0;
			$SP_input_param_array['scheduleid'] = $post_array['schedule_id'];
			$SP_input_param_array['builderid'] = $this->builder_id;
			$SP_input_param_array['remiderid'] = 0;
			$SP_input_param_array['projectid'] = 0;
			$SP_input_param_array['schtitle'] = $post_array['title'];
			$SP_input_param_array['startdate'] = (isset($post_array['start_date']))?date("Y-m-d", strtotime($post_array['start_date'])):'0000-00-00 00:00:00';
			$SP_input_param_array['enddate'] = (isset($post_array['end_date']))?date("Y-m-d", strtotime($post_array['end_date'])):'0000-00-00 00:00:00';
			$SP_input_param_array['totaldays'] = $post_array['no_of_days'];
			$SP_input_param_array['oldstartdate'] = (isset($post_array['hide_db_start_date']))?date("Y-m-d", strtotime($post_array['hide_db_start_date'])):'0000-00-00 00:00:00';
			$SP_input_param_array['oldenddate'] = (isset($post_array['hide_db_end_date']))?date("Y-m-d", strtotime($post_array['hide_db_end_date'])):'0000-00-00 00:00:00';
			$SP_input_param_array['oldtotaldays'] = $post_array['hide_db_duration'];
			$SP_input_param_array['assignedusers'] = '';
			$SP_input_param_array['iscompleted'] = $post_array['is_completed'];
			$SP_input_param_array['schphase'] = $post_array['phase'];
			$SP_input_param_array['schtags'] = $post_array['tags'];
			$SP_input_param_array['buildernotes'] = $post_array['builder_notes'];
			$SP_input_param_array['subcontractornotes'] = $post_array['subcontractor_notes'];
			$SP_input_param_array['ownernotes'] = $post_array['owner_notes'];
			$SP_input_param_array['allnotes'] = $post_array['all_notes'];
			$SP_input_param_array['displayorder'] = 1;
			$SP_input_param_array['schcolour'] = $post_array['colour'];
			if(isset($post_array['hide_publish_status']) && $post_array['hide_publish_status'] == 'Yes')
			{
				$SP_input_param_array['publishstatus'] = $post_array['hide_publish_status'];
			}
			else
			{
				$SP_input_param_array['publishstatus'] = isset($post_array['publish_status'])?$post_array['publish_status']:'No';
			}
			$SP_input_param_array['viewedby'] = '';
			$SP_input_param_array['modifiedby'] = $this->user_session['ub_user_id'];
			$stored_procedure = "CALL update_schedule_template(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$this->write_db->freeDBResource($this->write_db->conn_id);
			// echo '<pre>';print_r($SP_input_param_array);
			$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
			// echo $this->write_db->last_query();
			$row = $res->row_array();
			if($res->num_rows() > 0) 
			{
				// echo '<pre>';print_r($post_array);exit;
				$data['ub_schedule_id'] = $post_array['schedule_id'];
				if($row['messagestatus'] == '1')
				{
					if(1 === $post_array['predecessor_flag'])
					{
						$insert_in_predecessor = $this->insert_in_predecessor_table($post_array['schedule_id'],$post_array);
					}	
					$data['status'] = TRUE;
					$data['predecessor_status'] = isset($insert_in_predecessor['status'])?$insert_in_predecessor['status']:FALSE;
					if(isset($insert_in_predecessor['message']))
					{
						$data['message'] = 'Schedule updated successfully.'.$insert_in_predecessor['message'];	
					}
					else
					{
						$data['message'] = 'Schedule updated successfully.';	
					}	
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: SP has an issue!';
				}	
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Update Failed: SP not returned an row array!';
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
	* Add Work day exception
	*
	* @method: add_work_day_exception
	* @access: public 
	* @param: post data
	* @return: array with status and message
	* @created by : chandru
	* @created on : 12-05-2015
	*/
	public function add_work_day_exception($post_array = array())
	{
		if( ! empty($post_array))
		{

			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = $this->user_session['builder_id'];
			// $this->project_id = 1;
			if($this->builder_id > 0 && $this->project_id > 0)
			{
				/*
			### "add_work_day_exception()" - Stored procedure input parameter order and count###
			1. workdayexcepid (int) 
			2. textflag (int)
			3. builderid (int)
			4. projectid (int)
			5. exceptitle (varcahr 128)
			6. startdate (date)
			7. enddate (date)
			8. exceptiontype (int)
			9. sameeveryyear (varchar 4)
			10. offdays (varchar 20)
			11. excepnotes (medium text)
			12. createdby (int)
			13. lastid (int)
			*/
				$start_date ="";
				if(isset($post_array['start_date']))
				{
					$source = $post_array['start_date'];
					$date = new DateTime($source);
					$start_date = $date->format('Y-m-d'); 
				}
				$end_date ="";
				if(isset($post_array['end_date']))
				{
					$sources = $post_array['end_date'];
					$dates = new DateTime($sources);
					$end_date = $dates->format('Y-m-d'); 
				}
				if($end_date == $start_date)
				{
					$end_date = "0000-00-00";
				}
				$sameeveryyear = "No";
				if(isset($post_array['repeat_year']))
				{
					$sameeveryyear = "Yes";
				}
				// Fetch work days from requested project added by chadnru 07-07-2015
				$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.off_days'),
					'where_clause' => array('PROJECT.ub_project_id'=> $this->project_id,)
					));
				if(TRUE === $project_list['status'])
				{
					if (!empty($project_list['aaData'][0]['off_days'])) 
					{
						$offdays = $project_list['aaData'][0]['off_days'];
					}
					else
					{
						$offdays =',0,';
					}
				}else{
					$offdays =',0,';
				}
				if(!empty($post_array['category']))
				{
					$category = "".implode(",", $post_array['category'])."";
				}else{
					$category = '';
				}
				if(isset($post_array['save_for_all_project']))
				{
					$project_id = 0;
				}else{
					$project_id = $this->project_id;
				}
				$SP_input_param_array = array();
				$SP_input_param_array['workdayexcepid'] = (isset($post_array['ub_workday_exception_id']))?$post_array['ub_workday_exception_id']:0;
				$SP_input_param_array['textflag'] = 0;
				$SP_input_param_array['builderid'] = $this->user_session['builder_id'];
				$SP_input_param_array['projectid'] = $project_id;
				$SP_input_param_array['exceptitle'] = (isset($post_array['title']))?$post_array['title']:0;
				$SP_input_param_array['categ'] = $category;
				$SP_input_param_array['startdate'] = $start_date;
				$SP_input_param_array['enddate'] = $end_date;
				$SP_input_param_array['exceptiontype'] = $post_array['type'];
				$SP_input_param_array['sameeveryyear'] = $sameeveryyear;
				$SP_input_param_array['offdays'] = $offdays;
				$SP_input_param_array['excepnotes'] = $post_array['notes'];
				$SP_input_param_array['createdby'] = $this->user_session['ub_user_id'];
				$SP_input_param_array['lastid'] = '';
				$stored_procedure = "CALL create_update_workdayexcep(?,?,?,?,?,?,?,?,?,?,?,?,?,@response);";
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$out_param_query = $this->write_db->query('select @response as out_param;');
				if($out_param_query->num_rows() > 0) 
				{
					$row = $out_param_query->row_array();
					$data['inserted_id'] = $row['out_param'];
					$data['status'] = TRUE;
					$data['message'] = 'inserted successfully';
					if($row['out_param'] == 0)
					{
						$data['inserted_id'] = 0;
						$data['status'] = FALSE;
						$data['message'] = 'Insert Failed: Give proper date';
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
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
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
	* get_work_day_exception
	* 
	* @method: get_work_day_exception 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 13-05-2015
	*/
	public function get_work_day_exception($ub_workday_exception_id)
	{
		if( ! empty($ub_workday_exception_id))
		{
			/*
					### "get_workdayexcep()" - Stored procedure input parameter order and count###
					1. ub_workday_exception_id (int) 
			*/
			$post_arrays = array();
			$post_arrays['workexcepid'] = $ub_workday_exception_id;
			$stored_procedure = "CALL get_workdayexcep(?);";
			$success = $this->db->query($stored_procedure,$post_arrays);
			//echo '<pre>';print_r($success->num_rows());exit;
				if($success->num_rows() > 0)
				{
					$data['aaData'] = $success->result_array();
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
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
	}
	/**
	*
	* Calculate No Of Days
	*
	* @method: calculate_no_of_days
	* @access: public 
	* @param: post data
	* @return: return total days
	*/   
	 public function calculate_no_of_days($post_array = array())
	 {
   		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->project_id = (isset($post_array['project_id'])) ? $post_array['project_id'] : $this->project_id;
			
			if($this->builder_id > 0 && $this->project_id > 0)
			{
				/*
				### calculate_no_of_days() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. projectid (int)
				3. startdate (datetime)
				4. enddate (datetime)
				5. totaldays (int)
				*/
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = $this->project_id;
				$SP_input_param_array['startdate'] = $post_array['start_date'];
				$SP_input_param_array['enddate'] = $post_array['end_date'];
				$SP_input_param_array['totaldays'] = $post_array['no_of_days'];
				/*
					// Set of process for out parameter case
					$this->db->trans_start();
					$success = $this->db->query("call my_stored_proc('arg1','arg2',@out_param);");
					$out_param_query = $this->db->query('select @out_param as out_param;');
					$this->db->trans_complete();
					$out_param_row = $this->db->row();
					$out_param_val = $this->out_param;				
				*/
				$stored_procedure = "CALL calculate_no_of_days(?,?,?,?,?)";
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$data = array();
				if($res->num_rows() > 0)
				{
					$row = $res->row_array();
					$data['totaldays'] = $row['totaldays'];
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
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
  	/**
	*
	* Get end date for a schedule 
	*
	* @method: get_end_date
	* @access: public 
	* @param: post data
	* @return: return total days
	*/   
	 public function get_end_date($post_array = array())
	 {
   		if( ! empty($post_array))
		{
			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
			$this->project_id = (isset($post_array['project_id'])) ? $post_array['project_id'] : $this->project_id;
			
			if($this->builder_id > 0 && $this->project_id > 0)
			{
				/*
				### get_end_date() - Stored procedure input parameter order and count###
				1. builderid (int) 
				2. projectid (int)
				3. startdate (datetime)
				4. totaldays (int)
				5. offdays (int)
				*/
				
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['builderid'] = $this->builder_id;
				$SP_input_param_array['projectid'] = $this->project_id;
				$SP_input_param_array['startdate'] = $post_array['start_date'];
				$SP_input_param_array['totaldays'] = $post_array['no_of_days'];
				// Fetch work days from requested project 
				$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.off_days'),
					'where_clause' => array('PROJECT.ub_project_id'=> $this->project_id,)
					));
				if(TRUE === $project_list['status'])
				{
					$offdays = $project_list['aaData'][0]['off_days'];
				}
				else
				{
					$data = $project_list;
					return $data;
				}	
				$SP_input_param_array['offdays'] = $offdays;
				$stored_procedure = "CALL get_end_date(?,?,?,?,?,@response);";
				$success = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$out_param_query = $this->write_db->query('select @response as out_param;');
				if($out_param_query->num_rows() > 0)
				{
					$end_date = $out_param_query->row_array();
					$data['end_date'] = date('m/d/Y',strtotime($end_date['out_param']));
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
				$data['message'] = 'Insert operation Failed: Not a valid builder / project';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }
  	/**
	*
	* Get all schedule to populate predecessor drop down list 
	*
	* @method: get_all_predecessors
	* @access: public 
	* @param: post data
	* @return: return total days
	*/   
	 public function get_all_predecessors($args = array(), $post_array = array())
	 {
		$this->builder_id = (isset($post_array['builder_id'])) ? $post_array['builder_id'] : $this->builder_id;
		$this->template_id = (isset($post_array['template_id'])) ? $post_array['template_id'] : $this->template_id;
		if($this->builder_id > 0 && $this->template_id > 0)
		{
			$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
			$this->read_db->from(UB_TEMPLATE_SCHEDULE.' AS TEMPLATE_SCHEDULE');
	   
			// Where condition
			if(isset($args['where_clause']))
			{
				$this->read_db->where($args['where_clause']);
			}
			// Order by condition
			
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
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'operation Failed: Not a valid builder / project';
		}	
        // echo '<pre>';print_r($res->result_array);		
		return $data;
    }	
  	/**
	*
	* Get predecessor list saved under a schedule 
	*
	* @method: get_schedule_predecessors
	* @access: public 
	* @param: post data
	* @return: return result array containing saved predecessor list 
	*/   
	 public function get_schedule_predecessors($args = array())
	 {
   		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SCHEDULE_PREDECESSOR_INFO.' AS SCHEDULE_PREDECESSOR_INFO');
   
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
	*
	* Get schedule link follows the current schedule 
	*
	* @method: get_schedule_link_follows
	* @access: public 
	* @param: post data
	* @return: return result array containing links follows the schedule  
	*/   
	 public function get_schedule_link_follows($post_array = array())
	 {
   		if( ! empty($post_array))
		{
			if($post_array['schedule_id'] > 0)
			{
				/*
				### get_link_to_follow_list() - Stored procedure input parameter, order and count###
				1. scheduleid (int) 
				*/
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['scheduleid'] = $post_array['schedule_id'];
				// Fetch schedule list follows the current schedule 
				$stored_procedure = "CALL get_link_to_follow_list(?)";
				$this->write_db->freeDBResource($this->write_db->conn_id);
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$this->write_db->freeDBResource($this->write_db->conn_id);
				$result = $res->result_array();
				if(count($result) > 0)
				{
					$data['aaData'] = $result;
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
				$data['message'] = 'Operation Failed: Passed value is not a valid Schedule ID!';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }	
	
	/** 
	* get_date_interval
	* 
	* @method: get_date_interval 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 09-05-2015
	*/
	public function get_date_interval($post_array = array())
	{
		if( ! empty($post_array))
		{
			/*
					### "get_workdayexcep()" - Stored procedure input parameter order and count###
					1. builderid (int) 
					2. projectid (int)
					3. startdate (datetime)
					4. totaldays (int)
					5. offdays (int)
			*/
			$stored_procedure = "CALL get_end_date(?,?,?,?,?,@response);";
			$success = $this->db->query($stored_procedure,$post_array);
			$out_param_query = $this->db->query('select @response as out_param;');
				if($out_param_query->num_rows() > 0)
				{
					$data['aaData'] = $out_param_query->result_array();
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
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
	}

	/** 
	* Get Workdays information
	* @method: get_workdays
	* @access: public 
	* @param: args
	* @return: array
	* @createdby: pranab
	* @createdon: 11-05-2015
	*/
   public function get_workdays($workdays = array())
	{
        $stored_procedure = "CALL get_workdayexcep_list(?,?,?,?,?,?,?,?,@total_rec);";
		$this->db->freeDBResource($this->db->conn_id);
        $success = $this->db->query($stored_procedure,$workdays);
	    $this->db->freeDBResource($this->db->conn_id);
		$out_param_query = $this->db->query('select @total_rec AS total_rec;'); 
		if($out_param_query->num_rows() > 0)
		{
		    $data['aaData'] = $success->result_array();
			$data['total_count'] = $out_param_query->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
		    $data['aaData'] = '' ;
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//$this->read_db->last_query();
		return $data;

	}

	/** 
	* get_durations
	* 
	* @method: get_durations 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 11-05-2015
	*/
	public function get_durations($post_array = array())
	{
		if( ! empty($post_array))
		{
			/*
					### "calculate_no_of_days()" - Stored procedure input parameter order and count###
					1. builderid (int) 
					2. projectid (int) 
					3. startdate (datetime) 
					4. enddate (datetime) 
					5. totaldays (int) - Output param
			*/
			$stored_procedure = "CALL calculate_no_of_days(?,?,?,?,@totaldays);";
			$success = $this->write_db->query($stored_procedure,$post_array);
			$out_param_query = $this->write_db->query('select @totaldays as out_param_count;');
			if($out_param_query->num_rows() > 0)
			{
				$no_of_days = $out_param_query->row_array();
				$data['no_of_days'] = $no_of_days['out_param_count'];
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
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
	}
	
	/** 
	* get_sub_contractor_list
	* 
	* @method: get_sub_contractor_list 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 11-05-2015
	*/
	public function get_sub_contractor_list($post_array = array())
	{
		if( ! empty($post_array))
		{
			/*
					### "get_schedule_nonviewable_user_details()" - Stored procedure input parameter order and count###
					1. projectid (int) 
					2. scheduleid (int) 
			*/
			//print_r($post_array);exit;
			$this->write_db->freeDBResource($this->write_db->conn_id);
			$stored_procedure = "CALL get_schedule_nonviewable_user_details(?,?)";
			$success = $this->write_db->query($stored_procedure,$post_array);
			//echo $this->write_db->last_query();exit;
			$subcontractor_list = $success->result_array();
			$subs_list = array();
			if(isset($subcontractor_list[0]) && count($subcontractor_list[0])>0)
			{
				$subs_list = array_filter($subcontractor_list[0]);
			}
			$project_user_list = (count($subs_list)>0)?1:0;
			if(count($subcontractor_list)> 0 && $project_user_list == 1)
			{
				
				$data['aaData'] = $subcontractor_list;
				$data['status'] = TRUE;
				$data['message'] = 'Data retrieved successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'No record found';
			}
			$this->write_db->freeDBResource($this->write_db->conn_id);
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
	}
	
	/** 
	* get_schedule_details
	* 
	* @method: get_schedule_details 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 12-05-2015
	*/
	public function get_schedule_details($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_TEMPLATE_SCHEDULE.' AS TEMPLATE_SCHEDULE');
   
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		
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
        // echo '<pre>';print_r($res->result_array);		
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
	public function get_schedules_phase_list($args = array())
	{
	$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SCHEDULE.' AS SCHEDULE');
		
		if(isset($args['join']['USER']) && 'yes' === strtolower($args['join']['user']))
			{
			$this->read_db->join('ub_user'.' AS USER','SCHEDULE.assigned_users = USER.builder_id','left');
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
	public function get_schedule_items_list($args = array())
	{
			$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
			$this->read_db->from(UB_SCHEDULE.' AS SCHEDULE');
		// Join Tables
			 if(isset($args['join']) && 'yes' === strtolower($args['join']['schedule_assigned_users']))
			{
				$this->read_db->join('ub_schedule_assigned_users'.' AS SCHEDULE_ASSIGNED_USERS','SCHEDULE_ASSIGNED_USERS.schedule_id = SCHEDULE.ub_schedule_id', 'left');
			} 
			if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
			{
			$this->read_db->join('ub_user'.' AS USERS','USERS.ub_user_id = SCHEDULE_ASSIGNED_USERS.assigned_to', 'left');
			}
		
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Group by condition
		if(isset($args['group_clause']) && $args['group_clause'] !='')
		{
			$this->read_db->group_by($args['group_clause']);
		}
		 $res = $this->read_db->get();
	    //echo '<br>'.$this->read_db->last_query();exit;
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
	
    public function get_schedules_ganttchart($post_array = array())
    {
        $stored_procedure = "CALL get_gantt_data(?,?,?,?,?,?,?,?,?,@csschids);";
		$this->db->freeDBResource($this->db->conn_id);
		$success = $this->db->query($stored_procedure,$post_array);
		/* echo $this->db->last_query();
		exit; */
		$this->db->freeDBResource($this->db->conn_id);
		$out_param_query = $this->db->query('select @csschids AS csschids;'); 
		$data = array();
		if($success->num_rows() > 0)
		{
		    $data['aaData'] = $success->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
		    $data['aaData'] = '' ;
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//$this->read_db->last_query();
		return $data;
	}	
	
    public function get_schedules_ganttlink($post_array = array())
    {
        $link_stored_procedure = "CALL get_gantt_link(?,?,?);";
		$this->db->freeDBResource($this->db->conn_id);
		$linkdetails = $this->db->query($link_stored_procedure,$post_array);
		//echo $this->db->last_query(); 
		//exit;
		$data = array();
		if($linkdetails->num_rows() > 0)
		{
		    $data['aaData'] = $linkdetails->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
		    $data['aaData'] = '' ;
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//$this->read_db->last_query();
		return $data;

	}	
  	/**
	*
	* Get schedule user(s) assigned to 
	*
	* @method: get_schedule_assigned_to
	* @access: public 
	* @param: post data
	* @return: return result array containing saved user assigned to list 
	*/   
	 public function get_schedule_assigned_to($post_array = array())
	 {
   		if( ! empty($post_array))
		{
			if($post_array['schedule_id'] > 0)
			{
				/*
				### get_parent_predecessor() - Stored procedure input parameter, order and count###
				1. scheduleid (int) 
				*/
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['scheduleid'] = $post_array['schedule_id'];
				$this->write_db->freeDBResource($this->write_db->conn_id);
				// Fetch schedule list to populate predecessor saved list 
				$stored_procedure = "CALL get_schedule_assigned_user_details(?)";
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$this->write_db->freeDBResource($this->write_db->conn_id);
				$result = $res->result_array();
				if(count($result) > 0)
				{
					$data['aaData'] = $result;
					$data['status'] = TRUE;
					$data['message'] = 'Data retrieved successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'No record found';
				}
				$this->write_db->freeDBResource($this->write_db->conn_id);
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Operation Failed: Passed value is not a valid Schedule ID!';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }	
  	/**
	*
	* Get schedule user(s) view list 
	*
	* @method: get_schedule_view_users
	* @access: public 
	* @param: post data
	* @return: return result array containing saved user view list 
	*/   
	 public function get_schedule_view_users($post_array = array())
	 {
   		if( ! empty($post_array))
		{
			if($post_array['schedule_id'] > 0)
			{
				/*
				### get_parent_predecessor() - Stored procedure input parameter, order and count###
				1. scheduleid (int) 
				*/
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['scheduleid'] = $post_array['schedule_id'];
				$this->write_db->freeDBResource($this->write_db->conn_id);
				// Fetch schedule list to populate predecessor saved list 
				$stored_procedure = "CALL get_schedule_viewable_user_details(?)";
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$this->write_db->freeDBResource($this->write_db->conn_id);
				$result = $res->result_array();
				if(count($result) > 0)
				{
					$data['aaData'] = $result;
					$data['status'] = TRUE;
					$data['message'] = 'Data retrieved successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'No record found';
				}
				$this->write_db->freeDBResource($this->write_db->conn_id);
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Operation Failed: Passed value is not a valid Schedule ID!';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }	
  	/**
	*
	* Get schedule user(s) view list 
	*
	* @method: get_schedule_shifts_history
	* @access: public 
	* @param: post data
	* @return: return result array containing schedule shift history 
	*/   
	 public function get_schedule_shift_history($post_array = array())
	 {
   		if( ! empty($post_array))
		{
			if($post_array['schedule_id'] > 0)
			{
				/*
				### get_parent_predecessor() - Stored procedure input parameter, order and count###
				1. scheduleid (int) 
				*/
				$data = array();
				$SP_input_param_array = array();
				$SP_input_param_array['scheduleid'] = $post_array['schedule_id'];
				$SP_input_param_array['shifttype'] = $post_array['shift_type'];
				$this->write_db->freeDBResource($this->write_db->conn_id);
				// Fetch schedule list to populate predecessor saved list 
				$stored_procedure = "CALL get_schedule_shifts(?,?)";
				$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
				$this->write_db->freeDBResource($this->write_db->conn_id);
				//echo $this->write_db->last_query();
				//echo "aasda";print_r($res);exit;
				$result = $res->result_array();
				if(count($result) > 0)
				{
					$data['aaData'] = $result;
					$data['status'] = TRUE;
					$data['message'] = 'Data retrieved successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'No record found';
				}
				$this->write_db->freeDBResource($this->write_db->conn_id);
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Operation Failed: Passed value is not a valid Schedule ID!';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';
		}	
		return $data;
    }	

/**
	*
	* Get schedule assign user name
	*
	* @method: get_user
	* @access: public 
	* @param: post data
	* @return: return result array containing saved user name list 
	*/   
	public function get_users($post_array = array())
	{
      $this->read_db->select(isset($post_array['select_fields']) ? implode(',',$post_array['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_USER.' AS USER');	//UB_SCHEDULE is the table name defined 
		if(isset($post_array['where_clause']))
		{
			$this->read_db->where($post_array['where_clause']);
		}
		
		$res = $this->read_db->get();	

		$data = array();
		
		if($res->num_rows() > 0)
		{
		    $data = $res->result_array();
			
		}
		
		// echo "<pre>" . $this->read_db->last_query();
		
		return $data;
}

	
	/**
	*
	* Send mail notifications
	*
	* @method: send_mail_for_notification
	* @access: public 
	* @param: post data
	* @createdby: chandru 
	* @createdon: 05-06-2014 
	*/  
	public function send_mail_for_notification($post_array = array())
	{
			/* Based on project id getting owner id */
			$project_id = (isset($this->project_id) && $this->project_id>0)?$this->project_id:0;
			if($project_id>0)
			{
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
					$owner_id = 0;
				}
				if(isset($post_array['get_owner']) && $post_array['get_owner'] == 'Yes')
				{
					return $owner_id;
				}
			}
			/* Based on project id getting owner id code ends here */
			$user_id = $owner_id.''.$post_array['viewable_users'].''.$post_array['assigned_users'];
			$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($user_id,$this->main_modules[$this->module]); 
			$post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			$where_str = $this->Mod_schedule->build_where($post_array_value);
			
			$get_all_users = array(
									'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
									'where_clause' => $where_str
									);
			$all_users = $this->Mod_user->get_users($get_all_users);
			
			if(isset($all_users['status']) && TRUE === $all_users['status'])
			{
				$user_list = $all_users['aaData'];
				foreach($user_list as $key => $val)
				{
					$email_ids[] = $val['primary_email'];
					$email_id = $val['primary_email'];
					$name = $val['fullname'];
					$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
				}
				$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
			}
			else
			{
				return false;
			}
			/* Added by user name */
			$username_array = $this->user_session;
			$added_by_name = $username_array['first_name'];
			 $scheduler  = $this->Mod_builder->get_builder_logo($this->builder_id); 
			if(isset($post_array['base_end_date']) && $post_array['base_end_date'] != '')
			{
				$template_type = 'schedule_deadline_change';
				$content_array = array(
				'TO_EMAIL' => $email_ids,
				'SEND_MAIL_INFO' => $level1_string,
				'IMAGESRC' => IMAGESRC,
				'title' => $post_array['title'],
				'old_date' => $post_array['base_end_date'],
				'new_date' => $post_array['end_date'],
				'base_url'=> BASEURL,
				'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
			);
			}else{
				$template_type = 'schedule_task_completed';
				 $content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'title' => $post_array['title'],
					'added_by_name' => $added_by_name,
					'end_date' => $post_array['end_date'],
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
				);
			}
				
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $this->project_id,
					'module_name' => $this->module,
					'module_pk_id' => 1,
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
			$notification_responce = $this->Mod_notification->send_mail($notification_array);
			return $notification_responce;
	}
	
	/* @method: get_logs
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_schedule_baseline($post_array = array())
	{
		if($this->builder_id > 0)
		{
			/*
			### get_baseline_list() - Stored procedure input parameter, order and count###
			1. builderid (int) 
			2. projectid (int)
			3. assignedto (int)
			4. schststus (int)
			5. schtags (int)
			6. schphase (int)
			*/
			$data = array();
			$SP_input_param_array = array();
			$SP_input_param_array['builderid'] = (int) $this->builder_id;
			$SP_input_param_array['projectid'] = ($this->project_id == 'a')?0:(int)$this->project_id;
			$SP_input_param_array['assignedto'] = (isset($post_array['assignedto']))?$post_array['assignedto']:'';
			$SP_input_param_array['schststus'] = (isset($post_array['schdule_status']))?$post_array['schdule_status']:'';
			$SP_input_param_array['schtags'] = (isset($post_array['tags']))?$post_array['tags']:'';
			$SP_input_param_array['schphase'] = (isset($post_array['phase']))?$post_array['phase']:'';
			$SP_input_param_array['rangestart'] = (isset($post_array['rangestart']))?$post_array['rangestart']:'';
			$SP_input_param_array['rangeend'] = (isset($post_array['rangeend']))?$post_array['rangeend']:'';
			$SP_input_param_array['dateformat'] = (isset($post_array['dateformat']))?$post_array['dateformat']:'';
			// echo '<pre>';print_r($SP_input_param_array);exit;
			$stored_procedure = "CALL get_baseline_list(?,?,?,?,?,?,?,?,?)";
			$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
			$this->write_db->freeDBResource($this->write_db->conn_id);
			// echo $this->write_db->last_query();
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
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert operation Failed: Not a valid builder';
		}	
		return $data;
	}

	/** 
	* Get schedules predecessor
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_schedules_predecessor
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_schedules_predecessor($post_array = array())
	{
   		
		
		$this->read_db->select(isset($post_array['select_fields']) ? implode(',',$post_array['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SCHEDULE_PREDECESSOR_INFO.' AS SCHEDULE_PREDECESSOR_INFO');	//UB_SCHEDULE is the table name defined in constant file
		
		// Where condition
		if(isset($post_array['where_clause']))
		{
			$this->read_db->where($post_array['where_clause']);
		}
		// Order by condition
		if(isset($post_array['order_clause']) && $post_array['order_clause'] !='')
		{
			$this->read_db->order_by($post_array['order_clause']);
		}
		// Pagination
		if(isset($post_array['pagination']) && ! empty($post_array['pagination']))
		{
			$this->read_db->limit($post_array['pagination']['iDisplayLength'], $post_array['pagination']['iDisplayStart']);
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
		    $data['aaData'] = '' ;
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		
		return $data;
	} 
	/** 
	* Get schedules predecessor
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_schedules_predecessor
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_workday_exception($post_array = array())
	{
   		
		
		$this->read_db->select(isset($post_array['select_fields']) ? implode(',',$post_array['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_WORKDAY_EXCEPTION.' AS WORKDAY_EXCEPTION');	//UB_SCHEDULE is the table name defined in constant file
		
		// Where condition
		if(isset($post_array['where_clause']))
		{
			$this->read_db->where($post_array['where_clause']);
		}
		// Order by condition
		if(isset($post_array['order_clause']) && $post_array['order_clause'] !='')
		{
			$this->read_db->order_by($post_array['order_clause']);
		}
		// Pagination
		if(isset($post_array['pagination']) && ! empty($post_array['pagination']))
		{
			$this->read_db->limit($post_array['pagination']['iDisplayLength'], $post_array['pagination']['iDisplayStart']);
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
		    $data['aaData'] = '' ;
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo $this->read_db->last_query();
		
		return $data;
	}

	
}
/* End of file mod_schedule.php */
/* Location: ./application/models/mod_schedule.php */