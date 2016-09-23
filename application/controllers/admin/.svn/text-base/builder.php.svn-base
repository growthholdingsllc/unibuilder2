<?php 
/** 
 * Unibuilder Admin Dashboard Class
 * 
 * @package: Unibuilder Admin 
 * @subpackage: Unibuilder Admin
 * @category: Unibuilder Admin
 * @author: CHANDRU
 * @createdon(DD-MM-YYYY): 09-06-2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Builder extends UNI_Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
    {
		//Parent constructor
        parent::__construct();	
		$this->load->model(array('Mod_login','Mod_user','Mod_role','Mod_builder','Mod_plan','Mod_doc','Mod_mail','Mod_project','Mod_payment'));
    }
	
	/** 
	* Builder index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True
	* Access URL : YWRtaW4vYnVpbgxf1Rlci9pbmRleA--
	*/
	
	public function index()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/builder/view',
		'search_session_array' => $this->uni_session_get('SEARCH'),		
		);
		 // echo "<br>encrypt---> ". $this->crypt->decrypt('YWRtaW4vYnVpbgxf1Rlci9lZgxf1l0YnVpbgxf1Rlci83OA--'); 
		/* Fetch plan code */
		$plan_array = $this->Mod_builder->get_plans(array(
							'select_fields' => array('PLAN.ub_plan_id','CONCAT(PLAN.plan_name, " - ",PLAN.plan_amount, " USD", " - ",PLAN.no_of_projects, " Project" ) AS plan')));
        $data['plan'] = array();
		
        if(TRUE === $plan_array['status'])
		{
			$data['plan'] = $this->Mod_builder->build_ci_dropdown_array($plan_array['aaData'],'ub_plan_id', 'plan');
		}
		/* Status code */
        $status_dropdown[] = array('id' => 'Active','val' => 'Active');
        $status_dropdown[] = array('id' => 'Inactive','val' => 'Inactive');
        $data['status_dropdown_list'] = $this->Mod_builder->build_ci_dropdown_array($status_dropdown,'id', 'val'); 
		$this->template->view($data);
	}
	
	
	public function save_builder()
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/builder/addbuilder'		
		);
		/* Fetch plan code */
		$plan_array = $this->Mod_builder->get_plans(array(
							'select_fields' => array('PLAN.ub_plan_id','CONCAT(PLAN.plan_name, " - ",PLAN.plan_amount, " USD", " - ",PLAN.no_of_projects, " Project" ) AS plan')));
        $data['plan'] = array();
		
        if(TRUE === $plan_array['status'])
		{
			$data['plan'] = $this->Mod_builder->build_ci_dropdown_array($plan_array['aaData'],'ub_plan_id', 'plan');
		}
		// echo '<pre>';print_r($data['plan']);exit;
		$this->template->view($data);
	}
	/* Below function was added by CHANDRU */
	public function add_builder()
	{
		$result = $this->sanitize_input();
		if(!empty($this->input->post()))
		{
			if(TRUE === $result['status'])
			{
			// echo '<pre>';print_r($result);exit;
				if (isset($result['data']['email_address']) && !empty(isset($result['data']['email_address']))) 
				{
					/* Find email address exist or not */
					$primary_email = $result['data']['email_address'];
					$verify_primary_email = $this->Mod_user->get_users(array(
												'select_fields' => array('USER.primary_email'),
												'where_clause' => array('USER.primary_email'=> $primary_email)
												));
					if ($verify_primary_email['status'] == FALSE) 
					{
						$args = array('classification'=>'builder_currency', 'where_clause' => '(enum01 = "YES")');
						$builder_currency = $this->Mod_general_value->get_general_value($args);
						
						/* Builder table insert code */
						$form_data['builder_data'] = array(
							'builder_name' => $result['data']['company_name'],
							'builder_currency' => $builder_currency['values']['0']['type'],
							'builder_currency_symbol_code' => $builder_currency['values']['0']['value'],
							'current_plan_id' =>$result['data']['plan_id'],
							'payment_status' => NO_PAYMENT,
							'created_on' => TODAY,
							'modified_on'=> TODAY,
							'builder_status' => PENDING_PAYMENT);
							$ub_builder_response = $this->Mod_builder->add_builder($form_data['builder_data']);
						/* Builder table insert code Ends */
						/* Builder table update code */ 
						$membership_number = $this->Mod_builder->generate_number('UNI',BUILDER_MEMBERSHIP_NUMBER_LENGTH,$ub_builder_response['insert_id']);
						$form_data['builder_update_data'] = array(
									'membership_number' =>$membership_number,
									'ub_builder_id' =>$ub_builder_response['insert_id']
									);
						$ub_update_builder_response = $this->Mod_builder->update_builder($form_data['builder_update_data']);
						/* Builder table update code Ends */
						/* User table insert code */
						$form_data['user_data'] = array(
							'builder_id' => $ub_builder_response['insert_id'],
							'username' => $result['data']['username'],
							'first_name' => $result['data']['first_name'],
							'last_name' => $result['data']['last_name'],
							'primary_email' => $result['data']['email_address'],
							'address' => $result['data']['address'],
							'city' => $result['data']['city'],
							'province' => $result['data']['state'],
							'postal' => $result['data']['zip'],
							//'country' => $result['data']['country'],
							'country' => 'USA',
							'desk_phone' => $result['data']['mobile_number'],
							'user_status' => $result['data']['account_info'],
							'login_enabled' => 'Yes',
							'account_type' => BUILDERADMIN,
							'role_id' => BUILDER_ADMIN_ROLE_ID,
							'created_on' => TODAY,
							'time_zone' => DEFAULT_USER_TIME_ZONE,
							'date_format' => DEFAULT_DATE_FORMAT);
							$ub_user_response = $this->Mod_user->add_user($form_data['user_data']);
							/* User table insert code ends here */
							$form_data['user_plan_data'] = array(
							'builder_id' => $ub_builder_response['insert_id'],
							'user_id' => $ub_user_response['insert_id'],
							'status' => 'Active',
							'created_by' => $ub_user_response['insert_id'],
							'created_on' => TODAY,
							'plan_id' => $result['data']['plan_id']);

						$ub_plan_response = $this->Mod_plan->add_user_plan($form_data['user_plan_data']);
						if (TRUE === $ub_plan_response['status']) 
						{
							
							$response['userid'] = $ub_user_response['insert_id'];
							$response['username'] = $result['data']['username'];
							$response['status'] = TRUE;
							$response['message'] = 'Builder added successfully';
						}
						else
						{
							$response['status'] = FALSE;
							$response['message'] = 'Registration Failed';
						}
						$this->Mod_user->response($response);
						
					}
					else
					{
						//echo "<pre>else";print_r($result);exit;
						$response['status'] = FALSE;
						$response['message'] = 'Email id already exists. Please try with some other email id';
						$this->Mod_user->response($response);
					}
					
				}
				else
				{
					$response['status'] = FALSE;
					$response['message'] = 'The email field is empty';
					$this->Mod_user->response($response);
				}
			}
			else
			{
				$this->Mod_role->response($result);
			}
			
		}
	}
	
	public function send_invitation()
	{
		$result = $this->sanitize_input();
				if(!empty($this->input->post()))
		{
			if(TRUE === $result['status'])
			{
			// echo '<pre>';print_r($result);exit;
				if (isset($result['data']['email_address']) && !empty(isset($result['data']['email_address']))) 
				{
					/* Find email address exist or not */
					$primary_email = $result['data']['email_address'];
					$verify_primary_email = $this->Mod_user->get_users(array(
												'select_fields' => array('USER.primary_email'),
												'where_clause' => array('USER.primary_email'=> $primary_email)
												));
					if ($verify_primary_email['status'] == FALSE) 
					{
						$args = array('classification'=>'builder_currency', 'where_clause' => '(enum01 = "YES")');
						$builder_currency = $this->Mod_general_value->get_general_value($args);
						
						/* Builder table insert code */
						$form_data['builder_data'] = array(
							'builder_name' => $result['data']['company_name'],
							'builder_currency' => $builder_currency['values']['0']['type'],
							'builder_currency_symbol_code' => $builder_currency['values']['0']['value'],
							'current_plan_id' =>$result['data']['plan_id'],
							'payment_status' => NO_PAYMENT,
							'created_on' => TODAY,
							'modified_on'=> TODAY,
							'builder_status' => PENDING_PAYMENT);
							$ub_builder_response = $this->Mod_builder->add_builder($form_data['builder_data']);
						/* Builder table insert code Ends */
						/* Builder table update code */ 
						$membership_number = $this->Mod_builder->generate_number('UNI',BUILDER_MEMBERSHIP_NUMBER_LENGTH,$ub_builder_response['insert_id']);
						$form_data['builder_update_data'] = array(
									'membership_number' =>$membership_number,
									'ub_builder_id' =>$ub_builder_response['insert_id']
									);
						$ub_update_builder_response = $this->Mod_builder->update_builder($form_data['builder_update_data']);
						/* Builder table update code Ends */
						/* User table insert code */
						$form_data['user_data'] = array(
							'builder_id' => $ub_builder_response['insert_id'],
							'username' => $result['data']['username'],
							'first_name' => $result['data']['first_name'],
							'last_name' => $result['data']['last_name'],
							'primary_email' => $result['data']['email_address'],
							'address' => $result['data']['address'],
							'city' => $result['data']['city'],
							'province' => $result['data']['state'],
							'postal' => $result['data']['zip'],
							//'country' => $result['data']['country'],
							'country' => 'USA',
							'desk_phone' => '7029048582',
							'user_status' => $result['data']['account_info'],
							'login_enabled' => 'Yes',
							'account_type' => BUILDERADMIN,
							'role_id' => BUILDER_ADMIN_ROLE_ID,
							'created_on' => TODAY,
							'time_zone' => DEFAULT_USER_TIME_ZONE,
							'date_format' => DEFAULT_DATE_FORMAT);
							$ub_user_response = $this->Mod_user->add_user($form_data['user_data']);
							/* User table insert code ends here */
							$form_data['user_plan_data'] = array(
							'builder_id' => $ub_builder_response['insert_id'],
							'user_id' => $ub_user_response['insert_id'],
							'status' => 'Active',
							'created_by' => $ub_user_response['insert_id'],
							'created_on' => TODAY,
							'plan_id' => $result['data']['plan_id']);

						$ub_plan_response = $this->Mod_plan->add_user_plan($form_data['user_plan_data']);
						if (TRUE === $ub_plan_response['status']) 
						{
							/* Builder plan expiry reminder code end */
							
							$response['userid'] = $ub_user_response['insert_id'];
							$response['username'] = $result['data']['username'];
							$response['status'] = TRUE;
							$response['message'] = 'Builder added successfully';
							$active_till = gmdate("Y-m-d H:i:s", time()+(3600));
							$key = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
							$where = array('ub_user_id' => $response['userid']);
							$this->Mod_user->update_data(UB_USER, $key, $where);

							//$reset_link = base_url().$this->crypt->encrypt('admin/login/accept_invite/'.$response['userid'].'/'.$result['data']['username']);
							$reset_link = base_url().$this->crypt->encrypt('register/index/'.$result['data']['plan_id'].'/'.$result['data']['email_address']);
							$builder_logo  = $this->Mod_builder->get_builder_logo($ub_builder_response['insert_id']); 
							
							$content_array = array(
							'TO_EMAIL' => $result['data']['email_address'],
							'TO_NAME' => $result['data']['first_name'],
							'FIRST_NAME' => $result['data']['first_name'],
							'RESET_LINK' => $reset_link,
							'SEND_MAIL_INFO' => $result['data']['first_name'].EMAIL_SEPERATOR_LEVEL2.$result['data']['email_address'],
							'IMAGESRC' => IMAGESRC,
							'base_url'=> BASEURL,
							'BUILDER_LOGO' => isset($builder_logo['image_path'])?$builder_logo['image_path']:''
							);
							$this->Mod_mail->send_mail('SEND_CREATE_SUBSCRIPTION_EMAIL', $content_array, 'yes');
							$response['status'] =  TRUE;
							$response['message'] = 'Mail send to '.$result['data']['email_address'].' Sucessfully';
							$this->Mod_builder->response($response);
						}
						else
						{
							$response['status'] = FALSE;
							$response['message'] = 'Registration Failed';
						}
						$this->Mod_user->response($response);
						
					}
					else
					{
						//echo "<pre>else";print_r($result);exit;
						$response['status'] = FALSE;
						$response['message'] = 'Email id already exists. Please try with some other email id';
						$this->Mod_user->response($response);
					}
					
				}
				else
				{
					$response['status'] = FALSE;
					$response['message'] = 'The email field is empty';
					$this->Mod_user->response($response);
				}
			}
			else
			{
				$this->Mod_role->response($result);
			}
			
		}
	}
	/* Access URL : YWRtaW4vYnVpbgxf1Rlci9pbmRleA-- */
	public function editbuilder($builder_id = 0)
	{
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/builder/editbuilder',
        		
		);
		/* Fetch plan code */
		$plan_array = $this->Mod_builder->get_plans(array(
							'select_fields' => array('PLAN.ub_plan_id','CONCAT(PLAN.plan_name, " - ",PLAN.plan_amount, " USD", " - ",PLAN.no_of_projects, " Project" ) AS plan')));
        $data['plan'] = array();
		
        if(TRUE === $plan_array['status'])
		{
			$data['plan'] = $this->Mod_builder->build_ci_dropdown_array($plan_array['aaData'],'ub_plan_id', 'plan');
		}
		// echo '<pre>';print_r($data['plan']);
		/* Status code */
        $status_dropdown[] = array('id' => 'active','val' => 'Active');
        $status_dropdown[] = array('id' => 'inactive','val' => 'Inactive');
        $data['status_dropdown_list'] = $this->Mod_builder->build_ci_dropdown_array($status_dropdown,'id', 'val');
		/* Fetch builder code */
		$where_str = array('USER.builder_id'=>$builder_id,'USER_PLAN.status' => 'Active');
		$builder_user_args = array('select_fields' => array(
										'USER.ub_user_id','USER.username', 'USER.builder_id','USER.primary_email','USER.user_status','CONCAT_WS(" ",USER.first_name,USER.last_name) as full_name','BUILDER_DETAILS.builder_name','BUILDER_DETAILS.membership_number','USER.city','PLAN.plan_name','PLAN.ub_plan_id','PLAN.no_of_projects','USER_PLAN.created_on','USER_PLAN.plan_id','USER.first_name','USER.last_name','USER.address','USER.postal','BUILDER_DETAILS.builder_currency','USER.	province','USER.country','USER_PLAN.ub_user_plan_id','USER.desk_phone'),
										'join'=> array('user'=>'Yes','userplan'=>'Yes','plan'=>'Yes'),
										'where_clause' => $where_str
										 ); 
		$result_data = $this->Mod_builder->get_builder_details($builder_user_args);
		if($result_data['status'] == TRUE)
		{
			$data['result_data'] = $result_data['aaData'][0];
			// echo '<pre>';print_r($data['result_data']);exit;
		}
		// echo '<pre>';print_r($data['result_data']['plan_id']);
		/* Unsetting current plan key and value */
		$unset_key = $data['result_data']['plan_id'];
		unset($data['plan'][$unset_key]);
		
		/* Calculating project count for particular builder */
		$total_count_array = $this->Mod_project->get_projects(array(
												'select_fields' => array('COUNT(PROJECT.ub_project_id) AS total_count'),
												'where_clause' => array('builder_id'=>$builder_id,'project_status'=>'Open'),
												));
		if(TRUE == $total_count_array['status'])
		{
			$data['current_plan_project_count'] = $total_count_array['aaData'][0]['total_count'];
		}else{
			$data['current_plan_project_count'] = 0;
		}
		$data['project_disable'] = FALSE;
		$data['disable_project_count'] = 0;
		// echo '<pre>';print_r($result_data);exit;
		/* Fetch plan list */
			// Fetch argument building
			$order_by = 'USER_PLAN.ub_user_plan_id desc';
			$where_condition = array('builder_id'=>$builder_id);
			$plan_args = array('select_fields' => array('USER_PLAN.created_on','USER_PLAN.modified_on','plan_name'),
					'join'=> array('userplan'=>'Yes'),
					'where_clause' => $where_condition,
					'order_clause' => $order_by);

			// The following parameters required for data table
			$plan_data = $this->Mod_plan->get_plan_details($plan_args); 
			/* Below code was dded by chadnru */
			$order_by_where = 'PLAN.ub_plan_id DESC';
			$result_plan_data = $this->Mod_plan->get_plan_and_contractdetails(array(
			'select_fields' => array('PLAN.plan_name,PLAN.plan_amount','UB_BUILDER_CONTRACT.contract_number','PLAN.ub_plan_id','UB_BUILDER_CONTRACT.created_on','UB_BUILDER_CONTRACT.modified_on','UB_BUILDER_CONTRACT.start_date','UB_BUILDER_CONTRACT.expiry_date','UB_BUILDER_CONTRACT.end_date'),
			'join'=> array('contract'=>'yes'),
			'where_clause' => $where_condition,
			'order_clause' => $order_by_where
            ));
			// echo '<pre>';print_r($result_plan_data);exit;
			if(TRUE == $plan_data['status'])
			{
				$data['plan_data'] = $result_plan_data['aaData'];
			}else{
				$data['plan_data'] = '';
			}
			// echo '<pre>';print_r($data['plan_data']);exit;
		$this->template->view($data);
	}
	
	public function update_builder()
	{
		$result = $this->sanitize_input();
		if(!empty($this->input->post()))
		{
			if(TRUE === $result['status'])
			{
				$update_builder_array = array(
						'builder_name' => $result['data']['company_name'],
						'ub_builder_id' => $result['data']['user_builder_id'],
						'modified_on' =>TODAY,
						'modified_by' =>$this->user_id
						);
				$ub_update_builder_response = $this->Mod_builder->update_builder($update_builder_array);
				if($ub_update_builder_response['status'] == TRUE)
				{
					/* user update code */
					/* User table insert code */
						$form_data['update_user_data'] = array(
							'builder_id' => $result['data']['user_builder_id'],
							'first_name' => $result['data']['first_name'],
							'last_name' => $result['data']['last_name'],
							'address' => $result['data']['address'],
							'city' => $result['data']['city'],
							'desk_phone' => $result['data']['mobile_number'],
							'province' => $result['data']['state'],
							'postal' => $result['data']['zip'],
							'country' => $result['data']['country'],
							'user_status' => $result['data']['status_id'],
							'modified_on' =>TODAY,
							'modified_by' =>$this->user_id,
							'ub_user_id' =>$result['data']['user_user_id']);
							$ub_user_response = $this->Mod_user->update_user($form_data['update_user_data']);
							/* User table insert code ends here */
							$this->Mod_user->response($ub_user_response);
				}
			}
			else
			{
				$this->Mod_role->response($result);
			}
		}
	}
	
	public function get_builder()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				/* Search plan code */
				$search_session_array = array();
				if(isset($result['data']['plan_id']) && $result['data']['plan_id']!='' && $result['data']['plan_id'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'USER_PLAN.plan_id',
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
								'field_name' => 'USER.user_status',
								'value'=> $result['data']['status_id'], 
								'type' => '='
							);
					//Modified session code
					 $search_session_array['status_id'] = $result['data']['status_id'];
				}
				/* Search company name code */
				if(isset($result['data']['company_name']) && $result['data']['company_name']!='' && $result['data']['company_name'] != 'null')
				{
					$post_array[] = array(
								'field_name' => 'BUILDER_DETAILS.builder_name',
								'value'=> $result['data']['company_name'], 
								'type' => 'like'
							);
					//Modified session code
					 $search_session_array['company_name'] = $result['data']['company_name'];
				}
				$post_array[] = array(
									'field_name' => 'USER.account_type',
									'value'=> BUILDERADMIN, 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'USER_PLAN.status',
									'value'=> 'Active', 
									'type' => '='
									);
				$post_array[] = array(
									'field_name' => 'USER.role_id',
									'value'=> BUILDER_ADMIN_ROLE_ID, 
									'type' => '='
									);
                /* $post_array[] = array(
									'field_name' => 'USER.user_status',
									'value'=> 'Delete', 
									'type' => '!='
									);	 */	
				/*
					Paggination length stored in seesion code start here
				*/
				$search_session_array['iDisplayStart'] = $result['data']['iDisplayStart'];
				$search_session_array['iDisplayLength'] = $result['data']['iDisplayLength'];							
				// Setting session 
				$this->uni_set_session('search', $search_session_array);
				// echo '<pre>';print_r($this->session->all_userdata());exit;
				// Where clause argument
				// echo '<pre>';print_r($post_array);exit;
				$where_str = $this->Mod_user->build_where($post_array);
				// Pagination argument
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
				}
				// Order by clause argument
				// $order_by_where = '';
				/* if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'USER.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}  */
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >=  0)
				{
					// echo $result['data']['iSortCol_0'];
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$format_sort_name = $this->Mod_user->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
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
                // Fetch argument building
                $builder_user_args = array('select_fields' => array(
												'USER.ub_user_id', 'USER.builder_id','USER.primary_email','USER.user_status','CONCAT_WS(" ",USER.first_name,USER.last_name) as full_name','BUILDER_DETAILS.builder_name','BUILDER_DETAILS.membership_number','USER.city','PLAN.plan_name','USER_PLAN.plan_id'),
												'join'=> array('user'=>'Yes','userplan'=>'Yes','plan'=>'Yes'),
												'where_clause' => $where_str,
												'order_clause' => $order_by_where,
												'group_clause' => array("USER.ub_user_id"), 
												'pagination' => $pagination_array
                                                 ); 
				$result_data = $this->Mod_builder->get_builder_details($builder_user_args);
				// echo '<pre>';print_r($result_data);exit;
				// The following parameters required for data table
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('COUNT(USER.ub_user_id) AS total_count'),
												'join'=> array('user'=>'Yes','userplan'=>'Yes'),
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
	}
	
	/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @createdby: chandru
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_builder->destroy_session($result['data']);
			}
			$this->Mod_builder->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	
	/* Update plan */
	public function update_plan()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo '<pre>';print_r($result['data']);exit;
			if(TRUE === $result['status'])
			{
				$de_activate_project = $this->project_details_for_plan($result['data']['builder_id'], $result['data']['plan_id']);
				$plan_id = $result['data']['plan_id'];
				if(TRUE == $de_activate_project['project_disable'])
				{
					$this->Mod_builder->response($de_activate_project);
				}
				/* echo '<pre>';print_r($result['data']);exit;
				$result['data']['status'] = 'Inactive';
				$result['data']['modified_on'] = TODAY;
				$result['data']['modified_by'] = $this->user_id; */
				/* Fetch builder details based on builder id */
				$builder_id = $result['data']['builder_id'];
				$post_array =  array('USER.builder_id'=>$builder_id, 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

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
			// echo "<pre>";print_r($builder_details_array);exit;
			if(TRUE == $builder_details_array['status'])
			{
				$builder_detail = $builder_details_array['aaData']['0'];
			}
				$current_plan_id = $result['data']['current_plan_id'];
				$new_plan_id = $result['data']['plan_id'];
				$update_array = array(
						'builder_id' => $result['data']['builder_id'],
						'ub_user_plan_id' => $result['data']['ub_user_plan_id'],
						);
				$results = $this->Mod_plan->update_user_plan($update_array);
				if($results['status'] == TRUE)
				{
					$form_data['update_user_plan_data'] = array(
							'builder_id' => $result['data']['builder_id'],
							'user_id' => $this->user_id,
							'status' => 'Active',
							'created_by' => $this->user_id,
							'modified_by' => $this->user_id,
							'created_on' => TODAY,
							'modified_on' => TODAY,
							'plan_id' => $result['data']['plan_id']);
					$result = $this->Mod_plan->add_user_plan($form_data['update_user_plan_data']);
					$result['project_disable'] = FALSE;
					/* Update builder table status */
					$update_builder_array = array(
						'ub_builder_id' => $builder_id,
						'payment_status' => PENDING_PAYMENT,
						);
					$builder_table_update = $this->Mod_builder->update_builder($update_builder_array);
					/* Fetch previous payment and subscription details */
						$sort_type = 'DESC LIMIT 1';
						$order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
						$previous_payment_subscription_details = $this->Mod_payment->get_payment_details(array(
													'select_fields' => array(),
													'where_clause' => array('builder_id'=>$builder_id,'payment_status'=>'Success'),
													'order_clause' => $order_by_where
													));
						if(TRUE == $previous_payment_subscription_details['status'])
						{
							$cancel_subscription_id = $previous_payment_subscription_details['aaData'][0]['subscription_id'];
						}else{
							$cancel_subscription_id = 0;
						}
						/* Find upgrade or down grade code starts here */
						/* Fetch plan code */
						// $where = In($current_plan_id,$new_plan_id);
						$plan_amount_array = $this->Mod_builder->get_plans(array(
											'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_amount'),
											'where_clause' => array('ub_plan_id'=>$current_plan_id),
											));
						$current_plan_amount = $plan_amount_array['aaData'][0]['plan_amount'];
						$plan_amount_array = $this->Mod_builder->get_plans(array(
											'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_amount'),
											'where_clause' => array('ub_plan_id'=>$new_plan_id),
											));
						$new_plan_amount = $plan_amount_array['aaData'][0]['plan_amount'];
						if($current_plan_amount < $new_plan_amount)
						{
							$type = "Upgrade";
						}else{
							$type = "Downgrade";
						}
						/* Find upgrade or down grade code ends here */
						
						
					/* Fetch previous payment and subscription details code ends here*/
					/* Sending payment link to user added by chandru */
					$reset_link = base_url().$this->crypt->encrypt('register/index/'.$plan_id.'/'.$builder_detail['primary_email'].'/'.$cancel_subscription_id.'/'.$type);
							$builder_logo  = $this->Mod_builder->get_builder_logo($builder_id); 
							
							$content_array = array(
							'TO_EMAIL' => $builder_detail['primary_email'],
							'TO_NAME' => $builder_detail['first_name'],
							'FIRST_NAME' => $builder_detail['first_name'],
							'RESET_LINK' => $reset_link,
							'SEND_MAIL_INFO' => $builder_detail['first_name'].EMAIL_SEPERATOR_LEVEL2.$builder_detail['primary_email'],
							'IMAGESRC' => IMAGESRC,
							'base_url'=> BASEURL,
							'BUILDER_LOGO' => isset($builder_logo['image_path'])?$builder_logo['image_path']:''
							);
							$this->Mod_mail->send_mail('SEND_DOWNGRADE_SUBSCRIPTION_EMAIL', $content_array, 'yes');
				}
			}
			$this->Mod_builder->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Post array is empty';
		}
	}
	 public function user_email_invitation()
	 {
		
		if(!empty($this->input->post()))
		{
		   $results = $this->sanitize_input();
		  
		   if($results['data']['ub_user_id'] == '')
			{
			 
			 $this->send_invitation() ;
			 
			}
			else
			{
		    $active_till = gmdate("Y-m-d H:i:s", time()+(3600));
			$key = array('random_key' => random_string('alnum', 20), 'active_till' => $active_till);
			$where = array('ub_user_id' => $results['data']['ub_user_id']);
			$result = $this->Mod_user->update_data(UB_USER, $key, $where);
			if (isset($results['data']['username']) && !empty($results['data']['username']))
			 {

				//$reset_link = base_url().$this->crypt->encrypt('admin/login/accept_invite/'.$response['userid'].'/'.$result['data']['username']);
				$reset_link = base_url().$this->crypt->encrypt('register/index/'.$result['data']['plan_id'].'/'.$result['data']['email_address']);
			}
			
			$builder_logo  = $this->Mod_builder->get_builder_logo($results['data']['user_builder_id']); 
            $content_array = array(
			'TO_EMAIL' => $results['data']['email_address'],
			'TO_NAME' => $results['data']['first_name'],
			'FIRST_NAME' => $results['data']['first_name'],
			'RESET_LINK' => $reset_link,
			'SEND_MAIL_INFO' => $results['data']['first_name'].EMAIL_SEPERATOR_LEVEL2.$results['data']['email_address'],
			'IMAGESRC' => IMAGESRC,
			'base_url'=> BASEURL,
			'BUILDER_LOGO' => isset($builder_logo['image_path'])?$builder_logo['image_path']:''
			);
			$this->Mod_mail->send_mail('SEND_CREATE_SUBSCRIPTION_EMAIL', $content_array, 'yes');
			$response['status'] =  TRUE;
			$response['message'] = 'Mail send to '.$results['data']['email_address'].' Sucessfully';
			$this->Mod_builder->response($response);
			}
		}
		else
		{
			$response['status'] =  FALSE;
			$response['message'] = 'Failed to send mail';
			$this->Mod_builder->response($response);
		}
		
	} 
    public function delete_builders()
	{
	  if(!empty($this->input->post()))
		{
		// Sanitize input
		$result = $this->sanitize_input();

	     if(TRUE === $result['status'])
			{
					// Delete functionality
					$response = $this->Mod_builder->delete_builder($result['data']);
			}
			else
			{
				$this->Mod_builder->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		// Response data
		$this->Mod_builder->response($response);
	}
	/** 
	* Get Project Details
	* 
	* @method: get_project_details 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* @author: Sidhartha 
	* @url: bgxf19ncy9pbmRleC8-
	* @createdon(DD-MM-YYYY): 18-08-2015
	*/	
	public function get_project_details()
	{
		
		if(!empty($this->input->post()))
		{
			$where_str = '';
			// Sanitize input
			$result = $this->sanitize_input();
			//print_r($result);
			if(TRUE === $result['status'])
			{
				// Getting data of a particular builder
				$post_array[] = array(
									'field_name' => 'PROJECT.builder_id',
									'value'=> $result['data']['ub_builder_id'], 
									'type' => '='
									);
							
				// Date range search input
				if(isset($result['data']['search_param']) && $result['data']['search_param']!='')
				{
					if($result['data']['search_param'] != 'all')
					{
						$post_array[] = array(
										'field_name' => 'PROJECT.project_status',
										'value'=> $result['data']['search_param'],
										'type' => '='
										);
					}
					
					
				}
				
				$where_str = $this->Mod_builder->build_where($post_array);
				
			
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
					// Get formatted sort name
					$format_sort_name = $this->Mod_builder->get_formatted_sort_name(array('module_name' => $this->module, 'filed_name' => $result['data'][$dt_filed_name.$sort_filed_column_id]));
					if($format_sort_name != '')
					{
						$order_by_where = $format_sort_name.' '.$sort_type;
					}
					else
					{
						$order_by_where = 'PROJECT.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
					}
				}
				else
				{
					$order_by_where = 'PROJECT.modified_on DESC';
				}
				$date_array = array('PROJECT.projected_start_date'=>'projected_start_date','PROJECT.actual_completion'=>'actual_completion');
				
                // Fetch argument building
                $project_args = array('select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name','PROJECT.project_status','PROJECT.address,'.$this->Mod_user->format_user_datetime($date_array,"date")),
                'where_clause' => $where_str,
                'order_clause' => $order_by_where,
                'pagination' => $pagination_array
                ); 
				
				// Fetch records as per user time zone and date format based on joins, where clause, order by clause and pagination
				$result_data = $this->Mod_builder->get_project_details($project_args);
				// File export request  
				
				// The following parameters required for data table
				if($result_data['status'] == FALSE)
				{
					$result_data = array();
					$result_data['aaData'] = array();
				}
				else
				{
					// Get number of records
					$total_count_array = $this->Mod_builder->get_project_details(array(
												'select_fields' => array('COUNT(PROJECT.ub_project_id) AS total_count'),
												'where_clause' => $where_str,
												));
					$result_data['iTotalRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['iTotalDisplayRecords'] = isset($total_count_array['aaData'][0]['total_count'])?$total_count_array['aaData'][0]['total_count']:'';
					$result_data['sEcho'] = isset($result['data']['sEcho'])?$result['data']['sEcho']:'';
				}
				$this->Mod_builder->response($result_data);
			}
			else
			{
				$this->Mod_builder->response($result);
			}
		}
		else
		{
			$result = array();
			$result['aaData'] = array();
			$result['status'] = FALSE;
			$result['message'] = 'Post array is empty';
			$this->Mod_builder->response($result);
		}
	}
	/** 
	* Update Project Status
	* 
	* @method: update_project_status 
	* @access: public 
	* @param:  ajax post array
	* @return: array
	* @author: Sidhartha 
	* @url: bgxf19ncy9pbmRleC8-
	* @createdon(DD-MM-YYYY): 18-08-2015
	*/
	public function update_project_status()
	{
		$result = $this->sanitize_input();
		$response = $this->Mod_builder->update_project($result['data']);
		$this->Mod_builder->response($response);
	}
	/* Fetch plan related project details in onchange */
	public function project_details_for_plan($builder_id = 0,$plan_id = 0)
	{
		$result = $this->sanitize_input();
		if($builder_id > 0)
		{
			$result['data']['builder_id'] = $builder_id;
		}
		if($plan_id > 0)
		{
			$result['data']['plan_id'] = $plan_id;
		}
		if(TRUE == $result['status'])
		{
			$plan_array = $this->Mod_builder->get_plans(array(
							'select_fields' => array('PLAN.ub_plan_id', 'PLAN.plan_name', 'PLAN.plan_amount', 'PLAN.no_of_projects'),
							'where_clause' => array('PLAN.ub_plan_id'=>$result['data']['plan_id'])));
			// echo '<pre>';print_r($plan_array);exit;
			if(TRUE == $plan_array['status'])
			{
				$responce = array();
				$responce['no_of_projects'] = $plan_array['aaData'][0]['no_of_projects'];
			}
		}
		/* Calculating project count for particular builder */
		$total_count_array = $this->Mod_project->get_projects(array(
												'select_fields' => array('COUNT(PROJECT.ub_project_id) AS total_count'),
												'where_clause' => array('builder_id'=>$result['data']['builder_id'],'project_status'=>'Open'),
												));									
		if(TRUE == $total_count_array['status'])
		{
			$responce['current_plan_project_count'] = $total_count_array['aaData'][0]['total_count'];
		}else{
			$responce['current_plan_project_count'] = 0;
		}
		if($responce['no_of_projects'] >= $responce['current_plan_project_count'])
		{
			$responce['project_disable'] = FALSE;
		}else{
			$responce['project_disable'] = TRUE;
			$responce['disable_project_count'] = $responce['current_plan_project_count'] - $responce['no_of_projects'];
		}
		return $responce;
		// $this->Mod_builder->response($responce);
	}
	
	/* Drop down onchange code added by chandru */
	/* Fetch plan related project details in onchange */
	public function project_details_for_plan_drop_down()
	{
		$result = $this->sanitize_input();
		if(TRUE == $result['status'])
		{
			$plan_array = $this->Mod_builder->get_plans(array(
							'select_fields' => array('PLAN.ub_plan_id', 'PLAN.plan_name', 'PLAN.plan_amount', 'PLAN.no_of_projects'),
							'where_clause' => array('PLAN.ub_plan_id'=>$result['data']['plan_id'])));
			// echo '<pre>';print_r($plan_array);exit;
			if(TRUE == $plan_array['status'])
			{
				$responce = array();
				$responce['no_of_projects'] = $plan_array['aaData'][0]['no_of_projects'];
			}
		}
		/* Calculating project count for particular builder */
		$total_count_array = $this->Mod_project->get_projects(array(
												'select_fields' => array('COUNT(PROJECT.ub_project_id) AS total_count'),
												'where_clause' => array('builder_id'=>$result['data']['builder_id'],'project_status'=>'Open'),
												));									
		if(TRUE == $total_count_array['status'])
		{
			$responce['current_plan_project_count'] = $total_count_array['aaData'][0]['total_count'];
		}else{
			$responce['current_plan_project_count'] = 0;
		}
		if($responce['no_of_projects'] >= $responce['current_plan_project_count'])
		{
			$responce['project_disable'] = FALSE;
			$responce['disable_project_count'] = 0;
		}else{
			$responce['project_disable'] = TRUE;
			$responce['disable_project_count'] = $responce['current_plan_project_count'] - $responce['no_of_projects'];
		}
		$this->Mod_builder->response($responce);
	}
}