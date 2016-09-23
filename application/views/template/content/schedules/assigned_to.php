<label>Assign To</label>
<?php 
	if(isset($all_type_users))
	{
		$users_selected = '';
		if(isset($assigned_to_users))
		{
			$users_selected = $assigned_to_users;
		}  
		echo form_dropdown('assigned_users[]', $all_type_users, $users_selected, "class='selectpicker form-control' id='assigned_users' data-live-search='true' multiple"); 
	}else
	{
		echo form_dropdown('assigned_users[]', array(''), '', "class='selectpicker form-control' id='assigned_users' data-live-search='true' multiple");
	}						   
?>
