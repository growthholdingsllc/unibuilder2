<?php
/** 
 * Master Mail Template Class
 * 
 * @package: Mail Template 
 * @subpackage: Builder Mail Template 
 * @category: EMail
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 12-03-2015 
*/
class Mod_master_mail_template extends UNI_Model{
	/**
	 * @constructor
	 */
    public function __construct()
	{	
		//.....
		parent::__construct();
		$this->load->library('email');		
    }
	/** 
	* Get Master Mail Template
	* 
	* @method: get_master_mail_template 
	* @access: public 
	* @param: template name 
	* @return: array 
	*/
	public function get_master_mail_template($tpl_name)
	{
		if('' == $tpl_name)
		{
			echo 'Template name is not defiled';exit;
		}
		else
		{
			$this->read_db->select('*');
			$this->read_db->from(UB_MASTER_MAIL_TEMPLATE);
			$this->read_db->where(array('name' => $tpl_name));
			$res = $this->read_db->get();
			$data = array();
			if($res->num_rows > 0)
				return $data = $res->row_array();
			else
				return $data;
		}
	}
}
/* End of file mod_master_mail_template.php */
/* Location: ./application/models/mod_master_mail_template.php */