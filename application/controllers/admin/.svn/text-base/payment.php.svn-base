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
class Payment extends UNI_Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
    {
		//Parent constructor
        parent::__construct();	
		$this->load->model(array('Mod_login','Mod_user','Mod_role','Mod_payment','Mod_plan'));
    }
	
	/** 
	* Builder index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True
	* Access URL : YWRtaW4vcgxf1F5bWVudC9pbmRleA--
	*/
	
	public function index()
	{
	 //echo $this->crypt->encrypt('admin/payment/get_payment_list');
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/payment/view',
        'search_session_array' => $this->uni_session_get('SEARCH'),		
		);
		$plan_array = $this->Mod_plan->get_plan_details(array(
							'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_name'),
							'where_clause' => array('PLAN.show_in_registration' => 'Yes')
							 ));
							
        $data['plan'] = array();
		
        if(TRUE === $plan_array['status'])
		{
			$data['plan'] = $this->Mod_payment->build_ci_dropdown_array($plan_array['aaData'],'ub_plan_id', 'plan_name');
		}
		/* Status code */
        $status_dropdown[] = array('id' => 'Success','val' => 'Success');
        $status_dropdown[] = array('id' => 'Failed','val' => 'Failed');
        $data['status_dropdown_list'] = $this->Mod_payment->build_ci_dropdown_array($status_dropdown,'id', 'val'); 
		$this->template->view($data);
	}
	// URL:- YWRtaW4vcgxf1F5bWVudC9nZXRfcgxf1F5bWVudF9saXN0 
	public function get_payment_list()
	{
		  if(!empty($this->input->post()))
		{
		
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
				$search_session_array = array();
				/* Search plan code */
				$post_array = array();
				if(isset($result['data']['plan_id']) && $result['data']['plan_id']!='' && $result['data']['plan_id'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'PAYMENT_DETAILS.plan_id',
								'value'=> $result['data']['plan_id'], 
								'type' => '='
							);
					//Modified session code
					 $search_session_array['plan_id'] = $result['data']['plan_id'];
				}
				/* Search status code */
				if(isset($result['data']['status_id']) && $result['data']['status_id']!='' && $result['data']['status_id'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'PAYMENT_DETAILS.payment_status',
								'value'=> $result['data']['status_id'], 
								'type' => '='
							);
					//Modified session code
					 $search_session_array['status_id'] = $result['data']['status_id'];
				}
				/* Search membership number */
				if(isset($result['data']['membership_number']) && $result['data']['membership_number']!='' && $result['data']['membership_number'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'BUILDER_DETAILS.membership_number',
								'value'=> $result['data']['membership_number'], 
								'type' => '='
							);
					//Modified session code
					 $search_session_array['membership_number'] = $result['data']['membership_number'];
				}
				/* Search company name code */
				if(isset($result['data']['builder_name']) && $result['data']['builder_name']!='' && $result['data']['builder_name'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'BUILDER_DETAILS.builder_name',
								'value'=> $result['data']['builder_name'], 
								'type' => '='
							);
					//Modified session code
					 $search_session_array['builder_name'] = $result['data']['builder_name'];
				}
				/* using this if block for builder payments list page //  by satheesh kumar*/
				if(isset($result['data']['builder_id']) && $result['data']['builder_id']!='' && $result['data']['builder_id'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'PAYMENT_DETAILS.builder_id',
								'value'=> $result['data']['builder_id'], 
								'type' => '='
							);
				}
				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = $result['data']['iDisplayStart'];
				$search_session_array['iDisplayLength'] = $result['data']['iDisplayLength'];
				
				$this->uni_set_session('search', $search_session_array);
				$where_str = $this->Mod_payment->build_where($post_array);
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >=  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					/* $order_by_where = 'PAYMENT_DETAILS.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type; */
					// Get formatted sort name
					 $format_sort_name = $this->Mod_payment->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'BUILDER_DETAILS.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					} 
				}
				else
				{
					$order_by_where = 'BUILDER_DETAILS.modified_on DESC';
				}
				
			    if(is_array($where_str))
				{
				$where_str = '' ;
				}
                // Fetch argument building
		        $date_array = array('PAYMENT_DETAILS.payment_date'=>'payment_date');
		        $billing_date_array = array('PAYMENT_DETAILS.payment_date + INTERVAL '.PAYMENT_DURATION.' DAY'=>'billing_date');
               $result_data = $this->Mod_payment->get_payment_details(array(
							            'select_fields' => array(
										'IF(INVOICE_DETAILS.ub_invoice_id > 0, INVOICE_DETAILS.ub_invoice_id, 0) AS ub_invoice_id ','PAYMENT_DETAILS.builder_id',
										'PAYMENT_DETAILS.ub_payment_id','PAYMENT_DETAILS.plan_id','PAYMENT_DETAILS.amount,'.$this->Mod_user->format_user_datetime($date_array,"date").
										',PAYMENT_DETAILS.payment_status',
										'PAYMENT_DETAILS.payment_type',
										'IF(PAYMENT_DETAILS.reference_id > 0 ,PAYMENT_DETAILS.reference_id ,0 ) AS reference_id',
										'PAYMENT_DETAILS.result_text', 
										'PLAN.plan_name',
										'BUILDER_DETAILS.builder_name',
                                        'BUILDER_DETAILS.membership_number,'.$this->Mod_user->format_user_datetime($billing_date_array,"date")),
										'join'=> array('plan'=>'yes','builder'=>'yes','invoice'=>'yes'),
										'where_clause' => $where_str,
										'order_clause' => $order_by_where,
										'pagination' => $pagination_array
										));			
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_payment->get_payment_details(array(
												'select_fields' => array('COUNT(PAYMENT_DETAILS.ub_payment_id) AS total_count'),'join'=> array('plan'=>'yes','builder'=>'yes'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_user->response($result_data);
			}
			else
			{
				$this->Mod_user->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_user->response($result);
		}
	}
		/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: pranab
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_payment->destroy_session($result['data']);
			}
			$this->Mod_payment->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
}