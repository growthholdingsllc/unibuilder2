<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Todo extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
    }
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/todo/todo',
        'page_id'      => 'todo',
		'data_table'   =>'data_table',
		'todo_list'	   =>'todo_list',      
		'date_all'	   =>'date_all'      
		);
		$this->load->view('common/common-template',$data);
	}	
	public function newtodo()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/todo/newtodo',
        'page_id'      => 'todo',
		'date_all'	   =>'date_all'      
		);
		$this->load->view('common/common-template',$data);
	}	
}