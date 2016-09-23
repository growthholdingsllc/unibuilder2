<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
	public $account_type;
	function __construct () {
		$this->account_type = 'UNI_ADMIN';
	}
	function view($data = array()) {
		switch($this->account_type){
			case 'BUILDER_ADMIN':{
				$data['header'] = 'common/builder_admin_header';
				$data['footer'] = 'common/builder_admin_footer';
				// $data['left_content'] = 'common/builder_admin_left_content';
				$data['left_collapse'] = 'common/builder_admin_left_collapse';
				$file = 'common/common-template.php';
				break;
			}
			case 'SUB_CONTRACTOR':{
				$data['header'] = 'common/sub_contractor_header';
				$data['footer'] = 'common/sub_contractor_footer';
				// $data['left_content'] = 'common/sub_contractor_left_content';
				$data['left_collapse'] = 'common/sub_constractor_left_collapse';
				$file = 'common/common-template.php';
				break;
			}
			case 'OWNER':{
				$data['header'] = 'common/owner_header';
				$data['footer'] = 'common/owner_footer';
				// $data['left_content'] = 'common/owner_left_content';
				$data['left_collapse'] = 'common/owner_left_collapse';
				$file = 'common/common-template.php';
				break;
			}
			case 'UNI_ADMIN':{
				$data['header'] = 'admin/common/owner_header';
				$data['footer'] = 'admin/common/owner_footer';
				$file = 'admin/common/common-template.php';
				break;
			}
		}
		$this->CI =& get_instance();
		$this->CI->load->view($file,$data);
	}
}

?>