<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 600); //300 seconds = 5 minutes
class Messages extends UNI_Controller {
	public $comment_length = 0; 
	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_lead','Mod_Message','Mod_general_value','Mod_timezone','Mod_user','Mod_saved_search','Mod_comment','Mod_project','Mod_mail','Mod_notification','Mod_warranty','Mod_builder','Mod_log','Mod_task','Mod_doc'));
		$this->module;
        //$this->load->helper('url');
        $args =array('classification'=>'message_comments_length');
        $comments_length = $this->Mod_general_value->get_general_value($args);
        // echo '<pre>';print_r($dashboard_item_length_array);exit;
        if(!empty($comments_length))
        {
            $this->comment_length = $comments_length['values'][0]['value'];
        }
        	
    }
	public function index()
	{
		$data = array(
		'title'        			=> "UNIBUILDER",		
		'content'      			=> 'content/messages/messages',
        'page_id'      			=> 'messages',
		'message_list' 			=> 'message_list',
		'message_notfication' 	=> 'message_notfication',
		'comments_list' 		=> 'comments_list',
		'search_session_array' => $this->uni_session_get('SEARCH'),
		'date_all'	           =>'date_all' ,
		
		);
		//Get all module names from ub_comments table
		$module_name_dropdown = $this->Mod_comment->get_comment(array(
									'select_fields' => array('DISTINCT(COMMENT.module_name) AS module_name'),
									));
		$data['module_name_dropdown']=array();
		//echo "<pre>";print_r($module_name_dropdown);
		if(TRUE === $module_name_dropdown['status'])
		{
			//$module_name_pop = array_pop($module_name_dropdown['aaData']);
			$data['module_name_dropdown'] = $this->Mod_Message->build_ci_dropdown_array($module_name_dropdown['aaData'],'module_name', 'module_name');
		}
		$where_str = 'PROJECT.builder_id = '.$this->builder_id.' AND (PROJECT.owner_id = '.$this->user_id.' || PROJECT.project_managers = '.$this->user_id.' || FIND_IN_SET('.$this->user_id.', PROJECT.project_assigned_users))';
		//$where_str = 'PROJECT.builder_id = '.$this->builder_id;
		//Get all projects list from project table with the builder_id
		$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name'),
					'where_clause' => $where_str
					));		
		$data['project_list']=array();
		if(TRUE === $project_list['status'])
		{
			$data['project_list'] = $this->Mod_Message->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name');
		}	
		 $type=$this->Mod_notification->get_notification_types();
		 $data['type_list'] = $this->Mod_notification->get_notification_types();			
			
		//Apply filter code
		$post_array = array( 'builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$apply_filter = true;
		}else{
		$apply_filter = false;
		}
		
		$data['apply_filter'] = $apply_filter;
		//print_r($data);exit;
		$this->template->view($data);
	}
	
	public function newmessage()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/messages/newmessage',
        'page_id'      => 'messages'
		);
		$this->template->view($data);
		
	}
	public function message_inbox()
	{		
		$this->load->view('content/messages/message_inbox');		
	}
	public function message_drafts()
	{		
		$this->load->view('content/messages/message_drafts');		
	}
	public function message_sent()
	{		
		$this->load->view('content/messages/message_sent');		
	}
	public function message_junk()
	{		
		$this->load->view('content/messages/message_junk');		
	}
	public function compose_mailer()
	{	
		$this->load->view('content/messages/compose_mailer');		
	}		
	/** 
	* Get Messages
	* 
	* @method: get_messages, this will get the message folders and list of messages in inbox
	* @access: public 
	* @param:  array containing page no. and folder id
	* @return: array 
	* @created by: MS
	*/	
	public function get_messages()
	{ 
		// echo '<pre>'; print_r($this->session->all_userdata());
		$data = array();
		$project_id = $this->project_id;
		$inbox_id = INBOX; //this should be hard coded
		$draft_id = DRAFT; //this should be hard coded
		$current_folder_id = INBOX; //Default assigned inbox id;
		$current_page_id = 0; 
		$ub_message_id = 0;
		$compose_id = 0;
		$post_data = $this->input->post();
		$type_of_users = '';
		$dropdown_type = '';
		 // echo "postdata=";print_r($post_data);
		//framing an dropdown based on account_type // by Satheesh
		if(isset($this->user_account_type) && BUILDERADMIN == $this->user_account_type)
		{
			$type_of_users = 'all';
			$dropdown_type = 'optgroup';
		}
		else
		{
			$type_of_users = BUILDERADMIN;
		}	
		if(!empty($this->input->post()))
		{
			$result = $this->sanitize_input();
			if(TRUE === $result['status']) //if sanitize is done
			{
				$post_data = $result['data'];
				// print_r($post_data);exit;
				$current_page_id = $post_data['current_page_id'];
				if($post_data['current_folder_id'] != '' && $post_data['current_folder_id'] > 0)
				{
					$current_folder_id = $post_data['current_folder_id'];
				}
				
				if($post_data['ub_message_id'] != '' && $post_data['ub_message_id'] > 0)
				{
					$ub_message_id = $post_data['ub_message_id'];
				}
				
				if($post_data['compose_id'] != '' && $post_data['compose_id'] > 0)
				{
					$compose_id = $post_data['compose_id'];
				}
				
				//Below condition will check mail form is set or not, for sending email
				if(isset($post_data['to_ids']) && count($post_data['to_ids'] > 0))
				{
					$sent_status = $this->send_messages($post_data);
				}
				// echo '<pre>';print_r($post_data);
				//Below condition will action dropdown is set or not
				if(isset($post_data['message_ids']) && count($post_data['message_ids'] > 0))
				{
					$message_ids = implode(",",$post_data['message_ids']);
					$action_array = array(
							'message_action'=>$post_data['message_action'],
							'current_folder_id'=>$current_folder_id);
					$action_status = $this->messages_action($message_ids,$action_array);
				}
				
				//Below condition change the msg read status from no to yes
				if(isset($post_data['msg_is_read']) && 'No' === $post_data['msg_is_read'] && INBOX == $post_data['current_folder_id'])
				{
					$action_array = array(
							'message_action'=>'all_read',
							'current_folder_id'=>$current_folder_id);
					$message_ids = $post_data['ub_message_id'];
					$action_status = $this->messages_action($message_ids,$action_array);
				}
			}
			else
			{
				$this->Mod_project->response($result);
			}
		}
		
		//Below switch case for getting from_to user id field name and msg sent date
		switch ($current_folder_id) 
		{
			case 1: //inbox
				$from_to_userid = "to_user_id";
				$userid = "from_user_id";
				$message_date = "MESSAGE.mail_date AS message_date";
				$date_range_field = "MESSAGE.mail_date";
				break;
			case 2: //sentbox
				$from_to_userid = "from_user_id";
				$userid = "to_user_id";
				$message_date = "MESSAGE.sent_on AS message_date";
				$date_range_field = "MESSAGE.sent_on";
				break;
			case 3: //draft
				$from_to_userid = "from_user_id";
				$userid = "from_user_id";
				$message_date = "MESSAGE.sent_on AS message_date";
				$date_range_field = "MESSAGE.sent_on";
				break;
			case 4: //outbox
				$from_to_userid = "from_user_id";
				$userid = "from_user_id";
				$message_date = "MESSAGE.sent_on AS message_date";
				$date_range_field = "MESSAGE.sent_on";
				break;
			case 5: //trash
				$from_to_userid = "from_user_id";
				$userid = "from_user_id";
				$message_date = "MESSAGE.mail_date AS message_date";
				$date_range_field = "MESSAGE.mail_date";
				break;
			case 6: //delete
				$from_to_userid = "from_user_id";
				$userid = "from_user_id";
				$message_date = "MESSAGE.sent_on AS message_date";
				$date_range_field = "MESSAGE.sent_on";
				break;
		}
		
		//Below query will fetch all the message folders related to logged in user
		$folder_array = array('select_fields' => array('MESSAGEFOLDER.ub_message_folder_id','MESSAGEFOLDER.folder_name'),
				'where_clause' => '(user_id = 0 OR user_id = '.$this->user_session['ub_user_id'].')' 
				);
		$message_folders = $this->Mod_Message->get_message_folder($folder_array);
		$data['message_folders']=$message_folders['aaData'];
		
		// Date range search input
		$message_session = array();
		$post_array = array();
		$inbox_date_range = array();
		$draft_date_range = array();
		if(isset($post_data['daterange']) && $post_data['daterange']!='')
		{
			$formatted_date = explode(" ",$post_data['daterange']);
			$post_array[] = array(
								'field_name' => $date_range_field,
								'from'=> date("Y-m-d", strtotime($formatted_date[0])),
								'to'=> date("Y-m-d", strtotime($formatted_date[2])),
								'type' => 'daterange'
								);
			$inbox_date_range[] = array(
								'field_name' => 'MESSAGE.mail_date',
								'from'=> date("Y-m-d", strtotime($formatted_date[0])),
								'to'=> date("Y-m-d", strtotime($formatted_date[2])),
								'type' => 'daterange'
								);
			$draft_date_range[] = array(
								'field_name' => 'MESSAGE.sent_on',
								'from'=> date("Y-m-d", strtotime($formatted_date[0])),
								'to'=> date("Y-m-d", strtotime($formatted_date[2])),
								'type' => 'daterange'
								);
								
			$message_session['daterange'] = $post_data['daterange'];
		}
	
		//Below query will fetch unread message count for inbox
		$inbox_where_array = $inbox_date_range;
		$inbox_where_array[] = array(
							'field_name' => 'MESSAGE.project_id',
							'value'=> $project_id, 
							'type' => '='
							);
		$inbox_where_array[] = array(
							'field_name' => 'MESSAGE.message_folder',
							'value'=> $inbox_id, 
							'type' => '='
							);					
		$inbox_where_array[] = array(
							'field_name' => 'MESSAGE.is_read',
							'value'=> 'No', 
							'type' => '='
							);	
		$inbox_where_array[] = array(
							'field_name' => 'MESSAGE.to_user_id',
							'value'=> $this->user_session['ub_user_id'], 
							'type' => '='
							);							
		$count_where_clause = $this->Mod_Message->build_where($inbox_where_array);
		$unread_array = array('select_fields' => array('COUNT(MESSAGE.ub_message_id) AS inbox_count'),
				'where_clause' => $count_where_clause
				);
		$unread_message_count = $this->Mod_Message->get_message($unread_array);
		$data['unread_message_count']=$unread_message_count['aaData'][0];
		
		//Below query will fetch Draft message count
		$draft_wehre_array = $draft_date_range;
		$draft_wehre_array[] = array(
							'field_name' => 'MESSAGE.project_id',
							'value'=> $project_id, 
							'type' => '='
							);
		$draft_wehre_array[] = array(
							'field_name' => 'MESSAGE.message_folder',
							'value'=> $draft_id, 
							'type' => '='
							);	
		$draft_wehre_array[] = array(
							'field_name' => 'MESSAGE.from_user_id',
							'value'=> $this->user_session['ub_user_id'], 
							'type' => '='
							);
		$draft_where_clause = $this->Mod_Message->build_where($draft_wehre_array);
		// echo'<pre>';print_r($draft_wehre_array);echo $draft_where_clause;exit;
		$draft_array = array('select_fields' => array('COUNT(MESSAGE.ub_message_id) AS draft_count'),
				'where_clause' => $draft_where_clause
				);
		$draft_message_count = $this->Mod_Message->get_message($draft_array);
		$data['draft_message_count'] = $draft_message_count['aaData'][0];
		$data['current_folder_id'] = $current_folder_id;
		$data['current_page_id'] = $current_page_id;
		$data['ub_message_id'] = $ub_message_id;
		$data['compose_id'] = $compose_id;		
		
		//Get the parent folder_id and pass it to view for file upload
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
		{
			$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
		}
		
		/*code to create the temp dir and pass it to view, for file upload*/
		$dir_response = $this->Mod_doc->create_default_dir();
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
			$data['temprory_dir_id'] = '1';
		}
		
		/*Code for getting signature image to display in compose message */
		$file_data = array(	  'flag' => 2, 
							  'builder_id'	=> $this->user_session['builder_id'],
							  'projectid' => 0,
							  'folderid' => 0,
							  'modulename' => 'user',
							  'moduleid' => $this->user_session['ub_user_id'],
							);
		$result_array = $this->Mod_doc->get_files_for_folder($file_data);
		 // echo "<pre>";print_r($result_array);exit;
		$data['signature_file_path'] = '';
		if(TRUE === $result_array['status'])
		{
			if(isset($result_array[0]['messagestatus']) && $result_array[0]['messagestatus'] == 0)
			{
			
			}else{
				if(isset($result_array[0]['system_file_name']))
				{
					$data['signature_file_path'] = $result_array[0]['system_file_name'];
				}
			}
		}
		//Below if condition will execute message list or message read code
		if($ub_message_id > 0)
		{
			/*Code for upload file */
			$activity_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $ub_message_id,
								);
			$attach_result_array = $this->Mod_doc->get_files_for_folder($activity_data);
			$count = count($attach_result_array);
			// echo "<pre>";print_r($attach_result_array);exit;
			$atachment_data = array();
			for ($i=0; $i < $count ; $i++) 
			{
				if (!empty($attach_result_array[$i]['system_file_name'])) 
				{
					$exp = explode('/', $attach_result_array[$i]['system_file_name']);
					$system_file_name = $exp[count($exp)-2].'/'.$exp[count($exp)-1];
					if (isset($attach_result_array[$i]['ui_file_name']) && !empty($attach_result_array[$i]['ui_file_name'])) 
					{
						$atachment_data[] = array('file_name' => $attach_result_array[$i]['ui_file_name'],
										'sys_file_name' => $system_file_name
									);
					}
				}
			}
			$data['atachment_data'] = $atachment_data;

			//Get the parent folder_id and pass it to view
			$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
								   'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => $this->module))
								   );
			$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
			if (isset($all_folder['aaData']) && !empty($all_folder)) 
			{
				$data['msg_folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
			}
			/*End Code for edit file */

			//------------------- START OF MESSAGE READ CODE --------------
			// to get the users list to display in to, cc & bcc drop down
			$data['user_dropdown'] = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$project_id, 'account_type' => $type_of_users, 'dropdown_type' => $dropdown_type));
			//framing an dropdown based on account_type // by Satheesh
			if($this->user_account_type != BUILDERADMIN && $data['user_dropdown']['status'] == TRUE)
			{
				$data['user_dropdown']= $this->Mod_project->build_ci_dropdown_array($data['user_dropdown']['aaData'],'ub_user_id', 'username','multiple');	
			}
			//Below code will fetch entire details of the message
			$post_array[] = array(
								'field_name' => 'MESSAGE.ub_message_id',
								'value'=> $ub_message_id,
								'type' => '='
								);
			$msgs_where_clause = $this->Mod_Message->build_where($post_array);
			$msgs_array = array('select_fields' => array('USER.first_name','USER.primary_email','MESSAGE.ub_message_id','MESSAGE.from_user_id','MESSAGE.to_user_id','MESSAGE.to_user_ids','MESSAGE.to_other_emails','MESSAGE.cc_user_ids','MESSAGE.cc_other_emails','MESSAGE.bcc_user_ids','MESSAGE.bcc_other_emails','MESSAGE.subject','MESSAGE.originated_id','MESSAGECONTENT.message_body',$message_date),
					'join'=> array('message_content' => 'Yes','user' => 'Yes', 'from_to_userid' => $userid),
					'where_clause' => $msgs_where_clause
					);
			$msg_content = $this->Mod_Message->get_message($msgs_array);
			$data['msg_content']=$msg_content['aaData'][0];
			
			//Below code will decrypt the to, cc and bcc other user mail ids
			if($data['msg_content']['to_other_emails'] != '')
			{
				$to_other_emails = $this->Mod_Message->decrypt_email($data['msg_content']['to_other_emails']);
				$data['msg_content']['to_other_emails'] = $to_other_emails['email'];
			}
			if($data['msg_content']['cc_other_emails'] != '')
			{
				$cc_other_emails = $this->Mod_Message->decrypt_email($data['msg_content']['cc_other_emails']);
				$data['msg_content']['cc_other_emails'] = $cc_other_emails['email'];
			}
			if($data['msg_content']['bcc_other_emails'] != '')
			{
				$bcc_other_emails = $this->Mod_Message->decrypt_email($data['msg_content']['bcc_other_emails']);
				$data['msg_content']['bcc_other_emails'] = $bcc_other_emails['email'];
			}		
			
			//Below code will fetch primary email of to, cc  and bcc internal users to display in view
			if(isset($data['msg_content']['to_user_ids']) && $data['msg_content']['to_user_ids'] != '')
			{	
				//Below code will fetch primary email of to, cc  and bcc internal users
				$to_array = array('select_fields' => array('GROUP_CONCAT(primary_email) As to_internal_emails'),
						'where_clause' => "USER.ub_user_id IN(".$data['msg_content']['to_user_ids'].")"
						);
				$to_primary_mail = $this->Mod_user->get_sub_users($to_array);
				$data['msg_content']['to_mails'] = $to_primary_mail['aaData'][0]['to_internal_emails'].",".$data['msg_content']['to_other_emails'];
				
			}
			if(isset($data['msg_content']['cc_user_ids']) && $data['msg_content']['cc_user_ids'] != '')
			{	
				//Below code will fetch primary email of to, cc  and bcc internal users
				$cc_array = array('select_fields' => array('GROUP_CONCAT(primary_email) As cc_internal_emails'),
						'where_clause' => "USER.ub_user_id IN(".$data['msg_content']['cc_user_ids'].")"
						);
				$cc_primary_mail = $this->Mod_user->get_sub_users($cc_array);
				$data['msg_content']['cc_mails'] = $cc_primary_mail['aaData'][0]['cc_internal_emails'].",".$data['msg_content']['cc_other_emails'];
				
			}
			if(isset($data['msg_content']['bcc_user_ids']) && $data['msg_content']['bcc_user_ids'] != '')
			{
				//Below code will fetch primary email of to, cc  and bcc internal users
				$bcc_array = array('select_fields' => array('GROUP_CONCAT(primary_email) As bcc_internal_emails'),
						'where_clause' => "USER.ub_user_id IN(".$data['msg_content']['bcc_user_ids'].")"
						);
				$bcc_primary_mail = $this->Mod_user->get_sub_users($bcc_array);
				$data['msg_content']['bcc_mails'] = $bcc_primary_mail['aaData'][0]['bcc_internal_emails'].",".$data['msg_content']['bcc_other_emails'];
				
			}
			// echo "<pre>";print_r($data['msg_content']);exit;
			$response = $this->load->view("content/messages/send_message.php",array('msg_data' => $data), true);
			//------------------- END OF MESSAGE READ CODE --------------
			echo $response; exit;
		}
		elseif($compose_id > 0)
		{
			// to get the users list to display in to, cc & bcc drop down
			$data['user_dropdown'] = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$project_id, 'account_type' => $type_of_users, 'dropdown_type' => $dropdown_type));
			// print_r($data['user_dropdown']);exit;
			//framing an dropdown based on account_type // by Satheesh
			if($this->user_account_type != BUILDERADMIN && $data['user_dropdown']['status'] == TRUE)
			{
				$data['user_dropdown']= $this->Mod_project->build_ci_dropdown_array($data['user_dropdown']['aaData'],'ub_user_id', 'username','multiple');	
			}
			//Below line added for not highlighting folder name when compose is clicked
			$data['current_folder_id'] = 0;
			$response = $this->load->view("content/messages/send_message.php",array('msg_data' => $data), true);
			echo $response; exit;
		}
		else
		{
			//------------------- START OF LIST PAGE CODE --------------
			$pagination_array = array();
			$pagination_array = array( 'iDisplayStart' => $current_page_id,'iDisplayLength' => DEFAULT_PAGINATION_LENGTH);
			
			//Below query to get messages
			$post_array[] = array(
								'field_name' => 'MESSAGE.project_id',
								'value'=> $project_id, 
								'type' => '='
								);
			$post_array[] = array(
								'field_name' => 'MESSAGE.message_folder',
								'value'=> $current_folder_id, 
								'type' => '='
								);
			$post_array[] = array(
								'field_name' => $from_to_userid,
								'value'=> $this->user_session['ub_user_id'], 
								'type' => '='
								);
			//	search code from line 519 to 534 added by Gayathri.				
			if(isset($post_data['user_name_filter']) && $post_data['user_name_filter']!='')
			{
				$post_array[] = array(
								'field_name' => 'USER.first_name',
								'value'=> $post_data['user_name_filter'],
								'type' => 'like'
								);
			} 
		if(isset($post_data['email_address_filter']) && $post_data['email_address_filter']!='')
			{
				$post_array[] = array(
								'field_name' => 'USER.primary_email',
								'value'=> $post_data['email_address_filter'],
								'type' => 'like'
								);
			}			
			$msgs_where_clause = $this->Mod_Message->build_where($post_array);
			// echo $msgs_where_clause;exit;
			

			$remove=strrchr($message_date,'AS');
            //remove is now "- Name: bmackeyodonnell"
            $message_date=str_replace(" $remove","",$message_date);
            //echo $message_date;
			$datetime_array = array($message_date=>'message_date');
			$msgs_array = array('select_fields' => array('USER.first_name','MESSAGE.ub_message_id','MESSAGE.is_read','MESSAGE.subject,'.$this->Mod_user->format_user_datetime($datetime_array)),
					'join'=> array('user' => 'yes', 'from_to_userid' => $userid),
					'where_clause' => $msgs_where_clause,
					'order_clause' => 'MESSAGE.created_on desc',
					'pagination' => $pagination_array
					);
			$messages_data = $this->Mod_Message->get_message($msgs_array);
			//print_r($messages_data);
			$data['messages_data']=$messages_data['aaData'];
			
			//Below query to get total number of records
			$totalrecords_where_clause = $this->Mod_Message->build_where($post_array);
			$total_record_array = array('select_fields' => array('COUNT(MESSAGE.ub_message_id) AS total_records'),
					'join'=> array('user' => 'yes', 'from_to_userid' => $userid),
					'where_clause' => $totalrecords_where_clause
					);
			$total_records = $this->Mod_Message->get_message($total_record_array);
			$data['total_records']=$total_records['aaData'][0];
			
			//Below assignment for prev and next values of pagination 
			$data['prev_page_id'] = $current_page_id;
			$data['next_page_id'] = $current_page_id;
			if($current_page_id > 0)
			{
				$data['prev_page_id'] = ($current_page_id-1);
			}
			
			$totalrecords = $data['total_records'];
			$totalrecords = $totalrecords['total_records'];
			if($current_page_id < (round($totalrecords/DEFAULT_PAGINATION_LENGTH)))
			{
				$data['next_page_id'] = ($current_page_id+1);
			}
			
			//Below line will load the message list page
			$response = $this->load->view("content/messages/message_list.php", array('msg_data' => $data), true);
			//------------------- END OF LIST PAGE CODE --------------
			// echo "..."; print_r($data);
			echo $response; exit;
		}
	}
	
	/** 
	* Function for sending external mails and inserting data in ub_message table
	* @method: send_messages 
	* @access: public 
	* @param:  array
	* @return: array 
	*/
	public function send_messages($post_data = array())
	{
		$content_array = array(
			'message_body'=>$post_data['editor']
		);
		  // print_r($post_data);exit;
		//Insert message body into ub_message_content table
		$insert_content = $this->Mod_Message->add_message_content($content_array);
		
		if(TRUE === $insert_content['status'])
		{
			//Forming data array to insert into ub_message table
			$form_data = $this->forming_data_array($post_data);
			//Below loop will insert the msgs in msg table to all to,cc & bccs
			$to_ids = $cc_ids = $bcc_ids = array();
			$mail_to_ids = array_merge(
			isset($post_data['to_ids'])?$post_data['to_ids']:$to_ids, 
			isset($post_data['cc_ids'])?$post_data['cc_ids']:$cc_ids,
			isset($post_data['bcc_ids'])?$post_data['bcc_ids']:$bcc_ids);
			
			foreach($mail_to_ids as $key => $value)
			{
				if($value > 0)
				{
					$form_data['message_content_id'] = $insert_content['ub_message_content_id'];
					$form_data['to_user_id'] = $value;
					$form_data['parent_message_id'] = $post_data['parent_message_id'];
					$form_data['originated_id'] = $post_data['parent_message_id'];
					if($post_data['originated_id'] > 0)
					{
						$form_data['originated_id'] = $post_data['originated_id'];
					}
					$result = $this->Mod_Message->add_message($form_data);
					
					if(TRUE === $result['status'])
					{
						//After inserting message we need to insert in file table
						$uploadfile_array['data'] = array(
						'projectid'=>$this->project_id,
						'moduleid'=>$result['insert_id'],
						'folderid'=>$post_data['folder_id'],
						'temp_directory_id'=>$post_data['temp_directory_id']);
						
						$fileinsert_status = $this->get_temp_filename($uploadfile_array);
						// print_r($uploadfile_array);exit;
					}
				}
			}
			
			//below code will insert data for sent user in ub_message table
			$form_data['message_content_id'] = $insert_content['ub_message_content_id'];
			$form_data['message_folder'] = SENT;
			$result = $this->Mod_Message->add_message($form_data);
			if(TRUE === $result['status'])
			{
				$sent_msg_id = $result['insert_id'];
				//After inserting message we need to insert in file table
				$uploadfile_array['data'] = array(
				'projectid'=>$this->project_id,
				'moduleid'=>$sent_msg_id,
				'folderid'=>$post_data['folder_id'],
				'temp_directory_id'=>$post_data['temp_directory_id']);
				
				$fileinsert_status = $this->get_temp_filename($uploadfile_array);
			}
			
			//Sending email to other to,cc & bcc users
			$to_enc_mail = $cc_enc_mail = $bcc_enc_mail = '';
			if(isset($post_data['other_to']) && $post_data['other_to'] != '')
			{
				$to_enc_mail = $this->Mod_Message->encrypt_email(array('email' => $post_data['other_to'], 'name' => '', 'type' => 'TO'));
				if(isset($post_data['other_cc']) && $post_data['other_cc'] != '')
				{
					$to_enc_mail = $to_enc_mail.EMAIL_SEPERATOR_LEVEL1;
				}
			}
			if(isset($post_data['other_cc']) && $post_data['other_cc'] != '')
			{
				$cc_enc_mail = $this->Mod_Message->encrypt_email(array('email' => $post_data['other_cc'], 'name' => '', 'type' => 'CC'));
				if(isset($post_data['other_bcc']) && $post_data['other_bcc'] != '')
				{
					$cc_enc_mail = $cc_enc_mail.EMAIL_SEPERATOR_LEVEL1;
				}
			}
			if(isset($post_data['other_bcc']) && $post_data['other_bcc'] != '')
			{
				$bcc_enc_mail = $this->Mod_Message->encrypt_email(array('email' => $post_data['other_bcc'], 'name' => '', 'type' => 'BCC'));
			}
			//If other emails are entered then will send email to them
			$level3_string = $to_enc_mail.$cc_enc_mail.$bcc_enc_mail;
			if($level3_string != '')
			{
				// $unique_email = $this->Mod_Message->generate_unique_id(UNIQUE_EMAIL_LENGTH);
				$content_array = array(
				'FIRST_NAME' => '',
				'reply_to' => $form_data['unique_email_id'],
				'REPLY_EMAIL' => $form_data['unique_email_id'],
				'MESSAGE_BODY' => $post_data['editor'],
				'SUBJECT' => $post_data['subject'],
				'SEND_MAIL_INFO' => $level3_string
				);
				
				//File attachment code start
				$activity_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $sent_msg_id,
								);
				$attach_result_array = $this->Mod_doc->get_files_for_folder($activity_data);
				
				$attchment_array = array();
				for ($i=0; $i < count($attach_result_array); $i++) 
				{
					if(isset($attach_result_array[$i]['ub_doc_file_id']) && $attach_result_array[$i]['ub_doc_file_id'] > 0)
					{
						$attchment_array[] = array('file_path' => DOC_PATH.$attach_result_array[$i]['system_file_name'],
											'ui_file_name' => $attach_result_array[$i]['ui_file_name']);
					}
				}
				//File attachment code End
				if(!empty($attchment_array))
				{
					$content_array['ATTACHMENT_INFO'] = $attchment_array;
				}
				//echo "<pre>";print_r($content_array);exit;
				$sendmail_result = $this->Mod_mail->send_mail('SEND_MESSAGE_MAIL', $content_array);
				$data['status'] =  TRUE;
				$data['message'] = 'Success message will come here';
				
				/*Post sending mail we need to create alias mail id*/
				if(isset($form_data['unique_id']) && !empty($form_data['unique_id']))
				{
				$alias_result = $this->Mod_Message->write_in_email_alias($form_data['unique_id']);
				}
			}
		}
		else
		{
			return $insert_content;
		}
	}
	
	/** 
	* Function for action on messages like, read, delete, thrash
	* @method: messages_action 
	* @access: public 
	* @param:  array
	* @return: array 
	*/
	public function messages_action($message_ids = '', $action_array = array())
	{
		$action = $action_array['message_action'];
		$current_folder_id = $action_array['current_folder_id'];
		$data = array();
		switch($action)
		{
			case 'all_read':
			{
				$data = array('is_read' => 'Yes');
				break;
			}
			case 'delete':
			{
				$data = array('message_folder' => DELETE);
				break;
			}
		}
		$where_array[] = array(
							'field_name' => 'ub_message_id',
							'value'=> $message_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		$where_condition = $this->Mod_Message->build_where($where_array);
		if($current_folder_id == DELETE)
		{
			$result = $this->Mod_Message->delete_message($data, $where_condition);
		}else{
			$result = $this->Mod_Message->update_message($data, $where_condition);
		}
		return $result;
	}
	
	/** 
	* Forming data array for insertion in ub_message table
	* 
	* @method: forming_data_array 
	* @access: public 
	* @param:  array
	* @return: array 
	*/
	function forming_data_array($data = array())
	{
		$unique_email = $this->Mod_Message->generate_unique_id(UNIQUE_EMAIL_LENGTH);
		$form_data = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $this->project_id,
					'unique_message_id' => $unique_email['unique_id'],
					'module_name' => $this->module,
					'module_pk_id' => 0,
					'mail_date' => TODAY,
					'unique_email_id' => $unique_email['unique_id'].'@unibuilder.net',
					'originated_id' => '',
					'from_email_id' => $unique_email['unique_id'].'@unibuilder.net',
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => 0,
					'to_user_ids' => isset($data['to_ids'])?implode(",",$data['to_ids']):'',
					// 'to_other_emails' => isset($data['other_to']) ? $data['other_to'] : '',
					'to_other_emails' => isset($data['other_to']) ? $this->Mod_Message->encrypt_email(array('email' => $data['other_to'], 'name' => '', 'type' => 'TO')) : '',
					'cc_user_ids' => isset($data['cc_ids'])?implode(",",$data['cc_ids']):'',
					'cc_other_emails' => isset($data['other_cc']) ? $this->Mod_Message->encrypt_email(array('email' => $data['other_cc'], 'name' => '', 'type' => 'CC')) : '',
					'bcc_user_ids' => isset($data['bcc_ids'])?implode(",",$data['bcc_ids']):'',
					'bcc_other_emails' => isset($data['other_bcc']) ? $this->Mod_Message->encrypt_email(array('email' => $data['other_bcc'], 'name' => '', 'type' => 'BCC')) : '',
					'subject' => isset($data['subject']) ? $data['subject'] : '',
					'message_body' => '',
					'message_content_id' => 0,
					'message_folder' => INBOX,
					'parent_message_id' => 0,
					'sent_on' => TODAY,
					'is_read' => 'No',
					'status' => 'Processed');
		
		return $form_data;
	}
	
	/** 
	* Get comment
	* 
	* @method: get_comment 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: Sidhartha
	* @URL: bgxf19ncy9nZXRfY29tbWVudC8- 
	*/
	public function get_comment()
	{		

		// Pagination argument
		$result = $this->sanitize_input();
		//$module_name = '';
		$search_session_array = array();

		// Getting data of a particular builder
		$post_array[] = array(
							   'field_name' => 'COMMENT.builder_id',
							   'value'=> $this->user_session['builder_id'], 
							   'type' => '='
							);
		// Search input - Search input parameter we are used to builder the where condition and will save it in session.

		// Module Name search input
		if(isset($result['data']['module_name']) && $result['data']['module_name']!='')
		{
				$post_array[] = array(
									'field_name' => 'COMMENT.module_name',
									'value'=> $result['data']['module_name'], 
									'type' => '='
									);
				$search_session_array['module_name'] = $result['data']['module_name'];	
		}
		// Project id search input
		if(isset($this->project_id) && $this->project_id!=''){
		$post_array[] = array(
							   'field_name' => 'COMMENT.project_id',
							   'value'=> $this->project_id, 
							   'type' => '='
							);
	    }
		$this->uni_set_session('search', $search_session_array);
		$where_str = $this->Mod_Message->build_where($post_array);
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
		  $order_by_where = 'COMMENT.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
		}
		// Fetch argument building
		$date_array = array('COMMENT.created_on'=>'created_on');
		$created_on = array(
							'select_fields' => array('date(COMMENT.created_on) AS created_date','COMMENT.ub_comments_id,'.$this->Mod_user->format_user_datetime($date_array,"date")),
							'join'=> array('user'=>'Yes','project'=>'Yes'),
							'where_clause' => $where_str,
							'group_clause' => array("date(COMMENT.created_on)"),
							'pagination' => $pagination_array
                            );
		$response_created_on = $this->Mod_comment->get_comment($created_on);

		if(TRUE == $response_created_on['status']){
		// Get All comments posted by owner
		foreach($response_created_on['aaData'] as $key=>$val)
        {
        	// Search input - Search input parameter we are used to builder the where condition.
        	if(isset($result['data']['module_name']) && $result['data']['module_name']!='')
		     {
				$post_array_owner[] = array(
									'field_name' => 'COMMENT.module_name',
									'value'=> $result['data']['module_name'], 
									'type' => '='
									);	
		     }
		     if(isset($this->project_id) && $this->project_id!=''){
		     $post_array_owner[] = array(
							   'field_name' => 'COMMENT.project_id',
							   'value'=> $this->project_id, 
							   'type' => '='
							);
		     }
		     $post_array_owner[] = array(
							   'field_name' => 'COMMENT.builder_id',
							   'value'=> $this->user_session['builder_id'], 
							   'type' => '='
							);
     		$post_array_owner[] = array(
							   'field_name' => 'USER.account_type',
							   'value'=> OWNER, 
							   'type' => '='
							);
     		$post_array_owner[] = array(
							   'field_name' => 'date(COMMENT.created_on)',
							   'value'=> $val['created_date'], 
							   'type' => '='
							);
		    $where_str_owner = $this->Mod_Message->build_where($post_array_owner);
		    // Fetch argument building
        	$comments_list_owner = array(
							'select_fields' => array('COMMENT.comments as length','SUBSTRING(COMMENT.comments,1,250) AS comments','COMMENT.project_id','COMMENT.module_name','COMMENT.module_pk_id','COMMENT.created_by','USER.account_type','USER.first_name','COMMENT.show_owner','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name','COMMENT.show_sub','COMMENT.ub_comments_id,'.$this->Mod_user->format_user_datetime($date_array,"date")),
							'join'=> array('user'=>'Yes','project'=>'Yes'),
							'where_clause' =>  $where_str_owner,
							'order_clause' => 'COMMENT.ub_comments_id desc LIMIT '.$this->comment_length,
                            );
        	unset($post_array_owner);
		   $response_owner = $this->Mod_comment->get_comment($comments_list_owner);
		   if(TRUE == $response_owner['status'])
		   {
			 $response_created_on['aaData'][$key]['owner'] = $response_owner['aaData'];
		   }  
        }
        // Get All comments posted by builder
        foreach($response_created_on['aaData'] as $key=>$val)
        {
        	// Search input - Search input parameter we are used to builder the where condition.
        	if(isset($result['data']['module_name']) && $result['data']['module_name']!='')
		     {
				$post_array_builder[] = array(
									'field_name' => 'COMMENT.module_name',
									'value'=> $result['data']['module_name'], 
									'type' => '='
									);	
		     }
		     if(isset($this->project_id) && $this->project_id!=''){
		     $post_array_builder[] = array(
							   'field_name' => 'COMMENT.project_id',
							   'value'=> $this->project_id, 
							   'type' => '='
							);
		     }
		     $post_array_builder[] = array(
							   'field_name' => 'COMMENT.builder_id',
							   'value'=> $this->user_session['builder_id'], 
							   'type' => '='
							);
        	$post_array_builder[] = array(
							   'field_name' => 'USER.account_type',
							   'value'=> BUILDERADMIN, 
							   'type' => '='
							);
     		$post_array_builder[] = array(
							   'field_name' => 'date(COMMENT.created_on)',
							   'value'=> $val['created_date'], 
							   'type' => '='
							);
		   $where_str_builder = $this->Mod_Message->build_where($post_array_builder);
		   // Fetch argument building
		   $comments_list_builder = array(
							'select_fields' => array('COMMENT.comments as length','SUBSTRING(COMMENT.comments,1,250) AS comments','COMMENT.project_id','COMMENT.module_name','COMMENT.module_pk_id','COMMENT.created_by','USER.account_type','USER.first_name','COMMENT.show_owner','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name','COMMENT.show_sub','COMMENT.ub_comments_id,'.$this->Mod_user->format_user_datetime($date_array,"date")),
							'join'=> array('user'=>'Yes','project'=>'Yes'),
							'where_clause' => $where_str_builder,
							'order_clause' => 'COMMENT.ub_comments_id desc LIMIT '.$this->comment_length,
                            );
		   unset($post_array_builder);
		   $response_builder = $this->Mod_comment->get_comment($comments_list_builder);
		   if(TRUE == $response_builder['status'])
		   {
			 $response_created_on['aaData'][$key]['builder'] = $response_builder['aaData'];
		   }  
        }
        // Get All comments posted by subcontractor
        foreach($response_created_on['aaData'] as $key=>$val)
        {
        	// Search input - Search input parameter we are used to builder the where condition.
        	if(isset($result['data']['module_name']) && $result['data']['module_name']!='')
		     {
				$post_array_sub[] = array(
									'field_name' => 'COMMENT.module_name',
									'value'=> $result['data']['module_name'], 
									'type' => '='
									);	
		     }
		     if(isset($this->project_id) && $this->project_id!=''){
		      $post_array_sub[] = array(
							   'field_name' => 'COMMENT.project_id',
							   'value'=> $this->project_id, 
							   'type' => '='
							);
		     }
		     $post_array_sub[] = array(
							   'field_name' => 'COMMENT.builder_id',
							   'value'=> $this->user_session['builder_id'], 
							   'type' => '='
							);
           $post_array_sub[] = array(
							   'field_name' => 'USER.account_type',
							   'value'=> SUBCONTRACTOR, 
							   'type' => '='
							);
     		$post_array_sub[] = array(
							   'field_name' => 'date(COMMENT.created_on)',
							   'value'=> $val['created_date'], 
							   'type' => '='
							);
		   $where_str_sub = $this->Mod_Message->build_where($post_array_sub);
		   // Fetch argument building	  
		   $comments_list_sub = array(
							'select_fields' => array('COMMENT.comments as length','SUBSTRING(COMMENT.comments,1,250) AS comments','COMMENT.project_id','COMMENT.module_name','COMMENT.module_pk_id','COMMENT.created_by','USER.account_type','USER.first_name','COMMENT.show_owner','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name','COMMENT.show_sub','COMMENT.ub_comments_id,'.$this->Mod_user->format_user_datetime($date_array,"date")),
							'join'=> array('user'=>'Yes','project'=>'Yes'),
							'where_clause' => $where_str_sub,
							'order_clause' => 'COMMENT.ub_comments_id desc LIMIT '.$this->comment_length,
                            );
		    unset($post_array_sub);
		   $response_sub = $this->Mod_comment->get_comment($comments_list_sub);
		   if(TRUE == $response_sub['status'])
		   {
			 $response_created_on['aaData'][$key]['sub'] = $response_sub['aaData'];
		   }  
        }
        
	   }
	  // The following parameters required for data table
	  if(($response_created_on['status'] == FALSE))
	  {
	    $response_created_on = array();
	    $response_created_on['aaData'] = array();
	  }
	  else
	  {
		// Get number of records
		$total_count_array = $this->Mod_comment->get_comment(array(
									'select_fields' => array('COUNT(DISTINCT(date(COMMENT.created_on))) AS total_count'),
									'where_clause' => $where_str,
									));
		//print_r($total_count_array);
		$response_created_on['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
		$response_created_on['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
		$response_created_on['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
	  }
	  $this->Mod_comment->response($response_created_on);							
	}

	/** 
	* Add comment
	* 
	* @method: new_comment 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: sidhartha
	* @URL: bgxf19ncy9zYXZlX2NvbW1lbnQv 
	*/	
	public function save_comment()
	{
		if(!empty($this->input->post()))
		{
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{	
				//print_r($result['data']);
				$post_data = array(
					'comments' => $result['data']['comments'],
					'project_id' => $result['data']['project_name'],
					'show_sub' => isset($result['data']['show_sub']) ? "Yes" : "No",
					'show_owner' => isset($result['data']['show_owner']) ? "Yes" : "No",
					'module_pk_id' =>$result['data']['module_pk_id'],
					'builder_id' => $this->user_session['builder_id'],
					'created_on' => TODAY,
					'created_by' => $this->user_session['ub_user_id'],
					'modified_on' => TODAY,
					'modified_by' => $this->user_session['ub_user_id'],
					'module_name' => $result['data']['module_name']
					);
				$response = $this->Mod_comment->add_comment($post_data);
				$this->Mod_comment->response($response);	
			}
				
		}
	}
	/** 
	* Give Notification
	* 
	* @method: send_notify 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9zZW5kX25vdgxf1lmeS8-
	*/	
	public function send_notify()
	{
		  if(!empty($this->input->post()))
		  {
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$post_array = array();
				//$result['data']['project_id'] = '159';
			  	if(isset($result['data']['owner_notify']) && isset($result['data']['sub_notify']))
			  	{
			  		$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.role_id',
								'value'=> SUB_CONTRACTOR_ROLE_ID.','.OWNER_ROLE_ID,
								'type' => '||',
								'classification' => 'primary_ids'
							);
			  	}
			  	else if(isset($result['data']['owner_notify']) && !isset($result['data']['sub_notify']))
			  	{
			  		$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.role_id',
								'value'=> OWNER_ROLE_ID,
								'type' => '||',
								'classification' => 'primary_ids'
							);
			  	}
			  	else if(!isset($result['data']['owner_notify']) && isset($result['data']['sub_notify']))
			  	{
			  		$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.role_id',
								'value'=> SUB_CONTRACTOR_ROLE_ID,
								'type' => '||',
								'classification' => 'primary_ids'
							);
			  	}
			  	if(count($post_array) > 0)
			  	{
			  		if($result['data']['project_name'] > 0)
			  		{
			  			$post_array[] = array(
								'field_name' => 'PROJECT_ASSIGNED_USERS.project_id',
								'value'=> $result['data']['project_name'], 
								'type' => '='
							);
				  		$where_str = $this->Mod_comment->build_where($post_array);
				  		//print_r($where_str);exit;
					  	$result_data = $this->Mod_comment->get_userinfo(array(
										'select_fields' => array('PROJECT_ASSIGNED_USERS.project_id','PROJECT_ASSIGNED_USERS.role_id',
											'PROJECT_ASSIGNED_USERS.assigned_to','USER.first_name','USER.primary_email'),
										'join'=> array('user'=>'Yes'),
										'group_clause' => array("PROJECT_ASSIGNED_USERS.assigned_to"),
										'where_clause' => $where_str
														));
				        // Response data
				        $this->Mod_comment->response($result_data);
			  		}
			  		
			  	}
			  	
		  }
	    }
	}	
	  /** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_Message->destroy_session($result['data']);
			}
			$this->Mod_Message->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}

	/** 
	* Apply Saved Search
	* 
	* @method: apply_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: sidhartha 
	* @created on: 03/04/2015 
	* url encoded : cm9sZXMvZ2V0X3NhdmVkX3NlYXJjaC8-
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
				$task_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($task_array)."'"
				);
				//print_r($post_array);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}else{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
				}
		}else{
		if(isset($result_data['aaData'])){
		 $serialized_data = $result_data['aaData'][0]['search_params'];
		 $remove_single_quote = str_replace("'", '', $serialized_data);
		 $unserialized_data = unserialize($remove_single_quote);
		$result_data['aaData'][0]['search_params'] = $unserialized_data;
		 if(!empty($unserialized_data))
		 {
			
			
			if(!empty($unserialized_data['module_names']))
			{
				$search_session_array['module_name'] =$unserialized_data['module_names'];
				
			}
			
			$this->uni_set_session('search', $search_session_array);
			$this->Mod_Message->response($result_data);
			}
		}
		else
		{
			$result_data = array();
			$result_data['aaData'] = array();
			$result_data['status'] = FALSE;
			$result_data['message'] = 'Post array is empty';
			//$result_data = array();
			$this->Mod_Message->response($result_data);
		}
	 }
	/* Apply Filter code Ends here */
	}
	
	/**
	* Get Notification
	* @created on: 16/05/2015
	* @method: get_notification
	* @access: public 
	* @param: file_location
	* @return: True if the email is processed
	* @createdby: GAYATHRI KALYANI
	*/
	
	public function get_notification()
   {
	 $post_array[] = array(
	 
							'field_name' =>'NOTIFICATION.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							
						   );
		if(!empty($this->project_id))
			{
				$post_array[] = array(
								'field_name' => 'NOTIFICATION.project_id',
								'value'=> $this->project_id, 
								'type' => '='
							);
			}
// echo '<pre>';print_r($post_array);			
	// $type=$this->Mod_notification->get_notification_types();
    // echo '<pre>';print_r($type);	
		// Order by
		$order_by_where = '';
		// Pagination Array
		$pagination_array = array();
		$total_count_array =  array();
		$search_session_array = array();
		if(!empty($this->input->post()))
		{
				
				$result = $this->sanitize_input();
			 // echo '<pre>';print_r($result);	
			if(TRUE === $result['status'])
			{
			  if(isset($result['data']['primary_email']) && $result['data']['primary_email']!='')
			  {
						$post_array[] = array(
								'field_name' => 'NOTIFICATION.to_user_id',
								'value'=> $result['data']['primary_email'], 
								'type' => '='
							);
					 $search_session_array['primary_email'] = $result['data']['primary_email'];
			   }
			   
			 // echo '<pre>';print_r($post_array);
		         if(isset($result['data']['daterange']) && $result['data']['daterange']!='')
				{
					
					$formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' => 'NOTIFICATION.modified_on',
										'from'=> date("Y-m-d", strtotime($formatted_date[0])),
										'to'=> date("Y-m-d", strtotime($formatted_date[2])),
										'type' => 'daterange'
									      );   
						$search_session_array['daterange'] = $result['data']['daterange'];
				}
			  // echo '<pre>';print_r($post_array);
				if(isset($result['data']['type']) && $result['data']['type']!=''&& $result['data']['type'] != 'null')
			  {
						$post_array[] = array(
								'field_name' => 'NOTIFICATION.type',
								'value'=> $result['data']['type'], 
								'type' => '='
							);
					 $search_session_array['type'] = $result['data']['type'];
			   }
			    // echo '<pre>';print_r($post_array);
			     // Setting session 
				 $this->uni_set_session('search', $search_session_array); 
				 
				 $where_str = $this->Mod_notification->build_where($post_array);
				   // echo '<pre>';print_r($where_str);exit;
				 if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
					{
						$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
						// Get number of records
						$total_count_array = $this->Mod_notification->get_notification(array(
													'select_fields' => array('COUNT(NOTIFICATION.ub_notification_id) AS total_count'),
													'where_clause' => $where_str,
													'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'yes')
												));
													
					}
				// Setting session 
				// $this->uni_set_session('search', $search_session_array);
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					
					// Get formatted sort name
					$format_sort_name = $this->Mod_notification->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'NOTIFICATION.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
					
				}
				else
				{
				$order_by_where = 'NOTIFICATION.modified_on DESC';
				}
        }
	else
	{
		$this->Mod_notification->response($result);
	}
 }
	    $date_array = array('datetime'=>'datetime'); 
	    $datetime_array = array('NOTIFICATION.modified_on'=>'modified_on');
		// Fetch Data all records based on conditions
		$result_data = $this->Mod_notification->get_notification(array(
												'select_fields' => array('NOTIFICATION.ub_notification_id',
												'USER.primary_email','NOTIFICATION.type', 'NOTIFICATION.subject','PROJECT.project_name,'.$this->Mod_user->format_user_datetime($datetime_array)),
												'join'=> array('user'=>'Yes','project'=>'Yes','builder'=>'Yes'),
												'where_clause' => $where_str,
												'order_clause' => $order_by_where,
												'pagination' => $pagination_array
												));
		// echo '<pre>';print_r($result_data);						
												  
									
		 // Response data
		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			// Get number of records
			// The following parameters required for data table
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			 $result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
				
		$this->Mod_notification->response($result_data);
		
		 //echo $this->db->last_query($result_data);
		//echo '<pre>';print_r($this->user_session);exit;
 }

  /** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	public function notification_destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_notification->destroy_session($result['data']);
			}
			$this->Mod_notification->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	} 
	
				
}