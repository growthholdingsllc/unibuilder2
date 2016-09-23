<?php
/** 
 * Budget Model
 * 
 * @package: Budget Model
 * @subpackage: Budget Model 
 * @category: Budget
 * @author: Gopakumar, Thiyagaraj, Gayathri, MS, Sidhartha, Satheesh
 * @createdon(DD-MM-YYYY): 29-05-2015
*/
class Mod_budget extends UNI_Model
{
	/**
	 * @property: $user_id
	 * @access: public
	 */

	public $user_id;
	
	
    /**
	 * @constructor
	 */
	public function __construct() 
	{
		parent::__construct();
		$this->load->model(array('Mod_po_co','Mod_builder'));
    }
	
	/**
	*
	* get_cost_code
	*
	* @method: get_cost_code
	* @access: public 
	* @param: post data
	* @return: Get cost code
	*/
	public function get_cost_code($args=array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_COST_CODE.' AS COSTCODE');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['code']))
		{
			//write join code if need
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		$res = $this->read_db->get();
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		return $data;
	}
	/**
	*
	* Update Estimate
	*
	* @method: update_estimate
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function update_estimate($post_array = array())
	{
		//print_r($post_array);exit;
		if(isset($post_array['cost_code_id']) && $post_array['cost_code_id'] > 0)
		{
			$existing_estimate_info = $this->get_estimate(array(
							'select_fields' => array('*'),
							'where_clause' => array('cost_code_id' => $post_array['cost_code_id'],'project_id' => $post_array['project_id'])
							));
			// echo '<pre>post_array';print_r($post_array);
			// echo '<pre>existing_estimate_info';print_r($existing_estimate_info);exit;
			if(FALSE == $existing_estimate_info['status'])
			{
				// Add Estimate - PO / CO Acceptance
				$insert_ary['builder_id'] = $this->builder_id;
				$insert_ary['project_id'] = $post_array['project_id'];
				$insert_ary['cost_code_id'] = $post_array['cost_code_id'];
				$insert_ary['cost_code_name'] = $post_array['cost_code_name'];
				// $insert_ary['po_awarded_amount'] = $post_array['po_awarded_amount'];
				// $insert_ary['po_count'] = $post_array['po_count'];
				//  Add Estimate
				$estimates_list = $this->add_estimate($insert_ary);
				$data['status'] = TRUE;
				$data['message'] = 'Inserted successfully';
			}
			// else
			// {
				// Update Estimate
				
				// Client PO Update
				if(isset($post_array['client_contract']))
				{
					$this->write_db->set('client_contract', '(client_contract+'.$post_array['client_contract'].')', FALSE);
				}
				if(isset($post_array['client_contract_count']))
				{
					$this->write_db->set('client_contract_count', '(client_contract_count+'.$post_array['client_contract_count'].')', FALSE);
				}
				
				// Client CO Update
				if(isset($post_array['client_co']))
				{
					$this->write_db->set('client_co', '(client_co+'.$post_array['client_co'].')', FALSE);
				}
				if(isset($post_array['client_co_count']))
				{
					$this->write_db->set('client_co_count', '(client_co_count+'.$post_array['client_co_count'].')', FALSE);
				}
				
				// PO Update
				if(isset($post_array['po_awarded_amount']))
				{
					$this->write_db->set('po_awarded_amount', '(po_awarded_amount+'.$post_array['po_awarded_amount'].')', FALSE);
				}
				// PO Release count update
				if(isset($post_array['po_release_count']))
				{
					$this->write_db->set('po_release_count', '(po_release_count+'.$post_array['po_release_count'].')', FALSE);
				}
				if(isset($post_array['po_count']))
				{
					// $this->write_db->set('po_count', '(po_count+'.$post_array['po_count'].')', FALSE);
					$this->write_db->set('po_count', '(po_count+'.$post_array['po_count'].')', FALSE);
				}
				// CO Update
				if(isset($post_array['co_awarded_amount']))
				{
					$this->write_db->set('co_awarded_amount', 'co_awarded_amount+'.$post_array['co_awarded_amount'].'', FALSE);
				}
				if(isset($post_array['co_count']))
				{
					$this->write_db->set('co_count', 'co_count+'.$post_array['co_count'].'', FALSE);
				}
				
				// Pay app requested by builder
				if(isset($post_array['bill_to_client_to_date']))
				{
					$this->write_db->set('bill_to_client_to_date', 'bill_to_client_to_date+'.$post_array['bill_to_client_to_date'].'', FALSE);
				}
				
				// Pay app paid by client
				if(isset($post_array['paid_by_client_to_date']))
				{
					$this->write_db->set('paid_by_client_to_date', 'paid_by_client_to_date+'.$post_array['paid_by_client_to_date'].'', FALSE);
				}
				
				// Pay app request for PO
				if(isset($post_array['po_paid_by_client_to_date']))
				{
					$this->write_db->set('po_paid_by_client_to_date', 'po_paid_by_client_to_date+'.$post_array['po_paid_by_client_to_date'].'', FALSE);
				}
				
				// Pay app request for CO
				if(isset($post_array['co_paid_by_client_to_date']))
				{
					$this->write_db->set('co_paid_by_client_to_date', 'co_paid_by_client_to_date+'.$post_array['co_paid_by_client_to_date'].'', FALSE);
				}
				
				// Invoiced by sub to date
				if(isset($post_array['invoiced_by_sub_to_date']))
				{
					$this->write_db->set('invoiced_by_sub_to_date', 'invoiced_by_sub_to_date+'.$post_array['invoiced_by_sub_to_date'].'', FALSE);
				}
				
				// Amount paid to sub to date
				if(isset($post_array['amount_paid_to_sub']))
				{
					$this->write_db->set('amount_paid_to_sub', 'amount_paid_to_sub+'.$post_array['amount_paid_to_sub'].'', FALSE);
				}
				
				// Update new data
				$other_update_ary = array();
				if(isset($post_array['ub_estimate_id']) && $post_array['ub_estimate_id'] > 0)
				{
					$other_update_ary['description'] = $post_array['description'];
					$other_update_ary['quantity'] = $post_array['quantity'];
					$other_update_ary['unit_cost'] = $post_array['unit_cost'];
					$other_update_ary['budget_amount'] = $post_array['budget_amount'];
					$other_update_ary['overhead_cost'] = $post_array['overhead_cost'];
				}
				$other_update_ary['modified_by'] = $this->user_session['ub_user_id'];
				$other_update_ary['modified_on'] = TODAY;
				$where_array = array('cost_code_id' => $post_array['cost_code_id'], 'project_id' => $post_array['project_id']);
				// Where condition
				$this->write_db->where($where_array);
				if($this->write_db->update(UB_ESTIMATE, $other_update_ary))
				{
					//echo "<Br>Update estimate : ".$this->write_db->last_query();exit;
					//Estimated Revenuew
					$this->write_db->set('estimated_revenue', 'client_contract + client_co', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					
					//(+/-) Budget
					$this->write_db->set('plus_minus_budget', 'estimated_revenue - budget_amount', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					
					// Revised contract update
					// revised_contract = po_awarded_amount + co_awarded_amount
					$this->write_db->set('revised_contract', 'po_awarded_amount + co_awarded_amount', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>revised_contract :".$this->write_db->last_query();
					
					// Estimated profit update
					// Indirect -> estimated_profit_amount = (budget_amount - (po_awarded_amount + co_awarded_amount + overhead_cost))
					// Direct -> estimated_profit_amount =  (budget_amount - (revised_contract+overhead_cost))
					$this->write_db->set('estimated_profit_amount', 'estimated_revenue - (po_awarded_amount + co_awarded_amount + overhead_cost)', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br> estimated_profit_amount :".$this->write_db->last_query();
					
					// Pay app unpaid
					// unpaid_client_billing = bill_to_client_to_date - paid_by_client_to_date
					$this->write_db->set('unpaid_client_billing', 'bill_to_client_to_date - paid_by_client_to_date', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>unpaid_client_billing :".$this->write_db->last_query();
					
					// Balance to bill
					// balance_to_bill_client = (budget_amount + co_awarded_amount) - bill_to_client_to_date
					$this->write_db->set('balance_to_bill_client', '(estimated_revenue) - bill_to_client_to_date', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>balance_to_bill_client : ".$this->write_db->last_query();
					
					// Balance to be invoiced by sub
					// balance_to_be_invoiced_by_sub = revised_contract - invoiced_by_sub_to_date
					$this->write_db->set('balance_to_be_invoiced_by_sub', 'revised_contract - invoiced_by_sub_to_date', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>balance_to_be_invoiced_by_sub :".$this->write_db->last_query();
					
					// Balance amount to be given to sub
					// total_balance_owed_to_sub = revised_contract - amount_paid_to_sub
					$this->write_db->set('total_balance_owed_to_sub', 'revised_contract - amount_paid_to_sub', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>total_balance_owed_to_sub :".$this->write_db->last_query();
					
					// Total Cost spent
					// total_cost = revised_contract + overhead_cost
					$this->write_db->set('total_cost', 'revised_contract + overhead_cost', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>total_cost :".$this->write_db->last_query();
					
					// Total Profit to date
					// profit_to_date = bill_to_client_to_date - (amount_paid_to_sub + overhead_cost)
					$this->write_db->set('profit_to_date', 'paid_by_client_to_date - (amount_paid_to_sub + overhead_cost)', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>profit_to_date : ".$this->write_db->last_query();
					
					// Over all profit
					// overall_profit = bill_to_client_to_date - total_cost
					$this->write_db->set('overall_profit', 'bill_to_client_to_date - total_cost', FALSE);
					$this->write_db->where($where_array);
					$this->write_db->update(UB_ESTIMATE);
					// echo "<Br>overall_profit : ".$this->write_db->last_query();
					
					$data['status'] = TRUE;
					$data['message'] = 'Update successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
				}
			// }
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty / cost code is not defined';
		}
		return $data;
	}
	/**
	*
	* Add Estimate
	*
	* @method: add_estimate
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function add_estimate($post_array = array())
	{
		//print_r($post_array);exit;
		if( ! empty($post_array))
		{
			$post_array['created_by'] = $this->user_session['ub_user_id'];
			$post_array['created_on'] = TODAY;
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			// echo '<pre>';print_r($post_array);exit;
			
			if($this->write_db->insert(UB_ESTIMATE, $post_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
	}
	/** 
	* Get roles information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_roles
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_estimate($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_ESTIMATE.' AS ESTIMATE');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_BUILDER.' AS BUILDER','ROLE.builder_id = BUILDER.ub_builder_id','left');//UB_BUILDER is the table name defined in constant file
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		$res = $this->read_db->get();
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		return $data;
	}
	/**
	*
	* Delete Estimate
	*
	* @method: delete_estimate
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function delete_estimate($delete_array = array())
	{	
		if(isset($delete_array['ub_estimate_id']) && $delete_array['ub_estimate_id'] > 0)
		{
			$this->write_db->delete(UB_ESTIMATE, array('ub_estimate_id' => $delete_array['ub_estimate_id']));
			$data['status'] = TRUE;
			$data['message'] = 'Estimate deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Estimate id is not set';
		}
		return $data;
	}
	
	/**
	*
	* Add Payapp
	*
	* @method: add_payapp
	* @access: public 
	* @param: post data
	* @return:
	*/
	public function add_payapp($post_array = array())
	{
		$insert_array = array();
		if( ! empty($post_array))
		{
			if($this->project_id>0 && $this->builder_id>0)
			{
				// Check for duplicate payapp name
				$args = array('select_fields' => array('ub_payapp_id','name'), 
				'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'name'=>$post_array['payapp_name']));
				$result = $this->get_payapp($args);
				// get previous period to from payapp list 
				$get_period_to = array('select_fields' => array('ub_payapp_id','period_to','status'), 
				'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id),'order_clause' => 'ub_payapp_id DESC','limit'=>array('count'=>'1'));
				$period_to_array = $this->get_payapp($get_period_to);
				// Check for 
				if((isset($period_to_array['message']) && $period_to_array['message'] =='No record found') || (TRUE === $period_to_array['status'] && $period_to_array['aaData'][0]['status']=='Funded' || TRUE === $period_to_array['status'] && $period_to_array['aaData'][0]['status']=='Cancelled'))
				{
					if(FALSE === $result['status'])
					{	
						if(isset($period_to_array['status']) && TRUE === $period_to_array['status'])
						{
							$insert_array['period_from'] = date('Y-m-d', strtotime($period_to_array['aaData'][0]['period_to']. ' + 1 days'));
						}
						else
						{
							$insert_array['period_from'] = '';
						}
						$insert_array['name'] = $post_array['payapp_name'];
						$insert_array['period_to'] = (isset($post_array['period_to']))?date("Y-m-d", strtotime($post_array['period_to'])):'0000-00-00 00:00:00';
						$insert_array['status'] = 'Draft';
						$insert_array['builder_id'] = $this->builder_id;
						$insert_array['project_id'] = $this->project_id;
						$insert_array['created_by'] = $this->user_session['ub_user_id'];
						$insert_array['created_on'] = TODAY;
						$insert_array['modified_by'] = $this->user_session['ub_user_id'];
						$insert_array['modified_on'] = TODAY;
						// echo '<pre>';print_r($post_array);exit;
						// Fetch all estimate for bulk insert in payapp summary
						$args = array('select_fields' => array('cost_code_id','cost_code_name','budget_amount','po_awarded_amount','po_paid_by_client_to_date','co_paid_by_client_to_date','paid_by_client_to_date','po_count','co_awarded_amount','co_count','client_contract','client_co','client_co_count'),'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id));
						$get_all_estimate = $this->get_estimate($args);
						if(isset($get_all_estimate['status']) && TRUE ===$get_all_estimate['status']){
							$get_all_estimate_array = $get_all_estimate['aaData'];
							if($this->write_db->insert(UB_PAYAPP, $insert_array))
							{
								$update_array = array();
								$payapp_number = array();
								$payapp_summary_array = array();
								$payapp_summary_status = array();
								$payapp_id = 0;
								$payapp_id = $this->write_db->insert_id();
								if($payapp_id>0)
								{
									// Update payapp_number
									$update_array['payapp_number'] = $this->generate_number(PAYAPP_NAME_FORMAT,PAYAPP_NUMBER_LENGTH,$payapp_id);

									$where_array = array('ub_payapp_id' => $payapp_id);
									$this->write_db->where($where_array);
									if($this->write_db->update(UB_PAYAPP, $update_array))
									{
										$payapp_number['status'] = TRUE;
										$payapp_number['message'] = 'Payapp number updated successfully';
									}
									else
									{
										$payapp_number['status'] = FALSE;
										$payapp_number['message'] = 'Payapp number updated failed';
									}

									// payapp_summary insert
									foreach($get_all_estimate_array as $single_estimate)
									{
										$payapp_summary_array['builder_id'] = $this->builder_id;
										$payapp_summary_array['project_id'] = $this->project_id;
										$payapp_summary_array['payapp_id'] = $payapp_id;
										$payapp_summary_array['type'] = 'Estimate';
										$payapp_summary_array['cost_code_id'] = $single_estimate['cost_code_id'];
										$payapp_summary_array['cost_code_name'] = $single_estimate['cost_code_name'];
										$payapp_summary_array['budgeted_value'] = $single_estimate['budget_amount'];
										$payapp_summary_array['scheduled_value'] = $single_estimate['client_contract'];
										$payapp_summary_array['from_prev_app'] = $single_estimate['po_paid_by_client_to_date'];
										$payapp_summary_array['total_completed_and_stored_till_date'] = $single_estimate['po_paid_by_client_to_date'];
										$payapp_summary_array['created_by'] = $this->user_session['ub_user_id'];
										$payapp_summary_array['created_on'] = TODAY;
										$payapp_summary_array['modified_by'] = $this->user_session['ub_user_id'];
										$payapp_summary_array['modified_on'] = TODAY;
										if($this->write_db->insert(UB_PAYAPP_REQUEST_SUMMARY, $payapp_summary_array))
										{
											// Check for Change Order entry in estimate
											if($single_estimate['client_co_count']!='' && $single_estimate['client_co_count']>0)
											{
																																				$payapp_summary_array['from_prev_app'] = 												$single_estimate['co_paid_by_client_to_date'];
												$payapp_summary_array['total_completed_and_stored_till_date'] = $single_estimate['co_paid_by_client_to_date'];
												$payapp_summary_array['type'] = 'CO';
												$payapp_summary_array['scheduled_value'] = $single_estimate['client_co'];
												if($this->write_db->insert(UB_PAYAPP_REQUEST_SUMMARY, $payapp_summary_array))
												{
													$payapp_summary_status['status'] = TRUE;
													$payapp_summary_status['message'] = 'Payapp summary inserted successfully';

												}
												else
												{
													$payapp_summary_status['status'] = FALSE;
													$payapp_summary_status['message'] = 'Insert Failed : Payapp summary insert for CO has db issue!';
												}
											}
											$payapp_summary_status['status'] = TRUE;
											$payapp_summary_status['message'] = 'Payapp summary inserted successfully';
										}
										else
										{
											$payapp_summary_status['status'] = FALSE;
											$payapp_summary_status['message'] = 'Insert Failed : Payapp summary insert has db issue!';
										}
									}
								}
								else
								{
									$payapp_number['status'] = FALSE;
									$payapp_number['message'] = 'Payapp number updated failed : Payapp ID is empty!';
								}
								$data['insert_id'] = $payapp_id;
								$data['status'] = TRUE;
								$data['message'] = 'Data inserted successfully. '.$payapp_number['message'].' '.$payapp_summary_status['message'];
							}
							else
							{
								$data['status'] = FALSE;
								$data['message'] = 'Insert Failed : DB issue! ';
							}
						}
						else
						{
							$data['status'] = FALSE;
							$data['message'] = 'Insert Failed : Estimate entry is empty!';
						}
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'Insert Failed : Payapp name is already exist.';
					}
 				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insert Failed : Previous recent Payapp is waiting for payment from client.';
				}		
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed : Builder / Project not selected';
			}	
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert Failed: Post array is empty';
		}
		return $data;
	}
	/**
	*
	* Update Payapp
	*
	* @method: update_payapp
	* @access: public 
	* @param: post data
	* @return: last inserted id
	*/
	public function update_payapp($post_array = array())
	{
		$update_array = array();
		$data = array();
		if(isset($post_array['ub_payapp_id']) && $post_array['ub_payapp_id'] > 0)
		{
			if($this->project_id>0 && $this->builder_id >0)
			{
				$update_array['modified_by'] = $this->user_session['ub_user_id'];
				$update_array['modified_on'] = TODAY;
				if(isset($post_array['payapp_status']) && $post_array['payapp_status'] == 'Release')
				{
					/* Fetch payapp details based on payapp id added by chandru */
					$get_period_to = array('select_fields' => array('ub_payapp_id','payapp_number','name','total_client_co_subtraction'), 
					'where_clause' => array('ub_payapp_id' => $post_array['ub_payapp_id']));
					$get_payapp_array = $this->get_payapp($get_period_to);
					if(TRUE == $get_payapp_array['status'])
					{
						$payapp_name = $get_payapp_array['aaData'][0]['name'];
						$payapp_payapp_number = $get_payapp_array['aaData'][0]['payapp_number'];
						$payapp_total_client_co_subtraction = $get_payapp_array['aaData'][0]['total_client_co_subtraction'];
					}else{
						$payapp_name = '';
						$payapp_payapp_number = '';
						$payapp_total_client_co_subtraction = '';
					}
					/* Fetch builder name */
					/* FETCH BUILDER NAME */
					 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
					$builder_details_array = $this->Mod_builder->get_builder_details(array(
															'select_fields' => array('builder_name'),
															'where_clause' => $condition_post_array
															));
					$builder_name = $builder_details_array['aaData']['0']['builder_name'];
					// total client contract addition
					$payapp_summary_contract_sub_add_array = array();
					$payapp_summary_arg_contract_sub_add = array('select_sum' => array('this_period'), 
					'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$post_array['ub_payapp_id'],'type'=>'Estimate','this_period > '=>'0'));
					$payapp_summary_contract_sub_add_array = $this->get_payapp_request_summary($payapp_summary_arg_contract_sub_add);
					if($payapp_summary_contract_sub_add_array['status'] === TRUE)
					{
						$payapp_summary_contract_sub_add_array = $payapp_summary_contract_sub_add_array['aaData'][0];
						$update_array['total_client_contract_addition'] = $payapp_summary_contract_sub_add_array['this_period'];
					}
					// total client contract subtraction
					$payapp_summary_contract_sub_array = array();
					$payapp_summary_arg_contract_sub = array('select_sum' => array('this_period'), 
					'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$post_array['ub_payapp_id'],'type'=>'Estimate','this_period < '=>'0'));
					$payapp_summary_contract_sub_array = $this->get_payapp_request_summary($payapp_summary_arg_contract_sub);
					if($payapp_summary_contract_sub_array['status'] === TRUE)
					{
						$payapp_summary_contract_sub_array = $payapp_summary_contract_sub_array['aaData'][0];
						$update_array['total_client_contract_subtraction'] = $payapp_summary_contract_sub_array['this_period'];
					}
					// total client co addition
					$payapp_summary_co_add_array = array();
					$payapp_summary_arg_co_add = array('select_sum' => array('this_period'), 
					'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$post_array['ub_payapp_id'],'type'=>'CO','this_period > '=>'0'));
					$payapp_summary_co_add_array = $this->get_payapp_request_summary($payapp_summary_arg_co_add);
					if($payapp_summary_co_add_array['status'] === TRUE)
					{
						$payapp_summary_co_add_array = $payapp_summary_co_add_array['aaData'][0];
						$update_array['total_client_co_addition'] = $payapp_summary_co_add_array['this_period'];
					}

					// total client co addition
					$payapp_summary_co_sub_array = array();
					$payapp_summary_arg_co_sub = array('select_sum' => array('this_period'), 
					'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$post_array['ub_payapp_id'],'type'=>'CO','this_period < '=>'0'));
					$payapp_summary_co_sub_array = $this->get_payapp_request_summary($payapp_summary_arg_co_sub);
					if($payapp_summary_co_sub_array['status'] === TRUE)
					{
						$payapp_summary_co_sub_array = $payapp_summary_co_sub_array['aaData'][0];
						$update_array['total_client_co_subtraction'] = $payapp_summary_co_sub_array['this_period'];
					}
					
					$payapp_certificate_status = array();
					/* Create a payapp certificate for paid payapp */
					$payapp_certificate_status = $this->create_payapp_certificate($post_array);
					
					/* Update estimate based on the payapp paid status : Release */
					$args = array('select_fields' => array('cost_code_id','this_period'),'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$post_array['ub_payapp_id']));
					$get_all_payapp_summary = $this->get_payapp_request_summary($args);
					$get_all_payapp_summary_array = $get_all_payapp_summary['aaData'];
					if(isset($get_all_payapp_summary['status']) && TRUE ===$get_all_payapp_summary['status'])
					{
						foreach($get_all_payapp_summary_array as $payapp_summary_array)
						{
							$estimate_input_array = array();
							$estimate_input_array['cost_code_id'] = $payapp_summary_array['cost_code_id'];
							$estimate_input_array['bill_to_client_to_date'] = $payapp_summary_array['this_period'];
							$estimate_input_array['project_id'] = $this->project_id;
							$this->update_estimate($estimate_input_array);
						}
					}
					//Update payapp table
					$update_array['status'] = 'Released';
					// Where condition
					$where_array = array('ub_payapp_id' => $post_array['ub_payapp_id']);
					$this->write_db->where($where_array);
					/* Below code was added by chandru */
					$notification_array = array(
								'project_name' =>$this->project_name,
								'project_id' =>$this->project_id,
								'builder_id' =>$this->builder_id,
								'module_id' =>$post_array['ub_payapp_id'],
								'builder_name' =>$builder_name,
								'template_type' =>'budget_payapp_released',
								'number' =>$payapp_payapp_number,
								'title' =>$payapp_name,
								'due' =>$payapp_total_client_co_subtraction
								);
					$send_notification = $this->Mod_po_co->send_mail_for_notification($post_array,$notification_array);
					// echo '<pre>';print_r($send_notification);exit;
				}
				else if(isset($post_array['payapp_status']) && $post_array['payapp_status'] == 'Funded')
				{
					$payapp_certificate_status = array();
					/* Create a payapp certificate for paid payapp */
					//$payapp_certificate_status = $this->create_payapp_certificate($post_array);
					/* Update estimate based on the payapp paid status : Pay */
					$args = array('select_fields' => array('cost_code_id','this_period','type'),'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$post_array['ub_payapp_id']));
					$get_all_payapp_summary = $this->get_payapp_request_summary($args);
					$get_all_payapp_summary_array = $get_all_payapp_summary['aaData'];
					if(isset($get_all_payapp_summary['status']) && TRUE ===$get_all_payapp_summary['status'])
					{
						foreach($get_all_payapp_summary_array as $payapp_summary_array)
						{
							$estimate_input_array = array();
							$estimate_input_array['cost_code_id'] = $payapp_summary_array['cost_code_id'];
							$estimate_input_array['paid_by_client_to_date'] = $payapp_summary_array['this_period'];
							if($payapp_summary_array['type']=='Estimate')
							{
								$estimate_input_array['po_paid_by_client_to_date'] = $payapp_summary_array['this_period'];
							}
							else
							{
								$estimate_input_array['co_paid_by_client_to_date'] = $payapp_summary_array['this_period'];
							}
							$estimate_input_array['project_id'] = $this->project_id;
							$this->update_estimate($estimate_input_array);
						}
					}
					//Update payapp table
					$update_array['status'] = 'Funded';
					$update_array['paid_date'] = date('Y-m-d',strtotime(TODAY));
					// Where condition
					$where_array = array('ub_payapp_id' => $post_array['ub_payapp_id']);
					$this->write_db->where($where_array);
					
					/* Below code was added by chandru */
					/* Fetch payapp details based on payapp id added by chandru */
					$get_period_to = array('select_fields' => array('ub_payapp_id','payapp_number','name','total_client_co_subtraction'), 
					'where_clause' => array('ub_payapp_id' => $post_array['ub_payapp_id']));
					$get_payapp_array = $this->get_payapp($get_period_to);
					if(TRUE == $get_payapp_array['status'])
					{
						$payapp_name = $get_payapp_array['aaData'][0]['name'];
						$payapp_payapp_number = $get_payapp_array['aaData'][0]['payapp_number'];
						$payapp_total_client_co_subtraction = $get_payapp_array['aaData'][0]['total_client_co_subtraction'];
					}else{
						$payapp_name = '';
						$payapp_payapp_number = '';
						$payapp_total_client_co_subtraction = '';
					}
					/* Fetch builder name */
					/* FETCH BUILDER NAME */
					 $condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
					$builder_details_array = $this->Mod_builder->get_builder_details(array(
															'select_fields' => array('builder_name'),
															'where_clause' => $condition_post_array
															));
					$builder_name = $builder_details_array['aaData']['0']['builder_name'];
					$notification_array = array(
								'project_name' =>$this->project_name,
								'project_id' =>$this->project_id,
								'builder_id' =>$this->builder_id,
								'builder_name' =>$builder_name,
								'module_id' =>$post_array['ub_payapp_id'],
								'template_type' =>'budget_payapp_payment_made',
								'number' =>$payapp_payapp_number,
								'title' =>$payapp_name,
								'due' =>$payapp_total_client_co_subtraction
								);
					$send_notification = $this->Mod_po_co->send_mail_for_notification($post_array,$notification_array);
				}
				else if(isset($post_array['payapp_status']) && $post_array['payapp_status'] == 'Cancelled')
				{
					if(isset($post_array['ub_payapp_id']) && $post_array['ub_payapp_id']>0)
					{
						//Update fields
						$update_array['status'] = $post_array['payapp_status'];
						// Where condition
						$where_array = array('ub_payapp_id' => $post_array['ub_payapp_id']);
						$this->write_db->where($where_array);
					}
				}
				else
				{
					// Straight forward update case
					$args = array('select_fields' => array('ub_payapp_id','name'), 
					'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'name'=>$post_array['payapp_name']));
					$result = $this->get_payapp($args);
					if(FALSE === $result['status'])
					{	
						//Update fields
						$update_array['name'] = $post_array['payapp_name'];
						$update_array['period_to'] = $post_array['period_to'];
						// Where condition
						$where_array = array('ub_payapp_id' => $post_array['ub_payapp_id'],'builder_id'=>$this->builder_id,'project_id'=>$this->project_id);
						$this->write_db->where($where_array);
					}
					else 
					{
						$data['status'] = FALSE;
						$data['message'] = 'Update failed : Payapp name already exist!';
					}	
				}	
				// Update payapp
				if($this->write_db->update(UB_PAYAPP, $update_array))
				{
					$data['status'] = TRUE;
					$data['message'] = 'Update successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed : DB issue';
				}
	
				
			}
			else
			{	
				$data['status'] = FALSE;
				$data['message'] = 'Update failed : Builder / Project not selected';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Update failed :Post array / Payapp ID is empty!';
		}
		return $data;
	}
	/**
	*
	* Update Payapp summary
	*
	* @method: update_payapp
	* @access: public 
	* @param: post data
	* @return: last inserted id
	*/
	public function update_payapp_summary($post_array = array())
	{
		$update_array = array();
		$data = array();
		$db_array = array();
		if(isset($post_array['ub_payapp_request_summary_id']) && $post_array['ub_payapp_request_summary_id'] > 0)
		{
			if($this->project_id>0 && $this->builder_id >0)
			{
				$args = array('select_fields' => array('ub_payapp_request_summary_id','budgeted_value','scheduled_value','po_paid_by_client_to_date','co_paid_by_client_to_date','from_prev_app','total_completed_and_stored_till_date','percentage_of_work_done','balance_to_be_finished','retainage'), 
				'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'ub_payapp_request_summary_id'=>$post_array['ub_payapp_request_summary_id']));
				$result = $this->get_payapp_request_summary($args);
				if(TRUE === $result['status'])
				{	
					$db_array = $result['aaData'][0];
					$update_array = $this->calculate_payapp_summary($post_array+$db_array);
					//Update fields
					$update_array['modified_by'] = $this->user_session['ub_user_id'];
					$update_array['modified_on'] = TODAY;
					// Where condition
					$where_array = array('ub_payapp_request_summary_id' => $post_array['ub_payapp_request_summary_id']);
					$this->write_db->where($where_array);
					if($this->write_db->update(UB_PAYAPP_REQUEST_SUMMARY, $update_array))
					{
						$data['status'] = TRUE;
						$data['message'] = 'Updated successfully!';
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'Update failed : DB issue!';
					}
				}
				else 
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed : Payapp summary does not exist!';
				}
			}
			else
			{	
				$data['status'] = FALSE;
				$data['message'] = 'Update failed : Builder / Project not selected';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Update failed :Post array / Payapp summary ID is empty!';
		}
		return $data;
	}
	/**
	*
	* Calculate payapp summary 
	*
	* @method: calculate_payapp_summary
	* @access: public 
	* @param: post data
	* @return: last inserted id
	*/
	public function calculate_payapp_summary($input_array = array())
	{	
		$payapp_summary_values = array();
		$scheduled_value = 0.00;
		$from_prev_app = 0.00;
		$value_of_material_stored = 0.00;
		$total_completed_and_stored_till_date = 0.00;
		$percentage_of_work_done = 0.00;
		$balance_to_be_finished = 0.00;
		$retainage_percentage = 0.00;
		$retainage_amount = 0.00;
		$scheduled_value = (isset($input_array['scheduled_value']) && $input_array['scheduled_value']>0)?$input_array['scheduled_value']:0.00;
		$from_prev_app = $input_array['from_prev_app'];
		$this_period = 0.00;
		
		if(isset($input_array['this_period']) && $input_array['this_period']!='' && $input_array['this_period']>0)
		{
			$this_period = $input_array['this_period'];
			$payapp_summary_values['this_period'] = $this_period;
			$total_completed_and_stored_till_date = $from_prev_app+$this_period;
			$payapp_summary_values['total_completed_and_stored_till_date']=$total_completed_and_stored_till_date;
			// Calculate % of work done if $total_completed_and_stored_till_date is > 0
			if($total_completed_and_stored_till_date>0)
			{
				if($scheduled_value>0)
				{
					$percentage_of_work_done = ($total_completed_and_stored_till_date/$scheduled_value)*100;
				}	
			}	
			$balance_to_be_finished = $scheduled_value - $total_completed_and_stored_till_date;
			
		}
		if(isset($input_array['value_of_material_stored']) && $input_array['value_of_material_stored']!='' && $input_array['value_of_material_stored']>0)
		{
			$value_of_material_stored = $input_array['value_of_material_stored'];
			$total_completed_and_stored_till_date = $from_prev_app+$this_period+$value_of_material_stored;
			// Calculate % of work done if $total_completed_and_stored_till_date is > 0
			if($total_completed_and_stored_till_date>0)
			{
				if($scheduled_value>0)
				{
					$percentage_of_work_done = ($total_completed_and_stored_till_date/$scheduled_value)*100;
				}	
			}	
			$balance_to_be_finished = $scheduled_value - $total_completed_and_stored_till_date;
			// Values to be updated in the DB
			$payapp_summary_values['value_of_material_stored']=$value_of_material_stored;
		}
		$payapp_summary_values['total_completed_and_stored_till_date']=$total_completed_and_stored_till_date;
		$payapp_summary_values['percentage_of_work_done']=$percentage_of_work_done;
		$payapp_summary_values['balance_to_be_finished']=$balance_to_be_finished;
		
		if(isset($input_array['retainage']) && $input_array['retainage']!='' && $input_array['retainage']>0)
		{
			$retainage_percentage = $input_array['retainage'];
			$retainage_amount = ($retainage_percentage / 100) * $total_completed_and_stored_till_date;
			$payapp_summary_values['retainage'] = $retainage_percentage;
			$payapp_summary_values['retainage_amount'] = $retainage_amount;
		}
		return $payapp_summary_values;
	}
	/**
	*
	* get payapp certificate details
	*
	* @method: get_payapp_request_summary
	* @access: public 
	* @param: post data
	* @return:
	* author: Thiyagaraj R
	*/
	public function get_payapp_certificate_details($args = array())
	{
		$query_array = array();
		$data = array();
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PAYAPP_CERTIFICATE_DETAILS.' AS PAYAPP_CERTIFICATE_DETAILS');	
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		// Limit
		if(isset($args['limit']) && ! empty($args['limit']))
		{
			$this->read_db->limit($args['limit']['count']);
		}
		$res = $this->read_db->get();
		
		if($res->num_rows() > 0)
		{
			$query_array = $res->result_array();
			$data['aaData'] = $query_array;
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		return $data;
	}

	
	/**
	*
	* get payapp request summary
	*
	* @method: get_payapp_request_summary
	* @access: public 
	* @param: post data
	* @return:
	* author: Thiyagaraj R
	*/
	public function get_payapp_request_summary($args = array())
	{
		$query_array = array();
		$data = array();
		if(isset($args['select_sum']))
		{
			$this->read_db->select_sum(implode(',',$args['select_sum']));
		}
		else
		{
			$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		}
		$this->read_db->from(UB_PAYAPP_REQUEST_SUMMARY.' AS PAYAPP_REQUEST_SUMMARY');	
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		// Limit
		if(isset($args['limit']) && ! empty($args['limit']))
		{
			$this->read_db->limit($args['limit']['count']);
		}
		// echo $this->read_db->last_query();exit;
		$res = $this->read_db->get();
		
		
		if($res->num_rows() > 0)
		{
			$query_array = $res->result_array();
			$data['aaData'] = $query_array;
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo '<pre>';print_r($data);exit;
		return $data;
	}
	/**
	*
	* get payapp
	*
	* @method: get_payapp
	* @access: public 
	* @param: post data
	* @return:
	* author: satheesh kumar
	*/
	public function get_payapp($args = array())
	{
		if(isset($args['select_sum']) || isset($args['select_sum1']))
		{
			if(isset($args['select_sum']))
			{
				$this->read_db->select_sum(implode(',',$args['select_sum']));
			}
			if(isset($args['select_sum1']))
			{
				$this->read_db->select_sum(implode(',',$args['select_sum1']));
			}	
		}
		else
		{
			$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		}
		$this->read_db->from(UB_PAYAPP.' AS PAYAPP');	//UB_ROLE is the table name defined in constant file
		// Join Tables
		if(isset($args['join']) && 'yes' === strtolower($args['join']['builder']))
		{
			$this->read_db->join(UB_BUILDER.' AS BUILDER','PAYAPP.builder_id = BUILDER.ub_builder_id','left');//UB_BUILDER is the table name defined in constant file
		}
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		// Limit
		if(isset($args['limit']) && ! empty($args['limit']))
		{
			$this->read_db->limit($args['limit']['count']);
		}
		
		$res = $this->read_db->get();
		//echo $this->read_db->last_query();exit;
		$data = array();
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo '<pre>';print_r($data);exit;
		return $data;
	}
	/**
	*
	* Add / insert payapp certificate 
	*
	* @method: add_payapp_certificate
	* @access: public 
	* @param: post data
	* @return:
	* author: Thiyagaraj R
	*/
	public function add_payapp_certificate($post_array = array())
	{
		$insert_array = array();
		$payapp_certificate_status = array();
		$payapp_certificate_details = array();
		if( ! empty($post_array))
		{
			if($this->project_id>0 && $this->builder_id>0)
			{
				// Check for duplicate payapp certificate
				$args = array('select_fields' => array('ub_payapp_certificate_id'), 
				'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_number'=>$post_array['payapp_number']));
				$result = $this->get_payapp_certificate($args);
				
				if(FALSE === $result['status'])
				{	
					
					$insert_array = $post_array;
					$insert_array['builder_id'] = $this->builder_id;
					$insert_array['project_id'] = $this->project_id;
					$insert_array['created_by'] = $this->user_session['ub_user_id'];
					$insert_array['created_on'] = TODAY;
					$insert_array['modified_by'] = $this->user_session['ub_user_id'];
					$insert_array['modified_on'] = TODAY;
					if($this->write_db->insert(UB_PAYAPP_CERTIFICATE, array_filter($insert_array)))
					{
						$payapp_certificate_status['insert_id'] = $this->write_db->insert_id();
						// Insert in ub_payapp_certificate_details	
						$input_array[] = array(
												'field_name' => 'PAYAPP.builder_id',
												'value'=> $this->builder_id, 
												'type' => '='
												);
						$input_array[] = array(
												'field_name' => 'PAYAPP.project_id',
												'value'=> $this->project_id, 
												'type' => '='
												);
						$input_array[] = array(
												'field_name' => 'PAYAPP.status',
												'value'=> 'Funded', 
												'type' => '='
												);
											
						$where = $this->build_where($input_array);
						$payapp_arg_co_add = array('select_fields' => array('ub_payapp_id','payapp_number','total_client_co_addition', 'total_client_co_subtraction'),
						'where_clause' => $where.' AND MONTH(PAYAPP.paid_date) = MONTH(CURDATE()) AND PAYAPP.total_client_co_addition != "" AND PAYAPP.total_client_co_subtraction != ""');
						$approved_this_month = $this->get_payapp($payapp_arg_co_add);
						
						if(TRUE === $approved_this_month['status'])
						{
							$approved_this_month_array = $approved_this_month['aaData'];
							foreach($approved_this_month_array as $approved_this_month_row)
							{
								$payapp_certificate_details['builder_id'] = $this->builder_id;
								$payapp_certificate_details['project_id'] = $this->project_id;
								$payapp_certificate_details['payapp_id'] = $approved_this_month_row['ub_payapp_id'];
								$payapp_certificate_details['payapp_number'] = $approved_this_month_row['payapp_number'];
								$payapp_certificate_details['certificate_id'] = $payapp_certificate_status['insert_id'];
								$payapp_certificate_details['date_approved'] = date('Y-m-d',strtotime(TODAY));
								$payapp_certificate_details['co_addition'] = $approved_this_month_row['total_client_co_addition'];
								$payapp_certificate_details['co_subtraction'] = $approved_this_month_row['total_client_co_subtraction'];	
								$payapp_certificate_details['created_by'] = $this->user_session['ub_user_id'];
								$payapp_certificate_details['created_on'] = TODAY;
								$payapp_certificate_details['modified_by'] = $this->user_session['ub_user_id'];
								$payapp_certificate_details['modified_on'] = TODAY;
								if($this->write_db->insert(UB_PAYAPP_CERTIFICATE_DETAILS,$payapp_certificate_details))
								{
									$payapp_certificate_status['cert_details_message'] = 'Payapp certificate details inserted successfully';
								}
							}
						}
						
						$payapp_certificate_status['status'] = TRUE;
						$payapp_certificate_status['message'] = 'Payapp certificate inserted successfully';
					}
					else
					{
						$payapp_certificate_status['status'] = FALSE;
						$payapp_certificate_status['message'] = 'Insert Failed : Payapp certificate insert has db issue!';
					}
				}
				else
				{
					$payapp_certificate_status['status'] = FALSE;
					$payapp_certificate_status['message'] = 'Insert Failed : Payapp certificate already exist.';
				}
			}
			else
			{
				$payapp_certificate_status['status'] = FALSE;
				$payapp_certificate_status['message'] = 'Insert Failed : Builder / Project not selected';
			}	
		}
		else
		{
			$payapp_certificate_status['status'] = FALSE;
			$payapp_certificate_status['message'] = 'Insert Failed: Post array is empty';
		}
		return $payapp_certificate_status;	
	}
	/**
	*
	* Build payapp certificate 
	*
	* @method: create_payapp_certificate
	* @access: public 
	* @param: post data
	* @return:
	* author: Thiyagaraj R
	*/
	public function create_payapp_certificate($payapp_array = array())
	{
		$payapp_certificate_status = array();
		$payapp_certificate_details = array();
		if(isset($payapp_array['ub_payapp_id']) && $payapp_array['ub_payapp_id']>0)
		{
			// Get payapp details having payapp#
			$payapp_info_arg = array('select_fields' => array('payapp_number','period_to'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'ub_payapp_id'=>$payapp_array['ub_payapp_id']));
			$payapp_info_array = $this->get_payapp($payapp_info_arg);			
			if($payapp_info_array['status'] === TRUE)
			{
				$payapp_info_array = $payapp_info_array['aaData'][0];
				$payapp_certificate_details['payapp_id'] = $payapp_array['ub_payapp_id'];
				$payapp_certificate_details['payapp_number'] = $payapp_info_array['payapp_number'];
				$payapp_certificate_details['payapp_period_to'] = $payapp_info_array['period_to'];
			}
			else
			{
				$payapp_certificate_status = $payapp_info_array;
			}
			// Get Payapp summary details using payapp#, project#, builder#
			// CO addition
			$input_array[] = array(
									'field_name' => 'PAYAPP.builder_id',
									'value'=> $this->builder_id, 
									'type' => '='
									);
			$input_array[] = array(
									'field_name' => 'PAYAPP.project_id',
									'value'=> $this->project_id, 
									'type' => '='
									);
			$input_array[] = array(
									'field_name' => 'PAYAPP.status',
									'value'=> 'Funded', 
									'type' => '='
									);
									
			$where = $this->Mod_budget->build_where($input_array);
			$payapp_arg_co_add = array('select_sum' => array('total_client_co_addition'),'select_sum1'=>array('total_client_co_subtraction'),
			'where_clause' => $where.' AND MONTH(PAYAPP.paid_date) < MONTH(CURDATE())');
			$payapp_summary_co_add_array = array();
			$payapp_summary_co_add_array = $this->get_payapp($payapp_arg_co_add);
			if($payapp_summary_co_add_array['status'] === TRUE)
			{
				$payapp_summary_co_add_array = $payapp_summary_co_add_array['aaData'][0];
				$payapp_certificate_details['co_addition'] = $payapp_summary_co_add_array['total_client_co_addition'];
				$payapp_certificate_details['co_subtraction'] = $payapp_summary_co_add_array['total_client_co_subtraction'];				
			}
			else
			{
				$payapp_certificate_status = $payapp_summary_co_add_array;
			} 
			// CO subtraction
			/*$payapp_summary_arg_co_sub = array('select_sum' => array('scheduled_value'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'type'=>'CO','scheduled_value < '=>'0'));
			$payapp_summary_co_sub_array = $this->get_payapp_request_summary($payapp_summary_arg_co_sub);
			if($payapp_summary_co_sub_array['status'] === TRUE)
			{
				$payapp_summary_co_sub_array = $payapp_summary_co_sub_array['aaData'][0];
				$payapp_certificate_details['co_subtraction'] = $payapp_summary_co_sub_array['scheduled_value'];
			}
			else
			{
				$payapp_certificate_status = $payapp_summary_co_sub_array;
			}*/
			// Total contract sum
			$payapp_summary_arg_po = array('select_sum' => array('scheduled_value'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$payapp_array['ub_payapp_id'],'type'=>'Estimate'));
			$payapp_summary_po_array = $this->get_payapp_request_summary($payapp_summary_arg_po);
			if($payapp_summary_po_array['status'] === TRUE)
			{
				$payapp_summary_po_array = $payapp_summary_po_array['aaData'][0];
				$payapp_certificate_details['total_contract_sum'] = $payapp_summary_po_array['scheduled_value'];
			}
			else
			{
				$payapp_certificate_status = $payapp_summary_po_array;
			}
			// Net change by CO 
			if(isset($payapp_certificate_details['co_addition']))
			{
				$payapp_certificate_details['net_change_by_co'] = $payapp_certificate_details['co_addition'];
			}
			else
			{
				$payapp_certificate_details['net_change_by_co'] = 0;
			}
			if(isset($payapp_certificate_details['co_subtraction']))
			{
				$payapp_certificate_details['net_change_by_co'] = $payapp_certificate_details['net_change_by_co'] +$payapp_certificate_details['co_subtraction'];
			}
			// Total contract sum to date
			if(isset($payapp_certificate_details['total_contract_sum']) && isset($payapp_certificate_details['net_change_by_co']))
			{
				$payapp_certificate_details['total_contract_sum_to_date'] = $payapp_certificate_details['total_contract_sum'] +$payapp_certificate_details['net_change_by_co'];
			}
		
			// total_completed_and_stored_till_date
			$payapp_summary_arg_tot_stored = array('select_sum' => array('total_completed_and_stored_till_date'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$payapp_array['ub_payapp_id']));
			$payapp_summary_tot_stored_array = $this->get_payapp_request_summary($payapp_summary_arg_tot_stored);
			if($payapp_summary_tot_stored_array['status'] === TRUE)
			{
				$payapp_summary_tot_stored_array = $payapp_summary_tot_stored_array['aaData'][0];
				$payapp_certificate_details['total_completed_and_stored_till_date'] = $payapp_summary_tot_stored_array['total_completed_and_stored_till_date'];
			}
			else
			{
				$payapp_certificate_details['total_completed_and_stored_till_date'] = 0;
				$payapp_certificate_status = $payapp_summary_tot_stored_array;
			} 
			// total_retainage
			$payapp_summary_arg_tot_retain = array('select_sum' => array('retainage_amount'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$payapp_array['ub_payapp_id']));
			$payapp_summary_tot_retain_array = $this->get_payapp_request_summary($payapp_summary_arg_tot_retain);
			if($payapp_summary_tot_retain_array['status'] === TRUE)
			{
				$payapp_summary_tot_retain_array = $payapp_summary_tot_retain_array['aaData'][0];
				$payapp_certificate_details['total_retainage'] = $payapp_summary_tot_retain_array['retainage_amount'];
			}
			else
			{
				$payapp_certificate_details['total_retainage'] = 0;
				$payapp_certificate_status = $payapp_summary_tot_retain_array;
			}
			// total_earned_less_retainage
			$payapp_certificate_details['total_earned_less_retainage'] = $payapp_certificate_details['total_completed_and_stored_till_date']-$payapp_certificate_details['total_retainage'];
			
			// less_previous_certificates_for
			// get immediate previous payapp for previous paid amount
			$get_previous_payapp_paid = array('select_fields' => array('ub_payapp_id','period_to','status'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'status'=>'Funded'),'order_clause' => 'ub_payapp_id DESC','limit'=>array('count'=>'1'));
			$previous_payapp_paid_array = $this->get_payapp($get_previous_payapp_paid);
			
			if($previous_payapp_paid_array['status']===TRUE)
			{
				$previous_payapp_paid_array = $previous_payapp_paid_array['aaData'][0];
				$previous_payapp_id = $previous_payapp_paid_array['ub_payapp_id'];
				$payapp_summary_arg_less_previous_app = array('select_sum' => array('this_period'), 
				'where_clause' => array('builder_id' => $this->builder_id, 'project_id' => $this->project_id,'payapp_id'=>$previous_payapp_id));
				$payapp_summary_less_previous_app_array = $this->get_payapp_request_summary($payapp_summary_arg_less_previous_app);
				if($payapp_summary_less_previous_app_array['status'] === TRUE)
				{
					$payapp_summary_tot_retain_array = $payapp_summary_less_previous_app_array['aaData'][0];
					$payapp_certificate_details['less_previous_certificates_for'] = $payapp_summary_tot_retain_array['this_period'];
				}
				else
				{
					$payapp_certificate_details['less_previous_certificates_for'] = 0;
					$payapp_certificate_status = $payapp_summary_tot_retain_array;
				}
				
			}
			else
			{
				$payapp_certificate_details['less_previous_certificates_for'] = 0;
			}
			
			// current_payment_due
			if(isset($payapp_certificate_details['total_earned_less_retainage']))
			{
				$payapp_certificate_details['current_payment_due'] = $payapp_certificate_details['total_earned_less_retainage'] - $payapp_certificate_details['less_previous_certificates_for'];
			}
			else
			{
				$payapp_certificate_details['current_payment_due'] = $payapp_certificate_details['less_previous_certificates_for'];
			}	

			// BALANCE TO FINISH, PLUS RETAINAGE
			if(isset($payapp_certificate_details['total_contract_sum_to_date']) && isset($payapp_certificate_details['total_earned_less_retainage']))
			{
				$payapp_certificate_details['balance_to_finish_and_retainage'] = $payapp_certificate_details['total_contract_sum_to_date']+$payapp_certificate_details['total_earned_less_retainage'];
			}
			
			// Get owner details using builder#, role, accounttype
			$get_owner_for_payapp = array('select_fields' => array('ub_user_id','primary_email','first_name','last_name','address','city','province','postal','country','desk_phone','mobile_phone','fax'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'account_type' => OWNER,'role_id'=>OWNER_ROLE_ID));
			$owner_for_payapp_array = $this->Mod_user->get_users($get_owner_for_payapp);
			
			if($owner_for_payapp_array['status'] === TRUE)
			{
				$owner_for_payapp_array = $owner_for_payapp_array['aaData'][0];
				$payapp_certificate_details['owner_id'] = $owner_for_payapp_array['ub_user_id'];
				$payapp_certificate_details['owner_email'] = $owner_for_payapp_array['primary_email'];
				$payapp_certificate_details['owner_first_name'] = $owner_for_payapp_array['first_name'];
				$payapp_certificate_details['owner_last_name'] = $owner_for_payapp_array['last_name'];
				$payapp_certificate_details['owner_address'] = $owner_for_payapp_array['address'];
				$payapp_certificate_details['owner_city'] = $owner_for_payapp_array['city'];
				$payapp_certificate_details['owner_province'] = $owner_for_payapp_array['province'];
				$payapp_certificate_details['owner_postal'] = $owner_for_payapp_array['postal'];
				$payapp_certificate_details['owner_country'] = $owner_for_payapp_array['country'];
				$payapp_certificate_details['owner_desk_phone'] = $owner_for_payapp_array['desk_phone'];
				$payapp_certificate_details['owner_mobile_phone'] = $owner_for_payapp_array['mobile_phone'];
				$payapp_certificate_details['owner_fax'] = $owner_for_payapp_array['fax'];			
			}
			else
			{
				$payapp_certificate_status = $owner_for_payapp_array;
			}
			
			// Get Project details using project#, builder#
			$get_project_info = array('select_fields' => array('project_no','projected_start_date','project_name','address','city','province','postal','country','contract_price'), 
			'where_clause' => array('builder_id' => $this->builder_id, 'ub_project_id' => $this->project_id));
			$project_info_for_payapp_array = $this->Mod_project->get_projects($get_project_info);
			
			if($project_info_for_payapp_array['status'] === TRUE)
			{
				$project_info_for_payapp_array = $project_info_for_payapp_array['aaData'][0];
				$payapp_certificate_details['project_no'] = $project_info_for_payapp_array['project_no'];			
				$payapp_certificate_details['contract_date'] = $project_info_for_payapp_array['projected_start_date'];			
				$payapp_certificate_details['project_name'] = $project_info_for_payapp_array['project_name'];			
				$payapp_certificate_details['project_address'] = $project_info_for_payapp_array['address'];			
				$payapp_certificate_details['project_city'] = $project_info_for_payapp_array['city'];			
				$payapp_certificate_details['project_province'] = $project_info_for_payapp_array['province'];
				$payapp_certificate_details['project_postal'] = $project_info_for_payapp_array['postal'];
				$payapp_certificate_details['project_country'] = $project_info_for_payapp_array['country'];
				//$payapp_certificate_details['total_contract_sum'] = $project_info_for_payapp_array['contract_price'];
			}
			else
			{
				$payapp_certificate_status = $project_info_for_payapp_array;
			}
			// Get Builder details using builder#
			$get_builder_info = array('select_fields' => array('BUILDER_DETAILS.builder_name','USER.address','USER.city','USER.province','USER.postal','USER.country','USER.desk_phone','USER.mobile_phone','USER.fax'),'join'=>array('user'=>'yes'), 
			'where_clause' => array('ub_builder_id' => $this->builder_id,'USER.account_type' => BUILDERADMIN,'USER.role_id'=>BUILDER_ADMIN_ROLE_ID));
			$builder_info_for_payapp_array = $this->Mod_builder->get_builder_details($get_builder_info);
			
			if($builder_info_for_payapp_array['status'] === TRUE)
			{
				$builder_info_for_payapp_array = $builder_info_for_payapp_array['aaData'][0];
				$payapp_certificate_details['builder_name'] = $builder_info_for_payapp_array['builder_name'];
				$payapp_certificate_details['builder_address'] = $builder_info_for_payapp_array['address'];
				$payapp_certificate_details['builder_city'] = $builder_info_for_payapp_array['city'];
				$payapp_certificate_details['builder_province'] = $builder_info_for_payapp_array['province'];
				$payapp_certificate_details['builder_postal'] = $builder_info_for_payapp_array['postal'];
				$payapp_certificate_details['builder_country'] = $builder_info_for_payapp_array['country'];
				$payapp_certificate_details['builder_desk_phone'] = $builder_info_for_payapp_array['desk_phone'];
				$payapp_certificate_details['builder_mobile_phone'] = $builder_info_for_payapp_array['mobile_phone'];
				$payapp_certificate_details['builder_fax'] = $builder_info_for_payapp_array['fax'];
			}
			else
			{
				$payapp_certificate_status = $builder_info_for_payapp_array;
			}
			
			// Get User details using project#, builder#, user#
			$get_user_info = array('select_fields' => array('primary_email','first_name','last_name'), 
			'where_clause' => array('builder_id' => $this->builder_id,'ub_user_id' => $this->user_session['ub_user_id']));
			$user_info_for_payapp_array = $this->Mod_user->get_users($get_user_info);
			
			if($user_info_for_payapp_array['status'] === TRUE)
			{
				$user_info_for_payapp_array = $user_info_for_payapp_array['aaData'][0];
				$payapp_certificate_details['user_id'] = $this->user_session['ub_user_id'];
				$payapp_certificate_details['user_email'] = $user_info_for_payapp_array['primary_email'];
				$payapp_certificate_details['user_first_name'] = $user_info_for_payapp_array['first_name'];
				$payapp_certificate_details['user_last_name'] = $user_info_for_payapp_array['last_name'];
			}
			else
			{
				$payapp_certificate_status = $user_info_for_payapp_array;
			}
			// Insert into payapp certificate		
			//print_r($payapp_certificate_details);
			$payapp_certificate_status = $this->add_payapp_certificate($payapp_certificate_details);
		}
		else
		{
			$payapp_certificate_status['status'] = FALSE;
			$payapp_certificate_status['message'] = 'Insert Payapp certificate failed : Payapp primary# is not set!';
		}	

		return $payapp_certificate_status;
	}

	
	 /** 
	* Get get_po_co information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_po_co
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_budget_summary($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_ESTIMATE.' AS ESTIMATE');
       	if(isset($args['join']['project']) && 'yes' === strtolower($args['join']['project']))
		{
		 	$this->read_db->join(UB_PROJECT.' AS PROJECT','ESTIMATE.project_id = PROJECT.ub_project_id','left');//UB_PROJECT is the table name defined in constant file
		}		
 		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Group by condition
		if(isset($args['group_clause']) && $args['group_clause'] !='')
		{
			$this->read_db->group_by($args['group_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		
		$res = $this->read_db->get();
		
		/*if(!$res)
		{//echo $this->read_db->last_query();exit;
			echo $this->read_db->_error_message();
			echo "<br>".$this->read_db->_error_number();exit;
		}*/
		  //echo $this->read_db->last_query();exit;
		$data = array();
		if($res->num_rows() > 0)
		{
		 // echo 'd';exit;
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
		 // echo 'g';exit;
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		   // echo $this->read_db->last_query();
		return $data;
	}
	/**
	*
	* get payapp certificate
	*
	* @method: get_payapp_certificate
	* @access: public 
	* @param: post data
	* @return:
	* author: Gopakumar K
	*/
	public function get_payapp_certificate($args = array())
	{
		$time_format_fields = '';
		if(!isset($args['select_fields']))
		{
			$payapp_period_to_date_array = array('PAYAPP_CERTIFICATE.payapp_period_to'=>'payapp_period_to');	
			$contract_date_date_array = array('PAYAPP_CERTIFICATE.contract_date'=>'contract_date');	
			$created_on_date_array = array('PAYAPP_CERTIFICATE.created_on'=>'created_on');	
			$time_format_fields = $this->Mod_user->format_user_datetime($payapp_period_to_date_array,"date").','.$this->Mod_user->format_user_datetime($contract_date_date_array,"date").','.$this->Mod_user->format_user_datetime($created_on_date_array,"date");
			// echo '<pre>';print_r($time_format_fields);exit;
		}
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'* ,'.$time_format_fields, FALSE);
		$this->read_db->from(UB_PAYAPP_CERTIFICATE.' AS PAYAPP_CERTIFICATE');	//UB_ROLE is the table name defined in constant file
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		// Order by condition
		if(isset($args['order_clause']) && $args['order_clause'] !='')
		{
			$this->read_db->order_by($args['order_clause']);
		}
		// Pagination
		if(isset($args['pagination']) && ! empty($args['pagination']))
		{
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}
		// Limit
		if(isset($args['limit']) && ! empty($args['limit']))
		{
			$this->read_db->limit($args['limit']['count']);
		}
		$res = $this->read_db->get();
		$data = array();
		// echo $this->read_db->last_query();exit;
		if($res->num_rows() > 0)
		{
			$data['aaData'] = $res->result_array();
			$data['status'] = TRUE;
			$data['message'] = 'Data retrieved successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'No record found';
		}
		//echo '<pre>';print_r($data);exit;
		return $data;
	}
}
/* End of file mod_user.php */
/* Location: ./application/models/mod_user.php */