<?php 
/** 
 * Unibuilder Admin Dashboard Class
 * 
 * @package: Unibuilder Admin 
 * @subpackage: Unibuilder Admin
 * @category: Unibuilder Admin
 * @author: Gopakumar,pranab
 * @createdon(DD-MM-YYYY): 09-06-2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends UNI_Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
    {
		//Parent constructor
        parent::__construct();	
		$this->load->model(array('Mod_login','Mod_user','Mod_role','Mod_builder','Mod_plan','Mod_payment'));
    }
	
	/** 
	* Login index method
	* 
	* @method: index 
	* @access: public 
	* @param:  
	* @return: True
	* Access URL : YWRtaW4vZgxf1Fzagxf1JvYXJkL2luZgxf1V4
	*/
	
	public function index()
	{
	 // echo $this->crypt->encrypt('admin/dashboard/get_payment_list');
		$data = array(
		'title'        => "UNIBUILDER",		
		'content'      => 'admin/content/dashboard/dashboard'		
		);
		$result_builder = $this->get_singup_builders() ;
	    $result_plan    = $this->get_plan_changes() ;
		$result_payment = $this->get_payment_list() ; 
		if(TRUE === $result_builder['status'])
		{
		$data['response'] = $result_builder['aaData'];
		}
		if(TRUE === $result_plan['status'])
		{
		$data['response_plan'] = $result_plan['aaData'];
		}
		if(TRUE === $result_payment['status'])
		{
		$data['response_payment'] = $result_payment['aaData'];
		}
	    $this->template->view($data);
	}
	/** 
	* get latest signup builder details
	* 
	* @method: get_singup_builders 
	* @access: public 
	* @param:  
	* @return: True
	* Access URL : YWRtaW4vZgxf1Fzagxf1JvYXJkL2dldF9zaW5ndXBfYnVpbgxf1RlcnM-
	*/
    public function get_singup_builders()
	{
	    $sort_type = 'DESC LIMIT 10';
		$created_array = array('BUILDER_DETAILS.created_on'=>'created_on');
		$order_by_where = 'BUILDER_DETAILS.ub_builder_id'.' '.$sort_type;
		$builder_details_array = array('select_fields' => 
		                         array('BUILDER_DETAILS.ub_builder_id',
								'BUILDER_DETAILS.builder_name,'.$this->Mod_user->format_user_datetime($created_array,"date").',USER.city','USER_PLAN.plan_id','PLAN.plan_name'),
								'join'=> array('userplan'=>'yes','user'=>'yes','plan'=>'yes'),
								'where_clause' => array('USER.role_id'=>BUILDER_ADMIN_ROLE_ID),
								'order_clause' => $order_by_where);	
		$response = $this->Mod_builder->get_builder_details($builder_details_array) ;
		
		return $response ;
    
	}
	/** 
	* get builder plan change details
	*
	* @method: get_plan_changes 
	* @access: public  
	* @return: True
	* Access URL : YWRtaW4vZgxf1Fzagxf1JvYXJkL2dldF9wbgxf1FuX2NoYW5nZXM-
	*/
   public function get_plan_changes()
   {
        $sort_type = 'DESC LIMIT 10';
		$order_by_where = 'USER_PLAN.ub_user_plan_id'.' '.$sort_type;
		$created_array = array('USER_PLAN.created_on'=>'created_on');
        $plan_details_array = array('select_fields' => 
		                         array('DISTINCT(USER_PLAN.ub_user_plan_id)','USER_PLAN.plan_id,'.
								$this->Mod_user->format_user_datetime($created_array,"date").',BUILDER.builder_name','USER_PLAN.builder_id','PLAN.plan_name as newplan','OLDPLAN.plan_id as olderplaid','OLD_PLAN_NAME.plan_name AS oldplan','UB_BUILDER_CONTRACT.contract_number','UB_BUILDER_CONTRACT.subscription_id'),
								'join'=> array('builder'=>'yes','plan'=>'yes','oldplan'=>'yes','planname'=>'yes','contract'=>'yes'),
								'order_clause' => $order_by_where);	
								
		$response = $this->Mod_plan->get_user_plan($plan_details_array) ;
		
		return $response ;
   } 
   /** 
	* builder count based on plan
	*
	* @method: get_signup_trend 
	* @access: public  
	* @return: True
	* Access URL : YWRtaW4vZgxf1Fzagxf1JvYXJkL2dldF9zaWdudXBfdHJlbmQ-
	*/ 
   public function get_signup_trend()
   {
      $date       = new DateTime('6 days ago');
      $last_seven_days = $date->format('Y-m-d');
	  $today = date('Y-m-d');
	  $dates = $this->dateRange($last_seven_days,$today);
      
	  for($i=0; $i < count($dates); $i++ )
	  {
	 
	  $silver_post_array[] = array(
                              'field_name' => 'USER_PLAN.created_on',
                              'value'=> $dates[$i],
                              'type' => 'like'
                           );
	  $silver_post_array[] = array(
								'field_name' => 'USER_PLAN.plan_id',
								'value'=> 1, 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
		$where_silver = $this->Mod_builder->build_where($silver_post_array);	 					
     	
	  
	   $silver_plan_array = array('select_fields' => 
		                         array('count(USER_PLAN.ub_user_plan_id) as total_user'),
								'where_clause' => $where_silver);	
								
	  $silver_plan[] = $this->Mod_plan->get_user_plan($silver_plan_array) ; 
	  $creted_silver = explode("-",$dates[$i]) ;
	  $created_date_silver = $creted_silver[2] ;
	  $response['silver'][$created_date_silver] = $silver_plan[$i]['aaData'][0]['total_user'] ;
	  $silver_post_array  = '' ;
	} 
	 for($j=0; $j < count($dates); $j++ )
	{
	 
	  $gold_post_array[] = array(
                              'field_name' => 'USER_PLAN.created_on',
                              'value'=> $dates[$j],
                              'type' => 'like'
                           );
	  $gold_post_array[] = array(
								'field_name' => 'USER_PLAN.plan_id',
								'value'=> 2, 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
	  $where_gold = $this->Mod_builder->build_where($gold_post_array);	 					
     	
	  
	   $gold_plan_array = array('select_fields' => 
		                         array('count(USER_PLAN.ub_user_plan_id) as total_user'),
								'where_clause' => $where_gold);	
								
	  $gold_plan[] = $this->Mod_plan->get_user_plan($gold_plan_array) ; 
	  $creted = explode("-",$dates[$j]) ;
	  $created_date = $creted[2] ;
	  $response['gold'][$created_date] = $gold_plan[$j]['aaData'][0]['total_user'] ;
	  $gold_post_array  = '' ;
	}
	for($k=0; $k < count($dates); $k++ )
	{
	 
	  $platinum_post_array[] = array(
                              'field_name' => 'USER_PLAN.created_on',
                              'value'=> $dates[$k],
                              'type' => 'like'
                           );
	  $platinum_post_array[] = array(
								'field_name' => 'USER_PLAN.plan_id',
								'value'=> 3, 
								'type' => '||',
								'classification' => 'dynamnic_text'
							);
	  $where_platinum = $this->Mod_builder->build_where($platinum_post_array);	 					
     	
	  
	   $platinum_plan_array = array('select_fields' => 
		                         array('count(USER_PLAN.ub_user_plan_id) as total_user'),
								'where_clause' => $where_platinum);	
								
	  $platinum_plan[] = $this->Mod_plan->get_user_plan($platinum_plan_array) ; 
	  $creted_platinum = explode("-",$dates[$k]) ;
	  $created_platinum_date = $creted_platinum[2] ;
	  $response['platinum'][$created_platinum_date] = $platinum_plan[$k]['aaData'][0]['total_user'] ;
	  $platinum_post_array  = '' ;
	} 
	$this->Mod_plan->response($response);
   } 
   /** 
	* get date range
	*
	* @method: dateRange 
	* @access: public  
	* @return: True
	*/ 
   public function dateRange($startDate, $endDate) {
    $tmpDate = new DateTime($startDate);
    $tmpEndDate = new DateTime($endDate);

    $outArray = array();
    do {
        $outArray[] = $tmpDate->format('Y-m-d');
    } while ($tmpDate->modify('+1 day') <= $tmpEndDate);

    return $outArray;
    }
	/** 
	* get payment list
	*
	* @method: get_payment_list 
	* @access: public  
	* @return: True
	* @URL:- YWRtaW4vZgxf1Fzagxf1JvYXJkL2dldF9wYXltZW50X2xpc3Q-
	*/ 
    public function get_payment_list()
	{
	      $sort_type = 'DESC LIMIT 10'; 
		  $order_by_where = 'PAYMENT_DETAILS.ub_payment_id'.' '.$sort_type;
		  $date_array = array('PAYMENT_DETAILS.payment_date'=>'payment_date');
          $result_payment = $this->Mod_payment->get_payment_details(array(
							            'select_fields' => array(
										'PAYMENT_DETAILS.ub_payment_id','PAYMENT_DETAILS.plan_id','PAYMENT_DETAILS.amount,'.$this->Mod_user->format_user_datetime($date_array,"date").',PAYMENT_DETAILS.payment_status','PLAN.plan_name','BUILDER_DETAILS.builder_name'),
										'join'=> array('plan'=>'yes','builder'=>'yes'),
										'order_clause' => $order_by_where
										));
		return $result_payment ;								
	}   
}