<?php 
/** 
 * Unibuilder Admin Dashboard Class
 * 
 * @package: Unibuilder Admin 
 * @subpackage: Unibuilder Admin
 * @category: Unibuilder Admin
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 21-05-2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Components extends UNI_Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
    {
		//Parent constructor
        parent::__construct();	
		$this->load->model(array('Mod_login','Mod_user','Mod_role'));
    }
	
	/** 
	* Login index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True
	* Access URL : YWRtaW4vZgxf1Fzagxf1JvYXJkL2luZgxf1V4
	*/
	
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/components/buttons'		
		);
		$this->template->view($data);
	}
}