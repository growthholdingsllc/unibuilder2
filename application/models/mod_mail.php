<?php
/** 
 * Mail Class
 * 
 * @package: Mail 
 * @subpackage:  
 * @category: Email
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 13-03-2015 
*/
/** 
 * PHP Mailer library included for sending email
 * 
*/
class Mod_mail extends UNI_Model{
	/**
	 * @constructor
	 */
    public function __construct() {
		parent::__construct();		
		$this->load->model(array('Mod_master_mail_template','Mod_builder_mail_template','Mod_general_value'));	
		$this->load->library('parser');
    }
	/** 
	* Send Email
	* 
	* @method: send_mail 
	* @access: public 
	* @param: tpl_name 
	* @return: array 
	*/
	public function send_mail($tpl_name, $content_array, $default='No')
	{
		if('' == $tpl_name)
		{
			echo 'Template name is not given as an argument';exit;
		}
		else
		{
			if(empty($content_array))
			{
				echo 'Template name is not given as an argument';exit;
			}
			else
			{
				// Get SMTP Settings
				// $smtp_settings = $this->_get_smtp_settings('smtp_settings');
				$args = array('classification'=>'smtp_settings', 'where_clause' => array('int04' => DEFAULT_SMTP));
				$smtp_settings = $this->Mod_general_value->get_general_value($args);
				// Get Mail Template
				if($default == 'No')
				{
					if(isset($this->user_session['builder_id']))
					{
						$builder_id = $this->user_session['builder_id'];
					}else{
						$builder_id = 0;
					}
					$args = array(
							'select_fields' => array('*'),
							'where_clause' => array('name' => $tpl_name, 'builder_id' =>$builder_id )
							);
					$mail_template_data = $this->Mod_builder_mail_template->get_builder_mail_template($args);
					
					if($mail_template_data['status'] == FALSE)
					{
						$args = array(
								'select_fields' => array('*'),
								'where_clause' => array('name' => $tpl_name, 'builder_id' => 0)
							);
						$mail_template_data = $this->Mod_builder_mail_template->get_builder_mail_template($args);
						$mail_template = $mail_template_data['aaData'][0];
					}
					else
					{
						$mail_template = $mail_template_data['aaData'][0];
					}
				}
				else
				{
					$mail_template = $this->Mod_master_mail_template->get_master_mail_template($tpl_name);
				}
				$from_email = (isset($content_array['from_email']) && $content_array['from_email'] != '')?$content_array['from_email']:$mail_template['from_email'];
				
				$from_name = (isset($content_array['from_name']) && $content_array['from_name'] != '')?$content_array['from_name']:$mail_template['from_name'];
				
				$reply_to = (isset($content_array['reply_to']) && $content_array['reply_to'] != '')?$content_array['reply_to']:$mail_template['reply_to'];
				
				$return_path = (isset($content_array['return_path']) && $content_array['return_path'] != '')?$content_array['return_path']:$mail_template['return_path'];
				
				$this->email->CharSet = 'UTF-8';
				$this->email->IsSMTP(); // telling the class to use SMTP
				$this->email->SMTPDebug  = FALSE;              // enables SMTP debug information (for testing)
														   // 1 = errors and messages
														   // 2 = messages only
				$this->email->SMTPAuth   = TRUE;                  // enable SMTP authentication
				$this->email->Host       = $smtp_settings['values'][0]['host']; // sets the SMTP server
				$this->email->Port       = $smtp_settings['values'][0]['port'];                    // set the SMTP port for the GMAIL server
				$this->email->Username   = $smtp_settings['values'][0]['username']; // SMTP account username
				$this->email->Password   = $smtp_settings['values'][0]['password'];        // SMTP account password
				
				// $this->email->SMTPSecure    = 'ssl';
				
				$this->email->AddReplyTo($reply_to,$from_name);
				
				$this->email->SetFrom($from_email, $from_name);
				
				$this->email->ReturnPath= $return_path;
				
				$this->email->Subject    = $this->parser->parse_string($mail_template['subject'], $content_array);

				$this->email->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				
				if(!isset($content_array['BUILDER_LOGO']) || (isset($content_array['BUILDER_LOGO']) && $content_array['BUILDER_LOGO'] == ''))
				{
					$content_array['BUILDER_LOGO'] = IMAGESRC.'logo.png';
				}
				$content_array['IMAGESRC'] = IMAGESRC;
				$content_array['BASE_URL'] = base_url();
				$content_array['TEMPLATE_BODY'] = $this->parser->parse_string($mail_template['html_message'], $content_array);
				$template = file_get_contents(APPPATH.'views/common/mail_template.php');
				$body = $this->parser->parse_string($template, $content_array);
				
				// $content_array['TEMPLATE_BODY'] = $this->parser->parse_string($mail_template['html_message'], $content_array);
				// $body = $this->load->view('common/mail_template.php', $content_array, true);

				// Added By Gopakumar	
				// $this->email->MsgHTML($body);
				$this->email->IsHTML(true);
				$this->email->Body = $body;
				//echo '<pre>mail_template';print_r($mail_template);
				// echo '<pre>';print_r($content_array);exit;
				if(isset($content_array['SEND_MAIL_INFO']))
				{
					// Add email addresses based on address type
					$this->add_address($content_array['SEND_MAIL_INFO']);
					// Add Attachment
					if(isset($content_array['ATTACHMENT_INFO']))
					{
						$this->add_attachment($content_array['ATTACHMENT_INFO']);
					}
					if(!$this->email->Send()) 
					{
					  echo "Mailer Error: " . $this->email->ErrorInfo;
					} else 
					{
						if(isset($content_array['notification_id']) && $content_array['notification_id'] > 0)
						{
							$this->write_db->where('ub_notification_id', $content_array['notification_id']);
							if($this->write_db->update(UB_NOTIFICATION, array('subject' => $this->email->Subject, 'message' => strip_tags($content_array['TEMPLATE_BODY']))))
							{
								return true;
							}
							else
							{
								$data['status'] = FALSE;
								$data['message'] = 'Update failed';
							}
						}
						else
						{
							return true;
							echo "Message sent!";
						}
					}
				}
				else
				{
					$response['status'] = FALSE;
					$response['message'] = 'Argument SEND_MAIL_INFO not defined';
				}
				exit;
			}
		}
	}
	/** 
	* Add Email address to mail object
	* 
	* @method: add_address 
	* @access: public 
	* @param: email_content_array 
	* @return: array 
	*/
	public function add_address($email_content_array) {
        //Explode for multiple email addresses
        $level1_array = explode(EMAIL_SEPERATOR_LEVEL1, $email_content_array);
		foreach($level1_array as $key => $level2_string)
		{
			$email_address_array = explode(EMAIL_SEPERATOR_LEVEL2, $level2_string);
			$name = $email_address_array[0];
			$email_id = $email_address_array[1];
			$address_type = isset($email_address_array[2])?$email_address_array[2]:'TO';
			switch (strtolower($address_type)) {
                case "from" : 
					$this->email->From = $email_id;
                    $this->email->FromName = $name;
                    break;
                case "cc": 
					$this->email->AddCC($email_id, $name);
                    break;
                case "bcc": 
					$this->email->AddBCC($email_id, $name);
                    break;
                case "reply to": 
					$this->email->AddReplyTo($email_id, $name);
                    break;
                default: 
					$this->email->AddAddress($email_id, $name);
            }
		}
		return;
    }
	/** 
	* Add Attachment to mail object
	* 
	* @method: add_attachment 
	* @access: public 
	* @param: attachment_array 
	* @return: array 
	*/
	public function add_attachment($attachment_array) {
		foreach($attachment_array as $key => $file_info)
		{
			if(isset($file_info['file_path']) && $file_info['file_path'] != ''){
				if(isset($file_info['ui_file_name']) && $file_info['ui_file_name'] != '')
				{
					$this->email->AddAttachment($file_info['file_path'], $file_info['ui_file_name']);
				}
				else
				{
					$this->email->AddAttachment($file_info['file_path']);
				}
			}
		}
		return;
    }
}
/* End of file mod_mail.php */
/* Location: ./application/models/mod_mail.php */