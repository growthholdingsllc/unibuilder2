<?php

/**
 * CyberSource SOAP communications class.
 * 
 * @package lib
 * @author DPassey
 * @copyright 2010, Everett Public Schools
 * @version 1.0, 06.14.2010
 * @link https://ics2ws.ic3.com/commerce/1.x/transactionProcessor/CyberSourceTransaction_1.53.xsd
 * @license GPL
 * @todo Add reporting functionality
 */

	class EPS_CYBERSOURCE extends SoapClient 
	{
		
/**
 * The reply object flattened for simplicity.
 * 
 * @var Object
 */
		public $reply;
		
/**
 * A transaction success flag for the current action.
 * 
 * @var Boolean
 */
		public $success = FALSE;
		
/**
 * The CyberSource merchant id.
 * 
 * @var String
 */
		private $user;
		
/**
 * The merchant password.
 * 
 * This is usually the transaction key obtained from CyberSource.
 * 
 * @var String
 */
		private $password;
		
/**
 * A currency code.
 * 
 * Default is US dollars.
 * 
 * @var String
 */
		private $currency = 'USD';
		
/**
 * Flag to indicate if the transaction was successfully authorized.
 * 
 * @var Boolean
 */		
		private $isAuthorized = FALSE;
		
/**
 * Flag to indicate if the transaction was successfully captured.
 * 
 * @var Boolean
 */
		private $isCaptured = FALSE;
		
/**
 * Flag to indicate if the transaction was successfully reversed.
 * 
 * @var Boolean
 */
		private $isReversed = FALSE;
		
/**
 * Flag to indicate if the transaction was succesfully credited.
 * 
 * @var Boolean
 */
		private $isCredited = FALSE;
	
/**
 * Internal raw SOAP reply.
 * 
 * @var String
 */
		private $rawReply;
		
/**
 * Internal request object.
 * 
 * @var Object
 */
		private $obj;
		
/**
 * SOAP header.
 * 
 * This is provided by CyberSource from their documentation.
 * 
 * @var String
 */
     	private $soapHeader = "<SOAP-ENV:Header xmlns:SOAP-ENV=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:wsse=\"http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd\"><wsse:Security SOAP-ENV:mustUnderstand=\"1\"><wsse:UsernameToken><wsse:Username>%s</wsse:Username><wsse:Password Type=\"http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText\">%s</wsse:Password></wsse:UsernameToken></wsse:Security></SOAP-ENV:Header>";

/**
 * An array of preset conversion values.
 * 
 * The merchant reference code can be assembled using these values from the associated keys passed by the user.
 * 
 * @var Array
 */
     	private $rcArray = array();

/**
 * The minimum length of the random number.
 * 
 * @var Int
 */
   		private $rndmMin = 6;
   		
/**
 * The maximum length of the random number.
 * 
 * This cannot be longer than the length of the largest possible random number.
 * 
 * @var Int
 */
   		private $rndmMax;
   		
/**
 * An array of basic core objects that should not be sent again when requesting a follow-on service.
 * 
 * @var Array
 */
   		private $unsetArray = array('card',
	   		'billTo',
	   		'shipTo',
	   		'item',
	   		'merchantDefinedData',
   			'merchantSecureData',
	   		'ccAuthService');
   		
/**
 * The schema help object.
 * 
 * @var Object
 */
   		private $help = NULL;
   		
/**
 * The URL for the CyberSource transaction processor schema information.
 * 
 * @var String
 */
   		private $helpURL;

/**
 * The XML schema element label that matches the complex data types.
 * 
 * @var String
 */
   		private $complexLabel = '<xsd:complexType';
 	
/**
 * The Merchant Defined Data size limitation as determined by CyberSource.
 * 
 * @var Const
 */
     	const MDD_LIMIT = 4;
     	
/**
 * The Merchant Defined Data element name as determined by CyberSource.
 * 
 * @var Const
 */
     	const MDD_ELEMENT_NAME = 'field';
     	
/**
 * Client library value used by CyberSource for debugging.
 * 
 * @var Const
 */
     	const CLIENT_LIBRARY = "PHP";
     	
/**
 * Class constructor.
 * 
 * @param String $url
 * @param String $user
 * @param String $password
 * @see CLIENT_LIBRARY
 * @throws Exception
 */
   		public function __construct($url = NULL, $user = NULL, $password = NULL) 
   		{
   			$this->obj = new stdClass();
   			try 
   			{
   				if (!extension_loaded('openssl')) throw new Exception (__FUNCTION__ . '::OpenSSL extension is not loaded.');
     			parent::__construct($url);
     			$this->user = $user;
     			$this->password = $password;
     			if (empty($user) || empty($password)) throw new Exception (__FUNCTION__ . '::Username and Password must be provided.');
     			$this->rcArray = array('YY'=>date('y'),'YYYY'=>date('Y'),'MM'=>date('m'),'M'=>date('n'),'DD'=>date('d'),'D'=>date('j'),'J'=>date('z')+1,'W'=>date('W'),'HH'=>date('H'),'H'=>date('h'),'I'=>date('i'),'AP'=>date('A'),'RNDM'=>mt_rand());
     			$this->rndmMax = strlen(mt_getrandmax());
     			$this->helpURL = dirname($url) . '/';
     			
     			if (is_object($this->obj)) 
     			{
					$this->obj->merchantID = $this->user;
					$this->obj->clientLibrary = self::CLIENT_LIBRARY;
					$this->obj->clientLibraryVersion = phpversion();
					$this->obj->clientEnvironment = php_uname();
     			}
     			else throw new Exception (__FUNCTION__ . '::Request object could not be created.');
   			}
   			catch (Exception $e)
   			{
   				exit($e->getMessage());
   			}
   		}

/**
 * SOAP request override method.
 * 
 * Creates the SOAP request object before being sent over to the server for processing.
 * 
 * @param Object $request
 * @param String $location
 * @param String $action
 * @param String $version
 * @throws DOMException
 * @link http://www.php.net/soapclient
 * @return Object
 */
   		public function __doRequest($request = NULL, $location = NULL, $action = NULL, $version = NULL) 
   		{
			$header = sprintf("$this->soapHeader",$this->user,$this->password);
     		$requestDOM = new DOMDocument('1.0');
     		$soapHeaderDOM = new DOMDocument('1.0');
     		try 
     		{
         		$requestDOM->loadXML($request);
	 			$soapHeaderDOM->loadXML($header);
	 			$node = $requestDOM->importNode($soapHeaderDOM->firstChild, true);
	 			$requestDOM->firstChild->insertBefore($node, $requestDOM->firstChild->firstChild);
         		$request = $requestDOM->saveXML();
     			$this->rawReply = parent::__doRequest($request, $location, $action, $version);
     		} 
     		catch (DOMException $e) 
     		{
         		exit(__FUNCTION__ . '::Error adding UsernameToken: ' . $e->code);
     		}
     		return $this->rawReply;
   		}

/**
 * Processes an authorization.
 * 
 * If called from the capturing method, then it adds the auth service to the request object before sending.
 * 
 * @see send()
 * @throws Exception
 */
   		public function ccAuthorize()
   		{
			$traceArray = debug_backtrace();
			$obj = new stdClass();
			try
			{
				if ($this->isAuthorized) throw new Exception(__FUNCTION__ . '::Transaction is already authorized.');
				if (is_object($obj)) $obj->run = 'true';
				else throw new Exception(__FUNCTION__ . '::Authorize object could not be created.');
				$this->obj->ccAuthService = $obj;
				if ($traceArray[1]['function'] != 'capture') self::send();
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
   		}
   		
/**
 * Processes a capture.
 * 
 * Calls the authorization method if the transaction has not yet been authorized.
 * Provides a mechanism for doing authorizations and captures in one action.
 * 
 * @see ccAuthorize()
 * @see send()
 * @see unsetObjects()
 * @throws Exception
 */
   		public function ccCapture()
   		{
			$obj = new stdClass();
			try
			{
				if ($this->isCaptured) throw new Exception(__FUNCTION__ . '::Transaction is already captured.');
				if (is_object($obj)) 
				{
					$obj->run = 'true';
					if (!$this->isAuthorized) self::ccAuthorize();
					else 
					{
						$obj->authRequestToken = $this->reply->requestToken;
						$obj->authRequestID = $this->reply->requestID;
						self::unsetObjects();
					}
   					$this->obj->ccCaptureService = $obj;
   					self::send();
				}
				else throw new Exception(__FUNCTION__ . '::Capture object could not be created.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
   		}

/**
 * Sets the credit card request object.
 * 
 * To avoid errors, call this method first.
 * 
 * Used for initial authorization, capture, and stand-alone credit requests.
 * All keys for the arrays must be exactly as defined by the CyberSource documentation.
 * They are not converted to the proper field names before being sent over to the processor.
 * 
 * @param Array $billArray
 * @param Array $shipArray
 * @param Array $cardArray
 * @param Array $itemArray
 * @param Array $shipArray
 * @see setBillingData()
 * @see setCardData()
 * @see setItemData()
 * @see setShippingData()
 * @see setPurchaseTotals
 * @throws Exception
 */
   		public function setCCRequest($billArray = NULL, $cardArray = NULL, $itemArray = NULL, $shipArray = NULL)
   		{
   			try
   			{
				if (is_array($billArray)) $this->obj->billTo = self::setBillingData($billArray);
				else throw new Exception(__FUNCTION__ . '::Billing information must be an array.');
		
				if (is_array($cardArray)) $this->obj->card = self::setCardData($cardArray);
				else throw new Exception(__FUNCTION__ . '::Credit card information must be an array.');
		
				if (is_array($itemArray)) $this->obj->item = self::setItemData($itemArray);
				else throw new Exception(__FUNCTION__ . '::Item information must be an array.');
		
				if (!is_null($shipArray))
				{
					if (is_array($shipArray)) $this->obj->shipTo = self::setShippingData($shipArray);
					else throw new Exception(__FUNCTION__ . '::Shipping information must be an array.');
				}
						
				$this->obj->purchaseTotals = self::setPurchaseTotals();
 			}
 			catch (Exception $e)
 			{
 				exit($e->getMessage());
 			}
   		}
   		
/**
 * Gets the raw SOAP reply data as XML text formatted with newlines.
 * 
 * @return String
 */
   		public function getSoapReply()
   		{
   			$this->rawReply = trim($this->rawReply);
   			return (empty($this->rawReply)) ? NULL : str_replace('><',">\n<",$this->rawReply);
   		}
   		
/**
 * Sets the merchant defined data fields.
 * 
 * Only array values are needed as the key names are configured automatically.
 * 
 * @param Array $array
 * @throws Exception
 * @see MDD_LIMIT
 * @see MDD_ELEMENT_NAME
 */
   		public function setMerchantDefinedData($array = array())
   		{
   			$obj = (count($array) > 0) ? new stdClass() : NULL;
   			try
   			{
   				if (count($array) > self::MDD_LIMIT) throw new Exception(__FUNCTION__ . '::Custom array is too large.');
				if (is_object($obj))
				{
					for ($z = 0; $z < count($array); $z++) 
					{
   						$elem = sprintf("%s%d",self::MDD_ELEMENT_NAME,$z + 1);
						$obj->$elem = $array[$z];
					}
					$this->obj->merchantDefinedData = $obj;
				}
				else throw new Exception(__FUNCTION__ . '::Custom data array is empty.');
   			}
   			catch (Exception $e)
   			{
   				exit($e->getMessage());
   			}
   		}
   		
/**
 * Gets the internal request object as is was sent to the server.
 * 
 * @return Object
 */
   		public function getSoapRequest()
   		{
   			return $this->obj;
   		}
   		
/**
 * Sets the merchant reference code.
 * 
 * This allows the user to quickly and dynamically create a merchant reference code based upon what keys are passed into the array.
 * Any values not present as array keys are assumed to be literal strings that the user wants in the reference code.
 * 
 * Preset keys and their associated values are:
 * 
 *   YY = 2 digit year.
 *   
 *   YYYY = 4 digit year.
 *   
 *   MM = Month with leading zero.
 *   
 *   M = Month without leading zero.
 *   
 *   DD = Day of the month with leading zero.
 *   
 *   D = Day of the month without leading zero.
 *   
 *   J = Julian day of the year (1 - 366).
 *   
 *   W = Week number of the year (starting on Monday).
 *   
 *   HH = 24 hour clock with leading zeros.
 *   
 *   H = 12 hour clock with leading zeros.
 *   
 *   I = Minutes with leading zeros.
 *   
 *   AP = AM or PM (uppercase).
 *   
 * 	 RNDM = Random number.
 * 
 * The RNDM key may be passed as a String or Array.  If passed as an Array, then the following apply:
 * 
 *     RNDM[0] = 'RNDM'.
 *     
 *     RNDM[1] = Minimum length of the random number [Optional].
 *     
 *     RNDM[2] = Maximum length of the random number [Optional].
 *     
 * Examples: 
 * 
 * 		array('EPS','-','YYYY','J','-',array('RNDM',6,8)).
 * 
 * 		array('YY','MM','DD','AP','-','RNDM').
 * 
 * All keys are case sensitive.
 * 
 * @param Array $code
 * @throws Exception
 */
   		public function setReferenceCode($code = array())
   		{
			$ref_code = '';
    		try 
    		{
    			if (!is_array($code)) throw new Exception(__FUNCTION__ . '::Input parameter is not an array.');
    			else
    			{
    				if (count($code) == 1) $ref_code = $code[0];
    				else
    				{
    					foreach ($code as $k) 
    					{
    						if (!is_array($k))
    						{
								if (array_key_exists($k,$this->rcArray)) $ref_code .= sprintf("%s",$this->rcArray[$k]);
								else $ref_code .= sprintf("%s",$k);
							}
							else
							{
								if ($k[0] == 'RNDM')
								{
									$min = (array_key_exists(1,$k)) ? $k[1] : $this->rndmMin;
									$max = (array_key_exists(2,$k)) ? $k[2] : $this->rndmMax;
									if ($min > $max) throw new Exception(__FUNCTION__ . '::MIN random number limit is larger than MAX random number limit.');
									else if ($min < 1) throw new Exception(__FUNCTION__ . '::MIN random number limit is invalid.');
									else if ($max > $this->rndmMax) throw new Exception(__FUNCTION__ . '::MAX random number limit is invalid.');
									else 
									{
										do $rand = sprintf("%s",substr(mt_rand(),0,$max));
										while (strlen($rand) < $min);
										$ref_code .= $rand;
									}
								}
								else throw new Exception(__FUNCTION__ . '::Array key of ' . $k[0] . ' is not valid.');
							}
    					}
    				}
    				$this->obj->merchantReferenceCode = $ref_code;
    			}
    		}
    		catch (Exception $e)
    		{
    			exit($e->getMessage());
    		}
   		}
   		
/**
 * Sets the currency code.
 * 
 * If called, it must be after a CC request object is created.  
 * Calling this before the purchaseTotals object is created (which is typically at the end of the request object creation process),
 * will have no affect on changing the currency (i.e. from USD to CAD).
 * 
 * @param String $code
 * @throws Exception
 */
   		public function setCurrency($code = NULL)
   		{
   			try
   			{
   				if (empty($code)) throw new Exception(__FUNCTION__ . '::Currency code is empty.');
   				if (!is_object($this->obj->purchaseTotals)) throw new Exception(__FUNCTION__ . '::Currency cannot be set before the request object is created.');
   				else $this->obj->purchaseTotals->currency = strtoupper(trim($code));
   			}
   			catch (Exception $e)
   			{
   				exit($e->getMessage());
   			}
   		}

/**
 * Reverses a previous transaction.
 * 
 * Allowable services are authorization (A) and capture (C).
 * 
 * Default is authorization.
 * 
 * @param String $service
 * @see send()
 * @throws Exception
 */
   		public function ccReverse($service = 'A')
   		{
			$service = strtoupper(trim($service));
   			try 
   			{
   				if ($this->isReversed) throw new Exception(__FUNCTION__ . '::Transaction is already reversed.');
   				if ($service == 'A')
   				{
   					if (is_object($this->obj->ccAuthReversalService)) 
   					{	
   						$this->obj->ccAuthReversalService->run = 'true';
   						unset($this->obj->ccCreditService);
   						self::send();
   					}
   					else throw new Exception(__FUNCTION__ . '::Auth reversal service object was not created.');
   				}
   				elseif ($service == 'C')
   				{
   					if (is_object($this->obj->ccCreditService)) 
   					{	
   						$this->obj->ccCreditService->run = 'true';
   						unset($this->obj->ccAuthReversalService);
   						self::send();
   					}
   					else throw new Exception(__FUNCTION__ . '::Credit reversal service object was not created.');
   				}
   				else throw new Exception(__FUNCTION__ . '::Service type is invalid.');
   			}
   			catch (Exception $e)
   			{
   				exit($e->getMessage());
   			}
   			
   		}

/**
 * Sets the credit card reversal request object.
 * 
 * Use this method for reversing authorizations and captures only.
 * It creates objects for authorizations and captures so both are available for the ccReverse() method.
 * 
 * @param String $request_token
 * @param String $request_id
 * @param String $ref_code
 * @param String $amount
 * @see ccReverse()
 * @see setPurchaseTotals()
 * @throws Exception
 */
   		public function setCCReversalRequest($request_token = NULL, $request_id = NULL, $ref_code = NULL, $amount = NULL)
   		{
   			$objA = new stdClass();
   			$objC = new stdClass();
   			try
   			{
 				if (!empty($request_token))
 				{
 					$objA->authRequestToken = $request_token;
 					$objC->orderRequestToken = $request_token;
 				}
 				else throw new Exception(__FUNCTION__ . '::Request token is missing.');
 				
 				if (!empty($request_id))
 				{
 					$objA->authRequestID = $request_id;
 					$objC->captureRequestID = $request_id;
 				}
 				else throw new Exception(__FUNCTION__ . '::Request id is missing.');
 				
 				if (!empty($ref_code)) $this->obj->merchantReferenceCode = $ref_code;
 				else throw new Exception(__FUNCTION__ . '::Merchant reference code is missing.');
 				
 				if (!empty($amount)) $this->obj->purchaseTotals = self::setPurchaseTotals($amount);
  				else throw new Exception(__FUNCTION__ . '::Purchase amount is missing.');

				$this->obj->ccAuthReversalService = $objA;
				$this->obj->ccCreditService = $objC;
   			}
   			catch (Exception $e)
   			{
   				exit($e->getMessage());
   			}
   		}
   		
/**
 * Sets the credit card credit request object for stand-alone credits.
 * 
 * To avoid errors, call this method first.
 * 
 * Follows the same logic for simple credit requests.
 * 
 * @param Array $billArray
 * @param Array $cardArray
 * @see setCCRequest()
 * @throws Exception
 */
   		public function setCCCreditRequest($billArray = NULL, $cardArray = NULL)
   		{
   			$obj = new stdClass();
   			try 
   			{
   				self::setCCRequest($billArray,$cardArray,array(array('dummy'=>'array')));
   				if (is_object($this->obj))
   				{
   					unset($this->obj->item);
   					if (is_object($obj)) 
   					{
   						$obj->run = 'true';
   						$this->obj->ccCreditService = $obj;
   					}
   					else throw new Exception (__FUNCTION__ . '::Credit service object could not be created.');
   				}
   				else throw new Exception (__FUNCTION__ . '::Request object could not be created.');
   			}
   			catch (Exception $e)
   			{
   				exit($e->getMessage());
   			}
   		}
   		
/**
 * Processes a stand-alone credit.
 * 
 * @see setPurchaseTotals()
 * @see send()
 * @param String $amount
 * @throws Exception
 */
   		public function ccCredit($amount = NULL)
   		{
			try 
			{
				if ($this->isCredited) throw new Exception(__FUNCTION__ . '::Transaction is already credited.');
				if (!empty($amount)) $this->obj->purchaseTotals = self::setPurchaseTotals($amount);
				else throw new Exception (__FUNCTION__ . '::Amount is missing.');
   				self::send();				
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
   			
   		}
   		
/**
 * Gets the latest XML schema version from the help object.
 * 
 * Creates the help object if it does not exist.
 * 
 * @see setHelpObject()
 * @return String
 */
   		public function getHelpVersion()
   		{
   			if (is_null($this->help)) self::setHelpObject();
   			return $this->help->version;
   		}
   		
/**
 * Gets help for the top level services and attributes from the help object.
 * 
 * If a key is passed, then the fields and attributes for that key are returned.
 * Creates the help object if it does not exist.
 * 
 * The key is not case sensitive.
 * 
 * @param String $key
 * @see setHelpObject()
 * @return Array
 */
   		public function getHelp($key = NULL)
   		{
   			$arr = array();
   			if (is_null($this->help)) self::setHelpObject();  	
			foreach ($this->help as $k => $v)
			{
				if (is_object($v)) 
				{
					if (empty($key)) $arr[] = $k;
					else if (strtolower($k) == strtolower($key)) 
					{
						foreach ($v as $k2 => $v2) $arr["$k2"] = $v2;
						break;
					}
				}
    			if (count($arr) > 0) natcasesort($arr);
   			}
    		return $arr;
   		}
   		
/** Private methods **/
   		
/**
 * Sends the request to the server.
 * 
 * Sets the applicable Boolean flags to show that a particular transaction event has already occurred.  
 * This is to help prevent duplicate transactions.
 *
 * @see setReplyFields()
 * @throws Exception
 * @return Object
 */
   		private function send()
   		{
   			$this->success = FALSE;
   			$traceArray = debug_backtrace();
   			try 
   			{
				$this->reply = self::setReplyFields($this->runTransaction($this->obj));
    			$this->success = ($this->reply->reasonCode == 100 && strtoupper($this->reply->decision) == 'ACCEPT') ? TRUE : FALSE;
				switch ($traceArray[1]['function'])
				{
					case 'ccAuthorize':
						$this->isAuthorized = ($this->success) ? TRUE : FALSE;
						break;
					case 'ccCapture':
						$this->isAuthorized = ($this->success) ? TRUE : FALSE;
						$this->isCaptured = ($this->success) ? TRUE : FALSE;	
						break;
					case 'ccReverse':
						$this->isReversed = ($this->success) ? TRUE : FALSE;
						break;
					case 'ccCredit':
						$this->isCredited = ($this->success) ? TRUE : FALSE;
						break;
					default:	
						throw new Exception ($traceArray[1]['function'] . ' is unknown.');				
				}
   			}
   			catch (Exception $e)
   			{
   				exit(__FUNCTION__ . '::' . $e->getMessage());
   			}
   			return $this->reply;
   		}
   		
/**
 * Sets the billing data object.
 * 
 * Cycles through the key/value pairs and assigns them to the billTo object.
 * 
 * @param Array $array
 * @throws Exception
 * @return Object
 */
		private function setBillingData($array = array())
		{
			$obj = (count($array) > 0) ? new stdClass() : NULL;
			try 
			{
				if (is_object($obj))
				{
					foreach ($array as $k => $v) $obj->$k = $v;
				}
				else throw new Exception(__FUNCTION__ . '::Billing data array is empty.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
			return $obj;
		}
		
/**
 * Sets the shipping data object.
 * 
 * Cycles through the key/value pairs and assigns them to the shipTo object.
 * 
 * @param Array $array
 * @throws Exception
 * @return Object
 */
		private function setShippingData($array = array())
		{
			$obj = (count($array) > 0) ? new stdClass() : NULL;
			if (!is_null($array))
			{
				try 
				{
					if (is_object($obj))
					{
						foreach ($array as $k => $v) $obj->$k = $v;
					}
				else throw new Exception(__FUNCTION__ . '::Shipping data array is empty.');
				}
				catch (Exception $e)
				{
					exit($e->getMessage());
				}
			}
			return $obj;
		}
		
		
/**
 * Sets the credit card data object.
 * 
 * Cycles through the key/value pairs and assigns them to the card object.
 * It also sets the card type value from the credit card number.
 * 
 * @param Array $array
 * @throws Exception
 * @return Object
 */
		private function setCardData($array = array())
		{
			$obj = (count($array) > 0) ? new stdClass() : NULL;
			try
			{
				if (is_object($obj))
				{
					foreach ($array as $k => $v) $obj->$k = $v;
					switch (substr($obj->accountNumber,0,1))
					{
						case 4:
							$obj->cardType = '001';
							break;
						case 5:
							$obj->cardType = '002';
							break;
						case 3:
							$obj->cardType = '003';
							break;
						case 6:
							$obj->cardType = '004';
							break;
						default:
							$obj->cardType = NULL;
					}
					$obj->expirationMonth = sprintf("%02s",$obj->expirationMonth);
				}
				else throw new Exception(__FUNCTION__ . '::Credit card data array is empty.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
			return $obj;
		}
		
/**
 * Sets the item data object.
 * 
 * Cycles through the key/value pairs and assigns them to the item object.
 * 
 * @param Array $array
 * @throws Exception
 * @return Object
 */
		private function setItemData($array = array())
		{
			$items = array();
			$i = 0;
			try
			{
				if (count($array) > 0)
				{
					foreach ($array as $item)
					{
						$obj = new stdClass();
						foreach ($item as $k => $v) 
						{	
							$obj->id = $i;
							if ($k == 'unitPrice') $obj->$k = sprintf("%01.2f",$v);
							else $obj->$k = $v;
						}
						$items[] = $obj;
						$i++;
						unset($obj);
					}
				}
				else throw new Exception(__FUNCTION__ . '::Item data is empty.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
			return $items;
		}
		
/**
 * Sets the purchase totals object.
 * 
 * If the item object is available, it uses this to calcuate purchase total cost.
 * For reversals, an amount value must be passed in since no items are available.
 * 
 * @param String $amount
 * @throws Exception
 * @return Object
 */
		private function setPurchaseTotals($amount = NULL)
		{
			$obj = new stdClass();
			try 
			{
				if (is_object($obj))
				{
					if (empty($obj->currency)) $obj->currency = $this->currency;
					if (is_null($amount))
					{
						foreach ($this->obj->item as $item)
						{
							foreach ($item as $k => $v) 
							{
								if ($k == 'unitPrice') $price = sprintf("%01.2f",$v);
								if ($k == 'quantity') $count = sprintf("%d",$v);
							}
							$obj->grandTotalAmount = sprintf("%01.2f",($price * $count) + $obj->grandTotalAmount);
						}
					}
					else $obj->grandTotalAmount = sprintf("%01.2f",$amount);
				}
				else throw new Exception(__FUNCTION__ . '::Purchase totals object could not be created.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
			return $obj;
		}

/**
 * Sets the reply fields to a flat (non-nested) reply object.
 * 
 * @param Object $obj
 * @throws Exception
 * @return Object
 */
		private function setReplyFields($obj = NULL)
		{
			$temp = new stdClass();
			try 
			{
				if (is_object($obj))
				{
					try 
					{
						foreach ($obj as $key => $value)
						{
							if (!is_object($value)) $temp->$key = trim($value);
							elseif (is_object($value)) foreach ($value as $k => $v) if (is_string($k)) $temp->$k = trim($v);
						}
					}
					catch (Exception $e)
					{
						echo $e->getMessage();
					}
				}
				else throw new Exception(__FUNCTION__ . '::Input paramater is not an object.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
			return $temp;
		}
		
/**
 * Unsets objects within the larger request object for follow-on service requests.
 * 
 * Merges the $unsetArray with any parameter array objects before processing.
 * 
 * @param Array $unArray
 * @throws Exception
 */
		private function unsetObjects($unArray = array())
		{
			$arr = array();
			try 
			{
				if (is_array($unArray))
				{
					$arr = array_merge($this->unsetArray,$unArray);
					foreach ($arr as $k) unset($this->obj->$k);
				}
				else throw new Exception(__FUNCTION__ . '::Input parameter is not an array.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
		}
		
/**
 * Sets the schema help object by connecting to the CyberSource transaction processor.
 * 
 * Finds the most recent XML schema link, downloads the document, and parses it into XML object.
 * 
 * @throws Exception
 */
		private function setHelpObject()
		{
			$this->help = new stdClass();
			$out = $xml = NULL;
			$arr = array();
			$match = FALSE;
			$link = '';
			try 
			{  	if (!extension_loaded('curl')) throw new Exception (__FUNCTION__ . '::cURL extension is not loaded.');
				if ($ch = curl_init())
				{
					curl_setopt($ch, CURLOPT_URL, $this->helpURL);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					$out = curl_exec($ch);
					if (curl_errno($ch) === TRUE) throw new Exception (__FUNCTION__ . '::' . curl_error($ch));
				}
				else throw new Exception (__FUNCTION__ . '::' . curl_error($ch));
					
				if (!is_null($out))
				{
					$arr = explode("\n",strip_tags($out));
					$out = NULL;
					foreach ($arr as $k => $v)
					{
						if (preg_match('/[0-9]+.+(xsd){1}$/',strtolower(trim($v))) > 0 && $match == FALSE)
						{
							$match = TRUE;
							$link = trim(substr($v,strrpos($v,' ')));
							curl_setopt($ch, CURLOPT_URL,sprintf("%s%s",$this->helpURL,$link));
							$out = curl_exec($ch);
							if (curl_errno($ch) === TRUE) throw new Exception (__FUNCTION__ . '::' . curl_error($ch));
							curl_close($ch);
						}
					}
				}
				else throw new Exception (__FUNCTION__ . '::Help connection did not return data.');
				
				if (!is_null($out))
				{
					$this->help->version = str_replace(' ','.',trim(preg_replace('/[^ 0-9]+/','',str_replace('.',' ',$link))));
					$out = str_replace('xsd:','',$out);
					$out = str_replace('tns:','',$out);
				}
				else throw new Exception (__FUNCTION__ . '::Help connection did not return a schema.');
			
				$xml = simplexml_load_string($out,NULL,LIBXML_NOERROR);
				if (!is_null($xml))
				{
					foreach ($xml as $obj)
					{
						$namesArray = array();
						foreach ($obj->attributes() as $k => $v)
						{
							$k = strtolower($k);
							if ($k == 'name') $new_obj->$v = new stdClass();
							foreach ($obj->children() as $x => $y)
							{
								if ($x == 'sequence') foreach ($y as $i => $j) $namesArray[] = (String)$j->attributes()->name;
								$att = $y->attributes();
								if (!is_null($att->use)) 
								{	
									$attArray = array();
									foreach ($att as $a => $b) 
									{
										$a = strtolower($a);
										$attArray["$a"] = (String)$b;
									}
								}
								$this->help->$v->field = $namesArray;
								$this->help->$v->attribute = $attArray;
							}
						}
					}
				}
				else throw new Exception (__FUNCTION__ . '::XML data could not be loaded.');
			}
			catch (Exception $e)
			{
				exit($e->getMessage());
			}
		}
	}
?>