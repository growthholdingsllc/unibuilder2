<?php
/** 
 * Master Mail Template Class
 * 
 * @package: Mail Template 
 * @subpackage: Builder Mail Template 
 * @category: EMail
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 12-03-2015 
*/
class Mod_onetime_scripts extends UNI_Model {
    public function __construct() 
	{
        parent::__construct();
		$this->load->library(array());
		$this->load->model(array());
		$this->load->helper(array());
    }
	/** 
	  * @desc this function used to enable / disable benchmark on the site by passing arguments
	  * @param signle (integer $on)
	  * @return bool - enabled / disabled
	*/
	public function benchmark_on($on)
	{
		$benchmark_flag = FALSE;
		if('www.unibuilder.com' != $_SERVER['SERVER_NAME']){
			if(0 == $on)
			{
				$benchmark_flag = FALSE;
				$benchmark_msg="Disabled Benchmark on ".$_SERVER['SERVER_NAME']." Site ";
			}
			else
			{
				$benchmark_flag = TRUE;
				$benchmark_msg = "Enabled Benchmark on ".$_SERVER['SERVER_NAME']." Site ";
			}
		}
		else
		{
				$benchmark_msg = "You can't Enable benchmark on ".$_SERVER['SERVER_NAME']." Site";
		}
		$this->session->set_userdata('benchmarkon',$benchmark_flag);
		echo $benchmark_msg; exit;
		
	}
}
?>