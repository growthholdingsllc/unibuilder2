<?php
/** 
 * General value class
 * 
 * @package: General definition
 * @subpackage:  
 * @category: Core
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 13-03-2015 
*/
class Mod_general_value extends UNI_Model{
	/**
	 * @property: $classification
	 * @access: public
	 */
	public $classification = '';
	/**
	 * @constructor
	 */
    public function __construct() 
	{
		parent::__construct();
    }
	/** 
	* Get general value by classification
	* 
	* @method: get_general_value 
	* @access: public 
	* @params: $args['classification'] - General value classification
	* @params: $args['where_clause'] - can pass where conditions as an array
	* @return: array 
	*/
	public function get_general_value($args='')
	{
		// echo '<pre>';print_r($args);
		$this->classification = $args['classification'];
		if($this->classification != '')
		{
			switch ($this->classification) {
				case "smtp_settings":
					$this->read_db->select('classification, varchar01 AS from_email, varchar02 AS host, varchar03 AS username, varchar04 AS password,
					int01 AS port');
					break;
				case "project_status":
				case "user_status":
				case "lead_status":
				case "task_priority":
				case "punch_list_priority":
				case "meeting_status":
				case "warranty_priority":
				case "warranty_classification":
				case "warranty_feedback":
				case "owner_selection_allow_to":
				case "subcontractor_selection_allow_to":
				case "selection_status":
				case "selection_choice_status":
				case "warranty_status":
				case "bid_package_status":
				case "bid_status":
				case "po_co_status":
				case "client_po_co_status":
				case "po_co_payment_status":
				case "payapp_status":
					$this->read_db->select('classification, varchar01 AS status');
					break;
				case "account_type":
				case "lead_age":
				case "reminder":
					$this->read_db->select('classification, varchar01 AS type, int01 AS value');
					break;
				case "lead_project_type":
				case "lead_source":
				case "lead_tags":
				case "project_group":
				case "task_tags":
				case "punch_list_tags":
				case "log_tags":
				case "meeting_tags":
				case "meeting_location":
				case "meeting_type":
				case "checklist_tags":
				case "checklist_category":
				case "lead_activity_type":
				case "warranty_category":
				case "selection_category":
				case "selction_location":
				case "subcontractor_department":
				case "schedule_tags":
				case "schedule_phase_list":
				case "workday_exception_category":
				case "survey_tags":
					$this->read_db->select('classification, varchar01 AS comma_seperated_value');
					break;
				case "builder_currency":
				case "user_date_format":
				case "schedule_colour":
				case "custom_field_modules":
				case "custom_field_data_types":
					$this->read_db->select('classification, varchar01 AS type, varchar02 AS value');
					break;
				case "project_grid_setting_fields":
				case "task_grid_setting_fields":
				case "lead_grid_setting_fields":
					$this->read_db->select('classification, varchar01 AS field_name, varchar02 AS display_name, varchar03 AS display_joins, varchar04 AS datatable_column, enum01 AS default_value, ub_general_valueid AS grid_settings_id');
					break;
				case "dashboard_item_display_length":
				case "message_comments_length":
					$this->read_db->select('classification, int01 AS value');
					break;
				case "cc_encryption_key":
					$this->read_db->select('classification, varchar01 AS value');
					break;
				default:
					$this->read_db->select('*');
			}
			$this->read_db->from(UB_GENERAL_VALUE);
			$this->read_db->where(array('classification' => $this->classification));
			if(isset($args['where_clause']) && !empty($args['where_clause']))
			{
				$this->read_db->where($args['where_clause']);
			}
			if(isset($args['orderby_clause']) && !empty($args['orderby_clause']))
			{
				$this->read_db->order_by($args['orderby_clause']);
			}
			
			$res = $this->read_db->get();
			//echo $this->read_db->last_query();exit;
			$data = array();
			if($res->num_rows > 0)
			{
				if(isset($args['type']) && $args['type'] == 'dropdown')
				{
					$response = $this->build_ci_dropdown_values($res->result_array());
					if($response['status'] == FALSE)
					{
						$data['status'] = FALSE;
						$data['message'] = 'Not able to format';
					}
					else
					{
						$data['values'] = $response['formatted_array'];
						$data['status'] = TRUE;
					}
				}
				else if(isset($args['type']) && $args['type'] == 'grid_settings')
				{
					$response = $this->build_ci_dropdown_values($res->result_array());
					if($response['status'] == FALSE)
					{
						$data['status'] = FALSE;
						$data['message'] = 'Not able to format';
					}
					else
					{
						$data['values'] = $response['formatted_array'];
						$data['status'] = TRUE;
					}
				}
				else
				{
					$data['values'] = $res->result_array();
					$data['status'] = TRUE;
				}
				// $data['status'] = TRUE;
				// $data['message'] = 'General values fetched successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'No Record Found';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Classification should not be empty';
		}
		return $data;
	}
	/** 
	* Update General value - Update can be done only for builder created data
	* 
	* @method: update_general_value 
	* @access: public 
	* @params: $input_array['classification'] - General value classification
	* @params: $input_array['type'] - Type "Add / Delete"
	* @params: $input_array['value'] - Value to be added / removed
	* @return: array 
	*/
	public function update_general_value($input_array = array())
	{
		if(!empty($input_array) && isset($input_array['classification']))
		{
			$this->classification = $input_array['classification'];
			$args = array();
			$args['classification'] = $this->classification;
			$args['where_clause'] = array('int01' => $this->builder_id);
			// Getting builder custom values
			$response = $this->get_general_value($args);
			if($response['status'] === FALSE)
			{
				// Record is not found in ub_general_value - Insert
				$insert_array = array();
				$insert_array['classification'] = $this->classification;
				$insert_array['varchar01'] = ','.$input_array['value'].',';
				$insert_array['int01'] = $this->builder_id;
				$insert_array['created_by'] = $this->user_session['ub_user_id'];
				$insert_array['created_on'] = TODAY;
				$insert_array['modified_by'] = $this->user_session['ub_user_id'];
				$insert_array['modified_on'] = TODAY;
				if($this->write_db->insert(UB_GENERAL_VALUE , $insert_array))
				{
					$data['status'] = TRUE;
					$data['message'] = 'Inserted successfully';
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Insertion failed';
				}
				
			}
			else
			{
				if(isset($input_array['type']) && $input_array['type'] == 'add')
				{
					if(strpos($response['values'][0]['comma_seperated_value'], ','.$input_array['value'].',') !== FALSE)
					{
						// Value already exist check
						$data['status'] = FALSE;
						$data['message'] = 'Value "'.$input_array['value'].'"is already exist for '.$this->classification;
					}
					else
					{
						// if $input_array['type'] is 'add' then add value
						$existing_value_str = trim($response['values'][0]['comma_seperated_value'],',');
						$existing_value_array = explode(',' , $existing_value_str);
						// Adding new value beginning of the array
						if(count(array_filter($existing_value_array)) > 0)
						{
							array_unshift($existing_value_array,$input_array['value']);
						}
						else
						{
							$existing_value_array = array();
							$existing_value_array[] = $input_array['value'];
						}
						// Update values
						$data = $this->update($existing_value_array);
					}
				}
				else if(isset($input_array['type']) && $input_array['type'] == 'edit')
				{
					echo '<pre>';print_r($input_array);exit;
				}
				else if(isset($input_array['type']) && $input_array['type'] == 'delete')
				{
					// Core check
					$args = array();
					$where_str = 'varchar01 LIKE "%'.$input_array['value'].'%" AND int01=0';
					$args['classification'] = $input_array['classification'];
					$args['where_clause'] = $where_str;
					$response_ary = $this->get_general_value($args);
					if($response_ary['status'] == FALSE)
					{
						// if $input_array['type'] is 'delete' then delete value
						$existing_value_str = trim($response['values'][0]['comma_seperated_value'],',');
						$existing_value_array = explode(',' , $existing_value_str);
						$unset_key = array_search($input_array['value'],$existing_value_array);
						if($unset_key >= 0)
						{
							unset($existing_value_array[$unset_key]);
							// Update values
							$data = $this->update($existing_value_array);
						}
						else
						{
							$data['status'] = FALSE;
							$data['message'] = 'Value "'.$input_array['value'].'" not found for the classification "'.$this->classification.'" to delete';
						}
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'System / Core drop down values cannot be deleted';
					}
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Type is not defined properly';
				}
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Classification should not be empty';
		}
		return $data;
	}
	/** 
	* Update General value - Update can be done only for builder created data
	* 
	* @method: update 
	* @access: public 
	* @params: update array
	* @return: array 
	*/
	public function update($update_value_array)
	{
		$update_str = '';
		if(count($update_value_array) > 0)
		{
			$update_str = ','.implode(',', $update_value_array).',';	
		}			
		$update_array = array('varchar01'=> $update_str);
		$condition_array = array('classification' => $this->classification, 'int01' =>$this->builder_id);
		
		$this->write_db->where($condition_array);
		if($this->write_db->update(UB_GENERAL_VALUE , $update_array))
		{
			$data['status'] = TRUE;
			$data['message'] = 'Update Success';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Update Failed';
		}
		return $data;
	}
	/** 
	* Format custom drop down values added by builder user
	* 
	* @method: format_custom_values 
	* @access: public 
	* @params: format array
	* @return: formatted array 
	*/
	public function format_custom_values($format_array)
	{
		// Unset status and message
		if(isset($format_array['status']))
		{
			unset($format_array['status']);
		}
		if(isset($format_array['message']))
		{
			unset($format_array['message']);
		}
		if(!empty($format_array))
		{
			$formatted_array = array();
			$loop_cnt = 0;
			foreach($format_array as $key=>$value)
			{
				// Formatting array
				$str = '';
				$str = trim($value['type'],',');
				$explode_array= explode(',' , $str);
				foreach($explode_array as $k => $v)
				{
					$loop_cnt++;
					if(isset($value['builder_id']))
					{
						$formatted_array[$loop_cnt]['builder_id'] = $value['builder_id'];
					}
					if(isset($value['default_value']))
					{
						$formatted_array[$loop_cnt]['default'] = $value['default_value'];
					}
					$formatted_array[$loop_cnt]['value'] = $v;
				}
			}
			$data['formatted_array'] = $formatted_array;
			$data['status'] = TRUE;
			$data['message'] = 'Array formatting done';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Formatting Failed';
		}
		return $data;
	}
	/** 
	* Build default drop down values
	* 
	* @method: build_ci_dropdown_values 
	* @access: public 
	* @params: format array
	* @return: formatted array 
	*/
	public function build_ci_dropdown_values($format_ary)
	{
		if(!empty($format_ary))
		{
			$formatted_array = array();
			foreach($format_ary as $key=>$val)
			{
				$data['status'] = TRUE;
				if(isset($val['status']))
				{
					$formatted_array[''] = 'Nothing selected';
					$formatted_array[$val['status']] = $val['status'];
				}
				else if(isset($val['value']))
				{
					$formatted_array[''] = 'Nothing selected';
					$formatted_array[$val['value']] = $val['type'];
				}
				else if(isset($val['comma_seperated_value']))
				{
					if($val['comma_seperated_value'] != '')
					{
						$comma_ary = $this->comma_seperated_to_array($val['comma_seperated_value']);
						foreach($comma_ary as $key=>$val)
						{
							$formatted_array[$val] = $val;
						}
					}
				}
				else if(isset($val['display_name']))
				{
					if($val['display_name'] != '')
					{
						$formatted_array[''] = 'Nothing selected';
						$formatted_array[$val['grid_settings_id']] = $val['display_name'];
					}
				}
				else
				{
					$data['status'] = FALSE;
				}
			}
			$data['formatted_array'] = $formatted_array;
			$data['message'] = 'Array formatting done';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Update Failed';
		}
		return $data;
	}
	/** 
	* Build default drop down values
	* 
	* @method: comma_seperated_to_array 
	* @access: public 
	* @params: String
	* @return: Array
	*/
	public function comma_seperated_to_array($comma_seperated_value)
	{
		$formatted_array = array();
		$str = '';
		$str = trim($comma_seperated_value,',');
		$explode_array= explode(',' , $str);
		foreach($explode_array as $k => $v)
		{
			$formatted_array[$v] = $v;
		}
		return $formatted_array;
	}
}
/* End of file mod_general_value.php */
/* Location: ./application/models/mod_general_value.php */