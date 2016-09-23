<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH.'libraries/Crypt.php';
class UNI_Router extends CI_Router {
	var $error_controller = 'customerror';
	var $error_method_404 = 'index';
 
	public function __construct()  {
		parent::__construct();
	}
	// this is just the same method as in Router.php, with show_404() replaced by $this->error_404();
	function _validate_request($segments)
	{
		
		// a new proCrypt instance
		$crypt = new Crypt;
		// Default controller coding
		if($segments[0] == $this->default_controller){
			$segments[0] = $crypt->encrypt($this->default_controller.'/index/');
			unset($segments[1]);
		}

		// echo $crypt->encrypt('budget/update_estimate');exit;
		// decrypt the string
		//Avoided encryption for mail_fetch controller
		if($segments[0] != 'mail_fetch')
		{
			if($segments[0]!= ''){
				$decoded_url = $crypt->decrypt($segments[0]);
				$requested_url = $segments[0];
				// echo '<pre>';print_r($segments);
			}else{
				$decoded_url = $crypt->decrypt($crypt->encrypt($this->default_controller.'/index/'));
			}
		}
		/*
		* Decoded url
		*/
		if(ENVIRONMENT!='production')
		{
			// $this->session->set_userdata('decoded_url_params', $decoded_url);
		}
		//Avoided encryption for mail_fetch controller
		if($segments[0] != 'mail_fetch')
		{
			$exploded_segments = explode('/', $decoded_url);
			$reverseEncodeURL = implode('/',$exploded_segments );
			$reverseEncodedURL = $crypt->encrypt($reverseEncodeURL);
			if($requested_url == $reverseEncodedURL)
			{
				$segments = $exploded_segments;
			}
			else
			{
				return $this->error_404();
			}	
		}
		//check whether URI string exists
		if(trim($segments[0])){
			// Does the requested controller exist in the root folder?
			if (file_exists(APPPATH.'controllers/'.$segments[0].EXT))
			{
				return $segments;
			}
			// Is the controller in a sub-folder?
			if (is_dir(APPPATH.'controllers/'.$segments[0]))
			{		
				// Set the directory and remove it from the segment array
				$this->set_directory($segments[0]);
				$segments = array_slice($segments, 1);
	 
				if (count($segments) > 0)
				{
					// Does the requested controller exist in the sub-folder?
					if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].EXT))
					{
						return $this->error_404();
					}
				}
				else
				{
					$this->set_class($this->default_controller);
					$this->set_method('index');
	 
					// Does the default controller exist in the sub-folder?
					if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.EXT))
					{
						$this->directory = '';
						return array();
					}
				}
				return $segments;
			}
 
			// Can't find the requested controller...
			return $this->error_404();
		}
	}
 
	function error_404()
	{
		$this->directory = "";
		$segments = array();
		$segments[] = $this->error_controller;
		$segments[] = $this->error_method_404;
		return $segments;
	}
 
	function fetch_class()
	{
		// if method doesn't exist in class, change
		// class to error and method to error_404
		$this->check_method();
 
		return $this->class;
	}
 
	function check_method()
	{
		$ignore_remap = true;
 
		$class = $this->class;
		if (class_exists($class))
		{	
			// methods for this class
			$class_methods = array_map('strtolower', get_class_methods($class));
			// ignore controllers using _remap()
			if($ignore_remap && in_array('_remap', $class_methods))
			{
				return;
			}
 
			if (! in_array(strtolower($this->method), $class_methods))
			{
				$this->directory = "";
				$this->class = $this->error_controller;
				$this->method = $this->error_method_404;
				include(APPPATH.'controllers/'.$this->fetch_directory().$this->error_controller.EXT);
			}
		}
	}
 
	function show_404()
	{
		$_SESSION['mail_sent_404'] = 1;
        //echo "=====>".$_SESSION['mail_sent_404'];		
        include(APPPATH.'controllers/'.$this->fetch_directory().$this->error_controller.EXT);
		call_user_func(array($this->error_controller, $this->error_method_404));
	}
 
}
 
/* End of file MY_Router.php */
/* Location: ./system/application/libraries/MY_Router.php */