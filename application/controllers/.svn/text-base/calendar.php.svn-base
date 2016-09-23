<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
    }
	public function index()
	{
		$data = array(
		'title'        		=> "UNIBUILDER",		
		'content'      		=> 'content/calendar/calendar',
        'page_id'      		=> 'calendar',
		'data_table'   		=>'data_table',		
		'all_calendar' 		=>'all_calendar',
		'gantt' 	   		=>'gantt',
		'calendar_listview' =>'calendar_listview',
		'calendar_baselineview' =>'calendar_baselineview',
		'calendar_workdays' =>'calendar_workdays',
		'calendar_phaselist' =>'calendar_phaselist',
		//'ckeditor' 	   =>'ckeditor'
				
		);
		$this->load->view('common/common-template',$data);
	}	
}