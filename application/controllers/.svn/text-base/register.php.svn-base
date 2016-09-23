<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Builder Class
 *
 * @package:	Builder
 * @subpackage: Builder
 * @category:	Builder
 * @author:		Devansh
 * @modified by:chandru
 * @modified on:30-05-2015
 * @createdon(DD-MM-YYYY): 09-05-2015
*/

class Register extends UNI_Controller {
	/**
	 * @constructor
	 */
	public function __construct()
    {
		/* Mod_doc,Mod_builder_mail_template model was added by chandru */
        parent::__construct();
		$this->load->model(array('Mod_lead','Mod_Message','Mod_builder_contract','Mod_general_value','Mod_timezone','Mod_user','Mod_builder','Mod_plan','Mod_signup','Mod_login','Mod_doc','Mod_builder_mail_template','Mod_notification','Mod_payment','Mod_invoice','Mod_task'));
		$this->load->helper('export');
		$this->module;
		
    }
    /** 
	* Get all Builder
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: array 
	*/
	public function index($plan_id=0,$email_id='',$subscription_id=0,$type='')
	{
		$data = array(
		'title'        => 'Register',		
		'content'      => 'content/register/register',
        'page_id'      => 'Register',
	    'current_url' => $this->uri->segment(1),
		'selected_plan_id' => $plan_id,
		'builder_primary_email_id' => $email_id,
		'subscription_id' => $subscription_id,
		'payment_change_type' => $type
		);
		// echo '<pre>';print_r($subscription_id);exit;
		//$this->load->view($data);
		$plan_array = $this->Mod_builder->get_plans(array(
												'select_fields' => array('PLAN.ub_plan_id','CONCAT(PLAN.plan_name, " - ",PLAN.plan_amount, " USD", " - ",PLAN.no_of_projects, " Project" ) AS plan'),
												'where_clause' => array('show_in_registration' => 'Yes')));
        $data['plan_id']=array();
        if(TRUE === $plan_array['status'])
		{
			$data['plan'] = $this->Mod_builder->build_ci_dropdown_array($plan_array['aaData'],'ub_plan_id', 'plan');
		}

		if (isset($email_id) && !empty($email_id)) 
		{
			$user_plan_data = $this->Mod_builder->get_plans(array(
												'select_fields' => array('PLAN.ub_plan_id','CONCAT(PLAN.plan_name, " - ",PLAN.plan_amount, " USD", " - ",PLAN.no_of_projects, " Project" ) AS plan'),
												'where_clause' => array('ub_plan_id' => $plan_id)));
			$data['user_plan_details'] 	= $user_plan_data['aaData'][0]['plan'];
		}
		//code to get the year list
		$years = range(date("Y"), date("Y", strtotime('+10 years')));
		$year_list[] = array('key' => '',
            					'value' => 'Year'
            	);
        foreach($years as $year)
        {
            $year_list[] = array('key' => $year,
            					'value' => $year
            	);
        }    
        $data['expiry_year'] = $this->Mod_builder->build_ci_dropdown_array($year_list,'key', 'value','multiple');
		
		// code to get the month list
	        $month=array(''	=>'Month',
	            '01'=>'January',
	            '02'=>'February',
	            '03'=>'March',
	            '04'=>'April',
	            '05'=>'May',
	            '06'=>'June',
	            '07'=>'July',
	            '08'=>'August',
	            '09'=>'September',
	            '10'=>'October',
	            '11'=>'November',
	            '12'=>'December');
	        foreach($month as $key => $value) 
	        {
			  $month_list[] = array('key' => $key,
            					'value' => $value);
			}

		$data['expiry_month'] = $this->Mod_builder->build_ci_dropdown_array($month_list,'key', 'value','multiple');
		$this->load->view('content/register/register', $data);
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
		$post_data = array();
		if(!empty($this->input->post()))
		{	
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				/* Below condition was added by chandru for upgrade/downgrade 24/09/2015 */
				if(isset($result['data']['subscription_id']) && !empty(isset($result['data']['subscription_id'])))
				{
					if(isset($result['data']['payment_change_type']) && !empty(isset($result['data']['payment_change_type'])))
					{
						$upgrade_grade_array = $this->upgrade_plan($result['data']);
						if(TRUE != $upgrade_grade_array['status'])
						{
							/* If AIM Transaction was failed then we are sending responce to JS */
							$this->Mod_user->response($upgrade_grade_array);
						}else{
							$result['data']['upgrade_payment_status'] = TRUE;
							$result['data']['payment_insert_id'] = $upgrade_grade_array['payment_insert_id'];
						}
					}
					$down_grade_array = $this->downgrade_plan($result['data']);
					if(TRUE == $down_grade_array['status'])
					{
						$down_grade_array['redirect'] = TRUE;
					}
					$this->Mod_user->response($down_grade_array);
				}else{
				if (isset($result['data']['primary_email']) && !empty(isset($result['data']['primary_email']))) 
				{
					$primary_email = $result['data']['primary_email'];
					$verify_primary_email = $this->Mod_user->get_users(array(
												'select_fields' => array('USER.primary_email'),
												'where_clause' => array('USER.primary_email'=> $primary_email)
												));
					//echo $verify_primary_email['status'];
					if ($verify_primary_email['status'] == FALSE) 
					{
						$total_count_array = $this->Mod_user->get_users(array(
													'select_fields' => array('USER.username'),
													'where_clause' => array('USER.username'=> $result['data']['user_name'])
													));	
                         if(FALSE === $total_count_array['status'])
						{
							
							$args = array('classification'=>'builder_currency', 'where_clause' => '(enum01 = "YES")');
						    $builder_currency = $this->Mod_general_value->get_general_value($args);
							
							// Credit card encryption 
							// Fetching encryption key
							$args = array('classification'=>'cc_encryption_key');
							$cc_encryption_key = $this->Mod_general_value->get_general_value($args);
							$this->load->library('ccencryption' , array('key' => $cc_encryption_key['values']['0']['value']));
							// creating an array to add the builder details in ub_builder table.
						    $form_data['builder_data'] = array(
							'builder_name' => $result['data']['builder_name'],
							'builder_currency' => $builder_currency['values']['0']['type'],
							'builder_currency_symbol_code' => $builder_currency['values']['0']['value'],
							/* 'name_on_card' => $result['data']['cardname'],
							'credit_card_number' => $this->ccencryption->encrypt($result['data']['credit_card_number']),
							'expiry_month' => $result['data']['expiry_month'],
							'expiry_year' => $result['data']['expiry_year'], */
							'current_plan_id' => $result['data']['plan_id'],
							'payment_status' => NO_PAYMENT,
							/* 'cvv' => $result['data']['code'], */
							'created_on' => TODAY,
							'builder_status' => PENDING_PAYMENT);
							$ub_builder_response = $this->Mod_builder->add_builder($form_data['builder_data']);

							if(TRUE === $ub_builder_response['status'])
							{
								// creating an array to add the builder details in ub_user table.
							  	$form_data['user_data'] = array(
								'builder_id' => $ub_builder_response['insert_id'],
								'username' => $result['data']['user_name'],
								'first_name' => $result['data']['first_name'],
								'last_name' => $result['data']['last_name'],
								'primary_email' => $result['data']['primary_email'],
								'mobile_isd_code' => $result['data']['mobile_isd_code'],
								'desk_phone' => $result['data']['desk_phone'],
								'address' => $result['data']['address1'].', '.$result['data']['address2'],
								'city' => $result['data']['city'],
								'province' => $result['data']['province'],
								'postal' => $result['data']['postal'],
								'country' => $result['data']['country'],
								'user_status' => 'Active',
								'login_enabled' => 'Yes',
								'account_type' => BUILDERADMIN,
								'role_id' => BUILDER_ADMIN_ROLE_ID,
								'created_on' => TODAY,
								'modified_on' => TODAY,
								'time_zone' => DEFAULT_USER_TIME_ZONE,
								'date_format' => DEFAULT_DATE_FORMAT
								);

								$ub_user_response = $this->Mod_user->add_user($form_data['user_data']);

								if(TRUE === $ub_user_response['status'])
								{
									$update_user_table = array(
										'ub_user_id' =>$ub_user_response['insert_id'],
										'created_by' =>$ub_user_response['insert_id'],
										'modified_by' =>$ub_user_response['insert_id']
									);
									$ub_user_update_response = $this->Mod_user->update_builder_user($update_user_table);
									// creating an array to add the builder details in ub_user_plan table.
									$form_data['user_plan_data'] = array(
									'builder_id' => $ub_builder_response['insert_id'],
									'user_id' => $ub_user_response['insert_id'],
									'status' => 'Active',
									'created_by' => $ub_user_response['insert_id'],
									'modified_by' => $ub_user_response['insert_id'],
									'created_on' => TODAY,
									// 'modified_on' => TODAY,
									'plan_id' => $result['data']['plan_id']);

									$ub_plan_response = $this->Mod_plan->add_user_plan($form_data['user_plan_data']);
									
									// creating an array to add the builder details in ub_builder_contract table.
									$date = TODAY;
									$date = strtotime($date);
									$date = strtotime("30 day", $date);
									$expiry_date = date('Y-m-d h:i:s', $date);
									 $form_data['builder_contract'] = array(
									'builder_id' => $ub_builder_response['insert_id'],
									'user_id' => $ub_user_response['insert_id'],
									'user_plan_id' => $result['data']['plan_id'],
									'start_date' => CURRENT_DATE,
									'expiry_date' => $expiry_date,
									'status' => NO_CONTRACT,
									'created_by' => $ub_user_response['insert_id'],
									'created_on' => TODAY,
									'modified_on' => TODAY,
									'modified_by' => $ub_user_response['insert_id']
									);
									$ub_builder_contract_response = $this->Mod_builder_contract->add_builder_contract($form_data['builder_contract']);

									if(TRUE === $ub_builder_contract_response['status'])
									{
										// process to update the contract no in ub_builder_contract table.
										$builder_contract_number = $this->Mod_builder_contract->generate_number_time('CON',BUILDER_CONTRACT_NUMBER_LENGTH,$ub_builder_contract_response['insert_id']);
										$builder_contract_update_array = array(
												'contract_number' => $builder_contract_number,
												'ub_builder_contract_id' => $ub_builder_contract_response['insert_id'],
												'modified_on' => TODAY,
												'modified_by' => $ub_user_response['insert_id']
												);
			            				$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
										
										// array to add the data in payment table.
							            $payment_details_array = array(
										    'builder_id' 			=> $ub_builder_response['insert_id'],
											'plan_id'  				=> $result['data']['plan_id'],
											'builder_contract_id'  	=> $ub_builder_contract_response['insert_id'],
											'payment_mode'	 		=> 'Credit Card',
											'payment_method'	 	=> 'ZEROPAY',
											'currency' 				=> 'USD',
											'payment_date' 			=> TODAY,
											'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
											'created_on' 			=> TODAY,
											'modified_on' 			=> TODAY,
											'payment_status' 		=> NO_PAYMENT,
											'created_by' 			=> $ub_user_response['insert_id'],
											'modified_by' 			=> $ub_user_response['insert_id']
										   );
										$payment_result = $this->Mod_payment->add_payment($payment_details_array);
										if (TRUE === $payment_result['status']) 
										{
										  /*payment code added by Devansh */
										  /** start */
										  /* FETCH PLAN DETAILS */
										  $plan_trial_occurrences = $this->Mod_plan->get_plan_details(array(
																'select_fields' => array('PLAN.trial_occurrences'),
																'where_clause' => array('PLAN.ub_plan_id' => $result['data']['plan_id'])
																 ));
											$plan_trial_occurrences = $plan_trial_occurrences['aaData'][0]['trial_occurrences'];
											if($plan_trial_occurrences == 0)
											{
												$payment_status = NO_PAYMENT;
											}else{
												$payment_status = SUCCESS_PAYMENT;
											}
								          $payment_array =  array(
								          	  'builder_id' => $ub_builder_response['insert_id'],
								          	  'builder_name' => $result['data']['builder_name'],
								          	  'payment_id' => $payment_result['insert_id'],
										      'firstName'=> $result['data']['first_name'],
											  'lastName'=> $result['data']['last_name'],
											  'primary_email' => $result['data']['primary_email'],
											  'desk_phone' => $result['data']['desk_phone'],
											  'contract_number' => $builder_contract_number,
											  'street1'=>  $result['data']['address1'].', '.$result['data']['address2'],
											  'city'=>    $result['data']['city'],
											  'state'=>   $result['data']['province'],
											  'postalCode' => $result['data']['postal'],
											  'country'=> $result['data']['country'],
											  'email'=>   $result['data']['primary_email'],
											  'ipaddress'=> $_SERVER['REMOTE_ADDR'],
											  'accountNumber'=> $result['data']['credit_card_number'],
											  'expirationMonth'=> $result['data']['expiry_month'],
											  'expirationYear'=> $result['data']['expiry_year'],
											  'cvNumber'=> $result['data']['code'],
											  'cardname'=> $result['data']['cardname'],
				                              'plan_id'=> $result['data']['plan_id'],
											  'description'		=> 'ZEROPAY');
										  
										 	$payment_response = $this->Mod_payment->make_payment($payment_array);

										 	$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$payment_result['insert_id']);	

										 //echo "<pre>";print_r($payment_response);exit;

											if (isset($payment_response['responce']['messages']['message']['code']) && $payment_response['responce']['messages']['message']['code'] == 'I00001')
											{
											 	// process to update the contract no in ub_payment table.
											 	$digits = substr(trim($payment_response['post']['subscription']['payment']['creditCard']['cardNumber']), -4);
											 	
											  	$update_payment_details_array = array(
												'payment_no' 			=> $payment_no,
									        	'payment_type' 			=> 'Received',
												'ub_payment_id' 		=> $payment_result['insert_id'],
												'modified_by' 			=> $ub_user_response['insert_id'],
								                'modified_on' 			=> TODAY,
												'builder_contract_id'  	=> $ub_builder_contract_response['insert_id'],
												'subscription_id'  		=> $payment_response['responce']['subscriptionId'],
												'reference_id'			=> $payment_response['responce']['refId'],
												/* 'amount' 				=> (isset($payment_response['post']['subscription']['trialAmount']) && $payment_response['post']['subscription']['paymentSchedule']['trialOccurrences'] > 0) ? $payment_response['post']['subscription']['trialAmount'] : $payment_response['post']['subscription']['amount'],  */
												'amount' =>0,
												'last_4digits'			=> $digits,
												'response_code' 		=> $payment_response['responce']['messages']['message']['code'], 
												'result_code' 			=>  $payment_response['responce']['messages']['resultCode'], 
												'result_text' 			=>  $payment_response['responce']['messages']['message']['text'],
												'payment_status' 		=> $payment_status
											   );
											  $payment_result = $this->Mod_payment->update_payment($update_payment_details_array);

											  // process to update the contract no in ub_builder table.
											  $membership_number = $this->Mod_builder->generate_number('UNI',BUILDER_MEMBERSHIP_NUMBER_LENGTH,$ub_builder_response['insert_id']);
											  $builder_update_array = array(
																'builder_status' => 'Active',
																'membership_number' => $membership_number,
																'ub_builder_id' => $ub_builder_response['insert_id'],
																'payment_status' => SUCCESS_PAYMENT,
																'created_by' => $ub_user_response['insert_id'],
												                'created_on' => TODAY,
																'modified_by' => $ub_user_response['insert_id'],
												                'modified_on' => TODAY
																);
								               $this->Mod_builder->update_builder($builder_update_array);

								               // process to update the contract no in ub_builder_contract table.
											   $builder_contract_update_array = array(
																'subscription_id' => $payment_response['responce']['subscriptionId'],
																'latest_payment_id' => $payment_result['insert_id'],
																'status' => ACTIVE_CONTRACT,
																'latest_payment_date' => TODAY,
																'payment_count' => 1,
																'ub_builder_contract_id' => $ub_builder_contract_response['insert_id'],
																'modified_on' => TODAY,
																'modified_by' => $ub_user_response['insert_id']
																);
								            	$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
												
												/** end */
						  
											 /* Folder creation code was added by chandru on 30-05-2015 */
												$builder_data = array(
													'builder_id' => $ub_builder_response['insert_id'], 
													'user_id'	=> $ub_user_response['insert_id'],
													'builder_name' => $result['data']['builder_name']
												);
												$result_array = $this->Mod_doc->create_builder_folder($builder_data);
												foreach ($result_array as $dir) {
													foreach ($dir as $folderpath) {
													   $response = $this->Mod_doc->create_dir(DOC_PATH.$folderpath);
													}
												}
												/* Folder creation code ends here */
												/* Builder mail template code starts here added by chandru 30-05-2015 */
												$where_condition = array('builder_id' => 0);
												$fetch_builder_mail_template = $this->Mod_builder_mail_template->get_builder_mail_template(array(	'select_fields' => array(),
													'where_clause' => $where_condition,
													'join'=> array('builder'=>'Yes')
													));
												$fetch_builder_mail_template_array = $fetch_builder_mail_template['aaData'];
												foreach($fetch_builder_mail_template_array as $key => $val)
												{
													array_shift($val);
													$val['builder_id'] = $ub_builder_response['insert_id'];
													$fetch_builder_mail_template = $this->Mod_builder_mail_template->add_builder_mail_template($val,$ub_user_response['insert_id']);
												}
												/* Builder mail template code ends here */
												/* Mail sending code was added by chandru */
												$where_clause = array('ub_user_id' => $ub_user_response['insert_id']);
												$get_all_users = array(
															'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as name','primary_email','username'),
															'where_clause' => $where_clause
															);
												$all_users = $this->Mod_user->get_users($get_all_users);
												$user_details = $all_users['aaData'][0];
												$responces = $this->Mod_user->user_email_invitation($user_details);
												$response['userid'] = $ub_user_response['insert_id'];
												$response['username'] = $result['data']['user_name'];
												$response['status'] = TRUE;
												$responce['comment'] = 'No';
												$response['message'] = 'Builder added successfully';
											}
											else
											{
												if (isset($payment_response['responce']['messages']['message']['code'])) 
												{
													$error_code_array = json_decode(PAYMENT_ERROR_CODE_ARRAY, true);
													$error_code = $payment_response['responce']['messages']['message']['code'];
													if (array_key_exists($error_code, $error_code_array)) 
													{
														$error_description = $error_code_array[$error_code];
													}
													else 
													{
													$error_description = 'Some untracted error occur while processing your request. Please try with correct details.';
													}
												}
												elseif (isset($payment_response['responce'][0]) && !empty($payment_response['responce'][0])) 
												{
													// Yhis block will work if the connection is failed with Authorixe.Net
													$error_description = $payment_response['responce'][0];
												}
											  	$update_payment_details_array = array(
												'payment_no' 			=> $payment_no,
									        	'payment_type' 			=> 'Failed',
												'ub_payment_id' 		=> $payment_result['insert_id'],
												'modified_by' 			=> $ub_user_response['insert_id'],
								                'modified_on' 			=> TODAY,
												'builder_contract_id'  	=> $ub_builder_contract_response['insert_id'],
												'amount' 				=> (isset($payment_response['post']['subscription']['trialAmount']) && $payment_response['post']['subscription']['paymentSchedule']['trialOccurrences'] > 0) ? $payment_response['post']['subscription']['trialAmount'] : $payment_response['post']['subscription']['amount'], 
												'response_code' 		=> (isset($payment_response['responce']['messages']['message']['code'])) ? $payment_response['responce']['messages']['message']['code'] : '', 
												'result_code' 			=> (isset($payment_response['responce']['messages']['resultCode'])) ? $payment_response['responce']['messages']['resultCode'] : '',
												'result_text' 			=> (isset($payment_response['responce']['messages']['message']['text'])) ? $payment_response['responce']['messages']['message']['text'] : $error_description,
												'payment_status' 		=> FAILD_PAYMENT
											   );
											  $payment_result = $this->Mod_payment->update_payment($update_payment_details_array);
											  
											  $payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$payment_result['insert_id']);
											  
												$response['status'] = FALSE;
												$response['redirect'] = FALSE;
												$response['message'] = $error_description;
											}
										}
										else
										{
											$response['status'] = FALSE;
											$response['redirect'] = FALSE;
											$response['message'] = 'Registration Failed';
										}
									}
									else
									{
										$response['status'] = FALSE;
										$response['redirect'] = FALSE;
										$response['message'] = 'Registration Failed';
									}
								}
								else
								{
									$response['status'] = FALSE;
									$response['redirect'] = FALSE;
									$response['message'] = 'Registration Failed';
								}
							}
							else
							{
								$response['status'] = FALSE;
								$response['redirect'] = FALSE;
								$response['message'] = 'Registration Failed';
							}
							$this->Mod_user->response($response);
							//echo "<pre>";print_r($ub_plan_response);exit;
						}
						else{
						   $response['status'] = FALSE;
							$response['message'] = 'Registration Failed: Username already exists. Please try with some other Username';
							$this->Mod_user->response($response);
						}					
						
					}
					else
					{
						$get_builder_id = $this->Mod_user->get_users(array(
												'select_fields' => array('USER.builder_id'),
												'where_clause' => array('USER.primary_email'=> $primary_email,'BUILDER.builder_status'=>PENDING_PAYMENT),
												'join'=> array('builder'=>'Yes')
												));
						//echo $verify_primary_email['status'];
						if ($get_builder_id['status'] == TRUE) 
						{
							$builder_id = $get_builder_id['aaData']['0']['builder_id'];
							$where_array =  array('USER.builder_id'=>$builder_id, 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

							$sort_type = 'ASC';
							$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
							$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
							$builder_details_array = $this->Mod_builder->get_builder_details(array(
																	'select_fields' => array('USER.first_name','USER.last_name','USER.username','USER.ub_user_id','BUILDER_DETAILS.ub_builder_id','BUILDER_DETAILS.current_plan_id','BUILDER_DETAILS.builder_name','USER.primary_email','USER.desk_phone',
																	'USER.address','USER.city','USER.province','USER.primary_email',
																	'USER.postal','USER.country'),
																	'join'=> array('user'=>'yes'),
																	'where_clause' => $where_array,
																	'order_clause' => $order_by_where
																	));	

							$builder_detail = $builder_details_array['aaData']['0'];

							$where_condition = array('builder_id' => $builder_id);
							$builder_contract_detail = $this->Mod_builder_contract->get_builder_contract_details(array(	'select_fields' => array('ub_builder_contract_id','contract_number'),
								'where_clause' => $where_condition
								));
							if (isset($builder_contract_detail['aaData']['0']) && !empty($builder_contract_detail['aaData']['0'])) 
							{
								$contract_detail_array = $builder_contract_detail['aaData']['0'];
							}
							else
							{
								// creating an array to add the builder details in ub_builder_contract table for builder created by Uniadmin.
									$date = TODAY;
									$date = strtotime($date);
									$date = strtotime("30 day", $date);
									$expiry_date = date('Y-m-d h:i:s', $date);
									 $form_data['builder_contract'] = array(
									'builder_id' => $builder_id,
									'user_id' => $builder_detail['ub_user_id'],
									'user_plan_id' => $builder_detail['current_plan_id'],
									'start_date' => CURRENT_DATE,
									'expiry_date' => $expiry_date,
									'status' => NO_CONTRACT,
									'created_by' => $builder_detail['ub_user_id'],
									'created_on' => TODAY,
									'modified_on' => TODAY,
									'modified_by' => $builder_detail['ub_user_id']
									);
									$ub_builder_contract_response = $this->Mod_builder_contract->add_builder_contract($form_data['builder_contract']);
									if(TRUE === $ub_builder_contract_response['status'])
									{
										$builder_contract_number = $this->Mod_builder_contract->generate_number_time('CON',BUILDER_CONTRACT_NUMBER_LENGTH,$ub_builder_contract_response['insert_id']);
										$builder_contract_update_array = array(
												'contract_number' => $builder_contract_number,
												'ub_builder_contract_id' => $ub_builder_contract_response['insert_id'],
												'modified_on' => TODAY,
												'modified_by' => $builder_detail['ub_user_id']
												);
			            				$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);

										$contract_detail_array['ub_builder_contract_id'] = $ub_builder_contract_response['insert_id'];
										$contract_detail_array['contract_number'] = $builder_contract_number;
									}
							}

							$payment_details_array = array(
								    'builder_id' 			=> $builder_id,
									'plan_id'  				=> $builder_detail['current_plan_id'],
									'builder_contract_id'  	=> $contract_detail_array['contract_number'],
									'payment_mode'	 		=> 'Credit Card',
									'payment_method'	 	=> 'ZEROPAY',
									'currency' 				=> 'USD',
									'payment_date' 			=> TODAY,
									'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
									'created_on' 			=> TODAY,
									'payment_status' 		=> NO_PAYMENT,
									'created_by' 			=> $builder_detail['ub_user_id'],
									'modified_by' 			=> $builder_detail['ub_user_id'],
									'modified_on' 			=> TODAY
								   );
								$payment_result = $this->Mod_payment->add_payment($payment_details_array);

							if (TRUE === $payment_result['status']) 
							{
								/* FETCH PLAN DETAILS */
							  $plan_trial_occurrences = $this->Mod_plan->get_plan_details(array(
													'select_fields' => array('PLAN.trial_occurrences'),
													'where_clause' => array('PLAN.ub_plan_id' => $builder_detail['current_plan_id'])
													 ));
								$plan_trial_occurrences = $plan_trial_occurrences['aaData'][0]['trial_occurrences'];
								if($plan_trial_occurrences == 0)
								{
									$payment_status = NO_PAYMENT;
								}else{
									$payment_status = SUCCESS_PAYMENT;
								}
								$payment_array =  array(
					          	  'builder_id' 		=> $builder_id,
					          	  'builder_name'	=> $builder_detail['builder_name'],
							      'firstName'		=> $builder_detail['first_name'],
					          	  'payment_id' 		=> $payment_result['insert_id'],
								  'lastName'		=> $builder_detail['last_name'],
								  'primary_email' 	=> $builder_detail['primary_email'],
								  'desk_phone' 		=> $builder_detail['desk_phone'],
								  'contract_number' => $contract_detail_array['contract_number'],
								  'street1'			=> $builder_detail['address'],
								  'city'			=> $builder_detail['city'],
								  'state'			=> $builder_detail['province'],
								  'postalCode' 		=> $builder_detail['postal'],
								  'country'			=> $builder_detail['country'],
								  'email'			=> $builder_detail['primary_email'],
								  'ipaddress'		=> $_SERVER['REMOTE_ADDR'],
								  'accountNumber'	=> $result['data']['credit_card_number'],
								  'expirationMonth'	=> $result['data']['expiry_month'],
								  'expirationYear'	=> $result['data']['expiry_year'],
								  'cvNumber'		=> $result['data']['code'],
								  'cardname'		=> $result['data']['cardname'],
	                              'plan_id'			=> $builder_detail['current_plan_id'],
								  'description'		=> 'ZEROPAY');
							 	$payment_response = $this->Mod_payment->make_payment($payment_array);

								$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$payment_result['insert_id']);	

							 	if (isset($payment_response['responce']['messages']['message']['code']) && $payment_response['responce']['messages']['message']['code'] == 'I00001')
								{
								 	// process to update the contract no in ub_payment table.
								 	$digits = substr(trim($payment_response['post']['subscription']['payment']['creditCard']['cardNumber']), -4);
								 	
								  	$update_payment_details_array = array(
									'payment_no' 			=> $payment_no,
						        	'payment_type' 			=> 'Received',
									'ub_payment_id' 		=> $payment_result['insert_id'],
									'modified_by' 			=> $builder_detail['ub_user_id'],
					                'modified_on' 			=> TODAY,
									'builder_contract_id'  	=> $contract_detail_array['ub_builder_contract_id'],
									'subscription_id'  		=> $payment_response['responce']['subscriptionId'],
									'reference_id'			=> $payment_response['responce']['refId'],
									'amount' 				=> (isset($payment_response['post']['subscription']['trialAmount']) && $payment_response['post']['subscription']['paymentSchedule']['trialOccurrences'] > 0) ? $payment_response['post']['subscription']['trialAmount'] : $payment_response['post']['subscription']['amount'],  
									'last_4digits'			=> $digits,
									'response_code' 		=> $payment_response['responce']['messages']['message']['code'], 
									'result_code' 			=>  $payment_response['responce']['messages']['resultCode'], 
									'result_text' 			=>  $payment_response['responce']['messages']['message']['text'],
									'payment_status' 		=> $payment_status
								   );
								  $payment_result = $this->Mod_payment->update_payment($update_payment_details_array);

								  // process to update the contract no in ub_builder table.
								  $membership_number = $this->Mod_builder->generate_number('UNI',BUILDER_MEMBERSHIP_NUMBER_LENGTH,$builder_id);

								  $builder_update_array = array(
													'builder_status' => 'Active',
													'membership_number' => $membership_number,
													'ub_builder_id' => $builder_id,
													'payment_status' => SUCCESS_PAYMENT,
													'modified_by' => $builder_detail['ub_user_id'],
									                'modified_on' => TODAY
													);
					               $this->Mod_builder->update_builder($builder_update_array);

					               // process to update the contract no in ub_builder_contract table.
								   $builder_contract_update_array = array(
													'subscription_id' => $payment_response['responce']['subscriptionId'],
													'latest_payment_id' => $payment_result['insert_id'],
													'status' => ACTIVE_CONTRACT,
													'latest_payment_date' => TODAY,
													'payment_count' => 1,
													'ub_builder_contract_id' => $contract_detail_array['ub_builder_contract_id'],
													'modified_by' => $builder_detail['ub_user_id'],
									                'modified_on' => TODAY
													);
					            	$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
									
									/** end */
			  
								 /* Folder creation code was added by chandru on 30-05-2015 */
									$builder_data = array(
										'builder_id' => $builder_id, 
										'user_id'	=> $builder_detail['ub_user_id'],
										'builder_name' => $builder_detail['builder_name']
									);
									$result_array = $this->Mod_doc->create_builder_folder($builder_data);
									foreach ($result_array as $dir) {
										foreach ($dir as $folderpath) {
										   $response = $this->Mod_doc->create_dir(DOC_PATH.$folderpath);
										}
									}
									/* Folder creation code ends here */
									/* Builder mail template code starts here added by chandru 30-05-2015 */
									$where_condition = array('builder_id' => 0);
									$fetch_builder_mail_template = $this->Mod_builder_mail_template->get_builder_mail_template(array(	'select_fields' => array(),
										'where_clause' => $where_condition,
										'join'=> array('builder'=>'Yes')
										));
									$fetch_builder_mail_template_array = $fetch_builder_mail_template['aaData'];
									foreach($fetch_builder_mail_template_array as $key => $val)
									{
										array_shift($val);
										$val['builder_id'] = $builder_id;
										$fetch_builder_mail_template = $this->Mod_builder_mail_template->add_builder_mail_template($val,$builder_detail['ub_user_id']);
									}
									/* Builder mail template code ends here */
									/* Mail sending code was added by chandru */
									$where_clause = array('ub_user_id' => $builder_detail['ub_user_id']);
									$get_all_users = array(
												'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as name','primary_email','username'),
												'where_clause' => $where_clause
												);
									$all_users = $this->Mod_user->get_users($get_all_users);
									$user_details = $all_users['aaData'][0];
									$responces = $this->Mod_user->user_email_invitation($user_details);
									$response['userid'] = $builder_detail['ub_user_id'];
									$response['username'] = $builder_detail['username'];
									$response['status'] = TRUE;
									$responce['comment'] = 'No';
									$response['message'] = 'Builder added successfully';
								}
								else
								{
									//echo "<pre>";print_r($payment_response);
									if (isset($payment_response['responce']['messages']['message']['code'])) 
									{
										$error_code_array = json_decode(PAYMENT_ERROR_CODE_ARRAY, true);
										$error_code = $payment_response['responce']['messages']['message']['code'];
										//print_r($error_code_array);exit;
										if (array_key_exists($error_code, $error_code_array)) 
										{
											$error_description = $error_code_array[$error_code];
										}
										else 
										{
										$error_description = 'Some untracted error occur while processing your request. Please try with correct details.';
										}
									}
									elseif (isset($payment_response['responce'][0]) && !empty($payment_response['responce'][0])) 
									{
										// This block will work if the connection is failed with Authorixe.Net
										$error_description = $payment_response['responce'][0];
									}
								  	$update_payment_details_array = array(
									'payment_no' 			=> $payment_no,
						        	'payment_type' 			=> 'Failed',
									'ub_payment_id' 		=> $payment_result['insert_id'],
									'modified_by' 			=> $builder_detail['ub_user_id'],
					                'modified_on' 			=> TODAY,
									'builder_contract_id'  	=> $contract_detail_array['contract_number'],
									'amount' 				=> (isset($payment_response['post']['subscription']['trialAmount']) && $payment_response['post']['subscription']['paymentSchedule']['trialOccurrences'] > 0) ? $payment_response['post']['subscription']['trialAmount'] : $payment_response['post']['subscription']['amount'],  
									'response_code' 		=> (isset($payment_response['responce']['messages']['message']['code'])) ? $payment_response['responce']['messages']['message']['code'] : '', 
									'result_code' 			=> (isset($payment_response['responce']['messages']['resultCode'])) ? $payment_response['responce']['messages']['resultCode'] : '',
									'result_text' 			=> (isset($payment_response['responce']['messages']['message']['text'])) ? $payment_response['responce']['messages']['message']['text'] : $error_description,
									'payment_status' 		=> FAILD_PAYMENT
								   );
								  $payment_result = $this->Mod_payment->update_payment($update_payment_details_array);
								  
									$response['status'] = FALSE;
									$response['message'] = $error_description;
								}
								$this->Mod_user->response($response);
							}
						}
						else
						{
							$response['status'] = FALSE;
							$response['message'] = 'Registration Failed: Email id already exists. Please try with some other email id';
							$this->Mod_user->response($response);
						}
					}
				}
				else
				{
					$response['status'] = FALSE;
					$response['message'] = 'Registration Failed: The email field is empty';
					$this->Mod_user->response($response);
				}
				}
			}	
			else
			{
				$this->Mod_role->response($result);
			}
		}
		$this->template->view($data);
    }
    /** 
	* Check unique email
	* 
	* @method: unique_email 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	*/	
	public function unique_email()
	{		
		if(!empty($this->input->post()))
		{
		  $result = $this->sanitize_input();
		  if(TRUE === $result['status'])
		  {
		  	 $response = $this->Mod_builder->get_valid_email($result['data']);
			 $this->Mod_builder->response($response);
		  }
		}
	}

    /** 
	* Check Builder Status
	* 
	* @method: unique_email 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	*/	
	public function check_builder_status()
	{		
		if(!empty($this->input->post()))
		{
		  $result = $this->sanitize_input();
		  if(TRUE === $result['status'])
		  {
		  	$primary_email = $result['data']['primary_email'];
		  	$get_builder_id = $this->Mod_user->get_users(array(
												'select_fields' => array('USER.builder_id'),
												'where_clause' => array('USER.primary_email'=> $primary_email,'BUILDER.payment_status'=>PENDING_PAYMENT),
												'join'=> array('builder'=>'Yes')
												));
						//echo $verify_primary_email['status'];
						if ($get_builder_id['status'] == TRUE) 
						{
							$builder_id = $get_builder_id['aaData']['0']['builder_id'];
							$where_array =  array('USER.builder_id'=>$builder_id, 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

							$sort_type = 'ASC';
							$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
							$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
							$builder_details_array = $this->Mod_builder->get_builder_details(array(
																	'select_fields' => array('USER.first_name','USER.last_name','USER.username','USER.ub_user_id','BUILDER_DETAILS.ub_builder_id','BUILDER_DETAILS.current_plan_id','BUILDER_DETAILS.builder_name','USER.primary_email','USER.desk_phone',
																	'USER.address','USER.city','USER.province','USER.primary_email',
																	'USER.postal','USER.country'),
																	'join'=> array('user'=>'yes'),
																	'where_clause' => $where_array,
																	'order_clause' => $order_by_where
																	));	

							$builder_detail = $builder_details_array['aaData']['0'];
							$response['builder_detail'] = $builder_detail;
							$response['status'] = TRUE;
							$response['message'] = 'We have your details with us, you can directly proceed for payment.';
							// echo '<pre>';print_r($response);exit;
							$this->Mod_user->response($response);
						}
		  }
		}
	}

	/** 
	* function to send email to builder with login link.
	* 
	* @method: builderuser_email_invitation 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	*/
	function builderuser_email_invitation()
	{
		$post_array = $this->sanitize_input();
		if(TRUE === $post_array['status'])
		{
			/* Below line was modified by chandru based on sidhartha instruction 30-05-2015 */
			$response = $this->Mod_user->user_email_invitation($post_array['data']);
		}
		else
		{
			$response['status'] = $post_array['status'];
			$response['message'] = $post_array['message'];
		}
		$this->Mod_user->response($response);
	}

	//New codes

	/** 
	* signup_index function
	* 
	* @method: signup_index 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL2luZgxf1V4Lw--
	*/	
	public function signup_index($ub_user_id = '',$builder_name = '')
	{	
		if( $ub_user_id != '' )
		{
			$post_array = array('ub_user_id' => $ub_user_id, 'active_till >= ' => TODAY);
			// Fetch Data all records based on conditions
			$result_data = $this->Mod_user->get_users(array(
				'where_clause' => $post_array
				));
			if( TRUE === $result_data['status'])
			{
				 $data = array(
				'title'        => "Signup",		
				'content'      => 'content/signup/signup',
				'accept'	   =>'accept',
				'ub_user_id' =>$ub_user_id,
				'builder_name' =>$builder_name
						
				);							
				$this->load->view('content/signup/signup',$data);
				
			}
			else
			{
				 $data = array(
				'title'        => "UNIBUILDER",		
				'content'      => 'content/signup/signup',
				'decline'  =>'decline'						
				);
				$this->load->view('content/login/login',$data);
				
			}
		}
		else
		{
		  $this->load->view('content/login/login');
		  $response['status'] = FALSE;
		}
		
	}
	/** 
	* Accept Invite
	* 
	* @method: accept_invite 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL2FjY2VwdF9pbnZpdgxf1Uv
	*/	
	public function accept_invite($ub_user_id = '', $username = '')
	{	
		$data = array(
				'title'        => "Signup",		
				'content'      => 'content/signup/accept',
				'accept'	   =>'accept',
				'ub_user_id' =>$ub_user_id,
				'username'  => $username
				);
		if($ub_user_id != '')
		{
			
			if(!empty($this->input->post()))
		    {
			  $result = $this->sanitize_input();
			  $password =  $this->Mod_user->encrypt_password($result['data']['password']);
			  $confirm_password =  $this->Mod_user->encrypt_password($result['data']['confirm_password']);
			  if(TRUE === $password['status'])
			  {
				$password = $password['encrypt_password'];
			  }
			  else
			  {
				$password = '';
			  }
			  if(TRUE === $confirm_password['status'])
			  {
				$confirm_password = $confirm_password['encrypt_password'];
			  }
			  else
			  {
				$confirm_password = '';
			  }
			  $insert_array = array(
			  	'system_provided_user_name' => $result['data']['system_provided_user_name'],
			  	'ub_user_id' =>   $result['data']['ub_user_id'],
			  	'username' =>   $result['data']['userName'],
			  	'password' =>   $password,
			  	'confirm_password' =>   $confirm_password,
			  	);
			  $response = $this->Mod_signup->update_user($insert_array);
			  $this->Mod_signup->response($response);
			}
								
		}
		
		$this->load->view('content/signup/accept',$data);
	}
	/** 
	* Reject Invite
	* 
	* @method: reject_invite 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL3JlamVjdF9pbnZpdgxf1Uv
	*/	
	public function reject_invite()
	{		
		$this->load->view('content/signup/reject');
	}
	/** 
	* Check unique user
	* 
	* @method: reject_invite 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* encoded url :c2lnbnVwL3JlamVjdF9pbnZpdgxf1Uv
	*/	
	public function unique_user()
	{		
		if(!empty($this->input->post()))
		{
		  $result = $this->sanitize_input();
		  if(TRUE === $result['status'])
		  {
		  	 $response = $this->Mod_signup->get_valid_user($result['data']);
			 $this->Mod_signup->response($response);
		  }

		}
	}
	
	/* Register redirect function created by chandru*/
	public function register_redirect($user_id)
	{
		$data = array(
		'title'        => 'Register',		
		'content'      => 'content/register/register_success_messsage',
        'page_id'      => 'Register',
		'user_id'      => $user_id
		);
		$this->load->view('content/register/register_success_messsage', $data);
	}
	
	public function resend_email_invitation()
	{
		if(!empty($this->input->post()))
		{	
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				//Fetch all the users
				$where_clause = array('ub_user_id' => $result['data']['userid']);
				$get_all_users = array(
										'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as name','primary_email','username'),
										'where_clause' => $where_clause
										);
				$all_users = $this->Mod_user->get_users($get_all_users);
				$user_details = $all_users['aaData'][0];
				$responce = $this->Mod_user->user_email_invitation($user_details);
				$this->Mod_task->response($responce);
			}
		}
	}
	
	/* Scheduler code added by chandru 10-08-2015 */
	/* URL: cmVnaXN0ZXIvZ2V0X2Jhdgxf1NoX2xpc3Qv */
	function get_batch_list( )
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		/* firstSettlementDate and lastSettlementDate NEED clarifications */
		echo '<h1>Get Settlement</h1>';
		
		// Start with a get_settlement object
		$this->authorize_arb->startData('get_settlement');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		// $this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're cancelling
		$this->authorize_arb->addData('firstSettlementDate', '2015-07-01T16:00:00Z');
		$this->authorize_arb->addData('lastSettlementDate', '2015-07-30T16:00:00Z');
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
		$responce_array = $this->authorize_arb->getResponse();
		// echo '<pre>';print_r($responce_array['batchList']['batch']);
		foreach($responce_array['batchList']['batch'] as $key=>$value)
		{
			$responce = $this->requiring_payment_process($value['batchId']);
			echo '<pre>';print_r($responce);exit;
		}
	}
	
	/* Below function was call from scheduler added by chandru 11-08-2015 */
	/* URL:cmVnaXN0ZXIvcmVxdWlyaW5nX3BheW1lbnRfcHJvY2Vzcy8- */
	function requiring_payment_process($batch_id)
	{	
		$this->load->library('authorize_arb');
		$this->authorize_arb->startData('get_transaction');
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('batchId', $batch_id);
		// $this->authorize_arb->addData('batchId', '2788337');
		
		// Send request
		/* Need to Remove Below condition  */
		if( $this->authorize_arb->send() )
		{
		}
		else
		{
		}
		$response_array = $this->authorize_arb->getResponse();
		/* If positive result from gateway */
		if(isset($response_array['messages']['message']['text']) && $response_array['messages']['message']['text'] == 'Successful.')
		{
			/* From previous entry get the details */
			$previous_subscription_details = $this->Mod_payment->get_payment_details(array(
												'select_fields' => array(),
												'where_clause' => array('subscription_id'=>$response_array['transactions']['transaction']['subscription']['id']),
												));
			if(TRUE == $previous_subscription_details['status'])
			{
			$previous_subscription_array = end($previous_subscription_details['aaData']);
			$insert_payment['builder_id'] = $previous_subscription_array['builder_id'];
			$insert_payment['builder_contract_id'] = $previous_subscription_array['builder_contract_id'];
			$insert_payment['subscription_id'] = $response_array['transactions']['transaction']['subscription']['id'];
			$insert_payment['plan_id'] = $previous_subscription_array['plan_id'];
			$insert_payment['payment_type'] = $previous_subscription_array['payment_type'];
			$insert_payment['payment_mode'] = $previous_subscription_array['payment_mode'];
			$insert_payment['response_code'] = $response_array['messages']['message']['code'];
			$insert_payment['result_code'] = $response_array['messages']['resultCode'];
			$insert_payment['currency'] = $previous_subscription_array['currency'];
			$insert_payment['amount'] = $response_array['transactions']['transaction']['settleAmount'];
			$insert_payment['payment_date_time'] = TODAY;
			$insert_payment['payment_status'] = $previous_subscription_array['payment_status'];
			$insert_payment['last_4digits'] = $previous_subscription_array['last_4digits'];
			$insert_payment['created_on'] = TODAY;
			$insert_payment['modified_on'] = TODAY;
			/* Insert in payment table */
			$insert_payment_response = $this->Mod_payment->add_payment($insert_payment);
				if(TRUE == $insert_payment_response['status'])
				{
					$payment_insert_id = $insert_payment_response['insert_id'];
					$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$insert_payment_response['insert_id']);	
					/* Update Payment table for payment_number */
					$payment_update_array = array(
									'payment_no' => $payment_no,
									'ub_payment_id' => $payment_insert_id,
									'modified_on' => TODAY
									);
					/* Update in payment table */
				   $update_payment_response = $this->Mod_payment->update_payment($payment_update_array);
				   if(TRUE == $update_payment_response['status'])
				   {
						/* Update Contract table */
						$builder_contract_update_array = array(
								'subscription_id' => $response_array['transactions']['transaction']['subscription']['id'],
								'latest_payment_id' => $payment_insert_id,
								'payment_count' => $response_array['transactions']['transaction']['subscription']['payNum'],
								'latest_payment_date' => TODAY,
								'modified_on' => TODAY
								);
						$update_builder_contract_response = $this->Mod_builder_contract->update_builder_contract_table($builder_contract_update_array);
						if(TRUE == $update_builder_contract_response['status'])
						{
							$address_response = $this->Mod_user->get_users(array(
												'select_fields' => array('address','city','province','country','postal','mobile_phone'),
												'where_clause' => array('builder_id'=>$previous_subscription_array['builder_id'],'role_id'=>BUILDER_ADMIN_ROLE_ID)
												));
							$address_array = $address_response['aaData'][0];
							$plan_response = $this->Mod_plan->get_plan_details(array(
												'select_fields' => array('plan_name','plan_code'),
												'where_clause' => array('ub_plan_id'=>$previous_subscription_array['plan_id'])
												));
							$plan_array = $plan_response['aaData'][0];
							$invoice_from_date = date('Y-m-d');
							$invoice_to_date = date('Y-m-d', strtotime("+30 days"));
							$invoice_array = array(
						                    'builder_id' => $previous_subscription_array['builder_id'],
											'subscription_id' => $response_array['transactions']['transaction']['subscription']['id'],
											'payment_id' => $payment_insert_id,
											'user_plan_id' => $previous_subscription_array['plan_id'],
											'plan_number' => $plan_array['plan_name'],
											'plan_description' => $plan_array['plan_code'],
											'invoice_from_date' => $invoice_from_date,
											'invoice_to_date' => $invoice_to_date,
											'invoice_amount' => $response_array['transactions']['transaction']['settleAmount'],
											'invoice_status' => 'Active',
											'address' => $address_array['address'],
											'city' => $address_array['city'],
											'province' => $address_array['province'],
											'country' => $address_array['country'],
											'pincode' => $address_array['postal'],
											'phone_number' => $address_array['mobile_phone'],
											'created_on' => TODAY,
											'modified_on' => TODAY
											);
							/* Insert in Invoice table */
						  $insert_invoice_response = $this->Mod_invoice->add_invoice($invoice_array);
						  if(TRUE == $insert_invoice_response['status'])
						  {
							$invoice_no = $this->Mod_builder->generate_number(INVOICE_NAME_FORMAT,INVOICE_NUMBER_LENGTH,$insert_invoice_response['insert_id']);
							$invoice_update_array = array(
											'invoice_no' => $invoice_no,
											'ub_invoice_id' => $insert_invoice_response['insert_id'],
							                'modified_on' => TODAY
											);
							/* Update in Invoice table */
			               $update_invoice_response = $this->Mod_invoice->update_invoice($invoice_update_array);
						   echo '<pre>';print_r($update_invoice_response);exit;
						  }
						}
				   }
				}
			}
		}
		else{
			echo 'Payment was not happened.';
		}
	}
	
	/* Second method for getting response from Authorized.net added by chandru 17-08-2015 */
	/* SILENT POST */
	/* URL: cmVnaXN0ZXIvc2lsZW50X3Bvc3RfYXJyYXkv */
	public function silent_post_array()
	{
		
		/* echo "<br>decrypt---> ".$abc = $this->crypt->encrypt('register/authorized_net_silent_post_url/');
		echo "<br>encrypt---> ". $this->crypt->decrypt($abc);exit;  */
		$silent_post_array = array(
				'x_response_code' => '1',
				'x_response_reason_text' => 'Successful.',
				'x_trans_id' => '77777777777',
				'x_amount' => '59',
				'x_method' => 'CC',
				'x_cust_id' => '17234',
				'x_subscription_id' => '2917508',
				// 'x_description' => 'ZEROPAY',
				'x_subscription_paynum' => '2'
				);
		$silent_post_response = $this->authorized_net_silent_post_url();
	}
	public function authorized_net_silent_post_url()
	{
		/* echo '<pre>';print_r($_POST);exit; */
		/* IF A TRANSACTION IS APPROVED X_RESPONSE_CODE WILL CONTAIN A VALUE OF 1.  */
		
		/* If the card is declined x_response_code will contain a value of 2.  */
		
		/* If there was an error the card is expired x_response_code will contain a value of 3. Expired credit cards will have this response code and x_response_reason_code will contain a value of 8.  */
		
		/* If the transaction is held for review x_response_code will contain a value of 4. */
		
		/* x_subscription_paynum starts at 1 for the first payment, 2 for the second payment  */
		// echo '<pre>';print_r($silent_post_array);exit;
		/* From previous entry get the details */
		if(isset($_POST) && !empty($_POST))
		{
			$silent_post_array = array();
			$silent_post_array = $_POST;
			$sort_type = 'DESC LIMIT 1';
			$order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
			$previous_subscription_details = $this->Mod_payment->get_payment_details(array(
												'select_fields' => array(),
												'where_clause' => array('subscription_id'=>$silent_post_array['x_subscription_id']),
												'order_clause' => $order_by_where
												));
			if(TRUE == $previous_subscription_details['status'])
			{
			$previous_subscription_array = $previous_subscription_details['aaData'][0];
			/* Inserting in builder contract table */
			/* Below add builder code was commented by chandru 30-09-2015 */
			/* $builder_contract = array(
				'subscription_id' => $silent_post_array['x_subscription_id'],
				'builder_id' => $previous_subscription_array['builder_id'],
				'user_id' => $previous_subscription_array['created_by'],
				'user_plan_id' => $previous_subscription_array['plan_id'],
				'start_date' => CURRENT_DATE,
				'created_by' => $previous_subscription_array['created_by'],
				'created_on' => TODAY
				);
			$ub_builder_contract_response = $this->Mod_builder_contract->add_builder_contract($builder_contract); */
			/* Insert in payment table */
			if($silent_post_array['x_response_code'] == 1)
			{
				$payment_status = SUCCESS_PAYMENT;
			}else
			{
				$payment_status = FAILD_PAYMENT;
			}
			
			$insert_payment['builder_id'] = $previous_subscription_array['builder_id'];
			$insert_payment['builder_contract_id'] = $previous_subscription_array['builder_contract_id'];
			$insert_payment['subscription_id'] = $silent_post_array['x_subscription_id'];
			$insert_payment['plan_id'] = $previous_subscription_array['plan_id'];
			$insert_payment['transaction_id'] = $silent_post_array['x_trans_id'];
			$insert_payment['payment_type'] = $previous_subscription_array['payment_type'];
			$insert_payment['payment_mode'] = $previous_subscription_array['payment_mode'];
			$insert_payment['response_code'] = $silent_post_array['x_response_code'];
			/* Saving response reason text in result code */
			$insert_payment['result_text'] = $silent_post_array['x_response_reason_text'];
			$insert_payment['currency'] = $previous_subscription_array['currency'];
			$insert_payment['amount'] = $silent_post_array['x_amount'];
			$insert_payment['payment_date'] = TODAY;
			$insert_payment['payment_status'] = $payment_status;
			//$insert_payment['payment_method'] = (isset($silent_post_array['x_description']) && !empty($silent_post_array['x_description']))?$silent_post_array['x_description']:'ARB';
			$insert_payment['payment_method'] = 'ARB';
			$insert_payment['last_4digits'] = $previous_subscription_array['last_4digits'];
			$insert_payment['created_by'] = $previous_subscription_array['created_by'];
			$insert_payment['created_on'] = TODAY;
			$insert_payment['modified_on'] = TODAY;
			// echo '<pre>';print_r($insert_payment);exit;
			/* Insert in payment table */
			// echo '<pre>';print_r($insert_payment);exit;
				
				$insert_payment_response['status'] = '';
				if($silent_post_array['x_description'] == 'ARB' || $silent_post_array['x_description'] == 'ZEROPAY')
				{
					if($previous_subscription_array['payment_status'] == NO_PAYMENT)
					{
						/* Update payment based on subscription id */
						$update_payment_array = array(
								'subscription_id'=>$silent_post_array['x_subscription_id'],
								'ub_payment_id'=>$previous_subscription_array['ub_payment_id'],
								'amount'=>$silent_post_array['x_amount'],
								'payment_status'=>$payment_status,
								'payment_method'=>'ARB',
								'payment_date'=>TODAY,
								'modified_on'=>TODAY
								);
						$insert_payment_response = $this->Mod_payment->update_payment($update_payment_array);
						$insert_payment_response['insert_id'] = $previous_subscription_array['ub_payment_id'];
					}else{
						$insert_payment_response = $this->Mod_payment->add_payment($insert_payment);
					}
				}
				/* Silent post success responce code */
				if($silent_post_array['x_response_code'] == 1)
				{
				if(TRUE == $insert_payment_response['status'])
					{
						$payment_insert_id = $insert_payment_response['insert_id'];
						$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$insert_payment_response['insert_id']);	
						/* Update Payment table for payment_number */
						$payment_update_array = array(
										'payment_no' => $payment_no,
										'transaction_id' => $silent_post_array['x_trans_id'],
										'ub_payment_id' => $payment_insert_id,
										'modified_on' => TODAY
										);
						/* Update in payment table */
					   $update_payment_response = $this->Mod_payment->update_payment($payment_update_array);
					   if(TRUE == $update_payment_response['status'])
					   {
							/* Update Contract table */
							$date = TODAY;
							$date = strtotime($date);
							$date = strtotime("30 day", $date);
							$expiry_date = date('Y-m-d h:i:s', $date);
							$builder_contract_update_array = array(
									'subscription_id' => $silent_post_array['x_subscription_id'],
									'latest_payment_id' => $payment_insert_id,
									'expiry_date' => $expiry_date,
									'payment_count' => $silent_post_array['x_subscription_paynum'],
									'latest_payment_date' => TODAY,
									'modified_on' => TODAY
									);
							$update_builder_contract_response = $this->Mod_builder_contract->update_builder_contract_table($builder_contract_update_array);
							if(TRUE == $update_builder_contract_response['status'])
							{
								$address_response = $this->Mod_user->get_users(array(
													'select_fields' => array('address','city','province','country','postal','mobile_phone','desk_phone'),
													'where_clause' => array('builder_id'=>$previous_subscription_array['builder_id'],'role_id'=>BUILDER_ADMIN_ROLE_ID)
													));
								$address_array = $address_response['aaData'][0];
								$plan_response = $this->Mod_plan->get_plan_details(array(
													'select_fields' => array('plan_name','plan_code','plan_amount','plan_length','no_of_projects','no_of_users'),
													'where_clause' => array('ub_plan_id'=>$previous_subscription_array['plan_id'])
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
								$invoice_from_date = date('Y-m-d');
								$invoice_to_date = date('Y-m-d', strtotime("+30 days"));
								$invoice_array = array(
												'builder_id' => $previous_subscription_array['builder_id'],
												'subscription_id' => $silent_post_array['x_subscription_id'],
												'transaction_id' => $silent_post_array['x_trans_id'],
												'payment_id' => $payment_insert_id,
												'user_plan_id' => $previous_subscription_array['plan_id'],
												'plan_name' => $plan_array['plan_name'],
												'plan_description' => $plan_description,
												'invoice_from_date' => $invoice_from_date,
												'invoice_to_date' => $invoice_to_date,
												'invoice_amount' => $silent_post_array['x_amount'],
												'invoice_status' => 'Active',
												'address' => $address_array['address'],
												'city' => $address_array['city'],
												'province' => $address_array['province'],
												'country' => $address_array['country'],
												'pincode' => $address_array['postal'],
												'phone_number' => $address_array['desk_phone'],
												'created_on' => TODAY,
												'created_by' => $previous_subscription_array['created_by']
												);
								/* Insert in Invoice table */
							  $insert_invoice_response = $this->Mod_invoice->add_invoice($invoice_array);
							  if(TRUE == $insert_invoice_response['status'])
							  {
								$invoice_no = $this->Mod_builder->generate_number(INVOICE_NAME_FORMAT,INVOICE_NUMBER_LENGTH,$insert_invoice_response['insert_id']);
								$invoice_update_array = array(
												'invoice_no' => $invoice_no,
												'ub_invoice_id' => $insert_invoice_response['insert_id']
												);
								/* Update in Invoice table */
							   $update_invoice_response = $this->Mod_invoice->update_invoice($invoice_update_array);
							   echo '<pre>';print_r($update_invoice_response);exit;
							  }
							}
					   }
					}
				}
			}
		}
		else{
			$data['message'] = "Post array is empty";
			$data['status'] = FALSE;
			echo '<pre>';print_r($data);exit;
			return $data;
		}
	}

	public function uni_builder_reg($email_id ='')
	{
		echo $email_id;exit;
	}
	/* Below function was added by chandru 24-09-2015 */
	public function downgrade_plan($post_array = array())
	{
		if(isset($post_array) && !empty($post_array))
		{
			$plan_id = $post_array['selected_plan_id'];
		/* Fetch builder id and user id based on subscription id */
		$sort_type = 'DESC LIMIT 1';
			$order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
			$previous_payment_subscription_details = $this->Mod_payment->get_payment_details(array(
												'select_fields' => array(),
												'where_clause' => array('subscription_id'=>$post_array['subscription_id'],'payment_status'=>'Success'),
												'order_clause' => $order_by_where
												));
												// echo '<pre>';print_r($previous_payment_subscription_details);exit;
			$response = array();
			if(TRUE == $previous_payment_subscription_details['status'])
			{
				$cancel_subscription_id = $previous_payment_subscription_details['aaData'][0]['subscription_id'];
				$builder_id = $previous_payment_subscription_details['aaData'][0]['builder_id'];
				$last_payment_date = $previous_payment_subscription_details['aaData'][0]['payment_date'];
				/* Find user id based on builder id */
				$where_builder_str = array('builder_id' => $builder_id,'account_type' => BUILDERADMIN );
				$get_builder_user_id = array(
								'select_fields' => array('ub_user_id'),
								'where_clause' => $where_builder_str
								);
				$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
				$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];
				/* Find date different */
				/* $current_date = new DateTime(TODAY);
				$current_date = $current_date->format('Y-m-d');
				$current_date = new DateTime($current_date);
				$last_payment_date = new DateTime($last_payment_date);
				$last_payment_date = $last_payment_date->format('Y-m-d');
				$last_payment_date = new DateTime($last_payment_date);
				$interval = $current_date->diff($last_payment_date);
				$interval = $interval->format('%a');
				$payment_interval = 30 - $interval; */
				/* Date interval code ends here */
				/* Fetch current plan amount */
				$where_string = array('PLAN.ub_plan_id' => $plan_id); 
				$plan_array = $this->Mod_plan->get_plan_details(array(
						'select_fields' => array('PLAN.plan_amount','PLAN.plan_name'),
						'where_clause' => $where_string));
				$current_plan_amount = $plan_array['aaData'][0]['plan_amount'];
				$current_plan_name = $plan_array['aaData'][0]['plan_name'];
				/* Add in payment table */
				if(TRUE == $post_array['upgrade_payment_status'])
				{
					$payment_result['insert_id'] = $post_array['payment_insert_id'];
				}else{
					$payment_details_array = array(
									'builder_id' 			=> $builder_id,
									'plan_id'  				=> $plan_id,
									'payment_mode'	 		=> 'Credit Card',
									'currency' 				=> 'USD',
									'payment_date' 			=> TODAY,
									'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
									'created_on' 			=> TODAY,
									'created_by' 			=> $builder_user_id,
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $builder_user_id
								   );
					$payment_result = $this->Mod_payment->add_payment($payment_details_array);
				}
				/* Cancel subscription code added by chandru */
					if(isset($post_array['subscription_id']) && !empty($post_array['subscription_id']))
					{
						$cancel_status = $this->Mod_payment->cancel_subscription($post_array['subscription_id']);
						/* Update in builder contract table */
						$builder_contract_update_array = array(
									'subscription_id'  	=> $post_array['subscription_id'],
									'end_date'  	=> date("Y-m-d"),
									'status'  	=> CANCELLED_CONTRACT,
									'modified_on' 	=> TODAY,
									'modified_by' 	=> $builder_user_id
									);
						$this->Mod_builder_contract->update_builder_contract_table($builder_contract_update_array);
						/* Inserting in builder contract table */
						$date = TODAY;
						$date = strtotime($date);
						$date = strtotime("30 day", $date);
						$expiry_date = date('Y-m-d h:i:s', $date);
						$builder_contract = array(
							'builder_id' => $builder_id,
							'user_id' => $builder_user_id,
							'user_plan_id' => $plan_id,
							'start_date' => CURRENT_DATE,
							'expiry_date' => $expiry_date,
							'created_by' => $builder_user_id,
							'created_on' => TODAY,
							'modified_on' 	=> TODAY,
							'modified_by' 	=> $builder_user_id
							);
						$ub_builder_contract_response = $this->Mod_builder_contract->add_builder_contract($builder_contract);
						/* Update builder contract table */
						$builder_contract_number = $this->Mod_builder_contract->generate_number_time('CON',BUILDER_CONTRACT_NUMBER_LENGTH,$ub_builder_contract_response['insert_id']);
						$builder_contract_update_array = array(
											'latest_payment_id' => $payment_result['insert_id'],
											'payment_count' => 0,
											'contract_number' => $builder_contract_number,
											'ub_builder_contract_id' => $ub_builder_contract_response['insert_id'],
											'modified_on' 			=> TODAY,
											'modified_by' 			=> $builder_user_id
											);
						$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
					}
					/* Cancel subscription code ends here*/
					/* ARP code starts here */
					$payment_array =  array(
		          	  'builder_id' 		=> $builder_id,
		          	  'builder_name'	=> $post_array['builder_name'],
				      'firstName'		=> $post_array['first_name'],
		          	  'payment_id' 		=> $payment_result['insert_id'],
					  'lastName'		=> $post_array['last_name'],
					  'desk_phone' 		=> $post_array['desk_phone'],
					  'contract_number' => $ub_builder_contract_response['insert_id'],
					  'street1'			=> $post_array['address1'],
					  'city'			=> $post_array['city'],
					  'state'			=> $post_array['province'],
					  'postalCode' 		=> $post_array['postal'],
					  'country'			=> 'US',
					  'start_date'      => date('Y-m-d', strtotime("+0 days")),
					  'email'			=> $post_array['primary_email'],
					  'ipaddress'		=> $_SERVER['REMOTE_ADDR'],
					  'updated_plan_amount'		=> $current_plan_amount,
					  'plan_amount'		=> $current_plan_amount,
					  'accountNumber'	=> $post_array['credit_card_number'],
					  'expirationMonth'	=> $post_array['expiry_month'],
					  'expirationYear'	=> $post_array['expiry_year'],
					  'cvNumber'		=> $post_array['code'],
					  'cardname'		=> $post_array['cardname'],
                      'plan_id'			=> $plan_id,
					  'description'		=> 'ARB');
				 	$arb_payment_response = $this->Mod_payment->make_payment($payment_array);
					// echo '<pre>';print_r($arb_payment_response);exit;
					/* ARP code ends here */
					if (isset($arb_payment_response['responce']['messages']['message']['code']) && $arb_payment_response['responce']['messages']['message']['code'] == 'I00001')
					{
						$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$payment_result['insert_id']);
						$arr_payment_update = array(
									'payment_no' 			=> $payment_no,
									'builder_contract_id' 	=> $ub_builder_contract_response['insert_id'],
									'subscription_id'		=> $arb_payment_response['responce']['subscriptionId'],
									'ub_payment_id'			=> $payment_result['insert_id'],
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $builder_user_id
									);
						$this->Mod_payment->update_payment($arr_payment_update);
						/* Update builder contract */
						$builder_contract_update_array = array(
											'subscription_id' => $arb_payment_response['responce']['subscriptionId'],
											'ub_builder_contract_id' => $ub_builder_contract_response['insert_id'],
											'modified_on' 			=> TODAY,
											'modified_by' 			=> $builder_user_id
											);
						$this->Mod_builder_contract->update_builder_contract($builder_contract_update_array);
						/* Update builder status */
						/* Update builder table status */
						$update_builder_array = array(
							'ub_builder_id' => $builder_id,
							'payment_status' => SUCCESS_PAYMENT,
							'current_plan_id' => $plan_id
							);
						$builder_table_update = $this->Mod_builder->update_builder($update_builder_array);
						$response['status'] = TRUE;
						$response['userid'] = $builder_user_id;
						$response['message'] = 'Subscription created sucessfully';
					}else{
						$response['message'] = $arb_payment_response['responce']['messages']['message']['text'];
						$payment_update_details_array_failed_case = array(
								    'ub_payment_id' => $payment_result['insert_id'],
									'result_text' 			=>  $response['message'],
									'payment_status' 		=> FAILD_PAYMENT,
									'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $builder_user_id
								   );
					$this->Mod_payment->update_payment($payment_update_details_array_failed_case);
					$response['status'] = FALSE;
					$response['message'] = 'Subscription was not created'.$response['message'];
					}
					return $response;
			}
			$response['status'] = FALSE;
			$response['message'] = 'Previous Subscription was not available';
			return $response;
		}
	}
	/* Below function was added by chandru 25-09-2015 for upgrade */
	public function upgrade_plan($post_array = array())
	{
		/* Fetch current plan amount */
		// echo '<pre>';print_r($post_array);exit;
		$where_string = array('PLAN.ub_plan_id' => $post_array['selected_plan_id']); 
		$plan_array = $this->Mod_plan->get_plan_details(array(
				'select_fields' => array('PLAN.plan_amount','PLAN.plan_length','PLAN.trail_amount','PLAN.plan_name'),
				'where_clause' => $where_string));
		$current_plan_amount = $plan_array['aaData'][0]['plan_amount'];
		$current_plan_length = $plan_array['aaData'][0]['plan_length'];
		$current_trail_amount = $plan_array['aaData'][0]['trail_amount'];
		$current_plan_name = $plan_array['aaData'][0]['plan_name'];
		/* Fetch user details */
		$user_details = $this->Mod_user->get_users(array(
							'select_fields' => array('builder_id','ub_user_id'),
							'where_clause' => array('primary_email'=>$post_array['primary_email'],'role_id'=>BUILDER_ADMIN_ROLE_ID,'username'=>$post_array['user_name'])
							));
		$builder_id = $user_details['aaData'][0]['builder_id'];
		$ub_user_id = $user_details['aaData'][0]['ub_user_id'];
		/* Pro data calculation for upgrade plan 30-09-2015 */
			$sort_type = 'DESC LIMIT 1';
			$order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
			$where_condition = array('PAYMENT_DETAILS.builder_id' => $builder_id,'PAYMENT_DETAILS.payment_status' => 'Success');
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
				$date = new DateTime($last_payment_date );
				$now = new DateTime();
				$days =  $date->diff($now)->format("%d");
				
				if (isset($current_plan_amount) && !empty($current_plan_amount) && $current_plan_amount != 0 &&  $current_plan_amount > $last_charged_amount) 
				{
					$prodata_amount_calculation = $this->Mod_payment->prodata_amount($current_plan_amount, $last_charged_amount, $current_plan_length, $days);
					// $prodata_amount = round($current_plan_amount - ($last_charged_amount /$current_plan_length * $days),2);
					$prodata_amount = $prodata_amount_calculation;
				}
				else if(isset($current_plan_amount))
				{
					$prodata_amount = $current_plan_amount;
				}else{
					$prodata_amount = 0;
				}
		/* Pro data calculation code ends here */
		/* Insert in payment table */
		$payment_details_array = array(
						'builder_id' 			=> $builder_id,
						'plan_id'  				=> $post_array['selected_plan_id'],
						'payment_mode'	 		=> 'Credit Card',
						'currency' 				=> 'USD',
						'payment_date' 			=> TODAY,
						'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
						'created_on' 			=> TODAY,
						'created_by' 			=> $ub_user_id,
						'modified_on' 			=> TODAY,
						'modified_by' 			=> $ub_user_id
					   );
		$payment_result = $this->Mod_payment->add_payment($payment_details_array);
		$payment_no = $this->Mod_builder->generate_number(PAYMENT_NAME_FORMAT,PAYMENT_NUMBER_LENGTH,$payment_result['insert_id']);	
		/* Build array for sending to AIM */
		$aim_post_array = array(
			'credit_card_numbers'	=> $post_array['credit_card_number'], // Visa
			'card_expiry_month'		=> $post_array['expiry_month'],
			'card_expiry_year'		=> $post_array['expiry_year'],
			'ccv_code'				=> $post_array['code'],
			'x_description'			=> 'AIM',
			'updated_plan_amount'	=> $current_plan_amount,
			'first_name'			=> $post_array['first_name'],
			'last_name'				=> $post_array['last_name'],
			'address'				=> $post_array['address1'],
			'city'					=> $post_array['city'],
			'province'				=> $post_array['province'],
			'postal'				=> $post_array['postal'],
			'country'				=> $post_array['country'],
			'desk_phone'			=> $post_array['desk_phone'],
			'primary_email'			=> $post_array['primary_email']
			);
		$aim_payment_response = $this->Mod_payment->make_aim_transaction($aim_post_array);
		$responce = array();
		if(TRUE == $aim_payment_response['status'])
		{
			/* Update payment table */
			$digits = substr(trim($aim_payment_response[50]), -4);
			$payment_update_details_array = array(
						'payment_no' 			=> $payment_no,
						'ub_payment_id' 		=> $payment_result['insert_id'],
						'plan_id'  				=> $post_array['selected_plan_id'],
						'payment_date' 			=> TODAY,
						'payment_method' 		=> 'AIM',
						'payment_type' 			=> 'Received',
						'transaction_id'  		=> $aim_payment_response[6],
						'reference_id'			=> $aim_payment_response[37],
						'amount' 				=> $aim_payment_response[9], 
						'last_4digits'			=> $digits,
						'response_code' 		=> $aim_payment_response[0], 
						'result_code' 			=>  $aim_payment_response[2], 
						'result_text' 			=>  $aim_payment_response[3],
						'payment_status' 		=> SUCCESS_PAYMENT,
						'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
						'modified_on' 			=> TODAY,
						'modified_by' 			=> $ub_user_id
					   );
		$this->Mod_payment->update_payment($payment_update_details_array);
			/* block to get builder datails*/
			$post_arrays =  array('USER.builder_id'=>$builder_id, 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

			$sort_type = 'ASC';
			$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
			$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
			$builder_details_array = $this->Mod_builder->get_builder_details(array(
													'select_fields' => array('USER.first_name','USER.last_name','USER.ub_user_id','BUILDER_DETAILS.ub_builder_id','BUILDER_DETAILS.builder_name','USER.primary_email','USER.desk_phone',
													'USER.address','USER.city','USER.province','USER.primary_email',
													'USER.postal','USER.country'),
													'join'=> array('user'=>'yes'),
													'where_clause' => $post_arrays,
													'order_clause' => $order_by_where
													));	
			//echo "<pre>";print_r($builder_details_array);exit;
			$builder_detail = $builder_details_array['aaData']['0'];
			/* Builder fetch code ends here */
		
			/* Insert in invoice table */
			$date = TODAY;
			$date = strtotime($date);
			$date = strtotime("30 day", $date);
			$invoice_to_date = date('Y-m-d h:i:s', $date);
			/* Below code was added by chandru 14-10-2015 */
			$plan_response = $this->Mod_plan->get_plan_details(array(
										'select_fields' => array('plan_name','plan_code','plan_amount','plan_length','no_of_projects','no_of_users'),
										'where_clause' => array('ub_plan_id'=>$post_array['selected_plan_id'])
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
					'builder_id' => $builder_id,
					'payment_id' => $payment_result['insert_id'],
					'transaction_id' => $aim_payment_response[6],
					'user_plan_id' => $post_array['selected_plan_id'],
					'plan_name' => $current_plan_name,
					'invoice_from_date' => date('Y-m-d'),
					'invoice_amount' => $aim_payment_response[9],
					'invoice_status' => 'Active',
					'plan_description' => $plan_description,
					'address'		=> $builder_detail['address'],
					'city'			=> $builder_detail['city'],
					'province'		=> $builder_detail['province'],
					'pincode' 		=> $builder_detail['postal'],
					'country'		=> $builder_detail['country'],
					'phone_number' => $builder_detail['desk_phone'],
					'invoice_to_date' => $invoice_to_date,
					'created_on' => TODAY,
					'created_by' => $ub_user_id
					);
			$invoice_response = $this->Mod_invoice->add_invoice($invoice_array);
			/* Invoice code ends here */
		/* Update in builder table */
		/* Update builder table status */
						$update_builder_array = array(
							'ub_builder_id' => $builder_id,
							'payment_status' => SUCCESS_PAYMENT,
							'current_plan_id' => $post_array['selected_plan_id']
							);
						$builder_table_update = $this->Mod_builder->update_builder($update_builder_array);
		$responce['status'] = TRUE;
		$responce['payment_insert_id'] = $payment_result['insert_id'];
		}else{
			$payment_update_details_array_failed_case = array(
								    'ub_payment_id' => $payment_result['insert_id'],
									'result_text' 			=>  $aim_payment_response['message'],
									'payment_status' 		=> FAILD_PAYMENT,
									'ip_address' 			=> $_SERVER['REMOTE_ADDR'],
									'modified_on' 			=> TODAY,
									'modified_by' 			=> $this->user_id
								   );
			$this->Mod_payment->update_payment($payment_update_details_array_failed_case);
			$responce['message'] = 'AIM Payment was failed because of'.$aim_payment_response['message'];
			$responce['status'] = FALSE;
		}
		return $responce;
	}
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */