<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends UNI_Controller {
	/**
	 * @constructor
	 */
	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Mod_lead','Mod_Message','Mod_doc','Mod_general_value','Mod_timezone','Mod_user','Mod_builder','Mod_plan','Mod_project','Mod_custom_settings','Mod_payment','Mod_builder_contract','Mod_invoice','Mod_login'));
		$this->load->helper('export');
		$this->module;
		
    }

    /** 
	* Get Builder setup details
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
		'content'      => 'content/setup/setup',
		'page_id'      => 'setup'
		);

		/* Block to get the builder currency from general value table*/
		/*$args = array('classification'=>'builder_currency', 'type'=>'dropdown');
		$builder_currency = $this->Mod_general_value->get_general_value($args);

        if(TRUE === $builder_currency['status'])
		{
			$data['builder_currency'] = $builder_currency['values'];
		}*/	
		$builder_currency[] = array('id' => 'USD','val' => 'USD');
	    //$before_or_after_dropdown[] = array('id' => 'After','val' => 'After');
	    $data['builder_currency'] = $this->Mod_lead->build_ci_dropdown_array($builder_currency,'id', 'val');

		// file display code start hear
		$task_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->user_session['builder_id'],
								);
			$result_array = $this->Mod_doc->get_files_for_folder($task_data);

			//echo "<pre>";print_r($result_array);exit;
			if(isset($result_array['0']['ub_doc_file_id']) && !empty($result_array['0']['ub_doc_file_id']))
			{
				$data['profile_pic_id'] = $result_array['0']['ub_doc_file_id'];
				$data['profile_pic'] = $result_array['0']['system_file_name'];
			}
		//	file display code end hear
		/* block to get builder datails*/
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID ,'USER_PLAN.status'=>'Active');

		$sort_type = 'ASC';
		$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
		$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('USER.first_name','USER.last_name','USER.ub_user_id','BUILDER_DETAILS.ub_builder_id','BUILDER_DETAILS.builder_name','BUILDER_DETAILS.builder_currency','BUILDER_DETAILS.builder_currency_symbol_code','USER.primary_email','USER.desk_phone',
												'USER.address','USER.city','USER.province',
												'USER.postal','USER.country','Group_concat(DISTINCT(SETUP_BUDGET.ub_setup_budget_documents_id)) as ub_setup_budget_documents_id','Group_concat(DISTINCT(SETUP_BUDGET.name)) as name','Group_concat(DISTINCT(SETUP_BUDGET.comments)) as comments',
												'USER_PLAN.plan_id','USER_PLAN.ub_user_plan_id',
												'SETUP.bid_alert_to_sub_before_deadline',
												'SETUP.po_prefix',
												'SETUP.co_prefix','SETUP.po_alert_before_deadline','SETUP.co_alert_before_deadline',
												'SETUP.default_po_disclaimer','SETUP.default_selection_disclaimer'),
												'join'=> array('user'=>'yes','setup_budget'=>'yes','userplan'=>'yes','setup'=>'yes'),
												'where_clause' => $post_array,
												'order_clause' => $order_by_where,
												'pagination' => $pagination_array
												));											
	    $total_no_of_projects = $this->Mod_project->get_projects(array(
		                                     'select_fields' => array('count(PROJECT.ub_project_id) as assign_no_of_projects'),
											 'where_clause' => array('PROJECT.builder_id'=>$this->user_session['builder_id'])
											 )); 

		 $plan_array = $this->Mod_builder->get_plans(array(
		                                     'select_fields' => array('PLAN.no_of_projects','PLAN.no_of_users'),
											 'where_clause' => array('ub_plan_id'=>$builder_details_array['aaData'][0]['plan_id'])
											 )); 
		
        $total_no_of_users = $this->Mod_user->get_users(array(
		                                     'select_fields' => array('count(USER.ub_user_id)  AS createed_no_of_users'),
											 'where_clause' => array('USER.builder_id'=>$this->user_session['builder_id'])
											 ));  
		if(isset($plan_array['aaData']['0']['no_of_projects']) && $plan_array['aaData']['0']['no_of_projects'] > 0)
        {		
		$remaining_projects = $plan_array['aaData']['0']['no_of_projects'] - $total_no_of_projects['aaData']['0']['assign_no_of_projects'] ;
		$total_projects = $plan_array['aaData']['0']['no_of_projects'] ;
		}
		else {
		 $remaining_projects = 'NA' ;
		 $total_projects = 'Unlimited' ;
		}
		if(isset($plan_array['aaData']['0']['no_of_users']) && $plan_array['aaData']['0']['no_of_users'] > 0) {
		$remaining_users = $plan_array['aaData']['0']['no_of_users'] - $total_no_of_users['aaData']['0']['createed_no_of_users'] ;
		$total_users = $plan_array['aaData']['0']['no_of_users'] ;
		}
		else {
		 $remaining_users = 'NA' ;
		 $total_users = 'Unlimited' ;
		}
		$builder_details_array['account_status']= Array('total_projects'=> $total_projects,
											'running_projects'=>$total_no_of_projects['aaData']['0']['assign_no_of_projects'],
											'remaining_projects'=>$remaining_projects,
											'total_users'=>$total_users,
											'created_users'=>$total_no_of_users['aaData']['0']['createed_no_of_users'],
											'remaining_users'=>$remaining_users);
		
		//echo "<pre>"; print_r($total_no_of_users); exit;		
		/*$args['where_clause'] = "builder_id = ".$this->builder_id." || builder_id = 0";
		$args['select_fields'] = array('comments');
		$document_option = $this->Mod_builder->get_db_options(UB_COMMENTS, $args);
		$data['document_option'] = $document_option;	*/									
		//echo "<pre>"; print_r($builder_details_array); exit;	
//echo "<pre>"; print_r($builder_details_array['account_status']); exit;		
		if(TRUE === $builder_details_array['status'])
		{
			$data['builder_details'] = $builder_details_array['aaData']['0'];
			$data['account_status']  =  $builder_details_array['account_status'] ;
		}
		
		/* Payment details added by chandru */
		$get_payment_details = $this->Mod_payment->get_payment_details(array(
		                                     'select_fields' => array('subscription_id','last_4digits','ub_payment_id'),
											 'where_clause' => array('builder_id'=>$this->user_session['builder_id'])
											 ));  
		if(TRUE == $get_payment_details['status'])
		{
			$payment_details = end($get_payment_details['aaData']);
			$data['payment_details']  =  $payment_details;
		} 
  		//get custom field data types from general value table
		$get_custom_field_data_types = array('classification'=>'custom_field_data_types', 'type'=>'dropdown');
		$custom_field_data_types_result = $this->Mod_general_value->get_general_value($get_custom_field_data_types);
		$data['data_type_array'] = $custom_field_data_types_result['values'];
		//echo "<pre>";print_r($custom_field_data_types_result);exit;`plan_code` = 'SILVER'
		$where_string = 'plan_code = "SILVER" OR plan_code = "GOLD"'; 
		$plan_array = $this->Mod_plan->get_plan_details(array(
				'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_name','PLAN.plan_amount','PLAN.no_of_projects','PLAN.no_of_users'),
				'where_clause' => $where_string));
		$data['plan_detail'] = $plan_array['aaData'];
		/* Below code was added by chandru */
		$data['current_plan_name'] = $plan_array['aaData'][0]['plan_name'];
		$data['current_plan_amount'] = $plan_array['aaData'][0]['plan_amount'];
		$data['new_plan_name'] = $plan_array['aaData'][1]['plan_name'];
		$data['new_plan_amount'] = $plan_array['aaData'][1]['plan_amount'];
		/* chandru code ends here */
		$sort_type = 'DESC LIMIT 1';
			$order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
			$where_condition = array('PAYMENT_DETAILS.builder_id' => $this->user_session['builder_id'],'PAYMENT_DETAILS.payment_status' => 'Success');
	        $payment_details_array = array('select_fields' => 
			                         array('amount','payment_date'),
			                         'where_clause' => $where_condition,
									'order_clause' => $order_by_where);	
									
			$payment_details_response = $this->Mod_payment->get_payment_details($payment_details_array) ;
			if(TRUE == $payment_details_response['status'])
			{
				$last_charged_amount = $payment_details_response['aaData']['0']['amount'];
				$last_payment_date = $payment_details_response['aaData']['0']['payment_date'];
			}
			// block to count the no of days fron the last payment day
			if(isset($last_payment_date) && !empty($last_payment_date))
			{
				$date = new DateTime($last_payment_date );
				$now = new DateTime();
				$days =  $date->diff($now)->format("%d");
			}else{
				$days = 30;
			}
			if(isset($last_charged_amount) && !empty($last_charged_amount))
			{
			
			}else{
				$last_charged_amount = 0;
			}
				// new plan details
				/* Need to give Plan id */
				$where_string = array('PLAN.ub_plan_id' => 2); 
				$plan_array = $this->Mod_plan->get_plan_details(array(
						'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_amount','PLAN.trail_amount','PLAN.plan_length','PLAN.no_of_users','PLAN.plan_name'),
						'where_clause' => $where_string));
				
				if(TRUE == $plan_array['status'])
				{
					$plan_detail = $plan_array['aaData']['0']; 
				}
			if (isset($plan_detail['trail_amount']) && !empty($plan_detail['trail_amount']) && $plan_detail['trail_amount'] != 0 && $plan_detail['trail_amount'] > $last_charged_amount) 
			{
				$updated_trial_amount = round($plan_detail['trail_amount'] - ($last_charged_amount /$plan_detail['plan_length'] * $days),2);
			}
			else
			{
				$updated_trial_amount = 0;
				
			}
			if (isset($plan_detail['plan_amount']) && !empty($plan_detail['plan_amount']) && $plan_detail['plan_amount'] != 0 && $plan_detail['trail_amount'] == 0 && $plan_detail['plan_amount'] > $last_charged_amount) 
			{
				//$data['updated_plan_amount'] = round($plan_detail['plan_amount'] - ($last_charged_amount /$plan_detail['plan_length'] * $days),2);
				$prodata_amount_calculation = $this->Mod_payment->prodata_amount($plan_detail['plan_amount'], $last_charged_amount, $plan_detail['plan_length'], $days);
				$data['updated_plan_amount'] = $prodata_amount_calculation;
			}
			else
			{
				$data['updated_plan_amount'] = 0;

			}
		/* chandru code ends here */

		$order_by = 'USER_PLAN.ub_user_plan_id desc';
			$where_condition = array('builder_id'=>$this->user_session['builder_id']);
			$plan_args = array('select_fields' => array('USER_PLAN.plan_id','plan_name'),
					'join'=> array('userplan'=>'Yes'),
					'where_clause' => $where_condition,
					'order_clause' => $order_by);
			$plan_data = $this->Mod_plan->get_plan_details($plan_args); 
			$data['plan_id'] = $plan_data['aaData']['0']['plan_id'];

		$order_by = 'PAYMENT_DETAILS.ub_payment_id desc';
			$where_condition = array('builder_id'=>$this->user_session['builder_id']);
			$payment_args = array('select_fields' => array('PAYMENT_DETAILS.subscription_id'),
					'where_clause' => $where_condition,
					'order_clause' => $order_by);
			$payment_data = $this->Mod_payment->get_payment_details($payment_args); 
			$data['subscription_id'] = $payment_data['aaData']['0']['subscription_id'];
		$this->template->view($data);
	}

	/** 
	* save builder
	* 
	* @method: save_builder 
	* @access: public 
	* @param:  builder id
	* @return: response array
	* @author: Devansh
	*/
	public function save_builder()
	{
		$result = $this->sanitize_input();
		/*print_r($_FILES);
		echo "<pre>";print_r($result);exit;*/
	    $post_data = array();
		if(!empty($this->input->post()))
		{	
	
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
			//echo "<pre>"; print_r($result);exit;
				if (isset($this->builder_id) && !empty($this->builder_id) && $this->builder_id > 0) 
				{
					if(isset($_FILES['profile_pic']['tmp_name']) && $_FILES['profile_pic']['tmp_name'] != '')
					{
						list($width, $height) = getimagesize($_FILES['profile_pic']['tmp_name']);
						if($width < LOGO_MIN_WIDTH || $width > LOGO_MAX_WIDTH  ||  $height < LOGO_MIN_HEIGHT  ||  $height > LOGO_MAX_HEIGHT )
						{
							$response['status'] = FALSE;
							$response['error'] = 'size'; 
							$response['message'] = "File should Max height: ".LOGO_MAX_HEIGHT."  Min height: ".LOGO_MIN_HEIGHT." Max width: ".LOGO_MAX_WIDTH."  Min width:".LOGO_MIN_WIDTH ;
							// echo '<pre>';print_r($response);exit;
							$this->Mod_user->response($response);
						}
					}
					// Code for single fle upload start
					$task_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'folderid' => 0,
								  'modulename' => $this->module,
								  'moduleid' => $this->user_session['builder_id'],
								);
					$result_array = $this->Mod_doc->get_files_for_folder($task_data);
					if(isset($result_array[0]['ub_doc_file_id']) && !empty($result_array[0]['ub_doc_file_id']))
					{
						
					}
					else if(isset($_FILES['profile_pic']['name']) && !empty($_FILES['profile_pic']['name']))
					{
						$get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
								   'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'project_id' => 0,'ui_folder_name' => $this->module))
								   );
						$all_folder = $this->Mod_doc->get_folder_id($get_folder_id);

						$file_data = array(	  'flag' => 2, 
									  'builder_id'	=> $this->user_session['builder_id'],
									  'projectid' => 0,
									  'createdby' => $this->user_session['ub_user_id'],
									  'modulename' => $this->module,
									);

						$file_data['moduleid'] = $this->user_session['builder_id'];
						$file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
						$file_data['filename'] = $_FILES['profile_pic']['name'];
						//echo "<pre>"; print_r($file_data);exit;
						$result_array = $this->Mod_doc->insert_file($file_data);

						//echo "<pre>"; print_r($result_array);
						/* Code to move the files from temp to actual dir*/

						if ($result_array['0']['createfolderflag'] == 1) 
						{
							$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
							if(TRUE === $response['status'])
							{
								$session_id = $this->session->userdata('session_id');
								move_uploaded_file($_FILES['profile_pic']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
							}
						}
						else
						{
							$session_id = $this->session->userdata('session_id');
							move_uploaded_file($_FILES['profile_pic']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);	
						}
					}	
					// Code for single fle upload end
					if(isset($result['data']['builder_currency']) && !empty($result['data']['builder_currency']))
					{
						if($result['data']['builder_currency'] == '$' )
						{
							$result['data']['builder_currency'] = 'USD';
							$result['data']['builder_currency_symbol_code'] = "&#36;";
						}
						else if($result['data']['builder_currency'] == '€' )
						{
							$result['data']['builder_currency_symbol_code'] = "&#128;";
						}
						else
						{
							$result['data']['builder_currency_symbol_code'] = "&#x20B9;";
						}
					}
					$form_data['builder_data'] = array(
							'ub_builder_id'=> $this->builder_id,
							'builder_name' => $result['data']['builder_name'],
							'builder_currency' => $result['data']['builder_currency'],
							'builder_currency_symbol_code' => $result['data']['builder_currency_symbol_code'],
							'modified_on' => TODAY,
							'modified_by' => $this->builder_id);
               // echo "<pre>"; print_r($form_data['builder_data']); exit;
				$setup_arrray['setup']= array(
			   'builder_id'=> $this->builder_id,
			   'bid_alert_to_sub_before_deadline' =>$result['data']['bid_alert_to_sub_before_deadline'],
			   'po_prefix'=> $result['data']['po_prefix'],
			   'po_alert_before_deadline'=> $result['data']['po_alert_before_deadline'],
			   'co_prefix'=> $result['data']['co_prefix'],
			   'co_alert_before_deadline' => $result['data']['co_alert_before_deadline'],
			   'default_po_disclaimer' => $result['data']['default_po_disclaimer'],
			   'default_selection_disclaimer' => $result['data']['default_selection_disclaimer'],
			   'created_on' => TODAY,
			   'created_by' => $this->builder_id,
			   'modified_on' => TODAY,
			   'modified_by' => $this->builder_id);

				
			   $this->Mod_builder->add_setup($setup_arrray['setup']); 
		    
		     $setup_array['document'] = array(
		     'name' => $result['data']['name'],
		     'comments' => $result['data']['comments'],
		     'ub_setup_budget_documents_id' =>$result['data']['ub_setup_budget_documents_id']);
			 
			 //change plan  added by satheesh
			 if(isset($result['data']['ub_user_id']) && !empty($result['data']['ub_user_id']) && $result['data']['ub_user_id'] > 0)
				{
					/* $user_plan_result = $this->Mod_plan->get_user_plan(array(
						'select_fields' => array('USER_PLAN.ub_user_plan_id','USER_PLAN.plan_id'),
						'where_clause' => (array('USER_PLAN.builder_id' => $result['data']['ub_builder_id'],'USER_PLAN.status' => 'Active'))
						)); */
					if(isset($result['data']['new_plan_id']) && $result['data']['ub_plan_id'] != $result['data']['new_plan_id'])
					{	
						//update old user plan to inactive
						$update_plan_data['user_plan_data'] = array('ub_user_plan_id' => $result['data']['ub_user_plan_id']);
						$ub_plan_response = $this->Mod_plan->update_user_plan($update_plan_data['user_plan_data']);
						//insert new user plan
						$plan_data['user_plan_data'] = array(
							'builder_id' => $this->builder_id,
							'user_id' => $result['data']['ub_user_id'],
							'created_by' => $this->user_id,
							'modified_by' => $this->user_id,
							'created_on' => TODAY,
							'status'  => 'Active',
							'plan_id' => $result['data']['new_plan_id']);
						$ub_plan_response = $this->Mod_plan->add_user_plan($plan_data['user_plan_data']);
					}
				}
				//--end-- change plan added by satheesh
		     if(isset($setup_array['document']))    
			 {
			    $doc_result = $this->Mod_builder->get_budget_document(array(
		                                     'select_fields' => array('	ub_setup_budget_documents_id'),
											 'where_clause' => array('builder_id'=>$this->user_session['builder_id'])
											 ),$setup_array['document']['ub_setup_budget_documents_id']);  
		     
			  }
			 
			   $this->Mod_builder->add_budget_documents($setup_array['document']);
               $ub_builder_response = $this->Mod_builder->update_builder($form_data['builder_data']);
				}
				if (isset($result['data']['ub_user_id']) && !empty($result['data']['ub_user_id']) && $result['data']['ub_user_id'] > 0) 
				{
					$form_data['user_data'] = array(
							'ub_user_id' => $result['data']['ub_user_id'],
							'first_name' => $result['data']['first_name'],
							'last_name' => $result['data']['last_name'],
							'primary_email' => $result['data']['primary_email'],
							'desk_phone' => $result['data']['desk_phone'],
							'address' => $result['data']['address'],
							'city' => $result['data']['city'],
							'province' => $result['data']['province'],
							'postal' => $result['data']['postal'],
							'country' => $result['data']['country'],
							'modified_on' => TODAY,
							'modified_by' => $result['data']['ub_user_id']);
							
					$address_array = array(
									'first_name' => $result['data']['first_name'],
									'last_name' => $result['data']['last_name'],
									'address' => $result['data']['address'],
									'city' => $result['data']['city'],
									'province' => $result['data']['province'],
									'postal' => $result['data']['postal'],
									'country' => $result['data']['country']
									);

							$ub_user_response = $this->Mod_user->update_user($form_data['user_data']);
							if(isset($result['data']['subscription_id']) && $result['data']['subscription_id'] > 0)
							{
								$address_array_response = $this->Mod_payment->update_address_details($result['data']['subscription_id'],$address_array);
							}
				}
				if (TRUE === $ub_user_response['status']) 
						{
							$response['userid'] = $result['data']['ub_user_id'];
							$response['status'] = TRUE;
							$response['message'] = 'Builder updated successfully';
						}
						else
						{
							$response['status'] = FALSE;
							$response['message'] = 'Updation Failed';
						}
						// echo '<pre>';print_r($response);exit;
						$this->Mod_user->response($response);
			}	
			else
			{
				
			}
		}
    }

    /** 
	* function to get currency code
	* 
	* @method: get_currency_value 
	* @access: public 
	* @param:  builder id
	* @return: response array
	* @author: Devansh
	*/
	public function get_currency_value()
	{
		$result = $this->sanitize_input();

		$post_data = array();
		if(!empty($this->input->post()))
		{	
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				//echo "<pre>";print_r($result);exit;
				$args = array('classification'=>$result['data']['classification'], 'where_clause' => '(varchar01 = "'.$result['data']['builder_currency'] .'")');
				$builder_currency = $this->Mod_general_value->get_general_value($args);
				$this->Mod_custom_settings->response($builder_currency);
			}
		}

	}

	/** 
	* Save Custom Fields
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: YnVkZ2V0L3NhdmVfcgxf19fY29fcgxf1F5bWVudA--
	*/
	public function save_custom_field()
	{
		$result = $this->sanitize_input();
		
		if(TRUE == $result['status'])
		{
			if($result['data']['ub_custom_field_id'] > 0)
		  	{
		  		if(isset($result['data']['add_custom_val']) && $result['data']['add_custom_val']!='')
		  		{
		  			
		  			$result['data']['field_values'] = ",".$result['data']['add_custom_val'];

		  		}
		  		$result['data']['ub_custom_field_id'] = $result['data']['ub_custom_field_id'];
		  		$result['data']['mandatory'] = isset($result['data']['mandatory'])?'Yes':'No';
		  		$result['data']['modified_by'] = $this->user_id;
		  		$result['data']['modified_on'] = TODAY;	  		
				unset($result['data']['add_custom_val']);
				//unset($result['data']['module_name']);
				//unset($result['data']['classification']);
		  	    $response = $this->Mod_custom_settings->update_custom_fields($result['data']);
		  		
		  	}
		  	else
		  	{
		  		if(isset($result['data']['add_custom_val']) && $result['data']['add_custom_val']!='')
		  		{
		  			
		  			$result['data']['field_values'] = ",".$result['data']['add_custom_val'];

		  		}
		  		$result['data']['mandatory'] = isset($result['data']['mandatory'])?'Yes':'No';
		  		$result['data']['builder_id'] = $this->builder_id;
		  		$result['data']['user_id'] = $this->user_id;
		  		$result['data']['created_by'] = $this->user_id;
		  		$result['data']['created_on'] = TODAY;
		  		$result['data']['modified_by'] = $this->user_id;
		  		$result['data']['modified_on'] = TODAY;	  		
				unset($result['data']['add_custom_val']);
		  	    $response = $this->Mod_custom_settings->update_custom_fields($result['data']);
			
			
			
		  }
		  $this->Mod_custom_settings->response($response);		
		}
		
		
	}
	/** 
	* get_custom_fields
	* 
	* @method: get_custom_fields 
	* @access: public 
	* @param:  
	* @return: array 
	* @url: 
	*/
	public function get_custom_fields()
	{
		$result = $this->sanitize_input();
		//print_r($result);exit;

		$data = array();

		//get custom field modules from general value table
		$get_custom_field_modules = array('classification'=>'custom_field_modules');
		$custom_field_result = $this->Mod_general_value->get_general_value($get_custom_field_modules);
		$data['custom_field_array'] = $custom_field_result['values'];

		//Fetch all custom fields
		$custom_list = $this->Mod_custom_settings->get_custom_fields(array(
									'select_fields' => array('CUSTOM_FIELD.label_name','CUSTOM_FIELD.data_type','CUSTOM_FIELD.display_order','CUSTOM_FIELD.mandatory','CUSTOM_FIELD.module_name','CUSTOM_FIELD.ub_custom_field_id'),
									'where_clause' => array('CUSTOM_FIELD.builder_id'=> $this->builder_id,'CUSTOM_FIELD.status' => 'Active'),
									));
		
			if(isset($custom_list['aaData']))
			{
				$data['custom_list'] = $custom_list['aaData'];
			}else{
			$data['custom_list'] = false;
			}
		$responses = $this->load->view('content/setup/custom_field_list',$data,true);
		echo $responses; exit;
	}

	/*

	* Get custom_field_values
	* @method: get_custom_field_values 
	* @access: public 
	* @param:  
	* @return:  response array
	* url encoded : Ymlkcy9zYXZlX2JpZC8-
	*/

	public function get_custom_field_values()
	{

		if(!empty($this->input->post()))
	   {
		 //Sanitize input
		  $result = $this->sanitize_input();
		  if(TRUE === $result['status'])
		  {	
            
			$custom_list = $this->Mod_custom_settings->get_custom_fields(array(
									'select_fields' => array('CUSTOM_FIELD.label_name','CUSTOM_FIELD.data_type','CUSTOM_FIELD.display_order','CUSTOM_FIELD.mandatory','CUSTOM_FIELD.module_name','CUSTOM_FIELD.ub_custom_field_id','CUSTOM_FIELD.field_values','CUSTOM_FIELD.module_name','CUSTOM_FIELD.classification','CUSTOM_FIELD.tooltip'),
									'where_clause' => array('CUSTOM_FIELD.ub_custom_field_id'=> $result['data']['ub_custom_field_id']),
									));
		
			if(isset($custom_list['aaData']))
			{
				$data['custom_list'] = $custom_list['aaData'];
			}else{
			$data['custom_list'] = false;
			}
			$data['label_name'] = $custom_list['aaData'][0]['label_name'];
			$data['data_type'] = $custom_list['aaData'][0]['data_type'];
			$data['display_order'] = $custom_list['aaData'][0]['display_order'];
			$data['mandatory'] = $custom_list['aaData'][0]['mandatory'];
			$data['field_values'] =  explode(",",$custom_list['aaData'][0]['field_values']);
			$data['module_name'] = $custom_list['aaData'][0]['module_name'];
			$data['classification'] = $custom_list['aaData'][0]['classification'];
			$data['tooltip'] = $custom_list['aaData'][0]['tooltip'];
			$data['status'] = TRUE;
			$this->Mod_custom_settings->response($data);
			
		}
	  }
	}

	/** 
	* Delete Custom Field
	* 
	* @method: delete_custom_field 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* url: bgxf19ncy9kZWxldgxf1Vfbgxf19nLw--
	*/
	
	public function delete_custom_field()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$result['data']['ub_custom_field_id'] = $result['data']['ub_custom_field_id'];
		  		$result['data']['status'] = 'Delete';
		  		$result['data']['modified_by'] = $this->user_id;
		  		$result['data']['modified_on'] = TODAY;	  		
				
		  	    $response = $this->Mod_custom_settings->update_custom_fields($result['data']);

				
			}
			else
			{
				$this->Mod_custom_settings->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_custom_settings->response($response);
	}
	/** 
	* Function to cancil the current plan
	* 
	* @method: cancel_plan 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	
	public function cancel_plan()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{  		
				//echo "<pre>";print_r($result);exit;
		  	    $response = $this->Mod_payment->cancel_subscription($result['data']['subscription_id']);
		  	    if (isset($response['responce']['messages']['message']['code']) && $response['responce']['messages']['message']['code'] == 'I00001') 
		  	    {
		  	    	// block to update the builder contract after canceling the subscription. 
		  	    	$where_condition = array('subscription_id' => $result['data']['subscription_id']);
					$fetch_builder_contract_detail = $this->Mod_builder_contract->get_builder_contract_details(array(	'select_fields' => array('ub_builder_contract_id'),
						'where_clause' => $where_condition
						));
					$fetch_builder_contract_detail_array = $fetch_builder_contract_detail['aaData'];
		  	    	
		  	    	$builder_contract_update_array = array(
											'end_date' => TODAY,
											'ub_builder_contract_id' => $fetch_builder_contract_detail_array['0']['ub_builder_contract_id'] 
											);
			        $update_builder_contract_response = $this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
			        //print_r($update_response);exit;
			        // block to update the user plan status.
			        $sort_type = 'DESC LIMIT 1';
					$order_by_where = 'USER_PLAN.ub_user_plan_id'.' '.$sort_type;
					$where_condition = array('USER_PLAN.builder_id' => $this->user_session['builder_id']);
			        $plan_details_array = array('select_fields' => 
					                         array('DISTINCT(USER_PLAN.ub_user_plan_id)'),
					                         'where_clause' => $where_condition,
											'order_clause' => $order_by_where);	
											
					$plan_details_response = $this->Mod_plan->get_user_plan($plan_details_array) ;
					//echo "<pre>"; print_r($plan_details_response );exit();
			        $update_array = array(
						'status' => 'Inactive',
						'ub_user_plan_id' => $plan_details_response['aaData']['0']['ub_user_plan_id']
						);
					$plan_details_results = $this->Mod_plan->update_user_plan($update_array);

			        if ($plan_details_results['status'] == TRUE) 
			        {
			        	$change_plan_responce = $this->change_plan($result['data']['plan_id']);
			        }
		  	    }

			}
			else
			{
				$this->Mod_payment->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		//Response data
		$this->Mod_payment->response($response);
	}

	public function update_cc()
	{
		if(!empty($this->input->post()))
		{
			$result = $this->sanitize_input();
			if(TRUE == $result['status'])
			{
				$update_cc['credit_card_number'] = $result['data']['credit_card_number'];
				/* $update_cc['expiry_month'] = $result['data']['expiry_month'];
				$update_cc['expiry_year'] = $result['data']['expiry_year']; */
				$update_cc['expiry_date'] = $result['data']['expiry_year'].'-'.$result['data']['expiry_month'];
				$update_cc['code'] = $result['data']['code'];
				$update_cc['cardname'] = $result['data']['cardname'];
				$subscription_id = $result['data']['subscription_id'];
				$ub_payment_id = $result['data']['ub_payment_id'];
				$cc_update = $this->Mod_payment->update_ccdetails($subscription_id ,$update_cc ,$ub_payment_id);
				$this->Mod_payment->response($cc_update);
			}
		}
	
	}
	
    
	/** 
	* 
	* @method: get_invoices 
	* @access: public 
	* @param:  
	* @return: array 
	*/	
	public function get_invoices()
	{
	
		$post_array[] = array(
							'field_name' => 'PAYMENT_DETAILS.builder_id',
							'value'=> $this->builder_id, 
							'type' => '='
							);

		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo '<pre>';print_r($result);exit;
			if(TRUE === $result['status'])
			{
				 	
				$where_str = $this->Mod_payment->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_payment->get_payment_details(array(
										'select_fields' => array('COUNT(PAYMENT_DETAILS.reference_id) AS total_count'),
										'join'=> array('invoice'=>'yes','user_plan'=>'yes','plan'=>'yes'),
										'where_clause' => $where_str,
										//'group_clause'=> array("ESTIMATE.builder_id")
												)); 
												
				}
				 // echo '<pre>';print_r($total_count_array);exit;

				// Order by
			    $order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'INVOICE_DETAILS.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;	
				}
				else
				{
					$order_by_where = 'INVOICE_DETAILS.ub_invoice_id DESC';
				} 
			}
			else
			{
				$this->Mod_payment->response($result);
			}
		}
		// $from_date_array = array('INVOICE_DETAILS.invoice_from_date'=>'invoice_from_date');								
		// $to_date_array = array('INVOICE_DETAILS.invoice_to_date'=>'invoice_to_date');
		$payment_date_array = array('PAYMENT_DETAILS.payment_date'=>'payment_date');
		$billing_date_array = array('PAYMENT_DETAILS.payment_date + INTERVAL '.PAYMENT_DURATION.' DAY'=> 'billing_date');
		$result_data = $this->Mod_payment->get_payment_details(array(
			'select_fields' => array('INVOICE_DETAILS.ub_invoice_id','PAYMENT_DETAILS.amount','PAYMENT_DETAILS.reference_id','(PAYMENT_DETAILS.last_4digits) AS last','PLAN.plan_name','PAYMENT_DETAILS.payment_status,'.$this->Mod_user->format_user_datetime($payment_date_array,"date").','.$this->Mod_user->format_user_datetime($billing_date_array,"date")),
			'join'=> array('invoice'=>'yes','plan'=>'yes'),
			'where_clause' => $where_str,
			'order_clause' => $order_by_where, 
			'pagination' => $pagination_array
            ));

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
        // echo '<pre>';print_r($result_data);exit;
		$this->Mod_payment->response($result_data);
	}
	
	/** 
	* 
	* @method: invoice_download 
	* @access: public 
	* @param:  
	* @return: array 
	* @url : c2V0dXAvaW52b2ljZV9kb3dubgxf19hZC8- 
	*/	
	public function invoice_download($invoice_id , $uni_builder_id = 0)
	{
		// echo '<pre>';print_r($uni_builder_id.'  ===== '.$invoice_id);exit;
	
		if($this->user_account_type == 500)
		{
			$post_array =  array('USER.builder_id'=>$uni_builder_id, 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);
		}
		else
		{
			$post_array =  array('USER.builder_id'=>$this->builder_id, 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);
		}
		// echo '<pre>';print_r($post_array);
		$sort_type = 'ASC';
		$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
		$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','BUILDER_DETAILS.builder_name','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array
												));
		// echo '<pre>';print_r($builder_details_array);exit;
		if(TRUE === $builder_details_array['status'])
		{
			$builder_address_data = $builder_details_array['aaData']['0'];
			$builder_address_data['address'] = (isset($builder_address_data['address']) && $builder_address_data['address']!='')?$builder_address_data['address'].', ':'';
			$builder_address_data['city'] = (isset($builder_address_data['city']) && $builder_address_data['city']!='')?$builder_address_data['city'].', ':'';
			$builder_address_data['province'] = (isset($builder_address_data['province']) && $builder_address_data['province']!='')?$builder_address_data['province'].', ':'';
			$builder_address_data['country'] = (isset($builder_address_data['country']) && $builder_address_data['country']!='')?$builder_address_data['country'].' ':'';
			$builder_address_data['postal'] = (isset($builder_address_data['postal'] ) && $builder_address_data['postal']!='')?$builder_address_data['postal']:'';
			$builder_address = $builder_address_data['address'].$builder_address_data['city'].$builder_address_data['province'].$builder_address_data['country'].$builder_address_data['postal'];
			
			if (!empty($builder_address_data['desk_phone'])) 
			{
				$builder_phone = $builder_address_data['desk_phone'];
			}
			else
			{
				$builder_phone = '';
			}
		}
			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
			$data['builder_details'] = array( 'builder_address' => $builder_address,
											  'builder_name' 	=> $builder_address_data['builder_name'],
											  'builder_phone' 	=> $builder_phone,
											  'current_date'	=> $current_date
											);
			$from_date_array = array('INVOICE_DETAILS.invoice_from_date'=>'invoice_from_date');								
			$to_date_array = array('INVOICE_DETAILS.invoice_to_date'=>'invoice_to_date');								
			$invoice_data = $this->Mod_payment->get_payment_details(array(
			'select_fields' => array('INVOICE_DETAILS.ub_invoice_id','INVOICE_DETAILS.invoice_no,'.$this->Mod_user->format_user_datetime($from_date_array,"date").',INVOICE_DETAILS.invoice_amount','PAYMENT_DETAILS.reference_id','(PAYMENT_DETAILS.last_4digits) AS last','PLAN.plan_name','PLAN.no_of_projects','PLAN.no_of_users','PAYMENT_DETAILS.payment_status','PAYMENT_DETAILS.payment_date','INVOICE_DETAILS.address','INVOICE_DETAILS.city','INVOICE_DETAILS.province','INVOICE_DETAILS.country','INVOICE_DETAILS.plan_description','INVOICE_DETAILS.pincode','INVOICE_DETAILS.phone_number,'.$this->Mod_user->format_user_datetime($to_date_array,"date")),
			'join'=> array('invoice'=>'yes','plan'=>'yes'),
			'where_clause' => array('ub_invoice_id' => $invoice_id)
			// 'ub_invoice_id' =>  $invoice_id ,
            ));
			// echo '<pre>';print_r($invoice_data);exit;
			$data['invoice_data'] = array();
			if($invoice_data['status'] == TRUE)
			{
				$data['invoice_data'] = $invoice_data['aaData'][0];
			}
			// echo '<pre>';print_r($data);exit;
			// $this->load->view('content/print/invoice', $data);
			
		ob_start();
		// include(APPPATH.'views/content/print/invoice.php');
		$content= $this->load->view('content/print/invoice', $data, true); 
		// convert in PDF
		// require_once(APPPATH.'libraries/Html2pdf.php');
		$this->load->library('Html2pdf', array('P', 'A4', 'fr', true, 'UTF-8', array(15, 5, 15, 5)));
		try
		{	
			// $this->html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(15, 5, 15, 5));
			$this->html2pdf->pdf->SetDisplayMode('fullpage');
			$this->html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			$this->html2pdf->Output('Invoice.pdf','D');
		}
		catch(HTML2PDF_exception $e) 
		{
			echo $e;
			exit;
		}   
	}
	public function plan_history()
	{
		/* Below code was added by chandru for listing plan history in change plan 18-08-2015 */
			/* Fetch plan list */
			// Fetch argument building
			/* $order_by = 'USER_PLAN.ub_user_plan_id desc';
			$where_condition = array('builder_id'=>$this->builder_id);
			$plan_args = array('select_fields' => array('USER_PLAN.created_on','USER_PLAN.modified_on','plan_name','plan_amount','ub_plan_id'),
					'join'=> array('userplan'=>'Yes'),
					'where_clause' => $where_condition,
					'order_clause' => $order_by);

			// The following parameters required for data table
			$user_plan_data = $this->Mod_plan->get_plan_details($plan_args); 
			$data['plan_data'] = $user_plan_data['aaData']; */
			// echo '<pre>';print_r($data['plan_data']);exit;
			
			/* NEW */
			$post_array[] = array(
							'field_name' => 'UB_BUILDER_CONTRACT.builder_id',
							'value'=> $this->builder_id, 
							'type' => '='
							);

		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo '<pre>';print_r($result);exit;
			if(TRUE === $result['status'])
			{
				 	
				$where_str = $this->Mod_plan->build_where($post_array);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					// echo '<pre>';print_r($where_str);exit;
					 $total_count_array = $this->Mod_plan->get_plan_and_contractdetails(array(
										'select_fields' => array('COUNT(PLAN.ub_plan_id) AS total_count'),
										'join'=> array('contract'=>'yes'),
										'where_clause' => $where_str,
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
					$order_by_where = 'PLAN.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;	
				}
				else
				{
					$order_by_where = 'PLAN.ub_plan_id DESC';
				} 
			}
			else
			{
				$this->Mod_plan->response($result);
			}
		}
		/* $from_date_array = array('INVOICE_DETAILS.invoice_from_date'=>'invoice_from_date');								
		$to_date_array = array('INVOICE_DETAILS.invoice_to_date'=>'invoice_to_date');
		$payment_date_array = array('PAYMENT_DETAILS.payment_date'=>'payment_date'); */
		$datetime_array = array('UB_BUILDER_CONTRACT.created_on'=>'created_on');
		$modifyied_datetime_array = array('UB_BUILDER_CONTRACT.end_date'=>'');
		$formatted_date_array = $this->Mod_user->format_user_datetime($modifyied_datetime_array);
		$formatted_date = "IF(UB_BUILDER_CONTRACT.end_date = '0000-00-00', 'Present',".$formatted_date_array.") AS end_date";

		$result_data = $this->Mod_plan->get_plan_and_contractdetails(array(
			'select_fields' => array('PLAN.plan_name,PLAN.plan_amount','UB_BUILDER_CONTRACT.contract_number','PLAN.ub_plan_id','UB_BUILDER_CONTRACT.created_on','UB_BUILDER_CONTRACT.modified_on','UB_BUILDER_CONTRACT.start_date','UB_BUILDER_CONTRACT.expiry_date,'.$formatted_date),
			'join'=> array('contract'=>'yes'),
			'where_clause' => $where_str,
			'order_clause' => $order_by_where, 
			'pagination' => $pagination_array
            ));
		/*if($result_data['aaData'][0]['modified_on'] == "0000-00-00 00:00:00")
		{
			$result_data['aaData'][0]['modified_on'] = "";
		}*/
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
        // echo '<pre>';print_r($result_data);exit;
		$this->Mod_plan->response($result_data);
	}
	
	/* Below function was added by chandru */
	public function cancel_subscriptions()
	{
		$results = $this->sanitize_input();
		if(TRUE == $results['status'])
		{
			$subscription_id = $results['data']['subscription_id'];
			$this->load->library('authorize_arb');
			// Start with a cancel object
			$this->authorize_arb->startData('cancel');
			// Locally-defined reference ID (can't be longer than 20 chars)
			$refId = substr(md5( microtime() . 'ref' ), 0, 20);
			$this->authorize_arb->addData('refId', $refId);
			// The subscription ID that we're canceling
			// $subscription_id = 2793733;
			$this->authorize_arb->addData('subscriptionId', $subscription_id);
			if( $this->authorize_arb->send() )
			{
				/* If subscription was cancelled we are deactive the user */
				/* Changing status in User and builder table */
				/* Who all are created by builder we are deactivating all the users */
				$builder_id = $this->builder_id;
				$delete_builder_record = $this->Mod_builder->delete_builder_and_users($builder_id);
				if(TRUE == $delete_builder_record['status'])
				{
					$session_destroy = array();
					$session_destroy['logout'] = "Yes";
					$result = $this->Mod_login->destroy_session($session_destroy);
					$this->load->view('content/login/login');
					$delete_builder_record['status'] = TRUE;
					$this->Mod_builder->response($delete_builder_record);
				}
			}else{
				$delete_builder_record['status'] = FALSE;
				$delete_builder_record['message'] = 'Builder subscription was not cancelled';
				$this->Mod_builder->response($delete_builder_record);
			}
		}
	}
	
	/* Below function was created by chandru */
	public function create_new_subscriptions()
	{
		/* Fetch previous payment and subscription details */
		$sort_type = 'DESC LIMIT 1';
			$order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
			$previous_payment_subscription_details = $this->Mod_payment->get_payment_details(array(
												'select_fields' => array(),
												'where_clause' => array('builder_id'=>$this->builder_id,'payment_status'=>'Success'),
												'order_clause' => $order_by_where
												));
												// echo '<pre>';print_r($previous_payment_subscription_details);exit;
			if(TRUE == $previous_payment_subscription_details['status'])
			{
				$cancel_subscription_id = $previous_payment_subscription_details['aaData'][0]['subscription_id'];
			}
		/* Fetch code ends here */
		$results = $this->sanitize_input();
		if(TRUE == $results['status'])
		{
			/* block to get builder datails*/
			$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

			$sort_type = 'ASC';
			$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
			$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
			$builder_details_array = $this->Mod_builder->get_builder_details(array(
													'select_fields' => array('USER.first_name','USER.last_name','USER.ub_user_id','BUILDER_DETAILS.ub_builder_id','BUILDER_DETAILS.builder_name','USER.primary_email','USER.desk_phone',
													'USER.address','USER.city','USER.province','USER.primary_email',
													'USER.postal','USER.country'),
													'join'=> array('user'=>'yes'),
													'where_clause' => $post_array,
													'order_clause' => $order_by_where
													));	
			//echo "<pre>";print_r($builder_details_array);exit;
			$builder_detail = $builder_details_array['aaData']['0'];

			$sort_type = 'DESC';
			$order_by_where = 'USER_PLAN.ub_user_plan_id'.' '.$sort_type;
			$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
			$plan_array = $this->Mod_plan->get_plan_details(array(
							'select_fields' => array('USER_PLAN.ub_user_plan_id'),
							'where_clause' => array('USER_PLAN.builder_id' => $this->user_session['builder_id']),
							'join'=> array('userplan'=>'Yes'),
							'order_clause' => $order_by_where, 
							'pagination' => $pagination_array
							 ));
			$current_ub_user_plan_id = $plan_array['aaData']['0']['ub_user_plan_id'];

			// block to add data in builder_contract table
			$plan_id = 2;
			$plan_name = 'Gold';
			/* Add in payment table */
			$payment_details_array = array(
								    'builder_id' 			=> $this->user_session['builder_id'],
									'plan_id'  				=> $plan_id,
									'payment_mode'	 		=> 'Credit Card',
									'currency' 				=> 'USD',
									'payment_date' 			=> TODAY,
									'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
									'created_on' 			=> TODAY,
									'created_by' 			=> $this->user_id,
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $this->user_id
								   );
					$payment_result = $this->Mod_payment->add_payment($payment_details_array);
			
			/* AIM code starts here */
			$card_expiry_month_and_date = $results['data']['card_expiry_month'].'/'.$results['data']['card_expiry_year'];
			$post_array = array(
					'x_card_num'			=> $results['data']['credit_card_numbers'], // Visa
					'x_exp_date'			=> $card_expiry_month_and_date,
					'x_card_code'			=> $results['data']['ccv_code'],
					'x_description'			=> 'AIM',
					'x_amount'				=> $results['data']['updated_plan_amount'],
					'x_first_name'			=> $results['data']['first_name'],
					'x_last_name'			=> $results['data']['last_name'],
					'x_address'				=> $results['data']['address'],
					'x_city'				=> $results['data']['city'],
					'x_state'				=> $results['data']['province'],
					'x_zip'					=> $results['data']['postal'],
					'x_country'				=> $results['data']['country'],
					'x_phone'				=> $results['data']['desk_phone'],
					'x_email'				=> $results['data']['primary_email'],
					'x_customer_ip'			=> $this->input->ip_address()
			);
			/* Authorize.net AIM */
			$this->load->library('authorize_net');
			$this->authorize_net->setData($post_array);
			if( $this->authorize_net->authorizeAndCapture() )
				{
					$success_array = $this->authorize_net->getTransactionId();
					
					$date = TODAY;
					$date = strtotime($date);
					$date = strtotime("30 day", $date);
					$expiry_date = date('Y-m-d h:i:s', $date);
					$builder_contract = array(
				'builder_id' => $builder_detail['ub_builder_id'],
				'user_id' => $builder_detail['ub_user_id'],
				'user_plan_id' => $plan_id,
				'start_date' => CURRENT_DATE,
				'expiry_date' => $expiry_date,
				'created_by' => $builder_detail['ub_user_id'],
				'created_on' => TODAY,
				'modified_on' 			=> TODAY,
				'modified_by' 			=> $this->user_id
				);
			$ub_builder_contract_response = $this->Mod_builder_contract->add_builder_contract($builder_contract);

			$builder_contract_number = $this->Mod_builder_contract->generate_number_time('CON',BUILDER_CONTRACT_NUMBER_LENGTH,$ub_builder_contract_response['insert_id']);
			$builder_contract_update_array = array(
								'contract_number' => $builder_contract_number,
								'ub_builder_contract_id' => $ub_builder_contract_response['insert_id'],
								'modified_on' 			=> TODAY,
								'modified_by' 			=> $this->user_id
								);
			$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
			/* Insert in payment table */
			$digits = substr(trim($success_array[50]), -4);
			/* $payment_update_array = array(
									'payment_no' => $payment_no,
									'ub_payment_id' => $payment_result['insert_id'],
									'modified_by' => $builder_detail['ub_user_id'],
									'modified_on' => TODAY
									);
					$this->Mod_payment->update_payment($payment_update_array); */
					$payment_update_details_array = array(
								    'ub_payment_id' => $payment_result['insert_id'],
									'plan_id'  				=> $plan_id,
									'builder_contract_id'  	=> $ub_builder_contract_response['insert_id'],
									'payment_mode'	 		=> 'Credit Card',
									'currency' 				=> 'USD',
									'payment_date' 			=> TODAY,
									'payment_method' 			=> 'AIM',
									'payment_type' 			=> 'Received',
									'modified_by' 			=> $this->user_id,
					                'modified_on' 			=> TODAY,
									'builder_contract_id'  	=> $ub_builder_contract_response['insert_id'],
									'transaction_id'  		=> $success_array[6],
									'reference_id'			=> $success_array[37],
									'amount' 				=> $success_array[9], 
									'last_4digits'			=> $digits,
									'response_code' 		=> $success_array[0], 
									'result_code' 			=>  $success_array[2], 
									'result_text' 			=>  $success_array[3],
									'payment_status' 		=> SUCCESS_PAYMENT,
									'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $this->user_id
								   );
					$this->Mod_payment->update_payment($payment_update_details_array);
					// echo '<pre>';print_r($this->authorize_net->getTransactionId());exit;
					
					//echo '<pre>';print_r($success_array);
					/* For success case write code here */
					/* If AIM transaction was succesfull then insert in below tables */
					/* Update payment table */
					
					$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$payment_result['insert_id']);	
					/*$update_payment_details_array = array(
									'transaction_id' => $success_array[7],
									'payment_no' 			=> $payment_no,
									'ub_payment_id' 		=> $payment_result['insert_id'],
						        	
								   );
								  $update_payment_result = $this->Mod_payment->update_payment($update_payment_details_array);*/
					
					$builder_contract_update_array = array(
									'latest_payment_id' => $payment_result['insert_id'],
									'ub_builder_contract_id'  	=> $ub_builder_contract_response['insert_id'],
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $this->user_id
									);
					$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
					$date = TODAY;
					$date = strtotime($date);
					$date = strtotime("30 day", $date);
					$invoice_to_date = date('Y-m-d h:i:s', $date);
					/* Below code was added by chandru 14-10-2015 */
					$plan_response = $this->Mod_plan->get_plan_details(array(
										'select_fields' => array('plan_name','plan_code','plan_amount','plan_length','no_of_projects','no_of_users'),
										'where_clause' => array('ub_plan_id'=>$plan_id)
										));
					$plan_array = $plan_response['aaData'][0];
					/* Below code was modified by chandru 14-10-2015 */
					if($plan_array['no_of_projects'] == -1)
					{
						$plan_array['no_of_projects'] = 'Unlimited';
					}
					if($plan_array['no_of_users'] == -1)
					{
						$plan_array['no_of_users'] = 'Unlimited';
					}
					$plan_description = $plan_array['no_of_projects'].' Projects / year, '.$plan_array['no_of_users'].' Users, Unlimited Storage';
					$invoice_array = array(
									'builder_id' => $this->user_session['builder_id'],
									'payment_id' => $payment_result['insert_id'],
									'transaction_id' => $success_array[6],
									'user_plan_id' => $plan_id,
									'plan_name' => $plan_name,
									'invoice_from_date' => date('Y-m-d'),
									'invoice_amount' => $success_array[9],
									'invoice_status' => 'Active',
									'plan_description' => $plan_description,
									'address'				=> $builder_detail['address'],
									'city'				=> $builder_detail['city'],
									'province'				=> $builder_detail['province'],
									'pincode' 			=> $builder_detail['postal'],
									'country'				=> $builder_detail['country'],
									'phone_number' => $builder_detail['desk_phone'],
									'invoice_to_date' => $invoice_to_date,
									'created_on' => TODAY,
									'created_by' => $this->user_id
									);
					$invoice_response = $this->Mod_invoice->add_invoice($invoice_array);
					$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$payment_result['insert_id']);	
					$invoice_no = $this->Mod_builder->generate_number(INVOICE_NAME_FORMAT,INVOICE_NUMBER_LENGTH,$invoice_response['insert_id']);	
					$payment_update_array = array(
									'payment_no' => $payment_no,
									'ub_payment_id' => $payment_result['insert_id'],
									'modified_by' => $builder_detail['ub_user_id'],
									'modified_on' => TODAY
									);
					$this->Mod_payment->update_payment($payment_update_array);
					$invoice_update_array = array(
									'invoice_no' => $invoice_no,
									'ub_invoice_id' => $invoice_response['insert_id']
									);
					$this->Mod_invoice->update_invoice($invoice_update_array);

					$user_plan_data = array(
					'builder_id' => $this->user_session['builder_id'],
					'user_id' => $builder_detail['ub_user_id'],
					'status' => 'Active',
					'created_by' => $builder_detail['ub_user_id'],
					'created_on' => TODAY,
					'plan_id' => $plan_id,
					// 'modified_on' 			=> TODAY,
					'modified_by' 			=> $this->user_id
					
					);

					$ub_plan_response = $this->Mod_plan->add_user_plan($user_plan_data);
					/* ARB implementation code starts here */
					$this->load->library('authorize_arb');
					// Start with a create object
					$this->authorize_arb->startData('create');

					// Locally-defined reference ID (can't be longer than 20 chars)
					$refId = substr(md5( microtime() . 'ref' ), 0, 20);
					$this->authorize_arb->addData('refId', $refId);
					
					/* Cancel subscription code added by chandru */
					if(isset($cancel_subscription_id) && !empty($cancel_subscription_id))
					{
						$cancel_status = $this->Mod_payment->cancel_subscription($cancel_subscription_id);
						/* Update in builder contract table for cancelling previous subscription */
						$builder_contract_update_array = array(
									'subscription_id'  	=> $cancel_subscription_id,
									'end_date'  	=> date("Y-m-d"),
									'status'  	=> CANCELLED_CONTRACT,
									'modified_on' 	=> TODAY,
									'modified_by' 	=> $this->user_id
									);
						$this->Mod_builder_contract->update_builder_contract_table($builder_contract_update_array);
					}
					/* Cancel subscription code ends here*/

					// Data must be in this specific order
					// For full list of possible data, refer to the documentation:
					// http://www.authorize.net/support/ARB_guide.pdf
					/* $card_expiry_year_and_month = $results['data']['card_expiry_year'].'-'.$results['data']['card_expiry_month']; */
					$payment_array =  array(
		          	  'builder_id' 		=> $this->user_session['builder_id'],
		          	  'builder_name'	=> $builder_detail['builder_name'],
				      'firstName'		=> $results['data']['first_name'],
		          	  'payment_id' 		=> $payment_result['insert_id'],
					  'lastName'		=> $results['data']['last_name'],
					  'desk_phone' 		=> $results['data']['desk_phone'],
					  'contract_number' => $ub_builder_contract_response['insert_id'],
					  'street1'			=> $results['data']['address'],
					  'city'			=> $results['data']['city'],
					  'state'			=> $results['data']['province'],
					  'postalCode' 		=> $results['data']['postal'],
					  'country'			=> 'US',
					  'start_date'      => date('Y-m-d', strtotime("+30 days")),
					  'email'			=> $builder_detail['primary_email'],
					  'ipaddress'		=> $_SERVER['REMOTE_ADDR'],
					  'accountNumber'	=> $results['data']['credit_card_numbers'],
					  'expirationMonth'	=> $results['data']['card_expiry_month'],
					  'expirationYear'	=> $results['data']['card_expiry_year'],
					  'cvNumber'		=> $results['data']['ccv_code'],
					  'cardname'		=> $results['data']['card_name'],
                      'plan_id'			=> $plan_id,
					  'description'		=> 'ARB');
				 	$arb_payment_response = $this->Mod_payment->make_payment($payment_array);
					// echo '<pre>';print_r($arb_payment_response);exit;
					if (isset($arb_payment_response['responce']['messages']['message']['code']) && $arb_payment_response['responce']['messages']['message']['code'] == 'I00001')
					{

					 	/* $builder_contract_update_array = array(
								'subscription_id' => $results['data']['old_subscription_id'],
								'status' => CANCELLED_CONTRACT,
								'end_date' => TODAY,
								'modified_on' => TODAY
								);
						$update_builder_contract_response = $this->Mod_builder_contract->update_builder_contract_table($builder_contract_update_array); */
		               // process to update the contract no in ub_builder_contract table.
					   $builder_contract_update_array = array(
										'subscription_id' => $arb_payment_response['responce']['subscriptionId'],
										'latest_payment_id' => $payment_result['insert_id'],
										'status' => ACTIVE_CONTRACT,
										'latest_payment_date' => TODAY,
										'payment_count' => 1,
										'ub_builder_contract_id' => $ub_builder_contract_response['insert_id'],
										'modified_on' 			=> TODAY,
										'modified_by' 			=> $this->user_id
										);
		            	$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
		            	$arr_payment_update = array(
									'payment_no' 			=> $payment_no,
									'subscription_id' => $arb_payment_response['responce']['subscriptionId'],
									'ub_payment_id' => $payment_result['insert_id'],
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $this->user_id
									);
					$this->Mod_payment->update_payment($arr_payment_update);
					$update_old_user_plan = array(
						'ub_user_plan_id' => $current_ub_user_plan_id,
						'modified_on' => TODAY,
						'modified_by' => $this->user_id
						);
						$ub_plan_response = $this->Mod_plan->update_user_plan($update_old_user_plan); 
						/* Invoice table subscription id update */
						$invoice_sub_update_array = array(
									'subscription_id' => $arb_payment_response['responce']['subscriptionId'],
									'ub_invoice_id' => $invoice_response['insert_id']
									);
					$this->Mod_invoice->update_invoice($invoice_sub_update_array);
						/* Update in builder table for current plan */
						$update_builder_array = array(
							'ub_builder_id' => $this->user_session['builder_id'],
							'current_plan_id' => $plan_id,
							'modified_on' => TODAY,
							'modified_by' => $this->user_id
							);
						$builder_table_update = $this->Mod_builder->update_builder($update_builder_array);
		            	$response['status'] = TRUE;
		            	$response['message'] = 'Plan Changed Successfully';
					}

					$this->Mod_user->response($response);
						
				}
				else{
					//echo '<pre>';print_r($this->authorize_net->getError());exit;
					$response['message'] = $this->authorize_net->getError();
					$payment_update_details_array_failed_case = array(
								    'ub_payment_id' => $payment_result['insert_id'],
									'result_text' 			=>  $response['message'],
									'payment_status' 		=> FAILD_PAYMENT,
									'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $this->user_id
								   );
					$this->Mod_payment->update_payment($payment_update_details_array_failed_case);
					$response['status'] = FALSE;
					$this->Mod_user->response($response);
				}
		}
	}
}