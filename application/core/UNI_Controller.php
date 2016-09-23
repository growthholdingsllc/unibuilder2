<?php
/**
 *
 * @name UNI_Controller
 * @version PHP 5.5
 *
 * @package		NA
 * @Team		Uni Builder Dev Team
 * @author    Gopakumar K <gopakumar.k@ttkservices.com>
 * @copyright	Copyright (c) 2015,Uni Builder.
 * @Created		08-01-2015
 * @version   1
 */
class  UNI_Controller  extends  CI_Controller  {
	/**
	* @property: $modules
	* @access: public
	*/
	public $modules='';
	/**
	* @property: $crypt
	* @access: public
	*/
	public $crypt='';
	/**
	* @property: $display_url
	* @access: public
	*/
	public $display_url='';
	/**
	* @property: $first_argument array
	* @access: public
	*/
	public $first_argument = 0;
	/**
	* @property: $parameters array
	* @access: public
	*/
	public $parameters = 0;
	/**
	* @property: $user_session array
	* @access: public
	*/
	public $user_session = array();
	/**
	* @property: $account_session array
	* @access: public
	*/
	public $account_session = array();
	/**
	 * @property: $builder_id
	 * @access: public
	 */
	public $builder_id = '';
	/**
	 * @property: $user_id
	 * @access: public
	 */
	public $user_id = '';
	/**
	 * @property: $user_account_type
	 * @access: public
	 */
	public $user_account_type = '';
	/**
	 * @property: $project_id
	 * @access: public
	 */
	public $project_id = '';
	/**
	 * @property: $project_name
	 * @access: public
	 */
	public $project_name = '';
	/**
	 * @property: $project_status
	 * @access: public
	 */
	public $project_status = '';
	/**
	 * @property: $project_status_check
	 * @access: public
	 */
	public $project_status_check = TRUE;
	/**
	 * @property: $project_status_check_array
	 * @access: public
	 */
	public $project_status_check_array = array();
	/**
	 * @property: $user_role_access
	 * @access: public
	 */
	public $user_role_access = '';
	/**
	 * @property: $user_notification_preferences
	 * @access: public
	 */
	public $user_notification_preferences = '';
	/**
	 * @property: $ci_object
	 * @access: public
	 */
	public $ci_object = '';
	/**
	 * @property: $main_modules
	 * @access: public
	 */
	public $main_modules = '';
	/**
	 * @property: $users_project_list
	 * @access: public
	 */
	public $users_project_list = '';
	/**
	 * @property: $users_project_ids
	 * @access: public
	 */
	public $users_project_ids = '';
	/**
	 * @property: $builder_logo_url
	 * @access: public
	 */
	public $builder_logo_url = '';
	/**
	 * @property: $template_id
	 * @access: public
	 */
	public $template_id = '';
	/**
	 * @property: $template_name
	 * @access: public
	 */
	public $template_name = '';
	/**
	 * @property: $users_project_list
	 * @access: public
	 */
	public $users_template_list = '';
	/**
	 * @property: $users_project_ids
	 * @access: public
	 */
	public $users_template_ids = '';
	/** 
	* Constructor
	* 
	* @method: __construct 
	* @access: public 
	* @param: 
	* @return: Constructor initialized
	*/
	public function __construct()
	{
		parent::__construct();
		// Loading Libraries
		$this->load->library('user_agent');
		$this->load->model('Mod_project');
		$this->load->model('Mod_template');
		$this->load->model('Mod_doc');
		$this->main_modules = $this->config->item('modules');
		// Setting common session
		//Avoided decryption for mail_fetch controller
		if($this->uri->segment(1) == 'mail_fetch')
		{
			$this->display_url = $this->uri->segment(1);
		}
		else
		{
			$this->display_url = $this->crypt->decrypt($this->uri->segment(1));
		}
		

		$this->user_session_check();
		$this->load->library('image_lib');
		
		// Defining properties
		$this->builder_id = isset($this->user_session['builder_id'])?$this->user_session['builder_id']:0;
		$this->user_id = isset($this->user_session['ub_user_id'])?$this->user_session['ub_user_id']:0;
		
		//Benchmark 
		if(ENVIRONMENT!='production')
		{
			if($this->session->userdata('benchmarkon'))
				$this->output->enable_profiler($this->session->userdata('benchmarkon'));
		}
		//echo '<pre>';print_r($this->session->all_userdata());exit;
		// Set user project list in session 
		$this->set_user_project_list();
		$this->get_builder_logo();
		
		//Set user template list in session 
		$this->account_session = $this->session->userdata('ACCOUNT');
		$this->swith_template_name = isset($this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['TEMPLATE']['VIEW_NAME']['display_type'])?$this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['TEMPLATE']['VIEW_NAME']['display_type']:'';
		if($this->swith_template_name == 'template_view' && isset($this->user_session['ub_user_id']))
		{
			$this->set_user_template_list();
		}	
		// echo '<pre>';print_r($this->session->all_userdata());exit;
			
		// Set module name - Controller
		$this->module = $this->router->fetch_class();
		// $this->project_id = $this->uni_session_get('PROJECT');
	
		// Encrypt function
		$this->crypt = new Crypt;
		$this->benchmark->mark('code_start');
		$this->ci_object = & get_instance();		
	}
	/** 
	* Setting up common session
	* 
	* @method: sanitize_input 
	* @access: public 
	* @param: (empty)
	* @return: response_array 
	*/
	public function user_session_check()
	{
		$url_ary = explode("/",$this->display_url);
		if($url_ary[0] !=  'login' && $url_ary[0] !=  'register' && $url_ary[0] !=  'admin' && $url_ary[0] !=  'mail_fetch')
		{
			$this->account_session = $this->session->userdata('ACCOUNT');
			$this->user_session = $this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['USER'];
			
			//project
			$this->module = 'COMMON_PROJECT';
			$project_session_array = $this->uni_session_get('PROJECT');
			$this->user_account_type = $this->session->userdata('ACCOUNT_TYPE');
			$this->project_status_check_array = array('Closed','Disabled','Signed Off');
			if(isset($project_session_array['project_id']))
			{
				$this->project_id = $project_session_array['project_id'];
				$this->project_name = $project_session_array['project_name'];
				$this->project_status = $project_session_array['project_status'];
			}

			//template
			$this->module = 'COMMON_TEMPLATE';
			$template_session_array = $this->uni_session_get('TEMPLATE');
			//$this->project_status_check_array = array('Closed','Disabled','Signed Off');
			if(isset($template_session_array['template_id']))
			{
				$this->template_id = $template_session_array['template_id'];
				$this->template_name = $template_session_array['template_name'];
				//$this->project_status = $project_session_array['project_status'];
			}	
			
			if(!isset($this->user_session) || empty($this->user_session))
			{
				redirect(base_url().$this->crypt->encrypt('login/index/'));
			}
			// Project status check setup
			if (in_array($this->project_status, $this->project_status_check_array))
			{
				$this->project_status_check = FALSE;
			} 			
			$this->user_role_access = isset($this->user_session['role_access'])?$this->user_session['role_access']:0;
			$user_preference = array('mail_preferences' => isset($this->user_session['mail_preferences'])?$this->user_session['mail_preferences']:0, 'sms_preferences' => isset($this->user_session['sms_preferences'])?$this->user_session['sms_preferences']:0);
		
			$this->user_notification_preferences = $user_preference;
			if(!empty($this->user_role_access))
			{
				$this->access_check();
			}
		}
		else if(($url_ary[0] ==  'admin' && $url_ary[1] !=  'login' && $url_ary[1] !=  'scheduler' && $url_ary[0] !=  'mail_fetch'))
		{
			$this->account_session = $this->session->userdata('ACCOUNT');
			$this->user_session = $this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['USER'];
			if(!isset($this->user_session) || empty($this->user_session))
			{
				redirect(base_url().$this->crypt->encrypt('admin/login/index/'));
			}
		}
		return TRUE;
	}
	/** 
	* Clean the data transferred to the sever before submitting to model
	* 
	* @method: sanitize_input 
	* @access: public 
	* @param: (empty)
	* @return: response_array 
	*/
	public function sanitize_input()
	{
		$data_array = array();
		$data_array['status'] = FALSE;
		$msg = '';
		if(CHECK_USER_IP)
		{
		// Check if user IP set-up is on and validate the current user IP 
			if ( ! $this->input->valid_ip($this->input->ip_address()))
			{
				$msg = 'User IP is Not Valid';
				$data_array['message'] = $msg;
				return $data_array;
			}
		}
		if(CHECK_USER_AGENT)
		{
			$msg = 'User Agent is not a browser. Access Denied';
			// Check if user agent set-up is on and validate allowed agent  
			if( ! $this->input->user_agent())
			{
				// Verify the user agent accessing the application
				$msg = 'User Agent is not identified. Access Denied';
				$data_array['message'] = $msg;
				return $data_array;							
			}
			
			if ( ! $this->agent->is_browser())
			{
				// Verify if the user agent is a browser
				$data_array['message'] = $msg;
				return $data_array;							
			}
			elseif ($this->agent->is_robot())
			{
				// Verify if the user agent is a robot
				$data_array['message'] = $msg;
				return $data_array;
			}
			elseif ($this->agent->is_mobile())
			{
				// Verify if the user agent is a mobile
				$data_array['message'] = $msg;
				return $data_array;
			}

		}
		$response_array = $this->_check_request($data_array);
		return $response_array;
	}
	/** 
	* Check the request type allowed to access the data
	* 
	* @method: _check_request 
	* @access: private 
	* @param: data_array 
	* @return: response_array 
	*/

	private function _check_request($data_array=array())
	{
		$response_array = $data_array;
		if($this->input->is_ajax_request())
		{
			// Modify response array to store request type as AJAX
			$response_array['request_type'] = 'AJAX'; 
		}
		elseif($this->input->is_cli_request())
		{
			// Modify response array to store request type as CLI
			$response_array['request_type'] = 'CLI'; 
		}
		else
		{
			// Modify response array to store request type as NORMAL
			$response_array['request_type'] = 'NORMAL'; 
		}
		if(is_array($this->input->post(NULL, TRUE)))
		{
			// Attempt to clean the POST data with XSS
			$response_array['data'] = $this->input->post(NULL, TRUE);
			$response_array['status'] = TRUE;
		}
		else if(is_array($this->input->get(NULL, TRUE)))
		{
			// Attempt to clean the GET data with XSS
			$response_array['data'] = $this->input->get(NULL, TRUE);
			$response_array['status'] = TRUE;
		}else
		{
			// Request do not pass the XSS clean up 
			$response_array['message'] = 'Data not passed XSS clean up';
			return $response_array;

		}
		return $response_array;
	}
	/** 
	* uni session set
	* 
	* @method: uni_set_session 
	* @access: public 
	* @param: $type
	* @param: $set_array contain key value pairs
	* @return:
	*/
	public function uni_set_session($type, $set_array)
	{
		if('' != $type && !empty($set_array))
		{
			foreach($set_array as $key => $value)
			{
				if(@array_key_exists(strtoupper($type), $this->account_session[$this->user_session['account_type']][strtoupper($this->module)]))
				{
					$this->account_session[$this->user_session['account_type']][strtoupper($this->module)][strtoupper($type)][$key] = $value;
				}
				else
				{
					$this->account_session[$this->user_session['account_type']][strtoupper($this->module)] = array(strtoupper($type)=>array($key=>  $value));
				}
			}
			$this->session->set_userdata('ACCOUNT', $this->account_session);
			return TRUE;
		}
		return FALSE;
	}
	/** 
	* uni session get
	* 
	* @method: uni_session_get 
	* @access: public 
	* @param: $type
	* @param: $key
	* @return:
	*/
	public function uni_session_get($type, $key = '')
	{
		if('' != $type)
		{
			if('' != $key)
			{
				return isset($this->account_session[$this->user_session['account_type']][strtoupper($this->module)][strtoupper($type)][$key])?$this->account_session[$this->user_session['account_type']][strtoupper($this->module)][strtoupper($type)][$key]:'';
			}
			else
			{
				return isset($this->account_session[$this->user_session['account_type']][strtoupper($this->module)][strtoupper($type)])?$this->account_session[$this->user_session['account_type']][strtoupper($this->module)][strtoupper($type)]:'';
			}
		}
		else
		{
			return FALSE;
		}
	}
	/** 
	* ci encrypt
	* 
	* @method: ci_encrypt 
	* @access: public 
	* @param: $string
	* @param: $key
	* @return:
	*/
	public function ci_encrypt($string, $key='')
	{
		$this->load->library('encrypt');
		if('' == $key)
		{
			$enc_username = $this->encrypt->encode($string);
		}
		else
		{
			$enc_username = $this->encrypt->encode($string, $key);
		}
		return str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
	}
	/** 
	* ci decrypt
	* 
	* @method: ci_decrypt 
	* @access: public 
	* @param: $string
	* @param: $key
	* @return:
	*/
	public function ci_decrypt($string, $key='')
	{
		$this->load->library('encrypt');
		$dec_username = str_replace(array('-', '_', '~'), array('+', '/', '='), $string);
		if('' == $key)
		{
			$dec_username = $this->encrypt->decode($dec_username);
		}
		else
		{
			$dec_username = $this->encrypt->decode($dec_username, $key);
		}
		return $dec_username;
	}
	/** 
	* uni grid settings get saved views
	* 
	* @method: uni_set_grid_settings 
	* @access: public 
	* @param: $_POST method from the different modules
	* @return: AJAX response  
	*/
	public function uni_set_grid_settings()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$post_array = $this->sanitize_input();
			if(TRUE === $post_array['status'])
			{
				$this->load->model('Mod_grid_settings');
				
				// code to get comma separated column ids  
				$commaselectedColumns = $post_array['data']['grid_settings_columns'];
				$commadefaultColumns = '';
				$default_column = array('classification'=>$this->grid_setting_classification,'where_clause' => array('enum01'=>'Yes'));
				
				$default_columns = $this->Mod_general_value->get_general_value($default_column);
				//print_r($default_columns);exit;
				foreach($default_columns['values'] as $column)
				{
					$commadefaultColumns = $commadefaultColumns.$column['grid_settings_id'].',';
				}
				$datatable_header_commas = $commadefaultColumns.$commaselectedColumns;

				//fetch the display column with the default in general value
				$get_grid_setting_column = array('classification'=>$this->grid_setting_classification, 'where_clause' => "ub_general_valueid IN (".$datatable_header_commas.")",'orderby_clause'=>"int01");
				$grid_setting_column_result = $this->Mod_general_value->get_general_value($get_grid_setting_column);
				$display_fields_array = array();
				$display_field_joins_array = array();
				if(isset($grid_setting_column_result['values']) && count($grid_setting_column_result['values'])>0)
				{
					foreach($grid_setting_column_result['values'] as $fields_array)
					{
						$display_fields_array[$fields_array['grid_settings_id']] = array('display_column_name'=>$fields_array['display_name'],
						'db_field_name'=>$fields_array['field_name'],
						'datatable_column'=>$fields_array['datatable_column']
						);
						if($fields_array['display_joins']!='')
						{
							$display_field_joins_array[$fields_array['display_joins']] = $fields_array['display_joins'];
						}	
					}
				}	
				
				$args = array('module_name' => $this->module ,'is_default' => $post_array['data']['is_default'],'list_view_name' => $post_array['data']['list_view_name'],'display_fields' => "'".serialize($display_fields_array)."'",'display_field_joins' => "'".serialize($display_field_joins_array)."'",
				);
				
				if(isset($post_array['data']['grid_settings_id']) &&  $post_array['data']['grid_settings_id'] > 0)
				{
					$args['ub_grid_settings_id'] = $post_array['data']['grid_settings_id'];
					$result = $this->Mod_grid_settings->update_grid_settings($args);
				}
				else
				{
					$result = $this->Mod_grid_settings->add_grid_settings($args);
				}
				if(TRUE === $result['status'])
				{
					$data['grid_settings_popup']=$this->uni_get_grid_settings_popup_info($result['insert_id']);	
					$data['datatable_headers']=$data['grid_settings_popup']['datatable_headers'];
					unset($data['grid_settings_popup']['datatable_headers']);
					$response = $this->load->view("common/dynamic/grid_settings.php",$data,true);
					echo $response; exit;
				}
				/* else
				{	
					$this->Mod_grid_settings->response($result);	
				} */	
			}
		}
	}
	/** 
	* uni grid settings get saved views
	* 
	* @method: uni_get_grid_settings 
	* @access: public 
	* @param: $_POST method from the different modules
	* @return: AJAX response  
	*/
	public function uni_get_grid_settings()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$this->load->model('Mod_grid_settings');
				$args = array('select_fields' => array('ub_grid_settings_id', 'module_name','is_default' ,'list_view_name', 'display_fields', 'display_field_joins'), 
				'where_clause' => array('builder_id' => $this->builder_id, 'user_id' => $this->user_id));
				
				$result = $this->Mod_grid_settings->get_grid_settings($args);
			}
		}
	
	}	
	/** 
	* uni grid settings - get pop up information 
	* 
	* @method: uni_get_grid_settings 
	* @access: public 
	* @param: $_POST method from the different modules
	* @return: data array  
	*/
	public function uni_get_grid_settings_popup_info($grid_settings_id = 0)
	{
		$this->load->model('Mod_grid_settings');
		// code to get the grid setting dropdown in project landing page
		$args = array('select_fields' => array('ub_grid_settings_id','is_default' ,'list_view_name', 'display_fields', 'display_field_joins' , 'builder_id', 'user_id'), 
		'where_clause' => "(builder_id = '".$this->builder_id."' AND user_id = '".$this->user_id."' OR builder_id = 0) AND module_name = '".$this->module."'");
		$user_grid_settings  = $this->Mod_grid_settings->get_grid_settings($args);
		//echo "<pre>";print_r($user_grid_settings);
		$saved_views_dropdown_array = array();
		$current_view_data = array();
		$current_view_selected_columns = array();
		$mapped_status_index = 0;
		$contract_price_index = 0;
		$performance_timing_index = 0;
		//echo $this->
		if(TRUE === $user_grid_settings['status'])
		{
			foreach($user_grid_settings['aaData'] as $grid_view_array)
			{
				// Get grid settings view saved by user  
				if($grid_view_array['builder_id']>0 && $grid_view_array['user_id']>0)
				{
					// Un Serialize display field data 
					$serialized_data = $grid_view_array['display_fields'];
					$remove_single_quote = str_replace("'", '', $serialized_data);
					$display_fields_unserialized_data = unserialize($remove_single_quote);
					$cols = array();
					// Json data stored in view to manipulate saved views
					foreach($display_fields_unserialized_data as $key => $view_data)
					{
						$cols[$key] = $view_data['display_column_name'];
					}
					$current_view_data[$grid_view_array['ub_grid_settings_id']] = array('list_view'=>array('cols'=>$cols,'viewname'=>$grid_view_array['list_view_name'],'is_default'=>$grid_view_array['is_default']));
					
					
					$saved_views_dropdown_array[] = array('ub_grid_settings_id' => $grid_view_array['ub_grid_settings_id'],'list_view_name'=>$grid_view_array['list_view_name'] );
				}
				
				// Setting up the default data table column and selected fields
				if((isset($grid_view_array['is_default']) &&  'Yes' === $grid_view_array['is_default']) OR $grid_view_array['ub_grid_settings_id'] == $grid_settings_id)
				{
					// Un Serialize display field data 
					$serialized_data = $grid_view_array['display_fields'];
					$remove_single_quote = str_replace("'", '', $serialized_data);
					$display_fields_unserialized_data = unserialize($remove_single_quote);
					// Un Serialize join data display_field_joins
					$serialized_data = $grid_view_array['display_field_joins'];
					$remove_single_quote = str_replace("'", '', $serialized_data);
					$display_field_joins_unserialized_data = unserialize($remove_single_quote);

					// Json data to build the data table column 
					$index = 0;
					$datatable_column = array();
					//print_r($display_fields_unserialized_data);exit;
					if(is_array($display_fields_unserialized_data) && count($display_fields_unserialized_data)>0)
					{
						foreach($display_fields_unserialized_data as $key => $view_data)
						{
							$index++;
							$datatable_column[] = array('data'=>$view_data['datatable_column']);
							if($view_data['display_column_name'] == 'Mapped Status')
							{
								$mapped_status_index = $index;
							}
							if($view_data['display_column_name'] == 'Contract Price')
							{
								$contract_price_index = $index;
							}
							if($view_data['display_column_name'] == 'Performance Timing')
							{
								$performance_timing_index = $index;
							}
						}
					}
					
					if(0 == $grid_view_array['builder_id'] && 0 == $grid_view_array['user_id'])
					{
						$system_grid_settings_default = array('display_fields'=>$display_fields_unserialized_data,
						'grid_settings_id'=>$grid_view_array['ub_grid_settings_id'],
						'datatable_column'=>$datatable_column,
						'mapped_status_index'=>$mapped_status_index,
						'contract_price_index'=>$contract_price_index,
						'performance_timing_index'=>$performance_timing_index);
					}
					else if ($grid_view_array['ub_grid_settings_id'] == $grid_settings_id)
					{
						$user_grid_settings_update = array('display_fields'=>$display_fields_unserialized_data,'display_field_joins'=>$display_field_joins_unserialized_data,'grid_settings_id'=>$grid_view_array['ub_grid_settings_id'],'list_view_name'=>$grid_view_array['list_view_name'],
						'datatable_column'=>$datatable_column,
						'mapped_status_index'=>$mapped_status_index,
						'contract_price_index'=>$contract_price_index,
						'performance_timing_index'=>$performance_timing_index,
						'is_default'=>$grid_view_array['is_default']);
					}
					else if ($grid_view_array['builder_id'] == $this->builder_id && $grid_view_array['user_id'] == $this->user_id)
					{
						$user_grid_settings_default = array('display_fields'=>$display_fields_unserialized_data,'display_field_joins'=>$display_field_joins_unserialized_data,'grid_settings_id'=>$grid_view_array['ub_grid_settings_id'],'list_view_name'=>$grid_view_array['list_view_name'],
						'datatable_column'=>$datatable_column,
						'mapped_status_index'=>$mapped_status_index,
						'contract_price_index'=>$contract_price_index,
						'performance_timing_index'=>$performance_timing_index,
						'is_default'=>$grid_view_array['is_default']);
					}	
				}
			}
			
			//echo "<pre>";print_r($datatable_column);exit;
			
			if(isset($user_grid_settings_update))
			{
				$data['grid_saved_view_default'] = $user_grid_settings_update['grid_settings_id'];
				$data['grid_current_view_name'] = $user_grid_settings_update['list_view_name'];
				
				$data['datatable_headers'] = $user_grid_settings_update['display_fields'];
				$data['datatable_grid_settings_id'] = $user_grid_settings_update['grid_settings_id'];
				
				$data['datatable_column'] = $user_grid_settings_update['datatable_column'];
				$data['mapped_status_index'] = $user_grid_settings_update['mapped_status_index'];
				$data['contract_price_index'] = $user_grid_settings_update['contract_price_index'];
				$data['performance_timing_index'] = $user_grid_settings_update['performance_timing_index'];
				$data['is_default'] = $user_grid_settings_update['is_default'];
				
				//echo "<pre>";print_r($user_grid_settings_default['display_fields']);
				$current_view_selected_columns = array();
				foreach($user_grid_settings_update['display_fields'] as $key => $selected_columns)
				{
					$current_view_selected_columns[] = $key;
				}
				//echo "<pre>";print_r($current_view_selected_columns);
			}			
			else if(isset($user_grid_settings_default))
			{
				$data['grid_saved_view_default'] = $user_grid_settings_default['grid_settings_id'];
				$data['grid_current_view_name'] = $user_grid_settings_default['list_view_name'];
				
				$data['datatable_headers'] = $user_grid_settings_default['display_fields'];
				$data['datatable_grid_settings_id'] = $user_grid_settings_default['grid_settings_id'];
				
				$data['datatable_column'] = $user_grid_settings_default['datatable_column'];
				$data['mapped_status_index'] = $user_grid_settings_default['mapped_status_index'];
				$data['contract_price_index'] = $user_grid_settings_default['contract_price_index'];
				$data['performance_timing_index'] = $user_grid_settings_default['performance_timing_index'];
				$data['is_default'] = $user_grid_settings_default['is_default'];
				
				//echo "<pre>";print_r($user_grid_settings_default['display_fields']);
				$current_view_selected_columns = array();
				foreach($user_grid_settings_default['display_fields'] as $key => $selected_columns)
				{
					$current_view_selected_columns[] = $key;
				}
				//echo "<pre>";print_r($current_view_selected_columns);
			}
			else if(isset($system_grid_settings_default))
			{
				$data['datatable_headers'] = $system_grid_settings_default['display_fields'];
				$data['datatable_grid_settings_id'] = $system_grid_settings_default['grid_settings_id'];
				$data['datatable_column'] = $system_grid_settings_default['datatable_column'];
				$data['mapped_status_index'] = $system_grid_settings_default['mapped_status_index'];
				$data['contract_price_index'] = $system_grid_settings_default['contract_price_index'];
				$data['performance_timing_index'] = $system_grid_settings_default['performance_timing_index'];

			}
			//echo "<pre>";print_r($data);exit;
			
			$grid_saved_views_dropdown = $this->Mod_project->build_ci_dropdown_array($saved_views_dropdown_array,'ub_grid_settings_id','list_view_name');
			$data['grid_saved_views_dropdown'] = $grid_saved_views_dropdown;
		}
		//echo "<pre>";print_r($grid_saved_views_dropdown);exit;
		
 		// code to get the grid setting column drop down from in project landing page
 		$get_grid_setting_column = array('classification'=>$this->grid_setting_classification, 'where_clause' => '(enum01 = "Yes" OR enum01 = "No")','orderby_clause'=>"int01");
 		$grid_setting_column_result = $this->Mod_general_value->get_general_value($get_grid_setting_column);
		//echo "<pre>";print_r($grid_setting_column_result);exit;
		$system_grid_setting_fields = array();
		foreach($grid_setting_column_result['values'] as $row)
		{
			if($row['default_value'] == 'Yes')
			{
				$system_grid_setting_fields[$row['grid_settings_id']] = $row['display_name'];
			}
		}
		$grid_setting_column_dropdown = $this->Mod_general_value->build_ci_dropdown_array($grid_setting_column_result['values'],'grid_settings_id','display_name','multiple');
		$data['system_grid_setting_fields'] = $system_grid_setting_fields;
		$data['grid_current_view_dropdown'] = $grid_setting_column_dropdown;
		$data['grid_current_view_dropdown_selected'] = $current_view_selected_columns;
		$data['grid_current_view_data'] = $current_view_data;
		//echo "<pre>";print_r($current_view_data);exit;
		return $data;
	}	
	/** 
	* set_user_project_list
	* 
	* @method: set_user_project_list 
	* @access: public 
	* @param: 
	* @param: 
	* @return:
	*/
	public function set_user_project_list()
	{
		$this->module = 'COMMON';
		//echo '<pre>';print_r($this->session->all_userdata());exit;
		if(isset($this->user_role_access[strtolower('projects')][strtolower('view all')]) && $this->user_role_access[strtolower('projects')][strtolower('view all')] == 1)
		{
			$where_str = "PROJECT.builder_id = ".$this->builder_id." AND PROJECT.project_status != 'Deleted'";
			
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name','PROJECT.project_status'),
					'where_clause' => $where_str,
					'group_clause' => array("PROJECT.ub_project_id") 
					));
		}
		else if(isset($this->user_role_access[strtolower('projects')][strtolower('view assigned to me')]) && $this->user_role_access[strtolower('projects')][strtolower('view assigned to me')] == 1)
		{
			$where_str = 'PROJECT.builder_id = '.$this->builder_id.' AND (PROJECT.created_by = '.$this->user_id.' || PROJECT.owner_id = '.$this->user_id.' || PROJECT.project_managers = '.$this->user_id.' || FIND_IN_SET('.$this->user_id.', PROJECT.project_assigned_users))';
			
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.ub_project_id','PROJECT.project_name','PROJECT.project_status'),
					'where_clause' => $where_str,
					'group_clause' => array("PROJECT.ub_project_id") 
					));
		}
		
		if(isset($project_list) && TRUE === $project_list['status'])
		{
			$fmt_project_list = $this->Mod_project->build_ci_dropdown_array($project_list['aaData'],'ub_project_id', 'project_name','multiple');
			$this->uni_set_session('COLLAPSE_PROJECT_LIST', $fmt_project_list);
			$this->users_project_list = $fmt_project_list;
			$this->users_project_ids = implode(",", array_keys($this->users_project_list));
			if($this->user_account_type == OWNER)
			{
				$this->module = 'COMMON_PROJECT';
				$own_project_id = array_keys($fmt_project_list);
				$search_session_array['project_id'] = $own_project_id[0];
				$search_session_array['project_name'] = $fmt_project_list[$own_project_id[0]];
				$search_session_array['project_status'] = $project_list['aaData'][0]['project_status'];
				$response_status= $this->uni_set_session('PROJECT', $search_session_array);
				$this->project_id = $search_session_array['project_id'];
				$this->project_name = $search_session_array['project_name'];
				$this->project_status = $search_session_array['project_status'];
			}
		}
	}
	/** 
	* set project id in session
	* 
	* @method: set_project_id_in_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 15/05/2015 
	*/
	public function set_project_info_in_session($project_info)
	{
		 if(count($project_info)> 0)		
		{
			if($project_info['project_id'] == 'all_project')
			{	
				$response = $this->Mod_project->destroy_session(array('module_name' => 'COMMON_PROJECT'));
			}
			else
			{
				// Set value in session
				$search_session_array['project_id'] = $project_info['project_id'];
				$search_session_array['project_name'] = $project_info['project_name'];
				$search_session_array['project_status'] = $project_info['project_status'];
				$response_status= $this->uni_set_session('PROJECT', $search_session_array);
				$response['status'] = $response_status;
			}
		}
		return $response;
			
	}
	/** 
	* menu access check
	* 
	* @method: access_check 
	* @access: public 
	* @return: 
	* @created by: satheesh kumar
	* @created on: 16/05/2015 
	*/
	public function access_check()
	{	
		$controller_name = $this->router->fetch_class();
		$function_name = $this->router->fetch_method();
		$current_url = $this->crypt->decrypt($this->uri->segment(1));
		$parameters = explode("/",$current_url);
		$this->parameters = $parameters;
		$return_value = $this->mapping_check($controller_name,$function_name,$parameters);
		//$return_value = 1;
		//echo '<pre>';print_r($return_value);exit;
		if($return_value == 0)
		{
			// Redirect to appropriate dashboard when user is already logged in
			if($controller_name == 'login')
			{
				switch ($this->user_account_type)
				{
					case BUILDERADMIN:
						redirect(base_url().$this->crypt->encrypt('builder_dashboard/index/'), 'location');
						break;
					case OWNER:
						redirect(base_url().$this->crypt->encrypt('owner_dashboard/index/'), 'location');
						break;
					case SUBCONTRACTOR:
						redirect(base_url().$this->crypt->encrypt('subcontractor_dashboard/index/'), 'location');
						break;
				}
			}
			// Redirect to user/user_forbidden_page/
			redirect(base_url().'dXNlci91c2VyX2ZvcmJpZgxf1Rlbl9wYWdlLw--', 'location');
		}
	}
	/** 
	* mapping_check
	* 
	* @method: mapping_check 
	* @access: public 
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 16/05/2015 
	*/
	public function mapping_check($controller_name,$function_name,$parameters)
	{
		// Controllers not required access level
		if($controller_name == 'mail_fetch' || $controller_name == 'customerror' || $controller_name == 'builder_dashboard' || $controller_name == 'owner_dashboard' || $controller_name == 'subcontractor_dashboard' || ($controller_name == 'logs' && $function_name == 'index') || ($controller_name == 'task' && $function_name == 'index') || $controller_name == 'setup' || $controller_name == 'preferences' ||  ($controller_name == 'payapp' && $function_name == 'index') || $controller_name == 'template_dashboard') 
		{	
			return 1;
		}
		$this->swith_template_name = isset($this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['TEMPLATE']['VIEW_NAME']['display_type'])?$this->account_session[$this->session->userdata('ACCOUNT_TYPE')]['TEMPLATE']['VIEW_NAME']['display_type']:'';
		
		// Building requested url
		if($this->swith_template_name == 'template_view')
		{
			if(empty($parameters[3]))
			{	
				$page_url = $controller_name.'/'.$function_name.'/';
			}
			else
			{	
				$page_url = $controller_name.'/'.$function_name.'/argument/';
				$this->first_argument = $parameters[3];
			}

		}
		else
		{
			if(empty($parameters[2]))
			{	
				$page_url = $controller_name.'/'.$function_name.'/';
			}
			else
			{	
				$page_url = $controller_name.'/'.$function_name.'/argument/';
				$this->first_argument = $parameters[2];
			}
		}
		$action_with_access_priviledge = array(
			
			strtolower($controller_name).'/index/' => ((isset($this->user_role_access[strtolower($controller_name)][strtolower('view all')])&&($this->user_role_access[strtolower($controller_name)][strtolower('view all')] == 1 )) || (isset($this->user_role_access[strtolower($controller_name)][strtolower('view assigned to me')])&&$this->user_role_access[strtolower($controller_name)][strtolower('view assigned to me')] == 1 ) || (isset($this->user_role_access[strtolower($controller_name)][strtolower('view created by me')])&&$this->user_role_access[strtolower($controller_name)][strtolower('view created by me')] == 1 ))?1:0,	
						
			'leads/save_lead/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'leads/save_lead/argument/' => (isset($this->user_role_access['leads'][strtolower('edit')]) || isset($this->user_role_access['leads'][strtolower('view all')]) || isset($this->user_role_access['leads'][strtolower('view created by me')]))?($this->user_role_access['leads'][strtolower('edit')] || $this->user_role_access['leads'][strtolower('view all')] || $this->user_role_access['leads'][strtolower('view created by me')]):0,
			
			'leads/delete_leads/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('delete')])?$this->user_role_access[strtolower($controller_name)][strtolower('delete')]:0,
			
			'projects/save_project/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'projects/save_project/argument/' => 1,
			
			'projects/delete_projects/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('delete')])?$this->user_role_access[strtolower($controller_name)][strtolower('delete')]:0,
			
			'logs/save_log/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'logs/save_log/argument/' => 1,
			
			'logs/delete_log/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('delete')])?$this->user_role_access[strtolower($controller_name)][strtolower('delete')]:0,
			
			'task/save_task/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,
			
			'task/save_task/argument/' => 1,
			
			'task/delete_tasks/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('delete')])?$this->user_role_access[strtolower($controller_name)][strtolower('delete')]:0,
			
			'punchlist/save_punchlist/' => isset($this->user_role_access['punchlist'][strtolower('add')])?$this->user_role_access['punchlist'][strtolower('add')]:0,
			
			'punchlist/save_punchlist/argument/' => (isset($this->user_role_access['punchlist'][strtolower('edit')]) || isset($this->user_role_access['punchlist'][strtolower('view all')]) )?($this->user_role_access['punchlist'][strtolower('edit')] || $this->user_role_access['punchlist'][strtolower('view all')]):0,
			
			'punchlist/delete_punchlist/' => isset($this->user_role_access['punchlist'][strtolower('delete')])?$this->user_role_access['punchlist'][strtolower('delete')]:0,
			
			'bids/bidrequest_list/' =>  (isset($this->user_role_access['bids'][strtolower('view all')]) || isset($this->user_role_access['bids'][strtolower('view assigned to me')]))?($this->user_role_access['bids'][strtolower('view all')] || $this->user_role_access['bids'][strtolower('view assigned to me')]):0,
						
			'budget/project_budget/' => (isset($this->user_role_access['budget'][strtolower('view all')]) || isset($this->user_role_access['budget'][strtolower('view created by me')]))?($this->user_role_access['budget'][strtolower('view all')] || $this->user_role_access['budget'][strtolower('view created by me')]):0,
			
			'schedules/save_schedule/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'schedules/save_schedule/argument/' => 1,
			
			'schedules/save_work_day_exception/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('Add Exception')])?$this->user_role_access[strtolower($controller_name)][strtolower('Add Exception')]:0,

			'schedules/save_work_day_exception/argument/' => 1,
						
			'selections/save_selection/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'selections/save_selection/argument/' => (isset($this->user_role_access[strtolower($controller_name)][strtolower('edit')]) || isset($this->user_role_access[strtolower($controller_name)][strtolower('view all')]))?($this->user_role_access[strtolower($controller_name)][strtolower('edit')] || $this->user_role_access[strtolower($controller_name)][strtolower('view all')]):0,
			
			'checklist/save_checklist/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'checklist/save_checklist/argument/' => (isset($this->user_role_access['checklist'][strtolower('edit')]) || isset($this->user_role_access['checklist'][strtolower('view all')]) || isset($this->user_role_access['checklist'][strtolower('view created by me')]))?($this->user_role_access['checklist'][strtolower('edit')] || $this->user_role_access['checklist'][strtolower('view all')] || $this->user_role_access['checklist'][strtolower('view created by me')]):0,
			
			'checklist/delete_checklist/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('delete')])?$this->user_role_access[strtolower($controller_name)][strtolower('delete')]:0,
			
			'warranty/save_warranty/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'warranty/save_warranty/argument/' => (isset($this->user_role_access['warranty'][strtolower('edit')]) || isset($this->user_role_access['warranty'][strtolower('view all')]) || isset($this->user_role_access['warranty'][strtolower('view assigned to me')]))?($this->user_role_access['warranty'][strtolower('edit')] || $this->user_role_access['warranty'][strtolower('view all')] || $this->user_role_access['warranty'][strtolower('view assigned to me')]):0,
			
			'warranty/delete_warranty/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('delete')])?$this->user_role_access[strtolower($controller_name)][strtolower('delete')]:0,
			
			'user/builder_users/' => isset($this->user_role_access['builderusers'][strtolower('view all')])?$this->user_role_access['builderusers'][strtolower('view all')]:0,		
			
			'user/save_builderuser/' => isset($this->user_role_access['builderusers'][strtolower('add')])?$this->user_role_access['builderusers'][strtolower('add')]:0,	
			
			'user/save_builderuser/argument/' => (isset($this->user_role_access['builderusers'][strtolower('edit')]) || isset($this->user_role_access['builderusers'][strtolower('view all')]))?($this->user_role_access['builderusers'][strtolower('edit')] || $this->user_role_access['builderusers'][strtolower('view all')]):0,
			
			'user/delete_builderuser/' => isset($this->user_role_access['builderusers'][strtolower('delete')])?$this->user_role_access['builderusers'][strtolower('delete')]:0,	
						
			'subcontractor/user_subcontractor/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('view all')])?$this->user_role_access[strtolower($controller_name)][strtolower('view all')]:0,
			
			'subcontractor/save_subcontractor/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('add')])?$this->user_role_access[strtolower($controller_name)][strtolower('add')]:0,	
			
			'subcontractor/save_subcontractor/argument/' => (isset($this->user_role_access[strtolower($controller_name)][strtolower('edit')]) || isset($this->user_role_access[strtolower($controller_name)][strtolower('view all')]))?($this->user_role_access[strtolower($controller_name)][strtolower('edit')] || $this->user_role_access[strtolower($controller_name)][strtolower('view all')]):0,
			
			'subcontractor/delete_sub_contractor/' => isset($this->user_role_access[strtolower($controller_name)][strtolower('delete')])?$this->user_role_access[strtolower($controller_name)][strtolower('delete')]:0,	
			
			'user/user_subuser/' => isset($this->user_role_access['subusers'][strtolower('view all')])?$this->user_role_access['subusers'][strtolower('view all')]:0,
			
			'user/save_subuser/' => isset($this->user_role_access['subusers'][strtolower('add')])?$this->user_role_access['subusers'][strtolower('add')]:0,	
			
			'user/save_subuser/argument/' => (isset($this->user_role_access['subusers'][strtolower('edit')]) || isset($this->user_role_access['subusers'][strtolower('view all')]))?($this->user_role_access['subusers'][strtolower('edit')] || $this->user_role_access['subusers'][strtolower('view all')]):0,
			
			'user/user_roles/' => isset($this->user_role_access['user roles'][strtolower('view all')])?$this->user_role_access['user roles'][strtolower('view all')]:0,
			
			'user/add_userroles/' => isset($this->user_role_access['user roles'][strtolower('add')])?$this->user_role_access['user roles'][strtolower('add')]:0,	
			
			'user/add_userroles/argument/' => (isset($this->user_role_access['user roles'][strtolower('edit')]) || isset($this->user_role_access['user roles'][strtolower('view all')]))?($this->user_role_access['user roles'][strtolower('edit')] || $this->user_role_access['user roles'][strtolower('view all')]):0,

			'survey/new_template/' => isset($this->user_role_access['survey'][strtolower('add')])?$this->user_role_access[strtolower('survey')][strtolower('add')]:0,	
			
			'survey/new_template/argument/' => (isset($this->user_role_access['survey'][strtolower('edit')]) || isset($this->user_role_access['survey'][strtolower('view all')]))?($this->user_role_access['survey'][strtolower('edit')] || $this->user_role_access['survey'][strtolower('view all')]):0,
			
			'survey/new_survey/argument/' => (isset($this->user_role_access['survey'][strtolower('edit')]) || isset($this->user_role_access['survey'][strtolower('view all')]))?($this->user_role_access['survey'][strtolower('edit')] || $this->user_role_access['survey'][strtolower('view all')]):0,
			
			'survey/save_survey_request/argument/' => (isset($this->user_role_access['survey'][strtolower('edit')]) || isset($this->user_role_access['survey'][strtolower('view all')]))?($this->user_role_access['survey'][strtolower('edit')] || $this->user_role_access['survey'][strtolower('view all')]):0,
			
			'survey/survey_response/argument/' => (isset($this->user_role_access['survey'][strtolower('edit')]) || isset($this->user_role_access['survey'][strtolower('view all')]))?($this->user_role_access['survey'][strtolower('edit')] || $this->user_role_access['survey'][strtolower('view all')]):0,
			
			'survey/delete_template/' => isset($this->user_role_access['survey'][strtolower('delete')])?$this->user_role_access['survey'][strtolower('delete')]:0,		
			
			'survey/delete_survey/' => isset($this->user_role_access['survey'][strtolower('delete')])?$this->user_role_access['survey'][strtolower('delete')]:0,		
		);
		if(isset($action_with_access_priviledge[$page_url]))
		{
			return isset($action_with_access_priviledge[$page_url])?$action_with_access_priviledge[$page_url]:0;
		}
		else
		{
			return 1;
		}
	}
	
	public function __destruct()
	{
		$this->benchmark->mark('code_end');
		if(ENVIRONMENT!='production')
		{
			// if($this->session->userdata('benchmarkon'))
				// echo "<br><br>".$this->benchmark->elapsed_time('code_start', 'code_end');
		}
	} 

/*###############################################################
// Common code for file upload - start from here(Devansh)
#################################################################*/
	/** 
	* upload
	* 
	* @method: upload 
	* @access: upload 
	* @param:  
	* @return: array 
	*/
	public function upload()
	{
		//echo $this->module; exit;
		//print_r($this->input->post());exit;
		if (!empty($this->input->post()) || !empty($_GET))
		{
			//echo "rtterte23";exit;
            // Sanitize input
            $result = $this->sanitize_input();
			if(TRUE == $result['status'])
			{
				$acceptedFormats = explode(',', ALLOWED_EXTENSION);
				if(isset($_FILES['files']['name']['0']) && (!in_array(pathinfo(strtolower($_FILES['files']['name']['0']), PATHINFO_EXTENSION), $acceptedFormats))) {
					$result['status']  = FALSE;
					$result['message'] = 'error';
				}
				else
				{
					
					$this->Mod_doc->move_files_to_temp_location($result['data']);
				}
			}
			else
			{
				$result['status']  = FALSE;
				$result['message'] = 'Sanitize error';
			}
		}
		else
		{
            $result['status']  = FALSE;
            $result['message'] = 'Post array is empty';
		}
		// $this->Mod_doc->response($result);
	}

	/**
	* Functuon to copy the file from actual location to temp
	*
	* @method: copy_file_to_temp 
	* @access: Public 
	* @param:  
	* @return: 
	*
	*/
	public function copy_file_to_temp()
	{
		if (!empty($this->input->post()))
		{
			$this->load->library('image_lib');
            $result = $this->sanitize_input();
            if(TRUE === $result['status'])
			{
            	$exp = explode('/', $result ['data']['file_path']);
            	$session_id = $this->session->userdata('session_id');

					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= DOC_PATH.$result ['data']['file_path'];
					$config['create_thumb'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					
        			$config['maintain_ratio'] 	= TRUE;
					$config['new_image']	 	= DOC_TEMP_PATH.$session_id.'/'.$result ['data']['temp_id'].'/thumbnail/'.$exp[count($exp)-1];
					$config['width']         	= 80;
					$config['height']       	= 80;
					$this->image_lib->initialize($config); 
					//$this->load->library('image_lib', $config);

					$this->image_lib->resize();
					//$image_path = $result_array[$i]['system_file_name'];
					if (!copy(DOC_PATH.$result ['data']['file_path'],DOC_TEMP_PATH.$session_id.'/'.$result ['data']['temp_id'].'/'.$exp[count($exp)-1])) 
					{
					    $resopnse = array('status'=>FALSE,'message'=> 'Failed to add file.');
					}
					else
					{
						$resopnse = array('status'=>TRUE,'message'=> 'File added successfuly.');
					}
				$this->Mod_doc->response($resopnse);
			}
		}
	}
	/**
	*
	* Function to get the folder heirercy for particular builder.  
	*
	* @method: get_doc_hierarchy
	* @access: public 
	* @return: array
	* @URL: Zgxf19jcy9nZXRfZgxf19jX2hpZXJhcmNoeS8-
	*
	*
	* ### get_doc_hierarchy() - Stored procedure input parameter order and count###
	* 1. builderid (int)
	*/  
	public function get_doc_hierarchy()
	{
		$folder_data = array(	'builder_id' => $this->user_session['builder_id'] );
		$hierarchy_result_array = $this->Mod_doc->get_doc_hierarchy($folder_data);
		//echo "<pre>";print_r($hierarchy_result_array);exit;
		$rows = $this->array_sort($hierarchy_result_array, 'temp_parentid', SORT_ASC);
		foreach ($rows as $row) {
			if ($row['temp_type'] == 'folder') 
			{
				$row_data[] = array(
									'id' => $row['temp_file_hierarchy_id'],
									'name' => $row['temp_ui_name'],
									'type' => 'zip',
									'temp_parentid' => $row['temp_parentid'],
									// 'file_type' => 'folder'
							);
			}
			else
			{
				$row_data[] = array(
									'id' => $row['temp_file_hierarchy_id'],
									'name' => $row['temp_ui_name'],
									'type' => 'jpg',
									'url'   =>"javascript:copy_file_path('".$row['temp_path'].$row['temp_sys_name']."');",
									'temp_parentid' => $row['temp_parentid'],
									// 'file_type' => 'file'
							);
			}
			
		}
		// echo '<pre>';print_r($row_data);exit;
		$tree = $this->buildTree($row_data);
		// echo '<pre>';print_r($tree);exit;
		$this->Mod_doc->response($tree);
	}
	public function buildTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['temp_parentid'] == $parentId) {
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
					$element['type'] = 'dir';
				}
				/* else if($element['file_type'] == 'folder')
				{
					$element['type'] = 'zip';
				}
				unset($element['file_type']); */
				$branch[] = $element;
			}
		}
		return $branch;
	}
	/*function to short the result array*/
	function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[] = $array[$k];
	        }
	    }

	    return $new_array;
	}
	/**
	*
	* Function to get the file names from the temp dir.  
	*
	* @method: create_new_dir
	* @access: public 
	* @return: array
	* @URL: Zgxf19jL2dldF90ZW1wX2Zpbgxf1VuYW1lLw--
	*
	* #flag = 0 - Pass folderid and get files
	* #flag = 1 - project related files
	* #flag = 2 - Non project related files
	*
	*/   
	public function get_temp_filename($message_data = array())
	{
		 // echo "<pre>";print_r($message_data);exit;
		if(!empty($this->input->post()) || !empty($message_data))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// echo '<pre>';print_r($result);exit;
			if(!empty($message_data))
			{
				$result = $message_data;
				$result['status'] = TRUE;
			}
			if (isset($result['data']['projectid']) && !empty($result['data']['projectid'])) 
			{
				$this->project_id = $result['data']['projectid'];
			}
			else
			{
				$this->project_id = 0;
			}
			//set modulename for mom and poco by satheesh
			if(isset($result['data']['modulename']) && !empty($result['data']['modulename']) && $result['data']['modulename'] == 'mom') 
			{
			$this->module = $result['data']['modulename'];
			}
			if(isset($result['data']['modulename']) && !empty($result['data']['modulename']) && $result['data']['modulename'] == 'poco') 
			{
			$this->module = $result['data']['modulename'];
			}
			if(isset($result['data']['modulename']) && !empty($result['data']['modulename']) && $result['data']['modulename'] == 'activity') 
			{
			$this->module = $result['data']['modulename'];
			}
			//echo "<pre>";print_r($result);exit();
			$session_id = $this->session->userdata('session_id');
			if(TRUE === $result['status'])
			{
				if (empty($result['data']['moduleid'])) 
				{
					$result['data']['moduleid'] = 0;
				}
				$temp_directory_id = $result['data']['temp_directory_id'];
				$moduleid = $result['data']['moduleid'];
				if (isset($result['data']['module_name']) && !empty($result['data']['module_name'])) {
					$module_name = $result['data']['module_name'];
				}
				
				$filename = scandir(DOC_TEMP_PATH.$session_id.'/'.$result['data']['temp_directory_id'], 1);
				// echo '<pre>';print_r($filename);exit;
				$count = count($filename);
				$temp_file_name = array();
				/*For loop to get the temp file list from db*/
				for ($j=0; $j < ($count-2); $j++) 
				{  
					if ($filename[$j] === 'thumbnail') {
						
					}
					else
					{
						$ext = pathinfo($filename[$j], PATHINFO_EXTENSION);
						if (!empty($ext)) 
						{
							$temp_file_name[] = $filename[$j];
						}
					}
				}

					if ($this->module == 'docs' || $this->module == 'photos') 
					{
						$flag = 0;
						$folderid = 0;
					}
					else
					{
						if ($this->module == 'leads' || $this->module == 'user' || $this->module == 'setup') 
						{
							$flag = 2;
							$folderid = 0;
						}
						else
						{
							$flag = 1;
							$folderid = 0;
						}
					}
					
					$folder_data = array(	  'flag' => $flag, 
						  'builder_id'	=> $this->user_session['builder_id'],
						  'projectid' => $this->project_id,
						  'folderid' => $folderid,
						  'modulename' => $this->module,
						  'moduleid' => $moduleid,
						);
						if(isset($result['data']['module_name']) && $result['data']['module_name'] == 'choice')
						{
							$folder_data['modulename'] = 'choice';
						}
				$result_array = $this->Mod_doc->get_files_for_folder($folder_data);
				$system_file_name = array();

					$count_result_array = count($result_array);
					/*For loop to get the system file list from db*/
					for ($i=0; $i < $count_result_array; $i++) 
					{
						if (isset($result_array[$i]['ub_doc_file_id']) && !empty($result_array[$i]['ub_doc_file_id'])) 
						{
							$file_id = $result_array[$i]['ub_doc_file_id'];
							$exp = explode('/', DOC_PATH.$result_array[$i]['system_file_name']);
							$ext = pathinfo($exp[count($exp)-1], PATHINFO_EXTENSION);
							if (!empty($ext)) 
							{
								$system_file_name[$file_id] = $exp[count($exp)-1];
							}
						}
					}
				$delete_file = array_diff($system_file_name, $temp_file_name);
				if (!empty($delete_file)) 
				{
					foreach ($delete_file as $key => $value) 
					{
					  	$delete_data = array('flag' => $flag,'fileid' => $key,
							  'folderid' => $folderid,
							  'builderid' => $this->user_session['builder_id'],
							  'deletedby' => $this->user_session['ub_user_id']
							);
					  	//echo "<pre>";print_r($delete_data);exit;
						$result_array = $this->Mod_doc->delete_file($delete_data);
					} 
				}
				
				$add_file = array_diff($temp_file_name, $system_file_name);
				// echo '<pre>';print_r($add_file);exit;
				if (!empty($add_file)) 
				{
					foreach ($add_file as $key => $value) 
					{
						//echo "aaaaaaaaa-------".$module_name;
					  	$insert_file_data = array('filename' => $value,'folderid' => $result['data']['folderid'],'moduleid' => $moduleid);
					  	//echo "<pre>";print_r($insert_file_data);exit;
					  	if (isset($module_name) && !empty($module_name)) 
					  	{
					  		$this->insert_file($insert_file_data, $temp_directory_id, $module_name);
					  	}
					  	else
					  	{
					  		$this->insert_file($insert_file_data, $temp_directory_id);
					  	}
					}
					/* Task file upload mail code was added by chandru 15-06-2015 */
					if($this->module == 'task')
					{
						$task_table_insertid = $moduleid;
						/* Find task name, assigned users, project id based on task_id */
						$where_str = array('ub_task_id' => $task_table_insertid);
						$get_task_details = array(
							'select_fields' => array('ub_task_id','title','task_assigned_users','project_id'),
							'where_clause' => $where_str
							);
						$all_task_details = $this->Mod_task->get_task($get_task_details);
						$task_title = $all_task_details['aaData'][0]['title'];
						$task_assigned_users = $all_task_details['aaData'][0]['task_assigned_users'];
						$project_id = $all_task_details['aaData'][0]['project_id'];
						$post_array = array(
								'title' => $task_title,
								'project_id' => $project_id,
								'task_assigned_users' => $task_assigned_users
								);
						$send_mail_to_assigned_users_and_insert_in_notification = $this->Mod_task->send_mail_for_notification($post_array,$task_table_insertid);
					}
					/* Task file upload mail code was added by chandru 15-06-2015 ends here */
				}	
			}
		}
	}
	
	/**
	*
	* Function to move the file to name to Db and return the file relocation URL  
	*
	* @method: insert_file
	* @access: public 
	* @return: array
	* @URL: Zgxf19jL2luc2VydF9maWxlLw--
	*
	* #flag = 1 for upload from docs & photos menu
	* #flag = 0 for upload from other project specific modules like 'mom','log','task','bid','budget','message','schedule','selection','checklist','warranty'. In this case the folderid will also be 0.
	* #flag = 2 for upload from non project specific modules like lead, user, setup.
	*
	* ### insert_file() - Stored procedure input parameter order and count###
	* 1. flag (int) 
	* 2. builderid (int)
	* 3. projectid (VARCHAR)
	* 4. folderid (VARCHAR)
	* 5. filename (int)
	* 6. createdby (int)
	* 7. modulename (int)
	* 8. moduleid (VARCHAR)
	*/   
	public function insert_file($post_array = array(), $temp_directory_id = "", $module_name = '')
	{
		if( ! empty($post_array))
		{
			if (isset($module_name) && !empty($module_name) && $module_name != '') 
			{
				$this->module = $module_name;
			} 	
			if ($this->module == 'docs' || $this->module == 'photos') 
			{
				$flag = 1;
				$this->project_id = 0;
			}
			elseif ($this->module == 'leads' || $this->module == 'user' || $this->module == 'setup' || $this->module == 'activity') 
			{
				$flag = 2;
			}
			else
			{
				$flag = 0;
			}
			$file_data = array(	  'flag' => $flag, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'user_id'	=> $this->user_session['ub_user_id'],
								  'projectid' => $this->project_id,
								  'createdby' => $this->user_session['ub_user_id'],
								  'modulename' => $this->module,
								);
			$file_data['moduleid'] = $post_array['moduleid'];
			$file_data['folderid'] = $post_array['folderid'];
			$file_data['filename'] = $post_array['filename'];
			//echo "<pre>"; print_r($file_data);
			$result_array = $this->Mod_doc->insert_file($file_data);

			//echo "<pre>"; print_r($result_array);exit;

			/* Code to move the files from temp to actual dir*/
			$ext = pathinfo($result_array['0']['sys_file_name'], PATHINFO_EXTENSION);
			if ($result_array['0']['createfolderflag'] == 1 && !empty($ext)) 
			{
				$response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
				if(TRUE === $response['status'])
				{
					$session_id = $this->session->userdata('session_id');
					copy(DOC_TEMP_PATH.$session_id.'/'.$temp_directory_id.'/'.$result_array['0']['ui_file_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
				}
			}
			elseif (!empty($ext)) 
			{
				$session_id = $this->session->userdata('session_id');
				copy(DOC_TEMP_PATH.$session_id.'/'.$temp_directory_id.'/'.$result_array['0']['ui_file_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);	
			}
			else
			{
				echo "No file selected";
			}
		}
		else
		{
			//echo "the post array is empty. Please select some files to upload.";
		}
	}
	/**
	*
	* Function to get the file names from the temp dir.  
	*
	* @method: get_uploaded_filename
	* @access: public 
	* @return: array
	* @URL: cgxf1hvdgxf19zL2dldF91cgxf1xvYWRlZF9maWxlbmFtZS8-
	*
	* #flag = 0 - Pass folderid and get files
	* #flag = 1 - project related files
	* #flag = 2 - Non project related files
	*
	*/   
	public function get_uploaded_filename()
	{

		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if (isset($result['data']['projectid']) && !empty($result['data']['projectid'])) 
			{
				$this->project_id = $result['data']['projectid'];
			}
			else
			{
				$this->project_id = 0;
			}
			if(isset($result['data']['modulename']) && !empty($result['data']['modulename']) && $result['data']['modulename'] == 'poco') 
			{
			$this->module = $result['data']['modulename'];
			}
			//below if condition was added by satheesh kumar // For selection Choice file list 
			if(isset($result['data']['modulename']) && !empty($result['data']['modulename']) && $result['data']['modulename'] == 'choice') 
			{
			$this->module = $result['data']['modulename'];
			}
			if($this->module == 'projects')
			{
			$this->module = 'mom';
			}
			//echo "<pre>";print_r($result);exit();
			$session_id = $this->session->userdata('session_id');
			if(TRUE === $result['status'])
			{
				$moduleid = $result['data']['moduleid'];

					if ($this->module == 'docs' || $this->module == 'photos') 
					{
						$flag = 0;
						$folderid = 0;
					}
					else
					{
						if ($this->module == 'leads' || $this->module == 'user' || $this->module == 'setup') 
						{
							$flag = 2;
							$folderid = 0;
						}
						else
						{
							$flag = 1;
							$folderid = 0;
						}
					}
					
					$folder_data = array(	  'flag' => $flag, 
						  'builder_id'	=> $this->user_session['builder_id'],
						  'projectid' => $this->project_id,
						  'folderid' => $folderid,
						  'modulename' => $this->module,
						  'moduleid' => $moduleid,
						);
				$result_array = $this->Mod_doc->get_files_for_folder($folder_data);
				//echo "<pre>";print_r($result_array);exit;
      			$count = count($result_array);
      			$data = array();
				for ($i=0; $i < $count ; $i++) 
				{ 
					if (!empty($result_array[$i]['system_file_name'])) 
					{
						$exp = explode('/', $result_array[$i]['system_file_name']);
						if ($this->module == 'docs' || $this->module == 'photos') 
						{
							$system_file_name = $exp[count($exp)-1];
						}
						else
						{
							$system_file_name = $exp[count($exp)-2].'/'.$exp[count($exp)-1];
						}
						if (isset($result_array[$i]['ui_file_name']) && !empty($result_array[$i]['ui_file_name'])) 
						{
							$data[] = array('file_name' => $result_array[$i]['ui_file_name'],
										'size' => "177kb",	  
										'date' => $result_array[$i]['LastUpdated'],
										'file_path' => $result_array[$i]['system_file_name'],
										'fileid' => $result_array[$i]['ub_doc_file_id'],
										'sys_file_name' => $system_file_name
									);
						}
					}
				}
			
			//echo "<pre>";print_r($data);exit;
			$resposne['data'] = $data;
		 	$this->Mod_doc->response($resposne);
				
			}
		}
		else
		{
			echo "The post array is empty.";
		}
	}
	/**
	*
	* Function to soft delete the file in the DB   
	*
	* @method: delete_file
	* @access: public 
	* @return: array
	* @URL: Zgxf19jcy9kZWxldgxf1VfZmlsZS8-
	*
	*
	* ### delete_file() - Stored procedure input parameter order and count###
	* 1. flag (int) 
	* 2. fileid (int)
	* 3. folderid (int)
	* 4. builderid (int)
	* 5. deletedby (int)
	*
	* #flag = 0 - Delete all files in a folder hierarchy
	* #flag = 1 - Delete a single file
	* #flag = 2 - Delete all files in a folder
	*
	*/   
	public function delete_file($post_array = array())
	{
	//echo "<hi>";print_r($post_array);exit;
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			//print_r($result);exit;
			if ($this->module == 'subcontractor') 
			{
				$this->Mod_subcontractor->update_sub_file($result['data']['fileid']);
			}
			if ($this->module == 'budget') 
			{
				if(isset($result['data']['module_name']) && $result['data']['module_name'] == 'signature')
				{
				  $this->Mod_po_co->update_signature_file($result['data']['fileid']);
				}
				else
				{
				 $this->Mod_po_co->update_doc_file($result['data']['fileid']);
				}
				
			}
			if($this->module == 'projects')
			{
				$this->Mod_project->update_signoff_document_file($result['data']['fileid']);
			}
			
			
			$file_data = array(	  'flag' => 1, 
								  'fileid'	=> $result['data']['fileid'],
								  'folderid' => 0,
								  'builderid' => $this->user_session['builder_id'],
								  'deletedby' => $this->user_session['ub_user_id']
								);
				$result_array = $this->Mod_doc->delete_file($file_data);

				//echo "<pre>";print_r($result_array);
		}	
			
		 	$this->Mod_doc->response($result_array);
	}
	/**
	*
	* Function to download files   
	*
	* @method: delete_file
	* @access: public 
	* @return: array
	*/   

	function download_file($folderid = 0, $sys_file_name = '', $sys_folder_name = '' )
	{
			// Sanitize input
			/*echo $folderid ."<br>";
			echo  $sys_file_name."<br>";
			echo  $sys_folder_name."<br>"; 
			exit;*/
			$folder_data = array(	 
									  'folderid' => $folderid,
									  'builder_id' => $this->user_session['builder_id'],
									);
			$result_array = $this->Mod_doc->get_folder_path($folder_data);
			//echo "<pre>";print_r($result_array);exit;
			
			if ($this->module == 'docs' || $this->module == 'photos') 
			{
				$result['data']['file_path'] = DOC_PATH.$result_array['0']['folderpath'].$sys_file_name;
			}
			else
			{
				$result['data']['file_path'] = DOC_PATH.$result_array['0']['folderpath'].$sys_file_name.'/'.$sys_folder_name;
				$sys_file_name = $sys_folder_name;
			}
			
			//echo "<pre>";print_r($result['data']);exit;
			$this->load->helper('download');
			$data = file_get_contents($result['data']['file_path']);// Read the file's contents
			$name = $sys_file_name;
			
			force_download($name, $data);
			
	}
	/**
	*
	* Function to create the thumb while copying from actual to temp.   
	*
	* @method: delete_file
	* @access: public 
	* @return: array
	*/   

	function create_thumb($post_array = array())
	{
		if (!empty($post_array)) 
		{
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= $post_array['source_image'];
			$config['create_thumb'] 	= TRUE;
			$config['thumb_marker'] 	= '';
			
			$config['maintain_ratio'] 	= TRUE;
			$config['new_image']	 	= $post_array['new_image'];
			$config['width']         	= 80;
			$config['height']       	= 80;
			$this->image_lib->initialize($config); 
			//$this->load->library('image_lib', $config);

			$this->image_lib->resize();
		}
	}

	public function allowed_extension()
	{
		if(!empty($this->input->post()))
		{	
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$extension = $result['data']['ext'];
				$arrayName = explode(',', ALLOWED_EXTENSION);
				$result = array_search($extension, $arrayName);
				if (isset($result) && !empty($result)) {
					$response['status'] = TRUE;
				} 
				else 
				{
					$response['status'] = FALSE;
				}
			} 
			else 
			{
				$response['status'] = FALSE;;
			}
		} 
		else 
		{
			$response['status'] = FALSE;
		}
		return $this->Mod_project->response($response);
	}
	/**
	*
	* get left collapse menu 
	*
	* @method: get_left_collapse_menu
	* @access: public 
	* @return: array
	*/   

	function get_left_collapse_menu()
	{
		$response = $this->Mod_project->destroy_session(array('module_name' => 'COMMON_PROJECT'));
		$this->Mod_budget->response($response);
	}

	function format_drop_down_values($data = '')
    {
        $dropdown_arr = array_filter(explode(",",$data));
        $dropdown_data[0] = array('key'=>'', 'value'=>'Nothing selected');
        foreach ($dropdown_arr as $key => $value) 
        {
        	$dropdown_data[] = array('key'=>$value, 'value'=>$value);
        }
        $dropdown_array = $this->Mod_custom_settings->build_ci_dropdown_array($dropdown_data,'key', 'value');
        return $dropdown_array;
    }

	
	/** 
	* get_builder_logo
	* 
	* @method: get_builder_logo 
	* @access: public 
	* @param: 
	* @param: 
	* @return:
	*/
	public function get_builder_logo()
	{	
		$this->module = 'BUILDER_LOGO';
		$logo_data = array(	  'flag' => 2, 
							  'builder_id'	=> $this->builder_id,
							  'projectid' => 0,
							  'folderid' => 0,
							  'modulename' => 'setup',
							  'moduleid' => $this->builder_id
							);
		$logo_result = $this->Mod_doc->get_files_for_folder($logo_data);
		foreach($logo_result as $logo_array)
		{
			//$arr[] = $logo_array['system_file_name'];
			if(isset($logo_array['system_file_name']) && !empty($logo_array['system_file_name']))
			{
				$ext = pathinfo($logo_array['system_file_name'], PATHINFO_EXTENSION);
				if(!empty($ext))
				{
					$session_array['builder_logo'] = DOC_URL.$logo_array['system_file_name'];
					$this->builder_logo_url = $session_array['builder_logo'];
					$this->uni_set_session('LOGO_URL', $session_array);
				}
			}
		}
		/* if(isset($logo_result['0']['ub_doc_file_id']) && !empty($logo_result['0']['ub_doc_file_id']))
		{
			$session_array['builder_logo'] = DOC_URL.$logo_result['0']['system_file_name'];
			$this->builder_logo_url = $session_array['builder_logo'];
			$this->uni_set_session('LOGO_URL', $session_array);
		} */
		// echo '<pre>';print_r($this->session->all_userdata());exit;
		// echo '<pre>';print_r($arr);exit;
	}

	/**
	* Functuon to switch project view to template view
	*
	* @method: switch_template 
	* @access: Public 
	* @param:  
	* @return: 
	*
	*/
	public function switch_template()
	{
		if(!empty($this->input->post()))
		{	
			//Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Set value in session
				$session_array['display_type'] = $result['data']['display_type'];
				$this->module = 'TEMPLATE';
				if($session_array['display_type'] == 'template_view')
				{
					$response_status= $this->uni_set_session('VIEW_NAME', $session_array);
					$response['status'] = $response_status;
					$response['redirect_url'] = base_url().$this->crypt->encrypt('template/projects/index/');
				}
				else
				{
					$response = $this->Mod_project->destroy_session(array('module_name' => 'TEMPLATE'));
					$response['redirect_url'] = base_url().$this->crypt->encrypt('builder_dashboard');
				}
			} 
			else 
			{
				$response['status'] = FALSE;
				$response['message'] = 'Template switching has some issue, please try agian later';
			}
		} 
		else 
		{
			$response['status'] = FALSE;
			$response['message'] = 'Template switching has some issue, please try agian later';
		}
		// echo '<pre>';print_r($response);exit;
		return $this->Mod_project->response($response);
	}
	
	/** 
	* set_user_template_list
	* 
	* @method: set_user_template_list 
	* @access: public 
	* @param: 
	* @param: 
	* @return:
	*/
	public function set_user_template_list()
	{
		$this->module = 'TEMPLATE_LIST';
		//echo '<pre>';print_r($this->session->all_userdata());exit;
		$where_str = 'TEMPLATE.builder_id = '.$this->builder_id;
			
		$template_list = $this->Mod_template->get_template(array(
					'select_fields' => array('TEMPLATE.ub_template_id','TEMPLATE.template_name'),
					'where_clause' => $where_str
					));
		// echo '<pre>';print_r($template_list);
		if(isset($template_list) && TRUE === $template_list['status'])
		{
			$fmt_template_list = $this->Mod_project->build_ci_dropdown_array($template_list['aaData'],'ub_template_id', 'template_name','multiple');
			$this->uni_set_session('COLLAPSE_TEMPLATE_LIST', $fmt_template_list);
			$this->users_template_list = $fmt_template_list;
			$this->users_template_ids = implode(",", array_keys($this->users_template_list));
			// echo '<pre>';print_r($this->session->all_userdata());exit;
		}
	}
	/** 
	* set template id in session
	* 
	* @method: set_template_info_in_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	* @created by: satheesh kumar
	* @created on: 28/07/2015 
	*/
	public function set_template_info_in_session($template_info)
	{
		 if(count($template_info)> 0)		
		{
			if($template_info['template_id'] == 'all_template')
			{	
				$response = $this->Mod_template->destroy_session(array('module_name' => 'COMMON_TEMPLATE'));
			}
			else
			{
				// Set value in session
				$search_session_array['template_id'] = $template_info['template_id'];
				$search_session_array['template_name'] = $template_info['template_name'];
				//$search_session_array['template_status'] = $template_info['project_status'];
				$response_status= $this->uni_set_session('TEMPLATE', $search_session_array);
				$response['status'] = $response_status;
			}
		}
		return $response;
			
	}
}