<?php
/** 
 * Timezone
 * 
 * @package: Timezone
 * @subpackage:  
 * @category: Core
 * @author: Gopakumar
 * @createdon(DD-MM-YYYY): 28-03-2015 
*/
class Mod_timezone extends UNI_Model{
	/**
	 * @constructor
	 */
    public function __construct() 
	{
		parent::__construct();
    }
	/** 
	* Get Time zones
	* 
	* @method: get_timezone 
	* @access: public 
	* @params: 
	* @return: array 
	*/
	public function get_timezone() 
	{
		/* $zones_array = array();
		$timestamp = time();
		foreach(timezone_identifiers_list() as $key => $zone) 
		{
			date_default_timezone_set($zone);
			$zones_array[$key]['zone'] = $zone;
			//$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
			$zones_array[$key]['diff_from_GMT'] = date('P', $timestamp);
		} */
		// $this->load->helper('date');
		$zones_array = array(
			array('zone' => '(UTC -12:00) Baker/Howland Island',
				'diff_from_GMT' => '-12:00'),
			array('zone' => '(UTC -11:00) Samoa Time Zone, Niue',
				'diff_from_GMT' => '-11:00'),
			array('zone' => '(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti',
				'diff_from_GMT' => '-10:00'),
			array('zone' => '(UTC -9:30) Marquesas Islands',
				'diff_from_GMT' => '-9:30'),
			array('zone' => '(UTC -9:00) Alaska Standard Time, Gambier Islands',
				'diff_from_GMT' => '-9:00'),
			array('zone' => '(UTC -8:00) Pacific Standard Time, Clipperton Island',
				'diff_from_GMT' => '-8:00'),
			array('zone' => '(UTC -7:00) Mountain Standard Time',
				'diff_from_GMT' => '-7:00'),
			array('zone' => '(UTC -6:00) Central Standard Time',
				'diff_from_GMT' => '-6:00'),
			array('zone' => '(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time',
				'diff_from_GMT' => '-5:00'),
			array('zone' => '(UTC -4:30) Venezuelan Standard Time',
				'diff_from_GMT' => '-4:30'),
			array('zone' => '(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time',
				'diff_from_GMT' => '-4:00'),
			array('zone' => '(UTC -3:30) Newfoundland Standard Time',
				'diff_from_GMT' => '-3:30'),
			array('zone' => '(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay',
				'diff_from_GMT' => '-3:00'),
			array('zone' => '(UTC -2:00) South Georgia/South Sandwich Islands',
				'diff_from_GMT' => '-2:00'),
			array('zone' => '(UTC -1:00) Azores, Cape Verde Islands',
				'diff_from_GMT' => '-1:00'),
			array('zone' => '(UTC) Greenwich Mean Time, Western European Time',
				'diff_from_GMT' => '+00:00'),
			array('zone' => '(UTC +1:00) Central European Time, West Africa Time',
				'diff_from_GMT' => '+1:00'),
			array('zone' => '(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time',
				'diff_from_GMT' => '+2:00'),
			array('zone' => '(UTC +3:00) Moscow Time, East Africa Time',
				'diff_from_GMT' => '+3:00'),
			array('zone' => '(UTC +3:30) Iran Standard Time',
				'diff_from_GMT' => '+3:30'),
			array('zone' => '(UTC +4:00) Azerbaijan Standard Time, Samara Time',
				'diff_from_GMT' => '+4:00'),
			array('zone' => '(UTC +4:30) Afghanistan',
				'diff_from_GMT' => '+4:30'),
			array('zone' => '(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time',
				'diff_from_GMT' => '+5:00'),
			array('zone' => '(UTC +5:30) Indian Standard Time, Sri Lanka Time',
				'diff_from_GMT' => '+5:30'),
			array('zone' => '(UTC +5:45) Nepal Time',
				'diff_from_GMT' => '+5:45'),
			array('zone' => '(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time',
				'diff_from_GMT' => '+6:00'),
			array('zone' => '(UTC +6:30) Cocos Islands, Myanmar',
				'diff_from_GMT' => '+6:30'),
			array('zone' => '(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam',
				'diff_from_GMT' => '+7:00'),
			array('zone' => '(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time',
				'diff_from_GMT' => '+8:00'),
			array('zone' => '(UTC +8:45) Australian Central Western Standard Time',
				'diff_from_GMT' => '+8:45'),
			array('zone' => '(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time',
				'diff_from_GMT' => '+9:00'),
			array('zone' => '(UTC +9:30) Australian Central Standard Time',
				'diff_from_GMT' => '+9:30'),
			array('zone' => '(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time',
				'diff_from_GMT' => '+10:00'),
			array('zone' => '(UTC +10:30) Lord Howe Island',
				'diff_from_GMT' => '+10:30'),
			array('zone' => '(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu',
				'diff_from_GMT' => '+11:00'),
			array('zone' => '(UTC +11:30) Norfolk Island',
				'diff_from_GMT' => '+11:30'),
			array('zone' => '(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time',
				'diff_from_GMT' => '+12:00'),
			array('zone' => '(UTC +12:45) Chatham Islands Standard Time',
				'diff_from_GMT' => '+12:45'),
			array('zone' => '(UTC +13:00) Phoenix Islands Time, Tonga',
				'diff_from_GMT' => '+13:00'),
			array('zone' => '(UTC +14:00) Line Islands',
				'diff_from_GMT' => '+14:00')
				
		);
		return $zones_array;
	}
	
	/** 
	* Get Time zones for datatable
	* 
	* @method: datatable_timezone 
	* @access: public 
	* @params: 
	* @return: array 
	* @createdon(DD-MM-YYYY): 15-09-2015 
	* @createdby: satheesh Kumar
	*/
	public function datatable_timezone($post_data = array()) 
	{
		$zones_array = $this->get_timezone();
		foreach($post_data as $key => $value)
		{
			foreach($zones_array as $zone_key => $zone_value)
			{
				if($zone_value['diff_from_GMT'] == $value['time_zone'])
				{
					$post_data[$key]['time_zone'] = $zone_value['zone'];
				}	
			}	
		}
		return $post_data;	
	}	
}
/* End of file mod_timezone.php */
/* Location: ./application/models/mod_timezone.php */