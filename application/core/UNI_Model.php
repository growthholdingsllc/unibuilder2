<?php
/** 
 * Saved Search
 * 
 * @package: Saved Search
 * @subpackage:  
 * @category: Core
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 01-03-2015 
*/
class UNI_Model extends CI_Model{
	/**
	 * @property: $read_db
	 * @access: protected
	 */
	protected $read_db = '';
	/**
	 * @property: $write_db
	 * @access: protected
	 */

	protected $write_db = '';
	/**
	 * @property: $session_db
	 * @access: protected
	 */
	protected $session_db = '';
	/** 
	* Constructuer
	* 
	* @method: __construct 
	* @access: public 
	* @param: 
	* @return: constricter initialized
	*/
    public function __construct()
	{
        parent::__construct();
		$this->read_db = $this->load->database('readdb', TRUE);
		$this->write_db = $this->load->database('writedb', TRUE);
		$this->session_db = $this->load->database('sessiondb', TRUE);
    }
	/** 
	* Get Mail Template
	* 
	* @method: destruct
	* @access: public 
	* @param:  
	* @return: object destructed 
	*/
	public function destruct()
	{
	}
	/** 
	* Response giving in JSON format
	* 
	* @method: response 
	* @access: public 
	* @param: data array
	* @return: json data 
	*/
	public function response($data)
	{
		echo trim(json_encode($data));exit;
	}
	/** 
	* Response giving in integer
	* 
	* @method: converting binary to decimal value 
	* @access: public 
	* @param: data
	* @return: decimal value
	*/
	public function bintodecimal($data)
	{
		return bindec($data);
	}
	/** 
	* Destroy session - Destroy a module / each key inside a module
	* 
	* @method: destroy_session 
	* @access: public 
	* @param: data array
	* @return:
	*/
	public function destroy_session($args = array())
	{
		if(!empty($args))
		{	
			if(isset($args['logout']) && 'Yes' === $args['logout'])
			{
				$this->session->sess_destroy();
				$data['status'] = TRUE;
				$data['message'] = 'Session destroyed successfully';
			}
			else
			{
				$unset_data = $this->account_session[$this->user_session['account_type']];
				if(isset($args['destroy_type']))
				{
					foreach($args['destroy_type'] as $key=>$value)
					{
						unset($unset_data[strtoupper($args['module_name'])][strtoupper($value)]);
					}
				}
				else
				{
					unset($unset_data[strtoupper($args['module_name'])]);
				}
				$this->account_session = array($this->user_session['account_type']=> $unset_data);
				$this->session->set_userdata('ACCOUNT', $this->account_session);
				$data['status'] = TRUE;
				$data['message'] = 'Session destroyed successfully';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Empty array';
		}
		return $data;
	}
	/** 
	* Building where condition
	* 
	* @method: build_where 
	* @access: public 
	* @param: post array
	* @return:
	*/
	public function build_where($post_array = array())
	{
		if(!empty($post_array))
		{
			$where_str ='';
			foreach($post_array as $key => $val)
			{
				switch ($val['type']) {
					case "||":
						if(strpos($val['value'], ',') !== FALSE)
						{
							// Multiple values
							$exp_array = explode(',', $val['value']);
							if(isset($val['classification']) && $val['classification'] == 'primary_ids')
							{
								array_walk($exp_array,array($this,"equals_format"),$val['field_name']);
							}
							else
							{
								array_walk($exp_array,array($this,"find_in_set_format"),$val['field_name']);
							}
							if('' == $where_str)
							{
								
								$where_str = "(".implode( $val['type'] , $exp_array).")";
							}
							else
							{
								$where_str .= " AND (".implode( $val['type'] , $exp_array).")";
							}
						}
						else
						{
						
							// Single value
							if(isset($val['classification']) && $val['classification'] == 'primary_ids')
							{
								if('' == $where_str)
								{
									$where_str = $val['field_name']. " = '".$val['value']."'";
								}
								else
								{
									$where_str .= " AND ".$val['field_name']." = '".$val['value']."'";
								}
							}
							else if(isset($val['classification']) && $val['classification'] == 'dynamnic_text')
							{
								if('' == $where_str)
								{
									$where_str = " FIND_IN_SET('".$val['value']."', ".$val['field_name'].")";
								}
								else
								{
									$where_str .= " AND FIND_IN_SET('".$val['value']."', ".$val['field_name'].")";
								}
							}
							else
							{
								if('' == $where_str)
								{
									$where_str = $val['field_name']. " ". $val['type'] ." '".$val['value']."'";
								}
								else
								{
									$where_str .= " AND ".$val['field_name']." ". $val['type'] ." '".$val['value']."'";
								}
							}
						}
						break;
					case "=":
					case "!=":
						// Single value
						if('' == $where_str)
						{
							$where_str = $val['field_name'] ." ". $val['type'] ." '".$val['value']."'";
						}
						else
						{
							$where_str .= " AND ".$val['field_name'] ." ". $val['type'] ." '".$val['value']."'";
						}
						break;
					case "IS":
					case "IS NOT":
						// Single value
						if('' == $where_str)
						{
							$where_str = $val['field_name'] ." ". $val['type'] ." ".$val['value']."'";
						}
						else
						{
							$where_str .= " AND ".$val['field_name'] ." ". $val['type'] ." ".$val['value']."";
						}
						break;
					case "like":
						// Single value
						if('' == $where_str)
						{
							$where_str = $val['field_name']." ". $val['type'] ." '%".$val['value']."%'";
						}
						else
						{
							$where_str .= " AND ".$val['field_name']." ". $val['type'] ." '%".$val['value']."%'";
						}
						break;
					case "daterange":
						$date_condition = '';
						if(isset($val['from']) && $val['from'] !='' && isset($val['to']) && $val['to'] !='')
						{
							$date_condition = $val['field_name'] ." >= '". $val['from'] ."' AND ".$val['field_name']. " <= '". $val['to']."'";
						}
						else if (isset($val['from']) && $val['from'] !='' && isset($val['to']) && $val['to'] =='')
						{
							$date_condition = $val['field_name'] ." >= '". $val['from']."'";
						}
						else if (isset($val['to']) && $val['to'] !='' && isset($val['from']) && $val['from'] =='')
						{
							$date_condition = $val['field_name'] ." <= '". $val['to']."'";
						}
						else if (isset($val['from']) && $val['from'] !='')
						{
							$date_condition = $val['field_name'] ." >= '". $val['from']."'";
						}
						else if (isset($val['to']) && $val['to'] !='')
						{
							$date_condition = $val['field_name'] ." <= '". $val['to']."'";
						}
						if('' != $date_condition)
						{
							if('' == $where_str)
							{
								$where_str = $date_condition;
							}
							else
							{
								$where_str .= " AND ".$date_condition;
							}
						}
						break;
					default:
				}
			}
			
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Empty array';
			return $data;
		}
		return $where_str;
	}
	/** 
	* Equal
	* 
	* @method: equals_format 
	* @access: public 
	* @param: value, key and prefix
	* @return:
	*/
	private function equals_format(&$value,$key,$prefix) {
	  $value=" $prefix = '$value'";
	}
	/** 
	* Find in set
	* 
	* @method: find_in_set_format 
	* @access: public 
	* @param: value, key and prefix
	* @return:
	*/
	private function find_in_set_format(&$value,$key,$prefix) {
	  $value=" FIND_IN_SET('$value', $prefix)";
	}
	/** 
	* Ci drop down array
	* 
	* @method: build_ci_dropdown_array 
	* @access: public 
	* @param: input_array, key, value and dropdown_type
	* @return:
	*/
	public function build_ci_dropdown_array($input_array, $key, $value, $dropdown_type = 'single') {
		if(!empty($input_array) && '' != $key && '' != $value)
		{
			$dropdown_array = array();
			$date_field = '';
			if($dropdown_type == 'single' OR $dropdown_type == 'append')
			{
				$dropdown_array[''] = 'Nothing selected';
			}
			foreach($input_array as $ary)
			{
				if($dropdown_type == 'append')
				{
					$mutiple_keys = explode(',',$key);
					$mutiple_values = explode(',',$value);
					$appended_keys = '';
					$appended_values = '';
					$is_single_key = FALSE;	
					$is_single_value = FALSE;	
					// Check multiple keys to append
					if(is_array($mutiple_keys))
					{
						$incrementer = 0;
						foreach($mutiple_keys as $key_value)
						{
							
							$appended_keys = ($incrementer == 0)?$ary[$key_value]:$appended_keys . ' -- ' . $ary[$key_value];
							$incrementer++;
						}
					}
					else
					{
						$is_single_key = TRUE;	
					}
					// Check multiple values to append
					if(is_array($mutiple_values))
					{
						$incrementer = 0;
						foreach($mutiple_values as $single_value)
						{
							
							if($single_value == 'start_date' OR $single_value == 'end_date')
							{
								$date_field = date('m/d/Y',strtotime($ary[$single_value]));
								$appended_values = ($incrementer == 0)?$date_field:$appended_values . ' -- ' . $date_field;
							}
							else
							{
								$appended_values = ($incrementer == 0)?$ary[$single_value]:$appended_values . ' -- ' . $ary[$single_value];
							}
							$incrementer++;
						}
					}
					else
					{
						$is_single_value = TRUE;
					}
					// Create drop down array
					if(TRUE === $is_single_key && TRUE === $is_single_value)
					{
						$dropdown_array[$ary[$key]] = $ary[$value];
					}
					else if(FALSE === $is_single_key && TRUE === $is_single_value)
					{
						$dropdown_array[$appended_keys] = $ary[$value];
					}
					else if(TRUE === $is_single_key && FALSE === $is_single_value)
					{
						$dropdown_array[$ary[$key]] = $appended_values;
					}
					else if(FALSE === $is_single_key && FALSE === $is_single_value)
					{
						$dropdown_array[$appended_keys] = $appended_values;
					}
				}
				else
				{
					$dropdown_array[$ary[$key]] = $ary[$value];
				}
			}
			return $dropdown_array;
		}
		else
		{
			$dropdown_array[''] = 'Nothing selected';
			return $dropdown_array;
		}
	}
	/** 
	* Encrypt Password
	* 
	* @method: encrypt_password 
	* @access: public 
	* @param: password
	* @return: Encrypted password
	*/
	public function encrypt_password($password)
	{
		if('' != $password)
		{
			$data['status'] = TRUE;
			$data['encrypt_password'] = md5($password);
			$data['message'] = 'Password encrypted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Argument is empty';
		}
		return $data;
	}
	/** 
	* Generate Unique Id
	* 
	* @method: generate_unique_id 
	* @access: public 
	* @param: password
	* @return: Unique Id
	*/
	public function generate_unique_id($length) 
	{
		$unique_id = random_string('alnum', $length);
		$data['unique_id'] = $unique_id;
		
		return $data;
	}
	/** 
	* CI drop down array
	* 
	* @method: get_db_options 
	* @access: public 
	* @param: $tbl_name (table constant), $args (the query arguments), $selection (the drop down selections), dropdown_type (Single / Multiple)
	* @return:
	*/
	public function get_db_options($tbl_name, $args, $dropdown_type = 'single') {
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from($tbl_name . ' AS MASTERSELECTTABLE');
		//if(! isset($args['where_clause'])) {$args['where_clause'] = array ('status'=>'Active');}
		if(isset($args['where_clause'])) {$this->read_db->where($args['where_clause']);}
		if(isset($args['order_clause']) && $args['order_clause'] !='') {$this->read_db->order_by($args['order_clause']);}

		$res = $this->read_db->get();
		$data = $res->result_array();
		return $this->build_ci_dropdown_array($data, $args['select_fields'][0], $args['select_fields'][1], $dropdown_type);
	}
	/** 
	* CI drop down array
	* 
	* @method: get_db_options 
	* @access: public 
	* @param: $tbl_name (table constant), $args (the query arguments), $selection (the drop down selections), dropdown_type (Single / Multiple)
	* @return:
	*/
	public function get_db_option($tbl_name, $args, $dropdown_type = 'multiple') {
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from($tbl_name . ' AS MASTERSELECTTABLE');
		//if(! isset($args['where_clause'])) {$args['where_clause'] = array ('status'=>'Active');}
		if(isset($args['where_clause'])) {$this->read_db->where($args['where_clause']);}
		if(isset($args['order_clause']) && $args['order_clause'] !='') {$this->read_db->order_by($args['order_clause']);}

		$res = $this->read_db->get();
		$data = $res->result_array();
		return $this->build_ci_dropdown_array($data, $args['select_fields'][0], $args['select_fields'][1], $dropdown_type);
	}
	
	/** 
	* dashboard Get weather report
	* 
	* @method: get_weather_report 
	* @access: public 
	* @return: array 
	* @created by: chandru
	* @created on: 15-05-2015
	*/	
	
	public function get_weather_report($weather)
	{
		$addresslatlng = $weather['address'].', '.$weather['city'].', '.$weather['province'].', '.$weather['country'];
		$latLongAry = $this->get_Latitude_And_Longitude($addresslatlng); 
		$lat = $latLongAry['lat'];
		$lon = $latLongAry['long'];
		$latlogvalue = $latLongAry['lat'].",".$latLongAry['long'];
		$city_province = $weather['city'].','.$weather['province'];
		$weather_response_array = array(
					'city_province' => $city_province,
					'lat' => $lat,
					'lon' => $lon,
					);
		return $weather_response_array;
	}
	
	/**
	*
	* getLatitudeAndLongitude
	*
	* @method: getLatitudeAndLongitude
	* @access: public 
	* @param: $addressParameter
	* @return: return data(lat,lng)
	* @created by : chandru
	* @created on : 14-05-2015
	*/
	public function get_Latitude_And_Longitude($addressParameter){
        $address = urlencode($addressParameter); // Wrigley Field
        $url ='http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';
        $geocode = file_get_contents($url);
        $results = json_decode($geocode, true);
        $latLongAry = array('lat'=>0, 'long'=>0);
        if($results['status']=='OK'){
        $latLongAry['lat'] = $results['results'][0]['geometry']['location']['lat'];
        $latLongAry['long'] = $results['results'][0]['geometry']['location']['lng'];
        }
        return $latLongAry;
    }
	/**
	*
	* Generate number
	*
	* @method: generate_number
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function generate_number($type, $pad_length, $pad_id)
	{
		$number = str_pad($pad_id, $pad_length,'0',STR_PAD_LEFT);
		return $type.'-'.date('mdY').'-'.$number;
	}
	
	/**
	* Get User id
	* @method: get_mail_user_id
	* @access: public 
	* @return: return user id
	* @createdby: CHANDRU
	* @created on: 08/06/2015
	*/
	public function get_mail_preference_user_id($user_id,$module_name = '')
	{
		//echo $user_id;exit;
			/* Convert comma separator to Array */
			$user_id = explode(",",$user_id);
			$array_user_id = array();
			/* Filter the array based on value */
			$user_id = array_filter($user_id);
			foreach($user_id as $key => $val)
			{
				$where_condition = array('ub_user_id' => $val);
				$get_all_users = array(
								'select_fields' => array('mail_preferences'),
								'where_clause' => $where_condition
								);
				$all_users = $this->Mod_user->get_users($get_all_users);
				if(isset($all_users['aaData'][0]['mail_preferences']) && !empty($all_users['aaData'][0]['mail_preferences']))
				{
					$user_preference = $all_users['aaData'][0]['mail_preferences'];
					$remove_single_quote = str_replace("'", '', $user_preference);
					$content_array = unserialize($remove_single_quote);
					if($content_array[$module_name] == 'Yes')
					{
						$array_user_id[] = $val ;
						}else{
						$array_user_id[] = 0;
					}
				}else
				{
					$array_user_id[] = 0;
				}
			}
			$user_id = implode(",",$array_user_id);
			return $user_id;
	}
	
	/**
	* Get User id
	* @method: get_sms_preference_user_id
	* @access: public 
	* @return: return user id
	* @createdby: CHANDRU
	* @created on: 31/08/2015
	*/
	public function get_sms_preference_user_id($user_id,$module_name = '')
	{
		//echo $user_id;exit;
			/* Convert comma separator to Array */
			$user_id = explode(",",$user_id);
			$array_user_id = array();
			/* Filter the array based on value */
			$user_id = array_filter($user_id);
			foreach($user_id as $key => $val)
			{
				$where_condition = array('ub_user_id' => $val);
				$get_all_users = array(
								'select_fields' => array('sms_preferences'),
								'where_clause' => $where_condition
								);
				$all_users = $this->Mod_user->get_users($get_all_users);
				if(isset($all_users['aaData'][0]['sms_preferences']) && !empty($all_users['aaData'][0]['sms_preferences']))
				{
					$user_preference = $all_users['aaData'][0]['sms_preferences'];
					$remove_single_quote = str_replace("'", '', $user_preference);
					$content_array = unserialize($remove_single_quote);
					if($content_array[$module_name] == 'Yes')
					{
						$array_user_id[] = $val ;
						}else{
						$array_user_id[] = 0;
					}
				}else
				{
					$array_user_id[] = 0;
				}
			}
			$user_id = implode(",",$array_user_id);
			return $user_id;
	}
	/**
	* Get sort name
	* @method: get_sort_name
	* @access: public 
	* @return: return string
	* @createdby: Gopakumar
	* @created on: 26/06/2015
	*/
	public function get_formatted_sort_name($args)
	{
		//print_r($args);exit;
		if(isset($args['module_name']) && $args['module_name'] != '')
		{
			switch ($args['module_name']) {
				case "logs":
					$dt_fields_ary = array(
										'full_name' => 'USER.first_name',
										'project_name' => 'PROJECT.project_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
				case "leads":
					$dt_fields_ary = array(
										'first_name' => 'USER.first_name',
										'name' => 'LEAD.name',
										'Sales Person' => 'CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
				case "messages":
					$dt_fields_ary = array(
										'project_name' => 'PROJECT.project_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;	
					//added by pranab
					/* start */
					case "payment":
					$dt_fields_ary = array(
										'builder_name' => 'BUILDER_DETAILS.builder_name',
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
				 /* end */
				 
				case "task":
					$dt_fields_ary = array(
										'assignedto' => 'USER.first_name',
										'creator' => 'USER.first_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
				case "punchlist":
					$dt_fields_ary = array(
										'creator' => 'USER.first_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;	
					
				case "checklist":
					$dt_fields_ary = array(
										'project_name' => 'PROJECT.project_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
					
				case "subcontractor":
					$dt_fields_ary = array(
										'user_status' => 'UB_USER.user_status'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;

				case "BUILDERUSER":
					$dt_fields_ary = array(
										'role_name' => 'ROLE.role_name',
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;

				case "warranty":
					$dt_fields_ary = array(
										'service_date' => 'WARRANTY_APPOINTMENT.service_date',
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;

				case "bids":
					$dt_fields_ary = array(
										'project_name' => 'PROJECT.project_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;

				case "user":
					$dt_fields_ary = array(
										'role_name' => 'ROLE.role_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
				
					case "budget":
					$dt_fields_ary = array(
										'project_name' =>'PROJECT.project_name',	
										'total_amount' => 
										'SUM(ESTIMATE.budget_amount)',
										'contract_price' => 'PROJECT.contract_price',
										'total_revised_contract' => 'SUM(ESTIMATE.revised_contract)',
										'total_overhead_cost' => 'SUM(ESTIMATE.overhead_cost)',
										'total_estimated_profit_amount' => 'SUM(ESTIMATE.estimated_profit_amount)',
										'total_bill_to_client_to_date' => 'SUM(ESTIMATE.bill_to_client_to_date)',
										'total_paid_by_client_to_date' => 'SUM(ESTIMATE.paid_by_client_to_date)',
										'total_unpaid_client_billing' => 'SUM(ESTIMATE.unpaid_client_billing)',
										'total_balance_to_bill_client' => 'SUM(ESTIMATE.balance_to_bill_client)',
										'total_invoiced_by_sub_to_date' => 'SUM(ESTIMATE.invoiced_by_sub_to_date)',
										'total_amount_paid_to_sub' => 'SUM(ESTIMATE.amount_paid_to_sub)',
										'total_balance_to_be_invoiced_by_sub' => 'SUM(ESTIMATE.balance_to_be_invoiced_by_sub)',
										'balance_owed_to_sub' => 'SUM(ESTIMATE.total_balance_owed_to_sub)',
										'cost' => 'SUM(ESTIMATE.total_cost)',
										'total_profit_to_date' => 'SUM(ESTIMATE.profit_to_date)',
										'total_overall_profit' => 'SUM(ESTIMATE.overall_profit)',
										'profit' => '((SUM(ESTIMATE.overall_profit)/PROJECT.contract_price)*100)'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
			case "MOM":
					$dt_fields_ary = array(
										'project_name' =>'PROJECT.project_name'
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
					case "builder":
					$dt_fields_ary = array(
										'full_name' =>'USER.first_name',
										'plan_name' =>'PLAN.plan_name',
										'user_status'=>'USER.user_status',
										'city'=>   'USER.city',
									);
					return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
					break;
			case "projects":
					$dt_fields_ary = array(
								'owner_name' => 'OWNER.first_name',
								'desk_phone' => 'OWNER.desk_phone',
								'mobile_phone' => 'OWNER.mobile_phone',
								'manager_name' => 'BUILDER.first_name',
								
								);
				return (isset($dt_fields_ary[$args['filed_name']]))?$dt_fields_ary[$args['filed_name']]:'';
				break;		
				default:
						
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Argument is empty';
		}
		return $data;
	}
	
	
	/* @method: get_owner_slider_images
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_owner_slider_images($post_array = array())
	{
		//echo '<pre>';print_r($this->builder_id);exit;
		if($post_array['builder_id'] > 0)
		{
			/*
			### get_slider_images() - Stored procedure input parameter, order and count###
			1. builderid (int) 
			2. projectid (int)
			3. ownerid (int)
			
			*/
			$data = array();
			$SP_input_param_array = array();
			$SP_input_param_array['ownerid'] = ($this->user_id == 'a')?0:(int)$this->user_id;
			$SP_input_param_array['projectid'] = (int) $post_array['project_id'];
			$SP_input_param_array['builderid'] = (int) $post_array['builder_id'];
			//echo '<pre>';print_r($SP_input_param_array);exit;
			$stored_procedure = "CALL get_slider_images(?,?,?)";
			$res = $this->write_db->query($stored_procedure,$SP_input_param_array);
			$this->write_db->freeDBResource($this->write_db->conn_id);
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
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Insert operation Failed: Not a valid builder';
		}	
		return $data;
	}
	/* Convert object to array */ 
	public function object_to_array( $object )
	{
		if( !is_object( $object ) && !is_array( $object ) )
		{
			return $object;
		}
		if( is_object( $object ) )
		{
			$object = get_object_vars( $object );
		}
		return array_map( array($this, 'object_to_array'), $object );
	}
	
	/**
	*
	* Generate template import number
	*
	* @method: generate_template_import_number
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function generate_template_import_number($type, $pad_length, $pad_id)
	{
		$number = str_pad($pad_id, $pad_length,'0',STR_PAD_LEFT);
		return $type.'-'.date('mdYHis').'-'.$number;
	}
	
	/* Below function "folder_structure_delete"
		Created for: "Delete folder structure and files"
		Created by : CHANDRU
		Created On : 05-10-2016
	*/
	/* Common code for deleting in "ub_doc_folder" */
	public function folder_structure_delete($ui_folder_name = '', $project_id = 0, $module_name = '', $module_id = 0)
	{
		if(!empty($ui_folder_name) && !empty($module_name) && $module_id > 0)
		{
			/* Get folder id based on builder id and ui_folder_name */
			$sort_type = 'ASC';
			$order_by_where = 'ub_doc_folder_id'.' '.$sort_type;
			$get_project_folder_id = array('select_fields' => array('ub_doc_folder_id'),
						   'where_clause' => (array('builder_id' =>  $this->user_session['builder_id'],'ui_folder_name' => $ui_folder_name)),
							'order_clause' => $order_by_where
						   );
			$delete_folder_array = $this->Mod_doc->get_folder_id($get_project_folder_id);
			if(TRUE == $delete_folder_array['status'])
			{
				$delete_folder_id = $delete_folder_array['aaData'][0]['ub_doc_folder_id'];
				/* Below code was deleting in ub_doc_folder table */
				if($delete_folder_id > 0)
				{
					/* Soft delete in folder table */
					$folder_data = array(	 
									  'folderid' => $delete_folder_id,
									  'builderid' => $this->user_session['builder_id'],
									  'deletedby' => $this->user_session['ub_user_id']
									);
					$result_array = $this->Mod_doc->delete_folder($folder_data);
					if(TRUE == $result_array[0]['messagestatus'])
					{
						/* Soft delete in file table */
						/* Fetch file id based on folder and project id */
						if($project_id > 0)
						{
							/* Related to project */
							$flag = 0;
						}else{
							/* Not related to project */
							$flag = 2;
						}
						$file_table_data = array(	  'flag' => $flag, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $project_id,
								  'folderid' => $delete_folder_id,
								  'modulename' => $module_name,
								  'moduleid' => $module_id
								);
						$file_array = $this->Mod_doc->get_files_for_folder($file_table_data);
						if(TRUE == $file_array['status'])
						{
							if(isset($file_array[0]) && $file_array[0] != '')
							{
								$file_array_ids = array_column($file_array, 'ub_doc_file_id');
							
								foreach ($file_array_ids as $key => $ub_doc_file_id)
								{
									$delete_file_data = array(
										  'flag' => 1,
										  'fileid' => $ub_doc_file_id,
										  'folderid' => $delete_folder_id,
										  'builderid' => $this->user_session['builder_id'],
										  'deletedby' => $this->user_session['ub_user_id']
										);
									/* Delete from doc_file table */
									$result_array = $this->Mod_doc->delete_file($delete_file_data);
								}
							}
							/* Fetch folder path */
							$folder_path_data = array(	 
									  'folderid' => $delete_folder_id,
									  'builder_id' => $this->user_session['builder_id'],
									);
							//echo "<pre>";print_r($folder_data);exit();
							$folder_path_array = $this->Mod_doc->get_folder_path($folder_path_data);
							if(isset($folder_path_array[0]['folderpath']) && !empty($folder_path_array[0]['folderpath']))
							{
								$folder_path = DOC_URL.$folder_path_array['0']['folderpath'];
								/* Delete entire folder structure code */
								/* if (is_dir($folder_path)) 
								{ 
									// $folder_delete = rmdir($folder_path);
									array_map('unlink', glob($folder_path."/*"));
									rmdir($folder_path);
								} */ 
							}
						}
					}
				}
			}
		}
	}

}
?>