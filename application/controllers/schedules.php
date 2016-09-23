<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Project Class
 * 
 * @package: Schedule
 * @subpackage: Schedule
 * @category: Schedule
 * @author: Thiyagaraj, Pranab, Chandru
 * @createdon(DD-MM-YYYY): 27-04-2015 
*/
class Schedules extends UNI_Controller {
	/**
	 * @property: $schedule_id
	 * @access: private
	 */
	private $schedule_id;
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
		$this->load->model(array('Mod_schedule','Mod_project','Mod_general_value','Mod_saved_search','Mod_user','Mod_notification','Mod_doc','Mod_template'));
    }
	/** 
	* Get all schedule
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/
	public function index()
	{
	
		//echo "-----".$this->crypt->encrypt('schedules/get_schedules_gantt/');
		
		$search_filter_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		$result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array('ub_saved_search_id'),
												 'where_clause' => $search_filter_array
												 ));
		$data = array(
		'title'        			=> "Schedule Landing Page",		
		'content'      			=> 'content/schedules/schedules',
        'page_id'      			=> 'schedules',
		'data_table'   			=>'data_table',		
		'all_calendar' 			=>'all_calendar',
		'gantt' 	   			=>'gantt',
		'calendar_listview' 	=>'calendar_listview',
		'calendar_baselineview' =>'calendar_baselineview',
		'calendar_workdays' 	=>'calendar_workdays',
		'calendar_phaselist' 	=>'calendar_phaselist',
		'date_all' 	   			=>'date_all',
		'predecessor_list' 	   	=>'predecessor_list',
		'shifts_list' 	   		=>'shifts_list',				
		'baseline_list' 	   	=>'baseline_list',
		'apply_filter'          => $result_data['status'],
        'search_session_array'  => $this->uni_session_get('SEARCH'),		
		);
		
		//Get builder schedule tags from general value table
		$args = array('classification'=>'schedule_tags', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$schedules_tags_result = $this->Mod_general_value->get_general_value($args);
		$data['schedules_tags_array']=array();
		if(isset($schedules_tags_result['values']))
		{
			$data['schedules_tags_array'] = $schedules_tags_result['values'];
		
		}
		//Get builder schedule phase from general value table
		$args = array('classification'=>'schedule_phase_list', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')', 'type'=>'dropdown');
		$schedules_phase_result = $this->Mod_general_value->get_general_value($args);
		$data['schedules_phase_array']=array();
		if(isset($schedules_phase_result['values']))
		{
			$data['schedules_phase_array'] = $schedules_phase_result['values'];
		
		}
		
		 //Get all users for created by logged in builder
		 $args = array(BUILDERADMIN => array('builder_id' => $this->user_session['builder_id'], 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->user_session['builder_id'], 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->user_session['builder_id'], 'account_type' => SUBCONTRACTOR));
		 $data['user_name_drop_down'] = $this->Mod_user->get_users_by_type($args,'multiple'); 
		 
		 // get all schedules status
		$schedules_status_dropdown = array(''=>'Nothing selected','upcoming'=>'Upcoming Items','completed'=>'Completed Items','progress'=>'In progress Items');
		$data['schedules_status'] = $schedules_status_dropdown;
		// get all schedules status
		$exception_type_dropdown = array(''=>'Nothing selected','-1'=>'Non Workday','1'=>'Extra Workday');
		$data['exception_type'] = $exception_type_dropdown;

		 //template drop down
	    $template_list = $this->Mod_template->get_template(array(
					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),
					'where_clause' => (array('TEMPLATE.builder_id' => $this->user_session['builder_id']))
					));
	    if( $template_list['status'] == TRUE){
			
			//$data['template_list']= $template_list['aaData'];
			$data['template_list'] = $this->Mod_project->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name');
	   	}
		if($this->user_account_type == OWNER)
		{
			$owner_calender_access = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.limit_owner_calendar'),
					'where_clause' => array("PROJECT.ub_project_id" => $this->project_id),
					));
			// echo '<pre>';print_r($owner_calender_access);exit;		
			$data['owner_calender_access'] = $owner_calender_access['aaData'][0]['limit_owner_calendar'];
			if($data['owner_calender_access'] == NULL || $data['owner_calender_access'] == '')			
			{
				$data['owner_calender_access'] = 'No';
			}
		}
		$this->template->view($data);
	}	
	/** 
	* Get Schedules
	* 
	* @method: get_schedules
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	*/	
	public function get_schedules()
	{
	
	  if(!empty($this->input->post()))
		{
			/* echo "hiiiiiiiii"; exit; */
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
			
				$post_array[] = array(
									'field_name' => 'SCHEDULE.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'SCHEDULE.is_delete',
									'value'=> 'No', 
									'type' => '='
									);					
				/* if($this->project_id > 0)
		         {
			       $post_array[] = array(
									'field_name' => 'SCHEDULE.project_id',
									'value'=> $this->project_id, 
									'type' => '='
									);
		         } */
				if(!empty($this->project_id))
				{
					$post_array[] = array(
										'field_name' => 'SCHEDULE.project_id',
										'value'=> $this->project_id, 
										'type' => '='
										);
				}
				else
				{
					$post_array[] = array(
									'field_name' => 'SCHEDULE.project_id',
									'value'=> $this->users_project_ids, 
									'type' => '||',
									'classification' => 'primary_ids'
								);
				}		
					
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				//No task tag filter field
				 if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
				{
					if(!is_array($result['data']['tags']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.tags',
								'value'=> $result['data']['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['tags'] = $result['data']['tags'];	
				
					}
				}	
				if(isset($result['data']['assignedto']) && $result['data']['assignedto']!='' && $result['data']['assignedto'] != 'null')
				{
					if(!is_array($result['data']['assignedto']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.assigned_users',
								'value'=> $result['data']['assignedto'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['assignedto'] = $result['data']['assignedto'];	
				
					}
				}
				if(isset($result['data']['phase']) && $result['data']['phase']!='' && $result['data']['phase'] != 'null')
				{
					if(!is_array($result['data']['phase']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.phase',
								'value'=> $result['data']['phase'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['phase'] = $result['data']['phase'];	
				
					}
				}
				
				if(isset($result['data']['schdule_status']) && $result['data']['schdule_status']!='' && $result['data']['schdule_status'] != 'null')
                {
				
				if($result['data']['schdule_status'] == 'upcoming')
				 {
                
                 $post_array[] = array(
                                        'field_name' => 'SCHEDULE.start_date',
                                        'from'=> date("Y-m-d"),
                                        'type' => 'daterange'
                                        );
				 $search_session_array['schdule_status'] = $result['data']['schdule_status'];
				  
				  }
				  
				else if($result['data']['schdule_status'] == 'completed')
				 {
				  
					$post_array[] = array(
								'field_name' => 'SCHEDULE.is_completed',
								'value'=> 'Yes', 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['schdule_status'] = $result['data']['schdule_status'];	
				
					
				 }
				 
				else if($result['data']['schdule_status'] == 'progress')
				 {
				     $post_array[] = array(
                                        'field_name' => 'SCHEDULE.end_date',
                                        'to'=> date("Y-m-d"),
                                        'type' => 'daterange'
                                        );
				      $search_session_array['schdule_status'] = $result['data']['schdule_status'];	
				 }
				} 
				
				if(isset($result['data']['daterange']) && $result['data']['daterange']!='' && $result['data']['daterange'] != 'null')
                {
                    $formatted_date = explode(" ",$result['data']['daterange']);
				
                    $post_array[] = array(
                                        'field_name' => 'SCHEDULE.start_date',
                                        'from'=> date("Y-m-d", strtotime($formatted_date[0])),
                                        'to'=> date("Y-m-d", strtotime($formatted_date[2])),
                                        'type' => 'daterange'
                                        );
					$search_session_array['daterange'] = $result['data']['daterange'];
				}
				
				if(isset($result['data']['event']) && $result['data']['event']!='' && $result['data']['event'] != 'null')
				 {
					if(!is_array($result['data']['event']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.title',
								'value'=> $result['data']['event'], 
								'type' => 'like',
							);
					$search_session_array['event'] = $result['data']['event'];	
				
					}
				 }
				 $this->uni_set_session('search', $search_session_array);
				 
				 $where_str = $this->Mod_schedule->build_where($post_array);	


		         

				// Pagination argument
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'SCHEDULE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
				$order_by_where = 'SCHEDULE.modified_on DESC';
				}
				
                // Fetch argument building
				$start_datetime_array = array('start_date'=>'start_date');
				$end_datetime_array = array('end_date'=>'end_date');
                $schedule_args = array('select_fields' => array('SCHEDULE.ub_schedule_id', 'SCHEDULE.title','SCHEDULE.publish_status' ,
				'SCHEDULE.phase,'.$this->Mod_user->format_user_datetime($end_datetime_array,"date").	
				',SCHEDULE.assigned_users',
				'SCHEDULE.is_completed,'.$this->Mod_user->format_user_datetime($start_datetime_array,"date")),
				
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				$result_data = $this->Mod_schedule->get_schedules($schedule_args);
			
				

				// File export request  
			
				
				// The following parameters required for data table
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
				 $count = count($result_data['aaData']);
				
					 for($i=0;$i<$count;$i++)
					{ 
					
						 if(isset($result_data['aaData'][$i]['assigned_users'])){
						 
							$assignees=explode(",",$result_data['aaData'][$i]['assigned_users']);
							$assign_post_array[] = array(
											'field_name' => 'USER.ub_user_id',
											'value'=> $result_data['aaData'][$i]['assigned_users'], 
											'type' => '||',
											'classification' => 'primary_ids'
											
										);
							 $where = $this->Mod_schedule->build_where($assign_post_array);
							 $assign_post_array = '' ;
							 $query_array = array('select_fields' => array('GROUP_CONCAT(CONCAT_WS(" ",USER.first_name,USER.last_name )SEPARATOR ",<br>") AS assignees'),
							 'where_clause' => $where,
							 );			
							$resultdata[] = $this->Mod_schedule->get_users($query_array);
							$finalArray =  $resultdata[$i][0]['assignees'];
						} 
						else 
						{
							$finalArray = "----";
						}
						$result_data['aaData'][$i]['assigned_users'] = $finalArray; 
						if($result_data['aaData'][$i]['start_date'] >=  date("d/m/Y") && $result_data['aaData'][$i]['is_completed'] != 'Yes')
						{
						  $result_data['aaData'][$i]['schedule_status'] = 'Upcoming' ;
						}
						else if($result_data['aaData'][$i]['start_date'] <=  date("d/m/Y")  && $result_data['aaData'][$i]['is_completed'] != 'Yes')
						{
						  $result_data['aaData'][$i]['schedule_status'] = 'In progress' ;
						} 
						else if($result_data['aaData'][$i]['is_completed'] == 'Yes')
						{
						  $result_data['aaData'][$i]['schedule_status'] = 'Completed' ;
						}
						else{
						  $result_data['aaData'][$i]['schedule_status'] = '' ;
						}
					}
					// Get number of records
					$total_count_array = $this->Mod_schedule->get_schedules(array(
												'select_fields' => array('COUNT(SCHEDULE.ub_schedule_id) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_schedule->response($result_data);
			}
			else
			{
				$this->Mod_schedule->response($result);
			}
		}
		else
		{
		    $result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_log->response($result);
		
		}
	}
	/** 
	* Save schedule
	* 
	* @method:  
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* 
	*/	
	public function save_schedule($schedule_id = 0)
	{
		/* $json_array = array(1=>array(1,2,3),2=>array('a','b'));
		json_encode($json_array); */
		
		$data = array(
		'title'        			=> "Save Schedule",		
		'content'      			=> 'content/schedules/save_schedule',
        'page_id'      			=> 'schedules',
		'data_table'   			=>'data_table',			
		'date_all' 	   			=>'date_all',						
		'predecessor_list' 	   	=>'predecessor_list',
		'shifts_list' 	   		=>'shifts_list',		
		'baseline_list' 	   	=>'baseline_list'				
		);
		$action_type = '';
		$edit_schedule_id = 0;
		/*code to create the temp dir and pass it to view*/
		$dir_response = $this->Mod_doc->create_default_dir();
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
			$data['temprory_dir_id'] = '1';
		}
		
		// Variable to decide the post operation
		if( ! empty($this->input->post())) 
		{
			$result = $this->sanitize_input();
			if(isset($result['data']['save_type']))
			{
				$action_type = $result['data']['save_type'];
				unset($result['data']['save_type']);
			}
			if(TRUE === $result['status']) //if sanitize is done
			{
				// Convert comma separated assigned users 
				if(!empty($result['data']['assigned_users']))
				{
					$assign_to = "".implode(",", $result['data']['assigned_users'])."";
				}else{
					$assign_to = '';
				}
				$result['data']['assigned_users'] = $assign_to;
				// Convert comma separated tags 
				if(!empty($result['data']['tags']))
				{
					$tags = "".implode(",", $result['data']['tags'])."";
				}else{
					$tags = '';
				}
				$result['data']['tags'] = $tags;
			}
			else
			{
				$data['status'] = $result['status'];
				$data['message'] = $result['message'];
			}	
		}
		//print_r($result);exit;
		$edit_schedule_id = (isset($result['data']['schedule_id']))?$result['data']['schedule_id']:0;
		$this->schedule_id = ($edit_schedule_id>0)?$edit_schedule_id:$schedule_id;
		//get project id from schedule table // by satheesh kumar
		if(empty($this->project_id) && $this->schedule_id > 0)
		{
			$where_args = array('ub_schedule_id' => $this->schedule_id);
			$project_id_array = $this->Mod_project->get_project_id(UB_SCHEDULE,$where_args);
			//print_r($project_id_array);exit;
			$this->project_id = $project_id_array['aaData'][0]['project_id'];
		}
		//end code for get project id
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		//print_r($all_folder);exit;
		
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
		{
			$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
		}
		
		// Get project info from left collapse menu 
		//echo "--->".$this->project_id;
		// Check for edit case to set the project 
		if($this->schedule_id>0)
		{
			// Fetch from schedule
			$get_schedule_details = $this->get_schedule_info($this->schedule_id);
			// Look for successful retrieval 
			if(TRUE === $get_schedule_details['status'])
			{
				if(TRUE === $get_schedule_details['status'])
				{
					$project_info = $this->Mod_project->get_projects(array('select_fields' =>array('project_name'), 'where_clause' => array('ub_project_id'=>$get_schedule_details['schedule_details']['project_id'])));
					if(TRUE === $project_info['status'])
					{
						$this->project_id = $get_schedule_details['schedule_details']['project_id'];
						$this->project_name = $project_info['aaData'][0]['project_name'];
					}
					else
					{
						$data['status'] = $project_info['status'];
						$data['message'] = $project_info['message'];
					}
				}
				$data['schedule_details'] = $get_schedule_details['schedule_details'] ;
				$data['status'] = $get_schedule_details['status'];
				$data['message'] = $get_schedule_details['message'];
				$get_sub_contractor_list = array('projectid' => $this->project_id, 'scheduleid' => $this->schedule_id);
			}				
			else
			{
				$data['status'] = $get_schedule_details['status'];
				$data['message'] = $get_schedule_details['message'];
			}
		}	
		else // insert case project need to be selected from left collapse
		{
			$get_sub_contractor_list = array('projectid' => $this->project_id, 'scheduleid' => 0);
		}
		//print_r($get_sub_contractor_list);
		$get_sub_contractor_array_list = $this->Mod_schedule->get_sub_contractor_list($get_sub_contractor_list);
		//print_r($get_sub_contractor_array_list);exit;
		if(TRUE === $get_sub_contractor_array_list['status'])
		{
			$data['get_sub_contractor_array_list_details'] = $get_sub_contractor_array_list['aaData'];
		}
		/* chandru code ends here */
		
		// Schedule phase list drop down values
		$nothing_selected_array = array(''=>'Nothing Selected');
		$get_phase_list = array('classification'=>'schedule_phase_list', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')','type' => 'dropdown');
		$phase_list_result = $this->Mod_general_value->get_general_value($get_phase_list);
		$data['phase_list_dropdown'] = $nothing_selected_array + $phase_list_result['values'];
		
		//$phase_list_result = array_unshift($phase_list_result, "apple");
		// Schedule colour drop down values
		$get_colour = array('classification'=>'schedule_colour', 'type'=>'dropdown');
		$schedule_colour_result = $this->Mod_general_value->get_general_value($get_colour);
		$data['colour_dropdown'] = $schedule_colour_result['values'];
		
		// Schedule tags drop down values
		$get_schedule_tags = array('classification'=>'schedule_tags', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')','type' => 'dropdown');
		$schedule_tags_result = $this->Mod_general_value->get_general_value($get_schedule_tags);
		$data['schedule_tags_dropdown'] = $schedule_tags_result['values'];

		//Fetch all reminder
		$args = array('classification'=>'reminder', 'where_clause' => '("int01" = 0)', 'type' => 'dropdown');
		$reminder_dropdown = $this->Mod_general_value->get_general_value($args);
		$data['schedule_reminder_dropdown'] = $reminder_dropdown['values'];
		// Predecessor drop down 
		$get_schedule_predecessor = array('builder_id' => $this->builder_id,'project_id'=>$this->project_id,'schedule_id' =>($this->schedule_id>0)?$this->schedule_id:0);
		$schedule_predecessor_result = $this->Mod_schedule->get_all_predecessors($get_schedule_predecessor);
		if(TRUE === $schedule_predecessor_result['status'])
		{
			$schedule_predecessor_dropdown = $this->Mod_schedule->build_ci_dropdown_array($schedule_predecessor_result['aaData'],'ub_schedule_id','title,start_date,end_date','append');
			$data['schedule_predecessor_dropdown'] = $schedule_predecessor_dropdown;
		}		 
		/* Below predecessor drop down code was added by chandru on 11-05-2015 */
		$schedule_time[] = array('id' => 'Finish to Start','val' => 'Finish to Start');
        $schedule_time[] = array('id' => 'Start to Start','val' => 'Start to Start');
        $data['predecessor_type'] = $this->Mod_schedule->build_ci_dropdown_array($schedule_time,'id','val'); 
		//Edit (or) view the Schedule details
		if($this->schedule_id > 0 )
		{
			// Code related to file upload functionality 
			$schedule_data = array('flag' => 1, 
							  'builder_id'	=> $this->user_session['builder_id'],
							  'projectid' => $this->project_id,
							  'folderid' => 0,
							  'modulename' => $this->module,
							  'moduleid' => $this->schedule_id
							);
			//print_r($schedule_data);	exit;			
			$result_array = $this->Mod_doc->get_files_for_folder($schedule_data);
			$count = count($result_array);
			$session_id = $this->session->userdata('session_id');
			for ($i=0; $i < $count ; $i++)
			{
				if(isset($result_array[$i]['system_file_name']) && !empty($result_array[$i]['system_file_name']))
				{
					$exp = explode('/', DOC_PATH.$result_array[$i]['system_file_name']);

					$thumb_array = array(
											'source_image' => DOC_PATH.$result_array[$i]['system_file_name'],
											'new_image' => DOC_TEMP_PATH.$session_id.'/'.$dir_response['thumbnail_path'].'/'.$exp[count($exp)-1]
									);
					$this->create_thumb($thumb_array);
					//$image_path = $result_array[$i]['system_file_name'];
					copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);
				}
			}
			// Code related to file upload functionality ends here 

			
			// Schedule assigned to users 
			$get_user_assigned_to = array('schedule_id' => $this->schedule_id);
			$user_assigned_to_result = $this->Mod_schedule->get_schedule_assigned_to($get_user_assigned_to);
			
			if(TRUE === $user_assigned_to_result['status'])
			{
				$user_assigned_selected = array();
				foreach($user_assigned_to_result['aaData'] as $assigned_users)
				{
					$user_assigned_selected[] = $assigned_users['ub_user_id'];
				}
				$data['assigned_to_selected'] = implode(',',$user_assigned_selected);
			}
			// Schedule view users 
			$get_user_view = array('schedule_id' => $this->schedule_id);
			$user_assigned_view = $this->Mod_schedule->get_schedule_view_users($get_user_view);
			if(TRUE === $user_assigned_view['status'])
			{
				$data['get_sub_contractor_selected_details'] = $user_assigned_view['aaData'];
			}
			// Predecessor assigned to schedule 
			$get_assigned_predecessors = array('schedule_id' => $this->schedule_id);
			$assigned_predecessors_result = $this->Mod_schedule->get_schedule_predecessors($get_assigned_predecessors);
			
			//print_r($assigned_predecessors_result);exit;
			if(TRUE === $assigned_predecessors_result['status'])
			{
				$data['assigned_predecessors'] = $assigned_predecessors_result['aaData'];
			}
			//update schedule details
			if(isset($result['data']) && count($result['data'])>0 && $action_type != '')
			{
				// Check end date or start date change or duration for notification email 
				$start_date = $result['data']['start_date'];
				$end_date = $result['data']['end_date'];
				$duration = $result['data']['no_of_days'];
				$db_start_date = $result['data']['db_start_date'];
				$db_end_date = $result['data']['db_end_date'];
				$db_duration = $result['data']['db_duration'];
				$start_date_flag = 0;
				$end_date_flag = 0;	
				$duration_flag = 0 ;
				$completed_status_flag = 0;
				$reminder_flag =0;
				$predecessor_flag = 0;
				if($start_date != $db_start_date)
				{
					$start_date_flag = 1;
				}
				if($end_date != $db_end_date)
				{
					$end_date_flag = 1;	
				}
				if($duration != $db_duration)
				{
					$duration_flag = 1;
				}
				
				
				// Check completed status change for notification email 
				$completed_status = $result['data']['is_completed'];
				$db_completed_status = $result['data']['hide_is_completed'];
				if($completed_status == 'Yes' && $db_completed_status=='No')
				{
					// Send notification email 
					$completed_status_flag = 1;
				}
				// Check for reminder id change in update
				$reminder_value = $result['data']['reminder'];
				$db_reminder_value = $result['data']['hide_reminder_id'];
				if($reminder_value != $db_reminder_value)
				{
					// Send reminder email 
					$reminder_flag = 1;
				}
				// Check for predecessor change and set the flag
				// updated values
				
				$update_response = array();
				$predecessor_name_array = $result['data']['predecessor_list'];
				$predecessor_type_array = $result['data']['predecessor_type'];
				$predecessor_lag_array = $result['data']['lag'];
				// db values
				$predecessor_db_name_array = (isset($result['data']['hide_predecessor_list']))?$result['data']['hide_predecessor_list']:array();
				$predecessor_db_type_array = (isset($result['data']['hide_predecessor_type']))?$result['data']['hide_predecessor_type']:array();
				$predecessor_db_lag_array = (isset($result['data']['hide_lag']))?$result['data']['hide_lag']:array();
				
				// identify the difference
				// Set blank array if value is blank
				$predecessor_name_array = (isset($predecessor_name_array) && count($predecessor_name_array)>0)?$predecessor_name_array:array('');
				$predecessor_db_name_array = (isset($predecessor_db_name_array) && count($predecessor_db_name_array)>0)?$predecessor_db_name_array:array('');
				if(count($predecessor_name_array)>0)
				{
					//$predecessor_flag = 1;
				}
				
				
				
				
				// Set the master values array in the left to get the difference
				if(count($predecessor_name_array)>count($predecessor_db_name_array))
				{
					$predecessor_name_diff = array_diff($predecessor_name_array, $predecessor_db_name_array);
				}
				else if(count($predecessor_db_name_array)>count($predecessor_name_array))
				{
					$predecessor_name_diff = array_diff($predecessor_db_name_array, $predecessor_name_array);
				}
				else
				{
					$predecessor_name_diff = array_diff($predecessor_name_array, $predecessor_db_name_array);
				}	
				// Set blank array if value is blank
				$predecessor_type_array = (isset($predecessor_type_array) && count($predecessor_type_array)>0)?$predecessor_type_array:array('');
				$predecessor_db_type_array = (isset($predecessor_db_type_array) && count($predecessor_db_type_array)>0)?$predecessor_db_type_array:array('');
				// Set the master values array in the left to get the difference
				if(count($predecessor_type_array)>count($predecessor_db_type_array))
				{
					$predecessor_type_diff = array_diff($predecessor_type_array, $predecessor_db_type_array);
				}
				else if(count($predecessor_db_type_array)>count($predecessor_type_array))
				{
					$predecessor_type_diff = array_diff($predecessor_db_type_array, $predecessor_type_array);
				}
				else
				{
					$predecessor_type_diff = array_diff($predecessor_type_array, $predecessor_db_type_array);
				}	
				
				// Set blank array if value is blank
				$predecessor_lag_array = (isset($predecessor_lag_array) && count($predecessor_lag_array)>0)?$predecessor_lag_array:array('');
				$predecessor_db_lag_array = (isset($predecessor_db_lag_array) && count($predecessor_db_lag_array)>0)?$predecessor_db_lag_array:array('');

				// Set the master values array in the left to get the difference
				if(count($predecessor_lag_array)>count($predecessor_db_lag_array))
				{
					$predecessor_lag_diff = array_diff($predecessor_lag_array, $predecessor_db_lag_array);
				}
				else if(count($predecessor_db_lag_array)>count($predecessor_lag_array))
				{
					$predecessor_lag_diff = array_diff($predecessor_db_lag_array, $predecessor_lag_array);

				}
				else
				{
					$predecessor_lag_diff = array_diff($predecessor_lag_array, $predecessor_db_lag_array);
				}	
				
				//print_r($result);
				//print_r($predecessor_lag_array);
				//print_r($predecessor_db_lag_array);
				//print_r($predecessor_lag_diff);
				
				$viewable_access_flag = 0;
				$assigned_users_flag = 0;
				
				$db_predecessor_count = (isset($result['data']['hide_db_predecessor_count']))?$result['data']['hide_db_predecessor_count']:0;
				$predecessor_count =  (isset($result['data']['hide_predecessor_count']))?$result['data']['hide_predecessor_count']:0;
				// Check predecessor count
				if(($db_predecessor_count > $predecessor_count) OR ($predecessor_count>$db_predecessor_count))
				{
					//$predecessor_flag = 1;
					// compare predecessor name
					if(is_array($predecessor_name_diff) && count($predecessor_name_diff)>0)
					{
						$predecessor_flag = 1;
					}
					// compare predecessor type
					if(is_array($predecessor_type_diff) && count($predecessor_type_diff)>0)
					{
						$predecessor_flag = 1;
					}
					// compare predecessor lag
					if(is_array($predecessor_lag_diff) && count($predecessor_lag_diff)>0)
					{
						$predecessor_flag = 1;
					}					
				}
				else if($db_predecessor_count > 0 && $predecessor_count > 0 && $db_predecessor_count == $predecessor_count)
				{
					for($i=0;$i<$predecessor_count;$i++)
					{
						// Predecessor name changed in update
						if($predecessor_name_array[$i] != $predecessor_db_name_array[$i])
						{
							$predecessor_flag = 1;
						}
						// Predecessor type changed in update 
						if($predecessor_type_array[$i] != $predecessor_db_type_array[$i])
						{
							$predecessor_flag = 1;
						}				
						// Predecessor lag changed in update
						if($predecessor_lag_array[$i] != $predecessor_db_lag_array[$i])
						{
							$predecessor_flag = 1;
						}						
					}
				}
				// Check for view access user change and set the flag
				// updated values
				$schedule_view_access_users = explode(",",$result['data']['project_view_access']);
				$schedule_view_access_users = array_filter($schedule_view_access_users);
				// db values
				$schedule_view_access_users_db = explode(",",$result['data']['hide_project_view_access']);
				$schedule_view_access_users_db = array_filter($schedule_view_access_users_db);
				//print_r($schedule_view_access_users);
				//print_r($schedule_view_access_users_db);
				// Set blank array if value is blank
				$schedule_view_access_users = (isset($schedule_view_access_users) && count($schedule_view_access_users)>0)?$schedule_view_access_users:array('');
				// Set blank array if value is blank
				$schedule_view_access_users_db = (isset($schedule_view_access_users_db) && count($schedule_view_access_users_db)>0)?$schedule_view_access_users_db:array('');
				// Set the master values array in the left to get the difference
				if(count($schedule_view_access_users)>count($schedule_view_access_users_db))
				{
					// identify the difference
					$schedule_view_access_users_diff = array_diff($schedule_view_access_users, $schedule_view_access_users_db);	
				}
				else if(count($schedule_view_access_users_db)>count($schedule_view_access_users))
				{
					// identify the difference
					$schedule_view_access_users_diff = array_diff($schedule_view_access_users_db, $schedule_view_access_users);	
				}
				else
				{
					// identify the difference
					$schedule_view_access_users_diff = array_diff($schedule_view_access_users, $schedule_view_access_users_db);	
				}	
				//print_r($schedule_view_access_users);
				//print_r($schedule_view_access_users_db);
				//print_r($schedule_view_access_users_diff);
				// compare view access
				if(is_array($schedule_view_access_users_diff) && count($schedule_view_access_users_diff)>0)
				{
					$viewable_access_flag = 1;
				}

				// Check for assign user change and set the flag
				// updated values
				$schedule_assigned_users = explode(",",$result['data']['assigned_users']);
				$schedule_assigned_users = array_filter($schedule_assigned_users);
				// db values
				$schedule_assigned_users_db = explode(",",$result['data']['assigned_to_selected']);
				$schedule_assigned_users_db = array_filter($schedule_assigned_users_db);
				// Set blank array if value is blank
				$schedule_assigned_users = (isset($schedule_assigned_users) && count($schedule_assigned_users)>0)?$schedule_assigned_users:array('');
				// Set blank array if value is blank
				$schedule_assigned_users_db = (isset($schedule_assigned_users_db) && count($schedule_assigned_users_db)>0)?$schedule_assigned_users_db:array('');
				// Set the master values array in the left to get the difference
				if(count($schedule_assigned_users)>count($schedule_assigned_users_db))
				{
					// identify the difference
					$schedule_assigned_users_diff = array_diff($schedule_assigned_users, $schedule_assigned_users_db);
				}
				else if(count($schedule_assigned_users_db)>count($schedule_assigned_users))
				{
					// identify the difference
					$schedule_assigned_users_diff = array_diff($schedule_assigned_users_db, $schedule_assigned_users);
				}
				else
				{
					// identify the difference
					$schedule_assigned_users_diff = array_diff($schedule_assigned_users, $schedule_assigned_users_db);
				}	
				// compare view access
				if(is_array($schedule_assigned_users_diff) && count($schedule_assigned_users_diff)>0)
				{
					$assigned_users_flag = 1;
				}
				//$predecessor_flag =1;
				$result['data']['predecessor_flag'] = $predecessor_flag;	
				$result['data']['viewable_access_flag'] = $viewable_access_flag;
				$result['data']['assigned_users_flag'] = $assigned_users_flag;
				$result['data']['end_date_flag'] = $end_date_flag;
				$result['data']['reminder_flag'] = $reminder_flag;
				//print_r($result);exit;
				$update_result = $this->Mod_schedule->update_schedule($result['data']);
				if(TRUE === $update_result['status'])
				{
					if($update_result['ub_schedule_id']>0) 
					{	
						if($end_date_flag === 1 || $completed_status_flag === 1)
						{
							// Notification input array
							$notification_input_array = array();
							$notification_input_array['title'] = $result['data']['title'];
							
							$notification_input_array['viewable_users'] = $result['data']['project_view_access'];
							$notification_input_array['assigned_users'] = $result['data']['assigned_users'];
							$notification_input_array['end_date'] = $end_date;	
							if($end_date_flag === 1)
							{
								/* Notification code added by chandru */
								// notification if end date is changed
								$notification_input_array['base_end_date'] = $db_end_date;
								$send_notification = $this->Mod_schedule->send_mail_for_notification($notification_input_array);
								
							}
							if($completed_status_flag === 1)
							{
								// notification if completed status updated
								$send_notification = $this->Mod_schedule->send_mail_for_notification($notification_input_array);
							}
						}
						$update_response['schedule_id'] = $update_result['ub_schedule_id'];
						$update_response['status'] = $update_result['status'];
						$update_response['message'] = $update_result['message'];
					}
					else
					{
						$update_response['status'] = FALSE;
						$update_response['message'] = 'Operation failed : Fetching schedule has a problem!';
					}
				}
				else
				{
					$update_response['status'] = $update_result['status'];
					$update_response['message'] = $update_result['message'];
				}
				$this->Mod_schedule->response($update_response);
			}
			
		}
		else if($action_type != '')
		{
			//Below condition will insert the schedule details
			$insert_response = array();
			if(isset($result['data']) && count($result['data'])>0) 
			{
				$add_result = $this->Mod_schedule->add_schedule($result['data']);
				if(TRUE === $add_result['status'])
				{
					if($add_result['ub_schedule_id']>0) 
					{	
						$insert_response['schedule_id'] = $add_result['ub_schedule_id'];
						$insert_response['status'] = $add_result['status'];
						$insert_response['message'] = $add_result['message'];
					}
					else
					{
						$insert_response['status'] = FALSE;
						$insert_response['message'] = 'Operation failed : Fetching schedule has a problem!';
					}
				}
				else
				{
					$insert_response['status'] = $add_result['status'];
					$insert_response['message'] = $add_result['message'];
				}
			}
			else
			{
				$insert_response['status'] = $result['status'];
				$insert_response['message'] = $result['message'];
			}
			$this->Mod_schedule->response($insert_response);
		}
		$this->template->view($data);
	}
	/** 
	* Get Schedule info 
	* 
	* @method: get_schedule_info
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	* @createdby: Thiyagaraj R
	*/	
	private function get_schedule_info($schedule_id=0)
	{
		$data = array();
		if($schedule_id>0)
		{
			$schedule_id_array = array('scheduleid' =>$schedule_id);
			$get_schedule_details = $this->Mod_schedule->get_schedule_details($schedule_id_array);
			//print_r($get_schedule_details);
			if(TRUE === $get_schedule_details['status'])
			{
				$data['status'] = $get_schedule_details['status'];
				$data['message'] = $get_schedule_details['message'];
				$data['schedule_details'] = $get_schedule_details['aaData'];
				$multiple_tag = $get_schedule_details['aaData']['tags'];
				$selected_tags = explode(",",$multiple_tag);
				$selected_tags = array_filter($selected_tags);
				$data['schedule_details']['selected_tags'] = $selected_tags;
				$data['schedule_details']['start_date'] = (isset($data['schedule_details']['start_date']) && $data['schedule_details']['start_date']!='')?date("m/d/Y", strtotime($data['schedule_details']['start_date'])):'';
				
				$data['schedule_details']['end_date'] = (isset($data['schedule_details']['end_date']) && $data['schedule_details']['end_date']!='')?date("m/d/Y", strtotime($data['schedule_details']['end_date'])):'';
				
				$data['schedule_details']['base_start_date'] = (isset($data['schedule_details']['base_start_date']) && $data['schedule_details']['base_start_date']!='')?date("m/d/Y", strtotime($data['schedule_details']['base_start_date'])):'';
				
				$data['schedule_details']['base_end_date'] = (isset($data['schedule_details']['base_end_date']) && $data['schedule_details']['base_end_date']!='')?date("m/d/Y", strtotime($data['schedule_details']['base_end_date'])):'';
			}		
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation failed; schedule primary key is missing!';
		}
		//print_r($data);exit;
		return $data;
	}
	/** 
	* Get Schedules Calender
	* 
	* @method: get_schedules_calender
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	* @createdby: pranab
	*/	
	public function get_schedules_calender()
	{
       
	   
		if( ! empty($this->input->post()))
		{
	
			// Sanitize input
			$result = $this->sanitize_input();
		
			if(TRUE === $result['status'])
			{
		
			   // Getting data of a particular builder
				$post_array[] = array(
									'field_name' => 'SCHEDULE.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									);
				/*  if($this->project_id > 0)
		         {
			       $post_array[] = array(
									'field_name' => 'SCHEDULE.project_id',
									'value'=> $this->project_id, 
									'type' => '='
									);
		         } */
				if(!empty($this->project_id))
				{
					$post_array[] = array(
										'field_name' => 'SCHEDULE.project_id',
										'value'=> $this->project_id, 
										'type' => '='
										);
				}
				else
				{
					$post_array[] = array(
									'field_name' => 'SCHEDULE.project_id',
									'value'=> $this->users_project_ids, 
									'type' => '||',
									'classification' => 'primary_ids'
								);
				}		
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				//No task tag filter field
				 if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
				{
					if(!is_array($result['data']['tags']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.tags',
								'value'=> $result['data']['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['tags'] = $result['data']['tags'];	
				
					}
				}	
				if(isset($result['data']['assignedto']) && $result['data']['assignedto']!='' && $result['data']['assignedto'] != 'null')
				{
					if(!is_array($result['data']['assignedto']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.assigned_users',
								'value'=> $result['data']['assignedto'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['assigned_users'] = $result['data']['assignedto'];	
				
					}
				}
				if(isset($result['data']['phase']) && $result['data']['phase']!='' && $result['data']['phase'] != 'null')
				{
					if(!is_array($result['data']['phase']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.phase',
								'value'=> $result['data']['phase'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['phase'] = $result['data']['phase'];	
				
					}
				}
				
				if(isset($result['data']['status']) && $result['data']['status']!='' && $result['data']['status'] != 'null')
                {
				
				if($result['data']['status'] == 'upcoming')
				 {
                
                 $post_array[] = array(
                                        'field_name' => 'SCHEDULE.start_date',
                                        'from'=> date("Y-m-d"),
                                        'type' => 'daterange'
                                        );
				 $search_session_array['status'] = $result['data']['status'];
				  
				  }
				  
				else if($result['data']['status'] == 'completed')
				 {
				  
					$post_array[] = array(
								'field_name' => 'SCHEDULE.is_completed',
								'value'=> 'Yes', 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['status'] = $result['data']['status'];	
				
					
				 }
				 
				else if($result['data']['status'] == 'progress')
				 {
				     $post_array[] = array(
                                        'field_name' => 'SCHEDULE.end_date',
                                        'from'=> date("Y-m-d"),
                                        'type' => 'daterange'
                                        );
				      $search_session_array['status'] = $result['data']['status'];	
				 }
				} 
				$this->uni_set_session('search', $search_session_array);
				// Where clause argument
				$where_str = $this->Mod_schedule->build_where($post_array);

				/* $query_array = array('select_fields' => array('SCHEDULE.ub_schedule_id AS id', 'SCHEDULE.title AS title', 'SCHEDULE.start_date AS start', 'SCHEDULE.end_date AS end','SCHEDULE.colour AS backgroundColor'),
				'where_clause' => $where_str );

				$result_data = $this->Mod_schedule->get_schedules($query_array); */	
				
				$result_data = $this->Mod_schedule->get_link_to_schedules($where_str);
				// echo '<pre>link-to';print_r($link_to_schedule_result_data);exit;
			}
			else
			{
				$this->Mod_schedule->response($result);
			}
		}	
		else
		{ 
	
			$query_array = array('select_fields' => array('SCHEDULE.ub_schedule_id AS id', 'SCHEDULE.title AS title', 'SCHEDULE.start_date AS start', 'SCHEDULE.end_date AS    end','SCHEDULE.colour AS backgroundColor','SCHEDULE.phase AS phase',	'SCHEDULE.assigned_users  AS  assigned_users','SCHEDULE.is_completed AS  is_completed'),
		    'where_clause' => array('SCHEDULE.builder_id'=>$this->user_session['builder_id']));
            $result_data = $this->Mod_schedule->get_schedules($query_array);
	}	
	
        $this->Mod_schedule->response($result_data['aaData']); 
	}
	/** 
	* Get Schedules Gantt
	* 
	* @method: get_schedules_gantt
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	*/	
	public function get_schedules_gantt()
	{
		$gantt_param_array = array();
			$search_session_array = array();	
			 $gantt_param_array['builderid'] = $this->user_session['builder_id'];
			  if($this->project_id > 0)
		      {
			     $gantt_param_array['projectid'] = $this->project_id ;
		      }
			 else
			 {
			    $gantt_param_array['projectid'] = 0 ;
			 }
			 if( ! empty($this->input->post()))
		   {
			// Sanitize input
			$result = $this->sanitize_input();
			 if(isset($result['data']['assignedto']) && $result['data']['assignedto']!='' && $result['data']['assignedto'] != 'null')
			{
				 $gantt_param_array['assignedto'] = $result['data']['assignedto'] ;	
				 $search_session_array['assigned_users'] = $result['data']['assignedto'];	
			}
			else{
			   $gantt_param_array['assignedto'] = '' ;
			}
			
			if(isset($result['data']['status']) && $result['data']['status']!='' && $result['data']['status'] != 'null')
            {
				 $gantt_param_array['schststus'] = $result['data']['status'] ;	
				 $search_session_array['status'] = $result['data']['status'];	
		    }  
            else{
                 $gantt_param_array['schststus'] = '' ;
             }			 
				//No task tag filter field
			if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
			{
				$gantt_param_array['schtags'] = $result['data']['tags'] ;
				$search_session_array['tags'] = $result['data']['tags'];	
			}
            else{
			   $gantt_param_array['schtags'] = '' ;
            }			
			if(isset($result['data']['phase']) && $result['data']['phase']!='' && $result['data']['phase'] != 'null')
			{
				$gantt_param_array['schphase'] = $result['data']['phase'] ;
				$search_session_array['phase'] = $result['data']['phase'];	
			
			}
			else
			{
			  $gantt_param_array['schphase'] = '' ;
			}
				
			if(isset($result['data']['daterange']) && $result['data']['daterange']!='' && $result['data']['daterange'] != 'null')
			{
				$formatted_date = explode(" ",$result['data']['daterange']);
				$gantt_param_array['rangestart'] = date("Y-m-d", strtotime($formatted_date[0])) ;
				$gantt_param_array['rangeend']  = date("Y-m-d", strtotime($formatted_date[2])) ;
				$search_session_array['daterange'] = $result['data']['daterange'];
			}
				else
				{
					$gantt_param_array['rangestart'] = '' ;
					$gantt_param_array['rangeend']  = '' ;
				}			
			}
            else
            {
                $gantt_param_array['assignedto'] = '' ;
				$gantt_param_array['schststus'] = '' ;
				$gantt_param_array['schtags'] = '' ;
				$gantt_param_array['schphase'] = '' ;
				$gantt_param_array['rangestart'] = '' ;
				$gantt_param_array['rangeend']  = '' ;
				
            }	
			$gantt_param_array['dateformat']  = '%d-%m-%Y';
			$gantt_param_array['csschids']  = '' ;
			$gantt_param_array['schids']  = '' ;

            $result_data = $this->Mod_schedule->get_schedules_ganttchart($gantt_param_array);
			
	        $resultdata = $this->Mod_schedule->get_schedules_ganttlink($gantt_param_array);
		
		/* }	 */
		// $this->Mod_schedule->response($result_data['aaData']);
		$respone['schedule_list'] = $result_data['aaData'];
		$respone['link_to']       = $resultdata['aaData'];

		$this->Mod_schedule->response($respone);
	}
	/** 
	* Get Schedules Baseline
	* 
	* @method: get_schedules_baseline
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	*/	
	public function get_schedules_baseline()
	{	
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{	
				$post_array = array();
				$search_session_array = array();
				/* if(isset($result['data']['daterange']) && $result['data']['daterange']!='')
				{
					$formatted_date = explode(" ",$result['data']['daterange']);
					$post_array['daterange'] = $formatted_date[0];
					$search_session_array['daterange'] = $result['data']['daterange'];
				} */
				if(isset($result['data']['daterange']) && $result['data']['daterange']!='' && $result['data']['daterange'] != 'null')
				{
					$formatted_date = explode(" ",$result['data']['daterange']);
					$post_array['rangestart'] = date("Y-m-d", strtotime($formatted_date[0])) ;
					$post_array['rangeend']  = date("Y-m-d", strtotime($formatted_date[2])) ;
					$search_session_array['daterange'] = $result['data']['daterange'];
				}
				else
				{
					$post_array['rangestart'] = '' ;
					$post_array['rangeend']  = '' ;
				}
				if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags']!='Nothing selected' && $result['data']['tags']!='null')
				{
					$post_array['tags'] = $result['data']['tags'];
					$search_session_array['tags'] = $result['data']['tags'];
				}
				if(isset($result['data']['assignedto']) && $result['data']['assignedto']!='' && $result['data']['assignedto']!='null')
				{
					$post_array['assignedto'] = $result['data']['assignedto'];
					$search_session_array['assignedto'] = $result['data']['assignedto'];
				}
				if(isset($result['data']['schdule_status']) && $result['data']['schdule_status']!='' && $result['data']['schdule_status']!='null')
				{
					if($result['data']['schdule_status'] == 'upcoming')
					{
						$post_array['schdule_status'] = 'upcoming';
					}
					else if($result['data']['schdule_status'] == 'progress')
					{
						$post_array['schdule_status'] = 'progress';
					}
					else if($result['data']['schdule_status'] == 'completed')
					{
						$post_array['schdule_status'] = 'completed';	
					}
					$search_session_array['schdule_status'] = $result['data']['schdule_status'];
				}
				if(isset($result['data']['phase']) && $result['data']['phase']!='' && $result['data']['phase']!='null')
				{
					$post_array['phase'] = $result['data']['phase'];
					$search_session_array['phase'] = $result['data']['phase'];
				}
				$post_array['dateformat']  = $this->user_session['date_format'];
				// echo '<pre>';print_r($post_array);exit;
				//Setting session 
				$this->uni_set_session('search', $search_session_array);

				$result_data = $this->Mod_schedule->get_schedule_baseline($post_array);
				// The following parameters required for data table
				// echo '<pre>';print_r($result_data);
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
					//Get number of records
					$total_count_array = count($result_data['aaData']); 
					$result_data['iTotalRecords'] = $total_count_array;
					$result_data['iTotalDisplayRecords'] = $total_count_array;
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}  
				$this->Mod_schedule->response($result_data);
			}
			else
			{
				$this->Mod_schedule->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_schedule->response($result);
		}
	}
	/** 
	* Get Schedules Phase List
	* 
	* @method: get_schedules_phase_list
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	  Gayathri Kalyani
	*/	
	public function get_schedules_phase_list()
	{
		$post_array[] = array(
							'field_name' => 'SCHEDULE.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		/* if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'SCHEDULE.project_id',
							'value'=> $this->project_id, 
							'type' => '='
						);
		} */
		if(!empty($this->project_id))
		{
			$post_array[] = array(
								'field_name' => 'SCHEDULE.project_id',
								'value'=> $this->project_id, 
								'type' => '='
								);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'SCHEDULE.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}	
		   // echo '<pre>';print_r($post_array);
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
			
			if(isset($result['data']['assignedto']) && $result['data']['assignedto']!='' && $result['data']['assignedto'] != 'null')
				{
					if(!is_array($result['data']['assignedto']))
					{
					$post_array[] = array(
								'field_name' => 'SCHEDULE.assigned_users',
								'value'=> $result['data']['assignedto'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['assigned_users'] = $result['data']['assignedto'];	
				
					}
				}
				if(isset($result['data']['schdule_status']) && $result['data']['schdule_status']!='' && $result['data']['schdule_status'] != 'null')
                {
				
				if($result['data']['schdule_status'] == 'upcoming')
				 {
                
                 $post_array[] = array(
                                        'field_name' => 'SCHEDULE.start_date',
                                        'from'=> date("Y-m-d"),
                                        'type' => 'daterange'
                                        );
				 $search_session_array['schdule_status'] = $result['data']['schdule_status'];
				  
				  }
				  
				else if($result['data']['schdule_status'] == 'completed')
				 {
				  
					$post_array[] = array(
								'field_name' => 'SCHEDULE.is_completed',
								'value'=> 'Yes', 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
					$search_session_array['schdule_status'] = $result['data']['schdule_status'];	
				
					
				 }
				 
				else if($result['data']['schdule_status'] == 'progress')
				 {
				     $post_array[] = array(
                                        'field_name' => 'SCHEDULE.end_date',
                                        'to'=> date("Y-m-d"),
                                        'type' => 'daterange'
                                        );
				      $search_session_array['schdule_status'] = $result['data']['schdule_status'];	
				 }
				} 
					// echo '<pre>';print_r($post_array);
					if(isset($result['data']['tags']) && $result['data']['tags']!='' && $result['data']['tags'] != 'null')
					{
					 // echo '<pre>';print_r($result);exit;	
						$post_array[] = array(
								'field_name' => 'SCHEDULE.tags',
								'value'=> $result['data']['tags'], 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
							$search_session_array['tags'] = $result['data']['tags'];
					}
					
					if(isset($result['data']['daterange']) && $result['data']['daterange']!='' && $result['data']['daterange'] != 'null')
                {
                    $formatted_date = explode(" ",$result['data']['daterange']);
				
                    $post_array[] = array(
                                        'field_name' => 'SCHEDULE.start_date',
                                        'from'=> date("Y-m-d", strtotime($formatted_date[0])),
                                        'to'=> date("Y-m-d", strtotime($formatted_date[2])),
                                        'type' => 'daterange'
                                        );
					$search_session_array['daterange'] = $result['data']['daterange'];
				}
				
			 $where_str = $this->Mod_schedule->build_where($post_array);
         // echo '<pre>';print_r($where_str); exit;
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records

					 $total_count_array = $this->Mod_schedule->get_schedules_phase_list(array(
												'select_fields' => array('COUNT(SCHEDULE.ub_schedule_id) AS total_count'),
												'where_clause' => $where_str,
												'join'=> array('user'=>'Yes','builder'=>'Yes')
												)); 

				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					//echo $result['data'][$dt_filed_name.$sort_filed_column_id];
					$order_by_where = 'SCHEDULE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
				$order_by_where = 'SCHEDULE.modified_on DESC';
				}
			}
			else
			{
				$this->mod_schedule->response($result);
			}
		}
		$project_cond = '';
		if($this->project_id != '')
		{
			$project_cond = "AND SCHEDULE1.project_id = ".$this->project_id;
		}
		$datetime_array = array('SCHEDULE.start_date'=> 'start_date','SCHEDULE.end_date'=> 'end_date');
		
		
		 $query_array = array('select_fields' => array('SCHEDULE.ub_schedule_id','IF (SCHEDULE.phase="","Unassigned", SCHEDULE.phase) AS phase ','MIN(SCHEDULE.start_date)AS start_date','MAX(SCHEDULE.end_date)AS end_date','(select count(SCHEDULE1.ub_schedule_id) FROM (`ub_schedule` AS SCHEDULE1) where SCHEDULE1.phase = SCHEDULE.phase AND SCHEDULE1.builder_id ='.$this->builder_id.' '.$project_cond.') AS associated_items','(select count(SCHEDULE2.ub_schedule_id)FROM (`ub_schedule` AS SCHEDULE2) where SCHEDULE2.phase = SCHEDULE.phase AND SCHEDULE2.is_completed = "Yes" AND SCHEDULE2.builder_id ='.$this->builder_id.') AS completed_items',
		 'SCHEDULE.is_completed,'.$this->Mod_user->format_user_datetime($datetime_array,"date")),
		 'join'=> array('user'=>'Yes','builder'=>'Yes'),
		 'where_clause' => $where_str,
		 'order_clause' => $order_by_where,
		 'group_clause' => array("SCHEDULE.phase"),
		 'pagination' => $pagination_array
		);
		
		 // echo '<pre>';print_r( $query_array);
		$result_data = $this->Mod_schedule->get_schedules_phase_list($query_array);
		/* Below loop code was added by chandru */
		if(TRUE == $result_data['status'])
		{
			for($i = 0;$i < count($result_data['aaData']); $i++)
			{
				if(empty($result_data['aaData'][$i]['is_completed']))
				{
					$result_data['aaData'][$i]['is_completed'] = 'No';
				}
			}
		}
		/* chandru code ends here */
		unset($query_array['pagination']);
		$result_count_array = $this->Mod_schedule->get_schedules_phase_list($query_array);
		
	    // echo '<pre>';print_r($result_data);exit;
		$final_result_data = array();
		if(TRUE === $result_data['status'])
		{
		 foreach($result_data['aaData'] as $key => $val)
			{
				$post_array_choice = array();
				if($result_data['aaData'][$key]['phase'] != 'Unassigned')
				{	
					$post_array_choice[] = array(
									 'field_name' =>'SCHEDULE.phase',
									 'value'=> $result_data['aaData'][$key]['phase'],
									 'type' => '='
								 );	
				}
				else
				{
					$post_array_choice[] = array(
									 'field_name' =>'SCHEDULE.phase',
									 'value'=> '',
									 'type' => '='
								 );	
				}			
				 $post_array_choice[] = array(
									 'field_name' => 'SCHEDULE.builder_id',
									 'value'=> $this->user_session['builder_id'],
									 'type' => '='
								 );	
				if(!empty($this->project_id))
				{
					 $post_array_choice[] = array(
							'field_name' => 'SCHEDULE.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);
							
				}							 
				 $where_str = $this->Mod_schedule->build_where($post_array_choice);
				  // echo '<pre>';print_r($where_str);	
				 // echo $where_str;exit;
				 $datetime_array = array('SCHEDULE.start_date'=> 'start_date','SCHEDULE.end_date'=> 'end_date');
				 $query_array = array('select_fields' => array(('SCHEDULE.title AS schedule_item_name'),'SCHEDULE.no_of_days','SCHEDULE.start_date','SCHEDULE.end_date','SCHEDULE.is_completed', 'GROUP_CONCAT(CONCAT_WS(" ",USERS.first_name,USERS.last_name )SEPARATOR ",<br>") AS assigned_users,'.$this->Mod_user->format_user_datetime($datetime_array,"date")),
				  'group_clause' => array("SCHEDULE.ub_schedule_id"),
				  'join'=> array('user'=>'Yes','schedule_assigned_users'=>'yes'),
				 'where_clause' => $where_str
			  );
				 // echo '<pre>';print_r($post_array_choice);
				  $choice = $this->Mod_schedule->get_schedule_items_list($query_array);
				 $result_data['aaData'][$key]['schedule_items'] = (isset($choice['aaData']))?$choice['aaData']:'';
			}
			
		 }
		
				  
		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			$result_data['iTotalRecords'] = isset($result_count_array['aaData'])?count($result_count_array['aaData']):'';
			$result_data['iTotalDisplayRecords'] = isset($result_count_array['aaData'])?count($result_count_array['aaData']):'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		 // Response data
		 $this->Mod_schedule->response($result_data);
	}
	/** Get Work Day Exception
	* 
	* @method: get_work_day_exception
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	* @createdby: pranab
	*/	
	public function get_work_day_exception()
	{
		if( ! empty($this->input->post()))
		{
			// Sanitize input
		 	 
			 $result = $this->sanitize_input();
			//echo "Work Days";
			//print_r($result);exit;
			if(TRUE === $result['status'])
			 {
		     // Search input
			 $search_session_array = array();					
			 //SP parameter
				$workdays_param_array = array();
				$workdays_param_array['builderid'] = $this->builder_id ;
				 if($this->project_id > 0)
		         {
			      $workdays_param_array['projectid'] = $this->project_id ;
		         }
                 else
				 {
				  $workdays_param_array['projectid'] = 0 ;
				 }			 
				 if(isset($result['data']['exception_type']) && $result['data']['exception_type'] !='' && $result['data']['exception_type'] != 'null')
				 {
						  $workdays_param_array['type'] = $result['data']['exception_type'] ;
						  $search_session_array['exception_type'] = $result['data']['exception_type'];	
				 }
				 else{
					
					$workdays_param_array['type'] = 0 ;
				 }
			 if(isset($result['data']['workdays_category']) && $result['data']['workdays_category']!='' && $result['data']['workdays_category'] != 'null')
			 {
			 $workdays_param_array['category'] = $result['data']['workdays_category'] ;
			 $search_session_array['category'] = $result['data']['workdays_category'];	
			
			 }
			 else{
			    $workdays_param_array['category'] = '' ;
			 }
			 if($result['data']['iDisplayStart'] == 0)
			 {
			 $workdays_param_array['pageno'] = 1 ;
			 }
			 else if($result['data']['iDisplayStart'] == $result['data']['iDisplayLength'])
			 {
			  $workdays_param_array['pageno'] = 2 ;
			 }
			 else
			 {
			  $workdays_param_array['pageno'] = $result['data']['iDisplayStart']/$result['data']['iDisplayLength']+1 ;
			 }
			 if(isset($result['data']['iDisplayLength']))
			 {
			  $workdays_param_array['rec_count'] = $result['data']['iDisplayLength'] ;
			 }
			 $workdays_param_array['dateformat'] = $this->user_session['date_format'];
				$workdays_param_array['timezone'] = $this->user_session['time_zone'];
			    $this->uni_set_session('search', $search_session_array);
				$result_data = $this->Mod_schedule->get_workdays($workdays_param_array); 
				
				// The following parameters required for data table
				if($result_data['status'] == FALSE)
				{
			
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
			
			      // Get number of records
					$total_count_array = $result_data['total_count'][0]['total_rec'] ;
					$result_data['iTotalRecords'] = isset($total_count_array)?$total_count_array:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array)?$total_count_array:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:''; 
				}
		
			 	$this->Mod_schedule->response($result_data);	
			}
			else
			{
				$this->Mod_schedule->response($result);
			}
		}	
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_schedule->response($result);
		}	
		
	}	
	/** 
	* Save Work Day Exception
	* 
	* @method: save_work_day_exception
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	* @created by : chandru 
	* @created on : 12-05-2015 
	*/	
	public function save_work_day_exception($ub_workday_exception_id = 0)
	{
		$data = array(
		'title'        			=> "Save Work Day Exception",		
		'content'      			=> 'content/schedules/workday_exception',
        'page_id'      			=> 'schedules',				
		'date_all' 	   			=>'date_all'
		);
		// Schedule Workday Exception category list drop down values
		$get_work_day_exception_list = array('classification'=>'workday_exception_category', 'where_clause' => '(int01 = 0 OR int01 = '.$this->user_session['builder_id'].')','type' => 'dropdown');
		$get_work_day_exception_list_result = $this->Mod_general_value->get_general_value($get_work_day_exception_list);
		// echo '<pre>';print_r($get_work_day_exception_list_result);exit;
		$data['get_work_day_exception_list_result'] = $get_work_day_exception_list_result['values'];
		//Update related code
		if(isset($_POST) && !empty($_POST))
		{
			$results = $this->sanitize_input();
		}
		if ($ub_workday_exception_id > 0 || isset($results['data']['ub_workday_exception_id']) && $results['data']['ub_workday_exception_id'] > 0) {
            
            if (!empty($this->input->post())) {
                //Sanitize input
                $response = $this->Mod_schedule->add_work_day_exception($results['data']);
				$response['message'] = 'Updated successfully';
				$this->Mod_schedule->response($response);
            }
            //Fetch code after insert
            else {
                $response  = $this->Mod_schedule->get_work_day_exception($ub_workday_exception_id);
				if(TRUE == $response['status'])
				{
					$data['result_data'] = $response['aaData'][0];
				}else{
					$data['result_data'] = '';
				}
				//echo '<pre>';print_r($data['result_data']);exit;
            }
            
        } else {
            //Insert code
            if (!empty($this->input->post())) {
                //Add check list code
                $results                   = $this->sanitize_input();
                
                $response = $this->Mod_schedule->add_work_day_exception($results['data']);
					$this->Mod_schedule->response($response);
				
            }
        }
		$this->template->view($data);
	}
	/** 
	* Insert General value
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	*/
	public function update_general_value_table()
	{
		if( ! empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			$args = array('classification'=>'schedule_tags', 'type' => 'add' ,'value' => $result['data']['tag']['tag']);
		    $result = $this->Mod_general_value->update_general_value($args);
		    $this->Mod_general_value->response($result);
		}
	}
	/** 
	* Insert General value
	* @method: get_assigned_to_dropdown 
	* @access: public 
	* @param: ajax post array
	* @return: String (HTML) response
	*/
	public function get_assigned_to_dropdown()
	{
		$check_request = trim($this->input->post('request_for'));
		$project_id = trim($this->input->post('project_id'));
		$assigned_users = trim($this->input->post('assigned_users'));
		$assigned_users_array = explode(',',$assigned_users);
		if($check_request == 'assigned_to_dropdown' && $project_id >0){
			$all_type_users = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$project_id, 'account_type' => 'all', 'dropdown_type' => 'optgroup'));
			$response = $this->load->view("content/schedules/assigned_to.php", array('all_type_users'=>$all_type_users,'assigned_to_users'=>$assigned_users_array), true);
			echo $response; exit;
		}
	}
	/** 
	* Apply Saved Search
	* 
	* @method: apply_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: pranab 
	* @created on: 07/05/2015 
	* url encoded : c2NoZWR1bgxf1VzL2Fwcgxf1x5X3NhdmVkX3NlYXJjaC8-
	*/
	public function apply_saved_search()
	{
	/* Apply Filter code starts here */
		   $post_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if(!empty($this->input->post()))
		{
			if($result_data['status'] == true)
			{
				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
				$schedule_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($schedule_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}else{
				$schedule_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($schedule_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
				}
		}else{
		 $serialized_data = $result_data['aaData'][0]['search_params'];
		 $remove_single_quote = str_replace("'", '', $serialized_data);
		 $unserialized_data = unserialize($remove_single_quote);
		$result_data['aaData'][0]['search_params'] = $unserialized_data;
		 if(!empty($unserialized_data))
		 {
			
			
			if(!empty($unserialized_data['assigned_users']))
			{
				$search_session_array['assigned_users'] =$unserialized_data['assigned_users'];
				
			}
			
			if(!empty($unserialized_data['Status']))
			{
				$search_session_array['Status'] =$unserialized_data['Status'];
				
			}
			if(!empty($unserialized_data['tags']))
			{
				$search_session_array['tags'] =$unserialized_data['tags'];
				
			}
			if(!empty($unserialized_data['phase']))
			{
				$search_session_array['phase'] =$unserialized_data['phase'];
				
			}
			if(!empty($unserialized_data['daterange']))
			{
				$search_session_array['daterange'] =$unserialized_data['daterange'];
				
			}
			if(!empty($unserialized_data['event']))
			{
				$search_session_array['event'] =$unserialized_data['event'];
				
			}
			if(!empty($unserialized_data['exception_type']))
			{
				$search_session_array['exception_type'] =$unserialized_data['exception_type'];
				
			}
			if(!empty($unserialized_data['workdays_category']))
			{
				$search_session_array['category'] =$unserialized_data['workdays_category'];
				
			}
			$this->uni_set_session('search', $search_session_array);
			$this->Mod_schedule->response($result_data);
			}
		}
	/* Apply Filter code Ends here */
	}
  	/** 
	* Save and apply search filter
	* 
	* @method: save_or_apply_schedule_search_filter  
	* @access: public 
	* @params: null
	* @return: AJAX response
	* @created by: pranab
	* @created on: 07/05/2015 
	* url encoded : 
	*/
	public function save_or_apply_schedule_search_filter()
	{
		// Check in database for existing entry for this user and module 
		$saved_search_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module);
		$saved_search_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array('ub_saved_search_id','search_params'),
												 'where_clause' => $saved_search_array
												 ));
		if(!empty($this->input->post()))
		{
			// Looking for save search action update or insert in this case 
			// Sanitize input
			$sanitize_result = $this->sanitize_input();
			if(TRUE === $sanitize_result['status'])
			{
				$posted_search_fields = $sanitize_result['data'];
				$update_search_array = array('search_params' => "'".serialize($posted_search_fields)."'");
				if(TRUE === $saved_search_data['status'])
				{
					$saved_search_row_array = $saved_search_data['aaData'];
					if(count($saved_search_row_array)==1)
					{
						$saved_search_id = $saved_search_row_array[0]['ub_saved_search_id'];
						$update_search_array['ub_saved_search_id'] = $saved_search_id;
						// Update the existing saved search entry
						$update_response = $this->Mod_saved_search->update_saved_search($update_search_array);
						$this->Mod_schedule->response($update_response);
					}
					else
					{
						$this->Mod_schedule->response(array('status'=>FALSE,'message'=>'More than one records are identified cannot update the current request!'));
					
					}
				}
				else
				{
					// Insert new saved search
					$insert_response = $this->Mod_saved_search->update_saved_search($update_search_array);
					$this->Mod_schedule->response($insert_response);
				}
			}	
			else
			{
				$this->Mod_schedule->response($sanitize_result);
			}
		}
		else
		{
			// Looking for saved search apply case - assign data to session
			$saved_search_row_array = $saved_search_data['aaData'];
			if(count($saved_search_row_array)==1)
			{
				$serialized_data = $saved_search_row_array[0]['search_params'];
				$remove_single_quote = str_replace("'", '', $serialized_data);
				$unserialized_data = unserialize($remove_single_quote);
				$saved_search_data['aaData'][0]['search_params'] = $unserialized_data;
				$search_session = $this->uni_session_get('SEARCH');
				if(!empty($unserialized_data))
				{
					if(!empty($unserialized_data['assigned_users']))
					{
						$search_session_array['assigned_users'] = $unserialized_data['assigned_users'];
					}
					if(!empty($unserialized_data['status']))
					{
						$search_session_array['status'] = $unserialized_data['status'];
					}
					if(!empty($unserialized_data['tags']))
					{
						$search_session_array['tags'] = $unserialized_data['tags'];
					}
					if(!empty($unserialized_data['phase']))
					{
						$search_session_array['phase'] = $unserialized_data['phase'];
					}
					if(!empty($unserialized_data['daterange']))
					{
						$search_session_array['daterange'] = $unserialized_data['daterange'];
					}
					if(!empty($unserialized_data['event']))
					{
						$search_session_array['event'] = $unserialized_data['event'];
					}
					if(!empty($unserialized_data['exception_type']))
			       {
				   $search_session_array['exception_type'] =$unserialized_data['exception_type'];
				
			       }
			       if(!empty($unserialized_data['workdays_category']))
			        {
				  $search_session_array['category'] =$unserialized_data['workdays_category'];
				
			         }
				}	
				// Setting session 
				$this->uni_set_session('search', $search_session_array);
				$this->Mod_schedule->response($saved_search_data);
			}
		}
	/* Apply Filter code Ends here */
	}
	/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: pranab
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
			
				$result = $this->Mod_schedule->destroy_session($result['data']);
			
			}
			
			$this->Mod_schedule->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/* Below code was added by chadnru on 08-05-2015 */
	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 08-05-2015
	*/
	public function update_general_value()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$args = array('classification'=>$result['data']['classification'], 'type' => $result['data']['type'] ,'value' => $result['data']['value']);
				//echo '<pre>';print_r($args);exit;
				$result = $this->Mod_general_value->update_general_value($args);
			}
			$this->Mod_schedule->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/** 
	* find_date_interval
	* 
	* @method: find_date_interval 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: chandru
	* @createdon: 09-05-2015
	*/
	public function find_date_interval()
	{
		if( ! empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				if(isset($result['data']['type']) && $result['data']['type'] == "get_end_date" )
				{
					$get_date_interval_array = array(
									'builder_id' => $this->builder_id,
									'project_id' => isset($result['data']['project_id'])?$result['data']['project_id']:$this->project_id,
									'start_date' => $result['data']['startdate'],
									'no_of_days' => $result['data']['totaldays']
										);
					$results = $this->Mod_schedule->get_end_date($get_date_interval_array);
					$results['action_type'] = $result['data']['type'];
					$this->Mod_schedule->response($results);
				}
				else if(isset($result['data']['type']) && $result['data']['type'] == "get_duration")
				{
					$get_date_interval_array = array(
						'builderid' => $this->builder_id,
						'projectid' => isset($result['data']['project_id'])?$result['data']['project_id']:$this->project_id,
						'startdate' => $result['data']['startdate'],
						'enddate' => $result['data']['enddate']
					);
					$results = $this->Mod_schedule->get_durations($get_date_interval_array);
					$results['action_type'] = $result['data']['type']; 
					$this->Mod_schedule->response($results);
				}
			}
			else
			{
				$this->Mod_schedule->response($result);
			}	
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Operation Failed: Post array is empty';
			$this->Mod_schedule->response($response);
		}
	}
	/** 
	* Get link to current schedule list
	* 
	* @method: get_link_follows_schedule 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: Thiyagaraj R
	* @createdon: 21-05-2015
	*/
	public function get_link_follows_schedule()
	{
		if( ! empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				if(isset($result['data']['schedule_id']) && $result['data']['schedule_id'] >0)
				{
					// Get schedule link follows
					$get_schedule_link_follows = array('schedule_id' => $result['data']['schedule_id']);
					$get_schedule_link_result = $this->Mod_schedule->get_schedule_link_follows($get_schedule_link_follows);
					//print_r($assigned_predecessors_result);exit;
					if(TRUE === $get_schedule_link_result['status'])
					{
						//$data['aaData'] = $get_schedule_link_result['aaData'];
						$schedule_link_to_result = $get_schedule_link_result['aaData'];
						$schedule_link_to_results = array();
						foreach($schedule_link_to_result as $schedule_link_to_row)
						{
							$schedule_link_to_row['start_date'] = date('m/d/Y',strtotime($schedule_link_to_row['start_date']));
							$schedule_link_to_row['end_date'] = date('m/d/Y',strtotime($schedule_link_to_row['end_date']));
							$schedule_link_to_results[] = $schedule_link_to_row;
						}
						
						$data['aaData'] = $schedule_link_to_results;
						$data['status'] = $get_schedule_link_result['status'];
						$data['message'] = $get_schedule_link_result['message'];
					}
					else
					{
						$data['aaData'] = array();
						$data['status'] = $get_schedule_link_result['status'];
						$data['message'] = $get_schedule_link_result['message'];	
					}
				}
			}
			else
			{
				$this->Mod_schedule->response($result);
			}	
		}
		else
		{
			$data['aaData'] = array();
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';			
		}
		$this->Mod_schedule->response($data);
	}	
	/** 
	* Get schedule shift history
	* 
	* @method: get_schedule_shift_history 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* @createdby: Thiyagaraj R
	* @createdon: 21-05-2015
	*/
	public function get_schedule_shift_history()
	{
		if( ! empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				if(isset($result['data']['schedule_id']) && $result['data']['schedule_id'] >0)
				{
					// get Schedule shift history 
					$get_schedule_shift_history = array('schedule_id' => $result['data']['schedule_id'],'shift_type'=>$result['data']['shift_type']);
					$schedule_shift_history_result = $this->Mod_schedule->get_schedule_shift_history($get_schedule_shift_history);
					//print_r($assigned_predecessors_result);exit;
					if(TRUE === $schedule_shift_history_result['status'])
					{
						$schedule_shift_history = $schedule_shift_history_result['aaData'];
						$schedule_shift_history_results = array();
						foreach($schedule_shift_history as $shift_history_row)
						{
							$shift_history_row['start_date'] = (isset($shift_history_row['start_date']) && $shift_history_row['start_date']!='')?date('m/d/Y',strtotime($shift_history_row['start_date'])):'';
							$shift_history_row['end_date'] = (isset($shift_history_row['end_date']) && $shift_history_row['end_date']!='')?date('m/d/Y',strtotime($shift_history_row['end_date'])):'';
							$schedule_shift_history_results[] = $shift_history_row;
						}
						$data['aaData'] = $schedule_shift_history_results;
						$data['status'] = $schedule_shift_history_result['status'];
						$data['message'] = $schedule_shift_history_result['message'];
					}
					else
					{
						$data['aaData'] = array();
						$data['status'] = $schedule_shift_history_result['status'];
						$data['message'] = $schedule_shift_history_result['message'];	
					}
				}
			}
			else
			{
				$this->Mod_schedule->response($result);
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Operation Failed: Post array is empty';			
		}
		$this->Mod_schedule->response($data);
	}	
	//import schedules from template
	public function import_schedules()
	{
		$result = $this->sanitize_input();
		//echo '<pre>';print_r($result['data']['template_id']);exit;
	
		$template_workday_exception_info = $this->Mod_template->get_template_workday_exception(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		//to get an unique id for import					
		$import_id = $this->Mod_template->generate_template_import_number('IMP',6,$result['data']['template_id']);	
		
		// echo '<pre>';print_r($import_id);exit;	
							//echo '<pre>';print_r($template_workday_exception_info);exit;
		if($template_workday_exception_info['status'] == TRUE)
		{
		 $workday_exception_data = $template_workday_exception_info['aaData'];
		 foreach ($workday_exception_data as $key => $value) {
		 	$workday_exception_data[$key]['type'] = $value['exception_type'];
		 	$workday_exception_data[$key]['project_id'] = $this->project_id;
		 	$workday_exception_data[$key]['created_on'] = TODAY;
		 	$workday_exception_data[$key]['modified_on'] = TODAY;
		 	$workday_exception_data[$key]['created_by'] = $this->user_session['ub_user_id'];
		 	$workday_exception_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
		    unset($workday_exception_data[$key]['ub_template_workday_exception_id']);
		    unset($workday_exception_data[$key]['template_id']);
		    unset($workday_exception_data[$key]['exception_type']);
		 }
		 $this->Mod_template->insert_workday_exception($workday_exception_data);
	    }
	    //Insert in UB_SCHEDULE_PREDECESSOR_INFO table
	    //echo "<pre>"; print_r($result);exit;
		$insert_array = array('template_id' => $result['data']['template_id'],'project_id' => $this->project_id,'import_id' => $import_id);
		//Insert in UB_SCHEDULE table
		$template_schedule_info = $this->Mod_template->get_template_schedule(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		// echo '<pre>';print_r($template_schedule_info);exit;					
		if($template_schedule_info['status'] == TRUE)
		{
			$schedule_data = $template_schedule_info['aaData'];
			foreach ($schedule_data as $key => $value) 
			{
				$schedule_data[$key]['project_id'] = $this->project_id;
				$schedule_data[$key]['template_schedule_id'] = $schedule_data[$key]['ub_template_schedule_id'];
				$schedule_data[$key]['import_id'] = $import_id;
				$schedule_data[$key]['created_on'] = TODAY;
				$schedule_data[$key]['modified_on'] = TODAY;
				$schedule_data[$key]['created_by'] = $this->user_session['ub_user_id'];
				$schedule_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
				$old_schedule_id = $schedule_data[$key]['ub_template_schedule_id'];
				unset($schedule_data[$key]['ub_template_schedule_id']);
				unset($schedule_data[$key]['template_id']);
				unset($schedule_data[$key]['schedule_id']);
				// echo '<pre>';print_r($schedule_data[$key]);exit;
				$schedule_insert_response = $this->Mod_template->insert_schedule($schedule_data[$key]);
				//unset($schedule_data[$key]['project_schedule_startdates_diff_in_days']);
				// echo '<pre>';print_r($schedule_insert_response);exit;
				$template_schedule_predecessor_info = $this->Mod_template->get_template_schedule_predecessor_info(array(
								'select_fields' => array('*'),
								'where_clause' => array('template_id' => $result['data']['template_id'], 'template_schedule_id' => $old_schedule_id)
								));
				// echo '<pre>';print_r($template_schedule_predecessor_info);				
				if($template_schedule_predecessor_info['status'] == TRUE)
				{
					$schedule_predecessor_data = $template_schedule_predecessor_info['aaData'];
					foreach ($schedule_predecessor_data as $key => $value) 
					{
						$schedule_predecessor_data[$key]['schedule_id'] = $schedule_insert_response['insert_id']; 
						$schedule_predecessor_data[$key]['project_id'] = $this->project_id;
						$schedule_predecessor_data[$key]['import_id'] = $import_id;
						$schedule_predecessor_data[$key]['created_on'] = TODAY;
						$schedule_predecessor_data[$key]['modified_on'] = TODAY;
						$schedule_predecessor_data[$key]['created_by'] = $this->user_session['ub_user_id'];
						$schedule_predecessor_data[$key]['modified_by'] = $this->user_session['ub_user_id'];
						unset($schedule_predecessor_data[$key]['ub_template_schedule_predecessor_info_id']);
						unset($schedule_predecessor_data[$key]['template_id']);
						unset($schedule_predecessor_data[$key]['template_schedule_id']);
					}
					$this->Mod_template->insert_schedule_predecessor_info($schedule_predecessor_data);
				}
			}
		}
		// $this->Mod_template->update_schedule_start_date($insert_array);
		$this->Mod_template->update_schedule_predecessor_parent_id($insert_array);
		$this->Mod_schedule->response($template_schedule_info);
	}
	/** 
	* Publish Schedules
	* 
	* @method: publish_schedules 
	* @access: public 
	* @param:  ajax post array
	* @return: ajax response array as json 
	*/	
	public function publish_schedules()
	{
		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$publish_success = 'Schedule(s) updated successfully : ';
				$publish_failure = 'Following schedule failed to update : ';
				$response_array = array();
				$success_response_flag = FALSE;
				$failure_response_flag = FALSE;
				$message = '';
				$schedule_ids = '';
				$schedule_list_to_publish_array = array();
				$schedule_ids = $result['data']['scheduleids'];
				$where_str = "SCHEDULE.ub_schedule_id IN (".$schedule_ids.") AND SCHEDULE.publish_status='No'";
				$schedule_list_to_publish = $this->Mod_schedule->get_schedules(array('where_clause' => $where_str));
				if(TRUE === $schedule_list_to_publish['status'])
				{
					$schedule_list_to_publish_array = $schedule_list_to_publish['aaData'];
					foreach($schedule_list_to_publish_array as $index => $schedule)
					{
						$input_array = array();
						$input_array['schedule_id'] = $schedule['ub_schedule_id'];
						$input_array['builder_id'] = $schedule['builder_id'];
						$input_array['project_id'] = $schedule['project_id'];
						$input_array['title'] = $schedule['title'];
						$input_array['start_date'] = $schedule['start_date'];
						$input_array['hide_db_start_date'] = $schedule['start_date'];
						$input_array['end_date'] = $schedule['end_date'];
						$input_array['hide_db_end_date'] = $schedule['end_date'];
						$input_array['no_of_days'] = $schedule['no_of_days'];
						$input_array['hide_db_duration'] = $schedule['no_of_days'];
						$input_array['publish_status'] = 'Yes';
						$schedule_update = $this->Mod_schedule->update_schedule($input_array);
						if(isset($schedule_update['status']) && TRUE === $schedule_update['status'])
						{
							$success_response_flag = TRUE;
							if(count($schedule_list_to_publish_array) == $index+1)
							{
								$publish_success = $publish_success . $schedule['title'];
							}
							else
							{
								$publish_success = $publish_success . $schedule['title'] . ',';
							}						
						}
						else
						{
							$failure_response_flag = TRUE;
							if(count($schedule_list_to_publish_array) == $index+1)
							{
								$publish_failure = $publish_failure . $schedule['title'];
							}
							else
							{
								$publish_failure = $publish_failure . $schedule['title'] . ',';
							}	
						}					
					}
					if(TRUE === $success_response_flag && TRUE === $failure_response_flag)
					{
						$message = $publish_success . $publish_failure;
					}
					else if(TRUE === $success_response_flag && FALSE === $failure_response_flag)
					{
						$message = $publish_success;
					}
					else if(FALSE === $success_response_flag && TRUE === $failure_response_flag)
					{
						$message = $publish_failure;
					}
					else 
					{
						$message = "Problem in bulk publish!";
					}					
				}
				else
				{
					$message = "Schedule list already published!";
				}
				
				
				$response_array['status'] = $success_response_flag;
				$response_array['message'] = $message;
				$this->Mod_schedule->response($response_array);				
			}
			else
			{
				$this->Mod_schedule->response($result);
			}
		}
		else
		{
		    $result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_schedule->response($result);		
		}
	}
	/** 
	* Delete Schedules
	* 
	* @method: delete_schedule 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	public function delete_schedule()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// echo '<pre>';print_r($result);exit;
				$response = $this->Mod_schedule->delete_schedule($result['data']);
			}
			else
			{
				$this->Mod_schedule->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_schedule->response($response);
	}
	/** 
     * Delete workday
     * 
     * @method: delete_workday 
     * @access: public 
     * @param:  ajax post array
     * @return: array 
     * @createdby: chandru
     */
    public function delete_workday()
    {
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// echo '<pre>';print_r($result);exit;
				$response = $this->Mod_schedule->delete_workday($result['data']);
			}
			else
			{
				$this->Mod_schedule->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_schedule->response($response);
    }
}