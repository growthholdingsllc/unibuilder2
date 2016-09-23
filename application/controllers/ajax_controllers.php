<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_Controllers extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');		
    }
	public function index()
	{
		
	}
	public function list_view()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/home/jsonlistview.php');
		echo $jsonData;		
		
	}
	public function activity_view()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/home/jsonactivityview.php');
		echo $jsonData;		
		
	}
	public function jobs_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/jobs/jsonjobslist.php');
		echo $jsonData;		
		
	}
	public function logs_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/logs/jsonlogslist.php');
		echo $jsonData;
		
	}
	public function todo_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/todo/jsontodolist.php');
		echo $jsonData;		
		
	}
	public function bids_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/bids/jsonbidslistview.php');
		echo $jsonData;		
		
	}
	public function budget_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/budget/jsonbudgetlist.php');
		echo $jsonData;		
		
	}
	public function pos_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/budget/jsonposlist.php');
		echo $jsonData;		
		
	}
	public function payment_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/budget/jsonpaymentlist.php');
		echo $jsonData;		
		
	}
	public function warranty_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/warranty/jsonwarrantylist.php');
		echo $jsonData;		
		
	}
	
	public function docs_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/docs/jsondocslist.php');
		echo $jsonData;		
		
	}
	public function change_orderlist()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/docs/jsonchangeorderlist.php');
		echo $jsonData;		
		
	}
	public function  Photos_Docs_List()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/photosdocs/jsonphotosdocslist.php');
		echo $jsonData;		
		
	}
	public function internal_users()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/user/jsoninternalusers.php');
		echo $jsonData;		
		
	}
	public function sub_vendors()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/user/jsonsubvendors.php');
		echo $jsonData;		
		
	}
	public function selection_list()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/selections/jsonselectionlist.php');
		echo $jsonData;		
		
	}
	public function selection_category()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/selections/jsonselectioncategory.php');
		echo $jsonData;		
		
	}
	public function location_selections()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/selections/jsonlocationselections.php');
		echo $jsonData;		
		
	}	
	public function message_notfication()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/message/jsonmessagenotfication.php');
		echo $jsonData;		
		
	}
	public function gantt()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/calendar/jsongantt.php');
		echo $jsonData;		
		
	}
	public function calendar_listview()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/calendar/jsoncalendarlistview.php');
		echo $jsonData;		
		
	}
	public function calendar_baselineview()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/calendar/jsoncalendarbaselineview.php');
		echo $jsonData;		
		
	}
	public function calendar_workdays()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/calendar/jsoncalendarworkdays.php');
		echo $jsonData;		
		
	}
	public function calendar_phaselist()
	{
		$jsonData = file_get_contents(APPPATH.'views/common/calendar/jsoncalendarphaselist.php');
		echo $jsonData;		
		
	}
	
}