<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My404 extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
    }
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/error/error'
		);
		$this->template->view($data);
	}
}