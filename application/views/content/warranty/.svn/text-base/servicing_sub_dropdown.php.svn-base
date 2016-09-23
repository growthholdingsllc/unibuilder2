
<label>Servicing Sub</label>
<div class="col-xs-12">
	<div class="form-group">
	<?php 
		if(!empty($servicing_sub_list))
		{
			 $users_selected = '';
			if(isset($appoinment_data['subcontractor_id']) && $appoinment_data['subcontractor_id'] > '')
			{
				$users_selected = $appoinment_data['subcontractor_id'];
			}
			array_unshift($servicing_sub_list, "Nothing selected");
			if(isset($servicing_sub_list['status']))
			{
				unset($servicing_sub_list['status']);
			}
			echo form_dropdown('subcontractor_id', $servicing_sub_list, $users_selected, "class='selectpicker form-control' id='subcontractor_user' data-live-search='true'"); 
		}else
		{
			echo form_dropdown('subcontractor_id', array(), '', "class='selectpicker form-control' id='subcontractor_user' data-live-search='true'");
		}						   
	?>
	</div>
</div>