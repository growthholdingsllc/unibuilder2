<?php

/**
 * Builder Class
 *
 * @package:	Builder
 * @subpackage: Builder
 * @category:	Builder
 * @author:		Devansh
 * @createdon(DD-MM-YYYY): 09-05-2015
*/

class Mod_builder extends UNI_Model
{
	/**
	 * @property:	$builder_id
	 * @access:		public
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
		$this->load->model(array('Mod_payment','Mod_user'));
	}


	/**
	 * Get builder information
	 *
	 * $args['select_fields']		- can get all or specific filed information by giving values for the key "select_fields"
	 * $args['join']['user']		- join builder table with user table
	 * $args['join']['user_plan']	- join builder table with user_plan table
	 * $args['where_clause']		- can pass where conditions as an array
	 * $args['order_clause']		- sorting option
	 * $args['pagination']			- pagination option
	 *
	 * @method:	get_builder_details
	 * @access:	public
	 * @param:	args
	 * @return:	array
	 */
	public function get_builder_details($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',', $args['select_fields']) : '*', FALSE);
		$this->read_db->from(UB_BUILDER . ' AS BUILDER_DETAILS');

		// Join tables
		if (isset($args['join']['user']) && 'yes' === strtolower($args['join']['user'])) {
			$this->read_db->join(UB_USER . ' AS USER', 'BUILDER_DETAILS.ub_builder_id = USER.builder_id', 'left');
		}
       if (isset($args['join']['setup_budget']) && 'yes' === strtolower($args['join']['setup_budget'])) {
			$this->read_db->join(UB_SETUP_BUDGET_DOCUMENTS . ' AS SETUP_BUDGET', 'BUILDER_DETAILS.ub_builder_id = SETUP_BUDGET.builder_id', 'left');
		}
		if (isset($args['join']['userplan']) && 'yes' === strtolower($args['join']['userplan'])) {
			$this->read_db->join(UB_USER_PLAN . ' AS USER_PLAN', 'BUILDER_DETAILS.ub_builder_id = USER_PLAN.builder_id', 'left');
		}
		if (isset($args['join']['setup']) && 'yes' === strtolower($args['join']['setup'])) {
			$this->read_db->join(UB_SETUP . ' AS SETUP', 'BUILDER_DETAILS.ub_builder_id = SETUP.builder_id', 'left');
		}
        if (isset($args['join']['plan']) && 'yes' === strtolower($args['join']['plan'])) {
			$this->read_db->join(UB_PLAN . ' AS PLAN', 'USER_PLAN.plan_id = PLAN.ub_plan_id', 'left');
		}  
        
      // Where condition
		if (isset($args['where_clause'])) {
			$this->read_db->where($args['where_clause']);
		}

		// Order by condition
		if (isset($args['order_clause']) && $args['order_clause'] != '') {
			$this->read_db->order_by($args['order_clause']);
		}

		// Pagination
		if (isset($args['pagination']) && !empty($args['pagination'])) {
			$this->read_db->limit($args['pagination']['iDisplayLength'], $args['pagination']['iDisplayStart']);
		}

		$res	=	$this->read_db->get();
		$data	=	array();
		//echo $this->read_db->last_query();exit();
		if ($res->num_rows() > 0) {
			$data['aaData']		=	$res->result_array();
			$data['status']		=	TRUE;
			$data['message']	=	'Data retrieved successfully';
		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'No record found';
		}
		// echo $this->read_db->last_query();
		return $data;
	}


	/**
	 *
	 * Add builder
	 *
	 * @method:	add_builder
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_builder($post_array = array())
	{
		if (!empty($post_array)) 
		{
			//echo "<pre>";print_r($post_array);exit;
			// inserting into the 'builder' table
			if ($this->write_db->insert(UB_BUILDER, $post_array)) {
				//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
				$data['insert_id']	=	$this->write_db->insert_id();
				$data['status']		=	TRUE;
				$data['message']	=	'Builder(s) inserted successfully';
			} else {
				$data['status']		=	FALSE;
				$data['message']	=	'Insert Failed: Failed to insert the Builder(s)';
			}

		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		return $data;
	}


	/**
	 *
	 * Update builder
	 *
	 * @method:	update_builder
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	public function update_builder($post_array = array())
	{
		if (!empty($post_array)) {
			$this->ub_builder_id = isset($post_array['ub_builder_id']) ? $post_array['ub_builder_id'] : $this->ub_builder_id;
			if ($this->ub_builder_id > 0) {

				$this->write_db->where('ub_builder_id', $this->ub_builder_id);
				if ($this->write_db->update(UB_BUILDER, $post_array)) {
					$data['insert_id'] = $this->ub_builder_id;
					$data['status']    = TRUE;
					$data['message']   = 'Updated successfully';
				} else {
					$data['status']  = FALSE;
					$data['message'] = 'Update failed';
				}
			}

		} else 
		{
			$data['status']  = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}


	/**
	 *
	 * Delete builder
	 *
	 * @method:	delete_builder
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	/* public function delete_builder($delete_array)
	{
		if (isset($delete_array['ub_builder_id'])) {
			foreach ($delete_array['ub_builder_id'] as $key => $ub_builder_id) {
				$this->write_db->delete(UB_BUILDER, array(
					'ub_builder_id' => $ub_builder_id
				));
			}
			$data['status']  = TRUE;
			$data['message'] = 'Builder(s) deleted successfully';
		} else {
			$data['status']  = FALSE;
			$data['message'] = 'Builder id is not set';
		}
		return $data;
	} */
	public function delete_builder($delete_array)
	{

	  if(isset($delete_array['user_user_id']))
		{
			$post_array = array('user_status' => 'Delete');
			$this->write_db->where('ub_user_id', $delete_array['user_user_id']);
			$this->write_db->update(UB_USER, $post_array);
			
			$post_array = array('builder_status' => 'Delete');
			$this->write_db->where('ub_builder_id', $delete_array['user_builder_id']);
			$this->write_db->update(UB_BUILDER, $post_array);
		 //$this->write_db->delete(UB_USER, array('ub_user_id' => $delete_array['ub_user_id']));

			$data['status'] = TRUE;
			$data['message'] = 'User(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'User id is not set';
		}
		return $data;
     }
    /** 
	* Get Plan information
	* @method: get_plans
	* @access: public 
	* @param: args
	* @return: array
	*/
	public function get_plans($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PLAN.' AS PLAN');	//UB_PLAN is the table name defined in constant file
		  // Where condition
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
		//echo $this->read_db->last_query();
		return $data;
	}

	/**
	*
	*
	* Get valid email
	* @author: Devansh
	* @method: get_valid_email
	* @access: public 
	* @param: array data
	* @return: return data
	*/
	public function get_valid_email($post_array = array())
	{
		if( ! empty($post_array))
		{
			
				$result = $this->Mod_user->get_users(array(
								'select_fields' => array('USER.primary_email'),
								'where_clause' => array('USER.primary_email' => $post_array['primary_email'])
								));
				//print_r($post_array);exit;
				if($post_array['primary_email'] == '')
				{
					$data['status'] = FALSE;
					$data['message'] = 'Update Failed: Email field is empty';
				}
				 else{ if(TRUE === $result['status'])
				  {
				  	$data['status'] = FALSE;
					$data['message'] = 'Email already exists. Please try with some other email';
				    // Failed to retrieve the same user
				  }
				  else
			      {
			   	    $data['status'] = TRUE;
				    $data['message'] = 'Correct Email';
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
	* insert data in setup table
	*
	* @method: add_setup
	* @access: public 
	* @param: array data
	* @return: return data
	* @author: pranab
	*/
	public function add_setup($post_array = array())
	{
		if (!empty($post_array)) 
		{
		  $result = $this->get_setup(array(
                                'select_fields' => array('builder_id'),
                                'where_clause' => array('builder_id' => $post_array['builder_id'])
                                ));
		  $data = array();						
          if(FALSE === $result['status'])
           {
             $this->write_db->insert(UB_SETUP, $post_array);
             $data['status']	=	TRUE;
			 $data['message']	=	'Builder(s) inserted successfully';

           }
          else
           {

           	 $this->write_db->where(array('builder_id' => $post_array['builder_id']));
              $res = $this->write_db->update(UB_SETUP, $post_array);
              $data['status']	=	TRUE;
			  $data['message']	=	'Builder(s) inserted successfully';
              
          }
		 
		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}

		return $data;
	}
   /**
	* get data in setup table
	* @method: get_setup
	* @access: public 
	* @param: array data
	* @return: return data
	* @author: pranab
	*/
	public function get_setup($post_array = array())
	{
	   $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
        $this->read_db->from(UB_SETUP);

       // Where condition
        if(isset($post_array['where_clause']))
        {
          $this->read_db->where($post_array['where_clause']);
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
        //echo $this->read_db->last_query();
          //echo '<pre>';print_r($res->result_array);
          //exit;
        return $data;
	}
	 /**
	* insert document data in setup_budget_document table
	*
	* @method: add_budget_documents
	* @access: public 
	* @param: array data
	* @return: return data
	* @author: pranab
	*/
	 public function add_budget_documents($post_array = array())
	 {

	  if (!empty($post_array)) 
		{
		  	$data = array();

		  for($i=0;$i < count($post_array['ub_setup_budget_documents_id']);$i++)
		     {
			 
			     if($post_array['ub_setup_budget_documents_id'][$i] != '' && $post_array['name'][$i] != '')
			     {
					//echo "hi";exit;			          
					$document = Array(
			           'builder_id'=> $this->user_session['builder_id'],
					   'ub_setup_budget_documents_id' => $post_array['ub_setup_budget_documents_id'][$i],
					   'name' => $post_array['name'][$i],
					   'comments' => $post_array['comments'][$i],
					   'created_on' => TODAY,
					   'created_by' => $this->user_session['builder_id'],
					   'modified_on' => TODAY,
					   'modified_by' => $this->user_session['builder_id']);
					    $this->write_db->where('ub_setup_budget_documents_id', $post_array['ub_setup_budget_documents_id'][$i]);
		                $this->write_db->update(UB_SETUP_BUDGET_DOCUMENTS, $document);
						//echo $this->write_db->last_query();
					    $data['status'] = TRUE;
                        $data['message'] = 'Data Update successfully';
			     }
			     else
                 {
					  if($post_array['name'][$i] != '')
					  {
				      $document = Array(
			           'builder_id'=> $this->user_session['builder_id'],
					   'name' => $post_array['name'][$i],
					   'comments' => $post_array['comments'][$i],
					   'created_on' => TODAY,
					   'created_by' => $this->user_session['builder_id'],
					   'modified_on' => TODAY,
					   'modified_by' => $this->user_session['builder_id']);
					   $this->write_db->insert(UB_SETUP_BUDGET_DOCUMENTS, $document);
		               $data['status'] = TRUE;
                       $data['message'] = 'Data insert successfully';
                     }
                  }			  
			   
			 } 		
	
		}
	}
	 /**
	* get document data in setup_budget_document table
	*
	* @method: get_budget_document
	* @access: public 
	* @param: array data
	* @return: return data
	* @author: pranab
	*/
	public function get_budget_document($post_array = array(),$args = array())
	{

	   $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
        $this->read_db->from(UB_SETUP_BUDGET_DOCUMENTS);

       // Where condition
        if(isset($post_array['where_clause']))
        {
          $this->read_db->where($post_array['where_clause']);
        }

        $res = $this->read_db->get();

        $data = array();
        if($res->num_rows() > 0)
        {
            $data['aaData'] = $res->result_array();
            $data['status'] = TRUE;
            $data['message'] = 'Data retrieved successfully';
			$this->delete_budget_document($data['aaData'],$args) ;
        }

        else
        {
            $data['status'] = FALSE;
            $data['message'] = 'No record found';
        }
        //echo $this->read_db->last_query();
          //echo '<pre>';print_r($res->result_array);
          //exit;
        return $data;
	}
	 /**
	* delete document data in setup_budget_document table
	*
	* @method: get_budget_document
	* @access: public 
	* @param: array data,args
	* @author: pranab
	*/
   public function delete_budget_document($data = array(),$args = array())
   {
      if(isset($data))
	  {
	       foreach($data as $docid)
			  {
			    $doc[] = $docid['ub_setup_budget_documents_id'] ;
			  }
			  
		   $budget_documentid = array_diff($doc,$args);
		   
		 if(!empty($budget_documentid))
		 {
		   foreach($budget_documentid as $document)
		   {
			    
				  $this->write_db->where('ub_setup_budget_documents_id',$document);
				 $this->write_db->delete(UB_SETUP_BUDGET_DOCUMENTS);
				// echo $this->write_db->last_query();  
			 
		   }
		 } 
	  }
     
   }
	
   public function get_total_no_of_projects($post_array = array())
	{
	   $this->read_db->select(isset($post_array['select_fields'])? implode(',',$post_array['select_fields']) :'*', FALSE);
        $this->read_db->from(UB_PROJECT_ASSIGNED_USERS.' AS PROJECT_ASSIGN');

       // Where condition
        if(isset($post_array['where_clause']))
        {
          $this->read_db->where($post_array['where_clause']);
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
        //echo $this->read_db->last_query();
          //echo '<pre>';print_r($res->result_array);
          //exit;
        return $data;
	}
	
	 /**
	* Check builder logo is available or not
	* Is there return path
	*
	* @method: get_builder_logo
	* @access: public 
	* @param: array data,args
	* @created by: chandru
	* @created on: 26/06/2015
	*/
	public function get_builder_logo($builder_id)
	{
		$builder_data = array(      'flag' => 2,
						  'builder_id'    => $builder_id,
						  'projectid' => 0,
						  'folderid' => 0,
						  'modulename' => 'setup',
						  'moduleid' => $builder_id
						);
		$result_array = $this->Mod_doc->get_files_for_folder($builder_data);
		if(isset($result_array[0]['system_file_name']) && !empty($result_array[0]['system_file_name']))
		{
			$image_path = DOC_URL.$result_array[0]['system_file_name'];
			$data['image_path'] = $image_path;
			$data['status'] = TRUE;
		}else{
			$data['status'] = FALSE;
		}
		return $data;
	}
	/** 
	* Get Project Details
	*
	* $args['select_fields'] - can get all or specific filed information by giving values for the key "select_fields"
	* $args['join']['builder'] - join builder table with role table
	* $args['where_clause'] - can pass where conditions as an array
	* $args['order_clause'] - sorting option
	* $args['pagination'] - pagination option
	*
	* @method: get_project_details
	* @access: public 
	* @param: args
	* @return: array
	* @author: Sidhartha
	*/
	public function get_project_details($args = array())
	{
		$this->read_db->select(isset($args['select_fields']) ? implode(',',$args['select_fields']) :'*', FALSE);
		$this->read_db->from(UB_PROJECT.' AS PROJECT');
		
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
	*
	* Update project
	*
	* @method: update_project
	* @access: public 
	* @param: post data
	* @return: return data
	*/
	public function update_project($post_array = array())
	{

		$post_array['modified_by'] = $this->user_session['ub_user_id'];
		$post_array['modified_on'] = TODAY;
		
		if( ! empty($post_array) && $post_array['ub_project_id'] > 0)
		{
			$this->project_id = $post_array['ub_project_id'];
			//$this->owner_id = $post_array['owner_id'];
			$this->write_db->where('ub_project_id', $this->project_id);
			if($this->write_db->update(UB_PROJECT, $post_array))
			{
				$data['ub_project_id'] =  $this->project_id;
				//$data['owner_id'] =  $this->owner_id;
				$data['status'] = TRUE;
				$data['message'] = 'Data Updated successfully';
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = 'Insert Failed: Failed to update project data';
			}
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}
	/* Below function was created by chandru
	   For Delete builder created users*/
	public function delete_builder_and_users($builder_id = 0)
	{

	  if($builder_id > 0)
		{
			/* User table update */
			$post_array = array('user_status' => 'Inactive');
			$this->write_db->where('builder_id', $builder_id);
			$this->write_db->update(UB_USER, $post_array);
			/* Builder table update */
			$post_array = array('builder_status' => 'Inactive','payment_status' =>'subscription_cancelled_by_builder');
			$this->write_db->where('ub_builder_id', $builder_id);
			$this->write_db->update(UB_BUILDER, $post_array);
			/* Project table update */
			$post_array = array('project_status' => 'Inactive');
			$this->write_db->where('builder_id', $builder_id);
			$this->write_db->update(UB_PROJECT, $post_array);
			
			$data['status'] = TRUE;
			$data['message'] = 'User(s) deleted successfully';
		}
		else
		{
			$data['status'] = FALSE;
			$data['message'] = 'User id is not set';
		}
		return $data;
	}
	
	/* Below function was added by chandru */
	public function builder_redirect_url($builder_id = 0)
	{
		$data = array();
		if($builder_id > 0)
		{
			$sort_type = 'DESC LIMIT 1';
			$order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
			$previous_payment_subscription_details = $this->Mod_payment->get_payment_details(array(
						'select_fields' => array(),
						'where_clause' => array('builder_id'=>$builder_id,'payment_status'=>FAILD_PAYMENT),
						'order_clause' => $order_by_where
						));
			if(TRUE == $previous_payment_subscription_details['status'])
			{
				$subscription_id = $previous_payment_subscription_details['aaData'][0]['subscription_id'];
				$plan_id = $previous_payment_subscription_details['aaData'][0]['plan_id'];
				$sort_type = 'DESC LIMIT 2';
				$order_by_where = 'USER_PLAN.ub_user_plan_id'.' '.$sort_type;
				$user_plan_result = $this->Mod_plan->get_user_plan(array(
						'select_fields' => array('USER_PLAN.ub_user_plan_id','USER_PLAN.plan_id'),
						'where_clause' => (array('USER_PLAN.builder_id' => $builder_id)),
						'order_clause' => $order_by_where
						)); 
				$old_plan_id = $user_plan_result['aaData'][1]['plan_id'];
				
				/* Find upgrade or downgrade code */
				$plan_amount_array = $this->Mod_builder->get_plans(array(
											'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_amount'),
											'where_clause' => array('ub_plan_id'=>$old_plan_id),
											));
				$current_plan_amount = $plan_amount_array['aaData'][0]['plan_amount'];
				$plan_amount_array = $this->Mod_builder->get_plans(array(
									'select_fields' => array('PLAN.ub_plan_id','PLAN.plan_amount'),
									'where_clause' => array('ub_plan_id'=>$plan_id),
									));
				$new_plan_amount = $plan_amount_array['aaData'][0]['plan_amount'];
				if($current_plan_amount < $new_plan_amount)
				{
					$type = "Upgrade";
				}else{
					$type = "Downgrade";
				}
				
				/* Find email address */
				$where_builder_str = array('builder_id' => $builder_id,'account_type' => BUILDERADMIN );
				$get_builder_user_id = array(
								'select_fields' => array('ub_user_id','primary_email'),
							'where_clause' => $where_builder_str
							);
				$builder_user_id_details = $this->Mod_user->get_users($get_builder_user_id);
				$builder_user_id = $builder_user_id_details['aaData'][0]['ub_user_id'];
				$builder_email_id = $builder_user_id_details['aaData'][0]['primary_email'];
				
				$reset_link = base_url().$this->crypt->encrypt('register/index/'.$plan_id.'/'.$builder_email_id.'/'.$subscription_id.'/'.$type);
				$data['message'] = 'You need to pay for new plan';
				$data['reset_link'] = $reset_link;
				$data['status'] = TRUE;
			}else{
				$data['message'] = 'Previous subscription was not found';
				$data['status'] = FALSE;
			}
		
		}else{
			$data['message'] = 'builder id is 0';
			$data['status'] = FALSE;
		}
		return $data;
	
	}
	
}

/* End of file mod_builder.php */
/* Location: ./application/models/mod_builder.php */