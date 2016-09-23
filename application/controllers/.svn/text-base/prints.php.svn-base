<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Doc Class
 * 
 * @package: Doc
 * @subpackage: Doc
 * @category: Doc
 * @author: Gopakumar 
 * @createdon(DD-MM-YYYY): 16-04-2015 
*/
class Prints extends UNI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model(array('Mod_lead','Mod_task','Mod_doc','Mod_general_value','Mod_timezone','Mod_user','Mod_builder','Mod_plan','Mod_project','Mod_custom_settings','Mod_bid','Mod_selections','Mod_warranty','Mod_checklist','Mod_po_co','Mod_subcontractor','Mod_budget'));
		$this->module;
        $this->load->helper(array('url','directory'));					
    }		
	public function index()
	{
		
	}
	public function bid_print($ub_bid_id=0,$project_id=0)
	{
		// echo $ub_bid_id;exit;
	/* block to get builder datails*/
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array
												));
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
			/* block to get current_date*/
			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");

			$project_list = $this->Mod_project->get_projects(array(
					         'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal',),
							 'join'=> array('project'=>'Yes'),
							 'where_clause' => (array('ub_project_id' =>  $project_id))
							 )
			                 
			);
			

			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['title'] = (isset($project_data['title']) && $project_data['title']!='')?$project_data['title'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal'];
			
			// block to get bid data.
			$bid_date_due_array = array('BID.due_date'=>'due_date');	
			$result_data = $this->Mod_bid->get_bids(array(
					         'select_fields' => array('BID.description','BID.package_title','BID.status,'.$this->Mod_user->format_user_datetime($bid_date_due_array,"date").',PROJECT.project_name','BID.project_id','BID.pricing_format','BID.has_checklist','BID.checklist_id','PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal'),
							 'join'=> array('project'=>'Yes','bid_request'=>'Yes','cost_code' => 'Yes'),
			                 'where_clause' => (array('ub_bid_id' =>  $ub_bid_id))
			));
			$data['bid_data']  = $result_data['aaData'][0];
			
			// block to get bid checklist data.
			$data['checklist_info'] = '';
			if($result_data['status'] == TRUE && !empty($result_data['aaData'][0]['checklist_id']))
			{
				$checklist_array[] = array(
						'field_name' => 'UB_CHECKLIST.ub_checklist_id',
						'value'=> $result_data['aaData'][0]['checklist_id'], 
						'type' => '||',
						'classification' => 'primary_ids'
					);
				$where_str = $this->Mod_bid->build_where($checklist_array);					
				$checklist_result_data = $this->Mod_checklist->get_check_list(array(
				'select_fields' => array('Group_concat(UB_CHECKLIST.title) as title'),
				'where_clause' => $where_str
				));
				// echo '<pre>';print_r($checklist_result_data);exit;
				if($checklist_result_data['status'] == TRUE)
				{
					$data['checklist_info'] = $checklist_result_data['aaData'][0]['title'];
				}
			}
			
			// block to get bid cost code data.
			$get_cost_code_result = $this->Mod_bid->get_cost_code(array(
					         'select_fields' => array('Group_concat(COST_CODE.cost_code_id) as cost_code_id','Group_concat(COST_CODE.cost_code_description) as cost_code_description','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
			                 'join'=> array('bid'=>'Yes','variance_code'=>'Yes'),  
			                 'where_clause' => (array('BID.ub_bid_id' =>  $ub_bid_id))
			));
			$data['get_cost_code_result'] = array();
			if($get_cost_code_result['status'] == TRUE && !empty($get_cost_code_result['aaData'][0]['cost_code_id']))
			{
				$data['get_cost_code_result'] = $get_cost_code_result['aaData'][0];
			}
			
			//List page of requested bidpackages
			$bid_request_submitted_date_array = array('BID_REQUEST.submitted'=>'submitted');	
			$bid_request_released_date_array = array('BID.released_date'=>'released_date');	
			$request_data = $this->Mod_bid->get_bidrequest(array(
					         'select_fields' => array('CONCAT_WS(" ",USER.first_name,USER.last_name) AS subcontractor_name','BID_REQUEST.sub_viewed,'.$this->Mod_user->format_user_datetime($bid_request_released_date_array,"date").',BID_REQUEST.will_bid,'.$this->Mod_user->format_user_datetime($bid_request_submitted_date_array,"date").',BID_REQUEST.bid_amount','BID_REQUEST.bid_sub_status'),
			                 'join'=> array('project'=>'Yes','bid'=>'Yes','sub' => 'Yes','user' => 'Yes'),  
			                 'where_clause' => (array('ub_bid_id' =>  $ub_bid_id))
			));
			// echo '<pre>';print_r($request_data);exit;
			$data['request_data'] = array();
			if(TRUE === $request_data['status'])
			{
				$data['request_data']  = $request_data['aaData'];
			}
		}	
		$data['builder_details'] = array( 'builder_address'	=> $builder_address,
											'builder_phone'  => $builder_phone,
											'current_date'   => $current_date,
											'project_name'	=> $project_data['project_name'],
											'project_address'	=> $project_address											
										);
		// echo '<pre>';print_r($data);exit;								
		$this->load->view('content/print/bid_print', $data);
	}

	public function purchase_order($ub_po_co_id = 0 ,$project_id=0)
	{
		/* block to get builder datails*/
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID );

		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array
												));

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

			// Block to get project related data.
			$project_post_array =  array('PROJECT.ub_project_id'=>$project_id);
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal'),
					'where_clause' => $project_post_array 
					));
			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal'];

			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
			
			$po_co_due_date_array = array('PO_CO.due_date'=>'due_date');	
			$result_data = $this->Mod_po_co->get_po_co(array(
					         'select_fields' => array('PO_CO.ub_po_co_number','PROJECT.ub_project_id','PROJECT.project_name','PO_CO.ub_po_co_id','PO_CO.builder_id','PO_CO.project_id','PO_CO.title','PO_CO.assigned_to','PO_CO.materials_only,'.$this->Mod_user->format_user_datetime($po_co_due_date_array,"date").',PO_CO.notes','PO_CO.scope_of_work','PO_CO.bid_po_id','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.po_status','PO_CO.created_by','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name'),
			                 'join'=> array('project'=>'Yes','user'=>'Yes'),  
			                 'where_clause' => (array('ub_po_co_id' =>  $ub_po_co_id))
			                ));
			$po_data = $result_data['aaData'][0];
			
			$cost_code_args = array('select_fields' => array('Group_concat(PO_CO_COST_CODE.ub_po_co_cost_code_id) as ub_po_co_cost_code_id','Group_concat(PO_CO_COST_CODE.cost_code_id) as cost_code_id','Group_concat(PO_CO_COST_CODE.quantity) as quantity','Group_concat(PO_CO_COST_CODE.unit_cost) as unit_cost','Group_concat(PO_CO_COST_CODE.total) as total','PO_CO.po_status','PO_CO.created_by','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
			'where_clause' => (array('PO_CO_COST_CODE.po_co_id' =>  $ub_po_co_id)),'join' =>array('po_co'=>'Yes','variance_code'=>'Yes'),); 

			$cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);
			// echo '<pre>';print_r($cost_code_result);exit;
			$cost_code_data = array();
			if($cost_code_result['status'] == TRUE)
			{
				$cost_code_data = $cost_code_result['aaData'][0];
			}
			
			$release_date_array = array('PO_CO_ACTIVITY.modified_on'=>'modified_on');	
			$release_date = $this->Mod_po_co->get_po_co_activity_log(array(
			'select_fields' => array($this->Mod_user->format_user_datetime($release_date_array)),
			'where_clause' =>(array('PO_CO_ACTIVITY.po_co_id' => $ub_po_co_id ,'PO_CO_ACTIVITY.activity_status' => 'Released'))
			));
			$po_release_date = array();
			if($release_date['status'] == TRUE)
			{
				$po_release_date = $release_date['aaData'][0];
				// echo '<pre>';print_r($po_release_date);exit;
			}	
			
			$subcontractor_details = $this->Mod_user->get_users(array(
            'select_fields' => array('USER.address', 'USER.city', 'USER.province','USER.postal','USER.desk_phone','USER.mobile_phone','USER.country'),
            'join'=> array('builder'=>'Yes'),
            'where_clause' => (array('ub_user_id' => $po_data['assigned_to']))
            ));
			// echo '<pre>';print_r($subcontractor_details);exit;
			$subcontractor_data = array();
			if($subcontractor_details['status'] == TRUE)
			{
				$subcontractor_data = $subcontractor_details['aaData'][0];
			}	
			//echo '<pre>';print_r($subcontractor_data);exit;
			$data['builder_details'] = array( 'builder_address' => $builder_address,
											  'builder_phone' 	=> $builder_phone,
											  'current_date'	=> $current_date,
											  'project_address'	=> $project_data,
											  'po_data'			=> $po_data,
											  'po_release_date'	=> $po_release_date,
											  'cost_code_data'	=> $cost_code_data,
											  'subcontractor_data'	=> 	$subcontractor_data
											);
		}
		
		$this->load->view('content/print/purchase_order', $data);
	}
	public function change_order($ub_po_co_id=0,$project_id=0)
	{
	/* block to get builder datails*/
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array
												));
	 // echo '<pre>';print_r($builder_details_array );	
		if(TRUE === $builder_details_array['status'])
		{
			$builder_address_data = $builder_details_array['aaData']['0'];
			$builder_address_data['address'] = (isset($builder_address_data['address']) && $builder_address_data['address']!='')?$builder_address_data['address'].', ':'';
			$builder_address_data['city'] = (isset($builder_address_data['city']) && $builder_address_data['city']!='')?$builder_address_data['city'].', ':'';
			$builder_address_data['province'] = (isset($builder_address_data['province']) && $builder_address_data['province']!='')?$builder_address_data['province'].', ':'';
			$builder_address_data['country'] = (isset($builder_address_data['country']) && $builder_address_data['country']!='')?$builder_address_data['country'].' ':'';
			$builder_address_data['postal'] = (isset($builder_address_data['postal'] ) && $builder_address_data['postal']!='')?$builder_address_data['postal']:'';
			$builder_address = $builder_address_data['address'].$builder_address_data['city'].$builder_address_data['province'].$builder_address_data['country'].$builder_address_data['postal'];
			  // echo '<pre>';print_r($builder_address);	
			if (!empty($builder_address_data['desk_phone'])) 
			{
				$builder_phone = $builder_address_data['desk_phone'];
			}
			else
			{
				$builder_phone = '';
			}
			/* block to get current_date*/
			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
		
			/* block to get project_data*/
			$project_list = $this->Mod_project->get_projects(array(
					         'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal',),
							 'join'=> array('project'=>'Yes'),
							 'where_clause' => (array('ub_project_id' =>  $project_id))
							 )
			                 
			);	
			// echo '<pre>';print_r($project_list);
			//echo '<pre>';print_r($checklist_data);exit;
			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['title'] = (isset($project_data['title']) && $project_data['title']!='')?$project_data['title'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal'];
			// echo '<pre>';print_r($project_address);
			$result_data = $this->Mod_po_co->get_po_co(array(
					         'select_fields' => array('PO_CO.ub_po_co_number','PROJECT.ub_project_id','PROJECT.project_name','PO_CO.ub_po_co_id','PO_CO.builder_id','PO_CO.project_id','PO_CO.title','PO_CO.assigned_to','PO_CO.materials_only','PO_CO.due_date','PO_CO.notes','PO_CO.scope_of_work','PO_CO.bid_po_id','PO_CO.total_amount','PO_CO.paid_amount','PO_CO.po_status','PO_CO.created_by','CONCAT_WS(" ",USER.first_name,USER.last_name) AS first_name'),
			                 'join'=> array('project'=>'Yes','user'=>'Yes','po_co_cost_code' => 'Yes'),  
			                 'where_clause' => (array('ub_po_co_id' =>  $ub_po_co_id))
			                ));

			$co_data=$result_data['aaData'][0];
			
			 /* $subcontractor_details = $this->Mod_subcontractor->get_sub_contractor(array(
            'select_fields' => array('UB_SUBCONTRACTOR.company','UB_SUBCONTRACTOR.address','UB_SUBCONTRACTOR.postal','UB_SUBCONTRACTOR.desk_phone','UB_USER.country'),
            'join'=> array('builder'=>'Yes','user'=>'Yes'),
            'where_clause' => (array('user_id' => $co_data['assigned_to']))
            ));
			$subcontractor_data = $subcontractor_details['aaData'][0]; */
			
			/* block to get subcontractor_details*/
			$subcontractor_details = $this->Mod_user->get_users(array(
            'select_fields' => array('USER.address', 'USER.city', 'USER.province','USER.postal','USER.desk_phone','USER.mobile_phone','USER.country'),
            'join'=> array('builder'=>'Yes'),
            'where_clause' => (array('ub_user_id' => $co_data['assigned_to']))
            ));
			// echo '<pre>';print_r($subcontractor_details);exit;
			$subcontractor_data = array();
			if($subcontractor_details['status'] == TRUE)
			{
				$subcontractor_data = $subcontractor_details['aaData'][0];
			}	
			/* block to get co_details*/
			$po_co_due_date_array = array('PO_CO.due_date'=>'due_date');		
			$co_details = $this->Mod_po_co->get_po_co(array(
            'select_fields' => array('PO_CO.ub_po_co_number','PO_CO.title,'.$this->Mod_user->format_user_datetime($po_co_due_date_array,"date").',PO_CO.po_status','PO_CO.total_amount','PO_CO.scope_of_work'),
            'join'=> array('builder'=>'Yes','user'=>'Yes'),
            'where_clause' => (array('ub_po_co_id' =>  $ub_po_co_id))
            ));
			$co_list_data = $co_details['aaData'][0];
				
			 $cost_code_args = array('select_fields' => array('Group_concat(PO_CO_COST_CODE.ub_po_co_cost_code_id) as ub_po_co_cost_code_id','Group_concat(PO_CO_COST_CODE.cost_code_id) as cost_code_id','Group_concat(PO_CO_COST_CODE.quantity) as quantity','Group_concat(PO_CO_COST_CODE.unit_cost) as unit_cost','Group_concat(PO_CO_COST_CODE.total) as total','PO_CO.po_status','PO_CO.created_by','Group_concat(VARIANCE_CODE.cost_variance_code) as cost_variance_code'),
			'where_clause' => (array('PO_CO_COST_CODE.po_co_id' =>  $ub_po_co_id)),'join' =>array('po_co'=>'Yes','variance_code'=>'Yes'),); 

			$cost_code_result = $this->Mod_po_co->get_po_co_cost_code($cost_code_args);
			 // echo '<pre>';print_r($cost_code_result);exit;
			$cost_code_data = array();
			if($cost_code_result['status'] == TRUE)
			{
				$cost_code_data = $cost_code_result['aaData'][0];
			}
			
			$release_date_array = array('PO_CO_ACTIVITY.modified_on'=>'modified_on');	
			$release_date = $this->Mod_po_co->get_po_co_activity_log(array(
			'select_fields' => array($this->Mod_user->format_user_datetime($release_date_array)),
			'where_clause' =>(array('PO_CO_ACTIVITY.po_co_id' => $ub_po_co_id ,'PO_CO_ACTIVITY.activity_status' => 'Released'))
			));
			$co_release_date = array();
			if($release_date['status'] == TRUE)
			{
				$co_release_date = $release_date['aaData'][0];
				// echo '<pre>';print_r($po_release_date);exit;
			}	
            
			
			// echo '<pre>';print_r($co_data);
			$data['builder_details'] = array( 'builder_address'		=> $builder_address,
												'builder_phone'  => $builder_phone,
												'current_date'   => $current_date,
												'project_name'	=> $project_data['project_name'],
												'title'	=> $project_data['title'],
												'project_address'	=> $project_address,
												'subcontractor_data'	=> 	$subcontractor_data,
												'co_release_date'	=> $co_release_date,
												'co_list_data'	=> $co_list_data,
												'cost_code_data'	=> $cost_code_data,
												'co_data'	=> $co_data	
											);										
		
			$this->load->view('content/print/change_order', $data);
		}
	}
	/**
	* Task Print
	* @created on: 03/08/2015
	* @method: task_print
	* @access: public 
	* @param: task_id
	* @createdby: Devansh
	*/
	public function task_print($task_id = 0)
	{
		
		$data = array(
               'title' => 'My title',
               'heading' => 'My Heading',
               'message' => 'My Message'
          );

		/* block to get builder datails*/
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID);

		$sort_type = 'ASC';
		$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
		$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array,
												'order_clause' => $order_by_where,
												'pagination' => $pagination_array
												));

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

			// block to get task related data.
			$post_array =  array('TASK.builder_id'=>$this->user_session['builder_id'], 'TASK.ub_task_id =' => $task_id);
			$date_array = array('TASK.due_date'=> 'due_date');
			$task_array = $this->Mod_task->get_task(array(
												'select_fields' => array('TASK.*','TASK_ASSIGNED_USERS.assigned_to','GROUP_CONCAT(CONCAT_WS(" ", USERS.first_name, USERS.last_name)) as assignedto','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator,'.$this->Mod_user->format_user_datetime($date_array,"date")),
												'join'=> array('builder'=>'yes'),
												'where_clause' => $post_array
												));
			// code for getting task checklist.
			 $result_data = $this->Mod_task->get_tasks(array(
			'select_fields' => array('TASK.task_assigned_users','Group_concat(ub_task_checklist.ub_task_checklist_id) as check_list_id','Group_concat(ub_task_checklist.task_id) as task_id','Group_concat(ub_task_checklist.Description) as description','Group_concat(ub_task_checklist.mark_complete_status) as description_checkbox','TASK.mark_complete_status','TASK.created_on'),
			'join'=> array('builder'=>'Yes','ub_task_checklist'=>'Yes'),
			'where_clause' => (array('TASK.ub_task_id' =>  $task_id))
			));

			 $task_data = array_merge($task_array['aaData'][0],$result_data['aaData'][0]);

			// Block to get project related data.
			$project_post_array =  array('PROJECT.ub_project_id'=>$task_data['project_id']);
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal'),
					'where_clause' => $project_post_array 
					));
			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal'];

			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
			

			/*code to create the temp dir and pass it to view*/
			$dir_response = $this->Mod_doc->create_default_dir();
			if ($dir_response['status'] == TRUE) 
			{
				$data['temprory_dir_id'] = $dir_response['temp_directory_id'];
			}
			else
			{
				$data['temprory_dir_id'] = '1';
			}
			/*Code for getting files in print page */
			$task_file_data = array(	  'flag' => 1, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => $task_data['project_id'],
								  'folderid' => 0,
								  'modulename' => 'task',
								  'moduleid' => $task_id,
								);
			$result_array = $this->Mod_doc->get_files_for_folder($task_file_data);

			//echo "<pre>";print_r($result_array);exit;

			$count = count($result_array);

			// block to copy the files from actual directory to tmp.

			$session_id = $this->session->userdata('session_id');
			$file_path = array();
			for ($i=0; $i < $count ; $i++)
			{
				if(isset($result_array[$i]['system_file_name']) && !empty($result_array[$i]['system_file_name']))
				{
					$exp = explode('/', DOC_PATH.$result_array[$i]['system_file_name']);

					copy(DOC_PATH.$result_array[$i]['system_file_name'],DOC_TEMP_PATH.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1]);

					$file_path[] = DOC_URL.'tmp/'.$session_id.'/'.$dir_response['temp_directory_id'].'/'.$exp[count($exp)-1];

				}

			}

			// code for getting builder logo
			$logo_data = array(	  'flag' => 2, 
								  'builder_id'	=> $this->user_session['builder_id'],
								  'projectid' => 0,
								  'folderid' => 0,
								  'modulename' => 'setup',
								  'moduleid' => $this->user_session['builder_id']
								);
			$logo_result = $this->Mod_doc->get_files_for_folder($logo_data);
			//echo "<pre>";print_r($logo_result);exit;
			$logo_url = '';
			foreach($logo_result as $logo_array)
			{
				if(isset($logo_array['system_file_name']) && !empty($logo_array['system_file_name']))
				{
					$ext = pathinfo($logo_array['system_file_name'], PATHINFO_EXTENSION);
					if(!empty($ext))
					{
						$logo_url = DOC_URL.$logo_array['system_file_name'];
					}
				}
			}

			$data['builder_details'] = array( 'builder_address' => $builder_address,
											  'builder_phone' 	=> $builder_phone,
											  'current_date'	=> $current_date,
											  'project_name'	=> $project_data['project_name'],
											  'project_address'	=> $project_address,
											  'task_data'		=> $task_data,
											  'file_path'		=> $file_path,
											  'logo_url'		=> $logo_url
											);
		}
		
		$this->load->view('content/print/task_print', $data);
	}
	
	/* url : cHJpbnRzL3BheV9hcHBfY2Vydgxf1lmaWNhdgxf1Uv  */
	public function pay_app_certificate($payapp_id = 0,$include_val = '')
	{
		/* block to get builder datails*/

		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID );

		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array
												));

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

			// Block to get project related data.
			/* $project_post_array =  array('PROJECT.ub_project_id'=>$this->project_id);
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal'),
					'where_clause' => $project_post_array 
					));
			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal']; */

			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
			
			$certificate_info = $this->Mod_budget->get_payapp_certificate(array('where_clause'=>array('payapp_id'=>$payapp_id)));


			/*$certificate_info = $this->Mod_budget->get_payapp_certificate(('select_fields' => array('PAYAPP_CERTIFICATE.ub_payapp_certificate_id','PAYAPP_CERTIFICATE.builder_id','PAYAPP_CERTIFICATE.project_id','PAYAPP_CERTIFICATE.payapp_id','PAYAPP_CERTIFICATE.payapp_number','PAYAPP_CERTIFICATE.payapp_period_to','PAYAPP_CERTIFICATE.owner_id','PAYAPP_CERTIFICATE.owner_email','PAYAPP_CERTIFICATE.owner_first_name','PAYAPP_CERTIFICATE.owner_last_name','PAYAPP_CERTIFICATE.owner_address','PAYAPP_CERTIFICATE.owner_city','PAYAPP_CERTIFICATE.owner_province','PAYAPP_CERTIFICATE.owner_postal','PAYAPP_CERTIFICATE.owner_desk_phone','PAYAPP_CERTIFICATE.owner_mobile_phone','PAYAPP_CERTIFICATE.owner_fax','PAYAPP_CERTIFICATE.owner_country','PAYAPP_CERTIFICATE.project_no','PAYAPP_CERTIFICATE.contract_date','PAYAPP_CERTIFICATE.project_name','PAYAPP_CERTIFICATE.project_address','PAYAPP_CERTIFICATE.project_city','PAYAPP_CERTIFICATE.project_province','PAYAPP_CERTIFICATE.project_postal','PAYAPP_CERTIFICATE.project_country','PAYAPP_CERTIFICATE.user_id','PAYAPP_CERTIFICATE.user_email','PAYAPP_CERTIFICATE.user_first_name','PAYAPP_CERTIFICATE.user_last_name','PAYAPP_CERTIFICATE.builder_name','PAYAPP_CERTIFICATE.builder_address','PAYAPP_CERTIFICATE.builder_city','PAYAPP_CERTIFICATE.builder_province','PAYAPP_CERTIFICATE.builder_postal','PAYAPP_CERTIFICATE.builder_desk_phone','PAYAPP_CERTIFICATE.builder_mobile_phone','PAYAPP_CERTIFICATE.builder_fax','PAYAPP_CERTIFICATE.builder_country','PAYAPP_CERTIFICATE.co_addition','PAYAPP_CERTIFICATE.co_subtraction','PAYAPP_CERTIFICATE.total_contract_sum','PAYAPP_CERTIFICATE.net_change_by_co','PAYAPP_CERTIFICATE.total_contract_sum_to_date','PAYAPP_CERTIFICATE.total_completed_and_stored_till_date','PAYAPP_CERTIFICATE.total_retainage','PAYAPP_CERTIFICATE.total_earned_less_retainage','PAYAPP_CERTIFICATE.less_previous_certificates_for','PAYAPP_CERTIFICATE.current_payment_due','PAYAPP_CERTIFICATE.balance_to_finish_and_retainage','PAYAPP_CERTIFICATE.created_by','PAYAPP_CERTIFICATE.created_on','PAYAPP_CERTIFICATE.modified_by','PAYAPP_CERTIFICATE.modified_on'),array('where_clause'=>array('payapp_id'=>$payapp_id)));*/

			// echo '<pre>';print_r($certificate_info);
			$certificate_data = array();
			if(TRUE == $certificate_info['status'])
			{
				if($include_val == 'No' && $certificate_info['aaData'][0]['co_addition'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['co_addition'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['co_subtraction'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['co_subtraction'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['total_contract_sum'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['total_contract_sum'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['net_change_by_co'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['net_change_by_co'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['total_contract_sum_to_date'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['total_contract_sum_to_date'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['total_completed_and_stored_till_date'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['total_completed_and_stored_till_date'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['total_retainage'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['total_retainage'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['total_earned_less_retainage'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['total_earned_less_retainage'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['less_previous_certificates_for'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['less_previous_certificates_for'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['current_payment_due'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['current_payment_due'] = '';
			    }
			    if($include_val == 'No' && $certificate_info['aaData'][0]['balance_to_finish_and_retainage'] == 0.00)
			    {
			      $certificate_info['aaData'][0]['balance_to_finish_and_retainage'] = '';
			    }
			    //print_r($certificate_info);exit;

				$certificate_data = $certificate_info['aaData'][0];
				// echo '<pre>';print_r($certificate_data);
				$payapp_arg_co_add = array('select_fields' => array('payapp_number','date_approved','co_addition', 'co_subtraction'),
						'where_clause' => array('certificate_id'=>$certificate_data['ub_payapp_certificate_id']));
						$approved_this_month = $this->Mod_budget->get_payapp_certificate_details($payapp_arg_co_add);
						// echo '<pre>';print_r($approved_this_month);exit;
						if(TRUE === $approved_this_month['status'])
						{
							if($include_val == 'No' && $approved_this_month['aaData'][0]['co_addition'] == 0.00)
			                {
			                   $approved_this_month['aaData'][0]['co_addition'] = '';
			                }
			                if($include_val == 'No' && $approved_this_month['aaData'][0]['co_subtraction'] == 0.00)
			                {
			                  $approved_this_month['aaData'][0]['co_subtraction'] = '';
			                }

							$approved_this_month_array = $approved_this_month['aaData'];
							$certificate_data['approved_this_month'] = $approved_this_month_array;
						}
			}
			 
			$data['builder_details'] = array( 'builder_address' => $builder_address,
											  'builder_phone' 	=> $builder_phone,
											  'current_date'	=> $current_date
											  //'project_address'	=> $project_data								
											);
			$data['certificate_info'] = $certificate_data;
			//print_r($certificate_data);exit;								
		}
		$this->load->view('content/print/pay_app_certificate', $data);
	}
	public function pay_app_cost_view($payapp_id = 0,$include_val = '')
	{
		//echo $payapp_id.'<br>';
		//echo $include_val;exit;
		/* block to get project_id */
		if(empty($this->project_id) && $payapp_id > 0)
		{
			$where_args = array('ub_payapp_id' => $payapp_id);
			$project_id = $this->Mod_project->get_project_id(UB_PAYAPP,$where_args);
			$this->project_id = $project_id['aaData'][0]['project_id'];
			$this->project_name = $project_id['aaData'][0]['project_name'];
		}
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID );

		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes'),
												'where_clause' => $post_array
											));
	
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
			// Block to get project related data.
			$project_post_array =  array('PROJECT.ub_project_id'=>$this->project_id);
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal'),
					'where_clause' => $project_post_array 
					));
			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal'];
			/* block to get current_date*/
			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
		
		
			$pay_app_summary_args = $this->Mod_budget->get_payapp_request_summary(array(
				'select_fields' => array('PAYAPP_REQUEST_SUMMARY.payapp_id','PAYAPP_REQUEST_SUMMARY.ub_payapp_request_summary_id',
				'PAYAPP_REQUEST_SUMMARY.type',
				'PAYAPP_REQUEST_SUMMARY.cost_code_name','PAYAPP_REQUEST_SUMMARY.budgeted_value','PAYAPP_REQUEST_SUMMARY.scheduled_value',
				'PAYAPP_REQUEST_SUMMARY.from_prev_app',
				'PAYAPP_REQUEST_SUMMARY.this_period',
				'PAYAPP_REQUEST_SUMMARY.value_of_material_stored',
				'PAYAPP_REQUEST_SUMMARY.total_completed_and_stored_till_date',
				'PAYAPP_REQUEST_SUMMARY.percentage_of_work_done',
				'PAYAPP_REQUEST_SUMMARY.balance_to_be_finished',
				'PAYAPP_REQUEST_SUMMARY.retainage',
				'PAYAPP_REQUEST_SUMMARY.retainage_amount'),
				'where_clause' => (array('payapp_id' =>  $payapp_id))
				));
			$data['pay_app_summary_args'] = array();
			if(TRUE === $pay_app_summary_args['status'])
			{
				 for($i=0;$i<count($pay_app_summary_args['aaData']);$i++)
			     {
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['budgeted_value'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['budgeted_value'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['scheduled_value'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['scheduled_value'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['from_prev_app'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['from_prev_app'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['this_period'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['this_period'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['value_of_material_stored'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['value_of_material_stored'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['total_completed_and_stored_till_date'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['total_completed_and_stored_till_date'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['percentage_of_work_done'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['percentage_of_work_done'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['balance_to_be_finished'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['balance_to_be_finished'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['retainage'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['retainage'] = '';
			     	}
			     	if($include_val == 'No' && $pay_app_summary_args['aaData'][$i]['retainage_amount'] == 0.00)
			     	{
			     		$pay_app_summary_args['aaData'][$i]['retainage_amount'] = '';
			     	}
				  
			     }	
				// echo count($pay_app_summary_args['aaData']);
				if(count($pay_app_summary_args['aaData']) > 12)
				{
					// echo count($pay_app_summary_args['aaData']);
					$first_page_array = array_slice($pay_app_summary_args['aaData'], 0, 11);
					// echo '<pre>';print_r($first_page_array);
					$reminning_page_array = array_slice($pay_app_summary_args['aaData'], 11);
					// echo '<pre>';print_r($reminning_page_array);exit;
					$data['pay_app_summary_args']  = $first_page_array;
					$data['pay_app_reminning_page_array']  = $reminning_page_array;
				}else{
					$data['pay_app_summary_args']  = $pay_app_summary_args['aaData'];
				}
			}
			
			$total_pay_app_summary_args = $this->Mod_budget->get_payapp_request_summary(array(
				'select_fields' => array('PAYAPP_REQUEST_SUMMARY.payapp_id','PAYAPP_REQUEST_SUMMARY.ub_payapp_request_summary_id',
				'PAYAPP_REQUEST_SUMMARY.type',
				'SUM(PAYAPP_REQUEST_SUMMARY.budgeted_value) AS total_budgeted_value',
				'SUM(PAYAPP_REQUEST_SUMMARY.scheduled_value) AS total_scheduled_value',
				'SUM(PAYAPP_REQUEST_SUMMARY.from_prev_app) AS total_from_prev_app',
				'SUM(PAYAPP_REQUEST_SUMMARY.this_period) AS total_this_period',
				'SUM(PAYAPP_REQUEST_SUMMARY.value_of_material_stored) AS total_value_of_material_stored',
				'SUM(PAYAPP_REQUEST_SUMMARY.total_completed_and_stored_till_date) AS completed_and_stored_till_date',
				'SUM(PAYAPP_REQUEST_SUMMARY.percentage_of_work_done) AS total_percentage_of_work_done',
				'SUM(PAYAPP_REQUEST_SUMMARY.balance_to_be_finished) AS total_balance_to_be_finished',
				'SUM(PAYAPP_REQUEST_SUMMARY.retainage) AS total_retainage',
				'SUM(PAYAPP_REQUEST_SUMMARY.retainage_amount) AS total_retainage_amount'),
				'where_clause' => (array('payapp_id' =>  $payapp_id))
				));
			$data['total_pay_app_summary_args'] = array();	
			if(TRUE === $total_pay_app_summary_args['status'])
			{
				for($i=0;$i<count($total_pay_app_summary_args['aaData']);$i++)
			     {
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_budgeted_value'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_budgeted_value'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_scheduled_value'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_scheduled_value'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_from_prev_app'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_from_prev_app'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_this_period'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_this_period'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_value_of_material_stored'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_value_of_material_stored'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['completed_and_stored_till_date'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['completed_and_stored_till_date'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_percentage_of_work_done'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_percentage_of_work_done'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_balance_to_be_finished'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_balance_to_be_finished'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_retainage'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_retainage'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_summary_args['aaData'][$i]['total_retainage_amount'] == 0.00)
			     	{
			     		$total_pay_app_summary_args['aaData'][$i]['total_retainage_amount'] = '';
			     	}
				  
			     }
				$data['total_pay_app_summary_args']  = $total_pay_app_summary_args['aaData'];
			}

			// Block to get payapp certificate related data.
			$payapp_period_to_date_array = array('PAYAPP_CERTIFICATE.payapp_period_to'=>'payapp_period_to');			
			$payapp_modified_on_date_array = array('PAYAPP_CERTIFICATE.modified_on'=>'modified_on');			
			$payapp_info_list = $this->Mod_budget->get_payapp_certificate(array(
					'select_fields' => array('PAYAPP_CERTIFICATE.payapp_number,'.$this->Mod_user->format_user_datetime($payapp_period_to_date_array).','.$this->Mod_user->format_user_datetime($payapp_modified_on_date_array)),
					'where_clause' => (array('payapp_id' =>  $payapp_id)) 
					));
			$payapp_info_data = array();		
			if(TRUE === $payapp_info_list['status'])
			{		
				$payapp_info_data = $payapp_info_list['aaData'][0];
			}
		
			// Fetch argument building
			$total_pay_app_co_summary_args = $this->Mod_budget->get_payapp_request_summary(array(
				'select_fields' => array('PAYAPP_REQUEST_SUMMARY.payapp_id','PAYAPP_REQUEST_SUMMARY.ub_payapp_request_summary_id',
				'PAYAPP_REQUEST_SUMMARY.type',
				'PAYAPP_REQUEST_SUMMARY.cost_code_name','PAYAPP_REQUEST_SUMMARY.budgeted_value','PAYAPP_REQUEST_SUMMARY.scheduled_value',
				'PAYAPP_REQUEST_SUMMARY.from_prev_app',
				'PAYAPP_REQUEST_SUMMARY.this_period',
				'PAYAPP_REQUEST_SUMMARY.value_of_material_stored',
				'PAYAPP_REQUEST_SUMMARY.total_completed_and_stored_till_date',
				'PAYAPP_REQUEST_SUMMARY.percentage_of_work_done',
				'PAYAPP_REQUEST_SUMMARY.balance_to_be_finished',
				'PAYAPP_REQUEST_SUMMARY.retainage',
				'PAYAPP_REQUEST_SUMMARY.retainage_amount'),
				 'where_clause' => (array('PAYAPP_REQUEST_SUMMARY.type' => 'CO','PAYAPP_REQUEST_SUMMARY.payapp_id' => $payapp_id))
				)); 
			$data['total_pay_app_co_summary_args'] = array();
			if(TRUE === $total_pay_app_co_summary_args['status'])
			{
				for($i=0;$i<count($total_pay_app_co_summary_args['aaData']);$i++)
			     {
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['budgeted_value'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['budgeted_value'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['scheduled_value'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['scheduled_value'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['from_prev_app'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['from_prev_app'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['this_period'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['this_period'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['value_of_material_stored'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['value_of_material_stored'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['total_completed_and_stored_till_date'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['total_completed_and_stored_till_date'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['percentage_of_work_done'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['percentage_of_work_done'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['balance_to_be_finished'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['balance_to_be_finished'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['retainage'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['retainage'] = '';
			     	}
			     	if($include_val == 'No' && $total_pay_app_co_summary_args['aaData'][$i]['retainage_amount'] == 0.00)
			     	{
			     		$total_pay_app_co_summary_args['aaData'][$i]['retainage_amount'] = '';
			     	}
				  
			     }	
				$data['total_pay_app_co_summary_args']  = $total_pay_app_co_summary_args['aaData'];
			}
			
			$sum_pay_app_summary_args = $this->Mod_budget->get_payapp_request_summary(array(
				'select_fields' => array('PAYAPP_REQUEST_SUMMARY.payapp_id','PAYAPP_REQUEST_SUMMARY.ub_payapp_request_summary_id',
				'PAYAPP_REQUEST_SUMMARY.type',
				'SUM(PAYAPP_REQUEST_SUMMARY.budgeted_value) AS total_budgeted_value',
				'SUM(PAYAPP_REQUEST_SUMMARY.scheduled_value) AS total_scheduled_value',
				'SUM(PAYAPP_REQUEST_SUMMARY.from_prev_app) AS total_from_prev_app',
				'SUM(PAYAPP_REQUEST_SUMMARY.this_period) AS total_this_period',
				'SUM(PAYAPP_REQUEST_SUMMARY.value_of_material_stored) AS total_value_of_material_stored',
				'SUM(PAYAPP_REQUEST_SUMMARY.total_completed_and_stored_till_date) AS completed_and_stored_till_date',
				'SUM(PAYAPP_REQUEST_SUMMARY.percentage_of_work_done) AS total_percentage_of_work_done',
				'SUM(PAYAPP_REQUEST_SUMMARY.balance_to_be_finished) AS total_balance_to_be_finished',
				'SUM(PAYAPP_REQUEST_SUMMARY.retainage) AS total_retainage',
				'SUM(PAYAPP_REQUEST_SUMMARY.retainage_amount) AS total_retainage_amount'),
				'where_clause' => (array('PAYAPP_REQUEST_SUMMARY.type' => 'CO','PAYAPP_REQUEST_SUMMARY.payapp_id' => $payapp_id))
				));
			$data['sum_pay_app_summary_args']=array();
			if(TRUE === $sum_pay_app_summary_args['status'])
			{
				for($i=0;$i<count($sum_pay_app_summary_args['aaData']);$i++)
			     {
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_budgeted_value'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_budgeted_value'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_scheduled_value'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_scheduled_value'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_from_prev_app'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_from_prev_app'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_this_period'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_this_period'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_value_of_material_stored'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_value_of_material_stored'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['completed_and_stored_till_date'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['completed_and_stored_till_date'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_percentage_of_work_done'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_percentage_of_work_done'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_balance_to_be_finished'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_balance_to_be_finished'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_retainage'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_retainage'] = '';
			     	}
			     	if($include_val == 'No' && $sum_pay_app_summary_args['aaData'][$i]['total_retainage_amount'] == 0.00)
			     	{
			     		$sum_pay_app_summary_args['aaData'][$i]['total_retainage_amount'] = '';
			     	}
				  
			     }
				$data['sum_pay_app_summary_args']  = $sum_pay_app_summary_args['aaData'];
			}

			$data['builder_details'] = array( 'builder_address'		=> $builder_address,
												'builder_phone'  => $builder_phone,
												'current_date'   => $current_date,
												 'project_address'	=> $project_data,
												 'payapp_info_data'	=> $payapp_info_data,
									);	
			// echo '<pre>';print_r($data);exit;	
			$this->load->view('content/print/pay_app_cost_view', $data);
		}
	}
	public function invoice()
	{
		$this->load->view('content/print/invoice');
	}
	
	public function warranty_print($ub_warranty_claim_id = 0,$project_id=0)
	{
		
		/* block to get builder datails*/
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID );
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes','setup_budget'=>'yes','userplan'=>'yes','setup'=>'yes'),
												'where_clause' => $post_array
												));

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
			/* block to get current_date*/
			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
			// Block to get project related data.
			// $project_post_array =  array('PROJECT.ub_project_id'=>$this->project_id);
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal'),
					 'where_clause' => (array('ub_project_id' =>  $project_id))
					));
			// print_r($project_list);exit;
			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal'];
			
			$warranty_created_on_date_array = array('WARRANTY.created_on'=>'created_on');	
			$warranty_args = $this->Mod_warranty->get_warranty(array(
					'select_fields' => array('WARRANTY.title,'.$this->Mod_user->format_user_datetime($warranty_created_on_date_array,"date").',WARRANTY.category','WARRANTY.priority','WARRANTY.problem_description','WARRANTY.classification','WARRANTY.service_coordinator_id','WARRANTY.original_subcontractor_id','max(WARRANTY_APPOINTMENT.ub_warranty_claim_appointments_id) AS ub_warranty_claim_appointments_id','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name','WARRANTY.status'),
					'join'=> array('warranty_appointment'=>'Yes','project'=>'Yes','user'=>'Yes'),
					'where_clause' => (array('ub_warranty_claim_id' =>  $ub_warranty_claim_id))
				));
			// $total_warranty_args = $warranty_args['aaData'][0];
			$data['warranty_args'] = array();
			if(TRUE === $warranty_args['status'])
			{
				$data['warranty_args']  = $warranty_args['aaData'];
			} 
			 // echo '<pre>';print_r($warranty_args);
			$ub_warranty_claim_appointments_id = $warranty_args['aaData'][0]['ub_warranty_claim_appointments_id'];
			$warranty_completion_date_array = array('WARRANTY_APPOINTMENT.completion_date'=>'completion_date');	
			$warranty_feedback_date_array = array('WARRANTY_APPOINTMENT.modified_on'=>'modified_on');	
			$appoinment_args = $this->Mod_warranty->get_appoinment(array(
			'select_fields' => array($this->Mod_user->format_user_datetime($warranty_completion_date_array,"date").',WARRANTY_APPOINTMENT.approval_comments','WARRANTY_APPOINTMENT.status,'.$this->Mod_user->format_user_datetime($warranty_feedback_date_array,"date").',WARRANTY_APPOINTMENT.modified_by','WARRANTY_APPOINTMENT.approval_comments','CONCAT_WS(" ",USER.first_name,USER.last_name ) AS first_name'),
			 'join'=> array('user'=>'Yes'),
			'where_clause' => (array('ub_warranty_claim_appointments_id' =>  $ub_warranty_claim_appointments_id))
			));
			$data['appoinment_args'] = array();
			if(TRUE === $appoinment_args['status'])
			{
				$data['appoinment_args']  = $appoinment_args['aaData'];
			} 
			//get owner name
			$get_owner_user_id = array(
									'select_fields' => array('owner_id'),
									'where_clause' => array('ub_project_id' => $project_id)
									);
			$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
			$data['owner_name'] = '';
			if(isset($owner_id_details))
			{
				$get_owner_name = array(
									'select_fields' => array('CONCAT_WS(" ", USER.first_name, USER.last_name) as owner'),
									'where_clause' => array('ub_user_id' => $owner_id_details['aaData'][0]['owner_id'])
									);
				$owner_name = $this->Mod_user->get_users($get_owner_name);
				$data['owner_name']  = $owner_name['aaData'][0]['owner'];				
			}
			// echo '<pre>';print_r($appoinment_args);
			// print_r($warranty_args);
			$data['builder_details'] = array( 'builder_address' => $builder_address,
											  'builder_phone' 	=> $builder_phone,
											  'current_date'	=> $current_date,
											  'project_name'	=> $project_data['project_name'],
											  'project_address'	=> $project_address
											);
			// echo '<pre>';print_r($data);exit;
			$this->load->view('content/print/warranty_print', $data);
		}
		
		// $this->load->view('content/print/task_print', $data);
	
	}
	
	public function selection_print($ub_selection_id=0,$project_id=0)
	{
		
		/* block to get builder datails*/
		$post_array =  array('USER.builder_id'=>$this->user_session['builder_id'], 'USER.role_id =' => BUILDER_ADMIN_ROLE_ID );
		
		$sort_type = 'ASC';
		$order_by_where = 'USER.ub_user_id'.' '.$sort_type;
		$pagination_array = array( 'iDisplayStart' => 0,'iDisplayLength' => 1);
		$builder_details_array = $this->Mod_builder->get_builder_details(array(
												'select_fields' => array('BUILDER_DETAILS.ub_builder_id','USER.desk_phone',
												'USER.address','USER.city','USER.province','USER.postal','USER.country'),
												'join'=> array('user'=>'yes','setup_budget'=>'yes','userplan'=>'yes','setup'=>'yes'),
												'where_clause' => $post_array,
												'order_clause' => $order_by_where,
												'pagination' => $pagination_array
												));
											
			
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
			// echo '<pre>';print_r($builder_address);	
			 // echo '<pre>';print_r($builder_address_data['address']);	
			/* block to get current_date*/
			$date_array = array('current_date'=> 'current_date_fmt');
			$current_date = $this->Mod_user->get_current_datetime($date_array,"date");
			
			$project_post_array =  array('PROJECT.ub_project_id'=>$project_id);
			  // echo '<pre>';print_r($project_post_array);exit;
			$project_list = $this->Mod_project->get_projects(array(
					'select_fields' => array('PROJECT.project_name','PROJECT.address','PROJECT.city','PROJECT.province','PROJECT.country','PROJECT.postal'),
					'where_clause' => $project_post_array 
					));
			$project_data = $project_list['aaData'][0];
			$project_data['address'] = (isset($project_data['address']) && $project_data['address']!='')?$project_data['address'].', ':'';
			$project_data['city'] = (isset($project_data['city']) && $project_data['city']!='')?$project_data['city'].', ':'';
			$project_data['province'] = (isset($project_data['province']) && $project_data['province']!='')?$project_data['province'].', ':'';
			$project_data['country'] = (isset($project_data['country']) && $project_data['country']!='')?$project_data['country'].' ':'';
			$project_data['postal'] = (isset($project_data['postal'] ) && $project_data['postal']!='')?$project_data['postal']:'';
			$project_address = $project_data['address'].$project_data['city'].$project_data['province'].$project_data['country'].$project_data['postal'];
			
			$selection_due_date_array = array('SELECTION.due_date'=>'due_date');	
			 $result_data = $this->Mod_selections->get_selections(array(
			'select_fields' => array( 'SELECTION.title', 'SELECTION.category', 'SELECTION.location', 'SELECTION.allowance,'.$this->Mod_user->format_user_datetime($selection_due_date_array,"date").',SELECTION.status','SELECTION_CHOICE.ub_selection_choice_id',),
			'join' => array('user'=>'Yes','selection_choice'=>'Yes'),
			'where_clause' => (array('ub_selection_id' =>  $ub_selection_id))
			));
			$data['result_data'] = array();
			if(TRUE === $result_data['status'])
			{
				$data['result_data']  = $result_data['aaData'];
			} 
			 // echo '<pre>';print_r($result_data);
			$ub_selection_choice_id=$result_data['aaData'][0]['ub_selection_choice_id'];
			$selection_choice_date_array = array('UB_SELECTION_CHOICE.created_on'=>'created_on');	
			  $choice_result_data = $this->Mod_selections->get_selection_choice_list(array(
			'select_fields' => array('UB_SELECTION_CHOICE.title ','UB_SELECTION_CHOICE.product_url', 'UB_SELECTION_CHOICE.owner_price','UB_SELECTION_CHOICE.description','USER.first_name','UB_SELECTION_CHOICE.installer_id','UB_SELECTION_CHOICE.sub_pricing_comments','UB_SELECTION_CHOICE.status','CONCAT_WS(" ", USER.first_name, USER.last_name) as creator','UB_SELECTION_CHOICE.created_by,'.$this->Mod_user->format_user_datetime($selection_choice_date_array,"date")),
			'join'=> array('builder'=>'Yes'),
			'where_clause' => (array('ub_selection_choice_id' =>  $ub_selection_choice_id))
			));
			$data['choice_result_data'] = array();
			if(TRUE === $choice_result_data['status'])
			{
				$data['choice_result_data']  = $choice_result_data['aaData'];
			} 
			//get owner name
			$get_owner_user_id = array(
									'select_fields' => array('owner_id'),
									'where_clause' => array('ub_project_id' => $project_id)
									);
			$owner_id_details = $this->Mod_project->get_projects($get_owner_user_id);
			$data['owner_name'] = '';
			if($owner_id_details['status'] == TRUE)
			{
				$get_owner_name = array(
									'select_fields' => array('CONCAT_WS(" ", USER.first_name, USER.last_name) as owner'),
									'where_clause' => array('ub_user_id' => $owner_id_details['aaData'][0]['owner_id'])
									);
				$owner_name = $this->Mod_user->get_users($get_owner_name);
				if($owner_name['status'] == TRUE)
				{
					$data['owner_name']  = $owner_name['aaData'][0]['owner'];		
				}				
			}
			//get selection disclaimer
			$get_selection_disclaimer = array(
									'select_fields' => array('default_selection_disclaimer'),
									'where_clause' => array('builder_id' => $this->builder_id)
									);
			$selection_disclaimer = $this->Mod_builder->get_setup($get_selection_disclaimer);
			$data['selection_disclaimer'] = '';
			if($selection_disclaimer['status'] == TRUE)
			{
				$data['selection_disclaimer']  = $selection_disclaimer['aaData'][0]['default_selection_disclaimer'];	
			}	
			$data['builder_details'] = array( 'builder_address' => $builder_address,
											  'builder_phone' 	=> $builder_phone,
											  'current_date'	=> $current_date,
											  'project_name'	=> $project_data['project_name'],
											  'project_address'	=> $project_address
											);
			$this->load->view('content/print/selection_print',$data);
		}
	}
	
}
/* End of file print.php */
/* Location: ./application/controllers/print.php */