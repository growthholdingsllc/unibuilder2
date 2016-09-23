<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
	public $account_type;
	function __construct () {
		$this->CI =& get_instance();
		$this->CI->load->library(array('session'));
		$account_session_ary = $this->CI->session->userdata('ACCOUNT');
		$user_session_ary = $account_session_ary[$this->CI->session->userdata('ACCOUNT_TYPE')]['USER'];
		$template_session_ary = isset($account_session_ary[$this->CI->session->userdata('ACCOUNT_TYPE')]['TEMPLATE'])?$account_session_ary[$this->CI->session->userdata('ACCOUNT_TYPE')]['TEMPLATE']:array();
		$this->account_type = $user_session_ary['account_type'];
		$this->swith_template_name = (isset($template_session_ary['VIEW_NAME']['display_type']) && $template_session_ary['VIEW_NAME']['display_type'] != '')?$template_session_ary['VIEW_NAME']['display_type']:'';
	}
	function view($data = array()) {
		switch($this->account_type){
			case '100':{
				// Builder Admin
				if($this->swith_template_name == 'template_view')
				{
					// Template View
					$data['header'] = 'template/common/builder_admin_header';
					$data['footer'] = 'template/common/builder_admin_footer';
					// $data['left_content'] = 'common/builder_admin_left_content';
					$data['left_collapse'] = 'template/common/builder_admin_left_collapse';
					$file = 'template/common/common-template';

				}
				else
				{
					// Builder Dashbaord View
					$data['header'] = 'common/builder_admin_header';
					$data['footer'] = 'common/builder_admin_footer';
					// $data['left_content'] = 'common/builder_admin_left_content';
					$data['left_collapse'] = 'common/builder_admin_left_collapse';
					$file = 'common/common-template';
				}
				break;
			}
			case '300':
			case '400':
			{
				// Sub contractor / Sub user
				$data['header'] = 'common/sub_contractor_header';
				$data['footer'] = 'common/sub_contractor_footer';
				// $data['left_content'] = 'common/sub_contractor_left_content';
				$data['left_collapse'] = 'common/sub_contractor_left_collapse';
				$file = 'common/common-template';
				break;
			}
			case '200':{
				// Owner
				$data['header'] = 'common/owner_header';
				$data['footer'] = 'common/owner_footer';
				// $data['left_content'] = 'common/owner_left_content';
				$data['left_collapse'] = 'common/owner_left_collapse';
				$file = 'common/common-template';
				break;
			}
			case '500':{
				// Uniadmin
				$data['header'] = 'admin/common/admin_header';
				$data['footer'] = 'admin/common/admin_footer';
				$file = 'admin/common/common-template';
				break;
			}
			default:
				// If account type is not assigned then it will redirect to login page
				redirect(base_url().'bgxf19naW4vaW5kZXgv');
		}
		$this->CI =& get_instance();
		$this->CI->load->view($file,$data);
	}
}

?>