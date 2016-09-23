<div class="row">
	 <div class="col-xs-5">
		<label>Assign To</label>
<?php 
	if(!empty($all_type_users))
	{
		 $users_selected = '';
		if(isset($result_data['aaData'][0]['task_assigned_users']))
		{
			$users_selected = explode(",",$result_data['aaData'][0]['task_assigned_users']);
		}
		echo form_dropdown('assign_to[]', $all_type_users, $users_selected, "class='selectpicker form-control' id='assign_to' data-live-search='true' multiple"); 
	}else
	{
		echo form_dropdown('assign_to[]', array(), '', "class='selectpicker form-control' id='assign_to' data-live-search='true' multiple");
	}						   
?>
 </div>
</div>