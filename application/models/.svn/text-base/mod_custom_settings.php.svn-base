<?php
/** 
 * Custom Filed Settings Class
 * 
 * @package: General definition
 * @subpackage:  
 * @category: Core
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 04-04-2015 
*/
class Mod_custom_settings extends UNI_Model{
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
	* Get custom fields
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_custom_fileds
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_custom_fields($args = array())
	{
		if(!empty($args))
		{
			$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
			$this->read_db->from(UB_CUSTOM_FIELD.' AS CUSTOM_FIELD');	//GRID_SETTINGS is the table name defined in constant file
			
			// Join
			if(isset($args['join']) && 'yes' === strtolower($args['join']['custom_field_value']))
			{
					$this->read_db->join(UB_CUSTOM_FIELD_VALUES.' AS CUSTOM_FIELD_VALUES','CUSTOM_FIELD.ub_custom_field_id = CUSTOM_FIELD_VALUES.custom_field_id','left');//UB_USER is the table name defined in constant file
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
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	/** 
	* Get custom fields
	*
	* @method: insert_custom_fields
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function update_custom_fields($post_array)
	{
		if(!empty($post_array))
		{
			if(isset($post_array['ub_custom_field_id']) && $post_array['ub_custom_field_id'] > 0)
			{
				// Update custom fields
				if(isset( $post_array['label_name'])){
				$check_array = array(
										'CUSTOM_FIELD.label_name' => $post_array['label_name'],
										'CUSTOM_FIELD.module_name' => $post_array['module_name'],
										'CUSTOM_FIELD.classification' => $post_array['classification'],
										'CUSTOM_FIELD.builder_id' => $this->builder_id,
										'CUSTOM_FIELD.ub_custom_field_id !=' => $post_array['ub_custom_field_id'],
									);
				$result = $this->get_custom_fields(
										array('select_fields' => array(' CUSTOM_FIELD.label_name'),
										'where_clause' => $check_array
										)
								);
				if($result['status'] == FALSE)
				{	
					$this->write_db->where('ub_custom_field_id', $post_array['ub_custom_field_id']);
					if($this->write_db->update(UB_CUSTOM_FIELD, $post_array))
					{
						$data['status'] = TRUE;
						$data['message'] = 'Data updated successfully';
					}
					else
					{
						$data['status'] = FALSE;
						$data['message'] = 'Insert Failed: Failed to update the data';
					}
					return $data;
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'The label name is already exist for the builder';
				}
			}
			else
			{
				$this->write_db->where('ub_custom_field_id', $post_array['ub_custom_field_id']);
				if($this->write_db->update(UB_CUSTOM_FIELD, $post_array))
				{
					$data['status'] = TRUE;
					$data['message'] = 'Data updated successfully';
				}
			}
		   }
			else
			{
				// Insert custom fields
				$check_array = array(
										'CUSTOM_FIELD.label_name' => $post_array['label_name'],
										'CUSTOM_FIELD.module_name' => $post_array['module_name'],
										'CUSTOM_FIELD.classification' => $post_array['classification'],
										'CUSTOM_FIELD.builder_id' => $this->builder_id,
									);
				$result = $this->get_custom_fields(
										array('select_fields' => array(' CUSTOM_FIELD.label_name'),
										'where_clause' => $check_array
										)
								);
				if($result['status'] === FALSE)
				{
					if($this->write_db->insert(UB_CUSTOM_FIELD, $post_array))
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
					return $data;
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'The label name is already exist for the builder';
				}
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	/**
	*
	* Delete custom fields
	*
	* @method: delete_custom_fields
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function delete_custom_fields($delete_ary)
	{
		if(isset($delete_ary['ub_custom_field_id']))
		{
			foreach($delete_ary['ub_custom_field_id'] as $key=>$custom_filed_id)
			{
				$this->write_db->delete(UB_CUSTOM_FIELD, array('ub_custom_field_id' => $custom_filed_id));
			}
			$data['status'] = TRUE;
			$data['message'] = 'Customer Filed deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Customer Filed id is not set';
		}
		//echo '<pre>';print_r($data);exit;
		return $data;
	}

	/**
	*
	* Format Custom Filed And Insert
	*
	* @method: delete_custom_fields
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function format_custom_filed_and_insert($post_array = array())
	{
		$data = array();
		$data_array = array();
		if(!empty($post_array))
		{
			//echo '<pre>';print_r($post_array);exit;
			$custom_post_array =  array('CUSTOM_FIELD.builder_id'=>$this->user_session['builder_id'], 'CUSTOM_FIELD.classification'=> $post_array['classification'], 'status'=> $post_array['status']);
			$custom_field_data = $this->get_custom_fields(array(
													'select_fields' => array('CUSTOM_FIELD.ub_custom_field_id','CUSTOM_FIELD.data_type'),
													'where_clause' => $custom_post_array,
													));
			if (isset($custom_field_data['aaData']) && !empty($custom_field_data['aaData'])) 
			{
				$custom_table_data = $custom_field_data['aaData'];

				/*echo '<pre>';print_r($post_array);
				echo '<pre>';print_r($custom_field_data);exit;*/
				foreach ($custom_table_data as $key => $value) 
				{
					$ub_custom_field_id = $value['ub_custom_field_id'];
					$field_id = $post_array['module_name'].'_'.$value['ub_custom_field_id'];
					
					switch ($value['data_type']) 
					{
						case MULTI_SELECT_DROP_DOWN: 
						{ 
							//$multi_select_val = (isset($post_array[$field_id])) ? $post_array[$field_id] : ' ' ;
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' => "".implode(",", $post_array[$field_id])."",
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							}
							break;
						}
						case SINGLE_SELECT_DROP_DOWN:
						{
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' => $post_array[$field_id],
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							}
							break;
						}
						case CURRENY: 
						{
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' => $post_array[$field_id],
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							}
							break;
						}
						case DATE_PICKER: 
						{
							if(!empty($post_array[$field_id]))
							{
								$post_array[$field_id] = (isset($post_array[$field_id]) && $post_array[$field_id]!='')?date("Y-m-d", strtotime($post_array[$field_id])):'0000-00-00';
								$data_array[] = array(
								'field_values' => $post_array[$field_id],
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								); 
							}
							break;	
						}
						case LIST_OF_BU_SUB_OWNER: 
						{ 
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' => "".implode(",", $post_array[$field_id])."",
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							} 
							break;	
						}
						case LIST_OF_SUB: 
						{ 
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' => "".implode(",", $post_array[$field_id])."",
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							} 
							break;	
						}
						case LIST_OF_BU: 
						{ 
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' => "".implode(",", $post_array[$field_id])."",
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							}
							break;	
						}
						case WHOLE_NUMBER: 
						{ 
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' =>$post_array[$field_id],
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							}
							break;
						}
						case CHECKBOX:
						{ 
							$checkbox_val = (isset($post_array[$field_id])) ? $post_array[$field_id] : 'No' ;
							$data_array[] = array(
								'field_values' => $checkbox_val,
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							break;	
						}
						case TEXTAREA: 
						{
							if(!empty($post_array[$field_id]))
							{
						 		$data_array[] = array(
								'field_values' => $post_array[$field_id],
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							}
							break;
						}
						case TEXTBOX:
						{ 
							if(!empty($post_array[$field_id]))
							{
								$data_array[] = array(
								'field_values' => $post_array[$field_id],
								'custom_field_id' => $value['ub_custom_field_id'],
								'table_id' => $post_array['module_id'],
								'module_name' => $post_array['module_name']
								);
							}
							break;
						}
					}
				}
			}
			//echo '<pre>';print_r($data_array);exit;
			$this->save_custom_fields_data($data_array);
			//	echo '<pre>';print_r($data_array);exit;
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Customer Filed id is not set';
		}
		//echo '<pre>';print_r($data);exit;
		return $data;
	}
	/**
	*
	* Save Custom Field Data
	*
	* @method: save_custom_fields_data
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function save_custom_fields_data($input_array = array())
	{
		if(!empty($input_array))
		{
			//echo '<pre>';print_r($input_array);exit;
			foreach($input_array as $key=>$val)
			{
				$custom_post_array =  array('CUSTOM_FIELD_VALUES.table_id'=>$val['table_id'], 'CUSTOM_FIELD_VALUES.custom_field_id'=>$val['custom_field_id']);
				$custom_field_data = $this->get_custom_fields(array(
													'select_fields' => array('CUSTOM_FIELD_VALUES.ub_custom_field_values_id','CUSTOM_FIELD_VALUES.custom_field_id','CUSTOM_FIELD_VALUES.table_id'),
													'join'=> array('custom_field_value'=>'yes'),
													'where_clause' => $custom_post_array,
													));
				//echo '<pre>gfdgdf';print_r($custom_field_data);exit;
				if (isset($custom_field_data['aaData']) && !empty($custom_field_data['aaData'])) 
				{
					$val['ub_custom_field_values_id'] = $custom_field_data['aaData']['0']['ub_custom_field_values_id'];
					$val['modified_on'] = TODAY;
					$val['modified_by'] = $this->user_id;
					$data = $this->update_custom_field_value($val);

				}
				else
				{
					$this->builder_id = (isset($post_array['builder_id']))?$post_array['builder_id']:$this->builder_id;
					$val['builder_id'] = $this->builder_id;
					$val['created_on'] 	= TODAY;
					$val['created_by'] 	= $this->user_id;
					$val['modified_on'] = TODAY;
					$val['modified_by'] = $this->user_id;
					$data = $this->add_custom_field_value($val);
				}
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Custom Filed id is not set';
		}
		//echo '<pre>';print_r($data);exit;
		//$this->response($data);
		return $data;
	}
	/**
	*
	* Update task
	* @created on: 12/04/2015
	* @method: update_leads
	* @access: public 
	* @param: post data
	* @return: return data
	* @createdby: Devansh
	*/
	public function update_custom_field_value($post_array = array())
	{
		if( ! empty($post_array))
		{
			//echo '<pre>';print_r($post_array);
			$this->write_db->where('ub_custom_field_values_id', $post_array['ub_custom_field_values_id']);
			$this->write_db->update(UB_CUSTOM_FIELD_VALUES, $post_array);
			$data['insert_id'] =  $this->write_db->insert_id();
			$data['parent_id'] =  $post_array['custom_field_id'];
			$data['status'] = TRUE;
			$data['message'] = 'Update successfully';
			//echo $this->write_db->last_query();exit;
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	/**
	*
	* Add lead
	* @created on: 12/04/2015
	* @method: add_lead
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	* @createdby: Devansh
	*/
	public function add_custom_field_value($post_array = array())
	{
		if( ! empty($post_array))
		{
			//echo '<pre>';print_r($post_array);exit;
			if($this->write_db->insert(UB_CUSTOM_FIELD_VALUES, $post_array))
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
}
/* End of file mod_custom_settings.php */
/* Location: ./application/models/mod_custom_settings.php */