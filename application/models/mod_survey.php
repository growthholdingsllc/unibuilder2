<?php
/** 
 * Survey Model
 * 
 * @package: Survey Model
 * @subpackage: Survey Model 
 * @category: Survey
 * @author: Gayathri Kalyani.K
 * @createdon(DD-MM-YYYY): 08-09-2015
*/
class Mod_survey extends UNI_Model
{
	
	/**
	 * @constructor
	 */
	public function __construct() 
	{
		parent::__construct();
    }
	
	public function get_template($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SURVEY_TEMPLATE.' AS UB_SURVEY_TEMPLATE');	//UB_ROLE is the table name defined in constant file
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
			$this->read_db->join(UB_USER.' AS USER','USER.ub_user_id = UB_SURVEY_TEMPLATE.created_by','left');
		}
		if(isset($args['join']['survey_template_questions']) && 'yes' === strtolower($args['join']['survey_template_questions']))
		{
			$this->read_db->join(UB_SURVEY_TEMPLATE_QUESTIONS.' AS UB_SURVEY_TEMPLATE_QUESTIONS','UB_SURVEY_TEMPLATE_QUESTIONS.ub_survey_template_question_id = UB_SURVEY_TEMPLATE.ub_survey_template_id','left');
		}
		// Join Tables
	
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
		if(!$res)
		{
			echo $this->read_db->_error_message();
			echo "<br>".$this->read_db->_error_number();exit;
		}
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
	
	public function get_template_question($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SURVEY_TEMPLATE_QUESTIONS.' AS UB_SURVEY_TEMPLATE_QUESTIONS');	//UB_ROLE is the table name 
		// Join Tables
	
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
	
	/**
	 *
	 * Add survey
	 *
	 * @method:	add_survey
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_template($post_array = array())
	{
		// echo'<pre>';print_r($post_array);
		if (!empty($post_array)) {
			
				if ($this->write_db->insert(UB_SURVEY_TEMPLATE, $post_array)) 
				{
					// echo $this->write_db->last_query();
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Template inserted successfully';
				} 
				else 
				{
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the survey(s)';
				}
			
		} 
		else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
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
	public function delete_template($delete_array)
	{
	
		if(isset($delete_array['ub_survey_template_id']))
		{
			foreach($delete_array['ub_survey_template_id'] as $key=>$ub_survey_template_id)
			{
				$this->write_db->delete(UB_SURVEY_TEMPLATE, array('ub_survey_template_id' => $ub_survey_template_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Template deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Template id is not set';
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
	public function delete_template_question($delete_array)
	{
		// echo'<pre>';print_r($delete_array);
		if(isset($delete_array['ub_survey_template_question_id']))
		{
			foreach($delete_array['ub_survey_template_question_id'] as $key=>$ub_survey_template_question_id)
			{
				$this->write_db->delete(UB_SURVEY_TEMPLATE_QUESTIONS, array('ub_survey_template_question_id' => $ub_survey_template_question_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Question deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Template Question id is not set';
		}
		return $data;

	}
		/**
	 *
	 * Add survey
	 *
	 * @method:	add_survey
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_template_question($post_array = array())
	{
		// echo'<pre>';print_r($post_array);exit;
		if (!empty($post_array)) {
			
				if ($this->write_db->insert(UB_SURVEY_TEMPLATE_QUESTIONS, $post_array)) 
				{
					//echo $this->write_db->last_query();exit;
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Question added successfully';
				} 
				else 
				{
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the survey(s)';
				}
			
		} 
		else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
	}
	
	public function update_template($post_array = array())
	{
		$this->write_db->where('ub_survey_template_id', $post_array['ub_survey_template_id']);
		$this->write_db->update(UB_SURVEY_TEMPLATE, $post_array);
		$data['insert_id'] =  $post_array['ub_survey_template_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Updated Successfully';
		return $data;
	}
	public function update_template_question($post_array = array())
	{
		 // echo'<pre>';print_r($post_array);exit;
		$this->write_db->where('ub_survey_template_question_id', $post_array['ub_survey_template_question_id']);
		$this->write_db->update(UB_SURVEY_TEMPLATE_QUESTIONS, $post_array);
		$data['insert_id'] =  $post_array['ub_survey_template_question_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Question Updated Successfully';
		return $data;
	}
	

	public function get_survey($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SURVEY.' AS UB_SURVEY');	//UB_ROLE is the table name defined in constant file
		// Join Tablesub_survey_template 
		if(isset($args['join']['project']) && 'yes' === strtolower($args['join']['project']))
		{
			$this->read_db->join(UB_PROJECT.' AS PROJECT','PROJECT.ub_project_id = UB_SURVEY.project_id','left');//UB_BUILDER is the table name defined in constant file
		}
		
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = UB_SURVEY.released_by','left');
			$this->read_db->join('ub_user'.' AS USERS','USERS.ub_user_id = UB_SURVEY.assigned_users','left');
		}
		if(isset($args['join']['surveytemplate']) && 'yes' === strtolower($args['join']['surveytemplate']))
		{
			$this->read_db->join(UB_SURVEY_TEMPLATE.' AS SURVEY_TEMPLATE','SURVEY_TEMPLATE.builder_id = UB_SURVEY.builder_id','left');//UB_BUILDER is the table name defined in constant file
		}
		
		if(isset($args['join']['ub_survey_questions']) && 'yes' === strtolower($args['join']['ub_survey_questions']))
		{
			$this->read_db->join(UB_SURVEY_QUESTIONS.' AS UB_SURVEY_QUESTIONS','UB_SURVEY_QUESTIONS.survey_id = UB_SURVEY.ub_survey_id','left');//UB_BUILDER is the table name defined in constant file
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
		/* if(!$res)
		{
			echo $this->read_db->_error_message();
			echo "<br>".$this->read_db->_error_number();exit;
		} */
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
		return $data;
		
	}
	public function add_surveys($post_array = array())
	{
	// echo'<pre>';print_r($post_array);
		if (!empty($post_array)) {
			
				if ($this->write_db->insert(UB_SURVEY, $post_array)) 
				{
					 echo $this->read_db->_error_message();
					 echo $this->write_db->last_query();
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Survey inserted successfully';
				} 
				else 
				{
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the survey(s)';
				}
			
		} 
		else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
		
	}
	public function update_survey($post_array = array())
	{
		
		$old_asign_users = $this->Mod_survey->get_survey(array(
				'select_fields' => array('UB_SURVEY.assigned_users'),
				'where_clause' => (array('ub_survey_id' =>  $post_array['ub_survey_id']))));
				
		$this->write_db->where('ub_survey_id', $post_array['ub_survey_id']);
		$this->write_db->update(UB_SURVEY, $post_array);
		
		$data['insert_id'] =  $post_array['ub_survey_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Updated Successfully';
		
		/* 
		  Sending Mail To All Assignes to give a link to open survey page without login.
		  @author : Sidhartha
		  @modified on: 1/10/2015
		*/
			
		//$survey_link = base_url().$this->crypt->encrypt('login/login_submit/'.$asign_users[$i]);
		$asign_users = explode(",",$post_array['assigned_users']);
		

		if($old_asign_users['status'] == TRUE)
		{
		// echo "hi";exit;
		  $old_asign_users_array = explode(",",$old_asign_users['aaData'][0]['assigned_users']);
		  $asign_users = array_diff($asign_users,$old_asign_users_array);
		  $asign_users = array_values(array_filter($asign_users));
		}
		//print_r($old_asign_users_array);
		//print_r($asign_users);exit;
		//echo count($asign_users);exit;
		if(!empty($asign_users)){
		// for($i=0;$i< count($asign_users);$i++)
		foreach($asign_users as $key => $assign_users_id)
		{
			$send_multiple_mail = $this->send_mail_to_mutilpe_id($assign_users_id, $data['insert_id']);
		}
		//echo 'last';exit;
		}
		//print_r($data);exit;
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
	public function delete_survey($delete_array)
	{
	
		if(isset($delete_array['ub_survey_id']))
		{
			foreach($delete_array['ub_survey_id'] as $key=>$ub_survey_id)
			{
				$this->write_db->delete(UB_SURVEY, array('ub_survey_id' => $ub_survey_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Survey deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Survey id is not set';
		}
		return $data;

	}
	
	public function get_survey_question($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SURVEY_QUESTIONS.' AS UB_SURVEY_QUESTIONS');	//UB_ROLE is the table name 
		// Join Tables
		if(isset($args['join']['survey']) && 'yes' === strtolower($args['join']['survey']))
		{
			$this->read_db->join(UB_SURVEY.' AS UB_SURVEY','UB_SURVEY.ub_survey_id = UB_SURVEY_QUESTIONS.survey_id','left');
		}
		if(isset($args['join']['ub_survey_question_answers']) && 'yes' === strtolower($args['join']['ub_survey_question_answers']))
		{
			$this->read_db->join(UB_SURVEY_QUESTION_ANSWERS.' AS UB_SURVEY_QUESTION_ANSWERS','UB_SURVEY_QUESTIONS.ub_survey_question_id = UB_SURVEY_QUESTION_ANSWERS.survey_question_id','left');
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
	public function delete_survey_questions($delete_array)
	{
		// echo'<pre>';print_r($delete_array);
		if(isset($delete_array['ub_survey_question_id']))
		{
			foreach($delete_array['ub_survey_question_id'] as $key=>$ub_survey_question_id)
			{
				$this->write_db->delete(UB_SURVEY_QUESTIONS, array('ub_survey_question_id' => $ub_survey_question_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Question Deleted Successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Survey Question id is not set';
		}
		return $data;

	}
	public function update_survey_question($post_array = array())
	{
		 // echo'<pre>';print_r($post_array);exit;
		$this->write_db->where('ub_survey_question_id', $post_array['ub_survey_question_id']);
		$this->write_db->update(UB_SURVEY_QUESTIONS, $post_array);
		$data['insert_id'] =  $post_array['ub_survey_question_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Question Updated successfully';
		return $data;
	}
	public function add_survey_question($post_array = array())
	{

		if (!empty($post_array)) {
			 // echo'<pre>';print_r($post_array);
			
				if ($this->write_db->insert(UB_SURVEY_QUESTIONS, $post_array)) 
				{
					// echo $this->write_db->last_query();
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Question added successfully';
				} 
				else 
				{
					//echo $this->write_db->last_query();
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the survey(s)';
				}
			
		} 
		else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
		
	}
	
	public function add_survey($post_array = array())
	{
		if (!empty($post_array)) {
			
				if ($this->write_db->insert(UB_SURVEY, $post_array)) 
				{
					 
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Survey inserted successfully';
				} 
				else 
				{
				
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the survey(s)';
				}
			
		} 
		else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
		
	}
	
	

	public function get_survey_request()
	{
		
	}
	public function save_survey_request()
	{
		
	}
	public function save_survey_question_answers($post_array = array())
	{
	  // echo'<pre>';print_r($post_array);
		if (!empty($post_array)) {
			
				if ($this->write_db->insert(UB_SURVEY_QUESTION_ANSWERS, $post_array)) 
				{
				
					
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Saved successfully';
				} 
				else 
				{
				// echo $this->write_db->last_query();exit;
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the survey(s) answers';
				}
			
		} 
		else 
		{
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
		
	}
	
	public function get_survey_question_answer($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SURVEY_QUESTION_ANSWERS.' AS UB_SURVEY_QUESTION_ANSWERS');	//UB_ROLE is the table name 
		
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
			$this->read_db->join(UB_USER.' AS USER','USER.ub_user_id = UB_SURVEY_QUESTION_ANSWERS.created_by','left');
		}
		if(isset($args['join']['survey_questions']) && 'yes' === strtolower($args['join']['survey_questions']))
		{
			$this->read_db->join(UB_SURVEY_QUESTIONS.' AS UB_SURVEY_QUESTIONS','UB_SURVEY_QUESTIONS.ub_survey_question_id = UB_SURVEY_QUESTION_ANSWERS.survey_question_id','left');
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
		/* if(!$res)
		{
			echo $this->read_db->_error_message();
			echo "<br>".$this->read_db->_error_number();exit;
		} */
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
	
		return $data;
		
	}
	/**
	*
	* close survey
	*
	* @method: close_survey
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: SATHEESH
	* @createdon(DD-MM-YYYY): 25-09-2015
	*/
	public function close_survey($post_array = array())
	{
		$survey_status['status'] = 'Closed';
		$this->write_db->where('ub_survey_id', $post_array['survey_id']);
		$this->write_db->update(UB_SURVEY, $survey_status);
		$data['insert_id'] =  $post_array['survey_id'];
		$data['status'] = TRUE;
		$data['message'] = 'Survey Closed Successfully';
		return $data;
	}
	
	/* Below code was added by chandru */
	public function send_mail_to_mutilpe_id($asign_users_id = 0, $insert_id = 0)
	{
		if($insert_id > 0 && $asign_users_id > 0)
		{
			$get_all_users = array(
							'select_fields' => array('CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
							'where_clause' => array('ub_user_id' => $asign_users_id)
							);
         $all_users = $this->Mod_user->get_users($get_all_users);
		 $survey_link = base_url().$this->crypt->encrypt('login/auto_login/'.$insert_id.'/'.$asign_users_id.'/'.$this->project_id);
         if($all_users['status'] == TRUE)
		 {
			 $user_list = $all_users['aaData'];
			 if(isset($user_list) && !empty($user_list))
			 {
				$email_ids = $user_list[0]['primary_email'];
				$email_id = $user_list[0]['primary_email'];
				$name = $user_list[0]['fullname'];
				$level2_array = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
			 }
		 }else{
			return FALSE;
		 }
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
			//echo $asign_users[$i];exit;
			$template_type = 'survey_released';
			$content_array = array(
				'TO_EMAIL' => $email_id,
				'builder_name' => $first_name.' '.$last_name,
				'FIRST_NAME' => $name,
				'RESET_LINK' => $survey_link,
				'SEND_MAIL_INFO' => $level2_array,
				'IMAGESRC' => IMAGESRC,
				'base_url'=> BASEURL
				);
			$post_array_details = array(
						'builder_id' => $this->user_session['builder_id'],
						'project_id' => $this->project_id,
						'module_name' => $this->module,
						'module_pk_id' => $insert_id,
						'from_user_id' => $this->user_session['ub_user_id'],
						'to_user_id' => $asign_users_id,
						'type' => $template_type,
						'subject' => 'content will update',
						'message' => 'content will update'
							);
				$notifications_array = array(
						'template_name' => $template_type,
						'content_array' => $content_array,
						'notification' => $post_array_details,
						'default' => 'No'
						);
					//echo 'notifications_array';echo '<pre>';print_r($notifications_array);
			$notification_responce = $this->Mod_notification->send_mail($notifications_array);
		//echo 'notification_responce';echo '<pre>';print_r($notification_responce);
		}
	}
}
/* End of file mod_survey.php */
/* Location: ./application/models/mod_survey.php */