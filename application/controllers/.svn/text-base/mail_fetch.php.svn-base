<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Mail FetchClass
 * 
 * @package: MailFetch
 * @subpackage: MailFetch
 * @category: MailFetch
 * @author: Baskar
 * @createdon(DD-MM-YYYY): 24-04-2015 
*/
class Mail_fetch extends UNI_Controller {
	/**
	 * @property: $module
	 * @access: public
	 */
	public $module = '';
	/**
	 * @constructor
	 */
	public function __construct()
  { 
		parent::__construct();
		$this->load->model(array('Mod_message','Mod_general_value','Mod_timezone'));
		$this->module = 'mail_fetch';
  }
	
	/** 
	* Process the mail and update the same in the database
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url : bWFpbF9mZXRjaC9pbmRleA--
	*/
	public function index()
	{	
		/* Read the message from STDIN */
		if(php_sapi_name() == 'cli')
		{
			$fd = fopen("php://stdin", "r");
			$email = ""; // This will be the variable holding the data.
			while (!feof($fd)) {
				$email .= fread($fd, 1024);
			}  
			fclose($fd);

			$today = explode('-',CURRENT_DATE);
			$full_dir_path = DOC_PATH."fetch_mail/notprocessed/".$today[0]."/".$today[1]."/".$today[2]."/";
			$processed_dir_path = DOC_PATH."fetch_mail/processed/".$today[0]."/".$today[1]."/".$today[2]."/";

			/* Check if dir exists or create new one */
			if(!is_dir($full_dir_path))
			{
				mkdir($full_dir_path, 0777, true);
			}
			
			/* checking if file exists with same name */
			do {
				$file_name = mt_rand().".eml";
			} while(file_exists($full_dir_path.$file_name));
			
			/* Saves the data into a file */
			$fdw = fopen($full_dir_path.$file_name, "w+");
			fwrite($fdw, $email);
			fclose($fdw);
			
			/* Calling method to process the email file */
			$file_path = DOC_PATH."fetch_mail/notprocessed/".$today[0]."/".$today[1]."/".$today[2]."/".$file_name;
			$file_to_process = "notprocessed/".$today[0]."/".$today[1]."/".$today[2]."/".$file_name;
			$file_details = array('file_name' => $file_to_process);
			$this->Mod_message->save_msg_to_db = TRUE;
			$res = $this->Mod_message->process_email($file_details);
			
			/* Check if file is processed successfully, if yes then move file to processed directory */
			if(TRUE === $res['status'])
			{
				if(!is_dir($processed_dir_path))
				{
					mkdir($processed_dir_path, 0777, true);
				}
				rename($file_path, $processed_dir_path.$file_name);
			}
		}
		/* Script End */
		// $this->Mod_message->save_msg_to_db = TRUE;
		// $res = $this->Mod_message->process_email($file_details = array());
		echo $this->Mod_message->directory;
		echo "encrypt : ". $this->crypt->encrypt('mail_fetch/index/');
		echo "<br>decrypt : ". $this->crypt->decrypt('bWFpbF9mZXRjaC9pbmRleC8-');
	}
	
	public function process()
	{	
		/* Calling method to process the email file */
		$file_details = array('file_name' => 'notprocessed/2015/08/17/1585262056txt');
		$this->Mod_message->save_msg_to_db = TRUE;
		$res = $this->Mod_message->process_email($file_details);
		
		echo $this->Mod_message->directory;
		echo "encrypt : ". $this->crypt->encrypt('mail_fetch/index/');
		echo "<br>decrypt : ". $this->crypt->decrypt('bWFpbF9mZXRjaC9pbmRleC8-');
	}
	public function test_alias($mail)
	{
		// echo $mail;exit;
		error_reporting(E_ALL);
		$file = fopen("/etc/aliases","a");
		echo fwrite($file,$mail.":        incomingmails\n");
		fclose($file);
		// exec('service postfix restart', $output);
		exec('sudo /etc/init.d/postfix restart', $output);
		echo '<pre>';print_r($output);exit;
	}
	public function shell()
	{
		$output = shell_exec('/var/www/ub_documents/fetch_mail/fetch_shell.sh');
		echo "<pre>$output</pre>";
	}
}