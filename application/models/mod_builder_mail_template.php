<?php
/** 
 * Builder Mail Template Class
 * 
 * @package: Mail Template 
 * @subpackage: Builder Mail Template 
 * @category: EMail
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 13-03-2015 
*/
/** 
 * PHP Mailer library included for sending email
 * 
*/
require_once(APPPATH . "models/mod_master_mail_template.php");
class Mod_builder_mail_template extends Mod_master_mail_template {
	/**
	 * @constructor
	 */
    public function __construct()
	{
		parent::__construct();		
    }
	/** 
	* Get Builder Mail Template
	* 
	* @method: get_builder_mail_template 
	* @access: public 
	* @param: template name 
	* @return: array 
	*/
	/*public function get_builder_mail_template($tpl_name, $builder_id)
	{
		if('' == $tpl_name)
		{
			echo 'Template name is not defiled';exit;
		}
		else
		{
		    $this->read_db->select('*');
			$this->read_db->from(UB_BUILDER_MAIL_TEMPLATE);
			if($builder_id > 0)
			{
				$this->read_db->where(array('builder_id'=> $builder_id));
			}
			$this->read_db->where(array('name' => $tpl_name));
			$res = $this->read_db->get();
			$data = array();
			if($res->num_rows > 0)
				return $data = $res->row_array();
			else
				return $data;
		}
	}
	*/
	/** 
	* Get Builder Mail Template
	* 
	* @method: get_builder_mail_template 
	* @access: public 
	* @param: template name 
	* @return: array 
	*/
	
	public function get_builder_mail_template($args = array())
	{
		$this->read_db->select(isset($args['select_fields'])? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BUILDER_MAIL_TEMPLATE);	
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
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
		// echo $this->read_db->last_query();exit;
		return $data;
	}
	
	/** 
	* Add Builder Mail Template
	* 
	* @method: add_builder_mail_template 
	* @access: public 
	* @param: template name 
	* @return: array 
	* @created by: chandru 
	* @created on: 30-05-2015 
	*/
	public function add_builder_mail_template($post_array = array(),$user_id)
	{
		if(!empty($post_array))
		{
			$post_array['created_by'] = $user_id;
			$post_array['created_on'] = TODAY;
			$post_array['modified_by'] = $user_id;
			$post_array['modified_on'] = TODAY;
			if($this->write_db->insert(UB_BUILDER_MAIL_TEMPLATE, $post_array))
			{
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
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
}
/* End of file mod_builder_mail_template.php */
/* Location: ./application/models/mod_builder_mail_template.php */