<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thumbnail extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();		
    }
	public function index()
	{ 	
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'common/image_upload_demo_submit',
       );
		$this->template->view($data);
	}
	
}