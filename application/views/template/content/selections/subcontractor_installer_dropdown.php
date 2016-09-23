<label>Installer</label>
<?php 
	if(!empty($subcontractor_list))
	{
		 $users_selected = '';
		if(isset($result_data['installer_id']) && $result_data['installer_id'] > '')
		{

			$users_selected = $result_data['installer_id'];
		}
		echo form_dropdown('subcontractor_installers', $subcontractor_list, $users_selected, "class='selectpicker form-control' id='subcontractor_installer' data-live-search='true'"); 
	}else
	{
		echo form_dropdown('subcontractor_installers', array(), '', "class='selectpicker form-control' id='subcontractor_installer' data-live-search='true'");
	}						   
?>