<?php 
/**
 *
 * @name UNI_Controller
 * @version PHP 5.5
 *
 * @package		NA
 * @Team		Uni Builder Dev Team
 * @author    Gopakumar K <gopakumar.k@ttkservices.com>
 * @copyright	Copyright (c) 2015,Uni Builder.
 * @Created		08-01-2015
 * @version   1
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onetime_scripts extends UNI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->load->library(array());
		$this->load->model(array('Mod_onetime_scripts'));
		$this->load->helper(array());
    }
	/** 
	  * @desc this function used to enable / disable benchmark on the site by passing arguments
	*/
	function benchmark_on($on = 0){
		$this->Mod_onetime_scripts->benchMark_on($on);
	}
	public function check(){
		$result = "Gopakuamr";
		$date = "2013-11-01";
		echo $output = sprintf("Here is the result: %s for this date %s", $result, $date);exit;
	}
	//url :b25ldgxf1ltZV9zY3JpcHRzL3BocF9pbmZv
	public function php_info(){
		phpinfo();
	}
}
