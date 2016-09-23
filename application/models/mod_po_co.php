<?php
/** 
 * Po_Co Model
 * 
 * @package: Po_Co Model
 * @subpackage: Po_Co Model 
 * @category: Po_Co
 * @author: MS
 * @createdon(DD-MM-YYYY): 29-05-2015
*/
class Mod_po_co extends UNI_Model
{
	/**
	 * @property: $builder_id
	 * @access: public
	 */

	public $builder_id;
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
		$this->load->model(array('Mod_user'));
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
	public function get_po_co($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO.' AS PO_CO');	
 		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
		  $this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = PO_CO.assigned_to','left');
		}
		if(isset($args['join']['po_co_cost_code']) && 'yes' === strtolower($args['join']['po_co_cost_code']))
	    {
	       $this->read_db->join(UB_PO_CO_COST_CODE.' AS PO_CO_COST_CODE','PO_CO.ub_po_co_id = PO_CO_COST_CODE.po_co_id','left');
	    }
		 if(isset($args['join']['bid']) && 'yes' === strtolower($args['join']['bid']))
	    {
	       $this->read_db->join(UB_BID.' AS BID','PO_CO.bid_po_id = BID.ub_bid_id','left');
	    }  
		/* if(isset($args['join']['costcode']) && 'yes' === strtolower($args['join']['costcode']))
	    {
	       $this->read_db->join(UB_PO_CO_COST_CODE.' AS COST_CODE','PO_CO.ub_po_co_id = COST_CODE.po_co_id','left');
	    } */
	    if(isset($args['join']['project']) && 'yes' === strtolower($args['join']['project']))
	    {
	       $this->read_db->join(UB_PROJECT.' AS PROJECT','PROJECT.ub_project_id = PO_CO.project_id','left');
	    }
	    if(isset($args['join']['sub_contractor']) && 'yes' === strtolower($args['join']['sub_contractor']))
	    {
	       $this->read_db->join(UB_SUBCONTRACTOR.' AS SUBCONTRACTOR','USER.ub_user_id = SUBCONTRACTOR.user_id','left');
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
		
		/*   if(!$res)
		{
			echo $this->read_db->_error_message();
			echo "<br>".$this->read_db->_error_number();exit;
		} */  
		 // echo $this->read_db->last_query();

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
		return $data;
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
	public function get_po_co_cost_code($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_COST_CODE.' AS PO_CO_COST_CODE');	
 		
		if(isset($args['join']['po_co']) && 'yes' === strtolower($args['join']['po_co']))
	    {
	       $this->read_db->join(UB_PO_CO.' AS PO_CO','PO_CO.ub_po_co_id = PO_CO_COST_CODE.po_co_id','left');
	    }
	    if(isset($args['join']['variance_code']) && 'yes' === strtolower($args['join']['variance_code']))
        {

        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','PO_CO_COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id','left');
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

		 // echo $this->read_db->last_query();exit;

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
	public function get_bid_cost_code($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_BID_SUB_COST_CODE.' AS COST_CODE');	
 		
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		if(isset($args['join']['variance_code']) && 'yes' === strtolower($args['join']['variance_code']))
        {

        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id','left');
        }
		$res = $this->read_db->get();

		//echo $this->read_db->last_query();exit;

		 // echo $this->read_db->last_query();exit;

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
	public function get_assigned_user($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_USER.' AS USER');	
 		
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		
		$res = $this->read_db->get();

		//echo $this->read_db->last_query();exit;

		 // echo $this->read_db->last_query();exit;

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
	* Get get_po_co_bid information
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
	public function get_po_co_bid($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO.' AS PO_CO');	
 		
		if(isset($args['join']) && 'yes' === strtolower($args['join']['bid_request']))
	    {
	       $this->read_db->join(UB_BID_REQUEST.' AS BID_REQUEST','PO_CO.bid_po_id = BID_REQUEST.ub_bid_request_id','left');
	    }
	    if(isset($args['join']) && 'yes' === strtolower($args['join']['bid']))
	    {
	       $this->read_db->join(UB_BID.' AS BID','BID_REQUEST.bid_id = BID.ub_bid_id','left');
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

		 // echo $this->read_db->last_query();exit;

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
	public function get_jobs($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_ESTIMATE.' AS ESTIMATE');	
 		
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
		return $data;
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
	public function get_po_payment($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_PAYMENT_REQUEST.' AS PO_CO_PAYMENT_REQUEST');	
		
		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
		  $this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = PO_CO_PAYMENT_REQUEST.modified_by','left');
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
		return $data;
	}
	/**
	*
	* Add po_co
	*
	* @method: add_po_co
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_po_co($post_array = array(),$cost_code_insert_array = array(),$notification_array = array())
	{

		

		
		if( ! empty($post_array))
		{
		  //check po/co limit check
		  $project_po_co_limt_args = array('select_fields' => array('PROJECT.individual_po_limit','PROJECT.overall_po_limit'),
                'where_clause' => (array('PROJECT.ub_project_id' =>  $post_array['project_id'])),
                ); 
		  $project_po_co_limt_result = $this->Mod_project->get_projects($project_po_co_limt_args);
		
		  $po_co_cost_args = array('select_fields' => array('SUM(PO_CO.total_amount) AS total_amount'),
                'where_clause' => (array('PO_CO.project_id' =>  $post_array['project_id'])),
                ); 
		  $po_co_total_cost_result = $this->get_po_co($po_co_cost_args);

		 
		  if($po_co_total_cost_result['status'] == TRUE && $project_po_co_limt_result['aaData'][0]['overall_po_limit'] > 0.00  && ($post_array['type'] == 'PO' || $post_array['type'] == 'CO')){

		  	$overall_amount = $po_co_total_cost_result['aaData'][0]['total_amount'] + array_sum($cost_code_insert_array['total']);
		  if($overall_amount < $project_po_co_limt_result['aaData'][0]['overall_po_limit'])
	      {	
	      	if(array_sum($cost_code_insert_array['total']) <= $project_po_co_limt_result['aaData'][0]['individual_po_limit']){
			if($this->write_db->insert(UB_PO_CO, $post_array))
			{
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';

				$result = $this->Mod_builder->get_setup(array(
								'select_fields' => array('po_prefix', 'co_prefix'),
								'where_clause' => array('builder_id' => $this->user_session['builder_id'])
								));
				if(isset($result['aaData'][0]['po_prefix']) && $result['aaData'][0]['po_prefix']!='')
				{
					$po_prefix = $result['aaData'][0]['po_prefix'];
				}
				else
				{
					$po_prefix = 'PO';
				}
				if(isset($result['aaData'][0]['co_prefix']) && $result['aaData'][0]['co_prefix']!='')
				{
					$co_prefix = $result['aaData'][0]['co_prefix'];
				}
				else
				{
					$co_prefix = 'CO';
				}
		        
		           if($post_array['type'] == 'PO' || $post_array['type'] == 'OWNER PO'){
		           	$update_array = array();
		           $update_array['ub_po_co_number'] = $this->Mod_po_co->generate_number(strtoupper($po_prefix), PO_NUMBER_LENGTH, $data['insert_id']);}
		           else if($post_array['type'] == 'CO' || $post_array['type'] == 'OWNER CO'){
		           $update_array = array();
		           $update_array['ub_po_co_number'] = $this->Mod_po_co->generate_number(strtoupper($co_prefix), PO_NUMBER_LENGTH, $data['insert_id']);}
		           
		           $this->write_db->where('ub_po_co_id', $data['insert_id']);
				   $this->write_db->update(UB_PO_CO, $update_array);

				for($i=0; $i<count($cost_code_insert_array['cost_code_id']); $i++)
				{
				 if($cost_code_insert_array['cost_code_id'][$i] > 0)
				 {
				   $insert_cost_code_ary = array();
				   $insert_cost_code_ary['po_co_id'] = $data['insert_id'];
				   $insert_cost_code_ary['builder_id'] = $this->user_session['builder_id'];
			       $insert_cost_code_ary['project_id'] = $cost_code_insert_array['project_id'];
				   $insert_cost_code_ary['type'] =  $cost_code_insert_array['type'];
				   $insert_cost_code_ary['cost_code_id'] = $cost_code_insert_array['cost_code_id'][$i];
				   $insert_cost_code_ary['quantity'] = $cost_code_insert_array['quantity'][$i];
				   $insert_cost_code_ary['unit_cost'] = $cost_code_insert_array['unit_cost'][$i];
				   $insert_cost_code_ary['total'] = $cost_code_insert_array['total'][$i];
				   $insert_cost_code_ary['status'] = 'Not Released';
				   $insert_cost_code_ary['created_by'] = $this->user_session['ub_user_id'];
				   $insert_cost_code_ary['created_on'] = TODAY;
				   $insert_cost_code_ary['modified_by'] = $this->user_session['ub_user_id'];
				   $insert_cost_code_ary['modified_on'] = TODAY;
				   $this->write_db->insert(UB_PO_CO_COST_CODE, $insert_cost_code_ary);
				 }
			    }
			    // insert array to save the value in ub_po_co_activity table
			    $insert_activity_ary = array();
			    $insert_activity_ary['po_co_id'] = $data['insert_id'];
				$insert_activity_ary['activity_status'] = $post_array['po_status'];
				$insert_activity_ary['created_by'] = $this->user_session['ub_user_id'];
				$insert_activity_ary['created_on'] = TODAY;
				$insert_activity_ary['modified_by'] = $this->user_session['ub_user_id'];
				$insert_activity_ary['modified_on'] = TODAY;
				$this->write_db->insert(UB_PO_CO_ACTIVITY, $insert_activity_ary);

				// Send Notification
				$assigned_to[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $notification_array['assigned_to'], 
								'type' => '=',
							);
			    $where_str_assign_to = $this->Mod_po_co->build_where($assigned_to);
                $get_user_name = array(
                                    'select_fields' => array('CONCAT(first_name," ",last_name) as fullname','account_type'),
                                    'where_clause' => $where_str_assign_to
                                    );
                $assigned_user_name = $this->Mod_user->get_users($get_user_name);
                if($assigned_user_name['aaData'][0]['account_type'] == BUILDERADMIN){
				$notification_array['number'] = isset($post_array['ub_po_co_number'])?$post_array['ub_po_co_number']:'';
				$notification_array['ub_po_co_id'] = $data['insert_id'];
				$send_notification = $this->send_mail_for_notification($post_array,$notification_array);}
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
				$data['message'] = 'Insert Failed: You cross your limit';
		   }
		  }
		   else
		   {
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: You cross your limit';
		   }
		  }
		  else
		  {
		  	// If this is first po

		  	if($this->write_db->insert(UB_PO_CO, $post_array))
			{
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';

				$result = $this->Mod_builder->get_setup(array(
								'select_fields' => array('po_prefix', 'co_prefix'),
								'where_clause' => array('builder_id' => $this->user_session['builder_id'])
								));
			           if(isset($result['aaData'][0]['po_prefix']) && $result['aaData'][0]['po_prefix']!='')
					{
						$po_prefix = $result['aaData'][0]['po_prefix'];
					}
					else
					{
						$po_prefix = 'PO';
					}
					if(isset($result['aaData'][0]['co_prefix']) && $result['aaData'][0]['co_prefix']!='')
					{
						$co_prefix = $result['aaData'][0]['co_prefix'];
					}
					else
					{
						$co_prefix = 'CO';
					}
		        
		           if($post_array['type'] == 'PO' || $post_array['type'] == 'OWNER PO'){
		           	$update_array = array();
		           $update_array['ub_po_co_number'] = $this->Mod_po_co->generate_number(strtoupper($po_prefix), PO_NUMBER_LENGTH, $data['insert_id']);}
		           else if($post_array['type'] == 'CO' || $post_array['type'] == 'OWNER CO'){
		           $update_array = array();
		           $update_array['ub_po_co_number'] = $this->Mod_po_co->generate_number(strtoupper($co_prefix), PO_NUMBER_LENGTH, $data['insert_id']);}

		           $this->write_db->where('ub_po_co_id', $data['insert_id']);
				   $this->write_db->update(UB_PO_CO, $update_array);

				for($i=0; $i<count($cost_code_insert_array['cost_code_id']); $i++)
				{
				 if($cost_code_insert_array['cost_code_id'][$i] > 0)
				 {
				   $insert_cost_code_ary = array();
				   $insert_cost_code_ary['po_co_id'] = $data['insert_id'];
				   $insert_cost_code_ary['builder_id'] = $this->user_session['builder_id'];
			       $insert_cost_code_ary['project_id'] = $cost_code_insert_array['project_id'];
				   $insert_cost_code_ary['type'] =  $cost_code_insert_array['type'];
				   $insert_cost_code_ary['cost_code_id'] = $cost_code_insert_array['cost_code_id'][$i];
				   $insert_cost_code_ary['quantity'] = $cost_code_insert_array['quantity'][$i];
				   $insert_cost_code_ary['unit_cost'] = $cost_code_insert_array['unit_cost'][$i];
				   $insert_cost_code_ary['total'] = $cost_code_insert_array['total'][$i];
				   $insert_cost_code_ary['status'] = 'Not Released';
				   $insert_cost_code_ary['created_by'] = $this->user_session['ub_user_id'];
				   $insert_cost_code_ary['created_on'] = TODAY;
				   $insert_cost_code_ary['modified_by'] = $this->user_session['ub_user_id'];
				   $insert_cost_code_ary['modified_on'] = TODAY;
				   $this->write_db->insert(UB_PO_CO_COST_CODE, $insert_cost_code_ary);
				 }
			    }
			    // insert array to save the value in ub_po_co_activity table
			    $insert_activity_ary = array();
			    $insert_activity_ary['po_co_id'] = $data['insert_id'];
				$insert_activity_ary['activity_status'] = $post_array['po_status'];
				$insert_activity_ary['created_by'] = $this->user_session['ub_user_id'];
				$insert_activity_ary['created_on'] = TODAY;
				$insert_activity_ary['modified_by'] = $this->user_session['ub_user_id'];
				$insert_activity_ary['modified_on'] = TODAY;
				$this->write_db->insert(UB_PO_CO_ACTIVITY, $insert_activity_ary);

				// Send Notification
				$assigned_to[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $notification_array['assigned_to'], 
								'type' => '=',
							);
			    $where_str_assign_to = $this->Mod_po_co->build_where($assigned_to);
                $get_user_name = array(
                                    'select_fields' => array('CONCAT(first_name," ",last_name) as fullname','account_type'),
                                    'where_clause' => $where_str_assign_to
                                    );
                $assigned_user_name = $this->Mod_user->get_users($get_user_name);
                //print_r($assigned_user_name);
                if($assigned_user_name['status'] == TRUE && $assigned_user_name['aaData'][0]['account_type'] == BUILDERADMIN){
				$notification_array['number'] = isset($post_array['ub_po_co_number'])?$post_array['ub_po_co_number']:'';
				$notification_array['ub_po_co_id'] = $data['insert_id'];
				$send_notification = $this->send_mail_for_notification($post_array,$notification_array);}
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
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
	* Update update_po_co
	*
	* @method: update_po_co
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_po_co($post_array = array(),$cost_code_update_array = array())
	{
		
		if( ! empty($post_array))
		{
			
				$this->write_db->where('ub_po_co_id', $post_array['ub_po_co_id']);
				if($this->write_db->update(UB_PO_CO, $post_array))
				{
					$data['insert_id'] =  $post_array['ub_po_co_id'];
					$data['status'] = TRUE;
					$data['message'] = 'Updated successfully';

					if(! empty($cost_code_update_array)){
					if(isset($cost_code_update_array['ub_po_co_cost_code_id']) && count(array_filter($cost_code_update_array['ub_po_co_cost_code_id'])) > 0){
						
						$this->write_db->where('po_co_id', $cost_code_update_array['po_co_id']);
						$this->write_db->where_not_in('ub_po_co_cost_code_id', array_filter($cost_code_update_array['ub_po_co_cost_code_id']));
						$this->write_db->delete(UB_PO_CO_COST_CODE);
						
					}
					else{
						$this->write_db->where('po_co_id', $cost_code_update_array['po_co_id']);
						$this->write_db->delete(UB_PO_CO_COST_CODE);

					}

					//Insert/update code


					if(isset($cost_code_update_array['cost_code_id'])){

					for($i=0; $i<count($cost_code_update_array['cost_code_id']); $i++){
						
					if(isset($cost_code_update_array['ub_po_co_cost_code_id'][$i]) && $cost_code_update_array['ub_po_co_cost_code_id'][$i] > 0){
					// Update Query

					$update_array = array();
					$update_array['ub_po_co_cost_code_id'] = $cost_code_update_array['ub_po_co_cost_code_id'][$i];
					$update_array['cost_code_id'] = $cost_code_update_array['cost_code_id'][$i];
					$update_array['quantity'] = $cost_code_update_array['quantity'][$i];
					$update_array['unit_cost'] = $cost_code_update_array['unit_cost'][$i];
					$update_array['total'] = $cost_code_update_array['total'][$i];
					$update_array['modified_by'] = $this->user_session['ub_user_id'];
					$update_array['modified_on'] = TODAY;


					$this->write_db->update(UB_PO_CO_COST_CODE, $update_array, array('ub_po_co_cost_code_id'=>$cost_code_update_array['ub_po_co_cost_code_id'][$i]));

					}else if($cost_code_update_array['cost_code_id'][$i] > 0){
					// Insert Query
					$insert_ary = array();
					//new
				    $insert_ary['po_co_id'] = $cost_code_update_array['po_co_id'];
				    $insert_ary['builder_id'] = $this->user_session['builder_id'];
			        $insert_ary['project_id'] = $cost_code_update_array['project_id'];
				    $insert_ary['type'] =  $cost_code_update_array['type'];
				    $insert_ary['cost_code_id'] = $cost_code_update_array['cost_code_id'][$i];
				    $insert_ary['quantity'] = $cost_code_update_array['quantity'][$i];
				    $insert_ary['unit_cost'] = $cost_code_update_array['unit_cost'][$i];
				    $insert_ary['total'] = $cost_code_update_array['total'][$i];
				    $insert_ary['status'] = 'Not Released';
				    $insert_ary['created_by'] = $this->user_session['ub_user_id'];
				    $insert_ary['created_on'] = TODAY;
				    $insert_ary['modified_by'] = $this->user_session['ub_user_id'];
				    $insert_ary['modified_on'] = TODAY;

					$this->write_db->insert(UB_PO_CO_COST_CODE, $insert_ary);
					//$data['insert_id'] =  $this->write_db->insert_id();
					}
				  }

				 }
			   }
				 $result_po_co_id = $this->Mod_po_co->get_po_co_activity_log(array(
								'select_fields' => array('max(ub_po_co_activity_id) AS ub_po_co_activity_id'),
								'where_clause' => array('po_co_id' => $post_array['ub_po_co_id'])
								));
				 $result = $this->Mod_po_co->get_po_co_activity_log(array(
								'select_fields' => array('activity_status'),
								'where_clause' => array('ub_po_co_activity_id' => $result_po_co_id['aaData'][0]['ub_po_co_activity_id'])
								));
				 $insert_activity_ary = array();
			     $insert_activity_ary['po_co_id'] = $post_array['ub_po_co_id'];
				 $insert_activity_ary['activity_status'] = $post_array['po_status'];
				 $insert_activity_ary['created_by'] = $this->user_session['ub_user_id'];
				 $insert_activity_ary['created_on'] = TODAY;
				 $insert_activity_ary['modified_by'] = $this->user_session['ub_user_id'];
				 $insert_activity_ary['modified_on'] = TODAY;
				 if($result['aaData'][0]['activity_status'] != $post_array['po_status']){

		        	
				    $this->write_db->insert(UB_PO_CO_ACTIVITY, $insert_activity_ary);
		         }
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
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
	* Get get_po_co_activity_log information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_po_co_activity_log
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_po_co_activity_log($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_ACTIVITY.' AS PO_CO_ACTIVITY');	
 		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
		  $this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = PO_CO_ACTIVITY.created_by','left');
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
	* Get po_co_payment_list information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: po_co_payment_list
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function po_co_payment_list($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_COST_CODE.' AS PO_CO_COST_CODE');	
 		
 		if(isset($args['join']['variance_code']) && 'yes' === strtolower($args['join']['variance_code']))
        {

        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','PO_CO_COST_CODE.cost_code_id = VARIANCE_CODE.ub_cost_variance_code_id','left');
        }

		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		$res = $this->read_db->get();

		//echo $this->read_db->last_query();exit;

		 // echo $this->read_db->last_query();exit;

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
	* Get po_co_payment_list information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: po_co_payment_list
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_payment_details_transaction($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_PAYMENT_REQUEST_DETAILS.' AS PAYMENT_REQUEST_DETAILS');	
 		
 		

        if(isset($args['join']['po_co_cost_code']) && 'yes' === strtolower($args['join']['po_co_cost_code']))
        {

        $this->read_db->join(UB_PO_CO_COST_CODE.' AS PO_CO_COST_CODE','PAYMENT_REQUEST_DETAILS.po_co_cost_code_id = PO_CO_COST_CODE.ub_po_co_cost_code_id');
        }

        if(isset($args['join']['variance_code']) && 'yes' === strtolower($args['join']['variance_code']))
        {

        $this->read_db->join(UB_COST_CODE.' AS VARIANCE_CODE','VARIANCE_CODE.ub_cost_variance_code_id = PO_CO_COST_CODE.cost_code_id');
        }

		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		$res = $this->read_db->get();

		//echo $this->read_db->last_query();exit;

		 // echo $this->read_db->last_query();exit;

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
	* Get po_co_payment_list information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: po_co_payment_list
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function po_co_transaction($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_PAYMENT_TRANSACTION.' AS UB_PO_CO_PAYMENT_TRANSACTION');	
 		
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
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
	* Get po_co_payment_list information
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: po_co_payment_list
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function po_co_payment_details_list($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_PAYMENT_REQUEST_DETAILS.' AS PO_CO_PAYMENT_REQUEST_DETAILS');	
 		
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
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
		return $data;
	}

	/**
	*
	* Add Po Co Payment
	*
	* @method: add_po_co_payment
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_po_co_payment($post_array = array(), $po_co_transaction_insert_array = array(), $notification_array = array())
	{
		if( ! empty($post_array))
		{
			
			if($this->write_db->insert(UB_PO_CO_PAYMENT_REQUEST, $post_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';

				

				for($i=0; $i<count($po_co_transaction_insert_array['po_co_item_id']); $i++){

				if($po_co_transaction_insert_array['request_amount'][$i] > 0){
				//Insert array in Payment Request Details Table
				$payment_details_ary = array();
				$payment_details_ary['builder_id'] = $po_co_transaction_insert_array['builder_id'];
				$payment_details_ary['project_id'] = $po_co_transaction_insert_array['project_id'];
				$payment_details_ary['po_co_payment_request_id'] = $data['insert_id'];
				$payment_details_ary['po_co_cost_code_id'] = $po_co_transaction_insert_array['po_co_item_id'][$i];

				$payment_details_ary['request_amount'] = $po_co_transaction_insert_array['request_amount'][$i];
				$payment_details_ary['po_co_id'] = $po_co_transaction_insert_array['po_co_id'];	
				$payment_details_ary['created_by'] = $this->user_session['ub_user_id'];
				$payment_details_ary['created_on'] = TODAY;
				$payment_details_ary['modified_by'] = $this->user_session['ub_user_id'];
				$payment_details_ary['modified_on'] = TODAY;
				$this->write_db->insert(UB_PO_CO_PAYMENT_REQUEST_DETAILS, $payment_details_ary);
				$data['insert_payment_request_id'] =  $this->write_db->insert_id();
				//End

				 $payment_args = array('select_fields' => array('PO_CO_COST_CODE.paid_amount as total'),
                'where_clause' => (array('PO_CO_COST_CODE.ub_po_co_cost_code_id' =>  $po_co_transaction_insert_array['ub_po_co_cost_code_id'][$i])),
                'join' =>array('variance_code'=>'','payment'=>''),
                ); 
				$payment_data[] = $this->Mod_po_co->po_co_payment_list($payment_args);

				//Update In estimate table
				if($post_array['payment_request_status'] == 'Ready for Payment')
				{
					$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $po_co_transaction_insert_array['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
                     $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);
                     //print_r( $cost_code_result);
					$estimate_arr = array();
		    		$estimate_arr['cost_code_id'] = $po_co_transaction_insert_array['cost_code_id'][$i];
		    		$estimate_arr['invoiced_by_sub_to_date'] = $po_co_transaction_insert_array['request_amount'][$i];
		    		$estimate_arr['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		//$estimate_arr['project_id'] = $this->project_id;
		    		$estimate_arr['project_id'] = $post_array['project_id'];
		    		$this->Mod_budget->update_estimate($estimate_arr);

		    	}

		    	$payment_args = array('select_fields' => array('PO_CO_COST_CODE.requested_amount'),
		      'where_clause' => (array('ub_po_co_cost_code_id' =>  $po_co_transaction_insert_array['ub_po_co_cost_code_id'][$i])));

		    	/*$payment_args = array('select_fields' => 'PO_CO_COST_CODE.requested_amount'),
		       'where_clause' => $po_co_transaction_insert_array['ub_po_co_cost_code_id'][$i]); 
*/
		      $payment_result = $this->Mod_po_co->po_co_payment_list($payment_args);
		      //print_r(expression)
		      if($payment_result['status'] == TRUE)
		      {
		      	$payment_request = $payment_result['aaData'][0]['requested_amount'];
		      }
		      else
		      {
		      	$payment_request = 0;
		      }

					$requested_amount = $payment_request+$po_co_transaction_insert_array['request_amount'][$i];
					$update_amount = array();
					$update_amount['requested_amount'] = $requested_amount;
					//print_r($update_amount);exit;
					
				    $this->write_db->where('ub_po_co_cost_code_id', $po_co_transaction_insert_array['ub_po_co_cost_code_id'][$i]);

				    $this->write_db->update(UB_PO_CO_COST_CODE, $update_amount);

				  }  
				
			   }

                 $date=strtotime(date('Y-m-d H:i:s'));  // if today :2013-05-23

                 $newDate = date('Y-m-d H:i:s',strtotime('+2 days',$date));

                 //echo $newDate; //after15 days  :2013-06-07

               
				//print_r($notification_array);exit;
                // Send Notification
				if($post_array['payment_request_status'] == 'Payment request created')
			    {
			      $notification_array['template_type'] = 'budget_po_co_payment_request_created';
			      $notification_array['id'] = $data['insert_id'];
			      $notification_array['amount'] = $post_array['total_requested_amount'];
		    	  $send_notification = $this->send_mail_for_notification($post_array,$notification_array);
		    	  
		        }
		        if($post_array['payment_request_status'] == 'Ready for Payment')
			    {
			     
		    	 $send_notification = $this->send_mail_for_notification($post_array,$notification_array);
		        }
		          //Reminder
		    	  /* FETCH BUILDER NAME */
					$condition_post_array =  array('ub_builder_id'=>$this->user_session['builder_id']);
					$builder_details_array = $this->Mod_builder->get_builder_details(array(
														'select_fields' => array('builder_name'),
														'where_clause' => $condition_post_array
														));
					$builder_name = $builder_details_array['aaData']['0']['builder_name'];
		    	  $parse_data = array(
									'builder_name' =>$builder_name,
									'project_name' =>$this->project_name,
									'type' => $notification_array['type'],
									'title' =>$notification_array['title'],
									'username' =>$notification_array['name'],
									'date' =>$notification_array['date'],
									'payment_id' =>$data['insert_id'],
									);
		    	  $reminder_table_insert_array = array(
											'builder_id' => $this->user_session['builder_id'],
											'project_id' => $post_array['project_id'],
											'module_name' => $this->module,
											'module_pk_id' => $data['insert_id'],
											'reminder_sent_to' => $notification_array['assigned_to'],
											'reminder_sent_on' => $newDate,
											'reminder_end_time' => $newDate,
											'reminder_duration' => 24*60,
											'parse_data' => $parse_data,
											'template_name' => 'budget_po_co_payment_reminder',
											'status' => 'Not Send'
											);
		          $insert_in_reminder_table  = $this->Mod_reminder->add_reminder($reminder_table_insert_array);

				$data['status'] = TRUE;
				$data['message'] = 'Insert successfully';

			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
			//echo $this->write_db->last_query();exit;

			
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
	* Add Po Co Payment
	*
	* @method: add_po_co_payment
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function update_po_co_payment($post_array = array(), $po_co_transaction_insert_array = array(), $notification_array = array())
	{
		if( ! empty($post_array))
		{
			
			$result_payment = $this->Mod_po_co->get_po_payment(array(
								'select_fields' => array('total_paid_amount','total_requested_amount'),
								'where_clause' => array('ub_po_co_payment_request_id' => $post_array['ub_po_co_payment_request_id'])
								));
			if($this->user_account_type == BUILDERADMIN){
			$update_po_co_arr = array();

			
			$update_po_co_arr['paid_amount'] = array_sum($po_co_transaction_insert_array['paid_amount'])+array_sum($po_co_transaction_insert_array['pay_amount']);

			
			$this->write_db->where('ub_po_co_id', $post_array['po_co_id']);
			$this->write_db->update(UB_PO_CO, $update_po_co_arr);
			}
			//Update In Payment request Table
			$payment_request_ary = array();
			

			$payment_request_ary['total_requested_amount'] = array_sum($po_co_transaction_insert_array['requested_amount']);
			
			
				$payment_request_ary['payment_request_status'] = $post_array['payment_request_status'];
			
			if($this->user_account_type == BUILDERADMIN)
			{
				//unset($payment_request_ary['total_requested_amount']);
				if($notification_array['assigned_to'] != $this->user_session['ub_user_id']){
					//unset($payment_request_ary['payment_request_status']);
				}
				$payment_request_ary['total_paid_amount'] = $result_payment['aaData'][0]['total_paid_amount']+array_sum($po_co_transaction_insert_array['pay_amount']);
				$payment_request_ary['pay_to'] = $po_co_transaction_insert_array['pay_to'];
				
				if(isset($po_co_transaction_insert_array['pay_amount']) && count(array_filter($po_co_transaction_insert_array['pay_amount'])) > 0){

					if($payment_request_ary['total_requested_amount'] == $payment_request_ary['total_paid_amount'])
					{
						$payment_request_ary['payment_request_status'] = 'Paid';

						$get_po_co_payment_status = $this->Mod_po_co->get_po_co(array(
								'select_fields' => array('total_amount','paid_amount'),
								'where_clause' => array('ub_po_co_id' => $post_array['po_co_id'])
								));
						if($get_po_co_payment_status['aaData'][0]['total_amount'] == $get_po_co_payment_status['aaData'][0]['paid_amount'])
						{
							$upp_arr = array();
							$upp_arr['payment_status'] = 'Paid';
							$this->write_db->where('ub_po_co_id', $post_array['po_co_id']);
			                $this->write_db->update(UB_PO_CO, $upp_arr);
						}
						else
						{
							$upp_arr = array();
							$upp_arr['payment_status'] = 'Partial payment done';
							$this->write_db->where('ub_po_co_id', $post_array['po_co_id']);
			                $this->write_db->update(UB_PO_CO, $upp_arr);
						}
					}
					else
					{
						$payment_request_ary['payment_request_status'] = 'Partial payment done';
						$upp_arr = array();
						$upp_arr['payment_status'] = 'Partial payment done';
						$this->write_db->where('ub_po_co_id', $post_array['po_co_id']);
			            $this->write_db->update(UB_PO_CO, $upp_arr);
					}
					

				}
			}
			$payment_request_ary['modified_by'] = $this->user_session['ub_user_id'];
			$payment_request_ary['modified_on'] = TODAY;
			//print_r($payment_request_ary);
			$this->write_db->where('ub_po_co_payment_request_id', $post_array['ub_po_co_payment_request_id']);
			if($this->write_db->update(UB_PO_CO_PAYMENT_REQUEST, $payment_request_ary))
			{
				$data['insert_id'] =  $post_array['ub_po_co_payment_request_id'];
				$data['status'] = TRUE;
				$data['message'] = 'Data Update successfully';

				
		        //print_r($po_co_transaction_insert_array['po_co_item_id']);
				for($i=0; $i<count($po_co_transaction_insert_array['po_co_item_id']); $i++){

				//Update array in Payment Request Details Table
				if($po_co_transaction_insert_array['pay_amount'][$i] > 0){
				$payment_details_ary = array();
				$payment_details_ary['total_paid_amount'] = $po_co_transaction_insert_array['total_paid_amount'][$i]+$po_co_transaction_insert_array['pay_amount'][$i];	
				$payment_details_ary['last_transaction_amount'] = $po_co_transaction_insert_array['pay_amount'][$i];
				$payment_details_ary['request_amount'] = $po_co_transaction_insert_array['requested_amount'][$i];	
				$payment_details_ary['modified_by'] = $this->user_session['ub_user_id'];
				$payment_details_ary['modified_on'] = TODAY;
				$this->write_db->where('po_co_payment_request_id', $post_array['ub_po_co_payment_request_id']);
				$this->write_db->where('po_co_cost_code_id', $po_co_transaction_insert_array['po_co_item_id'][$i]);
				
			    
				$this->write_db->update(UB_PO_CO_PAYMENT_REQUEST_DETAILS, $payment_details_ary);
			    $data['insert_payment_request_id'] =   $post_array['ub_po_co_payment_request_id'];
			   }
		 	
				
				//insert in Transaction Table
			    //print_r($po_co_transaction_insert_array);
			    if($po_co_transaction_insert_array['pay_amount'][$i] > 0){
				$insert_ary = array();
				$insert_ary['builder_id'] = $po_co_transaction_insert_array['builder_id'];
				$insert_ary['project_id'] = $po_co_transaction_insert_array['project_id'];
				$insert_ary['po_co_payment_request_id'] = $post_array['ub_po_co_payment_request_id'];
				$insert_ary['po_co_payment_request_details_id'] = $po_co_transaction_insert_array['ub_po_co_payment_request_details_id'][$i];
				$insert_ary['po_co_cost_code_id'] = $po_co_transaction_insert_array['ub_po_co_cost_code_id'][$i];
				$insert_ary['po_co_id'] = $po_co_transaction_insert_array['po_co_id'];
				$insert_ary['pay_amount'] = $po_co_transaction_insert_array['pay_amount'][$i];
				//$insert_ary['requested_amount'] = $po_co_transaction_insert_array['requested_amount'][$i];
				$insert_ary['transaction_status'] = $po_co_transaction_insert_array['status'];	
				$insert_ary['created_by'] = $this->user_session['ub_user_id'];
				$insert_ary['created_on'] = TODAY;
				$insert_ary['modified_by'] = $this->user_session['ub_user_id'];
				$insert_ary['modified_on'] = TODAY;
				$this->write_db->insert(UB_PO_CO_PAYMENT_TRANSACTION, $insert_ary);}
				

				 $payment_args = array('select_fields' => array('PO_CO_COST_CODE.paid_amount as total','PO_CO_COST_CODE.requested_amount'),
                'where_clause' => (array('PO_CO_COST_CODE.ub_po_co_cost_code_id' =>  $po_co_transaction_insert_array['ub_po_co_cost_code_id'][$i])),
                'join' =>array('variance_code'=>'','payment'=>''),
                ); 
				$payment_data[] = $this->Mod_po_co->po_co_payment_list($payment_args);
				//Update In estimate table
				$payment_status = $this->Mod_po_co->get_po_payment(array(
									'select_fields' => array('PO_CO_PAYMENT_REQUEST.payment_request_status'),
									'where_clause' => array('PO_CO_PAYMENT_REQUEST.ub_po_co_payment_request_id'=> $post_array['ub_po_co_payment_request_id'])));

				if($payment_status['status'] == TRUE && ($payment_status['aaData'][0]['payment_request_status'] == 'Approved' || $payment_status['aaData'][0]['payment_request_status'] == 'Partial payment done' || $payment_status['aaData'][0]['payment_request_status'] == 'Paid'))
				{
					if($po_co_transaction_insert_array['pay_amount'][$i] > 0){
					$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $po_co_transaction_insert_array['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
                     $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);
					$estimate_arr = array();
		    		$estimate_arr['cost_code_id'] = $po_co_transaction_insert_array['cost_code_id'][$i];
		    		$estimate_arr['amount_paid_to_sub'] = $po_co_transaction_insert_array['pay_amount'][$i];
		    		$estimate_arr['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		if($payment_status['status'] == TRUE && ($payment_status['aaData'][0]['payment_request_status'] == 'Approved' && $post_array['payment_request_status'] == 'Ready for Payment'))
		    		{
		    		$estimate_arr['invoiced_by_sub_to_date'] = $po_co_transaction_insert_array['requested_amount'][$i];
		    	    }
		    		//$estimate_arr['project_id'] = $this->project_id;
		    		$estimate_arr['project_id'] = $po_co_transaction_insert_array['project_id'];
		    		$this->Mod_budget->update_estimate($estimate_arr);
		    	  }
				}

				else if($post_array['payment_request_status'] == 'Ready for Payment')
				{
					$cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $po_co_transaction_insert_array['cost_code_id'][$i])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
                     $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);
					$estimate_arr = array();
		    		$estimate_arr['cost_code_id'] = $po_co_transaction_insert_array['cost_code_id'][$i];
		    		$estimate_arr['invoiced_by_sub_to_date'] = $po_co_transaction_insert_array['requested_amount'][$i];
		    		$estimate_arr['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		//$estimate_arr['project_id'] = $this->project_id;
		    		$estimate_arr['project_id'] = $po_co_transaction_insert_array['project_id'];
		    		$this->Mod_budget->update_estimate($estimate_arr);
				}

			}
				for($paid=0; $paid < count($payment_data) ; $paid++) {

					
					$paid_amount = $po_co_transaction_insert_array['pay_amount'][$paid] + $payment_data[$paid]['aaData'][0]['total'];
					
					$requested_amount = $po_co_transaction_insert_array['requested_amount'][$paid];
					$update_amount = array();
					$update_amount['paid_amount'] = $paid_amount;
					//$update_amount['requested_amount'] = $requested_amount;
					
				    $this->write_db->where('ub_po_co_cost_code_id', $po_co_transaction_insert_array['ub_po_co_cost_code_id'][$paid]);

				    $this->write_db->update(UB_PO_CO_COST_CODE, $update_amount);
				    
				}


                 if($this->user_account_type == BUILDERADMIN && isset($po_co_transaction_insert_array['pay_amount']) && count(array_filter($po_co_transaction_insert_array['pay_amount'])) > 0){

		          $notification_array['template_type'] = 'budget_po_co_payment_made';
			      $notification_array['id'] = $post_array['ub_po_co_payment_request_id'];
			      $notification_array['amount'] = array_sum($po_co_transaction_insert_array['pay_amount']);
			      $notification_array['value'] = $post_array['total_po_co_amount'];
		    	  $send_notification = $this->send_mail_for_notification($post_array,$notification_array);
		        }
		        else if($post_array['payment_request_status'] == 'Payment request created')
			    {
			      $notification_array['template_type'] = 'budget_po_co_payment_request_created';
			      $notification_array['id'] = $post_array['ub_po_co_payment_request_id'];
			      $notification_array['amount'] = $post_array['total_requested_amount'];
		    	  $send_notification = $this->send_mail_for_notification($post_array,$notification_array);
		        }
		        else if($post_array['payment_request_status'] == 'Ready for Payment')
				{
			   
		    	 $send_notification = $this->send_mail_for_notification($post_array,$notification_array);
		    	}
		    	


				$data['status'] = TRUE;
				$data['message'] = 'Update successfully';

			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Update Failed: Failed to insert the data';
			}
			
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Update Failed: Post array is empty';
		}
		//echo $this->write_db->last_query();exit;
		return $data;			
	}

	/**
	*
	* Void Payment
	*
	* @method: add_po_co_payment
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function void_payment($void_transaction_insert_array = array())
	{
		if( ! empty($void_transaction_insert_array))
		{
			//Get paid amount from ub_po_co table

			$result_po_co = $this->Mod_po_co->get_po_co(array(
								'select_fields' => array('PO_CO.paid_amount'),
								'where_clause' => array('PO_CO.ub_po_co_id' => $void_transaction_insert_array['po_co_id'])
								));

			//Get total paid amount from ub_po_co_payment_request table
			$result_po_co_payment = $this->Mod_po_co->get_po_payment(array(
								'select_fields' => array('PO_CO_PAYMENT_REQUEST.total_paid_amount'),
								'where_clause' => array('PO_CO_PAYMENT_REQUEST.ub_po_co_payment_request_id' => $void_transaction_insert_array['ub_po_co_payment_request_id'])
								));

			for($i=0; $i<count($void_transaction_insert_array['ub_po_co_payment_request_details_id']); $i++){
			$result_payment[] = $this->Mod_po_co->get_payment_details_transaction(array(
								'select_fields' => array('PAYMENT_REQUEST_DETAILS.last_transaction_amount','PAYMENT_REQUEST_DETAILS.total_paid_amount'),
								'where_clause' => array('PAYMENT_REQUEST_DETAILS.ub_po_co_payment_request_details_id' => $void_transaction_insert_array['ub_po_co_payment_request_details_id'][$i])
								));

			$cost_code_data[] = $this->Mod_po_co->get_po_co_cost_code(array(
								'select_fields' => array('PO_CO_COST_CODE.paid_amount'),
								'where_clause' => array('PO_CO_COST_CODE.ub_po_co_cost_code_id' =>  $void_transaction_insert_array['ub_po_co_cost_code_id'][$i])
								));

			
		    }
		    $last_transaction_amount = 0.00;
		    for($paid=0; $paid < count($result_payment) ; $paid++) {

		    	$last_transaction_amount += $result_payment[$paid]['aaData'][0]['last_transaction_amount'];

		      //Update in ub_po_co_payment_request_details table
		      $update_po_co_payment_request_details_arr = array();
			  $update_po_co_payment_request_details_arr['total_paid_amount'] = $result_payment[$paid]['aaData'][0]['total_paid_amount'] - $result_payment[$paid]['aaData'][0]['last_transaction_amount'];

			  $update_po_co_payment_request_details_arr['last_transaction_amount'] = $result_payment[$paid]['aaData'][0]['last_transaction_amount'] - $result_payment[$paid]['aaData'][0]['last_transaction_amount'];

			  $this->write_db->where('ub_po_co_payment_request_details_id',$void_transaction_insert_array['ub_po_co_payment_request_details_id'][$paid]);
			  $this->write_db->update(UB_PO_CO_PAYMENT_REQUEST_DETAILS, $update_po_co_payment_request_details_arr);

			  // Update in ub_po_co_cost_code table
			  $update_po_co_cost_code_arr = array();
			  $update_po_co_cost_code_arr['paid_amount'] = $cost_code_data[$paid]['aaData'][0]['paid_amount'] - $result_payment[$paid]['aaData'][0]['last_transaction_amount'];

			  $this->write_db->where('ub_po_co_cost_code_id',$void_transaction_insert_array['ub_po_co_cost_code_id'][$paid]);
			  $this->write_db->update(UB_PO_CO_COST_CODE, $update_po_co_cost_code_arr);

			  //Insert in ub_po_co_payment_transaction table
			  $insert_ary = array();
			  $insert_ary['builder_id'] = $void_transaction_insert_array['builder_id'];
			  $insert_ary['project_id'] = $void_transaction_insert_array['project_id'];
			  $insert_ary['po_co_payment_request_id'] = $void_transaction_insert_array['ub_po_co_payment_request_id'];
			  $insert_ary['po_co_payment_request_details_id'] = $void_transaction_insert_array['ub_po_co_payment_request_details_id'][$paid];
			  $insert_ary['po_co_cost_code_id'] = $void_transaction_insert_array['ub_po_co_cost_code_id'][$paid];
			  $insert_ary['po_co_id'] = $void_transaction_insert_array['po_co_id'];
			  $insert_ary['pay_amount'] = -$result_payment[$paid]['aaData'][0]['last_transaction_amount'];
			  $insert_ary['transaction_status'] = $void_transaction_insert_array['status'];		
			  $insert_ary['created_by'] = $this->user_session['ub_user_id'];
			  $insert_ary['created_on'] = TODAY;
			  $insert_ary['modified_by'] = $this->user_session['ub_user_id'];
			  $insert_ary['modified_on'] = TODAY;
			  $this->write_db->insert(UB_PO_CO_PAYMENT_TRANSACTION, $insert_ary);

			  $cost_code_args = array('select_fields' => array('VARIANCE_CODE.cost_variance_code'),
                     'where_clause' => (array('VARIANCE_CODE.ub_cost_variance_code_id' =>  $void_transaction_insert_array['cost_code_id'][$paid])),'join' =>array('variance_code'=>'Yes','payment'=>''),); 
                     $cost_code_result = $this->Mod_po_co->po_co_payment_list($cost_code_args);
					$estimate_arr = array();
		    		$estimate_arr['cost_code_id'] = $void_transaction_insert_array['cost_code_id'][$paid];
		    		$estimate_arr['amount_paid_to_sub'] = $insert_ary['pay_amount'];
		    		$estimate_arr['cost_code_name'] = $cost_code_result['aaData'][0]['cost_variance_code'];
		    		//$estimate_arr['project_id'] = $this->project_id;
		    		$estimate_arr['project_id'] = $void_transaction_insert_array['project_id'];
		    		$this->Mod_budget->update_estimate($estimate_arr);

		    		//echo $this->write_db->last_query();exit;

		    }
			
			$update_po_co_arr = array();
			$update_po_co_arr['paid_amount'] = $result_po_co['aaData'][0]['paid_amount'] - $last_transaction_amount;
			$update_po_co_arr['payment_status'] = 'made void';
			$this->write_db->where('ub_po_co_id', $void_transaction_insert_array['po_co_id']);
			$this->write_db->update(UB_PO_CO, $update_po_co_arr);

			$update_po_co_payment_arr = array();
			$update_po_co_payment_arr['total_paid_amount'] = $result_po_co_payment['aaData'][0]['total_paid_amount'] - $last_transaction_amount;
			$update_po_co_payment_arr['payment_request_status'] = 'made void';

			$this->write_db->where('ub_po_co_payment_request_id', $void_transaction_insert_array['ub_po_co_payment_request_id']);
			if($this->write_db->update(UB_PO_CO_PAYMENT_REQUEST, $update_po_co_payment_arr))
			{
				//echo "hi";exit;
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
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
	*
	* Update update_po_co_status_estimate
	*
	* @method: update_po_co
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_po_co_status($post_array = array(),$notification_array = array())
	{
		//print_r($post_array);

		
		if( ! empty($post_array))
		{
				$status_arr = array();
				$status_arr['po_status'] = $post_array['po_status'];
				$this->write_db->where('ub_po_co_id', $post_array['ub_po_co_id']);
				if($this->write_db->update(UB_PO_CO, $status_arr))
				{
					$activity_log = array();
					$activity_log['activity_status'] = $post_array['po_status'];
					$activity_log['po_co_id'] = $post_array['ub_po_co_id'];
					$activity_log['created_on'] = TODAY;
					$activity_log['created_by'] = $this->user_session['ub_user_id'];
					$activity_log['modified_by'] = $this->user_session['ub_user_id'];
					$activity_log['modified_on'] = TODAY;
					//unset($post_array['po_status']);
					//unset($post_array['ub_po_co_id']);
					$this->write_db->insert(UB_PO_CO_ACTIVITY, $activity_log);
					

					$data['status'] = TRUE;
					$data['message'] = $post_array['type'].' '.$post_array['po_status'];

					$send_notification = $this->send_mail_for_notification($post_array,$notification_array);

				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
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
	* Update update_po_co_status_estimate
	*
	* @method: update_po_co
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_payment_status($post_array = array())
	{
		//print_r($post_array);

		
		if( ! empty($post_array))
		{
				$this->write_db->where('ub_po_co_payment_request_id', $post_array['ub_po_co_payment_request_id']);
				if($this->write_db->update(UB_PO_CO_PAYMENT_REQUEST, $post_array))
				{
				
					$data['status'] = TRUE;
					$data['message'] = 'Update successfully';

				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update failed';
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
	* @method: get_voucher
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh kumar
	*/
	public function get_voucher($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_VOUCHER.' AS VOUCHER');	
 		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
		  $this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = VOUCHER.created_by','left');
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
		$res = $this->read_db->get();
		 // echo $this->read_db->last_query();exit;
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
	* @method: get_voucher_transaction
	* @access: public 
	* @param: args
	* @return: array
	* @created by: satheesh kumar
	*/
	public function get_voucher_transaction($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_VOUCHER_TRANSACTION.' AS VOUCHER_TRANSACTION');	
 		if(isset($args['join']['user']) && 'yes' === strtolower($args['join']['user']))
		{
		  $this->read_db->join('ub_user'.' AS USER','USER.ub_user_id = VOUCHER_TRANSACTION.created_by','left');
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
		return $data;
	}

	public function delete_po_co($delete_array)
	{
		//echo '<pre>';print_r($delete_array);exit;
		if(isset($delete_array['ub_po_co_id']))
		{
			//echo '<pre>';print_r($delete_array);exit;
			foreach($delete_array['ub_po_co_id'] as $key=>$ub_po_co_id)
			{
				//$this->write_db->delete(UB_PO_CO, array('ub_po_co_id' => $ub_po_co_id));
				$post_array['is_delete'] = 'Yes';
				$post_array['modified_by'] = $this->user_id;
				$post_array['modified_on'] = TODAY;
				$this->write_db->where('ub_po_co_id', $ub_po_co_id);
				$this->write_db->update(UB_PO_CO, $post_array);

				/* Find folder id */
				$ui_folder_name = 'poco'.$ub_po_co_id;
				/* Based on checklist id find project id */
				$project_id_array = $this->get_po_co(array(
					'select_fields' => array('PO_CO.project_id','PO_CO.type','PO_CO.po_status'),
					'where_clause' => array('PO_CO.ub_po_co_id'=>$ub_po_co_id)
				));
				if($project_id_array['aaData'][0]['type'] == 'PO' && $project_id_array['aaData'][0]['po_status'] == 'Released')
				{
					//echo "hi";exit;
					$cost_code_args = array('select_fields' => array('PO_CO_COST_CODE.cost_code_id','VARIANCE_CODE.cost_variance_code'),
                    'where_clause' => (array('PO_CO_COST_CODE.po_co_id' =>  $ub_po_co_id)),'join' =>array('po_co'=>'Yes','variance_code'=>'Yes')); 

		           $cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);
		           //echo count($cost_code_result['aaData']);
		           //print_r($cost_code_result);exit;
		           for($i=0; $i< count($cost_code_result['aaData']); $i++)
		           {
		           	 $insert_ary['cost_code_id'] = $cost_code_result['aaData'][$i]['cost_code_id'];
		    		 $insert_ary['cost_code_name'] = $cost_code_result['aaData'][$i]['cost_variance_code'];
		    		 $insert_ary['project_id'] = $project_id_array['aaData'][0]['project_id'];
		    		 $insert_ary['po_release_count'] = -1;
		    		 $this->Mod_budget->update_estimate($insert_ary);
		           }
				}
				$project_id = $project_id_array['aaData'][0]['project_id'];
				/* Module name */
				$module_name = $this->module;
				$folder_structure_delete = $this->Mod_po_co->folder_structure_delete($ui_folder_name, $project_id, $module_name, $ub_po_co_id);
				/* Delete in reminder table */
				$delete_reminder = $this->Mod_reminder->delete_reminder($ub_po_co_id, $module_name, $this->builder_id);
			}
			//echo "Deleted Sucessfully";
			$data['type'] = $project_id_array['aaData'][0]['type'];
			$data['status'] = TRUE;
			$data['message'] = 'Record deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Bid id is not set';
		}
		return $data;

	}


	/**
	*
	* Add Voucher
	*
	* @method: add_voucher
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_voucher($post_array = array())
	{
		if( ! empty($post_array))
		{
			$account_type_args = array('select_fields' => array('USER.account_type'),
                'where_clause' => (array('USER.ub_user_id' =>  $post_array['user_id'])),
                ); 
			$account_type_data = $this->Mod_user->get_users($account_type_args);

			if($account_type_data['aaData'][0]['account_type'] == SUBCONTRACTOR)
			{
				$user_args = array('select_fields' => array('UB_SUBCONTRACTOR.company','UB_USER.address','UB_USER.city','UB_USER.province','UB_USER.postal','UB_USER.desk_phone','UB_USER.mobile_phone','UB_USER.fax','UB_USER.primary_email'),
                'where_clause' => (array('UB_SUBCONTRACTOR.user_id' =>  $post_array['user_id'])),'join' =>array('builder'=>'Yes')); 
			   $user_data = $this->Mod_subcontractor->get_sub_contractors($user_args);
			}

			if($account_type_data['aaData'][0]['account_type'] == BUILDERADMIN)
			{
				$user_args = array('select_fields' => array('(USER.first_name) AS company','USER.address','USER.city','USER.province','USER.postal','USER.desk_phone','USER.mobile_phone','USER.fax','USER.primary_email'),
                'where_clause' => (array('USER.ub_user_id' =>  $post_array['user_id'])),'join' =>array('builder'=>'','project_user'=>'','project_manager'=>'',)
                ); 
			   $user_data = $this->Mod_user->get_users($user_args);
			   //echo $this->read_db->last_query();exit;
			}
			

			$project_args = array('select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.postal','PROJECT.country'),
                'where_clause' => (array('PROJECT.ub_project_id' =>  $post_array['project_id'])),
                ); 
			$project_data = $this->Mod_project->get_projects($project_args);

			
			$post_array['company'] = $user_data['aaData'][0]['company'];
			$post_array['email'] = $user_data['aaData'][0]['primary_email'];
			$post_array['address'] = $user_data['aaData'][0]['address'];
			$post_array['city'] = $user_data['aaData'][0]['city'];
			$post_array['province'] = $user_data['aaData'][0]['province'];
			$post_array['postal'] = $user_data['aaData'][0]['postal'];
			$post_array['desk_phone'] = $user_data['aaData'][0]['desk_phone'];
			$post_array['mobile_phone'] = $user_data['aaData'][0]['mobile_phone'];
			$post_array['fax'] = $user_data['aaData'][0]['fax'];
			$post_array['project_no'] = $post_array['project_id'];
			$post_array['project_name'] = $project_data['aaData'][0]['project_name'];
			$post_array['project_address'] = $project_data['aaData'][0]['address'];
			$post_array['project_city'] = $project_data['aaData'][0]['city'];
			$post_array['project_province'] = $project_data['aaData'][0]['province'];
			$post_array['project_postal'] = $project_data['aaData'][0]['postal'];
			$post_array['project_country'] = $project_data['aaData'][0]['country'];
			$post_array['created_by'] = $this->user_session['ub_user_id'];
			$post_array['created_on'] = TODAY;
			$post_array['modified_by'] = $this->user_session['ub_user_id'];
			$post_array['modified_on'] = TODAY;
			//print_r($post_array);exit;
			if($this->write_db->insert(UB_VOUCHER, $post_array))
			{
				$data['insert_id'] =  $this->write_db->insert_id();
				$data['status'] = TRUE;
				$data['message'] = 'Data inserted successfully';

				$update_array['voucher_no'] = $this->Mod_po_co->generate_number(VOUCHER_NAME_FORMAT, VOUCHER_NUMBER_LENGTH,$data['insert_id']);

				$this->write_db->where('ub_voucher_id', $data['insert_id']);
				$this->write_db->update(UB_VOUCHER, $update_array);

			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to insert the data';
			}
			//echo $this->write_db->last_query();exit;

			
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
	* Add Voucher Transaction
	*
	* @method: add_voucher_transaction
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_voucher_transaction($post_array = array())
	{
		if( ! empty($post_array))
		{
			if($this->write_db->insert(UB_VOUCHER_TRANSACTION, $post_array))
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
			//echo $this->write_db->last_query();exit;

			
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
	* Send Mail Notification
	*
	* @method: send_mail_for_notification
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function send_mail_for_notification($post_array = array(),$notification_array = array())
	{
	
		//$project_id = $this->project_id;
		$project_id = $notification_array['project_id'];
		
		if(isset($notification_array['assigned_to']))
		{
			$assigned_to[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $notification_array['assigned_to'], 
								'type' => '=',
							);
			$where_str_assign_to = $this->Mod_po_co->build_where($assigned_to);
         $get_user_name = array(
                                    'select_fields' => array('CONCAT(first_name," ",last_name) as fullname','account_type'),
                                    'where_clause' => $where_str_assign_to
                                    );
         $assigned_user_name = $this->Mod_user->get_users($get_user_name);
		}
		
		if($notification_array['template_type'] == 'budget_payapp_released' || $notification_array['template_type'] == 'budget_payapp_payment_made')
		{
			/* Find user id based on builder id */
		if(isset($notification_array['builder_id']) && !empty($notification_array['builder_id']))
		{
			$where_builder_str = array('builder_id' => $notification_array['builder_id'],'account_type' => BUILDERADMIN );
			$get_builder_user_id = array(
							'select_fields' => array('ub_user_id'),
						'where_clause' => $where_builder_str
						);
			$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
			$notification_array['builder_id'] = $builder_user_id_details['aaData'][0]['ub_user_id'];
		}
			$where_owner_str = array('ub_project_id' => $notification_array['project_id']);
				$get_owner_user_id = array(
								'select_fields' => array('owner_id'),
								'where_clause' => $where_owner_str
								);
				$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
				if($owner_id_details['status'] == TRUE)
				{
					$owner_id = $owner_id_details['aaData'][0]['owner_id'];
					$notification_array['builder_id'] = $owner_id.''.$notification_array['builder_id'];
				}
		}
		$mail_user_id = $this->Mod_notification->get_mail_preference_user_id($notification_array['builder_id'],$this->main_modules[$this->module]);


			$post_array_value[] = array(
								'field_name' => 'ub_user_id',
								'value'=> $mail_user_id, 
								'type' => '||',
								'classification' => 'primary_ids'
							);
			$where_str = $this->Mod_po_co->build_where($post_array_value);
         $get_all_users = array(
                                    'select_fields' => array('ub_user_id', 'CONCAT(first_name," ",last_name) as fullname','primary_email','first_name'),
                                    'where_clause' => $where_str
                                    );
         $all_users = $this->Mod_user->get_users($get_all_users);
         if($all_users['status'] == TRUE)
		 {
		 $user_list = $all_users['aaData'];
		 if(isset($user_list) && !empty($user_list))
		 {
			foreach($user_list as $key => $val)
			{
				$email_ids[] = $val['primary_email'];
				$email_id = $val['primary_email'];
				$name = $val['fullname'];
				$level2_array[] = $name.EMAIL_SEPERATOR_LEVEL2.$email_id.EMAIL_SEPERATOR_LEVEL2.'bcc';
			}
			$level1_string = implode(EMAIL_SEPERATOR_LEVEL1,$level2_array);
		 }}else{
			return FALSE;
		 }
		
		 $username_array = $this->user_session;
		 $added_by_first_name = $username_array['first_name'];

		 /* FETCH BUILDER NAME */
		 $condition_post_array =  array('ub_user_id'=>$notification_array['builder_id']);
		$builder_details_array = $this->Mod_user->get_users(array(
												'select_fields' => array('first_name'),
												'where_clause' => $condition_post_array
												));
		$builder_name = $builder_details_array['aaData']['0']['first_name'];

		//echo $this->builder_id;exit;
		$scheduler  = $this->Mod_builder->get_builder_logo($this->user_session['builder_id']); 
		
			if($notification_array['ub_po_co_id'] > 0 )
			{
				
				/* Owner adding means sending mail to builder */
				if($this->user_account_type == BUILDERADMIN)
				{
					$user_type = 'BUILDER';
				}
				if($this->user_account_type == SUBCONTRACTOR)
				{
					$user_type = 'SUBCONTRACTOR';
				}
				if($this->user_account_type == OWNER)
				{
					$user_type = 'OWNER';
				}
				if($notification_array['template_type'] == 'budget_po_co_approved'){
					$primary_id = $notification_array['ub_po_co_id'];
					$template_type = 'budget_po_co_approved';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'project_name' => $notification_array['project_name'],
						'on' => $notification_array['on'],
						'type' => $notification_array['type'],
						'status' => $notification_array['status'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'date' => $notification_array['date'],
						'name' => $notification_array['name'],
						'builder_name' => $builder_name,
						'user_type' => $user_type,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}
				if($notification_array['template_type'] == 'budget_po_co_ready_for_payment'){
					$primary_id = $notification_array['ub_po_co_id'];
					$template_type = 'budget_po_co_ready_for_payment';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'project_name' => $notification_array['project_name'],
						'on' => $notification_array['on'],
						'type' => $notification_array['type'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'date' => $notification_array['date'],
						'name' => $notification_array['name'],
						'assigned_to' => $assigned_user_name['aaData'][0]['fullname'],
						'builder_name' => $builder_name,
						'user_type' => $user_type,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}

				if($notification_array['template_type'] == 'budget_po_co_payment_request_created'){
					$primary_id = $notification_array['ub_po_co_id'];
					$template_type = 'budget_po_co_payment_request_created';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'project_name' => $notification_array['project_name'],
						'on' => $notification_array['on'],
						'type' => $notification_array['type'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'date' => $notification_array['date'],
						'name' => $notification_array['name'],
						'assigned_to' => $assigned_user_name['aaData'][0]['fullname'],
						'builder_name' => $builder_name,
						'id' => $notification_array['id'],
						'amount' => $notification_array['amount'],
						'user_type' => $user_type,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}

					if($notification_array['template_type'] == 'budget_po_co_payment_made'){
					$primary_id = $notification_array['ub_po_co_id'];
					$template_type = 'budget_po_co_payment_made';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'project_name' => $notification_array['project_name'],
						'on' => $notification_array['on'],
						'type' => $notification_array['type'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'date' => $notification_array['date'],
						'name' => $notification_array['name'],
						'assigned_to' => $assigned_user_name['aaData'][0]['fullname'],
						'builder_name' => $builder_name,
						'id' => $notification_array['id'],
						'amount' => $notification_array['amount'],
						'value' => $notification_array['value'],
						'user_type' => $user_type,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}
				if($assigned_user_name['status'] == TRUE && $assigned_user_name['aaData'][0]['account_type'] == BUILDERADMIN){
				if($notification_array['template_type'] == 'budget_po_co_assigned_internally'){
					$primary_id = $notification_array['ub_po_co_id'];
					$template_type = 'budget_po_co_assigned_internally';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'project_name' => $notification_array['project_name'],
						'on' => $notification_array['on'],
						'type' => $notification_array['type'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'date' => $notification_array['date'],
						'name' => $notification_array['name'],
						'assigned_to' => $assigned_user_name['aaData'][0]['fullname'],
						'builder_name' => $builder_name,
						'on' => $notification_array['on'],
						'user_type' => $user_type,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}
			   }

			   //

				if($notification_array['template_type'] == 'budget_po_co_document_overridden'){
					$primary_id = $notification_array['ub_po_co_id'];
					$template_type = 'budget_po_co_document_overridden';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'document_name' => $notification_array['document_name'],
						'project_name' => $notification_array['project_name'],
						'on' => $notification_array['on'],
						'type' => $notification_array['type'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'date' => $notification_array['date'],
						'name' => $notification_array['name'],
						'assigned_to' => $assigned_user_name['aaData'][0]['fullname'],
						'builder_name' => $builder_name,
						'on' => $notification_array['on'],
						'user_type' => $user_type,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
				}

					if($notification_array['template_type'] == 'budget_po_co_required_document_uploaded')
					{
					$primary_id = $notification_array['ub_po_co_id'];
					$template_type = 'budget_po_co_required_document_uploaded';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'document_name' => $notification_array['document_name'],
						'project_name' => $notification_array['project_name'],
						'on' => $notification_array['on'],
						'type' => $notification_array['type'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'date' => $notification_array['date'],
						'name' => $notification_array['name'],
						'assigned_to' => $assigned_user_name['aaData'][0]['fullname'],
						'builder_name' => $builder_name,
						'on' => $notification_array['on'],
						'user_type' => $user_type,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
					}
					if($notification_array['template_type'] == 'budget_payapp_released')
					{
					$primary_id = $notification_array['module_id'];
					$template_type = 'budget_payapp_released';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'project_name' => $notification_array['project_name'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'due' => $notification_array['due'],
						'builder_name' => $builder_name,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
					}
					if($notification_array['template_type'] == 'budget_payapp_payment_made')
					{
					$primary_id = $notification_array['module_id'];
					$template_type = 'budget_payapp_payment_made';
					 $content_array = array(
						'TO_EMAIL' => $email_ids,
						'SEND_MAIL_INFO' => $level1_string,
						'IMAGESRC' => IMAGESRC,
						'project_name' => $notification_array['project_name'],
						'title' => $notification_array['title'],
						'number' => $notification_array['number'],
						'due' => $notification_array['due'],
						'builder_name' => $builder_name,
						'base_url'=> BASEURL,
						'BUILDER_LOGO' => isset($scheduler['image_path'])?$scheduler['image_path']:''
					);
					}
			  
			   //

			}

			$post_array_details = array(
					'builder_id' => $this->user_session['builder_id'],
					'project_id' => $notification_array['project_id'],
					'module_name' => $this->module,
					'module_pk_id' => $primary_id,
					'from_user_id' => $this->user_session['ub_user_id'],
					'to_user_id' => $notification_array['assigned_to'],
					'type' => $template_type,
					'subject' => 'content will update',
					'message' => 'content will update'
						);
			if(isset($template_type) && isset($content_array) && isset($post_array_details))
			$notifications_array = array(
					'template_name' => $template_type,
					'content_array' => $content_array,
					'notification' => $post_array_details,
					'default' => 'No',
					);
		//print_r($notifications_array);exit;
			/* SMS code was added by chandru 02-09-2015 */
			$msg_user_id = $this->Mod_user->get_sms_preference_user_id($notification_array['builder_id'],$this->main_modules[$this->module]);
			if(isset($msg_user_id) && !empty($msg_user_id))
			{
				if($template_type == 'budget_po_co_payment_request_created')
                { 
				}elseif($template_type == 'budget_po_co_ready_for_payment')
				{
				
				}else{
					$message_responce = $this->Mod_notification->send_sms_notifications($msg_user_id, $post_array_details, $content_array);
				}
			}
			//$notification_responce = $this->Mod_notification->send_mail($notification_array);
			$notification_responce = $this->Mod_notification->send_mail($notifications_array);
			return $notification_responce;
	}

	/** 
	* Get setup budget documents
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
	public function get_setup_budget_documents($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_SETUP_BUDGET_DOCUMENTS.' AS BUDGET_DOCOUMENTS');	
		
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		
		$res = $this->read_db->get();
		 // echo $this->read_db->last_query();
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
	* Get setup budget documents
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
	public function get_po_co_payment_request_documents($args = array())
	{
		
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PO_CO_PAYMENT_REQUEST_DOCUMENTS.' AS PAYMENT_DOCOUMENTS');	
		
		
		// Where condition
		if(isset($args['where_clause']))
		{
			$this->read_db->where($args['where_clause']);
		}
		
		$res = $this->read_db->get();
		 // echo $this->read_db->last_query();
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
	 *function to update the file id to 0 if file is deleted
	 *
	 */
	 public function update_doc_file($file_id = '')
	 {
	 	$file_data = array(
			'file_id' => 0
		);
		$this->write_db->where('file_id', $file_id);
		$this->write_db->update(UB_PO_CO_PAYMENT_REQUEST_DOCUMENTS, $file_data);
	 }
	 /**
	 *
	 *function to update the file id to 0 if file is deleted
	 *
	 */
	 public function update_signature_file($file_id = '')
	 {
	 	$file_data = array(
			'signature_file_id' => 0
		);
		$this->write_db->where('signature_file_id', $file_id);
		$this->write_db->update(UB_PO_CO, $file_data);
	 }
	/**
	*
	* Add po co from template
	*
	* @method: add_po_co_template
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_po_co_template($post_array = array())
	{
	  if( ! empty($post_array))
	  {
		
		unset($post_array['ub_po_co_number']);
		if($this->write_db->insert(UB_PO_CO, $post_array))
		{
			$data['insert_id'] = $this->write_db->insert_id();
			$result = $this->Mod_builder->get_setup(array(
								'select_fields' => array('po_prefix', 'co_prefix'),
								'where_clause' => array('builder_id' => $this->user_session['builder_id'])
								));
				if(isset($result['aaData'][0]['po_prefix']) && $result['aaData'][0]['po_prefix']!='')
				{
					$po_prefix = $result['aaData'][0]['po_prefix'];
				}
				else
				{
					$po_prefix = 'PO';
				}

			$update_array = array();
		    $update_array['ub_po_co_number'] = $this->Mod_po_co->generate_number(strtoupper($po_prefix), PO_NUMBER_LENGTH, $data['insert_id']);
		           
		    $this->write_db->where('ub_po_co_id', $data['insert_id']);
		    $this->write_db->update(UB_PO_CO, $update_array);

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
	}
	/**
	*
	* Add po co cost code from template
	*
	* @method: add_po_co_cost_code
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_po_co_cost_code($post_array = array())
	{
	  if( ! empty($post_array))
	  {
		
		
		$this->write_db->insert(UB_PO_CO_COST_CODE, $post_array);
	
		  
	  }
	}

	/**
	*
	* Add po co cost code from template
	*
	* @method: add_po_co_cost_code
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_documents($file_arry = array())
	{
	  if( ! empty($file_arry))
	  {
		
		
		/* fILE STURCTURE CODE starts here */
               $get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => $file_arry['project_id'],'ui_folder_name' => 'payment'))
                               );
               $all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
			   
               $file_data = array('flag' => 0,
                                  'builder_id' => $this->user_session['builder_id'],
                                  'projectid' => $file_arry['project_id'],
                                  'createdby' => $this->user_session['ub_user_id'],
                                  'modulename' => 'payment',
                                );

                $file_data['moduleid'] = $file_arry['payment_id'];
                $file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
                //echo '<pre>';print_r($_FILES);exit;
                foreach ($_FILES as $type => $properties)
				{
				 foreach ($properties as $name => $values)
				 {
				  for ($i = 0; $i < count($values); $i++)
				  {
				    $result[$i][$name] = $values[$i];
				  }
			     }
			    }
			    //echo '<pre>';print_r($result);
			    $file_id = array();
			    for ($i = 0; $i < count($result); $i++)
                {
                 // $file_id[] = 0;
                  if(!empty($result[$i]['name']))
                  {
                    $file_data['filename'] = $result[$i]['name'];
                    $result_array = $this->Mod_doc->insert_file($file_data);
                    //echo '<pre>';print_r($result_array);exit;
                    if ($result_array['0']['createfolderflag'] == 1)
                    {
                      $response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
                      if(TRUE === $response['status'])
                      {
                        $session_id = $this->session->userdata('session_id');
                        move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                      }
                    }
                    else
                    {
                      $session_id = $this->session->userdata('session_id');
                      move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                    }
                    $file_id[] = $result_array['0']['ub_doc_file_id'];
                   }else
                   {
                   	 $file_id[] = 0;
                   }

                  } 
                  //print_r($file_id);
                  //print_r($file_id);exit;
                  for($file=0; $file<count($file_arry['name']); $file++)
                  {
                  	$file_insert_array = array();
                  	$file_ids = 0;
                  	if(isset($file_id[$file]))
                  	{
                  		$file_ids = $file_id[$file];
                  	}
                  	
                  	$file_insert_array['builder_id'] = $this->user_session['builder_id'];
                  	$file_insert_array['payment_request_id'] = $file_arry['payment_id'];
                  	$file_insert_array['file_id'] = $file_ids;
                  	$file_insert_array['name'] = $file_arry['name'][$file];
              		$file_insert_array['created_by'] = $this->user_session['ub_user_id'];
              		$file_insert_array['created_on'] = TODAY;
              		$file_insert_array['modified_by'] = $this->user_session['ub_user_id'];
              		$file_insert_array['modified_on'] = TODAY;
              		$this->write_db->insert(UB_PO_CO_PAYMENT_REQUEST_DOCUMENTS, $file_insert_array);
                  }
	
		  
	  }
	}

	/**
	*
	* Add po co cost code from template
	*
	* @method: add_po_co_cost_code
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function update_documents($file_arry = array())
	{
	  if( ! empty($file_arry))
	  {
		/* fILE STURCTURE CODE starts here */
               $get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => $file_arry['project_id'],'ui_folder_name' => 'payment'))
                               );
               $all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
			   
               $file_data = array('flag' => 0,
                                  'builder_id' => $this->user_session['builder_id'],
                                  'projectid' => $file_arry['project_id'],
                                  'createdby' => $this->user_session['ub_user_id'],
                                  'modulename' => 'payment',
                                );

                $file_data['moduleid'] = $file_arry['payment_id'];
                $file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
                foreach ($_FILES as $type => $properties)
				{
				 foreach ($properties as $name => $values)
				 {
				  for ($i = 0; $i < count($values); $i++)
				  {
				    $result[$i][$name] = $values[$i];
				  }
			     }
			    }
			    //echo '<pre>';print_r($result);
			    $file_id = array();
			    for ($i = 0; $i < count($result); $i++)
                {
                 // $file_id[] = 0;
                  if(!empty($result[$i]['name']))
                  {
                    $file_data['filename'] = $result[$i]['name'];
                    $result_array = $this->Mod_doc->insert_file($file_data);
                    //echo '<pre>';print_r($result_array);exit;
                    if ($result_array['0']['createfolderflag'] == 1)
                    {
                      $response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
                      if(TRUE === $response['status'])
                      {
                        $session_id = $this->session->userdata('session_id');
                        move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                      }
                    }
                    else
                    {
                      $session_id = $this->session->userdata('session_id');
                      move_uploaded_file($result[$i]['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                    }
                    $file_id[] = $result_array['0']['ub_doc_file_id'];
                   }else
                   {
                   	 $file_id[] = 0;
                   }

                  } 
                  
                  for($file=0; $file<count($file_id); $file++)
                  {
                  	if($file_id[$file] > 0){
                  	$file_insert_array = array();
                  
                  	$file_insert_array['file_id'] = $file_id[$file];
              		$file_insert_array['modified_by'] = $this->user_session['ub_user_id'];
              		$file_insert_array['modified_on'] = TODAY;

              		$this->write_db->where('payment_request_id', $file_arry['payment_id']);
              		$this->write_db->where('name', $file_arry['name'][$file]);
              		$this->write_db->update(UB_PO_CO_PAYMENT_REQUEST_DOCUMENTS, $file_insert_array);
              	  }
                  }  

	  }
	}
	/**
	*
	* Add Signature
	*
	* @method: add_signature
	* @access: public 
	* @param: post data
	* @return: insert true return id and success message otherwise failure message
	*/
	public function add_signature($post_array = array())
	{
		if( ! empty($post_array))
		{

			// If builder id is passing, then will take that builder id / will take the session id, this will work fine for both builder admin and uni admin
			$this->write_db->where('ub_po_co_id', $post_array['ub_po_co_id']);
			if($this->write_db->update(UB_PO_CO, $post_array))
			{
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
				/* Notification code was added by chandru 01-06-2015 */
				
				$data['insert_id'] = $post_array['ub_po_co_id'];
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
		//echo $this->write_db->last_query();
		return $data;			
	}
	public function add_signature_file($file_arry = array())
	{
	  if( ! empty($file_arry))
	  {
		
		
		/* fILE STURCTURE CODE starts here */
               $get_folder_id = array('select_fields' => array('ub_doc_folder_id'),
                               'where_clause' => (array('builder_id' => $this->user_session['builder_id'],'project_id' => $this->project_id,'ui_folder_name' => 'signature'))
                               );
               $all_folder = $this->Mod_doc->get_folder_id($get_folder_id);
			   
               $file_data = array('flag' => 0,
                                  'builder_id' => $this->user_session['builder_id'],
                                  'projectid' => $this->project_id,
                                  'createdby' => $this->user_session['ub_user_id'],
                                  'modulename' => 'signature',
                                );

                $file_data['moduleid'] = $file_arry['ub_po_co_id'];
                $file_data['folderid'] = $all_folder['aaData']['0']['ub_doc_folder_id'];
                /*foreach ($_FILES as $type => $properties)
				{
				 foreach ($properties as $name => $values)
				 {
				  for ($i = 0; $i < count($values); $i++)
				  {
				    $result[$i][$name] = $values[$i];
				  }
			     }
			    }*/
			    //echo '<pre>';print_r($result);exit;
			    $file_id = array();
			    /*for ($i = 0; $i < count($result); $i++)
                {*/
                 // $file_id[] = 0;
                  if(!empty($_FILES['attachments']['name']))
                  {
                  	//echo '<pre>';print_r($result[$i]['name']);exit;
                    $file_data['filename'] = $_FILES['attachments']['name'];
                    $result_array = $this->Mod_doc->insert_file($file_data);
                    //echo '<pre>';print_r($result_array);exit;
                    if ($result_array['0']['createfolderflag'] == 1)
                    {
                      $response = $this->Mod_doc->create_dir(DOC_PATH.$result_array['0']['directorypath']);
                      if(TRUE === $response['status'])
                      {
                        $session_id = $this->session->userdata('session_id');
                        move_uploaded_file($_FILES['attachments']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                      }
                    }
                    else
                    {
                      $session_id = $this->session->userdata('session_id');
                      move_uploaded_file($_FILES['attachments']['tmp_name'], DOC_PATH.$result_array['0']['directorypath'].$result_array['0']['sys_file_name']);
                    }
                    $file_id[] = $result_array['0']['ub_doc_file_id'];
                   }else
                   {
                   	 $file_id[] = 0;
                   }

                  /*}*/ 
                  //print_r($file_id);
                  //print_r($file_id);exit;
                  
                  	$file_insert_array = array();
                  	$file_ids = 0;
                  	if(isset($file_id[0]))
                  	{
                  		$file_ids = $file_id[0];
                  	}
                  	$file_insert_array['signature_file_id'] = $file_ids;
                  	$this->write_db->where('ub_po_co_id', $file_arry['ub_po_co_id']);
			        $this->write_db->update(UB_PO_CO, $file_insert_array);
			        $data['status'] = TRUE;
			        return $data;
                  
	
		  
	  }
	}
}
/* End of file mod_user.php */
/* Location: ./application/models/mod_user.php */