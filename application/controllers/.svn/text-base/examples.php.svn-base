<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
	}
	// url : ZXhhbXBsZXMvY3JlYXRlX2FpbS8-
	// Create Profile
	public function create_aim()
	{
		// Authorize.net lib
		$this->load->library('authorize_net');

		$auth_net = array(
			'x_card_num'			=> '3088000000000017', // Visa
			'x_exp_date'			=> '12/20',
			'x_card_code'			=> '123',
			'x_description'			=> 'A test transactioffn dd',
			'x_amount'				=> '20000',
			'x_first_name'			=> 'John',
			'x_last_name'			=> 'Doe',
			'x_address'				=> '123 Green St.',
			'x_city'				=> 'Lexington',
			'x_state'				=> 'KY',
			'x_zip'					=> '40502',
			'x_country'				=> 'US',
			'x_phone'				=> '555-123-4567',
			'x_email'				=> 'test@example.com',
			'x_customer_ip'			=> $this->input->ip_address(),
			);
		$this->authorize_net->setData($auth_net);

		// Try to AUTH_CAPTURE
		if( $this->authorize_net->authorizeAndCapture() )
		{
			echo '<h2>Success!</h2>';
			echo '<pre>Transaction ID: '; print_r($this->authorize_net->getTransactionId());
			echo '<p>Approval Code: ' . $this->authorize_net->getApprovalCode() . '</p>';
		}
		else
		{
			echo '<h2>Fail!</h2>';
			// Get error
			echo '<p>' . $this->authorize_net->getError() . '</p>';
			// Show debug data
			$this->authorize_net->debug();
		}
	}

	// url : ZXhhbXBsZXMvY3JlYXRl
	// Create Profile
	function create()
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		echo '<h1>Creating Profile</h1>';
		
		// Start with a create object
		$this->authorize_arb->startData('create');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		
		// Data must be in this specific order
		// For full list of possible data, refer to the documentation:
		// http://www.authorize.net/support/ARB_guide.pdf
		$subscription_data = array(
			'name' => 'My Test Subscription',
			'paymentSchedule' => array(
				'interval' => array(
					'length' => 1,
					'unit' => 'months',
					),
				'startDate' => date('Y-m-d'),
				'totalOccurrences' => 9999,
				'trialOccurrences' => 0,
				),
			'amount' => 25,
			'trialAmount' => 0.00,
			'payment' => array(
				'creditCard' => array(
					'cardNumber' => '4111111111111111',
					'expirationDate' => '2016-08',
					'cardCode' => '123',
					),
				),
			'order' => array(
				'invoiceNumber' => '55555',
				'description' => 'Campaign name',
				),
			'customer' => array(
				'id' => '777',
				'email' => 'test@test.com',
				'phoneNumber' => '859-222-1111',
				),
			'billTo' => array(
				'firstName' => 'James',
				'lastName' => 'Dobson',
				'address' => '123 Green St',
				'city' => 'Lexington',
				'state' => 'KY',
				'zip' => '40502',
				'country' => 'US',
				),
			);
		
		$this->authorize_arb->addData('subscription', $subscription_data);
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! ID: ' . $this->authorize_arb->getId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
	}
	
	// Update Profile
	// url : ZXhhbXBsZXMvdXBkYXRlLw--
	function update( $subscription_id )
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		echo '<h1>Updating Profile</h1>';
		
		// Start with an update object
		$this->authorize_arb->startData('update');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're editing
		$this->authorize_arb->addData('subscriptionId', $subscription_id);
		
		// Data must be in this specific order
		// For full list of possible data, refer to the documentation:
		// http://www.authorize.net/support/ARB_guide.pdf
		$subscription_data = array(
			'name' => 'My Updated Subscription',
			'paymentSchedule' => array(
				'totalOccurrences' => 17,
				'trialOccurrences' => 1,
				),
			'amount' => 15.99,
			'trialAmount' => 9.99,
			'payment' => array(
				'creditCard' => array(
					'cardNumber' => '5105105105105100',
					'expirationDate' => '2013-07',
					'cardCode' => '777',
					),
				),
			'order' => array(
				'invoiceNumber' => '774',
				'description' => 'Updated Campaign name',
				),
			'customer' => array(
				'id' => '774',
				'email' => 'update@edit.com',
				'phoneNumber' => '859-777-7777',
				),
			'billTo' => array(
				'firstName' => 'Dan',
				'lastName' => 'Bryson',
				'address' => '123 Blue St',
				'city' => 'London',
				'state' => 'CA',
				'zip' => '90210',
				'country' => 'US',
				),
			);
		
		$this->authorize_arb->addData('subscription', $subscription_data);
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
	}
	
	// Cancel Profile
	// url : ZXhhbXBsZXMvY2FuY2VsLw--
	function cancel( $subscription_id )
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		echo '<h1>Canceling Profile</h1>';
		
		// Start with a cancel object
		$this->authorize_arb->startData('cancel');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're canceling
		$this->authorize_arb->addData('subscriptionId', $subscription_id);
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
	}
	// Cancel Profile
	// App : ZXhhbXBsZXMvZ2V0X3NldHRsZWRfYmF0Y2hfbgxf1lzdF9yZXF1ZXN0
	function get_settled_batch_list_request( )
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		echo '<h1>Get Settlement</h1>';
		
		// Start with a get_settlement object
		$this->authorize_arb->startData('get_settlement');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		// $this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're cancelling
		$this->authorize_arb->addData('firstSettlementDate', '2015-07-01T16:00:00Z');
		$this->authorize_arb->addData('lastSettlementDate', '2015-07-30T16:00:00Z');
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
	}
	// Settle Batch List Request
	// App : ZXhhbXBsZXMvZ2V0X2Jhdgxf1NoX3N0YXRpc3RpY3NfcmVxdWVzdA--
	function get_batch_statistics_request()
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		echo '<h1>Get Settlement</h1>';
		
		// Start with a get_settlement object
		$this->authorize_arb->startData('batch_statistics');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		// $this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're cancelling
		$this->authorize_arb->addData('batchId', '4447958');
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
	}
	// Settle Batch List Request
	// App : ZXhhbXBsZXMvZ2V0X3RyYW5zYWN0aW9uX2xpc3RfcmVxdWVzdA--
	function get_transaction_list_request()
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		echo '<h1>Get Settlement</h1>';
		
		// Start with a get_settlement object
		$this->authorize_arb->startData('get_transaction');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		// $this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're cancelling
		$this->authorize_arb->addData('batchId', '4447958');
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
	}
	// Settle Batch List Request
	// App : ZXhhbXBsZXMvZ2V0X3RyYW5zYWN0aW9uX2Rldgxf1FpbHNfcmVxdWVzdA--
	function get_transaction_details_request()
	{
		// Load the ARB lib
		$this->load->library('authorize_arb');
		
		echo '<h1>Get Settlement</h1>';
		
		// Start with a get_settlement object
		$this->authorize_arb->startData('get_transaction_details');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		// $this->authorize_arb->addData('refId', $refId);
		
		// The subscription ID that we're cancelling
		$this->authorize_arb->addData('transId', '2236057188');
		
		// Send request
		if( $this->authorize_arb->send() )
		{
			echo '<h1>Success! Ref ID: ' . $this->authorize_arb->getRefId() . '</h1>';
		}
		else
		{
			echo '<h1>Epic Fail!</h1>';
			echo '<p>' . $this->authorize_arb->getError() . '</p>';
		}
		
		// Show debug data
		$this->authorize_arb->debug();
	}
}

/* EOF */