<?php

/**
 * Payment Class
 *
 * @package:	Payment
 * @subpackage: Payment
 * @category:	Payment
 * @author:		Devansh
 * @createdon(DD-MM-YYYY): 07-08-2015
*/

class Mod_payment extends UNI_Model
{
	/**
	 * @property:	$payment_id
	 * @access:		public
	 */
	public $payment_id;

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
		$this->load->model(array('Mod_plan'));	
		
	}

	/**
	 * Get payment information
	 *
	 * $args['select_fields']		- can get all or specific filed information by giving values for the key "select_fields"
	 * $args['join']['builder']		- join builder table with payment table
	 * $args['join']['user_plan']	- join user_plan table with payment table
	 * $args['where_clause']		- can pass where conditions as an array
	 * $args['order_clause']		- sorting option
	 * $args['pagination']			- pagination option
	 *
	 * @method:	get_payment_details
	 * @access:	public
	 * @param:	args
	 * @return:	array
	 */
	public function get_payment_details($args = array())
	{

		$this->read_db->select(isset($args['select_fields']) ? implode(',', $args['select_fields']) : '*', FALSE);
		$this->read_db->from(UB_PAYMENT . ' AS PAYMENT_DETAILS');

		// Join tables
		if (isset($args['join']['builder']) && 'yes' === strtolower($args['join']['builder'])) {
		
			$this->read_db->join(UB_BUILDER . ' AS BUILDER_DETAILS', 'PAYMENT_DETAILS.builder_id = BUILDER_DETAILS.ub_builder_id', 'left');
		}
		if (isset($args['join']['user_plan']) && 'yes' === strtolower($args['join']['user_plan'])) {
			$this->read_db->join(UB_USER_PLAN . ' AS USER_PLAN_DETAILS', 'PAYMENT_DETAILS.plan_id = USER_PLAN_DETAILS.ub_user_plan_id', 'left');
		}
		if (isset($args['join']['plan']) && 'yes' === strtolower($args['join']['plan'])) {

			$this->read_db->join(UB_PLAN . ' AS PLAN', 'PAYMENT_DETAILS.plan_id = PLAN.ub_plan_id', 'left');
		}
		if (isset($args['join']['invoice']) && 'yes' === strtolower($args['join']['invoice'])) {

			$this->read_db->join(UB_INVOICE . ' AS INVOICE_DETAILS', 'INVOICE_DETAILS.payment_id = PAYMENT_DETAILS.ub_payment_id', 'left');
		}
		// Where condition
		if (isset($args['where_clause']) && !empty($args['where_clause'])) {
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
		// echo $this->read_db->last_query();exit;
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
	 * Add payment
	 *
	 * @method:	add_payment
	 * @access:	public
	 * @param:	post data
	 * @return:	insert true return id and success message; otherwise failure message
	 */
	public function add_payment($post_array = array())
	{
		//echo "<pre>";print_r($post_array);
		if (!empty($post_array)) {
			// If payment id is passing, then will take that payment id / will take the session id, this will work fine for both payment admin and uni admin
			// $this->payment_id = (isset($post_array['payment_id'])) ? $post_array['payment_id'] : $this->payment_id;
			// if ($this->payment_id > 0) {
				if ($this->write_db->insert(UB_PAYMENT, $post_array)) {
					//echo "One Record Inserted Sccessfully With ID: " . $this->write_db->insert_id();;
					$data['insert_id']	=	$this->write_db->insert_id();
					$data['status']		=	TRUE;
					$data['message']	=	'Payment(s) inserted successfully';
				} else {
					$data['status']		=	FALSE;
					$data['message']	=	'Insert Failed: Failed to insert the Payment(s)';
				}
			/* } else {
				$data['status']  = FALSE;
				$data['message'] = 'Insert Failed: Not a valid payment';
			} */
		} else {
			$data['status']		=	FALSE;
			$data['message']	=	'Insert Failed: Post array is empty';
		}
		//echo $this->write_db->last_query();exit;
		return $data;
	}


	/**
	 *
	 * Update payment
	 *
	 * @method:	update_payment
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	public function update_payment($post_array = array())
	{
		if (!empty($post_array)) {
			$this->ub_payment_id = isset($post_array['ub_payment_id']) ? $post_array['ub_payment_id'] : $this->ub_payment_id;
			if ($this->ub_payment_id > 0) {

				$this->write_db->where('ub_payment_id', $this->ub_payment_id);
				if ($this->write_db->update(UB_PAYMENT, $post_array)) {
					$data['insert_id'] = $this->ub_payment_id;
					$data['status']    = TRUE;
					$data['message']   = 'Updated successfully';
				} else {
					$data['status']  = FALSE;
					$data['message'] = 'Update failed';
				}
			}

		} else {
			$data['status']  = FALSE;
			$data['message'] = 'Post array is empty';
		}
		return $data;
	}


	/**
	 *
	 * Delete payment
	 *
	 * @method:	delete_payment
	 * @access:	public
	 * @param:	post data
	 * @return:	return data
	 */
	public function delete_payment($delete_array)
	{
		if (isset($delete_array['ub_payment_id'])) {
			foreach ($delete_array['ub_payment_id'] as $key => $ub_payment_id) {
				$this->write_db->delete(UB_PAYMENT, array(
					'ub_payment_id' => $ub_payment_id
				));
			}
			$data['status']  = TRUE;
			$data['message'] = 'Payment(s) deleted successfully';
		} else {
			$data['status']  = FALSE;
			$data['message'] = 'Payment id is not set';
		}
		return $data;
	}

	/** 
	*This function will triget the Authorize.net to process the payment
	* 
	* @method: make_payment
	* @access: public 
	* @param: post data to Authorize.net
	* @return: XML value 
	*/
	public function make_payment($post_array = array())
	{

		$this->load->library('authorize_arb');
		
		// Start with a create object
		$this->authorize_arb->startData('create');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		//$refId = substr(md5( microtime() . 'ref' ), 0, 20);

		$refId = $this->generate_refid('RID',REFID_NUMBER_LENGTH,$post_array['payment_id']);	

		$this->authorize_arb->addData('refId', $refId);
		// block to fetch the plan data.
		$plan_array = $this->Mod_plan->get_plan_details(array(
							'select_fields' => array('PLAN.plan_amount','PLAN.plan_length','PLAN.plan_unit','PLAN.total_occurrences','PLAN.trial_occurrences','PLAN.trail_amount'),
							'where_clause' => array('PLAN.ub_plan_id' => $post_array['plan_id'])
							 ));
		$plan_data = $plan_array['aaData'][0];

		// code to merge the plan array amd post array. 
		$post_array = array_merge($post_array,$plan_data);

		// Data must be in this specific order
		// For full list of possible data, refer to the documentation:
		// http://www.authorize.net/support/ARB_guide.pdf
		// Array to post data to Authorize.Net for subscription
		/* Invoice description condition checking was added by chandru */
		if(isset($post_array['description']) && !empty($post_array['description']))
		{
			$invoice_description = $post_array['description'];
		}else{
			$invoice_description = '';
		}
		/* Chandru code ends here */
		$subscription_data = array(
			'name' => $post_array['builder_name'],
			'paymentSchedule' => array(
				'interval' => array(
					'length' => $post_array['plan_length'],
					'unit' => $post_array['plan_unit'],
					),
				'startDate' => (isset($post_array['start_date']) && !empty($post_array['start_date'])) ? $post_array['start_date'] : date('Y-m-d'),
				'totalOccurrences' => $post_array['total_occurrences'],
				'trialOccurrences' => $post_array['trial_occurrences'],
				),
			'amount' =>  (isset($post_array['updated_plan_amount']) && $post_array['updated_plan_amount'] != 0) ? $post_array['updated_plan_amount'] : $post_array['plan_amount'],
			'trialAmount' =>  (isset($post_array['updated_trial_amount']) && $post_array['updated_trial_amount'] != 0) ? $post_array['updated_trial_amount'] : $post_array['trail_amount'],
			'payment' => array(
				'creditCard' => array(
					'cardNumber' =>  $post_array['accountNumber'],
					'expirationDate' =>  $post_array['expirationYear'].'-'. $post_array['expirationMonth'],
					'cardCode' =>  $post_array['cvNumber'],
					),
				),
			'order' => array(
				'invoiceNumber' =>  $post_array['contract_number'],
				'description' => $invoice_description,
				),
			'customer' => array(
				'id' =>  $post_array['builder_id'],
				'email' =>  $post_array['email'],
				'phoneNumber' =>  $post_array['desk_phone'],
				),
			'billTo' => array(
				'firstName' =>  $post_array['firstName'],
				'lastName' =>  $post_array['lastName'],
				'address' =>  $post_array['street1'],
				'city' =>  $post_array['city'],
				'state' =>  $post_array['state'],
				'zip' =>  $post_array['postalCode'],
				'country' =>  $post_array['country'],
				),
			);
		// echo "<pre>";print_r($subscription_data);exit;
		$this->authorize_arb->addData('subscription', $subscription_data);
		
		// Send request
		$this->authorize_arb->send();
		
		// Show debug data
		/*$debug = $this->authorize_arb->debug();
		echo "<pre>";print_r($debug);exit;*/
		
		$true_responce = $this->authorize_arb->getResponse();
		$error_responce = $this->authorize_arb->getError();
		$responce['responce']	= (isset($true_responce) && !empty($true_responce )) ? $true_responce : $error_responce;
		$responce['post'] 		=	$this->authorize_arb->getSendData();
		
		return $responce;
	}
	/** 
	*This function will triget the Authorize.net to cancel the subscription.
	* 
	* @method: cancel_subscription
	* @access: public 
	* @param: post data to Authorize.net
	* @return: XML value 
	*/
	public function cancel_subscription( $subscription_id )
	{

		//echo "<pre>gdfgdfgdf";print_r($subscription_id);exit;
		//$subscription_id = '2789268';	
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		// Start with a cancel object
		$this->authorize_arb->startData('cancel');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're canceling
		$this->authorize_arb->addData('subscriptionId', $subscription_id);
		
		// Send request
		$this->authorize_arb->send();
		
		// Show debug data
		//$this->authorize_arb->debug();
		$true_responce = $this->authorize_arb->getResponse();
		$error_responce = $this->authorize_arb->getError();
		$responce['responce']	= (isset($true_responce) && !empty($true_responce )) ? $true_responce : $error_responce;
		$responce['post'] 		=	$this->authorize_arb->getSendData();
		return $responce;
	}
	
	/* Update credit card details added by chandru 10-08-2014 */
	public function update_ccdetails( $subscription_id ,$update_cc ,$ub_payment_id)
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		/* echo '<h1>Updating Profile</h1>'; */
		// Start with an update object
		$this->authorize_arb->startData('update');
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		$this->authorize_arb->addData('subscriptionId', $subscription_id);
		$subscription_data = array(
			'payment' => array(
				'creditCard' => array(
					'cardNumber' => $update_cc['credit_card_number'],
					'expirationDate' => $update_cc['expiry_date'],
					'cardCode' => $update_cc['code'],
					),
				),
			);
		
		$this->authorize_arb->addData('subscription', $subscription_data);
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			/* echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>'; */
		}
		else
		{
			/* echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>'; */
		} 
		// $this->authorize_arb->debug();
		$response_array = $this->authorize_arb->getResponse();
		if($response_array['messages']['message']['text'] == 'Successful.')
		{
			$ref_id = $response_array['refId'];
			$credit_card_number = substr($update_cc['credit_card_number'], -4);
			/* Update Payment table for payment_number */
			$payment_update_array = array(
							'last_4digits' => $credit_card_number,
							'reference_id' => $ref_id,
							'ub_payment_id' => $ub_payment_id,
							'modified_on' => TODAY
							);
			$update_payment_response = $this->update_payment($payment_update_array);
			return $update_payment_response['status'];
		}else{
			return FALSE;
		}
	}
	
	/* Update Address details added by chandru 10-08-2014 */
	public function update_address_details( $subscription_id ,$post_array = array())
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		/* echo '<h1>Updating Profile</h1>'; */
		// Start with an update object
		$this->authorize_arb->startData('update');
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		$this->authorize_arb->addData('subscriptionId', $subscription_id);
		$subscription_data = array(
			'billTo' => array(
				'firstName' => $post_array['first_name'],
				'lastName' => $post_array['last_name'],
				'address' => $post_array['address'],
				'city' => $post_array['city'],
				'state' => $post_array['province'],
				'zip' => $post_array['postal'],
				'country' => $post_array['country'],
				),
			);
		
		$this->authorize_arb->addData('subscription', $subscription_data);
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			/* echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>'; */
		}
		else
		{
			/* echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>'; */
		} 
		// $this->authorize_arb->debug();
		$response_array = $this->authorize_arb->getResponse();
		if($response_array['messages']['message']['text'] == 'Successful.')
		{
			return TRUE;
		}else{
			return FALSE;
		}
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
	public function generate_refid($type, $pad_length, $pad_id)
	{
		$number = str_pad($pad_id, $pad_length,'0',STR_PAD_LEFT);
		return $type.'-'.$number.'-'.mt_rand(100000,999999);
	}
	/* AIM payment common code added by chandru 25-06-2015 */
	public function make_aim_transaction($post_array = array())
	{
		/* AIM code starts here */
			$card_expiry_month_and_date = $post_array['card_expiry_month'].'/'.$post_array['card_expiry_year'];
			$aim_post_array = array(
					'x_card_num'			=> $post_array['credit_card_numbers'], // Visa
					'x_exp_date'			=> $card_expiry_month_and_date,
					'x_card_code'			=> $post_array['ccv_code'],
					'x_description'			=> 'AIM',
					'x_amount'				=> $post_array['updated_plan_amount'],
					'x_first_name'			=> $post_array['first_name'],
					'x_last_name'			=> $post_array['last_name'],
					'x_address'				=> $post_array['address'],
					'x_city'				=> $post_array['city'],
					'x_state'				=> $post_array['province'],
					'x_zip'					=> $post_array['postal'],
					'x_country'				=> $post_array['country'],
					'x_phone'				=> $post_array['desk_phone'],
					'x_email'				=> $post_array['primary_email'],
					'x_customer_ip'			=> $this->input->ip_address()
			);
			/* Authorize.net AIM */
			$this->load->library('authorize_net');
			$this->authorize_net->setData($aim_post_array);
			if( $this->authorize_net->authorizeAndCapture() )
			{
				$response = $this->authorize_net->getTransactionId();
				$response['status'] = TRUE;
			}else{
				$response['message'] = $this->authorize_net->getError();
				$response['status'] = FALSE;
			}
			return $response;
	}
	
	/* Below "PRODATA_AMOUNT" function was 
	created by : chandru 
	Created for: FINDING PRO DATA AMOUNT
	Created on : 05-10-2015
	*/
	public function prodata_amount($current_plan_amount = 0, $last_charged_amount = 0, $current_plan_length = 0, $days = 0)
	{
		/* Below formula for finding pro data amount */
		if ($current_plan_amount > 0) 
		{
			/* Days is nothing but, "How many days they used previous plan" */
			/* Current plan length is new plan length in days */
			$prodata_amount = round($current_plan_amount - ($last_charged_amount /$current_plan_length * $days),2);
		}else{
			$prodata_amount = 0;
		}
		return $prodata_amount;
	}
}

/* End of file mod_payment.php */
/* Location: ./application/models/mod_payment.php */