<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Changepassword extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
    }
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/changepassword/changepassword',
		'page_id'      => 'changepassword'
		);
		$this->template->view($data);
	}
}