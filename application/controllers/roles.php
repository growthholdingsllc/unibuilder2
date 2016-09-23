<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Role Class
 * 
 * @package: Rolee
 * @subpackage: Role
 * @category: Role
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 14-03-2015 
*/
class Roles extends UNI_Controller {
	/**
	 * @property: $module
	 * @access: public
	 */
	public $module = '';
	/**
	 * @constructor
	 */
	public function __construct()
    { 
        parent::__construct();
		$this->load->model(array('Mod_role','Mod_general_value','Mod_timezone','Mod_user','Mod_saved_search','Mod_grid_settings','Mod_custom_settings'));
		$this->module = 'roles';
    }
	/** 
	* Get all roles
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
		'content'      => 'content/roles/roles',
        'page_id'      => 'roles',
		'data_table'   =>'data_table',
		'role_list'	   =>'role_list',      
		'date_all'	   =>'date_all',
		'new_role_url' => $this->crypt->encrypt('roles/new_role/'),
		'current_url' => $this->uri->segment(1),
		'delete_roles_url' => $this->crypt->encrypt('roles/delete_roles/'),
		'get_roles_url' => $this->crypt->encrypt('roles/get_roles/'),
		'sess_role_active' => isset($this->account_session[$this->user_session['account_type']]['ROLES']['SEARCH']['role_active'])?$this->account_session[$this->user_session['account_type']]['ROLES']['SEARCH']['role_active']:'',
		'sess_role_name' => isset($this->account_session[$this->user_session['account_type']]['ROLES']['SEARCH']['role_name'])?$this->account_session[$this->user_session['account_type']]['ROLES']['SEARCH']['role_name']:'',
		);
		$args = array('select_fields' => array('ub_grid_settings_id', 'module_name','is_default' ,'list_view_name', 'display_fields', 'display_field_joins'), 
					  'where_clause' => array('builder_id' => $this->builder_id, 'user_id' => $this->user_id)
					 );
		$user_grid_settings  = $this->Mod_grid_settings->get_grid_settings($args);
		$grid_settings = $user_grid_settings['aaData'];
		// echo '<pre>';print_r($formatted_dropdown);exit;
		$args = array(BUILDERADMIN => array('builder_id' => $this->builder_id, 'account_type' => BUILDERADMIN), OWNER => array('builder_id' => $this->builder_id, 'account_type' => OWNER), SUBCONTRACTOR => array('builder_id' => $this->builder_id, 'account_type' => SUBCONTRACTOR));
		$data['all_type_users'] = $this->Mod_user->get_users_by_type($args);
		// echo '<pre>';print_r($data['all_type_users']);exit;
		$this->template->view($data);			
	}
	/** 
	* Add roles
	* 
	* @method: new_role 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/	
	public function new_role()
	{
		if(!empty($this->input->post()))
		{
			// Add role
			$result = $this->sanitize_input();
			if(isset($result['data']['save_type']))
			{
				unset($result['data']['save_type']);
			}
			if(TRUE === $result['status'])
			{
				$response = $this->Mod_role->add_role($result['data']);
				$this->Mod_role->response($response);		
			}
			else
			{
				$this->Mod_role->response($result);
			}
		}
		else
		{
			// Display add page
			$data = array(
			'title'        => "UNIBUILDER",		
			'content'      => 'content/roles/new_role',
			'date_all'	   =>'date_all'  
			);
			$this->template->view($data);
		}
	}
	/** 
	* Edit roles
	* 
	* @method: edit_role 
	* @access: public 
	* @param:  role id
	* @return:  response array
	*/
	public function edit_role($role_id = 0)
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			// Creating post array -  this will come from view page
			$result['data'] = array(
				'role_name' => 'Marketing Manager',
				'role_active' => 'Yes',
				'ub_role_id' => 6,
				'save_type' => 'save_and_stay',
				'role_access' => array( array(
					'menu_id' => 1,
					'access_rights' => array(
						'View' => 1,
						'Add' => 0,
						'Edit' => 0,
						'Delete' => 0,
						'ExportProjects' => 0
						),
					),array('menu_id' => 2,
					'access_rights' => array(
						'View' => 1,
						'Add' => 0,
						'Edit' => 0,
						'Delete' => 0,
						'ExportProjects' => 0
						)
				)
				)
					
			);
			// End of creating post array
			$role_access_data = array();
			for($i=0;$i < count($result['data']['role_access']);$i++)
			{
				$role_access_data[$i]['role_id'] = $result['data']['ub_role_id'];
				$role_access_data[$i]['menu_id'] = $result['data']['role_access'][$i]['menu_id'];
				$role_access_data[$i]['access_value'] = $this->Mod_role->bintodecimal(implode('',$result['data']['role_access'][$i]['access_rights']));
				
			}
			// $response = $this->Mod_role->update_role_access($role_access_data);
			echo "com33..."; print_r($role_access_data); exit;
			
			if(isset($result['data']['save_type']))
			{
				unset($result['data']['save_type']);
			}
			if(TRUE === $result['status'])
			{
				//Array to update role table
				$role_data = array('role_name' => $result['data']['role_name'], 'role_active' => $result['data']['role_active'], 'ub_role_id' => $result['data']['ub_role_id']);
				
				// Update Access level details
				$response = $this->Mod_role->update_role_access($result['data']);
				
				// Update Role
				$response = $this->Mod_role->update_role($role_data);
				$this->Mod_role->response($response);		
			}
			else
			{
				$this->Mod_role->response($result);
			}
		}
		else
		{
			$result_data = array();
			if($role_id > 0)
			{
				//Get the menu list
				$builderid=$this->user_session['builder_id'];
				$groupby_menuid = 'ACCESSLEVEL.menu_id';
				$menu_list = $this->Mod_role->get_menus(array(
												'select_fields' => array('MENU.menu_name','MENU.ub_menu_id','GROUP_CONCAT(ACCESSLEVEL.access_name ORDER BY ACCESSLEVEL.display_order ASC SEPARATOR ", ") AS access_name'),
												'join'=> array('menu_access_level'=>'Yes'),
												'where_clause' => (array('MENU.builder_id' =>  $builderid)),
												'groupby_clause' => $groupby_menuid
												));
				
				$menu_list = $menu_list['menulist'];
				//Below loop will build array for access name
				for($i=0;$i<count($menu_list);$i++)
				{
					$menu_list[$i]['access_name'] = explode(",",$menu_list[$i]['access_name']);
				} 
				
				
				$groupby_clause = 'ACCESSLEVEL.menu_id';
				$result_data = $this->Mod_role->get_roles_access(array(
												'select_fields' => array('MENU.menu_name','ACCESSLEVELDETAILS.menu_id',
												'ACCESSLEVELDETAILS.ub_access_level_details_id',
												'CONV(ACCESSLEVELDETAILS.access_value,10,2) AS access_rights', 'GROUP_CONCAT(ACCESSLEVEL.access_name ORDER BY ACCESSLEVEL.display_order ASC SEPARATOR ", ") AS access_name'),
												'join'=> array('menu_access_level_details'=>'Yes'),
												'where_clause' => (array('ACCESSLEVELDETAILS.role_id' =>  $role_id)),
												'groupby_clause' => $groupby_clause
												));
				
				//Below loop will build array for access name and access rights
				$menu_access_list = $result_data['accessdetails'];
				for($i=0;$i<count($menu_access_list);$i++)
				{
					$menu_access_list[$i]['access_name'] = explode(",",$menu_access_list[$i]['access_name']);
					$menu_access_list[$i]['access_rights'] = str_split($menu_access_list[$i]['access_rights']);
				} 
				   echo "<pre>"; print_r($menu_list);exit;
				$data = array(
				'title'        => "UNIBUILDER",		
				'content'      => 'content/roles/edit_role',
				'date_all'	   =>'date_all',
				'result_data' => $result_data
				);
				$this->template->view($data);
			}
		}		
	}
	/** 
	* Get roles
	* 
	* @method: get_roles 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/	
	public function get_roles()
	{
		$post_array =  array('builder_id'=>$this->user_session['builder_id']);
		$total_count_array =  array();
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Search Input Array
				if(isset($result['data']['role_name']) && $result['data']['role_name']!='')
				{
					$post_array['ROLE.role_name'] = $result['data']['role_name'];
					// Set value in session
					if(@array_key_exists('SEARCH', $this->account_session[$this->user_session['account_type']]['ROLES']))
					{
						$this->account_session[$this->user_session['account_type']]['ROLES']['SEARCH']['role_name'] =$result['data']['role_name'];
					}
					else
					{
						$this->account_session[$this->user_session['account_type']]['ROLES'] = array('SEARCH'=>array('role_name'=>  $result['data']['role_name']));
					}
		
				}
				if(isset($result['data']['role_active']) && $result['data']['role_active']!='')
				{
					$post_array['ROLE.role_active'] = $result['data']['role_active'];
					// Set value in session
					// $this->account_session[$this->user_session['account_type']]['ROLES'] = array('SEARCH'=>array('role_active'=>  $result['data']['role_active']));
					if(@array_key_exists('SEARCH', $this->account_session[$this->user_session['account_type']]['ROLES']))
					{
						$this->account_session[$this->user_session['account_type']]['ROLES']['SEARCH']['role_active'] = $result['data']['role_active'];
					}
					else
					{
						$this->account_session[$this->user_session['account_type']]['ROLES'] = array('SEARCH'=>array('role_active'=>  $result['data']['role_active']));
					}
				}
				$this->session->set_userdata('ACCOUNT', $this->account_session);
				// Pagination Array
				$pagination_array = array();
				if(isset($result['data']['iDisplayStart']) && isset($result['data']['iDisplayLength']) && isset($result['data']['sEcho']))
				{
					$pagination_array = array( 'iDisplayStart' => $result['data']['iDisplayStart'],'iDisplayLength' => $result['data']['iDisplayLength'], 'sEcho' => $result['data']['sEcho']);
					// Get number of records
					$total_count_array = $this->Mod_role->get_roles(array(
												'select_fields' => array('COUNT(ROLE.ub_role_id) AS total_count'),
												'where_clause' => $post_array,
												));
				}
				// Order by
				$order_by_where = '';
				if(isset($result['data']['iSortCol_0']) && $result['data']['iSortCol_0'] >  0)
				{
					$sort_type = $result['data']['sSortDir_0'];
					$sort_filed_column_id = $result['data']['iSortCol_0'];
					$dt_filed_name = 'mDataProp_';
					$order_by_where = 'ROLE.'.$result['data'][$dt_filed_name.$sort_filed_column_id].' '.$sort_type;
				}
				
			}
			else
			{
				$this->Mod_role->response($result);
			}
		}
		// Fetch Data all records based on conditions
		$datetime_array = array('created_on', 'modified_on');
		$this->Mod_user->format_user_datetime($datetime_array);
		$result_data = $this->Mod_role->get_roles(array(
												'select_fields' => array('ROLE.ub_role_id', 'ROLE.builder_id', 'ROLE.role_name', 'ROLE.role_active', 'ROLE.created_on', 'ROLE.modified_on'),
												'join'=> array('builder'=>'Yes'),
												'where_clause' => $post_array,
												'order_clause' => $order_by_where,
												'pagination' => $pagination_array
												));
												// echo '<pre>';print_r($result_data);exit;
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
		$this->Mod_role->response($result_data);
	}
	/** 
	* Delete roles
	* 
	* @method: delete_roles 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	public function delete_roles()
	{		
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				// Delete functionality
				$response = $this->Mod_role->delete_roles($result['data']);
			}
			else
			{
				$this->Mod_role->response($result);
			}
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
		// Response data
		$this->Mod_role->response($response);
	}
	/** 
	* Destroy Session
	* 
	* @method: destroy_session 
	* @access: public 
	* @param:  ajax post array
	* @return: array 
	*/
	public function destroy_session()
	{
		if(!empty($this->input->post()))
		{
			// Sanitize input
			$result = $this->sanitize_input();
			if(TRUE === $result['status'])
			{
				$result = $this->Mod_role->destroy_session($result['data']);
			}
			$this->Mod_role->response($result);
		}
		else
		{
			$response['status'] = FALSE;
			$response['message'] = 'Delete Failed: Post array is empty';
		}
	}
	/** 
	* Fetch General Value
	* 
	* @method: get_general_value 
	* @access: public 
	* @param:
	* @return: array 
	* url encoded : cm9sZXMvZ2V0X2dlbmVyYWxfdmFsdWUv
	*/
	public function get_general_value()
	{
		$args = array('classification'=>'lead_source', 'where_clause' => '("int01" = 0 OR "int01" = '.$this->user_session['builder_id'].')');
		$result = $this->Mod_general_value->get_general_value($args);
		// Only required for custom fields
		$formatted_array = $this->Mod_general_value->format_custom_values($result);
	}
	/** 
	* Insert / Update General value
	* 
	* @method: update_general_value 
	* @access: public 
	* @param: ajax post array
	* @return: array 
	* url encoded : cm9sZXMvdXBkYXRlX2dlbmVyYWxfdmFsdWUv
	*/
	public function update_general_value()
	{
		$args = array('classification'=>'lead_source', 'type' => 'delete' ,'value' => 'Amazone1');
		$result = $this->Mod_general_value->update_general_value($args);
		echo '<pre>';print_r($result);exit;
	}
	/** 
	* Get Time zones
	* 
	* @method: get_timezone 
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded : cm9sZXMvZ2V0X3RpbWV6b25lLw--
	*/
	public function get_timezone()
	{
		// Fetch timezone to display
		$timezone = $this->Mod_timezone->get_timezone();
		// echo '<pre>';print_r($timezone);exit;
		
		// Fetch date format to display	
		// $args = array('classification'=>'user_date_format');
		// $date_format_array = $this->Mod_general_value->get_general_value($args);
		
		// echo '<pre>';print_r($date_format_array);exit;
		
		// Understanding of GM Date
		date_default_timezone_set('America/Los_Angeles');
		// echo "Current Date - timezone ".date_default_timezone_get()." : - ".date('Y-m-d H:i:s');
		// date_default_timezone_set('Asia/Kolkata');
		// echo "<Br>Current GM Date : ".TODAY;
		// echo "<br>Current Date - timezone ".date_default_timezone_get()." : - ".date('Y-m-d H:i:s');
		// echo "<Br>Current GM Date : ".TODAY;exit;
		
		// Fetching datetime / date
		$datetime_array = array('last_login_time', 'last_logout_time');
		
		$date_array = array('created_on', 'modified_on');
		// echo '<pre>';print_r($this->user_session);exit;
		$this->db->select('first_name, last_login_time AS last_login_time_before_format, last_logout_time AS logout_time_before_format, '.$this->Mod_user->format_user_datetime($datetime_array).', created_on AS created_on_before_format, modified_on AS modified_on_before_format, '.$this->Mod_user->format_user_datetime($date_array,"date"), false);
		$this->db->from(UB_USER);
		$this->db->where(array('ub_user_id' => 2));
		$res = $this->db->get();
		echo $this->db->last_query();
		if($res->num_rows() > 0)
		{
			echo '<pre>';print_r($res->result_array());exit;
		}
		
	}
	/** 
	* Building where conditions
	* 
	* @method: build_where 
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded : cm9sZXMvYnVpbgxf1Rfd2hlcmUv
	*/
	public function build_where()
	{
	// echo '<pre>';print_r($this->session->all_userdata());exit;
		$post_array = array( array(
								'field_name' => 'name',
								'value'=> 'abc', 
								'type' => 'like'
							),
							array(
								'field_name' => 'status',
								'value'=> 'Open', 
								'type' => '='
							),
							array(
								'field_name' => 'ub_user_id',
								'value'=> '2', 
								'type' => '||',
								'classification' => 'primary_ids'
							),
							/* array(
								'field_name' => 'lead_age',
								'value'=> '14', 
								'type' => '=',
								'classification' => 'reminder'
							), */
							array(
								'field_name' => 'lead_tags',
								'value'=> 'East Coast, GOA', 
								'type' => '||',
								'classification' => 'dynamnic_text'
							),
							array(
								'field_name' => 'lead_source',
								'value'=> 'Contact Form,Google,Referral', 
								'type' => '||',
								'classification' => 'dynamnic_text'
							),
							array(
								'field_name' => 'created_on',
								// 'from'=> '2015-03-01', 
								'to'=> '2015-03-20', 
								'type' => 'daterange'
							),
						);
		$this->Mod_role->build_where($post_array);
	}
	/** 
	* Get Saved Search
	* 
	* @method: get_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded : cm9sZXMvZ2V0X3NhdmVkX3NlYXJjaC8-
	*/
	public function get_saved_search()
	{
		// echo 'savedsearch';exit;
		// $post_array = array( 'builder_id' => $this->user_session['builder_id'],
							// 'user_id' => $this->user_session['ub_user_id'],
							// 'module_name' => $this->module
		// );
		// $result_data = $this->Mod_saved_search->get_saved_search(array(
												// 'select_fields' => array(),
												// 'where_clause' => $post_array
												// ));
												
		// echo '<pre>';print_r($result_data);exit;
		$post_array = array(
			'ub_saved_search_id' => 2,
			'search_params' => "{'role_name':'abc', 'role_status':'Active'}"
		);
		$response = $this->Mod_saved_search->update_saved_search($post_array);
		echo '<pre>';print_r($response);exit;
	}
	/** 
	* Get Saved Search
	* 
	* @method: get_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded : cm9sZXMvZW5jcnlwdF9hbmRfZgxf1VjcnlwdC8-
	*/
	public function encrypt_and_decrypt()
	{
		echo "Encrypt ---: ".$dry = $this->ci_encrypt('50');
		echo '<br>Decrypt ---: '.$this->ci_decrypt($dry);exit;
	}
	/** 
	*Zip download
	* 
	* @method: get_saved_search 
	* @access: public 
	* @params: 
	* @return: array 
	* url encoded : cm9sZXMvemlwX2Rvd25sb2Fk
	*/
	public function zip_download()
	{
		$this->load->library('zip');
		/* $name = 'mydata1.txt';
		$data = 'A Data String!';

		$this->zip->add_data($name, $data);

		// Write the zip file to a folder on your server. Name it "my_backup.zip"
		$this->zip->archive(DOC_PATH.'my_backup.zip');

		// Download the file to your desktop. Name it "my_backup.zip"
		$this->zip->download('my_backup.zip');  */
		$path = DOC_PATH.'3PrestigeBuilders/';

		$this->zip->read_dir($path,FALSE);

		// Download the file to your desktop. Name it "my_backup.zip"
		$this->zip->download('my_backup.zip'); 
	}
	//url:cm9sZXMvZmlsZV9zdHJ1Y3R1cmU-
	public function file_structure()
	{
		 // $rows[0] = array('id' => 1, 'parent_id' => 0, 'title' => 'Parent Page');
		// $rows[1] = array('id' => 2, 'parent_id' => 1, 'title' => 'Sub Page');
		// $rows[2] = array('id' => 3, 'parent_id' => 1, 'title' => 'Sub Sub Page');
		// $rows[3] = array('id' => 4, 'parent_id' => 2, 'title' => 'Another Parent Page');
		
		$rows = array(
					array(
						'id' => 33,
						'parent_id' => 0,
					),
					array(
						'id' => 34,
						'parent_id' => 0,
					),
					array(
						'id' => 27,
						'parent_id' => 33,
					),
					array(
						'id' => 100,
						'parent_id' => 33,
					),
					array(
						'id' => 17,
						'parent_id' => 27,
					),
				);
		$tree = $this->buildTree($rows);
		echo '<pre>';print_r($tree);exit;
	}
	public function buildTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = $this->buildTree($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}
		return $branch;
	}
	// url : cm9sZXMvY3liZXJzb3VyY2Vfcgxf1F5bWVudA--
	public function cybersource_payment()
	{
		error_reporting(0);
		require(APPPATH.'libraries/Eps_cybersource.php');
		// $this->load->library('eps_cybersource');
		/**
		* These should go in a config file somewhere on the box.
		*/
		$trans_key ='fmr125HtGeE0AnSGUpMq1HmB8xD8DIzmk7KFICavjOgXtOuhFlbjEcrkYdf7EYhPwSMItt4KXY/DYVODbYSQ3vUev8VgLuQnRUj7q+nrds6ueXOAebSNLDMepfBm5Dl08435CwuEyJ6HxfBVJH8jMcGrC97z/041KUSkKdIuJxZRb/zcmzkRpwEHSy604yyVuRu0jiTCZkZxcVprGrvtROH1voI2gBQ563ioilZJ1ICXTosowWjxaS8FTAgLv/xz/Ynw38RIzd6ucbdH3j0Bd7nBgRSQesEgEG1Cg/XnHHAWAX49uYY1evIqI80A+uEblOJUeVyVUwqQU5pn5Vi77w==';
		$merchant_id = 'ttkservices_ub';
		$url = 'https://ics2wstest.ic3.com/commerce/1.x/transactionProcessor/CyberSourceTransaction_1.53.wsdl';

		/**
		* These are sent from some GUI and assembled into the applicable arrays.
		*/

		$bill_array = array('firstName'=>'Gopakumar','lastName'=>'K','street1'=>'Ferns Icon','city'=>'Mountain View','state'=>'CA','postalCode' => '94043','country'=>'US','email'=> 'gopakumar.k@ttkservices.com','ipaddress'=>'10.7.111.111');

		$card_array = array('accountNumber'=>'4111111111111111','expirationMonth'=>'12', 'expirationYear'=>'2020','cvNumber'=>'123');

			
		$item_array = array(
			array('unitPrice'=>'10.10','quantity'=>2,'productName'=>'Apple Iphone'),
			array('unitPrice'=>'2.5','quantity'=>5,'productName'=>'product two')
			);
		$custom_array = array('one','two','three','four');

		/**
		* Authorize a transaction.
		*/
		try 
		{
			$soap = new EPS_CYBERSOURCE($url, $merchant_id,$trans_key);
			$soap->setMerchantDefinedData($custom_array);
			$soap->setReferenceCode(array('CSTEST','YYYY','J','-','RNDM'));
			$soap->setCCRequest($bill_array,$card_array,$item_array);
			$soap->ccAuthorize();
		} 
		catch (SoapFault $e) 
		{
			exit($e->getMessage());
		}

		print'<pre>Authorize a transaction. ';print_r($soap->reply);

		/**
		* Capture the successful authorization.
		* A single ccCapture() could have been done instead of a ccAuthorize() followed by a ccCapture().
		*/
		if ($soap->success) $soap->ccCapture();

		/**
		* These return values would be stored locally.
		*/
		// $tok = $soap->reply->requestToken;
		// $id = $soap->reply->requestID;
		// $rc = $soap->reply->merchantReferenceCode;
		// $amount = $soap->reply->amount;
		// $currency = $soap->reply->currency;

		print'<pre>Capture the successful authorization. ';print_r($soap->reply);
	}
	// URL : cm9sZXMvY2M-
	public function cc()
	{
		// include "Encryption.class.php"; // Include Class
		// $key = "83c39eWrg76fSdrt"; // Encryption Key
		// $crypt = new Encryption($key);
		// $this->load->library('ccencryption');
		
		$args = array('classification'=>'cc_encryption_key');
		$cc_encryption_key = $this->Mod_general_value->get_general_value($args);
		$this->load->library('ccencryption' , array('key' => $cc_encryption_key['values']['0']['value']));
							
		// $number = '4356789434679645'; // your credit card number
		$number = '41111111111111111'; // your credit card number

		$encrypted_string = $this->ccencryption->encrypt($number); // Encrypt your credit card number

		$decrypted_string = $this->ccencryption->decrypt($encrypted_string); // Decrypt your encrypted string.

		// Show Results

		echo "number: $number";
		echo "<br><br>";
		echo "encrypted_string: $encrypted_string";
		echo "<br><br>";
		echo "decrypted_string: $decrypted_string";
	}
	// cm9sZXMvY3Vzdgxf19t
	public function custom()
	{
		// Get custom fields
		$where_ary = array('ub_custom_field_id'=>1);
		$get_custom_data = $this->Mod_custom_settings->get_custom_fields(array('where_clause'=>$where_ary));
		echo '<pre>get_custom_data';print_r($get_custom_data);
		// insert / update update_custom_fields
		$insert_ary = array('label_name'=>'Project Label', 'module_name' => 'Tasks', 'classification' => 'task_custom_fields');
		$insert_reponse = $this->Mod_custom_settings->update_custom_fields($insert_ary);
		echo '<pre>insert_reponse';print_r($insert_reponse);
		
		// insert / update update_custom_fields
		$update_ary = array('ub_custom_field_id' => 1, 'label_name'=>'Project Label iiiii', 'module_name' => 'Tasks', 'classification' => 'task_custom_fields');
		$update_response = $this->Mod_custom_settings->update_custom_fields($update_ary);
		echo '<pre>update_response';print_r($update_response);
	}
}