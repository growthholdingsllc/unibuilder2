<?php
/** 
 * SMS Class
 * 
 * @package: SMS 
 * @subpackage:  
 * @category: SMS
 * @author: Chandru
 * @createdon(DD-MM-YYYY): 31-08-2015 
*/
/** 
 * PHP Twilio library included for sending sms
 * 
*/
class Mod_sms extends UNI_Model{
	/**
	 * @constructor
	 */
    public function __construct() {
		parent::__construct();	
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
	public function send_sms($tpl_name, $msg_array, $content_array = array())
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
		// echo '<pre>';print_r($mail_template_data);exit;
		if($mail_template_data['status'] == TRUE && !empty($mail_template_data['aaData'][0]['text_message']))
		{
			$message_content = $mail_template_data['aaData'][0]['text_message'];
			$subject = $mail_template_data['aaData'][0]['subject'];
		}
		else
		{
			$args = array(
					'select_fields' => array('*'),
					'where_clause' => array('name' => $tpl_name, 'builder_id' => 0)
				);
			$mail_template_data = $this->Mod_builder_mail_template->get_builder_mail_template($args);
			$message_content = $mail_template_data['aaData'][0]['text_message'];
			$subject = $mail_template_data['aaData'][0]['subject'];
		}
		// echo '<pre>';print_r($message_content);exit;
		if(empty($message_content))
		{
			$message_content = 'No message body';
		}
		// echo '<pre>';print_r($);exit;
		if(isset($msg_array['mobile_phone']) && !empty($msg_array['mobile_phone']))
		{
			$to_mobile_number = $msg_array['mobile_phone'];
			$to_mobile_number = '17029048582';
			// $to_mobile_number = '17713472744';   	
			// $from_mobile_number = '16613472744';
			$from_mobile_number = '17029048582';
			$message_content = $message_content;
			// echo '<pre>';print_r($message_content);exit;
			/* if($parse_data == 'Yes')
			{ */
				$content_array['TEMPLATE_BODY'] = $this->parser->parse_string($message_content, $content_array);
			/* }else{
				$content_array['TEMPLATE_BODY'] = '';
			} */
			// echo '<pre>';print_r($content_array['TEMPLATE_BODY']);exit;
			$msg_responce = $this->sending_sms($from_mobile_number,$to_mobile_number,$content_array['TEMPLATE_BODY']);
			if(isset($msg_responce->status))
			{
				/* $data = array();
				$data['status'] = TRUE;
				$data['message'] = "SMS Send succesfully"; */
				return TRUE;
				// echo 'Message status:'.$msg_responce->status;exit;
				/* Notification code */
				/* I need clarification for module_pk_id */
				/* $post_array_details = array(
						'builder_id' => isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0,
						'project_id' => isset($this->project_id)?$this->project_id:0,
						'module_name' => $module_name,
						'module_pk_id' => 0, 
						'from_user_id' => isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0,
						'to_user_id' => $msg_array['ub_user_id'],
						'type' => $tpl_name,
						'subject' => $subject,
						'message' => $message_content
						);
				$add_notification = $this->Mod_notification->add_notification($post_array_details); */
				// echo 'Message status:'.$msg_responce->status.' And inserted in notification table';exit;
			}else{
				// echo 'To mobile number was invalid';
			}
		}
	}
	
	/* Below function was created by chandru */
	public function sending_sms($from_mobile_number,$to_mobile_number,$message_content)
	{
		/* $sid and $token will differ based on from number */
		/* Below path will defined in config */
		require(APPPATH.'libraries/twilio/Services/Twilio.php');
		/* Chandru Test API credentials */
		/* $sid = "AC2401a5e49cd48b8fae1b2e545ed943da"; // Your Account SID from www.twilio.com/user/account
		$token = "07707f298647b677646473ee69cae302"; // Your Auth Token from www.twilio.com/user/account */
		/* Below $sid and $token number was given by Gopa modified by chandru */
		$sid = "AC99ed03fbfc8469764d4b8bb4aa25f375";
		$token = "c67dea1dcdc79dedbf9cb54caae96032";
		

		$client = new Services_Twilio($sid, $token);
		/* Three arguments are FROM number, TO number, Message content */
		$message = $client->account->messages->sendMessage(
					$from_mobile_number, // From a valid Twilio number
					$to_mobile_number, // Text this number
					$message_content
					);
					// echo '<pre>';print_r($message);exit;
		return $message;
	}
}
/* End of file mod_sms.php */
/* Location: ./application/models/mod_sms.php */