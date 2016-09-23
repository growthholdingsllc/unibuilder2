<?php
/** 
 * Mod_message_model Class
 * 
 * @package: Mod_Message_model 
 * @subpackage: Mod_Message_model
 * @category: EMail Messages
 * @author: Baskar
 * @createdon(DD-MM-YYYY): 24-04-2015 
*/
class Mod_Message extends UNI_Model{
	/**
	 * @property: directory
	 * @access: public
	 */
	public $directory = '';
	
	public $allowed_mime_types = Array(
		'audio/wave',
		'application/pdf',
		'application/zip',
		'application/octet-stream',
		'image/jpeg',
		'image/png',
		'image/gif',
	);
	
	var $debug = FALSE;
	
	/**
	 * @property: $raw_mail_data
	 * @access: private
	 */
	private $_raw_mail_data;
	
	/**
	 * @property: $decoded
	 * @access: private
	 */
	private $_decoded;
	
	private $_mail_parts = array('subject'=>'','bodytext'=>'','bodyhtml'=>'');
	
	private $_mail_domain_name = "ttkservices.com";
	
	/**
	 * @constructor
	 */
  public function __construct() 
	{
		//.....
		parent::__construct();
		require_once 'Mail/mimeDecode.php';
		$this->load->library(array('fetchemail/Mailreader','fetchemail/Mimeparser','fetchemail/rfc822_addresses'));
		$this->load->model(array('Mod_user','Mod_doc'));
		$this->load->helper('date');
  }
	
	/**
	*
	* Get Message
	* @created on: 25/04/2015
	* @method: add_message
	* @access: public 
	* @param: 
	* @return: 
	* @createdby: Baskar
	*/
	
	public function get_message($args = array()) 
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_MESSAGE.' AS MESSAGE');
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
			$this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = MESSAGE.'.$args['join']['from_to_userid']);
		}
		if(isset($args['join']['message_content']) && 'yes' === strtolower($args['join']['message_content']))
		{
			$this->read_db->join('ub_message_content'.' AS MESSAGECONTENT','MESSAGECONTENT.ub_message_content_id = MESSAGE.message_content_id');
		}
		if(isset($args['where_clause'])) {$this->read_db->where($args['where_clause']);}
		if(isset($args['order_clause']) && $args['order_clause'] !='') {$this->read_db->order_by($args['order_clause']);}
		if(isset($args['pagination']) && ! empty($args['pagination'])) {$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);}
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
			$data['aaData'] = $res->result_array();
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		return $data;
	}
	
	/**
	*
	* Get Message Folders
	* @created on: 08/05/2015
	* @method: get_message_folder
	* @access: public 
	* @param: 
	* @return: folder array
	* @createdby: MS
	*/
	
	public function get_message_folder($args = array()) 
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_MESSAGE_FOLDER.' AS MESSAGEFOLDER');
		if(isset($args['where_clause'])) {$this->read_db->where($args['where_clause']);}
		if(isset($args['order_clause']) && $args['order_clause'] !='') {$this->read_db->order_by($args['order_clause']);}
		if(isset($args['pagination']) && ! empty($args['pagination'])) {$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);}
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
	* Add Message
	* @created on: 25/04/2015
	* @method: add_message
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdby: Baskar
	*/
	public function add_message($post_array = array())
	{
		if( ! empty($post_array))
		{
			$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
			$post_array['created_on'] = $post_array['modified_on'] = TODAY;
			$post_array['created_by'] = $post_array['modified_by'] = $this->user_id;//$this->user_session['ub_user_id'];
			//echo '<pre>';print_r($post_array);exit;
			if($this->write_db->insert(UB_MESSAGE, $post_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
			}
			else
			{
				// echo $this->write_db->_error_message(); 
				// echo '<br>';$this->write_db->_error_number(); exit;
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
			//echo $this->write_db->last_query();
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
	* Add Message
	* @created on: 20/05/2015
	* @method: update_message
	* @access: public 
	* @param: post data
	* @return: update true return success message otherwise failure message
	* @createdby: MS
	*/
	public function update_message($post_array = array(), $where = array())
	{
		if( ! empty($post_array))
		{
			$post_array['modified_on'] = TODAY;
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			
			if($this->write_db->update(UB_MESSAGE, $post_array, $where))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Update Success';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Update Failed: Failed to update the data';
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
	* Create Email Id
	* @created on: 25/04/2015
	* @method: create_email_id
	* @access: public 
	* @param: new_email_id
	* @return: True if the new email id is created
	* @createdby: Baskar
	*/
	public function create_mail_id($new_email_id){
		//Creates a new email id
	}
	
	/**
	* Process Email
	* @created on: 25/04/2015
	* @method: process_email
	* @access: public 
	* @param: file_location
	* @return: True if the email is processed
	* @createdby: Baskar
	*/
	public function process_email($file_details = array())
	{ 
		try {
			// $this->read_file(JSSRC.'GKtext.eml');
			if(php_sapi_name() == 'cli')
			{
				$this->read_file(DOC_PATH.'fetch_mail/'.$file_details['file_name']);
			}
			else
			{
				$this->read_file(DOC_URL.'fetch_mail/'.$file_details['file_name']);
			}
			$this->mimeparser->ignore_syntax_errors = 1;
			$parameters=array(
				'Data'=>$this->_raw_mail_data,
			);
			$this->mimeparser->Decode($parameters, $decoded);
			//Below line will copy the body and attachment part
			$msgbody_attachment = $decoded[0]['Parts'];
			$this->_mail_parts['unique_message_id'] = $decoded[0]['Headers']['message-id:'];
			echo "<pre>";print_r($decoded);exit;
			
			//Delivery date converstion // Not sure whether it will work for GMT +5:30
			// $date = DateTime::createFromFormat( 'D, d M Y H:i:s O', $decoded[0]['Headers']['delivery-date:']);
			// $this->_mail_parts['mail_date'] = date('Y-m-d H:i:s',local_to_gmt($date->getTimestamp()));
			$this->_mail_parts['mail_date'] = TODAY;
			//from Name
			$from_info = $this->_build_email_address($decoded[0]['ExtractedAddresses']['from:'],'from');
			$this->_mail_parts['from_user_id'] = $from_info[0];
			$this->_mail_parts['from_email_id'] = $from_info[1];
			
			$this->_mail_parts['subject'] = $decoded[0]['Headers']['subject:'];
			$this->_mail_parts['bodyhtml'] = isset($decoded[0]['Body'])?$decoded[0]['Body']:'';
			//get the body and attachment form the email message
			$this->_get_body_attachment();			
			// $ary = $this->object_to_array($this->_decoded);
			
			//build the email id to the required format
			$to_info = $this->_build_email_address($decoded[0]['ExtractedAddresses']['to:']);
			$this->_mail_parts['to_user_ids'] = $to_info[0];
			$this->_mail_parts['to_other_emails'] = $to_info[1];
			$this->_mail_parts['cc_user_ids'] = '';
			$this->_mail_parts['cc_other_emails'] = '';
			if(isset($decoded[0]['ExtractedAddresses']['cc:']))
			{
				$cc_info = $this->_build_email_address($decoded[0]['ExtractedAddresses']['cc:'],'cc');
				$this->_mail_parts['cc_user_ids'] = $cc_info[0] ;
				$this->_mail_parts['cc_other_emails'] = $cc_info[1] ;
			}
			//Get the builder id, projectid, module name and module primary key
			$project_details = $this->_get_project_details();
			$builder_id = isset($project_details['builder_id'])?$project_details['builder_id']:$this->builder_id;
			$project_id = isset($project_details['project_id'])?$project_details['project_id']:'0';
			$db_data = array(
				'unique_message_id'=>$this->_mail_parts['unique_message_id'],
				'mail_date'=>$this->_mail_parts['mail_date'],
				'builder_id'=>$builder_id,
				'project_id'=>$project_id,
				'module_name'=>$project_details['module_name'],
				'module_pk_id'=>$project_details['module_pk_id'],
				'parent_message_id'=>isset($project_details['ub_message_id'])?$project_details['ub_message_id']:'',
				'unique_email_id'=>$this->_mail_parts['unique_email_id'],
				'from_user_id'=>$this->_mail_parts['from_user_id'],
				'from_email_id'=>$this->_mail_parts['from_email_id'],
				'subject'=>$this->_mail_parts['subject'],
				'to_user_ids'=>$this->_mail_parts['to_user_ids'],
				'to_other_emails'=>$this->_mail_parts['to_other_emails'],
				'cc_user_ids'=>$this->_mail_parts['cc_user_ids'],
				'cc_other_emails'=>$this->_mail_parts['cc_other_emails'],
				'message_body'=>$this->_mail_parts['bodyhtml'],
				'message_folder'=> 1,//'Inbox' is 1
			);
			//Inserting into message table
			$data = $this->add_message($db_data);
			//--------------------------------------------------------------------------
			
			//Insert message body in message content table
			$content_array = array(
				'message_body'=>$this->_mail_parts['bodyhtml']
			);
			$insert_content = $this->add_message_content($content_array);
			$message_content_id = 0;
			if(TRUE === $insert_content['status'])
			{
				$message_content_id = $insert_content['ub_message_content_id'];
			}
			
			//Once we got unique_message_id will fetch records from message table
			$where_array[] = array(
							'field_name' => 'MESSAGE.unique_message_id',
							'value'=> $this->_mail_parts['envelope-to'],
							'type' => '='
							);						
			$msg_where_clause = $this->build_where($where_array);
			$msg_array = array('where_clause' => $msg_where_clause
					);
			$unread_message = $this->get_message($msg_array);
			// echo "<pre>";print_r($unread_message);
			if ($unread_message['status'] == TRUE) 
			{
				$unread_message = $unread_message['aaData'];
				for($i=0;$i<count($unread_message);$i++)
				{
					$db_data = array(
					'builder_id' => $unread_message[$i]['builder_id'],
					'project_id' => $unread_message[$i]['project_id'],
					'unique_message_id' => $unread_message[$i]['unique_message_id'],
					'module_name' => $unread_message[$i]['module_name'],
					'module_pk_id' =>$unread_message[$i]['module_pk_id'],
					'mail_date' => TODAY,
					'unique_email_id' => $unread_message[$i]['unique_email_id'],
					'originated_id' => $unread_message[$i]['originated_id'],
					'from_email_id' => '',//$unique_email['unique_id'].'@uniduilder.net',
					'from_user_id' => '',
					'to_user_id' => $unread_message[$i]['to_user_id'],
					'to_user_ids' => $unread_message[$i]['to_user_ids'],
					'to_other_emails' => isset($decoded[0]['Headers']['to:']) ? $this->encrypt_email(array('email' => $decoded[0]['Headers']['to:'], 'name' => '', 'type' => 'TO')) : '',
					'cc_user_ids' => $unread_message[$i]['cc_user_ids'],
					'cc_other_emails' => isset($decoded[0]['Headers']['cc:']) ? $this->encrypt_email(array('email' => $decoded[0]['Headers']['cc:'], 'name' => '', 'type' => 'CC')) : '',
					'bcc_user_ids' => $unread_message[$i]['bcc_user_ids'],
					'bcc_other_emails' => '',//isset($data['other_bcc']) ? $this->Mod_Message->encrypt_email(array('email' => $data['other_bcc'], 'name' => '', 'type' => 'BCC')) : '',
					'subject' => $this->_mail_parts['subject'],
					'message_body' => $this->_mail_parts['bodyhtml'],
					'message_content_id' => $message_content_id,
					'message_folder' => INBOX,
					'parent_message_id' => $unread_message[$i]['parent_message_id'],
					'sent_on' => TODAY,
					'is_read' => 'No',
					'status' => 'Processed');
					//Inserting into message table
					$data = $this->add_message($db_data);
					
					//If any attachment will save the attached file
					if(TRUE == $data['status'])
					{
						//Get the parent folder_id and pass it to view for file upload
						$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
											   'where_clause' => (array('builder_id' =>  $unread_message[$i]['builder_id'],'project_id' => $unread_message[$i]['project_id'],'ui_folder_name' => $unread_message[$i]['module_name']))
											   );
						// echo "<pre>"; print_r($get_folder_id);exit;					   
						$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
						if (isset($all_folder['aaData']) && !empty($all_folder)) 
						{
							$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
						}
						$file_data = array('flag' => 0, 
										  'builder_id'	=> $unread_message[$i]['builder_id'],
										  'projectid' => $unread_message[$i]['project_id'],
										  'createdby' => $unread_message[$i]['created_by'],
										  'user_id' => $unread_message[$i]['created_by'],
										  'modulename' => $unread_message[$i]['module_name'],
										);
						$file_data['moduleid'] = $data['insert_id'];
						$file_data['folderid'] = $data['folder_id'];
							
						for($j=1;$j < count($msgbody_attachment); $j++)
						{
							$file_data['filename'] = $msgbody_attachment[$j]['FileName'];
							$result_array = $this->Mod_doc->insert_file($file_data);
							// echo "<pre>";print_r($result_array);exit;
							/* Code to move the files from temp to actual dir*/
							if(isset($result_array[0])){
								$ext = pathinfo($result_array[0]['sys_file_name'], PATHINFO_EXTENSION);
								if ($result_array[0]['createfolderflag'] == 1 && !empty($ext)) 
								{
									$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
									if(TRUE === $response['status'])
									{
										$file = fopen(DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name'],"wb");
										echo fputs($file,$msgbody_attachment[$j]['Body']);
										fclose($file);
									}
								}
								elseif (!empty($ext)) 
								{
									$file = fopen(DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name'],"wb");
										echo fputs($file,$msgbody_attachment[$j]['Body']);
										fclose($file);
								}
							}
						}
					}
				}
				//End of fetching message records
				return $data;
			}
			return $unread_message;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	/**
	* Add message_content
	* @created on: 15/05/2015
	* @method: add_message_content
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdby: MS
	*/
	public function add_message_content($post_array = array())
	{
		if( ! empty($post_array))
		{
			if($this->write_db->insert(UB_MESSAGE_CONTENT, $post_array))
			{
				$data['ub_message_content_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
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
	* Read the email from the given location
	* 
	* @method: read_file
	* @access: public 
	* @param: filename with the directory 
	* @return: File pointer 
	*/
	public function read_file($file) {
		$fd = fopen($file,'r');
    while(!feof($fd)) {$this->_raw_mail_data .= fread($fd,1024); }
		return $fd;
	}
	
	private function _get_body_attachment() {
		$decoder = new Mail_mimeDecode($this->_raw_mail_data);
		$this->_decoded = $decoder->decode(
				array(
					'decode_headers' => TRUE,
					'include_bodies' => TRUE,
					'decode_bodies' => TRUE,
				)
		);
		
		// Find the email body, and any attachments
		if (isset($this->_decoded->parts) && is_array($this->_decoded->parts)) {
			foreach ($this->_decoded->parts as $idx => $body_part) {
				$this->_decode_part($body_part);
			}
		}
		
		return;
	}
	
	/**
		* @brief Decode a single body part of an email message
		* @note Recursive if nested body parts are found
		* @note This is the meat of the script.
		* @param $body_part (required) The body part of the email message, as parsed by Mail_mimeDecode
		*/
	private function _decode_part($body_part){
		if(array_key_exists('name', $body_part->ctype_parameters)) { // everyone else I've tried
			$filename = $body_part->ctype_parameters['name'];
		} else if ($body_part->ctype_parameters && array_key_exists('filename', $body_part->ctype_parameters)) { // hotmail
			$filename = $body_part->ctype_parameters['filename'];
		} else {
			$filename = "file";
		}

		$mimeType = "{$body_part->ctype_primary}/{$body_part->ctype_secondary}";

		if ($this->debug) {print "Found body part type $mimeType\n";}
		
		if ($body_part->ctype_primary == 'multipart') {
			if (is_array($body_part->parts)) {
				foreach ($body_part->parts as $ix => $sub_part) {
					$this->_decode_part($sub_part);
				}
			}
		} else if ($mimeType == 'text/plain') {
			if (!isset($body_part->disposition)) {
				$this->_mail_parts['bodytext'] .= $body_part->body . "\n"; // $this->body Gather all plain/text which doesn't have an inline or attachment disposition
			} 
		} else if ($mimeType == 'text/html') {
			if (!isset($body_part->disposition)) {
				$this->_mail_parts['bodyhtml'] .= $body_part->body;
			}
		} else if (in_array($mimeType, $this->allowed_mime_types)) {
			$this->save_attachment($filename, $body_part->body, $mimeType);
		}
	}
	
	public function save_attachment() {
		return;
	}
	
	public function _build_email_address($email_ids, $email_type = 'to') {
		$email_user_ids = $email_address = "";
		foreach ($email_ids as $key => $value) {
			//Check for system unique email id
			if ($this->_check_unique_email($value['address'])) {break;}
			if (array_key_exists("name",$value)) {$name = $value['name'];} else {$name = "";}
			$user_record = $this->Mod_user->get_users(array(
				'select_fields' => array('ub_user_id'),
				'where_clause' => array('primary_email'=>$value['address']),
			));
			if(TRUE === $user_record['status']) {
				if (!empty($email_user_ids)) {$email_user_ids .= ',';}
				$email_user_ids .= $user_record['aaData'][0]['ub_user_id']; 
			}
			else {
				if (!empty($email_address)) {$email_address .= EMAIL_SEPERATOR_LEVEL1;}
				$email_address .= $name . EMAIL_SEPERATOR_LEVEL2 . $value['address'] . EMAIL_SEPERATOR_LEVEL2 . $email_type;
			}
		}
		return array($email_user_ids, $email_address);
	}
	
	private function _check_unique_email($email) {
		if (strpos($email,$this->_mail_domain_name) !== false) {
			$this->_mail_parts['unique_email_id'] = $email;
			return 1;
		}
	}
	
	private function _get_project_details ($unique_email = '') {
		if (empty($unique_email)) {$unique_email = $this->_mail_parts['unique_email_id'];}
		$project_info = $this->get_message(
				array(
					"select_fields"=>array('ub_message_id,builder_id,project_id,module_name,module_pk_id'),
					"where_clause"=>array('unique_email_id'=>$unique_email,'parent_message_id'=>0)
				)
			);
		if ($project_info['status'] == True) {return $project_info['aaData'][0];}
	}
	
	

	/**
	*
	* Get Mail Template
	* 
	* @method: _set_mail_template 
	* @access: public 
	* @param: Template name 
	* @return: array 
	*/
	public function set_directory($save_directory)
	{
		$this->directory = $save_directory;
		return;
	}

	/**
	* Process Email
	* @created on: 25/04/2015
	* @method: process_message
	* @access: public 
	* @param: file_location
	* @return: True if the email is processed
	* @createdby: Baskar
	*/
	public function process_message($post_array = array(), $unique_id = '')
	{
		$data = array();
		if( !empty($post_array))
		{
			$to = array();
			$level2_array = array();
			if (isset($post_array['data']['primary_email']) && !empty($post_array['data']['primary_email'])) {
				$to[] = $post_array['data']['name'].EMAIL_SEPERATOR_LEVEL2.$post_array['data']['email'].EMAIL_SEPERATOR_LEVEL2.'TO';
				$level2_array[] = $post_array['data']['name'].EMAIL_SEPERATOR_LEVEL2.$post_array['data']['email'].EMAIL_SEPERATOR_LEVEL2.'TO';
			}
			if (isset($post_array['data']['alter-email']) && !empty($post_array['data']['alter-email'])) {
				$to[] = $post_array['data']['name'].EMAIL_SEPERATOR_LEVEL2.$post_array['data']['alternative_email'].EMAIL_SEPERATOR_LEVEL2.'TO';
				$level2_array[] = $post_array['data']['name'].EMAIL_SEPERATOR_LEVEL2.$post_array['data']['alternative_email'].EMAIL_SEPERATOR_LEVEL2.'TO';
			}
			if(isset($post_array['data']['alt_email_to']) && !empty($post_array['data']['alt_email_to']))
			{
				$alternative_email_2 = explode(",",$post_array['data']['alt_email_to']);
				foreach($alternative_email_2 as $key=>$email_id)
				{
					
					$to[] = ''.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'TO';
					$level2_array[] = ''.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'TO';
				}
			}
			$cc = array();
			if(isset($post_array['data']['alt_email_cc']) && !empty($post_array['data']['alt_email_cc']))
			{
				$alternative_email_2 = explode(",",$post_array['data']['alt_email_cc']);
				foreach($alternative_email_2 as $key=>$email_id)
				{
					
					$cc[] = ''.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'CC';
					$level2_array[] = ''.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'CC';
				}
			}
			$bcc = array();
			if(isset($post_array['data']['alt_email_bcc']) && !empty($post_array['data']['alt_email_bcc']))
			{
				$alternative_email_2 = explode(",",$post_array['data']['alt_email_bcc']);
				foreach($alternative_email_2 as $key=>$email_id)
				{
					
					$bcc[] = ''.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'BCC';
					$level2_array[] = ''.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'BCC';
				}
			}
			$combine_email_address = array('to' => $to,'cc' => $cc,'bcc' => $bcc);
			$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
			$level3_string = preg_replace('/\s+/', '', $level1_string);
			unset($post_array['data']['editor']);
			
			if (!empty($post_array['data']['unique_email_id']) && isset($post_array['data']['unique_email_id'])) 
			{
				$post_array['data']['from_email_id'] = $post_array['data']['unique_email_id'];
			}
			else
			{
				$unique_email = $this->generate_unique_id(UNIQUE_EMAIL_LENGTH);
				$unique_email = $unique_email['unique_id'].'@uniduilder.net';
				$total_count_array = $this->get_message(array(
											'select_fields' => array('MESSAGE.unique_email_id'),
											'where_clause' => array('MESSAGE.unique_email_id'=> $unique_email)
											));
				if(FALSE === $total_count_array['status'])
				{
					 $post_array['data']['unique_email_id'] = $unique_email;
					 $post_array['data']['from_email_id'] = $unique_email;
				}
				else
				{
					$unique_email = $this->generate_unique_id(UNIQUE_EMAIL_LENGTH);
				}
			}
			
			$post_array['data']['from_user_id'] = $this->user_session['ub_user_id'];
			$email_name = $post_array['data']['name'];
			unset($post_array['data']['name']);
			unset($post_array['data']['primary_email']);
			unset($post_array['data']['alter-email']);
			unset($post_array['data']['email']);
			unset($post_array['data']['alternative_email']);
			unset($post_array['data']['alt_email_to']);
		    unset($post_array['data']['alt_email_cc']);
		    unset($post_array['data']['alt_email_bcc']);
		    unset($post_array['data']['email_type']);
		    unset($post_array['data']['folder_id']);
		    unset($post_array['data']['temp_directory_id']);
		    unset($post_array['data']['temp_file_path']);
		    if (!empty($to)) 
		    {
		    	$to_string = implode(EMAIL_SEPERATOR_LEVEL1,$to);
            	$post_array['data']['to_other_emails'] = preg_replace('/\s+/', '', $to_string);
        	}
        	if (!empty($cc)) 
        	{
        		$cc_string = implode(EMAIL_SEPERATOR_LEVEL1,$cc);
            	$post_array['data']['cc_other_emails'] = preg_replace('/\s+/', '', $cc_string);
        	}
        	if (!empty($bcc)) 
        	{
        		$bcc_string = implode(EMAIL_SEPERATOR_LEVEL1,$bcc);
            	$post_array['data']['bcc_other_emails'] =preg_replace('/\s+/', '', $bcc_string);
        	}
			$post_array['data']['sent_on'] = TODAY;
			$post_array['data']['mail_date'] = TODAY;
			$post_array['data']['builder_id'] = $this->user_session['builder_id'];

			//echo '<pre>';print_r($post_array);exit;
			$response = $this->add_message($post_array['data']);
			//$insert_message = $this->response($response);
			if (TRUE === $response['status']) {
				$builder_logo  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']); 
				$content_array = array(
				'FIRST_NAME' => $email_name,
				'REPLY_EMAIL' => $post_array['data']['unique_email_id'],
				'MESSAGE_BODY' => $post_array['data']['message_body'],
				'SUBJECT' => $post_array['data']['subject'],
				'SEND_MAIL_INFO' => $level3_string,
				'IMAGESRC' => IMAGESRC,
				'base_url'=> BASEURL,
				'BUILDER_LOGO' => isset($builder_logo['image_path'])?$builder_logo['image_path']:''
				);
				$data['insert_id'] = $response['insert_id'];
				$data['content_array'] = $content_array;

				//print_r($content_array);exit;
				/*$this->Mod_mail->send_mail('SEND_LEAD_ACTIVITY_EMAIL', $content_array);
				$data['status'] =  TRUE;
				$data['message'] = 'Success message will come here';*/
			}
			return $data;
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
		//$insert_message = $this->response($response);
	}

	/**
	* Encrypt Email
	* @created on: 18/05/2015
	* @method: encrypt_email
	* @access: public 
	* @param: file_location
	* @return: True if the email is processed
	* @createdby: Devansh
	* @modifiedby: CHANDRU
	*/
	public function encrypt_email($post_array = array())
	{
	// print_r($post_array);
		// $post_array['email'] = "devansh@gmail.com,abc@gmail.com,abc@gmail.com,xyz@abc.com,fsdfs@gmail.com";
		// $post_array['name'] = "devansh,abc,xyz";
		// $post_array['type'] = "TO";
		$formated_email = '';
		if(isset($post_array['email']) && !empty($post_array['email']))
			{
				$email = explode(",",$post_array['email']);
				$name = explode(",",$post_array['name']);
				$count = count($email);

				for ($i=0; $i < $count ; $i++) 
				{ 
					if(isset($post_array['reminder']) && $post_array['reminder'] == 'reminder_id' )
					{
						$formated_email_l2[] = $email[$i].EMAIL_SEPERATOR_LEVEL2.$post_array['type'];
					}else{
						$formated_email_l2[] = (isset($name[$i])?$name[$i]:'').EMAIL_SEPERATOR_LEVEL2.$email[$i].EMAIL_SEPERATOR_LEVEL2.$post_array['type'];
					}
				}
				$formated_email_l1 = implode(EMAIL_SEPERATOR_LEVEL1,$formated_email_l2);
            	$formated_email = preg_replace('/\s+/', '', $formated_email_l1);
			}
			return $formated_email;
	}
	/**
	* Decrypt Email
	* @created on: 18/05/2015
	* @method: encrypt_email
	* @access: public 
	* @param: file_location
	* @return: email address with comma saperated 
	* @createdby: Devansh
	*/
	public function decrypt_email($mailids)
	{
		// $mailids = "devansh:::devansh@gmail.com:::TO@$@abc:::abc@gmail.com:::TO@$@xyz:::abc@gmail.com:::TO@$@:::xyz@abc.com:::TO@$@:::fsdfs@gmail.com:::TO";
		$deformated_email = array();
		if ($mailids != '') 
            {
               $email_id = array();
            	$level1_array = explode(EMAIL_SEPERATOR_LEVEL1, $mailids);
            	foreach($level1_array as $key => $level2_string)
				{
					$email_address_array = explode(EMAIL_SEPERATOR_LEVEL2, $level2_string);
					$name[] = $email_address_array['0'];
					$email_id[] = $email_address_array['1'];
					$type = $email_address_array['2'];

				}
               $deformated_email['email'] = implode(",", $email_id);
               $deformated_email['name'] = implode(",", $name);
               $deformated_email['type'] = $type;
            }
			return $deformated_email;
	}
	/**
	* Write in email alias
	* @created on: 18/08/2015
	* @method: write_in_email_alias
	* @access: public 
	* @param: file_location
	* @return: true / false
	* @createdby: Gopakumar
	*/
	public function write_in_email_alias($email)
	{
		if($email != ''){
			$file = fopen("/etc/aliases","a");
			echo fwrite($file,$email.":        incomingmails\n");
			fclose($file);
			exec('sudo /etc/init.d/postfix restart', $output);
			return TRUE;
		}
		return FALSE;
	}
	/* Below code was added by chandru */
	public function delete_message($data, $where_condition)
	{
		if( ! empty($data))
		{
			if($this->write_db->delete(UB_MESSAGE, $where_condition))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Deleted Successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Delete Failed: Failed to delete the data';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Delete operation was Failed';
		}
		return $data;
	}
}
/* End of file mod_master_mail_template.php */
/* Location: ./application/models/mod_message.php */
