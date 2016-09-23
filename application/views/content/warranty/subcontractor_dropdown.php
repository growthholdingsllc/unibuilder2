
<label>Orig. Item/User</label>
<?php 
	if(!empty($subcontractor_list))
	{
		 $users_selected = '';
		if(isset($warranty_data['original_subcontractor_id']) && $warranty_data['original_subcontractor_id'] > '')
		{
			$users_selected = $warranty_data['original_subcontractor_id'];
		}
		array_unshift($subcontractor_list, "Nothing selected");
		if(isset($subcontractor_list['status']))
		{
			unset($subcontractor_list['status']);
		}
		echo form_dropdown('original_subcontractor_id', $subcontractor_list, $users_selected, "class='selectpicker form-control' id='subcontractor_user' data-live-search='true'"); 
	}else
	{
		echo form_dropdown('original_subcontractor_id', array(), '', "class='selectpicker form-control' id='subcontractor_user' data-live-search='true'");
	}						   
?>