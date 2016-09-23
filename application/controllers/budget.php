<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Budget Class
 * 
 * @package: Budget
 * @subpackage: Budget
 * @category: Budget
 * @author: Gayathri, Sidhartha, Gopakumar, MS, Thiyagu
 * @createdon(DD-MM-YYYY): 29-03-2015 
*/
class Budget extends UNI_Controller {
	public function __construct()
    {
        parent::__construct();
		

        $this->load->model(array('Mod_budget','Mod_general_value','Mod_timezone','Mod_user','Mod_subcontractor','Mod_saved_search','Mod_project','Mod_po_co','Mod_bid','Mod_cost_code','Mod_builder','Mod_doc','Mod_notification','Mod_reminder','Mod_message','Mod_template'));
        $this->load->helper('export');		
	}
	/** 
	* Index
	* 
	*/
	public function index()
	{
		
	}
	/** 
	* Budget Summary List page
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: YnVkZ2V0L2J1Zgxf1dldF9zdW1tYXJ5
	*/	
	public function budget_summary()
	{
		$data = array(
		'title'        			=> "UNIBUILDER",		
		'content'     			=> 'content/budget/budget_summary',
        'page_id'      			=> 'budget',
		'data_table'   			=> 'data_table',
		'budget_project_list'  	=> 'budget_project_list'     
		);
		$this->template->view($data);
	}
	/** 
	* Get Project Budget
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function project_budget($type='', $cost_code_id=0,$page='')
	{
		//echo $type.' - '.$cost_code_id;exit;
		$data = array(
		'title'        						=> "UNIBUILDER",		
		'content'     						=> 'content/budget/project_budget',
        'page_id'      						=> 'budget',
		'data_table'   						=> 'data_table',
		'budget_summary_list'  				=> 'budget_summary_list',     
		'budget_jobs_list'  				=> 'budget_jobs_list',     
		'budget_pay_app_list'  				=> 'budget_pay_app_list',     
		'budget_po_list'  					=> 'budget_po_list',     
		'budget_co_list'  					=> 'budget_co_list',     
		'budget_pay_app_list_details'  		=> 'budget_pay_app_list_details',
		'cost_code_id'						=> $cost_code_id,
		'page'                              => $page
		);
		//apply filter payapp
		$this->module = 'BUDGET_PAYAPP';
		$data['payapp_search_session_array'] =  $this->uni_session_get('pay_app_search');
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['payapp_apply_filter'] = true;
		}
		else
		{
			$data['payapp_apply_filter'] = false;;
		}

		//session data of jobs
		$this->module = 'BUDGET_JOBS';
		$data['jobs_search_session_array'] =  $this->uni_session_get('jobs_search');	
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['jobs_apply_filter'] = true;
		}
		else
		{
			$data['jobs_apply_filter'] = false;;
		}
		//	
		//apply filter po
		$this->module = 'BUDGET_PO';
		$data['po_search_session_array'] =  $this->uni_session_get('po_search');	
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['po_apply_filter'] = true;
		}
		else
		{
			$data['po_apply_filter'] = false;;
		}	
		//apply filter co
		$this->module = 'BUDGET_CO';
		$data['co_search_session_array'] = $this->uni_session_get('co_search');		
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['co_apply_filter'] = true;
		}
		else
		{
			$data['co_apply_filter'] = false;;
		}
		//apply filter owner co
		$this->module = 'BUDGET_OWNER_CO';
		$data['owner_co_search_session_array'] = $this->uni_session_get('owner_co_search');		
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['owner_co_apply_filter'] = true;
		}
		else
		{
			$data['owner_co_apply_filter'] = false;;
		}
		//apply filter owner po
		$this->module = 'BUDGET_OWNER_PO';
		$data['owner_po_search_session_array'] = $this->uni_session_get('owner_po_search');		
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['owner_po_apply_filter'] = true;
		}
		else
		{
			$data['owner_po_apply_filter'] = false;;
		}
		
		// Get cost codes to list in add estimate form
		$args['where_clause'] = "(builder_id = ".$this->builder_id." || builder_id = 0 ) AND status = 'Active'";
		$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');
		$cost_code_options = $this->Mod_budget->get_db_options(UB_COST_CODE, $args);
		$data['cost_code_options'] = $cost_code_options;
		
		// Get estimate list for specific builder and project
		if(!empty($this->project_id))
		{
		$esti_args['where_clause'] = "builder_id = ".$this->builder_id." AND project_id = ".$this->project_id."";
		$esti_args['select_fields'] = array('cost_code_id','cost_code_name');
		$proj_estimate_list = $this->Mod_budget->get_db_options(UB_ESTIMATE, $esti_args);
		$data['proj_estimate_list'] = $proj_estimate_list;
		}
		
		// Get cost codes category
		$category_args['where_clause'] = "(builder_id = ".$this->builder_id." || builder_id = 0 ) AND status = 'Active'";
		$category_args['select_fields'] = array('ub_cost_code_category_id','category');
		$category_options = $this->Mod_budget->get_db_options(UB_COST_CODE_CATEGORY, $category_args);
		$data['category_options'] = $category_options;
		 // echo "<pre>".implode(", ",array_keys($data['proj_estimate_list']));;//print_r($data['proj_estimate_list']);exit;
		
		//Get builder po_co status from general value table
		$args = array('classification'=>'po_co_status', 'type'=>'dropdown');
		$status_result = $this->Mod_general_value->get_general_value($args);
		$data['status_result']=$status_result['values'];
		//Get builder po_co_payment status from general value table
		$args = array('classification'=>'po_co_payment_status', 'type'=>'dropdown');
		$payment_result = $this->Mod_general_value->get_general_value($args);
		$data['payment_result']=$payment_result['values'];
		//Get builder owner_co status from general value table
		$args = array('classification'=>'client_po_co_status', 'type'=>'dropdown');
		$co_status_result = $this->Mod_general_value->get_general_value($args);
		$data['co_status_result']=$co_status_result['values'];
	 // echo '<pre>';print_r($data['co_status_result']);exit;
		 //Apply filter code
		/* $post_array = array('builder_id' => $this->user_session['builder_id'],
							 'user_id' => $this->user_session['ub_user_id'],
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$apply_filter = true;
		}
		else
		{
		$apply_filter = false;;
		}	
		$data['apply_filter'] = $apply_filter; */
		//template drop down
	    $template_list = $this->Mod_template->get_template(array(
					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),
					'where_clause' => (array('TEMPLATE.builder_id' => $this->user_session['builder_id']))
					));
	    if( $template_list['status'] == TRUE){
			
			//$data['template_list']= $template_list['aaData'];
			$data['template_list'] = $this->Mod_project->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name');
	   	}
		
		//All project summary
		$headers = $this->user_role_access[strtolower('budget')];
		$all_proj_summary_role = array(strtolower('Project Name') => array('data' => 'project_name'),
					  strtolower('Budgeted Amount') => array('data' => 'total_amount'),
					  strtolower('Estimated Revenue') => array('data' => 'total_contract_price'),
					  strtolower('(+/-) Budget') => array('data' => 'total_plus_minus_budget'),
					  strtolower('Total Vendor Cost') => array('data' => 'total_revised_contract'),
					  strtolower('Overhead / Inhouse') => array('data' => 'total_overhead_cost'),
					  strtolower('Estimated Profit') => array('data' => 'total_estimated_profit_amount'),
					  strtolower('Billed To Client to Date') => array('data' => 'total_bill_to_client_to_date'),
					  strtolower('Balance TO Bill To Client') => array('data' => 'total_balance_to_bill_client'),
					  strtolower('Paid By Client to Date') => array('data' => 'total_paid_by_client_to_date'),
					  strtolower('Unpaid Client Billings') => array('data' => 'total_unpaid_client_billing'),
					  strtolower('Invoiced by Sub to Date') => array('data' => 'total_invoiced_by_sub_to_date'),
					  strtolower('Amount Paid To Sub') => array('data' => 'total_amount_paid_to_sub'),
					  strtolower('Balance to be Invoiced By Sub') => array('data' => 'total_balance_to_be_invoiced_by_sub'),
					  strtolower('Total Balance Owed To Sub') => array('data' => 'balance_owed_to_sub'),
					  strtolower('Total Cost') => array('data' => 'cost'),
					  strtolower('Profit To Date') => array('data' => 'total_profit_to_date'),
					  strtolower('Overall Profit') => array('data' => 'total_overall_profit'),
					  strtolower('Profit %') => array('data' => 'profit')
					  );				
		$data['datatable_headers'][0] = 'Project Name';
		$data['datatable_column'][0] = $all_proj_summary_role[strtolower('Project Name')];
		$data['datatable_headers'][1] = 'Budgeted Amount';
		$data['datatable_column'][1] = $all_proj_summary_role[strtolower('Budgeted Amount')];
		$i=2;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($all_proj_summary_role[$key]))
				{
					$data['datatable_headers'][$i] = $key;
					$data['datatable_column'][$i] = $all_proj_summary_role[$key];
					if($key == strtolower('Estimated Profit')){
						$data['total_estimated_profit_amount_index'] = $i;
					}else if($key == strtolower('(+/-) Budget')){
						$data['total_plus_minus_budget_index'] = $i;
					}else if($key == strtolower('Profit To Date')){
						$data['total_profit_to_date_index'] = $i;
					}else if($key == strtolower('Overall Profit')){
						$data['total_overall_profit_index'] = $i;
					}
					$i++;
				}	
			}
		}
		//All project total summary
		$headers = $this->user_role_access[strtolower('budget')];
		// echo '<pre>';print_r($headers);exit;
		$all_proj_tot_summary_role = array(strtolower('Budgeted Amount') => array('data' => 'total_amount'),
					  strtolower('Estimated Revenue') => array('data' => 'total_contract_price'),
					  strtolower('(+/-) Budget') => array('data' => 'total_plus_minus_budget'),
					  strtolower('Total Vendor Cost') => array('data' => 'total_revised_contract'),
					  strtolower('Overhead / Inhouse') => array('data' => 'total_overhead_cost'),
					  strtolower('Estimated Profit') => array('data' => 'total_estimated_profit_amount'),
					  strtolower('Billed To Client to Date') => array('data' => 'total_bill_to_client_to_date'),
					  strtolower('Balance TO Bill To Client') => array('data' => 'total_balance_to_bill_client'),
					  strtolower('Paid By Client to Date') => array('data' => 'total_paid_by_client_to_date'),
					  strtolower('Unpaid Client Billings') => array('data' => 'total_unpaid_client_billing'),
					  strtolower('Invoiced by Sub to Date') => array('data' => 'total_invoiced_by_sub_to_date'),
					  strtolower('Amount Paid To Sub') => array('data' => 'total_amount_paid_to_sub'),
					  strtolower('Balance to be Invoiced By Sub') => array('data' => 'total_balance_to_be_invoiced_by_sub'),
					  strtolower('Total Balance Owed To Sub') => array('data' => 'balance_owed_to_sub'),
					  strtolower('Total Cost') => array('data' => 'cost'),
					  strtolower('Profit To Date') => array('data' => 'total_profit_to_date'),
					  strtolower('Overall Profit') => array('data' => 'total_overall_profit'),
					  );				
		// $datatable_headers = array();
		$data['datatable_headers_total_summary'][0] = 'Budgeted Amount';
		$data['datatable_column_total_summary'][0] = $all_proj_tot_summary_role[strtolower('Budgeted Amount')];
		$i=1;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($all_proj_tot_summary_role[$key]))
				{
					$data['datatable_headers_total_summary'][$i] = $key;
					$data['datatable_column_total_summary'][$i] = $all_proj_tot_summary_role[$key];
					if($key == strtolower('Estimated Profit')){
						$data['project_total_estimated_profit_amount_index'] = $i;
					}else if($key == strtolower('(+/-) Budget')){
						$data['project_total_plus_minus_budget_index'] = $i;
					}else if($key == strtolower('Profit To Date')){
						$data['project_total_profit_to_date_index'] = $i;
					}else if($key == strtolower('Overall Profit')){
						$data['project_total_overall_profit_index'] = $i;
					}
					$i++;
				}	
			}
		}					
		//Budget summary list
		$budget_summary_column_array = array(strtolower('Project Name') => array('data' => 'project_name'),
					  strtolower('Budgeted Amount') => array('data' => 'total_amount'),
					  strtolower('Client contract') => array('data' => 'total_client_contract','className' => 'summary_client_contract'),
					  strtolower('Client CO') => array('data' => 'total_client_co','className' => 'summary_client_co'),
					  strtolower('Estimated Revenue') => array('data' => 'total_contract_price','className' => 'summary_estimated_revenue'),
					  strtolower('(+/-) Budget') => array('data' => 'total_plus_minus_budget'),
					  strtolower('Vendor Contract') => array('data' => 'total_po_awarded_amount' ,'className' => 'summary_vendor_contract'),
					  strtolower('Change Order(+/-)') => array('data' => 'total_co_awarded_amount','className' => 'summary_vendor_co'),
					  strtolower('Total Vendor Cost') => array('data' => 'total_revised_contract','className' => 'summary_total_vendor_cost'),
					  strtolower('Overhead / Inhouse') => array('data' => 'total_overhead_cost'),
					  strtolower('Estimated Profit') => array('data' => 'total_estimated_profit_amount'),
					  strtolower('Billed To Client to Date') => array('data' => 'total_bill_to_client_to_date'),
					  strtolower('Balance TO Bill To Client') => array('data' => 'total_balance_to_bill_client'),
					  strtolower('Paid By Client to Date') => array('data' => 'total_paid_by_client_to_date'),
					  strtolower('Unpaid Client Billings') => array('data' => 'total_unpaid_client_billing'),
					  strtolower('Invoiced by Sub to Date') => array('data' => 'total_invoiced_by_sub_to_date'),
					  strtolower('Amount Paid To Sub') => array('data' => 'total_amount_paid_to_sub'),
					  strtolower('Balance to be Invoiced By Sub') => array('data' => 'total_balance_to_be_invoiced_by_sub'),
					  strtolower('Total Balance Owed To Sub') => array('data' => 'balance_owed_to_sub'),
					  strtolower('Total Cost') => array('data' => 'cost'),
					  strtolower('Profit To Date') => array('data' => 'total_profit_to_date'),
					  strtolower('Overall Profit') => array('data' => 'total_overall_profit'),
					  strtolower('Profit %') => array('data' => 'profit'),
					  );				
		$data['datatable_headers_budget_summary'][0] = 'Project Name';
		$data['datatable_headers_budget_summary'][1] = 'Budgeted Amount';
		$data['datatable_column_budget_summary'][0] = $budget_summary_column_array[strtolower('Project Name')];
		$data['datatable_column_budget_summary'][1] = $budget_summary_column_array[strtolower('Budgeted Amount')];
		$i=2;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($budget_summary_column_array[$key]))
				{
					$data['datatable_headers_budget_summary'][$i] = $key;
					$data['datatable_column_budget_summary'][$i] = $budget_summary_column_array[$key];
					if($key == strtolower('Estimated Profit')){
						$data['budget_summary_total_estimated_profit_amount_index'] = $i;
					}else if($key == strtolower('(+/-) Budget')){
						$data['budget_summary_total_plus_minus_budget_index'] = $i;
					}else if($key == strtolower('Profit To Date')){
						$data['budget_summary_total_profit_to_date_index'] = $i;
					}else if($key == strtolower('Overall Profit')){
						$data['budget_summary_total_overall_profit_index'] = $i;
					}else if($key == strtolower('Estimated Revenue')){
						$data['budget_summary_total_contract_price_index'] = $i;
					}else if($key == strtolower('Total Vendor Cost')){
						$data['budget_summary_total_revised_contract_index'] = $i;
					}
					$i++;
				}	
			}
		}
		
		//Budget jobs list
		$budget_jobs_column_array = array(
					  strtolower('Cost Code Item') => array('data' => 'cost_code_name'),
					  strtolower('Budget') => array('data' => 'budget_amount'),
					  strtolower('Client contract') => array('data' => 'client_contract','className' => 'client_contract'),
					  strtolower('Client Contract Count') => array('data' => 'client_contract_count','className' => 'client_contract_count'),
					  strtolower('Client CO') => array('data' => 'client_co','className' => 'client_co'),
					  strtolower('Client CO Count') => array('data' => 'client_co_count','className' => 'client_co_count'),
					  strtolower('Estimated Revenue') => array('data' => 'estimated_revenue'),
					  strtolower('(+/-) Budget') => array('data' => 'plus_minus_budget'),
					  strtolower('Vendor Contract') => array('data' => 'po_awarded_amount','className' => 'vendor_contract'),
					  strtolower('PO') => array('data' => 'po_count'),
					  strtolower('Change Order(+/-)') => array('data' => 'co_awarded_amount','className' => 'change_order'),
					  strtolower('CO') => array('data' => 'co_count'),
					  strtolower('Total Vendor Cost') => array('data' => 'total_vendor_cost','className' => 'total_vendor_cost'),
					  strtolower('Overhead / Inhouse') => array('data' => 'overhead_cost'),
					  strtolower('Estimated Profit') => array('data' => 'estimated_profit_amount'),
					  strtolower('Billed To Client to Date') => array('data' => 'bill_to_client_to_date'),
					  strtolower('Balance TO Bill To Client') => array('data' => 'balance_to_bill_client'),
					  strtolower('Paid By Client to Date') => array('data' => 'paid_by_client_to_date'),
					  strtolower('Unpaid Client Billings') => array('data' => 'unpaid_client_billing'),
					  strtolower('Invoiced by Sub to Date') => array('data' => 'invoiced_by_sub_to_date'),
					  strtolower('Amount Paid To Sub') => array('data' => 'amount_paid_to_sub'),
					  strtolower('Balance to be Invoiced By Sub') => array('data' => 'balance_to_be_invoiced_by_sub'),
					  strtolower('Total Balance Owed To Sub') => array('data' => 'total_balance_owed_to_sub'),
					  strtolower('Total Cost') => array('data' => 'total_cost'),
					  strtolower('Profit To Date') => array('data' => 'profit_to_date'),
					  strtolower('Overall Profit') => array('data' => 'overall_profit')
					  );				
		$data['datatable_headers_budget_jobs'][0] = 'Cost Code Item';
		$data['datatable_headers_budget_jobs'][1] = 'Budget';
		$data['datatable_column_budget_jobs'][0] = $budget_jobs_column_array[strtolower('Cost Code Item')];
		$data['datatable_column_budget_jobs'][1] = $budget_jobs_column_array[strtolower('Budget')];
		$i=2;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($budget_jobs_column_array[$key]))
				{
					$data['datatable_headers_budget_jobs'][$i] = $key;
					$data['datatable_column_budget_jobs'][$i] = $budget_jobs_column_array[$key];
					switch ($key) 
					{
						case 'client contract count':
							$data['budget_jobs_client_contract_count_index'] = $i;
							break;
						case 'estimated profit':
							$data['budget_jobs_estimated_profit_amount_index'] = $i;
							break;
						case 'client co count':
							$data['budget_jobs_client_co_count_index'] = $i;
							break;
						case 'overall profit':
							$data['budget_jobs_overall_profit_index'] = $i;
							break;
						case '(+/-) budget':
							$data['budget_jobs_plus_minus_budget_index'] = $i;
							break;
						case 'total vendor cost':
							$data['budget_jobs_total_vendor_cost_index'] = $i;
							break;
						case 'estimated revenue':
							$data['budget_jobs_estimated_revenue_index'] = $i;
							break;
						case 'co':
							$data['budget_jobs_co_count_index'] = $i;
							break;
						case 'po':
							$data['budget_jobs_po_count_index'] = $i;
							break;
						case 'profit to date':
							$data['budget_jobs_profit_to_date_index'] = $i;
							break;	
					}				
					$i++;
				}	
			}
		}			
		// echo '<pre>';print_r($data);exit;	
		$this->template->view($data);
	}
	
	/** 
	* Insert costcode
	* 
	* @method: save_costcode 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	*/
	public function update_costcode()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $result['data'];
				if($result['type'] == 'add')
				{
					$args = array('builder_id'=>$this->user_session['builder_id'],
					'cost_variance_code' => $result['cost_variance_code'],
					'code_type' => 'Cost Code',
					'code_category' => $result['code_category'],
					'cost_description' => $result['cost_description']);
					$result = $this->Mod_cost_code->save_costcode($args);
				}
				elseif($result['type'] == 'update')
				{
					$args = array('ub_cost_variance_code_id'=>$result['update_costcode_id'],
					'cost_variance_code' => $result['cost_variance_code']);
					$result = $this->Mod_cost_code->save_costcode($args);
				}
				elseif($result['type'] == 'delete')
				{
					$args = array('ub_cost_variance_code_id'=>$result['costcode_id'],
					'status'=>'Inactive');
					$result = $this->Mod_cost_code->save_costcode($args);
				}
			}
			$this->Mod_cost_code->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	
	/** 
	* Get Budget Summary for a Project(s) (It is used by budget_summary and project_budget)
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: YnVkZ2V0L2J1Zgxf1dldF9zdW1tYXJ5
	*/	
	public function get_budget_summary()
	{
		 // echo "hiiii"; exit;
		$post_array[] = array(
							'field_name' => 'ESTIMATE.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);

		/* if(!empty($this->project_id))
		{

		 $post_array[] = array(
							'field_name' => 'ESTIMATE.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);								
		}
		else
		{ */
		$post_array[] = array(
						'field_name' => 'ESTIMATE.project_id',
						'value'=> $this->users_project_ids, 
						'type' => '||',
						'classification' => 'primary_ids'
					);
		


		
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			if(TRUE === $result['status'])
			{
				 	
				$where_str = $this->Mod_budget->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_budget->get_budget_summary(array(
												'select_fields' => array('COUNT(ESTIMATE.ub_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												'group_clause'=> array("PROJECT.ub_project_id"),
												'join'=> array('builder'=>'Yes','project'=>'Yes'), 
												)); 
												
				}
				  // echo '<pre>';print_r(count($total_count_array['aaData']));exit;

				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					
					// Get formatted sort name
					$format_sort_name = $this->Mod_budget->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'ESTIMATE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
					
				}
				else
				{
					$order_by_where = 'ESTIMATE.modified_on DESC';
				}
			}
			else
			{
				$this->Mod_budget->response($result);
			}
		}
		/* $headers = array('Project Name' => 1,
						'Budgeted Amount' => 1,
						'Estimated Revenue'=> 1,
						'(+/-)Budget' => 1,
						'Budget' => 1
						); */
		$headers = $this->user_role_access[strtolower('budget')];
		$role_based_query = array(strtolower('Project Name') => 'PROJECT.project_name',
			  strtolower('Budgeted Amount') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.budget_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_amount",
			  strtolower('Estimated Revenue') =>"CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.estimated_revenue),2,'".CURRENCY_FORMAT_TEXT."')) AS total_contract_price",
			  strtolower('(+/-) Budget') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.plus_minus_budget),2,'".CURRENCY_FORMAT_TEXT."')) AS total_plus_minus_budget",
			  strtolower('Total Vendor Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.revised_contract),2,'".CURRENCY_FORMAT_TEXT."')) AS total_revised_contract",
			  strtolower('Overhead / Inhouse') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.overhead_cost),2,'".CURRENCY_FORMAT_TEXT."')) AS total_overhead_cost",
			  strtolower('Estimated Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.estimated_profit_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_estimated_profit_amount",
			  strtolower('Billed To Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.bill_to_client_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_bill_to_client_to_date",
			  strtolower('Balance TO Bill To Client') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.balance_to_bill_client),2,'".CURRENCY_FORMAT_TEXT."')) AS total_balance_to_bill_client",
			  strtolower('Paid By Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.paid_by_client_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_paid_by_client_to_date",
			  strtolower('Unpaid Client Billings') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.unpaid_client_billing),2,'".CURRENCY_FORMAT_TEXT."')) AS total_unpaid_client_billing",
			  strtolower('Invoiced by Sub to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.invoiced_by_sub_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_invoiced_by_sub_to_date",
			  strtolower('Amount Paid To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.amount_paid_to_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS total_amount_paid_to_sub",
			  strtolower('Balance to be Invoiced By Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.balance_to_be_invoiced_by_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS total_balance_to_be_invoiced_by_sub",
			  strtolower('Total Balance Owed To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.total_balance_owed_to_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS balance_owed_to_sub",
			  strtolower('Total Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.total_cost),2,'".CURRENCY_FORMAT_TEXT."')) AS cost",
			  strtolower('Profit To Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.profit_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_profit_to_date",
			  strtolower('Overall Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.overall_profit),2,'".CURRENCY_FORMAT_TEXT."')) AS total_overall_profit",
			  strtolower('Profit %') => 'ROUND(((SUM(ESTIMATE.overall_profit)/SUM(ESTIMATE.estimated_revenue))*100))AS profit'
			  );	
		$select_query = array();
		$select_query[0] = $role_based_query[strtolower('Project Name')];
		$select_query[1] = $role_based_query[strtolower('Budgeted Amount')];
		$i=2;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($role_based_query[$key]))
				{
					$select_query[$i] = $role_based_query[$key];
					$i++;
				}
			}
		}
		
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => $select_query,
		
		//array('PROJECT.project_name','SUM(ESTIMATE.budget_amount) AS total_amount','SUM(ESTIMATE.estimated_revenue) AS total_contract_price','SUM(ESTIMATE.plus_minus_budget) AS total_plus_minus_budget','SUM(ESTIMATE.revised_contract)AS total_revised_contract','SUM(ESTIMATE.overhead_cost)AS total_overhead_cost','SUM(ESTIMATE.estimated_profit_amount)AS total_estimated_profit_amount','SUM(ESTIMATE.bill_to_client_to_date)AS total_bill_to_client_to_date ','SUM(ESTIMATE.balance_to_bill_client)AS total_balance_to_bill_client','SUM(ESTIMATE.paid_by_client_to_date)AS total_paid_by_client_to_date','SUM(ESTIMATE.unpaid_client_billing)AS total_unpaid_client_billing','SUM(ESTIMATE.invoiced_by_sub_to_date)AS total_invoiced_by_sub_to_date','SUM(ESTIMATE.amount_paid_to_sub)AS total_amount_paid_to_sub','SUM(ESTIMATE.balance_to_be_invoiced_by_sub)AS total_balance_to_be_invoiced_by_sub','SUM(ESTIMATE.total_balance_owed_to_sub)AS balance_owed_to_sub','SUM(ESTIMATE.total_cost)AS cost','SUM(ESTIMATE.profit_to_date)AS total_profit_to_date','SUM(ESTIMATE.overall_profit)AS total_overall_profit','ROUND(((SUM(ESTIMATE.overall_profit)/SUM(ESTIMATE.estimated_revenue))*100))AS profit'),
		'join'=> array('builder'=>'Yes','project'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'group_clause'=> array("PROJECT.ub_project_id"),
		//'pagination' => $pagination_array
		);
		 // echo '<pre>';print_r($query_array);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		// echo '<pre>';print_r($query_array);exit;
		$result_data = $this->Mod_budget->get_budget_summary($query_array);
		// File export request 
		if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			$all_proj_summary = array(strtolower('Project Name')  => 'project_name',
					  strtolower('Budgeted Amount') => 'total_amount',
					  strtolower('Estimated Revenue') => 'total_contract_price',
					  strtolower('(+/-) Budget')  => 'total_plus_minus_budget',
					  strtolower('Total Vendor Cost')  => 'total_revised_contract',
					  strtolower('Overhead / Inhouse')  => 'total_overhead_cost',
					  strtolower('Estimated Profit')  => 'total_estimated_profit_amount',
					  strtolower('Billed To Client to Date') => 'total_bill_to_client_to_date',
					  strtolower('Balance TO Bill To Client') => 'total_balance_to_bill_client',
					  strtolower('Paid By Client to Date') => 'total_paid_by_client_to_date',
					  strtolower('Unpaid Client Billings')  => 'total_unpaid_client_billing',
					  strtolower('Invoiced by Sub to Date') => 'total_invoiced_by_sub_to_date',
					  strtolower('Amount Paid To Sub') => 'total_amount_paid_to_sub',
					  strtolower('Balance to be Invoiced By Sub') => 'total_balance_to_be_invoiced_by_sub',
					  strtolower('Total Balance Owed To Sub') => 'balance_owed_to_sub',
					  strtolower('Total Cost') => 'cost',
					  strtolower('Profit To Date') => 'total_profit_to_date',
					  strtolower('Overall Profit') => 'total_overall_profit',
					  strtolower('Profit %') => 'profit'
					  );				
		
			$data['export_headers'][0] = 'Project Name';
			$data['export_headers'][1] = 'Budgeted Amount';
			$data['export_column'][0] = $all_proj_summary[strtolower('Project Name')];
			$data['export_column'][1] = $all_proj_summary[strtolower('Budgeted Amount')];
			$j=2;
			// echo '<pre>';print_r($headers);exit;
			foreach($headers as $header_key => $val)				
			{
				if($headers[$header_key] == 1)
				{
					if(isset($all_proj_summary[$header_key]))
					{
						$data['export_headers'][$j] = ucfirst($header_key);
						$data['export_column'][$j] = $all_proj_summary[$header_key];
						$j++;
					}
				}	
			}	
			$field_list_array = $data['export_column'];
			$export_array['header'][0] = $data['export_headers'];
			// $field_list_array = array('project_name','total_amount','total_contract_price','total_revised_contract','total_overhead_cost','total_estimated_profit_amount','total_bill_to_client_to_date','total_balance_to_bill_client','total_paid_by_client_to_date','total_unpaid_client_billing','total_invoiced_by_sub_to_date','total_amount_paid_to_sub','total_balance_to_be_invoiced_by_sub','balance_owed_to_sub','cost','total_profit_to_date','total_overall_profit','profit');
			
			// Export file header column 
			// $export_array['header'][0] = array('Project Name','Budgeted Amount','Estimated Revenue','Total Vendor Cost','Estimated General Condition/Overhead','Estimated Profit','Billed To Client to Date','Balance To Bill Client(D - H)','Paid By Client to Date','Unpaid Client Billings','Invoiced to Date by sub','Amount Paid to sub','Balance To be Invoiced by sub','Total Balance Owed to sub','Total Cost','Profit to Date','Profit','Profit %'); 
			
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
			echo array_to_export($export_array,'uni_Budget_summary_list.xls','csv');exit;
		}
		// The following parameters required for data table
        if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			$count_array=count($total_count_array['aaData']);		
			$result_data['iTotalRecords'] = isset($count_array)?$count_array:'';
			$result_data['iTotalDisplayRecords'] = isset($count_array)?$count_array:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data
        
		$this->Mod_budget->response($result_data);
	}
	/** 
	* Get Budget Summary for a Project(s) (It is used by budget_summary and project_budget)
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: YnVkZ2V0L2J1Zgxf1dldF9zdW1tYXJ5
	*/	
	public function get_project_summary()
	{
		 // echo "hiiii"; exit;
		$post_array[] = array(
							'field_name' => 'ESTIMATE.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		
		$post_array[] = array(
							'field_name' => 'ESTIMATE.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			if(TRUE === $result['status'])
			{
				 	
				$where_str = $this->Mod_budget->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_budget->get_budget_summary(array(
												'select_fields' => array('COUNT(ESTIMATE.ub_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('project'=>'Yes'),
												'group_clause'=> array("PROJECT.ub_project_id")
												)); 
												
				}
				 

				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					
					// Get formatted sort name
					$format_sort_name = $this->Mod_budget->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'ESTIMATE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
					
				}
				else
				{
					$order_by_where = 'ESTIMATE.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_budget->response($result);
			}
		}
		
		//datatable column role access
		$headers = $this->user_role_access[strtolower('budget')];
		$role_based_query = array(strtolower('Project Name') => 'PROJECT.project_name',
			  strtolower('Budgeted Amount') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.budget_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_amount",
			  strtolower('Client contract') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.client_contract),2,'".CURRENCY_FORMAT_TEXT."')) AS total_client_contract",
			  strtolower('Client CO') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.client_co),2,'".CURRENCY_FORMAT_TEXT."')) AS total_client_co",
			  strtolower('Estimated Revenue') =>"CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.estimated_revenue),2,'".CURRENCY_FORMAT_TEXT."')) AS total_contract_price",
			  strtolower('(+/-) Budget') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.plus_minus_budget),2,'".CURRENCY_FORMAT_TEXT."')) AS total_plus_minus_budget",
			  strtolower('Vendor Contract') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.po_awarded_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_po_awarded_amount",
		      strtolower('Change Order(+/-)') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.co_awarded_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_co_awarded_amount",
			  strtolower('Total Vendor Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.revised_contract),2,'".CURRENCY_FORMAT_TEXT."')) AS total_revised_contract",
			  strtolower('Overhead / Inhouse') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.overhead_cost),2,'".CURRENCY_FORMAT_TEXT."')) AS total_overhead_cost",
			  strtolower('Estimated Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.estimated_profit_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_estimated_profit_amount",
			  strtolower('Billed To Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.bill_to_client_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_bill_to_client_to_date",
			  strtolower('Balance TO Bill To Client') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.balance_to_bill_client),2,'".CURRENCY_FORMAT_TEXT."')) AS total_balance_to_bill_client",
			  strtolower('Paid By Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.paid_by_client_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_paid_by_client_to_date",
			  strtolower('Unpaid Client Billings') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.unpaid_client_billing),2,'".CURRENCY_FORMAT_TEXT."')) AS total_unpaid_client_billing",
			  strtolower('Invoiced by Sub to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.invoiced_by_sub_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_invoiced_by_sub_to_date",
			  strtolower('Amount Paid To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.amount_paid_to_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS total_amount_paid_to_sub",
			  strtolower('Balance to be Invoiced By Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.balance_to_be_invoiced_by_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS total_balance_to_be_invoiced_by_sub",
			  strtolower('Total Balance Owed To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.total_balance_owed_to_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS balance_owed_to_sub",
			  strtolower('Total Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.total_cost),2,'".CURRENCY_FORMAT_TEXT."')) AS cost",
			  strtolower('Profit To Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.profit_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_profit_to_date",
			  strtolower('Overall Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.overall_profit),2,'".CURRENCY_FORMAT_TEXT."')) AS total_overall_profit",
			  strtolower('Profit %') => 'ROUND(((SUM(ESTIMATE.overall_profit)/SUM(ESTIMATE.estimated_revenue))*100))AS profit'
			  );	
		$select_query = array();
		$select_query[0] = $role_based_query[strtolower('Project Name')];
		$select_query[1] = $role_based_query[strtolower('Budgeted Amount')];
		$i=2;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($role_based_query[$key]))
				{
					$select_query[$i] = $role_based_query[$key];
					$i++;
				}
			}
		}
		// echo '<pre>';print_r($select_query);exit;
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => $select_query,
		//array('PROJECT.project_name','SUM(ESTIMATE.budget_amount) AS total_amount','SUM(ESTIMATE.client_contract) AS total_client_contract','SUM(ESTIMATE.client_co) AS total_client_co','SUM(ESTIMATE.estimated_revenue) AS total_contract_price','SUM(ESTIMATE.plus_minus_budget) AS total_plus_minus_budget','SUM(ESTIMATE.po_awarded_amount) AS total_po_awarded_amount','SUM(ESTIMATE.co_awarded_amount) AS total_co_awarded_amount','SUM(ESTIMATE.revised_contract) AS total_revised_contract','SUM(ESTIMATE.overhead_cost)AS total_overhead_cost','SUM(ESTIMATE.estimated_profit_amount)AS total_estimated_profit_amount','SUM(ESTIMATE.bill_to_client_to_date)AS total_bill_to_client_to_date ','SUM(ESTIMATE.balance_to_bill_client)AS total_balance_to_bill_client','SUM(ESTIMATE.paid_by_client_to_date)AS total_paid_by_client_to_date','SUM(ESTIMATE.unpaid_client_billing)AS total_unpaid_client_billing','SUM(ESTIMATE.invoiced_by_sub_to_date)AS total_invoiced_by_sub_to_date','SUM(ESTIMATE.amount_paid_to_sub)AS total_amount_paid_to_sub','SUM(ESTIMATE.balance_to_be_invoiced_by_sub)AS total_balance_to_be_invoiced_by_sub','SUM(ESTIMATE.total_balance_owed_to_sub)AS balance_owed_to_sub','SUM(ESTIMATE.total_cost)AS cost','SUM(ESTIMATE.profit_to_date)AS total_profit_to_date','SUM(ESTIMATE.overall_profit)AS total_overall_profit','ROUND(((SUM(ESTIMATE.overall_profit)/SUM(ESTIMATE.estimated_revenue))*100))AS profit'),
		'join'=> array('builder'=>'Yes','project'=>'Yes'),
		'where_clause' => $where_str,
		'group_clause'=> array("PROJECT.ub_project_id"),
		'order_clause' => $order_by_where,
		'pagination' => $pagination_array
		);
		 // echo '<pre>';print_r($query_array);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_budget->get_budget_summary($query_array);
		// echo '<pre>';print_r($result_data);exit;
		// File export request  
		if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			$field_list_array = array('project_name','total_amount','total_contract_price','total_revised_contract','total_overhead_cost','total_estimated_profit_amount','total_bill_to_client_to_date','total_balance_to_bill_client','total_paid_by_client_to_date','total_unpaid_client_billing','total_invoiced_by_sub_to_date','total_amount_paid_to_sub','total_balance_to_be_invoiced_by_sub','balance_owed_to_sub','cost','total_profit_to_date','total_overall_profit','profit');
			
			// Export file header column 
			$export_array['header'][0] = array('Project Name','Budgeted Amount','Estimated Revenue','Total Vendor Cost','Estimated General Condition/Overhead','Estimated Profit','Billed To Client to Date','Balance To Bill Client(D - H)','Paid By Client to Date','Unpaid Client Billings','Invoiced to Date by sub','Amount Paid to sub','Balance To be Invoiced by sub','Total Balance Owed to sub','Total Cost','Profit to Date','Profit','Profit %'); 
			
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
			echo array_to_export($export_array,'uni_Budget_summary_list.xls','csv');exit;
		}
		// The following parameters required for data table
        if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			$count_array=count($total_count_array['aaData']);		
			$result_data['iTotalRecords'] = isset($count_array)?$count_array:'';
			$result_data['iTotalDisplayRecords'] = isset($count_array)?$count_array:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data
        
		$this->Mod_budget->response($result_data);
	}
	/** 
	* Get estimate
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function get_estimate()
	{
		$data =  array();
		if(!empty($this->input->post()))
		{
			$postdata = $this->input->post();
			$ub_estimate_id = $postdata['ub_estimate_id'];
			//Select estimate details to display in edit page
			$result_data = $this->Mod_budget->get_estimate(
			array(
			'select_fields' => array('ESTIMATE.ub_estimate_id'
			,'ESTIMATE.cost_code_id'
			,'ESTIMATE.description'
			,'ESTIMATE.quantity'
			,'ESTIMATE.unit_cost'
			,'ESTIMATE.budget_amount'
			,'ESTIMATE.client_contract'
			,'ESTIMATE.overhead_cost'),
			'where_clause' => (array('ESTIMATE.ub_estimate_id' =>  $ub_estimate_id))
			));
			$result_data = $result_data['aaData'][0];
			
			// Get cost codes to list in edit estimate form
			$args['where_clause'] = "(builder_id = ".$this->builder_id." || builder_id = 0 ) AND status = 'Active'";
			$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');
			$cost_code_options = $this->Mod_budget->get_db_options(UB_COST_CODE, $args);
		
			//Below line will load the save_estimate page
			$response = $this->load->view("content/budget/save_estimate.php", array('result_data' => $result_data, 'cost_code_options' => $cost_code_options), true);
			//------------------- END OF save_estimate PAGE CODE --------------
			echo $response; exit;
		}
	}
	/** 
	* Save estimate
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function save_estimate()
	{
		// $postdata = $this->input->post();
		// echo "coming";	print_r($postdata);exit;
		if(!empty($this->input->post()))
		{
			$postdata = $this->input->post();
			$ub_estimate_id = $postdata['ub_estimate_id'];
			// Add estimate
			$result = $this->sanitize_input();
			  // print_r($result);exit;
			if(TRUE === $result['status']) //if sanitize is done
			{
				$form_data = $this->forming_data_array($result['data']);
				// echo "<pre>";print_r($form_data);exit;
				if($ub_estimate_id > 0)
				{
					$form_data['ub_estimate_id'] = $ub_estimate_id;
					$response = $this->Mod_budget->update_estimate($form_data);
				}
				else
				{
					$response = $this->Mod_budget->add_estimate($form_data);
					 // $response = $this->Mod_budget->update_estimate($form_data);
				}
			}
			else
			{
				$this->Mod_project->response($result);
			}
			$this->Mod_project->response($response);
		}
	}
	
	/** 
	* Save mulitple estimate
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function save_multiple_estimate()
	{	
		if(!empty($this->input->post()))
		{
			$result = $this->sanitize_input();
			if(TRUE === $result['status']) //if sanitize is done
			{
				$estimate_values = $result['data'];
				$actual_cost_code_id = $estimate_values['costcode_id'];
				if(isset($actual_cost_code_id[0]))
				{
					unset($actual_cost_code_id[0]);
				}
				if(in_array(0, $actual_cost_code_id))
				{
					$result = array('status'=> 'false', 'message' => 'Please select cost code(s)');
					$this->Mod_project->response($result);
				}
				if(isset($estimate_values['pro_id']) && $estimate_values['pro_id'] > 0)
				{
				   if(count($actual_cost_code_id) == count(array_unique($actual_cost_code_id)))
				   {
					for($i=0;$i<count($estimate_values['quantity']);$i++)
					{
						// $data = array('cost_code_id' => $estimate_values['costcode_id'][$i-1],
						$data = array('ub_estimate_id' => $estimate_values['ub_estimate_id'][$i],
						'cost_code_id' => $estimate_values['cost_code_id'][$i],
						'description' => $estimate_values['description'][$i],
						'quantity' => $estimate_values['quantity'][$i],
						'unit_cost' => $estimate_values['unit_cost'][$i],
						'budget_amount' => $estimate_values['budget_amount'][$i],
						'overhead_cost' => $estimate_values['overhead_cost'][$i]);
						//echo "hii";print_r($data);exit;
						//Forming array for inserting in estimate table
						$form_data = $this->forming_data_array($data);
						$form_data['pro_id'] = $estimate_values['pro_id'];
						$form_data['ub_estimate_id'] = $estimate_values['ub_estimate_id'][$i];
						//print_r($form_data);exit;
						$response = $this->Mod_budget->update_estimate($form_data);
					}	
				  }	
				  else
				  {
					$result = array('status'=> 'false', 'message' => 'Duplicate Cost Code');
					$this->Mod_project->response($result);
				  }
				 }
				else{
				if(count($actual_cost_code_id) == count(array_unique($actual_cost_code_id)))
				{
					for($i=1;$i<count($estimate_values['quantity']);$i++)
					{
						// $data = array('cost_code_id' => $estimate_values['costcode_id'][$i-1],
						$data = array('cost_code_id' => $estimate_values['costcode_id'][$i],
						'description' => $estimate_values['description'][$i],
						'quantity' => $estimate_values['quantity'][$i],
						'unit_cost' => $estimate_values['unit_cost'][$i],
						'budget_amount' => $estimate_values['budget_amount'][$i],
						'overhead_cost' => $estimate_values['overhead_cost'][$i]);
						//Forming array for inserting in estimate table
						$form_data = $this->forming_data_array($data);
						$response = $this->Mod_budget->add_estimate($form_data);
					}	
				}	
				else
				{
					$result = array('status'=> 'false', 'message' => 'Duplicate Cost Code');
					$this->Mod_project->response($result);
				}
			  }	
			}
			else
			{
				$this->Mod_project->response($result);
			}
			$this->Mod_project->response($response);
		}
	}
	
	/** 
	* Delete estimate
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function del_estimate()
	{
		$postdata = $this->input->post();
		$ub_estimate_id = $postdata['ub_estimate_id'];
		if($ub_estimate_id > 0)
		{
			$form_data['ub_estimate_id'] = $ub_estimate_id;
			$response = $this->Mod_budget->delete_estimate($form_data);
			$this->module = 'BUDGET_JOBS';
			$respoce_array = $this->get_jobs($page_count = 'result_array');
			if($respoce_array['status'] == FALSE)
			{
				if(isset($this->uni_session_get('jobs_search')['iDisplayStart']) && $this->uni_session_get('jobs_search')['iDisplayStart'] > 0)
					{
						$search_session_array['iDisplayStart'] = (($this->uni_session_get('jobs_search')['iDisplayStart']) - ($this->uni_session_get('jobs_search')['iDisplayLength']));
				        $search_session_array['iDisplayLength'] = $this->uni_session_get('jobs_search')['iDisplayLength'];
				        $this->uni_set_session('jobs_search', $search_session_array);
					}
			}
		}
		$this->Mod_project->response($response);
	}
	
	/** 
	* Forming data array for insertion and updation of project details
	* 
	* @method: forming_data_array 
	* @access: public 
	* @param:  array
	* @return: array 
	*/
	function forming_data_array($data = array())
	{
		//Get cost code name
		$cost_code_arry = array(
							'select_fields' => array('COSTCODE.cost_variance_code'
							),
							'where_clause' => (array('COSTCODE.ub_cost_variance_code_id' =>  $data['cost_code_id'])),
							);
		$cost_code_name = $this->Mod_budget->get_cost_code($cost_code_arry);
		// print_r($cost_code_name);exit;
		$cost_code_name = $cost_code_name['aaData'][0]; 
		
		$estimate_data = array(
					'builder_id' => $this->builder_id,
					'project_id' => $this->project_id,
					'cost_code_id' => $data['cost_code_id'],
					'cost_code_name' => $cost_code_name['cost_variance_code'],
					'description' => $data['description'],
					'quantity' => $data['quantity'],
					'unit_cost' => $data['unit_cost'],
					'budget_amount' => $data['budget_amount'],
					'overhead_cost' => $data['overhead_cost']);
		
		return $estimate_data;
	}
	/** 
	* Build pay app edit
	* 
	* @method: build_payapp_edit 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function build_payapp_edit()
	{
		$data =  array();
		if(!empty($this->input->post()))
		{
			$postdata = $this->input->post();
			$ub_payapp_id = $postdata['ub_payapp_id'];
			//Select estimate details to display in edit page
			$result_data = $this->Mod_budget->get_payapp(
			array(
			'select_fields' => array('PAYAPP.ub_payapp_id'
			,'PAYAPP.period_to','PAYAPP.name'),
			'where_clause' => (array('PAYAPP.ub_payapp_id' => $ub_payapp_id))
			));
			$result_data = $result_data['aaData'][0];
			$result_data['period_to'] = date("m/d/Y", strtotime($result_data['period_to']));
			
			//Below line will load the save_payapp page
			$response = $this->load->view("content/budget/save_payapp.php", array('result_data' => $result_data), true);
			echo $response; exit;
		}
	}
	/** 
	* Build pay app status
	* 
	* @method: build_payapp_status 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function build_payapp_status()
	{
		$data =  array();
		if(!empty($this->input->post()))
		{
			$postdata = $this->input->post();
			$ub_payapp_id = $postdata['ub_payapp_id'];
			//Select estimate details to display in edit page
			$result_data = $this->Mod_budget->get_payapp(
			array(
			'select_fields' => array('PAYAPP.name','status','ub_payapp_id'),
			'where_clause' => (array('PAYAPP.ub_payapp_id' => $ub_payapp_id))
			));
			$result_data = $result_data['aaData'][0];
			//Below line will load the payapp_status page
			$response = $this->load->view("content/budget/payapp_status.php", array('result_data' => $result_data), true);
			echo $response; exit;
		}
	}
	/** 
	* Get estimate
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_cost_code_drop_down()
	{
		
	}	
	/** 
	* Save Cost code
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/	
	public function save_cost_code()
	{
		
	}
	/** 
	* Get pay app list
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
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
				if(!empty($this->project_id))
				{
					$post_array[] = array(
									'field_name' => 'PAYAPP.project_id',
									'value'=> $this->project_id, 
									'type' => '='
									);
				}
				else
				{
					$post_array[] = array(
									'field_name' => 'PAYAPP.project_id',
									'value'=> $this->users_project_ids, 
									'type' => '||',
									'classification' => 'primary_ids'
								);
				}						
				/* $post_array[] = array(
									'field_name' => 'PAYAPP.project_id',
									'value'=> $this->project_id, 
									'type' => '='
									); */
									
				if(isset($this->user_account_type) && $this->user_account_type == OWNER)
				{
					$post_array[] = array(
										'field_name' => 'PAYAPP.status',
										'value'=> 'Draft', 
										'type' => '!='
										);					
				}
				// Search input - Search input parameter we are used to builder the where condition and will save it in session.
				$search_session_array = array();
				// period_to search input
				if(isset($result['data']['period_to']) && $result['data']['period_to']!='')
				{
					$due_time = $result['data']['period_to'];
					$period_to = date("Y-m-d", strtotime($due_time));
					$post_array[] = array(
										'field_name' => 'PAYAPP.period_to',
										'to' => $period_to, 
										'type' => 'daterange'
										);
					$search_session_array['period_to'] = $result['data']['period_to'];
				}
				// pay_app_name search input
				if(isset($result['data']['pay_app_name']) && $result['data']['pay_app_name']!='' && $result['data']['pay_app_name']!='Nothing selected' && $result['data']['pay_app_name']!='null')
				{
					$post_array[] = array(
										'field_name' => 'PAYAPP.name',
										'value'=> $result['data']['pay_app_name'], 
										'type' => '='
										);
					$search_session_array['pay_app_name'] = $result['data']['pay_app_name'];
				}
				// Setting session 
				$this->module = 'BUDGET_PAYAPP';
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('pay_app_search')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('pay_app_search')['iDisplayLength'];
				$this->uni_set_session('pay_app_search', $search_session_array);
				// Where clause argument
				$where_str = $this->Mod_budget->build_where($post_array);
				//echo '<pre>';print_r($where_str);exit;
				
				//role access checked -- code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('budget')][strtolower('view all')]) && $this->user_role_access[strtolower('budget')][strtolower('view all')] == 0)
				{	
					if(isset($this->user_role_access[strtolower('budget')][strtolower('view created by me')]) && $this->user_role_access[strtolower('budget')][strtolower('view created by me')] == 1)
					{
						$where_str = $where_str.'AND PAYAPP.created_by = '. $this->user_id;
					}
				}	
				
				// Pagination argument
				$pagination_array = array();
				if(isset($this->uni_session_get('pay_app_search')['iDisplayStart']) && isset($this->uni_session_get('pay_app_search')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('pay_app_search')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('pay_app_search')['iDisplayLength'], 'sEcho' => 1);

					
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

				
				}
				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}*/
				// Order by clause argument
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PAYAPP.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
				$order_by_where = 'PAYAPP.modified_on DESC';
				}
                // Fetch argument building
				$period_to_date_array = array('PAYAPP.period_to'=> 'period_to');
                $pay_app_args = array('select_fields' => array('PAYAPP.ub_payapp_id','PAYAPP.payapp_number','PAYAPP.name','PAYAPP.status,'.$this->Mod_user->format_user_datetime($period_to_date_array,'date')),
                //'join'=> array('builder'=>'Yes'),
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
	/** 
	* Save pay app
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/		
	public function save_payapp()
	{
		$ub_payapp_id = 0;
		$post_array = array();
		if(!empty($this->input->post()))
		{
			$postdata = $this->input->post();
			// Add estimate
			$result = $this->sanitize_input();
			if(TRUE === $result['status']) //if sanitize is done
			{
				$ub_payapp_id = $postdata['ub_payapp_id'];
				$post_array = $result['data'];
				if($ub_payapp_id > 0)
				{
					$post_array['ub_payapp_id'] = $ub_payapp_id;
					$response = $this->Mod_budget->update_payapp($post_array);
				}
				else
				{
					$response = $this->Mod_budget->add_payapp($post_array);					
				}
			}
			else
			{
				$this->Mod_budget->response($result);
			}
			$this->Mod_budget->response($response);
		}
	}		
	/** 
	* Get pay app certificate
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: YnVkZ2V0L2dldF9wYXlhcHBfY2Vydgxf1lmaWNhdgxf1UvMTA-
	*/
	public function get_payapp_certificate($payapp_id=0)
    {
        if(!empty($this->input->post()))
        {
            $where_str = '';
			$certificate_info_array = array();
            // Sanitize input
            $result = $this->sanitize_input();
            if(TRUE == $result['status'])
            {
                if(isset($result['data']['payapp_id']) && $result['data']['payapp_id'] > 0)
                {
                    $approved_this_month = array();
					$certificate_info = $this->Mod_budget->get_payapp_certificate(array('where_clause'=>array('payapp_id'=>$result['data']['payapp_id'])));
					if(TRUE === $certificate_info['status'])
					{
						$certificate_info_array = $certificate_info['aaData'][0];
						$payapp_arg_co_add = array('select_fields' => array('payapp_number','date_approved','co_addition', 'co_subtraction'),
						'where_clause' => array('certificate_id'=>$certificate_info_array['ub_payapp_certificate_id']));
						$approved_this_month = $this->Mod_budget->get_payapp_certificate_details($payapp_arg_co_add);
						if(TRUE === $approved_this_month['status'])
						{
							$approved_this_month_array = $approved_this_month['aaData'];
							$certificate_info_array['approved_this_month'] = $approved_this_month_array;
						}
                        $response = $this->load->view("content/budget/payapp_certificate.php", array('certificate_info' => $certificate_info_array), true);
					}											
                    else
                    {
                        $response = 'No Certificate Found';
                    }
                }
                else
                {
                    $response = 'No Payapp ID Found';
                }
                echo $response; exit;
            }
            else
            {
                // $this->Mod_budget->response($result);
            }
        }
    }
	/** 
	* Get pay app request summary
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_payapp_request_summary()
	{
		if(!empty($this->input->post()))
		{
			$where_str = '';
			// Sanitize input
			$result = $this->sanitize_input();
			//echo '<pre>';print_r($result);
			if(TRUE === $result['status'])
			{
				if(empty($this->project_id) && $result['data']['ub_payapp_id'] > 0)
				{
					$where_args = array('ub_payapp_id' => $result['data']['ub_payapp_id']);
					$project_id = $this->Mod_project->get_project_id(UB_PAYAPP,$where_args);
					$this->project_id = $project_id['aaData'][0]['project_id'];
					$this->project_name = $project_id['aaData'][0]['project_name'];
				}	
				// Getting data of a particular builder
				$post_array[] = array(
									'field_name' => 'PAYAPP_REQUEST_SUMMARY.builder_id',
									'value'=> $this->builder_id, 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'PAYAPP_REQUEST_SUMMARY.project_id',
									'value'=> $this->project_id, 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'PAYAPP_REQUEST_SUMMARY.payapp_id',
									'value'=> $result['data']['ub_payapp_id'], 
									'type' => '='
									);	
				$post_array[] = array(
									'field_name' => 'PAYAPP_REQUEST_SUMMARY.type',
									'value'=> 'Estimate', 
									'type' => '='
									);	
									
				// Pagination argument
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']) && $result['data']['iDisplayLength']>0)
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
					$order_by_where = 'PAYAPP_REQUEST_SUMMARY.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				
				/* Get 'Estimate' type records from payapp summary*/
                // Where clause argument
				$where_str = $this->Mod_budget->build_where($post_array);
				// Fetch argument building
                $pay_app_summary_args = array('select_fields' => array(
				'PAYAPP_REQUEST_SUMMARY.ub_payapp_request_summary_id',
				'PAYAPP_REQUEST_SUMMARY.type',
				'PAYAPP_REQUEST_SUMMARY.cost_code_name','PAYAPP_REQUEST_SUMMARY.budgeted_value','PAYAPP_REQUEST_SUMMARY.scheduled_value',
				'PAYAPP_REQUEST_SUMMARY.from_prev_app',
				'PAYAPP_REQUEST_SUMMARY.this_period',
				'PAYAPP_REQUEST_SUMMARY.value_of_material_stored',
				'PAYAPP_REQUEST_SUMMARY.total_completed_and_stored_till_date',
				'PAYAPP_REQUEST_SUMMARY.percentage_of_work_done',
				'PAYAPP_REQUEST_SUMMARY.balance_to_be_finished',
				'PAYAPP_REQUEST_SUMMARY.retainage',
				'PAYAPP_REQUEST_SUMMARY.retainage_amount'
				),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					//Only for export
					unset($pay_app_summary_args['pagination']);
				}
				$result_data = $this->Mod_budget->get_payapp_request_summary($pay_app_summary_args);
				/* Get 'Estimate' type records from payapp summary*/

				/* Get 'CO' type records from payapp summary*/
                
				if(count($post_array)>3)
				{
					unset($post_array[3]);
				}
				$post_array[] = array(
					'field_name' => 'PAYAPP_REQUEST_SUMMARY.type',
					'value'=> 'CO', 
					'type' => '='
				);	

				// Where clause argument
				$where_str = $this->Mod_budget->build_where($post_array);
				// Fetch argument building
                $pay_app_summary_args = array('select_fields' => array(
				'PAYAPP_REQUEST_SUMMARY.ub_payapp_request_summary_id',
				'PAYAPP_REQUEST_SUMMARY.type',
				'PAYAPP_REQUEST_SUMMARY.cost_code_id','PAYAPP_REQUEST_SUMMARY.cost_code_name','PAYAPP_REQUEST_SUMMARY.budgeted_value','PAYAPP_REQUEST_SUMMARY.scheduled_value',
				'PAYAPP_REQUEST_SUMMARY.from_prev_app',
				'PAYAPP_REQUEST_SUMMARY.this_period',
				'PAYAPP_REQUEST_SUMMARY.value_of_material_stored',
				'PAYAPP_REQUEST_SUMMARY.total_completed_and_stored_till_date',
				'PAYAPP_REQUEST_SUMMARY.percentage_of_work_done',
				'PAYAPP_REQUEST_SUMMARY.balance_to_be_finished',
				'PAYAPP_REQUEST_SUMMARY.retainage',
				'PAYAPP_REQUEST_SUMMARY.retainage_amount'
				),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					//Only for export
					unset($pay_app_summary_args['pagination']);
				}
				
				$result_data1 = $this->Mod_budget->get_payapp_request_summary($pay_app_summary_args);
				$result_output = array();
				//print_r($result_data);
				//print_r($result_data1);
				if(TRUE === $result_data['status'] && TRUE === $result_data1['status'])
				{
					$estimate_array = $result_data['aaData'];
					$CO_array = $result_data1['aaData'];
					$result_output['aaData'] = array_merge($estimate_array, $CO_array);
					$result_output['status'] = TRUE;
					$result_output['message'] = 'Estimate & CO retrieved successfully!';
				}
				else if(TRUE === $result_data['status'] && FALSE === $result_data1['status'])
				{
					$result_output['aaData'] = $result_data['aaData'];
					$result_output['status'] = TRUE;
					$result_output['message'] = 'Estimate retrieved successfully!';
				}
				else
				{
					$result_output = array();
					$result_output['aaData'] = array(); 
				}	
				//$result_output['iTotalRecords'] = count($result_output);
				//$result_output['iTotalDisplayRecords'] =count($result_output);
				//$result_output['sEcho'] = count($result_output);					
				
				/* Get 'Estimate' type records from payapp summary*/
				
				
				
				// File export request  
/* 				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
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
 */				
				// The following parameters required for data table
				if($result_data['status'] == FALSE)
				{
/* 					$result_data = array();
					$result_data['aaData'] = array(); */
				}
				else
				{
					// Get number of records
					/* $total_count_array = $this->Mod_budget->get_payapp_request_summary(array(
												'select_fields' => array('COUNT(PAYAPP_REQUEST_SUMMARY.ub_payapp_request_summary_id) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:''; */
				}
				$this->Mod_budget->response($result_output);
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
	/** 
	* Save pay app request summary
	* 
	* @method: save_payapp_request_summary 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	* @author: Thiyagaraj R
	*/
	public function save_payapp_request_summary()
	{
		$ub_payapp_id = 0;
		$post_array = array();
		$update_array = array();
		if(!empty($this->input->post()))
		{
			$postdata = $this->input->post();
			$result = $this->sanitize_input();
			if(TRUE === $result['status']) //if sanitize is done
			{
				if(isset($result['data']['action']) && $result['data']['action'] == 'edit')
				{
					$post_array = $result['data']['data'];
					if(isset($result['data']['id']) && $result['data']['id']!='')
					{
						$update_array['ub_payapp_request_summary_id']=$result['data']['id'];
					}
					if(isset($post_array['this_period']) && $post_array['this_period']!='')
					{
						$update_array['this_period']=$post_array['this_period'];
					}
					if(isset($post_array['value_of_material_stored']) && $post_array['value_of_material_stored']!='')
					{
						$update_array['value_of_material_stored']=$post_array['value_of_material_stored'];
					}
					
/* 					if(isset($post_array['total_completed_and_stored_till_date']) && $post_array['total_completed_and_stored_till_date']!='')
					{
						$update_array['total_completed_and_stored_till_date']=$post_array['total_completed_and_stored_till_date'];
					}
					if(isset($post_array['percentage_of_work_done']) && $post_array['percentage_of_work_done']!='')
					{
						$update_array['percentage_of_work_done']=$post_array['percentage_of_work_done'];
					}
					if(isset($post_array['balance_to_be_finished']) && $post_array['balance_to_be_finished']!='')
					{
						$update_array['balance_to_be_finished']=$post_array['balance_to_be_finished'];
					}
 */					
					if(isset($post_array['retainage']) && $post_array['retainage']!='')
					{
						$update_array['retainage']=$post_array['retainage'];
					}
					
/* 					if(isset($post_array['retainage_amount']) && $post_array['retainage_amount']!='')
					{
						$update_array['retainage_amount']=$post_array['retainage_amount'];
					}
 */					
					if(count($update_array)>1)
					{
						$response = $this->Mod_budget->update_payapp_summary($update_array);
					}
					else
					{
						$response = array('status'=>false,'message'=>'Payapp summary post data is not valid!');
					}	
				}
				else
				{
					$response = array('status'=>false,'message'=>'Payapp summary primaryID is not valid!');
				}
			}
			else
			{
				$this->Mod_project->response($result);
			}
			$this->Mod_project->response($response);
		}		
	}
	/** 
	* Get PO CO list
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_po($cost_code_id=0,$type='',$page_count = '')
	{
		 
		$post_array[] = array(
							'field_name' => 'PO_CO.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'PO_CO.type',
							'value'=> 'PO', 
							'type' => '='
							);	
		$post_array[] = array(
							  'field_name' => 'PO_CO.is_delete',
							  'value'=> 'No', 
							  'type' => '='
							);	
        /* $post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							); */
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}							
	$other_where = '';
	if($this->user_account_type == SUBCONTRACTOR)
	{
		$post_array[] = array(
							'field_name' => 'PO_CO.assigned_to',
							'value'=> $this->user_session['ub_user_id'],
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'PO_CO.po_status',
							'value'=> 'Not Released ',
							'type' => '!='
							);
    }				
	if($this->user_account_type == BUILDERADMIN)
	{
		//role access checked -- code added by satheesh kumar
		if(isset($this->user_role_access[strtolower('budget')][strtolower('view all')]) && $this->user_role_access[strtolower('budget')][strtolower('view all')] == 0)
		{	
			if(isset($this->user_role_access[strtolower('budget')][strtolower('view created by me')]) && $this->user_role_access[strtolower('budget')][strtolower('view created by me')] == 1)
			{
				$other_where = ' AND (PO_CO.created_by = '.$this->user_session['ub_user_id'].' || PO_CO.assigned_to = '.$this->user_session['ub_user_id'].') ';	
			}
		}	
    }					
						
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//echo'<pre>';print_r($result);exit;
			$search_session_array=array();
			if(TRUE === $result['status'])
			{
				 if(isset($result['data']['due_date_time']) && $result['data']['due_date_time']!='')
				{
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($result['data']['due_date_time'])),
										'type' => '='
									);   
						$search_session_array['due_date_time'] = $result['data']['due_date_time'];
				}
				
                 // echo '<pre>';print_r($post_array);exit;
                if(isset($result['data']['po_status']) && $result['data']['po_status']!='' && $result['data']['po_status']!='Nothing selected' && $result['data']['po_status']!='null')
				{
					$post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $result['data']['po_status'], 
										'type' => '='
										);
					$search_session_array['po_status'] = $result['data']['po_status'];
				}
                // echo '<pre>';print_r($result);
				
                   if(isset($result['data']['payment_result']) && $result['data']['payment_result']!='' && $result['data']['payment_result']!='Nothing selected' && $result['data']['payment_result']!='null')
				{
					$post_array[] = array(
									'field_name' => 'PO_CO.payment_status',
									'value'=> $result['data']['payment_result'], 
									'type' => '='
									);
					$search_session_array['payment_status'] = $result['data']['payment_result'];
				} 	
				
				  if(isset($result['data']['costcode']) && $result['data']['costcode']!='' && $result['data']['costcode']!='Nothing selected' && $result['data']['costcode']!='null')
				{
					$post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $result['data']['costcode'], 
									'type' => '='
									);
					$search_session_array['costcode'] = $result['data']['costcode'];
				} 	 
				 // echo '<pre>';print_r($result['data']); 	
				/*
					Paggination length stored in seesion code start here
				*/
				// Setting session 
				$this->module = 'BUDGET_PO';

				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('po_search')['due_date_time']) && $this->uni_session_get('po_search')['due_date_time']!='')
				    {
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($this->uni_session_get('po_search')['due_date_time'])),
										'type' => '='
									);   
						//$search_session_array['due_date_time'] = $result['data']['due_date_time'];
				    }
				    if(isset($this->uni_session_get('po_search')['po_status']) && $this->uni_session_get('po_search')['po_status']!='' && $this->uni_session_get('po_search')['po_status']!='Nothing selected' && $this->uni_session_get('po_search')['po_status']!='null')
				    {
					  $post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $this->uni_session_get('po_search')['po_status'], 
										'type' => '='
										);
					//$search_session_array['po_status'] = $result['data']['po_status'];
				    }
				    if(isset($this->uni_session_get('po_search')['payment_status']) && $this->uni_session_get('po_search')['payment_status']!='' && $this->uni_session_get('po_search')['payment_status']!='Nothing selected' && $this->uni_session_get('po_search')['payment_status']!='null')
				    {
					  $post_array[] = array(
									'field_name' => 'PO_CO.payment_status',
									'value'=> $this->uni_session_get('po_search')['payment_status'], 
									'type' => '='
									);
					//$search_session_array['payment_status'] = $result['data']['payment_result'];
				    }
				    if(isset($this->uni_session_get('po_search')['costcode']) && $this->uni_session_get('po_search')['costcode']!='' && $this->uni_session_get('po_search')['costcode']!='Nothing selected' && $this->uni_session_get('po_search')['costcode']!='null')
				    {
					   $post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $this->uni_session_get('po_search')['costcode'], 
									'type' => '='
									);
					//$search_session_array['costcode'] = $result['data']['costcode'];
				   } 	 	

				}
				
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('po_search')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('po_search')['iDisplayLength'];

				$this->uni_set_session('po_search', $search_session_array);
				//echo '<pre>';print_r($this->session->all_userdata()); 
				$where_str = $this->Mod_po_co->build_where($post_array);
				if($other_where != '')
				{
					$where_str = $where_str.$other_where;
				}
				// echo '<pre>';print_r($where_str);exit;
				// Pagination Array
				$pagination_array = array();

				if(isset($this->uni_session_get('po_search')['iDisplayStart']) && isset($this->uni_session_get('po_search')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('po_search')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('po_search')['iDisplayLength'], 'sEcho' => 1);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code'=>'Yes','bid'=>'Yes'),
												 'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code'=>'Yes','bid'=>'Yes'),
												 'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}

				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code'=>'Yes','bid'=>'Yes'),
												 'group_clause' =>array("PO_CO.ub_po_co_number")
												));
												
				}*/
				// echo '<pre>';print_r($total_count_array);
				// echo '<pre>';print_r($total_count_array);exit;
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PO_CO.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'PO_CO.modified_on DESC';
				}
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		$date_array = array('PO_CO.due_date'=>'po_date');
		$query_array = array('select_fields' => array('PO_CO.project_id','PO_CO.ub_po_co_id','PO_CO.title','PO_CO.ub_po_co_number','BID.package_title','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS assigned_to','(PO_CO.due_date)AS po_date','PO_CO.po_status','PO_CO.work_completed','PO_CO.payment_status','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.bid_po_id,'.$this->Mod_user->format_user_datetime($date_array,"date")),
		'join'=> array('user'=>'Yes','builder'=>'Yes','po_co_cost_code' => 'Yes','bid'=>'Yes','project' => ''),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'group_clause' =>array("PO_CO.ub_po_co_number"),
		'pagination' => $pagination_array
	);
	 // echo '<pre>';print_r($query_array);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			//echo "hi";
			unset($query_array['pagination']);
		} 
		//echo "hi";
		$result_data = $this->Mod_po_co->get_po_co($query_array);
		if($page_count == 'result_array')
		{
			//print_r($result_data);exit;
			return $result_data;
		}
		//echo $this->read_db->last_query();exit;
		// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('title','ub_po_co_number','package_title','assigned_to','po_date','po_status','work_completed','payment_status','total_amount','paid_amount');
					
					// Export file header column 
					$export_array['header'][0] = array('Title','Po#','Related BID','Performed By','Est. Completion Date','Status','Work Completed','Paid','Cost','Total Paid'); 
					
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
					echo array_to_export($export_array,'uni_Po_list.xls','csv');exit;
				}
		// The following parameters required for data table

		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			 $count_array=count($total_count_array['aaData']);	
					
			$result_data['iTotalRecords'] = isset($count_array)?$count_array:'';
			$result_data['iTotalDisplayRecords'] = isset($count_array)?$count_array:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data

		$this->Mod_po_co->response($result_data);
	}
	/** 
	 * budget_co_list 
	 * 
	 * @package: co_list
	 * @subpackage: co_list
	 * @category: co_list
	 * @author: Gayathri
	 * @createdon(DD-MM-YYYY): 29-05-2015 12:13
	*/
	public function get_co($page_count = '')
	{
		 // echo "hiiii"; exit;
		$post_array[] = array(
							'field_name' => 'PO_CO.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'PO_CO.type',
							'value'=> 'CO', 
							'type' => '='
							);	
		$post_array[] = array(
							  'field_name' => 'PO_CO.is_delete',
							  'value'=> 'No', 
							  'type' => '='
							);	
        /* $post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							); */
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}								
	$other_where = '';
	if($this->user_account_type == SUBCONTRACTOR)
	{
		$post_array[] = array(
							'field_name' => 'PO_CO.assigned_to',
							'value'=> $this->user_session['ub_user_id'],
							'type' => '='
							);
		$post_array[] = array(
				'field_name' => 'PO_CO.po_status',
				'value'=> 'Not Released ',
				'type' => '!='
		);
    }				
	if($this->user_account_type == BUILDERADMIN)
	{
		//role access checked -- code added by satheesh kumar
		if(isset($this->user_role_access[strtolower('budget')][strtolower('view all')]) && $this->user_role_access[strtolower('budget')][strtolower('view all')] == 0)
		{	
			if(isset($this->user_role_access[strtolower('budget')][strtolower('view created by me')]) && $this->user_role_access[strtolower('budget')][strtolower('view created by me')] == 1)
			{
				$other_where = ' AND (PO_CO.created_by = '.$this->user_session['ub_user_id'].' || PO_CO.assigned_to = '.$this->user_session['ub_user_id'].') ';
			}
		}	
    }					
									
						
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			
			if(TRUE === $result['status'])
			{
				if($this->user_account_type == SUBCONTRACTOR)
				{
					if(isset($result['data']['co_due_date_time']) && $result['data']['co_due_date_time']!='')
				    {
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($result['data']['co_due_date_time'])),
										'type' => '='
									);   
						$search_session_array['co_due_date_time'] = $result['data']['co_due_date_time'];
				   }
					if(isset($result['data']['co_status']) && $result['data']['co_status']!='' && $result['data']['co_status']!='Nothing selected' && $result['data']['co_status']!='null')
				   {
					$post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $result['data']['co_status'], 
										'type' => '='
										);
					$search_session_array['co_status'] = $result['data']['co_status'];
				  }
                // echo '<pre>';print_r($result);
				
                   if(isset($result['data']['co_payment_result']) && $result['data']['co_payment_result']!='' && $result['data']['co_payment_result']!='Nothing selected' && $result['data']['co_payment_result']!='null')
				    {
					$post_array[] = array(
									'field_name' => 'PO_CO.payment_status',
									'value'=> $result['data']['co_payment_result'], 
									'type' => '='
									);
					$search_session_array['co_payment_status'] = $result['data']['co_payment_result'];
				   }
				}

			     
				
                 // echo '<pre>';print_r($post_array);exit;
				
				else
				{
					if(isset($result['data']['co_due_date_time']) && $result['data']['co_due_date_time']!='')
				    {
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($result['data']['co_due_date_time'])),
										'type' => '='
									);   
						$search_session_array['co_due_date_time'] = $result['data']['co_due_date_time'];
				   }
                if(isset($result['data']['co_status']) && $result['data']['co_status']!='' && $result['data']['co_status']!='Nothing selected' && $result['data']['co_status']!='null')
				{
					$post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $result['data']['co_status'], 
										'type' => '='
										);
					$search_session_array['co_status'] = $result['data']['co_status'];
				}
                // echo '<pre>';print_r($result);
				
                   if(isset($result['data']['co_payment_result']) && $result['data']['co_payment_result']!='' && $result['data']['co_payment_result']!='Nothing selected' && $result['data']['co_payment_result']!='null')
				{
					$post_array[] = array(
									'field_name' => 'PO_CO.payment_status',
									'value'=> $result['data']['co_payment_result'], 
									'type' => '='
									);
					$search_session_array['co_payment_status'] = $result['data']['co_payment_result'];
				}
				 if(isset($result['data']['costcode']) && $result['data']['costcode']!='' && $result['data']['costcode']!='Nothing selected' && $result['data']['costcode']!='null')
				{
					$post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $result['data']['costcode'], 
									'type' => '='
									);
					$search_session_array['costcode'] = $result['data']['costcode'];
				} 
					
			}
               	// echo '<pre>';print_r($result);exit;
				/*
					Paggination length stored in seesion code start here
				*/
				
				// Setting session 
				$this->module = 'BUDGET_CO';

				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('co_search')['co_due_date_time']) && $this->uni_session_get('co_search')['co_due_date_time']!='')
				    {
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($this->uni_session_get('co_search')['co_due_date_time'])),
										'type' => '='
									);   
						//$search_session_array['due_date_time'] = $result['data']['due_date_time'];
				    }
				    if(isset($this->uni_session_get('co_search')['co_status']) && $this->uni_session_get('co_search')['co_status']!='' && $this->uni_session_get('co_search')['co_status']!='Nothing selected' && $this->uni_session_get('co_search')['co_status']!='null')
				    {
					  $post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $this->uni_session_get('co_search')['co_status'], 
										'type' => '='
										);
					//$search_session_array['po_status'] = $result['data']['po_status'];
				    }
				    if(isset($this->uni_session_get('co_search')['co_payment_status']) && $this->uni_session_get('co_search')['co_payment_status']!='' && $this->uni_session_get('co_search')['co_payment_status']!='Nothing selected' && $this->uni_session_get('co_search')['co_payment_status']!='null')
				    {
					  $post_array[] = array(
									'field_name' => 'PO_CO.payment_status',
									'value'=> $this->uni_session_get('co_search')['co_payment_status'], 
									'type' => '='
									);
					//$search_session_array['payment_status'] = $result['data']['payment_result'];
				    }
				    if(isset($this->uni_session_get('co_search')['costcode']) && $this->uni_session_get('co_search')['costcode']!='' && $this->uni_session_get('co_search')['costcode']!='Nothing selected' && $this->uni_session_get('co_search')['costcode']!='null')
				    {
					   $post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $this->uni_session_get('co_search')['costcode'], 
									'type' => '='
									);
					//$search_session_array['costcode'] = $result['data']['costcode'];
				   } 	 	

				}

				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('co_search')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('co_search')['iDisplayLength'];

				if(isset($search_session_array))
				{
				$this->uni_set_session('co_search', $search_session_array);
				}
				$where_str = $this->Mod_po_co->build_where($post_array);
				if($other_where != '')
				{
					$where_str = $where_str.$other_where;
				}
				// Pagination Array
				$pagination_array = array();
				if(isset($this->uni_session_get('co_search')['iDisplayStart']) && isset($this->uni_session_get('co_search')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('co_search')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('co_search')['iDisplayLength'], 'sEcho' => 1);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.	ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.	ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}
				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.	ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
												
				}*/
				 // echo '<pre>';print_r(count($total_count_array['aaData']));exit;
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PO_CO.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'PO_CO.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		//$date_array = array('TASK.due_date'=> 'due_date');
		$date_array = array('PO_CO.due_date'=>'po_date');
		$query_array = array('select_fields' => array('PO_CO.title','PO_CO.ub_po_co_number','BID.package_title','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS assigned_to','(PO_CO.due_date)AS po_date','PO_CO.po_status','PO_CO.work_completed','PO_CO.payment_status','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.ub_po_co_id,'.$this->Mod_user->format_user_datetime($date_array,"date")),
		'join'=> array('user'=>'Yes','builder'=>'Yes','po_co_cost_code' => 'Yes','bid'=>'Yes','project' => ''),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where,
		'group_clause' =>array("PO_CO.ub_po_co_number"),		
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_po_co->get_po_co($query_array);
		if($page_count == 'result_array')
        {
	      //print_r($result_data);exit;
	      return $result_data;
        }
		//echo '<pre>';print_r($result['data']);exit;
		// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('title','ub_po_co_number','package_title','assigned_to','po_date','po_status','work_completed','payment_status','total_amount','paid_amount');
					
					// Export file header column 
					$export_array['header'][0] = array('Title','Po#','Related BID','Performed By','Est. Completion Date','Status','Work Completed','Paid','Cost','Total Paid'); 
					
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
					echo array_to_export($export_array,'uni_Co_list.xls','csv');exit;
				}
		// The following parameters required for data table

		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			$count_array=count($total_count_array['aaData']);	
			$result_data['iTotalRecords'] = isset($count_array)?$count_array:'';
			$result_data['iTotalDisplayRecords'] = isset($count_array)?$count_array:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data

		$this->Mod_po_co->response($result_data);
	}

	/** 
	 * budget_owner_co_list 
	 * 
	 * @package: budget_owner_co_list
	 * @subpackage: budget_owner_co_list
	 * @category: budget_owner_co_list
	 * @author: Sidhartha
	 * @createdon(DD-MM-YYYY): 29-05-2015 12:13
	*/
	public function get_owner_co($page_count = '')
	{
		 // echo "hiiii"; exit;
		$post_array[] = array(
							'field_name' => 'PO_CO.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'PO_CO.type',
							'value'=> 'OWNER CO', 
							'type' => '='
							);	
		$post_array[] = array(
							  'field_name' => 'PO_CO.is_delete',
							  'value'=> 'No', 
							  'type' => '='
							);	
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}						
															
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			// echo '<pre>';print_r($result);exit;
			if(TRUE === $result['status'])
			{
			
				if(isset($result['data']['owner_co_due_date_time']) && $result['data']['owner_co_due_date_time']!='')
				{
					// $formatted_date = explode(" ",$result['data']['daterange']);
					$post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($result['data']['owner_co_due_date_time'])),
										'type' => '='
					);   
					$search_session_array['owner_co_due_date_time'] = $result['data']['owner_co_due_date_time'];
				} 
				   
				   // echo '<pre>';print_r($post_array); 	
                 if(isset($result['data']['co_status']) && $result['data']['co_status']!='' && $result['data']['co_status']!='Nothing selected' && $result['data']['co_status']!='null')
				{
					$post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $result['data']['co_status'], 
										'type' => '='
										);
					$search_session_array['owner_co_status'] = $result['data']['co_status'];
				}
                 // echo '<pre>';print_r($post_array);
				
				 if(isset($result['data']['costcode']) && $result['data']['costcode']!='' && $result['data']['costcode']!='Nothing selected' && $result['data']['costcode']!='null')
				{
					$post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $result['data']['costcode'], 
									'type' => '='
									);
					$search_session_array['costcode'] = $result['data']['costcode'];
				} 
				 // echo '<pre>';print_r($post_array);
				/*
					Paggination length stored in seesion code start here
				*/
			

				$this->module = 'BUDGET_OWNER_CO';

				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('owner_co_search')['owner_co_due_date_time']) && $this->uni_session_get('owner_co_search')['owner_co_due_date_time']!='')
				    {
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($this->uni_session_get('owner_co_search')['owner_co_due_date_time'])),
										'type' => '='
									);   
						//$search_session_array['due_date_time'] = $result['data']['due_date_time'];
				    }
				    if(isset($this->uni_session_get('owner_co_search')['owner_co_status']) && $this->uni_session_get('owner_co_search')['owner_co_status']!='' && $this->uni_session_get('owner_co_search')['owner_co_status']!='Nothing selected' && $this->uni_session_get('owner_co_search')['owner_co_status']!='null')
				    {
					  $post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $this->uni_session_get('owner_co_search')['owner_co_status'], 
										'type' => '='
										);
					//$search_session_array['po_status'] = $result['data']['po_status'];
				    }
				    
				    if(isset($this->uni_session_get('owner_co_search')['costcode']) && $this->uni_session_get('owner_co_search')['costcode']!='' && $this->uni_session_get('owner_co_search')['costcode']!='Nothing selected' && $this->uni_session_get('owner_co_search')['costcode']!='null')
				    {
					   $post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $this->uni_session_get('owner_co_search')['costcode'], 
									'type' => '='
									);
					//$search_session_array['costcode'] = $result['data']['costcode'];
				   } 	 	

				}

				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('owner_co_search')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('owner_co_search')['iDisplayLength'];

				if(isset($search_session_array))
				{
				$this->uni_set_session('owner_co_search', $search_session_array);
				}
				$where_str = $this->Mod_po_co->build_where($post_array);
				// Pagination Array
				$pagination_array = array();

				if(isset($this->uni_session_get('owner_co_search')['iDisplayStart']) && isset($this->uni_session_get('owner_co_search')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('owner_co_search')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('owner_co_search')['iDisplayLength'], 'sEcho' => 1);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.	ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.	ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}

				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.	ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
												
				}*/
				// echo '<pre>';print_r(count($total_count_array['aaData']));exit;
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PO_CO.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'PO_CO.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		//$datetime_array = array('PO_CO.created_on'=> 'created_on','PO_CO.due_date'=> 'due_date');
		$datetime_array = array('PO_CO.created_on'=> 'created_on');
	    $date_array = array('PO_CO.due_date'=> 'due_date');
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('PO_CO.ub_po_co_id','PO_CO.ub_po_co_number','PO_CO.title','PO_CO.scope_of_work','PO_CO.po_status','PO_CO.created_on','PO_CO.due_date','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS assigned_to,'.$this->Mod_user->format_user_datetime($date_array,"date"). ','.$this->Mod_user->format_user_datetime($datetime_array)),
		'join'=> array('user'=>'Yes','builder'=>'Yes','po_co_cost_code' => 'Yes','project' => ''),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where,
		'group_clause' =>array("PO_CO.ub_po_co_number"),		
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_po_co->get_po_co($query_array);
		if($page_count == 'result_array')
	    {
		  //print_r($result_data);exit;
		  return $result_data;
	    }
		//echo '<pre>';print_r($result['data']);exit;
		// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('title','scope_of_work','po_status','created_on','due_date','assigned_to');
					
					// Export file header column 
					$export_array['header'][0] = array('Title','Description','Status','Date Created','Expected Completion','Assign to Sub'); 
					
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
					echo array_to_export($export_array,'uni_owner_co_list.xls','csv');exit;
				}
		// The following parameters required for data table

		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
			$count_array=count($total_count_array['aaData']);	
			$result_data['iTotalRecords'] = isset($count_array)?$count_array:'';
			$result_data['iTotalDisplayRecords'] = isset($count_array)?$count_array:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data

		$this->Mod_po_co->response($result_data);
	}
	/** 
	 * budget_owner_po_list 
	 * 
	 * @package: budget_owner_po_list
	 * @subpackage: budget_owner_po_list
	 * @category: budget_owner_po_list
	 * @author: Sidhartha
	 * @createdon(DD-MM-YYYY): 29-05-2015 12:13
	*/
	public function get_owner_po($page_count = '')
	{
		 // echo "hiiii"; exit;
		$post_array[] = array(
							'field_name' => 'PO_CO.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'PO_CO.type',
							'value'=> 'OWNER PO', 
							'type' => '='
							);
		$post_array[] = array(
							  'field_name' => 'PO_CO.is_delete',
							  'value'=> 'No', 
							  'type' => '='
							);	
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);
		}
		else
		{
			$post_array[] = array(
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}	
      											
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			
			if(TRUE === $result['status'])
			{
			
				if(isset($result['data']['owner_po_due_date_time']) && $result['data']['owner_po_due_date_time']!='')
				{
					
					// $formatted_date = explode(" ",$result['data']['daterange']);
					$post_array[] = array(
									'field_name' =>'PO_CO.due_date',
									'value'=> date("Y-m-d", strtotime($result['data']['owner_po_due_date_time'])),
									'type' => '='
								);   
					$search_session_array['owner_po_due_date_time'] = $result['data']['owner_po_due_date_time'];
			   } 
				   
				   // echo '<pre>';print_r($post_array); 	
                 if(isset($result['data']['ownerpostatus']) && $result['data']['ownerpostatus']!='' && $result['data']['ownerpostatus']!='Nothing selected' && $result['data']['ownerpostatus']!='null')
				{
					$post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $result['data']['ownerpostatus'], 
										'type' => '='
										);
					$search_session_array['owner_po_status'] = $result['data']['ownerpostatus'];
				}
                  // echo '<pre>';print_r($post_array);
				
				 if(isset($result['data']['costcode']) && $result['data']['costcode']!='' && $result['data']['costcode']!='Nothing selected' && $result['data']['costcode']!='null')
				{
					$post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $result['data']['costcode'], 
									'type' => '='
									);
					$search_session_array['costcode'] = $result['data']['costcode'];
				}
				 if(isset($result['data']['costcode']) && $result['data']['costcode']!='' && $result['data']['costcode']!='Nothing selected' && $result['data']['costcode']!='null')
				{
					$post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $result['data']['costcode'], 
									'type' => '='
									);
					$search_session_array['costcode'] = $result['data']['costcode'];
				}
				
				/*
					Paggination length stored in seesion code start here
				*/
				
				
				$this->module = 'BUDGET_OWNER_PO';

				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('owner_po_search')['owner_po_due_date_time']) && $this->uni_session_get('owner_po_search')['owner_po_due_date_time']!='')
				    {
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($this->uni_session_get('owner_po_search')['owner_po_due_date_time'])),
										'type' => '='
									);   
						//$search_session_array['due_date_time'] = $result['data']['due_date_time'];
				    }
				    if(isset($this->uni_session_get('owner_po_search')['owner_po_status']) && $this->uni_session_get('owner_po_search')['owner_po_status']!='' && $this->uni_session_get('owner_po_search')['owner_po_status']!='Nothing selected' && $this->uni_session_get('owner_po_search')['owner_po_status']!='null')
				    {
					  $post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $this->uni_session_get('owner_po_search')['owner_po_status'], 
										'type' => '='
										);
					//$search_session_array['po_status'] = $result['data']['po_status'];
				    }
				    
				    if(isset($this->uni_session_get('owner_po_search')['costcode']) && $this->uni_session_get('owner_po_search')['costcode']!='' && $this->uni_session_get('owner_po_search')['costcode']!='Nothing selected' && $this->uni_session_get('owner_po_search')['costcode']!='null')
				    {
					   $post_array[] = array(
									'field_name' => 'PO_CO_COST_CODE.cost_code_id',
									'value'=> $this->uni_session_get('owner_po_search')['costcode'], 
									'type' => '='
									);
					//$search_session_array['costcode'] = $result['data']['costcode'];
				   } 	 	

				}

				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('owner_po_search')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('owner_po_search')['iDisplayLength'];

				if(isset($search_session_array))
				{
				$this->uni_set_session('owner_po_search', $search_session_array);
				}
				$where_str = $this->Mod_po_co->build_where($post_array);
				
				// Pagination Array
				$pagination_array = array();
				if(isset($this->uni_session_get('owner_po_search')['iDisplayStart']) && isset($this->uni_session_get('owner_po_search')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('owner_po_search')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('owner_po_search')['iDisplayLength'], 'sEcho' => 1);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
				}
				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.ub_po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','po_co_cost_code' => 'Yes'),
												'group_clause' =>array("PO_CO.ub_po_co_number")
												));
												
				}*/
				// echo '<pre>';print_r(count($total_count_array['aaData']));exit;
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PO_CO.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'PO_CO.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		// $datetime_array = array('PO_CO.created_on'=> 'created_on','PO_CO.due_date'=> 'due_date');
		$datetime_array = array('PO_CO.created_on'=> 'created_on');
	    $date_array = array('PO_CO.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('PO_CO.project_id','PO_CO.ub_po_co_id','PO_CO.ub_po_co_number','PO_CO.title','PO_CO.scope_of_work','PO_CO.po_status','PO_CO.created_on','PO_CO.due_date','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS assigned_to,'.$this->Mod_user->format_user_datetime($date_array,"date"). ','.$this->Mod_user->format_user_datetime($datetime_array)),
		'join'=> array('user'=>'Yes','builder'=>'Yes','po_co_cost_code' => 'Yes','project' => ''),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where,
		'group_clause' =>array("PO_CO.ub_po_co_number"),		
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_po_co->get_po_co($query_array);
		if($page_count == 'result_array')
	    {
		  //print_r($result_data);exit;
		  return $result_data;
	    }
		//echo '<pre>';print_r($result['data']);exit;
		// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('title','scope_of_work','po_status','created_on','due_date','assigned_to');
					
					// Export file header column 
					$export_array['header'][0] = array('Title','Description','Status','Date Created','Expected Completion','Assign to Sub'); 
					
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
					echo array_to_export($export_array,'uni_Co_list.xls','csv');exit;
				}
		// The following parameters required for data table

		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
	$count_array=count($total_count_array['aaData']);
					
			$result_data['iTotalRecords'] = isset($count_array)?$count_array:'';
			$result_data['iTotalDisplayRecords'] = isset($count_array)?$count_array:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// echo '<pre>';print_r($result_data['iTotalDisplayRecords']);
		// Response data

		$this->Mod_po_co->response($result_data);
	}
	/** 
	 * budget_jobs_list 
	 * 
	 * @package: jobs_list
	 * @subpackage: jobs_list
	 * @category: jobs_list
	 * @author: Gayathri Kalyani
	 * @createdon(DD-MM-YYYY): 05-06-2015 12:13
	*/
	public function get_jobs($page_count = '')
	{
		 // echo "hiiii"; exit;
		$post_array[] = array(
							'field_name' => 'ESTIMATE.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		if(!empty($this->project_id))
		{
			$post_array[] = array(
							'field_name' => 'ESTIMATE.project_id',
							'value'=> $this->project_id, 
							'type' => '='
						);
		}  					
		else
		{
			$post_array[] = array(
							'field_name' => 'ESTIMATE.project_id',
							'value'=> $this->users_project_ids, 
							'type' => '||',
							'classification' => 'primary_ids'
						);
		}
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			if(TRUE === $result['status'])
			{
				 	
				$where_str = $this->Mod_po_co->build_where($post_array);
				
				//role access checked -- code added by satheesh kumar
				if(isset($this->user_role_access[strtolower('budget')][strtolower('view all')]) && $this->user_role_access[strtolower('budget')][strtolower('view all')] == 0)
				{	
					if(isset($this->user_role_access[strtolower('budget')][strtolower('view created by me')]) && $this->user_role_access[strtolower('budget')][strtolower('view created by me')] == 1)
					{
						$where_str = $where_str.'AND ESTIMATE.created_by = '. $this->user_id;					
					}
				}

				// Setting session 
				$this->module = 'BUDGET_JOBS';
				
				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('jobs_search')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('jobs_search')['iDisplayLength'];

				$this->uni_set_session('jobs_search', $search_session_array);

				// Pagination Array
				$pagination_array = array();

				if(isset($this->uni_session_get('jobs_search')['iDisplayStart']) && isset($this->uni_session_get('jobs_search')['iDisplayLength']))
				{
					$pagination_array = array( 'iDisplayStart' => $this->uni_session_get('jobs_search')['iDisplayStart'],'iDisplayLength' => $this->uni_session_get('jobs_search')['iDisplayLength'], 'sEcho' => 1);

					$total_count_array = $this->Mod_po_co->get_jobs(array(
												'select_fields' => array('COUNT(ESTIMATE.ub_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					$total_count_array = $this->Mod_po_co->get_jobs(array(
												'select_fields' => array('COUNT(ESTIMATE.ub_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
				}

				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_jobs(array(
												'select_fields' => array('COUNT(ESTIMATE.ub_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
												
				}*/
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'ESTIMATE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'ESTIMATE.cost_code_name ASC';
				}
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
						
		//datatable column role access
		$headers = $this->user_role_access[strtolower('budget')];
		$role_based_query = array(strtolower('Cost Code Item') => 'ESTIMATE.cost_code_name',
				strtolower('Budget') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.budget_amount,2,'".CURRENCY_FORMAT_TEXT."')) AS budget_amount",
				strtolower('Client contract') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.client_contract,2,'".CURRENCY_FORMAT_TEXT."')) AS client_contract",
				strtolower('Client Contract Count') => 'ESTIMATE.client_contract_count',
				strtolower('Client CO') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.client_co,2,'".CURRENCY_FORMAT_TEXT."')) AS client_co",
				strtolower('Client CO Count') =>'ESTIMATE.client_co_count',
				strtolower('Estimated Revenue') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.estimated_revenue,2,'".CURRENCY_FORMAT_TEXT."')) AS estimated_revenue",
				strtolower('(+/-) Budget') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.plus_minus_budget,2,'".CURRENCY_FORMAT_TEXT."')) AS plus_minus_budget",
				strtolower('Vendor Contract') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.po_awarded_amount,2,'".CURRENCY_FORMAT_TEXT."')) AS po_awarded_amount",
				strtolower('PO') => 'ESTIMATE.po_release_count',
				strtolower('Change Order(+/-)') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.co_awarded_amount,2,'".CURRENCY_FORMAT_TEXT."')) AS co_awarded_amount",
				strtolower('CO') => 'ESTIMATE.co_count',
				strtolower('Total Vendor Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(((ESTIMATE.po_awarded_amount)+(ESTIMATE.co_awarded_amount)),2,'".CURRENCY_FORMAT_TEXT."')) AS total_vendor_cost",
				strtolower('Overhead / Inhouse') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.overhead_cost,2,'".CURRENCY_FORMAT_TEXT."')) AS overhead_cost",
				strtolower('Estimated Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.estimated_profit_amount,2,'".CURRENCY_FORMAT_TEXT."')) AS estimated_profit_amount",
				strtolower('Billed To Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.bill_to_client_to_date,2,'".CURRENCY_FORMAT_TEXT."')) AS bill_to_client_to_date",
				strtolower('Balance TO Bill To Client') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.balance_to_bill_client,2,'".CURRENCY_FORMAT_TEXT."')) AS balance_to_bill_client",
				strtolower('Paid By Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.paid_by_client_to_date,2,'".CURRENCY_FORMAT_TEXT."')) AS paid_by_client_to_date",
				strtolower('Unpaid Client Billings') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.unpaid_client_billing,2,'".CURRENCY_FORMAT_TEXT."')) AS unpaid_client_billing",
				strtolower('Invoiced by Sub to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.invoiced_by_sub_to_date,2,'".CURRENCY_FORMAT_TEXT."')) AS invoiced_by_sub_to_date",
				strtolower('Amount Paid To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.amount_paid_to_sub,2,'".CURRENCY_FORMAT_TEXT."')) AS amount_paid_to_sub",
				strtolower('Balance to be Invoiced By Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.balance_to_be_invoiced_by_sub,2,'".CURRENCY_FORMAT_TEXT."')) AS balance_to_be_invoiced_by_sub",
				strtolower('Total Balance Owed To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.total_balance_owed_to_sub,2,'".CURRENCY_FORMAT_TEXT."')) AS total_balance_owed_to_sub",
				strtolower('Total Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.total_cost,2,'".CURRENCY_FORMAT_TEXT."')) AS total_cost",
				strtolower('Profit To Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.profit_to_date,2,'".CURRENCY_FORMAT_TEXT."')) AS profit_to_date",
				strtolower('Overall Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(ESTIMATE.overall_profit,2,'".CURRENCY_FORMAT_TEXT."')) AS overall_profit"
			  );	
		$select_query = array();
		$select_query[0] = 'ESTIMATE.ub_estimate_id';
		$select_query[1] = 'ESTIMATE.cost_code_id';
		$select_query[2] = $role_based_query[strtolower('Cost Code Item')];
		$select_query[3] = $role_based_query[strtolower('Budget')];
		$select_query[4] = 'ESTIMATE.po_count';
		$i=5;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($role_based_query[$key]))
				{
					$select_query[$i] = $role_based_query[$key];
					$i++;
				}
			}
		}
		
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => $select_query, //array('ESTIMATE.ub_estimate_id','ESTIMATE.cost_code_id','ESTIMATE.cost_code_name','ESTIMATE.budget_amount','ESTIMATE.client_contract','ESTIMATE.client_contract_count','ESTIMATE.client_co','ESTIMATE.client_co_count','ESTIMATE.estimated_revenue','ESTIMATE.plus_minus_budget','ESTIMATE.po_awarded_amount','ESTIMATE.po_count','ESTIMATE.co_awarded_amount','ESTIMATE.co_count','((ESTIMATE.po_awarded_amount)+(ESTIMATE.co_awarded_amount)) AS total_vendor_cost','ESTIMATE.overhead_cost','ESTIMATE.estimated_profit_amount','ESTIMATE.bill_to_client_to_date','ESTIMATE.balance_to_bill_client','ESTIMATE.paid_by_client_to_date','ESTIMATE.unpaid_client_billing','ESTIMATE.invoiced_by_sub_to_date','ESTIMATE.amount_paid_to_sub','ESTIMATE.balance_to_be_invoiced_by_sub','ESTIMATE.total_balance_owed_to_sub','ESTIMATE.total_cost','ESTIMATE.profit_to_date','ESTIMATE.overall_profit'),
		'join'=> array('builder'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		// 'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_po_co->get_jobs($query_array);
		if($page_count == 'result_array')
        {
	      //print_r($result_data);exit;
	      return $result_data;
        }
		// File export request  
		if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			$budget_jobs_column_array = array(
					  strtolower('Cost Code Item') => 'cost_code_name',
					  strtolower('Budget') =>  'budget_amount',
					  strtolower('Client contract') => 'client_contract',
					  strtolower('Client Contract Count') =>  'client_contract_count',
					  strtolower('Client CO') => 'client_co',
					  strtolower('Client CO Count') => 'client_co_count',
					  strtolower('Estimated Revenue') => 'estimated_revenue',
					  strtolower('(+/-) Budget') => 'plus_minus_budget',
					  strtolower('Vendor Contract') => 'po_awarded_amount',
					  strtolower('PO') => 'po_count',
					  strtolower('Change Order(+/-)') => 'co_awarded_amount',
					  strtolower('CO') => 'co_count',
					  strtolower('Total Vendor Cost') => 'total_vendor_cost',
					  strtolower('Overhead / Inhouse') => 'overhead_cost',
					  strtolower('Estimated Profit')  => 'estimated_profit_amount',
					  strtolower('Billed To Client to Date') => 'bill_to_client_to_date',
					  strtolower('Balance TO Bill To Client')=> 'balance_to_bill_client',
					  strtolower('Paid By Client to Date') => 'paid_by_client_to_date',
					  strtolower('Unpaid Client Billings') => 'unpaid_client_billing',
					  strtolower('Invoiced by Sub to Date') =>'invoiced_by_sub_to_date',
					  strtolower('Amount Paid To Sub')  => 'amount_paid_to_sub',
					  strtolower('Balance to be Invoiced By Sub')  => 'balance_to_be_invoiced_by_sub',
					  strtolower('Total Balance Owed To Sub')  => 'total_balance_owed_to_sub',
					  strtolower('Total Cost') => 'total_cost',
					  strtolower('Profit To Date') => 'profit_to_date',
					  strtolower('Overall Profit') => 'overall_profit'
					  );	  
			$data['export_headers_budget_jobs'][0] = 'Cost Code Item';
			$data['export_headers_budget_jobs'][1] = 'Budget';
			$data['export_column_budget_jobs'][0] = $budget_jobs_column_array[strtolower('Cost Code Item')];
			$data['export_column_budget_jobs'][1] = $budget_jobs_column_array[strtolower('Budget')];
			$j=2;
			// echo '<pre>';print_r($headers);exit;
			foreach($headers as $header_key => $val)				
			{
				if($headers[$header_key] == 1)
				{
					if(isset($budget_jobs_column_array[$header_key]))
					{
						$data['export_headers_budget_jobs'][$j] = ucfirst($header_key);
						$data['export_column_budget_jobs'][$j] = $budget_jobs_column_array[$header_key];
						$j++;
					}
				}	
			}	
			$field_list_array = $data['export_column_budget_jobs'];
			$export_array['header'][0] = $data['export_headers_budget_jobs'];
			// echo '<pre>';print_r($data);exit;
			// $field_list_array = array('cost_code_name','budget_amount','client_contract','client_co','client_co_count','estimated_revenue','plus_minus_budget','po_awarded_amount','po_count','co_awarded_amount','co_count','total_vendor_cost','overhead_cost','estimated_profit_amount','bill_to_client_to_date','balance_to_bill_client','paid_by_client_to_date','unpaid_client_billing','invoiced_by_sub_to_date','amount_paid_to_sub','balance_to_be_invoiced_by_sub','total_balance_owed_to_sub','total_cost','profit_to_date','overall_profit');
			
			// Export file header column 
			// $export_array['header'][0] = array('Cost Code Item','Budget','Client contract','Client Co','Client Co Count','Estimated Revenue','(+/-)Budget','Vendor Contract','PO','Change Order(+/-)','CO','Total Vendor Cost','Overhead / Inhouse','Estimated Profit','Billed To Client to Date','Balance TO Bill To Client','Paid By Client to Date','Unpaid Client Billings','Invoiced by Sub to Date','Amount Paid To Sub','Balance to be Invoiced By Sub','Total Balance Owed To Sub','Total Cost','Profit To Date','Overall Profit'); 
			
			// echo '<pre>';print_r($field_list_array);
			// echo '<pre>';print_r($export_array);exit;
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
			// echo '<pre>';print_r($export_array);exit;
			echo array_to_export($export_array,'uni_Jobslist.xls','csv');exit;
		}
		// The following parameters required for data table

		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
					
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data

		$this->Mod_po_co->response($result_data);
	}
	/** 
	* Save PO CO
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function save_po_co($type,$ub_po_co_id = 0, $bid_po_id = 0, $bid_po_user_id=0, $sub_id=0,$project_ids=0)

	{
	// $this->benchmark->mark('code_start');
		if($type == 'OWNER CO' || $type == 'OWNER PO')
		{
			$content = 'content/budget/save_owner_co';
		}
		else
		{
			$content = 'content/budget/save_po_co';
		}
		if($type == 'OWNER PO')
		{
			$title = 'CLIENT PO';
		}
		else if($type == 'OWNER CO')
		{
			$title = 'CLIENT CO';
		}
		else
		{
			$title = $type;
		}
		$data = array(
		'title'        						=> $title,		
		'content'     						=> $content,
        'page_id'      						=> 'budget',
		'data_table'   						=> 'data_table',		     
		'po_scope_list'   					=> 'po_scope_list',		     
		'po_status_list'   					=> 'po_status_list',		     			     
		'po_bids_list'   					=> 'po_bids_list',		     
		'po_payment_list'   				=> 'po_payment_list',
		'type'								=> $type,
		'bid_po_id'		                    => $bid_po_id,
		'bid_po_user_id'		            => $bid_po_user_id,
		'projects_id'                       => $project_ids,
		'po_vocher_payment_list'   			=> 'po_vocher_payment_list'		     
		);
		//echo $project_id;exit;
		//get project id from task table // by satheesh kumar
		/*if($project_id > 0)
		{
			$this->project_id = $project_id;
		}*/
		if(empty($this->project_id) && $ub_po_co_id > 0)
		{
		$where_args = array('ub_po_co_id' => $ub_po_co_id);
		$project_id = $this->Mod_project->get_project_id(UB_PO_CO,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		if($project_ids > 0 && $type!='PO')
		{
		$where_args = array('ub_po_co_id' => $bid_po_id);
		$project_id = $this->Mod_project->get_project_id(UB_PO_CO,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		if($project_ids > 0 && $type=='PO')
		{
		$where_args = array('ub_bid_request_id' => $bid_po_id);
		$project_id = $this->Mod_project->get_project_id(UB_BID_REQUEST,$where_args);
		$this->project_id = $project_id['aaData'][0]['project_id'];
		$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		//end code for get project id
		
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => 'poco'))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
		{
				$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
		}

		$dir_response = $this->Mod_doc->create_default_dir();
		
		if ($dir_response['status'] == TRUE) 
		{
			$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
		}
		else
		{
		  $data['temprory_dir_id'] = '1';	
		}
		//Codition check wheather the ub_po_co_id value is greater than 0 or not
		if($ub_po_co_id > 0 || null!==$this->input->post('ub_po_co_id') && $this->input->post('ub_po_co_id') > 0)
		{
			$this->ub_po_co_id = (null!=$this->input->post('ub_po_co_id') && $this->input->post('ub_po_co_id') > 0) ? $this->input->post('ub_po_co_id') : $ub_po_co_id;
			$task_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => 'poco',
								  'moduleid' => $this->ub_po_co_id,
								);
			$result_array = $this->Mod_doc->get_files_for_folder($task_data);

			//echo "<pre>";print_r($result_array);exit;

			$count = count($result_array);

			$session_id = $this->session->userdata('session_id');
			
			for ($i=0; $i < $count ; $i++)
			{
				if(isset($result_array[$i]['system_file_name']) && !empty($result_array[$i]['system_file_name']))
				{
					$exp = explode('/', DOC_PATH.$result_array[$i]['system_file_name']);
					$thumb_array = array(
											'source_image' => DOC_PATH.$result_array[$i]['system_file_name'],
											'new_image' => DOC_TEMP_PATH.$session_id.'/'.$dir_response['thumbnail_path'].'/'.$exp[count($exp)-1]
									);
					$this->create_thumb($thumb_array);
					//$image_path = $result_array[$i]['system_file_name'];
					copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);
				}

			}
			
			 if(!empty($this->input->post()))
		     {
		 	  //Sanitize input
			  $result = $this->sanitize_input();
			  //print_r($result);
			  if(TRUE === $result['status'])
			  {
			  	
			  	if(isset($result['data']['due_date']) && $result['data']['due_date'] !='')
			    {
				  $result['data']['due_date'] = date("Y-m-d", strtotime($result['data']['due_date']));
			    }
			    if(isset($result['data']['assigned_to']) && $result['data']['assigned_to'] !== null && $result['data']['assigned_to']!='Nothing selected')
			    {
			   
					$result['data']['assigned_to'] =  $result['data']['assigned_to'];
				}
				else
				{
					$result['data']['assigned_to'] = '';
				}
				if($this->user_account_type == OWNER && !isset($result['data']['assigned_to']) && $result['data']['assigned_to'] == null && $result['data']['assigned_to']=='Nothing selected' || $result['data']['assigned_to'] == '')
				{
					//$result['data']['assigned_to'] = '1';
					$assign_builder = $this->Mod_project->get_assigned_role_ids(array(
					'select_fields' => array('PROJECTASSIGNED.assigned_to'),
					'where_clause' => (array('PROJECTASSIGNED.project_id' => $result['data']['project_id'],'PROJECTASSIGNED.role_id' => BUILDER_ADMIN_ROLE_ID))
					));
					if($assign_builder['status'] == TRUE)
					{
						$result['data']['assigned_to'] =  $assign_builder['aaData'][0]['assigned_to'];
					}
				}
				$po_co_update_array = array(
				'ub_po_co_id' => $result['data']['ub_po_co_id'],
			  	'builder_id' => $this->user_session['builder_id'],
			  	'project_id' => $result['data']['project_id'],
			  	'type' => $result['data']['type'],
			  	'title' => $result['data']['title'],
			  	'assigned_to' => $result['data']['assigned_to'],
			  	'bid_po_id' => isset($result['data']['bid_po_id'])?$result['data']['bid_po_id']:'',
			  	'materials_only' => isset($result['data']['materials_only']) ? "Yes" : "No",
			  	'due_date' => $result['data']['due_date'],
			  	'notes' => isset($result['data']['notes'])?$result['data']['notes']:'',
			  	'total_amount' => isset($result['data']['total'])?array_sum($result['data']['total']):0,
			  	'po_status' => $result['data']['status'],
			  	'scope_of_work' => $result['data']['scope_of_work'],
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
	             //print_r($po_co_update_array);exit;
	            //Insert cost codes in ub_po_co_cost_code table
	            $new_status = $result['data']['status'];
                $stat = strstr($new_status, ' ', true); 

                //echo $stat;exit;
                //print_r($result);exit;
	            if($this->user_account_type == BUILDERADMIN || $this->user_account_type == SUBCONTRACTOR){		
				$cost_code_update_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $result['data']['project_id'],
				'type' => $result['data']['type'],
				'po_co_id' => $result['data']['ub_po_co_id'],
				'ub_po_co_cost_code_id' => $result['data']['ub_po_co_cost_code_id'],
				'cost_code_id' => $result['data']['cost_code_id'],
				'quantity' => $result['data']['quantity'],
				'unit_cost' => $result['data']['unit_cost'],
				'total' => $result['data']['total'],
				'status' => $result['data']['status'],
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY,);}
				else
				{
					$cost_code_update_array = array();
				}
	             if($result['data']['due_date'] == '')
			     {
				   unset($po_co_update_array['due_date']);
			     }
				//print_r($po_co_update_array);
			    $response = $this->Mod_po_co->update_po_co($po_co_update_array,$cost_code_update_array);

			    //Send The count
			    if($result['data']['type'] == 'PO' && $result['data']['status'] == 'Released'){
		    	for($i=0; $i< count($result['data']['cost_code_id']); $i++)
		    	{
		    		$insert_ary = array();

		    		$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $result['data']['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes')); 
		            $cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);

		    		$insert_ary['cost_code_id'] = $result['data']['cost_code_id'][$i];
		    		$insert_ary['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		$insert_ary['project_id'] = $result['data']['project_id'];
		    		$insert_ary['po_release_count'] = 1;
		    		$this->Mod_budget->update_estimate($insert_ary);
		 	    }
		 	   }
			    if(($result['data']['type'] == 'OWNER CO' || $result['data']['type'] == 'OWNER PO') && $this->user_account_type == OWNER)
			    {
			    	if(isset($result['data']['output'])){
			    	$signature = array(
					'search_params' => "'".serialize($result['data']['output'])."'"
				     );

			    	$signature_array = array(
		    	     'signature_content' => $signature['search_params'],
		    	     'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	    );
		    	    //print_r($signature_array);exit;
		    	    $signature_response = $this->Mod_po_co->add_signature($signature_array);
		    	 }
			    }
			    $this->Mod_po_co->response($response);
			  }
			 }
			 else
			 {

			 	$date_array = array('PO_CO.due_date' => 'scheduled_completion');

				$result_data = $this->Mod_po_co->get_po_co(array(
					         'select_fields' => array('PO_CO.signature_file_id','PO_CO.signature_content','PO_CO.ub_po_co_number','PROJECT.ub_project_id','PROJECT.project_name','PO_CO.ub_po_co_id','PO_CO.builder_id','PO_CO.project_id','PO_CO.title','PO_CO.assigned_to','PO_CO.materials_only','PO_CO.due_date','PO_CO.notes','PO_CO.scope_of_work','PO_CO.bid_po_id','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.po_status','PO_CO.created_by','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name,'.$this->Mod_user->format_user_datetime($date_array,"date")),
			                 'join'=> array('project'=>'Yes','user'=>'Yes'),  
			                 'where_clause' => (array('ub_po_co_id' =>  $ub_po_co_id))
			                ));
				//echo "<pre>";print_r($result_data);exit;
				$serialized_mail_preferences = $result_data['aaData'][0]['signature_content'];
		        $remove_single_quote_mail_preferences = str_replace("'", '', $serialized_mail_preferences);
		        $unserialized_mail_preferences = unserialize($remove_single_quote_mail_preferences);
		       $result_data['aaData'][0]['signature_content'] = $unserialized_mail_preferences;

				if(TRUE === $result_data['status'])
			    {
			      if($result_data['aaData'][0]['bid_po_id'] > 0)
			      {
			      	$po_details = $this->Mod_po_co->get_po_co(array('select_fields' => array('PO_CO.title'),
                        'where_clause' => (array('PO_CO.ub_po_co_id' =>  $result_data['aaData'][0]['bid_po_id']))));
			      	$data['po_result'] = $po_details['aaData'][0];

			      }
				  $data['budget_po_data']  = $result_data['aaData'][0];

				  $signature_file = array('flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $this->project_id,
								  'folderid' => 0,
								  'modulename' => 'signature',
								  'moduleid' => $ub_po_co_id,
								);
			      $file_array = $this->Mod_doc->get_files_for_folder($signature_file);
			      //print_r($file_array);exit;
			      if(isset($file_array[0]['ub_doc_file_id']))
			      {
			      	$data['signature_file']  = $file_array[0];
			      }
			      
			      //print_r($file_array);exit;
			    }

			    $cost_code_args = array('select_fields' => array('Group_concat(PO_CO_COST_CODE.ub_po_co_cost_code_id) as ub_po_co_cost_code_id','Group_concat(PO_CO_COST_CODE.cost_code_id) as cost_code_id','Group_concat(PO_CO_COST_CODE.quantity) as quantity','Group_concat(PO_CO_COST_CODE.unit_cost) as unit_cost','Group_concat(PO_CO_COST_CODE.total) as total','PO_CO.po_status','PO_CO.created_by','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
        'where_clause' => (array('PO_CO_COST_CODE.po_co_id' =>  $ub_po_co_id)),'join' =>array('po_co'=>'Yes','variance_code'=>'Yes')); 

		$cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);

		//print_r($cost_code_result);
		if($cost_code_result['status'] == TRUE){
			$data['cost_code_data'] = $cost_code_result['aaData'][0];
	    }
			      
		     }
		 
	    }
	    // Here ub_po_co_id value is 0. So It will enter to Insert function
		else
		{
		  if(!empty($this->input->post()))
		  {
			$result = $this->sanitize_input();
			//print_r($_FILES);
			//print_r($result);exit;
			if(TRUE === $result['status'])
			{
				if(isset($result['data']['due_date']) && $result['data']['due_date'] !='')
			    {
				  $result['data']['due_date'] = date("Y-m-d", strtotime($result['data']['due_date']));
			    }
			    if(isset($result['data']['assigned_to']) && $result['data']['assigned_to'] !== null && $result['data']['assigned_to']!='Nothing selected')
			    {
			   
					$result['data']['assigned_to'] =  $result['data']['assigned_to'];
				}
				else
				{
					$result['data']['assigned_to'] = '';

				}
				if($this->user_account_type == OWNER && !isset($result['data']['assigned_to']) && $result['data']['assigned_to'] == null && $result['data']['assigned_to']=='Nothing selected' || $result['data']['assigned_to'] == '')
				{
					//$result['data']['assigned_to'] = '1';
					$assign_builder = $this->Mod_project->get_assigned_role_ids(array(
					'select_fields' => array('PROJECTASSIGNED.assigned_to'),
					'where_clause' => (array('PROJECTASSIGNED.project_id' => $this->project_id,'PROJECTASSIGNED.role_id' => BUILDER_ADMIN_ROLE_ID))
					));
					if($assign_builder['status'] == TRUE)
					{
						$result['data']['assigned_to'] =  $assign_builder['aaData'][0]['assigned_to'];
					}
				}		
				if($result['data']['bid_project_id'] > 0)
				{
					$this->project_id = $result['data']['bid_project_id'];
				}
				//echo "hi".$this->project_id;exit;
				$po_co_insert_array = array(
			  	'builder_id' => $this->user_session['builder_id'],
			  	'project_id' => $this->project_id,
			  	'type' => $result['data']['type'],
			  	'title' => $result['data']['title'],
			  	'assigned_to' => $result['data']['assigned_to'],
			  	'materials_only' => isset($result['data']['materials_only']) ? "Yes" : "No",
			  	'due_date' => $result['data']['due_date'],
			  	'notes' => isset($result['data']['notes'])?$result['data']['notes']:'',
			  	'bid_po_id' => isset($result['data']['bid_po_id'])?$result['data']['bid_po_id']:'',
			  	'total_amount' => isset($result['data']['total'])?array_sum($result['data']['total']):0,
			  	'po_status' => $result['data']['status'],
	            'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);

	            //print_r($po_co_insert_array);exit;
	            //Insert cost codes in ub_po_co_cost_code table
	            //print_r(array_unique($result['data']['cost_code_id']));exit;

				$cost_code_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $this->project_id,
				'type' => $result['data']['type'],
				'cost_code_id' => isset($result['data']['cost_code_id'])?$result['data']['cost_code_id']:0,
				'quantity' => isset($result['data']['quantity'])?$result['data']['quantity']:0,
				'unit_cost' => isset($result['data']['unit_cost'])?$result['data']['unit_cost']:0,
				'total' => isset($result['data']['total'])?$result['data']['total']:0,
				'status' => $result['data']['status'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY,);

	             if($result['data']['due_date'] == '')
			     {
				   unset($po_co_insert_array['due_date']);
			     }
			     if($result['data']['bid_po_id'] == 0)
			     {
				   unset($po_co_insert_array['bid_po_id']);
			     }

			     $notification_array = array(
		    	'template_type' => 'budget_po_co_assigned_internally',
		    	'project_id' => $this->project_id,
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'builder_id' => $result['data']['assigned_to'],
		    	'on' => TODAY,
		    	);

				//print_r($po_co_insert_array);exit;
			    $response = $this->Mod_po_co->add_po_co($po_co_insert_array,$cost_code_insert_array,$notification_array);
			    if(($result['data']['type'] == 'OWNER CO' || $result['data']['type'] == 'OWNER PO') && $this->user_account_type == OWNER)
			    {
			    	//print_r($_FILES);exit;
			    	if(isset($result['data']['output'])){
			    	$signature = array(
					'search_params' => "'".serialize($result['data']['output'])."'"
				     );

			    	$signature_array = array(
		    	     'signature_content' => $signature['search_params'],
		    	     'ub_po_co_id' => $response['insert_id'],
		    	    );
		    	    //print_r($signature_array);exit;
		    	    $signature_response = $this->Mod_po_co->add_signature($signature_array);
		    	  }
			    }
			    $this->Mod_po_co->response($response);
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		  }
	    }
	    //Get all po of a builder
	    $po_list = $this->Mod_po_co->get_po_co(array(
					'select_fields' => array('PO_CO.ub_po_co_id','PO_CO.title'),
					'where_clause' => (array('PO_CO.builder_id' => $this->user_session['builder_id'],'PO_CO.type' => 'PO','project_id' => $this->project_id,'is_delete' => 'No'))
					));
	 
	    if($po_list['status'] == TRUE){
			
			
			$data['po_list'] = $this->Mod_project->build_ci_dropdown_array($po_list['aaData'],'ub_po_co_id', 'title');
	   	}
	   	//Get all owner po of a builder
	    $owner_po_list = $this->Mod_po_co->get_po_co(array(
					'select_fields' => array('PO_CO.ub_po_co_id','PO_CO.title'),
					'where_clause' => (array('PO_CO.builder_id' => $this->user_session['builder_id'],'PO_CO.type' => 'OWNER PO','project_id' => $this->project_id,'is_delete' => 'No'))
					));
	 
	    if($owner_po_list['status'] == TRUE){
			
			
			$data['owner_po_list'] = $this->Mod_project->build_ci_dropdown_array($owner_po_list['aaData'],'ub_po_co_id', 'title');
	   	}

	   	//print_r($po_list);exit;

	    if($sub_id > 0)
	    {
	    	$result_data = $this->Mod_po_co->get_assigned_user(array(
					         'select_fields' => array('USER.ub_user_id as assigned_to'),
			                 'where_clause' => (array('USER.subcontractor_id' =>  $sub_id))
			                ));
				if(TRUE === $result_data['status'])
			    {
				  $data['budget_po_data']  = $result_data['aaData'][0];
			    }

	    }
	    //echo '<pre>';print_r($projec);exit;
		//Get assigned users dropdowns
		if($project_ids > 0 && ($type == 'PO' || $type == 'CO'))
		{
			
			$assigned_to = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$project_ids, 'account_type' => 'all', 'assigned_type' => 'yes', 'dropdown_type' => 'optgroup'));
			 
			unset($assigned_to['Owner']);
			$nothing_selected_array = array(''=>'Nothing Selected');
			$data['assigned_to']=  $nothing_selected_array + $assigned_to;
		}
		else
		{

			$assigned_to = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$this->project_id, 'account_type' => 'all', 'assigned_type' => 'yes', 'dropdown_type' => 'optgroup'));
			unset($assigned_to['Owner']);
			$nothing_selected_array = array(''=>'Nothing Selected');
			$data['assigned_to']=  $nothing_selected_array + $assigned_to;
		}
		if($project_ids > 0 && $type == 'OWNER CO')
		{
			$owner = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$project_ids, 'account_type' => 'all', 'assigned_type' => 'yes', 'dropdown_type' => 'optgroup'));
			//unset($assigned_to['Owner']);
			$nothing_selected_array = array(''=>'Nothing Selected');
			$data['owner']=  $nothing_selected_array + $owner;


			$owner_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.owner_id','CONCAT_WS(" ",OWNER.first_name,OWNER.last_name) as first_name'),
					'where_clause' => (array('PROJECT.ub_project_id' => $project_ids)),
					'join'=> array('owner'=>'Yes'),
					));
			if($owner_list['status'] == TRUE)
			{
				$data['owner_name']=  $owner_list['aaData'][0];
			}
		}
		else
		{
			$owner = $this->Mod_project->get_project_assigned_users(array('ub_project_id' =>$this->project_id, 'account_type' => 'all', 'assigned_type' => 'yes', 'dropdown_type' => 'optgroup'));
			//unset($assigned_to['Owner']);
			$nothing_selected_array = array(''=>'Nothing Selected');
			$data['owner']=  $nothing_selected_array + $owner;


			$owner_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.owner_id','CONCAT_WS(" ",OWNER.first_name,OWNER.last_name) as first_name'),
					'where_clause' => (array('PROJECT.ub_project_id' => $this->project_id)),
					'join'=> array('owner'=>'Yes'),
					));
			if($owner_list['status'] == TRUE)
			{
				$data['owner_name']=  $owner_list['aaData'][0];
			}
			//print_r($data['owner_name']);exit;
		}
			
			
			

		    
	    
		
		$args['where_clause'] = "builder_id = ".$this->builder_id." || builder_id = 0";
		$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');
		$cost_code_options = $this->Mod_po_co->get_db_options(UB_COST_CODE, $args);
		$data['cost_code_options'] = $cost_code_options;

		if(($type == 'CO' || $type == 'OWNER CO') && $bid_po_id > 0)
		{
			$cost_code_args = array('select_fields' => array('Group_concat(PO_CO_COST_CODE.ub_po_co_cost_code_id) as ub_po_co_cost_code_id','Group_concat(PO_CO_COST_CODE.cost_code_id) as cost_code_id','Group_concat(PO_CO_COST_CODE.quantity) as quantity','Group_concat(PO_CO_COST_CODE.unit_cost) as unit_cost','Group_concat(PO_CO_COST_CODE.total) as total','PO_CO.type','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
        'where_clause' => (array('PO_CO_COST_CODE.po_co_id' =>  $bid_po_id)),'join' =>array('po_co'=>'Yes','variance_code'=>'Yes')); 

		$cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);

		$po_details = array('select_fields' => array('PO_CO.title'),
        'where_clause' => (array('PO_CO.ub_po_co_id' =>  $bid_po_id)),); 

		$po_result = $this->Mod_po_co->get_po_co($po_details);
		
		if($cost_code_result['status'] == TRUE){
			$data['cost_code_data'] = $cost_code_result['aaData'][0];
			$data['po_result'] = $po_result['aaData'][0];
	    }
	    //print_r($data['po_result']);exit;
	   }
	   else if($type == 'PO' && $bid_po_id > 0)
		{
			$cost_code_args =array(
					         'select_fields' => array('Group_concat(COST_CODE.ub_bid_sub_cost_code_id) as ub_po_co_cost_code_id','Group_concat(COST_CODE.cost_code_id) as cost_code_id','Group_concat(COST_CODE.bid_amount/COST_CODE.bid_amount) as quantity','Group_concat(COST_CODE.bid_amount) as unit_cost','Group_concat(COST_CODE.bid_amount) as total','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
			                 'where_clause' => (array('COST_CODE.bid_request_id' =>  $bid_po_user_id)),
			                 'join' =>array('variance_code'=>'Yes')); 

		$cost_code_result = $this->Mod_po_co->get_bid_cost_code($cost_code_args);
		
		if($cost_code_result['status'] == TRUE){
			$data['cost_code_data'] = $cost_code_result['aaData'][0];
	    }
	}
		/* $this->benchmark->mark('code_end');
		echo $this->benchmark->elapsed_time('code_start','code_end');exit; */
		
		$this->template->view($data);
		
	}
	

	/** 
	* Get Po Co Status
	* 
	* @method: Get Po Co Status 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9pbmRleC8-
	*/	
	public function get_po_co_activity_log()
	{
		// Get list of project the user involved
		$result = $this->sanitize_input();
		$post_array[] = array(
							'field_name' => 'PO_CO_ACTIVITY.po_co_id',
							'value'=> $result['data']['po_co_id'], 
							'type' => '='
							);
		 $where_str = $this->Mod_user->build_where($post_array);
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
					$order_by_where = 'PO_CO_ACTIVITY.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				// Fetch argument building
				$datetime_array = array('PO_CO_ACTIVITY.created_on'=>'created_on');
                $activity_args = array('select_fields' => array('USER.account_type','PO_CO_ACTIVITY.activity_status','PO_CO_ACTIVITY.created_by','PO_CO_ACTIVITY.comment,'.$this->Mod_user->format_user_datetime($datetime_array)),
                'where_clause' => $where_str,
                'join'=> array('user'=>'Yes',),
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$activity_data = $this->Mod_po_co->get_po_co_activity_log($activity_args);
				if($activity_data['status'] == TRUE){
				for($i=0;$i<count($activity_data['aaData']);$i++)
			    {
			    	if($activity_data['aaData'][$i]['account_type'] == BUILDERADMIN)
				    {
					  $activity_data['aaData'][$i]['created_by'] = 'BUILDER';
				    }
				    else
				    {
					 $activity_data['aaData'][$i]['created_by'] = 'SUBCONTRACTOR';
				    }
			    }

			  }
				if($activity_data['status'] == FALSE)
				{
					$activity_data = array();
					$activity_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co_activity_log(array(
												'select_fields' => array('COUNT(PO_CO_ACTIVITY.ub_po_co_activity_id) AS total_count'),
												'where_clause' => $where_str));
					$activity_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$activity_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$activity_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_po_co->response($activity_data);

	}

	/** 
	* Get get_po_bids_list
	* 
	* @method: Get Po Co Status 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @url: bgxf19ncy9pbmRleC8-
	*/	
	public function get_po_bids_list()
	{
		// Get list of project the user involved
		$result = $this->sanitize_input();
		$post_array[] = array(
							'field_name' => 'PO_CO.ub_po_co_id',
							'value'=> $result['data']['po_co_id'], 
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'PO_CO.type',
							'value'=> 'PO', 
							'type' => '='
							);
		$post_array[] = array(
							'field_name' => 'PO_CO.bid_po_id',
							'value'=> 0, 
							'type' => '!='
							);
		
		 $where_str = $this->Mod_user->build_where($post_array);
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
					$order_by_where = 'PO_CO.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				// Fetch argument building
				$datetime_array = array('PO_CO.created_on'=>'created_on');
                $bid_args = array('select_fields' => array('BID.package_title','BID_REQUEST.bid_id,'.$this->Mod_user->format_user_datetime($datetime_array)),
                'where_clause' => $where_str,
                'join'=> array('bid'=>'yes','bid_request'=>'Yes'),
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$bid_data = $this->Mod_po_co->get_po_co_bid($bid_args);

				
				//print_r($bid_data);exit;
			
				if($bid_data['status'] == FALSE)
				{
					$bid_data = array();
					$bid_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co_bid(array(
												'select_fields' => array('COUNT(PO_CO.ub_po_co_id) AS total_count'),
												'where_clause' => $where_str));
					$bid_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$bid_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$bid_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_po_co->response($bid_data);

	}

	/** 
	* Get PO CO Payment
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_po_co_payment()
	{

	$result = $this->sanitize_input();
	
	$post_array[] = array(
							'field_name' => 'PO_CO_PAYMENT_REQUEST.po_co_id',
							'value'=> $result['data']['po_co_id'], 
							'type' => '='
							);
	$other_where = '';
	if($this->user_account_type == BUILDERADMIN)
	{
	
		$other_where = ' AND (PO_CO_PAYMENT_REQUEST.created_by = '.$this->user_session['ub_user_id'].' || PO_CO_PAYMENT_REQUEST.payment_request_status != "Payment request created") ';		
	}						

		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo'<pre>';print_r($result);
			$search_session_array=array();
			if(TRUE === $result['status'])
			{	
				$where_str = $this->Mod_po_co->build_where($post_array);
				if($other_where != '')
				{
					$where_str = $where_str.$other_where;
				}
				//print_r($where_str);exit;
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_payment(array(
												'select_fields' => array('COUNT(PO_CO_PAYMENT_REQUEST.ub_po_co_payment_request_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
												
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PO_CO_PAYMENT_REQUEST.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}

		$datetime_array = array('PO_CO_PAYMENT_REQUEST.modified_on'=> 'modified_on');
		$query_array = array('select_fields' => array('PO_CO_PAYMENT_REQUEST.ub_po_co_payment_request_id','PO_CO_PAYMENT_REQUEST.payment_title','PO_CO_PAYMENT_REQUEST.total_paid_amount','PO_CO_PAYMENT_REQUEST.payment_request_status','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS pay_to,'.$this->Mod_user->format_user_datetime($datetime_array)),
		'join'=> array('user'=>'Yes','builder'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		// echo '<pre>';print_r($query_array);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_po_co->get_po_payment($query_array);
		
		// The following parameters required for data table

		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
					
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data

		$this->Mod_po_co->response($result_data);
	}
	
	/** 
	* Save PO CO Payment
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: YnVkZ2V0L3NhdmVfcgxf19fY29fcgxf1F5bWVudA--
	*/
	public function save_po_co_payment()
	{
		$result = $this->sanitize_input();
		//echo print_r($result);exit;
		//echo '<pre>';print_r($_FILES);exit;
		if(TRUE == $result['status'])
		{
			if($result['data']['ub_po_co_payment_id'] > 0)
		  	{
		  		//Update array in payment table
		  		$po_co_payment_update_array = array(
		  		'po_co_id' => $result['data']['ub_po_co_id'],
		  		'ub_po_co_payment_request_id' => $result['data']['ub_po_co_payment_id'],
		  		'pay_to' => isset($result['data']['assigned_to'])? $result['data']['assigned_to'] : '',
			  	'total_po_co_amount' => array_sum($result['data']['original']),
			  	'total_requested_amount' => array_sum($result['data']['requested_amount']),
			  	'payment_request_status' => isset($result['data']['payment_status'])? 'Ready for Payment' : 'Payment request created',
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY);
	            //insert array in payment transaction table
	            if($this->user_account_type == BUILDERADMIN)
	            {
	            	$amount = $result['data']['amount'];
	            }
	            else
	            {
	            	$amount = 0.00;
	            }
			   $po_co_transaction_insert_array = array(
			  	'builder_id' => $this->user_session['builder_id'],
			  	'project_id' => $result['data']['project_id'],
			  	'po_co_item_id' => $result['data']['po_co_cost_code_id'],
			  	'po_co_id' => $result['data']['ub_po_co_id'],
			  	'cost_code_id' => $result['data']['po_co_item_id'],
			  	'pay_amount' => $amount,
			  	'requested_amount' => $result['data']['requested_amount'],
			  	'paid_amount' => $result['data']['total_paid_amount'],
			  	'total_paid_amount' => $result['data']['payment_paid_amount'],
			  	'ub_po_co_cost_code_id' => $result['data']['po_co_cost_code_id'],
			  	'ub_po_co_payment_request_details_id' => $result['data']['ub_po_co_payment_request_details_id'],
			  	'status' => 'Normal',
			  	'pay_to' => isset($result['data']['assigned_to'])? $result['data']['assigned_to'] : '',
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY);

			   $notification_array = array(
		    	'template_type' => 'budget_po_co_ready_for_payment',
		    	'project_id' => $result['data']['project_id'],
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'number' => $result['data']['ub_po_co_number'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'builder_id' => $result['data']['created_by'],
		    	'on' => TODAY
		    	);
			   	//print_r($result);exit;
				/*$file_arry = array(
		    	'name' => isset($result['data']['name'])?$result['data']['name']:'',
		    	);*/

	            $response = $this->Mod_po_co->update_po_co_payment($po_co_payment_update_array,$po_co_transaction_insert_array,$notification_array);

	            if(isset($result['data']['name']) && $this->user_account_type == BUILDERADMIN)
			    {
				  $file_arry = array(
			    	'name' => isset($result['data']['name'])?$result['data']['name']:'',
			    	'payment_id' => $result['data']['ub_po_co_payment_id'],
			    	'project_id' => $result['data']['project_id']
			    	);
				  $this->Mod_po_co->update_documents($file_arry);
			    }
		  	}
		  	else
		  	{
			//Insert array in payment table
		  	if(isset($result['data']['requested_amount']) && count(array_filter($result['data']['requested_amount'])) > 0){
			$po_co_payment_transaction_insert_array = array(
			  	'builder_id' => $this->user_session['builder_id'],
			  	'project_id' => $result['data']['project_id'],
			  	'po_co_id' => $result['data']['ub_po_co_id'],
			  	'payment_title' => $result['data']['payment_title'],
			  	'comments' => $result['data']['comments'],
			  	'total_po_co_amount' => array_sum($result['data']['original']),
			  	'payment_request_status' => isset($result['data']['payment_status'])? 'Ready for Payment' : 'Payment request created',
			  	'total_requested_amount' => array_sum($result['data']['requested_amount']),
	            'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
			//insert array in payment transaction table
			$po_co_transaction_insert_array = array(
			  	'builder_id' => $this->user_session['builder_id'],
			  	'project_id' => $result['data']['project_id'],
			  	'po_co_item_id' => $result['data']['po_co_cost_code_id'],
			  	'cost_code_id' => $result['data']['po_co_item_id'],
			  	'po_co_id' => $result['data']['ub_po_co_id'],
			  	'ub_po_co_cost_code_id' => $result['data']['po_co_cost_code_id'],
			  	'request_amount' => $result['data']['requested_amount'],
			  	'status' => 'Normal',
	            'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
			
			//print_r($po_co_transaction_insert_array);exit;
			$notification_array = array(
		    	'template_type' => 'budget_po_co_ready_for_payment',
		    	'project_id' => $result['data']['project_id'],
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'number' => $result['data']['ub_po_co_number'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'builder_id' => $result['data']['created_by'],
		    	'on' => TODAY,
		    	);

				
			//print_r($result);exit;

			$response = $this->Mod_po_co->add_po_co_payment($po_co_payment_transaction_insert_array,$po_co_transaction_insert_array,$notification_array);
			if(isset($result['data']['name']))
			{
				$file_arry = array(
		    	'name' => isset($result['data']['name'])?$result['data']['name']:'',
		    	'payment_id' => $response['insert_id'],
		    	'project_id' => $result['data']['project_id']
		    	);
			   $this->Mod_po_co->add_documents($file_arry);
			   //print_r($result['data']);exit;
			   $voucher_document_list_args = array('select_fields' => array('PAYMENT_DOCOUMENTS.name'),
			    'where_clause' => (array('PAYMENT_DOCOUMENTS.payment_request_id' =>  $response['insert_id'],'PAYMENT_DOCOUMENTS.file_id !=' => 0))
			    );
			    $voucher_document_list['voucher_documents'] = $this->Mod_po_co->get_po_co_payment_request_documents($voucher_document_list_args);
			    if($voucher_document_list['voucher_documents']['status'] == TRUE){
			    $data['voucher_documents'] = $voucher_document_list['voucher_documents']['aaData'];
			    
			     $documents = array_column($voucher_document_list['voucher_documents']['aaData'], 'name');
			     $document_lists = implode(',',$documents);
			     $notification_array = array(
		    	'template_type' => 'budget_po_co_required_document_uploaded',
		    	'project_id' => $result['data']['project_id'],
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'number' => $result['data']['ub_po_co_number'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'builder_id' => $result['data']['created_by'],
		    	'document_name' => $document_lists,
		    	'on' => TODAY,
		    	);
		    	 $this->Mod_po_co->send_mail_for_notification('',$notification_array);
			     //echo $document_lists;exit;
			 }
			   
			}
		   }
		   else
		  {
		  	$response['data'] = true;
		  }
		  }
		  $this->Mod_po_co->response($response);		
		}
		
		
	}
	/** 
	* Save PO CO Payment
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function void_payment()
	{
		$result = $this->sanitize_input();
		if(TRUE == $result['status'])
		{
			//insert array in payment transaction table
			$void_transaction_insert_array = array(
			  	'builder_id' => $this->user_session['builder_id'],
			  	'project_id' => $result['data']['project_id'],
			  	'ub_po_co_payment_request_id' => $result['data']['ub_po_co_payment_id'],
			  	'po_co_item_id' => $result['data']['po_co_item_id'],
			  	'cost_code_id' => $result['data']['po_co_item_id'],
			  	'po_co_id' => $result['data']['ub_po_co_id'],
			  	'ub_po_co_cost_code_id' => $result['data']['po_co_cost_code_id'],
			  	'status' => 'Void',
			  	'ub_po_co_payment_request_details_id' => $result['data']['ub_po_co_payment_request_details_id'],
	            'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
			
			$response = $this->Mod_po_co->void_payment($void_transaction_insert_array);
			$this->Mod_po_co->response($response);
			
			
		}
		
		
	}
	/** 
	* get_payament
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_po_co_payment_transactions()
	{
		$result = $this->sanitize_input();
		$post_array[] = array(
						'field_name' => 'PO_CO_COST_CODE.po_co_id',
						'value'=> $result['data']['ub_po_co_id'], 
						'type' => '='
						);		

		$payment_data = array();
		$where_str = $this->Mod_bid->build_where($post_array);
		//Fetch the status from payment transaction table and check the conditions
		
		$all_payment_status = $this->Mod_po_co->get_po_payment(array(
			'select_fields' => array('PO_CO_PAYMENT_REQUEST.payment_request_status'),
			'where_clause' => (array('po_co_id' =>  $result['data']['ub_po_co_id'],'payment_request_status' =>  'Ready for Payment'))
			));

	/*	if($all_payment_status['status'] == TRUE)
		{
			$payment_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code as cost_code','PO_CO_COST_CODE.cost_code_id','PO_CO_COST_CODE.total as original','PO_CO_COST_CODE.paid_amount as paid_amount','(PO_CO_COST_CODE.total - (PO_CO_COST_CODE.paid_amount + PO_CO_COST_CODE.requested_amount)) AS out_standing','PO_CO_COST_CODE.ub_po_co_cost_code_id'),
		   'where_clause' => $where_str,'join' =>array('variance_code'=>'Yes')); 

		  $payment_result = $this->Mod_po_co->po_co_payment_list($payment_args);
		  if($payment_result['status'] == TRUE){
		  $payment_data = $payment_result['aaData'];

		  $responses = $this->load->view('content/budget/save_po_co_payment_transaction',array('payment_data' => $payment_data),true);
		  echo $responses; exit;
		}
	  }*/
		//$payment_status_result = $this->Mod_po_co->get_po_payment($payment_args);
		/*else
		{*/
			$payment_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code as cost_code','PO_CO_COST_CODE.cost_code_id','PO_CO_COST_CODE.total as original','PO_CO_COST_CODE.paid_amount as paid_amount','(PO_CO_COST_CODE.total - PO_CO_COST_CODE.paid_amount) AS out_standing','PO_CO_COST_CODE.ub_po_co_cost_code_id','((PO_CO_COST_CODE.requested_amount - PO_CO_COST_CODE.paid_amount)) AS requesting_amount'),
		 'where_clause' => $where_str,'join' =>array('variance_code'=>'Yes')); 

		$payment_result = $this->Mod_po_co->po_co_payment_list($payment_args);



		//echo "<pre>";print_r($payment_result);
		if($payment_result['status'] == TRUE){
		$payment_data = $payment_result['aaData'];

		$responses = $this->load->view('content/budget/save_po_co_payment_transaction',array('payment_data' => $payment_data),true);
		echo $responses; exit;

		/*}*/
		
		}
		
	}

	/** 
	* get_payament
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_payment_details_transaction()
	{
		$result = $this->sanitize_input();
		$post_array[] = array(
						'field_name' => 'PAYMENT_REQUEST_DETAILS.po_co_payment_request_id',
						'value'=> $result['data']['ub_po_co_payment_id'], 
						'type' => '='
						);


		$payment_data = array();
		$where_str = $this->Mod_bid->build_where($post_array);
		$payment_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code as cost_code','PO_CO_COST_CODE.cost_code_id','PO_CO_COST_CODE.total as original','PO_CO_COST_CODE.paid_amount as paid_amount','(PO_CO_COST_CODE.total - PO_CO_COST_CODE.paid_amount) AS out_standing','PO_CO_COST_CODE.ub_po_co_cost_code_id','(PAYMENT_REQUEST_DETAILS.request_amount) AS requested_amount','PAYMENT_REQUEST_DETAILS.total_paid_amount','(PAYMENT_REQUEST_DETAILS.request_amount - PAYMENT_REQUEST_DETAILS.total_paid_amount) AS total_out_standing','PAYMENT_REQUEST_DETAILS.ub_po_co_payment_request_details_id','(PO_CO_COST_CODE.requested_amount) AS requesting_amount'),
		 'where_clause' => $where_str,'join' =>array('variance_code'=>'Yes','po_co_cost_code' => 'Yes')); 

		$payment_result = $this->Mod_po_co->get_payment_details_transaction($payment_args);
		//print_r($payment_result);
		if($payment_result['status'] == TRUE){
		$payment_data = $payment_result['aaData'];

		$responses = $this->load->view('content/budget/save_po_co_payment_transaction',array('payment_data' => $payment_data),true);
		echo $responses; exit;	
		
		
		}
		
	}

	/*

	* Get po_co_payment_details
	* @method: get_po_co_payment_details 
	* @access: public 
	* @param:  
	* @return:  response array
	* url encoded : Ymlkcy9zYXZlX2JpZC8-
	*/

	public function get_po_co_payment_details()
	{

		if(!empty($this->input->post()))
	   {
		 //Sanitize input
		  $result = $this->sanitize_input();
		  //print_r($result);
		  if(TRUE === $result['status'])
		  {	
			$payment_data = $this->Mod_po_co->get_po_payment(array(
									'select_fields' => array('PO_CO_PAYMENT_REQUEST.payment_title','PO_CO_PAYMENT_REQUEST.comments','PO_CO_PAYMENT_REQUEST.payment_request_status','PO_CO_PAYMENT_REQUEST.total_paid_amount'),
									'where_clause' => array('PO_CO_PAYMENT_REQUEST.ub_po_co_payment_request_id'=> $result['data']['ub_po_co_payment_id'])));
			if($this->user_account_type == BUILDERADMIN){
			$last_transaction_data = $this->Mod_po_co->get_payment_details_transaction(array(
									'select_fields' => array('SUM(PAYMENT_REQUEST_DETAILS.last_transaction_amount) AS last_transaction_amount'),
									'where_clause' => array('PAYMENT_REQUEST_DETAILS.po_co_payment_request_id'=> $result['data']['ub_po_co_payment_id'])));

			$result_data = $this->Mod_po_co->get_po_co(array(
					         'select_fields' => array('PO_CO.assigned_to','PO_CO.created_by'),
			                 'join'=> array('project'=>'Yes','user'=>'Yes','po_co_cost_code' => 'Yes'),  
			                 'where_clause' => (array('ub_po_co_id' =>  $result['data']['ub_po_co_id']))
			                ));

			$voucher_transaction_args = array('select_fields' => array('VOUCHER_TRANSACTION.voucher_id'),
        'where_clause' => (array('VOUCHER_TRANSACTION.payment_id' => $result['data']['ub_po_co_payment_id'])),
		'join' =>array('user'=>'Yes'),
		'order_clause' => 'VOUCHER_TRANSACTION.voucher_id desc');
		$voucher_transaction = $this->Mod_po_co->get_voucher_transaction($voucher_transaction_args);


			if(isset($last_transaction_data['aaData']))
			{
				$data['last_transaction_amount'] = $last_transaction_data['aaData'][0]['last_transaction_amount'];
			}

			if(isset($result_data['aaData']))
			{
				$data['assigned_to'] = $result_data['aaData'][0]['assigned_to'];
				$data['created_by'] = $this->user_session['ub_user_id'];
				$data['created'] = $result_data['aaData'][0]['created_by'];
			}
			if(isset($voucher_transaction['aaData']))
			{
				$data['voucher_id'] = $voucher_transaction['aaData'][0]['voucher_id'];
			}

		  }

		  if(isset($payment_data['aaData']))
		  {
			$data['payment_data'] = $payment_data['aaData'];
		  }else{
		  $data['payment_data'] = false;
		  }
		  $post_array[] = array(
						'field_name' => 'PAYMENT_DOCOUMENTS.payment_request_id',
						'value'=> $result['data']['ub_po_co_payment_id'], 
						'type' => '='
						);
		  $where_str = $this->Mod_budget->build_where($post_array);
		$document_args = array('select_fields' => array('Group_concat(PAYMENT_DOCOUMENTS.file_id) as file_id','Group_concat(PAYMENT_DOCOUMENTS.name) as name'),
		 'where_clause' => $where_str);
		$document_result = $this->Mod_po_co->get_po_co_payment_request_documents($document_args);
		$file_id = explode(',', $document_result['aaData'][0]['file_id']);
		//print_r($file_id);
		$file_id = array_sum($file_id);
		//echo $file_id;
		//print_r($document_result);

		$data['payment_title'] = $payment_data['aaData'][0]['payment_title'];
		$data['comments'] = $payment_data['aaData'][0]['comments'];
		$data['payment_status'] = $payment_data['aaData'][0]['payment_request_status'];
		$data['total_paid_amount'] = $payment_data['aaData'][0]['total_paid_amount'];
		$data['file_id'] = $file_id;
		$data['status'] = TRUE;
		$this->Mod_po_co->response($data);
			
		}
	  }
	}

	
	/** 
	* Get Voucher
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_voucher($voucher_id = 0,$payment_id = 0,$project_id = 0)
	{	
		$data = array(
		'title'		=> "UNIBUILDER",		
		'content'     => 'content/budget/voucher'
		);
		//$result = $this->sanitize_input();
		//get voucher data
		$voucher_list_args = array('select_fields' => array('VOUCHER.voucher_no','VOUCHER.company','VOUCHER.address','VOUCHER.city','VOUCHER.province','VOUCHER.postal','VOUCHER.desk_phone','VOUCHER.mobile_phone','VOUCHER.fax','VOUCHER.project_no','VOUCHER.project_name','VOUCHER.project_city','VOUCHER.project_address','VOUCHER.project_province','VOUCHER.project_postal','VOUCHER.project_country','VOUCHER.email'),
        'where_clause' => (array('VOUCHER.builder_id' => $this->builder_id ,'VOUCHER.project_id' => $project_id,'VOUCHER.ub_voucher_id' => $voucher_id)),
		'join' =>array('user'=>'Yes'));
		$voucher['voucher_list'] = $this->Mod_po_co->get_voucher($voucher_list_args);
		// echo '<pre>';print_r($voucher);exit;
		if($voucher['voucher_list']['status'] == TRUE){
		$data['voucher_list'] = $voucher['voucher_list']['aaData'][0];
		}
		//get voucher transaction data
		$voucher_transaction_args = array('select_fields' => array('VOUCHER_TRANSACTION.payment_id','VOUCHER_TRANSACTION.gross_amount','VOUCHER_TRANSACTION.retention_amount','VOUCHER_TRANSACTION.net_amount'),
        'where_clause' => (array('VOUCHER_TRANSACTION.builder_id' => $this->builder_id ,'VOUCHER_TRANSACTION.project_id' => $project_id,'VOUCHER_TRANSACTION.voucher_id' => $voucher_id)),
		'join' =>array('user'=>'Yes'));
		$voucher_transaction['voucher_transaction_data'] = $this->Mod_po_co->get_voucher_transaction($voucher_transaction_args);
		if($voucher_transaction['voucher_transaction_data']['status'] == TRUE)
		{
			$data['voucher_transaction'] = $voucher_transaction['voucher_transaction_data']['aaData'];
			$payment_id = $voucher_transaction['voucher_transaction_data']['aaData'][0]['payment_id'];
			//echo '<pre>';print_r($payment_id);exit;
			
			
			//get file name of the requested document
			//get voucher transaction data
			$voucher_document_list_args = array('select_fields' => array('PAYMENT_DOCOUMENTS.name'),
			'where_clause' => (array('PAYMENT_DOCOUMENTS.payment_request_id' => $payment_id,'PAYMENT_DOCOUMENTS.file_id !=' => 0))
			);
			$voucher_document_list['voucher_documents'] = $this->Mod_po_co->get_po_co_payment_request_documents($voucher_document_list_args);
			if($voucher_document_list['voucher_documents']['status'] == TRUE){
			$data['voucher_documents'] = $voucher_document_list['voucher_documents']['aaData'];
			}

			$payment_status_result = $this->Mod_po_co->get_po_payment(array(
										'select_fields' => array('PO_CO_PAYMENT_REQUEST.override'),
										'where_clause' => array('PO_CO_PAYMENT_REQUEST.ub_po_co_payment_request_id'=> $payment_id)));
			$data['payment_status'] = $payment_status_result['aaData'][0];
		}
		/* block to get builder datails*/
		$post_array =  array('USER.builder_id' => $this->builder_id, 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID );

		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','BUILDER_DETAILS.builder_name','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array
												));

		if(TRUE === $builder_details_array['status'])
		{
			$data['builder_name'] = $builder_details_array['aaData'][0]['builder_name'];	
			$builder_address_data = $builder_details_array['aaData']['0'];
			$builder_address_data['address'] = (isset($builder_address_data['address']) && $builder_address_data['address']!='')?$builder_address_data['address'].', ':'';
			$builder_address_data['city'] = (isset($builder_address_data['city']) && $builder_address_data['city']!='')?$builder_address_data['city'].', ':'';
			$builder_address_data['province'] = (isset($builder_address_data['province']) && $builder_address_data['province']!='')?$builder_address_data['province'].', ':'';
			$builder_address_data['country'] = (isset($builder_address_data['country']) && $builder_address_data['country']!='')?$builder_address_data['country'].' ':'';
			$builder_address_data['postal'] = (isset($builder_address_data['postal'] ) && $builder_address_data['postal']!='')?$builder_address_data['postal']:'';
			$data['builder_address'] = $builder_address_data['address'].$builder_address_data['city'].$builder_address_data['province'].$builder_address_data['country'].$builder_address_data['postal'];
			$data['builder_phone'] = '';
			if (!empty($builder_address_data['desk_phone'])) 
			{
				$data['builder_phone']	= $builder_address_data['desk_phone'];
			}
		}	
		
		/* $builder_where_str =  array('BUILDER_DETAILS.ub_builder_id'=> $this->builder_id);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.builder_name'),
												'where_clause' => $builder_where_str
												));
		$data['builder_name'] = $builder_details_array['aaData'][0]['builder_name']; */
		// $this->template->view($data);
		$this->load->view('content/print/voucher', $data);
	}
	/* Test function */
	// YnVkZ2V0L2dldF9udW1iZXI-
	public function get_number()
	{
		echo $this->Mod_po_co->generate_number('PO', PO_NUMBER_LENGTH, 129999);
	}
	/* Test function */
	// YnVkZ2V0L3VwZgxf1F0ZV9lc3RpbWF0ZQ--
	public function update_estimate()
	{
		// Get estimates
		$post_array = array();
		if($this->project_id > 0)
		{
			$post_array['builder_id'] = $this->builder_id;
			$post_array['project_id'] = $this->project_id;
		}
		$estimates_list = $this->Mod_budget->get_estimate(array(
							'select_fields' => array('*'),
							'where_clause' => $post_array
							));
		// Insert estimates
		$post_array = array();
		$post_array['project_id'] = $this->project_id;
		$post_array['builder_id'] = $this->builder_id;
		$post_array['cost_code_id'] = 8;
		$post_array['cost_code_name'] = 'LEED Consulting';
		$post_array['quantity'] = 1;
		$post_array['unit_cost'] = 750;
		$post_array['budget_amount'] = 750;
		$post_array['po_awarded_amount'] = 650;
		$post_array['po_count'] = 2;
		$post_array['co_awarded_amount'] = 0;
		$post_array['co_count'] = 0;
		$post_array['revised_contract'] = 650;
		$post_array['overhead_cost'] = 0;
		$post_array['estimated_profit_amount'] = 100;
		$post_array['bill_to_client_to_date'] = 750;
		$post_array['paid_by_client_to_date'] = 500;
		$post_array['unpaid_client_billing'] = 250;
		$post_array['balance_to_bill_client'] = 0;
		$post_array['invoiced_by_sub_to_date'] = 650;
		$post_array['amount_paid_to_sub'] = 650;
		$post_array['balance_to_be_invoiced_by_sub'] = 0;
		$post_array['total_balance_owed_to_sub'] = 0;
		$post_array['total_cost'] = 650;
		$post_array['profit_to_date'] = 100;
		$post_array['overall_profit'] = 100;
		
		// $estimates_list = $this->Mod_budget->add_estimate($post_array);
		// echo '<pre>';print_r($estimates_list);exit;
		$this->Mod_budget->update_estimate($post_array);
	}


	/** 
	* get_payament
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function change_po_co_status()
	{
		$result = $this->sanitize_input();
		if(TRUE == $result['status'])
		{
			if($result['data']['type'] == 'OWNER PO'){

				if($this->user_account_type == BUILDERADMIN)
				{
				  $user_type = 'Builder';
				}
				else if($this->user_account_type == OWNER)
				{
				  $user_type = 'Client';
				}
				$status = $result['data']['status'];
				switch ($status) 
				{
				case 'Accepted': //acceptance by sub / builder user
				// update ub_po_co table
				// Update estimate table
				$status_update = $status.' by '.$user_type;
				break;
				case 'Rejected': // Rejected by sub / builder user
				// update ub_po_co table
				$status_update = $status.' by '.$user_type;
				break;
				
				}
				$status_update_array = array(
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'po_status' => $status_update,
		    	'type' => $result['data']['type'],
		    	'user_type' => $user_type,
		    	);
		    	$notification_array = array(
		    	'template_type' => 'budget_po_co_approved',
		    	'project_id' => $result['data']['project_id'],
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'number' => $result['data']['ub_po_co_number'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'builder_id' => $result['data']['created_by'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'on' => TODAY,
		    	'status' => $status
		    	);
		    	//print_r($status_update_array);exit;
		    	$response = $this->Mod_po_co->update_po_co_status($status_update_array,$notification_array);
		    	if($result['data']['status'] == 'Accepted')
		        {
		          if(($result['data']['type'] == 'OWNER CO' || $result['data']['type'] == 'OWNER PO') && $this->user_account_type == OWNER)
			     {
			     	if(isset($result['data']['output'])){
			    	$signature = array(
					'search_params' => "'".serialize($result['data']['output'])."'"
				     );

			    	$signature_array = array(
		    	     'signature_content' => $signature['search_params'],
		    	     'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	    );
		    	    //print_r($signature_array);exit;
		    	    $signature_response = $this->Mod_po_co->add_signature($signature_array);
		    	  }
			     }
		    	
		    	for($i=0; $i< count($result['data']['cost_code_id']); $i++)
		    	{
		    		$insert_ary = array();

		    		$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $result['data']['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
		            $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);

		    		$insert_ary['cost_code_id'] = $result['data']['cost_code_id'][$i];
		    		$insert_ary['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		$insert_ary['client_contract'] = $result['data']['total'][$i];
		    		$insert_ary['project_id'] = $result['data']['project_id'];
		    		$insert_ary['client_contract_count'] = 1;
		    		$this->Mod_budget->update_estimate($insert_ary);
		 	    }
		 	  }
			}
			else if($result['data']['type'] == 'OWNER CO'){

				if($this->user_account_type == BUILDERADMIN)
				{
				  $user_type = 'Builder';
				}
				else if($this->user_account_type == OWNER)
				{
				  $user_type = 'Client';
				}
				$status = $result['data']['status'];
				switch ($status) 
				{
				case 'Accepted': //acceptance by sub / builder user
				// update ub_po_co table
				// Update estimate table
				$status_update = $status.' by '.$user_type;
				break;
				case 'Rejected': // Rejected by sub / builder user
				// update ub_po_co table
				$status_update = $status.' by '.$user_type;
				break;
				
				}
				$status_update_array = array(
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'po_status' => $status_update,
		    	'type' => $result['data']['type'],
		    	'user_type' => $user_type,
		    	);
		    	$notification_array = array(
		    	'template_type' => 'budget_po_co_approved',
		    	'project_id' => $result['data']['project_id'],
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'number' => $result['data']['ub_po_co_number'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'builder_id' => $result['data']['created_by'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'on' => TODAY,
		    	'status' => $status
		    	);
		    	//print_r($status_update_array);exit;
		    	$response = $this->Mod_po_co->update_po_co_status($status_update_array,$notification_array);
		    	if($result['data']['status'] == 'Accepted')
		        {
		          if(($result['data']['type'] == 'OWNER CO' || $result['data']['type'] == 'OWNER PO') && $this->user_account_type == OWNER)
			    {
			    	$signature = array(
					'search_params' => "'".serialize($result['data']['output'])."'"
				     );

			    	$signature_array = array(
		    	     'signature_content' => $signature['search_params'],
		    	     'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	    );
		    	    //print_r($signature_array);exit;
		    	    $signature_response = $this->Mod_po_co->add_signature($signature_array);
			    }
		    	
		    	for($i=0; $i< count($result['data']['cost_code_id']); $i++)
		    	{
		    		$insert_ary = array();

		    		$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $result['data']['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
		            $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);

		    		$insert_ary['cost_code_id'] = $result['data']['cost_code_id'][$i];
		    		$insert_ary['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		$insert_ary['client_co'] = $result['data']['total'][$i];
		    		$insert_ary['project_id'] = $result['data']['project_id'];
		    		$insert_ary['client_co_count'] = 1;
		    		$this->Mod_budget->update_estimate($insert_ary);
		 	    }
		 	  }
			}
			else{
			if($this->user_account_type == BUILDERADMIN)
			{
				$user_type = 'Builder';
			}
			else if($this->user_account_type == SUBCONTRACTOR)
			{
				$user_type = 'Sub';
			}


			$status = $result['data']['status'];

			switch ($status) 
		   {
			case 'Accepted': //acceptance by sub / builder user
				// update ub_po_co table
				// Update estimate table
				$status_update = $status.' by '.$user_type;
				break;
			case 'Rejected': // Rejected by sub / builder user
				// update ub_po_co table
				$status_update = $status.' by '.$user_type;
				break;
			case 'Work Completed': // Work completed
				// update ub_po_co table
				$status_update = $status;
				break;
		    }
		    //print_r($result);exit;
		    $status_update_array = array(
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'po_status' => $status_update,
		    	'type' => $result['data']['type'],
		    	'user_type' => $user_type,
		    	);
		    $notification_array = array(
		    	'template_type' => 'budget_po_co_approved',
		    	'project_id' => $result['data']['project_id'],
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'number' => $result['data']['ub_po_co_number'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'builder_id' => $result['data']['created_by'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'on' => TODAY,
		    	'status' => $status
		    	);
		    $response = $this->Mod_po_co->update_po_co_status($status_update_array,$notification_array);
		    if(isset($result['data']['cost_code_id'])){
		    if($result['data']['status'] == 'Accepted')
		    {
		    	if($result['data']['type'] == 'PO'){
		    	for($i=0; $i< count($result['data']['cost_code_id']); $i++)
		    	{
		    		$insert_ary = array();

		    		$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $result['data']['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
		            $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);

		    		$insert_ary['cost_code_id'] = $result['data']['cost_code_id'][$i];
		    		$insert_ary['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		$insert_ary['po_awarded_amount'] = $result['data']['total'][$i];
		    		$insert_ary['project_id'] = $result['data']['project_id'];
		    		$insert_ary['po_count'] = 1;
		    		$this->Mod_budget->update_estimate($insert_ary);
		 	    }
		 	  }
		 	  else if($result['data']['type'] == 'CO'){
		 	  	
		 	  	for($i=0; $i< count($result['data']['cost_code_id']); $i++)
		    	{
		    		$insert_ary = array();

		    		$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $result['data']['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
		            $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);

		    		$insert_ary['cost_code_id'] = $result['data']['cost_code_id'][$i];
		    		$insert_ary['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		$insert_ary['co_awarded_amount'] = $result['data']['total'][$i];
		    		$insert_ary['project_id'] = $result['data']['project_id'];
		    		$insert_ary['co_count'] = 1;
		    		$this->Mod_budget->update_estimate($insert_ary);
		 	    }
		 	    
		 	  }
		 	
		 	}
		   }
		  }
			$this->Mod_budget->response($response);
		
		}
	}

	/** 
	* get_payament
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function change_payment_status()
	{
		$result = $this->sanitize_input();
		//print_r($result);exit;
		if(TRUE == $result['status'])
		{
			
			$status = $result['data']['status_val'];
			//print_r($result);
			switch ($status) 
		   {
			case 'Approved': //acceptance by sub / builder user
				// update ub_po_co table
				// Update estimate table
				$status = $status;
				$override = 'No';
				break;
			case 'Rejected': // Rejected by sub / builder user
				// update ub_po_co table
				$status = $status;
				$override = 'No';
				break;
			case 'override': // Work completed
				// update ub_po_co table
				$status = 'Approved';
				$override = 'Yes';
				break;
		    }
		    
		    $status_update_array = array(
		    	'ub_po_co_payment_request_id' => $result['data']['ub_po_co_payment_id'],
		    	'payment_request_status' => $status,
		    	'override' => $override
		    	);
		    $response = $this->Mod_po_co->update_payment_status($status_update_array);
		    if($override == 'Yes')
		    {
		    	$voucher_document_list_args = array('select_fields' => array('PAYMENT_DOCOUMENTS.name'),
			    'where_clause' => (array('PAYMENT_DOCOUMENTS.payment_request_id' =>  $result['data']['ub_po_co_payment_id'],'PAYMENT_DOCOUMENTS.file_id !=' => 0))
			    );
			    $voucher_document_list['voucher_documents'] = $this->Mod_po_co->get_po_co_payment_request_documents($voucher_document_list_args);
			    if($voucher_document_list['voucher_documents']['status'] == TRUE){
			    $data['voucher_documents'] = $voucher_document_list['voucher_documents']['aaData'];
			    
			     $documents = array_column($voucher_document_list['voucher_documents']['aaData'], 'name');
			     $document_lists = implode(',',$documents);
			     //echo implode(',',$documents);exit;
			     //print_r($first_names);exit;

		    	$notification_array = array(
		    	'template_type' => 'budget_po_co_document_overridden',
		    	'project_id' => $result['data']['project_id'],
		    	'ub_po_co_id' => $result['data']['ub_po_co_id'],
		    	'project_name' => $this->project_name,
		    	'type' => $result['data']['type'],
		    	'title' => $result['data']['title'],
		    	'number' => $result['data']['ub_po_co_number'],
		    	'name' => $this->user_session['first_name'],
		    	'date' => $result['data']['due_date'],
		    	'assigned_to' => $result['data']['assigned_to'],
		    	'builder_id' => $result['data']['created_by'],
		    	'document_name' => $document_lists,
		    	'on' => TODAY,
		    	);
		    	 $this->Mod_po_co->send_mail_for_notification('',$notification_array);
		      }
		    }

		    // Insert array in ub_voucher table
		    if($status == 'Approved')
		    {
		     
	    		$insert_ary = array();
	    		$insert_ary['builder_id'] = $this->builder_id;
	    		$insert_ary['project_id'] = $result['data']['project_id'];
	    		$insert_ary['user_id'] = $result['data']['assigned_to'];
	    		$responses = $this->Mod_po_co->add_voucher($insert_ary);

	    		for($i=0; $i< count($result['data']['po_co_item_id']); $i++)
		    	{
		    		$cost_code_data[] = $this->Mod_po_co->get_po_co_cost_code(array(
								'select_fields' => array('PO_CO_COST_CODE.paid_amount','PO_CO_COST_CODE.total'),
								'where_clause' => array('PO_CO_COST_CODE.ub_po_co_cost_code_id' =>  $result['data']['ub_po_co_cost_code_id'][$i])
								));

		    		$cost_code_insert_ary = array();

		    		$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $result['data']['po_co_item_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
		            $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);

		            $cost_code_insert_ary['voucher_id'] = $responses['insert_id'];
		            $cost_code_insert_ary['builder_id'] = $this->builder_id;
		            $cost_code_insert_ary['project_id'] = $result['data']['project_id'];
		            $cost_code_insert_ary['payment_id'] = $result['data']['ub_po_co_payment_id'];
		            $cost_code_insert_ary['po_co_id'] = $result['data']['ub_po_co_id'];
		    		$cost_code_insert_ary['cost_code_id'] = $result['data']['po_co_item_id'][$i];
		    		$cost_code_insert_ary['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		$cost_code_insert_ary['gross_amount'] =  $result['data']['requested_amount'][$i];
		    		$cost_code_insert_ary['net_amount'] = $result['data']['requested_amount'][$i] + $cost_code_data[$i]['aaData'][0]['paid_amount'];
		    		$cost_code_insert_ary['retention_amount'] = $cost_code_data[$i]['aaData'][0]['total'] - $cost_code_insert_ary['net_amount'];
		    		$cost_code_insert_ary['created_by'] = $this->user_session['ub_user_id'];
			        $cost_code_insert_ary['created_on'] = TODAY;
			        $cost_code_insert_ary['modified_by'] = $this->user_session['ub_user_id'];
			        $cost_code_insert_ary['modified_on'] = TODAY;
		    		$this->Mod_po_co->add_voucher_transaction($cost_code_insert_ary);
		 	    }
		 	 $this->Mod_po_co->response($responses);
		 	}
		    //End
		    if($status == 'Rejected')
		    {
		     $this->Mod_po_co->response($response);
		    }
		}
	}

	/** 
	* Delete po_co
	* 
	* @method: delete_po_co 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: bgxf19ncy9kZWxldgxf1Vfbgxf19nLw--
	*/
	public function delete_po_co()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_po_co->delete_po_co($result['data']);

				if($response['type'] == 'PO')
				{
					$respoce_array = $this->get_po($cost_code_id = 0,$type='',$page_count = 'result_array');
				}
				if($response['type'] == 'CO')
				{
					$respoce_array = $this->get_co($page_count = 'result_array');
				}
				if($response['type'] == 'OWNER PO')
				{
					$respoce_array = $this->get_owner_po($page_count = 'result_array');
				}
				if($response['type'] == 'OWNER CO')
				{
					$respoce_array = $this->get_owner_co($page_count = 'result_array');
				}
				//echo '<pre>';print_r($respoce_array);exit;
				if($respoce_array['status'] == FALSE)
				{
					if($response['type'] == 'PO')
					{
						$this->module = 'BUDGET_PO';
						$search = 'po_search';
					}
					if($response['type'] == 'CO')
					{
						$this->module = 'BUDGET_CO';
						$search = 'co_search';
					}
					if($response['type'] == 'OWNER CO')
					{
						$this->module = 'BUDGET_OWNER_CO';
						$search = 'owner_co_search';
					}
					if($response['type'] == 'OWNER PO')
					{
						$this->module = 'BUDGET_OWNER_PO';
						$search = 'owner_po_search';
					}
					if(isset($this->uni_session_get($search)['iDisplayStart']) && $this->uni_session_get($search)['iDisplayStart'] > 0)
					{
						$search_session_array['iDisplayStart'] = (($this->uni_session_get($search)['iDisplayStart']) - ($this->uni_session_get($search)['iDisplayLength']));
				        $search_session_array['iDisplayLength'] = $this->uni_session_get($search)['iDisplayLength'];
				        $this->uni_set_session($search, $search_session_array);
					}
				}
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_po_co->response($response);
	}

	public function subcontractor_po()
	{
		$data = array(
		'title'        			=> "UNIBUILDER",		
		'content'     			=> 'content/budget/subcontractor_po_co',
        'page_id'      			=> 'budget',
		'data_table'   			=> 'data_table',
		'budget_po_list'  		=> 'budget_po_list',     
		'budget_co_list'  		=> 'budget_co_list',     
		);
		//Get builder po_co status from general value table
		$args = array('classification'=>'po_co_status', 'type'=>'dropdown');
		$status_result = $this->Mod_general_value->get_general_value($args);
		$data['status_result']=$status_result['values'];
		//Get builder po_co_payment status from general value table
		$args = array('classification'=>'po_co_payment_status', 'type'=>'dropdown');
		$payment_result = $this->Mod_general_value->get_general_value($args);
		$data['payment_result']=$payment_result['values'];
		//apply filter po
		// echo '<pre>';print_r($this->session->all_userdata());exit;
		$this->module = 'BUDGET_PO';
		$data['po_search_session_array'] =  $this->uni_session_get('po_search');	
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['po_apply_filter'] = true;
		}
		else
		{
			$data['po_apply_filter'] = false;;
		}	
		//apply filter co
		$this->module = 'BUDGET_CO';
		$data['co_search_session_array'] = $this->uni_session_get('co_search');		
		$post_array = array('builder_id' => $this->builder_id,
							 'user_id' => $this->user_id,
							 'module_name' => $this->module
		 );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if($result_data['status'] == true)
		{
			$data['co_apply_filter'] = true;
		}
		else
		{
			$data['co_apply_filter'] = false;;
		}
		// echo '<pre>';print_r($data);exit;
		$this->template->view($data);
	}
	public function sub_save_po_co($type,$ub_po_co_id = 0)
	{
		$data = array(
		'title'        			=> $type,		
		'content'     			=> 'content/budget/sub_save_po_co',
        'page_id'      			=> 'budget',
        'type'                  => $type
		);
		
		/* file upload code starts here // by satheesh*/	
		$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => 'poco'))
                               );
		$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
		if (isset($all_folder['aaData']) && !empty($all_folder)) 
		{
				$data['folder_id'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
		}
		/* -- file upload codes ends here */
		$date_array = array('PO_CO.due_date' => 'scheduled_completion');

		$result_data = $this->Mod_po_co->get_po_co(array(
					         'select_fields' => array('SUBCONTRACTOR.company as first_name','PO_CO.ub_po_co_number','PROJECT.ub_project_id','PROJECT.project_name','PO_CO.ub_po_co_id','PO_CO.builder_id','PO_CO.project_id','PO_CO.title','PO_CO.assigned_to','PO_CO.materials_only','PO_CO.due_date','PO_CO.notes','PO_CO.scope_of_work','PO_CO.bid_po_id','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.po_status','SUM(PO_CO_COST_CODE.total) AS total','PO_CO.created_by,'.$this->Mod_user->format_user_datetime($date_array,"date")) ,
			                 'join'=> array('project'=>'Yes','user'=>'Yes','po_co_cost_code' => 'Yes','sub_contractor' => 'Yes'),  
			                 'where_clause' => (array('ub_po_co_id' =>  $ub_po_co_id))
			                ));
		//print_r($result_data);
				if(TRUE === $result_data['status'])
			    {
				  $data['budget_po_data']  = $result_data['aaData'][0];
			    }

			    $cost_code_args = array('select_fields' => array('Group_concat(PO_CO_COST_CODE.ub_po_co_cost_code_id) as ub_po_co_cost_code_id','Group_concat(PO_CO_COST_CODE.cost_code_id) as cost_code_id','Group_concat(PO_CO_COST_CODE.quantity) as quantity','Group_concat(PO_CO_COST_CODE.unit_cost) as unit_cost','Group_concat(PO_CO_COST_CODE.total) as total','PO_CO.po_status'),
                    'where_clause' => (array('PO_CO_COST_CODE.po_co_id' =>  $ub_po_co_id)),'join' =>array('po_co'=>'Yes','variance_code'=>''),); 

		       $cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);
		
		      if($cost_code_result['status'] == TRUE){
			$data['cost_code_data'] = $cost_code_result['aaData'][0];
	        }

			   
			       
		    //echo "<pre>";print_r($cost_code_result);
		$this->template->view($data);
	}
	/** 
	* Get PO CO Payment
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function po_cost_list()
	{
	// echo "HI";exit;
	$result = $this->sanitize_input();
	$post_array[] = array(
							'field_name' => 'PO_CO_COST_CODE.po_co_id',
							'value'=> $result['data']['po_co_id'], 
							'type' => '='
							);						

		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo'<pre>';print_r($result);
			$search_session_array=array();
			if(TRUE === $result['status'])
			{	
				$where_str = $this->Mod_po_co->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co_cost_code(array(
												'select_fields' => array('COUNT(PO_CO_COST_CODE.ub_po_co_cost_code_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
												
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'PO_CO_COST_CODE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'PO_CO_COST_CODE.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('VARIANCE_CODE.cost_variance_code','PO_CO_COST_CODE.cost_code_id','PO_CO_COST_CODE.unit_cost','PO_CO_COST_CODE.quantity','PO_CO_COST_CODE.total'),
		'join'=> array('po_co'=>'Yes','variance_code'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_po_co->get_po_co_cost_code($query_array);
		
		// The following parameters required for data table

		if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
					
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data

		$this->Mod_po_co->response($result_data);
	}
	public function sub_save_co()
	{
		$data = array(
		'title'        			=> "UNIBUILDER",		
		'content'     			=> 'content/budget/sub_save_co',
        'page_id'      			=> 'budget'     
		);
		$this->template->view($data);
	}

	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_po_co->destroy_session($result['data']);
			}
			$this->Mod_po_co->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
		
	/** 
	* Apply Saved Search
	* 
	* @method: apply_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* @created by: Gayathri kalyani 
	* @created on: 03/04/2015 
	* url encoded : 
	*/
	public function po_apply_saved_search()
	{
		 $this->module = 'BUDGET_PO';
		/* Apply Filter code starts here */
		   $post_array = array( 'builder_id' => $this->user_session['builder_id'],
							    'user_id' => $this->user_session['ub_user_id'],
							    'module_name' => $this->module
		                      );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if(!empty($this->input->post()))
		{
			if($result_data['status'] == true)
			{
				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
				$task_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($task_array)."'"
				    );
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
			else
			{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
		}
		else
	{
		 $serialized_data = $result_data['aaData'][0]['search_params'];
		 $remove_single_quote = str_replace("'", '', $serialized_data);
		 $unserialized_data = unserialize($remove_single_quote);
		 $result_data['aaData'][0]['search_params'] = $unserialized_data;
		 if(!empty($unserialized_data))
		{
				if(!empty($unserialized_data['due_date_time']))
				{
					// Set value in session
					$search_session_array['due_date_time'] = $unserialized_data['due_date_time'];
				}
				
				if(!empty($unserialized_data['po_status']))
				{
					// Set value in session
					$search_session_array['po_status'] = $unserialized_data['po_status'];
					
				}
				if(!empty($unserialized_data['payment_status']))
				{
					// Set value in session
					$search_session_array['payment_status'] = $unserialized_data['payment_status'];
					
				}
				
				// Setting session 
				$this->uni_set_session('po_search', $search_session_array);
				
				// Response data
				$this->Mod_po_co->response($result_data);
		}
	}

	}
	


	/** 
	* Get Setup Budget Documents
	* 
	* @method: get_setup_budget_documents 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_setup_budget_documents()
	{
		//$result = $this->sanitize_input();
		$post_array[] = array(
						'field_name' => 'BUDGET_DOCOUMENTS.builder_id',
						'value'=> $this->user_session['builder_id'], 
						'type' => '='
						);		
		$data = array();
		$documents_data = array();
		$where_str = $this->Mod_bid->build_where($post_array);
		$document_args = array('select_fields' => array('BUDGET_DOCOUMENTS.name'),
		 'where_clause' => $where_str); 

		$document_result = $this->Mod_po_co->get_setup_budget_documents($document_args);
		if($document_result['status'] == TRUE){
		$data['documents_data'] = $document_result['aaData'];
		//print_r($documents_data);exit;

		$responses = $this->load->view('content/budget/file_upload_block',$data,true);
		echo $responses; exit;	
		
		
		}
		
	}

	public function get_po_co_payment_request_documents()
	{
		$result = $this->sanitize_input();
		//print_r($result);
		$post_array[] = array(
						'field_name' => 'PAYMENT_DOCOUMENTS.payment_request_id',
						'value'=> $result['data']['ub_po_co_payment_id'], 
						'type' => '='
						);		
		$data = array();
		$documents_data = array();
		$where_str = $this->Mod_bid->build_where($post_array);
		$document_args = array('select_fields' => array('PAYMENT_DOCOUMENTS.file_id','PAYMENT_DOCOUMENTS.name'),
		 'where_clause' => $where_str); 

		$document_result = $this->Mod_po_co->get_po_co_payment_request_documents($document_args);
		if($document_result['status'] == TRUE){
		//$documents_data = $document_result['aaData'];
	    //$data['documents_data'] = $document_result['aaData'];
		//print_r($documents_data);exit;
		/* Fetch file path */
			$user_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $result['data']['project_id'],
								  'folderid' => 0,
								  'modulename' => 'payment',
								  'moduleid' => $result['data']['ub_po_co_payment_id'],
								);
			$file_array = $this->Mod_doc->get_files_for_folder($user_data);
			//$documents_data = $result_array;
			 //echo "<pre>";print_r($document_result);
			 //echo "<pre>";print_r($file_array);exit;
		
		$doc_ary = $document_result['aaData'];
		$payment_request_document_ary = array();
		if(!isset($file_array[0]['message']) && !empty($file_array)){
		for($i=0; $i < count($doc_ary); $i++)
		{
			for($j=0; $j < count($file_array); $j++)
			{
				if(isset($file_array[$j]['ub_doc_file_id']) && $doc_ary[$i]['file_id'] == $file_array[$j]['ub_doc_file_id'])
				{
					//echo "hi";
					$payment_request_document_ary[$i] = array_merge($doc_ary[$i], $file_array[$j]);
					break;
				}
				else
				{
					//echo "hi";
					$payment_request_document_ary[$i] = $doc_ary[$i];
				}
			  

			}
			//$payment_request_document_ary[$i] = $doc_ary[$i];


		}}
		else
		{
			//echo count($document_result['aaData']);
			for($i=0; $i < count($doc_ary); $i++)
		    {
		    	
				$payment_request_document_ary[$i] = $doc_ary[$i];
		    }
		}
		//echo "<pre>";print_r($payment_request_document_ary);exit;
		$data['result_array']  = $payment_request_document_ary;

		$responses = $this->load->view('content/budget/file_upload_block',$data,true);
		echo $responses; exit;	
		
		
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$responses = $this->load->view('content/budget/file_upload_block',$result,true);
		    echo $responses; exit;
			//$this->Mod_po_co->response($result);
		}
	}

	
	/** 
	* payapp apply saved search 
	* 
	* @method: payapp_apply_saved_search 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function payapp_apply_saved_search()
	{
		 $this->module = 'BUDGET_PAYAPP';
		/* Apply Filter code starts here */
		   $post_array = array( 'builder_id' => $this->user_session['builder_id'],
								'user_id' => $this->user_session['ub_user_id'],
								'module_name' => $this->module
							  );
		 $result_data = $this->Mod_saved_search->get_saved_search(array(
												 'select_fields' => array(),
												 'where_clause' => $post_array
												 ));
		if(!empty($this->input->post()))
		{
			if($result_data['status'] == true)
			{
				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
				$task_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($task_array)."'"
					);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
			else
			{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
		}
		else
		{
			$serialized_data = $result_data['aaData'][0]['search_params'];
			$remove_single_quote = str_replace("'", '', $serialized_data);
			$unserialized_data = unserialize($remove_single_quote);
			$result_data['aaData'][0]['search_params'] = $unserialized_data;
			if(!empty($unserialized_data))
			{
				if(!empty($unserialized_data['period_to']))
				{
					// Set value in session
					$search_session_array['period_to'] = $unserialized_data['period_to'];
				}

				if(!empty($unserialized_data['pay_app_name']))
				{
					// Set value in session
					$search_session_array['pay_app_name'] = $unserialized_data['pay_app_name'];
				}			
				// Setting session 
				// echo '<pre>';print_r($search_session_array);exit;				
				$this->uni_set_session('pay_app_search', $search_session_array);

				// Response data
				$this->Mod_po_co->response($result_data);
			}
		}
	}
	
	/** 
	* co apply saved search 
	* 
	* @method: co_apply_saved_search 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function co_apply_saved_search()
	{
		$this->module = 'BUDGET_CO';
		/* Apply Filter code starts here */
		$post_array = array( 'builder_id' => $this->user_session['builder_id'],
							'user_id' => $this->user_session['ub_user_id'],
							'module_name' => $this->module
						  );
		$result_data = $this->Mod_saved_search->get_saved_search(array(
											 'select_fields' => array(),
											 'where_clause' => $post_array
											 ));
		if(!empty($this->input->post()))
		{
			if($result_data['status'] == true)
			{
				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
				$task_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($task_array)."'"
				    );
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
			else
			{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
		}
		else
		{
			$serialized_data = $result_data['aaData'][0]['search_params'];
			$remove_single_quote = str_replace("'", '', $serialized_data);
			$unserialized_data = unserialize($remove_single_quote);
			$result_data['aaData'][0]['search_params'] = $unserialized_data;
			if(!empty($unserialized_data))
			{
				if(!empty($unserialized_data['co_due_date_time']))
				{
					// Set value in session
					$search_session_array['due_date_time'] = $unserialized_data['co_due_date_time'];
				}
				
				if(!empty($unserialized_data['co_status']))
				{
					// Set value in session
					$search_session_array['co_status'] = $unserialized_data['co_status'];
					
				}
				if(!empty($unserialized_data['co_payment_status']))
				{
					// Set value in session
					$search_session_array['co_payment_status'] = $unserialized_data['co_payment_status'];
					
				}
					
				// Setting session 	
				$this->uni_set_session('co_search', $search_session_array);
				
				// Response data
				$this->Mod_po_co->response($result_data);
			}
		}
	}
	/** 
	* owner_co apply saved search 
	* 
	* @method: owner_co_apply_saved_search 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function owner_co_apply_saved_search()
	{
		$this->module = 'BUDGET_OWNER_CO';
		/* Apply Filter code starts here */
		$post_array = array( 'builder_id' => $this->user_session['builder_id'],
							'user_id' => $this->user_session['ub_user_id'],
							'module_name' => $this->module
						  );
		$result_data = $this->Mod_saved_search->get_saved_search(array(
											 'select_fields' => array(),
											 'where_clause' => $post_array
											 ));
		if(!empty($this->input->post()))
		{
			if($result_data['status'] == true)
			{
				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
				$task_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($task_array)."'"
				    );
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
			else
			{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
		}
		else
		{
			$serialized_data = $result_data['aaData'][0]['search_params'];
			$remove_single_quote = str_replace("'", '', $serialized_data);
			$unserialized_data = unserialize($remove_single_quote);
			$result_data['aaData'][0]['search_params'] = $unserialized_data;
			if(!empty($unserialized_data))
			{
				if(!empty($unserialized_data['owner_co_due_date_time']))
				{
					// Set value in session
					$search_session_array['owner_co_due_date_time'] = $unserialized_data['owner_co_due_date_time'];
				} 
				
				if(!empty($unserialized_data['owner_co_status']))
				{
					// Set value in session
					$search_session_array['owner_co_status'] = $unserialized_data['owner_co_status'];
					
				}
				if(!empty($unserialized_data['costcode']))
				{
					// Set value in session
					$search_session_array['costcode'] = $unserialized_data['costcode'];
					
				}
					
				// Setting session 	
				$this->uni_set_session('owner_co_search', $search_session_array);
				// print_r($search_session_array);exit;
				// Response data
				$this->Mod_po_co->response($result_data);
			}
		}
	}
	
/** 
	* owner_co apply saved search 
	* 
	* @method: owner_co_apply_saved_search 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function owner_po_apply_saved_search()
	{
		$this->module = 'BUDGET_OWNER_PO';
		/* Apply Filter code starts here */
		$post_array = array( 'builder_id' => $this->user_session['builder_id'],
							'user_id' => $this->user_session['ub_user_id'],
							'module_name' => $this->module
						  );
		$result_data = $this->Mod_saved_search->get_saved_search(array(
											 'select_fields' => array(),
											 'where_clause' => $post_array
											 ));
		if(!empty($this->input->post()))
		{
			if($result_data['status'] == true)
			{
				$save_search_id = $result_data['aaData'][0]['ub_saved_search_id'];
				$task_array = $this->input->post();
				$post_array = array(
					'ub_saved_search_id' => $save_search_id,
					'search_params' => "'".serialize($task_array)."'"
				    );
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
			else
			{
				$task_array = $this->input->post();
				$post_array = array(
					'search_params' => "'".serialize($task_array)."'"
				);
				$response = $this->Mod_saved_search->update_saved_search($post_array);
				$this->Mod_saved_search->response($response);
			}
		}
		else
		{
			$serialized_data = $result_data['aaData'][0]['search_params'];
			$remove_single_quote = str_replace("'", '', $serialized_data);
			$unserialized_data = unserialize($remove_single_quote);
			$result_data['aaData'][0]['search_params'] = $unserialized_data;
			if(!empty($unserialized_data))
			{
				if(!empty($unserialized_data['owner_po_due_date_time']))
				{
					// Set value in session
					$search_session_array['owner_po_due_date_time'] = $unserialized_data['owner_po_due_date_time'];
				}
				
				if(!empty($unserialized_data['owner_po_status']))
				{
					// Set value in session
					$search_session_array['owner_po_status'] = $unserialized_data['owner_po_status'];
					
				}
				if(!empty($unserialized_data['costcode']))
				{
					// Set value in session
					$search_session_array['costcode'] = $unserialized_data['costcode'];
					
				}
					
				// Setting session 	
				$this->uni_set_session('owner_po_search', $search_session_array);
				
				// Response data
				$this->Mod_po_co->response($result_data);
			}
		}
	}	
	
	//import po/co from template
	public function import_budget_poco()
	{
		$result = $this->sanitize_input();
		//echo '<pre>';print_r($result['data']['template_id']);exit;
	
		//Insert in UB_PO_CO table
		$template_po_co_info = $this->Mod_template->get_template_po_co(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		if($template_po_co_info['status'] == TRUE)
		{
		 $po_co_data = $template_po_co_info['aaData'];
		 foreach ($po_co_data as $key => $value) {
		 	$value['project_id'] = $this->project_id;
		 	$po_co_id = $value['po_co_id'];
		 	$ub_template_po_co_id = $value['ub_template_po_co_id'];
		 	$value['created_on'] = TODAY;
		 	$value['modified_on'] = TODAY;
		 	$value['created_by'] = $this->user_session['ub_user_id'];
		 	$value['modified_by'] = $this->user_session['ub_user_id'];
		    unset($value['ub_template_po_co_id']);
		    unset($value['po_co_id']);
		    unset($value['due_date_time']);
		    unset($value['due_date']);
		    unset($value['due_time']);
		    unset($value['paid_amount']);
		    unset($value['template_id']);
			$po_co_response = $this->Mod_po_co->add_po_co_template($value);
			
		 
		 	$template_po_co_cost_code_info = $this->Mod_template->get_template_po_co_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'],'template_po_co_id' => $ub_template_po_co_id)
							));
		 
		 
		 

		 	 if($template_po_co_cost_code_info['status'] == TRUE)
		      {
		        $po_co_cost_code_data = $template_po_co_cost_code_info['aaData'];
		        foreach ($po_co_cost_code_data as $keys => $values) {
		        //print_r($bid_value);
		 	   $values['project_id'] = $this->project_id;
		 	   $values['po_co_id'] = $po_co_response['insert_id'];
		 	   $values['created_on'] = TODAY;
		 	   $values['modified_on'] = TODAY;
		 	   $values['created_by'] = $this->user_session['ub_user_id'];
		 	   $values['modified_by'] = $this->user_session['ub_user_id'];
		       unset($values['ub_template_po_co_cost_code_id']);
		       unset($values['template_id']);
		       unset($values['paid_amount']);
		       unset($values['requested_amount']);
		       unset($values['template_po_co_id']);
			   $this->Mod_po_co->add_po_co_cost_code($values);
			
		      }
	         }
		 }
	    }
		$this->Mod_po_co->response($template_po_co_info);
	}
	
	//import jobs from template
	public function import_budget_jobs()
	{
		$result = $this->sanitize_input();
		//echo '<pre>';print_r($result['data']['template_id']);exit;
	
		//Insert in UB_ESTIMATE table
		$template_estimate_info = $this->Mod_template->get_template_estimate(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'])
							));
		if($template_estimate_info['status'] == TRUE)
		{
			$estimate_data = $template_estimate_info['aaData'];
			foreach ($estimate_data as $key => $value)
			{
				$value['project_id'] = $this->project_id;
				unset($value['ub_template_estimate_id']);
				unset($value['estimate_id']);
				unset($value['template_id']);
				$this->Mod_budget->add_estimate($value);
			}
	     }
		$this->Mod_budget->response($template_estimate_info);
	}
	public function add_multiple_items($pro_id=0)
	{
		$data = array(
		'title'        			=> "UNIBUILDER",		
		'content'     			=> 'content/budget/add_estimate_multiple_items',
        'page_id'      			=> 'budget',
        'pro_id'                => $pro_id
		);
		//print_r($data);exit;
		// Get cost codes to list in add estimate form
		$args['where_clause'] = "(builder_id = ".$this->builder_id." || builder_id = 0 ) AND status = 'Active'";
		$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');
		$cost_code_options = $this->Mod_budget->get_db_option(UB_COST_CODE, $args);
		array_unshift($cost_code_options,'Select All');
		// echo '<pre>';print_r($cost_code_options);exit;
		$data['cost_code_options'] = $cost_code_options;
		
		// Get estimate list for specific builder and project
		if(!empty($this->project_id))
		{
			$esti_args['where_clause'] = "builder_id = ".$this->builder_id." AND project_id = ".$this->project_id."";
			$esti_args['select_fields'] = array('cost_code_id','cost_code_name');
			$proj_estimate_list = $this->Mod_budget->get_db_options(UB_ESTIMATE, $esti_args);
			$data['cost_code_options']=array_diff($data['cost_code_options'],$proj_estimate_list);
		}	

		if($pro_id > 0)
		{
			/*$cost_code_args =array(
					         'select_fields' => array('Group_concat(ESTIMATE.ub_estimate_id) as ub_estimate_id','Group_concat(ESTIMATE.cost_code_id) as cost_code_id','Group_concat(ESTIMATE.cost_code_name) as cost_code_name','Group_concat(ESTIMATE.quantity) as quantity','Group_concat(ESTIMATE.unit_cost) as unit_cost','Group_concat(ESTIMATE.overhead_cost) as overhead_cost','Group_concat(ESTIMATE.description) as description','Group_concat(ESTIMATE.unit_cost*ESTIMATE.quantity) as total'),
			                 'where_clause' => (array('ESTIMATE.project_id' =>  $pro_id)),
			                 //'join' =>array('variance_code'=>'Yes')
			                 );  */
		$cost_code_args =array(
					         'select_fields' => array('ESTIMATE.ub_estimate_id as ub_estimate_id','ESTIMATE.cost_code_id as cost_code_id','ESTIMATE.cost_code_name as cost_code_name','ESTIMATE.quantity as quantity','ESTIMATE.unit_cost as unit_cost','ESTIMATE.overhead_cost as overhead_cost','ESTIMATE.description as description','ESTIMATE.unit_cost*ESTIMATE.quantity as total'),
			                 'where_clause' => (array('ESTIMATE.project_id' =>  $pro_id)),
							 'order_clause' => 'ESTIMATE.cost_code_name ASC', 
			                 //'join' =>array('variance_code'=>'Yes')
			                 );
		$cost_code_result = $this->Mod_po_co->get_jobs($cost_code_args);
		//echo "<pre>";print_r($cost_code_result);exit;
		
		if($cost_code_result['status'] == TRUE){
			// $data['cost_code_data'] = $cost_code_result['aaData'][0];
			$data['cost_code_data'] = $cost_code_result['aaData'];
	    }
	  }
	// echo '<pre>';print_r($data);exit;
		$this->template->view($data);
	}
	
	/** 
	* Get Budget Summary for a Project(s) (It is used by budget_summary and project_budget)
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/	
	public function get_total_budget_summary()
	{

		$post_array[] = array(
							'field_name' => 'ESTIMATE.builder_id',
							'value'=> $this->builder_id, 
							'type' => '='
							);
		
		//$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			
			if(TRUE === $result['status'])
			{
				 	
				$where_str = $this->Mod_budget->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					/* $total_count_array = $this->Mod_budget->get_budget_summary(array(
												'select_fields' => array('COUNT(ESTIMATE.ub_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												'join'=> array('builder'=>'Yes','project'=>'Yes'), 
												'group_clause'=> array("ESTIMATE.builder_id")
												)); */
												
				}
				 // echo '<pre>';print_r($total_count_array);

				// Order by
			    $order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					
					// Get formatted sort name
					$format_sort_name = $this->Mod_budget->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'ESTIMATE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
					
				}
				else
				{
					$order_by_where = 'ESTIMATE.modified_on DESC';
				} 
			}
			else
			{
				$this->Mod_budget->response($result);
			}
		}
		
		//datatable column role access
		
		$headers = $this->user_role_access[strtolower('budget')];
		$role_based_query = array(strtolower('Budgeted Amount') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.budget_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_amount",
			  strtolower('Estimated Revenue') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.estimated_revenue),2,'".CURRENCY_FORMAT_TEXT."')) AS total_contract_price",
			  strtolower('(+/-) Budget') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.plus_minus_budget),2,'".CURRENCY_FORMAT_TEXT."')) AS total_plus_minus_budget",
			  strtolower('Total Vendor Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.revised_contract),2,'".CURRENCY_FORMAT_TEXT."')) AS total_revised_contract",
			  strtolower('Overhead / Inhouse') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.overhead_cost),2,'".CURRENCY_FORMAT_TEXT."')) AS total_overhead_cost",
			  strtolower('Estimated Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.estimated_profit_amount),2,'".CURRENCY_FORMAT_TEXT."')) AS total_estimated_profit_amount",
			  strtolower('Billed To Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.bill_to_client_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_bill_to_client_to_date",
			  strtolower('Balance TO Bill To Client') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.balance_to_bill_client),2,'".CURRENCY_FORMAT_TEXT."')) AS total_balance_to_bill_client",
			  strtolower('Paid By Client to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.paid_by_client_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_paid_by_client_to_date",
			  strtolower('Unpaid Client Billings') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.unpaid_client_billing),2,'".CURRENCY_FORMAT_TEXT."')) AS total_unpaid_client_billing",
			  strtolower('Invoiced by Sub to Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.invoiced_by_sub_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_invoiced_by_sub_to_date",
			  strtolower('Amount Paid To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.amount_paid_to_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS total_amount_paid_to_sub",
			  strtolower('Balance to be Invoiced By Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.balance_to_be_invoiced_by_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS total_balance_to_be_invoiced_by_sub",
			  strtolower('Total Balance Owed To Sub') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.total_balance_owed_to_sub),2,'".CURRENCY_FORMAT_TEXT."')) AS balance_owed_to_sub",
			  strtolower('Total Cost') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.total_cost),2,'".CURRENCY_FORMAT_TEXT."')) AS cost",
			  strtolower('Profit To Date') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.profit_to_date),2,'".CURRENCY_FORMAT_TEXT."')) AS total_profit_to_date",
			  strtolower('Overall Profit') => "CONCAT_WS('','".CURRENCY_SYMBOL."',format(SUM(ESTIMATE.overall_profit),2,'".CURRENCY_FORMAT_TEXT."')) AS total_overall_profit"
			  );	
		$select_query = array();
		$select_query[0] = $role_based_query[strtolower('Budgeted Amount')];
		$i=1;
		foreach($headers as $key => $val)				
		{
			if($headers[$key] == 1)
			{
				if(isset($role_based_query[$key]))
				{
					$select_query[$i] = $role_based_query[$key];
					$i++;
				}
			}
		}
		// echo '<pre>';print_r($select_query);exit;
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => $select_query,
		//array('SUM(ESTIMATE.budget_amount) AS total_amount','SUM(ESTIMATE.estimated_revenue) AS total_estimated_revenue','SUM(ESTIMATE.plus_minus_budget) AS total_plus_minus_budget','SUM(ESTIMATE.revised_contract)AS total_revised_contract','SUM(ESTIMATE.overhead_cost)AS total_overhead_cost','SUM(ESTIMATE.estimated_profit_amount)AS total_estimated_profit_amount','SUM(ESTIMATE.bill_to_client_to_date)AS total_bill_to_client_to_date ','SUM(ESTIMATE.balance_to_bill_client)AS total_balance_to_bill_client','SUM(ESTIMATE.paid_by_client_to_date)AS total_paid_by_client_to_date','SUM(ESTIMATE.unpaid_client_billing)AS total_unpaid_client_billing','SUM(ESTIMATE.invoiced_by_sub_to_date)AS total_invoiced_by_sub_to_date','SUM(ESTIMATE.amount_paid_to_sub)AS total_amount_paid_to_sub','SUM(ESTIMATE.balance_to_be_invoiced_by_sub)AS total_balance_to_be_invoiced_by_sub','SUM(ESTIMATE.total_balance_owed_to_sub)AS balance_owed_to_sub','SUM(ESTIMATE.total_cost)AS cost','SUM(ESTIMATE.profit_to_date)AS total_profit_to_date','SUM(ESTIMATE.overall_profit)AS total_overall_profit'),
		//'join'=> array('builder'=>'Yes','project'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'group_clause'=> array("ESTIMATE.builder_id"),
		'pagination' => $pagination_array
		);
		
		 // echo '<pre>';print_r($query_array);exit;
		/*  if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		}  */
		
		$result_data = $this->Mod_budget->get_budget_summary($query_array);
		
		// The following parameters required for data table
        if($result_data['status'] == FALSE)
		{
			$result_data = array();
			$result_data['aaData'] = array();
		}
		else
		{
					
			$result_data['iTotalRecords'] = 1;//isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = 1;//isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data
        
		$this->Mod_budget->response($result_data);
	}
	/** 
	* get_cost_code
	* 
	* @method: get_cost_code 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_cost_code($po_id = 0)
	{
		$result = $this->sanitize_input();
		//print_r($result);exit;

		$data = array();
		
		
			$cost_code_args = array('select_fields' => array('Group_concat(PO_CO_COST_CODE.ub_po_co_cost_code_id) as ub_po_co_cost_code_id','Group_concat(PO_CO_COST_CODE.cost_code_id) as cost_code_id','Group_concat(PO_CO_COST_CODE.quantity) as quantity','Group_concat(PO_CO_COST_CODE.unit_cost) as unit_cost','Group_concat(PO_CO_COST_CODE.total) as total','PO_CO.po_status','PO_CO.created_by','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
        'where_clause' => (array('PO_CO_COST_CODE.po_co_id' =>  $po_id)),'join' =>array('po_co'=>'Yes','variance_code'=>'Yes')); 

		$cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);
		//print_r($cost_code_result);exit;
		
		if($cost_code_result['status'] == TRUE){
			$data['cost_code_data'] = $cost_code_result['aaData'];
	    }
	    $args['where_clause'] = "builder_id = ".$this->builder_id." || builder_id = 0";
		$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');
		$cost_code_options = $this->Mod_po_co->get_db_options(UB_COST_CODE, $args);
		$data['cost_code_options'] = $cost_code_options;
		$responses = $this->load->view('content/budget/bid_po_cost_code',$data,true);
		echo $responses; exit;
		
	}
	/** 
	* save_owner_file
	* 
	* @method: save_owner_file 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function save_owner_file($ub_po_co_id = 0)
	{
		$result = $this->sanitize_input();
		//print_r($result);exit;
		//echo $ub_po_co_id;
		//print_r($_FILES);exit;
		if($this->user_account_type == OWNER)
		{
		$file_arry = array(
		    	'ub_po_co_id' => $ub_po_co_id,
		    	);
		/*if($result['data']['delete_val'] == 0){*/
		if(isset($_FILES['attachments']['name']) && $_FILES['attachments']['name']!='')
		{
			//echo "hi";exit;
			$res = $this->Mod_po_co->add_signature_file($file_arry);
		    $this->Mod_po_co->response($res);
		}
	    else
		{
			$data['status'] = TRUE;
			$this->Mod_po_co->response($data);
		}
	   /*}

		else
		{
			$data['status'] = TRUE;
			$this->Mod_po_co->response($data);
		}*/
	   }
	   else
	   {
	   		$data['status'] = TRUE;
			$this->Mod_po_co->response($data);
	   }
		
	}
}