
<label>Vendor</label>
<?php 
	if(!empty($subcontractor_list))
	{
		 $users_selected = '';
		if(isset($result_data['vendor_id']) && $result_data['vendor_id'] > '')
		{

			$users_selected = $result_data['vendor_id'];
		}
		echo form_dropdown('subcontractor_vendors', $subcontractor_list, $users_selected, "class='selectpicker form-control' id='vendor_id' data-live-search='true'"); 
	}else
	{
		echo form_dropdown('subcontractor_vendors', array(), '', "class='selectpicker form-control' id='vendor_id' data-live-search='true'");
	}						   
?>
