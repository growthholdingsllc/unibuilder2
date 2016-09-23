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
	public function project_budget()
	{
		
		$data = array(
		'title'        						=> "UNIBUILDER",		
		'content'     						=> 'template/content/budget/project_budget',
        'page_id'      						=> 'budget',
		'data_table'   						=> 'data_table',
		'budget_summary_list'  				=> 'budget_summary_list',     
		'budget_jobs_list'  				=> 'budget_jobs_list',     
		'budget_pay_app_list'  				=> 'budget_pay_app_list',     
		'budget_po_list'  					=> 'budget_po_list',     
		'budget_co_list'  					=> 'budget_co_list',     
		'budget_pay_app_list_details'  		=> 'budget_pay_app_list_details'
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
												//'join'=> array('builder'=>'Yes')
												)); 
												
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
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('PROJECT.project_name','SUM(ESTIMATE.budget_amount) AS total_amount','((PROJECT.contract_price) + SUM(ESTIMATE.co_awarded_amount)) AS total_contract_price','SUM(ESTIMATE.revised_contract)AS total_revised_contract','SUM(ESTIMATE.overhead_cost)AS total_overhead_cost','SUM(ESTIMATE.estimated_profit_amount)AS total_estimated_profit_amount','SUM(ESTIMATE.bill_to_client_to_date)AS total_bill_to_client_to_date ','SUM(ESTIMATE.balance_to_bill_client)AS total_balance_to_bill_client','SUM(ESTIMATE.paid_by_client_to_date)AS total_paid_by_client_to_date','SUM(ESTIMATE.unpaid_client_billing)AS total_unpaid_client_billing','SUM(ESTIMATE.invoiced_by_sub_to_date)AS total_invoiced_by_sub_to_date','SUM(ESTIMATE.amount_paid_to_sub)AS total_amount_paid_to_sub','SUM(ESTIMATE.balance_to_be_invoiced_by_sub)AS total_balance_to_be_invoiced_by_sub','SUM(ESTIMATE.total_balance_owed_to_sub)AS balance_owed_to_sub','SUM(ESTIMATE.total_cost)AS cost','SUM(ESTIMATE.profit_to_date)AS total_profit_to_date','SUM(ESTIMATE.overall_profit)AS total_overall_profit','((SUM(ESTIMATE.overall_profit)/SUM((PROJECT.contract_price) + (ESTIMATE.co_awarded_amount)) )*100)AS profit'),
		'join'=> array('builder'=>'Yes','project'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'group_clause'=> array("PROJECT.ub_project_id"),
		'pagination' => $pagination_array
		);
		 // echo '<pre>';print_r($query_array);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_budget->get_budget_summary($query_array);
		
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
												//'join'=> array('builder'=>'Yes')
												)); 
												
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
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('PROJECT.project_name','SUM(ESTIMATE.budget_amount) AS total_amount','((PROJECT.contract_price) + SUM(ESTIMATE.co_awarded_amount)) AS total_contract_price','SUM(ESTIMATE.revised_contract)AS total_revised_contract','SUM(ESTIMATE.overhead_cost)AS total_overhead_cost','SUM(ESTIMATE.estimated_profit_amount)AS total_estimated_profit_amount','SUM(ESTIMATE.bill_to_client_to_date)AS total_bill_to_client_to_date ','SUM(ESTIMATE.balance_to_bill_client)AS total_balance_to_bill_client','SUM(ESTIMATE.paid_by_client_to_date)AS total_paid_by_client_to_date','SUM(ESTIMATE.unpaid_client_billing)AS total_unpaid_client_billing','SUM(ESTIMATE.invoiced_by_sub_to_date)AS total_invoiced_by_sub_to_date','SUM(ESTIMATE.amount_paid_to_sub)AS total_amount_paid_to_sub','SUM(ESTIMATE.balance_to_be_invoiced_by_sub)AS total_balance_to_be_invoiced_by_sub','SUM(ESTIMATE.total_balance_owed_to_sub)AS balance_owed_to_sub','SUM(ESTIMATE.total_cost)AS cost','SUM(ESTIMATE.profit_to_date)AS total_profit_to_date','SUM(ESTIMATE.overall_profit)AS total_overall_profit','((SUM(ESTIMATE.overall_profit)/SUM((PROJECT.contract_price) + (ESTIMATE.co_awarded_amount)))*100)AS profit'),
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
					
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
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
			//echo $ub_estimate_id;exit;
			//Select estimate details to display in edit page
			$result_data = $this->Mod_template->get_template_estimate(
			array(
			'select_fields' => array('TEMPLATE_ESTIMATE.ub_template_estimate_id'
			,'TEMPLATE_ESTIMATE.cost_code_id'
			,'TEMPLATE_ESTIMATE.description'
			,'TEMPLATE_ESTIMATE.quantity'
			,'TEMPLATE_ESTIMATE.unit_cost'
			,'TEMPLATE_ESTIMATE.budget_amount'
			,'TEMPLATE_ESTIMATE.overhead_cost'),
			'where_clause' => (array('TEMPLATE_ESTIMATE.ub_template_estimate_id' =>  $ub_estimate_id))
			));
			$result_data = $result_data['aaData'][0];
			
			// Get cost codes to list in edit estimate form
			$args['where_clause'] = "(builder_id = ".$this->builder_id." || builder_id = 0 ) AND status = 'Active'";
			$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');
			$cost_code_options = $this->Mod_budget->get_db_options(UB_COST_CODE, $args);
		
			//Below line will load the save_estimate page
			$response = $this->load->view("template/content/budget/save_estimate.php", array('result_data' => $result_data, 'cost_code_options' => $cost_code_options), true);
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
			//print_r($postdata);
			$ub_estimate_id = $postdata['ub_template_estimate_id'];
			// Add estimate
			$result = $this->sanitize_input();
			  // print_r($result);exit;
			if(TRUE === $result['status']) //if sanitize is done
			{
				$form_data = $this->forming_data_array($result['data']);
				//print_r($form_data);exit;
				if($ub_estimate_id > 0)
				{
					$form_data['ub_template_estimate_id'] = $ub_estimate_id;
					$response = $this->Mod_template->update_estimate($form_data);
				}
				else
				{
					$response = $this->Mod_template->add_estimate($form_data);
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
		$ub_template_estimate_id = $postdata['ub_template_estimate_id'];
		if($ub_template_estimate_id > 0)
		{
			$form_data['ub_template_estimate_id'] = $ub_template_estimate_id;
			$response = $this->Mod_template->delete_estimate($form_data);

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
		$this->Mod_template->response($response);
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
					'template_id' => $this->template_id,
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
			'select_fields' => array('PAYAPP.name','status'),
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
				$post_array[] = array(
									'field_name' => 'PAYAPP.project_id',
									'value'=> $this->project_id, 
									'type' => '='
									);
									
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
				else
				{
				$order_by_where = 'PAYAPP.modified_on DESC';
				}
                // Fetch argument building
                $pay_app_args = array('select_fields' => array('PAYAPP.ub_payapp_id','PAYAPP.payapp_number','PAYAPP.name','PAYAPP.period_to','PAYAPP.status'),
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
            // Sanitize input
            $result = $this->sanitize_input();
            if(TRUE == $result['status'])
            {
                if(isset($result['data']['payapp_id']) && $result['data']['payapp_id'] > 0)
                {
                    $certificate_info = $this->Mod_budget->get_payapp_certificate(array('where_clause'=>array('payapp_id'=>$result['data']['payapp_id'])));
                    // echo '<pre>';print_r($certificate_info);exit;
                    if(TRUE == $certificate_info['status'])
                    {
                        $response = $this->load->view("content/budget/payapp_certificate.php", array('certificate_info' => $certificate_info['aaData'][0]), true);
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
	* PO Index Page
	* 
	* @method: po 
	* @access: public 
	* @param:  
	* @return: array
	* @author: sidhartha 
	* @url: 
	*/
	public function po()
	{
		$data = array(
		'title'        			       => "PO",		
		'content'     			       => 'template/content/budget/po',
        'page_id'      			       => 'docs',
		'data_table'   			       => 'data_table',   
		'budget_po_list'  		       => 'budget_po_list',
		);
		$this->template->view($data);
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
	public function get_po($page_count = '')
	{
		if(!empty($this->template_id))
        {
            $post_array[] = array(
                            'field_name' => 'TEMPLATE_PO_CO.template_id',
                            'value'=> $this->template_id,
                            'type' => '='
                        );
        }
        else
        {
            $post_array[] = array(
                            'field_name' => 'TEMPLATE_PO_CO.template_id',
                            'value'=> $this->users_template_ids,
                            'type' => '||',
                            'classification' => 'primary_ids'
                        );
        } 
		$post_array[] = array(
							'field_name' => 'TEMPLATE_PO_CO.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
		
	    $other_where = '';
					
						
						
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
										'field_name' =>'TEMPLATE_PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($result['data']['due_date_time'])),
										'type' => '='
									);   
						$search_session_array['due_date_time'] = $result['data']['due_date_time'];
				}
				
                 // echo '<pre>';print_r($post_array);exit;
                
				// echo '<pre>';print_r($post_array); 	
				// Setting session 
				$this->module = 'BUDGET_PO';

				if($page_count == 'result_array')
				{
					if(isset($this->uni_session_get('po_search')['due_date_time']) && $this->uni_session_get('po_search')['due_date_time']!='')
				    {
					
					 // $formatted_date = explode(" ",$result['data']['daterange']);
					 $post_array[] = array(
										'field_name' =>'TEMPLATE_PO_CO.due_date',
										'value'=> date("Y-m-d", strtotime($this->uni_session_get('po_search')['due_date_time'])),
										'type' => '='
									);   
						//$search_session_array['due_date_time'] = $result['data']['due_date_time'];
				    }
				}

				$search_session_array['iDisplayStart'] = isset($result['data']['iDisplayStart'])?$result['data']['iDisplayStart']:$this->uni_session_get('po_search')['iDisplayStart'];
				$search_session_array['iDisplayLength'] = isset($result['data']['iDisplayLength'])?$result['data']['iDisplayLength']:$this->uni_session_get('po_search')['iDisplayLength'];

				$this->uni_set_session('po_search', $search_session_array);
				$where_str = $this->Mod_template->build_where($post_array);
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

					$total_count_array = $this->Mod_template->get_template_po_co(array(
												'select_fields' => array('COUNT(TEMPLATE_PO_CO.po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					$total_count_array = $this->Mod_template->get_template_po_co(array(
												'select_fields' => array('COUNT(TEMPLATE_PO_CO.po_co_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
				}

				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_template->get_template_po_co(array(
												'select_fields' => array('COUNT(TEMPLATE_PO_CO.po_co_id) AS total_count'),
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
					$order_by_where = 'TEMPLATE_PO_CO.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'TEMPLATE_PO_CO.modified_on DESC';
				}
				
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		$date_array = array('due_date_time'=>'due_date_time');
		$query_array = array('select_fields' => array('TEMPLATE_PO_CO.po_co_id','TEMPLATE_PO_CO.template_id','TEMPLATE_PO_CO.ub_template_po_co_id','TEMPLATE_PO_CO.title','TEMPLATE_PO_CO.ub_po_co_number','TEMPLATE_PO_CO.title','TEMPLATE_PO_CO.bid_po_id','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS assigned_to','TEMPLATE_PO_CO.due_date_time','TEMPLATE_PO_CO.po_status','TEMPLATE_PO_CO.work_completed','TEMPLATE_PO_CO.payment_status','TEMPLATE_PO_CO.total_amount','TEMPLATE_PO_CO.paid_amount','TEMPLATE_PO_CO.po_co_id,'.$this->Mod_user->format_user_datetime($date_array)),
		'join'=> array('user'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			//echo "hi";
			unset($query_array['pagination']);
		} 
		//echo "hi";
		$result_data = $this->Mod_template->get_template_po_co($query_array);

		if($page_count == 'result_array')
		{
			//print_r($result_data);exit;
			return $result_data;
		}
		// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('title','ub_po_co_number','bid_po_id','assigned_to','due_date_time','po_status','work_completed','payment_status','total_amount','paid_amount');
					
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
					
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
		// Response data

		$this->Mod_template->response($result_data);
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
	public function get_co()
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
							'field_name' => 'PO_CO.project_id',
							'value'=> $this->project_id, 
							'type' => '='
							);	
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
										'value'=> date("Y-m-d", strtotime($result['data']['due_date_time'])),
										'type' => '='
									);   
						$search_session_array['co_due_date_time'] = $result['data']['co_due_date_time'];
				   }
					if(isset($result['data']['po_status']) && $result['data']['po_status']!='' && $result['data']['po_status']!='Nothing selected' && $result['data']['po_status']!='null')
				   {
					$post_array[] = array(
										'field_name' => 'PO_CO.po_status',
										'value'=> $result['data']['po_status'], 
										'type' => '='
										);
					$search_session_array['co_status'] = $result['data']['po_status'];
				  }
                // echo '<pre>';print_r($result);
				
                   if(isset($result['data']['payment_status']) && $result['data']['payment_status']!='' && $result['data']['payment_status']!='Nothing selected' && $result['data']['payment_status']!='null')
				    {
					$post_array[] = array(
									'field_name' => 'PO_CO.payment_status',
									'value'=> $result['data']['payment_status'], 
									'type' => '='
									);
					$search_session_array['co_payment_status'] = $result['data']['payment_status'];
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
				}}
               	// echo '<pre>';print_r($result);exit;
				// Setting session 
				$this->module = 'BUDGET_CO';
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
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_po_co->get_po_co(array(
												'select_fields' => array('COUNT(PO_CO.	ub_po_co_id) AS total_count'),
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
		$query_array = array('select_fields' => array('PO_CO.ub_po_co_number','PO_CO.title','PO_CO.bid_po_id','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS assigned_to','PO_CO.due_date_time','PO_CO.po_status','PO_CO.work_completed','PO_CO.payment_status','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.ub_po_co_id'),
		'join'=> array('user'=>'Yes','builder'=>'Yes','po_co_cost_code' => '','project' => ''),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_po_co->get_po_co($query_array);
		//echo '<pre>';print_r($result['data']);exit;
		// File export request  
				if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
				{
					$field_list_array = array('title','ub_po_co_number','bid_po_id','assigned_to','due_date_time','po_status','work_completed','payment_status','total_amount','paid_amount');
					
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
					
			$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
			$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
		}
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
		if(!empty($this->template_id))
        {
            $post_array[] = array(
                            'field_name' => 'TEMPLATE_ESTIMATE.template_id',
                            'value'=> $this->template_id,
                            'type' => '='
                        );
        }
        else
        {
            $post_array[] = array(
                            'field_name' => 'TEMPLATE_ESTIMATE.template_id',
                            'value'=> $this->users_template_ids,
                            'type' => '||',
                            'classification' => 'primary_ids'
                        );
        } 
		$post_array[] = array(
							'field_name' => 'TEMPLATE_ESTIMATE.builder_id',
							'value'=> $this->user_session['builder_id'], 
							'type' => '='
							);
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

					$total_count_array = $this->Mod_template->get_template_estimate(array(
												'select_fields' => array('COUNT(TEMPLATE_ESTIMATE.ub_template_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
				}
				else if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);

					$total_count_array = $this->Mod_template->get_template_estimate(array(
												'select_fields' => array('COUNT(TEMPLATE_ESTIMATE.ub_template_estimate_id) AS total_count'),
					                            'where_clause' => $where_str,
												//'join'=> array('builder'=>'Yes')
												));
				}

				/*if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_template->get_template_estimate(array(
												'select_fields' => array('COUNT(TEMPLATE_ESTIMATE.ub_template_estimate_id) AS total_count'),
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
					$order_by_where = 'TEMPLATE_ESTIMATE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				else
				{
					$order_by_where = 'TEMPLATE_ESTIMATE.modified_on DESC';
				}
			}
			else
			{
				$this->Mod_po_co->response($result);
			}
		}
		//$date_array = array('TASK.due_date'=> 'due_date');
		$query_array = array('select_fields' => array('TEMPLATE_ESTIMATE.ub_template_estimate_id','TEMPLATE_ESTIMATE.estimate_id','TEMPLATE_ESTIMATE.cost_code_name','TEMPLATE_ESTIMATE.budget_amount','TEMPLATE_ESTIMATE.po_awarded_amount','TEMPLATE_ESTIMATE.po_count','TEMPLATE_ESTIMATE.co_awarded_amount','TEMPLATE_ESTIMATE.co_count','TEMPLATE_ESTIMATE.revised_contract','TEMPLATE_ESTIMATE.overhead_cost','TEMPLATE_ESTIMATE.estimated_profit_amount','TEMPLATE_ESTIMATE.bill_to_client_to_date','TEMPLATE_ESTIMATE.balance_to_bill_client','TEMPLATE_ESTIMATE.paid_by_client_to_date','TEMPLATE_ESTIMATE.unpaid_client_billing','TEMPLATE_ESTIMATE.invoiced_by_sub_to_date','TEMPLATE_ESTIMATE.amount_paid_to_sub','TEMPLATE_ESTIMATE.balance_to_be_invoiced_by_sub','TEMPLATE_ESTIMATE.total_balance_owed_to_sub','TEMPLATE_ESTIMATE.total_cost','TEMPLATE_ESTIMATE.profit_to_date','TEMPLATE_ESTIMATE.overall_profit'),
		'join'=> array('builder'=>'Yes'),
		'where_clause' => $where_str,
		'order_clause' => $order_by_where, 
		'pagination' => $pagination_array
		);
		//echo '<pre>';print_r($result['data']);exit;
		 if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			unset($query_array['pagination']);
		} 
		
		$result_data = $this->Mod_template->get_template_estimate($query_array);

		if($page_count == 'result_array')
        {
	      //print_r($result_data);exit;
	      return $result_data;
        }
		// File export request  
		if(isset($result['data']['fetch_type']) && $result['data']['fetch_type'] == 'export')
		{
			$field_list_array = array('cost_code_name','budget_amount','po_awarded_amount','po_count','co_awarded_amount','co_count','revised_contract','overhead_cost','estimated_profit_amount','bill_to_client_to_date','balance_to_bill_client','paid_by_client_to_date','unpaid_client_billing','invoiced_by_sub_to_date','amount_paid_to_sub','balance_to_be_invoiced_by_sub','total_balance_owed_to_sub','total_cost','profit_to_date','overall_profit');
			
			// Export file header column 
			$export_array['header'][0] = array('Cost Code Item','Budget','Award','PO','Change Order(+/-)','CO','Revised Contract','Overhead/Inhouse','Estimated Profit','Billed To Client to Date','Balance TO Bill Client','Paid By Client to Date','Unpaid Client Billings','Invoiced by Sub to Date','Amount Paid To Sub','Balance to be Invoiced By Sub','Total Balance Owed To Sub','Total Cost','Profit To Date','Overall Profit'); 
			
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
	public function save_po_co($type,$ub_template_po_co_id = 0)

	{
		
		$data = array(
		'title'        						=> $type,		
		'content'     						=> 'template/content/budget/save_po_co',
        'page_id'      						=> 'budget',
		'data_table'   						=> 'data_table',		     
		'po_scope_list'   					=> 'po_scope_list',		     
		'po_status_list'   					=> 'po_status_list',		     			     
		'po_bids_list'   					=> 'po_bids_list',		     
		'po_payment_list'   				=> 'po_payment_list',
		'type'								=> $type,
		'po_vocher_payment_list'   			=> 'po_vocher_payment_list'		     
		);
		
		//Codition check wheather the ub_po_co_id value is greater than 0 or not
		if($ub_template_po_co_id > 0 || null!==$this->input->post('ub_template_po_co_id') && $this->input->post('ub_template_po_co_id') > 0)
		{
			
			
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
				$po_co_update_array = array(
				'ub_template_po_co_id' => $result['data']['ub_template_po_co_id'],
				'template_id' => $result['data']['template_id'],
				'builder_id' => $this->user_session['builder_id'],
			  	'type' => $result['data']['type'],
			  	'title' => $result['data']['title'],
			  	'assigned_to' => $result['data']['assigned_to'],
			  	'materials_only' => isset($result['data']['materials_only']) ? "Yes" : "No",
			  	'due_date' => $result['data']['due_date'],
			  	'notes' => $result['data']['notes'],
			  	'total_amount' => array_sum($result['data']['total']),
			  	'po_status' => $result['data']['status'],
			  	'scope_of_work' => $result['data']['scope_of_work'],
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
	              
	            //Insert cost codes in ub_po_co_cost_code table
	            $new_status = $result['data']['status'];
                $stat = strstr($new_status, ' ', true); 

                //echo $stat;exit;
	            		
				$cost_code_update_array = array(
				'ub_template_po_co_cost_code_id' => $result['data']['ub_po_co_cost_code_id'],
				'template_po_co_id' => $result['data']['ub_template_po_co_id'],
				'template_id' => $result['data']['template_id'],
				'builder_id' => $this->user_session['builder_id'],
				'type' => $result['data']['type'],
				'ub_po_co_cost_code_id' => $result['data']['ub_po_co_cost_code_id'],
				'cost_code_id' => $result['data']['cost_code_id'],
				'quantity' => $result['data']['quantity'],
				'unit_cost' => $result['data']['unit_cost'],
				'total' => $result['data']['total'],
				'status' => $result['data']['status'],
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY,);}
				
	             if($result['data']['due_date'] == '')
			     {
				   unset($po_co_update_array['due_date']);
			     }
				//print_r($po_co_update_array);
			    $response = $this->Mod_template->update_po_co($po_co_update_array,$cost_code_update_array);
			    $this->Mod_template->response($response);
			  
			 }
			 else
			 {

				$result_data = $this->Mod_template->get_template_po_co(array(
					         'select_fields' => array('TEMPLATE_PO_CO.template_id','TEMPLATE_PO_CO.po_co_id','TEMPLATE_PO_CO.ub_template_po_co_id','TEMPLATE_PO_CO.ub_po_co_number','TEMPLATE_PO_CO.builder_id','TEMPLATE_PO_CO.title','TEMPLATE_PO_CO.materials_only','TEMPLATE_PO_CO.due_date','TEMPLATE_PO_CO.notes','TEMPLATE_PO_CO.scope_of_work','TEMPLATE_PO_CO.bid_po_id','TEMPLATE_PO_CO.total_amount','TEMPLATE_PO_CO.paid_amount','TEMPLATE_PO_CO.po_status','TEMPLATE_PO_CO.created_by'),
			                 //'join'=> array('project'=>'Yes','user'=>'Yes','po_co_cost_code' => 'Yes'),  
			                 'where_clause' => (array('ub_template_po_co_id' =>  $ub_template_po_co_id))
			                ));
				if(TRUE === $result_data['status'])
			    {
				  $data['budget_po_data']  = $result_data['aaData'][0];
			    }

			    $cost_code_args = array('select_fields' => array('Group_concat(TEMPLATE_PO_CO_COST_CODE.ub_template_po_co_cost_code_id) as ub_po_co_cost_code_id','Group_concat(TEMPLATE_PO_CO_COST_CODE.cost_code_id) as cost_code_id','Group_concat(TEMPLATE_PO_CO_COST_CODE.quantity) as quantity','Group_concat(TEMPLATE_PO_CO_COST_CODE.unit_cost) as unit_cost','Group_concat(TEMPLATE_PO_CO_COST_CODE.total) as total','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
        'where_clause' => (array('TEMPLATE_PO_CO_COST_CODE.template_po_co_id' =>  $ub_template_po_co_id)),'join' =>array('variance_code'=>'Yes'),); 

		$cost_code_result = $this->Mod_template->get_template_po_co_cost_code($cost_code_args);
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
			if(TRUE === $result['status'])
			{
				if(isset($result['data']['due_date']) && $result['data']['due_date'] !='')
			    {
				  $result['data']['due_date'] = date("Y-m-d", strtotime($result['data']['due_date']));
			    }
			   
				$po_co_insert_array = array(
			  	'builder_id' => $this->user_session['builder_id'],
			  	'template_id' => $this->template_id,
			  	'type' => $result['data']['type'],
			  	'title' => $result['data']['title'],
			  	'materials_only' => isset($result['data']['materials_only']) ? "Yes" : "No",
			  	'due_date' => $result['data']['due_date'],
			  	'notes' => $result['data']['notes'],
			  	'total_amount' => array_sum($result['data']['total']),
			  	'po_status' => $result['data']['status'],
	            'created_by' => $this->user_session['ub_user_id'],
	            'created_on' => TODAY,
	            'modified_by' => $this->user_session['ub_user_id'], 
	            'modified_on' => TODAY,);
	              
	            //Insert cost codes in ub_po_co_cost_code table
	            //print_r(array_unique($result['data']['cost_code_id']));exit;	
				$cost_code_insert_array = array(
				'builder_id' => $this->user_session['builder_id'],
				'project_id' => $this->project_id,
				'template_id' => $this->template_id,
				'type' => $result['data']['type'],
				'cost_code_id' => $result['data']['cost_code_id'],
				'quantity' => $result['data']['quantity'],
				'unit_cost' => $result['data']['unit_cost'],
				'total' => $result['data']['total'],
				'status' => $result['data']['status'],
				'created_by' => $this->user_session['ub_user_id'],
				'created_on' => TODAY,
				'modified_by' => $this->user_session['ub_user_id'], 
				'modified_on' => TODAY,);

	             if($result['data']['due_date'] == '')
			     {
				   unset($po_co_insert_array['due_date']);
			     }
			     

			     

				//print_r($po_co_insert_array);exit;
			    $response = $this->Mod_template->add_po_co($po_co_insert_array,$cost_code_insert_array);
			    $this->Mod_template->response($response);
			}
			else
			{
				$this->Mod_template->response($result);
			}
		  }
	    }
	    $args['where_clause'] = "builder_id = ".$this->builder_id." || builder_id = 0";
		$args['select_fields'] = array('ub_cost_variance_code_id','cost_variance_code');
		$cost_code_options = $this->Mod_po_co->get_db_options(UB_COST_CODE, $args);
		$data['cost_code_options'] = $cost_code_options;
	

		
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
                $bid_args = array('select_fields' => array('BID.package_title,'.$this->Mod_user->format_user_datetime($datetime_array)),
                'where_clause' => $where_str,
                'join'=> array('bid'=>'Yes'),
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$bid_data = $this->Mod_po_co->get_po_co_bid($bid_args);
			
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
		//echo print_r($result);
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
			  	'project_id' => $this->project_id,
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
		    	'project_id' => $this->project_id,
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

	            if(isset($result['data']['name']))
			    {
				  $file_arry = array(
			    	'name' => isset($result['data']['name'])?$result['data']['name']:'',
			    	'payment_id' => $result['data']['ub_po_co_payment_id']
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
			  	'project_id' => $this->project_id,
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
			  	'project_id' => $this->project_id,
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
		    	'project_id' => $this->project_id,
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
		    	'payment_id' => $response['insert_id']
		    	);
			   $this->Mod_po_co->add_documents($file_arry);
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
			  	'project_id' => $this->project_id,
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
		$payment_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code as cost_code','PO_CO_COST_CODE.cost_code_id','PO_CO_COST_CODE.total as original','PO_CO_COST_CODE.paid_amount as paid_amount','(PO_CO_COST_CODE.total - PO_CO_COST_CODE.paid_amount) AS out_standing','PO_CO_COST_CODE.ub_po_co_cost_code_id'),
		 'where_clause' => $where_str,'join' =>array('variance_code'=>'Yes')); 

		$payment_result = $this->Mod_po_co->po_co_payment_list($payment_args);
		if($payment_result['status'] == TRUE){
		$payment_data = $payment_result['aaData'];

		$responses = $this->load->view('content/budget/save_po_co_payment_transaction',array('payment_data' => $payment_data),true);
		echo $responses; exit;	
		
		
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
		$payment_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code as cost_code','PO_CO_COST_CODE.cost_code_id','PO_CO_COST_CODE.total as original','PO_CO_COST_CODE.paid_amount as paid_amount','(PO_CO_COST_CODE.total - PO_CO_COST_CODE.paid_amount) AS out_standing','PO_CO_COST_CODE.ub_po_co_cost_code_id','(PAYMENT_REQUEST_DETAILS.request_amount) AS requested_amount','PAYMENT_REQUEST_DETAILS.total_paid_amount','(PAYMENT_REQUEST_DETAILS.request_amount - PAYMENT_REQUEST_DETAILS.total_paid_amount) AS total_out_standing','PAYMENT_REQUEST_DETAILS.ub_po_co_payment_request_details_id'),
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
	public function get_voucher($voucher_id = 0,$payment_id = 0)
	{	
		$data = array(
		'title'		=> "UNIBUILDER",		
		'content'     => 'content/budget/voucher'
		);
		//$result = $this->sanitize_input();
		//get voucher data
		$voucher_list_args = array('select_fields' => array('VOUCHER.voucher_no','VOUCHER.company','VOUCHER.address','VOUCHER.city','VOUCHER.province','VOUCHER.postal','VOUCHER.desk_phone','VOUCHER.mobile_phone','VOUCHER.fax','VOUCHER.project_no','VOUCHER.project_name','VOUCHER.project_city','VOUCHER.project_address','VOUCHER.project_province','VOUCHER.project_postal','VOUCHER.project_country','VOUCHER.email'),
        'where_clause' => (array('VOUCHER.builder_id' => $this->builder_id ,'VOUCHER.project_id' => $this->project_id,'VOUCHER.ub_voucher_id' => $voucher_id)),
		'join' =>array('user'=>'Yes'));
		$voucher['voucher_list'] = $this->Mod_po_co->get_voucher($voucher_list_args);
		// echo '<pre>';print_r($voucher);exit;
		if($voucher['voucher_list']['status'] == TRUE){
		$data['voucher_list'] = $voucher['voucher_list']['aaData'][0];
		}
		//get voucher transaction data
		$voucher_transaction_args = array('select_fields' => array('VOUCHER_TRANSACTION.payment_id','VOUCHER_TRANSACTION.gross_amount','VOUCHER_TRANSACTION.retention_amount','VOUCHER_TRANSACTION.net_amount'),
        'where_clause' => (array('VOUCHER_TRANSACTION.builder_id' => $this->builder_id ,'VOUCHER_TRANSACTION.project_id' => $this->project_id,'VOUCHER_TRANSACTION.voucher_id' => $voucher_id)),
		'join' =>array('user'=>'Yes'));
		$voucher_transaction['voucher_transaction_data'] = $this->Mod_po_co->get_voucher_transaction($voucher_transaction_args);
		if($voucher_transaction['voucher_transaction_data']['status'] == TRUE){
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
		//echo '<pre>';print_r($data);exit;
		$this->template->view($data);
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
		    	'project_id' => $this->project_id,
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
		    		$insert_ary['project_id'] = $this->project_id;
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
		    		$insert_ary['project_id'] = $this->project_id;
		    		$insert_ary['co_count'] = 1;
		    		$this->Mod_budget->update_estimate($insert_ary);
		 	    }
		 	    
		 	  }}
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

		    // Insert array in ub_voucher table
		    if($status == 'Approved')
		    {
		     
	    		$insert_ary = array();
	    		$insert_ary['builder_id'] = $this->builder_id;
	    		$insert_ary['project_id'] = $this->project_id;
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
		            $cost_code_insert_ary['project_id'] = $this->project_id;
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
				$response = $this->Mod_template->delete_po_co($result['data']);

				$respoce_array = $this->get_po($page_count = 'result_array');

				if($respoce_array['status'] == FALSE)
				{
					$this->module = 'BUDGET_PO';

					if(isset($this->uni_session_get('po_search')['iDisplayStart']) && $this->uni_session_get('po_search')['iDisplayStart'] > 0)
					{
						$search_session_array['iDisplayStart'] = (($this->uni_session_get('po_search')['iDisplayStart']) - ($this->uni_session_get('po_search')['iDisplayLength']));
				        $search_session_array['iDisplayLength'] = $this->uni_session_get('po_search')['iDisplayLength'];
				        $this->uni_set_session('po_search', $search_session_array);
					}
				}
			}
			else
			{
				$this->Mod_template->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_template->response($response);
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
		$this->template->view($data);
	}
	public function sub_save_po_co($type,$ub_po_co_id = 0)
	{
		$data = array(
		'title'        			=> "UNIBUILDER",		
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
		
		$result_data = $this->Mod_po_co->get_po_co(array(
					         'select_fields' => array('PO_CO.ub_po_co_number','PROJECT.ub_project_id','PROJECT.project_name','PO_CO.ub_po_co_id','PO_CO.builder_id','PO_CO.project_id','PO_CO.title','PO_CO.assigned_to','PO_CO.materials_only','PO_CO.due_date','PO_CO.notes','PO_CO.scope_of_work','PO_CO.bid_po_id','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.po_status','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name','SUM(PO_CO_COST_CODE.total) AS total','PO_CO.created_by') ,
			                 'join'=> array('project'=>'Yes','user'=>'Yes','po_co_cost_code' => 'Yes'),  
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
								  'projectid' => $this->project_id,
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
	
	//import po/co from template
	public function import_budget_poco()
	{
		$result = $this->sanitize_input();
		//echo '<pre>';print_r($result['data']['template_id']);exit;
	
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
		 	$value['created_on'] = TODAY;
		 	$value['modified_on'] = TODAY;
		 	$value['created_by'] = $this->user_session['ub_user_id'];
		 	$value['modified_by'] = $this->user_session['ub_user_id'];
		    unset($value['ub_template_po_co_id']);
		    unset($value['po_co_id']);
		    unset($value['template_id']);
			$po_co_response = $this->Mod_po_co->add_po_co_template($value);
			
		 
		 $template_po_co_cost_code_info = $this->Mod_template->get_template_po_co_cost_code(array(
							'select_fields' => array('*'),
							'where_clause' => array('template_id' => $result['data']['template_id'],'po_co_id' => $po_co_id)
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
}