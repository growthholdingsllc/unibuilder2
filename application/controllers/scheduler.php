<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Scheduler Class
 * 
 * @package: Scheduler
 * @subpackage: Scheduler
 * @category: Scheduler
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 25-06-2015 
*/
class Scheduler extends UNI_Controller {
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_reminder','Mod_task','Mod_notification'));
    }
	/** 
	* Execute schedule
	* 
	* @method: scheduler_execute 
	* @access: public 
	* @param:  
	* @return: array 
	* @url : c2NoZWR1bgxf1VyL3Njagxf1VkdWxlcl9legxf1VjdXRlLw--
	*/
	public function scheduler_execute()
	{
		$this->Mod_reminder->scheduler_execute();
	}	
}