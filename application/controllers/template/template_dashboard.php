<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Dashboard Class
 * 
 * @package: Dashboard
 * @subpackage: Dashboard
 * @category: Dashboard
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 27-07-2015 
*/
class template_dashboard extends UNI_Controller {
	/**
	 * @constructor
	 */
	public $display_length = 0;
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_template'));
    }
	/** 
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/
	public function index()
	{	
		$data = array(
						'title'        => "UNIBUILDER",		
						'content'      => 'template/content/dashboard/dashboard',
						'page_id'      => 'dashboard'
						);
		$this->template->view($data);
	}
	
	/** 
	* set template details in session
	* 
	* @method: set_template_details_in_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 09/05/2015 
	*/	
	public function set_template_details_in_session()
	{	
		$result = $this->sanitize_input();
		if(TRUE === $result['status'])
		{
			
			$this->module = 'COMMON_TEMPLATE';			
			$response = $this->set_template_info_in_session($result['data']);		
			//$response['redirect_url'] = base_url().$this->crypt->encrypt('builder_dashboard/index/');
			$response['redirect_url'] = $result['data']['redirect_url'];
			$this->Mod_template->response($response);
		}	
	}
}