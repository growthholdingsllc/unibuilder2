<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('array_to_export'))
{
    function array_to_export($array=array(), $filename = "", $filetype = "")
    {
        //echo "<pre>";print_r($array);exit;
		$file_type = ($filetype == "")?'csv':trim(strtolower($filetype));
		$match_column = (count($array['header'][0]) != count($array['value'][0]))?FALSE:TRUE;
		// Check if the header & value column(s) are same
		if(!$match_column)
		{
			echo 'Header array column count mismatch with value array column!';
			return false;
			exit;
		}
		if ($filename != "")
        {    
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Type: application/vnd.ms-excel");
			header("Pragma: no-cache");
			header("Expires: 0");
        }        
		// Header fields array
		foreach ($array['header'] as $lines)
        {
			foreach ($lines as $line)
			{
				echo $line."\t";
			}	
        }
		echo "\r\n";
		// Value fields array
		foreach ($array['value'] as $lines)
        {
			foreach ($lines as $line)
			{
				echo $line."\t";
			}	
			echo "\r\n";
        }
		
		
        $str = ob_get_contents();
        ob_end_clean();

        if ($filename == "")
        {
            return $str;    
        }
        else
        {    
            echo $str;
        }        
    }
}

if ( ! function_exists('query_to_export'))
{
    function query_to_export($query, $headers = TRUE, $filename = "", $filetype = "")
    {
        if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
        {
            show_error('invalid query');
        }
        
        $array = array();
        
        if ($headers)
        {
            $line = array();
            foreach ($query->list_fields() as $name)
            {
                $line = $name;
            }
			$array['header'][] = $line;
        }
		else
		{
			$array['header'][] = $headers;	
		}
        
        foreach ($query->result_array() as $row)
        {
            $line = array();
            foreach ($row as $item)
            {
                $line[] = $item;
            }
            $array['value'][] = $line;
        }
		array_to_export($array, $filename, $filetype);
    }
}

/* End of file export_helper.php */
/* Location: ./application/helpers/export_helper.php */