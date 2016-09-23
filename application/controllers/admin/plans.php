<?php 
/** 
 * Unibuilder Admin Dashboard Class
 * 
 * @package: Unibuilder Admin 
 * @subpackage: Unibuilder Admin
 * @category: Unibuilder Admin
 * @author: UI Developer
 * @createdon(DD-MM-YYYY): 05-06-2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Plans extends UNI_Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
    {
		//Parent constructor
        parent::__construct();	
		$this->load->model(array('Mod_login','Mod_user','Mod_role','Mod_plan'));
    }
	
	/** 
	* Builder index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True
	* Access URL : YWRtaW4vcgxf1xhbi9pbmRleA--
	*/
	
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/plan/view'		
		);
		$this->template->view($data);
	}
	/** 
	* Admin Plan ListPage
	* 
	* @method: get_warranty 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* url encoded : 
	*/
	public function get_admin_plan()
	{
    if(!empty($this->input->post()))
		{
		
				
			/* 	$post_array[] = array(
									'field_name' => 'PLAN.builder_id',
									'value'=> $this->user_session['builder_id'], 
									'type' => '='
									); */
			$order_by_where = '';
			$pagination_array = array();
			$total_count_array =  array();						
            // Sanitize input
			$result = $this->sanitize_input();
			 // echo "<pre>";print_r($result);exit;
			if(TRUE === $result['status'])
			{
				
				// Where clause argument
				// $where_str = $this->Mod_plan->build_where($post_array);
				// Pagination argument
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PLAN.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
				$order_by_where = 'PLAN.modified_on DESC';
				}
                // Fetch argument building
                $plan_args = array('select_fields' => array(
												'PLAN.ub_plan_id','PLAN.plan_name','PLAN.plan_amount'),
												'order_clause' => $order_by_where,
												'pagination' => $pagination_array); 

				// The following parameters required for data table
				 $result_data = $this->Mod_plan->get_plan_details($plan_args);
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_plan->get_plan_details(array(
												'select_fields' => array('COUNT(PLAN.ub_plan_id) AS total_count')
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_plan->response($result_data);
			}
			else
			{
				$this->Mod_plan->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_plan->response($result);
		}
	}
	
	/*
	 Access URL : YWRtaW4vcgxf1xhbnMvYWRkcgxf1xhbg--
	*/
	public function addplan()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/plan/addplan'		
		);
		$this->template->view($data);
	}
	/** 
	* Save meeting(Add or edit meeting)
	* 
	* @method: save_meeting 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :
	*/		
	public function save_plan($ub_plan_id = 0)
	{
	
		$this->encrypt_key = 'XYZ!@#$%';
		$data = array(
		'title'        => 'UNIBUILDER',		
		'content'      => 'admin/content/plan/addplan',
		'page_id'      => 'plans' 		
		);	
		//Codition check wheather the ub_mom_id value is greater than 0 or not
		
		     if($ub_plan_id > 0 || null!==$this->input->post('ub_plan_id') && $this->input->post('ub_plan_id') > 0)
		    {
					
				if(!empty($this->input->post()))
				{
				$result = $this->sanitize_input();
				if(isset($result['data']['group1']) && $result['data']['group1'] == -1)
				{
					$result['data']['no_of_projects'] = -1;
				}
				if(isset($result['data']['group2']) && $result['data']['group2'] == -1)
				{
					$result['data']['no_of_users'] = -1;
				}
				//echo '<pre>';print_r($result);exit;
				 $update_plan = array(
						'ub_plan_id' => $result['data']['ub_plan_id'],
						'plan_name' => $result['data']['plan_name'],
						'plan_amount' => $result['data']['plan_amount'],
						'no_of_projects' => $result['data']['no_of_projects'],
						'no_of_users' => $result['data']['no_of_users'],
						'modified_on' => TODAY,
						'modified_by' =>$this->user_id
						);
						//print_r($update_plan);	exit;
					// $ub_update_plan_response = $this->Mod_builder->update_plan($update_plan);		
		   	        $response = $this->Mod_plan->update_plan($update_plan );
					$this->Mod_plan->response($response);
				}
				else
			{
			
				
				$result_data = $this->Mod_plan->get_plan_details(array(
				'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_name','PLAN.plan_amount','PLAN.no_of_projects','PLAN.no_of_users'),
				'where_clause' => (array('ub_plan_id' =>  $ub_plan_id))));
				
				if(TRUE === $result_data['status'])
				{
					$data['plan_data']  = $result_data['aaData'][0];
				}
				// print_r($data['plan_data']);	exit;
			 
            }				
		}
		//echo "hi";
		else
		{
			if(!empty($this->input->post()))
			{
				// Insert meeting
				$result = $this->sanitize_input();
				// print_r($result);
				if(isset($result['data']['group1']) && $result['data']['group1'] == '-1')
				{
				  $result['data']['no_of_projects'] = -1;
				}
				if(isset($result['data']['group2']) && $result['data']['group2'] == '-1')
				{
				  $result['data']['no_of_users'] = -1;
				}
				if(TRUE == $result['status'])
				{	
					$insert_plan = array(
					'ub_plan_id' => $result['data']['ub_plan_id'],
					'plan_name' => $result['data']['plan_name'],
					'plan_amount' => $result['data']['plan_amount'],
					'no_of_projects' => $result['data']['no_of_projects'],
					'no_of_users' => $result['data']['no_of_users'],
					'created_on' =>TODAY,
					'modified_on'=>TODAY,
					'created_by' =>$this->user_id
					);
					$response = $this->Mod_plan->add_plan($insert_plan);
					$this->Mod_plan->response($response);
				}
				else
				{
					 $this->Mod_plan->response($result);
				}
				
			}
	    }
		
		$this->template->view($data);
	}
	/** 
	* Delete plans
	* 
	* @method: delete_plans 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :
	*/
	 public function delete_plans()
	{
	  if(!empty($this->input->post()))
		{
		// Sanitize input
		$result = $this->sanitize_input();
		// echo '<pre>';print_r($result);
	
			if(TRUE === $result['status'])
			{
					// Delete functionality
					$response = $this->Mod_plan->delete_plan($result['data']);
			}
			else
			{
				$this->Mod_plan->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		// Response data
		$this->Mod_plan->response($response);
	}
	
	/** 
	* Delete plans
	* 
	* @method: delete_user_plan
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: 
	*/
	public function delete_user_plan()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_plan->delete_plans($result['data']);
			}
			else
			{
				$this->Mod_plan->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_plan->response($response);
	}
}