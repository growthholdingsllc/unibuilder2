<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/** 
 * CI mail extends PHP Mailer
 * 
 * @package: Mail
 * @subpackage:  
 * @category: Core
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 13-03-2015 
*/
/** 
 * PHP Mailer library included for sending email
 * 
*/
require_once(APPPATH . "libraries/PHPMailer_5.2.4/class.phpmailer.php");
require_once(APPPATH . "libraries/PHPMailer_5.2.4/class.smtp.php");
class CI_Email extends PHPMailer {
	/**
	 * @property: $_host
	 * @access: private
	 */
    private $_host = "";
	/**
	 * @property: $_smtp_auth
	 * @access: private
	 */
    private $_smtp_auth = "";
	/**
	 * @property: $_username
	 * @access: private
	 */
    private $_username = "";
	/**
	 * @property: $_password
	 * @access: private
	 */
    private $_password = "";
	/**
	 * @constructor
	 * Initialize property / member values
	 */
    public function __construct()
	{
    }
	/** 
	* Send mail function
	* 
	* @method: send_mail 
	* @access: public 
	* @param:
	* @return: true / false 
	*/
    public function send_mail()
	{
        if (!$this->Send())
		{
            return FALSE;
        }
		else
		{
			return FALSE;
        }
    }
}
/* End of file Email.php */
/* Location: ./application/libraries/Email.php */