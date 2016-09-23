<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_User'));
		// $this->load->library('phpmailer');
    }
	public function index($aa='', $cc='')
	{ 
		// echo '<pre>'; print_r($this->session->all_userdata());exit;
	// echo 'Current URL :  '.$decoded_url = $this->crypt->decrypt('agxf19tZS9pbmRleC8-');
	  //echo '<br>Current URL :  '.$decoded_url = $this->crypt->encrypt('roles/index/'); 
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/dashboard/dashboard',
       );
		$this->template->view($data);
	}
	public function newlead()
	{
		$data = array(
		'title'       => "UNIBUILDER",		
		'content'     => 'content/home/newlead',
        'page_id'     => 'Home',
		'drop_upload' => 'drop_upload',
        'date_all'	  => 'date_all',
        'boot_slider' => 'boot_slider'
      
		);
		$this->load->view('common/common-template',$data);
	}
	public function editlead()
	{
		$data = array(
		'title'       => "UNIBUILDER",		
		'content'     => 'content/home/editlead',
        'page_id'     => 'Home',
		'drop_upload' => 'drop_upload',
        'date_all'	  => 'date_all',
        'boot_slider' => 'boot_slider'
      
		);
		$this->load->view('common/common-template',$data);
	}
	public function general_activity()
	{
		$data = array(
		'title'       => "UNIBUILDER",		
		'content'     => 'content/home/general-activity',
        'page_id'     => 'Home',
        'ckeditor'    => 'ckeditor',
		'date_all'	  => 'date_all',
		'drop_upload' => 'drop_upload'       
		);
		$this->load->view('common/common-template',$data);
	}	
	public function testupload(){		
		$ds          = DIRECTORY_SEPARATOR;  //1
		$storeFolder = 'uploads';   //2		 
		if (!empty($_FILES)) {
			 
			$tempFile = $_FILES['file']['tmp_name'];          //3             
			  
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'unibuilder/assets/uploads/';  //4
			 
			$targetFile =  $targetPath. $_FILES['file']['name'];  //5
		 
			move_uploaded_file($tempFile,$targetFile); //6
			 
		}
	}
	public function deleteupload(){
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'unibuilder/assets/uploads/';  //4
			unlink($targetPath.$_GET['fid']);
			print_r("Successfully deleted.");
	}

	/*
	dasboard page according to account type 200 added by Sidharths on 06/05/2014

	*/
	public function owner_dashboard($aa='', $cc='')
	{ 
		
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/dashboard/owner_dashboard',
       );
		$this->template->view($data);
	}
	public function subcontractor_dashboard($aa='', $cc='')
	{ 

		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/dashboard/subcontractor_dashboard',
       );
		$this->template->view($data);
	}
}