<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payapp extends UNI_Controller {
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();
		 $this->load->model(array('Mod_budget'));
		
    }

    /** 
	* Get Owner payapp details
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'content/budget/payapp',
		'page_id'      => 'payapp'
		);
		$this->template->view($data);
	}
	public function get_payapp()
	{
		if(!empty($this->input->post()))
		{
			$where_str = '';
			// Sanitize input
			$result = $this->sanitize_input();
			//echo '<pre>';print_r($result);
			if(TRUE === $result['status'])
			{
				// Getting data of a particular builder
				$post_array[] = array(
									'field_name' => 'PAYAPP.builder_id',
									'value'=> $this->builder_id, 
									'type' => '='
									);
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				// period_to search input
				if(isset($result['data']['period_to']) && $result['data']['period_to']!='')
				{
					$due_time = $results['data']['period_to'];
					$period_to = date('H:i:s', strtotime($due_time));
					$post_array[] = array(
										'field_name' => 'PAYAPP.period_to',
										'value'=> $period_to, 
										'type' => '='
										);
					$search_session_array['period_to'] = $result['data']['period_to'];
				}
				// pay_app_name search input
				if(isset($result['data']['pay_app_name']) && $result['data']['pay_app_name']!='' && $result['data']['pay_app_name']!='Nothing selected' && $result['data']['pay_app_name']!='null')
				{
					$post_array[] = array(
										'field_name' => 'PAYAPP.pay_app_name',
										'value'=> $result['data']['pay_app_name'], 
										'type' => '='
										);
					$search_session_array['pay_app_name'] = $result['data']['pay_app_name'];
				}
				// Setting session 
				$this->uni_set_session('pay_app_search', $search_session_array);
				// Where clause argument
				$where_str = $this->Mod_budget->build_where($post_array);
				//echo '<pre>';print_r($where_str);exit;
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
					$order_by_where = 'PAYAPP.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
                // Fetch argument building
                $pay_app_args = array('select_fields' => array('PAYAPP.payapp_number','PAYAPP.name','PAYAPP.period_to','PAYAPP.status'),
                'join'=> array('builder'=>'Yes'),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					//Only for export
					unset($pay_app_args['pagination']);
				}
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$result_data = $this->Mod_budget->get_payapp($pay_app_args);
				// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('payapp_number','name','period_to','status');
					
					// Export file header column 
					$export_array['header'][0] = array('Payapp Number','Name','Period to','Status'); 

					foreach($result_data['aaData'] as $fields)
					{
						$line = array();
						foreach($fields as $key => $item)
						{
							if (in_array($key, $field_list_array))
							{
								$ab = array_search($key,$field_list_array);
								$line[$ab] = $item;					
							}
						}
						if(ksort($line))
						{
							$export_array['value'][] = $line;	
						}	
					}
					echo array_to_export($export_array,'uni_Payapp_list.xls','csv');exit;
				}
				// The following parameters required for data table
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_budget->get_payapp(array(
												'select_fields' => array('COUNT(PAYAPP.payapp_number) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_budget->response($result_data);
			}
			else
			{
				$this->Mod_budget->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_budget->response($result);
		}
	}

  
}