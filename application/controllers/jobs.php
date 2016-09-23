<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
    }
	public function index($bb='')
	{
	echo 'bbbbbbbbbbbbb';$bb;exit;
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/jobs/job_list',
        'page_id'      => 'jobs',
		'data_table'   =>'data_table',
		'joblist'	   =>'job_list',
        'map'		   =>'map'
		);
		$this->load->view('common/common-template',$data);
	}
	public function jobsdetails()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/jobs/jobsdetails',
        'page_id'      => 'jobs',
        'date_all'      => 'date_all'
        
		);
		$this->load->view('common/common-template',$data);
	}
	public function newjobtemplate()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/jobs/newjobtemplate',
        'page_id'      => 'jobs',
        'date_all'      => 'date_all'
        
		);
		$this->load->view('common/common-template',$data);
	}
	public function editjob()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/jobs/editjob',
        'page_id'      => 'jobs',
        'date_all'      => 'date_all'
        
		);
		$this->load->view('common/common-template',$data);
	}	
}