
<label>Service Coordinator</label>
<?php 
	if(!empty($service_coordinator_list))
	{
		 $users_selected = '';
		if(isset($warranty_data['service_coordinator_id']) && $warranty_data['service_coordinator_id'] > '')
		{

			$users_selected = $warranty_data['service_coordinator_id'];
		}
		echo form_dropdown('service_coordinator_id', $service_coordinator_list, $users_selected, "class='selectpicker form-control' id='service_coordinator' data-live-search='true'"); 
	}else
	{
		echo form_dropdown('service_coordinator_id', array(), '', "class='selectpicker form-control' id='service_coordinator' data-live-search='true'");
	}						   
?>
