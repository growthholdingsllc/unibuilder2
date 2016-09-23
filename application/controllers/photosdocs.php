<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photosdocs extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
    }
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/photosdocs/photosdocs',
        'page_id'      => 'photos_docs',
		'data_table'   => 'data_table',
		'photos_docs_list'	   => 'photos_docs_list',      
		'date_all'	   => 'date_all'      
		);
		$this->load->view('common/common-template',$data);
	}
	public function newalbums()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/photosdocs/newalbums',
        'page_id'      => 'photos_docs',		     
		);
		$this->load->view('common/common-template',$data);
	}
	public function newfolder()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/photosdocs/newfolder',
		'page_id'      => 'photos_docs'
		);
		$this->load->view('common/common-template',$data);
	}
}