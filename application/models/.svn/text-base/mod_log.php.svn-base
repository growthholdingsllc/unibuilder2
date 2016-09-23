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
class Mod_log extends UNI_Model
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

	public $ub_daily_log_id;
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['user_id'])?$this->user_session['user_id']:0;
		$this->ub_daily_log_id = 0;
		parent::__construct();
    }
	/** 
	* Get logs information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_logs
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_logs($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_DAILY_LOG.' AS LOG');
		// Join Tables
		  if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		  {
			$this->read_db->join(UB_BUILDER.' AS BUILDER','LOG.builder_id = BUILDER.ub_builder_id','left');//UB_BUILDER is the table name defined in constant file
		  }
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','LOG.created_by = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
		 }
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['project']))
		 {
		 	$this->read_db->join(UB_PROJECT.' AS PROJECT','LOG.project_id = PROJECT.ub_project_id','left');//UB_PROJECT is the table name defined in constant file
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
	* Delete logs
	*
	* @method: delete_log
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_log($delete_array)
	{
		if(isset($delete_array['ub_daily_log_id']))
		{
			foreach($delete_array['ub_daily_log_id'] as $key=>$ub_daily_log_id)
			{
				/*$this->write_db->delete(UB_DAILY_LOG, array('ub_daily_log_id' => $ub_daily_log_id));*/

				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_daily_log_id', $ub_daily_log_id);
				$this->write_db->update(UB_DAILY_LOG, $post_array);
				/* Find folder id */
				$ui_folder_name = 'logs'.$ub_daily_log_id;
				/* Based on checklist id find project id */
				$project_id_array = $this->get_logs(array(
					'select_fields' => array('LOG.project_id'),
					'where_clause' => array('LOG.ub_daily_log_id'=>$ub_daily_log_id)
				));
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_log->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_daily_log_id);
			}
			$data['status'] = TRUE;
			$data['message'] = 'Log(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Log id is not set';
		}
		return $data;
	}

	/**
	*
	* Add log
	*
	* @method: add_log
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_log($post_array = array())
	{
		if( ! empty($post_array))
		{

			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			if($this->builder_id > 0)
			{
					if($this->write_db->insert(UB_DAILY_LOG, $post_array))
					{
						//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
						/* Notification code was added by chandru 01-06-2015 */
						$log_table_insertid = $this->write_db->insert_id();
						$send_notification = $this->send_mail_for_notification($post_array,$log_table_insertid,'');
						$data['insert_id'] = $log_table_insertid;
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
	* Update log
	*
	* @method: update_log
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_log($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->ub_daily_log_id = isset($post_array['ub_daily_log_id'])?$post_array['ub_daily_log_id']:$this->ub_daily_log_id;
			if($this->ub_daily_log_id > 0)
			{
				 
				$this->write_db->where('ub_daily_log_id', $this->ub_daily_log_id);
				if($this->write_db->update(UB_DAILY_LOG, $post_array))
				{
					$data['insert_id'] =  $this->ub_daily_log_id;
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
	* Add task
	*
	* @method: add_comment
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdon(DD-MM-YYYY): 30-03-2015
	* @createdby: sidhartha
	*/
	public function add_comment($post_array = array())
	{
		if( ! empty($post_array))
		{	 
			 $this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
					if($this->write_db->insert(UB_DAILY_LOG_COMMENTS, $post_array))
					{
						/* Notification code was added by chandru 01-06-2015 */
						$comment_table_insertid = $this->write_db->insert_id();
						$data['insert_id'] = $comment_table_insertid;
						$data['comment'] =  $post_array['comments'];
						$data['show_owner'] =  $post_array['show_owner'];
						$data['show_sub'] =  $post_array['show_sub'];
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
	*
	* Delete comment
	*
	* @method: delete_comment
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: sidhartha
	*/
	public function delete_comment($delete_array)
	{
		if(isset($delete_array['ub_log_comment_id']))
		{
			foreach($delete_array['ub_log_comment_id'] as $key=>$ub_log_comment_id)
			{
				$this->write_db->delete(UB_DAILY_LOG_COMMENTS, array('ub_log_comment_id' => $ub_log_comment_id));
			}
			//echo "Deleted Sucessfully";
			$data['status'] = TRUE;
			$data['message'] = 'Comment deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Log id is not set';
		}
		return $data;

	}
	/** 
	* Get comment information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_comment
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_comment($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_DAILY_LOG_COMMENTS.' AS LOG_COMMENT');
		//Join Tables
		 if(isset($args['join']) && 'yes' === strtolower($args['join']['user']))
		 {
		 	$this->read_db->join(UB_USER.' AS USER','LOG_COMMENT.created_by = USER.ub_user_id','left');//UB_USER is the table name defined in constant file
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
			//$this->Mod_mail->send_mail('SEND_NOTIFICATION_EMAIL', $email_array);
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
	public function send_mail_for_notification($post_array,$log_table_insertid,$comment_table_insertid)
	{
		//Fetch all the users
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
		$where_builder_str = $this->Mod_log->build_where($post_array_builder_value);
		$get_builder_user_id = array(
								'select_fields' => array('ub_user_id'),
								'where_clause' => $where_builder_str
								);
		$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
		$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($builder_user_id,$this->main_modules[$this->module]);
			$post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			$where_str = $this->Mod_log->build_where($post_array_value);
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
				$assigned_to_first_name[] = $val['first_name'];
				$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
			}
			 $to_address = implode(",",$email_ids);
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
		$scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']);
			if(isset($log_table_insertid) && $log_table_insertid != "")
			{
				$primary_id = $log_table_insertid;
				$template_type = 'log_daily_log_added';
				 $content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'log_notes' => $post_array['log_notes'],
					'log_date' => $post_array['log_date'],
					'project_name' => $this->project_name,
					'log_added_by' => $added_by_first_name,
					'builder_name' => $builder_name,
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
				);
			}else{
				$primary_id = $comment_table_insertid;
				$template_type = 'log_comment_on_daily_log';
				$content_array = array(
					'TO_EMAIL' => $email_ids,
					'SEND_MAIL_INFO' => $level1_string,
					'IMAGESRC' => IMAGESRC,
					'comments' => $post_array['comments'],
					'comment_date' => TODAY,
					'project_name' => $this->project_name,
					'comment_added_by' => $added_by_first_name,
					'builder_name' => $builder_name,
					'base_url'=> BASEURL,
					'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
				);
			}
			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $this->project_id,
					'module_name' => $this->module,
					'module_pk_id' => $primary_id,
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => $builder_user_id,
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
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($builder_user_id,$this->main_modules[$this->module]);
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